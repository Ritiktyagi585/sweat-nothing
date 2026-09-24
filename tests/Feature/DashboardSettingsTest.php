<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardSettingsTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_guest_is_redirected_from_settings(): void
    {
        $response = $this->get(route('dashboard.settings'));

        $response->assertRedirect(route('login'));
    }

    public function test_administrator_can_update_profile_information(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('current-password'),
        ]);

        $response = $this->actingAs($user)->patch(route('dashboard.settings.update'), [
            'name' => 'Updated Admin',
            'email' => 'updated-admin@example.com',
            'phone' => '9876543210',
        ]);

        $response->assertRedirect(route('dashboard.settings'));
        $response->assertSessionHas('success', 'Settings saved successfully.');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Admin',
            'email' => 'updated-admin@example.com',
            'phone' => '9876543210',
        ]);
    }

    public function test_administrator_can_change_password_with_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('current-password'),
        ]);

        $response = $this->actingAs($user)->patch(route('dashboard.settings.update'), [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => '',
            'current_password' => 'current-password',
            'password' => 'updated-password',
            'password_confirmation' => 'updated-password',
        ]);

        $response->assertRedirect(route('dashboard.settings'));
        $this->assertTrue(Hash::check('updated-password', $user->fresh()->password));
    }

    public function test_password_change_requires_the_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('current-password'),
        ]);

        $response = $this->actingAs($user)
            ->from(route('dashboard.settings'))
            ->patch(route('dashboard.settings.update'), [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => '',
                'current_password' => 'incorrect-password',
                'password' => 'updated-password',
                'password_confirmation' => 'updated-password',
            ]);

        $response->assertRedirect(route('dashboard.settings'));
        $response->assertSessionHasErrors('current_password');
        $this->assertTrue(Hash::check('current-password', $user->fresh()->password));
    }
}
