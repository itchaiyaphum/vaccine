<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Advisor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->user_id) || $this->session->user_level != "advisor") {
			redirect(site_url('auth/advisor'));
		}
		
        $this->load->model('Advisor_model', 'advisor');
	}
    public function index(){
        $data = $this->advisor->index($this->session->user_id);
		date_default_timezone_set('Asia/Bangkok');
		$this->load->library('tothai');
        $this->load->view('teacher_index', $data);

        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        
    }

	public function report_vac(){
		$data = $this->advisor->index($this->session->user_id);
		date_default_timezone_set('Asia/Bangkok');
		$this->load->library('tothai');
        $this->load->view('pdf/vaccine_group', $data);
	}

    public function std_vac()
    {
        $data['group'] = $this->advisor->std_vac(
            $this->input->get('time'),
            $this->input->get('group_id')
        );
        $this->load->view('pdf/std_vac', $data);
    }

    public function not_vac()
    {
        $data['group'] = $this->advisor->not_vac(
            $this->input->get('group_id')
        );
        $this->load->view('pdf/not_vaccine', $data);
    }
}
