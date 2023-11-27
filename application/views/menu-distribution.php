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
			<a class="nav-link" href="<?php echo base_url(); ?>distribution/dashboard">
				<span class="menu-icon">
					<i class="mdi mdi-speedometer"></i>
				</span>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white;">Distribution</span>
			<span class="nav-link" style="color:white; padding-left: 5px;">Setting</span>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#organization" aria-expanded="false" aria-controls="organization">
				<span class="menu-icon">
					<i class="mdi mdi-bank"></i>
				</span>
				<span class="menu-title">Distribution Module</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="organization">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/module-category">Module Category</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/module">Modules</a></li>
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
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/numbering-sequence/<?php echo $file_name; ?>"><?php echo $module_name; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#employee" aria-expanded="false" aria-controls="employee">
				<span class="menu-icon">
					<i class="mdi mdi-account-multiple-plus"></i>
				</span>
				<span class="menu-title">Permission</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="employee">
				<ul class="nav flex-column sub-menu">
					<?php
						for ($i=0; $i < count($result_module); $i++) { 
							$module_name = $result_module[$i]->module_name;
							$file_name = $result_module[$i]->file_name;
							?>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/employee-permission/<?php echo $file_name; ?>"><?php echo $module_name; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#approval" aria-expanded="false" aria-controls="approval">
				<span class="menu-icon">
					<i class="mdi mdi-account-check"></i>
				</span>
				<span class="menu-title">Approval</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="approval">
				<ul class="nav flex-column sub-menu">
					<?php
						for ($i=0; $i < count($result_module); $i++) { 
							$module_name = $result_module[$i]->module_name;
							$file_name = $result_module[$i]->file_name;
							?>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/approval-permission/<?php echo $file_name; ?>"><?php echo $module_name; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#transaction" aria-expanded="false" aria-controls="transaction">
				<span class="menu-icon">
					<i class="mdi mdi-wunderlist"></i>
				</span>
				<span class="menu-title">Transaction Role</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="transaction">
				<ul class="nav flex-column sub-menu">
					<?php
						for ($i=0; $i < count($result_module); $i++) { 
							$module_name = $result_module[$i]->module_name;
							$file_name = $result_module[$i]->file_name;
							?>
								<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/transaction-role/<?php echo $file_name; ?>"><?php echo $module_name; ?></a></li>
							<?php
						}
					?>
				</ul>
			</div>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>distribution/payment-methode">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Payment Methode</span>
			</a>
		</li>

		<li class="nav-item menu-items">
			<a class="nav-link" href="<?php echo base_url(); ?>distribution/payment-terms">
				<span class="menu-icon">
					<i class="mdi mdi-currency-usd"></i>
				</span>
				<span class="menu-title">Payment Terms</span>
			</a>
		</li>

		<li class="nav-item nav-category">
			<span class="nav-link" style="color:white; padding-left: 5px;">Input</span>
		</li>

		<?php
			for ($a=0; $a<count($result_module_category); $a++) { 
				$id_module_category = $result_module_category[$a]->id_module_category;
				$module_category_name = $result_module_category[$a]->module_category_name;
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
											<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/<?php echo strtolower($module_category_name); ?>/<?php echo $file_name; ?>/0"><?php echo $module_name; ?></a></li>
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

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#Employee" aria-expanded="false" aria-controls="Employee">
				<span class="menu-icon">
					<i class="mdi mdi-account-multiple"></i>
				</span>
				<span class="menu-title">Employee</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="Employee">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/employee/active">Employee Active</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/employee/resign">Employee Resign</a></li>
				</ul>
			</div>
		</li> -->

		<!-- <li class="nav-item menu-items">
			<a class="nav-link" data-bs-toggle="collapse" href="#attendance-record" aria-expanded="false" aria-controls="attendance-record">
				<span class="menu-icon">
					<i class="mdi mdi-format-list-bulleted"></i>
				</span>
				<span class="menu-title">Attendance Record</span>
				<i class="menu-arrow"></i>
			</a>
			<div class="collapse" id="attendance-record">
				<ul class="nav flex-column sub-menu">
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/face">Face Biometric</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/finger">Finger Scan</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/change-sift">Change Shift</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/daily-attendance">Daily Attendance</a></li>
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
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/1">In Hour Null</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/2">Out Hour Null</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/3">In Same Out</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/4">Shift Wrong</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/5">Wrong OT Calculation</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/6">Wrong OT Day</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/7">Night OT</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/8">OT Not Register</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/9">OT Plan & Act</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/10">Day Off but Not Null</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/11">OT Come Late</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/12">Change Day</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/13">Attendance & Off Work</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/attendance-check/14">Off Work & Attendance</a></li>
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
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/manual-transaction">Manual Transaction</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo base_url(); ?>distribution/medical-limit">Medical Reimbursement</a></li>
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
		</li> -->

	</ul>
</nav>