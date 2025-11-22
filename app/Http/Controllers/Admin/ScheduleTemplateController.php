<?php

namespace App\Http\Controllers\Admin;

use App\Models\ScheduleTemplate;
use App\Models\Package;
use App\Support\ScheduleTemplateGenerator;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class ScheduleTemplateController extends BaseAdminController
{
    public function store(Request $request): RedirectResponse
    {
        if (! Schema::hasTable('schedule_templates')) {
            return redirect()->route('admin.schedules.index')
                ->with('alert', __('Tabel template jadwal belum tersedia. Jalankan migrasi terbaru.'));
        }

        $data = $this->validatedData($request);
        $package = Package::with('tutor')->find($data['package_id']);

        if (! $package || ! $package->tutor_id) {
            return redirect()->route('admin.schedules.index')
                ->with('alert', __('Paket harus memiliki tentor terlebih dahulu sebelum membuat jadwal.'));
        }

        $data['user_id'] = $package->tutor_id;

        $template = ScheduleTemplate::create($data);

        ScheduleTemplateGenerator::refreshTemplate($template);

        return redirect()->route('admin.schedules.index', ['tutor_id' => $data['user_id']])
            ->with('status', __('Jadwal berhasil ditambahkan.'));
    }

    public function update(Request $request, ScheduleTemplate $template): RedirectResponse
    {
        $data = $this->validatedData($request);
        $package = Package::with('tutor')->find($data['package_id']);

        if (! $package || ! $package->tutor_id) {
            return redirect()->route('admin.schedules.index')
                ->with('alert', __('Paket harus memiliki tentor terlebih dahulu sebelum membuat jadwal.'));
        }

        $data['user_id'] = $package->tutor_id;

        $template->update($data);

        ScheduleTemplateGenerator::refreshTemplate($template);

        return redirect()->route('admin.schedules.index', ['tutor_id' => $data['user_id']])
            ->with('status', __('Pola jadwal berhasil diperbarui.'));
    }

    public function destroy(Request $request, ScheduleTemplate $template): RedirectResponse
    {
        $tutorId = $template->user_id;

        ScheduleTemplateGenerator::removeTemplateSessions($template);

        $template->delete();

        $redirectTutorId = $request->input('redirect_tutor_id');
        $routeParameters = [];

        if ($redirectTutorId && $redirectTutorId !== 'all') {
            $routeParameters['tutor_id'] = $redirectTutorId;
        } elseif ($tutorId) {
            $routeParameters['tutor_id'] = $tutorId;
        }

        return redirect()->route('admin.schedules.index', $routeParameters)
            ->with('status', __('Pola jadwal dihapus dan sesi mendatang dibatalkan.'));
    }

    private function validatedData(Request $request): array
    {
        $payload = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:120'],
            'class_level' => ['nullable', 'string', 'max:120'],
            'location' => ['nullable', 'string', 'max:255'],
            'zoom_link' => ['nullable', 'string', 'max:2048', 'regex:/^https?:\/\//i'],
            'reference_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration_minutes' => ['required', 'integer', 'min:30', 'max:240'],
            'student_count' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        $reference = CarbonImmutable::parse($payload['reference_date']);
        $payload['day_of_week'] = $reference->dayOfWeek;
        $payload['is_active'] = true;

        unset($payload['reference_date']);

        return $payload;
    }
}
