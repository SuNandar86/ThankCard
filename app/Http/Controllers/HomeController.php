<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper; 
use App\Models\Employee;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request){ 
    	 $request->flash();
 
        //get thank card list
        if($request->method()=="POST") {
        	$data['from_emp_id'] =$request->employee_id;
        	$data['to_emp_id'] =Helper::EmployeeID();
	        $data['from_date'] =$request->from_date;
	        $data['to_date']   = $request->to_date;
            $data['from_dept_id'] =$request->department_id;
            $data['from_sub_dept_id'] =$request->sub_department_id;
        }else{
        	$data['from_emp_id'] ="%";
        	$data['to_emp_id'] =Helper::EmployeeID();
        	$data['from_date'] =date('Y-m-d H:i:s');
        	$data['to_date']   = date('Y-m-d H:i:s');
            $data['from_dept_id'] ='%';
            $data['from_sub_dept_id'] ='%';
        } 
        
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/ThankCards/ThankCardsFemp',$params);
       
        $thankcards=$result['thankcard'][0]; 
        
        
        //get Employee list
        $data['emp_id']="%";
        $data['from_emp_id']=Helper::EmployeeID();
        $data['dept_id']="%";
        $data['sub_dept_id']="%";

        $params['paramList']=json_encode($data);

        $result=Helper::GET(\Config::get('setting.api_path').'/ThankCards/GetEmployee',$params);
        $employees =$result['emplist'][0];   

        //get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment'];  
      
    	return view ('home',compact('thankcards','employees','departments','subdepartments'));
    }
    public function activities(){ 
        return view('activities');
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