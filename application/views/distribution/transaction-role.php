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
				<li class="breadcrumb-item active" aria-current="page">create new Transaction Role</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Transaction Role - <?php echo $result_file_name[0]->module_name; ?></h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Sequence</label>
						<input type="hidden" class="form-control" id="id_transaction_role" value="">
						<input type="hidden" class="form-control" id="no" value="">
						<input type="number" class="form-control" id="sequence" placeholder="Sequence" style="color:white;">
					</div>

					<div class="form-group">
						<label>Transaction Name</label>
						<input type="text" class="form-control" id="transaction_name" placeholder="Transaction Name" style="color:white;">
					</div>

					<div class="row">
						<div class="col-md-2">
							<label>Write</label><br>
							<input type="checkbox" id="write" style="width:25px; height:25px;">
						</div>
						<div class="col-md-4">
							<label>Email Approve</label><br>
							<input type="checkbox" id="email_approval" style="width:25px; height:25px;">
						</div>
						<div class="col-md-4">
							<label>Email Vendor</label><br>
							<input type="checkbox" id="email_vendor" style="width:25px; height:25px;">
						</div>
						<div class="col-md-2">
							<label>Close</label><br>
							<input type="checkbox" id="close_transaction" style="width:25px; height:25px;">
						</div>
					</div>
					
					<div class="col-md-12" style="padding-top:27px;">
						<button class="btn btn-primary me-2" onclick="add_transaction_role();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Transaction Role - <?php echo $result_file_name[0]->module_name; ?></h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_transaction_role">
						<thead>
							<tr><!-- 
								<th><div style="width:10%; color:white;">No</div></th> -->
								<th><div style="width:10%; color:white;">Sequence</div></th>
								<th><div style="width:40%; color:white;">Transaction Name</div></th>
								<th><div style="width:10%; color:white;">Write</div></th>
								<th><div style="width:10%; color:white;">Email Approval</div></th>
								<th><div style="width:10%; color:white;">Email Vendor</div></th>
								<th><div style="width:10%; color:white;">Close</div></th>
								<th><div style="width:20%; color:white;">Action</div></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>

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
					<input type="hidden" id="id_transaction_role_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_transaction_role();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_employee">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Item Class</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_employee">
					<table class="table" id="list_employee">
						<thead>
							<tr>
								<th>Select</th>
								<th>Employee Number</th>
								<th>Employee Name</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_employee_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_employee_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var id_module = '<?php echo $result_file_name[0]->id_module; ?>';
	</script>
<!-- content-wrapper ends -->