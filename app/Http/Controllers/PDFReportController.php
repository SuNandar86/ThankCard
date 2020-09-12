<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PDFReportController extends Controller
{
    public function  scoreByDepartment(){ 
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

        $pdf = PDF::loadView('pdfreport.scoreByDepartment', $thankcards); 
        $filename="score_by_department_".date('Y-m-d H:i:s'); 
        return $pdf->download($filename);
    }
}
