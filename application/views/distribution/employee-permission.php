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
				<li class="breadcrumb-item active" aria-current="page">create new Employee Permission</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Employee Permission - <?php echo $result_file_name[0]->module_name; ?></h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Select Employee</label>
						<input type="hidden" class="form-control" id="id_employee_permission" value="">
						<input type="text" class="form-control" id="cNmPegawai" placeholder="Employee" style="color:black;" readonly onclick="list_employee();">
					</div>
					
					<div class="col-md-12" style="padding-top:27px;">
						<button class="btn btn-primary me-2" onclick="add_employee_permission();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Employee Permission - <?php echo $result_file_name[0]->module_name; ?></h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_employee_permission">
						<thead>
							<tr>
								<th><div style="width:10%; color:white;">No</div></th>
								<th><div style="width:70%; color:white;">Employee</div></th>
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
					<input type="hidden" id="id_employee_permission_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_employee_permission();"></a>
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