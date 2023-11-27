<?php 

	class M_overtimeread extends CI_Model{

		// Overtime
		// Setting

		public function list_time_deadline($company_id){

				$query=$this->db->select('*')
					->from('view_ot_time_deadline')
					->where('company_id', $company_id)
					->get();
			
			return $query->result();
		}

		public function list_maker_approval($company_id, $category, $id_ot_maker){

			if ($id_ot_maker=='0') {
				$query=$this->db->select('*')
					->from('view_ot_maker_approval')
					->where('company_id', $company_id)
					->where('category', $category)
					->order_by('cIDDept', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_ot_maker_approval')
					->where('company_id', $company_id)
					->where('category', $category)
					->where('id_ot_maker', $id_ot_maker)
					->get();
			}
			
			return $query->result();
		}

		public function list_employee_by_dept_div($company_id, $status, $cIDDept, $cIDBag){
			if ($status==1) {
				if ($cIDBag=='0') {
					if ($cIDDept=='0') {
						$query=$this->db->select('*')
							->from('view_personal_data')
							->where('company_id', $company_id)
							->order_by('cIDDept', 'asc')
							->order_by('cNmPegawai', 'asc')
							->get();
					}
					else {
						$query=$this->db->select('*')
							->from('view_personal_data')
							->where('company_id', $company_id)
							->where('cIDDept', $cIDDept)
							->order_by('cIDDept', 'asc')
							->order_by('cNmPegawai', 'asc')
							->get();
					}
				}
				else {
					$query=$this->db->select('*')
						->from('view_personal_data')
						->where('company_id', $company_id)
						->where('cIDDept', $cIDDept)
						->where('cIDBag', $cIDBag)
						->order_by('cNmPegawai', 'asc')
						->get();	
				}	
			}
			
			return $query->result();
		}

		// Input 

		public function list_daily_overtime($company_id, $category, $dTglHdr, $id_lembur, $cIDDept, $cIDBag){
			$today = date('Y-m-d');
			if ($category==1) {
				$where = "dTglHdr = '".$today."'";
			}
			else {
				if ($dTglHdr==0) {
					$stop_date = new DateTime($today);
					$stop_date->modify('+14 day');
					$next_week = $stop_date->format('Y-m-d');
					$where = "dTglHdr between '".$today."' and '".$next_week."'";
				}
				else {
					$where = "dTglHdr = '".$dTglHdr."'";
				}				
			}

			if ($id_lembur=='0') {
				if ($dTglHdr=='0') {
					if ($cIDDept=='0') {
						if ($cIDBag=='0') {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->order_by('cNmDept', 'asc')
								->get();
						}
						else {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->where('cIDBag', $cIDBag)
								->order_by('cNmDept', 'asc')
								->get();
						}
					}
					else {
						if ($cIDBag=='0') {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->where('cIDDept', $cIDDept)
								->order_by('cNmDept', 'asc')
								->get();
						}
						else {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->where('cIDDept', $cIDDept)
								->where('cIDBag', $cIDBag)
								->order_by('cNmDept', 'asc')
								->get();
						}
					}
				}
				else {
					if ($cIDDept=='0') {
						if ($cIDBag=='0') {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->order_by('cNmDept', 'asc')
								->get();
						}
						else {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->where('cIDBag', $cIDBag)
								->order_by('cNmDept', 'asc')
								->get();
						}
					}
					else {
						if ($cIDBag=='0') {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->where('cIDDept', $cIDDept)
								->order_by('cNmDept', 'asc')
								->get();
						}
						else {
							$query=$this->db->select('*')
								->from('view_ot_lembur')
								->where('company_id', $company_id)
								->where('kategori', $category)
								->where($where)
								->where('cIDDept', $cIDDept)
								->where('cIDBag', $cIDBag)
								->order_by('cNmDept', 'asc')
								->get();
						}
					}
				}
			}
			else {
				$query=$this->db->select('*')
					->from('view_ot_lembur')
					->where('company_id', $company_id)
					->where('kategori', $category)
					->where('id_lembur', $id_lembur)
					->get();
			}
			
			return $query->result();
		}

		public function list_approve_overtime($company_id, $category, $cIDDept, $cIDBag){
			$today = date('Y-m-d');
			if ($category==1) {
				$where = "dTglHdr = '".$today."'";
			}
			else {
				$stop_date = new DateTime($today);
				$stop_date->modify('+14 day');
				$next_week = $stop_date->format('Y-m-d');
				$where = "dTglHdr between '".$today."' and '".$next_week."'";
			}

			if ($cIDDept=='0') {
				if ($cIDBag=='0') {
					$query=$this->db->select('*')
						->from('view_ot_lembur')
						->where('company_id', $company_id)
						->where('kategori', $category)
						->where($where)
						->where('approve', '0')
						->order_by('cNmPegawai', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_ot_lembur')
						->where('company_id', $company_id)
						->where('kategori', $category)
						->where($where)
						->where('cIDDept', $cIDDept)
						->where('approve', '0')
						->order_by('cNmPegawai', 'asc')
						->get();
				}
			}
			else {
				$query=$this->db->select('*')
					->from('view_ot_lembur')
					->where('company_id', $company_id)
					->where('kategori', $category)
					->where($where)
					->where('cIDDept', $cIDDept)
					->where('approve', '0')
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_catering_overtime($company_id, $category, $plant){
			$today = date('Y-m-d');

			$query=$this->db->select('b.plant as plant, count(a.cNIK) as sum')
				->from('ot_lembur as a')
				->join('plant as b', 'a.cNIK=b.cNIK', 'INNER')
				->where('a.company_id', $company_id)
				->where('b.company_id', $company_id)
				->where('a.kategori', $category)
				->where('a.dTglHdr', $today)
				->where('a.approve', '1')
				->where('a.catering', '1')
				->where('b.plant', $plant)
				->group_by('b.plant')
				->get();
			
			return $query->result();
		}

		public function check_catering_overtime(){
			$today = date('Y-m-d');
			$query=$this->db->select('id_catering')
				->from('catering')
				->where('dTglHdr', $today)
				->get();
			
			return $query->result();
		}

		public function list_overtime_by_employee_date($company_id, $category, $dTglHdr, $cNIK){
			$query=$this->db->select('cNIK')
				->from('view_ot_lembur')
				->where('company_id', $company_id)
				->where('kategori', $category)
				->where('dTglHdr', $dTglHdr)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function list_company_plant($company_id, $id_plant){

			$query=$this->db->select('id_plant, plant')
				->from('company_plant')
				->where('company_id', $company_id)
				->where('deleted', '0')
				->get();
			
			return $query->result();
		}

	}

?>