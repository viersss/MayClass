<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Quiz;

class QuizController extends Controller
{
    private const SUBJECT_ACCENTS = [
        'Matematika' => '#37b6ad',
        'Kimia' => '#5f6af8',
        'Bahasa Inggris' => '#f1a82e',
        'SD Terpadu' => '#8e65d4',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $collections = Quiz::with(['levels', 'takeaways'])
            ->orderBy('subject')
            ->get()
            ->groupBy('subject')
            ->map(function ($quizzes, $subject) {
                return [
                    'label' => $subject,
                    'accent' => self::SUBJECT_ACCENTS[$subject] ?? '#37b6ad',
                    'items' => $quizzes->map(fn ($quiz) => [
                        'slug' => $quiz->slug,
                        'title' => $quiz->title,
                        'summary' => $quiz->summary,
                        'duration' => $quiz->duration_label,
                        'questions' => $quiz->question_count,
                        'levels' => $quiz->levels->sortBy('position')->pluck('label')->all(),
                    ])->values()->all(),
                ];
            })
            ->values();

        return view('student.quiz.index', ['collections' => $collections]);
    }

    public function show(string $slug)
    {
        $quiz = Quiz::with(['levels', 'takeaways'])->where('slug', $slug)->firstOrFail();

        return view('student.quiz.show', [
            'quiz' => [
                'slug' => $quiz->slug,
                'title' => $quiz->title,
                'summary' => $quiz->summary,
                'thumbnail' => $quiz->thumbnail_asset,
                'duration' => $quiz->duration_label,
                'questions' => $quiz->question_count,
                'levels' => $quiz->levels->sortBy('position')->pluck('label')->all(),
                'takeaways' => $quiz->takeaways->sortBy('position')->map(fn ($takeaway) => $takeaway->description)->all(),
            ],
        ]);
    }
}
