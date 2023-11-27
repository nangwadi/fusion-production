<?php 

	class M_distributionupdate extends CI_Model{

		// Setting

		public function update_module_category($data, $company_id, $id_module_category){
			$query=$this->db->where('company_id', $company_id)
				->where('id_module_category', $id_module_category)
				->update('dis_module_category', $data);

				return $query?true:false;
		}

		public function update_module($data, $company_id, $id_module){
			$query=$this->db->where('company_id', $company_id)
				->where('id_module', $id_module)
				->update('dis_module', $data);

				return $query?true:false;
		}

		public function update_numbering_sequence($data, $company_id, $id_module){
			$query=$this->db->where('company_id', $company_id)
				->where('id_module', $id_module)
				->update('dis_numbering_sequences', $data);

				return $query?true:false;
		}

		public function update_employee_permission($data, $company_id, $id_employee_permission){
			$query=$this->db->where('company_id', $company_id)
				->where('id_employee_permission', $id_employee_permission)
				->update('dis_employee_permission', $data);

				return $query?true:false;
		}

		public function update_transaction_role($data, $company_id, $id_transaction_role){
			$query=$this->db->where('company_id', $company_id)
				->where('id_transaction_role', $id_transaction_role)
				->update('dis_transaction_role', $data);

				return $query?true:false;
		}

		public function update_payment_methode($data, $company_id, $id_payment_methode){
			$query=$this->db->where('company_id', $company_id)
				->where('id_payment_methode', $id_payment_methode)
				->update('dis_payment_methode', $data);

				return $query?true:false;
		}

		public function update_payment_terms($data, $company_id, $id_payment_terms){
			$query=$this->db->where('company_id', $company_id)
				->where('id_payment_terms', $id_payment_terms)
				->update('dis_payment_terms', $data);

				return $query?true:false;
		}

		// Input

		public function update_purchase_order($company_id, $data, $id_purchase_order){
			$query=$this->db->where('company_id', $company_id)
				->where('id_purchase_order', $id_purchase_order)
				->update('dis_purchase_order', $data);

				return $query?true:false;
		}

		public function update_purchase_order_line($company_id, $data, $id_purchase_order_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_purchase_order_line', $id_purchase_order_line)
				->update('dis_purchase_order_line', $data);

				return $query?true:false;
		}
		
		public function update_purchase_order_by_purchase_order_number($company_id, $data, $purchase_order_number){
			$query=$this->db->where('company_id', $company_id)
				->where('purchase_order_number', $purchase_order_number)
				->update('dis_purchase_order', $data);

				return $query?true:false;
		}

		public function update_purchase_receipt_by_purchase_receipt_number($company_id, $data, $purchase_receipt_number){
			$query=$this->db->where('company_id', $company_id)
				->where('purchase_receipt_number', $purchase_receipt_number)
				->update('dis_purchase_receipt', $data);

				return $query?true:false;
		}

		public function update_purchase_receipt_line($company_id, $data, $id_purchase_receipt_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_purchase_receipt_line', $id_purchase_receipt_line)
				->update('dis_purchase_receipt_line', $data);

				return $query?true:false;
		}

		public function update_purchase_invoice($company_id, $data, $id_purchase_invoice){
			$query=$this->db->where('company_id', $company_id)
				->where('id_purchase_invoice', $id_purchase_invoice)
				->update('dis_purchase_invoice', $data);

				return $query?true:false;
		}

		public function update_purchase_invoice_line($company_id, $data, $id_purchase_invoice_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_purchase_invoice_line', $id_purchase_invoice_line)
				->update('dis_purchase_invoice_line', $data);

				return $query?true:false;
		}

		public function update_purchase_invoice_by_purchase_invoice_number($company_id, $data, $purchase_invoice_number){
			$query=$this->db->where('company_id', $company_id)
				->where('purchase_invoice_number', $purchase_invoice_number)
				->update('dis_purchase_invoice', $data);

				return $query?true:false;
		}

		public function update_transaction_header($company_id, $data, $id_transaction){
			$query=$this->db->where('company_id', $company_id)
				->where('id_transaction', $id_transaction)
				->update('fin_transaction', $data);

				return $query?true:false;
		}

		public function update_sales_order($company_id, $data, $id_sales_order){
			$query=$this->db->where('company_id', $company_id)
				->where('id_sales_order', $id_sales_order)
				->update('dis_sales_order', $data);

				return $query?true:false;
		}

		public function update_sales_order_line($company_id, $data, $id_sales_order_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_sales_order_line', $id_sales_order_line)
				->update('dis_sales_order_line', $data);

				return $query?true:false;
		}

		public function update_sales_order_by_sales_order_number($company_id, $data, $sales_order_number){
			$query=$this->db->where('company_id', $company_id)
				->where('sales_order_number', $sales_order_number)
				->update('dis_sales_order', $data);

				return $query?true:false;
		}

		public function update_delivery_order_by_delivery_order_number($company_id, $data, $delivery_order_number){
			$query=$this->db->where('company_id', $company_id)
				->where('delivery_order_number', $delivery_order_number)
				->update('dis_delivery_order', $data);

				return $query?true:false;
		}

		public function update_delivery_order_line($company_id, $data, $id_delivery_order_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_delivery_order_line', $id_delivery_order_line)
				->update('dis_delivery_order_line', $data);

				return $query?true:false;
		}

		function update_sales_invoice_by_sales_invoice_number($company_id, $data, $sales_invoice_number){
			$query=$this->db->where('company_id', $company_id)
				->where('sales_invoice_number', $sales_invoice_number)
				->update('dis_sales_invoice', $data);

				return $query?true:false;
		}

		public function update_sales_invoice_line($company_id, $data, $id_sales_invoice_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_sales_invoice_line', $id_sales_invoice_line)
				->update('dis_sales_invoice_line', $data);

				return $query?true:false;
		}

		// Delete

		public function delete_employee_permission($company_id, $id_employee_permission){
			$query=$this->db->where('company_id', $company_id)
				->where('id_employee_permission', $id_employee_permission)
				->delete('dis_employee_permission');

				return $query?true:false;
		}

		public function delete_approval_permission($company_id, $id_approval_permission){
			$query=$this->db->where('company_id', $company_id)
				->where('id_approval_permission', $id_approval_permission)
				->delete('dis_approval_permission');

				return $query?true:false;
		}

		public function delete_transaction_role($company_id, $id_transaction_role){
			$query=$this->db->where('company_id', $company_id)
				->where('id_transaction_role', $id_transaction_role)
				->delete('dis_transaction_role');

				return $query?true:false;
		}

		public function delete_purchase_order_line($company_id, $id_purchase_order_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_purchase_order_line', $id_purchase_order_line)
				->delete('dis_purchase_order_line');

				return $query?true:false;
		}

		public function delete_purchase_order_line_by_purchase_order_number($company_id, $purchase_order_number){
			$query=$this->db->where('company_id', $company_id)
				->where('purchase_order_number', $purchase_order_number)
				->delete('dis_purchase_order_line');

				return $query?true:false;
		}

		public function delete_purchase_receipt_line($company_id, $id_purchase_receipt_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_purchase_receipt_line', $id_purchase_receipt_line)
				->delete('dis_purchase_receipt_line');

				return $query?true:false;
		}

		public function delete_delivery_order_line($company_id, $id_delivery_order_line){
			$query=$this->db->where('company_id', $company_id)
				->where('id_delivery_order_line', $id_delivery_order_line)
				->delete('dis_delivery_order_line');

				return $query?true:false;
		}

	}

?>