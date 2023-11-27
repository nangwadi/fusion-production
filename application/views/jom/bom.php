<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>style/datatables/fixedColumns.dataTables.css"> -->

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
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">JOM</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new Part List</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					Bill of Material
					<hr style="border:2px solid white;">

					<div id="div_add_part_list">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Choose Job</label>
											<input type="text" class="form-control" id="JobNo" style="color:black;" placeholder="Choose Job" onclick="list_job();" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="card-body">

					<div id="div_list_part_list">
						<h4 class="card-title"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;&nbsp;<div id="table_title">Bill of Material</div></h4>
						<hr style="border:2px solid white;">

						<div class="card-body" style="background-color:grey; border-radius:5px;">
							<div class="row">
								<div class="col-md-12">
									
									<table id="list_part_list" class="stripe row-border order-column">
										<thead>
											<tr>
												<!-- <th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 100px;">Select</div></th> -->
												<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 100px;">Job No</div></th>
												<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 100px;">Part No</div></th>
												<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 300px;">Part Name</div></th>
												<th><center><div style="width: 100px;">Material</div></center></th>
												<th><center><div style="width: 75px;">Qty</div></center></th>
												<th><center><div style="width: 75px;">Qty<br>(Spare)</div></center></th>
												<th><center><div style="width:250px;">Specification</div></center></th>
												<th><center><div style="width:200px;">Note</div></center></th>
												<th><center><div style="width:100px;">Dwg No</div></center></th>
												<th><center><div style="width:300px;">Supplier</div></center></th>
												<th><center><div style="width:300px;">Maker</div></center></th>
												<!-- <th><center><div style="width:250px;">Material Order</div></center></th> -->
												<th><center><div style="width:100px;">RTO</div></center></th>
											</tr>
										</thead>
										<!-- <tbody></tbody> -->
									</table>
								</div>
							</div>
							
							<div style="padding-top: 20px;">
								<div class="row">
									
									<div class="col-md-4" style="padding-top:10px;">
										<input type="hidden" style="color: black;" class="form-control" id="total_line" value="" readonly>
										<button class="btn btn-primary" onclick="review_po();"><div id="total_line_info"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Review PO</div></button>
									</div>
								</div>
								
								
							</div>
						</div>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_job_order">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Job</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_job" value="0">
					<table class="table" id="list_job">
						<thead>
							<tr>
								<th style="width:20%;">Select</th>
								<th style="width:30%;">Job No</th>
								<th style="width:50%;">Job Name</th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_review_po">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Review Purchase Order</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="total_line_review_po" value="0">
					<table class="table" id="list_review_po">
						<thead>
							<tr>
								<th style="width:15%;">Job No</th>
								<th style="width:15%;">Part No</th>
								<th style="width:40%;">Description</th>
								<th style="width:15%;"><center>Qty Order</center></th>
								<th style="width:15%;"><center>Select</center></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_review_po_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_review_po_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_account_vendor">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Vendor</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_vendor" value="0">
					<input type="hidden" id="no_line_vendor" value="0">
					<input type="hidden" id="id_part_list_vendor" value="0">
					<table class="table" id="list_account_vendor">
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
			        <a class="btn btn-primary" onClick="list_account_add('vendor');">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_account_close('vendor');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_account_maker">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Maker / Process On</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="text" id="no_select_maker" value="0">
					<input type="hidden" id="no_line_maker" value="0">
					<input type="hidden" id="id_part_list_maker" value="0">
					<table class="table" id="list_account_maker">
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
			        <a class="btn btn-primary" onClick="list_account_add('maker');">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_account_close('maker');">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<div class="modal" tabindex="-1" role="dialog" id="modal_detail_imo">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title" id="label_header_imo_detail"></h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-8">
							<label>Vendor</label>
							<input type="hidden" id="id_material_order_detail">
							<input type="text" class="form-control" id="id_account_imo_detail" readonly style="color:black;">
						</div>
						<div class="col-md-4">
							<label>Cut Dimension +</label>
							<select id="cut_dim_detail" class="form-control" style="color: white;"></select>
						</div>
					</div>
					<hr>
					<input type="hidden" id="total_line_detail">
					<table class="table table-striped" style="width: 100%;" id="list_imo_detail">
						<thead>
							<tr>
								<th rowspan="2"><div align="center">DELETE</div></th>
								<th rowspan="2"><div align="center">PART NAME</div></th>
								<th rowspan="2"><div align="center">MATERIAL</div></th>
								<th rowspan="2"><div align="center">QTY</div></th>
								<th colspan="3"><div align="center">CUT DIMENSION</div></th>
							</tr>
							<tr>
								<th><div align="center">L</div></th>
								<th><div align="center">W</div></th>
								<th><div align="center">T</div></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="update_imo_line();">Update & Close</a>
			        <a class="btn btn-secondary" onClick="modal_detail_imo_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var cNIK_session = '<?php echo $cNIK_session; ?>';
		const id_part_list_array = [];
	</script>
<!-- content-wrapper ends -->