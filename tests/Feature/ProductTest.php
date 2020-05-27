<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetProducts()
    {
        $this->seed();
        $response = $this->get('/product');
        $response->assertStatus(200)
        ->assertJsonStructure(['products'=>[['id', 'product_type', 'name', 'description', 'image', 'price',]]]);
        $resultMock = json_decode(json_encode('{"products":[{""description":"0.5l.","id":13,"product_type":"Drink","image":"12.png","name":"Coke","price":"2.5"},{""description":"0.5l.","id":14,"product_type":"Drink","image":"13.png","name":"Orange Juice","price":"1.99"},{""description":"1l.","id":12,"product_type":"Drink","image":"11.png","name":"Heineken","price":"4.5"},{""description":"Amazing pizza made with 4 cheeses. Ingredients: mozzarella, fontina, gorgonzola and parmigiano.","id":6,"product_type":"Pizza","image":"5.png","name":"Quattro formaggi","price":"8.0"},{""description":"Cannoli consist of tube-shaped shells of fried pastry dough, filled with a sweet, creamy filling usually containing ricotta.","id":10,"product_type":"Dessert","image":"9.png","name":"Cannoli","price":"3.0"},{""description":"Classic mozzarella pizza with olive oil. Ingredients: mozzarella, olive oil and oregano.","id":1,"product_type":"Pizza","image":"0.jpg","name":"Mozzarella","price":"4.25"},{""description":"Crispy and toast pizza, is the crunchy one. Ingredients: tomato sauce, mozzarella, anchovies.","id":4,"product_type":"Pizza","image":"3.png","name":"Romana","price":"5.99"},{""description":"Delicious pizza with mushroom taste mixed up with ham. Ingredients: tomato sauce, mozzarella, ham, mushrooms.","id":8,"product_type":"Pizza","image":"7.png","name":"Prosciutto e funghi","price":"2.1"},{""description":"It is made of ladyfingers (savoiardi) dipped in coffee, layered with a whipped mixture of eggs, sugar and mascarpone cheese, flavoured with cocoa.","id":11,"product_type":"Dessert","image":"10.png","name":"Tiramisu","price":"3.0"},{""description":"Napoletana is one of the most traditional italian pizza, it was born in Napoles. Ingredients: tomato sauce, garlic and oregano.","id":2,"product_type":"Pizza","image":"1.jpg","name":"Napoletana","price":"5.99"},{""description":"Pizza with salsa Marinara. Ingredients: tomato sauce, garlic and oregano.","id":3,"product_type":"Pizza","image":"2.jpg","name":"Marinara","price":"7.0"},{""description":"Since speck is a speciality from South Tirol, this pizza is called Tirolese. Ingredients: tomato sauce, mozzarella, speck (smoked, cured ham).","id":7,"product_type":"Pizza","image":"6.png","name":"Tirolese ","price":"2.1"},{""description":"This pizza has a thick crust with a fluffy, sponge-like consistency. Ingredients: tomato sauce, mozzarella, capers, anchovies, olives.","id":5,"product_type":"Pizza","image":"4.png","name":"Siciliana","price":"7.45"},{""description":"Vanilla, chocolatte, strawberry.","id":9,"product_type":"Dessert","image":"8.png","name":"Ice cream","price":"1.9"}]}'));
        $result = json_encode($response->json());
        $this->assertTrue((int)( $result == $resultMock ) == 0);
    }
}
