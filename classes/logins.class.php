<?php

abstract class logins extends dbh
{

	protected function SELECT_ALL()
	{
		$sql = 'SELECT * FROM `login` ORDER BY `login_time` DESC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute()) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_ID($id)
	{
		$sql = 'SELECT * FROM `login` WHERE `login_id` = ? ORDER BY `login_time` DESC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$id])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_STAFF($id)
	{
		$sql = 'SELECT * FROM `login` WHERE `staff_id` = ? ORDER BY `login_time` DESC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$id])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function INSERT($code, $staff_id)
	{
		$sql = 'INSERT INTO `login` VALUES(NULL, ?, DEFAULT, ?)';
		$db = $this->connect();
		$stmt = $db->prepare($sql);

		try {
			if ($stmt->execute([$code, $staff_id])) {
				return $db->lastInsertId();
			} else {
				return 'Can\'t Insert';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
