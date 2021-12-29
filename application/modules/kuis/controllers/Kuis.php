<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kuis extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_kuis');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function pertanyaan()
	{	
		$responden		= $this->input->post('noreg');
		$cek = $this->M_kuis->cekResponden(['id_responden' => $responden])->row();
		
		if ($cek) {
			echo "responden sudah pernah mengisi";
		}else{
			$data['soal'] 		= $this->M_kuis->getSoal()->result();
			$data['noreg'] 		= $responden;
			//$this->load->view('proses',$data);
			$this->load->view('proses', $data);
		}
		
	}

	function hasil()
	{	
		$jawaban = array();
		$index = 0; 
		$data = array();
		$no = 0;

		$id_soal 	= $this->input->post('id_soal');
		$pilihan  	= $this->input->post('pilihan');
		//$responden  = uniqid(12);
		$responden  = $this->input->post('noreg');

		foreach ($pilihan as $pilihan) {
			array_push($jawaban,$pilihan
			);
			$index++;
		} 


		foreach($id_soal as $id_soal){ 
			/*push data kedalam array kosong tadi*/
			array_push($data, array(
				'id_kuis'			=>uniqid(12),
				'id_responden'		=> $responden,
				'id_soal'			=>$id_soal,
				'jawaban'			=> $jawaban[$no++][0]
			));

			$index++;
		}

		//echo json_encode($data);
		$cek = $this->M_kuis->cekResponden(['id_responden' => $responden])->row();
		
		if ($cek) {
			echo "responden sudah pernah mengisi";
		}else{
			$insert = $this->M_kuis->save_batch($data); 
			redirect('kuis','refresh');
		}
		
	}

	public function save()
	{
		$nis 		= $this->input->post('nis'); 
		$nama 		= $this->input->post('nama'); 
		$telp 		= $this->input->post('telp'); 
		$alamat 	= $this->input->post('alamat'); 

		/*buat array kosongan untuk menampung data*/
		$data = array();

		$index = 0; 
		foreach($nis as $datanis){ 
			/*push data kedalam array kosong tadi*/
			array_push($data, array(
				'nis'		=>$datanis,
				'nama'		=>$nama[$index], 
				'telp'		=>$telp[$index], 
				'alamat'	=>$alamat[$index], 
			));

			$index++;
		}

		$sql = $this->M_tes->save_batch($data); 

	    // Cek apakah query insert nya sukses atau gagal
	    if($sql){ // Jika sukses
	    	echo "<script>alert('Data berhasil disimpan');window.location = '".base_url('multiple')."';</script>";
	    }else{ // Jika gagal
	    	echo "<script>alert('Data gagal disimpan');window.location = '".base_url('multiple/form')."';</script>";
	    }
	}
}

/* End of file Kuis.php */
/* Location: ./application/modules/kuis/controllers/Kuis.php */