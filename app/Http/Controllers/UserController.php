<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request){
    	if($request->method()=="POST"){
    		$response = Http::post('http://test.com/users', $request->all());
    	}
    	return view('login');
    }
}
