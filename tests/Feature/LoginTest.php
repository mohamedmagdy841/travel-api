<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_login_returns_token_with_valid_credentials(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);


        $response->assertStatus(200);
        $response->assertJsonPath('data.access_token', fn($token) => !empty($token));
    }

    public function test_login_returns_error_with_invalid_credentials(): void
    {

        $response = $this->postJson('/api/v1/login', [
            'email' => 'nonexistent@email.com',
            'password' => 'password',
        ]);

        $response->assertStatus(422);
    }
}
