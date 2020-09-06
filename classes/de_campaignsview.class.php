<?php

class de_campaignsview extends de_campaigns
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

	public function getId($cam_id, $dec_id)
	{
		$results = $this->SELECT_ID($cam_id, $dec_id);
		return $results;
	}

	public function getCamp($cam_id)
	{
		$stmt = $this->SELECT_PERCENT($cam_id);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$this->count_data = $stmt->rowCount();
		return $results;
	}
}
