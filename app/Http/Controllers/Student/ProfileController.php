<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
                'gender' => $this->translateGender($user->gender),
                'parentName' => $user->parent_name,
                'address' => $user->address,
            ],
        ]);
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
}
