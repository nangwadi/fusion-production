<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class CoaUpdate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_coaread');
	        $this->load->model('m_coacreate');
	        $this->load->model('m_coaupdate');
	        $this->load->model('m_templatepage');
	        $this->load->model('m_essread');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting


		// Input

		public function update_coa_type($key_session){
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
					$this->form_validation->set_rules('id_coa_type', 'id_coa_type', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_coa_type = $this->input->post('id_coa_type');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_coaupdate->update_coa_type($data, $company_id_session, $id_coa_type);
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

		public function update_coa_classes($key_session){
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
					$this->form_validation->set_rules('id_coa_classes', 'id_coa_classes', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_coa_classes = $this->input->post('id_coa_classes');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_coaupdate->update_coa_classes($data, $company_id_session, $id_coa_classes);
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

		public function update_coa_currency($key_session){
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
					$this->form_validation->set_rules('id_coa_currency', 'id_coa_currency', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_coa_currency = $this->input->post('id_coa_currency');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_coaupdate->update_coa_currency($data, $company_id_session, $id_coa_currency);
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

		public function update_chart_of_account($key_session){
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
					$this->form_validation->set_rules('id_coa', 'id_coa', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_coa = $this->input->post('id_coa');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_coaupdate->update_chart_of_account($data, $company_id_session, $id_coa);
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

		public function update_sub_chart_of_account($key_session){
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
					$this->form_validation->set_rules('id_coa_sub', 'id_coa_sub', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_coa_sub = $this->input->post('id_coa_sub');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_coaupdate->update_sub_chart_of_account($data, $company_id_session, $id_coa_sub);
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

		public function update_cash_account($key_session){
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
					$this->form_validation->set_rules('id_cash_account', 'id_cash_account', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_cash_account = $this->input->post('id_cash_account');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_coaupdate->update_cash_account($data, $company_id_session, $id_cash_account);
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

		public function set_default_cash_account($key_session){
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
					$this->form_validation->set_rules('id_cash_account', 'id_cash_account', 'required');
					//$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_cash_account = $this->input->post('id_cash_account');
						//$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'set_default' => 1,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_coaupdate->update_cash_account($data, $company_id_session, $id_cash_account);
						if ($result==true) {
							$data_back = array(
								'set_default' => 0,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result_back = $this->m_coaupdate->update_back_cash_account($data_back, $company_id_session, $id_cash_account);
							if ($result_back == true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Data Back not updated.';
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

		// Delete Rate

		public function delete_department_approval($key_session){
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
					$this->form_validation->set_rules('id_coa_rate', 'id_coa_rate', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa_rate = $this->input->post('id_coa_rate');
						$last_update = date('Y-m-d H:i:s');
						$result = $this->m_coaupdate->delete_rate($company_id_session, $id_coa_rate);
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
	}
