<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_profile(): void
    {
        $this->get(route('student.profile'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_student_can_view_profile(): void
    {
        $studentId = 'MC-' . str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::factory()->create([
            'role' => 'student',
            'student_id' => $studentId,
            'phone' => '081234567890',
            'gender' => 'male',
            'parent_name' => 'Budi Santoso',
            'address' => 'Jl. Contoh No. 1',
        ]);

        $this->actingAs($user)
            ->get(route('student.profile'))
            ->assertOk()
            ->assertSeeText('Edit Profil')
            ->assertSee($studentId, false);
    }
}
