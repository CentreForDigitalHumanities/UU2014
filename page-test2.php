<?php get_header(); 
/**

 */ ?>


<?php get_template_part( 'parts/page-header-2col'); ?> 

<?php



	$solis_id = 'aarts101';

	
		$client = new SoapClient("http://www.uu.nl/medewerkers/api/EmployeeApi.asmx?WSDL",
	  		array(
			    "trace"      => 1,    // enable trace to view what is happening
			    "exceptions" => 0,    // disable exceptions
			    "cache_wsdl" => 0)    // disable any caching on the wsdl, encase you alter the wsdl server
			);

		// get a response from the WSDL zend server function GetEmployeePhotoSquare

		$results = $client->GetEmployee(
		      array(
		        'solisId' => $solis_id, 
		        'apiKey' => '42BEC693-B559-4B8A-92ED-6B1063E737F3',
		        'startdate' => '2010-05-24T18:13:00'
		      )
		);

		// $results = $client->FreeSearch(
		//       array(
		//         // 'solisId' => $solis_id, 
		//         'apiKey' => '42BEC693-B559-4B8A-92ED-6B1063E737F3',
		//         'searchstring' => 'institutions',
		//         'filter' => ''
		//       )
		// );
	 
		$response = $client->__getLastResponse();
		$doc = new DOMDocument();
		$doc->loadXML( $response  );
		$test = $doc->getElementsByTagName( "GetEmployeeResult" )->item(0)->nodeValue;
		echo '<pre>';
		//print_r($test);
		//print_r($response);
		//$response->find("focusarea");

		function find() {
    if ($search == false) {
        return $response->flatArray;
    } else {
        if (isset($response->flatArray[$search])) {
            $result = $response->flatArray[$search];
        } else {
            return false;
        }
    }

    if(count($result)==1){
        return $result[0];
    }
    else{
        return $result;
    }
}

		echo '</pre>';
	



/*
 * Searches the pre flattened array for a given key. If there is only one
 * result, this will return a single value, if there are multiple results,
 * it will return an array of values.
 * 
 * @param string; $search - search for a response with this key
 */


?>

<?php get_template_part( 'parts/page-footer-2col'); ?> 

<?php get_footer();