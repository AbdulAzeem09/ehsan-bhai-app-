<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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

$result = $p->singletimelines($_GET['postid']);
if ($result != false) {

$row = mysqli_fetch_assoc($result);
//echo '<pre>';
//print_r($row);
$currency = $row['default_currency']; 
$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];
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
margin-top: 30px;
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
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Start</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-1.png" class="img-responsive">
<p><?php echo $startDate; ?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Ends</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-1.png" class="img-responsive">
<p><?php echo $expDate ?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Time Start</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-2.png" class="img-responsive">
<p><?php echo date("h:i A", $dtstrtTime); ?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Time End</h3>
<img src="<?php echo $BaseUrl; ?>/assets/images/events/icon-2.png" class="img-responsive">
<p><?php echo date("h:i A", $dtendTime); ?></p>
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
$res_ev = $ev->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);


if ($res_ev != false) {


?>

<a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $_GET['postid']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
<span style="font-size:33px;".
style="font-size:33px;" id="removetofavouriteeve" class="iconhover"><i class="fa fa-heart"></i></span>

</a>

<?php
} else {
?>
<a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $_GET['postid']; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
<span id="addtofavouriteeve" style="font-size:33px;" class="iconhover"><i class="fa fa-heart-o"></i></span>

</a>
<?php
}
?>


</li>
<li>

<?php

$r = new _speventreview_rating;

$sumres = $r->readeventrating($_GET["postid"]);



?>

<div class="row reviewdetail">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'] ?>" />
<input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"] ?>">
</div>
</li>
<li>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($_GET['postid'], $_SESSION['pid']);
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
$resulti1 = $ie->chekGoing($_GET['postid'], 2);
if ($resulti1 != false && $resulti1->num_rows > 0) {
$going = $resulti1->num_rows;
} else {
$going =  0;
}

$resulti2 = $ie->chekGoing($_GET['postid'], 1);
if ($resulti2 != false && $resulti2->num_rows > 0) {
$interested = $resulti2->num_rows;
} else {
$interested =  0;
}


$resulti3 = $ie->chekGoing($_GET['postid'], 0);
if ($resulti3 != false && $resulti3->num_rows > 0) {
$MayBe = $resulti3->num_rows;
} else {
$MayBe =  0;
}

//print_r($_SESSION);

$pic = new _eventpic;

if(isset($_POST['save'])){

$username = $_POST['name'];
$useremail = $_POST['email'];
$userphone = $_POST['phone'];
$usercountry = $_POST['country'];
$userstate = $_POST['state'];
$usercity = $_POST['city'];
$usercompany = $_POST['cname'];
$postid = $_POST['postid_event'];
//  $pid = $_SESSION['pid'];
//  $uid = $_SESSION['uid'];


$userid = $pic->eventid($postid);
if($userid){
$resdata = mysqli_fetch_assoc($userid);
}
//print_r($resdata);
$seleid = $resdata['spProfiles_idspProfiles'];
$spemail = $_SESSION['spUserEmail'];
$date = date('Y-m-d h:i:s a', time());
//echo $date.'++';

//    $pid = $_SESSION['pid'];
//    $uid = $_SESSION['uid'];



//$startdate = $resdata['spPostingStartDate'];
//$pid = $resdata['spPostingStartDate'];


//select * from spevent where idspposting = idspPostings


$data=array("Username" => $username , 
"Useremail" =>$useremail,
"Userphone" =>$userphone, 
"Usercompany" =>$usercompany,
"postid" =>$postid,
"Usercountry" => $usercountry,
"Userstate" =>$userstate,
"Usercity" => $usercity,
"buyer_pid" => $_SESSION['pid'],
"buyer_uid" => $_SESSION['uid'],
"sellid" =>$seleid,
"payer_email" =>$spemail,
"txn_id" =>"free",
"currency" =>"free",
"payment_date" =>$date);

$_SESSION['sent_reg'] = 'yes' ;

$eventuser = $pic->create1($data);

}

?>


<span id="">
<i class="fa fa-calendar"></i>
</span>
<div class="ie_<?php echo $_GET['postid']; ?>">

<div class="dropdown intrestEvent " id="eventDetaildrop" style="display: block;">
<button class="new_class" id="button2" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;    padding: 3px 15px;"><?php echo $title; ?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intrestArea" id="go1" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $_GET['postid']; ?>" data-area="2"><?php echo $area2; ?> Going (<?php echo $going; ?>) </a></li>
<li><a href="javascript:void(0)" class="intrestArea" id="inter1" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $_GET['postid']; ?>" data-area="1"><?php echo $area1; ?> Interested (<?php echo $interested; ?>)</a></li>
<li><a href="javascript:void(0)" class="intrestArea" id="may1" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $_GET['postid']; ?>" data-area="0"><?php echo $area0; ?> May Be (<?php echo $MayBe; ?>)</a></li>
</ul>
</div>
</div>
</li>

<li>
<?php
$pic = new _eventpic;
$res2 = $pic->read($_GET['postid']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
} else {
}

?>
<a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'>

<span class='sp-share-art iconhover' data-postid='<?php echo $_GET['postid']; ?>' src='<?php echo ($pic2); ?>'>
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
<?php if(isset($_SESSION['sent_reg']) && $_SESSION['sent_reg'] == 'yes'){ 
unset($_SESSION['sent_reg']);
?>
<div class="alert alert-primary" role="alert">
Successfully sent Entry
</div>
<?php } ?>
<div class="titleEvent">
<div class="row">
<div class="col-md-5">
<div class="hostedbyevent">
<!-- <h1 class="titDetail text-uppercase"><?php echo $ProTitle; ?></h1> -->
<!-- <label style="margin-left: 15px;">Organizer :</label>

<a class="cohost" href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>"><?php echo $pic->getOrganizerName($Organizername); ?></a> -->


</div>
</div>

</div>

<div class="row">

<div class="col-md-4">


<?php if (isset($_GET['groupid'])) { ?>
<form action="<?php echo $BaseUrl . "/membership/event_payment.php?postid=" . $_GET['postid'] . "&groupid=" . $_GET['groupid']; ?>" id="form1" method="post" class="form-inline text-right">
<?php } else { ?>
<?php } ?>


<form action="" method="post" id="formragister" class="" enctype="multipart/form-data">

<label for="">Your Full Name<span style="color:red">*</span></label>
<br>
<input type="text" name="name" id="name" class="form-control" required/><br>
<label for="">Phone <span style="color:red">*</span></label>
<br>
<input type="number" name="phone" id="phone" class="form-control" required/><br>

<label for="">Country <span style="color:red">*</span></label>
<br>
<input type="text" name="country" id="country" class="form-control" required/><br>

<label for="">State <span style="color:red">*</span></label>
<br>
<input type="text" name="state" id="state" class="form-control" required/><br>



<div class="eds-checkbox">
<input id="checkout-tos-checkbox" type="checkbox" class="eds-checkbox__input" name="tosCheckbox" data-spec="checkout-form-tos-checkbox" data-automation="checkbox-checkout-tos-checkbox" aria-invalid="false" aria-labelledby="checkout-tos-checkbox-checkbox-label-name" value="">
<label class="eds-checkbox__label eds-checkbox__delegate eds-text--center" for="checkout-tos-checkbox" data-spec="checkbox-delegate">
<span class="eds-label__content">
<div class="eds-checkbox__background"></div>
<div class="eds-checkbox__checkmark">
<i class="eds-vector-image eds-icon--small eds-vector-image--stroke-white" data-spec="icon" data-testid="icon" aria-hidden="true">
<svg id="check-chunky_svg__eds-icon--check-chunky_svg" x="0" y="0" viewBox="0 0 24 24" xml:space="preserve">
<path id="check-chunky_svg__eds-icon--check_base" d="M5.5 12.2L9.4 16l9.1-9" fill="none" stroke="#050505" stroke-width="2" stroke-miterlimit="10"></path>
</svg>
</i>
</div>
<div class="eds-checkbox__foreground">
</div>
</span>
</label>
<label class="eds-checkbox__label" id="checkout-tos-checkbox-checkbox-label-name" data-automation="checkout-tos-checkbox-label" for="checkout-tos-checkbox" data-spec="checkbox-display-label">
<span class="eds-label__content">
<span class="checkout-form-tos-clickwrap-disclaimer" data-spec="checkout-form-tos-disclaimer" id="checkout-tos-checkbox-text">I accept the <a href="https://dev.thesharepage.com/page/?page=terms_and_condition" class="eds-link" target="_blank" rel="noopener noreferrer">The SharePage Terms of Service</a>.</span>
</span>
</label>
</div>

<input type="hidden" name="postid_event" value="<?php echo $_GET['postid']; ?>" class="form-control">
<button type="submit" name="save" id="" class="btn btn-info form-control" >submit</button>


</div>
<div class="col-md-4">
<label for="">Email<span style="color:red">*</span></label>
<br>
<input type="email" name="email" id="email" class="form-control" required/><br>
<!--<label for="">Company Name <span style="color:red">*</span></label>-->
<label for="">Company Name</label>
<br>
<input type="text" name="cname" id="cname" class="form-control" /><br>


<label for="">City <span style="color:red">*</span></label>
<br>
<input type="text" name="city" id="city" class="form-control" required/><br>




</form>




<!-- <h2 class="eventcapitalize"><span>Event Details</span></h2> -->

<?php
if ($visibil == 1) {
?>
<!--Privew Button Code button-->
<div class="col-md-4">
<div class="<?php echo ($visibil == 1 ? "" : "hidden"); ?>">
<div class="text-center" style="margin-bottom:10px;">
<button type="button" id="submitpost" class="btn butn_save" data-visibility="-1" data-postid="<?php echo $_GET["postid"]; ?>">Submit</button>
<button type="button" id="saveindraft" class="btn butn_draf">Save Draft</button>

</div>
</div>
</div>


<!--Completed-->
<?php
}
?>


<!-- <p class="text-justify eventcapitalize" style=" font-weight: bold; text-align: justify; line-height: 1.5;"></?php echo $ProDes; ?></p> -->

<div class="space"></div>
<?php
// $postid = $_GET['postid'];
// $pids = $_SESSION['pid'];
// $sp = new _flagpost;
// $spflag = $sp->readflag2($pids, $postid);
if ($spflag != false) {
?>
<p class="sel_chat" onclick="flags()"><i class="fa fa-flag" style="color: #035049;
font-size: 15px;"></i> &nbsp; <a>Flag this post</a></p>
<p id="flags" style="color:red;font-size:15px"></p>
<?php

} else {
if ($_SESSION['guet_yes'] != 'yes') {
?>
<p></p>
<?php }
} ?>


<?php
$title = "whatsapp";

$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>





<!-- Modal -->
<div id="flagPost" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addtoflag.php" class="sharestorepos" id="addflagdata">
<div class="modal-content bradius-15">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid']; ?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID'] ?>">
<div class="modal-header bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Flag Post</h4>
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
<input type="submit" name="" style="border-radius: 30px; background-color:#25c2ff" class="btn butn_mdl_submit submitevent">
<button type="button" class="btn butn_cancel homecancelbtn" data-dismiss="modal">Cancel</button>
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
document.getElementById('flags').innerText = 'you have already flagged this post from another profile';
}
</script>
<div class="col-md-4">
<?php
$pic = new _eventpic;
$res2 = $pic->readFeature($_GET['postid']);

if ($res2 != false) {
if ($res2->num_rows > 0) {
if ($res2 != false) {

$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive center-block' src='" . $pic2 . "' ><br><br>";
} else {
echo "<img alt='Posting Pic' src='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='img-responsive center-block'><br><br>";
}
}
} else {
$res2 = $pic->read($_GET['postid']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive center-block' src='" . $pic2 . "' ><br><br>";
} else {
echo "<img alt='Posting Pic44' src='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='img-responsive center-block'><br><br>";
}
}
?>


<div id="social-share" class="mt_d">
<strong><span>Sharing is caring</span></strong> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
<a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb"><i class='fa fa-facebook '></i></a>
<!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
<a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa fa-twitter"></i> </a>
<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa fa-linkedin"></i> </a>
<a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i class="fa fa-whatsapp"></i></a>
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

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js
"></script>
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
</script>
<!-- image gallery script end -->
</body>

</html>
<?php
}
?>