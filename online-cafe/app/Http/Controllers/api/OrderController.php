<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        return Order::all();
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }
    public function store(Request $requset)
    {
        $order = new Order([
            'user_id' => $requset->body['order']['user']['id'],
            'room_id' => $requset->body['order']['room']['id'],
            'notes' => $requset->body['order']['notes'],
            'status' => 'processing',
            'total_price' => $requset->body['order']['totalPrice'],
        ]);
        if ($order->save()) {

            foreach ($requset->body['order']['products'] as $product) {

                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }
            return response()->json(["message" => "created successfully", "data" => $order]);
        } else {
            return response()->json(["message" => "Error in created order!"]);
        }
    }
}
