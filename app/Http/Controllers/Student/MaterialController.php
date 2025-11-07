<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;

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
        $collections = Schema::hasTable('materials')
            ? Material::with('objectives', 'chapters')
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
                ->values()
            : collect();

        return view('student.materials.index', ['collections' => $collections]);
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
