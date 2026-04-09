<?php

 /*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include("../univ/main.php");
// $dbHost  =   'localhost';
// $dbUser     =   'osspdev';
// $dbPass     =   'Office@256';
// $dbName     =   'thesharepage';

$dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
?>
<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "my-groups/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

<?php include('../component/f_links.php'); ?>
<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($) {
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
jQuery(document).ready(function($) {
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});
</script>
<style type="text/css">
@media screen and (min-width: 650px) {

.main_grop_box h2 {
color: #fff;
text-align: center;
font-size: 16px;
font-family: MarksimonRegular;
margin: -22px 0 10px;
}
}

.groupBtnSearch {
color: #fff !important;
background-color: #1c4994;
/*   margin-right: 133px!important;*/
}


.list-wrapper {
padding: 15px;
overflow: hidden;
}

.list-item {
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
display: contents;
}

.list-item h4 {
color: #81309d;
font-size: 18px;
margin: 0 0 5px;
}

.list-item p {
margin: 0;
}

.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}

.simple-pagination li {
display: inline-block;
margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #3e2048;
background-color: #3e2048;
box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
color: #FFF;

}

.heading07 h2 span,
.heading08 h2 span {
color: #6a7e3b;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {}

.textblack {
color: black;
}

.btn {
margin-right: 40px
}
</style>

<style>
body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	border: 1px solid #EEE;
	background: #FFF;
	margin-bottom: 10px;
	padding: 10px;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.list-item h4 {
	color: #81309d;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
}

.simple-pagination ul {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	text-align: center;
}

.simple-pagination li {
	display: inline-block;
	margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
	color: #666;
	padding: 5px 10px;
	text-decoration: none;
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
	background-color: #81309d;
	border-color: #81309d;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #3e2048;
}


</style>
<!--This script for sticky left and right sidebar END-->
</head>

<body onload="pageOnload('admin')" class="bg_gray">
<?php

include_once("../header.php");
$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);

$readProfileById = $p->read($_SESSION['pid']);
$userAddress = "";
if ($readProfileById != false) {

$getProfileData = mysqli_fetch_assoc($readProfileById);
//Search by location of user.
$userAddress = $getProfileData['address'];
}
?>
<section class="landing_page">
<div class="container">

<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-landing.php'); ?>
</div>
<div class="col-md-10">

<div class="row">

<input type="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="">

</div>
<div class="row">
<div class="col-md-12">
<div class="heading01 text-center" id="ip6" style="background-color: white;">
<?php
//print_r($_POST);
$count = new _spgroup;
$result_count = $count->groupmember($_SESSION['uid']);
//echo $count->ta->sql;
$private_count = 0;
$public_count = 0;

if ($result_count != false) {

while ($row7 = mysqli_fetch_assoc($result_count)) {
//print_r($row7);
if ($row7['spgroupflag'] == 1) {
$private_count++;
} else {
$public_count++;
}
}
}
?>

<span class="pull-left" id="size1" style="margin-top: 12px;
margin-left: 7px;">The SharePage Groups</span>
<div class="pull-right" style="margin-top: 12px;">
<label><a href="<?php echo $BaseUrl; ?>/my-groups/create-group.php" class="btn btnPosting db_btn db_primarybtn">
Create Group</a></label>
</div>
</div>
</div>

<div class="col-md-12">
<div class="heading01 text-center" id="ip6" style="background-color: white;">


<div class="left_head_top" style="margin-left: 130px;">

<form class="inner_top_form" method="POST" action="<?php echo $BaseUrl; ?>/my-groups/search-group.php">

<div class="form-group" style="margin-bottom: -8px!important;">
<select class="form-control cate_drop" name="txtCategory">
<option value="all">All</option><?php
$sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";
$result = mysqli_query($dbConn, $sql);

while ($rows = mysqli_fetch_assoc($result)) { ?>
<option value='<?php echo $rows["id"]; ?>' <?php echo (isset($_POST['txtCategory']) && $_POST['txtCategory'] == $rows["id"]) ? 'selected' : ''; ?>>
<?php echo $rows["group_category_name"]; ?>
</option>
<?php } ?>
</select>
</div>
<div class="form-group">
<input type="text" class="form-control searchbox" aria-describedby="basic-addon1" name="txtSearch" value="<?php if (isset($_POST['txtSearch'])) {
echo $_POST['txtSearch'];
} ?>" placeholder="Search by group title">
</div>
<button class="btn groupBtnSearch" type="submit" name="btnSearch"><i class="fa fa-search"></i> Search</button>
<!-- <input type="submit" class="btn" value="Advance Search" name="btnSearch" > -->
</form>

</div>
</div>
</div>









<div class="col-md-12">
<!-- <div class="topstatus timeline-topstatus" style="margin-top: 23px; min-height: 250px; border-bottom-left-radius: 25px; border-bottom-right-radius: 25px;">
-->

<div class="list-wrapper">
<?php
$g = new _spgroup;

if (!isset($_POST['txtCategory'])) {
$_POST['txtCategory'] = "all";
}

if ($_POST['txtSearch'] != "" && $_POST['txtCategory'] == "all") {
	

$txtTitle   = $_POST['txtSearch'];
$spgroupcategory = $_POST['txtCategory'];
$result = $g->groupmember_title($txtTitle, $userAddress,$spgroupcategory);
} else if ($_POST['txtCategory'] != "all" && $_POST['txtSearch'] == "") {


$txtCategory   = $_POST['txtCategory'];
$result = $g->groupmember_category($txtCategory, $userAddress,);
//$g->ta->sql;

} else if ($_POST['txtCategory'] == "all") {
	

$result = $g->readAll_groupmember(1, $userAddress);

} else if ($_POST['txtCategory'] != "all" && $_POST['txtSearch'] != "") {
	


$category = $_POST['txtCategory'];
$title = $_POST['txtSearch'];
$result = $g->groupmember_title_1($category, $title, $userAddress);
//die("4444");
} else {
	echo '55';
$result = $g->readAll_groupmember(1, $userAddress);
//die("5555");
}
if ($result != false) {

$bg_clr = 1;
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
//color background
if ($bg_clr == 1) {
$bg_clr_box = "bg_black";
} else if ($bg_clr == 2) {
$bg_clr_box = "bg_green_dark";
} else if ($bg_clr == 3) {
$bg_clr_box = "bg_pink_dark";
} else if ($bg_clr == 4) {
$bg_clr_box = "bg_red_dark";
} else if ($bg_clr == 5) {
$bg_clr_box = "bg_color_2";
} else if ($bg_clr == 6) {
$bg_clr_box = "bg_color_1";
}

	

//$g = new _spgroup;
//GET GROP BANNER, GROP DESCRIPTION 
$result2 = $g->groupdetailspublic($row['idspGroup']);
if ($result2 != false) {
	// print_r($result2);
	// die('xxxxxx');
$row2 = mysqli_fetch_assoc($result2);
$gname = $row2["spGroupName"];
$gtag = $row2["spGroupTag"];
$gdes = $row2["spGroupAbout"];
$gtype = $row2["spgroupflag"];
$gcategory = $row2["spgroupCategory"];
$glocation = $row2["spgroupLocation"];
$gimage = $row2["spgroupimage"];
// print_r($row2);
// die('----');


}
//GET ADMIN  NAME OR IMAGE
//$p = new _spgroup; //Admin will come on top
$rpvt = $g->members($row['idspGroup']);
//echo $g->ta->sql;
if ($rpvt != false) {
while ($row3 = mysqli_fetch_assoc($rpvt)) {
if ($row3['spUser_idspUser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
if ($row3['spProfileIsAdmin'] == 0) {
$spProfilePic = $row3['spProfilePic'];
$Group_Admin_Name = $row3['spProfileName'];
}
}
}
if ($account_status != 1) {

?>
<div class="list-item">
<div class="col-md-4 no-padding" style=" border-style: groove; background-color: white;">
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline">
<div class="main_grop_box <?php echo $bg_clr_box; ?>" style="min-height: 215px!important;">
<?php

if ($gimage == "") { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp" class="img-responsive group_banner" alt="" style="height:160px;" /><?php
} else { ?>
<img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>" class="img-responsive group_banner" alt="" style="height:160px;" /><?php
}

if ($spProfilePic != "") { ?>
<img src="<?php echo ($spProfilePic); ?>" class="img-circle group_create" alt="" style="top:145px;" /> <?php
} else { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png" class="img-circle group_create" alt="" style="top:145px;" /> <?php
} ?>
<div style=" background-color:white;">
<!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->

<!--	<h4 class="textblack"><?php //echo ucfirst($Group_Admin_Name); 
?></h4> -->
<style>
#group {
width: 100px;
overflow: hidden;
display: inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
</style>
<h2 style="color: black;margin-top: 5px;"><span class="smalldot" id="group" style="text-overflow:hidden;"><?php echo ucwords(strtolower($row['spGroupName'])); ?></span>
<br>
<span>(
<?php
//  $gcate = ($row['spgroupCategory']); 
$gcate = $g->read_category($row['spgroupCategory']);
//echo $g->ta->sql;
if ($gcate != false) {
while ($groupcate = mysqli_fetch_assoc($gcate)) {
echo $groupcate['group_category_name'];
}
}

?> )
</span>
</h2>
<span>

<?php if ($row['spgroupflag'] == 1) {
echo '<h6 style="color:black;"><i class="fa fa-lock"></i> Private Group</h6>';
} else {
echo '<h6 style="color:black;"><i class="fa fa-globe"></i> Public Group</h6>';
} ?></span>
<?php
//count member old and new
$result3 = $g->joinedMembersOfGroup($row['idspGroup']);

$total_member = $result3->num_rows;
//print_r($total_member);

$result4 = $g->newgrpmember($row['idspGroup']);
//echo $g->tad->sql;
//var_dump($result4);
if (!empty($result4)) {

$new_tot_member = $result4->num_rows;
} else {
$new_tot_member = 0;
}

?>
<div>
<h6 style="text-align:right; padding:9px;margin-bottom:-30px;color:black;"><?php echo $total_member; ?> members</h6>

<span class="btn pull-left btn btnPosting db_btn db_primarybtn" style="top:50px;margin-bottom:5px;text-align:left"><img src="<?php echo $BaseUrl; ?>" class="img-responsive" alt="" />Timeline</span>
</div>
</div>



</div>
</a>
</div>
</div>
<?php 

}
if ($bg_clr < 6) {
//die('==hhhhhhhh==');
$bg_clr++;
} else {
$bg_clr = 1;
}

}
} else {

if (isset($txtTitle)) { ?>
<div style='padding: 20px 0px 0px 8px;font-size: 16px;color:red;'>
Search results for "<?php echo $txtTitle; ?>" not found.</div>
<?php } elseif (isset($txtCategory)) { ?>
<div style='padding: 20px 0px 0px 8px;font-size: 16px;color:red;'>
Search results for "<?php echo $txtCategory; ?>" not found.</div>

<?php } else { ?>

<div style='padding: 20px 0px 0px 8px;font-size: 16px;color:red;'>
Search results not found.</div>
<?php  }

?>

<?php }
?>
<!--  </div> -->
<div class="space"></div>
<div class="space-md"></div>

</div>
<div id="pagination-container"></div>
</div>
</div>
</div>






</div>
</section>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>
<?php
} ?>

<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js'></script>
<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 6;

    items.slice(perPage).hide();
	if(perPage>numItems){
		$('#pagination-container').hide();
	}else{
		$('#pagination-container').show();
	}

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });</script>
