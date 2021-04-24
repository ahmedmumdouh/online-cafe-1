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
        $request->validate(['user_id' => ['required']], ["user_id.require" => 'userID is required']);

        if ($request['start_date'] && $request['end_date']) {
            error_log($request['start_date']);

            $orders = Order::where("user_id", $request['user_id'])->where("created_at", ">=", $request['start_date'])->where("created_at", "<=", $request['end_date'])->orderBy("created_at", "desc")->paginate(5)->withQueryString();
        } else {
            $orders = Order::where("user_id", $request['user_id'])->orderBy("created_at", "desc")->paginate(5)->withQueryString();
        }
        if (!$orders)  return response()->json(["data" => []]);
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

    public function cancelOrder(Order $order)
    {
        if (!$order) return response()->json(["message" => "Invalid order id"], 401);
        $order->status = "done";
        return response()->json(["message" => "canceled"]);
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
