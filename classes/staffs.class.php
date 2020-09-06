<?php

abstract class staffs extends dbh
{

	/**
	 * ! SELECT
	 */

	protected function SELECT_ID($ID)
	{
		$sql = 'SELECT `staff_id`, `staff_name`, `staff_username`, `staff_permission`, `staff_status` FROM `staff` WHERE `staff_id` = ?';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$ID])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_USERNAME($username)
	{

		$sql = 'SELECT `staff_id`, `staff_name`, `staff_username`, `staff_password`, `staff_permission`, `staff_status` FROM `staff` WHERE `staff_username` = ? AND `staff_status` = ?';

		if (!$stmt = $this->connect()->prepare($sql)) {
			echo 'Can\'t prepare';
			return false;
		} else {
			if ($stmt->execute([$username, '1'])) {
				$rows = $stmt->fetch(PDO::FETCH_ASSOC);
				if (empty($rows)) {
					return false;
				} else {
					return $rows;
				}
			} else {
				return 'Can\'t Select';
			}
		}
	}

	protected function SELECT_ALL()
	{
		$sql = 'SELECT `staff_id`, `staff_name`, `staff_username`, `staff_permission`, `staff_status` FROM `staff` ORDER BY `staff_permission` ASC, `staff_datetime` ASC';
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

	protected function SELECT_DASHBOARD()
	{
		$sql = 'SELECT `staff_id`, `staff_name`, `staff_username`, `staff_permission` FROM `staff` ORDER BY `staff_permission` ASC, `staff_datetime` ASC';
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


	/**
	 * ! INSERT
	 */
	protected function INSERT($name, $username, $password)
	{
		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, NULL, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();

		$sql = 'INSERT INTO `staff` VALUES(?, ?, ?, ?, DEFAULT, DEFAULT, DEFAULT)';
		$db = $this->connect();
		$stmt = $db->prepare($sql);

		$id = $this->gen_uuid();

		$hashpass = password_hash($password, PASSWORD_BCRYPT);
		try {
			if ($stmt->execute([$id, $name, $username, $hashpass])) {
				if ($log_stmt->execute([$log_id, 'staff', 'Insert staff', $id, $_SESSION['randBack']->staff['staff_id']])) {
					return true;
				} else {
					return 'Can\'t Insert Log';
				}
			} else {
				return 'Can\'t Insert Data';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * ! UPDATE
	 */

	protected function UPDATE($attr, $value, $id)
	{
		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, ?, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();

		$sql = "UPDATE `staff` SET `" . $attr . "` = ? WHERE `staff_id` = ?";
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$value, $id])) {
				if ($log_stmt->execute([$log_id, 'staff', $attr, $value, $_SESSION['randBack']->staff['staff_id'], 'Update staff (staff_id) : ' . $id])) {
					return true;
				} else {
					return 'Can\'t Insert Log';
				}
			} else {
				return 'Can\'t Update Data';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * ! DELETE
	 */

	protected function DELETE($id)
	{

		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, ?, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();
		$log_id2 = $this->gen_uuid();

		$sql = 'DELETE FROM `login` WHERE `staff_id` = ?';
		$sql2 = 'DELETE FROM `staff` WHERE `staff_id` = ?';
		$stmt = $this->connect()->prepare($sql);
		$stmt2 = $this->connect()->prepare($sql2);

		try {
			if ($stmt->execute([$id]) && $stmt2->execute([$id])) {
				if ($log_stmt->execute([$log_id, 'staff', 'Delete login', $id, $_SESSION['randBack']->staff['staff_id'], 'Delete staff']) && $log_stmt->execute([$log_id2, 'staff', 'Delete staff', $id, $_SESSION['randBack']->staff['staff_id'], 'Delete staff'])) {
					return true;
				} else {
					return 'Can\'t Insert Log';
				}
			} else {
				return 'Can\'t Delete Data';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
