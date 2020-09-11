<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\SubDepartment;
use App\Helper;

class DepartmentController extends Controller
{
    public function index(){
        $params['departmentId']="%"; 

        $result=Helper::GET( \Config::get('setting.api_path').'/Departments/GetDepart',$params); 
        $departments =$result['department'][0]; 

       return view('department.list',compact('departments'));
    }
    public function department_add(Request $request){ 
        $message="";
        $data =[];
        $request->flash();
        if($request->method()=="POST"){ 
            $data['departName'] =$request->name;
            $params['paramList']=json_encode($data);

            $result=Helper::POST( \Config::get('setting.api_path').'/Departments/Createdept',$params);

            if($result['status'][0]['statuscode']=="200"){
                return redirect('departments');
            }elseif($result['status'][0]['statuscode']=="406"){
                \Session::flash('dept.message',"Department named “".$request->name ."” is already taken!");
                \Session::flash('status', 'alert-warning');  
            }             
        }  
        
        $action ="Add";
        $department =new Department;
        return view('department.add',compact('department','action'));
    }
    public function department_edit($id){
        $params['departmentId']=$id; 

        $result=Helper::GET( \Config::get('setting.api_path').'/Departments/GetDepart',$params);
        $departments =$result['department'][0]; 
       
        $department =new Department; 
        $department->id=$departments[0]['Id'];
        $department->name=$departments[0]['Name'];  
        
        $action ="Edit";
   
        return view('department.add',compact('department','action')); 
    }
    public function department_update(Request $request,$id){
        $data['departName'] =$request->name;
        $data['Id']  = $id;
        $params['paramList']=json_encode($data);

        $result=Helper::PUT( \Config::get('setting.api_path').'/Departments/Updatedepart',$params);
    
        $message="";
        if($result['status'][0]['statuscode']=="200"){
            return redirect('departments');
        }elseif($result['status'][0]['statuscode']=="304"){
            \Session::flash('dept.message',"Department named “".$request->name."” is already taken"); 
            \Session::flash('status', 'alert-warning'); 
        } 
        return redirect('department/edit/'.$id); 
    } 
    public function department_delete($id){
        $data['Id']  = $id; 
        $params['paramList']=json_encode($data);

        $result=Helper::DELETE( \Config::get('setting.api_path').'/Departments/deleteDepartment',$params);
    
        $message="";
        if($result['status'][0]['statuscode']=="200"){
            $message ='Successfully deleted!'; 
        }elseif($result['status'][0]['statuscode']=='400'){ 
            $message = 'Department is not found!'; 
        }elseif($result['status'][0]['statuscode']=='304'){
            $message = 'Unable to delete!';  
        }
        \Session::flash('message', $message); 
        return  redirect('departments');
    }   
    public function sub_departments(){
        $params['subdptid']="%"; 

        $result=Helper::GET( \Config::get('setting.api_path').'/SubDepartments/GetSubDept',$params); 
        $subdepartments =$result['subdepartment'][0]; 

       return view('subdepartment.list',compact('subdepartments'));
    }
     public function sub_department_add(Request $request){ 
        $message="";
        $status ="";

        $request->flash();

        if($request->method()=="POST"){   
            $data['Name'] =$request->name;
            $data['Dept_Id']=$request->department_id;

            $params['paramList']=json_encode($data);

            $result=Helper::POST( \Config::get('setting.api_path').'/SubDepartments/SubDepartment',$params);

            if($result['status'][0]['statuscode']=="200"){
                return redirect('subdepartments');                
            }elseif($result['status'][0]['statuscode']=="406"){
                \Session::flash('subdept.message',"Sub Department named “".$request->name ."” is already taken!");
                \Session::flash('status',"alert-warning"); 
            }
        } 
        $params['departmentId']="%"; 
     
        $result=Helper::GET( \Config::get('setting.api_path').'/Departments/GetDepart',$params);
        $departments =$result['department'][0]; 

        $subdepartment = new Department;
        $action ="Add";
        return view('subdepartment.add',compact('subdepartment','departments','action'));
        
    }    
    public function sub_department_edit($id){
        
        $params['departmentId']="%";

        $result=Helper::GET( \Config::get('setting.api_path').'/Departments/GetDepart',$params);
        $departments =$result['department'][0];

        $sub_params['subdptid']=$id; 
        $result=Helper::GET( \Config::get('setting.api_path').'/SubDepartments/GetSubDept',$sub_params);
        
        $subdepartments =$result['subdepartment'][0][0]; 
        
        $subdepartment =new SubDepartment; 
        $subdepartment->id=$subdepartments['Sub_Dept_Id'];
        $subdepartment->name=$subdepartments['Sub_Dept_Name']; 
        $subdepartment->department_id=$subdepartments['Dept_Id']; 

        $action ="Edit";
        return view('subdepartment.add',compact('subdepartment','departments','action'));
    }
    public function sub_department_update(Request $request,$id){

        $request->flash();
        
        $data['Id']  = $id;
        $data['Name'] =$request->name; 
        $data['Dept_Id']=$request->department_id;
        $params['paramList']=json_encode($data);

        $result=Helper::PUT( \Config::get('setting.api_path').'/SubDepartments/UpdateSubDept',$params);

        if($result['status'][0]['statuscode']=="200"){
            return redirect('subdepartments');
      
        }elseif($result['status'][0]['statuscode']=="406"){ 
            \Session::flash('subdept.message',"Department named “".$request->name ."” is already taken!");
            \Session::flash('status',"alert-warning");  
        } 
        
        return redirect('subdepartment/edit/'.$id); 
    }
    public function sub_department_delete($id,$deptid){
        $data['Id']  = $id;
        $data['Dept_Id']=$deptid;
        $params['paramList']=json_encode($data);

        $result=Helper::DELETE( \Config::get('setting.api_path').'/SubDepartments/DeleteSubDept',$params);
    
        $message="";
        if($result['status'][0]['statuscode']=="200"){
            $message ='Successfully deleted!'; 
        }elseif($result['status'][0]['statuscode']=='400'){ 
            $message = 'Department is not found!'; 
        }elseif($result['status'][0]['statuscode']=='304'){
            $message = 'Unable to delete';  
        }
        \Session::flash('message', $message); 
        return  redirect('subdepartments');
    }
    
}
