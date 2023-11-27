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
					<button class="btn btn-md btn-primary" onclick="part_list();"><i class="mdi mdi-format-float-right"></i>&nbsp;&nbsp;Part List</button>&nbsp;&nbsp;
					<button class="btn btn-md btn-info" onclick="material_order();"><i class="mdi mdi-file-multiple"></i>&nbsp;&nbsp;Material Order</button>
					<hr style="border:2px solid white;">

					<div id="div_add_part_list">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label>Part No <i style="color:red;">*</i></label>
											<input type="hidden" class="form-control" id="id_part_list" placeholder="Job Type ID">
											<input type="hidden" class="form-control" id="id_inventory" value="">
											<input type="hidden" class="form-control" id="no" value="">
											<input type="hidden" class="form-control" id="part_no_hide" value="">
											<input type="text" class="form-control" id="part_no" style="color:white;" placeholder="Part No">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Part Name <i style="color:red;">*</i></label><br>
											<div class="input-group mb-3">
												<!-- <input type="text" class="form-control" id="part_name" style="color:black;" placeholder="Part Name"> -->
												<input type="text" class="form-control" placeholder="Part Name" id="part_name" aria-describedby="basic-addon2">
												<div class="input-group-append">
													<button class="btn btn-inverse-secondary btn-xl" style="height:37.5px;" type="button" onclick="list_inventory();"><i class="mdi mdi-file-find"></i></button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Material</label>
											<input type="text" class="form-control" id="id_material" style="color:black;" placeholder="Material" readonly onclick="list_material();">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label>Qty <i style="color:red;">*</i></label>
											<input type="number" class="form-control" id="qty" style="color:white;" placeholder="Qty">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Qty (Spare)</label>
											<input type="number" class="form-control" id="qty_spare" style="color:white;" placeholder="Qty (Spare)">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Drawing No</label>
											<input type="number" class="form-control" id="drawing_no" style="color:white;" placeholder="Drawing No">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label>Single / Multi Spec Column</label>
											<input type="checkbox" id="single_multi" style="width:30px; height:30px;" onclick="set_single_multi();">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label>Specification <i style="color:red;">*</i></label>
											<div id="single">
												<input type="text" class="form-control" id="sp_1_single" style="color:white;" placeholder="Specification">
											</div>
											<div id="multi" style="display:none;">
												<div class="input-group">
													<input type="text" class="form-control" id="sp_1" style="color:white;" placeholder="Spec 1">
													<input type="text" class="form-control" id="sp_2" style="color:white;" placeholder="Spec 2">
													<input type="text" class="form-control" id="sp_3" style="color:white;" placeholder="Spec 3">
													<input type="text" class="form-control" id="sp_4" style="color:white;" placeholder="Spec 4">
													<input type="text" class="form-control" id="sp_5" style="color:white;" placeholder="Spec 5">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Note</label>
											<input type="text" id="note" class="form-control" style="color:white;" placeholder="Note">
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Vendor <i style="color:red;">*</i></label>
											<input type="text" class="form-control" id="id_account_vendor" style="color:black;" placeholder="Choose Vendor" onclick="list_account('vendor');" readonly>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Maker / Process On</label>
											<input type="text" class="form-control" id="id_account_maker" style="color:white;" placeholder="Choose Maker" onclick="list_account('maker');">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group" align="right" style="padding-top:30px;">
											<button class="btn btn-primary btn-md" onclick="add_part_list();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
											<button class="btn btn-warning btn-md" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="div_add_material_order" style="display:none;">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group">
											<label>Select Vendor</label>
											<input type="hidden" id="id_imo" value="">
											<select class="form-control" id="id_account_imo" style="color:white;"></select>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Cut Dimension +</label>
											<select class="form-control" id="cut_dim" style="color:white;">
												<option value="5">5</option>
												<?php
													for ($i=0; $i <= 10; $i++) { 
														?>
															<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
														<?php
													}
												?>													
											</select>
										</div>
									</div>
									<div class="col-md-12" align="right">
										<div class="form-group" align="right">
											<button class="btn btn-primary btn-md" onclick="open_part_list();" title="Open Part List"><i class="mdi mdi-file-export"></i>&nbsp;&nbsp;Open Part List</button>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-1">&nbsp;</div>

							<div class="col-md-7">
								<input type="hidden" id="total_line">
								<table class="table table-striped" style="width: 100%; color: white;" id="part_list_imo">
									<thead>
										<tr>
											<th rowspan="2"><div align="center" style="color:white;">SELECT</div></th>
											<th rowspan="2"><div align="center" style="color:white;">PART NAME</div></th>
											<th rowspan="2"><div align="center" style="color:white;">MATERIAL</div></th>
											<th rowspan="2"><div align="center" style="color:white;">QTY</div></th>
											<th colspan="3"><div align="center" style="color:white;">CUT DIMENSION</div></th>
										</tr>
										<tr>
											<th><div align="center" style="color:white;">L</div></th>
											<th><div align="center" style="color:white;">W</div></th>
											<th><div align="center" style="color:white;">T</div></th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
								<hr>
								<div align="right">
									<button class="btn btn-primary" onclick="save_imo();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save Material Order</button>
								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="card-body">

					<div id="div_list_part_list">
						<h4 class="card-title"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;&nbsp;Part List - <?php echo $JobNo; ?></h4>
						<hr style="border:2px solid white;">

						<div class="card-body" style="background-color:grey; border-radius:5px;">
							<div class="row">
								<div class="col-md-12">
									<table id="list_part_list" class="stripe row-border order-column">
										<thead>
											<tr>
												<th style="background-color: rgba(129, 129, 129, 1) !important; z-index: 2;"><center><div style="width: 150px;">Action</div></th>
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
												<th><center><div style="width:250px;">Material Order</div></center></th>
												<th><center><div style="width:100px;">RTO</div></center></th>
												<th><center><div style="width:100px;">File DWG</div></center></th>
											</tr>
										</thead>
										<!-- <tbody></tbody> -->
									</table>
								</div>
							</div>
						</div>
					</div>

					<div id="div_list_material_order" style="display:none;">
						<h4 class="card-title"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;&nbsp;Material Order - <?php echo $JobNo; ?></h4>
						<hr style="border:2px solid white;">

						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<table id="list_imo" class="table table-striped">
										<thead>
											<tr>
												<th><div align="center" style="color:white;">No</div></th>
												<th><div align="center" style="color:white;">IMO Number</div></th>
												<th><div align="center" style="color:white;">Vendor</div></th>
												<th><div align="center" style="color:white;">Order Date</div></th>
												<th><div align="center" style="color:white;">Issue By</div></th>
												<th><div align="center" style="color:white;">Check 1 By</div></th>
												<th><div align="center" style="color:white;">Check 2 By</div></th>
												<th><div align="center" style="color:white;">Action</div></th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_inventory">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Inventory</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<input type="hidden" id="no_select_inventory" value="0">
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_material">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Material</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<table class="table" id="list_material">
						<thead>
							<tr>
								<th style="width:15%;">Select</th>
								<th style="width:85%;">Material CD</th>
								<th style="width:85%;">Material Name</th>
								<th style="width:85%;">Default Vendor</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="list_material_add();">Add & Close</a>
			        <a class="btn btn-secondary" onClick="list_material_close();">Close</a>
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
					<input type="hidden" id="no_select_maker" value="0">
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_upload_file_dwg">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title" id="modal_title_upload"></h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-3">
							<label>Choose File (PDF only)</label>
							<input type="hidden" id="id_part_list_upload" value="">
							<input type="file" accept="application/pdf" id="file_name" class="form-control">
						</div>
						<div class="col-md-2">
							<label>Revision (Auto)</label>
							<input type="text" id="rev" value="" class="form-control" readonly style="color:black;">
						</div>
						<div class="col-md-3">
							<label>Note (Optional)</label>
							<input type="text" id="note_upload" class="form-control" style="color:white;">
						</div>
						<div class="col-md-2" style="padding-top:23px;">
							<button class="btn btn-success" onclick="save_upload_file_dwg();"><i class="mdi mdi-upload"></i>&nbsp;&nbsp;Upload</button>
						</div>
						<div class="col-md-2" style="padding-top:23px;">
							<div id="loading_upload_file_dwg"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<hr>
							<label style="font-weight:bold;">List of Drawing File, Upload by MMI</label>
							<hr>
							<table class="table" id="list_file_dwg">
								<thead>
									<tr>
										<th style="width:10%;">No</th>
										<th style="width:20%;">File Name</th>
										<th style="width:10%;">Rev</th>
										<th style="width:20%;">Note</th>
										<th style="width:15%;">Create By</th>
										<th style="width:20%;">Date</th>
										<th style="width:5%;">Download</th>
									</tr>
								</thead>
							</table>							
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<hr>
							<label style="font-weight:bold;">List of Inspection Drawing File, Upload by Vendor</label>
							<hr>
							<table class="table" id="list_file_dwg_ins">
								<thead>
									<tr>
										<th style="width:10%;">No</th>
										<th style="width:25%;">File Name</th>
										<th style="width:10%;">Rev</th>
										<th style="width:25%;">Note</th>
										<th style="width:15%;">Create By</th>
										<th style="width:15%;">Date</th>
										<th style="width:15%;">Download</th>
									</tr>
								</thead>
							</table>							
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-secondary" onClick="upload_file_dwg_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var JobNo = '<?php echo $JobNo; ?>';
		var cNIK_session = '<?php echo $cNIK_session; ?>';
	</script>
<!-- content-wrapper ends -->