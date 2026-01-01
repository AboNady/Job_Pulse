<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
        // Arrange: create a user
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        // Act: attempt login
        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ]);

        // Assert: user is authenticated
        $this->assertAuthenticatedAs($user);

        $response->assertRedirect(route('dashboard'));

    }
}
