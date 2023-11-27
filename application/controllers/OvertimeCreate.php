<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class OvertimeCreate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('upload');
			$this->load->database();
	        $this->load->helper('form', 'url');
	        $this->load->model('m_overtimeread');
	        $this->load->model('m_overtimecreate');
	        $this->load->model('m_overtimeupdate');
	        $this->load->model('m_essread');
	        //$this->load->model('m_overtimepage');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function add_maker_approval($key_session){
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
					$category = $this->input->post('category');

					if ($category==1) {
						$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
						$this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
						$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
					}
					else if ($category==2) {
						//$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
						$this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
						$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
					}
					else if ($category==3) {
						//$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
						//$this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
						$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
					}
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_ot_maker = $this->input->post('id_ot_maker');
						$cIDDept = $this->input->post('cIDDept');
						$cIDBag = $this->input->post('cIDBag');
						$cNIK = $this->input->post('cNIK');

						$last_update = date('Y-m-d H:i:s');

						if ($id_ot_maker=='') { // Add maker_approval
							$data=array(
								'company_id' => $company_id_session,
								'category' => $category,
								'cIDDept' => $cIDDept,
								'cIDBag' => $cIDBag,
								'cNIK' => $cNIK,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_overtimecreate->add_maker_approval($data);
							if ($result==true) {
								$status = 1;
								$responseValue = 'ok';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
						else { // Update maker_approval
							$data=array(
								'cIDDept' => $cIDDept,
								'cIDBag' => $cIDBag,
								'cNIK' => $cNIK,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_overtimeupdate->update_maker_approval($data, $company_id_session, $id_ot_maker);
							if ($result==true) {
								$status = 1;
								$responseValue = $company_id_session.' '.$cIDDept.' '.count($ceck);
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

		public function add_daily_overtime($key_session){
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
					$category = $this->input->post('category');

					$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
					$this->form_validation->set_rules('overtime', 'overtime', 'required');
					$this->form_validation->set_rules('catering', 'catering', 'required');

					$data_array = array();
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						//$id_ot_maker = $this->input->post('id_ot_maker');
						$cNIK_post = $this->input->post('cNIK');
						$overtime_post = $this->input->post('overtime');
						$catering_post = $this->input->post('catering');
						$job_post = $this->input->post('job');

						$category_post = $this->input->post('category');
						$total_overtime = $this->input->post('total_overtime');

						if ($category_post==1) {
							$approve = 0;
						}
						else if ($category_post==2) {
							$approve = 1;
						}
						else if ($category_post==3) {
							$approve = 1;
						}

						$last_update = date('Y-m-d H:i:s');

						if (($total_overtime)*1==1) {

							$cNIK = $cNIK_post;
							$overtime = $overtime_post;
							$catering = $catering_post;
							$job = $job_post;

							$result_employee = $this->m_essread->list_employee($company_id_session, 1, $cNIK);
							$cIDDept_get = $result_employee[0]->cIDDept;
							$cIDBag_get = $result_employee[0]->cIDBag;

							$data = array(
								'company_id' => $company_id_session,
								'kategori' => 1,
								'dTglHdr' => date('Y-m-d'),
								'cNIK' => $cNIK,
								'cIDDept' => $cIDDept_get,
								'cIDBag' => $cIDBag_get,
								'cShiftID' => '',
								'job' => $job,
								'approve' => $approve,
								'catering' => $catering*1,
								'plan_start' => '00:00',
								'plan_end' => '00:00',
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_overtimecreate->add_daily_overtime($data);
							if ($result==true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
							array_push($data_array, $status);
						}
						else {
							$cNIK_exp = explode(',', $cNIK_post);
							$overtime_exp = explode(',', $overtime_post);
							$catering_exp = explode(',', $catering_post);
							$job_exp = explode(',', $job_post);

							for ($i=0; $i < count($cNIK_exp); $i++) { 
								$cNIK = $cNIK_exp[$i];
								$overtime = $overtime_exp[$i];
								$catering = $catering_exp[$i];
								$job = $job_exp[$i];

								$result_employee = $this->m_essread->list_employee($company_id_session, 1, $cNIK);
								$cIDDept_get = $result_employee[0]->cIDDept;
								$cIDBag_get = $result_employee[0]->cIDBag;

								$data = array(
									'company_id' => $company_id_session,
									'kategori' => 1,
									'dTglHdr' => date('Y-m-d'),
									'cNIK' => $cNIK,
									'cIDDept' => $cIDDept_get,
									'cIDBag' => $cIDBag_get,
									'cShiftID' => '',
									'job' => $job,
									'approve' => $approve,
									'catering' => $catering*1,
									'plan_start' => '00:00',
									'plan_end' => '00:00',
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_overtimecreate->add_daily_overtime($data);
								if ($result==true) {
									$status = 1;
									$responseValue = '';
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
								array_push($data_array, $status);
							}
						}
					}
					echo json_encode(array(array('status' => array_unique($data_array))));
				}
			}
		}

		public function add_holiday_overtime($key_session){
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
					$category = $this->input->post('category');

					$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
					$this->form_validation->set_rules('job', 'job', 'required');
					$this->form_validation->set_rules('dTglHdr', 'dTglHdr', 'required');
					$this->form_validation->set_rules('date_start', 'date_start', 'required');
					$this->form_validation->set_rules('date_end', 'date_end', 'required');

					$data_array = array();
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$cNIK_post = $this->input->post('cNIK');
						$job_post = $this->input->post('job');
						$dTglHdr_post = $this->input->post('dTglHdr');
						$date_start_post = $this->input->post('date_start');
						$date_end_post = $this->input->post('date_end');

						$category_post = $this->input->post('category');
						$total_overtime = $this->input->post('total_overtime');

						if ($category_post==1) {
							$approve = 0;
						}
						else if ($category_post==2) {
							$approve = 1;
						}
						else if ($category_post==3) {
							$approve = 1;
						}

						$last_update = date('Y-m-d H:i:s');

						if (($total_overtime)*1==1) {

							$cNIK = $cNIK_post;
							$job = $job_post;

							$result_employee = $this->m_essread->list_employee($company_id_session, 1, $cNIK);
							$cIDDept_get = $result_employee[0]->cIDDept;
							$cIDBag_get = $result_employee[0]->cIDBag;

							$check_overtime = $this->m_overtimeread->list_overtime_by_employee_date($company_id_session, 2, $dTglHdr_post, $cNIK);
							if (count($check_overtime)==0) {
								$data = array(
									'company_id' => $company_id_session,
									'kategori' => 2,
									'dTglHdr' => $dTglHdr_post,
									'cNIK' => $cNIK,
									'cIDDept' => $cIDDept_get,
									'cIDBag' => $cIDBag_get,
									'cShiftID' => '',
									'job' => $job,
									'approve' => $approve,
									'catering' => 1,
									'plan_start' => $date_start_post,
									'plan_end' => $date_end_post,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								//array_push($data_array, $data);
								$result = $this->m_overtimecreate->add_daily_overtime($data);
								if ($result==true) {
									$status = 1;
									$responseValue = '';
								}
								else {
									$status = 0;
									$responseValue = 'Data not saved.';
								}
								array_push($data_array, $status);
							}
							else {
								$status = 0;
								$responseValue = 'Employee already registered.';
							}
						}
						else {
							$cNIK_exp = explode(',', $cNIK_post);
							$overtime_exp = explode(',', $overtime_post);
							$catering_exp = explode(',', $catering_post);
							$job_exp = explode(',', $job_post);
							$date_start_exp = explode(',', $date_start_post);
							$date_end_exp = explode(',', $date_end_post);

							for ($i=0; $i < count($cNIK_exp); $i++) { 
								$cNIK = $cNIK_exp[$i];
								$overtime = $overtime_exp[$i];
								$catering = $catering_exp[$i];
								$job = $job_exp[$i];
								$date_start = $date_start_exp[$i];
								$date_end = $date_end_exp[$i];

								$result_employee = $this->m_essread->list_employee($company_id_session, 1, $cNIK);
								$cIDDept_get = $result_employee[0]->cIDDept;
								$cIDBag_get = $result_employee[0]->cIDBag;

								$check_overtime = $this->m_overtimeread->list_overtime_by_employee_date($company_id_session, 2, $dTglHdr_post, $cNIK);
								if (count($check_overtime)==0) {
									$data = array(
										'company_id' => $company_id_session,
										'kategori' => 2,
										'dTglHdr' => $dTglHdr_post,
										'cNIK' => $cNIK,
										'cIDDept' => $cIDDept_get,
										'cIDBag' => $cIDBag_get,
										'cShiftID' => '',
										'job' => $job,
										'approve' => $approve,
										'catering' => 1,
										'plan_start' => $date_start,
										'plan_end' => $date_end,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									$result = $this->m_overtimecreate->add_daily_overtime($data);
									if ($result==true) {
										$status = 1;
										$responseValue = '';
									}
									else {
										$status = 0;
										$responseValue = 'Data not saved.';
									}
									array_push($data_array, $status);
								}
							}
						}
					}
					echo json_encode(array(array('status' => array_unique($data_array), 'response' => $responseValue)));
					// echo json_encode(array(array('status' => $data_array)));
				}
			}
		}

		public function add_catering_overtime($key_session){
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
					$category = $this->input->post('category');

					$this->form_validation->set_rules('plant_1', 'plant_1', 'required');
					$this->form_validation->set_rules('plant_2', 'plant_2', 'required');
					$this->form_validation->set_rules('driver', 'driver', 'required');

					$data_array = array();
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						//$id_ot_maker = $this->input->post('id_ot_maker');
						$plant_1 = $this->input->post('plant_1');
						$plant_2 = $this->input->post('plant_2');
						$driver = $this->input->post('driver');
						$total = $plant_1+$plant_2+$driver;

						$last_update = date('Y-m-d H:i:s');

						$result_catering_overtime = $this->m_overtimeread->check_catering_overtime();
						if (count($result_catering_overtime)==0) {
							$data = array(
								'company_id' => $company_id_session,
								'dTglHdr' => date('Y-m-d'),
								'plant_1' => $plant_1,
								'plant_2' => $plant_2,
								'driver' => $driver,
								'total' => $total,
								'ket' => 2,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_overtimecreate->add_catering_overtime($data);
							if ($result==true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
							array_push($data_array, $status);
						}
						else {
							$data = array(
								'plant_1' => $plant_1,
								'plant_2' => $plant_2,
								'driver' => $driver,
								'total' => $total,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_overtimeupdate->update_catering_overtime($data, $company_id_session);
							if ($result==true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
							array_push($data_array, $status);
						}						
					}
					echo json_encode(array(array('status' => array_unique($data_array), 'response' => $responseValue)));
				}
			}
		}

	}
