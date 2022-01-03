<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		//cek session
		if ($this->session->userdata('ses_id') == null) {
			redirect('survey/admin','refresh');
		}
	}
	public function index()
	{

		$data = [
			'title'			=> 'Home',
			'sub'			=> 'Statistik',
			'icon'			=> 'fa-user-circle',
			'menu'			=> 'home',
		];

		$this->template->load('tema/index', 'home', $data);
	}

	public function pdf($dari , $ke)
	{
		$this->load->library('dompdf_gen');
		$data = [
			'dari'			=> $dari,
			'ke'			=> $ke,
		];
		$this->load->view('pdf', $data);
		$paper_size = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("laporan.pdf", array('Attachment' => 0));
	}
}

/* End of file kategori_instansi.php */
/* Location: ./application/modules/kategori_instansi/controllers/kategori_instansi.php */