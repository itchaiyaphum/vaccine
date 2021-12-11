<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report_model extends CI_Model
{
	//get all majors items
	private function major_items(){
		$sql = "SELECT id, major_name FROM `majors` WHERE `status`=1;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//get all minors items
	private function minor_items(){
		$sql = "SELECT * FROM `minors` WHERE `status`=1;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//get all groups items
	private function group_items(){
		$sql = "SELECT * FROM `groups` WHERE `status`=1;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//get all students items
	private function student_items(){
		$sql = "SELECT id, user_id, firstname, lastname, student_id, 
						college_id, major_id, minor_id, group_id, email, status 
					FROM `users_student` WHERE `status`=1;";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//get all vaccine status
	private function vaccine_status_items(){
		$sql = "SELECT id, user_id, time,date,img,vaccine_brand FROM `vaccine_status` ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	//get all no vaccine status
	private function no_vaccine_status_items(){
		$sql = "SELECT id, user_id,cause FROM `not_vaccine` ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_items()
	{
		//get all all majors items
		$major_items = $this->major_items();
		
		//get all all minors items
		$minor_items = $this->minor_items();
		
		//get all all groups items
		$group_items = $this->group_items();
		
		//get all all students items
		$student_items = $this->student_items();

		//get all all vaccine status
		$vaccine_status_items = $this->vaccine_status_items();

		//get all all vaccine status
		$no_vaccine_status_items = $this->no_vaccine_status_items();


		// create unique key arrays for direct access by unique key for performance optimization
		$vaccine_stats = array();
		foreach ($vaccine_status_items as $vaccine_status) {
			$key = $vaccine_status->user_id;
			if(!isset($vaccine_stats[$key])){
				$vaccine_stats[$key] = array();
			}
			$item_vaccine = new stdClass();
            $item_vaccine->vaccine_id        	= $vaccine_status->id;
            $item_vaccine->user_id             	= $vaccine_status->user_id;
            $item_vaccine->time             	= $vaccine_status->time;
            $item_vaccine->date             	= $vaccine_status->date;
            $item_vaccine->img             		= $vaccine_status->img;
            $item_vaccine->vaccine_brand        = $vaccine_status->vaccine_brand;

			array_push($vaccine_stats[$key], $item_vaccine);
		}
		$no_vaccine_stats = array();
		foreach ($no_vaccine_status_items as $no_vaccine_status) {
			$key = $no_vaccine_status->user_id;
			if(!isset($no_vaccine_stats[$key])){
				$no_vaccine_stats[$key] = array();
			}
			$item_no_vaccine = new stdClass();
            $item_no_vaccine->vaccine_id        	= $no_vaccine_status->id;
            $item_no_vaccine->user_id             	= $no_vaccine_status->user_id;
            $item_no_vaccine->cause             	= $no_vaccine_status->cause;

			array_push($no_vaccine_stats[$key], $item_no_vaccine);
		}


		$items = array();

		$item_majors_stats 						= new stdClass();
		$item_majors_stats->no_vaccine       	= 0;
		$item_majors_stats->dose1            	= 0;
		$item_majors_stats->dose2            	= 0;
		$item_majors_stats->dose3            	= 0;
		$item_majors_stats->no_data       		= 0;
		$items['major_stats']             		= $item_majors_stats;

		$items['major_items'] 					= array();

		foreach ($major_items as $major) {
            $item_major 							= new stdClass();
            $item_major->major_id               	= $major->id;
            $item_major->major_name             	= $major->major_name;

			$item_major_stats             			= new stdClass();
			$item_major_stats->no_vaccine       	= 0;
			$item_major_stats->dose1           	 	= 0;
			$item_major_stats->dose2            	= 0;
			$item_major_stats->dose3            	= 0;
			$item_major_stats->no_data       		= 0;
			$item_major->stats             			= $item_major_stats;

			$item_major->minors           			= array();
			$item_minors_stats 						= new stdClass();
			$item_minors_stats->no_vaccine       	= 0;
			$item_minors_stats->dose1            	= 0;
			$item_minors_stats->dose2            	= 0;
			$item_minors_stats->dose3            	= 0;
			$item_minors_stats->no_data       		= 0;
			$item_major->minors['minor_stats']		= $item_minors_stats;
			$item_major->minors['minor_items']		= array();

			foreach ($minor_items as $minor) {
				if ($minor->major_id==$major->id) {
					$item_minor                 			= new stdClass();
					$item_minor->major_id       			= $minor->major_id;
					$item_minor->major_name       			= $major->major_name;
					$item_minor->minor_id       			= $minor->id;
					$item_minor->minor_name     			= $minor->minor_name;

					$item_minor_stats             			= new stdClass();
					$item_minor_stats->no_vaccine       	= 0;
					$item_minor_stats->dose1            	= 0;
					$item_minor_stats->dose2            	= 0;
					$item_minor_stats->dose3            	= 0;
					$item_minor_stats->no_data       		= 0;
					$item_minor->stats            			= $item_minor_stats;

					$item_minor->groups         			= array();
					$item_groups_stats 						= new stdClass();
					$item_groups_stats->no_vaccine       	= 0;
					$item_groups_stats->dose1            	= 0;
					$item_groups_stats->dose2            	= 0;
					$item_groups_stats->dose3            	= 0;
					$item_groups_stats->no_data       		= 0;
					$item_minor->groups['group_stats']		= $item_groups_stats;
					$item_minor->groups['group_items']		= array();

					foreach ($group_items as $group) {
						if ($group->major_id==$major->id && $group->minor_id==$minor->id) {
							$item_group                     = new stdClass();
							$item_group->major_id           = $group->major_id;
							$item_group->major_name         = $major->major_name;
							$item_group->minor_id           = $group->minor_id;
							$item_group->minor_name         = $minor->minor_name;
							$item_group->group_id           = $group->id;
							$item_group->group_name         = $group->group_name;

							$item_group_stats             		= new stdClass();
							$item_group_stats->no_vaccine       = 0;
							$item_group_stats->dose1            = 0;
							$item_group_stats->dose2            = 0;
							$item_group_stats->dose3            = 0;
							$item_group_stats->no_data       	= 0;
							$item_group->stats            		= $item_group_stats;

							$item_group->students         	= array();
							foreach ($student_items as $student) {
								if ($student->major_id==$major->id && $student->minor_id==$minor->id && $student->group_id==$group->id) {
									$item_student                		= new stdClass();
									$item_student->id           		= $student->id;
									$item_student->user_id       		= $student->user_id;
									$item_student->student_id   		= $student->student_id;
									$item_student->firstname   			= $student->firstname;
									$item_student->lastname   			= $student->lastname;
									$item_student->email   				= $student->email;

									$item_student->vaccine_status			= 0;
									$item_student->vaccine_status_remark	= null;
									$item_student->vaccine_status_items		= array();

									// if no vaccine
									if(isset($no_vaccine_stats[$item_student->user_id])){
										$item_student->vaccine_status			= 0;
										$item_student->vaccine_status_remark	= (count($no_vaccine_stats[$item_student->user_id]))?$no_vaccine_stats[$item_student->user_id][0]:null;
										//calculate stats
										$item_major_stats->no_vaccine++;
										$item_minor_stats->no_vaccine++;
										$item_group_stats->no_vaccine++;

									//if has vaccine already
									}else if(isset($vaccine_stats[$item_student->user_id])){
										$item_student->vaccine_status		= 1;
										$item_student->vaccine_status_items	= $vaccine_stats[$item_student->user_id];
										//calculate stats
										$tmps_vaccine_stats = $vaccine_stats[$item_student->user_id];
										foreach ($tmps_vaccine_stats as $tmp_vaccine_stats) {
											if($tmp_vaccine_stats->time=="1"){
												$item_major_stats->dose1++;
												$item_minor_stats->dose1++;
												$item_group_stats->dose1++;
											}else if($tmp_vaccine_stats->time=="2"){
												$item_major_stats->dose2++;
												$item_minor_stats->dose2++;
												$item_group_stats->dose2++;
											}else if($tmp_vaccine_stats->time=="3"){
												$item_major_stats->dose3++;
												$item_minor_stats->dose3++;
												$item_group_stats->dose3++;
											}
										}

									// no vaccine data
									}else{
										$item_student->vaccine_status	= (-1);
										//calculate stats
										$item_major_stats->no_data++;
										$item_minor_stats->no_data++;
										$item_group_stats->no_data++;
									}

									array_push($item_group->students, $item_student);
								}
							}
							array_push($item_minor->groups['group_items'], $item_group);
							//calculate stats of all groups
							$item_minor->groups['group_stats']->no_vaccine 		+= $item_group->stats->no_vaccine;
							$item_minor->groups['group_stats']->dose1        	+= $item_group->stats->dose1;
							$item_minor->groups['group_stats']->dose2        	+= $item_group->stats->dose2;
							$item_minor->groups['group_stats']->dose3        	+= $item_group->stats->dose3;
							$item_minor->groups['group_stats']->no_data      	+= $item_group->stats->no_data;
						}
					}
					array_push($item_major->minors['minor_items'], $item_minor);
					//calculate stats of all minors
					$item_major->minors['minor_stats']->no_vaccine 		+= $item_minor->stats->no_vaccine;
					$item_major->minors['minor_stats']->dose1        	+= $item_minor->stats->dose1;
					$item_major->minors['minor_stats']->dose2        	+= $item_minor->stats->dose2;
					$item_major->minors['minor_stats']->dose3        	+= $item_minor->stats->dose3;
					$item_major->minors['minor_stats']->no_data      	+= $item_minor->stats->no_data;
				}
			}
			array_push($items['major_items'], $item_major);
			//calculate stats of all majors
			$items['major_stats']->no_vaccine 	+= $item_major->stats->no_vaccine;
			$items['major_stats']->dose1        += $item_major->stats->dose1;
			$items['major_stats']->dose2        += $item_major->stats->dose2;
			$items['major_stats']->dose3        += $item_major->stats->dose3;
			$items['major_stats']->no_data      += $item_major->stats->no_data;
		}

		// echo "<pre>";
        // print_r($items);
        // exit();
        
		return $items;
	}

	public function majors(){
		return $this->get_items();
	}

	public function major($major_id)
	{
		$items = $this->get_items();
		$data = null;
		foreach($items['major_items'] as $major){
			if($major->major_id==$major_id){
				// echo "<pre>";
				// print_r($major);
				// exit();
				return $major;
			}
		}
		return $data;
	}

	public function minor($minor_id)
	{
		$items = $this->get_items();
		$data = null;
		foreach($items['major_items'] as $major){
			foreach($major->minors['minor_items'] as $minor){
				if($minor->minor_id==$minor_id){
					// echo "<pre>";
					// print_r($minor);
					// exit();
					return $minor;
				}
			}
		}
		return $data;
	}

	public function group($group_id)
	{
		$items = $this->get_items();
		$data = null;
		foreach($items['major_items'] as $major){
			foreach($major->minors['minor_items'] as $minor){
				foreach($minor->groups['group_items'] as $group){
					if($group->group_id==$group_id){
						// echo "<pre>";
						// print_r($group);
						// exit();
						return $group;
					}
				}
			}
		}
		return $data;
	}

}
