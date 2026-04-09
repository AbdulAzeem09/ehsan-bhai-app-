<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}

$pid=$_SESSION['pid'];
$getid=$group_id;
$obj2=new _spAllStoreForm;	
$ress2=$obj2->readdatabymulid($getid,$pid);
if($ress2 ==false){
//die("=======");
header("location:$BaseUrl/my-groups/?msg=notaccess");

}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<?php include('../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

<style type="text/css">

.upEventBox .bodyEventBox a {
display: block;
font-size: 18px;
font-family: "Proxima Nova";
font-weight: 700;
width: 80%;
line-height: 16px;
min-height: 0px!important;
}
.seeproduct{
display: none;
}
.loadpost{
font-size: 18px;
color: #202548;
font-weight: bold;
margin-right: 30%;
}
.loadpost:hover{
text-decoration: underline!important;
font-size: 18px;
color: #4F95FF!important;
font-weight: bold;

}
.event-descrip-section {
height:  99px;
}
</style>
<!--This script for posting timeline data End-->
</head>

<body class="bg_gray" onload="pageOnload('groupdd')">
<?php

include_once ("../header.php");

$g = new _spgroup;
$result = $g->groupdetails($group_id);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
?>
<section class="landing_page">
<div class="container">
<div class="row">
<div class="col-md-2 no-padding">
<?php include('../component/left-group.php');?>
</div>
<div class="col-md-10">
<div class="row">
<div class="col-md-12">
<div class="about_banner" id="ip6">
<div class="top_heading_group " id="ip6">
<div class="row">
<div class="col-md-6">
<span id="size1">Group  <small>[Events]</small></span>
<!--                                                 <h3><span >Events</span></h3>
-->                                            </div>

<?php if ($row["spProfiles_idspProfiles"] == $_SESSION['pid']) { ?>

<div class="col-md-6">
<!-- <a href="<?php echo $BaseUrl;?>/grouptimelines/group-sponsor.php" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-eye"></i><span > View Sponsor</span></a> -->

<!--  <a href="<?php echo $BaseUrl;?>/grouptimelines/dashboard/" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-dashboard"></i><span > Dashboard</span></a> -->

<!--<a href="<?php echo $BaseUrl;?>/post-ad/events/group-form.php?groupid=<?php echo $_GET["groupid"]; ?>&groupname=<?php echo $_GET['groupname']; ?>&event&back=back&groupflag=gflag" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-plus"></i><span > Add New Event </span></a>-->

<a href="<?php echo $BaseUrl;?>/post-ad/events/?groupid=<?php echo $group_id; ?>" class="btn btnPosting db_btn db_primarybtn pull-right btn-border-radius"><i class="fa fa-plus"></i><span > Add New Event </span></a>
</div>
<?php } ?>
</div>
</div>
<div class="row" style="margin-top: 25px; margin-bottom: 12px;">


<?php

include('group_shared_event.php');

$start = 0;
$limit = 2;
$count = 1;
$sp      = new _postshare;
$p      = new _spgroup_event;
// $pf     = new _spevent;

// $e = getall_event
/* $pf     = new _spevent;*/


$res    = $p->publicgroup_eventnew($group_id);
// echo $p->ta->sql;
//echo $p->ta->sql;


if($res != false){

$group_event = $res->num_rows;

while ($row = mysqli_fetch_assoc($res)) {

// print_r($row); 

$groupid = $row['spgroupid'];
$groupname = $row['spgroupname'];
$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);

?>
<div class="col-md-4">
<div class="upEventBox upcomingbox <?php echo ($count > 6)?'seeproduct':'';?>" style="height: 430px;width: 90%; margin-left: 22px; background-color: #f7f7f7!important;border: 1px solid darkgrey;">

<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$group_id.'&groupname='.$_GET['groupname'];?>" class="eventcapitalize">

<?php }else{ ?>

<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

<?php } ?>

<?php
$pic = new _groupeventpic;

$res2 = $pic->readFeature($row['idspPostings']);
if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) { echo 1;
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "'  style='height:  180px !important;'>"; 
} else{ echo 2;
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>"; 
}
}else{ echo 3;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' style='height:  180px !important;' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>"; 
}
}
}else{ 

$pic1 = new _eventpic;
$res2 = $pic1->readFeature($row['idspPostings']);

if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' style='height:  180px !important;' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>"; 
}
}
?>
</a>
<div class="bodyEventBox">
<?php
if(!empty($startDate)){
echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
}else{
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<!---<span class="datetop pull-right" >$month.' '.$day;' '.$weak;?></span> --->
<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$group_id;?>" class="eventcapitalize" > 

<?php }else{ ?>

<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

<?php } ?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$group_id.'&groupname='.$_GET['groupname'];?>" class="eventcapitalize" style="height: 38px;font-size:16px;"> 

<?php 
if(strlen($row['spPostingTitle']) < 40){

echo $row['spPostingTitle'];

}else{

echo substr($row['spPostingTitle'], 0,40)."...";

} ?>
</a>
<div class="event-descrip-section">
<span  class="eventcapitalize" style="margin-left: 0px;min-height: 20px!important;font-size:15px!important;"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
<p class="eventcapitalize" style="min-height: 18px!important;word-break:break-all;">
<?php
if(strlen($row['spPostingNotes']) < 80){

echo $row['spPostingNotes'];

}else{

echo substr($row['spPostingNotes'], 0,80)."...";

} ?>
</p>
</div>
<!--    <?php
$area2 = "";
$area1 = "";
$area0 = "";
$title = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
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
}

$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($row['idspPostings'], 2);
// echo $ie->ta->sql;
if($resulti1 != false && $resulti1->num_rows >0){
$going = $resulti1->num_rows;
}else{
$going =  0;
}

$resulti2 = $ie->chekGoing($row['idspPostings'], 1);
// echo $ie->ta->sql;
if($resulti2 != false && $resulti2->num_rows >0){
$interested = $resulti2->num_rows;
}else{
$interested =  0;
}


$resulti3 = $ie->chekGoing($row['idspPostings'], 0);
// echo $ie->ta->sql;
if($resulti3 != false && $resulti3->num_rows >0){
$MayBe = $resulti3->num_rows;
}else{
$MayBe =  0;
}
?>
<div class="ie_<?php echo $row['idspPostings'];?>">
<div class="dropdown intrestEvent" style="display: inline">

<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>

<?php  }else{ ?>

<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle='modal' data-target='#alertNotEmpProfile' aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>
<?php
}
?>


<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="2"><?php echo $area2;?> Going (<?php echo $going; ?>)</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="1"><?php echo $area1;?> Interested (<?php echo $interested; ?>)</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="0"><?php echo $area0;?> May Be (<?php echo $MayBe; ?>)</a></li>
</ul>
</div>
</div> -->
</div>

<div class="footEventBox footupcoming">
<p style="font-size: 11px;">
<!-- <a href="<?php echo $BaseUrl.'/post-ad/events/group-form.php?groupid='.$row['spgroupid'].'&groupname=member testing&event&back=back&groupflag=gflag&postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i class="fa fa-edit" style="font-size: 16px;">&nbsp;
Edit</i>
</a> -->


<!--------------------------------------------------------->
<?php
$cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
$success_return = $BaseUrl."/paymentstatus/groupevent_payment_success.php?postid=".$row['idspPostings']."&sellid=".$row['spProfiles_idspProfiles']."&groupid=".$row['spgroupid'];
$paypal_url 	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$merchant_email = 'developer-facilitator@thesharepage.com';

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



echo "<input type='hidden' name='item_name_1' value='".$row['spPostingTitle']."'>";
echo "<input type='hidden' name='item_number' value='143' >";
echo "<input type='hidden' class='".$row['idspPostings']."' name='amount_1' value='".$row['spPostingPrice']."'>";

echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
?>
<!--<button type="submit" class="btn butn_cancel pull-right " id="Buynow" style="border-radius: 25px;float:right;margin-top: -45px;width: 110px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket</button>-->

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'].'&groupid='.$group_id.'&groupname='.$_GET['groupname'];?>" class="btn butn_cancel pull-right btn-border-radius" id="Buynow" style="float:right;margin-top: -45px;width: 110px;" ><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket </a>
</form>
<!----------------------------------------------------------------->
<p style="font-size: 11px;"><span class="date"  style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate;?>  | 
<?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
</p>
</div>
</div>
</div> <?php
$count++;

}
$p      = new _spgroup_event;
$r1    = $p->readsharePost($group_id);



/*  while ($row_1 = mysqli_fetch_assoc($r1)) {
print_r($row_1);
$gpid = $row_1['spPostings_idspPostings'];




} */

/*   while ($row_1 = mysqli_fetch_assoc($r1)) {
// echo '<pre>';
// print_r($row_1); 

$groupid = $row_1['spgroupid'];
$groupname = $row_1['spgroupname'];
$venu = $row_1['spPostingEventVenue'];
$startDate = $row_1['spPostingStartDate'];
$startTime = $row_1['spPostingStartTime'];
$endTime = $row_1['spPostingEndTime'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);

?>
<div class="col-md-4">
<div class="upEventBox upcomingbox <?php echo ($count > 6)?'seeproduct':'';?>" style="height: 430px;width: 90%; margin-left: 22px; background-color: #f7f7f7!important;border: 1px solid darkgrey;">

<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row_1['idspPostings'].'&groupid='.$_GET['groupid'];?>" class="eventcapitalize">

<?php }else{ ?>

<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

<?php } ?>

<?php
$pic = new _groupeventpic;

$res2 = $pic->readFeature($row_1['idspPostings']);
if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) { echo 1;
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "'  style='height:  180px !important;'>"; 
} else{ echo 2;
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>"; 
}
}else{ echo 3;
$res2 = $pic->read($row_1['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' style='height:  180px !important;' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>"; 
}
}
}else{ 

$pic1 = new _eventpic;
$res2 = $pic1->readFeature($row_1['idspPostings']);

if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' style='height:  180px !important;' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg' style='height:  180px !important;'>"; 
}
}
?>
</a>
<div class="bodyEventBox">
<?php
if(!empty($startDate)){
echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
}else{
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<!---<span class="datetop pull-right" >$month.' '.$day;' '.$weak;?></span> --->
<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row_1['idspPostings'].'&groupid='.$_GET['groupid'];?>" class="eventcapitalize" > 

<?php }else{ ?>

<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

<?php } ?>
<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row_1['idspPostings'].'&groupid='.$_GET['groupid'];?>" class="eventcapitalize" style="height: 38px;font-size:16px;"> 

<?php 
if(strlen($row_1['spPostingTitle']) < 40){

echo $row_1['spPostingTitle'];

}else{

echo substr($row_1['spPostingTitle'], 0,40)."...";

} ?>
</a>
<div class="event-descrip-section">
<span  class="eventcapitalize" style="margin-left: 0px;min-height: 20px!important;font-size:15px!important;"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
<p class="eventcapitalize" style="min-height: 18px!important;word-break:break-all;">
<?php
if(strlen($row_1['spPostingNotes']) < 80){

echo $row_1['spPostingNotes'];

}else{

echo substr($row_1['spPostingNotes'], 0,80)."...";

} ?>
</p>
</div>
<!--    <?php
$area2 = "";
$area1 = "";
$area0 = "";
$title = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($row_1['idspPostings'], $_SESSION['pid']);
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
}

$ie = new _eventIntrest;
$resulti1 = $ie->chekGoing($row_1['idspPostings'], 2);
// echo $ie->ta->sql;
if($resulti1 != false && $resulti1->num_rows >0){
$going = $resulti1->num_rows;
}else{
$going =  0;
}

$resulti2 = $ie->chekGoing($row_1['idspPostings'], 1);
// echo $ie->ta->sql;
if($resulti2 != false && $resulti2->num_rows >0){
$interested = $resulti2->num_rows;
}else{
$interested =  0;
}


$resulti3 = $ie->chekGoing($row_1['idspPostings'], 0);
// echo $ie->ta->sql;
if($resulti3 != false && $resulti3->num_rows >0){
$MayBe = $resulti3->num_rows;
}else{
$MayBe =  0;
}
?>
<div class="ie_<?php echo $row['idspPostings'];?>">
<div class="dropdown intrestEvent" style="display: inline">

<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>
<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>

<?php  }else{ ?>

<button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle='modal' data-target='#alertNotEmpProfile' aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>
<?php
}
?>


<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="2"><?php echo $area2;?> Going (<?php echo $going; ?>)</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="1"><?php echo $area1;?> Interested (<?php echo $interested; ?>)</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="0"><?php echo $area0;?> May Be (<?php echo $MayBe; ?>)</a></li>
</ul>
</div>
</div> -->
</div>

<div class="footEventBox footupcoming">
<p style="font-size: 11px;">
<!-- <a href="<?php echo $BaseUrl.'/post-ad/events/group-form.php?groupid='.$row['spgroupid'].'&groupname=member testing&event&back=back&groupflag=gflag&postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i class="fa fa-edit" style="font-size: 16px;">&nbsp;
Edit</i>
</a> -->


<!--------------------------------------------------------->
<?php
$cancel_return = $BaseUrl."/paymentstatus/payment_cancel.php";
$success_return = $BaseUrl."/paymentstatus/groupevent_payment_success.php?postid=".$row['idspPostings']."&sellid=".$row['spProfiles_idspProfiles']."&groupid=".$row['spgroupid'];
$paypal_url 	= 'https://www.sandbox.paypal.com/cgi-bin/webscr';
$merchant_email = 'developer-facilitator@thesharepage.com';

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



echo "<input type='hidden' name='item_name_1' value='".$row['spPostingTitle']."'>";
echo "<input type='hidden' name='item_number' value='143' >";
echo "<input type='hidden' class='".$row['idspPostings']."' name='amount_1' value='".$row['spPostingPrice']."'>";

echo "<input type='hidden' id='payqty' class='payqty' name='quantity_1' value='1'>";
?>
<!-- <button type="submit" class="btn butn_cancel pull-right " id="Buynow" style="border-radius: 25px;float:right;margin-top: -45px;width: 110px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket</button>-->

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row_1['idspPostings'].'&groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'];?>" class="btn butn_cancel pull-right " id="Buynow" style="border-radius: 25px;float:right;margin-top: -45px;width: 110px;" ><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Buy Ticket </a>
</form>
<!----------------------------------------------------------------->
<p style="font-size: 11px;"><span class="date"  style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate;?>  | 
<?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
</p>
</div>
</div>
</div> <?php
$count++;

} */








if($group_event > 6){ ?>
<center>
<div class="loadingseemore"><a class="loadpost" id="fold_p">SEE MORE</a></div></center>
<?php }

}else{
//echo"<h3 class='text-center'>Group Event Not Available!</h3>";
}
?>



<!--     <div class="col-md-12 text-center">
<div class="viewAllEvent">
<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

<a href="<?php echo $BaseUrl;?>/grouptimelines/all-group-event.php?groupid=<?php echo $_GET["groupid"]; ?>&groupname=<?php echo $_GET['groupname']; ?>&event" class="btn btn_event viewallbtn" style="margin-bottom: 20px; margin-top: 0px;" >View All</a>

<?php  }else{ ?>

<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile'  style="margin-bottom: 20px; margin-top: 0px;" class="btn btn_event viewallbtn">View All</a> 

<?php
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
</div>
</section>
<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>


<script type="text/javascript">

$(document).ready(function(){

// Load more data
$('.loadpost').click(function(){
//  alert();

$(".seeproduct").show();
$(".loadpost").hide();



});
});

</script>

</body>
</html>
