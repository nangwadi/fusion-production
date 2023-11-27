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
				<li class="breadcrumb-item"><a href="#">JOM</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new New Job</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add New Job</h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-6">
							<h4>Stage 1</h4>
							<hr>
							<div class="row">
								<div class="col-md-8">
									<label>Customer<i style="color:red;">*</i></label>
									<input type="hidden" class="form-control" id="id_job_order" value="">
									<input type="hidden" class="form-control" id="number" value="">
									<select class="form-control" id="id_account" style="color:white;" onchange="get_job_number();"></select>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Job Type<i style="color:red;">*</i></label>
										<select class="form-control" id="id_job_type" style="color:white;" onchange="get_job_number();"></select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Job Number<i style="color:red;">*</i></label>
										<input type="text" class="form-control" id="JobNo" placeholder="Job Number" style="color: black;" readonly>
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label>Mold Name<i style="color:red;">*</i></label>
										<input type="text" class="form-control" id="MoldName" placeholder="Mold Name" onchange="getJobName();">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Mold Number<i style="color:red;">*</i></label>
										<input type="text" class="form-control" id="MoldNomor" placeholder="Mold Number" onchange="getJobName();">
									</div>
								</div>
								<div class="col-md-8">
									<div class="form-group">
										<label>Job Name<i style="color:red;">*</i></label>
										<input type="text" class="form-control" id="JobName" placeholder="Job Name" style="color: black;" readonly>
									</div>
								</div>
							</div>
							<hr>
							<h4>Stage 2</h4>
							<hr>
							<div class="row">
								<div class="col-md-8">
									<div class="form-group">
										<label>Customer PO Number<i style="color:red;">*</i></label>
										<input type="text" class="form-control" id="POCustomerNumber" placeholder="Customer PO Number">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Customer PO Date<i style="color:red;">*</i></label>
										<input type="date" class="form-control" id="PODate">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Qty<i style="color:red;">*</i></label>
										<input type="number" class="form-control" id="Qty" value="1" placeholder="Qty" min="1">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Total Amount<i style="color:red;">*</i></label>
										<input type="number" class="form-control" id="Amount" placeholder="" value="0">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Gross Profit<i style="color:red;">*</i></label>
										<input type="number" class="form-control" id="GrossProfit" value="0" placeholder="Qty" min="1">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-1">&nbsp;</div>
						<div class="col-md-5">
							<h4>Stage 3</h4>
							<hr>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>PIC Marketing<i style="color:red;">*</i></label>
										<select class="form-control" id="cNIK_marketing" style="color:white;"></select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>PIC Design<i style="color:red;">*</i></label>
										<select class="form-control" id="cNIK_design" style="color:white;"></select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Date Start Plan<i style="color:red;">*</i></label>
										<input type="date" class="form-control" id="StartDatePlan">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Delivery Plan<i style="color:red;">*</i></label>
										<input type="date" class="form-control" id="DeliveryDatePlan">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Note<i style="color:red;">*</i></label>
										<textarea class="form-control" id="Keterangan" placeholder="Note" style="height: 90px;"></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<button class="btn btn-primary me-2" onclick="add_job_order();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
									<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
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
<!-- content-wrapper ends -->

	<script type="text/javascript">
		var JobNo = '<?php echo $JobNo; ?>';
	</script>