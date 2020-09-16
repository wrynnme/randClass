<?php
class api
{
	private $key_api = 'VaZMq4E6HqFVwPx6n6tqSJCQKQPEZfAC';

	public $url = '';
	public $method = '';
	public $data = '';
	public $results = '';

	public function __construct()
	{
		date_default_timezone_set('Asia/Bangkok');
	}

	public function call()
	{
		$this->results = $this->curl($this->method, $this->url, $this->data, $this->key_api);
	}

	public function curl($method = 'get', $url, $data = null, $apikey = null)
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
}

$api = new api;
$api->method = 'POST';
$api->url = 'http://localhost/randClass/staffs.api.php';
$api->data = 'HELLO WORLD';
$api->key = 'VaZMq4E6HqFVwPx6n6tqSJCQKQPEZfAC';
// $api->res = $api->curl($api->method, $api->url, $api->data, $api->key);
$api->call();
$res = $api->results;
$json = new \stdClass();
$json->data = $res;
echo json_encode($json);
