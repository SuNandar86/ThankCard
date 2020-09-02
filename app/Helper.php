<?php
namespace App;
class Helper
{
    public static function GET($url){ 
	  	$ch = curl_init($url);

	  	// Set options
	  	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	  	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	  	//Execute curl handle add results to data return array.
	  	$result = curl_exec($ch); 

	 	// Close cURL and return response.
	 	curl_close($ch);
	  	return json_decode($result,true);
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
		                $child .="<span  class='menu-item-parent'>";
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
 

     	$authorities= \Session::get('Authorities'); 
     	for($i=0;$i<count($authorities);$i++){ 
     		if($authorities[$i]['Action']==$current_route){ 
     		 	return true;
     		} 
     	}
     	return false;
     }
  }
?>       