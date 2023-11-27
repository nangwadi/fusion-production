<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.1.0/css/fixedColumns.dataTables.min.css">

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

    .tdclass {
    	border:1px solid grey; 
    	padding-left:5px;
    }

    .tdclass_right {
    	border:1px solid grey; 
    	padding-right:5px;
    }
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">JOM</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new List Job</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;List Job</h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-4">
							<label>Select Customer<i style="color:red;">*</i></label>
							<select class="form-control" id="id_account" style="color:white;"></select>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Select Job Type<i style="color:red;">*</i></label>
								<select class="form-control" id="id_job_type" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group" style="padding-top:28px;">
								<button class="btn btn-primary me-2" onclick="search_job();"><i class="mdi mdi-file-find"></i>&nbsp;&nbsp;Search</button>
							</div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col-md-12">
							<table id="list_job_order" class="stripe row-border order-column" style="width:100%">
								<thead>
									<tr>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 50px;" align="center">No</div></th>
										<!-- <th style="border:1px solid grey; background-color: grey;"><div style="width: 250px;" align="center">Customer</div></th> -->
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 150px;" align="center">Job No</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 200px;" align="center">Job Name</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 200px;" align="center">PO Number</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 100px;" align="center">PO Date</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 75px;" align="center">Qty</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 150px;" align="center">Amount</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 150px;" align="center">Start Plan</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 150px;" align="center">Start Actual</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 150px;" align="center">Delivery Plan</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 150px;" align="center">Delivery Actual</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 200px;" align="center">Note</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width:80px;" align="center">Detail</div></th>
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_detail">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h4 class="modal-title" id="modal_title_detail"></h4>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<!-- <input type="hidden" id="JobNo"> -->
					<div class="row">
						<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
									<h4>Stage 1</h4>
									<hr>
									<div class="row">
										<div class="col-md-8">
											<label>Customer<i style="color:red;">*</i></label>
											<input type="hidden" class="form-control" id="id_job_order" placeholder="Job Number" style="color: black;" readonly>
											<input type="text" class="form-control" id="id_account_get" placeholder="Job Number" style="color: black;" readonly>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Job Type<i style="color:red;">*</i></label>
												<input type="text" class="form-control" id="id_job_type_get" placeholder="Job Number" style="color: black;" readonly>
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
												<input type="text" class="form-control" id="MoldName" placeholder="Mold Name" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mold Number<i style="color:red;">*</i></label>
												<input type="text" class="form-control" id="MoldNomor" placeholder="Mold Number" style="color: black;" readonly>
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
												<input type="text" class="form-control" id="POCustomerNumber" placeholder="Customer PO Number" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Customer PO Date<i style="color:red;">*</i></label>
												<input type="date" class="form-control" id="PODate" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Qty<i style="color:red;">*</i></label>
												<input type="number" class="form-control" id="Qty" placeholder="Qty" min="1" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Total Amount<i style="color:red;">*</i></label>
												<input type="number" class="form-control" id="Amount" placeholder=""  style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Gross Profit<i style="color:red;">*</i></label>
												<input type="number" class="form-control" id="GrossProfit" placeholder="Qty" min="1" style="color: black;" readonly>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<h4>Stage 3</h4>
									<hr>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>PIC Marketing<i style="color:red;">*</i></label>
												<input type="text" class="form-control" id="cNIK_marketing" placeholder="Job Name" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>PIC Design<i style="color:red;">*</i></label>
												<input type="text" class="form-control" id="cNIK_design" placeholder="Job Name" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Date Start Plan<i style="color:red;">*</i></label>
												<input type="date" class="form-control" id="StartDatePlan" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Date Start Actual<i style="color:red;">*</i></label>
												<input type="date" class="form-control" id="StartDateAct" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Delivery Plan<i style="color:red;">*</i></label>
												<input type="date" class="form-control" id="DeliveryDatePlan" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Delivery Actual<i style="color:red;">*</i></label>
												<input type="date" class="form-control" id="DeliveryDateAct" style="color: black;" readonly>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Note<i style="color:red;">*</i></label>
												<textarea class="form-control" id="Keterangan" placeholder="Note" style="height: 90px; color: black;" readonly></textarea>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<button class="btn btn-md btn-danger" onclick="delete_job();"><i class="mdi mdi-delete-forever"></i>&nbsp;&nbsp;Delete Job</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h4>Stage 4 - Sales Document</h4>
							<hr>
							<div class="row">
								<div class="col-md-6" align="center">
									<button class="btn btn-md btn-primary" style="width:100%;"><i class="mdi mdi-file"></i>&nbsp;&nbsp;Create Sales Order</button>
								</div>
								<div class="col-md-6" align="center">
									<div id="sales_order_number"></div>
								</div>
							</div>
							<div class="row" style="padding-top:15px;">
								<div class="col-md-6" align="center">
									<button class="btn btn-md btn-secondary" style="width:100%;"><i class="mdi mdi-file-export"></i>&nbsp;&nbsp;Create Delivery Order</button>
								</div>
								<div class="col-md-6" align="center">
									<div id="delivery_order_number"></div>
								</div>
							</div>
							<div class="row" style="padding-top:15px;">
								<div class="col-md-6" align="center">
									<button class="btn btn-md btn-success" style="width:100%;"><i class="mdi mdi-file-check"></i>&nbsp;&nbsp;Create Sales Invoice</button>
								</div>
								<div class="col-md-6" align="center">
									<div id="sales_invoice_number"></div>
								</div>
							</div>
							<hr>
							<h4>Stage 5 - Action</h4>
							<hr>
							<div class="row">
								<div class="col-md-6" align="center">
									<button class="btn btn-md btn-info" style="width:100%;" onclick="update_job();"><i class="mdi mdi-lead-pencil"></i>&nbsp;&nbsp;Update Job</button>
								</div>
								<div class="col-md-6" align="center">
									<button class="btn btn-md btn-dark" style="width:100%;" onclick="part_list();"><i class="mdi mdi-file-tree"></i>&nbsp;&nbsp;Create Part List</button>
								</div>
							</div>
							<div class="row" style="padding-top:15px;">
								<div class="col-md-6" align="center">
									<button class="btn btn-md btn-warning" style="width:100%;"><i class="mdi mdi-calendar"></i>&nbsp;&nbsp;Activity Schedule</button>
								</div>
								<div class="col-md-6" align="center">
									<button class="btn btn-md btn-danger" style="width:100%;" onclick="after_trial();"><i class="mdi mdi-backup-restore"></i>&nbsp;&nbsp;After Trial</button>
								</div>
							</div>
							<hr>
							<h4>Stage 6 - After Trial</h4>
							<hr>
							<div class="row">
								<div class="col-md-12">
									
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
					<button type="button" class="btn btn-secondary" onclick="modal_detail_close();">Close</button>
				</div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->