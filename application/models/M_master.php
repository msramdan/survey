<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_master extends CI_Model {

	function getall($table)
	{
		return $this->db->get($table);
	}	

	function input($table,$data)
	{
		$this->db->insert($table, $data);
	}

	function delete($table,$where)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	function update($table,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function getWhere($table,$where)
	{
		return $this->db->get_where($table,$where);
	}	


	function get_responden()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil',['published' => '2'])->num_rows();
	}

	function get_responden_filter($bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$awal = date('m',strtotime('2020-01-01'));
			$where = 'MONTH(created_date) BETWEEN "'.$awal.'" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'" and published="2"';
		}
		else
		{
			$where = 'MONTH(created_date) = "'.$bulan.'" and YEAR(created_date) = "'.$tahun.'" and published="2"';
		}


		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil',$where)->num_rows();
	}

	function get_responden_filter_2($where)
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil',$where)->num_rows();
	}



	function tglindo($bulan)
	{
		if ($bulan == '01') {
			$bulan = 'Januari';
		}
		else if ($bulan == '02') {
			$bulan = 'Februari';
		}
		else if ($bulan == '03') {
			$bulan = 'Maret';
		}
		else if ($bulan == '04') {
			$bulan = 'April';
		}
		else if ($bulan == '05') {
			$bulan = 'Mei';
		}
		else if ($bulan == '06') {
			$bulan = 'Juni';
		}
		else if ($bulan == '07') {
			$bulan = 'Juli';
		}
		else if ($bulan == '08') {
			$bulan = 'Agustus';
		}
		else if ($bulan == '09') {
			$bulan = 'September';
		}
		else if ($bulan == '10') {
			$bulan = 'Oktober';
		}
		else if ($bulan == '11') {
			$bulan = 'November';
		}
		else if ($bulan == '12') {
			$bulan = 'Desember';
		}

		return $bulan;
	}


}

/* End of file M_master.php */
/* Location: ./application/models/M_master.php */