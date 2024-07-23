<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_that_a_guest_can_register()
    {
        $this->post('/api/register', [
            'name' => "fares",
            'email' => "fares@fares.com",
            'password' => "password",
            'password_confirmation' => "password",
        ]);

        $this->assertDatabaseCount('users', 1);
    }


    public function test_that_a_user_can_login()
    {
        $user = User::factory()->create();
        $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_that_authenticated_user_cannot_access_auth_endpoints()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response->assertRedirect();

        $response = $this->post('/api/register', [
            'name' => "fares",
            'email' => "fares@fares.com",
            'password' => "password",
            'password_confirmation' => "password",
        ]);
        $response->assertRedirect();

    }

    public function test_that_user_can_logout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->post('/api/logout');
        $this->assertGuest();
    }

}
