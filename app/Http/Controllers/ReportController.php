<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper; 
use PDF;
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
            $data['to_emp_id']="%";
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
        $data['emp_id']="%";
        $data['from_emp_id']=Helper::EmployeeID();
        $data['dept_id']="%";
        $data['sub_dept_id']="%";

        $params['paramList']=json_encode($data);

        $result=Helper::GET(\Config::get('setting.api_path').'/ThankCards/GetEmployee',$params);
        $employees =$result['emplist'][0]; 

    	return view('report.receive_score_by_employee',compact('thankcards','employees',
    															'departments','subdepartments'));				  
    }
    public function receiveScoreByEmployeeDetail($to_emp_id,$department,$subdepartment,$from_date,$to_date){
    	$data['dept_id'] =$department;
    	$data['sub_dept_id']  =$subdepartment;
    	$data['from_emp_id'] ='%';
    	$data['to_emp_id'] =$to_emp_id;
        $data['from_date'] =$from_date;
    	$data['to_date']   = $to_date;
    	$data['order'] ="DESC"; 

    	$params['paramList']=json_encode($data);
    	$result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByEmployeeView',
        																				$params); 
    	$thankcards=$result['thankcard'][0];
          
    	return view('report.receive_score_detail_by_employee',compact('thankcards','data'));

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
            $data['from_emp_id'] ='%';
	        $data['from_date'] =date('Y-m-d H:i:s');
        	$data['to_date']   = date('Y-m-d H:i:s');
        	$data['order'] ='desc';
        }

        //get sent thank card score list by employee
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetSentThankCardTotalByEmployee', $params);
        $thankcards=$result['thankcard'][0];   


    	//get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

    	//get Employee list
        $data['emp_id']="%";
        $data['from_emp_id']=Helper::EmployeeID();
        $data['dept_id']="%";
        $data['sub_dept_id']="%";

        $params['paramList']=json_encode($data);

        $result=Helper::GET(\Config::get('setting.api_path').'/ThankCards/GetEmployee',$params);
        $employees =$result['emplist'][0]; 

    	return view('report.sent_score_by_employee',compact('thankcards','employees',
    														'departments','subdepartments'));
    }
    public function sentScoreByEmployeeDetail($from_emp_id,$department,$subdepartment,$from_date,$to_date){ 
    										 
    	$data['dept_id'] =$department;
    	$data['sub_dept_id']  =$subdepartment;
    	$data['from_emp_id'] =$from_emp_id;
    	$data['to_emp_id'] ='%';
        $data['from_date'] =$from_date;
    	$data['to_date']   = $to_date;
    	$data['order'] ="DESC"; 

    	$params['paramList']=json_encode($data);
    	$result=Helper::GET(\Config::get('setting.api_path').'/Report/GetSentThankCardTotalByEmployeeView',$params); 
    	$thankcards=$result['thankcard'][0]; 
       
    	return view('report.sent_score_detail_by_employee',compact('thankcards','data')); 
    }
    public function departmentRelation(Request $request){
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

        //get thankcard list by department relation
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByDeptRelation' 
        																				,$params);
        $thankcards=$result['thankcard'][0];  
         
    	//get department and subdepartment list
        $result=Helper::GET( \Config::get('setting.api_path').'/Common/GetCommonData',[]); 
        $departments =$result['department'][0]; 
        $subdepartments =$result['subdepartment']; 

        return view('report.department_relation',compact('thankcards','departments','subdepartments'));
    }

    /* PDF Reports */
    public function scoreByDepartmentPDF(Request $request){ 
        $data['dept_id'] =$request->department_id;
        $data['sub_dept_id']  =$request->sub_department_id;
        $data['from_date'] =$request->from_date;
        $data['to_date']   = $request->to_date;
        $data['order'] =$request->order;

        //get sent thank card score list by department
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByDept',
                                                                                        $params);
        $thankcards=$result['thankcard'][0];  

        $data =['thankcards' => $thankcards];

        $pdf = PDF::loadView('pdfreport.scoreByDepartment',$data); 
        $filename="score_by_department_".date('Y-m-d H:i:s').'.pdf'; 

        return $pdf->download($filename);
        
    }
    public function receiveScoreByEmployeePDF(Request $request){ 
        $data['dept_id'] =$request->department_id;
        $data['sub_dept_id']  =$request->sub_department_id;
        $data['to_emp_id'] =$request->employee_id;
        $data['from_date'] =$request->from_date;
        $data['to_date']   = $request->to_date;
        $data['order'] =$request->order;  

        //get sent thank card score list by employee
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByEmployee', $params);
        $thankcards=$result['thankcard'][0];  

        $data =['thankcards' => $thankcards]; 

        $pdf = PDF::loadView('pdfreport.receiveScoreByEmployee',$data); 
        $filename="receive_score_by_employee_".date('Y-m-d H:i:s').'.pdf'; 

        return $pdf->download($filename);    
    }
    public function receiveScoreDetailByEmployeePDF(Request $request){
        $data['dept_id'] =$request->dept_id;
        $data['sub_dept_id']  =$request->sub_dept_id;
        $data['from_emp_id'] =$request->from_emp_id;
        $data['to_emp_id'] =$request->to_emp_id;
        $data['from_date'] =$request->from_date;
        $data['to_date']   = $request->to_date;
        $data['order'] ="DESC"; 

        $params['paramList']=json_encode($data);
        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByEmployeeView',$params); 
        $thankcards=$result['thankcard'][0];

        $data =['thankcards' => $thankcards];

        $pdf = PDF::loadView('pdfreport.receiveScoreDetailByEmployee',$data); 
        $filename="receive_score_detail_by_employee_".date('Y-m-d H:i:s').'.pdf'; 

        return $pdf->download($filename);
        
    }
    public function sentScoreByEmployeePDF(Request $request){
        $data['dept_id'] =$request->department_id;
        $data['sub_dept_id']  =$request->sub_department_id;
        $data['from_emp_id'] =$request->employee_id;
        $data['from_date'] =$request->from_date;
        $data['to_date']   = $request->to_date;
        $data['order'] =$request->order;  

        //get sent thank card score list by employee
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetSentThankCardTotalByEmployee', $params);
        $thankcards=$result['thankcard'][0];

        $data =['thankcards' => $thankcards];

        $pdf = PDF::loadView('pdfreport.sentScoreByEmployee',$data); 
        $filename="sent_score_by_employee_".date('Y-m-d H:i:s').'.pdf'; 

        return $pdf->download($filename);
    }
    public function sentScoreDetailByEmployeePDF(Request $request){ 
        $data['dept_id'] =$request->dept_id;
        $data['sub_dept_id']  =$request->sub_dept_id;
        $data['from_emp_id'] =$request->from_emp_id;
        $data['to_emp_id'] =$request->to_emp_id;
        $data['from_date'] =$request->from_date;
        $data['to_date']   = $request->to_date;
        $data['order'] ="DESC"; 

        $params['paramList']=json_encode($data);
        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetSentThankCardTotalByEmployeeView',$params); 
        $thankcards=$result['thankcard'][0];

        $data =['thankcards' => $thankcards];

        $pdf = PDF::loadView('pdfreport.sentScoreDetailByEmployee',$data); 
        $filename="sent_score_detail_by_employee_".date('Y-m-d H:i:s').'.pdf'; 

        return $pdf->download($filename);    
    }
    public function departmentRelationPDF(Request $request){ 
        $data['dept_id'] =$request->department_id;
        $data['sub_dept_id']  =$request->sub_department_id;
        $data['from_date'] =$request->from_date;
        $data['to_date']   = $request->to_date;
        $data['order'] =$request->order;  

        //get thankcard list by department relation
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/Report/GetThankCardTotalByDeptRelation',$params);
        $thankcards=$result['thankcard'][0];

        $data =['thankcards' => $thankcards];

        $pdf = PDF::loadView('pdfreport.department_relation',$data); 
        $filename="department_relation_".date('Y-m-d H:i:s').'.pdf'; 

        return $pdf->download($filename);  
    }
}
