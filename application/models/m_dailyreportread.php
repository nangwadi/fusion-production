<?php 

	class M_dailyreportread extends CI_Model{

		// aldo
		// Setting

		var $table_employee = 'view_personal_data';
	    var $column_order_employee = array(null, 'cNIK','cNmPegawai');
	    var $column_search_employee = array('cNIK','cNmPegawai');
	    var $order_employee = array('cNmPegawai' => 'asc');

		public function list_machine_group($company_id, $machine_group_id){
			$db_iot = $this->load->database('iot', TRUE);

			if ($machine_group_id=='0') {
				$query=$db_iot->select('*')
					->from('machine_group')
					->order_by('machine_group_code', 'asc')
					->get();
			}
			else {
				$query=$db_iot->select('*')
					->from('machine_group')
					->where('machine_group_id', $machine_group_id)
					->get();
			}
			
			return $query->result();
		}

		public function list_machine($company_id, $machine_id){
			if ($machine_id=='0') {
				$query=$this->db->select('machine_id, machine_code, machine_code_koutei, deleted')
					->from('view_dr_machine')
					->order_by('machine_code', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dr_machine')
					->where('machine_id', $machine_id)
					->get();
			}			
			return $query->result();
		}

			// delivery Order

			private function _get_list_delivery_order_datatable($company_id){

				$this->db->from($this->table_delivery_order_select);
				$i = 0;

				foreach ($this->column_search_delivery_order_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_delivery_order_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_delivery_order_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_delivery_order_select)) {
					$order = $this->order_delivery_order_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_delivery_order_datatable($company_id) {
				$this->_get_list_delivery_order_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_delivery_order_count_filtered($company_id) {
				$this->_get_list_delivery_order_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_delivery_order_count_all($company_id){
				$this->db->from($this->table_delivery_order_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

	}

?>