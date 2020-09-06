<?php
header('Content-Type: application/json');
require_once __DIR__ . '/includes/class-autoload.inc.php';
require_once __DIR__ . '/includes/config.inc.php';

$header = new \stdClass();
$header->REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$header->CONTENT_TYPE = $_SERVER['CONTENT_TYPE'];
$header->HTTP_APIKEY = $_SERVER['HTTP_APIKEY'];

if ($header->REQUEST_METHOD == 'GET') {
	// ! GET
} elseif ($header->REQUEST_METHOD == 'POST') {
	// ! POST
	$key = new \stdClass();
	$key->campaigns = '8FJYbe9BALY8n94GZ57b2RQmGeDpn6QHgNZWXBSyWNZepJvME8eEQgDmpVX9bnv6vuQG8SZNaq9wTeFgLvW8gySVbztaQRcrhAAm6qB49CuJp5pWk9KvW9hNtUQv25cBx5Uc6ShFDqKLp7RqjaPzY8MKbzTBD6hhSYstSLGu9YdZrEAcreFgkhDGcaJH7EkdNt7wNMdvCBjCqSLMsD6J47EApXv7X268zju7F5FyHvRGLjty8MfF5N8mTTfv4D8g';
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
			# code...
			break;
	}

	// print_r($res);
	print_r(json_encode(resCode('100', $res)));
} elseif ($header->REQUEST_METHOD == 'PUT') {
	// ! PUT
}
