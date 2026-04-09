<?php
// 	error_reporting(E_ALL);
// ini_set('display_errors', '1');

include('../univ/baseurl.php');
require_once '../backofadmin/library/config.php';
//require_once '../library/functions.php';
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "real-estate/all-room.php";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
$header_realEstate = "realEstate";


$breadTitle = "Rent A Room";
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);
$usercountry = $ruser["spUserCountry"];
$userstate = $ruser["spUserState"];
$usercity = $ruser["spUserCity"];
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/realsetate.css">
<style>
.iconss {
padding-left: 25px;
background: url("https://png.pngtree.com/png-vector/20190419/ourmid/pngtree-vector-location-icon-png-image_956422.jpg") no-repeat left;
background-size: 20px;
}

input#spPostingAddress_ {
background-color: white;
}

.artEventBox p.date,
.ui-widget-header {
background-color: gray !important;
}

.col-md-4.uiface {
border: 1px solid;
}

ul#profileDropDown {
border: none;
}

#profileDropDown li.active {
background-color: #95ba3d;
}

#profileDropDown li.active a {
color: #fff;
}

.post_r :hover {
color: white !important;
background-color: #5f8701;
}
</style>
</head>

<body class="bg_gray">
<?php include_once("../header.php"); ?>
<div class="container-fluid">
<div class="row roomsBanner" style="background-image: url('<?php echo $BaseUrl; ?>/assets/images/bannerRoom.jpg');">
<div class="container">
<div class="ptb50">
<div class="col-md-7">
<div class="bannerheading">
<h1>FIND ROOM INSTANTLY</h1>
<!--<p>33,000 Rooms in over 176 countries</p>-->
</div>
</div>
<div class="col-md-5 searchbox">
<form class="" method="POST" action="<?php echo $BaseUrl; ?>/real-estate/search-rooms.php">
<div class="col-md-12">

<h2>Search a Room / Apartment</h2>
<!---<div class="form-group">
<input style="margin-top: 20px;border-radius: 4px;" type="text" class="form-control" placeholder="Search for a room rent" name="spPostingTitle" required>
</div>----->
</div>
<div class="col-md-12">
<b></b>
<div class="form-group">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>

<input type="text" class="form-control spPostField iconss" data-filter="0" id="spPostingAddress_" name="txtAddress" value="<?php echo (isset($address) && $address != '') ? $address : ''; ?>" autocomplete="off" maxlength="40" required>

<script>
var input = document.getElementById('spPostingAddress_');
var autocomplete = new google.maps.places.Autocomplete(input);
</script>
</div>
</div>
<div class="col-md-12">
<label class="form-check-label" for="exampleRadios1">
RENT DURATION:
</label>
<div class="form-check">
<input class="form-check-input" type="radio" name="spPostDurstion" id="spshortDurstion_" value="1" checked>
<label>
Short Term
</label>
<input class="form-check-input" type="radio" name="spPostDurstion" id="spLongDurstion_" value="2">
<label>
Long Term
</label>
</div>
</div>

<div class="col-md-4">
<label for="spPostingCity" class="lbl_3" id="Checkin">Check IN</label>
<input type="text" name="fromdate" class="form-control" id="dt1" required><br>
</div>
<div class="col-md-4" id="Checkoutlong">
<div class="form-group">
<label for="spPostingCity" class="lbl_3">Check OUT</label>
<input type="text" name="todate" class="form-control" id="dt2" required>
</div>
</div>





<div class="col-md-4" id="Guestlong">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" class="lbl_3" id="spGuests">Guests</label>
<select class="select optional guests form-control" include_blank="false" name="guests" id="search_guests">
<option selected="selected" value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
</select>
</div>
</div>
</div>


<script>
$(document).ready(function() {
$("#spLongDurstion_").click(function() {


$("#Checkin").html("Starting Date");
$("#spGuests").html("No. of People");

$("#Checkoutlong").hide();

// $("#Guestlong").hide();



});



});
</script>


<script>
$(document).ready(function() {
$("#spshortDurstion_").click(function() {
$("#Checkin").html(" Check IN ");
$("#spGuests").html("Guests");

$("#Checkoutlong").show();

$("#Guestlong").show();



});



});
</script>

<script>
$(document).ready(function() {
$("#spLongDurstion_").click(function() {


$("#dt1").val();

$("#dt1").val("");
$("#search_guests").val();
$("#search_guests").val("");

});



});
</script>

<script>
$(document).ready(function() {
$("#spshortDurstion_").click(function() {


$("#dt2").val();

$("#dt2").val("");
$("#dt1").val();

$("#dt1").val("");
$("#search_guests").val();
$("#search_guests").val("");

});



});
</script>

<!----

<div class="col-md-6">
<div class="">

<label for="spPostingCountry" class="lbl_2">Country</label>
<select id="spUserCountry" class="form-control " name="spPostingsCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id']) ? 'selected' : ''; ?>   ><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>

</div>
</div>
<div class="col-md-6">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control spPostingsState" name="spPostingsState">
<option>Select State</option>
<?php

if (isset($userstate) && $userstate > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"]) ? 'selected' : ''; ?> ><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
}
?>
</select>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<div class="loadCity">
<label for="spPostingCity" class="">City</label>
<select class="form-control" name="spUserCity" >
<option>Select City</option>
<?php
$stateId = $userstate;
$co = new _city;
$result3 = $co->readCity($stateId);
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id']) ? 'selected' : ''; ?> ><?php echo $row3['city_title']; ?></option> <?php
    }
} ?>
</select>
</div>
</div>
</div>

----->
    <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
     <div class="modal-dialog">
      <div class="modal-content no-radius">

       <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
         <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
           <h2>Your current profile does not have <br>access to this page. Please create or switch<br> <span>"Business, Professional"</span> modules can post Rentals.</h2>
            <div class="space-md"></div>
             <a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
              <a href="<?php echo $BaseUrl . '/real-estate/all-room.php'; ?>" class="btn">Back to Home</a>
             </div>
           </div>
        </div>
    </div>
<div class="col-md-12">
<div class="form-group text-center">
<input type="submit" class="btn btn-block searchbutton" name="btnAdresSearch" value="Search By Neighbourhood" style=" color: black; ">
</div>
</div>
</form>
</div>
</div>
<div class="col-md-12">
<div class="agentbreadCrumb text-left">
<ol class="breadcrumb">
<!--<li class="breadcrumb-item"><a href="<?php echo $BaseUrl; ?>/real-estate">Home</a></li>
<li class="breadcrumb-item active"><a href="<?php echo $BaseUrl; ?>/post-ad/real-estate/" class="btn dashboard-btn butn_dash_real">Rent a room</a></li>-->
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<li><a href="<?php echo $BaseUrl; ?>/real-estate/dashboard/" class="btn dashboard-btn butn_dash_real btn-border-radius"><i class="fa fa-dashboard"></i> Dashboard</a></li>
<?php } ?>
<li class="breadcrumb-item active">
    <?php if ($_SESSION['ptid'] != 1 && $_SESSION['ptid'] != 3 ) { ?>
        <a style="background-color: #95ba3d; padding: 10px;" class="post_r btn-border-radius"href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile'>Post rental ad</a>
    <?php }else{ ?>
            <a style="background-color: #95ba3d; padding: 10px;" class="post_r btn-border-radius" href="<?php echo $BaseUrl; ?>/post-ad/real-estate/">Post rental ad</a>
    <?php } ?>
</li>
</ol>

</div>
</div>
</div>
</div>

<div class="container">
<div class="row testimonial">
<div class="col-md-4">
<div class="card p-3 text-center px-4">
<a href="<?php echo $BaseUrl; ?>/friends/?profileid=997">
<div class="user-image"> <img src=" https://profile11.s3.ca-central-1.amazonaws.com/4937921071" class="img-circle" width="80"> </div>
</a>
<div class="user-content">
<h5 class="mb-0">Marina Hossasin</h5> <span>Self Employed</span>
<p>This is one of the best websites to find a rental space! Very easy to search and contact the host! </p>
</div>
<div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
</div>
</div>
<div class="col-md-4">
<div class="card p-3 text-center px-4">
<a href="<?php echo $BaseUrl; ?>/friends/?profileid=1888">
<div class="user-image"> <img src="https://profile11.s3.ca-central-1.amazonaws.com/2847056075" class="img-circle" height="90px" width="80"> </div>
</a>
<div class="user-content">
<h5 class="mb-0">Jagan Sharma</h5> <span>Traveler</span>
<p>A great website! Very easy to navigate and love the dashboard - it is awesome to get all the notification and listings.</p>
</div>
<div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
</div>
</div>
<div class="col-md-4">
<div class="card p-3 text-center px-4">
<a href="<?php echo $BaseUrl; ?>/friends/?profileid=1146">
<div class="user-image"> <img src="https://profile11.s3.ca-central-1.amazonaws.com/8332320359" class="img-circle" height="90px" width="80"> </div>
</a>
<div class="user-content">
<h5 class="mb-0">Ishani Chakravorty</h5> <span>Software Architect</span>
<p> Very clean and easy to use websites. Hassle free , and very easy to navigate . The dashboard is very helpful!</p>
</div>
<div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
</div>
</div>
</div>
<hr>

<?php

//$con=_data::getConnection();
$command = "select distinct spProfiles_idspProfiles from sprealstate";

$records = mysqli_query($dbConn, $command);

// $rows=mysqli_num_rows($records);
$sprows = "";
$count_a = array();
while ($spprofileid = mysqli_fetch_array($records)) {
$spcount = $spprofileid['spProfiles_idspProfiles'];


//print_r($spprofileid);

$sprecord = "select * from sprealstate where spProfiles_idspProfiles= $spcount";


$sprecord2 = mysqli_query($dbConn, $sprecord);

//$sprecord2=mysqli_fetch_array($sprecord2);
if($sprecord2){
 
$postcount = ($sprecord2->num_rows);
}

//$profileid=$spcount;

/* $data_count = array(
'count' => $postcount,
'profile' => $profileid
);*/

//$a[] = $postcount;
$a=array();
  array_push($a,$postcount);
// array_push($a,$postcount);
}




for ($j = 0; $j < count($a); $j++) {
for ($i = 0; $i < count($a) - 1; $i++) {

if ($a[$i] < $a[$i + 1]) {
$temp = $a[$i + 1];
$a[$i + 1] = $a[$i];
$a[$i] = $temp;
}
}
}

$first = $a['0'];
$second = $a['1'];
$third = $a['2'];


$command = "select distinct spProfiles_idspProfiles from sprealstate";

$records = mysqli_query($dbConn, $command);
$sprows = "";
$count_a = array();
while ($spprofileid = mysqli_fetch_array($records)) {
    
$spcount = $spprofileid['spProfiles_idspProfiles'];
$sprecord = "select * from sprealstate where spProfiles_idspProfiles= $spcount";

$sprecord2 = mysqli_query($dbConn, $sprecord);
if($sprecord2){
$postcount = ($sprecord2->num_rows);
}
if ($first == $postcount) {
$first_person = $spcount;
}
if ($second == $postcount) {
$second_person = $spcount;
}

if ($third == $postcount) {
$third_person = $spcount;
}
}

//echo $first_person;
//echo $second_person;
//echo $third_person;

//die('-----');
$spcmd1 = "select*from spprofiles where idspProfiles=$first_person";
$spcmd2 = "select*from spprofiles where idspProfiles=$second_person";
$spcmd3 = "select*from spprofiles where idspProfiles=$third_person";
$spinfo1 = mysqli_query($dbConn, $spcmd1);
$spinfo2 = mysqli_query($dbConn, $spcmd2);
$spinfo3 = mysqli_query($dbConn, $spcmd3);



if($spinfo1){
$spinfo1_1 = mysqli_fetch_array($spinfo1);
}
if($spinfo2){
$spinfo1_2 = mysqli_fetch_array($spinfo2);
}
if($spinfo3){
$spinfo1_3 = mysqli_fetch_array($spinfo3);
}
$spname1 = $spinfo1_1['spProfileName'];
$spficture1 = $spinfo1_1['spProfilePic'];
//var_dump($spficture1);
//die;
$spaddress1 = $spinfo1_1['address'];

$spname2 = $spinfo1_2['spProfileName'];
$spficture2 = $spinfo1_2['spProfilePic'];
$spaddress2 = $spinfo1_2['address'];


$spname3 = $spinfo1_3['spProfileName'];
$spficture3 = $spinfo1_3['spProfilePic'];
$spaddress3 = $spinfo1_3['address'];







?>
<div class="row host">
<h1 class="text-center ptb50">TOP HOSTS</h1>
<div class="col-md-4 uiface"> <?php
if ($spficture1 == NULL) {
?><img src="<?php echo $BaseUrl; ?>/img/no.png" alt="Avatar" class="image" style="width:100%;height:285px;">
<?php
} else {
?>
<img src="<?php echo $spficture1; ?> " alt="Avatar" class="image" style="width:100%;height:285px;">
<?php
}
?>
<div class="middle">
<a href="<?php echo $BaseUrl; ?>/real-estate/agent-detail.php?agentId=<?php echo $first_person; ?>">
<div class="text"><?php echo $spname1 ?></div>
</a>
<p> <?php echo $spaddress1 ?></p>
</div>
</div>
<div class="col-md-4 uiface">
<?php
if ($spficture2 == "") { ?>
<img src="<?php echo $BaseUrl; ?>/bashar_design/products/img/uiface.jpg" alt="Avatar" class="image" style="width:100%;height:285px;">
<?php   } else {

?> <img src="<?php echo $spficture2; ?> " alt="Avatar" class="image" style="width:100%;height:285px;">
<?php
} ?>

<div class="middle">
<a href="<?php echo $BaseUrl; ?>/real-estate/agent-detail.php?agentId=<?php echo $second_person; ?>">
<div class="text"><?php echo $spname2 ?></div>
</a>
<p><?php echo $spaddress2 ?></p>
</div>
</div>
<div class="col-md-4 uiface"> <?php
if ($spficture3 == "") {
?><img src="<?php echo $BaseUrl; ?>/bashar_design/products/img/uiface.jpg" alt="Avatar" class="image" style="width:100%;height:285px;">
<?php    } else {
?>
<img src="<?php echo $spficture3; ?> " alt="Avatar" class="image" style="width:100%;height:285px;">
<?php
} ?>

<div class="middle">
<a href="<?php echo $BaseUrl; ?>/real-estate/agent-detail.php?agentId=<?php echo $third_person; ?>">
<div class="text"><?php echo $spname3 ?></div>
</a>
<p><?php echo $spaddress3 ?></p>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script type="text/javascript">
$(document).ready(function() {
$(".usercountry").hide();
});
//==========ON CHANGE LOAD CITY==========
$(".spPostingsState").on("change", function() {

//alert(this.value);
var state = this.value;
$.post("loadUserCity.php", {
state: state
}, function(r) {
//alert(r);
$(".loadCity").html(r);
});

});
//==========ON CHANGE LOAD CITY==========





$(document).ready(function() {
$("#dt1").datepicker({
dateFormat: "yy-mm-dd",
minDate: 0,
onSelect: function() {
var dt2 = $('#dt2');
var startDate = $(this).datepicker('getDate');
//add 30 days to selected date
startDate.setDate(startDate.getDate() + 30);
var minDate = $(this).datepicker('getDate');
var dt2Date = dt2.datepicker('getDate');
//difference in days. 86400 seconds in day, 1000 ms in second
var dateDiff = (dt2Date - minDate) / (86400 * 1000);

//dt2 not set or dt1 date is greater than dt2 date
if (dt2Date == null || dateDiff < 0) {
//dt2.datepicker('setDate', minDate);
}
//dt1 date is 30 days under dt2 date
else if (dateDiff > 30) {
dt2.datepicker('setDate', startDate);
}
//sets dt2 maxDate to the last day of 30 days window
dt2.datepicker('option', 'maxDate', startDate);
//first day which can be selected in dt2 is selected date in dt1
dt2.datepicker('option', 'minDate', minDate);
}
});
$('#dt2').datepicker({
dateFormat: "yy-mm-dd",
minDate: 0
});
});
</script>
</body>

</html>
<?php
}
?>
