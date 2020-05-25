<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Bill extends Model
{
    public function persist($bill) {
        $result = new Result();

        if(!$this->isValid($bill)){
            $result->build(false, "Bad Request", 400);
            return $result;
        }

        $this->id_currency = $bill->id_currency;
        $this->subtotal = $bill->subtotal;
        $this->shipping_fee = $bill->shipping_fee;
        $saved = $this->save();

        if(!$saved) {
            $result->build(false, "Error on save bill", 500);
            return $result;
        }

        $result->build(true);
        return $result;
    }

    public function currency() {
        return $this->belongsTo('App\Currency','id_currency');
    }

    private function isValid($bill) {
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
}
