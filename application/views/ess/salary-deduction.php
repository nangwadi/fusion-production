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
				<li class="breadcrumb-item active" aria-current="page">create New Salary Deduction</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Salary Deduction</h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Number of Month</label>
								<input type="hidden" class="form-control" id="id_salary_deduction">
								<input type="number" class="form-control" id="month" placeholder="Number of Month">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Number of Week</label>
								<input type="number" class="form-control" id="week" placeholder="Number of Week">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Number of Day</label>
								<input type="number" class="form-control" id="day" placeholder="Number of Day">
							</div>	
						</div>
						<div class="col-md-3">
							<div class="form-group" style="padding-top:25px;">
								<button class="btn btn-primary me-2" onclick="add_salary_deduction();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
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