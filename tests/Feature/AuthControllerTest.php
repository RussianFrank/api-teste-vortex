<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_success_create_user_and_auth_with_token_in_login_route()
    {
        $user = User::factory()->create();

        $payload = [
            'email' => $user->email,
            'password' => 'password',
        ];

        $response = $this->post(route('v1.auth.autenticar'), $payload);

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fails_when_user_send_not_valid_auth_credentials_to_login_route()
    {
        $payload = [
            'email' => 'email@invalido.com',
            'password' => 'senha-invalida',
        ];

        $response = $this->post(route('v1.auth.autenticar'), $payload);

        $response->assertStatus(401);
    }
}
