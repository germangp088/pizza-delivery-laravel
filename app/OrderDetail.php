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
                'price' => 'required|numeric|max:255',
                'quantity' => 'required|numeric|max:10'
            );

            $validatorArray = array(
                'id_product' => $product->id_product,
                'price' => $product->price,
                'quantity' => $product->quantity
            );

            $validator = Validator::make($validatorArray, $rules);
            return !$validator->fails();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function persist($product) {
        $result = new Result();

        if(!$this->isValid($product)){
            $result->build(false, "Bad Request", 400);
            return $result;
        }

        $this->id_product = $product->id_product;
        $this->price = $product->price;
        $this->quantity = $product->quantity;
        $saved = $this->save();

        if(!$saved) {
            $result->build(false, "Error on save order details", 500);
            return $result;
        }

        $result->build(true);
        return $result;
    }

    public function order() {
        return $this->belongsTo('App\Order','id_order');
    }

    public function product() {
        return $this->belongsTo('App\Product','id_product');
    }
}
