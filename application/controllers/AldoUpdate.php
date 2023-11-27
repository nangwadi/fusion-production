<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class aldoUpdate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_aldoread');
	        $this->load->model('m_aldocreate');
	        $this->load->model('m_aldoupdate');
	        $this->load->model('m_templatepage');
	        $this->load->model('m_essread');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting


		// Input

		public function update_day_off_input($key_session){
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
					$this->form_validation->set_rules('id_cuti', 'id_cuti', 'required');
					$this->form_validation->set_rules('approve', 'approve', 'required');
					$this->form_validation->set_rules('column', 'column', 'required');
					$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
					$this->form_validation->set_rules('Pwd', 'Pwd', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_cuti = $this->input->post('id_cuti');
						$cNIK = $this->input->post('cNIK');
						$approve = $this->input->post('approve');
						$reject = $this->input->post('reject');
						$column = $this->input->post('column');
						$Pwd = $this->input->post('Pwd');
						$total_approve = $this->input->post('total_approve');
						$last_update = date('Y-m-d H:i:s');

						$check_login = $this->m_templatepage->act_login($cNIK_session, $Pwd);
						if (count($check_login)==0) {
							$status = 0;
							$responseValue = 'Password is Wrong, please try again.';
						}
						else {
							if ($total_approve==1) {
								$result_employee = $this->m_essread->list_employee($company_id_session, '1', $cNIK);
								$cIDDept_get = $result_employee[0]->cIDDept;
								$cIDBag_get = $result_employee[0]->cIDBag;
								$cIDJbtn_get = $result_employee[0]->cIDJbtn;

								$data=array(
									$column => $approve,
									'date_'.$column => $last_update,
									$column.'_reject' => $reject,
									$column.'_by' => $cNIK_session,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_aldoupdate->update_day_off_input($data, $company_id_session, $id_cuti);
								if ($result==true) {
									$result_day_off_input = $this->m_aldoread->list_day_off_input($company_id_session, '', '', '', $id_cuti);

									if ($column=='approve1') {
										$result_approval = $this->m_aldoread->list_department_approval_by_department_division_potition($company_id_session, $cIDDept_get, $cIDBag_get, $cIDJbtn_get);
										$approve2_by = $result_approval[0]->approve2;
										$email_approval = $result_approval[0]->email_approve_2;

										$data_email['cNmPegawai'] = $result_day_off_input[0]->cNmPegawai;
								        $data_email['dTglHdr_format'] = date_format(date_create($result_day_off_input[0]->date_start), 'd M Y');
								        $sub_type = $result_day_off_input[0]->sub_type;
								        $note = $result_day_off_input[0]->note;
								        $data_email['cNmAbsen'] = $result_day_off_input[0]->cNmAbsen;

								        if ($sub_type == 'SHP') {
								        	$data_email['time'] = 'Half Day - Morning';
								        }
								        else if ($sub_type == 'SHS') {
								        	$data_email['time'] = 'Half Day - Afternoon';
								        }
								        else {
								        	$data_email['time'] = 'Full Day';
								        }

								        $data_email['note'] = $note;


								        $this->load->config('email');
								        $this->load->library('email');
								        
								        $from = $this->config->item('smtp_user');
								        $to = 'tarwadi@meiwa-m.co.id';
								        $subject = 'Email Notification from AA Aldo';

								        $this->email->set_newline("\r\n");
								        $this->email->from($from);
								        $this->email->to($to);
								        $this->email->subject($subject);
								        $this->email->message($this->load->view('aldo/email/email-template', $data_email, true));

								        if ($this->email->send()) {
								            $status = 1;
								            $responseValue = '';
								        } else {
								            $status = 0;
								            $responseValue = 'Approve has successfully, but email not send to next approval.';
								        }
									}
									else if ($column=='approve2'){
										$result_approval = $this->m_aldoread->list_ga_approval($company_id_session, 0);
										$ga1 = $result_approval[0]->ga1;
										$ga2 = $result_approval[0]->ga2;
										$ga3 = $result_approval[0]->ga3;
										$ga4 = $result_approval[0]->ga4;
										if ($ga1!='') {
											$email_approval = $result_approval[0]->email_ga1;
										}
										else {
											if ($ga2!='') {
												$email_approval = $result_approval[0]->email_ga2;
												$ga1_approve = 1;
											}
											else {
												if ($ga3!='') {
													$email_approval = $result_approval[0]->email_ga3;
													$ga1_approve = 1;
													$ga2_approve = 1;
												}
												else {
													if ($ga4!='') {
														$email_approval = $result_approval[0]->email_ga4;
														$ga1_approve = 1;
														$ga2_approve = 1;
														$ga3_approve = 1;
													}
												}
											}
										}

										$data_email['cNmPegawai'] = $result_day_off_input[0]->cNmPegawai;
								        $data_email['dTglHdr_format'] = date_format(date_create($result_day_off_input[0]->date_start), 'd M Y');
								        $sub_type = $result_day_off_input[0]->sub_type;
								        $note = $result_day_off_input[0]->note;
								        $data_email['cNmAbsen'] = $result_day_off_input[0]->cNmAbsen;

								        if ($sub_type == 'SHP') {
								        	$data_email['time'] = 'Half Day - Morning';
								        }
								        else if ($sub_type == 'SHS') {
								        	$data_email['time'] = 'Half Day - Afternoon';
								        }
								        else {
								        	$data_email['time'] = 'Full Day';
								        }

								        $data_email['note'] = $note;


								        $this->load->config('email');
								        $this->load->library('email');
								        
								        $from = $this->config->item('smtp_user');
								        $to = 'tarwadi@meiwa-m.co.id';
								        $subject = 'Email Notification from AA Aldo';

								        $this->email->set_newline("\r\n");
								        $this->email->from($from);
								        $this->email->to($to);
								        $this->email->subject($subject);
								        $this->email->message($this->load->view('aldo/email/email-template', $data_email, true));

								        if ($this->email->send()) {
								            $status = 1;
								            $responseValue = '';
								        } else {
								            $status = 0;
								            $responseValue = 'Approve has successfully, but email not send to next approval.';
								        }
									}
									else {
										$status = 1;
										$responseValue = '';
									}

								}
								else {
									$status = 0;
									$responseValue = 'Data not updated.';
								}
								array_push($data_array, $status);
							}
							else {

							}
						}
					}
					echo json_encode(array(array('status' => array_unique($data_array), 'response' => $responseValue, 'data_array' => $data_array)));
				}
			}
		} 

		public function update_day_off_special_approve($key_session){
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
					$this->form_validation->set_rules('id_cuti', 'id_cuti', 'required');
					$this->form_validation->set_rules('approve', 'approve', 'required');
					$this->form_validation->set_rules('column', 'column', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_cuti = $this->input->post('id_cuti');
						$approve = $this->input->post('approve');
						$column = $this->input->post('column');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							$column => $approve,
							'date_'.$column => $last_update,
							$column.'_by' => $cNIK_session,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_aldoupdate->update_day_off_input($data, $company_id_session, $id_cuti);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode (array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		
	}
