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
            ->orderBy('orders.id')
            ->select('orders.id as id_order', 'orders.date', 'customers.name as customer', 'bills.subtotal',
            'bills.shipping_fee', 'currencies.symbol', 'order_details.price', 'products.image',
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
        $result = $customer->persist($customerRequest);
        if(!$result->success) {
            return response()->json([ "errorMessage" => $result->message], $result->status);
        }

        $bill = new Bill();
        $billRequest = json_decode(json_encode($request->bill));
        $result = $bill->persist($billRequest);
        if(!$result->success) {
            $this->rollback($customer);
            return response()->json([ "errorMessage" => $result->message], $result->status);
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

            $result = $orderDetail->persist($product);
            if(!$result->success) {
                $this->rollback($customer, $bill, $order, $orderDetailList);
                return response()->json([ "errorMessage" => $result->message], $result->status);
            }
            array_push($orderDetailList, $orderDetail);
        }

        return response()->json($order->id, 201);
    }

    private function rollback($customer, $bill = null, $order = null, $orderDetailList = []) {
        $order && $order->delete();
        foreach ($orderDetailList as $orderDetail) {
            $orderDetail->delete();
        }
        $customer && $customer->delete();
        $bill && $bill->delete();
    }
}
