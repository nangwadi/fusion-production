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
				<li class="breadcrumb-item active" aria-current="page">create new Numbering Sequence</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Numbering Sequence - <?php echo $result_file_name[0]->module_name; ?></h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>String Format</label>
								<input type="text" class="form-control" id="string_format" placeholder="Module ID">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label>&nbsp;</label>
								<select class="form-control" id="cut_1" style="color:white;">
									<option value="/">/</option>
									<option value="-">-</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Year</label>
								<input type="text" class="form-control" style="color:black;" id="year" value="<?php echo date('Y') ?>" readonly>
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label>&nbsp;</label>
								<select class="form-control" id="cut_2" style="color:white;">
									<option value="/">/</option>
									<option value="-">-</option>
								</select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Number Length</label>
								<input type="number" class="form-control" id="number_length" value="4" min="4" placeholder="Module ID">
							</div>
						</div>
						<div class="col-md-2" style="padding-top:27px;">
							<button class="btn btn-primary me-2" onclick="add_numbering_sequence();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- <div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Module</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_module">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Module Category</th>
								<th style="color:white;">Module ID</th>
								<th style="color:white;">Module Name</th>
								<th style="color:white;">File Name</th>
								<th style="color:white;">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>

				</div>
			</div>
		</div> -->

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
					<input type="hidden" id="id_module_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_module();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var id_module = '<?php echo $result_file_name[0]->id_module; ?>';
	</script>
<!-- content-wrapper ends -->