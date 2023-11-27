<?php 

	class M_aldopage extends CI_Model{

		public function list_maker_approval_category($cNIK){
			$hari_ini=date('Y-m-d');
			$query=$this->db->select('max(category) as category')
			->from('view_ot_maker_approval')
			->where('cNIK', $cNIK)
			->get();

			return $query->result();
		}

	}

?>