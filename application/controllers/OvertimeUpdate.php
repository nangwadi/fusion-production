<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class OvertimeUpdate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_overtimeread');
	        $this->load->model('m_overtimecreate');
	        $this->load->model('m_overtimeupdate');
	        //$this->load->model('m_ess');
	        //$this->load->model('m_esspage');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function update_time_deadline($key_session){
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
					$this->form_validation->set_rules('daily_maker', 'daily_maker', 'required');
					$this->form_validation->set_rules('daily_approval', 'daily_approval', 'required');
					$this->form_validation->set_rules('holiday_maker', 'holiday_maker', 'required');
					$this->form_validation->set_rules('holiday_approval', 'holiday_approval', 'required');
					$this->form_validation->set_rules('id_ot_timeline', 'id_ot_timeline', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$daily_maker = $this->input->post('daily_maker');
						$daily_approval = $this->input->post('daily_approval');
						$holiday_maker = $this->input->post('holiday_maker');
						$holiday_approval = $this->input->post('holiday_approval');
						$id_ot_timeline = $this->input->post('id_ot_timeline');

						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'daily_maker' => $daily_maker,
							'daily_approval' => $daily_approval,
							'holiday_maker' => $holiday_maker,
							'holiday_approval' => $holiday_approval,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_overtimeupdate->update_time_deadline($data, $company_id_session, $id_ot_timeline);
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

		public function update_catering_daily_overtime($key_session){
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
					$this->form_validation->set_rules('id_lembur', 'id_lembur', 'required');
					$this->form_validation->set_rules('catering', 'catering', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_lembur = $this->input->post('id_lembur');
						$catering = $this->input->post('catering');

						if ($catering==1) {
							$catering_post = 0;
						}
						else {
							$catering_post = 1;
						}

						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'catering' => $catering_post,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_overtimeupdate->update_catering_daily_overtime($data, $company_id_session, $id_lembur);
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

		public function update_approve_overtime($key_session){
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
					$this->form_validation->set_rules('id_lembur', 'id_lembur', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_lembur_post = $this->input->post('id_lembur');
						$approve_post = $this->input->post('approve');
						$total_line_approve_post = $this->input->post('total_line_approve');

						$last_update = date('Y-m-d H:i:s');

						$id_lembur_exp = explode(',', $id_lembur_post);

						$data_array = array();

						if ($total_line_approve_post==1) {
							$data=array(
								'approve' => $approve_post,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_overtimeupdate->update_catering_daily_overtime($data, $company_id_session, $id_lembur_post);
							if ($result==true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
							array_push ($data_array, $status);
						}
						else {
							for ($i=0; $i < count($id_lembur_exp); $i++) { 
								$id_lembur = $id_lembur_exp[$i];

								$data=array(
									'approve' => 1,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_overtimeupdate->update_catering_daily_overtime($data, $company_id_session, $id_lembur);
								if ($result==true) {
									$status = 1;
									$responseValue = '';
								}
								else {
									$status = 0;
									$responseValue = 'Data not updated.';
								}
								array_push ($data_array, $status);
							}
						}

						
					}
					echo json_encode(array(array('status' => array_unique($data_array), 'response' => $responseValue)));
				}
			}
		}

		
	}
