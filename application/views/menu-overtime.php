<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
		<a class="sidebar-brand brand-logo" href="index.html"><img src="<?php echo base_url(); ?>style/corona/template/assets/images/logo.svg" alt="logo" /></a>
		<a class="sidebar-brand brand-logo-mini" href="index.html"><img src="<?php echo base_url(); ?>style/corona/template/assets/images/logo-mini.svg" alt="logo" /></a>
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

		<?php
			if ($category==3) {
				?>
				<li class="nav-item nav-category">
					<span class="nav-link" style="color:white;">Overtime</span>
					<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
				</li>

				<li class="nav-item menu-items">
					<a class="nav-link" href="<?php echo base_url(); ?>overtime/time-deadline">
						<span class="menu-icon">
							<i class="mdi mdi-clock-alert "></i>
						</span>
						<span class="menu-title">Time Deadline</span>
					</a>
				</li>

				<li class="nav-item menu-items">
					<a class="nav-link" href="#makerandapproval" data-bs-toggle="collapse" aria-expanded="false" aria-controls="makerandapproval">
						<span class="menu-icon">
							<i class="mdi mdi-playlist-check"></i>
						</span>
						<span class="menu-title">Maker and Approval</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="makerandapproval">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>overtime/maker">Maker</a></li>
							<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>overtime/approval">Approval</a></li>
							<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>overtime/special-approval">Special Approval</a></li>
						</ul>
					</div>
				</li>
				<?php
			}
			else {
				?>
				<li class="nav-item nav-category">
					<span class="nav-link" style="color:white;">Overtime</span>
				</li>
				<?php
			}
		?>

		

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>overtime/daily-overtime">
				<span class="menu-icon">
					<i class="mdi mdi-calendar-check"></i>
				</span>
				<span class="menu-title">Daily</span>
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>overtime/holiday-overtime">
				<span class="menu-icon">
					<i class="mdi mdi-calendar"></i>
				</span>
				<span class="menu-title">Holiday</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Report</span>
		</li>

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" href="#">
				<span class="menu-icon">
					<i class="mdi mdi-file-multiple"></i>
				</span>
				<span class="menu-title">Overtime Report</span>
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