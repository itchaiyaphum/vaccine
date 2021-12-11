<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model', 'report');
        $this->load->helper('numbers');
    }
    public function index()
    {
        redirect(site_url('report/majors'));
    }

    public function majors()
    {
        $data = array();
        $data['majors'] = $this->report->majors();
        $this->load->view('report/majors', $data);
    }

    public function major()
    {
        $data = array();
        $data['major'] = $this->report->major($this->input->get('i'));
        $this->load->view('report/major', $data);
    }

    public function minor()
    {
        $data = array();
        $data['minor'] = $this->report->minor($this->input->get('i'));
        $this->load->view('report/minor', $data);
    }

    public function group()
    {
        date_default_timezone_set('Asia/Bangkok');
		$this->load->library('tothai');
        $data = array();
        $data['group'] = $this->report->group($this->input->get('i'));
        $this->load->view('report/group', $data);
    }

}
