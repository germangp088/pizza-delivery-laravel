<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingFeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->seed();

        $response = $this->get('/shipping_fee');
        $response
        ->assertStatus(200)
        ->assertJsonStructure(['shippingFees'=>[['id', 'shipping_fee', 'created_at', 'updated_at']]])
        ->assertExactJson(
            ['shippingFees'=>[['id' => 1, 'shipping_fee' => '1.99' , 'created_at' => null, 'updated_at' => null]],
        ]);
    }
}
