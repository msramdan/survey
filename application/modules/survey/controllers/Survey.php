<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_survey');
		$this->load->model('M_master');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
		$this->_auto_reset();
		$data = [
			'kepuasan' 		=> $this->_get_kepuasan(),
			'loket'			=> $this->M_master->getall('tb_loket')->num_rows(),
			'pendidikan'	=> $this->_get_pendidikan(),
			'pekerjaan'		=> $this->_get_pekerjaan(),
			'pengunjung' 	=> $this->M_survey->get_responden(),
			'hasil'			=>  $this->_get_hasil(),
			'news1'			=> $this->M_master->getWhere('news',['id'=>1])->row(),
			'news2'			=> $this->M_master->getWhere('news',['id'=>2])->row(),
			'faq'			=> $this->M_master->getall('faq')->result(),
		];
		//menentukan tingkat kepuasan
		$kepuasan = $data['kepuasan'];
		if ($kepuasan > 81.25 && $kepuasan < 100 ) {
			$index = "Sangat Baik";
		}else if($kepuasan > 62.50 && $kepuasan < 81.26){
			$index = 'Baik';
		}else if($kepuasan > 43.75 && $kepuasan < 62.51){
			$index = 'Kurang Baik';
		} else if($kepuasan > 24.9 && $kepuasan < 43.76){
			$index = 'Tidak Baik';
		} else {
			$index = null;
		}

		$data['tingkat_kepuasan'] = $index;
		//hasilnya untuk index kepuasan per soal
		$soal = $this->M_master->getall('tb_pertanyaan')->result();
		$hasil = array();
		$rata  = array();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no] = [
				'id_soal'	=> $v->id_soal,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan($v->id_soal,'d'),
				'p'			=> $this->_get_rataan($v->id_soal,'c'),
				'tp'		=> $this->_get_rataan($v->id_soal,'b'),
				'kec'		=> $this->_get_rataan($v->id_soal,'a'),
				'kepuasan'	=> $this->_get_nilai($v->id_soal)
			];

			$rata[$no] = [

			];
			$no++;
		}
		$data['rekap'] = $hasil;
		//echo json_encode($data['hasil']);
		$this->load->view('index',$data);
	}

	public function cek_user()
	{
		$responden		= $this->input->post('noreg');
		if ($responden == null || $responden == '') {
			$this->session->set_flashdata('error','NIK KTP belum diisi');
			redirect('survey','refresh');
		}
		$cek = $this->M_master->getWhere('tb_hasil',['id_responden' => $responden])->num_rows();
		if ($cek > 0) {
			$this->session->set_flashdata('error','Anda Sudah Pernah Mengisi');
			redirect('survey','refresh');
		}
		else
		{
			$data = [
				'id_responden' 	=> $responden,
				'pekerjaan'		=> $this->M_master->getall('tb_pekerjaan')->result(),
				'pendidikan'	=> $this->M_master->getall('tb_pendidikan')->result(),
				'loket'			=> $this->M_master->getall('tb_loket')->result(),
			];
			$this->load->view('detil_responden', $data);
			//$this->pertanyaan($responden);
		}
	}

	function post_detil_responden()
	{
		$id_detil = uniqid(12);
		$data = [
			'id'			=> $id_detil,
			'id_responden'	=> $this->input->post('id_responden'),
			'nama'			=> $this->input->post('nama'),
			'umur'			=> $this->input->post('umur'),
			'jk'			=> $this->input->post('jk'),
			'pekerjaan'		=> $this->input->post('pekerjaan'),
			'pendidikan'	=> $this->input->post('pendidikan'),
			'loket'			=> $this->input->post('loket')
		];
		$input = $this->M_master->input('tb_detil_responden',$data);
		if (!$input) {
			redirect('survey/pertanyaan/'.$this->input->post('id_responden').'/'.$id_detil,'refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'terjadi Kesalahan');
			redirect('survey','refresh');
		}
	}


	public function pertanyaan($responden,$id_detil)
	{
		//$responden		= $this->input->post('noreg');
		$cek 			= $this->M_survey->cekResponden(['id_responden' => $responden])->row();
		
		if ($cek) {
			$this->session->set_flashdata('error', 'responden sudah pernah berpartisipasi');
			redirect('survey/index','refresh');
		}else{
			$data['nsoal'] 		= $this->M_survey->getSoal()->num_rows();
			$data['soal']		= $this->M_survey->getSoal()->result();
			$data['noreg'] 		= $responden;
			$data['id_detil']	= $id_detil;
			
			//echo json_encode($data);
			$this->load->view('quest', $data);
		}
		
	}

	function get_soal($param)
	{
		$data	= $this->M_survey->getSoal()->result();

		echo json_encode($data[$param]);
	}

	function getSoalCount()
	{
		$data	= $this->M_survey->getSoal()->num_rows();
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

		$cek_soal = $this->M_master->getWhere('jawaban_sementara',['id_soal' => $this->input->post('id_soal')])->num_rows();
		if ($cek_soal>0) {
			$cek 	= $this->M_master->update('jawaban_sementara',['id_soal' => $this->input->post('id_soal')],$data);
			if($cek){
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
		else
		{
			$cek 	= $this->M_survey->save('jawaban_sementara',$data);
			if($cek){
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

	function upload_jawaban()
	{
		$id 	= $this->input->post('id');
		$saran 	= $this->input->post('saran');

		$jawaban = $this->M_master->getWhere('jawaban_sementara',['id_responden' => $id])->result();

		$data_saran = [
			'id_responden'	=> $id,
			'saran'			=> $saran
		];
		
		$this->M_master->input('tb_saran',$data_saran);
		$cek 	= $this->M_survey->save_batch($jawaban);
		if($cek){
			$this->M_master->delete('jawaban_sementara',['id_responden' => $id]);
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

	function saran($id_responden)
	{
		$data['responden'] = $id_responden;
		$this->load->view('saran', $data);
	}

	function publish_jawaban($id_responden)
	{
		$where = ['published' => '1','id_responden' => $id_responden];
		$jawaban = $this->M_master->getWhere('tb_hasil',$where)->result();
		
		$publish 	= $this->M_survey->update('tb_hasil',$where,['published' => '2']);
		if(!$publish){
			redirect('survey','refresh');
		} 
		else {
			echo json_encode(array(
				'hasil' => 'gagal'
			));
		}
	}

	function reset($id)
	{
		$this->M_master->delete('jawaban_sementara',['id_responden' => $id]);
		$this->M_master->delete('tb_detil_responden',['id_responden' => $id]);
		redirect('survey','refresh');
	}

	//private function
	private function _get_hasil()
	{
		$sangat_puas 	= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'd'])->num_rows();
		$puas 		 	= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'c'])->num_rows();
		$tidak_puas 	= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'b'])->num_rows();
		$kecewa 		= $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'a'])->num_rows();

		$all = $sangat_puas+$puas+$tidak_puas+$kecewa;

		if($all != 0)
		{
			$data = [
				[
					'name' 	=> 'sangat_puas',
					/*'y'		=> floatval(number_format(($sangat_puas/$all)*100,2)),*/
					'y'		=> $sangat_puas,
					'color' => '#00FF00'
				],
				[
					'name' 	=> 'puas',
					/*'y'		=> floatval(number_format(($puas/$all)*100,2)),*/
					'y'		=> $puas,
					'color' => 'blue'
				],
				[
					'name' 	=> 'tidak_puas',
					/*'y'		=> floatval(number_format(($tidak_puas/$all)*100,2)),*/
					'y'		=> $tidak_puas,
					'color' => 'purple'
				],
				[
					'name' 	=> 'kecewa',
					/*'y'		=> floatval(number_format(($kecewa/$all)*100,2)),*/
					'y'		=> $kecewa,
					'color' => 'red'
				]
			];
			return $data;
		}
		else
		{
			return null;
		}	
	}

	private function _get_kepuasan()
	{
		$total = $this->M_master->getall('tb_hasil')->num_rows();
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'a'])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'b'])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'c'])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'd'])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden*4*$soal);
			return number_format(($kepuasan*100),2);
		}
		return 0;
	}

	private function _get_nilai($id)
	{
		$total = $this->M_master->getall('tb_hasil')->num_rows();
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'a','id_soal' => $id])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'b','id_soal' => $id])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'c','id_soal' => $id])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => 'd','id_soal' => $id])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden);
			return number_format($kepuasan,2);
		}
		return 0;
	}

	private function _get_rataan($id_soal,$jawaban)
	{
		$total_responden = $this->M_survey->get_responden();
		$data = $this->M_master->getWhere('tb_hasil',['published' => '2','jawaban' => $jawaban,'id_soal' => $id_soal])->num_rows();
		return $data;
	}

	private function _get_pendidikan()
	{
		$pendidikan = $this->M_master->getall('tb_pendidikan')->result();
		$no = 1;
		foreach ($pendidikan as $p) {
			$hasil[$no] = [
				'pendidikan'	=> $p->pendidikan,
				'jumlah'		=> $this->M_survey->join_get_responden_2('pendidikan',$p->pendidikan)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	private function _get_pekerjaan()
	{
		$pekerjaan = $this->M_master->getall('tb_pekerjaan')->result();
		$no = 1;
		foreach ($pekerjaan as $p) {
			$hasil[$no] = [
				'pekerjaan'		=> $p->pekerjaan,
				'jumlah'		=> $this->M_survey->join_get_responden_2('pekerjaan',$p->pekerjaan)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	private function _auto_reset()
	{
		$this->db->where('HOUR(created_date) < ', date('H'));
		$this->db->or_where('DAY(created_date) ', date('d'));
		$this->db->delete('jawaban_sementara');
	}

	/*admin page*/
	function admin()
	{
		$this->load->view('sesi/header');
		$this->load->view('admin/auth');
		$this->load->view('sesi/script');
	}	

	function auth()
	{
		$data = [
			'username'		=> $this->input->post('username') ,
			'password'		=> md5($this->input->post('password')),
		];

		$cek = $this->M_survey->auth($data)->num_rows();
		//echo json_encode($cek);
		if($cek>= 1){
			$user = $this->M_survey->auth($data)->row();
			$this->session->set_userdata('ses_user',$user->username);
			$this->session->set_userdata('ses_id',$user->id_admin);
			$this->session->set_userdata('ses_disp',$user->display);
			redirect('admin','refresh');
		}
		else{
			$this->session->set_flashdata('error', 'username atau password salah');
			redirect('satpam','refresh');
		}
	}

	function errorpage()
	{
		$this->load->view('404');
	}

}

/* End of file Tema.php */
/* Location: ./application/modules/tema/controllers/Tema.php */