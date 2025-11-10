<?php

namespace Database\Seeders;

use App\Models\ScheduleSession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        if (! Schema::hasTable('schedule_sessions')) {
            return;
        }

        ScheduleSession::query()->delete();
    }
}
