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
        $params['userid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Users/GetUser',$params);
        $users =$result['user'][0]; 
      
        return view('user.list',compact('users'));
    }
    public function add(Request $request){ 
        $request->flash();
        
        if($request->method()=="POST") {
            $data['User_Name'] =$request->user_name;
            $data['password'] =$request->password;
            $data['role_id'] =$request->role_id; 


            $params['paramList']=json_encode($data);

            $result=Helper::POST( \Config::get('setting.api_path').'/Users/User',$params);  
            
            if($result['status'][0]['statuscode']=="200"){
               return redirect('users');
            }elseif($result['status'][0]['statuscode']=="406"){
                \Session::flash('user.message',"User name ".$request->user_name." is already taken!"); 
                \Session::flash('status','alert-warning');
            } 
        } 
        // get roles
        $params['roleid']="%";

        $result=Helper::GET( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0];  

        $action ="Add";
        $user=new User;  
        return view('user.add',compact('user','roles','action'));
         
    }
    public function edit($id){
        // get roles
        $params['roleid']="%";

        $result=Helper::GET( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0];

        // get users       
        $params['userid']=$id;

        $result=Helper::GET(\Config::get('setting.api_path').'/Users/GetUser',$params);
        $users =$result['user'][0]; 

        $action ="Edit"; 
        $user=new User;
        $user->id=$users[0]['Id'];
        $user->name=$users[0]['User_Name'];
        $user->password=$users[0]['Password'];
        $user->role_id=$users[0]['Role_ID'];  
         
        return view('user.add',compact('user','roles','action')); 
    }
    public function update(Request $request,$id){
        $request->flash();

        $data['Id']  = $id;
        $data['User_Name'] =$request->user_name;
        $data['password'] =$request->password;
        $data['role_id'] =$request->role_id;   

        $params['paramList']=json_encode($data);

        $result=Helper::PUT( \Config::get('setting.api_path').'/Users/UpdateUser',$params);
 
        if($result['status'][0]['statuscode']=="200"){
            return redirect('users');              
        }elseif($result['status'][0]['statuscode']=="406"){ 
            \Session::flash('user.message','User named  “".$request->user_name."” is already taken!'); 
            \Session::flash('status','alert-warning');  
        } 
        
        return redirect('user/edit/'.$id);       
    } 
    public function delete($id){
        $data['Id']  = $id; 
        $params['paramList']=json_encode($data);

        $result=Helper::DELETE( \Config::get('setting.api_path').'/Users/DeleteUser',$params);
    
        $message="";
        if($result['status'][0]['statuscode']=="200"){
            $message ='Successfully deleted!'; 
        }elseif($result['status'][0]['statuscode']=='404'){ 
            $message = 'User is not found!'; 
        }elseif($result['status'][0]['statuscode']=='304'){
            $message = 'Unable to delete!It is already used in employee!';  
        }
        \Session::flash('message', $message); 
        return  redirect('users');
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
      public function GetUser($data){  
        $user=new User;
        $user->id = isset($data['Id'])?$data['Id']:"";
        $user->name =isset ($data['User_Name'])? $data['User_Name']:"";
        $user->password =isset ($data['password'])? $data['password']:""; 
        $user->role_id =isset ($data['role_id'])? $data['role_id']:""; 
        return $user; 
    }
}