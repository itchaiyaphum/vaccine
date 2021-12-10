<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_model extends CI_Model
{
    public function index($user_id)
    {
        $sql = "SELECT * FROM `users_student` WHERE `user_id` = ? AND `status` = 1";
        $query = $this->db->query($sql, $user_id);
        $re = $query->result();
        $data["users_std"] = $re[0];

        $sql_gr = "SELECT * FROM `groups` WHERE `id` = ? AND `status` != -1";
        $query_gr = $this->db->query($sql_gr, $data["users_std"]->group_id);
        $re_gr = $query_gr->result();
        $data["users_std"]->group_data = $re_gr;
        $data["users_std"]->group_level = $this->_group_level($data["users_std"]->group_data[0]->group_name);

        $sql2 = "SELECT * FROM `vaccine` WHERE `user_id` = ? ";
        $query2 = $this->db->query($sql2, $user_id);
        $re2 = $query2->result();

        if (!empty($re2)) {
            $data["vaccine"] = $re2[0];

            $sql3 = "SELECT * FROM `vaccine_check` WHERE `vaccine_id` = ? ";
            $query3 = $this->db->query($sql3, $data["vaccine"]->id);
            $re3 = $query3->result();
            if (!empty($re3)) {
                $data["vaccine"]->vaccine_check = $re3[0];
            }
        }
        $sql22 = "SELECT * FROM `vaccine2` WHERE `user_id` = ? ";
        $query22 = $this->db->query($sql22, $user_id);
        $re22 = $query22->result();

        if (!empty($re22)) {
            $data["vaccine2"] = $re22[0];

            $sql32 = "SELECT * FROM `vaccine_check2` WHERE `vaccine_id` = ? ";
            $query32 = $this->db->query($sql32, $data["vaccine2"]->id);
            $re32 = $query32->result();
            if (!empty($re32)) {
                $data["vaccine2"]->vaccine_check2 = $re32[0];
            }
        }

        $sql4 = "SELECT * FROM `vaccine_status` WHERE `user_id`=? ORDER BY `time` ASC";
        $query4 = $this->db->query($sql4, $user_id);
        $data['status_vac'] = $query4->result();

		$sql_not_vacc = "SELECT * FROM `not_vaccine` WHERE `user_id`=?";
		$query_not_vacc = $this->db->query($sql_not_vacc, $user_id);
		$data['not_vaccine'] = $query_not_vacc->row();
        return $data;
    }

    public function submit()
    {
        $user_id            = $this->session->user_id;
        $parent_name        = $this->input->post('name');
        $parent_lname       = $this->input->post('lastname');
        $parent_tel         = $this->input->post('tel_parent');
        $relation           = $this->input->post('relation');
        $add_number_parent  = $this->input->post('address');
        $group_parent       = $this->input->post('moo');
        $roard_parent       = $this->input->post('road');
        $sub_distric_parent = $this->input->post('district');
        $district_parent    = $this->input->post('district2');
        $province_parent    = $this->input->post('province');
        $std_tel            = $this->input->post('tel_student');
        $age_std            = $this->input->post('age');
        $birthday_std       = $this->input->post('dob');
        $card_no_std        = $this->input->post('id');
        $nationality_std    = $this->input->post('nation');
        $consent            = $this->input->post('consent');
        $cause              = $this->input->post('cause');

        $data = (object)[];


        $sql_ck = "SELECT * FROM `vaccine` WHERE `user_id` = ?";
        $qr_ck = $this->db->query($sql_ck, $user_id);
        if (empty($qr_ck->result())) {

            $sql = "INSERT INTO `vaccine`(
                `user_id`,
                `parent_name`,
                `parent_lname`,
                `parent_tel`,
                `relation`,
                `add_number_parent`,
                `group_parent`,
                `roard_parent`,
                `sub_distric_parent`,
                `district_parent`,
                `province_parent`,
                `std_tel`,
                `age_std`,
                `birthday_std`,
                `card_no_std`,
                `nationality_std`,
                `consent`,
                `cause`,
                `created_at`,
                `updated_at`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
            ";
            $query = $this->db->query($sql, array(
                $user_id,
                $parent_name,
                $parent_lname,
                $parent_tel,
                $relation,
                $add_number_parent,
                $group_parent,
                $roard_parent,
                $sub_distric_parent,
                $district_parent,
                $province_parent,
                $std_tel,
                $age_std,
                $birthday_std,
                $card_no_std,
                $nationality_std,
                $consent,
                $cause,
            ));

            if (!$query) {
                $data->status = 0;
                $data->message = "ไม่สามารถบันทึกข้อมูลได้";
                return $data;
            }
            $vaccine_id = $this->db->insert_id();
            $this->_submit_radio($vaccine_id);
        } else {
            $sql = "UPDATE `vaccine` SET 
                `parent_name`=?,
                `parent_lname`=?,
                `parent_tel`=?,
                `relation`=?,
                `add_number_parent`=?,
                `group_parent`=?,
                `roard_parent`=?,
                `sub_distric_parent`=?,
                `district_parent`=?,
                `province_parent`=?,
                `std_tel`=?,
                `age_std`=?,
                `birthday_std`=?,
                `card_no_std`=?,
                `nationality_std`=?,
                `consent`=?,
                `cause`=?,
                `updated_at`=NOW()
                WHERE `user_id` = ?
                
            ";
            $query = $this->db->query($sql, array(
                $parent_name,
                $parent_lname,
                $parent_tel,
                $relation,
                $add_number_parent,
                $group_parent,
                $roard_parent,
                $sub_distric_parent,
                $district_parent,
                $province_parent,
                $std_tel,
                $age_std,
                $birthday_std,
                $card_no_std,
                $nationality_std,
                $consent,
                $cause,
                $user_id,
            ));
            if ($query) {
                $sql_id = "SELECT * FROM `vaccine` WHERE `user_id` = ?";
                $qr_id = $this->db->query($sql_id, $user_id);

                $vaccine_id = $qr_id->result()[0]->id;
                $this->_submit_radio($vaccine_id);
            } else {
                $data->status = 0;
                $data->message = "ไม่สามารถบันทึกข้อมูลได้";
                return $data;
            }
        }
        if (!empty($_FILES['signal']['name'])) {

            $signature_parent = $this->_uploadimg();

            if ($signature_parent === null) {
                // $error = array('error' => $this->upload->display_errors());

                $data->status = 0;
                $data->message = "ไม่สามารถแนบภาพได้";
                return $data;
            } else {
                $sql_img = "UPDATE `vaccine` SET `signature_parent` = ?  WHERE `user_id` = ?";
                $qr_img = $this->db->query($sql_img, array($signature_parent, $user_id));
                if (!$qr_img) {
                    $data->status = 0;
                    $data->message = "ไม่สามารถแนบภาพได้";
                    return $data;
                }
            }
        }
        $data->status = 1;
        $data->message = "บันทึกข้อมูลสำเร็จ";
        return $data;
    }

    public function submit2()
    {
        $user_id            = $this->session->user_id;
        $consent            = $this->input->post('consent');
        $cause              = $this->input->post('cause');

        $data = new stdClass();


        $sql_ck = "SELECT * FROM `vaccine2` WHERE `user_id` = ?";
        $qr_ck = $this->db->query($sql_ck, $user_id);
        if (empty($qr_ck->result())) {

            $sql = "INSERT INTO `vaccine2`(
                `user_id`, 
                `consent`, 
                `cause`, 
                `created_at`, 
                `updated_at`) 
                VALUES (? ,? ,? , NOW(), NOW())";
            $query = $this->db->query($sql, array(
                $user_id,
                $consent,
                $cause
            ));

            if (!$query) {
                $data->status = 0;
                $data->message = "ไม่สามารถบันทึกข้อมูลได้";
                return $data;
            }
            $vaccine_id = $this->db->insert_id();
            $this->_submit_radio2($vaccine_id);
        } else {
            $sql = "UPDATE `vaccine2` SET 
                `consent`=?,
                `cause`=?,
                `updated_at`=NOW()
                WHERE `user_id` = ?
                
            ";
            $query = $this->db->query($sql, array(
                $consent,
                $cause,
                $user_id,
            ));

            if ($query) {
                $sql_id = "SELECT * FROM `vaccine2` WHERE `user_id` = ?";
                $qr_id = $this->db->query($sql_id, $user_id);

                $vaccine_id = $qr_id->result()[0]->id;
                $this->_submit_radio2($vaccine_id);
            } else {
                $data->status = 0;
                $data->message = "ไม่สามารถบันทึกข้อมูลได้";
                return $data;
            }
        }
        if (!empty($_FILES['signal']['name'])) {

            $signature_parent = $this->_uploadimg();

            if ($signature_parent === null) {
                // $error = array('error' => $this->upload->display_errors());

                $data->status = 0;
                $data->message = "ไม่สามารถแนบภาพได้";
                return $data;
            } else {
                $sql_img = "UPDATE `vaccine2` SET `signature_parent` = ?  WHERE `user_id` = ?";
                $qr_img = $this->db->query($sql_img, array($signature_parent, $user_id));
                if (!$qr_img) {
                    $data->status = 0;
                    $data->message = "ไม่สามารถแนบภาพได้";
                    return $data;
                }
            }
        }
        $data->status = 1;
        $data->message = "บันทึกข้อมูลสำเร็จ";
        return $data;
    }

    private function _uploadimg()
    {
        $config['upload_path']          = './storages/signatures';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['encrypt_name']         = TRUE;
        // $config['max_size']             = 100;
        // $config['max_width']            = 20000;
        // $config['max_height']           = 20000;
        

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('signal')) {
            return null;
        } else {
            $file = $this->upload->data();
            return $file['file_name'];
        }
    }

    private function _submit_radio($vaccine_id)
    {
        $n1 = $this->input->post('n1');
        $n2 = $this->input->post('n2');
        $n3 = $this->input->post('n3');
        $n4 = $this->input->post('n4');
        $n5 = $this->input->post('n5');
        $n6 = $this->input->post('n6');
        $n7 = $this->input->post('n7');
        $n8 = $this->input->post('n8');
        $n9 = $this->input->post('n9');
        $sql_ck = "SELECT * FROM `vaccine_check` WHERE `vaccine_id` = ?";
        $qr_ck = $this->db->query($sql_ck, $vaccine_id);
        if (empty($qr_ck->result())) {
            $sql = "INSERT INTO `vaccine_check`(
                    `vaccine_id`, 
                    `check1`, 
                    `check2`, 
                    `check3`, 
                    `check4`, 
                    `check5`, 
                    `check6`, 
                    `check7`, 
                    `check8`, 
                    `check9`) 
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
            $query = $this->db->query($sql, array(
                $vaccine_id,
                $n1,
                $n2,
                $n3,
                $n4,
                $n5,
                $n6,
                $n7,
                $n8,
                $n9,
            ));
        } else {
            $sql = "UPDATE `vaccine_check` SET 
            `check1`=?,
            `check2`=?,
            `check3`=?,
            `check4`=?,
            `check5`=?,
            `check6`=?,
            `check7`=?,
            `check8`=?,
            `check9`=? WHERE `vaccine_id`=?";

            $query = $this->db->query($sql, array(
                $n1,
                $n2,
                $n3,
                $n4,
                $n5,
                $n6,
                $n7,
                $n8,
                $n9,
                $vaccine_id,
            ));
        }
    }

    private function _submit_radio2($vaccine_id)
    {
        $n1 = $this->input->post('n1');
        $n2 = $this->input->post('n2');
        $n3 = $this->input->post('n3');
        $n4 = $this->input->post('n4');
        $n5 = $this->input->post('n5');
        $n6 = $this->input->post('n6');
        $n7 = $this->input->post('n7');
        $n8 = $this->input->post('n8');
        $n9 = $this->input->post('n9');
        $sql_ck = "SELECT * FROM `vaccine_check2` WHERE `vaccine_id` = ?";
        $qr_ck = $this->db->query($sql_ck, $vaccine_id);
        if (empty($qr_ck->result())) {
            $sql = "INSERT INTO `vaccine_check2`(
                    `vaccine_id`, 
                    `check1`, 
                    `check2`, 
                    `check3`, 
                    `check4`, 
                    `check5`, 
                    `check6`, 
                    `check7`, 
                    `check8`, 
                    `check9`) 
                    VALUES (?,?,?,?,?,?,?,?,?,?)";
            $query = $this->db->query($sql, array(
                $vaccine_id,
                $n1,
                $n2,
                $n3,
                $n4,
                $n5,
                $n6,
                $n7,
                $n8,
                $n9,
            ));
        } else {
            $sql = "UPDATE `vaccine_check2` SET 
            `check1`=?,
            `check2`=?,
            `check3`=?,
            `check4`=?,
            `check5`=?,
            `check6`=?,
            `check7`=?,
            `check8`=?,
            `check9`=? WHERE `vaccine_id`=?";

            $query = $this->db->query($sql, array(
                $n1,
                $n2,
                $n3,
                $n4,
                $n5,
                $n6,
                $n7,
                $n8,
                $n9,
                $vaccine_id,
            ));
        }
    }

    public function _group_level($group_name)
    {
        $class = strtolower($group_name[0]);
        if ($class == 'a') {
            return 'ปวช.1';
        } elseif ($class == 'b') {
            return 'ปวช.2';
        } elseif ($class == 'c') {
            return 'ปวช.3';
        } elseif ($class == 'd') {
            return 'ปวส.1';
        } elseif ($class == 'e') {
            return 'ปวส.2';
        }
    }
}
