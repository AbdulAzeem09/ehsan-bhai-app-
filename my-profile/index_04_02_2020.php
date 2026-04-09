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
$username = $ruser["spUserName"]; 
$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 
$useremail = $ruser["spUserEmail"]; 
$useraddress = $ruser["spUserAddress"];
$usercountry = $ruser["spUserCountry"]; 
$userstate = $ruser["spUserState"]; 
$usercity = $ruser["spUserCity"]; 
$isPhoneVerify = $ruser["is_phone_verify"];
$userpostal = $ruser['spUserPostalCode'];
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
<!--SHIPPING DESTINATION START Modal-->
<div class="modal fade" id="shipdestination" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius sharestorepos" >
<?php
$s = new _spshipping;
$result = $s->read($_SESSION["pid"]);
if($result != false){
$rset = mysqli_fetch_assoc($result);    
$North  = $rset["spShippingNorthAmerica"];
$South  = $rset["spShippingSouthAmerica"];
$East   = $rset["spShippingEastEurope"];
$West   = $rset["spShippingWestEurope"];
$Middle = $rset["spShippingMiddleEast"];
$Southeast  = $rset["spShippingSoutheastAsia"];
$Australia  = $rset["spShippingAustralia"];

$spShipna  = $rset["spShipna"];
$spShipsa  = $rset["spShipsa"];
$spShipee   = $rset["spShipee"];
$spShipwe   = $rset["spShipwe"];
$spShipme = $rset["spShipme"];
$spShipsoutha  = $rset["spShipsoutha"];
$spShipaus  = $rset["spShipaus"];
}                               

?>
<form action="addshipping.php" method="post" class="profshipform" >
<input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<div class="modal-header">

<h4 class="modal-title" id="userModalLabel">Shipping Destination</h4>
</div>
<div class="modal-body" style="background-color:white;">

<div class="row">
<div class="col-md-6">
<label for="basic-url" style="display: block;">North America</label>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingNorthAmerica" value="<?php if(isset($North)){ echo $North; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShipna" value="<?php if(isset($spShipna)){ echo $spShipna; }?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
</div>
<div class="col-md-6">
<label for="basic-url" style="display: block;">South America</label>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingSouthAmerica" value="<?php if(isset($South)){ echo $South; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShipsa" value="<?php if(isset($spShipsa)){ echo $spShipsa; }?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
</div>
<div class="col-md-6">
<label for="basic-url" style="display: block;">East Europe</label>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingEastEurope" value="<?php if(isset($East)){ echo $East; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShipee" value="<?php if(isset($spShipee)){ echo $spShipee; }?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
</div>
<div class="col-md-6">
<label for="basic-url" style="display: block;">West Europe</label>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingWestEurope" value="<?php if(isset($West)){ echo $West; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShipwe" value="<?php if(isset($spShipwe)){ echo $spShipwe; }?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
</div>
<div class="col-md-6">
<label for="basic-url" style="display: block;">Middle East</label>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingMiddleEast" value="<?php if(isset($Middle)){ echo $Middle; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShipme" value="<?php if(isset($spShipme)){ echo $spShipme; }?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
</div>
<div class="col-md-6">
<label for="basic-url" style="display: block;">Southeast Asia</label>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingSoutheastAsia" value="<?php if(isset($Southeast)){ echo $Southeast; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShipsoutha" value="<?php if(isset($spShipsoutha)){ echo $spShipsoutha; }?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
</div>
<div class="col-md-6">
<label for="basic-url" style="display: block;">Australia</label>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShippingAustralia" value="<?php if(isset($Australia)){ echo $Australia; }?>">
<span class="input-group-addon" id="basic-addon3">%</span>
</div>
</div>
<div class="boxleft" style="">
<div class="input-group">
<input type="text" class="form-control" aria-describedby="basic-addon3" name="spShipaus" value="<?php if(isset($spShipaus)){ echo $spShipaus; }?>">
<span class="input-group-addon" id="basic-addon3">$</span>
</div>
</div>
</div>






</div>


</div>
<div class="modal-footer">
<button type="button" class="btn butn_cancel btn-close" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-submit btn-border-radius" id="shippingratesbutton">Save</button>
</div>
</form>
</div>
</div>
</div>
<!--SHIPPING DESTINATION END-->

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
<div class="col-md-4">
<div class="form-group">
<label>Postal Code</label>
<input type="text" class="form-control" name="spUserPostalCode" value="<?php echo $userpostal; ?>">
</div>
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
<button type="button" class="btn butn_cancel btn-close" data-dismiss="modal">Close</button>
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
<button type="button" class="btn butn_cancel btn-close" data-dismiss="modal">Close</button>
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
https://thesharepage.com/
It's very easy to use and it doesn't require any technical skills.
Thank you.</textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn butn_cancel btn-close" data-dismiss="modal">Close</button>
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
<div class="col-md-3">

<div class="left_profile">

<h2><a href="<?php echo $BaseUrl.'/my-profile'; ?>">My Profiles</a></h2>
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
<p data-toggle="modal" data-target="#userdetails"><i class="fa fa-cog"></i>&nbsp;&nbsp;Account Setting</p>
<p data-toggle="modal" data-target="#chagePassword"><i class="fa fa-unlock-alt"></i>&nbsp;&nbsp;&nbsp;Change Password</p>
<p data-toggle="modal" data-target="#inviteFriend"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Invite Friends</p>
<p ><a href="<?php echo $BaseUrl.'/my-profile/my-account.php';?>"><i class="fa fa-dollar"></i>&nbsp;&nbsp;&nbsp;My Account</a></p>
<p ><a href="javascript:void(0);" oncontextmenu="return false;" data-toggle="modal" data-target="#shipdestination"><i class="fa fa-shield"></i>&nbsp;&nbsp;&nbsp;Shipping Destination</a></p>



</div>
</div>
<div class="col-md-9 bg_white">
<div class="sp-profile-det" style="min-height: 380px;">
<div class="text-justify innertextProfile">
<img src="<?php echo $BaseUrl.'/assets/images/logo/logo.png'?>" alt="logo" style="height: 100px;" class="img-responsive" />
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

<!-- telephone -->
<script src="<?php echo $BaseUrl;?>/assets/css/country/js/intlTelInput.js"></script>
<script>

// popup seting
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