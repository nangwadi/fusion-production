<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> Company</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new company</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Company</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Company ID</label>
						<input type="hidden" class="form-control" id="company_id" placeholder="Username">
						<input type="text" class="form-control" id="company_code" placeholder="Company ID">
					</div>
					<div class="form-group">
						<label>Company Name</label>
						<input type="text" class="form-control" id="company_name" placeholder="Company Name">
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" id="company_address" style="color:white; height: 80px;" placeholder="Address"></textarea>
					</div>
					<div class="form-group">
						<label>City</label>
						<input type="text" class="form-control" id="company_city" placeholder="City">
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Phone</label>
								<input type="text" class="form-control" id="company_phone" placeholder="City">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Fax</label>
								<input type="text" class="form-control" id="company_fax" placeholder="City">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Province / District</label>
						<input type="text" class="form-control" id="company_province" placeholder="Province / District">
					</div>
					<div class="form-group">
						<label>Country</label>
						<select class="form-control" id="company_country" style="color:white;">
	                    </select>
					</div>
					<div class="form-group">
						<label>Postal Code</label>
						<input type="number" class="form-control" id="company_postal_code" placeholder="Postal Code">
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_company();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Company</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_company">
						<thead>
							<tr>
								<th style="color:white;"><div style="width:5%;">No</div></th>
								<th style="color:white;"><div style="width:10%;">Company ID</div></th>
								<th style="color:white;"><div style="width:20%;">Company Name</div></th>
								<th style="color:white;"><div style="width:40%;">Address</div></th>
								<th style="color:white;"><div style="width:20%;">Country</div></th>
								<th style="color:white;"><div style="width:20%;">Phone</div></th>
								<th style="color:white;"><div style="width:20%;">Fax</div></th>
								<th style="color:white;"><div style="width:15%;">Action</div></th>
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
					<input type="hidden" id="company_id_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_company();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->