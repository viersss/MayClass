<?php

namespace App\Support;

use App\Models\ScheduleSession;
use App\Models\ScheduleTemplate;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ScheduleTemplateGenerator
{
    /**
     * Generate sesi untuk Tutor tertentu (Maintenance rutin).
     */
    public static function ensureForTutor(User $tutor, int $weeks = 8): void
    {
        if (! self::ready()) return;

        $templates = ScheduleTemplate::query()
            ->where('user_id', $tutor->id)
            ->where('is_active', true)
            ->with('package')
            ->get();

        if ($templates->isEmpty()) return;

        // Default start date hari ini untuk maintenance rutin
        self::ensureSessions($templates, $weeks, CarbonImmutable::now());
    }

    /**
     * Generate sesi untuk Paket tertentu.
     */
    public static function ensureForPackage(int $packageId, int $weeks = 8): void
    {
        if (! self::ready()) return;

        $templates = ScheduleTemplate::query()
            ->where('package_id', $packageId)
            ->where('is_active', true)
            ->with('user')
            ->get();

        if ($templates->isEmpty()) return;

        self::ensureSessions($templates, $weeks, CarbonImmutable::now());
    }

    /**
     * Generate sesi saat Template baru dibuat atau diupdate.
     * Menerima parameter $startDate agar jadwal sesuai inputan user (reference_date).
     */
    public static function refreshTemplate(ScheduleTemplate $template, int $weeks = 8, ?string $startDate = null): void
    {
        if (! self::ready()) return;

        DB::transaction(function () use ($template, $weeks, $startDate) {
            // 1. Tentukan titik mulai. Jika user input tanggal, gunakan itu. Jika tidak, pakai NOW.
            $startRef = $startDate ? CarbonImmutable::parse($startDate) : CarbonImmutable::now();

            // 2. Hapus sesi masa depan agar bersih sebelum generate ulang
            ScheduleSession::query()
                ->where('schedule_template_id', $template->id)
                ->where('start_at', '>=', $startRef->startOfDay())
                ->where('status', 'scheduled') // Hanya hapus yang statusnya masih terjadwal
                ->delete();

            // 3. Load relasi user jika belum ada
            if (!$template->relationLoaded('user')) {
                $template->load('user');
            }
            
            // 4. Generate sesi baru mulai dari tanggal referensi
            self::ensureSessions(collect([$template]), $weeks, $startRef);
        });
    }

    /**
     * Menghapus sesi masa depan (saat template dihapus).
     */
    public static function removeTemplateSessions(ScheduleTemplate $template): void
    {
        if (! self::ready()) return;

        ScheduleSession::query()
            ->where('schedule_template_id', $template->id)
            ->where('start_at', '>=', CarbonImmutable::now()->startOfDay())
            ->where('status', 'scheduled')
            ->delete();
    }

    /**
     * Core Logic: Loop mingguan untuk membuat sesi.
     */
    private static function ensureSessions(Collection $templates, int $weeks, CarbonImmutable $startFrom): void
    {
        // Mulai perhitungan window dari awal minggu tanggal referensi
        $windowStart = $startFrom->startOfWeek(CarbonImmutable::MONDAY);
        
        // Loop template
        $templates->each(function (ScheduleTemplate $template) use ($windowStart, $weeks, $startFrom) {
            
            // Pastikan data user/tutor tersedia
            $tutor = $template->user; 
            if (! $tutor) {
                $tutor = User::find($template->user_id);
                if (!$tutor) return; 
            }

            // LOOPING MINGGUAN
            for ($week = 0; $week <= $weeks; $week++) {
                // Hitung minggu ke-n dari start date
                $weekStart = $windowStart->copy()->addWeeks($week);
                
                // Cari tanggal spesifik (Senin/Selasa/dll) di minggu tersebut
                $candidateDate = self::nextOrSameDay($weekStart, $template->day_of_week);

                // Validasi: Tanggal tidak boleh null & harus >= Tanggal Mulai yang diminta user
                if (! $candidateDate || $candidateDate->startOfDay()->lt($startFrom->startOfDay())) {
                    continue;
                }

                // Gabungkan Tanggal + Jam
                try {
                    $startAt = $candidateDate->setTimeFromTimeString($template->start_time);
                } catch (\Exception $e) {
                    continue; 
                }

                // Cek Duplikat
                $exists = ScheduleSession::query()
                    ->where('schedule_template_id', $template->id)
                    ->where('start_at', $startAt)
                    ->exists();

                if ($exists) {
                    continue;
                }

                // Create Session
                ScheduleSession::create([
                    'schedule_template_id' => $template->id,
                    'user_id'              => $template->user_id,
                    'package_id'           => $template->package_id,
                    'title'                => $template->title,
                    'category'             => $template->category ?? '-',
                    'class_level'          => $template->class_level,
                    'location'             => $template->location,
                    'zoom_link'            => $template->zoom_link,
                    'student_count'        => $template->student_count,
                    'mentor_name'          => $tutor->name,
                    'start_at'             => $startAt,
                    'duration_minutes'     => $template->duration_minutes ?? 90,
                    'is_highlight'         => false,
                    'status'               => 'scheduled',
                ]);
            }
        });
    }

    private static function nextOrSameDay(CarbonImmutable $date, int $dayOfWeek): ?CarbonImmutable
    {
        if ($dayOfWeek < 0 || $dayOfWeek > 6) {
            return null;
        }

        // Jika hari ini sudah pas, return hari ini
        if ($date->dayOfWeek === $dayOfWeek) {
            return $date;
        }

        // Jika tidak, cari hari tersebut di masa depan (dalam minggu yang sama atau next)
        // Note: Logika startOfWeek sudah menangani offset minggu
        return $date->next($dayOfWeek);
    }

    private static function ready(): bool
    {
        return Schema::hasTable('schedule_templates') && Schema::hasTable('schedule_sessions');
    }
}