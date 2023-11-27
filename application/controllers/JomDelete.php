<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class JomDelete extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_jomread');
	        $this->load->model('m_jomcreate');
	        $this->load->model('m_jomupdate');
	        $this->load->model('m_jomdelete');
	        //$this->load->model('m_jompage');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function delete_permission_employee($key_session){
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
					$this->form_validation->set_rules('id_permission_employee', 'id_permission_employee', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_permission_employee = $this->input->post('id_permission_employee');
						$last_update = date('Y-m-d H:i:s');
						$result = $this->m_jomdelete->delete_permission_employee($company_id_session, $id_permission_employee);
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

		public function delete_permission_special($key_session){
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
					$this->form_validation->set_rules('id_permission_special', 'id_permission_special', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_permission_special = $this->input->post('id_permission_special');
						$last_update = date('Y-m-d H:i:s');
						$result = $this->m_jomdelete->delete_permission_special($company_id_session, $id_permission_special);
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

		public function delete_job_order($key_session){
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
					$this->form_validation->set_rules('id_job_order', 'id_job_order', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_job_order = $this->input->post('id_job_order');
						$last_update = date('Y-m-d H:i:s');

						$result = $this->m_jomread->list_job_order_by_id_job_order($company_id_session, $id_job_order);

						$id_account = $result[0]->id_account;
						$id_job_type = $result[0]->id_job_type;

						$result_job_number = $this->m_jomread->list_job_number($company_id_session, $id_account, $id_job_type);
						$number_old = $result_job_number[0]->number;
						$number = $number_old-1;

						$result = $this->m_jomdelete->delete_job_order($company_id_session, $id_job_order);
						if ($result==true) {
							$result_after_trial = $this->m_jomdelete->delete_after_trial_by_id_job_order($company_id_session, $id_job_order);
							if ($result_after_trial==true) {
								$data=array(
									'number' => ($number)*1,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomupdate->update_job_number($data, $company_id_session, $id_account, $id_job_type);
								if ($result==true) {
									$status = 1;
									$responseValue = '';
								}
								else {
									$status = 0;
									$responseValue = 'Data not updated.';
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data not deleted.';
							}
						}
						else {
							$status = 0;
							$responseValue = 'Data not deleted.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $number)));
				}
			}
		}

		public function delete_after_trial($key_session){
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
					$this->form_validation->set_rules('id_job_order_after_trial', 'id_job_order_after_trial', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_job_order_after_trial = $this->input->post('id_job_order_after_trial');
						$last_update = date('Y-m-d H:i:s');
						$result = $this->m_jomdelete->delete_after_trial($company_id_session, $id_job_order_after_trial);
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

		// Input

		public function delete_part_list($key_session){
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
					$this->form_validation->set_rules('id_part_list', 'id_part_list', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_part_list = $this->input->post('id_part_list');
						$last_update = date('Y-m-d H:i:s');

						$result = $this->m_jomdelete->delete_part_list($company_id_session, $id_part_list);
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

		public function delete_imo_line($key_session){
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
					$this->form_validation->set_rules('id_material_order_line', 'id_material_order_line', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_material_order_line = $this->input->post('id_material_order_line');
						$last_update = date('Y-m-d H:i:s');

						$result = $this->m_jomdelete->delete_imo_line($company_id_session, $id_material_order_line);
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

		public function delete_rto($key_session){
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
					$this->form_validation->set_rules('id_part_list', 'id_part_list', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_part_list = $this->input->post('id_part_list');
						$last_update = date('Y-m-d H:i:s');

						$result = $this->m_jomdelete->delete_rto($company_id_session, $id_part_list);
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

	}
