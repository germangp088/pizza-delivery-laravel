<?php

namespace App\Http\Controllers;

use App\Product;

class ProductController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $products = Product::all();
        $productList =  array('products' => $products);
        return response()->json($productList);
    }
}
