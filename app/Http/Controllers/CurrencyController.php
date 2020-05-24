<?php

namespace App\Http\Controllers;

use App\Currency;

class CurrencyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $currencies = Currency::all();
        $currencyList =  array('currencies' => $currencies);
        return response()->json($currencyList);
    }
}
