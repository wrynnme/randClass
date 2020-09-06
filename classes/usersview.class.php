<?php

class usersview extends users
{

	public $count_data;

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
		$stmt = $this->SELECT_ID($id);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->count_data = $stmt->rowCount();
		return $result;
	}

	public function getTel($tel)
	{
		$stmt = $this->SELECT_TEL($tel);
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		$this->count_data = $stmt->rowCount();
		return $results;
	}
}
