<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history($ip)
    {
        $history = DB::table('orders')
            ->join('customers', 'customers.id', '=', 'orders.id_customer')
            ->join('bills', 'bills.id', '=', 'orders.id_bill')
            ->join('currencies', 'currencies.id', '=', 'bills.id_currency')
            ->join('order_details', 'orders.id', '=', 'order_details.id_order')
            ->join('products', 'products.id', '=', 'order_details.id_product')
            ->where('ip', $ip)
            ->select('orders.id as id_order', 'orders.date', 'customers.name as customer', 'bills.subtotal',
            'bills.shipping_fee', 'currencies.currency', 'order_details.price', 'products.image',
            'order_details.quantity', 'products.name as product')
            ->get();
        return response()->json($history);
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
                $this->rollback($customer);
                return response()->json([ "errorMessage" => "Error on save bill"], 500);
            }
        } else {
            $this->rollback($customer);
            return response()->json([ "errorMessage" => "Bad Request"], 400);
        }

        $order = new Order();
        $order->id_customer = $customer->id;
        $order->id_bill = $bill->id;
        $order->date = date('Y-m-d H:i:s');
        $saved = $order->save();
        if(!$saved) {
            $this->rollback($customer, $bill);
            return response()->json([ "errorMessage" => "Error on save order"], 500);
        }

        $productsRequest = json_decode(json_encode($request->products));
        $orderDetailList = [];

        foreach ($productsRequest as $product) {
            $orderDetail = new OrderDetail();
            $orderDetail->id_order = $order->id;
            if($orderDetail->isValid($product)){
                $saved = $orderDetail->persist($product);
                if(!$saved) {
                    $this->rollback($customer, $bill, $orderDetailList);
                    return response()->json([ "errorMessage" => "Error on save order details"], 500);
                }
                array_push($orderDetailList, $orderDetail);
            } else {
                $this->rollback($customer, $bill, $orderDetailList);
                return response()->json([ "errorMessage" => "Bad Request"], 400);
            }
        }

        return response()->json([ "message" => "Success"], 201);
    }

    private function rollback($customer, $bill = null, $orderDetailList = []) {
        $customer && $customer->delete();
        $bill && $bill->delete();
        foreach ($orderDetailList as $orderDetail) {
            $orderDetail->delete();
        }
    }
}
