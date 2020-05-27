<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CurrencyTest extends TestCase
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
        $response = $this->get('/currency');
        $response
        ->assertStatus(200)
        ->assertJsonStructure(['currencies'=>[['id', 'symbol', 'currency', 'created_at', 'updated_at']]])
        ->assertExactJson(
            ['currencies'=>[['id' => 1, 'symbol' => '€', 'currency' => "Euro" , 'created_at' => null, 'updated_at' => null],
            ['id' => 2, 'symbol' => "$", 'currency' => "US$" , 'created_at' => null, 'updated_at' => null]],
        ]);
    }
}
