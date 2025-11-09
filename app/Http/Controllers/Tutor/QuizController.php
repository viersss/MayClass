<?php

namespace App\Http\Controllers\Tutor;

use App\Models\Quiz;
use App\Support\UnsplashPlaceholder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends BaseTutorController
{
    public function index(Request $request)
    {
        $search = (string) $request->input('q', '');

        $quizzes = Quiz::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('title', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%")
                        ->orWhere('class_level', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('created_at')
            ->get();

        return $this->render('tutor.quizzes.index', [
            'quizzes' => $quizzes,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return $this->render('tutor.quizzes.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:120'],
            'class_level' => ['required', 'string', 'max:120'],
            'summary' => ['required', 'string'],
            'link_url' => ['required', 'url', 'max:255'],
        ]);

        $slug = Str::slug($data['title']) ?: 'quiz-' . Str::random(6);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Quiz::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }

        Quiz::create([
            'slug' => $uniqueSlug,
            'subject' => $data['subject'],
            'class_level' => $data['class_level'],
            'title' => $data['title'],
            'summary' => $data['summary'],
            'link_url' => $data['link_url'],
            'thumbnail_url' => UnsplashPlaceholder::quiz($data['subject']),
            'duration_label' => '45 Menit',
            'question_count' => 20,
        ]);

        return redirect()
            ->route('tutor.quizzes.index')
            ->with('status', __('Quiz baru berhasil dibuat.'));
    }

    public function edit(Quiz $quiz)
    {
        return $this->render('tutor.quizzes.edit', [
            'quiz' => $quiz,
        ]);
    }

    public function update(Request $request, Quiz $quiz): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:120'],
            'class_level' => ['required', 'string', 'max:120'],
            'summary' => ['required', 'string'],
            'link_url' => ['required', 'url', 'max:255'],
        ]);

        $payload = [
            'subject' => $data['subject'],
            'class_level' => $data['class_level'],
            'title' => $data['title'],
            'summary' => $data['summary'],
            'link_url' => $data['link_url'],
        ];

        if ($quiz->subject !== $data['subject']) {
            $payload['thumbnail_url'] = UnsplashPlaceholder::quiz($data['subject']);
        }

        $quiz->update($payload);

        return redirect()
            ->route('tutor.quizzes.index')
            ->with('status', __('Quiz berhasil diperbarui.'));
    }
}
