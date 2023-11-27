<?php 

	class M_aldoupdate extends CI_Model{

		// Setting

		public function update_annual_leave($data, $company_id, $id_cuti_master){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cuti_master', $id_cuti_master)
				->update('cuti_master', $data);

				return $query?true:false;
		}

		// Input

	}

?>