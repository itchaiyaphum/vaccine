<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Status_vac extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!isset($this->session->user_id) || $this->session->user_level != "student") {
			redirect(site_url('auth/login'));
		}
        $this->load->model('Status_vac_model', 'status_vac');
	}
    public function submit(){
        $data = $this->status_vac->submit();
        $this->session->set_flashdata('submit', $data);
        redirect('form');
    }
    public function edit(){
        $data = $this->status_vac->edit();
        $this->session->set_flashdata('submit', $data);
        redirect('form');
    }
	public function not_vaccine()
	{
		$data = $this->status_vac->not_vaccine();
        $this->session->set_flashdata('submit', $data);
        redirect('form/not_vaccine');
    }
}
