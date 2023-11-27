<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
		<a class="sidebar-brand brand-logo" href="index.html" style="color:white; text-decoration: none;">MEIWA FUSION</a>
		<a class="sidebar-brand brand-logo-mini" href="index.html" style="color:white;">MEIWA FUSION</a>
	</div>
	<ul class="nav">
	  	<li class="nav-item profile">
	    	<div class="profile-desc">
	      		<div class="profile-pic">
	        		<div class="count-indicator">
						<img class="img-xs rounded-circle " src="<?php echo base_url(); ?>style/corona/template/assets/images/faces/face15.jpg" alt="">
						<span class="count bg-success"></span>
	        		</div>
		        	<div class="profile-name">
						<h5 class="mb-0 font-weight-normal"><?php echo $cNmPegawai_session; ?></h5>
						<span><?php echo $cNmJbtn_session; ?></span>
		        	</div>
	      		</div>
	      		<a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
	      		<div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
	        		<a href="#" class="dropdown-item preview-item">
	          <div class="preview-thumbnail">
	            <div class="preview-icon bg-dark rounded-circle">
	              <i class="mdi mdi-settings text-primary"></i>
	            </div>
	          </div>
	          <div class="preview-item-content">
	            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
	          </div>
	        		</a>
	        		<div class="dropdown-divider"></div>
	        		<a href="#" class="dropdown-item preview-item">
	          <div class="preview-thumbnail">
	            <div class="preview-icon bg-dark rounded-circle">
	              <i class="mdi mdi-onepassword  text-info"></i>
	            </div>
	          </div>
	          <div class="preview-item-content">
	            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
	          </div>
	        		</a>
	        		<div class="dropdown-divider"></div>
	        		<a href="#" class="dropdown-item preview-item">
	          <div class="preview-thumbnail">
	            <div class="preview-icon bg-dark rounded-circle">
	              <i class="mdi mdi-calendar-today text-success"></i>
	            </div>
	          </div>
	          <div class="preview-item-content">
	            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
	          </div>
	        		</a>
	      		</div>
	    	</div>
	  	</li>

		<li class="nav-item menu-items" style="padding-top:30px;">
			<a class="nav-link" href="<?php echo base_url(); ?>ess/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white;">ESS</span>
			<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#organization" aria-expanded="false" aria-controls="organization">
				<span class="menu-icon">
					<i class="mdi mdi-bank"></i>
				</span>
				<span class="menu-title">Organization</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="organization">
				<ul class="nav flex-column sub-menu">
					<?php
						if ($cNIK_session=='16L10294') {
							?>
							<li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>ess/company">Company</a></li>
							<?php
						}
					?>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/plant">Company Plant</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/department">Department</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/division">Division</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/potition">Position</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/limit-medical">Limit Medical</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/employee-status">Employee Status</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/family-status">Family Status</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/family-relation">Family Relation</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/education">Education</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/religion">Religion</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/bank">Bank</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/salary-component">Salary Component</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/salary-component-group">Salary Component Group</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/data-photo">Data Photo</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/blood-group">Blood Group</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/reasons-for-resigning">Reasons for Resigning</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#attendance" aria-expanded="false" aria-controls="attendance">
				<span class="menu-icon">
					<i class="mdi mdi-calendar"></i>
				</span>
				<span class="menu-title">Attendance</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="attendance">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/sift-group">Shift Group</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/sift">Shift</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/precense-type">Precense Type</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/national-holiday">National Holiday</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/mandatory-overtime">Mandatory Overtime</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/change-day">Change Day</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/ramadhan">Ramadhan</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-periode">Attendance Periode</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#Payroll-Setting" aria-expanded="false" aria-controls="Payroll-Setting">
				<span class="menu-icon">
					<i class="mdi mdi-settings-box"></i>
				</span>
				<span class="menu-title">Payroll Setting</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="Payroll-Setting">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/bpjs">BPJS</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/national-tax">National Tax</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/salary-deduction">Salary Deduction</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/shift-allowance">Shift Allowance</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/overtime-calculation-basis">Overtime Calculation Basis</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/position-allowance">Position Allowance</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#Employee" aria-expanded="false" aria-controls="Employee">
				<span class="menu-icon">
					<i class="mdi mdi-account-multiple"></i>
				</span>
				<span class="menu-title">Employee</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="Employee">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/employee/active">Employee Active</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/employee/resign">Employee Resign</a></li>
					<!-- <li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/medical-limit">Limit of Medical Reimbursement</a></li> -->
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#attendance-record" aria-expanded="false" aria-controls="attendance-record">
				<span class="menu-icon">
					<i class="mdi mdi-format-list-bulleted"></i>
				</span>
				<span class="menu-title">Attendance Record</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="attendance-record">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/face">Face Biometric</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/finger">Finger Scan</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/change-sift">Change Shift</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/daily-attendance">Daily Attendance</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#attendance-check" aria-expanded="false" aria-controls="attendance-check">
				<span class="menu-icon">
					<i class="mdi mdi-format-list-bulleted"></i>
				</span>
				<span class="menu-title">Attendance Check</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="attendance-check">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/1">In Hour Null</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/2">Out Hour Null</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/3">In Same Out</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/4">Shift Wrong</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/5">Wrong OT Calculation</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/6">Wrong OT Day</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/7">Night OT</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/8">OT Not Register</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/9">OT Plan & Act</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/10">Day Off but Not Null</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/11">OT Come Late</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/12">Change Day</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/13">Attendance & Off Work</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/attendance-check/14">Off Work & Attendance</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#Payroll" aria-expanded="false" aria-controls="Payroll">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Payroll</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="Payroll">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/manual-transaction">Manual Transaction</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>ess/medical-limit">Medical Reimbursement</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
				<span class="menu-icon">
					<i class="mdi mdi-file-document-box"></i>
				</span>
				<span class="menu-title">Documentation</span>
			</a>
		</li>

	</ul>
</nav>