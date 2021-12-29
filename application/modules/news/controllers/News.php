<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
	}
	/*news*/
	public function index()
	{
		$this->output->delete_cache();
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'title'			=> 'News',
			'sub'			=> '',
			'icon'			=> 'fa-rss-square',
			'news'			=> $this->M_master->getall('news')->result(),
			'menu'			=> 'news'
		];

		
		$this->template->load('tema/index','news',$data);
	}

	function editnews($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'title'			=> 'News',
			'sub'			=> 'edit',
			'icon'			=> 'fa-rss-square',
			'news'			=> $this->M_master->getWhere('news',['id'=>$id])->row()
		];

		//echo json_encode($data);
		$this->template->load('tema/index','editnews',$data);
	}

	function updatenews($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$where = ['id' => $id];
		
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 15000;
		$config['max_width']            = 16000;
		$config['max_height']           = 16000;
		$config['file_name']           	= $id.".jpeg";
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;

		//data di database
		$data 	= array(
			'judul'			=> $this->input->post('judul'),
			'konten'		=> $this->input->post('konten'),
			'created_date'	=> date('Y-m-d H:i:s')
		);
		//echo json_encode($data);

		if (!empty($_FILES["image"]["name"])) {
			if ( ! $this->upload->do_upload('image')){
				$this->output->delete_cache();
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect('news','refresh');
			}
			else
			{
				$this->output->delete_cache();
				$this->M_master->update('news', $where, $data);			
				$this->session->set_flashdata('success','News post Success');
				redirect('news','refresh');
			}
		} 
		else 
		{
			$this->M_master->update('news', $where, $data);			
			$this->session->set_flashdata('success','News post Success');
			redirect('news','refresh');
		}
		
	}

	/*FAQ*/
	function faq()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'title'			=> 'FAQ',
			'sub'			=> '',
			'icon'			=> 'fa-question',
			'faq'			=> $this->M_master->getall('faq')->result(),
			'menu'			=> 'faq'
		];

		$this->template->load('tema/index','faq',$data);	
	}

	function hapusfaq($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$cek = $this->M_master->delete('faq',['id' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'FAQ dihapus');
			redirect('news/faq','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('news/faq','refresh');
		}
	}

	function detilfaq($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = $this->M_master->getWhere('faq',['id'=> $id])->row();
		echo json_encode($data);
	}

	function updatefaq()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'pertanyaan'	=> $this->input->post('pertanyaan'),
			'jawaban'		=> $this->input->post('jawaban')
		];

		$cek = $this->M_master->update('faq',['id' => $this->input->post('id_faq')],$data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'FAQ diupdate');
			redirect('news/faq','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('news/faq','refresh');
		}
	}

	function addfaq()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'pertanyaan'	=> $this->input->post('pertanyaan'),
			'jawaban'		=> $this->input->post('jawaban')
		];

		$cek = $this->M_master->input('faq',$data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'FAQ ditambah');
			redirect('news/faq','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('news/faq','refresh');
		}
	}

}

/* End of file News.php 
/* Location: ./application/modules/news/controllers/News.php */