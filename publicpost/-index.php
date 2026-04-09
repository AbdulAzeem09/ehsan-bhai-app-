<?php
include('../univ/baseurl.php');
//session_start();
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>
<!doctype html>
<html>
<head>

<?php include('../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->

<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute({
top: 20,
bottom: 50
});
}
});
function execute_right(settings) {
$('#sidebar_right').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});

</script>
<!--This script for sticky left and right sidebar END-->
.reactionbtn


</head>
<body class="bg_gray" onload="pageOnload('<?php
if (isset($_GET["globaltimeline"]) == 7){
echo "timelines";
}elseif (isset($_GET["myfavorite"]) == 3){
echo "favorite";
}elseif (isset($_GET["friendstore"]) == 4){
echo "store";
}elseif (isset($_GET["groupstore"]) == 5){
echo "store";
}elseif (isset($_GET["mystore"]) == 6){
echo "store";
}elseif (isset($_GET["mytimeline"]) == 2){
echo "mytimeline";
}else{
echo "store";
}
?>')" >


<?php

include_once("../header.php");
?>
<?php include('globaltimelineformEdit.php');?>
<!--send timeline link to email popup-->

<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="sp-Profiles-idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>">

<input type="hidden" id="checkdraft">
<section class="landing_page">
<div class="container pubpost">

<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php');?>
</div>
<div class="col-md-7" >

<div class="pop-up">
<p id="aboutprofile"></p>
</div>
<div class="<?php echo (isset($_GET["groupflag"]) ? "hidden" : ""); ?>">
<ul class="pagination <?php echo ($_GET["groupstore"] == 5 ? "" : "hidden"); ?>">
<li class="page-item">
<a class="page-link" href="#" aria-label="Previous">
<span aria-hidden="true">&laquo;</span>
<span class="sr-only">Previous</span>
</a>
</li>
<?php
$g = new _spgroup;
$result = $g->groupmember($_SESSION['uid']);
if ($result != false) {
while ($row = mysqli_fetch_assoc($result)) {

echo "<li class='" . (($row['idspGroup'] == $_GET["gid"]) ? "active" : "") . "'><a href='/private-store/?gid=" . $row['idspGroup'] . "&gname=" . $row['spGroupName'] . "&back=back' class='groupsearch' data-gid='" . $row['idspGroup'] . "' data-gname='" . $row['spGroupName'] . "'>" . $row['spGroupName'] . "</a></li>";
}
}
?>
<li class="page-item">
<a class="page-link" href="#" aria-label="Next">
<span aria-hidden="true">&raquo;</span>
<span class="sr-only">Next</span>
</a>
</li>
</ul>
</div>
<!-- Droup Down Complete-->

<?php
if (isset($_GET["categoryID"])) {
include_once("../Filter/index.php");
} else {
if (!isset($_GET["globaltimeline"])) {
//PRODUCT NAME
include_once("../Filter/storesearch.php");
include_once("../Filter/index.php");
}
}
?>
<div class="detailaboutfilter"></div>
<div id="current_search"> </div><!--Current Search-->
<div class="socials"><!--Socials-->
<?php
if (isset($_GET["globaltimeline"])) {
if ($_GET["globaltimeline"] == 7) {
//timeline form code.
include("globaltimelineform.php");
//on timeline filter 
include("../Filter/timeline-filter.php");
if(isset($_GET['post-detail'])){
include("../publicpost/singletimelines.php");
}else{
include("globaltimelines.php");
}
}
}
?>

</div>

<div class="<?php echo ($_GET["globaltimeline"] == 7 ? "" : "panel panel-success "); ?>">
<div class="panel-heading">
<div class="row">
<div class="col-md-8">
<p class="panel-title" style="font-size:160%;">
<?php
if (isset($_GET["categoryName"])) {
if ($_GET["categoryName"] == "Buy&Sell") {
if (!isset($_GET["profileid"])) {
echo "<div clas='row'>";
echo "<div class='col-md-6'>";
echo "<div class='btn-group' role='group' aria-label='...'>
<a href='../retail/' id='sellpost' class='btn btn-default buysell " . ($_GET["spPostingsFlag"] == 2 ? "active" : "") . "' role='button'>Retail</a>

<a href='../sell/' id='sellpost' class='btn btn-default buysell " . ($_GET["spPostingsFlag"] == 0 ? "active" : "") . "' role='button'>Wholesale</a>

</div></div>";
echo "</div>";
} else {
$p = new _spprofiles;
$res = $p->read($_GET["profileid"]);
if ($res != false) {
$rows = mysqli_fetch_assoc($res);
echo "<b>" . ucfirst($rows["spDynamicWholesell"]) . "</b>&nbsp;&nbsp;&nbsp; " . $rows["spProfileAbout"];
}
}
} else {
echo $_GET["categoryName"];
if ($_GET["categoryName"] == "Freelancers") {
echo "<button type='button' class='btn btn-success pull-right' id='browsefreelancer'> Browse Freelancers</button>";
}
}
} elseif (isset($_GET["globaltimeline"])) {
if ($_GET["globaltimeline"] == 7) {
echo "";
}
} elseif (isset($_GET["myfavorite"])) {
if ($_GET["myfavorite"] == 3) {
echo "Favorite";
}
} elseif (isset($_GET["friendstore"])) {
if ($_GET["friendstore"] == 4) {
echo "Friend's store";
}
} elseif (isset($_GET["groupstore"])) {
if ($_GET["groupstore"] == 5) {
echo "Group store  " . (isset($_GET["gname"]) ? "(" . $_GET["gname"] . ")" : "") . "";
}
} elseif (isset($_GET["mystore"])) {
if ($_GET["mystore"] == 6) {
echo "My store";
}
} elseif (isset($_GET["mytimeline"])) {
if ($_GET["mytimeline"] == 2) {
echo "My timeline";
}
} else {
echo "Public Post";
}
if (isset($_GET["categoryName"])) {
if (($_GET["categoryName"]) == "Events") {//Event in my city Filter
$p = new _spprofiles;
$res = $p->read($_SESSION["pid"]);
if ($res != false) {
$rows = mysqli_fetch_assoc($res);
echo "<button type='button' class='btn btn-primary btn-sm pull-right cityevent' data-city='" . $rows["spProfilesCity"] . "'>Events in my city</button>";
}
}
}
?>
<span class="btn-group pull-right <?php echo ($_GET["categoryName"] == "Trainings" ? "" : "hidden") ?>" role="group" aria-label="...">

<button type="button" class="btn btn-default btn-sm free-training active trainingv">Free</button>
<button type="button" class="btn btn-default btn-sm paid-training trainingv">Paid</button>
</span>
<!--Free Training and Paid Training-->
</p>
</div>
<div class="col-md-4">
<div class="<?php echo($_GET["globaltimeline"] == 7 ? "hidden" : ""); ?>">
<div class="buttons btngrid2list pull-right">
<!--Sorting Testing-->
<span class="dropdown">
<button class='btn btn-primary dropdown-toggle autohover'  data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span id="sort"></span> <span class="fa fa-sort"></span></button> 
<ul class="dropdown-menu dropdowncontent" aria-labelledby="dropdownMenu1">
<li><a href="#" class="sortable" id="leastexpensive">Least expensive</a></li>
<li><a href="#" class="sortable" id="mostexpensive">Most expensive</a></li>
<li><a href="#" class="sortable" id="freeshipping">Free Shipping</a></li>
<li><a href="#" id="newer" class="selected sortable">Most recently post</a></li>
<li><a href="#" id="older" class="sortable">Older Post</a></li>
<li><a href="#" class="sortable" id="mostreview">Most reviews</a></li>
<li><a href="#" class="sortable" id="bestrating">Best rating</a></li>
</ul>
</span>
<!--Sorting Testing Code Complete-->

<button class="btn btn-success btn-sm  grd devicemanage"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></button>
<button class="btn btn-success btn-sm lst active devicemanage"><span class= "glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
</div>
</div>
</div>  
</div>
</div>
<div class="panel-body social">
<div class="row">
<ul class="list-group ">
<?php
//TimeLine shared to me by other person
if (isset($_GET["globaltimeline"]) == 7) {
$_GET["publictimeline"] = 7;
include("public-timeline.php");
}


//My favourite Post
elseif (isset($_GET["myfavorite"]) == 3) {
$_GET["publictimeline"] = $_GET["myfavorite"];
include("public-timeline.php");
}

//Friend Store
elseif (isset($_GET["friendstore"]) == 4) {
$_GET["publictimeline"] = $_GET["friendstore"];
include("public-timeline.php");
}
//Group Store
elseif ($_GET["groupstore"] == 5) {
$_GET["publictimeline"] = $_GET["groupstore"];
include("public-timeline.php");
} elseif ($_GET["mystore"] == 6) {
$_GET["publictimeline"] = $_GET["mystore"];
include("public-timeline.php");
} elseif ($_GET["mytimeline"] == 2) {
$_GET["publictimeline"] = $_GET["mytimeline"];
include("public-timeline.php");
} elseif (isset($_GET["friendid"])) {
$_GET["publictimeline"] = 8;
include("public-timeline.php");
}
//public post
else {
$_GET["publictimeline"] = "1";
include("public-timeline.php");
}
?>
</ul>
</div><!--div class row-->
</div>
</div>
<!--modal-->
<?php  include("postshare.php"); ?>
<!--modal complete-->

</div>
<div id="sidebar_right" class="col-md-3 no-padding" style="left: auto" >
<?php include('../component/right-landing.php');?>
</div>
</div>
</section>


<?php include('../component/footer.php');?>
<?php include('../component/btm_script.php'); ?>

</body>
</html>
