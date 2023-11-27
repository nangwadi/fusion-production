<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class JomRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_jomread');
        $this->load->model('m_inventoryread');
        $this->load->model('m_distributionread');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// Setting

	public function list_job_type($key_session, $id_job_type){
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
				$id_job_type = $this->uri->segment('4');
				$result = $this->m_jomread->list_job_type($company_id_session, $id_job_type);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_job_type' => $resultList->id_job_type,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'job_type_cd' => $resultList->job_type_cd,
							'job_type_name' => $resultList->job_type_name,
							'job_type_format' => $resultList->job_type_format,
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

	public function list_job_task($key_session, $id_job_task){
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
				$id_job_task = $this->uri->segment('4');
				$result = $this->m_jomread->list_job_task($company_id_session, $id_job_task);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cIDBag = $resultList->cIDBag;
						if ($cIDBag=='ALL') {
							$cNmBag = 'All Division';
						}
						else {
							$cNmBag = $resultList->cNmBag;
						}

						$data = array(
							'id_job_task' => $resultList->id_job_task,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'job_task_cd' => $resultList->job_task_cd,
							'job_task_name' => $resultList->job_task_name,
							'cIDDept' => $resultList->cIDDept,
							'cNmDept' => $resultList->cNmDept,
							'cIDBag' => $resultList->cIDBag,
							'cNmBag' => $cNmBag,
							'machine' => $resultList->machine,
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

	public function list_job_task_sub($key_session, $id_job_task_sub){
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
				$id_job_task_sub = $this->uri->segment('4');
				$result = $this->m_jomread->list_job_task_sub($company_id_session, $id_job_task_sub);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cIDBag = $resultList->cIDBag;
						if ($cIDBag=='ALL') {
							$cNmBag = 'All Division';
						}
						else {
							$cNmBag = $resultList->cNmBag;
						}

						$data = array(
							'id_job_task_sub' => $resultList->id_job_task_sub,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_job_task' => $resultList->id_job_task,
							'job_task_cd' => $resultList->job_task_cd,
							'job_task_name' => $resultList->job_task_name,
							'job_task_sub_cd' => $resultList->job_task_sub_cd,
							'job_task_sub_name' => $resultList->job_task_sub_name,
							'cIDDept' => $resultList->cIDDept,
							'cNmDept' => $resultList->cNmDept,
							'cIDBag' => $resultList->cIDBag,
							'machine' => $resultList->machine,
							'cNmBag' => $cNmBag,
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

	public function list_country($key_session, $id_country){
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
				$id_country = $this->uri->segment('4');
				$result = $this->m_jomread->list_country($company_id_session, $id_country);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_country' => $resultList->id_country,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'country_cd' => $resultList->country_cd,
							'country_name' => $resultList->country_name,
							'country_phone_code' => $resultList->country_phone_code,
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

	public function list_tax($key_session, $id_tax){
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
				$id_tax = $this->uri->segment('4');
				$result = $this->m_jomread->list_tax($company_id_session, $id_tax);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_tax' => $resultList->id_tax,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'tax_cd' => $resultList->tax_cd,
							'tax_name' => $resultList->tax_name,
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

	public function list_sub_tax($key_session, $id_sub_tax){
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
				$id_sub_tax = $this->uri->segment('4');
				$result = $this->m_jomread->list_sub_tax($company_id_session, $id_sub_tax);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){

						if ($resultList->sub_tax_percent_plus_coa == null) {
							$sub_tax_percent_plus_coa = '';
							$coa_cd_percent_plus = '';
							$coa_name_percent_plus = '';
						}
						else {
							$sub_tax_percent_plus_coa = $resultList->sub_tax_percent_plus_coa;
							$coa_cd_percent_plus = $resultList->coa_cd_percent_plus;
							$coa_name_percent_plus = $resultList->coa_name_percent_plus;
						}

						if ($resultList->sub_tax_percent_minus_coa == null) {
							$coa_name_percent_minus = '';
							$coa_cd_percent_minus = '';
							$sub_tax_percent_minus_coa = '';
						}
						else {
							$coa_name_percent_minus = $resultList->coa_name_percent_minus;
							$coa_cd_percent_minus = $resultList->coa_cd_percent_minus;
							$sub_tax_percent_minus_coa = $resultList->sub_tax_percent_minus_coa;
						}

						$data = array(
							'id_sub_tax' => $resultList->id_sub_tax,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'sub_tax_cd' => $resultList->sub_tax_cd,
							'sub_tax_name' => $resultList->sub_tax_name,
							'sub_tax_percent_plus' => $resultList->sub_tax_percent_plus,
							'sub_tax_percent_minus' => $resultList->sub_tax_percent_minus,
							'coa_name_percent_plus' => $coa_name_percent_plus,
							'coa_name_percent_minus' => $coa_name_percent_minus,
							'coa_cd_percent_plus' => $coa_cd_percent_plus,
							'coa_cd_percent_minus' => $coa_cd_percent_minus,
							'sub_tax_percent_plus_coa' => $sub_tax_percent_plus_coa,
							'sub_tax_percent_minus_coa' => $sub_tax_percent_minus_coa,
							'id_tax' => $resultList->id_tax,
							'tax_cd' => $resultList->tax_cd,
							'tax_name' => $resultList->tax_name,
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

	public function list_sub_tax_by_sub_tax_cd($key_session, $sub_tax_cd){
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
				$sub_tax_cd = $this->uri->segment('4');
				$result = $this->m_jomread->list_sub_tax_by_sub_tax_cd($company_id_session, $sub_tax_cd);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_sub_tax' => $resultList->id_sub_tax,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'sub_tax_cd' => $resultList->sub_tax_cd,
							'sub_tax_name' => $resultList->sub_tax_name,
							'sub_tax_percent_plus' => $resultList->sub_tax_percent_plus,
							'sub_tax_percent_minus' => $resultList->sub_tax_percent_minus,
							'coa_name_percent_plus' => $resultList->coa_name_percent_plus,
							'coa_name_percent_minus' => $resultList->coa_name_percent_minus,
							'coa_cd_percent_plus' => $resultList->coa_cd_percent_plus,
							'coa_cd_percent_minus' => $resultList->coa_cd_percent_minus,
							'sub_tax_percent_plus_coa' => $resultList->sub_tax_percent_plus_coa,
							'sub_tax_percent_minus_coa' => $resultList->sub_tax_percent_minus_coa,
							'id_tax' => $resultList->id_tax,
							'tax_cd' => $resultList->tax_cd,
							'tax_name' => $resultList->tax_name,
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

	public function list_material($key_session, $id_material){
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
				$id_material = $this->uri->segment('4');
				$result = $this->m_jomread->list_material($company_id_session, $id_material);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_material' => $resultList->id_material,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'material_cd' => $resultList->material_cd,
							'material_name' => $resultList->material_name,
							'id_account' => $resultList->id_account,
							'account_name' => $resultList->account_name,
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

	public function list_material_datatable($key_session){
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
				$result_material = $this->m_jomread->list_material_datatable($company_id_session);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_material as $material_list) {
		            $no++;
		            $row = array();
		            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$material_list->id_material.'" id="id_material_'.$no.'" class="id_material" onclick="select_change_material('.$no.');">';
		            $row[] = $material_list->material_cd;
		            $row[] = $material_list->material_name;
		            $row[] = $material_list->account_name;
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_material_count_all($company_id_session),
		            "recordsFiltered" => $this->m_jomread->list_material_count_filtered($company_id_session),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_part_list_status($key_session, $id_part_list_status){
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
				$id_part_list_status = $this->uri->segment('4');
				$result = $this->m_jomread->list_part_list_status($company_id_session, $id_part_list_status);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_part_list_status' => $resultList->id_part_list_status,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'part_list_status_cd' => $resultList->part_list_status_cd,
							'part_list_status_name' => $resultList->part_list_status_name,
							'sequence' => $resultList->sequence,
							'email_pic' => $resultList->email_pic,
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

	public function list_part_list_status_datatable($key_session){
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
				$result_part_list_status = $this->m_jomread->list_part_list_status_datatable($company_id_session);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_part_list_status as $part_list_status_list) {
		            $no++;
		            $row = array();
		            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$part_list_status_list->id_part_list_status.'" id="id_part_list_status_'.$no.'" class="id_part_list_status" onclick="select_change_part_list_status('.$no.');">';
		            $row[] = $part_list_status_list->part_list_status_cd;
		            $row[] = $part_list_status_list->account_name;
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_part_list_status_count_all($company_id_session),
		            "recordsFiltered" => $this->m_jomread->list_part_list_status_count_filtered($company_id_session),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_permission_special($key_session, $id_permission_special){
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
				$id_permission_special = $this->uri->segment('4');
				$result = $this->m_jomread->list_permission_special($company_id_session, $id_permission_special);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_permission_special' => $resultList->id_permission_special,
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
							'deleted' => $resultList->deleted,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_permission_type($key_session, $id_permission_type){
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
				$id_permission = $this->uri->segment('4');
				$result = $this->m_jomread->list_permission_type($company_id_session, $id_permission);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_permission' => $resultList->id_permission,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'permission_cd' => $resultList->permission_cd,
							'permission_name' => $resultList->permission_name,
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

	public function list_permission_employee($key_session, $id_permission, $id_permission_employee){
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
				$id_permission = $this->uri->segment('4');
				$id_permission_employee = $this->uri->segment('5');
				$result = $this->m_jomread->list_permission_employee($company_id_session, $id_permission, $id_permission_employee);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$crud = $resultList->crud;
						$r = substr($crud, 0, 1);
						$c = substr($crud, 1, 1);
						$u = substr($crud, 2, 1);
						$d = substr($crud, 3, 1);
						$data = array(
							'id_permission_employee' => $resultList->id_permission_employee,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_permission' => $resultList->id_permission,
							'permission_cd' => $resultList->permission_cd,
							'permission_name' => $resultList->permission_name,
							'cNIK' => $resultList->cNIK,
							'cNmPegawai_permission' => $resultList->cNmPegawai_permission,
							'crud' => $resultList->crud,
							'r' => $r,
							'c' => $c,
							'u' => $u,
							'd' => $d,
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

	public function list_account($key_session, $category, $customer_id){
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
				$customer_id = $this->uri->segment('5');
				$result = $this->m_jomread->list_account($company_id_session, $category, $customer_id);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_account' => $resultList->id_account,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'cv' => $resultList->cv,
							'account_cd' => $resultList->account_cd,
							'account_name' => $resultList->account_name,
							'main_address' => $resultList->main_address,
							'city' => str_replace(null, '', $resultList->city),
							'postal_code' => str_replace(null, '', $resultList->postal_code),
							'id_country' => str_replace(null, '', $resultList->id_country),
							'country_name' => str_replace(null, '', $resultList->country_name),
							'phone_1' => str_replace(null, '', $resultList->phone_1),
							'phone_2' => str_replace(null, '', $resultList->phone_2),
							'fax' => str_replace(null, '', $resultList->fax),
							'attn' => str_replace(null, '', $resultList->attn),
							'email' => str_replace(null, '', $resultList->email),
							'apr_account' => str_replace(null, '', $resultList->apr_account),
							'coa_cd_apr' => str_replace(null, '', $resultList->coa_cd_apr),
							'coa_name_apr' => str_replace(null, '', $resultList->coa_name_apr),
							'aapr_account' => str_replace(null, '', $resultList->aapr_account),
							'coa_cd_aapr' => str_replace(null, '', $resultList->coa_cd_aapr),
							'coa_name_aapr' => str_replace(null, '', $resultList->coa_name_aapr),
							'payment_account' => str_replace(null, '', $resultList->payment_account),
							'coa_cd_payment_account' => str_replace(null, '', $resultList->coa_cd_payment_account),
							'coa_name_payment_account' => str_replace(null, '', $resultList->coa_name_payment_account),
							'sales_account' => str_replace(null, '', $resultList->sales_account),
							'coa_cd_sales_account' => str_replace(null, '', $resultList->coa_cd_sales_account),
							'coa_name_sales_account' => str_replace(null, '', $resultList->coa_name_sales_account),
							'sales_person' => str_replace(null, '', $resultList->sales_person),
							'cNmPegawai_sales_person' => str_replace(null, '', $resultList->cNmPegawai_sales_person),
							'taxable' => $resultList->taxable,
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

	public function list_account_datatable($key_session, $category, $customer_id){
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
				$customer_id = $this->uri->segment('5');
				$result_account = $this->m_jomread->list_account_datatable($company_id_session, $category, $customer_id);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_account as $account_list) {
		        	$id_account = $account_list->id_account;
		        	$account_name = $account_list->account_name;
		        	$deleted = $account_list->deleted;

		            $no++;
		            $row = array();
		            $row[] = $no;
		            $row[] = $account_list->account_cd;
		            $row[] = $account_list->account_name;
		            $row[] = $account_list->main_address;
		            $row[] = $account_list->phone_1;
		            $row[] = $account_list->attn;
		            $row[] = $account_list->email;

		            $nol = 0;
		            $satu = 1;

                    if ($deleted==0) {
                        if ($category=='customer') {
                            $row[] = '<button align="center" style="width:30px;" class="btn btn-info" id="btn_update_'.$no.'" onclick="update('.$id_account.', '.$no.');" title="Update '.$category.' - '.$account_name.'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;<button align="center" style="width:30px;" class="btn btn-success" onclick="job_number('.$id_account.', '.$account_name.');" title="'.$category.' Job Number - '.$account_name.'."><i class="mdi mdi-sort-numeric"></i></button>&nbsp;&nbsp;<button style="width:30px;" class="btn btn-danger" id="btn_disable_'.$no.'" onclick="disable_enable('.$id_account.', '."'$account_name'".', 1);" title="Disable '.$category.' - '.$account_name.'."><i class="mdi mdi-delete"></i></button>';
                        }
                        else {
                        	$row[] = '<button align="center" style="width:30px;" class="btn btn-info" id="btn_update_'.$no.'" onclick="update('.$id_account.', '.$no.');" title="Update '.$category.' - '.$account_name.'."><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;

                        		<button style="width:30px;" class="btn btn-danger" id="btn_disable_'.$no.'" onclick="disable_enable('.$id_account.', '."'$account_name'".', 1);" title="Disable '.$category.' - '.$account_name.'."><i class="mdi mdi-delete"></i></button>&nbsp;&nbsp;

                        		<button style="width:30px;" class="btn btn-success" id="btn_disable_'.$no.'" onclick="set_password('.$id_account.', '."'$account_name'".');" title="Set Password '.$category.' - '.$account_name.'."><i class="mdi mdi-key"></i></button>';
                        }
                    }
                    else {
                        $row[] = '<button style="width:30px;" class="btn btn-warning" onclick="disable_enable('.$id_account.', '."'$account_name'".', '.$nol.');" title="Enable '.$category.' - '.$account_name.'."><i class="mdi mdi-backup-restore"></i></button>';
                    }
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_account_count_all($company_id_session, $category, $customer_id),
		            "recordsFiltered" => $this->m_jomread->list_account_count_filtered($company_id_session, $category, $customer_id),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_account_material_datatable($key_session, $category, $customer_id){
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
				$customer_id = $this->uri->segment('5');
				//$result = $this->m_jomread->list_account($company_id_session, $category, $customer_id);
				$result_account = $this->m_jomread->list_account_datatable($company_id_session, $category, $customer_id);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_account as $account_list) {
		        	$id_account = $account_list->id_account;
		        	$account_name = $account_list->account_name;
		        	$deleted = $account_list->deleted;
		        	$coa_currency_cd = $account_list->coa_currency_cd;

		        	if ($deleted==0) {
		        		$no++;
			            $row = array();
			            $row[] = '
			            			<input type="hidden" id="coa_currency_cd_'.$no.'" value="'.$coa_currency_cd.'">
			            			<input type="hidden" id="id_account_'.$no.'" value="'.$id_account.'">
			            			<input type="hidden" id="account_name_'.$no.'" value="'.$account_name.'">
			            			<input type="checkbox" style="width:25px; height:25px;" value="'.$account_list->account_name.'" id="id_account_material_'.$no.'" class="id_account" onclick="select_change_account('.$no.');">';
			            
			            $row[] = $account_list->account_cd;
			            $row[] = $account_list->account_name;
			 
			            $data[] = $row;
		        	}
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_account_count_all($company_id_session, $category, $customer_id),
		            "recordsFiltered" => $this->m_jomread->list_account_count_filtered($company_id_session, $category, $customer_id),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_account_imo($key_session, $JobNo){
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
				$JobNo = $this->uri->segment('4');
				$result = $this->m_jomread->list_account_imo($company_id_session, $JobNo);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_account_vendor' => $resultList->id_account_vendor,
							'account_cd_vendor' => $resultList->account_cd_vendor,
							'account_name_vendor' => $resultList->account_name_vendor,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_part_list($key_session, $id_part_list){
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
				$id_part_list = $this->uri->segment('4');
				$result = $this->m_jomread->list_part_list($company_id_session, $id_part_list);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_account_vendor_db = $resultList->id_account_vendor;
						$account_cd_vendor_db = $resultList->account_cd_vendor;
						$account_name_vendor_db = $resultList->account_name_vendor;

						if ($id_account_vendor_db == null) {
							$id_account_vendor = '';
						}
						else {
							$id_account_vendor = $id_account_vendor_db;
						}

						if ($account_cd_vendor_db == null) {
							$account_cd_vendor = '';
						}
						else {
							$account_cd_vendor = $account_cd_vendor_db;
						}

						if ($account_name_vendor_db == null) {
							$account_name_vendor = '';
						}
						else {
							$account_name_vendor = $account_name_vendor_db;
						}

						$id_account_maker_db = $resultList->id_account_maker;
						$account_cd_maker_db = $resultList->account_cd_maker;
						$account_name_maker_db = $resultList->account_name_maker;

						if ($id_account_maker_db == null) {
							$id_account_maker = '';
						}
						else {
							$id_account_maker = $id_account_maker_db;
						}

						if ($account_cd_maker_db == null) {
							$account_cd_maker = '';
						}
						else {
							$account_cd_maker = $account_cd_maker_db;
						}

						if ($account_name_maker_db == null) {
							$account_name_maker = '';
						}
						else {
							$account_name_maker = $account_name_maker_db;
						}

						$qty_spare_db = $resultList->qty_spare;
						if ($qty_spare_db == null) {
							$qty_spare = '';
						}
						else {
							$qty_spare = $qty_spare_db;
						}

						$drawing_no_db = $resultList->drawing_no;
						if ($drawing_no_db == null) {
							$drawing_no = '';
						}
						else {
							$drawing_no = $drawing_no_db;
						}

						$data = array(
							'id_part_list' => $resultList->id_part_list,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_job_order' => $resultList->id_job_order,
							'JobNo' => $resultList->JobNo,
							'MoldName' => $resultList->MoldName,
							'MoldNomor' => $resultList->MoldNomor,
							'JobName' => $resultList->JobName,
							'id_inventory' => $resultList->id_inventory,
							'inventory_cd' => $resultList->inventory_cd,
							'inventory_name' => $resultList->inventory_name,
							'part_no' => $resultList->part_no,
							'part_name' => $resultList->part_name,
							'id_material' => $resultList->id_material,
							'material_cd' => $resultList->material_cd,
							'material_name' => $resultList->material_name,
							'qty' => $resultList->qty,
							'qty_spare' => $qty_spare,
							'single_multi' => $resultList->single_multi,
							'sp_1' => $resultList->sp_1,
							'sp_2' => $resultList->sp_2,
							'sp_3' => $resultList->sp_3,
							'sp_4' => $resultList->sp_4,
							'sp_5' => $resultList->sp_5,
							'note' => $resultList->note,
							'drawing_no' => $drawing_no,
							'id_account_vendor' => $id_account_vendor,
							'account_cd_vendor' => $account_cd_vendor,
							'account_name_vendor' => $account_name_vendor,
							'id_account_maker' => $id_account_maker,
							'account_cd_maker' => $account_cd_maker,
							'account_name_maker' => $account_name_maker,
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

	public function list_part_list_detail($key_session, $id_part_list){
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
				$id_part_list = $this->uri->segment('4');
				$result = $this->m_jomread->list_part_list_detail($company_id_session, $id_part_list);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_account_vendor_db = $resultList->id_account_vendor;
						$account_cd_vendor_db = $resultList->account_cd_vendor;
						$account_name_vendor_db = $resultList->account_name_vendor;

						if ($id_account_vendor_db == null) {
							$id_account_vendor = '';
						}
						else {
							$id_account_vendor = $id_account_vendor_db;
						}

						if ($account_cd_vendor_db == null) {
							$account_cd_vendor = '';
						}
						else {
							$account_cd_vendor = $account_cd_vendor_db;
						}

						if ($account_name_vendor_db == null) {
							$account_name_vendor = '';
						}
						else {
							$account_name_vendor = $account_name_vendor_db;
						}

						$id_account_maker_db = $resultList->id_account_maker;
						$account_cd_maker_db = $resultList->account_cd_maker;
						$account_name_maker_db = $resultList->account_name_maker;

						if ($id_account_maker_db == null) {
							$id_account_maker = '';
						}
						else {
							$id_account_maker = $id_account_maker_db;
						}

						if ($account_cd_maker_db == null) {
							$account_cd_maker = '';
						}
						else {
							$account_cd_maker = $account_cd_maker_db;
						}

						if ($account_name_maker_db == null) {
							$account_name_maker = '';
						}
						else {
							$account_name_maker = $account_name_maker_db;
						}

						$qty_spare_db = $resultList->qty_spare;
						if ($qty_spare_db == null) {
							$qty_spare = '';
						}
						else {
							$qty_spare = $qty_spare_db;
						}

						$drawing_no_db = $resultList->drawing_no;
						if ($drawing_no_db == null) {
							$drawing_no = '';
						}
						else {
							$drawing_no = $drawing_no_db;
						}

						$data = array(
							'id_part_list' => $resultList->id_part_list,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_job_order' => $resultList->id_job_order,
							'JobNo' => $resultList->JobNo,
							'MoldName' => $resultList->MoldName,
							'MoldNomor' => $resultList->MoldNomor,
							'JobName' => $resultList->JobName,
							'id_inventory' => $resultList->id_inventory,
							'inventory_cd' => $resultList->inventory_cd,
							'inventory_name' => $resultList->inventory_name,
							'id_uom' => $resultList->id_uom,
							'uom_cd' => $resultList->uom_cd,
							'uom_name' => $resultList->uom_name,
							'id_item_class' => $resultList->id_item_class,
							'item_class_cd' => $resultList->item_class_cd,
							'item_class_name' => $resultList->item_class_name,
							'id_warehouse' => $resultList->id_warehouse,
							'warehouse_cd' => $resultList->warehouse_cd,
							'warehouse_name' => $resultList->warehouse_name,
							'id_coa' => $resultList->id_coa,
							'coa_cd' => $resultList->coa_cd,
							'coa_name' => $resultList->coa_name,
							'id_sub_tax' => $resultList->id_sub_tax,
							'sub_tax_cd' => $resultList->sub_tax_cd,
							'sub_tax_name' => $resultList->sub_tax_name,
							'part_no' => $resultList->part_no,
							'part_name' => $resultList->part_name,
							'id_material' => $resultList->id_material,
							'material_cd' => $resultList->material_cd,
							'material_name' => $resultList->material_name,
							'qty' => $resultList->qty,
							'qty_spare' => $resultList->qty_spare,
							'single_multi' => $resultList->single_multi,
							'sp_1' => $resultList->sp_1,
							'sp_2' => $resultList->sp_2,
							'sp_3' => $resultList->sp_3,
							'sp_4' => $resultList->sp_4,
							'sp_5' => $resultList->sp_5,
							'note' => $resultList->note,
							'drawing_no' => $resultList->drawing_no,
							'id_account_vendor' => $resultList->id_account_vendor,
							'account_cd_vendor' => $resultList->account_cd_vendor,
							'account_name_vendor' => $resultList->account_name_vendor,
							'id_account_maker' => $resultList->id_account_maker,
							'account_cd_maker' => $resultList->account_cd_maker,
							'account_name_maker' => $resultList->account_name_maker,
							'id_material_order_line' => $resultList->id_material_order_line,
							'material_order_number' => $resultList->material_order_number,
							'id_rto' => $resultList->id_rto,
							'rto_date' => $resultList->rto_date,
							'create_by' => $resultList->create_by,
							'cNmPegawai_create' => $resultList->cNmPegawai_create,
							'create_date' => $resultList->create_date,
							'last_by' => $resultList->last_by,
							'cNmPegawai_last' => $resultList->cNmPegawai_last,
							'last_update' => $resultList->last_update,
							'deleted' => $resultList->deleted,
							'cut_dimension' => $resultList->cut_dimension,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_part_list_review($key_session){
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
				$id_part_list_array = $this->input->post('id_part_list_array');
				$id_part_list_exp = explode(',', $id_part_list_array);
				$id_part_list_count = count($id_part_list_exp);
				
				$data_array = array();
				for ($i=0; $i < $id_part_list_count; $i++) { 
					$id_part_list = $id_part_list_exp[$i];
					$result = $this->m_jomread->list_part_list($company_id_session, $id_part_list);

					array_push($data_array, $result);
									
				}
								
				echo json_encode(array(array('status' => 1, 'response' => $data_array)));
			}
		}
	}

	public function list_part_list_by_part_no($key_session, $part_no, $JobNo){
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
				$alphabet = array( 'a', 'b', 'c', 'd', 'e',
                       'f', 'g', 'h', 'i', 'j',
                       'k', 'l', 'm', 'n', 'o',
                       'p', 'q', 'r', 's', 't',
                       'u', 'v', 'w', 'x', 'y',
                       'z'
                       );

				$part_no_get = $this->uri->segment('4');
				$JobNo = $this->uri->segment('5');

				$part_no_exp = explode('-', $part_no_get);
				if (count($part_no_exp)>=1) {
					$part_no = $part_no_exp[0];
				}
				else {
					$part_no = $part_no_get;
				}

				$result = $this->m_jomread->list_part_list_by_part_no_add($company_id_session, $part_no, $JobNo);
				$data_array = array();

				$status = 1;
				$count = count($result);
				$nomor = $count;
				$responseValue = $nomor-1;
		
				echo json_encode(array(array('status' => $status, 'responseValue' => $part_no, 'response' => $part_no.'-'.strtoupper($alphabet[$responseValue]))));
			}
		}
	}

	public function list_part_list_by_account_imo($key_session, $JobNo, $id_account, $cut){
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
				$JobNo = $this->uri->segment('4');
				$id_account = $this->uri->segment('5');
				$cut = $this->uri->segment('6');
				$result = $this->m_jomread->list_part_list_by_account_imo($company_id_session, $JobNo, $id_account);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_account_vendor_db = $resultList->id_account_vendor;
						$account_cd_vendor_db = $resultList->account_cd_vendor;
						$account_name_vendor_db = $resultList->account_name_vendor;

						if ($id_account_vendor_db == null) {
							$id_account_vendor = '';
						}
						else {
							$id_account_vendor = $id_account_vendor_db;
						}

						if ($account_cd_vendor_db == null) {
							$account_cd_vendor = '';
						}
						else {
							$account_cd_vendor = $account_cd_vendor_db;
						}

						if ($account_name_vendor_db == null) {
							$account_name_vendor = '';
						}
						else {
							$account_name_vendor = $account_name_vendor_db;
						}

						$id_account_maker_db = $resultList->id_account_maker;
						$account_cd_maker_db = $resultList->account_cd_maker;
						$account_name_maker_db = $resultList->account_name_maker;

						if ($id_account_maker_db == null) {
							$id_account_maker = '';
						}
						else {
							$id_account_maker = $id_account_maker_db;
						}

						if ($account_cd_maker_db == null) {
							$account_cd_maker = '';
						}
						else {
							$account_cd_maker = $account_cd_maker_db;
						}

						if ($account_name_maker_db == null) {
							$account_name_maker = '';
						}
						else {
							$account_name_maker = $account_name_maker_db;
						}

						$qty_spare_db = $resultList->qty_spare;
						if ($qty_spare_db == null) {
							$qty_spare = '';
						}
						else {
							$qty_spare = $qty_spare_db;
						}

						$drawing_no_db = $resultList->drawing_no;
						if ($drawing_no_db == null) {
							$drawing_no = '';
						}
						else {
							$drawing_no = $drawing_no_db;
						}

						$data = array(
							'id_part_list' => $resultList->id_part_list,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_job_order' => $resultList->id_job_order,
							'JobNo' => $resultList->JobNo,
							'MoldName' => $resultList->MoldName,
							'MoldNomor' => $resultList->MoldNomor,
							'JobName' => $resultList->JobName,
							'id_inventory' => $resultList->id_inventory,
							'inventory_cd' => $resultList->inventory_cd,
							'inventory_name' => $resultList->inventory_name,
							'part_no' => $resultList->part_no,
							'part_name' => $resultList->part_name,
							'id_material' => $resultList->id_material,
							'material_cd' => $resultList->material_cd,
							'material_name' => $resultList->material_name,
							'qty' => $resultList->qty,
							'qty_spare' => $qty_spare,
							'single_multi' => $resultList->single_multi,
							'sp_1' => ($resultList->sp_1)*1,
							'sp_1_cut' => (($resultList->sp_1)*1)+$cut,
							'sp_2' => $resultList->sp_2,
							'sp_3' => ($resultList->sp_3)*1,
							'sp_3_cut' => (($resultList->sp_3)*1)+$cut,
							'sp_4' => $resultList->sp_4,
							'sp_5' => ($resultList->sp_5)*1,
							'sp_5_cut' => (($resultList->sp_5)*1)+$cut,
							'note' => $resultList->note,
							'drawing_no' => $drawing_no,
							'id_account_vendor' => $id_account_vendor,
							'account_cd_vendor' => $account_cd_vendor,
							'account_name_vendor' => $account_name_vendor,
							'id_account_maker' => $id_account_maker,
							'account_cd_maker' => $account_cd_maker,
							'account_name_maker' => $account_name_maker,
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

	public function list_part_list_datatable($key_session, $JobNo){
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
				$JobNo = $this->uri->segment('4');
				$result_part_list = $this->m_jomread->list_part_list_datatable($company_id_session, $JobNo);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_part_list as $list_part_list) {

		        	$deleted = $list_part_list->deleted;
		            
		            if ($deleted==0) {

		            	$id_account_vendor_db = $list_part_list->id_account_vendor;
						$account_cd_vendor_db = $list_part_list->account_cd_vendor;
						$account_name_vendor_db = $list_part_list->account_name_vendor;

						if ($id_account_vendor_db == null) {
							$id_account_vendor = '';
						}
						else {
							$id_account_vendor = $id_account_vendor_db;
						}

						if ($account_cd_vendor_db == null) {
							$account_cd_vendor = '';
						}
						else {
							$account_cd_vendor = $account_cd_vendor_db;
						}

						if ($account_name_vendor_db == null) {
							$account_name_vendor = '';
						}
						else {
							$account_name_vendor = $account_name_vendor_db;
						}

						$id_account_maker_db = $list_part_list->id_account_maker;
						$account_cd_maker_db = $list_part_list->account_cd_maker;
						$account_name_maker_db = $list_part_list->account_name_maker;

						if ($id_account_maker_db == null) {
							$id_account_maker = '';
						}
						else {
							$id_account_maker = $id_account_maker_db;
						}

						if ($account_cd_maker_db == null) {
							$account_cd_maker = '';
						}
						else {
							$account_cd_maker = $account_cd_maker_db;
						}

						if ($account_name_maker_db == null) {
							$account_name_maker = '';
						}
						else {
							$account_name_maker = $account_name_maker_db;
						}

						$qty_spare_db = $list_part_list->qty_spare;
						if ($qty_spare_db == null) {
							$qty_spare = '';
						}
						else {
							$qty_spare = $qty_spare_db;
						}

						$drawing_no_db = $list_part_list->drawing_no;
						if ($drawing_no_db == null) {
							$drawing_no = '';
						}
						else {
							$drawing_no = $drawing_no_db;
						}

						$material_order_number_db = $list_part_list->material_order_number;
						if ($material_order_number_db == null) {
							$material_order_number = '';
						}
						else {
							$material_order_number = $material_order_number_db;
						}

						$rto_date_db = $list_part_list->rto_date;
						if ($rto_date_db == null) {
							$rto_date = '';
							$italic = '';
							$rto = 1;
						}
						else {
							$rto_date = date_format(date_create($rto_date_db), 'd-M-Y');
							$italic = 'font-style:italic;';
							$rto = 0;
						}

						$id_part_list = $list_part_list->id_part_list;
						$part_name = $list_part_list->part_name;

						$result_file_dwg = $this->m_jomread->list_file_dwg($company_id_session, $id_part_list, 1);
						$rev = count($result_file_dwg);

		            	$no++;
			            $row = array();
				            $row[] = '<div id="part_no_'.$no.'" style="padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; height:25px; border-bottom: 1px solid white;"><button class="btn btn-md btn-info" onClick="update_part_list('.$id_part_list.', '.$no.');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-md btn-danger" onClick="delete_part_list('.$list_part_list->id_part_list.', '."'$list_part_list->part_name'".');"><i class="mdi mdi-delete"></i></button></div>';
				            
				            if((($list_part_list->part_no)*1)/(($list_part_list->part_no)*1)==1){
				            	$row[] = '<div id="part_no_'.$no.'" style="padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; border-bottom: 1px solid white;" onclick="add_sub_part_list('."'$list_part_list->part_no'".');"><u>'.$list_part_list->part_no.'</u></div>';
				            }
				            else {
				            	$row[] = '<div id="part_no_'.$no.'" style="padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; border-bottom: 1px solid white;">'.$list_part_list->part_no.'</div>';
				            }
				            
				            $row[] = '<div id="part_name_'.$no.'" onclick="rto('.$list_part_list->id_part_list.', '."'$list_part_list->part_name'".', '.($rto).', '.$no.');" style="padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; border-bottom: 1px solid white; '.$italic.'">'.$list_part_list->part_name.'</div>';
				            $row[] = '<div id="qtyid_material_'.$no.'" style="border-bottom: 1px solid white;" align="center">'.$list_part_list->material_cd.'</div>';
				            $row[] = '<div id="qty_'.$no.'" style="border-bottom: 1px solid white;" align="center">'.$list_part_list->qty.'</div>';
				            $row[] = '<div id="qty_spare_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$qty_spare.'</div>';
				            $row[] = '<div id="specification_'.$no.'" style="border-bottom: 1px solid white;" align="center">'.$list_part_list->sp_1.' '.$list_part_list->sp_2.' '.$list_part_list->sp_3.' '.$list_part_list->sp_4.' '.$list_part_list->sp_5.'</div>';
				            $row[] = '<div id="qty_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$list_part_list->note.'</div>';
				            $row[] = '<div id="drawing_no_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$drawing_no.'</div>';
				            $row[] = '<div id="account_vendor_'.$no.'" style="border-bottom: 1px solid white;" align="center">'.$account_name_vendor.'</div>';
				            $row[] = '<div id="account_maker_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$account_name_maker.'</div>';
				            $row[] = '<div id="imo_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$material_order_number.'</div>';
				            $row[] = '<div id="rto_date_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$rto_date.'</div>';
				            $row[] = '<div id="file_dwg_'.$no.'" style="border-bottom: 1px solid white;" align="center"><button class="btn btn-sm btn-success" title="Upload file drawing of '.$part_name.'" onClick="upload_file_dwg('.$no.', '.$id_part_list.', '."'$part_name'".', '.$rev.', '."'$JobNo'".');"><i class="mdi mdi-upload"></i></button></div>';
			 
			            $data[] = $row;
		            }
		            
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_part_list_count_all($company_id_session, $JobNo),
		            "recordsFiltered" => $this->m_jomread->list_part_list_count_filtered($company_id_session, $JobNo),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_file_dwg_datatable($key_session, $id_part_list){
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
				$id_part_list = $this->uri->segment('4');
				$result_part_list_file_dwg = $this->m_jomread->list_part_list_file_dwg_datatable($company_id_session, $id_part_list);
		        $data = array();
		        $no = 1;
		        foreach ($result_part_list_file_dwg as $list_part_list_file_dwg) {

		            $row = array();
		            	$download_url = base_url().'/'.$list_part_list_file_dwg->file_name;
			            
			            $row[] = $no;
			            $row[] = $list_part_list_file_dwg->part_name;
			            $row[] = $list_part_list_file_dwg->rev;
			            $row[] = $list_part_list_file_dwg->note;
			            $row[] = $list_part_list_file_dwg->cNmPegawai_create;
			            $row[] = date_format(date_create($list_part_list_file_dwg->create_date), 'd M Y H:i');
			            $row[] = '<button class="btn btn-sm btn-success" title="Download File '.($list_part_list_file_dwg->file_name).' Rev '.($list_part_list_file_dwg->rev).'" onclick="download_file_dwg('."'$download_url'".');"><i class="mdi mdi-download"></i></button>';
		 
		            $data[] = $row;

		            $no++;
		            
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_part_list_file_dwg_count_all($company_id_session, $id_part_list),
		            "recordsFiltered" => $this->m_jomread->list_part_list_file_dwg_count_filtered($company_id_session, $id_part_list),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_part_list_bom_datatable($key_session, $JobNo){
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
				$JobNo = $this->uri->segment('4');
				$result_part_list = $this->m_jomread->list_part_list_bom_datatable($company_id_session, $JobNo);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_part_list as $list_part_list) {

		        	$deleted = $list_part_list->deleted;
		            
		            if ($deleted==0) {

		            	$id_part_list = $list_part_list->id_part_list;
		            	$id_account_vendor_db = $list_part_list->id_account_vendor;
						$account_cd_vendor_db = $list_part_list->account_cd_vendor;
						$account_name_vendor_db = $list_part_list->account_name_vendor;

						if ($id_account_vendor_db == null) {
							$id_account_vendor = '';
						}
						else {
							$id_account_vendor = $id_account_vendor_db;
						}

						if ($account_cd_vendor_db == null) {
							$account_cd_vendor = '';
						}
						else {
							$account_cd_vendor = $account_cd_vendor_db;
						}

						if ($account_name_vendor_db == null) {
							$account_name_vendor = '';
						}
						else {
							$account_name_vendor = $account_name_vendor_db;
						}

						$id_account_maker_db = $list_part_list->id_account_maker;
						$account_cd_maker_db = $list_part_list->account_cd_maker;
						$account_name_maker_db = $list_part_list->account_name_maker;

						if ($id_account_maker_db == null) {
							$id_account_maker = '';
						}
						else {
							$id_account_maker = $id_account_maker_db;
						}

						if ($account_cd_maker_db == null) {
							$account_cd_maker = '';
						}
						else {
							$account_cd_maker = $account_cd_maker_db;
						}

						if ($account_name_maker_db == null) {
							$account_name_maker = '';
						}
						else {
							$account_name_maker = $account_name_maker_db;
						}

						$qty_spare_db = $list_part_list->qty_spare;
						if ($qty_spare_db == null) {
							$qty_spare = '';
						}
						else {
							$qty_spare = $qty_spare_db;
						}

						$drawing_no_db = $list_part_list->drawing_no;
						if ($drawing_no_db == null) {
							$drawing_no = '';
						}
						else {
							$drawing_no = $drawing_no_db;
						}

						$material_order_number_db = $list_part_list->material_order_number;
						if ($material_order_number_db == null) {
							$material_order_number = '';
						}
						else {
							$material_order_number = $material_order_number_db;
						}

						$rto_date_db = $list_part_list->rto_date;
						if ($rto_date_db == null) {
							$rto_date = '';
							$italic = '';
						}
						else {
							$rto_date = date_format(date_create($rto_date_db), 'd-M-Y');
							$italic = 'font-style:italic;';
						}

		            	$no++;
			            $row = array();
			            //$row[] = '<div align="center" style="border-bottom: 1px solid white; background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><input type="checkbox" style="width:20px; height:20px;" id="id_part_list_'.$no.'" value="'.$id_part_list.'"></div>';

			            $row[] = '<div id="JobNo_'.$no.'" style="border-bottom: 1px solid white; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; align="center">'.$list_part_list->JobNo.'</div>';

			            $row[] = '<div id="part_no_'.$no.'" style="padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; border-bottom: 1px solid white;" onclick="add_po_line('.$id_part_list.');">'.$list_part_list->part_no.'</div>';

			            $row[] = '<div id="part_name_'.$no.'" style="padding-left:5px; background-color: rgba(129, 129, 129, 1) !important; z-index: 2; border-bottom: 1px solid white; '.$italic.'">'.$list_part_list->part_name.'</div>';
			            $row[] = '<div id="id_material_'.$no.'" style="border-bottom: 1px solid white;" align="center">'.$list_part_list->material_cd.'</div>';
			            $row[] = '<div id="qty_'.$no.'" style="border-bottom: 1px solid white;" align="center">'.$list_part_list->qty.'</div>';
			            $row[] = '<div id="qty_spare_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$qty_spare.'</div>';
			            $row[] = '<div id="specification_'.$no.'" style="border-bottom: 1px solid white;" align="center">'.$list_part_list->sp_1.' '.$list_part_list->sp_2.' '.$list_part_list->sp_3.' '.$list_part_list->sp_4.' '.$list_part_list->sp_5.'</div>';
			            $row[] = '<div id="qty_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$list_part_list->note.'</div>';
			            $row[] = '<div id="drawing_no_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$drawing_no.'</div>';
			            $row[] = '<div id="account_vendor_'.$no.'" style="border-bottom: 1px solid white;" align="center" onclick="list_account('."'vendor'".', '.$id_part_list.', '.$no.');">'.$account_name_vendor.'</div>';
			            $row[] = '<div id="account_maker_'.$no.'" style="border-bottom: 1px solid white;" align="center" onclick="list_account('."'maker'".', '.$id_part_list.', '.$no.');">&nbsp;'.$account_name_maker.'</div>';
			            //$row[] = '<div id="imo_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$material_order_number.'</div>';
			            $row[] = '<div id="rto_date_'.$no.'" style="border-bottom: 1px solid white;" align="center">&nbsp;'.$rto_date.'</div>';
			 
			            $data[] = $row;
		            }
		            
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_part_list_bom_count_all($company_id_session, $JobNo),
		            "recordsFiltered" => $this->m_jomread->list_part_list_bom_count_filtered($company_id_session, $JobNo),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_part_list_bom_po_datatable($key_session, $id_account){
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
				$id_account = $this->uri->segment('4');
				$result_part_list = $this->m_jomread->list_part_list_bom_po_datatable($company_id_session, $id_account);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_part_list as $list_part_list) {

		            $qty = $list_part_list->qty;

		            $id_part_list = $list_part_list->id_part_list;
		            $result_part_list = $this->m_distributionread->list_purchase_order_by_id_part_list($company_id_session, $id_part_list);
		            $purchase_order_line_qty = $result_part_list[0]->purchase_order_line_qty;

		            if (count($result_part_list)==0) {
		            	$no++;
		            	$row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$id_part_list.'" id="id_inventory_'.$no.'" class="id_inventory" onclick="select_change_inventory('.$no.');">';
			            $row[] = $list_part_list->JobNo;
			            $row[] = $list_part_list->part_no;
			            $row[] = $list_part_list->part_name;
			            $row[] = $list_part_list->account_name_vendor;
			            $row[] = $list_part_list->account_name_maker;

			            $data[] = $row;
		            }
		            else {
		            	if ($purchase_order_line_qty < $qty) {
		            		$no++;
			            	$row = array();
				            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$id_part_list.'" id="id_inventory_'.$no.'" class="id_inventory" onclick="select_change_inventory('.$no.');">';
				            $row[] = $list_part_list->JobNo;
				            $row[] = $list_part_list->part_no;
				            $row[] = $list_part_list->part_name;
				            $row[] = $list_part_list->account_name_vendor;
				            $row[] = $list_part_list->account_name_maker;

				            $data[] = $row;
		            	}
		            }
		            
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_part_list_bom_po_count_all($company_id_session, $id_account),
		            "recordsFiltered" => $this->m_jomread->list_part_list_bom_po_count_filtered($company_id_session, $id_account),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_job_number($key_session, $id_account, $id_job_type){
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
				$id_account = $this->uri->segment('4');
				$id_job_type = $this->uri->segment('5');
				$result_job_type = $this->m_jomread->list_job_type($company_id_session, $id_job_type);
				$data_array = array();
				foreach($result_job_type as $result_job_type_list){
					$id_job_type = $result_job_type_list->id_job_type;
					$job_type_cd = $result_job_type_list->job_type_cd;
					$result = $this->m_jomread->list_job_number($company_id_session, $id_account, $id_job_type);
					if (count($result)==0) {
						$number = 0;
						$account_cd = '';
					}
					else {
						$number = $result[0]->number;
						$account_cd = $result[0]->account_cd;
					}
					if ($number>99) {
						$number_format = ($number)+1;
					}
					else {
						$number_format = sprintf("%03d", ($number)+1);
					}
					
					$job_type_format = $result_job_type_list->job_type_format;
					$JobNo = str_replace('yyy', $number_format, (str_replace('xxx', $account_cd, str_replace('z', $job_type_cd, $job_type_format))));

					$data = array(
						'id_job_type' => $result_job_type_list->id_job_type,
						'job_type_cd' => $result_job_type_list->job_type_cd,
						'job_type_name' => $result_job_type_list->job_type_name,
						'job_type_name_dash' => str_replace(' ', '_', $result_job_type_list->job_type_name),
						'job_type_format' => $result_job_type_list->job_type_format,
						'account_cd' => $account_cd,
						'number' => $number,
						'number_format' => $number_format,
						'JobNo' => $JobNo
					);
					array_push ($data_array, $data);
				}								
				echo json_encode(array(array('status' => 1, 'response' => $data_array)));
			}
		}
	}

	public function list_employee($key_session, $department){
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
				$department = $this->uri->segment('4');
				if ($company_id_session==1) {
					if ($department=='marketing') {
						$cIDDept = 'DEP002';
					}
					else if ($department=='design') {
						$cIDDept = 'DEP004';
					}
				}
				$result = $this->m_jomread->list_employee_by_dept($company_id_session, $cIDDept);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cNIK = $resultList->cNIK;
						$cNmPegawai = $resultList->cNmPegawai;
						$cIDJbtn = $resultList->cIDJbtn;

						if (($cIDJbtn*1)<=8) {
							$data=array(
								"cNIK" => $cNIK,
								"cNmPegawai" => $cNmPegawai
							);
							array_push($data_array, $data);
						}
					}
				}					
								
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_employee_datatable($key_session, $customer_id){
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
				$result_employee = $this->m_jomread->list_employee_datatable();
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_employee as $employee_list) {
		            $no++;
		            $row = array();
		            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$employee_list->cNmPegawai.'" id="id_employee_'.$no.'" class="id_employee" onclick="select_change_employee('.$no.');">';
		            $row[] = $employee_list->cNIK;
		            $row[] = $employee_list->cNmPegawai;
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_employee_count_all(),
		            "recordsFiltered" => $this->m_jomread->list_employee_count_filtered(),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_job_order_by_jobno($key_session, $JobNo){
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
				$JobNo = $this->uri->segment('4');
				$result = $this->m_jomread->list_job_order_by_jobno($company_id_session, $JobNo);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_job_order = $resultList->id_job_order;
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_account = $resultList->id_account;
						$account_cd = $resultList->account_cd;
						$account_name = $resultList->account_name;
						$id_job_type = $resultList->id_job_type;
						$job_type_cd = $resultList->job_type_cd;
						$job_type_name = $resultList->job_type_name;
						$JobNo = $resultList->JobNo;
						$MoldName = $resultList->MoldName;
						$MoldNomor = $resultList->MoldNomor;
						$JobName = $resultList->JobName;
						$POCustomerNumber = $resultList->POCustomerNumber;
						$PODate = $resultList->PODate;
						$Qty = $resultList->Qty;
						$Amount = $resultList->Amount;
						$GrossProfit = $resultList->GrossProfit;
						$cNIK_marketing = $resultList->cNIK_marketing;
						$cNmPegawai_marketing = $resultList->cNmPegawai_marketing;
						$cNIK_design = $resultList->cNIK_design;
						$cNmPegawai_design = $resultList->cNmPegawai_design;
						$StartDatePlan = $resultList->StartDatePlan;
						$StartDateAct = $resultList->StartDateAct;
						$DeliveryDatePlan = $resultList->DeliveryDatePlan;
						$DeliveryDateAct = $resultList->DeliveryDateAct;
						$Keterangan = $resultList->Keterangan;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;

						$data=array(
							'id_job_order' => $id_job_order,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'id_account' => $id_account,
							'account_cd' => $account_cd,
							'account_name' => $account_name,
							'id_job_type' => $id_job_type,
							'job_type_cd' => $job_type_cd,
							'job_type_name' => $job_type_name,
							'JobNo' => $JobNo,
							'MoldName' => $MoldName,
							'MoldNomor' => $MoldNomor,
							'JobName' => $JobName,
							'POCustomerNumber' => $POCustomerNumber,
							'PODate' => $PODate,
							'Qty' => $Qty,
							'Amount' => $Amount,
							'GrossProfit' => $GrossProfit,
							'cNIK_marketing' => $cNIK_marketing,
							'cNmPegawai_marketing' => $cNmPegawai_marketing,
							'cNIK_design' => $cNIK_design,
							'cNmPegawai_design' => $cNmPegawai_design,
							'StartDatePlan' => $StartDatePlan,
							'StartDateAct' => $StartDateAct,
							'DeliveryDatePlan' => $DeliveryDatePlan,
							'DeliveryDateAct' => $DeliveryDateAct,
							'Keterangan' => $Keterangan,
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
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_job_order($key_session, $id_account, $id_job_type){
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
				$id_account = $this->uri->segment('4');
				$id_job_type = $this->uri->segment('5');
				$result = $this->m_jomread->list_job_order($company_id_session, $id_account, $id_job_type);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_job_order = $resultList->id_job_order;
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_account = $resultList->id_account;
						$account_cd = $resultList->account_cd;
						$account_name = $resultList->account_name;
						$id_job_type = $resultList->id_job_type;
						$job_type_cd = $resultList->job_type_cd;
						$job_type_name = $resultList->job_type_name;
						$JobNo = $resultList->JobNo;
						$MoldName = $resultList->MoldName;
						$MoldNomor = $resultList->MoldNomor;
						$JobName = $resultList->JobName;
						$POCustomerNumber = $resultList->POCustomerNumber;
						$PODate = $resultList->PODate;
						$Qty = $resultList->Qty;
						$Amount = $resultList->Amount;
						$GrossProfit = $resultList->GrossProfit;
						$cNIK_marketing = $resultList->cNIK_marketing;
						$cNmPegawai_marketing = $resultList->cNmPegawai_marketing;
						$cNIK_design = $resultList->cNIK_design;
						$cNmPegawai_design = $resultList->cNmPegawai_design;
						$StartDatePlan = $resultList->StartDatePlan;
						$StartDateAct = $resultList->StartDateAct;
						$DeliveryDatePlan = $resultList->DeliveryDatePlan;
						$DeliveryDateAct = $resultList->DeliveryDateAct;
						$Keterangan = $resultList->Keterangan;
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;

						if($StartDateAct==null){
							$StartDateAct_format = '';
						}
						else {
							$StartDateAct_format = date_format(date_create($StartDateAct), 'd-M-Y');
						}

						if($DeliveryDateAct==null){
							$DeliveryDateAct_format = '';
						}
						else {
							$DeliveryDateAct_format = date_format(date_create($DeliveryDateAct), 'd-M-Y');
						}

						$data=array(
							'id_job_order' => $id_job_order,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'id_account' => $id_account,
							'account_cd' => $account_cd,
							'account_name' => $account_name,
							'id_job_type' => $id_job_type,
							'job_type_cd' => $job_type_cd,
							'job_type_name' => $job_type_name,
							'JobNo' => $JobNo,
							'MoldName' => $MoldName,
							'MoldNomor' => $MoldNomor,
							'JobName' => $JobName,
							'POCustomerNumber' => $POCustomerNumber,
							'PODate' => $PODate,
							'PODate_format' => date_format(date_create($PODate), 'd-M-Y'),
							'Qty' => $Qty*1,
							'Amount' => $Amount,
							'Amount_format' => number_format($Amount, 2),
							'GrossProfit' => $GrossProfit,
							'GrossProfit_format' => number_format($GrossProfit, 2),
							'cNIK_marketing' => $cNIK_marketing,
							'cNmPegawai_marketing' => $cNmPegawai_marketing,
							'cNIK_design' => $cNIK_design,
							'cNmPegawai_design' => $cNmPegawai_design,
							'StartDatePlan' => $StartDatePlan,
							'StartDatePlan_format' => date_format(date_create($StartDatePlan), 'd-M-Y'),
							'StartDateAct_format' => $StartDateAct_format,
							'DeliveryDatePlan' => $DeliveryDatePlan,
							'DeliveryDatePlan_format' => date_format(date_create($DeliveryDatePlan), 'd-M-Y'),
							'DeliveryDateAct_format' => $DeliveryDateAct_format,
							'Keterangan' => $Keterangan,
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
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_job_order_datatable($key_session){
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
				$result_job_order = $this->m_jomread->list_job_order_datatable($company_id_session);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_job_order as $job_order_list) {
		            $no++;
		            $row = array();
		            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$job_order_list->JobNo.'" id="id_job_order_'.$no.'" class="id_job_order" onclick="select_change_job_order('.$no.');">';
		            $row[] = $job_order_list->JobNo;
		            $row[] = $job_order_list->JobName;
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_job_order_datatable_count_all($company_id_session),
		            "recordsFiltered" => $this->m_jomread->list_job_order_datatable_count_filtered($company_id_session),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_after_trial($key_session, $jobno){
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
				$jobno = $this->uri->segment('4');
				$result = $this->m_jomread->list_after_trial_by_jobno($company_id_session, $jobno);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_job_order_after_trial = $resultList->id_job_order_after_trial;
						$company_id = $resultList->company_id;
						$company_name = $resultList->company_name;
						$id_job_order = $resultList->id_job_order;
						$JobNo = $resultList->JobNo;
						$JobName = $resultList->JobName;
						$trial = $resultList->trial;
						$DeliveryDatePlan = $resultList->DeliveryDatePlan;
						$DeliveryDateAct = $resultList->DeliveryDateAct;
						$DeliveryDatePlan_format = date_format(date_create($resultList->DeliveryDatePlan), 'd-M-Y');
						$create_by = $resultList->create_by;
						$cNmPegawai_create = $resultList->cNmPegawai_create;
						$create_date = $resultList->create_date;
						$last_by = $resultList->last_by;
						$cNmPegawai_last = $resultList->cNmPegawai_last;
						$last_update = $resultList->last_update;

						if($DeliveryDateAct==null){
							$DeliveryDateAct_format = '';
						}
						else {
							$DeliveryDateAct_format = date_format(date_create($DeliveryDateAct), 'd-M-Y');
						}

						$data=array(
							'id_job_order_after_trial' => $id_job_order_after_trial,
							'company_id' => $company_id,
							'company_name' => $company_name,
							'id_job_order' => $id_job_order,
							'JobNo' => $JobNo,
							'JobName' => $JobName,
							'trial' => $trial,
							'DeliveryDatePlan' => $DeliveryDatePlan,
							'DeliveryDateAct' => $DeliveryDateAct,
							'DeliveryDatePlan_format' => $DeliveryDatePlan_format,
							'DeliveryDateAct_format' => $DeliveryDateAct_format,
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
				echo json_encode(array(array('status' => $status, 'response'=> $data_array)));
			}
		}
	}

	public function list_inventory($key_session, $id_inventory){
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
				$id_inventory = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_inventory($company_id_session, $id_inventory);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_inventory' => $resultList->id_inventory,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_item_class' => $resultList->id_item_class,
							'item_class_cd' => $resultList->item_class_cd,
							'item_class_name' => $resultList->item_class_name,
							'inventory_cd' => $resultList->inventory_cd,
							'inventory_name' => $resultList->inventory_name,
							'id_sub_tax' => $resultList->id_sub_tax,
							'sub_tax_cd' => $resultList->sub_tax_cd,
							'sub_tax_name' => $resultList->sub_tax_name,
							'id_uom' => $resultList->id_uom,
							'uom_cd' => $resultList->uom_cd,
							'uom_name' => $resultList->uom_name,
							'id_coa' => $resultList->id_coa,
							'coa_cd' => $resultList->coa_cd,
							'coa_name' => $resultList->coa_name,
							'id_warehouse' => $resultList->id_warehouse,
							'warehouse_cd' => $resultList->warehouse_cd,
							'warehouse_name' => $resultList->warehouse_name,
							'deleted' => $resultList->deleted,
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

	public function list_inventory_datatable($key_session){
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
				$result_inventory = $this->m_jomread->list_inventory_datatable($company_id_session);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_inventory as $inventory_list) {

		            if ($inventory_list->deleted==0) {
		            	$no++;
		            	$row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$inventory_list->id_inventory.'" id="id_inventory_'.$no.'" class="id_inventory" onclick="select_change_inventory('.$no.');">';
			            $row[] = $inventory_list->inventory_cd;
			            $row[] = $inventory_list->inventory_name;

			            $data[] = $row;
		            }
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_jomread->list_inventory_count_all($company_id_session),
		            "recordsFiltered" => $this->m_jomread->list_inventory_count_filtered($company_id_session),
		            "data" => $data,
		        );
		        echo json_encode($output);
		    }
		}
	}

	public function list_imo($key_session, $JobNo, $id_material_order){
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
				$JobNo = $this->uri->segment('4');
				$id_material_order = $this->uri->segment('5');
				$result = $this->m_jomread->list_imo($company_id_session, $JobNo, $id_material_order);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$material_order_number = $resultList->material_order_number;
						$cut_dimension = $resultList->cut_dimension;
						
						$result_imo_detail = $this->m_jomread->list_imo_detail($company_id_session, $material_order_number);
						$data_line_array = array();
						foreach ($result_imo_detail as $resultListLine){
							$data_line = array(
								'id_material_order_line' => $resultListLine->id_material_order_line,
								'id_part_list' => $resultListLine->id_part_list,
								'part_name' => $resultListLine->part_name,
								'material_cd' => $resultListLine->material_cd,
								'qty' => $resultListLine->qty,
								'sp_1' => ($resultListLine->sp_1)*1,
								'sp_1_cut' => (($resultListLine->sp_1)*1)+$cut_dimension,
								'sp_3' => ($resultListLine->sp_3)*1,
								'sp_3_cut' => (($resultListLine->sp_3)*1)+$cut_dimension,
								'sp_5' => ($resultListLine->sp_5)*1,
								'sp_5_cut' => (($resultListLine->sp_5)*1)+$cut_dimension,
							);
							array_push ($data_line_array, $data_line);
						}

						$id_account_vendor = $resultList->id_account_vendor;

						$result_part_list_uncheck = $this->m_jomread->list_part_list_by_account_imo($company_id_session, $JobNo,  $id_account_vendor);
						$data_line_uncheck_array = array();
						foreach ($result_part_list_uncheck as $resultListLineUncheck){
							$data_line_uncheck = array(
								'id_part_list' => $resultListLineUncheck->id_part_list,
								'part_name' => $resultListLineUncheck->part_name,
								'material_cd' => $resultListLineUncheck->material_cd,
								'qty' => $resultListLineUncheck->qty,
								'sp_1' => ($resultListLineUncheck->sp_1)*1,
								'sp_1_cut' => (($resultListLineUncheck->sp_1)*1)+$cut,
								'sp_3' => ($resultListLineUncheck->sp_3)*1,
								'sp_3_cut' => (($resultListLineUncheck->sp_3)*1)+$cut,
								'sp_5' => ($resultListLineUncheck->sp_5)*1,
								'sp_5_cut' => (($resultListLineUncheck->sp_5)*1)+$cut,
							);
							array_push ($data_line_uncheck_array, $data_line_uncheck);
						}

						$data = array(
							'id_material_order' => $resultList->id_material_order,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'material_order_number' => $resultList->material_order_number,
							'id_job_order' => $resultList->id_job_order,
							'JobNo' => $resultList->JobNo,
							'MoldName' => $resultList->MoldName,
							'id_account_vendor' => $resultList->id_account_vendor,
							'account_cd' => $resultList->account_cd,
							'account_name' => $resultList->account_name,
							'cut_dimension' => $resultList->cut_dimension,
							'date_order' => $resultList->date_order,
							'date_delivery_plan' => $resultList->date_delivery_plan,
							'issued' => $resultList->issued,
							'cNmPegawai_issued' => $resultList->cNmPegawai_issued,
							'checked_1' => $resultList->checked_1,
							'cNmPegawai_checked_1' => $resultList->cNmPegawai_checked_1,
							'approve_checked_1' => $resultList->approve_checked_1,
							'checked_2' => $resultList->checked_2,
							'cNmPegawai_checked_2' => $resultList->cNmPegawai_checked_2,
							'approve_checked_2' => $resultList->approve_checked_2,
							'approved' => $resultList->approved,
							'cNmPegawai_approved' => $resultList->cNmPegawai_approved,
							'approve_approved' => $resultList->approve_approved,
							'create_by' => $resultList->create_by,
							'cNmPegawai_create' => $resultList->cNmPegawai_create,
							'create_date' => $resultList->create_date,
							'last_by' => $resultList->last_by,
							'cNmPegawai_last' => $resultList->cNmPegawai_last,
							'last_update' => $resultList->last_update,
							'material_order_line' => $data_line_array,
							'data_line_uncheck_array' => $data_line_uncheck_array
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

}