<?php 

	class M_inventoryupdate extends CI_Model{

		// Setting

		public function update_uom($data, $company_id, $id_uom){
			$query=$this->db->where('company_id', $company_id)
				->where('id_uom', $id_uom)
				->update('inv_uom', $data);

				return $query?true:false;
		}

		public function update_class_category($data, $company_id, $id_class_category){
			$query=$this->db->where('company_id', $company_id)
				->where('id_class_category', $id_class_category)
				->update('inv_class_category', $data);

				return $query?true:false;
		}

		public function update_warehouse($data, $company_id, $id_warehouse){
			$query=$this->db->where('company_id', $company_id)
				->where('id_warehouse', $id_warehouse)
				->update('inv_warehouse', $data);

				return $query?true:false;
		}

		public function update_item_class($data, $company_id, $id_item_class){
			$query=$this->db->where('company_id', $company_id)
				->where('id_item_class', $id_item_class)
				->update('inv_item_class', $data);

				return $query?true:false;
		}

		// Input

		public function update_group($data, $company_id, $id_inv_group){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inv_group', $id_inv_group)
				->update('inv_group', $data);

				return $query?true:false;
		}

		public function update_maker($data, $company_id, $id_inv_maker){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inv_maker', $id_inv_maker)
				->update('inv_maker', $data);

				return $query?true:false;
		}
		
		public function update_total_count_in_by_id_inventory($company_id, $data, $id_inventory){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->update('inv_total_count_in', $data);

				return $query?true:false;
		}

		public function update_total_count_in_line($company_id, $data, $id_total_count_in_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_total_count_in_line', $id_total_count_in_line)
				->update('inv_total_count_in_line', $data);

				return $query?true:false;
		}

		public function update_total_count_in($company_id, $data, $id_inventory){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->update('inv_total_count_in', $data);

				return $query?true:false;
		}

		public function update_total_count_out($company_id, $data, $id_inventory){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->update('inv_total_count_out', $data);

				return $query?true:false;
		}

		public function update_total_count($company_id, $data, $id_inventory){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->update('inv_total_count', $data);

				return $query?true:false;
		}

		public function update_kit_assy($company_id, $data, $kit_assy_number){
			$query=$this->db->where('company_id', $company_id)
				->where('kit_assy_number', $kit_assy_number)
				->update('inv_kit_assy', $data);

				return $query?true:false;
		}

		public function update_annual_price($company_id, $data, $id_inventory, $year){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->where('year', $year)
				->update('inv_annual_price', $data);

				return $query?true:false;
		}

		public function update_uom_convert($company_id, $data, $id_inventory){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->update('inv_uom_converter', $data);

				return $query?true:false;
		}

		public function update_inventory($company_id, $id_inventory, $data){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory', $id_inventory)
				->update('inv_inventory', $data);

				return $query?true:false;
		}

		// Delete

		public function update_inventory_img($company_id, $id_inventory_img, $data){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory_img', $id_inventory_img)
				->update('inv_inventory_img', $data);

				return $query?true:false;
		}

		public function delete_stock_out($company_id, $id_stock_out){
			$query=$this->db->where('company_id', $company_id)
				->where('id_stock_out', $id_stock_out)
				->delete('inv_stock_out');

				return $query?true:false;
		}

		public function delete_inventory_img($company_id, $id_inventory_img){
			$query=$this->db->where('company_id', $company_id)
				->where('id_inventory_img', $id_inventory_img)
				->delete('inv_inventory_img');

				return $query?true:false;
		}

	}

?>