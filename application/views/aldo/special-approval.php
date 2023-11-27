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
				<li class="breadcrumb-item active" aria-current="page">create new Special Approval</li>
			</ol>
		</nav>
	</div>
	<div class="row">

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div onclick="add_approval_show();"><h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Special Approval</h4></div>
					<hr style="border:2px solid white;">
					<div id="add_approval" style="display:block;">
						<div class="row">
							<div class="col-md-3">
								<label>Select Employee</label>
								<select class="form-control" id="cNIK" style="color:white;"></select>
							</div>
							<div class="col-md-3" style="padding-top:25px;">
								<button class="btn btn-primary me-2" onclick="add_special_approval();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Special Approval</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_special_approval">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Employee ID</th>
								<th style="color:white;">Employee Name</th>
								<th style="color:white;">Delete</th>
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
					<input type="hidden" id="cIDBag_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_special_approval();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->