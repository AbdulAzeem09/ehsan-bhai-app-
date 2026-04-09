<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$_GET["module"] = "10";
$_GET["categoryid"] = "10";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "GroupEvents";

if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
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
</style>
<!--This script for posting timeline data End-->
</head>

<body class="bg_gray" onload="pageOnload('groupdd')">
<?php

include_once ("../header.php");

$g = new _spgroup;
$result = $g->groupdetails($_GET["groupid"]);
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

<div class="col-md-12">
<div class="row">
<div class="col-md-12">
<div class="about_banner" id="ip6">
<div class="top_heading_group " id="ip6">
<div class="row">
<div class="col-md-6">
<span id="size1">Group  <small>[All Events]</small></span>
<!--                                                 <h3><span >Events</span></h3>
-->                                            </div>

<?php if ($row["spProfiles_idspProfiles"] == $_SESSION['pid']) { ?>

<div class="col-md-6">
<a href="<?php echo $BaseUrl?>/grouptimelines/group-sponsorlist.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&sponsor" class="btn btnPosting db_btn db_primarybtn pull-right btn-border-radius"><i class="fa fa-eye"></i><span > View Sponsor</span></a>

<a href="<?php echo $BaseUrl;?>/post-ad/events/group-form.php?groupid=<?php echo $_GET["groupid"]; ?>&groupname=<?php echo $_GET['groupname']; ?>&event&back=back&groupflag=gflag" class="btn btnPosting db_btn db_primarybtn pull-right btn-border-radius"><i class="fa fa-plus"></i><span > Add New Event </span></a>
</div>
<?php } ?>
</div>
</div>
<div class="row" style="margin-top: 25px;">
<?php

$start = 0;
// $limit = 2;
// $count = 1;
//$p      = new _postingview;
$p      = new _spgroup_event;
// $pf     = new _spevent;

// $e = getall_event
/* $pf     = new _spevent;*/





$res = $p->publicgroup_event($_GET["groupid"]);
// echo $p->ta->sql;
//echo $p->ta->sql;
if($res != false){
while ($row = mysqli_fetch_assoc($res)) { 


$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
$OrganizerName = "";


$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
// $OrganizerName = $row2['spPostingEventOrgName'];

$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
//posting fields
// $result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
/* if($result_pf){
$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
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
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}*/
?>
<div class="col-md-4">
<div class="upEventBox upcomingbox" style="width: 90%; margin-left: 22px; background-color: #f7f7f7!important;">
<div class="mainOverlay">
<a href="<?php echo $BaseUrl.'/grouptimelines/group-eventdetail.php?postid='.$row['idspPostings'];?>"
>

<?php
$pic = new _groupeventpic;

$res2 = $pic->readFeature($row['idspPostings']);
if($res2 != false){
if($res2->num_rows > 0){
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' 
class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
}
}
}else{
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive eventimg' src=' " . ($pic2) . "' >"; 
} else{
echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive eventimg'>"; 
}
}
?>
</div>
</a>
<div class="bodyEventBox">
<?php
if(!empty($startDate)){
//echo $start_date;
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

<span class="datetop pull-right">
<?php echo $month.' '.$day;?><?php echo $weak;?></span>


<a href="<?php echo $BaseUrl.'/grouptimelines/group-eventdetail.php?postid='.$row['idspPostings'];?>" class="eventcapitalize">

<?php echo $row['spPostingTitle'];?></a>
<span  class="eventcapitalize" style="margin-left: 0px;min-height: 20px!important;"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
<p class="text-justify eventcapitalize" style="min-height: 18px!important;">
<?php
if(strlen($row['spPostingNotes']) < 170){

echo $row['spPostingNotes'];

}else{

echo substr($row['spPostingNotes'], 0,170)."...";

} ?>
</p>
<!-- <?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
//echo $ei->ta->sql;
if($result != false && $result->num_rows > 0){
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
$title = "Going";
}
?>
<div class="ie_<?php echo $row['idspPostings'];?>">
<div class="dropdown intrestEvent" style="display: inline">
<button class="btn btn_group_join dropdown-toggle eventiconbtn" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>
<ul class="dropdown-menu ">
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="2"><?php echo $area2;?> Going</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="1"><?php echo $area1;?> Interested</a></li>
<li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="0"><?php echo $area0;?> May Be</a></li>
</ul>
</div>
</div> -->
</div>
<div class="footEventBox footupcoming">
<p><span class="date" 
style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate;?>  | <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
</div>
</div>
</div> <?php
}
}else{
echo"<h3 class='text-center'>Group Event Not Available!</h3>";
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
<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>
</body>
</html>
