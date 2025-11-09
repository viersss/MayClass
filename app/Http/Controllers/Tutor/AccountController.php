<?php

namespace App\Http\Controllers\Tutor;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AccountController extends BaseTutorController
{
    public function edit()
    {
        return $this->render('tutor.account.index');
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
        ]);

        if ($tutor) {
            $tutor->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
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
                ]
            );
        }

        return redirect()
            ->route('tutor.account.edit')
            ->with('status', __('Profil tutor berhasil diperbarui.'));
    }
}
