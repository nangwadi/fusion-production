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
				<li class="breadcrumb-item active" aria-current="page">create new Currency</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Currency</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Currency ID</label>
						<input type="hidden" class="form-control" id="id_coa_currency" placeholder="Currency ID">
						<input type="text" class="form-control" id="coa_currency_cd" placeholder="Currency ID">
					</div>
					<div class="form-group">
						<label>Currency Name</label>
						<input type="text" class="form-control" id="coa_currency_name" placeholder="Currency Name">
					</div>
					<div class="form-group">
						<label>Length Decimal</label>
						<input type="number" class="form-control" id="decimal_after" placeholder="Length Decimal">
					</div>
					<div class="form-group">
						<label>Set Default</label><br>
						<input type="checkbox" id="set_default" style="width:25px; height:25px;">
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_coa();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Currency</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_coa">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Currency ID</th>
								<th style="color:white;">Currency Name</th>
								<th style="color:white;">Length Decimal</th>
								<th style="color:white;">Default</th>
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
					<input type="hidden" id="id_coa_currency_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_coa();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->