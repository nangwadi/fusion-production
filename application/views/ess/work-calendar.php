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
				<li class="breadcrumb-item active" aria-current="page">create new Mandatory Overtime</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row" id="calendar">
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

	<div class="modal fade" tabindex="-1" role="dialog" id="modal_update_calendar">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="width:150%;">
				<div class="modal-header" style="background-color:white;">
					<h5 class="modal-title" style="color:black;">Update Calendar</h5>
				</div>
				<div class="modal-body" style="background-color: white; color: black;">
					<div class="row">
						
						<input type="hidden" id="cGroupID_old">
						<input type="hidden" id="cShiftID_Plan_old">
						<input type="hidden" id="cIDAbsen_old">

						<input type="hidden" id="cGroupNm_old">
						<input type="hidden" id="cNmShift_Plan_old">
						<input type="hidden" id="cNmAbsen_old">

						<div class="col-md-6">
							<label>Date</label>
							<input type="text" class="form-control" id="dTglHdr_old" style="color:black;" readonly>
						</div>
						<div class="col-md-6">
							<label>Select Sift Type</label>
							<select class="form-control form-control-sm" id="sift_type" onchange="sift_type();" style="color:white;">
								<option value="0">Non Sift</option>
								<option value="1">Sift</option>
							</select>
						</div>
						<div class="col-md-6" id="date_start" style="display:none;" style="padding-top:20px;">
							<label>Date Start</label>
							<input type="text" class="form-control" id="dTglHdr_start" style="color:black;" readonly>
						</div>
						<div class="col-md-6" id="date_end" style="display:none;" style="padding-top:20px;">
							<label>Date End</label>
							<input type="date" class="form-control" id="dTglHdr_end" style="color:black;">
						</div>
						<div class="col-md-6" style="padding-top:20px;">
							<label>Select New Sift</label>
							<select class="form-control form-control-sm" id="cShiftID_update" style="color:white;"></select>
						</div>
						<div class="col-md-6" style="padding-top:20px;">
							<label>Select New Precense</label>
							<select class="form-control form-control-sm" id="cIDAbsen_update" style="color:white;"></select>
						</div>
						<div class="col-md-3" style="padding-top:20px;">
							<div class="form-check">
		                        <input type="radio" name="check_day" value="1" id="check_day_1" style="color:black;" onclick="check_day('1');"> Holiday
		                    </div>
						</div>
						<div class="col-md-3" style="padding-top:20px;">
							<div class="form-check">
		                        <input type="radio" name="check_day" value="2" id="check_day_2" style="color:black;" onclick="check_day('2');"> Mandatory OT
		                    </div>
						</div>
						<div class="col-md-3" style="padding-top:20px;">
							<div class="form-check">
		                        <input type="radio" name="check_day" value="3" id="check_day_3" style="color:black;" onclick="check_day('3');"> Change Day
		                    </div>
						</div>
						<div class="col-md-3" style="padding-top:20px;">
							<div class="form-check">
		                        <input type="radio" name="check_day" value="4" id="check_day_4" style="color:black;" onclick="check_day('4');"> Clear
		                    </div>
						</div>
						<div class="col-md-12" id="div_note" style="padding-top:20px; display: none;">
							<label>Note (*If change to holiday)</label>
							<input type="text" class="form-control" id="note" style="color:white;">
						</div>
						<div class="col-md-12" id="div_change_day" style="padding-top:20px; display: none;">
							<label>Change Day (*If change day)</label>
							<input type="date" class="form-control" id="dTglHdr_change_day" style="color:white;">
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background-color:white;">
					<button class="btn btn-primary" onclick="update_calendar();"><i class="mdi mdi-lead-pencil"></i>&nbsp;&nbsp;Update Calendar</button>&nbsp;&nbsp;
			        <a class="btn btn-secondary" onClick="modal_update_calendar_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>
<!-- content-wrapper ends -->

<script type="text/javascript">
	var year_get = '<?php echo $year_get; ?>';
	var cGroupID = '<?php echo $cGroupID; ?>';	
</script>