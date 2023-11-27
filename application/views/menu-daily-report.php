<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
		<a class="sidebar-brand brand-logo" href="index.html" style="color:white; text-decoration: none;">Meiwa Fusion v2.0</a>
		<a class="sidebar-brand brand-logo-mini" href="index.html" style="color:white;">MF</a>
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
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white;">Daily Report v2023.01</span>
			<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/machine-group">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Machine Group</span>
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/machine">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Machine</span>
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#activity" aria-expanded="false" aria-controls="activity">
				<span class="menu-icon">
					<i class="mdi mdi-bank"></i>
				</span>
				<span class="menu-title">Activity</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="activity">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>daily-report/module-category">Department</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>daily-report/module">General</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#rate" aria-expanded="false" aria-controls="rate">
				<span class="menu-icon">
					<i class="mdi mdi-bank"></i>
				</span>
				<span class="menu-title">Rate</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="rate">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>daily-report/module-category">Machine</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>daily-report/module">Employee</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#middleware" aria-expanded="false" aria-controls="middleware">
				<span class="menu-icon">
					<i class="mdi mdi-bank"></i>
				</span>
				<span class="menu-title">Middleware</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="middleware">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>daily-report/module-category">Machine</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>daily-report/module">Activity</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/payment-terms">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Page by Department</span> <!-- Halaman tampilan Daily Report by Departemen -->
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/payment-methode">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Report Access</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/payment-methode">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">New Record</span>
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/payment-methode">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">View</span>
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/payment-methode">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Resume</span>
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>daily-report/payment-methode">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Report</span>
			</a>
		</li>

	</ul>
</nav>