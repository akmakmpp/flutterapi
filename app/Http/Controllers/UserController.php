<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
public function login(Request $request){

    $request->validate([
        "email"=>"required",
        "password"=>"required"
    ]);

    if(Auth::attempt(["email"=>$request->input("email"),"password"=>$request->input("password")])){
        $user = auth()->user();
        $apiToken = $user->createToken("Api Token")->accessToken;
        
        return response()->json([
            "status"=>true,
            "message"=>"User Login Successfully",
            "token"=>$apiToken
        ]);
    }else {
        
        return response()->json([
            "status"=>false,
            "message"=>"Email or Password was wrong.",
            "token"=>""
        ]);
    }

}


   public function create(Request $request){
    
    $user = User::create([
        "name"=>$request->input("name"),
        "email"=>$request->input("email"),
        "password"=>Hash::make($request->input("password"))
    ]);

    $apiToken = $user->createToken("Api Token")->accessToken;

    $status = array("status"=>true,"message"=>"User Created Successfully.", "token"=>$apiToken);

    return $status;

   }


   public function index(){
    $users = User::all();
    return $users;
   }

   public function redirect(){
    $info = array("message"=>"you need to authorized");
    return $info;
   }
}
