<?php
include('../univ/baseurl.php');
include( "../univ/main.php");
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

/*print_r($ruser);*/
$username = $ruser["spUserName"]; 
$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 
$useremail = $ruser["spUserEmail"]; 
$useraddress = $ruser["spUserAddress"];
$usercountry = $ruser["spUserCountry"]; 
$userstate = $ruser["spUserState"]; 
$usercity = $ruser["spUserCity"]; 
$address = $ruser["address"]; 
$isPhoneVerify = $ruser["is_phone_verify"];
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
<!-- END SCRIPT -->


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
<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" <?php echo ($isPhoneVerify == 1)?'disabled':'';?> >
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
$row = $result -> fetch_row(); 

//print_r($row);

$timestamp = strtotime($row[4]);

}

//print_r($selectimage);

?>                         



<div class="form-group">
<label for="yourName" class="control-label contact">Upload ID <span class="red">*</span><span style="font-size: 12px;"> (Upload PassPort or Driving License)</span></label>


<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity"  <?php if (!empty($row[2])) {echo "disabled";  }?> />




<?php if (!empty($row[3])) { ?>


<img src="<?php echo $BaseUrl;?>/upload/user/user_id/<?php echo $row[3];?>" height=150px width=150px  <?php if (!empty($row[2])) {echo "disabled"; }?> style="margin-top: 25px;"/>               
<h5 style="position: absolute!important;
bottom: 80px!important;
left: 195px!important;">Uploaded Document (Unverified)</h5>

<h5 style="position: absolute!important;
bottom: -5px!important;
left: 16px!important;">Date of Upload : <?php echo date('d/m/Y', $timestamp);?></h5>


<?php } else{ ?>
<img id="bluh"  src='../assets/images/blank-img/no-store.png' height=150px width=150px <?php if (!empty($row[2])) {echo "disabled"; }?> style="margin-top: 25px; " />

<?php  } ?> 
</div>


</div>





<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>



<button  type="submit" id="subuploadid" <?php if (!empty($row[2])) {echo "disabled";

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
<!--    <div class="modal fade" id="uploadid" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">
<form id="uploadidentityfrm" enctype="multipart/form-data" >
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">


<input type="hidden" name="idspUser" value="<?php echo $_SESSION["uid"];?>">





<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>ID Verification</b> </h3>
</div>

<div class="modal-body">


<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spUserEmail" class="control-label">Email <span class="red">*</span></label>
<input type="email" class="form-control" id="spUserEmail" 
name="spUserEmail" value="<?php echo $useremail;?>" >
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spUserPhone" class="control-label">Phone <span class="red">*</span></label>
<input type="text" maxlength="10" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" >

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



<?php  

$con = mysqli_connect('localhost', 'osspdev', 'Office@256');

if(!$con) {
die('Not Connected To Server');
}

//Connection to database
if(!mysqli_select_db($con, 'thesharepage')) {
echo 'Database Not Selected';
}

$uid_img=$_SESSION["uid"];

$selectimage = "SELECT * FROM useridentity WHERE uid= '$uid_img'";

if ($result = $con -> query($selectimage)) {

// print_r($result);
$row = $result -> fetch_row(); 

//print_r($row);

$timestamp = strtotime($row[4]);

}

//print_r($selectimage);
?>
<div class="form-group">
<label for="yourName" class="control-label contact">Upload ID <span class="red">*</span><span style="font-size: 12px;"> (Upload PassPort or Driving License)</span></label>

<input type="file" style="display:block;" class="form-control showimg" accept="image/*" name="uploadidentity" id="uploadidentity"/>

<img id="bluh"  src='../assets/images/blank-img/no-store.png' height=150px width=150px />

</div>
</div>





<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>



<button  type="submit" id="subuploadid" <?php if (!empty($row[2])) {echo "disabled";

}?> 

class="btn btn-submit db_btn db_primarybtn">Keep this file</button>
<?php if (!empty($row[2])) {?>
<div style="float: left;">

<img src="<?php echo $BaseUrl;?>/upload/user/user_id/<?php echo $row[3];?>" height=150px width=150px />    



</div>

<h5 style="position: absolute!important;
bottom: 67px!important;
left: 156px!important;">Uploaded Document (Unverified)</h5>



<h5 style="position: absolute!important;
bottom: -5px!important;
left: 16px!important;">Date of Upload : <?php echo date('d/m/Y', $timestamp);?></h5>

<?php }?> 


</div>
</form>
</div>
</div>
</div>
-->
<!-- ==END== -->
<!-- Add Shipping Address-->
<!--       <div class="modal fade" id="shipadd" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">
<form id="shipaddfrm" enctype="multipart/form-data" >
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">


<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>Add Shipping Address</b> </h3>
</div>

<div class="modal-body">
<div class="form-group">

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spUserhousenumber" class="control-label">
House number/Unit number/Box number<span class="red">*</span></label>
<input type="text" class="form-control" id="spUserhousenumber" name="spUserhousenumber">
<span id="shiphouse_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spUsercity" class="control-label" style="padding-top: 20px;">City <span class="red">*</span></label>
<input type="text" maxlength="10" class="form-control" id="spUsercity" name="spUsercity">
<span id="shipcity_error" style="color:red;"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spUserpostalcode" class="control-label">Postal Code <span class="red">*</span></label>
<input type="text" class="form-control" id="spUserpostalcode" name="spUserpostalcode" >
<span id="shippostal_error" style="color:red;"></span>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spUsercountry" class="control-label">Country <span class="red">*</span></label>
<input type="text" maxlength="10" class="form-control" id="spUsercountry" name="spUsercountry">
<span id="shipcountry_error" style="color:red;"></span>
</div>
</div>
</div>


<label for="yourName" class="control-label contact">Address <span class="red">*</span></label>
<input type="text" class="form-control" id="yourName" value="<?php echo $_SESSION['MyProfileName']; ?>" readonly />

<textarea name="shipping_address" id="shipping_address" rows="5" class="form-control"></textarea>

<span id="shipadd_error" style="color:red;"></span>
</div>

<?php
$pra = new _spusershipadd;
$result21 = $pra->read($_SESSION['uid']);
if($result21 != false){

?>

<table class="table">
<thead>
<tr>
<th>id</th>
<th>Address</th>
<th>Action</th>
</tr>
</thead>
<tbody>




<?php
$i=1;

while ($row21 = mysqli_fetch_assoc($result21)) {

/*  echo"<pre>";
print_r($row21);*/
?>

<tr>
<td><?php echo $i;?></td>
<td><?php echo $row21['shipping_address'];?></td>
<td><i class="fa fa-pencil" aria-hidden="true"></i> &nbsp;&nbsp;<i class="fa fa-trash" aria-hidden="true"></i></td>
</tr>

<?php

$i++;
}
?>
</tbody>
</table>
<?php
}
?>





</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
<button  type="submit" id="subaddshipadd" class="btn btn-submit db_btn db_primarybtn">Add</button>
</div>
</form>
</div>
</div>
</div>

-->

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

<div class="col-md-9 bg_white">
<!--  <div class="sp-profile-det" style="min-height: 380px;">
<div class="text-justify innertextProfile">
<img src="<?php echo $BaseUrl.'/assets/images/logo/tsplogo.PNG'?>" alt="logo" style="height: 100px;" class="img-responsive" />
<h1 class="text-center">The SharePage</h1>
<p><strong>A solution for an ad-free site where you can actually get value for your time.</strong></p>
<?php
$all = new _spAllStoreForm;
$result4 = $all->readContent(1);
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);
echo $row4['contDesc'];
}
?>
</div>
</div> -->




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


if(shiphousenumber == "" &&  shipcity == "" && shippostal == "" && shipcountry == ""){

/* $("#shipadd_error").text("Please Enter Address.");*/

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
}else if (shipcity == "") {
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
});


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