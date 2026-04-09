<?php
include('../univ/baseurl.php');
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/links.php');?>
</head>

<body class="bg_gray" onload="pageOnload('groupdd')">
<?php
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
include_once ("../header.php");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
}
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
<div class="col-md-2">
<?php include('../component/left-group.php');?>
</div>
<div class="col-md-10">
<?php include('top_banner_group.php');?>
<div class="row">
<div class="col-md-12">
<div class="about_banner">
<div class="top_heading_group ">
<div class="row">
<div class="col-md-6">
<h3>Events</h3>
</div>
<div class="col-md-6">
<a href="<?php echo $BaseUrl;?>/post-ad/events/?groupid=<?php echo $_GET["groupid"]; ?>&groupname=<?php echo $_GET['groupname']; ?>&event&back=back&groupflag=gflag" class="btn btn-white pull-right btn-border-radius"><i class="fa fa-plus"></i> Add New Event</a>
</div>
</div>
</div>
<div class="row">
<?php
$p = new _postingview;
$res = $p->event($_GET["groupid"]);
//echo $p->ta->sql;
if ($res != false) {
$i = 0;
while ($row = mysqli_fetch_assoc($res)){
$price = $row['spPostingPrice'];
$catid = $row["idspCategory"];
$price = 0;
if (isset($row['spPostingPrice'])){
$price = $row['spPostingPrice'];
}

$productname = $row['spPostingtitle'];
//echo "<p>".$row['spPostingNotes']."</p>";
$postingnotes = $row['spPostingNotes'];
$post_id = $row['idspPostings'];
$ticketprice = $row['spPostingPrice'];                        

$i++;
$m = new _postfield;
$rm = $m->read($row["idspPostings"]);
//echo $m->ta->sql."<br>";
if ($rm != false) {
while($row2 = mysqli_fetch_assoc($rm)){
//Organizer Name
if($row2['spPostFieldLabel'] == "Organizer Name"){
$organizer_name = $row2['spPostFieldValue'];
}
//venu
if($row2['spPostFieldLabel'] == "Venue"){
$venu =  $row2['spPostFieldValue'];
}
//strt date

if($row2['spPostFieldLabel'] == "Start Date"){
$start_date = $row2['spPostFieldValue'];

}
} 
if(!empty($start_date)){
//echo $start_date;
$dy = new DateTime($start_date);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
}else{
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}

if(!empty($row["spPostingtitle"])){
$event_title = $row["spPostingtitle"];
}else{
$event_title = "No-Title";
}
?>
<div class="col-md-6">
<div class="event_box">
<?php 
//show posting pic on event
$result3 = $m->readPostingPic($row["idspPostings"]);
//echo $m->tad->sql;
if($result3 != false){
$row3 = mysqli_fetch_assoc($result3);
if(!empty($row3['spPostingPic'])){
echo "<img alt='Event Img' class='img-responsive' src=' " . ($row3['spPostingPic']) . "'>";
}
}else{
echo "<img alt='Event Img' class='img-responsive' src='".$BaseUrl."/assets/images/icon/event/event-1.png' >";
}
?>

<div class="mid_event">
<div class="mid_event_left">
<h3>
<span class="dd"><?php echo $day;?></span>
<span class="mm"><?php echo $month;?></span>
<span class="ww"><?php echo $weak;?></span>
</h3>
</div>
<div class="mid_event_right">
<h1><?php echo $event_title;?></h1>
<h3>at <?php echo $venu;?></h3>
<h4>5,256 people Interested</h4>
<h1>Ticket Price: $<?php echo $row['spPostingPrice'];  ?></h1>
</div>
</div>
<hr class="underline">
<div class="row">
<div  class="col-md-12">
<a href="#" class="btn btn-white btn-border-radius"><i class="fa fa-star"></i> Interested</a>
<a href="#" class="event_socil"><i class="fa fa-share-alt"></i></a>
<a href="#" class="event_socil"><i class="fa fa-star-o"></i></a>
<a href="<?php echo $BaseUrl;?>/grouptimelines/event_detail.php?postid=<?php echo $row["idspPostings"];?>&groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>" class="event_socil"><i class="fa fa-eye"></i></a>
<a href="#" class="pull-right event_socil">2 Friends Going</a>
</div>
</div>
</div>
</div>
<?php
}
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
<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>
</body>
</html>
