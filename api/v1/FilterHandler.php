<?php
require_once("SimpleRest.php");
require_once("DBSender.php");
		
class FilterHandler extends SimpleRest {

	function getAllCities() {	
		$dbSender = new DBSender();
		$rawData = $dbSender->getAllCities();
		$this ->handleDBData($rawData);
	}
	
	function getPlacesForCity($cityId) {	
		$dbSender = new DBSender();
		$rawData = $dbSender->getAllPlaces($cityId);
		$this ->handleDBData($rawData);
	}
	
	function getTravellersForCity($cityId) {	
		$dbSender = new DBSender();
		$rawData = $dbSender->getAllTravellers($cityId);
		$this ->handleDBData($rawData);
	}
	
	function getCitiesForTraveller($travellerId) {	
		$dbSender = new DBSender();
		$rawData = $dbSender->getCitiesForTraveller($travellerId);
		$this ->handleDBData($rawData);
	}
	
	function getPlacesForTraveller($travellerId) {	
		$dbSender = new DBSender();
		$rawData = $dbSender->getPlacesForTraveller($travellerId);
		$this ->handleDBData($rawData);
	}
	
	function handleDBData($rawData) {
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No data!');		
		} else {
			$statusCode = 200;
		}
		$requestContentType = 'application/json';//$_POST['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
		
		$result["output"] = $rawData;
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($result);
			echo $response;
		}		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;	
	}
}
?>