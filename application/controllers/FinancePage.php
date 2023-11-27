<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class FinancePage extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_financepage');
        $this->load->model('m_financeread');
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;
			
			$data['title'] = 'Finance - Dashboard';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/home-finance';
			$this->load->view('template', $data);
			
		}
	}

	// Setting

	public function module_category(){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$data['title'] = 'Finance - Module Category';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/module-category';
			$this->load->view('template', $data);
		}
	}

	public function module(){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$data['title'] = 'Finance - Module';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/module';
			$this->load->view('template', $data);
		}
	}

	public function numbering_sequence($file_name_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - Numbering Sequence';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/numbering-sequence';
			$this->load->view('template', $data);
		}
	}

	public function ending_balance(){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$data['title'] = 'Finance - Ending Balance';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/ending-balance';
			$this->load->view('template', $data);
		}
	}

	/*public function employee_permission($file_name_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - Employee Permission';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/employee-permission';
			$this->load->view('template', $data);
		}
	}

	public function approval_permission($file_name_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - approval Permission';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/approval-permission';
			$this->load->view('template', $data);
		}
	}

	public function transaction_role($file_name_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - Transaction Role';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/transaction-role';
			$this->load->view('template', $data);
		}
	}

	public function payment_methode(){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - Payment Methode';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/payment-methode';
			$this->load->view('template', $data);
		}
	}

	public function payment_terms(){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - Payment Terms';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/payment-terms';
			$this->load->view('template', $data);
		}
	}*/

	// Input

	public function cash_management($file_name_get, $transaction_number_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$category_get = $this->uri->segment('2');

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$transaction_number = $this->uri->segment('4');

			if ($transaction_number=='1' or $transaction_number==1) {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = $this->input->post('transaction_number');
			}
			else {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = str_replace('XX', '/', $transaction_number);
			}

			$data['title'] = 'Finance - '.ucwords(str_replace('-', ' ', $category_get)).'<br>'.ucwords(str_replace('-', ' ', $file_name_get));

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/'.$file_name_get;
			$this->load->view('template', $data);
		}
	}

	public function account_payable($file_name_get, $transaction_number_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$category_get = $this->uri->segment('2');

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$transaction_number = $this->uri->segment('4');

			if ($transaction_number=='1' or $transaction_number==1) {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = $this->input->post('transaction_number');
			}
			else {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = str_replace('XX', '/', $transaction_number);
			}

			$data['title'] = 'Finance - '.ucwords(str_replace('-', ' ', $category_get)).'<br>'.ucwords(str_replace('-', ' ', $file_name_get));

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/'.$file_name_get;
			$this->load->view('template', $data);
		}
	}

	public function account_receivable($file_name_get, $transaction_number_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$category_get = $this->uri->segment('2');

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$transaction_number = $this->uri->segment('4');

			if ($transaction_number=='1' or $transaction_number==1) {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = $this->input->post('transaction_number');
			}
			else {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = str_replace('XX', '/', $transaction_number);
			}

			$data['title'] = 'Finance - '.ucwords(str_replace('-', ' ', $category_get)).'<br>'.ucwords(str_replace('-', ' ', $file_name_get));

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/'.$file_name_get;
			$this->load->view('template', $data);
		}
	}

	public function list_vendor_payment(){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$data['title'] = 'Finance - Account Payable - List of Vendor Payment';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/list-vendor-payment';
			$this->load->view('template', $data);
		}
	}

	/*public function list_purchase($file_name_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - purchase order';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/list-'.$file_name_get;
			$this->load->view('template', $data);
		}
	}

	public function sales($file_name_get, $transaction_number_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$transaction_number = $this->uri->segment('4');

			if ($transaction_number=='1' or $transaction_number==1) {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = $this->input->post('transaction_number');
			}
			else {
				$data['transaction_number'] = $transaction_number;
				$data['transaction_number_format'] = str_replace('XX', '/', $transaction_number);
			}

			$data['title'] = 'Finance - '.ucwords(str_replace('-', ' ', $file_name_get));

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/'.$file_name_get;
			$this->load->view('template', $data);
		}
	}

	public function list_sales($file_name_get){
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

			$result_module = $this->m_financeread->list_module_menu($company_id_session, 0);
			$data['result_module'] = $result_module;

			$result_module_category = $this->m_financeread->list_module_category_menu($company_id_session, 0);				
			$data['result_module_category'] = $result_module_category;

			$file_name_get = $this->uri->segment('3');
			$result_file_name = $this->m_financeread->list_module_by_module_file_name($company_id_session, $file_name_get);
			$data['result_file_name'] = $result_file_name;

			$data['title'] = 'Finance - Sales order';

			$data['menu'] = 'menu-finance';
			$data['header'] = 'header';
			$data['page'] = 'finance/list-'.$file_name_get;
			$this->load->view('template', $data);
		}
	}*/


}
