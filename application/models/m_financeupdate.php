<?php 

	class M_financeupdate extends CI_Model{

		// Setting

		public function update_module_category($data, $company_id, $id_module_category){
			$query=$this->db->where('company_id', $company_id)
				->where('id_module_category', $id_module_category)
				->update('fin_module_category', $data);

				return $query?true:false;
		}

		public function update_module($data, $company_id, $id_module){
			$query=$this->db->where('company_id', $company_id)
				->where('id_module', $id_module)
				->update('fin_module', $data);

				return $query?true:false;
		}

		public function update_numbering_sequence($data, $company_id, $id_module){
			$query=$this->db->where('company_id', $company_id)
				->where('id_module', $id_module)
				->update('fin_numbering_sequences', $data);

				return $query?true:false;
		}

		public function update_header_numbering($data, $company_id, $id_module){
			$query=$this->db->where('company_id', $company_id)
				->where('id_module', $id_module)
				->update('fin_header_numbering', $data);

				return $query?true:false;
		}

		public function update_balance($company_id, $data, $id_balance){
			$query=$this->db->where('company_id', $company_id)
				->where('id_balance', $id_balance)
				->update('fin_balance', $data);

				return $query?true:false;
		}

		public function update_balance_by_id_cash_account_transaction_periode($company_id, $data, $id_cash_account, $transaction_periode){
			$query=$this->db->where('company_id', $company_id)
				->where('id_cash_account', $id_cash_account)
				->where('transaction_periode', $transaction_periode)
				->update('fin_balance', $data);

				return $query?true:false;
		}

		public function update_transaction_distribution_by_id_transaction_distribution($company_id, $data, $id_transaction_distribution){
			$query=$this->db->where('company_id', $company_id)
				->where('id_transaction_distribution', $id_transaction_distribution)
				->update('fin_transaction_distribution', $data);

				return $query?true:false;
		}

		// DELETE

		public function delete_transaction_distribution($company_id, $id_transaction_distribution){
			$query=$this->db->where('company_id', $company_id)
				->where('id_transaction_distribution', $id_transaction_distribution)
				->delete('fin_transaction_distribution');

			return $query?true:false;
		}

	}

?>