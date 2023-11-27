<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class OvertimeRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_overtimeread');
        //$this->load->model('m_essupdate');
        //$this->load->model('m_ess');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// Overtime
	// Setting

	public function list_time_deadline($key_session){
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
				$result = $this->m_overtimeread->list_time_deadline($company_id_session);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data=array(
							'id_ot_timeline' => $resultList->id_ot_timeline,
							'company_id' => $resultList->company_id,
							'daily_maker' => date_format(date_create($resultList->daily_maker), 'H:i'),
							'daily_approval' => date_format(date_create($resultList->daily_approval), 'H:i'),
							'holiday_maker' => date_format(date_create($resultList->holiday_maker), 'H:i'),
							'holiday_approval' => date_format(date_create($resultList->holiday_approval), 'H:i'),
							'create_by' => $resultList->create_by,
							'cNmPegawai_create' => $resultList->cNmPegawai_create,
							'create_date' => $resultList->create_date,
							'last_by' => $resultList->last_by,
							'cNmPegawai_last' => $resultList->cNmPegawai_last,
							'last_update' => $resultList->last_update,
							'company_code' => $resultList->company_code,
							'company_name' => $resultList->company_name,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_maker_approval($key_session, $category, $id_ot_maker){
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
				$result = $this->m_overtimeread->list_maker_approval($company_id_session, $category, $id_ot_maker);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data=array(
							'id_ot_maker' => $resultList->id_ot_maker,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'category' => $resultList->category,
							'cIDDept' => $resultList->cIDDept,
							'cNmDept' => $resultList->cNmDept,
							'cIDBag' => $resultList->cIDBag,
							'cNmBag' => $resultList->cNmBag,
							'cNIK' => $resultList->cNIK,
							'maker_approval' => $resultList->maker_approval,
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
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_employee_by_dept_div($key_session, $status, $cIDDept, $cIDBag){
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
				$cIDDept = $this->uri->segment('5');
				$cIDBag = $this->uri->segment('6');
				$result = $this->m_overtimeread->list_employee_by_dept_div($company_id_session, $status, $cIDDept, $cIDBag);
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
							$cNmDept = $resultList->cNmDept;
							$cNmBag = $resultList->cNmBag;
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
								"cNmDept" => $cNmDept_ket,
								"cNmBag" => $cNmBag_ket,
								"cNmJbtn" => $cNmJbtn_ket,
								"cGroupNm" => $cGroupNm_ket
							);
							array_push($data_array, $data);
						}
					}					
				}				
				echo json_encode(array(array('status' => $status_result, 'company_id' => $company_id_session, 'status_get' => $status, 'cIDDept' => $cIDDept, 'cIDBag' => $cIDBag, 'response'=> $data_array)));
			}
		}
	}

	// Input

	public function list_daily_overtime($key_session, $category, $id_lembur, $dTglHdr, $cIDDept, $cIDBag){
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
				$id_lembur = $this->uri->segment('5');
				$dTglHdr = $this->uri->segment('6');
				$cIDDept = $this->uri->segment('7');
				$cIDBag = $this->uri->segment('8');

				$result = $this->m_overtimeread->list_daily_overtime($company_id_session, $category, $dTglHdr, $id_lembur, $cIDDept, $cIDBag);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data=array(
							'id_lembur' => $resultList->id_lembur,
							'company_id' => $resultList->company_id,
							'cNIK' => $resultList->cNIK,
							'cNmPegawai' => $resultList->cNmPegawai,
							'cIDDept' => $resultList->cIDDept,
							'cNmDept' => $resultList->cNmDept,
							'cIDBag' => $resultList->cIDBag,
							'cNmBag' => $resultList->cNmBag,
							'cShiftID' => $resultList->cShiftID,
							'dTglHdr' => $resultList->dTglHdr,
							'dTglHdr_format' => date_format(date_create($resultList->dTglHdr), 'd M Y'),
							'job' => $resultList->job,
							'kategori' => $resultList->kategori,
							'plan_start' => $resultList->plan_start,
							'plan_end' => $resultList->plan_end,
							'catering' => $resultList->catering,
							'approve' => $resultList->approve,
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
				echo json_encode(array(array('status' => $status, 'dTglHdr' => $dTglHdr, 'cIDDept' => $cIDDept, 'cIDBag' => $cIDBag, 'response'=> $data_array)));
			}
		}
	}

	public function list_approve_overtime($key_session, $category, $cIDDept, $cIDBag){
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
				$cIDDept = $this->uri->segment('5');
				$cIDBag = $this->uri->segment('6');
				$result = $this->m_overtimeread->list_approve_overtime($company_id_session, $category, $cIDDept, $cIDBag);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data=array(
							'id_lembur' => $resultList->id_lembur,
							'company_id' => $resultList->company_id,
							'cNIK' => $resultList->cNIK,
							'cNmPegawai' => $resultList->cNmPegawai,
							'cIDDept' => $resultList->cIDDept,
							'cNmDept' => $resultList->cNmDept,
							'cIDBag' => $resultList->cIDBag,
							'cNmBag' => $resultList->cNmBag,
							'cShiftID' => $resultList->cShiftID,
							'dTglHdr' => $resultList->dTglHdr,
							'job' => $resultList->job,
							'kategori' => $resultList->kategori,
							'plan_start' => $resultList->plan_start,
							'plan_end' => $resultList->plan_end,
							'catering' => $resultList->catering,
							'approve' => $resultList->approve,
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
				echo json_encode(array(array('status' => $status, 'category' => $category, 'cIDDept' => $cIDDept, 'cIDBag' => $cIDBag, 'response'=> $data_array)));
			}
		}
	}

	public function list_catering_overtime($key_session, $category){
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
				$data_array = array();
				for ($i=0; $i < 3; $i++) { 
					$result = $this->m_overtimeread->list_catering_overtime($company_id_session, $category, ($i+1));
					if (count($result)==0) {
						$data=array(
							'plant' => ($i+1),
							'sum' => 0,
						);
					}
					else {
						$sum = $result[0]->sum;
						$data=array(
							'plant' => ($i+1),
							'sum' => $sum,
						);
					}
					array_push($data_array, $data);
				}
								
				echo json_encode(array(array('status' => 1, 'category' => $category, 'response'=> $data_array)));
			}
		}
	}

	public function list_company_plant($key_session, $id_plant){
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
				$data_array = array();
				$result = $this->m_overtimeread->list_company_plant($company_id_session, $id_plant);
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data=array(
							'id_plant' => $resultList->id_plant,
							'plant' => $resultList->plant
						);
						array_push($data_array, $data);
					}
					if ($company_id_session==1){
						$data=array(
							'id_plant' => 3,
							'plant' => 'Driver'
						);
						array_push($data_array, $data);
					}				
				}
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

}