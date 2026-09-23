<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardLoginTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_dashboard_redirects_guests_to_login(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_sign_in_with_valid_credentials(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('valid-password'),
        ]);

        $response = $this->post(route('dashboard.login.store'), [
            'email' => $user->email,
            'password' => 'valid-password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_rejects_invalid_credentials(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('valid-password'),
        ]);

        $response = $this->from(route('login'))->post(route('dashboard.login.store'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect(route('login'));
        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
