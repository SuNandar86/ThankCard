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
    		$arr = array('user_name' => 'Su Su', 'password' => '1234');

    		$data=RoutePath::POST(\Config::get('setting.api_path').'/Users/Check',$arr); 
            print_r($data);
    	}else{
    		return view('login');
    	     
	   }
    }
}