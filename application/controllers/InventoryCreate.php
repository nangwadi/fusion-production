<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class InventoryCreate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('upload');
			$this->load->database();
	        $this->load->helper('form', 'url');
	        $this->load->model('m_inventoryread');
	        $this->load->model('m_inventorycreate');
	        $this->load->model('m_inventoryupdate');
	        $this->load->model('m_jomread');
	        $this->load->model('m_coaread');
	        $this->load->model('m_essread');
	        $this->load->model('m_distributionread');
	        $this->load->model('m_distributionupdate');
	        $this->load->model('m_distributioncreate');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function add_uom($key_session){
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
					$this->form_validation->set_rules('uom_cd', 'uom_cd', 'required');
					$this->form_validation->set_rules('uom_name', 'uom_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_uom = $this->input->post('id_uom');
						$uom_cd = $this->input->post('uom_cd');
						$uom_name = $this->input->post('uom_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_uom=='') {
							$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd);
							if (count($result_uom)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'uom_cd' => $uom_cd,
									'uom_name' => $uom_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_inventorycreate->add_uom($data);
								if ($result==true) {
									$status = 1;
									$responseValue = 'ok';
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data has already.';
							}
						}
						else { // Update
							$data=array(
								'uom_cd' => $uom_cd,
								'uom_name' => $uom_name,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_class_category($key_session){
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
					$this->form_validation->set_rules('class_category_cd', 'class_category_cd', 'required');
					$this->form_validation->set_rules('class_category_name', 'class_category_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_class_category = $this->input->post('id_class_category');
						$class_category_cd = $this->input->post('class_category_cd');
						$class_category_name = $this->input->post('class_category_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_class_category=='') {
							$result_class_category = $this->m_inventoryread->list_class_category_by_class_category_cd($company_id_session, $class_category_cd);
							if (count($result_class_category)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'class_category_cd' => $class_category_cd,
									'class_category_name' => $class_category_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_inventorycreate->add_class_category($data);
								if ($result==true) {
									$status = 1;
									$responseValue = 'ok';
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data has already.';
							}
						}
						else { // Update
							$data=array(
								'class_category_cd' => $class_category_cd,
								'class_category_name' => $class_category_name,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_warehouse($key_session){
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
					$this->form_validation->set_rules('warehouse_cd', 'warehouse_cd', 'required');
					$this->form_validation->set_rules('warehouse_name', 'warehouse_name', 'required');
					$this->form_validation->set_rules('full_address', 'full_address', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_warehouse = $this->input->post('id_warehouse');
						$warehouse_cd = $this->input->post('warehouse_cd');
						$warehouse_name = $this->input->post('warehouse_name');
						$full_address = $this->input->post('full_address');

						$last_update = date('Y-m-d H:i:s');

						if ($id_warehouse=='') {
							$result_warehouse = $this->m_inventoryread->list_warehouse_by_warehouse_cd($company_id_session, $warehouse_cd);
							if (count($result_warehouse)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'warehouse_cd' => $warehouse_cd,
									'warehouse_name' => $warehouse_name,
									'full_address' => $full_address,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_inventorycreate->add_warehouse($data);
								if ($result==true) {
									$status = 1;
									$responseValue = 'ok';
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data has already.';
							}
						}
						else { // Update
							$data=array(
								'warehouse_cd' => $warehouse_cd,
								'warehouse_name' => $warehouse_name,
								'full_address' => $full_address,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_item_class($key_session){
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
					//$this->form_validation->set_rules('id_item_class', 'id_item_class', 'required');
					$this->form_validation->set_rules('item_class_cd', 'item_class_cd', 'required');
					$this->form_validation->set_rules('item_class_name', 'item_class_name', 'required');
					$this->form_validation->set_rules('kit_assy', 'kit_assy', 'required');
					//$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
					$this->form_validation->set_rules('id_class_category', 'id_class_category', 'required');
					$this->form_validation->set_rules('id_warehouse', 'id_warehouse', 'required');
					$this->form_validation->set_rules('atk_stock', 'atk_stock', 'required');
					$this->form_validation->set_rules('common_stock', 'common_stock', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_item_class  = $this->input->post('id_item_class');
						$item_class_cd  = $this->input->post('item_class_cd');
						$item_class_name  = $this->input->post('item_class_name');
						$kit_assy  = $this->input->post('kit_assy');
						$cIDDept  = $this->input->post('cIDDept');
						$id_class_category  = $this->input->post('id_class_category');
						$id_warehouse  = $this->input->post('id_warehouse');
						$atk_stock  = $this->input->post('atk_stock');
						$common_stock  = $this->input->post('common_stock');

						$last_update = date('Y-m-d H:i:s');

						if ($id_item_class=='') {
							$result_item_class = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd);
							if (count($result_item_class)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'item_class_cd' => strtoupper($item_class_cd),
									'item_class_name' => $item_class_name,
									'kit_assy' => $kit_assy,
									'cIDDept' => $cIDDept,
									'id_class_category' => $id_class_category,
									'id_warehouse' => $id_warehouse,
									'atk_stock' => $atk_stock,
									'common_stock' => $common_stock,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_inventorycreate->add_item_class($data);
								if ($result==true) {
									$status = 1;
									$responseValue = '';
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data has already.';
							}
						}
						else { // Update
							$data=array(
								'item_class_cd' => strtoupper($item_class_cd),
								'item_class_name' => $item_class_name,
								'kit_assy' => $kit_assy,
								'cIDDept' => $cIDDept,
								'id_class_category' => $id_class_category,
								'id_warehouse' => $id_warehouse,
								'atk_stock' => $atk_stock,
								'common_stock' => $common_stock,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventoryupdate->update_item_class($data, $company_id_session, $id_item_class);
							if ($result==true) {
								$result_item_class = $this->m_inventoryread->list_item_class($company_id_session, $id_item_class);
								$status = 1;
								$responseValue = $result_item_class;
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

		// Input

		public function add_group($key_session){
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
					$this->form_validation->set_rules('group_cd', 'group_cd', 'required');
					$this->form_validation->set_rules('group_name', 'group_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_inv_group = $this->input->post('id_inv_group');
						$group_cd = $this->input->post('group_cd');
						$group_name = $this->input->post('group_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_inv_group=='0') {
							$result_group = $this->m_inventoryread->list_group_by_group_cd($company_id_session, $group_cd);
							if (count($result_group)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'group_cd' => strtoupper($group_cd),
									'group_name' => strtoupper($group_name),
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_inventorycreate->add_group($data);
								if ($result==true) {
									$status = 1;
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data has already.';
							}
						}
						else { // Update
							$data=array(
								'group_cd' => strtoupper($group_cd),
								'group_name' => strtoupper($group_name),
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventoryupdate->update_group($data, $company_id_session, $id_inv_group);
							if ($result==true) {
								$result_id_inv_group = $this->m_inventoryread->list_group($company_id_session, $id_inv_group);
								$status = 1;
								$responseValue = $result_id_group;
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

		public function add_inventory_group_img($key_session){
			//error_reporting(10);
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
					$id_inv_group = $this->input->post('id_inv_group');
					$banner_inside = $this->input->post('banner_inside');
					
					$upload_path = './assets/images/inventory';
					$permitted_chars_file = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$last_update = date('Y-m-d H:i:s');
					
					$name = $_FILES['img_name']['name'];
					$ext = end((explode('.', $name)));
					$allowed_ext = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');

					$result_img = $this->m_inventoryread->list_group($company_id_session, $id_inv_group);
					foreach ($result_img as $resultList_img);
					$img_banner = $resultList_img->img_banner;
					$img_inside = $resultList_img->img_inside;

					if ($banner_inside == 1) {
						if ($img_banner == null) {
							if (in_array($ext, $allowed_ext)) {
								$img_name =  substr(str_shuffle($permitted_chars_file), 0, 8).'.'.$ext ;
								$tmp_name = $_FILES['img_name']['tmp_name'];
								if(move_uploaded_file($tmp_name, $upload_path.'/'.$img_name)){
									$status = 1;
									$data = array(
										'img_banner' => $img_name,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									$result = $this->m_inventoryupdate->update_group($data, $company_id_session, $id_inv_group);
									if ($result == true) {
										$status = 1;
									}
									else {
										$status = 0; // img cannot update in database
										unlink(base_url().'assets/images/inventory/'.$img_name);
									}
								}
								else {
									$status = 3; // Img cannot save to path
								}
							}
							else {
								$status = 2; // Img ext not allow
							}
						}
						else {
							if (unlink($upload_path.'/'.$img_banner)) {
								if (in_array($ext, $allowed_ext)) {
									$img_name =  substr(str_shuffle($permitted_chars_file), 0, 8).'.'.$ext ;
									$tmp_name = $_FILES['img_name']['tmp_name'];
									if(move_uploaded_file($tmp_name, $upload_path.'/'.$img_name)){
										$status = 1;
										$data = array(
											'img_banner' => $img_name,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										$result = $this->m_inventoryupdate->update_group($data, $company_id_session, $id_inv_group);
										if ($result == true) {
											$status = 1;
										}
										else {
											$status = 0; // img cannot update in database
											unlink(base_url().'assets/images/inventory/'.$img_name);
										}
									}
									else {
										$status = 3; // Img cannot save to path
									}
								}
								else {
									$status = 2; // Img ext not allow
								}
							}
							else {
								$status = 4;
							}
						}
					}
					else {
						if ($img_inside == null) {
							if (in_array($ext, $allowed_ext)) {
								$img_name =  substr(str_shuffle($permitted_chars_file), 0, 8).'.'.$ext ;
								$tmp_name = $_FILES['img_name']['tmp_name'];
								if(move_uploaded_file($tmp_name, $upload_path.'/'.$img_name)){
									$status = 1;
									$data = array(
										'img_inside' => $img_name,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									$result = $this->m_inventoryupdate->update_group($data, $company_id_session, $id_inv_group);
									if ($result == true) {
										$status = 1;
									}
									else {
										$status = 0; // img cannot update in database
										unlink(base_url().'assets/images/inventory/'.$img_name);
									}
								}
								else {
									$status = 3; // Img cannot save to path
								}
							}
							else {
								$status = 2; // Img ext not allow
							}
						}
						else {
							if (unlink($upload_path.'/'.$img_inside)) {
								if (in_array($ext, $allowed_ext)) {
									$img_name =  substr(str_shuffle($permitted_chars_file), 0, 8).'.'.$ext ;
									$tmp_name = $_FILES['img_name']['tmp_name'];
									if(move_uploaded_file($tmp_name, $upload_path.'/'.$img_name)){
										$status = 1;
										$data = array(
											'img_inside' => $img_name,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										$result = $this->m_inventoryupdate->update_group($data, $company_id_session, $id_inv_group);
										if ($result == true) {
											$status = 1;
										}
										else {
											$status = 0; // img cannot update in database
											unlink(base_url().'assets/images/inventory/'.$img_name);
										}
									}
									else {
										$status = 3; // Img cannot save to path
									}
								}
								else {
									$status = 2; // Img ext not allow
								}
							}
							else {
								$status = 4;
							}
						}
					}
					echo json_encode(array(array('status' => $status, 'ext' => $ext)));
				}

			}
		}

		public function add_maker($key_session){
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
					$this->form_validation->set_rules('maker_cd', 'maker_cd', 'required');
					$this->form_validation->set_rules('maker_name', 'maker_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_inv_maker = $this->input->post('id_inv_maker');
						$maker_cd = $this->input->post('maker_cd');
						$maker_name = $this->input->post('maker_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_inv_maker=='0') {
							$result_maker = $this->m_inventoryread->list_maker_by_maker_cd($company_id_session, $maker_cd);
							if (count($result_maker)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'maker_cd' => strtoupper($maker_cd),
									'maker_name' => strtoupper($maker_name),
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_inventorycreate->add_maker($data);
								if ($result==true) {
									$status = 1;
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data has already.';
							}
						}
						else { // Update
							$data=array(
								'maker_cd' => strtoupper($maker_cd),
								'maker_name' => strtoupper($maker_name),
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventoryupdate->update_maker($data, $company_id_session, $id_inv_maker);
							if ($result==true) {
								$result_id_inv_maker = $this->m_inventoryread->list_maker($company_id_session, $id_inv_maker);
								$status = 1;
								$responseValue = $result_id_maker;
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

		public function add_inventory($key_session){
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
					//$this->form_validation->set_rules('id_item_class', 'id_item_class', 'required');
					$this->form_validation->set_rules('inventory_cd', 'inventory_cd', 'required');
					$this->form_validation->set_rules('inventory_name', 'inventory_name', 'required');
					$this->form_validation->set_rules('id_sub_tax', 'id_sub_tax', 'required');
					$this->form_validation->set_rules('id_uom', 'id_uom', 'required');
					$this->form_validation->set_rules('id_coa', 'id_coa', 'required');
					//$this->form_validation->set_rules('id_inv_maker', 'id_inv_maker', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_inventory = $this->input->post('id_inventory');
						$inventory_cd = $this->input->post('inventory_cd');
						$inventory_name = $this->input->post('inventory_name');
						$id_item_class_post = $this->input->post('id_item_class');
						$id_sub_tax_post = $this->input->post('id_sub_tax');
						$id_uom_post = $this->input->post('id_uom');
						$id_coa_post = $this->input->post('id_coa');
						$id_inv_maker = $this->input->post('id_inv_maker');
						$id_inv_group = $this->input->post('id_inv_group');

						$id_item_class_exp = explode(' // ', $id_item_class_post);
						$item_class_cd = $id_item_class_exp[0];
						$result_item_class_by_item_class_cd = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd);
						$id_item_class = $result_item_class_by_item_class_cd[0]->id_item_class;

						$id_sub_tax_exp = explode(' // ', $id_sub_tax_post);
						$sub_tax_cd = $id_sub_tax_exp[0];
						$result_sub_tax_by_sub_tax_cd = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd);
						$id_sub_tax = $result_sub_tax_by_sub_tax_cd[0]->id_sub_tax;

						$id_uom_exp = explode(' // ', $id_uom_post);
						$uom_cd = $id_uom_exp[0];
						$result_uom_by_uom_cd = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd);
						$id_uom = $result_uom_by_uom_cd[0]->id_uom;

						$id_coa_exp = explode(' // ', $id_coa_post);
						$coa_cd = $id_coa_exp[0];
						$result_coa_by_coa_cd = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd);
						$id_coa = $result_coa_by_coa_cd[0]->id_coa;

						$last_update = date('Y-m-d H:i:s');

						if ($id_inventory=='0') {
							$result_inventory = $this->m_inventoryread->list_inventory_by_inventory_cd($company_id_session, $inventory_cd);
							if (count($result_inventory)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'inventory_id_acumatica' => 0,
									'id_item_class' => $id_item_class,
									'inventory_cd' => strtoupper($inventory_cd),
									'inventory_name' => strtoupper($inventory_name),
									'id_sub_tax' => $id_sub_tax,
									'id_uom' => $id_uom,
									'id_coa' => $id_coa,
									'id_inv_maker' => $id_inv_maker,
									'id_inv_group' => $id_inv_group,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_inventorycreate->add_inventory($data);
								if ($result==true) {
									if ($id_inventory=='') {
										$responseValue = 'ok';
									}
									else {
										$result_inventory = $this->m_inventoryread->list_inventory($company_id_session, $id_inventory);
										$responseValue = $result_inventory;
									}
									$status = 1;
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data has already.';
							}
						}
						else { // Update
							$data=array(
								'id_item_class' => $id_item_class,
								'inventory_cd' => strtoupper($inventory_cd),
								'inventory_name' => strtoupper($inventory_name),
								'id_sub_tax' => $id_sub_tax,
								'id_uom' => $id_uom,
								'id_coa' => $id_coa,
								'id_inv_maker' => $id_inv_maker,
								'id_inv_group' => $id_inv_group,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventoryupdate->update_inventory($company_id_session, $id_inventory, $data);
							if ($result==true) {
								$result_id_inventory = $this->m_inventoryread->list_inventory($company_id_session, $id_inventory);
								$status = 1;
								$responseValue = $result_id_inventory;
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

		public function add_inventory_img($key_session){
			//error_reporting(10);
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
					$id_inventory = $this->input->post('id_inventory');

					$check_banner = $this->m_inventoryread->list_inventory_img_banner($company_id_session, $id_inventory);
					$set_banner = 0;
					if (count($check_banner) == 0) {
						$set_banner = 1;
					}

					$last_update = date('Y-m-d H:i:s');

					$upload_path = './assets/images/inventory';
					$permitted_chars_file = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

					$name = $_FILES['img_name']['name'];
					$ext = end((explode('.', $name)));
					$allowed_ext = array('jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG');

					if (in_array($ext, $allowed_ext)) {
						$img_name =  substr(str_shuffle($permitted_chars_file), 0, 8).'.'.$ext ;
						$tmp_name = $_FILES['img_name']['tmp_name'];
						if(move_uploaded_file($tmp_name, $upload_path.'/'.$img_name)){
							$status = 1;
							$data = array(
								'company_id' => $company_id_session,
								'id_inventory' => $id_inventory,
								'img_name' => $img_name,
								'set_banner' => $set_banner,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventorycreate->add_inventory_img($data);
							if ($result == true) {
								$status = 1;
							}
							else {
								$status = 0;
								unlink(base_url().'assets/images/inventory/'.$img_name);
							}
						}
						else {
							$status = 3;
						}
					}
					else {
						$status = 2;
					}
					echo json_encode(array(array('status' => $status, 'ext' => $ext)));
				}

			}
		}

		public function add_return($key_session){
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
					$this->form_validation->set_rules('id_total_count_in_line', 'id_total_count_in_line', 'required');
					$this->form_validation->set_rules('id_purchase_receipt_line', 'id_purchase_receipt_line', 'required');
					$this->form_validation->set_rules('qty_used', 'qty_used', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						//$status=1;
						$id_total_count_in_line = $this->input->post('id_total_count_in_line');
						$id_purchase_receipt_line = $this->input->post('id_purchase_receipt_line');
						$qty_used = $this->input->post('qty_used');

						$result_company = $this->m_essread->list_company($company_id_session);
						$company_code = $result_company[0]->company_code;

						$year = date('Y');
						$result_return_count = $this->m_inventoryread->list_return_by_year($company_id_session, $year);
						$return_number_before = sprintf("%06d", ((count($result_return_count))+1));
						$return_number = 'RT/'.$company_code.'/'.$year.'-'.$return_number_before;

						$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line_by_id_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
						foreach ($result_purchase_receipt_line as $resultListLine);
						$purchase_order_number = $resultListLine->purchase_order_number;
						$purchase_receipt_number = $resultListLine->purchase_receipt_number;
						$id_purchase_order_line = $resultListLine->id_purchase_order_line;
						$id_inventory = $resultListLine->id_inventory;
						$id_part_list = $resultListLine->id_part_list;
						$description = $resultListLine->description;
						$purchase_receipt_line_qty = $resultListLine->purchase_receipt_line_qty;
						$uom_cd = $resultListLine->uom_cd;
						$cury_unit_price = $resultListLine->cury_unit_price;
						$id_coa_currency = $resultListLine->id_coa_currency;
						$amount = $qty_used*$cury_unit_price;

						// View Module by Module Code
						$list_module_by_module_cd = $this->m_distributionread->list_module_by_module_cd($company_id_session, 'PO');
						$id_module = $list_module_by_module_cd[0]->id_module;	

						// Update qty purchase receipt on purchase order and update purchase order header to open
						$result_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
						$sequence_old = $result_purchase_order[0]->sequence;
						$sequence_back = $sequence_old-1;

						$result_transaction_role_sequence_back = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_back);
						$id_transaction_role_back = $result_transaction_role_sequence_back[0]->id_transaction_role;

						// View Purchase Order Line
						$result_purchase_order_line = $this->m_distributionread->list_purchase_order_line($company_id_session, $id_purchase_order_line);
						$purchase_order_line_qty_purchase_receipt_old = $result_purchase_order_line[0]->purchase_order_line_qty_purchase_receipt;
						$purchase_order_line_qty_purchase_receipt = $purchase_order_line_qty_purchase_receipt_old-$qty_used;

						$last_update = date('Y-m-d H:i:s');

						$data_add_return = array(
							'company_id' => $company_id_session,
							'return_number' => $return_number,
							'year' => $year,
							'id_total_count_in_line' => $id_total_count_in_line,
							'purchase_receipt_number' => $purchase_receipt_number,
							'id_inventory' => $id_inventory*1,
							'id_part_list' => $id_part_list*1,
							'description' => $description,
							'qty' => $qty_used*1,
							'uom_cd' => $uom_cd,
							'unit_price' => $cury_unit_price*1,
							'amount' => $amount*1,
							'id_coa_currency' => $id_coa_currency,
							'create_by' => $cNIK_session,
							'create_date' => $last_update,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
							'deleted' => 0
						);

						$result_add_return = $this->m_inventorycreate->add_return($data_add_return);
						if ($result_add_return == true) {
							//$status = 1;
							// Check Qty return
							if ($qty_used==$purchase_receipt_line_qty) { // If qty return equal qty receipt
								// Check line purchase receipt
								$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_purchase_receipt_number($company_id_session, $purchase_receipt_number);
								$total_line = $result_purchase_receipt[0]->total_line;
								if ($total_line==1) { // If total line equal 1 
									// Delete purchase receipt header
									$data_purchase_receipt_header = array(
										'deleted' => 1,
										'last_by' => $cNIK_session,
										'last_update' => $last_update
									);
									$result_update_purchase_receipt_header = $this->m_distributionupdate->update_purchase_receipt_by_purchase_receipt_number($company_id_session, $data_purchase_receipt_header, $purchase_receipt_number);
									if ($result_update_purchase_receipt_header == true) {
										// Delete purchase receipt line
										$data_purchase_receipt_line_update = array(
											'deleted' => 1,
											'last_by' => $cNIK_session,
											'last_update' => $last_update
										);
										$result_delete_purchase_receipt_line = $this->m_distributionupdate->update_purchase_receipt_line($company_id_session, $data_purchase_receipt_line_update, $id_purchase_receipt_line);
										if ($result_delete_purchase_receipt_line == true) {
											// Set PO status to Open
											$data_purchase_order_header = array(
												'id_transaction_role' => $id_transaction_role_back,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_purchase_order_header = $this->m_distributionupdate->update_purchase_order_by_purchase_order_number($company_id_session, $data_purchase_order_header, $purchase_order_number);
											if ($result_purchase_order_header == true) {
												$data_purchase_order_line = array(
													'purchase_order_line_qty_purchase_receipt' => $purchase_order_line_qty_purchase_receipt,
													'line_status' => 0,
													'last_by' => $cNIK_session,
													'last_update' => $last_update
												);
												$result_purchase_order_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_purchase_order_line, $id_purchase_order_line);
												if ($result_purchase_order_line == true) {
													$result_total_count_out = $this->m_inventoryread->list_total_count_out_by_id_inventory($company_id_session, $id_inventory);
													$total_count_out_old = $result_total_count_out[0]->total_count_out;
													$total_count_out = ($total_count_out_old*1)+($qty_used*1);
													$data_total_count_out = array(
														'total_count_out' => $total_count_out,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
													if ($result_total_count_out_update == true) {
														$data_total_count_out_line = array(
															'company_id' => $company_id_session,
															'category' => 'return',
															'id_total_count_in_line' => $id_total_count_in_line,
															'id_inventory' => $id_inventory,
															'qty_out' => $qty_used,
															'deleted' => 0,
															'create_by' => $cNIK_session,
															'create_date' => $last_update,
															'last_by' => $cNIK_session,
															'last_update' => $last_update,
														);
														$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
														if ($result_total_count_out_line_add == true) {
															$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
															$total_count_old = $result_total_count[0]->total_count;
															$total_count_new = ($total_count_old*1)-($qty_used*1);

															$data_total_count = array (
																'total_count' => $total_count_new,
																'last_by' => $cNIK_session,
																'last_update' => $last_update
															);
															$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
															if ($result_update_total_count == true) {
																$status = 1;
																$responseValue = '';
															}
															else {
																$status = 0;
																$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
															}
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														}
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot update purchase order line, please contact MMI Developer with screen shoot this page. ID Purchase Order Line : '.$id_purchase_order_line;
												}
											}
											else {
												$status = 0;
												$responseValue = 'Cannot update purchase order header, please contact MMI Developer with screen shoot this page. Purchase Order Number : '.$purchase_order_number;
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot update purchase receipt line, please contact MMI Developer with screen shoot this page. Receipt Line ID : '.$id_purchase_receipt_line;
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot update purchase receipt header, please contact MMI Developer with screen shoot this page. Receipt Number : '.$purchase_receipt_number;
									}
								}
								else {
									// Delete purchase receipt line only
									$data_purchase_receipt_line_update = array(
										'deleted' => 1,
										'last_by' => $cNIK_session,
										'last_update' => $last_update
									);
									$result_delete_purchase_receipt_line = $this->m_distributionupdate->update_purchase_receipt_line($company_id_session, $data_purchase_receipt_line_update, $id_purchase_receipt_line);
									if ($result_delete_purchase_receipt_line == true) {
										// Set PO status to Open
										$data_purchase_order_header = array(
											'id_transaction_role' => $id_transaction_role_back,
											'last_by' => $cNIK_session,
											'last_update' => $last_update
										);
										$result_purchase_order_header = $this->m_distributionupdate->update_purchase_order_by_purchase_order_number($company_id_session, $data_purchase_order_header, $purchase_order_number);
										if ($result_purchase_order_header == true) {
											$data_purchase_order_line = array(
												'purchase_order_line_qty_purchase_receipt' => $purchase_order_line_qty_purchase_receipt,
												'line_status' => 0,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_purchase_order_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_purchase_order_line, $id_purchase_order_line);
											if ($result_purchase_order_line == true) {
												$result_total_count_out = $this->m_inventoryread->list_total_count_out_by_id_inventory($company_id_session, $id_inventory);
												$total_count_out_old = $result_total_count_out[0]->total_count_out;
												$total_count_out = ($total_count_out_old*1)+($qty_used*1);
												$data_total_count_out = array(
													'total_count_out' => $total_count_out,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
												if ($result_total_count_out_update == true) {
													$data_total_count_out_line = array(
														'company_id' => $company_id_session,
														'category' => 'return',
														'id_total_count_in_line' => $id_total_count_in_line,
														'id_inventory' => $id_inventory,
														'qty_out' => $qty_used,
														'deleted' => 0,
														'create_by' => $cNIK_session,
														'create_date' => $last_update,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
													if ($result_total_count_out_line_add == true) {
														$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
														$total_count_old = $result_total_count[0]->total_count;
														$total_count_new = ($total_count_old*1)-($qty_used*1);

														$data_total_count = array (
															'total_count' => $total_count_new,
															'last_by' => $cNIK_session,
															'last_update' => $last_update
														);
														$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
														if ($result_update_total_count == true) {
															$status = 1;
															$responseValue = '';
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														}
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
												}
											}
											else {
												$status = 0;
												$responseValue = 'Cannot update purchase order line, please contact MMI Developer with screen shoot this page. ID Purchase Order Line : '.$id_purchase_order_line;
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot update purchase order header, please contact MMI Developer with screen shoot this page. Purchase Order Number : '.$purchase_order_number;
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot update purchase receipt line, please contact MMI Developer with screen shoot this page. Receipt Line ID : '.$id_purchase_receipt_line;
									}
								}
							}
							else {
								// Update qty purchase receipt
								$purchase_receipt_line_qty_new = $purchase_receipt_line_qty-$qty_used;
								$data_purchase_receipt_line = array(
									'purchase_receipt_line_qty' => $purchase_receipt_line_qty_new*1,
									'last_by' => $cNIK_session,
									'last_update' => $last_update
								);
								$result_update_purchase_receipt_line = $this->m_distributionupdate->update_purchase_receipt_line($company_id_session, $data_purchase_receipt_line, $id_purchase_receipt_line);
								if ($result_update_purchase_receipt_line == true) {
									// Set PO status to Open
									$data_purchase_order_header = array(
										'id_transaction_role' => $id_transaction_role_back,
										'last_by' => $cNIK_session,
										'last_update' => $last_update
									);
									$result_purchase_order_header = $this->m_distributionupdate->update_purchase_order_by_purchase_order_number($company_id_session, $data_purchase_order_header, $purchase_order_number);
									if ($result_purchase_order_header == true) {
										$data_purchase_order_line = array(
											'purchase_order_line_qty_purchase_receipt' => $purchase_order_line_qty_purchase_receipt,
											'line_status' => 0,
											'last_by' => $cNIK_session,
											'last_update' => $last_update
										);
										$result_purchase_order_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $id_purchase_order_line);
										if ($result_purchase_order_line == true) {
											$total_count_out_old = $result_total_count_out[0]->total_count_out;
											$total_count_out = ($total_count_out_old*1)+($qty_used*1);
											$data_total_count_out = array(
												'total_count_out' => $total_count_out,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
											if ($result_total_count_out_update == true) {
												$data_total_count_out_line = array(
													'company_id' => $company_id_session,
													'category' => 'return',
													'id_total_count_in_line' => $id_total_count_in_line,
													'id_inventory' => $id_inventory,
													'qty_out' => $qty_used,
													'deleted' => 0,
													'create_by' => $cNIK_session,
													'create_date' => $last_update,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
												if ($result_total_count_out_line_add == true) {
													$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
													$total_count_old = $result_total_count[0]->total_count;
													$total_count_new = ($total_count_old*1)-($qty_used*1);
													$data_total_count = array (
														'total_count' => $total_count_new,
														'last_by' => $cNIK_session,
														'last_update' => $last_update
													);
													$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
													if ($result_update_total_count == true) {
														$status = 1;
														$responseValue = '';
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
												}
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot update purchase order line, please contact MMI Developer with screen shoot this page. ID Purchase Order Line : '.$id_purchase_order_line;
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot update purchase order header, please contact MMI Developer with screen shoot this page. Purchase Order Number : '.$purchase_order_number;
									}
								}
								else {
									$status = 0;
									$responseValue = 'Cannot update purchase receipt line, please contact MMI Developer with screen shoot this page. Receipt Line ID : '.$id_purchase_receipt_line;
								}
							}							
						}
						else {
							$status = 0;
							$responseValue = 'Cannot add return data, please try again.';
						}

					}
					echo json_encode(array(array(
						'status' => $status,
						'response' => $responseValue
					)));
				}
			}
		}

		public function add_kit_assy($key_session){
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
					$this->form_validation->set_rules('id_purchase_receipt_line_array', 'id_purchase_receipt_line_array', 'required');
					$this->form_validation->set_rules('qty_used_array', 'qty_used_array', 'required');
					$this->form_validation->set_rules('count_after', 'count_after', 'required');
					$this->form_validation->set_rules('JobNo', 'JobNo', 'required');

					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$status_array = array();
						$id_purchase_receipt_line_array  = $this->input->post('id_purchase_receipt_line_array');
						$qty_used_array  = $this->input->post('qty_used_array');
						$count_after  = $this->input->post('count_after');
						$JobNo  = $this->input->post('JobNo');

						$last_update = date('Y-m-d H:i:s');
						$year = date('Y');

						$result_company = $this->m_essread->list_company($company_id_session);
						$company_code = $result_company[0]->company_code;

						$result_job_order_by_job_no = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);
						$id_job_order = $result_job_order_by_job_no[0]->id_job_order;

						// Cek Qty Line
						if ($count_after==1) { // Jika Qty = 1
							$id_purchase_receipt_line = $id_purchase_receipt_line_array;
							$qty_used = $qty_used_array;

							$result_total_count_in_line = $this->m_inventoryread->list_total_count_in_line_by_id_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
							$id_total_count_in_line = $result_total_count_in_line[0]->id_total_count_in_line;

							$result_kit_assy_by_jobno = $this->m_inventoryread->list_kit_assy_by_jobno($company_id_session, $JobNo);
							if (count($result_kit_assy_by_jobno)==0) { // Create New Kit Assy
								$result_kit_assy_year = $this->m_inventoryread->list_kit_assy_by_year($company_id_session, $year);
								$next_number = count($result_kit_assy_year)+1;
								$next_number_add_zerro = sprintf("%05d", $next_number);
								$kit_assy_number = "KA/".$company_code."/".$year."-".$next_number_add_zerro;

								$data_kit_assy_header = array(
									'company_id' => $company_id_session,
									'kit_assy_number' => $kit_assy_number,
									'id_job_order' => $id_job_order,
									'total_amount' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
									'deleted' => 0
								);

								$result_add_kit_assy_header = $this->m_inventorycreate->add_kit_assy($data_kit_assy_header);
								if ($result_add_kit_assy_header == true) {

									$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
									foreach ($result_purchase_receipt_line as $resultListLine);
									$id_part_list = $resultListLine->id_part_list;
									$id_inventory = $resultListLine->id_inventory;
									$uom_cd = $resultListLine->uom_cd;
									$cury_unit_price = $resultListLine->cury_unit_price;
									$amount = $qty_used*$cury_unit_price;

									$data_kit_assy_line = array(
										'company_id' => $company_id_session,
										'kit_assy_number' => $kit_assy_number,
										'id_part_list' => $id_part_list,
										'id_purchase_receipt_line' => $id_purchase_receipt_line,
										'qty_used' => $qty_used*1,
										'uom_cd' => $uom_cd,
										'unit_price' => $cury_unit_price*1,
										'amount' => $amount,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
										'deleted' => 0
									);

									$result_add_kit_assy_line = $this->m_inventorycreate->add_kit_assy_line($data_kit_assy_line);
									if ($result_add_kit_assy_line == true) {
										$data_kit_assy_header_for_update = array(
											'total_amount' => $amount,
											'last_by' => $cNIK_session,
											'last_update' => $last_update
										);
										$result_update_kit_assy_header = $this->m_inventoryupdate->update_kit_assy($company_id_session, $data_kit_assy_header_for_update, $kit_assy_number);
										if ($result_update_kit_assy_header == true) {
											$result_total_count_out = $this->m_inventoryread->list_total_count_out_by_id_inventory($company_id_session, $id_inventory);
											if (count($result_total_count_out)==0) { // New Total Count Out
												$data_total_count_out = array(
													'company_id' => $company_id_session,
													'id_inventory' => $id_inventory,
													'total_count_out' => $qty_used,
													'create_by' => $cNIK_session,
													'create_date' => $last_update,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												$result_total_count_out_add = $this->m_inventorycreate->add_total_count_out($data_total_count_out);
												if ($result_total_count_out_add == true) {
													$data_total_count_out_line = array(
														'company_id' => $company_id_session,
														'category' => 'kit-assy',
														'id_total_count_in_line' => $id_total_count_in_line,
														'id_inventory' => $id_inventory,
														'qty_out' => $qty_used,
														'deleted' => 0,
														'create_by' => $cNIK_session,
														'create_date' => $last_update,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
													if ($result_total_count_out_line_add == true) {
														$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
														$total_count_old = $result_total_count[0]->total_count;
														$total_count_new = ($total_count_old*1)-($qty_used*1);
														$data_total_count = array (
															'total_count' => $total_count_new,
															'last_by' => $cNIK_session,
															'last_update' => $last_update
														);
														$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
														if ($result_update_total_count == true) {
															$status = 1;
															$responseValue = '';
															array_push($status_array, $status);
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
															array_push($status_array, $status);
														}
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														array_push($status_array, $status);
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													array_push($status_array, $status);
												}
											}
											else { // Update Total Count Out by Inventory ID
												$total_count_out_old = $result_total_count_out[0]->total_count_out;
												$total_count_out = ($total_count_out_old*1)+($qty_used*1);
												$data_total_count_out = array(
													'total_count_out' => $total_count_out,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
												if ($result_total_count_out_update == true) {
													$data_total_count_out_line = array(
														'company_id' => $company_id_session,
														'category' => 'kit-assy',
														'id_total_count_in_line' => $id_total_count_in_line,
														'id_inventory' => $id_inventory,
														'qty_out' => $qty_used,
														'deleted' => 0,
														'create_by' => $cNIK_session,
														'create_date' => $last_update,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
													if ($result_total_count_out_line_add == true) {
														$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
														$total_count_old = $result_total_count[0]->total_count;
														$total_count_new = ($total_count_old*1)-($qty_used*1);

														$data_total_count = array (
															'total_count' => $total_count_new,
															'last_by' => $cNIK_session,
															'last_update' => $last_update
														);
														$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
														if ($result_update_total_count == true) {
															$status = 1;
															$responseValue = '';
															array_push($status_array, $status);
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
															array_push($status_array, $status);
														}
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														array_push($status_array, $status);
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													array_push($status_array, $status);
												}
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot update kit assy header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
											array_push($status_array, $status);
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add kit assy line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
										array_push($status_array, $status);
									}
								}
								else {
									$status = 0;
									$responseValue = 'Cannot add kit assy header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
									array_push($status_array, $status);
								}
							}
							else { // Update Kit Assy
								$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
								foreach ($result_purchase_receipt_line as $resultListLine);
								$id_part_list = $resultListLine->id_part_list;
								$uom_cd = $resultListLine->uom_cd;
								$cury_unit_price = $resultListLine->cury_unit_price;
								$amount = $qty_used*$cury_unit_price;

								$data_kit_assy_line = array(
									'company_id' => $company_id_session,
									'kit_assy_number' => $kit_assy_number,
									'id_part_list' => $id_part_list,
									'id_purchase_receipt_line' => $id_purchase_receipt_line,
									'qty_used' => $qty_used*1,
									'uom_cd' => $uom_cd,
									'unit_price' => $cury_unit_price*1,
									'amount' => $amount,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
									'deleted' => 0
								);

								$result_add_kit_assy_line = $this->m_inventorycreate->add_kit_assy_line($data_kit_assy_line);
								if ($result_add_kit_assy_line == true) {
									$kit_assy_number = $result_kit_assy_by_jobno[0]->kit_assy_number;
									$data_kit_assy_header_for_update = array(
										'total_amount' => $amount,
										'last_by' => $cNIK_session,
										'last_update' => $last_update
									);
									$result_update_kit_assy_header = $this->m_inventoryupdate->update_kit_assy($company_id_session, $data_kit_assy_header_for_update, $kit_assy_number);
									if ($result_update_kit_assy_header == true) {
										$data_total_count_out_line = array(
											'company_id' => $company_id_session,
											'category' => 'kit-assy',
											'id_total_count_in_line' => $id_total_count_in_line,
											'id_inventory' => $id_inventory,
											'qty_out' => $qty_used,
											'deleted' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
										if ($result_total_count_out_line_add == true) {
											$result_total_count_out = $this->m_inventoryread->list_total_count_out_by_id_inventory($company_id_session, $id_inventory);
											if (count($result_total_count_out)==0) {
												$data_total_count_out = array(
													'company_id' => $company_id_session,
													'id_inventory' => $id_inventory,
													'total_count_out' => $qty_used*1,
													'create_by' => $cNIK_session,
													'create_date' => $last_update,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												$result_total_count_out_add = $this->m_inventorycreate->add_total_count_out($data_total_count_out);
												if ($result_total_count_out_add == true) {
													$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
													$total_count_old = $result_total_count[0]->total_count;
													$total_count_new = ($total_count_old*1)-($qty_used*1);
													$data_total_count = array (
														'total_count' => $total_count_new,
														'last_by' => $cNIK_session,
														'last_update' => $last_update
													);
													$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
													if ($result_update_total_count == true) {
														$status = 1;
														$responseValue = '';
														array_push($status_array, $status);
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														array_push($status_array, $status);
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot add total count out, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													array_push($status_array, $status);
												}
											}
											else {
												$total_count_out_old = $result_total_count_out[0]->total_count_out;
												$total_count_out = ($total_count_out_old*1)+($qty_used*1);
												$data_total_count_out = array(
													'total_count_out' => $total_count_out,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
												if ($result_total_count_out_update == true) {
													$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
													$total_count_old = $result_total_count[0]->total_count;
													$total_count_new = ($total_count_old*1)-($qty_used*1);
													$data_total_count = array (
														'total_count' => $total_count_new,
														'last_by' => $cNIK_session,
														'last_update' => $last_update
													);
													$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
													if ($result_update_total_count == true) {
														$status = 1;
														$responseValue = '';
														array_push($status_array, $status);
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														array_push($status_array, $status);
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													array_push($status_array, $status);
												}
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
											array_push($status_array, $status);
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot update kit assy header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
										array_push($status_array, $status);
									}
								}
								else {
									$status = 0;
									$responseValue = 'Cannot add kit assy line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
									array_push($status_array, $status);
								}
							}
						}
						else { // Jika Qty > 1
							$result_kit_assy_by_jobno = $this->m_inventoryread->list_kit_assy_by_jobno($company_id_session, $JobNo);
							if (count($result_kit_assy_by_jobno)==0) {
								$result_kit_assy_year = $this->m_inventoryread->list_kit_assy_by_year($company_id_session, $year);
								$next_number = count($result_kit_assy_year)+1;
								$next_number_add_zerro = sprintf("%05d", $next_number);
								$kit_assy_number = "KA/".$company_code."/".$year."-".$next_number_add_zerro;
								$data_kit_assy_header = array(
									'company_id' => $company_id_session,
									'kit_assy_number' => $kit_assy_number,
									'id_job_order' => $id_job_order,
									'total_amount' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
									'deleted' => 0
								);
								$result_add_kit_assy_header = $this->m_inventorycreate->add_kit_assy($data_kit_assy_header);
								if ($result_add_kit_assy_header == true) {
									$id_purchase_receipt_line_exp = explode(',', $id_purchase_receipt_line_array);
									$qty_used_exp = explode(',', $qty_used_array);
									for ($i=0; $i < count($id_purchase_receipt_line_exp); $i++) { 
										$id_purchase_receipt_line = $id_purchase_receipt_line_exp[$i];
										$qty_used = $qty_used_exp[$i];

										$result_total_count_in_line = $this->m_inventoryread->list_total_count_in_line_by_id_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
										$id_total_count_in_line = $result_total_count_in_line[0]->id_total_count_in_line;

										$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
										foreach ($result_purchase_receipt_line as $resultListLine);
										$id_part_list = $resultListLine->id_part_list;
										$id_inventory = $resultListLine->id_inventory;
										$uom_cd = $resultListLine->uom_cd;
										$cury_unit_price = $resultListLine->cury_unit_price;
										$amount = $qty_used*$cury_unit_price;

										$data_kit_assy_line = array(
											'company_id' => $company_id_session,
											'kit_assy_number' => $kit_assy_number,
											'id_part_list' => $id_part_list,
											'id_purchase_receipt_line' => $id_purchase_receipt_line,
											'qty_used' => $qty_used*1,
											'uom_cd' => $uom_cd,
											'unit_price' => $cury_unit_price*1,
											'amount' => $amount,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
											'deleted' => 0
										);
										$result_add_kit_assy_line = $this->m_inventorycreate->add_kit_assy_line($data_kit_assy_line);
										if ($result_add_kit_assy_line == true) {
											$result_kit_assy_by_jobno = $this->m_inventoryread->list_kit_assy_by_jobno($company_id_session, $JobNo);
											$amount_db = $result_kit_assy_by_jobno[0]->total_amount;
											$amount_new = ($amount_db*1)+($amount*1);
											$data_kit_assy_header_for_update = array(
												'total_amount' => $amount_new,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_kit_assy_header = $this->m_inventoryupdate->update_kit_assy($company_id_session, $data_kit_assy_header_for_update, $kit_assy_number);
											if ($result_update_kit_assy_header == true) {
												$data_total_count_out_line = array(
													'company_id' => $company_id_session,
													'category' => 'kit-assy',
													'id_total_count_in_line' => $id_total_count_in_line,
													'id_inventory' => $id_inventory,
													'qty_out' => $qty_used,
													'deleted' => 0,
													'create_by' => $cNIK_session,
													'create_date' => $last_update,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
												if ($result_total_count_out_line_add == true) {
													$result_total_count_out = $this->m_inventoryread->list_total_count_out_by_id_inventory($company_id_session, $id_inventory);
													if (count($result_total_count_out)==0) {
														$data_total_count_out = array(
															'company_id' => $company_id_session,
															'id_inventory' => $id_inventory,
															'total_count_out' => $qty_used*1,
															'create_by' => $cNIK_session,
															'create_date' => $last_update,
															'last_by' => $cNIK_session,
															'last_update' => $last_update,
														);
														$result_total_count_out_add = $this->m_inventorycreate->add_total_count_out($data_total_count_out);
														if ($result_total_count_out_add == true) {
															$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
															$total_count_old = $result_total_count[0]->total_count;
															$total_count_new = ($total_count_old*1)-($qty_used*1);
															$data_total_count = array (
																'total_count' => $total_count_new,
																'last_by' => $cNIK_session,
																'last_update' => $last_update
															);
															$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
															if ($result_update_total_count == true) {
																$status = 1;
																$responseValue = '';
																array_push($status_array, $status);
															}
															else {
																$status = 0;
																$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
																array_push($status_array, $status);
															}
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count out, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
															array_push($status_array, $status);
														}
													}
													else {
														$total_count_out_old = $result_total_count_out[0]->total_count_out;
														$total_count_out = ($total_count_out_old*1)+($qty_used*1);
														$data_total_count_out = array(
															'total_count_out' => $total_count_out,
															'last_by' => $cNIK_session,
															'last_update' => $last_update,
														);
														$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
														if ($result_total_count_out_update == true) {
															$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
															$total_count_old = $result_total_count[0]->total_count;
															$total_count_new = ($total_count_old*1)-($qty_used*1);
															$data_total_count = array (
																'total_count' => $total_count_new,
																'last_by' => $cNIK_session,
																'last_update' => $last_update
															);
															$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
															if ($result_update_total_count == true) {
																$status = 1;
																$responseValue = '';
																array_push($status_array, $status);
															}
															else {
																$status = 0;
																$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
																array_push($status_array, $status);
															}
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
															array_push($status_array, $status);
														}
													}
												}
												else {
													$status = 0;
													$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
													array_push($status_array, $status);
												}
											}
											else {
												$status = 0;
												$responseValue = 'Cannot update kit assy header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
												array_push($status_array, $status);
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot add kit assy line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
											array_push($status_array, $status);
										}
									}
								}
								else {
									$status = 0;
									$responseValue = 'Cannot add kit assy header, please contact MMI Developer with screen shoot this page.'; 
									array_push($status_array, $status);
								}
							}
							else {
								$kit_assy_number = $result_kit_assy_by_jobno[0]->kit_assy_number;
								$id_purchase_receipt_line_exp = explode(',', $id_purchase_receipt_line_array);
								$qty_used_exp = explode(',', $qty_used_array);
								for ($i=0; $i < count($id_purchase_receipt_line_exp); $i++) { 
									$id_purchase_receipt_line = $id_purchase_receipt_line_exp[$i];
									$qty_used = $qty_used_exp[$i];

									$result_total_count_in_line = $this->m_inventoryread->list_total_count_in_line_by_id_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
									$id_total_count_in_line = $result_total_count_in_line[0]->id_total_count_in_line;

									$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);
									foreach ($result_purchase_receipt_line as $resultListLine);
									$id_part_list = $resultListLine->id_part_list;
									$id_inventory = $resultListLine->id_inventory;
									$uom_cd = $resultListLine->uom_cd;
									$cury_unit_price = $resultListLine->cury_unit_price;
									$amount = $qty_used*$cury_unit_price;

									$data_kit_assy_line = array(
										'company_id' => $company_id_session,
										'kit_assy_number' => $kit_assy_number,
										'id_part_list' => $id_part_list,
										'id_purchase_receipt_line' => $id_purchase_receipt_line,
										'qty_used' => $qty_used*1,
										'uom_cd' => $uom_cd,
										'unit_price' => $cury_unit_price*1,
										'amount' => $amount,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
										'deleted' => 0
									);
									$result_add_kit_assy_line = $this->m_inventorycreate->add_kit_assy_line($data_kit_assy_line);
									if ($result_add_kit_assy_line == true) {
										$result_kit_assy_by_jobno = $this->m_inventoryread->list_kit_assy_by_jobno($company_id_session, $JobNo);
										$amount_db = $result_kit_assy_by_jobno[0]->total_amount;
										$amount_new = ($amount_db*1)+($amount*1);
										$data_kit_assy_header_for_update = array(
											'total_amount' => $amount_new,
											'last_by' => $cNIK_session,
											'last_update' => $last_update
										);
										$result_update_kit_assy_header = $this->m_inventoryupdate->update_kit_assy($company_id_session, $data_kit_assy_header_for_update, $kit_assy_number);
										if ($result_update_kit_assy_header == true) {
											$data_total_count_out_line = array(
												'company_id' => $company_id_session,
												'category' => 'kit-assy',
												'id_total_count_in_line' => $id_total_count_in_line,
												'id_inventory' => $id_inventory,
												'qty_out' => $qty_used,
												'deleted' => 0,
												'create_by' => $cNIK_session,
												'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
											if ($result_total_count_out_line_add == true) {
												$result_total_count_out = $this->m_inventoryread->list_total_count_out_by_id_inventory($company_id_session, $id_inventory);
												if (count($result_total_count_out)==0) {
													$data_total_count_out = array(
														'company_id' => $company_id_session,
														'id_inventory' => $id_inventory,
														'total_count_out' => $qty_used*1,
														'create_by' => $cNIK_session,
														'create_date' => $last_update,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_total_count_out_add = $this->m_inventorycreate->add_total_count_out($data_total_count_out);
													if ($result_total_count_out_add == true) {
														$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
														$total_count_old = $result_total_count[0]->total_count;
														$total_count_new = ($total_count_old*1)-($qty_used*1);
														$data_total_count = array (
															'total_count' => $total_count_new,
															'last_by' => $cNIK_session,
															'last_update' => $last_update
														);
														$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
														if ($result_update_total_count == true) {
															$status = 1;
															$responseValue = '';
															array_push($status_array, $status);
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
															array_push($status_array, $status);
														}
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count out, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														array_push($status_array, $status);
													}
												}
												else {
													$total_count_out_old = $result_total_count_out[0]->total_count_out;
													$total_count_out = ($total_count_out_old*1)+($qty_used*1);
													$data_total_count_out = array(
														'total_count_out' => $total_count_out,
														'last_by' => $cNIK_session,
														'last_update' => $last_update,
													);
													$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
													if ($result_total_count_out_update == true) {
														$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
														$total_count_old = $result_total_count[0]->total_count;
														$total_count_new = ($total_count_old*1)-($qty_used*1);
														$data_total_count = array (
															'total_count' => $total_count_new,
															'last_by' => $cNIK_session,
															'last_update' => $last_update
														);
														$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
														if ($result_update_total_count == true) {
															$status = 1;
															$responseValue = '';
															array_push($status_array, $status);
														}
														else {
															$status = 0;
															$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
															array_push($status_array, $status);
														}
													}
													else {
														$status = 0;
														$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
														array_push($status_array, $status);
													}
												}
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
												array_push($status_array, $status);
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot update kit assy header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
											array_push($status_array, $status);
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add kit assy line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
										array_push($status_array, $status);
									}
								}
							}
						}						
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'response' => $responseValue, 'data_kit_assy_header' => $data_kit_assy_header, 'data_kit_assy_line' => $data_kit_assy_line)));
				}
			}
		}

		public function add_annual_price($key_session){
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
					$this->form_validation->set_rules('year', 'year', 'required');
					$this->form_validation->set_rules('annual_price', 'annual_price', 'required');
					$this->form_validation->set_rules('category', 'category', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_inventory = $this->input->post('id_inventory');
						$year = $this->input->post('year');
						$annual_price = $this->input->post('annual_price');
						$category = $this->input->post('category');

						$last_update = date('Y-m-d H:i:s');

						$id_annual_price = $this->input->post('id_'.$category_get.'_annual_price');

						$result_annual_price = $this->m_inventoryread->list_annual_price_by_id_inventory($company_id_session, $category, $id_inventory, $year);
						if (count($result_annual_price)==0) { // Add 
							$data=array(
								'company_id' => $company_id_session,
								'id_inventory' => $id_inventory,
								'category' => $category,
								'year' => $year,
								'annual_price' => $annual_price*1,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);
							$result = $this->m_inventorycreate->add_annual_price($data);
							if ($result==true) {
								$result_annual_price_last = $this->m_inventoryread->list_annual_price_by_id_inventory($company_id_session, $category, $id_inventory, ($year-1));
								if (count($result_annual_price_last)==0) {
									$status = 1;
									$responseValue = 'ok';
								}
								else {
									$data=array(
										'deleted' => 1,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									$result = $this->m_inventoryupdate->update_annual_price($company_id_session, $data, $id_inventory, ($year-1));
									if ($result==true) {
										$status = 1;
										$responseValue = 'ok';
									}
									else {
										$status = 0;
										$responseValue = 'Data not saved.';
									}
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
						else {
							$data=array(
								'annual_price' => $annual_price*1,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventoryupdate->update_annual_price($company_id_session, $data, $id_inventory, $year);
							if ($result==true) {
								$status = 1;
								$responseValue = 'ok';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
												
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_stock_transaction($key_session){
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
					$this->form_validation->set_rules('JobNo', 'JobNo', 'required');
					$this->form_validation->set_rules('date_out', 'date_out', 'required');
					$this->form_validation->set_rules('take_list', 'take_list', 'required');
					$this->form_validation->set_rules('take_line', 'take_line', 'required');
					$this->form_validation->set_rules('category', 'category', 'required');
					$this->form_validation->set_rules('cNIK_take', 'cNIK_take', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$JobNo = $this->input->post('JobNo');
						$date_out = $this->input->post('date_out');
						$year = date_format(date_create($date_out), 'Y');
						$take_list = json_decode(($this->input->post('take_list')), TRUE);
						$take_line = $this->input->post('take_line');
						$category = $this->input->post('category');
						$cNIK_take = $this->input->post('cNIK_take');

						$last_update = date('Y-m-d H:i:s');

						if ($JobNo == 'Non Job') {
							$id_job_order = 0;
						}
						else {
							$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);
							$id_job_order = $result_job_order[0]->id_job_order;
						}

						$data_stock_out_array = array();
						$status_array = array();
						
						for ($i=0; $i < count($take_list); $i++) { 
							$qty_used = ($take_list[$i]['qty_take'])*1;
							$id_inventory = ($take_list[$i]['id_inventory'])*1;
							$annual_price = ($take_list[$i]['annual_price'])*1;

							$data_stock_out = array(
								'company_id' => $company_id_session,
								'category' => $category,
								'date_out' => $date_out,
								'id_inventory' => ($take_list[$i]['id_inventory'])*1,
								'id_job_order' => $id_job_order,
								'qty' => $qty_used,
								'unit_price' => $annual_price,
								'create_by' => $cNIK_take,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							array_push($data_stock_out_array, $data_stock_out);
							$result_add_stock_out = $this->m_inventorycreate->add_stock_out($data_stock_out);
							if ($result_add_stock_out == true) {
								$result_total_count_out = $this->m_inventoryread->list_total_count_out_by_id_inventory($company_id_session, $id_inventory);
								if (count($result_total_count_out)==0) { // New Total Count Out
									$data_total_count_out = array(
										'company_id' => $company_id_session,
										'id_inventory' => $id_inventory,
										'total_count_out' => $qty_used,
										'create_by' => $cNIK_take,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									$result_total_count_out_add = $this->m_inventorycreate->add_total_count_out($data_total_count_out);
									if ($result_total_count_out_add == true) {
										$data_total_count_out_line = array(
											'company_id' => $company_id_session,
											'category' => $category,
											'id_total_count_in_line' => $id_total_count_in_line,
											'id_inventory' => $id_inventory,
											'qty_out' => $qty_used,
											'deleted' => 0,
											'create_by' => $cNIK_take,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
										if ($result_total_count_out_line_add == true) {
											$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
											$total_count_old = $result_total_count[0]->total_count;
											$total_count_new = ($total_count_old*1)-($qty_used*1);
											$data_total_count = array (
												'total_count' => $total_count_new,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
											if ($result_update_total_count == true) {
												$status = 1;
												$responseValue = '';
												array_push($status_array, $status);
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
												array_push($status_array, $status);
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
											array_push($status_array, $status);
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
										array_push($status_array, $status);
									}
								}
								else { // Update Total Count Out by Inventory ID
									$total_count_out_old = $result_total_count_out[0]->total_count_out;
									$total_count_out = ($total_count_out_old*1)+($qty_used*1);
									$data_total_count_out = array(
										'total_count_out' => $total_count_out,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									$result_total_count_out_update = $this->m_inventoryupdate->update_total_count_out($company_id_session, $data_total_count_out, $id_inventory);
									if ($result_total_count_out_update == true) {
										$data_total_count_out_line = array(
											'company_id' => $company_id_session,
											'category' => $category,
											'id_total_count_in_line' => $id_total_count_in_line,
											'id_inventory' => $id_inventory,
											'qty_out' => $qty_used,
											'deleted' => 0,
											'create_by' => $cNIK_take,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										$result_total_count_out_line_add = $this->m_inventorycreate->add_total_count_out_line($data_total_count_out_line);
										if ($result_total_count_out_line_add == true) {
											$result_total_count = $this->m_inventoryread->list_total_count_by_id_inventory($company_id_session, $id_inventory);
											$total_count_old = $result_total_count[0]->total_count;
											$total_count_new = ($total_count_old*1)-($qty_used*1);

											$data_total_count = array (
												'total_count' => $total_count_new,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_total_count = $this->m_inventoryupdate->update_total_count($company_id_session, $data_total_count, $id_inventory);
											if ($result_update_total_count == true) {
												$status = 1;
												$responseValue = '';
												array_push($status_array, $status);
											}
											else {
												$status = 0;
												$responseValue = 'Cannot add total count, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
												array_push($status_array, $status);
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot add total count out line, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
											array_push($status_array, $status);
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add total count out header, please contact MMI Developer with screen shoot this page. ID Inventory : '.$id_inventory;
										array_push($status_array, $status);
									}
								}
							}
							else {
								$status = 0;
								array_push($status_array, $status);
							}
						}
						
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'response' => $data_stock_out_array)));
				}
			}
		}

		public function add_uom_convert($key_session){
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
					$this->form_validation->set_rules('id_uom_convert', 'id_uom_convert', 'required');
					$this->form_validation->set_rules('number_convert', 'number_convert', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_inventory = $this->input->post('id_inventory');
						$id_uom_convert = $this->input->post('id_uom_convert');
						$number_convert = $this->input->post('number_convert');

						$last_update = date('Y-m-d H:i:s');

						$result_uom_convert = $this->m_inventoryread->list_uom_converter($company_id_session, $id_inventory);
						if (count($result_uom_convert)==0) { // Add 
							$data=array(
								'company_id' => $company_id_session,
								'id_inventory' => $id_inventory,
								'id_uom_convert' => $id_uom_convert*1,
								'number_convert' => $number_convert*1,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventorycreate->add_uom_convert($data);
							if ($result==true) {
								$result_uom_convert = $this->m_inventoryread->list_uom_converter($company_id_session, $id_inventory);
								$uom_cd_convert = $result_uom_convert[0]->uom_cd_convert;
								$status = 1;
								$responseValue = $uom_cd_convert;
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
						else {
							$data=array(
								'id_uom_convert' => $id_uom_convert*1,
								'number_convert' => $number_convert*1,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_inventoryupdate->update_uom_convert($company_id_session, $data, $id_inventory);
							if ($result==true) {
								$result_uom_convert = $this->m_inventoryread->list_uom_converter($company_id_session, $id_inventory);
								$uom_cd_convert = $result_uom_convert[0]->uom_cd_convert;
								$status = 1;
								$responseValue = $uom_cd_convert;
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
												
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

	}
