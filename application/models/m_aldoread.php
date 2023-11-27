<?php 

	class M_aldoread extends CI_Model{

		// aldo
		// Setting

		public function list_annual_leave($company_id, $id_cuti_master, $year){
			if ($id_cuti_master==0) {
				$query=$this->db->select('*')
					->from('view_cuti_master')
					->where('company_id', $company_id)
					->where('year', $year)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_master')
					->where('company_id', $company_id)
					->where('id_cuti_master', $id_cuti_master)
					->get();
			}
			
			return $query->result();
		}

		public function list_annual_leave_by_employee($company_id, $cNIK, $year){
			if ($cNIK==0) {
				$query=$this->db->select('*')
					->from('view_cuti_master')
					->where('company_id', $company_id)
					->where('year', $year)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_master')
					->where('company_id', $company_id)
					->where('cNIK', $cNIK)
					->get();
			}
			
			return $query->result();
		}

		public function total_annual_leave_used($company_id, $cNIK, $year, $cIDAbsen){
			$query=$this->db->select('sum(total) as total')
				->from('view_cuti')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('year', $year)
				->where('ga4', '1')
				->where('cIDAbsen', $cIDAbsen)
				->get();
			return $query->result();
		}

		public function list_department_approval($company_id, $id_approve){
			if ($id_approve==0) {
				$query=$this->db->select('*')
					->from('view_cuti_approve')
					->where('company_id', $company_id)
					->order_by('cIDDept', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_approve')
					->where('company_id', $company_id)
					->where('id_approve', $id_approve)
					->get();
			}
			return $query->result();
		}

		public function list_department_approval_by_employee($company_id, $cNIK){
			$where = "approve1='".$cNIK."' or approve2='".$cNIK."'";
			$query=$this->db->select('*')
				->from('view_cuti_approve')
				->where('company_id', $company_id)
				->where($where)
				->get();
		
			return $query->result();
		}

		public function list_department_approval_by_employee_approve($company_id, $cNIK, $column){
			$query=$this->db->select('*')
				->from('view_cuti_approve')
				->where('company_id', $company_id)
				->where($column, $cNIK)
				->get();
		
			return $query->result();
		}

		public function list_ga_approval($company_id, $id_approve){
			if ($id_approve==0 || $id_approve=='') {
				$query=$this->db->select('*')
					->from('view_cuti_approve_ga')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_approve_ga')
					->where('company_id', $company_id)
					->where('id_approve', $id_approve)
					->get();
			}
			return $query->result();
		}

		public function list_ga_approval_by_employee($company_id, $cNIK){
			$where = "ga1='".$cNIK."' or ga2='".$cNIK."' or ga3='".$cNIK."' or ga4='".$cNIK."'";
			$query=$this->db->select('*')
				->from('view_cuti_approve_ga')
				->where('company_id', $company_id)
				->where($where)
				->get();
			
			return $query->result();
		}

		public function list_special_approval($company_id, $id_approve_special){
			if ($id_approve_special==0 || $id_approve_special=='') {
				$query=$this->db->select('*')
					->from('view_cuti_approve_special')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_approve_special')
					->where('company_id', $company_id)
					->where('id_approve_special', $id_approve_special)
					->get();
			}
			return $query->result();
		}

		public function list_special_approval_by_employee($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_cuti_approve_special')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function list_approve_all($company_id, $id_approve_all){
			if ($id_approve_all==0 || $id_approve_all=='') {
				$query=$this->db->select('*')
					->from('view_cuti_approve_all')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_approve_all')
					->where('company_id', $company_id)
					->where('id_approve_all', $id_approve_all)
					->get();
			}
			return $query->result();
		}

		public function list_approve_all_by_employee($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_cuti_approve_all')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			
			return $query->result();
		}

		public function list_department_approval_by_department_division_potition($company_id, $cIDDept, $cIDBag, $cIDJbtn){
			$query=$this->db->select('*')
				->from('view_cuti_approve')
				->where('company_id', $company_id)
				->where('cIDDept', $cIDDept)
				->where('cIDBag', $cIDBag)
				->where('cIDJbtn', $cIDJbtn)
				->get();
			return $query->result();
		}

		public function list_employee_by_department($company_id, $cIDDept){
			if ($cIDDept=='0') {
				$query=$this->db->select('cNIK, cNmPegawai')
					->from('view_personal_data')
					->where('company_id', $company_id)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('cNIK, cNmPegawai')
					->from('view_personal_data')
					->where('company_id', $company_id)
					->where('cIDDept', $cIDDept)
					->where('(cIDJbtn)*1 <= ', '6')
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			return $query->result();
		}

		public function list_day_off($company_id, $id_cuti_day_off){
			if ($id_cuti_day_off=='0') {
				$query=$this->db->select('*')
					->from('view_cuti_day_off')
					->where('company_id', $company_id)
					->order_by('id_cuti_day_off', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_day_off')
					->where('company_id', $company_id)
					->where('id_cuti_day_off', $id_cuti_day_off)
					->order_by('id_cuti_day_off', 'asc')
					->get();
			}
			return $query->result();
		}

		public function list_day_off_annual_leave($company_id){
			$query=$this->db->select('*')
				->from('view_cuti_day_off')
				->where('company_id', $company_id)
				->where('annual_leave', '1')
				->get();
			
			return $query->result();
		}

		public function list_day_off_by_precense_id($company_id, $cIDAbsen){
			if ($cIDAbsen=='0') {
				$query=$this->db->select('*')
					->from('view_cuti_day_off')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti_day_off')
					->where('company_id', $company_id)
					->where('cIDAbsen', $cIDAbsen)
					->get();
			}
			
			return $query->result();
		}

		// Input

		public function list_day_off_input($company_id, $cIDAbsen, $cNIK, $year, $id_cuti){
			if ($id_cuti=='0') {
				$query=$this->db->select('*')
					->from('view_cuti')
					->where('company_id', $company_id)
					->where('cIDAbsen', $cIDAbsen)
					->where('cNIK', $cNIK)
					->where('year', $year)
					->order_by('date_start', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_cuti')
					->where('company_id', $company_id)
					->where('id_cuti', $id_cuti)
					->get();
			}
			return $query->result();
		}

		// Approval

		public function list_cuti_approval($company_id, $cIDDept, $cIDBag, $category, $cIDAbsen, $column, $cNIK){
			if ($category=='department') {
				if ($column=='approve1') {
					$query=$this->db->select('*')
						->from('view_cuti')
						->where('company_id', $company_id)
						->where('cIDAbsen', $cIDAbsen)
						->where('cIDDept', $cIDDept)
						->where('cIDBag', $cIDBag)
						->where($column, '0')
						->where($column.'_by', $cNIK)
						->get();
				}
				else if ($column=='approve2') {
					$query=$this->db->select('*')
						->from('view_cuti')
						->where('company_id', $company_id)
						->where('cIDAbsen', $cIDAbsen)
						->where('cIDDept', $cIDDept)
						->where('cIDBag', $cIDBag)
						->where('approve1', '1')
						->where('approve2', '0')
						->where($column.'_by', $cNIK)
						->get();
				}
			}
			else if ($category=='ga') {
				if ($column=='ga1') {
					$query=$this->db->select('*')
						->from('view_cuti')
						->where('company_id', $company_id)
						->where('cIDAbsen', $cIDAbsen)
						->where('approve1', '1')
						->where('approve2', '1')
						->where($column, '0')
						->where($column.'_by', $cNIK)
						->get();	
				}
				else if ($column=='ga2') {
					$query=$this->db->select('*')
						->from('view_cuti')
						->where('company_id', $company_id)
						->where('cIDAbsen', $cIDAbsen)
						->where('ga1', '1')
						->where($column, '0')
						->where($column.'_by', $cNIK)
						->get();
				}
				else if ($column=='ga3') {
					$query=$this->db->select('*')
						->from('view_cuti')
						->where('company_id', $company_id)
						->where('cIDAbsen', $cIDAbsen)
						->where('ga1', '1')
						->where('ga2', '1')
						->where($column, '0')
						->where($column.'_by', $cNIK)
						->get();
				}
				else if ($column=='ga4') {
					$query=$this->db->select('*')
						->from('view_cuti')
						->where('company_id', $company_id)
						->where('cIDAbsen', $cIDAbsen)
						->where('ga1', '1')
						->where('ga2', '1')
						->where('ga3', '1')
						->where($column, '0')
						->where($column.'_by', $cNIK)
						->get();
				}
			}
			else if ($category=='all') {
				$today = date('Y-m-d');
				$last_two_month = date('Y-m-d', strtotime($stop_date . ' -60 day'));

				$query=$this->db->select('*')
					->from('view_cuti')
					->where('company_id', $company_id)
					->where('cIDAbsen', $cIDAbsen)
					->where('date_start >=', $last_two_month)
					->get();
			}
			return $query->result();
		}

	}

?>