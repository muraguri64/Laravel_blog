<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;

class LoginController extends Controller
{
     public function login(Request $request)
    {
    	//validate data 
    	 $this->validate($request,array(
            'email'=>'required',
            'password' =>'required'

            ));

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
               
                if(Auth::attempt(['email'=>$request->email,'password' => $request->password,'confirmed'=>TRUE])){
                    //redirect to posts page if user is confirmed
                    return redirect()->route('posts.index');            
                }
                 else{
                        Auth::logout();
                        return back()->withErr('Check your Email to confirm account');

                 }
            
            }

     
        else{       	 	

        	 return back()->withErr('The username and password you entered did not match our records. Please double-check and try again.');
        }
    }
    public function showLoginForm(){
    	return view('auth.login');
    }

    public function logout(){
    	Auth::logout();
    	return redirect('/');
    }
}
