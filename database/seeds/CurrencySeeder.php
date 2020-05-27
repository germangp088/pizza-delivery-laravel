<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'currency' => 'Euro',
            'symbol' => '€'
        ]);
        DB::table('currencies')->insert([
            'currency' => 'US$',
            'symbol' => '$'
        ]);
    }
}
