<?php

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            'name' => 'Pizza'
        ]);
        DB::table('product_types')->insert([
            'name' => 'Dessert'
        ]);
        DB::table('product_types')->insert([
            'name' => 'Drink'
        ]);
    }
}
