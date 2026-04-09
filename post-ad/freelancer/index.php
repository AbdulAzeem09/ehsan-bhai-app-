<?php
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {

$_SESSION['afterlogin'] = "freelancer/";
include_once("../../authentication/islogin.php");
} else {

function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");
$post_id = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
$_GET["module"] = "5";
$_GET["categoryid"] = "5";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "Freelancers";
//include "../index.php";
if ($post_id) {
}

//$f = new _spprofiles;
$re = new _redirect;

//check profile is freelancer or not
//$chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
//$row = mysqli_fetch_assoc($chekIsFreelancer);

//if spProfileType_idspProfileType 
// 1 for business profile.
// 2 for freelancer profile.
// 3 for Professional profile.
// 4 for personal profile.
// 5 for employement profile.
// 6 for family profile.

//$_SESSION['ptid'] = spProfileType_idspProfileType
//echo "<pre>"; print_r($row); exit;
if ($_SESSION['ptid'] != 1 && $_SESSION['ptid'] != 3 ) {
$redirctUrl = $BaseUrl . "/freelancer/dashboard/";
$_SESSION['count'] = 0;
$_SESSION['msg'] = "Switch To Business Profile";
$re->redirect($redirctUrl);
}
//echo $_SESSION['pid'];


if ($_SESSION['ptid'] == 1) {


$f = new _spuser;
$fil = $f->read1($_SESSION['pid']);
//print_r($fil);die("================");
if ($fil) {
$r = mysqli_fetch_assoc($fil);
//print_r($r); die("-----------------"); 
$pid = $r['sp_pid'];
//echo $pid;die('====');
if ($r['status'] != 2) {
header("Location: $BaseUrl/freelancer/dashboard?msg=notverified");
}
} else {
header("Location: $BaseUrl/freelancer/dashboard?msg=notverified");
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




if ($_SESSION['ptid'] == 1) {


if (empty($post_id)) {
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



if ($post_id) {
//$p = new _postingview;
$sf  = new _freelancerposting;

// $r = $p->read($_GET["postid"]);

$r = $sf->read1($post_id);
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
if ($post_id != "") {
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



if ($post_id) {
//$p = new _postingview;
$sf  = new _freelancerposting;

// $r = $p->read($_GET["postid"]);

$r = $sf->read1($post_id);


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
<?php if ($post_id) { ?>
<input type="hidden" id="idspPostings" name="idspPostings" value="<?php echo $post_id; ?>">
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
if ($post_id) {
// $f = new _postfield;

$sf  = new _freelancerposting;

$res = $sf->field1($post_id);

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
<!--Testing-->

<div class="space"></div>
<div class="row">

<div class="col-md-12 text-right">
<?php
if ($post_id && $post_id > 0) {
//   if (isset($_GET['exp']) && $_GET['exp'] == 1) {
?>
<button id="PostSubmitFreelance1" type="button" class="btn btn-primary btn-border-radius <?php echo ($post_id ? "editing" : ""); ?>">
<?php
 
 if($visibility == 0){
  echo 'Publish';
}else{  
  echo 'Update';
 } ?>
</button>

<?php

if ($post_id && $_GET['exp'] == 1) { ?>
<button id="spUpdateFreelance" type="button" class="btn btn-primary btn-border-radius">Update</button>
<?php  }
?>


<button id="spSaveDraftFreelance" type="button" class="btn butn_save btn-border-radius">Save Draft</button>


<a href="<?php echo $BaseUrl . '/freelancer/dashboard/'; ?>" class="btn btn-danger btn-border-radius">Cancel </a>
<?php
// }
} else {
?>

<a href="<?php echo isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1 ? $BaseUrl . '/registration-steps.php?pageid=9' : $BaseUrl . '/freelancer/dashboard'; ?>" class="btn btn-danger btn-border-radius">Cancel</a>

<!-- <a href="javaScript:void(0)" class="btn butn_draf draftbtn">Save Draft</a> -->
<?php

if ($post_id && $_GET['exp'] == 1) { ?> 
<button id="spSaveDraftFreelance" type="button" class="btn butn_save  btn-border-radius">Update</button>
<?php  }
?>
<?php if (!isset($_SESSION['sign-up']) || $_SESSION['sign-up'] != 1) { ?>
<button id="spSaveDraftFreelance" type="button" class="btn butn_draf draftbtn  btn-border-radius">Save Draft</button>
<?php } ?>
<button id="PostSubmitFreelance1" type="button" class="btn butn_save  btn-border-radius">Post</button>





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




<script>
$("#PostSubmitFreelance1").on("click", function() {
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
var media = document.getElementById('mediaFiles');
var media1 = $('#mediaFiles').val();
//alert(description.length);

if (title == "" && category == 0 && subcategory == 0 && experience == 0 && skills == "" && price == "" && description == "" && media1 == "") {

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

$("#spPostingMedia_error").text("Please Add a File");

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
/*if (subcategory == 0) {
$(".lbl_3").addClass("label_error");
$("#subcategory_error").text("Please Enter Sub Category");
$("#spPostInSubCategory_").focus();
} else {
$(".lbl_3").removeClass("label_error");
$("#subcategory_error").text("");
/*if(closingDate == ""){
$(".lbl_4").addClass("label_error");
}else{*/
//$(".lbl_4").removeClass("label_error");

if (experience == 0) {
$(".control-label").addClass("label_error");
$("#experience_error").text("Please Enter  Experience level");
$("#spPostExperienceLevl_").focus();
} else {
$(".lbl_3").removeClass("label_error");
$(".control-label").removeClass("label_error");
$("#experience_error").text("");
/*	if(closingDate == ""){
$(".lbl_4").addClass("label_error");
}else{*/
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
} else if (description.length < 100) {

$("#description_limit").text(" Please Enter Description more than 100 Character.");

} else {
$(".lbl_6").removeClass("label_error");
//alert(description);
if(postedit == false &&  media1 == ""){
  $("#spPostingMedia_error").text("Please Add a File");
  $("#mediaFiles").focus();
} else {
var invalidFiles = [];
if(postedit == false || media1 != ""){
  var files = media.files;
  var maxSize = 10 * 1024 * 1024; // 10MB in bytes
  var allowedExtensions = ['.jpeg', '.pdf', '.txt', '.png', '.jpg', '.doc', '.docx', '.xlsx', '.xls'];
  for (var i = 0; i < files.length; i++) {
    var file = files[i];
    var fileSize = file.size;
    var fileName = file.name;
    var fileExtension = fileName.substr(fileName.lastIndexOf('.')).toLowerCase();
    if (fileSize > maxSize) {
      invalidFiles.push(fileName + ' (exceeds the maximum allowed size of 10MB)');
    }
    if (!allowedExtensions.includes(fileExtension)) {
      invalidFiles.push(fileName + ' (has an unsupported extension)');
    }
  }
}
if (invalidFiles.length > 0) {
  $("#spPostingMedia_error").text('The following files are invalid: ' + invalidFiles.join(', '));
  $("#mediaFiles").focus();
} else {
  $("#spPostingMedia_error").text('');
//console.log("Success");
// HERE WE WRITE A COMPLETE CODE
$(".loadbox").css({
display: "block"
});
$(btn).button('loading...');
var term = new FormData($form[0]);
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
        //alert(data.responseText);
        var postid = data.responseText;
        var albumid = $(".album_id").val();

        // CUSTOM FIELDS 
        /*var inputs = readCustomFields($("#sp-form-post"), postid);
        $.each(inputs, function(i, val) {
            $.post(sendUrl + "/post-ad/addpostcustomfields.php", val, function(response) {
                //alert(response);
            });
        });*/

        // Video post finally
        // ev.preventDefault();
        var form_data = new FormData($("#sp-form-post")[0]);
        form_data.append('spPostings_idspPostings', postid);
        form_data.append('spPostingAlbum_idspPostingAlbum', albumid);
        $.ajax({
            url: sendUrl + "/post-ad/addpostmedia.php",
            type: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(vi) {
                //alert(vi);
                $("#dvPreview").html("");
                $("#spPreview").html("");
                $("#clearnow").val("");
                $(".grptimeline").val("");
                $("#postform .form-control").val("");
                if (postedit == true) {
                    //window.location.reload();
                }
            },
            error: function(error) {
                //alert(error);
            }
        });

        // Media
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

        // Notification message from send box
        /*
        $.notify({
            title: '<strong>Posted Successfully</strong>',
            icon: '',
            message: ""
        },{
            type: 'success',
            animate: {
                enter: 'animated fadeInUp',
                exit: 'animated fadeOutRight'
            },
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
        });
        */

        // Message after form submitted
        //$("#dvPreview").html("");
        //$("#spPreview").html("");
        //$("#clearnow").val("");
        //$(".grptimeline").val("");
        //$("#postform .form-control").val("");
        //document.getElementById("sp-form-post").reset();

        // Redirect after a delay
        window.location.href = "../../freelancer/dashboard/active-bid.php?ppost=posting1";
    }
});
}
}
}
}
}
}

// }
}
}
}

} else {
$("#invalid").html("<div class='alert alert-danger error_show' role='alert'>Please Select profile...!</div>");
}
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
