<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_instansi extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_kategori_instansi');
	}
	public function index()
	{

		$data = [
			'title'			=> 'Instansi',
			'sub'			=> 'Kategori Instansi',
			'icon'			=> 'fa-user-circle',
			'menu'			=> 'kategori_instansi',
			'kategori_instansi'			=> $this->M_master->getall('tb_kategori_instansi')->result(),
		];

		$this->template->load('tema/index','kategori_instansi',$data);
	}

	function detil_kategori_instansi($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = $this->M_master->getWhere('tb_kategori_instansi',['kategori_instansi_id' => $id])->row();
		echo json_encode($data);
	}

	function tambah_kategori_instansi()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'nama_kategori_instansi'	=> $this->input->post('nama_kategori_instansi')
		];

		$cek = $this->M_master->input('tb_kategori_instansi',$data);
		if(!$cek){
			$this->session->set_flashdata('success', 'kategori_instansi berhasil ditambahkan');
			redirect('kategori_instansi','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'penambahan kategori_instansi gagal..');
			redirect('kategori_instansi','refresh');
		}
	}

	function update_kategori_instansi()
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$data = [
			'nama_kategori_instansi'	=> $this->input->post('nama_kategori_instansi')
		];

		$where = [
			'kategori_instansi_id'		=> $this->input->post('kategori_instansi_id')
		];

		$cek = $this->M_master->update('tb_kategori_instansi',$where,$data);
		if(!$cek){
			$this->session->set_flashdata('success', 'kategori_instansi berhasil diupdate');
			redirect('kategori_instansi','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'update kategori_instansi gagal..');
			redirect('kategori_instansi','refresh');
		}
	}

	function hapus_kategori_instansi($id)
	{
		if ($this->session->userdata('ses_user') == null) {
			redirect('satpam','refresh');
		}

		$cek = $this->M_master->delete('tb_kategori_instansi',['kategori_instansi_id' => $id]);
		if(!$cek){
			$this->session->set_flashdata('success', 'kategori_instansi berhasil dihapus');
			redirect('kategori_instansi','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Hapus kategori_instansi gagal..');
			redirect('kategori_instansi','refresh');
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
		$kategori_instansi = $this->M_kategori_instansi->get_pilihan($id_soal,$bulan,$tahun,
			$pilihan)->result();

		if (count($kategori_instansi)>0) {
			foreach ($kategori_instansi as $kategori_instansi) {
				$rekap[$no] = [
					'kategori_instansi_id'		=> $kategori_instansi->kategori_instansi_id,
					'id_soal'		=> $kategori_instansi->id_soal,
					'nama_kategori_instansi'	=> $kategori_instansi->nama_kategori_instansi,
					'jumlah'		=> $this->M_kategori_instansi->get_hasil_pilihan($id_soal,$bulan,$tahun,
						$pilihan,$kategori_instansi->kategori_instansi_id)->num_rows()
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
			'title'			=> 'kategori_instansi',
			'sub'			=> 'Jawaban '.$jenis,
			'icon'			=> 'fa-user-circle',
			'menu'			=> 'kategori_instansi',
			'kategori'		=> $kategori,
			'bulan'			=> $bulan,
			'bulan_indo'	=> $this->M_master->tglindo($bulan),
			'tahun'			=> $tahun,
			'rekap'			=> $rekap
		];
		//echo json_encode($data);
		$this->template->load('tema/index','pilihan_kategori_instansi',$data);
	}

	/*PRIVATE FUNCTION*/
	//kategori_instansi
	private function _get_kategori_instansi($bulan,$tahun)
	{
		$kategori_instansi = $this->M_master->getall('tb_kategori_instansi')->result();
		$no = 1;
		foreach($kategori_instansi as $kategori_instansi)
		{
			$data[$no] = [
				'nama_kategori_instansi'	=> $kategori_instansi->nama_kategori_instansi,
				'kategori_instansi_id'		=> $kategori_instansi->kategori_instansi_id,
				'responden'		=> $this->M_kategori_instansi->get_responden_by_kategori_instansi($kategori_instansi->kategori_instansi_id,$bulan,$tahun)->num_rows(),
				'nilai'			=> $this->_get_nilai_kategori_instansi($kategori_instansi->kategori_instansi_id,$bulan,$tahun)
			];
			$no++;
		}
		sort($data);
		return $data;
	}

	private function _get_nilai_kategori_instansi($id,$bulan,$tahun)
	{
		$data 		= $this->M_kategori_instansi->get_nilai_kategori_instansi($id,$bulan,$tahun)->result();

		$responden 	= $this->M_kategori_instansi->get_responden_by_kategori_instansi($id,$bulan,$tahun)->num_rows();
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

}

/* End of file kategori_instansi.php */
/* Location: ./application/modules/kategori_instansi/controllers/kategori_instansi.php */