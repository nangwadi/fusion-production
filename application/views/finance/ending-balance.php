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
				<li class="breadcrumb-item active" aria-current="page">create new Cash Account</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Adjust Cash Account</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Cash Account</label>
						<input type="hidden" class="form-control" id="id_balance" placeholder="Last Saldo">
						<select class="form-control" id="id_cash_account" style="color:white;"></select>
					</div>
					<div class="form-group">
						<label>Transaction Periode</label>
						<input type="month" class="form-control" id="transaction_periode" value="<?php echo date('Y-m'); ?>">
					</div>
					<div class="form-group">
						<label>Begin balance</label>
						<input type="number" class="form-control" id="begin_balance" placeholder="Last Saldo">
					</div>
					<div class="form-group">
						<label>Total Debet</label>
						<input type="number" class="form-control" id="total_debet" placeholder="Last Saldo">
					</div>
					<div class="form-group">
						<label>Total Credit</label>
						<input type="number" class="form-control" id="total_credit" placeholder="Last Saldo">
					</div>
					<div class="form-group">
						<label>Ending Balance</label>
						<input type="number" class="form-control" id="ending_balance" placeholder="Last Saldo">
					</div>
					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_balance();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-9 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-9">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;Balance of Cash Account</h4>
						</div>
						<div class="col-md-3">
							<label>Input Transaction Periode</label>
							<input type="month" class="form-control" id="transaction_periode_search" value="<?php echo date('Y-m'); ?>">
						</div>
					</div>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_balance">
						<thead>
							<tr>
								<th style="color:white; width: 10%;">No</th>
								<th style="color:white; width: 10%;">Cash Account</th>
								<th style="color:white; width: 10%;">Periode</th>
								<th style="color:white; width: 10%;">Begin</th>
								<th style="color:white; width: 20%;">Debet</th>
								<th style="color:white; width: 15%;">Credit</th>
								<th style="color:white; width: 10%;">Ending</th>
								<th style="color:white; width: 15%;">Action</th>
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
					<input type="hidden" id="id_cash_account_disen">
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

	<script>
		var transaction_periode_default = '<?php echo date('Y-m'); ?>';
	</script>
<!-- content-wrapper ends -->