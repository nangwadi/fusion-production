<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class InventoryUpdate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_inventoryread');
	        $this->load->model('m_inventorycreate');
	        $this->load->model('m_inventoryupdate');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function update_uom($key_session){
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
					$this->form_validation->set_rules('id_uom', 'id_uom', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_uom = $this->input->post('id_uom');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_inventoryupdate->update_uom($data, $company_id_session, $id_uom);
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

		public function update_class_category($key_session){
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
					$this->form_validation->set_rules('id_class_category', 'id_class_category', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_class_category = $this->input->post('id_class_category');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_inventoryupdate->update_class_category($data, $company_id_session, $id_class_category);
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

		public function update_warehouse($key_session){
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
					$this->form_validation->set_rules('id_warehouse', 'id_warehouse', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_warehouse = $this->input->post('id_warehouse');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_inventoryupdate->update_warehouse($data, $company_id_session, $id_warehouse);
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

		public function update_item_class($key_session){
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
					$this->form_validation->set_rules('id_item_class', 'id_item_class', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_item_class = $this->input->post('id_item_class');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_inventoryupdate->update_item_class($data, $company_id_session, $id_item_class);
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

		public function update_group($key_session){
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
					$this->form_validation->set_rules('id_inv_group', 'id_inv_group', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_inv_group = $this->input->post('id_inv_group');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_inventoryupdate->update_group($data, $company_id_session, $id_inv_group);
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

		public function update_inventory($key_session){
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
					$this->form_validation->set_rules('id_inventory', 'id_inventory', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_inventory = $this->input->post('id_inventory');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_inventoryupdate->update_inventory($data, $company_id_session, $id_inventory);
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

		// Delete

		public function delete_stock_out($key_session){
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
					$this->form_validation->set_rules('id_inventory', 'id_inventory', 'required');
					$this->form_validation->set_rules('id_stock_out', 'id_stock_out', 'required');
					$this->form_validation->set_rules('qty', 'qty', 'required');
					$this->form_validation->set_rules('category', 'category', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_inventory = $this->input->post('id_inventory');
						$id_stock_out = $this->input->post('id_stock_out');
						$qty = ($this->input->post('qty'))*1;
						$category = $this->input->post('category');
						$qty_used = $qty;

						$last_update = date('Y-m-d H:i:s');

						$result_delete_stock_out = $this->m_inventoryupdate->delete_stock_out($company_id_session, $id_stock_out);
						if ($result_delete_stock_out==true) {
							$data_total_count_in_line = array(
								'company_id' => $company_id_session,
								'id_purchase_receipt_line' => $category,
								'id_inventory' => $id_inventory,
								'qty_in' => $qty_used,
								'deleted' => 0,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update
							);
							$result_add_total_count_in_line = $this->m_inventorycreate->add_total_count_in_line($data_total_count_in_line);
							if ($result_add_total_count_in_line == true) {
								$result_total_count_in = $this->m_inventoryread->list_total_count_in_by_id_inventory($company_id_session, $id_inventory);
								if (count($result_total_count_in)==0) {
									$data_total_count_in = array(
										'company_id' => $company_id_session,
										'id_inventory' => $id_inventory,
										'total_count_in' => $qty_used*1,
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
												'total_count' => $qty_used*1,
												'create_by' => $cNIK_session,
												'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											$result_add_total_count = $this->m_inventorycreate->add_total_count($data_total_count);
											if ($result_add_total_count == true) {
												$status = 1;
												$responseValue = '';
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;
											}
										}
										else {
											$total_count_old = $result_total_count[0]->total_count;
											$total_count_new = ($total_count_old*1)+($qty_used*1);

											$data_total_count = array (
												'total_count' => $total_count_new*1,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
											if ($result_update_total_count == true) {
												$status = 1;
												$responseValue = '';
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;
											}
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;
									}
								}
								else {
									$total_count_in_old = $result_total_count_in[0]->total_count_in;
									$total_count_in_new = ($total_count_in_old*1)+($qty_used*1);
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
												'total_count' => $qty_used*1,
												'create_by' => $cNIK_session,
												'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											$result_add_total_count = $this->m_inventorycreate->add_total_count($data_total_count);
											if ($result_add_total_count == true) {
												$status = 1;
												$responseValue = '';
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;
											}
										}
										else {
											$total_count_old = $result_total_count[0]->total_count;
											$total_count_new = ($total_count_old*1)+($qty_used*1);

											$data_total_count = array (
												'total_count' => $total_count_new*1,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
											if ($result_update_total_count == true) {
												$status = 1;
												$responseValue = '';
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;
											}
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add total count in, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;
									}
								}
							}
							else {
								$status = 0;
								$responseValue = 'Cannot add total count in line, please contact MMI Developer and screen shoot this page. ID Inventory : '.$id_inventory;
							}
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

		public function delete_inventory_img($key_session, $id_inventory_img, $id_inventory){
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
					$id_inventory_img = $this->uri->segment('4');
					//$id_inventory = $this->uri->segment('5');
					$result = $this->m_inventoryread->list_inventory_img_by_id($company_id_session, $id_inventory_img);
					foreach ($result as $resultList){
						$img_name = $resultList->img_name;
						$id_inventory = $resultList->id_inventory;
						unlink(base_url().'assets/images/inventory/'.$img_name);
					}

					$result = $this->m_inventoryupdate->delete_inventory_img($company_id_session, $id_inventory_img);
					if ($result == true) {

						$result_list = $this->m_inventoryread->list_inventory_img($company_id_session, $id_inventory);
						//foreach ($result_list as $resultList_list);
						$id_inventory_img_new = $result_list[0]->id_inventory_img;

						$last_update = date('Y-m-d H:i:s');

						$data = array(
							'set_banner' => 1,
							'last_by' => $cNIK_session,
							'last_update' => $last_update
						);
						$result_update_banner = $this->m_inventoryupdate->update_inventory_img($company_id_session, $id_inventory_img_new, $data);
						if ($result_update_banner == true) {
							$status = 1;
						}
						else {
							$status = 0;
						}
					}
					else {
						$status = 0;
					}
					echo json_encode(array(array('status' => $status, 'id_inventory' => $id_inventory, 'id_inventory_img_new' => $id_inventory_img_new)));
				}
			}
		}

	}
