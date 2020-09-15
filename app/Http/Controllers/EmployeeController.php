<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee; 
use App\Models\User; 
use App\Helper;
use File;
class EmployeeController extends Controller
{
    public function index(){ 
        $params['empid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Employees/GetEmployee',$params);
        $employees =$result['employee'][0]; 
   
    	return view('employee.list',compact('employees'));
    }
    public function add(Request $request){
        $request->flash();
    	if($request->method()=="POST"){ 
            $data['Name'] =$request->employee_name;
            $data['Sub_Dept_Id'] =$request->sub_department_id;
            $data['Dept_Id'] =$request->department_id; 
            $data['User_Id'] =$request->user_id;
            $data['Address'] =$request->address; 
            $data['email'] =$request->email;
            $data['phone'] =$request->phone;
            $data['photoname'] =$_FILES['photo']['name'];
            $data['User_Name'] =$request->user_name;
            $data['password'] =$request->password;
            $data['role_id']  =$request->role_id;
 
            $params['paramList']=json_encode($data);
            $result=Helper::POST( \Config::get('setting.api_path').'/Employees/Employee',$params);
  
            if($result['status'][0]['statuscode']=="200"){
                $employee_id=$result['employee'][0]['Id'] ;
                $data['Id'] =$employee_id;
                // upload image
                if ($request->file('photo')) {
                    $file_upload_url ='upload/images/'.$employee_id;
                    $profile= $request->file('photo'); 
                    $filename =  $profile->getClientOriginalName();
                    $profile->move($file_upload_url, $filename);  
                }             
                return redirect('employees');

            }elseif($result['status'][0]['statuscode']=='406'){
                \Session::flash('employee.message','Employee named “'
                                .$request->user_name.'” is already taken!'); 
                \Session::flash('status',"alert-warning"); 
            } 
            
        } 
        //get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

         // get roles
        $params['roleid']="%";

        $result=Helper::GET( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0]; 
        
        $action ="Add";
        $employee =new Employee;
        $user =new User;
        return view('employee.add',compact('user','employee','departments','subdepartments','roles'
                                           ,'action'));
                
    }
    public function edit($id){ 
        //get department and subdepartment list  
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

        // get roles
        $params['roleid']="%";

        $result=Helper::GET( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0]; 
        

        //get employee        
        $params['empid']=$id;

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

        return view('employee.add',compact('employee','user','departments','subdepartments','roles','action'));
    }
    public function update(Request $request,$id){
        $request->flash();

        $data['Id'] =$id;
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
            return redirect('employees');
        }elseif($result['status'][0]['statuscode']=="406"){ 
            \Session::flash('employee.message',"Employee named “".$request->employee_name ."” is already taken!");
            \Session::flash('status','alert-warning!');  
        }elseif($result['status'][0]['statuscode']=="304"){
            \Session::flash('employee.message',"Unable to update!Employee does not exist!!"); 
            \Session::flash('status','alert-danger') ; 
        }
        
        return redirect('employee/edit/'.$id);
    } 

    public function delete($id){
        $data['Id']  = $id; 
        $params['paramList']=json_encode($data);

        $result=Helper::DELETE( \Config::get('setting.api_path').'/Employees/DeleteEmployee',$params);
    
        $message="";
        if($result['status'][0]['statuscode']=="200"){  
            // Delete existing photo  
            $file_path=public_path("upload/images/".$id);  
            if (file_exists($file_path)){
                File::delete($file_path);
            } 

            $message ='Successfully deleted!'; 
        }elseif($result['status'][0]['statuscode']=='304'){
            $message = 'Unable to delete!Employee does not exist!';  
        }
        \Session::flash('message', $message); 
        return  redirect('employees');
    } 
    public function GetEmployee($data){
        $employee =new Employee;
        $employee->id =isset($data['Id'])?$data['Id']:"";
        $employee->name = isset($data['Name'])? $data['Name']:"";
        $employee->department_id=isset($data['Dept_Id'])?$data['Dept_Id']:"";
        $employee->sub_deaprtment_id=isset($data['Sub_Dept_Id'])?$data['Sub_Dept_Id']:""; 
        $employee->user_id=isset($data['User_Id'])?$data['User_Id']:"";
        $employee->address=isset($data['Address'])?$data['Address']:"";
        $employee->email=isset($data['email'])?$data['email']:"";
        $employee->phone =isset($data['phone'])? $data['phone']:"";
        $employee->photo_name = isset($data['photoname'])?$data['photoname']:"";

        return $employee;
    }
}   