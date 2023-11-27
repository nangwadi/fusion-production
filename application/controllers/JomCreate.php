<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class JomCreate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
	        $this->load->library('upload');
			$this->load->database();
	        $this->load->helper('form', 'url');
	        $this->load->model('m_jomread');
	        $this->load->model('m_jomcreate');
	        $this->load->model('m_jomupdate');
	        $this->load->model('m_coaread');
	        $this->load->model('m_essread');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function add_job_type($key_session){
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
					$this->form_validation->set_rules('job_type_cd', 'job_type_cd', 'required');
					$this->form_validation->set_rules('job_type_name', 'job_type_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_job_type = $this->input->post('id_job_type');
						$job_type_cd = $this->input->post('job_type_cd');
						$job_type_name = $this->input->post('job_type_name');
						$job_type_format = $this->input->post('job_type_format');

						$last_update = date('Y-m-d H:i:s');

						if ($id_job_type=='') {
							$result_job_type = $this->m_jomread->list_job_type($company_id_session, $id_job_type);
							if (count($result_job_type)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'job_type_cd' => $job_type_cd,
									'job_type_name' => $job_type_name,
									'job_type_format' => $job_type_format,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_job_type($data);
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
								'job_type_cd' => $job_type_cd,
								'job_type_name' => $job_type_name,
								'job_type_format' => $job_type_format,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_job_type($data, $company_id_session, $id_job_type);
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

		public function add_job_task($key_session){
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
					$this->form_validation->set_rules('job_task_cd', 'job_task_cd', 'required');
					$this->form_validation->set_rules('job_task_name', 'job_task_name', 'required');
					$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
					$this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
					$this->form_validation->set_rules('machine', 'machine', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_job_task = $this->input->post('id_job_task');
						$job_task_cd = $this->input->post('job_task_cd');
						$job_task_name = $this->input->post('job_task_name');
						$cIDDept = $this->input->post('cIDDept');
						$cIDBag = $this->input->post('cIDBag');
						$machine = ($this->input->post('machine'))*1;

						$last_update = date('Y-m-d H:i:s');

						if ($id_job_task=='') {

							$data=array(
								'company_id' => $company_id_session,
								'job_task_cd' => $job_task_cd,
								'job_task_name' => $job_task_name,
								'cIDDept' => $cIDDept,
								'cIDBag' => $cIDBag,
								'machine' => $machine,
								'deleted' => 0,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomcreate->add_job_task($data);
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
								'job_task_cd' => $job_task_cd,
								'job_task_name' => $job_task_name,
								'cIDDept' => $cIDDept,
								'cIDBag' => $cIDBag,
								'machine' => $machine,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_job_task($data, $company_id_session, $id_job_task);
							if ($result==true) {
								$data_array = array();
								$result_job_task = $this->m_jomread->list_job_task($company_id_session, $id_job_task);
								foreach ($result_job_task as $resultList){
									$cIDBag = $resultList->cIDBag;
									if ($cIDBag=='ALL') {
										$cNmBag = 'All Division';
									}
									else {
										$cNmBag = $resultList->cNmBag;
									}

									$data = array(
										'id_job_task' => $resultList->id_job_task,
										'company_id' => $resultList->company_id,
										'company_name' => $resultList->company_name,
										'job_task_cd' => $resultList->job_task_cd,
										'job_task_name' => $resultList->job_task_name,
										'cIDDept' => $resultList->cIDDept,
										'cNmDept' => $resultList->cNmDept,
										'cIDBag' => $resultList->cIDBag,
										'cNmBag' => $cNmBag,
										'machine' => $resultList->machine,
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

		public function add_job_task_sub($key_session){
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
					$this->form_validation->set_rules('job_task_sub_cd', 'job_task_sub_cd', 'required');
					$this->form_validation->set_rules('job_task_sub_name', 'job_task_sub_name', 'required');
					$this->form_validation->set_rules('id_job_task', 'id_job_task', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_job_task_sub = $this->input->post('id_job_task_sub');
						$job_task_sub_cd = $this->input->post('job_task_sub_cd');
						$job_task_sub_name = $this->input->post('job_task_sub_name');
						$id_job_task = $this->input->post('id_job_task');

						$last_update = date('Y-m-d H:i:s');

						if ($id_job_task_sub=='') {

							$data=array(
								'company_id' => $company_id_session,
								'job_task_sub_cd' => $job_task_sub_cd,
								'job_task_sub_name' => $job_task_sub_name,
								'id_job_task' => $id_job_task,
								'deleted' => 0,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomcreate->add_job_task_sub($data);
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
								'job_task_sub_cd' => $job_task_sub_cd,
								'job_task_sub_name' => $job_task_sub_name,
								'id_job_task' => $id_job_task,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_job_task_sub($data, $company_id_session, $id_job_task_sub);
							if ($result==true) {
								$data_array = array();
								$result_job_task_sub = $this->m_jomread->list_job_task_sub($company_id_session, $id_job_task_sub);
								foreach ($result_job_task_sub as $resultList){
									$cIDBag = $resultList->cIDBag;
									if ($cIDBag=='ALL') {
										$cNmBag = 'All Division';
									}
									else {
										$cNmBag = $resultList->cNmBag;
									}

									$data = array(
										'id_job_task_sub' => $resultList->id_job_task_sub,
										'company_id' => $resultList->company_id,
										'company_name' => $resultList->company_name,
										'id_job_task' => $resultList->id_job_task,
										'job_task_cd' => $resultList->job_task_cd,
										'job_task_name' => $resultList->job_task_name,
										'job_task_sub_cd' => $resultList->job_task_sub_cd,
										'job_task_sub_name' => $resultList->job_task_sub_name,
										'cIDDept' => $resultList->cIDDept,
										'cNmDept' => $resultList->cNmDept,
										'cIDBag' => $resultList->cIDBag,
										'machine' => $resultList->machine,
										'cNmBag' => $cNmBag,
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

		public function add_country($key_session){
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
					$this->form_validation->set_rules('country_cd', 'country_cd', 'required');
					$this->form_validation->set_rules('country_name', 'country_name', 'required');
					$this->form_validation->set_rules('country_phone_code', 'country_phone_code', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_country = $this->input->post('id_country');
						$country_cd = $this->input->post('country_cd');
						$country_name = $this->input->post('country_name');
						$country_phone_code = $this->input->post('country_phone_code');

						$last_update = date('Y-m-d H:i:s');

						if ($id_country=='') {
							$result_country = $this->m_jomread->list_country($company_id_session, $id_country);
							if (count($result_country)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'country_cd' => $country_cd,
									'country_name' => $country_name,
									'country_phone_code' => $country_phone_code,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_country($data);
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
								'country_cd' => $country_cd,
								'country_name' => $country_name,
								'country_phone_code' => $country_phone_code,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_country($data, $company_id_session, $id_country);
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

		public function add_tax($key_session){
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
					$this->form_validation->set_rules('tax_cd', 'tax_cd', 'required');
					$this->form_validation->set_rules('tax_name', 'tax_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_tax = $this->input->post('id_tax');
						$tax_cd = $this->input->post('tax_cd');
						$tax_name = $this->input->post('tax_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_tax=='') {
							$result_tax = $this->m_jomread->list_tax($company_id_session, $id_tax);
							if (count($result_tax)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'tax_cd' => $tax_cd,
									'tax_name' => $tax_name,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_tax($data);
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
								'tax_cd' => $tax_cd,
								'tax_name' => $tax_name,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_tax($data, $company_id_session, $id_tax);
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

		public function add_sub_tax($key_session){
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
					$this->form_validation->set_rules('sub_tax_cd', 'sub_tax_cd', 'required');
					$this->form_validation->set_rules('sub_tax_name', 'sub_tax_name', 'required');
					$this->form_validation->set_rules('id_tax', 'id_tax', 'required');
					$this->form_validation->set_rules('sub_tax_percent_plus', 'sub_tax_percent_plus', 'required');
					$this->form_validation->set_rules('sub_tax_percent_minus', 'sub_tax_percent_minus', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_sub_tax = $this->input->post('id_sub_tax');
						$sub_tax_cd = $this->input->post('sub_tax_cd');
						$sub_tax_name = $this->input->post('sub_tax_name');
						$id_tax = $this->input->post('id_tax');
						$sub_tax_percent_plus = $this->input->post('sub_tax_percent_plus');
						$sub_tax_percent_minus = $this->input->post('sub_tax_percent_minus');
						$sub_tax_percent_plus_coa_post = $this->input->post('sub_tax_percent_plus_coa');
						$sub_tax_percent_minus_coa_post = $this->input->post('sub_tax_percent_minus_coa');

						if ($sub_tax_percent_plus_coa_post == '') {
							$sub_tax_percent_plus_coa = null;
						}
						else {
							$result_coa_percent_plus = $this->m_coaread->list_chart_of_account_by_name($company_id_session, $sub_tax_percent_plus_coa_post);
							$sub_tax_percent_plus_coa = $result_coa_percent_plus[0]->id_coa;
						}

						if ($sub_tax_percent_minus_coa_post == null) {
							$sub_tax_percent_minus_coa = null;
						}
						else {
							$result_coa_percent_minus = $this->m_coaread->list_chart_of_account_by_name($company_id_session, $sub_tax_percent_minus_coa_post);
							$sub_tax_percent_minus_coa = $result_coa_percent_minus[0]->id_coa;
						}

						$last_update = date('Y-m-d H:i:s');

						if ($id_sub_tax=='') {
							$result_sub_tax = $this->m_jomread->list_sub_tax($company_id_session, $id_sub_tax);
							if (count($result_sub_tax)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'sub_tax_cd' => $sub_tax_cd,
									'sub_tax_name' => $sub_tax_name,
									'id_tax' => $id_tax,
									'sub_tax_percent_plus' => $sub_tax_percent_plus,
									'sub_tax_percent_minus' => $sub_tax_percent_minus,
									'sub_tax_percent_plus_coa' => $sub_tax_percent_plus_coa,
									'sub_tax_percent_minus_coa' => $sub_tax_percent_minus_coa,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_sub_tax($data);
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
								'sub_tax_cd' => $sub_tax_cd,
								'sub_tax_name' => $sub_tax_name,
								'id_tax' => $id_tax,
								'sub_tax_percent_plus' => $sub_tax_percent_plus,
								'sub_tax_percent_minus' => $sub_tax_percent_minus,
								'sub_tax_percent_plus_coa' => $sub_tax_percent_plus_coa,
								'sub_tax_percent_minus_coa' => $sub_tax_percent_minus_coa,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_sub_tax($data, $company_id_session, $id_sub_tax);
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

		public function add_material($key_session){
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
					$this->form_validation->set_rules('material_cd', 'material_cd', 'required');
					$this->form_validation->set_rules('material_name', 'material_name', 'required');
					$this->form_validation->set_rules('id_account', 'id_account', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_material = $this->input->post('id_material');
						$material_cd = $this->input->post('material_cd');
						$material_name = $this->input->post('material_name');
						$account_name = $this->input->post('id_account');
						$result_account = $this->m_jomread->list_account_by_account_name($company_id_session, 'vendor', $account_name);
						$id_account = $result_account[0]->id_account;

						$last_update = date('Y-m-d H:i:s');

						if ($id_material=='') {
							$result_material = $this->m_jomread->list_material_by_material_cd($company_id_session, $material_cd);
							if (count($result_material)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'material_cd' => $material_cd,
									'material_name' => $material_name,
									'id_account' => $id_account,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_material($data);
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
								'material_cd' => $material_cd,
								'material_name' => $material_name,
								'id_account' => $id_account,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_material($data, $company_id_session, $id_material);
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

		public function add_part_list_status($key_session){
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
					$this->form_validation->set_rules('part_list_status_cd', 'part_list_status_cd', 'required');
					$this->form_validation->set_rules('part_list_status_name', 'part_list_status_name', 'required');
					$this->form_validation->set_rules('sequence', 'sequence', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_part_list_status = $this->input->post('id_part_list_status');
						$part_list_status_cd = $this->input->post('part_list_status_cd');
						$part_list_status_name = $this->input->post('part_list_status_name');
						$email_pic = $this->input->post('email_pic');
						$sequence = $this->input->post('sequence');
						$result_account = $this->m_jomread->list_account_by_account_name($company_id_session, 'vendor', $account_name);
						$id_account = $result_account[0]->id_account;

						$last_update = date('Y-m-d H:i:s');

						if ($id_part_list_status=='') {
							$result_part_list_status = $this->m_jomread->list_part_list_status_by_part_list_status_cd($company_id_session, $part_list_status_cd);
							if (count($result_part_list_status)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'part_list_status_cd' => $part_list_status_cd,
									'part_list_status_name' => $part_list_status_name,
									'sequence' => $sequence,
									'email_pic' => $email_pic,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_part_list_status($data);
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
								'part_list_status_cd' => $part_list_status_cd,
								'part_list_status_name' => $part_list_status_name,
								'sequence' => $sequence,
								'email_pic' => $email_pic,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_part_list_status($data, $company_id_session, $id_part_list_status);
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

		public function add_permission_special($key_session){
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
					$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_permission_special = $this->input->post('id_permission_special');
						$cNIK = $this->input->post('cNIK');

						$last_update = date('Y-m-d H:i:s');

						if ($id_permission_special=='') {
							$data=array(
								'company_id' => $company_id_session,
								'cNIK' => $cNIK,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomcreate->add_permission_special($data);
							if ($result==true) {
								$status = 1;
								$responseValue = $data;
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
						else { // Update
							$data=array(
								'cNIK' => $cNIK,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_permission_special($data, $company_id_session, $id_permission_special);
							if ($result==true) {
								$status = 1;
								$responseValue = $data;
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

		public function add_permission_type($key_session){
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
					$this->form_validation->set_rules('permission_cd', 'permission_cd', 'required');
					$this->form_validation->set_rules('permission_name', 'permission_name', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_permission = $this->input->post('id_permission');
						$permission_cd = $this->input->post('permission_cd');
						$permission_name = $this->input->post('permission_name');

						$last_update = date('Y-m-d H:i:s');

						if ($id_permission=='') {
							$result_permission = $this->m_jomread->list_permission_type($company_id_session, $id_permission);
							if (count($result_permission)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'permission_cd' => $permission_cd,
									'permission_name' => $permission_name,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_permission_type($data);
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
								'permission_cd' => $permission_cd,
								'permission_name' => $permission_name,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_permission_type($data, $company_id_session, $id_permission);
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

		public function add_permission_employee($key_session){
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
					$this->form_validation->set_rules('id_permission', 'id_permission', 'required');
					$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
					$this->form_validation->set_rules('r', 'r', 'required');
					$this->form_validation->set_rules('c', 'c', 'required');
					$this->form_validation->set_rules('u', 'u', 'required');
					$this->form_validation->set_rules('d', 'd', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_permission_employee = $this->input->post('id_permission_employee');
						$id_permission = $this->input->post('id_permission');
						$cNIK = $this->input->post('cNIK');
						$r = $this->input->post('r');
						$c = $this->input->post('c');
						$u = $this->input->post('u');
						$d = $this->input->post('d');
						$crud = $r.''.$c.''.$u.''.$d;

						$last_update = date('Y-m-d H:i:s');

						if ($id_permission_employee=='') {
							$data=array(
								'company_id' => $company_id_session,
								'id_permission' => $id_permission,
								'cNIK' => $cNIK,
								'crud' => $crud,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomcreate->add_permission_employee($data);
							if ($result==true) {
								$status = 1;
								$responseValue = $data;
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
						}
						else { // Update
							$data=array(
								'id_permission' => $id_permission,
								'cNIK' => $cNIK,
								'crud' => $crud,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_permission_employee($data, $company_id_session, $id_permission_employee);
							if ($result==true) {
								$status = 1;
								$responseValue = $data;
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

		public function add_account($key_session, $category){
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
					$this->form_validation->set_rules('account_cd', 'account_cd', 'required');
					$this->form_validation->set_rules('account_name', 'account_name', 'required');
					$this->form_validation->set_rules('main_address', 'main_address', 'required');
					$this->form_validation->set_rules('city', 'city', 'required');
					$this->form_validation->set_rules('postal_code', 'postal_code', 'required');
					$this->form_validation->set_rules('id_country', 'id_country', 'required');
					$this->form_validation->set_rules('phone_1', 'phone_1', 'required');
					//$this->form_validation->set_rules('fax', 'fax', 'required');
					//$this->form_validation->set_rules('attn', 'attn', 'required');
					//$this->form_validation->set_rules('email', 'email', 'required');
		 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_account = $this->input->post('id_account');
						$cv = $this->uri->segment('4');
						$account_cd = $this->input->post('account_cd');
						$account_name = $this->input->post('account_name');
						$main_address = $this->input->post('main_address');
						$city = $this->input->post('city');
						$postal_code = $this->input->post('postal_code');
						$id_country = $this->input->post('id_country');
						$phone_1 = $this->input->post('phone_1');
						$phone_2 = $this->input->post('phone_2');
						$fax = $this->input->post('fax');
						$attn = $this->input->post('attn');
						$email = $this->input->post('email');

						$apr_account_post = $this->input->post('apr_account');
						$aapr_account_post = $this->input->post('aapr_account');
						$payment_account_post = $this->input->post('payment_account');
						$sales_account_post = $this->input->post('sales_account');

						$apr_account_exp = explode(' // ', $apr_account_post);
						$apr_account_cd = $apr_account_exp[0];
						$result_apr_account = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $apr_account_cd);
						$apr_account = $result_apr_account[0]->id_coa;

						$aapr_account_exp = explode(' // ', $aapr_account_post);
						$aapr_account_cd = $aapr_account_exp[0];
						$result_aapr_account = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $aapr_account_cd);
						$aapr_account = $result_aapr_account[0]->id_coa;

						$payment_account_exp = explode(' // ', $payment_account_post);
						$payment_account_cd = $payment_account_exp[0];
						$result_payment_account = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $payment_account_cd);
						$payment_account = $result_payment_account[0]->id_coa;

						$sales_account_exp = explode(' // ', $sales_account_post);
						$sales_account_cd = $sales_account_exp[0];
						$result_sales_account = $this->m_coaread->list_chart_of_account_by_cd($company_id_session, $sales_account_cd);
						$sales_account = $result_sales_account[0]->id_coa;

						$sales_person_post = $this->input->post('sales_person');
						$sales_person_exp = explode(' // ', $sales_person_post);
						$sales_person_cd = $sales_person_exp[0];
						$result_sales_person = $this->m_jomread->list_employee_by_cNmPegawai($company_id_session, $sales_person_cd);
						$sales_person = $result_sales_person[0]->cNIK;

						$taxable = $this->input->post('taxable');

						$last_update = date('Y-m-d H:i:s');

						if ($id_account=='') {
							$result_account = $this->m_jomread->list_account_by_account_cd($company_id_session, $category, $account_cd);
							if (count($result_account)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'cv' => $cv,
									'account_cd' => $account_cd,
									'account_name' => $account_name,
									'main_address' => $main_address,
									'city' => $city,
									'postal_code' => $postal_code,
									'id_country' => $id_country,
									'phone_1' => $phone_1,
									'phone_2' => $phone_2,
									'fax' => $fax,
									'attn' => $attn,
									'email' => $email,
									'apr_account' => $apr_account,
									'aapr_account' => $aapr_account,
									'payment_account' => $payment_account,
									'sales_account' => $sales_account,
									'sales_person' => $sales_person,
									'taxable' => $taxable,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_account($data);
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
								'account_cd' => $account_cd,
								'account_name' => $account_name,
								'main_address' => $main_address,
								'city' => $city,
								'postal_code' => $postal_code,
								'id_country' => $id_country,
								'phone_1' => $phone_1,
								'phone_2' => $phone_2,
								'fax' => $fax,
								'attn' => $attn,
								'email' => $email,
								'apr_account' => $apr_account,
								'aapr_account' => $aapr_account,
								'payment_account' => $payment_account,
								'sales_account' => $sales_account,
								'sales_person' => $sales_person,
								'taxable' => $taxable,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_account($data, $company_id_session, $id_account);
							if ($result==true) {
								$result_account_db = $this->m_jomread->list_account($company_id_session, $cv, $id_account);
								$status = 1;
								$responseValue = $result_account_db;
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

		public function add_account_password($key_session){
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
					$this->form_validation->set_rules('id_account', 'id_account', 'required');
		 			$this->form_validation->set_rules('password_account', 'password_account', 'required');

					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_account = $this->input->post('id_account');
						$password_account = $this->input->post('password_account');
						$check_account_password = $this->m_jomread->list_account_password_by_id_account($company_id_session, $id_account);
						$last_update = date('Y-m-d H:i:s');
						if (count($check_account_password) == 0) {
							$data = array(
								'company_id' => $company_id_session,
								'id_account' => $id_account,
								'password_account' => md5($password_account),
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomcreate->add_account_password($data);
							if ($result == true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Cannot save password to database, please contact MMI Developer and screen shoot this page.';
							}
						}
						else {
							$data = array(
								'password_account' => md5($password_account),
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_account_password($company_id_session, $data, $id_account);
							if ($result == true) {
								$status = 1;
								$responseValue = '';
							}
							else {
								$status = 0;
								$responseValue = 'Cannot save password to database, please contact MMI Developer and screen shoot this page.';
							}
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_job_number($key_session){
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
					$this->form_validation->set_rules('id_account', 'id_account', 'required');
					$this->form_validation->set_rules('id_job_type', 'id_job_type', 'required');
					$this->form_validation->set_rules('number', 'number', 'required');
		 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_account = $this->input->post('id_account');
						$id_job_type = $this->input->post('id_job_type');
						$number = $this->input->post('number');

						$last_update = date('Y-m-d H:i:s');

						if ($id_account=='') {
							$result_job_number = $this->m_jomread->list_job_number($company_id_session, $id_account, $id_job_type);
							if (count($result_job_number)==0) { // Add 
								$data=array(
									'company_id' => $company_id_session,
									'id_account' => $id_account,
									'id_job_type' => $id_job_type,
									'number' => ($number)*1,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_job_number($data);
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
						}
						else { // Update
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
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_job_order($key_session){
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
					//$this->form_validation->set_rules('id_job_order', 'id_job_order', 'required');
					$this->form_validation->set_rules('id_account', 'id_account', 'required');
					$this->form_validation->set_rules('id_job_type', 'id_job_type', 'required');
					$this->form_validation->set_rules('JobNo', 'JobNo', 'required');
					$this->form_validation->set_rules('MoldName', 'MoldName', 'required');
					$this->form_validation->set_rules('MoldNomor', 'MoldNomor', 'required');
					$this->form_validation->set_rules('JobName', 'JobName', 'required');
					$this->form_validation->set_rules('POCustomerNumber', 'POCustomerNumber', 'required');
					$this->form_validation->set_rules('PODate', 'PODate', 'required');
					$this->form_validation->set_rules('Qty', 'Qty', 'required');
					$this->form_validation->set_rules('Amount', 'Amount', 'required');
					$this->form_validation->set_rules('GrossProfit', 'GrossProfit', 'required');
					$this->form_validation->set_rules('cNIK_marketing', 'cNIK_marketing', 'required');
					$this->form_validation->set_rules('cNIK_design', 'cNIK_design', 'required');
					$this->form_validation->set_rules('StartDatePlan', 'StartDatePlan', 'required');
					$this->form_validation->set_rules('DeliveryDatePlan', 'DeliveryDatePlan', 'required');
					$this->form_validation->set_rules('Keterangan', 'Keterangan', 'required');
		 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_job_order = $this->input->post('id_job_order');
						$id_account = $this->input->post('id_account');
						$id_job_type = $this->input->post('id_job_type');
						$JobNo = $this->input->post('JobNo');
						$MoldName = $this->input->post('MoldName');
						$MoldNomor = $this->input->post('MoldNomor');
						$JobName = $this->input->post('JobName');
						$POCustomerNumber = $this->input->post('POCustomerNumber');
						$PODate = $this->input->post('PODate');
						$Qty = $this->input->post('Qty');
						$Amount = $this->input->post('Amount');
						$GrossProfit = $this->input->post('GrossProfit');
						$cNIK_marketing = $this->input->post('cNIK_marketing');
						$cNIK_design = $this->input->post('cNIK_design');
						$StartDatePlan = $this->input->post('StartDatePlan');
						$DeliveryDatePlan = $this->input->post('DeliveryDatePlan');
						$Keterangan = $this->input->post('Keterangan');

						$number = ($this->input->post('number'))+1;

						$last_update = date('Y-m-d H:i:s');

						if ($id_job_order=='') {
							$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);
							if (count($result_job_order)>=1) {
								$status = 0;
								$responseValue = 'Job Number has already, please update customer number order in Account -> Customer.';
							}
							else {
								$data=array(
									'company_id' => $company_id_session,
									'id_account' => $id_account,
									'id_job_type' => $id_job_type,
									'JobNo' => $JobNo,
									'MoldName' => strtoupper($MoldName),
									'MoldNomor' => strtoupper($MoldNomor),
									'JobName' => $JobName,
									'POCustomerNumber' => strtoupper($POCustomerNumber),
									'PODate' => $PODate,
									'Qty' => $Qty,
									'Amount' => $Amount,
									'GrossProfit' => $GrossProfit,
									'cNIK_marketing' => $cNIK_marketing,
									'cNIK_design' => $cNIK_design,
									'StartDatePlan' => $StartDatePlan,
									'StartDateAct' => null,
									'DeliveryDatePlan' => $DeliveryDatePlan,
									'DeliveryDateAct' => null,
									'Keterangan' => $Keterangan,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_job_order($data);
								if ($result==true) {
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
									$responseValue = 'Data not saved.';
								}
							}
						}
						else { // Update
							$data=array(
								'MoldName' => strtoupper($MoldName),
								'MoldNomor' => strtoupper($MoldNomor),
								'JobName' => $JobName,
								'POCustomerNumber' => strtoupper($POCustomerNumber),
								'PODate' => $PODate,
								'Qty' => $Qty,
								'Amount' => $Amount,
								'GrossProfit' => $GrossProfit,
								'cNIK_marketing' => $cNIK_marketing,
								'cNIK_design' => $cNIK_design,
								'StartDatePlan' => $StartDatePlan,
								'DeliveryDatePlan' => $DeliveryDatePlan,
								'Keterangan' => $Keterangan,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_job_order($data, $company_id_session, $id_job_order);
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

		public function add_after_trial($key_session){
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
					$this->form_validation->set_rules('JobNo', 'JobNo', 'required');
					$this->form_validation->set_rules('DeliveryDatePlan', 'DeliveryDatePlan', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$JobNo = $this->input->post('JobNo');
						$DeliveryDatePlan = $this->input->post('DeliveryDatePlan');
						$last_update = date('Y-m-d H:i:s');

						$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);

						if (count($result_job_order)>=1) {
							$id_job_order = $result_job_order[0]->id_job_order;
							$result_after_trial_open = $this->m_jomread->list_after_trial_by_id_job_order_open($company_id_session, $id_job_order);
							if (count($result_after_trial_open)>=1) {
								$status = 0;
								$responseValue = 'Please close last trial status.';
							}
							else {
								$result_after_trial = $this->m_jomread->list_after_trial_by_id_job_order($company_id_session, $id_job_order);
								$last_after_trial = count($result_after_trial);
								$trial = $last_after_trial+1;

								$data = array(
									'company_id' => $company_id_session,
									'id_job_order' => $id_job_order,
									'trial' => $trial,
									'DeliveryDatePlan' => $DeliveryDatePlan,
									'DeliveryDateAct' => null,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);

								$result = $this->m_jomcreate->add_after_trial($data);
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
						else {
							$status = 0;
							$responseValue = 'Job not found.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_part_list($key_session){
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
					$this->form_validation->set_rules('part_no', 'part_no', 'required');
					$this->form_validation->set_rules('id_inventory', 'id_inventory', 'required');
					$this->form_validation->set_rules('JobNo', 'JobNo', 'required');
					$this->form_validation->set_rules('part_name', 'part_name', 'required');
					$this->form_validation->set_rules('qty', 'qty', 'required');
					$this->form_validation->set_rules('sp_1', 'sp_1', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_part_list = $this->input->post('id_part_list');
						$id_inventory = $this->input->post('id_inventory');
						$id_job_order_post = $this->input->post('JobNo');
						$part_no = $this->input->post('part_no');
						$part_name = $this->input->post('part_name');
						$id_material_post = $this->input->post('id_material');
						$qty = $this->input->post('qty');
						$qty_spare_post = $this->input->post('qty_spare');
						$drawing_no = $this->input->post('drawing_no');
						$single_multi_post = $this->input->post('single_multi');
						$sp_1 = $this->input->post('sp_1');
						$sp_2 = $this->input->post('sp_2');
						$sp_3 = $this->input->post('sp_3');
						$sp_4 = $this->input->post('sp_4');
						$sp_5 = $this->input->post('sp_5');
						$note = $this->input->post('note');
						$id_account_vendor_post = $this->input->post('id_account_vendor');
						$id_account_maker_post = $this->input->post('id_account_maker');

						if ($id_material_post != '') {
							$result_material = $this->m_jomread->list_material_by_material_name($company_id_session, $id_material_post);
							$id_material = $result_material[0]->id_material;
						}
						else {
							$id_material = null;
						}

						if ($id_account_vendor_post != '') {
							$result_account_vendor = $this->m_jomread->list_account_by_account_name($company_id_session, 'vendor', $id_account_vendor_post);
							$id_account_vendor = $result_account_vendor[0]->id_account;
						}
						else {
							$id_account_vendor = null;
						}

						if ($id_account_maker_post != '') {
							$result_account_maker = $this->m_jomread->list_account_by_account_name($company_id_session, 'vendor', $id_account_maker_post);
							$id_account_maker = $result_account_maker[0]->id_account;
						}
						else {
							$id_account_maker = null;
						}

						if ($id_job_order_post != '') {
							$result_material = $this->m_jomread->list_job_order_by_jobno($company_id_session, $id_job_order_post);
							$id_job_order = $result_material[0]->id_job_order;
						}
						else {
							$id_job_order = null;
						}

						if ($qty_spare_post != '') {
							$qty_spare = $qty_spare_post;
						}
						else {
							$qty_spare = null;
						}

						if ($single_multi_post == 'on') {
							$single_multi = 'multi';
						}
						else {
							$single_multi = 'single';
							$sp_2 = '';
							$sp_3 = '';
							$sp_4 = '';
							$sp_5 = '';
						}

						$last_update = date('Y-m-d H:i:s');

						//$responseValue = $data;

						if ($id_part_list=='') {
							$result_part_list = $this->m_jomread->list_part_list_by_part_no($company_id_session, $part_no, $id_job_order_post);
							if (count($result_part_list)==0) { // Add 
								$data = array(
									'company_id' => $company_id_session,
									'id_job_order' => $id_job_order,
									'id_inventory' => $id_inventory*1,
									'part_no' => strtoupper($part_no),
									'part_name' => strtoupper($part_name),
									'id_material' => $id_material,
									'qty' => $qty*1,
									'qty_spare' => $qty_spare,
									'single_multi' => $single_multi,
									'sp_1' => strtoupper($sp_1),
									'sp_2' => strtoupper($sp_2),
									'sp_3' => strtoupper($sp_3),
									'sp_4' => strtoupper($sp_4),
									'sp_5' => strtoupper($sp_5),
									'note' => strtoupper($note),
									'drawing_no' => $drawing_no,
									'id_account_vendor' => $id_account_vendor,
									'id_account_maker' => $id_account_maker,
									'deleted' => 0,
									'create_by' => $cNIK_session,
									'create_date' => $last_update,
									'last_by' => $cNIK_session,
									'last_update' => $last_update,
								);
								$result = $this->m_jomcreate->add_part_list($data);
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
								'id_job_order' => $id_job_order,
								'id_inventory' => $id_inventory*1,
								'part_no' => strtoupper($part_no),
								'part_name' => strtoupper($part_name),
								'id_material' => $id_material,
								'qty' => $qty*1,
								'qty_spare' => $qty_spare,
								'single_multi' => $single_multi,
								'sp_1' => strtoupper($sp_1),
								'sp_2' => strtoupper($sp_2),
								'sp_3' => strtoupper($sp_3),
								'sp_4' => strtoupper($sp_4),
								'sp_5' => strtoupper($sp_5),
								'note' => strtoupper($note),
								'drawing_no' => $drawing_no,
								'id_account_vendor' => $id_account_vendor,
								'id_account_maker' => $id_account_maker,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomupdate->update_part_list($data, $company_id_session, $id_part_list);
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

		public function upload_file_dwg($key_session){
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
					$this->form_validation->set_rules('rev', 'rev', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_part_list = $this->input->post('id_part_list');
						$rev = $this->input->post('rev');
						$note = $this->input->post('note');
						$category = $this->input->post('category');
						$last_update = date('Y-m-d H:i:s');

						$result_part_list_detail = $this->m_jomread->list_part_list_detail($company_id_session, $id_part_list);
						$JobNo = $result_part_list_detail[0]->JobNo;
						$part_no = $result_part_list_detail[0]->part_no;

						function generateRandomString($length = 8) {
						    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						    $charactersLength = strlen($characters);
						    $randomString = '';
						    for ($i = 0; $i < $length; $i++) {
						        $randomString .= $characters[random_int(0, $charactersLength - 1)];
						    }
						    return $randomString;
						}

						if ($rev == 0) {
							$filename = $part_no.'-'.generateRandomString();
						}
						else {
							$filename = $part_no.'-'.generateRandomString().'_Rev_'.$rev;
						}

						$dir_file_dwg = './assets/file-dwg/'.$JobNo;

						if (!file_exists($dir_file_dwg)) {
						    if(mkdir($dir_file_dwg, 0777, true)){
								$status = 1;
						    }
						    else {
						    	$status = 0;
						    }
						}
						else {
							$status = 0;
						}

						$this->load->library('upload');   
						$config['upload_path'] = $dir_file_dwg;
						$config['allowed_types'] = 'pdf';
						$config['max_size']    = '10240';
						$config['file_name'] = $filename;
						
						$this->upload->initialize($config);
						if ($this->upload->do_upload("file_name")){
							$data = array(
								'company_id' => $company_id_session,
								'category' => $category,
								'id_part_list' => $id_part_list,
								'file_name' => $dir_file_dwg.'/'.$filename.'.pdf',
								'rev' => $rev,
								'note' => $note,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_jomcreate->upload_file_dwg($data);
							if ($result == true) {
								$status = 1;
								$responseValue = "";
							}
							else {
								$status = 0;
								$responseValue = "Cannot save data to database.";
								unlink('./assets/file-dwg/'.$filename.'.pdf');
							}
						}
						else {
							$status = 0;
							$responseValue = "File may be not PDF or size more than 10Mb.";
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function add_imo($key_session){
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
					$this->form_validation->set_rules('id_account_imo', 'id_account_imo', 'required');
					$this->form_validation->set_rules('cut_dim', 'cut_dim', 'required');
					$this->form_validation->set_rules('line_select', 'line_select', 'required');
					$this->form_validation->set_rules('JobNo', 'JobNo', 'required');
					$this->form_validation->set_rules('id_part_list_array', 'id_part_list_array', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$id_imo = $this->input->post('id_imo');
						$id_account_imo = $this->input->post('id_account_imo');
						$cut_dim = $this->input->post('cut_dim');
						$line_select = $this->input->post('line_select');
						$JobNo = $this->input->post('JobNo');
						$id_part_list_array = $this->input->post('id_part_list_array');

						$result_company = $this->m_essread->list_company($company_id_session);
						$company_code = $result_company[0]->company_code;
						$result_account = $this->m_jomread->list_account($company_id_session, 'vendor', $id_account_imo);
						$account_cd = $result_account[0]->account_cd;
						$result_no_imo = $this->m_jomread->list_imo_by_account($company_id_session, $JobNo, $id_account_imo);
						$last_no = count($result_no_imo);
						$last_no_format = sprintf("%03d", (($last_no)+1));
						$material_order_number = $last_no_format.'/'.$company_code.'/IMO/'.$account_cd.'/'.$JobNo;
						$result_job_order = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);
						$id_job_order = $result_job_order[0]->id_job_order;

						$last_update = date('Y-m-d H:i:s');

						if ($company_id_session==1) {
							$checked_1 = '10L10195';
							$checked_2 = '06L00116';
						}
						else {
							$checked_1 = null;
							$checked_2 = null;	
						}

						if ($id_imo=='') {
							$data = array(
								'company_id' => $company_id_session,
								'material_order_number' => $material_order_number,
								'id_job_order' => $id_job_order,
								'id_account_vendor' => $id_account_imo,
								'cut_dimension' => $cut_dim,
								'date_order' => date('Y-m-d'),
								'date_delivery_plan' => date('Y-m-d'),
								'issued' => $cNIK_session,
								'checked_1' => $checked_1,
								'approve_checked_1' => 0,
								'checked_2' => $checked_2,
								'approve_checked_2' => 0,
								'approved' => null,
								'approve_approved' => 0,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update
							);

							$result = $this->m_jomcreate->add_imo($data);
							if ($result==true) {
								if ($line_select==1) {
									$id_part_list = str_replace('[', '', str_replace(']', '', $id_part_list_array));
									$data_line = array(
										'company_id' => $company_id_session,
								    	'material_order_number' => $material_order_number,
								    	'id_part_list' => $id_part_list,
								    	'create_by' => $cNIK_session,
										'create_date' => $last_update,
										'last_by' => $cNIK_session,
										'last_update' => $last_update
									);
									$result_line = $this->m_jomcreate->add_imo_line($data_line);
									if ($result_line==true) {
										$status = 1;
									}
									else {
										$status = 0;
										$responseValue = 'Data line cannot saved, please try again.';
									}
								}
								else {
									$id_part_list_replace = str_replace('[', '', str_replace(']', '', $id_part_list_array));
									$id_part_list_exp = explode(',', $id_part_list_replace);
									$status_line = 0;
									for ($i=0; $i<$line_select; $i++){
										$id_part_list = $id_part_list_exp[$i];
										$data_line = array(
											'company_id' => $company_id_session,
									    	'material_order_number' => $material_order_number,
									    	'id_part_list' => $id_part_list,
									    	'create_by' => $cNIK_session,
											'create_date' => $last_update,
											'last_by' => $cNIK_session,
											'last_update' => $last_update
										);
										$result_line = $this->m_jomcreate->add_imo_line($data_line);
										if ($result_line==true) {
											$status_line += 1;
										}
										else {
											$status_line += 0;
											$responseValue = 'Data line cannot saved, please try again.';
										}
										$status = $status_line/$line_select;
									}
								}
							}
							else {
								$status = 0;
								$responseValue = 'Data header cannot saved, please try again.';
							}				
						}						
					}
					echo json_encode(array(array('status' => $status, 'response' => $data, 'response_line' => $data_line)));
				}
			}
		}

		public function add_imo_line($key_session){
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
					$this->form_validation->set_rules('material_order_number', 'material_order_number', 'required');
					$this->form_validation->set_rules('id_part_list', 'id_part_list', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$material_order_number = $this->input->post('material_order_number');
						$id_part_list = $this->input->post('id_part_list');
						$last_update = date('Y-m-d H:i:s');

						$data_line = array(
							'company_id' => $company_id_session,
					    	'material_order_number' => $material_order_number,
					    	'id_part_list' => $id_part_list,
					    	'create_by' => $cNIK_session,
							'create_date' => $last_update,
							'last_by' => $cNIK_session,
							'last_update' => $last_update
						);
						$result_line = $this->m_jomcreate->add_imo_line($data_line);
						if ($result_line==true) {
							$status = 1;
						}
						else {
							$status = 0;
							$responseValue = 'Data line cannot saved, please try again.';
						}					
					}
					echo json_encode(array(array('status' => $status, 'response' => $data, 'response_line' => $data_line)));
				}
			}
		}

		public function add_rto($key_session){
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
						$data = array(
							'company_id' => $company_id_session,
							'id_part_list' => $id_part_list,
							'rto_date' => date('Y-m-d'),
							'create_by' => $cNIK_session,
							'create_date' => $last_update,
							'last_by' => $cNIK_session,
							'last_update' => $last_update
						);
						$result = $this->m_jomcreate->add_rto($data);	
						if ($result==true) {
							$status = 1;
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


	}
