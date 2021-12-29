<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes2 extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_tes2');
	}


	public function index()
	{
		$this->load->view('index');
	}

	public function pertanyaan()
	{
		$responden		= $this->input->post('noreg');
		$cek 			= $this->M_tes2->cekResponden(['id_responden' => $responden])->row();
		
		if ($cek) {
			echo "responden sudah pernah mengisi";
		}else{
			$data['nsoal'] 		= $this->M_tes2->getSoal()->num_rows();
			$data['soal']		= $this->M_tes2->getSoal()->result();
			$data['noreg'] 		= $responden;
			//$this->load->view('proses',$data);
			$this->load->view('pertanyaan', $data);
		}
		
	}

	function get_soal($param)
	{
		$data	= $this->M_tes2->getSoal()->result();
		
		echo json_encode($data[$param]);
	}

	function getSoalCount()
	{
		$data	= $this->M_tes2->getSoal()->num_rows();
		echo json_encode($data);
	}

	function jawaban()
	{
		$data = [
			'id_kuis'		=>uniqid(12),
			'id_responden'	=> $this->input->post('id_responden'),
			'id_soal'		=> $this->input->post('id_soal'),
			'jawaban'		=> $this->input->post('jawaban')
		];

		$cek 	= $this->M_tes2->save($data);
		if(!$cek){
			echo json_encode(array(
				'hasil' => 'berhasil'
			));
		} 
		else {
			echo json_encode(array(
				'hasil' => 'gagal'
			));
		}
	}

}

/* End of file Tes2.php */
/* Location: ./application/modules/tes2/controllers/Tes2.php */