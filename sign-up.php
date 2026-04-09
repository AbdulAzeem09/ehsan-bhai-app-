<?php
	if(isset($_SESSION)){
		session_start();
		session_destroy(); 
	}
	
	include("univ/baseurl.php");
	session_start();
	$event_user = 0;
	$registration_type  = "";
	$ticket_price  = "";
	$ticket_gst = "";
	if(isset($_POST["event_user"])){
		$event_user = isset($_POST["event_user"]) ? 1 : 0;
		$event_id = isset($_POST["event_id"]) ? $_POST["event_id"] : "";
		$registration_type = isset($_POST["registration_type"]) ? $_POST["registration_type"] : "";
		$ticket_price = isset($_POST["ticket_price"]) ? $_POST["ticket_price"] : "";
		$discountAmt = isset($_POST["discountAmt"]) ? $_POST["discountAmt"] : "";
		$ticket_gst = isset($_POST["ticket_gst"]) ? $_POST["ticket_gst"] : "";
		// print_r($event_id);
		$event = array();
		$event['event_id'] = $event_id;
		$event['registration_type'] = $registration_type;
		$event['ticket_price'] = $ticket_price;
		$event['discountAmt'] = $discountAmt;
		$event['ticket_gst'] = $ticket_gst;

		$_SESSION['event_user'] = $event_user;
		$_SESSION['event'] = $event;
		$_SESSION['afterlogin'] = 'page/event_details.php?page=event_details&event_id='.$event_id;
		$_SESSION['formType'] = 'event';
		unset($_SESSION["phone_otp"]);
		//print_r($_SESSION);
		function sp_autoloader($class)
		{
		include 'mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		if (isset($_SESSION['uid']) && $event_user == 1) {
			header("Location: $BaseUrl/page/event_details.php?page=event_details&event_id=$event_id");
		}elseif(isset($_SESSION['uid'])){
			header("Location: $BaseUrl/timeline/");
		}
	}
	if(isset($_POST["sponsor_user"])){
		$sponsor_user = isset($_POST["sponsor_user"]) ? 1 : 0;

		$sponsor_id = isset($_POST['sponsor_id']) ? $_POST['sponsor_id'] : "";
		$sponsor_name = isset($_POST['sponsor_name']) ? $_POST['sponsor_name'] : "";
		$sponsorGst = isset($_POST['gst']) ? $_POST['gst'] : "";
		$sponsor_discountAmt = isset($_POST['sponsor_discountAmt']) ? $_POST['sponsor_discountAmt'] : "";
		$sponsorTotalPrice = isset($_POST['total_price']) ? $_POST['total_price'] : "";
		$sponsorDescription = isset($_POST['sponsorDescription']) ? $_POST['sponsorDescription'] : "";


		$sponsor = array();
		$sponsor['sponsor_id'] = $sponsor_id;
		$sponsor['registration_type'] = $sponsor_name;
		$sponsor['sponsorGst'] = $sponsorGst;
		$sponsor['sponsor_discountAmt'] = $sponsor_discountAmt;
		$sponsor['sponsorTotalPrice'] = $sponsorTotalPrice;
		$sponsor['sponsorDescription'] = $sponsorDescription;

		$_SESSION['sponsor_user'] = $sponsor_user;
		$_SESSION['sponsor'] = $sponsor;
		$_SESSION['formType'] = 'sponsor';
		$_SESSION['afterlogin'] = 'page/event_details.php?page=event_details&event_id='.$sponsor_id;
		unset($_SESSION["phone_otp"]);
		//print_r($_SESSION);
		function sp_autoloader($class)
		{
			include 'mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		if (isset($_SESSION['uid']) && $sponsor_user == 1) {
			header("Location: $BaseUrl/page/event_details.php?page=event_details&event_id=$sponsor_id");
		}elseif(isset($_SESSION['uid'])){
			header("Location: $BaseUrl/timeline/");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<style>
		.error,
		.erormsg {
		color: #F00 !important;
		/* max-height: 70px!important; */
		}
	</style>
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
	<!-- telephone -->
	<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/country/css/intlTelInput.css">
	<script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="image/bootstartp-5/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" href="assets/css/signupcss/all.css">
        <link rel="stylesheet" href="assets/css/signupcss/all.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> -->
    	<link rel="stylesheet" href="assets/css/signupcss/style.css">
    	<title>Create Account</title>
   </head>

<body> 
    <section class="container log_in ">
        <div class="col-12 img text-center d-grid justify-content-center">
            <div class="d-flex justify-content-center">
            <a href="<?php echo $BaseUrl; ?>">
            <img src="image/logosharepage 1.png" class="img-fluid" alt=""></a></div>
            <h2 class="head pb-1">The SharePage</h2>
        </div>
        <div class=" col-12 form ">
			<div class="row">
			<form id="buRegForm_74" class="col-12 p-0"  onsubmit="return validateMyForm()" method="post" action="authentication/register.php" autocomplete="chrome-off">
                <h3 class="text-center mb-1">Create Account</h3>
                <hr>
				<script>
					document.addEventListener('DOMContentLoaded', function() {
						var emailInput = document.getElementById('spUserEmail');
						emailInput.addEventListener('focus', function() {
							emailInput.setAttribute('autocomplete', 'off');
						});
					});
				</script>
				<input type="hidden" class="spProfileType_idspProfileType" name="spProfileType_idspProfileType_" value="4">

				<input id="uType" type="hidden" value="3">
				<input type="hidden" name="spUserIpLastLogin" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
				<input type="hidden" name="txtCountryCode" id="txtCountryCode" value="+1" />
				<input type="hidden" name="event_user" id="event_user" value="<?php echo $event_user; ?>" />
				<input type="hidden" name="registration_type" id='registration_type' value='<?php echo $registration_type; ?>' />
				<input type="hidden" name="ticket_price" id="ticket_price" value="<?php echo $ticket_price; ?>" />
				<input type="hidden" name="ticket_gst" id="ticket_gst" value="<?php echo $ticket_gst; ?>" />

                <div class="email d-grid">
                    <label for="" class="my-2">Email<span class="req_star">*</span></label>
					<input type="text" placeholder="Enter Email"  class="form-control spRegisterEmail reg-email" id="spUserEmail" name="spUserEmail" autocomplete="off" value="">
					<span class="spRegisterEmail" id="checkemail" style="color: red"></span>
					<span class="spUserEmail erormsg" id="email2"></span>
                </div>

                <div class=" pass d-grid">
                    <label for="" class="my-2">Password<span class="req_star">*</span></label>
                    <input type="password" placeholder="Enter Password" class="form-control" id="bpass" name="spUserPassword" minlength="8" maxlength="16" autocomplete="off" autocomplete="new-password">
					<a href="JavaScript:void(0);" class="reveal"> <i class="fa-solid fa-eye-slash"></i></a>
				</div>
				<span class="red erormsg" id="pass1"> </span>
	               <span class="bpass erormsg"></span>
                <div class="ref d-grid">
                    <label for="" class="my-2">Referral Code (Optional)</label>
					<input type="text" class="form-control" style="height:35px;" id="refferalcodeused" name="refferalcodeused" value="<?php if (isset($_GET['rfrcode'])) {
					echo $_GET['rfrcode'];
					}   ?>" <?php if (isset($_GET['rfrcode'])) {
					echo "readonly";
					}   ?>  >  
                </div>
                <!--div class="ref_cnt pt-lg-2 pb-lg-1 pt-2 pb-2 d-flex">
					<a class="pointer" id="auto-generate">Click here</a>
					<br>
					<span class="ps-1 agr_cnt">if you don’t have a referral code</span>
                </div-->
				<span class=" erormsg" id="refferalError"> <?php if (isset($_SESSION["Error"])) { 
					echo $_SESSION["Error"];
        			unset($_SESSION["Error"]); } ?>
				</span>
                <div class="agree_con py-lg-2 py-1 d-flex align-items-center ">
				<label class="d-flex align-items-center m-0"><input type="checkbox" class="form-check" name="terms" id="terms" value="1">
                    <span class="ps-2 agr_cnt" >Agree to our</span><a href="<?php echo $BaseUrl; ?>/page/?page=terms_and_condition" class="ps-2 agr_cnt " target=_blank>Terms & Conditions</a></label>
                </div>
				<b><span class="spTerms erormsg red"></span></b>
                <div class="capt d-grid">
                    <label for="" class="my-2">Human Verification<span>*</span></label> 
					<a href="javascript:void(0);" class="refresh" id="clikk"><i class="fa fa-refresh"></i></a> <span class="red captcha erormsg"></span>
                    <div class="d-flex">
                      <input type="text" name="captcha" id="captcha" class="col-md-9 col-8 captcha-code"  maxlength="6" size="6" placeholder="Type here" value="<?php //echo $_SESSION['cap_code']; ?>" />					
						 <div class="col-md-3 col-4 captcha text-center captchatext" style="user-select:none;"><?php if(isset($ranStr)){ echo $ranStr; }?></div>
							<input type="hidden" id="txtCaptcha" value="<?php //echo $_SESSION['cap_code']; ?>">
                    </div>
					<span class=" erormsg" id="captchaError"></span>
                </div>
                <div class="btns ">
                    <input type="submit" class="text-uppercase" value="Signup" >
					<span class="d-flex ">Already Have an Account? <a href="<?php echo $BaseUrl; ?>/login.php" class="px-2">login</a></span>
                </div>
            </form>
        </div>
    </section>



	<?php include('component/f_btm_script.php'); //} 
	?>
	<!-- telephone -->
	<script src="<?php echo $BaseUrl; ?>/assets/css/country/js/intlTelInput.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
	<script>
		var input = document.getElementById('address');
		if(input){
			var autocomplete = new google.maps.places.Autocomplete(input);
		}

		function onlyNumberKey(evt) {
			// Only ASCII character in that range allowed
			var ASCIICode = (evt.which) ? evt.which : evt.keyCode
			if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
			return false;
			return true;
		}

		$("#spUserPhone").on("input", function() {
			if (/^0/.test(this.value)) {
				this.value = this.value.replace(/^0/, "")
			}
		})
	</script>

	<script type="text/javascript">
		$(function() {
			$('#respUserEphone').keypress(function(event) {
			if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
				event.preventDefault(); //stop character from entering input
			}
		});
		});
	</script>

	<script>
		function validateMyForm() {
			var d=0;
			var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			
			var email = document.getElementById("spUserEmail").value;
			if (email == 0 || email == "") {
				document.getElementById("email2").innerHTML = "<b>This field is required</b>";
				d=1;
			}
			else {
				if (!emailPattern.test(email)) {
				// Email is not valid
				document.getElementById("email2").innerHTML = "<b>Email is not valid</b>";
				d = 1;
				} else {
				// Email is valid
				document.getElementById("email2").innerHTML = "";
				}
			}

			var bpass = document.getElementById("bpass").value;
			var passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+}{":;?/.,><]).{8,}$/;
			if (bpass == 0 || bpass == "") {
				document.getElementById("pass1").innerHTML = "<b>This field is required</b>";
				d = 1;
			} else {
				if (!passwordRegex.test(bpass)) {
					document.getElementById("pass1").innerHTML = "<b>Please include uppercase, lowercase, number and a special character</b>";
					d = 1;
				} else {
					document.getElementById("pass1").innerHTML = "";
				}
			}


			// Get the entered captcha value
			var enteredCaptcha = document.getElementById('captcha').value;

			// Get the actual captcha value
			var actualCaptcha = document.getElementById('txtCaptcha').value;

			// Check if the entered captcha is empty or not
			if (enteredCaptcha == 0 || enteredCaptcha == "") {
					document.getElementById("captchaError").innerHTML = "<b>This field is required</b>";
					d = 1;
			} else {
				if (enteredCaptcha === actualCaptcha) {
					console.log('Captcha matches!');
					
					document.getElementById("captchaError").innerHTML = "";
				} else {
					console.log('Captcha does not match!');
					
					document.getElementById("captchaError").innerHTML = "<b>Incorrect captcha</b>";
					d = 1;
				}
			}



			var reffera = document.getElementById("refferalcodeused").value;
			if (reffera == 0 || reffera == "") {
				//alert('12');
				//document.getElementById("refferalError").innerHTML = "<b>This field is required</b>";
				//d=1;
			}else {
				document.getElementById("refferalError").innerHTML = "";
			}

			if($("#terms").prop('checked') == true){
				$(".spTerms").text("");
			}else{
				d=1;
				$(".spTerms").text("This field is required");
			}
	
			if(d==1){
				return false;
			}
			else{
				var formData = new FormData(form);
				$.ajax({
					url: "authentication/register.php",
					method: 'POST',
					data: formData,
					contentType: false,
					processData: false,
					cache: false,
					success: function(html){
						alert(html);
						let result = html.trim();
						if(result=="Wrong"){
							// alert('222');
							$(".rfc").html("Referral Code is Invalid");
							//$("#refferalcodeused").val("");
							document.getElementById('refferalcodeused').value = "";
						}
						if(html == 1){
							//alert('success');
							window.location = BASE_URL+"/verifyemail.php";
						}
						if (html == '1') {
							$("#buregister").button('reset');
							if (localStorage.getItem(formIdentifier) != null) {
								localStorage.removeItem(formIdentifier);
								console.log("form storage removed");
							}
							// window.location = BASE_URL+"/emailvarify.php";
							window.location = BASE_URL+"/otp.php";
						} 
						$("#results").append(html);
					}
				});
				return true;
			}
		}
	</script>

	<script> 
		function Checkphone(phone) {
			//alert(phone);
			$.ajax({ //Process the form using $.ajax()
				url       : 'check_phone.php', //Your form processing file URL
				type      : 'POST', //Method type
				data      : {postphone:phone}, //Forms name
				dataType  : '',
				success   : function(data) {
					//alert(data);
					if(data!=1){
						$(".respUserEphone").html(data);
						$("#respUserEphone").val("");
					}else{
						$(".respUserEphone").html("");
					}

				}
			});
		}

		$(document).ready(function() {

			$("#spUserEmail").autocomplete({
				disabled: true
			});


			$('#auto-generate').click(function(){
			if ($('#refferalcodeused').val() == '') {
			$('#refferalcodeused').val("LC6C2QUC");
			}
			});

			function generateReferralCode() {
			var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
			var referralCode = '';
			var codeLength = 8; 
			for (var i = 0; i < codeLength; i++) {
			referralCode += characters.charAt(Math.floor(Math.random() * characters.length));
			}

			return referralCode;
			}

			setTimeout(function() {
			$('#clikk').click();
			}, 2000);
		});

		$('.datepicker').datetimepicker({
			endDate: '-1d',
			weekStart: 1,
			todayBtn: 1,
			autoclose: 1,
			todayHighlight: 1,
			startView: 2,
			forceParse: 0,
			minView: 2,
		});

		var input = document.querySelector("#respUserEphone");
		if(input){
			window.intlTelInput(input, {
				preferredCountries: ['us', 'ca'],
				separateDialCode: true,
				utilsScript: "<?php echo $BaseUrl; ?>/assets/css/country/js/utils.js",
			});
		}
	</script>

	<script>
		function getaddress() {
			var address = $("#address").val()
			$.ajax({
				type: "POST",
				url: "address.php",
				cache: false,
				data: {
				'address': address
				},
				success: function(data) {
					var obj = JSON.parse(data);
					$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');
					$("#latitude").val(obj.latitude);
					$("#longitude").val(obj.longitude);
				}
			});
		}

		$(".op_address").on("click", function() {
			var addre = $(this).val();
			$("#address").val(addre);
		});

		$("body").on('click', '.reveal', function() {
			var input = $("#bpass");
			if (input.attr("type") === "password") {
			input.attr("type", "text");
			$(this).find('i').removeClass('fa-eye');
			$(this).find('i').addClass('fa-eye-slash');
			} else {
			input.attr("type", "password");
			$(this).find('i').removeClass('fa-eye-slash');
			$(this).find('i').addClass('fa-eye');
			}
		});

		$("body").on('click', '.reveal1', function() {
			var input = $("#respUserEnpass");
			if (input.attr("type") === "password") {
			input.attr("type", "text");
			$(this).find('i').removeClass('fa-eye');
			$(this).find('i').addClass('fa-eye-slash');
			} else {
			input.attr("type", "password");
			$(this).find('i').removeClass('fa-eye-slash');
			$(this).find('i').addClass('fa-eye');
			}
		});

		
		function populateForm() {
			if (localStorage.key(formIdentifier)) {
				const savedData = JSON.parse(localStorage.getItem(formIdentifier));
				if (savedData != null) {
					for (const element of formElements) {
						if (element.name in savedData) {
						element.value = savedData[element.name];
						}
					}
				}
			}
		}


	</script>
	<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"7038010c7e5e85bf","version":"2021.12.0","r":1,"token":"c014da5d01104438bf32930d27548771","si":100}' crossorigin="anonymous"></script>
		
	<script>
		
		$("#spUserCountry11").on("change", function () {
			//alert('===1');
			
			var countryId = this.value;
			//alert(country);
			$.post("lodeUserState_signup.php", {
				countryId: countryId
			}, function (r) {
				//alert(r);
				$(".loadUserState").html(r);
			});
			
		});
	</script>

	</body>
</html>
