<?php
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
