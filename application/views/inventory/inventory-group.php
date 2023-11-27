<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	.img-scale-down {
	    max-width: 100%;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new Inventory Group</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Inventory Group</h4>
									<hr style="border:2px solid white;">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Inventory Group ID</label>
												<input type="hidden" class="form-control" id="id_inv_group" placeholder="Inventory Group ID" value="0">
												<input type="hidden" class="form-control" id="no" placeholder="Inventory Group ID">
												<input type="text" class="form-control" id="group_cd" placeholder="Inventory Group ID" style="color:white;" autocomplete="off">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Inventory Group Name</label>
												<input type="text" class="form-control" id="group_name" placeholder="Inventory Group Name" style="color:white;" autocomplete="off">
											</div>
										</div>
										<div class="col-md-12" style="padding-top:30px;">
										<div class="form-group" align="right">
											<button class="btn btn-primary me-2" onclick="add_group();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
											<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
										</div>
									</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<!-- <h4 class="card-title btn btn-md btn-warning" onclick="location.reload(true);"><i class="mdi mdi-refresh"></i>&nbsp;&nbsp;Refresh</h4> -->
							<div class="card">
								<div class="card-body">
									<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Inventory Group</h4>
									<hr style="border:2px solid white;">
									<div class="card-body" style="background-color:white; border-radius:5px; color: black;">
										<table class="table table-striped" id="list_group">
											<thead>
												<tr>
													<th>No</th>
													<th>Inventory Group ID</th>
													<th>Inventory Group Name</th>
													<th>Img Banner</th>
													<th>Img Inside</th>
													<th>Action</th> 
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_upload">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title" id="modal_title_upload"></h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-12">
							<div id="div_img"></div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" id="id_inv_group_upload">
							<input type="hidden" id="banner_inside">
							<input type="file" id="img_name" class="form-control">
						</div>
						<div class="col-md-6">
							<div id="div_loading_upload"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-primary" onClick="save_upload_img();">Upload</a>
			        <a class="btn btn-secondary" onClick="modal_upload_close();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<!-- content-wrapper ends -->