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

        $materialsReady = Schema::hasTable('materials');
        $chaptersReady = Schema::hasTable('material_chapters');
        $objectivesReady = Schema::hasTable('material_objectives');

        if (! $materialsReady) {
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

        $materials = Material::query()
            ->when($objectivesReady, fn ($query) => $query->withCount('objectives'))
            ->when($chaptersReady, fn ($query) => $query->withCount('chapters'))
            ->orderBy('subject')
            ->orderBy('title')
            ->get();

        $collections = $materials
            ->groupBy('subject')
            ->map(function ($items, $subject) use ($materialsLink, $chaptersReady, $objectivesReady) {
                return [
                    'label' => $subject,
                    'accent' => SubjectPalette::accent($subject),
                    'items' => $items->map(fn ($material) => [
                        'slug' => $material->slug,
                        'level' => $material->level,
                        'title' => $material->title,
                        'summary' => $material->summary,
                        'resource' => $material->resource_url ?? $materialsLink,
                        'chapter_count' => $chaptersReady ? (int) $material->chapters_count : 0,
                        'objective_count' => $objectivesReady ? (int) $material->objectives_count : 0,
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
