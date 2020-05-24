<?php

namespace App\Http\Controllers;

use App\Currency;

class CurrencyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $currencies = Currency::all();
        $currencyList =  array('currencies' => $currencies);
        return json_encode($currencyList);
    }
}
