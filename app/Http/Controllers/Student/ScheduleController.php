<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ScheduleSession;
use App\Support\ScheduleViewData;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sessions = ScheduleSession::orderBy('start_at')->get();

        return view('student.schedule', [
            'schedule' => ScheduleViewData::fromCollection($sessions),
        ]);
    }
}
