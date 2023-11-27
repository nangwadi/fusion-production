<?php 

	class M_aldodelete extends CI_Model{

		// Setting

		public function delete_department_approval($company_id, $id_approve){
			$query=$this->db->where('company_id', $company_id)
				->where('id_approve', $id_approve)
				->delete('cuti_approve');

			return $query?true:false;
		}

		public function delete_special_approval($company_id, $id_approve_special){
			$query=$this->db->where('company_id', $company_id)
				->where('id_approve_special', $id_approve_special)
				->delete('cuti_approve_special');

			return $query?true:false;
		}

		public function delete_approve_all($company_id, $id_approve_all){
			$query=$this->db->where('company_id', $company_id)
				->where('id_approve_all', $id_approve_all)
				->delete('cuti_approve_all');

			return $query?true:false;
		}

		public function delete_day_off($company_id, $id_cuti_day_off){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cuti_day_off', $id_cuti_day_off)
				->delete('cuti_day_off');

			return $query?true:false;
		}

		// Input

		public function delete_day_off_input($company_id, $id_cuti){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cuti', $id_cuti)
				->delete('cuti');

			return $query?true:false;
		}

	}

?>