<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status_vac_model extends CI_Model
{
    public function submit()
    {
        $user_id = $this->session->user_id;
        $time = $this->input->post('time');
        $date = $this->input->post('date');
        $symptom = $this->input->post('symptom');
        $vaccine_brand = $this->input->post('vaccine_brand');

        $data = new stdClass();

        $img = $this->_uploadimg();
        if ($img === null) {
            // $error = array('error' => $this->upload->display_errors());

            $data->status = 0;
            $data->message = "ไม่สามารถแนบภาพได้";
            return $data;
        }

        $sql_check = "SELECT * FROM `vaccine_status` WHERE `user_id`=? AND `time`=?";
        $query_check = $this->db->query($sql_check, array($user_id, $time));
        if ($query_check->num_rows() == 0) {
            $sql = "INSERT INTO `vaccine_status`(`user_id`, `time`, `date`, `symptom`, `vaccine_brand`, `img`, `created_at`, `updated_at`) 
            VALUES (?,?,?,?,?,?, NOW(), NOW())";
            $query = $this->db->query($sql, array($user_id, $time, $date, $symptom, $vaccine_brand, $img));
            if ($query) {
                $data->status = 1;
                $data->message = "บันทึกข้อมูลสำเร็จ";
                return $data;
            } else {
                $data->status = 0;
                $data->message = "บันทึกข้อมูลไม่สำเร็จ";
                return $data;
            }
        } else {
            $sql_up = "UPDATE `vaccine_status` SET 
            `date`=?, 
            `symptom`=?, 
            `img`=?,  
            `updated_at`= NOW() 
            WHERE `user_id`=? AND `time`=?";
            $query_up = $this->db->query($sql_up, array($date, $symptom, $img, $user_id, $time));
            if ($query_up) {
                $data->status = 1;
                $data->message = "แก้ไขข้อมูลสำเร็จ";
                return $data;
            } else {
                $data->status = 0;
                $data->message = "แก้ไขข้อมูลไม่สำเร็จ";
                return $data;
            }
        }
    }

    public function edit()
    {
        $user_id = $this->session->user_id;
        $time = $this->input->post('time');
        $date = $this->input->post('date');
        $symptom = $this->input->post('symptom');
        $vaccine_brand = $this->input->post('vaccine_brand');


        $data = new stdClass();
        $sql = "UPDATE `vaccine_status` SET `date`=?,`symptom`=?, `vaccine_brand`=?,`updated_at`=NOW() WHERE `user_id`=? AND `time`=?;";
        $query = $this->db->query($sql, array($date, $symptom, $vaccine_brand, $user_id, $time));
        if ($query) {
            $data->status = 1;
            $data->message = "แก้ไขข้อมูลสำเร็จ";
            // return $data;
        } else {
            $data->status = 0;
            $data->message = "แก้ไขข้อมูลไม่สำเร็จ";
            // return $data;
        }
        if ($_FILES['img']['name'] != '') {
            $img = $this->_uploadimg();
            var_dump($img);
            if ($img === null) {
                $data->status = 0;
                $data->message = "ไม่สามารถแนบภาพได้";
                return $data;
            }
            $sql2 = "UPDATE `vaccine_status` SET `img`=? WHERE `user_id`=? AND `time`=?;";
            $this->db->query($sql2, array($img, $user_id, $time));
        }
        return $data;
    }



    private function _uploadimg()
    {
        $config['upload_path']          = './storages/vaccine_status';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['encrypt_name']         = TRUE;
        // $config['max_width']            = 20000;
        // $config['max_height']           = 20000;


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('img')) {
            return null;
        } else {
            $file = $this->upload->data();
            return $file['file_name'];
        }
    }

	public function not_vaccine() 
	{
		$user_id = $this->session->user_id;
		$cause = $this->input->post('cause');

		$data = new stdClass();

		$sql_check = "SELECT * FROM `not_vaccine` WHERE `user_id`=?";
		$query_check = $this->db->query($sql_check, array($user_id));
		if ($query_check->num_rows() == 0) {
			$sql = "INSERT INTO `not_vaccine`(`user_id`, `cause`, `created_at`, `updated_at`) VALUES (?,?,NOW(),NOW())";
			$query = $this->db->query($sql, array($user_id, $cause));
			if ($query) {
				$data->status = 1;
				$data->message = "บันทึกข้อมูลสำเร็จ";
				return $data;
			} else {
				$data->status = 0;
				$data->message = "บันทึกข้อมูลไม่สำเร็จ";
				return $data;
			}
		} else {
			$data->status = 0;
			$data->message = "คุณได้ทำการบันทึกข้อมูลไปแล้ว";
			return $data;
		}
 	}
}
