<?php

namespace App\Http\Controllers;

use App\ShippingFee;

class ShippingFeeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $shippingFee = ShippingFee::all()->first();
        return response()->json($shippingFee);
    }
}
