<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\RoutePath;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){ 
    	if($request->method()=="POST"){ 
    	   $data['user_name'] =$request->user_name;
    	   $data['password'] =$request->password;
    	 
    	   $result=RoutePath::POST( \Config::get('setting.api_path').'/Users/Check',$data);

    	   if($result['status']=="200"){
    	   	  $user =new User;
    	   	  $user->user_name=$request->user_name;
    	   	  $user->password =$request->password; 
    	   	  \Session::put('User',$user);  
   	   	  	  \Session::save(); 

   	   	  	 return  redirect('home');
    	   }     	   
    	}
        return view('login'); 
    }
    public function logout(){
   		\Session::forget('User');
   		return redirect('login');
    }
}