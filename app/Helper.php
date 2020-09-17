<?php
namespace App;
class Helper
{
 
    public static function  EmployeeID(){
        $employee=\Session::get('UserEmployee'); 
        return $employee['Emp_Id'];
    }
    public static function  EmployeeName(){
        $employee=\Session::get('UserEmployee'); 
        return $employee['Emp_Name'];
    }
    public static function EmployeePhoto(){
        $employee=\Session::get('UserEmployee'); 
        return $employee['Emp_PhotoName']; 
    }
    public static function UserName(){
        $user =\Session::get('User');
        return $user->name;
    }
    public static function HasAccess($method){
       $action= Self::AUTHORIZE();
       $arr_action=explode(",", $action);  

       if(in_array($method,$arr_action)){
          return true;
       }
       return false;
    }
    public static function GET($url,$data){
        $client = new \GuzzleHttp\Client(['verify' => false ]);
        if(count($data)>0){ 
            $response = $client->request('GET', $url, ['query' => $data]); 
        }else{
            $response = $client->request('GET', $url); 
        } 

        $response = json_decode($response->getBody()->getContents(), true);
        return $response;
    }
    public static function POST($url,$data){ 
	 	$guzzleClient = new \GuzzleHttp\Client([
		    'base_uri' => $url,
		    'verify' =>false,
		]); 
		$response = $guzzleClient->post('', [
		    'query' =>$data
		]);

		$response = json_decode($response->getBody()->getContents(), true);
		return $response;
	 }
     public static function PUT($url,$data){
        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $response = $client->request('PUT', $url,['query' => $data ]); 

        $response = json_decode($response->getBody()->getContents(), true);
        return $response;
     }
     public static function DELETE($url,$data){
        $client = new \GuzzleHttp\Client(['verify' => false ]);
        $response = $client->request('DELETE', $url,['query' => $data ]); 

        $response = json_decode($response->getBody()->getContents(), true);
        return $response;
     }
	 public static function PRINTMENU($arr_menu){
		$html ='';        
        for($i=0;$i<count($arr_menu);$i++){ 
            if($arr_menu[$i]['ParentID']==0){
                $html .="<li>"; 
                $html .="<a href='".url($arr_menu[$i]['RoutePath'])."'  title =''><i class='fa fa-lg ".$arr_menu[$i]['Icon']."'></i>";
                $html .="<span  class='menu-item-parent'>";
                $html .=$arr_menu[$i]['MenuName'].'</a>';

                $child="";
                for($j=0;$j<count($arr_menu);$j++){  
                    if($arr_menu[$i]['MenuID']==$arr_menu[$j]['ParentID']){   
                        // $child .="<li>".$arr_menu[$j]['MenuName']."</li>";
		                $child .="<li>"; 
		                $child .="<a href='".url($arr_menu[$j]['RoutePath'])."' title =''><i class='fa fa-lg".$arr_menu[$i]['Icon']."'></i>";
		                $child .="<span >";
		                $child .=$arr_menu[$j]['MenuName'].'</a>';
		         	}
                }
                if($child){
                    $html .="<ul>";
                    $html .=$child;
                    $html .="</ul>";
                }
                $html .="</li>";                 
            }    
        } 
        echo $html;
     }
     public static function AUTHORIZE(){ 
     	$str_path=get_class(\Request::route()->getController()); 
        $arr_path=(explode("\\",$str_path));
        $current_route=$arr_path[3];
        
        $str_action= \Request::route()->getActionName();
        $current_action=(explode("@",$str_action));

     	$authorities= \Session::get('Authorities'); 
     	for($i=0;$i<count($authorities);$i++){ 
     		if($authorities[$i]['Action']==$current_route){  
                $arr_menu_role_action=explode(",", $authorities[$i]['Menu_Role_Action']);  

                $method="";
                switch ($current_action[1]) {
                  case "add":
                    $method="Create";
                    break;
                  case "edit":
                    $method="Update";
                    break;
                  case "delete":
                    $method= "Delete";
                    break;
                  case "department_add":
                    $method="Create";
                    break;
                  case "department_edit":
                    $method="Update";
                    break;
                  case "department_delete":
                    $method="Delete";
                    break;
                  case "sub_department_add":
                    $method ="Create";
                    break;
                  case "sub_department_edit":
                    $method ="Update";
                    break;
                  case "sub_department_delete":
                    $method ="Delete";
                    default:
                }    

                if($method !="" && !in_array($method,$arr_menu_role_action)){
                    return false;
                }
                return $authorities[$i]['Menu_Role_Action'];
     		} 
     	}
     	return false;
    }
  }
?>
