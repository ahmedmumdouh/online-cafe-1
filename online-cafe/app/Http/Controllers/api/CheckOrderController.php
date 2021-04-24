<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class CheckOrderController extends Controller
{
    public function index(Request $request)
    {
        $order_id=$request->input('orderId');
        $order=Order::find($order_id);
        return $order;

    }
}
