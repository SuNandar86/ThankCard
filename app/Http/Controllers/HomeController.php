<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper;  
 
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
}