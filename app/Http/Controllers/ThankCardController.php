<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use URL;
use App\Helper; 

class ThankCardController extends Controller
{	
    public function receive($id){  
    	$data['Id']=$id;
    	$data['status']="Seen";

    	$params['paramList']=json_encode($data); 

        $result=Helper::PUT(\Config::get('setting.api_path').'/ThankCards/UpdateView',$params);
        $thankcards =$result['thankcards'][0]; 
        $employee   =$result['fromEmpData'][0];   

        if($result['status'][0]['statuscode']=="304"){
            \Session::flash('receive.message','Invalid thank card!'); 
        } 
        $user['employee_id']=Helper::EmployeeID();
        $user['employee_name']=Helper::EmployeeName();
        $user['employee_photo']=Helper::EmployeePhoto();

    	return view('thankcard.receive',compact('thankcards','employee','user'));
    }
    public function sent(Request $request){
    	$request->flash();
  
        if($request->method()=="POST"){ 
        	$data['from_emp_id'] =Helper::EmployeeID();
        	$data['to_emp_id']   =$request->employee_id;
	        $data['from_date'] =$request->from_date;
	        $data['to_date']   = $request->to_date;
        }else{
        	$data['from_emp_id'] =Helper::EmployeeID();
        	$data['to_emp_id']  = '%';
	        $data['from_date'] =date('Y-m-d H:i:s');
        	$data['to_date']   = date('Y-m-d H:i:s');
        }
        //get sent thank card list
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/ThankCards/GetGiveCardList',$params);
       
        $thankcards=$result['thankcard'][0];  

    	//get Employee list
    	$params['empid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Employees/GetEmployee',$params);
        $employees =$result['employee'][0]; 
 
    	return  view('thankcard.sent',compact('thankcards','employees'));
    }
    public function sent_detail($id){
        $data['id']=$id;

        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/ThankCards/GetGiveCard',$params);
        $thankcard =$result['thankcard'][0];  
 
        return view('thankcard.sent_detail',compact('thankcard'));
    }
    public function reply(Request $request,$id){
    	$data['Id'] =$id;
    	$data['reply'] =$request->reply_message;
    	$data['status'] ="Seen";

    	$params['paramList']=json_encode($data);

    	$result=Helper::PUT(\Config::get('setting.api_path').'/ThankCards/UpdateReply',$params);
    	$thankcards =$result['thankcards'][0];  
 
    	if($result['status'][0]['statuscode']=="200"){
    		\Session::flash('receive.message','Invalid thank card!');
    	} 
    	return view('thankcard.receive',compact('thankcards')); 
    }
    public function createThankCard(Request $request,$name,$id){ 
    	$request->flash();
  
        if($request->method()=="POST"){
   			$data['from_emp_id'] =Helper::EmployeeID();
        	$data['to_emp_id'] =$id;
        	$data['title']     =$request['title'];
        	$data['send_text'] =$request['send_text'];
        	$data['status'] ="delivered"; 

        	$params['paramList']=json_encode($data);
        	$result=Helper::POST(\Config::get('setting.api_path').'/ThankCards/ThankCard',$params);
    		
    		if($result['status'][0]['statuscode']=="200"){
    			echo json_encode(array('status' => 'success')); 
    		}
        }else{
        	$sender['to_name'] =$name;
       		$sender['from_name'] =Helper::EmployeeName();
    		$sender['id']  =$id; 

    		return view('thankcard.create',compact('sender'));
        } 
     
    }
    public function employeelist(Request $request){ 
    	//get Employee list
    	$params['empid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Employees/GetEmployee',$params);
        $employees =$result['employee'][0];
        $search_employees=$employees;

    	$request->flash();
  
        if($request->method()=="POST"){ 
        	$data['emp_id'] =$request->employee_id;
        	$data['dept_id']   =$request->department_id;
	        $data['sub_dept_id'] =is_null($request->sub_department_id)?"%":$request->sub_department_id;

	        //search employee list
	        $params['paramList']=json_encode($data);
	        $result=Helper::GET( \Config::get('setting.api_path').'/ThankCards/GetEmployee',$params); 
	        $search_employees =$result['emplist'][0]; 	         
        } 
 	 
    	//get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

    	return view('thankcard.employeelist',compact('departments','subdepartments','employees','search_employees'));
    }
    
}    