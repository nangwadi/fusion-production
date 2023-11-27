<?php 

	class M_aldoupdate extends CI_Model{

		// Setting

		public function update_annual_leave($data, $company_id, $id_cuti_master){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cuti_master', $id_cuti_master)
				->update('cuti_master', $data);

				return $query?true:false;
		}

		public function update_department_approval($data, $company_id, $id_approve){
			$query=$this->db->where('company_id', $company_id)
				->where('id_approve', $id_approve)
				->update('cuti_approve', $data);

				return $query?true:false;
		}

		public function update_ga_approval($data, $company_id, $id_approve){
			$query=$this->db->where('company_id', $company_id)
				->where('id_approve', $id_approve)
				->update('cuti_approve_ga', $data);

				return $query?true:false;
		}

		public function update_day_off($data, $company_id, $id_cuti_day_off){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cuti_day_off', $id_cuti_day_off)
				->update('cuti_day_off', $data);

				return $query?true:false;
		}

		// Input

		public function update_day_off_input($data, $company_id, $id_cuti){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cuti', $id_cuti)
				->update('cuti', $data);

			return $query?true:false;
		}

	}

?>