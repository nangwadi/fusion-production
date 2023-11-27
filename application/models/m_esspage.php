<?php 

	class M_esspage extends CI_Model{

		public function act_login($cNIK, $Pwd){
			$where = "a.UserID='".$cNIK."' and a.Pwd=SUBSTRING(master.dbo.fn_varbintohexstr(HashBytes('MD5', CAST('".$Pwd."' AS nvarchar(max)))), 3, 30) 
			and a.UserID not in (select c.cNIK from HRMS_MEIWA.dbo.Resign c where a.UserID=c.cNIK and c.lDel='0')";
			
			$query=$this->db->select('a.UserID as cNIK, b.cNmPegawai as cNmPegawai')
			->from('AM_ID.dbo.UserApp as a')
			->join('PersonalData as b', 'a.UserID=b.cNIK', 'INNER')
			->where($where)
			->get();

			return $query->result();
		}

		public function data_karyawan($cNIK){
			$hari_ini=date('Y-m-d');
			$where_tgl = "a.cNIK='".$cNIK."' and (b.dBerlaku_Sdgn is null or b.dBerlaku_Sdgn = '1900-01-01')";
			$query=$this->db->select('a.cNIK as cNIK, a.cNmPegawai as cNmPegawai, b.cIDBag as cIDBag, c.cNmBag as cNmBag, b.cIDJbtn as cIDJbtn, d.cNmJbtn as cNmJbtn, f.cIDDept as cIDDept, f.cNmDept as cNmDept, g.photo as photo, h.email as email')
			->from('PersonalData as a')
			->join('Hist_Bag as b', 'a.cNIK=b.cNIK', 'left')
			->join('Bag as c', 'b.cIDBag=c.cIDBag', 'left')
			->join('Jbtn as d', 'b.cIDJbtn=d.cIDJbtn', 'left')
			->join('DeptBag as e', 'b.cIDBag=e.cIDBag', 'left')
			->join('Dept as f', 'e.cIDDept=f.cIDDept', 'left')
			->join('photo_krw as g', 'a.cNIK=g.cNIK', 'left')
			->join('emailPersonalData as h', 'a.cNIK=h.nik', 'left')
			->where($where_tgl)
			->get();

			return $query->result();
		}

		public function insert_session($cNIK, $key_session){
			$date_create=date ('Y-m-d H:i:s');

			$query=$this->db->select('cNIK')
				->from('key_session')
				->where ('cNIK', $cNIK)
				->get();

			$tampil=$query->num_rows();

			if ($tampil==0){
				$data_session=array (
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
				$this->db->update ('key_session', $data_session);
				return false;
			}
		}
	}

?>