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
}/* else {
$re = new _redirect;
$re->redirect($BaseUrl . "/events");
}*/


$postId = isset($_GET["postid"]) ? (int)$_GET["postid"] : 0;


if ($postId > 0) {
$p = new _spevent;

$result = $p->singletimelines($postId);
if ($result != false) {

$row = mysqli_fetch_assoc($result);
//echo '<pre>';
//print_r($row);
$currency = $row['default_currency']; 
$idd = $row['idspPostings']; 
$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];
$spPostingReturnPolicy     = $row['spPostingReturnPolicy'];
$registration_req = $row['registration_req'];
$specification     = $row['specification'];
$eventtype = $row['event_payment_type'];
$ArtistName = $row['spProfileName'];
$ArtistId   = $row['spProfiles_idspProfiles'];
$ArtistAbout = $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city      = $row['spPostingsCity'];
$expDate    = $row['spPostingExpDt'];
$hallcapacity    = $row['hallcapacity'];
$EventTicketUrl    = $row['EventTicketUrl'];
$eventcategory    = $row['eventcategory'];
$Organizeremail = $row['spPostingEventOrgEmail'];
$Organizerphone = $row['spPostingEventOrgPhone'];
$latitude = $row['EventLatitude'];
$longitude = $row['EventLongitude'];
$Ethnicity = $row['Ethnicity'];
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
<script src="js/jquery.min.js"></script>

<!-- JS & CSS library of MultiSelect plugin -->
<script src="js/multiselect/jquery.multiselect.js"></script>
<link rel="stylesheet" href="js/multiselect/jquery.multiselect.css">

<script>
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
// if (qty < 1) {
//   //alert('111');
// document.getElementById("newValue" + id).value = 1;
// //  alert("please enter more than 1 qty");
// }
// if (qty =='') {
// alert('+++');
// document.getElementById("newValue" + id).value = 1;
// document.getElementById("newValue" + id).value = 0;
// alert("please enter more than 1 qty");
// }


}
</script>

<style type="text/css">
#map {
       height: 400px;
       width: 100%;
     }

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

.eventcapitalize{
  word-wrap: break-word;
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





.modal-backdrop {
position: fixed;
top: 0;
right: 0;
bottom: 0;
left: 0;
z-index: 1040;
background-color: #000;
}


  /*eventdetails css*/
  .titleEvent p strong {
    color: #000 !important;
}
.space p b {
    color: #c11f50 !important;
}
.space p {
    padding-bottom: 30px;
}
.rtrn-bx {
    display: flex;
}
.rtrn-bx p:nth-child(2) {
    color: #000 !important;
}
.titleEvent p {
    font-size: 14px;
    font-family: "Proxima Nova";
   // color: rgba(40, 40, 40, .502);
    color: #000 !important;
    margin: 0 0px 0 15px !important;
}
.rtrn-bxs b, .rtrn-bx b {
    color: #c11f50 !important;
    font-size: 15px;
    margin-left: 14px;
}
.rtrn-bxs p {
    color: #000 !important;
    padding-bottom:0px;
}
.rtrn-bx, .rtrn-bxs {
    padding: 6px 0;
}
a.lft-p {
    margin: 0 0 0 16px;
}
div#social-share {
    margin-left: 14px;
}
.org_details{
    margin: 8px 0px 0px 12px;
}
.org_details div label {
    color: #c11f50 !important;
}
.org_contact{

}
.org_contact label {
    font-size: 14px;
    width: 100%;
}
.org_contact input[type="text"] {
    width: 500px;
    height: 31px;
    border: 1px solid #c3c3c3;
}
.org_contact input[type="email"] {
    width: 500px;
    height: 31px;
    border: 1px solid #c3c3c3;
}
.org_contact textarea {
    border: 1px solid #c3c3c3;
}
.org_contact {
    margin-left: 10px;
}
.tab-content {
    background: #e9e9e9;
    border-radius: 20px;
    border: 1px solid #c3c3c3;
    padding-top: 20px;
}
.lft-p{
    border: 1px solid #564d50;
    border-radius: 8px;
    padding: 7px;
    background: #c11f50;
    color: #fff;
}
/*map*/
div#map {
    margin-top: 52px;
    width: 345px;
    margin-left: -20px;
    position: sticky !important;
    top: 227px;
    border: 1px solid #C1C0C0;
}
.innr-imgdtls {
    height: auto !important;
    border: 1px solid #C1C0C0;
    border-radius: 2px;
    margin-bottom: 20px !important;
    width: 348px;
}

.img-responsive {
    display: block;
    max-width: 100%;
}
/*form*/
.frst-bx {
    display: flex;
    padding: 0 60px;
}
.inr-frmbx {
    flex: 0 0 50%;
}
.form-group.tw-bxs {
    display: flex;
}
.tw-bx input[type="text"], input[type="email"], input[type="text"], textarea#sndmsg {
    width: 100%;
    padding: 10px;
    border: 0px;
    border-radius: 6px;
}
.innr-frm input[type="text"] {
    margin-left: 10px !important;
    width: 96%;
}
.innr-frm {
    flex: 0 0 50%;
}
i.fa.fa-user, i.fa.fa-envelope, i.fa.fa-phone {
    color: #c11f50;
    font-size: 20px;
}
.icon-bx label {
    font-size: 19px;
    color: #000;
}
.icon-bx {
    padding: 10px 0;
}
.icon-bx p {
    font-size: 16px;
}
.form-group.tw-bx label, .form-group.tw-bxs label {
    font-size: 16px;
}
td.full-wdth button {
    float: inline-end;
}
button.sbmt-btn {
    background: #c11f50 !important;
    padding: 10px 20px;
    border: 0px;
    border-radius: 15px;
    color: #fff;
}


#show_image_popup{
    width: 100%;
    height: 100%;
    border: 1px solid #333;
    box-sizing: border-box;
    padding: 5px;
    text-align: center;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: #62626240;
    display: none;
    z-index: 9999;
}
#show_image_popup img{
    max-width: 90%;
    height: auto;
}
#all-images .active{
    filter: blur(5px);
}
.close-btn-area{
    width: 100%;
    text-align: right;
    margin-bottom: 5px;
}
.close-btn-area button{
    cursor: pointer;
}
input.btn.butn_save.savesubmitbtn.btn-border-radius:hover {
    color: #fff !important;
}
.EvntImg img.group1.eventpostimg {
    height: 233px !important;
}
</style>



</head>

<body class="bg_gray">
<?php include_once("../header.php"); ?>
<!-- Modal for send a sms -->
<div id="sendAsms" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content" style="border-radius: 15px; ">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Send a sms</h4>
</div>
<div class="row no-margin">

<?php
$pro = new _spprofiles;
$result7 = $pro->read($OrganizerId);
if ($result7 != false) {
$row7 = mysqli_fetch_assoc($result7);
?>
<a href="<?php echo $BaseUrl . '/friends/?profileid=' . $OrganizerId; ?>"><?php echo $row7['spProfileName']; ?></a>
<?php
}
?>
)</label>
</div> -->
</div>
<form method="post" action="../friendmessage/sendSms.php" id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data">
<input type="hidden" name="spProfiles_idspProfilesSender" id="spProfiles_idspProfilesSender" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spprofiles_idspProfilesReciver" id="spprofiles_idspProfilesReciver" value="<?php echo $OrganizerId; ?>">

<div class="modal-body">
<div class="row">
<div class="col-sm-12">
<div class="sp-post-edit">
<div class="form-group">
<label>Message</label>
<textarea class="form-control" name="spfriendChattingMessage"></textarea>
</div>
</div>
<button type="submit" class="btn pull-right btnSendSms" <?php echo ($_SESSION['pid'] == $OrganizerId) ? 'disabled' : ''; ?> id="sendEventSms">Send Message</button>
<button type="button" class="btn pull-right" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<section class="topDetailEvent">
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6 text-center">

<?php


if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
if ($_SESSION['count'] <= 1) {
$_SESSION['count'] += 1; ?>
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> <?php
unset($_SESSION['errorMessage']);
}
} ?>

</div>
<div class="col-md-3"></div>
</div>
<div class="row">
<div class="col-sm-12 text-center">
<h1 class="titDetail text-uppercase text-light"><?php echo $ProTitle; ?></h1>
<h4 class="text-white fs-2 text-light"><?php echo $specification; ?></h4>
<p class="location eventcapitalize"><i class="fa fa-map-marker"></i> <?php echo $venu; ?></p>
</div>
</div>
<div class="row">
<div class="col-md-offset-1 col-md-10">
<div class="transTop">
<div class="row">
<div>
<div class="detailTopcol text-center">
    <h3>Date</h3>
    <img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-1.png" class="img-responsive">
    <p><?php echo $startDate; ?></p>
</div>
</div>

</div>
</div>


</div>
</div>
</div>
</section>
<section class="main_box">
<div class="container">
<div class="row">
<div class="col-md-offset-1 col-md-10">
<div class="twolevelEvent">
<ul class="social">
<li><?php if (isset($_GET['groupid']) && isset($_GET['groupname'])) { ?>
<a href="<?php echo $BaseUrl . '/grouptimelines/group-event.php?groupid=' . $_GET['groupid'] . '&groupname=' . $_GET['groupname']; ?>">
<span class="iconhover"><i class="fa fa-home"></i></span>
Home
</a>
<?php } else { ?>
<a href="<?php echo $BaseUrl . '/events'; ?>">
<span class="iconhover"><i class="fa fa-home"></i></span>
Home
</a>
<?php } ?>
</li>
<li class="bokmarktab">
<?php


$ev = new _event_favorites;
$res_ev = $ev->chekFavourite($postId, $_SESSION['pid'], $_SESSION['uid']);


if ($res_ev != false) {


?>

<a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $postId; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
<span id="removetofavouriteeve" class="iconhover"><i style="font-size:33px;" class="fa fa-heart"></i></span>

</a>

<?php
} else {
?>
<a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $postId; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
<span id="addtofavouriteeve" class="iconhover"><i style="font-size:33px;" class="fa fa-heart-o"></i></span>

</a>
<?php
}
?>


</li>
<li>

<?php

$r = new _speventreview_rating;

$sumres = $r->readeventrating($postId);



?>

<div class="row reviewdetail">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'] ?>" />
<input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $postId ?>">
</div>
</li>
<li>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($postId, $_SESSION['pid']);
if ($result != false) {
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];

if ($area == 2) {
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
} else if ($area == 1) {
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";
} else if ($area == 0) {
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
} else {
$title = "Event";
}

$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($postId, 2);
if ($resulti1 != false && $resulti1->num_rows > 0) {
$going = $resulti1->num_rows;
} else {
$going =  0;
}

$resulti2 = $ie->chekGoing($postId, 1);
if ($resulti2 != false && $resulti2->num_rows > 0) {
$interested = $resulti2->num_rows;
} else {
$interested =  0;
}


$resulti3 = $ie->chekGoing($postId, 0);
if ($resulti3 != false && $resulti3->num_rows > 0) {
$MayBe = $resulti3->num_rows;
} else {
$MayBe =  0;
}
?>

<span id="">
<i class="fa fa-calendar"></i>
</span>
<div class="ie_<?php echo $postId; ?>">

<div class="dropdown intrestEvent " id="eventDetaildrop" style="display: block;">
<button class="new_class" id="button2" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;    padding: 3px 15px;"><?php echo $title; ?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intrestArea" id="go1" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $postId; ?>" data-area="2"><?php echo $area2; ?> Going (<?php echo $going; ?>) </a></li>
<li><a href="javascript:void(0)" class="intrestArea" id="inter1" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $postId; ?>" data-area="1"><?php echo $area1; ?> Interested (<?php echo $interested; ?>)</a></li>
<li><a href="javascript:void(0)" class="intrestArea" id="may1" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $postId; ?>" data-area="0"><?php echo $area0; ?> May Be (<?php echo $MayBe; ?>)</a></li>
</ul>
</div>
</div>
</li>

<li>
<?php
$pic = new _eventpic;
$res2 = $pic->read($postId);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
} else {
}

?>
<a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'>

<span class='sp-share-art iconhover' data-postid='<?php echo $postId; ?>' src='<?php echo ($pic2); ?>'>
<i class="fa fa-share-alt"></i>
</span>
Share
</a>
</li>
</ul>
</div>
</div>
</div>
<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">
<div class="row">
<div class="col-sm-12">
<div class="titleEvent">
<div class="row">
<div class="col-md-5">
<div class="hostedbyevent">
<h1 class="titDetail text-uppercase"><?php echo $ProTitle; ?></h1>
<!-- <label style="margin-left: 15px;">Organizer :</label>

<a class="cohost" href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>"><?php echo $pic->getOrganizerName($Organizername); ?></a> -->


</div>
</div>

</div>

<div class="row">

<div class="col-md-8 frm-tlt">
<h2 class="eventcapitalize"><span>Event Details</span></h2>

<?php
if ($visibil == 1) {
?>
<!--Privew Button Code button-->
<div class="col-md-4">
<div class="<?php echo ($visibil == 1 ? "" : "hidden"); ?>">
<div class="text-center" style="margin-bottom:10px;">
<button type="button" id="submitpost" class="btn butn_save" data-visibility="-1" data-postid="<?php echo $postId; ?>">Submit</button>
<button type="button" id="saveindraft" class="btn butn_draf">Save Draft</button>

</div>
</div>
</div>
<!--Completed-->
<?php
}
?>
<input type="hidden" value="<?php echo $latitude; ?>" id="latitude">
<input type="hidden" value="<?php echo $longitude; ?>" id="longitude">

<span class="text-justify eventcapitalize eventcapitalizess" style="font-weight: bold; text-align: justify; line-height: 1.5; word-wrap:break-word;"><?php echo $ProDes; ?></span><br>
<!--dropdown event-->
<div class="event-drpdwn">

</div>

<div class="space">
<div class="rtrn-bx">
    <div><b>VENUE</b> : <?php echo $venu ?></div>
</div>

<?php 
if (!empty($startTime)) {
    $dy = new DateTime($startTime);
    $day = $dy->format('d');
    $month = $dy->format('M');
    $weak = $dy->format('D');
} else {
    $day = 0;
    $month = "&nbsp;";
    $weak = "&nbsp;";
}
?>
<div class="rtrn-bx">
    <div><b>DATE & TIME</b> : <?php echo ' ' . $weak; ?>, <?php echo $month . ' ' . $day; ?> , <?php echo date('Y', strtotime($startDate)); ?><b style="margin-left: 0px;">, Starts at</b> <?php echo date("h:i A", $dtstrtTime); ?></div>
</div>

<div class="rtrn-bxs"> 
    <div><b>RETURN POLICY</b> :</div>
    <div style="word-wrap:break-word;">
        <?php echo $spPostingReturnPolicy ?>
    </div>
</div>
</div>
<?php
    $pids = $_SESSION['pid'];
    $sp = new _flagpost;
    $spflag = $sp->readflag2($pids, $postId);
    if ($spflag != false) {
    ?>
    <p class="sel_chat" onclick="flags()"><i class="fa fa-flag" style="color: #035049;
    font-size: 15px;"></i> &nbsp; <a>Flag this post</a></p>
    <p id="flags" style="color:red;font-size:15px"></p>
    <?php

    } else {
    if ($_SESSION['guet_yes'] != 'yes') {
    ?>
    <p><a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" class="text-left flag" style="color: #000;"><i class="fa fa-flag"></i> Flag Event</a></p>
    <?php }
    } 
?>
<br/>
<?php if ($_SESSION['guet_yes'] != 'yes') {
?>
    <?php if($eventtype == 1){ ?>
        <!-- No Tickets Available -->
        <?php if($registration_req == 1) { ?>
                <!-- <button type="submit" class="btn butn_cancel buyn" style="border-radius: 25px;" value="Buy Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Now1</button> -->
                <a class="lft-p" href="<?php $BaseUrl ?>/events/free_eventregister.php?postid=<?php echo $postId; ?>">Free Entry Registration Needed</a>
        <?php }else{ ?>
                <span class="lft-p">Free Entry - Registeration not required</span>
        <?php
            }
    }else{ ?>
        <?php if(!empty($EventTicketUrl)){ ?> <b style="color: #c11f50 !important; font-size: 15px;margin-left: 14px;">Buy your ticket : </b> <a class="" href="<?php echo $EventTicketUrl; ?>" target="_blank"><?php echo $EventTicketUrl; ?></a> <?php } ?>
    <?php 
    }
}
?>
<br/><br/>
<?php
    $title = "whatsapp";
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<?php if (isset($_GET['groupid'])) { ?>
         <form action="<?php echo $BaseUrl . "/membership/event_payment.php?postid=" . $postId . "&groupid=" . $_GET['groupid']; ?>" id="form1" method="post" class="form-inline text-right">
<?php } else { ?>
        <form action="<?php echo $BaseUrl . "/membership/event_payment.php?postid=" . $postId; ?>" method="post" id="form1" class="form-inline text-right buyform">
<?php } ?>
        <div class="table-responsive bg_white">

            <?php 
            if($eventtype == 1){
                    echo  "";
            }else{
                    if($EventTicketUrl ==''){
            ?>
            <table id="" class="table table-striped eventTable">
                <thead>
                    <tr>
                    <th>Ticket Type</th>
                    <!-- <th>Available Qty.</th> -->
                    <th>Price</th>
                    <th>Buy Qty.</th>
                    </tr>
                </thead>
                <tbody style="text-align: left;">
                    <?php
                    $prictype1 = new _spevent_type_price;
                    $resultdata1 = $prictype1->read1($postId);
                    //print_r($resultdata1);die('11111111'); 
                    $prictype = new _spevent_type_price;
                    $resultdata = $prictype->read_price($postId);
                    $sum = 0;
                    //print_r($resultdata);die('========='); 
                    if ($resultdata != false) {
                        $i=0;
                        while ($pricedata = mysqli_fetch_assoc($resultdata)) {
                            //print_r($pricedata);
                            $event_type = $pricedata['event_type'];
                            ?>
                            <tr>
                                <td>
                                <?php
                                    $tkttype = new _spevent;
                                    $resulta = $tkttype->read($postId);
                                    //echo $this->ta->sql; die("----");
                                    //print_r($resulta); die("--");
                                    if ($resulta != false) {
                                        while ($tkt = mysqli_fetch_assoc($resulta)) {
                                        //print_r($tkt);die("----");
                                        }
                                    }
                                    if ($tkt['event_payment_type'] == 1) {
                                        echo "Free";
                                    } else {
                                        echo $event_type;
                                    }
                                    $sum = $sum + $pricedata['event_limit'];
                                    ?>
                                    <input type="hidden" class="form-control abcd " style="" min="" id="newValue_1<?php echo $i; ?>" name="spOrderQty_1[]" value="<?php echo $pricedata['typeid']; ?>">
                                </td>
                            <!-- <td><?php echo $pricedata['event_limit']; ?></td> -->
                                <td><?php echo $currency . ' ' . round($pricedata['event_price'], 2); ?></td>
                                <td> <input type="number" class="form-control getqty" style="width: 60px;margin-right: 5px" min="" id="newValue<?php echo $pricedata['typeid']; ?>" name="spOrderQty[<?php echo $pricedata['typeid']; ?>]" value="0" onkeyup="checkqtynew(this.value,<?php echo $pricedata['event_limit']; ?>,<?php echo $pricedata['typeid']; ?>);"></td>
                            </tr>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                    <tr class="bth-tabl">
                        <td></td>
                        <td></td>
                        <td class="full-wdth">
                            <button type="submit" class="sbmt-btn">Buy Ticket</button>
                        </td>
                    </tr>


              </tbody>
            </table>
            <?php
            }?> 
          <?php  }
            ?>
        </div>
</form>
<div id="social-share" class="mt_d">
<strong><span>Sharing is caring</span></strong> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
<a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb"><i class='fa fa-facebook '></i></a>
<!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
<a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa fa-twitter"></i> </a>
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa fa-linkedin"></i> </a>
<a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i class="fa fa-whatsapp"></i></a>
</div>
<!-- Modal -->
<div id="flagPost" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addtoflag.php" class="sharestorepos" id="addflagdata">
<div class="modal-content bradius-15">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $postId; ?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID'] ?>">
<div class="modal-header bg-white br_radius_top">
<h4 class="modal-title">Flag Post</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>

<div class="modal-body ">
<div class="radio">
<label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>


</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
</div>
<div class="radio">
<label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
</div>

<!-- <label>Why flag this post?</label> -->
<textarea class="form-control" name="flag_desc" placeholder="Add Comments" id="flag_desc" onkeyup="keyupflagfun()" maxlength="500"></textarea>

<span id="flagdesc_error" style="color:red; font-size: 12px;"></span>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button>
<input type="submit" name="" style="border-radius: 30px; background-color:#25c2ff" class="btn butn_mdl_submit submitevent">

</div>
</div>
</form>
</div>
</div>


</div>
<script>


</script>


<script>
$(document).ready(function() {
$(".chzn-select").multiselect();
$("#go1").click(function() {
$("#button2 ").html('Going');
});

$("#inter1").click(function() {
$("#button2  ").html('Interested');
});

$("#may1").click(function() {
$("#button2 ").html('MayBe');
});

});
</script>




<script type="text/javascript">
function flags() {
document.getElementById('flags').innerText = 'You have already flagged this post.';
}
</script>
<div class="col-md-4 img-dtls">
<div class="innr-imgdtls">
    <?php
    $pic = new _eventpic;
    $res2 = $pic->readFeature($postId);

    if ($res2 != false) {
    if ($res2->num_rows > 0) {
    if ($res2 != false) {

    $rp = mysqli_fetch_assoc($res2);
    $pic2 = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive center-block small-image' src='" . $pic2 . "' >";
    } else {
    echo "<img alt='Posting Pic' src='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='img-responsive center-block small-image'>";
    }
    }
    } else {
    $res2 = $pic->read($postId);
    if ($res2 != false) {
    $rp = mysqli_fetch_assoc($res2);
    $pic2 = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive center-block small-image' src='" . $pic2 . "' >";
    } else {
       echo "<img alt='Posting Pic' src='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='img-responsive center-block small-image'>";
    }
    }
    ?>
    <!-- // popup modal -->

    <div id="show_image_popup">
        <div class="close-btn-area">
            <button id="close-btn">X</button> 
        </div>
        <div id="image-show-area">
            <img id="large-image" src="" alt="">
        </div>
    </div>
</div>
<div>
</div>
<div class="col-md-4"> 
    <div id="map"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<section class="eventGallery">
<div class="container">
<div class="row">
<div class="col-sm-12">
<?php 
//Show success message on submit organisation contact form
if( $_GET['status'] == 'success'){
    echo 
    '<div class="row" id="success_message">
        <div class="col-md-6 text-center">
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong>Success!</strong> We have received your enquiry, organizer will contact you shortly!
            </div>                            
        </div>
        <div class="col-md-6"></div>
    </div>';
}
?>
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
$res2 = $pic->readGallery($postId);


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
$res2 = $pic->readlayout($postId);


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
$result = $media->read($postId);
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
if ($postId > 0) {

$result6 = $splinkp->read($postId);
//var_dump($result6);
if ($result6 != false) {

//var_dump($result6);
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
    <div class="frst-bx">
        <div class="inr-frmbx">
            <div class="icon-bx">
            <i class="fa fa-user" aria-hidden="true"></i><br>
                <label> Organizer Name</label><br> <p><?php echo $Organizername; ?> </p>
            </div>
            <div class="icon-bx">
                <i class="fa fa-envelope"></i><br>
                 <label> Organizer Email</label><br> <p><?php echo $Organizeremail; ?></p>
            </div>
            <div class="icon-bx">
                <i class="fa fa-phone"></i><br>
                    <label> Organizer Phone</label><br> <p><?php echo $Organizerphone; ?> </p>
            </div>
        </div>
    <div class="inr-frmbx">
        <form action="../../post-ad/dopostevent.php" method="post">
            <input type="hidden" value="<?php echo $Organizername; ?>" name="organizername">
            <input type="hidden" value="<?php echo $Organizeremail; ?>" name="organizeremail">
            <input type="hidden" value="<?php echo $Organizerphone; ?>" name="organizerphone">
            <input type="hidden" value="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$idd?>" name="eventurl">

            <div class="form-group tw-bx">
                <input type="hidden" value="<?php echo $idd?> " name="id">
                <label> Name </label>
                <input type="text" value="" name="name" required>

            </div>
            <div class="form-group tw-bxs">
                <div class="innr-frm">
                    <label>  Email </label>
                    <input type="email" value="" name="email" required>
                </div>
                <div class="innr-frm">
                    <label>  Phone </label>
                    <input type="text" value="" name="phone" required>
                </div>
            </div>                    
            <div class="form-group tw-bx">
                <label>  Message </label>
                <textarea style="width:100%;" class="form-control frndmsg" rows="4" id="sndmsg" required name="message" placeholder="Type your message here..." required></textarea>
            </div>
            <input type="submit" value="Contact Organiser" name="submit" class="btn butn_save savesubmitbtn btn-border-radius " style="background-color:#c11f50!important"> 
        </form>
    </div>
</div>
    <div class="space"></div>
    <div class="org_contact">
        
    </div>
</div>
<div id="menu6" class="tab-pane fade">

<div style="margin-top: 10px;margin-left: 25px;">

<p><b>EVENT CATEOGRY : </b><?php echo $eventcategory; ?></p>
<p><b>Ethnicity : </b><?php echo $Ethnicity; ?></p>
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
// if (flagdesc == "") {
// $('#flagdesc_error').text("This Field is Required.");
// $("#flag_desc").focus();
// return false;

// } else {
// $("#addflagdata").submit();
// //alert("Form Submitted Successfuly!");
// return true;
// }

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

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js
"></script>
<script>
$('#langOpt').multiselect();
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
</script>
<script>
    function initMap() {
        const  latitude = $('#latitude').val();
        const  longitude = $('#longitude').val();
        const lats = parseFloat(latitude);
        const longs = parseFloat(longitude)
        // Create a new map centered at the dynamic latitude and longitude
        const map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: lats, lng: longs },
            zoom: 14 // You can adjust the initial zoom level
        });
        // Create a marker at the specified location
        const marker = new google.maps.Marker({
            position: { lat: dynamicLat, lng: dynamicLng },
            map: map,
            title: 'Dynamic Location'
        });
    }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initMap">
</script>
<script>
$( document ).ready(function(){
    $("#close-btn").click(function(){
        // remove active class from all images
        $(".small-image").removeClass('active');
        $("#show_image_popup").slideUp();
    })
    $(".small-image").click(function(){
        // remove active class from all images
        $(".small-image").removeClass('active');
        // add active class
        $(this).addClass('active');

        var image_path = $(this).attr('src'); 
        $("#show_image_popup").fadeOut();
        // now st this path to our popup image src
        $("#show_image_popup").fadeIn();
        $("#large-image").attr('src',image_path);
    })
})
</script>
</body>

</html>
<?php
}
?>
