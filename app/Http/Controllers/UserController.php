<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Helper;
use App\Models\User;

use File;  

class UserController extends Controller
{
    public function index(){
        $params['userid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Users/GetUser',$params);
        $users =$result['user'][0]; 
      
        return view('user.list',compact('users'));
    } 
    public function login(Request $request){
        $message="";  
    	if($request->method()=="POST"){ 
    	    $data['user_name'] =$request->user_name;;
    	    $data['password'] =$request->password;
  
            $params['paramsList']=json_encode($data);  
    	    $result=Helper::POST( \Config::get('setting.api_path').'/Users/Check',$params);
        	if($result['status'][0]['statuscode']=="200"){
    	   	   $user =new User;
    	   	   $user->name=$request->user_name;
    	   	   $user->password =$request->password;  

    	   	   \Session::put('User',$user);  
   	   	  	   \Session::save(); 
            
               \Session::put('UserEmployee',isset($result['emp'][0])?$result['emp'][0]:"");
               \Session::save();  

               \Session::put('Authorities',$result['menu']) ;
               \Session::save();

   	   	  	  return  redirect('home');

    	    }elseif($result['status'][0]['statuscode']=="401"){
                $message="Invalid User!";
            }     	   
    	}
        return view('login',compact('message')); 
    }
    public function logout(){
   		\Session::forget('User');
        \Session::forget('Authorities');
        \Session::forget('UserEmployee');

   		return redirect('login');
    }
    public function unauthoirze(){
        return view ('unauthoirze');
    } 

}