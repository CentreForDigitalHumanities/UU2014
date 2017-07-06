<?php

/*
Plugin Name: Import UU Profile photos
Plugin URI: http://www.uu.nl
Description: plugin for importing profile photos on login from http://www.uu.nl/medewerkers/api
Version: 1.0
Author: ICT&Media
Author URI: http://www.uu.nl
License: 
*/

//add_action( 'wp_login', 'load_all_profile_photos', 20 , 1 );

function load_all_profile_photos() {

$blogusers = get_users();
// Array of WP_User objects.
	foreach ( $blogusers as $user ) {
		uu_load_profile_photo($user->user_login);
	}
}

add_action( 'wp_login', 'uu_load_profile_photo', 20 , 1 );

function uu_load_profile_photo($user_login) {

	$solis_id = $user_login;

	$client = new SoapClient("http://www.uu.nl/medewerkers/api/EmployeeApi.asmx?WSDL",
	  		array(
			    "trace"      => 1,    // enable trace to view what is happening
			    "exceptions" => 0,    // disable exceptions
			    "cache_wsdl" => 0)    // disable any caching on the wsdl, encase you alter the wsdl server
			);

	// first check if it is ollowed to import photo
	$results = $client->GetEmployeesPhotoAllowed(
	  array(
	    'solisId' => $solis_id, 
	    'apiKey' => '42BEC693-B559-4B8A-92ED-6B1063E737F3'
	    )
	  );

	$response = $client->__getLastResponse();
	$doc = new DOMDocument();
	$doc->loadXML( $response );
	$allowed = $doc->getElementsByTagName( "SolisID" );

	foreach ($allowed as $node) {
		$list[] = $node->nodeValue;
	}

	if(in_array_case_insensitive($solis_id , $list)) {
		$client = new SoapClient("http://www.uu.nl/medewerkers/api/EmployeeApi.asmx?WSDL",
	  		array(
			    "trace"      => 1,    // enable trace to view what is happening
			    "exceptions" => 0,    // disable exceptions
			    "cache_wsdl" => 0)    // disable any caching on the wsdl, encase you alter the wsdl server
			);

		// get a response from the WSDL zend server function GetEmployeePhotoSquare

		$results = $client->GetEmployeePhotoSquare(
		      array(
		        'solisId' => $solis_id, 
		        'apiKey' => '42BEC693-B559-4B8A-92ED-6B1063E737F3'
		        )
		      );
	 
		$response = $client->__getLastResponse();
		$doc = new DOMDocument();
		$doc->loadXML( $response  );
		$foto = $doc->getElementsByTagName( "GetEmployeePhotoSquareResult" )->item(0)->nodeValue;

		$data = base64_decode($foto);
		$file = ABSPATH . 'wp-content/uu_profile_photos/'. $solis_id . '.jpg';

		if($data != NULL) {
			$success = file_put_contents($file, $data);
		}

		if($data == NULL && file_exists($file)) {
			uu_remove_profile_photo($solis_id);
		}

	} else {
		$file = ABSPATH . 'wp-content/uu_profile_photos/'. $solis_id . '.jpg';
		if(file_exists($file)) {
			uu_remove_profile_photo($solis_id);
		}
	}

}

function uu_remove_profile_photo($solis_id) {
	$file = ABSPATH . 'wp-content/uu_profile_photos/'. $solis_id . '.jpg';
	unlink($file);
}

function in_array_case_insensitive($needle, $haystack) {
 	return in_array( strtolower($needle), array_map('strtolower', $haystack) );
}





?>