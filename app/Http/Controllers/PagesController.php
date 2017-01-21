<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//for sending mail
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;


use App\Http\Requests;
use App\Post;
class PagesController extends Controller
{
    //
    public function getAbout(){
    	return view('pages.about');
    } 

    public function getIndex(){
        $posts=Post::orderBy('created_at','desc')->limit(4)->get();
   		return view('pages.welcome')->with('posts',$posts);

    }

    public function getContact(){
   		return view('pages.contact');

    }

    public function postContact(Request $request){

        //validate data
        $this->validate($request,array(
            'name'        =>'required|min:2|max:255',
            'email'       =>'required|email',
            'subject'     =>'required|min:3|max:255',
            'message_send'=>'required|min:10'       
        ));

        $quickbyte_mail = "quickbytekenya@gmail.com";

        //actually send the email
         Mail::to($quickbyte_mail)->send(new ContactMail($request->email,$request->name,$request->subject,$request->message_send));     

         return response()->json([
                'success' => true                                                 
            ]);         
    }
}
