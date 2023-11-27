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
				<li class="breadcrumb-item active" aria-current="page">create new Medical Reimbursment</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Medical Reimbursment</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_medical_limit">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Employee Name</th>
								<th style="color:white;">Potition</th>
								<th style="color:white;">Family Status</th>
								<th style="color:white;">Limit /Yr</th>
								<th style="color:white;">Used</th>
								<th style="color:white;">Diff</th>
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

	<div class="modal" id="modal_medical" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color:white; color: black;">
					<h5 class="modal-title" id="label_header"></h5>
					<div class="close alert alert-success" id="loading" style="display:none;"></div>
				</div>
				<div class="modal-body" style="background-color:white; color: black;">
					<div class="row" id="medical_resume_header">
					</div>
					<hr>
					<div class="row">
						<table class="table table-striped" id="list_medical_reimbursment">
							<thead>
								<tr>
									<th>Patient Name</th>
									<th>Bill Date</th>
									<th>Nominal</th>
									<th>Clinic / Hospital</th>
									<th>DR Name</th>
									<th>Diagnosis</th>
									<th>Save</th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer" style="background-color:white; color: black;">
					<button class="btn btn-warning" onclick="modal_medical_hide();">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var cIDPeriod_default = '<?php echo $cIdPeriod; ?>';
		var cNmPeriod_default = '<?php echo $cNmPeriod; ?>';
		var this_year = '<?php echo date('Y'); ?>';
	</script>
<!-- content-wrapper ends -->