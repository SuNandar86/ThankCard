<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Helper;

class RoleController extends Controller
{
    public function index(){
        $params['roleid']="%";
        $result=Helper::POST( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0]; 

        return view('role.list',compact('roles'));
    }
    public function add(Request $request){
        if($request->method()=="POST"){ 
            $data['Name'] =$request->name;
            $params['paramList']=json_encode($data);

            $result=Helper::POST( \Config::get('setting.api_path').'/Users/Role',$params);

            if($result['status'][0]['statuscode']=="200"){
                return  redirect('roles');
            }
            
        }else{
            $user_role = new Role; 

            return view('role.add',compact('user_role'));
        }
    }
    public function edit($id){
        $params['roleid']=$id;

        $result=Helper::POST( \Config::get('setting.api_path').'/Users/GetRole',$params);
        $roles =$result['role'][0]; 
       
        $user_role =new Role; 
        $user_role->id=$roles[0]['Id'];
        $user_role->name=$roles[0]['Name'];  
 
        return view('role.add',compact('user_role'));
    }
    public function update(Request $request,$id){ 
        $data['Name'] =$request->name;
        $data['Id']  = $id;
        $params['paramList']=json_encode($data);

        $result=Helper::POST( \Config::get('setting.api_path').'/Users/UpdateRole',$params);
    
        if($result['status'][0]['statuscode']=="200"){
            return  redirect('roles');
        }
    }
    public function delete($id){
        $data['Id']  = $id;
        $params['paramList']=json_encode($data);

        $result=Helper::POST( \Config::get('setting.api_path').'/Users/DeleteRole',$params);
    
        if($result['status'][0]['statuscode']=="200"){
            return  redirect('roles');
        }
    }
}
