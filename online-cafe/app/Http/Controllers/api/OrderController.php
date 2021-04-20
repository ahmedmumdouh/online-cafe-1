<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(["data" => "this is data"]);
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }
    public function store()
    {
        return response()->json(["data" => "created successfully"]);
    }
}
