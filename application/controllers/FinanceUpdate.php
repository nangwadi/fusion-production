<?php
	error_reporting(0);
	defined('BASEPATH') OR exit('No direct script access allowed');

	class FinanceUpdate extends CI_Controller {

		function __construct(){
			parent::__construct();
			$this->load->library('form_validation');
	        $this->load->library('session');
			$this->load->database();
	        $this->load->helper('url');
	        $this->load->model('m_financeread');
	        $this->load->model('m_financecreate');
	        $this->load->model('m_financeupdate');
	        $this->load->model('m_essread');
	        $this->load->model('m_coaread');
	        $this->load->model('m_inventoryread');
	        $this->load->model('m_inventorycreate');
	        $this->load->model('m_inventoryupdate');
	        $this->load->model('m_distributionread');
		}

		public function index(){
			$this->load->view('login');
		}

		// Setting

		public function update_module_category($key_session){
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
					$this->form_validation->set_rules('id_module_category', 'id_module_category', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_module_category = $this->input->post('id_module_category');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_financeupdate->update_module_category($data, $company_id_session, $id_module_category);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		public function update_module($key_session){
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
					$this->form_validation->set_rules('id_module', 'id_module', 'required');
					$this->form_validation->set_rules('deleted', 'deleted', 'required');
			 
					if ($this->form_validation->run() == false){
						$status = 0;
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_module = $this->input->post('id_module');
						$deleted = $this->input->post('deleted');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'deleted' => $deleted,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result = $this->m_financeupdate->update_module($data, $company_id_session, $id_module);
						if ($result==true) {
							$status = 1;
							$responseValue = '';
						}
						else {
							$status = 0;
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}

		// Input

		public function update_transaction_distribution_payment_date($key_session){
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
					$this->form_validation->set_rules('id_transaction_distribution_array', 'id_transaction_distribution_array', 'required');
			 		$status_array = array();
					if ($this->form_validation->run() == false){
						$status = 0;
						array_push($status_array, $status);
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_transaction_distribution_array = json_decode($this->input->post('id_transaction_distribution_array'));
						$transfer_date = $this->input->post('transfer_date');
						$last_update = date('Y-m-d H:i:s');

						for ($i=0; $i < count($id_transaction_distribution_array); $i++) { 
							$id_transaction_distribution = ($id_transaction_distribution_array[$i])*1;
							$data=array(
								'transfer_date' => $transfer_date,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							array_push($data_array, $id_transaction_distribution);
							$result = $this->m_financeupdate->update_transaction_distribution_by_id_transaction_distribution($company_id_session, $data, $id_transaction_distribution);
							if ($result==true) {
								$status = 1;
								array_push($status_array, $status);
								$responseValue = '';
							}
							else {
								$status = 0;
								array_push($status_array, $status);
								$responseValue = 'Data not updated.';
							}							
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'response' => $data_array)));
				}
			}
		}

		public function update_transaction_distribution_payment_date_line($key_session){
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
					$this->form_validation->set_rules('id_transaction_distribution', 'id_transaction_distribution', 'required');
			 		$status_array = array();
					if ($this->form_validation->run() == false){
						$status = 0;
						array_push($status_array, $status);
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_transaction_distribution = $this->input->post('id_transaction_distribution');
						$transfer_date = $this->input->post('transfer_date');
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'transfer_date' => $transfer_date,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						array_push($data_array, $id_transaction_distribution);
						$result = $this->m_financeupdate->update_transaction_distribution_by_id_transaction_distribution($company_id_session, $data, $id_transaction_distribution);
						if ($result==true) {
							$status = 1;
							array_push($status_array, $status);
							$responseValue = '';
						}
						else {
							$status = 0;
							array_push($status_array, $status);
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}

		public function update_transaction_distribution_bank_account($key_session){
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
					$this->form_validation->set_rules('id_transaction_distribution_array', 'id_transaction_distribution_array', 'required');
			 		$status_array = array();
					if ($this->form_validation->run() == false){
						$status = 0;
						array_push($status_array, $status);
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_transaction_distribution_array = json_decode($this->input->post('id_transaction_distribution_array'));
						$id_bank_account_post = $this->input->post('id_bank_account');
						$id_bank_account_post_exp = explode(' / ', $id_bank_account_post);
						$coa_cd = $id_bank_account_post_exp[0];
						$result_coa_cash_account = $this->m_coaread->list_cash_account_by_coa_cd($company_id_session, $coa_cd);
						$id_cash_account = $result_coa_cash_account[0]->id_cash_account;
						$last_update = date('Y-m-d H:i:s');

						for ($i=0; $i < count($id_transaction_distribution_array); $i++) { 
							$id_transaction_distribution = ($id_transaction_distribution_array[$i])*1;
							$data=array(
								'id_bank_account' => $id_cash_account,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
							);
							array_push($data_array, $id_transaction_distribution);
							$result = $this->m_financeupdate->update_transaction_distribution_by_id_transaction_distribution($company_id_session, $data, $id_transaction_distribution);
							if ($result==true) {
								$status = 1;
								array_push($status_array, $status);
								$responseValue = '';
							}
							else {
								$status = 0;
								array_push($status_array, $status);
								$responseValue = 'Data not updated.';
							}							
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'response' => $data_array)));
				}
			}
		}

		public function update_transaction_distribution_bank_account_line($key_session){
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
					$this->form_validation->set_rules('id_transaction_distribution', 'id_transaction_distribution', 'required');
			 		$status_array = array();
					if ($this->form_validation->run() == false){
						$status = 0;
						array_push($status_array, $status);
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_array = array();

						$id_transaction_distribution = $this->input->post('id_transaction_distribution');
						$id_bank_account_post = $this->input->post('id_bank_account');
						$id_bank_account_post_exp = explode(' / ', $id_bank_account_post);
						$coa_cd = $id_bank_account_post_exp[0];
						$result_coa_cash_account = $this->m_coaread->list_cash_account_by_coa_cd($company_id_session, $coa_cd);
						$id_cash_account = $result_coa_cash_account[0]->id_cash_account;
						$last_update = date('Y-m-d H:i:s');

						$data=array(
							'id_bank_account' => $id_cash_account,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						array_push($data_array, $id_transaction_distribution);
						$result = $this->m_financeupdate->update_transaction_distribution_by_id_transaction_distribution($company_id_session, $data, $id_transaction_distribution);
						if ($result==true) {
							$status = 1;
							array_push($status_array, $status);
							$responseValue = '';
						}
						else {
							$status = 0;
							array_push($status_array, $status);
							$responseValue = 'Data not updated.';
						}							
						
					}
					echo json_encode(array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}

		public function update_transaction_distribution_line($key_session){
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
					$this->form_validation->set_rules('id_transaction_distribution', 'id_transaction_distribution', 'required');
			 		$status_array = array();
					if ($this->form_validation->run() == false){
						$status = 0;
						array_push($status_array, $status);
						$responseValue = 'Form Validation is Invalid.';
					}
					else {
						$data_debet_array = array();
						$data_credit_array = array();

						$id_transaction_distribution = $this->input->post('id_transaction_distribution');
						$transfer_date_post = $this->input->post('transfer_date');
						$id_module_post = $this->input->post('id_module');
						$id_bank_account_post = $this->input->post('id_bank_account');
						$id_bank_account_post_exp = explode(' / ', $id_bank_account_post);
						$coa_cd = $id_bank_account_post_exp[0];
						$result_coa_cash_account = $this->m_coaread->list_cash_account_by_coa_cd($company_id_session, $coa_cd);
						$id_cash_account = $result_coa_cash_account[0]->id_cash_account;
						$last_update = date('Y-m-d H:i:s');

						$result_transaction_distirbution = $this->m_financeread->list_transaction_distribution_by_id_transaction_distribution($company_id_session, $id_transaction_distribution);
						$purchase_invoice_periode = $result_transaction_distirbution[0]->periode."-01";
						$transaction_number = $result_transaction_distirbution[0]->transaction_number;
						$distribution_number = $result_transaction_distirbution[0]->distribution_number;
						$coa_cd_apr = $result_transaction_distirbution[0]->coa_cd_apr;
						$coa_name_apr = $result_transaction_distirbution[0]->coa_name_apr;
						$apr_account = $result_transaction_distirbution[0]->apr_account;
						$id_account = $result_transaction_distirbution[0]->id_account;
						$ppn = $result_transaction_distirbution[0]->ppn;
						$pph = $result_transaction_distirbution[0]->pph;
						$vendor_invoice_number = $result_transaction_distirbution[0]->vendor_invoice_number;
						$vendor_tax_number = $result_transaction_distirbution[0]->vendor_tax_number;

						$result_tax = $this->m_distributionread->list_purchase_invoice_line_tax_by_purchase_invoice_number($company_id_session, $distribution_number);
						$sub_tax_percent_plus_coa = $result_tax[0]->sub_tax_percent_plus_coa;
						$sub_tax_percent_plus_coa_cd = $result_tax[0]->sub_tax_percent_plus_coa_cd;
						$sub_tax_percent_plus_coa_name = $result_tax[0]->sub_tax_percent_plus_coa_name;
						$sub_tax_percent_minus_coa = $result_tax[0]->sub_tax_percent_minus_coa;
						$sub_tax_percent_minus_coa_cd = $result_tax[0]->sub_tax_percent_minus_coa_cd;
						$sub_tax_percent_minus_coa_name = $result_tax[0]->sub_tax_percent_minus_coa_name;

						$result_purchase_invoice_line = $this->m_distributionread->list_purchase_invoice_line_by_purchase_invoice_number($company_id_session, $distribution_number);
						foreach ($result_purchase_invoice_line as $purchase_invoice_line_list) {
							$JobNo = $purchase_invoice_line_list->JobNo;
							$description = $purchase_invoice_line_list->description;
							$cury_sub_amount = $purchase_invoice_line_list->cury_sub_amount;
							$sub_amount = $purchase_invoice_line_list->sub_amount;
							$id_inventory = $purchase_invoice_line_list->id_inventory;
							$purchase_invoice_line_qty = $purchase_invoice_line_list->purchase_invoice_line_qty;
							$cury_unit_price = $purchase_invoice_line_list->cury_unit_price;
							$unit_price = $purchase_invoice_line_list->unit_price;

							if ($JobNo == null || $JobNo == '') {
								$description_credit = 'Inv No. '.$vendor_invoice_number.' - '.$description;
							}
							else {
								$description_credit = 'Inv No. '.$vendor_invoice_number.' - '.$description.' - '.$JobNo;
							}

							$data_debet = array(
								'company_id' => $company_id_session,
								'transaction_date' => $transfer_date_post,
								'transaction_periode' => $purchase_invoice_periode,
								'transaction_type' => 'OUT',
								'transaction_number' => '',
								'id_module' => $id_module_post*1,
								'id_account' => $id_account*1,
								
								'id_coa_debet' => $apr_account*1,
								'description_debet' => $coa_name_apr,
								'nominal_debet' => $cury_sub_amount*1,
								
								'id_coa_credit' => $id_inventory,
								'description_credit' => $description_credit,
								'nominal_credit' => null,

								'nominal_balance' => null,
								'note_line' => null,
								'number_source' => null,
								'inventory_id' => $id_inventory*1,
								'qty' => $purchase_invoice_line_qty*1,
								'unit_price' => $unit_price*1,
								'cury_unit_price' => $cury_unit_price*1,
								'amount' => $sub_amount*1,
								'cury_amount' => $cury_sub_amount*1,

								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);			
							array_push($data_debet_array, $data_debet);

							$data_credit = array(
								'company_id' => $company_id_session,
								'transaction_date' => $transfer_date_post,
								'transaction_periode' => $purchase_invoice_periode,
								'transaction_type' => 'IN',
								'transaction_number' => '',
								'id_module' => $id_module_post*1,
								'id_account' => $id_account*1,
								
								'id_coa_credit' => $apr_account*1,
								'description_credit' => $coa_name_apr,
								'nominal_credit' => $cury_sub_amount*1,
								
								'id_coa_debet' => $id_inventory*1,
								'description_debet' => $description_credit,
								'nominal_debet' => null,

								'nominal_balance' => null,
								'note_line' => null,
								'number_source' => null,
								'inventory_id' => $id_inventory*1,
								'qty' => $purchase_invoice_line_qty*1,
								'unit_price' => $unit_price*1,
								'cury_unit_price' => $cury_unit_price*1,
								'amount' => $sub_amount*1,
								'cury_amount' => $cury_sub_amount*1,

								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);			
							array_push($data_credit_array, $data_credit);
						}

						$description_credit = 'Inv No. '.$vendor_invoice_number.' - VAT '.$vendor_tax_number;

						$data_debet = array(
							'company_id' => $company_id_session,
							'transaction_date' => $transfer_date_post,
							'transaction_periode' => $purchase_invoice_periode,
							'transaction_type' => 'OUT',
							'transaction_number' => '',
							'id_module' => $id_module_post*1,
							'id_account' => $id_account*1,
							
							'id_coa_debet' => $apr_account*1,
							'description_debet' => $coa_name_apr,
							'nominal_debet' => $ppn*1,
							
							'id_coa_credit' => $sub_tax_percent_plus_coa*1,
							'description_credit' => $description_credit,
							'nominal_credit' => null,

							'nominal_balance' => null,
							'note_line' => null,
							'number_source' => null,
							'inventory_id' => null,
							'qty' => null,
							'unit_price' => null,
							'cury_unit_price' => null,
							'amount' => null,
							'cury_amount' => null,

							'create_by' => $cNIK_session,
							'create_date' => $last_update,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
							'deleted' => 0,
						);			
						array_push($data_debet_array, $data_debet);

						$data_credit = array(
							'company_id' => $company_id_session,
							'transaction_date' => $transfer_date_post,
							'transaction_periode' => $purchase_invoice_periode,
							'transaction_type' => 'IN',
							'transaction_number' => '',
							'id_module' => $id_module_post*1,
							'id_account' => $id_account*1,
							
							'id_coa_credit' => $apr_account*1,
							'description_credit' => $coa_name_apr,
							'nominal_credit' => $ppn*1,
							
							'id_coa_debet' => $sub_tax_percent_plus_coa,
							'description_debet' => $description_credit,
							'nominal_debet' => null,

							'nominal_balance' => null,
							'note_line' => null,
							'number_source' => null,
							'inventory_id' => null,
							'qty' => null,
							'unit_price' => null,
							'cury_unit_price' => null,
							'amount' => null,
							'cury_amount' => null,

							'create_by' => $cNIK_session,
							'create_date' => $last_update,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
							'deleted' => 0,
						);			
						array_push($data_credit_array, $data_credit);		

						if ($sub_tax_percent_minus_coa != null) {
							$description_credit = 'Inv No. '.$vendor_invoice_number.' - PPh '.$vendor_tax_number;
							$data_debet = array(
								'company_id' => $company_id_session,
								'transaction_date' => $transfer_date_post,
								'transaction_periode' => $purchase_invoice_periode,
								'transaction_type' => 'OUT',
								'transaction_number' => '',
								'id_module' => $id_module_post*1,
								'id_account' => $id_account*1,
								
								'id_coa_debet' => $apr_account*1,
								'description_debet' => $coa_name_apr,
								'nominal_debet' => $pph*1,
								
								'id_coa_credit' => $sub_tax_percent_minus_coa,
								'description_credit' => $description_credit,
								'nominal_credit' => null,

								'nominal_balance' => null,
								'note_line' => null,
								'number_source' => null,
								'inventory_id' => null,
								'qty' => null,
								'unit_price' => null,
								'cury_unit_price' => null,
								'amount' => null,
								'cury_amount' => null,

								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);			
							array_push($data_debet_array, $data_debet);

							$data_credit = array(
								'company_id' => $company_id_session,
								'transaction_date' => $transfer_date_post,
								'transaction_periode' => $purchase_invoice_periode,
								'transaction_type' => 'IN',
								'transaction_number' => '',
								'id_module' => $id_module_post*1,
								'id_account' => $id_account*1,
								
								'id_coa_credit' => $apr_account*1,
								'description_credit' => $coa_name_apr,
								'nominal_credit' => $pph*1,
								
								'id_coa_debet' => $sub_tax_percent_minus_coa,
								'description_debet' => $description_credit,
								'nominal_debet' => null,

								'nominal_balance' => null,
								'note_line' => null,
								'number_source' => null,
								'inventory_id' => null,
								'qty' => null,
								'unit_price' => null,
								'cury_unit_price' => null,
								'amount' => null,
								'cury_amount' => null,

								'create_by' => $cNIK_session,
								'create_date' => $last_update,
								'last_by' => $cNIK_session,
								'last_update' => $last_update,
								'deleted' => 0,
							);			
							array_push($data_credit_array, $data_credit);	
						}

						$data_array = array();
						for ($a=0; $a<count($data_debet_array); $a++){
							array_push($data_array, $data_debet_array[$a]);
						}
						for ($a2=0; $a2<count($data_credit_array); $a2++){
							array_push($data_array, $data_credit_array[$a2]);
						}

						$data_update=array(
							'id_bank_account' => $id_cash_account,
							'transfer_date' => $transfer_date_post,
							'last_by' => $cNIK_session,
							'last_update' => $last_update,
						);
						$result_update = $this->m_financeupdate->update_transaction_distribution_by_id_transaction_distribution($company_id_session, $data_update, $id_transaction_distribution);
						if ($result_update==true) {
							for($a3=0; $a3<count($data_array); $a3++){
								$result_insert_transaction_line = $this->m_financecreate->add_petty_cash_line($data_array[$a3]);
								if ($result_insert_transaction_line) {
									$status = 1;
									array_push($status_array, $status);
								}
								else {
									$status = 0;
									array_push($status_array, $status);
								}
							}
						}
						else {
							$status = 0;
							array_push($status_array, $status);
							$responseValue = 'Data not updated.';
						}
					}
					echo json_encode(array(array('status' => array_unique($status_array), 'distribution_number' => $distribution_number, 'result_tax' => count($result_tax), 'response' => $data_array)));
				}
			}
		}

		public function update_checked_transaction_distribution($key_session, $id_transaction_distribution, $values){
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
					$id_transaction_distribution = $this->uri->segment('4');
					$values = $this->uri->segment('5');
					$last_update = date('Y-m-d H:i:s');
					$data = array(
						'check_1' => $values*1,
						'last_by' => $cNIK_session,
						'last_update' => $last_update
					);
					$result = $this->m_financeupdate->update_transaction_distribution_by_id_transaction_distribution($company_id_session, $data, $id_transaction_distribution);
					if ($result == true) {
						$status = 1;
					}
					else {
						$status = 0;
					}
					echo json_encode(array(array('status' => $status)));
				}
			}
		}

		// Delete

		public function delete_transaction_distribution($key_session, $id_transaction_distribution_get){
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
					$id_transaction_distribution_get = $this->uri->segment('4');
					$result = $this->m_financeupdate->delete_transaction_distribution($company_id_session, $id_transaction_distribution_get);
					if ($result==true) {
						$status = 1;
						$responseValue = '';
					}
					else {
						$status = 0;
						$responseValue = 'Data not deleted.';
					}
					echo json_encode(array(array('status' => $status, 'response' => $responseValue)));
				}
			}
		}


	}
