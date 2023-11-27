<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class FinanceRead extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_financeread');
        $this->load->model('m_jomread');
        $this->load->model('m_coaread');
        $this->load->model('m_distributionread');
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
					$result = $this->m_financeread->list_module_category($company_id_session, $id_module_category);
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
					$result = $this->m_financeread->list_module($company_id_session, $id_module);
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
					$result = $this->m_financeread->list_numbering_sequence($company_id_session, $id_module);
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

		public function list_header_numbering($key_session, $id_module){
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
					$result = $this->m_financeread->list_header_numbering($company_id_session, $id_module);
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

		public function list_balance($key_session, $transaction_periode, $id_cash_account){
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
					$transaction_periode = $this->uri->segment('4');
					$id_cash_account = $this->uri->segment('5');
					$result = $this->m_financeread->list_balance($company_id_session, $transaction_periode.'-01', $id_cash_account);
					$data_array = array();
					if (count($result)==0) {
						$status = 0;
					}
					else {
						$status = 1;
						foreach ($result as $resultList){
							$data = array(
								'id_balance' => $resultList->id_balance,
								'id_cash_account' => $resultList->id_cash_account,
								'cash_account_cd' => $resultList->cash_account_cd,
								'coa_cd' => $resultList->coa_cd,
								'coa_name' => $resultList->coa_name,
								'transaction_periode' => substr($resultList->transaction_periode, 0, 7),
								'begin_balance' => ($resultList->begin_balance)*1,
								'total_debet' => ($resultList->total_debet)*1,
								'total_credit' => ($resultList->total_credit)*1,
								'ending_balance' => ($resultList->ending_balance)*1,
								'transaction_periode_format' => date_format(date_create($resultList->transaction_periode), 'F Y'),
								'begin_balance_format' => number_format($resultList->begin_balance, 2),
								'total_debet_format' => number_format($resultList->total_debet, 2),
								'total_credit_format' => number_format($resultList->total_credit, 2),
								'ending_balance_format' => number_format($resultList->ending_balance, 2),
							);
							array_push($data_array, $data);
						}			
					}				
					echo json_encode(array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}

		/*public function list_employee_permission($key_session, $id_module){
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
					$result = $this->m_financeread->list_employee_permission($company_id_session, $id_module);
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
					$result = $this->m_financeread->list_approval_permission($company_id_session, $id_module);
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
					$result = $this->m_financeread->list_approval_permission_datatable($company_id_session, $id_module);
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
			            "recordsTotal" => $this->m_financeread->list_approval_permission_count_all($company_id_session, $id_module),
			            "recordsFiltered" => $this->m_financeread->list_approval_permission_count_filtered($company_id_session, $id_module),
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

					$result_employee = $this->m_financeread->list_employee_datatable($company_id_session);
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
			            "recordsTotal" => $this->m_financeread->list_employee_count_all($company_id_session),
			            "recordsFiltered" => $this->m_financeread->list_employee_count_filtered($company_id_session),
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
					$result = $this->m_financeread->list_module_category($company_id_session, $id_module_category);
					$data_array = array();
					if (count($result)==0) {
						$status = 0;
					}
					else {
						$status = 1;
						foreach ($result as $resultList){
							$id_module_category = $resultList->id_module_category;
							$result_module = $this->m_financeread->list_module_category_by_module_category_id($company_id_session, $id_module_category);

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
					$result = $this->m_financeread->list_transaction_role($company_id_session, $id_module);
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
					$result = $this->m_financeread->list_payment_methode($company_id_session, $id_payment_methode);
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
					$result = $this->m_financeread->list_payment_terms($company_id_session, $id_payment_terms);
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
		}*/

	// ================================== INPUT ====================================
	// ================================== CASH MANAGEMENT ==========================
	// ================================== PETTY CASH ===============================

		public function transaction_resume($key_session, $id_cash_account, $transaction_periode){
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
					$id_cash_account = $this->uri->segment('4');
					$result_cash_account = $this->m_coaread->list_cash_account($company_id_session, $id_cash_account);
					$result_debet_credit = $this->m_financeread->transaction_resume($company_id_session, $id_cash_account, $transaction_periode);
					$total_debet_db = $result_debet_credit[0]->total_debet;
					$total_credit_db = $result_debet_credit[0]->total_credit;
					if ($total_debet_db == null) {
						$total_debet = 0;
					}
					else {
						$total_debet = $total_debet_db;
					}

					if ($total_credit_db == null) {
						$total_credit = 0;
					}
					else {
						$total_credit = $total_credit_db;
					}

					$data_array = array();
					$data = array(
						'id_cash_account' => $result_cash_account[0]->id_cash_account,
						'begin_balance' => 0,
						'total_debet' => $total_debet,
						'total_credit' => $total_debet,
						'ending_balance' => str_replace(' ', '', $result_cash_account[0]->nominal),
						'ending_balance_format' => number_format(str_replace(' ', '', $result_cash_account[0]->nominal), 2),
					);
					array_push ($data_array, $data);
			
					echo json_encode(array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}

		public function numbering_sequence($key_session, $id_module, $id_cash_account, $transaction_periode){
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
					$result_module = $this->m_financeread->list_numbering_sequence($company_id_session, $id_module);
					$data_array = array();
					
					if (count($result_module)==0) {
						$status = 0;
					}
					else {
						$status = 1;

						function numberToRomanRepresentation($number) {
						    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
						    $returnValue = '';
						    while ($number > 0) {
						        foreach ($map as $roman => $int) {
						            if($number >= $int) {
						                $number -= $int;
						                $returnValue .= $roman;
						                break;
						            }
						        }
						    }
						    return $returnValue;
						}

						$id_cash_account = $this->uri->segment('5');
						$result_cash_account = $this->m_coaread->list_cash_account($company_id_session, $id_cash_account);
						$coa_currency_cd = $result_cash_account[0]->coa_currency_cd;

						$transaction_periode = $this->uri->segment('6');
						$transaction_periode_month = substr($transaction_periode, 5, 2);
						$transaction_periode_month_format = numberToRomanRepresentation(($transaction_periode_month*1));
						
						$result_last_count = $this->m_financeread->count_fin_transaction($company_id_session, $id_module, $transaction_periode."-01");
						$last_count = $result_last_count+1;
						
						$string_format = $result_module[0]->string_format;
						$cut_1 = $result_module[0]->cut_1;
						$cut_2 = $result_module[0]->cut_2;
						$cut_3 = $result_module[0]->cut_3;
						$number_length = $result_module[0]->number_length;

						$last_count_format = sprintf("%0".($number_length*1)."d", $last_count);

						$numbering_sequence = $string_format.''.$cut_1.''.$coa_currency_cd.''.$cut_2.''.$transaction_periode_month_format.''.$cut_3.''.$last_count_format;

						$data = array(
							'numbering_sequence' => $numbering_sequence
						);
						array_push($data_array, $data);				
					}				
					echo json_encode(array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}

		public function list_transaction_line($key_session, $id_module, $id_cash_account, $id_transaction_line){
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
					$id_cash_account = $this->uri->segment('5');
					$transaction_periode = ($this->uri->segment('6')).'-01';
					$id_transaction_line = $this->uri->segment('7');
					
					$data_array = array();

					$result_tramsaction_line = $this->m_financeread->list_transaction_line($company_id_session, $id_module, $id_cash_account, $transaction_periode, $id_transaction_line);
					if (count($result_tramsaction_line)==0) {
						$status = 0;
					}
					else {
						$status = 1;
						foreach ($this->m_financeread->list_balance($company_id_session, $transaction_periode, $id_cash_account) as $result_cash_account);
						$begin_balance = $result_cash_account->begin_balance;

						$total_debet = 0;
						$total_credit = 0;

						foreach ($result_tramsaction_line as $resultList) {
							$nominal_credit = ($resultList->nominal_credit)*1;
							$nominal_debet = ($resultList->nominal_debet)*1;

							$total_credit += $nominal_credit;
							$total_debet += $nominal_debet;

							$ending_balance = (($begin_balance*1)+$total_debet)-$total_credit;

							$data = array(
								'id_cash_account' => $id_cash_account,
								'begin_balance' => $begin_balance,
								'begin_balance_format' => number_format($begin_balance, 2),

								'total_credit' => $total_credit,
								'total_credit_format' => number_format($total_credit, 2),
								'total_debet' => $total_debet,
								'total_debet_format' => number_format($total_debet, 2),

								'id_transaction_line'	=>	$resultList->id_transaction_line,
								'company_id'	=>	$resultList->company_id,
								'company_name'	=>	$resultList->company_name,
								'transaction_date'	=>	$resultList->transaction_date,
								'transaction_date_format'	=> date_format(date_create($resultList->transaction_date), 'd M Y'),
								'transaction_periode'	=>	$resultList->transaction_periode,
								'transaction_type'	=>	$resultList->transaction_type,
								'transaction_number'	=>	$resultList->transaction_number,
								'id_module'	=>	$resultList->id_module,
								'id_account'	=>	$resultList->id_account,
								'account_cd'	=>	$resultList->account_cd,
								'account_name'	=>	$resultList->account_name,
								'id_coa_debet'	=>	$resultList->id_coa_debet,
								'coa_cd_debet'	=>	$resultList->coa_cd_debet,
								'coa_name_debet'	=>	$resultList->coa_name_debet,
								'description_debet'	=>	$resultList->description_debet,
								'nominal_debet'	=>	($resultList->nominal_debet)*1,
								'nominal_debet_format'	=>	number_format(($resultList->nominal_debet), 2),
								'id_coa_credit'	=>	$resultList->id_coa_credit,
								'coa_cd_credit'	=>	$resultList->coa_cd_credit,
								'coa_name_credit'	=>	$resultList->coa_name_credit,
								'description_credit'	=>	$resultList->description_credit,
								'nominal_credit'	=>	($resultList->nominal_credit)*1,
								'nominal_credit_format'	=>	number_format(($resultList->nominal_credit), 2),
								'nominal_balance'	=>	($ending_balance)*1,
								'nominal_balance_format'	=>	number_format(($ending_balance), 2),
								'note_line'	=>	$resultList->note_line,
								'note_header'	=>	$resultList->note_header,
								'number_source'	=>	$resultList->number_source,
								'inventory_id'	=>	$resultList->inventory_id,
								'qty'	=>	($resultList->qty)*1,
								'unit_price'	=>	($resultList->unit_price)*1,
								'unit_price_format'	=>	number_format(($resultList->unit_price), 2),
								'cury_unit_price'	=>	($resultList->cury_unit_price)*1,
								'cury_unit_price_format'	=>	number_format(($resultList->cury_unit_price), 2),
								'amount'	=>	($resultList->amount)*1,
								'amount_format'	=>	number_format(($resultList->amount), 2),
								'cury_amount'	=>	($resultList->cury_amount)*1,
								'cury_amount_format'	=>	number_format(($resultList->cury_amount), 2),
								'create_by'	=>	$resultList->create_by,
								'cNmPegawai_create'	=>	$resultList->cNmPegawai_create,
								'create_date'	=>	$resultList->create_date,
								'last_by'	=>	$resultList->last_by,
								'cNmPegawai_last'	=>	$resultList->cNmPegawai_last,
								'last_update'	=>	$resultList->last_update,
								'deleted'	=>	$resultList->deleted,
							);
							array_push ($data_array, $data);
						}
					}
					echo json_encode(array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}

	// ================================= AACCOUNT PAYABLE =========================

		public function list_transaction_select_datatable($key_session, $id_module){
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
					$result_job_order = $this->m_financeread->list_transaction_select_datatable($company_id_session, $id_module);
			        $data = array();
			        $no = 1;
			        foreach ($result_job_order as $job_order_list) {
			            $row = array();
				            $id_transaction = $job_order_list->id_transaction;
				            $account_name = $job_order_list->account_name;
				            $transaction_number = $job_order_list->transaction_number;
				            $transaction_periode = $job_order_list->transaction_periode;

				            $count_transaction_line = $this->m_financeread->count_transaction_line($company_id_session, $transaction_number);

				            $row[] = '<input type="checkbox" style="width:25px; height:25px;" id="transaction_number_'.$no.'" class="transaction_number" onclick="select_change_transaction('.$no.');"><input type="hidden" id="transaction_number_value_'.($no).'" value="'.$id_transaction.' // '.$transaction_number.' // '.$account_name.' // '.$count_transaction_line.'">';
				            
				            $row[] = $transaction_number;
				            $row[] = $account_name;
				            $row[] = date_format(date_create($transaction_periode), 'F Y');
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_financeread->list_transaction_select_count_all($company_id_session, $id_module),
			            "recordsFiltered" => $this->m_financeread->list_transaction_select_count_filtered($company_id_session, $id_module),
			            "data" => $data,
			        );
			        echo json_encode($output);
			        //echo json_encode($output);
				}
			}
		}

		public function list_transaction_line_datatable($key_session, $transaction_number_get){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$transaction_number_get = $this->uri->segment('4');
				$transaction_number_get_exp = explode('-', $transaction_number_get);
				$transaction_number = $transaction_number_get_exp[0].'/'.$transaction_number_get_exp[1].'/'.$transaction_number_get_exp[2].'-'.$transaction_number_get_exp[3];
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_job_order = $this->m_financeread->list_transaction_line_datatable($company_id_session, $transaction_number);
			        $data = array();
			        $no = 1;
			        foreach ($result_job_order as $job_order_list) {
			            $row = array();
				            $id_transaction_distribution = $job_order_list->id_transaction_distribution;
				            $distribution_number = $job_order_list->distribution_number;
				            $vendor_invoice_number = $job_order_list->vendor_invoice_number;
				            $transfer_date = $job_order_list->transfer_date;
				            $transaction_periode = $job_order_list->transaction_periode;
				            $coa_currency_cd = $job_order_list->coa_currency_cd;
				            $cash_account_cd = $job_order_list->cash_account_cd;
				            $cury_amount = $job_order_list->cury_amount;
				            $ppn = $job_order_list->ppn;
				            $pph = $job_order_list->pph;
				            $decimal_after = $job_order_list->decimal_after;
				            $coa_cd = $job_order_list->coa_cd;
				            $coa_name = $job_order_list->coa_name;

				            if ($transfer_date == null) {
				            	$transfer_date_desc = '';
				            }
				            else {
				            	$transfer_date_desc = $transfer_date;
				            }

				            if ($coa_name == null) {
				            	$coa_name_desc = '';
				            }
				            else {
				            	$coa_name_desc = $coa_cd.' / '.$coa_name;
				            }

				            $row[] = '<input type="hidden" id="id_transaction_distribution_'.$no.'" value="'.$id_transaction_distribution.'"><input type="hidden" id="cash_account_cd_old_'.$no.'" value="'.$coa_name_desc.'"><button class="btn btn-sm btn-danger" onclick="delete_transaction('.$id_transaction_distribution.', '."'$distribution_number'".', '."'$transaction_number_get'".');"><i class="mdi mdi-delete-forever"></i></button>';
				            
				            $row[] = $distribution_number;
				            $row[] = $vendor_invoice_number;
				            $row[] = '<div align="right" style="padding-right:25px;">'.number_format($cury_amount, $decimal_after).'</div>';
				            $row[] = '<div align="right" style="padding-right:25px;">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div align="right" style="padding-right:25px;">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div align="center">'.$coa_currency_cd.'</div>';
				            $row[] = '<input type="date" class="form-control" id="transfer_date_'.$no.'" value="'.$transfer_date_desc.'">';
				            $row[] = '<input type="text" title="'.$coa_name_desc.'" class="form-control" id="id_bank_account_'.$no.'" value="'.$coa_name_desc.'" style="color:white;" list="id_bank_account_list_'.$no.'"><datalist id="id_bank_account_list_'.$no.'" class="id_bank_account_list"></datalist>';
				            $row[] = '<div align="center"><button class="btn btn-sm btn-primary" onclick="save_bank_account('.(i+1).', '."'$id_transaction_distribution'".');"><i class="mdi mdi-content-save"></i></button></div>';
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_financeread->list_transaction_line_count_all($company_id_session, $transaction_number),
			            "recordsFiltered" => $this->m_financeread->list_transaction_line_count_filtered($company_id_session, $transaction_number),
			            "data" => $data,
			        );
			        echo json_encode($output);
			        //echo json_encode($output);
				}
			}
		}

		public function list_transaction_line_periode_datatable($key_session, $transaction_periode_get){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$transaction_periode_get = $this->uri->segment('4').'-01';
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_job_order = $this->m_financeread->list_transaction_line_periode_datatable($company_id_session, $transaction_periode_get);
			        $data = array();
			        $no = 1;
			        foreach ($result_job_order as $job_order_list) {
			            $row = array();
				            $id_transaction_distribution = $job_order_list->id_transaction_distribution;
				            $account_name = $job_order_list->account_name;
				            $distribution_number = $job_order_list->distribution_number;
				            $vendor_invoice_number = $job_order_list->vendor_invoice_number;
				            $transfer_date = $job_order_list->transfer_date;
				            $transaction_periode = $job_order_list->transaction_periode;
				            $coa_currency_cd = $job_order_list->coa_currency_cd;
				            $cash_account_cd = $job_order_list->cash_account_cd;
				            $cury_amount = $job_order_list->cury_amount;
				            $ppn = $job_order_list->ppn;
				            $pph = $job_order_list->pph;
				            $decimal_after = $job_order_list->decimal_after;
				            $coa_cd = $job_order_list->coa_cd;
				            $coa_name = $job_order_list->coa_name;
				            $check_1 = $job_order_list->check_1;

				            if ($transfer_date == null) {
				            	$transfer_date_desc = '';
				            }
				            else {
				            	$transfer_date_desc = date_format(date_create($transfer_date), 'd M Y');
				            }

				            if ($coa_name == null) {
				            	$coa_name_desc = '';
				            }
				            else {
				            	$coa_name_desc = $coa_name;
				            }

				            $row[] = $no;
				            
				            $row[] = $account_name;
				            $row[] = $distribution_number;
				            $row[] = $vendor_invoice_number;
				            $row[] = '<div align="right" style="padding-right:25px;">'.number_format($cury_amount, $decimal_after).'</div>';
				            $row[] = '<div align="right" style="padding-right:25px;">'.number_format($ppn, $decimal_after).'</div>';
				            $row[] = '<div align="right" style="padding-right:25px;">'.number_format($pph, $decimal_after).'</div>';
				            $row[] = '<div align="center">'.$coa_currency_cd.'</div>';
				            $row[] = '<div align="center">'.$transfer_date_desc.'</div>';
				            $row[] = '<div align="center">'.$coa_name_desc.'</div>';
				            if ($check_1 == 1) {
				            	$row[] = '<div align="center"><input type="checkbox" checked="checked" id="approve_'.$no.'" onclick="approve('."'$id_transaction_distribution'".', '."'$distribution_number'".', '."'$no'".');" style="width:25px; height:25px;"></div>';
				            }
				            else {
				            	$row[] = '<div align="center"><input type="checkbox" id="approve_'.$no.'" onclick="approve('."'$id_transaction_distribution'".', '."'$distribution_number'".', '."'$no'".');" style="width:25px; height:25px;"></div>';
				            }
			 
			            $data[] = $row;
			            $no++;
			        }
			 
			        $output = array(
			            "draw" => $_POST['draw'],
			            "recordsTotal" => $this->m_financeread->list_transaction_line_periode_count_all($company_id_session, $transaction_number),
			            "recordsFiltered" => $this->m_financeread->list_transaction_line_periode_count_filtered($company_id_session, $transaction_number),
			            "data" => $data,
			        );
			        echo json_encode($output);
			        //echo json_encode($output);
				}
			}
		}

		public function list_transaction_by_transaction_periode($key_session, $transaction_periode, $module_cd){
			$cNIK_session=$this->session->userdata('cNIK_session');
			$company_id_session=$this->session->userdata('company_id_session');
			if (empty($cNIK_session)){
				$this->load->view('login');
			}
			else {
				$key_session=$this->session->userdata('key_session');
				$key_session_get = $this->uri->segment('3');
				$transaction_periode = ($this->uri->segment('4')).'-01';
				$module_cd = $this->uri->segment('5');
				if ($key_session_get!=$key_session) {
					$this->load->view('login');
				}
				else {
					$result_list_transaction = $this->m_financeread->list_transaction_by_transaction_periode($company_id_session, $transaction_periode, $module_cd);
			        $data_array = array();
			        if (count($result_list_transaction) == 0) {
			        	$status = 0;
			        }
			        else {
			        	$status = 1;
			        	foreach ($result_list_transaction as $list_transaction) {
			        		$transaction_number = $list_transaction->transaction_number;
			        		$distribution_number = $list_transaction->distribution_number;
			        		$account_name = $list_transaction->account_name;
			        		$result_purchase_invoice = $this->m_distributionread->list_purchase_invoice_by_purchase_invoice_number($company_id_session, $distribution_number);
			        		$cury_amount = $result_purchase_invoice[0]->cury_amount;
			        		$ppn = $result_purchase_invoice[0]->ppn;
			        		$pph = $result_purchase_invoice[0]->pph;
			        		$decimal_after = $result_purchase_invoice[0]->decimal_after;

			        		$result_transaction_distribution = $this->m_financeread->list_transaction_distribution_by_transaction_number($company_id_session, $transaction_number);
			        		$total_transaction_distribution = $result_transaction_distribution;

			        		$data = array(
			        			'id_transaction' => $list_transaction->id_transaction,
			        			'transaction_number' => $list_transaction->transaction_number,
			        			'account_name' => $account_name,
			        			'total_transaction_distribution' => $total_transaction_distribution,
			        			'cury_amount' => number_format(($list_transaction->cury_amount)*1, $decimal_after),
			        			'ppn' => number_format(($list_transaction->ppn)*1, $decimal_after),
			        			'pph' => number_format(($list_transaction->pph)*1, $decimal_after),
			        		);
			        		array_push($data_array, $data);
			        	}
			        }
			        echo json_encode(array(array('status' => $status, 'response' => $data_array)));
				}
			}
		}
}