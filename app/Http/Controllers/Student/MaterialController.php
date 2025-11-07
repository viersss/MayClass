<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;

class MaterialController extends Controller
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
        $collections = Material::with('objectives', 'chapters')
            ->orderBy('subject')
            ->get()
            ->groupBy('subject')
            ->map(function ($materials, $subject) {
                return [
                    'label' => $subject,
                    'accent' => self::SUBJECT_ACCENTS[$subject] ?? '#37b6ad',
                    'items' => $materials->map(fn ($material) => [
                        'slug' => $material->slug,
                        'level' => $material->level,
                        'title' => $material->title,
                        'summary' => $material->summary,
                    ])->values()->all(),
                ];
            })
            ->values();

        return view('student.materials.index', ['collections' => $collections]);
    }

    public function show(string $slug)
    {
        $material = Material::with(['objectives', 'chapters'])->where('slug', $slug)->firstOrFail();

        return view('student.materials.show', [
            'material' => [
                'slug' => $material->slug,
                'subject' => $material->subject,
                'title' => $material->title,
                'level' => $material->level,
                'summary' => $material->summary,
                'thumbnail' => $material->thumbnail_url,
                'objectives' => $material->objectives
                    ->sortBy('position')
                    ->map(fn ($objective) => $objective->description)
                    ->values()
                    ->all(),
                'chapters' => $material->chapters
                    ->sortBy('position')
                    ->map(fn ($chapter) => [
                        'title' => $chapter->title,
                        'description' => $chapter->description,
                    ])
                    ->values()
                    ->all(),
            ],
        ]);
    }
}
