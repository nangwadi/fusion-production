<?php 

	class M_essread extends CI_Model{

		//ESS
		// Organizaiton

		public function list_company($company_id){
			if ($company_id==0) {
				$query=$this->db->select('*')
				->from('view_company')
				->order_by('company_name', 'asc')
				->get();
			}
			else {
				$query=$this->db->select('*')
				->from('view_company')
				->where('company_id', $company_id)
				->order_by('company_name', 'asc')
				->get();
			}
			return $query->result();
		}

		public function check_session($company_id, $cNIK){

			$query=$this->db->select('*')
				->from('key_session')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			
			return $query->result();
		}

		public function list_plant($company_id, $id_plant){
			if ($id_plant=='0') {
				$query=$this->db->select('*')
					->from('view_company_plant')
					->where('company_id', $company_id)
					->order_by('id_plant', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_company_plant')
					->where('id_plant', $id_plant)
					->where('company_id', $company_id)
					->order_by('id_plant', 'asc')
					->get();
			}
			return $query->result();
		}

		public function list_department($company_id, $cIDDept){
			if ($cIDDept=='0') {
				$query=$this->db->select('*')
					->from('view_department')
					->where('company_id', $company_id)
					->order_by('cIDDept', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_department')
					->where('cIDDept', $cIDDept)
					->where('company_id', $company_id)
					->order_by('cIDDept', 'asc')
					->get();
			}
			return $query->result();
		}

		public function list_division($company_id, $cIDBag){
			if ($cIDBag=='0') {
				$query=$this->db->select('*')
					->from('view_bagian')
					->where('company_id', $company_id)
					->order_by('cIDDept', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_bagian')
					->where('cIDBag', $cIDBag)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_division_by_department($company_id, $cIDDept){
			if ($cIDDept=='0') {
				$query=$this->db->select('*')
					->from('view_bagian')
					->where('company_id', $company_id)
					->order_by('cIDDept', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_bagian')
					->where('cIDDept', $cIDDept)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_potition($company_id, $cIDJbtn){
			if ($cIDJbtn=='0') {
				$query=$this->db->select('*')
					->from('view_jabatan')
					->where('company_id', $company_id)
					->order_by('cIDJbtn', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jabatan')
					->where('cIDJbtn', $cIDJbtn)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_limit_medical($company_id, $cIDJbtn){
			$query=$this->db->select('*')
				->from('limit_medical')
				->where('company_id', $company_id)
				->where('cIDJbtn', $cIDJbtn)
				->get();
			return $query->result();
		}

		public function list_employee_status($company_id, $cIDStsKrj){
			if ($cIDStsKrj=='0') {
				$query=$this->db->select('*')
					->from('view_status_kerja')
					->where('company_id', $company_id)
					->order_by('cIDStsKrj', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_status_kerja')
					->where('cIDStsKrj', $cIDStsKrj)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_family_status($company_id, $cIDSts_Keluarga){
			if ($cIDSts_Keluarga=='0') {
				$query=$this->db->select('*')
					->from('view_status_keluarga')
					->where('company_id', $company_id)
					->order_by('cIDSts_Keluarga', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_status_keluarga')
					->where('cIDSts_Keluarga', $cIDSts_Keluarga)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_family_relation($company_id, $cIDHubKel){
			if ($cIDHubKel=='0') {
				$query=$this->db->select('*')
					->from('view_hubungan_keluarga')
					->where('company_id', $company_id)
					->order_by('cIDHubKel', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_hubungan_keluarga')
					->where('cIDHubKel', $cIDHubKel)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_education($company_id, $id_pendidikan){
			if ($id_pendidikan=='0') {
				$query=$this->db->select('*')
					->from('view_pendidikan')
					->where('company_id', $company_id)
					->order_by('id_pendidikan', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_pendidikan')
					->where('id_pendidikan', $id_pendidikan)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_religion($company_id, $cIDAgama){
			if ($cIDAgama=='0') {
				$query=$this->db->select('*')
					->from('view_agama')
					->where('company_id', $company_id)
					->order_by('cIDAgama', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_agama')
					->where('cIDAgama', $cIDAgama)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_bank($company_id, $cIDBank){
			if ($cIDBank=='0') {
				$query=$this->db->select('*')
					->from('view_bank')
					->where('company_id', $company_id)
					->order_by('cIDBank', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_bank')
					->where('cIDBank', $cIDBank)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_bank_by_cNmBank($company_id, $cNmBank){
			if ($cNmBank=='0') {
				$query=$this->db->select('*')
					->from('view_bank')
					->where('company_id', $company_id)
					->order_by('cNmBank', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_bank')
					->where('cNmBank', $cNmBank)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_salary_component($company_id, $cIDKomponen){
			if ($cIDKomponen=='0') {
				$query=$this->db->select('*')
					->from('view_komponen')
					->where('company_id', $company_id)
					->order_by('cIDKomponen', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_komponen')
					->where('cIDKomponen', $cIDKomponen)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_salary_component_group($company_id, $cIDKomponen_group){
			if ($cIDKomponen_group=='0') {
				$query=$this->db->select('*')
					->from('view_komponen_group')
					->where('company_id', $company_id)
					->order_by('cIDKomponen_group', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_komponen_group')
					->where('cIDKomponen_group', $cIDKomponen_group)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_data_photo($company_id, $id_data_photo){
			if ($id_data_photo=='0') {
				$query=$this->db->select('*')
					->from('view_master_data_photo')
					->where('company_id', $company_id)
					->order_by('id_data_photo', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_master_data_photo')
					->where('id_data_photo', $id_data_photo)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_blood_group($company_id, $id_golongan_darah){
			if ($id_golongan_darah=='0') {
				$query=$this->db->select('*')
					->from('view_golongan_darah')
					->where('company_id', $company_id)
					->order_by('id_golongan_darah', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_golongan_darah')
					->where('id_golongan_darah', $id_golongan_darah)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_reasons_for_resigning($company_id, $cIDJnsBerhenti){
			if ($cIDJnsBerhenti=='0') {
				$query=$this->db->select('*')
					->from('view_jenis_berhenti')
					->where('company_id', $company_id)
					->order_by('cIDJnsBerhenti', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jenis_berhenti')
					->where('cIDJnsBerhenti', $cIDJnsBerhenti)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		// Attendance

		public function list_sift_group($company_id, $cGroupID){
			if ($cGroupID=='0') {
				$query=$this->db->select('*')
					->from('view_sift_group')
					->where('company_id', $company_id)
					->order_by('cGroupID', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_sift_group')
					->where('cGroupID', $cGroupID)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_sift($company_id, $cShiftID){
			if ($cShiftID=='0') {
				$query=$this->db->select('*')
					->from('view_sift')
					->where('company_id', $company_id)
					->order_by('cNmShift', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_sift')
					->where('cShiftID', $cShiftID)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_sift_time($company_id, $cShiftID){
			$order_by = "CHARINDEX(SUBSTRING(cDayNm, 1, 3), 'MONTUEWEDTHUFRISATSUN') / 3 + 1";
			$query=$this->db->select('*')
				->from('view_sift_time')
				->where('company_id', $company_id)
				->where('cShiftID', $cShiftID)
				->order_by($order_by)
				->get();
			return $query->result();
		}

		public function cek_sift_time($company_id, $cShiftID, $cDayNm){
			$query=$this->db->select('*')
				->from('view_sift_time')
				->where('company_id', $company_id)
				->where('cShiftID', $cShiftID)
				->where('cDayNm', $cDayNm)
				->get();
			return $query->result();
		}

		public function list_precense_type($company_id, $cIDAbsen){
			if ($cIDAbsen=='0') {
				$query=$this->db->select('*')
					->from('view_absen_type')
					->where('company_id', $company_id)
					->order_by('cNmAbsen', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_absen_type')
					->where('cIDAbsen', $cIDAbsen)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_national_holiday($company_id, $id_libur_nasional){
			if ($id_libur_nasional=='0') {
				$query=$this->db->select('*')
					->from('view_libur_nasional')
					->where('company_id', $company_id)
					->where('tanggal_libur_nasional >=', (date('Y')-1).'-01-01')
					->order_by('tanggal_libur_nasional', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_libur_nasional')
					->where('id_libur_nasional', $id_libur_nasional)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_national_holiday_by_date($company_id, $tanggal_libur_nasional, $cGroupID){

			$query=$this->db->select('*')
				->from('view_libur_nasional')
				->where('company_id', $company_id)
				->where('tanggal_libur_nasional', $tanggal_libur_nasional)
				->where('("cGroupID"', "'".$cGroupID."'", false)->or_where('"cGroupID"', "'ALL')", false)
				->get();
			
			return $query->result();
		}

		public function list_mandatory_overtime($company_id, $id_lembur_wajib){
			if ($id_lembur_wajib=='0') {
				$query=$this->db->select('*')
					->from('view_lembur_wajib')
					->where('company_id', $company_id)
					->order_by('tanggal_lembur_wajib', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_lembur_wajib')
					->where('id_lembur_wajib', $id_lembur_wajib)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_mandatory_overtime_by_date($company_id, $tanggal_lembur_wajib, $cGroupID){

			$query=$this->db->select('*')
				->from('view_lembur_wajib')
				->where('tanggal_lembur_wajib', $tanggal_lembur_wajib)
				->where('cGroupID', $cGroupID)
				//->or_where('cGroupID', 'ALL')
				->where('company_id', $company_id)
				->get();
			
			return $query->result();
		}

		public function list_change_day($company_id, $id_ganti_hari){
			if ($id_ganti_hari=='0') {
				$query=$this->db->select('*')
					->from('view_ganti_hari')
					->where('company_id', $company_id)
					->order_by('tanggal_ganti_hari', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_ganti_hari')
					->where('id_ganti_hari', $id_ganti_hari)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_change_day_by_date($company_id, $tanggal_ganti_hari, $cGroupID){
			$query=$this->db->select('*')
				->from('view_ganti_hari')
				->where('tanggal_ganti_hari', $tanggal_ganti_hari)
				->where('cGroupID', $cGroupID)
				//->or_where('cGroupID', 'ALL')
				->where('company_id', $company_id)
				->get();
			
			return $query->result();
		}

		public function list_ramadhan($company_id, $id_ramadhan){
			if ($id_ramadhan=='0') {
				$query=$this->db->select('*')
					->from('view_ramadhan')
					->where('company_id', $company_id)
					->order_by('tanggal_awal', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_ramadhan')
					->where('id_ramadhan', $id_ramadhan)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_attendance_periode($company_id, $cIdPeriod){
			if ($cIdPeriod=='0') {
				$query=$this->db->select('*')
					->from('view_master_periode')
					->where('company_id', $company_id)
					->order_by('dTglPeriod_Start', 'desc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_master_periode')
					->where('cIdPeriod', $cIdPeriod)
					->where('company_id', $company_id)
					->get();
			}
			return $query->result();
		}

		public function list_master_calendar($company_id, $cGroupID, $year, $month){
			$query=$this->db->select('*')
				->from('view_master_calendar')
				->where('company_id', $company_id)
				->where('YEAR(dTglHdr)', $year)
				->where('MONTH(dTglHdr)', $month)
				->where('cGroupID', $cGroupID)
				->order_by('dTglHdr', 'asc')
				->get();
			return $query->result();
		}

		// Attendance Record

		public function list_face($company_id, $cNIK, $record){
			$today = date('Y-m-d');
			//$today = '2022-01-25';
			if ($cNIK==0) {
				if ($record==0) {
					$query=$this->db->select('*')
						->from('view_face_log')
						->where('company_id', $company_id)
						->where('date_record', $today)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_face_log')
						->where('company_id', $company_id)
						->where('date_record', $record)
						->order_by('cNmPegawai', 'asc')
						->get();
				}				
			}
			else {
				if ($record==0) {
					$query=$this->db->select('*')
						->from('view_face_log')
						->where('company_id', $company_id)
						->where('cNIK', $cNIK)
						->where('date_record', $today)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_face_log')
						->where('company_id', $company_id)
						->where('cNIK', $cNIK)
						->where('date_record', $record)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
			}
			return $query->result();
		}

		public function list_finger($company_id, $cNIK, $tgl){
			$today = date('Y-m-d');
			//$today = '2022-01-25';
			if ($cNIK==0) {
				if ($tgl==0) {
					$query=$this->db->select('*')
						->from('view_finger_log')
						->where('company_id', $company_id)
						->where('tgl', $today)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_finger_log')
						->where('company_id', $company_id)
						->where('tgl', $tgl)
						->order_by('cNmPegawai', 'asc')
						->get();
				}				
			}
			else {
				if ($tgl==0) {
					$query=$this->db->select('*')
						->from('view_finger_log')
						->where('company_id', $company_id)
						->where('cNIK', $cNIK)
						->where('tgl', $today)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_finger_log')
						->where('company_id', $company_id)
						->where('cNIK', $cNIK)
						->where('tgl', $tgl)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
			}
			return $query->result();
		}

		public function list_change_sift($company_id, $cNIK){

			if ($cNIK==0) {
				$query=$this->db->select('*')
					->from('view_personal_sift')
					->where('company_id', $company_id)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_personal_sift')
					->where('company_id', $company_id)
					->where('cNIK', $cNIK)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_daily_attendance($company_id, $dTglHdr_start, $dTglHdr_end, $cShiftID, $cIDAbsen, $cNIK){
			$today = date('Y-m-d');
			if ($dTglHdr_start=='') {
				$where = "dTglHdr = '".$today."'";
			}
			else {
				$where = "dTglHdr between '".$dTglHdr_start."' and '".$dTglHdr_end."'";
			}

			if ($cNIK=='') {
				if ($cShiftID=='') {
					if ($cIDAbsen=='') {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
					else {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where('cIDAbsen', $cIDAbsen)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
				}
				else {
					if ($cIDAbsen=='') {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where('cShiftID_act', $cShiftID)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
					else {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where('cIDAbsen', $cIDAbsen)
							->where('cShiftID_act', $cShiftID)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
				}
			}		
			else {
				if ($cShiftID=='') {
					if ($cIDAbsen=='') {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where('cNIK', $cNIK)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
					else {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where('cNIK', $cNIK)
							->where('cIDAbsen', $cIDAbsen)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
				}
				else {
					if ($cIDAbsen=='') {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where('cNIK', $cNIK)
							->where('cShiftID_act', $cShiftID)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
					else {
						$query=$this->db->select('*')
							->from('view_ess_hadir')
							->where('company_id', $company_id)
							->where('cNIK', $cNIK)
							->where('cIDAbsen', $cIDAbsen)
							->where('cShiftID_act', $cShiftID)
							->where($where)
							->order_by('cNmPegawai', 'asc')
							->get();
					}
				}
			}
			return $query->result();
		}

		// Attendance Check

		public function list_attendance_check($company_id, $dTglPeriod_Start, $dTglPeriod_End, $category){

			$where = "dTglHdr between '".$dTglPeriod_Start."' and '".$dTglPeriod_End."'";

			if ($company_id==1) {
				if ($category==1) {
					$where_category = "dJamMsk = '00:00' and dJamPlg != '00:00' and cIDAbsen in ('H', 'A')";
				}
				else if ($category==2) {
					$where_category = "dJamMsk != '00:00' and dJamPlg = '00:00' and cIDAbsen in ('H', 'A')";
				}
				else if ($category==3) {
					$where_category = "dJamMsk = dJamPlg and (dJamMsk != '00:00' or dJamPlg != '00:00') and cIDAbsen in ('H', 'A')";
				}
				else if ($category==4) {
					$where_category = "((cShiftID_act='P1' and dJamMsk between '17:00' and '05:00') or (cShiftID_act='M1' and dJamMsk between '05:00' and '17:00'))";
				}
				else if ($category==5) {
					$where_category = "(((cShiftID_act='P1' and dJamPlg >='18:00' and ot_1 = '0.00' and DATENAME(WEEKDAY, dTglHdr) != 'Friday') or (cShiftID_act='P1' and dJamPlg >='19:00' and ot_1 = '0.00' and DATENAME(WEEKDAY, dTglHdr) = 'Friday'))
									or (cShiftID_act='M1' and dJamPlg >='07:00' and ot_1 = '0.00')
									or (cShiftID_act='DO' and dJamPlg >='18:00' and ot_1 = '0.00')
									or (cShiftID_act='LW' and dJamPlg >='12:00' and ot_2 = '0.00')
									or (cShiftID_act='OTP' and dJamPlg >='12:00' and ot_2 = '0.00')
									)";
				}
				else if ($category==6) {
					$where_category = "cShiftID_act='L' and (dJamMsk != '00:00' or dJamPlg != '00:00')";
				}
				else if ($category==7) {
					$where_category = "cShiftID_act in ('OTP', 'OTPR') and dJamMsk >= '17:00'";
				}
				else if ($category==8) {
					$where_category = "cShiftID_act in ('OTP', 'OTPR') and dJamMsk != '00:00' and a.cNIK not in (select cNIK from lembur as b where b.cNIK = cNIK and b.dTglHdr = a.dTglHdr)";
				}
				else if ($category==10) {
					$where_category = "cShiftID_act in ('L') and (dJamMsk != '00:00' or dJamPlg != '00:00')";
				}
				else if ($category==11) {
					$where_category = "((cShiftID_act in ('OTP', 'LW') and dJamMsk between '08:01' and '16:00') 
									or (cShiftID_act in ('OTPR') and dJamMsk between '07:31' and '15:30') 
									or (cShiftID_act in ('OTM') and dJamMsk between '20:01' and '05:00'))";
				}
			}

			$query=$this->db->select('*')
				->from('view_ess_hadir as a')
				->where('company_id', $company_id)
				->where($where)
				->where($where_category)
				->order_by('cNmPegawai', 'asc')
				->get();

			return $query->result();
		}

		// Employee

		public function data_photo($company_id, $cNIK, $kategori){
			$query=$this->db->select('*')
				->from('data_photo')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('kategori', $kategori)
				->get();
			return $query->result();
		}

		public function list_employee($company_id, $status, $cNIK){
			if ($status==1) {
				if ($cNIK=='0') {
					$query=$this->db->select('*')
						->from('view_personal_data')
						->where('company_id', $company_id)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_personal_data')
						->where('company_id', $company_id)
						->where('cNIK', $cNIK)
						->order_by('cNmPegawai', 'asc')
						->get();
				}				
			}
			else {
				if ($cNIK==0) {
					$query=$this->db->select('*')
						->from('view_resign')
						->where('company_id', $company_id)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_resign')
						->where('company_id', $company_id)
						->where('cNIK', $cNIK)
						->order_by('cNmPegawai', 'asc')
						->get();
				}
			}
			return $query->result();
		}

		public function personal_data($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('PersonalData')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function personal_data_by_cnmpegawai($company_id, $cNmPegawai){
			$query=$this->db->select('*')
				->from('PersonalData')
				->where('company_id', $company_id)
				->where('cNmPegawai', $cNmPegawai)
				->get();
			return $query->result();
		}

		public function education($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_personal_pendidikan')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function account($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_account')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function email_personal_data($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('emailPersonalData')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function personal_data_pw($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('AM_ID.dbo.UserApp')
				->where('company_id', $company_id)
				->where('UserID', $cNIK)
				->get();
			return $query->result();
		}

		public function potition($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_potition')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->order_by('dBerlaku_Dari', 'desc')
				->get();
			return $query->result();
		}

		public function plant($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_plant')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function id_card($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_personal_ktp')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function tax_card($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_personal_npwp')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function bpjs($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_personal_bpjs_jst')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->get();
			return $query->result();
		}

		public function family($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_keluarga')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->order_by('cIDHubKel', 'asc')
				->get();
			return $query->result();
		}

		public function family_by_name($company_id, $cNIK, $cNama){
			$query=$this->db->select('*')
				->from('view_keluarga')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('cNama', $cNama)
				->order_by('cIDHubKel', 'asc')
				->get();
			return $query->result();
		}

		public function family_by_relation($company_id, $cNIK, $cIDHubKel){
			$query=$this->db->select('*')
				->from('view_keluarga')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('cIDHubKel', $cIDHubKel)
				->order_by('cIDHubKel', 'asc')
				->get();
			return $query->result();
		}

		public function tax($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_tax_status')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->order_by('dBerlaku_Dari', 'desc')
				->get();
			return $query->result();
		}

		public function tax_by_year($company_id, $cNIK, $year){
			$query=$this->db->select('*')
				->from('view_tax_status')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('tahun', $year)
				->order_by('dBerlaku_Dari', 'desc')
				->get();
			return $query->result();
		}

		public function insurance($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_insurance')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->order_by('dBerlaku_Dari', 'desc')
				->get();
			return $query->result();
		}

		public function bank_account($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_bank_info')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->order_by('deleted', 'asc')
				->get();
			return $query->result();
		}

		public function bank_account_active($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_bank_info')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('deleted', '0')
				->get();
			return $query->result();
		}

		public function component_salary($company_id, $cNIK){
			$query=$this->db->select('*')
				->from('view_komponen_salary')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->order_by('deleted', 'asc')
				->order_by('dBerlaku_dari', 'desc')
				->get();
			return $query->result();
		}

		public function covid19($company_id, $cNIK){
			$where = "kategori in ('9', '10', '11')";
			$query=$this->db->select('*')
				->from('data_photo')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where($where)
				->get();
			return $query->result();
		}

		public function list_medical_limit($company_id, $tahun, $cNIK){
			if ($cNIK==0) {
				$query=$this->db->select('*')
					->from('view_limit_medical')
					->where('company_id', $company_id)
					->where('tahun', $tahun)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_limit_medical')
					->where('company_id', $company_id)
					->where('tahun', $tahun)
					->where('cNIK', $cNIK)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			
			return $query->result();
		}

		// Payroll

		public function last_attendance_periode($company_id){
			
			$query=$this->db->select('top(1) *')
				->from('view_master_periode')
				->where('company_id', $company_id)
				->where('status', '0')
				->order_by('dTglPeriod_Start', 'asc')
				->get();
		
			return $query->result();
		}

		public function list_manual_transaction($company_id, $cIdPeriod){
			$query=$this->db->select('*')
				->from('view_transaksi_manual')
				->where('company_id', $company_id)
				->where('cIdPeriod', $cIdPeriod)
				->order_by('create_date', 'desc')
				->get();
			return $query->result();
		}

		public function list_manual_transaction_by_id($company_id, $id_trans_manual){
			$query=$this->db->select('*')
				->from('view_transaksi_manual')
				->where('company_id', $company_id)
				->where('id_trans_manual', $id_trans_manual)
				->get();
			return $query->result();
		}

		public function check_manual_transaction($company_id, $cNIK, $cIdPeriod, $cIDKomponen){
			$query=$this->db->select('*')
				->from('view_transaksi_manual')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('cIdPeriod', $cIdPeriod)
				->where('cIDKomponen', $cIDKomponen)
				->get();
			return $query->result();
		}

		public function list_history_medical($company_id, $cNIK, $cIDPeriode){
			$query=$this->db->select('*')
				->from('view_history_medical')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('cIDPeriode', $cIDPeriode)
				->order_by('create_date', 'desc')
				->get();
			return $query->result();
		}

		public function total_history_medical($company_id, $tahun, $cNIK){
			$query=$this->db->select('sum(nBiaya_Approve) as total_approve')
				->from('Hist_Medical')
				->where('company_id', $company_id)
				->where('year(dTgl_Berobat)', $tahun)
				->where('cNIK', $cNIK)
				->get();
			
			return $query->result();
		}

		public function list_bpjs($company_id, $id_bpjs){
			if ($id_bpjs=='0') {
				$query=$this->db->select('*')
					->from('view_bpjs')
					->where('company_id', $company_id)
					->order_by('id_bpjs', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_bpjs')
					->where('id_bpjs', $id_bpjs)
					->where('company_id', $company_id)
					->order_by('id_bpjs', 'asc')
					->get();
			}
			return $query->result();
		}

		public function list_pkp_ptkp($company_id){
			$query=$this->db->select('*')
				->from('view_pkp_ptkp')
				->where('company_id', $company_id)
				->get();
			
			return $query->result();
		}

		public function list_pkp_ptkp_formula($company_id, $id_pkp_ptkp_formula, $category){
			if ($category==1) {
				if ($id_pkp_ptkp_formula==0){
					$query=$this->db->select('*')
						->from('view_pkp_ptkp_formula_company')
						->where('company_id', $company_id)
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_pkp_ptkp_formula_company')
						->where('company_id', $company_id)
						->where('id_pkp_ptkp_formula_company', $id_pkp_ptkp_formula)
						->get();
				}
			}
			else if ($category==2) {
				if ($id_pkp_ptkp_formula==0){
					$query=$this->db->select('*')
						->from('view_pkp_ptkp_formula_personal')
						->where('company_id', $company_id)
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_pkp_ptkp_formula_personal')
						->where('company_id', $company_id)
						->where('id_pkp_ptkp_formula_personal', $id_pkp_ptkp_formula)
						->get();
				}
			}
						
			return $query->result();
		}

		public function list_salary_deduction($company_id){
			$query=$this->db->select('*')
				->from('view_salary_deduction')
				->where('company_id', $company_id)
				->get();
			
			return $query->result();
		}
	}

?>