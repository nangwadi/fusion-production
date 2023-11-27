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
			<a class="nav-link" href="<?php echo base_url(); ?>inventory/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>

		<li class="nav-item">
			<span class="nav-link" style="color:white;">Inventory</span>
		</li>

			<?php
				if (in_array($cNIK_session, array("16L10294"))) {
					?>
						<li class="nav-item nav-category">
							<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
						</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/uom">
									<span class="menu-icon">
										<i class="mdi mdi-format-list-bulleted-type"></i>
									</span>
									<span class="menu-title">Unit of Measure (UOM)</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/class-category">
									<span class="menu-icon">
										<i class="mdi mdi-group"></i>
									</span>
									<span class="menu-title">Item Class Category</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/warehouse">
									<span class="menu-icon">
										<i class="mdi mdi-home-variant "></i>
									</span>
									<span class="menu-title">Warehouse</span>
								</a>
							</li>	

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/item-class">
									<span class="menu-icon">
										<i class="mdi mdi-table"></i>
									</span>
									<span class="menu-title">Item Class</span>
								</a>
							</li>

						<li class="nav-item nav-category">
							<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
						</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/inventory-group">
									<span class="menu-icon">
										<i class="mdi mdi-folder-plus"></i>
									</span>
									<span class="menu-title">Inventory Group</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/maker">
									<span class="menu-icon">
										<i class="mdi mdi-folder-plus"></i>
									</span>
									<span class="menu-title">Maker</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/inventory">
									<span class="menu-icon">
										<i class="mdi mdi-library-plus"></i>
									</span>
									<span class="menu-title">Inventory</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/return">
									<span class="menu-icon">
										<i class="mdi mdi-backburger"></i>
									</span>
									<span class="menu-title">Return</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/kit-assy">
									<span class="menu-icon">
										<i class="mdi mdi-library-books"></i>
									</span>
									<span class="menu-title">Kit Assembling</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/common-stock">
									<span class="menu-icon">
										<i class="mdi mdi-playlist-check"></i>
									</span>
									<span class="menu-title">Common Stock</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/pns">
									<span class="menu-icon">
										<i class="mdi mdi-file-multiple"></i>
									</span>
									<span class="menu-title">Pantry & Stationary</span>
								</a>
							</li>

							<!-- <li class="nav-item menu-items">
								<a class="nav-link" href="<?php echo base_url(); ?>inventory/tool-management">
									<span class="menu-icon">
										<i class="mdi mdi-settings"></i>
									</span>
									<span class="menu-title">Tool Management</span>
								</a>
							</li> -->

						<li class="nav-item nav-category">
							<span class="nav-link" style="color:white; padding-left: 5px;">Report</span>
						</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
									<span class="menu-icon">
										<i class="mdi mdi-file-document-box"></i>
									</span>
									<span class="menu-title">Inventory Resume</span>
								</a>
							</li>

							<li class="nav-item menu-items">
								<a class="nav-link" href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
									<span class="menu-icon">
										<i class="mdi mdi-file-document-box"></i>
									</span>
									<span class="menu-title">Documentation</span>
								</a>
							</li>
					<?php
				}
				else {
					if (in_array($cIDDept_session, array("DEP004", "DEP010"))) {
						?>
							<li class="nav-item nav-category">
								<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
							</li>

								<li class="nav-item menu-items">
									<a class="nav-link" href="<?php echo base_url(); ?>inventory/inventory-group">
										<span class="menu-icon">
											<i class="mdi mdi-folder-plus"></i>
										</span>
										<span class="menu-title">Inventory Group</span>
									</a>
								</li>

								<li class="nav-item menu-items">
									<a class="nav-link" href="<?php echo base_url(); ?>inventory/maker">
										<span class="menu-icon">
											<i class="mdi mdi-folder-plus"></i>
										</span>
										<span class="menu-title">Maker</span>
									</a>
								</li>

								<li class="nav-item menu-items">
									<a class="nav-link" href="<?php echo base_url(); ?>inventory/inventory">
										<span class="menu-icon">
											<i class="mdi mdi-library-plus"></i>
										</span>
										<span class="menu-title">Inventory</span>
									</a>
								</li>
						<?php
					}
				}
			?>

	</ul>
</nav>