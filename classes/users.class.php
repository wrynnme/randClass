<?php
abstract class users extends dbh
{

	/**
	 * ! SELECT
	 */
	protected function SELECT_ALL()
	{
		$sql = 'SELECT * FROM `users`';
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
		$sql = 'SELECT `user_tel`, `user_member`, `user_status` FROM `users` ORDER BY `user_datetime` DESC';
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
		$sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
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

	protected function SELECT_TEL($tel)
	{
		$sql = 'SELECT `user_id`, `user_tel` FROM `users` WHERE `user_tel` = ?';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$tel])) {
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

	protected function INSERT($tel, $user)
	{

		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, NULL, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();

		$sql = 'INSERT INTO `users` VALUES(?, ?, ?, DEFAULT, DEFAULT)';
		$db = $this->connect();
		$stmt = $db->prepare($sql);

		$id = $this->gen_uuid();

		try {
			if ($stmt->execute([$id, $tel, $user])) {
				if ($log_stmt->execute([$log_id, 'users', 'Insert staff', $id, $_SESSION['randBack']->staff['staff_id']])) {
					return $id;
				} else {
					return 'Can\'t Insert Log';
				}
			} else {
				return 'Can\'t Insert Data';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
		exit();
	}

	/**
	 * ! UPDATE
	 */

	protected function UPDATE($attr, $value, $id)
	{
		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, ?, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();

		$sql = "UPDATE `users` SET `" . $attr . "` = ? WHERE `user_id` = ?";
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$value, $id])) {
				if ($log_stmt->execute([$log_id, 'users', $attr, $value, $_SESSION['randBack']->staff['staff_id'], "Update users (user_id) : " . $id])) {
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

		$sql1 = 'DELETE FROM `plays` WHERE `player` = ?';
		$stmt1 = $this->connect()->prepare($sql1);
		$sql2 = 'DELETE FROM `users` WHERE `user_id` = ?';
		$stmt2 = $this->connect()->prepare($sql2);
		try {
			if ($stmt1->execute([$id]) && $stmt2->execute([$id])) {
				if ($log_stmt->execute([$log_id, 'users', 'Delete plays', $id, $_SESSION['randBack']->staff['staff_id'], 'Delete users']) && $log_stmt->execute([$log_id2, 'users', 'Delete users', $id, $_SESSION['randBack']->staff['staff_id'], 'Delete users'])) {
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
