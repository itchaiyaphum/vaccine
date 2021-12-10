<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Advisor_model extends CI_Model
{
    public function index($user_id)
    {
        $sql1 = "SELECT `firstname`,`lastname` FROM `users_advisor` WHERE `user_id`=?;";
        $query1 = $this->db->query($sql1, $user_id);
        $data['user'] = $query1->result()[0];
        $sql = "SELECT * FROM `advisors_groups` INNER JOIN `groups`
        ON `advisors_groups`.`group_id`=`groups`.`id`
        AND `advisors_groups`.`advisor_id`=?
        AND `advisors_groups`.`advisor_type`='advisor'
        AND `advisors_groups`.`status`=1
        INNER JOIN `majors`
        ON `groups`.`major_id`=`majors`.`id`
        ORDER BY `groups`.`group_name` ASC;";
        $query = $this->db->query($sql, $user_id);
        $data['group'] = $query->result();
        foreach ($data['group'] as $group) {
            // $sql_std = "SELECT `id`,`user_id`,`firstname`,`lastname`,`student_id` 
            // FROM `users_student` 
            // WHERE `group_id`=? AND `status`=1  
            // ORDER BY `student_id`  ASC;";
            $sql_std = "SELECT `users_student`.`id`,`users_student`.`user_id`,`users_student`.`firstname`,`users_student`.`lastname`,`users_student`.`student_id`
            FROM `users_student` 
            WHERE `users_student`.`group_id`=? AND `users_student`.`status`=1 
            ORDER BY `users_student`.`student_id` ASC;";
            
            $query_std = $this->db->query($sql_std, $group->group_id);
            $group->std = $query_std->result();
            $group->all = 0;
            $group->c2 = 0;
            $group->c1 = 0;
            $group->c0 = 0;
            $group->c = 0;
            foreach ($group->std as $std) {
                $sql_vac = "SELECT `id`,`consent` FROM `vaccine` WHERE `user_id`=?;";
                // $sql_vac = "SELECT `vaccine`.`id`,`vaccine`.`consent`,
                // SUM(CASE WHEN `vaccine_status`.`time` = 1 THEN 1 ELSE 0 END) AS time1,
                // SUM(CASE WHEN `vaccine_status`.`time` = 2 THEN 1 ELSE 0 END) AS time2
                // FROM `vaccine`
                // LEFT JOIN `vaccine_status`
                // ON `vaccine_status`.`user_id`=`vaccine`.`user_id`
                // WHERE `vaccine`.`user_id`=?
                // GROUP BY `vaccine_status`.`user_id`;";
                $query_vac = $this->db->query($sql_vac, $std->user_id);
                $std->vaccine = $query_vac->result(); 
				// $group->all++;
                // if (isset($std->vaccine[0]->consent)) {
                //     if ($std->vaccine[0]->consent === '1') {
				// 		$group->c1++;
                //     } elseif ($std->vaccine[0]->consent === '0') {
                //         $group->c0++;
                //     }
                // } else {
                //     $group->c++;
                // }

				
				$sql_vaccine_status = "SELECT * FROM `vaccine_status` WHERE `user_id`=?";
				$query_vaccine_status = $this->db->query($sql_vaccine_status, $std->user_id);
				$vaccine_status = $query_vaccine_status->result();
				foreach ($vaccine_status as $vacc_status ) {
					if ($vacc_status->time === '1') {
						$std->time1 = $vacc_status;
					} elseif ($vacc_status->time === '2') {
						$std->time2 = $vacc_status;
					}
					
				}
				$sql_not_vacc = "SELECT * FROM `not_vaccine` WHERE `user_id`=?";
				$query_not_vacc = $this->db->query($sql_not_vacc, $std->user_id);
				$std->not_vaccine = $query_not_vacc->row();

				$group->all++;
				if (isset($std->time1)) {
					$std->vaccinated = true;
					$group->c1++;
					$std->time1re = "1";
					if (isset($std->time2)) {
						$group->c2++;
						$std->time2re = "1";
					} else {
						$std->time2re = "0";
					}
				} elseif (isset($std->not_vaccine)) {
					$std->vaccinated = false;
					$std->time1re = "0";
					$std->time2re = "0";
					$group->c0++;
				} else {
					$std->vaccinated = null;
					$std->time1re = "-";
					$std->time2re = "-";
					$group->c++;
				}
				

            }
        }
        return $data;
    }
    public function std_vac($time, $group_id) {
        $sql = "SELECT `groups`.`group_name`, `users_advisor`.`firstname`, `users_advisor`.`lastname`, `users_advisor`.`signature`,
        `majors`.`major_name`,`users_headdepartment`.`firstname` AS dpm_firstname,`users_headdepartment`.`lastname` AS dpm_lastname,`users_headdepartment`.`signature` AS dpm_signature
        FROM `advisors_groups`
        LEFT JOIN `groups` ON `groups`.`id`=`advisors_groups`.`group_id`
        LEFT JOIN `users_advisor` ON`users_advisor`.`user_id`=`advisors_groups`.`advisor_id` 
        LEFT JOIN `users_headdepartment` ON `users_headdepartment`.`major_id`=`groups`.`major_id`
        LEFT JOIN `majors` ON `majors`.`id`=`groups`.`major_id`
        WHERE `advisors_groups`.`advisor_type`='advisor' AND `advisors_groups`.`group_id`=? AND `advisors_groups`.`status`=1;";
        $query = $this->db->query($sql, $group_id);
        $data = $query->result()[0];
        $sql_std = "SELECT `users_student`.`firstname`, `users_student`.`lastname`, `users_student`.`student_id`,
        `vaccine_status`.`symptom`
        FROM `users_student` 
        INNER JOIN `vaccine_status` ON `vaccine_status`.`user_id`=`users_student`.`user_id` AND `vaccine_status`.`time`=?
        WHERE `users_student`.`group_id`=?
        ORDER BY `users_student`.`student_id` ASC;";
        $query_std = $this->db->query($sql_std, array($time, $group_id));
        $data->student = $query_std->result();
        return $data;
    }
    public function not_vac($group_id)
    {
        $sql_g = "SELECT `groups`.`group_name`, `users_advisor`.`firstname`, `users_advisor`.`lastname`, `users_advisor`.`signature`,
        `majors`.`major_name`,`users_headdepartment`.`firstname` AS dpm_firstname,`users_headdepartment`.`lastname` AS dpm_lastname,`users_headdepartment`.`signature` AS dpm_signature
        FROM `advisors_groups`
        LEFT JOIN `groups` ON `groups`.`id`=`advisors_groups`.`group_id`
        LEFT JOIN `users_advisor` ON`users_advisor`.`user_id`=`advisors_groups`.`advisor_id` 
        LEFT JOIN `users_headdepartment` ON `users_headdepartment`.`major_id`=`groups`.`major_id`
        LEFT JOIN `majors` ON `majors`.`id`=`groups`.`major_id`
        WHERE `advisors_groups`.`advisor_type`='advisor' AND `advisors_groups`.`group_id`=? AND `advisors_groups`.`status`=1;";
        $query_g = $this->db->query($sql_g, array($group_id));
        $data = $query_g->result()[0];

        $sql = "SELECT `users_student`.`user_id`, `users_student`.`firstname`, `users_student`.`lastname`,`users_student`.`student_id`,
        `vaccine_status`.`time`,`vaccine_status`.`symptom`
        FROM `users_student`
        LEFT JOIN `vaccine_status`
        ON `vaccine_status`.`user_id`=`users_student`.`user_id`
        WHERE `group_id`=?  GROUP BY `users_student`.`user_id`;";
        $query = $this->db->query($sql,$group_id);
        $data->student = $query->result();
        return $data;
    }
}
