<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class DailyReportRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_dailyreportread');
        $this->load->model('m_jomread');
        //$this->load->model('m_essupdate');
        //$this->load->model('m_ess');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// Distribution
	// Setting

	public function list_machine_group($key_session, $id_machine_group){
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
				$id_machine_group = $this->uri->segment('4');
				$result = $this->m_dailyreportread->list_machine_group($company_id_session, $id_machine_group);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$machine_group_id = $resultList->machine_group_id;
						$machine_group_code = $resultList->machine_group_code;
						$machine_group_name = $resultList->machine_group_name;
						$deleted = $resultList->deleted;

						$data = array(
							'machine_group_id' => $machine_group_id,
							'machine_group_code' => $machine_group_code,
							'machine_group_name' => $machine_group_name,
							'deleted' => $deleted,
						);
						array_push ($data_array, $data);
					}					
				}				
				echo json_encode(array(array('status' => $status, 'response' => $data_array)));
			}
		}
	}

	public function list_machine($key_session, $id_machine){
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
				$id_machine = $this->uri->segment('4');
				$result = $this->m_dailyreportread->list_machine($company_id_session, $id_machine);
				$data_array = array();
				if (count($result)==0) {
					$status = 0;
				}
				else {
					$status = 1;
					foreach ($result as $resultList){
						$machine_id = $resultList->machine_id;
						$machine_code = $resultList->machine_code;
						$machine_code_koutei = $resultList->machine_code_koutei;
						$machine_name = $resultList->machine_name;
						$deleted = $resultList->deleted;

						$data = array(
							'machine_id' => $machine_id,
							'machine_code' => $machine_code,
							'machine_code_koutei' => $machine_code_koutei,
							'machine_name' => $machine_name,
							'deleted' => $deleted,
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

			        $no = $_POST['start'];

			        $purchase_order_number_get = $this->uri->segment('4');
			        $purchase_order_number_header = str_replace('XX', '/', $purchase_order_number_get);

			        if ($purchase_order_number_get=='0') {
			        	$value_count = 0;
			        }
			        else {

						$result_purchase_order_line = $this->m_dailyreportread->list_purchase_order_line_by_purchase_order_number($company_id_session, $purchase_order_number_header);
						$value_count = count($result_purchase_order_line);

						$aa=1;

						foreach ($result_purchase_order_line as $resultListLine){
							$id_purchase_order_line = $resultListLine->id_purchase_order_line;
							$company_id = $resultListLine->company_id;
							$purchase_order_number = $resultListLine->purchase_order_number;
							//$purchase_order_number_format = str_replace('XX', '-', $purchase_order_number);
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
					            $row[] = '<div id="div_line_2_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="hidden" class="bottom_border_only" id="id_purchase_order_line_'.$aa.'" value="'.$id_purchase_order_line.'"><input type="hidden" class="bottom_border_only" id="id_inventory_line_'.$aa.'" value="'.$id_inventory.'"><input type="hidden" class="bottom_border_only" id="id_part_list_line_'.$aa.'" value="'.$id_part_list.'"><input type="text" class="bottom_border_only" id="inventory_cd_line_'.$aa.'" onClick="list_inventory('.$aa.')" placeholder="Inventory ID" value="'.$inventory_cd.'"></div>';
					            $row[] = '<div id="div_line_3_'.($no).'" style="height:45px; padding:5px; background-color: #191c24 !important; z-index: 2;"><input type="text" class="bottom_border_only" id="inventory_name_line_'.$aa.'" placeholder="Inventory Name" value="'.$description.'"></div>';
					            $row[] = '<div id="div_line_1_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only JobNo" id="JobNo_line_'.$aa.'" placeholder="Job" value="'.$JobNo.'" readonly></div>'; // Job
					            $row[] = '<div id="div_line_4_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_order_line_'.$aa.'" placeholder="Qty Order" value="'.$purchase_order_line_qty.'" onChange="price_calculation('.$aa.');"></div>'; // Qty order
					            $row[] = '<div id="div_line_5_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="qty_receipt_line_'.$aa.'" placeholder="Qty Receipt" value="'.$purchase_order_line_qty_purchase_receipt.'" readonly></div>'; // Qty Receipt
					            $row[] = '<div id="div_line_6_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only uom_cd" id="uom_cd_line_'.$aa.'" placeholder="UOM" value="'.$uom_cd.'" onclick="list_uom('.$aa.');"></div>'; // UOM
					            $row[] = '<div id="div_line_7_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="unit_price_line_'.$aa.'" value="'.$unit_price.'" placeholder="Unit Price" onChange="price_calculation('.$aa.');"></div>'; // Unit Price
					            $row[] = '<div id="div_line_8_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_sub_amount_line_'.$aa.'" value="'.$sub_amount.'" placeholder="Line Amount" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_9_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="discount_amount_line_'.$aa.'" value="'.$discount_amount.'" placeholder="Discount Amount" onChange="price_calculation('.$aa.');"></div>'; // Discount Amount
					            $row[] = '<div id="div_line_10_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" max="100" id="discount_percent_line_'.$aa.'" value="'.$discount_percent.'" placeholder="Discount Percent" onChange="price_calculation('.$aa.');"></div>'; // Discount Percent
					            $row[] = '<div id="div_line_11_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" style="text-align:right" id="line_amount_line_'.$aa.'" placeholder="Line Amount" value="'.$amount.'" readonly></div>'; // Line Amount
					            $row[] = '<div id="div_line_12_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only sub_tax_cd" id="sub_tax_cd_line_'.$aa.'" placeholder="Tax Category" onClick="list_sub_tax('.$aa.');" value="'.$sub_tax_cd.'" readonly></div>'; // Tax Category
					            $row[] = '<div id="div_line_13_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only item_class_cd" id="item_class_cd_line_'.$aa.'" placeholder="Item Class" readonly onClick="list_item_class('.$aa.');" value="'.$item_class_cd.'"></div>'; // Account
					            $row[] = '<div id="div_line_14_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only coa_cd" id="coa_cd_line_'.$aa.'" placeholder="Account" onClick="list_coa('.$aa.');" value="'.$coa_cd.'" readonly></div>'; // Account
					            $row[] = '<div id="div_line_15_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="coa_name_line_'.$aa.'" placeholder="Description" value="'.$coa_name.'" readonly></div>'; // Description
					            $row[] = '<div id="div_line_16_'.($no).'" style="height:45px; padding:5px;"><input type="text" class="bottom_border_only" id="warehouse_name_line_'.$aa.'" placeholder="Warehouse" value="'.$warehouse_name.'" onClick="list_warehouse('.$a.');" readonly></div>'; // Warehouse
				            	$row[] = '<div id="div_line_17_'.($no).'" style="height:45px; padding:5px;" align="center"><button class="btn btn-danger" onClick="remove_line('.$aa.');"><i class="mdi mdi-delete-forever"></i></button></div>'; // Delete
				            $data[] = $row;

				            $aa++;
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
}