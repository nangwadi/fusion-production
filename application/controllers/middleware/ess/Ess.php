<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Ess extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('middleware/ess/m_ess');
        $this->load->model('m_essupdate');
        $this->load->model('m_essread');
        //$this->load->model('m_esspage');
	}

	public function index(){
		$this->load->view('login');
	}

	// ESS
	// Attendance

	public function list_absensi($dTglHdr){

		$dTglHdr_get = $this->uri->segment('4');

		if ($dTglHdr_get=='0') {
			$dTglHdr_model = date('Y-m-d');
		}
		else {
			$dTglHdr_model = $dTglHdr_get;
		}

		$result = $this->m_ess->list_absensi($dTglHdr_model);
		$data_array = array();
		if (count($result)==0) {
			$status = 0;
		}
		else {
			foreach ($result as $resultList) {
				$cNIK = $resultList->cNIK;
				$dTglHdr = date_format(date_create($dTglHdr), 'Y-m-d');
				$dJamMsk = $resultList->dJamMsk;
				$dJamPlg = $resultList->dJamPlg;
				$cShiftID_plan = $resultList->cShiftID_plan;
				$cShiftID_act = $resultList->cShiftID_act;
				$dt = $resultList->dt;
				$pc = $resultList->pc;
				$ot_awal_start = $resultList->ot_awal_start;
				$ot_awal_end = $resultList->ot_awal_end;
				$ot_awal = $resultList->ot_awal;
				$ot_akhir_start = $resultList->ot_akhir_start;
				$ot_akhir_end = $resultList->ot_akhir_end;
				$ot_akhir = $resultList->ot_akhir;
				$ot_libur_start = $resultList->ot_libur_start;
				$ot_libur_end = $resultList->ot_libur_end;
				$ot_libur = $resultList->ot_libur;
				$ot_1 = $resultList->ot_1;
				$ot_2 = $resultList->ot_2;
				$ot_3 = $resultList->ot_3;
				$ot_4 = $resultList->ot_4;
				$ot_real = $resultList->ot_real;
				$ot_konv = $resultList->ot_konv;
				$cIDAbsen = $resultList->cIDAbsen;
				$keterangan = $resultList->keterangan;
				$type_absen = $resultList->type_absen;
				$basik = $resultList->basik;
				$imp = $resultList->imp;
				$ipu = $resultList->ipu;

				$last_update = date('Y-m-d H:i');

				$data = array(
					//'cNIK' => $cNIK,
					'dJamMsk' => date_format(date_create($dJamMsk), 'H:i'),
					'dJamPlg' => date_format(date_create($dJamPlg), 'H:i'),
					'cShiftID_act' => $cShiftID_act,
					'dt' => $dt,
					'pc' => $pc,
					'ot_awal_start' => date_format(date_create($ot_awal_start), 'H:i'),
					'ot_awal_end' => date_format(date_create($ot_awal_end), 'H:i'),
					'ot_awal' => $ot_awal,
					'ot_akhir_start' => date_format(date_create($ot_akhir_start), 'H:i'),
					'ot_akhir_end' => date_format(date_create($ot_akhir_end), 'H:i'),
					'ot_akhir' => $ot_akhir,
					'ot_libur_start' => date_format(date_create($ot_libur_start), 'H:i'),
					'ot_libur_end' => date_format(date_create($ot_libur_end), 'H:i'),
					'ot_libur' => $ot_libur,
					'ot_1' => $ot_1,
					'ot_2' => $ot_2,
					'ot_3' => $ot_3,
					'ot_4' => $ot_4,
					'ot_real' => $ot_real,
					'ot_konv' => $ot_konv,
					'cIDAbsen' => $cIDAbsen,
					'keterangan' => $keterangan,
					'type_absen' => $type_absen,
					'basik' => $basik,
					'imp' => $imp,
					'ipu' => $ipu,
					'last_by' => '16L10294',
					'last_update' => $last_update
				);
				//array_push($data_array, $data);

				$result = $this->m_ess->update_absensi($data, $cNIK, $dTglHdr_model);
				if ($result==true) {
					$status = 1;
				}
				else {
					$status = 0;
				}
				array_push($data_array, $status);
			}
		}	
		//echo json_encode(array(array('status' => $data_array)));			
		echo json_encode(array(array('status' => array_unique($data_array), 'dTglHdr_get' => $dTglHdr_model)));
		//echo "<html lang='en'><script>window.close();</script></html>";		
	}

	// Overtime

	public function list_lembur($dTglHdr){

		$dTglHdr_get = $this->uri->segment('4');

		if ($dTglHdr_get=='0') {
			$dTglHdr_model = date('Y-m-d');
		}
		else {
			$dTglHdr_model = $dTglHdr_get;
		}

		$result = $this->m_ess->list_lembur($dTglHdr_model);
		$data_array = array();
		if (count($result)==0) {
			$status = 0;
		}
		else {
			$status = 1;
			$last_update = date('Y-m-d H:i');
			foreach ($result as $resultList) {
				$dept = $resultList->dept;
				$result_dept = $this->m_ess->list_department(1, strtoupper($dept));
				$cIDDept = $result_dept[0]->cIDDept;

				$plant_start = date_format(date_create($resultList->plant_start), 'H:i');
				$sore = '17:00';
				if ($plant_start <= $sore) {
					$cShiftID = 'OTP';	
				}
				else {
					$cShiftID = 'OTM';
				}

				$cNIK = $resultList->nik;
				$dTglHdr = $resultList->tgl;

				$result_lembur = $this->m_ess->list_lembur_db(1, $cNIK, $dTglHdr);

				if (count($result_lembur)==0) {
					$data=array(
						'company_id' => 1,
						'cNIK' => $resultList->nik,
						'cIDDept' => $cIDDept,
						'cShiftID' => $cShiftID,
						'dTglHdr' => $resultList->tgl,
						'job' => $resultList->job,
						'kategori' => $resultList->kategori,
						'plan_start' => $resultList->plant_start,
						'plan_end' => $resultList->plant_end,
						'catering' => $resultList->catering,
						'approve' => $resultList->approve,
						'create_by' => '16L10294',
						'create_date' => $last_update,
						'last_by' => '16L10294',
						'last_update' => $last_update
					);
					$result_add = $this->m_ess->add_lembur($data);
					if ($result_add==true) {
						$status = 1;
					}
					else {
						$status = 0;
					}
					array_push($data_array, $status);
				}
				else {
					$data=array(
						'cIDDept' => $cIDDept,
						'cShiftID' => $cShiftID,
						'job' => $resultList->job,
						'kategori' => $resultList->kategori,
						'plan_start' => $resultList->plant_start,
						'plan_end' => $resultList->plant_end,
						'catering' => $resultList->catering,
						'approve' => $resultList->approve,
						'last_by' => '16L10294',
						'last_update' => $last_update
					);
					$result_update = $this->m_ess->update_lembur($data, $cNIK, $dTglHdr);
					if ($result_update==true) {
						$status = 1;
					}
					else {
						$status = 0;
					}
					array_push($data_array, $status);
				}
				//array_push($data_array, $data);
			}
		}
		echo json_encode(array(array('status' => array_unique($data_array), 'dTglHdr' => $dTglHdr_get)));
		//echo json_encode(array(array('status' => $data_array, 'dTglHdr' => $dTglHdr_get)));
	}

	// Transaksi Manual

	public function list_transaksi_manual($cIdPeriod){

		$cIdPeriod_get = $this->uri->segment('4');
		if ($cIdPeriod_post=='' || $cIdPeriod_post==null || $cIdPeriod_post=='null') {
			$result_periode = $this->m_essread->last_attendance_periode(1);
			$cIdPeriod = $result_periode[0]->cIdPeriod;
			$dTglPeriod_Start = $result_periode[0]->dTglPeriod_Start;
			$dTglPeriod_End = $result_periode[0]->dTglPeriod_End;
		}
		else {
			$result_periode = $this->m_essread->list_attendance_periode(1, $cIdPeriod_post);
			$cIdPeriod = $result_periode[0]->cIdPeriod;
			$dTglPeriod_Start = $result_periode[0]->dTglPeriod_Start;
			$dTglPeriod_End = $result_periode[0]->dTglPeriod_End;
		}

		$result = $this->m_ess->list_transaksi_manual($cIdPeriod);
		$data_array = array();
		if (count($result)==0) {
			$status = 0;
		}
		else {
			$status = 1;
			$last_update = date('Y-m-d H:i');
			foreach ($result as $resultList) {
				$cNIK = $resultList->cNIK;
				$cIDKomponen = $resultList->cIDKomponen;
				$result_komponen = $this->m_essread->list_salary_component(1, $cIDKomponen);
				$kategori = $result_komponen[0]->kategori;
				if ($kategori=='P') {
					$kali = 1;
				}
				else if ($kategori=='M') {
					$kali = -1;
				}

				$result_transaksi = $this->m_ess->list_transaksi_manual_db(1, $cNIK, $cIDKomponen, $cIdPeriod);

				if (count($result_transaksi)==0) {
					$data=array(
						'company_id' => 1,
						'cNIK' => $resultList->cNIK,
						'cIDKomponen' => $resultList->cIDKomponen,
						'nNilai' => ($resultList->nNilai)*$kali,
						'cNote' => $resultList->cNote,
						'dTglTrans' => $resultList->dTglTrans,
						'cIdPeriod' => $cIdPeriod,
						'create_by' => '16L10294',
						'create_date' => $last_update,
						'last_by' => '16L10294',
						'last_update' => $last_update
					);	
					$result_add = $this->m_ess->add_transaksi_manual($data);
					if ($result_add==true) {
						$status = 1;
					}
					else {
						$status = 0;
					}
				}
				else {
					$data=array(
						'nNilai' => ($resultList->nNilai)*$kali,
						'cNote' => $resultList->cNote,
						'dTglTrans' => $resultList->dTglTrans,
						'last_by' => '16L10294',
						'last_update' => $last_update
					);
					$result_update = $this->m_ess->update_transaksi_manual($data, $cNIK, $cIDKomponen, $cIdPeriod);
					if ($result_update==true) {
						$status = 1;
					}
					else {
						$status = 0;
					}
				}
				//array_push($data_array, $data);
				array_push($data_array, $status);
			}
		}
		echo json_encode (array(array('status' => array_unique($data_array), 'cIdPeriod' => $cIdPeriod)));
	}

}