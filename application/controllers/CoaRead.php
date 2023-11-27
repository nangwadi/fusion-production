<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class CoaRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_coaread');
        //$this->load->model('m_essupdate');
        //$this->load->model('m_ess');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// aldo
	// Setting

	public function list_coa_type($key_session, $id_coa_type){
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
				$id_coa_type = $this->uri->segment('4');
				$result = $this->m_coaread->list_coa_type($company_id_session, $id_coa_type);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_coa_type' => $resultList->id_coa_type,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'coa_type_cd' => $resultList->coa_type_cd,
							'coa_type_name' => $resultList->coa_type_name,
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
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_coa_classes($key_session, $id_coa_classes){
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
				$id_coa_classes = $this->uri->segment('4');
				$result = $this->m_coaread->list_coa_classes($company_id_session, $id_coa_classes);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_coa_classes' => $resultList->id_coa_classes,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_coa_type' => $resultList->id_coa_type,
							'coa_type_cd' => $resultList->coa_type_cd,
							'coa_type_name' => $resultList->coa_type_name,
							'coa_classes_cd' => $resultList->coa_classes_cd,
							'coa_classes_name' => $resultList->coa_classes_name,
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
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_coa_currency($key_session, $id_coa_currency){
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
				$id_coa_currency = $this->uri->segment('4');
				$result = $this->m_coaread->list_coa_currency($company_id_session, $id_coa_currency);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_coa_currency' => $resultList->id_coa_currency,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'coa_currency_cd' => $resultList->coa_currency_cd,
							'coa_currency_name' => $resultList->coa_currency_name,
							'decimal_after' => $resultList->decimal_after,
							'set_default' => $resultList->set_default,
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
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_coa_currency_by_currency_cd($key_session, $coa_currency_cd){
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
				$coa_currency_cd = $this->uri->segment('4');
				$result = $this->m_coaread->list_coa_currency_by_currency_cd($company_id_session, $coa_currency_cd);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_coa_currency' => $resultList->id_coa_currency,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'coa_currency_cd' => $resultList->coa_currency_cd,
							'coa_currency_name' => $resultList->coa_currency_name,
							'decimal_after' => $resultList->decimal_after,
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
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	// Input

	public function list_chart_of_account($key_session, $id_coa){
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
				$id_coa = $this->uri->segment('4');
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
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_sub_chart_of_account($key_session, $id_coa_sub){
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
				$id_coa_sub = $this->uri->segment('4');
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
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_rate($key_session, $id_coa_sub){
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
				$id_coa_sub = $this->uri->segment('4');
				$result = $this->m_coaread->list_rate($company_id_session, $id_coa_sub);
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
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_cash_account($key_session, $id_coa_cash_account){
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
				$id_coa_cash_account = $this->uri->segment('4');
				$result = $this->m_coaread->list_cash_account($company_id_session, $id_coa_cash_account);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
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
							'set_default' => $resultList->set_default,
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
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_bank_account_by_id_coa($key_session, $id_coa){
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
				$id_coa = $this->uri->segment('4');
				$result = $this->m_coaread->list_bank_account_by_id_coa($company_id_session, $id_coa);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_coa_bank' => $resultList->id_coa_bank,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_coa' => $resultList->id_coa,
							'coa_cd' => $resultList->coa_cd,
							'coa_name' => $resultList->coa_name,
							'id_coa_currency' => $resultList->id_coa_currency,
							'coa_currency_cd' => $resultList->coa_currency_cd,
							'coa_currency_name' => $resultList->coa_currency_name,
							'cIDBank' => $resultList->cIDBank,
							'cNmBank' => $resultList->cNmBank,
							'cSandiBank' => $resultList->cSandiBank,
							'bank_account_no' => $resultList->bank_account_no,
							'bank_account_name' => $resultList->bank_account_name,
							'bank_account_branch' => $resultList->bank_account_branch,
							'bank_account_address' => $resultList->bank_account_address,
							'bank_account_va' => $resultList->bank_account_va,
							'create_by' => $resultList->create_by,
							'cNmPegawai_create' => $resultList->cNmPegawai_create,
							'create_date' => $resultList->create_date,
							'last_by' => $resultList->last_by,
							'cNmPegawai_last' => $resultList->cNmPegawai_last,
							'last_update' => $resultList->last_update,
							'deleted' => $resultList->deleted
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

}