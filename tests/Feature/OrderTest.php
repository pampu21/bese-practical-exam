<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessOrder()
    {
        $user = User::factory()->create([
            'email' => 'backend@multisyscorp.com',
            'email_verified_at' => now(),
            'password' => 'asdqwe123'
        ]);
        $orderData = [
            'product_id' => 1,
            'quantity' => 1
        ];
        $this->actingAs($user,'api_user');

        $this->json('POST', 'api/order',$orderData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'message' => 'You have successfully ordered this product'
            ]);
    }
    public function testFailedOrder()
    {
        $user = User::factory()->create([
            'email' => 'backend@multisyscorp.com',
            'email_verified_at' => now(),
            'password' => 'asdqwe123'
        ]);
        $orderData = [
            'product_id' => 1,
            'quantity' => 999
        ];
        $this->actingAs($user,'api_user');

        $this->json('POST', 'api/order',$orderData, ['Accept' => 'application/json'])
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Failed to order this product due to unavailability of stock'
            ]);
    }
}
