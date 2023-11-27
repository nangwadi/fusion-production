<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class AldoCreate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('upload');
			$this->load->database();
	        $this->load->helper('form', 'url');
	        $this->load->model('m_aldoread');
	        $this->load->model('m_aldocreate');
	        $this->load->model('m_aldoupdate');
	        $this->load->model('m_essread');
	        //$this->load->model('m_aldopage');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function add_annual_leave($key_session){
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
					$this->form_validation->set_rules('year', 'year', 'required');
					$this->form_validation->set_rules('total', 'total', 'required');
					$this->form_validation->set_rules('cuti_bsm', 'cuti_bsm', 'required');
					$this->form_validation->set_rules('dTglBerlaku_Dari', 'dTglBerlaku_Dari', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_cuti_master = $this->input->post('id_cuti_master');
						$cNIK = $this->input->post('cNIK');
						$year = $this->input->post('year');
						$total = $this->input->post('total');
						$cuti_bsm = $this->input->post('cuti_bsm');
						$dTglBerlaku_Dari = $this->input->post('dTglBerlaku_Dari');

						$last_update = date('Y-m-d H:i:s');

						$result_annual_leave = $this->m_aldoread->list_annual_leave($company_id_session, $id_cuti_master, $year);

						if (count($result_annual_leave)==0) { // Add maker_approval
							$data=array(
								'company_id' => $company_id_session,
								'cNIK' => $cNIK,
								'total' => $total,
								'cuti_bsm' => $cuti_bsm,
								'year' => $year,
								'dTglBerlaku_Dari' => $dTglBerlaku_Dari,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_aldocreate->add_annual_leave($data);
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
								'total' => $total,
								'cuti_bsm' => $cuti_bsm,
								'dTglBerlaku_Dari' => $dTglBerlaku_Dari,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_aldoupdate->update_annual_leave($data, $company_id_session, $id_cuti_master);
							if ($result==true) {
								$status = 1;
								$responseValue = $id_cuti_master;
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

		public function add_department_approval($key_session){
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

					$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
					$this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
					$this->form_validation->set_rules('cIDJbtn', 'cIDJbtn', 'required');
					$this->form_validation->set_rules('approve1', 'approve1', 'required');
					$this->form_validation->set_rules('approve2', 'approve2', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_approve = $this->input->post('id_approve');
						$cIDDept = $this->input->post('cIDDept');
						$cIDBag = $this->input->post('cIDBag');
						$cIDJbtn = $this->input->post('cIDJbtn');
						$approve1 = $this->input->post('approve1');
						$approve2 = $this->input->post('approve2');

						$last_update = date('Y-m-d H:i:s');

						if ($id_approve=='') { // Add maker_approval
							$result_department = $this->m_aldoread->list_department_approval_by_department_division_potition($company_id, $cIDDept, $cIDBag, $cIDJbtn);
							if (count($result_department)==0) {
								$data=array(
									'company_id' => $company_id_session,
									'cIDDept' => $cIDDept,
									'cIDBag' => $cIDBag,
									'cIDJbtn' => $cIDJbtn,
									'approve1' => $approve1,
									'approve2' => $approve2,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_aldocreate->add_department_approval($data);
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
								$id_approve_get = $result_department[0]->id_approve;
								$data=array(
									'approve1' => $approve1,
									'approve2' => $approve2,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_aldoupdate->update_department_approval($data, $company_id_session, $id_approve_get);
								if ($result==true) {
									$status = 1;
									$responseValue = $id_approve;
								}
								else {
									$status = 0;
									$responseValue = 'Data not updated.';
								}
							}
						}
						else { // Update maker_approval
							$data=array(
								'approve1' => $approve1,
								'approve2' => $approve2,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_aldoupdate->update_department_approval($data, $company_id_session, $id_approve);
							if ($result==true) {
								$status = 1;
								$responseValue = $id_approve;
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

		public function add_ga_approval($key_session){
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

					$this->form_validation->set_rules('ga', 'ga', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_approve = $this->input->post('id_approve');
						$ga = $this->input->post('ga');
						$column = $this->input->post('column');

						$last_update = date('Y-m-d H:i:s');

						if ($id_approve=='') { // Add maker_approval
							$result_department = $this->m_aldoread->list_ga_approval($company_id, $id_approve);
							if (count($result_department)==0) {
								$data=array(
									'company_id' => $company_id_session,
									'ga1' => $ga,
									'ga2' => null,
									'ga3' => null,
									'ga4' => null,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_aldocreate->add_ga_approval($data);
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
								$id_approve_get = $result_department[0]->id_approve;
								$data=array(
									$column => $ga,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_aldoupdate->update_ga_approval($data, $company_id_session, $id_approve_get);
								if ($result==true) {
									$status = 1;
									$responseValue = $id_approve;
								}
								else {
									$status = 0;
									$responseValue = 'Data not updated.';
								}
							}
						}
						else { // Update maker_approval
							$data=array(
								$column => $ga,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_aldoupdate->update_ga_approval($data, $company_id_session, $id_approve);
							if ($result==true) {
								$status = 1;
								$responseValue = $id_approve;
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

		public function add_special_approval($key_session){
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
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$cNIK = $this->input->post('cNIK');

						$last_update = date('Y-m-d H:i:s');

						$result_department = $this->m_aldoread->list_special_approval($company_id, $cNIK);
						if (count($result_department)==0) {
							$data=array(
								'company_id' => $company_id_session,
								'cNIK' => $cNIK,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_aldocreate->add_special_approval($data);
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
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_approve_all($key_session){
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
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$cNIK = $this->input->post('cNIK');

						$last_update = date('Y-m-d H:i:s');

						$result_all = $this->m_aldoread->list_approve_all($company_id, $cNIK);
						if (count($result_all)==0) {
							$data=array(
								'company_id' => $company_id_session,
								'cNIK' => $cNIK,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_aldocreate->add_approve_all($data);
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
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_day_off($key_session){
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

					$this->form_validation->set_rules('cIDAbsen', 'cIDAbsen', 'required');
					$this->form_validation->set_rules('cuti_tahunan_min', 'cuti_tahunan_min', 'required');
					$this->form_validation->set_rules('max', 'max', 'required');
					$this->form_validation->set_rules('images', 'images', 'required');
					$this->form_validation->set_rules('annual_leave', 'annual_leave', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_cuti_day_off = $this->input->post('id_cuti_day_off');
						$cIDAbsen = $this->input->post('cIDAbsen');
						$cuti_khusus = $this->input->post('cuti_khusus');
						$cuti_tahunan_min = $this->input->post('cuti_tahunan_min');
						$max = $this->input->post('max');
						$images = $this->input->post('images');
						$annual_leave = $this->input->post('annual_leave');

						$last_update = date('Y-m-d H:i:s');

						if ($id_cuti_day_off=='') {
							$result_precense = $this->m_aldoread->list_day_off_by_precense_id($company_id, $cIDAbsen);
							if (count($result_precense)==0) {
								$data=array(
									'company_id' => $company_id_session,
									'cIDAbsen' => $cIDAbsen,
									'annual_leave' => ($annual_leave)*1,
									'cuti_khusus' => ($cuti_khusus)*1,
									'images' => ($images)*1,
									'cuti_tahunan_min' => ($cuti_tahunan_min)*1,
									'max' => ($max)*1,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_aldocreate->add_day_off($data);
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
									'cIDAbsen' => $cIDAbsen,
									'cuti_khusus' => ($cuti_khusus)*1,
									'annual_leave' => ($annual_leave)*1,
									'images' => ($images)*1,
									'cuti_tahunan_min' => ($cuti_tahunan_min)*1,
									'max' => ($max)*1,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_aldoupdate->update_day_off($data, $company_id_session, $id_cuti_day_off);
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
							$data=array(
								'cIDAbsen' => $cIDAbsen,
								'cuti_khusus' => ($cuti_khusus)*1,
								'annual_leave' => ($annual_leave)*1,
								'images' => ($images)*1,
								'cuti_tahunan_min' => ($cuti_tahunan_min)*1,
								'max' => ($max)*1,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_aldoupdate->update_day_off($data, $company_id_session, $id_cuti_day_off);
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
					echo json_encode(array(array('status' => $status, 'cuti_tahunan_min' => $cuti_tahunan_min, 'response' => $responseValue)));
				}
			}
		}

		// Input

		public function add_day_off_input($key_session, $cIDAbsen){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$company_id_session=$this->session->userdata('company_id_session');

			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');

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

					$this->form_validation->set_rules('date_start', 'date_start', 'required');
					$this->form_validation->set_rules('note', 'note', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();
						$cIDAbsen = $this->uri->segment('4');

						$date_start  = $this->input->post('date_start');
						$date_end  = $this->input->post('date_end');
						$total  = $this->input->post('total');
						$sub_type  = $this->input->post('sub_type');
						$note  = $this->input->post('note');
						
						$last_update = date('Y-m-d H:i:s');

						// Check Annual Leave

						$list_day_off_annual_leave = $this->m_aldoread->list_day_off_annual_leave($company_id_session);
						$cIDAbsen_annual_leave = $list_day_off_annual_leave[0]->cIDAbsen;

						if ($cIDAbsen==$cIDAbsen_annual_leave) {
							$list_annual_leave = $this->m_aldoread->list_annual_leave_by_employee($company_id_session, $cNIK_session, date_format(date_create($date_start), 'Y'));
							$total_annual_leave = ($list_annual_leave[0]->total)*1;

							$list_annual_leave_used = $this->m_aldoread->total_annual_leave_used($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'), $cIDAbsen_annual_leave);
							$total_annual_leave_used = ($list_annual_leave_used[0]->total)*1;
							$diff = $total_annual_leave - ($total_annual_leave_used+$total);

							if ($diff<=0) {
								$status = 0;
								$responseValue = 'Your annual leave is zero.';
								//break;
							}
							else {
								$dTglBerlaku_Dari = $list_annual_leave[0]->dTglBerlaku_Dari;
								if (date('Y-m-d')<=$dTglBerlaku_Dari) {	
									$status = 0;
									$responseValue = 'Your annual leave date less than annual leave active date.';
									//break;
								}
							}
						}

						// Check Images

						$result_day_off = $this->m_aldoread->list_day_off_by_precense_id($company_id_session, $cIDAbsen);
						$images = $result_day_off[0]->images;
						if ($images==0) {
							$img1  = '';
							$img2  = '';
							$img3  = '';
						}
						else {
							$input_img2  = $this->input->post('input_img2');
							$input_img3  = $this->input->post('input_img3');

							function generateRandomString($length = 16) {
							    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							    $charactersLength = strlen($characters);
							    $randomString = '';
							    for ($i = 0; $i < $length; $i++) {
							        $randomString .= $characters[rand(0, $charactersLength - 1)];
							    }
							    return $randomString;
							}

							$img1 = $this->input->post('img1');
						    $image_type = pathinfo($_FILES["img1"]["name"], PATHINFO_EXTENSION);
							$photo_name = generateRandomString();
							$new_photo_name = $cNIK_session.'_'.$cIDAbsen.'_'.$photo_name.'_1.'.$image_type;

							//$config['encrypt_name'] = true;
							$config['file_name'] = $new_photo_name;
							$config['allowed_types'] = "jpg|png|jpeg|JPEG|JPG|PNG";
							$config['max_size'] = "3048000";
							$config['overwrite'] = TRUE;
							$config['upload_path'] = "./assets/images/aldo/";

							$this->upload->initialize($config);
							$this->load->library('upload', $config);

							if(!$this->upload->do_upload('img1')){
								$error = array('msg' => $this->upload->display_errors());
								$status = 0;
								$responseValue = $error;
							}
							else {
								if ($input_img2!='') {
									$img2 = $this->input->post('img2');
								    $image_type2 = pathinfo($_FILES["img2"]["name"], PATHINFO_EXTENSION);
									//$photo_name2 = generateRandomString();
									$new_photo_name2 = $cNIK_session.'_'.$cIDAbsen.'_'.$photo_name.'_2.'.$image_type2;
									$config2['file_name'] = $new_photo_name2;
									$config2['allowed_types'] = "jpg|png|jpeg|JPEG|JPG|PNG";
									$config2['max_size'] = "3048000";
									$config2['overwrite'] = TRUE;
									$config2['upload_path'] = "./assets/images/aldo/";
									$this->upload->initialize($config2);
									$this->load->library('upload', $config2);
									if(!$this->upload->do_upload('img2')){
										$error = array('msg' => $this->upload->display_errors());
										$status = 0;
										$responseValue = $error;
									}
									else {
										if ($input_img3!='') {
											$img3 = $this->input->post('img3');
										    $image_type3 = pathinfo($_FILES["img3"]["name"], PATHINFO_EXTENSION);
											//$photo_name3 = generateRandomString();
											$new_photo_name3 = $cNIK_session.'_'.$cIDAbsen.'_'.$photo_name.'_3.'.$image_type3;
											$config3['file_name'] = $new_photo_name3;
											$config3['allowed_types'] = "jpg|png|jpeg|JPEG|JPG|PNG";
											$config3['max_size'] = "3048000";
											$config3['overwrite'] = TRUE;
											$config3['upload_path'] = "./assets/images/aldo/";
											$this->upload->initialize($config3);
											$this->load->library('upload', $config3);
											if(!$this->upload->do_upload('img3')){
												$error = array('msg' => $this->upload->display_errors());
												$status = 0;
												$responseValue = $error;
											}
											else {
												$img1 = $new_photo_name;
												$img2 = $new_photo_name2;
												$img3 = $new_photo_name3;
											}
										}
										else {
											$img1 = $new_photo_name;
											$img2 = $new_photo_name2;
											$img3 = '';
										}
									}
								}
								else {
									if ($input_img3!='') {
										$img3 = $this->input->post('img3');
									    $image_type3 = pathinfo($_FILES["img3"]["name"], PATHINFO_EXTENSION);
										$photo_name3 = generateRandomString();
										$new_photo_name3 = $cNIK_session.'_'.$cIDAbsen.'_'.$photo_name.'_3.'.$image_type3;
										$config3['file_name'] = $new_photo_name3;
										$config3['allowed_types'] = "jpg|png|jpeg|JPEG|JPG|PNG";
										$config3['max_size'] = "3048000";
										$config3['overwrite'] = TRUE;
										$config3['upload_path'] = "./assets/images/aldo/";
										$this->upload->initialize($config3);
										$this->load->library('upload', $config3);
										if(!$this->upload->do_upload('img3')){
											$error = array('msg' => $this->upload->display_errors());
											$status = 0;
											$responseValue = $error;
										}
										else {
											$img1 = $new_photo_name;
											$img2 = '';
											$img3 = $new_photo_name3;
										}
									}
									else {
										$img1 = $new_photo_name;
										$img2 = '';
										$img3 = '';
									}
								}
							}
						}

						$img4  = '';
						$img5  = '';

						// Check Approval

						$result_approval_all = $this->m_aldoread->list_approve_all_by_employee($company_id, $cNIK_session);
						if (count($result_approval_all)>=1) {
							$status_save = 1;
							
							$approve1 = 1;
							$approve2 = 1;
							$ga1 = 1;
							$ga2 = 1;
							$ga3 = 1;
							$ga4 = 1;

							$approve1_by = $cNIK_session;
							$approve2_by = $cNIK_session;
							$ga1_by = $cNIK_session;
							$ga2_by = $cNIK_session;
							$ga3_by = $cNIK_session;
							$ga4_by = $cNIK_session;
						}
						else {
							$result_approval = $this->m_aldoread->list_department_approval_by_department_division_potition($company_id_session, $cIDDept_session, $cIDBag_session, $cIDJbtn_session);
							if (count($result_approval)==0) {
								$status_save = 0;
								$responseValue = 'Approval not registered, please call to GA department.';
							}
							else {
								$status_save = 1;

								$approve1_by = $result_approval[0]->approve1;
								$approve2_by = $result_approval[0]->approve2;

								$result_approval_ga = $this->m_aldoread->list_ga_approval($company_id_session, $company_id_session);
								$ga1_by = $result_approval_ga[0]->ga1;
								$ga2_by = $result_approval_ga[0]->ga2;
								$ga3_by = $result_approval_ga[0]->ga3;
								$ga4_by = $result_approval_ga[0]->ga4;

								if ($approve1_by==$cNIK_session || $approve1_by == null) {
									$approve1 = 1;
									$approve1_by = $cNIK_session;
									$approve2 = 0;
									$cNIK_mail_to = $approve2_by;
								}
								else {
									if ($approve2_by==$cNIK_session || $approve2_by == null) {
										$approve1 = 1;
										$approve1_by = $cNIK_session;
										$approve2 = 1;
										$approve2_by = $cNIK_session;
										$cNIK_mail_to = $ga1_by;
 									}
									else {
										$approve1 = 0;
										$approve2 = 0;
										$cNIK_mail_to = $approve1_by;
									}
								}

								$result_email_employee = $this->m_essread->email_personal_data($company_id_session, $cNIK_mail_to);
								$email = $result_email_employee[0]->email;

								if ($ga1_by==$cNIK_session || $ga1_by == null) {
									$ga1 = 1;
									$ga2 = 0;
									$ga3 = 0;
									$ga4 = 0;
								}
								else {
									if ($ga2_by==$cNIK_session || $ga2_by == null) {
										$ga1 = 0;
										$ga2 = 1;
										$ga3 = 0;
										$ga4 = 0;
									}
									else {
										if ($ga3_by==$cNIK_session || $ga3_by == null) {
											$ga1 = 0;
											$ga2 = 0;
											$ga3 = 1;
											$ga4 = 0;
										}
										else {
											if ($ga3_by==$cNIK_session || $ga3_by == null) {
												$ga1 = 0;
												$ga2 = 0;
												$ga3 = 0;
												$ga4 = 1;
											}
											else {
												$ga1 = 0;
												$ga2 = 0;
												$ga3 = 0;
												$ga4 = 0;
											}
										}
									}
								}
							}
						}

						// Save To DB

						if ($status_save==0) {
							$status = 0;
							$responseValue = $responseValue;
						}
						else {
							if ($date_end=="") {
								$total_register = 1;
								$day_name = date_format(date_create($date_start), 'D');
								if ($day_name=="Sat" || $day_name=="Sun") {
									$result_change_day = $this->m_essread->list_change_day_by_date($company_id_session, $date_start, $cGroupID_session);
									if (count($result_change_day)==0) {
										$status = 0;
										$responseValue = 'Your date select is holiday.';
									}
									else {
										$data = array(
											'company_id' => $company_id_session,
											'year' => date_format(date_create($date_start), 'Y'),
											'cNIK' => $cNIK_session,
											'date_start' => $date_start,
											'date_end' => null,
											'total' => $total,
											'cIDAbsen' => $cIDAbsen,
											'sub_type' => $sub_type,
											'note' => $note,
											'img1' => $img1,
											'img2' => $img2,
											'img3' => $img3,
											'img4' => $img4,
											'img5' => $img5,
											'approve1' => $approve1,
											'date_approve1' => null,
											'approve1_by' => $approve1_by,
											'approve1_reject' => null,
											'approve2' => $approve2,
											'date_approve2' => null,
											'approve2_by' => $approve2_by,
											'approve2_reject' => null,
											'ga1' => $ga1,
											'date_ga1' => null,
											'ga1_by' => $ga1_by,
											'ga1_reject' => null,
											'ga2' => $ga2,
											'date_ga2' => null,
											'ga2_by' => $ga2_by,
											'ga2_reject' => null,
											'ga3' => $ga3,
											'date_ga3' => null,
											'ga3_by' => $ga3_by,
											'ga3_reject' => null,
											'ga4' => $ga4,
											'date_ga4' => null,
											'ga4_by' => $ga4_by,
											'ga4_reject' => null,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										//array_push ($data_array, $data);
										$result_add = $this->m_aldocreate->add_day_off_input($data);
										if ($result_add==true) {
											$total_register_act = 1;
											$status = 1;
											$responseValue = '';
										}
										else {
											$total_register_act = 0;
											$status = 0;
											$responseValue = 'Data not saved.';
										}
										array_push ($data_array, $status);
									}
								}
								else {
									$result_holiday = $this->m_essread->list_national_holiday_by_date($company_id_session, $date_start, $cGroupID_session);
									if (count($result_holiday)>=1) {
										$total_register_act = 0;
										$status = 0;
										$responseValue = 'Your date select is national holiday.';
									}
									else {
										$data = array(
											'company_id' => $company_id_session,
											'year' => date_format(date_create($date_start), 'Y'),
											'cNIK' => $cNIK_session,
											'date_start' => $date_start,
											'date_end' => null,
											'total' => $total,
											'cIDAbsen' => $cIDAbsen,
											'sub_type' => $sub_type,
											'note' => $note,
											'img1' => $img1,
											'img2' => $img2,
											'img3' => $img3,
											'img4' => $img4,
											'img5' => $img5,
											'approve1' => $approve1,
											'date_approve1' => null,
											'approve1_by' => $approve1_by,
											'approve1_reject' => null,
											'approve2' => $approve2,
											'date_approve2' => null,
											'approve2_by' => $approve2_by,
											'approve2_reject' => null,
											'ga1' => $ga1,
											'date_ga1' => null,
											'ga1_by' => $ga1_by,
											'ga1_reject' => null,
											'ga2' => $ga2,
											'date_ga2' => null,
											'ga2_by' => $ga2_by,
											'ga2_reject' => null,
											'ga3' => $ga3,
											'date_ga3' => null,
											'ga3_by' => $ga3_by,
											'ga3_reject' => null,
											'ga4' => $ga4,
											'date_ga4' => null,
											'ga4_by' => $ga4_by,
											'ga4_reject' => null,
											'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update,
										);
										//array_push ($data_array, $data);
										$result_add = $this->m_aldocreate->add_day_off_input($data);
										if ($result_add==true) {
											$total_register_act = 1;
											$status = 1;
											$responseValue = '';
										}
										else {
											$total_register_act = 0;
											$status = 0;
											$responseValue = 'Data not saved.';
										}
										array_push ($data_array, $status);
									}
								}
							}
							else {
								$date1=date_create($date_start);
								$date2=date_create($date_end);
								if ($date2<$date1) {
									$status = 0;
									$responseValue = "Date can't be reversed";
								}
								else {
									$diff = date_diff($date1, $date2);
									$diff_format = (($diff->format("%R%a"))*1)+1;
									$total_register = $diff_format;
									$total_register_act = 0;

									for ($i=0; $i < $diff_format; $i++) { 
										
										$date = $date_start;
										$date = strtotime($date);
										$date = strtotime("+".$i." day", $date);
										$date = date('Y-m-d', $date);

										$day_name = date_format(date_create($date), 'D');
										if ($day_name=="Sat" || $day_name=="Sun") {
											$result_change_day = $this->m_essread->list_change_day_by_date($company_id_session, $date_start, $cGroupID_session);
											if (count($result_change_day)>=1) {
												$data = array(
													'company_id' => $company_id_session,
													'year' => date_format(date_create($date), 'Y'),
													'cNIK' => $cNIK_session,
													'date_start' => $date,
													'date_end' => null,
													'total' => $total,
													'cIDAbsen' => $cIDAbsen,
													'sub_type' => $sub_type,
													'note' => $note,
													'img1' => $img1,
													'img2' => $img2,
													'img3' => $img3,
													'img4' => $img4,
													'img5' => $img5,
													'approve1' => $approve1,
													'date_approve1' => null,
													'approve1_by' => $approve1_by,
													'approve1_reject' => null,
													'approve2' => $approve2,
													'date_approve2' => null,
													'approve2_by' => $approve2_by,
													'approve2_reject' => null,
													'ga1' => $ga1,
													'date_ga1' => null,
													'ga1_by' => $ga1_by,
													'ga1_reject' => null,
													'ga2' => $ga2,
													'date_ga2' => null,
													'ga2_by' => $ga2_by,
													'ga2_reject' => null,
													'ga3' => $ga3,
													'date_ga3' => null,
													'ga3_by' => $ga3_by,
													'ga3_reject' => null,
													'ga4' => $ga4,
													'date_ga4' => null,
													'ga4_by' => $ga4_by,
													'ga4_reject' => null,
													'create_by' => $cNIK_session,
													'create_date' => $last_update,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												//array_push ($data_array, $data);
												$result_add = $this->m_aldocreate->add_day_off_input($data);
												if ($result_add==true) {
													$total_register_act += 1;
													$status = 1;
													$responseValue = '';
												}
												else {
													$total_register_act += 0;
													$status = 0;
													$responseValue = 'Data not saved.';
												}
												array_push ($data_array, $status);
											}
											else {
												$total_register_act += 1;
												$status = 1;
											}
										}
										else {
											$result_holiday = $this->m_essread->list_national_holiday_by_date($company_id_session, $date_start, $cGroupID_session);
											if (count($result_holiday)==0) {
												$data = array(
													'company_id' => $company_id_session,
													'year' => date_format(date_create($date), 'Y'),
													'cNIK' => $cNIK_session,
													'date_start' => $date,
													'date_end' => null,
													'total' => $total,
													'cIDAbsen' => $cIDAbsen,
													'sub_type' => $sub_type,
													'note' => $note,
													'img1' => $img1,
													'img2' => $img2,
													'img3' => $img3,
													'img4' => $img4,
													'img5' => $img5,
													'approve1' => $approve1,
													'date_approve1' => null,
													'approve1_by' => $approve1_by,
													'approve1_reject' => null,
													'approve2' => $approve2,
													'date_approve2' => null,
													'approve2_by' => $approve2_by,
													'approve2_reject' => null,
													'ga1' => $ga1,
													'date_ga1' => null,
													'ga1_by' => $ga1_by,
													'ga1_reject' => null,
													'ga2' => $ga2,
													'date_ga2' => null,
													'ga2_by' => $ga2_by,
													'ga2_reject' => null,
													'ga3' => $ga3,
													'date_ga3' => null,
													'ga3_by' => $ga3_by,
													'ga3_reject' => null,
													'ga4' => $ga4,
													'date_ga4' => null,
													'ga4_by' => $ga4_by,
													'ga4_reject' => null,
													'create_by' => $cNIK_session,
													'create_date' => $last_update,
													'last_by' => $cNIK_session,
													'last_update' => $last_update,
												);
												//array_push ($data_array, $data);
												$result_add = $this->m_aldocreate->add_day_off_input($data);
												if ($result_add==true) {
													$total_register_act += 1;
													$status = 1;
													$responseValue = '';
												}
												else {
													$total_register_act += 0;
													$status = 0;
													$responseValue = 'Data not saved.';
												}
												array_push ($data_array, $status);
											}
											else {
												$total_register_act += 1;
												$status = 1;
											}
										}
									}
								}
							}
						}

						// Send Email

						if (($total_register/$total_register_act)==1) {

					        $data_email['cNmPegawai'] = $cNmPegawai_session;
					        
					        if ($total_register_act==1) {
					        	$data_email['dTglHdr_format'] = date_format(date_create($date_start), 'd M Y');
					        }
					        else {
					        	$data_email['dTglHdr_format'] = date_format(date_create($date_start), 'd M Y').' - '.date_format(date_create($date_end), 'd M Y');
					        }

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

					        $result_precense = $this->m_essread->list_precense_type($company_id_session, $cIDAbsen);
					        $cNmAbsen = $result_precense[0]->cNmAbsen;
					        $data_email['cNmAbsen'] = $cNmAbsen;

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
					            //echo 'Your Email has successfully been sent.';
					            $status_last = 1;
					            $responseValue = '';
					        } else {
					            //show_error($this->email->print_debugger());
					            $status_last = 0;
					            $responseValue = 'Data has saved, but email not send to approval.';
					        }
						}
						else {
							$status_last = 0;
							$responseValue = 'Data not saved.';
						}
					}
					echo json_encode(array(array('status' => $status_last, 'total_register' => $total_register_act, 'response' => $responseValue)));
				}
			}
		}

	}
