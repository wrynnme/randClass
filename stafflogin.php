<?php
header('Content-Type: application/json');
require_once __DIR__ . '/includes/class-autoload.inc.php';
require_once __DIR__ . '/includes/config.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$key = new \stdClass();
	$key->login = '8Np9KCHfTzJBRYr736SFNFTyz4dctYmWcrUPRBmuPeAnMkvYGuPDbCyJJtRDHP5s4UJGpWxPAHZt2V6hL2aDvxdbBQAKy33x2dLCvM5j736m8rLdJmYxsUXHxk57YvC4UqMeKTeTqmvKhqRaZmbbJUzYp8FuvpVxvZUHUDdDwHJcNyEJ28QW6Bq9swVDDndrQamKrTzfZ35XKVuCjHthxZXMtCkjt36ZTg7uzb4Zz3JUdPKxxvQsZvaGJ58A6cSA';
	$input = (array) json_decode(file_get_contents('php://input'), true);
	$input['hash'] = base64_decode($input['hash']);
	$decrypted = decrypt($input['hash'], $key->login);
	$decrypthash = explode(':', $decrypted);
	if (empty($decrypted) || count($decrypthash) != 2 || $decrypthash[0] != $input['username'] || $decrypthash[1] != $input['password']) {
		$err = resCode('001');
		echo json_encode($err);
	} else {
		$staffs = new staffscontr();
		$login = $staffs->Login($input['username'], $input['password']);
		print_r(json_encode(resData($login)));
	}
}
