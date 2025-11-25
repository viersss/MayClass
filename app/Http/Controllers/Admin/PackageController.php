<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PackageController extends BaseAdminController
{
    public function index(): View
    {
        $packages = Schema::hasTable('packages')
            ? Package::withQuotaUsage()->with(['subjects', 'tutors'])->orderBy('level')->get()
            : collect();

        return $this->render('admin.packages.index', [
            'packages' => $packages,
            'stages' => $this->stageOptions(),
            'tutors' => User::where('role', 'tutor')->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function create(): View
    {
        return $this->render('admin.packages.create', [
            'stages' => $this->stageOptions(),
            'subjectsByLevel' => $this->getSubjectsByLevel(),
            'tutors' => User::where('role', 'tutor')->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatePayload($request);

        $package = Package::create($data);

        // Sync subjects
        if ($request->has('subjects')) {
            $package->subjects()->sync($request->subjects);
        }

        // Sync tutors
        if ($request->has('tutors')) {
            $package->tutors()->sync($request->tutors);
        }

        // Create card features
        if ($request->has('card_features')) {
            $this->syncCardFeatures($package, $request->card_features);
        }

        return redirect()->route('admin.packages.index')->with('status', __('Paket berhasil dibuat.'));
    }

    public function edit(Package $package): View
    {
        $package->load(['subjects', 'cardFeatures']);

        return $this->render('admin.packages.edit', [
            'package' => $package,
            'stages' => $this->stageOptions(),
            'subjectsByLevel' => $this->getSubjectsByLevel(),
            'tutors' => User::where('role', 'tutor')->where('is_active', true)->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Package $package): RedirectResponse
    {
        $data = $this->validatePayload($request, $package->id);

        $package->update($data);

        // Sync subjects
        if ($request->has('subjects')) {
            $package->subjects()->sync($request->subjects);
        }

        // Sync tutors
        if ($request->has('tutors')) {
            $package->tutors()->sync($request->tutors);
        }

        // Sync card features - delete old and create new
        $package->cardFeatures()->delete();
        if ($request->has('card_features')) {
            $this->syncCardFeatures($package, $request->card_features);
        }

        return redirect()->route('admin.packages.index')->with('status', __('Paket berhasil diperbarui.'));
    }

    public function destroy(Package $package): RedirectResponse
    {
        try {
            DB::transaction(function () use ($package) {
                // Force delete related data to allow package deletion
                $package->orders()->delete();
                $package->enrollments()->delete();
                $package->checkoutSessions()->delete();

                // Detach many-to-many relationships
                $package->tutors()->detach();

                $package->delete();
            });
        } catch (QueryException $exception) {
            // Fallback if something else blocks it
            return redirect()
                ->route('admin.packages.index')
                ->with('error', 'Gagal menghapus paket: ' . $exception->getMessage());
        }

        return redirect()->route('admin.packages.index')->with('status', __('Paket dan data terkait berhasil dihapus.'));
    }

    private function validatePayload(Request $request, ?int $packageId = null): array
    {
        $stageKeys = array_keys($this->stageOptions());

        $data = $request->validate([
            'level' => ['required', 'string', 'max:255', Rule::in($stageKeys)],
            'grade_range' => ['required', 'string', 'max:255'],
            'tag' => ['nullable', 'string', 'max:50'],
            'card_price_label' => ['required', 'string', 'max:50'],
            'detail_title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'max_students' => ['nullable', 'integer', 'min:1'],
            'available_class' => ['nullable', 'integer', 'min:1'],
            'summary' => ['required', 'string'],
            'subjects' => ['required', 'array', 'min:1'],
            'subjects.*' => ['exists:subjects,id'],
            'tutors' => ['nullable', 'array'],
            'tutors.*' => ['exists:users,id'],
            'card_features' => ['nullable', 'array'],
            'card_features.*' => ['nullable', 'string', 'max:255'],
        ]);

        // Auto-generate missing fields
        if (!$request->has('slug')) {
            $slug = \Illuminate\Support\Str::slug($data['detail_title']);
            $count = 1;
            $originalSlug = $slug;
            while (Package::where('slug', $slug)->where('id', '!=', $packageId)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $data['slug'] = $slug;
        }

        if (!$request->has('image_url')) {
            $data['image_url'] = 'default-package'; // Or random unsplash key
        }

        if (!$request->has('detail_price_label')) {
            $data['detail_price_label'] = $data['card_price_label'];
        }

        // Filter empty values from arrays
        if (isset($data['program_points'])) {
            $data['program_points'] = array_values(array_filter($data['program_points'], fn($value) => !is_null($value) && $value !== ''));
        } else {
            $data['program_points'] = [];
        }

        if (isset($data['facility_points'])) {
            $data['facility_points'] = array_values(array_filter($data['facility_points'], fn($value) => !is_null($value) && $value !== ''));
        } else {
            $data['facility_points'] = [];
        }

        if (isset($data['schedule_info'])) {
            $data['schedule_info'] = array_values(array_filter($data['schedule_info'], fn($value) => !is_null($value) && $value !== ''));
        } else {
            $data['schedule_info'] = [];
        }

        return $data;
    }

    /**
     * Sync card features for a package.
     * Filters empty values and creates features with proper positioning.
     */
    private function syncCardFeatures(Package $package, array $features): void
    {
        $filtered = collect($features)
            ->map(fn($value) => trim((string) $value))
            ->filter(fn($value) => !empty($value))
            ->values();

        foreach ($filtered as $index => $label) {
            $package->features()->create([
                'type' => 'card',
                'label' => $label,
                'position' => $index + 1,
            ]);
        }
    }

    /**
     * Sync card features for a package.
     * Filters empty values and creates features with proper positioning.
     */
    private function syncCardFeatures(Package $package, array $features): void
    {
        $filtered = collect($features)
            ->map(fn($value) => trim((string) $value))
            ->filter(fn($value) => !empty($value))
            ->values();

        foreach ($filtered as $index => $label) {
            $package->features()->create([
                'type' => 'card',
                'label' => $label,
                'position' => $index + 1,
            ]);
        }
    }

    private function stageOptions(): array
    {
        $definitions = config('mayclass.package_stages');

        if (!is_array($definitions) || empty($definitions)) {
            $definitions = [
                'SD' => ['label' => 'Sekolah Dasar (SD)'],
                'SMP' => ['label' => 'Sekolah Menengah Pertama (SMP)'],
                'SMA' => ['label' => 'Sekolah Menengah Atas (SMA)'],
            ];
        }

        $options = [];

        foreach ($definitions as $key => $definition) {
            if (is_array($definition)) {
                $options[$key] = $definition['label'] ?? (string) $key;
            } else {
                $options[$key] = (string) $definition;
            }
        }

        return $options;
    }

    private function getSubjectsByLevel(): array
    {
        if (! Schema::hasTable('subjects')) {
            return [
                'SD' => collect(),
                'SMP' => collect(),
                'SMA' => collect(),
            ];
        }

        $subjects = Subject::where('is_active', true)
            ->orderBy('level')
            ->orderBy('name')
            ->get()
            ->groupBy('level');

        return [
            'SD' => $subjects->get('SD', collect()),
            'SMP' => $subjects->get('SMP', collect()),
            'SMA' => $subjects->get('SMA', collect()),
        ];
    }

    public function getSubjects(Package $package): \Illuminate\Http\JsonResponse
    {
        $subjects = $package->subjects()->select('id', 'name', 'level')->get();
        return response()->json($subjects);
    }
}
