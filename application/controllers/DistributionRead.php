<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class DistributionRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_distributionread');
        $this->load->model('m_jomread');
	}

	public function index(){
		$this->load->view('login');
	}

	// Distribution
	// Setting

	public function list_module_category($key_session, $id_module_category){
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
				$id_module_category = $this->uri->segment('4');
				$result = $this->m_distributionread->list_module_category($company_id_session, $id_module_category);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_module_category' => $resultList->id_module_category,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'module_category_cd' => $resultList->module_category_cd,
							'module_category_name' => $resultList->module_category_name,
							'ar_ap' => $resultList->ar_ap,
							'ar_ap_lower' => strtolower($resultList->ar_ap),
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

	public function list_module($key_session, $id_module){
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
				$id_module = $this->uri->segment('4');
				$result = $this->m_distributionread->list_module($company_id_session, $id_module);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_module' => $resultList->id_module,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'id_module_category' => $resultList->id_module_category,
							'module_category_cd' => $resultList->module_category_cd,
							'module_category_name' => $resultList->module_category_name,
							'module_cd' => $resultList->module_cd,
							'module_name' => $resultList->module_name,
							'file_name' => $resultList->file_name,
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

	public function list_numbering_sequence($key_session, $id_module){
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
				$id_module = $this->uri->segment('4');
				$result = $this->m_distributionread->list_numbering_sequence($company_id_session, $id_module);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					array_push($data_array, $result);				
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_employee_permission($key_session, $id_module){
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
				$id_module = $this->uri->segment('4');
				$result = $this->m_distributionread->list_employee_permission($company_id_session, $id_module);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					array_push($data_array, $result);				
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_approval_permission($key_session, $id_module){
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
				$id_module = $this->uri->segment('4');
				$result = $this->m_distributionread->list_approval_permission($company_id_session, $id_module);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_approval_permission' => $resultList->id_approval_permission,
							'cNmPegawai' => $resultList->cNmPegawai,
						);
						array_push($data_array, $data);				
					}
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_approval_permission_datatable($key_session, $id_module){
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
				$id_module = $this->uri->segment('4');
				$result = $this->m_distributionread->list_approval_permission_datatable($company_id_session, $id_module);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result as $employee_list) {
		            $no++;
		            $row = array();
		            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$employee_list->cNmPegawai.'" id="cNmPegawai_'.$no.'" class="employee_cd" onclick="select_change_employee('.$no.');">';
		            $row[] = $employee_list->cNIK;
		            $row[] = $employee_list->cNmPegawai;
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_distributionread->list_approval_permission_count_all($company_id_session, $id_module),
		            "recordsFiltered" => $this->m_distributionread->list_approval_permission_count_filtered($company_id_session, $id_module),
		            "data" => $data,
		        );
		        echo json_encode($output);
			}
		}
	}

	public function list_employee_datatable($key_session, $id_employee){

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

				$result_employee = $this->m_distributionread->list_employee_datatable($company_id_session);
		        $data = array();
		        $no = $_POST['start'];
		        foreach ($result_employee as $employee_list) {
		            $no++;
		            $row = array();
		            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$employee_list->cNmPegawai.'" id="cNmPegawai_'.$no.'" class="employee_cd" onclick="select_change_employee('.$no.');">';
		            $row[] = $employee_list->cNIK;
		            $row[] = $employee_list->cNmPegawai;
		 
		            $data[] = $row;
		        }
		 
		        $output = array(
		            "draw" => $_POST['draw'],
		            "recordsTotal" => $this->m_distributionread->list_employee_count_all($company_id_session),
		            "recordsFiltered" => $this->m_distributionread->list_employee_count_filtered($company_id_session),
		            "data" => $data,
		        );
		        echo json_encode($output);
		    }
		}
	}

	public function list_module_category_menu($key_session, $id_module_category){
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
				$id_module_category = $this->uri->segment('4');
				$result = $this->m_distributionread->list_module_category($company_id_session, $id_module_category);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$id_module_category = $resultList->id_module_category;
						$result_module = $this->m_distributionread->list_module_category_by_module_category_id($company_id_session, $id_module_category);

						$data_line_array = array();
						foreach ($result_module as $resultListModule){
							$data_line = array (
								'module_cd' => $resultListModule->module_cd,
								'module_name' => $resultListModule->module_name,
								'file_name' => $resultListModule->file_name,
							);
							array_push ($data_line_array, $data_line);
						}

						$data = array(
							'module_category_cd' => $resultList->module_category_cd,
							'module_category_name' => $resultList->module_category_name,
							'data_line_array' => $data_line_array
						);
						array_push($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_transaction_role($key_session, $id_module){
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
				$id_module = $this->uri->segment('4');
				$result = $this->m_distributionread->list_transaction_role($company_id_session, $id_module);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_transaction_role' => $resultList->id_transaction_role,
							'sequence' => $resultList->sequence,
							'transaction_name' => $resultList->transaction_name,
							'write' => $resultList->write,
							'email_approval' => $resultList->email_approval,
							'email_vendor' => $resultList->email_vendor,
							'close_transaction' => $resultList->close_transaction,
						);
						array_push ($data_array, $data);
					}			
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_payment_methode($key_session, $id_module){
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
				$id_payment_methode = $this->uri->segment('4');
				$result = $this->m_distributionread->list_payment_methode($company_id_session, $id_payment_methode);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_payment_methode' => $resultList->id_payment_methode,
							'category' => $resultList->category,
							'category_format' => ucfirst($resultList->category),
							'payment_methode_cd' => $resultList->payment_methode_cd,
							'payment_methode_name' => $resultList->payment_methode_name,
							'deleted' => $resultList->deleted,
						);
						array_push ($data_array, $data);
					}			
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_payment_terms($key_session, $id_payment_terms){
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
				$id_payment_terms = $this->uri->segment('4');
				$result = $this->m_distributionread->list_payment_terms($company_id_session, $id_payment_terms);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$data = array(
							'id_payment_terms' => $resultList->id_payment_terms,
							'payment_terms_cd' => $resultList->payment_terms_cd,
							'payment_terms_name' => $resultList->payment_terms_name,
							'deleted' => $resultList->deleted,
						);
						array_push ($data_array, $data);
					}			
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	// Input

	// Purchase

	// Requisitions

		public function purchase_requisitions_line_blank($key_session, $transaction_number){
			error_reporting(0);
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
					
					$data = array();
			        $no = 1;

			        $purchase_requisitions_number_get = $this->uri->segment('4');
			        $purchase_requisitions_number_header = str_replace('ZZ', '/', $purchase_requisitions_number_get);

			        if ($purchase_requisitions_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {
						$result_purchase_requisitions_line = $this->m_distributionread->list_purchase_requisitions_line_by_purchase_requisitions_number($company_id_session, $purchase_requisitions_number_header);
						$value_count = count($result_purchase_requisitions_line);

						$aa=1;

						foreach ($result_purchase_requisitions_line as $resultListLine){
							$id_purchase_requisitions_line = $resultListLine->id_purchase_requisitions_line;
							$company_id = $resultListLine->company_id;
							$purchase_requisitions_number = $resultListLine->purchase_requisitions_number;
							//$purchase_requisitions_number_format = str_replace('ZZ', '-', $purchase_requisitions_number);
							$line_number = $resultListLine->line_number;
							$id_inventory = $resultListLine->id_inventory;
							$inventory_cd = $resultListLine->inventory_cd;
							$description = $resultListLine->description;
							$id_part_list = $resultListLine->id_part_list;
							$part_no = $resultListLine->part_no;
							$part_name = $resultListLine->part_name;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$purchase_requisitions_line_qty = ($resultListLine->purchase_requisitions_line_qty)*1;
							//$purchase_requisitions_line_qty_purchase_receipt = ($resultListLine->purchase_requisitions_line_qty_purchase_receipt)*1;
							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;
							$cury_unit_price = ($resultListLine->cury_unit_price)*1;
							$unit_price = ($resultListLine->unit_price)*1;
							$cury_sub_amount = ($resultListLine->cury_sub_amount)*1;
							$sub_amount = ($resultListLine->sub_amount)*1;
							$cury_discount_amount = ($resultListLine->cury_discount_amount)*1;
							$discount_amount = ($resultListLine->discount_amount)*1;
							$discount_percent = ($resultListLine->discount_percent)*1;
							$cury_amount = ($resultListLine->cury_amount)*1;
							$amount = ($resultListLine->amount)*1;
							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$id_warehouse = $resultListLine->id_warehouse;
							$warehouse_cd = $resultListLine->warehouse_cd;
							$warehouse_name = $resultListLine->warehouse_name;
							$id_item_class = $resultListLine->id_item_class;
							$item_class_cd = $resultListLine->item_class_cd;
							$item_class_name = $resultListLine->item_class_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$last_update = $resultListLine->last_update;

							$row = array();
					            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_requisitions_line_'.$aa.'" value="'.$id_purchase_requisitions_line.'"><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$aa.'" value="'.$id_inventory.'"><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$aa.'" value="'.$id_part_list.'"><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$aa.'"  placeholder="Inventory ID" value="'.$inventory_cd.'"></div>';
					            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2; width:100%;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$aa.'" placeholder="Inventory Name" value="'.$description.'"style="width:100%;"></div>';
					            $row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$aa.'" placeholder="Job" value="'.$JobNo.'" readonly></div>'; // Job
					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_requisitions_line_'.$aa.'" placeholder="Qty Order" value="'.$purchase_requisitions_line_qty.'" ></div>'; // Qty order
					            //$row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$aa.'" placeholder="Qty Receipt" value="'.$purchase_requisitions_line_qty_purchase_receipt.'" readonly></div>'; // Qty Receipt
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" onclick="list_uom('.$aa.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price.'" placeholder="Unit Price" ></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" value="'.$sub_amount.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$aa.'" value="'.$discount_amount.'" placeholder="Discount Amount" ></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'" placeholder="Discount Percent" ></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" value="'.$amount.'" readonly></div>';
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" readonly value="'.$sub_tax_cd.'"></div>'; // Tax Category
					             $row[] = '<div id="div_line_17_'.($no).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button>
					            <input type="hidden" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$aa.'" placeholder="Item Class" readonly onClick="list_item_class('.$aa.');" value="'.$item_class_cd.'">
					            <input type="hidden" class="bottom_border_only coa_cd" id="coa_cd_line_'.$aa.'" placeholder="Account" onClick="list_coa('.$aa.');" value="'.$coa_cd.'" readonly>
					            <input type="hidden" class="bottom_border_only" id="coa_name_line_'.$aa.'" placeholder="Description" value="'.$coa_name.'" readonly>
					            <input type="hidden" class="bottom_border_only" id="warehouse_name_line_'.$aa.'" placeholder="Warehouse" value="'.$warehouse_name.'" onClick="list_warehouse('.$aa.');" readonly>
					            </div>'; // Delete*/
				            $data[] = $row;

				            $aa++;
						}
					}

					$total_line = 100;
					for ($a=($value_count+1); $a<=$total_line; $a++){
						$no++;
						if ($a==($value_count+1)) {
							$row = array();
					            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_requisitions_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$a.'" value=""><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$a.'" onClick="list_inventory('.$a.')" placeholder="Inventory ID"></div>';
					            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2; width:100%;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$a.'" placeholder="Inventory Name" style="width:100%;"></div>';
					            $row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$a.'" placeholder="Job" readonly></div>'; // Job
					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_requisitions_line_'.$a.'" placeholder="Qty Order" onChange="price_calculation('.$a.');"></div>'; // Qty order
					            //$row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$a.'" placeholder="Qty Receipt" readonly></div>'; // Qty Receipt
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$a.'" placeholder="UOM" onclick="list_uom('.$a.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$a.'" placeholder="Unit Price" onChange="price_calculation('.$a.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$a.'" placeholder="Discount Amount" onChange="price_calculation('.$a.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$a.'" placeholder="Discount Percent" onChange="price_calculation('.$a.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$a.'" placeholder="Tax Category" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_17_'.($no).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$a.');"><i class="mdi mdi-delete-forever"></i></button>

					            <input type="hidden" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$a.'" placeholder="Item Class" readonly onClick="list_item_class('.$a.');">
					            <input type="hidden" class="bottom_border_only coa_cd" id="coa_cd_line_'.$a.'" placeholder="Account" onClick="list_coa('.$a.');" readonly>
					            <input type="hidden" class="bottom_border_only" id="coa_name_line_'.$a.'" placeholder="Description" readonly>
					            <input type="hidden" class="bottom_border_only" id="warehouse_name_line_'.$a.'" placeholder="Warehouse" onClick="list_warehouse('.$a.');" readonly></div>'; // Warehouse
					            // DELETE 
				            $data[] = $row;
						}
						else {
				            $row = array();
					            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_requisitions_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$a.'" value=""><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$a.'" onClick="list_inventory('.$a.')" placeholder="Inventory ID"></div>';
					            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$a.'" placeholder="Inventory Name" style="width:100%;"></div>';
					            $row[] = '<div id="div_line_1_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$a.'" placeholder="Job" readonly></div>'; // Job
					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_requisitions_line_'.$a.'" placeholder="Qty Order" onChange="price_calculation('.$a.');"></div>'; // Qty order
					            //$row[] = '<div id="div_line_5_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$a.'" placeholder="Qty Receipt" readonly></div>'; // Qty Receipt
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$a.'" placeholder="UOM" onclick="list_uom('.$a.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$a.'" placeholder="Unit Price" onChange="price_calculation('.$a.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$a.'" placeholder="Discount Amount" onChange="price_calculation('.$a.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$a.'" placeholder="Discount Percent" onChange="price_calculation('.$a.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$a.'" placeholder="Tax Category" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_17_'.($no).'" style="height:45px; display:none; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$a.');"><i class="mdi mdi-delete-forever"></i></button>
					            <input type="hidden" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$a.'" placeholder="Item Class" readonly onClick="list_item_class('.$a.');">
					            <input type="hidden" class="bottom_border_only coa_cd" id="coa_cd_line_'.$a.'" placeholder="Account" onClick="list_coa('.$a.');" readonly>
					            <input type="hidden" class="bottom_border_only" id="coa_name_line_'.$a.'" placeholder="Description" readonly>
					            <input type="hidden" class="bottom_border_only" id="warehouse_name_line_'.$a.'" placeholder="Warehouse" onClick="list_warehouse('.$a.');" readonly></div>'; 
					            // Warehouse
				            $data[] = $row;						
						}
					}
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $total_line,
			            "recordsFiltered" => $total_line,
			            //"purchase_requisitions_number" => $purchase_requisitions_number_get.' '.$purchase_requisitions_number_header,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_requisitions_select_datatable($key_session){
			error_reporting(0);
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
					$result_purchase_requisitions = $this->m_distributionread->list_purchase_requisitions_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_requisitions as $purchase_requisitions_list) {
			        	$decimal_after = $purchase_requisitions_list->decimal_after;
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_requisitions_list->id_purchase_requisitions.' // '.$purchase_requisitions_list->purchase_requisitions_number.'" id="purchase_requisitions_number_'.$no.'" class="purchase_requisitions_number" onclick="select_change_purchase_requisitions('.$no.');">';
			            $row[] = $purchase_requisitions_list->purchase_requisitions_number;
			            $row[] = $purchase_requisitions_list->account_name;
			            $row[] = date_format(date_create($purchase_requisitions_list->purchase_requisitions_date), 'd M Y');
			            $row[] = number_format($purchase_requisitions_list->total_amount, $decimal_after);
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_requisitions_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_requisitions_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_requisitions_by_purchase_requisitions_number($key_session){
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
					$this->form_validation->set_rules('purchase_requisitions_number', 'purchase_requisitions_number', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$purchase_requisitions_number = $this->input->post('purchase_requisitions_number');
						$result_purchase_order = $this->m_distributionread->list_purchase_requisitions_by_purchase_requisitions_number($company_id_session, $purchase_requisitions_number);
						$data_array = array();
						if (count($result_purchase_order)==0) {
							$status = 0;
						}
						else {
							$status = 1;

							$result_purchase_requisitions_line = $this->m_distributionread->list_purchase_requisitions_line_by_purchase_requisitions_number($company_id_session, $purchase_requisitions_number);

							foreach ($result_purchase_order as $resultList) {
								$decimal_after = $resultList->decimal_after;
								$id_transaction_role = $resultList->id_transaction_role;
								if ($id_transaction_role==1) {
									$transaction_name = "Hold";
								}
								else if ($id_transaction_role==2) {
									$transaction_name = "Open";
								}
								else if ($id_transaction_role==3) {
									$transaction_name = "Purchase Order";
								}
								
								$data = array (
									'id_purchase_requisitions' => $resultList->id_purchase_requisitions,
									'company_id' => $resultList->company_id,
									'company_name' => $resultList->company_name,
									'purchase_requisitions_number' => $resultList->purchase_requisitions_number,
									'purchase_requisitions_number_format' => str_replace('/', 'ZZ', $resultList->purchase_requisitions_number),
									'hold' => $resultList->hold,
									'id_transaction_role' => $id_transaction_role,
									'transaction_name' => $transaction_name,
									'id_account' => $resultList->id_account,
									'account_cd' => $resultList->account_cd,
									'account_name' => $resultList->account_name,
									'main_address' => $resultList->main_address,
									'city' => $resultList->city,
									'postal_code' => $resultList->postal_code,
									'phone_1' => $resultList->phone_1,
									'fax' => $resultList->fax,
									'attn' => $resultList->attn,
									'year' => $resultList->year,
									'periode' => $resultList->periode,
									'purchase_requisitions_date' => $resultList->purchase_requisitions_date,
									'id_coa_currency' => $resultList->id_coa_currency,
									'coa_currency_cd' => $resultList->coa_currency_cd,
									'coa_currency_name' => $resultList->coa_currency_name,
									'rate' =>  ($resultList->rate)*1,
									'rate_format' => number_format((($resultList->rate)*1), $decimal_after),
									'total_line' => $resultList->total_line,
									'total_qty' => ($resultList->total_qty)*1,
									'cury_sub_amount' => ($resultList->cury_sub_amount)*1,
									'sub_amount' => ($resultList->sub_amount)*1,
									'cury_discount_amount' => ($resultList->cury_discount_amount)*1,
									'discount_amount' => ($resultList->discount_amount)*1,
									'cury_amount' => ($resultList->cury_amount)*1,
									'amount' => ($resultList->amount)*1,
									'ppn' => ($resultList->ppn)*1,
									'pph' => ($resultList->pph)*1,
									'cury_total_amount' => ($resultList->cury_total_amount)*1,
									'total_amount' => ($resultList->total_amount)*1,
									'note' => $resultList->note,
									'create_by' => $resultList->create_by,
									'account_name_create' => $resultList->account_name_create,
									'cNmPegawai_create' => $resultList->cNmPegawai_create,
									'create_date' => $resultList->create_date,
									'last_by' => $resultList->last_by,
									'account_name_last' => $resultList->account_name_last,
									'cNmPegawai_last' => $resultList->cNmPegawai_last,
									'last_update' => $resultList->last_update,
									'deleted' => $resultList->deleted,
									'responseLine' => count($result_purchase_requisitions_line)
								);
								array_push ($data_array, $data);
							}
						}
					}
					echo json_encode (array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}

	// PO

		public function purchase_order_line_blank($key_session, $transaction_number){
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
					
					$data = array();

			        //$no = $_POST['start'];

			        $purchase_order_number_get = $this->uri->segment('4');
			        $purchase_order_number_header = str_replace('ZZ', '/', $purchase_order_number_get);
			        $check_po = substr($purchase_order_number_header, 0, 2);

			        if ($purchase_order_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {

			        	if ($check_po == "PO") {
			        		// code...

			        		$result_purchase_order_line = $this->m_distributionread->list_purchase_order_line_by_purchase_order_number($company_id_session, $purchase_order_number_header);
							$value_count = count($result_purchase_order_line);

							$aa=1;

							foreach ($result_purchase_order_line as $resultListLine){
								$id_purchase_order_line = $resultListLine->id_purchase_order_line;
								$company_id = $resultListLine->company_id;
								$purchase_order_number = $resultListLine->purchase_order_number;
								//$purchase_order_number_format = str_replace('ZZ', '-', $purchase_order_number);
								$line_number = $resultListLine->line_number;
								$id_inventory = $resultListLine->id_inventory;
								$inventory_cd = $resultListLine->inventory_cd;
								$description = $resultListLine->description;
								$id_part_list = $resultListLine->id_part_list;
								$part_no = $resultListLine->part_no;
								$part_name = $resultListLine->part_name;
								$id_job_order = $resultListLine->id_job_order;
								$JobNo = $resultListLine->JobNo;
								$purchase_order_line_qty = ($resultListLine->purchase_order_line_qty)*1;
								$purchase_order_line_qty_purchase_receipt = ($resultListLine->purchase_order_line_qty_purchase_receipt)*1;
								$id_uom = $resultListLine->id_uom;
								$uom_cd = $resultListLine->uom_cd;
								$uom_name = $resultListLine->uom_name;
								$cury_unit_price = ($resultListLine->cury_unit_price)*1;
								$unit_price = ($resultListLine->unit_price)*1;
								$cury_sub_amount = ($resultListLine->cury_sub_amount)*1;
								$sub_amount = ($resultListLine->sub_amount)*1;
								$cury_discount_amount = ($resultListLine->cury_discount_amount)*1;
								$discount_amount = ($resultListLine->discount_amount)*1;
								$discount_percent = ($resultListLine->discount_percent)*1;
								$cury_amount = ($resultListLine->cury_amount)*1;
								$amount = ($resultListLine->amount)*1;
								$id_sub_tax = $resultListLine->id_sub_tax;
								$sub_tax_cd = $resultListLine->sub_tax_cd;
								$sub_tax_name = $resultListLine->sub_tax_name;
								$id_coa = $resultListLine->id_coa;
								$coa_cd = $resultListLine->coa_cd;
								$coa_name = $resultListLine->coa_name;
								$id_warehouse = $resultListLine->id_warehouse;
								$warehouse_cd = $resultListLine->warehouse_cd;
								$warehouse_name = $resultListLine->warehouse_name;
								$id_item_class = $resultListLine->id_item_class;
								$item_class_cd = $resultListLine->item_class_cd;
								$item_class_name = $resultListLine->item_class_name;
								$line_status = $resultListLine->line_status;
								$create_by = $resultListLine->create_by;
								$create_date = $resultListLine->create_date;
								$last_by = $resultListLine->last_by;
								$last_update = $resultListLine->last_update;

								$row = array();
						            $row[] = '<div id="div_line_2_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_order_line_'.$aa.'" value="'.$id_purchase_order_line.'"><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$aa.'" value="'.$id_inventory.'"><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$aa.'" value="'.$id_part_list.'"><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$aa.'" onClick="list_inventory('.$aa.')" placeholder="Inventory ID" value="'.$inventory_cd.'"></div>';
						            $row[] = '<div id="div_line_3_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$aa.'" placeholder="Inventory Name" value="'.$description.'"></div>';
						            $row[] = '<div id="div_line_1_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$aa.'" placeholder="Job" value="'.$JobNo.'" readonly></div>'; // Job
						            $row[] = '<div id="div_line_4_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" value="'.$purchase_order_line_qty.'" onChange="price_calculation('.$aa.');"></div>'; // Qty order
						            $row[] = '<div id="div_line_5_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$aa.'" placeholder="Qty Receipt" value="'.$purchase_order_line_qty_purchase_receipt.'" readonly></div>'; // Qty Receipt
						            $row[] = '<div id="div_line_6_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" onclick="list_uom('.$aa.');"></div>'; // UOM
						            $row[] = '<div id="div_line_7_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price.'" placeholder="Unit Price" onChange="price_calculation('.$aa.');"></div>'; // Unit Price
						            $row[] = '<div id="div_line_8_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" value="'.$sub_amount.'" placeholder="Line Amount" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_9_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$aa.'" value="'.$discount_amount.'" placeholder="Discount Amount" onChange="price_calculation('.$aa.');"></div>'; // Discount Amount
						            $row[] = '<div id="div_line_10_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'" placeholder="Discount Percent" onChange="price_calculation('.$aa.');"></div>'; // Discount Percent
						            $row[] = '<div id="div_line_11_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" value="'.$amount.'" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_12_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" onClick="list_sub_tax('.$aa.');" value="'.$sub_tax_cd.'" readonly></div>'; // Tax Category
						            $row[] = '<div id="div_line_13_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$aa.'" placeholder="Item Class" readonly onClick="list_item_class('.$aa.');" value="'.$item_class_cd.'"></div>'; // Account
						            $row[] = '<div id="div_line_14_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$aa.'" placeholder="Account" onClick="list_coa('.$aa.');" value="'.$coa_cd.'" readonly></div>'; // Account
						            $row[] = '<div id="div_line_15_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$aa.'" placeholder="Description" value="'.$coa_name.'" readonly></div>'; // Description
						            $row[] = '<div id="div_line_16_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$aa.'" placeholder="Warehouse" value="'.$warehouse_name.'" onClick="list_warehouse('.$a.');" readonly></div>'; // Warehouse
					            	$row[] = '<div id="div_line_17_'.($aa).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
					            $data[] = $row;

					            $aa++;
							}
			        	}
			        	else {
			        		$result_purchase_order_line = $this->m_distributionread->list_purchase_requisitions_line_by_purchase_requisitions_number($company_id_session, $purchase_order_number_header);
							$value_count = count($result_purchase_order_line);

							$aa=1;

							foreach ($result_purchase_order_line as $resultListLine){
								$id_purchase_order_line = '';
								$company_id = $resultListLine->company_id;
								$purchase_order_number = '';
								$line_number = $resultListLine->line_number;
								$id_inventory = $resultListLine->id_inventory;
								$inventory_cd = $resultListLine->inventory_cd;
								$description = $resultListLine->description;
								$id_part_list = $resultListLine->id_part_list;
								$part_no = $resultListLine->part_no;
								$part_name = $resultListLine->part_name;
								$id_job_order = $resultListLine->id_job_order;
								$JobNo = $resultListLine->JobNo;
								$purchase_order_line_qty = ($resultListLine->purchase_requisitions_line_qty)*1;
								$purchase_order_line_qty_purchase_receipt = 0;
								$id_uom = $resultListLine->id_uom;
								$uom_cd = $resultListLine->uom_cd;
								$uom_name = $resultListLine->uom_name;
								$cury_unit_price = ($resultListLine->cury_unit_price)*1;
								$unit_price = ($resultListLine->unit_price)*1;
								$cury_sub_amount = ($resultListLine->cury_sub_amount)*1;
								$sub_amount = ($resultListLine->sub_amount)*1;
								$cury_discount_amount = ($resultListLine->cury_discount_amount)*1;
								$discount_amount = ($resultListLine->discount_amount)*1;
								$discount_percent = ($resultListLine->discount_percent)*1;
								$cury_amount = ($resultListLine->cury_amount)*1;
								$amount = ($resultListLine->amount)*1;
								$id_sub_tax = $resultListLine->id_sub_tax;
								$sub_tax_cd = $resultListLine->sub_tax_cd;
								$sub_tax_name = $resultListLine->sub_tax_name;
								$id_coa = $resultListLine->id_coa;
								$coa_cd = $resultListLine->coa_cd;
								$coa_name = $resultListLine->coa_name;
								$id_warehouse = $resultListLine->id_warehouse;
								$warehouse_cd = $resultListLine->warehouse_cd;
								$warehouse_name = $resultListLine->warehouse_name;
								$id_item_class = $resultListLine->id_item_class;
								$item_class_cd = $resultListLine->item_class_cd;
								$item_class_name = $resultListLine->item_class_name;
								$line_status = $resultListLine->line_status;
								$create_by = $resultListLine->create_by;
								$create_date = $resultListLine->create_date;
								$last_by = $resultListLine->last_by;
								$last_update = $resultListLine->last_update;

								$row = array();
						            $row[] = '<div id="div_line_2_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_order_line_'.$aa.'" value="'.$id_purchase_order_line.'"><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$aa.'" value="'.$id_inventory.'"><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$aa.'" value="'.$id_part_list.'"><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$aa.'" onClick="list_inventory('.$aa.')" placeholder="Inventory ID" value="'.$inventory_cd.'"></div>';
						            $row[] = '<div id="div_line_3_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$aa.'" placeholder="Inventory Name" value="'.$description.'"></div>';
						            $row[] = '<div id="div_line_1_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$aa.'" placeholder="Job" value="'.$JobNo.'" readonly></div>'; // Job
						            $row[] = '<div id="div_line_4_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" value="'.$purchase_order_line_qty.'" onChange="price_calculation('.$aa.');"></div>'; // Qty order
						            $row[] = '<div id="div_line_5_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$aa.'" placeholder="Qty Receipt" value="'.$purchase_order_line_qty_purchase_receipt.'" readonly></div>'; // Qty Receipt
						            $row[] = '<div id="div_line_6_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" onclick="list_uom('.$aa.');"></div>'; // UOM
						            $row[] = '<div id="div_line_7_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price.'" placeholder="Unit Price" onChange="price_calculation('.$aa.');"></div>'; // Unit Price
						            $row[] = '<div id="div_line_8_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" value="'.$sub_amount.'" placeholder="Line Amount" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_9_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$aa.'" value="'.$discount_amount.'" placeholder="Discount Amount" onChange="price_calculation('.$aa.');"></div>'; // Discount Amount
						            $row[] = '<div id="div_line_10_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'" placeholder="Discount Percent" onChange="price_calculation('.$aa.');"></div>'; // Discount Percent
						            $row[] = '<div id="div_line_11_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" value="'.$amount.'" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_12_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" onClick="list_sub_tax('.$aa.');" value="'.$sub_tax_cd.'" readonly></div>'; // Tax Category
						            $row[] = '<div id="div_line_13_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$aa.'" placeholder="Item Class" readonly onClick="list_item_class('.$aa.');" value="'.$item_class_cd.'"></div>'; // Account
						            $row[] = '<div id="div_line_14_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$aa.'" placeholder="Account" onClick="list_coa('.$aa.');" value="'.$coa_cd.'" readonly></div>'; // Account
						            $row[] = '<div id="div_line_15_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$aa.'" placeholder="Description" value="'.$coa_name.'" readonly></div>'; // Description
						            $row[] = '<div id="div_line_16_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$aa.'" placeholder="Warehouse" value="'.$warehouse_name.'" onClick="list_warehouse('.$a.');" readonly></div>'; // Warehouse
					            	$row[] = '<div id="div_line_17_'.($aa).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
					            $data[] = $row;

					            $aa++;
							}
			        	}
						
					}

					$total_line = 100;
					for ($a=($value_count+1); $a<=$total_line; $a++){
						$no++;
						if ($a==($value_count+1)) {
							$row = array();
					            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_order_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$a.'" value=""><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$a.'" onClick="list_inventory('.$a.')" placeholder="Inventory ID"></div>';
					            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$a.'" placeholder="Inventory Name"></div>';
					            $row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$a.'" placeholder="Job" readonly></div>'; // Job
					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$a.'" placeholder="Qty Order" onChange="price_calculation('.$a.');"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$a.'" placeholder="Qty Receipt" readonly></div>'; // Qty Receipt
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$a.'" placeholder="UOM" onclick="list_uom('.$a.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$a.'" placeholder="Unit Price" onChange="price_calculation('.$a.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$a.'" placeholder="Discount Amount" onChange="price_calculation('.$a.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$a.'" placeholder="Discount Percent" onChange="price_calculation('.$a.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$a.'" placeholder="Tax Category" onClick="list_sub_tax('.$a.');" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_13_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$a.'" placeholder="Item Class" readonly onClick="list_item_class('.$a.');"></div>'; // Account
					            $row[] = '<div id="div_line_14_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$a.'" placeholder="Account" onClick="list_coa('.$a.');" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$a.'" placeholder="Description" readonly></div>'; // Description
					            $row[] = '<div id="div_line_16_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$a.'" placeholder="Warehouse" onClick="list_warehouse('.$a.');" readonly></div>'; // Warehouse
				            	$row[] = '<div id="div_line_17_'.($no).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$a.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;
						}
						else {
				            $row = array();
					            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_order_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$a.'" value=""><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$a.'" value=""><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$a.'" onClick="list_inventory('.$a.')" placeholder="Inventory ID"></div>';
					            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$a.'" placeholder="Inventory Name"></div>';
					            $row[] = '<div id="div_line_1_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$a.'" placeholder="Job" readonly></div>'; // Job
					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$a.'" placeholder="Qty Order" onChange="price_calculation('.$a.');"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$a.'" placeholder="Qty Receipt" readonly></div>'; // Qty Receipt
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$a.'" placeholder="UOM" onclick="list_uom('.$a.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$a.'" placeholder="Unit Price" onChange="price_calculation('.$a.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$a.'" placeholder="Discount Amount" onChange="price_calculation('.$a.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$a.'" placeholder="Discount Percent" onChange="price_calculation('.$a.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$a.'" placeholder="Tax Category" onClick="list_sub_tax('.$a.');" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_13_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$a.'" placeholder="Item Class" readonly onClick="list_item_class('.$a.');"></div>'; // Account
					            $row[] = '<div id="div_line_14_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$a.'" placeholder="Account" onClick="list_coa('.$a.');" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$a.'" placeholder="Description" readonly></div>'; // Description
					            $row[] = '<div id="div_line_16_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$a.'" placeholder="Warehouse" onClick="list_warehouse('.$a.');" readonly></div>'; // Warehouse
					            $row[] = '<div id="div_line_17_'.($no).'" style="height:45px; display:none; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$a.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;						
						}
					}
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $total_line,
			            "recordsFiltered" => $total_line,
			            //"purchase_order_number" => $purchase_order_number_get.' '.$purchase_order_number_header,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_order_select_datatable($key_session){
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
					$result_purchase_order = $this->m_distributionread->list_purchase_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_order as $purchase_order_list) {
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_order_list->id_purchase_order.' // '.$purchase_order_list->purchase_order_number.'" id="purchase_order_number_'.$no.'" class="purchase_order_number" onclick="select_change_purchase_order('.$no.');">';
			            $row[] = $purchase_order_list->purchase_order_number;
			            $row[] = $purchase_order_list->account_name;
			            $row[] = $purchase_order_list->purchase_order_date;
			            $row[] = $purchase_order_list->total_amount;
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_order_datatable($key_session, $id_module){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_module = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_purchase_order = $this->m_distributionread->list_purchase_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_order as $purchase_order_list) {
			            $row = array();
				            $id_purchase_order = $purchase_order_list->id_purchase_order;
				            $purchase_order_number = $purchase_order_list->purchase_order_number;
				            $purchase_order_number_format = str_replace('/', 'ZZ', $purchase_order_number);
				            $account_name = $purchase_order_list->account_name;
				            $purchase_order_date = $purchase_order_list->purchase_order_date;
				            $id_transaction_role = $purchase_order_list->id_transaction_role;
				            $transaction_name = $purchase_order_list->transaction_name;
				            $total_qty = $purchase_order_list->total_qty;
				            $sub_amount = $purchase_order_list->sub_amount;
				            $discount_amount = $purchase_order_list->discount_amount;
				            $ppn = $purchase_order_list->ppn;
				            $pph = $purchase_order_list->pph;
				            $total_amount = $purchase_order_list->total_amount;
				            $decimal_after = $purchase_order_list->decimal_after;
				            $cNIK_approval = $purchase_order_list->cNIK_approval;
				            $cNmPegawai_approval = $purchase_order_list->cNmPegawai_approval;

				            $id_transaction_role_new = ($id_transaction_role*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_new);
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            if (in_array($cNIK_session, array('16L10294', $cNIK_approval))) {
				            	if ($id_transaction_role==2) {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px; color:red;" align="center" onClick="approve('.($no+1).', '.$id_purchase_order.', '.$id_transaction_role_new.', '."'$purchase_order_number'".', '."'$transaction_name_new'".');">'.$transaction_name.'</div>';
				            	}
				            	else {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            	}
				            }
				            else {
				            	$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            }

				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.($no+1).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2; color:yellow;" onClick="detail_receipt('."'$purchase_order_number_format'".');">'.$purchase_order_number.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$account_name.'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.date_format(date_create($purchase_order_date), 'd M Y').'</div>';
				            $row[] = $approve;
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.$total_qty.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($sub_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($discount_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($total_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.$cNmPegawai_approval.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_order_by_date_datatable($key_session, $id_module){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_module = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$date_start = $this->uri->segment('5');
					$date_end = $this->uri->segment('6');

					$result_purchase_order = $this->m_distributionread->list_purchase_order_by_date_datatable($company_id_session, $date_start, $date_end);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_order as $purchase_order_list) {
			            $row = array();
				            $id_purchase_order = $purchase_order_list->id_purchase_order;
				            $purchase_order_number = $purchase_order_list->purchase_order_number;
				            $purchase_order_number_format = str_replace('/', 'ZZ', $purchase_order_number);
				            $account_name = $purchase_order_list->account_name;
				            $purchase_order_date = $purchase_order_list->purchase_order_date;
				            $id_transaction_role = $purchase_order_list->id_transaction_role;
				            $transaction_name = $purchase_order_list->transaction_name;
				            $total_qty = $purchase_order_list->total_qty;
				            $sub_amount = $purchase_order_list->sub_amount;
				            $discount_amount = $purchase_order_list->discount_amount;
				            $ppn = $purchase_order_list->ppn;
				            $pph = $purchase_order_list->pph;
				            $total_amount = $purchase_order_list->total_amount;
				            $decimal_after = $purchase_order_list->decimal_after;
				            $cNIK_approval = $purchase_order_list->cNIK_approval;
				            $cNmPegawai_approval = $purchase_order_list->cNmPegawai_approval;

				            $id_transaction_role_new = ($id_transaction_role*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_new);
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            if (in_array($cNIK_session, array('16L10294', $cNIK_approval))) {
				            	if ($id_transaction_role==2) {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px; color:red;" align="center" onClick="approve('.($no+1).', '.$id_purchase_order.', '.$id_transaction_role_new.', '."'$purchase_order_number'".', '."'$transaction_name_new'".');">'.$transaction_name.'</div>';
				            	}
				            	else {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            	}
				            }
				            else {
				            	$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            }

				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.($no+1).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" onClick="detail_receipt('."'$purchase_order_number_format'".');">'.$purchase_order_number.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$account_name.'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.date_format(date_create($purchase_order_date), 'd M Y').'</div>';
				            $row[] = $approve;
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.$total_qty.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($sub_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($discount_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($total_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.$cNmPegawai_approval.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_order_by_date_count_all($company_id_session, $date_start, $date_end),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_order_by_date_count_filtered($company_id_session, $date_start, $date_end),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_purchase_order_by_purchase_order_number($key_session){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$cNmPegawai_session=$this->session->userdata('cNmPegawai_session');
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
				$this->form_validation->set_rules('purchase_order_number', 'purchase_order_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$purchase_order_number = str_replace('ZZ', '/', $this->input->post('purchase_order_number'));
					$check_po = substr($purchase_order_number, 0, 2);
					$data_array = array();
					if ($check_po == 'PO') {
						$result_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
						if (count($result_purchase_order)==0) {
							$status = 0;
						}
						else {
							$status = 1;

							$result_purchase_order_line = $this->m_distributionread->list_purchase_order_line_by_purchase_order_number($company_id_session, $purchase_order_number);

							foreach ($result_purchase_order as $resultList) {
								$decimal_after = $resultList->decimal_after;
								$data = array (
									'id_purchase_order' => $resultList->id_purchase_order,
									'company_id' => $resultList->company_id,
									'company_name' => $resultList->company_name,
									'purchase_order_number' => $resultList->purchase_order_number,
									'purchase_order_number_format' => str_replace('/', 'ZZ', $resultList->purchase_order_number),
									'hold' => $resultList->hold,
									'id_account' => $resultList->id_account,
									'account_cd' => $resultList->account_cd,
									'account_name' => $resultList->account_name,
									'main_address' => $resultList->main_address,
									'city' => $resultList->city,
									'postal_code' => $resultList->postal_code,
									'phone_1' => $resultList->phone_1,
									'fax' => $resultList->fax,
									'attn' => $resultList->attn,
									'year' => $resultList->year,
									'periode' => $resultList->periode,
									'purchase_order_date' => $resultList->purchase_order_date,
									'vendor_quotation_number' => $resultList->vendor_quotation_number,
									'cNIK_approval' => $resultList->cNIK_approval,
									'cNmPegawai_approval' => $resultList->cNmPegawai_approval,
									'id_coa_currency' => $resultList->id_coa_currency,
									'coa_currency_cd' => $resultList->coa_currency_cd,
									'coa_currency_name' => $resultList->coa_currency_name,
									'rate' =>  ($resultList->rate)*1,
									'rate_format' => number_format((($resultList->rate)*1), $decimal_after),
									'total_line' => $resultList->total_line,
									'total_qty' => ($resultList->total_qty)*1,
									'cury_sub_amount' => ($resultList->cury_sub_amount)*1,
									'sub_amount' => ($resultList->sub_amount)*1,
									'cury_discount_amount' => ($resultList->cury_discount_amount)*1,
									'discount_amount' => ($resultList->discount_amount)*1,
									'cury_amount' => ($resultList->cury_amount)*1,
									'amount' => ($resultList->amount)*1,
									'ppn' => ($resultList->ppn)*1,
									'pph' => ($resultList->pph)*1,
									'cury_total_amount' => ($resultList->cury_total_amount)*1,
									'total_amount' => ($resultList->total_amount)*1,
									'id_transaction_role' => $resultList->id_transaction_role,
									'transaction_name' => $resultList->transaction_name,
									'write' => $resultList->write,
									'email_approval' => $resultList->email_approval,
									'email_vendor' => $resultList->email_vendor,
									'close_transaction' => $resultList->close_transaction,
									'note' => $resultList->note,
									'purchase_order_owner' => $resultList->purchase_order_owner,
									'cNmPegawai_owner' => $resultList->cNmPegawai_owner,
									'create_by' => $resultList->create_by,
									'cNmPegawai_create' => $resultList->cNmPegawai_create,
									'create_date' => $resultList->create_date,
									'last_by' => $resultList->last_by,
									'cNmPegawai_last' => $resultList->cNmPegawai_last,
									'last_update' => $resultList->last_update,
									'deleted' => $resultList->deleted,
									'responseLine' => count($result_purchase_order_line)
								);
								array_push ($data_array, $data);
							}
						}
					}
					else {
						$result_purchase_order = $this->m_distributionread->list_purchase_requisitions_by_purchase_requisitions_number($company_id_session, $purchase_order_number);
						if (count($result_purchase_order)==0) {
							$status = 0;
						}
						else {
							$status = 1;
							$result_purchase_order_line = $this->m_distributionread->list_purchase_requisitions_line_by_purchase_requisitions_number($company_id_session, $purchase_order_number);
							foreach ($result_purchase_order as $resultList) {
								$decimal_after = $resultList->decimal_after;
								$data = array (
									'id_purchase_order' => '',
									'company_id' => $resultList->company_id,
									'company_name' => $resultList->company_name,
									'purchase_order_number' => '',
									'purchase_order_number_format' => '',
									'hold' => 1,
									'id_account' => $resultList->id_account,
									'account_cd' => $resultList->account_cd,
									'account_name' => $resultList->account_name,
									'main_address' => $resultList->main_address,
									'city' => $resultList->city,
									'postal_code' => $resultList->postal_code,
									'phone_1' => $resultList->phone_1,
									'fax' => $resultList->fax,
									'attn' => $resultList->attn,
									'year' => $resultList->year,
									'periode' => $resultList->periode,
									'purchase_order_date' => $resultList->purchase_requisitions_date,
									'vendor_quotation_number' => $purchase_order_number,
									'cNIK_approval' => '',
									'cNmPegawai_approval' => '',
									'id_coa_currency' => $resultList->id_coa_currency,
									'coa_currency_cd' => $resultList->coa_currency_cd,
									'coa_currency_name' => $resultList->coa_currency_name,
									'rate' =>  ($resultList->rate)*1,
									'rate_format' => number_format((($resultList->rate)*1), $decimal_after),
									'total_line' => $resultList->total_line,
									'total_qty' => ($resultList->total_qty)*1,
									'cury_sub_amount' => ($resultList->cury_sub_amount)*1,
									'sub_amount' => ($resultList->sub_amount)*1,
									'cury_discount_amount' => ($resultList->cury_discount_amount)*1,
									'discount_amount' => ($resultList->discount_amount)*1,
									'cury_amount' => ($resultList->cury_amount)*1,
									'amount' => ($resultList->amount)*1,
									'ppn' => ($resultList->ppn)*1,
									'pph' => ($resultList->pph)*1,
									'cury_total_amount' => ($resultList->cury_total_amount)*1,
									'total_amount' => ($resultList->total_amount)*1,
									'id_transaction_role' => 1,
									'transaction_name' => 'Hold',
									'write' => 1,
									'email_approval' => $resultList->email_approval,
									'email_vendor' => $resultList->email_vendor,
									'close_transaction' => $resultList->close_transaction,
									'note' => $resultList->note,
									'purchase_order_owner' => $cNIK_session,
									'cNmPegawai_owner' => $cNmPegawai_session,
									'create_by' => $resultList->create_by,
									'cNmPegawai_create' => $resultList->cNmPegawai_create,
									'create_date' => $resultList->create_date,
									'last_by' => $resultList->last_by,
									'cNmPegawai_last' => $resultList->cNmPegawai_last,
									'last_update' => $resultList->last_update,
									'deleted' => $resultList->deleted,
									'responseLine' => count($result_purchase_order_line)
								);
								array_push ($data_array, $data);
							}
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'check_po' => $check_po, 'response' => $data_array)));
			}
		}
	}

	public function list_purchase_receipt_by_id_purchase_order($key_session, $id_purchase_order){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('3');
			$id_purchase_order = $this->uri->segment('4');
			if ($key_session_get!=$key_session) {
				$this->load->view('login');
			}
			else {
				$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_id_purchase_order($company_id_session, $id_purchase_order);
				$data_array = array();
				if (count($result_purchase_receipt)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result_purchase_receipt as $resultList) {
						$decimal_after = $resultList->decimal_after;
						$data = array (
							'id_purchase_receipt' => $resultList->id_purchase_receipt,
							'company_id' => $resultList->company_id,
							'company_name' => $resultList->company_name,
							'purchase_receipt_number' => $resultList->purchase_receipt_number,
							'purchase_receipt_number_format' => str_replace('/', 'ZZ', $resultList->purchase_receipt_number),
							'id_purchase_order' => $resultList->id_purchase_order,
							'purchase_order_number' => $resultList->purchase_order_number,
							'purchase_receipt_date' => $resultList->purchase_receipt_date,
							'vendor_receipt_number' => $resultList->vendor_receipt_number,
							'cNIK_receipt' => $resultList->cNIK_receipt,
							'cNmPegawai' => $resultList->cNmPegawai,
							'total_qty' => $resultList->total_qty,
							'total_amount' => number_format($resultList->total_amount, $decimal_after),
							'id_transaction_role' => $resultList->id_transaction_role,
							'transaction_name' => $resultList->transaction_name,
							'note' => $resultList->note,
							'purchase_receipt_owner' => $resultList->purchase_receipt_owner,
							'cNmPegawai_receipt' => $resultList->cNmPegawai_receipt,
						);
						array_push ($data_array, $data);
					}
				}
				echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	// PR

		public function list_purchase_order_select_for_purchase_receipt_datatable($key_session){
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
					$result_purchase_order = $this->m_distributionread->list_purchase_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_order as $purchase_order_list) {
			        	$id_transaction_role = $purchase_order_list->id_transaction_role;
			        	if ($id_transaction_role==3) {
			        		$no++;
				            $row = array();
				            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_order_list->id_purchase_order.' // '.$purchase_order_list->purchase_order_number.'" id="purchase_order_number_'.$no.'" class="purchase_order_number" onclick="select_change_purchase_order('.$no.');">';
				            $row[] = $purchase_order_list->purchase_order_number;
				            $row[] = $purchase_order_list->account_name;
				            $row[] = $purchase_order_list->purchase_order_date;
				            $row[] = $purchase_order_list->total_amount;
				 
				            $data[] = $row;
			        	}
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_receipt_select_datatable($key_session){
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
					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_receipt as $purchase_receipt_list) {
			        	$decimal_after = $purchase_receipt_list->decimal_after;
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_receipt_list->id_purchase_receipt.' // '.$purchase_receipt_list->purchase_receipt_number.'" id="purchase_receipt_number_'.$no.'" class="purchase_receipt_number" onclick="select_change_purchase_receipt('.$no.');">';
			            $row[] = $purchase_receipt_list->purchase_receipt_number;
			            $row[] = $purchase_receipt_list->account_name;
			            $row[] = $purchase_receipt_list->purchase_receipt_date;
			            $row[] = number_format($purchase_receipt_list->total_amount, $decimal_after);
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_receipt_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_receipt_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_receipt_datatable($key_session, $id_module){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_module = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_receipt as $purchase_receipt_list) {
			            $row = array();
				            $id_purchase_receipt = $purchase_receipt_list->id_purchase_receipt;
				            $purchase_receipt_number = $purchase_receipt_list->purchase_receipt_number;
				            $purchase_receipt_number_format = str_replace('/', 'ZZ', $purchase_receipt_number);
				            $id_purchase_order = $purchase_receipt_list->id_purchase_order;
				            $purchase_order_number = $purchase_receipt_list->purchase_order_number;
				            $account_name = $purchase_receipt_list->account_name;
				            $purchase_receipt_date = $purchase_receipt_list->purchase_receipt_date;
				            $id_transaction_role = $purchase_receipt_list->id_transaction_role;
				            $transaction_name = $purchase_receipt_list->transaction_name;
				            $total_qty = $purchase_receipt_list->total_qty;
				            $sub_amount = $purchase_receipt_list->sub_amount;
				            $discount_amount = $purchase_receipt_list->discount_amount;
				            $ppn = $purchase_receipt_list->ppn;
				            $pph = $purchase_receipt_list->pph;
				            $total_amount = $purchase_receipt_list->total_amount;
				            $decimal_after = $purchase_receipt_list->decimal_after;
				            $cNIK_approval = $purchase_receipt_list->cNIK_approval;
				            $cNmPegawai_approval = $purchase_receipt_list->cNmPegawai_approval;

				            $id_transaction_role_new = ($id_transaction_role*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_new);
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            if (in_array($cNIK_session, array('16L10294', $cNIK_approval))) {
				            	if ($id_transaction_role==2) {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px; color:red;" align="center" onClick="approve('.($no+1).', '.$id_purchase_receipt.', '.$id_transaction_role_new.', '."'$purchase_receipt_number'".', '."'$transaction_name_new'".');">'.$transaction_name.'</div>';
				            	}
				            	else {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            	}
				            }
				            else {
				            	$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            }

				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.($no+1).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2; color:yellow;" onClick="detail_receipt('."'$purchase_receipt_number_format'".');">'.$purchase_receipt_number.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$account_name.'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.date_format(date_create($purchase_receipt_date), 'd M Y').'</div>';
				            $row[] = $approve;
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.$total_qty.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($sub_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($discount_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($total_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.$purchase_order_number.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_receipt_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_receipt_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_receipt_by_date_datatable($key_session, $id_module, $date_start, $date_end){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_module = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$date_start = $this->uri->segment('5');
					$date_end = $this->uri->segment('6');

					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_date_datatable($company_id_session, $date_start, $date_end);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_receipt as $purchase_receipt_list) {
			            $row = array();
				            $id_purchase_receipt = $purchase_receipt_list->id_purchase_receipt;
				            $purchase_receipt_number = $purchase_receipt_list->purchase_receipt_number;
				            $purchase_receipt_number_format = str_replace('/', 'ZZ', $purchase_receipt_number);
				            $id_purchase_order = $purchase_receipt_list->id_purchase_order;
				            $purchase_order_number = $purchase_receipt_list->purchase_order_number;
				            $account_name = $purchase_receipt_list->account_name;
				            $purchase_receipt_date = $purchase_receipt_list->purchase_receipt_date;
				            $id_transaction_role = $purchase_receipt_list->id_transaction_role;
				            $transaction_name = $purchase_receipt_list->transaction_name;
				            $total_qty = $purchase_receipt_list->total_qty;
				            $sub_amount = $purchase_receipt_list->sub_amount;
				            $discount_amount = $purchase_receipt_list->discount_amount;
				            $ppn = $purchase_receipt_list->ppn;
				            $pph = $purchase_receipt_list->pph;
				            $total_amount = $purchase_receipt_list->total_amount;
				            $decimal_after = $purchase_receipt_list->decimal_after;
				            $cNIK_approval = $purchase_receipt_list->cNIK_approval;
				            $cNmPegawai_approval = $purchase_receipt_list->cNmPegawai_approval;

				            $id_transaction_role_new = ($id_transaction_role*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_new);
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            if (in_array($cNIK_session, array('16L10294', $cNIK_approval))) {
				            	if ($id_transaction_role==2) {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px; color:red;" align="center" onClick="approve('.($no+1).', '.$id_purchase_receipt.', '.$id_transaction_role_new.', '."'$purchase_receipt_number'".', '."'$transaction_name_new'".');">'.$transaction_name.'</div>';
				            	}
				            	else {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            	}
				            }
				            else {
				            	$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            }

				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.($no+1).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" onClick="detail_receipt('."'$purchase_receipt_number_format'".');">'.$purchase_receipt_number.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$account_name.'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.date_format(date_create($purchase_receipt_date), 'd M Y').'</div>';
				            $row[] = $approve;
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.$total_qty.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($sub_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($discount_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($total_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.$purchase_order_number.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_receipt_by_date_count_all($company_id_session, $date_start, $date_end),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_receipt_by_date_count_filtered($company_id_session, $date_start, $date_end),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_purchase_order_by_purchase_order_number_for_purchase_receipt($key_session){
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
				$this->form_validation->set_rules('purchase_order_number', 'purchase_order_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$purchase_order_number = $this->input->post('purchase_order_number');
					$result_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
					$data_array = array();
					if (count($result_purchase_order)==0) {
						$status = 0;
					}
					else {
						$status = 1;

						foreach ($result_purchase_order as $resultList) {
							$purchase_order_number = $resultList->purchase_order_number;
							$rate = $resultList->rate;
							
							$result_sum_purchase_order_line_by_purchase_order_number = $this->m_distributionread->sum_purchase_order_line_by_purchase_order_number($company_id_session, $purchase_order_number);
							
							$total_line = 0;
							$total_qty = 0;
							$sub_amount = 0;
							$discount_amount = 0;
							$amount = 0;

							foreach ($result_sum_purchase_order_line_by_purchase_order_number as $result_sum_purchase_order_line_by_purchase_order_number_list){
								$purchase_order_line_qty = ($result_sum_purchase_order_line_by_purchase_order_number_list->purchase_order_line_qty)*1;
								$purchase_order_line_qty_purchase_receipt = ($result_sum_purchase_order_line_by_purchase_order_number_list->purchase_order_line_qty_purchase_receipt)*1;
								
								$qty_open = $purchase_order_line_qty-$purchase_order_line_qty_purchase_receipt;
								$unit_price = $result_sum_purchase_order_line_by_purchase_order_number_list->unit_price;
								
								$sub_amount_line = $qty_open*$unit_price;
								$discount_amount_line = $result_sum_purchase_order_line_by_purchase_order_number_list->discount_amount;
								$amount_line = $sub_amount_line-$discount_amount_line;

								$id_sub_tax = $result_sum_purchase_order_line_by_purchase_order_number_list->id_sub_tax;

								$total_line += 1;
								$total_qty += $qty_open;
								$sub_amount += $sub_amount_line;
								$discount_amount += $discount_amount_line;
								$amount += $amount_line;
							}

							$id_sub_tax = $result_sum_purchase_order_line_by_purchase_order_number[0]->id_sub_tax;

							$result_sub_tax = $this->m_jomread->list_sub_tax($company_id_session, $id_sub_tax);
							$sub_tax_percent_plus = $result_sub_tax[0]->sub_tax_percent_plus;
							$sub_tax_percent_minus = $result_sub_tax[0]->sub_tax_percent_minus;
							$ppn = ($sub_tax_percent_plus/100)*$amount;
							$pph = ($sub_tax_percent_minus/100)*$amount;

							$total_amount = $amount+$ppn+$pph;

							$data = array (
								'id_purchase_order' => $resultList->id_purchase_order,
								'company_id' => $resultList->company_id,
								'company_name' => $resultList->company_name,
								'purchase_order_number' => $resultList->purchase_order_number,
								'purchase_order_number_format' => str_replace('/', 'ZZ', $resultList->purchase_order_number),
								'hold' => $resultList->hold,
								'id_account' => $resultList->id_account,
								'account_cd' => $resultList->account_cd,
								'account_name' => $resultList->account_name,
								'year' => $resultList->year,
								'periode' => $resultList->periode,
								'purchase_order_date' => $resultList->purchase_order_date,
								'vendor_quotation_number' => $resultList->vendor_quotation_number,
								'cNIK_approval' => $resultList->cNIK_approval,
								'cNmPegawai_approval' => $resultList->cNmPegawai_approval,
								'id_coa_currency' => $resultList->id_coa_currency,
								'coa_currency_cd' => $resultList->coa_currency_cd,
								'coa_currency_name' => $resultList->coa_currency_name,
								'rate' => $rate*1,
								'total_line' => $total_line*1,
								'total_qty' => $total_qty*1,
								'sub_amount' => $sub_amount*1,
								'discount_amount' => $discount_amount*1,
								'amount' => $amount*1,
								'ppn' => $ppn*1,
								'pph' => $pph*1,
								'total_amount' => $total_amount*1,
								'id_transaction_role' => $resultList->id_transaction_role,
								'transaction_name' => $resultList->transaction_name,
								'write' => $resultList->write,
								'email_approval' => $resultList->email_approval,
								'email_vendor' => $resultList->email_vendor,
								'close_transaction' => $resultList->close_transaction,
								'note' => $resultList->note,
								'purchase_order_owner' => $resultList->purchase_order_owner,
								'cNmPegawai_owner' => $resultList->cNmPegawai_owner,
								'create_by' => $resultList->create_by,
								'cNmPegawai_create' => $resultList->cNmPegawai_create,
								'create_date' => $resultList->create_date,
								'last_by' => $resultList->last_by,
								'cNmPegawai_last' => $resultList->cNmPegawai_last,
								'last_update' => $resultList->last_update,
								'deleted' => $resultList->deleted,
								'responseLine' => count($result_sum_purchase_order_line_by_purchase_order_number)
							);
							array_push ($data_array, $data);
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

		public function purchase_receipt_line_blank($key_session, $transaction_number){
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
					
					$data = array();

			        $no = $_POST['start'];

			        $purchase_order_number_get = $this->uri->segment('4');
			        $purchase_order_number_header = str_replace('ZZ', '/', $purchase_order_number_get);

			        if ($purchase_order_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {
						$result_purchase_order_line = $this->m_distributionread->list_purchase_order_line_by_purchase_order_number($company_id_session, $purchase_order_number_header);
						$value_count = count($result_purchase_order_line);

						$aa=1;
						$no_line = 0;

						foreach ($result_purchase_order_line as $resultListLine){
							$id_purchase_order_line = $resultListLine->id_purchase_order_line;
							$company_id = $resultListLine->company_id;
							$purchase_order_number = $resultListLine->purchase_order_number;
							//$purchase_order_number_format = str_replace('ZZ', '-', $purchase_order_number);
							$line_number = $resultListLine->line_number;
							$id_inventory = $resultListLine->id_inventory;
							$inventory_cd = $resultListLine->inventory_cd;
							$description = $resultListLine->description;
							$id_part_list = $resultListLine->id_part_list;
							$part_no = $resultListLine->part_no;
							$part_name = $resultListLine->part_name;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$purchase_order_line_qty = ($resultListLine->purchase_order_line_qty)*1;
							$purchase_order_line_qty_purchase_receipt = ($resultListLine->purchase_order_line_qty_purchase_receipt)*1;
							$qty_open = $purchase_order_line_qty-$purchase_order_line_qty_purchase_receipt;
							

							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;
							$cury_unit_price = ($resultListLine->cury_unit_price)*1;
							$unit_price = ($resultListLine->unit_price)*1;
							$cury_sub_amount = ($resultListLine->cury_sub_amount)*1;
							$sub_amount = ($resultListLine->sub_amount)*1;
							$cury_discount_amount = ($resultListLine->cury_discount_amount)*1;
							$discount_amount = ($resultListLine->discount_amount)*1;
							$discount_percent = ($resultListLine->discount_percent)*1;
							$cury_amount = ($resultListLine->cury_amount)*1;
							$amount = ($resultListLine->amount)*1;
							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$id_warehouse = $resultListLine->id_warehouse;
							$warehouse_cd = $resultListLine->warehouse_cd;
							$warehouse_name = $resultListLine->warehouse_name;
							$id_item_class = $resultListLine->id_item_class;
							$item_class_cd = $resultListLine->item_class_cd;
							$item_class_name = $resultListLine->item_class_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$last_update = $resultListLine->last_update;


							$no_line += 1;

							if ($purchase_order_line_qty!=$purchase_order_line_qty_purchase_receipt) {		
								$no++;					
								$row = array();
					            	$row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
						            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" id="id_purchase_receipt_line_'.$aa.'" value="'.$id_purchase_receipt_line.'"><input type="hidden" id="id_purchase_order_line_'.$aa.'" value="'.$id_purchase_order_line.'"><input type="hidden" id="id_inventory_line_'.$aa.'" value="'.$id_inventory.'"><input type="hidden" id="id_part_list_line_'.$aa.'" value="'.$id_part_list.'"><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$aa.'" placeholder="Inventory ID" value="'.$inventory_cd.'" readonly></div>';
						            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$aa.'" placeholder="Inventory Name" value="'.$description.'" readonly></div>';
						            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="hidden" id="JobNo_line_'.$aa.'" value="'.$JobNo.'"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" value="'.$purchase_order_line_qty.'" readonly></div>'; // Qty order
						            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;">
						            			<input type="hidden" class="bottom_border_only" id="qty_receipt_line_old_'.$aa.'" placeholder="Qty Receipt" max="'.$purchase_order_line_qty_purchase_receipt.'" min="1" value="'.$purchase_order_line_qty_purchase_receipt.'" onChange="price_calculation('.$aa.');">
						            			<input type="number" class="bottom_border_only" id="qty_receipt_line_'.$aa.'" placeholder="Qty Open" max="'.$qty_open.'" min="1" value="'.$purchase_order_line_qty.'" onChange="price_calculation('.$aa.');"><input type="hidden" id="discount_amount_line_'.$aa.'" value="'.$discount_amount.'">
						            			<input type="hidden" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'"></div>'; // Qty Receipt
						            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="number" class="bottom_border_only" id="qty_open_line_'.$aa.'" placeholder="Qty Open" max="'.$qty_open.'" min="1" value="'.$qty_open.'" readonly></div>'; // Qty Open
						            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" readonly></div>'; // UOM
						            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price.'" placeholder="Unit Price" readonly></div>'; // Unit Price
						            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" value="'.$sub_amount.'" placeholder="Line Amount" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" value="'.$amount.'" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="hidden" id="coa_cd_line_'.$aa.'" value="'.$coa_cd.'"><input type="hidden" id="coa_name_line_'.$aa.'" value="'.$coa_name.'"><input type="hidden" id="item_class_cd_line_'.$aa.'" value="'.$item_class_cd.'"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" value="'.$sub_tax_cd.'" readonly></div>'; // Tax Category
						            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$aa.'" placeholder="Warehouse" value="'.$warehouse_name.'" readonly></div>'; // Warehouse
					            $data[] = $row;

					            $aa++;
					        }
						}
					}

					$total_line = $no;
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $total_line,
			            "recordsFiltered" => $total_line,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_purchase_receipt_by_purchase_receipt_number($key_session){
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
				$this->form_validation->set_rules('purchase_receipt_number', 'purchase_receipt_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$purchase_receipt_number = $this->input->post('purchase_receipt_number');
					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_purchase_receipt_number($company_id_session, $purchase_receipt_number);
					$data_array = array();
					if (count($result_purchase_receipt)==0) {
						$status = 0;
					}
					else {
						$status = 1;

						foreach ($result_purchase_receipt as $resultList) {
							
							$decimal_after = $resultList->decimal_after;
							$data = array (
								'id_purchase_receipt' => $resultList->id_purchase_receipt,
								'company_id' => $resultList->company_id,
								'company_name' => $resultList->company_name,
								'purchase_receipt_number' => $resultList->purchase_receipt_number,
								'purchase_receipt_number_format' => str_replace('/', 'ZZ', $resultList->purchase_receipt_number),
								'id_purchase_order' => $resultList->id_purchase_order,
								'purchase_order_number' => $resultList->purchase_order_number,
								'hold' => $resultList->hold,
								'id_account' => $resultList->id_account,
								'account_cd' => $resultList->account_cd,
								'account_name' => $resultList->account_name,
								'year' => $resultList->year,
								'periode' => $resultList->periode,
								'purchase_receipt_date' => $resultList->purchase_receipt_date,
								'vendor_receipt_number' => $resultList->vendor_receipt_number,
								'cNIK_receipt' => $resultList->cNIK_receipt,
								'cNmPegawai' => $resultList->cNmPegawai,
								'id_coa_currency' => $resultList->id_coa_currency,
								'coa_currency_cd' => $resultList->coa_currency_cd,
								'coa_currency_name' => $resultList->coa_currency_name,
								'decimal_after' => $resultList->decimal_after,
								'sequence' => $resultList->sequence,
								'rate' => $resultList->rate,
								'total_line' => $resultList->total_line,
								'total_qty' => $resultList->total_qty,
								'cury_sub_amount' => str_replace(',', '', number_format($resultList->cury_sub_amount, $decimal_after)),
								'sub_amount' => str_replace(',', '', number_format($resultList->sub_amount, $decimal_after)),
								'cury_discount_amount' => str_replace(',', '', number_format($resultList->cury_discount_amount, $decimal_after)),
								'discount_amount' => str_replace(',', '', number_format($resultList->discount_amount, $decimal_after)),
								'cury_amount' => str_replace(',', '', number_format($resultList->cury_amount, $decimal_after)),
								'amount' => str_replace(',', '', number_format($resultList->amount, $decimal_after)),
								'ppn' => str_replace(',', '', number_format($resultList->ppn, $decimal_after)),
								'pph' => str_replace(',', '', number_format($resultList->pph, $decimal_after)),
								'cury_total_amount' => str_replace(',', '', number_format($resultList->cury_total_amount, $decimal_after)),
								'total_amount' => str_replace(',', '', number_format($resultList->total_amount, $decimal_after)),
								'id_transaction_role' => $resultList->id_transaction_role,
								'transaction_name' => $resultList->transaction_name,
								'write' => $resultList->write,
								'email_approval' => $resultList->email_approval,
								'email_vendor' => $resultList->email_vendor,
								'close_transaction' => $resultList->close_transaction,
								'note' => $resultList->note,
								'purchase_receipt_owner' => $resultList->purchase_receipt_owner,
								'cNmPegawai_receipt' => $resultList->cNmPegawai_receipt,
								'create_by' => $resultList->create_by,
								'cNmPegawai_create' => $resultList->cNmPegawai_create,
								'create_date' => $resultList->create_date,
								'last_by' => $resultList->last_by,
								'cNmPegawai_last' => $resultList->cNmPegawai_last,
								'last_update' => $resultList->last_update,
								'deleted' => $resultList->deleted,
								'responseLine' => count($result_purchase_receipt_line)
							);
							array_push ($data_array, $data);
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'purchase_receipt_number' => $purchase_receipt_number, 'response' => $data_array)));
			}
		}
	}

		public function purchase_receipt_line_blank_receipt($key_session, $transaction_number){
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
					
					$data = array();

			        $no = $_POST['start'];

			        $purchase_receipt_number_get = $this->uri->segment('4');
			        $purchase_receipt_number_header = str_replace('ZZ', '/', $purchase_receipt_number_get);

			        if ($purchase_receipt_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {
						$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line_by_purchase_receipt_number($company_id_session, $purchase_receipt_number_header);
						$value_count = count($result_purchase_receipt_line);

						$aa=1;
						$no_line = 0;

						foreach ($result_purchase_receipt_line as $resultListLine){
							
							$id_purchase_order_line = $resultListLine->id_purchase_order_line;
							$company_id = $resultListLine->company_id;
							$purchase_order_number = $resultListLine->purchase_order_number;
							$line_number = $resultListLine->line_number;
							$id_inventory = $resultListLine->id_inventory;
							$inventory_cd = $resultListLine->inventory_cd;
							$description = $resultListLine->description;
							$id_part_list = $resultListLine->id_part_list;
							$part_no = $resultListLine->part_no;
							$part_name = $resultListLine->part_name;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$purchase_order_line_qty = ($resultListLine->purchase_order_line_qty)*1;
							$purchase_receipt_line_qty = ($resultListLine->purchase_receipt_line_qty)*1;
							
							$result_purchase_receipt_line_qty_total = $this->m_distributionread->purchase_receipt_line_qty_by_id_purchase_order_qty_line($company_id_session, $id_purchase_order_line);
							$purchase_receipt_line_qty_total = $result_purchase_receipt_line_qty_total[0]->purchase_receipt_line_qty;

							$qty_open = $purchase_order_line_qty-$purchase_receipt_line_qty_total;

							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;

							$cury_unit_price = ($resultListLine->cury_unit_price)*1;
							$unit_price = ($resultListLine->unit_price)*1;

							$cury_sub_amount = ($resultListLine->cury_sub_amount)*1;
							$sub_amount = ($resultListLine->sub_amount)*1;
							$cury_discount_amount = ($resultListLine->cury_discount_amount)*1;
							$discount_amount = ($resultListLine->discount_amount)*1;
							$discount_percent = ($resultListLine->discount_percent)*1;
							$cury_amount = ($resultListLine->cury_amount)*1;
							$amount = ($resultListLine->amount)*1;

							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$id_warehouse = $resultListLine->id_warehouse;
							$warehouse_cd = $resultListLine->warehouse_cd;
							$warehouse_name = $resultListLine->warehouse_name;
							$id_item_class = $resultListLine->id_item_class;
							$item_class_cd = $resultListLine->item_class_cd;
							$item_class_name = $resultListLine->item_class_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$last_update = $resultListLine->last_update;


							$no_line += 1;

							if ($purchase_order_line_qty!=$purchase_order_line_qty_purchase_receipt) {		
								$no++;					
								$row = array();
					            	$row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
						            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" id="id_purchase_receipt_line_'.$aa.'" value="'.$id_purchase_receipt_line.'"><input type="hidden" id="id_purchase_order_line_'.$aa.'" value="'.$id_purchase_order_line.'"><input type="hidden" id="id_inventory_line_'.$aa.'" value="'.$id_inventory.'"><input type="hidden" id="id_part_list_line_'.$aa.'" value="'.$id_part_list.'"><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$aa.'" placeholder="Inventory ID" value="'.$inventory_cd.'" readonly></div>';
						            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$aa.'" placeholder="Inventory Name" value="'.$description.'" readonly></div>';
						            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="hidden" id="JobNo_line_'.$aa.'" value="'.$JobNo.'"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" value="'.$purchase_order_line_qty.'" readonly></div>'; // Qty order
						            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;">
						            			<input type="hidden" class="bottom_border_only" id="qty_receipt_line_old_'.$aa.'" placeholder="Qty Receipt" max="'.$purchase_receipt_line_qty.'" min="1" value="'.$purchase_receipt_line_qty.'" onChange="price_calculation('.$aa.');">
						            			<input type="number" class="bottom_border_only" id="qty_receipt_line_'.$aa.'" placeholder="Qty Receipt" max="'.$purchase_receipt_line_qty.'" min="1" value="'.$purchase_receipt_line_qty.'" onChange="price_calculation('.$aa.');">
						            			<input type="hidden" id="discount_amount_line_'.$aa.'" value="'.$discount_amount.'"><input type="hidden" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'"></div>'; // Qty Receipt
						            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="number" class="bottom_border_only" id="qty_open_line_'.$aa.'" placeholder="Qty Open" max="'.$qty_open.'" min="1" value="'.$qty_open.'" readonly></div>'; // Qty Open
						            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" readonly></div>'; // UOM
						            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price.'" placeholder="Unit Price" readonly></div>'; // Unit Price
						            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" value="'.$sub_amount.'" placeholder="Line Amount" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" value="'.$amount.'" readonly></div>'; // Line Amount
						            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="hidden" id="coa_cd_line_'.$aa.'" value="'.$coa_cd.'"><input type="hidden" id="coa_name_line_'.$aa.'" value="'.$coa_name.'"><input type="hidden" id="item_class_cd_line_'.$aa.'" value="'.$item_class_cd.'"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" value="'.$sub_tax_cd.'" readonly></div>'; // Tax Category
						            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$aa.'" placeholder="Warehouse" value="'.$warehouse_name.'" readonly></div>'; // Warehouse
					            $data[] = $row;

					            $aa++;
					        }
						}
					}

					$total_line = $no;
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $value_count,
			            "recordsFiltered" => $value_count,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_receipt_line_by_jobno_datatable($key_session, $JobNo){
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
					
					$data = array();

			        $no = $_POST['start'];

			        $JobNo = $this->uri->segment('4');

					$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line_by_job_datatable($company_id_session, $JobNo);
					$value_count = count($result_purchase_receipt_line);

					$aa=1;
					$no_line = 0;

					foreach ($result_purchase_receipt_line as $resultListLine){
						
						$id_purchase_order_line = $resultListLine->id_purchase_order_line;
						$id_purchase_receipt_line = $resultListLine->id_purchase_receipt_line;
						$company_id = $resultListLine->company_id;
						$purchase_order_number = $resultListLine->purchase_order_number;
						$purchase_receipt_number = $resultListLine->purchase_receipt_number;
						$line_number = $resultListLine->line_number;
						$id_inventory = $resultListLine->id_inventory;
						$inventory_cd = $resultListLine->inventory_cd;
						$description = $resultListLine->description;
						$id_part_list = $resultListLine->id_part_list;
						$part_no = $resultListLine->part_no;
						$part_name = $resultListLine->part_name;
						$id_job_order = $resultListLine->id_job_order;
						$JobNo = $resultListLine->JobNo;
						$purchase_order_line_qty = ($resultListLine->purchase_order_line_qty)*1;
						$purchase_receipt_line_qty = ($resultListLine->purchase_receipt_line_qty)*1;
						
						$result_purchase_receipt_line_qty_total = $this->m_distributionread->purchase_receipt_line_qty_by_id_purchase_order_qty_line($company_id_session, $id_purchase_order_line);
						$purchase_receipt_line_qty_total = $result_purchase_receipt_line_qty_total[0]->purchase_receipt_line_qty;

						$qty_open = $purchase_order_line_qty-$purchase_receipt_line_qty_total;

						$id_uom = $resultListLine->id_uom;
						$uom_cd = $resultListLine->uom_cd;
						$uom_name = $resultListLine->uom_name;

						$cury_unit_price = ($resultListLine->cury_unit_price)*1;
						$unit_price = ($resultListLine->unit_price)*1;

						$cury_sub_amount = ($resultListLine->cury_sub_amount)*1;
						$sub_amount = ($resultListLine->sub_amount)*1;
						$cury_discount_amount = ($resultListLine->cury_discount_amount)*1;
						$discount_amount = ($resultListLine->discount_amount)*1;
						$discount_percent = ($resultListLine->discount_percent)*1;
						$cury_amount = ($resultListLine->cury_amount)*1;
						$amount = ($resultListLine->amount)*1;

						$id_sub_tax = $resultListLine->id_sub_tax;
						$sub_tax_cd = $resultListLine->sub_tax_cd;
						$sub_tax_name = $resultListLine->sub_tax_name;
						$id_coa = $resultListLine->id_coa;
						$coa_cd = $resultListLine->coa_cd;
						$coa_name = $resultListLine->coa_name;
						$id_warehouse = $resultListLine->id_warehouse;
						$warehouse_cd = $resultListLine->warehouse_cd;
						$warehouse_name = $resultListLine->warehouse_name;
						$id_item_class = $resultListLine->id_item_class;
						$item_class_cd = $resultListLine->item_class_cd;
						$item_class_name = $resultListLine->item_class_name;
						$line_status = $resultListLine->line_status;
						$create_by = $resultListLine->create_by;
						$create_date = $resultListLine->create_date;
						$last_by = $resultListLine->last_by;
						$last_update = $resultListLine->last_update;


						$no_line += 1;
	
						$no++;					
						$row = array();
			            	
				            $row[] = $no;
				            $row[] = $purchase_receipt_number;
				            $row[] = $description;
				            $row[] = '<input type="number" class="form-control" id="qty_used_'.$no.'" style="width:75px;" value="'.$purchase_receipt_line_qty.'">';
				            $row[] = $uom_cd;
				            $row[] = $cury_unit_price;
				            $row[] = $cury_amount;
				            $row[] = '	<input type="hidden" name="count" value="'.$value_count.'">
				            			<input type="checkbox" style="width:25px; height:25px;" id="id_purchase_receipt_line_'.$no.'" value="'.$id_purchase_receipt_line.'" checked="checked">
				            		';

			            $data[] = $row;

			            $aa++;
				        
					}

					$total_line = $no;
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $value_count,
			            "recordsFiltered" => $value_count,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	// PI

		public function list_purchase_receipt_line_by_vendor_datatable($key_session){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_account_get = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_line_by_vendor_datatable($company_id_session, $id_account_get);
					$data = array();
					$no = $_POST['start'];
					foreach ($result_purchase_receipt as $purchase_receipt_list) {
						$sequence = $purchase_receipt_list->sequence;
						$decimal_after = $purchase_receipt_list->decimal_after;
						$row = array();
						# code...
						$row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_receipt_list->id_purchase_receipt_line.'" id="id_purchase_receipt_line_'.$no.'" class="purchase_receipt_number" onclick="select_change_purchase_receipt('.$no.');">';
						$row[] = $purchase_receipt_list->purchase_receipt_number;
						$row[] = date_format(date_create($purchase_receipt_list->purchase_receipt_date), 'd M Y');
						$row[] = $purchase_receipt_list->description;
						$row[] = $purchase_receipt_list->purchase_receipt_line_qty;
						$row[] = $purchase_receipt_list->uom_cd;
						$row[] = number_format($purchase_receipt_list->cury_unit_price, $decimal_after);
						$row[] = number_format($purchase_receipt_list->cury_amount, $decimal_after);
						
						$data[] = $row;
						$no++;

					}
			
					$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_distributionread->list_purchase_receipt_line_by_vendor_count_all($company_id_session, $id_account_get),
						"recordsFiltered" => $this->m_distributionread->list_purchase_receipt_line_by_vendor_count_filtered($company_id_session, $id_account_get),
						"data" => $data,
					);
					echo json_encode($output);
				}
			}
		}

	public function list_purchase_receipt_by_purchase_receipt_line_id($key_session){
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
				$data_array = array();
				$id_purchase_receipt_line_array = array_unique(json_decode($this->input->post('id_purchase_receipt_line_array')));
				$status = 1;
				for ($i=0; $i < count($id_purchase_receipt_line_array); $i++) { 
					$id_purchase_receipt_line = ($id_purchase_receipt_line_array[$i])*1;
					if ($id_purchase_receipt_line>=1) {
						$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_by_purchase_receipt_line_id($company_id_session, $id_purchase_receipt_line);
						foreach ($result_purchase_receipt_line as $purchase_receipt_line_list);
						$decimal_after = $purchase_receipt_line_list->decimal_after;
						$data = array(
							'id_purchase_receipt_line' => $id_purchase_receipt_line,
							'id_inventory' => $purchase_receipt_line_list->id_inventory,
							'inventory_cd' => $purchase_receipt_line_list->inventory_cd,
							'description' => $purchase_receipt_line_list->description,
							'purchase_receipt_line_qty' => $purchase_receipt_line_list->purchase_receipt_line_qty,
							'uom_cd' => $purchase_receipt_line_list->uom_cd,
							'cury_unit_price' => number_format($purchase_receipt_line_list->cury_unit_price, $decimal_after),
							'cury_sub_amount' => number_format($purchase_receipt_line_list->cury_sub_amount, $decimal_after),
							'cury_discount_amount' => number_format($purchase_receipt_line_list->cury_discount_amount, $decimal_after),
							'cury_amount' => number_format($purchase_receipt_line_list->cury_amount, $decimal_after),
							'sub_tax_cd' => $purchase_receipt_line_list->sub_tax_cd,
							'warehouse_name' => $purchase_receipt_line_list->warehouse_name,
							'id_coa' => $purchase_receipt_line_list->id_coa,
							'coa_cd' => $purchase_receipt_line_list->coa_cd,
							'coa_name' => $purchase_receipt_line_list->coa_name,
							'sub_tax_percent_plus' => $purchase_receipt_line_list->sub_tax_percent_plus,
							'sub_tax_percent_minus' => $purchase_receipt_line_list->sub_tax_percent_minus,
						);
						array_push($data_array, $data);
					}
				}
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

		public function list_purchase_receipt_for_purchase_invoice_select_datatable($key_session){
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
					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_datatable($company_id_session);
					$data = array();
					$no = $_POST['start'];
					foreach ($result_purchase_receipt as $purchase_receipt_list) {
						$sequence = $purchase_receipt_list->sequence;
						$decimal_after = $purchase_receipt_list->decimal_after;
						$row = array();
						if ($sequence==5) {
							# code...
							$row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_receipt_list->id_purchase_receipt.' // '.$purchase_receipt_list->purchase_receipt_number.'" id="purchase_receipt_number_'.$no.'" class="purchase_receipt_number" onclick="select_change_purchase_receipt('.$no.');">';
							$row[] = $purchase_receipt_list->purchase_receipt_number;
							$row[] = $purchase_receipt_list->account_name;
							$row[] = $purchase_receipt_list->purchase_receipt_date;
							$row[] = number_format($purchase_receipt_list->total_amount, $decimal_after);
							
							$data[] = $row;
							$no++;
						}
					}
			
					$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->m_distributionread->list_purchase_receipt_count_all($company_id_session),
						"recordsFiltered" => $this->m_distributionread->list_purchase_receipt_count_filtered($company_id_session),
						"data" => $data,
					);
					echo json_encode($output);
				}
			}
		}

	public function list_purchase_receipt_by_purchase_receipt_number_for_purchase_invoice($key_session){
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
				$data_array = array();
				$purchase_receipt_number = $this->input->post('purchase_receipt_number');
				$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_purchase_receipt_number_for_purchase_invoice($company_id_session, $purchase_receipt_number);
				if (count($result_purchase_receipt)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result_purchase_receipt as $purchase_receipt_list) {
						$decimal_after = $purchase_receipt_list->decimal_after;
						$data = array(
							'id_purchase_receipt' => $purchase_receipt_list->id_purchase_receipt,
							'purchase_receipt_number' => $purchase_receipt_list->purchase_receipt_number,
							'purchase_receipt_number_format' => str_replace('/', 'ZZ', $purchase_receipt_list->purchase_invoice_number),
							'purchase_receipt_date' => $purchase_receipt_list->purchase_receipt_date,
							'note' => $purchase_receipt_list->note,
							'id_account' => $purchase_receipt_list->id_account,
							'account_name' => $purchase_receipt_list->account_name,
							'id_coa_currency' => $purchase_receipt_list->id_coa_currency,
							'coa_currency_cd' => $purchase_receipt_list->coa_currency_cd,
							'coa_currency_name' => $purchase_receipt_list->coa_currency_name,
							'rate' => $purchase_receipt_list->rate,
							'total_line' => $purchase_receipt_list->total_line,
							'total_qty' => $purchase_receipt_list->total_qty,
							'cury_sub_amount' => $purchase_receipt_list->cury_sub_amount,
							'sub_amount' => ($purchase_receipt_list->sub_amount)*1,
							'cury_discount_amount' => $purchase_receipt_list->cury_discount_amount,
							'discount_amount' => ($purchase_receipt_list->discount_amount)*1,
							'cury_amount' => $purchase_receipt_list->cury_amount,
							'amount' => ($purchase_receipt_list->amount)*1,
							'ppn' => ($purchase_receipt_list->ppn)*1,
							'pph' => ($purchase_receipt_list->pph)*1,
							'cury_total_amount' => $purchase_receipt_list->cury_total_amount,
							'total_amount' => ($purchase_receipt_list->total_amount)*1,
						);
						array_push($data_array, $data);
					}
				}
				echo json_encode(array(array('status' => $status, 'purchase_receipt_number' => $purchase_receipt_number, 'response' => $data_array)));
			}
		}
	}

		public function purchase_invoice_line_blank($key_session, $transaction_number){
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
					
					$data = array();

					$no = $_POST['start'];

					$purchase_receipt_number_get = $this->uri->segment('4');
					$purchase_receipt_number_header = str_replace('ZZ', '/', $purchase_receipt_number_get);

					if ($purchase_receipt_number_get=='0') {
						$value_count = 0;
					}
					else {
						$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line_by_purchase_receipt_number($company_id_session, $purchase_receipt_number_header);
						$value_count = count($result_purchase_receipt_line);

						$aa=1;
						$no_line = 0;

						foreach ($result_purchase_order_line as $resultListLine){
							
							$no_line += 1;
							$id_purchase_receipt_line = $resultListLine->id_purchase_receipt_line;
							$company_id = $resultListLine->company_id;
							$company_name = $resultListLine->company_name;
							$purchase_receipt_number = $resultListLine->purchase_receipt_number;
							$id_purchase_order = $resultListLine->id_purchase_order;
							$purchase_order_number = $resultListLine->purchase_order_number;
							$id_account = $resultListLine->id_account;
							$account_cd = $resultListLine->account_cd;
							$account_name = $resultListLine->account_name;
							$id_coa_currency = $resultListLine->id_coa_currency;
							$coa_currency_cd = $resultListLine->coa_currency_cd;
							$coa_currency_name = $resultListLine->coa_currency_name;
							$decimal_after = $resultListLine->decimal_after;
							$id_purchase_order_line = $resultListLine->id_purchase_order_line;
							$line_number = $resultListLine->line_number;
							$id_inventory = $resultListLine->id_inventory;
							$inventory_cd = $resultListLine->inventory_cd;
							$description = $resultListLine->description;
							$id_part_list = $resultListLine->id_part_list;
							$part_no = $resultListLine->part_no;
							$part_name = $resultListLine->part_name;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$purchase_order_line_qty = $resultListLine->purchase_order_line_qty;
							$purchase_receipt_line_qty = $resultListLine->purchase_receipt_line_qty;
							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;
							$cury_unit_price = $resultListLine->cury_unit_price;
							$unit_price = $resultListLine->unit_price;
							$cury_sub_amount = $resultListLine->cury_sub_amount;
							$sub_amount = $resultListLine->sub_amount;
							$cury_discount_amount = $resultListLine->cury_discount_amount;
							$discount_amount = $resultListLine->discount_amount;
							$discount_percent = $resultListLine->discount_percent;
							$cury_amount = $resultListLine->cury_amount;
							$amount = $resultListLine->amount;
							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$sub_tax_percent_plus = $resultListLine->sub_tax_percent_plus;
							$sub_tax_percent_minus = $resultListLine->sub_tax_percent_minus;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$id_warehouse = $resultListLine->id_warehouse;
							$warehouse_cd = $resultListLine->warehouse_cd;
							$warehouse_name = $resultListLine->warehouse_name;
							$id_item_class = $resultListLine->id_item_class;
							$item_class_cd = $resultListLine->item_class_cd;
							$item_class_name = $resultListLine->item_class_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$cNmPegawai_create = $resultListLine->cNmPegawai_create;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$cNmPegawai_last = $resultListLine->cNmPegawai_last;
							$last_update = $resultListLine->last_update;
							$ppn = ($sub_tax_percent_plus/100)*$amount;
							$pph = ($sub_tax_percent_minus/100)*$amount;

							//if ($purchase_order_line_qty!=$purchase_order_line_qty_purchase_receipt) {		
								$no++;					
								$row = array();
									$row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
									$row[] = '<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" id="id_purchase_receipt_line_'.$aa.'" value="'.$id_purchase_receipt_line.'"><input type="hidden" id="id_purchase_order_line_'.$aa.'" value="'.$id_purchase_order_line.'"><input type="hidden" id="id_inventory_line_'.$aa.'" value="'.$id_inventory.'"><input type="hidden" id="id_part_list_line_'.$aa.'" value="'.$id_part_list.'"><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$aa.'" placeholder="Inventory ID" value="'.$inventory_cd.'" readonly></div>';
									$row[] = '<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$aa.'" placeholder="Inventory Name" value="'.$description.'" readonly></div>';
									$row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="hidden" id="JobNo_line_'.$aa.'" value="'.$JobNo.'"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" value="'.$purchase_order_line_qty.'" readonly></div>'; // Qty order
									$row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;">
												<input type="hidden" class="bottom_border_only" id="qty_receipt_line_old_'.$aa.'" placeholder="Qty Receipt" max="'.$purchase_order_line_qty_purchase_receipt.'" min="1" value="'.$purchase_order_line_qty_purchase_receipt.'" onChange="price_calculation('.$aa.');">
												<input type="number" class="bottom_border_only" id="qty_receipt_line_'.$aa.'" placeholder="Qty Open" max="'.$qty_open.'" min="1" value="'.$purchase_order_line_qty.'" onChange="price_calculation('.$aa.');"><input type="hidden" id="discount_amount_line_'.$aa.'" value="'.$discount_amount.'">
												<input type="hidden" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'"></div>'; // Qty Receipt
									$row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="number" class="bottom_border_only" id="qty_open_line_'.$aa.'" placeholder="Qty Open" max="'.$qty_open.'" min="1" value="'.$qty_open.'" readonly></div>'; // Qty Open
									$row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" readonly></div>'; // UOM
									$row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price.'" placeholder="Unit Price" readonly></div>'; // Unit Price
									$row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" value="'.$sub_amount.'" placeholder="Line Amount" readonly></div>'; // Line Amount
									$row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" value="'.$amount.'" readonly></div>'; // Line Amount
									$row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="hidden" id="coa_cd_line_'.$aa.'" value="'.$coa_cd.'"><input type="hidden" id="coa_name_line_'.$aa.'" value="'.$coa_name.'"><input type="hidden" id="item_class_cd_line_'.$aa.'" value="'.$item_class_cd.'"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" value="'.$sub_tax_cd.'" readonly></div>'; // Tax Category
									$row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$aa.'" placeholder="Warehouse" value="'.$warehouse_name.'" readonly></div>'; // Warehouse
								$data[] = $row;

								$aa++;
							//}
						}
					}

					$total_line = $no;
			
					$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $total_line,
						"recordsFiltered" => $total_line,
						"data" => $data,
					);
					echo json_encode($output);
				}
			}
		}

		public function list_purchase_invoice_select_datatable($key_session){
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
					$result_purchase_invoice = $this->m_distributionread->list_purchase_invoice_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_invoice as $purchase_invoice_list) {
			        	$decimal_after = $purchase_invoice_list->decimal_after;
			            $no++;
			            $row = array();
			            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_invoice_list->id_purchase_invoice.' // '.$purchase_invoice_list->purchase_invoice_number.'" id="purchase_invoice_number_'.$no.'" class="purchase_invoice_number" onclick="select_change_purchase_invoice('.$no.');">';
			            $row[] = $purchase_invoice_list->purchase_invoice_number;
			            $row[] = $purchase_invoice_list->account_name;
			            $row[] = $purchase_invoice_list->purchase_invoice_date;
			            $row[] = number_format($purchase_invoice_list->total_amount, $decimal_after);
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_invoice_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_invoice_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_invoice_datatable($key_session){
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
					$result_purchase_invoice = $this->m_distributionread->list_purchase_invoice_datatable($company_id_session);
			        $data = array();
			        $no = 1;
			        foreach ($result_purchase_invoice as $purchase_invoice_list) {
			        	$purchase_invoice_number = $purchase_invoice_list->purchase_invoice_number;
			        	$purchase_invoice_number_format = str_replace('/', 'ZZ', $purchase_invoice_number);
			        	$decimal_after = $purchase_invoice_list->decimal_after;

			        	$list_po = '';
			        	foreach ($this->m_distributionread->list_po_by_pi($company_id_session, $purchase_invoice_number) as $result_purchase_order){
			        		$purchase_order_number = $result_purchase_order->purchase_order_number;
			        		$list_po .= $purchase_order_number;
			        	}

			        	$list_pr = '';
			        	foreach ($this->m_distributionread->list_pr_by_pi($company_id_session, $purchase_invoice_number) as $result_purchase_receipt){
			        		$purchase_receipt_number = $result_purchase_receipt->purchase_receipt_number;
			        		$list_pr .= $purchase_receipt_number;
			        	}

			            $row = array();
			            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.$no.'</div>';
			            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center" onClick="detail_invoice('."'$purchase_invoice_number_format'".');">'.$purchase_invoice_list->purchase_invoice_number.'</div>';
			            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.$purchase_invoice_list->account_name.'</div>';
			            $row[] = $purchase_invoice_list->purchase_invoice_date;
			            $row[] = '<div align="center">'.$purchase_invoice_list->transaction_name.'</div>';
			            $row[] = '<div align="center">'.$purchase_invoice_list->total_qty.'</div>';
			            $row[] = '<div align="right" style="padding-right:10px;">'.number_format($purchase_invoice_list->cury_sub_amount, $decimal_after).'</div>';
			            $row[] = '<div align="right" style="padding-right:10px;">'.number_format($purchase_invoice_list->cury_discount_amount, $decimal_after).'</div>';
			            $row[] = '<div align="right" style="padding-right:10px;">'.number_format($purchase_invoice_list->ppn, $decimal_after).'</div>';
			            $row[] = '<div align="right" style="padding-right:10px;">'.number_format($purchase_invoice_list->pph, $decimal_after).'</div>';
			            $row[] = '<div align="right" style="padding-right:10px;">'.number_format($purchase_invoice_list->cury_amount, $decimal_after).'</div>';
			            $row[] = '<div align="center">'.$list_po.'</div>';
			            $row[] = '<div align="center">'.$list_pr.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_invoice_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_invoice_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_receipt_by_id_account_for_purchase_invoice_datatable($key_session, $id_account){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_account = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_id_account_for_purchase_invoice_datatable($company_id_session, $id_account);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_receipt as $purchase_receipt_list) {
			            $row = array();
				            $id_purchase_receipt = $purchase_receipt_list->id_purchase_receipt;
				            $purchase_receipt_number = $purchase_receipt_list->purchase_receipt_number;
				            $purchase_receipt_number_format = str_replace('/', 'ZZ', $purchase_receipt_number);
				            $id_purchase_order = $purchase_receipt_list->id_purchase_order;
				            $purchase_order_number = $purchase_receipt_list->purchase_order_number;
				            $account_name = $purchase_receipt_list->account_name;
				            $purchase_receipt_date = $purchase_receipt_list->purchase_receipt_date;
				            $id_transaction_role = $purchase_receipt_list->id_transaction_role;
				            $transaction_name = $purchase_receipt_list->transaction_name;
				            $total_qty = $purchase_receipt_list->total_qty;
				            $sub_amount = $purchase_receipt_list->sub_amount;
				            $discount_amount = $purchase_receipt_list->discount_amount;
				            $ppn = $purchase_receipt_list->ppn;
				            $pph = $purchase_receipt_list->pph;
				            $total_amount = $purchase_receipt_list->total_amount;
				            $decimal_after = $purchase_receipt_list->decimal_after;
				            $cNIK_approval = $purchase_receipt_list->cNIK_approval;
				            $cNmPegawai_approval = $purchase_receipt_list->cNmPegawai_approval;

				            $id_transaction_role_new = ($id_transaction_role*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_new);
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            if (in_array($cNIK_session, array('16L10294', $cNIK_approval))) {
				            	if ($id_transaction_role==2) {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px; color:red;" align="center" onClick="approve('.($no+1).', '.$id_purchase_receipt.', '.$id_transaction_role_new.', '."'$purchase_receipt_number'".', '."'$transaction_name_new'".');">'.$transaction_name.'</div>';
				            	}
				            	else {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            	}
				            }
				            else {
				            	$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            }

				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.($no+1).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2; color:yellow;" onClick="detail_receipt('."'$purchase_receipt_number_format'".');">'.$purchase_receipt_number.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$account_name.'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.date_format(date_create($purchase_receipt_date), 'd M Y').'</div>';
				            $row[] = $approve;
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.$total_qty.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($sub_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($discount_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($total_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.$purchase_order_number.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_receipt_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_receipt_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_purchase_receipt_by_id_account_datatable($key_session, $id_account){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_account = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_id_account_datatable($company_id_session, $id_account);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_purchase_receipt as $purchase_receipt_list) {
			            $row = array();
				            $id_purchase_receipt = $purchase_receipt_list->id_purchase_receipt;
				            $purchase_receipt_number = $purchase_receipt_list->purchase_receipt_number;
				            $purchase_receipt_number_format = str_replace('/', 'ZZ', $purchase_receipt_number);
				            $id_purchase_order = $purchase_receipt_list->id_purchase_order;
				            $purchase_order_number = $purchase_receipt_list->purchase_order_number;
				            $account_name = $purchase_receipt_list->account_name;
				            $purchase_receipt_date = $purchase_receipt_list->purchase_receipt_date;
				            $id_transaction_role = $purchase_receipt_list->id_transaction_role;
				            $transaction_name = $purchase_receipt_list->transaction_name;
				            $total_qty = $purchase_receipt_list->total_qty;
				            $sub_amount = $purchase_receipt_list->sub_amount;
				            $discount_amount = $purchase_receipt_list->discount_amount;
				            $ppn = $purchase_receipt_list->ppn;
				            $pph = $purchase_receipt_list->pph;
				            $total_amount = $purchase_receipt_list->total_amount;
				            $decimal_after = $purchase_receipt_list->decimal_after;
				            $cNIK_approval = $purchase_receipt_list->cNIK_approval;
				            $cNmPegawai_approval = $purchase_receipt_list->cNmPegawai_approval;

				            $id_transaction_role_new = ($id_transaction_role*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_id_transaction_role($company_id_session, $id_module, $id_transaction_role_new);
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            $row[] = '<input type="checkbox" style="width:25px; height:25px;" value="'.$purchase_receipt_list->id_purchase_receipt.' // '.$purchase_receipt_list->purchase_receipt_number.'" id="purchase_receipt_number_'.$no.'" class="purchase_receipt_number" onclick="select_change_purchase_receipt('.$no.');">';
				            $row[] = $purchase_receipt_number;
				            $row[] = $account_name;
				            $row[] = date_format(date_create($purchase_receipt_date), 'd M Y');
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_purchase_receipt_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_purchase_receipt_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_purchase_receipt_line_by_purchase_receipt_number($key_session){
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
				
		        $purchase_receipt_number = $this->input->post('purchase_receipt_number');

				$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line_by_purchase_receipt_number($company_id_session, $purchase_receipt_number);
				$value_count = count($result_purchase_receipt_line);

				$aa=1;
				$no_line = 0;

				$data_array = array();

				if ($value_count==0) {
					$status = 0;
					$responseValue = 'Data not found.';
				}
				else {
					$status = 1;
					$responseValue = '';

					foreach ($result_purchase_receipt_line as $resultListLine){
						
						$id_purchase_receipt_line = $resultListLine->id_purchase_receipt_line;
						$company_id = $resultListLine->company_id;
						$company_name = $resultListLine->company_name;
						$purchase_receipt_number = $resultListLine->purchase_receipt_number;
						$id_purchase_order = $resultListLine->id_purchase_order;
						$purchase_order_number = $resultListLine->purchase_order_number;
						$id_account = $resultListLine->id_account;
						$account_cd = $resultListLine->account_cd;
						$account_name = $resultListLine->account_name;
						$id_coa_currency = $resultListLine->id_coa_currency;
						$coa_currency_cd = $resultListLine->coa_currency_cd;
						$coa_currency_name = $resultListLine->coa_currency_name;
						$decimal_after = $resultListLine->decimal_after;
						$id_purchase_order_line = $resultListLine->id_purchase_order_line;
						$line_number = $resultListLine->line_number;
						$id_inventory = $resultListLine->id_inventory;
						$inventory_cd = $resultListLine->inventory_cd;
						$description = $resultListLine->description;
						$id_part_list = $resultListLine->id_part_list;
						$part_no = $resultListLine->part_no;
						$part_name = $resultListLine->part_name;
						$id_job_order = $resultListLine->id_job_order;
						$JobNo = $resultListLine->JobNo;
						$purchase_order_line_qty = $resultListLine->purchase_order_line_qty;
						$purchase_receipt_line_qty = $resultListLine->purchase_receipt_line_qty;
						$id_uom = $resultListLine->id_uom;
						$uom_cd = $resultListLine->uom_cd;
						$uom_name = $resultListLine->uom_name;
						$cury_unit_price = $resultListLine->cury_unit_price;
						$unit_price = $resultListLine->unit_price;
						$cury_sub_amount = $resultListLine->cury_sub_amount;
						$sub_amount = $resultListLine->sub_amount;
						$cury_discount_amount = $resultListLine->cury_discount_amount;
						$discount_amount = $resultListLine->discount_amount;
						$discount_percent = $resultListLine->discount_percent;
						$cury_amount = $resultListLine->cury_amount;
						$amount = $resultListLine->amount;
						$id_sub_tax = $resultListLine->id_sub_tax;
						$sub_tax_cd = $resultListLine->sub_tax_cd;
						$sub_tax_name = $resultListLine->sub_tax_name;
						$sub_tax_percent_plus = $resultListLine->sub_tax_percent_plus;
						$sub_tax_percent_minus = $resultListLine->sub_tax_percent_minus;
						$id_coa = $resultListLine->id_coa;
						$coa_cd = $resultListLine->coa_cd;
						$coa_name = $resultListLine->coa_name;
						$id_warehouse = $resultListLine->id_warehouse;
						$warehouse_cd = $resultListLine->warehouse_cd;
						$warehouse_name = $resultListLine->warehouse_name;
						$id_item_class = $resultListLine->id_item_class;
						$item_class_cd = $resultListLine->item_class_cd;
						$item_class_name = $resultListLine->item_class_name;
						$line_status = $resultListLine->line_status;
						$create_by = $resultListLine->create_by;
						$cNmPegawai_create = $resultListLine->cNmPegawai_create;
						$create_date = $resultListLine->create_date;
						$last_by = $resultListLine->last_by;
						$cNmPegawai_last = $resultListLine->cNmPegawai_last;
						$last_update = $resultListLine->last_update;

						$ppn = ($sub_tax_percent_plus/100)*$amount;
						$pph = ($sub_tax_percent_minus/100)*$amount;

						$data = array (
							"id_purchase_receipt_line" => $id_purchase_receipt_line,
							"company_id" => $company_id,
							"company_name" => $company_name,
							"purchase_receipt_number" => $purchase_receipt_number,
							"id_purchase_order" => $id_purchase_order,
							"purchase_order_number" => $purchase_order_number,
							"id_account" => $id_account,
							"account_cd" => $account_cd,
							"account_name" => $account_name,
							"id_coa_currency" => $id_coa_currency,
							"coa_currency_cd" => $coa_currency_cd,
							"coa_currency_name" => $coa_currency_name,
							"decimal_after" => $decimal_after,
							"id_purchase_order_line" => $id_purchase_order_line,
							"line_number" => $line_number,
							"id_inventory" => $id_inventory,
							"inventory_cd" => $inventory_cd,
							"description" => $description,
							"id_part_list" => $id_part_list,
							"part_no" => $part_no,
							"part_name" => $part_name,
							"id_job_order" => $id_job_order,
							"JobNo" => $JobNo,
							"purchase_order_line_qty" => $purchase_order_line_qty,
							"purchase_receipt_line_qty" => $purchase_receipt_line_qty,
							"id_uom" => $id_uom,
							"uom_cd" => $uom_cd,
							"uom_name" => $uom_name,
							"cury_unit_price" => $cury_unit_price,
							"cury_sub_amount" => $cury_sub_amount,
							"cury_discount_amount" => $cury_discount_amount,
							"cury_amount" => $cury_amount,
							"unit_price" => $unit_price,
							"sub_amount" => $sub_amount,
							"discount_amount" => $discount_amount,
							"discount_percent" => $discount_percent,
							"ppn" => $ppn*1,
							"pph" => $pph*-1,
							"amount" => $amount,
							"unit_price_format" => number_format($unit_price, $decimal_after),
							"sub_amount_format" => number_format($sub_amount, $decimal_after),
							"discount_amount_format" => number_format($discount_amount, $decimal_after),
							"amount_format" => number_format($amount, $decimal_after),
							"id_sub_tax" => $id_sub_tax,
							"sub_tax_cd" => $sub_tax_cd,
							"sub_tax_name" => $sub_tax_name,
							"sub_tax_percent_plus" => $sub_tax_percent_plus,
							"sub_tax_percent_minus" => $sub_tax_percent_minus,
							"id_coa" => $id_coa,
							"coa_cd" => $coa_cd,
							"coa_name" => $coa_name,
							"id_warehouse" => $id_warehouse,
							"warehouse_cd" => $warehouse_cd,
							"warehouse_name" => $warehouse_name,
							"id_item_class" => $id_item_class,
							"item_class_cd" => $item_class_cd,
							"item_class_name" => $item_class_name,
							"line_status" => $line_status,
							"create_by" => $create_by,
							"cNmPegawai_create" => $cNmPegawai_create,
							"create_date" => $create_date,
							"last_by" => $last_by,
							"cNmPegawai_last" => $cNmPegawai_last,
							"last_update" => $last_update,
						);
						array_push ($data_array, $data);
					}
				}
		        echo json_encode(array(array('status' => $status, 'responseValue' => $responseValue, 'response' => $data_array)));
			}
		}
	}

	public function list_purchase_invoice_by_purchase_invoice_number($key_session){
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

				$this->form_validation->set_rules('purchase_invoice_number', 'purchase_invoice_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$purchase_invoice_number = $this->input->post('purchase_invoice_number');

					$result_purchase_invoice = $this->m_distributionread->list_purchase_invoice_by_purchase_invoice_number($company_id_session, $purchase_invoice_number);
					$data_array = array();
					if (count($result_purchase_invoice)==0) {
						$status = 0;
					}
					else {
						$status = 1;

						$result_id_purchase_receipt_line = $this->m_distributionread->list_id_purchase_receipt_line_on_purchase_receipt_invoice_line($company_id_session, $purchase_invoice_number);

						foreach ($result_purchase_invoice as $resultList) {
							$decimal_after = $resultList->decimal_after;

							$data = array(
								"id_purchase_invoice" => $resultList->id_purchase_invoice,
								"company_id" => $resultList->company_id,
								"company_name" => $resultList->company_name,
								"purchase_invoice_number" => $resultList->purchase_invoice_number,
								"purchase_invoice_number_format" => str_replace('/', 'ZZ', $resultList->purchase_invoice_number),
								"hold" => $resultList->hold,
								"id_account" => $resultList->id_account,
								"account_cd" => $resultList->account_cd,
								"account_name" => $resultList->account_name,
								"year" => $resultList->year,
								"periode" => $resultList->periode,
								"purchase_invoice_date" => $resultList->purchase_invoice_date,
								"vendor_invoice_number" => $resultList->vendor_invoice_number,
								"vendor_tax_number" => $resultList->vendor_tax_number,
								"id_coa_currency" => $resultList->id_coa_currency,
								"coa_currency_cd" => $resultList->coa_currency_cd,
								"coa_currency_name" => $resultList->coa_currency_name,
								"decimal_after" => $resultList->decimal_after,
								"rate" => ($resultList->rate)*1,
								"total_line" => ($resultList->total_line)*1,
								"total_qty" => ($resultList->total_qty)*1,
								"cury_sub_amount" => $resultList->cury_sub_amount,
								"sub_amount" => ($resultList->sub_amount)*1,
								"cury_discount_amount" => $resultList->cury_discount_amount,
								"discount_amount" => ($resultList->discount_amount)*1,
								"cury_amount" => $resultList->cury_amount,
								"amount" => ($resultList->amount)*1,
								"ppn" => ($resultList->ppn)*1,
								"pph" => ($resultList->pph)*1,
								"cury_total_amount" => $resultList->cury_total_amount,
								"total_amount" => ($resultList->total_amount)*1,
								"id_transaction_role" => $resultList->id_transaction_role,
								"transaction_name" => $resultList->transaction_name,
								"note" => $resultList->note,
								'write' => $resultList->write,
								'email_approval' => $resultList->email_approval,
								'email_vendor' => $resultList->email_vendor,
								'close_transaction' => $resultList->close_transaction,
								"create_by" => $resultList->create_by,
								"cNmPegawai_create" => $resultList->cNmPegawai_create,
								"create_date" => $resultList->create_date,
								"last_by" => $resultList->last_by,
								"cNmPegawai_last" => $resultList->cNmPegawai_last,
								"last_update" => $resultList->last_update,
								"deleted" => $resultList->deleted,
								"id_purchase_receipt_line_array" => $result_id_purchase_receipt_line
							);
							
							array_push ($data_array, $data);
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'purchase_invoice_number' => $purchase_invoice_number, 'response' => $data_array)));
			}
		}
	}

		public function purchase_invoice_line_blank_invoice($key_session, $transaction_number){
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
					
					$data = array();

			        $no = $_POST['start'];
					$no_line = 0;

			        $purchase_invoice_number_get = $this->uri->segment('4');
			        $purchase_invoice_number_header = str_replace('ZZ', '/', $purchase_invoice_number_get);

			        if ($purchase_invoice_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {
						$result_purchase_invoice_line = $this->m_distributionread->list_purchase_invoice_line_by_purchase_invoice_number($company_id_session, $purchase_invoice_number_header);
						$value_count = count($result_purchase_invoice_line);

						$aa=1;

						foreach ($result_purchase_invoice_line as $resultListLine){
							
							$id_purchase_invoice_line = $resultListLine->id_purchase_invoice_line;
							$id_purchase_order_line = $resultListLine->id_purchase_order_line;
							$company_id = $resultListLine->company_id;
							$purchase_order_number = $resultListLine->purchase_order_number;
							$line_number = $resultListLine->line_number;
							$id_inventory = $resultListLine->id_inventory;
							$inventory_cd = $resultListLine->inventory_cd;
							$description = $resultListLine->description;
							$id_part_list = $resultListLine->id_part_list;
							$part_no = $resultListLine->part_no;
							$part_name = $resultListLine->part_name;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$purchase_order_line_qty = ($resultListLine->purchase_order_line_qty)*1;
							$purchase_invoice_line_qty = ($resultListLine->purchase_invoice_line_qty)*1;

							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;

							$cury_unit_price = ($resultListLine->cury_unit_price)*1;
							$unit_price = ($resultListLine->unit_price)*1;

							$cury_sub_amount = ($resultListLine->cury_sub_amount)*1;
							$sub_amount = ($resultListLine->sub_amount)*1;
							$cury_discount_amount = ($resultListLine->cury_discount_amount)*1;
							$discount_amount = ($resultListLine->discount_amount)*1;
							$discount_percent = ($resultListLine->discount_percent)*1;
							$cury_amount = ($resultListLine->cury_amount)*1;
							$amount = ($resultListLine->amount)*1;

							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$id_warehouse = $resultListLine->id_warehouse;
							$warehouse_cd = $resultListLine->warehouse_cd;
							$warehouse_name = $resultListLine->warehouse_name;
							$id_item_class = $resultListLine->id_item_class;
							$item_class_cd = $resultListLine->item_class_cd;
							$item_class_name = $resultListLine->item_class_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$last_update = $resultListLine->last_update;

							$no_line += 1;
		
							$no++;					
							$row = array();
			            	$row[] = '<input type="hidden" id="id_purchase_invoice_line_'.$no.'" value="'.$id_purchase_invoice_line.'">
			            	<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center"><button class="btn btn-danger" onclick="delete_purchase_receipt_line('.($id_purchase_receipt_line*1).', '."'$description'".');"><i class="mdi mdi-delete-forever"></i></button></div>';
			            	$row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$inventory_cd.'</div>';
			            	$row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$description.'</div>';
			            	$row[] = $purchase_invoice_line_qty;
			            	$row[] = $uom_cd;
			            	$row[] = $cury_unit_price;
			            	$row[] = $cury_sub_amount;
			            	$row[] = $cury_discount_amount;
			            	$row[] = $cury_amount;
			            	$row[] = $sub_tax_cd;
			            	$row[] = $warehouse_name;
			            	$row[] = '<input type="text" class="form-control" style="color:black;" id="coa_cd_line_'.($no).'" onclick="list_coa('.($no).');" value="'.$coa_cd.'" readonly>';
			            	$row[] = '<div id="coa_name_line_'.($no).'">'.$coa_name.'</div>';
				            $data[] = $row;

				            $aa++;
						}
					}

					$total_line = $no;
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $no_line,
			            "recordsFiltered" => $no_line,
			            "value_count" => $value_count,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	// Sales 

	// SO

		public function list_job_order_for_sales_order_datatable($key_session, $id_account){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_account = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_job_order = $this->m_distributionread->list_job_order_for_sales_order_datatable($company_id_session, $id_account);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_job_order as $job_order_list) {
			            $row = array();
				            $id_job_order = $job_order_list->id_job_order;
				            $account_cd = $job_order_list->account_cd;
				            $account_name = $job_order_list->account_name;
				            $JobNo = $job_order_list->JobNo;
				            $JobName = $job_order_list->JobName;
				            $POCustomerNumber = $job_order_list->POCustomerNumber;
				            $PODate = $job_order_list->PODate;
				            $Qty = $job_order_list->Qty;
				            $Amount = $job_order_list->Amount;
				            $decimal_after = $job_order_list->decimal_after;

				            $row[] = '<input type="checkbox" style="width:25px; height:25px;" id="JobNo_'.$no.'" value="'.$JobNo.'" class="JobNo" onclick="select_change_inventory('.$no.');"><input type="hidden"  id="JobName_'.$no.'" value="'.$JobName.'">';
				            
				            $row[] = $JobNo;
				            $row[] = $JobName;
				            $row[] = $Qty;
				            $row[] = number_format($Amount, $decimal_after);
				            $row[] = $POCustomerNumber;
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_job_order_for_sales_order_count_all($company_id_session, $id_account),
			            "recordsFiltered" => $this->m_distributionread->list_job_order_for_sales_order_count_filtered($company_id_session, $id_account),
			            "data" => $data,
			        );
			        echo json_encode($output);
			        //echo json_encode($output);
				}
			}
		}

		public function sales_order_line_blank($key_session, $transaction_number){
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
					
					$data = array();

			        $no = $_POST['start'];

			        $sales_order_number_get = $this->uri->segment('4');
			        $sales_order_number_header = str_replace('ZZ', '/', $sales_order_number_get);

			        if ($sales_order_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {

						$result_sales_order_line = $this->m_distributionread->list_sales_order_line_by_sales_order_number($company_id_session, $sales_order_number_header);
						$value_count = count($result_sales_order_line);

						$aa=1;

						foreach ($result_sales_order_line as $resultListLine){
							$id_sales_order_line = $resultListLine->id_sales_order_line;
							$company_id = $resultListLine->company_id;
							$company_name = $resultListLine->company_name;
							$sales_order_number = $resultListLine->sales_order_number;
							$id_sales_order = $resultListLine->id_sales_order;
							$line_number = $resultListLine->line_number;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$JobName = $resultListLine->JobName;
							$description = $resultListLine->description;
							$qty_order_line = $resultListLine->qty_order_line;
							$qty_shipment_line = $resultListLine->qty_shipment_line;
							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;
							$cury_unit_price = $resultListLine->cury_unit_price;
							$unit_price = $resultListLine->unit_price;
							$cury_sub_amount = $resultListLine->cury_sub_amount;
							$sub_amount = $resultListLine->sub_amount;
							$cury_discount_amount = $resultListLine->cury_discount_amount;
							$discount_amount = $resultListLine->discount_amount;
							$discount_percent = $resultListLine->discount_percent;
							$cury_amount = $resultListLine->cury_amount;
							$amount = $resultListLine->amount;
							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$cNmPegawai_create = $resultListLine->cNmPegawai_create;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$cNmPegawai_last = $resultListLine->cNmPegawai_last;
							$last_update = $resultListLine->last_update;


							$row = array();
					            $row[] = '	<div id="div_line_1_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_sales_order_line_'.$aa.'" value="'.$id_sales_order_line.'">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$aa.'" value="'.$id_job_order.'">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$aa.'" onClick="list_inventory('.$aa.')" placeholder="Job No" value="'.$JobNo.'">
						            		</div>';

					            $row[] = '	<div id="div_line_2_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="JobName_'.$aa.'" onClick="list_inventory('.$aa.')" placeholder="Job Name" readonly value="'.$JobName.'">
					            			</div>';

					            $row[] = '	<div id="div_line_3_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$aa.'" placeholder="Description" value="'.$description.'">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" onChange="price_calculation('.$aa.');" value="'.$qty_order_line.'"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_shipment_line_'.$aa.'" placeholder="Qty Receipt" readonly value="0"></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" onclick="list_uom('.$aa.');" value="'.$uom_cd.'"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" placeholder="Unit Price" onChange="price_calculation('.$aa.');" value="'.$unit_price.'"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" placeholder="Line Amount" readonly value="'.$sub_amount.'"></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$aa.'" placeholder="Discount Amount" onChange="price_calculation('.$aa.');" value="'.$discount_amount.'"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$aa.'" placeholder="Discount Percent" onChange="price_calculation('.$aa.');" value="'.$discount_percent.'"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" readonly value="'.$amount.'"></div>'; // Line Amount
					            $row[] = '<div id="div_line_12_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" onClick="list_sub_tax('.$aa.');" readonly value="'.$sub_tax_cd.'"></div>'; // Tax Category
					            $row[] = '<div id="div_line_14_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$aa.'" placeholder="Account" onClick="list_coa('.$aa.');" readonly value="'.$coa_cd.'"></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$aa.'" placeholder="Description" readonly value="'.$coa_name.'"></div>'; // Description
				            	$row[] = '<div id="div_line_17_'.($aa).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;

				            $aa++;
						}
					}

					$total_line = 100;
					for ($a=($value_count+1); $a<=$total_line; $a++){
						$no++;
						if ($a==($value_count+1)) {
							$row = array();
					            $row[] = '	<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_sales_order_line_'.$no.'" value="">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$no.'" value="">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$no.'" onClick="list_inventory('.$no.')" placeholder="Job No">
						            		</div>';

					            $row[] = '	<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="JobName_'.$no.'" onClick="list_inventory('.$no.')" placeholder="Job Name" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$no.'" placeholder="Description">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$no.'" placeholder="Qty Order" onChange="price_calculation('.$no.');"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_shipment_line_'.$no.'" placeholder="Qty Receipt" readonly></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$no.'" placeholder="UOM" onclick="list_uom('.$no.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$no.'" placeholder="Unit Price" onChange="price_calculation('.$no.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$no.'" placeholder="Discount Amount" onChange="price_calculation('.$no.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$no.'" placeholder="Discount Percent" onChange="price_calculation('.$no.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$no.'" placeholder="Tax Category" onClick="list_sub_tax('.$no.');" readonly></div>'; // Tax Category
					            //$row[] = '<div id="div_line_13_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$no.'" placeholder="Item Class" readonly onClick="list_item_class('.$no.');"></div>'; // Account
					            $row[] = '<div id="div_line_14_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$no.'" placeholder="Account" onClick="list_coa('.$no.');" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$no.'" placeholder="Description" readonly></div>'; // Description
				            	$row[] = '<div id="div_line_17_'.($no).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$no.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;
						}
						else {
				            $row = array();
					            $row[] = '	<div id="div_line_1_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_sales_order_line_'.$no.'" value="">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$no.'" value="">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$no.'" onClick="list_inventory('.$no.')" placeholder="Job No">
						            		</div>';

					            $row[] = '	<div id="div_line_2_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="JobName_'.$no.'" onClick="list_inventory('.$no.')" placeholder="Job Name" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_3_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$no.'" placeholder="Description">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$no.'" placeholder="Qty Order" onChange="price_calculation('.$no.');"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_shipment_line_'.$no.'" placeholder="Qty Receipt" readonly></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$no.'" placeholder="UOM" onclick="list_uom('.$no.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$no.'" placeholder="Unit Price" onChange="price_calculation('.$no.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$no.'" placeholder="Discount Amount" onChange="price_calculation('.$no.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$no.'" placeholder="Discount Percent" onChange="price_calculation('.$no.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$no.'" placeholder="Tax Category" onClick="list_sub_tax('.$no.');" readonly></div>'; // Tax Category
					            //$row[] = '<div id="div_line_13_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$no.'" placeholder="Item Class" readonly onClick="list_item_class('.$no.');"></div>'; // Account
					            $row[] = '<div id="div_line_14_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$no.'" placeholder="Account" onClick="list_coa('.$no.');" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$no.'" placeholder="Description" readonly></div>'; // Description
				            	$row[] = '<div id="div_line_17_'.($no).'" style="height:45px; display:none; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$no.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;						
						}
					}
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $total_line,
			            "recordsFiltered" => $total_line,
			            //"sales_order_number" => $sales_order_number_get.' '.$sales_order_number_header,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_sales_order_select_datatable($key_session){
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
					$result_sales_order = $this->m_distributionread->list_sales_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_sales_order as $sales_order_list) {
			        	$decimal_after = $sales_order_list->decimal_after;
			        	$sales_order_number = $sales_order_list->sales_order_number;
			        	$sales_order_number_format = str_replace('/', 'ZZ', $sales_order_number);

			            $no++;
			            $row = array();
			            $row[] = '
			            			<input type="hidden" style="width:25px; height:25px;" value="'.$sales_order_list->id_sales_order.'" id="id_sales_order_'.$no.'" class="sales_order_number">
			            			<input type="hidden" style="width:25px; height:25px;" value="'.$sales_order_number_format.'" id="sales_order_number_format_'.$no.'" class="sales_order_number">
			            			<input type="checkbox" style="width:25px; height:25px;" value="'.$sales_order_number.'" id="sales_order_number_'.$no.'" class="sales_order_number" onclick="select_change_sales_order('.$no.');">
			            		';
			            $row[] = $sales_order_list->sales_order_number;
			            $row[] = $sales_order_list->account_name;
			            $row[] = $sales_order_list->sales_order_date;
			            $row[] = number_format($sales_order_list->total_amount, $decimal_after);
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_sales_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_sales_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_sales_order_by_sales_order_number($key_session){
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
				$this->form_validation->set_rules('sales_order_number', 'sales_order_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$sales_order_number = $this->input->post('sales_order_number');
					$result_sales_order = $this->m_distributionread->list_sales_order_by_sales_order_number($company_id_session, $sales_order_number);
					$data_array = array();
					if (count($result_sales_order)==0) {
						$status = 0;
					}
					else {
						$status = 1;

						foreach ($result_sales_order as $resultList) {
							$decimal_after = $resultList->decimal_after;
							$data = array (
								'id_sales_order' => $resultList->id_sales_order,
								'company_id' => $resultList->company_id,
								'company_name' => $resultList->company_name,
								'sales_order_number' => $resultList->sales_order_number,
								'sales_order_number_format' => str_replace('/', 'ZZ', $sales_order_number),
								'hold' => $resultList->hold,
								'id_transaction_role' => $resultList->id_transaction_role,
								'transaction_name' => $resultList->transaction_name,
								'sales_order_date' => $resultList->sales_order_date,
								'year' => $resultList->year,
								'periode' => $resultList->periode,
								'quotation_number' => $resultList->quotation_number,
								'note' => $resultList->note,
								'id_account' => $resultList->id_account,
								'account_cd' => $resultList->account_cd,
								'account_name' => $resultList->account_name,
								'id_account_project' => $resultList->id_account_project,
								'account_cd_project' => $resultList->account_cd_project,
								'account_name_project' => $resultList->account_name_project,
								'id_coa_currency' => $resultList->id_coa_currency,
								'coa_currency_cd' => $resultList->coa_currency_cd,
								'coa_currency_name' => $resultList->coa_currency_name,
								'decimal_after' => $resultList->decimal_after,
								'rate' => str_replace(',', '', number_format($resultList->rate, $decimal_after)),
								'sales_order_owner' => $resultList->sales_order_owner,
								'customer_order_number' => $resultList->customer_order_number,
								'cNmPegawai_sales_order_owner' => $resultList->cNmPegawai_sales_order_owner,
								'cNIK_approval' => $resultList->cNIK_approval,
								'cNmPegawai_approval' => $resultList->cNmPegawai_approval,
								'total_line' => $resultList->total_line,
								'total_qty' => $resultList->total_qty,
								'cury_sub_amount' => str_replace(',', '', number_format($resultList->cury_sub_amount, $decimal_after)),
								'sub_amount' => str_replace(',', '', number_format($resultList->sub_amount, $decimal_after)),
								'cury_discount_amount' => str_replace(',', '', number_format($resultList->cury_discount_amount, $decimal_after)),
								'discount_amount' => str_replace(',', '', number_format($resultList->discount_amount, $decimal_after)),
								'cury_amount' => str_replace(',', '', number_format($resultList->cury_amount, $decimal_after)),
								'amount' => str_replace(',', '', number_format($resultList->amount, $decimal_after)),
								'ppn' => str_replace(',', '', number_format($resultList->ppn, $decimal_after)),
								'pph' => str_replace(',', '', number_format($resultList->pph, $decimal_after)),
								'cury_total_amount' => str_replace(',', '', number_format($resultList->cury_total_amount, $decimal_after)),
								'total_amount' => str_replace(',', '', number_format($resultList->total_amount, $decimal_after)),
								'create_by' => $resultList->create_by,
								'cNmPegawai_create' => $resultList->cNmPegawai_create,
								'create_date' => $resultList->create_date,
								'last_by' => $resultList->last_by,
								'cNmPegawai_last' => $resultList->cNmPegawai_last,
								'last_update' => $resultList->last_update,
								'deleted' => $resultList->deleted,
							);
							array_push ($data_array, $data);
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

		public function list_sales_order_datatable($key_session, $id_module){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_module = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_sales_order = $this->m_distributionread->list_sales_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_sales_order as $sales_order_list) {
			            $row = array();
				            $id_sales_order = $sales_order_list->id_sales_order;
				            $sales_order_number = $sales_order_list->sales_order_number;
				            $sales_order_number_format = str_replace('/', 'ZZ', $sales_order_number);
				            $account_name = $sales_order_list->account_name;
				            $sales_order_date = $sales_order_list->sales_order_date;
				            $id_transaction_role = $sales_order_list->id_transaction_role;
				            $sequence = $sales_order_list->sequence;
				            $transaction_name = $sales_order_list->transaction_name;
				            $total_qty = $sales_order_list->total_qty;
				            $sub_amount = $sales_order_list->sub_amount;
				            $discount_amount = $sales_order_list->discount_amount;
				            $ppn = $sales_order_list->ppn;
				            $pph = $sales_order_list->pph;
				            $total_amount = $sales_order_list->total_amount;
				            $decimal_after = $sales_order_list->decimal_after;
				            $cNIK_approval = $sales_order_list->cNIK_approval;
				            $cNmPegawai_approval = $sales_order_list->cNmPegawai_approval;

				            $sequence_new = ($sequence*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
				            $id_transaction_role_new = $result_transaction_role[0]->id_transaction_role;
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            if (in_array($cNIK_session, array('16L10294', $cNIK_approval))) {
				            	if ($sequence==2) {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px; color:red;" align="center" onClick="approve('.($no+1).', '.$id_sales_order.', '.$id_transaction_role_new.', '."'$sales_order_number'".', '."'$transaction_name_new'".');">'.$transaction_name.'</div>';
				            	}
				            	else {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            	}
				            }
				            else {
				            	$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            }

				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.($no+1).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2; color:yellow;" onClick="detail_receipt('."'$sales_order_number_format'".');">'.$sales_order_number.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$account_name.'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.date_format(date_create($sales_order_date), 'd M Y').'</div>';
				            $row[] = $approve;
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.$total_qty.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($sub_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($discount_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($total_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.$cNmPegawai_approval.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_sales_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_sales_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_sales_order_line($key_session, $id_sales_order_line){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('3');
			$id_sales_order_line_get = $this->uri->segment('4');
			if ($key_session_get!=$key_session) {
				$this->load->view('login');
			}
			else {
				$result_sales_order_line = $this->m_distributionread->list_sales_order_line($company_id_session, $id_sales_order_line_get);
		        $data_array = array();
		        if (count($result_sales_order_line)==0) {
		        	$status = 0;
		        }
		        else {
			        foreach ($result_sales_order_line as $sales_order_line_list) {
			        	$status = 1;
			        	$data = array(
							'id_sales_order_line' => $sales_order_line_list->id_sales_order_line,
							'company_id' => $sales_order_line_list->company_id,
							'company_name' => $sales_order_line_list->company_name,
							'sales_order_number' => $sales_order_line_list->sales_order_number,
							'id_sales_order' => $sales_order_line_list->id_sales_order,
							'line_number' => $sales_order_line_list->line_number,
							'id_job_order' => $sales_order_line_list->id_job_order,
							'JobNo' => $sales_order_line_list->JobNo,
							'JobName' => $sales_order_line_list->JobName,
							'description' => $sales_order_line_list->description,
							'qty_order_line' => $sales_order_line_list->qty_order_line,
							'qty_shipment_line' => $sales_order_line_list->qty_shipment_line,
							'id_uom' => $sales_order_line_list->id_uom,
							'uom_cd' => $sales_order_line_list->uom_cd,
							'uom_name' => $sales_order_line_list->uom_name,
							'cury_unit_price' => $sales_order_line_list->cury_unit_price,
							'unit_price' => $sales_order_line_list->unit_price,
							'cury_sub_amount' => $sales_order_line_list->cury_sub_amount,
							'sub_amount' => $sales_order_line_list->sub_amount,
							'cury_discount_amount' => $sales_order_line_list->cury_discount_amount,
							'discount_amount' => $sales_order_line_list->discount_amount,
							'discount_percent' => $sales_order_line_list->discount_percent,
							'cury_amount' => $sales_order_line_list->cury_amount,
							'amount' => $sales_order_line_list->amount,
							'id_sub_tax' => $sales_order_line_list->id_sub_tax,
							'sub_tax_cd' => $sales_order_line_list->sub_tax_cd,
							'sub_tax_name' => $sales_order_line_list->sub_tax_name,
							'id_coa' => $sales_order_line_list->id_coa,
							'coa_cd' => $sales_order_line_list->coa_cd,
							'coa_name' => $sales_order_line_list->coa_name,
							'line_status' => $sales_order_line_list->line_status,
							'create_by' => $sales_order_line_list->create_by,
							'cNmPegawai_create' => $sales_order_line_list->cNmPegawai_create,
							'create_date' => $sales_order_line_list->create_date,
							'last_by' => $sales_order_line_list->last_by,
							'cNmPegawai_last' => $sales_order_line_list->cNmPegawai_last,
							'last_update' => $sales_order_line_list->last_update,
							'id_coa_currency' => $sales_order_line_list->id_coa_currency,
							'coa_currency_cd' => $sales_order_line_list->coa_currency_cd,
							'coa_currency_name' => $sales_order_line_list->coa_currency_name,
							'decimal_after' => $sales_order_line_list->decimal_after,
						);
						array_push($data_array, $data);
			        }		 
		        }
		    	echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	// DO

		public function list_sales_order_select_for_delivery_order_datatable($key_session){
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
					$result_sales_order = $this->m_distributionread->list_sales_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_sales_order as $sales_order_list) {
			        	$id_transaction_role = $sales_order_list->id_transaction_role;
			        	$sequence = $sales_order_list->sequence;
			        	if ($sequence==3) {
			        		$decimal_after = $sales_order_list->decimal_after;
			        		$no++;
				            $row = array();
				            $row[] = '
				            			<input type="hidden" style="width:25px; height:25px;" value="'.$sales_order_list->id_sales_order.'" id="id_sales_order_'.$no.'">
				            			<input type="checkbox" style="width:25px; height:25px;" value="'.$sales_order_list->sales_order_number.'" id="sales_order_number_'.$no.'" class="sales_order_number" onclick="select_change_sales_order('.$no.');">';
				            $row[] = $sales_order_list->sales_order_number;
				            $row[] = $sales_order_list->account_name;
				            $row[] = date_format(date_create($sales_order_list->sales_order_date), 'd M Y');
				            $row[] = number_format($sales_order_list->total_amount, $decimal_after);
				 
				            $data[] = $row;
			        	}
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_sales_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_sales_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_sales_order_by_sales_order_number_for_delivery_order($key_session){
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
				$this->form_validation->set_rules('sales_order_number', 'sales_order_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$sales_order_number = $this->input->post('sales_order_number');
					$result_sales_order = $this->m_distributionread->list_sales_order_by_sales_order_number($company_id_session, $sales_order_number);
					$data_array = array();
					if (count($result_sales_order)==0) {
						$status = 0;
					}
					else {
						$status = 1;

						foreach ($result_sales_order as $resultList) {
							$sales_order_number = $resultList->sales_order_number;
							
							$result_sum_sales_order_line_by_sales_order_number = $this->m_distributionread->sum_sales_order_line_by_sales_order_number($company_id_session, $sales_order_number);
							
							$total_line = 0;
							$total_qty = 0;
							$sub_amount = 0;
							$discount_amount = 0;
							$amount = 0;

							foreach ($result_sum_sales_order_line_by_sales_order_number as $result_sum_sales_order_line_by_sales_order_number_list){
								$sales_order_line_qty = ($result_sum_sales_order_line_by_sales_order_number_list->sales_order_line_qty)*1;
								$sales_order_line_qty_delivery_order = ($result_sum_sales_order_line_by_sales_order_number_list->sales_order_line_qty_delivery_order)*1;
								
								$qty_open = $sales_order_line_qty-$sales_order_line_qty_delivery_order;
								$unit_price = $result_sum_sales_order_line_by_sales_order_number_list->unit_price;
								
								$sub_amount_line = $qty_open*$unit_price;
								$discount_amount_line = $result_sum_sales_order_line_by_sales_order_number_list->discount_amount;
								$amount_line = $sub_amount_line-$discount_amount_line;

								$id_sub_tax = $result_sum_sales_order_line_by_sales_order_number_list->id_sub_tax;

								$total_line += 1;
								$total_qty += $qty_open;
								$sub_amount += $sub_amount_line;
								$discount_amount += $discount_amount_line;
								$amount += $amount_line;
							}

							$id_sub_tax = $result_sum_sales_order_line_by_sales_order_number[0]->id_sub_tax;

							$result_sub_tax = $this->m_jomread->list_sub_tax($company_id_session, $id_sub_tax);
							$sub_tax_percent_plus = $result_sub_tax[0]->sub_tax_percent_plus;
							$sub_tax_percent_minus = $result_sub_tax[0]->sub_tax_percent_minus;
							$ppn = ($sub_tax_percent_plus/100)*$amount;
							$pph = ($sub_tax_percent_minus/100)*$amount;

							$total_amount = $amount+$ppn+$pph;

							$data = array (
								'id_sales_order' => $resultList->id_sales_order,
								'company_id' => $resultList->company_id,
								'company_name' => $resultList->company_name,
								'sales_order_number' => $resultList->sales_order_number,
								'sales_order_number_format' => str_replace('/', 'ZZ', $sales_order_number),
								'hold' => $resultList->hold,
								'id_transaction_role' => $resultList->id_transaction_role,
								'transaction_name' => $resultList->transaction_name,
								'sales_order_date' => $resultList->sales_order_date,
								'year' => $resultList->year,
								'periode' => $resultList->periode,
								'quotation_number' => $resultList->quotation_number,
								'note' => $resultList->note,
								'id_account' => $resultList->id_account,
								'account_cd' => $resultList->account_cd,
								'account_name' => $resultList->account_name,
								'id_account_project' => $resultList->id_account_project,
								'account_cd_project' => $resultList->account_cd_project,
								'account_name_project' => $resultList->account_name_project,
								'id_coa_currency' => $resultList->id_coa_currency,
								'coa_currency_cd' => $resultList->coa_currency_cd,
								'coa_currency_name' => $resultList->coa_currency_name,
								'decimal_after' => $resultList->decimal_after,
								'rate' => str_replace(',', '', number_format($resultList->rate, $decimal_after)),
								'sales_order_owner' => $resultList->sales_order_owner,
								'customer_order_number' => $resultList->customer_order_number,
								'cNmPegawai_sales_order_owner' => $resultList->cNmPegawai_sales_order_owner,
								'cNIK_approval' => $resultList->cNIK_approval,
								'cNmPegawai_approval' => $resultList->cNmPegawai_approval,
								'total_line' => $resultList->total_line,
								'total_qty' => $resultList->total_qty,
								'cury_sub_amount' => str_replace(',', '', number_format($resultList->cury_sub_amount, $decimal_after)),
								'sub_amount' => str_replace(',', '', number_format($resultList->sub_amount, $decimal_after)),
								'cury_discount_amount' => str_replace(',', '', number_format($resultList->cury_discount_amount, $decimal_after)),
								'discount_amount' => str_replace(',', '', number_format($resultList->discount_amount, $decimal_after)),
								'cury_amount' => str_replace(',', '', number_format($resultList->cury_amount, $decimal_after)),
								'amount' => str_replace(',', '', number_format($resultList->amount, $decimal_after)),
								'ppn' => str_replace(',', '', number_format($resultList->ppn, $decimal_after)),
								'pph' => str_replace(',', '', number_format($resultList->pph, $decimal_after)),
								'cury_total_amount' => str_replace(',', '', number_format($resultList->cury_total_amount, $decimal_after)),
								'total_amount' => str_replace(',', '', number_format($resultList->total_amount, $decimal_after)),
								'create_by' => $resultList->create_by,
								'cNmPegawai_create' => $resultList->cNmPegawai_create,
								'create_date' => $resultList->create_date,
								'last_by' => $resultList->last_by,
								'cNmPegawai_last' => $resultList->cNmPegawai_last,
								'last_update' => $resultList->last_update,
								'deleted' => $resultList->deleted,
							);
							array_push ($data_array, $data);
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

		public function delivery_order_line_blank($key_session, $transaction_number){
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
					
					$data = array();

			        $no = $_POST['start'];

			        $delivery_order_number_get = $this->uri->segment('4');
			        $delivery_order_number_header = str_replace('ZZ', '/', $delivery_order_number_get);

			        if ($delivery_order_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {

						$result_delivery_order_line = $this->m_distributionread->list_delivery_order_line_by_delivery_order_number($company_id_session, $delivery_order_number_header);
						$value_count = count($result_delivery_order_line);

						$aa=1;

						foreach ($result_delivery_order_line as $resultListLine){
							$decimal_after = $resultListLine->decimal_after;

							$id_delivery_order_line = $resultListLine->id_delivery_order_line;
							$company_id = $resultListLine->company_id;
							$company_name = $resultListLine->company_name;
							$delivery_order_number = $resultListLine->delivery_order_number;
							$id_sales_order_line = $resultListLine->id_sales_order_line;
							$line_number = $resultListLine->line_number;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$description = $resultListLine->description;
							$id_kit_assy = $resultListLine->id_kit_assy;
							$qty_order_line = $resultListLine->qty_order_line;
							$qty_shipment_line = $resultListLine->qty_shipment_line;
							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;
							$cury_unit_price = $resultListLine->cury_unit_price;
							$unit_price = $resultListLine->unit_price;
							$cury_sub_amount = $resultListLine->cury_sub_amount;
							$sub_amount = $resultListLine->sub_amount;
							$cury_discount_amount = $resultListLine->cury_discount_amount;
							$discount_amount = $resultListLine->discount_amount;
							$discount_percent = $resultListLine->discount_percent;
							$cury_amount = $resultListLine->cury_amount;
							$amount = $resultListLine->amount;
							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$cNmPegawai_create = $resultListLine->cNmPegawai_create;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$cNmPegawai_last = $resultListLine->cNmPegawai_last;
							$last_update = $resultListLine->last_update;
							$sales_order_number = $resultListLine->sales_order_number;
							$line_status_sales_order_line = $resultListLine->line_status_sales_order_line;
							$total_qty = $resultListLine->total_qty;
							$kit_assy_number = $resultListLine->kit_assy_number;

							$qty_open = $qty_order_line-$qty_shipment_line;

							$unit_price_format = number_format($unit_price, $decimal_after, '.', '');
							$sub_amount_format = number_format($sub_amount, $decimal_after, '.', '');
							$discount_amount_format = number_format($discount_amount, $decimal_after, '.', '');
							$amount_format = number_format($amount, $decimal_after, '.', '');

				            $row = array();
					            $row[] = '	<div id="div_line_1_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="hidden" class="bottom_border_only" id="id_delivery_order_line_'.$aa.'" value="'.$id_delivery_order_line.'">
					            				<input type="hidden" class="bottom_border_only" id="id_sales_order_line_on_delivery_order_line_'.$aa.'" value="'.$id_sales_order_line.'">
					            				<input type="text" class="bottom_border_only" id="sales_order_number_'.$aa.'" onClick="list_sales_order_line('.$aa.')"  value="'.$sales_order_number.'" placeholder="SO Number" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_2_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$aa.'" value="'.$id_job_order.'">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$aa.'" onClick="list_inventory('.$aa.')" placeholder="Job No" value="'.$JobNo.'">
						            		</div>';

					            $row[] = '	<div id="div_line_3_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$aa.'" placeholder="Description"  value="'.$description.'">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" onChange="price_calculation('.$aa.');" value="'.$qty_order_line.'"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($aa).'" style="height:45px; padding:5px;"><input type="number" class="bottom_border_only" id="qty_shipment_line_'.$aa.'" placeholder="Qty Shipment" onChange="price_calculation('.$aa.');"  value="'.$qty_shipment_line.'"></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_open_line_'.$aa.'" placeholder="Qty Open" readonly value="'.$qty_open.'"></div>'; // Qty Open
					            $row[] = '<div id="div_line_7_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'"></div>'; // UOM
					            $row[] = '<div id="div_line_8_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" placeholder="Unit Price" onChange="price_calculation('.$aa.');" value="'.$unit_price_format.'"></div>'; // Unit Price
					            $row[] = '<div id="div_line_9_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="sub_amount_line_'.$aa.'" placeholder="Line Amount" readonly value="'.$sub_amount_format.'"></div>'; // Line Amount
					            $row[] = '<div id="div_line_10_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$aa.'" placeholder="Discount Amount" onChange="price_calculation('.$aa.');" value="'.$discount_amount_format.'"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_11_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$aa.'" placeholder="Discount Percent" onChange="price_calculation('.$aa.');" value="'.$discount_percent.'"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_12_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="amount_line_'.$aa.'" placeholder="Line Amount" readonly value="'.$amount_format.'"></div>'; // Line Amount
					            $row[] = '<div id="div_line_13_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" onClick="list_sub_tax('.$aa.');" readonly value="'.$sub_tax_cd.'"></div>'; // Tax Category
					            $row[] = '<div id="div_line_14_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$aa.'" placeholder="Account" readonly value="'.$coa_cd.'"></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$aa.'" placeholder="Description" readonly value="'.$coa_name.'"></div>'; // Description
					            $row[] = '	<div id="div_line_16_'.($aa).'" style="height:45px; padding:5px;"><input type="hidden" id="id_kit_assy_line_'.$aa.'" value=""><input type="text" class="bottom_border_only sub_tax_cd" id="kit_assy_line_'.$aa.'" value="'.$kit_assy_number.'" placeholder="Kit Assembling" onClick="list_kit_assy('.$aa.');" readonly></div>'; // Kit Assy
				            	$row[] = '<div id="div_line_17_'.($aa).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;

				            $aa++;
						}
					}

					$total_line = 100;
					for ($a=($value_count+1); $a<=$total_line; $a++){
						$no++;
						if ($a==($value_count+1)) {
							$row = array();
					            $row[] = '	<div id="div_line_1_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="hidden" class="bottom_border_only" id="id_delivery_order_line_'.$no.'" value="">
					            				<input type="hidden" class="bottom_border_only" id="id_sales_order_line_on_delivery_order_line_'.$no.'">
					            				<input type="text" class="bottom_border_only" id="sales_order_number_'.$no.'" onClick="list_sales_order_line('.$no.')" placeholder="SO Number" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$no.'" value="">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$no.'" onClick="list_inventory('.$no.')" placeholder="Job No">
						            		</div>';

					            $row[] = '	<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$no.'" placeholder="Description">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$no.'" placeholder="Qty Order" onChange="price_calculation('.$no.');"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;"><input type="number" class="bottom_border_only" id="qty_shipment_line_'.$no.'" placeholder="Qty Shipment" onChange="price_calculation('.$no.');"></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_open_line_'.$no.'" placeholder="Qty Open" readonly></div>'; // Qty Open
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$no.'" placeholder="UOM"></div>'; // UOM
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$no.'" placeholder="Unit Price" onChange="price_calculation('.$no.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="sub_amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$no.'" placeholder="Discount Amount" onChange="price_calculation('.$no.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$no.'" placeholder="Discount Percent" onChange="price_calculation('.$no.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_13_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$no.'" placeholder="Tax Category" onClick="list_sub_tax('.$no.');" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_14_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$no.'" placeholder="Account" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$no.'" placeholder="Description" readonly></div>'; // Description
					            $row[] = '	<div id="div_line_16_'.($no).'" style="height:45px; padding:5px;"><input type="hidden" id="id_kit_assy_line_'.$no.'" value=""><input type="text" class="bottom_border_only sub_tax_cd" id="kit_assy_line_'.$no.'" placeholder="Kit Assembling" onClick="list_kit_assy('.$no.');" readonly></div>'; // Kit Assy
				            	$row[] = '<div id="div_line_17_'.($no).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$no.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;
						}
						else {
				            $row = array();
				            	$row[] = '	<div id="div_line_1_'.($no).'" style="height:45px;  display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_delivery_order_line_'.$no.'" value="">
				            					<input type="hidden" class="bottom_border_only" id="id_sales_order_line_on_delivery_order_line_'.$no.'">
					            				<input type="text" class="bottom_border_only" id="sales_order_number_'.$no.'" onClick="list_sales_order_line('.$no.')" placeholder="SO Number" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_2_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$no.'" value="">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$no.'" onClick="list_inventory('.$no.')" placeholder="Job No">
						            		</div>';

					            $row[] = '	<div id="div_line_3_'.($no).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$no.'" placeholder="Description">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$no.'" placeholder="Qty Order" onChange="price_calculation('.$no.');"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_shipment_line_'.$no.'" placeholder="Qty Receipt" readonly></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_open_line_'.$no.'" placeholder="Qty Open" readonly></div>'; // Qty Open
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$no.'" placeholder="UOM" onclick="list_uom('.$no.');"></div>'; // UOM
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$no.'" placeholder="Unit Price" onChange="price_calculation('.$no.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="sub_amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$no.'" placeholder="Discount Amount" onChange="price_calculation('.$no.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$no.'" placeholder="Discount Percent" onChange="price_calculation('.$no.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="amount_line_'.$no.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_13_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$no.'" placeholder="Tax Category" onClick="list_sub_tax('.$no.');" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_14_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$no.'" placeholder="Account" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$no.'" placeholder="Description" readonly></div>'; // Description
					            $row[] = '	<div id="div_line_16_'.($no).'" style="height:45px; display:none; padding:5px;"><input type="hidden" id="id_kit_assy_line_'.$no.'" value=""><input type="text" class="bottom_border_only sub_tax_cd" id="kit_assy_line_'.$no.'" placeholder="Kit Assembling" onClick="list_kit_assy('.$no.');" readonly></div>'; // Kit Assy
				            	$row[] = '<div id="div_line_17_'.($no).'" style="height:45px; display:none; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$no.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;						
						}
					}
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $total_line,
			            "recordsFiltered" => $total_line,
			            //"delivery_order_number" => $delivery_order_number_get.' '.$delivery_order_number_header,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_delivery_order_select_datatable($key_session){
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
					$result_delivery_order = $this->m_distributionread->list_delivery_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_delivery_order as $delivery_order_list) {
			        	$decimal_after = $delivery_order_list->decimal_after;
			        	$delivery_order_number = $delivery_order_list->delivery_order_number;
			        	$delivery_order_number_format = str_replace('/', 'ZZ', $delivery_order_number);

			            $no++;
			            $row = array();
			            $row[] = '
			            			<input type="hidden" style="width:25px; height:25px;" value="'.$delivery_order_list->id_delivery_order.'" id="id_delivery_order_'.$no.'" class="delivery_order_number">
			            			<input type="hidden" style="width:25px; height:25px;" value="'.$delivery_order_number_format.'" id="delivery_order_number_format_'.$no.'" class="delivery_order_number">
			            			<input type="checkbox" style="width:25px; height:25px;" value="'.$delivery_order_number.'" id="delivery_order_number_'.$no.'" class="delivery_order_number" onclick="select_change_delivery_order('.$no.');">
			            		';
			            $row[] = $delivery_order_list->delivery_order_number;
			            $row[] = $delivery_order_list->account_name;
			            $row[] = $delivery_order_list->delivery_order_date;
			            $row[] = number_format($delivery_order_list->total_amount, $decimal_after);
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_delivery_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_delivery_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_sales_order_line_for_delivery_order_datatable($key_session, $id_account, $id_account_project){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_account_get = $this->uri->segment('4');
				$id_account_project_get = $this->uri->segment('5');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_sales_order = $this->m_distributionread->list_sales_order_line_datatable($company_id_session, $id_account_get, $id_account_project_get);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_sales_order as $sales_order_list) {
			        	if ($sales_order_list->sequence == 3 || $sales_order_list->sequence == '3') {
			        		if ($sales_order_list->line_status == 0 || $sales_order_list->line_status == '0') {
				        		$decimal_after = $sales_order_list->decimal_after;
				        		$no++;
					            $row = array();
					            $row[] = '  <input type="hidden" style="width:25px; height:25px;" value="'.$sales_order_list->id_sales_order_line.'" id="id_sales_order_line_'.$no.'">
					            			<input type="checkbox" style="width:25px; height:25px;" value="'.$sales_order_list->sales_order_number.'" id="sales_order_number_'.$no.'" class="sales_order_number_class" onclick="select_change_sales_order_line('.$no.');">';
					            $row[] = $sales_order_list->sales_order_number;
					            $row[] = $sales_order_list->JobNo;
					            $row[] = $sales_order_list->description;
					            $row[] = $sales_order_list->qty_order_line;
					            $row[] = $sales_order_list->uom_cd;
					            $row[] = number_format($sales_order_list->unit_price, $decimal_after);
					            $row[] = number_format($sales_order_list->amount, $decimal_after);
					 
					            $data[] = $row;
			        		}
			        	}
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_sales_order_line_count_all($company_id_session, $id_account_get, $id_account_project_get),
			            "recordsFiltered" => $this->m_distributionread->list_sales_order_line_count_filtered($company_id_session, $id_account_get, $id_account_project_get),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_delivery_order_by_delivery_order_number($key_session){
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
				$this->form_validation->set_rules('delivery_order_number', 'delivery_order_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$delivery_order_number = $this->input->post('delivery_order_number');
					$result_delivery_order = $this->m_distributionread->list_delivery_order_by_delivery_order_number($company_id_session, $delivery_order_number);
					$data_array = array();
					if (count($result_delivery_order)==0) {
						$status = 0;
					}
					else {
						$status = 1;

						foreach ($result_delivery_order as $resultList) {
							$decimal_after = $resultList->decimal_after;
							$data = array (
								'id_delivery_order' => $resultList->id_delivery_order,
								'company_id' => $resultList->company_id,
								'company_name' => $resultList->company_name,
								'delivery_order_number' => $resultList->delivery_order_number,
								'delivery_order_number_format' => str_replace('/', 'ZZ', $delivery_order_number),
								'hold' => $resultList->hold,
								'id_transaction_role' => $resultList->id_transaction_role,
								'transaction_name' => $resultList->transaction_name,
								'delivery_order_date' => $resultList->delivery_order_date,
								'year' => $resultList->year,
								'periode' => $resultList->periode,
								'note' => $resultList->note,
								'id_account' => $resultList->id_account,
								'account_cd' => $resultList->account_cd,
								'account_name' => $resultList->account_name,
								'id_account_project' => $resultList->id_account_project,
								'account_cd_project' => $resultList->account_cd_project,
								'account_name_project' => $resultList->account_name_project,
								'id_coa_currency' => $resultList->id_coa_currency,
								'coa_currency_cd' => $resultList->coa_currency_cd,
								'coa_currency_name' => $resultList->coa_currency_name,
								'decimal_after' => $resultList->decimal_after,
								'rate' => str_replace(',', '', number_format($resultList->rate, $decimal_after)),
								'delivery_order_owner' => $resultList->delivery_order_owner,
								'cNmPegawai_delivery_order_owner' => $resultList->cNmPegawai_delivery_order_owner,
								'total_line' => $resultList->total_line,
								'total_qty' => $resultList->total_qty,
								'cury_sub_amount' => str_replace(',', '', number_format($resultList->cury_sub_amount, $decimal_after)),
								'sub_amount' => str_replace(',', '', number_format($resultList->sub_amount, $decimal_after)),
								'cury_discount_amount' => str_replace(',', '', number_format($resultList->cury_discount_amount, $decimal_after)),
								'discount_amount' => str_replace(',', '', number_format($resultList->discount_amount, $decimal_after)),
								'cury_amount' => str_replace(',', '', number_format($resultList->cury_amount, $decimal_after)),
								'amount' => str_replace(',', '', number_format($resultList->amount, $decimal_after)),
								'ppn' => str_replace(',', '', number_format($resultList->ppn, $decimal_after)),
								'pph' => str_replace(',', '', number_format($resultList->pph, $decimal_after)),
								'cury_total_amount' => str_replace(',', '', number_format($resultList->cury_total_amount, $decimal_after)),
								'total_amount' => str_replace(',', '', number_format($resultList->total_amount, $decimal_after)),
								'create_by' => $resultList->create_by,
								'cNmPegawai_create' => $resultList->cNmPegawai_create,
								'create_date' => $resultList->create_date,
								'last_by' => $resultList->last_by,
								'cNmPegawai_last' => $resultList->cNmPegawai_last,
								'last_update' => $resultList->last_update,
								'deleted' => $resultList->deleted,
							);
							array_push ($data_array, $data);
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

		public function list_delivery_order_datatable($key_session, $id_module){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_module = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_delivery_order = $this->m_distributionread->list_delivery_order_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_delivery_order as $delivery_order_list) {
			            $row = array();
				            $id_delivery_order = $delivery_order_list->id_delivery_order;
				            $delivery_order_number = $delivery_order_list->delivery_order_number;
				            $delivery_order_number_format = str_replace('/', 'ZZ', $delivery_order_number);
				            $account_name = $delivery_order_list->account_name;
				            $delivery_order_date = $delivery_order_list->delivery_order_date;
				            $id_transaction_role = $delivery_order_list->id_transaction_role;
				            $sequence = $delivery_order_list->sequence;
				            $transaction_name = $delivery_order_list->transaction_name;
				            $total_qty = $delivery_order_list->total_qty;
				            $sub_amount = $delivery_order_list->sub_amount;
				            $discount_amount = $delivery_order_list->discount_amount;
				            $ppn = $delivery_order_list->ppn;
				            $pph = $delivery_order_list->pph;
				            $total_amount = $delivery_order_list->total_amount;
				            $decimal_after = $delivery_order_list->decimal_after;
				            $cNIK_approval = $delivery_order_list->cNIK_approval;
				            $cNmPegawai_approval = $delivery_order_list->cNmPegawai_approval;

				            $sequence_new = ($sequence*1)+1;

				            $result_transaction_role = $this->m_distributionread->list_transaction_role_by_sequence($company_id_session, $id_module, $sequence_new);
				            $id_transaction_role_new = $result_transaction_role[0]->id_transaction_role;
				            $transaction_name_new = $result_transaction_role[0]->transaction_name;

				            if (in_array($cNIK_session, array('16L10294', $cNIK_approval))) {
				            	if ($sequence==2) {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px; color:red;" align="center" onClick="approve('.($no+1).', '.$id_delivery_order.', '.$id_transaction_role_new.', '."'$delivery_order_number'".', '."'$transaction_name_new'".');">'.$transaction_name.'</div>';
				            	}
				            	else {
				            		$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            	}
				            }
				            else {
				            	$approve = '<div id="transaction_name_'.($no+1).'" style="height:45px; padding:5px;" align="center">'.$transaction_name.'</div>';
				            }

				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;" align="center">'.($no+1).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2; color:yellow;" onClick="detail_receipt('."'$delivery_order_number_format'".');">'.$delivery_order_number.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">'.$account_name.'</div>';
				            $row[] = '<div style="height:45px; padding:5px;" align="center">'.date_format(date_create($delivery_order_date), 'd M Y').'</div>';
				            $row[] = $approve;
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.$total_qty.'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($sub_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($discount_amount, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div style="height:45px; padding:5px; padding-right:25px;" align="right">'.number_format($total_amount, $decimal_after).'</div>';
				            //$row[] = '<div style="height:45px; padding:5px;" align="center">'.$cNmPegawai_approval.'</div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_delivery_order_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_delivery_order_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	// SI

		public function sales_invoice_line_blank($key_session, $transaction_number){
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
					
					$data = array();

			        $no = $_POST['start'];

			        $sales_invoice_number_get = $this->uri->segment('4');
			        $sales_invoice_number_header = str_replace('ZZ', '/', $sales_invoice_number_get);

			        if ($sales_invoice_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {

						$result_sales_invoice_line = $this->m_distributionread->list_sales_invoice_line_by_sales_invoice_number($company_id_session, $sales_invoice_number_header);
						$value_count = count($result_sales_invoice_line);

						$aa=1;

						foreach ($result_sales_invoice_line as $resultListLine){

							$decimal_after = $resultListLine->decimal_after;

							$id_sales_invoice_line = $resultListLine->id_sales_invoice_line;
							$id_delivery_order_line = $resultListLine->id_delivery_order_line;
							$company_id = $resultListLine->company_id;
							$company_name = $resultListLine->company_name;
							$delivery_order_number = $resultListLine->delivery_order_number;
							$line_number = $resultListLine->line_number;
							$id_job_order = $resultListLine->id_job_order;
							$JobNo = $resultListLine->JobNo;
							$description = $resultListLine->description;
							$qty_shipment_line = ($resultListLine->qty_shipment_line)*1;
							$qty_invoice_line = ($resultListLine->qty_invoice_line)*1;
							$id_uom = $resultListLine->id_uom;
							$uom_cd = $resultListLine->uom_cd;
							$uom_name = $resultListLine->uom_name;
							$cury_unit_price = $resultListLine->cury_unit_price;
							$unit_price = $resultListLine->unit_price;
							$cury_sub_amount = $resultListLine->cury_sub_amount;
							$sub_amount = $resultListLine->sub_amount;
							$cury_discount_amount = $resultListLine->cury_discount_amount;
							$discount_amount = $resultListLine->discount_amount;
							$discount_percent = $resultListLine->discount_percent;
							$cury_amount = $resultListLine->cury_amount;
							$amount = $resultListLine->amount;
							$id_sub_tax = $resultListLine->id_sub_tax;
							$sub_tax_cd = $resultListLine->sub_tax_cd;
							$sub_tax_name = $resultListLine->sub_tax_name;
							$id_coa = $resultListLine->id_coa;
							$coa_cd = $resultListLine->coa_cd;
							$coa_name = $resultListLine->coa_name;
							$line_status = $resultListLine->line_status;
							$create_by = $resultListLine->create_by;
							$cNmPegawai_create = $resultListLine->cNmPegawai_create;
							$create_date = $resultListLine->create_date;
							$last_by = $resultListLine->last_by;
							$cNmPegawai_last = $resultListLine->cNmPegawai_last;
							$last_update = $resultListLine->last_update;

							$qty_open = $qty_invoice_line-$qty_shipment_line;

							$unit_price_format = number_format($unit_price, $decimal_after, '.', '');
							$sub_amount_format = number_format($sub_amount, $decimal_after, '.', '');
							$discount_amount_format = number_format($discount_amount, $decimal_after, '.', '');
							$amount_format = number_format($amount, $decimal_after, '.', '');

				            $row = array();
					            $row[] = '	<div id="div_line_1_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="hidden" class="bottom_border_only" id="id_sales_invoice_line_'.$aa.'" value="'.$id_sales_invoice_line.'">
					            				<input type="hidden" class="bottom_border_only" id="id_delivery_order_line_'.$aa.'" value="'.$id_delivery_order_line.'">
					            				<input type="text" class="bottom_border_only" id="delivery_order_number_'.$aa.'" onClick="list_delivery_order_line('.$aa.')" value="'.$delivery_order_number.'" placeholder="DO Number" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_2_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$aa.'" value="'.$id_job_order.'">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$aa.'" onClick="list_inventory('.$aa.')" value="'.$JobNo.'" placeholder="Job No">
						            		</div>';

					            $row[] = '	<div id="div_line_3_'.($aa).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$aa.'" placeholder="Description" value="'.$description.'">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_shipment_line_'.$aa.'" placeholder="Qty Shipment" value="'.$qty_shipment_line.'" readonly></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($aa).'" style="height:45px; padding:5px;"><input type="number" class="bottom_border_only" id="qty_invoice_line_'.$aa.'" placeholder="Qty Invoice" value="'.$qty_invoice_line.'" onChange="price_calculation('.$aa.');"></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_open_line_'.$aa.'" placeholder="Qty Open" value="'.$qty_open.'" readonly></div>'; // Qty Open
					            $row[] = '<div id="div_line_7_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" onclick="list_uom('.$aa.');" readonly></div>'; // UOM
					            $row[] = '<div id="div_line_8_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price_format.'" placeholder="Unit Price" onChange="price_calculation('.$aa.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_9_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="sub_amount_line_'.$aa.'" value="'.$sub_amount_format.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_10_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$aa.'" value="'.$discount_amount_format.'" placeholder="Discount Amount" onChange="price_calculation('.$aa.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_11_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'" placeholder="Discount Percent" onChange="price_calculation('.$aa.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_12_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="amount_line_'.$aa.'" value="'.$amount_format.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_13_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" value="'.$sub_tax_cd.'" onClick="list_sub_tax('.$aa.');" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_14_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$aa.'" placeholder="Account" value="'.$coa_cd.'" onClick="list_coa('.$aa.');" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($aa).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$aa.'" placeholder="Description" value="'.$coa_name.'" readonly></div>'; // Description
				            	$row[] = '<div id="div_line_17_'.($aa).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;

				            $aa++;
						}
					}

					$total_line = 100;
					for ($a=($value_count+1); $a<=$total_line; $a++){
						$no++;
						if ($a==($value_count+1)) {
							$row = array();
					            $row[] = '	<div id="div_line_1_'.($a).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="hidden" class="bottom_border_only" id="id_sales_invoice_line_'.$a.'" value="">
					            				<input type="hidden" class="bottom_border_only" id="id_delivery_order_line_'.$a.'">
					            				<input type="text" class="bottom_border_only" id="delivery_order_number_'.$a.'" onClick="list_delivery_order_line('.$a.')" placeholder="DO Number" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_2_'.($a).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$a.'" value="">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$a.'" onClick="list_inventory('.$a.')" placeholder="Job No">
						            		</div>';

					            $row[] = '	<div id="div_line_3_'.($a).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$a.'" placeholder="Description">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_shipment_line_'.$a.'" placeholder="Qty Shipment" value="0" readonly></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($a).'" style="height:45px; padding:5px;"><input type="number" class="bottom_border_only" id="qty_invoice_line_'.$a.'" placeholder="Qty Invoice" value="0" onChange="price_calculation('.$a.');"></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_open_line_'.$a.'" placeholder="Qty Open" value="0" readonly></div>'; // Qty Open
					            $row[] = '<div id="div_line_7_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$a.'" placeholder="UOM" onclick="list_uom('.$a.');" readonly></div>'; // UOM
					            $row[] = '<div id="div_line_8_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$a.'" value="0" placeholder="Unit Price" onChange="price_calculation('.$a.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_9_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="sub_amount_line_'.$a.'" value="0" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_10_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$a.'" value="0" placeholder="Discount Amount" onChange="price_calculation('.$a.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_11_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" value="0" id="discount_percent_line_'.$a.'" placeholder="Discount Percent" onChange="price_calculation('.$a.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_12_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_13_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$a.'" placeholder="Tax Category" onClick="list_sub_tax('.$a.');" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_14_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$a.'" placeholder="Account" onClick="list_coa('.$a.');" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($a).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$a.'" placeholder="Description" readonly></div>'; // Description
				            	$row[] = '<div id="div_line_17_'.($a).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$a.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;
						}
						else {
				            $row = array();
				            	$row[] = '	<div id="div_line_1_'.($a).'" style="height:45px;  display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_sales_invoice_line_'.$a.'" value="">
				            					<input type="hidden" class="bottom_border_only" id="id_delivery_order_line_'.$a.'">
					            				<input type="text" class="bottom_border_only" id="delivery_order_number_'.$a.'" onClick="list_delivery_order_line('.$a.')" placeholder="DO Number" readonly>
					            			</div>';

					            $row[] = '	<div id="div_line_2_'.($a).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
						            			<input type="hidden" class="bottom_border_only" id="id_job_order_'.$a.'" value="">
						            			<input type="text" class="bottom_border_only" id="JobNo_'.$a.'" onClick="list_inventory('.$a.')" placeholder="Job No">
						            		</div>';

					            $row[] = '	<div id="div_line_3_'.($a).'" style="height:45px; display:none; padding:5px; background-color: #191c24 !important; z-index: 2;">
					            				<input type="text" class="bottom_border_only" id="description_'.$a.'" placeholder="Description">
					            			</div>';

					            $row[] = '<div id="div_line_4_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_shipment_line_'.$a.'" placeholder="Qty Shipment" value="0" readonly></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_invoice_line_'.$a.'" placeholder="Qty Invoice" value="0" onChange="price_calculation('.$a.');" ></div>'; // Qty Shipment
					            $row[] = '<div id="div_line_6_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="qty_open_line_'.$a.'" value="0" placeholder="Qty Open" readonly></div>'; // Qty Open
					            $row[] = '<div id="div_line_7_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$a.'" placeholder="UOM" onclick="list_uom('.$a.');" readonly></div>'; // UOM
					            $row[] = '<div id="div_line_8_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$a.'" value="0" placeholder="Unit Price" onChange="price_calculation('.$a.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_9_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="sub_amount_line_'.$a.'" value="0" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_10_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$a.'" value="0" placeholder="Discount Amount" onChange="price_calculation('.$a.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_11_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" value="0" id="discount_percent_line_'.$a.'" placeholder="Discount Percent" onChange="price_calculation('.$a.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_12_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="amount_line_'.$a.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_13_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$a.'" placeholder="Tax Category" onClick="list_sub_tax('.$a.');" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_14_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$a.'" placeholder="Account" onClick="list_coa('.$a.');" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$a.'" placeholder="Description" readonly></div>'; // Description
					           // $row[] = '	<div id="div_line_16_'.($a).'" style="height:45px; display:none; padding:5px;"><input type="hidden" id="id_kit_assy_line_'.$a.'" value=""><input type="text" class="bottom_border_only sub_tax_cd" id="kit_assy_line_'.$a.'" placeholder="Kit Assembling" onClick="list_kit_assy('.$a.');" readonly></div>'; // Kit Assy
				            	$row[] = '<div id="div_line_17_'.($a).'" style="height:45px; display:none; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$a.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;						
						}
					}
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $total_line,
			            "recordsFiltered" => $total_line,
			            //"delivery_order_number" => $delivery_order_number_get.' '.$delivery_order_number_header,
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

		public function list_delivery_order_line_for_sales_invoice_datatable($key_session, $id_account){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$id_account_get = $this->uri->segment('4');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_delivery_order = $this->m_distributionread->list_delivery_order_line_datatable($company_id_session, $id_account_get);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_delivery_order as $delivery_order_list) {
			        	if ($delivery_order_list->sequence == 3 || $delivery_order_list->sequence == '3') {
			        		if ($delivery_order_list->line_status == 0 || $delivery_order_list->line_status == '0') {
				        		$decimal_after = $delivery_order_list->decimal_after;
				        		$no++;
					            $row = array();
					            $row[] = '  <input type="hidden" style="width:25px; height:25px;" value="'.$delivery_order_list->id_delivery_order_line.'" id="id_delivery_order_linex_'.$no.'">
					            			<input type="checkbox" style="width:25px; height:25px;" value="'.$delivery_order_list->delivery_order_number.'" id="delivery_order_number_'.$no.'" class="delivery_order_number_class" onclick="select_change_delivery_order_line('.$no.');">';
					            $row[] = $delivery_order_list->delivery_order_number;
					            $row[] = $delivery_order_list->JobNo;
					            $row[] = $delivery_order_list->description;
					            $row[] = $delivery_order_list->qty_shipment_line;
					            $row[] = $delivery_order_list->uom_cd;
					            $row[] = number_format($delivery_order_list->unit_price, $decimal_after);
					            $row[] = number_format($delivery_order_list->amount, $decimal_after);
					 
					            $data[] = $row;
			        		}
			        	}
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_delivery_order_line_count_all($company_id_session, $id_account_get),
			            "recordsFiltered" => $this->m_distributionread->list_delivery_order_line_count_filtered($company_id_session, $id_account_get),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_delivery_order_line($key_session, $id_delivery_order_line){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');
		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('3');
			$id_delivery_order_line_get = $this->uri->segment('4');
			if ($key_session_get!=$key_session) {
				$this->load->view('login');
			}
			else {
				$result_delivery_order_line = $this->m_distributionread->list_delivery_order_line($company_id_session, $id_delivery_order_line_get);
		        $data_array = array();
		        if (count($result_delivery_order_line)==0) {
		        	$status = 0;
		        }
		        else {
			        foreach ($result_delivery_order_line as $delivery_order_line_list) {
			        	$status = 1;
			        	$data = array(
							'id_delivery_order_line' => $delivery_order_line_list->id_delivery_order_line,
							'company_id' => $delivery_order_line_list->company_id,
							'company_name' => $delivery_order_line_list->company_name,
							'delivery_order_number' => $delivery_order_line_list->delivery_order_number,
							'id_sales_order_line' => $delivery_order_line_list->id_sales_order_line,
							'line_number' => $delivery_order_line_list->line_number,
							'id_job_order' => $delivery_order_line_list->id_job_order,
							'description' => $delivery_order_line_list->description,
							'id_kit_assy' => $delivery_order_line_list->id_kit_assy,
							'qty_order_line' => $delivery_order_line_list->qty_order_line,
							'qty_shipment_line' => $delivery_order_line_list->qty_shipment_line,
							'id_uom' => $delivery_order_line_list->id_uom,
							'uom_cd' => $delivery_order_line_list->uom_cd,
							'uom_name' => $delivery_order_line_list->uom_name,
							'cury_unit_price' => $delivery_order_line_list->cury_unit_price,
							'unit_price' => $delivery_order_line_list->unit_price,
							'cury_sub_amount' => $delivery_order_line_list->cury_sub_amount,
							'sub_amount' => $delivery_order_line_list->sub_amount,
							'cury_discount_amount' => $delivery_order_line_list->cury_discount_amount,
							'discount_amount' => $delivery_order_line_list->discount_amount,
							'discount_percent' => $delivery_order_line_list->discount_percent,
							'cury_amount' => $delivery_order_line_list->cury_amount,
							'amount' => $delivery_order_line_list->amount,
							'id_sub_tax' => $delivery_order_line_list->id_sub_tax,
							'sub_tax_cd' => $delivery_order_line_list->sub_tax_cd,
							'sub_tax_name' => $delivery_order_line_list->sub_tax_name,
							'id_coa' => $delivery_order_line_list->id_coa,
							'coa_cd' => $delivery_order_line_list->coa_cd,
							'coa_name' => $delivery_order_line_list->coa_name,
							'line_status' => $delivery_order_line_list->line_status,
							'create_by' => $delivery_order_line_list->create_by,
							'cNmPegawai_create' => $delivery_order_line_list->cNmPegawai_create,
							'create_date' => $delivery_order_line_list->create_date,
							'last_by' => $delivery_order_line_list->last_by,
							'cNmPegawai_last' => $delivery_order_line_list->cNmPegawai_last,
							'last_update' => $delivery_order_line_list->last_update,
							'sales_order_number' => $delivery_order_line_list->sales_order_number,
							'line_status_sales_order_line' => $delivery_order_line_list->line_status_sales_order_line,
							'total_qty' => $delivery_order_line_list->total_qty,
							'JobNo' => $delivery_order_line_list->JobNo,
							'JobName' => $delivery_order_line_list->JobName,
							'kit_assy_number' => $delivery_order_line_list->kit_assy_number,
							'id_account' => $delivery_order_line_list->id_account,
							'id_account_project' => $delivery_order_line_list->id_account_project,
							'decimal_after' => $delivery_order_line_list->decimal_after,
							'coa_currency_name' => $delivery_order_line_list->coa_currency_name,
							'coa_currency_cd' => $delivery_order_line_list->coa_currency_cd,
							'sequence' => $delivery_order_line_list->sequence,
							'transaction_name' => $delivery_order_line_list->transaction_name,
						);
						array_push($data_array, $data);
			        }		 
		        }
		    	echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

		public function list_sales_invoice_select_datatable($key_session){
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
					$result_sales_invoice = $this->m_distributionread->list_sales_invoice_datatable($company_id_session);
			        $data = array();
			        $no = $_POST['start'];
			        foreach ($result_sales_invoice as $sales_invoice_list) {
			        	$decimal_after = $sales_invoice_list->decimal_after;
			        	$sales_invoice_number = $sales_invoice_list->sales_invoice_number;
			        	$sales_invoice_number_format = str_replace('/', 'ZZ', $sales_invoice_number);

			            $no++;
			            $row = array();
			            $row[] = '
			            			<input type="hidden" style="width:25px; height:25px;" value="'.$sales_invoice_list->id_sales_invoice.'" id="id_sales_invoice_'.$no.'" class="sales_invoice_number">
			            			<input type="hidden" style="width:25px; height:25px;" value="'.$sales_invoice_number_format.'" id="sales_invoice_number_format_'.$no.'" class="sales_invoice_number">
			            			<input type="checkbox" style="width:25px; height:25px;" value="'.$sales_invoice_number.'" id="sales_invoice_number_'.$no.'" class="sales_invoice_number" onclick="select_change_sales_invoice('.$no.');">
			            		';
			            $row[] = $sales_invoice_list->sales_invoice_number;
			            $row[] = $sales_invoice_list->account_name;
			            $row[] = $sales_invoice_list->customer_order_number;
			            $row[] = $sales_invoice_list->sales_invoice_date;
			            $row[] = number_format($sales_invoice_list->total_amount, $decimal_after);
			 
			            $data[] = $row;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_distributionread->list_sales_invoice_count_all($company_id_session),
			            "recordsFiltered" => $this->m_distributionread->list_sales_invoice_count_filtered($company_id_session),
			            "data" => $data,
			        );
			        echo json_encode($output);
				}
			}
		}

	public function list_sales_invoice_by_sales_invoice_number($key_session){
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
				$this->form_validation->set_rules('sales_invoice_number', 'sales_invoice_number', 'required');
		 
				if ($this->form_validation->run() == false){
					$status = 0;
					$responseValue = 'Form Validation is Invalid.';
				}
				else {
					$sales_invoice_number = $this->input->post('sales_invoice_number');
					$result_sales_invoice = $this->m_distributionread->list_sales_invoice_by_sales_invoice_number($company_id_session, $sales_invoice_number);
					$data_array = array();
					if (count($result_sales_invoice)==0) {
						$status = 0;
					}
					else {
						$status = 1;
						foreach ($result_sales_invoice as $resultList) {
							$decimal_after = $resultList->decimal_after;
							$data = array (
								'id_sales_invoice' => $resultList->id_sales_invoice,
								'company_id' => $resultList->company_id,
								'company_name' => $resultList->company_name,
								'sales_invoice_number' => $resultList->sales_invoice_number,
								'sales_invoice_number_format' => str_replace('/', 'ZZ', $sales_invoice_number),
								'hold' => $resultList->hold,
								'id_transaction_role' => $resultList->id_transaction_role,
								'transaction_name' => $resultList->transaction_name,
								'sales_invoice_date' => $resultList->sales_invoice_date,
								'year' => $resultList->year,
								'periode' => $resultList->periode,
								'note' => $resultList->note,
								'id_account' => $resultList->id_account,
								'account_cd' => $resultList->account_cd,
								'account_name' => $resultList->account_name,
								'id_coa_currency' => $resultList->id_coa_currency,
								'coa_currency_cd' => $resultList->coa_currency_cd,
								'coa_currency_name' => $resultList->coa_currency_name,
								'decimal_after' => $resultList->decimal_after,
								'rate' => str_replace(',', '', number_format($resultList->rate, $decimal_after)),
								'id_payment_methode' => $resultList->id_payment_methode,
								'payment_methode_cd' => $resultList->payment_methode_cd,
								'payment_methode_name' => $resultList->payment_methode_name,
								'id_payment_terms' => $resultList->id_payment_terms,
								'payment_terms_cd' => $resultList->payment_terms_cd,
								'payment_terms_name' => $resultList->payment_terms_name,
								'tax_number' => $resultList->tax_number,
								'sales_invoice_owner' => $resultList->sales_invoice_owner,
								'customer_order_number' => $resultList->customer_order_number,
								'cNmPegawai_sales_invoice_owner' => $resultList->cNmPegawai_owner,
								'cNIK_approval' => $resultList->cNIK_approval,
								'cNmPegawai_approval' => $resultList->cNmPegawai_approval,
								'total_line' => $resultList->total_line,
								'total_qty' => $resultList->total_qty,
								'close_transaction' => $resultList->close_transaction,
								'cury_sub_amount' => str_replace(',', '', number_format($resultList->cury_sub_amount, $decimal_after)),
								'sub_amount' => str_replace(',', '', number_format($resultList->sub_amount, $decimal_after)),
								'cury_discount_amount' => str_replace(',', '', number_format($resultList->cury_discount_amount, $decimal_after)),
								'discount_amount' => str_replace(',', '', number_format($resultList->discount_amount, $decimal_after)),
								'cury_amount' => str_replace(',', '', number_format($resultList->cury_amount, $decimal_after)),
								'amount' => str_replace(',', '', number_format($resultList->amount, $decimal_after)),
								'ppn' => str_replace(',', '', number_format($resultList->ppn, $decimal_after)),
								'pph' => str_replace(',', '', number_format($resultList->pph, $decimal_after)),
								'cury_total_amount' => str_replace(',', '', number_format($resultList->cury_total_amount, $decimal_after)),
								'total_amount' => str_replace(',', '', number_format($resultList->total_amount, $decimal_after)),
								'create_by' => $resultList->create_by,
								'cNmPegawai_create' => $resultList->cNmPegawai_create,
								'create_date' => $resultList->create_date,
								'last_by' => $resultList->last_by,
								'cNmPegawai_last' => $resultList->cNmPegawai_last,
								'last_update' => $resultList->last_update,
								'deleted' => $resultList->deleted,
							);
							array_push ($data_array, $data);
						}
					}
				}
				echo json_encode (array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}
}