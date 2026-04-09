<?php
include('../univ/baseurl.php');
include( "../univ/main.php");
require_once("../common.php");

session_start();
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "my-profile/";
	include_once ("../authentication/check.php");

}else{

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$p = new _spprofiles;
	$rpvt = $p->readProfiles($_SESSION["uid"]);
	if($rpvt != false){
$a = 0; //Business
$b = 0; //Freelacer
$c = 0; //Entertainment
$d = 0; //Personal
$e = 0; //Job seeker
$f = 0; //Dating
while($rows = mysqli_fetch_assoc($rpvt)){
if($rows['idspProfileType'] == 1) //Business
{
	$a++;
}

if($rows['idspProfileType'] == 2) //Freelancer
{
	$b++;
}

if($rows['idspProfileType'] == 3) //Entertainment
{
	$c++;
}

if($rows['idspProfileType'] == 4) //Personal
{
	$d++;
}

if($rows['idspProfileType'] == 5) //Job seeker
{
	$e++;
}

if($rows['idspProfileType'] == 6) //Dating
{
	$f++;
}
}
}

$pt = new _profiletypes;
$rpt = $pt->read();
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
//echo $u->ta->sql;
if($res != false){
	$ruser = mysqli_fetch_assoc($res);

	//echo '<pre>';print_r($ruser);die;
	$username = $ruser["spUserName"]; 
	$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 


	$useremail = $ruser["spUserEmail"]; 
	$useraddress = $ruser["spUserAddress"];
	$usercountry = $ruser["spUserCountry"]; 
	$userstate = $ruser["spUserState"]; 
	$usercity = $ruser["spUserCity"]; 
	$address = $ruser["address"]; 
}
?>


<!DOCTYPE html>
<html lang="en-US">

<head>
	<?php include('../component/f_links.php');?>
	<!-- PAGE SCRIPT -->
	<!-- telephone -->
	<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/country/css/intlTelInput.css">
	<script type="text/javascript">
		$(function() {
			$('#respUserEphone').keypress(function(event){
				if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
event.preventDefault(); //stop character from entering input
}
});
		});
	</script>

	<!-- this script for webcam -->
	<script src="<?php echo $BaseUrl; ?>/assets/js/webcam/webcam.min.js"></script>
	<!-- END SCRIPT -->

	<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">



</head>

<body class="bg_gray">
	<?php include_once ("../header.php"); ?>


	<!--User Details Setting  Modal-->
	<div class="modal fade" id="userdetails" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">


		<div class="modal-dialog" role="document">
			<div class="modal-content sharestorepos bradius-15" >

				<form id="uploadidentityfrm" enctype="multipart/form-data" >
					<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">


					<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

					<!--   <?php echo"here"; print_r($_SESSION['uid']);  ?>   -->      

					<input type="hidden" name="idspUser" value="<?php echo $_SESSION["uid"];?>">





					<div class="modal-header br_radius_top bg-white">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="changeModalLabel"><b>Account Verification</b> </h3>
					</div>




					<div class="modal-body">
						<div class="row">

							<?php
							if ($ruser['is_email_verify'] == 1) {
						  ?>


								<div class="col-md-6">
									<div class="form-group">
										<label for="spUserEmail" class="control-label">Email <span class="red">*</span>


										</label>
										<input type="email" class="form-control" id="spUserEmail" 
										name="spUserEmail" value="<?php echo $useremail;?>" >
										<p style="color: #2ba805;">Verified.</p>
									</div>
								</div>


								<?php
							}else{
								?>

								<div class="col-md-6">
									<div class="form-group">
										<label for="spUserEmail" class="control-label">Email <span class="red">* <!-- <a href="" title="" class="red" style="text-decoration: underline;"> ( Verify Now ) </a> --> </span>

										</label>
										<input type="email" class="form-control" id="spUserEmail" 
										name="spUserEmail" value="<?php echo $useremail;?>" >
										<p class="red"> Not Verified .</p>
									</div>
								</div>

								<?php
							} ?>

							<?php
							if ($ruser['is_phone_verify'] == 1) {
						  ?>

								<div class="col-md-6">
									<div class="form-group">
										<label for="spUserPhone" class="control-label">Phone <span class="red">* </span></label>
										<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" >
										<p style="color: #2ba805; padding-top: 10px;">Verified.</p>
									</div>
								</div>

								<?php
							}else{
								?>

								<div class="col-md-6">
									<div class="form-group">
										<label for="spUserPhone" class="control-label">Phone <span class="red">* 
											<!-- <a href="" title="" class="red" style="text-decoration: underline;"> ( Verify Now ) </a> -->  </span></label>


											<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" >
											<p class="red" style="padding-top: 10px;"> Not Verified .</p>
										</div>
									</div>

									<?php
								}
								?>

							</div>
							<div class="row">
								<div class="col-md-12">

									<div class="form-group">
										<label for="spProfilesCountry">Address</label>

										<input type="text" list="suggested_address" class="form-control" name="address"  id="address" onkeyup="getaddress();" value="<?php echo $address;?>"  >

										<datalist id="suggested_address"></datalist>

										<input type="hidden" name="latitude" id="latitude">
										<input type="hidden" name="longitude" id="longitude">
									</div>
								</div>

							</div>






							<hr style="margin-top: 50px!important;  margin-bottom: 50px!important;">

							<?php  
							$row = selectQ("SELECT * FROM useridentity WHERE uid=?", "i", [$_SESSION["uid"]], "one");			
							?>                         
							<div class="form-group">
								<label for="yourName" class="control-label contact">Upload ID <span class="red">*</span><span style="font-size: 12px;"> (Upload PassPort or Driving License)</span></label>


								<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity"  <?php if (!empty($row['uid'])) {echo "disabled";  }?> />




								<?php if (!empty($row['idimage'])) { ?>


									<img src="<?php echo $BaseUrl;?>/upload/user/user_id/<?php echo $row['idimage'];?>" height=150px width=150px  <?php if (!empty($row['uid'])) {echo "disabled"; }?> style="margin-top: 25px;"/>               
									<h5 style="position: absolute!important;
									bottom: 80px!important;
									left: 195px!important;">Uploaded Document (Unverified)</h5>

									<h5 style="position: absolute!important;
									bottom: -5px!important;
									left: 16px!important;">Date of Upload : <?php echo date('d/m/Y', $timestamp);?></h5>


								<?php } else{ ?>
									<img id="bluh"  src='../assets/images/blank-img/no-store.png' height=150px width=150px <?php if (!empty($row['uid'])) {echo "disabled"; }?> style="margin-top: 25px; " />

								<?php  } ?> 
							</div>


						</div>





						<div class="modal-footer bg-white br_radius_bottom">
							<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>



							<button  type="submit" id="subuploadid" <?php if (!empty($row['uid'])) {echo "disabled";

						}?> 

						class="btn btn-submit btn-border-radius db_btn db_primarybtn">Keep this file</button>

					</div>
				</form>


			</div>
		</div>
	</div>
	<!--User Details Setting Modal complete-->


	<!--change password modal-->
	<div class="modal fade" id="chagePassword" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content sharestorepos bradius-15">
				<form action="../authentication/change.php" method="post" class="">
					<div class="modal-header br_radius_top bg-white">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="changeModalLabel"><b>Change New Password</b></h3>
					</div>

					<div class="modal-body">
						<div class="form-group">
							<label for="oldpassword" class="control-label contact">Old Password <span class="red">*</span></label>
							<input type="password" class="form-control" id="oldpassword" name="oldpassword_">
						</div>

						<div class="form-group">
							<label for="newpassword" class="control-label contact">New Password <span class="red">*</span></label>
							<input type="password" class="form-control" id="newpassword" name="spUserPassword">
						</div>

						<div class="form-group">
							<label for="typenewpassword" class="control-label contact">Confirm New Password <span class="red">*</span></label>
							<input type="password" class="form-control" id="typenewpassword" name="spUserPassword_">
						</div>
					</div>
					<div class="modal-footer bg-white br_radius_bottom">
						<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn btn-border-radius" data-dismiss="modal">Close</button>
						<button type="submit" id="changepassword" class="btn btn-submit btn-border-radius db_btn db_primarybtn">Change</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--chage password modal complete col-md-1  col-md-10 -->
	<!--Pop-up Box for contact form-->

	<div class="modal fade" id="contactus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content no-radius">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="modal-title" id="exampleModalLabel">Enquiry Form</span>
				</div>

				<div class="modal-body">
					<form action="../membership/addenquiry.php" method="post" class="profileform">

						<input type="hidden" class="form-control" name="spuser_idspUser" value="<?php echo $_SESSION["uid"];?>">

						<div class="row">
							<div class="col-md-6 form-group">
								<label for="spenquiryCompanyName" class="control-label contact">Company Name</label>
								<input type="text" class="form-control inptradius" id="spenquiryCompanyName" name="spenquiryCompanyName">
							</div>

							<div class="col-md-6 form-group">
								<label for="spenquiryCompanySize" class="control-label contact">Company Size</label>
								<input type="text" class="form-control inptradius" id="spenquiryCompanySize" name="spenquiryCompanySize">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="spenquiryFirstName" class="control-label contact">First Name</label>
								<input type="text" class="form-control inptradius" id="spenquiryFirstName" name="spenquiryFirstName">
							</div>

							<div class="col-md-6 form-group">
								<label for="spenquiryLastName" class="control-label contact">Last Name</label>
								<input type="text" class="form-control inptradius" id="spenquiryLastName" name="spenquiryLastName">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="spenquiryCity" class="control-label contact">City</label>
								<input type="text" class="form-control inptradius" id="spenquiryCity" name="spenquiryCity">
							</div>

							<div class="col-md-6 form-group">
								<label for="spenquiryTel" class="control-label contact">Tel</label>
								<input type="text" class="form-control inptradius" id="spenquiryTel" name="spenquiryTel">
							</div>
						</div>
						<div class="form-group">
							<label for="spenquiryEmail" class="control-label contact">Email</label>
							<input type="email" class="form-control inptradius" id="spenquiryEmail" name="spenquiryEmail">
						</div>

						<div class="form-group">
							<label for="spenquiryAddress" class="control-label contact">Address</label>
							<textarea class="form-control " rows="3" id="spenquiryAddress" name="spenquiryAddress"></textarea>
						</div>

						<div class="form-group">
							<label for="spenquiryMessage" class="control-label contact">Message</label>
							<textarea class="form-control " rows="5" id="spenquiryMessage" name="spenquiryMessage"></textarea>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary btn-border-radius">Send</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- INVITE A FRIENDS -->
	<div class="modal fade" id="inviteFriend" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content sharestorepos bradius-15">
				<form action="<?php echo $BaseUrl.'/my-profile/invitefriend.php';?>" method="post" class="">
					<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
					<div class="modal-header br_radius_top bg-white">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h3 class="modal-title" id="changeModalLabel"><b>Invite Friends</b></h3>
					</div>

					<div class="modal-body">
						<div class="form-group">
							<label for="yourName" class="control-label contact">Your Name <span class="red">*</span></label>
							<input type="text" class="form-control" id="yourName" value="<?php echo $_SESSION['MyProfileName']; ?>" readonly />
						</div>

						<div class="form-group">
							<label for="sendTo" class="control-label contact">Sent To (Add multiple emails here. After each email use ";" this sign.) <span class="red">*</span></label>
							<textarea class="form-control" id="if_email" name="if_email" placeholder="" required=""></textarea>
						</div>

						<div class="form-group">
							<label for="txtmessage" class="control-label contact">Message <span class="red">*</span></label>
							<textarea class="form-control" rows="7" id="if_message" name="if_message" required="">I discovered this amazing online portal called TheSharePage
								that i used to create my new profiles:
								<?php echo $BaseUrl ?>
								It's very easy to use and it doesn't require any technical skills.
							Thank you.</textarea>
						</div>
					</div>
					<div class="modal-footer bg-white br_radius_bottom">
						<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
						<button  type="submit" class="btn btn-submit btn-border-radius db_btn db_primarybtn"><i class="fa fa-user"></i> Invite Friends</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<section class="landing_page">
		<div class="container">
			<div class="row">

				<div class="col-md-12">
					<div class="profile_section">
						<div class="row">
							<div class="col-md-3">

								<div class="left_profile left_sidebar_profile">

									<h2>My Profiles</h2>
									<div class="list-group" id="sp-list-profile">
										<ul class="myprofiles">   
											<?php
											$p = new _spprofiles;
											$rpvt = $p->readProfiles($_SESSION["uid"]);
//echo $p->ta->sql;
											if ($rpvt != false){
												while($row = mysqli_fetch_assoc($rpvt)) {
													?>
													<li class="<?php echo ($row['spProfilesDefault'] == 1)? 'active_default' : '';?>" >

														<a id='pfadmin-pid<?php echo $row['idspProfiles'];?>' class="sp-user-profile-label <?php echo ($row["spAccountStatus"] == 0?"disabled":""); ?>" href="profileDetails.php" data-pid='<?php echo $row['idspProfiles'];?>' data-ptid='<?php echo $row['spProfileType_idspProfileType']; ?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' data-profilename='<?php echo $row['spProfileName'];?>' data-default='<?php echo $row['spProfilesDefault']; ?>' >
															<?php
															if ($row["spProfilePic"] == '') {
																?>
																<img src="<?php echo $BaseUrl.'/assets/images/icon/blank-img.png'?>" alt="" class="img-responsive" >
																<?php
															}else{ 
																?>
																<img src="<?php echo ($row["spProfilePic"]);?>" class="img-responsive">
																<?php
															}
															echo ucwords($row['spProfileName']);?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>
														</a>
													</li>
													<?php
												}
											}
											?>
										</ul>
									</div>


									<h2>Features</h2>
									<p class="<?php echo (($a == 2 && $b == 2 && $c ==1 && $d == 1 && $e == 1 && $f == 1)? "disabled" : "");?>" id="sp-profile-register1"><i class="fa fa-plus" ></i>&nbsp;&nbsp;&nbsp;New Profile</p>
									<!-- <p data-toggle="modal" data-target="#contactus" id="sp-profile-register1"><i class="fa fa-credit-card-alt"></i> Buy Profile Package</p> -->
									<p data-toggle="modal" data-target="#userdetails"><i class="fa fa-cog"></i>&nbsp;&nbsp;Account Verification</p>

									<p data-toggle="modal" data-target="#chagePassword"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;&nbsp;Change Password</p>
									<p data-toggle="modal" data-target="#inviteFriend"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Invite Friends</p>
									<p ><a href="<?php echo $BaseUrl.'/my-profile/my-account.php';?>"><i class="fa fa-dollar"></i>&nbsp;&nbsp;&nbsp;My Account</a></p>
									<!-- <p data-toggle="modal" data-target="#uploadid"><i class="fa fa-id-card"></i>&nbsp;&nbsp;&nbsp;ID Verification</p> -->
									<p data-toggle="modal" data-target="#shipadd"><a href="<?php echo $BaseUrl.'/my-profile/add-shipping.php';?>"><i class="fa fa-truck"></i>&nbsp;&nbsp;&nbsp;Add Shipping Address</a>
									</p>

								</div>
							</div>

<!-- <div class="col-md-9 bg_white" style="margin-bottom: 15px; margin-top: 13px;">


<h3><a href="" style="float: none!important; color: #032350;">Profile Management </a></h3>  

</div> -->

<div class="col-md-9 bg_white" style="padding-bottom: 15px; margin-top: 10px;">

	<div class="col-md-2"></div>   

	<div class="col-md-8">
		<input type="hidden" id="address-ui-widgets-reload-url" value="">
		<h3 class="add_shippinglabel">Add a new address</h3>
<!-- <p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
</p> -->

<!-- <?php $uid=$_SESSION["uid"];?>
-->
<form id="address-ui-address-form">


	<input type="hidden" name="p_id" value="<?php echo $_SESSION['pid']; ?>">

	<input type="hidden" name="u_id" value="<?php echo $_SESSION['uid']; ?>">


	<div class="form-group">
		<label class="add_shippinglabel" for="shipp_username">Name:<span class="red">*</span></label>

		<input type="text" class="form-control"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"  id="shipp_username" placeholder="Enter Your Name" name="fullname"> 
		<span id="shippname_error" style="color:red;"></span>
	</div>

	<div class="form-group">
		<label class="add_shippinglabel" for="shipp_address">Address:<span class="red">*</span></label>
		<textarea class="form-control" rows="2" name="address" id="shipp_address"></textarea>
		<span id="shippaddress_error" style="color:red;"></span>
	</div>



	<div class="form-group">
		<label for="spProfilesCountry" class="add_shippinglabel" >Country:<span class="red">*</span></label>
		<select id="spUserCountry" class="form-control " name="country">
			<option value="">Select Country</option>
			<?php
			$co = new _country;
			$result3 = $co->readCountry();
			if($result3 != false){
				while ($row3 = mysqli_fetch_assoc($result3)) {
					
					$selected = "";
          if($ruser['spUserCountry'] == $row3['country_id']){
            $selected = "selected";
          }
					?>
					<option value='<?php echo $row3['country_id'];?>' <?php echo $selected;?>><?php echo $row3['country_title'];?></option>
					<?php
				}
			}
			?>
		</select>
		<span id="shippcounrty_error" style="color:red;"></span>
	</div> 

	<div class="form-group">
		<div class="loadUserState">

			<label for="spUserState" class="add_shippinglabel">State:<span class="red">*</span></label>
			<select class="form-control" name="state" id="spUserState" >
				<option value="0">Select State</option>
			</select>

			<span id="shippstate_error" style="color:red;"></span>
		</div>
	</div>


	<div class="form-group">
		<div class="loadCity">
			<label class="add_shippinglabel" for="spUserCity">City:<span class="red"></span></label>
			<!--<input type="text" class="form-control" name="city" id="shipp_city">-->
			<select class="form-control" name="spUserCity" id="spUserCity" >
				<option value="0">Select City</option>
			</select>
			<span id="shippcity_error" style="color:red;"></span>
		</div>
	</div>


	<div class="form-group">
		<label class="add_shippinglabel" for="shipp_zipcode">Zipcode:<span class="red">*</span></label>
		<input type="text" class="form-control" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode">
		<span id="shippzipcode_error" style="color:red;"></span>
	</div>

	<div class="form-group">
		<label class="add_shippinglabel" for="respUserEphone">Phone Number:<span class="red">*</span></label>

		<input type="text" class="form-control"  id="respUserEphone" placeholder="
		Enter phone number" name="phone">
		<span id="shippphone_error" style="color:red;"></span>

	</div>


<!-- <div class="form-group">
<label class="add_shippinglabel" for="pwd">Street Address:</label>

<input type="text" class="form-control" placeholder="Flat / House No. / Floor / Building" name="pwd">

</div>
-->


<div class="form-group">
	<label class="add_shippinglabel" for="shipp_landmark">Land Mark(Optional):</label>

	<input type="text" class="form-control" placeholder="E.g. Near AIIMS Flyover, Behind Regal Cinema, etc." name="landmark" id="shipp_landmark">

</div>


<div class="form-group">
	<label class="add_shippinglabel" for="pwd" >Select an Address Type:</label>
	<select class="form-control form-control-lg" name="address_type">
		<option>Select an Address Type</option>
		<option  value="Residential">Residential </option>
		<option  value="Business">Business </option>
		<option value="Postal Box">Postal Box</option>
		<option  value="Store">Store </option>
		<option  value="Warehouse">Warehouse </option>

	</select>
</div>


<div class="form-group">
	<label class="add_shippinglabel" for="pwd">Add Delivery Instructions/Notes:</label>
	<textarea class="form-control" rows="2" name="delivery_instructions"></textarea>
</div>


<!-- <h4>Additional Address Details</h4>

<p>Preferences are used to plan your delivery. However, shipments can sometimes arrive early or later than planned.<p>
-->

<div class="form-group">        
	<div class="">
		<button type="submit" class="btn btn-default btn-border-radius Add_adderess">Add address</button>  
	</div>
</div>

</form>
</<div>
	<div class="col-md-2"></div> 



</div>
</div>
</div>
</div>

</div>
</div>
</section>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

<!-- telephone -->
<script src="<?php echo $BaseUrl;?>/assets/css/country/js/intlTelInput.js"></script>
<script>
	var input = document.querySelector("#spUserPhone");
	window.intlTelInput(input, {
		initialCountry: "auto",
		preferredCountries: ['us', 'ca'],
		separateDialCode: true,
		utilsScript: "<?php echo $BaseUrl;?>/assets/css/country/js/utils.js",
	});
</script>
<script>
	function onlyAlphabets() {

		var regex = /^[a-zA-Z]*$/;
		if (regex.test(document.f.nm.value)) {
			return true;
		} else {
			document.getElementById("notification").innerHTML = "Alphabets Only";
			return false;
		}
	}
</script>


<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#bluh').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$(".showimg").change(function(){
//alert(".showimg");
		readURL(this);
		console.log(this);
	});

</script>

<script type="text/javascript">




	function getaddress(){

		var address = $("#address").val();

		$.ajax({
			type: "POST",
			url: "../address.php",
			cache:false,
			data: {'address':address},
			success: function(data) {

				var obj = JSON.parse(data);

				$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


				$("#latitude").val(obj.latitude);
				$("#longitude").val(obj.longitude);

			} 
		}); 
	}

	$( ".op_address" ).on( "click", function() {

		var addre = $(this).val();

		$("#address").val(addre);

	});

	$(document).ready(function(e){
// Submit form data via Ajax
		$("#uploadidentityfrm").on('submit', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'uploadidentity.php',
				data: new FormData(this),
				processData: false,
				contentType: false,


				beforeSend: function(){

					$('#subuploadid').attr("disabled","disabled");
					$('#uploadidentityfrm').css("opacity",".5");
				},
				success: function(response){ 

//console.log(data);


					swal({

						title: "Identity Uploaded Successfully!",
						type: 'success',
						showConfirmButton: true

					},
					function() {

						window.location.reload();

					});


				}
			});
		});
	});

	$(document).ready(function(e){
// Submit form data via Ajax

		$("#shipaddfrm").on('submit', function(e){
			e.preventDefault();

// var shipadd= $("#shipping_address").val()
			var shiphousenumber= $("#spUserhousenumber").val()
			var shipcity = $("#spUsercity").val()
			var shippostal = $("#spUserpostalcode").val()
			var shipcountry = $("#spUsercountry").val()

//alert(shipcountry);


			if(shiphousenumber == "" &&  shipcity == "" && shippostal == "" && shipcountry == ""){



				$("#shiphouse_error").text("Please Enter House Number.");
				$("#spUserhousenumber").focus();

				$("#shipcity_error").text("Please Enter City.");
				$("#spUsercity").focus();

				$("#shippostal_error").text("Please Enter Posatlcode.");
				$("#spUserpostalcode").focus();

				$("#shipcountry_error").text("Please Enter Country Name.");
				$("#spUsercountry").focus();

				return false;
			}else if (shiphousenumber == "") {
				$("#shiphouse_error").text("Please Enter House Number.");
				$("#spUserhousenumber").focus();

				return false;
			}else if (shipcity == "0" || shipcity == "") {
				$("#shipcity_error").text("Please Enter City.");
				$("#spUsercity").focus();

				return false;
			}else if (shippostal == "") {
				$("#shippostal_error").text("Please Enter Posatlcode.");
				$("#spUserpostalcode").focus();

				return false;
			}else if (shipcountry == "") {
				$("#shipcountry_error").text("Please Enter Country Name.");

				$("#spUsercountry").focus();

				return false;
			}


			else{


				$.ajax({
					type: 'POST',
					url: 'addusershippingaddr.php',
					data: new FormData(this),
					processData: false,
					contentType: false,

					beforeSend: function(){
						$('#subaddshipadd').attr("disabled","disabled");
						$('#shipaddfrm').css("opacity",".5");
					},
					success: function(response){ 


						swal({

							title: "Shipping Address Added Successfully!",
							type: 'success',
							showConfirmButton: true

						},
						function() {

							window.location.reload();

						});


					}
				});

			}

		});
	});




	$(".myprofiles li").click(function() {

		$(".myprofiles li").removeClass('active_profile');
		$(this).addClass('active_profile');

	});



	$(document).ready(function(e){

// Submit form data via Ajax
		$("#address-ui-address-form").on('submit', function(e){

			e.preventDefault();
// var shipadd= $("#shipping_address").val()
			var shipusername= $("#shipp_username").val();
			var shipaddress = $("#shipp_address").val();
			var shipcountry = $("#spUserCountry").val();
			var shipstate = $("#spUserState").val();
			var shipcity= $("#shipp_city").val();
			var shipzipcode = $("#shipp_zipcode").val();
			var shipphone = $("#respUserEphone").val();
			var shiplandmark = $("#shipp_landmark").val();

			$("#shipp_username").change(function(){
				$("#shippname_error").text("");
			})
			$("#shipp_address").change(function(){
				$("#shippaddress_error").text("");
			})
			$("#spUserCountry").change(function(){
				$("#shippcounrty_error").text("");
			})
			$("#spUserState").change(function(){
				$("#shippstate_error").text("");
			})
			$("#shipp_city").change(function(){
				$("#shippcity_error").text("");
			})
			$("#shipp_zipcode").change(function(){
				$("#shippzipcode_error").text("");
			})
			$("#respUserEphone").change(function(){
				$("#shippphone_error").text("");
			})

if (shipusername == "") { //alert("dsfds");
	$("#shippname_error").text("Please Enter Your Name.");
	$("#shipp_username").focus();
//$("#shippname_error").text("");
	return false;
}else if (shipaddress == "") {
	$("#shippaddress_error").text("Please Enter Your Address.");
	$("#shipp_address").focus();

// $("#shippaddress_error").text("");
	return false;
}else if (shipcountry == "") {
	$("#shippcounrty_error").text("Please Select Country.");
	$("#spUserCountry").focus();
// $("#shippcounrty_error").text("");
//$("#spUserCountry").focus();

	return false;
}else if (shipstate == "0") {
	$("#shippstate_error").text("Please Select State.");
	$("#spUserState").focus();
//$("#shippstate_error").text("");
// $("#spUserState").focus();

	return false;
}else if (shipcity == "") {

	$("#shippcity_error").text("Please Select City.");
	$("#shipp_city").focus();
// $("#shippcity_error").text("");
//$("#shipp_city").focus();


	return false;
}else if (shipzipcode == "") {
	$("#shippzipcode_error").text("Please Enter Pincode.");
	$("#shipp_zipcode").focus();
//$("#shippzipcode_error").text("");
//$("#shipp_zipcode").focus();

	return false;
}else if (shipphone == "") {

//$("#shippphone_error").text("");
//$("#respUserEphone").focus();
	$("#shippphone_error").text("Please Enter Your Phone Number.");
	$("#respUserEphone").focus();

	return false;
}
else{


	$.ajax({
		type: 'POST',
		url: '../authentication/addshipping_address.php',
		data: new FormData(this),
		processData: false,
		contentType: false,


		success: function(response){ 

//console.log(data);
			swal({

				title: "Added Successfully!",
				type: 'success',
				showConfirmButton: true

			},
			function() {


				window.location = "<?php echo $BaseUrl;?>/my-profile/defaultaddres.php";

			});

		}
	});
}

});

	});

</script>


<script src="<?php echo $BaseUrl;?>/assets/css/country/js/intlTelInput.js"></script>
<script>
	var input = document.querySelector("#respUserEphone");
	window.intlTelInput(input, {
    initialCountry: "<?php echo $res['phone_code'];?>",
		nationalMode: false,
		utilsScript: "<?php echo $BaseUrl;?>/assets/css/country/js/utils.js",
	});
</script>
</body>
</html>
<?php
}
?>
