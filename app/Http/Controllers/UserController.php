<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\RoutePath;
use App\User;

class UserController extends Controller
{
    public function login(Request $request){ 
    	if($request->method()=="POST"){  
    		$data=RoutePath::GET(\Config::get('setting.api_path').'/Users'); 
            return view('welcome',compact('data')); 
    	}else{
    		return view('login');
    	     
	   }
    }
}