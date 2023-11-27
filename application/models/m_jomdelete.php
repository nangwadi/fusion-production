<?php 

	class M_jomdelete extends CI_Model{

		// Setting

		public function delete_permission_employee($company_id, $id_permission_employee){
			$query=$this->db->where('company_id', $company_id)
				->where('id_permission_employee', $id_permission_employee)
				->delete('jom_permission_employee');

			return $query?true:false;
		}

		public function delete_permission_special($company_id, $id_permission_special){
			$query=$this->db->where('company_id', $company_id)
				->where('id_permission_special', $id_permission_special)
				->delete('jom_permission_special');

			return $query?true:false;
		}

		public function delete_job_order($company_id, $id_job_order){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_order', $id_job_order)
				->delete('jom_job_order');

			return $query?true:false;
		}

		public function delete_after_trial($company_id, $id_job_order_after_trial){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_order_after_trial', $id_job_order_after_trial)
				->delete('jom_job_order_after_trial');

			return $query?true:false;
		}

		public function delete_after_trial_by_id_job_order($company_id, $id_job_order){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_order', $id_job_order)
				->delete('jom_job_order_after_trial');

			return $query?true:false;
		}

		// input

		public function delete_part_list($company_id, $id_part_list){
			$query=$this->db->where('company_id', $company_id)
				->where('id_part_list', $id_part_list)
				->delete('jom_part_list');

			return $query?true:false;
		}

		public function delete_imo_line($company_id, $id_material_order_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_material_order_line', $id_material_order_line)
				->delete('jom_imo_line');

			return $query?true:false;
		}

		public function delete_rto($company_id, $id_part_list){
			$query=$this->db->where('company_id', $company_id)
				->where('id_part_list', $id_part_list)
				->delete('jom_rto');

			return $query?true:false;
		}

	}

?>