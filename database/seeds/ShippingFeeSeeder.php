<?php

use Illuminate\Database\Seeder;

class ShippingFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_fees')->insert([
            'shipping_fee' => '1.99'
        ]);
    }
}
