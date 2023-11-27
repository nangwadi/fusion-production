<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class AldoPage extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_aldopage');
        $this->load->model('m_aldoread');
        $this->load->model('m_aldocreate');
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);
			
			$data['title'] = 'Aldo - Dashboard';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/home-aldo';
			$this->load->view('template', $data);
			
		}
	}

	// Setting

	public function annual_leave(){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$data['title'] = 'Aldo - Annual Leave';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/annual-leave';
			$this->load->view('template', $data);
		}
	}

	public function department_approval(){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$data['title'] = 'Aldo - Department Approval';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/department-approval';
			$this->load->view('template', $data);
		}
	}

	public function ga_approval(){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$data['title'] = 'Aldo - General Affairs Approval';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/ga-approval';
			$this->load->view('template', $data);
		}
	}

	public function special_approval(){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$data['title'] = 'Aldo - Special Approval';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/special-approval';
			$this->load->view('template', $data);
		}
	}

	public function approve_all(){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$data['title'] = 'Aldo - Approve All';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/approve-all';
			$this->load->view('template', $data);
		}
	}

	public function day_off(){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$data['title'] = 'Aldo - Day Off';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/day-off';
			$this->load->view('template', $data);
		}
	}

	// input

	public function non_special_leave($cIDAbsen){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$cIDAbsen = $this->uri->segment('3');
			$result_menu_aldo_detail = $this->m_aldoread->list_day_off_by_precense_id($company_id_session, $cIDAbsen);
			$data['cIDAbsen'] = $cIDAbsen;
			$data['cNmAbsen'] = $result_menu_aldo_detail[0]->cNmAbsen;
			$images = $result_menu_aldo_detail[0]->images;

			$data['title'] = 'Aldo - '.$result_menu_aldo_detail[0]->cNmAbsen;

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			if ($images==0) {
				$data['page'] = 'aldo/day-off-non-img';
			}
			else {
				$data['page'] = 'aldo/day-off-img';
			}
			$this->load->view('template', $data);
		}
	}

	public function special_leave($cIDAbsen){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$cIDAbsen = $this->uri->segment('3');
			$result_menu_aldo_detail = $this->m_aldoread->list_day_off_by_precense_id($company_id_session, $cIDAbsen);
			$data['cIDAbsen'] = $cIDAbsen;
			$data['cNmAbsen'] = $result_menu_aldo_detail[0]->cNmAbsen;
			$images = $result_menu_aldo_detail[0]->images;

			$data['title'] = 'Aldo - '.$result_menu_aldo_detail[0]->cNmAbsen;

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			if ($images==0) {
				$data['page'] = 'aldo/day-off-non-img';
			}
			else {
				$data['page'] = 'aldo/day-off-img';
			}
			$this->load->view('template', $data);
		}
	}

	// Approve

	public function special_approve(){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$data['title'] = 'Aldo - Special Approve';

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/special-approve';
			
			$this->load->view('template', $data);
		}
	}

	public function approval($category){
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

			$result_menu_aldo = $this->m_aldoread->list_day_off($company_id_session, 0);
			$data['result_menu_aldo'] = $result_menu_aldo;

			$result_special_approval = $this->m_aldoread->list_special_approval_by_employee($company_id_session, $cNIK_session);
			$data['special_approval'] = count($result_special_approval);

			$result_department_approval = $this->m_aldoread->list_department_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_department_approval'] = count($result_department_approval);

			$result_ga_approval = $this->m_aldoread->list_ga_approval_by_employee($company_id_session, $cNIK_session);
			$data['count_ga_approval'] = count($result_ga_approval);

			$category = $this->uri->segment('3');
			$data['category'] = $category;

			$data['title'] = 'Aldo - Approval '.ucfirst($category);

			$data['menu'] = 'menu-aldo';
			$data['header'] = 'header';
			$data['page'] = 'aldo/'.$category;
			
			$this->load->view('template', $data);
		}
	}

}
