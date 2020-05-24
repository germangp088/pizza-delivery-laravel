<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Customer;
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
            $customer->persist($customerRequest);
        } else {
            return response()->json(["errorMessage" => "Bad Request"], 400);
        }

        $bill = new Bill();
        $billRequest = json_decode(json_encode($request->bill));
        if($bill->isValid($billRequest)){
            $bill->persist($billRequest);
        } else {
            return response()->json([ "errorMessage" => "Bad Request"], 400);
        }

        return response()->json($bill->id);
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
