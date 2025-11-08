<?php

namespace App\Http\Controllers\Tutor;

use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Quiz;
use App\Models\ScheduleSession;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class DashboardController extends BaseTutorController
{
    public function index()
    {
        $tutor = Auth::user();

        $stats = [
            'students' => Schema::hasTable('enrollments')
                ? Enrollment::where('is_active', true)->distinct('user_id')->count('user_id')
                : 0,
            'materials' => Schema::hasTable('materials') ? Material::count() : 0,
            'quizzes' => Schema::hasTable('quizzes') ? Quiz::count() : 0,
        ];

        $today = CarbonImmutable::now();

        $sessions = Schema::hasTable('schedule_sessions')
            ? ScheduleSession::query()
                ->when($tutor, function ($query) use ($tutor) {
                    $query->where('user_id', $tutor->id)
                        ->orWhere(function ($inner) use ($tutor) {
                            $inner->whereNull('user_id')->where('mentor_name', $tutor->name);
                        });
                })
                ->orderBy('start_at')
                ->get()
            : collect();

        $todaySessions = $sessions
            ->filter(fn ($session) => CarbonImmutable::parse($session->start_at)->isSameDay($today))
            ->map(function (ScheduleSession $session) {
                $start = CarbonImmutable::parse($session->start_at);
                $end = $start->addMinutes(90);

                return [
                    'subject' => $session->category,
                    'title' => $session->title,
                    'class_level' => $session->class_level ?? 'Kelas',
                    'time_range' => $start->format('H.i') . ' - ' . $end->format('H.i'),
                    'location' => $session->location ?? 'Ruang Virtual',
                    'student_count' => $session->student_count,
                    'highlight' => (bool) $session->is_highlight,
                ];
            })
            ->values();

        $nextSessions = $sessions
            ->reject(fn ($session) => CarbonImmutable::parse($session->start_at)->isSameDay($today))
            ->sortBy('start_at')
            ->take(6)
            ->map(function (ScheduleSession $session) {
                $start = CarbonImmutable::parse($session->start_at);
                $end = $start->addMinutes(90);

                return [
                    'day' => $start->locale('id')->translatedFormat('l'),
                    'title' => $session->title,
                    'subject' => $session->category,
                    'class_level' => $session->class_level ?? '-',
                    'date_label' => $start->locale('id')->translatedFormat('d F Y'),
                    'time_range' => $start->format('H.i') . ' - ' . $end->format('H.i'),
                ];
            })
            ->values();

        $totalStudentsToday = $todaySessions->sum('student_count');
        $teachingHours = round($sessions->count() * 1.5, 1);

        $highlightStats = [
            [
                'label' => 'Siswa Aktif',
                'display' => number_format($stats['students']),
                'suffix' => 'siswa',
                'description' => 'Terdaftar mengikuti bimbingan MayClass',
                'accent' => 'mint',
            ],
            [
                'label' => 'Jam Mengajar',
                'display' => number_format($teachingHours, 1, ',', '.'),
                'suffix' => 'jam',
                'description' => 'Akumulasi durasi dari seluruh sesi',
                'accent' => 'indigo',
            ],
            [
                'label' => 'Materi Aktif',
                'display' => number_format($stats['materials']),
                'suffix' => 'materi',
                'description' => 'Siap dibagikan kepada siswa',
                'accent' => 'orange',
            ],
            [
                'label' => 'Quiz Siap Pakai',
                'display' => number_format($stats['quizzes']),
                'suffix' => 'kuis',
                'description' => 'Evaluasi pembelajaran yang tersedia',
                'accent' => 'purple',
            ],
        ];

        $materialsShowcase = Schema::hasTable('materials')
            ? Material::query()
                ->latest('id')
                ->take(3)
                ->get()
                ->map(function (Material $material) {
                    return [
                        'title' => $material->title,
                        'subject' => $material->subject,
                        'level' => $material->level,
                        'thumbnail' => $material->thumbnail_asset,
                        'link' => route('tutor.materials.edit', ['material' => $material->slug]),
                    ];
                })
            : collect();

        $quizShowcase = Schema::hasTable('quizzes')
            ? Quiz::query()
                ->latest('id')
                ->take(3)
                ->get()
                ->map(function (Quiz $quiz) {
                    return [
                        'title' => $quiz->title,
                        'subject' => $quiz->subject,
                        'level' => $quiz->class_level,
                        'thumbnail' => $quiz->thumbnail_asset,
                        'link' => route('tutor.quizzes.edit', ['quiz' => $quiz->slug]),
                    ];
                })
            : collect();

        $quickActions = [
            [
                'label' => 'Buat Materi Baru',
                'description' => 'Susun modul dan sumber belajar terkini.',
                'href' => route('tutor.materials.create'),
            ],
            [
                'label' => 'Jadwalkan Sesi',
                'description' => 'Tambahkan pertemuan ke kalender belajar.',
                'href' => route('tutor.schedule.index'),
            ],
            [
                'label' => 'Rancang Quiz',
                'description' => 'Siapkan evaluasi untuk siswa.',
                'href' => route('tutor.quizzes.create'),
            ],
        ];

        return $this->render('tutor.dashboard', [
            'stats' => $stats,
            'todaySessions' => $todaySessions,
            'nextSessions' => $nextSessions,
            'todayLabel' => $today->locale('id')->translatedFormat('l, d F Y'),
            'totalStudentsToday' => $totalStudentsToday,
            'teachingHours' => $teachingHours,
            'highlightStats' => $highlightStats,
            'materialsShowcase' => $materialsShowcase,
            'quizShowcase' => $quizShowcase,
            'quickActions' => $quickActions,
        ]);
    }
}
