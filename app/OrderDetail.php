<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class OrderDetail extends Model
{
    public function isValid($product) {
        try {
            $rules = array(
                'id_product' => 'required|exists:products,id',
                'quantity' => 'required|numeric'
            );

            $validatorArray = array(
                'id_product' => $product->id_product,
                'quantity' => $product->quantity
            );

            $validator = Validator::make($validatorArray, $rules);
            return !$validator->fails();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function persist($product) {
        $this->id_product = $product->id_product;
        $this->price = $product->price;
        $this->quantity = $product->quantity;
        return $this->save();
    }

    public function order() {
        return $this->belongsTo('App\Order','id_order');
    }

    public function product() {
        return $this->belongsTo('App\Product','id_product');
    }
}
