<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class ChecksController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return $users;
    }
}

