<?php
abstract class plays extends dbh
{

	/**
	 * ! SELECT
	 */

	protected function SELECT_ALL()
	{
		$sql = 'SELECT * FROM `plays` ORDER BY `play_datetime` DESC';
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
		$sql = 'SELECT `cam_id`, `player`, `dec_id`, `play_datetime`, `status` FROM `plays` ORDER BY `play_datetime` DESC';
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
		$sql = 'SELECT * FROM `plays` WHERE `play_id` = ? ORDER BY `play_datetime` DESC';
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

	protected function SELECT_PLAYER($player)
	{
		$sql = 'SELECT * FROM `plays` WHERE `player` = ? ORDER BY `player` ASC, `dec_id` ASC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$player])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_TODAY($now)
	{
		$sql = 'SELECT * FROM `plays` WHERE `play_datetime` >= ? AND `play_datetime` <= ?';
		$stmt = $this->connect()->prepare($sql);
		// echo $now . ' 00:00:00', $now . '23:59:59';
		// exit(0);
		try {
			if ($stmt->execute([$now . ' 00:00:00', $now . ' 23:59:59'])) {
				// if ($stmt->execute([$now, $now])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_WEEK($week_start, $week_end)
	{
		$sql = 'SELECT * FROM `plays` WHERE `play_datetime` >= ? AND `play_datetime` <= ?';
		$stmt = $this->connect()->prepare($sql);
		// echo $week_start . '|' . $week_end;
		// exit();
		try {
			if ($stmt->execute([$week_start, $week_end])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_STATUS($status)
	{
		$sql = 'SELECT COUNT(*) AS COUNT FROM `plays` WHERE `status` = ? AND `dec_id` IS NOT NULL';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$status])) {
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_TODAYBUDGET($cam_id, $datetime)
	{
		$sql = 'SELECT `dec_id` FROM `plays` WHERE `cam_id` = ? AND `play_datetime` > ? AND `play_datetime` < ? ORDER BY `play_datetime` DESC';
		$stmt = $this->connect()->prepare($sql);
		$start = $datetime . ' 00:00:00';
		$end = $datetime . ' 23:59:59';

		try {
			if ($stmt->execute([$cam_id, $start, $end])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_PLAY($cam_id, $user_id)
	{
		$sql = 'SELECT COUNT(*) AS COUNT FROM `plays` WHERE `cam_id` = ? AND `player` = ? ORDER BY `play_datetime` DESC';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute([$cam_id, $user_id])) {
				return $stmt;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	protected function SELECT_RECENTPLAY()
	{
		$sql = 'SELECT * FROM `recent_play`';
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

	protected function SELECT_RECENTPLAYTEL()
	{
		$sql = 'SELECT * FROM `recent_play_tel`';
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

	protected function SELECT_RECENTPLAYREWARD()
	{
		$sql = 'SELECT * FROM `recent_play_reward`';
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

	protected function INSERT($cam_id, $player, $box_choose = 'DEFAULT', $dec_id = NULL)
	{

		$sql = 'INSERT INTO `plays` VALUES(?, ?, DEFAULT, ?, ?, ?, DEFAULT, NULL)';

		$db = $this->connect();
		$stmt = $db->prepare($sql);

		$id = $this->gen_uuid();
		$id2 = $this->gen_uuid();

		$log = 'INSERT INTO `log_plays` VALUES(?, ?, ?, NULL, NULL, ?, DEFAULT)';
		$stmt_log = $this->connect()->prepare($log);

		try {
			$query = $stmt->execute([$id, $cam_id, $player, $box_choose, $dec_id]);
			if ($query) {
				$stmt_log->execute([$id2, $_SESSION['randBack']->staff['staff_id'], $id, 'ADD DATA']);
				if (empty($id)) {
					return 'Can\'t Insert Log';
				} else {
					return true;
				}
			} else {
				return 'Can\'t Insert Play';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * ! UPDATE
	 */

	/**
	 * ! UPDATE
	 */

	protected function UPDATE($attr, $value, $id)
	{
		if ($attr == 'dec_id') {
			if ($value == 'null') {
				$sql = "UPDATE `plays` SET `" . $attr . "` = NULL WHERE `play_id` = ?";
			} else {
				$sql = "UPDATE `plays` SET `" . $attr . "` = ? WHERE `play_id` = ?";
			}
		} elseif ($attr == 'descriptions') {
			if ($value == 'null') {
				$sql = "UPDATE `plays` SET `" . $attr . "` = NULL WHERE `play_id` = ?";
			} else {
				$sql = "UPDATE `plays` SET `" . $attr . "` = ? WHERE `play_id` = ?";
			}
		} else {
			$sql = "UPDATE `plays` SET `" . $attr . "` = ? WHERE `play_id` = ?";
		}

		$stmt = $this->connect()->prepare($sql);
		$id2 = $this->gen_uuid();

		$log = 'INSERT INTO `log_plays` VALUES(?, ?, ?, ?, ?, NULL, DEFAULT)';
		$stmt_log = $this->connect()->prepare($log);

		try {
			if ($attr == 'dec_id') {
				if ($value == 'null') {
					$stmt->execute([$id]);
				} else {
					$stmt->execute([$value, $id]);
				}
			} elseif ($attr == 'descriptions') {
				if ($value == 'null') {
					$stmt->execute([$id]);
				} else {
					$stmt->execute([$value, $id]);
				}
			} else {
				$stmt->execute([$value, $id]);
			}
			$stmt_log->execute([$id2, $_SESSION['randBack']->staff['staff_id'], $id, $attr, $value]);
			return $id;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * ! DELECT
	 */


	protected function DELETE_ID($id)
	{
		$sql = "DELETE FROM `plays` WHERE `play_id` = ?";
		$stmt = $this->connect()->prepare($sql);

		$log = 'INSERT INTO `log_plays` VALUES(?, ?, ?, NULL, NULL, ?, DEFAULT)';
		$stmt_log = $this->connect()->prepare($log);
		$id2 = $this->gen_uuid();

		try {
			if ($stmt->execute([$id])) {
				if ($stmt_log->execute([$id2, $_SESSION['randBack']->staff['staff_id'], $id, 'DELETE DATA'])) {
					return true;
				}
			} else {
				return false;
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
