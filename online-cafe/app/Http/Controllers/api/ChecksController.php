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

        // $input=$request->input('name');
        // $start=$request->input('start');
        // $end=$request->input('end');
        

        // $user = User::find($input);
        
        // $data = array("user"=>$user, "start"=>$start, "end"=>$end);

        
        return $request->all();

    }
}
