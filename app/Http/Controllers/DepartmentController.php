<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SubDepartment;

class DepartmentController extends Controller
{
    public function index(){
      return view('department.list');
    }
    public function department_add(Request $request){ 
        if($request->method()=="POST"){             
            return  redirect('departments');
        }else{
            $department = new Department;
            $status="Add";
            return view('department.add',compact('department','status'));
        } 
    }
    public function department_edit($id){
        $employee= Employee::find($id);
        $status="Update";
        return view('department.add',compact('employee'.'status'));
    }
    public function department_update(){

    }
    public function sub_departments(){
    	return view('sub_department.list');
    }
     public function sub_department_add(Request $request){ 
        if($request->method()=="POST"){             
            return  redirect('subdepartments');
        }else{
            $subdepartment = new SubDepartment;
            $status="Add";
            return view('subdepartment.add',compact('subdepartment','status'));
        } 
    }
    public function sub_department_edit($id){
        $subdepartment= SubDepartment::find($id);
        $status="Update";
        return view('subdepartment.add',compact('subdepartment'.'status'));
    }
    public function sub_department_update(){

    }
}
