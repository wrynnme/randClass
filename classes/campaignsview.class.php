<?php

class campaignsview extends campaigns
{
	public function getAll()
	{
		$stmt = $this->SELECT_ALL();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function getId($id)
	{
		$stmt = $this->SELECT_ID($id);
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}

	public function getDashboard()
	{
		$stmt = $this->SELECT_DASHBOARD();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function nowCampaign()
	{
		$time = date("Y-m-d H:i:s");
		$stmt = $this->SELECT_TIMENOW($time);
		$results = $stmt->fetch(PDO::FETCH_ASSOC);
		return $results;
	}
}
