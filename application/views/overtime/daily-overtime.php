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
				<li class="breadcrumb-item"><a href="#">Overtime</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new approval</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4" style="padding-top:25px;">
							<?php
								$jam_sekarang = date('H:i');
								if ($category==1) {
									if (strtotime($jam_sekarang) <= strtotime($daily_maker)) {
										?>
											<button class="btn btn-primary" onclick="modal_add_overtime();"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Daily Overtime</button>
										<?php
									}
								}
								else if ($category==2) {
									if (strtotime($jam_sekarang) <= strtotime($daily_maker)) {
										?>
											<button class="btn btn-primary" onclick="modal_add_overtime();"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Daily Overtime</button>
										<?php
									}
									if (strtotime($jam_sekarang) <= strtotime($daily_approval)) {
										?>
											<button class="btn btn-info" onclick="modal_approve_overtime();"><i class="mdi mdi-account-check "></i>&nbsp;&nbsp;Approve Daily Overtime</button>
										<?php
									}
								}
								else if ($category==3) {
									?>
									<button class="btn btn-primary" onclick="modal_add_overtime();"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Daily Overtime</button>
									&nbsp;&nbsp;
									<button class="btn btn-info" onclick="modal_approve_overtime();"><i class="mdi mdi-account-check "></i>&nbsp;&nbsp;Approve Daily Overtime</button>
									<?php
								}
							?>
						</div>
						<?php
							if ($category==3) {
								?>
								<div class="col-md-2">&nbsp;</div>
								<div class="col-md-1">
									<label>Plant 1</label>
									<input type="number" id="plant_1" class="form-control">
								</div>
								<div class="col-md-1">
									<label>Plant 2</label>
									<input type="number" id="plant_2" class="form-control">
								</div>
								<div class="col-md-1">
									<label>Driver</label>
									<input type="number" id="driver" class="form-control">
								</div>
								<div class="col-md-1">
									<label>Total</label>
									<input type="number" id="total" class="form-control">
								</div>
								<div class="col-md-2" style="padding-top:25px;">
									<button class="btn btn-success" onclick="add_catering();"><i class="mdi mdi-account-check "></i>&nbsp;&nbsp;Order Catering</button>
								</div>
								<?php
							}
						?>
						
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Daily Overtime</h4>
					<hr style="border:2px solid white;">
					<table class="table table-striped" id="list_daily_overtime">
						<thead>
							<tr>
								<th style="color:white;"><div align="center">No</div></th>
								<th style="color:white;">Date</th>
								<th style="color:white;">Employee Name</th>
								<th style="color:white;">Department</th>
								<th style="color:white;">Division</th>
								<th style="color:white;">Job</th>
								<th style="color:white;"><div align="center">Catering</div></th>
								<th style="color:white;"><div align="center">Approve</div></th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_disen">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div id="modal_header_disen">
					<h5 class="modal-title" id="modal_title_disen"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="cIDDept_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_maker();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_add_overtime">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h5 class="modal-title">Add Daily Overtime</h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="total_line_add">
					<table class="table table-striped" id="list_maker">
						<thead>
							<tr>
								<th><div align="center">No</div></th>
								<th>Employee Name / ID</th>
								<th>Department</th>
								<th>Job</th>
								<th><div align="center">Overtime</div></th>
								<th><div align="center">Catering</div></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" id="btn_disen" onClick="add_daily_overtime();">Add Overtime</a>
			        <a class="btn btn-secondary" onClick="modal_add_overtime_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_approve_overtime">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h5 class="modal-title">Approve Daily Overtime</h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="total_line_approve">
					<table class="table table-striped" id="list_approval" style="color: black;">
						<thead>
							<tr>
								<th><div align="center">No</div></th>
								<th>Employee Name / ID</th>
								<th>Department</th>
								<th>Job</th>
								<th><div align="center">Catering</div></th>
								<th><div align="center">Approve<br><input type="checkbox" id="approve_all" style="width:25px; height:25px;" onclick="approve_all();"></div></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="approve_overtime();">Approve</a>
			        <a class="btn btn-secondary" onClick="modal_approve_overtime_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var category = '<?php echo $category; ?>';
		var cIDDept = '<?php echo $cIDDept_session; ?>';
    	var cIDBag = '<?php echo $cIDBag_session; ?>';
    	var daily_maker = '<?php echo $daily_maker; ?>';
		var daily_approval = '<?php echo $daily_approval; ?>';
		var holiday_maker = '<?php echo $holiday_maker; ?>';
		var holiday_approval = '<?php echo $holiday_approval; ?>';
	</script>
<!-- content-wrapper ends -->