<?php
namespace App;
class RoutePath
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
  }
?>