<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Support\SubjectPalette;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $materialsLink = (string) config('mayclass.links.materials_drive');
        $quizLink = (string) config('mayclass.links.quiz_platform');

        if (! Schema::hasTable('materials')) {
            return view('student.materials.index', [
                'page' => 'materials',
                'title' => 'Materi Pembelajaran',
                'collections' => collect(),
                'stats' => [
                    'total' => 0,
                    'subjects' => 0,
                    'levels' => [],
                ],
                'materialsLink' => $materialsLink,
                'quizLink' => $quizLink,
            ]);
        }

        $materials = Material::withCount(['objectives', 'chapters'])
            ->orderBy('subject')
            ->orderBy('title')
            ->get();

        $collections = $materials
            ->groupBy('subject')
            ->map(function ($items, $subject) use ($materialsLink) {
                return [
                    'label' => $subject,
                    'accent' => SubjectPalette::accent($subject),
                    'items' => $items->map(fn ($material) => [
                        'slug' => $material->slug,
                        'level' => $material->level,
                        'title' => $material->title,
                        'summary' => $material->summary,
                        'resource' => $material->resource_url ?? $materialsLink,
                        'chapter_count' => $material->chapters_count,
                        'objective_count' => $material->objectives_count,
                    ])->values()->all(),
                ];
            })
            ->values();

        $stats = [
            'total' => $materials->count(),
            'subjects' => $collections->count(),
            'levels' => $materials->pluck('level')->filter()->unique()->values()->all(),
        ];

        return view('student.materials.index', [
            'page' => 'materials',
            'title' => 'Materi Pembelajaran',
            'collections' => $collections,
            'stats' => $stats,
            'materialsLink' => $materialsLink,
            'quizLink' => $quizLink,
        ]);
    }

    public function show(string $slug): RedirectResponse
    {
        return redirect()->away($this->materialsLink());
    }

    private function materialsLink(): string
    {
        return (string) config('mayclass.links.materials_drive');
    }
}
