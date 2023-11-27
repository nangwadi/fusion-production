<?php 

	class M_financecreate extends CI_Model{

		// Setting

		public function add_module_category($data){
			$query=$this->db->insert('fin_module_category', $data);
			return $query?true:false;
		}

		public function add_module($data){
			$query=$this->db->insert('fin_module', $data);
			return $query?true:false;
		}

		public function add_numbering_sequence($data){
			$query=$this->db->insert('fin_numbering_sequences', $data);
			return $query?true:false;
		}

		public function add_header_numbering($data){
			$query=$this->db->insert('fin_header_numbering', $data);
			return $query?true:false;
		}

		public function add_balance($data){
			$query=$this->db->insert('fin_balance', $data);
			return $query?true:false;
		}

		/*public function add_employee_permission($data){
			$query=$this->db->insert('fin_employee_permission', $data);
			return $query?true:false;
		}

		public function add_approval_permission($data){
			$query=$this->db->insert('fin_approval_permission', $data);
			return $query?true:false;
		}

		public function add_transaction_role($data){
			$query=$this->db->insert('fin_transaction_role', $data);
			return $query?true:false;
		}

		public function add_payment_methode($data){
			$query=$this->db->insert('fin_payment_methode', $data);
			return $query?true:false;
		}

		public function add_payment_terms($data){
			$query=$this->db->insert('fin_payment_terms', $data);
			return $query?true:false;
		}

		*/

		// INPUT

		// ================================ PETTY CASH =============================================================

		public function add_petty_cash_line($data){
			$query=$this->db->insert('fin_transaction_line', $data);
			return $query?true:false;
		}

		public function add_petty_cash_header($data){
			$query=$this->db->insert('fin_transaction', $data);
			return $query?true:false;
		}

		/*public function add_purchase_order($data){
			$query=$this->db->insert('fin_purchase_order', $data);
			return $query?true:false;
		}

		public function add_purchase_order_line($data){
			$query=$this->db->insert('fin_purchase_order_line', $data);
			return $query?true:false;
		}

		public function add_purchase_receipt($data){
			$query=$this->db->insert('fin_purchase_receipt', $data);
			return $query?true:false;
		}

		public function add_purchase_receipt_line($data){
			$query=$this->db->insert('fin_purchase_receipt_line', $data);
			return $query?true:false;
		}

		public function add_purchase_invoice($data){
			$query=$this->db->insert('fin_purchase_invoice', $data);
			return $query?true:false;
		}

		public function add_purchase_invoice_line($data){
			$query=$this->db->insert('fin_purchase_invoice_line', $data);
			return $query?true:false;
		}

		public function add_sales_order($data){
			$query=$this->db->insert('fin_sales_order', $data);
			return $query?true:false;
		}

		public function add_sales_order_line($data){
			$query=$this->db->insert('fin_sales_order_line', $data);
			return $query?true:false;
		}

		public function add_delivery_order($data){
			$query=$this->db->insert('fin_delivery_order', $data);
			return $query?true:false;
		}

		public function add_delivery_order_line($data){
			$query=$this->db->insert('fin_delivery_order_line', $data);
			return $query?true:false;
		}

		public function add_sales_invoice($data){
			$query=$this->db->insert('fin_sales_invoice', $data);
			return $query?true:false;
		}

		public function add_sales_invoice_line($data){
			$query=$this->db->insert('fin_sales_invoice_line', $data);
			return $query?true:false;
		}*/
		
	}

?>