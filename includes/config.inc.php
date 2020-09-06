<?php

$key = new \stdClass();
$key->login = '8Np9KCHfTzJBRYr736SFNFTyz4dctYmWcrUPRBmuPeAnMkvYGuPDbCyJJtRDHP5s4UJGpWxPAHZt2V6hL2aDvxdbBQAKy33x2dLCvM5j736m8rLdJmYxsUXHxk57YvC4UqMeKTeTqmvKhqRaZmbbJUzYp8FuvpVxvZUHUDdDwHJcNyEJ28QW6Bq9swVDDndrQamKrTzfZ35XKVuCjHthxZXMtCkjt36ZTg7uzb4Zz3JUdPKxxvQsZvaGJ58A6cSA';
$key->campaigns = '8FJYbe9BALY8n94GZ57b2RQmGeDpn6QHgNZWXBSyWNZepJvME8eEQgDmpVX9bnv6vuQG8SZNaq9wTeFgLvW8gySVbztaQRcrhAAm6qB49CuJp5pWk9KvW9hNtUQv25cBx5Uc6ShFDqKLp7RqjaPzY8MKbzTBD6hhSYstSLGu9YdZrEAcreFgkhDGcaJH7EkdNt7wNMdvCBjCqSLMsD6J47EApXv7X268zju7F5FyHvRGLjty8MfF5N8mTTfv4D8g';
$key->api = 'VaZMq4E6HqFVwPx6n6tqSJCQKQPEZfAC';

/* $header = new \stdClass();
$header->REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
$header->CONTENT_TYPE = $_SERVER['CONTENT_TYPE'];
$header->HTTP_APIKEY = $_SERVER['HTTP_APIKEY']; */

function resCode($resCode = '000', $data = NULL)
{
	$resCode_Split = str_split($resCode);
	switch ($resCode_Split[0]) {
		case '0':
			$res = err($resCode[1] . $resCode[2]);
			break;
		case '1':
			$res = resData($data);
			break;
		default:
			$res = resData($data);
			break;
	}
	return $res;
}

function resData($data)
{
	return array(
		'resCode' => '100',
		'resMessage' => 'success',
		'resResults' => $data
	);
}

function err($resCode = '00')
{
	switch ($resCode) {
		case '01':
			$resMessage = 'Error Data';
			break;
		case '02':
			$resMessage = 'Error Encrypt';
			break;
		case '03':
			$resMessage = 'Error Decrypt';
			break;
		case '04':
			$resMessage = 'Error base64_decode';
			break;
		case '05':
			$resMessage = 'Error openssl_decrypt';
			break;
		case '06':
			$resMessage = 'Error Process';
			break;
		case '07':
			$resMessage = 'Error Request';
			break;
		case '08':
			$resMessage = 'Error Response';
			break;
		default:
			$resMessage = 'Error';
			break;
	}

	return array(
		'resCode' => '0' . $resCode,
		'resMessage' => $resMessage
	);
}

function curl($method = 'get', $url, $data = null, $apikey = null)
{
	try {
		$header = array('Content-Type: application/json', 'APIKEY: ' . $apikey);
		$method = strtolower($method);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);

		switch ($method) {
			case "post":
				curl_setopt($ch, CURLOPT_POST, 1);
				if ($data != null)
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
			case "put":
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				if ($data != null)
					curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				break;
			default:
				if ($data)
					$url = sprintf("%s?%s", $url, http_build_query($data));
		}

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30000);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	} catch (Exception $e) {
		return $e->getMessage();
	}
}

function encrypt($data = '', $key = NULL)
{
	if ($key != NULL && $data != "") {
		$method = "AES-256-ECB";
		$encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA);
		$result = base64_encode($encrypted);
		return $result;
	} else {
		return "String to encrypt, Key is required.";
	}
}

function decrypt($data = "", $key = NULL)
{
	if ($key != NULL && $data != "") {
		$method = "AES-256-ECB";
		$dataDecoded = base64_decode($data);
		$decrypted = openssl_decrypt($dataDecoded, $method, $key, OPENSSL_RAW_DATA);
		return $decrypted;
	} else {
		return "Encrypted String to decrypt, Key is required.";
	}
}
