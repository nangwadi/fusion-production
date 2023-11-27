<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class DailyReportUpdate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_dailyreportread');
	        $this->load->model('m_dailyreportcreate');
	        $this->load->model('m_dailyreportupdate');
	        $this->load->model('m_essread');
	        $this->load->model('m_inventoryread');
	        $this->load->model('m_inventorycreate');
	        $this->load->model('m_inventoryupdate');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function update_machine_group($key_session){
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
					$this->form_validation->set_rules('machine_group_id', 'machine_group_id', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$machine_group_id = $this->input->post('machine_group_id');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
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
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}


	}
