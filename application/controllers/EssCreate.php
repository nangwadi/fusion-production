<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class EssCreate extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('upload');
		$this->load->database();
        $this->load->helper('form', 'url');
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

	public function add_company($key_session){
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
				$this->form_validation->set_rules('company_code', 'company_code', 'required');
				$this->form_validation->set_rules('company_name', 'company_name', 'required');
				$this->form_validation->set_rules('company_address', 'company_address', 'required');
				$this->form_validation->set_rules('company_city', 'company_city', 'required');
				$this->form_validation->set_rules('company_phone', 'company_phone', 'required');
				$this->form_validation->set_rules('company_province', 'company_province', 'required');
				$this->form_validation->set_rules('company_country', 'company_country', 'required');
				$this->form_validation->set_rules('company_postal_code', 'company_postal_code', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$company_id = $this->input->post('company_id');
					$company_code = $this->input->post('company_code');
					$company_name = $this->input->post('company_name');
					$company_address = $this->input->post('company_address');
					$company_city = $this->input->post('company_city');
					$company_phone = $this->input->post('company_phone');
					$company_fax = $this->input->post('company_fax');
					$company_province = $this->input->post('company_province');
					$company_country = $this->input->post('company_country');
					$company_postal_code = $this->input->post('company_postal_code');
					$last_update = date('Y-m-d H:i:s');

					if ($company_id=="") { // Add Company
						$data=array(
							"company_code" => $company_code,
							"company_name" => $company_name,
							"company_address" => $company_address,
							"company_city" => $company_city,
							"company_phone" => $company_phone,
							"company_fax" => $company_fax,
							"company_province" => $company_province,
							"company_country" => $company_country,
							"company_postal_code" => $company_postal_code,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_company($data);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update Company
						$data=array(
							"company_name" => $company_name,
							"company_address" => $company_address,
							"company_city" => $company_city,
							"company_phone" => $company_phone,
							"company_fax" => $company_fax,
							"company_province" => $company_province,
							"company_country" => $company_country,
							"company_postal_code" => $company_postal_code,
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
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	public function add_plant($key_session){
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
				$this->form_validation->set_rules('plant', 'plant', 'required');
				$this->form_validation->set_rules('note', 'note', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_plant = $this->input->post('id_plant');
					$plant = $this->input->post('plant');
					$note = $this->input->post('note');
					$last_update = date('Y-m-d H:i:s');

					if ($id_plant=='') { // Add plant
						$data=array(
							"company_id" => $company_id_session,
							"plant" => ucwords($plant),
							"note" => $note,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_plant($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update plant
						$data=array(
							"plant" => ucwords($plant),
							"note" => $note,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_plant($data, $id_plant);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_plant;
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

	public function add_department($key_session){
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
				$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
				$this->form_validation->set_rules('cNmDept', 'cNmDept', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDDept = $this->input->post('cIDDept');
					$cNmDept = $this->input->post('cNmDept');
					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_department($company_id_session, $cIDDept);

					if (count($ceck)==0) { // Add department
						$data=array(
							"company_id" => $company_id_session,
							"cIDDept" => $cIDDept,
							"cNmDept" => ucwords($cNmDept),
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_department($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update department
						$data=array(
							"cNmDept" => ucwords($cNmDept),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_department($data, $cIDDept);
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

	public function add_division($key_session){
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
				$this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
				$this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
				$this->form_validation->set_rules('cNmBag', 'cNmBag', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDDept = $this->input->post('cIDDept');
					$cIDBag = $this->input->post('cIDBag');
					$cNmBag = $this->input->post('cNmBag');

					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_division($company_id_session, $cIDBag);

					if (count($ceck)==0) { // Add division
						$data=array(
							"company_id" => $company_id_session,
							"cIDDept" => $cIDDept,
							"cIDBag" => $cIDBag,
							"cNmBag" => ucwords($cNmBag),
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_division($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update division
						$data=array(
							"cIDDept" => $cIDDept,
							"cNmBag" => ucwords($cNmBag),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_division($data, $cIDBag);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDBag.' '.count($ceck);
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

	public function add_potition($key_session){
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
				$this->form_validation->set_rules('cNmJbtn', 'cNmJbtn', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDJbtn = $this->input->post('cIDJbtn');
					$cNmJbtn = $this->input->post('cNmJbtn');

					$last_update = date('Y-m-d H:i:s');

					if ($cIDJbtn=="") { // Add potition
						$data=array(
							"company_id" => $company_id_session,
							"cNmJbtn" => ucwords($cNmJbtn),
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_potition($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update potition
						$data=array(
							"cNmJbtn" => ucwords($cNmJbtn),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_potition($data, $cIDJbtn);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDJbtn;
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

	public function add_limit_medical($key_session){
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
				$this->form_validation->set_rules('cIDJbtn', 'cIDJbtn', 'required');
				$this->form_validation->set_rules('nominal', 'nominal', 'required');
				$this->form_validation->set_rules('nominal_istri', 'nominal_istri', 'required');
				$this->form_validation->set_rules('nominal_anak', 'nominal_anak', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDJbtn = $this->input->post('cIDJbtn');
					$nominal = $this->input->post('nominal');
					$nominal_istri = $this->input->post('nominal_istri');
					$nominal_anak = $this->input->post('nominal_anak');

					$last_update = date('Y-m-d H:i:s');

					$check = $this->m_essread->list_limit_medical($company_id_session, $cIDJbtn);

					if (count($check)==0) { // Add limit_medical
						$data=array(
							"company_id" => $company_id_session,
							"cIDJbtn" => $cIDJbtn,
							"nominal" => $nominal,
							"nominal_istri" => $nominal_istri,
							"nominal_anak" => $nominal_anak,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_limit_medical($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update limit_medical
						$data=array(
							"nominal" => $nominal,
							"nominal_istri" => $nominal_istri,
							"nominal_anak" => $nominal_anak,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_limit_medical($data, $cIDJbtn);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDJbtn;
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

	public function add_employee_status($key_session){
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
				$this->form_validation->set_rules('cNmStsKrj', 'cNmStsKrj', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDStsKrj = $this->input->post('cIDStsKrj');
					$cNmStsKrj = $this->input->post('cNmStsKrj');

					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_employee_status($company_id_session, 0);
					$cIDStsKrj_add_zero = sprintf("%03d", (count($ceck)+1));


					if ($cIDStsKrj=="") { // Add employee_status
						$data=array(
							"company_id" => $company_id_session,
							"cIDStsKrj" => $cIDStsKrj_add_zero,
							"cNmStsKrj" => ucwords($cNmStsKrj),
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_employee_status($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update employee_status
						$data=array(
							"cNmStsKrj" => ucwords($cNmStsKrj),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_employee_status($data, $cIDStsKrj);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDStsKrj;
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

	public function add_family_status($key_session){
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
				$this->form_validation->set_rules('cIDSts_Keluarga', 'cIDSts_Keluarga', 'required');
				$this->form_validation->set_rules('cNmSts_Keluarga', 'cNmSts_Keluarga', 'required');
				$this->form_validation->set_rules('istri', 'istri', 'required');
				$this->form_validation->set_rules('anak', 'anak', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDSts_Keluarga = $this->input->post('cIDSts_Keluarga');
					$cNmSts_Keluarga = $this->input->post('cNmSts_Keluarga');
					$istri = $this->input->post('istri');
					$anak = $this->input->post('anak');

					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_family_status($company_id_session, $cIDSts_Keluarga);

					if (count($ceck)==0) { // Add family_status
						$data=array(
							"company_id" => $company_id_session,
							"cIDSts_Keluarga" => ucwords($cIDSts_Keluarga),
							"cNmSts_Keluarga" => ucwords($cNmSts_Keluarga),
							"istri" => $istri,
							"anak" => $anak,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_family_status($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update family_status
						$data=array(
							"cNmSts_Keluarga" => ucwords($cNmSts_Keluarga),
							"istri" => $istri,
							"anak" => $anak,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_family_status($data, $cIDSts_Keluarga);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDSts_Keluarga;
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

	public function add_family_relation($key_session){
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
				$this->form_validation->set_rules('cNmHubKel', 'cNmHubKel', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDHubKel = $this->input->post('cIDHubKel');
					$cNmHubKel = $this->input->post('cNmHubKel');

					$last_update = date('Y-m-d H:i:s');

					if ($cIDHubKel=='') { // Add family_relation
						$data=array(
							"company_id" => $company_id_session,
							"cNmHubKel" => ucwords($cNmHubKel),
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_family_relation($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update family_relation
						$data=array(
							"cNmHubKel" => ucwords($cNmHubKel),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_family_relation($data, $cIDHubKel);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDHubKel;
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

	public function add_education($key_session){
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
				
				$this->form_validation->set_rules('nama_pendidikan', 'nama_pendidikan', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_pendidikan = $this->input->post('id_pendidikan');
					$nama_pendidikan = $this->input->post('nama_pendidikan');

					$last_update = date('Y-m-d H:i:s');

					if ($id_pendidikan=="") { // Add education
						$data=array(
							"company_id" => $company_id_session,
							"nama_pendidikan" => ucwords($nama_pendidikan),
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_education($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update education
						$data=array(
							"nama_pendidikan" => ucwords($nama_pendidikan),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_education($data, $id_pendidikan);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_pendidikan;
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

	public function add_religion($key_session){
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
				
				$this->form_validation->set_rules('cNmAgama', 'cNmAgama', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDAgama = $this->input->post('cIDAgama');
					$cNmAgama = $this->input->post('cNmAgama');

					$last_update = date('Y-m-d H:i:s');

					if ($cIDAgama=="") { // Add religion
						$data=array(
							"company_id" => $company_id_session,
							"cNmAgama" => ucwords($cNmAgama),
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_religion($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update religion
						$data=array(
							"cNmAgama" => ucwords($cNmAgama),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_religion($data, $cIDAgama);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDAgama;
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

	public function add_bank($key_session){
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
				
				$this->form_validation->set_rules('cNmBank', 'cNmBank', 'required');
				$this->form_validation->set_rules('cSandiBank', 'cSandiBank', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDBank = $this->input->post('cIDBank');
					$cNmBank = $this->input->post('cNmBank');
					$cSandiBank = $this->input->post('cSandiBank');

					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_bank($company_id_session, 0);
					$next_number = count($ceck)+1;
					$next_number_add_zerro = sprintf("%03d", $next_number);
					$cIDBank_new = "B".$next_number_add_zerro;

					if ($cIDBank=="") { // Add bank
						$data=array(
							"company_id" => $company_id_session,
							"cIDBank" => $cIDBank_new,
							"cNmBank" => $cNmBank,
							"cSandiBank" => $cSandiBank,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_bank($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update bank
						$data=array(
							"cNmBank" => $cNmBank,
							"cSandiBank" => $cSandiBank,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_bank($data, $cIDBank);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDBank;
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

	public function add_salary_component($key_session){
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
				$this->form_validation->set_rules('cIDKomponen', 'cIDKomponen', 'required');
				$this->form_validation->set_rules('cNmKomponen', 'cNmKomponen', 'required');
				$this->form_validation->set_rules('kategori', 'kategori', 'required');
				$this->form_validation->set_rules('trans_manual', 'trans_manual', 'required');
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDKomponen = $this->input->post('cIDKomponen');
					$cNmKomponen = $this->input->post('cNmKomponen');
					$kategori = $this->input->post('kategori');
					$trans_manual = $this->input->post('trans_manual');

					$last_update = date('Y-m-d H:i:s');

					$check = $this->m_essread->list_salary_component($company_id_session, $cIDKomponen);

					if (count($check)==0) { // Add salary_component
						$data=array(
							"company_id" => $company_id_session,
							"cIDKomponen" => ucwords($cIDKomponen),
							"cNmKomponen" => $cNmKomponen,
							"kategori" => ucwords($kategori),
							"trans_manual" => $trans_manual,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_salary_component($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update salary_component
						$data=array(
							"cNmKomponen" => $cNmKomponen,
							"kategori" => ucwords($kategori),
							"trans_manual" => $trans_manual,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_salary_component($data, $cIDKomponen);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDKomponen;
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

	public function add_salary_component_group($key_session){
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
				//$this->form_validation->set_rules('cIDKomponen_group', 'cIDKomponen_group', 'required');
				$this->form_validation->set_rules('cNmKomponen_group', 'cNmKomponen_group', 'required');
				$this->form_validation->set_rules('kategori', 'kategori', 'required');
				$this->form_validation->set_rules('cIDKomponen_multi', 'cIDKomponen_multi', 'required');
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDKomponen_group = $this->input->post('cIDKomponen_group');
					$cNmKomponen_group = $this->input->post('cNmKomponen_group');
					$kategori = $this->input->post('kategori');
					$cIDKomponen_multi = $this->input->post('cIDKomponen_multi');
					$operator = $this->input->post('operator');
					$nilai = $this->input->post('nilai');

					$last_update = date('Y-m-d H:i:s');

					if ($cIDKomponen_group=='') { // Add salary_component_group
						$data=array(
							"company_id" => $company_id_session,
							"cNmKomponen_group" => $cNmKomponen_group,
							"kategori" => ucwords($kategori),
							"cIDKomponen_multi" => $cIDKomponen_multi,
							"operator" => $operator,
							"nilai" => $nilai,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_salary_component_group($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update salary_component_group
						$data=array(
							"cNmKomponen_group" => $cNmKomponen_group,
							"kategori" => ucwords($kategori),
							"cIDKomponen_multi" => $cIDKomponen_multi,
							"operator" => $operator,
							"nilai" => $nilai,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_salary_component_group($data, $cIDKomponen_group);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDKomponen_group;
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

	public function add_data_photo($key_session){
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
				$this->form_validation->set_rules('nama_data_photo', 'nama_data_photo', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_data_photo = $this->input->post('id_data_photo');
					$nama_data_photo = $this->input->post('nama_data_photo');

					$last_update = date('Y-m-d H:i:s');

					if ($id_data_photo=='') { // Add data_photo
						$data=array(
							"company_id" => $company_id_session,
							"nama_data_photo" => ucwords($nama_data_photo),
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0,
						);
						$result = $this->m_esscreate->add_data_photo($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update data_photo
						$data=array(
							"nama_data_photo" => ucwords($nama_data_photo),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_data_photo($data, $id_data_photo);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_data_photo;
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

	public function add_blood_group($key_session){
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
				$this->form_validation->set_rules('id_golongan_darah', 'id_golongan_darah', 'required');
				$this->form_validation->set_rules('nama_golongan_darah', 'nama_golongan_darah', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_golongan_darah = $this->input->post('id_golongan_darah');
					$nama_golongan_darah = $this->input->post('nama_golongan_darah');

					$check = $this->m_essread->list_blood_group($company_id_session, $id_golongan_darah);

					$last_update = date('Y-m-d H:i:s');

					if (count($check)==0) { // Add golongan_darah
						$data=array(
							"company_id" => $company_id_session,
							"id_golongan_darah" => ucwords($id_golongan_darah),
							"nama_golongan_darah" => ucwords($nama_golongan_darah),
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0,
						);
						$result = $this->m_esscreate->add_blood_group($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update golongan_darah
						$data=array(
							"nama_golongan_darah" => ucwords($nama_golongan_darah),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_blood_group($data, $id_golongan_darah, $company_id_session);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_golongan_darah;
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

	public function add_reasons_for_resigning($key_session){
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
				//$this->form_validation->set_rules('cIDJnsBerhenti', 'cIDJnsBerhenti', 'required');
				$this->form_validation->set_rules('cNmJnsBerhenti', 'cNmJnsBerhenti', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDJnsBerhenti = $this->input->post('cIDJnsBerhenti');
					$cNmJnsBerhenti = $this->input->post('cNmJnsBerhenti');

					$last_update = date('Y-m-d H:i:s');

					if ($cIDJnsBerhenti=='') { // Add golongan_darah
						$data=array(
							"company_id" => $company_id_session,
							"cNmJnsBerhenti" => $cNmJnsBerhenti,
							"cNote" => "",
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0,
						);
						$result = $this->m_esscreate->add_reasons_for_resigning($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update golongan_darah
						$data=array(
							"cNmJnsBerhenti" => $cNmJnsBerhenti,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_reasons_for_resigning($data, $cIDJnsBerhenti, $company_id_session);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDJnsBerhenti;
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

	// Attendance

	public function add_sift_group($key_session){
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
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
				$this->form_validation->set_rules('cGroupNm', 'cGroupNm', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cGroupID = $this->input->post('cGroupID');
					$cGroupNm = $this->input->post('cGroupNm');

					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_sift_group($company_id_session, $cGroupID);


					if (count($ceck)==0) { // Add sift_group
						$data=array(
							"company_id" => $company_id_session,
							"cGroupID" => $cGroupID,
							"cGroupNm" => $cGroupNm,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_sift_group($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update sift_group
						$data=array(
							"cGroupNm" => $cGroupNm,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_sift_group($data, $cGroupID);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cGroupID;
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

	public function add_sift($key_session){
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
				$this->form_validation->set_rules('cShiftID', 'cShiftID', 'required');
				$this->form_validation->set_rules('cNmShift', 'cNmShift', 'required');
				$this->form_validation->set_rules('holiday_overtime', 'holiday_overtime', 'required');
				$this->form_validation->set_rules('x1', 'x1', 'required');
				$this->form_validation->set_rules('x2', 'x2', 'required');
				$this->form_validation->set_rules('x3', 'x3', 'required');
				$this->form_validation->set_rules('x4', 'x4', 'required');
				$this->form_validation->set_rules('color_marking', 'color_marking', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cShiftID = $this->input->post('cShiftID');
					$cNmShift = $this->input->post('cNmShift');
					$holiday_overtime = $this->input->post('holiday_overtime');
					$x1 = $this->input->post('x1');
					$x2 = $this->input->post('x2');
					$x3 = $this->input->post('x3');
					$x4 = $this->input->post('x4');
					$color_marking = $this->input->post('color_marking');

					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_sift($company_id_session, $cShiftID);


					if (count($ceck)==0) { // Add sift
						$data=array(
							"company_id" => $company_id_session,
							"cShiftID" => $cShiftID,
							"cNmShift" => $cNmShift,
							"holiday_overtime" => $holiday_overtime*1,
							"x1" => $x1*1,
							"x2" => $x2*1,
							"x3" => $x3*1,
							"x4" => $x4*1,
							"color_marking" => $color_marking,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_sift($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update sift
						$data=array(
							"cNmShift" => $cNmShift,
							"holiday_overtime" => $holiday_overtime*1,
							"x1" => $x1*1,
							"x2" => $x2*1,
							"x3" => $x3*1,
							"x4" => $x4*1,
							"color_marking" => $color_marking,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_sift($data, $cShiftID);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cShiftID;
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

	public function add_sift_time($key_session, $cShiftID){
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
				$cShiftID = $this->uri->segment('4');

				$this->form_validation->set_rules('cDayNm', 'cDayNm', 'required');
				$this->form_validation->set_rules('dIN', 'dIN', 'required');
				$this->form_validation->set_rules('dOUT', 'dOUT', 'required');
				$this->form_validation->set_rules('dRest_Start1', 'dRest_Start1', 'required');
				$this->form_validation->set_rules('dRest_End1', 'dRest_End1', 'required');
				$this->form_validation->set_rules('dRest_Start2', 'dRest_Start2', 'required');
				$this->form_validation->set_rules('dRest_End2', 'dRest_End2', 'required');
				$this->form_validation->set_rules('dRest_Start3', 'dRest_Start3', 'required');
				$this->form_validation->set_rules('dRest_End3', 'dRest_End3', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
					echo json_encode(array(array('status' => $status)));
				}
				else {
					$cDayNm = $this->input->post('cDayNm');
					$dIN = $this->input->post('dIN');
					$dOUT = $this->input->post('dOUT');
					$dRest_Start1 = $this->input->post('dRest_Start1');
					$dRest_End1 = $this->input->post('dRest_End1');
					$dRest_Start2 = $this->input->post('dRest_Start2');
					$dRest_End2 = $this->input->post('dRest_End2');
					$dRest_Start3 = $this->input->post('dRest_Start3');
					$dRest_End3 = $this->input->post('dRest_End3');

					$last_update = date('Y-m-d H:i:s');

					$cDayNm_exp = explode(',', $cDayNm);
					$dIN_exp = explode(',', $dIN);
					$dOUT_exp = explode(',', $dOUT);
					$dRest_Start1_exp = explode(',', $dRest_Start1);
					$dRest_End1_exp = explode(',', $dRest_End1);
					$dRest_Start2_exp = explode(',', $dRest_Start2);
					$dRest_End2_exp = explode(',', $dRest_End2);
					$dRest_Start3_exp = explode(',', $dRest_Start3);
					$dRest_End3_exp = explode(',', $dRest_End3);

					$data_array = array();
					$status_array = array();

					for ($i=0; $i < count($cDayNm_exp); $i++) {
						$cShiftID = $cShiftID;
						$cDayNm = $cDayNm_exp[$i];

						$ceck = $this->m_essread->cek_sift_time($company_id_session, $cShiftID, $cDayNm);

						if (count($ceck)==0) {
							$data=array(
								'company_id' => $company_id_session,
								'cShiftID' => $cShiftID,
								'cDayNm' => $cDayNm,
								'dIN' => '1900-01-01 '.$dIN_exp[$i].':00',
								'dOUT' => '1900-01-01 '.$dOUT_exp[$i].':00',
								'dRest_Start1' => '1900-01-01 '.$dRest_Start1_exp[$i].':00',
								'dRest_End1' => '1900-01-01 '.$dRest_End1_exp[$i].':00',
								'dRest_Start2' => '1900-01-01 '.$dRest_Start2_exp[$i].':00',
								'dRest_End2' => '1900-01-01 '.$dRest_End2_exp[$i].':00',
								'dRest_Start3' => '1900-01-01 '.$dRest_Start3_exp[$i].':00',
								'dRest_End3' => '1900-01-01 '.$dRest_End3_exp[$i].':00',
								'deleted' => 0,
								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_esscreate->add_sift_time($data);
							if ($result==true) {
								$status = 1;
								$responseValue = 'ok';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
							array_push($status_array, $status);
						}
						else {
							$data=array(
								'dIN' => '1900-01-01 '.$dIN_exp[$i].':00',
								'dOUT' => '1900-01-01 '.$dOUT_exp[$i].':00',
								'dRest_Start1' => '1900-01-01 '.$dRest_Start1_exp[$i].':00',
								'dRest_End1' => '1900-01-01 '.$dRest_End1_exp[$i].':00',
								'dRest_Start2' => '1900-01-01 '.$dRest_Start2_exp[$i].':00',
								'dRest_End2' => '1900-01-01 '.$dRest_End2_exp[$i].':00',
								'dRest_Start3' => '1900-01-01 '.$dRest_Start3_exp[$i].':00',
								'dRest_End3' => '1900-01-01 '.$dRest_End3_exp[$i].':00',
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							$result = $this->m_essupdate->update_sift_time($data, $cShiftID, $cDayNm);
							if ($result==true) {
								$status = 1;
								$responseValue = 'ok';
							}
							else {
								$status = 0;
								$responseValue = 'Data not saved.';
							}
							array_push($status_array, $status);
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array))));
				}
				
			}
		}
	}	

	public function add_precense_type($key_session){
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
				$this->form_validation->set_rules('cIDAbsen', 'cIDAbsen', 'required');
				$this->form_validation->set_rules('cNmAbsen', 'cNmAbsen', 'required');
				$this->form_validation->set_rules('Note', 'Note', 'required');
				$this->form_validation->set_rules('DayOff', 'DayOff', 'required');
				$this->form_validation->set_rules('PotongGaji', 'PotongGaji', 'required');
				$this->form_validation->set_rules('color_marking', 'color_marking', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIDAbsen = $this->input->post('cIDAbsen');
					$cNmAbsen = $this->input->post('cNmAbsen');
					$Note = $this->input->post('Note');
					$DayOff = $this->input->post('DayOff');
					$PotongGaji = $this->input->post('PotongGaji');
					$color_marking = $this->input->post('color_marking');

					$last_update = date('Y-m-d H:i:s');

					$ceck = $this->m_essread->list_precense_type($company_id_session, $cIDAbsen);


					if (count($ceck)==0) { // Add precense_type
						$data=array(
							"company_id" => $company_id_session,
							"cIDAbsen" => $cIDAbsen,
							"cNmAbsen" => $cNmAbsen,
							"Note" => $Note,
							"DayOff" => $DayOff*1,
							"PotongGaji" => $PotongGaji*1,
							"color_marking" => $color_marking,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_precense_type($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update precense_type
						$data=array(
							"cNmAbsen" => $cNmAbsen,
							"Note" => $Note,
							"DayOff" => $DayOff*1,
							"PotongGaji" => $PotongGaji*1,
							"color_marking" => $color_marking,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_precense_type($data, $cIDAbsen);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIDAbsen;
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

	public function add_national_holiday($key_session){
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
				$this->form_validation->set_rules('tanggal_libur_nasional', 'tanggal_libur_nasional', 'required');
				$this->form_validation->set_rules('nama_hari_libur', 'nama_hari_libur', 'required');
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_libur_nasional = $this->input->post('id_libur_nasional');
					$tanggal_libur_nasional = $this->input->post('tanggal_libur_nasional');
					$nama_hari_libur = $this->input->post('nama_hari_libur');
					$cGroupID = $this->input->post('cGroupID');

					$last_update = date('Y-m-d H:i:s');


					if ($id_libur_nasional=='') { // Add national_holiday
						$data=array(
							"company_id" => $company_id_session,
							"tanggal_libur_nasional" => $tanggal_libur_nasional,
							"nama_hari_libur" => ucwords($nama_hari_libur),
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
					else { // Update national_holiday
						$data=array(
							"tanggal_libur_nasional" => $tanggal_libur_nasional,
							"nama_hari_libur" => ucwords($nama_hari_libur),
							"cGroupID" => $cGroupID,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_national_holiday($data, $id_libur_nasional);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_libur_nasional;
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

	public function add_mandatory_overtime($key_session){
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
				$this->form_validation->set_rules('tanggal_lembur_wajib', 'tanggal_lembur_wajib', 'required');
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_lembur_wajib = $this->input->post('id_lembur_wajib');
					$tanggal_lembur_wajib = $this->input->post('tanggal_lembur_wajib');
					$cGroupID = $this->input->post('cGroupID');

					$last_update = date('Y-m-d H:i:s');


					if ($id_lembur_wajib=='') { // Add mandatory_overtime
						$data=array(
							"company_id" => $company_id_session,
							"tanggal_lembur_wajib" => $tanggal_lembur_wajib,
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
					else { // Update mandatory_overtime
						$data=array(
							"tanggal_lembur_wajib" => $tanggal_lembur_wajib,
							"cGroupID" => $cGroupID,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_mandatory_overtime($data, $id_lembur_wajib);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_lembur_wajib;
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

	public function add_change_day($key_session){
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
				$this->form_validation->set_rules('tanggal_ganti_hari', 'tanggal_ganti_hari', 'required');
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_ganti_hari = $this->input->post('id_ganti_hari');
					$tanggal_ganti_hari = $this->input->post('tanggal_ganti_hari');
					$cGroupID = $this->input->post('cGroupID');

					$last_update = date('Y-m-d H:i:s');


					if ($id_ganti_hari=='') { // Add change_day
						$data=array(
							"company_id" => $company_id_session,
							"tanggal_ganti_hari" => $tanggal_ganti_hari,
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
					else { // Update change_day
						$data=array(
							"tanggal_ganti_hari" => $tanggal_ganti_hari,
							"cGroupID" => $cGroupID,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_change_day($data, $id_ganti_hari);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_ganti_hari;
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

	public function add_ramadhan($key_session){
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
				$this->form_validation->set_rules('tahun', 'tahun', 'required');
				$this->form_validation->set_rules('tanggal_awal', 'tanggal_awal', 'required');
				$this->form_validation->set_rules('tanggal_akhir', 'tanggal_akhir', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_ramadhan = $this->input->post('id_ramadhan');
					$tahun = $this->input->post('tahun');
					$tanggal_awal = $this->input->post('tanggal_awal');
					$tanggal_akhir = $this->input->post('tanggal_akhir');

					$last_update = date('Y-m-d H:i:s');


					if ($id_ramadhan=='') { // Add ramadhan
						$data=array(
							"company_id" => $company_id_session,
							"tahun" => $tahun,
							"tanggal_awal" => $tanggal_awal,
							"tanggal_akhir" => $tanggal_akhir,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_ramadhan($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update ramadhan
						$data=array(
							"tahun" => $tahun,
							"tanggal_awal" => $tanggal_awal,
							"tanggal_akhir" => $tanggal_akhir,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_ramadhan($data, $id_ramadhan);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_ramadhan;
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

	public function add_attendance_periode($key_session){
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
				$this->form_validation->set_rules('cIdPeriod', 'cIdPeriod', 'required');
				$this->form_validation->set_rules('cNmPeriod', 'cNmPeriod', 'required');
				$this->form_validation->set_rules('dTglPeriod_Start', 'dTglPeriod_Start', 'required');
				$this->form_validation->set_rules('dTglPeriod_End', 'dTglPeriod_End', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cIdPeriod = $this->input->post('cIdPeriod');
					$cNmPeriod = $this->input->post('cNmPeriod');
					$dTglPeriod_Start = $this->input->post('dTglPeriod_Start');
					$dTglPeriod_End = $this->input->post('dTglPeriod_End');

					$last_update = date('Y-m-d H:i:s');

					$check = $this->m_essread->list_attendance_periode($company_id_session, $cIdPeriod);


					if (count($check)==0) { // Add attendance_periode
						$data=array(
							"company_id" => $company_id_session,
							"cIdPeriod" => $cIdPeriod,
							"cNmPeriod" => ucwords($cNmPeriod),
							"dTglPeriod_Start" => $dTglPeriod_Start,
							"dTglPeriod_End" => $dTglPeriod_End,
							"status" => 0,
							"dTglClose" => null,
							"deleted" => 0,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_attendance_periode($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update attendance_periode
						$data=array(
							"cNmPeriod" => ucwords($cNmPeriod),
							"dTglPeriod_Start" => $dTglPeriod_Start,
							"dTglPeriod_End" => $dTglPeriod_End,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_attendance_periode($data, $cIdPeriod);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cIdPeriod;
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

	// Attendance Record

	public function add_change_sift($key_session){
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
				$this->form_validation->set_rules('cGroupID', 'cGroupID', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
					$cGroupID = $this->input->post('cGroupID');

					$last_update = date('Y-m-d H:i:s');

					$check = $this->m_essread->list_change_sift($company_id_session, $cNIK);

					if (count($check)==0) { // Add change_sift
						$data=array(
							"company_id" => $company_id_session,
							"cNIK" => $cNIK,
							"cGroupID" => ucwords($cGroupID),
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_esscreate->add_change_sift($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update change_sift
						$data=array(
							"cGroupID" => ucwords($cGroupID),
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_change_sift($data, $cNIK);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$cNIK;
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

	// Employee

	public function add_personal_data($key_session){
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
			    $this->form_validation->set_rules('cNmPegawai', 'cNmPegawai', 'required');
			    $this->form_validation->set_rules('cNmPanggilan', 'cNmPanggilan', 'required');
			    $this->form_validation->set_rules('cTempatLahir', 'cTempatLahir', 'required');
			    $this->form_validation->set_rules('dTglLhr', 'dTglLhr', 'required');
			    $this->form_validation->set_rules('cAlamat', 'cAlamat', 'required');
			    $this->form_validation->set_rules('cKota', 'cKota', 'required');
			    $this->form_validation->set_rules('cKdPos', 'cKdPos', 'required');
			    $this->form_validation->set_rules('cTelp1', 'cTelp1', 'required');
			    $this->form_validation->set_rules('cTelp2', 'cTelp2', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $cNmPegawai = $this->input->post('cNmPegawai');
				    $cNmPanggilan = $this->input->post('cNmPanggilan');
				    $cTempatLahir = $this->input->post('cTempatLahir');
				    $dTglLhr = $this->input->post('dTglLhr');
				    $cAlamat = $this->input->post('cAlamat');
				    $cKota = $this->input->post('cKota');
				    $cKdPos = $this->input->post('cKdPos');
				    $cTelp1 = $this->input->post('cTelp1');
				    $cTelp2 = $this->input->post('cTelp2');

				    $last_update = date('Y-m-d H:i:s');

				    $check = $this->m_essread->personal_data($company_id_session, $cNIK);

				    if (count($check)==0) { // New Employee
				    	$data = array(
				    		"company_id" => $company_id_session,
				    		"cNIK" => $cNIK,
				    		"cNoAbsen" => null,
						    "cNmPegawai" => $cNmPegawai,
						    "cNmPanggilan" => $cNmPanggilan,
						    "cTempatLahir" => $cTempatLahir,
						    "dTglLhr" => $dTglLhr,
						    "cAlamat" => $cAlamat,
						    "cKota" => $cKota,
						    "cKdPos" => $cKdPos,
						    "cTelp1" => $cTelp1,
						    "cTelp2" => $cTelp2,
							"dTglGabung" => null,
							"dTglGabung2" => null,
							"cNoKTP" => null,
							"cAlamatKTP" => null,
							"cKotaKTP" => null,
							"cKdPosKTP" => null,
							"cNPWP" => null,
							"cAlamatNPWP" => null,
							"cKotaNPWP" => null,
							"cKdPosNPWP" => null,
							"cNoJST" => null,
							"dTglJST" => null,
							"cNoBPJS" => null,
							"dTglBPJS" => null,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_esscreate->add_personal_data($data);
				    	if ($result==true) {
				    		$status = 1;
				    		$responseValue = '';
				    	}
				    	else {
				    		$status = 0;
				    		$responseValue = 'Data not saved.';
				    	}
				    }
				    else { // Update Employee
				    	$data = array(
						    "cNmPegawai" => $cNmPegawai,
						    "cNmPanggilan" => $cNmPanggilan,
						    "cTempatLahir" => $cTempatLahir,
						    "dTglLhr" => $dTglLhr,
						    "cAlamat" => $cAlamat,
						    "cKota" => $cKota,
						    "cKdPos" => $cKdPos,
						    "cTelp1" => $cTelp1,
						    "cTelp2" => $cTelp2,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_data($data, $cNIK);
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

	public function add_personal_education($key_session){
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
			    $this->form_validation->set_rules('id_pendidikan', 'id_pendidikan', 'required');
			    $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
			    $this->form_validation->set_rules('bidang_study', 'bidang_study', 'required');
			    $this->form_validation->set_rules('tahun_lulus', 'tahun_lulus', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $id_pendidikan = $this->input->post('id_pendidikan');
				    $keterangan = $this->input->post('keterangan');
				    $bidang_study = $this->input->post('bidang_study');
				    $tahun_lulus = $this->input->post('tahun_lulus');

				    $last_update = date('Y-m-d H:i:s');

				    $check = $this->m_essread->education($company_id_session, $cNIK);

				    if (count($check)==0) { // New Employee
				    	$data = array(
				    		"company_id" => $company_id_session,
				    		"cNIK" => $cNIK,
						    "id_pendidikan" => $id_pendidikan,
						    "keterangan" => $keterangan,
						    "bidang_study" => $bidang_study,
						    "tahun_lulus" => $tahun_lulus,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_esscreate->add_personal_education($data);
				    	if ($result==true) {
				    		$status = 1;
				    		$responseValue = '';
				    	}
				    	else {
				    		$status = 0;
				    		$responseValue = 'Data not saved.';
				    	}
				    }
				    else { // Update Employee
				    	$data = array(
						    "id_pendidikan" => $id_pendidikan,
						    "keterangan" => $keterangan,
						    "bidang_study" => $bidang_study,
						    "tahun_lulus" => $tahun_lulus,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_education($data, $cNIK);
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

	public function add_personal_account($key_session){
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
			    $this->form_validation->set_rules('cNoAbsen', 'cNoAbsen', 'required');
			    $this->form_validation->set_rules('email', 'email', 'required');
			    $this->form_validation->set_rules('Pwd', 'Pwd', 'required');

			    /*$this->form_validation->set_rules('cNoAbsen_old', 'cNoAbsen_old', 'required');
			    $this->form_validation->set_rules('email_old', 'email_old', 'required');
			    $this->form_validation->set_rules('Pwd_old', 'Pwd_old', 'required');*/

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $cNoAbsen = $this->input->post('cNoAbsen');
				    $email = $this->input->post('email');
				    $Pwd = $this->input->post('Pwd');
				    $cNoAbsen_old = $this->input->post('cNoAbsen_old');
				    $email_old = $this->input->post('email_old');
				    $Pwd_old = $this->input->post('Pwd_old');

				    $last_update = date('Y-m-d H:i:s');

				    if ($cNoAbsen!=$cNoAbsen_old) { // No Absen Not same
				    	$data = array(
				    		'cNoAbsen' => $cNoAbsen,
				    		'last_by' => $cNIK_session,
				    		'last_update' => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_data($data, $cNIK);
				    	if ($result==true) {
				    		if ($email!=$email_old) {
				    			$check_email = $this->m_essread->email_personal_data($company_id_session, $cNIK);
					    		if (count($check_email)==0) {
					    			$data = array(
					    				'company_id' => $company_id_session,
					    				'cNIK' => $cNIK,
					    				'email' => $email,
					    				'create_by' => $cNIK_session,
					    				'create_date' => $last_update,
					    				'last_by' => $cNIK_session,
					    				'last_update' => $last_update,
					    			);
					    			$result_2 = $this->m_esscreate->add_email_personal_data($data);
					    			if ($result_2==true) {
					    				$check_pw = $this->m_essread->personal_data_pw($company_id_session, $cNIK);
					    				if (count($check_pw)==0) {
					    					$data = array(
					    						'company_id' => $company_id_session,
					    						'UserID' => $cNIK,
					    						'Pwd' => $Pwd,
					    						'create_by' => $cNIK_session,
							    				'create_date' => $last_update,
							    				'last_by' => $cNIK_session,
							    				'last_update' => $last_update,
					    					);
					    					$result_3 = $this->m_esscreate->add_personal_data_pw($data);
					    					if ($result_3==true) {
							    				$status = 1;
							    				$responseValue = '';
							    			}
							    			else {
							    				$status = 0;
							    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
							    			}
					    				}
					    				else {
					    					$data = array(
					    						'Pwd' => $Pwd,
							    				'last_by' => $cNIK_session,
							    				'last_update' => $last_update,
					    					);
					    					$result_3 = $this->m_esscreate->update_personal_data_pw($data, $cNIK);
					    					if ($result_3==true) {
							    				$status = 1;
							    				$responseValue = '';
							    			}
							    			else {
							    				$status = 0;
							    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
							    			}
					    				}
					    			}
					    			else {
					    				$status = 0;
					    				$responseValue = 'Data Attendance ID saved, but Data Email not saved.';
					    			}
					    		}
					    		else {
					    			$data = array(
					    				'email' => $email,
					    				'last_by' => $cNIK_session,
					    				'last_update' => $last_update,
					    			);
					    			$result_2 = $this->m_essupdate->update_email_personal_data($data, $cNIK);
					    			if ($result_2==true) {
					    				if ($Pwd!=$Pwd_old) {
					    					$check_pw = $this->m_essread->personal_data_pw($company_id_session, $cNIK);
						    				if (count($check_pw)==0) {
						    					$data = array(
						    						'company_id' => $company_id_session,
						    						'UserID' => $cNIK,
						    						'Pwd' => $Pwd,
						    						'create_by' => $cNIK_session,
								    				'create_date' => $last_update,
								    				'last_by' => $cNIK_session,
								    				'last_update' => $last_update,
						    					);
						    					$result_3 = $this->m_esscreate->add_personal_data_pw($data);
						    					if ($result_3==true) {
								    				$status = 1;
								    				$responseValue = '';
								    			}
								    			else {
								    				$status = 0;
								    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
								    			}
						    				}
						    				else {
						    					$data = array(
						    						'Pwd' => $Pwd,
								    				'last_by' => $cNIK_session,
								    				'last_update' => $last_update,
						    					);
						    					$result_3 = $this->m_essupdate->update_personal_data_pw($data, $cNIK);
						    					if ($result_3==true) {
								    				$status = 1;
								    				$responseValue = '';
								    			}
								    			else {
								    				$status = 0;
								    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
								    			}
						    				}
					    				}
					    				else {
					    					$status = 1;
				    						$responseValue = '';
					    				}
					    			}
					    			else {
					    				$status = 0;
					    				$responseValue = 'Data Attendance ID saved, but Data Email not saved.';
					    			}
					    		}
				    		}
				    		else {
				    			$status = 1;
				    			$responseValue = '';
				    		}
				    	}
				    	else {
				    		$status = 0;
				    		$responseValue = 'Data Attendance ID not saved.';
				    	}
				    }
				    else { // No Absen same
				    	if ($email!=$email_old) {
			    			$check_email = $this->m_essread->email_personal_data($company_id_session, $cNIK);
				    		if (count($check_email)==0) {
				    			$data = array(
				    				'company_id' => $company_id_session,
				    				'cNIK' => $cNIK,
				    				'email' => $email,
				    				'create_by' => $cNIK_session,
				    				'create_date' => $last_update,
				    				'last_by' => $cNIK_session,
				    				'last_update' => $last_update,
				    			);
				    			$result_2 = $this->m_esscreate->add_email_personal_data($data);
				    			if ($result_2==true) {
				    				if ($Pwd!=$Pwd_old) {
				    					$check_pw = $this->m_essread->personal_data_pw($company_id_session, $cNIK);
					    				if (count($check_pw)==0) {
					    					$data = array(
					    						'company_id' => $company_id_session,
					    						'UserID' => $cNIK,
					    						'Pwd' => $Pwd,
					    						'create_by' => $cNIK_session,
							    				'create_date' => $last_update,
							    				'last_by' => $cNIK_session,
							    				'last_update' => $last_update,
					    					);
					    					$result_3 = $this->m_esscreate->add_personal_data_pw($data);
					    					if ($result_3==true) {
							    				$status = 1;
							    				$responseValue = '';
							    			}
							    			else {
							    				$status = 0;
							    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
							    			}
					    				}
					    				else {
					    					$data = array(
					    						'Pwd' => $Pwd,
							    				'last_by' => $cNIK_session,
							    				'last_update' => $last_update,
					    					);
					    					$result_3 = $this->m_essupdate->update_personal_data_pw($data, $cNIK);
					    					if ($result_3==true) {
							    				$status = 1;
							    				$responseValue = '';
							    			}
							    			else {
							    				$status = 0;
							    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
							    			}
					    				}
				    				}
				    				else {
				    					$status = 1;
			    						$responseValue = '';
				    				}
				    			}
				    			else {
				    				$status = 0;
				    				$responseValue = 'Data Attendance ID saved, but Data Email not saved.';
				    			}
				    		}
				    		else {
				    			$data = array(
				    				'email' => $email,
				    				'last_by' => $cNIK_session,
				    				'last_update' => $last_update,
				    			);
				    			$result_2 = $this->m_essupdate->update_email_personal_data($data, $cNIK);
				    			if ($result_2==true) {
				    				$check_pw = $this->m_essread->personal_data_pw($company_id_session, $cNIK);
				    				if (count($check_pw)==0) {
				    					$data = array(
				    						'company_id' => $company_id_session,
				    						'UserID' => $cNIK,
				    						'Pwd' => $Pwd,
				    						'create_by' => $cNIK_session,
						    				'create_date' => $last_update,
						    				'last_by' => $cNIK_session,
						    				'last_update' => $last_update,
				    					);
				    					$result_3 = $this->m_esscreate->add_personal_data_pw($data);
				    					if ($result_3==true) {
						    				$status = 1;
						    				$responseValue = '';
						    			}
						    			else {
						    				$status = 0;
						    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
						    			}
				    				}
				    				else {
				    					$data = array(
				    						'Pwd' => $Pwd,
						    				'last_by' => $cNIK_session,
						    				'last_update' => $last_update,
				    					);
				    					$result_3 = $this->m_essupdate->update_personal_data_pw($data, $cNIK);
				    					if ($result_3==true) {
						    				$status = 1;
						    				$responseValue = '';
						    			}
						    			else {
						    				$status = 0;
						    				$responseValue = 'Data Attendance ID saved, Data Email saved, but Data Password not saved.';
						    			}
				    				}
				    			}
				    			else {
				    				$status = 0;
				    				$responseValue = 'Data Attendance ID saved, but Data Email not saved.';
				    			}
				    		}
			    		}
			    		else {
			    			$status = 1;
			    			$responseValue = '';
			    		}
				    }
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	public function add_personal_potition($key_session){
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
			    $this->form_validation->set_rules('update_potition', 'update_potition', 'required');
			    $this->form_validation->set_rules('cIDDept', 'cIDDept', 'required');
			    $this->form_validation->set_rules('cIDBag', 'cIDBag', 'required');
			    $this->form_validation->set_rules('dBerlaku_Dari', 'dBerlaku_Dari', 'required');
			    $this->form_validation->set_rules('cIDJbtn', 'cIDJbtn', 'required');
			    $this->form_validation->set_rules('cIDStsKrj', 'cIDStsKrj', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
					$update_potition = $this->input->post('update_potition');
				    $cIDDept = $this->input->post('cIDDept');
				    $cIDBag = $this->input->post('cIDBag');
				    $dBerlaku_Dari = $this->input->post('dBerlaku_Dari');
				    $dBerlaku_Dari_2 = new DateTime($dBerlaku_Dari);
				    $dBerlaku_Sdgn = $dBerlaku_Dari_2->modify("-1 days")->format('Y-m-d');
				    $cIDJbtn = $this->input->post('cIDJbtn');
				    $cIDStsKrj = $this->input->post('cIDStsKrj');

				    $last_update = date('Y-m-d H:i:s');

				    if ($update_potition==1) {
				    	$data = array(
				    		"cIDBag" => $cIDBag,
						    "cIDJbtn" => $cIDJbtn,
						    "cIDStsKrj" => $cIDStsKrj,
						    "dBerlaku_Dari" => $dBerlaku_Dari,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result_update = $this->m_essupdate->update_personal_potition($data, $cNIK);
				    	if ($result_update==true) {
				    		$status = 1;
				    		$responseValue = '';
				    	}
				    	else {
				    		$status = 0;
				    		$responseValue = 'Data not saved.';
				    	}
				    }
				    else {
				    	$data = array(
						    "dBerlaku_Sdgn" => $dBerlaku_Sdgn,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result_update = $this->m_essupdate->update_personal_potition($data, $cNIK);
				    	if ($result_update==true) {
				    		$data = array(
					    		"company_id" => $company_id_session,
					    		"cNIK" => $cNIK,
							    "cIDBag" => $cIDBag,
							    "cIDJbtn" => $cIDJbtn,
							    "cIDStsKrj" => $cIDStsKrj,
							    "cNoSK" => null,
							    "dTglSK" => null,
							    "lPromosi" => null,
							    "cNote" => null,
							    "dBerlaku_Dari" => $dBerlaku_Dari,
							    "dBerlaku_Sdgn" => null,
								"create_by" => $cNIK_session,
								"create_date" => $last_update,
								"last_by" => $cNIK_session,
								"last_update" => $last_update,
					    	);
					    	$result = $this->m_esscreate->add_personal_potition($data);
					    	if ($result==true) {
					    		$status = 1;
					    		$responseValue = '';
					    	}
					    	else {
					    		$status = 0;
					    		$responseValue = 'Data not saved.';
					    	}
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

	public function add_personal_join_date($key_session){
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
			    $this->form_validation->set_rules('dTglGabung', 'dTglGabung', 'required');
			    $this->form_validation->set_rules('dTglGabung2', 'dTglGabung2', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $dTglGabung = $this->input->post('dTglGabung');
				    $dTglGabung2 = $this->input->post('dTglGabung2');

				    $last_update = date('Y-m-d H:i:s');

			    	$data = array(
					    "dTglGabung" => $dTglGabung,
					    "dTglGabung2" => $dTglGabung2,
					    "last_by" => $cNIK_session,
						"last_update" => $last_update,
			    	);
			    	$result = $this->m_essupdate->update_personal_data($data, $cNIK);
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

	public function add_personal_plant($key_session){
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
			    $this->form_validation->set_rules('plant', 'plant', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $plant = $this->input->post('plant');

				    $last_update = date('Y-m-d H:i:s');

				    $check = $this->m_essread->plant($company_id_session, $cNIK);

				    if (count($check)==0) { // New Employee
				    	$data = array(
				    		"company_id" => $company_id_session,
				    		"cNIK" => $cNIK,
						    "plant" => $plant,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_esscreate->add_personal_plant($data);
				    	if ($result==true) {
				    		$status = 1;
				    		$responseValue = '';
				    	}
				    	else {
				    		$status = 0;
				    		$responseValue = 'Data not saved.';
				    	}
				    }
				    else { // Update Employee
				    	$data = array(
						    "plant" => $plant,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_plant($data, $cNIK);
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

	public function add_personal_id_card($key_session){
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
			    $this->form_validation->set_rules('cNoKTP', 'cNoKTP', 'required');
			    $this->form_validation->set_rules('cAlamatKTP', 'cAlamatKTP', 'required');
			    $this->form_validation->set_rules('cKotaKTP', 'cKotaKTP', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $cNoKTP = $this->input->post('cNoKTP');
				    $cAlamatKTP = $this->input->post('cAlamatKTP');
				    $cKotaKTP = $this->input->post('cKotaKTP');

				    $last_update = date('Y-m-d H:i:s');

			    	$data = array(
					    "cNoKTP" => $cNoKTP,
					    "cAlamatKTP" => $cAlamatKTP,
					    "cKotaKTP" => $cKotaKTP,
					    "last_by" => $cNIK_session,
						"last_update" => $last_update,
			    	);
			    	$result = $this->m_essupdate->update_personal_data($data, $cNIK);
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

	public function add_personal_tax_card($key_session){
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
			    $this->form_validation->set_rules('cNPWP', 'cNPWP', 'required');
			    $this->form_validation->set_rules('cAlamatNPWP', 'cAlamatNPWP', 'required');
			    $this->form_validation->set_rules('cKotaNPWP', 'cKotaNPWP', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $cNPWP = $this->input->post('cNPWP');
				    $cAlamatNPWP = $this->input->post('cAlamatNPWP');
				    $cKotaNPWP = $this->input->post('cKotaNPWP');

				    $last_update = date('Y-m-d H:i:s');

			    	$data = array(
					    "cNPWP" => $cNPWP,
					    "cAlamatNPWP" => $cAlamatNPWP,
					    "cKotaNPWP" => ucwords($cKotaNPWP),
					    "last_by" => $cNIK_session,
						"last_update" => $last_update,
			    	);
			    	$result = $this->m_essupdate->update_personal_data($data, $cNIK);
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

	public function add_personal_bpjs($key_session){
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
			    $this->form_validation->set_rules('cNoBPJS', 'cNoBPJS', 'required');
			    $this->form_validation->set_rules('dTglBPJS', 'dTglBPJS', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $cNoBPJS = $this->input->post('cNoBPJS');
				    $dTglBPJS = $this->input->post('dTglBPJS');

				    $last_update = date('Y-m-d H:i:s');

			    	$data = array(
					    "cNoBPJS" => $cNoBPJS,
					    "dTglBPJS" => $dTglBPJS,
					    "last_by" => $cNIK_session,
						"last_update" => $last_update,
			    	);
			    	$result = $this->m_essupdate->update_personal_data($data, $cNIK);
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

	public function add_personal_naker($key_session){
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
			    $this->form_validation->set_rules('cNoJST', 'cNoJST', 'required');
			    $this->form_validation->set_rules('dTglJST', 'dTglJST', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $cNoJST = $this->input->post('cNoJST');
				    $dTglJST = $this->input->post('dTglJST');

				    $last_update = date('Y-m-d H:i:s');

			    	$data = array(
					    "cNoJST" => $cNoJST,
					    "dTglJST" => $dTglJST,
					    "last_by" => $cNIK_session,
						"last_update" => $last_update,
			    	);
			    	$result = $this->m_essupdate->update_personal_data($data, $cNIK);
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

	public function add_personal_family($key_session){
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
			    $this->form_validation->set_rules('update_family', 'update_family', 'required');
			    $this->form_validation->set_rules('cNama', 'cNama', 'required');
			    $this->form_validation->set_rules('dTglLhr', 'dTglLhr', 'required');
			    $this->form_validation->set_rules('cTempat_Lhr', 'cTempat_Lhr', 'required');
			    $this->form_validation->set_rules('cJnsKel_select', 'cJnsKel_select', 'required');
			    $this->form_validation->set_rules('cIDHubKel_select', 'cIDHubKel_select', 'required');
			    $this->form_validation->set_rules('cIDAgama_select', 'cIDAgama_select', 'required');
			    $this->form_validation->set_rules('cGolDrh_select', 'cGolDrh_select', 'required');
			    $this->form_validation->set_rules('lNikah_select', 'lNikah_select', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
					$update_family = $this->input->post('update_family');
				    $cNama = $this->input->post('cNama');
				    $dTglLhr = $this->input->post('dTglLhr');
				    $cTempat_Lhr = $this->input->post('cTempat_Lhr');
				    $cJnsKel = $this->input->post('cJnsKel_select');
				    $cIDHubKel = $this->input->post('cIDHubKel_select');
				    $cIDAgama = $this->input->post('cIDAgama_select');
				    $cGolDrh = $this->input->post('cGolDrh_select');
				    $lNikah = $this->input->post('lNikah_select');
				    $dTglNikah = $this->input->post('dTglNikah');

				    $last_update = date('Y-m-d H:i:s');

				    if ($update_family==1) {
				    	$data = array(
						    'cNama' => $cNama,
						    'dTglLhr' => $dTglLhr,
						    'cTempat_Lhr' => $cTempat_Lhr,
						    'cJnsKel' => $cJnsKel,
						    'cIDAgama' => $cIDAgama,
						    'cGolDrh' => $cGolDrh,
						    'lNikah' => $lNikah,
						    'dTglNikah' => $dTglNikah,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_family($data, $cNIK, $cIDHubKel);
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
				    	$check = $this->m_essread->family_by_relation($company_id_session, $cNIK, $cIDHubKel);

					    if (count($check)==0) {
					    	$data = array(
					    		'company_id' => $company_id_session,
							    'cNIK' => $cNIK,
							    'cNama' => $cNama,
							    'dTglLhr' => $dTglLhr,
							    'cTempat_Lhr' => $cTempat_Lhr,
							    'cJnsKel' => $cJnsKel,
							    'cIDHubKel' => $cIDHubKel,
							    'cIDAgama' => $cIDAgama,
							    'cGolDrh' => $cGolDrh,
							    'lNikah' => $lNikah,
							    'dTglNikah' => $dTglNikah,
							    'cPekerjaan' => null,
							    'cAlamat' => null,
							    'cTelp' => null,
							    'cNote' => null,
							    'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
					    	);
					    	$result = $this->m_esscreate->add_personal_family($data);
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
					    	$data = array(
							    'cNama' => $cNama,
							    'dTglLhr' => $dTglLhr,
							    'cTempat_Lhr' => $cTempat_Lhr,
							    'cJnsKel' => $cJnsKel,
							    'cIDAgama' => $cIDAgama,
							    'cGolDrh' => $cGolDrh,
							    'lNikah' => $lNikah,
							    'dTglNikah' => $dTglNikah,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
					    	);
					    	$result = $this->m_essupdate->update_personal_family($data, $cNIK, $cIDHubKel);
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
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	public function add_personal_tax($key_session){
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
			    $this->form_validation->set_rules('tax_bpjs', 'tax_bpjs', 'required');
			    $this->form_validation->set_rules('tax_pph21', 'tax_pph21', 'required');
			    $this->form_validation->set_rules('tahun', 'tahun', 'required');
			    $this->form_validation->set_rules('dBerlaku_Dari', 'dBerlaku_Dari', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $tax_bpjs = $this->input->post('tax_bpjs');
				    $tax_pph21 = $this->input->post('tax_pph21');
				    $tahun = $this->input->post('tahun');
				    $dBerlaku_Dari = $this->input->post('dBerlaku_Dari');
				    $dBerlaku_Dari_2 = new DateTime($dBerlaku_Dari);
				    $dBerlaku_Sdgn = $dBerlaku_Dari_2->modify("-1 days")->format('Y-m-d');

				    $last_update = date('Y-m-d H:i:s');

				    $check = $this->m_essread->tax_by_year($company_id_session, $cNIK, $tahun);

				    if (count($check)>=1) {
				    	$data = array(
				    		"tax_bpjs" => $tax_bpjs,
				    		"tax_pph21" => $tax_pph21,
						    "dBerlaku_Dari" => $dBerlaku_Dari,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_tax_by_year($data, $cNIK, $tahun);
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
			    		$data = array(
						    "company_id" => $company_id_session,
						    "cNIK" => $cNIK,
						    "tax_bpjs" => $tax_bpjs,
						    "tax_pph21" => $tax_pph21,
						    "tahun" => $tahun,
						    "dBerlaku_Dari" => $dBerlaku_Dari,
						    "dBerlaku_Sdgn" => null,
						    "create_by" => $cNIK_session,
							"create_date" => $last_update,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result_add = $this->m_esscreate->add_personal_tax($data, $cNIK);
				    	if ($result_add==true) {
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

	public function add_personal_insurance($key_session){
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
			    $this->form_validation->set_rules('no_pes', 'no_pes', 'required');
			    $this->form_validation->set_rules('bulan', 'bulan', 'required');
			    $this->form_validation->set_rules('Jml_Bln', 'Jml_Bln', 'required');
			    $this->form_validation->set_rules('dBerlaku_Dari', 'dBerlaku_Dari', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $no_pes = $this->input->post('no_pes');
				    $bulan = $this->input->post('bulan');
				    $Jml_Bln = $this->input->post('Jml_Bln');
				    $dBerlaku_Dari = $this->input->post('dBerlaku_Dari');
				    $dBerlaku_Dari_2 = new DateTime($dBerlaku_Dari);
				    $dBerlaku_Sdgn = $dBerlaku_Dari_2->modify("-1 days")->format('Y-m-d');

				    $last_update = date('Y-m-d H:i:s');

			    	$data = array(
			    		"status" => 0,
					    "dBerlaku_Sdgn" => $dBerlaku_Sdgn,
					    "last_by" => $cNIK_session,
						"last_update" => $last_update,
			    	);
			    	$result = $this->m_essupdate->update_personal_insurance($data, $cNIK);
			    	if ($result==true) {
			    		$data = array(
						    "company_id" => $company_id_session,
						    "cNIK" => $cNIK,
						    "No_Peserta" => $no_pes,
						    "Total" => $bulan*$Jml_Bln,
						    "Jml_Bln" => $Jml_Bln,
						    "Per_Bulan" => $bulan,
						    "status" => 0,
						    "dBerlaku_Dari" => $dBerlaku_Dari,
						    "dBerlaku_Sdgn" => null,
						    "create_by" => $cNIK_session,
							"create_date" => $last_update,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result_add = $this->m_esscreate->add_personal_insurance($data, $cNIK);
				    	if ($result_add==true) {
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
			    		$responseValue = 'Data not updated.';
			    	}
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	public function add_personal_bank_account($key_session){
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
			    $this->form_validation->set_rules('update_bank', 'update_bank', 'required');
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
				    $update_bank = $this->input->post('update_bank');
				    $cIDBank = $this->input->post('cIDBank');
				    $cNoAccount = $this->input->post('cNoAccount');
				    $cNmPemilik = $this->input->post('cNmPemilik');
				    $cAlmBank = $this->input->post('cAlmBank');
				    $dCity = $this->input->post('dCity');

				    $last_update = date('Y-m-d H:i:s');

				    if ($update_bank==1) {
				    	$data = array(
				    		"cNoAccount" => $cNoAccount,
						    "cNmPemilik" => $cNmPemilik,
						    "cAlmBank" => $cAlmBank,
						    "dCity" => $dCity,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_bank_account_by_bank($data, $cNIK, $cIDBank);
				    	if ($result==true) {
				    		$status = 1;
				    		$responseValue = '';
				    	}
				    	else {
				    		$status = 0;
				    		$responseValue = 'Data not updated.';
				    	}
				    }
				    else{
				    	$data = array(
				    		"deleted" => 1,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_bank_account($data, $cNIK);
				    	if ($result==true) {
				    		$data = array(
							    "company_id" => $company_id_session,
							    "cNIK" => $cNIK,
							    "cIDBank" => $cIDBank,
							    "cNoAccount" => $cNoAccount,
							    "cNmPemilik" => $cNmPemilik,
							    "cAlmBank" => $cAlmBank,
							    "dCity" => $dCity,
							    "deleted" => 0,
							    "create_by" => $cNIK_session,
								"create_date" => $last_update,
							    "last_by" => $cNIK_session,
								"last_update" => $last_update,
					    	);
					    	$result_add = $this->m_esscreate->add_personal_bank_account($data, $cNIK);
					    	if ($result_add==true) {
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
				    		$responseValue = 'Data not updated.';
				    	}
				    }
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	public function add_personal_salary($key_session){
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
			    $this->form_validation->set_rules('update_salary', 'update_salary', 'required');
			    $this->form_validation->set_rules('cIDKomponen', 'cIDKomponen', 'required');
			    $this->form_validation->set_rules('nNilai', 'nNilai', 'required');
			    $this->form_validation->set_rules('dBerlaku_Dari', 'dBerlaku_Dari', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK = $this->input->post('cNIK');
				    $update_salary = $this->input->post('update_salary');
				    $cIDKomponen = $this->input->post('cIDKomponen');
				    $nNilai = $this->input->post('nNilai');
				    $dBerlaku_Dari = $this->input->post('dBerlaku_Dari');
				    $dBerlaku_Dari_2 = new DateTime($dBerlaku_Dari);
				    $dBerlaku_Sdgn = $dBerlaku_Dari_2->modify("-1 days")->format('Y-m-d');

				    $last_update = date('Y-m-d H:i:s');

				    if ($update_salary==1) {
				    	$data = array(
				    		"nNilai" => $nNilai,
						    "dBerlaku_Dari" => $dBerlaku_Dari,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_salary($data, $cNIK, $cIDKomponen);
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
				    	$data = array(
				    		"deleted" => 1,
						    "dBerlaku_Sdgn" => $dBerlaku_Sdgn,
						    "last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_personal_salary($data, $cNIK, $cIDKomponen);
				    	if ($result==true) {
				    		$data = array(
							    "company_id" => $company_id_session,
							    "cNIK" => $cNIK,
							    "cIDKomponen" => $cIDKomponen,
							    "nNilai" => $nNilai,
							    "dBerlaku_Dari" => $dBerlaku_Dari,
							    "dBerlaku_Sdgn" => null,
							    "deleted" => 0,
							    "create_by" => $cNIK_session,
								"create_date" => $last_update,
							    "last_by" => $cNIK_session,
								"last_update" => $last_update,
					    	);
					    	$result_add = $this->m_esscreate->add_personal_salary($data, $cNIK);
					    	if ($result_add==true) {
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
				    		$responseValue = 'Data not updated.';
				    	}
				    }
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
			}
		}
	}

	// upload data photo

	public function upload_data_photo($key_session, $id_data_photo){
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
				function generateRandomString($length = 16) {
				    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				    $charactersLength = strlen($characters);
				    $randomString = '';
				    for ($i = 0; $i < $length; $i++) {
				        $randomString .= $characters[rand(0, $charactersLength - 1)];
				    }
				    return $randomString;
				}

				$id_data_photo = $this->uri->segment('4');
				$cNIK = $this->input->post('cNIK');
			    $file = $this->input->post('file');
			    $image = $_FILES["file"]['name'];
			    $image_type = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
				$photo_name = generateRandomString();
				$new_photo_name = $cNIK.'_'.$id_data_photo.'_'.$photo_name.'.'.$image_type;

				//$config['encrypt_name'] = true;
				$config['file_name'] = $new_photo_name;
				$config['allowed_types'] = "jpg|png|jpeg|JPEG|JPG|PNG";
				$config['max_size'] = "3048000";
				$config['overwrite'] = TRUE;
				$config['upload_path'] = "./assets/images/photo/";

				$last_update = date('Y-m-d H:i:s');

				/*if (!is_dir($config['upload_path'])) {
		            mkdir($config['upload_path']);
		        }*/

		        $this->upload->initialize($config);

		        //Load upload library
				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('file')){
					$error = array('msg' => $this->upload->display_errors());
					$status = 0;
					$responseValue = $error;
				}
				else {
					$check = $this->m_essread->data_photo($company_id_session, $cNIK, $id_data_photo);
			        if (count($check)==0) {
			        	$data = array(
							"company_id" => $company_id_session,
							"cNIK" => $cNIK,
							"kategori" => $id_data_photo,
							"photo" => $new_photo_name,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0
						);
						$result = $this->m_esscreate->upload_data_photo($data);
						if ($result==true) {
							$status = 1;
							$url_photo = base_url().'assets/images/photo/'.$new_photo_name;
							$responseValue = '';
						}
						else {
							$status = 0;
							$url_photo = '';
							$responseValue = 'Data not saved.';
						}						
			        }
			        else {
			        	foreach ($check as $resultList);
			        	$photo_get = $resultList->photo;
			        	$remove_photo = unlink ('./assets/images/photo/'.$photo_get);
			        	if ($remove_photo) {
			        		$data = array(
								"company_id" => $company_id_session,
								"photo" => $new_photo_name,
								"create_by" => $cNIK_session,
								"create_date" => $last_update,
								"last_by" => $cNIK_session,
								"last_update" => $last_update,
								"deleted" => 0
							);
							$result = $this->m_essupdate->upload_data_photo($data, $cNIK, $id_data_photo);
							if ($result==true) {
								$status = 1;
							$url_photo = base_url().'assets/images/photo/'.$new_photo_name;
								$responseValue = '';
							}
							else {
								$status = 1;
								$url_photo = '';
								$responseValue = 'Data gagal disimpan.';
							}	
			        	}
			        	else {
			        		$status = 1;
							$url_photo = '';
							$responseValue = 'Cannot remove old image.';
							unlink ('./assets/images/photo/'.$new_photo_name);
			        	}
			        }
					
				}
				echo json_encode(array(array('status' => $status, 'response' => $responseValue, 'url_photo' => $url_photo)));
			}
		}
	}

	// Resign

	public function add_resign($key_session){
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
				$this->form_validation->set_rules('cNIK_resign', 'cNIK_resign', 'required');
			    $this->form_validation->set_rules('cIDJnsBerhenti', 'cIDJnsBerhenti', 'required');
			    $this->form_validation->set_rules('dTglPengajuan', 'dTglPengajuan', 'required');
			    $this->form_validation->set_rules('cNote', 'cNote', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$cNIK_resign = $this->input->post('cNIK_resign');
				    $cIDJnsBerhenti = $this->input->post('cIDJnsBerhenti');
				    $dTglPengajuan = $this->input->post('dTglPengajuan');
				    $cNote = $this->input->post('cNote');

				    $last_update = date('Y-m-d H:i:s');

				    $check = $this->m_essread->list_employee($company_id_session, '0', $cNIK_resign);
				    if (count($check)==0) {
				    	$data = array(
				    		"company_id" => $company_id_session,
				    		"cNIK" => $cNIK_resign,
				    		"dTglResign" => $dTglPengajuan,
				    		"cIDJnsBerhenti" => $cIDJnsBerhenti,
				    		"cAlasan" => $cNote,
				    		"dTglPengajuan" => $dTglPengajuan,
				    		"dTglSK" => $dTglPengajuan,
				    		"cNoSK" => "",
				    		"cNote" => $cNote,
				    		"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_esscreate->add_resign($data);
				    	if ($result==true) {
				    		$status = 1;
				    		$responseValue = '';
				    	}
				    	else {
				    		$status = 0;
				    		$responseValue = 'Data not saved.';
				    	}
				    }
				    else {
				    	$data = array(
				    		"dTglResign" => $dTglPengajuan,
				    		"cIDJnsBerhenti" => $cIDJnsBerhenti,
				    		"cAlasan" => $cNote,
				    		"dTglPengajuan" => $dTglPengajuan,
				    		"dTglResign" => $dTglPengajuan,
				    		"dTglSK" => $dTglPengajuan,
				    		"cNoSK" => "",
				    		"cNote" => $cNote,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
				    	);
				    	$result = $this->m_essupdate->update_resign($data, $cNIK_resign);
				    	if ($result==true) {
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

	// Payroll

	public function add_manual_transaction($key_session){
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
			    //$this->form_validation->set_rules('id_trans_manual', 'id_trans_manual', 'required');
			    $this->form_validation->set_rules('cNIK', 'cNIK', 'required');
			    $this->form_validation->set_rules('cIDKomponen', 'cIDKomponen', 'required');
			    $this->form_validation->set_rules('nNilai', 'nNilai', 'required');
			    $this->form_validation->set_rules('cNote', 'cNote', 'required');
			    $this->form_validation->set_rules('dTglTrans', 'dTglTrans', 'required');
			    $this->form_validation->set_rules('cIDPeriod', 'cIDPeriod', 'required');

			    if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_trans_manual = $this->input->post('id_trans_manual');
				    $cNIK = $this->input->post('cNIK');
				    $cIDKomponen = $this->input->post('cIDKomponen');
				    $nNilai = $this->input->post('nNilai');
				    $cNote = $this->input->post('cNote');
				    $dTglTrans = $this->input->post('dTglTrans');
				    $cIDPeriod = $this->input->post('cIDPeriod');

				    $last_update = date('Y-m-d H:i:s');

				    if ($id_trans_manual=='') {
				    	$check = $this->m_essread->check_manual_transaction($company_id_session, $cNIK, $cIdPeriod, $cIDKomponen);
				    	if (count($check)==0) {
				    		$data = array(
				    			'company_id' => $company_id_session,
				    			'cNIK' => $cNIK,
				    			'cIDKomponen' => $cIDKomponen,
				    			'nNilai' => $nNilai,
				    			'cNote' => $cNote,
				    			'dTglTrans' => $dTglTrans,
				    			'cIDPeriod' => $cIDPeriod,
				    			'create_by' => $cNIK_session,
				    			'create_date' => $last_update,
				    			'last_by' => $cNIK_session,
				    			'last_update' => $last_update,
				    		);
				    		$result = $this->m_esscreate->add_manual_transaction($data);
				    		if ($result==true) {
				    			$status = 1;
				    			$responseValue = '';
				    		}
				    		else {
				    			$status = 0;
				    			$responseValue = 'Data not saved.';
				    		}
				    	}
				    	else {
				    		$id_trans_manual_db = $check[0]->id_trans_manual;
				    		$data = array(
				    			'cNIK' => $cNIK,
				    			'cIDKomponen' => $cIDKomponen,
				    			'nNilai' => $nNilai,
				    			'cNote' => $cNote,
				    			'dTglTrans' => $dTglTrans,
				    			'cIDPeriod' => $cIDPeriod,
				    			'last_by' => $cNIK_session,
				    			'last_update' => $last_update,
				    		);
				    		$result = $this->m_essupdate->update_manual_transaction($data, $id_trans_manual_db);
				    		if ($result==true) {
				    			$status = 1;
				    			$responseValue = '';
				    		}
				    		else {
				    			$status = 0;
				    			$responseValue = 'Data not saved.';
				    		}
				    	}
				    }
				    else {
				    	$data = array(
			    			'cNIK' => $cNIK,
			    			'cIDKomponen' => $cIDKomponen,
			    			'nNilai' => $nNilai,
			    			'cNote' => $cNote,
			    			'dTglTrans' => $dTglTrans,
			    			'cIDPeriod' => $cIDPeriod,
			    			'last_by' => $cNIK_session,
			    			'last_update' => $last_update,
			    		);
			    		$result = $this->m_essupdate->update_manual_transaction($data, $id_trans_manual);
			    		if ($result==true) {
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

	public function add_history_medical($key_session){
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
					function generateRandomString($length = 6) {
					    $characters = '0123456789ABCDEFGH';
					    $charactersLength = strlen($characters);
					    $randomString = '';
					    for ($i = 0; $i < $length; $i++) {
					        $randomString .= $characters[rand(0, $charactersLength - 1)];
					    }
					    return $randomString;
					}

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

				    $unique_transaction = generateRandomString();

				    $family_relation = $this->m_essread->family_by_name($company_id_session, $cNIK, $cNama);
				    $cIDHubKel = $family_relation[0]->cIDHubKel;

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
							'unique_transaction' => $unique_transaction,
							'company_id' => $company_id_session,
							'cIDPeriode' => $cIDPeriod,
							'cNIK' => $cNIK,
							'cNama' => $cNama,
							'dTgl_Berobat' => $dTgl_Berobat,
							'nBiaya_Pengajuan' => $nBiaya_Pengajuan,
							'nBiaya_Approve' => $nBiaya_Pengajuan,
							'cIDHubKel' => $cIDHubKel,
							'cNmRS' => $cNmRS,
							'cNmDokter' => $cNmDokter,
							'diagnosa' => $diagnosa,
							'approval_1' => $cNIK_session,
							'approve_1' => 1,
							'approval_2' => $cNIK_session,
							'approve_2' => 1,
							'approval_ga' => $cNIK_session,
							'approve_ga' => 1,
							'create_by' => $cNIK_session,
							'create_date' => $last_update,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
					    );

					    $result = $this->m_esscreate->add_history_medical($data);
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

	public function add_bpjs($key_session){
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
				//$this->form_validation->set_rules('id_bpjs', 'id_bpjs', 'required');
				$this->form_validation->set_rules('nama_bpjs', 'nama_bpjs', 'required');
				$this->form_validation->set_rules('alias', 'alias', 'required');
				$this->form_validation->set_rules('company', 'company', 'required');
				$this->form_validation->set_rules('max_salary_company', 'max_salary_company', 'required');
				$this->form_validation->set_rules('personal', 'personal', 'required');
				$this->form_validation->set_rules('max_salary_personal', 'max_salary_personal', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_bpjs = $this->input->post('id_bpjs');
					$nama_bpjs = $this->input->post('nama_bpjs');
					$alias = $this->input->post('alias');
					$company = $this->input->post('company');
					$max_salary_company = $this->input->post('max_salary_company');
					$personal = $this->input->post('personal');
					$max_salary_personal = $this->input->post('max_salary_personal');
					$last_update = date('Y-m-d H:i:s');

					if ($id_bpjs=='') { // Add bpjs
						$data=array(
							"company_id" => $company_id_session,
							"nama_bpjs" => $nama_bpjs,
							"alias" => $alias,
							"company" => $company,
							"max_salary_company" => $max_salary_company,
							"personal" => $personal,
							"max_salary_personal" => $max_salary_personal,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0,
						);
						$result = $this->m_esscreate->add_bpjs($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update bpjs
						$data=array(
							"nama_bpjs" => ucwords($nama_bpjs),
							"alias" => $alias,
							"company" => $company,
							"max_salary_company" => $max_salary_company,
							"personal" => $personal,
							"max_salary_personal" => $max_salary_personal,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_bpjs($data, $id_bpjs);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_bpjs.' '.count($ceck);
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

	public function add_pkp_ptkp($key_session){
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
				//$this->form_validation->set_rules('id_pkp_ptkp', 'id_pkp_ptkp', 'required');
				
				$this->form_validation->set_rules('istri_company', 'istri_company', 'required');
				$this->form_validation->set_rules('istri_personal', 'istri_personal', 'required');
				$this->form_validation->set_rules('anak_company', 'anak_company', 'required');
				$this->form_validation->set_rules('anak_personal', 'anak_personal', 'required');
				$this->form_validation->set_rules('nominal_default', 'nominal_default', 'required');
				$this->form_validation->set_rules('jumlah_bulan', 'jumlah_bulan', 'required');
				
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_pkp_ptkp = $this->input->post('id_pkp_ptkp');

					$istri_company = $this->input->post('istri_company');
					$istri_personal = $this->input->post('istri_personal');
					$anak_company = $this->input->post('anak_company');
					$anak_personal = $this->input->post('anak_personal');
					$nominal_default = $this->input->post('nominal_default');
					$jumlah_bulan = $this->input->post('jumlah_bulan');

					$last_update = date('Y-m-d H:i:s');

					if ($id_bpjs=='') { // Add bpjs
						$data=array(
							"company_id" => $company_id_session,
							"istri_company" => $istri_company,
							"istri_personal" => $istri_personal,
							"anak_company" => $anak_company,
							"anak_personal" => $anak_personal,
							"nominal_default" => $nominal_default,
							"jumlah_bulan" => $jumlah_bulan,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0,
						);
						$result = $this->m_esscreate->add_pkp_ptkp($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update bpjs
						$data=array(
							"istri_company" => $istri_company,
							"istri_personal" => $istri_personal,
							"anak_company" => $anak_company,
							"anak_personal" => $anak_personal,
							"nominal_default" => $nominal_default,
							"jumlah_bulan" => $jumlah_bulan,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_pkp_ptkp($data, $id_pkp_ptkp);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_bpjs.' '.count($ceck);
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

	public function add_pkp_ptkp_formula($key_session, $category){
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
				//$this->form_validation->set_rules('id_pkp_ptkp_formula', 'id_pkp_ptkp_formula', 'required');
				$category = $this->uri->segment('4');

				$this->form_validation->set_rules('range_start', 'range_start', 'required');
				$this->form_validation->set_rules('range_end', 'range_end', 'required');
				$this->form_validation->set_rules('npwp_percent', 'npwp_percent', 'required');
				$this->form_validation->set_rules('non_npwp_percent', 'non_npwp_percent', 'required');
				$this->form_validation->set_rules('minus_npwp', 'minus_npwp', 'required');
				$this->form_validation->set_rules('minus_non_npwp', 'minus_non_npwp', 'required');
				
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_pkp_ptkp_formula = $this->input->post('id_pkp_ptkp_formula');

					$range_start = $this->input->post('range_start');
					$range_end = $this->input->post('range_end');
					$npwp_percent = $this->input->post('npwp_percent');
					$non_npwp_percent = $this->input->post('non_npwp_percent');
					$minus_npwp = $this->input->post('minus_npwp');
					$minus_non_npwp = $this->input->post('minus_non_npwp');

					$last_update = date('Y-m-d H:i:s');

					if ($id_pkp_ptkp_formula=='') { // Add bpjs
						$data=array(
							"company_id" => $company_id_session,
							"range_start" => $range_start,
							"range_end" => $range_end,
							"npwp_percent" => $npwp_percent,
							"non_npwp_percent" => $non_npwp_percent,
							"minus_npwp" => $minus_npwp,
							"minus_non_npwp" => $minus_non_npwp,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0,
						);
						$result = $this->m_esscreate->add_pkp_ptkp_formula($data, $category);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update bpjs
						$data=array(
							"range_start" => $range_start,
							"range_end" => $range_end,
							"npwp_percent" => $npwp_percent,
							"non_npwp_percent" => $non_npwp_percent,
							"minus_npwp" => $minus_npwp,
							"minus_non_npwp" => $minus_non_npwp,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_pkp_ptkp_formula($data, $id_pkp_ptkp_formula, $category);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_pkp_ptkp_formula.' '.count($ceck);
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

	public function add_salary_deduction($key_session){
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
				//$this->form_validation->set_rules('id_pkp_ptkp', 'id_pkp_ptkp', 'required');
				
				$this->form_validation->set_rules('month', 'month', 'required');
				$this->form_validation->set_rules('week', 'week', 'required');
				$this->form_validation->set_rules('day', 'day', 'required');				
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$id_salary_deduction = $this->input->post('id_salary_deduction');

					$month = $this->input->post('month');
					$week = $this->input->post('week');
					$day = $this->input->post('day');

					$last_update = date('Y-m-d H:i:s');

					if ($id_bpjs=='') { // Add bpjs
						$data=array(
							"company_id" => $company_id_session,
							"month" => $month,
							"week" => $week,
							"day" => $day,
							"create_by" => $cNIK_session,
							"create_date" => $last_update,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
							"deleted" => 0,
						);
						$result = $this->m_esscreate->add_salary_deduction($data);
						if ($result==true) {
							$status = 1;
							$responseValue = 'ok';
						}
						else {
							$status = 0;
							$responseValue = 'Data not saved.';
						}
					}
					else { // Update bpjs
						$data=array(
							"month" => $month,
							"week" => $week,
							"day" => $day,
							"last_by" => $cNIK_session,
							"last_update" => $last_update,
						);
						$result = $this->m_essupdate->update_salary_deduction($data, $id_salary_deduction);
						if ($result==true) {
							$status = 1;
							$responseValue = $company_id_session.' '.$id_bpjs.' '.count($ceck);
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
