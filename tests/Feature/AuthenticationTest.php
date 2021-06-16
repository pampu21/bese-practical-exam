<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessLogin()
    {
        User::factory()->create([
            'email' => 'backend@multisyscorp.com',
            'email_verified_at' => now(),
            'password' => 'asdqwe123'
        ]);
        $userData = [
            'email' => 'backend@multisyscorp.com',
            'password' => 'asdqwe123'
        ];

        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'email',
                    'email_verified_at',
                    'deleted_at',
                    'created_at',
                    'updated_at'
                ],
                'token',
            ]);

        // $this->assertAuthenticated();
    }

    public function testFailedLogin()
    {
        $userData = [
            'email' => 'backend21@multisyscorp.com',
            'password' => 'asdqwe12345'
        ];

        $this->json('POST', 'api/login', $userData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                'message' => 'Invalid credentials'
            ]);
    }
}
