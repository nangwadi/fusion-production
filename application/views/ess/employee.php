<!-- CSS -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/calendar-evo/evo-calendar/css/evo-calendar.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/calendar-evo/evo-calendar/css/evo-calendar.orange-coral.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/calendar-evo/evo-calendar/css/evo-calendar.midnight-blue.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/calendar-evo/evo-calendar/css/evo-calendar.royal-navy.min.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/calendar-evo/demo/demo.css">

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Fira+Mono&display=swap" rel="stylesheet"> -->

<?php
	$title_exp = explode('-', $title);
	$title_end = $title_exp[1];
?>
<style type="text/css">
	table.dataTable tbody td {
	  word-break: break-word; 
	  word-break: break-all; 
	  white-space: normal;
	}

	.photo-box {
		border: 1px solid;
		padding: 10px;
		box-shadow: -5px -5px skyblue;
	}
</style>

<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title"> <?php echo $title; ?></h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">ESS</a></li>
				<li class="breadcrumb-item active" aria-current="page"><?php echo $title_end; ?></li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-md-3">
							<button class="btn btn-primary" onclick="add_employee('<?php echo $status; ?>');"><i class="mdi mdi-plus"></i>&nbsp;&nbsp;Add New <?php echo $title_end; ?></button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
			if ($status=='active') {
				?>
				<div class="col-md-12 grid-margin stretch-card" id="add_employee" style="display:none;">
					<div class="card">
						<div class="card-body">
							<input type="hidden" id="last_button" value="personal_data">
							<nav>
								<div class="nav nav-tabs" id="nav-tab" role="tablist">
									<button class="btn-primary" id="personal_data" onclick="select_button('personal_data');" data-bs-toggle="tab" role="tab" aria-controls="nav-home" style="border:2px solid green; border-radius: 5px;">Personal Data</button>
									<button class="nav-link" id="education" onclick="select_button('education');" data-bs-toggle="tab" role="tab" aria-controls="nav-profile" style="border:2px solid green; border-radius: 5px;">Education</button>
									<button class="nav-link" id="account" onclick="select_button('account');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Account</button>
									<button class="nav-link" id="potition" onclick="select_button('potition');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Potition</button>
									<button class="nav-link" id="join_date" onclick="select_button('join_date');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Join Date</button>
									<button class="nav-link" id="plant" onclick="select_button('plant');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Plant</button>
									<button class="nav-link" id="id_card" onclick="select_button('id_card');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">ID Card</button>
									<button class="nav-link" id="tax_card" onclick="select_button('tax_card');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Tax Card</button>
									<button class="nav-link" id="bpjs" onclick="select_button('bpjs');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">BPJS / JST</button>
									<button class="nav-link" id="family" onclick="select_button('family');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Family</button>
									<button class="nav-link" id="tax" onclick="select_button('tax');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Tax</button>
									<button class="nav-link" id="insurance" onclick="select_button('insurance');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Insurance</button>
									<button class="nav-link" id="bank_account" onclick="select_button('bank_account');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Bank Account</button>
									<button class="nav-link" id="salary" onclick="select_button('salary');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Salary</button>
									<button class="nav-link" id="covid19" onclick="select_button('covid19');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Covid-19 Cert</button>
									<button class="nav-link" id="calendar" onclick="close_button('personal_data');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px; background-color: red;">Close</button>
									<!-- <button class="nav-link" id="calendar" onclick="select_button('calendar');" data-bs-toggle="tab" role="tab" aria-controls="nav-contact" style="border:2px solid green; border-radius: 5px;">Calendar</button> -->
								</div>
							</nav>
							<div class="tab-content" id="nav-tabContent" style="border:2px solid grey;">

								<div class="tab-pane fade show active" id="personal_data_tab" role="tabpanel">
									<div class="row">
										<div class="col-md-8">
											<div class="card" style="padding-left: 25px;">
												<h4 class="card-title">Personal Data</h4>
												<hr>
											</div>
											
											<div class="row">
												<div class="col-md-3 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Employee ID</label>
																<input type="hidden" class="form-control form-control-sm" id="new_employee">
																<input type="text" class="form-control form-control-sm" placeholder="Employee ID" aria-label="Employee ID" id="cNIK">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-5 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Employee Name</label>
																<input type="text" class="form-control form-control-sm" placeholder="Employee Name" aria-label="Employee Name" id="cNmPegawai">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Nickname</label>
																<input type="text" class="form-control form-control-sm" placeholder="Nickname" aria-label="Nickname" id="cNmPanggilan">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 0px;">
															<div class="form-group">
																<label>Birth Place</label>
																<input type="text" class="form-control form-control-sm" placeholder="Birth Place" aria-label="Birth Place" id="cTempatLahir">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 0px;">
															<div class="form-group">
																<label>Birth Day</label>
																<input type="date" class="form-control form-control-sm" placeholder="Birth Day" aria-label="Birth Day" id="dTglLhr">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 0px;">
															<div class="form-group">
																<label>Address</label>
																<input type="text" class="form-control form-control-sm" placeholder="Address" aria-label="Address" id="cAlamat">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 0px;">
															<div class="form-group">
																<label>City</label>
																<input type="text" class="form-control form-control-sm" placeholder="City" aria-label="City" id="cKota">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 0px;">
															<div class="form-group">
																<label>Postal Code</label>
																<input type="number" class="form-control form-control-sm" placeholder="Postal Code" aria-label="Postal Code" id="cKdPos">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 0px;">
															<div class="form-group">
																<label>Phone Number</label>
																<input type="text" class="form-control form-control-sm" placeholder="Phone Number" aria-label="Phone Number" id="cTelp1">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 0px;">
															<div class="form-group">
																<label>Whatsapps Number</label>
																<input type="text" class="form-control form-control-sm" placeholder="Whatsapps Number" aria-label="Whatsapps Number" id="cTelp2">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body" style="padding-top: 20px;">
															<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_personal_data();"><i class="mdi mdi-content-save"></i>Save</button>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4 grid-margin stretch-card">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_personal_data" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_personal_data" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_personal_data" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_personal_data"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="education_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-12">
													<h4 class="card-title">Education</h4>
													<hr>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label for="exampleFormControlSelect3">Last Education</label>
																<select class="form-control form-control-sm" id="id_pendidikan" style="color:white;">
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>University / School Name</label>
																<input type="text" class="form-control form-control-sm" placeholder="University / School Name" aria-label="Employee ID" id="keterangan">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Field of Study</label>
																<input type="text" class="form-control form-control-sm" placeholder="Field of Study" aria-label="Employee ID" id="bidang_study">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:0px;">
																<label for="exampleFormControlSelect3">Graduation Year</label>
																<select class="form-control form-control-sm" id="tahun_lulus" style="color:white;">
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:25px;">
																<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_education();"><i class="mdi mdi-content-save"></i>Save</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="card" style="padding-left: 25px;">
												<h4 class="card-title">Certificate of Education</h4>

												<form id="form_photo_education" method="post" enctype="multipart/form-data">
													<div class="row">
														<div class="col-md-8">
															<input type="file" id="file_photo_education" name="" class="file-upload-default">
														</div>
														<div class="col-md-4">
															<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_education"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
														</div>
													</div>
												</form>

												<hr>
												<div class="card photo-box" style="width: 100%;">
													<img class="card-img-top" id="photo_education" alt="Card image cap">
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="account_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Finger Scan ID</label>
														<input type="text" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="cNoAbsen">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Email</label>
														<input type="text" class="form-control form-control-sm" placeholder="Email" aria-label="Employee ID" id="email">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Password</label>
														<input type="password" class="form-control form-control-sm" placeholder="Password" aria-label="Employee ID" id="Pwd">
														<input type="hidden" class="form-control form-control-sm" aria-label="Employee ID" id="cNoAbsen_old">
														<input type="hidden" class="form-control form-control-sm" aria-label="Employee ID" id="email_old">
														<input type="hidden" class="form-control form-control-sm" aria-label="Employee ID" id="Pwd_old">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:25px;">
														<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_account();"><i class="mdi mdi-content-save"></i>Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="potition_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Department</label>
														<input type="hidden" class="form-control form-control-sm" id="update_potition" value="0">
														<select class="form-control form-control-sm" id="cIDDept" style="color:white;" onchange="getDivision('', '');">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Division</label>
														<select class="form-control form-control-sm" id="cIDBag" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-2 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Start Date</label>
														<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dBerlaku_Dari_potition">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Potition</label>
														<select class="form-control form-control-sm" id="cIDJbtn" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Employee Status</label>
														<select class="form-control form-control-sm" id="cIDStsKrj" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:20px;">
														<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_potition();"><i class="mdi mdi-content-save"></i>Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label>List Potition History</label>
											<hr>
											<table class="table table-striped" id="list_potition">
												<thead>
													<tr>
														<th>No</th>
														<th>Department</th>
														<th>Division</th>
														<th>Potition</th>
														<th>Employee Status</th>
														<th>Date Start</th>
														<th>Date End</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>

									</div>
								</div>

								<div class="tab-pane fade show active" id="join_date_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Join Date (Fist Time Join)</label>
														<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dTglGabung">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Join Date (After back to MM)</label>
														<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dTglGabung2">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:20px;">
														<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_join_date();"><i class="mdi mdi-content-save"></i>Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="plant_tab" role="tabpanel" style="display: none;">
									<div class="row">

										<div class="col-md-2 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Plant</label>
														<select class="form-control form-control-sm" id="plant_select" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-2 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:20px;">
														<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_plant();"><i class="mdi mdi-content-save"></i>Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="id_card_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>ID Card Number</label>
																<input type="text" class="form-control form-control-sm" placeholder="ID Card Number" aria-label="Employee ID" id="cNoKTP">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-8 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Address (like in ID Card)</label>
																<input type="text" class="form-control form-control-sm" placeholder="Address (like in ID Card)" aria-label="Employee ID" id="cAlamatKTP">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>City (like in ID Card)</label>
																<input type="text" class="form-control form-control-sm" placeholder="City (like in ID Card)" aria-label="Employee ID" id="cKotaKTP">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:20px;">
																<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_id_card();"><i class="mdi mdi-content-save"></i>Save</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_personal_ktp" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_personal_ktp" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_personal_ktp" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_personal_ktp"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="tax_card_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Tax Number</label>
																<input type="text" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="cNPWP">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-8 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Address (like in Tax Card)</label>
																<input type="text" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="cAlamatNPWP">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>City (like in Tax Card)</label>
																<input type="text" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="cKotaNPWP">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:20px;">
																<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_tax_card();"><i class="mdi mdi-content-save"></i>Save</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_personal_npwp" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_personal_npwp" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_personal_npwp" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_personal_npwp"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="bpjs_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>BPJS Number</label>
																<input type="text" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="cNoBPJS">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Join Date (like in BPJS)</label>
																<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dTglBPJS">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:20px;">
																<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_bpjs();"><i class="mdi mdi-content-save"></i>Save</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="row">
												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>BPJS Naker Number</label>
																<input type="text" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="cNoJST">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Join Date (like in BPJS Naker)</label>
																<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dTglJST">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-4 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:20px;">
																<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_naker();"><i class="mdi mdi-content-save"></i>Save</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_personal_bpjs" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_personal_bpjs" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_personal_bpjs" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_personal_bpjs"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_personal_jst" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_personal_jst" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_personal_jst" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_personal_jst"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="family_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Full Name</label>
														<input type="hidden" class="form-control form-control-sm" id="update_family" value="0">
														<input type="text" class="form-control form-control-sm" placeholder="Full Name" aria-label="Employee ID" id="cNama">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Birth Day</label>
														<input type="date" class="form-control form-control-sm" placeholder="Birth Day" aria-label="Employee ID" id="dTglLhr_family">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Birth Place</label>
														<input type="text" class="form-control form-control-sm" placeholder="Birth Place" aria-label="Employee ID" id="cTempat_Lhr">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Sex</label>
														<select class="form-control form-control-sm" id="cJnsKel_select" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Family Relation</label>
														<select class="form-control form-control-sm" id="cIDHubKel_select" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Religion</label>
														<select class="form-control form-control-sm" id="cIDAgama_select" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Blood</label>
														<select class="form-control form-control-sm" id="cGolDrh_select" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Married</label>
														<select class="form-control form-control-sm" id="lNikah_select" style="color:white;" onchange="getMerriedDate();">
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Married Date (If was Married)</label>
														<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dTglNikah" readonly>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:20px;">
														<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_family();"><i class="mdi mdi-content-save"></i>Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<hr>
										<label><h3><u>List Family</u></h3></label><br>
										<div class="col-md-12 grid-margin stretch-card">
											<table class="table table-striped" id="list_family">
												<thead>
													<tr>
														<th style="color:white;">No</th>
														<th style="color:white;">Name</th>
														<th style="color:white;">Birth Place</th>
														<th style="color:white;">Birth Day</th>
														<th style="color:white;">Relation</th>
														<!-- <th style="color:white;">Address</th> -->
														<th style="color:white;">Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>

									<div class="row">
										<hr>
										<div class="col-md-12 grid-margin stretch-card">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<form id="form_photo_personal_family" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_personal_family" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_personal_family"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
													<div class="form-group" style="padding-top:15px;">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_personal_family" alt="Card image cap">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="tax_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:0px;">
																<label for="exampleFormControlSelect3">Tax</label>
																<select class="form-control form-control-sm" id="tax_pph21" style="color:white;">
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:0px;">
																<label for="exampleFormControlSelect3">BPJS</label>
																<select class="form-control form-control-sm" id="tax_bpjs" style="color:white;">
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:0px;">
																<label for="exampleFormControlSelect3">Year</label>
																<select class="form-control form-control-sm" id="tahun_tax" style="color:white;">
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Start Date</label>
																<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dBerlaku_Dari_tax">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-6 grid-margin stretch-card">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:20px;">
																<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_tax();"><i class="mdi mdi-content-save"></i>Save</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">
											<label>List Tax</label>
											<table class="table table-striped" id="list_tax">
												<thead>
													<tr>
														<th>No</th>
														<th>Year</th>
														<th>Tax</th>
														<th>BPJS</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="insurance_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-3 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Insurance Number</label>
														<input type="text" class="form-control form-control-sm" placeholder="Insurance Number" aria-label="Employee ID" id="no_pes">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-2 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Premi /Month</label>
														<input type="number" class="form-control form-control-sm" placeholder="Premi /Month" aria-label="Employee ID" id="bulan">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-2 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Number of Month</label>
														<input type="number" max="12" class="form-control form-control-sm" placeholder="Number of Month" aria-label="Employee ID" id="Jml_Bln">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-2 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group">
														<label>Date Start</label>
														<input type="date" class="form-control form-control-sm" placeholder="Date Start" aria-label="Employee ID" id="dBerlaku_Dari_bni">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-2 grid-margin stretch-card">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:20px;">
														<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_insurance();"><i class="mdi mdi-content-save"></i>Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label>List Insurance</label>
											<table class="table table-striped" id="list_insurance">
												<thead>
													<tr>
														<th>No</th>
														<th>Insurance Number</th>
														<th>/Year</th>
														<th>/Month</th>
														<th>Σ Month</th>
														<th>Date Start</th>
														<th>Date End</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="bank_account_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-8">
											<div class="row">
												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:0px;">
																<label for="exampleFormControlSelect3">Bank Name</label>
																<input type="hidden" value="0" id="update_bank">
																<select class="form-control form-control-sm" id="cIDBank" style="color:white;">
																</select>
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Account Name</label>
																<input type="text" class="form-control form-control-sm" placeholder="Account Name" aria-label="Employee ID" id="cNmPemilik">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Account Number</label>
																<input type="text" class="form-control form-control-sm" placeholder="Account Number" aria-label="Employee ID" id="cNoAccount">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>Branch</label>
																<input type="text" class="form-control form-control-sm" placeholder="Branch" aria-label="Employee ID" id="cAlmBank">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<div class="form-group">
																<label>City</label>
																<input type="text" class="form-control form-control-sm" placeholder="City" aria-label="Employee ID" id="dCity">
															</div>
														</div>
													</div>
												</div>

												<div class="col-md-3">
													<div class="card">
														<div class="card-body">
															<div class="form-group" style="padding-top:20px;">
																<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_bank_account();"><i class="mdi mdi-content-save"></i>Save</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top"  id="photo_bank_account" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_bank_account" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_bank_account" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_bank_account"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label>List Bank Account</label>
											<table class="table table-striped" id="list_bank_account">
												<thead>
													<tr>
														<th style="width:10px;">No.</th>
														<th style="width:150px;">Bank Name</th>
														<th style="width:150px;">Account Name</th>
														<th style="width:100px;">Account Number</th>
														<th style="width:150px;">Branch</th>
														<th style="width:150px;">City</th>
														<th style="width:30px;">Action</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="salary_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-3">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Salary Component Name</label>
														<input type="hidden" class="form-control form-control-sm" id="update_salary" value="0">
														<select class="form-control form-control-sm" id="cIDKomponen" style="color:white;">
														</select>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Nominal</label>
														<input type="number" class="form-control form-control-sm" placeholder="Nominal" aria-label="Employee ID" id="nNilai">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:0px;">
														<label for="exampleFormControlSelect3">Start Date</label>
														<input type="date" class="form-control form-control-sm" placeholder="Finger Scan ID" aria-label="Employee ID" id="dBerlaku_Dari_salary">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<div class="card">
												<div class="card-body">
													<div class="form-group" style="padding-top:20px;">
														<button type="button" class="btn btn-social-icon-text btn-linkedin" onclick="save_salary();"><i class="mdi mdi-content-save"></i>Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<label>List of Salary Component</label>
											<table class="table table-striped" id="list_salary">
												<thead>
													<tr>
														<th>No.</th>
														<th>Salary Component</th>
														<th>Nominal</th>
														<th>Category</th>
														<th>Date Start</th>
														<th>Date End</th>
														<th>Status</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="covid19_tab" role="tabpanel" style="display: none;">
									<div class="row">
										<div class="col-md-4">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_covid19_1" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_covid19_1" method="post" enctype="multipart/form-data">
														<div class="row">
															<div class="col-md-8">
																<input type="file" id="file_photo_covid19_1" name="" class="file-upload-default">
															</div>
															<div class="col-md-4">
																<button type="button" class="btn btn-success btn-icon-text" id="button_photo_covid19_1"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_covid19_2" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_covid19_2" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_covid19_2" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_covid19_2"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="card">
												<div class="card-body" style="padding-top: 0px;">
													<div class="form-group">
														<div class="card photo-box" style="width: 100%;">
															<img class="card-img-top" id="photo_covid19_3" alt="Card image cap">
														</div>
													</div>
													<form id="form_photo_covid19_3" method="post" enctype="multipart/form-data">
														<div class="row">
																<div class="col-md-8">
																	<input type="file" id="file_photo_covid19_3" name="" class="file-upload-default">
																</div>
																<div class="col-md-4">
																	<button type="button" class="btn btn-danger btn-icon-text" id="button_photo_covid19_3"><i class="mdi mdi-upload btn-icon-prepend"></i> Upload </button>
																</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade show active" id="calendar_tab" role="tabpanel" style="display: none;">
									<section id="demos">
						                <div class="section-content">
						                    <div class="console-log">
						                        <div class="log-content">
						                            <div class="--noshadow" id="demoEvoCalendar"></div>
						                        </div>
						                    </div>
						                </div>
						            </section>
								</div>

							</div>
						</div>
					</div>
				</div>
				<?php
			}
			else {
				?>
				<div class="col-md-12 grid-margin stretch-card" id="add_employee_resign" style="display:none;">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleFormControlSelect3">Employee</label>
										<select class="form-control form-control-sm" id="cNIK_resign" style="color:white;">
										</select>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="exampleFormControlSelect3">Note of Resign</label>
										<select class="form-control form-control-sm" id="cIDJnsBerhenti" style="color:white;">
										</select>
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group">
										<label for="exampleFormControlSelect3">Resign Date</label>
										<input type="date" class="form-control form-control-sm" placeholder="Resign Date" id="dTglPengajuan">
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label for="exampleFormControlSelect3">Other</label>
										<input type="text" class="form-control form-control-sm" placeholder="Other Note" id="cNote">
									</div>
								</div>

								<div class="col-md-2">
									<div class="form-group" style="padding-top:30px;">
										<button class="btn btn-md btn-primary" onclick="save_resign();"><i class="mdi mdi-content-save"></i>&nbsp;&nbsp;Save</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
		?>

		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title"><i class="mdi mdi-format-list-bulleted "></i>&nbsp;&nbsp;List <?php echo $title_end; ?></h4>
					<hr style="border:2px solid white;">

					<?php
						if ($status=='active') {
							?>
							<table class="table table-striped" id="list_employee">
								<thead>
									<tr>
										<th style="color:white;">No</th>
										<th style="color:white;">Employee ID</th>
										<th style="color:white;">Employee Name</th>
										<th style="color:white;">Department</th>
										<th style="color:white;">Division</th>
										<th style="color:white;">Potition</th>
										<th style="color:white;">Sift Group</th>
										<th style="color:white;">Action</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
							<?php
						}
						else {
							?>
							<table class="table table-striped" id="list_employee">
								<thead>
									<tr>
										<th style="color:white;">No</th>
										<th style="color:white;">Employee ID</th>
										<th style="color:white;">Employee Name</th>
										<th style="color:white;">Resign Date</th>
										<th style="color:white;">Resign Type</th>
										<th style="color:white;">Note</th>
										<!-- <th style="color:white;">Other</th> -->
										<th style="color:white;">Action</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
							<?php
						}
					?>
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

<?php
	$tahun_ini = date('Y');
	$tahun_lulus_awal = $tahun_ini-25;
?>

<script type="text/javascript">
	var status = '<?php echo $status; ?>';
	var tahun_lulus_awal = '<?php echo $tahun_lulus_awal; ?>';
	var tahun_lulus_akhir = '<?php echo $tahun_ini; ?>';
	var tahun_ini = '<?php echo $tahun_ini; ?>';
</script>
