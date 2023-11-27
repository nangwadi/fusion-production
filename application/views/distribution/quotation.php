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
						<div class="col-md-8">
							<button class="btn btn-secondary" onclick="refresh();" title="Add <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-library-plus"></i>&nbsp;&nbsp;Add</button>&nbsp;&nbsp;
							<button class="btn btn-primary" id="btn_save" onclick="save_transaction('<?php echo $id_module; ?>');" title="Save <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>&nbsp;&nbsp;
							<button class="btn btn-success" id="btn_copy_transaction" onclick="copy_transaction();" title="Copy <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-content-copy"></i>&nbsp;&nbsp;Copy</button>&nbsp;&nbsp;
							<button class="btn btn-danger" id="btn_remove" onclick="remove();" title="Delete <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-delete-forever"></i>&nbsp;&nbsp;Delete</button>&nbsp;&nbsp;
							<button class="btn btn-light" id="btn_approve" onclick="print_purchase_order();" title="List Approve <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-printer"></i>&nbsp;&nbsp;Print</button>
							<button class="btn btn-info" onclick="list_purchase_order_detail();" title="List <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;&nbsp;List</button>
						</div>
					</div>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-4" style="padding-right: 50px;">
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-4" style="padding-top:10px;">
											<label>Order Number</label>										
										</div>
										<div class="col-md-8">
											<input type="hidden" class="form-control" id="id_purchase_order" value="">
											<input type="hidden" class="form-control" id="purchase_order_number_format" value="">
											<input type="text" class="form-control" id="purchase_order_number" placeholder="Order Number" style="color:black; outline-color: 1px white solid;" readonly onclick="list_purchase_order();">										
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
											<input type="date" class="form-control" id="purchase_order_date" placeholder="Order Date" style="color:white;" value="<?php echo date('Y-m-d') ?>">
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
								<div class="col-md-12" style="padding-top:10px;">
									<hr style="border: white 2px solid;">
									<div class="row">
										<div class="col-md-4">
											<label>Part List</label><br>
											<input type="checkbox" id="bom" style="width: 25px; height:25px;">	
										</div>
										<div class="col-md-4">
											<label>Total Line</label>
											<input type="number" class="form-control" id="total_line" placeholder="Total Line" style="color:black;" value="1" readonly>								
										</div>
										<div class="col-md-4">
											<label>Total Qty</label>						
											<input type="number" class="form-control" id="total_qty" placeholder="Total Qty" style="color:black;" value="0" readonly>								
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
											<label>Vendor</label>										
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="id_account" placeholder="Vendor" style="color:black;" readonly onclick="list_account();">								
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Vendor Qt Number:</label>			
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="vendor_quotation_number" placeholder="Vendor Quotation Number:" style="color:white;">								
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Currency</label>				
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control" id="id_coa_currency" placeholder="Currency" style="color:black;" readonly value="IDR">				
										</div>
										<div class="col-md-5">
											<input type="number" class="form-control" id="rate" placeholder="Rate" style="color:white; text-align:right;" value="1">					
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Owner</label>					
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="purchase_order_owner" placeholder="Owner" style="color:black;" readonly value="<?php echo $cNmPegawai_session; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-12" style="padding-top:10px;">
									<div class="row">
										<div class="col-md-4" style="padding-top:15px;">
											<label>Approve By</label>					
										</div>
										<div class="col-md-8">
											<input type="text" class="form-control" id="cNIK_approval" placeholder="Approve By" style="color:black;" readonly onclick="list_approval_permission();">	
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
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;Line <?php echo $result_file_name[0]->module_name; ?></h4>
						</div>
						<div class="col-md-8">
							<button class="btn btn-primary" id="add_line" onclick="add_line();" title="Add Line <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-library-plus"></i>&nbsp;&nbsp;Add Item</button>&nbsp;&nbsp;
							<button class="btn btn-warning" id="view_purchase_receipt" onclick="view_purchase_receipt();" title="View Purchase Receipt"><i class="mdi mdi-receipt"></i>&nbsp;&nbsp;View Receipt</button>&nbsp;&nbsp;
						</div>
					</div>
					<hr style="border:2px solid white;">
					<input type="hidden" id="line_use" value="1">
					<table class="stripe row-border order-column" id="line_description">
						<thead>
							<tr style="background-color: rgba(129, 129, 129, 1); height:50px;">
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 150px;">Inventory ID</div></th>
								<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 400px;">Line Description</div></th>
								<th><center><div style="width: 125px;">Job</div></center></th>
								<th><center><div style="width: 125px;">Qty Order</div></center></th>
								<th><center><div style="width: 125px;">Qty Receipt</div></center></th>
								<th><center><div style="width: 75px;">UOM</div></center></th>
								<th><center><div style="width:150px;">Unit Price</div></center></th>
								<th><center><div style="width:200px;">Sub Amount</div></center></th>
								<th><center><div style="width:150px;">Discount Amount</div></center></th>
								<th><center><div style="width:150px;">Discount Percent</div></center></th>
								<th><center><div style="width:200px;">Amount</div></center></th>
								<th><center><div style="width:150px;">Tax Category</div></center></th>
								<th><center><div style="width:150px;">Item Class</div></center></th>
								<th><center><div style="width:150px;">Account</div></center></th>
								<th><center><div style="width:250px;">Description</div></center></th>
								<th><center><div style="width:200px;">Warehouse</div></center></th>
								<th><center><div style="width:100px;">Delete</div></center></th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_employee">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Item Class</h4>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_inventory">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Inventory</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_inventory" value="0">
					<input type="hidden" id="no_line_category" value="0">
					<table class="table" id="list_inventory">
						<thead>
							<tr>
								<th style="width:15%;">Select</th>
								<th style="width:85%;">Inventory CD</th>
								<th style="width:85%;">Inventory Name</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_inventory_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_inventory_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_item_class">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Item Class</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_item_class" value="0">
					<input type="hidden" id="no_line_item_class" value="0">
					<table class="table" id="list_item_class">
						<thead>
							<tr>
								<th>Select</th>
								<th>Class ID</th>
								<th>Class Name</th>
								<th>Class Category</th>
								<th>Department</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_item_class_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_item_class_close();">Close</a>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_coa">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Unit of Measure</h4>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_warehouse">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Warehouse</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_warehouse" value="0">
					<input type="hidden" id="no_line_warehouse" value="0">
					<table class="table" id="list_warehouse">
						<thead>
							<tr>
								<th>Select</th>
								<th>Warehouse ID</th>
								<th>Warehouse Name</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_warehouse_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_warehouse_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_purchase_order">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Purchase Order</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_purchase_order" value="0">
					<table class="table" id="list_purchase_order">
						<thead>
							<tr>
								<th>Select</th>
								<th>Purchase Order</th>
								<th>Vendor Name</th>
								<th>PO Date</th>
								<th>Total Amount</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_purchase_order_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_purchase_order_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_purchase_receipt">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Purchase Receipt</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<table class="table" id="list_purchase_receipt">
						<thead>
							<tr>
								<th>Purchase Receipt</th>
								<th>Date</th>
								<th><div align="center">Total Qty</div></th>
								<th><div align="right">Total Amount</div></th>
								<th><div align="center">Create By</div></th>
								<th><div align="center">Receipt By</div></th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-secondary" onClick="list_purchase_receipt_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var id_module = '<?php echo $result_file_name[0]->id_module; ?>';
		let percent = 0;
		var transaction_number_db = '<?php echo $transaction_number; ?>';
		var transaction_number_format_db = '<?php echo $transaction_number_format; ?>';
		var today = '<?php echo date('Y-m-d'); ?>';
	</script>
<!-- content-wrapper ends -->