<?php
require_once __DIR__ . '/includes/config.inc.php';

// ! Login
/* $username = 'admin';
$password = '123456789';
$hash = base64_encode(encrypt($username . ':' . $password, $key->login));
$url = 'http://localhost/randClass/stafflogin.php';

$data = array(
	'username' => $username,
	'password' => $password,
	'hash' => $hash
);
$res = curl('POST', $url, json_encode($data));
print_r($res); */

// ! Campaigns Get ID
/* $url = 'http://localhost/randClass/campaigns.api.php?get=getId&id=b1921753-cb8f-4878-a3cf-25d15be3274f';
$hash = base64_encode(encrypt(1, $key->campaigns));

$data = array();
$res = curl('POST', $url, json_encode($data), $key->api);
print_r(json_decode($res)); */

// ! Campaigns getDashboard
/* $url = 'http://localhost/randClass/campaigns.api.php?get=getDashboard';
$hash = base64_encode(encrypt(1, $key->campaigns));

$data = array();
$res = curl('POST', $url, json_encode($data), $key->api);
print_r(json_decode($res)); */

// ! Campaigns nowCampaign
$url = 'http://localhost/randClass/campaigns.api.php?get=nowCampaign';
$hash = base64_encode(encrypt(1, $key->campaigns));

$data = array();
$res = curl('POST', $url, json_encode($data), $key->api);
print_r(json_decode($res));
