<?php 

	class M_financeread extends CI_Model{

		// aldo
		// Setting

		var $table_employee = 'view_personal_data';
	    var $column_order_employee = array(null, 'cNIK','cNmPegawai');
	    var $column_search_employee = array('cNIK','cNmPegawai');
	    var $order_employee = array('cNmPegawai' => 'asc');

	    var $table_approval_permission = 'view_fin_approval_permission';
	    var $column_order_approval_permission = array(null, 'cNIK', 'cNmPegawai');
	    var $column_search_approval_permission = array('cNIK', 'cNmPegawai');
	    var $order_approval_permission = array('cNmPegawai' => 'asc');

	    // ======================================================================

	    var $table_tax = 'view_jom_sub_tax';
	    var $column_order_tax = array(null, 'sub_tax_cd','sub_tax_name');
	    var $column_search_tax = array('sub_tax_cd', 'sub_tax_name');
	    var $order_tax = array('sub_tax_name' => 'asc');

	    var $table_uom = 'view_inv_uom';
	    var $column_order_uom = array(null, 'uom_cd','uom_name');
	    var $column_search_uom = array('uom_cd', 'uom_name');
	    var $order_uom = array('uom_name' => 'asc');

	    var $table_coa = 'view_coa';
	    var $column_order_coa = array(null, 'coa_cd','coa_name', 'coa_classes_name', 'coa_type_name', 'coa_currency_name');
	    var $column_search_coa = array('coa_cd', 'coa_name', 'coa_classes_name', 'coa_type_name', 'coa_currency_name');
	    var $order_coa = array('coa_name' => 'asc');
	    
	    var $table_inventory = 'view_inv_inventory';
	    var $column_order_inventory = array(null, 'inventory_cd', 'inventory_name', 'item_class_cd', 'item_class_name', 'sub_tax_cd', 'sub_tax_name', 'uom_cd', 'uom_name', 'cNmDept');
	    var $column_search_inventory = array('inventory_cd', 'inventory_name', 'item_class_cd', 'item_class_name', 'sub_tax_cd', 'sub_tax_name', 'uom_cd', 'uom_name', 'cNmDept');
	    var $order_inventory = array('inventory_name' => 'asc');

	    // =========================================================================

	    var $table_transaction_select = 'view_fin_transaction';
	    var $column_order_transaction_select = array(null, 'transaction_number','account_name', 'transaction_periode');
	    var $column_search_transaction_select = array('transaction_number','account_name', 'transaction_periode');
	    var $order_transaction_select = array('transaction_number' => 'desc');

	    var $table_transaction_line = 'view_fin_transaction_distribution';
	    var $column_order_transaction_line = array(null, 'distribution_number','vendor_invoice_number');
	    var $column_search_transaction_line = array('distribution_number','vendor_invoice_number');
	    var $order_transaction_line = array('distribution_number' => 'desc');

		public function list_module_category($company_id, $id_module_category){
			if ($id_module_category=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module_category')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module_category')
					->where('company_id', $company_id)
					->where('id_module_category', $id_module_category)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_category_menu($company_id, $id_module_category){
			if ($id_module_category=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module_category')
					->where('company_id', $company_id)
					->where('deleted', 0)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module_category')
					->where('company_id', $company_id)
					->where('deleted', 0)
					->where('id_module_category', $id_module_category)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_category_by_module_category_cd($company_id, $module_category_cd){
			if ($module_category_cd=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module_category')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module_category')
					->where('company_id', $company_id)
					->where('module_category_cd', $module_category_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_module($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_menu($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->where('deleted', 0)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->where('deleted', 0)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_category_by_module_category_id($company_id, $id_module_category){
			if ($id_module_category=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->where('id_module_category', $id_module_category)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_by_module_cd($company_id, $module_cd){
			if ($module_cd=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->order_by('module_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->where('module_cd', $module_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_by_module_file_name($company_id, $file_name){
			if ($file_name=='0') {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->order_by('file_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_module')
					->where('company_id', $company_id)
					->where('file_name', $file_name)
					->get();
			}
			
			return $query->result();
		}

		public function list_numbering_sequence($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_fin_numbering_sequences')
					->where('company_id', $company_id)
					->order_by('numbering_sequence_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_numbering_sequences')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_header_numbering($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_fin_header_numbering')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_header_numbering')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_transaction_by_year($company_id, $id_module, $year){
			$query=$this->db->select('*')
				->from('fin_transaction')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('year(transaction_periode)', $year)
				->get();

			return $query->result();
		}

		public function list_transaction_by_account_periode($company_id, $id_module, $id_account, $id_coa_currency, $periode_purchase_invoice){
			$query=$this->db->select('*')
				->from('fin_transaction')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('id_coa_currency', $id_coa_currency)
				->where('transaction_periode', $periode_purchase_invoice)
				->get();

			return $query->result();
		}

		// ================================== EMPLOYEE PERMISSION ======================

		public function list_employee_permission($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_fin_employee_permission')
					->where('company_id', $company_id)
					//->order_by('employee_permission_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_employee_permission')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_employee_permission_by_cnik($company_id, $id_module, $cNIK){
			$query=$this->db->select('*')
				->from('view_fin_employee_permission')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('cNIK', $cNIK)
				->get();
			
			return $query->result();
		}

		// ================================== BALANCE ==================================

		public function balance_by_periode($company_id, $id_cash_account, $transaction_periode){
			$query=$this->db->select('*')
				->from('fin_balance')
				->where('company_id', $company_id)
				->where('id_cash_account', $id_cash_account)
				->where('transaction_periode', $transaction_periode)
				->get();
					
			return $query->num_rows();
		}

		public function list_balance($company_id, $transaction_periode, $id_cash_account){
			if ($id_cash_account==0) {
				$query=$this->db->select('*')
					->from('view_fin_balance')
					->where('company_id', $company_id)
					->where('transaction_periode', $transaction_periode)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_fin_balance')
					->where('company_id', $company_id)
					->where('transaction_periode', $transaction_periode)
					->where('id_cash_account', $id_cash_account)
					->get();
			}
					
			return $query->result();
		}

		// ================================== END EMPLOYEE PERMISSION ==================

		// ================================== INPUT ====================================

		public function count_fin_transaction($company_id, $id_module, $transaction_periode){
			$query=$this->db->select('id_transaction')
				->from('fin_transaction')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('transaction_periode', $transaction_periode)
				->get();
					
			return $query->num_rows();
		}

		public function list_transaction_by_transaction_number($company_id, $transaction_number, $transaction_periode){
			$query=$this->db->select('id_transaction')
				->from('fin_transaction')
				->where('company_id', $company_id)
				->where('transaction_number', $transaction_number)
				->where('transaction_periode', $transaction_periode)
				->get();
					
			return $query->num_rows();
		}

		public function list_transaction_by_transaction_number_header($company_id, $transaction_number){
			$query=$this->db->select('*')
				->from('fin_transaction')
				->where('company_id', $company_id)
				->where('transaction_number', $transaction_number)
				->get();
					
			return $query->result();
		}

		// ================================== CASH MANAGEMENT ==========================
		// ================================== PETTY CASH ===============================

			public function transaction_resume($company_id, $id_module, $transaction_periode){
				$query=$this->db->select(' company_id, id_module, transaction_periode, total_debet, total_credit')
					->from('view_fin_transaction_resume')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->where('transaction_periode', $transaction_periode)
					->get();
						
				return $query->result();
			}

			public function list_transaction_line($company_id, $id_module, $id_cash_account, $transaction_periode, $id_transaction_line){
				if ($id_transaction_line==0) {
					$query=$this->db->select('*')
						->from('view_fin_transaction_line')
						->where('company_id', $company_id)
						->where('id_module', $id_module)
						->where('id_cash_account', $id_cash_account)
						->where('transaction_periode', $transaction_periode)
						->where('deleted', '0')
						->order_by('transaction_number, transaction_date, id_transaction_line', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_fin_transaction_line')
						->where('company_id', $company_id)
						->where('id_module', $id_module)
						->where('id_cash_account', $id_cash_account)
						->where('transaction_periode', $transaction_periode)
						->where('id_transaction_line', $id_transaction_line)
						->where('deleted', '0')
						->order_by('transaction_number, transaction_date, id_transaction_line', 'asc')
						->get();
				}	
				return $query->result();
			}

		// ================================== END PETTY CASH ===========================

			
		// ================================== Account Payable ==========================
		// ================================== Vendor Payment ===========================

			// ================================== Header ===========================

			private function _get_list_transaction_select_datatable($company_id, $id_module){

				$this->db->from($this->table_transaction_select);
				$i = 0;

				foreach ($this->column_search_transaction_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_transaction_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_module', $id_module);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_transaction_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_transaction_select)) {
					$order = $this->order_transaction_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_module', $id_module);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_transaction_select_datatable($company_id, $id_module) {
				$this->_get_list_transaction_select_datatable($company_id, $id_module);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_transaction_select_count_filtered($company_id, $id_module) {
				$this->_get_list_transaction_select_datatable($company_id, $id_module);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_transaction_select_count_all($company_id, $id_module){
				$this->db->from($this->table_transaction_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_module', $id_module);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}
			
			// ================================== Line ===========================

			private function _get_list_transaction_line_datatable($company_id, $transaction_number){

				$this->db->from($this->table_transaction_line);
				$i = 0;

				foreach ($this->column_search_transaction_line as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_transaction_line) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('transaction_number', $transaction_number);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_transaction_line[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_transaction_line)) {
					$order = $this->order_transaction_line;
					$this->db->where('company_id', $company_id);
					$this->db->where('transaction_number', $transaction_number);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_transaction_line_datatable($company_id, $transaction_number) {
				$this->_get_list_transaction_line_datatable($company_id, $transaction_number);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_transaction_line_count_filtered($company_id, $transaction_number) {
				$this->_get_list_transaction_line_datatable($company_id, $transaction_number);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_transaction_line_count_all($company_id, $transaction_number){
				$this->db->from($this->table_transaction_line);
				$this->db->where('company_id', $company_id);
				$this->db->where('transaction_number', $transaction_number);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}	

			// ================================== Line by periode ===========================

			private function _get_list_transaction_line_periode_datatable($company_id, $transaction_periode){

				$this->db->from($this->table_transaction_line);
				$i = 0;

				foreach ($this->column_search_transaction_line as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_transaction_line) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('transaction_periode', $transaction_periode);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_transaction_line[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_transaction_line)) {
					$order = $this->order_transaction_line;
					$this->db->where('company_id', $company_id);
					$this->db->where('transaction_periode', $transaction_periode);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_transaction_line_periode_datatable($company_id, $transaction_periode) {
				$this->_get_list_transaction_line_periode_datatable($company_id, $transaction_periode);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_transaction_line_periode_count_filtered($company_id, $transaction_periode) {
				$this->_get_list_transaction_line_periode_datatable($company_id, $transaction_periode);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_transaction_line_periode_count_all($company_id, $transaction_periode){
				$this->db->from($this->table_transaction_line);
				$this->db->where('company_id', $company_id);
				$this->db->where('transaction_periode', $transaction_periode);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

		public function count_transaction_line($company_id, $transaction_number){
			$query = $this->db->select('transaction_number')
				->from('view_fin_transaction_distribution')
				->where('company_id', $company_id)
				->where('transaction_number', $transaction_number)
				->get();

			return $query->num_rows();
		}

		public function list_transaction_by_transaction_periode($company_id, $transaction_periode, $module_cd){
			$query = $this->db->select('*')
				->from('view_fin_transaction')
				->where('company_id', $company_id)
				->where('module_cd', $module_cd)
				->where('transaction_periode', $transaction_periode)
				->get();

			return $query->result();
		}

		public function list_transaction_distribution_by_id_transaction_distribution($company_id, $id_transaction_distribution){
			$query = $this->db->select('*')
				->from('view_fin_transaction_distribution')
				->where('company_id', $company_id)
				->where('id_transaction_distribution', $id_transaction_distribution)
				->get();

			return $query->result();
		}

		public function list_transaction_distribution_by_transaction_number($company_id, $transaction_number){
			$query = $this->db->select('*')
				->from('view_fin_transaction_distribution')
				->where('company_id', $company_id)
				->where('transaction_number', $transaction_number)
				->get();

			return $query->num_rows();
		}

		// ================================== Vendor Payment ===========================

	}

?>