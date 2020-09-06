<?php
header('Content-Type: application/json');
require_once __DIR__ . '/includes/class-autoload.inc.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

	// ! GET

	if (isset($_GET['data'])) {
		$tel = decrypt($_GET['data'], 'wXt5zfCnyKpbZMPWms4UVEDcZ6YR6eydaWDh2Y32DuZYVkMN3egmPuJvvR8ysdZ46cU5sqbvRLuU7WJ7zsXSnxjyNcpJ2w37cmWSjpf7JN5WNdN3qNdqAWym6YcFNEWRj4tXj2LVUQgvP6hqyJah6gGcq4gvfGvP369A32fRWVHmXERsYVUc29KYbT5uhWg7H9Wj3CMM469SwfKMnrNuauApuUwL7y8jAaR2TZCLqX2bNkt95pH6ZUGN38HadANg6Lf9dXP8Rz6fDgLShk6ZBuretGxYEyzRNwyMFhGCuEK7Zf7J5B92GmbPrc3xg2NTdNj9SnsCRj43wJ7wJVpXcfkehzTZ2HAaan95xYu7yQ3ACZgg3dTj64FCnZbWhESN2kcwP3uD5aTPyTFvLbqBYRJa5us5FnFzhPFGGvTTt2z8CGQ4AdERCMNReXrAmhGecfMv46WatUMc5XPUbFnymgejZn9PfKnr3Nkqtg9hNdHGNGEVNHsyYmBRSKRbPfeZ6LY4AebxtesdXXKCJMup9pgrTafraLUXxMeB6LLUPqQzdYdz2SzstAvwk6hPZAy8kXmp9XfUcgqmd4dTBXKA8MQEmYyaashrWLZHMkaNWjbybYUZESxXkRpHvJ2wCgVj7daJ4SbSME4TueegBYvcjUMGGwVGeRWF2bB7UtV7R8UhcTEJxpXGnBBBPpzaCZzLM8qpLNksE4utYACc4AAqww3hHqBnmPhceT8pMgb3cGzn3pAtxgXdKW7snaTrzNZxg8unkmMT9YC7WyHSSgdwnJaZKGwkLc9NcFpSLbWu9gNgDK8fzEX9Bb7GmgpTCT7J6skqE8hSj3QVqm5xBKsaVgTNS8MqnBdLs3tkmmHLwQBX5Cnpg9XNy4CKeJSGRfmr5WR2BKnyGvR9QDdfnLdBMwUvfc69KLbmxSYuQnEdCYpJFzLwYN3w6gPA63ptCCYPe3AQXYcANgV7NgZ2AhhUhPtjwLha8zU7dUyyK5XgfPzL2RUxVnNAV6MEB2PQwG2F');
		if (empty($tel)) {
			$data = array(
				'resCode' => '901',
				'resMessage' => 'Error Decrypt'
			);
			echo json_encode($data);
			exit();
		} else {
			$staffs = new staffsview();
			$staff = new \stdClass();
		}
	}
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

	// ! POST

	$post_key = 'TGqksv7ca7GshmrA5GTUVghcTpV7CmkLaB9fmbaybesRHLMbkCd7qG4wYbTcyRFMhHUzhKGCNCnJaUhARzPYvvT5VKqbwdcwfN3gy5NfxhyEhX9f42LXU59NGsvHgGb6Xd4uS8DhT6syt7x8HC9272vbJU2QEG7SRH5eGh3QdQGBaqNYJZvtt3FRa5zUAqm8eaWB8hDkPayHUgejrmJBfcyYLJmyR8dADzz35MtQHGQWKav3aPYZwYZPH6qmg2fEDw2SxAtby9a3mXQUvBqSnLmq86hhfGqa7YEbHpSrnkWzuq6G4ctc2G2ZVcBLWJ73vgVEmewRR5KwBEhkQmJ6QhJbnMBYMZXYCjbDkxrCYPy4gfYY2rEd9vd9VVkYVQMz9qSwk47ZSVJgeNV22JaMwQegPkuxQppKDng8LjnaPL4FDPKbU8AdQj3JBMYeTgnhx2FwFx3ckvbxJHBVRynnrEsFJyhK7qcBqAKZ695xWWAdvdcuqMeTBjvPAF4cTt9VV56RKLF9TWwXEZjy9pVkfpGFUfLB2brMvwdvkvt9V3xGmTDJtYH7LhZfBebU47hZn7Ptbmbr938cRBjwQCdyZRLArLJaGm38Ped2PX3NxqcUKxdhGV3Pv3ba8GKKVLXwyJW3SqKXd59b7udXJ3cbaQaRnC4AbuyGdDPV5wGpz89VyhpTRW3nb4WvzaE44MXNpBLQsXNmmt25DUFaGP9HNVuw4Y2nzBVprQncg7x2pT4C42anwuaAu7ScmLPC8gssu2R46UuZstqeyQNwD8GYPkWab82GgFT2NUcAcbeKmtfrqzYQqfFWkNT3BtdYzAPf9yNBLez2x7CWwgb7Fu5zazX2uXEGZ3sENWVCCrw76nZw9qKLUeydE5JhXPEwkq3fsgbFXZYpSwWNK9xCbbNVmwqGnjtR8C9AcBhNM36qsRkEcvhAbhr87D3sQS4MMWzAJtnVYTx72MLsV6F9pjXCRVeDRcnjcJrtb2tJNVG9XH7qe2R5vLBBMgZdFz2fFcUp';
	$input = (array) json_decode(file_get_contents('php://input'), true);
	$input['hash'] = base64_decode($input['hash']);
	$input_decrypt = decrypt($input['hash'], $post_key);
	if ($input['username'] != $input_decrypt) {
		echo json_encode('error hash data doesn\'t match');
		exit();
	} else {
		$username = $input_decrypt;
		$staffs = new staffsview();
		$staff = new \stdClass();
		$staff->getUsername = $staffs->getUsername($username);
		resData($data);
		print_r($staff->getUsername);
	}
}
