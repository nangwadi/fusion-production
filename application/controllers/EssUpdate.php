<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class EssUpdate extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_essread');
        $this->load->model('m_esscreate');
        $this->load->model('m_essupdate');
        //$this->load->model('m_ess');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// Organization

	public function update_company($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('company_id', 'company_id', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$company_id = $this->input->post('company_id');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_company($data, $company_id);
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

	public function update_plant($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_plant', 'id_plant', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_plant = $this->input->post('id_plant');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_plant($data, $id_plant);
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

	public function update_department($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDDept = $this->input->post('cIDDept');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_department($data, $cIDDept);
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

	public function update_division($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDBag = $this->input->post('cIDBag');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_division($data, $cIDBag);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDBag.' '.$deleted;
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

	public function update_potition($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDJbtn', 'cIDJbtn', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDJbtn = $this->input->post('cIDJbtn');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_potition($data, $cIDJbtn);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDJbtn.' '.$deleted;
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

	public function update_employee_status($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDStsKrj', 'cIDStsKrj', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDStsKrj = $this->input->post('cIDStsKrj');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_employee_status($data, $cIDStsKrj);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDStsKrj.' '.$deleted;
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

	public function update_family_status($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDSts_Keluarga', 'cIDSts_Keluarga', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDSts_Keluarga = $this->input->post('cIDSts_Keluarga');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_family_status($data, $cIDSts_Keluarga);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDSts_Keluarga.' '.$deleted;
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

	public function update_family_relation($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDHubKel', 'cIDHubKel', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDHubKel = $this->input->post('cIDHubKel');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_family_relation($data, $cIDHubKel);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDHubKel.' '.$deleted;
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

	public function update_education($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_pendidikan', 'id_pendidikan', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_pendidikan = $this->input->post('id_pendidikan');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_education($data, $id_pendidikan);
					if ($result==true) {
						$status = 1;
						$responseValue = $id_pendidikan.' '.$deleted;
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

	public function update_religion($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDAgama', 'cIDAgama', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDAgama = $this->input->post('cIDAgama');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_religion($data, $cIDAgama);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDAgama.' '.$deleted;
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

	public function update_bank($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDBank', 'cIDBank', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDBank = $this->input->post('cIDBank');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_bank($data, $cIDBank);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDBank.' '.$deleted;
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

	public function update_salary_component($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDKomponen', 'cIDKomponen', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDKomponen = $this->input->post('cIDKomponen');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_salary_component($data, $cIDKomponen);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDKomponen.' '.$deleted;
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

	public function update_salary_component_group($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDKomponen_group', 'cIDKomponen_group', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDKomponen_group = $this->input->post('cIDKomponen_group');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_salary_component_group($data, $cIDKomponen_group);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDKomponen_group.' '.$deleted;
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

	public function update_data_photo($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_data_photo', 'id_data_photo', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_data_photo = $this->input->post('id_data_photo');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_data_photo($data, $id_data_photo);
					if ($result==true) {
						$status = 1;
						$responseValue = $id_data_photo.' '.$deleted;
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

	public function update_blood_group($key_session){
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_golongan_darah', 'id_golongan_darah', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_golongan_darah = $this->input->post('id_golongan_darah');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_blood_group($data, $id_golongan_darah, $company_id_session);
					if ($result==true) {
						$status = 1;
						$responseValue = $id_golongan_darah.' '.$deleted;
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

	public function update_reasons_for_resigning($key_session){
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDJnsBerhenti', 'cIDJnsBerhenti', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDJnsBerhenti = $this->input->post('cIDJnsBerhenti');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_reasons_for_resigning($data, $cIDJnsBerhenti);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDJnsBerhenti.' '.$deleted;
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

	// Attendance
	public function update_sift_group($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cGroupID = $this->input->post('cGroupID');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_sift_group($data, $cGroupID);
					if ($result==true) {
						$status = 1;
						$responseValue = $cGroupID.' '.$deleted;
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

	public function update_sift($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cShiftID', 'cShiftID', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cShiftID = $this->input->post('cShiftID');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_sift($data, $cShiftID);
					if ($result==true) {
						$status = 1;
						$responseValue = $cShiftID.' '.$deleted;
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

	public function update_precense_type($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIDAbsen', 'cIDAbsen', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDAbsen = $this->input->post('cIDAbsen');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_precense_type($data, $cIDAbsen);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIDAbsen.' '.$deleted;
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

	public function update_national_holiday($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_libur_nasional', 'id_libur_nasional', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_libur_nasional = $this->input->post('id_libur_nasional');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_national_holiday($data, $id_libur_nasional);
					if ($result==true) {
						$status = 1;
						$responseValue = $id_libur_nasional.' '.$deleted;
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

	public function update_mandatory_overtime($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_lembur_wajib', 'id_lembur_wajib', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_lembur_wajib = $this->input->post('id_lembur_wajib');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_mandatory_overtime($data, $id_lembur_wajib);
					if ($result==true) {
						$status = 1;
						$responseValue = $id_lembur_wajib.' '.$deleted;
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

	public function update_change_day($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_ganti_hari', 'id_ganti_hari', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_ganti_hari = $this->input->post('id_ganti_hari');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_change_day($data, $id_ganti_hari);
					if ($result==true) {
						$status = 1;
						$responseValue = $id_ganti_hari.' '.$deleted;
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

	public function update_ramadhan($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_ramadhan', 'id_ramadhan', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_ramadhan = $this->input->post('id_ramadhan');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_ramadhan($data, $id_ramadhan);
					if ($result==true) {
						$status = 1;
						$responseValue = $id_ramadhan.' '.$deleted;
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

	public function update_attendance_periode($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cIdPeriod', 'cIdPeriod', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIdPeriod = $this->input->post('cIdPeriod');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"status" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_attendance_periode($data, $cIdPeriod);
					if ($result==true) {
						$status = 1;
						$responseValue = $cIdPeriod.' '.$deleted;
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

	public function update_master_calendar($key_session){
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
				$this->form_validation->set_rules('dTglHdr', 'dTglHdr', 'required');
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
				$this->form_validation->set_rules('cShiftID_Plan', 'cShiftID_Plan', 'required');
				
				$this->form_validation->set_rules('cShiftID_update', 'cShiftID_update', 'required');
				$this->form_validation->set_rules('cIDAbsen_update', 'cIDAbsen_update', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$dTglHdr = $this->input->post('dTglHdr');
					$cGroupID = $this->input->post('cGroupID');
					$cShiftID_Plan = $this->input->post('cShiftID_Plan');

					$cShiftID_update = $this->input->post('cShiftID_update');
					$cIDAbsen_update = $this->input->post('cIDAbsen_update');

					$note = $this->input->post('note');
					$category = $this->input->post('category');

					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"cShiftID_Plan" => $cShiftID_update,
						"cIDAbsen" => $cIDAbsen_update,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_master_calendar($data, $company_id_session, $cGroupID, $dTglHdr, $cShiftID_Plan);
					if ($result==true) {
						if ($category==1) { // Add Holiday
							$check_holiday = $this->m_essread->list_national_holiday_by_date($company_id_session, $dTglHdr, $cGroupID);
							if (count($check_holiday)==0) {
								$data=array(
									"company_id" => $company_id_session,
									"tanggal_libur_nasional" => $dTglHdr,
									"nama_hari_libur" => strtoupper($note),
									"cGroupID" => $cGroupID,
									"deleted" => 0,
									"create_by" => $cNIK_session,
									"create_date" => $last_update,
									"last_by" => $cNIK_session,
									"last_update" => $last_update,
								);
								$result = $this->m_esscreate->add_national_holiday($data);
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
								foreach ($check_holiday as $checkList);
								$id_libur_nasional = $checkList->id_libur_nasional;
								$data=array(
									"tanggal_libur_nasional" => $dTglHdr,
									"nama_hari_libur" => strtoupper($note),
									"cGroupID" => $cGroupID,
									"last_by" => $cNIK_session,
									"last_update" => $last_update,
								);
								$result = $this->m_essupdate->update_national_holiday($data, $id_libur_nasional);
								if ($result==true) {
									$status = 1;
									$responseValue = $company_id_session.' '.$id_libur_nasional.' '.$note;
								}
								else {
									$status = 0;
									$responseValue = 'Data not updated.';
								}
							}
						}
						else if ($category==2) { // Add Mandatory OT
							$check = $this->m_essread->list_mandatory_overtime_by_date($company_id_session, $dTglHdr, $cGroupID);
							if (count($check)==0) { // Add mandatry OT
								$data=array(
									"company_id" => $company_id_session,
									"tanggal_lembur_wajib" => $dTglHdr,
									"cGroupID" => $cGroupID,
									"deleted" => 0,
									"create_by" => $cNIK_session,
									"create_date" => $last_update,
									"last_by" => $cNIK_session,
									"last_update" => $last_update,
								);
								$result = $this->m_esscreate->add_mandatory_overtime($data);
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
								$status = 1;
								$responseValue = 'ok';
							}
						}
						else if ($category==3) { // Add Change Day
							$check = $this->m_essread->list_change_day_by_date($company_id_session, $dTglHdr, $cGroupID);
							if (count($check)==0) { // Add Change Day
								$data=array(
									"company_id" => $company_id_session,
									"tanggal_ganti_hari" => $dTglHdr,
									"cGroupID" => $cGroupID,
									"deleted" => 0,
									"create_by" => $cNIK_session,
									"create_date" => $last_update,
									"last_by" => $cNIK_session,
									"last_update" => $last_update,
								);
								$result = $this->m_esscreate->add_change_day($data);
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
								$status = 1;
								$responseValue = 'ok';
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
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	public function update_master_calendar_sift($key_session){
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
				$this->form_validation->set_rules('dTglHdr_start', 'dTglHdr_start', 'required');
				$this->form_validation->set_rules('dTglHdr_end', 'dTglHdr_end', 'required');
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
				$this->form_validation->set_rules('cShiftID_Plan', 'cShiftID_Plan', 'required');
				
				$this->form_validation->set_rules('cShiftID_update', 'cShiftID_update', 'required');
				$this->form_validation->set_rules('cIDAbsen_update', 'cIDAbsen_update', 'required');

				$data_array = array();
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
					$data=array(
						'status' => $status
					);
					array_push($data_array, $data);
				}
				else {
					$dTglHdr_start = $this->input->post('dTglHdr_start');
					$dTglHdr_end = $this->input->post('dTglHdr_end');
					$cGroupID = $this->input->post('cGroupID');
					$cShiftID_Plan = $this->input->post('cShiftID_Plan');

					$cShiftID_update = $this->input->post('cShiftID_update');
					$cIDAbsen_update = $this->input->post('cIDAbsen_update');

					$note = $this->input->post('note');
					$category = $this->input->post('category');

					$last_update = date('Y-m-d H:i:s');

					$date_start = date_create($dTglHdr_start);
					$date_end = date_create($dTglHdr_end);
					$diff=date_diff($date_start, $date_end);
					$day_diff = ($diff->format("%R%a"))*1; 

					for ($a=0; $a<=$day_diff; $a++){
						$dTglHdr = date('Y-m-d', strtotime($dTglHdr_start. '+'.$a.' days'));
						$dTglHdr_day_name = date_format(date_create($dTglHdr), 'D');
						if ($dTglHdr_day_name!='Sat' && $dTglHdr_day_name!='Sun') {
							$data=array(
								"cShiftID_Plan" => $cShiftID_update,
								"cIDAbsen" => $cIDAbsen_update,
								"last_by" => $cNIK_session,
								"last_update" => $last_update,
							);
							$result = $this->m_essupdate->update_master_calendar($data, $company_id_session, $cGroupID, $dTglHdr, $cShiftID_Plan);
							if ($result==true) {
								$status = 1;
								$responseValue = '';			
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated.';
							}
							$data=array(
								'status' => $status,
							);
							array_push($data_array, $data);
						}
					}
				}
				echo json_encode(array_unique($data_array));
			}
		}
	}

	// Attendance Record

	public function update_daily_attendance($key_session){
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
				$this->form_validation->set_rules('dTglHdr', 'dTglHdr', 'required');
				$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
				$this->form_validation->set_rules('cShiftID', 'cShiftID', 'required');
				$this->form_validation->set_rules('cIDAbsen', 'cIDAbsen', 'required');
				$this->form_validation->set_rules('dJamMsk', 'dJamMsk', 'required');
				$this->form_validation->set_rules('dJamPlg', 'dJamPlg', 'required');

				$data_array = array();
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
					$data=array(
						'status' => $status
					);
					array_push($data_array, $data);
				}
				else {
					$dTglHdr = $this->input->post('dTglHdr');
					$cNIK = $this->input->post('cNIK');
					$cShiftID = $this->input->post('cShiftID');
					$cIDAbsen = $this->input->post('cIDAbsen');
					$dJamMsk = $this->input->post('dJamMsk');
					$dJamPlg = $this->input->post('dJamPlg');
					$lembur_awal = $this->input->post('lembur_awal');

					$result_shift = $this->m_essread->list_sift($company_id_session, $cShiftID);
					$cNmShift = $result_shift[0]->cNmShift;

					$result_absen = $this->m_essread->list_precense_type($company_id_session, $cIDAbsen);
					$cNmAbsen = $result_absen[0]->cNmAbsen;

					$last_update = date('Y-m-d H:i:s');

					$cDayNm = date_format(date_create($dTglHdr), 'l');

					if ($company_id_session==1) {
						$result_time = $this->m_essread->cek_sift_time($company_id_session, $cShiftID, $cDayNm);
						if (count($result_time)>=1) {
							$status=1;
							$dIN = $result_time[0]->dIN;
							$dOUT = $result_time[0]->dOUT;
							$dRest_Start1 = $result_time[0]->dRest_Start1;
							$dRest_End1 = $result_time[0]->dRest_End1;
							$dRest_Start2 = $result_time[0]->dRest_Start2;
							$dRest_End2 = $result_time[0]->dRest_End2;
							if ($result_time[0]->dRest_Start3=='00:00') {
								$dRest_Start3 = '24:00';
							}
							else {
								$dRest_Start3 = $result_time[0]->dRest_Start3;
							}						
							$dRest_End3 = $result_time[0]->dRest_End3;

							if ($lembur_awal==1) {
								$ot_awal_start = $dJamMsk;
								$ot_awal_end = $dIN;
								$ot_awal = ((strtotime($dIN) - strtotime($dJamMsk))/60)/60;
							}
							else {
								$ot_awal_start = '00:00';
								$ot_awal_end = '00:00';
								$ot_awal = 0;
							}

							$rest1 = ((strtotime($dRest_End1) - strtotime($dRest_Start1))/60)/60;
							$rest2 = ((strtotime($dRest_End2) - strtotime($dRest_Start2))/60)/60;
							$rest3 = ((strtotime($dRest_End3) - strtotime($dRest_Start3))/60)/60;

							if (strtotime($dJamMsk) < strtotime($dJamPlg)) {  // Shift Pagi
								$work_hour_before = ((strtotime($dJamPlg) - strtotime($dIN))/60)/60;
							}
							else {
								$work_hour_1 = ((strtotime('24:00') - strtotime($dIN))/60)/60;
								$work_hour_2 = ((strtotime($dJamPlg) - strtotime('00:00'))/60)/60;
								$work_hour_before = $work_hour_1+$work_hour_2;
							}
							
							$default_work_hour = 8; // Belum di definisikan di database, segera

							if (strtotime($dJamPlg)>=strtotime($dIN) && strtotime($dJamPlg)<=strtotime($dRest_Start1)) {
								$minus = 0;
							}
							else if (strtotime($dJamPlg)>=strtotime($dRest_Start1) && strtotime($dJamPlg)<=strtotime($dRest_End1)) {
								$minus = ((strtotime($dJamPlg) - strtotime($dRest_Start1))/60)/60;
							}
							else if (strtotime($dJamPlg)>=strtotime($dRest_End1) && strtotime($dJamPlg)<=strtotime($dRest_Start2)) {
								$minus = $rest1;
							}
							else if (strtotime($dJamPlg)>=strtotime($dRest_Start2) && strtotime($dJamPlg)<=strtotime($dRest_End2)) {
								$minus = $rest1+(((strtotime($dJamPlg) - strtotime($dRest_Start2))/60)/60);
							}
							else if (strtotime($dJamPlg)>=strtotime($dRest_End2) && strtotime($dJamPlg)<=strtotime($dRest_Start3)) {
								$minus = $rest1+$rest2;
							}
							else if (strtotime($dJamPlg)>=strtotime($dRest_Start3) && strtotime($dJamPlg)<=strtotime($dRest_End3)) {
								$minus = $rest1+$rest2+(((strtotime($dJamPlg) - strtotime($dRest_Start3))/60)/60);
							}
							else if (strtotime($dJamPlg)>=strtotime($dRest_End3) && strtotime($dJamPlg)<=strtotime($dIN)) {
								$minus = $rest1+$rest2+$rest3;
							}

							$work_hour_after = $work_hour_before - $minus;

							if (strtotime($dJamMsk)<=strtotime($dIN)) {
								$dt = 0;
							}
							else {
								$dt = ((strtotime($dJamMsk) - strtotime($dIN))/60)/60;
							}

							if ($dJamPlg=='00:00') {
								$pc = 0;
							}
							else {
								if (strtotime($dJamPlg)<=strtotime($dOUT)) {
									$pc = (((strtotime($dOUT) - strtotime($dJamPlg))/60)/60);
								}
								else {
									$pc = 0;
								}
							}

							if ($dt==0) {
								$cIDAbsen = $cIDAbsen;
								if ($pc==0) {
									$cIDAbsen = $cIDAbsen;
									$ipu = 0;
									$pc = 0;
									$dt = $dt;
								}
								else if ($pc>=0.01 && $pc<=3) {
									$cIDAbsen = $cIDAbsen;
									$ipu = 0;
									$pc = $pc;
									$dt = $dt;
								}
								else {
									$cIDAbsen = 'IPU';
									$pc = 0;
									$dt = $dt;
									if (strtotime($dJamPlg) > strtotime($dIN) && strtotime($dJamPlg) <= strtotime($dRest_Start1)) {
										$ipu = (((strtotime($dRest_Start1) - strtotime($dJamPlg))/60)/60) + (((strtotime($dOUT) - strtotime($dRest_End1))/60)/60);
									}
									else if (strtotime($dJamPlg) > strtotime($dRest_Start1) && strtotime($dJamPlg) <= strtotime($dRest_End1)) {
										$ipu = ((strtotime($dRest_Start1) - strtotime($dIN))/60)/60;
									}
									else if (strtotime($dJamPlg) > strtotime($dRest_End1) && strtotime($dJamPlg) <= strtotime($dOUT)) {
										$ipu = ((strtotime($dOUT) - strtotime($dJamPlg))/60)/60;
									}
								}
							}
							else if ($dt>=0.01 && $dt<=3.00) {
								$cIDAbsen = $cIDAbsen;
								if ($pc==0) {
									$cIDAbsen = $cIDAbsen;
									$ipu = 0;
									$pc = 0;
									$dt = $dt;
								}
								else if ($pc>=0.01 && $pc<=3) {
									$cIDAbsen = $cIDAbsen;
									$ipu = 0;
									$pc = $pc;
									$dt = $dt;
								}
								else {
									$cIDAbsen = 'IPU';
									$pc = 0;
									$dt = $dt;
									if (strtotime($dJamPlg) > strtotime($dIN) && strtotime($dJamPlg) <= strtotime($dRest_Start1)) {
										$ipu = (((strtotime($dRest_Start1) - strtotime($dJamPlg))/60)/60) + (((strtotime($dOUT) - strtotime($dRest_End1))/60)/60);
									}
									else if (strtotime($dJamPlg) > strtotime($dRest_Start1) && strtotime($dJamPlg) <= strtotime($dRest_End1)) {
										$ipu = ((strtotime($dRest_Start1) - strtotime($dIN))/60)/60;
									}
									else if (strtotime($dJamPlg) > strtotime($dRest_End1) && strtotime($dJamPlg) <= strtotime($dOUT)) {
										$ipu = ((strtotime($dOUT) - strtotime($dJamPlg))/60)/60;
									}
								}
							}
							else {
								if ($pc >= 0.01 && $pc<=3.00) {
									$cIDAbsen = $cIDAbsen;
									$pc = $pc;
									$ipu = 0;
									$dt = $dt;
								}
								else {
									$cIDAbsen = 'IPU';
									$pc = 0;
									$dt = $dt;
									if (strtotime($dJamMsk) > strtotime($dIN) && strtotime($dJamMsk) <= strtotime($dRest_Start1)) {
										$ipu = ((strtotime($dJamMsk) - strtotime($dIN))/60)/60;
									}
									else if (strtotime($dJamMsk) > strtotime($dRest_Start1) && strtotime($dJamMsk) <= strtotime($dRest_End1)) {
										$ipu = ((strtotime($dRest_Start1) - strtotime($dIN))/60)/60;
									}
									else if (strtotime($dJamMsk) > strtotime($dRest_End1) && strtotime($dJamMsk) <= strtotime($dOUT)) {
										$ipu = ((strtotime($dJamMsk) - strtotime($dIN))/60)/60;
									}
									else {
										if (strtotime($dJamPlg) > strtotime($dIN) && strtotime($dJamPlg) <= strtotime($dRest_Start1)) {
											$ipu = (((strtotime($dRest_Start1) - strtotime($dJamPlg))/60)/60) + (((strtotime($dOUT) - strtotime($dRest_End1))/60)/60);
										}
										else if (strtotime($dJamPlg) > strtotime($dRest_Start1) && strtotime($dJamPlg) <= strtotime($dRest_End1)) {
											$ipu = ((strtotime($dRest_Start1) - strtotime($dIN))/60)/60;
										}
										else if (strtotime($dJamPlg) > strtotime($dRest_End1) && strtotime($dJamPlg) <= strtotime($dOUT)) {
											$ipu = ((strtotime($dOUT) - strtotime($dJamPlg))/60)/60;
										}
									}
								}
							}

							$imp = 0;

							$result_sift = $this->m_essread->list_sift($company_id_session, $cShiftID);
							$holiday_overtime = $result_sift[0]->holiday_overtime;
							$x1 = $result_sift[0]->x1;
							$x2 = $result_sift[0]->x2;
							$x3 = $result_sift[0]->x3;
							$x4 = $result_sift[0]->x4;

							if ($holiday_overtime==0) {
								$ot_real_before = $work_hour_after - $default_work_hour;
								
								if ($ot_real_before>=1) {
									$ot_real = number_format($ot_real_before, 2);
									$ot_1 = 1*$x1;
									$ot_2_before = $ot_real - 1;
									if ($ot_2_before>=0.1) {
										$ot_2 = $ot_2_before*$x2;
										$ot_3 = 0;
										$ot_4 = 0;
										$ot_konv = $ot_1 + $ot_2 + $ot_3 + $ot_4;
									}
									else {
										$ot_2 = 0;
										$ot_3 = 0;
										$ot_4 = 0;
										$ot_konv = $ot_1 + $ot_2 + $ot_3 + $ot_4;
									}
								}
								else {
									$ot_real = 0;
									$ot_1 = 0;
									$ot_2 = 0;
									$ot_3 = 0;
									$ot_4 = 0;
									$ot_konv = 0;
								}
							}
							else {
								$ot_real_before = $work_hour_after;
								$ot_real = number_format($ot_real_before, 2);
								$ot_1 = 0;

								if ($ot_real<$default_work_hour) {
									$ot_2 = $ot_real*$x2;
								}
								else {
									$ot_2 = $default_work_hour*$x2;
								}
								
								$ot_3_before = $ot_real-$default_work_hour;
								if ($ot_3_before >= 0.01 && $ot_3_before <= 1.0) {
									$ot_3 = $ot_3_before*$x3;
									$ot_4 = 0;
									$ot_konv = $ot_1 + $ot_2 + $ot_3 + $ot_4;
								}
								else if ($ot_3_before >= 1.01) {
									$ot_3 = 1*$x3;
									$ot_4_before = $ot_real-$default_work_hour-1;
									$ot_4 = $ot_4_before*$x4;
									$ot_konv = $ot_1 + $ot_2 + $ot_3 + $ot_4;
								}
								else {
									$ot_3 = 0;
									$ot_4 = 0;
									$ot_konv = $ot_1 + $ot_2 + $ot_3 + $ot_4;
								}
							}

							if ($ot_real>=1) {
								if ($holiday_overtime==0) {
									$ot_akhir_start = date_format(date_create($dOUT), 'H:i:s');
									$ot_akhir_end = date_format(date_create($dJamPlg), 'H:i:s');
									$ot_libur_start = date_format(date_create('00:00'), 'H:i:s');
									$ot_libur_end = date_format(date_create('00:00'), 'H:i:s');
									$ot_akhir = $ot_real;
									$ot_libur = 0;
								}
								else {
									$ot_akhir_start = date_format(date_create('00:00'), 'H:i:s');
									$ot_akhir_end = date_format(date_create('00:00'), 'H:i:s');
									$ot_libur_start = date_format(date_create($dIN), 'H:i:s');
									$ot_libur_end = date_format(date_create($dJamPlg), 'H:i:s');
									$ot_akhir = 0;
									$ot_libur = $ot_real;
								}
							}
							else {
								if ($holiday_overtime==0) {
									$ot_akhir_start = date_format(date_create('00:00'), 'H:i:s');
									$ot_akhir_end = date_format(date_create('00:00'), 'H:i:s');
									$ot_libur_start = date_format(date_create('00:00'), 'H:i:s');
									$ot_libur_end = date_format(date_create('00:00'), 'H:i:s');
									$ot_akhir = 0;
									$ot_libur = 0;
								}
								else {
									$ot_akhir_start = date_format(date_create('00:00'), 'H:i:s');
									$ot_akhir_end = date_format(date_create('00:00'), 'H:i:s');
									$ot_libur_start = date_format(date_create($dIN), 'H:i:s');
									$ot_libur_end = date_format(date_create($dJamPlg), 'H:i:s');
									$ot_akhir = 0;
									$ot_libur = $ot_real;
								}
							}

							if ($dJamPlg=='00:00') {
								$ot_akhir_start = '00:00';
								$ot_akhir_end = '00:00';
								$ot_akhir = 0;
								$ot_libur_start = '00:00';
								$ot_libur_end = '00:00';
								$ot_libur = 0;
								$ot_1 = 0;
								$ot_2 = 0;
								$ot_3 = 0;
								$ot_4 = 0;
								$ot_real = 0;
								$ot_konv = 0;
							}

							$jam_kerja_normal = $default_work_hour - $dt - $pc - $ipu;

							$data = array(
								'dJamMsk' => date_format(date_create($dJamMsk), 'H:i'),
								'dJamPlg' => date_format(date_create($dJamPlg), 'H:i'),
								'cShiftID_act' => $cShiftID,
								'dt' => $dt,
								'pc' => $pc,
								'ipu' => $ipu,
								'imp' => $imp,
								'basik' => $default_work_hour,
								'jam_kerja_normal' => $jam_kerja_normal,
								'ot_awal_start' => date_format(date_create($ot_awal_start), 'H:i'),
								'ot_awal_end' => date_format(date_create($ot_awal_end), 'H:i'),
								'ot_awal' => $ot_awal,
								'ot_akhir_start' => $ot_akhir_start,
								'ot_akhir_end' => $ot_akhir_end,
								'ot_akhir' => $ot_akhir,
								'ot_libur_start' => $ot_libur_start,
								'ot_libur_end' => $ot_libur_end,
								'ot_libur' => $ot_libur,
								'ot_1' => $ot_1,
								'ot_2' => $ot_2,
								'ot_3' => $ot_3,
								'ot_4' => $ot_4,
								'ot_real' => $ot_real,
								'ot_konv' => $ot_konv,
								'cIDAbsen' => $cIDAbsen,
								'last_by' => $cNIK_session,
								'last_update' => $last_update
							);

							$result = $this->m_essupdate->update_absensi($data, $company_id_session, $cNIK, $dTglHdr);
							if ($result==true) {
								$status = 1;
								$responseValue = array(
									'cNmShift' => $cNmShift,
									'cNmAbsen' => $cNmAbsen,
									'dJamMsk' => $dJamMsk,
									'dJamPlg' => $dJamPlg,
									'ot_real' => number_format($ot_real, 2),
									'ot_konv' => number_format($ot_konv, 2)
								);
							}
							else {
								$status = 0;
								$responseValue = 'Data not updated';
							}
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated';
						}
					}					
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue, 'data' => $data)));
			}
		}
	}

	// Personal Data

	public function update_personal_salary($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
				$this->form_validation->set_rules('cIDKomponen', 'cIDKomponen', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
					$cIDKomponen = $this->input->post('cIDKomponen');
					$deleted = $this->input->post('deleted');
					$nNilai = $this->input->post('nNilai');
					$dBerlaku_dari = $this->input->post('dBerlaku_dari');
					$last_update = date('Y-m-d H:i:s');

					if ($deleted==1) {
						$data=array(
							"deleted" => $deleted,
							"dBerlaku_Sdgn" => date('Y-m-d'),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
					}
					else {
						$data=array(
							"deleted" => $deleted,
							"dBerlaku_Sdgn" => null,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
					}
					$result = $this->m_essupdate->update_personal_salary_disen($data, $cNIK, $cIDKomponen, $nNilai, $dBerlaku_dari);
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

	public function update_personal_bank_account($key_session){
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
			    $this->form_validation->set_rules('cIDBank', 'cIDBank', 'required');
			    $this->form_validation->set_rules('cNoAccount', 'cNoAccount', 'required');
			    $this->form_validation->set_rules('cNmPemilik', 'cNmPemilik', 'required');
			    $this->form_validation->set_rules('cAlmBank', 'cAlmBank', 'required');
			    $this->form_validation->set_rules('dCity', 'dCity', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
					$deleted = $this->input->post('deleted');
					$cIDBank = $this->input->post('cIDBank');
				    $cNoAccount = $this->input->post('cNoAccount');
				    $cNmPemilik = $this->input->post('cNmPemilik');
				    $cAlmBank = $this->input->post('cAlmBank');
				    $dCity = $this->input->post('dCity');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_personal_bank_account_disen($data, $cNIK, $cIDBank, $cNoAccount, $cNmPemilik);
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

	// Personal Data - Delete

	public function delete_personal_family($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('cNama', 'cNama', 'required');
				$this->form_validation->set_rules('dTglLhr', 'dTglLhr', 'required');
				$this->form_validation->set_rules('cTempat_Lhr', 'cTempat_Lhr', 'required');
				$this->form_validation->set_rules('cJnsKel', 'cJnsKel', 'required');
				$this->form_validation->set_rules('cIDHubKel', 'cIDHubKel', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
					$cNama = $this->input->post('cNama');
					$dTglLhr = $this->input->post('dTglLhr');
					$cTempat_Lhr = $this->input->post('cTempat_Lhr');
					$cJnsKel = $this->input->post('cJnsKel');
					$cIDHubKel = $this->input->post('cIDHubKel');
					$last_update = date('Y-m-d H:i:s');

					$result = $this->m_essupdate->delete_personal_family($cNIK, $cNama, $dTglLhr, $cTempat_Lhr, $cJnsKel, $cIDHubKel);
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

	// Resign

	public function delete_resign($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
					$cNIK = $this->input->post('cNIK');

					$result = $this->m_essupdate->delete_resign($cNIK);
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

	// Payroll

	public function delete_manual_transaction($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('id_trans_manual', 'id_trans_manual', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_trans_manual = $this->input->post('id_trans_manual');

					$result = $this->m_essupdate->delete_manual_transaction($id_trans_manual);
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

	public function update_history_medical($key_session){
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

			    $this->form_validation->set_rules('cNama', 'cNama', 'required');
			    $this->form_validation->set_rules('dTgl_Berobat', 'dTgl_Berobat', 'required');
			    $this->form_validation->set_rules('nBiaya_Pengajuan', 'nBiaya_Pengajuan', 'required');
			    $this->form_validation->set_rules('cNmRS', 'cNmRS', 'required');
			    $this->form_validation->set_rules('cNmDokter', 'cNmDokter', 'required');
			    $this->form_validation->set_rules('diagnosa', 'diagnosa', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_medical = $this->input->post('id_medical');
				    $cNIK = $this->input->post('cNIK');
				    $cIDPeriod = $this->input->post('cIDPeriod');

				    $cNama = $this->input->post('cNama');
				    $dTgl_Berobat = $this->input->post('dTgl_Berobat');
				    $tahun_Berobat = date_format(date_create($dTgl_Berobat), 'Y');
				    $nBiaya_Pengajuan = $this->input->post('nBiaya_Pengajuan');
				    $cNmRS = $this->input->post('cNmRS');
				    $cNmDokter = $this->input->post('cNmDokter');
				    $diagnosa = $this->input->post('diagnosa');

				    $last_update = date('Y-m-d H:i:s');

				    $result_limit_medical = $this->m_essread->list_medical_limit($company_id_session, $tahun_Berobat, $cNIK);
				    $limit_medical = $result_limit_medical[0]->limit_medical;

				    $result_total_history_medical = $this->m_essread->total_history_medical($company_id_session, $tahun_Berobat, $cNIK);
				    $total_history_medical = $result_total_history_medical[0]->total_approve;

				    $total_history_medical_new = (($total_history_medical)*1)+(($nBiaya_Pengajuan)*1);
				    if ($total_history_medical_new>$limit_medical) {
				    	$status = 0;
				    	$responseValue = 'Medical Limit Reimbursment is Over.';
				    }
				    else {

					    $data = array(
							'dTgl_Berobat' => $dTgl_Berobat,
							'nBiaya_Pengajuan' => $nBiaya_Pengajuan,
							'nBiaya_Approve' => $nBiaya_Pengajuan,
							'cNmRS' => $cNmRS,
							'cNmDokter' => $cNmDokter,
							'diagnosa' => $diagnosa,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
					    );

					    $result = $this->m_essupdate->update_history_medical($data, $id_medical);
					    if($result==true){
					    	$status = 1;
					    	$responseValue = '';
					    }
					    else {
					    	$status = 0;
					    	$responseValue = 'Data not saved.';
					    }   
					} 
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	public function update_bpjs($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_bpjs', 'id_bpjs', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_bpjs = $this->input->post('id_bpjs');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_bpjs($data, $id_bpjs);
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

	public function update_pkp_ptkp_formula($key_session, $category){
		$cNIK_session=$this->session->userdata('cNIK_session');
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
				$this->form_validation->set_rules('deleted', 'deleted', 'required');
				$this->form_validation->set_rules('id_pkp_ptkp_formula', 'id_pkp_ptkp_formula', 'required');

				$category = $this->uri->segment('4');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_pkp_ptkp_formula = $this->input->post('id_pkp_ptkp_formula');
					$deleted = $this->input->post('deleted');
					$last_update = date('Y-m-d H:i:s');

					$data=array(
						"deleted" => $deleted,
						"last_by" => $cNIK_session,
						"last_update" => $last_update,
					);
					$result = $this->m_essupdate->update_pkp_ptkp_formula($data, $id_pkp_ptkp_formula, $category);
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
