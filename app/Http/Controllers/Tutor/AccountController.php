<?php

namespace App\Http\Controllers\Tutor;

use App\Support\AvatarResolver;
use App\Support\AvatarUploader;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AccountController extends BaseTutorController
{
    public function edit()
    {
        $tutor = Auth::user();
        $tutor?->loadMissing('tutorProfile');

        $avatarUrl = $tutor
            ? AvatarResolver::resolve([
                optional($tutor->tutorProfile)->avatar_path,
                $tutor->avatar_path,
            ])
            : null;

        return $this->render('tutor.account.index', [
            'avatarUrl' => $avatarUrl,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $tutor = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($tutor?->id)],
            'phone' => ['nullable', 'string', 'max:40'],
            'specializations' => ['required', 'string', 'max:255'],
            'experience_years' => ['required', 'integer', 'min:0', 'max:60'],
            'education' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($tutor) {
            $avatarPath = $tutor->avatar_path;

            if ($request->hasFile('avatar')) {
                try {
                    $avatarPath = AvatarUploader::store(
                        $request->file('avatar'),
                        [
                            $tutor->avatar_path,
                            optional($tutor->tutorProfile)->avatar_path,
                        ]
                    );
                } catch (\Throwable $exception) {
                    report($exception);

                    return back()
                        ->withInput($request->except('avatar'))
                        ->withErrors(['avatar' => __('Gagal mengunggah foto profil. Silakan coba lagi.')]);
                }
            }

            $tutor->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'avatar_path' => $avatarPath,
            ]);

            $profile = $tutor->tutorProfile;
            $slug = optional($profile)->slug ?? (Str::slug($tutor->name) ?: 'tutor-' . $tutor->id);

            $tutor->tutorProfile()->updateOrCreate(
                ['user_id' => $tutor->id],
                [
                    'slug' => $slug,
                    'specializations' => $data['specializations'],
                    'experience_years' => $data['experience_years'],
                    'education' => $data['education'] ?? null,
                    'avatar_path' => $avatarPath,
                ]
            );
        }

        return redirect()
            ->route('tutor.account.edit')
            ->with('status', __('Profil tutor berhasil diperbarui.'));
    }
}
