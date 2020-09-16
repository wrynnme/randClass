<?php
header('Content-Type: application/json');
require_once __DIR__ . '/class-autoload.inc.php';
require_once dirname(__DIR__) . '/includes/config.inc.php';

$header = new \stdClass();

$header->REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$header->CONTENT_TYPE = $_SERVER['CONTENT_TYPE'];
$header->HTTP_APIKEY = $_SERVER['HTTP_APIKEY'];

echo $header->REQUEST_METHOD;

if (strtolower($header->REQUEST_METHOD) == 'get') {
} else if (strtolower($header->REQUEST_METHOD) == 'post') {
	$key = new \stdClass();
	$input = (array) json_decode(file_get_contents('php://input'), true);
	$get = $_GET['get'];
	$staffs = new staffsview();
} else {
	http_response_code(405);
}


/* $myObj = new \stdClass();
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myJSON = json_encode($myObj);
echo $myJSON; */
