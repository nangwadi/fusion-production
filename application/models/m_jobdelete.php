<?php 

	class M_jomdelete extends CI_Model{

		// Setting

		public function delete_permission_employee($company_id, $id_permission_employee){
			$query=$this->db->where('company_id', $company_id)
				->where('id_permission_employee', $id_permission_employee)
				->delete('jom_permission_employee');

			return $query?true:false;
		}

	}

?>