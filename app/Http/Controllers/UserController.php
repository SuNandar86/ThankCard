<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Helper;
use App\Models\User;
use App\Models\Employee;
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
     public function setting(){ 
  
         //get department and subdepartment list  
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

        // get roles
        $params['roleid']="%";

        $result=Helper::GET( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0]; 
        

        //get employee        
        $params['empid']=Helper::EmployeeID();

        $result=Helper::GET(\Config::get('setting.api_path').'/Employees/GetEmployee',$params);
        $employees =$result['employee'][0]; 

        $employee = new Employee;
        $employee->id=$employees[0]['Emp_Id'];
        $employee->name=$employees[0]['Emp_Name'];
        $employee->department_id=$employees[0]['Dept_Id'];
        $employee->sub_deaprtment_id=$employees[0]['Sub_Dept_Id']; 
        $employee->address=$employees[0]['Address'];
        $employee->email=$employees[0]['Email'];
        $employee->phone=$employees[0]['Phone'];
        $employee->photo_name=$employees[0]['PhotoName'];

        $action ="Edit";  

        $user =new User;
        $user->id=$employees[0]['User_Id'];
        $user->name=$employees[0]['User_Name'];
        $user->role_id=$employees[0]['User_Role']; 
        $user->password=$employees[0]['User_Pass'];

        return view('user.setting',compact('employee','user','departments','subdepartments','roles','action'));
    }  
    public function update_setting(Request $request){
        $request->flash();
        
        $id=Helper::EmployeeID();
        $data['Id'] =  $id ;
        $data['Name'] =$request->employee_name;
        $data['Sub_Dept_Id'] =isset($request->sub_department_id)?$request->sub_department_id:0; 
        $data['Dept_Id'] =$request->department_id; 
        $data['Address'] =$request->address; 
        $data['email'] =$request->email;
        $data['phone'] =$request->phone;
        $data['photoname'] =$_FILES['photo']['name'] !=""?$_FILES['photo']['name']:$request->old_photo; 
        $data['User_Name'] =$request->user_name;
        $data['Password'] =$request->password;
        $data['user_id']  =$request->user_id;
        $data['Role_Id']  =$request->role_id;

        $params['paramList']=json_encode($data);
        $result=Helper::PUT( \Config::get('setting.api_path').'/Employees/UpdateEmployee',$params);

        if($result['status'][0]['statuscode']=="200"){
            if ($request->file('photo')) {  
                // Delete existing photo  
                $old_file_path=public_path("upload/images/".$id."/".$request->old_photo);  
                if (file_exists($old_file_path)){
                    File::delete($old_file_path);
                }  
              
                //Upload New Photo
                $file_upload_url ='upload/images/'.$id;
                $profile= $request->file('photo'); 
                $filename =  $profile->getClientOriginalName();
                $profile->move($file_upload_url, $filename);  
            } 
            \Session::flash('setting.message',"Your information is successfully saved!");  
            \Session::flash('status','alert-success');
        }elseif($result['status'][0]['statuscode']=="406"){ 
            \Session::flash('setting.message',"User named “".$request->user_name ."” is already taken!");
            \Session::flash('status','alert-warning');  
        }elseif($result['status'][0]['statuscode']=="304"){
            \Session::flash('setting.message',"Unable to update!User does not exist!!"); 
            \Session::flash('status','alert-danger') ; 
        }
        
        return redirect('user/setting');
    } 

}