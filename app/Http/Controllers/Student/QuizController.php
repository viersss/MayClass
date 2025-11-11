<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Support\SubjectPalette;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $materialsLink = (string) config('mayclass.links.materials_drive');
        $quizLink = (string) config('mayclass.links.quiz_platform');

        if (! Schema::hasTable('quizzes')) {
            return view('student.quiz.index', [
                'page' => 'quiz',
                'title' => 'Koleksi Quiz',
                'collections' => collect(),
                'stats' => [
                    'total' => 0,
                    'total_questions' => 0,
                    'levels' => [],
                ],
                'materialsLink' => $materialsLink,
                'quizLink' => $quizLink,
            ]);
        }

        $quizzes = Quiz::with(['levels' => fn ($query) => $query->orderBy('position')])
            ->orderBy('subject')
            ->orderBy('title')
            ->get();

        $collections = $quizzes
            ->groupBy('subject')
            ->map(function ($items, $subject) use ($quizLink) {
                return [
                    'label' => $subject,
                    'accent' => SubjectPalette::accent($subject),
                    'items' => $items->map(fn ($quiz) => [
                        'slug' => $quiz->slug,
                        'title' => $quiz->title,
                        'summary' => $quiz->summary,
                        'duration' => $quiz->duration_label,
                        'questions' => $quiz->question_count,
                        'levels' => $quiz->levels->pluck('label')->all(),
                        'link' => $quiz->link ?? $quizLink,
                    ])->values()->all(),
                ];
            })
            ->values();

        $stats = [
            'total' => $quizzes->count(),
            'total_questions' => $quizzes->sum(fn ($quiz) => (int) $quiz->question_count),
            'levels' => $quizzes->pluck('class_level')->merge($quizzes->flatMap(fn ($quiz) => $quiz->levels->pluck('label')))
                ->filter()
                ->unique()
                ->values()
                ->all(),
        ];

        return view('student.quiz.index', [
            'page' => 'quiz',
            'title' => 'Koleksi Quiz',
            'collections' => $collections,
            'stats' => $stats,
            'materialsLink' => $materialsLink,
            'quizLink' => $quizLink,
        ]);
    }

    public function show(string $slug): RedirectResponse
    {
        return redirect()->away($this->quizLink());
    }

    private function quizLink(): string
    {
        return (string) config('mayclass.links.quiz_platform');
    }
}
