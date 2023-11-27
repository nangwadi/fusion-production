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
			<a class="nav-link" href="<?php echo base_url(); ?>finance/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white;">Finance</span>
			<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#organization" aria-expanded="false" aria-controls="organization">
				<span class="menu-icon">
					<i class="mdi mdi-bank"></i>
				</span>
				<span class="menu-title">Finance Module</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="organization">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>finance/module-category">Module Category</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>finance/module">Modules</a></li>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#numbering" aria-expanded="false" aria-controls="numbering">
				<span class="menu-icon">
					<i class="mdi mdi-format-list-bulleted-type"></i>
				</span>
				<span class="menu-title">Numbering</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="numbering">
				<ul class="nav flex-column sub-menu">
					<?php
						for ($i=0; $i < count($result_module); $i++) { 
							$module_name = $result_module[$i]->module_name;
							$file_name = $result_module[$i]->file_name;
							?>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>finance/numbering-sequence/<?php echo $file_name; ?>"><?php echo $module_name; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</li>

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#coa_group" aria-expanded="false" aria-controls="coa_group">
				<span class="menu-icon">
					<i class="mdi mdi-format-list-bulleted-type"></i>
				</span>
				<span class="menu-title">COA Group</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="coa_group">
				<ul class="nav flex-column sub-menu">
					<?php
						for ($i=0; $i < count($result_module); $i++) { 
							$module_name = $result_module[$i]->module_name;
							$file_name = $result_module[$i]->file_name;
							?>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>finance/coa-group/<?php echo $file_name; ?>"><?php echo $module_name; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</li> -->

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#ending_balance" aria-expanded="false" aria-controls="ending_balance">
				<span class="menu-icon">
					<i class="mdi mdi-format-list-bulleted-type"></i>
				</span>
				<span class="menu-title">Ending Balance</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="ending_balance">
				<ul class="nav flex-column sub-menu">
					<?php
						for ($i=0; $i < count($result_module); $i++) { 
							$module_name = $result_module[$i]->module_name;
							$file_name = $result_module[$i]->file_name;
							?>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>finance/ending-balance/<?php echo $file_name; ?>"><?php echo $module_name; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</li> -->

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>finance/ending-balance">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Ending Balance</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>

		<?php
			for ($a=0; $a<count($result_module_category); $a++) { 
				$id_module_category = $result_module_category[$a]->id_module_category;
				$module_category_name = str_replace(' ', '-', $result_module_category[$a]->module_category_name);
				$deleted = $result_module_category[$a]->deleted;
				if ($deleted==0) {
					?>
					<li class="nav-item menu-items">
						<a class="nav-link" data-bs-toggle="collapse" href="#menu_<?php echo $id_module_category; ?>" aria-expanded="false" aria-controls="menu_<?php echo $id_module_category; ?>">
							<span class="menu-icon">
								<i class="mdi mdi-account-multiple"></i>
							</span>
							<span class="menu-title"><?php echo $module_category_name ?></span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="menu_<?php echo $id_module_category; ?>">
						<ul class="nav flex-column sub-menu">
							<?php
								for ($ii=0; $ii < count($result_module); $ii++) { 
									$id_module_category_2 = $result_module[$ii]->id_module_category;
									$module_name = $result_module[$ii]->module_name;
									$file_name = $result_module[$ii]->file_name;

									if ($id_module_category==$id_module_category_2) {
										?>
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>finance/<?php echo strtolower($module_category_name); ?>/<?php echo $file_name; ?>/0"><?php echo $module_name; ?></a></li>
										<?php
									}
								}
							?>
						</ul>
					</div>
					</li>
					<?php					
				}
			}
		?>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Report</span>
		</li>

		<!-- <?php
			for ($a=0; $a<count($result_module_category); $a++) { 
				$id_module_category = $result_module_category[$a]->id_module_category;
				$module_category_name = str_replace(' ', '-', $result_module_category[$a]->module_category_name);
				$deleted = $result_module_category[$a]->deleted;
				if ($deleted==0) {
					?>
					<li class="nav-item menu-items">
						<a class="nav-link" data-bs-toggle="collapse" href="#menu_report_<?php echo $id_module_category; ?>" aria-expanded="false" aria-controls="menu_report_<?php echo $id_module_category; ?>">
							<span class="menu-icon">
								<i class="mdi mdi-account-multiple"></i>
							</span>
							<span class="menu-title"><?php echo $module_category_name ?></span>
							<i class="menu-arrow"></i>
						</a>
						<div class="collapse" id="menu_report_<?php echo $id_module_category; ?>">
						<ul class="nav flex-column sub-menu">
							<?php
								for ($ii=0; $ii < count($result_module); $ii++) { 
									$id_module_category_2 = $result_module[$ii]->id_module_category;
									$module_name = $result_module[$ii]->module_name;
									$file_name = $result_module[$ii]->file_name;

									if ($id_module_category==$id_module_category_2) {
										?>
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>finance/<?php echo strtolower($module_category_name); ?>/<?php echo $file_name; ?>/0"><?php echo $module_name; ?></a></li>
										<?php
									}
								}
							?>
						</ul>
					</div>
					</li>
					<?php					
				}
			}
		?> -->
	</ul>
</nav>