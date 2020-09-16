<?php
header('Content-Type: application/json');
require_once __DIR__ . '/class-autoload.inc.php';
require_once dirname(__DIR__) . '/includes/config.inc.php';

$header = new \stdClass();
$header->REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$header->CONTENT_TYPE = $_SERVER['CONTENT_TYPE'];
$header->HTTP_APIKEY = $_SERVER['HTTP_APIKEY'];

if ($header->REQUEST_METHOD == 'GET') {
	// ! GET
} elseif ($header->REQUEST_METHOD == 'POST') {
	// ! POST
	$key = new \stdClass();
	$input = (array) json_decode(file_get_contents('php://input'), true);
	$get = $_GET['get'];
	$campaigns = new campaignsview();
	switch ($get) {
		case 'getAll':
			$res = $campaigns->getAll();
			break;
		case 'getId':
			if (!empty($_GET['id'])) {
				$res = $campaigns->getId($_GET['id']);
			}
			break;
		case 'getDashboard':
			$res = $campaigns->getDashboard();
			break;
		case 'nowCampaign':
			$res = $campaigns->nowCampaign();
			break;
		default:
			break;
	}

	print_r(json_encode(resCode('100', $res)));
} elseif ($header->REQUEST_METHOD == 'PUT') {
	// ! PUT
}
