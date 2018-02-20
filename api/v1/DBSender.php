<?php
require_once("dbcontroller.php");

Class DBSender {
	private $answer = array();
	
	public function getAllCities(){
		$query = "SELECT * FROM cities";
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}	
	
	public function getAllPlaces($cityId){
		$query = "SELECT places.placeId, places.placeName, cities.cityName, places.distance, places.rating  FROM places 
		INNER JOIN cities ON places.city =cities.cityId WHERE places.city=".$cityId;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	public function getAllTravellers($cityId){
		$query = "SELECT travellers.travellerId, travellers.name FROM travellers
		INNER JOIN rates ON rates.traveller = travellers.travellerId
		INNER JOIN places ON rates.place = places.placeId
        INNER JOIN cities ON places.city = cities.cityId
		WHERE cities.cityId=".$cityId;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	
	public function getCitiesForTraveller($travellerId){
		$query = "SELECT cities.cityId, cities.cityName FROM cities
		INNER JOIN places ON places.city = cities.cityId
		INNER JOIN rates ON rates.place = places.placeId
		INNER JOIN travellers ON rates.traveller = travellers.travellerId
		WHERE travellers.travellerId=".$travellerId;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}

	
	public function getPlacesForTraveller($travellerId) {
		$query = "SELECT places.placeId, places.placeName, cities.cityName, places.distance, rates.rating FROM travellers
		INNER JOIN rates ON rates.traveller = travellers.travellerId
		INNER JOIN places ON rates.place = places.placeId
        INNER JOIN cities ON places.city = cities.cityId
		WHERE travellers.travellerId=".$travellerId;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;	
	}
	
	//delete rows queries
	public function deleteRowCities($id){
		$query = "DELETE FROM rates WHERE place IN (SELECT placeId FROM places WHERE city=".$id.");";
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		$query = "DELETE FROM places WHERE city=".$id.";";
		$this->answer = $dbcontroller->executeSelectQuery($query);
		$query = "DELETE FROM cities WHERE cityId = ".$id.";";
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	public function deleteRowTravellers($id){
		$query = "DELETE FROM rates WHERE traveller=".$id.";";
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		$query = "DELETE FROM travellers WHERE travellerId = ".$id.";";
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	public function deleteRowPlaces($id){
		$query = "DELETE FROM rates WHERE place=".$id.";";
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		$query = "DELETE FROM places WHERE placeId = ".$id.";";
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	public function deleteRowRates($id){
		$query = "DELETE FROM rates
        WHERE rateId = ".$id;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	//get rows queries
	public function getRowCities($id){
		$query = "SELECT cityId,cityName FROM cities
		WHERE cityId=".$id;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	public function getRowTravellers($id){
		$query = "SELECT travellerId,name FROM travellers
		WHERE travellerId=".$id;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;
	}
	
	public function getRowPlaces($id){
		$query = "SELECT places.placeId, places.placeName, cities.cityName, places.distance, places.rating FROM places
        INNER JOIN cities ON places.city = cities.cityId
		WHERE places.placeId=".$id;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;	
	}
	
	public function getRowRates($id){
		$query = "SELECT rates.rateId, places.placeName, cities.cityName, travellers.name, rates.rating FROM rates
		INNER JOIN travellers ON rates.traveller = travellers.travellerId
		INNER JOIN places ON rates.place = places.placeId
        INNER JOIN cities ON places.city = cities.cityId
		WHERE rates.rateId=".$id;
		$dbcontroller = new DBController();
		$this->answer = $dbcontroller->executeSelectQuery($query);
		return $this->answer;	
	}
	
	
	
}
?>