<?php 

	class M_coacreate extends CI_Model{

		// Setting

		public function add_coa_type($data){
			$query=$this->db->insert('coa_type', $data);
			return $query?true:false;
		}

		public function add_coa_classes($data){
			$query=$this->db->insert('coa_classes', $data);
			return $query?true:false;
		}

		public function add_coa_currency($data){
			$query=$this->db->insert('coa_currency', $data);
			return $query?true:false;
		}

		// Input

		public function add_chart_of_account($data){
			$query=$this->db->insert('coa', $data);
			return $query?true:false;
		}

		public function add_sub_chart_of_account($data){
			$query=$this->db->insert('coa_sub', $data);
			return $query?true:false;
		}

		public function add_rate($data){
			$query=$this->db->insert('coa_rate', $data);
			return $query?true:false;
		}

		public function add_cash_account($data){
			$query=$this->db->insert('coa_cash_account', $data);
			return $query?true:false;
		}

		public function add_bank_account($data){
			$query=$this->db->insert('coa_bank_account', $data);
			return $query?true:false;
		}
	}

?>