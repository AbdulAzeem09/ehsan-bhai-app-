<?php
include('../../univ/baseurl.php');
session_start();
include '../../common.php';
//print_r($_SESSION);die;
if (!isset($_SESSION['pid'])) {

$_SESSION['afterlogin'] = "freelancer/";
include_once("../../authentication/islogin.php");
} else {

function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$_GET["module"] = "5";
$_GET["categoryid"] = "5";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "Freelancers";
//include "../index.php";
if (isset($_GET['postid'])) {
}

//$f = new _spprofiles;
$re = new _redirect;




// if ($_SESSION['ptid'] == 1) {


// $f = new _spuser;
// $fil = $f->read1($_SESSION['pid']);
// //print_r($fil);die("================");
// if ($fil) {
// $r = mysqli_fetch_assoc($fil);
// //print_r($r); die("-----------------"); 
// $pid = $r['sp_pid'];
// //echo $pid;die('====');
// if ($r['status'] != 2) {
// header("Location: $BaseUrl/freelancer/dashboard?msg=notverified");
// }
// } else {
// header("Location: $BaseUrl/freelancer/dashboard?msg=notverified");
// }
// }

$u = new _spuser;
	$spuserres = $u->read($_SESSION["uid"]);
	
	if($spuserres != false)
	{
      	$ruser = mysqli_fetch_assoc($spuserres);
		$username = $ruser["spUserName"]; 
		$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 
		$useremail = $ruser["spUserEmail"]; 
		$useraddress = $ruser["spUserAddress"];
		$phone_status = $row['phone_status'];
	    $email_status = $row['email_status'];
		
		if (is_null($usercountry) || empty($usercountry)) {
			$usercountry = $ruser["spUserCountry"];
		}
		if (is_null($userstate) || empty($userstate)) {
			$userstate = $ruser["spUserState"];
		}
		if (is_null($usercity) || empty($usercity)) {
			$usercity = $ruser["spUserCity"];
		}
		if (is_null($address_city) || empty($address_city)) {
			$address_city = $ruser["address"];
		}
	}

if ($_SESSION['ptid'] == 1) {

$f = new _spuser;
$fil = $f->read1($_SESSION['pid']);
//print_r($fil);die;
if ($fil) {
$r = mysqli_fetch_assoc($fil);
//print_r($r);
$pid = $r['sp_pid'];
//echo $pid;die('====');
if ($r['status'] != 2) {

header("Location: $BaseUrl/freelancer/dashboard/poster_dashboard.php?msg=notverified");
}
}
}




if ($_SESSION['ptid'] == 4) {


if (empty($_GET['postid'])) {
//	if(($final_date >= 90) ){ 

$mb = new _spmembership;
$result = $mb->readpid($_SESSION['pid']);
if ($result != false) {

while ($rows = mysqli_fetch_assoc($result)) {
//print_r($rows);
$payment_date = $rows["createdon"];
$duration = $rows['duration'];

/*$res = $mb->readmember($rows["membership_id"]);
if($res != false)
{ 
$row = mysqli_fetch_assoc($res);
//echo $row["spMembershipName"]."<br>";
//$count=$row["spMembershipPostlimit"]; 
$duration=$row["duration"];*/

//print_r($row);
$date7 =  date('Y-m-d H:i:s');
$date8 = date('Y-m-d', strtotime($date7));
$date5 = date('Y-m-d', strtotime($payment_date));
$date6 = date('Y-m-d', strtotime($payment_date . ' +' . $duration . ' days'));
//echo  $date5."<br>".$date6."<br>".$date8; die;
if (!(($date5 <= $date8)  && ($date6 >=  $date8))) { ?>
<script>
// alert('eeeeeee');
// window.location.replace("/membership?msg=notaccess");
</script>

<?php
}
//}
}
} else {

$mb = new _spmembership;
$result_1 = $mb->read_data($_SESSION['pid']);
$num = 0;
if ($result_1) {
$num = mysqli_num_rows($result_1);
}

if ($num >= 2) {


// $fr= new _spuser;
// $readsp= $fr->readdataSp($_SESSION['pid']);
// if($readsp!=false){
// $rowsp=mysqli_fetch_assoc($readsp);
//   $post_pay =$rowsp['post_pay'];
//   $pidAdd =$rowsp['idspProfiles'];

// }
// if ($post_pay <= 0) {

?>


<script>
window.location.replace("/membership?msg=notaccess");
</script>
<?php
// }
}
}
//	}



}
}



if (isset($_GET["postid"])) {
//$p = new _postingview;
$sf  = new _freelancerposting;

// $r = $p->read($_GET["postid"]);

$r = $sf->read1($_GET["postid"]);
$cp = $r->num_rows;
if ($cp == false) {

header("Location: $BaseUrl/freelancer/dashboard/poster_dashboard.php?msg=notacess");
}

//    echo $sf->ta->sql;


if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {


/*print_r($row);*/
//echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
$spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];

if ($_SESSION['pid'] != $spProfiles_idspProfiles) {
//die('====2');
header("Location: $BaseUrl/freelancer/dashboard/poster_dashboard.php?msg=notacess");
}
}
}
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">


<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="The SharePage">


<title>The SharePage</title>

<!-- Design.css -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<link rel="stylesheet" type="text/css" href="https://dev.thesharepage.com/assets/css/style.css">
<link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">
<!--Bootstrap core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<!--Font awesome core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<!--custom css jis ki wja say issue ho rha tha form submit main-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/freelance.js"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>
<!-- DATE AND TIME PICKER -->
<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<!--post group button on btm of the form-->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">


<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- skills added typehead -->
<link href="<?php echo $BaseUrl; ?>/assets/css/token_field/tokenfield-typeahead.css" type="text/css" rel="stylesheet">
<link href="<?php echo $BaseUrl; ?>/assets/css/token_field/bootstrap-tokenfield.css" type="text/css" rel="stylesheet">
<?php
 $urlCustomCss = $BaseUrl . '/component/custom.css.php';
 include $urlCustomCss;
?>
<script>
function numericFilter(txb) {
txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>

<style type="text/css">
.btn.active.focus,
.btn.active:focus,
.btn.focus,
.btn:active.focus,
.btn:active:focus,
.btn:focus {
outline: 0px auto -webkit-focus-ring-color;
outline-offset: -2px;
}

.btn:focus {
outline: 0px auto -webkit-focus-ring-color;
outline-offset: -2px;
color: #fff;
}

#sp-form-post label span {
color: red !important;
}

#profileDropDown li.active {
background-color: #c45508;
}

#profileDropDown li.active a {
color: #fff;
}

input#spPostingExperience_ {
width: 150px;
}
.header_jobBoard {
background-color: #1f3060;
padding: 0px 10px 5px;
}

.swal2-popup {

font-size: 13px!important;
}
.caret1{
display: inline-block;
width: 0;
height: 0;
margin-left: 2px;
vertical-align: middle;
border-top: 4px dashed;
border-top: 4px solid\9;
border-right: 4px solid transparent;
border-left: 4px solid transparent;
margin-left: 6px!important;
}
#caret1{color: #0c0b0b!important;}
#profiles .caret {color: #0c0b0b!important;}
#profileDropDown li.active {
background-color: #1f3060;
margin-top: -1px;
}
#profileDropDown li.active a {
color: #fff;
}

.butn_draf {
    color: #fff;
    border-radius: 5px;
    background-color: #337ab7 !important;
    font-size: 14px;
    min-width: 127px;
}
.modal-title {
    font-family: Marksimon;
    font-size: 22px !important;
}

.modal-header{
    text-align:left !important; 
}
.modal-dialog .cntry_clm_2{
    text-align:left;
display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(2, 1fr);
}
.modal-dialog .cntry_clm_4{
    text-align:left;
display: grid;
    column-gap: 17px;
    row-gap: 10px;
    grid-template-columns: repeat(3, 1fr);
}
</style>

</head>

<body onload="pageOnload('post')" class="bg_gray">
<?php

$header_select = "freelancers";
include_once("../../header.php");


$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);

$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
//echo $p->ta->sql;
if ($res != false) {
$r = mysqli_fetch_assoc($res);
$name = $r['spProfileName'];
$icon = $r['spprofiletypeicon'];
} else {
$name = "Select Profile";
$icon = "<i class='fa fa-user'></i>";
}

?>
<div class="loadbox">
<div class="loader"></div>
</div>
<section class="landing_page">
<div class="container">
<div class="row postJob">

<div class="col-md-9" id="postfree">
<style>
.top_heading_group {
padding: 8px 20px;
background-color: #c45508;

}

.postJob .its-free-post-job .heading {

color: #c45508;

}

.butn_save {

background-color: #c45508 !important;
}

.butn_cancel {

background-color: #eb0d0d !important;
}
</style>
<div class="row">
<div class="col-md-12">
<div class="about_banner about_postbanner">
<div class="top_heading_group bg_orange postbannerheading">
<div class="row">
<div class="col-md-12 text-white">
<span><a href="<?php echo $BaseUrl . '/freelancer/'; ?>"><span style="color:white;"><i class="fa fa-home"></i></span></a> <?php echo $pgTitle; ?> <a href="<?php echo $BaseUrl . '/freelancer/dashboard/' ?>" class="pull-right"><span style="color:white;">Dashboard</span></a></span>
<?php
if (isset($_GET['postid']) != "") {
echo "<span style='color:white;'>Edit Project<span>";
} else {
echo "<span style='color:white;'>Add Project<span>";
}
?>

</div>

</div>
</div>



<div class="event_form">
<!-- <div class="modTitle">
<h2>Module Name: <span>Freelancer</span></h2>
</div> -->
<div class="">
<div class="">

<div>

<!--<div class="row">
<div class="col-md-6" style="display: inline-flex;">

<?php
$p = new _spprofiles;
$res = $p->readprofilepic($_SESSION['ptid'], $_SESSION['uid']);
//echo $p->ta->sql; exit;			
if ($res != false) {
$r = mysqli_fetch_assoc($res);
$picture = $r['spProfilePic'];
if (isset($picture)) {
echo "<img  alt='Profile Pic' class='img-responsive pull-right freelancername' style='width:60px; height:60px; ' src=' " . ($picture) . "' ><br>";
} else
echo "<img  alt='Profile Pic' class='img-responsive pull-right freelancername' style='width:60px; height:60px;' src='../../img/default-profile.png' >
<br>";

echo "<div class='pull-right freelancername' style='font-weight:700; padding-right:15px;color:#114B5F;padding-top: 20px;'> &nbsp;&nbsp<span class='" . $r['spprofiletypeicon'] . "'></span> " . $r['spProfileName'] . "<br>&nbsp;&nbsp<span class=''>Current Profile</span></div>";
$profileid = $r['idspProfiles'];
$country = $r["spProfilesCountry"];
$city = $r["spProfilesCity"];
} elseif (isset($profilesid)) {
echo "<img  alt='Profile Pic' class='img-responsive pull-right freelancername' style='width:60px; height:60px;' src='" . (isset($profilepicture) ? " " . ($profilepicture) . "" : "../../img/default-profile.png") . "' ><br>";
echo "<div class='pull-right freelancername' style='font-weight:700;padding-right:15px;color:#114B5F;padding-top: 20px;'><span class='" . $icon . "'></span> " . $profilename . "</div>";
}
?>

</div>

<div class="col-md-6"></div>
<div class="col-md-6">
<span class="currentprofile">Current Profile</span>
</div> 
</div>-->

<!--  <div class="row">

<div class="col-md-6">
<!-- <span class="currentprofile">Current Profile</span> -->
<!-- <span class="">Current Profile</span> 
</div>

</div>-->




<!--  <div class="row">

<div class="col-md-6" style="padding-top: 20px;">




<div class="dropdown">
<div class="btn-group" role="group" aria-label="Basic example">

<button type="button" class="btn create_add selectprofile" style="cursor:default; border-color: #C76114!important;">Change Profile</button>

<button class="btn btn-default dropdown-toggle selectFreelancer freelancer_capitalize selecthover " type="button" id="profiles" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="border-color: #C76114!important;"><span class="<?php echo $icon; ?>"></span> <?php echo $name; ?><span class="caret"></span></button>

<ul class="dropdown-menu freelancer_capitalize" id="profilesdd" aria-labelledby="profiles">
<?php
$profile = new _spprofiles;
$res = $profile->categoryprofiles($_GET["categoryid"], $_SESSION['uid']);
//echo $profile->ta->sql;
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {
//echo "<li><a href='#' class='profiledd' data-pid='".$row['idspProfiles']."' data-profileicon='".$row["spprofiletypeicon"]."'><span class='".$row["spprofiletypeicon"]."'></span> " .$row["spProfileName"]."</a></li>";
echo "<li><a href='#' class='profiledd' data-pid='" . $row['idspProfiles'] . "' data-profileicon='" . $row["spprofiletypeicon"] . "'>";
if (isset($row['spProfilePic']) && !empty($row['spProfilePic'])) {

echo "<img  alt='Profile Pic' class='img-rounded' style='width:20px; height:20px;' src=' " . ($row["spProfilePic"]) . "' > &nbsp;&nbsp;

<span class='" . $row["spprofiletypeicon"] . "'></span> " . $row["spProfileName"] . "</a></li><hr>";
} else {
echo "<img  alt='Profile Pic' class='img-rounded' style='width:40px; height:40px;' src='../../assets/images/blank-img/default-profile.png'> &nbsp;&nbsp;

<span class='" . $row["spprofiletypeicon"] . "'></span> " . $row["spProfileName"] . "</a></li><hr>";
}


/*    if(isset($row['spProfilePic']) && !empty($row['spProfilePic'])){
echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src=' ".($row['spProfilePic']) . "' >&nbsp;&nbsp;<span class='" . $row["spprofiletypeicon"] . "'></span> " . $row["spProfileName"] . "</a></li><hr>";
}else{
echo "<img  alt='Posting Pic' class='img-responsive center-block bradius-10' src='../../assets/images/blank-img/default-profile.png' >" ;
}
*/

$profilename = $row["spProfileName"];
$profilesid = $row["idspProfiles"];
$profilepicture = $row["spProfilePic"];
$country = $row["spProfilesCountry"];
$city = $row["spProfilesCity"];
$icon = $row["spprofiletypeicon"];
}
} else {
echo "<li role='separator' class='divider'></li>
<li id='myprofile'><a href='/my-profile/' id='sp-profile-register'>Add New Profile</a></li>";
}
?>
</ul>
</div>
</div>
</div>


<div class="col-md-6 profilepicture">
<?php
$p = new _spprofiles;
$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);

if ($res != false) {
$r = mysqli_fetch_assoc($res);
$picture = $r['spProfilePic'];
if (isset($picture)) {
echo "<img  alt='Profile Pic' class='img-responsive pull-right freelancername' style='width:60px; height:60px; ' src=' " . ($picture) . "' ><br>";
} else
echo "<img  alt='Profile Pic' class='img-responsive pull-right freelancername' style='width:60px; height:60px;' src='../../img/default-profile.png' >
<br>";

echo "<div class='pull-right freelancername' style='font-weight:700; padding-right:15px;color:#114B5F;'><span class='" . $r['spprofiletypeicon'] . "'></span> " . $r['spProfileName'] . "</div>";
$profileid = $r['idspProfiles'];
$country = $r["spProfilesCountry"];
$city = $r["spProfilesCity"];
} elseif (isset($profilesid)) {
echo "<img  alt='Profile Pic' class='img-responsive pull-right freelancername' style='width:60px; height:60px;' src='" . (isset($profilepicture) ? " " . ($profilepicture) . "" : "../../img/default-profile.png") . "' ><br>";
echo "<div class='pull-right freelancername' style='font-weight:700;padding-right:15px;color:#114B5F;'><span class='" . $icon . "'></span> " . $profilename . "</div>";
}
?>
</div>

<div class="col-md-6"></div>
<div class="col-md-6">
<span class="currentprofile">Current Profile</span>
</div>

</div> -->
</div>
<div class="space"></div>


<div>
<?php
$c = new _spuser;
$cu = $c->readcurrency($_SESSION['uid']);
$cur = mysqli_fetch_assoc($cu);
$currency = $cur['currency'];

$profileid = "";
$eCountry = "";
$eCity = "";
$eCityID = "";
$eCategory = "";
$eSubCategoryID = "";
$eSubCategory = "";
$ePostTitle = "";
$ePostNotes = "";
$eExDt = "";
$ePrice = "";
$shipping = "";



if (isset($_GET["postid"])) {
//$p = new _postingview;
$sf  = new _freelancerposting;

// $r = $p->read($_GET["postid"]);

$r = $sf->read1($_GET["postid"]);


//    echo $sf->ta->sql;


if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {


/*print_r($row);*/
//echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
$ePostTitle = $row["spPostingTitle"];
$ePostNotes = $row["spPostingNotes"];
$eExDt = $row["spPostingExpDt"];
$ePrice = $row["spPostingPrice"];
$profileid = $row['idspProfiles'];
$postingflag = $row['spPostingsFlag'];
$spPostInSubCategory = $row['spPostInSubCategory'];

$profile_id = $row['spProfiles_idspProfiles'];
$visibility = $row['spPostingVisibility'];




$spPostExperienceLevl = $row['spPostExperienceLevl'];
$shipping = $row['sppostingShippingCharge'];
$eCountry = $row['spPostingsCountry'];
$eCity = $row['spPostingsCity'];
$spPostingPriceFixed = $row['spPostingPriceFixed'];
}
}
}
$pid = $_SESSION['pid'];
//die('======');
if ($profile_id !=  $pid) {
//die('===');
header("Location: $BaseUrl/artandcraft/dashboard/index.php");
}
?>
<div class="row">
<div class="col-md-12 add_form_body">


<?php
$next_due_date = date('Y-m-d', strtotime("+30 days"));
?>
<input type="hidden" class="form-control" id="spPostingExpDt1" name="spPostingExpDt" value="<?php echo $next_due_date ?>">


<form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopostfreelancer.php" method="post" id="sp-form-post" name="postform">
<?php if ($_GET['postid']) { ?>
<input type="hidden" id="idspPostings" name="idspPostings" value="<?php echo $_GET['postid']; ?>">
<?php } ?>
<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
<input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
<input type="hidden" id="buyid" name="buyid_" type="hidden">
<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="<?php echo (isset($visibility) ? $visibility : "-1"); ?>">

<input type="hidden" name="spuser_idspuser" value="<?php echo $_SESSION['uid']; ?>">
<input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo ($profileid == '') ? $_SESSION['pid'] : $profileid; ?>" type="hidden">
<input type="hidden" name="sppostingscommentstatus" value="1" checked>

<!--Buy and Sell-->
<!--Buy and Sell--complete-->
<div class="row">
<div class="col-md-12">
<div class="form-group">

<label for="spPostingTitle" style="display:none" class="lbl_1">Currency <span class="red_clr">* <span id="title_error1" class="label_error"></span></span></label>
<input class="currency form-control" name="Default_Currency" type="hidden" readonly value="<?php echo $currency; ?>">


</div>
<div class="form-group">

<label for="spPostingTitle" class="">Title (40 Characters Allowed) <span class="red_clr">* <span id="title_error" class="label_error"></span></span></label>
<input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle" value="<?php echo $ePostTitle ?>" placeholder="Your Posting Title" maxlength="40" required />

</div>





<div class="form-group">

<input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt" value=" <?php
                        if ($eExDt) {

                          $date = date('Y-m-d');
                          // die('11111111111');
                          echo date('Y-m-d', strtotime($eExDt));
                        } else {
                          echo date('Y-m-d', strtotime($eExDt . "+30 days"));
                        }
                        ?>">

</div>










<div class="addcustomfields">
<!--add custom fields -->
<?php
if (isset($_GET["postid"])) {
// $f = new _postfield;

$sf  = new _freelancerposting;

$res = $sf->field1($_GET["postid"]);

//echo $sf->ta->sql;


if ($res != false)
while ($result = mysqli_fetch_assoc($res)) {


$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
//$idspPostField = $result["idspPostField"];
}
}


$_GET["module"] = $_GET["categoryid"];
include("../freelancer.php");
?>
<!--Getcustomfield-->
<div class="form-group">
<label for="spPostingNotes" class="">Description (Minimum 100 Characters Required) <span class="red_clr">* </span><span id="description_limit" style="color:red;"></span></label>

<textarea class="form-control" id="spPostingNotes" maxlength="5000" name="spPostingNotes" rows="10" style="resize:none;" required><?php echo $ePostNotes ?></textarea>

</div>
</div>
</div>
</div>
<?php
  $bprofile = selectQ("select * from spbusiness_profile where spprofiles_idspProfiles = ?", "i", [$_SESSION['pid']], "one");
?>
<!--Testing-->
<div id="myModals" style="display:none;" class="modal">
<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title text-center">Create Business Profile</h5>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-left bpname">Business Profile Name</label>
                <input type="text" class="form-control" id="businessprofilename" name="companyname" aria-describedby="emailHelp" placeholder="Enter name" required>
            </div>
            <div class="form-group text-start py-lg-1 py-0 cntry_clm_2">
                <div class="">
                    <label for="" class=" my-2 text-capitalize bname">Business Name<span class="req_star">*</span></label>
                    <input type="text" class="form-control" name = "companytagline" id="businessname" required>
                </div>
                <div class="form-group">
                    <div class="">
                        <label for="businesscategory" class="my-2 text-capitalize bcategory">Category<span class="req_star">*</span></label>
                        <select class="form-control" name="businesscategory" id="businesscategory"  aria-label="Default select example" required>
                        <option value="">Select Category</option>
				<?php
				//print_r($explodedArray); die(' kkkkkkkkkkkkkk');
					//echo "<option value='' disabled selected>".$row["Business Category"]."</option>";
					$m = new _masterdetails;
					$masterid = 8;
					$result = $m->read($masterid);
					if($result != false){
						while($rows = mysqli_fetch_assoc($result)){ ?>
							<option value='<?php echo $rows["idmasterDetails"]; ?>' 
							<?php
						if(isset($explodedArray) && in_array($rows["idmasterDetails"], $explodedArray) ) {echo "selected";}
				
					?> >
					<?php echo ucfirst(strtolower($rows["masterDetails"]));?>
					
					</option><?php
						}
					}
				?>
                        </select>
                        <span class="spUserState erormsg"id="state"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-left">Products/Services</label>
                <input type="text" class="form-control" name = "companyProductService" id="product" aria-describedby="emailHelp" placeholder="Enter product/services">
            </div>
            <div class="d-flex mb-2" >
                <h4>Location</h3>
                <i></i>
            </div>
            <div class=" text-start py-lg-1 py-0 cntry_clm_4">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-left busCountry">Country<span class="req_star">*</span></label>
                    <select class="form-control" id="spUserCountry_default_address" name="spUserCountry"  aria-label="Default select example" >
                    <option value="0">Select Country</option>
                        <?php
                       
                        $co = new _country;
                        $result3 = $co->readCountry();
                        if($result3 != false){
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                ?>
                                <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>>
                                    <?php echo $row3['country_title'];?>
                                </option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    
              
                      <!-- <label class="spUserCountry erormsg "  id="countryerror" style="margin-top:-15px;"></label> -->
                </div>
                <div class="loadUserState">
                    <label for="spUserState" class="busState">State<span class="req_star">*</span></label>
                    <select class="form-control" name="spUserState" id="spUserState" >
                        <option value="0">Select State</option>
                        <?php 
                            if (isset($userstate) && $userstate > 0) {
                                $pr = new _state;
                                $result2 = $pr->readState($usercountry);
                                if($result2 != false){
                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                        <option value='<?php echo $row2["state_id"];?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                    </select>
                    <span id="shippstate_error" style="color:red;"></span>
                </div>
                <div class="loadCity">
                        <label  for="spUserCity">City</label>
                        <select class="form-control" name="spUserCity" id="spUserCity" >
                           <option value="0">Select City</option>
                            <?php 
                               if (isset($usercity) && $usercity > 0) {
                                $co = new _city;
                                $result3 = $co->readCity($userstate);
                                if($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                        <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
                                    }
                                }
                            } 
                            ?>
                        </select>
                        <span id="shippcity_error" style="color:red;"></span>
                     </div>
            </div>
            </div>
      <div class="modal-footer">
        <button  id="PostSubmitFreelance1" type="button" data-bp="<?php if(isset($bprofile) && !empty($bprofile)) { echo "1"; } else { echo "0"; } ?>" class="btn butn_save btn-border-radius"><?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>Save</button>
        <button id="spPostSubmitjobclosse"  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="space"></div>
<div class="row">

<div class="col-md-12 text-right">
<?php
if (isset($_GET['postid']) && $_GET['postid'] > 0) {
//   if (isset($_GET['exp']) && $_GET['exp'] == 1) {
?>

<button id="PostSubmitFreelance11" data-bp="<?php if(isset($bprofile) && !empty($bprofile)) { echo "1"; } else { echo "0"; } ?>" type="button" class="btn btn-primary btn-border-radius <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>">
<?php
 
 if($visibility == 0){
  echo 'Publish';
}else{  
  echo 'Update';
 } ?>
</button>
</div>



<?php

if (isset($_GET['postid']) && $_GET['exp'] == 1) { ?>
<button id="spUpdateFreelance" type="button" class="btn btn-primary btn-border-radius">Update</button>
<?php  }
?>


<button id="spSaveDraftFreelance" type="button" class="btn butn_save btn-border-radius">Save Draft</button>


<a href="<?php echo $BaseUrl . '/freelancer/dashboard/'; ?>" class="btn btn-danger btn-border-radius">Cancel </a>
<?php
// }
} else {
?>

<a href="<?php echo $BaseUrl . '/registration-steps.php?pageid=7'; ?>" class="btn btn-danger btn-border-radius">Cancel</a>

<!-- <a href="javaScript:void(0)" class="btn butn_draf draftbtn">Save Draft</a> -->
<?php

if (isset($_GET['postid']) && $_GET['exp'] == 1) { ?> 
<button id="spSaveDraftFreelance" type="button" class="btn butn_save  btn-border-radius">Update</button>
<?php  }
?>
<?php if (!isset($_SESSION['sign-up']) || $_SESSION['sign-up'] != 1) { ?>
<button id="spSaveDraftFreelance" type="button" class="btn butn_draf draftbtn  btn-border-radius">Save Draft</button>
<?php } ?>
<button id="PostSubmitFreelance11" data-bp="<?php if(isset($bprofile) && !empty($bprofile)) { echo "1"; } else { echo "0"; } ?>" type="button" class="btn butn_save  btn-border-radius">Post</button>





<?php
}
?>

</div>
</div>
</form>
</div>
</div>
</div>
</div>


</div>
</div>
</div>
</div>



</div>
</div>
<div class="col-md-3">
<div class="row">
<div class="col-xs-12 nopadding its-free-post-job about_postbanner">
<?php
$po = new _spAllStoreForm;
$result2 = $po->getformcontent(5);
if ($result2) {
$row2 = mysqli_fetch_assoc($result2);
?>
<h2 class="heading postbannerheading"> <?php echo $row2['pc_title']; ?></h2>
<div class="col-xs-12 content">
<div class='nopadding'><?php echo $row2['pc_content']; ?></div>
</div>
<?php
}
?>
</div>
</div>
</div>
</div>
</section>

<?php include('../../component/footer.php'); ?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/btm_script.php'); ?>
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/date-time/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
        var modal = document.getElementById("myModals");

// Get the button that opens the modal
var btn = document.getElementById("PostSubmitFreelance11");

// Get the <span> element that closes the modal
var span = document.getElementById("spPostSubmitjobclosse");



// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>



<script>
$("#PostSubmitFreelance11").on("click", function() {
var sendUrl = MAINURL;

if ($(this).hasClass("editing"))
postedit = true;
else
postedit = false;

var btn = this;
var idspprofile = $("#spProfiles_idspProfiles").val();

var $form = $("#sp-form-post");

if (idspprofile != "") {


var title = document.getElementById("spPostingTitle").value;
//var visibility = document.getElementById("spPostingVisibility").value-1;
document.getElementById('spPostingVisibility').value = "- 1";
var expdate = document.getElementById('spPostingExpDt1').value;


document.getElementById('spPostingExpDt').value = expdate;
var category = $('#spPostingCategory_ option:selected').val();
var subcategory = $('#spPostInSubCategory_ option:selected').val();
var experience = $('#spPostExperienceLevl_ option:selected').val();
//var closingDate = document.getElementById("spClosingDate_").value;
var skills = document.getElementById("tokenfield-typeahead").value;
var description = $('#spPostingNotes').val();
var price = $('#sppostcost').val();
//alert(description.length);

if (title == "" && category == 0 && subcategory == 0 && experience == 0 && skills == "" && price == "" && description == "") {

    $(".lbl_1").addClass("label_error");
    $(".lbl_1").addClass("label_error");
    $("#title_error").text("Please Enter Title");
    $("#spPostingTitle").focus();

    $(".lbl_2").addClass("label_error");
    $("#category_error").text("Please Enter Category");

    // $(".lbl_3").addClass("label_error");
    //$("#subcategory_error").text("Please Enter Sub Category");

    $(".control-label").addClass("label_error");
    $("#experience_error").text("Please Enter  Experience level");


    $(".lbl_5").addClass("label_error");
    $("#skill_error").text("Please Enter Skills");

    $(".price_label").addClass("label_error");
    $("#price_error").text("Please Enter price");

    $(".lbl_6").addClass("label_error");
    $("#description_limit").text("Please Enter Description");


    } else {
        if (title == "") {
        $(".lbl_1").addClass("label_error");
        $("#title_error").text("Please Enter Title");
        $("#spPostingTitle").focus();
        } else {
        $("#title_error").text("");
        $(".lbl_1").removeClass("label_error");
        if (category == 0) {
        $(".lbl_2").addClass("label_error");
        $("#category_error").text("Please Enter Category");
        $("#spPostingCategory_").focus();

        } else {
        $(".lbl_2").removeClass("label_error");
        $("#category_error").text("");


    if (experience == 0) {
        $(".control-label").addClass("label_error");
        $("#experience_error").text("Please Enter  Experience level");
        $("#spPostExperienceLevl_").focus();
    } else {
        $(".lbl_3").removeClass("label_error");
        $(".control-label").removeClass("label_error");
        $("#experience_error").text("");
        $(".lbl_4").removeClass("label_error");
        if (skills == "") {
            $(".lbl_5").addClass("label_error");
            $("#skill_error").text("Please Enter Skills");
            $("#tokenfield-typeahead").focus();
        } else {
            $(".lbl_5").removeClass("label_error");
            $("#skill_error").text("");
            if (price == "") {
                $(".price_label").addClass("label_error");
                $("#price_error").text("Please Enter price");
                $("#sppostcost").focus();
            } else {
                $(".price_label").removeClass("label_error");
                $("#price_error").text("");
                if (description == "") {
                    $(".lbl_6").addClass("label_error");
                    $("#description_limit").text("Please Enter Description");
                    $("#spPostingNotes").focus();
                    return false;
                } else if (description.length < 100) {
                    $("#description_limit").text("");
                    $("#description_limit").text(" Please Enter Description more than 100 Character.");
                    return false;
                } else {
                    $(".lbl_6").removeClass("label_error");
                    $("#description_limit").text("");
                    //alert(description);
                    // When the user clicks the button, open the modal
                  }
                  if($(this).data('bp') == 1){
                    document.getElementById("PostSubmitFreelance1").click();
                  } else {
                    modal.style.display = "block";
                  }
            }
}
}


}
}
}

} else {
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select profile...!</div>");
}
});


//On click popup to create buisness profile:
$("#PostSubmitFreelance1").on("click", function() {
    //console.log("Success");
    // HERE WE WRITE A COMPLETE CODE
    var $form = $("#sp-form-post");
    var businessProfileName = $("#businessprofilename").val();
    var businessName = $("#businessname").val();
    var busCountry = $("#spUserCountry_default_address").val();
    var businessCategory = $("#businesscategory").val();
    var busState = $("#spUserState").val();
    if( ( $(this).data('bp') == 0 ) && ( businessProfileName == "" || businessName == "" || businessCategory == "" || busCountry == "0" || busState == "0") ){
      if(businessProfileName == ""){
        $(".bpname").addClass("label_error");
      } else {
        $(".bpname").removeClass("label_error");
      }
      if(businessName == ""){
        $(".bname").addClass("label_error");
      } else {
        $(".bname").removeClass("label_error");
      }
      if(businessCategory == ""){
        $(".bcategory").addClass("label_error");
      } else {
        $(".bcategory").removeClass("label_error");
      }
      if(busCountry == "0"){
        $(".busCountry").addClass("label_error");
      } else {
        $(".busCountry").removeClass("label_error");
      }
      if(busState == "0"){
        $(".busState").addClass("label_error");
      } else {
        $(".busState").removeClass("label_error");
      }
      return false
    }
    $(".loadbox").css({
        display: "block"
    });
    $(btn).button('loading...');
    term = new FormData($form[0]);
    url = $form.attr("action");
    
    $.ajax({
      url: url,
      type: 'POST',
      data: term,
      processData: false,
      contentType: false,
      success: function(data, status) {
        //alert(data);
      },
      error: function() {
        $(btn).effect("shake");
      },
      complete: function(data) {
        modal.style.display = "none";
        var postid = data.responseText;
        var albumid = $(".album_id").val();

        var form_data = new FormData($("#sp-form-post")[0]);
        form_data.append('spPostings_idspPostings', postid);
        form_data.append('spPostingAlbum_idspPostingAlbum', albumid);

        $(".media-file-data").each(function(i, e) {
          var base64image = $(e).attr("data-media");
          var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
          var ext = arr[0].replace("data:", "");

          $.post("../addmedia.php", {
            spPostings_idspPostings: postid,
            spPostingMedia: base64image,
            ext: ext,
            spPostingAlbum_idspPostingAlbum: albumid
          }, function(r) {
            //alert(r);
          });
        });

        window.location.href = "../../freelancer/dashboard/active-bid.php?ppost=posting1";

    }
});

});

$("#spUserCountry_default_address").on("change", function () {
  var sendUrl = MAINURL;
  var countryId = this.value;
  $.post(MAINURL+"/helpers/location/loadUserState.php", {countryId: countryId}, function (r) {
    //alert(r);
    $(".loadUserState").html(r);
  });
  var state = 0;
  $.post(MAINURL+"/helpers/location/loadUserCity.php", {state: state}, function (r) {
    //alert(r);
    $(".loadCity").html(r);
  });
});

//==========ON CHANGE LOAD CITY==========
$("#spUserState").on("change", function () {
  var sendUrl = MAINURL;
  var state = this.value;
  $.post(MAINURL+"/helpers/location/loadUserCity.php", {state: state}, function (r) {
    //alert(r);
    $(".loadCity").html(r);
  });
});
</script>


<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/token_field/bootstrap-tokenfield.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/token_field/affix.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/token_field/typeahead.bundle.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/token_field/docs.min.js" charset="UTF-8"></script>
</body>

</html>
<?php
}
?>
