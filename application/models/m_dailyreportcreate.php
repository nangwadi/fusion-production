<?php 

	class M_dailyreportcreate extends CI_Model{

		// Setting

		public function add_machine_group($data){
			$db_iot = $this->load->database('iot', TRUE);
			$query=$db_iot->insert('machine_group', $data);
			return $query?true:false;
		}

		public function add_machine_group($data){
			$query=$this->db->insert('dr_machine', $data);
			return $query?true:false;
		}
		
	}

?>