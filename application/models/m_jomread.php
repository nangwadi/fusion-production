<?php 

	class M_jomread extends CI_Model{

		// Jom
		// Setting

		var $table_account = 'view_jom_account';
	    var $column_order_account = array(null, 'account_name');
	    var $column_search_account = array('account_name');
	    var $order_account = array('account_name' => 'asc');

	    var $table_employee = 'view_personal_data';
	    var $column_order_employee = array(null, 'cNIK', 'cNmPegawai');
	    var $column_search_employee = array('cNIK', 'cNmPegawai');
	    var $order_employee = array('cNmPegawai' => 'asc');

	    var $table_part_list = 'view_jom_part_list';
	    var $column_order_part_list = array(null, 'part_no', 'part_name', 'material_cd', 'qty', 'qty_spare', 'single_multi', 'sp_1', 'sp_2', 'sp_3', 'sp_4', 'sp_5', 'note', 'drawing_no', 'account_name_vendor', 'account_name_maker');
	    var $column_search_part_list = array('part_no', 'part_name', 'material_cd', 'qty', 'qty_spare', 'single_multi', 'sp_1', 'sp_2', 'sp_3', 'sp_4', 'sp_5', 'note', 'drawing_no', 'account_name_vendor', 'account_name_maker');
	    var $order_part_list = array('part_no' => 'asc');

	    var $table_part_list_file_dwg = 'view_jom_part_list_file_dwg';
	    var $column_order_part_list_file_dwg = array(null, 'part_name', 'rev', 'note', 'create_by', 'create_date');
	    var $column_search_part_list_file_dwg = array('part_name', 'rev', 'note', 'create_by', 'create_date');
	    var $order_part_list_file_dwg = array('create_date' => 'desc');

	    var $table_part_list_po = 'view_jom_part_list';
	    var $column_order_part_list_po = array(null, 'JobNo', 'part_no', 'part_name', 'account_name_vendor');
	    var $column_search_part_list_po = array('JobNo', 'part_no', 'part_name', 'account_name_vendor');
	    var $order_part_list_po = array('JobNo' => 'asc');

	    var $table_material = 'view_jom_material';
	    var $column_order_material = array(null, 'material_cd', 'material_name');
	    var $column_search_material = array('material_cd', 'material_name');
	    var $order_material = array('material_name' => 'asc');

	    var $table_part_list_status = 'view_jom_part_list_status';
	    var $column_order_part_list_status = array(null, 'part_list_status_cd', 'part_list_status_name');
	    var $column_search_part_list_status = array('part_list_status_cd', 'part_list_status_name');
	    var $order_part_list_status = array('part_list_status_name' => 'asc');

	    var $table_inventory = 'view_inv_inventory';
	    var $column_order_inventory = array(null, 'inventory_cd', 'inventory_name');
	    var $column_search_inventory = array('inventory_cd', 'inventory_name');
	    var $order_inventory = array('inventory_name' => 'asc');

	    var $table_job_order = 'view_jom_job_order';
	    var $column_order_job_order = array(null, 'JobNo', 'JobName');
	    var $column_search_job_order = array('JobNo', 'JobName');
	    var $order_job_order = array('JobName' => 'asc');

		public function list_job_type($company_id, $id_job_type){
			if ($id_job_type=='0') {
				$query=$this->db->select('*')
					->from('view_jom_job_type')
					->where('company_id', $company_id)
					->order_by('id_job_type', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_job_type')
					->where('company_id', $company_id)
					->where('id_job_type', $id_job_type)
					->get();
			}
			
			return $query->result();
		}

		public function list_job_task($company_id, $id_job_task){
			if ($id_job_task=='0') {
				$query=$this->db->select('*')
					->from('view_jom_job_task')
					->where('company_id', $company_id)
					->order_by('id_job_task', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_job_task')
					->where('company_id', $company_id)
					->where('id_job_task', $id_job_task)
					->get();
			}
			
			return $query->result();
		}

		public function list_job_task_sub($company_id, $id_job_task_sub){
			if ($id_job_task_sub=='0') {
				$query=$this->db->select('*')
					->from('view_jom_job_task_sub')
					->where('company_id', $company_id)
					->order_by('id_job_task_sub', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_job_task_sub')
					->where('company_id', $company_id)
					->where('id_job_task_sub', $id_job_task_sub)
					->get();
			}
			
			return $query->result();
		}

		public function list_country($company_id, $id_country){
			if ($id_country=='0') {
				$query=$this->db->select('*')
					->from('view_jom_country')
					->where('company_id', $company_id)
					->order_by('country_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_country')
					->where('company_id', $company_id)
					->where('id_country', $id_country)
					->get();
			}
			
			return $query->result();
		}

		public function list_tax($company_id, $id_tax){
			if ($id_tax=='0') {
				$query=$this->db->select('*')
					->from('view_jom_tax')
					->where('company_id', $company_id)
					->order_by('tax_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_tax')
					->where('company_id', $company_id)
					->where('id_tax', $id_tax)
					->get();
			}
			
			return $query->result();
		}

		public function list_tax_by_tax_cd($company_id, $tax_cd){
			if ($tax_cd=='0') {
				$query=$this->db->select('*')
					->from('view_jom_tax')
					->where('company_id', $company_id)
					->order_by('tax_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_tax')
					->where('company_id', $company_id)
					->where('tax_cd', $tax_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_material($company_id, $id_material){
			if ($id_material=='0') {
				$query=$this->db->select('*')
					->from('view_jom_material')
					->where('company_id', $company_id)
					->order_by('material_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_material')
					->where('company_id', $company_id)
					->where('id_material', $id_material)
					->get();
			}
			
			return $query->result();
		}

		public function list_material_by_material_cd($company_id, $material_cd){
			if ($material_cd=='0') {
				$query=$this->db->select('*')
					->from('view_jom_material')
					->where('company_id', $company_id)
					->order_by('material_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_material')
					->where('company_id', $company_id)
					->where('material_cd', $material_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_material_by_material_name($company_id, $material_name){
			if ($material_name=='0') {
				$query=$this->db->select('*')
					->from('view_jom_material')
					->where('company_id', $company_id)
					->order_by('material_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_material')
					->where('company_id', $company_id)
					->where('material_name', $material_name)
					->get();
			}
			
			return $query->result();
		}

		public function list_part_list_status($company_id, $id_part_list_status){
			if ($id_part_list_status=='0') {
				$query=$this->db->select('*')
					->from('view_jom_part_list_status')
					->where('company_id', $company_id)
					->order_by('part_list_status_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_part_list_status')
					->where('company_id', $company_id)
					->where('id_part_list_status', $id_part_list_status)
					->get();
			}
			
			return $query->result();
		}

			// Material Datatable

			private function _get_list_part_list_status_datatable($company_id){

				$this->db->from($this->table_part_list_status);
				$i = 0;

				foreach ($this->column_search_part_list_status as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_part_list_status) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->order_by($this->column_order_part_list_status[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_part_list_status)) {
					$order = $this->order_part_list_status;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_part_list_status_datatable($company_id) {
				$this->_get_list_part_list_status_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_part_list_status_count_filtered($company_id) {
				$this->_get_list_part_list_status_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_part_list_status_count_all($company_id){
				$this->db->from($this->table_part_list_status);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

		public function list_part_list_status_by_part_list_status_cd($company_id, $part_list_status_cd){
			if ($part_list_status_cd=='0') {
				$query=$this->db->select('*')
					->from('view_jom_part_list_status')
					->where('company_id', $company_id)
					->order_by('part_list_status_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_part_list_status')
					->where('company_id', $company_id)
					->where('part_list_status_cd', $part_list_status_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_part_list_status_by_part_list_status_name($company_id, $part_list_status_name){
			if ($part_list_status_name=='0') {
				$query=$this->db->select('*')
					->from('view_jom_part_list_status')
					->where('company_id', $company_id)
					->order_by('part_list_status_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_part_list_status')
					->where('company_id', $company_id)
					->where('part_list_status_name', $part_list_status_name)
					->get();
			}
			
			return $query->result();
		}

		public function list_sub_tax($company_id, $id_sub_tax){
			if ($id_sub_tax=='0') {
				$query=$this->db->select('*')
					->from('view_jom_sub_tax')
					->where('company_id', $company_id)
					->order_by('sub_tax_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_sub_tax')
					->where('company_id', $company_id)
					->where('id_sub_tax', $id_sub_tax)
					->get();
			}
			
			return $query->result();
		}

		public function list_sub_tax_by_sub_tax_cd($company_id, $sub_tax_cd){
			if ($sub_tax_cd=='0') {
				$query=$this->db->select('*')
					->from('view_jom_sub_tax')
					->where('company_id', $company_id)
					->order_by('sub_tax_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_sub_tax')
					->where('company_id', $company_id)
					->where('sub_tax_cd', $sub_tax_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_permission_type($company_id, $id_permission){
			if ($id_permission=='0') {
				$query=$this->db->select('*')
					->from('view_jom_permission')
					->where('company_id', $company_id)
					->order_by('id_permission', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_permission')
					->where('company_id', $company_id)
					->where('id_permission', $id_permission)
					->get();
			}
			
			return $query->result();
		}

		public function list_permission_type_by_permission_cd($company_id, $permission_cd){
			if ($permission_cd=='0') {
				$query=$this->db->select('*')
					->from('view_jom_permission')
					->where('company_id', $company_id)
					->order_by('permission_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_permission')
					->where('company_id', $company_id)
					->where('permission_cd', $permission_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_permission_employee($company_id, $id_permission, $id_permission_employee){
			if ($id_permission_employee=='0') {
				$query=$this->db->select('*')
					->from('view_jom_permission_employee')
					->where('company_id', $company_id)
					->where('id_permission', $id_permission)
					->order_by('cNmPegawai_permission', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_permission_employee')
					->where('company_id', $company_id)
					->where('id_permission', $id_permission)
					->where('id_permission_employee', $id_permission_employee)
					->get();
			}
			
			return $query->result();
		}

		public function list_permission_employee_for_menu($company_id, $id_permission, $id_permission_employee){
			if ($id_permission_employee=='0') {
				$query=$this->db->select('*')
					->from('view_jom_permission_employee')
					->where('company_id', $company_id)
					->order_by('id_permission_employee', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_permission_employee')
					->where('company_id', $company_id)
					->where('id_permission_employee', $id_permission_employee)
					->get();
			}
			
			return $query->result();
		}

		public function list_permission_special($company_id, $id_permission_special){
			if ($id_permission_special=='0') {
				$query=$this->db->select('*')
					->from('view_jom_permission_special')
					->where('company_id', $company_id)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_permission_special')
					->where('company_id', $company_id)
					->where('id_permission_special', $id_permission_special)
					->get();
			}
			
			return $query->result();
		}

		public function list_permission_special_by_employee_id($company_id, $cNIK){
			if ($cNIK=='0') {
				$query=$this->db->select('*')
					->from('view_jom_permission_special')
					->where('company_id', $company_id)
					->order_by('cNmPegawai', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_permission_special')
					->where('company_id', $company_id)
					->where('cNIK', $cNIK)
					->get();
			}
			
			return $query->result();
		}


		// Input

		public function list_account($company_id, $category, $id_account){
			if ($id_account=='0') {
				$query=$this->db->select('*')
					->from('view_jom_account')
					->where('company_id', $company_id)
					->where('cv', $category)
					->order_by('account_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_account')
					->where('company_id', $company_id)
					->where('cv', $category)
					->where('id_account', $id_account)
					->get();
			}
			
			return $query->result();
		}

		public function list_account_password_by_id_account($company_id, $id_account){
			$query=$this->db->select('*')
				->from('jom_account_password')
				->where('company_id', $company_id)
				->where('id_account', $id_account)
				->get();
			
			return $query->result();
		}

			// Account Datatable

			private function _get_list_account_datatable($company_id, $category, $customer_id){

				$this->db->from($this->table_account);
				$i = 0;

				foreach ($this->column_search_account as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_account) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('cv', $category);
					//$this->db->where('deleted', '0');
					$this->db->order_by($this->column_order_account[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_account)) {
					$order = $this->order_account;
					$this->db->where('company_id', $company_id);
					$this->db->where('cv', $category);
					//$this->db->where('deleted', '0');
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_account_datatable($company_id, $category, $customer_id) {
				$this->_get_list_account_datatable($company_id, $category, $customer_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_account_count_filtered($company_id, $category, $customer_id) {
				$this->_get_list_account_datatable($company_id, $category, $customer_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_account_count_all($company_id, $category, $customer_id){
				$this->db->from($this->table_account);
				$this->db->where('company_id', $company_id);
				$this->db->where('cv', $category);
				$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

		public function list_account_imo($company_id, $JobNo){
			if ($JobNo=='0') {
				$query=$this->db->select('id_account_vendor, account_cd_vendor, account_name_vendor, JobNo')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->group_by('id_account_vendor, account_cd_vendor, account_name_vendor, JobNo')
					->order_by('account_name_vendor', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('id_account_vendor, account_cd_vendor, account_name_vendor, JobNo')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->where('JobNo', $JobNo)
					->group_by('id_account_vendor, account_cd_vendor, account_name_vendor, JobNo')
					->order_by('account_name_vendor', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_part_list($company_id, $id_part_list){
			if ($id_part_list=='0') {
				$query=$this->db->select('*')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->order_by('part_no', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->where('id_part_list', $id_part_list)
					->get();
			}
			
			return $query->result();
		}

		public function list_part_list_detail($company_id, $id_part_list){
			if ($id_part_list=='0') {
				$query=$this->db->select('*')
					->from('view_jom_part_list_detail')
					->where('company_id', $company_id)
					->order_by('part_no', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_part_list_detail')
					->where('company_id', $company_id)
					->where('id_part_list', $id_part_list)
					->get();
			}
			
			return $query->result();
		}

		public function list_part_list_by_account_imo($company_id, $JobNo, $id_account_vendor){
			$query=$this->db->select('*')
				->from('view_jom_part_list')
				->where('company_id', $company_id)
				->where('JobNo', $JobNo)
				->where('id_account_vendor', $id_account_vendor)
				->where('id_material_order_line', null)
				->order_by('part_no', 'asc')
				->get();
			
			return $query->result();
		}

		public function list_part_list_by_part_no($company_id, $part_no, $JobNo){
			if ($part_no=='0') {
				$query=$this->db->select('*')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->order_by('part_list_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->where('part_no', $part_no)
					->where('JobNo', $JobNo)
					->get();
			}
			
			return $query->result();
		}

		public function list_part_list_by_part_no_add($company_id, $part_no_get, $JobNo){
			$part_no_exp = explode('-', $part_no_get);
			if (count($part_no_exp)>=1) {
				$part_no = $part_no_exp[0];
			}
			else {
				$part_no = $part_no_get;
			}

			if ($part_no=='0') {
				$query=$this->db->select('*')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->where('JobNo', $JobNo)
					->order_by('part_list_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_part_list')
					->where('company_id', $company_id)
					->where('left(part_no, 4)=', $part_no)
					->where('JobNo', $JobNo)
					->get();
			}
			
			return $query->result();
		}

		public function list_file_dwg($company_id, $id_part_list, $category){
			$query=$this->db->select('*')
				->from('view_jom_part_list_file_dwg')
				->where('company_id', $company_id)
				->where('id_part_list', $id_part_list)
				->where('category', $category)
				->get();
			
			return $query->result();
		}

			// Part List Datatable

			private function _get_list_part_list_datatable($company_id, $JobNo){

				$this->db->from($this->table_part_list);
				$i = 0;

				foreach ($this->column_search_part_list as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_part_list) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('JobNo', $JobNo);
					$this->db->where('deleted', '0');
					$this->db->order_by($this->column_order_part_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_part_list)) {
					$order = $this->order_part_list;
					$this->db->where('company_id', $company_id);
					$this->db->where('JobNo', $JobNo);
					$this->db->where('deleted', '0');
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_part_list_datatable($company_id, $JobNo) {
				$this->_get_list_part_list_datatable($company_id, $JobNo);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_part_list_count_filtered($company_id, $JobNo) {
				$this->_get_list_part_list_datatable($company_id, $JobNo);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_part_list_count_all($company_id, $JobNo){
				$this->db->from($this->table_part_list);
				$this->db->where('company_id', $company_id);
				$this->db->where('JobNo', $JobNo);
				$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

			// Part List Datatable

			private function _get_list_part_list_file_dwg_datatable($company_id, $id_part_list){

				$this->db->from($this->table_part_list_file_dwg);
				$i = 0;

				foreach ($this->column_search_part_list_file_dwg as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_part_list_file_dwg) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_part_list', $id_part_list);
					$this->db->where('deleted', '0');
					$this->db->order_by($this->column_order_part_list_file_dwg[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_part_list_file_dwg)) {
					$order = $this->order_part_list_file_dwg;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_part_list', $id_part_list);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_part_list_file_dwg_datatable($company_id, $id_part_list) {
				$this->_get_list_part_list_file_dwg_datatable($company_id, $id_part_list);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_part_list_file_dwg_count_filtered($company_id, $id_part_list) {
				$this->_get_list_part_list_file_dwg_datatable($company_id, $id_part_list);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_part_list_file_dwg_count_all($company_id, $id_part_list){
				$this->db->from($this->table_part_list);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_part_list', $id_part_list);
				return $this->db->count_all_results();
			}

			// Part List BOM Datatable

			private function _get_list_part_list_bom_datatable($company_id, $JobNo){

				$this->db->from($this->table_part_list);
				$i = 0;

				foreach ($this->column_search_part_list as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_part_list) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					if ($JobNo==0) {
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by($this->column_order_part_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
					}
					else {
						if ($JobNo != 0) {
							$this->db->where('JobNo', $JobNo);
						}
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by($this->column_order_part_list[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
					}
				} 
				else if(isset($this->order_part_list)) {
					if ($JobNo==0) {
						$order = $this->order_part_list;
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by(key($order), $order[key($order)]);
					}
					else {
						$order = $this->order_part_list;
						if ($JobNo != 0) {
							$this->db->where('JobNo', $JobNo);
						}
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by(key($order), $order[key($order)]);
					}
				}
			}

			function list_part_list_bom_datatable($company_id, $JobNo) {
				$this->_get_list_part_list_bom_datatable($company_id, $JobNo);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_part_list_bom_count_filtered($company_id, $JobNo) {
				$this->_get_list_part_list_bom_datatable($company_id, $JobNo);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_part_list_bom_count_all($company_id, $JobNo){
				$this->db->from($this->table_part_list);
				$this->db->where('company_id', $company_id);
				if ($JobNo != 0) {
					$this->db->where('JobNo', $JobNo);
				}
				$this->db->where('id_rto is not null');
				$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

			// Part List BOM PO Datatable

			private function _get_list_part_list_bom_po_datatable($company_id, $id_account){

				$this->db->from($this->table_part_list_po);
				$i = 0;

				foreach ($this->column_search_part_list_po as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_part_list_po) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					if ($id_account==0) {
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by($this->column_order_part_list_po[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
					}
					else {
						if ($id_account != 0) {
							$this->db->where('id_account_vendor', $id_account);
						}
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by($this->column_order_part_list_po[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
					}
				} 
				else if(isset($this->order_part_list_po)) {
					if ($id_account==0) {
						$order = $this->order_part_list_po;
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by(key($order), $order[key($order)]);
					}
					else {
						$order = $this->order_part_list_po;
						if ($id_account != 0) {
							$this->db->where('id_account_vendor', $id_account);
						}
						$this->db->where('company_id', $company_id);
						$this->db->where('id_rto is not null');
						$this->db->where('deleted', '0');
						$this->db->order_by(key($order), $order[key($order)]);
					}
				}
			}

			function list_part_list_bom_po_datatable($company_id, $id_account) {
				$this->_get_list_part_list_bom_po_datatable($company_id, $id_account);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_part_list_bom_po_count_filtered($company_id, $id_account) {
				$this->_get_list_part_list_bom_po_datatable($company_id, $id_account);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_part_list_bom_po_count_all($company_id, $id_account){
				$this->db->from($this->table_part_list_po);
				$this->db->where('company_id', $company_id);
				if ($id_account != 0) {
					$this->db->where('id_account_vendor', $id_account);
				}
				$this->db->where('id_rto is not null');
				$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

			// Inventory Datatable

			private function _get_list_inventory_datatable($company_id){

				$this->db->from($this->table_inventory);
				$i = 0;

				foreach ($this->column_search_inventory as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_inventory) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->order_by($this->column_order_inventory[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_inventory)) {
					$order = $this->order_inventory;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_inventory_datatable($company_id) {
				$this->_get_list_inventory_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_inventory_count_filtered($company_id) {
				$this->_get_list_inventory_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_inventory_count_all($company_id){
				$this->db->from($this->table_inventory);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			// Material Datatable

			private function _get_list_material_datatable($company_id){

				$this->db->from($this->table_material);
				$i = 0;

				foreach ($this->column_search_material as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_material) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->order_by($this->column_order_material[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_material)) {
					$order = $this->order_material;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_material_datatable($company_id) {
				$this->_get_list_material_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_material_count_filtered($company_id) {
				$this->_get_list_material_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_material_count_all($company_id){
				$this->db->from($this->table_material);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

		public function list_account_by_account_cd($company_id, $category, $account_cd){
			if ($account_cd=='0') {
				$query=$this->db->select('*')
					->from('view_jom_account')
					->where('company_id', $company_id)
					->where('cv', $category)
					->order_by('account_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_account')
					->where('company_id', $company_id)
					->where('cv', $category)
					->where('account_cd', $account_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_account_by_account_name($company_id, $category, $account_name){
			if ($account_name=='0') {
				$query=$this->db->select('*')
					->from('view_jom_account')
					->where('company_id', $company_id)
					->where('cv', $category)
					->order_by('account_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_account')
					->where('company_id', $company_id)
					->where('cv', $category)
					->where('account_name', $account_name)
					->get();
			}
			
			return $query->result();
		}

		public function list_job_number($company_id, $id_account, $id_job_type){
			if ($id_account=='0') {
				$query=$this->db->select('*')
					->from('view_jom_job_number')
					->where('company_id', $company_id)
					->order_by('id_account', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_job_number')
					->where('company_id', $company_id)
					->where('id_account', $id_account)
					->where('id_job_type', $id_job_type)
					->get();
			}
			
			return $query->result();
		}

		public function list_employee_by_dept($company_id, $cIDDept){
			$query=$this->db->select('*')
				->from('view_personal_data')
				->where('company_id', $company_id)
				->where('cIDDept', $cIDDept)
				->order_by('cIDJbtn', 'asc')
				->order_by('cNmPegawai', 'asc')
				->get();
			
			return $query->result();
		}

		public function list_employee_by_cNmPegawai($company_id, $cNmPegawai){
			$query=$this->db->select('*')
				->from('view_personal_data')
				->where('company_id', $company_id)
				->where('cNmPegawai', $cNmPegawai)
				->get();
			
			return $query->result();
		}

			// employee Datatable

			private function _get_list_employee_datatable(){

				$this->db->from($this->table_employee);
				$i = 0;

				foreach ($this->column_search_employee as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_employee) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->order_by($this->column_order_employee[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_employee)) {
					$order = $this->order_employee;
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_employee_datatable() {
				$this->_get_list_employee_datatable();
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_employee_count_filtered() {
				$this->_get_list_employee_datatable();
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_employee_count_all(){
				$this->db->from($this->table_employee);
				return $this->db->count_all_results();
			}

		public function list_job_order_by_jobno($company_id, $JobNo){
			/*if ($JobNo==0 || $JobNo=='0') {
				$query=$this->db->select('*')
					->from('view_jom_job_order')
					->where('company_id', $company_id)
					->get();
			}
			else {*/
				$query=$this->db->select('*')
					->from('view_jom_job_order')
					->where('company_id', $company_id)
					->where('JobNo', $JobNo)
					->get();

			//}
			
			return $query->result();
		}

		public function list_job_order_by_id_job_order($company_id, $id_job_order){
			$query=$this->db->select('*')
				->from('view_jom_job_order')
				->where('company_id', $company_id)
				->where('id_job_order', $id_job_order)
				->get();
			
			return $query->result();
		}

		public function list_job_order($company_id, $id_account, $id_job_type){
			if ($id_job_type==0) {
				$query=$this->db->select('*')
					->from('view_jom_job_order')
					->where('company_id', $company_id)
					->where('id_account', $id_account)
					->order_by('JobNo', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_job_order')
					->where('company_id', $company_id)
					->where('id_account', $id_account)
					->where('id_job_type', $id_job_type)
					->order_by('JobNo', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_job_order_open($company_id){
			$query=$this->db->select('*')
				->from('view_jom_job_order')
				->where('company_id', $company_id)
				->where('DeliveryDateAct', null)
				->order_by('JobNo', 'asc')
				->get();
			
			return $query->result();
		}

			// Part List Datatable

			private function _get_list_job_order_datatable($company_id){

				$this->db->from($this->table_job_order);
				$i = 0;

				foreach ($this->column_search_job_order as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_job_order) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					//$this->db->where('deleted', '0');
					$this->db->order_by($this->column_order_job_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_job_order)) {
					$order = $this->order_job_order;
					$this->db->where('company_id', $company_id);
					//$this->db->where('deleted', '0');
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_job_order_datatable($company_id) {
				$this->_get_list_job_order_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_job_order_datatable_count_filtered($company_id) {
				$this->_get_list_job_order_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_job_order_datatable_count_all($company_id){
				$this->db->from($this->table_job_order);
				$this->db->where('company_id', $company_id);
				//$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

		public function list_after_trial_by_id_job_order($company_id, $id_job_order){
			$query=$this->db->select('*')
				->from('jom_job_order_after_trial')
				->where('company_id', $company_id)
				->where('id_job_order', $id_job_order)
				->get();
			
			return $query->result();
		}

		public function list_after_trial_by_id_job_order_open($company_id, $id_job_order){
			$query=$this->db->select('*')
				->from('jom_job_order_after_trial')
				->where('company_id', $company_id)
				->where('id_job_order', $id_job_order)
				->where('DeliveryDateAct', null)
				->get();
			
			return $query->result();
		}

		public function list_after_trial_by_jobno($company_id, $JobNo){
			$query=$this->db->select('*')
				->from('view_jom_job_order_after_trial')
				->where('company_id', $company_id)
				->where('JobNo', $JobNo)
				->get();
			
			return $query->result();
		}

		public function list_imo($company_id, $JobNo, $id_material_order){
			if ($id_material_order==0) {
				$query=$this->db->select('*')
					->from('view_jom_imo')
					->where('company_id', $company_id)
					->where('JobNo', $JobNo)
					->order_by('JobNo', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_jom_imo')
					->where('company_id', $company_id)
					->where('JobNo', $JobNo)
					->where('id_material_order', $id_material_order)
					->order_by('JobNo', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_imo_detail($company_id, $material_order_number){
			$query=$this->db->select('*')
				->from('view_jom_imo_line')
				->where('company_id', $company_id)
				->where('material_order_number', $material_order_number)
				->order_by('id_material_order_line', 'asc')
				->get();
			return $query->result();
		}

		public function list_imo_by_account($company_id, $JobNo, $id_account_vendor){
			$query=$this->db->select('*')
				->from('view_jom_imo')
				->where('company_id', $company_id)
				->where('JobNo', $JobNo)
				->where('id_account_vendor', $id_account_vendor)
				->get();
			
			return $query->result();
		}

	}

?>