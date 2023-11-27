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
						<div class="col-md-4">
							<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;<?php echo $result_file_name[0]->module_name; ?></h4>
						</div>
						<div class="col-md-8" align="right">
							<!-- <button class="btn btn-secondary" onclick="refresh();" title="Add <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-library-plus"></i>&nbsp;&nbsp;Add</button>&nbsp;
							<button class="btn btn-primary" id="btn_save" onclick="save_transaction('<?php echo $id_module; ?>');" title="Save <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-content-save"></i>&nbsp;Save</button>&nbsp; -->
							<!-- <button class="btn btn-success" onclick="add_employee_permission();" title="Copy <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-content-copy"></i>&nbsp;Copy</button>&nbsp; -->
							<!-- <button class="btn btn-danger" id="btn_remove" onclick="remove();" title="Delete <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-delete-forever"></i>&nbsp;Delete</button>&nbsp; -->
							<!-- <button class="btn btn-success" id="btn_invoice" onclick="receipt();" title="Vendor Payment <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-receipt"></i>&nbsp;Receipt</button>&nbsp;
							<button class="btn btn-light" id="btn_request_release" onclick="request_release();" title="Request Release <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-email-outline"></i>&nbsp;Request Release</button>&nbsp; -->
							<!-- <button class="btn btn-warning" id="btn_release" onclick="release();" title="Release <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-checkbox-marked-outline"></i>&nbsp;Posting</button>&nbsp; -->
							<!-- <button class="btn btn-primary" id="btn_transaction_number" onclick="create_transaction_number();" title="Create Vendor Payment <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-receipt"></i>&nbsp;Vendor Payment</button>&nbsp; -->
							<!-- <button class="btn btn-light" onclick="print_transaction_number();" title="Print <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-printer"></i>&nbsp;Print</button>&nbsp; -->
							<button class="btn btn-info" onclick="list_transaction_list();" title="List <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;List</button>
						</div>
					</div>

					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-4" style="padding-right: 50px;">
							<div class="row">
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											<label>Payment Number</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" class="form-control" id="id_transaction" value="">
											<input type="text" class="form-control" id="transaction_number" placeholder="Vendor Payment Number" style="color:black; outline-color: 1px white solid;" readonly onclick="list_transaction();">										
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											<label>Vendor</label>										
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="account_name" placeholder="Vendor" style="color:black;" readonly onclick="list_account();">								
										</div>
									</div>
								</div>								
							</div>
						</div>
						<div class="col-md-4" style="padding-right: 50px;">
							<div class="row">
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											<label>Invoice Total Line</label>										
										</div>
										<div class="col-md-3">
											<input type="number" class="form-control" id="total_line" placeholder="Total Line" style="color:black;" value="0" readonly>									
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List of Purchase Invoice</h4>
						</div>
						<div class="col-md-8" align="right">
							<!-- <button class="btn btn-primary" onclick="list_transaction_line();"><i class="mdi mdi-open-in-new"></i>&nbsp;Open Purchase Receipt Line</button> -->
							<!-- <button class="btn btn-success" onclick="list_transaction_line();"><i class="mdi mdi-open-in-new"></i>&nbsp;Open Receipt Line</button> -->
						</div>
					</div>
					<hr style="border:2px solid white;">
					<input type="hidden" id="line_use" value="1">
					<table class="stripe row-border order-column" id="line_description" style="width:100%;">
						<thead>
							<tr style="background-color: rgba(129, 129, 129, 1); height:50px;">
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 50px;"><i class="mdi mdi-delete-forever"></i></div></center></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 200px;">PI No.</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 200px;">Vendor Inv</div></th>
								<th><center><div style="width: 125px;">Amount Paid</div></center></th>
								<th><center><div style="width: 125px;">Tax (+)</div></center></th>
								<th><center><div style="width: 125px;">Tax (-)</div></center></th>
								<th><center><div style="width: 75px;">Currency</div></center></th>
								<th><center><div style="width: 100px;">Payment Date</div></center></th>
								<th><center><div style="width: 250px;">Cash Account</div></center></th>
								<th><center><div style="width: 100px;">Save</div></center></th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_transaction">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Transaction</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_transaction" value="0">
					<table class="table" id="list_transaction">
						<thead>
							<tr>
								<th>Select</th>
								<th>Transaction No.</th>
								<th>Vendor Name</th>
								<th>Periode</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_transaction_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_transaction_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_transaction_line">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Purchase Receipt</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_transaction_line" value="0">
					<table class="table" id="list_transaction_line">
						<thead>
							<tr>
								<th>Select</th>
								<th>Purchase Receipt</th>
								<th>PR Date</th>
								<th>Description</th>
								<th>Qty</th>
								<th>UOM</th>
								<th>Unit Price</th>
								<th>Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_transaction_line_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_transaction_line_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_transaction_number">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Purchase Inovice</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_transaction_number" value="0">
					<table class="table" id="list_transaction">
						<thead>
							<tr>
								<th>Select</th>
								<th>Transaction No.</th>
								<th>Vendor Name</th>
								<th>Periode</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_transaction_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_transaction_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var id_module = '<?php echo $result_file_name[0]->id_module; ?>';
		let percent = 0;
		var transaction_number_db = '<?php echo $transaction_number; ?>';
		var transaction_number_format_db = '<?php echo $transaction_number_format; ?>';
		var cNmPegawai_session = '<?php echo $cNmPegawai_session; ?>';
		const id_transaction_line_array = [];
		const purchase_order_number_array = [];
	</script>
<!-- content-wrapper ends -->