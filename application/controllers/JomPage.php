<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class JomPage extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_jompage');
        $this->load->model('m_jomread');
        //$this->load->model('m_aldocreate');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// Dashboard

	public function dashboard(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {

			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;
			
			$data['title'] = 'Job Order Management - Dashboard';

			$data['menu'] = 'menu-jom';
			$data['header'] = 'header';
			$data['page'] = 'jom/home-jom';
			$this->load->view('template', $data);
			
		}
	}

	// Setting

	public function job_type(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Job Type';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/job-type';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}

			$this->load->view('template', $data);
		}
	}

	public function job_task(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Job task';

			$data['menu'] = 'menu-jom';if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/job-task';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function job_task_sub(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Job Sub Task';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/job-task-sub';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function country(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Country';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/country';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function tax(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Tax';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/tax';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function sub_tax(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Sub Tax';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/sub-tax';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function material(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - material';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/material';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function part_list_status(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Part List Status';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/part-list-status';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function permission_special(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Permission Special';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/permission-special';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	public function permission_type(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Permission Type';

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/permission-type';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			};
			$this->load->view('template', $data);
		}
	}

	public function permission($permission_cd){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$permission_cd_get = $this->uri->segment('3');
			$result_permission_type_by_permission_cd = $this->m_jomread->list_permission_type_by_permission_cd($company_id_session, $permission_cd_get);
			$id_permission = $result_permission_type_by_permission_cd[0]->id_permission;
			$permission_cd = $result_permission_type_by_permission_cd[0]->permission_cd;
			$permission_name = $result_permission_type_by_permission_cd[0]->permission_name;
			$data['id_permission'] = $id_permission;
			$data['permission_cd'] = $permission_cd;
			$data['permission_name'] = $permission_name;

			$data['title'] = 'Job Order Management v4 - Permission of '.$permission_name;

			if (count($result_permission_special)>=1) {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/permission';
			}
			else {
				$data['menu'] = 'menu-jom';
				$data['header'] = 'header';
				$data['page'] = 'jom/home-jom';
			}
			$this->load->view('template', $data);
		}
	}

	// Input

	public function account($category){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$category = $this->uri->segment('3');
			$data['category'] = $category;

			if ($category=='customer') {
				$data['apr'] = 'Account Receivable';
				$data['pr'] = 'Account Receivement';
			}
			else if ($category=='vendor') {
				$data['apr'] = 'Account Payable';
				$data['pr'] = 'Account Payment';
			}

			$data['title'] = 'Job Order Management v4 - '.ucfirst($category);

			$data['menu'] = 'menu-jom';
			$data['header'] = 'header';
			$data['page'] = 'jom/account';
			$this->load->view('template', $data);
		}
	}

	public function input_job($JobNo){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$JobNo = $this->uri->segment('3');
			$data['JobNo'] = $JobNo;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Input Job';

			$data['menu'] = 'menu-jom';
			$data['header'] = 'header';
			$data['page'] = 'jom/input-job';
			$this->load->view('template', $data);
		}
	}

	public function list_job(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - List Job';

			$data['menu'] = 'menu-jom';
			$data['header'] = 'header';
			$data['page'] = 'jom/list-job';
			$this->load->view('template', $data);
		}
	}

	public function after_trial($JobNo){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$JobNo = $this->uri->segment('3');
			$data['JobNo'] = $JobNo;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - After Trial';

			$data['menu'] = 'menu-jom';
			$data['header'] = 'header';
			$data['page'] = 'jom/after-trial';
			$this->load->view('template', $data);
		}
	}

	public function part_list($JobNo){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$JobNo = $this->uri->segment('3');
			$data['JobNo'] = $JobNo;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Part List';

			$data['menu'] = 'menu-jom';
			$data['header'] = 'header';
			$data['page'] = 'jom/part-list';
			$this->load->view('template', $data);
		}
	}

	public function bom(){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
			$cIDBag_session = $this->session->userdata('cIDBag_session');
			$cNmBag_session = $this->session->userdata('cNmBag_session');
			$cIDDept_session = $this->session->userdata('cIDDept_session');
			$cNmDept_session = $this->session->userdata('cNmDept_session');
			$cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
			$cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
			$cGroupID_session = $this->session->userdata('cGroupID_session');
      		$cGroupNm_session = $this->session->userdata('cGroupNm_session');
			$company_id_session = $this->session->userdata('company_id_session');
			$photo_session = $this->session->userdata('photo_session');
			$key_session = $this->session->userdata('key_session');

			$data['cNIK_session'] = $cNIK_session;
			$data['cNmPegawai_session'] = $cNmPegawai_session;
			$data['cIDBag_session'] = $cIDBag_session;
			$data['cNmBag_session'] = $cNmBag_session;
			$data['cIDDept_session'] = $cIDDept_session;
			$data['cNmDept_session'] = $cNmDept_session;
			$data['cIDJbtn_session'] = $cIDJbtn_session;
			$data['cNmJbtn_session'] = $cNmJbtn_session;
			$data['cGroupID_session'] = $cGroupID_session;
			$data['cGroupNm_session'] = $cGroupNm_session;
			$data['company_id_session'] = $company_id_session;
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$result_permission_type = $this->m_jomread->list_permission_type($company_id_session, 0);
			$data['result_permission_type'] = $result_permission_type;

			$result_permission_special = $this->m_jomread->list_permission_special_by_employee_id($company_id_session, $cNIK_session);
			$data['result_permission_special'] = $result_permission_special;

			$result_permission_employee = $this->m_jomread->list_permission_employee_for_menu($company_id_session, 0, 0);
			$data['result_permission_employee'] = $result_permission_employee;

			$data['title'] = 'Job Order Management v4 - Bill of Material';

			$data['menu'] = 'menu-jom';
			$data['header'] = 'header';
			$data['page'] = 'jom/bom';
			$this->load->view('template', $data);
		}
	}

}
