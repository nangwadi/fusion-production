<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	div.dataTables_wrapper {
        /*width: 800px;*/
        margin: 0 auto;
    }
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new Salary Component</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Salary Component</h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Salary Component Group Name</label>
						<input type="hidden" value="" class="form-control" id="cIDKomponen_group" placeholder="Salary Component Code">
						<input type="text" class="form-control" id="cNmKomponen_group" placeholder="Salary Component Name">
					</div>
					
					<div class="form-group">
						<label>Category</label>
						<select class="form-control form-control-sm" id="kategori" style="color:white;"></select>
					</div>	
				
					<div class="form-group">
						<label>Transaction Manual Component</label>
						<select class="form-control form-control-sm" id="cIDKomponen_multi" name="states[]" multiple="multiple" style="height: 30px;"></select>
					</div>	

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Operator</label>
								<input type="text" maxlength="1" class="form-control form-control-sm" id="operator" style="color:white;">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Value</label>
								<input type="number" class="form-control form-control-sm" id="nilai" style="color:white;">
							</div>	
						</div>
					</div>

					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_salary_component();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Salary Component</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_salary_component_group">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Component Group</th>
								<th style="color:white;">Category</th>
								<th style="color:white;">Component Member</th>
								<th style="color:white;">Operator</th>
								<th style="color:white;">Value</th>
								<th style="color:white;">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
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
					<input type="hidden" id="cIDKomponen_group_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_salary_component();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->