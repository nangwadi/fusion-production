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
				<li class="breadcrumb-item active" aria-current="page">create new BPJS</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;PKP & PTKP</h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Wife - Company</label>
								<input type="hidden" class="form-control" id="id_pkp_ptkp">
								<input type="number" class="form-control" id="istri_company" placeholder="Wife - Company">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Wife - Employee</label>
								<input type="number" class="form-control" id="istri_personal" placeholder="Wife - Employee">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Child - Company</label>
								<input type="number" class="form-control" id="anak_company" placeholder="Child - Company">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Cild - Employee</label>
								<input type="number" class="form-control" id="anak_personal" placeholder="Cild - Employee">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Default Nominal</label>
								<input type="number" class="form-control" id="nominal_default" placeholder="Default Nominal">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Number of Month</label>
								<input type="number" class="form-control" id="jumlah_bulan" placeholder="Number of Month">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group" style="padding-top:25px;">
								<button class="btn btn-primary me-2" onclick="add_pkp_ptkp();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
							</div>	
						</div>
					</div>

				</div>
			</div>
		</div>


		<!-- ============================================================= COMPANY =============================================================================================== -->

		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add PKP & PTKP Formula Company</h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Range Start</label>
								<input type="hidden" class="form-control" id="id_pkp_ptkp_formula_company" value="">
								<input type="number" class="form-control" id="range_start" placeholder="Range Start">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Range End</label>
								<input type="number" class="form-control" id="range_end" placeholder="Range End">
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>NPWP Percent</label>
								<input type="number" class="form-control" id="npwp_percent" placeholder="NPWP Percent">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Non NPWP Percent</label>
								<input type="number" class="form-control" id="non_npwp_percent" placeholder="Non NPWP Percent">
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Minus</label>
								<input type="number" class="form-control" id="minus_npwp" placeholder="Minus">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Minus</label>
								<input type="number" class="form-control" id="minus_non_npwp" placeholder="Minus">
							</div>	
						</div>
					</div>

					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_pkp_ptkp_formula(1);"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List PKP & PTKP Formula Company</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_pkp_ptkp_formula_company">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Range Start</th>
								<th style="color:white;">Range End</th>
								<th style="color:white;">NPWP Percent</th>
								<th style="color:white;">Non NPWP Percent</th>
								<th style="color:white;">Minus NPWP</th>
								<th style="color:white;">Minus Non NPWP</th>
								<th style="color:white;">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>

				</div>
			</div>
		</div>

		<!-- ============================================================= PERSONAL =============================================================================================== -->

		<div class="col-md-4 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add PKP & PTKP Formula Personal</h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Range Start</label>
								<input type="hidden" class="form-control" id="id_pkp_ptkp_formula_personal" value="">
								<input type="number" class="form-control" id="range_start_personal" placeholder="Range Start">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Range End</label>
								<input type="number" class="form-control" id="range_end_personal" placeholder="Range End">
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>NPWP Percent</label>
								<input type="number" class="form-control" id="npwp_percent_personal" placeholder="NPWP Percent">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Non NPWP Percent</label>
								<input type="number" class="form-control" id="non_npwp_percent_personal" placeholder="Non NPWP Percent">
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Minus</label>
								<input type="number" class="form-control" id="minus_npwp_personal" placeholder="Minus">
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Minus</label>
								<input type="number" class="form-control" id="minus_non_npwp_personal" placeholder="Minus">
							</div>	
						</div>
					</div>

					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_pkp_ptkp_formula(2);"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-8 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List PKP & PTKP Formula Personal</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_pkp_ptkp_formula_personal">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Range Start</th>
								<th style="color:white;">Range End</th>
								<th style="color:white;">NPWP Percent</th>
								<th style="color:white;">Non NPWP Percent</th>
								<th style="color:white;">Minus NPWP</th>
								<th style="color:white;">Minus Non NPWP</th>
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
					<input type="hidden" id="id_bpjs_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_bpjs();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->