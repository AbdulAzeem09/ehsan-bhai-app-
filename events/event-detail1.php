<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "events/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";

if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 5 || $_SESSION['ptid'] == 6) {
} else {
$re = new _redirect;
$re->redirect($BaseUrl . "/events");
}


if (isset($_GET['postid']) && $_GET['postid'] > 0) {
$p = new _spevent;

$result = $p->read_event_first_data($_GET['postid']);



if ($result != false) {

$row = mysqli_fetch_assoc($result);


$user_id = $row['user_id'];
$id = $row['id'];
$eventOrgId = $row['eventOrgId'];
$event_category = $row['event_category'];
$event_title = $row['event_title'];
$catchy_phrase = $row['catchy_phrase'];
$event_description = $row['event_description'];
$county_id = $row['county'];
$state_id = $row['state'];
$city_id = $row['city'];
$event_address = $row['event_address'];
$name_of_place = $row['name_of_place'];
$event_platform_title = $row['event_platform_title'];
$event_type = $row['event_type'];
$registaion = $row['registaion'];
$event_capacity = $row['event_capacity'];
$organizer_name = $row['organizer_name'];
$start_date = $row['start_date'];
$end_date = $row['end_date'];
$start_time = $row['start_time'];
$sponsorId = $row['sponsorId'];
$event_payment_type = $row['event_payment_type'];
$end_time = $row['end_time'];
$created_at = $row['created_at'];
$updated_at = $row['updated_at'];

$co = new _country;
$countyData = $co->readCountryName($county_id);

$pr = new _state;
$stateData = $pr->readStateName($state_id);

$co = new _city;
$cityData = $co->readCityName($city_id);

if ($countyData != false) {
while ($row3 = mysqli_fetch_assoc($countyData))
{
$county =  $row3['country_title'];
}
}

if ($stateData != false){
while ($row3 = mysqli_fetch_assoc($stateData))
{
$state =  $row3['state_title'];
}
}

if ($cityData != false){
while ($row3 = mysqli_fetch_assoc($cityData))
{
$city =  $row3['city_title'];
}
}

$currency = $row['default_currency'];
$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];
$registration_req = $row['registration_req'];
$specification     = $row['specification'];
$eventtype = $row['event_payment_type'];
$ArtistName = $row['spProfileName'];
$ArtistId   = $row['spProfiles_idspProfiles'];
$ArtistAbout = $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$expDate    = $row['spPostingExpDt'];
$hallcapacity    = $row['hallcapacity'];
$eventcategory    = $row['eventcategory'];

$pr = new _spprofilehasprofile;
$result3 = $pr->frndLeevel($_SESSION['pid'], $row['spProfiles_idspProfiles']);
if ($result3 == 0) {
$level = '1st Connection';
} else if ($result3 == 1) {
$level = '1st Connection';
} else if ($result3 == 2) {
$level = '2nd Connection';
} else if ($result3 == 3) {
$level = '3rd Connection';
} else {
$level = 'Not Define';
}

$venu = $row['spPostingEventVenue'];
$eventaddress = $row['eventaddress'];
$totaleventCapacity = $row['totaleventCapacity'];
$startDate = $row['spPostingStartDate'];
$endDate = $row['spPostingEndDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$OrganizerId = $row['spPostingEventOrgId'];
$Organizername = $row['spPostingEventOrgName'];
$Quantity = $row['ticketcapacity'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}
} else {
$re = new _redirect;
$redirctUrl = "../events";
$re->redirect($redirctUrl);
}

if (isset($_GET['visibility']) && $_GET['visibility'] == -1) {
$visibil = 1;
} else {
$visibil = 0;
}

$registrationCheck = $p->event_registration_read($_GET['postid'],$_SESSION['uid']);


$ticketCheck = $p->user_event_tickets_read($_SESSION['uid'],$_GET['postid']);
$user_ticket_id = 0;
if ($ticketCheck != false) {

$ticketCheckVal = mysqli_fetch_assoc($ticketCheck);

if(isset($ticketCheckVal['id'])){
$user_ticket_id = $ticketCheckVal['id'];
}
}

if ($registrationCheck != false) {

$registrationCheckVal = mysqli_fetch_assoc($registrationCheck);

if(isset($registrationCheckVal['id'])){
$user_registration = $registrationCheckVal['id'];
}
}

if(!empty($_POST['type'] === "ticket_store")) {

$totalAmount = 0;
$count = [];
$amount = [];
$type = [];
if(count($_POST['data']) > 0){
echo "33333333333";
foreach ($_POST['data'] as $datum) {
if(!isset($datum['totalAmount'])){
$count[] = $datum['count'];
$amount[] = $datum['amount'];
$type[] = $datum['type'];
}else{
$totalAmount =   $datum['totalAmount'];
}
}
}
$finalCount = implode(',',$count);
$finalAmount = implode(',',$amount);
$finalType = implode(',',$type);

$input = [
'user_id' => $_POST['user_id'],
'post_id' => $_POST['id'],
'ticket_type' => $finalType,
'ticket_spot' => $finalCount,
'ticket_amount' => $finalAmount,
'total_amount' => $totalAmount
];
print_r($input);
$ticket_Id =  $p->user_event_tickets_Store($input);
echo 'success';
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
<?php include('../component/f_links.php'); ?>

<!--This script for posting timeline data End-->
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<!-- this script for slider art -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">

<link rel="stylesheet" href="../assets/css/magnific-popup/magnific-popup.css">
<script src="../assets/css/magnific-popup/jquery.magnific-popup.js"></script>

<script>
function checkqty(txb) {
var qty = parseInt(txb);
var actualQty = $("#spOrderQty").val();
//alert(actualQty);return false;
//console.log(actualQty);
if (qty > actualQty) {
document.getElementById("newValue").value = actualQty;
}
if (qty < 1) {
document.getElementById("newValue").value = 1;
//alert("less");
}

$('#payqty').val($('#newValue').val());
}

function checkqtynew(txb, limit, id) {
//alert('+++');
//return false;
var qty = parseInt(txb);

if (qty > limit) {
document.getElementById("newValue" + id).value = limit;
alert("you can not enter more than available qty");
}
if (qty < 1) {
document.getElementById("newValue" + id).value = 0;
//  alert("please enter more than 1 qty");
}
if (qty =='') {
document.getElementById("newValue" + id).value = 0;
alert("please enter more than 1 qty");
}


}
</script>

<style type="text/css">
div#profileshow {
padding-left: 0 !important;
}

div#groupshow {
padding-left: 0 !important;
}

.rating-box {
position: relative !important;
vertical-align: middle !important;
font-size: 18px;
font-family: FontAwesome;
display: inline-block !important;
color: lighten(@grayLight, 25%);
/*padding-bottom: 10px;*/
}

.swal2-title {

font-size: 28px!important;

}
.swal2-popup {

width: 44em!important;

}

.rating-box:before {
content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
position: absolute !important;
left: 0;
top: 0;
white-space: nowrap !important;
overflow: hidden !important;
color: Gold !important;

}

.ratings:before {
content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

.flag:hover {
color: #428bca !important;
}

.ui-autocomplete.ui-menu {
background: #fff;
max-width: 20%;
border: 1px solid #c5c5c5;
font-size: 1em;
padding: 3px 3em 6px 1em;
}

.ui-autocomplete.ui-menu .ui-menu-item {
line-height: 26px;
letter-spacing: 0.5px;
}


#full-stars-example {
/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
/* make hover effect work properly in IE */
/* hide radio inputs */
/* set icon padding and size */
/* set default star color */
/* set color of none icon when unchecked */
/* if none icon is checked, make it red */
/* if any input is checked, make its following siblings grey */
/* make all stars orange on rating group hover */
/* make hovered input's following siblings grey on hover */
/* make none icon grey on rating group hover */
/* make none icon red on hover */
}

#full-stars-example .rating-group {
display: inline-flex;
}

#full-stars-example .rating__icon {
pointer-events: none;
}

#full-stars-example .rating__input {
position: absolute !important;
left: -9999px !important;
}

#full-stars-example .rating__label {
cursor: pointer;
padding: 0 0.1em;
font-size: 2rem;
}

#full-stars-example .rating__icon--star {
color: orange;
}

#full-stars-example .rating__icon--none {
color: #eee;
}

#full-stars-example .rating__input--none:checked+.rating__label .rating__icon--none {
color: red;
}

#full-stars-example .rating__input:checked~.rating__label .rating__icon--star {
color: #ddd;
}

#full-stars-example .rating-group:hover .rating__label .rating__icon--star {
color: orange;
}

#full-stars-example .rating__input:hover~.rating__label .rating__icon--star {
color: #ddd;
}

#full-stars-example .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
color: #eee;
}

#full-stars-example .rating__input--none:hover+.rating__label .rating__icon--none {
color: red;
}

#half-stars-example {
/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
/* make hover effect work properly in IE */
/* hide radio inputs */
/* set icon padding and size */
/* add padding and positioning to half star labels */
/* set default star color */
/* set color of none icon when unchecked */
/* if none icon is checked, make it red */
/* if any input is checked, make its following siblings grey */
/* make all stars orange on rating group hover */
/* make hovered input's following siblings grey on hover */
/* make none icon grey on rating group hover */
/* make none icon red on hover */
}

#half-stars-example .rating-group {
display: inline-flex;
}

#half-stars-example .rating__icon {
pointer-events: none;
}

#half-stars-example .rating__input {
position: absolute !important;
left: -9999px !important;
}

#half-stars-example .rating__label {
cursor: pointer;
/* if you change the left/right padding, update the margin-right property of .rating__label--half as well. */
padding: 0 0.1em;
font-size: 2rem;
}

#half-stars-example .rating__label--half {
padding-right: 0;
margin-right: -0.6em;
z-index: 2;
}

#half-stars-example .rating__icon--star {
color: orange;
}

#half-stars-example .rating__icon--none {
color: #eee;
}

#half-stars-example .rating__input--none:checked+.rating__label .rating__icon--none {
color: red;
}

#half-stars-example .rating__input:checked~.rating__label .rating__icon--star {
color: #ddd;
}

#half-stars-example .rating-group:hover .rating__label .rating__icon--star,
#half-stars-example .rating-group:hover .rating__label--half .rating__icon--star {
color: orange;
}

#half-stars-example .rating__input:hover~.rating__label .rating__icon--star,
#half-stars-example .rating__input:hover~.rating__label--half .rating__icon--star {
color: #ddd;
}

#half-stars-example .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
color: #eee;
}

#half-stars-example .rating__input--none:hover+.rating__label .rating__icon--none {
color: red;
}

#full-stars-example-two {
/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
/* make hover effect work properly in IE */
/* hide radio inputs */
/* hide 'none' input from screenreaders */
/* set icon padding and size */
/* set default star color */
/* if any input is checked, make its following siblings grey */
/* make all stars orange on rating group hover */
/* make hovered input's following siblings grey on hover */
}

#full-stars-example-two .rating-group {
display: inline-flex;
}

#full-stars-example-two .rating__icon {
pointer-events: none;
}

#full-stars-example-two .rating__input {
position: absolute !important;
left: -9999px !important;
}

#full-stars-example-two .rating__input--none {
display: none;
}

#full-stars-example-two .rating__label {
cursor: pointer;
padding: 0 0.1em;
font-size: 2rem;
}

#full-stars-example-two .rating__icon--star {
color: orange;
}

#full-stars-example-two .rating__input:checked~.rating__label .rating__icon--star {
color: #ddd;
}

#full-stars-example-two .rating-group:hover .rating__label .rating__icon--star {
color: orange;
}

#full-stars-example-two .rating__input:hover~.rating__label .rating__icon--star {
color: #ddd;
}

.ui-autocomplete li.ui-menu-item {
font-size: 10px;
}

.new_class:hover {
color: #bf0f4d !important;
opacity: .8;

}

.intrestArea:hover {
color: #bf0f4d !important;
opacity: .8;
}

.btn:hover {
color: #bf0f4d !important;
opacity: .8;
}

#send1:hover {
color: #edeaeb !important;
opacity: .8;

}
.text-left {
text-align: left;
font-size: 14px;
}

.db_primarybtn {
background: #852ca3 !important;
}

.btn:hover {
color: #edeaeb !important;
opacity: .8;
}

.btn_fb {
background-color: #3b5999;
font-size: 14px;
color: white;
padding: 7px 12px;
border-radius: 8px;
}

.btn_fb:hover {
color: white;
background-color: #6178ab;
}

.btn_google {
background-color: #3b5999;
font-size: 14px;
color: white;
padding: 7px 12px;
border-radius: 8px;
}

.btn_tweet {
background-color: #55acee;
font-size: 14px;
color: white;
padding: 7px 2px 7px 9px;
border-radius: 8px;
}

.btn_tweet:hover {
color: white;
background-color: #6178ab;
}

.btn_linkdin {
background-color: #3b5999;
font-size: 14px;
color: white;
padding: 7px 4px 7px 10px;
border-radius: 8px;
margin: 5px;
}

.btn_linkdin:hover {
color: white;
background-color: #6178ab;
}

.btn_whatsapp {
background-color: #0f8f46;
font-size: 14px;
color: white;
padding: 7px 12px;
border-radius: 8px;
}

.btn_whatsapp:hover {
color: white;
background-color: #35b96e;
}

.mt_d {
margin-top: 10px;
}

</style>

<style>


/* Clear floats after the columns */
#hours-minutes-heading {
display: flex;

}

.date-time-detail {
display: flex;
}
.date-contante{
border-right: 2px solid;
}
.eds-align--center-vertical {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-pack: start;
-ms-flex-pack: start;
justify-content: flex-start;
-ms-flex-line-pack: center;
align-content: center;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
}
</style>

</head>

<body class="bg_gray">
<?php include_once("../header.php"); ?>
<!-- Modal for send a sms -->


<div class="container">
<div class=" row">
<div class="col-8">
<section class="event-detail">
<div class="">
<h2>When and where</h2>
<div class="row">
<div class="col-6 date-time-detail date-contante">
<div class="col-2" style="padding-top:5%;     text-align: center;">
<span class="event-icon" style=" border-radius: 10px; padding: 15px;background: bisque;">
<i class="fa fa-calendar-o" aria-hidden="true"></i>
</span>
</div>
<div class="col-10">
<h3 id="date-time-heading">Date and time</h3>
<p><span class=""><?php $date = strtotime($start_date); $starttime = strtotime($start_time); $endtime = strtotime($end_time); echo date('D ,F d', $date);?> · <?php echo date('h:s a', $starttime); ?> - <?php echo date('h:s a', $endtime); ?></span></p>
</div>
</div>

<div class="col-6 date-time-detail">
<div class="col-2" style="padding-top:5%;    text-align: center; ">
<span class="event-icon" style="  border-radius: 10px;  padding: 15px;background: bisque;">
<i class="fa fa-globe" aria-hidden="true"></i>
</span>
</div>
<div class="col-10" >
<h3 id="location-heading">Location</h3>

<p>
<?php
if($event_platform_title == 'Venu' || $event_platform_title == '' ){?>
<strong>
<?=$city?>
</strong>
<?=$event_address?>, <?=$state?> <?=$county?>
<?php }else if($event_platform_title == 'Online_event'){
echo 'online';
}else{
echo 'To Be Announce';
}
?>
</p>
</div>
</div>
</div>
<h2 class="mt-4">About this event</h2>
<div class="row mt-3">
<div class="col-6 date-time-detail">
<div class="col-2" style="padding-top:4%;    text-align: center; ">
<span class="event-icon" style=" border-radius: 10px;  padding: 15px;background: bisque;">
<i class="fa fa-clock-o" aria-hidden="true"></i>
</span>
</div>
<div class="col-10">
<h3 id="hours-minutes-heading">4 hours 30 minutes</h3>
</div>
</div>
<div class="col-6 date-time-detail ">
<div class="col-2" style="padding-top:4%;     text-align: center;">
<span class="event-icon" style=" border-radius: 10px; padding: 15px;background: bisque;">
<i class="fa fa-ticket" aria-hidden="true"></i>
</span>
</div>
<div class="col-10" >
<h3 id="Mobile-Ticket-heading">Mobile eTicket</h3>
</div>
</div>
</div>
<div class="mt-3">
<?php
if(!empty($event_description)){
echo $event_description;
}
?>
</div>
</div>
</section>
</div>
<div class="col-4">
<?php
if($user_ticket_id == 0){?>
<section class="event-tickit mt-5">
<div class="card col-6">
<div class="card-body">
<h5 class="card-title"><?=$event_title?></h5>
<p class="card-text">
<?php
if($event_type == '1'){
echo 'Free';
}else if($event_type  == '2'){
echo 'Paid';
}else{
echo '-';
}
?>
</p>
<button  class="btn btn-primary" onclick="checkRegister('<?= $registaion;?>');">Reserve a spot</button>
</div>
</div>
</section>
<?php } ?>
</div>
</div>

</div>




<div class="modal fade" id="register_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">
Registration
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="../events/event_registration.php?postid=<?php echo $id ?>" method="POST">
<div class="modal-body">
<div class="form-group">
<label for="name"> Name :<span style="color:red;">*</span></label>
<input type="text" class="form-control" id="name"  name="user_name" placeholder="Full Name" required>
</div>
<div class="form-group">
<label for="email1">Email address :<span style="color:red;">*</span></label>
<input type="email" class="form-control" id="email1" name="user_email"  aria-describedby="emailHelp" placeholder="Enter email" required>
</div>
<div class="form-group">
<label for="phone ">Phone :<span style="color:red;">*</span></label>
<input type="number" class="form-control" id="phone" name="user_phone"  placeholder="Phone" required>
</div>
<div class="form-group">
<label for="exampleInputEmail1">City :<span style="color:red;">*</span></label>
<input type="text" class="form-control" id="city" name="user_city" placeholder="City" required>
</div>
<div class="form-group">
<label for="exampleInputEmail1">State :<span style="color:red;">*</span></label>
<input type="text" class="form-control" id="state" name="user_state"  placeholder="State" required>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Country :<span style="color:red;">*</span></label>
<input type="text" class="form-control" id="country" name="user_country"  placeholder="Country" required>
</div>
<div class="form-group">
<label for="exampleInputEmail1">company name :</label>
<input type="text" class="form-control" id="company" name="user_company" placeholder="Company">
</div>
</div>
<div class="modal-footer">
<button type="submit" name="register_form" class="btn btn-primary" >Submit</button>
</div>
</form>
</div>
</div>
</div>

<div class="modal fade" id="ticket_nodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel">
Ticket
</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<form action="../events/event_registration.php?postid=<?php echo $id ?>" method="POST">
<div class="modal-body">
<div class="row">
<div class="col-6">
<?php
$p = new _spevent;
$ticketData = $p->event_tickets_read($_GET['postid']);


if ($ticketData != false){
while ($ticketDataRow = mysqli_fetch_assoc($ticketData))
{
?>
<div>
<div class="event_ticket">
<?=$ticketDataRow['ticket_type']?> ($<?=$ticketDataRow['price']?>)
</div>
<div class="d-flex">
<button type="button" class="ticket_member_count_minus_<?=$ticketDataRow['id']?> btn btn-danger" onclick="decrement('<?=$ticketDataRow['price']?>','<?=$ticketDataRow['id']?>')">
<i class="fa fa-minus"></i>
</button>
<input type="number" name="user_spot" value="0" min="0" max="10" class="ticket_member_count_<?=$ticketDataRow['id']?> form-control w-25" required>
<input type="hidden" name="user_spot" value="<?=$ticketDataRow['ticket_type']?>" class="ticket_member_count_<?=$ticketDataRow['id']?> form-control w-25" required>
<button type="button" class="ticket_member_count_plus_<?=$ticketDataRow['id']?> btn btn-success" onclick="increase('<?=$ticketDataRow['price']?>','<?=$ticketDataRow['id']?>')">
<i class="fa fa-plus" ></i>
</button>
</div>
</div>
<?php }
}else{?>
<div>
<div class="event_ticket_">
Free Ticket
</div>
<div class="d-flex">
<button type="button" class="ticket_member_count_minus_0 btn btn-danger" onclick="decrement(0,0)">
<i class="fa fa-minus"></i>
</button>
<input type="number" name="user_spot" value="0" min="0" max="10" class="ticket_member_count_0 form-control w-25" required>
<input type="hidden" name="user_spot" value="Free" class="ticket_member_count_0 form-control w-25" required>
<button type="button" class="ticket_member_count_plus_0 btn btn-success" onclick="increase(0,0)">
<i class="fa fa-plus" ></i>
</button>
</div>
</div>
<?php }?>
</div>
<div class="col-6">
<div>
<label>Order summary</label>
<?php
$p = new _spevent;
$ticketData = $p->event_tickets_read($_GET['postid']);
if ($ticketData != false){
while ($ticketDataRow1 = mysqli_fetch_assoc($ticketData))
{
?>
<div style="display: flex; justify-content: space-between;">
<p><span id="ticket_member_count_<?=$ticketDataRow1['id']?>">0</span> x <?=$ticketDataRow1['ticket_type']?></p>
<p><b>$<span class="free_ticket_total_<?=$ticketDataRow1['id']?> final_amount">0</span></b></p>
<input type="hidden" class="final_amount_id" value="<?=$ticketDataRow1['id']?>" >
<input type="hidden" id="event_type_<?=$ticketDataRow1['id']?>" value="<?=$ticketDataRow1['ticket_type']?>">
</div>
<?php       }
}else{

?>
<div style="display: flex; justify-content: space-between;">
<p><span id="ticket_member_count_0">0</span> x Free Ticket</p>
<p><b>$<span class="free_ticket_total_0 final_amount">0</span></b></p>
<input type="hidden" class="final_amount_id" value="0" >
</div>
<?php  } ?>
<div class="divider" style="content: ''; width: 100%; color: black; border: 1px solid;"></div>
<div style="display: flex; justify-content: space-between;">
<p><label>Total</label></p>
<p><b>$<span class="ticket_total">0</span></b></p>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary submit_ticket">Submit</button>
</div>
</form>
</div>
</div>
</div>

<section class="eventGallery mt-3">
<div class="container">
<div class="row">
<div class="col-sm-12">
<ul class="nav nav-tabs" id="navtabFrnd" style="border-radius: 20px;">
<li class="active">
<a data-toggle="tab" href="#home" style="border-top-left-radius: 20px;
border-bottom-left-radius: 20px;">Gallery</a>
</li>

<li><a data-toggle="tab" href="#menu3">Sponsors</a></li>
<li><a data-toggle="tab" href="#menu4">Featuring</a></li>
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<li><a data-toggle="tab" href="#menu5">Contact Organizer</a></li>
<?php } ?>
<li><a data-toggle="tab" href="#menu6">Specification</a></li>
<li><a data-toggle="tab" href="#menu7">Seating Layout</a></li>

<?php

if ($_GET['groupid']) {
//die('==');
?>
<li><a data-toggle="tab" href="#menu7">Group Name</a></li>
<?php } ?>
</ul>

<div class="tab-content" style="min-height: 300px;">
<div id="home" class="tab-pane fade in active">
<div class="space"></div>
<div class="row">
<?php
$pic = new _eventpic;
$res2 = $pic->readGallery($_GET['postid']);


if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['image_name'];

?>
<div class="col-md-3">
<div class="EvntImg">
<a class="thumbnail eventpostimg mag" data-effect="mfp-newspaper" href="<?php echo $pic2; ?>" title="<?php echo $ProTitle; ?>">

<img class="group1 eventpostimg" src="<?php echo $pic2; ?>">
</a>

</div>
</div>
<?php
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
} ?>
</div>
</div>
<div id="menu7" class="tab-pane fade in">
<div class="space"></div>
<div class="row">
<?php
$pic = new _eventpic;
$res2 = $pic->readlayout($_GET['postid']);


if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];
?>
<div class="col-md-3">
<div class="EvntImg">
<?php if($pic2) { ?>
<a class="thumbnail eventpostimg mag" data-effect="mfp-newspaper" href="<?php echo $pic2; ?>" title="<?php echo $ProTitle; ?>">

<img class="group1 eventpostimg" src="<?php echo $pic2; ?>">
</a>
<?php } ?>

</div>
</div>
<?php
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
} ?>
</div>
</div>






<div id="menu1" class="tab-pane fade">
<div class="space"></div>
<div class="row">
<?php
$media = new _postingalbum;
$result = $media->read($_GET['postid']);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if ($sppostingmediaExt == 'mp4') { ?>
<div class="col-md-offset-3 col-md-6">
<div style='margin-left:15px;margin-right:15px;'>
<video style='max-height:300px;width: 100%' controls>
<source src='<?php echo $BaseUrl . '/upload/' . $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
</video>
</div>
</div>
<?php
}
} ?>
</div>
</div>
<div id="menu2" class="tab-pane fade">

</div>
<div id="menu3" class="tab-pane fade ">

<div class="">
<div class="space"></div>
<div class="SponsrTitle">

<?php
$SpCat = "General";
include('sponsor.php');
?>
</div>


</div>
</div>
<div id="menu4" class="tab-pane fade">
<h3>Featuring</h3>
<div class="row">
<?php

$splinkp = new _spevent;

$pro = new _spprofiles;
$allFeature = array();
if (isset($_GET['postid']) && $_GET['postid'] > 0) {

$result6 = $splinkp->read($_GET['postid']);

if ($result6 != false) {
while ($row6 = mysqli_fetch_assoc($result6)) {


if ($row6['addfeaturning'] != '') {

$allFeature = explode(",", $row6['addfeaturning']);
//print_r($allFeature);
for ($i = 0; $i < count($allFeature); $i++) {

if ($allFeature[$i] != '') {


$profileId = $allFeature[$i];
$result7 = $pro->read($profileId);
if ($result7 != false) {

$row7 = mysqli_fetch_assoc($result7);

?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>">
<div class="col-md-3 no-padding">
<?php
echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "../assets/images/blank-img/default-profile.png") . "'>";
?>
</div>
<div class="col-md-9 no-padding">
<h4 class="eventcapitalize"><?php echo $row7['spProfileName']; ?></h4>
</div>
</a>
</div>
</div>
<?php
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
}
}else{
echo "<h3 class='text-center'>No record Found!</h3>";
}
}
} else {
//die('=====');
echo "<h3 class='text-center'>No record Found!</h3>";
}
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
?>


</div>
</div>
<div id="menu5" class="tab-pane fade">
<div class="space"></div>
<div class="row">
<?php
//organizer id......
$pro = new _spprofiles;
$result7 = $pro->read($OrganizerId);
if ($result7 != false) {
$row7 = mysqli_fetch_assoc($result7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white p-5" style=" border-radius: 15px;">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $OrganizerId; ?>">
<div class="col-md-3 no-padding">
<?php
echo "<img  alt='profile-Pic' style='border-radius: 10px;' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "../img/default-profile.png") . "'>";
?>
</div>
</a>
<div class="col-md-9 no-padding">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $OrganizerId; ?>">
<h4 class="eventcapitalize"><?php echo $row7['spProfileName']; ?></h4>
</a>
<span class="dropdown">
<button type="button" id="send1" class="btn btnPosting db_btn db_primarybtn dropdown-toggle" data-sender="" data-reciver="<?php echo $_GET["profileid"]; ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="sendmesg"><span class="fa fa-paper-plane"></span> Send Message</button>

<div class="dropdown-menu bradius-15" id="popform" aria-labelledby="dropdownMenu1">
<span id="span2" style="color:red"></span>
<form action="" method="post">
<div class="form-group" style="margin:3px;">
<textarea class="form-control frndmsg" rows="4" id="sndmsg" required name="spfriendChattingMessage" placeholder="Type your message here..."></textarea>
</div>

<button type="button" class="btn btn-primary pull-right wthmsg db_btn db_primarybtn" data-reciver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" id="sendermesg">Send</button>
</form>
</div>
</span>
</div>

<div class="col-sm-12">

<!-- <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms">Contact Organizer</span> -->
</div>
</div>
</div>
<?php
} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
//co-Host persons.
$pf  = new _postfield;
$pro = new _spprofiles;
$ei  = new _eventJoin;
if (isset($_GET['postid']) && $_GET['postid'] > 0) {
$fieldName = "spPostingCohost_";
$result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
//echo $pf->ta->sql."<br>";
if ($result6 != false) {
while ($row6 = mysqli_fetch_assoc($result6)) {
if ($row6['spPostFieldValue'] != '') {
$profileId = $row6['spPostFieldValue'];
$result7 = $pro->read($profileId);
if ($result7 != false) {
$row7 = mysqli_fetch_assoc($result7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin" style="border-radius: 15px;">
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>">
<div class="col-md-3 no-padding">
<?php
echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "../img/default-profile.png") . "'>";
?>
</div>
<div class="col-md-9 no-padding">
<h4><?php echo $row7['spProfileName']; ?></h4>
</a>
<div class="col-sm-12">
<span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $profileId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms getCntactid">Contact Organizer</span>
</div>
</div>
</div>
<!-- <a class="cohost" href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>"><?php echo $row7['spProfileName']; ?></a>, -->
<?php
}
}
}
}
}
?>
</div>
</div>
<div id="menu6" class="tab-pane fade">

<div style="margin-top: 10px;margin-left: 25px;">

<p><b>EVENT CATEOGRY : </b><?php echo $eventcategory; ?></p>
<p><b>VENUE NAME : </b><?php echo $venu; ?></p>
<p><b>EVENT ADDRESS : </b><?php echo $eventaddress; ?></p>
<p><b>EVENT CAPACITY : </b><?php echo $hallcapacity; ?></p>
<p><b>START DATE : </b><?php echo $startDate ?></p>
<p><b>END DATE : </b><?php echo $expDate ?></p>
<p><b>START TIME : </b><?php echo date("h:i A", $dtstrtTime); ?></p>
<p><b>END TIME : </b><?php echo date("h:i A", $dtendTime); ?></p>


</div>
</div>

<div id="menu7" class="tab-pane fade">

<div class="row">
<?php
$sg = new _spgroup;
$result = $sg->readdatabyspid($_GET['groupid']);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$spGroupName = $r['spGroupName'];
}

if (!empty($spGroupName)) {

?>
<div class="col-sm-12">
<p style="padding-top: 20px;padding-left: 20px;"> <a href="<?php echo  $BaseUrl . '/grouptimelines/?groupid=' . $_GET['groupid'] . '&groupname=' . $spGroupName . '&timeline&page=1'; ?>"><b><?php echo $spGroupName; ?><b></a></p>
</div>
<?php


} else {
echo "<h3 class='text-center'>No record Found!</h3>";
}
?>


</div>
</div>
<!-- End tabs -->
</div>
</div>

</div>

</div>
</section>

<?php include('postshare.php'); ?>
<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function() {
//alert();
$(".mySelect").select2();
$('.submitevent').click(function() {
//  alert();

var flagdesc = $('#flag_desc').val();
if (flagdesc == "") {
$('#flagdesc_error').text("This Field is Required.");
$("#flag_desc").focus();
return false;

} else {
$("#addflagdata").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
});
</script>


<script type="text/javascript">
function keyupflagfun() {

var flagdesc = $("#flag_desc").val()

if (flagdesc != "") {
$('#flagdesc_error').text(" ");
}
}
</script>
<script type="text/javascript">
$('.thumbnail').magnificPopup({
type: 'image'
// other options
});
</script>

<script>
var _gaq = [
['_setAccount', 'UA-XXXXX-X'],
['_trackPageview']
];
(function(d, t) {
var g = d.createElement(t),
s = d.getElementsByTagName(t)[0];
g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
s.parentNode.insertBefore(g, s)
}(document, 'script'));
// Colorbox Call
$(document).ready(function() {
$("[rel^='lightbox']").prettyPhoto();
});
$(".buyn").click(function() {
var qty = $(".getqty").val();
if (qty > 0) {
$(".buyform").submit();
}
});
</script>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
$(document).ready(function(){
$("#form1").submit(function(){
//alert('++++');
var qty1=$(".abcd").length;
var arr = [];
var p= 0;

for(var i=0;i<qty1;i++){
var qty_=$('#newValue_1'+i).val();

var input_qty=$('#newValue'+qty_).val();
if(input_qty!=0){
arr[p++] = input_qty;
}

}
var bb=arr.length;

if(bb==0){

Swal.fire('Please enter more than 0 qty');

return false;

}

});
});

function checkRegister(id){
var check = <?php
if($user_registration){
echo   $user_registration;
}else{
echo 0;
}
?>;
if(id !== '0'){
if(check > 0){
$('#ticket_nodal').modal('show');
}else {
$('#register_modal').modal('show');
}
}else{
$('#ticket_nodal').modal('show');
}
}


function increase(amount,id){
var count = $('.ticket_member_count_'+id).val();
if (count) {
if(count < 10){
$('.ticket_member_count_plus_'+id).removeAttr("disabled");
$('.ticket_member_count_minus_'+id).removeAttr("disabled");
var incCount = parseInt(count);
incCount =  incCount+1;

$('.ticket_member_count_'+id).val(incCount);
$('#ticket_member_count_'+id).text(incCount);
if(incCount == 10 ){
$('.ticket_member_count_plus_'+id).attr("disabled",'disabled');
}
incCount =  incCount * parseInt(amount);
$('.free_ticket_total_'+id).text(incCount);
}
else{
$('.ticket_member_count_plus_'+id).attr("disabled",'disabled');
}
}else {
$('.ticket_member_count_'+id).val(0);
$('#ticket_member_count_'+id).text(0);
$('.free_ticket_total_'+id).text(0);
}

finalAmount();
}

function decrement(amount,id){
var count = $('.ticket_member_count_'+id).val();
console.log(count);
if (count) {
if (count > 0) {
$('.ticket_member_count_plus_'+id).removeAttr("disabled");
$('.ticket_member_count_minus_'+id).removeAttr("disabled");
var incCount = parseInt(count);
incCount = incCount - 1;

$('.ticket_member_count_'+id).val(incCount);
$('#ticket_member_count_'+id).text(incCount);
if (incCount == 0) {
$('.ticket_member_count_minus_'+id).attr("disabled", 'disabled');
}
incCount =  incCount * parseInt(amount);
$('.free_ticket_total_'+id).text(incCount);


} else {
$('.ticket_member_count_minus_'+id).attr("disabled", 'disabled');
}
}else {
$('.ticket_member_count_'+id).val(0);
$('#ticket_member_count_'+id).text(0);
$('.free_ticket_total_'+id).text(0);
}
finalAmount(); 
}
function finalAmount() {
var total = 0;
$( ".final_amount" ).each(function( index ) {
if($( this ).text() !== 0){
total = parseInt($( this ).text()) + total;
}
});
$('.ticket_total').text(total);
}


$('.submit_ticket').on('click',function () {

var tickets = [];
var total = 0;

$(".final_amount_id").each(function(index){
var id = $(this).val();

var  ticketCount =  $('#ticket_member_count_'+id).text();
var  ticketAmount =  $('.free_ticket_total_'+id).text();
var  ticketType =  $('#event_type_'+id).val();

tickets.push({
count: ticketCount,
amount: ticketAmount,
type: ticketType,
});

console.log("+++++++++++++");
console.log(tickets);
console.log("+++++++++++++");
});

$( ".final_amount" ).each(function( index ) {
if($( this ).text() !== 0){
total = parseInt($( this ).text()) + total;
}
});

tickets.push({totalAmount : total});

console.log("----------------");
console.log(tickets);
console.log("----------------");

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

var user_id = '<?php if($_SESSION['uid']){echo $_SESSION['uid'];}else{ echo 0;} ?>';
var id = '<?php if($_GET['postid']){echo $_GET['postid'];}else{ echo 0;} ?>';
var type = 'ticket_store';

$.ajax({
url: "",
method: 'POST',
data: {data:tickets,user_id:user_id,id:id,type:type},
error : function(err){
console.log('Error!', err)
},
success: function(data) {
if(data == 'success'){
window.location = '';
}
}
});
});
</script>
<!-- image gallery script end -->
</body>

</html>
<?php
}
?>