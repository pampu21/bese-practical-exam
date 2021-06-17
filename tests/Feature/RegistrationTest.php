<?php

namespace Tests\Feature;

use App\Mail\Registration;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegisterGuest()
    {
        Mail::fake();
        $userData = [
            'email' => 'emai@gmail.com',
            'password' => 'asdqwe123'
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'email'
                ],
                'msg'
            ]);

        Mail::assertQueued(Registration::class);
    }

    public function testRegisterEmailTaken(){
        User::factory()->create([
                    'email' => 'test@gmail.com',
                    'password' => bcrypt('asdqwe123')
                ]);
        $userData = [
            'email' => 'test@gmail.com',
            'password' => 'asdqwe123'
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'email' => ['The email has already been taken.']
            ]);
    }

}
