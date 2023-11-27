<?php
	function numberToRomanRepresentation($number) {
	    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
	    $returnValue = '';
	    while ($number > 0) {
	        foreach ($map as $roman => $int) {
	            if($number >= $int) {
	                $number -= $int;
	                $returnValue .= $roman;
	                break;
	            }
	        }
	    }
	    return $returnValue;
	}

	$this_month = (date('m')*1);
	$month_roman = numberToRomanRepresentation($this_month);
?>
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
				<li class="breadcrumb-item active" aria-current="page">create new Numbering Sequence</li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add Transaction - <?php echo $result_file_name[0]->module_name; ?></h4>
					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>Currency</label>
								<input type="hidden" class="form-control" id="id_transaction" value="" style="color:black;" readonly>
								<select class="form-control" id="id_cash_account" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Periode</label>
								<input type="month" class="form-control" id="transaction_periode" value="<?php echo date('Y-m'); ?>">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Begin Balance</label>
								<input type="text" class="form-control" id="begin_balance" style="color:black;" readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Total Debet</label>
								<input type="text" class="form-control" id="total_debet" style="color:black;" readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Total Credit</label>
								<input type="text" class="form-control" id="total_credit" style="color:black;" readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Ending Balance</label>
								<input type="text" class="form-control" id="ending_balance" style="color:black;" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<label>Transaction Date</label>
							<input type="date" class="form-control" id="transaction_date" value="<?php echo date('Y-m-d'); ?>">
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Transaction Type</label>
								<select class="form-control" id="transaction_type" style="color:white;"></select>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Slip Number</label>
								<input type="text" class="form-control" id="transaction_number" style="color:black;" readonly>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Pay To/From</label>
								<input type="text" class="form-control" id="note">
								<input type="hidden" class="form-control" id="total_line" value="0">
							</div>
						</div>
						<div class="col-md-2" style="padding-top:27px;">
							<button class="btn btn-primary me-2" onclick="button_add_line();"><i class="mdi mdi-plus"></i></button>
						</div>
					</div>

					<hr style="border:2px solid white;">

					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped" style="width:100%; color:white;" id="transaction_line">
								<thead>
									<tr>
										<th style="width:20%; padding:0; color: white;"><center>COA</center></th>
										<th style="width:25%; padding:0; color: white;"><center>Note</center></th>
										<th style="width:20%; padding:0; color: white;"><center>Debet</center></th>
										<th style="width:20%; padding:0; color: white;"><center>Credit</center></th>
										<th style="width:15%; padding:0; color: white;"><center>Delete</center></th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
						<div class="col-md-12" id="div_button_save" align="right" style="padding-top:10px; display: none;">
							<button class="btn btn-primary" onclick="save_transaction();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List of <?php echo $result_file_name[0]->module_name; ?></h4>
					<hr style="border:2px solid white;">

					<table class="table table-striped" id="list_transaction_line">
						<thead>
							<tr>
								<th style="color:white; width: 50px;">No</th>
								<th style="color:white; width: 100px;">Date</th>
								<th style="color:white; width: 150px;">Slip No</th>
								<th style="color:white; width: 150px;">Pay To / From</th>
								<th style="color:white; width: 250px;">COA</th>
								<th style="color:white; width: 200px;">Note</th>
								<th style="color:white; width: 150px; text-align: right;">Debet</th>
								<th style="color:white; width: 150px; text-align: right">Credit</th>
								<th style="color:white; width: 150px; text-align: right">Balance</th>
								<th style="color:white; width: 100px;">Action</th>
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
					<input type="hidden" id="id_module_disen">
					<input type="hidden" id="value_disen">
					<p id="modal_body_disen"></p>
				</div>
				<div id="modal_footer_disen">
			        <a class="btn btn-primary" id="btn_disen" onClick="update_module();"></a>
			        <a class="btn btn-secondary" onClick="disable_enable_hide();">Close</a>
			    </div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var transaction_periode_default = '<?php echo date('Y-m'); ?>';
		var id_module = '<?php echo $result_file_name[0]->id_module; ?>';
	</script>
<!-- content-wrapper ends -->