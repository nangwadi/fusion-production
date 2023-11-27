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
				<li class="breadcrumb-item active" aria-current="page">create new After Trial</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">

					<div class="row">
						<div class="col-md-7">
							<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;After Trial - <?php echo $JobNo; ?></h4>
						</div>
						<div class="col-md-3">
							<label>Delivery Plan After Trial</label>
							<input type="date" class="form-control" id="DeliveryDatePlan">
						</div>
						<div class="col-md-2" style="padding-top:25px;">
							<button class="btn btn-danger" onclick="add_after_trial();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save After Trial</button>
						</div>
					</div>

					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-12">
							<table id="list_job_order" class="stripe row-border order-column" style="width:100%;">
								<thead>
									<tr>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 50px;">No</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 150px;">Job No</div></th>
										<th style="border:1px solid grey; background-color: grey;"><div style="width: 200px;">Job Name</div></th>
										<th style="border:1px solid grey; background-color: grey;"><center><div style="width: 100px;">After Trial</div></center></th>
										<th style="border:1px solid grey; background-color: grey;"><center><div style="width: 150px;">Delivery Plan</div></center></th>
										<th style="border:1px solid grey; background-color: grey;"><center><div style="width: 150px;">Delivery Actual</div></center></th>
										<th style="border:1px solid grey; background-color: grey;"><center><div style="width:80px;">Delivery</div></center></th>
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

	<script type="text/javascript">
		var JobNo = '<?php echo $JobNo; ?>';
	</script>
<!-- content-wrapper ends -->