<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_loket extends CI_Model {
	function get_nilai_loket($id,$bulan,$tahun)
	{
		if ($bulan=='setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(tb_hasil.created_date) = "'.$bulan.'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}

		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->join('tb_loket', 'tb_detil_responden.loket = tb_loket.id_loket');
		$this->db->where('tb_loket.id_loket', $id);
		$this->db->where($query);
		$this->db->where('tb_hasil.published', '2');
		return $this->db->get('tb_hasil');
	}

	function get_responden_by_loket($id,$bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(tb_hasil.created_date) = "'.$bulan.'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}

		$this->db->distinct();
		$this->db->select('tb_hasil.id_responden');
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->join('tb_loket', 'tb_detil_responden.loket = tb_loket.id_loket');
		$this->db->where('tb_loket.id_loket', $id);
		$this->db->where($query);
		$this->db->where('tb_hasil.published', '2');
		return $this->db->get('tb_hasil');
	}	

	function get_pilihan($id,$bulan,$tahun,$pilihan)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(tb_hasil.created_date) = "'.$bulan.'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}

		$this->db->join('tb_detil_responden', 'tb_loket.id_loket = tb_detil_responden.loket');
		$this->db->join('tb_hasil', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->where('tb_hasil.jawaban', $pilihan);
		$this->db->where('tb_hasil.id_soal', $id);
		$this->db->where($query);
		$this->db->order_by('tb_hasil.created_date', 'desc');
		$this->db->group_by('tb_loket.id_loket');
		return $this->db->get('tb_loket');
	}	

	function get_hasil_pilihan($id,$bulan,$tahun,$pilihan,$loket)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(tb_hasil.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(tb_hasil.created_date) = "'.$bulan.'" and YEAR(tb_hasil.created_date) = "'.$tahun.'"';
		}

		$this->db->join('tb_detil_responden', 'tb_loket.id_loket = tb_detil_responden.loket');
		$this->db->join('tb_hasil', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->where('tb_hasil.id_soal', $id);
		$this->db->where('tb_hasil.jawaban', $pilihan);
		$this->db->where('tb_loket.id_loket', $loket);
		$this->db->where($query);
		$this->db->order_by('tb_hasil.created_date', 'desc');
		return $this->db->get('tb_loket');
	}	

}

/* End of file M_loket.php */
/* Location: ./application/modules/loket/models/M_loket.php */