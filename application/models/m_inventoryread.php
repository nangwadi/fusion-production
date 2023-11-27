<?php 

	class M_inventoryread extends CI_Model{

		// aldo
		// Setting

		var $table_item_class = 'view_inv_item_class';
	    var $column_order_item_class = array(null, 'item_class_cd','item_class_name','class_category_name', 'cNmDept');
	    var $column_search_item_class = array('item_class_cd','item_class_name','class_category_name', 'cNmDept');
	    var $order_item_class = array('item_class_name' => 'asc');

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

	    var $table_maker = 'view_inv_maker';
	    var $column_order_maker = array(null, 'maker_cd', 'maker_name');
	    var $column_search_maker = array('maker_cd', 'maker_name');
	    var $order_maker = array('maker_cd' => 'asc');

	    var $table_group = 'view_inv_group';
	    var $column_order_group = array(null, 'group_cd', 'group_name');
	    var $column_search_group = array('group_cd', 'group_name');
	    var $order_group = array('group_cd' => 'asc');
	    
	    var $table_inventory = 'view_inv_inventory';
	    var $column_order_inventory = array(null, 'inventory_cd', 'inventory_name', 'item_class_cd', 'total_count', 'sub_tax_cd', 'uom_cd', 'cNmDept');
	    var $column_search_inventory = array('inventory_cd', 'inventory_name', 'item_class_cd', 'total_count', 'sub_tax_cd', 'uom_cd', 'cNmDept');
	    var $order_inventory = array('total_count' => 'desc');

	    var $table_return = 'view_inv_return';
	    var $column_order_return = array(null, 'return_number', 'purchase_order_number', 'purchase_receipt_number', 'create_date', 'description', 'qty', 'uom_cd', 'unit_price', 'amount');
	    var $column_search_return = array('return_number', 'purchase_order_number', 'purchase_receipt_number', 'create_date', 'description', 'qty', 'uom_cd', 'unit_price', 'amount');
	    var $order_return = array('return_number' => 'desc');

	    var $table_kit_assy = 'view_inv_kit_assy';
	    var $column_order_kit_assy = array(null, 'kit_assy_number', 'JobNo', 'JobName', 'amount', 'cNmPegawai', 'last_update');
	    var $column_search_kit_assy = array('kit_assy_number', 'JobNo', 'JobName', 'amount', 'cNmPegawai', 'last_update');
	    var $order_kit_assy = array('kit_assy_number' => 'desc');

	    var $table_kit_assy_line = 'view_inv_kit_assy_line';
	    var $column_order_kit_assy_line = array(null, 'part_no', 'description', 'qty_used', 'uom_cd', 'unit_price', 'amount');
	    var $column_search_kit_assy_line = array('part_no', 'description', 'qty_used', 'uom_cd', 'unit_price', 'amount');
	    var $order_kit_assy_line = array('part_no' => 'asc');

	    var $table_inventory_return = 'view_inv_total_count_in_line';
	    var $column_order_inventory_return = array(null, 'purchase_receipt_number', 'description', 'qty_in', 'uom_cd', 'cury_unit_price', 'amount');
	    var $column_search_inventory_return = array('purchase_receipt_number', 'description', 'qty_in', 'uom_cd', 'cury_unit_price', 'amount');
	    var $order_inventory_return = array('purchase_receipt_number' => 'desc');

	    var $table_warehouse = 'view_inv_warehouse';
	    var $column_order_warehouse = array(null, 'warehouse_cd','warehouse_name', 'warehouse_classes_name', 'warehouse_type_name', 'warehouse_currency_name');
	    var $column_search_warehouse = array('warehouse_cd', 'warehouse_name', 'warehouse_classes_name', 'warehouse_type_name', 'warehouse_currency_name');
	    var $order_warehouse = array('warehouse_name' => 'asc');

	    var $table_stock_out = 'view_inv_stock_out';
	    var $column_order_stock_out = array(null, 'inventory_cd', 'inventory_name', 'JobNo', 'qty', 'uom_cd', 'unit_price', 'amount');
	    var $column_search_stock_out = array('inventory_cd', 'inventory_name', 'JobNo', 'qty', 'uom_cd', 'unit_price', 'amount');
	    var $order_stock_out = array('inventory_cd' => 'desc');

		public function list_uom($company_id, $id_uom){
			if ($id_uom=='0') {
				$query=$this->db->select('*')
					->from('view_inv_uom')
					->where('company_id', $company_id)
					->order_by('uom_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_uom')
					->where('company_id', $company_id)
					->where('id_uom', $id_uom)
					->get();
			}
			
			return $query->result();
		}

		public function list_uom_by_uom_cd($company_id, $uom_cd){
			if ($uom_cd=='0') {
				$query=$this->db->select('*')
					->from('view_inv_uom')
					->where('company_id', $company_id)
					->order_by('uom_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_uom')
					->where('company_id', $company_id)
					->where('uom_cd', $uom_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_class_category($company_id, $id_class_category){
			if ($id_class_category=='0') {
				$query=$this->db->select('*')
					->from('view_inv_class_category')
					->where('company_id', $company_id)
					->order_by('class_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_class_category')
					->where('company_id', $company_id)
					->where('id_class_category', $id_class_category)
					->get();
			}
			
			return $query->result();
		}

		public function list_class_category_by_class_category($company_id, $class_category_cd){
			if ($class_category_cd=='0') {
				$query=$this->db->select('*')
					->from('view_inv_class_category')
					->where('company_id', $company_id)
					->order_by('class_category_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_class_category')
					->where('company_id', $company_id)
					->where('class_category_cd', $class_category_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_warehouse($company_id, $id_warehouse){
			if ($id_warehouse=='0') {
				$query=$this->db->select('*')
					->from('view_inv_warehouse')
					->where('company_id', $company_id)
					->order_by('warehouse_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_warehouse')
					->where('company_id', $company_id)
					->where('id_warehouse', $id_warehouse)
					->get();
			}
			
			return $query->result();
		}

		public function list_warehouse_by_warehouse_cd($company_id, $warehouse_cd){
			if ($warehouse_cd=='0') {
				$query=$this->db->select('*')
					->from('view_inv_warehouse')
					->where('company_id', $company_id)
					->order_by('warehouse_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_warehouse')
					->where('company_id', $company_id)
					->where('warehouse_cd', $warehouse_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_warehouse_by_warehouse_name($company_id, $warehouse_name){
			if ($warehouse_code=='0') {
				$query=$this->db->select('*')
					->from('view_inv_warehouse')
					->where('company_id', $company_id)
					->order_by('warehouse_name', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_warehouse')
					->where('company_id', $company_id)
					->where('warehouse_name', $warehouse_name)
					->get();
			}
			
			return $query->result();
		}

		public function list_item_class($company_id, $id_item_class){
			if ($id_item_class=='0') {
				$query=$this->db->select('*')
					->from('view_inv_item_class')
					->where('company_id', $company_id)
					->order_by('item_class_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_item_class')
					->where('company_id', $company_id)
					->where('id_item_class', $id_item_class)
					->get();
			}
			
			return $query->result();
		}

		public function list_item_class_by_item_class_cd($company_id, $item_class_cd){
			if ($item_class_cd=='0') {
				$query=$this->db->select('*')
					->from('view_inv_item_class')
					->where('company_id', $company_id)
					->order_by('item_class_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_item_class')
					->where('company_id', $company_id)
					->where('item_class_cd', $item_class_cd)
					->get();
			}
			
			return $query->result();
		}

		// Input

		public function list_maker($company_id, $id_inv_maker){
			if ($id_inv_maker=='0') {
				$query=$this->db->select('*')
					->from('view_inv_maker')
					->where('company_id', $company_id)
					->order_by('maker_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_maker')
					->where('company_id', $company_id)
					->where('id_inv_maker', $id_inv_maker)
					->get();
			}
			
			return $query->result();
		}

		public function list_maker_by_maker_cd($company_id, $maker_cd){
			if ($maker_cd=='0') {
				$query=$this->db->select('*')
					->from('view_inv_maker')
					->where('company_id', $company_id)
					->order_by('maker_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_maker')
					->where('company_id', $company_id)
					->where('maker_cd', $maker_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_inventory($company_id, $id_inventory){
			if ($id_inventory=='0') {
				$query=$this->db->select('*')
					->from('view_inv_inventory')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_inventory')
					->where('company_id', $company_id)
					->where('id_inventory', $id_inventory)
					->get();
			}
			
			return $query->result();
		}

		public function list_inventory_img($company_id, $id_inventory){

			$query=$this->db->select('*')
				->from('inv_inventory_img')
				->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->order_by('id_inventory_img', 'asc')
				->get();
			
			return $query->result();
		}

		public function list_inventory_img_by_id($company_id, $id_inventory_img){

			$query=$this->db->select('*')
				->from('inv_inventory_img')
				->where('company_id', $company_id)
				->where('id_inventory_img', $id_inventory_img)
				->order_by('id_inventory_img', 'asc')
				->get();
			
			return $query->result();
		}

		public function list_inventory_img_banner($company_id, $id_inventory){

			$query=$this->db->select('*')
				->from('inv_inventory_img')
				->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->where('set_banner', 1)
				->order_by('id_inventory_img', 'asc')
				->get();
			
			return $query->result();
		}

		public function list_inventory_by_inventory_cd($company_id, $inventory_cd){
			if ($inventory_cd=='0') {
				$query=$this->db->select('*')
					->from('view_inv_inventory')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_inventory')
					->where('company_id', $company_id)
					->where('inventory_cd', $inventory_cd)
					->get();
			}
			
			return $query->result();
		}

		public function list_total_count_in_line_by_id_purchase_receipt_line($company_id, $id_purchase_receipt_line){
			if ($id_purchase_receipt_line=='0') {
				$query=$this->db->select('*')
					->from('inv_total_count_in_line')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('inv_total_count_in_line')
					->where('company_id', $company_id)
					->where('id_purchase_receipt_line', $id_purchase_receipt_line)
					->get();
			}
			
			return $query->result();
		}

		public function list_total_count_in_by_id_inventory($company_id, $id_inventory){
			if ($id_inventory=='0') {
				$query=$this->db->select('*')
					->from('inv_total_count_in')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('inv_total_count_in')
					->where('company_id', $company_id)
					->where('id_inventory', $id_inventory)
					->get();
			}
			
			return $query->result();
		}

		public function list_total_count_out_by_id_inventory($company_id, $id_inventory){
			if ($id_inventory=='0') {
				$query=$this->db->select('*')
					->from('inv_total_count_out')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('inv_total_count_out')
					->where('company_id', $company_id)
					->where('id_inventory', $id_inventory)
					->get();
			}
			
			return $query->result();
		}

		public function list_total_count_by_id_inventory($company_id, $id_inventory){
			if ($id_inventory=='0') {
				$query=$this->db->select('*')
					->from('inv_total_count')
					->where('company_id', $company_id)
					->order_by('inventory_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('inv_total_count')
					->where('company_id', $company_id)
					->where('id_inventory', $id_inventory)
					->get();
			}
			
			return $query->result();
		}

		public function list_return_by_year($company_id, $year){
			$query=$this->db->select('*')
				->from('inv_return')
				->where('company_id', $company_id)
				->where('year', $year)
				->get();
			return $query->result();
		}

		public function list_kit_assy_by_year($company_id, $year){
			$query=$this->db->select('*')
				->from('inv_kit_assy')
				->where('company_id', $company_id)
				->where('year(create_by)', $year)
				->get();
			return $query->result();
		}

		public function list_coa_by_coa_cd($company_id, $coa_cd){
			$query=$this->db->select('*')
				->from('view_coa')
				->where('company_id', $company_id)
				->where('coa_cd', $coa_cd)
				->get();
			return $query->result();
		}

		// Datatables Server Side Processing
			// Item Class

			private function _get_list_item_class_datatable($company_id){

				$this->db->from($this->table_item_class);
				$i = 0;

				foreach ($this->column_search_item_class as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_item_class) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_item_class[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_item_class)) {
					$order = $this->order_item_class;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_item_class_datatable($company_id) {
				$this->_get_list_item_class_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_item_class_count_filtered($company_id) {
				$this->_get_list_item_class_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_item_class_count_all($company_id){
				$this->db->from($this->table_item_class);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			// Tax

			private function _get_list_sub_tax_datatable($company_id){

				$this->db->from($this->table_tax);
				$i = 0;

				foreach ($this->column_search_tax as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_tax) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_tax[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_tax)) {
					$order = $this->order_tax;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_sub_tax_datatable($company_id) {
				$this->_get_list_sub_tax_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_sub_tax_count_filtered($company_id) {
				$this->_get_list_sub_tax_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_sub_tax_count_all($company_id){
				$this->db->from($this->table_tax);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			// UOM

			private function _get_list_uom_datatable($company_id){

				$this->db->from($this->table_uom);
				$i = 0;

				foreach ($this->column_search_uom as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_uom) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_uom[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_uom)) {
					$order = $this->order_uom;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_uom_datatable($company_id) {
				$this->_get_list_uom_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_uom_count_filtered($company_id) {
				$this->_get_list_uom_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_uom_count_all($company_id){
				$this->db->from($this->table_uom);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			// coa

			private function _get_list_coa_datatable($company_id){

				$this->db->from($this->table_coa);
				$i = 0;

				foreach ($this->column_search_coa as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_coa) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_coa[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_coa)) {
					$order = $this->order_coa;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_coa_datatable($company_id) {
				$this->_get_list_coa_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_coa_count_filtered($company_id) {
				$this->_get_list_coa_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_coa_count_all($company_id){
				$this->db->from($this->table_coa);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			// coa Income

			private function _get_list_coa_income_datatable($company_id){

				$this->db->from($this->table_coa);
				$i = 0;

				foreach ($this->column_search_coa as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_coa) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->where('coa_type_name', 'Income');
					$this->db->order_by($this->column_order_coa[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_coa)) {
					$order = $this->order_coa;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->where('coa_type_name', 'Income');
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_coa_income_datatable($company_id) {
				$this->_get_list_coa_income_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_coa_income_count_filtered($company_id) {
				$this->_get_list_coa_income_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_coa_income_count_all($company_id){
				$this->db->from($this->table_coa);
				$this->db->where('company_id', $company_id);
				$this->db->where('coa_type_name', 'Income');
				return $this->db->count_all_results();
			}

			// group

			private function _get_list_group_datatable($company_id){

				$this->db->from($this->table_group);
				$i = 0;

				foreach ($this->column_search_group as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_group) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					//$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_group[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_group)) {
					$order = $this->order_group;
					//$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_group_datatable($company_id) {
				$this->_get_list_group_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_group_count_filtered($company_id) {
				$this->_get_list_group_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_group_count_all($company_id){
				$this->db->from($this->table_group);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			public function list_group($company_id, $id_inv_group){
				if ($id_inv_group=='0') {
					$query=$this->db->select('*')
						->from('view_inv_group')
						->where('company_id', $company_id)
						->order_by('group_cd', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_inv_group')
						->where('company_id', $company_id)
						->where('id_inv_group', $id_inv_group)
						->get();
				}
				return $query->result();
			}

			public function list_group_by_group_cd($company_id, $group_cd){
				if ($group_cd=='0') {
					$query=$this->db->select('*')
						->from('view_inv_group')
						->where('company_id', $company_id)
						->order_by('group_cd', 'asc')
						->get();
				}
				else {
					$query=$this->db->select('*')
						->from('view_inv_group')
						->where('company_id', $company_id)
						->where('group_cd', $group_cd)
						->get();
				}
				
				return $query->result();
			}

			// maker

			private function _get_list_maker_datatable($company_id){

				$this->db->from($this->table_maker);
				$i = 0;

				foreach ($this->column_search_maker as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_maker) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_maker[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_maker)) {
					$order = $this->order_maker;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_maker_datatable($company_id) {
				$this->_get_list_maker_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_maker_count_filtered($company_id) {
				$this->_get_list_maker_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_maker_count_all($company_id){
				$this->db->from($this->table_maker);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			// inventory

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
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_inventory[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_inventory)) {
					$order = $this->order_inventory;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
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

			// inventory common stock

			private function _get_list_inventory_stock_datatable($company_id, $stock_name){

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
					$this->db->where('deleted', '0');
					$this->db->where($stock_name, '1');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_inventory[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_inventory)) {
					$order = $this->order_inventory;
					$this->db->where('deleted', '0');
					$this->db->where($stock_name, '1');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_inventory_stock_datatable($company_id, $stock_name) {
				$this->_get_list_inventory_stock_datatable($company_id, $stock_name);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_inventory_stock_count_filtered($company_id, $stock_name) {
				$this->_get_list_inventory_stock_datatable($company_id, $stock_name);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_inventory_stock_count_all($company_id, $stock_name){
				$this->db->from($this->table_inventory);
				$this->db->where('company_id', $company_id);
				$this->db->where($stock_name, '1');
				$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

			// Inventory Return

			private function _get_list_inventory_return_datatable($company_id){

				$this->db->from($this->table_inventory_return);
				$i = 0;

				foreach ($this->column_search_inventory_return as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_inventory_return) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->where('id_kit_assy_line', null);
					$this->db->order_by($this->column_order_inventory_return[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_inventory_return)) {
					$order = $this->order_inventory_return;
					$this->db->where('company_id', $company_id);
					$this->db->where('deleted', '0');
					$this->db->where('id_kit_assy_line', null);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_inventory_return_datatable($company_id) {
				$this->_get_list_inventory_return_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_inventory_return_count_filtered($company_id) {
				$this->_get_list_inventory_return_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_inventory_return_count_all($company_id){
				$this->db->from($this->table_inventory_return);
				$this->db->where('company_id', $company_id);
				$this->db->where('deleted', '0');
				$this->db->where('id_kit_assy_line', null);
				return $this->db->count_all_results();
			}

			// List Return

			private function _get_list_return_datatable($company_id){

				$this->db->from($this->table_return);
				$i = 0;

				foreach ($this->column_search_return as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_return) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_return[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_return)) {
					$order = $this->order_return;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_return_datatable($company_id) {
				$this->_get_list_return_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_return_count_filtered($company_id) {
				$this->_get_list_return_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_return_count_all($company_id){
				$this->db->from($this->table_return);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

			// List Kit Assy Line

			private function _get_list_kit_assy_line_by_jobno_datatable($company_id, $JobNo){

				$this->db->from($this->table_kit_assy_line);
				$i = 0;

				foreach ($this->column_search_kit_assy_line as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_kit_assy_line) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('JobNo', $JobNo);
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_kit_assy_line[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_kit_assy_line)) {
					$order = $this->order_kit_assy_line;
					$this->db->where('deleted', '0');
					$this->db->where('JobNo', $JobNo);
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_kit_assy_line_by_jobno_datatable($company_id, $JobNo) {
				$this->_get_list_kit_assy_line_by_jobno_datatable($company_id, $JobNo);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_kit_assy_line_by_jobno_count_all($company_id, $JobNo) {
				$this->_get_list_kit_assy_line_by_jobno_datatable($company_id, $JobNo);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_kit_assy_line_by_jobno_count_filtered($company_id, $JobNo){
				$this->db->from($this->table_kit_assy_line);
				$this->db->where('company_id', $company_id);
				$this->db->where('JobNo', $JobNo);
				$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

			// List Kit Assy

			private function _get_list_kit_assy_datatable($company_id){

				$this->db->from($this->table_kit_assy);
				$i = 0;

				foreach ($this->column_search_kit_assy as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_kit_assy) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_kit_assy[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_kit_assy)) {
					$order = $this->order_kit_assy;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_kit_assy_datatable($company_id) {
				$this->_get_list_kit_assy_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_kit_assy_count_filtered($company_id) {
				$this->_get_list_kit_assy_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_kit_assy_count_all($company_id){
				$this->db->from($this->table_kit_assy);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}
 
			// List Kit Assy By Job No

			private function _get_list_kit_assy_by_jobno_datatable($company_id, $JobNo){

				$this->db->from($this->table_kit_assy);
				$i = 0;

				foreach ($this->column_search_kit_assy as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_kit_assy) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->where('JobNo', $JobNo);
					$this->db->order_by($this->column_order_kit_assy[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_kit_assy)) {
					$order = $this->order_kit_assy;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->where('JobNo', $JobNo);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_kit_assy_by_jobno_datatable($company_id, $JobNo) {
				$this->_get_list_kit_assy_by_jobno_datatable($company_id, $JobNo);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_kit_assy_by_jobno_count_filtered($company_id, $JobNo) {
				$this->_get_list_kit_assy_by_jobno_datatable($company_id, $JobNo);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_kit_assy_by_jobno_count_all($company_id, $JobNo){
				$this->db->from($this->table_kit_assy);
				$this->db->where('company_id', $company_id);
				$this->db->where('JobNo', $JobNo);
				$this->db->where('deleted', '0');
				return $this->db->count_all_results();
			}

			// List Stock Out

			private function _get_list_stock_out_datatable($company_id, $category){

				$this->db->from($this->table_stock_out);
				$i = 0;

				foreach ($this->column_search_stock_out as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_stock_out) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('company_id', $company_id);
					$this->db->where('category', $category);
					$this->db->order_by($this->column_order_stock_out[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_stock_out)) {
					$order = $this->order_stock_out;
					$this->db->where('company_id', $company_id);
					$this->db->where('category', $category);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_stock_out_datatable($company_id, $category) {
				$this->_get_list_stock_out_datatable($company_id, $category);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_stock_out_count_filtered($company_id, $category) {
				$this->_get_list_stock_out_datatable($company_id, $category);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_stock_out_count_all($company_id, $category){
				$this->db->from($this->table_stock_out);
				$this->db->where('company_id', $company_id);
				$this->db->where('category', $category);
				return $this->db->count_all_results();
			}

			// warehouse

			private function _get_list_warehouse_datatable($company_id){

				$this->db->from($this->table_warehouse);
				$i = 0;

				foreach ($this->column_search_warehouse as $item) { // looping awal
					if ($_POST['search']['value']) { // jika datatable mengirimkan pencarian dengan metode POST
						if ($i===0) { // looping awal
							$this->db->group_start(); 
							$this->db->like($item, $_POST['search']['value']);
						}
						else {
							$this->db->or_like($item, $_POST['search']['value']);
						}
						if(count($this->column_search_warehouse) - 1 == $i) 
						$this->db->group_end();
					}
					$i++;
				}

				if(isset($_POST['order'])) {
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by($this->column_order_warehouse[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
				} 
				else if(isset($this->order_warehouse)) {
					$order = $this->order_warehouse;
					$this->db->where('deleted', '0');
					$this->db->where('company_id', $company_id);
					$this->db->order_by(key($order), $order[key($order)]);
				}
			}

			function list_warehouse_datatable($company_id) {
				$this->_get_list_warehouse_datatable($company_id);
				if($_POST['length'] != -1)
				$this->db->limit($_POST['length'], $_POST['start']);
				$query = $this->db->get();
				return $query->result();
			}

			function list_warehouse_count_filtered($company_id) {
				$this->_get_list_warehouse_datatable($company_id);
				$query = $this->db->get();
				return $query->num_rows();
			}

			public function list_warehouse_count_all($company_id){
				$this->db->from($this->table_warehouse);
				$this->db->where('company_id', $company_id);
				return $this->db->count_all_results();
			}

		public function list_kit_assy_by_jobno($company_id, $JobNo){
			$query=$this->db->select('*')
				->from('view_inv_kit_assy')
				->where('company_id', $company_id)
				->where('JobNo', $JobNo)
				->get();
			return $query->result();
		}

		public function list_kit_assy_by_job_amount_summary($company_id, $JobNo){
			$query=$this->db->select('item_class_cd, item_class_name, sum(amount) as total_amount')
				->from('view_inv_kit_assy_line')
				->where('company_id', $company_id)
				->where('JobNo', $JobNo)
				->group_by('item_class_cd, item_class_name')
				->get();
			return $query->result();
		}

		public function list_annual_price_by_id_inventory($company_id, $category, $id_inventory, $year){
			$query=$this->db->select('*')
				->from('view_inv_annual_price')
				->where('company_id', $company_id)
				->where('category', $category)
				->where('id_inventory', $id_inventory)
				->where('year', $year)
				->get();
			return $query->result();
		}

		public function list_annual_price($company_id, $category, $id_inventory){
			$query=$this->db->select('*')
				->from('view_inv_annual_price')
				->where('company_id', $company_id)
				->where('category', $category)
				->where('id_inventory', $id_inventory)
				->get();
			return $query->result();
		}

		public function list_annual_price_by_active($company_id, $category, $id_inventory){
			$query=$this->db->select('*')
				->from('view_inv_annual_price')
				->where('company_id', $company_id)
				->where('category', $category)
				->where('id_inventory', $id_inventory)
				->where('deleted', '0')
				->get();
			return $query->result();
		}

		public function list_inventory_stock($company_id, $category, $id_inventory){
			if ($id_inventory==0) {
				$query=$this->db->select('*')
					->from('view_inv_inventory')
					->where('company_id', $company_id)
					->where($category, 1)
					->where('deleted', '0')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_inventory')
					->where('company_id', $company_id)
					->where($category, 1)
					->where('id_inventory', $id_inventory)
					->where('deleted', '0')
					->get();
			}
			return $query->result();
		}

		public function list_uom_converter($company_id, $id_inventory){
			if ($id_inventory=='0') {
				$query=$this->db->select('*')
					->from('view_inv_uom_converter')
					->where('company_id', $company_id)
					->order_by('uom_cd', 'asc')
					->get();
			}
			else {
				$query=$this->db->select('*')
					->from('view_inv_uom_converter')
					->where('company_id', $company_id)
					->where('id_inventory', $id_inventory)
					->get();
			}
			
			return $query->result();
		}
	}

?>