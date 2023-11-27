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
							<button class="btn btn-light" onclick="print_sales_invoice();" title="Print <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-printer"></i>&nbsp;Print</button>&nbsp;
							<button class="btn btn-warning" onclick="release();" title="Posting <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-checkbox-marked-outline"></i>&nbsp;Posting</button>&nbsp;
							<button class="btn btn-info" onclick="list_sales_invoice_detail();" title="List <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;List</button>
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
											<input type="hidden" class="form-control" id="id_delivery_order" value="">
											<input type="text" class="form-control" id="delivery_order_number" placeholder="Delivery Order Number" style="color:black; outline-color: 1px white solid;" readonly onclick="list_delivery_order();">										
										</div>
									</div>
								</div> -->
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:5px;">
											<label>SI Number</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" class="form-control" id="id_sales_invoice" value="">
											<input type="hidden" class="form-control" id="sales_invoice_number_format" value="">
											<input type="text" class="form-control" id="sales_invoice_number" placeholder="Sales Invoice Number" style="color:black; outline-color: 1px white solid;" readonly onclick="list_sales_invoice();">										
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
											<input type="hidden" id="close_transaction">
											<div id="transaction_name">Hold</div>										
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Tax Number</label>										
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="tax_number" placeholder="Tax Number" style="color:white;">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Date</label>										
										</div>
										<div class="col-md-8">
											<input type="date" class="form-control" id="sales_invoice_date" placeholder="Invoice Date" style="color:white;" value="<?php echo date('Y-m-d') ?>">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Order Number</label>							
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="customer_order_number" placeholder="Customer Order Number" style="color:white;">								
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
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Payment Methode</label>										
										</div>
										<div class="col-md-8" style="padding-top:10px;">
											<select class="form-control" id="id_payment_methode" style="color:white;"></select>		
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Payment Terms</label>										
										</div>
										<div class="col-md-8" style="padding-top:10px;">
											<select class="form-control" id="id_payment_terms" style="color:white;"></select>		
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Owner</label>					
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="sales_invoice_owner" placeholder="Owner" style="color:black;" readonly value="<?php echo $cNmPegawai_session; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Sign By</label>					
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="cNIK_approval" placeholder="Sign By" style="color:black;" readonly onclick="list_approval_permission();">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4">
											&nbsp;
										</div>
										<div class="col-md-4">
											<label>Total Line Invoice</label>
											<input type="number" class="form-control" id="total_line" placeholder="Total Line" style="color:black;" value="1" readonly>								
										</div>
										<div class="col-md-4">
											<label>Total Qty Invoice</label>						
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
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 225px;">Delivery Order</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 150px;">Job No</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 350px;">Description</div></th>
								<th><center><div style="width: 125px;">Qty Shipment</div></center></th>
								<th><center><div style="width: 125px;">Qty Invoice</div></center></th>
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
								<th>Vendor Name</th>
								<th>PO Date</th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_sales_invoice">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Purchase Receipt</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_sales_invoice" value="0">
					<table class="table" id="list_sales_invoice">
						<thead>
							<tr>
								<th>Select</th>
								<th>Sales Invoice</th>
								<th>Customer</th>
								<th>Order No.</th>
								<th>Invoice Date</th>
								<th>Total Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_sales_invoice_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_sales_invoice_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_sub_tax">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Tax</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_sub_tax" value="0">
					<input type="hidden" id="no_line_sub_tax" value="0">
					<table class="table" id="list_sub_tax">
						<thead>
							<tr>
								<th>Select</th>
								<th>Tax ID</th>
								<th>Tax Name</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_sub_tax_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_sub_tax_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_coa">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Chart of Account</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_coa" value="0">
					<input type="hidden" id="no_line_coa" value="0">
					<table class="table" id="list_coa">
						<thead>
							<tr>
								<th>Select</th>
								<th>COA ID</th>
								<th>COA Name</th>
								<th>COA Class</th>
								<th>COA Type</th>
								<th>Currency</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_coa_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_coa_close();">Close</a>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_employee">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List of Signer</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="container">
						<input type="hidden" id="no_select_employee">
						<table class="table" id="list_employee">
							<thead>
								<tr>
									<th>Select</th>
									<th>Employee Number</th>
									<th>Employee Name</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_employee_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_employee_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_delivery_order_line">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Delivery Order Line</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_sales_invoice_line" value="0">
					<input type="hidden" id="no_delivery_order_line" value="0">
					<table class="table" id="list_delivery_order_line">
						<thead>
							<tr>
								<th style="width:15%;">Select</th>
								<th style="width:85%;">DO Number</th>
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
			        <a class="btn btn-primary" onClick="list_delivery_order_line_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_delivery_order_line_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_uom">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Unit of Measure</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="container card-body" style="width:75%;">
						<input type="hidden" id="no_select_uom" value="0">
						<input type="hidden" id="no_line_uom" value="0">
						<table class="table" id="list_uom">
							<thead>
								<tr>
									<th>Select</th>
									<th>UOM ID</th>
									<th>UOM Name</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_uom_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_uom_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<!-- <div class="modal" tabindex="-1" role="dialog" id="modal_sales_invoice">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Sales Invoice</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_sales_invoice" value="0">
					<table class="table" id="list_sales_invoice">
						<thead>
							<tr>
								<th>Select</th>
								<th>Sales Invoice</th>
								<th>Customer Name</th>
								<th>SO Date</th>
								<th>Total Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_sales_invoice_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_sales_invoice_close();">Close</a>
			    </div>
			</div>
		</div>
	</div> -->

	<script type="text/javascript">
		var id_module = '<?php echo $result_file_name[0]->id_module; ?>';
		let percent = 0;
		var transaction_number_db = '<?php echo $transaction_number; ?>';
		var transaction_number_format_db = '<?php echo $transaction_number_format; ?>';
		var cNmPegawai_session = '<?php echo $cNmPegawai_session; ?>';
		const id_delivery_order_line_array = [];
	</script>
<!-- content-wrapper ends -->