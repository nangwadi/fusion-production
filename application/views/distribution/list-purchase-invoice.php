<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }

	.bottom_border_only {
	    border:none;
	    border-bottom: 1px solid #1890ff;
	    background-color: transparent;
	    color: white;
	    outline: none;
	    width: 90%;
	 }

	[placeholder]:focus::-webkit-input-placeholder {
	    transition: text-indent 0.4s 0.4s ease; 
	    text-indent: -100%;
	    color: white;
	    opacity: 1;
	 }
</style>

<div class="content-wrapper">
	<div class="row">

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List <?php echo $result_file_name[0]->module_name; ?></h4>
						</div>
						<div class="col-md-2">&nbsp;</div>
						<div class="col-md-7">
							<div class="row">
								<div class="col-md-4">
									<label>Selece Date Start</label>
									<input type="date" id="date_start" class="form-control">
								</div>
								<div class="col-md-4">
									<label>Selece Date End</label>
									<input type="date" id="date_end" class="form-control">
								</div>
								<div class="col-md-4" style="padding-top:25px;">
									<button class="btn btn-primary" onclick="search_transaction();"><i class="mdi mdi-file-find"></i>&nbsp;Search</button>
									&nbsp;&nbsp;
									<button class="btn btn-warning" onclick="location.reload(true);"><i class="mdi mdi-refresh"></i>&nbsp;Refresh</button>
								</div>
							</div>
						</div>
					</div>
					<hr style="border:2px solid white;">
					<input type="hidden" id="line_use" value="1">
					<table class="stripe row-border order-column" id="list_purchase_invoice">
						<thead>
							<tr style="background-color: rgba(129, 129, 129, 1); height:50px;">
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 75px;">No</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 200px;"><?php echo $result_file_name[0]->module_name; ?></div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 250px;">Vendor Name</div></center></th>
								<th><center><div style="width: 125px;">Date</div></center></th>
								<th><center><div style="width: 125px;">Status</div></center></th>
								<th><div style="width: 75px;" align="right">Qty Order</div></th>
								<th><div style="width: 200px;" align="right">Sub Amount</div></th>
								<th><div style="width: 150px;" align="right">Discount Amount</div></th>
								<th><div style="width: 150px;" align="right">Tax (+)</div></th>
								<th><div style="width: 150px;" align="right">Tax (-)</div></th>
								<th><div style="width: 200px;" align="right">Amount</div></th>
								<th><div style="width: 200px;" align="center">Purchase Order</div></th>
								<th><div style="width: 200px;" align="center">Purchase Receipt</div></th>
							</tr>
						</thead>
						<!-- <tbody></tbody> -->
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
					<input type="hidden" id="id_employee_permission_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_employee_permission();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var id_module = '<?php echo $result_file_name[0]->id_module; ?>';
		let percent = 0;
		var transaction_number = '<?php echo $transaction_number; ?>';
	</script>
<!-- content-wrapper ends -->