<?php

namespace Tests\Feature;

use App\Models\SchoolProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MigrationAndSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_migrations_and_seeders_run_successfully(): void
    {
        $this->seed();

        $this->assertDatabaseHas('school_profiles', [
            'npsn' => '69881899',
            'name' => 'MI Darul Falah',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'admin@darulfalah.sch.id',
        ]);

        $admin = User::where('email', 'admin@darulfalah.sch.id')->first();
        $this->assertTrue($admin->hasRole('Super Admin'));
    }
}
