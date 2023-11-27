<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	.remove_img1 {
		position: absolute;
		border-radius: 5px;
		color:red;
		left: 100%;
		top: 90%;
		transform: translate(-50%, -50%);
		background-color: rgba(255, 255, 255, 1);
		width:130px;
		height: 25px;
	}

	.remove_img2 {
		position: absolute;
		border-radius: 5px;
		color:red;
		left: 100%;
		top: 90%;
		transform: translate(-50%, -50%);
		background-color: rgba(255, 255, 255, 1);
		width:130px;
		height: 25px;
	}

	.remove_img3 {
		position: absolute;
		border-radius: 5px;
		color:red;
		left: 100%;
		top: 90%;
		transform: translate(-50%, -50%);
		background-color: rgba(255, 255, 255, 1);
		width:130px;
		height: 25px;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new Approval Department</li>
			</ol>
		</nav>
	</div>
	<div class="row">

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;Choose Day Off</h4>
					<hr style="border:2px solid white;">
					<div class="row">
						<div class="col-md-12" id="div_btn_approval"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List Approval Department</h4>
					<hr style="border:2px solid white;">
					<table class="table table-striped" id="list_day_off">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Employee Name / ID</th>
								<th style="color:white;">Date</th>
								<th style="color:white;">Day Off</th>
								<th style="color:white;">Note</th>
								<th style="color:white;">Image</th>
								<th style="color:white;">Diff of AL</th>
								<th style="color:white;">Note (If Reject)</th>
								<th style="color:white;">Approve</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
					<div class="row" style="padding-top:20px;">
						<div class="col-md-7">&nbsp;</div>
						<div class="col-md-3">
							<input type="hidden" id="total_line" value="">
							<input type="hidden" id="cIDAbsen" value="">
							<input type="password" id="Pwd" class="form-control" placeholder="Type Your Password Here">&nbsp;&nbsp;
						</div>
						<div class="col-md-2" align="right">
							<button class="btn btn-md btn-primary" onclick="approve();"><i class="mdi mdi mdi-check"></i>&nbsp;&nbsp;Approve</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal modal-lg" tabindex="-1" role="dialog" id="modal_loading">
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

	<div class="modal" tabindex="-1" role="dialog" id="modal_image">
		<div class="modal-dialog  modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: white; color: black;">
					<h5 class="modal-title" id="modal_title_image"></h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						<div class="col-md-4" id="div_img1" style="display:none;" oncontextmenu="return false;">
							<input type="hidden" id="img1_value">
							<img src="" id="img1">
							<div class="remove_img1" align="center" onclick="download_img(1);">
								<i class="mdi mdi-cloud-download"></i>&nbsp;&nbsp;Download
							</div>
						</div>
						<div class="col-md-4" id="div_img2" style="display:none;" oncontextmenu="return false;">
							<input type="hidden" id="img2_value">
							<img src="" id="img2">
							<div class="remove_img2" align="center" onclick="download_img(2);">
								<i class="mdi mdi-cloud-download"></i>&nbsp;&nbsp;Download
							</div>
						</div>
						<div class="col-md-4" id="div_img3" style="display:none;" oncontextmenu="return false;">
							<input type="hidden" id="img3_value">
							<img src="" id="img3">
							<div class="remove_img3" align="center" onclick="download_img(3);">
								<i class="mdi mdi-cloud-download"></i>&nbsp;&nbsp;Download
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color: white; color: black;">
			        <a class="btn btn-secondary" onClick="view_image_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->

<script type="text/javascript">
	var category = '<?php echo $category; ?>';
</script>