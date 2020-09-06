<?php
abstract class de_campaigns extends dbh
{

	/**
	 * ! SELECT
	 */
	protected function SELECT_ALL()
	{
		$sql = 'SELECT * FROM `de_campaign` ORDER BY `cam_id` ASC, `dec_id` ASC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute()) {
				// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_PERCENT($cam_id)
	{
		$sql = 'SELECT `dec_id`, `dec_values`, `dec_percent` FROM `de_campaigns` WHERE `cam_id` = ? ORDER BY `dec_percent` ASC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$cam_id])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * ? SELECT_PERCENT ซ้ำกับ SELECT_CAMP
	 */

	protected function SELECT_CAMP($cam_id)
	{
		$sql = 'SELECT * FROM `de_campaign` WHERE `cam_id` = ? ORDER BY `dec_percent` ASC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$cam_id])) {
				// $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_ID($cam_id, $dec_id)
	{
		$sql = 'SELECT * FROM `de_campaign` WHERE `cam_id` = ? AND `dec_id` = ? ORDER BY `dec_percent` ASC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$cam_id, $dec_id])) {
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
		$sql = 'SELECT `cam_id`, `dec_id`, `dec_name`, `dec_values`, `dec_percent` FROM `de_campaigns` ORDER BY `cam_id` ASC, `dec_id` ASC';
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

	protected function INSERT($cam_id, $dec_name, $dec_value, $dec_percent)
	{
		$sql = 'INSERT INTO `de_campaign` VALUES (?, NULL, ?, ?, ?, DEFAULT)';
		$db = $this->connect();
		$stmt = $db->prepare($sql);

		try {
			if ($stmt->execute([$cam_id, $dec_name, $dec_value, $dec_percent])) {
				return true;
			} else {
				return 'Can\'t Insert';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * ! UPDATE
	 */

	protected function UPDATE($attr, $value, $cam_id, $dec_id)
	{
		$sql = "UPDATE `de_campaign` SET `" . $attr . "` = ? WHERE `cam_id` = ? AND `dec_id` = ?";
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$value, $cam_id, $dec_id])) {
				return true;
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

	protected function DELETE($cam_id, $dec_id)
	{
		$sql1 = "DELETE FROM `plays` WHERE `cam_id` = ? AND `dec_id` = ?";
		$stmt1 = $this->connect()->prepare($sql1);
		$sql2 = "DELETE FROM `de_campaign` WHERE `cam_id` = ? AND `dec_id` = ?";
		$stmt2 = $this->connect()->prepare($sql2);

		try {
			if ($stmt1->execute([$cam_id, $dec_id])) {
				if ($stmt2->execute([$cam_id, $dec_id])) {
					return true;
				} else {
					return 'Can\'t Delete plays';
				}
			} else {
				return 'Can\'t Delete de_campaign';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
