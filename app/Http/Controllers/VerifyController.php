<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

//for session messages
use Session;

use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{
    
     public function check($check){
     		$user= User::where('verification', $check)->first();

 	        if ($user!="") {
           		
           		$user->forceFill([
           		    'confirmed' =>TRUE,
           		    
           		])->save();
           		
           		return redirect()->route('apprvd.single');
        
        }
        else{

        	return redirect()->route('error.single');
        }
    	
    }
    //return error view
    public function checkerr(){
    	return view('verify.verify');
    }

    //return success view
    public function apprvd(){
    	return view('verify.apprvd');
    }
}
