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
			<a class="nav-link" href="<?php echo base_url(); ?>aldo/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard <?php echo $special_approval; ?></span>
			</a>
		</li>

		<li class="nav-item">
			<span class="nav-link" style="color:white;">AA Aldo</span>
		</li>

		<?php
			if ($special_approval==1) {
				?>
				<li class="nav-item nav-category">
					<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
				</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>aldo/annual-leave">
							<span class="menu-icon">
								<i class="mdi mdi-sigma"></i>
							</span>
							<span class="menu-title">Annual Leave</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="#approval" data-bs-toggle="collapse" aria-expanded="false" aria-controls="approval">
							<span class="menu-icon">
								<i class="mdi mdi-calendar-multiple-check"></i>
							</span>
							<span class="menu-title">Approval Type</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="approval">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>aldo/department-approval">Department Approval</a></li>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>aldo/ga-approval">General Affairs Approval</a></li>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>aldo/special-approval">Special Approval</a></li>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>aldo/approve-all">Approve All</a></li>
							</ul>
						</div>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>aldo/day-off">
							<span class="menu-icon">
								<i class="mdi mdi-calendar-check"></i>
							</span>
							<span class="menu-title">Day Off</span>
						</a>
					</li>
				<?php
			}
		?>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>

			<?php
				foreach ($result_menu_aldo as $resultList){
					$cIDAbsen = $resultList->cIDAbsen;
					$cNmAbsen = $resultList->cNmAbsen;

					$cuti_khusus = $resultList->cuti_khusus;

					if ($cuti_khusus==0) {
						?>
						<li class="nav-item menu-items">
							<a class="nav-link" href="<?php echo base_url(); ?>aldo/non-special-leave/<?php echo $cIDAbsen; ?>">
								<span class="menu-icon">
									<i class="mdi mdi-calendar-check"></i>
								</span>
								<span class="menu-title" style="word-wrap: break-word; width: 50px;"><?php echo $cNmAbsen; ?></span>
							</a>
						</li>
						<?php
					}
				}
			?>

			<li class="nav-item menu-items">
				<a class="nav-link" href="#special-leave" data-bs-toggle="collapse" aria-expanded="false" aria-controls="special-leave">
					<span class="menu-icon">
						<i class="mdi mdi-calendar-multiple-check"></i>
					</span>
					<span class="menu-title">Special Leave</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="special-leave">
					<ul class="nav flex-column sub-menu">
						<?php
							foreach ($result_menu_aldo as $resultList){
								$cIDAbsen = $resultList->cIDAbsen;
								$cNmAbsen = $resultList->cNmAbsen;

								$cuti_khusus = $resultList->cuti_khusus;

								if ($cuti_khusus==1) {
									?>
									<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>aldo/special-leave/<?php echo $cIDAbsen; ?>"><?php echo $cNmAbsen; ?></a></li>
									<?php
								}
							}
						?>
					</ul>
				</div>
			</li>

			<?php
			if ($special_approval==1) {
				?>
				<li class="nav-item nav-category">
					<span class="nav-link" style="color:white; padding-left: 5px;">Special Approval</span>
				</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>aldo/special-approve">
							<span class="menu-icon">
								<i class="mdi mdi-calendar-multiple-check"></i>
							</span>
							<span class="menu-title">Aprrove</span>
						</a>
					</li>
				<?php
			}

			if ($count_department_approval>=1) {
				?>
				<li class="nav-item nav-category">
					<span class="nav-link" style="color:white; padding-left: 5px;">Approval</span>
				</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>aldo/approval/department">
							<span class="menu-icon">
								<i class="mdi mdi-account-check"></i>
							</span>
							<span class="menu-title">Department</span>
						</a>
					</li>
				<?php
				if ($count_ga_approval>=1) {
						?>
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>aldo/approval/ga">
									<span class="menu-icon">
										<i class="mdi mdi-account-check"></i>
									</span>
									<span class="menu-title">General Affairs</span>
								</a>
							</li>
						<?php
				}
			}
			else {
				if ($count_ga_approval>=1) {
					if ($count_department_approval==0) {
						?>
						<li class="nav-item nav-category">
							<span class="nav-link" style="color:white; padding-left: 5px;">Approval</span>
						</li>
						<li class="nav-item menu-items">
							<a class="nav-link" href="<?php echo base_url(); ?>aldo/approval/ga">
								<span class="menu-icon">
									<i class="mdi mdi-account-check"></i>
								</span>
								<span class="menu-title">General Affairs</span>
							</a>
						</li>
						<?php
					}
					else {
						?>
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>aldo/approval/ga">
									<span class="menu-icon">
										<i class="mdi mdi-account-check"></i>
									</span>
									<span class="menu-title">General Affairs</span>
								</a>
							</li>
						<?php
					}
				}
			}
			
		?>

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>aldo/holiday-aldo">
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
				<span class="menu-title">aldo Report</span>
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