<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class CoaPage extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_coapage');
        //$this->load->model('m_aldoread');
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
			
			$data['title'] = 'Chart of Account - Dashboard';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/home-coa';
			$this->load->view('template', $data);
			
		}
	}

	// Setting

	public function coa_type(){
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

			$data['title'] = 'Char of Account - Type';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/coa-type';
			$this->load->view('template', $data);
		}
	}

	public function coa_classes(){
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

			$data['title'] = 'Char of Account - Classes';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/coa-classes';
			$this->load->view('template', $data);
		}
	}

	public function coa_currency(){
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

			$data['title'] = 'Char of Account - Currency';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/coa-currency';
			$this->load->view('template', $data);
		}
	}

	// Input

	public function chart_of_account(){
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

			$data['title'] = 'Chart of Account';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/chart-of-account';
			$this->load->view('template', $data);
		}
	}

	public function sub_chart_of_account(){
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

			$data['title'] = 'Sub Chart of Account';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/sub-chart-of-account';
			$this->load->view('template', $data);
		}
	}

	public function rate(){
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

			$data['title'] = 'Rate';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/rate';
			$this->load->view('template', $data);
		}
	}

	public function cash_account(){
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

			$data['title'] = 'Cash Account';

			$data['menu'] = 'menu-coa';
			$data['header'] = 'header';
			$data['page'] = 'coa/cash-account';
			$this->load->view('template', $data);
		}
	}

}
