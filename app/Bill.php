<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Bill extends Model
{
    public function isValid($bill) {
        try {
            $rules = array(
                'id_currency' => 'required|exists:currencies,id',
                'subtotal' => 'required|numeric',
                'shipping_fee' => 'required|numeric'
            );

            $validatorArray = array(
                'id_currency' => $bill->id_currency,
                'subtotal' => $bill->subtotal,
                'shipping_fee' => $bill->shipping_fee
            );

            $validator = Validator::make($validatorArray, $rules);
            return !$validator->fails();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function persist($bill) {
        $this->id_currency = $bill->id_currency;
        $this->subtotal = $bill->subtotal;
        $this->shipping_fee = $bill->shipping_fee;
        return $this->save();
    }

    public function currency() {
        return $this->belongsTo('App\Currency','id_currency');
    }
}
