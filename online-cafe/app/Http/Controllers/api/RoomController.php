<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Room;

use App\Models\User;

class RoomController extends Controller
{
    //
    // function __construct(){
    //     $this->middleware("auth:sanctum");
    //     // $this->middleware("auth:sanctum")->only(["destroy","update"]);

    // }

    function index (){
        $rooms = Room::all();
        return $rooms ;
    }



    public function show(Room $room)
    {
        return $room;
    }

   
    

    function store(Request $request){
       
        // dd($request);
        // $user = Auth::user();
        
        // $request->user = $user->id ;
        // dd($request);
        $add = Room::create($request->all());
        if ($add){
            return response()->json(["message"=>"New Room added successfully"]);
        }else{
            return response()->json(["message"=>"New Room not added successfully"]);

        }
    }


   
    public function update(Request $request, Room $room)
    {
       $update = $room->update($request->all());
        if ($update){
            return response()->json(["message"=>"New room updated successfully"]);
        }else{
            return response()->json(["message"=>"New room not updated successfully"]);

        }   
    }

   
    public function destroy(Room $room)
    {
      
        $delete = $room->delete();
        if ($delete){
            return response()->json(["message"=>"New room deleted successfully"]);
        }else{
            return response()->json(["message"=>"New room not deleted successfully"]);

        }  
    
    }
}
