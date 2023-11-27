<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DailyReportCreate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('upload');
			$this->load->database();
	        $this->load->helper('form', 'url');
	        $this->load->model('m_dailyreportread');
	        $this->load->model('m_dailyreportcreate');
	        $this->load->model('m_dailyreportupdate');
	        $this->load->model('m_jomread');
	        $this->load->model('m_coaread');
	        $this->load->model('m_essread');
	        $this->load->model('m_inventoryread');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function add_machine_group($key_session){
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
					$this->form_validation->set_rules('machine_group_code', 'machine_group_code', 'required');
					$this->form_validation->set_rules('machine_group_name', 'machine_group_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$machine_group_id = $this->input->post('machine_group_id');
						$machine_group_code = $this->input->post('machine_group_code');
						$machine_group_name = $this->input->post('machine_group_name');

						$last_update = date('Y-m-d H:i:s');

						if ($machine_group_id=='') { // Create
							$data=array(
								'machine_group_code' => $machine_group_code,
								'machine_group_name' => $machine_group_name,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);
							$result = $this->m_dailyreportcreate->add_machine_group($data);
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
								'machine_group_code' => $machine_group_code,
								'machine_group_name' => $machine_group_name,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_dailyreportupdate->update_machine_group($data, $company_id_session, $machine_group_id);
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

		public function add_machine($key_session){
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
					$this->form_validation->set_rules('machine_code', 'machine_code', 'required');
					$this->form_validation->set_rules('machine_code_koutei', 'machine_code_koutei', 'required');
					$this->form_validation->set_rules('machine_name', 'machine_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$machine_id = $this->input->post('machine_id');
						$machine_code = $this->input->post('machine_code');
						$machine_code_koutei = $this->input->post('machine_code_koutei');
						$machine_name = $this->input->post('machine_name');

						$last_update = date('Y-m-d H:i:s');

						if ($machine_id=='') { // Create
							$data=array(
								'machine_code' => $machine_code,
								'machine_code_koutei' => $machine_code_koutei,
								'machine_name' => $machine_name,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);
							$result = $this->m_dailyreportcreate->add_machine($data);
							if ($result==true){
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
								'machine_code' => $machine_code,
								'machine_code_koutei' => $machine_code_koutei,
								'machine_name' => $machine_name,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_dailyreportupdate->update_machine($data, $company_id_session, $machine_id);
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

	}