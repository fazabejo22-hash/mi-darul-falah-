<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_admin_panel(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_regular_student_cannot_access_admin_panel(): void
    {
        $student = User::factory()->create();
        $student->assignRole('Siswa');

        $response = $this->actingAs($student)->get('/admin');
        $response->assertForbidden();
    }

    public function test_super_admin_can_access_admin_panel(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }
}
