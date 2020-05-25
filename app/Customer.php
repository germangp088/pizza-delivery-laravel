<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Customer extends Model
{

    public function isValid($customer) {
        try {
            $rules = array(
                'name' => 'required|string',
                'email' => 'required|string',
                'contact_number' => 'required|string',
                'delivery_address' => 'required|string',
                'ip' => 'required|string'
            );

            $validatorArray = array(
                'name' => $customer->name,
                'email' => $customer->email,
                'contact_number' => $customer->contact_number,
                'delivery_address' => $customer->delivery_address,
                'ip' => $customer->ip
            );

            $validator = Validator::make($validatorArray, $rules);
            return !$validator->fails();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function persist($customer) {
        $result = new Result();

        if(!$this->isValid($customer)){
            $result->build(false, "Bad Request", 400);
            return $result;
        }

        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->contact_number = $customer->contact_number;
        $this->delivery_address = $customer->delivery_address;
        $this->ip = $customer->ip;
        $saved = $this->save();

        if(!$saved) {
            $result->build(false, "Error on save customer", 500);
            return $result;
        }

        $result->build(true);
        return $result;
    }
}
