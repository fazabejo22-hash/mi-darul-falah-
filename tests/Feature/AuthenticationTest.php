<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Filament\Pages\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RolePermissionSeeder::class);
    }

    public function test_filament_login_page_can_be_rendered(): void
    {
        $this->get('/admin/login')->assertStatus(200);
    }

    public function test_users_can_authenticate_via_filament_livewire_login(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);
        $user->assignRole('Super Admin');

        Livewire::test(Login::class)
            ->set('data.email', $user->email)
            ->set('data.password', 'password123')
            ->call('authenticate')
            ->assertHasNoErrors()
            ->assertRedirect('/admin');

        $this->assertAuthenticatedAs($user);
    }

    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);
        $user->assignRole('Super Admin');

        Livewire::test(Login::class)
            ->set('data.email', $user->email)
            ->set('data.password', 'wrong-password')
            ->call('authenticate')
            ->assertHasErrors(['data.email']);

        $this->assertGuest();
    }
}
