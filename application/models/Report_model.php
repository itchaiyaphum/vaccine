<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
	// private $count;
	public function majors()
	{
		$sql = "SELECT `id`,`major_code`,`major_name` FROM `majors` WHERE `status`=1;";
		$query = $this->db->query($sql);
		$data['majors'] = $query->result();
		$count = new stdClass();
		$count->all = 0;
		$count->c2 = 0;
		$count->c1 = 0;
		$count->c0 = 0;
		$count->c = 0;
		foreach ($data['majors'] as $row) {
			$re = $this->groups($row->id);
			$row->count = $re['count'];
			$row->per = $re['per'];

			$count->all += $re['count']->all;
			$count->c2 += $re['count']->c2;
			$count->c1 += $re['count']->c1;
			$count->c0 += $re['count']->c0;
			$count->c += $re['count']->c;
		}
		$data['count'] = $count;
		$data['per'] = $this->percent($count);

		return $data;
	}
	public function groups($major_id)
	{
		$sql_info = "SELECT 
		`majors`.`major_code`,`majors`.`major_name`
		FROM `majors` WHERE `status`=1 AND `id`=?";
		$qr_info = $this->db->query($sql_info, $major_id);
		$data['info'] = $qr_info->row();
		
		$sql = "SELECT `groups`.`id`,`groups`.`group_code`,`groups`.`group_name`, `minors`.`minor_name`
		FROM `groups` 
		LEFT JOIN `minors` ON `minors`.`id`=`groups`.`minor_id`
		WHERE `groups`.`major_id`=? AND `groups`.`status`!=-1
		ORDER BY `groups`.`group_name` ASC;";
		$query = $this->db->query($sql, $major_id);
		$data['groups'] = $query->result();
		$count = new stdClass();
		$count->all = 0;
		$count->c2 = 0;
		$count->c1 = 0;
		$count->c0 = 0;
		$count->c = 0;
		foreach ($data['groups'] as $row) {
			$re = $this->std($row->id);

			$row->count = $re['count'];
			$row->per = $re['per'];

			$count->all += $re['count']->all;
			$count->c2 += $re['count']->c2;
			$count->c1 += $re['count']->c1;
			$count->c0 += $re['count']->c0;
			$count->c += $re['count']->c;
		}
		$data['count'] = $count;
		$data['per'] = $this->percent($count);

		return $data;
	}

	public function std($group_id)
	{	$sql_info = "SELECT 
		`groups`.`group_code`,`groups`.`group_name`
		,`majors`.`major_code`,`majors`.`major_name`
		,`minors`.`minor_code`,`minors`.`minor_name`
		FROM `groups` 
		LEFT JOIN `majors` ON `majors`.`id`=`groups`.`major_id`
		LEFT JOIN `minors` ON `minors`.`id`=`groups`.`minor_id`
		WHERE `groups`.`id`=? AND`groups`.`status`=1;";
		$qr_info = $this->db->query($sql_info, $group_id);
		$data['info'] = $qr_info->row();

		$sql = "SELECT `user_id`,`firstname`,`lastname`,`student_id`
		FROM `users_student` 
		WHERE `users_student` .`group_id`=? AND `users_student` .`status`=1  
		ORDER BY `users_student`.`student_id` ASC;";
		$query = $this->db->query($sql, $group_id);
		$data['std'] = $query->result();
		
		$count = new stdClass();
		$count->all = 0;
		$count->c2 = 0;
		$count->c1 = 0;
		$count->c0 = 0;
		$count->c = 0;
		foreach ($data['std'] as $std) {
			$sql_vaccine_status = "SELECT * FROM `vaccine_status` WHERE `user_id`=?";
			$query_vaccine_status = $this->db->query($sql_vaccine_status, $std->user_id);
			$vaccine_status = $query_vaccine_status->result();
			foreach ($vaccine_status as $vacc_status) {
				if ($vacc_status->time === '1') {
					$std->time1 = $vacc_status;
				} elseif ($vacc_status->time === '2') {
					$std->time2 = $vacc_status;
				}
			}
			$sql_not_vacc = "SELECT * FROM `not_vaccine` WHERE `user_id`=?";
			$query_not_vacc = $this->db->query($sql_not_vacc, $std->user_id);
			$std->not_vaccine = $query_not_vacc->row();

			$count->all++;
			if (isset($std->time1)) {
				$std->vaccinated = true;
				$count->c1++;
				$std->time1re = "1";
				if (isset($std->time2)) {
					$count->c2++;
					$std->time2re = "1";
				} else {
					$std->time2re = "0";
				}
			} elseif (isset($std->not_vaccine)) {
				$std->vaccinated = false;
				$std->time1re = "0";
				$std->time2re = "0";
				$count->c0++;
			} else {
				$std->vaccinated = null;
				$std->time1re = "-";
				$std->time2re = "-";
				$count->c++;
			}
		}
		$data['count'] = $count;
		$data['per'] = $this->percent($count);

		return $data;
	}
	
	private function percent($count)
	{
		$percent = new stdClass();
		$percent->c2 = $this->getPercent($count->c2, $count->all);
		$percent->c1 = $this->getPercent($count->c1, $count->all);
		$percent->c0 = $this->getPercent($count->c0, $count->all);
		$percent->c = $this->getPercent($count->c, $count->all);

		return $percent;
	}
	public function getPercent($value, $all)
	{
		if ($all == 0) {
			return 0;
		} else {
			return round($value / $all * 100, 2);
		}
	}
	

	public function std2($group_id)
	{
		$sql = "SELECT `users_student` .`id`, `users_student` .`user_id`,
        `users_student` .`firstname`, `users_student` .`lastname`, 
        `users_student` .`student_id`, `groups`.`group_name`, 
        `majors`.`major_name`
        FROM `users_student` 
        INNER JOIN `groups`ON `groups`.`id`=`users_student`.`group_id`
        LEFT JOIN `majors` ON `majors`.`id`=`groups`.`major_id`
        WHERE `users_student` .`group_id`=? AND `users_student` .`status`=1  
        ORDER BY `users_student`.`student_id` ASC;";
		$query = $this->db->query($sql, $group_id);
		$data['std'] = $query->result();
		$count = (object)['all' => 0, 'c1' => 0, 'c0' => 0, 'c' => 0];
		foreach ($data['std'] as $row) {
			$row->vaccine = $this->vaccine($row->user_id);

			$count->all++;
			if (isset($row->vaccine->consent)) {
				if ($row->vaccine->consent === '1') {
					$count->c1++;
				} elseif ($row->vaccine->consent === '0') {
					$count->c0++;
				}
			} else {
				$count->c++;
			}
		}
		$data['count'] = $count;
		return $data;
	}
	public function vaccine($user_id)
	{
		$sql = "SELECT `id`,`consent` FROM `vaccine` WHERE `user_id`=?;";
		$query = $this->db->query($sql, $user_id);
		$data = $query->result();
		if (!empty($data)) {
			$data = $data[0];
		}
		// foreach ($data as $row) {
		//     $row->vaccine = $this->vaccine($row->user_id);
		// }

		return $data;
	}
}
