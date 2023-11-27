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
				<li class="breadcrumb-item active" aria-current="page">create new Shift Group</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Shift Group</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Shift Group ID</label>
						<input type="text" class="form-control" id="cGroupID" placeholder="Shift Group ID">
					</div>
					<div class="form-group">
						<label>Shift Group Name</label>
						<input type="text" class="form-control" id="cGroupNm" placeholder="Shift Group Name">
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_sift_group();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-6">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Shift Group</h4>
						</div>
						<div class="col-md-6" align="right">
							<h4 class="card-title"><button class="btn btn-primary" onclick="modal_create_calendar();"><i class="mdi mdi-calendar"></i>&nbsp;&nbsp;Create Calendar</button></h4>
						</div>
					</div>
					
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_sift_group">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Sift Group ID</th>
								<th style="color:white;">Sift Group Name</th>
								<th style="color:white;">Work Calendar</th>
								<th style="color:white;">Action</th>
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
					<input type="hidden" id="cGroupID_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_sift_group();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_work_calendar">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color:white;">
					<h5 class="modal-title" id="modal_title_work_calendar"  style="color:black;"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="cGroupID_work">
					<div class="row">
						<div class="col-md-6">
							<label>Select Year</label>
							<select class="form-control form-control-sm" id="year_work" style="color:white;">
								<?php
									for ($i=date('Y')-3; $i < date('Y')+3; $i++) { 
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php 
									}
								?>
							</select>
						</div>
						<div class="col-md-6" style="padding-top:25px;">
							<button class="btn btn-primary" onclick="open_calendar();"><i class="mdi mdi-calendar"></i>&nbsp;&nbsp;Open Calendar</button>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color:white;">
			        <a class="btn btn-secondary" onClick="modal_work_calendar_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" id="modal_create_calendar">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color:white;">
					<h5 class="modal-title" style="color:black;">Create New Calendar</h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-6">
							<label>Select Year</label>
							<select class="form-control form-control-sm" id="year_create" style="color:white;">
								<?php
									for ($i=date('Y')-3; $i < date('Y')+3; $i++) { 
										?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
										<?php 
									}
								?>
							</select>
						</div>
						<div class="col-md-6">
							<label>Select Sift Group</label>
							<select class="form-control form-control-sm" id="cGroupID_create" style="color:white;"></select>
						</div>
						<div class="col-md-6" style="padding-top:20px;">
							<label>Select Sift Default</label>
							<select class="form-control form-control-sm" id="cShiftID_create" style="color:white;"></select>
						</div>
						<div class="col-md-6" style="padding-top:20px;">
							<label>Select Sift Absen</label>
							<select class="form-control form-control-sm" id="cShiftID_create_absen" style="color:white;"></select>
						</div>
						<div class="col-md-6" style="padding-top:20px;">
							<label>Select Absen</label>
							<select class="form-control form-control-sm" id="cIDAbsen_create_absen" style="color:white;"></select>
						</div>
						<div class="col-md-6" style="padding-top:20px;">
							<label>Select Holiday</label>
							<select class="form-control form-control-sm" id="cIDAbsen_create_holiday" style="color:white;"></select>
						</div>
						<!-- <div class="col-md-6" style="padding-top:20px;">
							<button class="btn btn-primary" onclick="create_calendar();"><i class="mdi mdi-calendar"></i>&nbsp;&nbsp;Create Calendar</button>
						</div> -->
					</div>
				</div>
				<div class="modal-footer" style="background-color:white;">
					<button class="btn btn-primary" onclick="create_calendar();"><i class="mdi mdi-calendar"></i>&nbsp;&nbsp;Create Calendar</button>&nbsp;&nbsp;
			        <a class="btn btn-secondary" onClick="modal_create_calendar_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->