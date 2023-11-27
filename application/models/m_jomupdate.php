<?php 

	class M_jomupdate extends CI_Model{

		// Setting

		public function update_job_type($data, $company_id, $id_job_type){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_type', $id_job_type)
				->update('jom_job_type', $data);

				return $query?true:false;
		}

		public function update_job_task($data, $company_id, $id_job_task){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_task', $id_job_task)
				->update('jom_job_task', $data);

				return $query?true:false;
		}

		public function update_job_task_sub($data, $company_id, $id_job_task_sub){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_task_sub', $id_job_task_sub)
				->update('jom_job_task_sub', $data);

				return $query?true:false;
		}

		public function update_country($data, $company_id, $id_country){
			$query=$this->db->where('company_id', $company_id)
				->where('id_country', $id_country)
				->update('jom_country', $data);

				return $query?true:false;
		}

		public function update_tax($data, $company_id, $id_tax){
			$query=$this->db->where('company_id', $company_id)
				->where('id_tax', $id_tax)
				->update('jom_tax', $data);

				return $query?true:false;
		}

		public function update_material($data, $company_id, $id_material){
			$query=$this->db->where('company_id', $company_id)
				->where('id_material', $id_material)
				->update('jom_material', $data);

				return $query?true:false;
		}

		public function update_part_list_status($data, $company_id, $id_part_list_status){
			$query=$this->db->where('company_id', $company_id)
				->where('id_part_list_status', $id_part_list_status)
				->update('jom_part_list_status', $data);

				return $query?true:false;
		}

		public function update_sub_tax($data, $company_id, $id_sub_tax){
			$query=$this->db->where('company_id', $company_id)
				->where('id_sub_tax', $id_sub_tax)
				->update('jom_sub_tax', $data);

				return $query?true:false;
		}

		public function update_permission_special($data, $company_id, $id_permission_special){
			$query=$this->db->where('company_id', $company_id)
				->where('id_permission_special', $id_permission_special)
				->update('jom_permission_special', $data);

				return $query?true:false;
		}

		public function update_permission_type($data, $company_id, $id_permission){
			$query=$this->db->where('company_id', $company_id)
				->where('id_permission', $id_permission)
				->update('jom_permission', $data);

				return $query?true:false;
		}

		public function update_permission_employee($data, $company_id, $id_permission_employee){
			$query=$this->db->where('company_id', $company_id)
				->where('id_permission_employee', $id_permission_employee)
				->update('jom_permission_employee', $data);

				return $query?true:false;
		}

		// Input 

		public function update_account($data, $company_id, $id_account){
			$query=$this->db->where('company_id', $company_id)
				->where('id_account', $id_account)
				->update('jom_account', $data);

				return $query?true:false;
		}

		public function update_account_password($company_id, $data, $id_account){
			$query=$this->db->where('company_id', $company_id)
				->where('id_account', $id_account)
				->update('jom_account_password', $data);

				return $query?true:false;
		}

		public function update_job_number($data, $company_id, $id_account, $id_job_type){
			$query=$this->db->where('company_id', $company_id)
				->where('id_account', $id_account)
				->where('id_job_type', $id_job_type)
				->update('jom_job_number', $data);

				return $query?true:false;
		}

		public function update_job_order($data, $company_id, $id_job_order){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_order', $id_job_order)
				->update('jom_job_order', $data);

			return $query?true:false;
		}

		public function update_after_trial($data, $company_id, $id_job_order_after_trial){
			$query=$this->db->where('company_id', $company_id)
				->where('id_job_order_after_trial', $id_job_order_after_trial)
				->update('jom_job_order_after_trial', $data);

			return $query?true:false;
		}

		public function update_part_list($data, $company_id, $id_part_list){
			$query=$this->db->where('company_id', $company_id)
				->where('id_part_list', $id_part_list)
				->update('jom_part_list', $data);

			return $query?true:false;
		}

		public function update_imo_line($data, $company_id, $id_material_order){
			$query=$this->db->where('company_id', $company_id)
				->where('id_material_order', $id_material_order)
				->update('jom_imo', $data);

			return $query?true:false;
		}

		public function approve_imo($data, $company_id, $id_material_order){
			$query=$this->db->where('company_id', $company_id)
				->where('id_material_order', $id_material_order)
				->update('jom_imo', $data);

			return $query?true:false;
		}

	}

?>