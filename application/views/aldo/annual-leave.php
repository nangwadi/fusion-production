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
				<li class="breadcrumb-item"><a href="#">aldo</a></li>
				<li class="breadcrumb-item active" aria-current="page">create Annual Leave</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-1">
							<label>Select Year</label>
							<input type="hidden" class="form-control" id="id_cuti_master" value="">
							<input type="hidden" class="form-control" id="no" value="">
							<input type="hidden" class="form-control" id="annual_leave_used" value="">
							<select class="form-control" id="year" style="color:white;" onchange="list_annual_leave(0, 0);"></select>
						</div>
						<div class="col-md-3">
							<label>Select Emplyoyee</label>
							<select class="form-control" id="cNIK" style="color:white;"></select>
						</div>
						<div class="col-md-2">
							<label>Annual Leave</label>
							<input type="number" class="form-control" id="total" style="color:white;">
						</div>
						<div class="col-md-2">
							<label>Mass Leave</label>
							<input type="number" class="form-control" id="cuti_bsm" style="color:white;">
						</div>
						<div class="col-md-2">
							<label>Date Start</label>
							<input type="date" class="form-control" id="dTglBerlaku_Dari" style="color:white;">
						</div>
						<div class="col-md-2" style="padding-top:25px;">
							<button class="btn btn-primary" onclick="add_annual_leave();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>&nbsp;&nbsp;
							<button class="btn btn-warning" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Annual Leave</h4>
					<hr style="border:2px solid white;">
					<table class="table table-striped" id="list_annual_leave">
						<thead>
							<tr>
								<th style="color:white;"><div align="center">No</div></th>
								<th style="color:white;">Year</th>
								<th style="color:white;">Employee Name / ID</th>
								<th style="color:white;">Department</th>
								<th style="color:white;"><div align="center">Date Start</div></th>
								<th style="color:white;"><div align="center">Annual Leave</div></th>
								<th style="color:white;"><div align="center">Mass Leave</div></th>
								<th style="color:white;"><div align="center">Used Leave</div></th>
								<th style="color:white;"><div align="center">Remain</div></th>
								<th style="color:white;"><div align="center">Action</div></th>
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

	<script type="text/javascript">
		var this_year = '<?php echo date('Y'); ?>';
		var next_year = '<?php echo date('Y')+5; ?>';
		var prev_year = '<?php echo date('Y')-5; ?>';
		var cIDDept = '<?php echo $cIDDept_session; ?>';
    	var cIDBag = '<?php echo $cIDBag_session; ?>';
	</script>
<!-- content-wrapper ends -->