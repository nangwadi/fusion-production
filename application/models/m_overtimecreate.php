<?php 

	class M_overtimecreate extends CI_Model{

		// Setting

		public function add_maker_approval($data){
			$query=$this->db->insert('ot_maker_approval', $data);
			return $query?true:false;
		}

		// Input

		public function add_daily_overtime($data){
			$query=$this->db->insert('ot_lembur', $data);
			return $query?true:false;
		}

		public function add_catering_overtime($data){
			$query=$this->db->insert('catering', $data);
			return $query?true:false;
		}

	}

?>