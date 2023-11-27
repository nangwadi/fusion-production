<?php 

	class M_esscreate extends CI_Model{

		// Organization

		public function add_company($data){
			$query=$this->db->insert('company', $data);
			return $query?true:false;
		}

		public function add_plant($data){
			$query=$this->db->insert('company_plant', $data);
			return $query?true:false;
		}

		public function add_department($data){
			$query=$this->db->insert('Dept', $data);
			return $query?true:false;
		}

		public function add_division($data){
			$query=$this->db->insert('Bag', $data);
			return $query?true:false;
		}

		public function add_potition($data){
			$query=$this->db->insert('Jbtn', $data);
			return $query?true:false;
		}

		public function add_limit_medical($data){
			$query=$this->db->insert('limit_medical', $data);
			return $query?true:false;
		}

		public function add_employee_status($data){
			$query=$this->db->insert('StsKrj', $data);
			return $query?true:false;
		}

		public function add_family_status($data){
			$query=$this->db->insert('Sts_Keluarga', $data);
			return $query?true:false;
		}

		public function add_family_relation($data){
			$query=$this->db->insert('HubKel', $data);
			return $query?true:false;
		}

		public function add_education($data){
			$query=$this->db->insert('pendidikan', $data);
			return $query?true:false;
		}

		public function add_religion($data){
			$query=$this->db->insert('agama', $data);
			return $query?true:false;
		}

		public function add_bank($data){
			$query=$this->db->insert('Bank', $data);
			return $query?true:false;
		}

		public function add_salary_component($data){
			$query=$this->db->insert('Komponen', $data);
			return $query?true:false;
		}

		public function add_salary_component_group($data){
			$query=$this->db->insert('Komponen_group', $data);
			return $query?true:false;
		}

		public function add_data_photo($data){
			$query=$this->db->insert('master_data_photo', $data);
			return $query?true:false;
		}

		public function add_blood_group($data){
			$query=$this->db->insert('golongan_darah', $data);
			return $query?true:false;
		}

		public function add_reasons_for_resigning($data){
			$query=$this->db->insert('JnsBerhenti', $data);
			return $query?true:false;
		}

		// Attendance

		public function add_sift_group($data){
			$query=$this->db->insert('Group', $data);
			return $query?true:false;
		}

		public function add_sift($data){
			$query=$this->db->insert('Shift', $data);
			return $query?true:false;
		}	

		public function add_sift_time($data){
			$query=$this->db->insert('ShiftTime', $data);
			return $query?true:false;
		}

		public function add_precense_type($data){
			$query=$this->db->insert('AbsenType', $data);
			return $query?true:false;
		}	

		public function add_national_holiday($data){
			$query=$this->db->insert('libur_nasional', $data);
			return $query?true:false;
		}

		public function add_mandatory_overtime($data){
			$query=$this->db->insert('lembur_wajib', $data);
			return $query?true:false;
		}

		public function add_change_day($data){
			$query=$this->db->insert('ganti_hari', $data);
			return $query?true:false;
		}	

		public function add_ramadhan($data){
			$query=$this->db->insert('ramadhan', $data);
			return $query?true:false;
		}	

		public function add_attendance_periode($data){
			$query=$this->db->insert('PeriodH', $data);
			return $query?true:false;
		}	

		public function create_calendar($data){
			$query=$this->db->insert('master_calendar', $data);
			return $query?true:false;
		}

		// Attendance Record

		public function add_change_sift($data){
			$query=$this->db->insert('personal_sift', $data);
			return $query?true:false;
		}


		// Personal Data

		public function add_personal_data($data){
			$query=$this->db->insert('PersonalData', $data);
			return $query?true:false;
		}

		public function add_personal_education($data){
			$query=$this->db->insert('personal_pendidikan', $data);
			return $query?true:false;
		}

		public function add_email_personal_data($data){
			$query=$this->db->insert('emailPersonalData', $data);
			return $query?true:false;
		}

		public function add_personal_data_pw($data){
			$company_id = $data['company_id'];
			$UserID = $data['UserID'];
			$Pwd = $data['Pwd'];
			$create_by = $data['create_by'];
			$create_date = $data['last_update'];
			$last_by = $data['last_by'];
			$last_update = $data['last_update'];

			$query=$this->db->query("
				insert into AM_ID.dbo.UserApp values ('".$company_id."', '".$UserID."', SUBSTRING(master.dbo.fn_varbintohexstr(HashBytes('MD5', CAST('".$Pwd."' AS nvarchar(max)))), 3, 30), '".$create_by."', '".$create_date."', '".$last_by."', '".$last_update."')
				");

			$this->db->insert('AM_ID.dbo.UserApp2', array(
				'UserID' => $UserID,
				'Pwd' => $Pwd
			));

			return $query?true:false;
		}

		public function add_personal_potition($data){
			$query=$this->db->insert('Hist_Bag', $data);
			return $query?true:false;
		}

		public function add_personal_plant($data){
			$query=$this->db->insert('plant', $data);
			return $query?true:false;
		}

		public function add_personal_family($data){
			$query=$this->db->insert('Keluarga', $data);
			return $query?true:false;
		}

		public function add_personal_tax($data){
			$query=$this->db->insert('tax_status', $data);
			return $query?true:false;
		}

		public function add_personal_insurance($data){
			$query=$this->db->insert('insurance', $data);
			return $query?true:false;
		}

		public function add_personal_bank_account($data){
			$query=$this->db->insert('BankInfo', $data);
			return $query?true:false;
		}

		public function add_personal_salary($data){
			$query=$this->db->insert('Hist_KomponenPeriod', $data);
			return $query?true:false;
		}

		// Upload photo

		public function upload_data_photo($data){
			$query=$this->db->insert('data_photo', $data);
			return $query?true:false;
		}

		// Resign

		public function add_resign($data){
			$query=$this->db->insert('Resign', $data);
			return $query?true:false;
		}

		// Payroll

		public function add_manual_transaction($data){
			$query=$this->db->insert('Trans_Manual', $data);
			return $query?true:false;
		}

		public function add_history_medical($data){
			$query=$this->db->insert('Hist_Medical', $data);
			return $query?true:false;
		}	

		public function add_bpjs($data){
			$query=$this->db->insert('bpjs', $data);
			return $query?true:false;
		}

		public function add_pkp_ptkp($data){
			$query=$this->db->insert('pkp_ptkp', $data);
			return $query?true:false;
		}

		public function add_pkp_ptkp_formula($data, $category){
			if ($category==1) {
				$query=$this->db->insert('pkp_ptkp_formula_company', $data);
			}
			else if ($category==2) {
				$query=$this->db->insert('pkp_ptkp_formula_personal', $data);
			}
			return $query?true:false;
		}

		public function add_salary_deduction($data){
			$query=$this->db->insert('salary_deduction', $data);
			return $query?true:false;
		}

	}

?>