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
				<li class="breadcrumb-item active" aria-current="page">create new Material</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Material</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Material ID</label>
						<input type="hidden" class="form-control" id="id_material" placeholder="Material ID">
						<input type="hidden" class="form-control" id="no" placeholder="Material ID">
						<input type="text" class="form-control" id="material_cd" placeholder="Material ID">
					</div>
					<div class="form-group">
						<label>Material Name</label>
						<input type="text" class="form-control" id="material_name" placeholder="Material Name">
					</div>
					<div class="form-group">
						<label>Vendor</label>
						<input type="text" class="form-control" id="id_account" placeholder="Vendor" style="color:black;" onclick="list_account();" readonly>
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_material();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Material</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_material">
						<thead>
							<tr>
								<th style="color:white; width: 10%;">No</th>
								<th style="color:white; width: 20%;">Material ID</th>
								<th style="color:white; width: 30%;">Material Name</th>
								<th style="color:white; width: 30%;">Vendor</th>
								<th style="color:white; width: 10%;">Action</th>
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
					<input type="hidden" id="id_material_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_material();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_account">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Unit of Measure</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_account" value="0">
					<table class="table" id="list_account">
						<thead>
							<tr>
								<th style="width:15%;">Select</th>
								<th style="width:85%;">Account CD</th>
								<th style="width:85%;">Account Name</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_account_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_account_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->