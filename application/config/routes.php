<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'TemplatePage';
$route['404_override'] = 'TemplatePage/error_page';
$route['translate_uri_dashes'] = FALSE;

// Aksi Login
$route['act-login'] = 'templatepage/act_login';
$route['act-login-get/(:any)/(:any)'] = 'templatepage/act_login_get/$1/$2';
$route['act-logout'] = 'templatepage/act_logout';

// ESS ======================================================================================================================================

	// Page =====================================================================================================================================

		// ESS Dashboard
		$route['ess/dashboard'] = 'EssPage/dashboard';

		// Organization
		$route['ess/company'] = 'EssPage/company';
		$route['ess/plant'] = 'EssPage/plant';
		$route['ess/department'] = 'EssPage/department';
		$route['ess/division'] = 'EssPage/division';
		$route['ess/potition'] = 'EssPage/potition';
		$route['ess/limit-medical'] = 'EssPage/limit_medical';
		$route['ess/employee-status'] = 'EssPage/employee_status';
		$route['ess/family-status'] = 'EssPage/family_status';
		$route['ess/family-relation'] = 'EssPage/family_relation';
		$route['ess/education'] = 'EssPage/education';
		$route['ess/religion'] = 'EssPage/religion';
		$route['ess/bank'] = 'EssPage/bank';
		$route['ess/salary-component'] = 'EssPage/salary_component';
		$route['ess/salary-component-group'] = 'EssPage/salary_component_group';
		$route['ess/data-photo'] = 'EssPage/data_photo';
		$route['ess/blood-group'] = 'EssPage/blood_group';
		$route['ess/reasons-for-resigning'] = 'EssPage/reasons_for_resigning';

		// Attendance
		$route['ess/sift-group'] = 'EssPage/sift_group';
		$route['ess/sift'] = 'EssPage/sift';
		$route['ess/precense-type'] = 'EssPage/precense_type';
		$route['ess/national-holiday'] = 'EssPage/national_holiday';
		$route['ess/mandatory-overtime'] = 'EssPage/mandatory_overtime';
		$route['ess/change-day'] = 'EssPage/change_day';
		$route['ess/ramadhan'] = 'EssPage/ramadhan';
		$route['ess/attendance-periode'] = 'EssPage/attendance_periode';
		$route['ess/create-calendar/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'EssPage/create_calendar/$1/$2/$3/$4/$5/$6';
		$route['ess/work-calendar/(:any)/(:any)'] = 'EssPage/work_calendar/$1/$2';

		// Attendance Record
		$route['ess/face'] = 'EssPage/face';
		$route['ess/finger'] = 'EssPage/finger';
		$route['ess/change-sift'] = 'EssPage/change_sift';
		$route['ess/daily-attendance'] = 'EssPage/daily_attendance';

		// Attendance Check
		$route['ess/attendance-check/(:any)'] = 'EssPage/attendance_check/$1';

		// Employee
		$route['ess/employee/(:any)'] = 'EssPage/employee/$1';


		// Payroll Setting
		$route['ess/bpjs'] = 'EssPage/bpjs';
		$route['ess/national-tax'] = 'EssPage/national_tax';
		$route['ess/salary-deduction'] = 'EssPage/salary_deduction';
		$route['ess/sift-allowance'] = 'EssPage/sift_allowance';

		// Payroll
		$route['ess/manual-transaction'] = 'EssPage/manual_transaction';
		$route['ess/medical-limit'] = 'EssPage/medical_limit';

	// Read =====================================================================================================================================
		// Organization
		$route['ess/list-company/(:any)/(:any)'] = 'EssRead/list_company/$1/$2';
		$route['ess/list-plant/(:any)/(:any)'] = 'EssRead/list_plant/$1/$2';
		$route['ess/list-department/(:any)/(:any)'] = 'EssRead/list_department/$1/$2';
		$route['ess/list-division/(:any)/(:any)'] = 'EssRead/list_division/$1/$2';
		$route['ess/list-potition/(:any)/(:any)'] = 'EssRead/list_potition/$1/$2';
		$route['ess/list-employee-status/(:any)/(:any)'] = 'EssRead/list_employee_status/$1/$2';
		$route['ess/list-family-status/(:any)/(:any)'] = 'EssRead/list_family_status/$1/$2';
		$route['ess/list-family-relation/(:any)/(:any)'] = 'EssRead/list_family_relation/$1/$2';
		$route['ess/list-education/(:any)/(:any)'] = 'EssRead/list_education/$1/$2';
		$route['ess/list-religion/(:any)/(:any)'] = 'EssRead/list_religion/$1/$2';
		$route['ess/list-bank/(:any)/(:any)'] = 'EssRead/list_bank/$1/$2';
		$route['ess/list-salary-component/(:any)/(:any)'] = 'EssRead/list_salary_component/$1/$2';
		$route['ess/list-salary-component-group/(:any)/(:any)'] = 'EssRead/list_salary_component_group/$1/$2';
		$route['ess/list-data-photo/(:any)/(:any)'] = 'EssRead/list_data_photo/$1/$2';
		$route['ess/list-blood-group/(:any)/(:any)'] = 'EssRead/list_blood_group/$1/$2';
		$route['ess/list-reasons-for-resigning/(:any)/(:any)'] = 'EssRead/list_reasons_for_resigning/$1/$2';

		// Attendance
		$route['ess/list-sift-group/(:any)/(:any)'] = 'EssRead/list_sift_group/$1/$2';
		$route['ess/list-master-calendar/(:any)/(:any)/(:any)'] = 'EssRead/list_master_calendar/$1/$2/$3';
		$route['ess/list-sift/(:any)/(:any)'] = 'EssRead/list_sift/$1/$2';
		$route['ess/list-sift-time/(:any)/(:any)'] = 'EssRead/list_sift_time/$1/$2';
		$route['ess/list-precense-type/(:any)/(:any)'] = 'EssRead/list_precense_type/$1/$2';
		$route['ess/list-national-holiday/(:any)/(:any)'] = 'EssRead/list_national_holiday/$1/$2';
		$route['ess/list-mandatory-overtime/(:any)/(:any)'] = 'EssRead/list_mandatory_overtime/$1/$2';
		$route['ess/list-change-day/(:any)/(:any)'] = 'EssRead/list_change_day/$1/$2';
		$route['ess/list-ramadhan/(:any)/(:any)'] = 'EssRead/list_ramadhan/$1/$2';
		$route['ess/list-attendance-periode/(:any)/(:any)'] = 'EssRead/list_attendance_periode/$1/$2';

		// Attendance Check
		$route['ess/list-attendance-check/(:any)/(:any)/(:any)'] = 'EssRead/list_attendance_check/$1/$2/$3';

		// Attendance Record
		$route['ess/list-face/(:any)/(:any)/(:any)'] = 'EssRead/list_face/$1/$2/$3';
		$route['ess/list-finger/(:any)/(:any)/(:any)'] = 'EssRead/list_finger/$1/$2/$3';
		$route['ess/list-change-sift/(:any)/(:any)'] = 'EssRead/list_change_sift/$1/$2';
		$route['ess/list-daily-attendance/(:any)'] = 'EssRead/list_daily_attendance/$1';

		// Employee
		$route['ess/list-employee/(:any)/(:any)/(:any)'] = 'EssRead/list_employee/$1/$2/$3';
		$route['ess/list-medical-limit/(:any)/(:any)/(:any)'] = 'EssRead/list_medical_limit/$1/$2/$3';

		// Employee Detail
		$route['ess/personal-data/(:any)/(:any)/(:any)'] = 'EssRead/personal_data/$1/$2/$3';
		$route['ess/education/(:any)/(:any)/(:any)'] = 'EssRead/education/$1/$2/$3';
		$route['ess/account/(:any)/(:any)/(:any)'] = 'EssRead/account/$1/$2/$3';
		$route['ess/potition/(:any)/(:any)/(:any)'] = 'EssRead/potition/$1/$2/$3';
		$route['ess/list-division-by-department/(:any)/(:any)'] = 'EssRead/list_division_by_department/$1/$2';
		$route['ess/join-date/(:any)/(:any)/(:any)'] = 'EssRead/join_date/$1/$2/$3';
		$route['ess/plant/(:any)/(:any)/(:any)'] = 'EssRead/plant/$1/$2/$3';
		$route['ess/id-card/(:any)/(:any)/(:any)'] = 'EssRead/id_card/$1/$2/$3';
		$route['ess/tax-card/(:any)/(:any)/(:any)'] = 'EssRead/tax_card/$1/$2/$3';
		$route['ess/bpjs/(:any)/(:any)/(:any)'] = 'EssRead/bpjs/$1/$2/$3';
		$route['ess/family/(:any)/(:any)/(:any)'] = 'EssRead/family/$1/$2/$3';
		$route['ess/tax/(:any)/(:any)/(:any)'] = 'EssRead/tax/$1/$2/$3';
		$route['ess/insurance/(:any)/(:any)/(:any)'] = 'EssRead/insurance/$1/$2/$3';
		$route['ess/bank-account/(:any)/(:any)/(:any)'] = 'EssRead/bank_account/$1/$2/$3';
		$route['ess/component-salary/(:any)/(:any)/(:any)'] = 'EssRead/component_salary/$1/$2/$3';
		$route['ess/covid19/(:any)/(:any)/(:any)'] = 'EssRead/covid19/$1/$2/$3';
		$route['ess/calendar/(:any)/(:any)/(:any)'] = 'EssRead/calendar/$1/$2/$3';

		// Payroll Setting
		$route['ess/list-manual-transaction/(:any)/(:any)'] = 'EssRead/list_manual_transaction/$1/$2';
		$route['ess/list-manual-transaction-by-id/(:any)/(:any)'] = 'EssRead/list_manual_transaction_by_id/$1/$2';
		$route['ess/list-history-medical/(:any)/(:any)/(:any)'] = 'EssRead/list_history_medical/$1/$2/$3';
		$route['ess/list-bpjs/(:any)/(:any)'] = 'EssRead/list_bpjs/$1/$2';
		$route['ess/list-pkp-ptkp/(:any)'] = 'EssRead/list_pkp_ptkp/$1';
		$route['ess/list-pkp-ptkp-formula/(:any)/(:any)/(:any)'] = 'EssRead/list_pkp_ptkp_formula/$1/$2/$3';
		$route['ess/list-salary-deduction/(:any)'] = 'EssRead/list_salary_deduction/$1';

	// Create =====================================================================================================================================
		// Organization
		$route['ess/add-company/(:any)'] = 'EssCreate/add_company/$1';
		$route['ess/add-plant/(:any)'] = 'EssCreate/add_plant/$1';
		$route['ess/add-department/(:any)'] = 'EssCreate/add_department/$1';
		$route['ess/add-division/(:any)'] = 'EssCreate/add_division/$1';
		$route['ess/add-potition/(:any)'] = 'EssCreate/add_potition/$1';
		$route['ess/add-limit-medical/(:any)'] = 'EssCreate/add_limit_medical/$1';
		$route['ess/add-medical-limit/(:any)'] = 'EssCreate/add_limit_medical/$1';
		$route['ess/add-employee-status/(:any)'] = 'EssCreate/add_employee_status/$1';
		$route['ess/add-family-status/(:any)'] = 'EssCreate/add_family_status/$1';
		$route['ess/add-family-relation/(:any)'] = 'EssCreate/add_family_relation/$1';
		$route['ess/add-education/(:any)'] = 'EssCreate/add_education/$1';
		$route['ess/add-religion/(:any)'] = 'EssCreate/add_religion/$1';
		$route['ess/add-bank/(:any)'] = 'EssCreate/add_bank/$1';
		$route['ess/add-salary-component/(:any)'] = 'EssCreate/add_salary_component/$1';
		$route['ess/add-salary-component-group/(:any)'] = 'EssCreate/add_salary_component_group/$1';
		$route['ess/add-data-photo/(:any)'] = 'EssCreate/add_data_photo/$1';
		$route['ess/add-blood-group/(:any)'] = 'EssCreate/add_blood_group/$1';
		$route['ess/add-reasons-for-resigning/(:any)'] = 'EssCreate/add_reasons_for_resigning/$1';

		//Attendande
		$route['ess/add-sift-group/(:any)'] = 'EssCreate/add_sift_group/$1';
		$route['ess/add-sift/(:any)'] = 'EssCreate/add_sift/$1';
		$route['ess/add-sift-time/(:any)/(:any)'] = 'EssCreate/add_sift_time/$1/$2';
		$route['ess/add-precense-type/(:any)'] = 'EssCreate/add_precense_type/$1';
		$route['ess/add-national-holiday/(:any)'] = 'EssCreate/add_national_holiday/$1';
		$route['ess/add-mandatory-overtime/(:any)'] = 'EssCreate/add_mandatory_overtime/$1';
		$route['ess/add-change-day/(:any)'] = 'EssCreate/add_change_day/$1';
		$route['ess/add-ramadhan/(:any)'] = 'EssCreate/add_ramadhan/$1';
		$route['ess/add-attendance-periode/(:any)'] = 'EssCreate/add_attendance_periode/$1';

		// Attendance Record
		$route['ess/add-change-sift/(:any)'] = 'EssCreate/add_change_sift/$1';

		// Employee
		$route['ess/add-employee/(:any)/(:any)'] = 'EssCreate/add_employee/$1/$2';
		$route['ess/add-medical-limit/(:any)'] = 'EssCreate/add_medical_limit/$1';

		// Detail
		$route['ess/add-personal-data/(:any)'] = 'EssCreate/add_personal_data/$1';
		$route['ess/add-personal-education/(:any)'] = 'EssCreate/add_personal_education/$1';
		$route['ess/add-personal-account/(:any)'] = 'EssCreate/add_personal_account/$1';
		$route['ess/add-personal-potition/(:any)'] = 'EssCreate/add_personal_potition/$1';
		$route['ess/add-personal-join-date/(:any)'] = 'EssCreate/add_personal_join_date/$1';
		$route['ess/add-personal-plant/(:any)'] = 'EssCreate/add_personal_plant/$1';
		$route['ess/add-personal-id-card/(:any)'] = 'EssCreate/add_personal_id_card/$1';
		$route['ess/add-personal-tax-card/(:any)'] = 'EssCreate/add_personal_tax_card/$1';
		$route['ess/add-personal-bpjs/(:any)'] = 'EssCreate/add_personal_bpjs/$1';
		$route['ess/add-personal-naker/(:any)'] = 'EssCreate/add_personal_naker/$1';
		$route['ess/add-personal-family/(:any)'] = 'EssCreate/add_personal_family/$1';
		$route['ess/add-personal-tax/(:any)'] = 'EssCreate/add_personal_tax/$1';
		$route['ess/add-personal-insurance/(:any)'] = 'EssCreate/add_personal_insurance/$1';
		$route['ess/add-personal-bank-account/(:any)'] = 'EssCreate/add_personal_bank_account/$1';
		$route['ess/add-personal-salary/(:any)'] = 'EssCreate/add_personal_salary/$1';

		// upload data photo
		$route['ess/upload-data-photo/(:any)/(:any)'] = 'EssCreate/upload_data_photo/$1/$2';

		// Resign
		$route['ess/add-resign/(:any)'] = 'EssCreate/add_resign/$1';

		// Payroll
		$route['ess/add-manual-transaction/(:any)'] = 'EssCreate/add_manual_transaction/$1';
		$route['ess/add-history-medical/(:any)'] = 'EssCreate/add_history_medical/$1';
		$route['ess/add-bpjs/(:any)'] = 'EssCreate/add_bpjs/$1';
		$route['ess/add-pkp-ptkp/(:any)'] = 'EssCreate/add_pkp_ptkp/$1';
		$route['ess/add-pkp-ptkp-formula/(:any)/(:any)'] = 'EssCreate/add_pkp_ptkp_formula/$1/$2';
		$route['ess/add-salary-deduction/(:any)'] = 'EssCreate/add_salary_deduction/$1';

	// Update =====================================================================================================================================
		// Organization
		$route['ess/update-company/(:any)'] = 'EssUpdate/update_company/$1';
		$route['ess/update-plant/(:any)'] = 'EssUpdate/update_plant/$1';
		$route['ess/update-department/(:any)'] = 'EssUpdate/update_department/$1';
		$route['ess/update-division/(:any)'] = 'EssUpdate/update_division/$1';
		$route['ess/update-potition/(:any)'] = 'EssUpdate/update_potition/$1';
		$route['ess/update-employee-status/(:any)'] = 'EssUpdate/update_employee_status/$1';
		$route['ess/update-family-status/(:any)'] = 'EssUpdate/update_family_status/$1';
		$route['ess/update-family-relation/(:any)'] = 'EssUpdate/update_family_relation/$1';
		$route['ess/update-education/(:any)'] = 'EssUpdate/update_education/$1';
		$route['ess/update-religion/(:any)'] = 'EssUpdate/update_religion/$1';
		$route['ess/update-bank/(:any)'] = 'EssUpdate/update_bank/$1';
		$route['ess/update-salary-component/(:any)'] = 'EssUpdate/update_salary_component/$1';
		$route['ess/update-salary-component-group/(:any)'] = 'EssUpdate/update_salary_component_group/$1';
		$route['ess/update-data-photo/(:any)'] = 'EssUpdate/update_data_photo/$1';
		$route['ess/update-blood-group/(:any)'] = 'EssUpdate/update_blood_group/$1';
		$route['ess/update-reasons-for-resigning/(:any)'] = 'EssUpdate/update_reasons_for_resigning/$1';

		// Attendance
		$route['ess/update-sift-group/(:any)'] = 'EssUpdate/update_sift_group/$1';
		$route['ess/update-master-calendar/(:any)'] = 'EssUpdate/update_master_calendar/$1';
		$route['ess/update-master-calendar-sift/(:any)'] = 'EssUpdate/update_master_calendar_sift/$1';
		$route['ess/update-sift/(:any)'] = 'EssUpdate/update_sift/$1';
		$route['ess/update-sift-time/(:any)'] = 'EssUpdate/update_sift_time/$1';
		$route['ess/update-precense-type/(:any)'] = 'EssUpdate/update_precense_type/$1';
		$route['ess/update-national-holiday/(:any)'] = 'EssUpdate/update_national_holiday/$1';
		$route['ess/update-mandatory-overtime/(:any)'] = 'EssUpdate/update_mandatory_overtime/$1';
		$route['ess/update-change-day/(:any)'] = 'EssUpdate/update_change_day/$1';
		$route['ess/update-ramadhan/(:any)'] = 'EssUpdate/update_ramadhan/$1';
		$route['ess/update-attendance-periode/(:any)'] = 'EssUpdate/update_attendance_periode/$1';

		// Attendance Record
		$route['ess/update-change-sift/(:any)'] = 'EssUpdate/update_change_sift/$1';
		$route['ess/update-daily-attendance/(:any)'] = 'EssUpdate/update_daily_attendance/$1';

		// Employee
		$route['ess/update-employee/(:any)'] = 'EssUpdate/update_employee/$1';
		$route['ess/update-personal-salary/(:any)'] = 'EssUpdate/update_personal_salary/$1';
		$route['ess/update-personal-bank-account/(:any)'] = 'EssUpdate/update_personal_bank_account/$1';
		$route['ess/update-medical-limit/(:any)'] = 'EssUpdate/update_medical_limit/$1';

		// Delete Family
		$route['ess/delete-personal-family/(:any)'] = 'EssUpdate/delete_personal_family/$1';

		// Update Resign
		$route['ess/update-resign/(:any)'] = 'EssUpdate/update_resign/$1';

		// Payroll
		$route['ess/update-history-medical/(:any)'] = 'EssUpdate/update_history_medical/$1';
		$route['ess/update-bpjs/(:any)'] = 'EssUpdate/update_bpjs/$1';
		$route['ess/update-pkp-ptkp/(:any)'] = 'EssUpdate/update_pkp_ptkp/$1';
		$route['ess/update-pkp-ptkp-formula-company/(:any)'] = 'EssUpdate/update_pkp_ptkp_formula_company/$1';
		$route['ess/update-pkp-ptkp-formula-personal/(:any)'] = 'EssUpdate/update_pkp_ptkp_formula_personal/$1';
		$route['ess/update-salary-deduction/(:any)'] = 'EssUpdate/update_salary_deduction/$1';

	// Delete =====================================================================================================================================

		// Delete Resign
		$route['ess/delete-resign/(:any)'] = 'EssUpdate/delete_resign/$1';

		// Payroll
		$route['ess/delete-manual-transaction/(:any)'] = 'EssUpdate/delete_manual_transaction/$1';

// Overtime ======================================================================================================================================

	// Page =====================================================================================================================================
		// Dashboard
		$route['overtime/dashboard'] = 'OvertimePage/dashboard';

		// Setting
		$route['overtime/time-deadline'] = 'OvertimePage/time_deadline';
		$route['overtime/maker'] = 'OvertimePage/maker';
		$route['overtime/approval'] = 'OvertimePage/approval';
		$route['overtime/special-approval'] = 'OvertimePage/special_approval';

		// Input
		$route['overtime/daily-overtime'] = 'OvertimePage/daily_overtime';
		$route['overtime/holiday-overtime'] = 'OvertimePage/holiday_overtime';
		$route['overtime/print-holiday-overtime/(:any)/(:any)/(:any)'] = 'OvertimePage/print_holiday_overtime/$1/$2/$3';

	// Read =====================================================================================================================================
		// Setting
		$route['overtime/list-time-deadline/(:any)'] = 'OvertimeRead/list_time_deadline/$1';
		$route['overtime/list-maker-approval/(:any)/(:any)/(:any)'] = 'OvertimeRead/list_maker_approval/$1/$2/$3';
		$route['overtime/list-employee-by-dept-div/(:any)/(:any)/(:any)/(:any)'] = 'OvertimeRead/list_employee_by_dept_div/$1/$2/$3/$4';

		//Input
		$route['overtime/list-daily-overtime/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'OvertimeRead/list_daily_overtime/$1/$2/$3/$4/$5/$6';
		$route['overtime/list-holiday-overtime/(:any)/(:any)/(:any)/(:any)'] = 'OvertimeRead/list_holiday_overtime/$1/$2/$3/$4';
		$route['overtime/list-approve-overtime/(:any)/(:any)/(:any)/(:any)'] = 'OvertimeRead/list_approve_overtime/$1/$2/$3/$4';

		$route['overtime/list-catering-overtime/(:any)/(:any)'] = 'OvertimeRead/list_catering_overtime/$1/$2';
		$route['overtime/list-company-plant/(:any)/(:any)'] = 'OvertimeRead/list_company_plant/$1/$2';

	// Create =====================================================================================================================================
		// Setting
		$route['overtime/add-maker-approval/(:any)'] = 'OvertimeCreate/add_maker_approval/$1';
		$route['overtime/add-daily-overtime/(:any)'] = 'OvertimeCreate/add_daily_overtime/$1';
		$route['overtime/add-holiday-overtime/(:any)'] = 'OvertimeCreate/add_holiday_overtime/$1';
		$route['overtime/add-catering-overtime/(:any)'] = 'OvertimeCreate/add_catering_overtime/$1';

	// Update =====================================================================================================================================
		// Setting
		$route['overtime/update-time-deadline/(:any)'] = 'OvertimeUpdate/update_time_deadline/$1';
		$route['overtime/update-maker-approval/(:any)'] = 'OvertimeUpdate/update_maker_approval/$1';
		$route['overtime/update-catering-daily-overtime/(:any)'] = 'OvertimeUpdate/update_catering_daily_overtime/$1';
		$route['overtime/update-approve-overtime/(:any)'] = 'OvertimeUpdate/update_approve_overtime/$1';

	// Delete =====================================================================================================================================
		// Setting
		$route['overtime/delete-maker-approval/(:any)'] = 'OvertimeDelete/delete_maker_approval/$1';
		$route['overtime/delete-daily-overtime/(:any)'] = 'OvertimeDelete/delete_daily_overtime/$1';

// AA Aldo
	// Page =====================================================================================================================================
		// Dashboard
		$route['aldo/dashboard'] = 'AldoPage/dashboard';

		// Setting
		$route['aldo/annual-leave'] = 'AldoPage/annual_leave';
			$route['aldo/department-approval'] = 'AldoPage/department_approval';
			$route['aldo/ga-approval'] = 'AldoPage/ga_approval';
			$route['aldo/special-approval'] = 'AldoPage/special_approval';
			$route['aldo/approve-all'] = 'AldoPage/approve_all';
		$route['aldo/day-off'] = 'AldoPage/day_off';

		// Input
		$route['aldo/non-special-leave/(:any)'] = 'AldoPage/non_special_leave/$1';
		$route['aldo/special-leave/(:any)'] = 'AldoPage/special_leave/$1';

		// Approval
		$route['aldo/special-approve'] = 'AldoPage/special_approve';
		$route['aldo/approval/(:any)'] = 'AldoPage/approval/$1';

	// Read =====================================================================================================================================
		// Setting
		$route['aldo/list-annual-leave/(:any)/(:any)/(:any)'] = 'AldoRead/list_annual_leave/$1/$2/$3';
			$route['aldo/list-department-approval/(:any)/(:any)'] = 'AldoRead/list_department_approval/$1/$2';
			$route['aldo/list-ga-approval/(:any)/(:any)'] = 'AldoRead/list_ga_approval/$1/$2';
			$route['aldo/list-special-approval/(:any)/(:any)'] = 'AldoRead/list_special_approval/$1/$2';
			$route['aldo/list-approve-all/(:any)/(:any)'] = 'AldoRead/list_approve_all/$1/$2';
		$route['aldo/list-approval/(:any)/(:any)'] = 'AldoRead/list_approval/$1/$2';
		$route['aldo/list-day-off/(:any)/(:any)'] = 'AldoRead/list_day_off/$1/$2';
		$route['aldo/list-employee-by-department/(:any)/(:any)'] = 'AldoRead/list_employee_by_department/$1/$2';

		// Input
		$route['aldo/list-day-off-input/(:any)/(:any)/(:any)'] = 'AldoRead/list_day_off_input/$1/$2/$3';

		// Approval
		$route['aldo/list-cuti-special-approve/(:any)/(:any)'] = 'AldoRead/list_cuti_special_approve/$1/$2';
		$route['aldo/list-cuti-approval-input/(:any)/(:any)/(:any)'] = 'AldoRead/list_cuti_approval_input/$1/$2/$3';

	// Create =====================================================================================================================================
		// Setting
		$route['aldo/add-annual-leave/(:any)'] = 'aldoCreate/add_annual_leave/$1';
			$route['aldo/add-department-approval/(:any)'] = 'aldoCreate/add_department_approval/$1';
			$route['aldo/add-ga-approval/(:any)'] = 'aldoCreate/add_ga_approval/$1';
			$route['aldo/add-special-approval/(:any)'] = 'aldoCreate/add_special_approval/$1';
			$route['aldo/add-approve-all/(:any)'] = 'aldoCreate/add_approve_all/$1';
		$route['aldo/add-day-off/(:any)'] = 'aldoCreate/add_day_off/$1';

		// Input
		$route['aldo/add-day-off-input/(:any)/(:any)'] = 'aldoCreate/add_day_off_input/$1/$2';
		//$route['aldo/add-day-off-special-leave/(:any)/(:any)'] = 'aldoCreate/add_day_off_special_leave/$1/$2';

		// Approval

	// Update =====================================================================================================================================
		$route['aldo/update-day-off-input/(:any)'] = 'aldoUpdate/update_day_off_input/$1';
		$route['aldo/update-day-off-special-approve/(:any)'] = 'aldoUpdate/update_day_off_special_approve/$1';

	// Delete =====================================================================================================================================
		// Setting
		$route['aldo/delete-department-approval/(:any)'] = 'AldoDelete/delete_department_approval/$1';
		$route['aldo/delete-special-approval/(:any)'] = 'AldoDelete/delete_special_approval/$1';
		$route['aldo/delete-approve-all/(:any)'] = 'AldoDelete/delete_approve_all/$1';
		$route['aldo/delete-day-off/(:any)'] = 'AldoDelete/delete_day_off/$1';

		// INput
		$route['aldo/delete-day-off-input/(:any)'] = 'AldoDelete/delete_day_off_input/$1';

// Chart of Account
	// Page =====================================================================================================================================
		// Dashboard
		$route['coa/dashboard'] = 'CoaPage/dashboard';

		// Setting
		$route['coa/coa-type'] = 'CoaPage/coa_type';
		$route['coa/coa-classes'] = 'CoaPage/coa_classes';
		$route['coa/coa-currency'] = 'CoaPage/coa_currency';

		// Input
		$route['coa/chart-of-account'] = 'CoaPage/chart_of_account';
		$route['coa/sub-chart-of-account'] = 'CoaPage/sub_chart_of_account';
		$route['coa/rate'] = 'CoaPage/rate';			
		$route['coa/cash-account'] = 'CoaPage/cash_account';

	// Read =====================================================================================================================================
		// Setting
		$route['coa/list-coa-type/(:any)/(:any)'] = 'CoaRead/list_coa_type/$1/$2';
		$route['coa/list-coa-classes/(:any)/(:any)'] = 'CoaRead/list_coa_classes/$1/$2';
		$route['coa/list-coa-currency/(:any)/(:any)'] = 'CoaRead/list_coa_currency/$1/$2';

		// Input
		$route['coa/list-chart-of-account/(:any)/(:any)'] = 'CoaRead/list_chart_of_account/$1/$2';
		$route['coa/list-sub-chart-of-account/(:any)/(:any)'] = 'CoaRead/list_sub_chart_of_account/$1/$2';
		$route['coa/list-rate/(:any)/(:any)'] = 'CoaRead/list_rate/$1/$2';
		$route['coa/list-cash-account/(:any)/(:any)'] = 'CoaRead/list_cash_account/$1/$2';
		$route['coa/list-bank-account-by-id-coa/(:any)/(:any)'] = 'CoaRead/list_bank_account_by_id_coa/$1/$2';

	// Create =====================================================================================================================================
		// Setting
		$route['coa/add-coa-type/(:any)'] = 'CoaCreate/add_coa_type/$1';
		$route['coa/add-coa-classes/(:any)'] = 'CoaCreate/add_coa_classes/$1';
		$route['coa/add-coa-currency/(:any)'] = 'CoaCreate/add_coa_currency/$1';

		// Input
		$route['coa/add-chart-of-account/(:any)'] = 'CoaCreate/add_chart_of_account/$1';
		$route['coa/add-sub-chart-of-account/(:any)'] = 'CoaCreate/add_sub_chart_of_account/$1';
		$route['coa/add-rate/(:any)'] = 'CoaCreate/add_rate/$1';
		$route['coa/add-cash-account/(:any)'] = 'CoaCreate/add_cash_account/$1';
		$route['coa/add-bank-account/(:any)'] = 'CoaCreate/add_bank_account/$1';

	// Update =====================================================================================================================================
		// Setting
		$route['coa/update-coa-type/(:any)'] = 'CoaUpdate/update_coa_type/$1';
		$route['coa/update-coa-classes/(:any)'] = 'CoaUpdate/update_coa_classes/$1';
		$route['coa/update-coa-currency/(:any)'] = 'CoaUpdate/update_coa_currency/$1';

		// Input
		$route['coa/update-chart-of-account/(:any)'] = 'CoaUpdate/update_chart_of_account/$1';
		$route['coa/update-sub-chart-of-account/(:any)'] = 'CoaUpdate/update_sub_chart_of_account/$1';
		$route['coa/update-rate/(:any)'] = 'CoaUpdate/update_rate/$1';
		$route['coa/update-cash-account/(:any)'] = 'CoaUpdate/update_cash_account/$1';
		$route['coa/set-default-cash-account/(:any)'] = 'CoaUpdate/set_default_cash_account/$1';

// JOM
	// Page =====================================================================================================================================
		// Dashboard
		$route['jom/dashboard'] = 'JomPage/dashboard';

		// Setting
		$route['jom/job-type'] = 'JomPage/job_type';
		$route['jom/job-task'] = 'JomPage/job_task';
		$route['jom/job-task-sub'] = 'JomPage/job_task_sub';
		$route['jom/country'] = 'JomPage/country';
		$route['jom/tax'] = 'JomPage/tax';
		$route['jom/sub-tax'] = 'JomPage/sub_tax';
		$route['jom/material'] = 'JomPage/material';
		$route['jom/part-list-status'] = 'JomPage/part_list_status';
		$route['jom/permission-special'] = 'JomPage/permission_special';
		$route['jom/permission-type'] = 'JomPage/permission_type';
		$route['jom/permission/(:any)'] = 'JomPage/permission/$1';

		// Input
		$route['jom/account/(:any)'] = 'JomPage/account/$1';
		$route['jom/input-job/(:any)'] = 'JomPage/input_job/$1';
		$route['jom/list-job'] = 'JomPage/list_job';
		$route['jom/after-trial/(:any)'] = 'JomPage/after_trial/$1';
		$route['jom/part-list/(:any)'] = 'JomPage/part_list/$1';
		$route['jom/bom'] = 'JomPage/bom';

	// Read =====================================================================================================================================
		// Setting
		$route['jom/list-job-type/(:any)/(:any)'] = 'JomRead/list_job_type/$1/$2';
		$route['jom/list-job-task/(:any)/(:any)'] = 'JomRead/list_job_task/$1/$2';
		$route['jom/list-job-task-sub/(:any)/(:any)'] = 'JomRead/list_job_task_sub/$1/$2';
		$route['jom/list-country/(:any)/(:any)'] = 'JomRead/list_country/$1/$2';
		$route['jom/list-tax/(:any)/(:any)'] = 'JomRead/list_tax/$1/$2';
		$route['jom/list-sub-tax/(:any)/(:any)'] = 'JomRead/list_sub_tax/$1/$2';
		$route['jom/list-sub-tax-by-sub-tax-cd/(:any)/(:any)'] = 'JomRead/list_sub_tax_by_sub_tax_cd/$1/$2';
		$route['jom/list-material/(:any)/(:any)'] = 'JomRead/list_material/$1/$2';
		$route['jom/list-material-datatable/(:any)'] = 'JomRead/list_material_datatable/$1';
		$route['jom/list-part-list-status/(:any)/(:any)'] = 'JomRead/list_part_list_status/$1/$2';
		$route['jom/list-part-list-status-datatable/(:any)'] = 'JomRead/list_part_list_status_datatable/$1';
		$route['jom/list-permission-special/(:any)/(:any)'] = 'JomRead/list_permission_special/$1/$2';
		$route['jom/list-permission-type/(:any)/(:any)'] = 'JomRead/list_permission_type/$1/$2';
		$route['jom/list-permission-employee/(:any)/(:any)/(:any)'] = 'JomRead/list_permission_employee/$1/$2/$3';

		// Input
		$route['jom/list-account/(:any)/(:any)/(:any)'] = 'JomRead/list_account/$1/$2/$3';
		$route['jom/list-account-datatable/(:any)/(:any)/(:any)'] = 'JomRead/list_account_datatable/$1/$2/$3';
		$route['jom/list-account-material-datatable/(:any)/(:any)/(:any)'] = 'JomRead/list_account_material_datatable/$1/$2/$3';
		$route['jom/list-job-number/(:any)/(:any)/(:any)'] = 'JomRead/list_job_number/$1/$2/$3';
		$route['jom/list-job-order/(:any)/(:any)/(:any)'] = 'JomRead/list_job_order/$1/$2/$3';
		$route['jom/list-employee/(:any)/(:any)'] = 'JomRead/list_employee/$1/$2';
		$route['jom/list-employee-datatable/(:any)/(:any)'] = 'JomRead/list_employee_datatable/$1/$2';
		$route['jom/list-job-order-by-jobno/(:any)/(:any)'] = 'JomRead/list_job_order_by_jobno/$1/$2';
		$route['jom/list-after-trial/(:any)/(:any)'] = 'JomRead/list_after_trial/$1/$2';

		$route['jom/list-part-list-datatable/(:any)/(:any)'] = 'JomRead/list_part_list_datatable/$1/$2';
		$route['jom/list-part-list/(:any)/(:any)'] = 'JomRead/list_part_list/$1/$2';
		$route['jom/list-file-dwg/(:any)/(:any)'] = 'JomRead/list_file_dwg_datatable/$1/$2';
		$route['jom/list-part-list-by-part-no/(:any)/(:any)/(:any)'] = 'JomRead/list_part_list_by_part_no/$1/$2/$2';
		$route['jom/list-part-list-review/(:any)'] = 'JomRead/list_part_list_review/$1';
		$route['jom/list-part-list-detail/(:any)/(:any)'] = 'JomRead/list_part_list_detail/$1/$2';

		$route['jom/list-inventory-datatable/(:any)'] = 'JomRead/list_inventory_datatable/$1';
		$route['jom/list-inventory/(:any)/(:any)'] = 'JomRead/list_inventory/$1/$2';

		$route['jom/list-account-imo/(:any)/(:any)'] = 'JomRead/list_account_imo/$1/$2';
		$route['jom/list-part-list-by-account-imo/(:any)/(:any)/(:any)/(:any)'] = 'JomRead/list_part_list_by_account_imo/$1/$2/$3/$4';

		$route['jom/list-imo/(:any)/(:any)/(:any)'] = 'JomRead/list_imo/$1/$2/$3';

		$route['jom/list-part-list-bom-datatable/(:any)/(:any)'] = 'JomRead/list_part_list_bom_datatable/$1/$2';
		$route['jom/list-job-order-datatable/(:any)'] = 'JomRead/list_job_order_datatable/$1';

	// Create =====================================================================================================================================
		// Setting
		$route['jom/add-job-type/(:any)'] = 'JomCreate/add_job_type/$1';
		$route['jom/add-job-task/(:any)'] = 'JomCreate/add_job_task/$1';
		$route['jom/add-job-task-sub/(:any)'] = 'JomCreate/add_job_task_sub/$1';
		$route['jom/add-country/(:any)'] = 'JomCreate/add_country/$1';
		$route['jom/add-tax/(:any)'] = 'JomCreate/add_tax/$1';
		$route['jom/add-sub-tax/(:any)'] = 'JomCreate/add_sub_tax/$1';
		$route['jom/add-material/(:any)'] = 'JomCreate/add_material/$1';
		$route['jom/add-part-list-status/(:any)'] = 'JomCreate/add_part_list_status/$1';
		$route['jom/add-permission-special/(:any)'] = 'JomCreate/add_permission_special/$1';
		$route['jom/add-permission-type/(:any)'] = 'JomCreate/add_permission_type/$1';
		$route['jom/add-permission-employee/(:any)'] = 'JomCreate/add_permission_employee/$1';

		// Input
		$route['jom/add-account/(:any)/(:any)'] = 'JomCreate/add_account/$1/$2';
		$route['jom/add-account-password/(:any)'] = 'JomCreate/add_account_password/$1';
		$route['jom/add-job-number/(:any)'] = 'JomCreate/add_job_number/$1';
		$route['jom/add-job-order/(:any)'] = 'JomCreate/add_job_order/$1';
		$route['jom/add-after-trial/(:any)'] = 'JomCreate/add_after_trial/$1';
		$route['jom/add-part-list/(:any)'] = 'JomCreate/add_part_list/$1';
		$route['jom/upload-file-dwg/(:any)'] = 'JomCreate/upload_file_dwg/$1';

		$route['jom/add-imo/(:any)'] = 'JomCreate/add_imo/$1';
		$route['jom/add-imo-line/(:any)'] = 'JomCreate/add_imo_line/$1';

		$route['jom/add-rto/(:any)'] = 'JomCreate/add_rto/$1';

		$route['jom/add-bom/(:any)'] = 'JomCreate/add_bom/$1';

	// Update =====================================================================================================================================
		// Setting
		$route['jom/update-job-type/(:any)'] = 'JomUpdate/update_job_type/$1';
		$route['jom/update-job-task/(:any)'] = 'JomUpdate/update_job_task/$1';
		$route['jom/update-job-task-sub/(:any)'] = 'JomUpdate/update_job_task_sub/$1';
		$route['jom/update-country/(:any)'] = 'JomUpdate/update_country/$1';
		$route['jom/update-tax/(:any)'] = 'JomUpdate/update_tax/$1';
		$route['jom/update-sub-tax/(:any)'] = 'JomUpdate/update_sub_tax/$1';
		$route['jom/update-material/(:any)'] = 'JomUpdate/update_material/$1';
		$route['jom/update-part-list-status/(:any)'] = 'JomUpdate/update_part_list_status/$1';
		$route['jom/update-permission-type/(:any)'] = 'JomUpdate/update_permission_type/$1';
		$route['jom/update-permission-employee/(:any)'] = 'JomUpdate/update_permission_employee/$1';

		// Input
		$route['jom/update-account/(:any)'] = 'JomUpdate/update_account/$1';
		$route['jom/update-after-trial/(:any)'] = 'JomUpdate/update_after_trial/$1';
		$route['jom/update-part-list/(:any)'] = 'JomUpdate/update_part_list/$1';
		$route['jom/update-part-list-account/(:any)'] = 'JomUpdate/update_part_list_account/$1';

		$route['jom/update-imo-line/(:any)'] = 'JomUpdate/update_imo_line/$1';
		$route['jom/approve-imo/(:any)'] = 'JomUpdate/approve_imo/$1';

	// Delete =====================================================================================================================================
		// Setting
		$route['jom/delete-permission-special/(:any)'] = 'JomDelete/delete_permission_special/$1';
		$route['jom/delete-permission-employee/(:any)'] = 'JomDelete/delete_permission_employee/$1';
		$route['jom/delete-input-job/(:any)'] = 'JomDelete/delete_input_job/$1';

		// Input
		$route['jom/delete-job-order/(:any)'] = 'JomDelete/delete_job_order/$1';
		$route['jom/delete-after-trial/(:any)'] = 'JomDelete/delete_after_trial/$1';

		$route['jom/delete-part-list/(:any)'] = 'JomDelete/delete_part_list/$1';

		$route['jom/delete-imo-line/(:any)'] = 'JomDelete/delete_imo_line/$1';

		$route['jom/delete-rto/(:any)'] = 'JomDelete/delete_rto/$1';

// INV
	// Page =====================================================================================================================================
		// Dashboard
		$route['inventory/dashboard'] = 'InventoryPage/dashboard';

		// Setting
		$route['inventory/uom'] = 'InventoryPage/uom';
		$route['inventory/class-category'] = 'InventoryPage/class_category';
		$route['inventory/warehouse'] = 'InventoryPage/warehouse';
		$route['inventory/item-class'] = 'InventoryPage/item_class';

		// Input
		$route['inventory/inventory-group'] = 'InventoryPage/inventory_group';	
		$route['inventory/maker'] = 'InventoryPage/maker';	
		$route['inventory/inventory'] = 'InventoryPage/inventory';	
		$route['inventory/return'] = 'InventoryPage/return';
		$route['inventory/list-return'] = 'InventoryPage/list_return';
		$route['inventory/kit-assy'] = 'InventoryPage/kit_assy';
		$route['inventory/list-kit-assy'] = 'InventoryPage/list_kit_assy';
		
		$route['inventory/common-stock'] = 'InventoryPage/common_stock';
		$route['inventory/pns'] = 'InventoryPage/pns';
		$route['inventory/list-stock-out/(:any)'] = 'InventoryPage/list_stock_out/$1';

	// Read =====================================================================================================================================
		// Setting
		$route['inventory/list-uom/(:any)/(:any)'] = 'InventoryRead/list_uom/$1/$2';
		$route['inventory/list-class-category/(:any)/(:any)'] = 'InventoryRead/list_class_category/$1/$2';
		$route['inventory/list-warehouse/(:any)/(:any)'] = 'InventoryRead/list_warehouse/$1/$2';
		$route['inventory/list-warehouse-datatable/(:any)/(:any)'] = 'InventoryRead/list_warehouse_datatable/$1/$2';
		$route['inventory/list-item-class/(:any)/(:any)'] = 'InventoryRead/list_item_class/$1/$2';

		// Input
		$route['inventory/list-group-datatable/(:any)'] = 'InventoryRead/list_group_datatable/$1';
		$route['inventory/list-group/(:any)'] = 'InventoryRead/list_group/$1';
		$route['inventory/list-maker-datatable/(:any)'] = 'InventoryRead/list_maker_datatable/$1';
		$route['inventory/list-maker/(:any)'] = 'InventoryRead/list_maker/$1';
		$route['inventory/list-inventory/(:any)/(:any)'] = 'InventoryRead/list_inventory/$1/$2';
		$route['inventory/list-inventory-img/(:any)/(:any)'] = 'InventoryRead/list_inventory_img/$1/$2';
		
		$route['inventory/list-item-class-datatable/(:any)/(:any)'] = 'InventoryRead/list_item_class_datatable/$1/$2';
		$route['inventory/list-sub-tax-datatable/(:any)/(:any)'] = 'InventoryRead/list_sub_tax_datatable/$1/$2';
		$route['inventory/list-uom-datatable/(:any)/(:any)'] = 'InventoryRead/list_uom_datatable/$1/$2';
		$route['inventory/list-coa-datatable/(:any)/(:any)'] = 'InventoryRead/list_coa_datatable/$1/$2';
		$route['inventory/list-coa-income-datatable/(:any)/(:any)'] = 'InventoryRead/list_coa_income_datatable/$1/$2';
		$route['inventory/list-inventory-datatable/(:any)/(:any)'] = 'InventoryRead/list_inventory_datatable/$1/$2';
		$route['inventory/list-inventory-return-datatable/(:any)/(:any)'] = 'InventoryRead/list_inventory_return_datatable/$1/$2';
		$route['inventory/list-return-datatable/(:any)'] = 'InventoryRead/list_return_datatable/$1';

		$route['inventory/list-kit-assy-line-by-jobno-datatable/(:any)/(:any)'] = 'InventoryRead/list_kit_assy_line_by_jobno_datatable/$1/$2';
		$route['inventory/list-kit-assy-by-jobno-for-delivery-order-datatable/(:any)/(:any)'] = 'InventoryRead/list_kit_assy_by_jobno_for_delivery_order_datatable/$1/$2';
		$route['inventory/list-kit-assy-by-jobno/(:any)/(:any)'] = 'InventoryRead/list_kit_assy_by_jobno/$1/$2';
		$route['inventory/list-kit-assy-datatable/(:any)'] = 'InventoryRead/list_kit_assy_datatable/$1';
		$route['inventory/list-kit-assy-by-job-amount-summary/(:any)/(:any)'] = 'InventoryRead/list_kit_assy_by_job_amount_summary/$1/$2';

		$route['inventory/list-inventory-stock-datatable/(:any)/(:any)/(:any)'] = 'InventoryRead/list_inventory_stock_datatable/$1/$2/$3';
		$route['inventory/list-inventory-stock/(:any)/(:any)/(:any)'] = 'InventoryRead/list_inventory_stock/$1/$2/$3';
		$route['inventory/list-annual-price/(:any)/(:any)/(:any)'] = 'InventoryRead/list_annual_price/$1/$2/$3';
		$route['inventory/list-job-order-open/(:any)'] = 'InventoryRead/list_job_order_open/$1';

		$route['inventory/list-stock-out-datatable/(:any)/(:any)'] = 'InventoryRead/list_stock_out_datatable/$1/$2';

		$route['inventory/list-uom-converter/(:any)/(:any)/(:any)'] = 'InventoryRead/list_uom_converter/$1/$2/$3';

	// Create =====================================================================================================================================
		// Setting
		$route['inventory/add-uom/(:any)'] = 'InventoryCreate/add_uom/$1';
		$route['inventory/add-class-category/(:any)'] = 'InventoryCreate/add_class_category/$1';
		$route['inventory/add-warehouse/(:any)'] = 'InventoryCreate/add_warehouse/$1';
		$route['inventory/add-item-class/(:any)'] = 'InventoryCreate/add_item_class/$1';

		// Input
		$route['inventory/add-group/(:any)'] = 'InventoryCreate/add_group/$1';
		$route['inventory/add-inventory-group-img/(:any)'] = 'InventoryCreate/add_inventory_group_img/$1';
		$route['inventory/add-maker/(:any)'] = 'InventoryCreate/add_maker/$1';
		$route['inventory/add-inventory/(:any)'] = 'InventoryCreate/add_inventory/$1';
		$route['inventory/add-inventory-img/(:any)'] = 'InventoryCreate/add_inventory_img/$1';
		$route['inventory/add-return/(:any)'] = 'InventoryCreate/add_return/$1';
		$route['inventory/add-kit-assy/(:any)'] = 'InventoryCreate/add_kit_assy/$1';

		$route['inventory/add-annual-price/(:any)'] = 'InventoryCreate/add_annual_price/$1';
		$route['inventory/add-stock-transaction/(:any)'] = 'InventoryCreate/add_stock_transaction/$1';
		$route['inventory/add-uom-convert/(:any)'] = 'InventoryCreate/add_uom_convert/$1';

	// Update =====================================================================================================================================
		// Setting
		$route['inventory/update-uom/(:any)'] = 'InventoryUpdate/update_uom/$1';
		$route['inventory/update-class-category/(:any)'] = 'InventoryUpdate/update_class_category/$1';
		$route['inventory/update-warehouse/(:any)'] = 'InventoryUpdate/update_warehouse/$1';
		$route['inventory/update-item-class/(:any)'] = 'InventoryUpdate/update_item_class/$1';

		// Input
		$route['inventory/update-group/(:any)'] = 'InventoryUpdate/update_group/$1';
		$route['inventory/update-maker/(:any)'] = 'InventoryUpdate/update_maker/$1';
		$route['inventory/update-inventory/(:any)'] = 'InventoryUpdate/update_inventory/$1';

	// Delete
		$route['inventory/delete-stock-out/(:any)'] = 'InventoryUpdate/delete_stock_out/$1';
		$route['inventory/delete-inventory-img/(:any)/(:any)/(:any)'] = 'InventoryUpdate/delete_inventory_img/$1/$2/$3';

// DISTRIBUTION
	// Page =====================================================================================================================================
		// Dashboard
		$route['distribution/dashboard'] = 'DistributionPage/dashboard';

		// Setting
		$route['distribution/module-category'] = 'DistributionPage/module_category';
		$route['distribution/module'] = 'DistributionPage/module';
		$route['distribution/numbering-sequence/(:any)'] = 'DistributionPage/numbering_sequence/$1';
		$route['distribution/employee-permission/(:any)'] = 'DistributionPage/employee_permission/$1';
		$route['distribution/approval-permission/(:any)'] = 'DistributionPage/approval_permission/$1';
		$route['distribution/transaction-role/(:any)'] = 'DistributionPage/transaction_role/$1';
		$route['distribution/payment-methode'] = 'DistributionPage/payment_methode';
		$route['distribution/payment-terms'] = 'DistributionPage/payment_terms';

		// Input
		// Purchase
		$route['distribution/purchase-requisitions/(:any)'] = 'DistributionPage/purchase_requisitions/$1';
		$route['distribution/purchase/(:any)/(:any)'] = 'DistributionPage/purchase/$1/$2';
		$route['distribution/list-purchase/(:any)'] = 'DistributionPage/list_purchase/$1';
		$route['distribution/sales/(:any)/(:any)'] = 'DistributionPage/sales/$1/$2';
		$route['distribution/list-sales/(:any)'] = 'DistributionPage/list_sales/$1';

	// Read =====================================================================================================================================
		// Setting
		$route['distribution/list-module-category/(:any)/(:any)'] = 'DistributionRead/list_module_category/$1/$2';
		$route['distribution/list-module/(:any)/(:any)'] = 'DistributionRead/list_module/$1/$2';
		$route['distribution/list-numbering-sequence/(:any)/(:any)'] = 'DistributionRead/list_numbering_sequence/$1/$2';
		$route['distribution/list-employee-permission/(:any)/(:any)'] = 'DistributionRead/list_employee_permission/$1/$2';
		$route['distribution/list-approval-permission/(:any)/(:any)'] = 'DistributionRead/list_approval_permission/$1/$2';
		$route['distribution/list-approval-permission-datatable/(:any)/(:any)'] = 'DistributionRead/list_approval_permission_datatable/$1/$2';
		$route['distribution/list-transaction-role/(:any)/(:any)'] = 'DistributionRead/list_transaction_role/$1/$2';
		$route['distribution/list-payment-methode/(:any)/(:any)'] = 'DistributionRead/list_payment_methode/$1/$2';
		$route['distribution/list-payment-terms/(:any)/(:any)'] = 'DistributionRead/list_payment_terms/$1/$2';
		
		$route['distribution/list-employee-datatable/(:any)/(:any)'] = 'DistributionRead/list_employee_datatable/$1/$2';

		$route['distribution/list-module-category-menu/(:any)/(:any)'] = 'DistributionRead/list_module_category_menu/$1/$2';

		// Input Purchase

			// Purchase Requisitions

			$route['distribution/list-purchase-requisitions'] = 'DistributionRead/list_purchase_requisitions';
			$route['distribution/list-purchase-requisitions-select-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_requisitions_select_datatable/$1/$2';
			$route['distribution/list-purchase-requisitions-by-purchase-requisitions-number/(:any)'] = 'DistributionRead/list_purchase_requisitions_by_purchase_requisitions_number/$1';
			$route['distribution/purchase-requisitions-line-blank/(:any)/(:any)'] = 'DistributionRead/purchase_requisitions_line_blank/$1/$2';

			// Purchase Order
			$route['distribution/list-purchase-order/(:any)/(:any)'] = 'DistributionRead/list_purchase_order/$1/$2';
			$route['distribution/list-purchase-order-by-purchase-order-number/(:any)'] = 'DistributionRead/list_purchase_order_by_purchase_order_number/$1';
			$route['distribution/list-purchase-order-select-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_order_select_datatable/$1/$2';
			$route['distribution/list-purchase-order-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_order_datatable/$1/$2';
			$route['distribution/list-purchase-order-by-date-datatable/(:any)/(:any)/(:any)/(:any)'] = 'DistributionRead/list_purchase_order_by_date_datatable/$1/$2/$3/$4';
			$route['distribution/purchase-order-line-blank/(:any)/(:any)'] = 'DistributionRead/purchase_order_line_blank/$1/$2';
			$route['distribution/list-purchase-receipt-by-id-purchase-order/(:any)/(:any)'] = 'DistributionRead/list_purchase_receipt_by_id_purchase_order/$1/$2';

			$route['jom/list-part-list-bom-po-datatable/(:any)/(:any)'] = 'JomRead/list_part_list_bom_po_datatable/$1/$2';

			// Purchase Receipt
			$route['distribution/list-purchase-receipt-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_receipt_datatable/$1/$2';
			$route['distribution/list-purchase-receipt-by-date-datatable/(:any)/(:any)/(:any)/(:any)'] = 'DistributionRead/list_purchase_receipt_by_date_datatable/$1/$2/$3/$4';
			$route['distribution/list-purchase-order-select-for-purchase-receipt-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_order_select_for_purchase_receipt_datatable/$1/$2';
			$route['distribution/list-purchase-order-by-purchase-order-number-for-purchase-receipt/(:any)'] = 'DistributionRead/list_purchase_order_by_purchase_order_number_for_purchase_receipt/$1';
			$route['distribution/purchase-receipt-line-blank/(:any)/(:any)'] = 'DistributionRead/purchase_receipt_line_blank/$1/$2';
			$route['distribution/purchase-receipt-line-blank-receipt/(:any)/(:any)'] = 'DistributionRead/purchase_receipt_line_blank_receipt/$1/$2';
			$route['distribution/list-purchase-receipt-select-datatable/(:any)'] = 'DistributionRead/list_purchase_receipt_select_datatable/$1';
			$route['distribution/list-purchase-receipt-by-purchase-receipt-number/(:any)'] = 'DistributionRead/list_purchase_receipt_by_purchase_receipt_number/$1';

				// For Kit Assy
				$route['distribution/list-purchase-receipt-line-by-jobno-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_receipt_line_by_jobno_datatable/$1/$2';

			// Purchase Invoice
			$route['distribution/list-purchase-receipt-line-by-vendor-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_receipt_line_by_vendor_datatable/$1/$2';
			$route['distribution/list-purchase-receipt-by-purchase-receipt-line-id/(:any)'] = 'DistributionRead/list_purchase_receipt_by_purchase_receipt_line_id/$1';
			$route['distribution/list-purchase-invoice-select-datatable/(:any)'] = 'DistributionRead/list_purchase_invoice_select_datatable/$1';

			$route['distribution/list-purchase-invoice-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_invoice_datatable/$1/$2';
			$route['distribution/list-purchase-receipt-by-id-account-for-purchase-invoice-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_receipt_by_id_account_for_purchase_invoice_datatable/$1/$2';
			$route['distribution/list-purchase-receipt-by-id-account-datatable/(:any)/(:any)'] = 'DistributionRead/list_purchase_receipt_by_id_account_datatable/$1/$2';
			$route['distribution/list-purchase-receipt-line-by-purchase-receipt-number/(:any)'] = 'DistributionRead/list_purchase_receipt_line_by_purchase_receipt_number/$1';
			$route['distribution/list-purchase-invoice-by-purchase-invoice-number/(:any)'] = 'DistributionRead/list_purchase_invoice_by_purchase_invoice_number/$1';
			$route['distribution/purchase-invoice-line-blank-invoice/(:any)/(:any)'] = 'DistributionRead/purchase_invoice_line_blank_invoice/$1/$2';

		// Input Sales
			// Sales Order
			$route['distribution/list-job-order-for-sales-order-datatable/(:any)/(:any)'] = 'DistributionRead/list_job_order_for_sales_order_datatable/$1/$2';
			$route['distribution/sales-order-line-blank/(:any)/(:any)'] = 'DistributionRead/sales_order_line_blank/$1/$2';
			$route['distribution/list-sales-order-select-datatable/(:any)/(:any)'] = 'DistributionRead/list_sales_order_select_datatable/$1/$2';
			$route['distribution/list-sales-order-by-sales-order-number/(:any)'] = 'DistributionRead/list_sales_order_by_sales_order_number/$1';
			$route['distribution/list-sales-order-datatable/(:any)/(:any)'] = 'DistributionRead/list_sales_order_datatable/$1/$2';
			$route['distribution/list-sales-order-line/(:any)/(:any)'] = 'DistributionRead/list_sales_order_line/$1/$2';

			// Delivery Order
			//$route['distribution/list-sales-order-select-for-delivery-order-datatable/(:any)/(:any)'] = 'DistributionRead/list_sales_order_select_for_delivery_order_datatable/$1/$2';
			$route['distribution/list-sales-order-by-sales-order-number-for-delivery-order/(:any)'] = 'DistributionRead/list_sales_order_by_sales_order_number_for_delivery_order/$1';
			$route['distribution/delivery-order-line-blank/(:any)/(:any)'] = 'DistributionRead/delivery_order_line_blank/$1/$2';
			$route['distribution/list-sales-order-line-for-delivery-order-datatable/(:any)/(:any)/(:any)'] = 'DistributionRead/list_sales_order_line_for_delivery_order_datatable/$1/$2/$3';
			$route['distribution/list-delivery-order-select-datatable/(:any)/(:any)'] = 'DistributionRead/list_delivery_order_select_datatable/$1/$2';
			$route['distribution/list-delivery-order-by-delivery-order-number/(:any)'] = 'DistributionRead/list_delivery_order_by_delivery_order_number/$1';
			$route['distribution/list-delivery-order-datatable/(:any)/(:any)'] = 'DistributionRead/list_delivery_order_datatable/$1/$2';

			// Sales invoice
			$route['distribution/sales-invoice-line-blank/(:any)/(:any)'] = 'DistributionRead/sales_invoice_line_blank/$1/$2';
			$route['distribution/list-delivery-order-line-for-sales-invoice-datatable/(:any)/(:any)'] = 'DistributionRead/list_delivery_order_line_for_sales_invoice_datatable/$1/$2';
			$route['distribution/list-delivery-order-line/(:any)/(:any)'] = 'DistributionRead/list_delivery_order_line/$1/$2';
			$route['distribution/list-sales-invoice-select-datatable/(:any)/(:any)'] = 'DistributionRead/list_sales_invoice_select_datatable/$1/$2';
			$route['distribution/list-sales-invoice-by-sales-invoice-number/(:any)'] = 'DistributionRead/list_sales_invoice_by_sales_invoice_number/$1';

	// Create ===================================================================================================================================
		// Setting
		$route['distribution/add-module-category/(:any)'] = 'DistributionCreate/add_module_category/$1';
		$route['distribution/add-module/(:any)'] = 'DistributionCreate/add_module/$1';
		$route['distribution/add-numbering-sequence/(:any)'] = 'DistributionCreate/add_numbering_sequence/$1';
		$route['distribution/add-employee-permission/(:any)'] = 'DistributionCreate/add_employee_permission/$1';
		$route['distribution/add-approval-permission/(:any)'] = 'DistributionCreate/add_approval_permission/$1';
		$route['distribution/add-transaction-role/(:any)'] = 'DistributionCreate/add_transaction_role/$1';
		$route['distribution/add-payment-methode/(:any)'] = 'DistributionCreate/add_payment_methode/$1';
		$route['distribution/add-payment-terms/(:any)'] = 'DistributionCreate/add_payment_terms/$1';

		// Input
		$route['distribution/add-purchase-order/(:any)'] = 'DistributionCreate/add_purchase_order/$1';
		$route['distribution/add-purchase-receipt/(:any)'] = 'DistributionCreate/add_purchase_receipt/$1';
		$route['distribution/add-purchase-invoice/(:any)'] = 'DistributionCreate/add_purchase_invoice/$1';
		
		// Release 
		$route['distribution/release-purchase-invoice/(:any)'] = 'DistributionCreate/release_purchase_invoice/$1';

		$route['distribution/add-sales-order/(:any)'] = 'DistributionCreate/add_sales_order/$1';
		$route['distribution/add-delivery-order/(:any)'] = 'DistributionCreate/add_delivery_order/$1';
		$route['distribution/add-sales-invoice/(:any)'] = 'DistributionCreate/add_sales_invoice/$1';
		
		// Release 
		$route['distribution/release-sales-invoice/(:any)'] = 'DistributionCreate/release_sales_invoice/$1';

	// Update ===================================================================================================================================
		// Setting
		$route['distribution/update-module-category/(:any)'] = 'DistributionUpdate/update_module_category/$1';
		$route['distribution/update-module/(:any)'] = 'DistributionUpdate/update_module/$1';
		$route['distribution/update-employee-permission/(:any)'] = 'DistributionUpdate/update_employee_permission/$1';
		$route['distribution/update-approval-permission/(:any)'] = 'DistributionUpdate/update_approval_permission/$1';
		$route['distribution/update-transaction-role/(:any)'] = 'DistributionUpdate/update_transaction_role/$1';
		$route['distribution/update-payment-methode/(:any)'] = 'DistributionUpdate/update_payment_methode/$1';
		$route['distribution/update-payment-terms/(:any)'] = 'DistributionUpdate/update_payment_terms/$1';

		// Input
		$route['distribution/update-purchase-order/(:any)'] = 'DistributionUpdate/update_purchase_order/$1';
		$route['distribution/update-purchase-order-hold/(:any)/(:any)'] = 'DistributionUpdate/update_purchase_order_hold/$1/$2';
		$route['distribution/update-purchase-order-approve/(:any)/(:any)'] = 'DistributionUpdate/update_purchase_order_approve/$1/$2';

		$route['distribution/update-purchase-receipt-hold/(:any)/(:any)'] = 'DistributionUpdate/update_purchase_receipt_hold/$1/$2';
		$route['distribution/update-purchase-receipt-delete/(:any)'] = 'DistributionUpdate/update_purchase_receipt_delete/$1';
		$route['distribution/update-purchase-receipt-receipt/(:any)'] = 'DistributionUpdate/update_purchase_receipt_receipt/$1';
		$route['distribution/update-purchase-receipt-request-release/(:any)'] = 'DistributionUpdate/update_purchase_receipt_request_release/$1';
		$route['distribution/update-purchase-receipt-release/(:any)'] = 'DistributionUpdate/update_purchase_receipt_release/$1';

		$route['distribution/update-purchase-invoice-hold/(:any)/(:any)'] = 'DistributionUpdate/update_purchase_invoice_hold/$1/$2';

		$route['distribution/update-sales-order-hold/(:any)/(:any)'] = 'DistributionUpdate/update_sales_order_hold/$1/$2';
		$route['distribution/update-sales-order-approve/(:any)/(:any)'] = 'DistributionUpdate/update_sales_order_approve/$1/$2';

		$route['distribution/update-delivery-order-hold/(:any)/(:any)'] = 'DistributionUpdate/update_delivery_order_hold/$1/$2';
		$route['distribution/update-delivery-order-print/(:any)/(:any)'] = 'DistributionUpdate/update_delivery_order_print/$1/$2';

		$route['distribution/update-sales-invoice-hold/(:any)/(:any)'] = 'DistributionUpdate/update_sales_invoice_hold/$1/$2';
		$route['distribution/update-sales-invoice-print/(:any)/(:any)'] = 'DistributionUpdate/update_sales_invoice_print/$1/$2';

	// delete ===================================================================================================================================
		// Setting
		$route['distribution/delete-employee-permission/(:any)'] = 'DistributionUpdate/delete_employee_permission/$1';
		$route['distribution/delete-approval-permission/(:any)'] = 'DistributionUpdate/delete_approval_permission/$1';
		$route['distribution/delete-transaction-role/(:any)'] = 'DistributionUpdate/delete_transaction_role/$1';
		$route['distribution/delete-payment-methode/(:any)'] = 'DistributionUpdate/delete_payment_methode/$1';

		// Input
		$route['distribution/delete-purchase-order/(:any)'] = 'DistributionUpdate/delete_purchase_order/$1';

// FINANCE
	// Page =====================================================================================================================================
		// Dashboard
		$route['finance/dashboard'] = 'FinancePage/dashboard';

		// Setting
		$route['finance/module-category'] = 'FinancePage/module_category';
		$route['finance/module'] = 'FinancePage/module';
		$route['finance/numbering-sequence/(:any)'] = 'FinancePage/numbering_sequence/$1';
		$route['finance/coa-group/(:any)'] = 'FinancePage/coa_group/$1';
		$route['finance/ending-balance'] = 'FinancePage/ending_balance';

		// Input
		// Purchase
		$route['finance/cash-management/(:any)/(:any)'] = 'FinancePage/cash_management/$1/$2';

		$route['finance/account-payable/(:any)/(:any)'] = 'FinancePage/account_payable/$1/$2';
		$route['finance/account-receivable/(:any)/(:any)'] = 'FinancePage/account_receivable/$1/$2';

		$route['finance/account-payable/list-vendor-payment'] = 'FinancePage/list_vendor_payment';
		$route['finance/account-payable/list-customer-payment'] = 'FinancePage/list_customer_payment';

	// Read =====================================================================================================================================

		// Setting
		$route['finance/list-module-category/(:any)/(:any)'] = 'FinanceRead/list_module_category/$1/$2';
		$route['finance/list-module/(:any)/(:any)'] = 'FinanceRead/list_module/$1/$2';
		$route['finance/list-numbering-sequence/(:any)/(:any)'] = 'FinanceRead/list_numbering_sequence/$1/$2';
		$route['finance/list-header-numbering/(:any)/(:any)'] = 'FinanceRead/list_header_numbering/$1/$2';
		$route['finance/list-coa-group/(:any)/(:any)'] = 'FinanceRead/list_coa_group/$1/$2';

		// Input Finance
		$route['finance/list-cash-management/(:any)/(:any)'] = 'FinanceRead/list_cash_management/$1/$2';
		$route['finance/transaction-resume/(:any)/(:any)/(:any)'] = 'FinanceRead/transaction_resume/$1/$2/$3';
		$route['finance/list-balance/(:any)/(:any)/(:any)'] = 'FinanceRead/list_balance/$1/$2/$3';
		$route['finance/numbering-sequence/(:any)/(:any)/(:any)/(:any)'] = 'FinanceRead/numbering_sequence/$1/$2/$3/$4';

		$route['finance/list-transaction-line/(:any)/(:any)/(:any)/(:any)/(:any)'] = 'FinanceRead/list_transaction_line/$1/$2/$3/$4/$5';

		$route['finance/list-transaction-select-datatable/(:any)/(:any)'] = 'FinanceRead/list_transaction_select_datatable/$1/$2';
		$route['finance/list-transaction-by-transaction-number/(:any)'] = 'FinanceRead/list_transaction_by_transaction_number/$1';
		$route['finance/list-transaction-line-datatable/(:any)/(:any)'] = 'FinanceRead/list_transaction_line_datatable/$1/$2';
		$route['finance/list-transaction-line-periode-datatable/(:any)/(:any)'] = 'FinanceRead/list_transaction_line_periode_datatable/$1/$2';

		$route['finance/list-transaction-by-transaction-periode/(:any)/(:any)/(:any)'] = 'FinanceRead/list_transaction_by_transaction_periode/$1/$2/$3';

	// Create ===================================================================================================================================

		// Setting
		$route['finance/add-module-category/(:any)'] = 'FinanceCreate/add_module_category/$1';
		$route['finance/add-module/(:any)'] = 'FinanceCreate/add_module/$1';
		$route['finance/add-numbering-sequence/(:any)'] = 'FinanceCreate/add_numbering_sequence/$1';
		$route['finance/add-header-numbering/(:any)'] = 'FinanceCreate/add_header_numbering/$1';
		$route['finance/add-coa-group/(:any)'] = 'FinanceCreate/add_coa_group/$1';
		$route['finance/add-balance/(:any)'] = 'FinanceCreate/add_balance/$1';

		// Input
		$route['finance/add-petty-cash/(:any)/(:any)'] = 'FinanceCreate/add_petty_cash/$1/$2';

	// Update ===================================================================================================================================

		// Setting
		$route['finance/update-module-category/(:any)'] = 'FinanceUpdate/update_module_category/$1';
		$route['finance/update-module/(:any)'] = 'FinanceUpdate/update_module/$1';
		$route['finance/update-employee-permission/(:any)'] = 'FinanceUpdate/update_employee_permission/$1';
		$route['finance/update-coa-group/(:any)'] = 'FinanceUpdate/update_coa_group/$1';

		// Input
		$route['finance/update-cash-management/(:any)'] = 'FinanceUpdate/update_cash_management/$1';
		$route['finance/update-transaction-distribution-payment-date/(:any)'] = 'FinanceUpdate/update_transaction_distribution_payment_date/$1';
		$route['finance/update-transaction-distribution-payment-date-line/(:any)'] = 'FinanceUpdate/update_transaction_distribution_payment_date_line/$1';
		$route['finance/update-transaction-distribution-bank-account/(:any)'] = 'FinanceUpdate/update_transaction_distribution_bank_account/$1';
		$route['finance/update-transaction-distribution-bank-account-line/(:any)'] = 'FinanceUpdate/update_transaction_distribution_bank_account_line/$1';

		$route['finance/update-transaction-distribution-line/(:any)'] = 'FinanceUpdate/update_transaction_distribution_line/$1';
		$route['finance/update-checked-transaction-distribution/(:any)/(:any)/(:any)'] = 'FinanceUpdate/update_checked_transaction_distribution/$1/$2/$3';

	// delete ===================================================================================================================================

		// Input
		$route['finance/delete-cash-management/(:any)'] = 'FinanceUpdate/delete_cash_management/$1';
		$route['finance/delete-transaction-distribution/(:any)/(:any)'] = 'FinanceUpdate/delete_transaction_distribution/$1/$2';

// DAILY REPORT
	// Page =====================================================================================================================================
		// Dashboard
		$route['daily-report/dashboard'] = 'DailyReportPage/dashboard';

		// Setting
		$route['daily-report/machine-group'] = 'DailyReportPage/machine_group';
		$route['daily-report/machine'] = 'DailyReportPage/machine';

	// Read =====================================================================================================================================
		// Setting
		$route['daily-report/list-machine-group/(:any)/(:any)'] = 'DailyReportRead/list_machine_group/$1/$2';
		$route['daily-report/list-machine/(:any)/(:any)'] = 'DailyReportRead/list_machine/$1/$2';

	// Create =====================================================================================================================================
		// Setting
		$route['daily-report/add-machine-group/(:any)'] = 'DailyReportCreate/add_machine_group/$1';
		$route['daily-report/add-machine/(:any)'] = 'DailyReportCreate/add_machine/$1';

	// Update =====================================================================================================================================
		// Setting
		$route['daily-report/update-machine-group/(:any)'] = 'DailyReportUpdate/update_machine_group/$1';
		$route['daily-report/update-machine/(:any)'] = 'DailyReportUpdate/update_machine/$1';

// Middleware ESS ==============================================================================================================================
	$route['middleware/ess/list-absensi/(:any)'] = 'middleware/ess/Ess/list_absensi/$1';
	$route['middleware/ess/list-lembur/(:any)'] = 'middleware/ess/Ess/list_lembur/$1';
	$route['middleware/ess/list-transaksi-manual/(:any)'] = 'middleware/ess/Ess/list_transaksi_manual/$1';

// ====================================================================== REPORT =======================================================================
	// DISTRIBUTION
		// PDF
			$route['report/pdf/purchase-order/(:any)/(:any)'] = 'ReportPdf/purchase_order/$1/$2';
			$route['report/pdf/purchase-receipt/(:any)/(:any)'] = 'ReportPdf/purchase_receipt/$1/$2';
			$route['report/pdf/purchase-invoice/(:any)/(:any)'] = 'ReportPdf/purchase_invoice/$1/$2';
			$route['report/pdf/sales-order/(:any)/(:any)'] = 'ReportPdf/sales_order/$1/$2';
			$route['report/pdf/delivery-order/(:any)/(:any)'] = 'ReportPdf/delivery_order/$1/$2';
			$route['report/pdf/sales-invoice/(:any)/(:any)'] = 'ReportPdf/sales_invoice/$1/$2';
			$route['report/pdf/petty-cash/(:any)/(:any)/(:any)'] = 'ReportPdf/petty_cash/$1/$2/$3';
