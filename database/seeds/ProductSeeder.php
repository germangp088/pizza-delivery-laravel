<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Mozzarella',
            'description' => 'Classic mozzarella pizza with olive oil. Ingredients: mozzarella, olive oil and oregano.',
            'image' => '0.jpg',
            'price' => '4.25'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Napoletana',
            'description' => 'Napoletana is one of the most traditional italian pizza, it was born in Napoles. Ingredients: tomato sauce, garlic and oregano.',
            'image' => '1.jpg',
            'price' => '5.99'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Marinara',
            'description' => 'Pizza with salsa Marinara. Ingredients: tomato sauce, garlic and oregano.',
            'image' => '2.jpg',
            'price' => '7'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Romana',
            'description' => 'Crispy and toast pizza, is the crunchy one. Ingredients: tomato sauce, mozzarella, anchovies.',
            'image' => '3.jpg',
            'price' => '5.99'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Siciliana',
            'description' => 'This pizza has a thick crust with a fluffy, sponge-like consistency. Ingredients: tomato sauce, mozzarella, capers, anchovies, olives.',
            'image' => '4.jpg',
            'price' => '7.45'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Quattro formaggi',
            'description' => 'Amazing pizza made with 4 cheeses. Ingredients: mozzarella, fontina, gorgonzola and parmigiano.',
            'image' => '5.jpg',
            'price' => '8'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Tirolese ',
            'description' => 'Since speck is a speciality from South Tirol, this pizza is called Tirolese. Ingredients: tomato sauce, mozzarella, speck (smoked, cured ham).',
            'image' => '6.jpg',
            'price' => '2.10'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '1',
            'name' => 'Prosciutto e funghi',
            'description' => 'Delicious pizza with mushroom taste mixed up with ham. Ingredients: tomato sauce, mozzarella, ham, mushrooms.',
            'image' => '7.jpg',
            'price' => '2.10'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '2',
            'name' => 'Gelato',
            'description' => 'Vanilla, chocolatte, strawberry.',
            'image' => '8.jpg',
            'price' => '1.9'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '2',
            'name' => 'Cannoli',
            'description' => 'Cannoli consist of tube-shaped shells of fried pastry dough, filled with a sweet, creamy filling usually containing ricotta.',
            'image' => '9.jpg',
            'price' => '3'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '2',
            'name' => 'Tiramisu',
            'description' => 'It is made of ladyfingers (savoiardi) dipped in coffee, layered with a whipped mixture of eggs, sugar and mascarpone cheese, flavoured with cocoa.',
            'image' => '10.jpg',
            'price' => '3'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '3',
            'name' => 'Heineken',
            'description' => '1l',
            'image' => '11.jpg',
            'price' => '4.5'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '3',
            'name' => 'Coke',
            'description' => '0.5l',
            'image' => '12.jpg',
            'price' => '2.5'
        ]);
        DB::table('products')->insert([
            'id_product_type' => '3',
            'name' => 'Succo di arance',
            'description' => '1l',
            'image' => '13.jpg',
            'price' => '1.99'
        ]);
    }
}
