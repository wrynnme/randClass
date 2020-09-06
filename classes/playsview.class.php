<?php
class playsview extends plays
{

	public $allplays;
	public $weekplays;
	public $todayplays;

	public function __construct()
	{
		$now = date('Y-m-d', strtotime("now"));
		$day = date('w');
		$week_start = date('Y-m-d', strtotime('-' . $day . ' days'));
		$week_end = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));

		$allplays = $this->SELECT_ALL();
		$this->allplays = $allplays->rowCount();

		$weekplays = $this->SELECT_WEEK($week_start, $week_end);
		$this->weekplays = $weekplays->rowCount();

		$todayplays = $this->SELECT_TODAY($now);
		$this->todayplays = $todayplays->rowCount();
	}

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

	public function getPlayer($player)
	{
		$stmt = $this->SELECT_PLAYER($player);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function getId($id)
	{
		$stmt = $this->SELECT_ID($id);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getBudgetToday($cam_id)
	{
		$today = date('Y-m-d');
		$stmt = $this->SELECT_TODAYBUDGET($cam_id, $today);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public function getNotConfirm()
	{
		$result = $this->SELECT_STATUS('1');
		$result = $result->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getToday()
	{
		$now = date('Y-m-d', strtotime("now"));
		$result = $this->SELECT_TODAY($now);
		$result = $result->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getWeek()
	{
		$day = date('w');
		$week_start = date('Y-m-d', strtotime('-' . $day . ' days'));
		$week_end = date('Y-m-d', strtotime('+' . (6 - $day) . ' days'));
		$result = $this->SELECT_WEEK($week_start, $week_end);
		$result = $result->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	public function getRecent()
	{
		$stmt = $this->SELECT_RECENTPLAY();
		$play = $stmt->fetch(PDO::FETCH_ASSOC);
		$stmttel = $this->SELECT_RECENTPLAYTEL();
		$tel = $stmttel->fetch(PDO::FETCH_ASSOC);
		$stmtreward = $this->SELECT_RECENTPLAYREWARD();
		$reward = $stmtreward->fetch(PDO::FETCH_ASSOC);
		return [$play, $tel, $reward];
	}

	public function play_already($cam_id, $user_id)
	{
		$stmt = $this->SELECT_PLAY($cam_id, $user_id);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($result['COUNT'] > 0) {
			return json_encode(true);
		} else {
			return json_encode(false);
		}
	}
}
