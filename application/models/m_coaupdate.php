<?php 

	class M_coaupdate extends CI_Model{

		// Setting

		public function update_coa_type($data, $company_id, $id_coa_type){
			$query=$this->db->where('company_id', $company_id)
				->where('id_coa_type', $id_coa_type)
				->update('coa_type', $data);

				return $query?true:false;
		}

		public function update_coa_classes($data, $company_id, $id_coa_classes){
			$query=$this->db->where('company_id', $company_id)
				->where('id_coa_classes', $id_coa_classes)
				->update('coa_classes', $data);

				return $query?true:false;
		}

		public function update_coa_currency($data, $company_id, $id_coa_currency){
			$query=$this->db->where('company_id', $company_id)
				->where('id_coa_currency', $id_coa_currency)
				->update('coa_currency', $data);

				return $query?true:false;
		}

		// Input

		public function update_chart_of_account($data, $company_id, $id_coa){
			$query=$this->db->where('company_id', $company_id)
				->where('id_coa', $id_coa)
				->update('coa', $data);

				return $query?true:false;
		}

		public function update_sub_chart_of_account($data, $company_id, $id_coa_sub){
			$query=$this->db->where('company_id', $company_id)
				->where('id_coa_sub', $id_coa_sub)
				->update('coa_sub', $data);

				return $query?true:false;
		}

		public function update_cash_account($data, $company_id, $id_cash_account){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cash_account', $id_cash_account)
				->update('coa_cash_account', $data);

				return $query?true:false;
		}

		public function update_bank_account($company_id, $data, $id_coa_bank){
			$query=$this->db->where('company_id', $company_id)
				->where('id_coa_bank', $id_coa_bank)
				->update('coa_bank_account', $data);

				return $query?true:false;
		}

		public function update_back_cash_account($data, $company_id, $id_cash_account){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cash_account !=', $id_cash_account)
				->update('coa_cash_account', $data);

				return $query?true:false;
		}

		// Delete Rate

		public function delete_rate($company_id, $id_coa_rate){
			$query=$this->db->where('company_id', $company_id)
				->where('id_coa_rate', $id_coa_rate)
				->delete('coa_rate');

			return $query?true:false;
		}

	}

?>