<?php 
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="events/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "16";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "GroupEvents";
$header_event = "events";

if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

}else{
$re = new _redirect;
$re->redirect($BaseUrl."/events");
}

if (isset($_GET['postid']) && $_GET['postid'] >0) {
$p = new _spgroup_event;
// $pf  = new _postfield;

$result = $p->singletimelines($_GET['postid']);
//echo $p->ta->sql;
if($result != false){
$row = mysqli_fetch_assoc($result);




$spgroupid   = $row['spgroupid'];
$spgroupname     = $row['spgroupname'];

$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];

$ProTitle   = $row['spPostingTitle'];
$ProDes     = $row['spPostingNotes'];
$specification     = $row['specification'];

$ArtistName = $row['spProfileName'];
$ArtistId   = $row['spProfiles_idspProfiles'];
$ArtistAbout= $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city      = $row['spPostingsCity'];
$expDate    = $row['spPostingExpDt'];

$pr = new _spprofilehasprofile;
$result3 = $pr->frndLeevel($_SESSION['pid'], $row['spProfiles_idspProfiles']);
if($result3 == 0){
$level = '1st Connection';
}else if($result3 == 1){
$level = '1st Connection';
}else if($result3 == 2){
$level = '2nd Connection';
}else if($result3 == 3){
$level = '3rd Connection';
}else{
$level = 'Not Define';
}

$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$endDate = $row['spPostingEndDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$OrganizerId = $row['spPostingEventOrgId'];
//  $Organizername = $row['spPostingEventOrgName'];
$Quantity = $row['ticketcapacity'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);

/*
$today_date = date('Y/m/d');

$expire = strtotime($expDate);

$today = strtotime($today_date);


if($today >= $expire){
echo "expired";
} else {
echo "active";
}*/

$pro = new _spprofiles;
$result7 = $pro->read($OrganizerId);
if($result7 != false){
$row7 = mysqli_fetch_assoc($result7);

$Organizername = $row7['spProfileName'] ; ?>
<?php
}

//$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
/* if($result_pf){
$venu = "";
$startDate = "";
$endDate = "";
$startTime    = "";
$endTime = "";
$OrganizerId = "";
$Quantity = '';
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($venu == ''){
if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
$venu = $row2['spPostFieldValue'];

}
}
if($startDate == ''){
if($row2['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row2['spPostFieldValue'];

}
}
if($endDate == ''){
if($row2['spPostFieldName'] == 'spPostingEndDate_'){
$endDate = $row2['spPostFieldValue'];

}
}
if($startTime == ''){
if($row2['spPostFieldName'] == 'spPostingStartTime_'){
$startTime = $row2['spPostFieldValue'];

}
}
if($endTime == ''){
if($row2['spPostFieldName'] == 'spPostingEndTime_'){
$endTime = $row2['spPostFieldValue']; 

}
}
if($OrganizerId == ''){
if($row2['spPostFieldName'] == 'spPostingEventOrgId_'){
$OrganizerId = $row2['spPostFieldValue'];

}
}
if($Quantity == ''){
if($row2['spPostFieldName'] == 'ticketcapacity_'){
$Quantity = $row2['spPostFieldValue'];

}
}
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}
*/



}



}else{
$re = new _redirect;
$redirctUrl = "../events";
$re->redirect($redirctUrl);
}

if(isset($_GET['visibility']) && $_GET['visibility'] == -1){
$visibil = 1;
}else{
$visibil = 0;
}



?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
<!-- Magnific Popup core JS file -->
<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<!-- this script for slider art -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<script>
function checkqty(txb) {                
var qty = parseInt(txb);
var actualQty = $("#spOrderQty").val();
//alert(actualQty);return false;
//console.log(actualQty);
if(qty > actualQty){
document.getElementById("newValue").value = actualQty;
}
if(qty < 1){
document.getElementById("newValue").value = 1;
//alert("less");
}

$('#payqty').val($('#newValue').val());
}
</script>

<style type="text/css">


.rating-box {
position:relative!important;
vertical-align: middle!important;
font-size: 18px;
font-family: FontAwesome;
display:inline-block!important;
color: lighten(@grayLight, 25%);
/*padding-bottom: 10px;*/
}

.rating-box:before{
content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
position: absolute!important;
left:0;
top:0;
white-space:nowrap!important;
overflow:hidden!important;
color: Gold!important;

}
.ratings:before {
content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

.flag:hover{
color:#428bca!important;
}
</style>



</head>

<body class="bg_gray">
<?php include_once("../header.php");?>
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
<!-- <div class="col-md-12 no-padding orgifo">
<label>Organizer Name (
<?php
$pro = new _spprofiles;
$result7 = $pro->read($OrganizerId);
if($result7 != false){
$row7 = mysqli_fetch_assoc($result7);
?>
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>"><?php echo $row7['spProfileName'];?></a>
<?php
}
?>
)</label>
</div> -->
</div>
<form method="post" action="../friendmessage/sendSms.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
<input type="hidden" name="spProfiles_idspProfilesSender" id="spProfiles_idspProfilesSender" value="<?php echo $_SESSION['pid'];?>">
<input type="hidden" name="spprofiles_idspProfilesReciver" id="spprofiles_idspProfilesReciver" value="<?php echo $OrganizerId;?>">

<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="sp-post-edit">
<div class="form-group">
<label>Message</label>
<textarea class="form-control" name="spfriendChattingMessage"></textarea>
</div>
</div>
<button type="submit" class="btn pull-right btnSendSms btn-border-radius" <?php echo ($_SESSION['pid'] == $OrganizerId)?'disabled':'';?> id="sendEventSms">Send Message</button>
<button type="button" class="btn pull-right btn-border-radius"  data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
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


if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
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
<div class="col-md-12 text-center">
<p class="titDetail"><?php echo $ProTitle;?></p>
<p class="location eventcapitalize"><i class="fa fa-map-marker"></i> <?php echo $venu;?></p>
</div>
</div>
<div class="row">
<div class="col-md-offset-1 col-md-10">
<div class="transTop">
<div class="row">
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Start</h3>
<img src="<?php echo $BaseUrl;?>/assets/images/events/icon-1.png" class="img-responsive">
<p><?php echo $startDate;?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Ends</h3>
<img src="<?php echo $BaseUrl;?>/assets/images/events/icon-1.png" class="img-responsive">
<p><?php echo $expDate?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Time Start</h3>
<img src="<?php echo $BaseUrl;?>/assets/images/events/icon-2.png" class="img-responsive">
<p><?php echo date("h:i A", $dtstrtTime); ?></p>
</div>
</div>
<div class="col-md-3">
<div class="detailTopcol text-center">
<h3>Time End</h3>
<img src="<?php echo $BaseUrl;?>/assets/images/events/icon-2.png" class="img-responsive">
<p><?php echo date("h:i A", $dtendTime); ?></p>
</div>
</div>
</div>
</div>
<!--  <div class="transTopBtmFoot">
<?php
$today = date('Y-m-d');
$date1 = new DateTime($today);
$date2 = new DateTime($startDate);
$interval = $date2->diff($date1);
?>
<ul>
<li>&nbsp;</li>
<li><?php echo $interval->format('%m Months');?></li>
<li><?php echo $interval->format('%d Days');?></li>
<li>&nbsp;</li>
</ul>
</div> -->

</div>
</div>
</div>
</section>
<section class="main_box">            
<div class="container">
<div class="row">
<!--   <div class="col-md-offset-1 col-md-10">
<div class="twolevelEvent">
<ul class="social">
<li>
<a href="<?php echo $BaseUrl;?>/grouptimelines/group-event.php?groupid=<?php echo $spgroupid; ?>&groupname=<?php echo $spgroupname ; ?>&event">
<span class="iconhover"><i class="fa fa-home"></i></span>
Home
</a>    

</li>
<li class="bokmarktab">
<?php
//rating

$ev = new _event_favorites;
$res_ev = $ev->chekFavourite($_GET["postid"], $_SESSION['pid'], $_SESSION['uid']);
//$res_ev = $ev->read($_GET["postid"]);

// echo $ev->ta->sql; 




if($res_ev != false){ 


?>

<a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">

<span id="removetofavouriteeve" class="iconhover"><i class="fa fa-heart"></i></span>
Bookmarked
</a>

<?php



}else{
?>
<a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $_GET['postid'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
<span id="addtofavouriteeve" class="iconhover"><i class="fa fa-heart-o"></i></span>
Bookmark
</a>
<?php
}
?>


</li>
<li>

<?php

$r = new _speventreview_rating;

$sumres = $r->readeventrating($_GET["postid"]);

//echo $r->ta->sql;  


if($sumres!=false){
while ($sumrow = mysqli_fetch_assoc($sumres)) {

//echo "<pre>";
// print_r($sumrow);



$sumrating += $sumrow['rating'];

$ratarr[] =  $sumrow['rating'];

//echo count($ratarr);



$countrate = count($ratarr);

$averagerate = $sumrating / $countrate;

$totalrate  = round($averagerate, 1);

}

}
/*  print_r($totalrate);
print_r($averagerate);*/

?>

<div class="row reviewdetail">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>
<input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">


<div class="rating-box">
<?php if($totalrate >= "5") { 
echo '<div class="ratings" style="width:100%;"></div>';
}else  if($totalrate >= "4" && $totalrate < "5") { 
echo '<div class="ratings" style="width:92%;"></div>';
}
else  if($totalrate >= "4") { 
echo '<div class="ratings" style="width:80%;"></div>';
}else  if($totalrate > "3" && $totalrate < "4") { 
echo '<div class="ratings" style="width:72%;"></div>';
}else  if($totalrate >= "3") { 
echo '<div class="ratings" style="width:60%;"></div>';
}else  if($totalrate > "2" && $totalrate < "3") { 
echo '<div class="ratings" style="width:51%;"></div>';
}else  if($totalrate >= "2") { 
echo '<div class="ratings" style="width:38%;"></div>';
}else  if($totalrate > "1" && $totalrate < "2") { 
echo '<div class="ratings" style="width:29%;"></div>';
}else  if($totalrate >= "1") { 
echo '<div class="ratings" style="width:16%;"></div>';
}else  if($totalrate <= "0") { 
echo '<div class="ratings" style="width:0%;"></div>';
}

?>

</div>
<p class="col-md-12 rating">





<a  href="<?php echo $BaseUrl.'/events/showeventrating.php?postid='.$_GET['postid']; ?>">Rating : <?php if($totalrate <= 0 ){ echo "0.0"; }else{ echo $totalrate; } ?></a>
</p>
</div>
</li> 
<li>
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($_GET['postid'], $_SESSION['pid']);
if($result != false){
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];

if($area == 2){
$area2 = "<i class='fa fa-check'></i>";
$title = "Going";
}else if($area == 1){
$area1 = "<i class='fa fa-check'></i>";
$title = "Interested";
}else if($area == 0){
$area0 = "<i class='fa fa-check'></i>";
$title = "May Be";
}
}else{
$title = "Event";
}

$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($_GET['postid'], 2);
// echo $ie->ta->sql;
if($resulti1 != false && $resulti1->num_rows >0){
$going = $resulti1->num_rows;
}else{
$going =  0;
}

$resulti2 = $ie->chekGoing($_GET['postid'], 1);
// echo $ie->ta->sql;
if($resulti2 != false && $resulti2->num_rows >0){
$interested = $resulti2->num_rows;
}else{
$interested =  0;
}


$resulti3 = $ie->chekGoing($_GET['postid'], 0);
// echo $ie->ta->sql;
if($resulti3 != false && $resulti3->num_rows >0){
$MayBe = $resulti3->num_rows;
}else{
$MayBe =  0;
}
?>

<span id="">
<i class="fa fa-calendar"></i>
</span>
<div class="ie_<?php echo $_GET['postid'];?>">

<div class="dropdown intrestEvent " id="eventDetaildrop" style="display: block;">
<button class="btn btn_group_join dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;"><?php echo $title;?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="2"><?php echo $area2;?> Going (<?php echo $going; ?>) </a></li>
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="1"><?php echo $area1;?> Interested (<?php echo $interested; ?>)</a></li>
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="0"><?php echo $area0;?> May Be (<?php echo $MayBe; ?>)</a></li>
</ul>
</div>
</div>
</li>

<li>
<?php
$pic = new _groupeventpic;
$res2 = $pic->read($_GET['postid']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
//echo "<img alt='Posting Pic' class='img-responsive img-big' src=' " . ($pic2) . "' >";
} else{
//echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive img-big'>";
}

?>
<a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare'>

<span class='sp-share-art iconhover' data-postid='<?php echo $_GET['postid'];?>' src='<?php echo ($pic2); ?>'>
<i class="fa fa-share-alt"></i>
</span>
Share
</a>
</li>
</ul>
</div>
</div> -->
</div>
<div class="bg_white detailEvent m_top_10" style="border-radius: 25px;">
<div class="row">
<div class="col-md-12">
<div class="titleEvent">
<div class="row">
<div class="col-md-5">
<div class="hostedbyevent">
<!-- <a href="javascrpit:void(0)" data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms btn butn_save">Contact Organizer</a>                                    -->
<label style="margin-left: 15px;">Organizers:</label>

<a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $Organizername;?></a>,


</div>
</div>

<?php 

$today_date = date('Y/m/d');

$expire = strtotime($expDate);

$today = strtotime($today_date);


/* if($today >= $expire){
echo "expired";
} else {
echo "active";
}*/
?>
<div class="col-md-7">


<?php
// ===PAYPAL ACCOUNT LIVE SETTING
// RETURN CANCEL LINK
$cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK
$success_return = $BaseUrl."/paymentstatus/groupevent_payment_success.php?postid=".$_GET['postid']."&sellid=".$ArtistId."&groupid=".$spgroupid;

// print_r($success_return);
// ===END
// ===LOCAL ACCOUNT SETTING
// RETURN CANCEL LINK
//$cancel_return = "http://localhost/share-page/paymentstatus/payment_cancel.php";
// RETURN SUCCESS LINK
//$success_return = "http://localhost/share-page/paymentstatus/payment_success.php";
// ===END



//Here we can use paypal url or sanbox url.
// sandbox
$paypal_url 	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
// live payment
//$paypal_url		= 'https://www.paypal.com/cgi-bin/webscr';
//Here we can used seller email id. 
$merchant_email = 'developer-facilitator@thesharepage.com';
// live email
//$merchant_email = 'sharepagerevenue@gmail.com';

//paypal call this file for ipn
//$notify_url 	= "http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php";
?>



<form action="<?php echo $paypal_url; ?>" method="post" class="form-inline text-right">
<input type="hidden" name="business" value="<?php echo $merchant_email; ?>">
<!-- <input type='hidden' name='notify_url' value='http://shoptodoor.pk/demo/paypal-ipn-php/ipn.php'> -->
<input type="hidden" name="cancel_return" value="<?php echo $cancel_return; ?>"/>
<input type="hidden" name="return" value="<?php echo $success_return; ?>">
<input type="hidden" name="rm" value="2" />
<input type="hidden" name="lc" value="" />
<input type="hidden" name="no_shipping" value="1" />
<input type="hidden" name="no_note" value="1" />
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="page_style" value="paypal" />
<input type="hidden" name="charset" value="utf-8" />
<input type="hidden" name="cbt" value="Back to FormGet" />

<!-- Redirect direct to card detail Page -->

<input type="hidden" name="landing_page" value="billing">

<!-- Redirect direct to card detail Page End -->


<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="upload" value="1">



<?php



echo "<input type='hidden' name='item_name_1' value='".$ProTitle."'>";
echo "<input type='hidden' name='item_number' value='143' >";
echo "<input type='hidden' class='".$row['idspPostings']."' name='amount_1' value='".$price."'>";

echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
?>

<?php if($today >= $expire){?>
<button class="btn butn_cancel pull-right btn-border-radius" >Event Closed</button>

<?php }else{ ?>
<button type="submit" class="btn butn_cancel pull-right btn-border-radius" id="Buynow" ><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket</button>

<?php  } ?>



<div class="form-group price">
<span style="font-size: 20px;">Ticket Price: <span class="red_clr"><strong>$<?php echo $price;?></strong></span></span>
</div>
<!-- <div class="form-group">
<label >Available Quantity: <span class="red_clr">(<?php echo (isset($Quantity))?$Quantity:'1';?>)</span> <span class="gray_clr">></span> </label>
</div> -->
<div class="form-group price">
<span style="font-size: 20px;">Quantity</span>
<input type="hidden" id="spOrderQty" value="<?php echo (isset($Quantity))?$Quantity:'1';?>"> 
<input type="number" class="form-control no-radius" style="width: 60px;margin-right: 5px" id="newValue" name="spOrderQty" placeholder="" value="1" onkeyup="checkqty(this.value);" >
</div>

<!--     </form> -->

</form>




</div>
</div>
<hr class="hrline">
<div class="row">
<div class="col-md-8">
<h2 class="eventcapitalize"><?php echo $ProTitle;?></h2>
</div>
<div class="col-md-4">
<?php
if($visibil == 1){
?>
<!--Privew Button Code button-->
<div class="<?php echo ($visibil == 1?"":"hidden");?>">
<div class="text-center" style="margin-bottom:10px;">
<button type="button" id="submitpost" class="btn butn_save btn-border-radius" data-visibility="-1" data-postid="<?php echo $_GET["postid"]; ?>">Submit</button>
<button type="button" id="saveindraft" class="btn butn_draf btn-border-radius">Save Draft</button>                                                    

</div>
</div>
<!--Completed-->
<?php
}
?>
</div>
<div class="col-md-8">
<p class="text-justify eventcapitalize"><?php echo $ProDes;?></p>

<h2 style="font-size: 18px;">Available Tickets: <span><?php echo ($Quantity > 0)?$Quantity:'House Full'; ?></span></h2>
<div class="space"></div>
<p><a href="javascript:void(0)"  data-toggle="modal" data-target="#flagPost" class="text-left flag" style="color: #000;"><i class="fa fa-flag"></i> Flag Event</a></p>
<!-- Modal -->
<div id="flagPost" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="addtoflag.php" class="sharestorepos" id="addflagdata">
<div class="modal-content bradius-15">
<input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryid']?>">
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
<textarea class="form-control" name="flag_desc" placeholder="Add Comments" 
id="flag_desc"  onkeyup="keyupflagfun()" maxlength="500"></textarea>

<span id="flagdesc_error" style="color:red; font-size: 12px;"></span>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<input type="submit" name="" class="btn butn_mdl_submit submitevent btn-border-radius">
<button type="button" class="btn butn_cancel homecancelbtn btn-border-radius" data-dismiss="modal">Cancel</button>
</div>
</div>
</form>
</div>
</div>


</div>
<div class="col-md-4">
<?php
//this is posting for featured pic
$pic = new _groupeventpic;
$res2 = $pic->readFeature($_GET['postid']);
if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive center-block' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive center-block'>"; 
}
}
}else{
$res2 = $pic->read($_GET['postid']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive center-block' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive center-block'>"; 
}
}
?>

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
<div class="col-md-12">
<ul class="nav nav-tabs" id="navtabFrnd" style="border-radius: 20px;">
<li class="active" ><a data-toggle="tab" href="#home" style="border-top-left-radius: 20px;
border-bottom-left-radius: 20px;">Gallery</a></li>
<!-- <li><a data-toggle="tab" href="#menu1">Video</a></li> -->
<!--  <li><a data-toggle="tab" href="#menu2">Reviews</a></li> -->
<li><a data-toggle="tab" href="#menu3">Sponsors</a></li>
<li><a data-toggle="tab" href="#menu4">Featuring</a></li>
<li><a data-toggle="tab" href="#menu5">Contact Organizer</a></li>
<li><a data-toggle="tab" href="#menu6">Specification</a></li>
</ul>

<div class="tab-content" style="min-height: 300px;">
<div id="home" class="tab-pane fade in active">
<div class="space"></div>
<div class="row">
<?php
$pic = new _groupeventpic;
$res2 = $pic->read($_GET['postid']);

if ($res2 != false) {
while ($rp = mysqli_fetch_assoc($res2)) {
$pic2 = $rp['spPostingPic'];
?>
<div class="col-md-3">
<div class="EvntImg">
<a class="thumbnail eventpostimg" rel="lightbox[group]" href="<?php echo ($pic2);?>" title="<?php echo $ProTitle;?>">
<img class="group1 eventpostimg" src="<?php echo ($pic2);?>">
</a>

</div>
</div>
<?php
}                        
}else{
echo"<h3 class='text-center'>No record Found!</h3>";
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
if($sppostingmediaExt == 'mp4'){ ?>
<div class="col-md-offset-3 col-md-6">
<div style='margin-left:15px;margin-right:15px;'>
<video  style='max-height:300px;width: 100%' controls>
<source src='<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
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
$pf  = new _spgroup_event;
$pro = new _spprofiles;
$result6 = $pf->readFeaturPost($_GET['postid']);
//echo $pf->ta->sql."<br>";
if($result6 != false){
while ($row6 = mysqli_fetch_assoc($result6)) {
if($row6['addfeaturning'] != ''){
$profileId = $row6['addfeaturning'];
$result7 = $pro->read($profileId);
if($result7 != false){
$row7 = mysqli_fetch_assoc($result7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
<div class="col-md-3 no-padding">
<?php 
echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../assets/images/blank-img/default-profile.png")."'>";
?>
</div>
<div class="col-md-9 no-padding">
<h4 class="eventcapitalize"><?php echo $row7['spProfileName'];?></h4>
</div>
</a>
</div>
</div>
<?php
}
}else{
echo"<h3 class='text-center'>No record Found!</h3>";
}
}
}else{
echo"<h3 class='text-center'>No record Found!</h3>";
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
if($result7 != false){
$row7 = mysqli_fetch_assoc($result7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin"
style=" border-radius: 15px;">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>">
<div class="col-md-3 no-padding">
<?php 
echo "<img  alt='profile-Pic' style='border-radius: 10px;' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
?>
</div>
</a>
<div class="col-md-9 no-padding">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>">
<h4 class ="eventcapitalize"><?php echo $row7['spProfileName'];?></h4>
</a>
<span class="dropdown">
<button type="button" class="btn btnPosting db_btn db_primarybtn dropdown-toggle btn-border-radius" data-sender="" data-reciver="<?php echo $_GET["profileid"];?>" style="margin:5px;padding: 5px 7px!important;font-size: 8px!important;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" id="sendmesg"><span class="fa fa-paper-plane"></span> Send Message</button>

<div class="dropdown-menu bradius-15" id="popform" aria-labelledby="dropdownMenu1">
<form action="" method="post">
<div class="form-group" style="margin:3px;">
<textarea class="form-control frndmsg" rows="4" id="sndmsg" name="spfriendChattingMessage" placeholder="Type your message here..."></textarea>
</div>

<button type="button" class="btn btn-primary pull-right wthmsg db_btn db_primarybtn btn-border-radius" data-reciver="<?php echo $OrganizerId;?>" data-sender="<?php echo $_SESSION['pid'];?>" id="sendermesg">Send</button>
</form>
</div>
</span>
</div>

<div class="col-md-12">

<!-- <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms">Contact Organizer</span> -->
</div>
</div>
</div>
<?php
}else{
echo"<h3 class='text-center'>No record Found!</h3>";
} 
//co-Host persons.
$pf  = new _postfield;
$pro = new _spprofiles;
$ei  = new _eventJoin;
if(isset($_GET['postid']) && $_GET['postid'] > 0){
$fieldName = "spPostingCohost_";
$result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
//echo $pf->ta->sql."<br>";
if($result6 != false){
while ($row6 = mysqli_fetch_assoc($result6)) {
if($row6['spPostFieldValue'] != ''){
$profileId = $row6['spPostFieldValue'];
$result7 = $pro->read($profileId);
if($result7 != false){
$row7 = mysqli_fetch_assoc($result7);
?>
<div class="col-md-3">
<div class="featuringBox row bg_white no-margin"style="border-radius: 15px;">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
<div class="col-md-3 no-padding">
<?php 
echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
?>
</div>
<div class="col-md-9 no-padding">
<h4><?php echo $row7['spProfileName'];?></h4>
</a>
<div class="col-md-12">
<span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $profileId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms getCntactid">Contact Organizer</span>
</div>
</div>
</div>
<!-- <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $row7['spProfileName'];?></a>, -->
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

<div class="row">
<?php

if(!empty($specification)){

?>
<div class="col-md-12">
<p style="padding-top: 20px;padding-left: 20px;"><?php echo $specification; ?></p>
</div>
<?php


}else{
echo"<h3 class='text-center'>No record Found!</h3>";
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

<?php include('postshare.php');?>
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>

<script type="text/javascript">

$(document).ready(function() {
//alert();
$('.submitevent').click(function() {
//  alert();

var flagdesc = $('#flag_desc').val(); 
if (flagdesc == "" ){
$('#flagdesc_error').text("This Field is Required."); 
$("#flag_desc").focus();
return false;

}else {
$("#addflagdata").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
});
</script>


<script type="text/javascript">
function keyupflagfun() {

var flagdesc= $("#flag_desc").val()

if(flagdesc != "")
{
$('#flagdesc_error').text(" ");

}


}
</script>       
<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
// Colorbox Call
$(document).ready(function(){
$("[rel^='lightbox']").prettyPhoto();
});
</script>
<!-- image gallery script end -->
</body>
</html>
<?php
}
?><b></b>