<?php 

	class M_distributioncreate extends CI_Model{

		// Setting

		public function add_module_category($data){
			$query=$this->db->insert('dis_module_category', $data);
			return $query?true:false;
		}

		public function add_module($data){
			$query=$this->db->insert('dis_module', $data);
			return $query?true:false;
		}

		public function add_numbering_sequence($data){
			$query=$this->db->insert('dis_numbering_sequences', $data);
			return $query?true:false;
		}

		public function add_employee_permission($data){
			$query=$this->db->insert('dis_employee_permission', $data);
			return $query?true:false;
		}

		public function add_approval_permission($data){
			$query=$this->db->insert('dis_approval_permission', $data);
			return $query?true:false;
		}

		public function add_transaction_role($data){
			$query=$this->db->insert('dis_transaction_role', $data);
			return $query?true:false;
		}

		public function add_payment_methode($data){
			$query=$this->db->insert('dis_payment_methode', $data);
			return $query?true:false;
		}

		public function add_payment_terms($data){
			$query=$this->db->insert('dis_payment_terms', $data);
			return $query?true:false;
		}

		// Input

		public function add_purchase_order($data){
			$query=$this->db->insert('dis_purchase_order', $data);
			return $query?true:false;
		}

		public function add_purchase_order_line($data){
			$query=$this->db->insert('dis_purchase_order_line', $data);
			return $query?true:false;
		}

		public function add_purchase_receipt($data){
			$query=$this->db->insert('dis_purchase_receipt', $data);
			return $query?true:false;
		}

		public function add_purchase_receipt_line($data){
			$query=$this->db->insert('dis_purchase_receipt_line', $data);
			return $query?true:false;
		}

		public function add_purchase_invoice($data){
			$query=$this->db->insert('dis_purchase_invoice', $data);
			return $query?true:false;
		}

		public function add_purchase_invoice_line($data){
			$query=$this->db->insert('dis_purchase_invoice_line', $data);
			return $query?true:false;
		}

		public function add_sales_order($data){
			$query=$this->db->insert('dis_sales_order', $data);
			return $query?true:false;
		}

		public function add_sales_order_line($data){
			$query=$this->db->insert('dis_sales_order_line', $data);
			return $query?true:false;
		}

		public function add_delivery_order($data){
			$query=$this->db->insert('dis_delivery_order', $data);
			return $query?true:false;
		}

		public function add_delivery_order_line($data){
			$query=$this->db->insert('dis_delivery_order_line', $data);
			return $query?true:false;
		}

		public function add_sales_invoice($data){
			$query=$this->db->insert('dis_sales_invoice', $data);
			return $query?true:false;
		}

		public function add_sales_invoice_line($data){
			$query=$this->db->insert('dis_sales_invoice_line', $data);
			return $query?true:false;
		}

		public function add_transaction_header($data){
			$query=$this->db->insert('fin_transaction', $data);
			return $query?true:false;
		}

		public function add_transaction_distribution($data){
			$query=$this->db->insert('fin_transaction_distribution', $data);
			return $query?true:false;
		}
		
	}

?>