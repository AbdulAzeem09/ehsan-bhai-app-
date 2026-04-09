<?php 
include('../univ/baseurl.php');
session_start();
//session_start();
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$p = new _postingview;
$fps = new _freelance_project_status;



$res = $p->singletimelines($_GET['postid']);
//echo $p->ta->sql;
if($res){
$row = mysqli_fetch_assoc($res);
if($_SESSION['pid'] != $row['idspProfiles']){

header('location:'.$BaseUrl.'/freelancer');
}
$title = $row['spPostingtitle'];
}else{
header('location:'.$BaseUrl.'/freelancer');
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/links.php');?>

<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->

</head>

<body class="bg_gray">
<?php

$header_select = "freelancers";
include_once("../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">
<div class="col-xs-12 col-sm-3 leftsidebar">
<?php include('../component/left-freelancer.php');?>
</div>
<div class="col-xs-12 col-sm-9 nopadding">
<?php include('top-banner-freelancer.php');?>
<div class="col-md-12 nopadding dashboard-section">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
<li><a href="<?php echo $BaseUrl;?>/freelancer/active-bid.php">My Projects</a></li>
<li><?php echo $title;?></li>
</ul>
</div>
</div>
<div class="col-xs-12 nopadding dashboard-section">

<div class="">
<?php
$p = new _postingview;
$res = $p->singletimelines($_GET['postid']);
//echo $p->ta->sql;
if($res){
$row = mysqli_fetch_assoc($res);
$title = $row['spPostingtitle'];
$overview = $row['spPostingNotes'];


$price = $row['spPostingPrice'];
$dt = new DateTime($row['spPostingDate']);
$member = new DateTime($row['spProfileSubscriptionDate']);
$clientId = $row['idspProfiles'];

$pf = new _postfield;

$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$closingdate = "";
$Fixed = "";
$Category = "";
$hourly = "";
$skill = "";
$projectType = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($closingdate == ''){
if($row2['spPostFieldName'] == 'spClosingDate_'){
$closingdate = $row2['spPostFieldValue']; 
}
}
if($Fixed == ''){
if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
if($row2['spPostFieldValue'] == 1){
$Fixed = "Fixed";
}
}
}
if($Category == ''){
if($row2['spPostFieldName'] == 'spPostingCategory_'){
$Category = $row2['spPostFieldValue']; 
}
}
if($hourly == ''){
if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
if($row2['spPostFieldValue'] == 1){
$hourly = "Rate Per hour";
}
}
}
if($skill == ''){
if($row2['spPostFieldName'] == 'spPostingSkill_'){
$skill = explode(',', $row2['spPostFieldValue']);
}
}
if($projectType == ''){
if($row2['spPostFieldName'] == 'spPostingProfiletype_'){
$projectid = $row2['spPostFieldValue'];
}
}

}
$postingDate = $p-> spPostingDate($row["spPostingDate"]);
}
} ?>
<div class="col-xs-12 freelancer-post-detail">
<h2 class="designation-haeding"><?php echo $title;?></h2>
<p class="timing-week"><?php echo ($Fixed != '')? $Fixed: $hourly;?> - <?php echo $Category;?> - <?php echo $postingDate;?></p>
<div class="col-xs-12 nopadding">
<?php
if(count($skill) >0){
foreach($skill as $key => $value){
if($value != ''){
echo "<span class='skills-tags'>".$value."</span>";
}

}
}
?>

</div>
<div class="col-xs-12 nopadding margin-top-13">
<div class="col-xs-12 col-sm-6 nopadding">
<div class="col-xs-2 col-sm-1 nopadding">
<img src="<?php echo $BaseUrl?>/assets/images/freelancer/timer.png">
</div>
<div class="col-xs-10 col-sm-11 nopadding">
<p><span class="time-level">Category</span>
</p>
<p class="time-level-detail"><?php echo $Category;?></p>

</div>
</div>
<div class="col-xs-12 col-sm-6 nopadding">
<div class="">
<p>Price <i class="fa fa-dollar"></i> <?php echo $price;?></p>
</div>

</div>

</div>
<div class="col-xs-12 detail-description text-justify">
<p><?php echo $overview;?></p>
</div>
</div>
</div>
</div>
<?php
$fm = new _freelance_milestone;
$result = $fm->readMymilestone($_GET['postid']);
//echo $fm->ta->sql;
if($result){
?>
<h2>Milestone</h2>
<div class="col-md-12 nopadding dashboard-section">
<div class="table-responsive dashboardtable">
<table class="table tbl_activebid text-left">
<thead>
<tr>
<th>Freelancer Name</th>
<th>Price</th>
<th>Deliver Day</th>
<th>Description</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
while ($row3 = mysqli_fetch_assoc($result)) {
$d = new _spprofiles;

$MileStonePersonName = $d->getProfileName($row3['spProfiles_idspProfiles']);
?>
<tr>
<td><a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row3['spProfiles_idspProfiles'];?>" class="red"><?php echo $MileStonePersonName;?></a></td>
<td>$<?php echo $row3['milestonePrice'];?></td>
<td><?php echo $row3['milestoneDeliverDay'];?></td>
<td><?php echo $row3['milestoneDescription'];?></td>
<td>
<?php
if($row3['milestoneStatus'] == 0){
echo "Pending";
if($i == 1){
?>
<a href="<?php echo $BaseUrl.'/freelancer/apv_milestone.php?milestone='.$row3['id_milestone'];?>" class="btn create_add"><i class="fa fa-check"></i></a>
<?php
$i++;
}
}else if($row3['milestoneStatus'] == 1){
echo "Completed";
}
?>
</td>
</tr>
<?php
}
?>

</tbody>
</table>
</div>
</div>
<?php
$post = new _postings;
$result = $post->chkProjectStatus($row['idspPostings']);
if($result == false){
?>
<!-- Modal -->
<div id="projectCancel" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="project-status.php">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $row['spPostingtitle'];?></h4>
</div>
<div class="modal-body">
<input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
<div class="row add_form_body">

<div class="col-md-12">
<div class="form-group">
<label for="Description">Why cancel this project?</label>
<textarea name="txtCancelDescription" class="form-control"></textarea>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary" name="btnCancel">Save</button>
</div>
</div>
</form>
</div>
</div>
<div class="row no-margin text-right">
<a href="<?php echo $BaseUrl.'/freelancer/project-status.php?postid='.$_GET['postid'].'&action=complete';?>" class="btn create_add">Completed</a>
<a href="#" data-toggle="modal" data-target="#projectCancel" class="btn btn_freelancer">Canceled</a>
</div>
<?php
}


}
$post = new _postings;
$result = $post->chkProjectStatus($row['idspPostings']);
if($result == false){
?>
<h2>Bids</h2>
<div class="col-md-12 nopadding dashboard-section">
<div class="col-xs-12 dashboardtable">
<div class="table-responsive">

<table class="table text-center tbl_activebid">
<thead>
<tr>
<th>Freelancer Name</th>
<th>Bids</th>
<th>Upfront</th>
<th>Days Delivered</th>
<th>Interview</th>
<th style="text-align: center;">Short List</th>
<th class="action">Proposalx</th>
</tr>
</thead>
<tbody>
<?php
$p = new _postfield;
$res = $p->totalbids($_GET['postid']);
//echo $p->ta->sql;
if($res){
while ($row = mysqli_fetch_assoc($res)) {
//get bid detail

$d = new _spprofiles;
$freelancerName = $d->getProfileName($row['spProfiles_idspProfiles']);

$result_pf = $p->allbids($row['spProfiles_idspProfiles'], $_GET['postid']);
//echo $p->ta->sql;
if($result_pf){
$bidPrice = "";
$initialPercentage ="";
$totalDays = "";
$coment = "";
//chek if project is rejected
$result4 = $fps->chekProjectReject($_GET['postid']);
//chek project assign howa b ha ya ni
$result5 = $fps->checkStatusExist($_GET['postid']);
//echo $fps->ta->sql;
while($row2 = mysqli_fetch_assoc($result_pf)){

if($bidPrice == ""){
if($row2['spPostFieldName'] == 'bidPrice'){
$bidPrice = $row2['spPostFieldValue'];
}
}
if($initialPercentage == ""){
if($row2['spPostFieldName'] == 'initialPercentage'){
$initialPercentage = $row2['spPostFieldValue'];
}
}
if($totalDays == ""){
if($row2['spPostFieldName'] == 'totalDays'){
$totalDays = $row2['spPostFieldValue'];
}
}
if($coment == ""){
if($row2['spPostFieldName'] == 'comment'){
$coment = $row2['spPostFieldValue'];
}
}


} ?>
<tr>
<td ><a class="red" href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['spProfiles_idspProfiles'];?>"><?php echo $freelancerName;?></td>
<td>$<?php echo $bidPrice;?></td>
<td><?php echo $initialPercentage;?>%</td>
<td><?php echo $totalDays;?> Days</td>
<td>
<!-- Modal -->
<div id="chat-<?php echo $row['spProfiles_idspProfiles'];?>" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="freelance_chat.php" >
<div class="modal-content no-radius text-left">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title ">Send Message</h4>
</div>
<div class="modal-body">
<input type="hidden" name="chat_date" value="<?php echo date('Y-m-d h:m');?>">
<input type="hidden" name="sender_idspProfiles" value="<?php echo $_SESSION['pid'];?>" >
<input type="hidden" name="receiver_idspProfiles" value="<?php echo $row['spProfiles_idspProfiles']; ?>" >

<label>Write Message</label>
<textarea class="form-control no-radius" name="chat_conversation"></textarea>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
<button type="submit" class="btn btn-primary" >Send Message</button>
</div>
</div>
</form>
</div>
</div>
<a href="javascript(0)" data-toggle="modal" data-target="#chat-<?php echo $row['spProfiles_idspProfiles'];?>" class="red">Chat</a>
</td>
<td>
<?php

$sl = new _shortlist;
$result2 = $sl->chekShortlist($_GET['postid'], $row['spProfiles_idspProfiles']);
//echo $sl->ta->sql;
if($result2){ ?>
<a href="<?php echo $BaseUrl.'/freelancer/shortlist.php?user='.$row['spProfiles_idspProfiles'].'&postid='.$_GET['postid'].'&reject';?>" class="red">Remove</a><?php

}else{ ?>
<a href="<?php echo $BaseUrl.'/freelancer/shortlist.php?user='.$row['spProfiles_idspProfiles'].'&postid='.$_GET['postid'].'&accept';?>" class="red">Add</a> <?php
}
?>

</td>
<td>
<?php 
//project aprove howa b ha ya ni

if($result5 == false){ ?>
<div class="dropdown">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
<span class="caret"></span></button>
<ul class="dropdown-menu setting_left">
<li><a href="<?php echo $BaseUrl.'/freelancer/status.php?status=accept&postid='.$_GET['postid'].'&pid='.$row['spProfiles_idspProfiles'].'&price='.$bidPrice;?>">Accept</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/status.php?status=reject&postid='.$_GET['postid'].'&pid='.$row['spProfiles_idspProfiles'];?>">Reject</a></li>

</ul>
</div> <?php
}else{
$result3 = $fps->chekProjectAssign($row['spProfiles_idspProfiles'], $_GET['postid']);
//project accept
if($result3){ ?>
<div class="dropdown">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
<span class="caret"></span></button>
<ul class="dropdown-menu setting_left">
<li><a href="<?php echo $BaseUrl.'/freelancer/status.php?status=accept&postid='.$_GET['postid'].'&pid='.$row['spProfiles_idspProfiles'].'&price='.$bidPrice;?>">Accept</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/status.php?status=reject&postid='.$_GET['postid'].'&pid='.$row['spProfiles_idspProfiles'];?>">Reject</a></li>

</ul>
</div> <?php
}else{
//if project reject
if($result4){ ?>
<div class="dropdown">
<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
<span class="caret"></span></button>
<ul class="dropdown-menu setting_left">
<li><a href="<?php echo $BaseUrl.'/freelancer/status.php?status=accept&postid='.$_GET['postid'].'&pid='.$row['spProfiles_idspProfiles'].'&price='.$bidPrice;?>">Accept</a></li>
<li><a href="<?php echo $BaseUrl.'/freelancer/status.php?status=reject&postid='.$_GET['postid'].'&pid='.$row['spProfiles_idspProfiles'];?>">Reject</a></li>

</ul>
</div> <?php
}else{
echo "---";
}

}
}

?>


</td>
</tr> <?php
}

}


} ?>


</tbody>
</table>
</div>
</div>
</div> <?php
} ?>
</div>
</div>
</section>



<?php 
include('../component/footer.php');
include('../component/btm_script.php'); 
?>
</body>
</html>
