<?php 

	class M_templatepage extends CI_Model{

		public function act_login($cNIK, $Pwd){
			$where = "a.UserID='".$cNIK."' and a.Pwd=SUBSTRING(master.dbo.fn_varbintohexstr(HashBytes('MD5', CAST('".$Pwd."' AS nvarchar(max)))), 3, 30) 
			and a.UserID not in (select c.cNIK from HRMS_MEIWA.dbo.Resign c where a.UserID=c.cNIK)";
			
			$query=$this->db->select('a.UserID as cNIK, b.cNmPegawai as cNmPegawai')
				->from('AM_ID.dbo.UserApp as a')
				->join('PersonalData as b', 'a.UserID=b.cNIK', 'INNER')
				->where($where)
				->get();

			return $query->result();
		}

		public function act_login_get($cNIK, $Pwd){
			
			$query=$this->db->select('a.UserID as cNIK, b.cNmPegawai as cNmPegawai')
				->from('AM_ID.dbo.UserApp as a')
				->join('PersonalData as b', 'a.UserID=b.cNIK', 'INNER')
				->where('a.UserID', $cNIK)
				->where('a.Pwd', $Pwd)
				->get();

			return $query->result();
		}

		public function data_karyawan($cNIK){
			$query=$this->db->select('*')
			->from('view_personal_data')
			->where('cNIK', $cNIK)
			->get();

			return $query->result();
		}

		public function insert_session($cNIK, $company_id, $key_session){
			$date_create=date ('Y-m-d H:i:s');

			$query=$this->db->select('cNIK')
				->from('key_session')
				->where ('cNIK', $cNIK)
				->get();

			$tampil=$query->num_rows();

			if ($tampil==0){
				$data_session=array (
					'company_id' => $company_id,
					'cNIK' => $cNIK,
					'session' => $key_session,
					'last_update' => $date_create
				);
				$this->db->insert('key_session',$data_session);
				return false;
			}
			else {
				$data_session=array (
					'session' => $key_session,
					'last_update' => $date_create
				);
				$this->db->where ('cNIK', $cNIK);
				$this->db->where ('company_id', $company_id);
				$this->db->update ('key_session', $data_session);
				return false;
			}
		}
	}

?>