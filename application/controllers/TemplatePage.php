<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplatePage extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->library('session');
		$this->load->database();
        $this->load->helper('url');
        $this->load->model('m_templatepage');
	}

	public function index(){
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
			$data['photo_session'] = $photo_session;
			$data['key_session'] = $key_session;

			$data['menu'] = 'menu';
			$data['header'] = 'header';
			$data['page'] = 'home';
			$this->load->view('template', $data);
		}
	}

	public function act_login(){
		$this->form_validation->set_rules('cNIK', 'cNIK', 'required');
		$this->form_validation->set_rules('Pwd', 'Pwd', 'required');
 
		if ($this->form_validation->run() != false){
			$cNIK = strtoupper($this->input->post('cNIK'));
			$Pwd = $this->input->post('Pwd');

			$result = $this->m_templatepage->act_login($cNIK, $Pwd);
			if(count($result)>=1){ 
            	foreach ($result as $tampil);
            	function generateRandomString($length = 16) {
				    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				    $charactersLength = strlen($characters);
				    $randomString = '';
				    for ($i = 0; $i < $length; $i++) {
				        $randomString .= $characters[rand(0, $charactersLength - 1)];
				    }
				    return $randomString;
				}
				$key_session=generateRandomString();
				foreach ($this->m_templatepage->data_karyawan($cNIK) as $tampil2){
					$cNmPegawai=$tampil2->cNmPegawai;
					$cIDBag=$tampil2->cIDBag;
					$cNmBag=$tampil2->cNmBag;
					$cIDJbtn=$tampil2->cIDJbtn; 
					$cNmJbtn=$tampil2->cNmJbtn;
					$cIDDept=$tampil2->cIDDept;
					$cNmDept=$tampil2->cNmDept;
					$cGroupID = $tampil2->cGroupID;
      				$cGroupNm = $tampil2->cGroupNm;
					$company_id=$tampil2->company_id;
					if (empty($tampil2->photo)){
						$photo='upload.png';
					}
					else {
						$photo=$tampil2->photo;
					}
				}
				$data_session = array(
					'cNIK_session' => $cNIK,
					'cNmPegawai_session' => $cNmPegawai,
					'cIDBag_session' => $cIDBag,
					'cNmBag_session' => $cNmBag,
					'cIDJbtn_session' => $cIDJbtn,
					'cNmJbtn_session' => $cNmJbtn,
					'cIDDept_session' => $cIDDept,
					'cNmDept_session' => $cNmDept,
					'cGroupID_session' => $cGroupID,
      				'cGroupNm_session' => $cGroupNm,
					'company_id_session' => $company_id,
					'key_session' => $key_session,
					'photo_session' => $photo
				);
				$this->session->set_userdata($data_session);
				$this->m_templatepage->insert_session($cNIK, $company_id, $key_session);
				$status = 1;
				$responseValue = '';
			}
			else{
				$status = 0;
				$responseValue = 'Employee ID or Password is Wrong,<br>Please Try Again.';
			}
		}
		else {
			$status = 0;
			$responseValue = 'Form Validation is Invalid.';
		}
		echo json_encode(array(array('status' => $status, 'responseValue' => $responseValue)));
	}

	public function act_login_get($cNIK, $Pwd){

		$result = $this->m_templatepage->act_login_get($cNIK, $Pwd);
		if(count($result)>=1){ 
        	foreach ($result as $tampil);
        	function generateRandomString($length = 16) {
			    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			    $charactersLength = strlen($characters);
			    $randomString = '';
			    for ($i = 0; $i < $length; $i++) {
			        $randomString .= $characters[rand(0, $charactersLength - 1)];
			    }
			    return $randomString;
			}
			$key_session=generateRandomString();
			foreach ($this->m_templatepage->data_karyawan($cNIK) as $tampil2){
				$cNmPegawai=$tampil2->cNmPegawai;
				$cIDBag=$tampil2->cIDBag;
				$cNmBag=$tampil2->cNmBag;
				$cIDJbtn=$tampil2->cIDJbtn; 
				$cNmJbtn=$tampil2->cNmJbtn;
				$cIDDept=$tampil2->cIDDept;
				$cNmDept=$tampil2->cNmDept;
				$cGroupID = $tampil2->cGroupID;
  				$cGroupNm = $tampil2->cGroupNm;
				$company_id=$tampil2->company_id;
				if (empty($tampil2->photo)){
					$photo='upload.png';
				}
				else {
					$photo=$tampil2->photo;
				}
			}
			$data_session = array(
				'cNIK_session' => $cNIK,
				'cNmPegawai_session' => $cNmPegawai,
				'cIDBag_session' => $cIDBag,
				'cNmBag_session' => $cNmBag,
				'cIDJbtn_session' => $cIDJbtn,
				'cNmJbtn_session' => $cNmJbtn,
				'cIDDept_session' => $cIDDept,
				'cNmDept_session' => $cNmDept,
				'cGroupID_session' => $cGroupID,
  				'cGroupNm_session' => $cGroupNm,
				'company_id_session' => $company_id,
				'key_session' => $key_session,
				'photo_session' => $photo
			);
			$this->session->set_userdata($data_session);
			$this->m_templatepage->insert_session($cNIK, $company_id, $key_session);
			/*$status = 1;
			$responseValue = '';*/
			header('location:'.base_url().'inventory/dashboard');
		}
		else{
			/*$status = 0;
			$responseValue = 'Employee ID or Password is Wrong,<br>Please Try Again.';*/
			header('location:https://fusion.meiwa-m.co.id/');
		}

		//echo json_encode(array(array('status' => $status, 'responseValue' => $responseValue)));
	}

	public function act_logout(){
		$this->session->sess_destroy();
		header ('location:'.base_url());
	}

	public function error_page(){
		$this->load->view('errors/error-404');
	}

	public function calendar(){
		$this->load->view('ess/calendar');
	}

}
