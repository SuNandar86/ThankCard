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
    public static function POST($url,$data){ 
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch,CURLOPT_POST, 1);		
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		
		// execute!
		$result = curl_exec($ch);

		// close the connection, release resources used
		curl_close($ch);

		return json_decode($result,true);
		// do anything you want with your response
		 
	 }
  }
?>