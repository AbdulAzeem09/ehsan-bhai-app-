<?php
    require_once("../../univ/baseurl.php");
	//include('../../backofadmin/library/config.php');
	session_start();
	require_once("../../backofadmin/library/config.php");
	
	
	if(isset($_POST['timebtn']))
	{
	
		$time=$_POST['timezone_offset'];
		$_SESSION['times']=$time;
		$updatecom="update spuser set time_zone='$time' where idspUser='385'";
		$cmd2=mysqli_query($dbConn,$updatecom);
		//echo("<script>alert('update successsfully')</script>");

	}


	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="dashboard/";
		include_once ("../../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		
		$pageactive = 21;
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

       <!--modal code here-->
	   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Time Zone</h4>
        </div>
		<?php
		$commands="select time_zone from spuser where idspuser='385'";
		$cmd=mysqli_query($dbConn,$commands);
		
		$row = mysqli_fetch_array($cmd);
	
		
		$time_zone=$row["time_zone"];
	
		?>
        <div class="modal-body">
			<form method="post">
          <p>*Please select time zone..</p>
		  <select name="timezone_offset" id="timezone-offset" class="form-control span5"value="<">
	<option value="-12:00" <?php if($time_zone=="-12:00"){ echo 'selected'; } ?>>(GMT -12:00) Eniwetok, Kwajalein</option>
	<option value="-11:00"<?php if($time_zone=="-11:00"){ echo 'selected'; } ?>>(GMT -11:00) Midway Island, Samoa</option>
	<option value="-10:00"<?php if($time_zone=="-10:00"){ echo 'selected'; } ?>>(GMT -10:00) Hawaii</option>
	<option value="-09:50"<?php if($time_zone=="-09::50"){ echo 'selected'; } ?>>(GMT -9:30) Taiohae</option>
	<option value="-09:00"<?php if($time_zone=="-09:00"){ echo 'selected'; } ?>>(GMT -9:00) Alaska</option>
	<option value="-08:00"<?php if($time_zone=="-08:00"){ echo 'selected'; } ?>>(GMT -8:00) Pacific Time (US &amp; Canada)</option>
	<option value="-07:00"<?php if($time_zone=="-07:00"){ echo 'selected'; } ?>>(GMT -7:00) Mountain Time (US &amp; Canada)</option>
	<option value="-06:00"<?php if($time_zone=="-06:00"){ echo 'selected'; } ?>>(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
	<option value="-05:00"<?php if($time_zone=="-05:00"){ echo 'selected'; } ?>>(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
	<option value="-04:50"<?php if($time_zone=="-04:50"){ echo 'selected'; } ?>>(GMT -4:30) Caracas</option>
	<option value="-04:00"<?php if($time_zone=="-04:00"){ echo 'selected'; } ?>>(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
	<option value="-03:50"<?php if($time_zone=="-03:50"){ echo 'selected'; } ?>>(GMT -3:30) Newfoundland</option>
	<option value="-03:00"<?php if($time_zone=="-03:00"){ echo 'selected'; } ?>>(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
	<option value="-02:00"<?php if($time_zone=="-02:00"){ echo 'selected'; } ?>>(GMT -2:00) Mid-Atlantic</option>
	<option value="-01:00"<?php if($time_zone=="-01:00"){ echo 'selected'; } ?>>(GMT -1:00) Azores, Cape Verde Islands</option>
	<option value="+00:00"<?php if($time_zone=="-00:00"){ echo 'selected'; } ?> >(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
	<option value="+01:00"<?php if($time_zone=="+01:00"){ echo 'selected'; } ?>>(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
	<option value="+02:00"<?php if($time_zone=="+02:00"){ echo 'selected'; } ?>>(GMT +2:00) Kaliningrad, South Africa</option>
	<option value="+03:00"<?php if($time_zone=="+03:00"){ echo 'selected'; } ?>>(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
	<option value="+03:50"<?php if($time_zone=="+03:50"){ echo 'selected'; } ?>>(GMT +3:30) Tehran</option>
	<option value="+04:00"<?php if($time_zone=="+04:00"){ echo 'selected'; } ?>>(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
	<option value="+04:50"<?php if($time_zone=="+04:50"){ echo 'selected'; } ?>>(GMT +4:30) Kabul</option>
	<option value="+05:00"<?php if($time_zone=="+05:00"){ echo 'selected'; } ?>>(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
	<option value="+05:50"<?php if($time_zone=="+05:50"){ echo 'selected'; } ?>>(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
	<option value="+05:75"<?php if($time_zone=="+05:75"){ echo 'selected'; } ?>>(GMT +5:45) Kathmandu, Pokhara</option>
	<option value="+06:00"<?php if($time_zone=="+06:00"){ echo 'selected'; } ?>>(GMT +6:00) Almaty, Dhaka, Colombo</option>
 	<option value="+07:00"<?php if($time_zone=="+07:00"){ echo 'selected'; } ?>>(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
	<option value="+08:00"<?php if($time_zone=="+08:00"){ echo 'selected'; } ?>>(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
	<option value="+08:75"<?php if($time_zone=="+08:75"){ echo 'selected'; } ?>>(GMT +8:45) Eucla</option>
	<option value="+09:00"<?php if($time_zone=="+09:00"){ echo 'selected'; } ?>>(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
	<option value="+09:50"<?php if($time_zone=="+09:50"){ echo 'selected'; } ?>>(GMT +9:30) Adelaide, Darwin</option>
	<option value="+10:00"<?php if($time_zone=="+10:00"){ echo 'selected'; } ?>>(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
	<option value="+10:50"<?php if($time_zone=="+10:50"){ echo 'selected'; } ?>>(GMT +10:30) Lord Howe Island</option>
	<option value="+11:00"<?php if($time_zone=="+11:00"){ echo 'selected'; } ?>>(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
	<option value="+11:50"<?php if($time_zone=="+11:50"){ echo 'selected'; } ?>>(GMT +11:30) Norfolk Island</option>
	<option value="+12:00"<?php if($time_zone=="+12:00"){ echo 'selected'; } ?>>(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
	<option value="+12:75"<?php if($time_zone=="+12:75"){ echo 'selected'; } ?>>(GMT +12:45) Chatham Islands</option>
	<option value="+13:00"<?php if($time_zone=="+13:00"){ echo 'selected'; } ?>>(GMT +13:00) Apia, Nukualofa</option>
	<option value="+14:00"<?php if($time_zone=="+14:00"){ echo 'selected'; } ?>>(GMT +14:00) Line Islands, Tokelau</option>
</select>
		
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-default" name="timebtn">Submit</button>
		 
        </div> </form>
      </div>
      
    </div>
  </div>
  <!--close modal code-->
       

			<?php
				
				include_once("../../header.php");
				
				
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
			
			//print_r($ruser);
			$username = $ruser["spUserName"]; 
			$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 
			$useremail = $ruser["spUserEmail"]; 
			$useraddress = $ruser["spUserAddress"];
			$usercountry = $ruser["spUserCountry"]; 
			$userstate = $ruser["spUserState"]; 
			$usercity = $ruser["spUserCity"]; 
			$address = $ruser["address"]; 
			$isPhoneVerify = $ruser["is_phone_verify"];
			$twostep = $ruser["twostep"];
			$userrefferalcode = $ruser["userrefferalcode"];
			
			
		}
			?>
			
			
<div class="modal fade" id="changemobile" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content sharestorepos bradius-15" >
			
			<div class="modal-header br_radius_top bg-white">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title" id="changeModalLabel"><b>Change Phone Number</b> </h3>
			</div>
			
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-success" id="smsg" style="display:none;">
							<div id="msg"></div>
						</div>
						<div class="form-group">
							<label for="update_mobile" class="control-label">Current Phone Number:</label>
							<span class="phone-display"><?php echo $userpnone ?></span>    
						</div>
						<div class="form-group">
							<label for="update_mobile" class="control-label">Enter New Phone Number <span class="red">* </span></label>
							<input type="text" class="form-control" id="update_mobile" name="update_mobile" value="">     
						</div>
					</div>
				</div>
				
				<div class="row" id="enter_otp" style="display:none;">
					<div class="col-md-8">
						<div class="form-group">
							<label for="otp" class="control-label">Enter OTP<span class="red">* </span></label>
							<input type="text" class="form-control" id="otp" name="otp" value="">     
						</div>
					</div>
					<div class="col-md-2" style="padding-top:18px">
						<div class="form-group">
							<button  type="button" id="re_send_otp" class="btn btn-submit db_btn db_primarybtn">Re-Send OTP</button>
						</div>
					</div>
				</div>
			</div>
			
			<div class="modal-footer bg-white br_radius_bottom">
				<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
				<span id="sendotp">
					<button  type="button" id="up_mobile_btn" class="btn btn-submit db_btn db_primarybtn">Update Phone</button>
				</span>
				<span id="change_number" style="display:none;">
					<button  type="button" id="up_mobile_btn_2" class="btn btn-submit db_btn db_primarybtn" >Update Phone</button>
				</span>
			</div>
			
		</div>
	</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Reason by admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p><?php echo $row['remark']; ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				
			</div>
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
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Send</button>
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
							https://thesharepage.com/
							It's very easy to use and it doesn't require any technical skills.
						Thank you.</textarea>
					</div>
				</div>
				<div class="modal-footer bg-white br_radius_bottom">
					<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
					<button  type="submit" class="btn btn-submit db_btn db_primarybtn"><i class="fa fa-user"></i> Invite Friends</button>
				</div>
			</form>
		</div>
	</div>
</div>
			
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
									<h1>My Settings</h1>
									<ol class="breadcrumb">
										<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
										<li class="active">My Settings</li>
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
																	
													 
								<p>	<a data-toggle="modal" data-target="#userdetails"><i class="fa fa-cog"></i>&nbsp;&nbsp;Account Verification</a></p>
								<p>	<a id="handle-user-address" href="<?php echo $BaseUrl.'/dashboard/settings/myAddress.php';?>"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;My Address</a></p>
									<p>	<a data-toggle="modal" data-target="#business"> &nbsp;&nbsp;Business Account Verification</a></p>
								
								<p>	<a data-toggle="modal" data-target="#chagePassword"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;Change Password</a></p>
								<p>	<a data-toggle="modal" data-target="#changemobile"><i class="fa fa-phone"></i>&nbsp;&nbsp;Change Phone</a></p>
								<p>	<a data-toggle="modal" data-target="#inviteFriend"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Invite Friends</a></p>
									<p><a ><a href="<?php echo $BaseUrl.'/my-profile/my-account.php';?>"><i class="fa fa-dollar"></i>&nbsp;&nbsp;&nbsp;My Account</a></a></p>
								<!-- <p  data-toggle="modal" data-target="#backdetails"><i class="fa fa-bank"></i>&nbsp;Bank Detail</a></p> -->
								<!-- <p data-toggle="modal" data-target="#uploadid"><i class="fa fa-id-card"></i>&nbsp;&nbsp;&nbsp;ID Verification</p> -->
									<p><a data-toggle="modal" data-target="#shipadd"><a href="<?php echo $BaseUrl.'/my-profile/add-shipping.php';?>"><i class="fa fa-truck"></i>&nbsp;&nbsp;Add Shipping Address</a>
								</a></p>
								
									<p><a ><i class="fa fa-mobile" aria-hidden="true" style="font-size: 19px;"></i>&nbsp;&nbsp; 2-Step Verification
									<p>	<a data-toggle="modal" data-target="#myModal"><i class="fa fa-phone"></i>&nbsp;&nbsp;Time Zone</a></p>

									<label class="switch" style="padding-left:40px">
										
										<?php if($twostep == 1){ ?>
											
											<input type="checkbox" id="twostep" name="twostep" checked>
											
											<?php  }else{ ?>
											
											<input type="checkbox" id="twostep" name="twostep">
											
										<?php  } ?>
										
										
										
										<span class="slider round"></span>
									</label>
									</a></p>
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
			
			<div class="modal fade" id="chagePassword" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content sharestorepos bradius-15">
			<form action="<?php echo $BaseUrl ?>/authentication/change.php" method="post" class="">
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
					<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
					<button type="submit" id="changepassword" class="btn btn-submit db_btn db_primarybtn">Change</button>
				</div>
			</form>
		</div>
	</div>
</div>
	<!--use of business account verification-->
	<?php
	$sp_pid=$_SESSION['pid'];
   $sp_uid=$_SESSION['uid'];
	$sprecord="select*from spbuiseness_files where sp_pid=$sp_pid and sp_uid=$sp_uid";
	$allrecord=mysqli_query($dbConn,$sprecord);
	$spresult=mysqli_fetch_array($allrecord);
	$businesname=$spresult['Business_Name'];
	$spaddr=$spresult['Address'];
	$spwebname=$spresult['bswebsite'];
	$licenspic=$spresult['Profiles'];
	$billpic=$spresult['upload_bills'];
	if(isset($_POST["btns"]))
	{
		
		$spdelete="delete from spbuiseness_files where sp_pid=$sp_pid  and sp_uid=$sp_uid";
	 $deletes=mysqli_query($dbConn,$spdelete);
		$businame_name=$_POST['Business_Name'];
		$address=$_POST['spaddress'];
		$country=$_POST['Country'];
		$state=$_POST['spUserState'];
		$city=$_POST['spUserCity'];
		
		$profiles=$_FILES['Profiles']['name'];
		$profiles2=$_FILES['Profiles']['tmp_name'];
		 $spdir="profile_pic/".$profiles;
		 move_uploaded_file($profiles2,$spdir);
		 
		 $upload_bills=$_FILES['upload_bills']['name'];
		 $upload_bills2=$_FILES['upload_bills']['tmp_name'];
		 $billdr="profile_pic/".$upload_bills;
		 move_uploaded_file( $upload_bills2, $billdr);
		 $bswebsite=$_POST['bswebsite'];
		 $spcmd="insert into spbuiseness_files(sp_pid,sp_uid,Business_Name,Address,Country,State,City,Profiles,upload_bills,bswebsite) values('$sp_pid','$sp_uid','$businame_name','$address','$country','$state','$city','$profiles','$upload_bills','$bswebsite')";
		   
		 $inserts=mysqli_query($dbConn,$spcmd);
		
	}
	?>
<div class="modal" tabindex="-1" role="dialog" id="business">
  <div class="modal-dialog" role="document">
  
  <form action="" method="post" enctype= multipart/form-data>
   
   <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Business profile Verification</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <label>Business Name:</label>
		 <input type="text"class="form-control"name="Business_Name" value="<?php echo $businesname; ?>">
		  <label>Address:</label>
		 <input type="text"class="form-control" name="spaddress" value="<?php echo $spaddr; ?>">
		 <div class="row">
		 <div class="col-md-4">
																			<div class="form-group">
																			<label for="spPostCountry_" class="lbl_2">Country</label>
																			<select class="form-control " name="Country" id="spUserCountry">
																			<option value="">Select Country </option> 
																			<?php
																			
																			//spPostCountry 
																			//                                                    if (isset($_GET["postid"])) {

																			
																													
																													
																				 
																				 
																			/*$_SESSION['spPostCountry'] = $usercountry;
																				
																				$_SESSION['spPostState'] = $userstate;
																				//echo $_SESSION['spPostState'];
																				$_SESSION['spPostCity'] =  $usercity; */
																				
																				/*
																					 
																				 $usercountry =$_SESSION['spPostCountry']
																				
																				$userstate = $_SESSION['spPostState'];
																				//echo $_SESSION['spPostState'];
																				$usercity; = $_SESSION['spPostCity'];  
																				
																				*/
																				
																				
																				
																						
																													
																			$co = new _country;
																			$result3 = $co->readCountry();
																			if($result3 != false){
																			while ($row3 = mysqli_fetch_assoc($result3)) {
																				
																			//	echo $usercountry; die; 
																			?>
																			
																			<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
																			<?php
																			}
																			}
																			?>
																			</select>
																			<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
																			</div>
																			</div>
																			
																			                                             <div class="col-md-4">
                                                    <div class="loadUserState">
                                                        <label for="spPostingCity" style="float:left; color: white;" class="lbl_3">State</label>
                                                        <select class="form-control spPostingsState" name="spstate">
                                                            <option>Select State</option>
                                                            <?php 
                                                            
                                                            if (isset($_SESSION['spPostCountry']) && $_SESSION['spPostCountry'] > 0) {
                                                                $countryId = $usercountry;
                                                                $pr = new _state;
                                                                $result2 = $pr->readState($_SESSION['spPostCountry']);
                                                                if($result2 != false){
                                                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                                        <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($_SESSION['spPostState']) && $_SESSION['spPostState'] == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
                                                                        <?php
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
												<div class="col-md-4">
                                                    <div class="loadCity">
                                                        <div class="form-group">
                                                            <label for="spPostingCity" style="float: left;color: white;" class="">City</label>
                                                            <select class="form-control" name="spcity">
                                                                <option>Select City</option>
                                                                <?php 
                                                                   // $stateId = $userstate;

                                                                    $co = new _city;
                                                                    $result3 = $co->readCity($_SESSION['spPostState']);
                                                                    //echo $co->ta->sql;
                                                                    if($result3 != false){
                                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION['spPostCity']) && $_SESSION['spPostCity'] == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
                                                                        }
                                                                    
                                                                } ?>
                                                            </select>
                                                      
<!--													  <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php // echo (isset($eCity) ? $eCity : $city); ?>">   -->
                                                        </div>
                                                    </div>
                                                
																		
																			</div>
																			</div>
 															
																		
        
		 <label>Business Liecense:</label>
		     <input type="file" class="custom-file-input"style="display:block;" name="Profiles"><img src="profile_pic/<?php echo $licenspic;  ?>"style="height:30px;width:30px;"><br>
			 <label>Upload any bills addressed to the business Location:</label>
			  <input type="file" class="custom-file-input"style="display:block;" name="upload_bills"><img src="profile_pic/<?php echo $billpic; ?>"style="height:30px;width:30px;"><br>
			  <label>Business Website:</label>
			  <input type="text" class="form-control"name="bswebsite" value="<?php echo $spwebname; ?>">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"name="btns">submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div></form>
    </div>
  </div>
</div>	
			
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
				
				
				
				<!-- <div class="modal-body" style="background-color:white;">
					
					<input type="hidden" name="idspUser" value="<?php echo $_SESSION["uid"];?>">
					
					
					<div class="row">
					<div class="col-md-6">
					<div class="form-group">
					<label for="spUserEmail" class="control-label">Email <span class="red">*</span></label>
					<input type="email" class="form-control" id="spUserEmail" 
					name="spUserEmail" value="<?php echo $useremail;?>" disabled>
					</div>
					</div>
					
					<div class="col-md-6">
					<div class="form-group">
					<label for="spUserPhone" class="control-label">Phone <span class="red">*</span></label>
					<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>"<?php echo ($isPhoneVerify == 1)?'disabled':'';?> >
					</div>
					</div>
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
					
					
					</div>
					<div class="modal-footer bg-white br_radius_bottom">
					<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-submit db_btn db_primarybtn">Save</button>
					</div>
				</form> -->
				
				<div class="modal-body">
					<div class="row">
						
						<?php
							$u = new _spuser;
							$result2 = $u->isEmailVerify($_SESSION['uid']);
							
							if ($result2) {
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
								$u = new _spuser;
								$result2 = $u->isPhoneVerify($_SESSION['uid']);
								
								if ($result2) {
								?>
								
								<div class="col-md-6">
									<div class="form-group">
										<label for="spUserPhone" class="control-label">Phone <span class="red">* </span>  <!-- <a class="change_mobile" href="javascript:void(0);" style="cursor:pointer;"> - Change Phone Number</a> --></label>
										<input type="text" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" readonly>
										<!--  <?php echo ($isPhoneVerify == 1)?'disabled':'';?>  -->
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
										
										
										<input type="text" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" readonly>
										<!--  <?php echo ($isPhoneVerify == 1)?'disabled':'';?>  -->
										<p class="red" style="padding-top: 10px;"> Not Verified .</p>
									</div>
								</div>
								
								<?php
								}
							?>
							
					</div>
					<!-- <div class="row">
						<div class="col-md-12">
						
						<div class="form-group">
						<label for="spProfilesCountry">Address
						<span style="font-style: italic;">(Add/Update your current address)</span></label>
						remove by ashish api not working -> onkeyup="getaddress();" 
						<input type="text" list="suggested_address" class="form-control" name="address"  id="address"  value="<?php echo $address;?>"  >
						
						<datalist id="suggested_address"></datalist>
						
						<input type="hidden" name="latitude" id="latitude">
						<input type="hidden" name="longitude" id="longitude">
						</div>
						</div>
						
					</div> -->
					
					
					
					
					
					
					<hr style="margin: 0px 0px 13px 0px;">
					
					<h3 class="modal-title" style="margin: 0px 0px 12px 0px;"> User Identity Verification</h3> 
					
					<?php  
						
						$con = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
						
						if(!$con) {
							die('Not Connected To Server');
						}
						
						//Connection to database
						if(!$con) {
							echo 'Database Not Selected';
						}
						
						$uid_img=$_SESSION["uid"];
						
						$selectimage = "SELECT * FROM useridentity WHERE uid= '$uid_img'";
						
						if ($result = $con -> query($selectimage)) {
							
							// print_r($result);
							//$row = $result -> fetch_row(); 
							
							$row = mysqli_fetch_assoc($result);
							
					//	 print_r($row);
							
							$timestamp = strtotime($row['created_on']);
							
						}
						
					?>                         
					
					<div class="form-group">
						<label for="yourName" class="control-label contact">Upload ID <span class="red">*</span><span style="font-size: 12px;"> (Upload PassPort or Driving License)</span></label>
						<?php if (!empty($row['uid'])) { ?>
							<input type="hidden" name="isupdate" value="1">
							<input type="hidden" name="up_id" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="idimage" value="<?php echo $row['idimage'];?>">
						<?php } ?>                         
						
						<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity"   />
						
						<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity1" id="uploadidentity1"   />
						
						
						
						
						
						<?php if (!empty($row['idimage'])) { ?>
							
							
							<img src="<?php echo $BaseUrl;?>/upload/user/user_id/<?php echo $row['idimage'];?>" height=150px width=150px  <?php if (!empty($row['uid'])) {echo "disabled"; }?> style="margin-top: 25px;"/>               
							
							
							<?php if($row['status'] == 0){ ?>
								<h5 style="position: absolute!important;
								bottom: 80px!important;
								left: 195px!important;">Waiting for Approvel.</h5>
								
								<?php }else if ($row['status'] == 1) { ?>
								<h5 style="position: absolute!important;
								bottom: 80px!important;
								left: 195px!important;">Approved</h5>
								
								<?php }else{ ?>
								
								<h5 style="position: absolute!important;
								bottom: 80px!important;
								left: 195px!important; color: red;margin-right: 4px;">The uploaded identity rejected by admin & please upload correct identity.</h5> 
								<a href="javascript:void(0);" title="" id="reason" style="position: absolute!important;
								bottom: 72px!important;
								left: 197px!important;
								text-decoration-line: underline!important;
								">View Reason</a>
								
								
								
								
								<?php }
								
								
							?>
							
							<!-- <?php print_r($row['remark']); echo "<br>"; ?> 
								<?php print_r($row['status']); ?> 
							-->
							<!--  <h5 style="position: absolute!important;
								bottom: 80px!important;
							left: 195px!important;">Uploaded Document (Unverified)<a href="" title="">View Reason</a></h5> -->
							
							<h5 style="position: absolute!important;
							bottom: -5px!important;
							left: 16px!important;">Date of Upload : <?php echo date('d/m/Y', $timestamp);?></h5>
							
							
							<?php } else{ ?>
							<img id="bluh"  src='../../assets/images/blank-img/no-store.png' height=150px width=150px <?php if (!empty($row['uid'])) {echo "disabled"; }?> style="margin-top: 25px; " />
							<p style="font-style: italic; font-style: italic;font-size: 17px;padding-left: 15px;">
							No file uploaded</p>
							
						<?php  } ?> 
						
					</div>
					
					
					      
					
					
					
					
					
					
					
					
					
				</div>
				<p style="font-size:15px;font-weight:500;font-family:system-ui;padding:7px 12px 0px 15px;"><span style="color:red;">*</span>Write your full name and today's date with your signature on a white paper, hold it in with your ID and take a selfie and upload it here.</p>
				
				
				
				
				<div class="modal-footer bg-white br_radius_bottom">
					<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
					
					
					
					<button  <?php if($row['status'] == 1) { echo "disabled"; } ?> type="submit" id="subuploadid" class="btn btn-submit db_btn db_primarybtn">Keep this file</button>
					
					
					
					
					
				</div>
			</form>
			
			
		</div>
	</div>
</div>
			
			
			<?php include('../../component/f_footer.php');?>
			<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
			<?php include('../../component/f_btm_script.php'); ?>\
		
			
			
		</body> 
	</html>
	<?php
	} ?>																			
	
	<input type="hidden" name="userid" id="userid" value="<?php echo $_SESSION["uid"];?>">
	
				<script>
					$(document).ready(function(){
					$('#twostep').click(function(){
						
						var userid = $("#userid").val();
						/*alert();*/
						if($(this).is(':checked')){
							
							var twostep = 1;
							
							}else{
							
							var twostep = 0;
							
						}
						
						$.ajax({
							type: "POST",
							url: "updatetwostep.php",
							cache:false,
							data: {'userid':userid,'twostep':twostep},
							success: function(data) {
								
								
								
							} 
						}); 
						
					});
				});
			</script>
	
	<script>
		$(".change_mobile").click(function() {
					$("#userdetails").modal('hide');  
					$('#changemobile').modal('show');
				});
				
				$("#reason").click(function() {
					$("#userdetails").modal('hide');  
					$('#exampleModal').modal('show');
				});
				
				
				
				
				
				
				var input = document.querySelector("#spUserPhone");
				window.intlTelInput(input, {
				// allowDropdown: false,
				// autoHideDialCode: false,
				// autoPlaceholder: "off",
				// dropdownContainer: document.body,
				// excludeCountries: ["us"],
				// formatOnDisplay: false,
				// geoIpLookup: function(callback) {
				//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
				//     var countryCode = (resp && resp.country) ? resp.country : "";
				//     callback(countryCode);
				//   });
				// },
				// hiddenInput: "full_number",
				initialCountry: "auto",
				// localizedCountries: { 'de': 'Deutschland' },
				// nationalMode: false,
				// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
				// placeholderNumberType: "MOBILE",
				preferredCountries: ['us', 'ca'],
				separateDialCode: true,
				utilsScript: "https://dev.thesharepage.com/assets/css/country/js/utils.js",
				});
				
				var input2 = document.querySelector("#update_mobile");
				window.intlTelInput(input2, {
				// allowDropdown: false,
				// autoHideDialCode: false,
				// autoPlaceholder: "off",
				// dropdownContainer: document.body,
				// excludeCountries: ["us"],
				// formatOnDisplay: false,
				// geoIpLookup: function(callback) {
				//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
				//     var countryCode = (resp && resp.country) ? resp.country : "";
				//     callback(countryCode);
				//   });
				// },
				// hiddenInput: "full_number",
				initialCountry: "auto",
				// localizedCountries: { 'de': 'Deutschland' },
				// nationalMode: false,
				// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
				// placeholderNumberType: "MOBILE",
				preferredCountries: ['us', 'ca'],
				separateDialCode: true,
				utilsScript: "https://dev.thesharepage.com/assets/css/country/js/utils.js",
				});
				
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
				
				
				
				/*$("form#uploadidentityfrm").submit(function(e) {*/
				//e.preventDefault();
				// var formData = new FormData(this);   
				//var formData = $('#uploadidentityfrm').serialize(); 
				/*   e.preventDefault();    
				var formData = new FormData(this);*/
				//var formData = new FormData(this.form);
				//alert($(this).attr("action"));
				//$('#stuff').serialize()
				
				/*  $.post($(this).attr("action"), formData, function(data) {
					alert(data);
				});*/
				/* $.ajax({
					type: "POST",
					url: "uploadidentity.php",
					data: formData,
					success: function(data) {
					
					alert(data);
					
					
					
					} 
				}); */
				/*});*/
				
				
				$(document).ready(function(e){
					// Submit form data via Ajax
					$("#bankdetailform").on('submit', function(e){
						e.preventDefault();
						
						var Bankuser= $("#spBankuser").val()
						
						var Bankname = $("#spBankname").val()
						var Banknumber = $("#spBanknumber").val()
						var Branchnumber = $("#spBranchnumber").val()
						var Accountnumber = $("#spAccountnumber").val()
						var Bankcode = $("#spBankcode").val()
						
						//alert(Bankuser);
						
						
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
								url: 'addbankdetail.php',
								data: new FormData(this),
								processData: false,
								contentType: false,
								
								
								success: function(response){ 
									
									//  console.log(data);
									
									
									swal({
										
										title: "Bank Detail Added Successfully!",
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
				
			</script>
			
			
			
			<script type="text/javascript">
				function keyupBankfun() {
					
					var Bankuser= $("#spBankuser").val()
					
					var Bankname = $("#spBankname").val()
					var Banknumber = $("#spBanknumber").val()
					var Branchnumber = $("#spBranchnumber").val()
					var Accountnumber = $("#spAccountnumber").val()
					var Bankcode = $("#spBankcode").val()
					
					
					if(Bankuser != "")
					{
						$('#spBankuser_error').text(" ");
						
					}
					if(Bankname != "")
					{
						$('#spBankname_error').text(" ");
					}
					if(Banknumber != "" )
					{
						$('#spBanknumber_error').text(" ");
						
					}
					if(Branchnumber != "")
					{
						$('#spBranchnumber_error').text(" ");
						
					}
					if(Accountnumber != "")
					{
						$('#spAccountnumber_error').text(" ");
					}
					if(Bankcode != "")
					{
						$('#spBankcode_error').text(" ");
						
					}
					
					
				}
			</script>
			
			<script type="text/javascript">
				$(document).ready(function(e){
					// Submit form data via Ajax
					$("#uploadidentityfrm").on('submit', function(e){
						e.preventDefault();
						
						var vidFileLength = $("#uploadidentity")[0].files.length;
						var vidFileLength1 = $("#uploadidentity1")[0].files.length;
						var address = $("#address").val(); 
						var email = $("#spUserEmail").val(); 
						if(email == "")
						{
							swal({
								title: "Please Enter Email Address!",
								type: 'warning',
								showConfirmButton: true
							},
							function() {
								
							});
						}
						else if(address == "")
						{
							swal({
								title: "Please Enter Address!",
								type: 'warning',
								showConfirmButton: true
							},
							function() {
								
							});
						}
						else if(vidFileLength === 0){
							swal({
								title: "Please Select Upload ID!",
								type: 'warning',
								showConfirmButton: true
							},
							function() {
								
							});
						}
						else
						{
							$.ajax({
								type: 'POST',
								url: '<?php echo $BaseUrl ?>/my-profile/uploadidentity.php',
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
						}
					});
				});
			</script>
			
			
			
			
			<script type="text/javascript">
				/*$(document).ready(function(e){
					// Submit form data via Ajax
					$("#shipaddfrm").on('submit', function(e){
					e.preventDefault();
					
					
					
					// var shipadd= $("#shipping_address").val()
					
					var Bankuser= $("#spBankuser").val()
					
					var Bankname = $("#spBankname").val()
					var Banknumber = $("#spBanknumber").val()
					var Branchnumber = $("#spBranchnumber").val()
					var Accountnumber = $("#spAccountnumber").val()
					var Bankcode = $("#spBankcode").val()
					
					
					if(Bankuser == "" &&  Bankname == "" && Banknumber == "" && Branchnumber == "" && Accountnumber == "" && Bankcode == ""){
					
					
					$("#spBankuser_error").text("Please Enter Name of Account Holder .");
					$("#spBankuser").focus();
					
					$("#spBankname_error").text("Please Enter Your Bank Name.");
					$("#spBankname").focus();
					
					$("#spBanknumber_error").text("Please Enter Your Bank Number.");
					$("#spBanknumber").focus();
					
					
					$("#spBranchnumber_error").text("Please Enter Your Branch Number.");
					$("#spBranchnumber").focus();
					
					$("#spAccountnumber_error").text("Please Enter Your Account Number.");
					$("#spAccountnumber").focus();
					
					
					$("#spBankcode_error").text("Please Enter IFSC Code.");
					$("#spBankcode").focus();
					
					return false;
					}else if (Bankuser == "") {
					
					$("#spBankuser_error").text("Please Enter Name of Account Holder .");
					$("#spBankuser").focus();
					
					
					return false;
					}else if (Bankname == "") {
					
					$("#spBankname_error").text("Please Enter Your Bank Name.");
					$("#spBankname").focus();
					
					return false;
					}else if (Banknumber == "") {
					$("#spBanknumber_error").text("Please Enter Your Bank Number.");
					$("#spBanknumber").focus();
					
					return false;
					}else if (Branchnumber == "") {
					$("#spBranchnumber_error").text("Please Enter Your Branch Number.");
					$("#spBranchnumber").focus();
					
					return false;
					}else if (Accountnumber == "") {
					
					$("#spAccountnumber_error").text("Please Enter Your Account Number.");
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
					
					title: "Shipping Address Added  Successfully!",
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
				});*/
			</script>
			
			<script>
				$(".myprofiles li").click(function() {
					
					$(".myprofiles li").removeClass('active_profile');
					$(this).addClass('active_profile');
					
				});
				
				$(".change_mobile").click(function() {
					$("#userdetails").modal('hide');  
					$('#changemobile').modal('show');
				});
				
				$("#reason").click(function() {
					$("#userdetails").modal('hide');  
					$('#exampleModal').modal('show');
				});
				
				
				var countryCode = "";
				
				$("#country-listbox li").on("click", function(){ 
					countryCode = $(this).attr('data-dial-code');
				});
				
				$("#up_mobile_btn").click(function() {
					var str1 = "+";
					var str2 = countryCode;
					var res = str1.concat(str2);
					var mobile = $("#update_mobile").val();
					
					if(str2 == "")
					{
						swal({
							title: "Please Select Country Code!",
							type: 'warning',
							showConfirmButton: true
						},
						function() { 
							
						});
					}
					else if(mobile == "")
					{
						swal({
							title: "Please Enter Phone Number!",
							type: 'warning',
							showConfirmButton: true
						},
						function() { 
							
						});
					}
					else{
						var spProfile_idspProfile = "997";
						var idspUser = "385";
						$.ajax({
							type: 'POST',
							url: 'update_mobile.php',
							cache:false,
							data: {'country_code':res,'phone_no':mobile,'spProfile_idspProfile':spProfile_idspProfile,'idspUser':idspUser,'send_otp':1},
							dataType: 'json',
							beforeSend: function(){
								$('#up_mobile_btn').attr("disabled","disabled");
							},
							success: function(response){
								$("#up_mobile_btn").removeAttr("disabled");
								if(response.status)
								{
									$("#msg").html(response.msg);
									$("#smsg").css("color","black");
									$("#smsg").css("display","block");
									$("#enter_otp").css("display","block");
									$("#sendotp").css("display","none");
									$("#change_number").css("display","inline");
									} else {
									$("#msg").html(response.msg);
									$("#smsg").css("display","block");
									$("#smsg").css("color","red");
								}
							}
						});
					}
				});
				
				$("#re_send_otp").click(function() {
					var str1 = "+";
					var str2 = countryCode;
					var res = str1.concat(str2);
					var mobile = $("#update_mobile").val();
					//alert(res);
					
					if(str2 == "")
					{
						swal({
							title: "Please Select Country Code!",
							type: 'warning',
							showConfirmButton: true
						},
						function() { 
							
						});
					}
					else if(mobile == "")
					{
						swal({
							title: "Please Enter Phone Number!",
							type: 'warning',
							showConfirmButton: true
						},
						function() { 
							
						});
					}
					else {
						var spProfile_idspProfile = "997";
						var idspUser = "385";
						
						$.ajax({
							type: 'POST',
							url: 'update_mobile.php',
							cache:false,
							data: {'country_code':res,'phone_no':mobile,'spProfile_idspProfile':spProfile_idspProfile,'idspUser':idspUser,'send_otp':1,'re_send_otp':1},
							dataType: 'json',
							beforeSend: function(){
								$('#re_send_otp').attr("disabled","disabled");
							},
							success: function(response){
								//alert(response);
								$("#re_send_otp").removeAttr("disabled");
								if(response.status)
								{
									$("#msg").html(response.msg);
									$("#smsg").css("display","block");
								}
							}
						});
					}
				});
				
				$("#up_mobile_btn_2").click(function() {
					var str1 = "+";
					var str2 = countryCode;
					var res = str1.concat(str2);
					var mobile = $("#update_mobile").val();
					var otp = $("#otp").val();
					//alert(res);
					
					if(str2 == "")
					{
						swal({
							title: "Please Select Country Code!",
							type: 'warning',
							showConfirmButton: true
						},
						function() { 
							
						});
					}
					else if(mobile == "")
					{
						swal({
							title: "Please Enter Phone Number!",
							type: 'warning',
							showConfirmButton: true
						},
						function() { 
							
						});
					}
					else if(otp == "")
					{
						swal({
							title: "Please Enter OTP!",
							type: 'warning',
							showConfirmButton: true
						},
						function() { 
							
						});
					}
					else{
						var spProfile_idspProfile = "997";
						var idspUser = "385";
						
						$.ajax({
							type: 'POST',
							url: 'update_mobile.php',
							cache:false,
							data: {'country_code':res,'phone_no':mobile,'spProfile_idspProfile':spProfile_idspProfile,'idspUser':idspUser,'send_otp':2,'otp':otp},
							dataType: 'json',
							beforeSend: function(){
								$('#up_mobile_btn_2').attr("disabled","disabled");
							},
							success: function(response){
								//alert(response);
								$("#up_mobile_btn_2").removeAttr("disabled");
								if(response.status)
								{
									$("#msg").html(response.msg);
									setInterval(function(){ window.location.reload(); }, 3000);
								}
								else
								{
									$("#msg").html(response.msg);
									$("#smsg").css("display","block");
									$("#enter_otp").css("display","block");
								}
							}
						});
					}
				});
				
				
	</script>