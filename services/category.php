<?php



include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "services/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "7";
$_GET["categoryName"] = "Services";
$header_servic = "header_servic";
$topPage = 1;

$u = new _spuser;
$res = $u->read($_SESSION["uid"]);

/*

if(isset($_GET['btnSearch'])){

$userstate =	$_GET['spUserState'];
//echo $userstate; 
//echo "<br>";
$usercity = $_GET['spUserCity'];
//echo $usercity; die("--------------");

$_SESSION['spPostState'] = $userstate;	
$_SESSION['spPostCity'] =  $usercity;


}
*/


if (isset($_POST['changelc'])) {
//print_r($_POST); die;						
$usercountry = $_POST['spPostCountry'];
$userstate =	$_POST['spUserState'];
$usercity = $_POST['spUserCity'];
//echo $usercountry; 

//echo "<br>";


$_SESSION['spPostCountry'] =   $usercountry;
$_SESSION['spPostState'] = $userstate;
$_SESSION['spPostCity'] =  $usercity;

//echo $_SESSION['spPostCountry']; 			


//	print_r($_SESSION); die;
} else {

if ($_SESSION['spPostCountry'] != "") {

$usercountry = $_SESSION['spPostCountry'];
$userstate = $_SESSION['spPostState'];
$usercity = $_SESSION['spPostCity'];
} else {
$ruser = mysqli_fetch_assoc($res);
//$usercountry = $ruser["spUserCountry"];
//$userstate = $ruser["spUserState"]; 
//$usercity = $ruser["spUserCity"];

//$_SESSION['spPostCountry'] =   $usercountry ;																	
//$_SESSION['spPostState'] = $userstate;	
//$_SESSION['spPostCity'] =  $usercity;
}
}
?>




<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercountry) && $usercountry == $row3['country_id']) {
$currentcountry = $row3['country_title'];
$currentcountry_id = $row3['country_id'];
}
}
}

if (isset($userstate) && $userstate > 0) {
$countryId = $currentcountry_id;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) {
if (isset($userstate) && $userstate == $row2["state_id"]) {
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
}
}
}
}
if (isset($usercity) && $usercity > 0) {
$stateId = $currentstate_id;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
if (isset($usercity) && $usercity == $row3['city_id']) {
$currentcity = $row3['city_title'];
$currentcity_id = $row3['city_id'];
}
}
}
} ?>




<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
</head>

<style>
#mytab {
background-color: #17a3af;
color: white;
}
</style>

<body class="bg_gray">
<?php
include_once("../header.php");
?>

<section>
<div class="row no-margin">
<div class="col-md-2 no-padding">
<?php
include('../component/left-services.php');
?>
</div>
<div class="col-md-10 no-padding">
<div class="head_right_enter">
<div class="row no-margin">
<?php
include('top-head-inner.php');
?>
<div class="col-sm-12 no-padding">
<div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active" id="video1">
<div class="row">
<div class="col-sm-12 topServBread">
<nav aria-label="breadcrumb">

<ol class="breadcrumb">

<li class="breadcrumb-item"><a href="<?php echo $BaseUrl . '/services'; ?>"><i class="fa fa-home"></i></a></li>
<?php
$ac = new _artCategory;
if (isset($_GET['catName'])) {
?>
<li class="breadcrumb-item active" aria-current="page"><?php echo $_GET['catName']; ?></li><?php

} else {
if ($_GET['keyword']) { ?>

<li class="breadcrumb-item active" aria-current="page">Search Results for <?php echo $_GET['keyword']; ?></li>
<?php } else {
?>
<li class="breadcrumb-item active" aria-current="page">Top Categories</li>

<?php
}
}
?>




<small style=" float:right;"><?php echo $currentcountry . ', ' . $currentstate . ', ' . $currentcity; ?><br>
<a style="cursor:pointer; float:right;" data-toggle="modal" data-target="#myModal">Change Location</a>
</small>

</ol>




</nav>
</div>
</div>
<div class="" style="">
<div class="row">

<?php
$limit = 12;
$orderBy = "DESC";
$p   = new _classified;
$pf  = new _postfield;


$keyword = $_GET['keyword'];



if (isset($_GET['Activities'])) {

$condition1 = 't.spPostSerComty = "Activities" OR ';
}


if (isset($_GET['Artists'])) {


$condition1 .= 't.spPostSerComty = "Artists" OR ';
}

if (isset($_GET['Childcare'])) {

$condition1 .= 't.spPostSerComty = "Childcare" OR ';
}

if (isset($_GET['Classes'])) {

$condition1 .= 't.spPostSerComty = "Classes" OR ';
}

if (isset($_GET['Events'])) {
$condition1 .= 't.spPostSerComty = "Events" OR ';
}

if (isset($_GET['General'])) {
$condition1 .= 't.spPostSerComty = "General" OR ';
}

if (isset($_GET['Groups'])) {
$condition1 .= 't.spPostSerComty = "Groups" OR ';
}

if (isset($_GET['Local_news'])) {
$condition1 .= 't.spPostSerComty = "Local_news" OR ';
}

if (isset($_GET['lost_found'])) {
$condition1 .= 't.spPostSerComty = "lost_found" OR ';
}

if (isset($_GET['missed_connections'])) {
$condition1 .= 't.spPostSerComty = "missed_connections" OR ';
}

if (isset($_GET['musicians'])) {
$condition1 .= 't.spPostSerComty = "musicians" OR ';
}

if (isset($_GET['pets'])) {
$condition1 .= 't.spPostSerComty = "pets" OR ';
}

if (isset($_GET['politics'])) {
$condition1 .= 't.spPostSerComty = "politics" OR ';
}

if (isset($_GET['rants_raves'])) {
$condition1 .= 't.spPostSerComty = "rants_raves" OR ';
}

if (isset($_GET['rideshare'])) {
$condition1 .= 't.spPostSerComty = "rideshare" OR ';
}

if (isset($_GET['volunteers'])) {
$condition1 .= 't.spPostSerComty = "volunteers" OR ';
}

if (isset($_GET['automotive'])) {
$condition1 .= 't.spPostSerComty = "automotive" OR ';
}

if (isset($_GET['beauty'])) {
$condition1 .= 't.spPostSerComty = "beauty" OR ';
}

if (isset($_GET['cell_mobile'])) {
$condition1 .= 't.spPostSerComty = "cell_mobile" OR ';
}

if (isset($_GET['computer'])) {
$condition1 .= 't.spPostSerComty = "computer" OR ';
}

if (isset($_GET['creative'])) {
$condition1 .= 't.spPostSerComty = "creative" OR ';
}

if (isset($_GET['cycle'])) {
$condition1 .= 't.spPostSerComty = "cycle" OR ';
}

if (isset($_GET['event'])) {
$condition1 .= 't.spPostSerComty = "event" OR ';
}

if (isset($_GET['farm_garden'])) {
$condition1 .= 't.spPostSerComty = "farm_garden" OR ';
}

if (isset($_GET['financial'])) {
$condition1 .= 't.spPostSerComty = "financial" OR ';
}

if (isset($_GET['household'])) {
$condition1 .= 't.spPostSerComty = "household" OR ';
}

if (isset($_GET['labor_move'])) {
$condition1 .= 't.spPostSerComty = "labor_move" OR ';
}

if (isset($_GET['legal'])) {
$condition1 .= 't.spPostSerComty = "legal" OR ';
}

if (isset($_GET['lessons'])) {
$condition1 .= 't.spPostSerComty = "lessons" OR ';
}

if (isset($_GET['marine'])) {
$condition1 .= 't.spPostSerComty = "marine" OR ';
}

if (isset($_GET['pet'])) {
$condition1 .= 't.spPostSerComty = "pet" OR ';
}

if (isset($_GET['real_estate'])) {
$condition1 .= 't.spPostSerComty = "real_estate" OR ';
}

if (isset($_GET['skilled_trade'])) {
$condition1 .= 't.spPostSerComty = "skilled_trade" OR ';
}

if (isset($_GET['sm_biz_ads'])) {
$condition1 .= 't.spPostSerComty = "sm_biz_ads" OR ';
}

if (isset($_GET['travel_vac'])) {
$condition1 .= 't.spPostSerComty = "travel_vac" OR ';
}

if (isset($_GET['write_ed_tran'])) {

$condition1 .= 't.spPostSerComty = "write_ed_tran" OR ';
}


//  t.spPostSerComty = musicians'; OR  t.spPostSerComty = musicians OR';  t.spPostSerComty = musicians OR';  t.spPostSerComty = musicians OR';
//echo $condition1 ;

if (isset($condition1)) {

$where1 = substr($condition1, 0, -3);

$where1 = '( ' . $where1 . " )";
$res = $p->sameServCategory1($where1,  $_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity'], $keyword);
//echo $p->ta->sql;

} elseif ($keyword != FALSE) {

$res = $p->publicpost_music_keyword($_SESSION['spPostCountry'], $_SESSION['spPostState'], $_SESSION['spPostCity'], $keyword);
} else {

$res = $p->publicpost_music_all();
}


// echo $p->ta->sql;
if ($res) {
while ($row = mysqli_fetch_assoc($res)) {
//print_r($row);
if ($row['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}

//if(isset($_GET['keyword'])){
//if (str_contains(, )) { 
//if (strpos($row['spPostingTitle'], $_GET['keyword']) !== false) //{
//if(preg_match("/{$keyword}/i",$row['spPostingTitle'])){

//continue;
//}
//}




$result_pf = $pf->read($row['idspPostings']);
// echo $pf->ta->sql."<br>";
$sercom = $row['spPostSelection'];
/*if($result_pf){
$sercom = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($sercom == ''){
if($row2['spPostFieldName'] == 'spPostSelection_'){
$sercom = $row2['spPostFieldValue'];
}
}
}
}*/
if ($account_status != 1) {
?>
<div class="col-md-3">
<div class="ser_box_1">
<a href="<?php echo $BaseUrl . '/services/detail.php?postid=' . $row['idspPostings']; ?>">
<?php
$pic = new _classifiedpic;
//echo $row['idspPostings'];
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
} else {
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
<?php
} ?>
</a>

<a href="<?php echo $BaseUrl . '/services/detail.php?postid=' . $row['idspPostings']; ?>" class="title">
<?php




if (strlen($row['spPostingTitle']) < 15) {
echo ucwords(strtolower($row['spPostingTitle']));
} else {
echo substr(ucwords(strtolower($row['spPostingTitle'])), 0, 15) . "...";
}
?>

</a>


<span class="views"><?php echo (isset($sercom) && $sercom != '') ? $sercom : '&nbsp;'; ?></span>
<span class="expiry">Expires on <?php echo $row['spPostingExpDt']; ?></span>
<a href="<?php echo $BaseUrl . '/services/detail.php?postid=' . $row['idspPostings']; ?>" class="btn ">View Detail</a>
</div>
</div>
<?php
}
}
} else {

echo "<h3 style='text-align:center;'>Record not Found</h3>";
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
</div>
</section>
<div class="space-lg"></div>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
</body>

</html>
<?php
} ?>

<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">
<form action="" method="post">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location</h4>
</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
<div class="modal-body">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select class="form-control " name="spPostCountry" id="spUserCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" name="spUserState">
<option value="">Select State</option>
<?php
if (isset($userstate) && $userstate > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
<?php
}
}
}
?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity">City</label>
<select class="form-control" name="spUserCity">
<option value="">Select City</option>
<?php
if (isset($usercity) && $usercity > 0) {
$stateId = $userstate;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
}
}
} ?>
</select>
<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
</div>
</div>
</div>
<!--  <div class="col-md-6">
<div class="form-group">
<label for="spPostingCountry">Country</label>
<input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spPostingCity">Location/City</label>
<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>">
</div>
</div> -->

</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary btn-border-radius" name="changelc">Change</button>
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
</div>

</form>
</div>
</div>