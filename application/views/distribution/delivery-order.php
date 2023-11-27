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
							<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;<?php echo $result_file_name[0]->module_name; ?></h4>
						</div>
						<div class="col-md-9">
							<button class="btn btn-secondary" onclick="refresh();" title="Add <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-library-plus"></i>&nbsp;&nbsp;Add</button>&nbsp;
							<button class="btn btn-primary" id="btn_save" onclick="save_transaction('<?php echo $id_module; ?>');" title="Save <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-content-save"></i>&nbsp;Save</button>&nbsp;
							<button class="btn btn-danger" id="btn_remove" onclick="remove();" title="Delete <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-delete-forever"></i>&nbsp;Delete</button>&nbsp;
							<button class="btn btn-light" onclick="print_delivery_order();" title="Print <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-printer"></i>&nbsp;Print</button>&nbsp;
							<button class="btn btn-info" onclick="list_delivery_order_detail();" title="List <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;List</button>
						</div>
					</div>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-4" style="padding-right: 50px;">
							<div class="row">
								<!-- <div class="col-md-12">
									<div class="row">
										<div class="col-md-4" style="padding-top:5px;">
											<label>SO Number</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" class="form-control" id="id_sales_order" value="">
											<input type="text" class="form-control" id="sales_order_number" placeholder="Sales Order Number" style="color:black; outline-color: 1px white solid;" readonly onclick="list_sales_order();">										
										</div>
									</div>
								</div> -->
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:5px;">
											<label>DO Number</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" class="form-control" id="id_delivery_order" value="">
											<input type="hidden" class="form-control" id="delivery_order_number_format" value="">
											<input type="text" class="form-control" id="delivery_order_number" placeholder="Delivery Order Number" style="color:black; outline-color: 1px white solid;" readonly onclick="list_delivery_order();">										
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											&nbsp;								
										</div>
										<div class="col-md-8">
											<input type="checkbox" id="hold" style="width: 18px; height: 18px;" checked="checked" onclick="hold_check();">&nbsp;&nbsp;&nbsp;Hold
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											<label>Status</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" id="id_transaction_role" value="1">
											<div id="transaction_name">Hold</div>										
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Date</label>										
										</div>
										<div class="col-md-8">
											<input type="date" class="form-control" id="delivery_order_date" placeholder="Receipt Date" style="color:white;" value="<?php echo date('Y-m-d') ?>">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Note</label>							
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="note" placeholder="Note" style="color:white;">								
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-5" style="padding-right: 50px;">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Customer</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" class="form-control" id="id_account" value="">						
											<input type="text" class="form-control" id="account_name" placeholder="Customer" style="color:black;" readonly onclick="list_account('0');">
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Delivery To</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" class="form-control" id="id_account_project" value="">						
											<input type="text" class="form-control" id="account_name_project" placeholder="Delivery To" style="color:black;" readonly onclick="list_account('1');">
											<input type="hidden" class="form-control" id="account_control" value="0">		
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Currency</label>				
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" id="id_coa_currency" placeholder="Currency" style="color:black;" readonly value="IDR">				
										</div>
										<div class="col-md-5">
											<input type="number" class="form-control" id="rate" placeholder="Rate" style="color:black; text-align:right;" readonly value="1">					
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Owner</label>					
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="delivery_order_owner" placeholder="Owner" style="color:black;" readonly value="<?php echo $cNmPegawai_session; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-4">
											<label>Total Line Shipment</label>
											<input type="number" class="form-control" id="total_line" placeholder="Total Line" style="color:black;" value="1" readonly>								
										</div>
										<div class="col-md-4">
											<label>Total Qty Shipment</label>						
											<input type="number" class="form-control" id="total_qty" placeholder="Total Qty" style="color:black;" value="0" readonly>								
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-3">
							<div class="row">
								
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Sub Amount</label>
										</div>
										<div class="col-md-8">
											<input type="number" class="form-control" id="sub_amount" placeholder="0" style="color:black; text-align: right;" readonly>	
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											<label>Discount Amount</label>
										</div>
										<div class="col-md-8">
											<input type="number" class="form-control" id="discount_amount" value="0" style="color:white; text-align: right;" onchange="discount_header_calculation();">	
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											<label>Amount</label>
										</div>
										<div class="col-md-8">
											<input type="number" class="form-control" id="amount" value="0" style="color:black; text-align: right;" readonly>	
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Tax (+)</label>
										</div>
										<div class="col-md-8">
											<input type="number" class="form-control" id="ppn" placeholder="0" style="color:black; text-align: right;" readonly>	
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Tax (-)</label>
										</div>
										<div class="col-md-8">
											<input type="number" class="form-control" id="pph" placeholder="0" style="color:black; text-align: right;" readonly>	
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Total Amount</label>
										</div>
										<div class="col-md-8">
											<input type="number" class="form-control" id="total_amount" placeholder="0" style="color:black; text-align: right;" readonly>	
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
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;<?php echo $result_file_name[0]->module_name; ?> Line</h4>
						</div>
						<div class="col-md-8">
							<button class="btn btn-primary" id="add_line" onclick="add_line();" title="Add Line <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-library-plus"></i>&nbsp;&nbsp;Add Item</button>
						</div>
					</div>
					<hr style="border:2px solid white;">
					<input type="hidden" id="line_use" value="1">
					<table class="stripe row-border order-column" id="line_description">
						<thead>
							<tr style="background-color: rgba(129, 129, 129, 1); height:50px;">
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 225px;">Sales Order</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 150px;">Job No</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 350px;">Description</div></th>
								<th><center><div style="width: 125px;">Qty Order</div></center></th>
								<th><center><div style="width: 125px;">Qty Delivery</div></center></th>
								<th><center><div style="width: 125px;">Qty Open</div></center></th>
								<th><center><div style="width: 100px;">UOM</div></center></th>
								<th><center><div style="width: 150px;">Unit Price</div></center></th>
								<th><center><div style="width: 150px;">Sub Amount</div></center></th>
								<th><center><div style="width: 150px;">Disc. Amount</div></center></th>
								<th><center><div style="width: 150px;">Disc. Percent</div></center></th>
								<th><center><div style="width: 150px;">Amount</div></center></th>
								<th><center><div style="width: 150px;">Tax Category</div></center></th>
								<th><center><div style="width: 150px;">COA</div></center></th>
								<th><center><div style="width: 225px;">COA Description</div></center></th>
								<th><center><div style="width: 225px;">Kit Assy</div></center></th>
								<th><center><div style="width: 100px;">Remove</div></center></th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_sales_order">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Sales Order</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_sales_order" value="0">
					<table class="table" id="list_sales_order">
						<thead>
							<tr>
								<th>Select</th>
								<th>Sales Order</th>
								<th>Vendor Name</th>
								<th>PO Date</th>
								<th>Total Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_sales_order_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_sales_order_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_delivery_order">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Purchase Receipt</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_delivery_order" value="0">
					<table class="table" id="list_delivery_order">
						<thead>
							<tr>
								<th>Select</th>
								<th>Purchase Receipt</th>
								<th>Vendor Name</th>
								<th>PR Date</th>
								<th>Total Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_delivery_order_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_delivery_order_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_account">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Customer</h4>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_sales_order_line">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Sales Order Line</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_delivery_order_line" value="0">
					<input type="hidden" id="no_sales_order_line" value="0">
					<table class="table" id="list_sales_order_line">
						<thead>
							<tr>
								<th style="width:15%;">Select</th>
								<th style="width:85%;">SO Number</th>
								<th style="width:85%;">Job No</th>
								<th style="width:85%;">Description</th>
								<th style="width:85%;">Qty</th>
								<th style="width:85%;">UOM</th>
								<th style="width:85%;">Unit Price</th>
								<th style="width:85%;">Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_sales_order_line_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_sales_order_line_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_kit_assy">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Kit Assy</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_kit_assy_delivery_order" value="0">
					<input type="hidden" id="no_kit_assy" value="0">
					<table class="table" id="list_kit_assy">
						<thead>
							<tr>
								<th>Select</th>
								<th>Kit Assy No</th>
								<th>Job No</th>
								<th>Job Name</th>
								<th>Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_kit_assy_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_kit_assy_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_delivery_order">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Delivery Order</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_delivery_order" value="0">
					<table class="table" id="list_delivery_order">
						<thead>
							<tr>
								<th>Select</th>
								<th>Delivery Order</th>
								<th>Customer Name</th>
								<th>SO Date</th>
								<th>Total Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_delivery_order_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_delivery_order_close();">Close</a>
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
		const id_sales_order_line_array = [];
	</script>
<!-- content-wrapper ends -->