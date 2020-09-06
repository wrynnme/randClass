<?php
class campaignscontr extends campaigns
{

	public function add($data)
	{
		$cam_name = $data[1]['value'];
		$cam_budget = $data[2]['value'];
		$cam_start = $data[3]['value'];
		$cam_end = $data[4]['value'];
		$cam_descriptions = $data[5];

		if (empty($cam_name) || empty($cam_descriptions) || !isset($cam_budget) || empty($cam_start) || empty($cam_end)) {
			return json_encode('error data');
		} else {
			$result = $this->INSERT($cam_name, $cam_descriptions, $cam_budget, $cam_start, $cam_end);
			if (!empty($result)) {
				return json_encode(true);
			} else {

				return json_encode('error insert');
			}
		}
	}

	public function edit($attr, $value)
	{
		$id = $this->decrypt($_SESSION['randBack']->campaign['id'], $_SESSION['randBack']->key['campaignsedit']);
		$result = $this->UPDATE($attr, $value, $id);
		return $result;
	}

	public function remove($id)
	{
		$result = $this->DELECT($id);
		return $result;
	}
}
