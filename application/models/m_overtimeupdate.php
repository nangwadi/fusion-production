<?php 

	class M_overtimeupdate extends CI_Model{

		// Setting

		public function update_time_deadline($data, $company_id, $id_ot_timeline){
			$query=$this->db->where('company_id', $company_id)
				->where('id_ot_timeline', $id_ot_timeline)
				->update('ot_deadline', $data);

				return $query?true:false;
		}

		public function update_maker_approval($data, $company_id, $id_ot_maker){
			$query=$this->db->where('company_id', $company_id)
				->where('id_ot_maker', $id_ot_maker)
				->update('ot_maker_approval', $data);

				return $query?true:false;
		}

		// Input

		public function update_catering_daily_overtime($data, $company_id, $id_lembur){
			$query=$this->db->where('company_id', $company_id)
				->where('id_lembur', $id_lembur)
				->update('ot_lembur', $data);

				return $query?true:false;
		}

		public function update_catering_overtime($data, $company_id){
			$today = date('Y-m-d');
			$query=$this->db->where('company_id', $company_id)
				->where('dTglHdr', $today)
				->where('ket', '2')
				->update('catering', $data);

				return $query?true:false;
		}

	}

?>