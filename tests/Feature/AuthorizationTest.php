<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_guest_cannot_access_admin_panel(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_student_role_is_denied_from_admin_panel(): void
    {
        $student = User::factory()->create();
        $student->assignRole('Siswa');

        $response = $this->actingAs($student)->get('/admin');
        $this->assertTrue($response->isForbidden() || $response->isRedirect());
    }

    public function test_super_admin_can_access_admin_panel(): void
    {
        $admin = User::factory()->create();
        $admin->assignRole('Super Admin');

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_inactive_super_admin_is_denied_from_admin_panel(): void
    {
        $admin = User::factory()->create([
            'is_active' => false,
        ]);
        $admin->assignRole('Super Admin');

        $response = $this->actingAs($admin)->get('/admin');
        $this->assertTrue($response->isForbidden() || $response->isRedirect());
    }

    public function test_password_is_properly_hashed(): void
    {
        $user = User::factory()->create([
            'password' => 'secret123',
        ]);

        $this->assertNotEquals('secret123', $user->password);
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('secret123', $user->password));
    }
}
