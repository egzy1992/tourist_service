<?php
require_once("FilterHandler.php");

$mainmode = "";
if(isset($_GET["mainmode"]))
	$mainmode = $_GET["mainmode"];

$traveller = "";
if(isset($_GET["traveller"]))
	$traveller = $_GET["traveller"];
		
$mode = "";
if(isset($_GET["mode"]))
	$mode = $_GET["mode"];

$city = "";
if(isset($_GET["city"]))
	$city = $_GET["city"];
/*
controls the RESTful services
URL mapping
*/
switch($mainmode){
	case "cities":
	{
		switch($mode){
			case "all":
				$handler = new FilterHandler();
				$handler->getAllCities();
				break;
			case "travellers":
				$handler = new FilterHandler();
				$handler->getTravellersForCity($city);
				break;
			case "places":
				$handler = new FilterHandler();
				$handler->getPlacesForCity($city);
				break;
			case "" :
				//404 - not found;
				break;
		}
	}
	
	case "travellers":
	{
		switch($mode){
			case "cities":
				$handler = new FilterHandler();
				$handler->getCitiesForTraveller($traveller);
				break;
			case "places":
				$handler = new FilterHandler();
				$handler->getPlacesForTraveller($traveller);
				break;
			case "" :
				//404 - not found;
				break;
		}
	}
}
?>
