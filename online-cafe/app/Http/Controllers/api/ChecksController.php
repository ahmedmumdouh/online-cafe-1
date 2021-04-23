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
        
        $user = User::where('name', $input)->first();
        $id=$user->id;
        $orders=Order::where('user_id', $id)->where('created_at','>=',$start)->where('created_at','<=',$end)->get();
       

       
        
          $data = array("user"=>$user, "orders"=>$orders);

        
        return $data;

    }
}

