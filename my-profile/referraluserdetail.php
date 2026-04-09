<?php

/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../univ/baseurl.php');
include( "../univ/main.php");
session_start();

/* print_r($_SESSION);*/
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


<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!-- PAGE SCRIPT -->
<!-- telephone -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/country/css/intlTelInput.css">
<script type="text/javascript">
$(function() {
$('#spUserPhone').keypress(function(event){
if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
event.preventDefault(); //stop character from entering input
}
});
});
</script>
<!-- this script for webcam -->
<script src="<?php echo $BaseUrl; ?>/assets/js/webcam/webcam.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<!-- END SCRIPT -->

<style type="text/css">



.switch {
position: relative;
display: inline-block;
width: 46px;
height: 21px;
}

.switch input { 
opacity: 0;
width: 0;
height: 0;
}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
-webkit-transition: .4s;
transition: .4s;
}

.slider:before {
position: absolute;
content: "";
height: 14px;
width: 13px;
left: 4px;
bottom: 4px;
background-color: white;
-webkit-transition: .4s;
transition: .4s;
}

input:checked + .slider {
background-color: #2196F3;
}

input:focus + .slider {
box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
-webkit-transform: translateX(26px);
-ms-transform: translateX(26px);
transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
border-radius: 34px;
}

.slider.round:before {
border-radius: 50%;
}

.spanclick {
content: "\2713";
font-size: 30px;
color: green!important;
font-weight: bold;
}


</style>






</head>

<body class="bg_gray">
<?php include_once ("../header.php"); ?>


<!-- Bank Detail Modal -->


<div class="modal fade" id="backdetails" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">


<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15" >

<form id="bankdetailform" enctype="multipart/form-data" >

<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">

<!--   <?php echo"here"; print_r($_SESSION['uid']);  ?>   -->      



<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


<h3 class="modal-title" id="changeModalLabel"><b>Bank Detail</b> </h3>
</div>



<div class="modal-body" style="background-color:white;">



<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spBankusername" class="control-label">Name of Account Holder <span class="red">*</span></label>
<input type="text" class="form-control" id="spBankuser" 
name="spBankusername" onkeyup="keyupBankfun()">
<span id="spBankuser_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankname" class="control-label">Bank Name<span class="red">*</span></label>
<input type="text" class="form-control" id="spBankname" name="spBankname" onkeyup="keyupBankfun()">
<span id="spBankname_error" style="color:red;"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spBankusername" class="control-label">Bank Number <span class="red">*</span></label>
<input type="text" class="form-control" id="spBanknumber" 
name="spBanknumber" onkeyup="keyupBankfun()">
<span id="spBanknumber_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankname" class="control-label">Branch Number<span class="red">*</span></label>
<input type="text" class="form-control" id="spBranchnumber" name="spBranchnumber" onkeyup="keyupBankfun()">
<span id="spBranchnumber_error" style="color:red;"></span>
</div>
</div>
</div>



<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spAccountname" class="control-label">Account Number <span class="red">*</span></label>
<input type="text" class="form-control" maxlength="18" id="spAccountnumber" name="spAccountnumber" onkeyup="keyupBankfun()">
<span id="spAccountnumber_error" style="color:red;"></span>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spBankcode" class="control-label">IFSC Code<span class="red">*</span></label>
<input type="text" class="form-control" maxlength="11" id="spBankcode" name="spBankcode" onkeyup="keyupBankfun()">
<span id="spBankcode_error" style="color:red;"></span>
</div>
</div>
</div>


</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
<button type="submit" id="savebankdetail"class="btn btn-submit btn-border-radius db_btn db_primarybtn">Save</button>
</div>
</form> 


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
<label for="spUserPhone" class="control-label">Phone <span class="red">* </span></label>
<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" >
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


<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" >
<!--  <?php echo ($isPhoneVerify == 1)?'disabled':'';?>  -->
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
<label for="spProfilesCountry">Address
<span style="font-style: italic;">(Add/Update your current address)</span></label>

<input type="text" list="suggested_address" class="form-control" name="address"  id="address" onkeyup="getaddress();" value="<?php echo $address;?>"  >

<datalist id="suggested_address"></datalist>

<input type="hidden" name="latitude" id="latitude">
<input type="hidden" name="longitude" id="longitude">
</div>
</div>

</div>






<hr style="margin-top: 50px!important; ">

<h4 style="text-align: center;margin-bottom: 16px; font-weight: bold; 
font-family: 'Times New Roman', Times, serif;"> User Identity Verification</h4> 

<?php  

$con = mysqli_connect(DOMAIN, UNAME, PASS);

if(!$con) {
die('Not Connected To Server');
}

//Connection to database
if(!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}

$uid_img=$_SESSION["uid"];

$selectimage = "SELECT * FROM useridentity WHERE uid= '$uid_img'";

if ($result = $con -> query($selectimage)) {

// print_r($result);
//$row = $result -> fetch_row(); 

$row = mysqli_fetch_assoc($result);

// print_r($row);

$timestamp = strtotime($row['created_on']);

}

?>                         



<div class="form-group">
<label for="yourName" class="control-label contact">Upload ID <span class="red">*</span><span style="font-size: 12px;"> (Upload PassPort or Driving License)</span></label>


<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity"  <?php if (!empty($row['uid'])) {echo "disabled";  }?> />




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
left: 195px!important; color: red;">The uploaded identity rejected by admin & please upload correct identity.</h5> 
<a href="#" title="" data-toggle="modal" data-target="#exampleModal" style="position: absolute!important;
bottom: 72px!important;
left: 197px!important;
text-decoration-line: underline!important;
">View Reason</a>

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
<button type="button" class="btn btn-secondary btn-border-radius" data-dismiss="modal">Close</button>

</div>
</div>
</div>
</div>


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
<img id="bluh"  src='../assets/images/blank-img/no-store.png' height=150px width=150px <?php if (!empty($row['uid'])) {echo "disabled"; }?> style="margin-top: 25px; " />
<p style="font-style: italic; font-style: italic;font-size: 17px;padding-left: 15px;">
No file uploaded</p>

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
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
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
<!-- ==END== -->
<!-- Upload ID -->


<!--Done-->


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


<a id='pfadmin-pid<?php echo $row['idspProfiles'];?>' class="sp-user-profile-label
<?php echo ($row["spAccountStatus"] == 0?"disabled":""); ?>" href="profileDetails.php" data-pid='<?php echo $row['idspProfiles'];?>' data-ptid='<?php echo $row['spProfileType_idspProfileType']; ?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' data-profilename='<?php echo $row['spProfileName'];?>' data-default='<?php echo $row['spProfilesDefault']; ?>' >


<?php
if ($row["spProfilePic"] == '') {
?>
<img src="<?php echo $BaseUrl.'/assets/images/icon/blank-img.png'?>" alt="" class="img-responsive" >
<?php
}else{ 
?>
<img src="<?php echo ($row["spProfilePic"]);?>" class="img-responsive" style="border-radius: 100%;">
<?php
}
echo ucwords($row['spProfileName']);?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>

<?php   if ($_SESSION['pid'] == $row['idspProfiles']) {?>

<span class="spanclick">&#10003;</span>
<?php }?>
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
<p  data-toggle="modal" data-target="#backdetails"><i class="fa fa-bank"></i>&nbsp;&nbsp;&nbsp;Bank Detail</a></p>
<!-- <p data-toggle="modal" data-target="#uploadid"><i class="fa fa-id-card"></i>&nbsp;&nbsp;&nbsp;ID Verification</p> -->
<p data-toggle="modal" data-target="#shipadd"><a href="<?php echo $BaseUrl.'/my-profile/add-shipping.php';?>"><i class="fa fa-truck"></i>&nbsp;&nbsp;&nbsp;Add Shipping Address</a>
</p>
<p ><i class="fa fa-mobile" aria-hidden="true" style="font-size: 19px;"></i>&nbsp;&nbsp;&nbsp; 2-Step Verification
<label class="switch" style="float: right;">

<?php if($twostep == 1){ ?>

<input type="checkbox" id="twostep" name="twostep" checked>

<?php  }else{ ?>

<input type="checkbox" id="twostep" name="twostep">

<?php  } ?>



<span class="slider round"></span>
</label>
</p>

<p><a id='pfadmin-pid<?php echo $row['idspProfiles'];?>' class="sp-user-profile-label" href="referraluserdetail.php" data-pid='<?php echo $row['idspProfiles'];?>' data-ptid='<?php echo $row['spProfileType_idspProfileType']; ?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' data-profilename='<?php echo $row['spProfileName'];?>' data-default='<?php echo $row['spProfilesDefault']; ?>' ><i class="fa fa-dollar" aria-hidden="true" ></i>&nbsp;&nbsp;&nbsp; Referral User</a></p>

<?php if(!empty($userrefferalcode)){ ?>

<p>
<div class="profileLink">
<p>Referral Link</p>
<p> <input type="text" name="" id="profileLinkField" class="profileLinkField"  value="<?php echo $BaseUrl.'/sign-up.php?rfrcode='.$userrefferalcode;?>">
</p>
<p>
<button class="btn btn-info btn-border-radius" onclick="myFunction()">Copy Link</button>
</div>
</p>
<p><b>Referral Code: <?php echo $userrefferalcode; ?> </b></p>

<?php } ?>
<!--  <p><?php echo $userrefferalcode; ?></p> -->

<script>
function myFunction() {
var copyText = document.getElementById("profileLinkField");
copyText.select();
copyText.setSelectionRange(0, 99999)
document.execCommand("copy");
/* alert("Copied the text: " + copyText.value);*/
}
</script>


</div>
</div>
<input type="hidden" class="form-control" name="userid" id="userid" value="<?php echo $_SESSION["uid"];?>">
<!--  <div class="col-md-9 bg_white" style="margin-bottom: 15px; margin-top: 13px;">


<h3><a href="" style="float: none!important; color: #032350;">Profile Management </a></h3>  

</div> -->

<div class="col-md-9 bg_white" style="margin-top: 13px;">
<div class="sp-profile-det" style="min-height: 380px;">
<div class="text-justify innertextProfile">


<style>
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}

td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}

/*tr:nth-child(even) {
background-color: #dddddd;
}*/
</style>

<h2>Referred Friends</h2>

<table>
<tr style="background-color: #343b41;color: white;">
<th>User Name</th>
<th>Created</th>
<th>Product</th>
<th>Amount</th>
</tr>
<?php

//echo $userrefferalcode.'=====';
$reffral =   $u->readrefferaluser($userrefferalcode);
// print_r($reffral );die('==000000000');
// echo $u->ta->sql;

if($reffral != false){

while ($refuser = mysqli_fetch_assoc($reffral)) {
/*	echo "<pre>";
print_r($refuser);*/

$proposting = new _productposting;

$proposted =   $proposting->refferaluserproduct($refuser['idspUser']);

/*	echo $proposting->ta->sql;*/
if($proposted){

$product = mysqli_fetch_assoc($proposted);
}

//print_r($proposted);
$conn = _data::getConnection();



$sql="SELECT * FROM `reffaralaward`";

$award = mysqli_query($conn, $sql);

$awardprice = mysqli_fetch_assoc($award);

$ammount = $awardprice['ammount'];
$awardpro = $awardprice['totalproduct'];

if($proposted->num_rows > 0){

$projectpost = $proposted->num_rows;

}else{

$projectpost = 0;

}

/*	 $projectpost =12;*/

//$awarded =   $projectpost / $awardpro;
/*  echo "<pre>";
print_r($projectpost);
echo "<br>";
print_r($awardpro);
echo "<br>";

print_r($awarded);
*/
//$awarded1 = round($awarded,0,PHP_ROUND_HALF_DOWN);

/*	 $awarded = 1;*/

if($projectpost >= $awardpro){
//$projectpost = 5;

$awardreferal = $projectpost * $ammount;
//$awardreferal = $ammount;
$finance = new _financereferral;


$finance_data = array('uid' =>$_SESSION['uid'],
'userrefferalid ' =>$refuser['idspUser'],
'amount' =>$awardreferal
);

$finadded =  $finance->read($_SESSION['uid'],$refuser['idspUser']);

/* echo $finance->ta->sql;
print_r($finadded);*/

if(empty($finadded)){

$proposted =   $finance->create($finance_data);

}else{

/*echo "here";*/
$findata = mysqli_fetch_assoc($finadded);
/* print_r($findata['id']);
print_r($awardreferal);*/

$proposted = $finance->updateamount($awardreferal,$findata['id']);
/*  echo $finance->ta->sql;*/
}


/*$proposted =   $finance->create($finance_data);*/

}else{

$awardreferal = 0;
}

$pro = new _spprofiles;
//echo $refuser['idspUser'].'++++';
$prores=  $pro->readDefaultProfile($refuser['idspUser']);
// print_r($prores);die('======');
if($prores){
$profiledata = mysqli_fetch_assoc($prores);
}

//print_r($profiledata['idspProfiles']);



?>
<tr>
<td><a href="<?php echo $BaseUrl.'/friends/?profileid='.$profiledata['idspProfiles'];?>"><?php echo ucfirst($refuser['spUserName']); ?></a></td>
<td><?php echo date("Y-m-d",strtotime($refuser['spUserRegDate'])); ?></td>
<td><?php if($projectpost > 0){ ?><a href="<?php echo $BaseUrl.'/my-profile/referraluserprofiledetail.php?uid='.$refuser['idspUser'];?>"><?php echo $projectpost; ?></a><?php }else { echo $projectpost; } ?></td>
<td><?php echo "$".$awardreferal; ?></td>



</tr>

<?php
}

/*$ruser = mysqli_fetch_assoc($reffral);*/

}else{

?>

<tr>
<td colspan="4" class="text-center">No Referral User Found</td>


</tr>




<?php
}

?>


<!--  <tr>
<td>Alfreds Futterkiste</td>
<td>Maria Anders</td>
<td>Germany</td>
</tr>
<tr>
<td>Centro comercial Moctezuma</td>
<td>Francisco Chang</td>
<td>Mexico</td>
</tr>
<tr>
<td>Ernst Handel</td>
<td>Roland Mendel</td>
<td>Austria</td>
</tr>
<tr>
<td>Island Trading</td>
<td>Helen Bennett</td>
<td>UK</td>
</tr>
<tr>
<td>Laughing Bacchus Winecellars</td>
<td>Yoshi Tannamuri</td>
<td>Canada</td>
</tr>
<tr>
<td>Magazzini Alimentari Riuniti</td>
<td>Giovanni Rovelli</td>
<td>Italy</td>
</tr> -->
</table>

</div>
</div>



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
<!-- telephone -->
<script src="<?php echo $BaseUrl;?>/assets/css/country/js/intlTelInput.js"></script>
<script>
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
utilsScript: "<?php echo $BaseUrl;?>/assets/css/country/js/utils.js",
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

</script>



</body>
</html>
<?php
}
?>