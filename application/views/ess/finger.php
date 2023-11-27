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
				<li class="breadcrumb-item active" aria-current="page">Finger Scan</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Input Date</label>
								<input type="date" id="tgl" class="form-control">
							</div>
						</div>
						<div class="col-md-3" style="padding-top:30px;">
							<button class="btn btn-primary" onclick="list_finger_search();">Search Finger Scan Log</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Finger Scan</h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_finger">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Employee ID</th>
								<th style="color:white;">Employee Name</th>
								<th style="color:white;">Date Record</th>
								<th style="color:white;">Time Record</th>
								<th style="color:white;">Note</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->