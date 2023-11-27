<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	.remove_img {
		position: absolute;
		color:red;
		right: 5%;
		top: 10%;
		transform: translate(-50%, -50%);
		background-color: rgba(0, 0, 0, 0.8);
		width:30px;
		height: 25px;
	}

	.remove_img2 {
		position: absolute;
		color:red;
		right: 5%;
		top: 10%;
		transform: translate(-50%, -50%);
		background-color: rgba(0, 0, 0, 0.8);
		width:30px;
		height: 25px;
	}

	.remove_img3 {
		position: absolute;
		color:red;
		right: 5%;
		top: 10%;
		transform: translate(-50%, -50%);
		background-color: rgba(0, 0, 0, 0.8);
		width:30px;
		height: 25px;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page">create new <?php echo $cNmAbsen; ?></li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-3 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add <?php echo $cNmAbsen; ?></h4>
					<hr style="border:2px solid white;">

					<div class="form-group">
						<label>Date Start</label>
						<input type="date" class="form-control" name="date_start" id="date_start" value="<?php echo date('Y-m-d'); ?>">
					</div>
					<div class="form-group">
						<label>Date End</label>
						<input type="date" class="form-control" name="date_end" id="date_end">
					</div>
					<div class="form-group">
						<label>Note</label>
						<textarea class="form-control" id="note" name="note" style="height:75px;"></textarea>
					</div>
					<div class="form-group">
						<label>Choose Image 1</label>
						<input type="file" name="img1" class="file-upload-default" id="img1">
						<div class="input-group col-xs-12">
							<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" id="input_img1" readonly>
							<span class="input-group-append">
								<button class="file-upload-browse btn btn-md btn-primary" type="button">Upload</button>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" id="div_view_img1" style="display:none;">
							<img id="img_view1" src="#" alt="your image" style="width:100%; height:100%;" />
							<div class="remove_img" align="center" onclick="remove_img(1);"><i class="mdi mdi-delete-forever"></i></div>
						</div>
					</div><br>

					<div class="form-group" id="div_img2" style="display:none;">
						<label>Choose Image 2</label>
						<input type="file" name="img2" class="file-upload-default" id="img2">
						<div class="input-group col-xs-12">
							<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" id="input_img2" readonly>
							<span class="input-group-append">
								<button class="file-upload-browse btn btn-md btn-primary" type="button">Upload</button>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" id="div_view_img2" style="display:none;">
							<img id="img_view2" src="#" alt="your image" style="width:100%; height:100%;" />
							<div class="remove_img2" align="center" onclick="remove_img(2);"><i class="mdi mdi-delete-forever"></i></div>
						</div>
					</div><br>

					<div class="form-group" id="div_img3" style="display:none;">
						<label>Choose Image 3</label>
						<input type="file" name="img3" class="file-upload-default" id="img3">
						<div class="input-group col-xs-12">
							<input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image" id="input_img3" readonly>
							<span class="input-group-append">
								<button class="file-upload-browse btn btn-md btn-primary" type="button">Upload</button>
							</span>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" id="div_view_img3" style="display:none;">
							<img id="img_view3" src="#" alt="your image" style="width:100%; height:100%;" />
							<div class="remove_img3" align="center" onclick="remove_img(3);"><i class="mdi mdi-delete-forever"></i></div>
						</div>
					</div><br>

					<div class="form-group" align="right">
						<button class="btn btn-primary me-2" onclick="add_day_off_input();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						<button class="btn btn-warning me-2" onclick="reset_form();"><i class="mdi mdi-playlist-remove"></i>&nbsp;&nbsp;Reset</button>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-9 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List <?php echo $cNmAbsen; ?></h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_day_off_input">
						<thead>
							<tr>
								<th style="color:white;">No</th>
								<th style="color:white;">Date</th>
								<th style="color:white;">Type</th>
								<th style="color:white;">Note</th>
								<th style="color:white;">Approve 1</th>
								<th style="color:white;">Approve 2</th>
								<th style="color:white;">GA 1</th>
								<th style="color:white;">GA 2</th>
								<th style="color:white;">GA 3</th>
								<th style="color:white;">GA 4</th>
								<th style="color:white;">Delete</th>
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
					<input type="hidden" id="cIDDept_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_day_off_input();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->

<script type="text/javascript">
	var cIDAbsen = '<?php echo $cIDAbsen; ?>';
</script>