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
        }else{
        	$data['from_emp_id'] ="%";
        	$data['to_emp_id'] =Helper::EmployeeID();
        	$data['from_date'] =date('Y-m-d H:i:s');
        	$data['to_date']   = date('Y-m-d H:i:s');
        } 
        
        $params['paramList']=json_encode($data); 

        $result=Helper::GET(\Config::get('setting.api_path').'/ThankCards/ThankCardsFemp',$params);
       
        $thankcards=$result['thankcard'][0];
        
        //get Employee list
    	$params['empid']="%";

        $result=Helper::GET(\Config::get('setting.api_path').'/Employees/GetEmployee',$params);
        $employees =$result['employee'][0]; 

        $user =\Session::get('User');
      
    	return view ('home',compact('thankcards','employees'));
    }
    public function activities(){
        return view('activities');
    }
}