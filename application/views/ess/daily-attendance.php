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
				<li class="breadcrumb-item active" aria-current="page">create new Daily Attendance</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Select Employee</label>
								<select class="form-control" id="cNIK" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Select Shift</label>
								<select class="form-control" id="cShiftID" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Select Absen Type</label>
								<select class="form-control" id="cIDAbsen" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Date Start</label>
								<input type="date" class="form-control" id="dTglHdr_start" style="color:white;" value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Date End</label>
								<input type="date" class="form-control" id="dTglHdr_end" style="color:white;" value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group" style="padding-top:25px;">
								<button class="btn btn-primary me-2" onclick="search_attendance();"><i class="mdi mdi-calendar-check"></i>&nbsp;&nbsp;Search</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Daily Attendance</h4>
					<hr style="border:2px solid white;">
					<table class="table table-striped" id="list_daily_attendance">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Employee Name</th>
								<th style="color:white;">Date</th>
								<th style="color:white;">Sift</th>
								<th style="color:white;">Absen</th>
								<th style="color:white;">In</th>
								<th style="color:white;">Out</th>
								<th style="color:white;">OT Act</th>
								<th style="color:white;">OT Conv</th>
								<th style="color:white;">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- content-wrapper ends -->

	<div class="modal" tabindex="-1" role="dialog" id="modal_daily_attendance">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color:white; color: black;">
					<h5 class="modal-title" id="modal_title_absen"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" class="form-control" id="nomor">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Employee</label>
								<select class="form-control" id="cNIK_update" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Date</label>
								<input type="Date" class="form-control" id="dTglHdr_update">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Shift</label>
								<select class="form-control" id="cShiftID_update" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Absen</label>
								<select class="form-control" id="cIDAbsen_update" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label>In</label>
								<input type="text" maxlength="5" onkeypress="time_val('1');" class="form-control" id="dJamMsk_update">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label>Out</label>
								<input type="text" maxlength="5" onkeypress="time_val('2');" class="form-control" id="dJamPlg_update">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" id="modal_footer_disen" style="background-color:white; color: black;" align="right">
					<div id="loading_update"></div>
			        <a class="btn btn-primary" id="btn_disen" onClick="update_daily_attendance();">Update</a>
			        <a class="btn btn-secondary" onClick="modal_daily_attendance_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>