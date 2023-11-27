<?php 

	class M_ess extends CI_Model{

		//ESS
		// Read

		public function list_absensi($dTglHdr){
			$hrms = $this->load->database('hrms', TRUE);

			$query=$hrms->select('*')
				->from('ess_hadir')
				->where('dTglHdr', $dTglHdr)
				->order_by('cNIK', 'asc')
				->get();					
			
			return $query->result();
		}

		public function list_lembur($dTglHdr){
			$hrms = $this->load->database('hrms', TRUE);

			$query=$hrms->select('*')
				->from('lembur')
				->where('tgl', $dTglHdr)
				->order_by('nik', 'asc')
				->get();					
			
			return $query->result();
		}

		public function list_department($company_id, $cNmDept){

			$query=$this->db->select('*')
				->from('view_department')
				->where('cNmDept', $cNmDept)
				->where('company_id', $company_id)
				->get();
			
			return $query->result();
		}

		public function list_lembur_db($company_id, $cNIK, $dTglHdr){

			$query=$this->db->select('*')
				->from('lembur')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('dTglHdr', $dTglHdr)
				->get();
			
			return $query->result();
		}

		public function list_transaksi_manual($cIdPeriod){
			$hrms = $this->load->database('hrms', TRUE);
			//$where = "dTglProses between '".$dTglPeriod_Start."' and '".$dTglPeriod_End."'";
			$query=$hrms->select('*')
				->from('Trans_Manual')
				->where('cIdPeriod', $cIdPeriod)
				->order_by('dTglProses', 'asc')
				->get();					
			
			return $query->result();
		}

		public function list_transaksi_manual_db($company_id, $cNIK, $cIDKomponen, $cIdPeriod){
			$query=$this->db->select('*')
				->from('view_transaksi_manual')
				->where('company_id', $company_id)
				->where('cNIK', $cNIK)
				->where('cIDKomponen', $cIDKomponen)
				->where('cIdPeriod', $cIdPeriod)
				->get();
			
			return $query->result();
		}

		// Add

		public function add_lembur($data){
			$query=$this->db->insert('lembur', $data);
			return $query?true:false;
		}

		public function add_transaksi_manual($data){
			$query=$this->db->insert('Trans_Manual', $data);
			return $query?true:false;
		}

		// Update

		public function update_absensi($data, $cNIK, $dTglHdr){
			$query=$this->db->where('cNIK', $cNIK)
				->where('dTglHdr', $dTglHdr)
				->update('ess_hadir', $data);

			return $query?true:false;
		}

		public function update_lembur($data, $cNIK, $dTglHdr){
			$query=$this->db->where('cNIK', $cNIK)
				->where('dTglHdr', $dTglHdr)
				->update('lembur', $data);

			return $query?true:false;
		}		

		public function update_transaksi_manual($data, $cNIK, $cIDKomponen, $cIdPeriod){
			$query=$this->db->where('cNIK', $cNIK)
				->where('cIDKomponen', $cIDKomponen)
				->where('cIdPeriod', $cIdPeriod)
				->update('Trans_Manual', $data);

			return $query?true:false;
		}		

	}

?>