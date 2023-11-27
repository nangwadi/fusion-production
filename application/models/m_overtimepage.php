<?php 

	class M_overtimepage extends CI_Model{

		public function list_maker_approval_category($cNIK){
			$hari_ini=date('Y-m-d');
			$query=$this->db->select('max(category) as category')
			->from('view_ot_maker_approval')
			->where('cNIK', $cNIK)
			->get();

			return $query->result();
		}

		public function list_deadline($company_id){
			$query=$this->db->select('*')
			->from('view_ot_time_deadline')
			->where('company_id', $company_id)
			->get();

			return $query->result();
		}

	}

?>