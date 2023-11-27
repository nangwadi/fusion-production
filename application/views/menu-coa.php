<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
		<!-- <a class="sidebar-brand brand-logo" href="index.html"><img src="<?php echo base_url(); ?>style/corona/template/assets/images/logo.svg" alt="logo" /></a>
		<a class="sidebar-brand brand-logo-mini" href="index.html"><img src="<?php echo base_url(); ?>style/corona/template/assets/images/logo-mini.svg" alt="logo" /></a> -->
		<a class="sidebar-brand brand-logo" href="index.html" style="color:white; text-decoration: none;">Merapi</a>
		<a class="sidebar-brand brand-logo-mini" href="index.html" style="color:white;">Merapi</a>
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
			<a class="nav-link" href="<?php echo base_url(); ?>coa/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>

		<li class="nav-item">
			<span class="nav-link" style="color:white;">Chart of Account</span>
		</li>


		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
		</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>coa/coa-type">
					<span class="menu-icon">
						<i class="mdi mdi-format-list-bulleted-type"></i>
					</span>
					<span class="menu-title">COA Type</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>coa/coa-classes">
					<span class="menu-icon">
						<i class="mdi mdi-playlist-plus"></i>
					</span>
					<span class="menu-title">COA Classess</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>coa/coa-currency">
					<span class="menu-icon">
						<i class="mdi mdi-newspaper"></i>
					</span>
					<span class="menu-title">Currency</span>
				</a>
			</li>
				
		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>


			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>coa/chart-of-account">
					<span class="menu-icon">
						<i class="mdi mdi-chart-bubble"></i>
					</span>
					<span class="menu-title">Chart of Account</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>coa/sub-chart-of-account">
					<span class="menu-icon">
						<i class="mdi mdi-chart-gantt"></i>
					</span>
					<span class="menu-title">Sub Chart of Account</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>coa/cash-account">
					<span class="menu-icon">
						<i class="mdi mdi-credit-card"></i>
					</span>
					<span class="menu-title">Cash Account</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>coa/rate">
					<span class="menu-icon">
						<i class="mdi mdi-currency-usd"></i>
					</span>
					<span class="menu-title">Rate</span>
				</a>
			</li>
						

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>coa/holiday-coa">
				<span class="menu-icon">
					<i class="mdi mdi-calendar"></i>
				</span>
				<span class="menu-title">Holiday</span>
			</a>
		</li> -->

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Report</span>
		</li>

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" href="#">
				<span class="menu-icon">
					<i class="mdi mdi-file-multiple"></i>
				</span>
				<span class="menu-title">coa Report</span>
			</a>
		</li> -->

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