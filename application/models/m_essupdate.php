<?php 

	class M_essupdate extends CI_Model{

		// Organization

		public function update_company($data, $company_id){
			$query=$this->db->where('company_id', $company_id)
			->update('company', $data);

			return $query?true:false;
		}

		public function update_plant($data, $id_plant){
			$query=$this->db->where('id_plant', $id_plant)
			->update('company_plant', $data);

			return $query?true:false;
		}

		public function update_department($data, $cIDDept){
			$query=$this->db->where('cIDDept', $cIDDept)
			->update('Dept', $data);

			return $query?true:false;
		}

		public function update_division($data, $cIDBag){
			$query=$this->db->where('cIDBag', $cIDBag)
			->update('Bag', $data);

			return $query?true:false;
		}

		public function update_potition($data, $cIDJbtn){
			$query=$this->db->where('cIDJbtn', $cIDJbtn)
			->update('Jbtn', $data);

			return $query?true:false;
		}

		public function update_limit_medical($data, $cIDJbtn){
			$query=$this->db->where('cIDJbtn', $cIDJbtn)
			->update('limit_medical', $data);

			return $query?true:false;
		}

		public function update_employee_status($data, $cIDStsKrj){
			$query=$this->db->where('cIDStsKrj', $cIDStsKrj)
			->update('StsKrj', $data);

			return $query?true:false;
		}

		public function update_family_status($data, $cIDSts_Keluarga){
			$query=$this->db->where('cIDSts_Keluarga', $cIDSts_Keluarga)
			->update('Sts_Keluarga', $data);

			return $query?true:false;
		}

		public function update_family_relation($data, $cIDHubKel){
			$query=$this->db->where('cIDHubKel', $cIDHubKel)
			->update('HubKel', $data);

			return $query?true:false;
		}

		public function update_education($data, $id_pendidikan){
			$query=$this->db->where('id_pendidikan', $id_pendidikan)
			->update('pendidikan', $data);

			return $query?true:false;
		}

		public function update_religion($data, $cIDAgama){
			$query=$this->db->where('cIDAgama', $cIDAgama)
			->update('agama', $data);

			return $query?true:false;
		}

		public function update_bank($data, $cIDBank){
			$query=$this->db->where('cIDBank', $cIDBank)
			->update('Bank', $data);

			return $query?true:false;
		}

		public function update_salary_component($data, $cIDKomponen){
			$query=$this->db->where('cIDKomponen', $cIDKomponen)
			->update('Komponen', $data);

			return $query?true:false;
		}

		public function update_salary_component_group($data, $cIDKomponen_group){
			$query=$this->db->where('cIDKomponen_group', $cIDKomponen_group)
			->update('Komponen_group', $data);

			return $query?true:false;
		}

		public function update_data_photo($data, $id_data_photo){
			$query=$this->db->where('id_data_photo', $id_data_photo)
			->update('master_data_photo', $data);

			return $query?true:false;
		}

		public function update_blood_group($data, $id_golongan_darah, $company_id){
			$query=$this->db->where('id_golongan_darah', $id_golongan_darah)
			->where('company_id', $company_id)
			->update('golongan_darah', $data);

			return $query?true:false;
		}

		public function update_reasons_for_resigning($data, $cIDJnsBerhenti){
			$query=$this->db->where('cIDJnsBerhenti', $cIDJnsBerhenti)
			->update('JnsBerhenti', $data);

			return $query?true:false;
		}

		// Attendance

		public function update_sift_group($data, $cGroupID){
			$query=$this->db->where('cGroupID', $cGroupID)
			->update('Group', $data);

			return $query?true:false;
		}

		public function update_sift($data, $cShiftID){
			$query=$this->db->where('cShiftID', $cShiftID)
			->update('Shift', $data);

			return $query?true:false;
		}

		public function update_sift_time($data, $cShiftID, $cDayNm){
			$query=$this->db->where('cShiftID', $cShiftID)
			->where('cDayNm', $cDayNm)
			->update('ShiftTime', $data);

			return $query?true:false;
		}

		public function update_precense_type($data, $cIDAbsen){
			$query=$this->db->where('cIDAbsen', $cIDAbsen)
			->update('AbsenType', $data);

			return $query?true:false;
		}

		public function update_national_holiday($data, $id_libur_nasional){
			$query=$this->db->where('id_libur_nasional', $id_libur_nasional)
			->update('libur_nasional', $data);

			return $query?true:false;
		}

		public function update_mandatory_overtime($data, $id_lembur_wajib){
			$query=$this->db->where('id_lembur_wajib', $id_lembur_wajib)
			->update('lembur_wajib', $data);

			return $query?true:false;
		}

		public function update_change_day($data, $id_ganti_hari){
			$query=$this->db->where('id_ganti_hari', $id_ganti_hari)
			->update('ganti_hari', $data);

			return $query?true:false;
		}

		public function update_ramadhan($data, $id_ramadhan){
			$query=$this->db->where('id_ramadhan', $id_ramadhan)
			->update('ramadhan', $data);

			return $query?true:false;
		}

		public function update_attendance_periode($data, $cIdPeriod){
			$query=$this->db->where('cIdPeriod', $cIdPeriod)
			->update('PeriodH', $data);

			return $query?true:false;
		}

		public function update_master_calendar($data, $company_id, $cGroupID, $dTglHdr, $cShiftID_Plan){
			$query=$this->db->where('company_id', $company_id)
				->where('cGroupID', $cGroupID)
				->where('dTglHdr', $dTglHdr)
				->where('cShiftID_Plan', $cShiftID_Plan)
				->update('master_calendar', $data);

			return $query?true:false;
		}

		public function update_change_sift($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->update('personal_sift', $data);

			return $query?true:false;
		}

		// Personal Data

		public function update_personal_data($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->update('PersonalData', $data);
			return $query?true:false;
		}

		public function update_personal_education($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->update('personal_pendidikan', $data);
			return $query?true:false;
		}

		public function update_email_personal_data($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->update('emailPersonalData', $data);
			return $query?true:false;
		}

		public function update_personal_data_pw($data, $cNIK){
			$Pwd = $data['Pwd'];
			$last_by = $data['cNIK_session'];
			$last_update = $data['last_update'];

			$query=$this->db->query("update AM_ID.dbo.UserApp set Pwd = SUBSTRING(master.dbo.fn_varbintohexstr(HashBytes('MD5', CAST('".$Pwd."' AS nvarchar(max)))), 3, 30), last_by = '".$last_by."', last_update = '".$last_update."' where UserID='".$cNIK."'");

			$this->db->where('UserID', $cNIK)
					->update('AM_ID.dbo.UserApp2', array(
						'Pwd' => $Pwd
					));

			return $query?true:false;
		}

		public function update_personal_potition($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->where('dBerlaku_Sdgn', null)
			->update('Hist_Bag', $data);
			return $query?true:false;
		}

		public function update_personal_plant($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->update('plant', $data);
			return $query?true:false;
		}

		public function update_personal_family($data, $cNIK, $cIDHubKel){
			$query=$this->db->where('cNIK', $cNIK)
			->where('cIDHubKel', $cIDHubKel)
			->update('Keluarga', $data);
			return $query?true:false;
		}

		public function update_personal_tax($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->where('dBerlaku_Sdgn', null)
			->update('tax_status', $data);
			return $query?true:false;
		}

		public function update_personal_tax_by_year($data, $cNIK, $year){
			$query=$this->db->where('cNIK', $cNIK)
			->where('tahun', $year)
			->update('tax_status', $data);
			return $query?true:false;
		}

		public function update_personal_insurance($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->where('dBerlaku_Sdgn', null)
			->update('insurance', $data);
			return $query?true:false;
		}

		public function update_personal_bank_account($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->where('deleted', '0')
			->update('BankInfo', $data);
			return $query?true:false;
		}

		public function update_personal_bank_account_by_bank($data, $cNIK, $cIDBank){
			$query=$this->db->where('cNIK', $cNIK)
			->where('cIDBank', $cIDBank)
			->where('deleted', '0')
			->update('BankInfo', $data);
			return $query?true:false;
		}

		public function update_personal_bank_account_disen($data, $cNIK, $cIDBank, $cNoAccount, $cNmPemilik){
			$query=$this->db->where('cNIK', $cNIK)
			->where('cIDBank', $cIDBank)
			->where('cNoAccount', $cNoAccount)
			->where('cNmPemilik', $cNmPemilik)
			->update('BankInfo', $data);
			return $query?true:false;
		}

		public function update_personal_salary($data, $cNIK, $cIDKomponen){
			$query=$this->db->where('cNIK', $cNIK)
			->where('cIDKomponen', $cIDKomponen)
			->where('deleted', '0')
			->update('Hist_KomponenPeriod', $data);
			return $query?true:false;
		}

		public function update_personal_salary_disen($data, $cNIK, $cIDKomponen, $nNilai, $dBerlaku_dari){
			$query=$this->db->where('cNIK', $cNIK)
			->where('cIDKomponen', $cIDKomponen)
			->where('nNilai', $nNilai)
			->where('dBerlaku_dari', $dBerlaku_dari)
			->update('Hist_KomponenPeriod', $data);
			return $query?true:false;
		}

		// Personal Data - Delete

		public function delete_personal_family($cNIK, $cNama, $dTglLhr, $cTempat_Lhr, $cJnsKel, $cIDHubKel){
			$query=$this->db->where('cNIK', $cNIK)
			->where('cNama', $cNama)
			->where('dTglLhr', $dTglLhr)
			->where('cTempat_Lhr', $cTempat_Lhr)
			->where('cJnsKel', $cJnsKel)
			->where('cIDHubKel', $cIDHubKel)
			->delete('Keluarga');
			return $query?true:false;
		}

		// upload data

		public function upload_data_photo($data, $cNIK, $id_data_photo){
			$query=$this->db->where('cNIK', $cNIK)
			->where('kategori', $id_data_photo)
			->update('data_photo', $data);
			return $query?true:false;
		}

		// Resign

		public function update_resign($data, $cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->update('Resign', $data);
			return $query?true:false;
		}

		public function delete_resign($cNIK){
			$query=$this->db->where('cNIK', $cNIK)
			->delete('Resign');
			return $query?true:false;
		}

		// Payroll

		public function update_manual_transaction($data, $id_trans_manual){
			$query=$this->db->where('id_trans_manual', $id_trans_manual)
			->update('Trans_Manual', $data);
			return $query?true:false;
		}

		public function delete_manual_transaction($id_trans_manual){
			$query=$this->db->where('id_trans_manual', $id_trans_manual)
			->delete('Trans_Manual');
			return $query?true:false;
		}

		public function update_history_medical($data, $id_medical){
			$query=$this->db->where('id_medical', $id_medical)
			->update('Hist_Medical', $data);
			return $query?true:false;
		}

		public function update_bpjs($data, $id_bpjs){
			$query=$this->db->where('id_bpjs', $id_bpjs)
			->update('bpjs', $data);

			return $query?true:false;
		}

		public function update_pkp_ptkp($data, $id_pkp_ptkp){
			$query=$this->db->where('id_pkp_ptkp', $id_pkp_ptkp)
			->update('pkp_ptkp', $data);

			return $query?true:false;
		}

		public function update_pkp_ptkp_formula($data, $id_pkp_ptkp_formula, $category){
			if ($category==1) {
				$query=$this->db->where('id_pkp_ptkp_formula_company', $id_pkp_ptkp_formula)
					->update('pkp_ptkp_formula_company', $data);
			}
			else if ($category==2) {
				$query=$this->db->where('id_pkp_ptkp_formula_personal', $id_pkp_ptkp_formula)
					->update('pkp_ptkp_formula_personal', $data);
			}

			return $query?true:false;
		}

		public function update_salary_deduction($data, $id_salary_deduction){
			$query=$this->db->where('id_salary_deduction', $id_salary_deduction)
			->update('salary_deduction', $data);

			return $query?true:false;
		}

		public function update_absensi($data, $company_id, $cNIK, $dTglHdr){
			$query=$this->db->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('dTglHdr', $dTglHdr)
				->update('ess_hadir', $data);

			return $query?true:false;
		}

	}

?>