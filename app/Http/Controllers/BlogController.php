<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
class BlogController extends Controller
{
    public function getIndex(){
    	$posts =Post::orderBy('id','desc')->paginate(5);
    	return view('blog.index')->with('posts',$posts);
    }

    public function getSingle($id){
    	$post = Post::find($id);
    	return view('blog.single')->with('post',$post);
    }
}
