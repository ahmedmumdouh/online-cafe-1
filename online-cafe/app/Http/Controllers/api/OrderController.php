<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where("user_id", $request['user_id'])->orderBy("created_at", "desc")->paginate(5);
        return $orders;
    }

    public function latest(Request $request)
    {
        $order =  Order::where("user_id", $request['user_id'])->orderBy("created_at", "desc")->first();
        $products = $order->products;

        return response()->json(["order" => $order, "products" => $products]);
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
                error_log($order);
            }
            return response()->json(["message" => "created successfully", "data" => $order]);
        } else {
            return response()->json(["message" => "Error in created order!"]);
        }
    }
    public function getOrderProducts($id)
    {
        $order = Order::find($id);
        return $order->products;
    }
}
