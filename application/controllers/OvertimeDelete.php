<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class OvertimeDelete extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_overtimeread');
	        $this->load->model('m_overtimecreate');
	        $this->load->model('m_overtimeupdate');
	        $this->load->model('m_overtimedelete');
	        //$this->load->model('m_overtimepage');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function delete_maker_approval($key_session){
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
					$this->form_validation->set_rules('id_ot_maker', 'id_ot_maker', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_ot_maker = $this->input->post('id_ot_maker');
						$last_update = date('Y-m-d H:i:s');
						$result = $this->m_overtimedelete->delete_maker_approval($company_id_session, $id_ot_maker);
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

		public function delete_maker_approval($key_session){
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
					$this->form_validation->set_rules('id_ot_maker', 'id_ot_maker', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_ot_maker = $this->input->post('id_ot_maker');
						$last_update = date('Y-m-d H:i:s');
						$result = $this->m_overtimedelete->delete_maker_approval($company_id_session, $id_ot_maker);
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
