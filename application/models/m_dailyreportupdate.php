<?php 

	class M_dailyreportupdate extends CI_Model{

		// Setting

		public function update_machine_group($data, $company_id, $machine_group_id){
			$db_iot = $this->load->database('iot', TRUE);
			$query=$db_iot->where('machine_group_id', $machine_group_id)
				->update('machine_group', $data);
			return $query?true:false;
		}

	}

?>