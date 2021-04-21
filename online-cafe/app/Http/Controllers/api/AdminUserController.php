<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;


class AdminUserController extends Controller
{
 // list all user by index fun
   public function index(){
       $users = User::all();
       return response()-> json($users);

   }
  // save users 
    public function store(Request $request)
    {    
        
            $user = new User();
            $user->name = $userRequeste->name;
            $user->email = $userRequeste->email;
            $user->password = $userRequeste->password;
            $user->avatar = $userRequeste->avatar;
            $user->save();
////////////////////////////////////////
// $input = $request->all();
  
// if ($image = $request->file('image')) {
//     $destinationPath = 'image/';
//     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
//     $image->move($destinationPath, $profileImage);
//     $input['image'] = "$profileImage";
// }

// $add = User::create($input);
//   if ($add){
//     return response()->json(["is_done"=>true]);
//   }else{
//     return response()->json(["is_done"=>false]);

//   }
    return response()->json('user created');
       
    }

// delete user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('user deleted!');
    }

// update user 
public function update($id, Request $request)
    {
        $user = User::find($id);
        $user->update($request->all());

        return response()->json('user updated!');
    }
// show user with id
public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
     

}
