<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = Auth::user();

        return view('student.profile', [
            'profile' => [
                'name' => $user->name,
                'email' => $user->email,
                'studentId' => $user->student_id,
                'phone' => $user->phone,
                'gender' => $user->gender,
                'genderLabel' => $this->translateGender($user->gender),
                'parentName' => $user->parent_name,
                'address' => $user->address,
            ],
            'genderOptions' => $this->genderOptions(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'gender' => ['nullable', Rule::in(array_keys($this->genderOptions()))],
            'parent_name' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        $user->forceFill([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'gender' => $data['gender'] ?? null,
            'parent_name' => $data['parent_name'] ?? null,
            'address' => $data['address'] ?? null,
        ])->save();

        return redirect()
            ->route('student.profile')
            ->with('status', 'Profil berhasil diperbarui.');
    }

    private function translateGender(?string $gender): ?string
    {
        return match ($gender) {
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
            'other' => 'Lainnya',
            default => null,
        };
    }

    private function genderOptions(): array
    {
        return [
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
            'other' => 'Lainnya',
        ];
    }
}
