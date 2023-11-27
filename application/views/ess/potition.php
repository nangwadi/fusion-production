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
				<li class="breadcrumb-item active" aria-current="page">create new position</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Position</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Potition ID (Auto Generate)</label>
						<input type="text" class="form-control" id="cIDJbtn" placeholder="Potition ID" readonly>
					</div>
					<div class="form-group">
						<label>Potition Name</label>
						<input type="text" class="form-control" id="cNmJbtn" placeholder="Potition Name">
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_potition();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Position</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_potition">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Potition ID</th>
								<th style="color:white;">Potition Name</th>
								<!-- <th style="color:white;" colspan="3"><div align="center">Limit of Medical</div></th> -->
								<th style="color:white;">Action</th>
							</tr>
							<!-- <tr>
								<th style="color:white;">Employee</th>
								<th style="color:white;">Wife</th>
								<th style="color:white;">Child</th>
							</tr> -->
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
					<input type="hidden" id="cIDJbtn_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_potition();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" id="modal_medical" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color:white; color: black;">
					<h5 class="modal-title" id="exampleModalLabel">Update Limit of Medical Reimbursment by Potition</h5>
					<button class="close" onclick="update_nominal_close();">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body" style="background-color:white; color: black;">
					<input type="hidden" id="cIDJbtn_medical">
					<div class="form-group">
						<label>Potition</label>
						<input type="text" id="cNmJbtn_medical" class="form-control" style="color:black;" readonly>
					</div>
					<div class="form-group">
						<label>Nominal Employee</label>
						<input type="number" id="nominal" class="form-control" style="color: white;">
					</div>
					<div class="form-group">
						<label>Nominal Wife</label>
						<input type="number" id="nominal_istri" class="form-control" style="color: white;">
					</div>
					<div class="form-group">
						<label>Nominal Child</label>
						<input type="number" id="nominal_anak" class="form-control" style="color: white;">
					</div>
				</div>
				<div class="modal-footer" style="background-color:white; color: black;">
					<button class="btn btn-primary" onclick="save_medical();">Save changes</button>
				</div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->