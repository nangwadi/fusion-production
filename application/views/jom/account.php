<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new <?php echo ucfirst($category); ?></li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<input type="hidden" id="add_account_value" value="1">
					<button class="btn btn-primary btn-md" style="font-size:12pt;" onclick="div_account();" id="btn_add"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add <?php echo ucfirst($category); ?></button>
					<hr style="border:2px solid white;">
					<div id="div_account" style="display:none;">
						<div class="row">
							<div class="col-md-7">
								<h3>General Information</h3>
								<hr>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label><?php echo ucfirst($category); ?> ID</label>
											<input type="hidden" class="form-control" id="id_account">
											<input type="hidden" class="form-control" id="no">
											<input type="text" class="form-control" id="account_cd" placeholder="<?php echo ucfirst($category); ?> ID">
										</div>	
									</div>		
									<div class="col-md-8">
										<div class="form-group">
											<label><?php echo ucfirst($category); ?> Name</label>
											<input type="text" class="form-control" id="account_name" placeholder="<?php echo ucfirst($category); ?> Name">
										</div>
									</div>	
									<div class="col-md-8">
										<div class="form-group">
											<label><?php echo ucfirst($category); ?> Address</label>
											<input type="text" class="form-control" id="main_address" placeholder="<?php echo ucfirst($category); ?> Address">
										</div>
									</div>		
									<div class="col-md-4">
										<div class="form-group">
											<label>City</label>
											<input type="text" class="form-control" id="city" placeholder="<?php echo ucfirst($category); ?> City">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Postal Code</label>
											<input type="text" class="form-control" id="postal_code" placeholder="<?php echo ucfirst($category); ?> City">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Country</label>
											<select class="form-control" id="id_country" style="color: white;"></select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Phone 1</label>
											<input type="text" class="form-control" id="phone_1" placeholder="<?php echo ucfirst($category); ?> Phone 1">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Phone 2</label>
											<input type="text" class="form-control" id="phone_2" placeholder="<?php echo ucfirst($category); ?> Phone 2">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Fax</label>
											<input type="text" class="form-control" id="fax" placeholder="<?php echo ucfirst($category); ?> Fax">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>PIC</label>
											<input type="text" class="form-control" id="attn" placeholder="<?php echo ucfirst($category); ?> Attn">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Company Email</label>
											<input type="text" class="form-control" id="email" placeholder="<?php echo ucfirst($category); ?> Email">
										</div>
									</div>
								</div>
								
							</div>
							<div class="col-md-5">
								<h3>Chart of Account (COA)</h3>
								<hr>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label><?php echo ucfirst($apr); ?></label>
											<input type="text" class="form-control" id="id_coa_apr_account" onclick="list_coa('apr_account');" style="color: black;" readonly>
											<!-- <select class="form-control" id="apr_account" style="color: white;"></select> -->
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Advance <?php echo ucfirst($apr); ?></label>
											<input type="text" class="form-control" id="id_coa_aapr_account" onclick="list_coa('aapr_account');" style="color: black;" readonly>
											<!-- <select class="form-control" id="aapr_account" style="color: white;"></select> -->
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label><?php echo ucfirst($pr); ?></label>
											<input type="text" class="form-control" id="id_coa_payment_account" onclick="list_coa('payment_account');" style="color: black;" readonly>
											<!-- <select class="form-control" id="payment_account" style="color: white;"></select> -->
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Account of Sales</label>
											<input type="text" class="form-control" id="id_coa_sales_account" onclick="list_coa('sales_account');" style="color: black;" readonly>
											<!-- <select class="form-control" id="sales_account" style="color: white;"></select> -->
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Sales Person</label>
											<input type="text" class="form-control" id="sales_person" style="color: black;" onclick="list_employee();" readonly>
											<!-- <select class="form-control" id="sales_person" style="color: white;"></select> -->
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Tax</label><br>
											<input type="checkbox" id="taxable" style="width: 30px; height:30px;">
										</div>
									</div>
								</div>
							</div>
						</div>
							
						<div class="form-group" align="right">
							<button class="btn btn-primary me-2" onclick="add_account();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
							<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List <?php echo ucfirst($category); ?></h4>
					<hr style="border:2px solid white;">

					<div class="card-body" style="background-color:white; border-radius:5px; color: black;">

						<table class="table table-striped" id="list_account">
							<thead>
								<tr>
									<th style="width:5%;">No</th>
									<th style="width:10%;"><?php echo ucfirst($category); ?> ID</th>
									<th style="width:20%;"><?php echo ucfirst($category); ?> Name</th>
									<th style="width:25%;">Address</th>
									<th style="width:10%;">Phone</th>
									<th style="width:10%;">PIC</th>
									<th style="width:10%;">Email</th>
									<th style="width:10%;">Action</th>
								</tr>
							</thead>
							<!-- <tbody></tbody> -->
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_loading">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div id="modal_header">
					<h5 class="modal-title" id="modal_title"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<p id="modal_body" align="center"></p>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_disen">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div id="modal_header_disen">
					<h5 class="modal-title" id="modal_title_disen"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="id_account_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_account();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_number">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div id="modal_header_number">
					<h5 class="modal-title" id="modal_title_number"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="id_account_number">
					<div id="div_numbering">
					</div>
				</div>
				<div id="modal_footer_number">
					<div id="loading_job_number" style="color:white;"></div>
					<a class="btn btn-secondary" onClick="account_number_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_coa_apr_account">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Chart of Account</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<table class="table" id="list_coa_apr_account">
						<thead>
							<tr>
								<th>Select</th>
								<th>COA ID</th>
								<th>COA Name</th>
								<th>COA Class</th>
								<th>COA Type</th>
								<th>Currency</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_coa_add('apr_account');">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_coa_close('apr_account');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_coa_aapr_account">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Chart of Account</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<table class="table" id="list_coa_aapr_account">
						<thead>
							<tr>
								<th>Select</th>
								<th>COA ID</th>
								<th>COA Name</th>
								<th>COA Class</th>
								<th>COA Type</th>
								<th>Currency</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_coa_add('aapr_account');">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_coa_close('aapr_account');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_coa_payment_account">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Chart of Account</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<table class="table" id="list_coa_payment_account">
						<thead>
							<tr>
								<th>Select</th>
								<th>COA ID</th>
								<th>COA Name</th>
								<th>COA Class</th>
								<th>COA Type</th>
								<th>Currency</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_coa_add('payment_account');">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_coa_close('payment_account');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_coa_sales_account">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Chart of Account</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<table class="table" id="list_coa_sales_account">
						<thead>
							<tr>
								<th>Select</th>
								<th>COA ID</th>
								<th>COA Name</th>
								<th>COA Class</th>
								<th>COA Type</th>
								<th>Currency</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_coa_add('sales_account');">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_coa_close('sales_account');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_employee">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Employee</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<table class="table" id="list_employee">
						<thead>
							<tr>
								<th>Select</th>
								<th>COA ID</th>
								<th>COA Name</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_employee_add('');">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_employee_close('');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_password">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title" id="modal_title_password"></h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-4" align="right">
							<button class="btn btn-secondary" onclick="password_generator();">Generate Password</button>
						</div>
						<div class="col-md-8">
							<input type="hidden" id="id_account_password" value="">
							<input type="text" id="password_account" class="form-control" style="color:black;" readonly>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" align="center">
							<div id="loading_account_password" style="color:black;"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="save_password();">Save Password</a>
			        <a class="btn btn-secondary" onClick="set_password_close('');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var category = '<?php echo $category; ?>';
	</script>
<!-- content-wrapper ends -->