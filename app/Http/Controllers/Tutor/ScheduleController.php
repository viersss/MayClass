<?php

namespace App\Http\Controllers\Tutor;

use Illuminate\Http\RedirectResponse;

class ScheduleController extends BaseTutorController
{
    public function index(): RedirectResponse
    {
        return redirect()->route('tutor.dashboard')
            ->with('alert', __('Jadwal kini dikelola langsung oleh admin MayClass. Silakan hubungi admin untuk perubahan.'));
    }
}
