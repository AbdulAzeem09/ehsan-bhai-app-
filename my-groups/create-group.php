<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../univ/baseurl.php');
// $dbHost  =   'localhost';
// $dbUser     =   'osspdev';
// $dbPass     =   'Office@256';
// $dbName     =   'thesharepage';
include('../univ/main.php');
$dbConn = mysqli_connect(DOMAIN, UNAME, PASS, DBNAME);
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}

?>
<?php

// $countryId = $_POST['countryId'];
// // print_r ($countryId);
// // die('kjhghjk');
// $stateId = $_POST['state'];

/*   include '../connection/conn.php';
*/ include('../univ/baseurl.php');

session_start();

// print_r($_SESSION);
// die();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "my-groups/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

// ===========get ip and then get location
$ip = $_SERVER['REMOTE_ADDR']; // your ip address here

$que_rec = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
if ($que_rec && $que_rec['status'] == 'success') {
$currentLoc = $que_rec['city'];
} else {
$currentLoc = "";
}


?>
<style>
#exp1:hover {
color: #0e0c0c !important;
opacity: .8;
}

#exp2:hover {
color: #0e0c0c !important;
opacity: .8;
}

.aaa:hover {
color: #fff !important;
opacity: .8;
}

.btn-danger:hover {

background-color: #ab4b48 !important;

}

/* textarea {
resize: none;
} */

.left_grid ul li a {
margin-top: 0px !important;
}

.mr-30 {
margin-top: 11px !important;
margin-right: 28px !important;
}

.left_create h4 a {
font-size: 16px !important;
}

.left_create h4 {
text-transform: none !important;
}

#car1 {
margin-top: 10px !important;
}
</style>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<!--This script for posting timeline data End-->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css">

</head>

<body class="bg_gray">
<?php include('../header.php'); ?>


<style>
.inner_top_form button {
	padding:9px 12px!important;
}
	
			</style>
<section class="create_grp_top bg_white">
<div class="container ">
<div class="row">
<div class="col-md-2">
<div class="dropdown pull-right" id="trans_drop">
<button class="btn  dropdown-toggle" id="exp2" type="button" data-toggle="dropdown">My Groups <span>(All)</span>
<span class="caret"></span></button>
</div>
</div>

<div class="col-md-8"></div>
<div class="col-md-2">
<div class="dropdown" id="trans_drop">
<button class="btn  dropdown-toggle" id="exp1" type="button" data-toggle="dropdown">Explore <span>(All)</span>
<span class="caret"></span></button>

</div>
</div>
</div>
</div>
</section>


<div class="container m_top_20">
<div class="row">
<div class="col-md-3">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<div class="w-100">
<?php
$g = new _spgroup;
//$result = $g->groupmember_new($_SESSION['pid']);
$result = $g->profilegroupmember11($_SESSION['pid']);

if ($result != false) {
$totaldat = mysqli_num_rows($result);

?>
<div class="topstatus timeline-topstatus right_sidebar">
<div class="left_grid left_group_gray">

<ul id="myList"><?php

while ($row = mysqli_fetch_assoc($result)) {
?>
<li>
<div class="left_create row groupdiv_<?php echo $row['idspGroup']; ?>">

<div class="left_img_create">
<?php

$result2 = $g->groupdetails($row['idspGroup']);
// $row2 = mysqli_fetch_assoc($result2);  
if ($result2 != false) {
$row2 = mysqli_fetch_assoc($result2);
$con = mysqli_connect(DOMAIN, UNAME, PASS);
if (!$con) {
die('Not Connected To Server');
}
//Connection to database
if (!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}

//$query1 = mysqli_query($con,"SELECT* FROM spGroup WHERE id = '".$row2['idspGroup']."'");

//$Category_img = mysqli_fetch_assoc($query1);
//$catimg = $Category_img['group_category_icon'];
/*print_r($Category_img);*/

/*  /upload/content/group_c/*/
$gimage = $row2["spgroupimage"];
}

if ($gimage == "") { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg" style="margin-left: 10px;" class="img-circle main_grp_img" alt="" /><?php
} else { ?>
<img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>" style="margin-left: 10px;" class="img-circle main_grp_img" alt="" />
<?php } ?>
</div>
<h4 style="margin-left: 10px;">
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline&page=1" data-toggle="tooltip" title="<?php echo $row["spGroupName"]; ?>">
<?php
if (strlen($row["spGroupName"]) > 12) {
echo $string = substr($row["spGroupName"], 0, 12) . '...';
} else {
echo $row["spGroupName"];
} ?>
</a>
<input type="hidden" id="post_id" value="<?php echo $row['idspGroup'] ?>">

<div class="dropdown">
<button class="btn dropdown-toggle pull-right  bg-white" type="button" id="menu1" data-toggle="dropdown" style="margin: -25px 5px 0px 0px;">
<span><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/cog.png" class="img-responsive" alt=""></span>
</button>
<ul class="dropdown-menu pull-right mr-30" role="menu" aria-labelledby="menu1">
<!--<li role="presentation" class="<?php if ($row['spgroupflag'] == 1) {
echo "active_drp";
} ?>"><a role="menuitem" class="Group_status"  data-id="1" href="#"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Private</a></li>-->

<li role="presentation" class="<?php if ($row['spgroupflag'] == 1) {
echo "active_drp";
} ?>" style="margin-left: 0px; margin-top: 5px; margin-bottom: -5px;">
<a style="margin-left: -5px;    padding-top: 5px;" role="menuitem" class="Group_status_private" data-id="<?php echo $row['idspGroup']; ?>" href="javascript:void(0);">
<i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Private</a>
</li>


<!--<li role="presentation" class="<?php if ($row['spgroupflag'] == 0) {
echo "active_drp";
} ?>"><a role="menuitem" class="Group_status"  data-id="0" href="#"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Public</a></li>-->

<li style="margin-left: 0px;" role="presentation" class="<?php if ($row['spgroupflag'] == 0) {
echo "active_drp";
} ?>"><a style="margin-left: -5px;" role="menuitem" class="Group_status_public" data-id="<?php echo $row['idspGroup']; ?>" href="javascript:void(0);"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Public</a></li>



<!--<li role="presentation" ><a role="menuitem" data-id="<?php echo $row['idspGroup']; ?>" href="#" class="Group_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a></li>-->

<li style="margin-left: 0px;" role="presentation"><a style="margin-left: -5px;" role="menuitem" data-id="<?php echo $row['idspGroup']; ?>" href="javascript:void(0);" class="Group_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a></li>

</ul>

</div>
</h4>

<?php
if ($row['spgroupflag'] == 1) {
echo '<h6 style="margin-left: 65px;"><i class="fa fa-lock"></i> Private</h6>';
} else {
echo '<h6 style="margin-left: 65px;"><i class="fa fa-globe"></i> Public</h6>';
}
?>


</div>

</li>
<?php
} ?>
</ul>
<?php if ($totaldat > 3) { ?>
<div id="loadMore">Load more</div>
<div id="showLess">Show less</div>
<?php }

?>


</div>


</div>
<?php
}
?>
</div>

</div>
<div class="col-md-6">
<div class="mid_creat_form bg-white bradius-15">
<h4 class="bg-white bradius-15" style="padding:18px 0px 0px 22px !important;">
<i class="fa fa-pencil"></i>
Create New Group
</h4>
<div class="bg_white form_grp bradius-15">
<p>Groups are great for getting things done and staying in touch with just the people you want. Share photos and videos, have conversations, make plans and more.</p>
<div class="row groupfield">
<form class="creaate_new_grp" action="../post-ad/addgroup.php" method="post" enctype="multipart/form-data" id=" sp-add-group" onsubmit="return  spUserRegister()">
<input class="dynamic-pid" type="hidden" id="myprofileid" name="pid_" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" id="CreatedDate" name="CreatedDate" value="<?php echo date("Y-m-d"); ?>">
<input id="spProfileTypes_idspProfileTypes" type="hidden" value="<?php echo $_SESSION['ptid']; ?>">
<input id="userid" type="hidden" value="<?php echo $_SESSION['uid']; ?>" value="1">
<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8">
<label for="email">Name Your Group (Max 25 Character allowed )</label><span class="red">*</span>
<input type="text" id="spGroupName" name="spGroupName" onkeyup="clearerror();" maxlength="25"  class="form-control bradius-10" required / >
<span id="title_error" class="red"></span>
</div>
<div class="col-md-2"></div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8">
<label for="email">Group Category</label><span class="red">*</span>
<select class="form-control bradius-10" onclick="clearerror();" id="grpcategory" name="spgroupCategory" required>
<option value="">Select Category </option>
<?php
$sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ORDER BY group_category_name asc";
$result = mysqli_query($dbConn, $sql);
while ($rows = mysqli_fetch_assoc($result)) {
?>
<option value='<?php echo $rows["id"]; ?>'><?php echo $rows["group_category_name"]; ?></option>
<?php
}
?>
</select>

<span id="cat_error" class="red"></span>
</div>
<div class="col-md-2"></div>
</div>

<!-- Country -->
<!-- <input type="hidden" name="profile_Id" value="<?php //echo $_SESSION['pid']; 
?>">
<input type="hidden" name="user_Id" value="<?php //echo $_SESSION['uid']; 
?>"> -->



<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8 ">
<label for="spProfilesCountry">Country<span class="red">*</span></label>
<select id="spUserCountry" class="form-control bradius-10 " name="spUserCountry" required>
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id']) ? 'selected' : ''; ?>>
<?php echo $row3['country_title']; ?>
</option>
<?php
}
}
?>
</select>
<span id="shippcounrty_error" style="color:red;"></span>
</div>
</div>

<div class="row">

<div class="col-md-2"></div>
<div class="form-group col-md-8">
<div class="loadUserState">
<label for="spUserState">State<span class="red">*</span></label>
<select id="spUserState" class="form-control bradius-10 " style="bradius-10" name="spUserState" required>
<option value="">Select State</option>

<?php

// die('jkhgdsjkfh');
if (isset($userstate) && $userstate > 0) {

$pr = new _state;
$result2 = $pr->readState($usercountry);

if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
}
?>
</select>
<span id="shippstate_error" style="color:red;"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8">
<div class="loadCity">
<label for="spUserCity">City</span></label>
<!--<input type="text" class="form-control" name="city" id="shipp_city">-->
<select class="form-control bradius-10 " style="bradius-10" name="spUserCity" id="spUserCity" required>
<option value="0">Select City</option>
<?php
if (isset($usercity) && $usercity > 0) {
$co = new _city;
$result3 = $co->readCity($userstate);
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
}
}
}
	?>
</select>
<span id="shippcity_error" style="color:red;"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8">
<label for="shipp_zipcode">Zipcode (Max 10 character allowed)</label><span class="red">*</span><span id="span1" style="color:red"></span>
<input type="text" id="shipp_zipcode" name="zipcode" placeholder=" zipcode" class="form-control bradius-10" minlength="4" maxlength="6" required />
<span id="shippzipcode_error" class="red"></span>
</div>
<div class="col-md-2"></div>
</div>

<div class="row">
<div class="col-md-2"></div>
<div class="col-md-2"></div>
</div>

<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8">
<label for="banner">Upload Banner</label>
<input type="file" style="display: block;" id="banner" name="banner" class="form-control bradius-10" placeholder="Upload banner" required>
<span id="banner_error" class="red"></span>
</div>
<div class="col-md-2"></div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8 bradius-10">
<label for="email">Select Privacy</label><span class="red">*</span>
<div class="form-control bg_gray_light no-radius bradius-10">
<div class="row">
<div class="col-md-5">
<label class="radio-inline"><input type="radio" id="spgroupflag" onclick="clearerror(this.value);" name="spgroupflag" class="groupflag" value="0" required>Public</label>
</div>
<div class="col-md-5 pull-left">
<label class="radio-inline"><input type="radio" id="spgroupflag" onclick="clearerror(this.value);" name="spgroupflag" class="groupflag" value="1" required>Private</label>
</div>
</div>
</div>
<span id="privacy_error" class="red"></span>

</div>
</div>
<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8">
<label for="shipp_address">Short Description (Max 50 characters)</label><span class="red">*</span>
<input type="text" id="spGroupTagline" name="spGroupTagline" maxlength="50" class="form-control bradius-10" required>
<span id="short_error" class="red"></span>
</div>
<div class="col-md-2"></div>
</div>




<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8 bradius-12 ">
<label for=" ">Describe what your group is about (max 500 chars)</label>
<textarea id="spGroupAbout" name="spGroupAbout" maxlength="500" rows="10" cols="10" onkeyup="clearerror();" class="form-control bradius-10"></textarea>

<!-- <input type="text" name="group"> -->
<!--  <div class="form-control bg_gray_light no-radius bradius-10">
<span class="red"> *</span>
<div class="col-md-2"></div> -->
<!-- </div>  -->
</div>
<!-- <div class="col-md-3"></div> -->
</div>

<!--shashi start--->
<div class="row">
<div class="col-md-2"></div>
<div class="form-group col-md-8 bradius-12 ">
<label for="">Address</label>
<input type="text"  name="address" id="address" class="form-control"/><br/>
<span id="short_error1" class="red"></span>
</div>
</div>
<!--shashi end--->



<div class="row">
<div class="col-md-3"></div>
<div class="form-group col-md-3">
<a href="<?php echo $BaseUrl; ?>/my-groups">
<button type="button" id="spgroupSubmit1" class="btn btnPosting db_btn btn-danger btn-create-form  aaa float-right btn-border-radius">Close</button>
</a>
</div>
<div class="form-group col-md-3">
<button type="button" id="spgroupSubmit" class="btn btnPosting db_btn db_primarybtn btn-create-form float-right btn-border-radius" style="margin-top:0px!important;">Create</button>
</div>

<div class="col-md-3"></div>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="col-md-3">

<!-- <div class="row">
<div class="topstatus timeline-topstatus right_sidebar">
<div class="left_grid left_group_gray">
<?php
$g = new _spgroup;
$result = $g->groupmember($_SESSION['uid']);
//echo $g->ta->sql;
if ($result != false) {
while ($row = mysqli_fetch_assoc($result)) { ?>
<div class="left_create row groupdiv_<?php echo $row['idspGroup']; ?>">
<div class="left_img_create">
<?php
$result2 = $g->groupdetails($row['idspGroup']);
if ($result2 != false) {
$row2 = mysqli_fetch_assoc($result2);
$gimage = $row2["spgroupimage"];
}
if ($gimage == "") { ?>

<img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_main_banner.jpg" class="img-circle main_grp_img" alt="" /><?php
} else { ?>
<img src="<?php echo ($gimage); ?>" class="img-circle main_grp_img" alt="" /><?php
}
?>
</div>
<h4>
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline" data-toggle="tooltip" title="<?php echo $row["spGroupName"]; ?>">
<?php
if (strlen($row["spGroupName"]) > 12) {
echo $string = substr($row["spGroupName"], 0, 12) . '...';
} else {
echo $row["spGroupName"];
} ?>
</a>
<input type="hidden" id="post_id" value="<?php echo $row['idspGroup'] ?>">
<div class="dropdown">
<button class="btn dropdown-toggle pull-right  bg-white" type="button" id="menu1" data-toggle="dropdown"   style="margin: -25px 5px 0px 0px;">
<span  ><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/cog.png" class="img-responsive"  alt=""></span>
</button>
<ul class="dropdown-menu pull-right mr-30" role="menu" aria-labelledby="menu1">
<li role="presentation" class="<?php if ($row['spgroupflag'] == 1) {
echo "active_drp";
} ?>"><a role="menuitem" class="Group_status"  data-id="1" href="#"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Private</a></li>
<li role="presentation" class="<?php if ($row['spgroupflag'] != 1) {
echo "active_drp";
} ?>"><a role="menuitem" class="Group_status"  data-id="0" href="#"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Public</a></li>
<li role="presentation" ><a role="menuitem" data-id="<?php echo $row['idspGroup']; ?>" href="#" class="Group_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a></li>

</ul>
</div>
</h4>
<h5>10+ unread Post</h5>
<?php
if ($row['spgroupflag'] == 1) {
echo '<h6><i class="fa fa-lock"></i> Private</h6>';
} else {
echo '<h6><i class="fa fa-globe"></i> Public</h6>';
}
?>
</div>
<?php
}
}
?>
</div>
</div> -->
<div class="right_create join_timeline_main  right_sidebar_group">
<?php
$notgrp = new _spgroup;
$result = $notgrp->notgroupmember($_SESSION['uid']);
//echo $notgrp->ta->sql;
if ($result != false) {

while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
?>
<div class="explore_box row">
<div class="righ_img">

<?php

$result2 = $g->groupdetails($row['idspGroup']);

if ($result2 != false) {


$row2 = mysqli_fetch_assoc($result2);
//print_r($row2);

$con = mysqli_connect(DOMAIN, UNAME, PASS);

if (!$con) {

die('Not Connected To Server');
}

//Connection to database
if (!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}



$query1 = mysqli_query($con, "SELECT group_category_icon FROM group_category WHERE group_category_name = '" . $row2['spgroupCategory'] . "'");


$Category_img = mysqli_fetch_assoc($query1);

$catimg = $Category_img['group_category_icon'];
// echo $catimg;

$gimage = $row2["spgroupimage"];


}



if ($catimg != false) { ?>
<img src="<?php echo $BaseUrl; ?>/upload/content/group_c/<?php echo $catimg; ?>" class="img-circle main_grp_img" alt="" /><?php
} elseif($gimage) {  ?>

<img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>" class="img-circle main_grp_img" alt="" /><?php

}
else{ ?>
	<img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png" class="img-circle main_grp_img" alt="" />
 <?php }
?>

</div>


<button class="join_timeline btn view_right_joinbtn btn-border-radius" data-pid="<?php echo $_SESSION['pid'] ?>" data-gid="<?php echo $row['idspGroup'] ?>" id="addmemontimeline"> Join </button>

<h3>
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline" data-toggle="tooltip" title="<?php echo $row["spGroupName"]; ?>">
<?php
if (strlen($row["spGroupName"]) > 12) {
echo $string = substr($row["spGroupName"], 0, 12) . '...';
} else {
echo $row["spGroupName"];
} ?>
</a>
</h3>
<?php
if ($row['spgroupflag'] == 1) {
echo '<h6 style="margin-left: 65px;"><i class="fa fa-lock"></i> Private</h6>';
} else {
echo '<h6 style="margin-left: 65px;"><i class="fa fa-globe"></i> Public</h6>';
}
?>

</div> <?php
}
}

?>

<div class="text-center right_show_all">
<a href="<?php echo  $BaseUrl; ?>/my-groups/" class="">Show All</a>
</div>
</div>
</div>
</div>
</div>


<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>
<?php
} ?>
<style>
#myList li {
display: none;
}

#loadMore {
color: green;
cursor: pointer;
}

#loadMore:hover {
color: black;
}

#showLess {
color: red;
cursor: pointer;
}
.btn:hover {
	color: #fff!important;
}

#showLess:hover {
color: black;
}
</style>
<script>
$(document).ready(function() {
$("#spgroupSubmit").click(function() {
//alert('==');
var name = $('#spGroupName').val();
var category = $('#grpcategory').val();
var country = $('#spUserCountry').val();
var state = $('#spUserState').val();
var city = $('#spUserCity').val();
var zipcode = $('#shipp_zipcode').val();
var privacy = $("input[name=spgroupflag]:checked").val();
var sort_des = $('#spGroupTagline').val();
var about_group = $('#spGroupAbout').val();
var address = $('#address').val();

if ((name == '') || (category == '') || (country == '') || (state == '') || (city == '') || (zipcode == '') || (sort_des == '') || (address == '')) {


if (name == '') {
$('#title_error').html('Field is required');
} else {
$('#title_error').html('');

}
if (category == '') {
$('#cat_error').html('Field is required');
} else {
$('#cat_error').html('');

}
if (country == '') {
$('#shippcounrty_error').html('Field is required');
} else {
$('#shippcounrty_error').html('');

}
if (state == '') {
$('#shippstate_error').html('Field is required');
} else {
$('#shippstate_error').html('');

}
if (city == '') {
$('#shippcity_error').html('Field is required');
} else {
$('#shippcity_error').html('');

}
if (zipcode == '') {
$('#shippzipcode_error').html('Field is required');
} else {
$('#shippzipcode_error').html('');

}

if (sort_des == '') {
$('#short_error').html('Field is required');
} else {
$('#short_error').html('');

}

if (address == '') {
$('#short_error1').html('Field is required');
} else {
$('#short_error1').html('');

}

return false;

}
var formData = new FormData();
formData.append('spgroupimage', $('#banner')[0].files[0]);
formData.append('spGroupName', name);
formData.append('spgroupCategory', category);
formData.append('spUserCountry', country);
formData.append('spUserState', state);
formData.append('spUserCity', city);
formData.append('zipcode', zipcode);
formData.append('spgroupstatus', privacy);
formData.append('spGroupTagline', sort_des);
formData.append('spGroupAbout', about_group);

$.ajax({
type: "POST",
url: '../post-ad/addgroup.php',
data: formData,
processData: false, // tell jQuery not to process the data
contentType: false,
success: function(response) {
var res=response.trim();
//alert(res);
window.location ="<?php echo $BaseUrl;?>"+res;
}
});



});
});
</script>




<script>
$(document).ready(function() {
$('select#spUserCountry').attr('required', 1);
$('select#grpcategory').attr('required', 1);
$('select#spUserState').attr('required', 1);
//$('select#spUserCity').attr('required',1);

});
</script>




<script>
function spUserRegister() {

var dd = $('#shipp_zipcode').val().length;


if (dd == 6 || dd == 4) {
return true;
} else {
return false;
}

}
$(document).ready(function() {
$("#shipp_zipcode").on("change", function() {
var dd = $('#shipp_zipcode').val().length;

 

if (dd < 4) {
 
$('#span1').html('minimun 4 - 6 digit');
} else {
$('#span1').html('');
}


});
});

$(document).ready(function() {
var size_li = $("#myList li").size();
var x = 28;
$('#myList li:lt(' + x + ')').show();
$('#loadMore').click(function() {
x = (x + 25 <= size_li) ? x + 25 : size_li;
$('#myList li:lt(' + x + ')').show();
});
$('#showLess').click(function() {
x = (x - 25 < 0) ? 27 : x - 25;
$('#myList li').not(':lt(' + x + ')').hide();
});
});

$(function() {

});



/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction(id) {


document.getElementById("myDropdown" + id).classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
for (i = 0; i < dropdowns.length; i++) {
var openDropdown = dropdowns[i];
if (openDropdown.classList.contains('show')) {
//openDropdown.classList.remove('show');
}
}
}
}
</script>

<script type="text/javascript">
function clearerror() {
var spGroupName = $("#spGroupName").val();
// var grpcategory = $("#grpcategory").val();
var spgroupflag = $("#spgroupflag").val();
var banner = $("#banner").val();
if (banner) {
var file = $("#banner")[0].files[0];
var fileType = file.type.split('/')[0];
        
if (fileType !== 'image') {
  $("#banner_error").text("Please upload only image files.");
     return false;
  } else {
      $("#banner_error").text("");
         return true;
    }
}
//  var spGroupTagline = $("#spGroupTagline").val();
//  var spGroupAbout = $("#spGroupAbout").val();
var locationcity = $("#locationcity").val();
/*  var flag=0;
if (spGroupName!="")
{
var strArr = new Array();
strArr = spGroupName.split("");

if(strArr[0]==" ") // this is the the key part. you can do whatever you want here!
{
flag=1;
}


}*/


/*
var flag2=0;

if (spGroupTagline!="")
{
var strArr1 = new Array();
strArr = spGroupTagline.split("");

if(strArr1[0]==" ")
{
flag2=1;
}


}


var flag3=0;

if (spGroupAbout!="")
{
var strArr2 = new Array();
strArr2 = spGroupAbout.split("");

if(strArr2[0]==" ")
{
flag3=1;
}


}
*/


/*   var flag4=0;

if (locationcity!="")
{
var strArr4 = new Array();
strArr4 = locationcity.split("");

if(strArr4[0]==" ") // this is the the key part. you can do whatever you want here!
{
flag4=1;
}


}*/



/* if(spGroupName != "" && flag == 1 ){

$("#title_error").text("Space not allowed.");
}else if(spGroupName != "" && flag != 1){
$("#title_error").text("");
}*/

/*
if(spGroupTagline!= "" &&  flag2 == 1){
$("#sdesc_error").text("Space not allowed.");
}else if(spGroupTagline!= "" &&  flag2 != 1){
$("#sdesc_error").text("");
}


if(spGroupAbout!= "" &&  flag3 == 1){
$("#desc_error").text("Space not allowed.");
}else if(spGroupAbout!= "" &&  flag3 != 1){
$("#desc_error").text("");
}
*/

/*  if(locationcity!= "" &&  flag4 == 1){
$("#city_error").text("Space not allowed.");
}else if(spGroupAbout!= "" &&  flag3 != 1){
$("#desc_error").text("");
}*/

/*
if(grpcategory != "0"){

$("#cat_error").text("");
}
*/
if (locationcity != "") {

$("#city_error").text("");
}
if (spgroupflag != "") {

$("#privacy_error").text("");
}

/*
if(spGroupTagline != ""){

$("#sdesc_error").text("");
}
if(spGroupAbout != ""){

$("#desc_error").text("");
}
*/



}
</script>


<script type="text/javascript">
$("#file-1").change(function() {

var val = $(this).val();

switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
case 'gif':
case 'jpg':
case 'png':
$("#banner_error").text("")
break;
default:
$(this).val('');
// error message here
/*alert("not an image");*/
$("#banner_error").text("Please select Image only.")
break;
}
});

/*$(function () {
$('span').click(function () {
$('#datalist p:hidden').slice(0, 5).show();
if ($('#datalist p').length == $('#datalist p:visible').length) {
$('span ').hide();
}
});
});*/
</script>

<script type="text/javascript">
$(".Group_delete").on("click", function() {
var groupid = $(this).attr("data-id");

/* alert(groupid);*/

var flag = 1;
swal({
title: "Are you sure to delete?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
$.get("../my-groups/deletegroup.php", {
groupid: groupid
}, function(data) {
//console.log(data);
window.location = '../my-groups';

});
$(".groupdiv_" + groupid).html("");

}
});
});

$(".Group_status_private").on("click", function() {  
var groupid = $(this).attr("data-id");
var type = 1;
/*alert(groupid);*/
/* alert(postid);*/
var flag = 1;
swal({
title: "Are you sure to make this group private?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
$.get("../my-groups/updategrouptype.php", {
groupid: groupid,
type: type
}, function(data) {
//console.log(data);
window.location.reload();
});
$(".groupdiv_" + groupid).html("");
/* $(".groupdiv_"+postid).removeClass('searchable');
$(".deldiv_"+postid).removeClass('post_timeline');*/
}
});
});


$(".Group_status_public").on("click", function() {
var groupid = $(this).attr("data-id");
var type = 0;
/*alert(groupid);*/
/* alert(postid);*/
var flag = 1;
swal({
title: "Are you sure to make this group public?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
$.get("../my-groups/updategrouptype.php", {
groupid: groupid,
type: type
}, function(data) {
//console.log(data);
window.location.reload();
});
$(".groupdiv_" + groupid).html("");
/* $(".groupdiv_"+postid).removeClass('searchable');
$(".deldiv_"+postid).removeClass('post_timeline');*/
}
});
});

function popp() {
$("#edit_group").click();
}
/*
$("#event-pr").hover(function() {
alert("here");
("#event-child").toggleClass("eve-hd");
});
*/
/*
$(document).ready(function () {
$("#spgroupSubmit").click(function () {
$("#span4").show();
setTimeout(function () {
$('#span4').hide();
}, 1500);


});
});*/


$(document).ready(function(){
  // Initialize select2
  $("#SelExample").select2();
  $("#SelExample").select2("val", "4");
$('#SelExample option:selected').text('Vizag');
  
});

</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
$(document).ready(function(){
  // Initialize select2
  $("#grpcategory").select2();
  $("#grpcategory").select2("val", "4");
$('#grpcategory option:selected').text('Vizag');
  
});

</script>
<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
  document.getElementById("banner").addEventListener("change", function() {
    var file = this.files[0];
    // Check if file is selected
    if (file) {
      var fileName = file.name;
      var fileExtension = fileName.split('.').pop().toLowerCase();
      var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif'];
      if (!allowedExtensions.includes(fileExtension)) {
        document.getElementById("banner_error").innerHTML = "Please select a valid image file.";
        this.value = '';
        return;
      } else {
        document.getElementById("banner_error").innerHTML = "";
      }
    }
  });
});
</script>

