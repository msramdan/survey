<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	function getSoal()
	{
		return $this->db->get('tb_pertanyaan');
	}

	function get_responden_1()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('tb_hasil',['published' => '1']);
	}



	function join_get_responden_2($kolom,$param)
	{
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM tb_hasil where published = 2) as a  , tb_detil_responden  b where  a = b.id_responden and b.'.$kolom.' = "'.$param.'"');
	}

	function getdetil($id_responden)
	{
		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_soal = tb_hasil.id_soal');
		$this->db->where('id_responden', $id_responden);
		return $this->db->get('tb_hasil')->result();
	}

	function getSaran()
	{
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_saran.id_responden');
		$this->db->where('tb_saran.status','1');
		return $this->db->get('tb_saran');
	}

	function get_umur($param)
	{
		if ($param == 'up40') {
			$kolom = 'umur <';
		}
		else
		{
			$kolom = 'umur >=';
		}

		$date = [
			'YEAR(created_date) >= '	=>  date('Y')
		];

		$this->db->where($date);
		return $this->db->get_where('tb_detil_responden', [$kolom => 40 ]);
	}


	/*nilai Loket*/
	function get_nilai_loket($id)
	{
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->join('tb_loket', 'tb_detil_responden.loket = tb_loket.id_loket');
		$this->db->where('tb_loket.id_loket', $id);
		$this->db->where('tb_hasil.published', '2');
		return $this->db->get('tb_hasil');
	}

	function get_responden_by_loket($id)
	{
		$this->db->distinct();
		$this->db->select('tb_hasil.id_responden');
		$this->db->join('tb_detil_responden', 'tb_detil_responden.id_responden = tb_hasil.id_responden');
		$this->db->join('tb_loket', 'tb_detil_responden.loket = tb_loket.id_loket');
		$this->db->where('tb_loket.id_loket', $id);
		$this->db->where('tb_hasil.published', '2');
		return $this->db->get('tb_hasil');
	}

}

/* End of file M_admin.php */
/* Location: ./application/modules/admin/models/M_admin.php */