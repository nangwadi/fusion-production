<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	.modal-dialog {
		width: 600px;
		margin: 30px auto;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new Inventory In</li>
			</ol>
		</nav>
	</div>

	<div class="row">
		<div class="col-md-12 grid-margin">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<label>Select Job Number</label>
							<input type="text" id="JobNo" class="form-control" style="color:black;" placeholder="Select Job Number" readonly onclick="list_job_order();">
						</div>
						<div class="col-md-6">&nbsp;</div>
						<div class="col-md-3">
							<label>Kit Assembling Number</label>
							<input type="text" id="kit_assy_number" class="form-control" style="color:black;" placeholder="Kit Assembling Number" readonly>
						</div>
						
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Purchase Receipt Before Kit Assembling</h4>
						</div>
					</div>
					<hr style="border:2px solid black;">
					<div class="card-body" style="background-color:white; border-radius:5px; color: black;">
						<table class="table table-striped" id="list_purchase_receipt_line">
							<thead>
								<tr>
									<th>No</th>
									<th>Receipt No.</th>
									<th>Description</th> 
									<th>Qty</th>
									<th>UOM</th>
									<th><div align="right">Unit Price</div></th>
									<th><div align="right">Amount</div></th> 
									<th>Kit</th> 
								</tr>
							</thead>
							<!-- <tbody></tbody> -->
						</table>
					</div>
					<div style="width:100%; padding-top:20px;">
						<button class="btn btn-primary" onclick="kit_assy();"><i class="mdi mdi-arrow-down-bold-circle-outline"></i>&nbsp;&nbsp;Kit Assembling</button>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;Kit Assembling Amount Summary</h4>
						</div>
					</div>
					<hr style="border:2px solid black;">
					<div class="card-body" style="background-color:white; border-radius:5px; color: black;">
						<table class="table table-striped" id="list_kit_assy_summary">
							<thead>
								<tr>
									<th>No</th>
									<th>Category</th>
									<th><div align="right">Amount</div></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						<hr>
						<div class="row" style="padding-top:10px;">
							<div class="col-md-6">&nbsp;</div>
							<div class="col-md-6" align="right">
								<label>Total Amount</label>
								<div align="right" id="total_amount"></div>
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
						<div class="col-md-6">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Kit Assembling</h4>
						</div>
						<div class="col-md-6" align="right">
							<button class="btn btn-info" onclick="list_kit_assy();" title="List Kit Assembling"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;&nbsp;List Kit Assembling</button>
						</div>
					</div>
					<hr style="border:2px solid black;">
					<div class="card-body" style="background-color:white; border-radius:5px; color: black;">
						<table class="table table-striped" id="list_kit_assy_line">
							<thead>
								<tr>
									<th>No</th>
									<th>Receipt No.</th>
									<th>Part No.</th>
									<th>Description</th> 
									<th>Qty</th>
									<th>UOM</th>
									<th><div align="right">Unit Price</div></th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_job_order">
		<div class="modal-dialog" role="document" align="center">
			<div class="modal-content" style="width:600px;">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Job Order</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_job_order">
					<table class="table" id="list_job_order">
						<thead>
							<tr>
								<th>Select</th>
								<th>Job No</th>
								<th>Job Name</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_job_order_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_job_order_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<!-- content-wrapper ends -->