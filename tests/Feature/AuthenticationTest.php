<?php

namespace Tests\Feature;

use App\Http\Requests\RegisterRequest;
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


}
