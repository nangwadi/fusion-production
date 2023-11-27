<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class EssRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_essread');
        //$this->load->model('m_essupdate');
        //$this->load->model('m_ess');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// ESS
	// Organization

	public function list_company($key_session, $company_id){
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
				$company_id = $this->uri->segment('4');
				$result = $this->m_essread->list_company($company_id);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_code = $resultList->company_code;
						$company_name = $resultList->company_name;
						$company_address = $resultList->company_address;
						$company_city = $resultList->company_city;
						$company_phone = $resultList->company_phone;
						$company_fax = $resultList->company_fax;
						$company_province = $resultList->company_province;
						$company_country = $resultList->company_country;
						$country_name = $resultList->country_name;
						$company_postal_code = $resultList->company_postal_code;
						$deleted = $resultList->deleted;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;

						$data=array(
							"company_id" => $company_id,
							"company_code" => $company_code,
							"company_name" => $company_name,
							"company_address" => $company_address,
							"company_city" => $company_city,
							"company_phone" => $company_phone,
							"company_fax" => $company_fax,
							"company_province" => $company_province,
							"company_country" => $company_country,
							"country_name" => $country_name,
							"company_postal_code" => $company_postal_code,
							"deleted" => $deleted,
							"create_by" => $create_by,
							"cNmPegawai_create" => $cNmPegawai_create,
							"create_date" => $create_date,
							"last_by" => $last_by,
							"cNmPegawai_last" => $cNmPegawai_last,
							"last_update" => $last_update,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_plant($key_session, $id_plant){
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
				$id_plant = $this->uri->segment('4');
				$result = $this->m_essread->list_plant($company_id_session, $id_plant);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_plant = $resultList->id_plant;
						$plant = $resultList->plant;
						$note = $resultList->note;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_plant" => $id_plant,
							"plant" => $plant,
							"note" => $note,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_department($key_session, $cIDDept){
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
				$cIDDept = $this->uri->segment('4');
				$result = $this->m_essread->list_department($company_id_session, $cIDDept);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDDept = $resultList->cIDDept;
						$cNmDept = $resultList->cNmDept;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDDept" => $cIDDept,
							"cNmDept" => $cNmDept,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_division($key_session, $cIDBag){
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
				$cIDBag = $this->uri->segment('4');
				$result = $this->m_essread->list_division($company_id_session, $cIDBag);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDDept = $resultList->cIDDept;
						$cNmDept = $resultList->cNmDept;
						$cIDBag = $resultList->cIDBag;
						$cNmBag = $resultList->cNmBag;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDDept" => $cIDDept,
							"cNmDept" => $cNmDept,
							"cIDBag" => $cIDBag,
							"cNmBag" => $cNmBag,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_division_by_department($key_session, $cIDDept){
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
				$cIDDept = $this->uri->segment('4');
				$result = $this->m_essread->list_division_by_department($company_id_session, $cIDDept);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDDept = $resultList->cIDDept;
						$cNmDept = $resultList->cNmDept;
						$cIDBag = $resultList->cIDBag;
						$cNmBag = $resultList->cNmBag;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDDept" => $cIDDept,
							"cNmDept" => $cNmDept,
							"cIDBag" => $cIDBag,
							"cNmBag" => $cNmBag,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_potition($key_session, $cIDJbtn){
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
				$cIDJbtn = $this->uri->segment('4');
				$result = $this->m_essread->list_potition($company_id_session, $cIDJbtn);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDJbtn = $resultList->cIDJbtn;
						$cNmJbtn = $resultList->cNmJbtn;
						$deleted = $resultList->deleted;

						$check_medical = $this->m_essread->list_limit_medical($company_id_session, $cIDJbtn);
						if (count($check_medical)==0) {
							$nominal = 0;
							$nominal_istri = 0;
							$nominal_anak = 0;
						}
						else {
							$nominal = $check_medical[0]->nominal;
							$nominal_istri = $check_medical[0]->nominal_istri;
							$nominal_anak = $check_medical[0]->nominal_anak;
						}
						$nominal_format = number_format($nominal);
						$nominal_istri_format = number_format($nominal_istri);
						$nominal_anak_format = number_format($nominal_anak);

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDJbtn" => $cIDJbtn,
							"cNmJbtn" => $cNmJbtn,
							"nominal" => $nominal,
							"nominal_istri" => $nominal_istri,
							"nominal_anak" => $nominal_anak,
							"nominal_format" => $nominal_format,
							"nominal_istri_format" => $nominal_istri_format,
							"nominal_anak_format" => $nominal_anak_format,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_employee_status($key_session, $cIDStsKrj){
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
				$cIDStsKrj = $this->uri->segment('4');
				$result = $this->m_essread->list_employee_status($company_id_session, $cIDStsKrj);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDStsKrj = $resultList->cIDStsKrj;
						$cNmStsKrj = $resultList->cNmStsKrj;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDStsKrj" => $cIDStsKrj,
							"cNmStsKrj" => $cNmStsKrj,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_family_status($key_session, $cIDSts_Keluarga){
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
				$cIDSts_Keluarga = $this->uri->segment('4');
				$result = $this->m_essread->list_family_status($company_id_session, $cIDSts_Keluarga);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDSts_Keluarga = $resultList->cIDSts_Keluarga;
						$cNmSts_Keluarga = $resultList->cNmSts_Keluarga;
						$istri = $resultList->istri;
						$anak = $resultList->anak;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDSts_Keluarga" => $cIDSts_Keluarga,
							"cNmSts_Keluarga" => $cNmSts_Keluarga,
							"istri" => $istri,
							"anak" => $anak,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_family_relation($key_session, $cIDHubKel){
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
				$cIDHubKel = $this->uri->segment('4');
				$result = $this->m_essread->list_family_relation($company_id_session, $cIDHubKel);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDHubKel = $resultList->cIDHubKel;
						$cNmHubKel = $resultList->cNmHubKel;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDHubKel" => $cIDHubKel,
							"cNmHubKel" => $cNmHubKel,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_education($key_session, $id_pendidikan){
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
				$id_pendidikan = $this->uri->segment('4');
				$result = $this->m_essread->list_education($company_id_session, $id_pendidikan);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_pendidikan = $resultList->id_pendidikan;
						$nama_pendidikan = $resultList->nama_pendidikan;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_pendidikan" => $id_pendidikan,
							"nama_pendidikan" => $nama_pendidikan,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_religion($key_session, $cIDAgama){
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
				$cIDAgama = $this->uri->segment('4');
				$result = $this->m_essread->list_religion($company_id_session, $cIDAgama);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDAgama = $resultList->cIDAgama;
						$cNmAgama = $resultList->cNmAgama;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDAgama" => $cIDAgama,
							"cNmAgama" => $cNmAgama,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_bank($key_session, $cIDBank){
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
				$cIDBank = $this->uri->segment('4');
				$result = $this->m_essread->list_bank($company_id_session, $cIDBank);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDBank = $resultList->cIDBank;
						$cNmBank = $resultList->cNmBank;
						$cSandiBank = $resultList->cSandiBank;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDBank" => $cIDBank,
							"cNmBank" => $cNmBank,
							"cSandiBank" => $cSandiBank,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_salary_component($key_session, $cIDKomponen){
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
				$cIDKomponen = $this->uri->segment('4');
				$result = $this->m_essread->list_salary_component($company_id_session, $cIDKomponen);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDKomponen = $resultList->cIDKomponen;
						$cNmKomponen = $resultList->cNmKomponen;
						$kategori = $resultList->kategori;
						$trans_manual = $resultList->trans_manual;
						$deleted = $resultList->deleted;
						if ($kategori=='P') {
							$kategori_descr = 'Plus';
						}
						else if ($kategori=='M') {
							$kategori_descr = 'Minus';
						}

						if ($trans_manual=='1') {
							$trans_manual_descr = 'Yes';
						}
						else if ($trans_manual=='0') {
							$trans_manual_descr = 'No';
						}
						else {
							$trans_manual_descr = '';
						}						

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDKomponen" => $cIDKomponen,
							"cNmKomponen" => $cNmKomponen,
							"kategori" => $kategori,
							"kategori_descr" => $kategori_descr,
							"trans_manual" => $trans_manual,
							"trans_manual_descr" => $trans_manual_descr,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_salary_component_group($key_session, $cIDKomponen_group){
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
				$cIDKomponen_group = $this->uri->segment('4');
				$result = $this->m_essread->list_salary_component_group($company_id_session, $cIDKomponen_group);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;

					$cIDKomponen_default_array = array();
					if($cIDKomponen_group!=0){
						$result_komponen_default = $this->m_essread->list_salary_component($company_id_session, 0);
						foreach ($result_komponen_default as $result_komponen_default_list) {
							$cIDKomponen_default = $result_komponen_default_list->cIDKomponen;
							$cNmKomponen_default = $result_komponen_default_list->cNmKomponen;

							$cIDKomponen_default = array(
								'cIDKomponen' => $cIDKomponen_default,
								'cNmKomponen' => $cNmKomponen_default
							);
							array_push ($cIDKomponen_default_array, $cIDKomponen_default);
						}
					}


					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDKomponen_group = $resultList->cIDKomponen_group;
						$cNmKomponen_group = $resultList->cNmKomponen_group;
						$kategori = $resultList->kategori;
						$cIDKomponen_multi = $resultList->cIDKomponen_multi;
						$operator = $resultList->operator;
						$nilai = $resultList->nilai;
						$deleted = $resultList->deleted;
						
						if ($kategori=='P') {
							$kategori_descr = 'Plus';
						}
						else if ($kategori=='M') {
							$kategori_descr = 'Minus';
						}

						if ($operator==null) {
							$operator_descr = '';
						}
						else {
							$operator_descr = $operator;
						}

						if ($nilai==null) {
							$nilai_descr = '';
						}
						else {
							$nilai_descr = $nilai;
						}

						$cIDKomponen_multi_exp = explode(',', $cIDKomponen_multi);
						$cNmKomponen_multi = '';
						$cIDKomponen_array = array();
						for ($i=0; $i < count($cIDKomponen_multi_exp); $i++) { 
							$cIDKomponen = $cIDKomponen_multi_exp[$i];
							$result_komponen = $this->m_essread->list_salary_component($company_id_session, $cIDKomponen);
							$cNmKomponen = $result_komponen[0]->cNmKomponen;
							if (count($cIDKomponen_multi_exp)==0) {
								$cNmKomponen_multi .= $cNmKomponen;
							}
							else {
								if ($i==(count($cIDKomponen_multi_exp)-1)) {
									$cNmKomponen_multi .= $cNmKomponen;
								}
								else {
									$cNmKomponen_multi .= $cNmKomponen.', ';
								}
							}
							$cIDKomponen = array(
								'cIDKomponen' => $cIDKomponen,
								'cNmKomponen' => $cNmKomponen
							);
							array_push ($cIDKomponen_array, $cIDKomponen);
						}					

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDKomponen_group" => $cIDKomponen_group,
							"cNmKomponen_group" => $cNmKomponen_group,
							"kategori" => $kategori,
							"kategori_descr" => $kategori_descr,
							"operator" => $operator_descr,
							"nilai" => $nilai_descr,
							"cIDKomponen_multi" => $cIDKomponen_multi,
							"cNmKomponen_multi" => $cNmKomponen_multi,
							"cIDKomponen_array" => $cIDKomponen_array,
							"cIDKomponen_default_array" => $cIDKomponen_default_array,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_data_photo($key_session, $id_data_photo){
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
				$id_data_photo = $this->uri->segment('4');
				$result = $this->m_essread->list_data_photo($company_id_session, $id_data_photo);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_data_photo = $resultList->id_data_photo;
						$nama_data_photo = $resultList->nama_data_photo;
						$deleted = $resultList->deleted;
						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_data_photo" => $id_data_photo,
							"nama_data_photo" => $nama_data_photo,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_blood_group($key_session, $id_golongan_darah){
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
				$id_golongan_darah = $this->uri->segment('4');
				$result = $this->m_essread->list_blood_group($company_id_session, $id_golongan_darah);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_golongan_darah = $resultList->id_golongan_darah;
						$nama_golongan_darah = $resultList->nama_golongan_darah;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_golongan_darah" => $id_golongan_darah,
							"nama_golongan_darah" => $nama_golongan_darah,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_reasons_for_resigning($key_session, $cIDJnsBerhenti){
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
				$cIDJnsBerhenti = $this->uri->segment('4');
				$result = $this->m_essread->list_reasons_for_resigning($company_id_session, $cIDJnsBerhenti);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDJnsBerhenti = $resultList->cIDJnsBerhenti;
						$cNmJnsBerhenti = $resultList->cNmJnsBerhenti;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDJnsBerhenti" => $cIDJnsBerhenti,
							"cNmJnsBerhenti" => $cNmJnsBerhenti,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	// Attendande

	public function list_sift_group($key_session, $cGroupID){
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
				$cGroupID = $this->uri->segment('4');
				$result = $this->m_essread->list_sift_group($company_id_session, $cGroupID);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cGroupID = $resultList->cGroupID;
						$cGroupNm = $resultList->cGroupNm;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cGroupID" => $cGroupID,
							"cGroupNm" => $cGroupNm,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_master_calendar($key_session, $cGroupID, $year_get){
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
				$cGroupID = $this->uri->segment('4');
				$year_get = $this->uri->segment('5');

				function weekOfMonth($date) {
					$firstOfMonth = strtotime(date("Y-m-01", $date));
					return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
				}

				function weekOfYear($date) {
				    $weekOfYear = intval(date("W", $date));
				    if (date('n', $date) == "1" && $weekOfYear > 51) {
				        return 0;
				    }
				    else if (date('n', $date) == "12" && $weekOfYear == 1) {
				        return 53;
				    }
				    else {
				        return $weekOfYear;
				    }
				}

				$data_header_array = array();
				for ($a=1; $a<=12; $a++){
					$month_get = sprintf("%02d", $a);
					$first_date_of_month = date_format(date_create($year_get.'-'.$month_get.'-01'), 'Y-m-d');
					$month_name_header = date_format(date_create($year_get.'-'.$month_get.'-01'), 'F');

					$data_array = array();
					$result = $this->m_essread->list_master_calendar($company_id_session, $cGroupID, $year_get, $month_get);
					if (count($result)==0) {
						$status = 0;
					}
					else {
						$status = 1;
						foreach ($result as $resultList) {
							$company_id = $resultList->company_id;
							$company_name = $resultList->company_name;
							$dTglHdr = $resultList->dTglHdr;
							$cGroupID = $resultList->cGroupID;
							$cGroupNm = $resultList->cGroupNm;
							$cShiftID_Plan = $resultList->cShiftID_Plan;
							$cNmShift = $resultList->cNmShift;
							$cIDAbsen = $resultList->cIDAbsen;
							$cNmAbsen = $resultList->cNmAbsen;
							$DayOff = $resultList->DayOff;
							$PotongGaji = $resultList->PotongGaji;
							$color_marking_sift = $resultList->color_marking_sift;
							$create_by = $resultList->create_by;
							$cNmPegawai_create = $resultList->cNmPegawai_create;
							$create_date = $resultList->create_date;
							$last_by = $resultList->last_by;
							$cNmPegawai_last = $resultList->cNmPegawai_last;
							$last_update = $resultList->last_update;

							$week_number = (weekOfMonth(strtotime($dTglHdr)))*1;
							$month_name = date_format(date_create($dTglHdr), 'F');
							$month_number = date_format(date_create($dTglHdr), 'm')*1;
							$dTglHdr_day_name = date_format(date_create($dTglHdr), 'l');	
							$day_number = date('N', strtotime($dTglHdr_day_name))*1;	

							$data = array(
								'company_id' => $company_id,
								'company_name' => $company_name,
								'dTglHdr' => $dTglHdr,
								'dTgl' => date_format(date_create($dTglHdr), 'd'),
								'week_number' => $week_number,
								'day_number' => $day_number,
								'cGroupID' => $cGroupID,
								'cGroupNm' => $cGroupNm,
								'cShiftID_Plan' => $cShiftID_Plan,
								'cNmShift' => $cNmShift,
								'cIDAbsen' => $cIDAbsen,
								'cNmAbsen' => $cNmAbsen,
								'DayOff' => $DayOff,
								'PotongGaji' => $PotongGaji,
								'color_marking_sift' => $color_marking_sift,
								'create_by' => $create_by,
								'cNmPegawai_create' => $cNmPegawai_create,
								'create_date' => $create_date,
								'last_by' => $last_by,
								'cNmPegawai_last' => $cNmPegawai_last,
								'last_update' => $last_update,
							);
							array_push($data_array, $data);
						}
						$data_header = array(
							'month_id' => $a,
							'month_name_header' => $month_name_header,
							'data_array' => $data_array
						);
						array_push($data_header_array, $data_header);
					}
				}
				echo json_encode(array(array('status' => $status, 'response' => $data_header_array)));
			}
		}
	}

	public function list_sift($key_session, $cShiftID){
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
				$result = $this->m_essread->list_sift($company_id_session, $cShiftID);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cShiftID = $resultList->cShiftID;
						$cNmShift = $resultList->cNmShift;
						$holiday_overtime = $resultList->holiday_overtime;
						$x1 = $resultList->x1;
						$x2 = $resultList->x2;
						$x3 = $resultList->x3;
						$x4 = $resultList->x4;
						$color_marking = $resultList->color_marking;
						$deleted = $resultList->deleted;

						if ($color_marking==null) {
							$color_marking_desc = '';
						}
						else {
							$color_marking_desc = $color_marking;
						}

						if ($holiday_overtime==null || $holiday_overtime==0) {
							$holiday_overtime_fix = 0;
							$holiday_overtime_desc = 'No';
						}
						else {
							$holiday_overtime_fix = 1;
							$holiday_overtime_desc = 'Yes';
						}

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cShiftID" => $cShiftID,
							"cNmShift" => $cNmShift,
							"holiday_overtime" => $holiday_overtime_fix,
							"holiday_overtime_desc" => $holiday_overtime_desc,
							"x1" => $x1*1,
							"x2" => $x2*1,
							"x3" => $x3*1,
							"x4" => $x4*1,
							"color_marking" => $color_marking_desc,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_sift_time($key_session, $cShiftID){
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
				$result = $this->m_essread->list_sift_time($company_id_session, $cShiftID);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
					$days = [
						7 => 'Sunday',
						1 => 'Monday',
						2 => 'Tuesday',
						3 => 'Wednesday',
						4 => 'Thursday',
						5 => 'Friday',
						6 => 'Saturday'
					];
					$default_hour = '00:00';
					for ($i=1; $i <=7 ; $i++) { 
						$data=array(
							"cShiftID" => $cShiftID,
							"day_no" => $i,
							"cDayNm" => $days[$i],
							"dIN" => $default_hour,
							"dOUT" => $default_hour,
							"dRest_Start1" => $default_hour,
							"dRest_End1" => $default_hour,
							"dRest_Start2" => $default_hour,
							"dRest_End2" => $default_hour,
							"dRest_Start3" => $default_hour,
							"dRest_End3" => $default_hour,
							"deleted" => $default_hour,
						);
						array_push($data_array, $data);
					}
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cShiftID = $resultList->cShiftID;
						$deleted = $resultList->deleted;
						$cDayNm = $resultList->cDayNm;
						$dIN = $resultList->dIN;
						$dOUT = $resultList->dOUT;
						$dRest_Start1 = $resultList->dRest_Start1;
						$dRest_End1 = $resultList->dRest_End1;
						$dRest_Start2 = $resultList->dRest_Start2;
						$dRest_End2 = $resultList->dRest_End2;
						$dRest_Start3 = $resultList->dRest_Start3;
						$dRest_End3 = $resultList->dRest_End3;

						$day_no = date('N', strtotime($cDayNm));

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cShiftID" => $cShiftID,
							"day_no" => $day_no*1,
							"cDayNm" => $cDayNm,
							"dIN" => $dIN,
							"dOUT" => $dOUT,
							"dRest_Start1" => $dRest_Start1,
							"dRest_End1" => $dRest_End1,
							"dRest_Start2" => $dRest_Start2,
							"dRest_End2" => $dRest_End2,
							"dRest_Start3" => $dRest_Start3,
							"dRest_End3" => $dRest_End3,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				

				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_precense_type($key_session, $cIDAbsen){
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
				$cIDAbsen = $this->uri->segment('4');
				$result = $this->m_essread->list_precense_type($company_id_session, $cIDAbsen);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIDAbsen = $resultList->cIDAbsen;
						$cNmAbsen = $resultList->cNmAbsen;
						$Note = $resultList->Note;
						$DayOff = $resultList->DayOff;
						$PotongGaji = $resultList->PotongGaji;
						$color_marking = $resultList->color_marking;
						$deleted = $resultList->deleted;

						if ($color_marking==null) {
							$color_marking_desc = '';
						}
						else {
							$color_marking_desc = $color_marking;
						}

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIDAbsen" => $cIDAbsen,
							"cNmAbsen" => $cNmAbsen,
							"Note" => $Note,
							"DayOff" => $DayOff,
							"PotongGaji" => $PotongGaji,
							"color_marking" => $color_marking_desc,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_national_holiday($key_session, $id_libur_nasional){
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
				$id_libur_nasional = $this->uri->segment('4');
				$result = $this->m_essread->list_national_holiday($company_id_session, $id_libur_nasional);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_libur_nasional = $resultList->id_libur_nasional;
						$tanggal_libur_nasional = $resultList->tanggal_libur_nasional;
						$nama_hari_libur = $resultList->nama_hari_libur;
						$cGroupID = $resultList->cGroupID;
						$cGroupNm = $resultList->cGroupNm;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_libur_nasional" => $id_libur_nasional,
							"tanggal_libur_nasional" => $tanggal_libur_nasional,
							"nama_hari_libur" => $nama_hari_libur,
							"cGroupID" => $cGroupID,
							"cGroupNm" => $cGroupNm,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_mandatory_overtime($key_session, $id_lembur_wajib){
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
				$id_lembur_wajib = $this->uri->segment('4');
				$result = $this->m_essread->list_mandatory_overtime($company_id_session, $id_lembur_wajib);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_lembur_wajib = $resultList->id_lembur_wajib;
						$tanggal_lembur_wajib = $resultList->tanggal_lembur_wajib;
						$cGroupID = $resultList->cGroupID;
						$cGroupNm = $resultList->cGroupNm;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_lembur_wajib" => $id_lembur_wajib,
							"tanggal_lembur_wajib" => $tanggal_lembur_wajib,
							"cGroupID" => $cGroupID,
							"cGroupNm" => $cGroupNm,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_change_day($key_session, $id_ganti_hari){
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
				$id_ganti_hari = $this->uri->segment('4');
				$result = $this->m_essread->list_change_day($company_id_session, $id_ganti_hari);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_ganti_hari = $resultList->id_ganti_hari;
						$tanggal_ganti_hari = $resultList->tanggal_ganti_hari;
						$cGroupID = $resultList->cGroupID;
						$cGroupNm = $resultList->cGroupNm;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_ganti_hari" => $id_ganti_hari,
							"tanggal_ganti_hari" => $tanggal_ganti_hari,
							"cGroupID" => $cGroupID,
							"cGroupNm" => $cGroupNm,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_ramadhan($key_session, $id_ramadhan){
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
				$id_ramadhan = $this->uri->segment('4');
				$result = $this->m_essread->list_ramadhan($company_id_session, $id_ramadhan);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_ramadhan = $resultList->id_ramadhan;
						$tahun = $resultList->tahun;
						$tanggal_awal = $resultList->tanggal_awal;
						$tanggal_akhir = $resultList->tanggal_akhir;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_ramadhan" => $id_ramadhan,
							"tahun" => $tahun,
							"tanggal_awal" => $tanggal_awal,
							"tanggal_akhir" => $tanggal_akhir,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_attendance_periode($key_session, $cIdPeriod){
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
				$cIdPeriod = $this->uri->segment('4');
				$result = $this->m_essread->list_attendance_periode($company_id_session, $cIdPeriod);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cIdPeriod = $resultList->cIdPeriod;
						$cNmPeriod = $resultList->cNmPeriod;
						$dTglPeriod_Start = $resultList->dTglPeriod_Start;
						$dTglPeriod_End = $resultList->dTglPeriod_End;
						$status = $resultList->status;
						$dTglClose = $resultList->dTglClose;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cIdPeriod" => $cIdPeriod,
							"cNmPeriod" => $cNmPeriod,
							"dTglPeriod_Start" => $dTglPeriod_Start,
							"dTglPeriod_End" => $dTglPeriod_End,
							"status" => $status,
							"dTglClose" => $dTglClose,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}
	

	// Attendande Record

	public function list_face($key_session, $cNIK, $record){
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
				$cNIK = $this->uri->segment('4');
				$record = $this->uri->segment('5');
				$result = $this->m_essread->list_face($company_id_session, $cNIK, $record);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$kategori = $resultList->kategori;
						$date_record = $resultList->date_record;
						$time_record = $resultList->time_record;
						$record = $resultList->record;
						$ip = $resultList->ip;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"kategori" => $kategori,
							"date_record" => $date_record,
							"time_record" => $time_record,
							"record" => $record,
							"ip" => $ip,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_finger($key_session, $cNIK, $tgl){
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
				$cNIK = $this->uri->segment('4');
				$tgl = $this->uri->segment('5');
				$result = $this->m_essread->list_finger($company_id_session, $cNIK, $tgl);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$nUserID = $resultList->nUserID;
						$nTNAEvent = $resultList->nTNAEvent;
						$jam = $resultList->jam;
						$tgl = $resultList->tgl;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"nUserID" => $nUserID,
							"nTNAEvent" => $nTNAEvent,
							"jam" => $jam,
							"tgl" => $tgl,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_change_sift($key_session, $cNIK){
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
				$cNIK = $this->uri->segment('4');
				$result = $this->m_essread->list_change_sift($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cGroupID = $resultList->cGroupID;
						$cGroupNm = $resultList->cGroupNm;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"cGroupID" => $cGroupID,
							"cGroupNm" => $cGroupNm,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_daily_attendance($key_session){
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

				$dTglHdr_start = $this->input->post('dTglHdr_start');
				$dTglHdr_end = $this->input->post('dTglHdr_end');
				$cShiftID = $this->input->post('cShiftID');
				$cIDAbsen = $this->input->post('cIDAbsen');
				$cNIK = $this->input->post('cNIK');

				if ($dTglHdr_start=='') {
					$result = $this->m_essread->list_daily_attendance($company_id_session, '', '', '', '', '');
				}
				else {
					$result = $this->m_essread->list_daily_attendance($company_id_session, $dTglHdr_start, $dTglHdr_end, $cShiftID, $cIDAbsen, $cNIK);
				}

				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$dTglHdr = $resultList->dTglHdr;
						$dTglHdr_format = date_format(date_create($resultList->dTglHdr), 'd M Y');
						$dJamMsk = date_format(date_create($resultList->dJamMsk), 'H:i');
						$dJamPlg = date_format(date_create($resultList->dJamPlg), 'H:i');
						$cShiftID_plan = $resultList->cShiftID_plan;
						$cNmShift_plan = $resultList->cNmShift_plan;
						$cShiftID_act = $resultList->cShiftID_act;
						$cNmShift_act = $resultList->cNmShift_act;
						$dt = $resultList->dt;
						$pc = $resultList->pc;
						$ot_awal_start = $resultList->ot_awal_start;
						$ot_awal_end = $resultList->ot_awal_end;
						$ot_awal = $resultList->ot_awal;
						$ot_akhir_start = $resultList->ot_akhir_start;
						$ot_akhir_end = $resultList->ot_akhir_end;
						$ot_akhir = $resultList->ot_akhir;
						$ot_libur_start = $resultList->ot_libur_start;
						$ot_libur_end = $resultList->ot_libur_end;
						$ot_libur = $resultList->ot_libur;
						$ot_1 = $resultList->ot_1;
						$ot_2 = $resultList->ot_2;
						$ot_3 = $resultList->ot_3;
						$ot_4 = $resultList->ot_4;
						$ot_real = $resultList->ot_real;
						$ot_konv = $resultList->ot_konv;
						$cIDAbsen = $resultList->cIDAbsen;
						$cNmAbsen = $resultList->cNmAbsen;
						$keterangan = $resultList->keterangan;
						$type_absen = $resultList->type_absen;
						$basik = $resultList->basik;
						$imp = $resultList->imp;
						$ipu = $resultList->ipu;

						$data=array(
							'company_id' => $company_id,
							'company_name' => $company_name,
							'cNIK' => $cNIK,
							'cNmPegawai' => $cNmPegawai,
							'dTglHdr' => $dTglHdr,
							'dTglHdr_format' => $dTglHdr_format,
							'dJamMsk' => $dJamMsk,
							'dJamPlg' => $dJamPlg,
							'cShiftID_plan' => $cShiftID_plan,
							'cNmShift_plan' => $cNmShift_plan,
							'cShiftID_act' => $cShiftID_act,
							'cNmShift_act' => $cNmShift_act,
							'dt' => $dt,
							'pc' => $pc,
							'ot_awal_start' => $ot_awal_start,
							'ot_awal_end' => $ot_awal_end,
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
							'cNmAbsen' => $cNmAbsen,
							'keterangan' => $keterangan,
							'type_absen' => $type_absen,
							'basik' => $basik,
							'imp' => $imp,
							'ipu' => $ipu,

						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'cNIK' => $cNIK, 'cShiftID' => $cShiftID, 'cIDAbsen' => $cIDAbsen, 'dTglHdr_start' => $dTglHdr_start, 'dTglHdr_end' => $dTglHdr_end, 'response'=> $data_array)));
			}
		}
	}

	// Attendance Check

	public function list_attendance_check($key_session, $category, $cIdPeriod){
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

				$category = $this->uri->segment('4');
				$cIdPeriod_post = $this->uri->segment('5');

				if ($cIdPeriod_post=='' || $cIdPeriod_post==null || $cIdPeriod_post=='null') {
					$result_periode = $this->m_essread->last_attendance_periode($company_id_session);
					$cIdPeriod = $result_periode[0]->cIdPeriod;
					$dTglPeriod_Start = $result_periode[0]->dTglPeriod_Start;
					$dTglPeriod_End = $result_periode[0]->dTglPeriod_End;
				}
				else {
					$result_periode = $this->m_essread->list_attendance_periode($company_id_session, $cIdPeriod_post);
					$cIdPeriod = $result_periode[0]->cIdPeriod;
					$dTglPeriod_Start = $result_periode[0]->dTglPeriod_Start;
					$dTglPeriod_End = $result_periode[0]->dTglPeriod_End;
				}

				$today = date('Y-m-d');
				if ($today<$dTglPeriod_End) {
					$dTglPeriod_End_ok = $today;
				}
				else {
					$dTglPeriod_End_ok = $dTglPeriod_End;
				}

				$data_array = array();
				$result = $this->m_essread->list_attendance_check($company_id_session, $dTglPeriod_Start, $dTglPeriod_End_ok, $category);
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$dTglHdr = $resultList->dTglHdr;
						$dTglHdr_format = date_format(date_create($resultList->dTglHdr), 'd M Y');
						$dJamMsk = date_format(date_create($resultList->dJamMsk), 'H:i');
						$dJamPlg = date_format(date_create($resultList->dJamPlg), 'H:i');
						$cShiftID_plan = $resultList->cShiftID_plan;
						$cNmShift_plan = $resultList->cNmShift_plan;
						$cShiftID_act = $resultList->cShiftID_act;
						$cNmShift_act = $resultList->cNmShift_act;
						$dt = $resultList->dt;
						$pc = $resultList->pc;
						$ot_awal_start = $resultList->ot_awal_start;
						$ot_awal_end = $resultList->ot_awal_end;
						$ot_awal = $resultList->ot_awal;
						$ot_akhir_start = $resultList->ot_akhir_start;
						$ot_akhir_end = $resultList->ot_akhir_end;
						$ot_akhir = $resultList->ot_akhir;
						$ot_libur_start = $resultList->ot_libur_start;
						$ot_libur_end = $resultList->ot_libur_end;
						$ot_libur = $resultList->ot_libur;
						$ot_1 = $resultList->ot_1;
						$ot_2 = $resultList->ot_2;
						$ot_3 = $resultList->ot_3;
						$ot_4 = $resultList->ot_4;
						$ot_real = $resultList->ot_real;
						$ot_konv = $resultList->ot_konv;
						$cIDAbsen = $resultList->cIDAbsen;
						$cNmAbsen = $resultList->cNmAbsen;
						$keterangan = $resultList->keterangan;
						$type_absen = $resultList->type_absen;
						$basik = $resultList->basik;
						$imp = $resultList->imp;
						$ipu = $resultList->ipu;

						$data=array(
							'company_id' => $company_id,
							'company_name' => $company_name,
							'cNIK' => $cNIK,
							'cNmPegawai' => $cNmPegawai,
							'dTglHdr' => $dTglHdr,
							'dTglHdr_format' => $dTglHdr_format,
							'dJamMsk' => $dJamMsk,
							'dJamPlg' => $dJamPlg,
							'cShiftID_plan' => $cShiftID_plan,
							'cNmShift_plan' => $cNmShift_plan,
							'cShiftID_act' => $cShiftID_act,
							'cNmShift_act' => $cNmShift_act,
							'dt' => $dt,
							'pc' => $pc,
							'ot_awal_start' => $ot_awal_start,
							'ot_awal_end' => $ot_awal_end,
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
							'cNmAbsen' => $cNmAbsen,
							'keterangan' => $keterangan,
							'type_absen' => $type_absen,
							'basik' => $basik,
							'imp' => $imp,
							'ipu' => $ipu,

						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'category' => $category, 'cIdPeriod' => $cIdPeriod_post, 'dTglPeriod_Start' => $dTglPeriod_Start, 'dTglPeriod_End' => $dTglPeriod_End, 'response'=> $data_array)));
			}
		}
	}

	// Employee

	public function list_employee($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->list_employee($company_id_session, $status, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					if ($status==1) {
						foreach ($result as $resultList){
							$company_id = $resultList->company_id;
							$company_name = $resultList->company_name;
							$cNIK = $resultList->cNIK;
							$cNmPegawai = $resultList->cNmPegawai;
							$cIDDept = $resultList->cIDDept;
							$cNmDept = $resultList->cNmDept;
							$cIDBag = $resultList->cNIDag;
							$cNmBag = $resultList->cNmBag;
							$cIDJbtn = $resultList->cIDJbtn;
							$cNmJbtn = $resultList->cNmJbtn;
							$cGroupNm = $resultList->cGroupNm;

							if ($cNmDept==null) {
								$cNmDept_ket = '';
							}
							else {
								$cNmDept_ket = $cNmDept;
							}

							if ($cNmBag==null) {
								$cNmBag_ket = '';
							}
							else {
								$cNmBag_ket = $cNmBag;
							}

							if ($cNmJbtn==null) {
								$cNmJbtn_ket = '';
							}
							else {
								$cNmJbtn_ket = $cNmJbtn;
							}

							if ($cGroupNm==null) {
								$cGroupNm_ket = '';
							}
							else {
								$cGroupNm_ket = $cGroupNm;
							}

							$data=array(
								"company_id" => $company_id,
								"company_name" => $company_name,
								"cNIK" => $cNIK,
								"cNmPegawai" => $cNmPegawai,
								"cIDDept" => $cIDDept,
								"cIDBag" => $cIDBag,
								"cIDJbtn" => $cIDJbtn,
								"cNmDept" => $cNmDept_ket,
								"cNmBag" => $cNmBag_ket,
								"cNmJbtn" => $cNmJbtn_ket,
								"cGroupNm" => $cGroupNm_ket
							);
							array_push($data_array, $data);
						}
					}
					else {
						foreach ($result as $resultList){
							$company_id = $resultList->company_id;
							$company_name = $resultList->company_name;
							$cNIK = $resultList->cNIK;
							$cNmPegawai = $resultList->cNmPegawai;
							$dTglResign = $resultList->dTglResign;
							$cIDJnsBerhenti = $resultList->cIDJnsBerhenti;
							$cNmJnsBerhenti = $resultList->cNmJnsBerhenti;
							$cAlasan = $resultList->cAlasan;
							$cNote = $resultList->cNote;
							$dTglPengajuan = $resultList->dTglPengajuan;

							$data=array(
								"company_id" => $company_id,
								"company_name" => $company_name,
								"cNIK" => $cNIK,
								"cNmPegawai" => $cNmPegawai,
								"dTglResign" => $dTglResign,
								"cIDJnsBerhenti" => $cIDJnsBerhenti,
								"cNmJnsBerhenti" => $cNmJnsBerhenti,
								"cAlasan" => $cAlasan,
								"cNote" => $cNote,
								"dTglPengajuan" => $dTglPengajuan
							);
							array_push($data_array, $data);
						}
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function personal_data($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->personal_data($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cNmPanggilan = $resultList->cNmPanggilan;
						$cTempatLahir = $resultList->cTempatLahir;
						$dTglLhr = $resultList->dTglLhr;
						$cAlamat = $resultList->cAlamat;
						$cKota = $resultList->cKota;
						$cKdPos = $resultList->cKdPos;
						$cTelp1 = $resultList->cTelp1;
						$cTelp2 = $resultList->cTelp2;
						$dTglGabung = $resultList->dTglGabung;
						$dTglGabung2 = $resultList->dTglGabung2;

						$result_photo = $this->m_essread->data_photo($company_id_session, $cNIK, 1);
						if (count($result_photo)==0) {
							$photo = 'default/default.png';
						}
						else {
							$photo = $result_photo[0]->photo;
						}

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"cNmPanggilan" => $cNmPanggilan,
							"cTempatLahir" => $cTempatLahir,
							"dTglLhr" => $dTglLhr,
							"cAlamat" => $cAlamat,
							"cKota" => $cKota,
							"cKdPos" => $cKdPos,
							"cTelp1" => $cTelp1,
							"cTelp2" => $cTelp2,
							"dTglGabung" => $dTglGabung,
							"dTglGabung2" => $dTglGabung2,
							"photo" => $photo,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function education($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->education($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$id_pendidikan = $resultList->id_pendidikan;
						$nama_pendidikan = $resultList->nama_pendidikan;
						$bidang_study = $resultList->bidang_study;
						$keterangan = $resultList->keterangan;
						$tahun_lulus = $resultList->tahun_lulus;
						$photo = $resultList->photo;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"id_pendidikan" => $id_pendidikan,
							"nama_pendidikan" => $nama_pendidikan,
							"bidang_study" => $bidang_study,
							"keterangan" => $keterangan,
							"tahun_lulus" => $tahun_lulus,
							"photo" => $photo,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function account($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->account($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$Pwd = $resultList->Pwd;
						$cNoAbsen = $resultList->cNoAbsen;
						$email = $resultList->email;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"Pwd" => $Pwd,
							"cNoAbsen" => $cNoAbsen,
							"email" => $email
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function potition($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->potition($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cIDBag = $resultList->cIDBag;
						$cNmBag = $resultList->cNmBag;
						$cIDDept = $resultList->cIDDept;
						$cNmDept = $resultList->cNmDept;
						$cIDJbtn = $resultList->cIDJbtn;
						$cNmJbtn = $resultList->cNmJbtn;
						$cIDStsKrj = $resultList->cIDStsKrj;
						$cNmStsKrj = $resultList->cNmStsKrj;
						$cNoSK = $resultList->cNoSK;
						$dTglSK = $resultList->dTglSK;
						$lPromosi = $resultList->lPromosi;
						$cNote = $resultList->cNote;
						$dBerlaku_Dari = $resultList->dBerlaku_Dari;
						$dBerlaku_Sdgn = $resultList->dBerlaku_Sdgn;
						if ($dBerlaku_Sdgn==null) {
							$dBerlaku_Sdgn_desc = '';
						}
						else {
							$dBerlaku_Sdgn_desc = $dBerlaku_Sdgn;
						}

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"cIDBag" => $cIDBag,
							"cNmBag" => $cNmBag,
							"cIDDept" => $cIDDept,
							"cNmDept" => $cNmDept,
							"cIDJbtn" => $cIDJbtn,
							"cNmJbtn" => $cNmJbtn,
							"cIDStsKrj" => $cIDStsKrj,
							"cNmStsKrj" => $cNmStsKrj,
							"cNoSK" => $cNoSK,
							"dTglSK" => $dTglSK,
							"lPromosi" => $lPromosi,
							"dBerlaku_Dari" => $dBerlaku_Dari,
							"dBerlaku_Sdgn" => $dBerlaku_Sdgn_desc,
							"cNote" => $cNote
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function plant($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->plant($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$plant = $resultList->plant;
						$plant_name = $resultList->plant_name;
						$plant_descr = $resultList->plant_descr;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"plant" => $plant,
							"plant_name" => $plant_name,
							"plant_descr" => $plant_descr,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function id_card($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->id_card($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cNoKTP = $resultList->cNoKTP;
						$cAlamatKTP = $resultList->cAlamatKTP;
						$cKotaKTP = $resultList->cKotaKTP;
						$cKdPosKTP = $resultList->cKdPosKTP;
						$photo = $resultList->photo;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNoKTP" => $cNoKTP,
							"cAlamatKTP" => $cAlamatKTP,
							"cKotaKTP" => $cKotaKTP,
							"cKdPosKTP" => $cKdPosKTP,
							"photo" => $photo,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function tax_card($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->tax_card($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cNPWP = $resultList->cNPWP;
						$cAlamatNPWP = $resultList->cAlamatNPWP;
						$cKotaNPWP = $resultList->cKotaNPWP;
						$cKdPosNPWP = $resultList->cKdPosNPWP;
						$photo = $resultList->photo;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNPWP" => $cNPWP,
							"cAlamatNPWP" => $cAlamatNPWP,
							"cKotaNPWP" => $cKotaNPWP,
							"cKdPosNPWP" => $cKdPosNPWP,
							"photo" => $photo,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function bpjs($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->bpjs($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cNoBPJS = $resultList->cNoBPJS;
						$dTglBPJS = $resultList->dTglBPJS;
						$cNoJST = $resultList->cNoJST;
						$dTglJST = $resultList->dTglJST;
						$kategori = $resultList->kategori;
						$photo = $resultList->photo;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNoBPJS" => $cNoBPJS,
							"dTglBPJS" => $dTglBPJS,
							"cNoJST" => $cNoJST,
							"dTglJST" => $dTglJST,
							"kategori" => $kategori,
							"photo" => $photo,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function family($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->family($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					$result_photo = $this->m_essread->data_photo($company_id_session, $cNIK, 4);
					if (count($result_photo)==0) {
						$photo = 'default/default.png';
					}
					else {
						$photo = $result_photo[0]->photo;
					}
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cNama = $resultList->cNama;
						$dTglLhr = $resultList->dTglLhr;
						$cTempat_Lhr = $resultList->cTempat_Lhr;
						$cJnsKel = $resultList->cJnsKel;
						$cIDHubKel = $resultList->cIDHubKel;
						$cNmHubKel = $resultList->cNmHubKel;
						$cIDAgama = $resultList->cIDAgama;
						$cNmAgama = $resultList->cNmAgama;
						$cGolDrh = $resultList->cGolDrh;
						$lNikah = $resultList->lNikah;
						$dTglNikah = $resultList->dTglNikah;
						$cPekerjaan = $resultList->cPekerjaan;
						$cAlamat = $resultList->cAlamat;
						$cTelp = $resultList->cTelp;
						$cNote = $resultList->cNote;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cNama" => $cNama,
							"dTglLhr" => $dTglLhr,
							"cTempat_Lhr" => $cTempat_Lhr,
							"cJnsKel" => $cJnsKel,
							"cIDHubKel" => $cIDHubKel,
							"cNmHubKel" => $cNmHubKel,
							"cIDAgama" => $cIDAgama,
							"cNmAgama" => $cNmAgama,
							"cGolDrh" => $cGolDrh,
							"lNikah" => $lNikah,
							"dTglNikah" => $dTglNikah,
							"cPekerjaan" => $cPekerjaan,
							"cAlamat" => $cAlamat,
							"cTelp" => $cTelp,
							"cNote" => $cNote,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'photo' => $photo, 'response'=> $data_array)));
			}
		}
	}

	public function tax($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->tax($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$tax_bpjs = $resultList->tax_bpjs;
						$cNmSts_Keluarga_bpjs = $resultList->cNmSts_Keluarga_bpjs;
						$tax_pph21 = $resultList->tax_pph21;
						$cNmSts_Keluarga_pph21 = $resultList->cNmSts_Keluarga_pph21;
						$tahun = $resultList->tahun;
						$dBerlaku_Dari = $resultList->dBerlaku_Dari;
						$dBerlaku_Sdgn = $resultList->dBerlaku_Sdgn;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"tax_bpjs" => $tax_bpjs,
							"cNmSts_Keluarga_bpjs" => $cNmSts_Keluarga_bpjs,
							"tax_pph21" => $tax_pph21,
							"cNmSts_Keluarga_pph21" => $cNmSts_Keluarga_pph21,
							"tahun" => $tahun,
							"dBerlaku_Dari" => $dBerlaku_Dari,
							"dBerlaku_Sdgn" => $dBerlaku_Sdgn,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function insurance($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->insurance($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$No_Peserta = $resultList->No_Peserta;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$Total = $resultList->Total;
						$Jml_Bln = $resultList->Jml_Bln;
						$Per_Bulan = $resultList->Per_Bulan;
						$status = $resultList->status;
						$dBerlaku_Dari = $resultList->dBerlaku_Dari;
						$dBerlaku_Sdgn = $resultList->dBerlaku_Sdgn;

						if ($dBerlaku_Sdgn==null) {
							$dBerlaku_Sdgn_desc = '';
						}
						else {
							$dBerlaku_Sdgn_desc = $dBerlaku_Sdgn;
						}

						$data=array(
							"company_id" => $company_id,
							"No_Peserta" => $No_Peserta,
							"cNIK" => $cNIK,
							"cNmPegawai" => $cNmPegawai,
							"Total" => $Total,
							"Per_Bulan" => $Per_Bulan,
							"Total_format" => number_format($Total, 0),
							"Per_Bulan_format" => number_format($Per_Bulan, 0),
							"Jml_Bln" => $Jml_Bln,
							"status" => $status,
							"dBerlaku_Dari" => $dBerlaku_Dari,
							"dBerlaku_Sdgn" => $dBerlaku_Sdgn_desc,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function bank_account($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->bank_account($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					$result_photo = $this->m_essread->data_photo($company_id_session, $cNIK, 5);
					if (count($result_photo)==0) {
						$photo = 'default/default.png';
					}
					else {
						$photo = $result_photo[0]->photo;
					}
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cIDBank = $resultList->cIDBank;
						$cNmBank = $resultList->cNmBank;
						$cNoAccount = $resultList->cNoAccount;
						$cAlmBank = $resultList->cAlmBank;
						$cNmPemilik = $resultList->cNmPemilik;
						$dCity = $resultList->dCity;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cIDBank" => $cIDBank,
							"cNmBank" => $cNmBank,
							"cNoAccount" => $cNoAccount,
							"cAlmBank" => $cAlmBank,
							"cNmPemilik" => $cNmPemilik,
							"dCity" => $dCity,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'photo' => $photo, 'response'=> $data_array)));
			}
		}
	}

	public function component_salary($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->component_salary($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$cIDKomponen = $resultList->cIDKomponen;
						$cNmKomponen = $resultList->cNmKomponen;
						$kategori = $resultList->kategori;
						$nNilai = $resultList->nNilai;
						$dBerlaku_dari = $resultList->dBerlaku_dari;
						$dBerlaku_Sdgn = $resultList->dBerlaku_Sdgn;
						$deleted = $resultList->deleted;
						if ($kategori=='P') {
							$kategori_descr = 'Plus';
						}
						else if ($kategori=='M') {
							$kategori_descr = 'Minus';
						}

						if ($dBerlaku_Sdgn==null) {
							$dBerlaku_Sdgn_desc = '';
						}
						else {
							$dBerlaku_Sdgn_desc = $dBerlaku_Sdgn;
						}

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"cIDKomponen" => $cIDKomponen,
							"cNmKomponen" => $cNmKomponen,
							"kategori" => $kategori,
							"kategori_descr" => $kategori_descr,
							"nNilai" => $nNilai,
							"nNilai_format" => number_format($nNilai, 0),
							"dBerlaku_dari" => $dBerlaku_dari,
							"dBerlaku_Sdgn" => $dBerlaku_Sdgn_desc,
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function covid19($key_session, $status, $cNIK){
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
				$status = $this->uri->segment('4');
				$cNIK = $this->uri->segment('5');
				$result = $this->m_essread->covid19($company_id_session, $cNIK);
				$data_array = array();
				if (count($result)==0) {
					$data_1=array(
						"company_id" => $company_id_session,
						"kategori" => 9,
						"photo" => 'default/default.png',
					);
					$data_2=array(
						"company_id" => $company_id_session,
						"kategori" => 10,
						"photo" => 'default/default.png',
					);
					$data_3=array(
						"company_id" => $company_id_session,
						"kategori" => 11,
						"photo" => 'default/default.png',
					);
					array_push($data_array, $data_1);
					array_push($data_array, $data_2);
					array_push($data_array, $data_3);
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$cNIK = $resultList->cNIK;
						$kategori = $resultList->kategori;
						$photo = $resultList->photo;

						$data=array(
							"company_id" => $company_id,
							"cNIK" => $cNIK,
							"kategori" => $kategori,
							"photo" => $photo,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	// upload data photo

	// Payroll

	public function list_manual_transaction($key_session, $cIdPeriod){
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
				$cIdPeriod = $this->uri->segment('4');
				$result = $this->m_essread->list_manual_transaction($company_id_session, $cIdPeriod);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$id_trans_manual = $resultList->id_trans_manual;
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cIDKomponen = $resultList->cIDKomponen;
						$cNmKomponen = $resultList->cNmKomponen;
						$kategori = $resultList->kategori;
						$nNilai = $resultList->nNilai;
						$nNilai_format = number_format($resultList->nNilai, 2);
						$cNote = $resultList->cNote;
						$dTglTrans = $resultList->dTglTrans;
						$cIdPeriod = $resultList->cIdPeriod;
						$cNmPeriod = $resultList->cNmPeriod;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;

						if ($kategori=='P') {
							$kategori_descr = 'Plus';
						}
						else if ($kategori=='M') {
							$kategori_descr = 'Minus';
						}

						if ($dBerlaku_Sdgn==null) {
							$dBerlaku_Sdgn_desc = '';
						}
						else {
							$dBerlaku_Sdgn_desc = $dBerlaku_Sdgn;
						}

						$data=array(
							'id_trans_manual' => $id_trans_manual,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'cNIK' => $cNIK,
							'cNmPegawai' => $cNmPegawai,
							'cIDKomponen' => $cIDKomponen,
							'cNmKomponen' => $cNmKomponen,
							'kategori' => $kategori,
							'nNilai' => $nNilai,
							'nNilai_format' => $nNilai_format,
							'cNote' => $cNote,
							'dTglTrans' => $dTglTrans,
							'cIdPeriod' => $cIdPeriod,
							'cNmPeriod' => $cNmPeriod,
							'create_by' => $create_by,
							'cNmPegawai_create' => $cNmPegawai_create,
							'create_date' => $create_date,
							'last_by' => $last_by,
							'cNmPegawai_last' => $cNmPegawai_last,
							'last_update' => $last_update
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function list_manual_transaction_by_id($key_session, $id_trans_manual){
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
				$id_trans_manual = $this->uri->segment('4');
				$result = $this->m_essread->list_manual_transaction_by_id($company_id_session, $id_trans_manual);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						//$id_trans_manual = $resultList->id_trans_manual;
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cIDKomponen = $resultList->cIDKomponen;
						$cNmKomponen = $resultList->cNmKomponen;
						$kategori = $resultList->kategori;
						$nNilai = $resultList->nNilai;
						$nNilai_format = number_format($resultList->nNilai, 2);
						$cNote = $resultList->cNote;
						$dTglTrans = $resultList->dTglTrans;
						$cIdPeriod = $resultList->cIdPeriod;
						$cNmPeriod = $resultList->cNmPeriod;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;

						if ($kategori=='P') {
							$kategori_descr = 'Plus';
						}
						else if ($kategori=='M') {
							$kategori_descr = 'Minus';
						}

						if ($dBerlaku_Sdgn==null) {
							$dBerlaku_Sdgn_desc = '';
						}
						else {
							$dBerlaku_Sdgn_desc = $dBerlaku_Sdgn;
						}

						$data=array(
							'id_trans_manual' => $id_trans_manual,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'cNIK' => $cNIK,
							'cNmPegawai' => $cNmPegawai,
							'cIDKomponen' => $cIDKomponen,
							'cNmKomponen' => $cNmKomponen,
							'kategori' => $kategori,
							'nNilai' => $nNilai,
							'nNilai_format' => $nNilai_format,
							'cNote' => $cNote,
							'dTglTrans' => $dTglTrans,
							'cIdPeriod' => $cIdPeriod,
							'cNmPeriod' => $cNmPeriod,
							'create_by' => $create_by,
							'cNmPegawai_create' => $cNmPegawai_create,
							'create_date' => $create_date,
							'last_by' => $last_by,
							'cNmPegawai_last' => $cNmPegawai_last,
							'last_update' => $last_update
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function list_history_medical($key_session, $cNIK, $cIdPeriod){
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
				$cNIK = $this->uri->segment('4');
				$cIdPeriod = $this->uri->segment('5');
				$result = $this->m_essread->list_history_medical($company_id_session, $cNIK, $cIdPeriod);
				$data_array = array();
				if (count($result)==0) {
					$status_result = 0;
				}
				else {
					$status_result = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_medical = $resultList->id_medical;
						$unique_transaction = $resultList->unique_transaction;
						$cIdPeriod = $resultList->cIdPeriod;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cNama = $resultList->cNama;
						$dTgl_Berobat = $resultList->dTgl_Berobat;
						$nBiaya_Pengajuan = $resultList->nBiaya_Pengajuan;
						$nBiaya_Approve = $resultList->nBiaya_Approve;
						$cIDHubKel = $resultList->cIDHubKel;
						$cNmHubKel = $resultList->cNmHubKel;
						$cNmRS = $resultList->cNmRS;
						$cNmDokter = $resultList->cNmDokter;
						$diagnosa = $resultList->diagnosa;
						$approve_1 = $resultList->approve_1;
						$approval_1 = $resultList->approval_1;
						$cNmPegawai_approval_1 = $resultList->cNmPegawai_approval_1;
						$approve_2 = $resultList->approve_2;
						$approval_2 = $resultList->approval_2;
						$cNmPegawai_approval_2 = $resultList->cNmPegawai_approval_2;
						$approve_ga = $resultList->approve_ga;
						$approval_ga = $resultList->approval_ga;
						$cNmPegawai_approval_ga = $resultList->cNmPegawai_approval_ga;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;

						$data=array(
							'company_id' => $company_id,
							'company_name' => $company_name,
							'id_medical' => $id_medical,
							'unique_transaction' => $unique_transaction,
							'cIdPeriod' => $cIdPeriod,
							'cNIK' => $cNIK,
							'cNmPegawai' => $cNmPegawai,
							'cNama' => $cNama,
							'dTgl_Berobat' => $dTgl_Berobat,
							'nBiaya_Pengajuan' => $nBiaya_Pengajuan,
							'nBiaya_Approve' => $nBiaya_Approve,
							'cIDHubKel' => $cIDHubKel,
							'cNmHubKel' => $cNmHubKel,
							'cNmRS' => $cNmRS,
							'cNmDokter' => $cNmDokter,
							'diagnosa' => $diagnosa,
							'approve_1' => $approve_1,
							'approval_1' => $approval_1,
							'cNmPegawai_approval_1' => $cNmPegawai_approval_1,
							'approve_2' => $approve_2,
							'approval_2' => $approval_2,
							'cNmPegawai_approval_2' => $cNmPegawai_approval_2,
							'approve_ga' => $approve_ga,
							'approval_ga' => $approval_ga,
							'cNmPegawai_approval_ga' => $cNmPegawai_approval_ga,
							'create_by' => $create_by,
							'cNmPegawai_create' => $cNmPegawai_create,
							'create_date' => $create_date,
							'last_by' => $last_by,
							'cNmPegawai_last' => $cNmPegawai_last,
							'last_update' => $last_update,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'response'=> $data_array)));
			}
		}
	}

	public function list_medical_limit($key_session, $tahun, $cNIK){
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
				$tahun_get = $this->uri->segment('4');
				$cNIK_get = $this->uri->segment('5');
				$result = $this->m_essread->list_medical_limit($company_id_session, $tahun_get, $cNIK_get);

				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cNmJbtn = $resultList->cNmJbtn;
						$tahun = $resultList->tahun;
						$tax_bpjs = $resultList->tax_bpjs;
						$limit_medical = $resultList->limit_medical;
						$limit_medical_format = number_format($limit_medical, 2);

						$result_total_history_medical = $this->m_essread->total_history_medical($company_id_session, $tahun, $cNIK);
				    	$total_history_medical = $result_total_history_medical[0]->total_approve;
				    	$total_history_medical_format = number_format($total_history_medical, 2);

				    	$diff = $limit_medical-$total_history_medical;
				    	$diff_format = number_format($diff, 2);

						$data=array(
							'company_id' => $company_id,
							'company_name' => $company_name,
							'cNIK' => $cNIK,
							'cNmPegawai' => $cNmPegawai,
							'cNmJbtn' => $cNmJbtn,
							'tahun' => $tahun,
							'tax_bpjs' => $tax_bpjs,
							'limit_medical' => $limit_medical,
							'limit_medical_format' => $limit_medical_format,
							'total_history_medical' => $total_history_medical,
							'total_history_medical_format' => $total_history_medical_format,
							'diff' => $diff,
							'diff_format' => $diff_format,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_bpjs($key_session){
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
				$id_bpjs = $this->uri->segment('4');
				$result = $this->m_essread->list_bpjs($company_id_session, $id_bpjs);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_bpjs = $resultList->id_bpjs;
						$nama_bpjs = $resultList->nama_bpjs;
						$alias = $resultList->alias;
						$company = $resultList->company;
						$max_salary_company = $resultList->max_salary_company;
						$personal = $resultList->personal;
						$max_salary_personal = $resultList->max_salary_personal;
						$deleted = $resultList->deleted;

						$data=array(
							"company_id" => $company_id,
							"company_name" => $company_name,
							"id_bpjs" => $id_bpjs,
							"nama_bpjs" => $nama_bpjs,
							"alias" => $alias,
							"company" => $company,
							"max_salary_company" => $max_salary_company,
							"max_salary_company_format" => number_format($max_salary_company, 2),
							"personal" => $personal,
							"max_salary_personal" => $max_salary_personal,
							"max_salary_personal_format" => number_format($max_salary_personal, 2),
							"deleted" => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_pkp_ptkp($key_session){
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
				$result = $this->m_essread->list_pkp_ptkp($company_id_session);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_pkp_ptkp = $resultList->id_pkp_ptkp;
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$istri_company = $resultList->istri_company;
						$istri_personal = $resultList->istri_personal;
						$anak_company = $resultList->anak_company;
						$anak_personal = $resultList->anak_personal;
						$nominal_default = $resultList->nominal_default;
						$jumlah_bulan = $resultList->jumlah_bulan;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;
						$deleted = $resultList->deleted;

						$data=array(
							'id_pkp_ptkp' => $id_pkp_ptkp,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'istri_company' => $istri_company,
							'istri_personal' => $istri_personal,
							'anak_company' => $anak_company,
							'anak_personal' => $anak_personal,
							'nominal_default' => $nominal_default,
							'jumlah_bulan' => $jumlah_bulan,
							'create_by' => $create_by,
							'cNmPegawai_create' => $cNmPegawai_create,
							'create_date' => $create_date,
							'last_by' => $last_by,
							'cNmPegawai_last' => $cNmPegawai_last,
							'last_update' => $last_update,
							'deleted' => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_pkp_ptkp_formula($key_session, $id_pkp_ptkp_formula, $category){
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
				$id_pkp_ptkp_formula = $this->uri->segment('4');
				$category = $this->uri->segment('5');
				$result = $this->m_essread->list_pkp_ptkp_formula($company_id_session, $id_pkp_ptkp_formula, $category);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						if ($category==1) {
							$id_pkp_ptkp_formula = $resultList->id_pkp_ptkp_formula_company;
						}
						else if ($category==2) {
							$id_pkp_ptkp_formula = $resultList->id_pkp_ptkp_formula_personal;
						}
						
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$range_start = $resultList->range_start;
						$range_end = $resultList->range_end;
						$range_start_format = number_format($resultList->range_start, 2);
						$range_end_format = number_format($resultList->range_end, 2);
						$npwp_percent = $resultList->npwp_percent;
						$non_npwp_percent = $resultList->non_npwp_percent;
						$minus_npwp = $resultList->minus_npwp;
						$minus_non_npwp = $resultList->minus_non_npwp;
						$minus_npwp_format = number_format($resultList->minus_npwp, 2);
						$minus_non_npwp_format = number_format($resultList->minus_non_npwp, 2);
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;
						$deleted = $resultList->deleted;

						$data=array(
							'id_pkp_ptkp_formula' => $id_pkp_ptkp_formula,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'range_start' => $range_start,
							'range_end' => $range_end,
							'range_start_format' => $range_start_format,
							'range_end_format' => $range_end_format,
							'npwp_percent' => $npwp_percent,
							'non_npwp_percent' => $non_npwp_percent,
							'minus_npwp' => $minus_npwp,
							'minus_non_npwp' => $minus_non_npwp,
							'minus_npwp_format' => $minus_npwp_format,
							'minus_non_npwp_format' => $minus_non_npwp_format,
							'create_by' => $create_by,
							'cNmPegawai_create' => $cNmPegawai_create,
							'create_date' => $create_date,
							'last_by' => $last_by,
							'cNmPegawai_last' => $cNmPegawai_last,
							'last_update' => $last_update,
							'deleted' => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_salary_deduction($key_session){
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
				$result = $this->m_essread->list_salary_deduction($company_id_session);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_pkp_ptkp = $resultList->id_pkp_ptkp;
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$month = $resultList->month;
						$week = $resultList->week;
						$day = $resultList->day;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;
						$deleted = $resultList->deleted;

						$data=array(
							'id_pkp_ptkp' => $id_pkp_ptkp,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'month' => $month,
							'week' => $week,
							'day' => $day,
							'create_by' => $create_by,
							'cNmPegawai_create' => $cNmPegawai_create,
							'create_date' => $create_date,
							'last_by' => $last_by,
							'cNmPegawai_last' => $cNmPegawai_last,
							'last_update' => $last_update,
							'deleted' => $deleted,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}


	// Temp


	/*public function list_work_calendar($key_session, $cGroupID, $year_get){
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
				$cGroupID = $this->uri->segment('4');
				$year_get = $this->uri->segment('5');
				
				function cal_days_in_year($year){
					$days=0; 
					for($month=1;$month<=12;$month++){ 
						$days = $days + cal_days_in_month(CAL_GREGORIAN,$month,$year);
					}
					return $days;
				}

				function weekOfMonth($date) {
					$firstOfMonth = strtotime(date("Y-m-01", $date));
					return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
				}

				function weekOfYear($date) {
				    $weekOfYear = intval(date("W", $date));
				    if (date('n', $date) == "1" && $weekOfYear > 51) {
				        return 0;
				    }
				    else if (date('n', $date) == "12" && $weekOfYear == 1) {
				        return 53;
				    }
				    else {
				        return $weekOfYear;
				    }
				}

				function weekOfMonth_2($date) {
				    // estract date parts
				    list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));

				    $w = 1;
				    
				    for ($i = 1; $i < $d; ++$i) {
				        // if that day was a sunday and is not the first day of month
				        if ($i > 1 && date('w', strtotime("$y-$m-$i")) == 0) {
				            // increment current week
				            ++$w;
				        }
				    }
				    
				    // now return
				    return $w;
				}

				$total_day = cal_days_in_year($year_get);

				$data_bulan_array = array();
				for ($a=1; $a <=12 ; $a++) {
					$day_of_month_number=cal_days_in_month(CAL_GREGORIAN, $a, $year_get);

					$date_start = date_format(date_create($year_get.'-'.$a.'-01'), 'Y-m-d');
					$date_end = date_format(date_create($year_get.'-'.$a.'-'.$day_of_month_number), 'Y-m-d');

					$data_array = array();
					for ($i=0; $i < $day_of_month_number; $i++) { 
						$dTglHdr = date('Y-m-d', strtotime($date_start . '+'.$i.' day'));
						$dTglHdr_day_name = date_format(date_create($dTglHdr), 'l');

						$in = '';
						if ($dTglHdr_day_name=="Sunday") {
							$getChangeDay = $this->m_essread->list_change_day_by_date($company_id_session, $dTglHdr, $cGroupID);
							if (count($getChangeDay)>=1) {
								$in = '1';
								$note = 'Change Day';
							}
							else {
								$getChangeDay_all = $this->m_essread->list_change_day_by_date($company_id_session, $dTglHdr, 'ALL');
								if (count($getChangeDay_all)>=1) {
									$in = '1';
									$note = 'Change Day';
								}
								else {
									$in = '0';
									$note = 'Weekend - Sunday';
								}
							}
						}
						else if ($dTglHdr_day_name=="Saturday") {
							$getChangeDay = $this->m_essread->list_change_day_by_date($company_id_session, $dTglHdr, $cGroupID);
							if (count($getChangeDay)>=1) {
								$in = '1';
								$note = 'Change Day';
							}
							else {
								$getChangeDay_all = $this->m_essread->list_change_day_by_date($company_id_session, $dTglHdr, 'ALL');
								if (count($getChangeDay_all)>=1) {
									$in = '1';
									$note = 'Change Day';
								}
								else {
									$getMandatoryOvertime = $this->m_essread->list_mandatory_overtime_by_date($company_id_session, $dTglHdr, $cGroupID);
									if (count($getMandatoryOvertime)>=1) {
										$in = '2';
										$note = 'Mandatory Overtime';
									}
									else {
										$in = '0';
										$note = 'Weekend - Saturday';
									}
								}
							}
						}
						else {
							$getNationalHolliday = $this->m_essread->list_national_holiday_by_date($company_id_session, $dTglHdr, $cGroupID);
							if (count($getNationalHolliday)>=1) {
								$nama_hari_libur = $getNationalHolliday[0]->nama_hari_libur;
								$in = '0';
								$note = $nama_hari_libur;
							}
							else {
								$getNationalHolliday_all = $this->m_essread->list_national_holiday_by_date($company_id_session, $dTglHdr, 'ALL');
								if (count($getNationalHolliday_all)>=1) {
									$nama_hari_libur = $getNationalHolliday_all[0]->nama_hari_libur;
									$in = '0';
									$note = $nama_hari_libur;
								}
								else {
									$in = '1';
									$note = '';
								}
							}	
						}

						$week_number = (weekOfMonth(strtotime($dTglHdr)))*1;
						$month_name = date_format(date_create($dTglHdr), 'F');
						$month_number = date_format(date_create($dTglHdr), 'm')*1;
						$day_number = date('N', strtotime($dTglHdr_day_name))*1;						

						$data=array(
							'no' => $i,
							'month_name' => date_format(date_create($dTglHdr), 'F'),
							'month_number' => date_format(date_create($dTglHdr), 'm')*1,
							'week_number' => $week_number,
							'day_number' => date('N', strtotime($dTglHdr_day_name))*1,
							'dTglHdr' => $dTglHdr,
							'dTgl' => date_format(date_create($dTglHdr), 'd')*1,
							'dTglHdr_day_name' => $dTglHdr_day_name,
							'in' => $in*1,
							'note' => $note
						);
						array_push($data_array, $data);
					}

					$weeks_in_month_header = weekOfMonth_2($date_end);

					$data_bulan=array(
						'month_id' => $a,
						'weeks_in_month_header' => $weeks_in_month_header,
						'month_name_header' => date_format(date_create($year_get.'-'.$a.'-01'), 'F'),
						'day_number_of_month' => $day_of_month_number,
						'date_end' => $date_end,
						'data_array' => $data_array
					);
					array_push($data_bulan_array, $data_bulan);
				}
				echo json_encode(array(array(
					'year' => $year_get,
					'cGroupID' => $cGroupID, 
					'total_day' => $total_day,
					'month' => $data_bulan_array
				)));
			}
		}
	}*/

}