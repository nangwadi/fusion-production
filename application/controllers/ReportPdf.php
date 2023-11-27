<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportPdf extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
        //$this->load->library('qrcode');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_essread');
        $this->load->model('m_jomread');
        $this->load->model('m_distributionread');
        $this->load->model('m_coaread');
	}

	public function index(){
		$this->load->view('login');
	}

	// ====================================================================== DISTRIBUTION ===========================================================================

	public function purchase_order($key_session, $purchase_order_number){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');

		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('4');
			$purchase_order_number_get = $this->uri->segment('5');
			$result_key_session = $this->m_essread->check_session($company_id_session, $cNIK_session);
			$key_session_db = $result_key_session[0]->session;

			if ($key_session_db != $key_session_get) {
				$this->load->view('login');
				//echo json_encode($result_key_session);
			}
			else {

				function currency_to_words($num){
					$ones = array(
						0 =>"ZERO",
						1 => "ONE",
						2 => "TWO",
						3 => "THREE",
						4 => "FOUR",
						5 => "FIVE",
						6 => "SIX",
						7 => "SEVEN",
						8 => "EIGHT",
						9 => "NINE",
						10 => "TEN",
						11 => "ELEVEN",
						12 => "TWELVE",
						13 => "THIRTEEN",
						14 => "FOURTEEN",
						15 => "FIFTEEN",
						16 => "SIXTEEN",
						17 => "SEVENTEEN",
						18 => "EIGHTEEN",
						19 => "NINETEEN",
						"014" => "FOURTEEN"
					);
					$tens = array( 
						0 => "ZERO",
						1 => "TEN",
						2 => "TWENTY",
						3 => "THIRTY", 
						4 => "FORTY", 
						5 => "FIFTY", 
						6 => "SIXTY", 
						7 => "SEVENTY", 
						8 => "EIGHTY", 
						9 => "NINETY" 
					); 
					$hundreds = array( 
						"HUNDRED", 
						"THOUSAND", 
						"MILLION", 
						"BILLION", 
						"TRILLION", 
						"QUARDRILLION" 
					); /*limit t quadrillion */
					$num = number_format($num, 2,".",","); 
					$num_arr = explode(".",$num); 
					$wholenum = $num_arr[0]; 
					$decnum = $num_arr[1]; 
					$whole_arr = array_reverse(explode(",",$wholenum)); 
					krsort($whole_arr,1); 
					$rettxt = ""; 
					foreach($whole_arr as $key => $i){

						while(substr($i,0,1)=="0")
							$i=substr($i,1,5);
							if($i < 20){ 
								/* echo "getting:".$i; */
								$rettxt .= $ones[$i]; 
							}
							elseif($i < 100){ 
								if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
								if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
							}
							else{ 
								if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
								if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
								if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
							} 
							if($key > 0){ 
								$rettxt .= " ".$hundreds[$key]." "; 
							}
					} 

					if($decnum > 0){
						$rettxt .= " and ";
						if($decnum < 20){
							$rettxt .= $ones[$decnum];
						}
						elseif($decnum < 100){
							$rettxt .= $tens[substr($decnum,0,1)];
							$rettxt .= " ".$ones[substr($decnum,1,1)];
						}
					}
					return $rettxt;
				}

				$result_company = $this->m_essread->list_company($company_id_session);
				$company_name = $result_company[0]->company_name;
				$company_address = $result_company[0]->company_address;
				$company_city = $result_company[0]->company_city;
				$company_phone = $result_company[0]->company_phone;
				$company_fax = $result_company[0]->company_fax;
				$company_postal_code = $result_company[0]->company_postal_code;

				$data_header ['company_name'] = strtoupper($company_name);
				$data_header ['company_address'] = $company_address;
				$data_header ['company_city'] = $company_city;
				$data_header ['company_phone'] = $company_phone;
				$data_header ['company_fax'] = $company_fax;
				$data_header ['company_postal_code'] = $company_postal_code;

				$purchase_order_number = str_replace('XX', '/', $purchase_order_number_get);
				$data ['purchase_order_number'] = $purchase_order_number;

				$list_purchase_order = $this->m_distributionread->list_purchase_order_by_purchase_order_number($company_id_session, $purchase_order_number);
				$account_name = $list_purchase_order[0]->account_name;
				$account_add = $list_purchase_order[0]->account_add;
				$main_address = $list_purchase_order[0]->main_address;
				$city = $list_purchase_order[0]->city;
				$postal_code = $list_purchase_order[0]->postal_code;
				$phone_1 = $list_purchase_order[0]->phone_1;
				$fax = $list_purchase_order[0]->fax;
				$attn = $list_purchase_order[0]->attn;
				$purchase_order_date = date_format(date_create($list_purchase_order[0]->purchase_order_date), 'd M Y');
				$coa_currency_cd = $list_purchase_order[0]->coa_currency_cd;
				$decimal_after = $list_purchase_order[0]->decimal_after;
				$note = $list_purchase_order[0]->note;
				
				$rate = $list_purchase_order[0]->rate;
				$rate_format = number_format($rate, $decimal_after);

				$sub_amount = $list_purchase_order[0]->sub_amount;
				$sub_amount_format = number_format($sub_amount, $decimal_after);

				$discount_amount = $list_purchase_order[0]->discount_amount;
				$discount_amount_format = number_format($discount_amount, $decimal_after);

				$ppn = $list_purchase_order[0]->ppn;
				$ppn_format = number_format($ppn, $decimal_after);

				$pph = $list_purchase_order[0]->pph;
				$pph_format = number_format($pph, $decimal_after);

				$total_amount = $list_purchase_order[0]->total_amount;
				$total_amount_format = number_format($total_amount, $decimal_after);
				
				$cNIK_approval = $list_purchase_order[0]->cNIK_approval;
				$cNmPegawai_approval = $list_purchase_order[0]->cNmPegawai_approval;

				$result_employee = $this->m_essread->list_employee($company_id_session, '1', $cNIK_approval);
				$cNmJbtn = $result_employee[0]->cNmJbtn;

				$sequence = $list_purchase_order[0]->sequence;

				//$terbilang = currency_to_words($total_amount);

				$data_header ['account_name'] = $account_name;
				$data_header ['main_address'] = $main_address;
				$data_header ['city'] = $city;
				$data_header ['postal_code'] = $postal_code;
				$data_header ['phone_1'] = $phone_1;
				$data_header ['fax'] = $fax;
				$data_header ['attn'] = $attn;
				$data_header ['purchase_order_date'] = $purchase_order_date;
				$data_header ['purchase_order_number'] = $purchase_order_number;
				$data_header ['coa_currency_cd'] = $coa_currency_cd;
				$data_header ['rate_format'] = $rate_format;
				$data_header ['list_purchase_order'] = $list_purchase_order;
				$data_header ['cNmPegawai_approval'] = $cNmPegawai_approval;
				$data_header ['cNmJbtn'] = $cNmJbtn;
				$data_header ['note'] = $note;

				$data_header ['sub_amount'] = $sub_amount_format;
				$data_header ['discount_amount'] = $discount_amount_format;
				$data_header ['ppn'] = $ppn_format;
				$data_header ['pph'] = $pph_format;
				$data_header ['total_amount'] = $total_amount_format;
				$data_header ['terbilang'] = currency_to_words($total_amount);

				$mpdf = new \Mpdf\Mpdf(
					[
						'mode' => 'utf-8', 
						'format' => 'A4',
						'setAutoTopMargin' => 'stretch',
						'autoMarginPadding' => 0.5
					]
				);

				$mpdf->SetTitle($purchase_order_number);

				$mpdf->simpleTables = false;
				$mpdf->packTableData = true;
				$mpdf->keep_table_proportions = TRUE;
				$mpdf->shrink_tables_to_fit=1;

				$mpdf->AddPageByArray([
				    'margin-left' => 5.0,
				    'margin-right' => 5.0,
				    'margin-top' => 77,
				    'margin-bottom' => 80,
				]);

				$mpdf->showWatermarkText = true;
				
				$data_body_header = $this->load->view('report/pdf/distribution/header-purchase-order', $data_header, TRUE);				
				$mpdf->SetHTMLHeader($data_body_header, '0', TRUE);

				if ($sequence<=2) {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/NOT-APPROVED.png', 0.1, 'P', 'D');
					$approve_by = '';
				}
				else {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/APPROVED.png', 0.2, 'P', 'D');
					$approve_by = 'Approved By';
				}

				$data_header ['approve_by'] = $approve_by;

				$mpdf->showWatermarkImage = true;

				$result_purchase_order_line = $this->m_distributionread->list_purchase_order_line_by_purchase_order_number($company_id_session, $purchase_order_number);
				
				$mpdf->WriteHTML('<table autosize="1" width="100%" style="overflow: wrap; font-size:12px;">');
					for ($a=0; $a<count($result_purchase_order_line); $a++){

						$JobNo_line = $result_purchase_order_line[$a]->JobNo;
						$description_line = $result_purchase_order_line[$a]->description;
						$purchase_order_line_qty_line = $result_purchase_order_line[$a]->purchase_order_line_qty;
						$uom_cd_line = $result_purchase_order_line[$a]->uom_cd;
						$unit_price_line = $result_purchase_order_line[$a]->unit_price;
						$amount_line = $result_purchase_order_line[$a]->amount;
						$coa_cd_line = $result_purchase_order_line[$a]->coa_cd;
						$decimal_after_line = $result_purchase_order_line[$a]->decimal_after;

						$unit_price_line_format = number_format($unit_price_line, $decimal_after);
						$amount_line_format = number_format($amount_line, $decimal_after);

						if ($JobNo_line=='') {
							$JobNo_line_desc = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else {
							$JobNo_line_desc = $JobNo_line;
						}

						if ($a % 2 == 0){
							$rgb = '255, 255, 255';
						}
						else {
							$rgb = '245, 245, 245';
						}

						$mpdf->WriteHTML('<tr style="background-color:rgb('.$rgb.');">');
							$mpdf->WriteHTML('<td style="width:35px; height:30px; vertical-align:top;" align="center"><div style="display: block;">'.($a+1).'</div></td>');
							$mpdf->WriteHTML('<td style="width:75px; vertical-align:top; max-width:75px; display: block;" align="center"><div style="display: block;">'.$JobNo_line_desc.'</div></td>');
							$mpdf->WriteHTML('<td style="width:210px; vertical-align:top; max-width:210px;"><div style="display: block;">'.$description_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:40px; vertical-align:top;" align="center"><div style="display: block;">'.$purchase_order_line_qty_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:50px; vertical-align:top;" align="center"><div style="display: block;">'.$uom_cd_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:110px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$unit_price_line_format.'</div></td>');
							$mpdf->WriteHTML('<td style="width:135px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$amount_line_format.'</div></td>');
							$mpdf->WriteHTML('<td style="width:75px; vertical-align:top;" align="center"><div style="display: block;">'.$coa_cd_line.'</div></td>');
						$mpdf->WriteHTML('</tr>');
					}
				$mpdf->WriteHTML('</table>');

				$data_body_footer = $this->load->view('report/pdf/distribution/footer-purchase-order', $data_header, TRUE);
				$mpdf->SetHTMLFooter($data_body_footer, '0', TRUE);


				$mpdf->Output();
			}			
		}
	}

	public function purchase_receipt($key_session, $purchase_receipt_number){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');

		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('4');
			$purchase_receipt_number_get = $this->uri->segment('5');
			$result_key_session = $this->m_essread->check_session($company_id_session, $cNIK_session);
			$key_session_db = $result_key_session[0]->session;

			if ($key_session_db != $key_session_get) {
				$this->load->view('login');
				//echo json_encode($result_key_session);
			}
			else {

				$result_company = $this->m_essread->list_company($company_id_session);
				$company_name = $result_company[0]->company_name;
				$company_address = $result_company[0]->company_address;
				$company_city = $result_company[0]->company_city;
				$company_phone = $result_company[0]->company_phone;
				$company_fax = $result_company[0]->company_fax;
				$company_postal_code = $result_company[0]->company_postal_code;

				$data_header ['company_name'] = strtoupper($company_name);
				$data_header ['company_address'] = $company_address;
				$data_header ['company_city'] = $company_city;
				$data_header ['company_phone'] = $company_phone;
				$data_header ['company_fax'] = $company_fax;
				$data_header ['company_postal_code'] = $company_postal_code;

				$purchase_receipt_number = str_replace('XX', '/', $purchase_receipt_number_get);
				$data ['purchase_receipt_number'] = $purchase_receipt_number;

				$list_purchase_receipt = $this->m_distributionread->list_purchase_receipt_by_purchase_receipt_number($company_id_session, $purchase_receipt_number);
				$purchase_order_number = $list_purchase_receipt[0]->purchase_order_number;
				$account_name = $list_purchase_receipt[0]->account_name;
				$account_add = $list_purchase_receipt[0]->account_add;
				$main_address = $list_purchase_receipt[0]->main_address;
				$city = $list_purchase_receipt[0]->city;
				$postal_code = $list_purchase_receipt[0]->postal_code;
				$phone_1 = $list_purchase_receipt[0]->phone_1;
				$fax = $list_purchase_receipt[0]->fax;
				$attn = $list_purchase_receipt[0]->attn;
				$purchase_receipt_date = date_format(date_create($list_purchase_receipt[0]->purchase_receipt_date), 'd M Y');
				$coa_currency_cd = $list_purchase_receipt[0]->coa_currency_cd;
				$decimal_after = $list_purchase_receipt[0]->decimal_after;
				$note = $list_purchase_receipt[0]->note;
				$create_date = $list_purchase_receipt[0]->create_date;
				
				$rate = $list_purchase_receipt[0]->rate;
				$rate_format = number_format($rate, $decimal_after);

				$sub_amount = $list_purchase_receipt[0]->sub_amount;
				$sub_amount_format = number_format($sub_amount, $decimal_after);

				$discount_amount = $list_purchase_receipt[0]->discount_amount;
				$discount_amount_format = number_format($discount_amount, $decimal_after);

				$ppn = $list_purchase_receipt[0]->ppn;
				$ppn_format = number_format($ppn, $decimal_after);

				$pph = $list_purchase_receipt[0]->pph;
				$pph_format = number_format($pph, $decimal_after);

				$total_amount = $list_purchase_receipt[0]->total_amount;
				$total_amount_format = number_format($total_amount, $decimal_after);
				
				$cNIK_approval = $list_purchase_receipt[0]->cNIK_approval;
				$cNmPegawai_approval = $list_purchase_receipt[0]->cNmPegawai_approval;

				$result_employee = $this->m_essread->list_employee($company_id_session, '1', $cNIK_approval);
				$cNmJbtn = $result_employee[0]->cNmJbtn;

				$sequence = $list_purchase_receipt[0]->sequence;
				$create_date = date_format(date_create($list_purchase_receipt[0]->create_date), 'd M Y H:i');

				$total_qty = $list_purchase_receipt[0]->total_qty;
				$vendor_receipt_number = $list_purchase_receipt[0]->vendor_receipt_number;

				//$terbilang = currency_to_words($total_amount);

				$data_header ['account_name'] = $account_name;
				$data_header ['main_address'] = $main_address;
				$data_header ['city'] = $city;
				$data_header ['postal_code'] = $postal_code;
				$data_header ['phone_1'] = $phone_1;
				$data_header ['fax'] = $fax;
				$data_header ['attn'] = $attn;
				$data_header ['purchase_receipt_date'] = $purchase_receipt_date;
				$data_header ['purchase_order_number'] = $purchase_order_number;
				$data_header ['purchase_receipt_number'] = $purchase_receipt_number;
				$data_header ['coa_currency_cd'] = $coa_currency_cd;
				$data_header ['rate_format'] = $rate_format;
				$data_header ['note'] = $note;
				$data_header ['create_date'] = $create_date;

				$data_header ['sub_amount'] = $sub_amount_format;
				$data_header ['discount_amount'] = $discount_amount_format;
				$data_header ['ppn'] = $ppn_format;
				$data_header ['pph'] = $pph_format;
				$data_header ['total_amount'] = $total_amount_format;
				$data_header ['total_qty'] = $total_qty;
				$data_header ['vendor_receipt_number'] = $vendor_receipt_number;

				$mpdf = new \Mpdf\Mpdf(
					[
						'mode' => 'utf-8', 
						'format' => 'A4',
						'setAutoTopMargin' => 'stretch',
						'autoMarginPadding' => 0.5
					]
				);

				$mpdf->SetTitle($purchase_receipt_number);

				$mpdf->simpleTables = false;
				$mpdf->packTableData = true;
				$mpdf->keep_table_proportions = TRUE;
				$mpdf->shrink_tables_to_fit=1;

				$mpdf->AddPageByArray([
				    'margin-left' => 5.0,
				    'margin-right' => 5.0,
				    'margin-top' => 77,
				    'margin-bottom' => 10,
				]);

				$mpdf->showWatermarkText = true;
				
				$data_body_header = $this->load->view('report/pdf/distribution/header-purchase-receipt', $data_header, TRUE);				
				$mpdf->SetHTMLHeader($data_body_header, '0', TRUE);

				$mpdf->setFooter('Meiwa Fusion v2. Print Date : '.date('d M Y H:i').'. Page {PAGENO}');

				if ($sequence<=2) {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/NOT-RECEIVED.png', 0.1, 'P', 'D');
					$approve_by = '';
				}
				else {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/RECEIVED.png', 0.2, 'P', 'D');
					$approve_by = 'Approved By';
				}

				$data_header ['approve_by'] = $approve_by;

				$mpdf->showWatermarkImage = true;

				$result_purchase_receipt_line = $this->m_distributionread->list_purchase_receipt_line_by_purchase_receipt_number($company_id_session, $purchase_receipt_number);
				
				$mpdf->WriteHTML('<table autosize="1" style="overflow: wrap; font-size:12px;">');
					for ($a=0; $a<count($result_purchase_receipt_line); $a++){

						$JobNo_line = $result_purchase_receipt_line[$a]->JobNo;
						$description_line = $result_purchase_receipt_line[$a]->description;
						$purchase_receipt_line_qty_line = $result_purchase_receipt_line[$a]->purchase_receipt_line_qty;
						$uom_cd_line = $result_purchase_receipt_line[$a]->uom_cd;
						$purchase_order_number_line = $result_purchase_receipt_line[$a]->purchase_order_number;
						$amount_line = $result_purchase_receipt_line[$a]->amount;
						$coa_cd_line = $result_purchase_receipt_line[$a]->coa_cd;

						if ($JobNo_line=='') {
							$JobNo_line_desc = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else {
							$JobNo_line_desc = $JobNo_line;
						}

						if ($a % 2 == 0){
							$rgb = '255, 255, 255';
							//$rgb = '100, 100, 100';
						}
						else {
							$rgb = '245, 245, 245';
						}

						$mpdf->WriteHTML('<tr style="background-color:rgb('.$rgb.');">');
							$mpdf->WriteHTML('<td style="width:52px; height:25px; vertical-align:top;" align="center"><div style="display: block;">'.($a+1).'</div></td>');
							$mpdf->WriteHTML('<td style="width:98px; vertical-align:top; max-width:75px; display: block;" align="center"><div style="display: block;">'.$JobNo_line_desc.'</div></td>');
							$mpdf->WriteHTML('<td style="width:344px; vertical-align:top; max-width:210px;"><div style="display: block;">'.$description_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:53px; vertical-align:top;" align="center"><div style="display: block;">'.$purchase_receipt_line_qty_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:67px; vertical-align:top;" align="center"><div style="display: block;">'.$uom_cd_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:140px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$purchase_order_number_line.'</div></td>');
						$mpdf->WriteHTML('</tr>');
					}
				$mpdf->WriteHTML('</table>');

				//$mpdf->WriteHTML(json_encode($list_purchase_receipt));

				//$data_body_footer = $this->load->view('report/pdf/distribution/footer-purchase-receipt', $data_header, TRUE);
				//$mpdf->SetHTMLFooter($data_body_footer, '0', TRUE);


				$mpdf->Output();
			}			
		}
	}

	public function purchase_invoice($key_session, $purchase_invoice_number){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');

		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('4');
			$purchase_invoice_number_get = $this->uri->segment('5');
			$result_key_session = $this->m_essread->check_session($company_id_session, $cNIK_session);
			$key_session_db = $result_key_session[0]->session;

			if ($key_session_db != $key_session_get) {
				$this->load->view('login');
				//echo json_encode($result_key_session);
			}
			else {

				$result_company = $this->m_essread->list_company($company_id_session);
				$company_name = $result_company[0]->company_name;
				$company_address = $result_company[0]->company_address;
				$company_city = $result_company[0]->company_city;
				$company_phone = $result_company[0]->company_phone;
				$company_fax = $result_company[0]->company_fax;
				$company_postal_code = $result_company[0]->company_postal_code;

				$data_header ['company_name'] = strtoupper($company_name);
				$data_header ['company_address'] = $company_address;
				$data_header ['company_city'] = $company_city;
				$data_header ['company_phone'] = $company_phone;
				$data_header ['company_fax'] = $company_fax;
				$data_header ['company_postal_code'] = $company_postal_code;

				$purchase_invoice_number = str_replace('XX', '/', $purchase_invoice_number_get);
				$data ['purchase_invoice_number'] = $purchase_invoice_number;

				$list_purchase_invoice = $this->m_distributionread->list_purchase_invoice_by_purchase_invoice_number($company_id_session, $purchase_invoice_number);
				$purchase_order_number = $list_purchase_invoice[0]->purchase_order_number;
				$account_name = $list_purchase_invoice[0]->account_name;
				$account_add = $list_purchase_invoice[0]->account_add;
				$main_address = $list_purchase_invoice[0]->main_address;
				$city = $list_purchase_invoice[0]->city;
				$postal_code = $list_purchase_invoice[0]->postal_code;
				$phone_1 = $list_purchase_invoice[0]->phone_1;
				$fax = $list_purchase_invoice[0]->fax;
				$attn = $list_purchase_invoice[0]->attn;
				$purchase_invoice_date = date_format(date_create($list_purchase_invoice[0]->purchase_invoice_date), 'd M Y');
				$coa_currency_cd = $list_purchase_invoice[0]->coa_currency_cd;
				$decimal_after = $list_purchase_invoice[0]->decimal_after;
				$note = $list_purchase_invoice[0]->note;
				$create_date = $list_purchase_invoice[0]->create_date;
				
				$rate = $list_purchase_invoice[0]->rate;
				$rate_format = number_format($rate, $decimal_after);

				$sub_amount = $list_purchase_invoice[0]->sub_amount;
				$sub_amount_format = number_format($sub_amount, $decimal_after);

				$discount_amount = $list_purchase_invoice[0]->discount_amount;
				$discount_amount_format = number_format($discount_amount, $decimal_after);

				$ppn = $list_purchase_invoice[0]->ppn;
				$ppn_format = number_format($ppn, $decimal_after);

				$pph = $list_purchase_invoice[0]->pph;
				$pph_format = number_format($pph, $decimal_after);

				$total_amount = $list_purchase_invoice[0]->total_amount;
				$total_amount_format = number_format($total_amount, $decimal_after);
				
				$cNIK_approval = $list_purchase_invoice[0]->cNIK_approval;
				$cNmPegawai_approval = $list_purchase_invoice[0]->cNmPegawai_approval;

				$result_employee = $this->m_essread->list_employee($company_id_session, '1', $cNIK_approval);
				$cNmJbtn = $result_employee[0]->cNmJbtn;

				$sequence = $list_purchase_invoice[0]->sequence;
				$create_date = date_format(date_create($list_purchase_invoice[0]->create_date), 'd M Y H:i');

				$total_qty = $list_purchase_invoice[0]->total_qty;
				$vendor_invoice_number = $list_purchase_invoice[0]->vendor_invoice_number;

				//$terbilang = currency_to_words($total_amount);

				$data_header ['account_name'] = $account_name;
				$data_header ['main_address'] = $main_address;
				$data_header ['city'] = $city;
				$data_header ['postal_code'] = $postal_code;
				$data_header ['phone_1'] = $phone_1;
				$data_header ['fax'] = $fax;
				$data_header ['attn'] = $attn;
				$data_header ['purchase_invoice_date'] = $purchase_invoice_date;
				$data_header ['purchase_order_number'] = $purchase_order_number;
				$data_header ['purchase_invoice_number'] = $purchase_invoice_number;
				$data_header ['coa_currency_cd'] = $coa_currency_cd;
				$data_header ['rate_format'] = $rate_format;
				$data_header ['note'] = $note;
				$data_header ['create_date'] = $create_date;

				$data_header ['sub_amount'] = $sub_amount_format;
				$data_header ['discount_amount'] = $discount_amount_format;
				$data_header ['ppn'] = $ppn_format;
				$data_header ['pph'] = $pph_format;
				$data_header ['total_amount'] = $total_amount_format;
				$data_header ['total_qty'] = $total_qty;
				$data_header ['vendor_invoice_number'] = $vendor_invoice_number;

				$mpdf = new \Mpdf\Mpdf(
					[
						'mode' => 'utf-8', 
						'format' => 'A4',
						'setAutoTopMargin' => 'stretch',
						'autoMarginPadding' => 0.5
					]
				);

				$mpdf->SetTitle($purchase_invoice_number);

				$mpdf->simpleTables = false;
				$mpdf->packTableData = true;
				$mpdf->keep_table_proportions = TRUE;
				$mpdf->shrink_tables_to_fit=1;

				$mpdf->AddPageByArray([
				    'margin-left' => 5.0,
				    'margin-right' => 5.0,
				    'margin-top' => 85,
				    'margin-bottom' => 10,
				]);

				$mpdf->showWatermarkText = true;
				
				$data_body_header = $this->load->view('report/pdf/distribution/header-purchase-invoice', $data_header, TRUE);				
				$mpdf->SetHTMLHeader($data_body_header, '0', TRUE);

				$mpdf->setFooter('Meiwa Fusion v2. Print Date : '.date('d M Y H:i'));

				$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/PURCHASE-INVOICE.png', 0.2, 'P', 'D');
				$approve_by = 'Approved By';

				$data_header ['approve_by'] = $approve_by;

				$mpdf->showWatermarkImage = true;

				$result_purchase_invoice_line = $this->m_distributionread->list_purchase_invoice_line_by_purchase_invoice_number($company_id_session, $purchase_invoice_number);
				
				$mpdf->WriteHTML('<table autosize="1" style="overflow: wrap; font-size:13px;">');
					/*for ($a=0; $a<4; $a++){

						if ($a % 2 == 0){
							$rgb = '255, 255, 255';
							//$rgb = '100, 100, 100';
						}
						else {
							$rgb = '245, 245, 245';
						}*/

						$mpdf->WriteHTML('<tr>');
							$mpdf->WriteHTML('<td style="width:200px; padding-left:10px; height:25px; vertical-align:top;"><div style="display: block;">Total Amount</div></td>');
							$mpdf->WriteHTML('<td style="width:40px; vertical-align:top; max-width:75px; display: block;"><div style="display: block;"> : '.$coa_currency_cd.'</div></td>');
							$mpdf->WriteHTML('<td style="width:120px; vertical-align:top; max-width:75px; display: block;" align="right"><div style="display: block;">'.$sub_amount_format.'</div></td>');
						$mpdf->WriteHTML('</tr>');

						$mpdf->WriteHTML('<tr style="background-color:rgb(245, 245, 245);">');
							$mpdf->WriteHTML('<td style="width:200px; padding-left:10px; height:25px; vertical-align:top;"><div style="display: block;">Discount Amount</div></td>');
							$mpdf->WriteHTML('<td style="width:40px; vertical-align:top; max-width:75px; display: block;"><div style="display: block;"> : '.$coa_currency_cd.'</div></td>');
							$mpdf->WriteHTML('<td style="width:120px; vertical-align:top; max-width:75px; display: block;" align="right"><div style="display: block;">'.$discount_amount_format.'</div></td>');
						$mpdf->WriteHTML('</tr>');

						$mpdf->WriteHTML('<tr>');
							$mpdf->WriteHTML('<td style="width:200px; padding-left:10px; height:25px; vertical-align:top;"><div style="display: block;">Tax (+)</div></td>');
							$mpdf->WriteHTML('<td style="width:40px; vertical-align:top; max-width:75px; display: block;"><div style="display: block;"> : '.$coa_currency_cd.'</div></td>');
							$mpdf->WriteHTML('<td style="width:120px; vertical-align:top; max-width:75px; display: block;" align="right"><div style="display: block;">'.$ppn_format.'</div></td>');
						$mpdf->WriteHTML('</tr>');

						$mpdf->WriteHTML('<tr style="background-color:rgb(245, 245, 245);">');
							$mpdf->WriteHTML('<td style="width:200px; padding-left:10px; height:25px; vertical-align:top;"><div style="display: block;">Tax (-)</div></td>');
							$mpdf->WriteHTML('<td style="width:40px; vertical-align:top; max-width:75px; display: block;"><div style="display: block;"> : '.$coa_currency_cd.'</div></td>');
							$mpdf->WriteHTML('<td style="width:120px; vertical-align:top; max-width:75px; display: block;" align="right"><div style="display: block;">'.$pph_format.'</div></td>');
						$mpdf->WriteHTML('</tr>');

						$mpdf->WriteHTML('<tr>');
							$mpdf->WriteHTML('<td style="width:200px; padding-right:10px; height:25px; vertical-align:top; border-top: 2px solid black; font-weight:bold;" align="right"><div style="display: block;">Total Payment</div></td>');
							$mpdf->WriteHTML('<td style="width:40px; vertical-align:top; max-width:75px; display: block; border-top: 2px solid black; font-weight:bold;"><div style="display: block;"> : '.$coa_currency_cd.'</div></td>');
							$mpdf->WriteHTML('<td style="width:120px; vertical-align:top; max-width:75px; display: block; border-top: 2px solid black; font-weight:bold;" align="right"><div style="display: block;">'.$total_amount_format.'</div></td>');
						$mpdf->WriteHTML('</tr>');
					//}
				$mpdf->WriteHTML('</table>');

				//$mpdf->WriteHTML(json_encode($list_purchase_invoice));

				$data_body_footer = $this->load->view('report/pdf/distribution/footer-purchase-invoice', $data_header, TRUE);
				$mpdf->SetHTMLFooter($data_body_footer, '0', TRUE);


				$mpdf->Output();
			}			
		}
	}

	public function sales_order($key_session, $sales_order_number){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');

		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('4');
			$sales_order_number_get = $this->uri->segment('5');
			$result_key_session = $this->m_essread->check_session($company_id_session, $cNIK_session);
			$key_session_db = $result_key_session[0]->session;

			if ($key_session_db != $key_session_get) {
				$this->load->view('login');
				//echo json_encode($result_key_session);
			}
			else {

				function currency_to_words($num){
					$ones = array(
						0 =>"ZERO",
						1 => "ONE",
						2 => "TWO",
						3 => "THREE",
						4 => "FOUR",
						5 => "FIVE",
						6 => "SIX",
						7 => "SEVEN",
						8 => "EIGHT",
						9 => "NINE",
						10 => "TEN",
						11 => "ELEVEN",
						12 => "TWELVE",
						13 => "THIRTEEN",
						14 => "FOURTEEN",
						15 => "FIFTEEN",
						16 => "SIXTEEN",
						17 => "SEVENTEEN",
						18 => "EIGHTEEN",
						19 => "NINETEEN",
						"014" => "FOURTEEN"
					);
					$tens = array( 
						0 => "ZERO",
						1 => "TEN",
						2 => "TWENTY",
						3 => "THIRTY", 
						4 => "FORTY", 
						5 => "FIFTY", 
						6 => "SIXTY", 
						7 => "SEVENTY", 
						8 => "EIGHTY", 
						9 => "NINETY" 
					); 
					$hundreds = array( 
						"HUNDRED", 
						"THOUSAND", 
						"MILLION", 
						"BILLION", 
						"TRILLION", 
						"QUARDRILLION" 
					); /*limit t quadrillion */
					$num = number_format($num, 2,".",","); 
					$num_arr = explode(".",$num); 
					$wholenum = $num_arr[0]; 
					$decnum = $num_arr[1]; 
					$whole_arr = array_reverse(explode(",",$wholenum)); 
					krsort($whole_arr,1); 
					$rettxt = ""; 
					foreach($whole_arr as $key => $i){

						while(substr($i,0,1)=="0")
							$i=substr($i,1,5);
							if($i < 20){ 
								/* echo "getting:".$i; */
								$rettxt .= $ones[$i]; 
							}
							elseif($i < 100){ 
								if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
								if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
							}
							else{ 
								if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
								if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
								if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
							} 
							if($key > 0){ 
								$rettxt .= " ".$hundreds[$key]." "; 
							}
					} 

					if($decnum > 0){
						$rettxt .= " and ";
						if($decnum < 20){
							$rettxt .= $ones[$decnum];
						}
						elseif($decnum < 100){
							$rettxt .= $tens[substr($decnum,0,1)];
							$rettxt .= " ".$ones[substr($decnum,1,1)];
						}
					}
					return $rettxt;
				}

				$result_company = $this->m_essread->list_company($company_id_session);
				$company_name = $result_company[0]->company_name;
				$company_address = $result_company[0]->company_address;
				$company_city = $result_company[0]->company_city;
				$company_phone = $result_company[0]->company_phone;
				$company_fax = $result_company[0]->company_fax;
				$company_postal_code = $result_company[0]->company_postal_code;

				$data_header ['company_name'] = strtoupper($company_name);
				$data_header ['company_address'] = $company_address;
				$data_header ['company_city'] = $company_city;
				$data_header ['company_phone'] = $company_phone;
				$data_header ['company_fax'] = $company_fax;
				$data_header ['company_postal_code'] = $company_postal_code;

				$sales_order_number = str_replace('XX', '/', $sales_order_number_get);
				$data ['sales_order_number'] = $sales_order_number;

				$list_sales_order = $this->m_distributionread->list_sales_order_by_sales_order_number($company_id_session, $sales_order_number);
				$account_name = $list_sales_order[0]->account_name;
				$account_add = $list_sales_order[0]->account_add;
				$main_address = $list_sales_order[0]->main_address;
				$city = $list_sales_order[0]->city;
				$postal_code = $list_sales_order[0]->postal_code;
				$phone_1 = $list_sales_order[0]->phone_1;
				$fax = $list_sales_order[0]->fax;
				$attn = $list_sales_order[0]->attn;
				$id_country = $list_sales_order[0]->id_country;
				$country_name = $list_sales_order[0]->country_name;

				$account_name_project = $list_sales_order[0]->account_name_project;
				$account_add_project = $list_sales_order[0]->account_add_project;
				$main_address_project = $list_sales_order[0]->main_address_project;
				$city_project = $list_sales_order[0]->city_project;
				$postal_code_project = $list_sales_order[0]->postal_code_project;
				$phone_1_project = $list_sales_order[0]->phone_1_project;
				$fax_project = $list_sales_order[0]->fax_project;
				$attn_project = $list_sales_order[0]->attn_project;
				$id_country_project = $list_sales_order[0]->id_country_project;
				$country_name_project = $list_sales_order[0]->country_name_project;

				$customer_order_number = $list_sales_order[0]->customer_order_number;
				$cNmPegawai_sales_order_owner = $list_sales_order[0]->cNmPegawai_sales_order_owner;

				$sales_order_date = date_format(date_create($list_sales_order[0]->sales_order_date), 'd M Y');
				$coa_currency_cd = $list_sales_order[0]->coa_currency_cd;
				$decimal_after = $list_sales_order[0]->decimal_after;
				$note = $list_sales_order[0]->note;
				
				$rate = $list_sales_order[0]->rate;
				$rate_format = number_format($rate, $decimal_after);

				$sub_amount = $list_sales_order[0]->sub_amount;
				$sub_amount_format = number_format($sub_amount, $decimal_after);

				$discount_amount = $list_sales_order[0]->discount_amount;
				$discount_amount_format = number_format($discount_amount, $decimal_after);

				$ppn = $list_sales_order[0]->ppn;
				$ppn_format = number_format($ppn, $decimal_after);

				$pph = $list_sales_order[0]->pph;
				$pph_format = number_format($pph, $decimal_after);

				$total_amount = $list_sales_order[0]->total_amount;
				$total_amount_format = number_format($total_amount, $decimal_after);
				
				$cNIK_approval = $list_sales_order[0]->cNIK_approval;
				$cNmPegawai_approval = $list_sales_order[0]->cNmPegawai_approval;

				$result_employee = $this->m_essread->list_employee($company_id_session, '1', $cNIK_approval);
				$cNmJbtn = $result_employee[0]->cNmJbtn;

				$sequence = $list_sales_order[0]->sequence;

				//$terbilang = currency_to_words($total_amount);

				$result_company_country = $this->m_essread->list_company($company_id_session);
				$company_country = $result_company_country[0]->company_country;

				$data_header ['company_country'] = $company_country;

				$data_header ['account_name'] = $account_name;
				$data_header ['main_address'] = $main_address;
				$data_header ['city'] = $city;
				$data_header ['postal_code'] = $postal_code;
				$data_header ['phone_1'] = $phone_1;
				$data_header ['fax'] = $fax;
				$data_header ['attn'] = $attn;
				$data_header ['id_country'] = $id_country;
				$data_header ['country_name'] = $country_name;

				$data_header ['account_name_project'] = $account_name_project;
				$data_header ['main_address_project'] = $main_address_project;
				$data_header ['city_project'] = $city_project;
				$data_header ['postal_code_project'] = $postal_code_project;
				$data_header ['phone_1_project'] = $phone_1_project;
				$data_header ['fax_project'] = $fax_project;
				$data_header ['attn_project'] = $attn_project;
				$data_header ['id_country_project'] = $id_country_project;
				$data_header ['country_name_project'] = $country_name_project;

				$data_header ['sales_order_date'] = $sales_order_date;
				$data_header ['sales_order_number'] = $sales_order_number;
				$data_header ['coa_currency_cd'] = $coa_currency_cd;
				$data_header ['rate_format'] = $rate_format;
				$data_header ['list_sales_order'] = $list_sales_order;
				$data_header ['cNmPegawai_approval'] = $cNmPegawai_approval;
				$data_header ['customer_order_number'] = $customer_order_number;
				$data_header ['cNmJbtn'] = $cNmJbtn;
				$data_header ['note'] = $note;
				$data_header ['cNmPegawai_sales_order_owner'] = $cNmPegawai_sales_order_owner;

				$data_header ['sub_amount'] = $sub_amount_format;
				$data_header ['discount_amount'] = $discount_amount_format;
				$data_header ['ppn'] = $ppn_format;
				$data_header ['pph'] = $pph_format;
				$data_header ['total_amount'] = $total_amount_format;
				$data_header ['terbilang'] = currency_to_words($total_amount);

				$mpdf = new \Mpdf\Mpdf(
					[
						'mode' => 'utf-8', 
						'format' => 'A4',
						'setAutoTopMargin' => 'stretch',
						'autoMarginPadding' => 0.5
					]
				);

				$mpdf->SetTitle($sales_order_number);

				$mpdf->simpleTables = false;
				$mpdf->packTableData = true;
				$mpdf->keep_table_proportions = TRUE;
				$mpdf->shrink_tables_to_fit=1;

				$mpdf->AddPageByArray([
				    'margin-left' => 5.0,
				    'margin-right' => 5.0,
				    'margin-top' => 100,
				    'margin-bottom' => 80,
				]);

				$mpdf->showWatermarkText = true;
				
				$data_body_header = $this->load->view('report/pdf/distribution/header-sales-order', $data_header, TRUE);				
				$mpdf->SetHTMLHeader($data_body_header, '0', TRUE);

				if ($sequence<=2) {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/NOT-APPROVED.png', 0.1, 'P', 'D');
					$approve_by = '';
				}
				else {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/APPROVED.png', 0.2, 'P', 'D');
					$approve_by = 'Approved By';
				}

				$data_header ['approve_by'] = $approve_by;

				$mpdf->showWatermarkImage = true;

				$result_sales_order_line = $this->m_distributionread->list_sales_order_line_by_sales_order_number($company_id_session, $sales_order_number);
				
				$mpdf->WriteHTML('<table autosize="1" width="100%" style="overflow: wrap; font-size:12px;">');
					for ($a=0; $a<count($result_sales_order_line); $a++){
					//for ($a=0; $a<14; $a++){

						$JobNo_line = $result_sales_order_line[$a]->JobNo;
						$description_line = $result_sales_order_line[$a]->description;
						$sales_order_line_qty_line = $result_sales_order_line[$a]->sales_order_line_qty;
						$uom_cd_line = $result_sales_order_line[$a]->uom_cd;
						$unit_price_line = $result_sales_order_line[$a]->unit_price;
						$amount_line = $result_sales_order_line[$a]->amount;
						$coa_cd_line = $result_sales_order_line[$a]->coa_cd;
						$decimal_after_line = $result_sales_order_line[$a]->decimal_after;

						$unit_price_line_format = number_format($unit_price_line, $decimal_after);
						$amount_line_format = number_format($amount_line, $decimal_after);

						if ($JobNo_line=='') {
							$JobNo_line_desc = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else {
							$JobNo_line_desc = $JobNo_line;
						}

						if ($a % 2 == 0){
							$rgb = '255, 255, 255';
						}
						else {
							$rgb = '245, 245, 245';
						}

						$mpdf->WriteHTML('<tr style="background-color:rgb('.$rgb.');">');
							$mpdf->WriteHTML('<td style="width:40px; height:30px; vertical-align:top;" align="center"><div style="display: block;">'.($a+1).'</div></td>');
							$mpdf->WriteHTML('<td style="width:80px; vertical-align:top; max-width:75px; display: block;" align="center"><div style="display: block;">'.$JobNo_line_desc.'</div></td>');
							$mpdf->WriteHTML('<td style="width:210px; vertical-align:top; max-width:210px;"><div style="display: block;">'.$description_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:40px; vertical-align:top;" align="center"><div style="display: block;">'.$sales_order_line_qty_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:50px; vertical-align:top;" align="center"><div style="display: block;">'.$uom_cd_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:110px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$unit_price_line_format.'</div></td>');
							$mpdf->WriteHTML('<td style="width:135px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$amount_line_format.'</div></td>');
							$mpdf->WriteHTML('<td style="width:75px; vertical-align:top;" align="center"><div style="display: block;">'.$coa_cd_line.'</div></td>');
						$mpdf->WriteHTML('</tr>');
					}

				$mpdf->WriteHTML('</table>');

				$data_body_footer = $this->load->view('report/pdf/distribution/footer-sales-order', $data_header, TRUE);
				$mpdf->SetHTMLFooter($data_body_footer, '0', TRUE);


				$mpdf->Output();
			}			
		}
	}

	public function delivery_order($key_session, $delivery_order_number){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');

		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('4');
			$delivery_order_number_get = $this->uri->segment('5');
			$result_key_session = $this->m_essread->check_session($company_id_session, $cNIK_session);
			$key_session_db = $result_key_session[0]->session;

			if ($key_session_db != $key_session_get) {
				$this->load->view('login');
			}
			else {

				$result_company = $this->m_essread->list_company($company_id_session);
				$company_name = $result_company[0]->company_name;
				$company_address = $result_company[0]->company_address;
				$company_city = $result_company[0]->company_city;
				$company_phone = $result_company[0]->company_phone;
				$company_fax = $result_company[0]->company_fax;
				$company_postal_code = $result_company[0]->company_postal_code;

				$data_header ['company_name'] = strtoupper($company_name);
				$data_header ['company_address'] = $company_address;
				$data_header ['company_city'] = $company_city;
				$data_header ['company_phone'] = $company_phone;
				$data_header ['company_fax'] = $company_fax;
				$data_header ['company_postal_code'] = $company_postal_code;

				$delivery_order_number = str_replace('XX', '/', $delivery_order_number_get);
				$data ['delivery_order_number'] = $delivery_order_number;

				$list_delivery_order = $this->m_distributionread->list_delivery_order_by_delivery_order_number($company_id_session, $delivery_order_number);
				$account_name = $list_delivery_order[0]->account_name;
				$account_add = $list_delivery_order[0]->account_add;
				$main_address = $list_delivery_order[0]->main_address;
				$city = $list_delivery_order[0]->city;
				$postal_code = $list_delivery_order[0]->postal_code;
				$phone_1 = $list_delivery_order[0]->phone_1;
				$fax = $list_delivery_order[0]->fax;
				$attn = $list_delivery_order[0]->attn;
				$id_country = $list_delivery_order[0]->id_country;
				$country_name = $list_delivery_order[0]->country_name;

				$account_name_project = $list_delivery_order[0]->account_name_project;
				$account_add_project = $list_delivery_order[0]->account_add_project;
				$main_address_project = $list_delivery_order[0]->main_address_project;
				$city_project = $list_delivery_order[0]->city_project;
				$postal_code_project = $list_delivery_order[0]->postal_code_project;
				$phone_1_project = $list_delivery_order[0]->phone_1_project;
				$fax_project = $list_delivery_order[0]->fax_project;
				$attn_project = $list_delivery_order[0]->attn_project;
				$id_country_project = $list_delivery_order[0]->id_country_project;
				$country_name_project = $list_delivery_order[0]->country_name_project;

				$customer_order_number = $list_delivery_order[0]->customer_order_number;
				$cNmPegawai_delivery_order_owner = $list_delivery_order[0]->cNmPegawai_delivery_order_owner;

				$delivery_order_date = date_format(date_create($list_delivery_order[0]->delivery_order_date), 'd M Y');
				$coa_currency_cd = $list_delivery_order[0]->coa_currency_cd;
				$decimal_after = $list_delivery_order[0]->decimal_after;
				$note = $list_delivery_order[0]->note;
				
				$rate = $list_delivery_order[0]->rate;
				$rate_format = number_format($rate, $decimal_after);

				$sub_amount = $list_delivery_order[0]->sub_amount;
				$sub_amount_format = number_format($sub_amount, $decimal_after);

				$discount_amount = $list_delivery_order[0]->discount_amount;
				$discount_amount_format = number_format($discount_amount, $decimal_after);

				$ppn = $list_delivery_order[0]->ppn;
				$ppn_format = number_format($ppn, $decimal_after);

				$pph = $list_delivery_order[0]->pph;
				$pph_format = number_format($pph, $decimal_after);

				$total_amount = $list_delivery_order[0]->total_amount;
				$total_amount_format = number_format($total_amount, $decimal_after);
				
				$cNIK_approval = $list_delivery_order[0]->cNIK_approval;
				$cNmPegawai_approval = $list_delivery_order[0]->cNmPegawai_approval;

				$result_employee = $this->m_essread->list_employee($company_id_session, '1', $cNIK_approval);
				$cNmJbtn = $result_employee[0]->cNmJbtn;

				$sequence = $list_delivery_order[0]->sequence;

				$result_company_country = $this->m_essread->list_company($company_id_session);
				$company_country = $result_company_country[0]->company_country;

				$data_header ['company_country'] = $company_country;

				$data_header ['account_name'] = $account_name;
				$data_header ['main_address'] = $main_address;
				$data_header ['city'] = $city;
				$data_header ['postal_code'] = $postal_code;
				$data_header ['phone_1'] = $phone_1;
				$data_header ['fax'] = $fax;
				$data_header ['attn'] = $attn;
				$data_header ['id_country'] = $id_country;
				$data_header ['country_name'] = $country_name;

				$data_header ['account_name_project'] = $account_name_project;
				$data_header ['main_address_project'] = $main_address_project;
				$data_header ['city_project'] = $city_project;
				$data_header ['postal_code_project'] = $postal_code_project;
				$data_header ['phone_1_project'] = $phone_1_project;
				$data_header ['fax_project'] = $fax_project;
				$data_header ['attn_project'] = $attn_project;
				$data_header ['id_country_project'] = $id_country_project;
				$data_header ['country_name_project'] = $country_name_project;

				$data_header ['delivery_order_date'] = $delivery_order_date;
				$data_header ['delivery_order_number'] = $delivery_order_number;
				$data_header ['coa_currency_cd'] = $coa_currency_cd;
				$data_header ['rate_format'] = $rate_format;
				$data_header ['list_delivery_order'] = $list_delivery_order;
				$data_header ['cNmPegawai_approval'] = $cNmPegawai_approval;
				$data_header ['customer_order_number'] = $customer_order_number;
				$data_header ['cNmJbtn'] = $cNmJbtn;
				$data_header ['note'] = $note;
				$data_header ['cNmPegawai_delivery_order_owner'] = $cNmPegawai_delivery_order_owner;

				$data_header ['sub_amount'] = $sub_amount_format;
				$data_header ['discount_amount'] = $discount_amount_format;
				$data_header ['ppn'] = $ppn_format;
				$data_header ['pph'] = $pph_format;
				$data_header ['total_amount'] = $total_amount_format;

				$mpdf = new \Mpdf\Mpdf(
					[
						'mode' => 'utf-8', 
						'format' => 'A5',
						//'setAutoTopMargin' => 'stretch',
						//'autoMarginPadding' => 0.05,
						'orientation' => 'L'
					]
				);

				$mpdf->SetTitle($delivery_order_number);

				$mpdf->simpleTables = false;
				$mpdf->packTableData = true;
				$mpdf->keep_table_proportions = TRUE;
				$mpdf->shrink_tables_to_fit=1;

				$mpdf->AddPageByArray([
				    'margin-left' => 7.5,
				    'margin-right' => 7.5,
				    'margin-top' => 61,
				    'margin-bottom' => 40,
				]);

				
				$data_body_header = $this->load->view('report/pdf/distribution/header-delivery-order', $data_header, TRUE);				
				$mpdf->SetHTMLHeader($data_body_header, '-5', TRUE);

				/*$mpdf->showWatermarkText = true;
				if ($sequence<=2) {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/NOT-APPROVED.png', 0.1, 'P', 'D');
					$approve_by = '';
				}
				else {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/APPROVED.png', 0.2, 'P', 'D');
					$approve_by = 'Approved By';
				}

				$data_header ['approve_by'] = $approve_by;

				$mpdf->showWatermarkImage = true;*/

				$result_delivery_order_line = $this->m_distributionread->list_delivery_order_line_by_delivery_order_number($company_id_session, $delivery_order_number);
				$mpdf->WriteHTML('<table autosize="1" width="100%" style="overflow: wrap; font-size:11px;">');
					for ($a=0; $a<count($result_delivery_order_line); $a++){
					//for ($a=0; $a<6; $a++){
						$JobNo_line = $result_delivery_order_line[$a]->JobNo;
						$description_line = $result_delivery_order_line[$a]->description;
						$qty_shipment_line = $result_delivery_order_line[$a]->qty_shipment_line;
						$uom_cd_line = $result_delivery_order_line[$a]->uom_cd;
						$unit_price_line = $result_delivery_order_line[$a]->unit_price;
						$amount_line = $result_delivery_order_line[$a]->amount;
						$coa_cd_line = $result_delivery_order_line[$a]->coa_cd;
						$decimal_after_line = $result_delivery_order_line[$a]->decimal_after;

						$unit_price_line_format = number_format($unit_price_line, $decimal_after);
						$amount_line_format = number_format($amount_line, $decimal_after);

						if ($JobNo_line=='') {
							$JobNo_line_desc = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else {
							$JobNo_line_desc = $JobNo_line;
						}

						if ($a % 2 == 0){
							$rgb = '252, 252, 252';
						}
						else {
							$rgb = '250, 250, 250';
						}
						$mpdf->WriteHTML('<tr style="background-color:rgb('.$rgb.');">');
							$mpdf->WriteHTML('<td style="width:50px; height:25px; vertical-align:top;" align="center"><div style="display: block;">'.($a+1).'</div></td>');
							$mpdf->WriteHTML('<td style="width:150px; vertical-align:top; max-width:150px; display: block; padding-left:7px;"><div style="display: block;">'.$JobNo_line_desc.'</div></td>');
							$mpdf->WriteHTML('<td style="width:300px; vertical-align:top; max-width:300px; padding-left:7px;"><div style="display: block;">'.$description_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:100px; vertical-align:top;" align="center"><div style="display: block;">'.$qty_shipment_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:150px; vertical-align:top;" align="center"><div style="display: block;">'.$uom_cd_line.'</div></td>');
						$mpdf->WriteHTML('</tr>');
					}
				$mpdf->WriteHTML('</table>');

				$data_body_footer = $this->load->view('report/pdf/distribution/footer-delivery-order', $data_header, TRUE);
				$mpdf->SetHTMLFooter($data_body_footer, '0', TRUE);


				$mpdf->Output();
			}			
		}
	}

	public function sales_invoice($key_session, $sales_invoice_number){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');

		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('4');
			$sales_invoice_number_get = $this->uri->segment('5');
			$result_key_session = $this->m_essread->check_session($company_id_session, $cNIK_session);
			$key_session_db = $result_key_session[0]->session;

			if ($key_session_db != $key_session_get) {
				$this->load->view('login');
				//echo json_encode($result_key_session);
			}
			else {

				function currency_to_words($num){
					$ones = array(
						0 =>"ZERO",
						1 => "ONE",
						2 => "TWO",
						3 => "THREE",
						4 => "FOUR",
						5 => "FIVE",
						6 => "SIX",
						7 => "SEVEN",
						8 => "EIGHT",
						9 => "NINE",
						10 => "TEN",
						11 => "ELEVEN",
						12 => "TWELVE",
						13 => "THIRTEEN",
						14 => "FOURTEEN",
						15 => "FIFTEEN",
						16 => "SIXTEEN",
						17 => "SEVENTEEN",
						18 => "EIGHTEEN",
						19 => "NINETEEN",
						"014" => "FOURTEEN"
					);
					$tens = array( 
						0 => "ZERO",
						1 => "TEN",
						2 => "TWENTY",
						3 => "THIRTY", 
						4 => "FORTY", 
						5 => "FIFTY", 
						6 => "SIXTY", 
						7 => "SEVENTY", 
						8 => "EIGHTY", 
						9 => "NINETY" 
					); 
					$hundreds = array( 
						"HUNDRED", 
						"THOUSAND", 
						"MILLION", 
						"BILLION", 
						"TRILLION", 
						"QUARDRILLION" 
					); /*limit t quadrillion */
					$num = number_format($num, 2,".",","); 
					$num_arr = explode(".",$num); 
					$wholenum = $num_arr[0]; 
					$decnum = $num_arr[1]; 
					$whole_arr = array_reverse(explode(",",$wholenum)); 
					krsort($whole_arr,1); 
					$rettxt = ""; 
					foreach($whole_arr as $key => $i){

						while(substr($i,0,1)=="0")
							$i=substr($i,1,5);
							if($i < 20){ 
								/* echo "getting:".$i; */
								$rettxt .= $ones[$i]; 
							}
							elseif($i < 100){ 
								if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
								if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
							}
							else{ 
								if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
								if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
								if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
							} 
							if($key > 0){ 
								$rettxt .= " ".$hundreds[$key]." "; 
							}
					} 

					if($decnum > 0){
						$rettxt .= " and ";
						if($decnum < 20){
							$rettxt .= $ones[$decnum];
						}
						elseif($decnum < 100){
							$rettxt .= $tens[substr($decnum,0,1)];
							$rettxt .= " ".$ones[substr($decnum,1,1)];
						}
					}
					return $rettxt;
				}

				$result_company = $this->m_essread->list_company($company_id_session);
				$company_name = $result_company[0]->company_name;
				$company_address = $result_company[0]->company_address;
				$company_city = $result_company[0]->company_city;
				$company_phone = $result_company[0]->company_phone;
				$company_fax = $result_company[0]->company_fax;
				$company_postal_code = $result_company[0]->company_postal_code;

				$data_header ['company_name'] = strtoupper($company_name);
				$data_header ['company_address'] = $company_address;
				$data_header ['company_city'] = $company_city;
				$data_header ['company_phone'] = $company_phone;
				$data_header ['company_fax'] = $company_fax;
				$data_header ['company_postal_code'] = $company_postal_code;

				$sales_invoice_number = str_replace('XX', '/', $sales_invoice_number_get);
				$data ['sales_invoice_number'] = $sales_invoice_number;

				$list_sales_invoice = $this->m_distributionread->list_sales_invoice_by_sales_invoice_number($company_id_session, $sales_invoice_number);
				$account_name = $list_sales_invoice[0]->account_name;
				$account_add = $list_sales_invoice[0]->account_add;
				$main_address = $list_sales_invoice[0]->main_address;
				$city = $list_sales_invoice[0]->city;
				$postal_code = $list_sales_invoice[0]->postal_code;
				$phone_1 = $list_sales_invoice[0]->phone_1;
				$fax = $list_sales_invoice[0]->fax;
				$attn = $list_sales_invoice[0]->attn;
				$id_country = $list_sales_invoice[0]->id_country;
				$country_name = $list_sales_invoice[0]->country_name;

				$payment_terms_name = $list_sales_invoice[0]->payment_terms_name;
				$payment_methode_name = $list_sales_invoice[0]->payment_methode_name;

				$tax_number = $list_sales_invoice[0]->tax_number;

				$customer_order_number = $list_sales_invoice[0]->customer_order_number;
				$cNmPegawai_sales_invoice_owner = $list_sales_invoice[0]->cNmPegawai_sales_invoice_owner;

				$sales_invoice_date = date_format(date_create($list_sales_invoice[0]->sales_invoice_date), 'd F Y');
				$coa_currency_cd = $list_sales_invoice[0]->coa_currency_cd;
				$decimal_after = $list_sales_invoice[0]->decimal_after;
				$note = $list_sales_invoice[0]->note;
				
				$rate = $list_sales_invoice[0]->rate;
				$rate_format = number_format($rate, $decimal_after);

				$sub_amount = $list_sales_invoice[0]->sub_amount;
				$sub_amount_format = number_format($sub_amount, $decimal_after);

				$discount_amount = $list_sales_invoice[0]->discount_amount;
				$discount_amount_format = number_format($discount_amount, $decimal_after);

				$ppn = $list_sales_invoice[0]->ppn;
				$ppn_format = number_format($ppn, $decimal_after);

				$pph = $list_sales_invoice[0]->pph;
				$pph_format = number_format($pph, $decimal_after);

				$total_amount = $list_sales_invoice[0]->total_amount;
				$total_amount_format = number_format($total_amount, $decimal_after);
				
				$cNIK_approval = $list_sales_invoice[0]->cNIK_approval;
				$cNmPegawai_approval = $list_sales_invoice[0]->cNmPegawai_approval;

				$result_employee = $this->m_essread->list_employee($company_id_session, '1', $cNIK_approval);
				$cNmJbtn = $result_employee[0]->cNmJbtn;

				$sequence = $list_sales_invoice[0]->sequence;

				//$terbilang = currency_to_words($total_amount);

				$result_company_country = $this->m_essread->list_company($company_id_session);
				$company_country = $result_company_country[0]->company_country;

				$data_header ['company_country'] = $company_country;

				$data_header ['account_name'] = $account_name;
				$data_header ['main_address'] = $main_address;
				$data_header ['city'] = $city;
				$data_header ['postal_code'] = $postal_code;
				$data_header ['phone_1'] = $phone_1;
				$data_header ['fax'] = $fax;
				$data_header ['attn'] = $attn;
				$data_header ['id_country'] = $id_country;
				$data_header ['country_name'] = $country_name;

				$data_header ['payment_terms_name'] = $payment_terms_name;
				$data_header ['payment_methode_name'] = $payment_methode_name;
				$data_header ['tax_number'] = $tax_number;

				$data_header ['sales_invoice_date'] = $sales_invoice_date;
				$data_header ['sales_invoice_number'] = $sales_invoice_number;
				$data_header ['coa_currency_cd'] = $coa_currency_cd;
				$data_header ['rate_format'] = $rate_format;
				$data_header ['list_sales_invoice'] = $list_sales_invoice;
				$data_header ['cNmPegawai_approval'] = $cNmPegawai_approval;
				$data_header ['customer_order_number'] = $customer_order_number;
				$data_header ['cNmJbtn'] = $cNmJbtn;
				$data_header ['note'] = $note;
				$data_header ['cNmPegawai_sales_invoice_owner'] = $cNmPegawai_sales_invoice_owner;

				$data_header ['sub_amount'] = $sub_amount_format;
				$data_header ['discount_amount'] = $discount_amount_format;
				$data_header ['ppn'] = $ppn_format;
				$data_header ['pph'] = $pph_format;
				$data_header ['total_amount'] = $total_amount_format;
				$data_header ['terbilang'] = currency_to_words($total_amount);

				$mpdf = new \Mpdf\Mpdf(
					[
						'mode' => 'utf-8', 
						'format' => 'A4',
						'setAutoTopMargin' => 'stretch',
						'autoMarginPadding' => 0.5
					]
				);

				$mpdf->SetTitle($sales_invoice_number);

				$mpdf->simpleTables = false;
				$mpdf->packTableData = true;
				$mpdf->keep_table_proportions = TRUE;
				$mpdf->shrink_tables_to_fit=1;

				$mpdf->AddPageByArray([
				    'margin-left' => 5.0,
				    'margin-right' => 5.0,
				    'margin-top' => 92,
				    'margin-bottom' => 80,
				]);

				$mpdf->showWatermarkText = true;
				
				$data_body_header = $this->load->view('report/pdf/distribution/header-sales-invoice', $data_header, TRUE);				
				$mpdf->SetHTMLHeader($data_body_header, '0', TRUE);

				/*if ($sequence<=2) {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/NOT-APPROVED.png', 0.1, 'P', 'D');
					$approve_by = '';
				}
				else {
					$mpdf->SetWatermarkImage($base_url.'assets/images/mmi/APPROVED.png', 0.2, 'P', 'D');
					$approve_by = 'Approved By';
				}

				$mpdf->showWatermarkImage = true;*/
				
				$data_header ['approve_by'] = $approve_by;

				$result_sales_invoice_line = $this->m_distributionread->list_sales_invoice_line_by_sales_invoice_number($company_id_session, $sales_invoice_number);
				
				$mpdf->WriteHTML('<table autosize="1" width="760px" style="overflow: wrap; font-size:12px;">');
					for ($a=0; $a<count($result_sales_invoice_line); $a++){
					//for ($a=0; $a<14; $a++){

						$JobNo_line = $result_sales_invoice_line[$a]->JobNo;
						$description_line = $result_sales_invoice_line[$a]->description;
						$sales_invoice_line_qty_line = $result_sales_invoice_line[$a]->qty_invoice_line;
						$uom_cd_line = $result_sales_invoice_line[$a]->uom_cd;
						$unit_price_line = $result_sales_invoice_line[$a]->unit_price;
						$amount_line = $result_sales_invoice_line[$a]->amount;
						$coa_cd_line = $result_sales_invoice_line[$a]->coa_cd;
						$decimal_after_line = $result_sales_invoice_line[$a]->decimal_after;

						$unit_price_line_format = number_format($unit_price_line, $decimal_after);
						$amount_line_format = number_format($amount_line, $decimal_after);

						if ($JobNo_line=='') {
							$JobNo_line_desc = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else {
							$JobNo_line_desc = $JobNo_line;
						}

						if ($a % 2 == 0){
							$rgb = '255, 255, 255';
						}
						else {
							$rgb = '245, 245, 245';
						}

						$mpdf->WriteHTML('<tr style="background-color:rgb('.$rgb.');">');
							$mpdf->WriteHTML('<td style="width:40px; height:30px; vertical-align:top;" align="center"><div style="display: block;">'.($a+1).'</div></td>');
							$mpdf->WriteHTML('<td style="width:300px; vertical-align:top; max-width:210px; padding-left:5px;"><div style="display: block;">'.$description_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:50px; vertical-align:top;" align="center"><div style="display: block;">'.$sales_invoice_line_qty_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:60px; vertical-align:top;" align="center"><div style="display: block;">'.$uom_cd_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:140px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$unit_price_line_format.'</div></td>');
							$mpdf->WriteHTML('<td style="width:170px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$amount_line_format.'</div></td>');
						$mpdf->WriteHTML('</tr>');
					}

				$mpdf->WriteHTML('</table>');

				$data_body_footer = $this->load->view('report/pdf/distribution/footer-sales-invoice', $data_header, TRUE);
				$mpdf->SetHTMLFooter($data_body_footer, '0', TRUE);


				$mpdf->Output();
			}			
		}
	}

	public function petty_cash($key_session, $transaction_number, $transaction_date){
		$cNIK_session=$this->session->userdata('cNIK_session');
		$company_id_session=$this->session->userdata('company_id_session');

		if (empty($cNIK_session)){
			$this->load->view('login');
		}
		else {
			$key_session=$this->session->userdata('key_session');
			$key_session_get = $this->uri->segment('4');
			$transaction_number_get = $this->uri->segment('5');
			$transaction_date_get = $this->uri->segment('6');
			$result_key_session = $this->m_essread->check_session($company_id_session, $cNIK_session);
			$key_session_db = $result_key_session[0]->session;

			if ($key_session_db != $key_session_get) {
				$this->load->view('login');
			}
			else {
				$mpdf = new \Mpdf\Mpdf(
					[
						'mode' => 'utf-8', 
						'format' => 'A5',
						'setAutoTopMargin' => 'stretch',
						'autoMarginPadding' => 0.5,
						'orientation' => 'L'
					]
				);

				$mpdf->SetTitle($sales_invoice_number);

				$mpdf->simpleTables = false;
				$mpdf->packTableData = true;
				$mpdf->keep_table_proportions = TRUE;
				$mpdf->shrink_tables_to_fit=1;

				$mpdf->AddPageByArray([
				    'margin-left' => 5.0,
				    'margin-right' => 5.0,
				    'margin-top' => 5.0,
				    'margin-bottom' => 5.0,
				]);

				$mpdf->showWatermarkText = true;
				
				$data_body_header = $this->load->view('report/pdf/distribution/header-sales-invoice', $data_header, TRUE);				
				$mpdf->SetHTMLHeader($data_body_header, '0', TRUE);
				
				/*$mpdf->WriteHTML('<table autosize="1" width="760px" style="overflow: wrap; font-size:12px;">');
					for ($a=0; $a<count($result_sales_invoice_line); $a++){
					//for ($a=0; $a<14; $a++){

						$JobNo_line = $result_sales_invoice_line[$a]->JobNo;
						$description_line = $result_sales_invoice_line[$a]->description;
						$sales_invoice_line_qty_line = $result_sales_invoice_line[$a]->qty_invoice_line;
						$uom_cd_line = $result_sales_invoice_line[$a]->uom_cd;
						$unit_price_line = $result_sales_invoice_line[$a]->unit_price;
						$amount_line = $result_sales_invoice_line[$a]->amount;
						$coa_cd_line = $result_sales_invoice_line[$a]->coa_cd;
						$decimal_after_line = $result_sales_invoice_line[$a]->decimal_after;

						$unit_price_line_format = number_format($unit_price_line, $decimal_after);
						$amount_line_format = number_format($amount_line, $decimal_after);

						if ($JobNo_line=='') {
							$JobNo_line_desc = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						}
						else {
							$JobNo_line_desc = $JobNo_line;
						}

						if ($a % 2 == 0){
							$rgb = '255, 255, 255';
						}
						else {
							$rgb = '245, 245, 245';
						}

						$mpdf->WriteHTML('<tr style="background-color:rgb('.$rgb.');">');
							$mpdf->WriteHTML('<td style="width:40px; height:30px; vertical-align:top;" align="center"><div style="display: block;">'.($a+1).'</div></td>');
							$mpdf->WriteHTML('<td style="width:300px; vertical-align:top; max-width:210px; padding-left:5px;"><div style="display: block;">'.$description_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:50px; vertical-align:top;" align="center"><div style="display: block;">'.$sales_invoice_line_qty_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:60px; vertical-align:top;" align="center"><div style="display: block;">'.$uom_cd_line.'</div></td>');
							$mpdf->WriteHTML('<td style="width:140px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$unit_price_line_format.'</div></td>');
							$mpdf->WriteHTML('<td style="width:170px; padding-right:5px; vertical-align:top;" align="right"><div style="display: block;">'.$amount_line_format.'</div></td>');
						$mpdf->WriteHTML('</tr>');
					}

				$mpdf->WriteHTML('</table>');*/

				$data_body_footer = $this->load->view('report/pdf/distribution/footer-sales-invoice', $data_header, TRUE);
				$mpdf->SetHTMLFooter($data_body_footer, '0', TRUE);


				$mpdf->Output();
			}
		}
	}

}