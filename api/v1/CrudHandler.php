<?php
require_once("SimpleRest.php");
require_once("DBSender.php");
		
class CrudHandler extends SimpleRest {

	public function create($table,$data_array){
			switch($table){
			case "cities":
				$handler = new CrudHandler();
				echo "1";
				break;
			case "travellers":
				$handler = new CrudHandler();
				echo "2";
				break;
			case "rates":
				$handler = new DBSender();
				echo "3";
				break;
			case "delete" :
				$handler = new DBSender();
				echo "4";
				break;
			case "" :				
				break;
			}
	}
	
	public function get($table,$id){
			switch($table){
			case "cities":
				$handler = new DBSender();
				$rawData = $handler->getRowCities($id);
				$this ->handleDBData($rawData);
				break;
			case "travellers":
				$handler = new DBSender();
				$rawData = $handler->getRowTravellers($id);
				$this ->handleDBData($rawData);
				break;
			case "rates":
				$handler = new DBSender();
				$rawData = $handler->getRowRates($id);
				$this ->handleDBData($rawData);
				break;
			case "places" :
				$handler = new DBSender();
				$rawData = $handler->getRowPlaces($id);
				$this ->handleDBData($rawData);
				break;
			case "" :				
				break;
			}
	}
	
	public function update($table,$data_array){
			switch($table){
			case "cities":
				$handler = new DBSender();
				echo "9";
				break;
			case "travellers":
				$handler = new DBSender();
				echo "10";
				break;
			case "rates":
				$handler = new DBSender();
				echo "11";
				break;
			case "delete" :
				$handler = new DBSender();
				echo "12";
				break;
			case "" :				
				break;
			}
	}
	
	
	
	public function deleteRow($table,$id){
			switch($table){
			case "cities":
				$handler = new DBSender();
				$handler->deleteRowCities($id);
				break;
			case "travellers":
				$handler = new DBSender();
				$handler->deleteRowTravellers($id);
				break;
			case "rates":
				$handler = new DBSender();
				$handler->deleteRowRates($id);
				break;
			case "places" :
				$handler = new DBSender();
				$handler->deleteRowPlaces($id);
				break;
			case "" :				
				break;
			}
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