<?php
class dbh
{
	private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $dbname = "appmgcom_goalward";

	protected function connect()
	{
		try {
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			$pdo = new pdo($dsn, $this->user, $this->pass);
			$pdo->exec("set names utf8");
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_BOTH);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		return $pdo;
	}

	public function __construct()
	{
		@SESSION_START();
		date_default_timezone_set('Asia/Bangkok');
	}

	public function gen_uuid()
	{
		return sprintf(
			'%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
			// 32 bits for "time_low"
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),

			// 16 bits for "time_mid"
			mt_rand(0, 0xffff),

			// 16 bits for "time_hi_and_version",
			// four most significant bits holds version number 4
			mt_rand(0, 0x0fff) | 0x4000,

			// 16 bits, 8 bits for "clk_seq_hi_res",
			// 8 bits for "clk_seq_low",
			// two most significant bits holds zero and one for variant DCE1.1
			mt_rand(0, 0x3fff) | 0x8000,

			// 48 bits for "node"
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff),
			mt_rand(0, 0xffff)
		);
	}

	public function encrypt($data = '', $key = NULL)
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

	public function decrypt($data = "", $key = NULL)
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

	public function curl($url, $body = null)
	{
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			if ($body != null) {
				curl_setopt($ch, CURLOPT_POSTFIELDS, $body); // Body
				curl_setopt($ch, CURLOPT_POST, 1);
			}
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30000);
			curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
			$data = curl_exec($ch);
			curl_close($ch);
			return $data;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
