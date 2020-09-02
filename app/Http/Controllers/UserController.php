<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Helper;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        return view('user.list');
    }
    public function add(Request $request){
        if($request->method()=="POST"){             
            return  redirect('users');
        }else{
            $user = new User;
            $status="Add";
            return view('user.add',compact('user','status'));
        }
    }
    public function edit($id){
         $user= User::find($id);
         $status="Update";
         return view('user.add',compact('user'.'status'));
    }
    public function update(){

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
    	   	   $user->user_name=$request->user_name;
    	   	   $user->password =$request->password; 

    	   	   \Session::put('User',$user);  
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
   		return redirect('login');
    }
    public function unauthoirze(){
        return view ('unauthoirze');
    }
}