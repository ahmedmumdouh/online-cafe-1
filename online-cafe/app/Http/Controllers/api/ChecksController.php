<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Support\Facades\Log;

class ChecksController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return $users;
    }
    
    public function store(Request $request)
    {

         $input=$request->input('selectedUser');
         $start=$request->input('start');
         $end=$request->input('end');
         $totalAmountForUser=0;
        
         
        
        $user = User::where('name', $input)->first();
        $id=$user->id;
        $orders=Order::where('user_id', $id)->where('created_at','>=',$start)->where('created_at','<=',$end)->get();
        foreach($orders as $order)
        {
            $totalAmountForUser=$totalAmountForUser+$order->total_price;
        }

       
        
          $data = array("user"=>$user, "orders"=>$orders,"totalAmount"=>$totalAmountForUser);
        
          return $data;
       
        

    }

    public function getProducts(Request $request)
    {

        $order_id=$request->input('selectedOrderId');
        $order=Order::find($order_id);
        $products=$order->products;
        
        return $products;
       
        

    }
}

