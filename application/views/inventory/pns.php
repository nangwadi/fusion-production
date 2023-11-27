<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	.wordwrap { 
		white-space: pre-wrap;      /* CSS3 */   
		white-space: -moz-pre-wrap; /* Firefox */    
		white-space: -pre-wrap;     /* Opera <7 */   
		white-space: -o-pre-wrap;   /* Opera 7 */    
		word-wrap: break-word;      /* IE */
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">Pantry & Stationary</li>
			</ol>
		</nav>
	</div>
	<div class="row">

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Pantry & Stationary</h4>
						</div>
						<div class="col-md-8" align="right">
							<h4 class="card-title btn btn-md btn-primary" onclick="add_inventory_form();" id="btn_add"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Adjust</h4>&nbsp;&nbsp;
							<h4 class="card-title btn btn-md btn-info" onclick="modal_take();" id="btn_add"><i class="mdi mdi-cart-plus"></i>&nbsp;&nbsp;Take</h4>&nbsp;&nbsp;
							<h4 class="card-title btn btn-md btn-success" onclick="list_stock_out('pns');" id="btn_add"><i class="mdi mdi-logout-variant"></i>&nbsp;&nbsp;List</h4>&nbsp;&nbsp;
							<h4 class="card-title btn btn-md btn-warning" onclick="location.reload(true);"><i class="mdi mdi-refresh"></i>&nbsp;&nbsp;Refresh</h4>
						</div>
					</div>
					<hr style="border:2px solid black;">
					<div class="card-body" style="background-color:white; border-radius:5px; color: black;">
						<table class="table table-striped" id="list_common_stock">
							<thead>
								<tr>
									<th>No</th>
									<th>Inventory ID</th>
									<th>Inventory Name</th> 
									<th>Item Class</th>
									<th><div align="right">Stock</div></th>
									<th><div align="center">UOM</div></th> 
									<th><div align="right">Annual Unit Price</div></th>
									<th><div align="right">Amount</div></th>
								</tr>
							</thead>
							<!-- <tbody></tbody> -->
						</table>
					</div>

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
					<input type="hidden" id="id_inventory_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_inventory();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_unit_price">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title" id="header_unit_price"></h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-4 alert alert-primary" style="padding-right:5px;">
							<div class="row">
								<div class="col-md-6">
									<label>Year</label>
									<input type="hidden" id="id_inventory">
									<input type="hidden" id="inventory_name">
									<input type="hidden" id="no">
									<select class="form-control" id="year" style="color:white;"></select>
								</div>
								<div class="col-md-6">
									<label>Annual Price</label>
									<input type="number" id="annual_price" class="form-control" placeholder="Annual Price" style="color:white;">
								</div>
								<div class="col-md-4" style="padding-top:25px;">
									<button class="btn btn-primary" onclick="add_annual_price();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
								</div>
							</div>							
						</div>
						<div class="col-md-8 alert alert-primary">
							<table class="table" id="list_annual_price">
								<thead>
									<tr>
										<th>No</th>
										<th>Year</th>
										<th>Annual Unit Price</th>
										<th>Status</th>
										<th>Update</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-secondary" onClick="list_unit_price_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_take">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">Take - Pantry & Stationary</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-9" align="right">&nbsp;
						</div>
						<div class="col-md-3">
							<label>Select Employee</label>
							<select class="form-control" id="cNIK_take" style="color:white;"></select>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-8 alert alert-primary">
							<table class="table" id="list_take">
								<thead>
									<tr>
										<th>No</th>
										<th>ID Inventory</th>
										<th>Inventory Name</th>
										<th>Last Stock</th>
										<th>Qty Take</th>
										<th>Take</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
						<div class="col-md-4 alert alert-primary">
							<table class="table" id="list_take_resume">
								<thead>
									<tr>
										<th>No</th>
										<th>Inventory Name</th>
										<th>Qty Take</th>
										<th>Delete</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
					<a class="btn btn-primary" onClick="add_stock_transaction();">Take Stock</a>
			        <a class="btn btn-secondary" onClick="modal_take_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_convert">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title" id="modal_title_uom_converter"></h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-4">
							<label>UOM Purchase</label>
							<input type="hidden" id="no_uom" class="form-control" style="color:black" readonly>
							<input type="hidden" id="id_inventory_uom" class="form-control" style="color:black" readonly>
							<input type="hidden" id="inventory_name_uom" class="form-control" style="color:black" readonly>
							<input type="text" id="uom_cd_purchase" class="form-control" style="color:black" readonly>
						</div>
						<div class="col-md-5">
							<label>UOM Take</label>
							<select class="form-control" id="id_uom_convert" style="color:white;"></select>
						</div>
						<div class="col-md-3">
							<label>Qty</label>
							<input type="number" id="number_convert" class="form-control">
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
					<a class="btn btn-primary" onClick="add_uom_convert();">Convert UOM</a>
			        <a class="btn btn-secondary" onClick="modal_uom_converter_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<!-- content-wrapper ends -->

	<script type="text/javascript">
		var this_year = '<?php echo date('Y'); ?>';
		var take_list = [];
		var today = '<?php echo date('Y-m-d'); ?>';
	</script>