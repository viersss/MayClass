<?php

namespace App\Http\Controllers\Admin;

use App\Models\ScheduleSession;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ScheduleSessionController extends BaseAdminController
{
    public function cancel(Request $request, ScheduleSession $session): RedirectResponse
    {
        if (Schema::hasColumn('schedule_sessions', 'status')) {
            $session->forceFill([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'is_highlight' => false,
            ])->save();
        }

        return $this->redirectToDashboard($request, $session->user_id, __('Sesi berhasil dibatalkan.'));
    }

    public function restore(Request $request, ScheduleSession $session): RedirectResponse
    {
        if (Schema::hasColumn('schedule_sessions', 'status')) {
            $session->forceFill([
                'status' => 'scheduled',
                'cancelled_at' => null,
            ])->save();
        }

        return $this->redirectToDashboard($request, $session->user_id, __('Sesi dikembalikan ke jadwal.'));
    }

    private function redirectToDashboard(Request $request, ?int $tutorId, string $message): RedirectResponse
    {
        $redirectTutorId = $request->input('redirect_tutor_id');
        $routeParameters = [];

        if ($redirectTutorId && $redirectTutorId !== 'all') {
            $routeParameters['tutor_id'] = $redirectTutorId;
        } elseif ($redirectTutorId !== 'all' && $tutorId) {
            $routeParameters['tutor_id'] = $tutorId;
        }

        return redirect()->route('admin.dashboard', $routeParameters)
            ->with('status', $message);
    }
}
