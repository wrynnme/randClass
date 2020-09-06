<?php
abstract class campaigns extends dbh
{
	/**
	 * ! SELECT
	 */

	protected function SELECT_ALL()
	{
		$sql = 'SELECT * FROM `campaign` ORDER BY `cam_datetime` DESC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute()) {
				// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
		$sql = 'SELECT * FROM `campaign` WHERE `cam_id` = ?';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$id])) {
				// $result = $stmt->fetch(PDO::FETCH_ASSOC);
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
		$sql = 'SELECT `cam_id`, `cam_name`, `cam_descriptions`, `cam_budget`, `cam_start`, `cam_end`, `cam_status` FROM `campaign` ORDER BY `cam_datetime` DESC';
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

	protected function SELECT_CAMPAIGN($id)
	{
		$sql = 'SELECT `cam_budget`,`cam_descriptions` FROM `campaign` WHERE `cam_id` = ?';
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

	protected function SELECT_TIMENOW($time)
	{
		$sql = 'SELECT `cam_id` FROM `campaign` WHERE `cam_start` <= ? AND `cam_end` >= ? AND `cam_status` = ? ORDER BY `cam_datetime` ASC LIMIT 0,1';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$time, $time, '1'])) {
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

	protected function INSERT($cam_name, $cam_descriptions, $cam_budget, $cam_start, $cam_end)
	{
		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, NULL, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();

		$sql = 'INSERT INTO `campaign` VALUES (?, ?, ?, ?, ?, ?, DEFAULT, DEFAULT)';
		$db = $this->connect();
		$stmt = $db->prepare($sql);
		$id = $this->gen_uuid();

		try {
			if ($stmt->execute([$id, $cam_name, $cam_descriptions, $cam_budget, $cam_start, $cam_end])) {
				if ($log_stmt->execute([$log_id, 'campaign', 'Insert campaign', $id, $_SESSION['randBack']->staff['staff_id']])) {
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
	}


	/**
	 * ! UPDATE
	 */

	protected function UPDATE($attr, $value, $id)
	{
		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, ?, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();

		$sql = "UPDATE `campaign` SET `" . $attr . "` = ? WHERE `cam_id` = ?";
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$value, $id])) {
				if ($log_stmt->execute([$log_id, 'campaign', $attr, $value, $_SESSION['randBack']->staff['staff_id'], 'Update Campaign'])) {
					return true;
				} else {
					return 'Can\'t Insert Log';
				}
			} else {
				return 'Can\'t Update';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * ! DELETE
	 */

	protected function DELECT($id)
	{
		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, ?, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();
		$log_id2 = $this->gen_uuid();
		$log_id3 = $this->gen_uuid();

		$sql1 = 'DELETE FROM `plays` WHERE `cam_id` = ?';
		$stmt1 = $this->connect()->prepare($sql1);
		$sql2 = 'DELETE FROM `de_campaign` WHERE `cam_id` = ?';
		$stmt2 = $this->connect()->prepare($sql2);
		$sql3 = 'DELETE FROM `campaign` WHERE `cam_id` = ?';
		$stmt3 = $this->connect()->prepare($sql3);
		try {
			if ($stmt1->execute([$id]) && $stmt2->execute([$id]) && $stmt3->execute([$id])) {
				if ($log_stmt->execute([$log_id, 'plays', 'Delete plays', $id, $_SESSION['randBack']->staff['staff_id'], "Delete Campaign"]) && $log_stmt->execute([$log_id2, 'de_campaign', 'Delete de_campaign', $id, $_SESSION['randBack']->staff['staff_id'], "Delete Campaign"]) && $log_stmt->execute([$log_id3, 'campaign', 'Delete campaign', $id, $_SESSION['randBack']->staff['staff_id'], "Delete Campaign"])) {
					return true;
				} else {
					return 'Can\'t Insert Log';
				}
			} else {
				return 'Can\'t Delete';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
