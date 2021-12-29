<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kuis extends CI_Model {

	function getSoal()
	{
		return $this->db->get('tb_pertanyaan');
	}

	public function save_batch($data)
	{
		return $this->db->insert_batch('tb_hasil', $data);
	}

	public function cekResponden($where)
	{
		return $this->db->get_where('tb_hasil', $where);
	}
}

/* End of file M_kuis.php */
/* Location: ./application/modules/kuis/models/M_kuis.php */