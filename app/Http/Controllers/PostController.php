<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
   public function index(){
   $posts = Post::all();

   return $posts;
   } 

   public function create(Request $request){
$request->validate([
    "title" => "required",
    "text" => "required"
]);

    Post::create([
        "title"=>$request->input("title"),
        "text"=>$request->input("text")
    ]);

    $arr = array("status"=>true,"message"=>"Post Created Successfully.");

    return $arr;
   }

public function update(Request $request,$id){

    $request->validate([
        "title" => "required",
        "text" => "required"
    ]);

    Post::find($id)->update([
        "title"=>$request->input("title"),
        "text"=>$request->input("text")
    ]);

    $result = array("status"=>true,"message"=>"Post Updated Successfully");
    return $result;
}

public function delete($id){
    Post::destroy($id);
    $response = array("status"=>true,"message"=>"Post Deleted Successfully");

    return $response;
}

}


