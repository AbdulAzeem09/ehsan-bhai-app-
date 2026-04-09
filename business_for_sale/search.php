<?php
	include('../univ/baseurl.php');
	session_start();
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "job-board/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		$category=$_POST['category'];
					$headline=$_POST['search'];
			
	?>
	
	

<!DOCTYPE html>
<html lang="en">

<head>
      <?php include('../component/f_links.php');?>
			<?php include('../component/links.php'); ?>
			
			<!-- owl carousel -->
			<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
			<!-- Morris chart -->
			 
			<?php include('../../component/dashboard-link.php'); ?>
			<script src='https://kit.fontawesome.com/a076d05399.js'></script>
			 
			
			<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>


	<meta name="author" content="">
	<meta name="description" content="">
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>:: The SharePage - The SharePage ::</title>

	<!--  Favicon 
	<link rel="shortcut icon" href="images/favicon.png">

	<!-- CSS -->
	<link rel="stylesheet" href="css/stylesheet.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet">
	<style>
	input.form-control {
    height: 34px;
}

		.cardimg img {
			margin: 0px !important;
			height: 169px !important;
			width: 100% !important;
			border-radius: 30px !important;
		}
		.custom-pr
		{
			padding-right:0px;
		}
		.custom-pl{
			padding-left:0px;
		}
		.header_mg{
			margin-left:150px !important;
		}
		/* On screens that are 600px or less, set the background color to olive */
		@media screen and (max-width: 600px) {
			.custom-pr
			{
				padding-right:15px;	
			}
			.custom-pl{
				padding-left:15px;
			}
			.header_mg{
				margin-left:0px !important;
			}
		}

		.cadtext {
			margin-top: 9px;
		}

		.cadtext row {
			padding-top: 10px;
			padding-left: 20px;
		}

		.cadtext row p {
			line-height: 23px;
		}

		.fontuser {
			position: relative;
		}

		.fontuser i {
			position: absolute;
			left: 90%;
			top: 6px;
			color: gray;
		}

		.category {
			position: relative;
		}

		.category img {
			position: absolute;
			left: 90%;
			top: 20px;

		}

		.row {
			margin-right: 0px;
		}
		body {
   
    line-height: 17px;
   
}
.zoom1:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
}
		
		
	</style>
</head>

<body style="width: auto;">
	<!--Loader
	<div class="vfx-loader">
		<div class="loader-wrapper">
			<div class="loader-content">
				<div class="loader-dot dot-1"></div>
				<div class="loader-dot dot-2"></div>
				<div class="loader-dot dot-3"></div>
				<div class="loader-dot dot-4"></div>
				<div class="loader-dot dot-5"></div>
				<div class="loader-dot dot-6"></div>
				<div class="loader-dot dot-7"></div>
				<div class="loader-dot dot-8"></div>
				<div class="loader-dot dot-center"></div>
			</div>
		</div>
	</div>
	<!-- Loader end -->

	<!-- Wrapper -->

	<!-- Compare Property Widget -->

	<!-- Compare Property Widget / End -->

	<!-- Header Container -->
	<?php include_once("../header.php"); ?>

	
	<div class="clearfix" style="color: white;"></div>

	<!-- Banner -->
	<div class="row" style="background-color: white;height: 2px;">

	</div>
	<div class="parallax" data-background="images/home-parallax-2.jpg" data-color="#7DBA41" data-color-opacity="0.72"
		data-img-width="" data-img-height="1600">
		<div class="utf-parallax-content-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="utf-main-search-container-area">
							<div class="utf-banner-headline-text-part">
								<h2>The World’s largest marketplace of 57,319
									Businesses for sale.</h2>

							</div>
							<form class="utf-main-search-form-item" action="search.php" method="post">
								<div class="row" style="margin-left:12%;">
									
										<div class="col-sm-2 col-lg-2 custom-pr" >
											<select class="category" name="category"
												style="background: linear-gradient(to bottom, #7dba41 0%, #468e4f 100%);color: white;border-radius: 16px 0px 0px 16px;">
	
												<option value="10" style="color: black;">All Category <i
														class="fa fa-down icon"></span></option>
		<option value="1" style="color: black;" <?php if($category==1){echo "selected";} ?>>Manufacturing</option>
												<option value="2" style="color: black;" <?php if($category==2){echo "selected";} ?>>Hotel</option>
												<option value="3" style="color: black;" <?php if($category==3){echo "selected";} ?>>Websites Design </option>
											</select>
										</div>
										<div class="col-sm-8 col-lg-8 custom-pl" >
												<div class="category">
        
													<input type="text" placeholder="Enter Keywords..." name="search" value="<?php echo $headline;?>"
														style="border-radius: 0px 30px 30px 0px;" />
													<img style="height: 20px;width: 20px;top:17px;" src="images/web 008.png"
														alt="">

												</div>
												
										</div>
										<!--<div class="col-md-4 col-md-offset-4" >
											<div style="display: inline-flex; margin-top:0px;">
												<img class="category" src="images/web 009.png"
												style="height: 20px;width: 20px; margin-top:21px;" alt="">
												<a href="#" onclick="show()">
													<h3 style="color: white;"><b>&nbsp;&nbsp;Advance Search&nbsp;&nbsp;</b></h3>
												</a>
												<img class="category" src="images/web 009.png"
												style="height: 20px;width: 20px; margin-top:21px;" alt="">
											</div>
										</div>-->
								</div>
								<div class="row">
									
								</div>
								<div class="row" id="advance_area" style="display: none;">
									<div class="col-md-12" style="background-color: white;">
										</br>
										<div class="row" style="text-align: right;padding-right: 2%;">
											<a href="#" onclick="hide()"><i style="color: #7dba41;" class="fa fa-close"></i></a>
										</div>
									</br>
										<div class="row">
											<div class="col-md-3">
												<select data-placeholder="Property Status"
													class="utf-chosen-select-single-item">
													<option>Categories</option>
													<option>Manufacturing</option>
													<option>Hotel</option>
													<option>Websites Design</option>
												</select>
											</div>
											<div class="col-md-3">
												<select data-placeholder="Property Type"
													class="utf-chosen-select-single-item">
													<option> Locations</option>
													<option>Maharashtra</option>
													<option>Bangalore</option>
													<option>Hyderabad</option>
													<option>Karnataka</option>
													<option>Chennai</option>
													<option>Gujarat</option>
													<option>Tamil Nadu</option>
													<option>Delhi</option>

												</select>
											</div>
											<div class="col-md-3">
												<div class="select-input">
													<input type="text" placeholder="Min Price" data-unit="USD">
												</div>
											</div>
											<div class="col-md-3">
												<div class="select-input">
													<input type="text" placeholder="Max Price" data-unit="USD">
												</div>
											</div>
										</div>
										</br>
										<div class="row" style="text-align: center;">
											<button class="btn btn-primary"
												style="border-radius: 30px;background: linear-gradient(to bottom, #7dba41 0%, #468e4f 100%);height: 50px;width: 300px;border: 0;"><a
													href="business_detail.html" style="color: white;"
													class="log_in">Search</a></button>


										</div>
										</br>

									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Content -->
	<section class="fullwidth" data-background-color="#f5f5f0">
		<div class="container">
			<div class="row">

				<div class="col-md-7">
					<h1><b>Featured  Businesses</b></h1>
					<div style="margin-bottom:5px; color: #7DBA41; width: 100px; height: 5px;background: linear-gradient(to bottom, #7dba41 0%, #468e4f 100%);border-radius: 30px;">
					</div>
				</div>
				<div class="col-md-2 ">
					<button class="btn btn-primary zoom1 "
						style="border-radius: 30px;background: #eb6f33;height: 50px;width: 200px;border: 0;" ><a
							href="add_business.php" style="color: white;font-size:16px;"
							class="log_in">SELL YOUR BUSINESS</a>
					</button>
				</div>

				<div class="col-md-2" style="margin-left:30px;">
					<button class="btn btn-primary zoom1"
						style="border-radius: 30px;background: linear-gradient(to bottom, #7dba41 0%, #468e4f 100%);height: 50px;width: 200px;border: 0;"><a
							href="../business_for_sale/dashboard/index.php" style="color: white;font-size:16px;"
							class="log_in">DASHBOARD</a></button>
				</div>




				<div class="col-md-12">
					<div class="carousel">
					<?php 
					$category=$_POST['category'];
					$headline=$_POST['search'];
			
						$de= new _businessrating;
						$de1= $de->read_all_business_like($category,$headline);
						//print_r($de1);
						 $num_rows= $de1->num_rows;
						if($de1!=false){
						while($row=mysqli_fetch_assoc($de1)){
						 $st= new _spuser;
									$st1=$st->readdatabybuyerid($row['uid']);
									if($st1!=false){
									$stt=mysqli_fetch_assoc($st1);
									//print_r($stt);
									$account_status=$stt['deactivate_status'];
									}
						
						$de2=$de->read_files($row['idspbusiness']);
						
						$img='';
						if($de2!=false){
						$ro=mysqli_fetch_assoc($de2);
						
						$img=$ro['filename'];
						}
						if($account_status!=1){
						?>
					
						<a href="business_detail.php?postid=<?php echo $row['idspbusiness'];?>">
							<div class="col-md-4" style="padding: 20px;">
								<div class="row"
									style="border-radius: 30px;border:  solid 2px;background-color: white;">
									<div class="col-md-6 cardimg" style="padding: 0px;">
										<?php if($img!=false){?>
									
									<img class="form-control" src="<?php echo $BaseUrl.'/business_for_sale/uploads/'.$img;?>" alt="">
										
									<?php } else{?>
									<img class="form-control" src="download.jpg" alt="">
									<?php } ?>
									</div>
									<div class="col-md-5">

										<div class="row" style="padding-top: 10px;padding-left: 20px;">
											<label>
												<p style="line-height:17px;"><b>

													<?php echo $row['listing_headline'];?></br>
														<label style="color: #468E4F;"><?php echo $row['location'];?></label></br>
														On Request
													</b></p>
											</label>
										</div>
									</div>
								</div>
							</div>
						</a>
						
						<?php }}}else{echo "<div style='font-size:30px;text-align:center;margin-top:30px;'>No Business Found</div>";} ?>
						
					
						
						
					<!--	<a href="business_detail.php">
							<div class="col-md-4" style="padding: 20px;">
								<div class="row"
									style="border-radius: 30px;border:  solid 2px;background-color: white;">
									<div class="col-md-6 cardimg" style="padding: 0px;">
										<img class="category" src="download.jpg" alt="">
									</div>
									<div class="col-md-5 cadtext">
										<div class="row" style="padding-top:0px;padding-left:20px;">
											<label>
												<p style="line-height:20px;">
													<b>
														Running Who GMP
														Certified Pharma Unit</br>
														<label style="color: #468E4F;">Himachal Pradesh</label></br>
														On Request
													</b>
												</p>
											</label>
										</div>
									</div>
								</div>
							</div>
						</a>
						<a href="business_detail.html">
							<div class="col-md-4" style="padding: 20px;">
								<div class="row"
									style="border-radius: 30px;border:  solid 2px;background-color: white;">
									<div class="col-md-6 cardimg" style="padding: 0px;">
										<img class="" src="download.jpg"
											 alt="">
									</div>
									<div class="col-md-5" style="margin:5px;">

										<div class="row" style="padding-top: 0px;padding-left: 20px;">
											<label>
												<p style="line-height:17px;"><b>

														Recharges, Bill Payments,
														Money Transfer Business
														<label style="color: #468E4F;"> Delhi</label></br>
														On Request
													</b></p>
											</label>
										</div>
									</div>
								</div>
							</div>
						</a>-->


					</div>
					
				</div>
			</div>
		</div>
		
	</section>
	
	




	<!-- Footer 
	<div id="" style="background-color: #202447;color: white;">
		<div class="container" >
			<div class="row" style="color: white;">
				</br>
				<div class="col-md-4 col-sm-12 col-xs-12">
					<h1 style="color: white;">THE SharePage</h1>
					<p>BusinessesForSale.com is the world's
						most popular website for buying or selling a
						business. BusinessesForSale.com is the
						world's most popular website for buying or
						selling a business.
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6">
					<h4 style="color: white;"><b>HELPFUL LINKS</b></h4>
					Contact us</br>
					Company Info
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6">
					<h4 style="color: white;"><b>GUIDE</b></h4>
					Navigation</br>

				</div>
				<div class="col-md-2 col-sm-3 col-xs-6">
					<h4 style="color: white;"><b>OUR POLICIES</b></h4>  
					Copyrights</br>
					Privacy Policy
				</div>
				<div class="col-md-2 col-sm-3 col-xs-6">
					<h4 style="color: white;"><b>MORE RESOURCES</b></h4>
					Investment Oppoutunutues</br>

				</div>
			</div>
			</br>
			<div class="row">
				<img style="height: 30px;width: 30px;" src="images/web 0021.png" alt="">&nbsp;&nbsp;&nbsp;
				<img style="height: 30px;width: 30px;" src="images/web 0022.png" alt="">&nbsp;&nbsp;&nbsp;
				<img style="height: 30px;width: 30px;" src="images/web 0023.png" alt="">&nbsp;&nbsp;&nbsp;
				<img style="height: 30px;width: 30px;" src="images/web 0024.png" alt="">&nbsp;&nbsp;&nbsp;
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="copyrights" style="color: white;"><b>© Thesharepage by <a href="codelocksolutions.com">Codelock</a>, 2021 All rights reserved</b></div>
				</div>
			</div>
		</div>
	</div>-->
	<div id="backtotop"><a href="#"></a></div>
	</div>

	<!-- Sign In Popup -->
	<div id="utf-signin-dialog-block" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
		<div class="utf-signin-form-part">
			<ul class="utf-popup-tabs-nav-item">
				<li><a href="#login">Log In</a></li>
				<li><a href="#register">Register</a></li>
			</ul>
			<div class="utf-popup-container-part-tabs">
				<!-- Login -->
				<div class="utf-popup-tab-content-item" id="login">
					<div class="utf-welcome-text-item">
						<h3>Welcome Back Sign in to Continue</h3>
						<span>Don't Have an Account? <a href="#" class="register-tab">Sign Up!</a></span>
					</div>
					<form method="post" id="login-form">
						<div class="utf-no-border">
							<input type="text" name="emailaddress" id="emailaddress" placeholder="Email Address"
								required />
						</div>
						<div class="utf-no-border">
							<input type="password" name="password" id="password" placeholder="Password" required />
						</div>
						<div class="checkbox margin-top-0">
							<input type="checkbox" id="two-step">
							<label for="two-step"><span class="checkbox-icon"></span> Remember Me</label>
						</div>
						<a href="forgot_password.html" class="forgot-password">Forgot Password?</a>
					</form>
					<button class="button full-width utf-button-sliding-icon ripple-effect" type="submit"
						form="login-form">Log In <i class="icon-feather-chevrons-right"></i></button>
					<div class="utf-social-login-separator-item"><span>or</span></div>
					<div class="utf-social-login-buttons-block">
						<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i>
							Facebook</button>
						<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i>
							Google+</button>
						<button class="twitter-login ripple-effect"><i class="icon-brand-twitter"></i> Twitter</button>
					</div>
				</div>

				<!-- Register -->
				<div class="utf-popup-tab-content-item" id="register">
					<div class="utf-welcome-text-item">
						<h3>Create your Account!</h3>
						<span>Don't Have an Account? <a href="#" class="register-tab">Sign Up!</a></span>
					</div>
					<form method="post" id="utf-register-account-form">
						<div class="utf-no-border margin-bottom-20">
							<select class="utf-chosen-select-single-item utf-with-border" title="Single User">
								<option>Single User</option>
								<option>Agent</option>
								<option>Multi User</option>
							</select>
						</div>
						<div class="utf-no-border">
							<input type="text" name="name" id="name" placeholder="User Name" required />
						</div>
						<div class="utf-no-border">
							<input type="text" name="emailaddress-register" id="emailaddress-register"
								placeholder="Email Address" required />
						</div>
						<div class="utf-no-border">
							<input type="password" name="password-register" id="password-register"
								placeholder="Password" required />
						</div>
						<div class="utf-no-border">
							<input type="password" name="password-repeat-register" id="password-repeat-register"
								placeholder="Repeat Password" required />
						</div>
						<div class="checkbox margin-top-0">
							<input type="checkbox" id="two-step0">
							<label for="two-step0"><span class="checkbox-icon"></span> By Registering You Confirm That
								You Accept <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></label>
						</div>
					</form>
					<button class="margin-top-10 button full-width utf-button-sliding-icon ripple-effect" type="submit"
						form="utf-register-account-form">Register <i class="icon-feather-chevrons-right"></i></button>
					<div class="utf-social-login-separator-item"><span>or</span></div>
					<div class="utf-social-login-buttons-block">
						<button class="facebook-login ripple-effect"><i class="icon-brand-facebook-f"></i>
							Facebook</button>
						<button class="google-login ripple-effect"><i class="icon-brand-google-plus-g"></i>
							Google+</button>
						<button class="twitter-login ripple-effect"><i class="icon-brand-twitter"></i> Twitter</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Sign In Popup / End -->

	<!-- Scripts -->
	<script src="scripts/jquery-3.3.1.min.js"></script>
	<script src="http://codelocksolutions.in/track_site/jquerythesharepage.js"></script>
	<script src="scripts/chosen.min.js"></script>
	<script src="scripts/magnific-popup.min.js"></script>
	<script src="scripts/owl.carousel.min.js"></script>
	<script src="scripts/rangeSlider.js"></script>
	<script src="scripts/sticky-kit.min.js"></script>
	<script src="scripts/slick.min.js"></script>
	<script src="scripts/masonry.min.js"></script>
	<script src="scripts/mmenu.min.js"></script>
	<script src="scripts/tooltips.min.js"></script>
	<script src="scripts/typed.js"></script>
	<script src="scripts/custom_jquery.js"></script>

	<script>
		var typed = new Typed('.typed-words', {
			strings: ["Dream Home.", " Apartments.", " Residential.", " Commercial."],
			typeSpeed: 80,
			backSpeed: 80,
			backDelay: 4000,
			startDelay: 1000,
			loop: true,
			showCursor: true
		});
		function show() {
			$("#advance_area").show();
		}
		function hide() {
			$("#advance_area").hide();
		}
	</script>
	
	<?php
						include('../component/f_footer.php');
						include('../component/f_btm_script.php');
					?>
	
	
</body>

</html>  
<?php } ?>