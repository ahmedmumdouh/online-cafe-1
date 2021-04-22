<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Models\Room;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Http\Response;
class AdminUserController extends Controller
{
 // list all user by index fun

   public function index(){
       $users = User::all();
       $userArr=[];
        
    foreach($users as $user){   
        $user->rooms =  $user->rooms ;
        $userArr[] = $user ;
    }
       return $userArr;
    //    return response()-> json($users);

   }
  // save users 
    public function store(Request $request)
    {    
        
            // $user = new User();
            // $user->name = $userRequeste->name;
            // $user->email = $userRequeste->email;
            // $user->password = $userRequeste->password;
            // $user->avatar = $userRequeste->avatar;
            // $user->save();
////////////////////////////////////////
$input = $request->all();
  
if ($image = $request->file('avatar')) {
    $destinationPath = 'image/';
    // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    $profileImage = 'image/'.$request->file('avatar')->getClientOriginalName(); 
    $image->move($destinationPath, $profileImage);
    $input['avatar'] = "$profileImage";
}

$add = User::create($input);
dd($add);
  if ($add){
    return response()->json(["is_done"=>true]);
  }else{
    return response()->json(["is_done"=>false]);

  }
    // return response()->json('user created');
       
    }

// delete user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return response()->json('user deleted!');
    }

// update user 
// public function update($id, Request $request)
    // {
        public function update(Request $request, User $user)
        {
            $input = $request->all();
            if ($image = $request->file('avatar')) {
                $destinationPath = 'image/';
                // $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $profileImage = 'image/'.$request->file('avatar')->getClientOriginalName(); 
                $image->move($destinationPath, $profileImage);
                $input['avatar'] = "$profileImage";
            }
            $update = $user->update($input);   
            // $update = $product->update([
            //     'name' => $input['name'],
            //     'price' => $input['price'],
            //     'image' => $input['image'],
            //     'category_id' => $input['category_id']
            // ]);    
            if ($update){
                return response()->json(["succes"=>$input]);
            }else{
                return response()->json(["error"=>$input]);
    
            }   
           
        }




        // $user = User::find($id);
        // $user->update($request->all());

        // return response()->json('user updated!');
    // }
// show user with id
public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }
     

}
