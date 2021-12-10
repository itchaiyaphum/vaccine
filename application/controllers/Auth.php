<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model', 'auth');
	}

	public function index()
	{
		// $this->load->view('login');
		redirect(site_url('auth/login'));
	}
	public function login()
	{
		// $data = $this->auth->std_data("62209010011");
		// var_dump($data);
		$this->form_validation->set_rules(
			'student_id',
			'student id',
			'required|callback__login_check',
			array(
				'required' => 'กรุฌากรอกข้อมูล',
				'_login_check' => 'ไม่พบข้อมูลนักเรียนนักศึกษา'
			)
		);
		if ($this->form_validation->run()) {

			$this->auth->login(
				$this->form_validation->set_value('student_id'));
			redirect(site_url('form/check'));
		} else {
			// redirect(site_url());
			$this->load->view('login');
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(site_url('auth/login'));
	}
	public function advisor() {
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required',
			array(
				'required' => 'กรุฌากรอกข้อมูล',
			)
		);
		$this->form_validation->set_rules(
			'pass',
			'Password',
			'required',
			array(
				'required' => 'กรุฌากรอกข้อมูล',
			)
		);
		if ($this->form_validation->run()) {
			if ($this->auth->advisor_login(
				$this->form_validation->set_value('email'),
				$this->form_validation->set_value('pass')
			)) {
				redirect(site_url('advisor'));
			} else {
				$data['login_error'] = 'อีเมลหรือรหัสผ่านไม่ถูกต้อง';
				$this->load->view('login_teacher', $data);
			}
		} else {
			// redirect(site_url());
			$this->load->view('login_teacher');
		}
	}
	public function _login_check($std_id)
	{
		$data = $this->auth->std_data($std_id);
		if (!empty($data)) {
			return true;
		} else {
			return false;
		}
	}
	
}
