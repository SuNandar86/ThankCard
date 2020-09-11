<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Helper;

class RoleController extends Controller
{
    public function index(){
        $params['roleid']="%";

        $result=Helper::GET( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0]; 

        return view('role.list',compact('roles'));
    }
    public function add(Request $request){
        $message="";
        $data=[];
        $request->flash();
        if($request->method()=="POST"){ 
            $data['Name'] =$request->name;
            $params['paramList']=json_encode($data);

            $result=Helper::POST( \Config::get('setting.api_path').'/Users/Role',$params);

            if($result['status'][0]['statuscode']=="200"){
                \Session::flash('role.message','New Role is successfully added!'); 
                \Session::flash('status', 'alert-success');  
            }elseif($result['status'][0]['statuscode']=="406"){
                \Session::flash('role.message',"Role named “".$request->name."” is already taken!"); 
                \Session::flash('status', 'alert-warning'); 
            }            
        }  
        $action ="Add";
        $user_role = new Role;

        return view('role.add',compact('user_role','action')); 
    }
    public function edit($id){
        $params['roleid']=$id;

        $result=Helper::GET( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0]; 
       
        $user_role =new Role; 
        $user_role->id=$roles[0]['Id'];
        $user_role->name=$roles[0]['Name'];  
        
        $action ="Edit";
        
        return view('role.add',compact('user_role','action','roles'));
    }
    public function update(Request $request,$id){ 
        $request->flash();
        
        $data['Name'] =$request->name;
        $data['Id']  = $id;
        $params['paramList']=json_encode($data);

        $result=Helper::POST( \Config::get('setting.api_path').'/Users/UpdateRole',$params);
    
        if($result['status'][0]['statuscode']=="200"){
            \Session::flash('role.message','Role data is successfully updated!'); 
            \Session::flash('status', 'alert-success');             
        }elseif($result['status'][0]['statuscode']=="406"){
            \Session::flash('role.message',"Role name “".$request->name."” is already taken!"); 
            \Session::flash('status', 'alert-warning');  
        }elseif($result['status'][0]['statuscode']=="304"){
            \Session::flash('role.message',"Unable to delete!Role does not exitst!"); 
            \Session::flash('status', 'alert-danger'); 
        }
        
        return redirect('role/edit/'.$id); 
    }
    public function delete($id){
        $data['Id']  = $id;
        $params['paramList']=json_encode($data);

        $result=Helper::POST( \Config::get('setting.api_path').'/Users/DeleteRole',$params);
        
        $message="";
        if($result['status'][0]['statuscode']=="200"){
            $message ='Successfully deleted!'; 
        }elseif($result['status'][0]['statuscode']=='406'){ 
            $message = 'Unable to delete!This role is assigned to User.'; 
        }elseif($result['status'][0]['statuscode']=='304'){
            $message = 'Error occur in deleting role!';  
        }
        \Session::flash('message', $message); 
        return  redirect('roles');
    }
    public function GetRole($data){
        $user_role = new Role;
        $user_role->id = isset($data['Id'])?$data['Id']:"";
        $user_role->name = isset($data['Name'])?$data['Name']:"";

        return $user_role;
    }
}
