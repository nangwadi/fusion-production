<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoryPage extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_inventorypage');
        $this->load->model('m_inventoryread');
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

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/home-inventory';
			$this->load->view('template', $data);
			
		}
	}

	// Setting

	public function uom(){
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

			$data['title'] = 'Inventory - Unit of Measure';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/uom';
			$this->load->view('template', $data);
		}
	}

	public function class_category(){
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

			$data['title'] = 'Inventory - Class Category';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/class-category';
			$this->load->view('template', $data);
		}
	}

	public function warehouse(){
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

			$data['title'] = 'Inventory - Warehouse';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/warehouse';
			$this->load->view('template', $data);
		}
	}

	public function item_class(){
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

			$data['title'] = 'Inventory - Item Class';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/item-class';
			$this->load->view('template', $data);
		}
	}

	// Input

	public function inventory_group(){
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

			$data['title'] = 'Inventory - Inventory Group';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/inventory-group';
			$this->load->view('template', $data);
		}
	}

	public function maker(){
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

			$data['title'] = 'Inventory - Maker';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/maker';
			$this->load->view('template', $data);
		}
	}
	
	public function inventory(){
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

			$data['title'] = 'Inventory - inventory';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/inventory';
			$this->load->view('template', $data);
		}
	}

	public function return(){
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

			$data['title'] = 'Inventory - Return';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/return';
			$this->load->view('template', $data);
		}
	}

	public function list_return(){
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

			$data['title'] = 'Inventory - List Return';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/list-return';
			$this->load->view('template', $data);
		}
	}

	public function kit_assy(){
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

			$data['title'] = 'Inventory - Kit Assembling';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/kit-assy';
			$this->load->view('template', $data);
		}
	}

	public function list_kit_assy(){
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

			$data['title'] = 'Inventory - List Kit Assembling';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/list-kit-assy';
			$this->load->view('template', $data);
		}
	}

	public function common_stock(){
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

			$data['title'] = 'Inventory - Common Stock';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/common-stock';
			$this->load->view('template', $data);
		}
	}

	public function pns(){
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

			$data['title'] = 'Inventory - Pantry & Stationary';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/pns';
			$this->load->view('template', $data);
		}
	}

	public function list_stock_out($category){
		$cNIK_session=$this->session->userdata('cNIK_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$category_get = $this->uri->segment('3');
			if ($category_get == 'cs') {
				$category_title = 'Common Stock';
			}
			else if ($category_get == 'pns') {
				$category_title = 'Pantry & Stationary';
			}

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

			$data['category'] = $category_get;

			$data['title'] = 'Inventory - List Stock Out ';

			$data['menu'] = 'menu-inventory';
			$data['header'] = 'header';
			$data['page'] = 'inventory/list-stock-out';
			$this->load->view('template', $data);
		}
	}


}
