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
$username = $ruser["spUserName"]; 
$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"];
$useremail = $ruser["spUserEmail"]; 
$useraddress = $ruser["spUserAddress"];
$usercountry = $ruser["spUserCountry"]; 
$userstate = $ruser["spUserState"]; 
$usercity = $ruser["spUserCity"]; 
$address = $ruser["address"]; 
$userZipCode = $ruser["spUserzipcode"]; 
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
<section class="landing_page">
<div class="row panel panel-primary">
<div class="panel-heading profile_head"><h3 class="panel-title editprofile">Default Address Location</h3></div>
<div class="col-md-12 bg_white panel-body" style="padding-bottom: 15px; margin-top: 10px;">
<form id="address-ui-address-form">
<input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
<div class="form-group">
<label for="spProfilesCountry" class="add_shippinglabel" >Country:<span class="red">*</span></label>
<select id="spUserCountry_default_address" class="form-control " name="spUserCountry">
<option value="0">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>>
<?php echo $row3['country_title'];?>
</option>
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
<select class="form-control" name="spUserState" id="spUserState" >
<option value="0">Select State</option>
<?php 
if (isset($userstate) && $userstate > 0) {
$pr = new _state;
$result2 = $pr->readState($usercountry);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
<?php
}
}
}
?>
</select>
<span id="shippstate_error" style="color:red;"></span>
</div>
</div>
<div class="form-group">
<div class="loadCity">
<label class="add_shippinglabel" for="spUserCity">City:<span class="red">*</span></label>
<!--<input type="text" class="form-control" name="city" id="shipp_city">-->
<select class="form-control" name="spUserCity" id="spUserCity" >
<option value="0">Select City</option>
<?php 
if (isset($usercity) && $usercity > 0) {
$co = new _city;
$result3 = $co->readCity($userstate);
if($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
}
}
} 
?>
</select>
<span id="shippcity_error" style="color:red;"></span>
</div>
</div>
<div class="form-group">
<label class="add_shippinglabel" for="shipp_address">Address:<span class="red">*</span></label> 


<input  class="form-control" type="text" id="shipp_address"  value="<?php 
echo(isset($address) && !empty($address))?$address:''; ?>" name="address" autocomplete="off"/>

<span id="shippaddress_error" style="color:red;"></span>
</div>
<div class="form-group">
<label class="add_shippinglabel" for="shipp_zipcode">Zipcode:</label>
<input type="text" class="form-control" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo (isset($userZipCode) && !empty($userZipCode))?$userZipCode:''; ?>">
<span id="shippzipcode_error" style="color:red;"></span>
</div>
<div class="form-group">        
<div class="">
<button type="submit" class="btn btn-default Add_adderess btn-border-radius" >Save Location</button>
</div>
</div>
</form>
</div>
</div>
</div>
</section>
<?php
//include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

<script type="text/javascript">
function getaddress() {
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

$(document).ready(function(e) {

//==========ON CHANGE LOAD CITY==========
$("#spUserState").on("change", function () {

var state = this.value;
$.post("loadUserCity.php", {state: state}, function (r) {
//alert(r);
$(".loadCity").html(r);
});

});
//==========ON CHANGE LOAD CITY==========

// Submit form data via Ajax
$("#address-ui-address-form").on('submit', function(e){
e.preventDefault();
// var shipadd= $("#shipping_address").val()
var shipusername= $("#shipp_username").val();
var shipaddress = $("#shipp_address").val();
var shipcountry = $("#spUserCountry_default_address").val();
var shipstate = $("#spUserState").val();

var shipcity= $("#spUserCity").val();
var shipzipcode = $("#shipp_zipcode").val();
var shipphone = $("#respUserEphone").val();
var shiplandmark = $("#shipp_landmark").val();

$("#shippcounrty_error").text("");
$("#shippstate_error").text("");
$("#shippcity_error").text("");
$("#shippaddress_error").text("");

if(shipcountry == "0" && shipstate == "0" && shipcity == "0" && shipaddress == "" &&  shipzipcode == ""){

$("#shippcounrty_error").text("Please Select Country");
$("#spUserCountry").focus();

$("#shippstate_error").text("Please Select State.");
$("#spUserState").focus();

$("#shippcity_error").text("Please Select City");
$("#spUserCity").focus();

$("#shippaddress_error").text("Please Enter Your Address.");
$("#shipp_address").focus();

return false;

}else if (shipcountry == "0") {
$("#shippcounrty_error").text("Please Select Country.");
$("#spUserCountry").focus();

return false;
}else if (shipstate == "0") {

$("#shippstate_error").text("Please Select State.");
$("#spUserState").focus();

return false;
}else if (shipcity == "0") {

$("#shippcity_error").text("Please Select City.");
$("#spUserCity").focus();

return false;
}else if (shipaddress == "") {

$("#shippaddress_error").text("Please Enter Your Address.");
$("#shipp_address").focus();

return false;
}
else {
$.ajax({
type: 'POST',
url: 'addprofileaddress.php',
data: new FormData(this),
processData: false,
contentType: false,
success: function(response){
res = JSON.parse(response);
if (res == 1) {
swal({
title: "Address updated successfully!",
type: 'success',
showConfirmButton: true
});
} else {
swal({
title: "Something went wrong, Please try again!",
type: 'error',
showConfirmButton: true
});
}

}
});
}
});
});
</script>
</body>
</html>
<?php
}


?>




</style>
</head>
<body>

<script>
var input = document.getElementById('shipp_address');
var autocomplete = new google.maps.places.Autocomplete(input);
</script>
