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
				<li class="breadcrumb-item active" aria-current="page">create new Shift</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Shift</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Sift ID</label>
						<input type="text" class="form-control" id="cShiftID" placeholder="Sift ID">
					</div>
					<div class="form-group">
						<label>Sift Name</label>
						<input type="text" class="form-control" id="cNmShift" placeholder="Sift Name">
					</div>
					
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>OT 1</label>
								<input type="number" class="form-control" id="x1" placeholder="OT 1" min="0">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>OT 2</label>
								<input type="number" class="form-control" id="x2" placeholder="OT 2" min="0">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>OT 3</label>
								<input type="number" class="form-control" id="x3" placeholder="OT 3" min="0">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>OT 4</label>
								<input type="number" class="form-control" id="x4" placeholder="OT 4" min="0">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Color Marking</label>
								<input type="text" class="form-control" id="color_marking" placeholder="Precense Type Name">
							</div>
						</div>
						<div class="col-md-6" style="padding-top:25px;">
							<div class="form-group">
								<input type="checkbox" style="width:20px; height: 20px;" id="holiday_overtime">&nbsp;&nbsp;
								<label>Holiday Overtime</label>
							</div>
						</div>
					</div>
					
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_sift();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Shift</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_sift">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Sift ID</th>
								<th style="color:white;">Sift Name</th>
								<th style="color:white;">Holiday OT</th>
								<th style="color:white;">OT x1</th>
								<th style="color:white;">OT x2</th>
								<th style="color:white;">OT x3</th>
								<th style="color:white;">OT x4</th>
								<th style="color:white;">Color Marking</th>
								<th style="color:white;">Schedule</th>
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
					<input type="hidden" id="cShiftID_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_sift();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_sift_time">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div id="modal_header_sift_time">
					<h5 class="modal-title" id="modal_title_sift_time"></h5>
					<button id="loading_sift_time" style="display:none;">
						<div id="loading_sift_time_value"></div>
			        </button>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="cShiftID_sift_time">
					<table class="table table-striped" id="list_sift_time">
						<thead>
							<tr>
								<th>Day</th>
								<th>IN</th>
								<th>OUT</th>
								<th>Rest 1 Start</th>
								<th>Rest 1 End</th>
								<th>Rest 2 Start</th>
								<th>Rest 2 End</th>
								<th>Rest 3 Start</th>
								<th>Rest 3 End</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<div id="modal_footer_sift_time">
			        <a class="btn btn-primary" id="btn_sift_time" onClick="update_sift_time();">Save</a>
			        <a class="btn btn-secondary" onClick="sift_time_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->