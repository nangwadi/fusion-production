<?php 

	class M_coaread extends CI_Model{

		// aldo
		// Setting

		public function list_coa_type($company_id, $id_coa_type){
			if ($id_coa_type=='0') {
				$query=$this->db->select('*')
					->from('view_coa_type')
					->where('company_id', $company_id)
					->order_by('coa_type_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_type')
					->where('company_id', $company_id)
					->where('id_coa_type', $id_coa_type)
					->get();
			}
			
			return $query->result();
		}

		public function list_coa_classes($company_id, $id_coa_classes){
			if ($id_coa_classes=='0') {
				$query=$this->db->select('*')
					->from('view_coa_classes')
					->where('company_id', $company_id)
					->order_by('coa_classes_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_classes')
					->where('company_id', $company_id)
					->where('id_coa_classes', $id_coa_classes)
					->get();
			}
			
			return $query->result();
		}

		public function list_coa_currency($company_id, $id_coa_currency){
			if ($id_coa_currency=='0') {
				$query=$this->db->select('*')
					->from('view_coa_currency')
					->where('company_id', $company_id)
					->order_by('coa_currency_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_currency')
					->where('company_id', $company_id)
					->where('id_coa_currency', $id_coa_currency)
					->get();
			}
			
			return $query->result();
		}

		public function list_coa_currency_by_currency_cd($company_id, $coa_currency_cd){
			if ($coa_currency_cd=='0') {
				$query=$this->db->select('*')
					->from('view_coa_currency')
					->where('company_id', $company_id)
					->order_by('coa_currency_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_currency')
					->where('company_id', $company_id)
					->where('coa_currency_cd', $coa_currency_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_coa_currency_by_currency_name($company_id, $coa_currency_name){
			if ($coa_currency_name=='0') {
				$query=$this->db->select('*')
					->from('view_coa_currency')
					->where('company_id', $company_id)
					->order_by('coa_currency_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_currency')
					->where('company_id', $company_id)
					->where('coa_currency_name', $coa_currency_name)
					->get();
			}
			
			return $query->result();
		}

		// Input

		public function list_chart_of_account($company_id, $id_coa){
			if ($id_coa=='0') {
				$query=$this->db->select('*')
					->from('view_coa')
					->where('company_id', $company_id)
					->order_by('coa_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa')
					->where('company_id', $company_id)
					->where('id_coa', $id_coa)
					->get();
			}
			
			return $query->result();
		}

		public function list_chart_of_account_by_cd($company_id, $coa_cd){
			if ($coa_cd=='0') {
				$query=$this->db->select('*')
					->from('view_coa')
					->where('company_id', $company_id)
					->order_by('coa_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa')
					->where('company_id', $company_id)
					->where('coa_cd', $coa_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_chart_of_account_by_name($company_id, $coa_name){
			if ($coa_name=='0') {
				$query=$this->db->select('*')
					->from('view_coa')
					->where('company_id', $company_id)
					->order_by('coa_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa')
					->where('company_id', $company_id)
					->where('coa_name', $coa_name)
					->get();
			}
			
			return $query->result();
		}

		public function list_sub_chart_of_account($company_id, $id_coa_sub){
			if ($id_coa_sub=='0') {
				$query=$this->db->select('*')
					->from('view_coa_sub')
					->where('company_id', $company_id)
					->order_by('coa_sub_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_sub')
					->where('company_id', $company_id)
					->where('id_coa_sub', $id_coa_sub)
					->get();
			}
			
			return $query->result();
		}

		public function list_sub_chart_of_account_by_cd($company_id, $coa_sub_cd){
			if ($coa_sub_cd=='0') {
				$query=$this->db->select('*')
					->from('view_coa_sub')
					->where('company_id', $company_id)
					->order_by('coa_sub_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_sub')
					->where('company_id', $company_id)
					->where('coa_sub_cd', $coa_sub_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_rate($company_id, $id_coa_rate){
			if ($id_coa_rate=='0') {
				$query=$this->db->select('*')
					->from('view_coa_rate')
					->where('company_id', $company_id)
					->order_by('coa_rate_date', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_rate')
					->where('company_id', $company_id)
					->where('id_coa_rate', $id_coa_rate)
					->get();
			}
			
			return $query->result();
		}

		public function list_rate_by_currency_date($company_id, $id_coa_currency, $coa_rate_date){
			if ($id_coa_currency=='0') {
				$query=$this->db->select('*')
					->from('view_coa_rate')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_rate')
					->where('company_id', $company_id)
					->where('id_coa_currency', $id_coa_currency)
					->where('coa_rate_date', $coa_rate_date)
					->get();
			}
			
			return $query->result();
		}

		public function list_cash_account($company_id, $id_cash_account){
			if ($id_cash_account=='0') {
				$query=$this->db->select('*')
					->from('view_coa_cash_account')
					->where('company_id', $company_id)
					->order_by('cash_account_cd', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_cash_account')
					->where('company_id', $company_id)
					->where('id_cash_account', $id_cash_account)
					->get();
			}
			
			return $query->result();
		}

		public function list_cash_account_by_coa_cd($company_id, $coa_cd){
			if ($coa_cd=='0') {
				$query=$this->db->select('*')
					->from('view_coa_cash_account')
					->where('company_id', $company_id)
					->order_by('cash_account_cd', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_cash_account')
					->where('company_id', $company_id)
					->where('coa_cd', $coa_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_bank_account($company_id, $id_coa_bank){
			if ($id_coa_bank=='0') {
				$query=$this->db->select('*')
					->from('view_coa_bank_account')
					->where('company_id', $company_id)
					->order_by('coa_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_bank_account')
					->where('company_id', $company_id)
					->where('id_coa_bank', $id_coa_bank)
					->get();
			}
			
			return $query->result();
		}

		public function list_bank_account_by_id_coa($company_id, $id_coa){
			if ($id_coa=='0') {
				$query=$this->db->select('*')
					->from('view_coa_bank_account')
					->where('company_id', $company_id)
					->order_by('coa_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_coa_bank_account')
					->where('company_id', $company_id)
					->where('id_coa', $id_coa)
					->get();
			}
			
			return $query->result();
		}

	}

?>