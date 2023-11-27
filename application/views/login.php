<!DOCTYPE html>
<html>
<head>
	<title>Meiwa Fusion - Integrated Everything</title>
	<!-- Site favicon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>style/login/images/favicon.ico">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700" rel="stylesheet">
	<!-- Icon Font -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>style/login/fonts/ionicons/css/ionicons.css">
	<!-- Text Font -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>style/login/fonts/font.css">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>style/login/css/bootstrap.css">
	<!-- Normal style CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>style/login/css/style.css">
	<!-- Normal media CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>style/login/css/media.css">

	<script type="text/javascript">
		message = "Meiwa Fusion - Integrating Everything. ";
		function step() {
			message = message.substr(1) + message.substr(0, 1);
			document.title = message.substr(0, 30);
		}
	</script>
</head>
<body onload="setInterval(step, 300)">

	<!-- Header start -->
	<div class="header-wrap">
		<div class="clearfix">
			<div class="logo" style="font-size:18pt; font-weight:bold;">
				Meiwa Fusion v2 - Integrating Everything
			</div>
		</div>
	</div>
	<!-- Header end -->
	<main class="cd-main">
		<section class="cd-section index visible ">
			<div class="cd-content style1">
				<div class="login-box d-md-flex align-items-center">
					<h1 class="title">Good Morning</h1>
					<h3 class="subtitle">Have a great journey ahead!</h3>
					<div class="login-form-box">
						<div class="login-form-slider">
							<!-- login slide start -->
							<div class="login-slide slide login-style1">

								<div class="form-group">
									<label class="label">Employee ID</label>
									<input type="text" class="form-control" placeholder="Type Employee ID here" id="cNIK" autocomplete="off">
								</div>
								<div class="form-group">
									<label class="label">Password</label>
									<input type="password" class="form-control" placeholder="Type Password Here" id="Pwd" autocomplete="off">
								</div>
								<div class="form-group">
									<input type="submit" class="submit" value="Sign In" onclick="login();">
								</div>

								<div class="forgot-txt">
									<a href="javascript:;" class="forgot-password-click">Forgot Password ?</a>
								</div>

								<div class="form-group" id="div_response" style="display: :none;">
									<div style="width:100%;" id="value_response"></div>
								</div>

								<div class="login-with" style="padding-top: 30px;">
									<h3>Fine we on social media</h3>
									<ul class="social-login-btn">
										<li class="twitter-btn"><a href="<?php echo base_url(); ?>style/login/#"><i class="ion-social-youtube"></i></a></li>
									</ul>
								</div>
							</div>
							<!-- login slide end -->

							<!-- forgot password slide start -->
							<div class="forgot-password-slide slide login-style1">
								<div class="d-flex height-100-percentage">
									<div class="align-self-center width-100-percentage">
										<form>
											<div class="form-group">
												<label class="label">Enter your email address to reset your password</label>
												<input type="email" class="form-control" autocomplete="off">
											</div>
											<div class="form-group">
												<input type="submit" class="submit" value="Submit">
											</div>
										</form>
										<div class="sign-up-txt">
											if you remember your password? <a href="javascript:;" class="login-click">login</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	<div id="cd-loading-bar" data-scale="1"></div>
	<!-- JS File -->
	<script src="<?php echo base_url(); ?>style/login/js/modernizr.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>style/login/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>style/login/js/popper.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>style/login/js/bootstrap.js"></script>
	<script src="<?php echo base_url(); ?>style/login/js/velocity.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>style/login/js/script.js"></script>
	<script type="text/javascript">
		
		var cNIK = document.getElementById("cNIK");
        cNIK.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                login();
            }
        });

        var Pwd = document.getElementById("Pwd");
        Pwd.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                login();
            }
        });

		function login(){
			var cNIK = $('#cNIK').val();
			var Pwd = $('#Pwd').val();

			if (cNIK=="" || Pwd=="") {
				alert ("Employee ID or Password cannot empty, please try again.");
			}
			else {
				$.ajax({
					url: '<?php echo base_url(); ?>act-login',
					type: 'post',
					data: 'cNIK='+cNIK+'&Pwd='+Pwd,
					dataType: 'json',
					success: function(responseGet){
						//console.log(response);
						document.getElementById('div_response').setAttribute('style', 'display:block');
						document.getElementById('value_response').removeAttribute('class');
						$('#value_response').html('');
						responseGet.map(function(responseGetList){
							var status = responseGetList.status;
							if (status==1) {
								document.getElementById('value_response').setAttribute('class', 'btn btn-success');
								$('#value_response').append('Login success');
								setTimeout(function () {
									location.reload();
								}, 5000);
							}
							else {
								var responseValue = responseGetList.responseValue;
								document.getElementById('value_response').setAttribute('class', 'btn btn-danger');
								$('#value_response').append(responseValue);
								setTimeout(function () {
									document.getElementById('div_response').setAttribute('style', 'display:none');
								}, 5000);
							}
						})
					},
					error: function(error){
						console.log(error);
					}
				});
			}
		}
	</script>

</body>
</html>