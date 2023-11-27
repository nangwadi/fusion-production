<?php 

	class M_jomcreate extends CI_Model{

		// Setting

		public function add_job_type($data){
			$query=$this->db->insert('jom_job_type', $data);
			return $query?true:false;
		}

		public function add_job_task($data){
			$query=$this->db->insert('jom_job_task', $data);
			return $query?true:false;
		}

		public function add_job_task_sub($data){
			$query=$this->db->insert('jom_job_task_sub', $data);
			return $query?true:false;
		}

		public function add_country($data){
			$query=$this->db->insert('jom_country', $data);
			return $query?true:false;
		}

		public function add_tax($data){
			$query=$this->db->insert('jom_tax', $data);
			return $query?true:false;
		}

		public function add_sub_tax($data){
			$query=$this->db->insert('jom_sub_tax', $data);
			return $query?true:false;
		}

		public function add_material($data){
			$query=$this->db->insert('jom_material', $data);
			return $query?true:false;
		}

		public function add_part_list_status($data){
			$query=$this->db->insert('jom_part_list_status', $data);
			return $query?true:false;
		}

		public function add_permission_type($data){
			$query=$this->db->insert('jom_permission', $data);
			return $query?true:false;
		}

		public function add_permission_special($data){
			$query=$this->db->insert('jom_permission_special', $data);
			return $query?true:false;
		}

		public function add_permission_employee($data){
			$query=$this->db->insert('jom_permission_employee', $data);
			return $query?true:false;
		}

		// Input

		public function add_account($data){
			$query=$this->db->insert('jom_account', $data);
			return $query?true:false;
		}

		public function add_account_password($data){
			$query=$this->db->insert('jom_account_password', $data);
			return $query?true:false;
		}

		public function add_job_number($data){
			$query=$this->db->insert('jom_job_number', $data);
			return $query?true:false;
		}

		public function add_job_order($data){
			$query=$this->db->insert('jom_job_order', $data);
			return $query?true:false;
		}

		public function add_after_trial($data){
			$query=$this->db->insert('jom_job_order_after_trial', $data);
			return $query?true:false;
		}

		public function add_part_list($data){
			$query=$this->db->insert('jom_part_list', $data);
			return $query?true:false;
		}

		public function upload_file_dwg($data){
			$query=$this->db->insert('jom_part_list_file_dwg', $data);
			return $query?true:false;
		}

		public function add_imo($data){
			$query=$this->db->insert('jom_imo', $data);
			return $query?true:false;
		}

		public function add_imo_line($data){
			$query=$this->db->insert('jom_imo_line', $data);
			return $query?true:false;
		}

		public function add_rto($data){
			$query=$this->db->insert('jom_rto', $data);
			return $query?true:false;
		}

	}

?>