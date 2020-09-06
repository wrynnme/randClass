<?php

class staffscontr extends staffs
{

	public function add($data)
	{
		$name = $data[1]['value'];
		$username = strtolower($data[2]['value']);
		$password = $data[3]['value'];
		$olds = new staffsview();
		$old = new \stdClass();
		$old->check = $olds->getUsername($username);

		if (empty($name) || empty($username) || empty($password)) {
			return json_encode(false);
		} else {
			if (empty($old->check)) {
				$stmt = $this->INSERT($name, $username, $password);
				return $stmt;
			} else {
				return json_encode(false);
			}
		}
	}
	public function create($name, $username, $password)
	{
		$stmt = $this->INSERT($name, $username, $password);
		return $stmt;
	}

	public function Login($username, $password)
	{
		$staff = $this->SELECT_USERNAME($username);
		if (empty($staff)) {

			// ! ไม่มี username
			return 'error username';
		} else {
			if (password_verify($password, $staff['staff_password'])) {
				// $this->setSession($staff);
				$data = array(
					'staff_id' => $staff['staff_id'],
					'staff_name' => $staff['staff_name'],
					'staff_permission' => $staff['staff_permission'],
					'staff_status' => $staff['staff_status'],
				);
				return $data;
			} else {
				// ! รหัสผ่านไม่ถูก
				return 'error password';
			}
		}
	}

	public function setSession($array)
	{
		$_SESSION['rand'] = new \stdClass();
		foreach ($array as $key => $value) {
			if (strstr($key, 'staff')) {
				$_SESSION['rand']->staff[$key] = $value;
			}
		}
		$logins = new loginscontr();
		$logins->login();
		return true;
	}

	public function edit($attr, $value)
	{
		$id = decrypt($_SESSION['randBack']->staff['id'], $_SESSION['randBack']->key['staffsedit']);
		$result = $this->UPDATE($attr, $value, $id);
		return $result;
	}

	public function editPassword($password, $id)
	{
		$id = decrypt($id, $_SESSION['randBack']->key['respwd']);
		if (empty($id)) {
			return false;
		} else {
			$password = password_hash($password, PASSWORD_BCRYPT);
			$result = $this->UPDATE('staff_password', $password, $id);
			return $result;
		}
	}

	public function remove($id)
	{
		$result = $this->DELETE($id);
		if ($_SESSION['randBack']->staff['staff_id'] == $id) {
			// echo $_SESSION['randBack']->staff['staff_id'] . '<br>' . $id . '<br>';
			unset($_SESSION['randBack']);
		}
		return $result;
	}
}
