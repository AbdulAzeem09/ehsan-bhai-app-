<?php
    require_once("../../univ/baseurl.php" );
	session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="dashboard/";
		include_once ("../../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		
		$pageactive = 51;
	?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php include('../../component/f_links.php');?>
			<!-- ===========DSHBOARD LINKS================= -->
			<?php include('../../component/dashboard-link.php');?>
			<!-- ===========PAGE SCRIPT==================== -->
			
			<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
			<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
			
		</head>
		<body class="bg_gray">
			<?php
				
				include_once("../../header.php");
			?>
			
			<section class="">
				<div class="container-fluid no-padding">
					<div class="row">
						<!-- left side bar -->
						<div class="col-md-2 no_pad_right">
							<?php
								include('../../component/left-dashboard.php');
							?>
						</div>
						<!-- main content -->
						<div class="col-md-10 no_pad_left">
							<div class="rightContent">
								
								<!-- breadcrumb -->
								<section class="content-header">
									<h1>My Default Currency</h1>
									<ol class="breadcrumb">
										<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
										<li class="active">Currency</li>
									</ol>
								</section>
								
								<div class="content" style="margin-top:30px">
								
											<div class="box box-success">
												<div class="box-header">
													
												</div><!-- /.box-header -->
												<div class="box-body">
														
														
														<div class="container col-md-12">
															<form method="post">
																<div class="row">
																	
																	<?php
																		$b = new _currency;
																		$data = $b->readCurrency();	
																	    $uid = $_SESSION['uid'];
																		
																		$dataucurrency = $b->readCurrencyuser($uid);
																		$rowucurrency = mysqli_fetch_array($dataucurrency);
																		
																		if(isset($_POST['savecurrencydetail'])){
																			$b->updateCurrencyuser($uid, $_POST['addcrrency']);
																			$re = new _redirect;
																			$location = $BaseUrl."/dashboard/currency/";
																			$re->redirect($location);
																		}
																	?>
																		
																	<div class="col-md-8">
																		<div class="form-group">
																				<select class="form-control" style="height:44px;" name="addcrrency" disabled>
																				<option>Select Currency</option>
																				



<option value="USD" selected="selected">United States Dollars</option>
	<option value="EUR">Euro</option>
	<option value="GBP">United Kingdom Pounds</option>
	<option value="DZD">Algeria Dinars</option>
	<option value="ARP">Argentina Pesos</option>
	<option value="AUD">Australia Dollars</option>
	<option value="ATS">Austria Schillings</option>
	<option value="BSD">Bahamas Dollars</option>
	<option value="BBD">Barbados Dollars</option>
	<option value="BEF">Belgium Francs</option>
	<option value="BMD">Bermuda Dollars</option>
	<option value="BRR">Brazil Real</option>
	<option value="BGL">Bulgaria Lev</option>
	<option value="CAD">Canada Dollars</option>
	<option value="CLP">Chile Pesos</option>
	<option value="CNY">China Yuan Renmimbi</option>
	<option value="CYP">Cyprus Pounds</option>
	<option value="CSK">Czech Republic Koruna</option>
	<option value="DKK">Denmark Kroner</option>
	<option value="NLG">Dutch Guilders</option>
	<option value="XCD">Eastern Caribbean Dollars</option>
	<option value="EGP">Egypt Pounds</option>
	<option value="FJD">Fiji Dollars</option>
	<option value="FIM">Finland Markka</option>
	<option value="FRF">France Francs</option>
	<option value="DEM">Germany Deutsche Marks</option>
	<option value="XAU">Gold Ounces</option>
	<option value="GRD">Greece Drachmas</option>
	<option value="HKD">Hong Kong Dollars</option>
	<option value="HUF">Hungary Forint</option>
	<option value="ISK">Iceland Krona</option>
	<option value="INR">India Rupees</option>
	<option value="IDR">Indonesia Rupiah</option>
	<option value="IEP">Ireland Punt</option>
	<option value="ILS">Israel New Shekels</option>
	<option value="ITL">Italy Lira</option>
	<option value="JMD">Jamaica Dollars</option>
	<option value="JPY">Japan Yen</option>
	<option value="JOD">Jordan Dinar</option>
	<option value="KRW">Korea (South) Won</option>
	<option value="LBP">Lebanon Pounds</option>
	<option value="LUF">Luxembourg Francs</option>
	<option value="MYR">Malaysia Ringgit</option>
	<option value="MXP">Mexico Pesos</option>
	<option value="NLG">Netherlands Guilders</option>
	<option value="NZD">New Zealand Dollars</option>
	<option value="NOK">Norway Kroner</option>
	<option value="PKR">Pakistan Rupees</option>
	<option value="XPD">Palladium Ounces</option>
	<option value="PHP">Philippines Pesos</option>
	<option value="XPT">Platinum Ounces</option>
	<option value="PLZ">Poland Zloty</option>
	<option value="PTE">Portugal Escudo</option>
	<option value="ROL">Romania Leu</option>
	<option value="RUR">Russia Rubles</option>
	<option value="SAR">Saudi Arabia Riyal</option>
	<option value="XAG">Silver Ounces</option>
	<option value="SGD">Singapore Dollars</option>
	<option value="SKK">Slovakia Koruna</option>
	<option value="ZAR">South Africa Rand</option>
	<option value="KRW">South Korea Won</option>
	<option value="ESP">Spain Pesetas</option>
	<option value="XDR">Special Drawing Right (IMF)</option>
	<option value="SDD">Sudan Dinar</option>
	<option value="SEK">Sweden Krona</option>
	<option value="CHF">Switzerland Francs</option>
	<option value="TWD">Taiwan Dollars</option>
	<option value="THB">Thailand Baht</option>
	<option value="TTD">Trinidad and Tobago Dollars</option>
	<option value="TRL">Turkey Lira</option>
	<option value="VEB">Venezuela Bolivar</option>
	<option value="ZMK">Zambia Kwacha</option>
	<option value="EUR">Euro</option>
	<option value="XCD">Eastern Caribbean Dollars</option>
	<option value="XDR">Special Drawing Right (IMF)</option>
	<option value="XAG">Silver Ounces</option>
	<option value="XAU">Gold Ounces</option>
	<option value="XPD">Palladium Ounces</option>
	<option value="XPT">Platinum Ounces</option>



















																				</select>
																		</div>
																	</div>
																	
																	<div class="col-md-4">
																	<!--	<button type="submit" style="margin-bottom:25px"  name="savecurrencydetail"class="btn btn-submit db_btn db_primarybtn">Save</button>-->
																	</div>
																</div>
															</form>
														</div>								
														
												</div>
											</div>
											
											
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			
			
			<?php include('../../component/f_footer.php');?>
			<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
			<?php include('../../component/f_btm_script.php'); ?>
			<script>
				$("#savebankdetail").click(function(event) {
				event.preventDefault();
				var spProfile_idspProfile = "<?php echo $_SESSION['pid']; ?>";
				var uid= $("#uid").val()
				var Bankuser= $("#spBankuser").val()
				var Bankname = $("#spBankname").val()
				var Banknumber = $("#spBanknumber").val()
				var Branchnumber = $("#spBranchnumber").val()
				var Accountnumber = $("#spAccountnumber").val()
				var Bankcode = $("#spBankcode").val()
				
				if(Bankuser == "" &&  Bankname == "" && Banknumber == "" && Branchnumber == "" && Accountnumber == "" && Bankcode == ""){
				
				/* $("#shipadd_error").text("Please Enter Address.");*/
				
				$("#spBankuser_error").text("Please Enter Name of Account Holder .");
				$("#spBankuser").focus();
				
				$("#spBankname_error").text("Please Enter Bank Name.");
				$("#spBankname").focus();
				
				$("#spBanknumber_error").text("Please Enter Bank Number.");
				$("#spBanknumber").focus();
				
				
				$("#spBranchnumber_error").text("Please Enter Branch Number.");
				$("#spBranchnumber").focus();
				
				$("#spAccountnumber_error").text("Please Enter Account Number.");
				$("#spAccountnumber").focus();
				
				
				$("#spBankcode_error").text("Please Enter IFSC Code.");
				$("#spBankcode").focus();
				
				return false;
				}else if (Bankuser == "") {
				
				$("#spBankuser_error").text("Please Enter Name of Account Holder .");
				$("#spBankuser").focus();
				
				
				return false;
				}else if (Bankname == "") {
				
				$("#spBankname_error").text("Please Enter Bank Name.");
				$("#spBankname").focus();
				
				return false;
				}else if (Banknumber == "") {
				$("#spBanknumber_error").text("Please Enter Bank Number.");
				$("#spBanknumber").focus();
				
				return false;
				}else if (Branchnumber == "") {
				$("#spBranchnumber_error").text("Please Enter Branch Number.");
				$("#spBranchnumber").focus();
				
				return false;
				}else if (Accountnumber == "") {
				
				$("#spAccountnumber_error").text("Please Enter Account Number.");
				$("#spAccountnumber").focus();
				
				
				return false;
				}else if (Bankcode == "") {
				$("#spBankcode_error").text("Please Enter IFSC Code.");
				$("#spBankcode").focus();
				
				return false;
				}
				
				
				
				
				else{
				
				$.ajax({
				type: 'POST',
				url: '/my-profile/addbankdetail.php',
				data: {
				spProfile_idspProfile:spProfile_idspProfile,
				uid: uid,
				spBankusername: Bankuser,
				spBankname: Bankname,
				spBanknumber: Banknumber,
				spBranchnumber: Branchnumber,
				spAccountnumber: Accountnumber,
				spBankcode: Bankcode
				},
				
				success: function(response){ 
				
				//  console.log(data);
				
				
				swal({
				
				title: "Bank Detail Added Successfully!",
				type: 'success',
				showConfirmButton: true
				
				},
				function(id) {
				
				window.location.reload();
				
				
				});
				
				
				}
				});
				
				}
				
				
				
				});
				//});
			</script>
			
			
			
		</body> 
	</html>
	<?php
	} ?>
