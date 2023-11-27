<?php 

	class M_aldocreate extends CI_Model{

		// Setting

		public function add_annual_leave($data){
			$query=$this->db->insert('cuti_master', $data);
			return $query?true:false;
		}

		public function add_department_approval($data){
			$query=$this->db->insert('cuti_approve', $data);
			return $query?true:false;
		}

		public function add_ga_approval($data){
			$query=$this->db->insert('cuti_approve_ga', $data);
			return $query?true:false;
		}

		public function add_special_approval($data){
			$query=$this->db->insert('cuti_approve_special', $data);
			return $query?true:false;
		}

		public function add_approve_all($data){
			$query=$this->db->insert('cuti_approve_all', $data);
			return $query?true:false;
		}

		public function add_day_off($data){
			$query=$this->db->insert('cuti_day_off', $data);
			return $query?true:false;
		}

		// Input

		public function add_day_off_input($data){
			$query=$this->db->insert('cuti', $data);
			return $query?true:false;
		}
	}

?>