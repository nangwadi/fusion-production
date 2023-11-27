<?php 

	class M_inventorycreate extends CI_Model{

		// Setting

		public function add_uom($data){
			$query=$this->db->insert('inv_uom', $data);
			return $query?true:false;
		}

		public function add_class_category($data){
			$query=$this->db->insert('inv_class_category', $data);
			return $query?true:false;
		}

		public function add_warehouse($data){
			$query=$this->db->insert('inv_warehouse', $data);
			return $query?true:false;
		}

		public function add_item_class($data){
			$query=$this->db->insert('inv_item_class', $data);
			return $query?true:false;
		}

		// Input

		public function add_group($data){
			$query=$this->db->insert('inv_group', $data);
			return $query?true:false;
		}

		public function add_maker($data){
			$query=$this->db->insert('inv_maker', $data);
			return $query?true:false;
		}

		public function add_inventory_img($data){
			$query=$this->db->insert('inv_inventory_img', $data);
			return $query?true:false;
		}

		public function add_inventory($data){
			$query=$this->db->insert('inv_inventory', $data);
			return $query?true:false;
		}

		public function add_return($data){
			$query=$this->db->insert('inv_return', $data);
			return $query?true:false;
		}

		public function add_kit_assy($data){
			$query=$this->db->insert('inv_kit_assy', $data);
			return $query?true:false;
		}

		public function add_kit_assy_line($data){
			$query=$this->db->insert('inv_kit_assy_line', $data);
			return $query?true:false;
		}

		public function add_total_count_in($data){
			$query=$this->db->insert('inv_total_count_in', $data);
			return $query?true:false;
		}

		public function add_total_count_in_line($data){
			$query=$this->db->insert('inv_total_count_in_line', $data);
			return $query?true:false;
		}

		public function add_total_count_out($data){
			$query=$this->db->insert('inv_total_count_out', $data);
			return $query?true:false;
		}

		public function add_total_count_out_line($data){
			$query=$this->db->insert('inv_total_count_out_line', $data);
			return $query?true:false;
		}

		public function add_total_count($data){
			$query=$this->db->insert('inv_total_count', $data);
			return $query?true:false;
		}

		public function add_annual_price($data){
			$query=$this->db->insert('inv_annual_price', $data);
			return $query?true:false;
		}

		public function add_stock_out($data){
			$query=$this->db->insert('inv_stock_out', $data);
			return $query?true:false;
		}

		public function add_uom_convert($data){
			$query=$this->db->insert('inv_uom_converter', $data);
			return $query?true:false;
		}
		
	}

?>