<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Support\SubjectPalette;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

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

    public function show(string $slug): View
    {
        if (! Schema::hasTable('materials')) {
            abort(404);
        }

        $objectivesReady = Schema::hasTable('material_objectives');
        $chaptersReady = Schema::hasTable('material_chapters');

        $material = Material::query()
            ->where('slug', $slug)
            ->when($objectivesReady, fn ($query) => $query->with('objectives'))
            ->when($chaptersReady, fn ($query) => $query->with('chapters'))
            ->firstOrFail();

        $resourceUrl = $material->resource_url ?: $this->materialsLink();

        $chapters = $chaptersReady
            ? $material->chapters->map(fn ($chapter) => [
                'title' => $chapter->title,
                'description' => $chapter->description,
            ])->values()->all()
            : [];

        $objectives = $objectivesReady
            ? $material->objectives->pluck('description')->filter()->values()->all()
            : [];

        return view('student.materials.show', [
            'page' => 'materials',
            'title' => $material->title,
            'material' => [
                'subject' => $material->subject,
                'level' => $material->level,
                'title' => $material->title,
                'summary' => $material->summary,
                'thumbnail' => $material->thumbnail_asset,
                'objectives' => $objectives,
                'chapters' => $chapters,
                'resource_url' => $resourceUrl,
                'download_label' => pathinfo($material->resource_path ?? '', PATHINFO_EXTENSION)
                    ? strtoupper(pathinfo($material->resource_path, PATHINFO_EXTENSION))
                    : 'PDF',
            ],
            'materialsLink' => $this->materialsLink(),
        ]);
    }

    private function materialsLink(): string
    {
        return (string) config('mayclass.links.materials_drive');
    }
}
