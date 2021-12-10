<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function std(){
        
        $this->session->user_id = $this->input->get('id');
        redirect(site_url('form'));
        
    }
    public function advisor(){
        $this->session->user_id = $this->input->get('id');
        redirect(site_url('advisor'));
    }
}