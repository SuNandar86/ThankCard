<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper; 

class ReportController extends Controller
{
    public function thankCardScoreByDepartment(Request $request){ 
    	$request->flash();
  
        if($request->method()=="POST"){
        	$data['dept_id'] =$request->department_id;
        	$data['sub_dept_id']  =$request->sub_department_id;
	        $data['from_date'] =$request->from_date;
        	$data['to_date']   = $request->to_date;
        	$data['order'] =$request->order; 
        }else{
        	$data['dept_id'] ='%';
        	$data['sub_dept_id']  = '%';
	        $data['from_date'] =date('Y-m-d H:i:s');
        	$data['to_date']   = date('Y-m-d H:i:s');
        	$data['order'] ='desc';
        }

        //get sent thank card score list by department
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByDept',
        																				$params);
        $thankcards=$result['thankcard'][0];  

    	//get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

    	return view('report.thankcard_score_by_department',compact('thankcards','departments','subdepartments'));
    }
    public function receiveScoreByEmployee(Request $request){ 
    	$request->flash();
  
        if($request->method()=="POST"){
        	$data['dept_id'] =$request->department_id;
        	$data['sub_dept_id']  =$request->sub_department_id;
        	$data['to_emp_id'] =$request->employee_id;
	        $data['from_date'] =$request->from_date;
        	$data['to_date']   = $request->to_date;
        	$data['order'] =$request->order; 
        }else{
        	$data['dept_id'] ='%';
        	$data['sub_dept_id']  = '%';
	        $data['from_date'] =date('Y-m-d H:i:s');
        	$data['to_date']   = date('Y-m-d H:i:s');
        	$data['order'] ='desc';
        }

        //get sent thank card score list by employee
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByEmployee',
        																				$params);
        $thankcards=$result['thankcard'][0];  
        

    	//get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

    	//get Employee list
    	$params['empid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Employees/GetEmployee',$params);
        $employees =$result['employee'][0];

    	return view('report.receive_score_by_employee',compact('thankcards','employees',
    															'departments','subdepartments'));   																		  
    }
    public function receiveScoreByEmployeeDetail($id,$department,$subdepartment,$from_date,$to_date){
    	$data['dept_id'] =$department;
    	$data['sub_dept_id']  =$subdepartment;
    	$data['to_emp_id'] =$id;
        $data['from_date'] =$from_date;
    	$data['to_date']   = $to_date;
    	$data['order'] ="DESC"; 

    	$params['paramList']=json_encode($data);
    	$result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByEmployeeView',
        																				$params); 
    	$thankcards=$result['thankcard'][0];

    	return view('report.receive_score_detail_by_employee','thankcards');

    }
    public function sentScoreByEmployee(Request $request){
    	$request->flash();
  
        if($request->method()=="POST"){
        	$data['dept_id'] =$request->department_id;
        	$data['sub_dept_id']  =$request->sub_department_id;
        	$data['from_emp_id'] =$request->employee_id;
	        $data['from_date'] =$request->from_date;
        	$data['to_date']   = $request->to_date;
        	$data['order'] =$request->order; 
        }else{
        	$data['dept_id'] ='%';
        	$data['sub_dept_id']  = '%';
	        $data['from_date'] =date('Y-m-d H:i:s');
        	$data['to_date']   = date('Y-m-d H:i:s');
        	$data['order'] ='desc';
        }

        //get sent thank card score list by employee
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetSentThankCardTotalByEmployee',
        																				$params);
        $thankcards=$result['thankcard'][0];  
        

    	//get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

    	//get Employee list
    	$params['empid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Employees/GetEmployee',$params);
        $employees =$result['employee'][0];

    	return view('report.sent_score_by_employee',compact('thankcards','employees',
    														'departments','subdepartments'));
    }
}
