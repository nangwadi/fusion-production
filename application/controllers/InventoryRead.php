<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class InventoryRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_inventoryread');
        $this->load->model('m_distributionread');
        $this->load->model('m_jomread');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// aldo
	// Setting

	public function list_uom($key_session, $id_uom){
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
				$id_uom = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_uom($company_id_session, $id_uom);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_uom' => $resultList->id_uom,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'uom_cd' => $resultList->uom_cd,
							'uom_name' => $resultList->uom_name,
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

	public function list_class_category($key_session, $id_class_category){
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
				$id_class_category = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_class_category($company_id_session, $id_class_category);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_class_category' => $resultList->id_class_category,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'class_category_cd' => $resultList->class_category_cd,
							'class_category_name' => $resultList->class_category_name,
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

	public function list_warehouse($key_session, $id_warehouse){
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
				$id_warehouse = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_warehouse($company_id_session, $id_warehouse);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_warehouse' => $resultList->id_warehouse,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'warehouse_cd' => $resultList->warehouse_cd,
							'warehouse_name' => $resultList->warehouse_name,
							'full_address' => $resultList->full_address,
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

	public function list_item_class($key_session, $id_item_class){
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
				$id_item_class = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_item_class($company_id_session, $id_item_class);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$cNmDept = $resultList->cNmDept;
						if ($cNmDept==null) {
							$cNmDept_desc = '';
						}
						else {
							$cNmDept_desc = $cNmDept;
						}
						$data = array(
							'id_item_class' => $resultList->id_item_class,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_class_category' => $resultList->id_class_category,
							'class_category_cd' => $resultList->class_category_cd,
							'class_category_name' => $resultList->class_category_name,
							'item_class_cd' => $resultList->item_class_cd,
							'item_class_name' => $resultList->item_class_name,
							'cIDDept' => $resultList->cIDDept,
							'cNmDept' => $cNmDept_desc,
							'kit_assy' => $resultList->kit_assy,
							'atk_stock' => $resultList->atk_stock,
							'common_stock' => $resultList->common_stock,
							'id_warehouse' => $resultList->id_warehouse,
							'warehouse_cd' => $resultList->warehouse_cd,
							'warehouse_name' => $resultList->warehouse_name,
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

		public function list_item_class_datatable($key_session, $id_item_class){

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

					$result_item_class = $this->m_inventoryread->list_item_class_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_item_class as $item_class_list) {
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$item_class_list->item_class_cd.' // '.$item_class_list->item_class_name.'" id="item_class_cd_'.$no.'" class="item_class_cd" onclick="select_change_item_class('.$no.');">';
			            $row[] = $item_class_list->item_class_cd;
			            $row[] = $item_class_list->item_class_name;
			            $row[] = $item_class_list->class_category_name;
			            $row[] = $item_class_list->cNmDept;
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_item_class_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_item_class_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_sub_tax_datatable($key_session, $id_sub_tax){

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

					$result_sub_tax = $this->m_inventoryread->list_sub_tax_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_sub_tax as $sub_tax_list) {
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$sub_tax_list->sub_tax_cd.' // '.$sub_tax_list->sub_tax_name.'" id="sub_tax_cd_'.$no.'" class="sub_tax_cd" onclick="select_change_sub_tax('.$no.');">';
			            $row[] = $sub_tax_list->sub_tax_cd;
			            $row[] = $sub_tax_list->sub_tax_name;
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_sub_tax_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_sub_tax_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_uom_datatable($key_session, $id_uom){

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

					$result_uom = $this->m_inventoryread->list_uom_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_uom as $uom_list) {
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$uom_list->uom_cd.' // '.$uom_list->uom_name.'" id="uom_cd_'.$no.'" class="uom_cd" onclick="select_change_uom('.$no.');">';
			            $row[] = $uom_list->uom_cd;
			            $row[] = $uom_list->uom_name;
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_uom_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_uom_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_coa_datatable($key_session, $id_coa){

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

					$result_coa = $this->m_inventoryread->list_coa_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_coa as $coa_list) {
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$coa_list->coa_cd.' // '.$coa_list->coa_name.'" id="coa_cd_'.$no.'" class="coa_cd" onclick="select_change_coa('.$no.');">';
			            $row[] = $coa_list->coa_cd;
			            $row[] = $coa_list->coa_name;
			            $row[] = $coa_list->coa_classes_name;
			            $row[] = $coa_list->coa_type_name;
			            $row[] = $coa_list->coa_currency_name;
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_coa_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_coa_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_coa_income_datatable($key_session, $id_coa){

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

					$result_coa = $this->m_inventoryread->list_coa_income_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_coa as $coa_list) {
			        	$no++;
			        	$row = array();
			            
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$coa_list->coa_cd.' // '.$coa_list->coa_name.'" id="coa_cd_'.$no.'" class="coa_cd" onclick="select_change_coa('.$no.');">';
			            $row[] = $coa_list->coa_cd;
			            $row[] = $coa_list->coa_name;
			            $row[] = $coa_list->coa_classes_name;
			            $row[] = $coa_list->coa_type_name;
			            $row[] = $coa_list->coa_currency_name;
			 
			        	$data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_coa_income_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_coa_income_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_warehouse_datatable($key_session, $id_warehouse){

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

					$result_warehouse = $this->m_inventoryread->list_warehouse_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_warehouse as $warehouse_list) {
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$warehouse_list->warehouse_name.'" id="warehouse_cd_'.$no.'" class="warehouse_cd" onclick="select_change_warehouse('.$no.');">';
			            $row[] = $warehouse_list->warehouse_cd;
			            $row[] = $warehouse_list->warehouse_name;
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_warehouse_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_warehouse_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

	public function list_group($key_session){
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
				$result = $this->m_inventoryread->list_group($company_id_session, 0);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_inv_group' => $resultList->id_inv_group,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'group_cd' => $resultList->group_cd,
							'group_name' => $resultList->group_name,
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

		public function list_group_datatable($key_session){
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

					$result_inventory = $this->m_inventoryread->list_group_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_inventory as $inventory_list) {
			        	$id_inv_group = $inventory_list->id_inv_group;
			        	$group_cd = $inventory_list->group_cd;
			        	$group_name = $inventory_list->group_name;
			        	$img_banner = $inventory_list->img_banner;
			        	$img_inside = $inventory_list->img_inside;
			        	$deleted = $inventory_list->deleted;

			            $no++;
			            $row = array();
			            $row[] = $no;
			            $row[] = '<div id="group_cd_'.$no.'">'.$group_cd.'</div>';
			            $row[] = '<div id="group_name_'.$no.'">'.$group_name.'</div>';

			            if ($img_banner == null || $img_banner == '') {
			            	$row[] = '<div id="img_banner_'.$no.'"><button class="btn btn-sm btn-warning" onClick="modal_upload('.$id_inv_group.', '."'$group_name'".', 1, '."'no-img.png'".');"><i class="mdi mdi-upload"></i></button></div>';
			            }
			            else {
			            	$row[] = '<div id="img_banner_'.$no.'"><button class="btn btn-sm btn-success" onClick="modal_upload('.$id_inv_group.', '."'$group_name'".', 1, '."'$img_banner'".');"><i class="mdi mdi-image"></i></button></div>';
			            }

			            if ($img_inside == null || $img_inside == '') {
			            	$row[] = '<div id="img_inside_'.$no.'"><button class="btn btn-sm btn-warning" onClick="modal_upload('.$id_inv_group.', '."'$group_name'".', 2, '."'no-img.png'".');"><i class="mdi mdi-upload"></i></button></div>';
			            }
			            else {
			            	$row[] = '<div id="img_inside_'.$no.'"><button class="btn btn-sm btn-success" onClick="modal_upload('.$id_inv_group.', '."'$group_name'".', 2, '."'$img_inside'".');;"><i class="mdi mdi-image"></i></button></div>';
			            }

			            if ($deleted==0) {
			            	$row[] = '<button class="btn btn-md btn-info" onClick="update('.$id_inv_group.', '."'$group_cd'".', '."'$group_name'".', '.$no.');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-md btn-danger" onClick="disable_enable('.$id_inv_group.', '."'$group_name'".', '.(1).');"><i class="mdi mdi-delete"></i></button>';
			            }
			            else {
			            	$row[] = '<button class="btn btn-md btn-warning" onClick="disable_enable('.$id_inv_group.', '."'$group_name'".', '.(0).');"><i class="mdi mdi-backup-restore"></i></button>';
			            }
			            
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_group_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_group_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

	public function list_maker($key_session){
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
				$result = $this->m_inventoryread->list_maker($company_id_session, 0);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_inv_maker' => $resultList->id_inv_maker,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'maker_cd' => $resultList->maker_cd,
							'maker_name' => $resultList->maker_name,
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

		public function list_maker_datatable($key_session){
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

					$result_inventory = $this->m_inventoryread->list_maker_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_inventory as $inventory_list) {
			        	$id_inv_maker = $inventory_list->id_inv_maker;
			        	$maker_cd = $inventory_list->maker_cd;
			        	$maker_name = $inventory_list->maker_name;
			        	$deleted = $inventory_list->deleted;

			            $no++;
			            $row = array();
			            $row[] = $no;
			            $row[] = '<div id="maker_cd_'.$no.'">'.$maker_cd.'</div>';
			            $row[] = '<div id="maker_name_'.$no.'">'.$maker_name.'</div>';

			            if ($deleted==0) {
			            	$row[] = '<button class="btn btn-md btn-info" onClick="update('.$id_inv_maker.', '."'$maker_cd'".', '."'$maker_name'".', '.$no.');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-md btn-danger" onClick="disable_enable('.$id_inv_maker.', '."'$maker_name'".', '.(1).');"><i class="mdi mdi-delete"></i></button>';
			            }
			            else {
			            	$row[] = '<button class="btn btn-md btn-warning" onClick="disable_enable('.$id_inv_maker.', '."'$maker_name'".', '.(0).');"><i class="mdi mdi-backup-restore"></i></button>';
			            }
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_maker_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_maker_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
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
							'id_inv_maker' => $resultList->id_inv_maker,
							'maker_cd' => $resultList->maker_cd,
							'maker_name' => $resultList->maker_name,
							'id_inv_group' => $resultList->id_inv_group,
							'group_cd' => $resultList->group_cd,
							'group_name' => $resultList->group_name,
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

	public function list_inventory_img($key_session, $id_inventory){
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
				$result = $this->m_inventoryread->list_inventory_img($company_id_session, $id_inventory);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_inventory_img' => $resultList->id_inventory_img,
							'company_id' => $resultList->company_id,
							'id_inventory' => $resultList->id_inventory,
							'img_name' => $resultList->img_name,
							'set_banner' => $resultList->set_banner,
							'create_by' => $resultList->create_by,
							'create_date' => $resultList->create_date,
							'last_by' => $resultList->last_by,
							'last_update' => $resultList->last_update,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

		public function list_inventory_datatable($key_session, $id_inventory){
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

					$result_inventory = $this->m_inventoryread->list_inventory_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_inventory as $inventory_list) {
			        	$id_inventory = $inventory_list->id_inventory;
			        	$kit_assy = $inventory_list->kit_assy;
			        	$atk_stock = $inventory_list->atk_stock;
			        	$common_stock = $inventory_list->common_stock;

			        	if ($kit_assy==0 && $atk_stock==0 && $common_stock==0) {
			        		$id_inventory_sum = 0;
			        	}
			        	else {
				        	$id_inventory_sum = ($inventory_list->total_count)*1;			        	
			        	}

			        	if ($inventory_list->cNmDept==null) {
			        		$cNmDept_desc = '';
			        	}
			        	else {
			        		$cNmDept_desc = $inventory_list->cNmDept;
			        	}

			        	$id_inv_maker = $inventory_list->id_inv_maker;
			        	if ($id_inv_maker == null) {
			        		$maker_cd = "";
			        		$maker_name = "";
			        	}
			        	else {
			        		$maker_cd = $inventory_list->maker_cd;
			        		$maker_name = $inventory_list->maker_name;
			        	}

			        	$id_inv_group = $inventory_list->id_inv_group;
			        	if ($id_inv_group == null) {
			        		$group_cd = "";
			        		$group_name = "";
			        	}
			        	else {
			        		$group_cd = $inventory_list->group_cd;
			        		$group_name = $inventory_list->group_name;
			        	}

			            $no++;
			            $row = array();
			            $row[] = $no;
			            $row[] = '<div id="inventory_cd_'.$no.'">'.$inventory_list->inventory_cd.'</div>';
			            $row[] = '<div id="inventory_name_'.$no.'">'.$inventory_list->inventory_name.'</div>';
			            $row[] = '<div id="group_name_'.$no.'">'.$group_name.'</div>';
			            $row[] = '<div id="maker_name_'.$no.'">'.$maker_name.'</div>';
			            $row[] = '<div id="id_item_class_'.$no.'" title="'.$inventory_list->item_class_name.'">'.$inventory_list->item_class_cd.'</div>';
			            $row[] = '<div id="stock_'.$no.'">'.$id_inventory_sum.'</div>';
			            $row[] = '<div id="id_sub_tax_'.$no.'" title="'.$inventory_list->sub_tax_name.'">'.$inventory_list->sub_tax_cd.'</div>';
			            $row[] = '<div id="id_uom_'.$no.'" title="'.$inventory_list->uom_name.'">'.$inventory_list->uom_cd.'</div>';
			            $row[] = '<div id="id_coa_'.$no.'" title="'.$inventory_list->coa_name.'">'.$inventory_list->coa_cd.'</div>';
			            $row[] = '<div id="cIDDept_'.$no.'">'.$cNmDept_desc.'</div>';

			            if ($inventory_list->deleted==0) {
			            	$row[] = '<button class="btn btn-md btn-success" onClick="upload_img('.$inventory_list->id_inventory.', '."'$inventory_list->inventory_name'".');"><i class="mdi mdi-image"></i></button>&nbsp;&nbsp;<button class="btn btn-md btn-info" onClick="update('.$inventory_list->id_inventory.', '.$no.');"><i class="mdi mdi-lead-pencil"></i></button>&nbsp;&nbsp;<button class="btn btn-md btn-danger" onClick="disable_enable('.$inventory_list->id_inventory.', '."'$inventory_list->inventory_name'".', '.(1).');"><i class="mdi mdi-delete"></i></button>';
			            }
			            else {
			            	$row[] = '<button class="btn btn-md btn-warning" onClick="disable_enable('.$inventory_list->id_inventory.', '."'$inventory_list->inventory_name'".', '.(0).');"><i class="mdi mdi-backup-restore"></i></button>';
			            }
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_inventory_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_inventory_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_inventory_stock_datatable($key_session, $item_class, $id_inventory){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$item_class_get = $this->uri->segment('4');
				$id_inventory_get = $this->uri->segment('5');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_inventory = $this->m_inventoryread->list_inventory_stock_datatable($company_id_session, $item_class_get);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_inventory as $inventory_list) {
			        	
			        	$no++;

			        	$id_inventory = $inventory_list->id_inventory;
			        	$inventory_cd = $inventory_list->inventory_cd;
			        	$inventory_name = $inventory_list->inventory_name;
			        	$item_class_cd = $inventory_list->item_class_cd;
			        	$item_class_name = $inventory_list->item_class_name;

			        	$kit_assy = $inventory_list->kit_assy;
			        	$atk_stock = $inventory_list->atk_stock;
			        	$common_stock = $inventory_list->common_stock;
			        	$uom_cd = $inventory_list->uom_cd;

			        	$row = array();

		        		if ($kit_assy==0 && $atk_stock==0 && $common_stock==0) {
			        		$id_inventory_sum = 0;
			        	}
			        	else {
				        	$id_inventory_sum = ($inventory_list->total_count)*1;			        	
			        	}

			        	if ($inventory_list->cNmDept==null) {
			        		$cNmDept_desc = '';
			        	}
			        	else {
			        		$cNmDept_desc = $inventory_list->cNmDept;
			        	}

			        	if ($item_class_get=='common_stock') {
			        		$category = 'cs';
			        	}
			        	else if ($item_class_get=='atk_stock') {
			        		$category = 'pns';
			        	}

			        	$result_annual_price = $this->m_inventoryread->list_annual_price_by_active($company_id_session, $category, $id_inventory);
			        	if (count($result_annual_price) == 0) {
			        		$annual_price_format = 0;
			        	}
			        	else {
			        		$annual_price = ($result_annual_price[0]->annual_price)*1;
			        		$annual_price_format = number_format($result_annual_price[0]->annual_price, 2);
			        	}

			        	$total_amount = $annual_price*$id_inventory_sum;
			        	$total_amount_format = number_format($total_amount, 2);

			        	if ($item_class_get=='atk_stock') {
			        		$result_uom_convert = $this->m_inventoryread->list_uom_converter($company_id_session, $id_inventory);
			        		if(count($result_uom_convert) == 0){
			        			$td_uom = '<div align="center" id="uom_cd_'.$no.'" onClick="modal_uom_converter('."'$id_inventory'".', '."'$inventory_name'".', '."'$uom_cd'".', '."'$no'".');">'.$uom_cd.'</div>';
			        		}
			        		else {
			        			$uom_cd_convert = $result_uom_convert[0]->uom_cd_convert;
			        			$td_uom = '<div align="center" id="uom_cd_'.$no.'" onClick="modal_uom_converter('."'$id_inventory'".', '."'$inventory_name'".', '."'$uom_cd'".', '."'$no'".');">'.$uom_cd_convert.'</div>';
			        		}
			        	}
			        	else {
			        		$td_uom = '<div align="center">'.$uom_cd.'</div>';
			        	}			            
			            
			            $row[] = $no;
			            $row[] = '<div id="inventory_cd_'.$no.'">'.$inventory_cd.'</div>';
			            $row[] = '<div id="inventory_name_'.$no.'">'.$inventory_name.'</div>';
			            $row[] = '<div id="id_item_class_'.$no.'" title="'.$item_class_name.'">'.$item_class_cd.'</div>';
			            $row[] = '<div align="right" style="padding-right:13px;">'.$id_inventory_sum.'</div>';
			            $row[] =  $td_uom;
			            $row[] = '<div align="right" style="padding-right:13px;" onClick="modal_unit_price('."'$id_inventory'".', '."'$inventory_name'".', '."'$no'".');">'.$annual_price_format.'</div>';
			            $row[] = '<div align="right" style="padding-right:13px;">'.$total_amount_format.'</div>';
			 
			        	$data[] = $row;
			        	
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_inventory_stock_count_all($company_id_session, 'common_stock'),
			            "recordsFiltered" => $this->m_inventoryread->list_inventory_stock_count_filtered($company_id_session, 'common_stock'),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_inventory_return_datatable($key_session, $id_inventory){
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

					$result_inventory = $this->m_inventoryread->list_inventory_return_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_inventory as $inventory_list) {
			        	$id_purchase_receipt_line = $inventory_list->id_purchase_receipt_line;
			        	$id_total_count_in_line = $inventory_list->id_total_count_in_line;
			        	$description = $inventory_list->description;
			        	$decimal_after = $inventory_list->decimal_after;
			        	$coa_currency_cd = $inventory_list->coa_currency_cd;

			        	$id_kit_assy_line = $inventory_list->id_kit_assy_line;

			        	//if ($id_kit_assy_line == null) {
			        		$no++;
				            $row = array();
				            $row[] = $no;
				            $row[] = $inventory_list->purchase_receipt_number;
				            $row[] = $inventory_list->description;
				            $row[] = '	<input type="hidden" id="qty_'.$no.'" value="'.(($inventory_list->qty_in)*1).'">
				            			<input type="number" id="qty_used_'.$no.'" class="form-control" value="'.(($inventory_list->qty_in)*1).'" max="'.(($inventory_list->qty_in)*1).'" min="0">';
				            $row[] = $inventory_list->uom_cd;
				            $row[] = $coa_currency_cd.'. '.number_format($inventory_list->cury_unit_price, $decimal_after);
				            $row[] = $coa_currency_cd.'. '.number_format($inventory_list->amount, $decimal_after);

				            $row[] = '<button class="btn btn-md btn-warning" onClick="returns('.$no.', '.$id_purchase_receipt_line.', '.$id_total_count_in_line.', '."'$description'".');"><i class="mdi mdi-backup-restore"></i></button>';
				 
				            $data[] = $row;
			        	//}

			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_inventory_return_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_inventory_return_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_return_datatable($key_session){
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

					$result_return = $this->m_inventoryread->list_return_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_return as $return_list) {

			        	$decimal_after = $return_list->decimal_after;
			        	
			            $no++;
			            $row = array();
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.$no.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.$return_list->return_number.'</div>';
				            $row[] = $return_list->description;
				            $row[] = '<div align="center">'.$return_list->qty.'</div>';
				            $row[] = '<div align="center">'.$return_list->uom_cd.'</div>';
				            $row[] = '<div align="right">'.number_format($return_list->unit_price, $decimal_after).'</div>';
				            $row[] = '<div align="right">'.number_format($return_list->amount, $decimal_after).'</div>';
				            $row[] = '<div align="center">'.$return_list->purchase_receipt_number.'</div>';
				            $row[] = '<div align="center">'.$return_list->purchase_order_number.'</div>';
				            $row[] = '<div align="center">'.$return_list->cNmPegawai_create.'</div>';
				            $row[] = '<div align="center">'.$return_list->create_date.'</div>';
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_return_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_return_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_kit_assy_line_by_jobno_datatable($key_session, $JobNo){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$JobNo_get = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {

					$result_kit_assy_line = $this->m_inventoryread->list_kit_assy_line_by_jobno_datatable($company_id_session, $JobNo_get);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_kit_assy_line as $kit_assy_line_list) {

			        	$decimal_after = 2;
			        	
			            $no++;
			            $row = array();
				            $row[] = $no;
				            $row[] = $kit_assy_line_list->purchase_receipt_number;
				            $row[] = $kit_assy_line_list->part_no;
				            $row[] = $kit_assy_line_list->description;
				            $row[] = $kit_assy_line_list->qty_used;
				            $row[] = $kit_assy_line_list->uom_cd;
				            $row[] = '<div align="right">'.number_format($kit_assy_line_list->unit_price, $decimal_after).'</div>';
				            $row[] = '<div align="right">'.number_format($kit_assy_line_list->amount, $decimal_after).'</div>';
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_kit_assy_line_by_jobno_count_all($company_id_session, $JobNo_get),
			            "recordsFiltered" => $this->m_inventoryread->list_kit_assy_line_by_jobno_count_filtered($company_id_session, $JobNo_get),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_kit_assy_by_jobno_for_delivery_order_datatable($key_session, $JobNo){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$JobNo_get = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {

					$result_kit_assy = $this->m_inventoryread->list_kit_assy_by_jobno_datatable($company_id_session, $JobNo_get);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_kit_assy as $kit_assy_list) {
			        	$decimal_after = 2;			        	
			            $no++;
			            $row = array();
				            $row[] = '
			            				<input type="hidden" id="id_kit_assy_'.$no.'" value="'.$kit_assy_list->id_kit_assy.'">
			            				<input type="checkbox" style="width:25px; height:25px;" value="'.$kit_assy_list->kit_assy_number.'" id="kit_assy_number_'.$no.'" class="kit_assy_number" onclick="select_change_kit_assy('.$no.');">
			            			';
				            $row[] = $kit_assy_list->kit_assy_number;
				            $row[] = $kit_assy_list->JobNo;
				            $row[] = $kit_assy_list->JobName;
				            $row[] = '<div align="right">'.number_format($kit_assy_list->total_amount, $decimal_after).'</div>';
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_kit_assy_by_jobno_count_all($company_id_session, $JobNo_get),
			            "recordsFiltered" => $this->m_inventoryread->list_kit_assy_by_jobno_count_filtered($company_id_session, $JobNo_get),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

		public function list_kit_assy_datatable($key_session){
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

					$result_kit_assy = $this->m_inventoryread->list_kit_assy_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_kit_assy as $kit_assy_list) {

			        	$decimal_after = $kit_assy_list->decimal_after;
			        	
			            $no++;
			            $row = array();
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.$no.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.$kit_assy_list->kit_assy_number.'</div>';
				            $row[] = '<div align="center">'.$kit_assy_list->JobNo.'</div>';
				            $row[] = '<div align="center">'.$kit_assy_list->JobName.'</div>';
				            $row[] = '<div align="right">'.number_format($kit_assy_list->total_amount, 2).'</div>';
				            $row[] = '<div align="center">'.$kit_assy_list->cNmPegawai_create.'</div>';
				            $row[] = '<div align="center">'.date_format(date_create($kit_assy_list->create_date), 'd M Y H:i').'</div>';
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_kit_assy_count_all($company_id_session),
			            "recordsFiltered" => $this->m_inventoryread->list_kit_assy_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

	public function list_kit_assy_by_jobno($key_session, $JobNo){
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
				$JobNo_get = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_kit_assy_by_jobno($company_id_session, $JobNo_get);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_kit_assy' => $resultList->id_kit_assy,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'kit_assy_number' => $resultList->kit_assy_number,
							'id_job_order' => $resultList->id_job_order,
							'JobNo' => $resultList->JobNo,
							'JobName' => $resultList->JobName,
							'total_amount' => number_format($resultList->total_amount, 2),
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

	public function list_kit_assy_by_job_amount_summary($key_session, $JobNo){
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
				$JobNo_get = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_kit_assy_by_job_amount_summary($company_id_session, $JobNo_get);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'item_class_cd' => $resultList->item_class_cd,
							'item_class_name' => $resultList->item_class_name,
							'total_amount' => number_format($resultList->total_amount, 2),
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_annual_price($key_session, $category, $id_inventory){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('3');
			$category_get = $this->uri->segment('4');
			$id_inventory_get = $this->uri->segment('5');
			if ($key_session_get!=$key_session) {
				$this->load->view('login');
			}
			else {
				$JobNo_get = $this->uri->segment('4');
				$result = $this->m_inventoryread->list_annual_price($company_id_session, $category_get, $id_inventory_get);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_annual_price' => $resultList->id_annual_price,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'category' => $resultList->category,
							'id_inventory' => $resultList->id_inventory,
							'inventory_cd' => $resultList->inventory_cd,
							'inventory_name' => $resultList->inventory_name,
							'year' => $resultList->year,
							'annual_price' => $resultList->annual_price,
							'annual_price_format' => number_format($resultList->annual_price, 2),
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

	public function list_inventory_stock($key_session, $category, $id_inventory){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('3');
			$category_get = $this->uri->segment('4');
			$id_inventory_get = $this->uri->segment('5');
			if ($key_session_get!=$key_session) {
				$this->load->view('login');
			}
			else {
				if ($category_get=='cs') {
					$category = 'common_stock';
				}
				else if ($category_get=='pns') {
					$category = 'atk_stock';
				}

				$result = $this->m_inventoryread->list_inventory_stock($company_id_session, $category, $id_inventory_get);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$total_count = $resultList->total_count;
						if ($total_count==null) {
							$qty = 0;
						}
						else {
							$qty = $total_count*1;
						}

						$id_inventory = $resultList->id_inventory;

						$result_annual_price = $this->m_inventoryread->list_annual_price_by_active($company_id_session, $category_get, $id_inventory);
			        	if (count($result_annual_price) == 0) {
			        		$annual_price = 0;
			        	}
			        	else {
			        		$annual_price = ($result_annual_price[0]->annual_price)*1;
			        	}

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
							'deleted' => $resultList->deleted,
							'total_count' => $qty,
							'annual_price_count' => count($result_annual_price),
							'annual_price' => $annual_price,
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

	public function list_job_order_open($key_session){
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
				$result = $this->m_jomread->list_job_order_open($company_id_session);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'JobNo' => $resultList->JobNo,
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
		    }
		}
	}

		public function list_stock_out_datatable($key_session, $category){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$category_get = $this->uri->segment('4');
				$id_inventory_get = $this->uri->segment('5');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {

					$result_inventory = $this->m_inventoryread->list_stock_out_datatable($company_id_session, $category_get);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_inventory as $inventory_list) {
			        	$id_stock_out = $inventory_list->id_stock_out;
			        	$id_inventory = $inventory_list->id_inventory;
			        	$inventory_cd = $inventory_list->inventory_cd;
			        	$inventory_name = $inventory_list->inventory_name;
			        	$id_job_order = $inventory_list->id_job_order;
			        	$JobNo = $inventory_list->JobNo;
			        	$qty = $inventory_list->qty;
			        	$unit_price = $inventory_list->unit_price;
			        	$uom_cd = $inventory_list->uom_cd;
			        	$unit_price = $inventory_list->unit_price;
			        	$amount = $inventory_list->amount;
			        	$cNmPegawai_create = $inventory_list->cNmPegawai_create;

			        	if ($id_job_order*1 == 0) {
			        		$JobNo_show = 'Non Job';
			        	}
			        	else {
			        		$JobNo_show = $JobNo;
			        	}

			        	$row = array();

			            $no++;

			            if ($category_get=='pns') {
			        		$result_uom_convert = $this->m_inventoryread->list_uom_converter($company_id_session, $id_inventory);
			        		if(count($result_uom_convert) == 0){
			        			$td_uom = '<div align="center" id="uom_cd_'.$no.'" onClick="modal_uom_converter('."'$id_inventory'".', '."'$inventory_name'".', '."'$uom_cd'".', '."'$no'".');">'.$uom_cd.'</div>';
			        		}
			        		else {
			        			$uom_cd_convert = $result_uom_convert[0]->uom_cd_convert;
			        			$td_uom = '<div align="center" id="uom_cd_'.$no.'" onClick="modal_uom_converter('."'$id_inventory'".', '."'$inventory_name'".', '."'$uom_cd'".', '."'$no'".');">'.$uom_cd_convert.'</div>';
			        		}
			        	}
			        	else {
			        		$td_uom = '<div align="center">'.$uom_cd.'</div>';
			        	}
			            
			            $row[] = $no;
			            $row[] = '<div id="cNmPegawai_create_'.$no.'">'.$cNmPegawai_create.'</div>';
			            $row[] = '<div id="inventory_cd_'.$no.'">'.$inventory_cd.'</div>';
			            $row[] = '<div id="inventory_name_'.$no.'">'.$inventory_name.'</div>';
			            $row[] = '<div id="id_item_class_'.$no.'">'.$JobNo_show.'</div>';
			            $row[] = '<div align="right" style="padding-right:13px;">'.$qty.'</div>';
			            $row[] = $td_uom;
			            $row[] = '<div align="right" style="padding-right:13px;">'.(number_format($unit_price, 2)).'</div>';
			            $row[] = '<div align="right" style="padding-right:13px;">'.(number_format($amount, 2)).'</div>';
			            $row[] = '<div align="center"><button class="btn btn-md btn-danger" onClick="remove_stock_out('."'$no'".', '."'$id_stock_out'".', '."'$id_inventory'".', '."'$inventory_name'".', '."'$qty'".');"><i class="mdi mdi-delete-forever"></i></button></div>';
			 
			        	$data[] = $row;
			        					        
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_inventoryread->list_stock_out_count_all($company_id_session, $category_get),
			            "recordsFiltered" => $this->m_inventoryread->list_stock_out_count_filtered($company_id_session, $category_get),
			            "data" => $data,
			        );
			        echo json_encode($output);
			    }
			}
		}

	public function list_uom_converter($key_session, $category, $id_inventory){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('3');
			$category_get = $this->uri->segment('4');
			$id_inventory_get = $this->uri->segment('5');
			if ($key_session_get!=$key_session) {
				$this->load->view('login');
			}
			else {
				$result = $this->m_inventoryread->list_uom_converter($company_id_session, $id_inventory_get);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_uom_converter' => $resultList->id_uom_converter,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_inventory' => $resultList->id_inventory,
							'inventory_cd' => $resultList->inventory_cd,
							'inventory_name' => $resultList->inventory_name,
							'id_uom' => $resultList->id_uom,
							'uom_cd' => $resultList->uom_cd,
							'uom_name' => $resultList->uom_name,
							'id_uom_convert' => $resultList->id_uom_convert,
							'uom_cd_convert' => $resultList->uom_cd_convert,
							'uom_name_convert' => $resultList->uom_name_convert,
							'number_convert' => $resultList->number_convert,
							'create_by' => $resultList->create_by,
							'cNmPegawai_create' => $resultList->cNmPegawai_create,
							'create_date' => $resultList->create_date,
							'last_by' => $resultList->last_by,
							'cNmPegawai_last' => $resultList->cNmPegawai_last,
							'last_update' => $resultList->last_update
						);
						array_push($data_array, $data);
					}					
				}		

				$data_uom_array = array();
				$result_uom = $this->m_inventoryread->list_uom($company_id_session, 0);

				foreach ($result_uom as $resultList){
					$data_uom = array(
						'id_uom' => $resultList->id_uom,
						'company_id' => $resultList->company_id,
						'company_name' => $resultList->company_name,
						'uom_cd' => $resultList->uom_cd,
						'uom_name' => $resultList->uom_name,
						'create_by' => $resultList->create_by,
						'cNmPegawai_create' => $resultList->cNmPegawai_create,
						'create_date' => $resultList->create_date,
						'last_by' => $resultList->last_by,
						'cNmPegawai_last' => $resultList->cNmPegawai_last,
						'last_update' => $resultList->last_update,
						'deleted' => $resultList->deleted,
					);
					array_push($data_uom_array, $data_uom);
				}					
							
				echo json_encode(array(array('status' => $status, 'response' => $data_array, 'data_uom' => $data_uom_array)));
		    }
		}
	}
}