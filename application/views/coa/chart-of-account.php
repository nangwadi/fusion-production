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
				<li class="breadcrumb-item active" aria-current="page">create new Chart of Account</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Chart of Account</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>COA Number</label>
						<input type="hidden" class="form-control" id="id_coa" placeholder="COA Number">
						<input type="hidden" class="form-control" id="no" placeholder="COA Number">
						<input type="text" class="form-control" id="coa_cd" placeholder="COA Number">
					</div>
					<div class="form-group">
						<label>COA Name</label>
						<input type="text" class="form-control" id="coa_name" placeholder="COA Name">
					</div>
					<div class="form-group">
						<label>COA Class</label>
						<select class="form-control" id="id_coa_classes" style="color:white;"></select>
					</div>
					<div class="form-group">
						<label>Currency</label>
						<select class="form-control" id="id_coa_currency" style="color:white;"></select>
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_coa();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-9 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Chart of Account</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_coa">
						<thead>
							<tr>
								<th style="color:white; width: 7.5%;">No</th>
								<th style="color:white; width: 15%;">COA Number</th>
								<th style="color:white; width: 25%;">COA Name</th>
								<th style="color:white; width: 25%;">COA Class</th>
								<th style="color:white; width: 10%;">COA Type</th>
								<th style="color:white; width: 7.5%;">Currency</th>
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
					<input type="hidden" id="id_coa_disen">
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_bank_account">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header bg-success text-white">
					<h5 class="modal-title" id="modal_title_bank_account"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="id_coa_bank">
					<input type="hidden" id="id_coa">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Currency</label>
								<input type="text" class="form-control" id="id_coa_currency_bank" placeholder="Currency" list="list_currency">
								<datalist id="list_currency"></datalist>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Bank Name</label>
								<input type="text" class="form-control" id="cIDBank" placeholder="Bank Name" list="list_bank">
								<datalist id="list_bank"></datalist>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Bank Account Number</label>
								<input type="text" class="form-control" id="bank_account_no" placeholder="Bank Account Number">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Bank Account Name</label>
								<input type="text" class="form-control" id="bank_account_name" placeholder="Bank Account Name">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Bank Account Branch</label>
								<input type="text" class="form-control" id="bank_account_branch" placeholder="Bank Account Branch">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Bank Account Address</label>
								<input type="text" class="form-control" id="bank_account_address" placeholder="Bank Account Address">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Virtual Account</label>
								<input type="text" class="form-control" id="bank_account_va" placeholder="Virtual Account">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer bg-success">
			        <a class="btn btn-primary" onClick="add_bank();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</a>
			        <a class="btn btn-secondary" onClick="add_bank_close();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->