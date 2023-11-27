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
						<div class="col-md-10">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;&nbsp;<?php echo $title; ?></h4>
						</div>
						<div class="col-md-2">
							<input type="month" class="form-control" id="transaction_periode" value="<?php echo date('Y-m'); ?>" onchange="list_transaction();">
						</div>
					</div>

					<hr style="border:2px solid white;">

					<input type="hidden" id="line_use" value="1">
					<table class="stripe row-border order-column" id="list_transaction" style="width:100%;">
						<thead>
							<tr style="background-color: rgba(129, 129, 129, 1); height:50px;">
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center>No</center></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 200px;">Vendor Name</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 200px;">Trans. No.</div></th>
								<th><center><div style="width: 125px;">Count of PI</div></center></th>
								<th><center><div style="width: 150px;">Amount</div></center></th>
								<th><center><div style="width: 150px;">Tax (+)</div></center></th>
								<th><center><div style="width: 150px;">Tax (-)</div></center></th>
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
		var transaction_periode_default = '<?php echo date('Y-m'); ?>';
	</script>
<!-- content-wrapper ends -->