<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;


class AdminUserController extends Controller
{

   public function index(){
       $users = User::all();
       return response()-> json($users);

   }

    public function store(Request $userRequeste)
    {    
        ///////////////////////
        
            $user = new User();
            $user->name = $userRequeste->name;
            $user->email = $userRequeste->email;
            $user->password = $userRequeste->password;
            $user->avatar = $userRequeste->avatar;
            $user->save();
            return response()->json('user created');
       
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('user deleted!');
    }

     

}
