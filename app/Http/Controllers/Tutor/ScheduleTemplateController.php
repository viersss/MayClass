<?php

namespace App\Http\Controllers\Tutor;

use App\Models\ScheduleTemplate;
use App\Support\ScheduleTemplateGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ScheduleTemplateController extends BaseTutorController
{
    public function store(Request $request): RedirectResponse
    {
        if (! Schema::hasTable('schedule_templates')) {
            return redirect()->route('tutor.schedule.index')
                ->with('alert', __('Tabel jadwal belum siap. Jalankan migrasi terbaru.'));
        }

        $tutor = Auth::user();

        $data = $this->validatedData($request);
        $data['user_id'] = $tutor->id;

        $template = ScheduleTemplate::create($data);

        ScheduleTemplateGenerator::refreshTemplate($template);

        return redirect()->route('tutor.schedule.index')
            ->with('status', __('Pola jadwal berhasil ditambahkan.'));
    }

    public function update(Request $request, ScheduleTemplate $template): RedirectResponse
    {
        $tutor = Auth::user();

        if ($template->user_id !== $tutor->id) {
            abort(403);
        }

        $data = $this->validatedData($request);

        $template->update($data);

        ScheduleTemplateGenerator::refreshTemplate($template);

        return redirect()->route('tutor.schedule.index')
            ->with('status', __('Pola jadwal berhasil diperbarui.'));
    }

    public function destroy(ScheduleTemplate $template): RedirectResponse
    {
        $tutor = Auth::user();

        if ($template->user_id !== $tutor->id) {
            abort(403);
        }

        ScheduleTemplateGenerator::removeTemplateSessions($template);
        $template->delete();

        return redirect()->route('tutor.schedule.index')
            ->with('status', __('Pola jadwal dihapus dan pertemuan mendatang dibatalkan.'));
    }

    private function validatedData(Request $request): array
    {
        $payload = $request->validate([
            'package_id' => ['required', 'exists:packages,id'],
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:120'],
            'class_level' => ['nullable', 'string', 'max:120'],
            'location' => ['nullable', 'string', 'max:255'],
            'day_of_week' => ['required', 'integer', 'between:0,6'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration_minutes' => ['required', 'integer', 'min:30', 'max:240'],
            'student_count' => ['nullable', 'integer', 'min:1', 'max:200'],
        ]);

        $payload['is_active'] = true;

        return $payload;
    }
}
