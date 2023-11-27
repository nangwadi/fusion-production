<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DistributionUpdate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_distributionread');
	        $this->load->model('m_distributioncreate');
	        $this->load->model('m_distributionupdate');
	        $this->load->model('m_essread');
	        $this->load->model('m_inventoryread');
	        $this->load->model('m_inventorycreate');
	        $this->load->model('m_inventoryupdate');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function update_module_category($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_module_category', 'id_module_category', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_module_category = $this->input->post('id_module_category');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_distributionupdate->update_module_category($data, $company_id_session, $id_module_category);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_module($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_module = $this->input->post('id_module');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_distributionupdate->update_module($data, $company_id_session, $id_module);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_transaction_role($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_transaction_role = $this->input->post('id_transaction_role');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_distributionupdate->update_transaction_role($data, $company_id_session, $id_transaction_role);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_payment_methode($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_payment_methode', 'id_payment_methode', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_payment_methode = $this->input->post('id_payment_methode');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_distributionupdate->update_payment_methode($data, $company_id_session, $id_payment_methode);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_payment_terms($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_payment_terms', 'id_payment_terms', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_payment_terms = $this->input->post('id_payment_terms');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_distributionupdate->update_payment_terms($data, $company_id_session, $id_payment_terms);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		// Input

		public function update_purchase_order_hold($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('purchase_order_number', 'purchase_order_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$purchase_order_number = $this->input->post('purchase_order_number');
						$id_module = $this->input->post('id_module');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');

						if ($hold_value==1) {
							$id_transaction_role = 1;
						}
						else {
							$id_transaction_role = 2;
						}

						$data=array(
							'hold' => $hold_value,
							'id_transaction_role' => $id_transaction_role,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);

						$result = $this->m_distributionupdate->update_purchase_order_by_purchase_order_number($company_id_session, $data, $purchase_order_number);
						if ($result==true) {
							$result_transaction_role = $this->m_distributionread->list_transaction_role($company_id_session, $id_module, $id_transaction_role);
							$transaction_name = $result_transaction_role[0]->transaction_name;
							$status = 1;
							$responseValue = $transaction_name;
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_purchase_order_approve($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_puchase_order', 'id_puchase_order', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_puchase_order = $this->input->post('id_puchase_order');
						$id_transaction_role = $this->input->post('id_transaction_role');
						
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'id_transaction_role' => $id_transaction_role,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);

						$result = $this->m_distributionupdate->update_purchase_order($company_id_session, $data, $id_puchase_order);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_purchase_receipt_hold($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('purchase_receipt_number', 'purchase_receipt_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$purchase_receipt_number = $this->input->post('purchase_receipt_number');
						$id_module = $this->input->post('id_module');
						$id_transaction_role_post = $this->input->post('id_transaction_role');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');

						$result_transaction_role_by_id_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_post);
						$sequence = $result_transaction_role_by_id_transaction_role[0]->sequence;
						if ($sequence>=3) {
							$status = 0;
							$responseValue = 'This transaction cannot set to hold because was receipt.';
						}
						else {
							$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, 1);
							$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;

							if ($hold_value==1) {
								$id_transaction_role_new = $id_transaction_role_old;
								$sequence = 1;

								$data=array(
									'cNIK_receipt' => '',
									'hold' => $hold_value,
									'id_transaction_role' => $id_transaction_role_new,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
							}
							else {
								$id_transaction_role_new = $id_transaction_role_old+1;
								$sequence = $result_transaction_role_old[0]+1;
								
								$data=array(
									'hold' => $hold_value,
									'id_transaction_role' => $id_transaction_role_new,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
							}

							$result = $this->m_distributionupdate->update_purchase_receipt_by_purchase_receipt_number($company_id_session, $data, $purchase_receipt_number);
							if ($result==true) {
								$result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence);
								$transaction_name = $result_transaction_role[0]->transaction_name;
								$status = 1;
								$responseValue = $transaction_name;
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_purchase_receipt_receipt($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('purchase_receipt_number', 'purchase_receipt_number', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					$this->form_validation->set_rules('cNIK_receipt', 'cNIK_receipt', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$purchase_receipt_number = $this->input->post('purchase_receipt_number');
						$id_module = $this->input->post('id_module');
						$cNmPegawai = $this->input->post('cNIK_receipt');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$last_update = date('Y-m-d H:i:s');

						$result_transaction_role_sequence = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role);
						$sequence = $result_transaction_role_sequence[0]->sequence;

						$status_array = array();
						$responseValue_array = array();

						if ($sequence <= 1) {
							$status = 0;
							$responseValue = 'Cannot receipt this transaction because transaction not in open status.';

							array_push($status_array, $status);
							array_push($responseValue_array, $responseValue);
						}
						else {
							$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence);
							$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;

							$id_transaction_role_new = $id_transaction_role_old+1;
							$sequence_new = $sequence+1; 

							$result_employee = $this->m_essread->personal_data_by_cnmpegawai($company_id_session, $cNmPegawai);
							$cNIK_receipt = $result_employee[0]->cNIK;

							$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
							$id_transaction_role_new = $result_transaction_role_old[0]->id_transaction_role;

							$data=array(
								'id_transaction_role' => $id_transaction_role_new,
								'cNIK_receipt' => $cNIK_receipt,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);

							$result = $this->m_distributionupdate->update_purchase_receipt_by_purchase_receipt_number($company_id_session, $data, $purchase_receipt_number);
							if ($result==true) {
								$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line_by_purchase_receipt_number($company_id_session, $purchase_receipt_number);
								foreach ($result_purchase_receipt_line as $resultListLine) { 
									$id_purchase_receipt = $resultListLine->id_purchase_receipt;
									$id_purchase_receipt_line = $resultListLine->id_purchase_receipt_line;
									$id_inventory = $resultListLine->id_inventory;
									$purchase_receipt_line_qty = $resultListLine->purchase_receipt_line_qty;

									$result_uom_convert = $this->m_inventoryread->list_uom_converter($company_id_session, $id_inventory);
									if (count($result_uom_convert) == 0) {
										$qty_in = ($purchase_receipt_line_qty*1);
									}
									else {
										$number_convert = $result_uom_convert[0]->number_convert;
										$qty_in = ($purchase_receipt_line_qty*1)*($number_convert*1);
									}

									$data_total_count_in_line = array(
										'company_id' => $company_id_session,
										'id_purchase_receipt_line' => $id_purchase_receipt_line,
										'id_inventory' => $id_inventory,
										'qty_in' => $qty_in,
										'deleted' => 0,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update
									);
									$result_add_total_count_out_line = $this->m_inventorycreate->add_total_count_in_line($data_total_count_in_line);
									if ($result_add_total_count_out_line) {
										$result_total_count_in = $this->m_inventoryread->list_total_count_in_by_id_inventory($company_id_session, $id_inventory);
										if (count($result_total_count_in)==0) {
											$data_total_count_in = array(
												'company_id' => $company_id_session,
												'id_inventory' => $id_inventory,
												'total_count_in' => $qty_in*1,
												'create_by' => $cNIK_session,
												'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_add_total_count_in_header = $this->m_inventorycreate->add_total_count_in($data_total_count_in);
											if ($result_add_total_count_in_header == true) {
												$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
												if (count($result_total_count)==0) { // New Total Count
													$data_total_count = array (
														'company_id' => $company_id_session,
														'id_inventory' => $id_inventory,
														'total_count' => $qty_in*1,
														'create_by' => $cNIK_session,
														'create_date' => $last_update,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_add_total_count = $this->m_inventorycreate->add_total_count($data_total_count);
													if ($result_add_total_count == true) {
														$status = 1;
														$responseValue = '';

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
												}
												else {
													$total_count_old = $result_total_count[0]->total_count;
													$total_count_new = ($total_count_old*1)+($qty_in*1);

													$data_total_count = array (
														'total_count' => $total_count_new*1,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
													if ($result_update_total_count == true) {
														$status = 1;
														$responseValue = '';

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
												}
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;

												array_push($status_array, $status);
												array_push($responseValue_array, $responseValue);
											}
										}
										else {
											$total_count_in_old = $result_total_count_in[0]->total_count_in;
											$total_count_in_new = ($total_count_in_old*1)+($qty_in*1);
											$data_total_count_in = array(
												'total_count_in' => $total_count_in_new*1,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_total_count_in_update = $this->m_inventoryupdate->update_total_count_in_by_id_inventory($company_id_session, $data_total_count_in, $id_inventory);
											if ($result_total_count_in_update == true) {
												$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
												if (count($result_total_count)==0) { // New Total Count
													$data_total_count = array (
														'company_id' => $company_id_session,
														'id_inventory' => $id_inventory,
														'total_count' => $qty_in*1,
														'create_by' => $cNIK_session,
														'create_date' => $last_update,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_add_total_count = $this->m_inventorycreate->add_total_count($data_total_count);
													if ($result_add_total_count == true) {
														$status = 1;
														$responseValue = '';

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
												}
												else {
													$total_count_old = $result_total_count[0]->total_count;
													$total_count_new = ($total_count_old*1)+($qty_in*1);

													$data_total_count = array (
														'total_count' => $total_count_new*1,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
													if ($result_update_total_count == true) {
														$status = 1;
														$responseValue = '';

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;

														array_push($status_array, $status);
														array_push($responseValue_array, $responseValue);
													}
												}
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;

												array_push($status_array, $status);
												array_push($responseValue_array, $responseValue);
											}
										}
									}
									else {
										$status = 0;
										$responseValue = "Cannot add total count out line.";
										array_push($status_array, $status);
										array_push($responseValue_array, $responseValue);
									}
									
								}

								$result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
								$transaction_name = $result_transaction_role[0]->transaction_name;
								//$status = 1;
								//$responseValue = $transaction_name;
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'response' => array_unique($responseValue_array), 'result_total_count_in_update' => $result_total_count_in_update)));
				}
			}
		}

		public function update_purchase_receipt_request_release($key_session){
			$this->load->config('email');
			$this->load->library('email');

			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('purchase_receipt_number', 'purchase_receipt_number', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					$this->form_validation->set_rules('cNIK_receipt', 'cNIK_receipt', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$purchase_receipt_number = $this->input->post('purchase_receipt_number');
						$id_module = $this->input->post('id_module');
						$cNmPegawai = $this->input->post('cNIK_receipt');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$last_update = date('Y-m-d H:i:s');

						$result_transaction_role_sequence = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role);
						$sequence = $result_transaction_role_sequence[0]->sequence;

						if ($sequence == 3) {
							$sequence_new = $sequence+1;

							$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
							$id_transaction_role_new = $result_transaction_role_old[0]->id_transaction_role;

							$data=array(
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);

							$result = $this->m_distributionupdate->update_purchase_receipt_by_purchase_receipt_number($company_id_session, $data, $purchase_receipt_number);
							if ($result==true) {
								$result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
								$transaction_name = $result_transaction_role[0]->transaction_name;

								$purchase_receipt_number_replace=str_replace('/', '-', $purchase_receipt_number);

						        $from = $this->config->item('smtp_user');
						        $to = 'tarwadi@meiwa-m.co.id';
						        $subject = 'Request Release Purchase Receipt - No. '.$purchase_receipt_number;
						        $message = 'Permintaan Release Receipt Item Nomor. '.$purchase_receipt_number.', Silahkan Dicek Terlebih Dahulu Sebelum di Release.<br><br>
									        Catatan.
									        <br>
									        <a href="https://fusion.meiwa-m.co.id/fusion/acumatica/docs/validasi-release-ri.php?receipt='.$purchase_receipt_number_replace.'">Cek Validasi Disini</a>';

						        $this->email->set_newline("\r\n");
						        $this->email->from($from);
						        $this->email->to($to);
						        $this->email->subject($subject);
						        $this->email->message($message);

						        if ($this->email->send()) {
									$status = 1;
									$responseValue = $transaction_name;
						        } 
						        else {
									$status = 0;
									$responseValue = show_error($this->email->print_debugger());
						        }
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
						}
						else if($sequence == 4) {
					        
					        $purchase_receipt_number_replace=str_replace('/', '-', $purchase_receipt_number);

					        $from = $this->config->item('smtp_user');
					        $to = 'tarwadi@meiwa-m.co.id';
					        $subject = 'Request Release Purchase Receipt - No. '.$purchase_receipt_number;
					        $message = 'Permintaan Release Receipt Item Nomor. '.$purchase_receipt_number.', Silahkan Dicek Terlebih Dahulu Sebelum di Release.<br><br>
								        Catatan.
								        <br>
								        <a href="https://fusion.meiwa-m.co.id/fusion/acumatica/docs/validasi-release-ri.php?receipt='.$purchase_receipt_number_replace.'">Cek Validasi Disini</a>';

					        $this->email->set_newline("\r\n");
					        $this->email->from($from);
					        $this->email->to($to);
					        $this->email->subject($subject);
					        $this->email->message($message);

					        if ($this->email->send()) {
					            $status = 1;
								$responseValue = 'Send email successfully.';
					        } 
					        else {
								$status = 0;
								$responseValue = show_error($this->email->print_debugger());
					        }
						}
						else {
							$status = 0;
							$responseValue = 'Cannot receipt this transaction because this transaction is not in receipt or request release status.'.$sequence;
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_purchase_receipt_release($key_session){
			$this->load->config('email');
			$this->load->library('email');

			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('purchase_receipt_number', 'purchase_receipt_number', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					$this->form_validation->set_rules('cNIK_receipt', 'cNIK_receipt', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$purchase_receipt_number = $this->input->post('purchase_receipt_number');
						$id_module = $this->input->post('id_module');
						$cNmPegawai = $this->input->post('cNIK_receipt');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$last_update = date('Y-m-d H:i:s');

						$result_transaction_role_sequence = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role);
						$sequence = $result_transaction_role_sequence[0]->sequence;

						if ($sequence == 4) {
							$sequence_new = $sequence+1;

							$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
							$id_transaction_role_new = $result_transaction_role_old[0]->id_transaction_role;

							$data=array(
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);

							$result = $this->m_distributionupdate->update_purchase_receipt_by_purchase_receipt_number($company_id_session, $data, $purchase_receipt_number);
							if ($result==true) {
								$result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
								$transaction_name = $result_transaction_role[0]->transaction_name;
								
								$purchase_receipt_number_replace=str_replace('/', '-', $purchase_receipt_number);

						        $from = $this->config->item('smtp_user');
						        $to = 'tarwadi@meiwa-m.co.id';
						        $subject = 'Request Release Purchase Receipt Has Release - No. '.$purchase_receipt_number;
						        $message = 'Purchase Receipt No. '.$purchase_receipt_number.' has release, next create purchase invoice base this purchase receipt.';

						        $this->email->set_newline("\r\n");
						        $this->email->from($from);
						        $this->email->to($to);
						        $this->email->subject($subject);
						        $this->email->message($message);

						        if ($this->email->send()) {
									$status = 1;
									$responseValue = $transaction_name;
						        } 
						        else {
									$status = 0;
									$responseValue = show_error($this->email->print_debugger());
						        }
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
						}
						else {
							$status = 0;
							$responseValue = 'Cannot receipt this transaction because this transaction is not in request release status.'.$sequence;
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_purchase_invoice_hold($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('purchase_invoice_number', 'purchase_invoice_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$purchase_invoice_number = $this->input->post('purchase_invoice_number');
						$id_module = $this->input->post('id_module');
						$id_transaction_role_post = $this->input->post('id_transaction_role');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');

						$result_transaction_role_by_id_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_post);
						$sequence = $result_transaction_role_by_id_transaction_role[0]->sequence;
						if ($sequence>=3) {
							$status = 0;
							$responseValue = 'This transaction cannot set to hold because was invoice.';
						}
						else {
							$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, 1);
							$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;

							if ($hold_value==1) {
								$id_transaction_role_new = $id_transaction_role_old;
								$sequence = 1;

								$data=array(
									'hold' => $hold_value,
									'id_transaction_role' => $id_transaction_role_new,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
							}
							else {
								$id_transaction_role_new = $id_transaction_role_old+1;
								$sequence = $result_transaction_role_old[0]+1;
								
								$data=array(
									'hold' => $hold_value,
									'id_transaction_role' => $id_transaction_role_new,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
							}

							$result = $this->m_distributionupdate->update_purchase_invoice_by_purchase_invoice_number($company_id_session, $data, $purchase_invoice_number);
							if ($result==true) {
								$result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence);
								$transaction_name = $result_transaction_role[0]->transaction_name;
								$status = 1;
								$responseValue = $transaction_name;
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_sales_order_hold($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('sales_order_number', 'sales_order_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$sales_order_number = $this->input->post('sales_order_number');
						$id_module = $this->input->post('id_module');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');
						
						$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, 1);
						$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;

						if ($hold_value==1) {
							$id_transaction_role_new = $id_transaction_role_old;
							$sequence = 1;

							$data=array(
								'hold' => $hold_value,
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
						}
						else {
							$id_transaction_role_new = $id_transaction_role_old+1;
							$sequence = $result_transaction_role_old[0]+1;
							
							$data=array(
								'hold' => $hold_value,
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
						}

						$result = $this->m_distributionupdate->update_sales_order_by_sales_order_number($company_id_session, $data, $sales_order_number);
						if ($result==true) {
							$result_transaction_role = $this->m_distributionread->list_transaction_role($company_id_session, $id_module, $id_transaction_role);
							$transaction_name = $result_transaction_role[0]->transaction_name;
							$status = 1;
							$responseValue = $transaction_name;
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_sales_order_approve($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_sales_order', 'id_sales_order', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_sales_order = $this->input->post('id_sales_order');
						$id_transaction_role = $this->input->post('id_transaction_role');
						
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'id_transaction_role' => $id_transaction_role,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);

						$result = $this->m_distributionupdate->update_sales_order($company_id_session, $data, $id_sales_order);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_delivery_order_hold($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('delivery_order_number', 'delivery_order_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$delivery_order_number = $this->input->post('delivery_order_number');
						$id_module = $this->input->post('id_module');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');
						
						$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, 1);
						$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;

						if ($hold_value==1) {
							$id_transaction_role_new = $id_transaction_role_old;
							$sequence = 1;

							$data=array(
								'hold' => $hold_value,
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
						}
						else {
							$id_transaction_role_new = $id_transaction_role_old+1;
							$sequence = $result_transaction_role_old[0]+1;
							
							$data=array(
								'hold' => $hold_value,
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
						}

						$result = $this->m_distributionupdate->update_delivery_order_by_delivery_order_number($company_id_session, $data, $delivery_order_number);
						if ($result==true) {
							$result_transaction_role = $this->m_distributionread->list_transaction_role($company_id_session, $id_module, $id_transaction_role);
							$transaction_name = $result_transaction_role[0]->transaction_name;
							$status = 1;
							$responseValue = $transaction_name;
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_delivery_order_print($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('delivery_order_number', 'delivery_order_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$delivery_order_number = $this->input->post('delivery_order_number');
						$id_module = $this->input->post('id_module');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');
						
						$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role);
						$sequence_old = $result_transaction_role_old[0]->sequence;
						$transaction_name_old = $result_transaction_role_old[0]->transaction_name;

						if ($transaction_name_old!='Printed') {
							$sequence_new = $sequence_old+1;
							$result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
							$id_transaction_role_new = $result_transaction_role[0]->id_transaction_role;
							$transaction_name = $result_transaction_role[0]->transaction_name;

							$data=array(
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_distributionupdate->update_delivery_order_by_delivery_order_number($company_id_session, $data, $delivery_order_number);
							if ($result==true) {
								$status = 1;
								$responseValue = $transaction_name;
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
						}
						else {
							$status = 1;
							//$responseValue = '';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_sales_invoice_hold($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('sales_invoice_number', 'sales_invoice_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$sales_invoice_number = $this->input->post('sales_invoice_number');
						$id_module = $this->input->post('id_module');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');
						
						$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, 1);
						$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;

						if ($hold_value==1) {
							$id_transaction_role_new = $id_transaction_role_old;
							$sequence = 1;

							$data=array(
								'hold' => $hold_value,
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
						}
						else {
							$id_transaction_role_new = $id_transaction_role_old+1;
							$sequence = $result_transaction_role_old[0]+1;
							
							$data=array(
								'hold' => $hold_value,
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
						}

						$result = $this->m_distributionupdate->update_sales_invoice_by_sales_invoice_number($company_id_session, $data, $sales_invoice_number);
						if ($result==true) {
							$result_transaction_role = $this->m_distributionread->list_transaction_role($company_id_session, $id_module, $id_transaction_role);
							$transaction_name = $result_transaction_role[0]->transaction_name;
							$status = 1;
							$responseValue = $transaction_name;
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_sales_invoice_print($key_session, $hold_value){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('sales_invoice_number', 'sales_invoice_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$sales_invoice_number = $this->input->post('sales_invoice_number');
						$id_module = $this->input->post('id_module');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$hold_value = $this->uri->segment('4');
						$last_update = date('Y-m-d H:i:s');
						
						$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role);
						$sequence_old = $result_transaction_role_old[0]->sequence;
						$transaction_name_old = $result_transaction_role_old[0]->transaction_name;

						if ($transaction_name_old!='Printed') {
							$sequence_new = $sequence_old+1;
							$result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
							$id_transaction_role_new = $result_transaction_role[0]->id_transaction_role;
							$transaction_name = $result_transaction_role[0]->transaction_name;

							$data=array(
								'id_transaction_role' => $id_transaction_role_new,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_distributionupdate->update_sales_invoice_by_sales_invoice_number($company_id_session, $data, $sales_invoice_number);
							if ($result==true) {
								$status = 1;
								$responseValue = $transaction_name;
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
						}
						else {
							$status = 1;
							//$responseValue = '';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		// Delete

		public function delete_employee_permission($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_employee_permission', 'id_employee_permission', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_employee_permission = $this->input->post('id_employee_permission');

						$result = $this->m_distributionupdate->delete_employee_permission($company_id_session, $id_employee_permission);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not deleted.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function delete_approval_permission($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_approval_permission', 'id_approval_permission', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_approval_permission = $this->input->post('id_approval_permission');

						$result = $this->m_distributionupdate->delete_approval_permission($company_id_session, $id_approval_permission);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not deleted.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function delete_transaction_role($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_transaction_role = $this->input->post('id_transaction_role');
						$result = $this->m_distributionupdate->delete_transaction_role($company_id_session, $id_transaction_role);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not deleted.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function delete_purchase_order($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$this->form_validation->set_rules('purchase_order_number', 'purchase_order_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$purchase_order_number = $this->input->post('purchase_order_number');
						$data = array(
							'deleted' => 1,
							'last_by' => $cNIK_session,
							'last_update' => date('Y-m-d H:i:s')
						);
						$result = $this->m_distributionupdate->update_purchase_order_by_purchase_order_number($company_id_session, $data, $purchase_order_number);
						if ($result==true) {
							$result_purchase_order_line = $this->m_distributionupdate->delete_purchase_order_line_by_purchase_order_number($company_id_session, $purchase_order_number);
							if ($result_purchase_order_line==true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Purchase order line cannot deleting.';
							}
						}
						else {
							$status = 0;
							$responseValue = 'Data not deleted.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

	}