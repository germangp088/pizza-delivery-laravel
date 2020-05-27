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
        $products = Product::select('products.id', 'products.name', 'product_types.name as product_type',
        'products.description', 'products.image', 'products.price')
        ->join('product_types', 'product_types.id', '=', 'products.id_product_type')
        ->get();
        $productList =  array('products' => $products);
        return response()->json($productList);
    }
}
