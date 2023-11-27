<?php 

	class M_distributionread extends CI_Model{

		// aldo
		// Setting

		var $table_employee = 'view_personal_data';
	    var $column_order_employee = array(null, 'cNIK','cNmPegawai');
	    var $column_search_employee = array('cNIK','cNmPegawai');
	    var $order_employee = array('cNmPegawai' => 'asc');

	    var $table_approval_permission = 'view_dis_approval_permission';
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

	    // ===================================================

	    var $table_purchase_order_select = 'view_dis_purchase_order';
	    var $column_order_purchase_order_select = array(null, 'purchase_order_number','account_name', 'purchase_order_date', 'total_amount');
	    var $column_search_purchase_order_select = array('purchase_order_number','account_name', 'purchase_order_date', 'total_amount');
	    var $order_purchase_order_select = array('purchase_order_number' => 'desc');

	    var $table_purchase_receipt_select = 'view_dis_purchase_receipt';
	    var $column_order_purchase_receipt_select = array(null, 'purchase_receipt_number','account_name', 'purchase_receipt_date', 'total_amount');
	    var $column_search_purchase_receipt_select = array('purchase_receipt_number','account_name', 'purchase_receipt_date', 'total_amount');
	    var $order_purchase_receipt_select = array('purchase_receipt_number' => 'desc');

	    var $table_purchase_receipt_line = 'view_dis_purchase_receipt_line_for_kit_assy';
	    var $column_order_purchase_receipt_line = array(null, 'purchase_receipt_number','description', 'purchase_receipt_line_qty', 'uom_cd', 'unit_price', 'amount');
	    var $column_search_purchase_receipt_line = array('purchase_receipt_number','description', 'purchase_receipt_line_qty', 'uom_cd', 'unit_price', 'amount');
	    var $order_purchase_receipt_line = array('purchase_receipt_number' => 'desc');

		var $table_purchase_receipt_line_by_vendor = 'view_dis_purchase_receipt_line';
	    var $column_order_purchase_receipt_line_by_vendor = array(null, 'purchase_receipt_number','description', 'purchase_receipt_line_qty', 'uom_cd', 'unit_price', 'amount', 'purchase_receipt_date', 'description', 'purchase_receipt_line_qty', 'uom_cd', 'cury_unit_price', 'cury_amount', 'id_purchase_receipt_line');
	    var $column_search_purchase_receipt_line_by_vendor = array('purchase_receipt_number','description', 'purchase_receipt_line_qty', 'uom_cd', 'unit_price', 'amount', 'purchase_receipt_date', 'description', 'purchase_receipt_line_qty', 'uom_cd', 'cury_unit_price', 'cury_amount', 'id_purchase_receipt_line');
	    var $order_purchase_receipt_line_by_vendor = array('purchase_receipt_number' => 'desc');

	    var $table_purchase_invoice_select = 'view_dis_purchase_invoice';
	    var $column_invoice_purchase_invoice_select = array(null, 'purchase_invoice_number','account_name', 'purchase_invoice_date', 'total_amount');
	    var $column_search_purchase_invoice_select = array('purchase_invoice_number','account_name', 'purchase_invoice_date', 'total_amount');
	    var $order_purchase_invoice_select = array('purchase_invoice_number' => 'desc');

	    var $table_job_order_select = 'view_jom_job_order';
	    var $column_invoice_job_order_select = array(null, 'JobNo', 'JobName', 'PODate', 'POCustomerNumber', 'Qty', 'Amount');
	    var $column_search_job_order_select = array('JobNo', 'JobName', 'PODate', 'POCustomerNumber', 'Qty', 'Amount');
	    var $order_job_order_select = array('JobNo' => 'desc');

	    var $table_sales_order_select = 'view_dis_sales_order';
	    var $column_order_sales_order_select = array(null, 'sales_order_number','account_name', 'sales_order_date', 'total_amount');
	    var $column_search_sales_order_select = array('sales_order_number','account_name', 'sales_order_date', 'total_amount');
	    var $order_sales_order_select = array('sales_order_number' => 'desc');

	    var $table_sales_order_line = 'view_dis_sales_order_line';
	    var $column_order_sales_order_line = array(null, 'sales_order_number','account_name', 'qty_order_line', 'qty_shipment_line', 'qty_open_line', 'uom_cd', 'unit_price', 'sub_amount', 'discount_amount', 'discount_percent', 'amount', 'sub_tax_cd');
	    var $column_search_sales_order_line = array('sales_order_number','account_name', 'qty_order_line', 'qty_shipment_line', 'qty_open_line', 'uom_cd', 'unit_price', 'sub_amount', 'discount_amount', 'discount_percent', 'amount', 'sub_tax_cd');
	    var $order_sales_order_line = array('sales_order_number' => 'desc');

	    var $table_delivery_order_select = 'view_dis_delivery_order';
	    var $column_order_delivery_order_select = array(null, 'delivery_order_number','account_name', 'delivery_order_date', 'total_amount');
	    var $column_search_delivery_order_select = array('delivery_order_number','account_name', 'delivery_order_date', 'total_amount');
	    var $order_delivery_order_select = array('delivery_order_number' => 'desc');

	    var $table_delivery_order_line_select = 'view_dis_delivery_order_line';
	    var $column_order_delivery_order_line_select = array(null, 'delivery_order_number','account_name', 'qty_order_line', 'qty_shipment_line', 'qty_open_line', 'uom_cd', 'unit_price', 'sub_amount', 'discount_amount', 'discount_percent', 'amount', 'sub_tax_cd');
	    var $column_search_delivery_order_line_select = array('delivery_order_number','account_name', 'qty_order_line', 'qty_shipment_line', 'qty_open_line', 'uom_cd', 'unit_price', 'sub_amount', 'discount_amount', 'discount_percent', 'amount', 'sub_tax_cd');
	    var $order_delivery_order_line_select = array('delivery_order_number' => 'desc');

	    var $table_sales_invoice_select = 'view_dis_sales_invoice';
	    var $column_order_sales_invoice_select = array(null, 'sales_invoice_number','account_name', 'customer_order_number', 'sales_invoice_date', 'total_amount');
	    var $column_search_sales_invoice_select = array('sales_invoice_number','account_name', 'customer_order_number', 'sales_invoice_date', 'total_amount');
	    var $order_sales_invoice_select = array('sales_invoice_number' => 'desc');

	    var $table_sales_invoice_line = 'view_dis_sales_invoice_line';
	    var $column_order_sales_invoice_line = array(null, 'sales_invoice_number','account_name', 'qty_order_line', 'qty_shipment_line', 'qty_open_line', 'uom_cd', 'unit_price', 'sub_amount', 'discount_amount', 'discount_percent', 'amount', 'sub_tax_cd');
	    var $column_search_sales_invoice_line = array('sales_invoice_number','account_name', 'qty_order_line', 'qty_shipment_line', 'qty_open_line', 'uom_cd', 'unit_price', 'sub_amount', 'discount_amount', 'discount_percent', 'amount', 'sub_tax_cd');
	    var $order_sales_invoice_line = array('sales_invoice_number' => 'desc');

	   	var $table_purchase_requisitions_select = 'view_dis_purchase_requisitions';
	    var $column_requisitions_purchase_requisitions_select = array(null, 'purchase_requisitions_number','account_name', 'purchase_requisitions_date', 'total_amount');
	    var $column_search_purchase_requisitions_select = array('purchase_requisitions_number','account_name', 'purchase_requisitions_date', 'total_amount');
	    var $order_purchase_requisitions_select = array('purchase_requisitions_number' => 'desc');

		public function list_module_category($company_id, $id_module_category){
			if ($id_module_category=='0') {
				$query=$this->db->select('*')
					->from('view_dis_module_category')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_module_category')
					->where('company_id', $company_id)
					->where('id_module_category', $id_module_category)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_category_by_module_category_cd($company_id, $module_category_cd){
			if ($module_category_cd=='0') {
				$query=$this->db->select('*')
					->from('view_dis_module_category')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_module_category')
					->where('company_id', $company_id)
					->where('module_category_cd', $module_category_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_module($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_category_by_module_category_id($company_id, $id_module_category){
			if ($id_module_category=='0') {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->order_by('module_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->where('id_module_category', $id_module_category)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_by_module_cd($company_id, $module_cd){
			if ($module_cd=='0') {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->order_by('module_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->where('module_cd', $module_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_module_by_module_file_name($company_id, $file_name){
			if ($file_name=='0') {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->order_by('file_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_module')
					->where('company_id', $company_id)
					->where('file_name', $file_name)
					->get();
			}
			
			return $query->result();
		}

		public function list_numbering_sequence($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_dis_numbering_sequences')
					->where('company_id', $company_id)
					->order_by('numbering_sequence_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_numbering_sequences')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_employee_permission($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_dis_employee_permission')
					->where('company_id', $company_id)
					//->order_by('employee_permission_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_employee_permission')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

		public function list_employee_permission_by_cnik($company_id, $id_module, $cNIK){
			$query=$this->db->select('*')
				->from('view_dis_employee_permission')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('cNIK', $cNIK)
				->get();
			
			return $query->result();
		}

		public function list_approval_permission($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_dis_approval_permission')
					->where('company_id', $company_id)
					//->order_by('approval_permission_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_approval_permission')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->get();
			}
			
			return $query->result();
		}

			// Item Class

			private function _get_list_approval_permission_datatable($company_id, $id_module){

				$this->db->from($this->table_approval_permission);
				$i = 0;

				foreach ($this->column_search_approval_permission as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_approval_permission) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_module', $id_module);
					$this->db->order_by($this->column_order_approval_permission[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_approval_permission)) {
					$order = $this->order_approval_permission;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_module', $id_module);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_approval_permission_datatable($company_id, $id_module) {
				$this->_get_list_approval_permission_datatable($company_id, $id_module);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_approval_permission_count_filtered($company_id, $id_module) {
				$this->_get_list_approval_permission_datatable($company_id, $id_module);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_approval_permission_count_all($company_id, $id_module){
				$this->db->from($this->table_approval_permission);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_module', $id_module);
				return $this->db->count_all_results();
			}

		public function list_approval_permission_by_cnik($company_id, $id_module, $cNIK){
			$query=$this->db->select('*')
				->from('view_dis_approval_permission')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('cNIK', $cNIK)
				->get();
			
			return $query->result();
		}

		public function list_transaction_role($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_dis_transaction_role')
					->where('company_id', $company_id)
					->order_by('sequence', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_transaction_role')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->order_by('sequence', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_transaction_role_by_sequence($company_id, $id_module, $sequence){
			$query=$this->db->select('*')
				->from('view_dis_transaction_role')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('sequence', $sequence)
				->order_by('sequence', 'asc')
				->get();
			
			return $query->result();
		}

		public function list_transaction_role_by_id_transaction_role($company_id, $id_module, $id_transaction_role){

			$query=$this->db->select('*')
				->from('view_dis_transaction_role')
				->where('company_id', $company_id)
				->where('id_module', $id_module)
				->where('id_transaction_role', $id_transaction_role)
				->order_by('id_transaction_role', 'asc')
				->get();
			
			return $query->result();
		}

		public function list_transaction_role_after_hold($company_id, $id_module){
			if ($id_module=='0') {
				$query=$this->db->select('*')
					->from('view_dis_transaction_role')
					->where('company_id', $company_id)
					->order_by('id_transaction_role', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_transaction_role')
					->where('company_id', $company_id)
					->where('id_module', $id_module)
					->order_by('id_transaction_role', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_payment_methode($company_id, $id_payment_methode){
			if ($id_payment_methode=='0') {
				$query=$this->db->select('*')
					->from('view_dis_payment_methode')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_payment_methode')
					->where('company_id', $company_id)
					->where('id_payment_methode', $id_payment_methode)
					->get();
			}
			
			return $query->result();
		}

		public function list_payment_methode_by_payment_methode_cd($company_id, $category, $payment_methode_cd){
			$query=$this->db->select('*')
				->from('view_dis_payment_methode')
				->where('company_id', $company_id)
				->where('category', $category)
				->where('payment_methode_cd', $payment_methode_cd)
				->get();
			return $query->result();
		}

		public function list_payment_terms($company_id, $id_payment_terms){
			if ($id_payment_terms=='0') {
				$query=$this->db->select('*')
					->from('view_dis_payment_terms')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_payment_terms')
					->where('company_id', $company_id)
					->where('id_payment_terms', $id_payment_terms)
					->get();
			}
			
			return $query->result();
		}

		public function list_payment_terms_by_payment_terms_cd($company_id, $payment_terms_cd){
			$query=$this->db->select('*')
				->from('view_dis_payment_terms')
				->where('company_id', $company_id)
				->where('payment_terms_cd', $payment_terms_cd)
				->get();
			return $query->result();
		}

		// Datatables Server Side Processing
			// Item Class

			private function _get_list_employee_datatable($company_id){

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
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_employee[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_employee)) {
					$order = $this->order_employee;
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_employee_datatable($company_id) {
				$this->_get_list_employee_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_employee_count_filtered($company_id) {
				$this->_get_list_employee_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_employee_count_all($company_id){
				$this->db->from($this->table_employee);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

		// Input

		// Purchase

		// Requisitions

		public function list_purchase_requisitions_line_by_purchase_requisitions_number($company_id, $purchase_requisitions_number){
			if ($purchase_requisitions_number=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_requisitions_line')
					->where('company_id', $company_id)
					->order_by('purchase_requisitions_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_requisitions_line')
					->where('company_id', $company_id)
					->where('purchase_requisitions_number', $purchase_requisitions_number)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_requisitions_by_year($company_id, $year){
			$query=$this->db->select('*')
				->from('dis_purchase_requisitions')
				->where('company_id', $company_id)
				->order_by('purchase_requisitions_number', 'asc')
				->get();
			return $query->result();
		}

		public function list_purchase_requisitions_by_purchase_requisitions_number($company_id, $purchase_requisitions_number){
			if ($purchase_requisitions_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_purchase_requisitions')
					->where('company_id', $company_id)
					->order_by('purchase_requisitions_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_purchase_requisitions')
					->where('company_id', $company_id)
					->where('purchase_requisitions_number', $purchase_requisitions_number)
					->get();
			}
			
			return $query->result();
		}

			private function _get_list_purchase_requisitions_datatable($company_id){

				$this->db->from($this->table_purchase_requisitions_select);
				$i = 0;

				foreach ($this->column_search_purchase_requisitions_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_requisitions_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_requisitions_purchase_requisitions_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_requisitions_select)) {
					$order = $this->order_purchase_requisitions_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_requisitions_datatable($company_id) {
				$this->_get_list_purchase_requisitions_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_requisitions_count_filtered($company_id) {
				$this->_get_list_purchase_requisitions_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_purchase_requisitions_count_all($company_id){
				$this->db->from($this->table_purchase_requisitions_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

		// PO 

		public function list_purchase_order_by_year($company_id, $year){
			if ($year=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_order')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_order')
					->where('company_id', $company_id)
					->where('year', $year)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_order_by_id_part_list($company_id, $id_part_list){
			if ($id_part_list=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_order_line')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_order_line')
					->where('company_id', $company_id)
					->where('id_part_list', $id_part_list)
					->get();
			}
			return $query->result();
		}

		public function list_purchase_order_by_purchase_order_number($company_id, $purchase_order_number){
			if ($purchase_order_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_purchase_order')
					->where('company_id', $company_id)
					->order_by('purchase_order_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_purchase_order')
					->where('company_id', $company_id)
					->where('purchase_order_number', $purchase_order_number)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_order_line_by_purchase_order_number($company_id, $purchase_order_number){
			if ($purchase_order_number=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_order_line')
					->where('company_id', $company_id)
					->order_by('purchase_order_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_order_line')
					->where('company_id', $company_id)
					->where('purchase_order_number', $purchase_order_number)
					//->where('purchase_order_line_qty!=purchase_order_line_qty_purchase_receipt')
					->get();
			}
			
			return $query->result();
		}	

		public function list_purchase_order_line($company_id, $id_purchase_order_line){
			if ($id_purchase_order_line=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_order_line')
					->where('company_id', $company_id)
					->order_by('id_purchase_order_line', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_order_line')
					->where('company_id', $company_id)
					->where('id_purchase_order_line', $id_purchase_order_line)
					//->where('purchase_order_line_qty!=purchase_order_line_qty_purchase_receipt')
					->get();
			}
			
			return $query->result();
		}	

			// Purchase Order

			private function _get_list_purchase_order_datatable($company_id){

				$this->db->from($this->table_purchase_order_select);
				$i = 0;

				foreach ($this->column_search_purchase_order_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_order_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_purchase_order_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_order_select)) {
					$order = $this->order_purchase_order_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_order_datatable($company_id) {
				$this->_get_list_purchase_order_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_order_count_filtered($company_id) {
				$this->_get_list_purchase_order_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_purchase_order_count_all($company_id){
				$this->db->from($this->table_purchase_order_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}	

			// Purchase Order by Date

			private function _get_list_purchase_order_by_date_datatable($company_id, $date_start, $date_end){

				$this->db->from($this->table_purchase_order_select);
				$i = 0;

				foreach ($this->column_search_purchase_order_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_order_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				$where_date = "purchase_order_date between '".$date_start."' and '".$date_end."'";

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->where($where_date);
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_purchase_order_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_order_select)) {
					$order = $this->order_purchase_order_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->where($where_date);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_order_by_date_datatable($company_id, $date_start, $date_end) {
				$this->_get_list_purchase_order_by_date_datatable($company_id, $date_start, $date_end);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_order_by_date_count_filtered($company_id, $date_start, $date_end) {
				$this->_get_list_purchase_order_by_date_datatable($company_id, $date_start, $date_end);
				$where_date = "purchase_order_date between '".$date_start."' and '".$date_end."'";
				$query = $this->db->where($where_date)
							->get();
				return $query->num_rows();
			}

			public function list_purchase_order_by_date_count_all($company_id, $date_start, $date_end){
				$where_date = "purchase_order_date between '".$date_start."' and '".$date_end."'";
				$this->db->from($this->table_purchase_order_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				$this->db->where($where_date);
				return $this->db->count_all_results();
			}

		public function list_purchase_receipt_by_id_purchase_order($company_id, $id_purchase_order){
			$query=$this->db->select('*')
				->from('view_dis_purchase_receipt')
				->where('company_id', $company_id)
				->where('id_purchase_order', $id_purchase_order)
				->get();
			
			return $query->result();
		}

		// PR

		public function sum_purchase_order_line_by_purchase_order_number($company_id, $purchase_order_number){

			$query=$this->db->select('*')
				->from('dis_purchase_order_line')
				->where('company_id', $company_id)
				->where('purchase_order_number', $purchase_order_number)
				->where('purchase_order_line_qty!=purchase_order_line_qty_purchase_receipt')
				->get();
			
			return $query->result();
		}

		public function purchase_receipt_line_qty_by_id_purchase_order_qty_line($company_id, $id_purchase_order_line){

			$query=$this->db->select('sum(purchase_receipt_line_qty) as purchase_receipt_line_qty')
				->from('dis_purchase_receipt_line')
				->where('company_id', $company_id)
				->where('deleted', 0)
				->where('id_purchase_order_line', $id_purchase_order_line)
				->get();
			
			return $query->result();
		}

		public function list_purchase_receipt_by_year($company_id, $year){
			if ($year=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_receipt')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_receipt')
					->where('company_id', $company_id)
					->where('year', $year)
					->get();
			}
			
			return $query->result();
		}

		public function sum_purchase_receipt_line_by_id_purchase_order_line($company_id, $id_purchase_order_line){

			$query=$this->db->select('sum (purchase_receipt_line_qty) as total_qty_receipt_line')
				->from('dis_purchase_receipt_line')
				->where('company_id', $company_id)
				->where('deleted', 0)
				->where('id_purchase_order_line', $id_purchase_order_line)
				->get();
			
			return $query->result();
		}

		public function sum_purchase_receipt_line_by_id_purchase_order($company_id, $id_purchase_order){

			$query=$this->db->select('sum (purchase_receipt_line_qty) as total_qty_receipt_line')
				->from('dis_purchase_receipt_line')
				->where('company_id', $company_id)
				->where('deleted', 0)
				->where('id_purchase_order', $id_purchase_order)
				->get();
			
			return $query->result();
		}

			// Purchase Receipt

			private function _get_list_purchase_receipt_datatable($company_id){

				$this->db->from($this->table_purchase_receipt_select);
				$i = 0;

				foreach ($this->column_search_purchase_receipt_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_receipt_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_purchase_receipt_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_receipt_select)) {
					$order = $this->order_purchase_receipt_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_receipt_datatable($company_id) {
				$this->_get_list_purchase_receipt_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_receipt_count_filtered($company_id) {
				$this->_get_list_purchase_receipt_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_purchase_receipt_count_all($company_id){
				$this->db->from($this->table_purchase_receipt_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

			// Purchase Receipt Line by Job No for Kit Assy

			private function _get_list_purchase_receipt_line_by_job_datatable($company_id, $JobNo){

				$this->db->from($this->table_purchase_receipt_line);
				$i = 0;

				foreach ($this->column_search_purchase_receipt_line as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_receipt_line) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('JobNo', $JobNo);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_purchase_receipt_line[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_receipt_line)) {
					$order = $this->order_purchase_receipt_line;
					$this->db->where('company_id', $company_id);
					$this->db->where('JobNo', $JobNo);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_receipt_line_by_job_datatable($company_id, $JobNo) {
				$this->_get_list_purchase_receipt_line_by_job_datatable($company_id, $JobNo);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_receipt_line_by_job_count_filtered($company_id, $JobNo) {
				$this->_get_list_purchase_receipt_line_by_job_datatable($company_id, $JobNo);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_purchase_receipt_line_by_job_count_all($company_id, $JobNo){
				$this->db->from($this->table_purchase_receipt_line);
				$this->db->where('company_id', $company_id);
				$this->db->where('JobNo', $JobNo);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

			// Purchase Receipt by Date

			private function _get_list_purchase_receipt_by_date_datatable($company_id, $date_start, $date_end){

				$this->db->from($this->table_purchase_receipt_select);
				$i = 0;

				foreach ($this->column_search_purchase_receipt_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_receipt_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				$where_date = "purchase_receipt_date between '".$date_start."' and '".$date_end."'";

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->where($where_date);
					$this->db->order_by($this->column_order_purchase_receipt_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				}
				else if(isset($this->order_purchase_receipt_select)) {
					$order = $this->order_purchase_receipt_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->where($where_date);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_receipt_by_date_datatable($company_id, $date_start, $date_end) {
				$this->_get_list_purchase_receipt_by_date_datatable($company_id, $date_start, $date_end);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_receipt_by_date_count_filtered($company_id, $date_start, $date_end) {
				$this->_get_list_purchase_receipt_by_date_datatable($company_id, $date_start, $date_end);
				$where_date = "purchase_receipt_date between '".$date_start."' and '".$date_end."'";
				$query = $this->db->where($where_date)
							->get();
				return $query->num_rows();
			}

			public function list_purchase_receipt_by_date_count_all($company_id, $date_start, $date_end){
				$where_date = "purchase_receipt_date between '".$date_start."' and '".$date_end."'";
				$this->db->from($this->table_purchase_receipt_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				$this->db->where($where_date);
				return $this->db->count_all_results();
			}

		public function list_purchase_receipt_by_purchase_receipt_number($company_id, $purchase_receipt_number){
			if ($purchase_receipt_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt')
					->where('company_id', $company_id)
					//->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt')
					->where('company_id', $company_id)
					->where('purchase_receipt_number', $purchase_receipt_number)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_receipt_line_by_purchase_receipt_number($company_id, $purchase_receipt_number){
			if ($purchase_receipt_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt_line')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt_line')
					->where('company_id', $company_id)
					->where('purchase_receipt_number', $purchase_receipt_number)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_receipt_line_by_id_purchase_receipt_line($company_id, $id_purchase_receipt_line){
			if ($id_purchase_receipt_line=='0') {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt_line')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt_line')
					->where('company_id', $company_id)
					->where('id_purchase_receipt_line', $id_purchase_receipt_line)
					->get();
			}
			
			return $query->result();
		}

		// PI

			// Purchase Receipt Line by Vendor

			private function _get_list_purchase_receipt_line_by_vendor_datatable($company_id, $id_account){

				$this->db->from($this->table_purchase_receipt_line_by_vendor);
				$i = 0;

				foreach ($this->column_search_purchase_receipt_line_by_vendor as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_receipt_line_by_vendor) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->where('sequence', 5);
					$this->db->where('deleted', 0);
					$this->db->where('line_status', 0);
					$this->db->order_by($this->column_order_purchase_receipt_line_by_vendor[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_receipt_line_by_vendor)) {
					$order = $this->order_purchase_receipt_line_by_vendor;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->where('sequence', 5);
					$this->db->where('deleted', 0);
					$this->db->where('line_status', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_receipt_line_by_vendor_datatable($company_id, $id_account) {
				$this->_get_list_purchase_receipt_line_by_vendor_datatable($company_id, $id_account);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_receipt_line_by_vendor_count_filtered($company_id, $id_account) {
				$this->_get_list_purchase_receipt_line_by_vendor_datatable($company_id, $id_account);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_purchase_receipt_line_by_vendor_count_all($company_id, $id_account){
				$this->db->from($this->table_purchase_receipt_line_by_vendor);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_account', $id_account);
				$this->db->where('sequence', 5);
				$this->db->where('deleted', 0);
				$this->db->where('line_status', 0);
				return $this->db->count_all_results();
			}

		public function list_purchase_receipt_by_purchase_receipt_line_id($company_id, $id_purchase_receipt_line){
			$query=$this->db->select('*')
				->from('view_dis_purchase_receipt_line')
				->where('company_id', $company_id)
				->where('id_purchase_receipt_line', $id_purchase_receipt_line)
				->get();
			
			return $query->result();
		}

		public function list_purchase_receipt_by_purchase_receipt_number_for_purchase_invoice($company_id, $purchase_receipt_number){
			$query=$this->db->select('*')
				->from('view_dis_purchase_receipt')
				->where('company_id', $company_id)
				->where('purchase_receipt_number', $purchase_receipt_number)
				->get();
			
			return $query->result();
		}

			// Purchase Invoice

			private function _get_list_purchase_invoice_datatable($company_id){

				$this->db->from($this->table_purchase_invoice_select);
				$i = 0;

				foreach ($this->column_search_purchase_invoice_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_invoice_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_purchase_invoice_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_invoice_select)) {
					$order = $this->order_purchase_invoice_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_invoice_datatable($company_id) {
				$this->_get_list_purchase_invoice_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_invoice_count_filtered($company_id) {
				$this->_get_list_purchase_invoice_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_purchase_invoice_count_all($company_id){
				$this->db->from($this->table_purchase_invoice_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

			// list id purchase receipt line on purchase receipt invoice line
			public function list_id_purchase_receipt_line_on_purchase_receipt_invoice_line($company_id, $purchase_invoice_number){
				$query=$this->db->select('id_purchase_receipt_line')
					->from('dis_purchase_invoice_line')
					->where('company_id', $company_id)
					->where('purchase_invoice_number', $purchase_invoice_number)
					->get();
				
				return $query->result();
			}

		public function list_po_by_pi($company_id, $purchase_invoice_number){
			$query=$this->db->select('purchase_order_number')
				->from('dis_purchase_invoice_line')
				->where('company_id', $company_id)
				->where('purchase_invoice_number', $purchase_invoice_number)
				->group_by('purchase_order_number')
				->get();
			
			return $query->result();
		}

		public function list_pr_by_pi($company_id, $purchase_invoice_number){
			$query=$this->db->select('purchase_receipt_number')
				->from('dis_purchase_invoice_line')
				->where('company_id', $company_id)
				->where('purchase_invoice_number', $purchase_invoice_number)
				->group_by('purchase_receipt_number')
				->get();
			
			return $query->result();
		}

			// Purchase Receipt by ID Account

			private function _get_list_purchase_receipt_by_id_account_datatable($company_id, $id_account){

				$this->db->from($this->table_purchase_receipt_select);
				$i = 0;

				foreach ($this->column_search_purchase_receipt_by_id_account_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_purchase_receipt_by_id_account_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->where('sequence', '5');
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_purchase_receipt_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_purchase_receipt_select)) {
					$order = $this->order_purchase_receipt_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->where('sequence', '5');
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_purchase_receipt_by_id_account_datatable($company_id, $id_account) {
				$this->_get_list_purchase_receipt_by_id_account_datatable($company_id, $id_account);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_purchase_receipt_by_id_account_count_filtered($company_id, $id_account) {
				$this->_get_list_purchase_receipt_by_id_account_datatable($company_id, $id_account);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_purchase_receipt_by_id_account_count_all($company_id, $id_account){
				$this->db->from($this->table_purchase_receipt_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_account', $id_account);
				$this->db->where('sequence', '5');
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

		public function list_purchase_invoice_by_year($company_id, $year){
			if ($year=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_invoice')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_invoice')
					->where('company_id', $company_id)
					->where('year', $year)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_receipt_line($company_id, $id_purchase_receipt_line){
			if ($id_purchase_receipt_line=='0') {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt_line')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_purchase_receipt_line')
					->where('company_id', $company_id)
					->where('id_purchase_receipt_line', $id_purchase_receipt_line)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_invoice_by_purchase_invoice_number($company_id, $purchase_invoice_number){
			if ($purchase_invoice_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_purchase_invoice')
					->where('company_id', $company_id)
					//->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_purchase_invoice')
					->where('company_id', $company_id)
					->where('purchase_invoice_number', $purchase_invoice_number)
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_invoice_line_by_purchase_invoice_number($company_id, $purchase_invoice_number){
			if ($purchase_invoice_number=='0') {
				$query=$this->db->select('*')
					->from('dis_purchase_invoice_line')
					->where('company_id', $company_id)
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_purchase_invoice_line')
					->where('company_id', $company_id)
					->where('purchase_invoice_number', $purchase_invoice_number)
					->order_by('line_number', 'asc')
					->get();
			}
			
			return $query->result();
		}

		public function list_purchase_invoice_line_tax_by_purchase_invoice_number($company_id, $purchase_invoice_number){
			$query=$this->db->select('sub_tax_percent_plus_coa, sub_tax_percent_plus_coa_cd, sub_tax_percent_plus_coa_name, sub_tax_percent_minus_coa, sub_tax_percent_minus_coa_cd, sub_tax_percent_minus_coa_name')
				->from('view_dis_purchase_invoice_line')
				->where('company_id', $company_id)
				->where('purchase_invoice_number', $purchase_invoice_number)
				->group_by('sub_tax_percent_plus_coa, sub_tax_percent_plus_coa_cd, sub_tax_percent_plus_coa_name, sub_tax_percent_minus_coa, sub_tax_percent_minus_coa_cd, sub_tax_percent_minus_coa_name')
				->get();
			return $query->result();
		}

		public function list_purchase_receipt_line_sum_by_id_inventory($company_id, $id_inventory){
			$query=$this->db->select('sum (purchase_receipt_line_qty) as id_inventory_sum')
				->from('dis_purchase_receipt_line')
				->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->get();
			
			return $query->result();
		}

		public function list_total_count_in_by_id_inventory($company_id, $id_inventory){
			$query=$this->db->select('*')
				->from('inv_total_count_in')
				->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->get();
			
			return $query->result();
		}

		public function list_total_count_in_line($company_id, $id_purchase_receipt_line){
			$query=$this->db->select('id_purchase_receipt_line')
				->from('inv_total_count_in_line')
				->where('company_id', $company_id)
				->where('id_purchase_receipt_line', $id_purchase_receipt_line)
				->get();
			
			return $query->result();
		}

	// Sales

	// SO

			private function _get_list_job_order_for_sales_order_datatable($company_id, $id_account){

				$this->db->from($this->table_job_order_select);
				$i = 0;

				foreach ($this->column_search_job_order_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_job_order_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->order_by($this->column_order_job_order_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_job_order_select)) {
					$order = $this->order_job_order_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_job_order_for_sales_order_datatable($company_id, $id_account) {
				$this->_get_list_job_order_for_sales_order_datatable($company_id, $id_account);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_job_order_for_sales_order_count_all($company_id, $id_account) {
				$this->_get_list_job_order_for_sales_order_datatable($company_id, $id_account);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_job_order_for_sales_order_count_filtered($company_id, $id_account){
				$this->db->from($this->table_job_order_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_account', $id_account);
				return $this->db->count_all_results();
			}

		public function list_sales_order_line_by_sales_order_number($company_id, $sales_order_number){
			if ($sales_order_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_sales_order_line')
					->where('company_id', $company_id)
					->order_by('sales_order_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_sales_order_line')
					->where('company_id', $company_id)
					->where('sales_order_number', $sales_order_number)
					//->where('sales_order_line_qty!=sales_order_line_qty_purchase_receipt')
					->get();
			}
			
			return $query->result();
		}

		public function list_sales_order_line($company_id, $id_sales_order_line){
			if ($id_sales_order_line=='0') {
				$query=$this->db->select('*')
					->from('view_dis_sales_order_line')
					->where('company_id', $company_id)
					->order_by('id_sales_order_line', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_sales_order_line')
					->where('company_id', $company_id)
					->where('id_sales_order_line', $id_sales_order_line)
					->get();
			}
			
			return $query->result();
		}

		public function list_sales_order_by_year($company_id, $year){
			if ($year=='0') {
				$query=$this->db->select('*')
					->from('dis_sales_order')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_sales_order')
					->where('company_id', $company_id)
					->where('year', $year)
					->get();
			}
			
			return $query->result();
		}

			// Sales Order

			private function _get_list_sales_order_datatable($company_id){

				$this->db->from($this->table_sales_order_select);
				$i = 0;

				foreach ($this->column_search_sales_order_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_sales_order_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_sales_order_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_sales_order_select)) {
					$order = $this->order_sales_order_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_sales_order_datatable($company_id) {
				$this->_get_list_sales_order_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_sales_order_count_filtered($company_id) {
				$this->_get_list_sales_order_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_sales_order_count_all($company_id){
				$this->db->from($this->table_sales_order_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

			// Sales Order Line

			private function _get_list_sales_order_line_datatable($company_id, $id_account, $id_account_project){

				$this->db->from($this->table_sales_order_line);
				$i = 0;

				foreach ($this->column_search_sales_order_line as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_sales_order_line) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->where('id_account_project', $id_account_project);
					$this->db->order_by($this->column_order_sales_order_line[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_sales_order_line)) {
					$order = $this->order_sales_order_line;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->where('id_account_project', $id_account_project);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_sales_order_line_datatable($company_id, $id_account, $id_account_project) {
				$this->_get_list_sales_order_line_datatable($company_id, $id_account, $id_account_project);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_sales_order_line_count_filtered($company_id, $id_account, $id_account_project) {
				$this->_get_list_sales_order_line_datatable($company_id, $id_account, $id_account_project);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_sales_order_line_count_all($company_id, $id_account, $id_account_project){
				$this->db->from($this->table_sales_order_line);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_account', $id_account);
				$this->db->where('id_account_project', $id_account_project);
				return $this->db->count_all_results();
			}

		public function list_sales_order_by_sales_order_number($company_id, $sales_order_number){
			if ($sales_order_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_sales_order')
					->where('company_id', $company_id)
					->order_by('sales_order_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_sales_order')
					->where('company_id', $company_id)
					->where('sales_order_number', $sales_order_number)
					->get();
			}
			
			return $query->result();
		}

	// DO

		public function list_delivery_order_by_year($company_id, $year){
			if ($year=='0') {
				$query=$this->db->select('*')
					->from('dis_delivery_order')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_delivery_order')
					->where('company_id', $company_id)
					->where('year', $year)
					->get();
			}
			
			return $query->result();
		}

		public function list_delivery_order_by_delivery_order_number($company_id, $delivery_order_number){
			if ($delivery_order_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_delivery_order')
					->where('company_id', $company_id)
					->order_by('delivery_order_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_delivery_order')
					->where('company_id', $company_id)
					->where('delivery_order_number', $delivery_order_number)
					->get();
			}
			
			return $query->result();
		}

		public function last_delivery_order_line($company_id, $id_sales_order_line){

			$query=$this->db->select('id_delivery_order_line')
				->from('dis_delivery_order_line')
				->where('company_id', $company_id)
				->where('id_sales_order_line', $id_sales_order_line)
				->get();
			
			return $query->result();
		}

		public function list_delivery_order_line_total_qty_shipment($company_id, $sales_order_number){

			$query=$this->db->select('sum(qty_shipment_line) as total_qty')
				->from('view_dis_delivery_order_line')
				->where('company_id', $company_id)
				->where('sales_order_number', $sales_order_number)
				->get();
			
			return $query->result();
		}

		public function list_delivery_order_line_by_delivery_order_number($company_id, $delivery_order_number){
			if ($delivery_order_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_delivery_order_line')
					->where('company_id', $company_id)
					->order_by('delivery_order_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_delivery_order_line')
					->where('company_id', $company_id)
					->where('delivery_order_number', $delivery_order_number)
					//->where('sales_order_line_qty!=sales_order_line_qty_purchase_receipt')
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

			// delivery Order Line

			private function _get_list_delivery_order_line_datatable($company_id, $id_account){

				$this->db->from($this->table_delivery_order_line_select);
				$i = 0;

				foreach ($this->column_search_delivery_order_line_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_delivery_order_line_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->order_by($this->column_order_delivery_order_line_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_delivery_order_line_select)) {
					$order = $this->order_delivery_order_line_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('id_account', $id_account);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_delivery_order_line_datatable($company_id, $id_account) {
				$this->_get_list_delivery_order_line_datatable($company_id, $id_account);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_delivery_order_line_count_filtered($company_id, $id_account) {
				$this->_get_list_delivery_order_line_datatable($company_id, $id_account);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_delivery_order_line_count_all($company_id, $id_account){
				$this->db->from($this->table_delivery_order_line_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('id_account', $id_account);
				return $this->db->count_all_results();
			}

		public function list_delivery_order_line($company_id, $id_delivery_order_line){
			if ($id_delivery_order_line=='0') {
				$query=$this->db->select('*')
					->from('view_dis_delivery_order_line')
					->where('company_id', $company_id)
					->order_by('id_delivery_order_line', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_delivery_order_line')
					->where('company_id', $company_id)
					->where('id_delivery_order_line', $id_delivery_order_line)
					->get();
			}
			
			return $query->result();
		}

	// SI

		public function list_sales_invoice_by_year($company_id, $year){
			if ($year=='0') {
				$query=$this->db->select('*')
					->from('dis_sales_invoice')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('dis_sales_invoice')
					->where('company_id', $company_id)
					->where('year', $year)
					->get();
			}
			
			return $query->result();
		}

		public function list_total_qty_invoice_line_by_id_delivery_order_line($company_id, $id_delivery_order_line){
			$query=$this->db->select('sum(qty_invoice_line) as total_qty_invoice_by_id_delivery_order_line')
				->from('dis_sales_invoice_line')
				->where('company_id', $company_id)
				->where('id_delivery_order_line', $id_delivery_order_line)
				->get();

			return $query->result();
		}

		public function list_total_qty_invoice_line_by_delivery_order_number($company_id, $delivery_order_number){
			$query=$this->db->select('sum(qty_invoice_line) as total_qty_invoice_by_delivery_order_number')
				->from('view_dis_sales_invoice_line')
				->where('company_id', $company_id)
				->where('delivery_order_number', $delivery_order_number)
				->get();

			return $query->result();
		}

			// Sales Invoice

			private function _get_list_sales_invoice_datatable($company_id){

				$this->db->from($this->table_sales_invoice_select);
				$i = 0;

				foreach ($this->column_search_sales_invoice_select as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_sales_invoice_select) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by($this->column_order_sales_invoice_select[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_sales_invoice_select)) {
					$order = $this->order_sales_invoice_select;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', 0);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_sales_invoice_datatable($company_id) {
				$this->_get_list_sales_invoice_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_sales_invoice_count_filtered($company_id) {
				$this->_get_list_sales_invoice_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_sales_invoice_count_all($company_id){
				$this->db->from($this->table_sales_invoice_select);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', 0);
				return $this->db->count_all_results();
			}

		public function list_sales_invoice_by_sales_invoice_number($company_id, $sales_invoice_number){
			if ($sales_invoice_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_sales_invoice')
					->where('company_id', $company_id)
					->order_by('sales_invoice_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_sales_invoice')
					->where('company_id', $company_id)
					->where('sales_invoice_number', $sales_invoice_number)
					->get();
			}
			
			return $query->result();
		}

		public function list_sales_invoice_line_by_sales_invoice_number($company_id, $sales_invoice_number){
			if ($sales_invoice_number=='0') {
				$query=$this->db->select('*')
					->from('view_dis_sales_invoice_line')
					->where('company_id', $company_id)
					->order_by('sales_invoice_number', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_dis_sales_invoice_line')
					->where('company_id', $company_id)
					->where('sales_invoice_number', $sales_invoice_number)
					->get();
			}
			
			return $query->result();
		}

	}

?>