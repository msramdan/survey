<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bidang_instansi extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_bidang_instansi');
	}
	public function index($bulan='setahun', $tahun=false)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		if ($bulan == 'setahun') {
			$tahun = date('Y');
		}

		$data = [
			'title'			=> 'Instansi',
			'sub'			=> 'Bidang Instansi',
			'icon'			=> 'fa-user-plus',
			'bidang_instansi'			=> $this->_get_bidang_instansi($bulan,$tahun),
			'menu'			=> 'bidang_instansi',
			'f_bulan'		=> $bulan,
			'f_tahun'		=> $tahun,
			'bulan'			=> $this->M_master->getall('bulan')->result(),
			'tahun'			=> $this->M_master->getall('tahun')->result(),
			'loket' => $this->M_master->getall('tb_loket')->result(),
		];

		$this->template->load('tema/index','bidang_instansi',$data);
	}

	function detil_bidang_instansi($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = $this->M_master->getWhere('tb_bidang_instansi',['bidang_instansi_id' => $id])->row();
		echo json_encode($data);
	}

	function tambah_bidang_instansi()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'nama_bidang_instansi'	=> $this->input->post('nama_bidang_instansi'),
			'instansi_id'	=> $this->input->post('loket_id')
		];

		$cek = $this->M_master->input('tb_bidang_instansi',$data);
		if(!$cek){
			$this->session->set_flashdata('success', 'bidang_instansi berhasil ditambahkan');
			redirect('bidang_instansi','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'penambahan bidang_instansi gagal..');
			redirect('bidang_instansi','refresh');
		}
	}

	function update_bidang_instansi()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'nama_bidang_instansi'	=> $this->input->post('nama_bidang_instansi'),
			'instansi_id'	=> $this->input->post('loket_id')
		];

		$where = [
			'bidang_instansi_id'		=> $this->input->post('bidang_instansi_id')
		];

		$cek = $this->M_master->update('tb_bidang_instansi',$where,$data);
		if(!$cek){
			$this->session->set_flashdata('success', 'bidang_instansi berhasil diupdate');
			redirect('bidang_instansi','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'update bidang_instansi gagal..');
			redirect('bidang_instansi','refresh');
		}
	}

	function hapus_bidang_instansi($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$cek = $this->M_master->delete('tb_bidang_instansi',['bidang_instansi_id' => $id]);
		if(!$cek){
			$this->session->set_flashdata('success', 'bidang_instansi berhasil dihapus');
			redirect('bidang_instansi','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Hapus bidang_instansi gagal..');
			redirect('bidang_instansi','refresh');
		}
	}

	function kecewa($id_soal,$bulan,$tahun,$pilihan)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}
		/*Mengetahui Pertanyaan by id soal*/
		$pertanyaan = $this->M_master->getWhere('tb_pertanyaan',['id_soal'=> $id_soal])->row();
		$kategori 	= $pertanyaan->kategori;

		/*MEnghitung jumlah Jawaban*/
		$no = 1;
		$rekap = array();
		$bidang_instansi = $this->M_bidang_instansi->get_pilihan($id_soal,$bulan,$tahun,
			$pilihan)->result();

		if (count($bidang_instansi)>0) {
			foreach ($bidang_instansi as $bidang_instansi) {
				$rekap[$no] = [
					'bidang_instansi_id'		=> $bidang_instansi->bidang_instansi_id,
					'id_soal'		=> $bidang_instansi->id_soal,
					'nama_bidang_instansi'	=> $bidang_instansi->nama_bidang_instansi,
					'jumlah'		=> $this->M_bidang_instansi->get_hasil_pilihan($id_soal,$bulan,$tahun,
						$pilihan,$bidang_instansi->bidang_instansi_id)->num_rows()
				];

				$no++;
			}
		}

		/*sub Menu*/
		if ($pilihan == 'a') {
			$jenis = 'Kecewa';
		} else if ($pilihan == 'b') {
			$jenis = 'Kurang Puas';
		}  else if ($pilihan == 'c') {
			$jenis = 'Puas';
		}  else if ($pilihan == 'd') {
			$jenis = 'Sangat Puas';
		}

		$data = [
			'title'			=> 'bidang_instansi',
			'sub'			=> 'Jawaban '.$jenis,
			'icon'			=> 'fa-user-circle',
			'menu'			=> 'bidang_instansi',
			'kategori'		=> $kategori,
			'bulan'			=> $bulan,
			'bulan_indo'	=> $this->M_master->tglindo($bulan),
			'tahun'			=> $tahun,
			'rekap'			=> $rekap
		];
		//echo json_encode($data);
		$this->template->load('tema/index','pilihan_bidang_instansi',$data);
	}

	/*PRIVATE FUNCTION*/
	//bidang_instansi
	private function _get_bidang_instansi($bulan,$tahun)
	{
		$bidang_instansi = $this->M_master->getall('tb_bidang_instansi')->result();
		$no = 1;
		foreach($bidang_instansi as $bidang_instansi)
		{
			$data[$no] = [
				'nama_bidang_instansi'				=> $bidang_instansi->nama_bidang_instansi,
				'bidang_instansi_id'					=> $bidang_instansi->bidang_instansi_id,
				'instansi_id'		=> $this->_get_name_kategori($bidang_instansi->instansi_id),
				// 'responden'		=> $this->M_bidang_instansi->get_responden_by_bidang_instansi($bidang_instansi->bidang_instansi_id,$bulan,$tahun)->num_rows(),
				// 'nilai'			=> $this->_get_nilai_bidang_instansi($bidang_instansi->bidang_instansi_id,$bulan,$tahun)
			];
			$no++;
		}
		sort($data);
		return $data;
	}

	private function _get_name_kategori($id){
		$query = $this->db->query("SELECT * from tb_loket where id_loket='$id'")->row();
		return $query->nama_loket;
	}

	private function _get_nilai_bidang_instansi($id,$bulan,$tahun)
	{
		$data 		= $this->M_bidang_instansi->get_nilai_bidang_instansi($id,$bulan,$tahun)->result();

		$responden 	= $this->M_bidang_instansi->get_responden_by_bidang_instansi($id,$bulan,$tahun)->num_rows();
		$total_soal	= $this->M_master->getall('tb_pertanyaan')->num_rows();

		$no = 1;
		$total = 0;
		foreach($data as $data)
		{
			if ($data->jawaban == 'd') {
				$n = 4;;
			}
			else if($data->jawaban == 'c')
			{
				$n = 3;
			}
			else if ($data->jawaban == 'b') {
				$n = 2;
			}
			else
			{
				$n = 1;
			}
			$nilai[$no] = [
				'jawaban' => $n
			];
			$total += $nilai[$no]['jawaban'];
			$no++;
		}

		$nilai_max = $total_soal*4*$responden;
		if ($responden > 0) {
			$kepuasan = ($total/$nilai_max)*100;
		}
		else{
			$kepuasan = 0;
		}

		return $kepuasan;
	}

	public function pdf($bidang_instansi_id,$dari=null,$ke =null)
	{
		$this->load->library('dompdf_gen');
		$data = [
			'bidang_instansi_id'			=> $bidang_instansi_id,
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
		$this->dompdf->stream("laporan_bidang_instansi.pdf", array('Attachment' => 0));
	}


}

/* End of file bidang_instansi.php */
/* Location: ./application/modules/bidang_instansi/controllers/bidang_instansi.php */