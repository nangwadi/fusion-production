<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
		<!-- <a class="sidebar-brand brand-logo" href="index.html"><img src="<?php echo base_url(); ?>style/corona/template/assets/images/logo.svg" alt="logo" /></a>
		<a class="sidebar-brand brand-logo-mini" href="index.html"><img src="<?php echo base_url(); ?>style/corona/template/assets/images/logo-mini.svg" alt="logo" /></a> -->
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
			<a class="nav-link" href="<?php echo base_url(); ?>jom/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>

		<li class="nav-item">
			<span class="nav-link" style="color:white;">Job Order Management v4</span>
		</li>


		<?php
			if (count($result_permission_special)>=1) {
				?>
				<li class="nav-item nav-category">
					<span class="nav-link" style="color:white; padding-left: 5px;">Setting <?php //echo count($result_permission_special); ?></span>
				</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/job-type">
							<span class="menu-icon">
								<i class="mdi mdi-format-list-bulleted-type"></i>
							</span>
							<span class="menu-title">Job Type</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/job-task">
							<span class="menu-icon">
								<i class="mdi mdi-playlist-plus"></i>
							</span>
							<span class="menu-title">Job Task</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/job-task-sub">
							<span class="menu-icon">
								<i class="mdi mdi-playlist-minus"></i>
							</span>
							<span class="menu-title">Job Sub Task</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/country">
							<span class="menu-icon">
								<i class="mdi mdi-map-marker-radius"></i>
							</span>
							<span class="menu-title">Country</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" data-bs-toggle="collapse" href="#tax" aria-expanded="false" aria-controls="tax">
							<span class="menu-icon">
								<i class="mdi mdi-content-duplicate"></i>
							</span>
							<span class="menu-title">Tax</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="tax">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/tax">Tax Account</a></li>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/sub-tax">Sub Tax Account</a></li>
							</ul>
						</div>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/material">
							<span class="menu-icon">
								<i class="mdi mdi-map-marker-radius"></i>
							</span>
							<span class="menu-title">Material</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/part-list-status">
							<span class="menu-icon">
								<i class="mdi mdi-checkbox-multiple-marked-outline"></i>
							</span>
							<span class="menu-title">Part List Status</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/permission-special">
							<span class="menu-icon">
								<i class="mdi mdi-lock-open-outline"></i>
							</span>
							<span class="menu-title">Special Permission</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" href="<?php echo base_url(); ?>jom/permission-type">
							<span class="menu-icon">
								<i class="mdi mdi-key-change"></i>
							</span>
							<span class="menu-title">Permission Type</span>
						</a>
					</li>

					<li class="nav-item menu-items">
						<a class="nav-link" data-bs-toggle="collapse" href="#employee" aria-expanded="false" aria-controls="employee">
							<span class="menu-icon">
								<i class="mdi mdi-key-variant"></i>
							</span>
							<span class="menu-title">User Permission</span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="employee">
							<ul class="nav flex-column sub-menu">
								<?php
									foreach ($result_permission_type as $result_permission_type_list){
										$permission_cd = $result_permission_type_list->permission_cd;
										$permission_name = $result_permission_type_list->permission_name;
										$deleted = $result_permission_type_list->deleted;
										if ($deleted==0) {
											?>
												<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/permission/<?php echo $permission_cd; ?>"><?php echo $permission_name; ?></a></li>
											<?php 
										}
									}
								?>
							</ul>
						</div>
					</li>
				<?php
			}
		?>
				
		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>

		<?php
			if (count($result_permission_special)>=1) {
				?>
				<li class="nav-item menu-items">
					<a class="nav-link" data-bs-toggle="collapse" href="#account" aria-expanded="false" aria-controls="account">
						<span class="menu-icon">
							<i class="mdi mdi-bank"></i>
						</span>
						<span class="menu-title">Account</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="collapse" id="account">
						<ul class="nav flex-column sub-menu">
							<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/account/customer">Customers</a></li>
							<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/account/vendor">Vendors</a></li>
						</ul>
					</div>
				</li>


				<li class="nav-item menu-items">
					<a class="nav-link" href="<?php echo base_url(); ?>jom/input-job/0">
						<span class="menu-icon">
							<i class="mdi mdi-library-plus"></i>
						</span>
						<span class="menu-title">Input Job</span>
					</a>
				</li>

				<li class="nav-item menu-items">
					<a class="nav-link" href="<?php echo base_url(); ?>jom/list-job">
						<span class="menu-icon">
							<i class="mdi mdi-library-plus"></i>
						</span>
						<span class="menu-title">List Job</span>
					</a>
				</li>

				<li class="nav-item menu-items">
					<a class="nav-link" href="<?php echo base_url(); ?>jom/bom">
						<span class="menu-icon">
							<i class="mdi mdi-currency-usd"></i>
						</span>
						<span class="menu-title">BOM</span>
					</a>
				</li>

				<!-- <li class="nav-item menu-items">
					<a class="nav-link" href="<?php echo base_url(); ?>jom/part-list">
						<span class="menu-icon">
							<i class="mdi mdi-format-list-bulleted-type"></i>
						</span>
						<span class="menu-title">Part List</span>
					</a>
				</li>

				<li class="nav-item menu-items">
					<a class="nav-link" href="<?php echo base_url(); ?>jom/schedule">
						<span class="menu-icon">
							<i class="mdi mdi-calendar-multiple-check"></i>
						</span>
						<span class="menu-title">Process Schedule</span>
					</a>
				</li>

				<li class="nav-item menu-items">
					<a class="nav-link" href="<?php echo base_url(); ?>jom/bom">
						<span class="menu-icon">
							<i class="mdi mdi-cart-plus"></i>
						</span>
						<span class="menu-title">Bill of Material</span>
					</a>
				</li> 

				 -->
				<?php
			}
			else {
				foreach ($result_permission_employee as $result_permission_employee_list){
					$company_id = $result_permission_employee_list->company_id;
					$id_permission = $result_permission_employee_list->id_permission;
					$permission_cd = $result_permission_employee_list->permission_cd;
					$permission_name = $result_permission_employee_list->permission_name;
					$cNIK = $result_permission_employee_list->cNIK;
					if ($cNIK==$cNIK_session and $company_id==$company_id_session) {
						if (in_array ($id_permission, array('1'))) {
							?>
							<li class="nav-item menu-items">
								<a class="nav-link" data-bs-toggle="collapse" href="#account" aria-expanded="false" aria-controls="account">
									<span class="menu-icon">
										<i class="mdi mdi-bank"></i>
									</span>
									<span class="menu-title">Account</span>
									<i class="menu-arrow"></i>
								</a>
								<div class="collapse" id="account">
									<ul class="nav flex-column sub-menu">
										<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/account/customer">Customers</a></li>
										<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/account/vendor">Vendors</a></li>
									</ul>
								</div>
							</li>
							<?php
						}
						else if (in_array ($id_permission, array('2'))) {
							?>
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>jom/input-job">
									<span class="menu-icon">
										<i class="mdi mdi-library-plus"></i>
									</span>
									<span class="menu-title">Input Job</span>
								</a>
							</li>
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>jom/list-job">
									<span class="menu-icon">
										<i class="mdi mdi-library-plus"></i>
									</span>
									<span class="menu-title">List Job</span>
								</a>
							</li>
							<?php
						}
						/*else if (in_array ($id_permission, array('3'))) {
							?>
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>jom/part-list">
									<span class="menu-icon">
										<i class="mdi mdi-format-list-bulleted-type"></i>
									</span>
									<span class="menu-title">Part List</span>
								</a>
							</li>
							<?php
						}
						else if (in_array ($id_permission, array('4'))) {
							?>
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>jom/job-task">
									<span class="menu-icon">
										<i class="mdi mdi-playlist-check"></i>
									</span>
									<span class="menu-title">Job Task</span>
								</a>
							</li>							
							<?php
						}
						else if (in_array ($id_permission, array('5'))) {
							?>
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>jom/bom">
									<span class="menu-icon">
										<i class="mdi mdi-cart-plus"></i>
									</span>
									<span class="menu-title">Bill of Material</span>
								</a>
							</li>
							<?php
						}
						else if (in_array ($id_permission, array('6'))) {
							?>
							
							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>jom/schedule">
									<span class="menu-icon">
										<i class="mdi mdi-calendar-multiple-check"></i>
									</span>
									<span class="menu-title">Process Schedule</span>
								</a>
							</li>
							<?php
						}*/
					}
				}
			}
		?>

			<!-- <li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#account" aria-expanded="false" aria-controls="account">
					<span class="menu-icon">
						<i class="mdi mdi-bank"></i>
					</span>
					<span class="menu-title">Account</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="account">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/account/customer">Customers</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/account/vendor">Vendors</a></li>
					</ul>
				</div>
			</li>


			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>jom/input-job">
					<span class="menu-icon">
						<i class="mdi mdi-library-plus"></i>
					</span>
					<span class="menu-title">Input Job</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>jom/part-list">
					<span class="menu-icon">
						<i class="mdi mdi-format-list-bulleted-type"></i>
					</span>
					<span class="menu-title">Input Part List</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>jom/schedule">
					<span class="menu-icon">
						<i class="mdi mdi-calendar-multiple-check"></i>
					</span>
					<span class="menu-title">Process Schedule</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>jom/bom">
					<span class="menu-icon">
						<i class="mdi mdi-cart-plus"></i>
					</span>
					<span class="menu-title">Bill of Material</span>
				</a>
			</li>

			<li class="nav-item menu-items">
				<a class="nav-link" href="<?php echo base_url(); ?>jom/budget-project">
					<span class="menu-icon">
						<i class="mdi mdi-currency-usd"></i>
					</span>
					<span class="menu-title">Budget Project</span>
				</a>
			</li> -->

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Report</span>
		</li>

			<li class="nav-item menu-items">
				<a class="nav-link" data-bs-toggle="collapse" href="#cost" aria-expanded="false" aria-controls="cost">
					<span class="menu-icon">
						<i class="mdi mdi-file-document"></i>
					</span>
					<span class="menu-title">Mold Cost</span>
					<i class="menu-arrow"></i>
				</a>
				<div class="collapse" id="cost">
					<ul class="nav flex-column sub-menu">
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/mold-cost-pdf">Mold Cost PDF</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/mold-cost-excel">Mold Cost Excel</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/mold-cost-analyzer">Mold Cost Analyzer</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/process-analyzer">Process Analyzer</a></li>
						<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>jom/cost-analyzer">Cost Analyzer</a></li>
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