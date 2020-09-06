<?php
class settings extends dbh
{

	public $id;

	public function __construct()
	{
		$sql = 'SELECT `datetime` FROM `setting` ORDER BY `datetime` DESC LIMIT 0,1';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute()) {
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				$this->id = $result['datetime'];
				return $result;
			} else {
				return 'Can\'t Select Datetime';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function SETTING()
	{
		$sql = 'SELECT * FROM `setting` ORDER BY `datetime` DESC LIMIT 0,1';
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($stmt->execute()) {
				$result = $stmt->fetch(PDO::FETCH_ASSOC);
				return $result;
			} else {
				return 'Can\'t Select';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function UPDATE($attr, $value)
	{
		$log = "INSERT INTO `log` VALUES(?, ?, ?, ?, ?, NULL, DEFAULT)";
		$log_stmt = $this->connect()->prepare($log);
		$log_id = $this->gen_uuid();

		$sql = "UPDATE `setting` SET `" . $attr . "` = ? WHERE `datetime` = ?";
		$stmt = $this->connect()->prepare($sql);

		try {
			if ($log_stmt->execute([$log_id, 'setting', $attr, $value, $_SESSION['randBack']->staff['staff_id']])) {
				if ($stmt->execute([$value, $this->id])) {
					return true;
				} else {
					return 'Can\'t Update';
				}
			} else {
				return 'Can\'t Insert Log';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
}
