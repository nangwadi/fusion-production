<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class CoaCreate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('upload');
			$this->load->database();
	        $this->load->helper('form', 'url');
	        $this->load->model('m_coaread');
	        $this->load->model('m_coacreate');
	        $this->load->model('m_coaupdate');
	        $this->load->model('m_essread');
	        //$this->load->model('m_coapage');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function add_coa_type($key_session){
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

					//$this->form_validation->set_rules('id_coa_type', 'id_coa_type', 'required');
					$this->form_validation->set_rules('coa_type_cd', 'coa_type_cd', 'required');
					$this->form_validation->set_rules('coa_type_name', 'coa_type_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa_type = $this->input->post('id_coa_type');
						$coa_type_cd = $this->input->post('coa_type_cd');
						$coa_type_name = $this->input->post('coa_type_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_coa_type=='') {
							$result_coa_type = $this->m_coaread->list_coa_type($company_id_session, $id_coa_type);
							if (count($result_coa_type)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'coa_type_cd' => $coa_type_cd,
									'coa_type_name' => $coa_type_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_coacreate->add_coa_type($data);
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
								'coa_type_cd' => $coa_type_cd,
								'coa_type_name' => $coa_type_name,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_coa_classes($key_session){
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

					//$this->form_validation->set_rules('id_coa_classes', 'id_coa_classes', 'required');
					$this->form_validation->set_rules('id_coa_type', 'id_coa_type', 'required');
					$this->form_validation->set_rules('coa_classes_cd', 'coa_classes_cd', 'required');
					$this->form_validation->set_rules('coa_classes_name', 'coa_classes_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa_classes = $this->input->post('id_coa_classes');
						$id_coa_type = $this->input->post('id_coa_type');
						$coa_classes_cd = $this->input->post('coa_classes_cd');
						$coa_classes_name = $this->input->post('coa_classes_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_coa_classes=='') {
							$result_coa_classes = $this->m_coaread->list_coa_classes($company_id_session, $id_coa_classes);
							if (count($result_coa_classes)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'id_coa_type' => $id_coa_type,
									'coa_classes_cd' => $coa_classes_cd,
									'coa_classes_name' => $coa_classes_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_coacreate->add_coa_classes($data);
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
								'id_coa_type' => $id_coa_type,
								'coa_classes_cd' => $coa_classes_cd,
								'coa_classes_name' => $coa_classes_name,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}	

		public function add_coa_currency($key_session){
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

					$this->form_validation->set_rules('decimal_after', 'decimal_after', 'required');
					$this->form_validation->set_rules('coa_currency_cd', 'coa_currency_cd', 'required');
					$this->form_validation->set_rules('coa_currency_name', 'coa_currency_name', 'required');
					$this->form_validation->set_rules('set_default', 'set_default', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa_currency = $this->input->post('id_coa_currency');
						$coa_currency_cd = $this->input->post('coa_currency_cd');
						$coa_currency_name = $this->input->post('coa_currency_name');
						$decimal_after = $this->input->post('decimal_after');
						$set_default = $this->input->post('set_default');

						$last_update = date('Y-m-d H:i:s');

						if ($id_coa_currency=='') {
							$result_coa_currency = $this->m_coaread->list_coa_currency($company_id_session, $id_coa_currency);
							if (count($result_coa_currency)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'coa_currency_cd' => $coa_currency_cd,
									'coa_currency_name' => $coa_currency_name,
									'decimal_after' => $decimal_after,
									'set_default' => $set_default,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_coacreate->add_coa_currency($data);
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
								'coa_currency_cd' => $coa_currency_cd,
								'coa_currency_name' => $coa_currency_name,
								'decimal_after' => $decimal_after,
									'set_default' => $set_default,
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}	

		// Input

		public function add_chart_of_account($key_session){
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
					$this->form_validation->set_rules('coa_cd', 'coa_cd', 'required');
					$this->form_validation->set_rules('coa_name', 'coa_name', 'required');
					$this->form_validation->set_rules('id_coa_classes', 'id_coa_classes', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa = $this->input->post('id_coa');
						$coa_cd = $this->input->post('coa_cd');
						$coa_name = $this->input->post('coa_name');
						$id_coa_classes = $this->input->post('id_coa_classes');
						$id_coa_currency = $this->input->post('id_coa_currency');

						$last_update = date('Y-m-d H:i:s');

						if ($id_coa=='') {
							$result_coa = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $coa_cd);
							if (count($result_coa)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'id_coa_classes' => $id_coa_classes,
									'id_coa_currency' => $id_coa_currency,
									'coa_cd' => $coa_cd,
									'coa_name' => $coa_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_coacreate->add_chart_of_account($data);
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
								'id_coa_classes' => $id_coa_classes,
								'id_coa_currency' => $id_coa_currency,
								'coa_cd' => $coa_cd,
								'coa_name' => $coa_name,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_coaupdate->update_chart_of_account($data, $company_id_session, $id_coa);
							if ($result==true) {
								$result = $this->m_coaread->list_chart_of_account($company_id_session, $id_coa);
								$data_array = array();
								if (count($result)==0) {
									$status = 0;
								}
								else {
									$status = 1;
									foreach ($result as $resultList){
										$coa_currency_cd = $resultList->coa_currency_cd;
										if ($coa_currency_cd==null) {
											$id_coa_currency = 0;
											$coa_currency_cd = 0;
											$coa_currency_name = 0;

											$coa_currency_cd_desc = '';
										}
										else {
											$id_coa_currency = $resultList->id_coa_currency;
											$coa_currency_cd = $resultList->coa_currency_cd;
											$coa_currency_name = $resultList->coa_currency_name;
											$coa_currency_cd_desc = $coa_currency_cd;
										}
										$data = array(
											'id_coa' => $resultList->id_coa,
											'company_id' => $resultList->company_id,
											'company_name' => $resultList->company_name,
											'id_coa_classes' => $resultList->id_coa_classes,
											'coa_classes_cd' => $resultList->coa_classes_cd,
											'coa_classes_name' => $resultList->coa_classes_name,
											'id_coa_type' => $resultList->id_coa_type,
											'coa_type_cd' => $resultList->coa_type_cd,
											'coa_type_name' => $resultList->coa_type_name,
											'id_coa_currency' => $id_coa_currency,
											'coa_currency_cd' => $coa_currency_cd,
											'coa_currency_cd_desc' => $coa_currency_cd_desc,
											'coa_currency_name' => $coa_currency_name,
											'coa_cd' => $resultList->coa_cd,
											'coa_name' => $resultList->coa_name,
											'create_by' => $resultList->create_by,
											'cNmPegawai_create' => $resultList->cNmPegawai_create,
											'create_date' => $resultList->create_date,
											'last_by' => $resultList->last_by,
											'cNmPegawai_last' => $resultList->cNmPegawai_last,
											'last_update' => $resultList->last_update,
											'deleted' => $resultList->deleted,
										);
										array_push($data_array, $data);
									}					
								}
								$status = 1;
								$responseValue = $data_array;
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

		public function add_sub_chart_of_account($key_session){
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
					$this->form_validation->set_rules('coa_sub_cd', 'coa_sub_cd', 'required');
					$this->form_validation->set_rules('coa_sub_name', 'coa_sub_name', 'required');
					$this->form_validation->set_rules('id_coa', 'id_coa', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa_sub = $this->input->post('id_coa_sub');
						$coa_sub_cd = $this->input->post('coa_sub_cd');
						$coa_sub_name = $this->input->post('coa_sub_name');
						$id_coa = $this->input->post('id_coa');

						$last_update = date('Y-m-d H:i:s');

						if ($id_coa_sub=='') {
							$result_coa = $this->m_coaread->list_sub_chart_of_account_by_cd($company_id_session, $coa_cd);
							if (count($result_coa)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'id_coa' => $id_coa,
									'coa_sub_cd' => $coa_sub_cd,
									'coa_sub_name' => $coa_sub_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_coacreate->add_sub_chart_of_account($data);
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
								'id_coa' => $id_coa,
								'coa_sub_cd' => $coa_sub_cd,
								'coa_sub_name' => $coa_sub_name,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_coaupdate->update_sub_chart_of_account($data, $company_id_session, $id_coa_sub);
							if ($result==true) {
								$result = $this->m_coaread->list_sub_chart_of_account($company_id_session, $id_coa_sub);
								$data_array = array();
								if (count($result)==0) {
									$status = 0;
								}
								else {
									$status = 1;
									foreach ($result as $resultList){
										$data = array(
											'id_coa_sub' => $resultList->id_coa_sub,
											'company_id' => $resultList->company_id,
											'company_name' => $resultList->company_name,
											'id_coa' => $resultList->id_coa,
											'coa_cd' => $resultList->coa_cd,
											'coa_name' => $resultList->coa_name,
											'coa_sub_cd' => $resultList->coa_sub_cd,
											'coa_sub_name' => $resultList->coa_sub_name,
											'create_by' => $resultList->create_by,
											'cNmPegawai_create' => $resultList->cNmPegawai_create,
											'create_date' => $resultList->create_date,
											'last_by' => $resultList->last_by,
											'cNmPegawai_last' => $resultList->cNmPegawai_last,
											'last_update' => $resultList->last_update,
											'deleted' => $resultList->deleted,
										);
										array_push($data_array, $data);
									}					
								}
								$status = 1;
								$responseValue = $data_array;
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

		public function add_rate($key_session){
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
					$this->form_validation->set_rules('coa_rate_date', 'coa_rate_date', 'required');
					$this->form_validation->set_rules('coa_rate_nominal', 'coa_rate_nominal', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa_rate = $this->input->post('id_coa_rate');
						$id_coa_currency = $this->input->post('id_coa_currency');
						$coa_rate_date = $this->input->post('coa_rate_date');
						$coa_rate_nominal = $this->input->post('coa_rate_nominal');

						$last_update = date('Y-m-d H:i:s');

						if ($id_coa_sub=='') {
							$result_coa = $this->m_coaread->list_rate_by_currency_date($company_id_session, $id_coa_currency, $coa_rate_date);
							if (count($result_coa)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'id_coa_currency' => $id_coa_currency,
									'coa_rate_date' => $coa_rate_date,
									'coa_rate_nominal' => $coa_rate_nominal,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_coacreate->add_rate($data);
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
								'coa_rate_nominal' => $coa_rate_nominal,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_coaupdate->update_rate($data, $company_id_session, $id_coa_rate);
							if ($result==true) {
								$result = $this->m_coaread->list_rate($company_id_session, $id_coa_rate);
								$data_array = array();
								if (count($result)==0) {
									$status = 0;
								}
								else {
									$status = 1;
									foreach ($result as $resultList){
										$decimal_after = $resultList->decimal_after;
										$data = array(
											'id_coa_rate' => $resultList->id_coa_rate,
											'company_id' => $resultList->company_id,
											'company_name' => $resultList->company_name,
											'id_coa_currency' => $resultList->id_coa_currency,
											'coa_currency_cd' => $resultList->coa_currency_cd,
											'coa_currency_name' => $resultList->coa_currency_name,
											'coa_rate_date' => $resultList->coa_rate_date,
											'coa_rate_date_format' => date_format(date_create($resultList->coa_rate_date), 'd M Y'),
											'coa_rate_nominal' => str_replace(',', '', number_format($resultList->coa_rate_nominal, $decimal_after)),
											'coa_rate_nominal_format' => number_format($resultList->coa_rate_nominal, $decimal_after),
											'create_by' => $resultList->create_by,
											'cNmPegawai_create' => $resultList->cNmPegawai_create,
											'create_date' => $resultList->create_date,
											'last_by' => $resultList->last_by,
											'cNmPegawai_last' => $resultList->cNmPegawai_last,
											'last_update' => $resultList->last_update,
										);
										array_push($data_array, $data);
									}					
								}
								$responseValue = $data_array;
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

		public function add_cash_account($key_session){
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
					$this->form_validation->set_rules('cash_account_cd', 'cash_account_cd', 'required');
					$this->form_validation->set_rules('nominal', 'nominal', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_cash_account = $this->input->post('id_cash_account');
						$id_coa = $this->input->post('id_coa');
						$cash_account_cd = $this->input->post('cash_account_cd');
						$nominal = $this->input->post('nominal');

						$last_update = date('Y-m-d H:i:s');

						if ($id_cash_account=='') {
							$data=array(
								'company_id' => $company_id_session,
								'id_coa' => $id_coa,
								'cash_account_cd' => $cash_account_cd,
								'nominal' => $nominal,
								'set_default' => 0,
								'deleted' => 0,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_coacreate->add_cash_account($data);
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
								'id_coa' => $id_coa,
								'cash_account_cd' => $cash_account_cd,
								'nominal' => $nominal,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_coaupdate->update_cash_account($data, $company_id_session, $id_cash_account);
							if ($result==true) {
								$result = $this->m_coaread->list_cash_account($company_id_session, $id_cash_account);
								$data_array = array();
								$status = 1;
								foreach ($result as $resultList){
									$decimal_after = $resultList->decimal_after;
									$data = array(
										'id_cash_account' => $resultList->id_cash_account,
										'company_id' => $resultList->company_id,
										'company_name' => $resultList->company_name,
										'id_coa' => $resultList->id_coa,
										'coa_cd' => $resultList->coa_cd,
										'coa_name' => $resultList->coa_name,
										'cash_account_cd' => $resultList->cash_account_cd,
										'coa_currency_cd' => $resultList->coa_currency_cd,
										'deleted' => $resultList->deleted,
										'decimal_after' => $resultList->decimal_after,
										'nominal' => str_replace(',', '', number_format($resultList->nominal, $decimal_after)),
										'nominal_format' => number_format($resultList->nominal, $decimal_after),
										'create_by' => $resultList->create_by,
										'cNmPegawai_create' => $resultList->cNmPegawai_create,
										'create_date' => $resultList->create_date,
										'last_by' => $resultList->last_by,
										'cNmPegawai_last' => $resultList->cNmPegawai_last,
										'last_update' => $resultList->last_update,
									);
									array_push($data_array, $data);
								}
								$responseValue = $data_array;
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

		public function add_bank_account($key_session){
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

					//$this->form_validation->set_rules('id_coa_bank', 'id_coa_bank', 'required');
					//$this->form_validation->set_rules('id_coa', 'id_coa', 'required');
					$this->form_validation->set_rules('id_coa_currency', 'id_coa_currency', 'required');
					$this->form_validation->set_rules('cIDBank', 'cIDBank', 'required');
					$this->form_validation->set_rules('bank_account_no', 'bank_account_no', 'required');
					$this->form_validation->set_rules('bank_account_name', 'bank_account_name', 'required');
					$this->form_validation->set_rules('bank_account_branch', 'bank_account_branch', 'required');
					$this->form_validation->set_rules('bank_account_address', 'bank_account_address', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_coa_bank = $this->input->post('id_coa_bank');
						$id_coa = $this->input->post('id_coa');
						$id_coa_currency_post = $this->input->post('id_coa_currency');
						$cIDBank_post = $this->input->post('cIDBank');
						$bank_account_no = $this->input->post('bank_account_no');
						$bank_account_name = $this->input->post('bank_account_name');
						$bank_account_branch = $this->input->post('bank_account_branch');
						$bank_account_address = $this->input->post('bank_account_address');
						$bank_account_va = $this->input->post('bank_account_va');
						
						$last_update = date('Y-m-d H:i:s');

						$result_coa_currency = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $id_coa_currency_post);
						if (count($result_coa_currency) == 0) {
							$status = 0;
							$responseValue = 'Currency not registered on system.';
						}
						else {
							foreach ($result_coa_currency as $resultList_coa_currency);
							$id_coa_currency = $resultList_coa_currency->id_coa_currency;

							$result_bank = $this->m_essread->list_bank_by_cNmBank($company_id_session, $cIDBank_post);
							if (count($result_bank) == 0) {
								$status = 0;
								$responseValue = 'Bank not registered on system.';
							}
							else {
								foreach ($result_bank as $resultList_bank);
								$cIDBank = $resultList_bank->cIDBank;

								if ($id_coa_bank=='') {
									$data=array(
										'company_id' => $company_id_session,
										'id_coa' => $id_coa*1,
										'id_coa_currency' => $id_coa_currency,
										'cIDBank' => $cIDBank,
										'bank_account_no' => $bank_account_no,
										'bank_account_name' => $bank_account_name,
										'bank_account_branch' => $bank_account_branch,
										'bank_account_address' => $bank_account_address,
										'bank_account_va' => $bank_account_va,
										'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
										'deleted' => 0,
									);
									$result = $this->m_coacreate->add_bank_account($data);
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
										'id_coa_currency' => $id_coa_currency,
										'cIDBank' => $cIDBank,
										'bank_account_no' => $bank_account_no,
										'bank_account_name' => $bank_account_name,
										'bank_account_branch' => $bank_account_branch,
										'bank_account_address' => $bank_account_address,
										'bank_account_va' => $bank_account_va,
										'last_by' => $cNIK_session,
										'last_update' => $last_update,
									);
									$result = $this->m_coaupdate->update_bank_account($company_id_session, $data, $id_coa_bank);
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
						}						
					}
					echo json_encode(array(array('status' => $status, 'response' => $data)));
				}
			}
		}

	}
