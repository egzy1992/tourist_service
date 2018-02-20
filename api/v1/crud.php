<?php
require_once("CrudHandler.php");

$method = "";
if(isset($_GET["method"]))
	$method = $_GET["method"];

$table = "";
if(isset($_GET["table"]))
	$table = $_GET["table"];
		
$id = "";
if(isset($_GET["id"]))
	$id = $_GET["id"];

$data_array = [
	"city_name" => "",
	"city" => "",
	"distance" => "",
	"rating" => "",
	"place_name" => "",
	"palce" => "",
	"traveller" => "",
	"name" => ""
];

foreach($data_array as $key => $val){
	if(isset($_GET[$key]))
		$data_array[$key] = $_GET[$key];
}	



switch($method){
	case "post":
		$handler = new CrudHandler();
		$handler->create($table,$data_array);
		break;
	case "get":
		$handler = new CrudHandler();
		$handler->get($table,$id);
		break;
	case "put":
		$handler = new CrudHandler();
		$handler->update($table,$data_array);
		break;
	case "delete" :
		$handler = new CrudHandler();
		$handler->deleteRow($table,$id);
		break;
	}
	
?>