<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_renders_successfully(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Command Center', false);
        $response->assertSee('Staff & Admin Access', false);
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $admin = User::create([
            'name' => 'Munthasir Rahman',
            'email' => 'admin@famewoven.com',
            'password' => Hash::make('Famewoven2026!'),
            'role' => User::ROLE_SUPER_ADMIN,
            'status' => 'active',
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@famewoven.com',
            'password' => 'Famewoven2026!',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin);

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $admin->id,
            'event' => 'auth.login',
        ]);
    }

    public function test_login_fails_with_invalid_password_and_logs_failure(): void
    {
        User::create([
            'name' => 'Munthasir Rahman',
            'email' => 'admin@famewoven.com',
            'password' => Hash::make('Famewoven2026!'),
            'role' => User::ROLE_SUPER_ADMIN,
            'status' => 'active',
        ]);

        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => 'admin@famewoven.com',
            'password' => 'WrongPassword!',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();

        $this->assertDatabaseHas('activity_logs', [
            'event' => 'auth.failed',
        ]);
    }

    public function test_suspended_user_cannot_login(): void
    {
        User::create([
            'name' => 'Suspended Staff',
            'email' => 'suspended@famewoven.com',
            'password' => Hash::make('Famewoven2026!'),
            'role' => User::ROLE_EDITOR,
            'status' => 'suspended',
        ]);

        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => 'suspended@famewoven.com',
            'password' => 'Famewoven2026!',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_register_page_renders_successfully(): void
    {
        $response = $this->get('/admin/register');
        $response->assertStatus(200);
        $response->assertSee('Staff Registration', false);
    }

    public function test_new_user_can_register_and_is_authenticated(): void
    {
        $response = $this->post('/admin/register', [
            'name' => 'New Editor',
            'email' => 'neweditor@famewoven.com',
            'password' => 'Famewoven2026!',
            'password_confirmation' => 'Famewoven2026!',
        ]);

        $response->assertRedirect('/admin/dashboard');

        $this->assertDatabaseHas('users', [
            'email' => 'neweditor@famewoven.com',
            'role' => User::ROLE_SUPER_ADMIN, // first user in fresh test DB is super_admin
        ]);

        $this->assertAuthenticated();

        $this->assertDatabaseHas('activity_logs', [
            'event' => 'auth.register',
        ]);
    }

    public function test_user_can_logout(): void
    {
        $user = User::create([
            'name' => 'Editor User',
            'email' => 'editor@famewoven.com',
            'password' => Hash::make('Famewoven2026!'),
            'role' => User::ROLE_EDITOR,
            'status' => 'active',
        ]);

        $response = $this->actingAs($user)->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();

        $this->assertDatabaseHas('activity_logs', [
            'user_id' => $user->id,
            'event' => 'auth.logout',
        ]);
    }
}
