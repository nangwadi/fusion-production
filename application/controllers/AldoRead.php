<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class AldoRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_aldoread');
        //$this->load->model('m_essupdate');
        //$this->load->model('m_ess');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// aldo
	// Setting

	public function list_annual_leave($key_session, $id_cuti_master, $year){
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
				$id_cuti_master = $this->uri->segment('4');
				$year = $this->uri->segment('5');
				$result = $this->m_aldoread->list_annual_leave($company_id_session, $id_cuti_master, $year);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cNIK = $resultList->cNIK;
						$year = $resultList->year;
						$total = $resultList->total;
						$cuti_bsm = $resultList->cuti_bsm;
						
						$result_total_al = $this->m_aldoread->total_annual_leave_used($company_id_session, $cNIK, $year);
						if (count($result_total_al)==0) {
							$annual_leave_used = 0;
						}
						else {
							$annual_leave_used = $result_total_al[0]->total;
						}

						$annual_leave_diff = $total-($cuti_bsm+$annual_leave_used);

						$data=array(
							'id_cuti_master' => $resultList->id_cuti_master,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'cNIK' => $resultList->cNIK,
							'cNmPegawai' => $resultList->cNmPegawai,
							'cNmBag' => $resultList->cNmBag,
							'cNmDept' => $resultList->cNmDept,
							'total' => $resultList->total,
							'cuti_bsm' => $resultList->cuti_bsm,
							'annual_leave_used' => $annual_leave_used,
							'annual_leave_diff' => $annual_leave_diff,
							'year' => $resultList->year,
							'dTglBerlaku_Dari' => $resultList->dTglBerlaku_Dari,
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

	public function list_department_approval($key_session, $id_approve){
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
				$id_approve = $this->uri->segment('4');
				$result = $this->m_aldoread->list_department_approval($company_id_session, $id_approve);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cNmPegawai_approve1 = $resultList->cNmPegawai_approve1;
						if ($cNmPegawai_approve1==null) {
							$cNmPegawai_approve1_show = '';
						}
						else {
							$cNmPegawai_approve1_show = $resultList->cNmPegawai_approve1;
						}

						$data=array(
							'id_approve' => $resultList->id_approve,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'cIDDept' => $resultList->cIDDept,
							'cIDBag' => $resultList->cIDBag,
							'cIDJbtn' => $resultList->cIDJbtn,
							'cNmDept' => $resultList->cNmDept,
							'cNmBag' => $resultList->cNmBag,
							'cNmJbtn' => $resultList->cNmJbtn,
							'approve1' => $resultList->approve1,
							'cNmPegawai_approve1' => $cNmPegawai_approve1_show,
							'approve2' => $resultList->approve2,
							'cNmPegawai_approve2' => $resultList->cNmPegawai_approve2,
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

	public function list_ga_approval($key_session, $id_approve){
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
				$id_approve = $this->uri->segment('4');
				$result = $this->m_aldoread->list_ga_approval($company_id_session, $id_approve);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cNmPegawai_approve1 = $resultList->cNmPegawai_approve1;
						if ($cNmPegawai_approve1==null) {
							$cNmPegawai_approve1_show = '';
						}
						else {
							$cNmPegawai_approve1_show = $resultList->cNmPegawai_approve1;
						}

						$data=array(
							'id_approve' => $resultList->id_approve,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'ga1' => $resultList->ga1,
							'cNmPegawai_ga1' => $resultList->cNmPegawai_ga1,
							'ga2' => $resultList->ga2,
							'cNmPegawai_ga2' => $resultList->cNmPegawai_ga2,
							'ga3' => $resultList->ga3,
							'cNmPegawai_ga3' => $resultList->cNmPegawai_ga3,
							'ga4' => $resultList->ga4,
							'cNmPegawai_ga4' => $resultList->cNmPegawai_ga4,
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

	public function list_special_approval($key_session, $id_approve_special){
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
				$id_approve_special = $this->uri->segment('4');
				$result = $this->m_aldoread->list_special_approval($company_id_session, $id_approve_special);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){

						$data=array(
							'id_approve_special' => $resultList->id_approve_special,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'cNIK' => $resultList->cNIK,
							'cNmPegawai' => $resultList->cNmPegawai,
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

	public function list_approve_all($key_session, $id_approve_all){
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
				$id_approve_all = $this->uri->segment('4');
				$result = $this->m_aldoread->list_approve_all($company_id_session, $id_approve_all);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){

						$data=array(
							'id_approve_all' => $resultList->id_approve_all,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'cNIK' => $resultList->cNIK,
							'cNmPegawai' => $resultList->cNmPegawai,
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

	public function list_employee_by_department($key_session, $cIDDept){
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
				$result = $this->m_aldoread->list_employee_by_department($company_id_session, $cIDDept);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cNmPegawai_approve1 = $resultList->cNmPegawai_approve1;
						if ($cNmPegawai_approve1==null) {
							$cNmPegawai_approve1_show = '';
						}
						else {
							$cNmPegawai_approve1_show = $resultList->cNmPegawai_approve1;
						}

						$data=array(
							'cNIK' => $resultList->cNIK,
							'cNmPegawai' => $resultList->cNmPegawai,
						);
						array_push($data_array, $data);
					}
				}				
				echo json_encode(array(array('status' => $status, 'cIDDept' => $cIDDept, 'response'=> $data_array)));
			}
		}
	}

	public function list_day_off($key_session, $id_cuti_day_off){
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
				$id_cuti_day_off = $this->uri->segment('4');
				$result = $this->m_aldoread->list_day_off($company_id_session, $id_cuti_day_off);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){

						$data=array(
							'id_cuti_day_off' => $resultList->id_cuti_day_off,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'cIDAbsen' => $resultList->cIDAbsen,
							'cNmAbsen' => $resultList->cNmAbsen,
							'annual_leave' => $resultList->annual_leave,
							'cuti_khusus' => $resultList->cuti_khusus,
							'images' => $resultList->images,
							'cuti_tahunan_min' => $resultList->cuti_tahunan_min,
							'max' => $resultList->max,
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

	// Input

	public function list_day_off_input($key_session, $cIDAbsen, $id_cuti){
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
				$id_cuti = $this->uri->segment('5');
				$result = $this->m_aldoread->list_day_off_input($company_id_session, $cIDAbsen, $cNIK_session, date('Y'), $id_cuti);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data=array(
							'id_cuti' => $resultList->id_cuti,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'year' => $resultList->year,
							'cNIK' => $resultList->cNIK,
							'cNmPegawai' => $resultList->cNmPegawai,
							'date_start' => $resultList->date_start,
							'date_start_format' => date_format(date_create($resultList->date_start), 'd M Y'),
							'date_end' => $resultList->date_end,
							'total' => $resultList->total,
							'cIDAbsen' => $resultList->cIDAbsen,
							'cNmAbsen' => $resultList->cNmAbsen,
							'sub_type' => $resultList->sub_type,
							'note' => $resultList->note,
							'img1' => $resultList->img1,
							'img2' => $resultList->img2,
							'img3' => $resultList->img3,
							'img4' => $resultList->img4,
							'img5' => $resultList->img5,
							'approve1' => $resultList->approve1,
							'date_approve1' => $resultList->date_approve1,
							'approve1_by' => $resultList->approve1_by,
							'cNmPegawai_approve1' => $resultList->cNmPegawai_approve1,
							'approve1_reject' => $resultList->approve1_reject,
							'approve2' => $resultList->approve2,
							'date_approve2' => $resultList->date_approve2,
							'approve2_by' => $resultList->approve2_by,
							'cNmPegawai_approve2' => $resultList->cNmPegawai_approve2,
							'approve2_reject' => $resultList->approve2_reject,
							'ga1' => $resultList->ga1,
							'date_ga1' => $resultList->date_ga1,
							'ga1_by' => $resultList->ga1_by,
							'cNmPegawai_ga1' => $resultList->cNmPegawai_ga1,
							'ga1_reject' => $resultList->ga1_reject,
							'ga2' => $resultList->ga2,
							'date_ga2' => $resultList->date_ga2,
							'ga2_by' => $resultList->ga2_by,
							'cNmPegawai_ga2' => $resultList->cNmPegawai_ga2,
							'ga2_reject' => $resultList->ga2_reject,
							'ga3' => $resultList->ga3,
							'date_ga3' => $resultList->date_ga3,
							'ga3_by' => $resultList->ga3_by,
							'cNmPegawai_ga3' => $resultList->cNmPegawai_ga3,
							'ga3_reject' => $resultList->ga3_reject,
							'ga4' => $resultList->ga4,
							'date_ga4' => $resultList->date_ga4,
							'ga4_by' => $resultList->ga4_by,
							'cNmPegawai_ga4' => $resultList->cNmPegawai_ga4,
							'ga4_reject' => $resultList->ga4_reject,
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

	// Approval

	public function list_cuti_approval_input($key_session, $category, $cIDAbsen){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');

			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('3');
			if ($key_session_get!=$key_session) {
				$this->load->view('login');
			}
			else {
				$category = $this->uri->segment('4');
				$cIDAbsen_get = $this->uri->segment('5');
				$result = $this->m_aldoread->list_day_off_by_precense_id($company_id_session, $cIDAbsen_get);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cIDAbsen = $resultList->cIDAbsen;
						if ($category=='department') {	
							$result_cuti_approval_1_array = array();						
							$result_department_approval_1 = $this->m_aldoread->list_department_approval_by_employee_approve($company_id_session, $cNIK_session, 'approve1');
							if (count($result_department_approval_1)>=1) {
								foreach ($result_department_approval_1 as $result_department_approval_1_list){
									$cIDDept_get = $result_department_approval_1_list->cIDDept;
									$cIDBag_get = $result_department_approval_1_list->cIDBag;
									$result_cuti_approval_1 = $this->m_aldoread->list_cuti_approval($company_id_session, $cIDDept_get, $cIDBag_get, $category, $cIDAbsen, 'approve1', $cNIK_session);
									if (count($result_cuti_approval_1)>=1) {
										foreach ($result_cuti_approval_1 as $result_cuti_approval_1_list){
											$sub_type = $result_cuti_approval_1_list->sub_type;
											if ($sub_type=='SH') {
												$sub_type_desc = 'Full Day';
											}
											else if ($sub_type=='SHP') {
												$sub_type_desc = 'Half Day - Morning';
											}
											else if ($sub_type=='SHS') {
												$sub_type_desc = 'Half Day - Afternoon';
											}
											else {
												$sub_type_desc = '';
											}

											$cNIK = $result_cuti_approval_1_list->cNIK;
											$list_annual_leave = $this->m_aldoread->list_annual_leave_by_employee($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'));
											$total = ($list_annual_leave[0]->total)*1;

											$list_day_off_annual_leave = $this->m_aldoread->list_day_off_annual_leave($company_id_session);
											$cIDAbsen_annual_leave = $list_day_off_annual_leave[0]->cIDAbsen;

											$list_annual_leave_used = $this->m_aldoread->total_annual_leave_used($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'), $cIDAbsen_annual_leave);
											$total_used = ($list_annual_leave_used[0]->total)*1;
											$diff = $total - $total_used;

											$cuti_approval_1 = array (
												'id_cuti' => $result_cuti_approval_1_list->id_cuti,
												'cNIK' => $result_cuti_approval_1_list->cNIK,
												'cNmPegawai' => $result_cuti_approval_1_list->cNmPegawai,
												'date_start' => $result_cuti_approval_1_list->date_start,
												'date_start_format' => date_format(date_create($result_cuti_approval_1_list->date_start), 'd M Y'),
												'total' => $result_cuti_approval_1_list->total,
												'sub_type' => $result_cuti_approval_1_list->sub_type,
												'sub_type_desc' => $sub_type_desc,
												'note' => $result_cuti_approval_1_list->note,
												'cIDDept' => $result_cuti_approval_1_list->cIDDept,
												'cNmDept' => $result_cuti_approval_1_list->cNmDept,
												'cIDBag' => $result_cuti_approval_1_list->cIDBag,
												'cNmBag' => $result_cuti_approval_1_list->cNmBag,
												'cIDJbtn' => $result_cuti_approval_1_list->cIDJbtn,
												'cNmJbtn' => $result_cuti_approval_1_list->cNmJbtn,
												'img1' => $result_cuti_approval_1_list->img1,
												'img2' => $result_cuti_approval_1_list->img2,
												'img3' => $result_cuti_approval_1_list->img3,
												'total' =>  $total,
												'total_used' => $total_used,
												'diff' => $diff,
												'approve' => 'approve1'
											);
											array_push($result_cuti_approval_1_array, $cuti_approval_1);
										}
									}
								}
							}
							
							$result_department_approval_2 = $this->m_aldoread->list_department_approval_by_employee_approve($company_id_session, $cNIK_session, 'approve2');
							if (count($result_department_approval_2)>=1) {
								foreach ($result_department_approval_2 as $result_department_approval_2_list){
									$cIDDept_get = $result_department_approval_2_list->cIDDept;
									$cIDBag_get = $result_department_approval_2_list->cIDBag;
									$result_cuti_approval_2 = $this->m_aldoread->list_cuti_approval($company_id_session, $cIDDept_get, $cIDBag_get, $category, $cIDAbsen, 'approve2', $cNIK_session);
									if (count($result_cuti_approval_2)>=1) {
										foreach ($result_cuti_approval_2 as $result_cuti_approval_2_list){
											$sub_type = $result_cuti_approval_2_list->sub_type;
											if ($sub_type=='SH') {
												$sub_type_desc = 'Full Day';
											}
											else if ($sub_type=='SHP') {
												$sub_type_desc = 'Half Day - Morning';
											}
											else if ($sub_type=='SHS') {
												$sub_type_desc = 'Half Day - Afternoon';
											}
											else {
												$sub_type_desc = '';
											}

											$cNIK = $result_cuti_approval_1_list->cNIK;
											$list_annual_leave = $this->m_aldoread->list_annual_leave_by_employee($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'));
											$total = ($list_annual_leave[0]->total)*1;

											if ($company_id_session==1) {
												$cIDAbsen_annual_leave = 'CT';
											}

											$list_day_off_annual_leave = $this->m_aldoread->list_day_off_annual_leave($company_id_session);
											$cIDAbsen_annual_leave = $list_day_off_annual_leave[0]->cIDAbsen;

											$list_annual_leave_used = $this->m_aldoread->total_annual_leave_used($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'), $cIDAbsen_annual_leave);
											$total_used = ($list_annual_leave_used[0]->total)*1;
											$diff = $total - $total_used;

											$cuti_approval_2 = array (
												'id_cuti' => $result_cuti_approval_2_list->id_cuti,
												'cNIK' => $result_cuti_approval_2_list->cNIK,
												'cNmPegawai' => $result_cuti_approval_2_list->cNmPegawai,
												'date_start' => $result_cuti_approval_2_list->date_start,
												'date_start_format' => date_format(date_create($result_cuti_approval_2_list->date_start), 'd M Y'),
												'total' => $result_cuti_approval_2_list->total,
												'sub_type' => $result_cuti_approval_2_list->sub_type,
												'sub_type_desc' => $sub_type_desc,
												'note' => $result_cuti_approval_2_list->note,
												'cIDDept' => $result_cuti_approval_2_list->cIDDept,
												'cNmDept' => $result_cuti_approval_2_list->cNmDept,
												'cIDBag' => $result_cuti_approval_2_list->cIDBag,
												'cNmBag' => $result_cuti_approval_2_list->cNmBag,
												'cIDJbtn' => $result_cuti_approval_2_list->cIDJbtn,
												'cNmJbtn' => $result_cuti_approval_2_list->cNmJbtn,
												'img1' => $result_cuti_approval_2_list->img1,
												'img2' => $result_cuti_approval_2_list->img2,
												'img3' => $result_cuti_approval_2_list->img3,
												'total' =>  $total,
												'total_used' => $total_used,
												'diff' => $diff,
												'approve' => 'approve2'
											);
											array_push($result_cuti_approval_1_array, $cuti_approval_2);
										}
									}
								}
							}

							$data=array(
								'cNIK_session' => $cNIK_session,
								'cIDAbsen' => $resultList->cIDAbsen,
								'cNmAbsen' => $resultList->cNmAbsen,
								'count' => count($result_cuti_approval_1)+count($result_cuti_approval_2),
								'approve1' => count($result_cuti_approval_1),
								'approve2' => count($result_cuti_approval_2),
								'result_cuti_approval_1' => $result_cuti_approval_1_array,
							);
							array_push($data_array, $data);							
						}
						else if ($category=='ga'){
							$result_ga_approval = $this->m_aldoread->list_ga_approval($company_id_session, 0);
							$ga1 = $result_ga_approval[0]->ga1;
							$ga2 = $result_ga_approval[0]->ga2;
							$ga3 = $result_ga_approval[0]->ga3;
							$ga4 = $result_ga_approval[0]->ga4;
							if ($ga1==$cNIK_session) {
								$column = 'ga1';
							}
							if ($ga2==$cNIK_session) {
								$column = 'ga2';
							}
							if ($ga3==$cNIK_session) {
								$column = 'ga3';
							}
							if ($ga4==$cNIK_session) {
								$column = 'ga4';
							}
							
							$result_cuti_approval_1_array = array();						
							$result_cuti_approval_1 = $this->m_aldoread->list_cuti_approval($company_id_session, '', '', $category, $cIDAbsen, $column, $cNIK_session);
							if (count($result_cuti_approval_1)>=1) {
								foreach ($result_cuti_approval_1 as $result_cuti_approval_1_list){
									$sub_type = $result_cuti_approval_1_list->sub_type;
									if ($sub_type=='SH') {
										$sub_type_desc = 'Full Day';
									}
									else if ($sub_type=='SHP') {
										$sub_type_desc = 'Half Day - Morning';
									}
									else if ($sub_type=='SHS') {
										$sub_type_desc = 'Half Day - Afternoon';
									}
									else {
										$sub_type_desc = '';
									}

									$cNIK = $result_cuti_approval_1_list->cNIK;
									$list_annual_leave = $this->m_aldoread->list_annual_leave_by_employee($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'));
									$total = ($list_annual_leave[0]->total)*1;

									$list_day_off_annual_leave = $this->m_aldoread->list_day_off_annual_leave($company_id_session);
									$cIDAbsen_annual_leave = $list_day_off_annual_leave[0]->cIDAbsen;

									$list_annual_leave_used = $this->m_aldoread->total_annual_leave_used($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'), $cIDAbsen_annual_leave);
									$total_used = ($list_annual_leave_used[0]->total)*1;
									$diff = $total - $total_used;

									$cuti_approval_1 = array (
										'id_cuti' => $result_cuti_approval_1_list->id_cuti,
										'cNIK' => $result_cuti_approval_1_list->cNIK,
										'cNmPegawai' => $result_cuti_approval_1_list->cNmPegawai,
										'date_start' => $result_cuti_approval_1_list->date_start,
										'date_start_format' => date_format(date_create($result_cuti_approval_1_list->date_start), 'd M Y'),
										'total' => $result_cuti_approval_1_list->total,
										'sub_type' => $result_cuti_approval_1_list->sub_type,
										'sub_type_desc' => $sub_type_desc,
										'note' => $result_cuti_approval_1_list->note,
										'cIDDept' => $result_cuti_approval_1_list->cIDDept,
										'cNmDept' => $result_cuti_approval_1_list->cNmDept,
										'cIDBag' => $result_cuti_approval_1_list->cIDBag,
										'cNmBag' => $result_cuti_approval_1_list->cNmBag,
										'cIDJbtn' => $result_cuti_approval_1_list->cIDJbtn,
										'cNmJbtn' => $result_cuti_approval_1_list->cNmJbtn,
										'img1' => $result_cuti_approval_1_list->img1,
										'img2' => $result_cuti_approval_1_list->img2,
										'img3' => $result_cuti_approval_1_list->img3,
										'total' =>  $total,
										'total_used' => $total_used,
										'diff' => $diff,
										'approve' => $column
									);
									array_push($result_cuti_approval_1_array, $cuti_approval_1);
								}
							}

							$data=array(
								'cNIK_session' => $cNIK_session,
								'cIDAbsen' => $resultList->cIDAbsen,
								'cNmAbsen' => $resultList->cNmAbsen,
								'count' => count($result_cuti_approval_1)+count($result_cuti_approval_2),
								'approve1' => count($result_cuti_approval_1),
								'approve2' => count($result_cuti_approval_2),
								'result_cuti_approval_1' => $result_cuti_approval_1_array,
							);
							array_push($data_array, $data);	
						}
						else if ($category=='all') {	
							$result_cuti_approval_1_array = array();
							$result_cuti_approval_1 = $this->m_aldoread->list_cuti_approval($company_id_session, '', '', 'all', $cIDAbsen, '', '');
							if (count($result_cuti_approval_1)>=1) {
								foreach ($result_cuti_approval_1 as $result_cuti_approval_1_list){
									$sub_type = $result_cuti_approval_1_list->sub_type;
									if ($sub_type=='SH') {
										$sub_type_desc = 'Full Day';
									}
									else if ($sub_type=='SHP') {
										$sub_type_desc = 'Half Day - Morning';
									}
									else if ($sub_type=='SHS') {
										$sub_type_desc = 'Half Day - Afternoon';
									}
									else {
										$sub_type_desc = '';
									}

									$cNIK = $result_cuti_approval_1_list->cNIK;
									$list_annual_leave = $this->m_aldoread->list_annual_leave_by_employee($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'));
									$total = ($list_annual_leave[0]->total)*1;

									$list_day_off_annual_leave = $this->m_aldoread->list_day_off_annual_leave($company_id_session);
									$cIDAbsen_annual_leave = $list_day_off_annual_leave[0]->cIDAbsen;

									$list_annual_leave_used = $this->m_aldoread->total_annual_leave_used($company_id_session, $cNIK, date_format(date_create($result_cuti_approval_1_list->date_start), 'Y'), $cIDAbsen_annual_leave);
									$total_used = ($list_annual_leave_used[0]->total)*1;
									$diff = $total - $total_used;

									$cuti_approval_1 = array (
										'id_cuti' => $result_cuti_approval_1_list->id_cuti,
										'cNIK' => $result_cuti_approval_1_list->cNIK,
										'cNmPegawai' => $result_cuti_approval_1_list->cNmPegawai,
										'date_start' => $result_cuti_approval_1_list->date_start,
										'date_start_format' => date_format(date_create($result_cuti_approval_1_list->date_start), 'd M Y'),
										'total' => $result_cuti_approval_1_list->total,
										'sub_type' => $result_cuti_approval_1_list->sub_type,
										'sub_type_desc' => $sub_type_desc,
										'note' => $result_cuti_approval_1_list->note,
										'cIDDept' => $result_cuti_approval_1_list->cIDDept,
										'cNmDept' => $result_cuti_approval_1_list->cNmDept,
										'cIDBag' => $result_cuti_approval_1_list->cIDBag,
										'cNmBag' => $result_cuti_approval_1_list->cNmBag,
										'cIDJbtn' => $result_cuti_approval_1_list->cIDJbtn,
										'cNmJbtn' => $result_cuti_approval_1_list->cNmJbtn,
										'img1' => $result_cuti_approval_1_list->img1,
										'img2' => $result_cuti_approval_1_list->img2,
										'img3' => $result_cuti_approval_1_list->img3,
										'approve1' => $result_cuti_approval_1_list->approve1,
										'approve2' => $result_cuti_approval_1_list->approve2,
										'ga1' => $result_cuti_approval_1_list->ga1,
										'ga2' => $result_cuti_approval_1_list->ga2,
										'ga3' => $result_cuti_approval_1_list->ga3,
										'ga4' => $result_cuti_approval_1_list->ga4,
										'total' =>  $total,
										'total_used' => $total_used,
										'diff' => $diff,
										'approve' => 'approve1'
									);
									array_push($result_cuti_approval_1_array, $cuti_approval_1);
								}
							}

							$data=array(
								'cNIK_session' => $cNIK_session,
								'cIDAbsen' => $resultList->cIDAbsen,
								'cNmAbsen' => $resultList->cNmAbsen,
								'count' => count($result_cuti_approval_1),
								'result_cuti_approval_1' => $result_cuti_approval_1_array,
							);
							array_push($data_array, $data);						
						}
					}
				}				
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

}