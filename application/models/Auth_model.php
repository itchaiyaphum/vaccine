<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function login($std_id)
    {
        $data = $this->std_data($std_id);
        $this->session->user_id = $data[0]->user_id;
		$this->session->user_level = "student";
        if ($data[0]->major_id == 98) {
            $this->session->is_it = true;
        } else {
            $this->session->is_it = false;
        }
        // var_dump($this->session);
        return true;
    }
    public function std_data($std_id)
    {
        $sql = "SELECT * FROM `users_student` WHERE `student_id` = ? AND `status` = 1";
        $query = $this->db->query($sql, $std_id);
        return $query->result();
    }
    public function advisor_login($email, $pass){
        $pass2 = md5($pass);
        $sql = "SELECT * FROM `users` WHERE `email`=? AND `password`=? ;";
        $query = $this->db->query($sql, array($email, $pass2));
        $data = $query->result();
        if (!empty($data[0]->id)) {
            $this->session->user_id = $data[0]->id;
            $this->session->user_level = "advisor";
            if ($data[0]->major_id == 98) {
                $this->session->is_it = true;
            } else {
                $this->session->is_it = false;
            }
            return true;
        } else {
            return false;
        }
        return false;
    }
}
