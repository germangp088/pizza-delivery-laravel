<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Customer;
use App\Order;
use DateTime;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history($ip)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $customer = new Customer();
        $customerRequest = json_decode(json_encode($request->customer));
        if($customer->isValid($customerRequest)){
            $saved = $customer->persist($customerRequest);
            if(!$saved) {
                return response()->json([ "errorMessage" => "Error on save customer"], 500);
            }
        } else {
            return response()->json(["errorMessage" => "Bad Request"], 400);
        }

        $bill = new Bill();
        $billRequest = json_decode(json_encode($request->bill));
        if($bill->isValid($billRequest)){
            $saved = $bill->persist($billRequest);
            if(!$saved) {
                $customer->delete();
                return response()->json([ "errorMessage" => "Error on save bill"], 500);
            }
        } else {
            $customer->delete();
            return response()->json([ "errorMessage" => "Bad Request"], 400);
        }

        $order = new Order();
        $order->id_customer = $customer->id;
        $order->id_bill = $bill->id;
        $order->date = date('Y-m-d H:i:s');
        $saved = $order->save();
        if(!$saved) {
            $customer->delete();
            $bill->delete();
            return response()->json([ "errorMessage" => "Error on save order"], 500);
        }

        $productsRequest = json_decode(json_encode($request->products));


        return response()->json([ "message" => "Success"], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
}
