<?php
include('../univ/baseurl.php');
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
<style>
.left_profile h2 {

border-bottom: 0px dashed #032350;
}
</style>
</head>

<body class="bg_gray">
<?php include_once ("../header.php"); ?>

<!--User Details Setting  Modal-->
<div class="modal fade" id="userdetails" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius sharestorepos" >
<form action="../authentication/updatedetails.php" method="post" class="">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="userModalLabel">Account Setting</h4>
</div>
<div class="modal-body" style="background-color:white;">

<input type="hidden" name="idspUser" value="<?php echo $_SESSION["uid"];?>">
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spUserEmail" class="control-label">Email</label>
<input type="email" class="form-control" id="spUserEmail" name="spUserEmail" value="<?php echo $useremail;?>" disabled>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spUserPhone" class="control-label">Phone</label>
<input type="text" class="form-control" id="spUserPhone" name="spUserPhone" value="<?php echo $userpnone;?>" <?php echo ($isPhoneVerify == 1)?'disabled':'';?> >
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="spUserCountry" class="control-label">Country</label>
<select id="spUserCountry" class="form-control " name="spUserCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry) && $usercountry ==$row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
<?php
}
}
?>
</select>
</div>
</div>
<div class="loadUserState">
<?php 
if (isset($userstate) && $userstate > 0) {
$countryId = $usercountry;
?>
<div class="col-md-4">
<div class="form-group">
<label for="spUserState" class="control-label">State</label>
<select class="form-control" id="spUserState" name="spUserState" >
<option>Select State</option>
<?php
$pr = new _state;
$result2 = $pr->readState($countryId);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
<?php
}
}
?>
</select>
</div>
</div>
<?php
}
?>
</div>
<div class="loadCity">
<?php 
if (isset($usercity) && $usercity > 0) {
$stateId = $userstate;
?>
<div class="col-md-4">
<div class="form-group">
<label for="spUserCity" class="control-label">City</label>
<select id="spUserCity" class="form-control " name="spUserCity">
<?php
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
}
}
?>
</select>
</div>
</div>
<?php
}
?>
</div>
</div>
<!-- <div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spUserCountry" class="control-label">Country</label>
<input type="text" class="form-control" id="spUserCountry" name="spUserCountry" value="<?php echo $usercountry;?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spUserCity" class="control-label">City</label>
<input type="text" class="form-control" id="spUserCity" name="spUserCity" value="<?php echo $usercity;?>">
</div>
</div>
</div>
-->

<div class="form-group">
<label for="spUserAddress" class="control-label">Address</label>
<textarea class="form-control" id="spUserAddress" name="spUserAddress" value="<?php echo $useraddress;?>"><?php echo $useraddress;?></textarea>
</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-close btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-submit btn-border-radius">Save</button>
</div>
</form>
</div>
</div>
</div>
<!--User Details Setting Modal complete-->


<!--change password modal-->
<div class="modal fade" id="chagePassword" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius sharestorepos">
<form action="../authentication/change.php" method="post" class="">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>Change New Password</b></h3>
</div>

<div class="modal-body">
<div class="form-group">
<label for="oldpassword" class="control-label contact">Old Password</label>
<input type="password" class="form-control" id="oldpassword" name="oldpassword_">
</div>

<div class="form-group">
<label for="newpassword" class="control-label contact">New Password</label>
<input type="password" class="form-control" id="newpassword" name="spUserPassword">
</div>

<div class="form-group">
<label for="typenewpassword" class="control-label contact">Confirm New Password</label>
<input type="password" class="form-control" id="typenewpassword" name="spUserPassword_">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-close btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" id="changepassword" class="btn btn-submit btn-border-radius">Change</button>
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
<button type="button" class="btn btn-default btn-border-radius" data-dismiss="modal">Close</button>
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
<div class="modal-content no-radius sharestorepos">
<form action="<?php echo $BaseUrl.'/my-profile/invitefriend.php';?>" method="post" class="">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="changeModalLabel"><b>Invite Friends</b></h3>
</div>

<div class="modal-body">
<div class="form-group">
<label for="yourName" class="control-label contact">Your Name</label>
<input type="text" class="form-control" id="yourName" value="<?php echo $_SESSION['MyProfileName']; ?>" readonly />
</div>

<div class="form-group">
<label for="sendTo" class="control-label contact">Sent To (Add multiple emails here. After each email use ";" this sign.)</label>
<textarea class="form-control" id="if_email" name="if_email" placeholder="" required=""></textarea>
</div>

<div class="form-group">
<label for="txtmessage" class="control-label contact">Message</label>
<textarea class="form-control" rows="7" id="if_message" name="if_message" required="">I discovered this amazing online portal called TheSharePage
that i used to create my new profiles:
<?php echo $BaseUrl ?>
It's very easy to use and it doesn't require any technical skills.
Thank you.</textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-close btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-submit btn-border-radius"><i class="fa fa-user"></i> Invite Friends</button>
</div>
</form>
</div>
</div>
</div>
<!-- ==END== -->
<!--Done-->
<section class="landing_page">
<div class="container">
<div class="row">


<div class="col-md-12">

<div class="profile_section">
<div class="row">

<div class="col-md-2">

<div class="left_profile">

<h2></h2>
<p ><a href="<?php echo $BaseUrl.'/my-profile/my-account.php';?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;My Account</a></p>
<p ><a href="<?php echo $BaseUrl.'/my-profile/';?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;My Profile</a></p>

<p><a href="<?php echo $BaseUrl?>/my-profile/refered_user.php" class="pull-left"><i class="fa fa-user-plus"></i> Referred User</a></p>
<!--<p ><a href="<?php echo $BaseUrl.'/my-profile/my-account.php';?>"><i class="fa fa-dollar"></i>&nbsp;&nbsp;&nbsp;My Account</a></p>-->



</div>
</div>

<?php $n= new _spuser;
$n1=$n->readdatabybuyerid($_SESSION['uid']);
if($n1!=false){
$r=mysqli_fetch_assoc($n1);
if($r['userrefferalcode']!=''){
$referral_code=$r['userrefferalcode'];
}else{
$referral_code="No Referral Code";

}
}

?>
<ol class="breadcrumb bg_white" style="margin-left: 195px;">
<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/dashboard/settings/';?>">Home</a></li>

<li class="breadcrumb-item"><a onclick = "EnableDisableLinks(this)"> My Account </a></li> 

</ol>
<div class="col-md-10 bg_white">


<div class="sp-profile-det" style="min-height: 380px;">
<div class="text-justify innertextProfile">

<p class="pull-right"><b>Referral Code</b>: <?php echo $referral_code;?></p>
<img src="<?php echo $BaseUrl.'/assets/images/logo/tsplogo.PNG'?>" alt="logo" style="height: 100px;" class="img-responsive" />
<h1 class="text-center" style="margin-right: 170px;" >The SharePage</h1>
<div class="table-responsive">
<table class="table table-striped table-bordered tbl_account text-center">
<thead>
<tr>
<th>&nbsp;</th> 
<th>Comments</th>
<th>Date</th>
<th>Debit</th>
<th>Credit</th>
<th>Points</th>
</tr>
</thead>
<tbody>
<?php
$total = 0;

$po = new _spPoints;
$result = $po->readmypoint($_SESSION['uid']);
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$dt = new DateTime($row['pointDate']);
?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $row['spPointComment']; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>
<td><?php echo ($row['spPoint_type'] == 'D')?'&#10004;':'';?></td>
<td><?php echo ($row['spPoint_type'] == 'C')?'&#10004;':'';?></td>

<td><?php echo $row['pointPercentage']; ?></td>
</tr>
<?php
$total = $total+$row['pointPercentage'];
$i++;
}
}
?>


</tbody>
<tfoot class="text-center">
<tr>
<td colspan="5">
<strong>Total Points</strong>
</td>
<td><?php echo number_format((float)$total, 2, '.', ''); ?></td>
</tr>

</tfoot>
</table>

</div>
<div class="row">
<div class="col-md-4">
<table class="table table-striped table-bordered tbl_account">
<tbody>
<?php
$todayrate = 0;
$result4 = $po->getlastrate();
if ($result4) {
$row4 = mysqli_fetch_assoc($result4);
$todayrate = $row4['dollar_point'];
}
?>
<tr>
<td><strong>1 Dollar ($)</strong></td>
<td style="text-align: center;"><?php echo $todayrate; ?> Points</td>
</tr>
<tr>
<td><strong>Total Dollar</strong></td>
<td style="text-align: center;">
<?php
$todyAmt = $total / $todayrate;
echo number_format((float)$todyAmt, 2, '.', '');
?>
$
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>
<!--<div style=" padding-top: 10px;float:right;margin-right:50px;">
<a href="<?php echo $BaseUrl.'/dashboard/settings/index.php';?>" title="" style="font-size:20px;  text-decoration-line: underline; color: #032350;
font-weight: bold;">Go Back</a>	

</div>-->

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
</body>
</html>
<?php
}
?>