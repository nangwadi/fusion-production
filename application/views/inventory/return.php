<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
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

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Inventory In</h4>
						</div>
						<div class="col-md-8" align="right">
							<button class="btn btn-warning" onclick="location.reload(true);"><i class="mdi mdi-refresh"></i>&nbsp;&nbsp;Refresh</button>&nbsp;&nbsp;
							<button class="btn btn-info" onclick="list_return();" title="List <?php echo $result_file_name[0]->module_name; ?>"><i class="mdi mdi-format-list-bulleted"></i>&nbsp;&nbsp;List Return</button>
						</div>
					</div>
					<hr style="border:2px solid black;">
					<div class="card-body" style="background-color:white; border-radius:5px; color: black;">
						<table class="table table-striped" id="list_inventory">
							<thead>
								<tr>
									<th>No</th>
									<th>Receipt No.</th>
									<th>Description</th> 
									<th>Qty</th>
									<th>UOM</th>
									<th>Unit Price</th>
									<th>Amount</th>
									<th>Return</th> 
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_item_class">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title">List Item Class</h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
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

	<!-- content-wrapper ends -->