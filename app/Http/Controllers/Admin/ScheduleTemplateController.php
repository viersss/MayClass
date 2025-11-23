<?php

namespace App\Http\Controllers\Admin;

use App\Models\Package;
use App\Models\ScheduleTemplate;
use App\Models\Subject;
use App\Models\User;
use App\Support\ScheduleTemplateGenerator;
use Carbon\CarbonImmutable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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

        // Create Template
        $template = ScheduleTemplate::create($data);

        // GENERATE SESI (FIXED: Memasukkan reference_date)
        ScheduleTemplateGenerator::refreshTemplate($template, 8, $request->reference_date);

        return redirect()->route('admin.schedules.index', ['tutor_id' => $data['user_id']])
            ->with('status', __('Jadwal baru berhasil disimpan dan sesi telah dibuat.'));
    }

    public function update(Request $request, ScheduleTemplate $template): RedirectResponse
    {
        $data = $this->validatedData($request, $template);

        $template->update($data);

        // RE-GENERATE SESI (FIXED: Memasukkan reference_date)
        ScheduleTemplateGenerator::refreshTemplate($template, 8, $request->reference_date);

        return redirect()->route('admin.schedules.index', ['tutor_id' => $data['user_id']])
            ->with('status', __('Pola jadwal berhasil diperbarui dan sesi disesuaikan.'));
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

    private function validatedData(Request $request, ?ScheduleTemplate $existing = null): array
    {
        $payload = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
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
        $dayOfWeek = $reference->dayOfWeek === 0 ? 7 : $reference->dayOfWeek;

        // Check tutor competency and package compatibility
        $this->validateSubjectCompatibility(
            $payload['user_id'],
            $payload['package_id'],
            $payload['subject_id']
        );

        // Check for overlapping schedules
        $this->validateNoOverlap(
            $payload['user_id'],
            $dayOfWeek,
            $payload['start_time'],
            $payload['duration_minutes'],
            $existing?->id
        );

        $payload['day_of_week'] = $dayOfWeek;
        $payload['is_active'] = true;

        // Kita butuh reference_date untuk generator, tapi tidak disimpan di tabel template
        // maka kita unset dari payload array yg akan masuk ke DB
        unset($payload['reference_date']);

        return $payload;
    }

    private function validateNoOverlap(int $userId, int $dayOfWeek, string $startTime, int $durationMinutes, ?int $excludeId = null): void
    {
        // Convert start time to minutes since midnight
        [$hours, $minutes] = explode(':', $startTime);
        $newStartMinutes = ($hours * 60) + $minutes;
        $newEndMinutes = $newStartMinutes + $durationMinutes;

        $overlapping = ScheduleTemplate::query()
            ->where('user_id', $userId)
            ->where('day_of_week', $dayOfWeek)
            ->when($excludeId, fn ($query) => $query->where('id', '!=', $excludeId))
            ->get()
            ->filter(function (ScheduleTemplate $template) use ($newStartMinutes, $newEndMinutes) {
                [$hours, $minutes] = explode(':', $template->start_time);
                $existingStartMinutes = ($hours * 60) + $minutes;
                $existingEndMinutes = $existingStartMinutes + $template->duration_minutes;

                return $newStartMinutes < $existingEndMinutes && $existingStartMinutes < $newEndMinutes;
            });

        if ($overlapping->isNotEmpty()) {
            $conflictTitles = $overlapping->pluck('title')->join(', ');
            throw new \Illuminate\Validation\ValidationException(
                validator([], [], [], [], [
                    'schedule' => "Jadwal bertumpang tindih dengan: {$conflictTitles}"
                ])
            );
        }
    }

    private function validateSubjectCompatibility(int $userId, int $packageId, int $subjectId): void
    {
        $user = User::find($userId);
        $package = Package::find($packageId);
        $subject = Subject::find($subjectId);

        // Check if tutor is assigned to this package
        if (!$user->packages()->where('package_id', $packageId)->exists()) {
            throw new ValidationException(
                validator([], [], [], [], [
                    'package_id' => "Tutor {$user->name} tidak ditugaskan untuk mengajar paket {$package->detail_title}"
                ])
            );
        }

        // Check if tutor can teach this subject
        if (!$user->subjects()->where('subject_id', $subjectId)->exists()) {
            throw new ValidationException(
                validator([], [], [], [], [
                    'subject_id' => "Tutor {$user->name} tidak kompeten mengajar mata pelajaran {$subject->name}"
                ])
            );
        }

        // Check if package includes this subject
        if (!$package->subjects()->where('subject_id', $subjectId)->exists()) {
            throw new ValidationException(
                validator([], [], [], [], [
                    'subject_id' => "Paket {$package->detail_title} tidak include mata pelajaran {$subject->name}"
                ])
            );
        }
    }
}
