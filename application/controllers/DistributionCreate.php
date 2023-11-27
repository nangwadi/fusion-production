<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DistributionCreate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('upload');
			$this->load->database();
	        $this->load->helper('form', 'url');
	        $this->load->model('m_distributionread');
	        $this->load->model('m_distributioncreate');
	        $this->load->model('m_distributionupdate');
	        $this->load->model('m_jomread');
	        $this->load->model('m_coaread');
	        $this->load->model('m_essread');
	        $this->load->model('m_inventoryread');
	        $this->load->model('m_financeread');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function add_module_category($key_session){
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
					$this->form_validation->set_rules('module_category_cd', 'module_category_cd', 'required');
					$this->form_validation->set_rules('module_category_name', 'module_category_name', 'required');
					$this->form_validation->set_rules('ar_ap', 'ar_ap', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_module_category = $this->input->post('id_module_category');
						$module_category_cd = $this->input->post('module_category_cd');
						$module_category_name = $this->input->post('module_category_name');
						$ar_ap = $this->input->post('ar_ap');

						$last_update = date('Y-m-d H:i:s');

						if ($id_module_category=='') {
							$result_module_category = $this->m_distributionread->list_module_category_by_module_category_cd($company_id_session, $module_category_cd);
							if (count($result_module_category)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'module_category_cd' => $module_category_cd,
									'module_category_name' => $module_category_name,
									'ar_ap' => $ar_ap,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_distributioncreate->add_module_category($data);
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
								'module_category_cd' => $module_category_cd,
								'module_category_name' => $module_category_name,
								'ar_ap' => $ar_ap,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_module($key_session){
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
					$this->form_validation->set_rules('module_cd', 'module_cd', 'required');
					$this->form_validation->set_rules('module_name', 'module_name', 'required');
					$this->form_validation->set_rules('id_module_category', 'id_module_category', 'required');
					$this->form_validation->set_rules('file_name', 'file_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_module = $this->input->post('id_module');
						$module_cd = $this->input->post('module_cd');
						$module_name = $this->input->post('module_name');
						$id_module_category = $this->input->post('id_module_category');
						$file_name = $this->input->post('file_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_module=='') {
							$result_module = $this->m_distributionread->list_module_by_module_cd($company_id_session, $module_cd);
							if (count($result_module)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'module_cd' => $module_cd,
									'module_name' => $module_name,
									'id_module_category' => $id_module_category,
									'file_name' => $file_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_distributioncreate->add_module($data);
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
								'module_cd' => $module_cd,
								'module_name' => $module_name,
								'id_module_category' => $id_module_category,
								'file_name' => $file_name,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_numbering_sequence($key_session){
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
					$this->form_validation->set_rules('string_format', 'string_format', 'required');
					$this->form_validation->set_rules('cut_1', 'cut_1', 'required');
					$this->form_validation->set_rules('cut_2', 'cut_2', 'required');
					$this->form_validation->set_rules('number_length', 'number_length', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_numbering_sequence = $this->input->post('id_numbering_sequence');
						$string_format = $this->input->post('string_format');
						$cut_1 = $this->input->post('cut_1');
						$cut_2 = $this->input->post('cut_2');
						$number_length = $this->input->post('number_length');
						$id_module = $this->input->post('id_module');

						$last_update = date('Y-m-d H:i:s');

						$result_numbering_sequence = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
						if (count($result_numbering_sequence)==0) { // Add 
							$data=array(
								'company_id' => $company_id_session,
								'string_format' => $string_format,
								'cut_1' => $cut_1,
								'cut_2' => $cut_2,
								'number_length' => $number_length,
								'id_module' => $id_module,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_distributioncreate->add_numbering_sequence($data);
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
							$data=array(
								'string_format' => $string_format,
								'cut_1' => $cut_1,
								'cut_2' => $cut_2,
								'number_length' => $number_length,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_distributionupdate->update_numbering_sequence($data, $company_id_session, $id_module);
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

		public function add_employee_permission($key_session){
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
					$this->form_validation->set_rules('cNmPegawai', 'cNmPegawai', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_employee_permission = $this->input->post('id_employee_permission');
						$cNmPegawai = $this->input->post('cNmPegawai');
						$id_module = $this->input->post('id_module');

						$result_employee = $this->m_essread->personal_data_by_cnmpegawai($company_id_session, $cNmPegawai);
						$cNIK = $result_employee[0]->cNIK;

						$last_update = date('Y-m-d H:i:s');

						if ($id_employee_permission=='') {
							$result_employee_permission = $this->m_distributionread->list_employee_permission_by_cnik($company_id_session, $id_module, $cNIK);
							if (count($result_employee_permission)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'id_module' => $id_module,
									'cNIK' => $cNIK,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_distributioncreate->add_employee_permission($data);
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
								'cNIK' => $cNIK,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_distributionupdate->update_employee_permission($data, $company_id_session, $id_employee_permission);
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

		public function add_approval_permission($key_session){
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
					$this->form_validation->set_rules('cNmPegawai', 'cNmPegawai', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_approval_permission = $this->input->post('id_approval_permission');
						$cNmPegawai = $this->input->post('cNmPegawai');
						$id_module = $this->input->post('id_module');

						$result_approval = $this->m_essread->personal_data_by_cnmpegawai($company_id_session, $cNmPegawai);
						$cNIK = $result_approval[0]->cNIK;

						$last_update = date('Y-m-d H:i:s');

						if ($id_approval_permission=='') {
							$result_approval_permission = $this->m_distributionread->list_approval_permission_by_cnik($company_id_session, $id_module, $cNIK);
							if (count($result_approval_permission)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'id_module' => $id_module,
									'cNIK' => $cNIK,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_distributioncreate->add_approval_permission($data);
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
								'cNIK' => $cNIK,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_distributionupdate->update_approval_permission($data, $company_id_session, $id_approval_permission);
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

		public function add_transaction_role($key_session){
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
					$this->form_validation->set_rules('sequence', 'sequence', 'required');
					$this->form_validation->set_rules('transaction_name', 'transaction_name', 'required');
					$this->form_validation->set_rules('write', 'write', 'required');
					$this->form_validation->set_rules('email_approval', 'email_approval', 'required');
					$this->form_validation->set_rules('email_vendor', 'email_vendor', 'required');
					$this->form_validation->set_rules('close_transaction', 'close_transaction', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_transaction_role = $this->input->post('id_transaction_role');
						$sequence = $this->input->post('sequence');
						$transaction_name = $this->input->post('transaction_name');
						$write = $this->input->post('write');
						$email_approval = $this->input->post('email_approval');
						$email_vendor = $this->input->post('email_vendor');
						$close_transaction = $this->input->post('close_transaction');
						$id_module = $this->input->post('id_module');

						$last_update = date('Y-m-d H:i:s');

						if ($id_transaction_role=='') {
							$data=array(
								'company_id' => $company_id_session,
								'id_module' => $id_module,
								'sequence' => $sequence,
								'transaction_name' => $transaction_name,
								'write' => $write,
								'email_approval' => $email_approval,
								'email_vendor' => $email_vendor,
								'close_transaction' => $close_transaction,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_distributioncreate->add_transaction_role($data);
							if ($result==true) {
								$status = 1;
								$responseValue = 'ok';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
						else { // Update
							$data=array(
								'sequence' => $sequence,
								'transaction_name' => $transaction_name,
								'write' => $write,
								'email_approval' => $email_approval,
								'email_vendor' => $email_vendor,
								'close_transaction' => $close_transaction,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_payment_methode($key_session){
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
					$this->form_validation->set_rules('payment_methode_cd', 'payment_methode_cd', 'required');
					$this->form_validation->set_rules('payment_methode_name', 'payment_methode_name', 'required');
					$this->form_validation->set_rules('category', 'category', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_payment_methode = $this->input->post('id_payment_methode');
						$payment_methode_cd = $this->input->post('payment_methode_cd');
						$payment_methode_name = $this->input->post('payment_methode_name');
						$category = $this->input->post('category');

						$last_update = date('Y-m-d H:i:s');

						if ($id_payment_methode=='') { // Create
							$result_payment_methode = $this->m_distributionread->list_payment_methode_by_payment_methode_cd($company_id_session, $category, $payment_methode_cd);
							if (count($result_payment_methode)==0) {
								$data=array(
									'company_id' => $company_id_session,
									'category' => $category,
									'payment_methode_cd' => $payment_methode_cd,
									'payment_methode_name' => $payment_methode_name,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
									'deleted' => 0
								);
								$result = $this->m_distributioncreate->add_payment_methode($data);
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
								$responseValue = "Data has already.";
							}
						}
						else { // Update
							$data=array(
								'category' => $category,
								'payment_methode_cd' => $payment_methode_cd,
								'payment_methode_name' => $payment_methode_name,
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
						
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_payment_terms($key_session){
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
					$this->form_validation->set_rules('payment_terms_cd', 'payment_terms_cd', 'required');
					$this->form_validation->set_rules('payment_terms_name', 'payment_terms_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_payment_terms = $this->input->post('id_payment_terms');
						$payment_terms_cd = $this->input->post('payment_terms_cd');
						$payment_terms_name = $this->input->post('payment_terms_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_payment_terms=='') { // Create
							$result_payment_terms = $this->m_distributionread->list_payment_terms_by_payment_terms_cd($company_id_session, $category, $payment_terms_cd);
							if (count($result_payment_terms)==0) {
								$data=array(
									'company_id' => $company_id_session,
									'payment_terms_cd' => $payment_terms_cd,
									'payment_terms_name' => $payment_terms_name,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
									'deleted' => 0
								);
								$result = $this->m_distributioncreate->add_payment_terms($data);
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
								$responseValue = "Data has already.";
							}
						}
						else { // Update
							$data=array(
								'payment_terms_cd' => $payment_terms_cd,
								'payment_terms_name' => $payment_terms_name,
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
						
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		// Input

		public function add_purchase_order($key_session){
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

					// Header
					//$this->form_validation->set_rules('id_purchase_order', 'id_purchase_order', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					//$this->form_validation->set_rules('purchase_order_number', 'purchase_order_number', 'required');
					$this->form_validation->set_rules('hold', 'hold', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
					$this->form_validation->set_rules('purchase_order_date', 'purchase_order_date', 'required');
					//$this->form_validation->set_rules('note', 'note', 'required');
					$this->form_validation->set_rules('total_line', 'total_line', 'required');
					$this->form_validation->set_rules('total_qty', 'total_qty', 'required');
					$this->form_validation->set_rules('id_account', 'id_account', 'required');
					//$this->form_validation->set_rules('vendor_quotation_number', 'vendor_quotation_number', 'required');
					$this->form_validation->set_rules('id_coa_currency', 'id_coa_currency', 'required');
					$this->form_validation->set_rules('rate', 'rate', 'required');
					$this->form_validation->set_rules('purchase_order_owner', 'purchase_order_owner', 'required');
					$this->form_validation->set_rules('cNIK_approval', 'cNIK_approval', 'required');
					$this->form_validation->set_rules('sub_amount', 'sub_amount', 'required');
					$this->form_validation->set_rules('discount_amount', 'discount_amount', 'required');
					$this->form_validation->set_rules('amount', 'amount', 'required');
					$this->form_validation->set_rules('ppn', 'ppn', 'required');
					$this->form_validation->set_rules('pph', 'pph', 'required');
					$this->form_validation->set_rules('total_amount', 'total_amount', 'required');
					
					// Line
					//$this->form_validation->set_rules('id_part_list_line', 'id_part_list_line', 'required');
					$this->form_validation->set_rules('id_inventory_line', 'id_inventory_line', 'required');
					$this->form_validation->set_rules('inventory_cd_line', 'inventory_cd_line', 'required');
					$this->form_validation->set_rules('inventory_name_line', 'inventory_name_line', 'required');
					//$this->form_validation->set_rules('JobNo_line', 'JobNo_line', 'required');
					$this->form_validation->set_rules('qty_order_line', 'qty_order_line', 'required');
					$this->form_validation->set_rules('uom_cd_line', 'uom_cd_line', 'required');
					$this->form_validation->set_rules('unit_price_line', 'unit_price_line', 'required');
					$this->form_validation->set_rules('line_sub_amount_line', 'line_sub_amount_line', 'required');
					$this->form_validation->set_rules('discount_amount_line', 'discount_amount_line', 'required');
					$this->form_validation->set_rules('discount_percent_line', 'discount_percent_line', 'required');
					$this->form_validation->set_rules('line_amount_line', 'line_amount_line', 'required');
					$this->form_validation->set_rules('item_class_cd_line', 'item_class_cd_line', 'required');
					$this->form_validation->set_rules('sub_tax_cd_line', 'sub_tax_cd_line', 'required');
					$this->form_validation->set_rules('coa_cd_line', 'coa_cd_line', 'required');
					$this->form_validation->set_rules('coa_name_line', 'coa_name_line', 'required');
					$this->form_validation->set_rules('warehouse_name_line', 'warehouse_name_line', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
						array_push($status_array, $status);
					}
					else {

						// Header
						$id_purchase_order = $this->input->post('id_purchase_order');
						$id_module = $this->input->post('id_module');
						$purchase_order_number_post = $this->input->post('purchase_order_number');
						$hold = $this->input->post('hold');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$purchase_order_date = $this->input->post('purchase_order_date');
						$note = $this->input->post('note');
						$total_line = $this->input->post('total_line');
						$total_qty = $this->input->post('total_qty');
						$id_account_post = $this->input->post('id_account');
						$vendor_quotation_number = $this->input->post('vendor_quotation_number');
						$id_coa_currency_post = $this->input->post('id_coa_currency');
						$rate = $this->input->post('rate');
						$purchase_order_owner = $this->input->post('purchase_order_owner');
						$cNIK_approval_post = $this->input->post('cNIK_approval');
						$sub_amount = $this->input->post('sub_amount');
						$discount_amount = $this->input->post('discount_amount');
						$amount = $this->input->post('amount');
						$ppn = $this->input->post('ppn');
						$pph = $this->input->post('pph');
						$total_amount = $this->input->post('total_amount');

						if ($hold==true) {
							$hold_check = 1;
						}
						else {
							$hold_check = 0;
						}

						//$result_account = $this->m_jomread->list_account_by_account_name($company_id_session, 'vendor', $id_account_post);
						//$id_account = $result_account[0]->id_account;
						$id_account = $id_account_post;

						$result_coa_currency = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $id_coa_currency_post);
						$id_coa_currency = $result_coa_currency[0]->id_coa_currency;

						$result_employee_approval = $this->m_essread->personal_data_by_cnmpegawai($company_id_session, $cNIK_approval_post);
						$cNIK_approval = $result_employee_approval[0]->cNIK;

						$year = date_format(date_create($purchase_order_date), 'Y');
						$periode = date_format(date_create($purchase_order_date), 'Y-m');

						if ($purchase_order_number_post=='') {
							$result_purchase_order = $this->m_distributionread->list_purchase_order_by_year($company_id_session, $year);
							$purchase_order_count = count($result_purchase_order);
							$purchase_order_next = $purchase_order_count+1;

							$result_numbering_sequence = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
							$string_format = $result_numbering_sequence[0]->string_format;
							$cut_1 = $result_numbering_sequence[0]->cut_1;
							$cut_2 = $result_numbering_sequence[0]->cut_2;
							$number_length = $result_numbering_sequence[0]->number_length;

							$purchase_order_next_add_zero = sprintf("%0".$number_length."d", $purchase_order_next);
							$purchase_order_number = $string_format.''.$cut_1.''.$year.''.$cut_2.''.$purchase_order_next_add_zero;
						}
						else {
							$purchase_order_number = $purchase_order_number_post;
						}
						
						// Line
						$id_purchase_order_line_post = $this->input->post('id_purchase_order_line');
						$id_part_list_line_post = $this->input->post('id_part_list_line');
						$id_inventory_line_post = $this->input->post('id_inventory_line');
						$inventory_cd_line_post = $this->input->post('inventory_cd_line');
						$inventory_name_line_post = $this->input->post('inventory_name_line');
						$JobNo_line_post = $this->input->post('JobNo_line');
						$qty_order_line_post = $this->input->post('qty_order_line');
						$uom_cd_line_post = $this->input->post('uom_cd_line');
						$unit_price_line_post = $this->input->post('unit_price_line');
						$line_sub_amount_line_post = $this->input->post('line_sub_amount_line');
						$discount_amount_line_post = $this->input->post('discount_amount_line');
						$discount_percent_line_post = $this->input->post('discount_percent_line');
						$line_amount_line_post = $this->input->post('line_amount_line');
						$item_class_cd_line_post = $this->input->post('item_class_cd_line');
						$sub_tax_cd_line_post = $this->input->post('sub_tax_cd_line');
						$coa_cd_line_post = $this->input->post('coa_cd_line');
						$coa_name_line_post = $this->input->post('coa_name_line');
						$warehouse_name_line_post = $this->input->post('warehouse_name_line');

						$id_purchase_order_line_exp = explode(',', $id_purchase_order_line_post);
						$id_part_list_line_exp = explode(',', $id_part_list_line_post);
						$id_inventory_line_exp = explode(',', $id_inventory_line_post);
						$inventory_cd_line_exp = explode(',', $inventory_cd_line_post);
						$inventory_name_line_exp = explode(',', $inventory_name_line_post);
						$JobNo_line_exp = explode(',', $JobNo_line_post);
						$qty_order_line_exp = explode(',', $qty_order_line_post);
						$uom_cd_line_exp = explode(',', $uom_cd_line_post);
						$unit_price_line_exp = explode(',', $unit_price_line_post);
						$line_sub_amount_line_exp = explode(',', $line_sub_amount_line_post);
						$discount_amount_line_exp = explode(',', $discount_amount_line_post);
						$discount_percent_line_exp = explode(',', $discount_percent_line_post);
						$line_amount_line_exp = explode(',', $line_amount_line_post);
						$item_class_cd_line_exp = explode(',', $item_class_cd_line_post);
						$sub_tax_cd_line_exp = explode(',', $sub_tax_cd_line_post);
						$coa_cd_line_exp = explode(',', $coa_cd_line_post);
						$coa_name_line_exp = explode(',', $coa_name_line_post);
						$warehouse_name_line_exp = explode(',', $warehouse_name_line_post);

						$last_update = date('Y-m-d H:i:s');

						$status_array = array();

						if ($purchase_order_number_post == '') {
							$data_header = array (
								'company_id' => $company_id_session,
								'id_module' => $id_module,
								'purchase_order_number' => $purchase_order_number,
								'hold' => $hold_check,
								'id_transaction_role' => $id_transaction_role*1,
								'id_account' => $id_account,
								'year' => $year,
								'periode' => $periode,
								'purchase_order_date' => $purchase_order_date,
								'vendor_quotation_number' => $vendor_quotation_number,
								'cNIK_approval' => $cNIK_approval,
								'id_coa_currency' => $id_coa_currency,
								'rate' => $rate*1,
								'total_line' => count($id_inventory_line_exp),
								'total_qty' => $total_qty*1,							
								'cury_sub_amount' => (($sub_amount*1)*($rate*1)),
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => ($discount_amount*1)*($rate*1),
								'discount_amount' => $discount_amount*1,							
								'cury_amount' => ($amount*1)*($rate*1),
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,							
								'cury_total_amount' => ($total_amount*1)*($rate*1),
								'total_amount' => $total_amount*1,
								'note' => $note,
								'purchase_order_owner' => $cNIK_session,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0
							);
							$result_header = $this->m_distributioncreate->add_purchase_order($data_header);
							if ($result_header==true) {
								$data_line_array = array();
								if (count($id_inventory_line_exp)==1) {
									$id_part_list_line = $id_part_list_line_post;
									$id_inventory_line = $id_inventory_line_post;
									$inventory_cd_line = $inventory_cd_line_post;
									$inventory_name_line = $inventory_name_line_post;
									$JobNo_line = $JobNo_line_post;
									$qty_order_line = $qty_order_line_post;
									$uom_cd_line = $uom_cd_line_post;
									$unit_price_line = $unit_price_line_post;
									$line_sub_amount_line = $line_sub_amount_line_post;
									$discount_amount_line = $discount_amount_line_post;
									$discount_percent_line = $discount_percent_line_post;
									$line_amount_line = $line_amount_line_post;
									$item_class_cd_line = $item_class_cd_line_post;
									$sub_tax_cd_line = $sub_tax_cd_line_post;
									$coa_cd_line = $coa_cd_line_post;
									$coa_name_line = $coa_name_line_post;
									$warehouse_name_line = $warehouse_name_line_post;

									if ($id_part_list_line=='0') {
										$id_part_list = '';
										$part_no = '';
										$part_name = '';
									}
									else {
										$result_part_list = $this->m_jomread->list_part_list($company_id_session, $id_part_list_line);
										$id_part_list = $id_part_list_line;
										$part_no = $result_part_list[0]->part_no;
										$part_name = $result_part_list[0]->part_name;
									}

									if ($JobNo_line=='') {
										$id_job_order = '';
										$JobNo = '';
									}
									else {
										$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
										$id_job_order = $result_job_order[0]->id_job_order;
										$JobNo = $JobNo_line;
									}

									$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
									$id_uom = $result_uom[0]->id_uom;
									$uom_cd = $uom_cd_line;
									$uom_name = $result_uom[0]->uom_name;

									$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
									$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
									$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
									$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

									$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
									$id_coa = $result_coa[0]->id_coa;
									$coa_cd = $coa_cd_line;
									$coa_name = $coa_name_line;

									$result_warehouse = $this->m_inventoryread->list_warehouse_by_warehouse_name($company_id_session, $warehouse_name_line);
									$id_warehouse = $result_warehouse[0]->id_warehouse;
									$warehouse_cd = $result_warehouse[0]->warehouse_cd;
									$warehouse_name = $warehouse_name_line;

									$result_item_class = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd_line);
									$id_item_class = $result_item_class[0]->id_item_class;
									$item_class_cd = $item_class_cd_line;
									$item_class_name = $result_item_class[0]->item_class_name;

									$cury_unit_price = $unit_price_line*$rate;
									$cury_sub_amount = $line_sub_amount_line*$rate;
									$cury_discount_amount = $discount_amount_line*$rate;
									$cury_amount = $line_amount_line*$rate;

									$data_line = array (
										//'id_purchase_order_line' => $,
										'company_id' => $company_id_session,
										'purchase_order_number' => $purchase_order_number,
										'line_number' => 1,
										'id_inventory' => $id_inventory_line*1,
										'inventory_cd' => $inventory_cd_line,
										'description' => $inventory_name_line,
										'id_part_list' => $id_part_list*1,
										'part_no' => $part_no,
										'part_name' => $part_name,
										'id_job_order' => $id_job_order,
										'JobNo' => $JobNo,
										'purchase_order_line_qty' => $qty_order_line*1,
										'purchase_order_line_qty_purchase_receipt' => 0,
										'id_uom' => $id_uom,
										'uom_cd' => $uom_cd,
										'uom_name' => $uom_name,
										'cury_unit_price' => $cury_unit_price,
										'unit_price' => $unit_price_line,
										'cury_sub_amount' => $cury_sub_amount,
										'sub_amount' => $line_sub_amount_line,
										'cury_discount_amount' => $cury_discount_amount,
										'discount_amount' => $discount_amount_line,
										'discount_percent' => $discount_percent_line,
										'cury_amount' => $cury_amount,
										'amount' => $line_amount_line,
										'id_sub_tax' => $id_sub_tax,
										'sub_tax_cd' => $sub_tax_cd,
										'sub_tax_name' => $sub_tax_name,
										'id_coa' => $id_coa,
										'coa_cd' => $coa_cd,
										'coa_name' => $coa_name,
										'id_warehouse' => $id_warehouse,
										'warehouse_cd' => $warehouse_cd,
										'warehouse_name' => $warehouse_name,
										'id_item_class' => $id_item_class,
										'item_class_cd' => $item_class_cd,
										'item_class_name' => $item_class_name,
										'line_status' => 0,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									array_push ($data_line_array, $data_line);
									$result_line = $this->m_distributioncreate->add_purchase_order_line($data_line);
									if ($result_line==true) {
										$status = 1;
									}
									else {
										$status = 0;
									}
									array_push($status_array, $status);
								}
								else {
									for ($a=0; $a<count($id_inventory_line_exp); $a++){
										$id_part_list_line = $id_part_list_line_exp[$a];
										$id_inventory_line = $id_inventory_line_exp[$a];
										$inventory_cd_line = $inventory_cd_line_exp[$a];
										$inventory_name_line = $inventory_name_line_exp[$a];
										$JobNo_line = $JobNo_line_exp[$a];
										$qty_order_line = $qty_order_line_exp[$a];
										$uom_cd_line = $uom_cd_line_exp[$a];
										$unit_price_line = $unit_price_line_exp[$a];
										$line_sub_amount_line = $line_sub_amount_line_exp[$a];
										$discount_amount_line = $discount_amount_line_exp[$a];
										$discount_percent_line = $discount_percent_line_exp[$a];
										$line_amount_line = $line_amount_line_exp[$a];
										$item_class_cd_line = $item_class_cd_line_exp[$a];
										$sub_tax_cd_line = $sub_tax_cd_line_exp[$a];
										$coa_cd_line = $coa_cd_line_exp[$a];
										$coa_name_line = $coa_name_line_exp[$a];
										$warehouse_name_line = $warehouse_name_line_exp[$a];

										if ($id_part_list_line=='0') {
											$id_part_list = '';
											$part_no = '';
											$part_name = '';
										}
										else {
											$result_part_list = $this->m_jomread->list_part_list($company_id_session, $id_part_list_line);
											$id_part_list = $id_part_list_line;
											$part_no = $result_part_list[0]->part_no;
											$part_name = $result_part_list[0]->part_name;
										}

										if ($JobNo_line=='') {
											$id_job_order = '';
											$JobNo = '';
										}
										else {
											$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
											$id_job_order = $result_job_order[0]->id_job_order;
											$JobNo = $JobNo_line;
										}

										$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
										$id_uom = $result_uom[0]->id_uom;
										$uom_cd = $uom_cd_line;
										$uom_name = $result_uom[0]->uom_name;

										$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
										$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
										$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
										$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

										$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
										$id_coa = $result_coa[0]->id_coa;
										$coa_cd = $coa_cd_line;
										$coa_name = $coa_name_line;

										$result_warehouse = $this->m_inventoryread->list_warehouse_by_warehouse_name($company_id_session, $warehouse_name_line);
										$id_warehouse = $result_warehouse[0]->id_warehouse;
										$warehouse_cd = $result_warehouse[0]->warehouse_cd;
										$warehouse_name = $warehouse_name_line;

										$result_item_class = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd_line);
										$id_item_class = $result_item_class[0]->id_item_class;
										$item_class_cd = $item_class_cd_line;
										$item_class_name = $result_item_class[0]->item_class_name;

										$cury_unit_price = $unit_price_line*$rate;
										$cury_sub_amount = $line_sub_amount_line*$rate;
										$cury_discount_amount = $discount_amount_line*$rate;
										$cury_amount = $line_amount_line*$rate;

										$data_line = array (
											//'id_purchase_order_line' => $,
											'company_id' => $company_id_session,
											'purchase_order_number' => $purchase_order_number,
											'line_number' => ($a+1),
											'id_inventory' => $id_inventory_line*1,
											'inventory_cd' => $inventory_cd_line,
											'description' => $inventory_name_line,
											'id_part_list' => $id_part_list*1,
											'part_no' => $part_no,
											'part_name' => $part_name,
											'id_job_order' => $id_job_order,
											'JobNo' => $JobNo,
											'purchase_order_line_qty' => $qty_order_line*1,
											'purchase_order_line_qty_purchase_receipt' => 0,
											'id_uom' => $id_uom,
											'uom_cd' => $uom_cd,
											'uom_name' => $uom_name,
											'cury_unit_price' => $cury_unit_price,
											'unit_price' => $unit_price_line,
											'cury_sub_amount' => $cury_sub_amount,
											'sub_amount' => $line_sub_amount_line,
											'cury_discount_amount' => $cury_discount_amount,
											'discount_amount' => $discount_amount_line,
											'discount_percent' => $discount_percent_line,
											'cury_amount' => $cury_amount,
											'amount' => $line_amount_line,
											'id_sub_tax' => $id_sub_tax,
											'sub_tax_cd' => $sub_tax_cd,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa,
											'coa_cd' => $coa_cd,
											'coa_name' => $coa_name,
											'id_warehouse' => $id_warehouse,
											'warehouse_cd' => $warehouse_cd,
											'warehouse_name' => $warehouse_name,
											'id_item_class' => $id_item_class,
											'item_class_cd' => $item_class_cd,
											'item_class_name' => $item_class_name,
											'line_status' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										array_push ($data_line_array, $data_line);
										$result_line = $this->m_distributioncreate->add_purchase_order_line($data_line);
										if ($result_line==true) {
											$status = 1;
										}
										else {
											$status = 0;
										}
										array_push($status_array, $status);
									}							
								}
							}
							else {
								$status = 0;
								array_push($status_array, $status);
							}
						}
						else {
							$data_header = array (
								'year' => $year,
								'periode' => $periode,
								'purchase_order_date' => $purchase_order_date,
								'vendor_quotation_number' => $vendor_quotation_number,
								'cNIK_approval' => $cNIK_approval,
								'id_coa_currency' => $id_coa_currency,
								'rate' => $rate*1,
								'total_line' => count($id_inventory_line_exp),
								'total_qty' => $total_qty*1,							
								'cury_sub_amount' => (($sub_amount*1)*($rate*1)),
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => ($discount_amount*1)*($rate*1),
								'discount_amount' => $discount_amount*1,							
								'cury_amount' => ($amount*1)*($rate*1),
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,							
								'cury_total_amount' => ($total_amount*1)*($rate*1),
								'total_amount' => $total_amount*1,
								'note' => $note,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result_header = $this->m_distributionupdate->update_purchase_order($company_id_session, $data_header, $id_purchase_order);
							if ($result_header == true) {
								$data_line_array = array();
								if (count($id_inventory_line_exp)==1) {
									$id_purchase_order_line = $id_purchase_order_line_post;
									$id_part_list_line = $id_part_list_line_post;
									$id_inventory_line = $id_inventory_line_post;
									$inventory_cd_line = $inventory_cd_line_post;
									$inventory_name_line = $inventory_name_line_post;
									$JobNo_line = $JobNo_line_post;
									$qty_order_line = $qty_order_line_post;
									$uom_cd_line = $uom_cd_line_post;
									$unit_price_line = $unit_price_line_post;
									$line_sub_amount_line = $line_sub_amount_line_post;
									$discount_amount_line = $discount_amount_line_post;
									$discount_percent_line = $discount_percent_line_post;
									$line_amount_line = $line_amount_line_post;
									$item_class_cd_line = $item_class_cd_line_post;
									$sub_tax_cd_line = $sub_tax_cd_line_post;
									$coa_cd_line = $coa_cd_line_post;
									$coa_name_line = $coa_name_line_post;
									$warehouse_name_line = $warehouse_name_line_post;

									if ($id_part_list_line=='0') {
										$id_part_list = '';
										$part_no = '';
										$part_name = '';
									}
									else {
										$result_part_list = $this->m_jomread->list_part_list($company_id_session, $id_part_list_line);
										$id_part_list = $id_part_list_line;
										$part_no = $result_part_list[0]->part_no;
										$part_name = $result_part_list[0]->part_name;
									}

									if ($JobNo_line=='') {
										$id_job_order = '';
										$JobNo = '';
									}
									else {
										$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
										$id_job_order = $result_job_order[0]->id_job_order;
										$JobNo = $JobNo_line;
									}

									$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
									$id_uom = $result_uom[0]->id_uom;
									$uom_cd = $uom_cd_line;
									$uom_name = $result_uom[0]->uom_name;

									$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
									$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
									$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
									$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

									$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
									$id_coa = $result_coa[0]->id_coa;
									$coa_cd = $coa_cd_line;
									$coa_name = $coa_name_line;

									$result_warehouse = $this->m_inventoryread->list_warehouse_by_warehouse_name($company_id_session, $warehouse_name_line);
									$id_warehouse = $result_warehouse[0]->id_warehouse;
									$warehouse_cd = $result_warehouse[0]->warehouse_cd;
									$warehouse_name = $warehouse_name_line;

									$result_item_class = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd_line);
									$id_item_class = $result_item_class[0]->id_item_class;
									$item_class_cd = $item_class_cd_line;
									$item_class_name = $result_item_class[0]->item_class_name;

									$cury_unit_price = $unit_price_line*$rate;
									$cury_sub_amount = $line_sub_amount_line*$rate;
									$cury_discount_amount = $discount_amount_line*$rate;
									$cury_amount = $line_amount_line*$rate;

									if ($id_part_list_line=='0') {
										$data_line = array (
											//'id_purchase_order_line' => $,
											'company_id' => $company_id_session,
											'purchase_order_number' => $purchase_order_number,
											'line_number' => 1,
											'id_inventory' => $id_inventory_line*1,
											'inventory_cd' => $inventory_cd_line,
											'description' => $inventory_name_line,
											'id_part_list' => $id_part_list*1,
											'part_no' => $part_no,
											'part_name' => $part_name,
											'id_job_order' => $id_job_order,
											'JobNo' => $JobNo,
											'purchase_order_line_qty' => $qty_order_line*1,
											'purchase_order_line_qty_purchase_receipt' => 0,
											'id_uom' => $id_uom,
											'uom_cd' => $uom_cd,
											'uom_name' => $uom_name,
											'cury_unit_price' => $cury_unit_price,
											'unit_price' => $unit_price_line,
											'cury_sub_amount' => $cury_sub_amount,
											'sub_amount' => $line_sub_amount_line,
											'cury_discount_amount' => $cury_discount_amount,
											'discount_amount' => $discount_amount_line,
											'discount_percent' => $discount_percent_line,
											'cury_amount' => $cury_amount,
											'amount' => $line_amount_line,
											'id_sub_tax' => $id_sub_tax,
											'sub_tax_cd' => $sub_tax_cd,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa,
											'coa_cd' => $coa_cd,
											'coa_name' => $coa_name,
											'id_warehouse' => $id_warehouse,
											'warehouse_cd' => $warehouse_cd,
											'warehouse_name' => $warehouse_name,
											'id_item_class' => $id_item_class,
											'item_class_cd' => $item_class_cd,
											'item_class_name' => $item_class_name,
											'line_status' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										array_push ($data_line_array, $data_line);
										$result_line = $this->m_distributioncreate->add_purchase_order_line($data_line);
										if ($result_line==true) {
											$status = 1;
										}
										else {
											$status = 0;
										}
										array_push($status_array, $status);
									}
									else {
										if ($id_inventory_line=='') {
											$result_line = $this->m_distributionupdate->delete_purchase_order_line($company_id_session, $id_purchase_order_line);
											if ($result_line==true) {
												$status = 1;
											}
											else {
												$status = 0;
											}
											array_push($status_array, $status);
										}
										else {
											$data_line = array (
												//'id_purchase_order_line' => $,
												//'company_id' => $company_id_session,
												//'purchase_order_number' => $purchase_order_number,
												//'line_number' => 1,
												'id_inventory' => $id_inventory_line*1,
												'inventory_cd' => $inventory_cd_line,
												'description' => $inventory_name_line,
												'id_part_list' => $id_part_list*1,
												'part_no' => $part_no,
												'part_name' => $part_name,
												'id_job_order' => $id_job_order,
												'JobNo' => $JobNo,
												'purchase_order_line_qty' => $qty_order_line*1,
												'purchase_order_line_qty_purchase_receipt' => 0,
												'id_uom' => $id_uom,
												'uom_cd' => $uom_cd,
												'uom_name' => $uom_name,
												'cury_unit_price' => $cury_unit_price,
												'unit_price' => $unit_price_line,
												'cury_sub_amount' => $cury_sub_amount,
												'sub_amount' => $line_sub_amount_line,
												'cury_discount_amount' => $cury_discount_amount,
												'discount_amount' => $discount_amount_line,
												'discount_percent' => $discount_percent_line,
												'cury_amount' => $cury_amount,
												'amount' => $line_amount_line,
												'id_sub_tax' => $id_sub_tax,
												'sub_tax_cd' => $sub_tax_cd,
												'sub_tax_name' => $sub_tax_name,
												'id_coa' => $id_coa,
												'coa_cd' => $coa_cd,
												'coa_name' => $coa_name,
												'id_warehouse' => $id_warehouse,
												'warehouse_cd' => $warehouse_cd,
												'warehouse_name' => $warehouse_name,
												'id_item_class' => $id_item_class,
												'item_class_cd' => $item_class_cd,
												'item_class_name' => $item_class_name,
												//'line_status' => 0,
												//'create_by' => $cNIK_session,
												//'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											array_push ($data_line_array, $data_line);
											$result_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_line, $id_purchase_order_line);
											if ($result_line==true) {
												$status = 1;
											}
											else {
												$status = 0;
											}
											array_push($status_array, $status);
										}
									}
								}
								else {
									for ($a=0; $a<count($id_inventory_line_exp); $a++){
										$id_purchase_order_line = $id_purchase_order_line_exp[$a];
										$id_part_list_line = $id_part_list_line_exp[$a];
										$id_inventory_line = $id_inventory_line_exp[$a];
										$inventory_cd_line = $inventory_cd_line_exp[$a];
										$inventory_name_line = $inventory_name_line_exp[$a];
										$JobNo_line = $JobNo_line_exp[$a];
										$qty_order_line = $qty_order_line_exp[$a];
										$uom_cd_line = $uom_cd_line_exp[$a];
										$unit_price_line = $unit_price_line_exp[$a];
										$line_sub_amount_line = $line_sub_amount_line_exp[$a];
										$discount_amount_line = $discount_amount_line_exp[$a];
										$discount_percent_line = $discount_percent_line_exp[$a];
										$line_amount_line = $line_amount_line_exp[$a];
										$item_class_cd_line = $item_class_cd_line_exp[$a];
										$sub_tax_cd_line = $sub_tax_cd_line_exp[$a];
										$coa_cd_line = $coa_cd_line_exp[$a];
										$coa_name_line = $coa_name_line_exp[$a];
										$warehouse_name_line = $warehouse_name_line_exp[$a];

										if ($id_part_list_line=='0') {
											$id_part_list = '';
											$part_no = '';
											$part_name = '';
										}
										else {
											$result_part_list = $this->m_jomread->list_part_list($company_id_session, $id_part_list_line);
											$id_part_list = $id_part_list_line;
											$part_no = $result_part_list[0]->part_no;
											$part_name = $result_part_list[0]->part_name;
										}

										if ($JobNo_line=='') {
											$id_job_order = '';
											$JobNo = '';
										}
										else {
											$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
											$id_job_order = $result_job_order[0]->id_job_order;
											$JobNo = $JobNo_line;
										}

										$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
										$id_uom = $result_uom[0]->id_uom;
										$uom_cd = $uom_cd_line;
										$uom_name = $result_uom[0]->uom_name;

										$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
										$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
										$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
										$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

										$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
										$id_coa = $result_coa[0]->id_coa;
										$coa_cd = $coa_cd_line;
										$coa_name = $coa_name_line;

										$result_warehouse = $this->m_inventoryread->list_warehouse_by_warehouse_name($company_id_session, $warehouse_name_line);
										$id_warehouse = $result_warehouse[0]->id_warehouse;
										$warehouse_cd = $result_warehouse[0]->warehouse_cd;
										$warehouse_name = $warehouse_name_line;

										$result_item_class = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd_line);
										$id_item_class = $result_item_class[0]->id_item_class;
										$item_class_cd = $item_class_cd_line;
										$item_class_name = $result_item_class[0]->item_class_name;

										$cury_unit_price = $unit_price_line*$rate;
										$cury_sub_amount = $line_sub_amount_line*$rate;
										$cury_discount_amount = $discount_amount_line*$rate;
										$cury_amount = $line_amount_line*$rate;

										if ($id_purchase_order_line == '') {
											$data_line = array (
												//'id_purchase_order_line' => $,
												'company_id' => $company_id_session,
												'purchase_order_number' => $purchase_order_number,
												'line_number' => ($a+1),
												'id_inventory' => $id_inventory_line*1,
												'inventory_cd' => $inventory_cd_line,
												'description' => $inventory_name_line,
												'id_part_list' => $id_part_list*1,
												'part_no' => $part_no,
												'part_name' => $part_name,
												'id_job_order' => $id_job_order,
												'JobNo' => $JobNo,
												'purchase_order_line_qty' => $qty_order_line*1,
												'purchase_order_line_qty_purchase_receipt' => 0,
												'id_uom' => $id_uom,
												'uom_cd' => $uom_cd,
												'uom_name' => $uom_name,
												'cury_unit_price' => $cury_unit_price,
												'unit_price' => $unit_price_line,
												'cury_sub_amount' => $cury_sub_amount,
												'sub_amount' => $line_sub_amount_line,
												'cury_discount_amount' => $cury_discount_amount,
												'discount_amount' => $discount_amount_line,
												'discount_percent' => $discount_percent_line,
												'cury_amount' => $cury_amount,
												'amount' => $line_amount_line,
												'id_sub_tax' => $id_sub_tax,
												'sub_tax_cd' => $sub_tax_cd,
												'sub_tax_name' => $sub_tax_name,
												'id_coa' => $id_coa,
												'coa_cd' => $coa_cd,
												'coa_name' => $coa_name,
												'id_warehouse' => $id_warehouse,
												'warehouse_cd' => $warehouse_cd,
												'warehouse_name' => $warehouse_name,
												'id_item_class' => $id_item_class,
												'item_class_cd' => $item_class_cd,
												'item_class_name' => $item_class_name,
												'line_status' => 0,
												'create_by' => $cNIK_session,
												'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
											);
											array_push ($data_line_array, $data_line);
											$result_line = $this->m_distributioncreate->add_purchase_order_line($data_line);
											if ($result_line==true) {
												$status = 1;
											}
											else {
												$status = 0;
											}
											array_push($status_array, $status);
										}
										else {
											if ($id_inventory_line != '' && $inventory_cd_line == '') {
												$result_line = $this->m_distributionupdate->delete_purchase_order_line($company_id_session, $id_purchase_order_line);
												if ($result_line==true) {
													$status = 1;
												}
												else {
													$status = 0;
												}
												array_push($status_array, $status);
											}
											else {
												$data_line = array (
													//'id_purchase_order_line' => $,
													//'company_id' => $company_id_session,
													//'purchase_order_number' => $purchase_order_number,
													//'line_number' => 1,
													'id_inventory' => $id_inventory_line*1,
													'inventory_cd' => $inventory_cd_line,
													'description' => $inventory_name_line,
													'id_part_list' => $id_part_list*1,
													'part_no' => $part_no,
													'part_name' => $part_name,
													'id_job_order' => $id_job_order,
													'JobNo' => $JobNo,
													'purchase_order_line_qty' => $qty_order_line*1,
													'purchase_order_line_qty_purchase_receipt' => 0,
													'id_uom' => $id_uom,
													'uom_cd' => $uom_cd,
													'uom_name' => $uom_name,
													'cury_unit_price' => $cury_unit_price,
													'unit_price' => $unit_price_line,
													'cury_sub_amount' => $cury_sub_amount,
													'sub_amount' => $line_sub_amount_line,
													'cury_discount_amount' => $cury_discount_amount,
													'discount_amount' => $discount_amount_line,
													'discount_percent' => $discount_percent_line,
													'cury_amount' => $cury_amount,
													'amount' => $line_amount_line,
													'id_sub_tax' => $id_sub_tax,
													'sub_tax_cd' => $sub_tax_cd,
													'sub_tax_name' => $sub_tax_name,
													'id_coa' => $id_coa,
													'coa_cd' => $coa_cd,
													'coa_name' => $coa_name,
													'id_warehouse' => $id_warehouse,
													'warehouse_cd' => $warehouse_cd,
													'warehouse_name' => $warehouse_name,
													'id_item_class' => $id_item_class,
													'item_class_cd' => $item_class_cd,
													'item_class_name' => $item_class_name,
													//'line_status' => 0,
													//'create_by' => $cNIK_session,
													//'create_date' => $last_update,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												array_push ($data_line_array, $data_line);
												$result_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_line, $id_purchase_order_line);
												if ($result_line==true) {
													$status = 1;
												}
												else {
													$status = 0;
												}
												array_push($status_array, $status);
											}
										}
									}							
								}
							}
							else {
								$status = 0;
								array_push ($status_array, $status);
							}
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'data_header' => $data_header, 'data_line' => $data_line_array, 'response' => $responseValue, 'purchase_order_number' => $purchase_order_number)));
				}
			}
		}

		public function add_purchase_receipt($key_session){
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

					// Header

					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					$this->form_validation->set_rules('id_purchase_order', 'id_purchase_order', 'required');
					$this->form_validation->set_rules('purchase_order_number', 'purchase_order_number', 'required');
					$this->form_validation->set_rules('hold', 'hold', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
					$this->form_validation->set_rules('purchase_receipt_date', 'purchase_receipt_date', 'required');
					$this->form_validation->set_rules('total_line', 'total_line', 'required');
					$this->form_validation->set_rules('total_qty', 'total_qty', 'required');
					$this->form_validation->set_rules('id_account', 'id_account', 'required');
					$this->form_validation->set_rules('vendor_receipt_number', 'vendor_receipt_number', 'required');
					$this->form_validation->set_rules('id_coa_currency', 'id_coa_currency', 'required');
					$this->form_validation->set_rules('rate', 'rate', 'required');
					$this->form_validation->set_rules('purchase_receipt_owner', 'purchase_receipt_owner', 'required');
					$this->form_validation->set_rules('sub_amount', 'sub_amount', 'required');
					$this->form_validation->set_rules('discount_amount', 'discount_amount', 'required');
					$this->form_validation->set_rules('amount', 'amount', 'required');
					$this->form_validation->set_rules('ppn', 'ppn', 'required');
					$this->form_validation->set_rules('pph', 'pph', 'required');
					$this->form_validation->set_rules('total_amount', 'total_amount', 'required');
					
					// Line

					$this->form_validation->set_rules('id_purchase_order_line', 'id_purchase_order_line', 'required');
					$this->form_validation->set_rules('id_inventory_line', 'id_inventory_line', 'required');
					$this->form_validation->set_rules('inventory_cd_line', 'inventory_cd_line', 'required');
					$this->form_validation->set_rules('inventory_name_line', 'inventory_name_line', 'required');
					$this->form_validation->set_rules('qty_order_line', 'qty_order_line', 'required');
					$this->form_validation->set_rules('qty_receipt_line', 'qty_receipt_line', 'required');
					$this->form_validation->set_rules('uom_cd_line', 'uom_cd_line', 'required');
					$this->form_validation->set_rules('unit_price_line', 'unit_price_line', 'required');
					$this->form_validation->set_rules('line_sub_amount_line', 'line_sub_amount_line', 'required');
					$this->form_validation->set_rules('discount_amount_line', 'discount_amount_line', 'required');
					$this->form_validation->set_rules('discount_percent_line', 'discount_percent_line', 'required');
					$this->form_validation->set_rules('line_amount_line', 'line_amount_line', 'required');
					$this->form_validation->set_rules('item_class_cd_line', 'item_class_cd_line', 'required');
					$this->form_validation->set_rules('sub_tax_cd_line', 'sub_tax_cd_line', 'required');
					$this->form_validation->set_rules('coa_cd_line', 'coa_cd_line', 'required');
					$this->form_validation->set_rules('coa_name_line', 'coa_name_line', 'required');
					$this->form_validation->set_rules('warehouse_name_line', 'warehouse_name_line', 'required');

					$status_array = array();
					
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
						array_push ($status_array, $status);
					}
					else {

						// Header
						$id_module = $this->input->post('id_module');
						$id_purchase_order = $this->input->post('id_purchase_order');
						$purchase_order_number = $this->input->post('purchase_order_number');
						$id_purchase_receipt = $this->input->post('id_purchase_receipt');
						$purchase_receipt_number_post = $this->input->post('purchase_receipt_number');
						$hold = $this->input->post('hold');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$purchase_receipt_date = $this->input->post('purchase_receipt_date');
						$note = $this->input->post('note');
						$total_line = $this->input->post('total_line');
						$total_qty = $this->input->post('total_qty');
						$id_account_post = $this->input->post('id_account');
						$vendor_receipt_number = $this->input->post('vendor_receipt_number');
						$id_coa_currency_post = $this->input->post('id_coa_currency');
						$rate = $this->input->post('rate');
						$purchase_receipt_owner = $this->input->post('purchase_receipt_owner');
						$cNIK_receipt_post = $this->input->post('cNIK_receipt');
						$sub_amount = $this->input->post('sub_amount');
						$discount_amount = $this->input->post('discount_amount');
						$amount = $this->input->post('amount');
						$ppn = $this->input->post('ppn');
						$pph = $this->input->post('pph');
						$total_amount = $this->input->post('total_amount');

						if ($hold==true) {
							$hold_check = 1;
						}
						else {
							$hold_check = 0;
						}

						$result_account = $this->m_jomread->list_account_by_account_name($company_id_session, 'vendor', $id_account_post);
						$id_account = $result_account[0]->id_account;

						$result_coa_currency = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $id_coa_currency_post);
						$id_coa_currency = $result_coa_currency[0]->id_coa_currency;

						$cNIK_receipt = null;

						$year = date_format(date_create($purchase_receipt_date), 'Y');
						$periode = date_format(date_create($purchase_receipt_date), 'Y-m');

						if ($purchase_receipt_number_post=='') {
							$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_year($company_id_session, $year);
							$purchase_receipt_count = count($result_purchase_receipt);
							$purchase_receipt_next = $purchase_receipt_count+1;

							$result_numbering_sequence = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
							$string_format = $result_numbering_sequence[0]->string_format;
							$cut_1 = $result_numbering_sequence[0]->cut_1;
							$cut_2 = $result_numbering_sequence[0]->cut_2;
							$number_length = $result_numbering_sequence[0]->number_length;

							$purchase_receipt_next_add_zero = sprintf("%0".$number_length."d", $purchase_receipt_next);
							$purchase_receipt_number = $string_format.''.$cut_1.''.$year.''.$cut_2.''.$purchase_receipt_next_add_zero;
						}
						else {
							$purchase_receipt_number = $purchase_receipt_number_post;
						}

						$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, 1);
						$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;
						
						// Line
						$id_purchase_receipt_line_post = $this->input->post('id_purchase_receipt_line');
						$id_purchase_order_line_post = $this->input->post('id_purchase_order_line');
						$id_part_list_line_post = $this->input->post('id_part_list_line');
						$id_inventory_line_post = $this->input->post('id_inventory_line');
						$inventory_cd_line_post = $this->input->post('inventory_cd_line');
						$inventory_name_line_post = $this->input->post('inventory_name_line');
						$JobNo_line_post = $this->input->post('JobNo_line');
						$qty_order_line_post = $this->input->post('qty_order_line');
						$qty_receipt_line_post = $this->input->post('qty_receipt_line');
						$uom_cd_line_post = $this->input->post('uom_cd_line');
						$unit_price_line_post = $this->input->post('unit_price_line');
						$line_sub_amount_line_post = $this->input->post('line_sub_amount_line');
						$discount_amount_line_post = $this->input->post('discount_amount_line');
						$discount_percent_line_post = $this->input->post('discount_percent_line');
						$line_amount_line_post = $this->input->post('line_amount_line');
						$item_class_cd_line_post = $this->input->post('item_class_cd_line');
						$sub_tax_cd_line_post = $this->input->post('sub_tax_cd_line');
						$coa_cd_line_post = $this->input->post('coa_cd_line');
						$coa_name_line_post = $this->input->post('coa_name_line');
						$warehouse_name_line_post = $this->input->post('warehouse_name_line');

						$id_purchase_receipt_line_exp = explode(',', $id_purchase_receipt_line_post);
						$id_purchase_order_line_exp = explode(',', $id_purchase_order_line_post);
						$id_part_list_line_exp = explode(',', $id_part_list_line_post);
						$id_inventory_line_exp = explode(',', $id_inventory_line_post);
						$inventory_cd_line_exp = explode(',', $inventory_cd_line_post);
						$inventory_name_line_exp = explode(',', $inventory_name_line_post);
						$JobNo_line_exp = explode(',', $JobNo_line_post);
						$qty_order_line_exp = explode(',', $qty_order_line_post);
						$qty_receipt_line_exp = explode(',', $qty_receipt_line_post);
						$uom_cd_line_exp = explode(',', $uom_cd_line_post);
						$unit_price_line_exp = explode(',', $unit_price_line_post);
						$line_sub_amount_line_exp = explode(',', $line_sub_amount_line_post);
						$discount_amount_line_exp = explode(',', $discount_amount_line_post);
						$discount_percent_line_exp = explode(',', $discount_percent_line_post);
						$line_amount_line_exp = explode(',', $line_amount_line_post);
						$item_class_cd_line_exp = explode(',', $item_class_cd_line_post);
						$sub_tax_cd_line_exp = explode(',', $sub_tax_cd_line_post);
						$coa_cd_line_exp = explode(',', $coa_cd_line_post);
						$coa_name_line_exp = explode(',', $coa_name_line_post);
						$warehouse_name_line_exp = explode(',', $warehouse_name_line_post);

						$last_update = date('Y-m-d H:i:s');

						if ($purchase_receipt_number_post == '') {
							$data_header = array (
								'company_id' => $company_id_session,
								'id_module' => $id_module,
								'purchase_receipt_number' => $purchase_receipt_number,
								'id_purchase_order' => $id_purchase_order*1,
								'purchase_order_number' => $purchase_order_number,
								'hold' => $hold_check,
								'id_transaction_role' => $id_transaction_role_old*1,
								'id_account' => $id_account,
								'year' => $year,
								'periode' => $periode,
								'purchase_receipt_date' => $purchase_receipt_date,
								'vendor_receipt_number' => $vendor_receipt_number,
								'cNIK_receipt' => $cNIK_receipt,
								'id_coa_currency' => $id_coa_currency,
								'rate' => $rate*1,
								'total_line' => count($id_inventory_line_exp),
								'total_qty' => $total_qty*1,							
								'cury_sub_amount' => (($sub_amount*1)*($rate*1)),
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => ($discount_amount*1)*($rate*1),
								'discount_amount' => $discount_amount*1,							
								'cury_amount' => ($amount*1)*($rate*1),
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,							
								'cury_total_amount' => ($total_amount*1)*($rate*1),
								'total_amount' => $total_amount*1,
								'note' => $note,
								'purchase_receipt_owner' => $cNIK_session,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0
							);
							$result_header = $this->m_distributioncreate->add_purchase_receipt($data_header);
							if ($result_header==true) {
								$data_line_array = array();
								if (count($id_inventory_line_exp)==1) {
									$id_purchase_order_line = $id_purchase_order_line_post;
									$id_part_list_line = $id_part_list_line_post;
									$id_inventory_line = $id_inventory_line_post;
									$inventory_cd_line = $inventory_cd_line_post;
									$inventory_name_line = $inventory_name_line_post;
									$JobNo_line = $JobNo_line_post;
									$qty_order_line = $qty_order_line_post;
									$qty_receipt_line = $qty_receipt_line_post;
									$uom_cd_line = $uom_cd_line_post;
									$unit_price_line = $unit_price_line_post;
									$line_sub_amount_line = $line_sub_amount_line_post;
									$discount_amount_line = $discount_amount_line_post;
									$discount_percent_line = $discount_percent_line_post;
									$line_amount_line = $line_amount_line_post;
									$item_class_cd_line = $item_class_cd_line_post;
									$sub_tax_cd_line = $sub_tax_cd_line_post;
									$coa_cd_line = $coa_cd_line_post;
									$coa_name_line = $coa_name_line_post;
									$warehouse_name_line = $warehouse_name_line_post;

									if ($id_part_list_line=='0') {
										$id_part_list = '';
										$part_no = '';
										$part_name = '';
									}
									else {
										$result_part_list = $this->m_jomread->list_part_list($company_id_session, $id_part_list_line);
										$id_part_list = $id_part_list_line;
										$part_no = $inventory_cd_line;
										$part_name = $result_part_list[0]->part_name;
									}

									if ($JobNo_line=='') {
										$id_job_order = '';
										$JobNo = '';
									}
									else {
										$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
										$id_job_order = $result_job_order[0]->id_job_order;
										$JobNo = $JobNo_line;
									}

									// Cek Qty receipt line

									$result_qty_receipt_line_last = $this->m_distributionread->sum_purchase_receipt_line_by_id_purchase_order_line($company_id_session, $id_purchase_order_line);
									$total_qty_receipt_line = $result_qty_receipt_line_last[0]->total_qty_receipt_line;
									$total_qty_receipt_line_new = $total_qty_receipt_line+$qty_receipt_line;

									$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
									$id_uom = $result_uom[0]->id_uom;
									$uom_cd = $uom_cd_line;
									$uom_name = $result_uom[0]->uom_name;

									$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
									$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
									$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
									$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

									$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
									$id_coa = $result_coa[0]->id_coa;
									$coa_cd = $coa_cd_line;
									$coa_name = $coa_name_line;

									$result_warehouse = $this->m_inventoryread->list_warehouse_by_warehouse_name($company_id_session, $warehouse_name_line);
									$id_warehouse = $result_warehouse[0]->id_warehouse;
									$warehouse_cd = $result_warehouse[0]->warehouse_cd;
									$warehouse_name = $warehouse_name_line;

									$result_item_class = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd_line);
									$id_item_class = $result_item_class[0]->id_item_class;
									$item_class_cd = $item_class_cd_line;
									$item_class_name = $result_item_class[0]->item_class_name;

									$cury_unit_price = $unit_price_line*$rate;
									$cury_sub_amount = $line_sub_amount_line*$rate;
									$cury_discount_amount = $discount_amount_line*$rate;
									$cury_amount = $line_amount_line*$rate;

									$data_line = array (
										'company_id' => $company_id_session,
										'purchase_receipt_number' => $purchase_receipt_number,
										'id_purchase_order' => $id_purchase_order,
										'purchase_order_number' => $purchase_order_number,
										'id_purchase_order_line' => $id_purchase_order_line,
										'line_number' => ($a+1),
										'id_inventory' => $id_inventory_line*1,
										'inventory_cd' => $inventory_cd_line,
										'description' => $inventory_name_line,
										'id_part_list' => $id_part_list*1,
										'part_no' => $part_no,
										'part_name' => $part_name,
										'id_job_order' => $id_job_order,
										'JobNo' => $JobNo,
										'purchase_order_line_qty' => $qty_order_line*1,
										'purchase_receipt_line_qty' => $qty_receipt_line*1,
										'id_uom' => $id_uom,
										'uom_cd' => $uom_cd,
										'uom_name' => $uom_name,
										'cury_unit_price' => ($unit_price_line*1)*($rate*1),
										'unit_price' => $unit_price_line,
										'cury_sub_amount' => ($line_sub_amount_line*1)*($rate*1),
										'sub_amount' => $line_sub_amount_line,
										'cury_discount_amount' => ($discount_amount_line*1)*($rate*1),
										'discount_amount' => $discount_amount_line,
										'discount_percent' => $discount_percent_line,
										'cury_amount' => ($line_amount_line*1)*($rate*1),
										'amount' => $line_amount_line,
										'id_sub_tax' => $id_sub_tax,
										'sub_tax_cd' => $sub_tax_cd,
										'sub_tax_name' => $sub_tax_name,
										'id_coa' => $id_coa,
										'coa_cd' => $coa_cd,
										'coa_name' => $coa_name,
										'id_warehouse' => $id_warehouse,
										'warehouse_cd' => $warehouse_cd,
										'warehouse_name' => $warehouse_name,
										'id_item_class' => $id_item_class,
										'item_class_cd' => $item_class_cd,
										'item_class_name' => $item_class_name,
										'line_status' => 0,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
										'deleted' => 0
									);
									array_push ($data_line_array, $data_line);
									$result_line = $this->m_distributioncreate->add_purchase_receipt_line($data_line);
									if ($result_line==true) {
										if ($qty_order_line==$total_qty_receipt_line_new) {
											$line_status = 1;
											$data_purchase_order_line = array (
												'purchase_order_line_qty_purchase_receipt' => $total_qty_receipt_line_new,
												'line_status' => $line_status,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_qty_purchase_order_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_purchase_order_line, $id_purchase_order_line);
											if ($result_update_qty_purchase_order_line==true) {
												//$status = 1;
												$result_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
												$id_transaction_role_purchase_order = $result_purchase_order[0]->id_transaction_role;
												$id_module_purchase_order = $result_purchase_order[0]->id_module;
												$total_qty_purchase_order = $result_purchase_order[0]->total_qty;

												$result_transaction_role_purchase_order = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module_purchase_order, $id_transaction_role_purchase_order);
												$sequence_db = $result_transaction_role_purchase_order[0]->sequence;
												$sequence_open = $sequence_db;
												$sequence_close = $sequence_db+1;

												$result_transaction_role_sequence_open = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_open);
												$id_transaction_role_open = $result_transaction_role_sequence_open[0]->id_transaction_role;
												$result_transaction_role_sequence_close = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_close);
												$id_transaction_role_close = $result_transaction_role_sequence_close[0]->id_transaction_role;

												// Cek Qty receipt total

												$result_qty_receipt_last = $this->m_distributionread->sum_purchase_receipt_line_by_id_purchase_order($company_id_session, $id_purchase_order);
												$total_qty_receipt_line_db = $result_qty_receipt_last[0]->total_qty_receipt_line;
												$total_qty_receipt_new = $total_qty_receipt_line_db;

												if ($total_qty_purchase_order==$total_qty_receipt_new) {
													$data_header_purchase_order = array(
														'id_transaction_role' => $id_transaction_role_close*1,
														'last_by' => $cNIK_session,
														'last_update' => $last_update
													);
													$result_update_purchase_order_header = $this->m_distributionupdate->update_purchase_order($company_id_session, $data_header_purchase_order, $id_purchase_order);
													if ($result_update_purchase_order_header==true) {
														$status = 1;
													}
													else {
														$status = 0;
													}
												}
												else {
													$data_header_purchase_order = array(
														'id_transaction_role' => $id_transaction_role_open*1,
														'last_by' => $cNIK_session,
														'last_update' => $last_update
													);
													$result_update_purchase_order_header = $this->m_distributionupdate->update_purchase_order($company_id_session, $data_header_purchase_order, $id_purchase_order);
													if ($result_update_purchase_order_header==true) {
														$status = 1;
													}
													else {
														$status = 0;
													}
												}
											}
											else {
												$status = 0;
											}
										}
										else {
											$line_status = 0;
											$data_purchase_order_line = array (
												'purchase_order_line_qty_purchase_receipt' => $total_qty_receipt_line_new,
												'line_status' => $line_status,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_qty_purchase_order_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_purchase_order_line, $id_purchase_order_line);
											if ($result_update_qty_purchase_order_line==true) {
												$result_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
												$id_transaction_role_purchase_order = $result_purchase_order[0]->id_transaction_role;
												$id_module_purchase_order = $result_purchase_order[0]->id_module;
												$total_qty_purchase_order = $result_purchase_order[0]->total_qty;

												$result_transaction_role_purchase_order = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module_purchase_order, $id_transaction_role_purchase_order);
												$sequence_db = $result_transaction_role_purchase_order[0]->sequence;
												$sequence_open = $sequence_db;
												$sequence_close = $sequence_db+1;

												$result_transaction_role_sequence_open = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_open);
												$id_transaction_role_open = $result_transaction_role_sequence_open[0]->id_transaction_role;
												$result_transaction_role_sequence_close = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_close);
												$id_transaction_role_close = $result_transaction_role_sequence_close[0]->id_transaction_role;

												$data_header_purchase_order = array(
													'id_transaction_role' => $id_transaction_role_open,
													'last_by' => $cNIK_session,
													'last_update' => $last_update
												);
												$result_update_purchase_order_header = $this->m_distributionupdate->update_purchase_order($company_id_session, $data_header_purchase_order, $id_purchase_order);
												if ($result_update_purchase_order_header==true) {
													$status = 1;
												}
												else {
													$status = 0;
												}
											}
											else {
												$status = 0;
											}
										}
									}
									else {
										$status = 0;
									}
									array_push($status_array, $status);
								}
								else {
									for ($a=0; $a<count($id_inventory_line_exp); $a++){
										
										$id_purchase_order_line = $id_purchase_order_line_exp[$a];
										$id_part_list_line = $id_part_list_line_exp[$a];
										$id_inventory_line = $id_inventory_line_exp[$a];
										$inventory_cd_line = $inventory_cd_line_exp[$a];
										$inventory_name_line = $inventory_name_line_exp[$a];
										$JobNo_line = $JobNo_line_exp[$a];
										$qty_order_line = $qty_order_line_exp[$a];
										$qty_receipt_line = $qty_receipt_line_exp[$a];
										$uom_cd_line = $uom_cd_line_exp[$a];
										$unit_price_line = $unit_price_line_exp[$a];
										$line_sub_amount_line = $line_sub_amount_line_exp[$a];
										$discount_amount_line = $discount_amount_line_exp[$a];
										$discount_percent_line = $discount_percent_line_exp[$a];
										$line_amount_line = $line_amount_line_exp[$a];
										$item_class_cd_line = $item_class_cd_line_exp[$a];
										$sub_tax_cd_line = $sub_tax_cd_line_exp[$a];
										$coa_cd_line = $coa_cd_line_exp[$a];
										$coa_name_line = $coa_name_line_exp[$a];
										$warehouse_name_line = $warehouse_name_line_exp[$a];

										if ($id_part_list_line=='0') {
											$id_part_list = '';
											$part_no = '';
											$part_name = '';
										}
										else {
											$result_part_list = $this->m_jomread->list_part_list($company_id_session, $id_part_list_line);
											$id_part_list = $id_part_list_line;
											$part_no = $inventory_cd_line;
											$part_name = $result_part_list[0]->part_name;
										}

										if ($JobNo_line=='') {
											$id_job_order = '';
											$JobNo = '';
										}
										else {
											$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
											$id_job_order = $result_job_order[0]->id_job_order;
											$JobNo = $JobNo_line;
										}

										// Cek Qty receipt line

										$result_qty_receipt_line_last = $this->m_distributionread->sum_purchase_receipt_line_by_id_purchase_order_line($company_id_session, $id_purchase_order_line);
										$total_qty_receipt_line = $result_qty_receipt_line_last[0]->total_qty_receipt_line;
										$total_qty_receipt_line_new = $total_qty_receipt_line+$qty_receipt_line;

										$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
										$id_uom = $result_uom[0]->id_uom;
										$uom_cd = $uom_cd_line;
										$uom_name = $result_uom[0]->uom_name;

										$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
										$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
										$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
										$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

										$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
										$id_coa = $result_coa[0]->id_coa;
										$coa_cd = $coa_cd_line;
										$coa_name = $coa_name_line;

										$result_warehouse = $this->m_inventoryread->list_warehouse_by_warehouse_name($company_id_session, $warehouse_name_line);
										$id_warehouse = $result_warehouse[0]->id_warehouse;
										$warehouse_cd = $result_warehouse[0]->warehouse_cd;
										$warehouse_name = $warehouse_name_line;

										$result_item_class = $this->m_inventoryread->list_item_class_by_item_class_cd($company_id_session, $item_class_cd_line);
										$id_item_class = $result_item_class[0]->id_item_class;
										$item_class_cd = $item_class_cd_line;
										$item_class_name = $result_item_class[0]->item_class_name;

										$cury_unit_price = $unit_price_line*$rate;
										$cury_sub_amount = $line_sub_amount_line*$rate;
										$cury_discount_amount = $discount_amount_line*$rate;
										$cury_amount = $line_amount_line*$rate;

										$data_line = array (
											'company_id' => $company_id_session,
											'purchase_receipt_number' => $purchase_receipt_number,
											'id_purchase_order' => $id_purchase_order,
											'purchase_order_number' => $purchase_order_number,
											'id_purchase_order_line' => $id_purchase_order_line,
											'line_number' => ($a+1),
											'id_inventory' => $id_inventory_line*1,
											'inventory_cd' => $inventory_cd_line,
											'description' => $inventory_name_line,
											'id_part_list' => $id_part_list*1,
											'part_no' => $part_no,
											'part_name' => $part_name,
											'id_job_order' => $id_job_order,
											'JobNo' => $JobNo,
											'purchase_order_line_qty' => $qty_order_line*1,
											'purchase_receipt_line_qty' => $qty_receipt_line*1,
											'id_uom' => $id_uom,
											'uom_cd' => $uom_cd,
											'uom_name' => $uom_name,
											'cury_unit_price' => ($unit_price_line*1)*($rate*1),
											'unit_price' => $unit_price_line,
											'cury_sub_amount' => ($line_sub_amount_line*1)*($rate*1),
											'sub_amount' => $line_sub_amount_line,
											'cury_discount_amount' => ($discount_amount_line*1)*($rate*1),
											'discount_amount' => $discount_amount_line,
											'discount_percent' => $discount_percent_line,
											'cury_amount' => ($line_amount_line*1)*($rate*1),
											'amount' => $line_amount_line,
											'id_sub_tax' => $id_sub_tax,
											'sub_tax_cd' => $sub_tax_cd,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa,
											'coa_cd' => $coa_cd,
											'coa_name' => $coa_name,
											'id_warehouse' => $id_warehouse,
											'warehouse_cd' => $warehouse_cd,
											'warehouse_name' => $warehouse_name,
											'id_item_class' => $id_item_class,
											'item_class_cd' => $item_class_cd,
											'item_class_name' => $item_class_name,
											'line_status' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
											'deleted' => 0
										);
										array_push ($data_line_array, $data_line);
										$result_line = $this->m_distributioncreate->add_purchase_receipt_line($data_line);
										if ($result_line==true) {
											if ($qty_order_line==$total_qty_receipt_line_new) {
												$line_status = 1;
												$data_purchase_order_line = array (
													'purchase_order_line_qty_purchase_receipt' => $total_qty_receipt_line_new,
													'line_status' => $line_status,
													'last_by' => $cNIK_session,
													'last_update' => $last_update
												);
												$result_update_qty_purchase_order_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_purchase_order_line, $id_purchase_order_line);
												if ($result_update_qty_purchase_order_line==true) {
													//$status = 1;
													$result_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
													$id_transaction_role_purchase_order = $result_purchase_order[0]->id_transaction_role;
													$id_module_purchase_order = $result_purchase_order[0]->id_module;
													$total_qty_purchase_order = $result_purchase_order[0]->total_qty;

													$result_transaction_role_purchase_order = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module_purchase_order, $id_transaction_role_purchase_order);
													$sequence_db = $result_transaction_role_purchase_order[0]->sequence;
													$sequence_open = $sequence_db;
													$sequence_close = $sequence_db+1;

													$result_transaction_role_sequence_open = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_open);
													$id_transaction_role_open = $result_transaction_role_sequence_open[0]->id_transaction_role;
													$result_transaction_role_sequence_close = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_close);
													$id_transaction_role_close = $result_transaction_role_sequence_close[0]->id_transaction_role;

													// Cek Qty receipt total

													$result_qty_receipt_last = $this->m_distributionread->sum_purchase_receipt_line_by_id_purchase_order($company_id_session, $id_purchase_order);
													$total_qty_receipt_line_db = $result_qty_receipt_last[0]->total_qty_receipt_line;
													$total_qty_receipt_new = $total_qty_receipt_line_db;

													if ($total_qty_purchase_order==$total_qty_receipt_new) {
														$data_header_purchase_order = array(
															'id_transaction_role' => $id_transaction_role_close*1,
															'last_by' => $cNIK_session,
															'last_update' => $last_update
														);
														$result_update_purchase_order_header = $this->m_distributionupdate->update_purchase_order($company_id_session, $data_header_purchase_order, $id_purchase_order);
														if ($result_update_purchase_order_header==true) {
															$status = 1;
														}
														else {
															$status = 0;
														}
													}
													else {
														$data_header_purchase_order = array(
															'id_transaction_role' => $id_transaction_role_open*1,
															'last_by' => $cNIK_session,
															'last_update' => $last_update
														);
														$result_update_purchase_order_header = $this->m_distributionupdate->update_purchase_order($company_id_session, $data_header_purchase_order, $id_purchase_order);
														if ($result_update_purchase_order_header==true) {
															$status = 1;
														}
														else {
															$status = 0;
														}
													}
												}
												else {
													$status = 0;
												}
											}
											else {
												$line_status = 0;
												$data_purchase_order_line = array (
													'purchase_order_line_qty_purchase_receipt' => $total_qty_receipt_line_new,
													'line_status' => $line_status,
													'last_by' => $cNIK_session,
													'last_update' => $last_update
												);
												$result_update_qty_purchase_order_line = $this->m_distributionupdate->update_purchase_order_line($company_id_session, $data_purchase_order_line, $id_purchase_order_line);
												if ($result_update_qty_purchase_order_line==true) {
													$result_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
													$id_transaction_role_purchase_order = $result_purchase_order[0]->id_transaction_role;
													$id_module_purchase_order = $result_purchase_order[0]->id_module;
													$total_qty_purchase_order = $result_purchase_order[0]->total_qty;

													$result_transaction_role_purchase_order = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module_purchase_order, $id_transaction_role_purchase_order);
													$sequence_db = $result_transaction_role_purchase_order[0]->sequence;
													$sequence_open = $sequence_db;
													$sequence_close = $sequence_db+1;

													$result_transaction_role_sequence_open = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_open);
													$id_transaction_role_open = $result_transaction_role_sequence_open[0]->id_transaction_role;
													$result_transaction_role_sequence_close = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_order, $sequence_close);
													$id_transaction_role_close = $result_transaction_role_sequence_close[0]->id_transaction_role;

													$data_header_purchase_order = array(
														'id_transaction_role' => $id_transaction_role_open*1,
														'last_by' => $cNIK_session,
														'last_update' => $last_update
													);
													$result_update_purchase_order_header = $this->m_distributionupdate->update_purchase_order($company_id_session, $data_header_purchase_order, $id_purchase_order);
													if ($result_update_purchase_order_header==true) {
														$status = 1;
													}
													else {
														$status = 0;
													}
												}
												else {
													$status = 0;
												}
											}
										}
										else {
											$status = 0;
										}
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
					echo json_encode(array(array('status' => array_unique($status_array), 'data_header' => $data_header, 'data_line' => $data_line_array, 'response' => $responseValue, 'purchase_receipt_number' => $purchase_receipt_number, 'total_qty_purchase_order' => $total_qty_purchase_order, 'total_qty_receipt_new' => $total_qty_receipt_new)));
					//echo json_encode(array(array('status' => array_unique($status_array), 'data_header' => $data_header, 'response' => $responseValue, 'purchase_receipt_number' => $purchase_receipt_number)));
				}
			}
		}

		public function add_purchase_invoice($key_session){
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

					// Header

					$this->form_validation->set_rules('id_module', 'id_module', 'required');
                    $this->form_validation->set_rules('hold', 'hold', 'required');
                    $this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
                    $this->form_validation->set_rules('purchase_invoice_date', 'purchase_invoice_date', 'required');
                    $this->form_validation->set_rules('total_line', 'total_line', 'required');
                    $this->form_validation->set_rules('total_qty', 'total_qty', 'required');
                    $this->form_validation->set_rules('id_account', 'id_account', 'required');
                    $this->form_validation->set_rules('vendor_invoice_number', 'vendor_invoice_number', 'required');
                    $this->form_validation->set_rules('id_coa_currency', 'id_coa_currency', 'required');
                    $this->form_validation->set_rules('rate', 'rate', 'required');
                    $this->form_validation->set_rules('sub_amount', 'sub_amount', 'required');
                    $this->form_validation->set_rules('discount_amount', 'discount_amount', 'required');
                    $this->form_validation->set_rules('amount', 'amount', 'required');
                    $this->form_validation->set_rules('ppn', 'ppn', 'required');
                    $this->form_validation->set_rules('pph', 'pph', 'required');
                    $this->form_validation->set_rules('total_amount', 'total_amount', 'required');
                    $this->form_validation->set_rules('id_purchase_receipt_line_array', 'id_purchase_receipt_line_array', 'required');

					$status_array = array();
					$data_header_array = array();
					$data_line_array = array();
					$last_update = date('Y-m-d H:i:s');
					
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
						array_push ($status_array, $status);
					}
					else {
						// Header
						$id_purchase_invoice = $this->input->post('id_purchase_invoice');
	                    $purchase_invoice_number_post = $this->input->post('purchase_invoice_number');
	                    $id_module = $this->input->post('id_module');
	                    $hold = $this->input->post('hold');
	                    $id_transaction_role = $this->input->post('id_transaction_role');
	                    $purchase_invoice_date = $this->input->post('purchase_invoice_date');
	                    $note = $this->input->post('note');
	                    $total_line = $this->input->post('total_line');
	                    $total_qty = $this->input->post('total_qty');
	                    $id_account = $this->input->post('id_account');
	                    $vendor_invoice_number = $this->input->post('vendor_invoice_number');
	                    $vendor_tax_number = $this->input->post('vendor_tax_number');
	                    $id_coa_currency_post = $this->input->post('id_coa_currency');
	                    $rate = $this->input->post('rate');
	                    $sub_amount = $this->input->post('sub_amount');
	                    $discount_amount = $this->input->post('discount_amount');
	                    $amount = $this->input->post('amount');
	                    $ppn = $this->input->post('ppn');
	                    $pph = $this->input->post('pph');
	                    $total_amount = $this->input->post('total_amount');

	                    $id_purchase_receipt_line_array = json_decode($this->input->post('id_purchase_receipt_line_array'));
	                    $id_purchase_invoice_line_array = json_decode($this->input->post('id_purchase_invoice_line_array'));
	                    $coa_cd_line_array = json_decode($this->input->post('coa_cd_line_array'));

						if ($hold==true) {
							$hold_check = 1;
						}
						else {
							$hold_check = 0;
						}

						$result_coa_currency = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $id_coa_currency_post);
						$id_coa_currency = $result_coa_currency[0]->id_coa_currency;

						$cNIK_invoice = null;

						$year = date_format(date_create($purchase_invoice_date), 'Y');
						$periode = date_format(date_create($purchase_invoice_date), 'Y-m');

						if ($purchase_invoice_number_post=='') {
							$result_purchase_invoice = $this->m_distributionread->list_purchase_invoice_by_year($company_id_session, $year);
							$purchase_invoice_count = count($result_purchase_invoice);
							$purchase_invoice_next = $purchase_invoice_count+1;

							$result_numbering_sequence = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
							$string_format = $result_numbering_sequence[0]->string_format;
							$cut_1 = $result_numbering_sequence[0]->cut_1;
							$cut_2 = $result_numbering_sequence[0]->cut_2;
							$number_length = $result_numbering_sequence[0]->number_length;

							$purchase_invoice_next_add_zero = sprintf("%0".$number_length."d", $purchase_invoice_next);
							$purchase_invoice_number = $string_format.''.$cut_1.''.$year.''.$cut_2.''.$purchase_invoice_next_add_zero;
						}
						else {
							$purchase_invoice_number = $purchase_invoice_number_post;
						}

						if ($id_purchase_invoice=='') {
							$result_transaction_role_old = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, 1);
							$id_transaction_role_old = $result_transaction_role_old[0]->id_transaction_role;

							$data_header = array(
								"company_id" => $company_id_session*1,
								"id_module" => $id_module*1,
								"purchase_invoice_number" => $purchase_invoice_number,
								"hold" => 1,
								"id_account" => $id_account*1,
								"year" => $year,
								"periode" => $periode,
								"purchase_invoice_date" => $purchase_invoice_date,
								"vendor_invoice_number" => $vendor_invoice_number,
								"vendor_tax_number" => $vendor_tax_number,
								"id_coa_currency" => $id_coa_currency*1,
								"rate" => $rate*1,
								"total_line" => $total_line*1,
								"total_qty" => $total_qty*1,
								"cury_sub_amount" => ($sub_amount*1)*($rate*1),
								"sub_amount" => $sub_amount*1,
								"cury_discount_amount" => ($discount_amount*1)*($rate*1),
								"discount_amount" => $discount_amount*1,
								"cury_amount" => ($amount*1)*($rate*1),
								"amount" => $amount*1,
								"ppn" => $ppn*1,
								"pph" => $pph*1,
								"cury_total_amount" => ($total_amount*1)*($rate*1),
								"total_amount" => $total_amount*1,
								"id_transaction_role" => $id_transaction_role*1,
								"note" => $note,
								"create_by" => $cNIK_session,
								"create_date" => $last_update,
								"last_by" => $cNIK_session,
								"last_update" => $last_update,
								"deleted" => 0
							);
							array_push ($data_header_array, $data_header);
							$result_header = $this->m_distributioncreate->add_purchase_invoice($data_header);
							if ($result_header == true) {
								for ($i=0; $i < count($id_purchase_receipt_line_array); $i++) { 
									$id_purchase_receipt_line = $id_purchase_receipt_line_array[$i];
									$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line($company_id_session, $id_purchase_receipt_line);

									$company_id = $result_purchase_receipt_line[0]->company_id;
									$company_name = $result_purchase_receipt_line[0]->company_name;
									$id_purchase_receipt = $result_purchase_receipt_line[0]->id_purchase_receipt;
									$purchase_receipt_number = $result_purchase_receipt_line[0]->purchase_receipt_number;
									$id_purchase_order = $result_purchase_receipt_line[0]->id_purchase_order;
									$purchase_order_number = $result_purchase_receipt_line[0]->purchase_order_number;
									$id_account = $result_purchase_receipt_line[0]->id_account;
									$account_cd = $result_purchase_receipt_line[0]->account_cd;
									$account_name = $result_purchase_receipt_line[0]->account_name;
									$id_coa_currency = $result_purchase_receipt_line[0]->id_coa_currency;
									$coa_currency_cd = $result_purchase_receipt_line[0]->coa_currency_cd;
									$coa_currency_name = $result_purchase_receipt_line[0]->coa_currency_name;
									$decimal_after = $result_purchase_receipt_line[0]->decimal_after;
									$id_purchase_order_line = $result_purchase_receipt_line[0]->id_purchase_order_line;
									$line_number = $result_purchase_receipt_line[0]->line_number;
									$id_inventory = $result_purchase_receipt_line[0]->id_inventory;
									$inventory_cd = $result_purchase_receipt_line[0]->inventory_cd;
									$description = $result_purchase_receipt_line[0]->description;
									$id_part_list = $result_purchase_receipt_line[0]->id_part_list;
									$part_no = $result_purchase_receipt_line[0]->part_no;
									$part_name = $result_purchase_receipt_line[0]->part_name;
									$id_job_order = $result_purchase_receipt_line[0]->id_job_order;
									$JobNo = $result_purchase_receipt_line[0]->JobNo;
									$purchase_order_line_qty = $result_purchase_receipt_line[0]->purchase_order_line_qty;
									$purchase_receipt_line_qty = $result_purchase_receipt_line[0]->purchase_receipt_line_qty;
									$id_uom = $result_purchase_receipt_line[0]->id_uom;
									$uom_cd = $result_purchase_receipt_line[0]->uom_cd;
									$uom_name = $result_purchase_receipt_line[0]->uom_name;
									$cury_unit_price = $result_purchase_receipt_line[0]->cury_unit_price;
									$unit_price = $result_purchase_receipt_line[0]->unit_price;
									$cury_sub_amount = $result_purchase_receipt_line[0]->cury_sub_amount;
									$sub_amount = $result_purchase_receipt_line[0]->sub_amount;
									$cury_discount_amount = $result_purchase_receipt_line[0]->cury_discount_amount;
									$discount_amount = $result_purchase_receipt_line[0]->discount_amount;
									$discount_percent = $result_purchase_receipt_line[0]->discount_percent;
									$cury_amount = $result_purchase_receipt_line[0]->cury_amount;
									$amount = $result_purchase_receipt_line[0]->amount;
									$id_sub_tax = $result_purchase_receipt_line[0]->id_sub_tax;
									$sub_tax_cd = $result_purchase_receipt_line[0]->sub_tax_cd;
									$sub_tax_name = $result_purchase_receipt_line[0]->sub_tax_name;
									$sub_tax_percent_plus = $result_purchase_receipt_line[0]->sub_tax_percent_plus;
									$sub_tax_percent_minus = $result_purchase_receipt_line[0]->sub_tax_percent_minus;
									//$id_coa = $result_purchase_receipt_line[0]->id_coa;
									//$coa_cd = $result_purchase_receipt_line[0]->coa_cd;
									//$coa_name = $result_purchase_receipt_line[0]->coa_name;
									$id_warehouse = $result_purchase_receipt_line[0]->id_warehouse;
									$warehouse_cd = $result_purchase_receipt_line[0]->warehouse_cd;
									$warehouse_name = $result_purchase_receipt_line[0]->warehouse_name;
									$id_item_class = $result_purchase_receipt_line[0]->id_item_class;
									$item_class_cd = $result_purchase_receipt_line[0]->item_class_cd;
									$item_class_name = $result_purchase_receipt_line[0]->item_class_name;
									$line_status = $result_purchase_receipt_line[0]->line_status;
									$create_by = $result_purchase_receipt_line[0]->create_by;
									$cNmPegawai_create = $result_purchase_receipt_line[0]->cNmPegawai_create;
									$create_date = $result_purchase_receipt_line[0]->create_date;
									$last_by = $result_purchase_receipt_line[0]->last_by;
									$cNmPegawai_last = $result_purchase_receipt_line[0]->cNmPegawai_last;
									$last_update = $result_purchase_receipt_line[0]->last_update;

									$coa_cd_line = $coa_cd_line_array[$i];
									$result_coa_line = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
									$id_coa = $result_coa_line[0]->id_coa;
									$coa_cd = $result_coa_line[0]->coa_cd;
									$coa_name = $result_coa_line[0]->coa_name;

									$data_line = array(
										'company_id' => $company_id_session,
										'purchase_invoice_number' => $purchase_invoice_number,
										'id_purchase_order' => $id_purchase_order,
										'purchase_order_number' => $purchase_order_number,
										'id_purchase_order_line' => $id_purchase_order_line,
										'id_purchase_receipt' => $id_purchase_receipt,
										'purchase_receipt_number' => $purchase_receipt_number,
										'id_purchase_receipt_line' => $id_purchase_receipt_line,
										'line_number' => ($i+1),
										'id_inventory' => $id_inventory,
										'inventory_cd' => $inventory_cd,
										'description' => $description,
										'id_part_list' => $id_part_list,
										'part_no' => $part_no,
										'part_name' => $part_name,
										'id_job_order' => $id_job_order,
										'JobNo' => $JobNo,
										'purchase_invoice_line_qty' => $purchase_receipt_line_qty,
										'id_uom' => $id_uom,
										'uom_cd' => $uom_cd,
										'uom_name' => $uom_name,
										'cury_unit_price' => ($unit_price*1)*($rate*1),
										'unit_price' => $unit_price,
										'cury_sub_amount' => ($sub_amount*1)*($rate*1),
										'sub_amount' => $sub_amount,
										'cury_discount_amount' => ($discount_amount*1)*($rate*1),
										'discount_amount' => $discount_amount,
										'discount_percent' => $discount_percent,
										'cury_amount' => ($amount*1)*($rate*1),
										'amount' => $amount,
										'id_sub_tax' => $id_sub_tax,
										'sub_tax_cd' => $sub_tax_cd,
										'sub_tax_name' => $sub_tax_name,
										'id_coa' => $id_coa,
										'coa_cd' => $coa_cd,
										'coa_name' => $coa_name,
										'id_warehouse' => $id_warehouse,
										'warehouse_cd' => $warehouse_cd,
										'warehouse_name' => $warehouse_name,
										'id_item_class' => $id_item_class,
										'item_class_cd' => $item_class_cd,
										'item_class_name' => $item_class_name,
										'line_status' => 0,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									array_push ($data_line_array, $data_line);
									$result_line = $this->m_distributioncreate->add_purchase_invoice_line($data_line);
									if ($result_line == true) {
										$data_line_purchase_receipt = array (
											'line_status' => 1,
											'last_by' => $cNIK_session,
											'last_update' => $last_update
										);
										$result_line_purchase_receipt = $this->m_distributionupdate->update_purchase_receipt_line($company_id_session, $data_line_purchase_receipt, $id_purchase_receipt_line);
										if ($result_line_purchase_receipt == true) {
											$status = 1;
											array_push ($status_array, $status);
										}
										else {
											$status = 0;
											array_push ($status_array, $status);
										}
									}
									else {
										$status = 0;
										array_push ($status_array, $status);
									}
								}
							}
							else {
								$status = 0;
								array_push ($status_array, $status);
							}
						}
						else {
							$data_header = array(
								"id_account" => $id_account*1,
								"year" => $year,
								"periode" => $periode,
								"purchase_invoice_date" => $purchase_invoice_date,
								"vendor_invoice_number" => $vendor_invoice_number,
								"vendor_tax_number" => $vendor_tax_number,
								"id_coa_currency" => $id_coa_currency*1,
								"rate" => $rate*1,
								"total_line" => $total_line*1,
								"total_qty" => $total_qty*1,
								"cury_sub_amount" => ($sub_amount*1)*($rate*1),
								"sub_amount" => $sub_amount*1,
								"cury_discount_amount" => ($discount_amount*1)*($rate*1),
								"discount_amount" => $discount_amount*1,
								"cury_amount" => ($amount*1)*($rate*1),
								"amount" => $amount*1,
								"ppn" => $ppn*1,
								"pph" => $pph*1,
								"cury_total_amount" => ($total_amount*1)*($rate*1),
								"total_amount" => $total_amount*1,
								"id_transaction_role" => $id_transaction_role*1,
								"note" => $note,
								"last_by" => $cNIK_session,
								"last_update" => $last_update,
							);
							array_push ($data_header_array, $data_header);
							$result_header = $this->m_distributionupdate->update_purchase_invoice($company_id_session, $data_header, $id_purchase_invoice);
							if ($result_header == true) {
								for ($i=0; $i < count($id_purchase_invoice_line_array); $i++) { 
									$id_purchase_invoice_line = $id_purchase_invoice_line_array[$i];
									$coa_cd_line = $coa_cd_line_array[$i];
									$result_coa_line = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
									$id_coa = $result_coa_line[0]->id_coa;
									$coa_cd = $result_coa_line[0]->coa_cd;
									$coa_name = $result_coa_line[0]->coa_name;
									
									$data_line = array(
										'id_coa' => $id_coa,
										'coa_cd' => $coa_cd,
										'coa_name' => $coa_name,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									array_push ($data_line_array, $data_line);
									$result_line = $this->m_distributionupdate->update_purchase_invoice_line($company_id_session, $data_line, $id_purchase_invoice_line);
									if ($result_line == true) {
										$status = 1;
										array_push ($status_array, $status);
									}
									else {
										$status = 0;
										array_push ($status_array, $status);
									}
								}
							}
							else {
								$status = 0;
								array_push ($status_array, $status);
							}
						}						
					}

					echo json_encode(array(array('status' => array_unique($status_array), 'data_header' => $data_header_array, 'data_line' => $data_line_array, 'purchase_invoice_number' => $purchase_invoice_number)));
					//echo json_encode(array(array('status' => array_unique($status_array), 'data_header' => $data_header_array, 'data_line' => $data_line_array)));
				}
			}
		}

		public function release_purchase_invoice($key_session){
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
					$data_array = array();
					$data_transaction_header_array = array();
					$data_transaction_line_array = array();

					$this->form_validation->set_rules('purchase_invoice_number', 'purchase_invoice_number', 'required');
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
						array_push ($status_array, $status);
					}
					else {
						$purchase_invoice_number = $this->input->post('purchase_invoice_number');
						$result_purchase_invoice = $this->m_distributionread->list_purchase_invoice_by_purchase_invoice_number($company_id_session, $purchase_invoice_number);

						$last_update = date('Y-m-d H:i:s');

						if (count($result_purchase_invoice) == 0) {
							$status = 0;
						}
						else {
							$module_cd = 'VP';
							$result_module = $this->m_financeread->list_module_by_module_cd($company_id_session, $module_cd);
							foreach ($result_module as $resultList_module);
							$id_module = ($resultList_module->id_module)*1;

							$result_header_numbering = $this->m_financeread->list_header_numbering($company_id_session, $id_module);
							if (count($result_header_numbering) == 0) {
								$status = 0;
								$responseValue = 'Header number not registered on system.';
							}
							else {

								foreach ($result_header_numbering as $resultList_header_numbering);
								$string_format = $resultList_header_numbering->string_format;
								$cut_1 = $resultList_header_numbering->cut_1;
								$cut_2 = $resultList_header_numbering->cut_2;
								$number_length = $resultList_header_numbering->number_length;

								foreach ($result_purchase_invoice as $resultList);
								$id_account = ($resultList->id_account)*1;
								$sequence_purchase_invoice = ($resultList->sequence)*1;
								$id_module_purchase_invoice = ($resultList->id_module)*1;
								$id_coa_currency = ($resultList->id_coa_currency)*1;
								$periode_purchase_invoice = ($resultList->periode).'-01';
								$cury_sub_amount_purchase_invoice = ($resultList->cury_sub_amount)*1;
								$sub_amount_purchase_invoice = ($resultList->sub_amount)*1;
								$cury_amount_purchase_invoice = ($resultList->cury_amount)*1;
								$amount_purchase_invoice = ($resultList->amount)*1;
								$ppn_purchase_invoice = ($resultList->ppn)*1;
								$pph_purchase_invoice = ($resultList->pph)*1;
								$cury_total_amount_purchase_invoice = ($resultList->cury_total_amount)*1;
								$total_amount_purchase_invoice = ($resultList->total_amount)*1;

								$sequence_new = $sequence_purchase_invoice+1;
								
								$result_transaction_role_new = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_purchase_invoice, $sequence_new);
								$id_transaction_role_new = $result_transaction_role_new[0]->id_transaction_role;
								$transaction_name_new = $result_transaction_role_new[0]->transaction_name;

								$year_trans = date_format(date_create($resultList->periode), 'Y');

								$result_transaction_by_year = $this->m_financeread->list_transaction_by_year($company_id_session, $id_module, $year_trans);
								$transaction_count = count($result_transaction_by_year);
								$transaction_next = $transaction_count+1;

								$result_transaction_by_account_periode = $this->m_financeread->list_transaction_by_account_periode($company_id_session, $id_module, $id_account, $id_coa_currency, $periode_purchase_invoice);

								if (count($result_transaction_by_account_periode)==0) { // Add New Transaction
									$transaction_next_add_zero = sprintf("%0".$number_length."d", $transaction_next);
									$transaction_number = $string_format.''.$cut_1.''.$year_trans.''.$cut_2.''.$transaction_next_add_zero;
									
									$cury_sub_amount = 0;
									$sub_amount_transaction = 0;
									$cury_amount_transaction = 0;
									$amount_transaction = 0;
									$ppn_transaction = 0;
									$pph_transaction = 0;
									$cury_total_amount_transaction = 0;
									$total_amount_transaction = 0;
									
									$cury_sub_amount = $cury_sub_amount_purchase_invoice+$cury_sub_amount_transaction;
									$sub_amount = $sub_amount_purchase_invoice+$sub_amount_transaction;
									$cury_amount = $cury_amount_purchase_invoice+$cury_amount_transaction;
									$amount = $amount_purchase_invoice+$amount_transaction;
									$ppn = $ppn_purchase_invoice+$ppn_transaction;
									$pph = $pph_purchase_invoice+$pph_transaction;
									$cury_total_amount = $cury_total_amount_purchase_invoice+$cury_total_amount_transaction;
									$total_amount = $total_amount_purchase_invoice+$total_amount_transaction;

									$data_transaction_header = array(
										'company_id' => $company_id_session,
										'id_coa_currency' => $id_coa_currency,
										'id_cash_account' => null,
										'id_module' => $id_module,
										'id_account' => $id_account,
										'transaction_date' => null,
										'transaction_periode' => $periode_purchase_invoice,
										'transaction_type' => 'OUT',
										'transaction_number' => $transaction_number,
										'total_line' => null,
										'total_qty' => null,
										'cury_sub_amount' => $cury_sub_amount,
										'sub_amount' => $sub_amount,
										'cury_amount' => $cury_amount,
										'amount' => $amount,
										'ppn' => $ppn,
										'pph' => $pph,
										'cury_total_amount' => $cury_total_amount,
										'total_amount' => $total_amount,
										'note' => $resultList->note,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
										'deleted' => 0,
									);
									array_push($data_transaction_header_array, $data_transaction_header);
									$result_add_transaction_header = $this->m_distributioncreate->add_transaction_header($data_transaction_header);
									if ($result_add_transaction_header==true) {
										$data_transaction_line = array(
											'company_id' => $company_id_session,
											'id_module' => $id_module,
											'id_coa_currency' => $id_coa_currency,
											'id_bank_account' => null,
											'transaction_number' => $transaction_number,
											'transaction_periode' => $periode_purchase_invoice,
											'transfer_date' => null,
											'transfer_ref' => null,
											'distribution_number' => $purchase_invoice_number,
											'check_1' => 0,
											'check_2' => 0,
											'check_3' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
											'deleted' => 0,
										);
										array_push($data_transaction_line_array, $data_transaction_line);
										$result_add_transaction_line = $this->m_distributioncreate->add_transaction_distribution($data_transaction_line);
										if ($result_add_transaction_line==true) {
											$update_distribution = array(
												'id_transaction_role' => $id_transaction_role_new,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_distribution = $this->m_distributionupdate->update_purchase_invoice_by_purchase_invoice_number($company_id_session, $update_distribution, $purchase_invoice_number);
											if ($result_update_distribution==true) {
												$status = 1;
											}
											else {
												$status = 0;
												$responseValue = 'Cannot update purchase invoice status.';
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot add transaction distribution.';
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add transaction header.';
									}

								}
								else { // Update Transaction

									foreach ($result_transaction_by_account_periode as $resultList_transaction);
									$id_transaction = $resultList_transaction->id_transaction;
									$transaction_number = $resultList_transaction->transaction_number;
									$cury_sub_amount_transaction = ($resultList_transaction->cury_sub_amount)*1;
									$sub_amount_transaction = ($resultList_transaction->sub_amount)*1;
									$cury_amount_transaction = ($resultList_transaction->cury_amount)*1;
									$amount_transaction = ($resultList_transaction->amount)*1;
									$ppn_transaction = ($resultList_transaction->ppn)*1;
									$pph_transaction = ($resultList_transaction->pph)*1;
									$cury_total_amount_transaction = ($resultList_transaction->cury_total_amount)*1;
									$total_amount_transaction = ($resultList_transaction->total_amount)*1;

									$cury_sub_amount = $cury_sub_amount_purchase_invoice+$cury_sub_amount_transaction;
									$sub_amount = $sub_amount_purchase_invoice+$sub_amount_transaction;
									$cury_amount = $cury_amount_purchase_invoice+$cury_amount_transaction;
									$amount = $amount_purchase_invoice+$amount_transaction;
									$ppn = $ppn_purchase_invoice+$ppn_transaction;
									$pph = $pph_purchase_invoice+$pph_transaction;
									$cury_total_amount = $cury_total_amount_purchase_invoice+$cury_total_amount_transaction;
									$total_amount = $total_amount_purchase_invoice+$total_amount_transaction;

									$data_transaction_header = array(
										'cury_sub_amount' => $cury_sub_amount,
										'sub_amount' => $sub_amount,
										'cury_amount' => $cury_amount,
										'amount' => $amount,
										'ppn' => $ppn,
										'pph' => $pph,
										'cury_total_amount' => $cury_total_amount,
										'total_amount' => $total_amount,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									array_push($data_transaction_header_array, $data_transaction_header);

									$result_update_transaction_header = $this->m_distributionupdate->update_transaction_header($company_id_session, $data_transaction_header, $id_transaction);
									if ($result_update_transaction_header==true) {
										$data_transaction_line = array(
											'company_id' => $company_id_session,
											'id_module' => $id_module,
											'id_coa_currency' => $id_coa_currency,
											'id_bank_account' => null,
											'transaction_number' => $transaction_number,
											'transaction_periode' => $periode_purchase_invoice,
											'transfer_date' => null,
											'transfer_ref' => null,
											'distribution_number' => $purchase_invoice_number,
											'check_1' => 0,
											'check_2' => 0,
											'check_3' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
											'deleted' => 0,
										);
										array_push($data_transaction_line_array, $data_transaction_line);
										$result_add_transaction_line = $this->m_distributioncreate->add_transaction_distribution($data_transaction_line);
										if ($result_add_transaction_line==true) {
											$update_distribution = array(
												'id_transaction_role' => $id_transaction_role_new,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_distribution = $this->m_distributionupdate->update_purchase_invoice_by_purchase_invoice_number($company_id_session, $update_distribution, $purchase_invoice_number);
											if ($result_update_distribution==true) {
												$status = 0;
											}
											else {
												$status = 0;
											}
										}
										else {
											$status = 0;
										}
									}
									else {
										$status = 0;
									}
								}
							}
						}
					}
					echo json_encode(array(array('status' => $status, 'data_transaction_header' => $data_transaction_header_array, 'data_transaction_line' => $data_transaction_line_array, 'id_transaction_role_new' => $id_transaction_role_new, 'transaction_name_new' => $transaction_name_new, 'response' => $responseValue)));
				}
			}
		}

		public function add_sales_order($key_session){
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
					// Header
					//$this->form_validation->set_rules('id_sales_order', 'id_sales_order', 'required');
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					//$this->form_validation->set_rules('sales_order_number', 'sales_order_number', 'required');
					$this->form_validation->set_rules('hold', 'hold', 'required');
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
                    $this->form_validation->set_rules('sales_order_date', 'sales_order_date', 'required');
                    $this->form_validation->set_rules('quotation_number', 'quotation_number', 'required');
                    //$this->form_validation->set_rules('note', 'note', 'required');
                    $this->form_validation->set_rules('total_line', 'total_line', 'required');
                    $this->form_validation->set_rules('total_qty', 'total_qty', 'required');
                    $this->form_validation->set_rules('id_account', 'id_account', 'required');
                    $this->form_validation->set_rules('id_account_project', 'id_account_project', 'required');
                    $this->form_validation->set_rules('id_coa_currency', 'id_coa_currency', 'required');
                    $this->form_validation->set_rules('rate', 'rate', 'required');
                    $this->form_validation->set_rules('customer_order_number', 'customer_order_number', 'required');
                    $this->form_validation->set_rules('sales_order_owner', 'sales_order_owner', 'required');
                    $this->form_validation->set_rules('cNIK_approval', 'cNIK_approval', 'required');
                    $this->form_validation->set_rules('sub_amount', 'sub_amount', 'required');
                    $this->form_validation->set_rules('discount_amount', 'discount_amount', 'required');
                    $this->form_validation->set_rules('amount', 'amount', 'required');
                    $this->form_validation->set_rules('ppn', 'ppn', 'required');
                    $this->form_validation->set_rules('pph', 'pph', 'required');
                    $this->form_validation->set_rules('total_amount', 'total_amount', 'required');

                    // Line
                    //$this->form_validation->set_rules('id_sales_order_line', 'id_sales_order_line', 'required');
                    $this->form_validation->set_rules('JobNo', 'JobNo', 'required');
                    $this->form_validation->set_rules('description', 'description', 'required');
                    $this->form_validation->set_rules('qty_order_line', 'qty_order_line', 'required');
                    $this->form_validation->set_rules('uom_cd_line', 'uom_cd_line', 'required');
                    $this->form_validation->set_rules('unit_price_line', 'unit_price_line', 'required');
                    $this->form_validation->set_rules('line_sub_amount_line', 'line_sub_amount_line', 'required');
                    $this->form_validation->set_rules('discount_amount_line', 'discount_amount_line', 'required');
                    $this->form_validation->set_rules('discount_percent_line', 'discount_percent_line', 'required');
                    $this->form_validation->set_rules('line_amount_line', 'line_amount_line', 'required');
                    $this->form_validation->set_rules('sub_tax_cd_line', 'sub_tax_cd_line', 'required');
                    $this->form_validation->set_rules('coa_cd_line', 'coa_cd_line', 'required');
                    $this->form_validation->set_rules('coa_name_line', 'coa_name_line', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {

						// Header
						$id_sales_order = $this->input->post('id_sales_order');
						$id_module = $this->input->post('id_module');
						$sales_order_number_post = $this->input->post('sales_order_number');
						$hold = $this->input->post('hold');
						$id_transaction_role = $this->input->post('id_transaction_role');
	                    $sales_order_date = $this->input->post('sales_order_date');
	                    $year = date_format(date_create($sales_order_date), 'Y');
	                    $periode = date_format(date_create($sales_order_date), 'Y-m');
	                    $quotation_number = $this->input->post('quotation_number');
	                    $note = $this->input->post('note');
	                    $total_line = $this->input->post('total_line');
	                    $total_qty = $this->input->post('total_qty');
	                    $id_account = $this->input->post('id_account');
	                    $id_account_project = $this->input->post('id_account_project');
	                    $id_coa_currency_post = $this->input->post('id_coa_currency');
	                    $rate = $this->input->post('rate');
	                    $customer_order_number = $this->input->post('customer_order_number');
	                    $sales_order_owner = $this->input->post('sales_order_owner');
	                    $cNIK_approval_post = $this->input->post('cNIK_approval');
	                    $sub_amount = $this->input->post('sub_amount');
	                    $discount_amount = $this->input->post('discount_amount');
	                    $amount = $this->input->post('amount');
	                    $ppn = $this->input->post('ppn');
	                    $pph = $this->input->post('pph');
	                    $total_amount = $this->input->post('total_amount');

	                    $id_module = $this->input->post('id_module');

	                    $result_coa_currency = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $id_coa_currency_post);
						$id_coa_currency = $result_coa_currency[0]->id_coa_currency;

	                    if ($sales_order_number_post == '') {
							$result_sales_order = $this->m_distributionread->list_sales_order_by_year($company_id_session, $year);
							$sales_order_count = count($result_sales_order);
							$sales_order_next = $sales_order_count+1;

							$result_numbering_sequence = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
							$string_format = $result_numbering_sequence[0]->string_format;
							$cut_1 = $result_numbering_sequence[0]->cut_1;
							$cut_2 = $result_numbering_sequence[0]->cut_2;
							$number_length = $result_numbering_sequence[0]->number_length;

							$sales_order_next_add_zero = sprintf("%0".$number_length."d", $sales_order_next);
							$sales_order_number = $string_format.''.$cut_1.''.$year.''.$cut_2.''.$sales_order_next_add_zero;
						}
						else {
							$sales_order_number = $sales_order_number_post;
						}

						$result_employee_approval = $this->m_essread->personal_data_by_cnmpegawai($company_id_session, $cNIK_approval_post);
						$cNIK_approval = $result_employee_approval[0]->cNIK;

	                    // Line
	                    $id_sales_order_line_array = json_decode($this->input->post('id_sales_order_line'));
	                    $JobNo_array = json_decode($this->input->post('JobNo'));
	                    $description_array = json_decode($this->input->post('description'));
	                    $qty_order_line_array = json_decode($this->input->post('qty_order_line'));
	                    $uom_cd_line_array = json_decode($this->input->post('uom_cd_line'));
	                    $unit_price_line_array = json_decode($this->input->post('unit_price_line'));
	                    $line_sub_amount_line_array = json_decode($this->input->post('line_sub_amount_line'));
	                    $discount_amount_line_array = json_decode($this->input->post('discount_amount_line'));
	                    $discount_percent_line_array = json_decode($this->input->post('discount_percent_line'));
	                    $line_amount_line_array = json_decode($this->input->post('line_amount_line'));
	                    $sub_tax_cd_line_array = json_decode($this->input->post('sub_tax_cd_line'));
	                    $coa_cd_line_array = json_decode($this->input->post('coa_cd_line'));
	                    $coa_name_line_array = json_decode($this->input->post('coa_name_line'));

						$last_update = date('Y-m-d H:i:s');

						$status_array = array();
						$data_header_array = array();
						$data_line_array = array();

						if ($sales_order_number_post == '') {
							$data_header = array (
								'company_id' => $company_id_session,
								'id_module' => $id_module,
								'sales_order_number' => $sales_order_number,
								'hold' => 1,
								'id_transaction_role' => $id_transaction_role,
								'sales_order_date' => $sales_order_date,
								'year' => $year,
								'periode' => $periode,
								'quotation_number' => $quotation_number,
								'note' => $note,
								'id_account' => $id_account*1,
								'id_account_project' => $id_account_project*1,
								'id_coa_currency' => $id_coa_currency,
								'rate' => $rate,
								'sales_order_owner' => $cNIK_session,
								'cNIK_approval' => $cNIK_approval,
								'total_line' => $total_line*1,
								'total_qty' => $total_qty*1,
								'cury_sub_amount' => ($sub_amount*1)*($rate*1),
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => ($discount_amount*1)*($rate*1),
								'discount_amount' => $discount_amount*1,
								'cury_amount' => ($amount*1)*($rate*1),
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,
								'cury_total_amount' => ($total_amount*1)*($rate*1),
								'total_amount' => $total_amount*1,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);
							array_push($data_header_array, $data_header);
							$result_header = $this->m_distributioncreate->add_sales_order($data_header);
							if ($result_header == true) {

			                    for ($a=0; $a<count($description_array); $a++){
			                    	$JobNo_line = $JobNo_array[$a];
				                    $description = $description_array[$a];
				                    $qty_order_line = $qty_order_line_array[$a];
				                    $uom_cd_line = $uom_cd_line_array[$a];
				                    $unit_price_line = $unit_price_line_array[$a];
				                    $line_sub_amount_line = $line_sub_amount_line_array[$a];
				                    $discount_amount_line = $discount_amount_line_array[$a];
				                    $discount_percent_line = $discount_percent_line_array[$a];
				                    $line_amount_line = $line_amount_line_array[$a];
				                    $sub_tax_cd_line = $sub_tax_cd_line_array[$a];
				                    $coa_cd_line = $coa_cd_line_array[$a];
				                    $coa_name_line = $coa_name_line_array[$a];

									if ($JobNo_line=='') {
										$id_job_order = '';
										$JobNo = '';
									}
									else {
										$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
										$id_job_order = $result_job_order[0]->id_job_order;
										$JobNo = $JobNo_line;
									}

									$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
									$id_uom = $result_uom[0]->id_uom;
									$uom_cd = $uom_cd_line;
									$uom_name = $result_uom[0]->uom_name;

									$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
									$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
									$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
									$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

									$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
									$id_coa = $result_coa[0]->id_coa;
									$coa_cd = $coa_cd_line;
									$coa_name = $coa_name_line;

									$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);
									$id_job_order = $result_job_order[0]->id_job_order;

									$cury_unit_price = $unit_price_line*$rate;
									$cury_sub_amount = $line_sub_amount_line*$rate;
									$cury_discount_amount = $discount_amount_line*$rate;
									$cury_amount = $line_amount_line*$rate;

									$data_line = array (
										'company_id' => $company_id_session,
										'sales_order_number' => $sales_order_number,
										'line_number' => 1,
										'id_job_order' => $id_job_order,
										'description' => $description_post,
										'qty_order_line' => $qty_order_line_post*1,
										'qty_shipment_line' => 0,
										'id_uom' => $id_uom*1,
										'uom_cd' => $uom_cd,
										'uom_name' => $uom_name,
										'cury_unit_price' => ($unit_price_line*1)*($rate*1),
										'unit_price' => $unit_price_line*1,
										'cury_sub_amount' => ($line_sub_amount_line*1)*($rate*1),
										'sub_amount' => $line_sub_amount_line*1,
										'cury_discount_amount' => ($discount_amount_line*1)*($rate*1),
										'discount_amount' => $discount_amount_line*1,
										'discount_percent' => $discount_percent_line*1,
										'cury_amount' => ($line_amount_line*1)*($rate*1),
										'amount' => $line_amount_line*1,
										'id_sub_tax' => $id_sub_tax,
										'sub_tax_cd' => $sub_tax_cd,
										'sub_tax_name' => $sub_tax_name,
										'id_coa' => $id_coa,
										'coa_cd' => $coa_cd,
										'coa_name' => $coa_name,
										'line_status' => 0,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									array_push ($data_line_array, $data_line);
									$result_line = $this->m_distributioncreate->add_sales_order_line($data_line);
									if ($result_line==true) {
										$status = 1;
									}
									else {
										$status = 0;
									}
									array_push($status_array, $status);
			                    }					
								
							}
							else {
								$status = 0;
								array_push ($status_array, $status);
							}
						}
						else {
							$data_header = array (
								'sales_order_date' => $sales_order_date,
								'year' => $year,
								'periode' => $periode,
								'quotation_number' => $quotation_number,
								'note' => $note,
								'id_coa_currency' => $id_coa_currency,
								'rate' => $rate,
								'customer_order_number' => $customer_order_number,
								'cNIK_approval' => $cNIK_approval,
								'total_line' => $total_line*1,
								'total_qty' => $total_qty*1,
								'cury_sub_amount' => ($sub_amount*1)*($rate*1),
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => ($discount_amount*1)*($rate*1),
								'discount_amount' => $discount_amount*1,
								'cury_amount' => ($amount*1)*($rate*1),
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,
								'cury_total_amount' => ($total_amount*1)*($rate*1),
								'total_amount' => $total_amount*1,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							array_push($data_header_array, $data_header);
							$result_header = $this->m_distributionupdate->update_sales_order($company_id_session, $data_header, $id_sales_order);
							if ($result_header == true) {
			                    for ($a=0; $a<count($description_array); $a++){
			                    	$id_sales_order_line = $id_sales_order_line_array[$a];
			                    	$JobNo_line = $JobNo_array[$a];
				                    $description = $description_array[$a];
				                    $qty_order_line = $qty_order_line_array[$a];
				                    $uom_cd_line = $uom_cd_line_array[$a];
				                    $unit_price_line = $unit_price_line_array[$a];
				                    $line_sub_amount_line = $line_sub_amount_line_array[$a];
				                    $discount_amount_line = $discount_amount_line_array[$a];
				                    $discount_percent_line = $discount_percent_line_array[$a];
				                    $line_amount_line = $line_amount_line_array[$a];
				                    $sub_tax_cd_line = $sub_tax_cd_line_array[$a];
				                    $coa_cd_line = $coa_cd_line_array[$a];
				                    $coa_name_line = $coa_name_line_array[$a];

									if ($JobNo_line=='') {
										$id_job_order = '';
										$JobNo = '';
									}
									else {
										$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo_line);
										$id_job_order = $result_job_order[0]->id_job_order;
										$JobNo = $JobNo_line;
									}

									$result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
									$id_uom = $result_uom[0]->id_uom;
									$uom_cd = $uom_cd_line;
									$uom_name = $result_uom[0]->uom_name;

									$result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
									$id_sub_tax = $result_sub_tax[0]->id_sub_tax;
									$sub_tax_cd = $result_sub_tax[0]->sub_tax_cd;
									$sub_tax_name = $result_sub_tax[0]->sub_tax_name;

									$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd_line);
									$id_coa = $result_coa[0]->id_coa;
									$coa_cd = $coa_cd_line;
									$coa_name = $coa_name_line;

									$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);
									$id_job_order = $result_job_order[0]->id_job_order;

									$cury_unit_price = $unit_price_line*$rate;
									$cury_sub_amount = $line_sub_amount_line*$rate;
									$cury_discount_amount = $discount_amount_line*$rate;
									$cury_amount = $line_amount_line*$rate;

									if ($id_sales_order_line=='') {
										$data_line = array (
											'company_id' => $company_id_session,
											'sales_order_number' => $sales_order_number,
											'line_number' => ($a+1),
											'id_job_order' => $id_job_order,
											'description' => $description,
											'qty_order_line' => $qty_order_line*1,
											'qty_shipment_line' => 0,
											'id_uom' => $id_uom*1,
											'uom_cd' => $uom_cd,
											'uom_name' => $uom_name,
											'cury_unit_price' => ($unit_price_line*1)*($rate*1),
											'unit_price' => $unit_price_line*1,
											'cury_sub_amount' => ($line_sub_amount_line*1)*($rate*1),
											'sub_amount' => $line_sub_amount_line*1,
											'cury_discount_amount' => ($discount_amount_line*1)*($rate*1),
											'discount_amount' => $discount_amount_line*1,
											'discount_percent' => $discount_percent_line*1,
											'cury_amount' => ($line_amount_line*1)*($rate*1),
											'amount' => $line_amount_line*1,
											'id_sub_tax' => $id_sub_tax,
											'sub_tax_cd' => $sub_tax_cd,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa,
											'coa_cd' => $coa_cd,
											'coa_name' => $coa_name,
											'line_status' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										array_push ($data_line_array, $data_line);
										$result_line = $this->m_distributioncreate->add_sales_order_line($data_line);
										if ($result_line==true) {
											$status = 1;
										}
										else {
											$status = 0;
										}
										array_push($status_array, $status);
									}
									else {
										$data_line = array (
											'id_job_order' => $id_job_order,
											'description' => $description,
											'qty_order_line' => $qty_order_line*1,
											'id_uom' => $id_uom*1,
											'uom_cd' => $uom_cd,
											'uom_name' => $uom_name,
											'cury_unit_price' => ($unit_price_line*1)*($rate*1),
											'unit_price' => $unit_price_line*1,
											'cury_sub_amount' => ($line_sub_amount_line*1)*($rate*1),
											'sub_amount' => $line_sub_amount_line*1,
											'cury_discount_amount' => ($discount_amount_line*1)*($rate*1),
											'discount_amount' => $discount_amount_line*1,
											'discount_percent' => $discount_percent_line*1,
											'cury_amount' => ($line_amount_line*1)*($rate*1),
											'amount' => $line_amount_line*1,
											'id_sub_tax' => $id_sub_tax*1,
											'sub_tax_cd' => $sub_tax_cd,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa*1,
											'coa_cd' => $coa_cd,
											'coa_name' => $coa_name,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										array_push ($data_line_array, $data_line);
										$result_line = $this->m_distributionupdate->update_sales_order_line($company_id_session, $data_line, $id_sales_order_line);
										if ($result_line==true) {
											$status = 1;
										}
										else {
											$status = 0;
										}
										array_push($status_array, $status);											
									}
			                    }
							}
							else {
								$status = 0;
								array_push ($status_array, $status);
							}
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'data_header' => $data_header, 'data_line' => $data_line_array, 'response' => $responseValue, 'sales_order_number' => $sales_order_number, 'line_number' => count($description_array))));
				}
			}
		}

		public function add_delivery_order($key_session){
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
					// Header
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
					$this->form_validation->set_rules('delivery_order_date', 'delivery_order_date', 'required');
                    $this->form_validation->set_rules('total_line', 'total_line', 'required');
                    $this->form_validation->set_rules('total_qty', 'total_qty', 'required');
                    $this->form_validation->set_rules('id_account', 'id_account', 'required');
                    $this->form_validation->set_rules('id_account_project', 'id_account_project', 'required');
                    $this->form_validation->set_rules('delivery_order_owner', 'delivery_order_owner', 'required');
                    $this->form_validation->set_rules('sub_amount', 'sub_amount', 'required');
                    $this->form_validation->set_rules('discount_amount', 'discount_amount', 'required');
                    $this->form_validation->set_rules('amount', 'amount', 'required');
                    $this->form_validation->set_rules('ppn', 'ppn', 'required');
                    $this->form_validation->set_rules('pph', 'pph', 'required');
                    $this->form_validation->set_rules('total_amount', 'total_amount', 'required');

                    // Line
                    $this->form_validation->set_rules('id_job_order', 'id_job_order', 'required');
                    $this->form_validation->set_rules('description', 'description', 'required');
                    $this->form_validation->set_rules('qty_order_line', 'qty_order_line', 'required');
                    $this->form_validation->set_rules('qty_shipment_line', 'qty_shipment_line', 'required');
                    $this->form_validation->set_rules('uom_cd_line', 'uom_cd_line', 'required');
                    $this->form_validation->set_rules('unit_price_line', 'unit_price_line', 'required');
                    $this->form_validation->set_rules('sub_amount_line', 'sub_amount_line', 'required');
                    $this->form_validation->set_rules('discount_amount_line', 'discount_amount_line', 'required');
                    $this->form_validation->set_rules('discount_percent_line', 'discount_percent_line', 'required');
                    $this->form_validation->set_rules('amount_line', 'amount_line', 'required');
                    $this->form_validation->set_rules('sub_tax_cd_line', 'sub_tax_cd_line', 'required');
                    $this->form_validation->set_rules('id_kit_assy', 'id_kit_assy', 'required');

                    $data_delvery_order_header_array = array();
                    $data_delvery_order_line_array = array();

                    $status_array = array();

                    $last_update = date('Y-m-d H:i:s');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
						array_push($status_array, $status);
					}
					else {
						$id_delivery_order = $this->input->post('id_delivery_order');
						$id_module = $this->input->post('id_module');
						$delivery_order_number_post = $this->input->post('delivery_order_number');
						$hold = $this->input->post('hold');
						$id_transaction_role = $this->input->post('id_transaction_role');
						$delivery_order_date = $this->input->post('delivery_order_date');
	                    $note = $this->input->post('note');
	                    $coa_currency_cd = $this->input->post('id_coa_currency');
	                    $rate = $this->input->post('rate');
	                    $total_line = $this->input->post('total_line');
	                    $total_qty = $this->input->post('total_qty');
	                    $id_account = $this->input->post('id_account');
	                    $id_account_project = $this->input->post('id_account_project');
	                    $delivery_order_owner = $this->input->post('delivery_order_owner');
	                    $sub_amount = $this->input->post('sub_amount');
	                    $discount_amount = $this->input->post('discount_amount');
	                    $amount = $this->input->post('amount');
	                    $ppn = $this->input->post('ppn');
	                    $pph = $this->input->post('pph');
	                    $total_amount = $this->input->post('total_amount');

	                    $result_coa_currency = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $coa_currency_cd);
	                    $id_coa_currency = $result_coa_currency[0]->id_coa_currency;

	                    // Line
	                    $id_delivery_order_line_array = json_decode($this->input->post('id_delivery_order_line'));
	                    $id_sales_order_line_on_delivery_order_line_array = json_decode($this->input->post('id_sales_order_line_on_delivery_order_line'));
	                    $id_job_order_array = json_decode($this->input->post('id_job_order'));
	                    $description_array = json_decode($this->input->post('description'));
	                    $qty_order_line_array = json_decode($this->input->post('qty_order_line'));
	                    $qty_shipment_line_array = json_decode($this->input->post('qty_shipment_line'));
	                    $uom_cd_line_array = json_decode($this->input->post('uom_cd_line'));
	                    $unit_price_line_array = json_decode($this->input->post('unit_price_line'));
	                    $sub_amount_line_array = json_decode($this->input->post('sub_amount_line'));
	                    $discount_amount_line_array = json_decode($this->input->post('discount_amount_line'));
	                    $discount_percent_line_array = json_decode($this->input->post('discount_percent_line'));
	                    $amount_line_array = json_decode($this->input->post('amount_line'));
	                    $sub_tax_cd_line_array = json_decode($this->input->post('sub_tax_cd_line'));
	                    $coa_cd_line_array = json_decode($this->input->post('coa_cd_line'));
	                    $id_kit_assy_array = json_decode($this->input->post('id_kit_assy'));

	                    $year = date_format(date_create($delivery_order_date), 'Y');
	                    $periode = date_format(date_create($delivery_order_date), 'Y-m');

	                    if ($delivery_order_number_post == '') {
							$result_delivery_order = $this->m_distributionread->list_delivery_order_by_year($company_id_session, $year);
							$delivery_order_count = count($result_delivery_order);
							$delivery_order_next = $delivery_order_count+1;

							$result_numbering_sequence = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
							$string_format = $result_numbering_sequence[0]->string_format;
							$cut_1 = $result_numbering_sequence[0]->cut_1;
							$cut_2 = $result_numbering_sequence[0]->cut_2;
							$number_length = $result_numbering_sequence[0]->number_length;

							$delivery_order_next_add_zero = sprintf("%0".$number_length."d", $delivery_order_next);
							$delivery_order_number = $string_format.''.$cut_1.''.$year.''.$cut_2.''.$delivery_order_next_add_zero;
						}
						else {
							$delivery_order_number = $delivery_order_number_post;
						}

						if ($delivery_order_number_post == '') { // Add Delivery Order
							$data_delvery_order_header = array(
								'company_id' => $company_id_session,
								'id_module' => $id_module,
								'delivery_order_number' => $delivery_order_number,
								'hold' => 1,
								'id_transaction_role' => $id_transaction_role*1,
								'delivery_order_date' => $delivery_order_date,
								'year' => $year,
								'periode' => $periode,
								'note' => $note,
								'id_account' => $id_account*1,
								'id_account_project' => $id_account_project*1,
								'id_coa_currency' => $id_coa_currency*1,
								'rate' => $rate,
								'delivery_order_owner' => $cNIK_session,
								'total_line' => $total_line*1,
								'total_qty' => $total_qty*1,
								'cury_sub_amount' => $sub_amount*$rate,
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => $discount_amount*$rate,
								'discount_amount' => $discount_amount,
								'cury_amount' => $amount*$rate,
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,
								'cury_total_amount' => ($total_amount*$rate),
								'total_amount' => $total_amount*1,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0
		                    );
		                    array_push($data_delvery_order_header_array, $data_delvery_order_header);
		                    $add_delivery_order_header = $this->m_distributioncreate->add_delivery_order($data_delvery_order_header);
		                    if ($add_delivery_order_header == true) {
		                    	for ($i=0; $i < count($id_job_order_array); $i++) { 
			                    	$id_delivery_order_line = $id_delivery_order_line_array[$i];
				                    $id_sales_order_line_on_delivery_order_line = ($id_sales_order_line_on_delivery_order_line_array[$i])*1;
				                    $id_job_order = $id_job_order_array[$i];
				                    $description = $description_array[$i];
				                    $qty_order_line = $qty_order_line_array[$i];
				                    $qty_shipment_line = $qty_shipment_line_array[$i];
				                    $uom_cd_line = $uom_cd_line_array[$i];
				                    $unit_price_line = $unit_price_line_array[$i];
				                    $sub_amount_line = $sub_amount_line_array[$i];
				                    $discount_amount_line = $discount_amount_line_array[$i];
				                    $discount_percent_line = $discount_percent_line_array[$i];
				                    $amount_line = $amount_line_array[$i];
				                    $sub_tax_cd_line = $sub_tax_cd_line_array[$i];
				                    $coa_cd_line = $coa_cd_line_array[$i];
				                    $id_kit_assy = $id_kit_assy_array[$i];

				                    $result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
				                    $id_uom = $result_uom[0]->id_uom;
				                    $uom_name = $result_uom[0]->uom_name;

				                    $result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
				                    $id_sub_tax = $result_sub_tax[0]->id_sub_tax;
				                    $sub_tax_name = $result_sub_tax[0]->sub_tax_name;

				                    $result_coa = $this->m_inventoryread->list_coa_by_coa_cd($company_id_session, $coa_cd_line);
				                    $id_coa = $result_coa[0]->id_coa;
				                    $coa_name = $result_coa[0]->coa_name;

				                    $result_sales_order_line = $this->m_distributionread->list_sales_order_line($company_id_session, $id_sales_order_line_on_delivery_order_line);
				                    $total_qty_sales_order = $result_sales_order_line[0]->total_qty;
				                    $id_sales_order = $result_sales_order_line[0]->id_sales_order;
				                    $sales_order_number = $result_sales_order_line[0]->sales_order_number;
				                    $qty_shipment_line_old = $result_sales_order_line[0]->qty_shipment_line;
				                    $sequence_sales_order_old = $result_sales_order_line[0]->sequence;
				                    $id_module_sales_order = $result_sales_order_line[0]->id_module;

				                    $data_delvery_order_line = array(
										'company_id' => $company_id_session,
										'delivery_order_number' => $delivery_order_number,
										'id_sales_order_line' => $id_sales_order_line_on_delivery_order_line*1,
										'line_number' => ($i+1),
										'id_job_order' => $id_job_order*1,
										'description' => $description,
										'id_kit_assy' => $id_kit_assy*1,
										'qty_order_line' => $qty_order_line*1,
										'qty_shipment_line' => $qty_shipment_line*1,
										'id_uom' => $id_uom*1,
										'uom_cd' => $uom_cd_line,
										'uom_name' => $uom_name,
										'cury_unit_price' => ($unit_price_line*$rate),
										'unit_price' => $unit_price_line*1,
										'cury_sub_amount' => ($sub_amount_line*$rate),
										'sub_amount' => $sub_amount_line*1,
										'cury_discount_amount' => ($discount_amount_line*$rate),
										'discount_amount' => $discount_amount_line*1,
										'discount_percent' => $discount_percent_line*1,
										'cury_amount' => ($amount*$rate),
										'amount' => $amount*1,
										'id_sub_tax' => $id_sub_tax*1,
										'sub_tax_cd' => $sub_tax_cd_line,
										'sub_tax_name' => $sub_tax_name,
										'id_coa' => $id_coa*1,
										'coa_cd' => $coa_cd_line,
										'coa_name' => $coa_name,
										'line_status' => 0,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
				                    );
				                    array_push($data_delvery_order_line_array, $data_delvery_order_line);
				                    $add_delivery_order_line = $this->m_distributioncreate->add_delivery_order_line($data_delvery_order_line);
				                    if ($add_delivery_order_line == true) {
				                    	if ($qty_order_line*1 == (($qty_shipment_line_old+$qty_shipment_line)*1)) {
				                    		$data_sales_order_line = array (
				                    			'qty_shipment_line' => ($qty_shipment_line_old+$qty_shipment_line)*1,
				                    			'line_status' => 1,
				                    			'last_by' => $cNIK_session,
				                    			'last_update' => $last_update
				                    		);
				                    		$update_sales_order_line = $this->m_distributionupdate->update_sales_order_line($company_id_session, $data_sales_order_line, $id_sales_order_line_on_delivery_order_line);
				                    		if ($update_sales_order_line == true) {
				                    			$result_delivery_order_line_total_qty_shipment = $this->m_distributionread->list_delivery_order_line_total_qty_shipment($company_id_session, $sales_order_number);
				                    			$total_qty_shipment = $result_delivery_order_line_total_qty_shipment[0]->total_qty;

				                    			if (($total_qty_sales_order*1) == (($qty_shipment_line_old+$qty_shipment_line)*1)) {
				                    				$sequence_new = $sequence_sales_order_old+1;
													$result_transaction_role_sequence = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_sales_order, $sequence_new);
													$id_transaction_role_new = $result_transaction_role_sequence[0]->id_transaction_role;

				                    				$data_sales_order_header = array(
				                    					'id_transaction_role' => $id_transaction_role_new*1,
				                    					'last_by' => $cNIK_session,
				                    					'last_update' => $last_update
				                    				);
				                    				$update_sales_order_header = $this->m_distributionupdate->update_sales_order($company_id_session, $data_sales_order_header, $id_sales_order);
				                    				if ($update_sales_order_header == true) {
				                    					$status = 1;
				                    					array_push($status_array, $status);
				                    				}
				                    				else {

				                    					$data_sales_order_line = array (
							                    			'qty_shipment_line' => $qty_shipment_line_old*1,
							                    			'line_status' => 0,
							                    			'last_by' => $cNIK_session,
							                    			'last_update' => $last_update
							                    		);
							                    		$update_sales_order_line = $this->m_distributionupdate->update_sales_order_line($company_id_session, $data_sales_order_line, $id_sales_order_line_on_delivery_order_line);
							                    		if ($update_sales_order_line == true) {
							                    			$status = 1;
							                    			array_push($status_array, $status);
							                    		}
							                    		else {
							                    			$status = 0;
							                    			array_push($status_array, $status);
							                    		}
				                    				}
				                    			}
				                    			else {
				                    				$status = 1;
							                    	array_push($status_array, $status);
				                    			}
				                    		}
				                    		else {
				                    			$result_last_delivery_order_line = $this->m_distributionread->last_delivery_order_line($company_id_session, $id_sales_order_line_on_delivery_order_line);
				                    			$id_delivery_order_line = $result_last_delivery_order_line[0]->id_delivery_order_line;
				                    			$delete_delivery_order_line = $this->m_distributionupdate->delete_delivery_order_line($company_id_session, $id_delivery_order_line);
						                    	if ($delete_delivery_order_line == true) {
						                    		$status = 1;
						                    		array_push($status_array, $status);
						                    	}
						                    	else {
						                    		$status = 0;
						                    		array_push($status_array, $status);
						                    	}
				                    		}
				                    	}
				                    	else {
				                    		$data_sales_order_line = array (
				                    			'qty_shipment_line' => ($qty_shipment_line_old+$qty_shipment_line)*1,
				                    			'last_by' => $cNIK_session,
				                    			'last_update' => $last_update
				                    		);
				                    		$update_sales_order_line = $this->m_distributionupdate->update_sales_order_line($company_id_session, $data_sales_order_line, $id_sales_order_line_on_delivery_order_line);
				                    		if ($update_sales_order_line == true) {
		                    					$status = 1;
		                    					array_push($status_array, $status);
				                    		}
				                    		else {
				                    			$result_last_delivery_order_line = $this->m_distributionread->last_delivery_order_line($company_id_session, $id_sales_order_line_on_delivery_order_line);
				                    			$id_delivery_order_line = $result_last_delivery_order_line[0]->id_delivery_order_line;
				                    			$delete_delivery_order_line = $this->m_distributionupdate->delete_delivery_order_line($company_id_session, $id_delivery_order_line);
						                    	if ($delete_delivery_order_line == true) {
						                    		$status = 1;
						                    		array_push($status_array, $status);
						                    	}
						                    	else {
						                    		$status = 0;
						                    		array_push($status_array, $status);
						                    	}
				                    		}
				                    	}
				                    }
				                    else {
			                    		$status = 0;
			                    		array_push($status_array, $status);
				                    }
			                    }
		                    }
		                    else {
		                    	$status = 0;
		                    	array_push($status_array, $status);
		                    }
						}
						else { // Update Delivery Order
							$data_delvery_order_header = array(
								'delivery_order_date' => $delivery_order_date,
								'year' => $year,
								'periode' => $periode,
								'note' => $note,
								'id_coa_currency' => $id_coa_currency*1,
								'rate' => $rate,
								'total_line' => $total_line*1,
								'total_qty' => $total_qty*1,
								'cury_sub_amount' => $sub_amount*$rate,
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => $discount_amount*$rate,
								'discount_amount' => $discount_amount,
								'cury_amount' => $amount*$rate,
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,
								'cury_total_amount' => ($total_amount*$rate),
								'total_amount' => $total_amount*1,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
		                    );
		                    array_push($data_delvery_order_header_array, $data_delvery_order_header);
		                    $update_delivery_order_header = $this->m_distributioncreate->update_delivery_order($company_id_session, $data_delvery_order_header, $delivery_order_number);
		                    if ($update_delivery_order_header == true) {
		                    	for ($i=0; $i < count($id_job_order_array); $i++) { 
			                    	$id_delivery_order_line = $id_delivery_order_line_array[$i];
				                    $id_sales_order_line_on_delivery_order_line = ($id_sales_order_line_on_delivery_order_line_array[$i])*1;
				                    $id_job_order = $id_job_order_array[$i];
				                    $description = $description_array[$i];
				                    $qty_order_line = $qty_order_line_array[$i];
				                    $qty_shipment_line = $qty_shipment_line_array[$i];
				                    $uom_cd_line = $uom_cd_line_array[$i];
				                    $unit_price_line = $unit_price_line_array[$i];
				                    $sub_amount_line = $sub_amount_line_array[$i];
				                    $discount_amount_line = $discount_amount_line_array[$i];
				                    $discount_percent_line = $discount_percent_line_array[$i];
				                    $amount_line = $amount_line_array[$i];
				                    $sub_tax_cd_line = $sub_tax_cd_line_array[$i];
				                    $coa_cd_line = $coa_cd_line_array[$i];
				                    $id_kit_assy = $id_kit_assy_array[$i];

				                    $result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
				                    $id_uom = $result_uom[0]->id_uom;
				                    $uom_name = $result_uom[0]->uom_name;

				                    $result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
				                    $id_sub_tax = $result_sub_tax[0]->id_sub_tax;
				                    $sub_tax_name = $result_sub_tax[0]->sub_tax_name;

				                    $result_coa = $this->m_inventoryread->list_coa_by_coa_cd($company_id_session, $coa_cd_line);
				                    $id_coa = $result_coa[0]->id_coa;
				                    $coa_name = $result_coa[0]->coa_name;

				                    $result_sales_order_line = $this->m_distributionread->list_sales_order_line($company_id_session, $id_sales_order_line_on_delivery_order_line);
				                    $total_qty_sales_order = $result_sales_order_line[0]->total_qty;
				                    $id_sales_order = $result_sales_order_line[0]->id_sales_order;
				                    $sales_order_number = $result_sales_order_line[0]->sales_order_number;
				                    $qty_shipment_line_old = $result_sales_order_line[0]->qty_shipment_line;
				                    $sequence_sales_order_old = $result_sales_order_line[0]->sequence;
				                    $id_module_sales_order = $result_sales_order_line[0]->id_module;

				                    if ($id_delivery_order_line != '' && $description == '') { // Delete Line
				                    	$delete_delivery_order_line = $this->m_distributionupdate->delete_delivery_order_line($company_id_session, $id_delivery_order_line);
				                    	if ($delete_delivery_order_line == true) {
				                    		$status = 1;
				                    		array_push($status_array, $status);
				                    	}
				                    	else {
				                    		$status = 0;
				                    		array_push($status_array, $status);
				                    	}
				                    }
				                    else {
				                    	$data_delvery_order_line = array(
											'id_job_order' => $id_job_order*1,
											'description' => $description,
											'id_kit_assy' => $id_kit_assy*1,
											'qty_order_line' => $qty_order_line*1,
											'qty_shipment_line' => $qty_shipment_line*1,
											'id_uom' => $id_uom*1,
											'uom_cd' => $uom_cd_line,
											'uom_name' => $uom_name,
											'cury_unit_price' => ($unit_price_line*$rate),
											'unit_price' => $unit_price_line*1,
											'cury_sub_amount' => ($sub_amount_line*$rate),
											'sub_amount' => $sub_amount_line*1,
											'cury_discount_amount' => ($discount_amount_line*$rate),
											'discount_amount' => $discount_amount_line*1,
											'discount_percent' => $discount_percent_line*1,
											'cury_amount' => ($amount*$rate),
											'amount' => $amount*1,
											'id_sub_tax' => $id_sub_tax*1,
											'sub_tax_cd' => $sub_tax_cd_line,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa*1,
											'coa_cd' => $coa_cd_line,
											'coa_name' => $coa_name,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
					                    );
					                    array_push($data_delvery_order_line_array, $data_delvery_order_line);
					                    $add_delivery_order_line = $this->m_distributioncreate->add_delivery_order_line($data_delvery_order_line);
					                    if ($add_delivery_order_line == true) {
					                    	if ($qty_order_line*1 == (($qty_shipment_line_old+$qty_shipment_line)*1)) {
					                    		$data_sales_order_line = array (
					                    			'qty_shipment_line' => ($qty_shipment_line_old+$qty_shipment_line)*1,
					                    			'line_status' => 1,
					                    			'last_by' => $cNIK_session,
					                    			'last_update' => $last_update
					                    		);
					                    		$update_sales_order_line = $this->m_distributionupdate->update_sales_order_line($company_id_session, $data_sales_order_line, $id_sales_order_line_on_delivery_order_line);
					                    		if ($update_sales_order_line == true) {
					                    			$result_delivery_order_line_total_qty_shipment = $this->m_distributionread->list_delivery_order_line_total_qty_shipment($company_id_session, $sales_order_number);
					                    			$total_qty_shipment = $result_delivery_order_line_total_qty_shipment[0]->total_qty;

					                    			if (($total_qty_sales_order*1) == (($qty_shipment_line_old+$qty_shipment_line)*1)) {
					                    				$sequence_new = $sequence_sales_order_old+1;
														$result_transaction_role_sequence = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_sales_order, $sequence_new);
														$id_transaction_role_new = $result_transaction_role_sequence[0]->id_transaction_role;

					                    				$data_sales_order_header = array(
					                    					'id_transaction_role' => $id_transaction_role_new*1,
					                    					'last_by' => $cNIK_session,
					                    					'last_update' => $last_update
					                    				);
					                    				$update_sales_order_header = $this->m_distributionupdate->update_sales_order($company_id_session, $data_sales_order_header, $id_sales_order);
					                    				if ($update_sales_order_header == true) {
					                    					$status = 1;
					                    					array_push($status_array, $status);
					                    				}
					                    				else {

					                    					$data_sales_order_line = array (
								                    			'qty_shipment_line' => $qty_shipment_line_old*1,
								                    			'line_status' => 0,
								                    			'last_by' => $cNIK_session,
								                    			'last_update' => $last_update
								                    		);
								                    		$update_sales_order_line = $this->m_distributionupdate->update_sales_order_line($company_id_session, $data_sales_order_line, $id_sales_order_line_on_delivery_order_line);
								                    		if ($update_sales_order_line == true) {
								                    			$status = 1;
								                    			array_push($status_array, $status);
								                    		}
								                    		else {
								                    			$status = 0;
								                    			array_push($status_array, $status);
								                    		}
					                    				}
					                    			}
					                    			else {
					                    				$status = 1;
								                    	array_push($status_array, $status);
					                    			}
					                    		}
					                    		else {
					                    			$result_last_delivery_order_line = $this->m_distributionread->last_delivery_order_line($company_id_session, $id_sales_order_line_on_delivery_order_line);
					                    			$id_delivery_order_line = $result_last_delivery_order_line[0]->id_delivery_order_line;
					                    			$delete_delivery_order_line = $this->m_distributionupdate->delete_delivery_order_line($company_id_session, $id_delivery_order_line);
							                    	if ($delete_delivery_order_line == true) {
							                    		$status = 1;
							                    		array_push($status_array, $status);
							                    	}
							                    	else {
							                    		$status = 0;
							                    		array_push($status_array, $status);
							                    	}
					                    		}
					                    	}
					                    	else {
					                    		$data_sales_order_line = array (
					                    			'qty_shipment_line' => ($qty_shipment_line_old+$qty_shipment_line)*1,
					                    			'last_by' => $cNIK_session,
					                    			'last_update' => $last_update
					                    		);
					                    		$update_sales_order_line = $this->m_distributionupdate->update_sales_order_line($company_id_session, $data_sales_order_line, $id_sales_order_line_on_delivery_order_line);
					                    		if ($update_sales_order_line == true) {
			                    					$status = 1;
			                    					array_push($status_array, $status);
					                    		}
					                    		else {
					                    			$result_last_delivery_order_line = $this->m_distributionread->last_delivery_order_line($company_id_session, $id_sales_order_line_on_delivery_order_line);
					                    			$id_delivery_order_line = $result_last_delivery_order_line[0]->id_delivery_order_line;
					                    			$delete_delivery_order_line = $this->m_distributionupdate->delete_delivery_order_line($company_id_session, $id_delivery_order_line);
							                    	if ($delete_delivery_order_line == true) {
							                    		$status = 1;
							                    		array_push($status_array, $status);
							                    	}
							                    	else {
							                    		$status = 0;
							                    		array_push($status_array, $status);
							                    	}
					                    		}
					                    	}
					                    }
					                    else {
				                    		$status = 0;
				                    		array_push($status_array, $status);
					                    }
				                    }
			                    }
		                    }
		                    else {
		                    	$status = 0;
		                    	array_push($status_array, $status);
		                    }
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'header' => $data_delvery_order_header_array, 'line' => $data_delvery_order_line_array, 'delivery_order_number' => $delivery_order_number)));					
				}
			}
		}

		public function add_sales_invoice($key_session){
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
					// Header
					$this->form_validation->set_rules('id_transaction_role', 'id_transaction_role', 'required');
					$this->form_validation->set_rules('sales_invoice_date', 'sales_invoice_date', 'required');
					$this->form_validation->set_rules('customer_order_number', 'customer_order_number', 'required');
                    $this->form_validation->set_rules('id_account', 'id_account', 'required');
                    $this->form_validation->set_rules('id_coa_currency', 'id_coa_currency', 'required');
                    $this->form_validation->set_rules('rate', 'rate', 'required');
                    $this->form_validation->set_rules('id_payment_methode', 'id_payment_methode', 'required');
                    $this->form_validation->set_rules('id_payment_terms', 'id_payment_terms', 'required');
                    $this->form_validation->set_rules('sales_invoice_owner', 'sales_invoice_owner', 'required');
                    $this->form_validation->set_rules('cNIK_approval', 'cNIK_approval', 'required');
                    $this->form_validation->set_rules('total_line', 'total_line', 'required');
                    $this->form_validation->set_rules('total_qty', 'total_qty', 'required');
                    $this->form_validation->set_rules('sub_amount', 'sub_amount', 'required');
                    $this->form_validation->set_rules('discount_amount', 'discount_amount', 'required');
                    $this->form_validation->set_rules('amount', 'amount', 'required');
                    $this->form_validation->set_rules('ppn', 'ppn', 'required');
                    $this->form_validation->set_rules('pph', 'pph', 'required');
                    $this->form_validation->set_rules('total_amount', 'total_amount', 'required');

                    // Line
                    //$this->form_validation->set_rules('id_job_order', 'id_job_order', 'required');
                    $this->form_validation->set_rules('description', 'description', 'required');
                    $this->form_validation->set_rules('qty_shipment_line', 'qty_shipment_line', 'required');
                    $this->form_validation->set_rules('qty_invoice_line', 'qty_invoice_line', 'required');
                    $this->form_validation->set_rules('uom_cd_line', 'uom_cd_line', 'required');
                    $this->form_validation->set_rules('unit_price_line', 'unit_price_line', 'required');
                    $this->form_validation->set_rules('sub_amount_line', 'sub_amount_line', 'required');
                    $this->form_validation->set_rules('discount_amount_line', 'discount_amount_line', 'required');
                    $this->form_validation->set_rules('discount_percent_line', 'discount_percent_line', 'required');
                    $this->form_validation->set_rules('amount_line', 'amount_line', 'required');
                    $this->form_validation->set_rules('sub_tax_cd_line', 'sub_tax_cd_line', 'required');

                    $data_sales_invoice_header_array = array();
                    $data_sales_invoice_line_array = array();

                    $status_array = array();

                    $last_update = date('Y-m-d H:i:s');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
						array_push($status_array, $status);
					}
					else {
						$id_sales_invoice = $this->input->post('id_sales_invoice');
						$id_module = $this->input->post('id_module');
						$sales_invoice_number_post = $this->input->post('sales_invoice_number');
						$hold = $this->input->post('hold');
						$id_transaction_role = $this->input->post('id_transaction_role');
	                    $tax_number = $this->input->post('tax_number');
						$sales_invoice_date = $this->input->post('sales_invoice_date');
	                    $customer_order_number = $this->input->post('customer_order_number');
	                    $note = $this->input->post('note');
	                    $id_account = $this->input->post('id_account');
	                    $coa_currency_cd = $this->input->post('id_coa_currency');
	                    $rate = $this->input->post('rate');
	                    $id_payment_methode = $this->input->post('id_payment_methode');
	                    $id_payment_terms = $this->input->post('id_payment_terms');
	                    $sales_invoice_owner = $this->input->post('sales_invoice_owner');
	                    $cNIK_approval_post = $this->input->post('cNIK_approval');
	                    $total_line = $this->input->post('total_line');
	                    $total_qty = $this->input->post('total_qty');
	                    $sub_amount = $this->input->post('sub_amount');
	                    $discount_amount = $this->input->post('discount_amount');
	                    $amount = $this->input->post('amount');
	                    $ppn = $this->input->post('ppn');
	                    $pph = $this->input->post('pph');
	                    $total_amount = $this->input->post('total_amount');

	                    $result_coa_currency = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $coa_currency_cd);
	                    $id_coa_currency = $result_coa_currency[0]->id_coa_currency;

	                    // Line
	                    $id_sales_invoice_line_array = json_decode($this->input->post('id_sales_invoice_line'));
	                    $id_delivery_order_line_array = json_decode($this->input->post('id_delivery_order_line'));
	                    $id_job_order_array = json_decode($this->input->post('id_job_order'));
	                    $description_array = json_decode($this->input->post('description'));
	                    $qty_shipment_line_array = json_decode($this->input->post('qty_shipment_line'));
	                    $qty_invoice_line_array = json_decode($this->input->post('qty_invoice_line'));
	                    $uom_cd_line_array = json_decode($this->input->post('uom_cd_line'));
	                    $unit_price_line_array = json_decode($this->input->post('unit_price_line'));
	                    $sub_amount_line_array = json_decode($this->input->post('sub_amount_line'));
	                    $discount_amount_line_array = json_decode($this->input->post('discount_amount_line'));
	                    $discount_percent_line_array = json_decode($this->input->post('discount_percent_line'));
	                    $amount_line_array = json_decode($this->input->post('amount_line'));
	                    $sub_tax_cd_line_array = json_decode($this->input->post('sub_tax_cd_line'));
	                    $coa_cd_line_array = json_decode($this->input->post('coa_cd_line'));

	                    $year = date_format(date_create($sales_invoice_date), 'Y');
	                    $periode = date_format(date_create($sales_invoice_date), 'Y-m');

	                    if ($sales_invoice_number_post == '') {
							$result_sales_invoice = $this->m_distributionread->list_sales_invoice_by_year($company_id_session, $year);
							$sales_invoice_count = count($result_sales_invoice);
							$sales_invoice_next = $sales_invoice_count+1;

							$result_numbering_sequence = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
							$string_format = $result_numbering_sequence[0]->string_format;
							$cut_1 = $result_numbering_sequence[0]->cut_1;
							$cut_2 = $result_numbering_sequence[0]->cut_2;
							$number_length = $result_numbering_sequence[0]->number_length;

							$sales_invoice_next_add_zero = sprintf("%0".$number_length."d", $sales_invoice_next);
							$sales_invoice_number = $string_format.''.$cut_1.''.$year.''.$cut_2.''.$sales_invoice_next_add_zero;
						}
						else {
							$sales_invoice_number = $sales_invoice_number_post;
						}

						$result_employee_approval = $this->m_essread->personal_data_by_cnmpegawai($company_id_session, $cNIK_approval_post);
						$cNIK_approval = $result_employee_approval[0]->cNIK;

						if ($sales_invoice_number_post == '') { // Add Sales Invoice
							$data_sales_invoice_header = array(
								'company_id' => $company_id_session,
								'id_module' => $id_module*1,
								'sales_invoice_number' => $sales_invoice_number,
								'hold' => 1,
								'id_transaction_role' => $id_transaction_role*1,
								'tax_number' => $tax_number,
								'sales_invoice_date' => $sales_invoice_date,
								'year' => $year,
								'periode' => $periode,
								'customer_order_number' => $customer_order_number,
								'note' => $note,
								'id_account' => $id_account*1,
								'id_coa_currency' => $id_coa_currency*1,
								'rate' => $rate*1,
								'id_payment_methode' => $id_payment_methode*1,
								'id_payment_terms' => $id_payment_terms*1,
								'sales_invoice_owner' => $cNIK_session,
								'cNIK_approval' => $cNIK_approval,
								'total_line' => $total_line*1,
								'total_qty' => $total_qty*1,
								'cury_sub_amount' => $sub_amount*$rate,
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => $discount_amount*$rate,
								'discount_amount' => $discount_amount*1,
								'cury_amount' => $amount*$rate,
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,
								'cury_total_amount' => ($total_amount*$rate),
								'total_amount' => $total_amount*1,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0
		                    );
		                    array_push($data_sales_invoice_header_array, $data_sales_invoice_header);
		                    $add_sales_invoice_header = $this->m_distributioncreate->add_sales_invoice($data_sales_invoice_header);
		                    if ($add_sales_invoice_header == true) {
		                    	for ($i=0; $i < count($id_job_order_array); $i++) { 
			                    	$id_sales_invoice_line = $id_sales_invoice_line_array[$i];
				                    $id_delivery_order_line = ($id_delivery_order_line_array[$i])*1;
				                    $id_job_order = $id_job_order_array[$i];
				                    $description = $description_array[$i];
				                    $qty_shipment_line = $qty_shipment_line_array[$i];
				                    $qty_invoice_line = $qty_invoice_line_array[$i];
				                    $uom_cd_line = $uom_cd_line_array[$i];
				                    $unit_price_line = $unit_price_line_array[$i];
				                    $sub_amount_line = $sub_amount_line_array[$i];
				                    $discount_amount_line = $discount_amount_line_array[$i];
				                    $discount_percent_line = $discount_percent_line_array[$i];
				                    $amount_line = $amount_line_array[$i];
				                    $sub_tax_cd_line = $sub_tax_cd_line_array[$i];
				                    $coa_cd_line = $coa_cd_line_array[$i];

				                    if ($id_job_order=='') {
				                    	$id_job_order=0;
				                    }
				                    else {
				                    	$id_job_order=$id_job_order;
				                    }

				                    $result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
				                    $id_uom = $result_uom[0]->id_uom;
				                    $uom_name = $result_uom[0]->uom_name;

				                    $result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
				                    $id_sub_tax = $result_sub_tax[0]->id_sub_tax;
				                    $sub_tax_name = $result_sub_tax[0]->sub_tax_name;

				                    $result_coa = $this->m_inventoryread->list_coa_by_coa_cd($company_id_session, $coa_cd_line);
				                    $id_coa = $result_coa[0]->id_coa;
				                    $coa_name = $result_coa[0]->coa_name;

				                    if ($id_delivery_order_line=='') { // Non Job
				                    	$data_sales_invoice_line = array(
											'company_id' => $company_id_session,
											'sales_invoice_number' => $sales_invoice_number,
											'id_delivery_order_line' => null,
											'line_number' => ($i+1),
											'id_job_order' => null,
											'description' => $description,
											'qty_shipment_line' => $qty_shipment_line*1,
											'qty_invoice_line' => $qty_invoice_line*1,
											'id_uom' => $id_uom*1,
											'uom_cd' => $uom_cd_line,
											'uom_name' => $uom_name,
											'cury_unit_price' => ($unit_price_line*$rate),
											'unit_price' => $unit_price_line*1,
											'cury_sub_amount' => ($sub_amount_line*$rate),
											'sub_amount' => $sub_amount_line*1,
											'cury_discount_amount' => ($discount_amount_line*$rate),
											'discount_amount' => $discount_amount_line*1,
											'discount_percent' => $discount_percent_line*1,
											'cury_amount' => ($amount*$rate),
											'amount' => $amount*1,
											'id_sub_tax' => $id_sub_tax*1,
											'sub_tax_cd' => $sub_tax_cd_line,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa*1,
											'coa_cd' => $coa_cd_line,
											'coa_name' => $coa_name,
											'line_status' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
					                    );
					                    array_push($data_sales_invoice_line_array, $data_sales_invoice_line);
					                    $add_sales_invoice_line = $this->m_distributioncreate->add_sales_invoice_line($data_sales_invoice_line);
					                    if ($add_sales_invoice_line == true) {
					                    	$status = 1;
				                    		array_push($status_array, $status);
					                    }
					                    else {
				                    		$status = 0;
				                    		array_push($status_array, $status);
					                    }
				                    }
				                    else { // Job
				                    	$result_delivery_order_line = $this->m_distributionread->list_delivery_order_line($company_id_session, $id_delivery_order_line);
					                    $total_qty_delivery_order = $result_delivery_order_line[0]->total_qty;
					                    $id_delivery_order = $result_delivery_order_line[0]->id_delivery_order;
					                    $id_sales_order = $result_delivery_order_line[0]->id_sales_order;
					                    $sales_order_number = $result_delivery_order_line[0]->sales_order_number;
					                    $total_qty_sales_order = $result_delivery_order_line[0]->total_qty;
					                    $delivery_order_number = $result_delivery_order_line[0]->delivery_order_number;
					                    $qty_shipment_line_old = $result_delivery_order_line[0]->qty_shipment_line;
					                    $sequence_delivery_order_old = $result_delivery_order_line[0]->sequence;
					                    $id_transaction_role_delivery_order_old = $result_delivery_order_line[0]->id_transaction_role;
					                    $id_transaction_role_delivery_order_next = $id_transaction_role_delivery_order_old+1;
					                    $id_transaction_role_delivery_order_prev = $id_transaction_role_delivery_order_old-1;
					                    $id_transaction_role_sales_order_old = $result_delivery_order_line[0]->id_transaction_role_sales_order;
					                    $id_transaction_role_sales_order_next = $id_transaction_role_sales_order_old+1;
					                    $id_transaction_role_sales_order_prev = $id_transaction_role_sales_order_old-1;
					                    $id_module_delivery_order = $result_delivery_order_line[0]->id_module;

					                    $data_sales_invoice_line = array(
											'company_id' => $company_id_session,
											'sales_invoice_number' => $sales_invoice_number,
											'id_delivery_order_line' => $id_delivery_order_line*1,
											'line_number' => ($i+1),
											'id_job_order' => $id_job_order*1,
											'description' => $description,
											'qty_shipment_line' => $qty_shipment_line*1,
											'qty_invoice_line' => $qty_invoice_line*1,
											'id_uom' => $id_uom*1,
											'uom_cd' => $uom_cd_line,
											'uom_name' => $uom_name,
											'cury_unit_price' => ($unit_price_line*$rate),
											'unit_price' => $unit_price_line*1,
											'cury_sub_amount' => ($sub_amount_line*$rate),
											'sub_amount' => $sub_amount_line*1,
											'cury_discount_amount' => ($discount_amount_line*$rate),
											'discount_amount' => $discount_amount_line*1,
											'discount_percent' => $discount_percent_line*1,
											'cury_amount' => ($amount*$rate),
											'amount' => $amount*1,
											'id_sub_tax' => $id_sub_tax*1,
											'sub_tax_cd' => $sub_tax_cd_line,
											'sub_tax_name' => $sub_tax_name,
											'id_coa' => $id_coa*1,
											'coa_cd' => $coa_cd_line,
											'coa_name' => $coa_name,
											'line_status' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
					                    );
					                    array_push($data_sales_invoice_line_array, $data_sales_invoice_line);
					                    $add_sales_invoice_line = $this->m_distributioncreate->add_sales_invoice_line($data_sales_invoice_line);
					                    if ($add_sales_invoice_line == true) {
					                    	$result_total_qty_invoice_line = $this->m_distributionread->list_total_qty_invoice_line_by_id_delivery_order_line($company_id_session, $id_delivery_order_line);
					                    	$total_qty_invoice_by_id_delivery_order_line = $result_total_qty_invoice_line[0]->total_qty_invoice_by_id_delivery_order_line;
					                    	if ($qty_shipment_line == $total_qty_invoice_by_id_delivery_order_line) { // Update delivery order line status
					                    		$data_delvery_order_line = array (
					                    			'line_status' => 1,
					                    			'last_by' => $cNIK_session,
					                    			'last_update' => $last_update
					                    		);
					                    		$result_delivery_order_line = $this->m_distributionupdate->update_delivery_order_line($company_id_session, $data_delvery_order_line, ($id_delivery_order_line*1));
					                    		if ($result_delivery_order_line == true) {
					                    			/*$result_total_qty_invoice_line_by_delivery_order = $this->m_distributionread->list_total_qty_invoice_line_by_delivery_order_number($company_id_session, $delivery_order_number);
					                    			$total_qty_invoice_by_delivery_order_number = $result_total_qty_invoice_line_by_delivery_order[0]->total_qty_invoice_by_delivery_order_number;

					                    			$result_delivery_order = $this->m_distributionread->list_delivery_order_by_delivery_order_number($company_id_session, $delivery_order_number);
					                    			$total_qty_delivery_order = $result_delivery_order[0]->total_qty;

					                    			if ($total_qty_invoice_by_delivery_order_number==$total_qty_delivery_order) {
					                    				$data_delvery_order_header = array (
					                    					'id_transaction_role' => $id_transaction_role_delivery_order_next,
					                    					'last_by' => $cNIK_session,
					                    					'last_update' => $last_update
					                    				);
					                    				$result_delivery_order_header = $this->m_distributionupdate->update_delivery_order_by_delivery_order_number($company_id_session, $delivery_order_number);
					                    				if ($result_delivery_order_header == true) {
					                    					$result_total_qty_invoice_by_sales_order_number = $this->m_distributionread->list_total_qty_invoice_by_sales_order_number($company_id_session, $sales_order_number);
					                    					$total_qty_invoice_by_sales_order_number = $result_total_qty_invoice_by_sales_order_number[0]->total_qty_invoice_by_sales_order_number;
					                    					if ($total_qty_invoice_by_sales_order_number == $total_qty_sales_order) {
					                    						$data_sales_order_header = array (
					                    							'id_transaction_role' => $id_transaction_role_sales_order_next,
					                    							'last_by' => $cNIK_session,
					                    							'last_update' => $last_update
					                    						);
					                    						$result_sales_order = $this->m_distributionupdate->update_sales_order_by_sales_order_number($company_id_session, $sales_order_number);
					                    						if ($result_sales_order == true) {
					                    							$status = 1;
				                    								array_push($status_array, $status);	
					                    						}
					                    						else {
					                    							$status = 1;
				                    								array_push($status_array, $status);	
					                    						}
					                    					}
					                    					else {
					                    						$status = 1;
				                    							array_push($status_array, $status);	
					                    					}
					                    				}
					                    				else {
					                    					$status = 1;
				                    						array_push($status_array, $status);
					                    				}
					                    			}
					                    			else {
					                    				$status = 1;
				                    					array_push($status_array, $status);
					                    			}*/
					                    			$status = 1;
					                    			$responseValue = "Update delivery order line success";
				                    				array_push($status_array, $status);
					                    		}
					                    		else {
					                    			$status = 0;
					                    			$responseValue = "Cannot update delivery order line. ID Delivery Order Line = ".$id_delivery_order_line;
				                    				array_push($status_array, $status);
					                    		}
					                    	}
					                    	else {
					                    		$status = 0;
					                    		$responseValue = "Qty delivery order not same with qty sales invoice.";
				                    			array_push($status_array, $status);
					                    	}
					                    }
					                    else {
				                    		$status = 0;
				                    		$responseValue = "Cannot add Sales Invoice Line.";
				                    		array_push($status_array, $status);
					                    }
				                    }
			                    }
		                    }
		                    else {
		                    	$status = 0;
		                    	array_push($status_array, $status);
		                    }
						}
						else { // Update Sales Invoice
							$data_sales_invoice_header = array(
								'tax_number' => $tax_number,
								'sales_invoice_date' => $sales_invoice_date,
								'year' => $year,
								'periode' => $periode,
								'customer_order_number' => $customer_order_number,
								'note' => $note,
								'id_coa_currency' => $id_coa_currency*1,
								'rate' => $rate*1,
								'id_payment_methode' => $id_payment_methode*1,
								'id_payment_terms' => $id_payment_terms*1,
								'cNIK_approval' => $cNIK_approval,
								'total_line' => $total_line*1,
								'total_qty' => $total_qty*1,
								'cury_sub_amount' => $sub_amount*$rate,
								'sub_amount' => $sub_amount*1,
								'cury_discount_amount' => $discount_amount*$rate,
								'discount_amount' => $discount_amount*1,
								'cury_amount' => $amount*$rate,
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,
								'cury_total_amount' => ($total_amount*$rate),
								'total_amount' => $total_amount*1,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
		                    );
		                    array_push($data_sales_invoice_header_array, $data_sales_invoice_header);
		                    $update_sales_invoice_header = $this->m_distributionupdate->update_sales_invoice_by_sales_invoice_number($company_id_session, $data_sales_invoice_header, $sales_invoice_number);
		                    if ($update_sales_invoice_header == true) {
		                    	for ($i=0; $i < count($id_job_order_array); $i++) { 
			                    	$id_sales_invoice_line = $id_sales_invoice_line_array[$i];
				                    $id_delivery_order_line = ($id_delivery_order_line_array[$i])*1;
				                    $id_job_order = $id_job_order_array[$i];
				                    $description = $description_array[$i];
				                    $qty_shipment_line = $qty_shipment_line_array[$i];
				                    $qty_invoice_line = $qty_invoice_line_array[$i];
				                    $uom_cd_line = $uom_cd_line_array[$i];
				                    $unit_price_line = $unit_price_line_array[$i];
				                    $sub_amount_line = $sub_amount_line_array[$i];
				                    $discount_amount_line = $discount_amount_line_array[$i];
				                    $discount_percent_line = $discount_percent_line_array[$i];
				                    $amount_line = $amount_line_array[$i];
				                    $sub_tax_cd_line = $sub_tax_cd_line_array[$i];
				                    $coa_cd_line = $coa_cd_line_array[$i];

				                    if ($id_job_order=='') {
				                    	$id_job_order=0;
				                    }
				                    else {
				                    	$id_job_order=$id_job_order;
				                    }

				                    $result_uom = $this->m_inventoryread->list_uom_by_uom_cd($company_id_session, $uom_cd_line);
				                    $id_uom = $result_uom[0]->id_uom;
				                    $uom_name = $result_uom[0]->uom_name;

				                    $result_sub_tax = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd_line);
				                    $id_sub_tax = $result_sub_tax[0]->id_sub_tax;
				                    $sub_tax_name = $result_sub_tax[0]->sub_tax_name;

				                    $result_coa = $this->m_inventoryread->list_coa_by_coa_cd($company_id_session, $coa_cd_line);
				                    $id_coa = $result_coa[0]->id_coa;
				                    $coa_name = $result_coa[0]->coa_name;

				                    if ($id_sales_invoice_line=='') { // New Line
				                    	if ($id_delivery_order_line=='') { // Non Job
					                    	$data_sales_invoice_line = array(
												'company_id' => $company_id_session,
												'sales_invoice_number' => $sales_invoice_number,
												'id_delivery_order_line' => null,
												'line_number' => ($i+1),
												'id_job_order' => null,
												'description' => $description,
												'qty_shipment_line' => $qty_shipment_line*1,
												'qty_invoice_line' => $qty_invoice_line*1,
												'id_uom' => $id_uom*1,
												'uom_cd' => $uom_cd_line,
												'uom_name' => $uom_name,
												'cury_unit_price' => ($unit_price_line*$rate),
												'unit_price' => $unit_price_line*1,
												'cury_sub_amount' => ($sub_amount_line*$rate),
												'sub_amount' => $sub_amount_line*1,
												'cury_discount_amount' => ($discount_amount_line*$rate),
												'discount_amount' => $discount_amount_line*1,
												'discount_percent' => $discount_percent_line*1,
												'cury_amount' => ($amount*$rate),
												'amount' => $amount*1,
												'id_sub_tax' => $id_sub_tax*1,
												'sub_tax_cd' => $sub_tax_cd_line,
												'sub_tax_name' => $sub_tax_name,
												'id_coa' => $id_coa*1,
												'coa_cd' => $coa_cd_line,
												'coa_name' => $coa_name,
												'line_status' => 0,
												'create_by' => $cNIK_session,
												'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
						                    );
						                    array_push($data_sales_invoice_line_array, $data_sales_invoice_line);
						                    $add_sales_invoice_line = $this->m_distributioncreate->add_sales_invoice_line($data_sales_invoice_line);
						                    if ($add_sales_invoice_line == true) {
						                    	$status = 1;
					                    		array_push($status_array, $status);
						                    }
						                    else {
					                    		$status = 0;
					                    		array_push($status_array, $status);
						                    }
					                    }
					                    else { // Job
					                    	$result_delivery_order_line = $this->m_distributionread->list_delivery_order_line($company_id_session, $id_delivery_order_line);
						                    $total_qty_delivery_order = $result_delivery_order_line[0]->total_qty;
						                    $id_delivery_order = $result_delivery_order_line[0]->id_delivery_order;
						                    $id_sales_order = $result_delivery_order_line[0]->id_sales_order;
						                    $sales_order_number = $result_delivery_order_line[0]->sales_order_number;
						                    $total_qty_sales_order = $result_delivery_order_line[0]->total_qty;
						                    $delivery_order_number = $result_delivery_order_line[0]->delivery_order_number;
						                    $qty_shipment_line_old = $result_delivery_order_line[0]->qty_shipment_line;
						                    $sequence_delivery_order_old = $result_delivery_order_line[0]->sequence;
						                    $id_transaction_role_delivery_order_old = $result_delivery_order_line[0]->id_transaction_role;
						                    $id_transaction_role_delivery_order_next = $id_transaction_role_delivery_order_old+1;
						                    $id_transaction_role_delivery_order_prev = $id_transaction_role_delivery_order_old-1;
						                    $id_transaction_role_sales_order_old = $result_delivery_order_line[0]->id_transaction_role_sales_order;
						                    $id_transaction_role_sales_order_next = $id_transaction_role_sales_order_old+1;
						                    $id_transaction_role_sales_order_prev = $id_transaction_role_sales_order_old-1;
						                    $id_module_delivery_order = $result_delivery_order_line[0]->id_module;

						                    $data_sales_invoice_line = array(
												'company_id' => $company_id_session,
												'sales_invoice_number' => $sales_invoice_number,
												'id_delivery_order_line' => $id_delivery_order_line*1,
												'line_number' => ($i+1),
												'id_job_order' => $id_job_order*1,
												'description' => $description,
												'qty_shipment_line' => $qty_shipment_line*1,
												'qty_invoice_line' => $qty_invoice_line*1,
												'id_uom' => $id_uom*1,
												'uom_cd' => $uom_cd_line,
												'uom_name' => $uom_name,
												'cury_unit_price' => ($unit_price_line*$rate),
												'unit_price' => $unit_price_line*1,
												'cury_sub_amount' => ($sub_amount_line*$rate),
												'sub_amount' => $sub_amount_line*1,
												'cury_discount_amount' => ($discount_amount_line*$rate),
												'discount_amount' => $discount_amount_line*1,
												'discount_percent' => $discount_percent_line*1,
												'cury_amount' => ($amount*$rate),
												'amount' => $amount*1,
												'id_sub_tax' => $id_sub_tax*1,
												'sub_tax_cd' => $sub_tax_cd_line,
												'sub_tax_name' => $sub_tax_name,
												'id_coa' => $id_coa*1,
												'coa_cd' => $coa_cd_line,
												'coa_name' => $coa_name,
												'line_status' => 0,
												'create_by' => $cNIK_session,
												'create_date' => $last_update,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
						                    );
						                    array_push($data_sales_invoice_line_array, $data_sales_invoice_line);
						                    $add_sales_invoice_line = $this->m_distributioncreate->add_sales_invoice_line($data_sales_invoice_line);
						                    if ($add_sales_invoice_line == true) {
						                    	$result_total_qty_invoice_line = $this->m_distributionread->list_total_qty_invoice_line_by_id_delivery_order_line($company_id_session, $id_delivery_order_line);
						                    	$total_qty_invoice_by_id_delivery_order_line = $result_total_qty_invoice_line[0]->total_qty_invoice_by_id_delivery_order_line;
						                    	if ($qty_shipment_line == $total_qty_invoice_by_id_delivery_order_line) { // Update delivery order line status
						                    		$data_delvery_order_line = array (
						                    			'line_status' => 1,
						                    			'last_by' => $cNIK_session,
						                    			'last_update' => $last_update
						                    		);
						                    		$result_delivery_order_line = $this->m_distributionupdate->update_delivery_order_line($company_id_session, $data_delvery_order_line, ($id_delivery_order_line*1));
						                    		if ($result_delivery_order_line == true) {
						                    			/*$result_total_qty_invoice_line_by_delivery_order = $this->m_distributionread->list_total_qty_invoice_line_by_delivery_order_number($company_id_session, $delivery_order_number);
						                    			$total_qty_invoice_by_delivery_order_number = $result_total_qty_invoice_line_by_delivery_order[0]->total_qty_invoice_by_delivery_order_number;

						                    			$result_delivery_order = $this->m_distributionread->list_delivery_order_by_delivery_order_number($company_id_session, $delivery_order_number);
						                    			$total_qty_delivery_order = $result_delivery_order[0]->total_qty;

						                    			if ($total_qty_invoice_by_delivery_order_number==$total_qty_delivery_order) {
						                    				$data_delvery_order_header = array (
						                    					'id_transaction_role' => $id_transaction_role_delivery_order_next,
						                    					'last_by' => $cNIK_session,
						                    					'last_update' => $last_update
						                    				);
						                    				$result_delivery_order_header = $this->m_distributionupdate->update_delivery_order_by_delivery_order_number($company_id_session, $delivery_order_number);
						                    				if ($result_delivery_order_header == true) {
						                    					$result_total_qty_invoice_by_sales_order_number = $this->m_distributionread->list_total_qty_invoice_by_sales_order_number($company_id_session, $sales_order_number);
						                    					$total_qty_invoice_by_sales_order_number = $result_total_qty_invoice_by_sales_order_number[0]->total_qty_invoice_by_sales_order_number;
						                    					if ($total_qty_invoice_by_sales_order_number == $total_qty_sales_order) {
						                    						$data_sales_order_header = array (
						                    							'id_transaction_role' => $id_transaction_role_sales_order_next,
						                    							'last_by' => $cNIK_session,
						                    							'last_update' => $last_update
						                    						);
						                    						$result_sales_order = $this->m_distributionupdate->update_sales_order_by_sales_order_number($company_id_session, $sales_order_number);
						                    						if ($result_sales_order == true) {
						                    							$status = 1;
					                    								array_push($status_array, $status);	
						                    						}
						                    						else {
						                    							$status = 1;
					                    								array_push($status_array, $status);	
						                    						}
						                    					}
						                    					else {
						                    						$status = 1;
					                    							array_push($status_array, $status);	
						                    					}
						                    				}
						                    				else {
						                    					$status = 1;
					                    						array_push($status_array, $status);
						                    				}
						                    			}
						                    			else {
						                    				$status = 1;
					                    					array_push($status_array, $status);
						                    			}*/
						                    			$status = 1;
						                    			$responseValue = "Update delivery order line success";
					                    				array_push($status_array, $status);
						                    		}
						                    		else {
						                    			$status = 0;
						                    			$responseValue = "Cannot update delivery order line. ID Delivery Order Line = ".$id_delivery_order_line;
					                    				array_push($status_array, $status);
						                    		}
						                    	}
						                    	else {
						                    		$status = 0;
						                    		$responseValue = "Qty delivery order not same with qty sales invoice.";
					                    			array_push($status_array, $status);
						                    	}
						                    }
						                    else {
					                    		$status = 0;
					                    		$responseValue = "Cannot add Sales Invoice Line.";
					                    		array_push($status_array, $status);
						                    }
					                    }
				                    }
				                    else {
				                    	if ($id_delivery_order_line=='') { // Non Job
					                    	$data_sales_invoice_line = array(
												'id_job_order' => null,
												'description' => $description,
												'qty_shipment_line' => $qty_shipment_line*1,
												'qty_invoice_line' => $qty_invoice_line*1,
												'id_uom' => $id_uom*1,
												'uom_cd' => $uom_cd_line,
												'uom_name' => $uom_name,
												'cury_unit_price' => ($unit_price_line*$rate),
												'unit_price' => $unit_price_line*1,
												'cury_sub_amount' => ($sub_amount_line*$rate),
												'sub_amount' => $sub_amount_line*1,
												'cury_discount_amount' => ($discount_amount_line*$rate),
												'discount_amount' => $discount_amount_line*1,
												'discount_percent' => $discount_percent_line*1,
												'cury_amount' => ($amount*$rate),
												'amount' => $amount*1,
												'id_sub_tax' => $id_sub_tax*1,
												'sub_tax_cd' => $sub_tax_cd_line,
												'sub_tax_name' => $sub_tax_name,
												'id_coa' => $id_coa*1,
												'coa_cd' => $coa_cd_line,
												'coa_name' => $coa_name,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
						                    );
						                    array_push($data_sales_invoice_line_array, $data_sales_invoice_line);
						                    $update_sales_invoice_line = $this->m_distributionupdate->update_sales_invoice_line($company_id_session, $data_sales_invoice_line, $id_sales_invoice_line);
						                    if ($update_sales_invoice_line == true) {
						                    	$status = 1;
					                    		array_push($status_array, $status);
						                    }
						                    else {
					                    		$status = 0;
					                    		array_push($status_array, $status);
						                    }
					                    }
					                    else { // Job
					                    	$result_delivery_order_line = $this->m_distributionread->list_delivery_order_line($company_id_session, $id_delivery_order_line);
						                    $total_qty_delivery_order = $result_delivery_order_line[0]->total_qty;
						                    $id_delivery_order = $result_delivery_order_line[0]->id_delivery_order;
						                    $id_sales_order = $result_delivery_order_line[0]->id_sales_order;
						                    $sales_order_number = $result_delivery_order_line[0]->sales_order_number;
						                    $total_qty_sales_order = $result_delivery_order_line[0]->total_qty;
						                    $delivery_order_number = $result_delivery_order_line[0]->delivery_order_number;
						                    $qty_shipment_line_old = $result_delivery_order_line[0]->qty_shipment_line;
						                    $sequence_delivery_order_old = $result_delivery_order_line[0]->sequence;
						                    $id_transaction_role_delivery_order_old = $result_delivery_order_line[0]->id_transaction_role;
						                    $id_transaction_role_delivery_order_next = $id_transaction_role_delivery_order_old+1;
						                    $id_transaction_role_delivery_order_prev = $id_transaction_role_delivery_order_old-1;
						                    $id_transaction_role_sales_order_old = $result_delivery_order_line[0]->id_transaction_role_sales_order;
						                    $id_transaction_role_sales_order_next = $id_transaction_role_sales_order_old+1;
						                    $id_transaction_role_sales_order_prev = $id_transaction_role_sales_order_old-1;
						                    $id_module_delivery_order = $result_delivery_order_line[0]->id_module;

						                    $data_sales_invoice_line = array(
												'id_job_order' => $id_job_order*1,
												'description' => $description,
												'qty_shipment_line' => $qty_shipment_line*1,
												'qty_invoice_line' => $qty_invoice_line*1,
												'id_uom' => $id_uom*1,
												'uom_cd' => $uom_cd_line,
												'uom_name' => $uom_name,
												'cury_unit_price' => ($unit_price_line*$rate),
												'unit_price' => $unit_price_line*1,
												'cury_sub_amount' => ($sub_amount_line*$rate),
												'sub_amount' => $sub_amount_line*1,
												'cury_discount_amount' => ($discount_amount_line*$rate),
												'discount_amount' => $discount_amount_line*1,
												'discount_percent' => $discount_percent_line*1,
												'cury_amount' => ($amount*$rate),
												'amount' => $amount*1,
												'id_sub_tax' => $id_sub_tax*1,
												'sub_tax_cd' => $sub_tax_cd_line,
												'sub_tax_name' => $sub_tax_name,
												'id_coa' => $id_coa*1,
												'coa_cd' => $coa_cd_line,
												'coa_name' => $coa_name,
												'last_by' => $cNIK_session,
												'last_update' => $last_update,
						                    );
						                    array_push($data_sales_invoice_line_array, $data_sales_invoice_line);
						                    $update_sales_invoice_line = $this->m_distributionupdate->update_sales_invoice_line($company_id_session, $data_sales_invoice_line, $id_sales_invoice_line);
						                    if ($update_sales_invoice_line == true) {
						                    	$result_total_qty_invoice_line = $this->m_distributionread->list_total_qty_invoice_line_by_id_delivery_order_line($company_id_session, $id_delivery_order_line);
						                    	$total_qty_invoice_by_id_delivery_order_line = $result_total_qty_invoice_line[0]->total_qty_invoice_by_id_delivery_order_line;
						                    	if ($qty_shipment_line == $total_qty_invoice_by_id_delivery_order_line) { // Update delivery order line status
						                    		$data_delvery_order_line = array (
						                    			'line_status' => 1,
						                    			'last_by' => $cNIK_session,
						                    			'last_update' => $last_update
						                    		);
						                    		$result_delivery_order_line = $this->m_distributionupdate->update_delivery_order_line($company_id_session, $data_delvery_order_line, ($id_delivery_order_line*1));
						                    		if ($result_delivery_order_line == true) {
						                    			$status = 1;
						                    			$responseValue = "Update delivery order line success";
					                    				array_push($status_array, $status);
						                    		}
						                    		else {
						                    			$status = 0;
						                    			$responseValue = "Cannot update delivery order line. ID Delivery Order Line = ".$id_delivery_order_line;
					                    				array_push($status_array, $status);
						                    		}
						                    	}
						                    	else {
						                    		$status = 0;
						                    		$responseValue = "Qty delivery order not same with qty sales invoice.";
					                    			array_push($status_array, $status);
						                    	}
						                    }
						                    else {
					                    		$status = 0;
					                    		$responseValue = "Cannot add Sales Invoice Line.";
					                    		array_push($status_array, $status);
						                    }
					                    }
				                    }
			                    }
		                    }
		                    else {
		                    	$status = 0;
		                    	array_push($status_array, $status);
		                    }
						}
					}
					//echo json_encode(array(array('status' => array_unique($status_array), 'header' => $data_delvery_order_header_array, 'line' => $data_delvery_order_line_array, 'sales_invoice_number' => $sales_invoice_number)));		
					echo json_encode(array(array('status' => array_unique($status_array), 'header' => $data_sales_invoice_header_array, 'line' => $data_sales_invoice_line_array, 'sales_invoice_number' => $sales_invoice_number, 'response' => $responseValue)));	
				}
			}
		}

		public function release_sales_invoice($key_session){
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
					$data_array = array();
					$data_transaction_header_array = array();
					$data_transaction_line_array = array();

					$this->form_validation->set_rules('sales_invoice_number', 'sales_invoice_number', 'required');
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
						array_push ($status_array, $status);
					}
					else {
						$sales_invoice_number = $this->input->post('sales_invoice_number');
						$result_sales_invoice = $this->m_distributionread->list_sales_invoice_by_sales_invoice_number($company_id_session, $sales_invoice_number);

						$last_update = date('Y-m-d H:i:s');

						if (count($result_sales_invoice) == 0) {
							$status = 0;
						}
						else {
							$module_cd = 'CP';
							$result_module = $this->m_financeread->list_module_by_module_cd($company_id_session, $module_cd);
							foreach ($result_module as $resultList_module);
							$id_module = ($resultList_module->id_module)*1;

							$result_header_numbering = $this->m_financeread->list_header_numbering($company_id_session, $id_module);
							if (count($result_header_numbering) == 0) {
								$status = 0;
								$responseValue = 'Header number not registered on system.';
							}
							else {

								foreach ($result_header_numbering as $resultList_header_numbering);
								$string_format = $resultList_header_numbering->string_format;
								$cut_1 = $resultList_header_numbering->cut_1;
								$cut_2 = $resultList_header_numbering->cut_2;
								$number_length = $resultList_header_numbering->number_length;

								foreach ($result_sales_invoice as $resultList);
								$id_account = ($resultList->id_account)*1;
								$sequence_sales_invoice = ($resultList->sequence)*1;
								$id_module_sales_invoice = ($resultList->id_module)*1;
								$id_coa_currency = ($resultList->id_coa_currency)*1;
								$periode_sales_invoice = ($resultList->periode).'-01';
								$cury_sub_amount_sales_invoice = ($resultList->cury_sub_amount)*1;
								$sub_amount_sales_invoice = ($resultList->sub_amount)*1;
								$cury_amount_sales_invoice = ($resultList->cury_amount)*1;
								$amount_sales_invoice = ($resultList->amount)*1;
								$ppn_sales_invoice = ($resultList->ppn)*1;
								$pph_sales_invoice = ($resultList->pph)*1;
								$cury_total_amount_sales_invoice = ($resultList->cury_total_amount)*1;
								$total_amount_sales_invoice = ($resultList->total_amount)*1;

								$sequence_new = $sequence_sales_invoice+1;
								
								$result_transaction_role_new = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module_sales_invoice, $sequence_new);
								$id_transaction_role_new = $result_transaction_role_new[0]->id_transaction_role;
								$transaction_name_new = $result_transaction_role_new[0]->transaction_name;

								$year_trans = date_format(date_create($resultList->periode), 'Y');

								$result_transaction_by_year = $this->m_financeread->list_transaction_by_year($company_id_session, $id_module, $year_trans);
								$transaction_count = count($result_transaction_by_year);
								$transaction_next = $transaction_count+1;

								$result_transaction_by_account_periode = $this->m_financeread->list_transaction_by_account_periode($company_id_session, $id_module, $id_account, $id_coa_currency, $periode_sales_invoice);

								if (count($result_transaction_by_account_periode)==0) { // Add New Transaction
									$transaction_next_add_zero = sprintf("%0".$number_length."d", $transaction_next);
									$transaction_number = $string_format.''.$cut_1.''.$year_trans.''.$cut_2.''.$transaction_next_add_zero;
									
									$cury_sub_amount = $cury_sub_amount_sales_invoice;
									$sub_amount = $sub_amount_sales_invoice;
									$cury_amount = $cury_amount_sales_invoice;
									$amount = $amount_sales_invoice;
									$ppn = $ppn_sales_invoice;
									$pph = $pph_sales_invoice;
									$cury_total_amount = $cury_total_amount_sales_invoice;
									$total_amount = $total_amount_sales_invoice;

									$data_transaction_header = array(
										'company_id' => $company_id_session,
										'id_coa_currency' => $id_coa_currency,
										'id_cash_account' => null,
										'id_module' => $id_module,
										'id_account' => $id_account,
										'transaction_date' => null,
										'transaction_periode' => $periode_sales_invoice,
										'transaction_type' => 'IN',
										'transaction_number' => $transaction_number,
										'total_line' => null,
										'total_qty' => null,
										'cury_sub_amount' => $cury_sub_amount,
										'sub_amount' => $sub_amount,
										'cury_amount' => $cury_amount,
										'amount' => $amount,
										'ppn' => $ppn,
										'pph' => $pph,
										'cury_total_amount' => $cury_total_amount,
										'total_amount' => $total_amount,
										'note' => $resultList->note,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
										'deleted' => 0,
									);
									array_push($data_transaction_header_array, $data_transaction_header);
									$result_add_transaction_header = $this->m_distributioncreate->add_transaction_header($data_transaction_header);
									if ($result_add_transaction_header==true) {
										$data_transaction_line = array(
											'company_id' => $company_id_session,
											'id_module' => $id_module,
											'id_coa_currency' => $id_coa_currency,
											'id_bank_account' => null,
											'transaction_number' => $transaction_number,
											'transaction_periode' => $periode_sales_invoice,
											'transfer_date' => null,
											'transfer_ref' => null,
											'distribution_number' => $sales_invoice_number,
											'check_1' => 0,
											'check_2' => 0,
											'check_3' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
											'deleted' => 0,
										);
										array_push($data_transaction_line_array, $data_transaction_line);
										$result_add_transaction_line = $this->m_distributioncreate->add_transaction_distribution($data_transaction_line);
										if ($result_add_transaction_line==true) {
											$update_distribution = array(
												'id_transaction_role' => $id_transaction_role_new,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_distribution = $this->m_distributionupdate->update_sales_invoice_by_sales_invoice_number($company_id_session, $update_distribution, $sales_invoice_number);
											if ($result_update_distribution==true) {
												$status = 1;
											}
											else {
												$status = 0;
												$responseValue = 'Cannot update sales invoice status.';
											}
										}
										else {
											$status = 0;
											$responseValue = 'Cannot add transaction distribution.';
										}
									}
									else {
										$status = 0;
										$responseValue = 'Cannot add transaction header.';
									}
								}
								else { // Update Transaction

									foreach ($result_transaction_by_account_periode as $resultList_transaction);
									$id_transaction = $resultList_transaction->id_transaction;
									$transaction_number = $resultList_transaction->transaction_number;
									$cury_sub_amount_transaction = ($resultList_transaction->cury_sub_amount)*1;
									$sub_amount_transaction = ($resultList_transaction->sub_amount)*1;
									$cury_amount_transaction = ($resultList_transaction->cury_amount)*1;
									$amount_transaction = ($resultList_transaction->amount)*1;
									$ppn_transaction = ($resultList_transaction->ppn)*1;
									$pph_transaction = ($resultList_transaction->pph)*1;
									$cury_total_amount_transaction = ($resultList_transaction->cury_total_amount)*1;
									$total_amount_transaction = ($resultList_transaction->total_amount)*1;

									$cury_sub_amount = $cury_sub_amount_sales_invoice+$cury_sub_amount_transaction;
									$sub_amount = $sub_amount_sales_invoice+$sub_amount_transaction;
									$cury_amount = $cury_amount_sales_invoice+$cury_amount_transaction;
									$amount = $amount_sales_invoice+$amount_transaction;
									$ppn = $ppn_sales_invoice+$ppn_transaction;
									$pph = $pph_sales_invoice+$pph_transaction;
									$cury_total_amount = $cury_total_amount_sales_invoice+$cury_total_amount_transaction;
									$total_amount = $total_amount_sales_invoice+$total_amount_transaction;

									$data_transaction_header = array(
										'cury_sub_amount' => $cury_sub_amount,
										'sub_amount' => $sub_amount,
										'cury_amount' => $cury_amount,
										'amount' => $amount,
										'ppn' => $ppn,
										'pph' => $pph,
										'cury_total_amount' => $cury_total_amount,
										'total_amount' => $total_amount,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									array_push($data_transaction_header_array, $data_transaction_header);

									$result_update_transaction_header = $this->m_distributionupdate->update_transaction_header($company_id_session, $data_transaction_header, $id_transaction);
									if ($result_update_transaction_header==true) {
										$data_transaction_line = array(
											'company_id' => $company_id_session,
											'id_module' => $id_module,
											'id_coa_currency' => $id_coa_currency,
											'id_bank_account' => null,
											'transaction_number' => $transaction_number,
											'transaction_periode' => $periode_sales_invoice,
											'transfer_date' => null,
											'transfer_ref' => null,
											'distribution_number' => $sales_invoice_number,
											'check_1' => 0,
											'check_2' => 0,
											'check_3' => 0,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
											'deleted' => 0,
										);
										array_push($data_transaction_line_array, $data_transaction_line);
										$result_add_transaction_line = $this->m_distributioncreate->add_transaction_distribution($data_transaction_line);
										if ($result_add_transaction_line==true) {
											$update_distribution = array(
												'id_transaction_role' => $id_transaction_role_new,
												'last_by' => $cNIK_session,
												'last_update' => $last_update
											);
											$result_update_distribution = $this->m_distributionupdate->update_sales_invoice_by_sales_invoice_number($company_id_session, $update_distribution, $sales_invoice_number);
											if ($result_update_distribution==true) {
												$status = 0;
											}
											else {
												$status = 0;
											}
										}
										else {
											$status = 0;
										}
									}
									else {
										$status = 0;
									}
								}
							}
						}
					}
					echo json_encode(array(array('status' => $status, 'data_transaction_header' => $data_transaction_header_array, 'data_transaction_line' => $data_transaction_line_array, 'id_transaction_role_new' => $id_transaction_role_new, 'transaction_name_new' => $transaction_name_new, 'response' => $responseValue)));
				}
			}
		}

	}