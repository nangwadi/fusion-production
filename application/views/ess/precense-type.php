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
				<li class="breadcrumb-item active" aria-current="page">create new precense_type</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Precense Type</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Precense Type ID</label>
						<input type="text" class="form-control" id="cIDAbsen" placeholder="Precense Type ID">
					</div>
					<div class="form-group">
						<label>Precense Type Name</label>
						<input type="text" class="form-control" id="cNmAbsen" placeholder="Precense Type Name">
					</div>
					<div class="form-group">
						<label>Note</label>
						<input type="text" class="form-control" id="Note" placeholder="Precense Type Name">
					</div>
					<div class="form-group">
						<label>Day Off</label>
						<select class="form-control" id="DayOff" style="color:white;">
	                    </select>
					</div>
					<div class="form-group">
						<label>Salary Deduction</label>
						<select class="form-control" id="PotongGaji" style="color:white;">
	                    </select>
					</div>
					<div class="form-group">
						<label>Color Marking</label>
						<input type="text" class="form-control" id="color_marking" placeholder="Precense Type Name">
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_precense_type();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Precense Type</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_precense_type">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Precense Type ID</th>
								<th style="color:white;">Precense Type Name</th>
								<th style="color:white;">Note</th>
								<th style="color:white;">Day Off</th>
								<th style="color:white;">Salary Deduction</th>
								<th style="color:white;">Color Marking</th>
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
					<input type="hidden" id="cIDAbsen_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_precense_type();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->