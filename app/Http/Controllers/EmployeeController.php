<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function index(){
    	return view('employee.list');
    }
    public function add(Request $request){
    	if($request->method()=="POST"){             
            return  redirect('employees');
        }else{
            $employee = new Employee;
            $status="Add";
            return view('employee.add',compact('employee','status'));
        }
    }
    public function edit($id){
        $employee= User::find($id);
        $status="Update";
        return view('employee.add',compact('employee'.'status'));
    }
    public function update(){

    }
}
