<?php 

	class M_overtimedelete extends CI_Model{

		// Setting

		public function delete_maker_approval($company_id, $id_ot_maker){
			$query=$this->db->where('company_id', $company_id)
				->where('id_ot_maker', $id_ot_maker)
				->delete('ot_maker_approval');

			return $query?true:false;
		}

		// Input

	}

?>