<?php
class staffsview extends staffs
{
	public function getAll()
	{
		$stmt = $this->SELECT_ALL();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function getDashboard()
	{
		$stmt = $this->SELECT_DASHBOARD();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function getId($id)
	{
		$stmt = $this->SELECT_id($id);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getUsername($username)
	{
		$result = $this->SELECT_USERNAME($username);
		return $result;
	}
}
