<?php
// defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (empty($this->session->user_id)) {
            redirect(site_url('auth/login'));
        }

        $this->load->model('Form_model', 'form');
    }

    public function index()
    {
        $data = $this->form->index($this->session->user_id);
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        $this->load->view('student_index', $data);
    }

	public function check()
	{
		$this->load->view('check');
	}
	public function not_vaccine()
	{
		$data = $this->form->index($this->session->user_id);
		$this->load->view('not_vaccine', $data);
	}

    public function submit()
    {
        $data = $this->form->submit();
        // echo "<hr>";
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        $this->session->set_flashdata('submit', $data);
        redirect('form');
    }

    public function submit2()
    {
        $data = $this->form->submit2();
        // echo "<hr>";
        // echo "<pre>";
        // var_dump($data);
        // echo "</pre>";
        $this->session->set_flashdata('submit', $data);
        redirect('form');
    }

    public function pdf()
    {
        $this->load->library('tothai');
        $data = '';
        if (!empty($this->input->get('std_id'))) {
            $data = $this->form->index($this->input->get('std_id'));
        } else {
            $data = $this->form->index($this->session->user_id);
        }
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                $_SERVER['DOCUMENT_ROOT'] . '/assets/font',
            ]),
            'fontdata' => $fontData + [
                "thsarabunnew" => [
					'R' => "THSarabunNew.ttf",
					'B' => "THSarabunNew Bold.ttf",
					'I' => "THSarabunNew Italic.ttf",
					'BI' => "THSarabunNew BoldItalic.ttf",
				]
            ],
            'default_font' => 'thsarabunnew'
        ]);
        // $mpdf->debug = true;
        $mpdf->SetDocTemplate('assets/pdf/pfizer_form.pdf');
        // $mpdf->AddPage();

        $pagecount = $mpdf->SetSourceFile("assets/pdf/pfizer_form.pdf");
        for ($i = 1; $i <= ($pagecount); $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
            $data['page'] = $i;
            $html = $this->load->view('pdf/vaccine', $data, true);
            $mpdf->WriteHTML($html);
        }

        $mpdf->Output();
    }

    public function pdf2()
    {
        $this->load->library('tothai');
        $data = null;
        if (!empty($this->input->get('std_id'))) {
            $data = $this->form->index($this->input->get('std_id'));
        } else {
            $data = $this->form->index($this->session->user_id);
        }
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                $_SERVER['DOCUMENT_ROOT'] . '/assets/font',
            ]),
            'fontdata' => $fontData + [
                "thsarabunnew" => [
					'R' => "THSarabunNew.ttf",
					'B' => "THSarabunNew Bold.ttf",
					'I' => "THSarabunNew Italic.ttf",
					'BI' => "THSarabunNew BoldItalic.ttf",
				]
            ],
            'default_font' => 'thsarabunnew'
        ]);
        // $mpdf->debug = true;
        $mpdf->SetDocTemplate('assets/pdf/pfizer_form2.pdf');
        // $mpdf->AddPage();

        $pagecount = $mpdf->SetSourceFile("assets/pdf/pfizer_form2.pdf");
        for ($i = 1; $i <= ($pagecount); $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
            $data['page'] = $i;
            $html = $this->load->view('pdf/vaccine2', $data, true);
            $mpdf->WriteHTML($html);
        }

        $mpdf->Output();
    }

    public function pdf_t()
    {
        $data = [];

        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'fontDir' => array_merge($fontDirs, [
                $_SERVER['DOCUMENT_ROOT'] . '/assets/font',
            ]),
            'fontdata' => $fontData + [
                "thsarabunnew" => [
					'R' => "THSarabunNew.ttf",
					'B' => "THSarabunNew Bold.ttf",
					'I' => "THSarabunNew Italic.ttf",
					'BI' => "THSarabunNew BoldItalic.ttf",
				]
            ],
            'default_font' => 'thsarabunnew'
        ]);
        $mpdf->debug = true;
        $mpdf->SetDocTemplate('assets/pdf/pfizer_form.pdf');
        // $mpdf->AddPage();

        $pagecount = $mpdf->SetSourceFile("assets/pdf/pfizer_form.pdf");
        for ($i = 1; $i <= ($pagecount); $i++) {
            $mpdf->AddPage();
            $import_page = $mpdf->ImportPage($i);
            $mpdf->UseTemplate($import_page);
            $data['page'] = $i;
            $html = $this->load->view('pdf/vaccine_t', $data, true);
            $mpdf->WriteHTML($html);
        }

        $mpdf->Output();
    }
}
