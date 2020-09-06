<?php

class loginscontr extends logins
{
	public function login()
	{
		$result = $this->INSERT('1', $_SESSION['randService']->staff['staff_id']);
		return $result;
	}
	public function logout()
	{
		$result = $this->INSERT('0', $_SESSION['randService']->staff['staff_id']);
		return $result;
	}
}
