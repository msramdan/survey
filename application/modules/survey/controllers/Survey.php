<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survey extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_survey');
		$this->load->model('M_master');
		date_default_timezone_set('Asia/Jakarta');
	}
	public function index()
	{
			$kira = array();
					$data_loket = $this->db->query("SELECT tb_loket.*,tb_kategori_instansi.nama_kategori_instansi from tb_loket
							 join tb_kategori_instansi on tb_kategori_instansi.kategori_instansi_id = tb_loket.kategori_instansi_id")->result();
					$no = 1;
					foreach ($data_loket as $loket) : ?>
						<?php if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
							$dari = $_GET['startDate'];
							$ke = $_GET['endDate'];
							$jml = $this->db->query("SELECT tb_detil_responden.*, tb_bidang_instansi.instansi_id FROM tb_detil_responden
							join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id where created_date >= '$dari' AND created_date <= '$ke' AND instansi_id='$loket->id_loket'");
							$jml_res = $jml->num_rows();
						} else {
							$jml = $this->db->query("SELECT tb_detil_responden.*, tb_bidang_instansi.instansi_id FROM tb_detil_responden
						    join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id where instansi_id='$loket->id_loket'");
							$jml_res = $jml->num_rows();
						} ?>
							<?php
							//persentase nilai
							$q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
							$total_soal = $q_total_soal->num_rows();

							if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
								$bidang_instansi = $this->db->query("SELECT tb_detil_responden.bidang_instansi_id,tb_bidang_instansi.instansi_id FROM tb_detil_responden
								join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id
								where created_date >= '$dari' AND created_date <= '$ke' AND instansi_id='$loket->id_loket' GROUP BY bidang_instansi_id")->result();
							}else{
								$bidang_instansi = $this->db->query("SELECT tb_detil_responden.bidang_instansi_id,tb_bidang_instansi.instansi_id FROM tb_detil_responden
								join tb_bidang_instansi on tb_bidang_instansi.bidang_instansi_id =tb_detil_responden.bidang_instansi_id
								where instansi_id='$loket->id_loket' GROUP BY bidang_instansi_id")->result();
							}
							

							$total = 0;
							$x = 0;
							$total_instansi = 0;
							foreach ($bidang_instansi as $n) {
								//jml respond bidang instansi
								if (isset($_GET['startDate']) && isset($_GET['endDate'])) {
									$dari = $_GET['startDate'];
									$ke = $_GET['endDate'];
									$jml_res_bidang_q = $this->db->query("SELECT * FROM tb_detil_responden where created_date >= '$dari' AND created_date <= '$ke' AND bidang_instansi_id='$n->bidang_instansi_id'");
									$jml_res_bidang = $jml_res_bidang_q->num_rows();

									$nilai_bidang = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil
									join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where tb_hasil.created_date >= '$dari' AND tb_hasil.created_date <= '$ke' AND bidang_instansi_id='$n->bidang_instansi_id'")->result();
									$nilai_total_bidang = 0;
									$nilai_fix_bidang = 0;
									$x_bidang = 1;
									foreach ($nilai_bidang as $b) {
										if ($b->jawaban == 'd') {
											$n = 4;;
										} else if ($b->jawaban == 'c') {
											$n = 3;
										} else if ($b->jawaban == 'b') {
											$n = 2;
										} else {
											$n = 1;
										}
										$nilai[$x_bidang] = [
											'jawaban' => $n
										];
										$nilai_total_bidang += $nilai[$x_bidang]['jawaban'];
										$x_bidang++;
									}
									$nilai_max_bidang = $total_soal * 4 * $jml_res_bidang;

									if ($jml_res_bidang > 0) {
										$nilai_fix_bidang = ($nilai_total_bidang / $nilai_max_bidang) * 100;
									} else {
										$nilai_fix_bidang = 0;
									}
									$x++;
									$total = $total + $nilai_fix_bidang;
									$total_instansi = $total / $x;
									$kira[] = $total_instansi;
								} else {
									$jml_res_bidang_q = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$n->bidang_instansi_id'");
									$jml_res_bidang = $jml_res_bidang_q->num_rows();

									$nilai_bidang = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil
									join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where bidang_instansi_id='$n->bidang_instansi_id'")->result();
									$nilai_total_bidang = 0;
									$nilai_fix_bidang = 0;
									$x_bidang = 1;
									foreach ($nilai_bidang as $b) {
										if ($b->jawaban == 'd') {
											$n = 4;;
										} else if ($b->jawaban == 'c') {
											$n = 3;
										} else if ($b->jawaban == 'b') {
											$n = 2;
										} else {
											$n = 1;
										}
										$nilai[$x_bidang] = [
											'jawaban' => $n
										];
										$nilai_total_bidang += $nilai[$x_bidang]['jawaban'];
										$x_bidang++;
									}
									$nilai_max_bidang = $total_soal * 4 * $jml_res_bidang;

									if ($jml_res_bidang > 0) {
										$nilai_fix_bidang = ($nilai_total_bidang / $nilai_max_bidang) * 100;
									} else {
										$nilai_fix_bidang = 0;
									}
									$x++;
									$total = $total + $nilai_fix_bidang;
									$total_instansi = $total / $x;
									$kira[] = $total_instansi;
								}
							
							}
							
							?>
							
					<?php endforeach ?>
					<?php
						$jml = count($kira);
						$sum = array_sum($kira);

		$this->_auto_reset();
		$data = [
			'kepuasan' 		=>round($sum / $jml , 2),
			'loket'			=> $this->M_master->getall('tb_loket')->num_rows(),
			'pendidikan'	=> $this->_get_pendidikan(),
			'pekerjaan'		=> $this->_get_pekerjaan(),
			'pengunjung' 	=> $this->M_survey->get_responden(),
			'hasil'			=>  $this->_get_hasil(),
			'news1'			=> $this->M_master->getWhere('news', ['id' => 1])->row(),
			'news2'			=> $this->M_master->getWhere('news', ['id' => 2])->row(),
			'faq'			=> $this->M_master->getall('faq')->result(),
		];
		//menentukan tingkat kepuasan
		$kepuasan = $data['kepuasan'];
		if ($kepuasan > 81.25 && $kepuasan < 100) {
			$index = "Sangat Baik";
		} else if ($kepuasan > 62.50 && $kepuasan < 81.26) {
			$index = 'Baik';
		} else if ($kepuasan > 43.75 && $kepuasan < 62.51) {
			$index = 'Kurang Baik';
		} else if ($kepuasan > 24.9 && $kepuasan < 43.76) {
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
				'sp'		=> $this->_get_rataan($v->id_soal, 'd'),
				'p'			=> $this->_get_rataan($v->id_soal, 'c'),
				'tp'		=> $this->_get_rataan($v->id_soal, 'b'),
				'kec'		=> $this->_get_rataan($v->id_soal, 'a'),
				'kepuasan'	=> $this->_get_nilai($v->id_soal)
			];

			$rata[$no] = [];
			$no++;
		}
		$data['rekap'] = $hasil;
		//echo json_encode($data['hasil']);
		$this->load->view('index', $data);
	}

	public function cek_user()
	{
		$responden		= $this->input->post('noreg');
		if ($responden == null || $responden == '') {
			$this->session->set_flashdata('error', 'NIK KTP belum diisi');
			redirect('survey', 'refresh');
		}
		$data = [
			'id_responden' 	=> $responden,
			'pekerjaan'		=> $this->M_master->getall('tb_pekerjaan')->result(),
			'pendidikan'	=> $this->M_master->getall('tb_pendidikan')->result(),
			'loket'			=> $this->M_master->getall('tb_loket')->result(),
		];
		$this->load->view('detil_responden', $data);
	}

	public function modal_data(){
		$id = $_POST['id'];
		$data_bidang_instansi = $this->db->query("SELECT tb_bidang_instansi.*,tb_loket.nama_loket from tb_bidang_instansi
							 join tb_loket on tb_loket.id_loket = tb_bidang_instansi.instansi_id where instansi_id ='$id'")->result();
		$output = '';
		$no = 1;
		foreach ($data_bidang_instansi as $row) {
			$jml = $this->db->query("SELECT * FROM tb_detil_responden where bidang_instansi_id='$row->bidang_instansi_id'");
			$jml_res = $jml->num_rows();
			$q_total_soal = $this->db->query("SELECT * FROM tb_pertanyaan");
										$total_soal = $q_total_soal->num_rows();
										$nilai_persentase = $this->db->query("SELECT tb_hasil.*,tb_detil_responden.bidang_instansi_id FROM tb_hasil join tb_detil_responden on tb_detil_responden.id = tb_hasil.detail_responden_id where bidang_instansi_id='$row->bidang_instansi_id'")->result();
										$total = 0;
										$x = 1;
										foreach ($nilai_persentase as $n) {
											if ($n->jawaban == 'd') {
												$n = 4;;
											} else if ($n->jawaban == 'c') {
												$n = 3;
											} else if ($n->jawaban == 'b') {
												$n = 2;
											} else {
												$n = 1;
											}
											$nilai[$x] = [
												'jawaban' => $n
											];
											$total += $nilai[$x]['jawaban'];
											$x++;
										}
										$nilai_max = $total_soal * 4 * $jml_res;
										if ($jml_res > 0) {
											$hasil = round(($total/$nilai_max)*100,2).' %';
										 } else {
											$hasil = '0 %' ;
										} 
			$output .= '
					<tr>
						<th scope="row">'.$no++.'</th>
						<td>'.$row->nama_bidang_instansi.'</td>
						<td>'.$jml_res.'</td>
						<td>'.$hasil.'</td>
					</tr>     
              ';
		}
		echo $output;
	}

	public function pertanyaan()
	{
		$responden = $this->input->post('id_responden');
		$bidang_instansi_id = $this->input->post('bidang_instansi_id');
		$id_detil = uniqid(12);

		$cek = $this->M_survey->cekResponden(
			[
				'id_responden' => $responden,
				'bidang_instansi_id' => $bidang_instansi_id
			]
		)->row();
		if ($cek) {
			$this->session->set_flashdata('error', 'responden sudah pernah berpartisipasi untuk bidang tersebut');
			redirect('survey/index', 'refresh');
		} else {
			// $this->M_master->input('tb_detil_responden',$data);
			$data = [
				'id'					=> $id_detil,
				'id_responden'			=> $responden,
				'nama'					=> $this->input->post('nama'),
				'umur'					=> $this->input->post('umur'),
				'jk'					=> $this->input->post('jk'),
				'pekerjaan'				=> $this->input->post('pekerjaan'),
				'pendidikan'			=> $this->input->post('pendidikan'),
				'bidang_instansi_id'	=> $this->input->post('bidang_instansi_id'),

				'soal'					=> $this->M_survey->getSoal()->result(),
				'nsoal'					=> $this->M_survey->getSoal()->num_rows(),
				'noreg'					=> $responden,
				'id_detil'				=> $id_detil
			];
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
			'id_kuis'		=> uniqid(12),
			'id_responden'	=> $this->input->post('id_responden'),
			'id_soal'		=> $this->input->post('id_soal'),
			'jawaban'		=> $this->input->post('jawaban')
		];

		$cek_soal = $this->M_master->getWhere('jawaban_sementara', ['id_soal' => $this->input->post('id_soal')])->num_rows();
		if ($cek_soal > 0) {
			$cek 	= $this->M_master->update('jawaban_sementara', ['id_soal' => $this->input->post('id_soal')], $data);
			if ($cek) {
				echo json_encode(array(
					'hasil' => 'berhasil'
				));
			} else {
				echo json_encode(array(
					'hasil' => 'gagal'
				));
			}
		} else {
			$cek 	= $this->M_survey->save('jawaban_sementara', $data);
			if ($cek) {
				echo json_encode(array(
					'hasil' => 'berhasil'
				));
			} else {
				echo json_encode(array(
					'hasil' => 'gagal'
				));
			}
		}
	}

	function get_bidang_instansi()
	{
		$id = $this->input->post('selectedValue');
		$output = '';
		$data_bidang = $this->db->query("SELECT * from tb_bidang_instansi where instansi_id='$id'")->result();
		$query_cek = $this->db->query("SELECT * from tb_bidang_instansi where instansi_id='$id'");
		$jml = $query_cek->num_rows();

		if ($id == null || $id == '') {
			$output .= '<div class="alert alert-info" role="alert">
				Silahkan pilih instansi terlebih dahulu
			  </div>';
		} else {
			if ($jml > 0) {
				$output .= '<div class="form-group">
							<label for="loket">Bidang Instansi</label>
							<select class="form-control" name="bidang_instansi_id" id="bidang_instansi_id" required>
							<option value="">--chose--</option>';
				foreach ($data_bidang as $row) {
					$output .= ' <option value="' . $row->bidang_instansi_id . '">' . $row->nama_bidang_instansi . '</option>
				  ';
				}
				$output .= '</select>';
			} else {
				$output .= '<div class="form-group">
							<label for="loket">Bidang Instansi</label>
							<select class="form-control" name="bidang_instansi_id" id="bidang_instansi_id" required>
							<option value="">--chose--</option>';
				$output .= '</select>
				<p style="color:red">Jika bidang instansi kosong, silahkan pilih instansi lain/hubungi petugas</p>';
			}
		}
		echo $output;
	}

	function upload_jawaban()
	{
		//add Data responden
		$kira = [
			'id_responden'			=> $this->input->post('id'),
			'nama'					=> $this->input->post('nama'),
			'umur'					=> $this->input->post('umur'),
			'jk'					=> $this->input->post('jk'),
			'pekerjaan'				=> $this->input->post('pekerjaan'),
			'pendidikan'			=> $this->input->post('pendidikan'),
			'bidang_instansi_id'	=> $this->input->post('bidang_instansi_id')
		];

		$this->M_master->input('tb_detil_responden', $kira);
		$detail_responden_id = $this->db->insert_id();
		$id 	= $this->input->post('id');
		$saran 	= $this->input->post('saran');
		// $jawaban = $this->M_master->getWhere('jawaban_sementara', ['id_responden' => $id])->result();

	

		$data_saran = [
			'id_responden'	=> $id,
			'detail_responden_id'	=> $detail_responden_id,
			'saran'			=> $saran
		];
		$this->M_master->input('tb_saran', $data_saran);
		// $cek 	= $this->M_survey->save_batch($jawaban);

		$query  = "SELECT * FROM jawaban_sementara where id_responden='$id'";
		$result = $this->db->query($query);
		foreach ($result->result() as $row) {
			$data2 = array(
				'detail_responden_id' => $detail_responden_id,
				'id_responden' => $id,
				'id_soal' => $row->id_soal,
				'jawaban' => $row->jawaban
			);
			$this->db->insert('tb_hasil', $data2);
		}
		
		// if ($cek) {
			$this->M_master->delete('jawaban_sementara', ['id_responden' => $id]);
			echo json_encode(array(
				'hasil' => 'berhasil'
			));
		// } else {
		// 	echo json_encode(array(
		// 		'hasil' => 'gagal'
		// 	));
		// }
	}

	function saran($id_responden)
	{
		$data['responden'] = $id_responden;
		$data['nama'] = $_GET['nama'];
		$data['umur'] = $_GET['umur'];
		$data['pekerjaan'] = $_GET['pekerjaan'];
		$data['pendidikan'] = $_GET['pendidikan'];
		$data['bidang_instansi_id'] = $_GET['bidang_instansi_id'];
		$data['jk'] = $_GET['jk'];
		$this->load->view('saran', $data);
	}

	function publish_jawaban($id_responden)
	{
		$where = ['published' => '1', 'id_responden' => $id_responden];
		$jawaban = $this->M_master->getWhere('tb_hasil', $where)->result();

		$publish 	= $this->M_survey->update('tb_hasil', $where, ['published' => '2']);
		if (!$publish) {
			redirect('survey', 'refresh');
		} else {
			echo json_encode(array(
				'hasil' => 'gagal'
			));
		}
	}

	function reset($id)
	{
		$this->M_master->delete('jawaban_sementara', ['id_responden' => $id]);
		$this->M_master->delete('tb_detil_responden', ['id_responden' => $id]);
		redirect('survey', 'refresh');
	}

	//private function
	private function _get_hasil()
	{
		$sangat_puas 	= $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'd'])->num_rows();
		$puas 		 	= $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'c'])->num_rows();
		$tidak_puas 	= $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'b'])->num_rows();
		$kecewa 		= $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'a'])->num_rows();

		$all = $sangat_puas + $puas + $tidak_puas + $kecewa;

		if ($all != 0) {
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
		} else {
			return null;
		}
	}

	private function _get_kepuasan()
	{
		$total = $this->M_master->getall('tb_hasil')->num_rows();
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'a'])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'b'])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'c'])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'd'])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d * 4) + ($c * 3) + ($b * 2) + ($a * 1)) / ($total_responden * 4 * $soal);
			return number_format(($kepuasan * 100), 2);
		}
		return 0;
	}

	private function _get_nilai($id)
	{
		$total = $this->M_master->getall('tb_hasil')->num_rows();
		$soal = $this->M_master->getall('tb_pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'a', 'id_soal' => $id])->num_rows();
		$b = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'b', 'id_soal' => $id])->num_rows();
		$c = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'c', 'id_soal' => $id])->num_rows();
		$d = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => 'd', 'id_soal' => $id])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d * 4) + ($c * 3) + ($b * 2) + ($a * 1)) / ($total_responden);
			return number_format($kepuasan, 2);
		}
		return 0;
	}

	private function _get_rataan($id_soal, $jawaban)
	{
		$total_responden = $this->M_survey->get_responden();
		$data = $this->M_master->getWhere('tb_hasil', ['published' => '2', 'jawaban' => $jawaban, 'id_soal' => $id_soal])->num_rows();
		return $data;
	}

	private function _get_pendidikan()
	{
		$pendidikan = $this->M_master->getall('tb_pendidikan')->result();
		$no = 1;
		foreach ($pendidikan as $p) {
			$hasil[$no] = [
				'pendidikan'	=> $p->pendidikan,
				'jumlah'		=> $this->M_survey->join_get_responden_2('pendidikan', $p->pendidikan)->num_rows()
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
				'jumlah'		=> $this->M_survey->join_get_responden_2('pekerjaan', $p->pekerjaan)->num_rows()
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
			'username'		=> $this->input->post('username'),
			'password'		=> md5($this->input->post('password')),
		];

		$cek = $this->M_survey->auth($data)->num_rows();
		//echo json_encode($cek);
		if ($cek >= 1) {
			$user = $this->M_survey->auth($data)->row();
			$this->session->set_userdata('ses_user', $user->username);
			$this->session->set_userdata('ses_id', $user->id_admin);
			$this->session->set_userdata('ses_disp', $user->display);
			redirect('home', 'refresh');
		} else {
			$this->session->set_flashdata('error', 'username atau password salah');
			redirect('satpam', 'refresh');
		}
	}

	function errorpage()
	{
		$this->load->view('404');
	}
}

/* End of file Tema.php */
/* Location: ./application/modules/tema/controllers/Tema.php */