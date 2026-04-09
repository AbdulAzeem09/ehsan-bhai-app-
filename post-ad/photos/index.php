<?php
// error_reporting(E_ALL);
ini_set('display_errors', '0');
//die('========================');
include('../../univ/baseurl.php');
include '../../common.php';
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "artandcraft/"; 
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$postid = isset($_GET["postid"]) ? (int) $_GET["postid"] : 0;

$_GET["module"] = "13";
$_GET["categoryid"] = "13";
$_GET["profiletype"] = "3";
$_GET["categoryname"] = "Photos";
if ($_SESSION['ptid'] != 1 && $_SESSION['ptid'] != 3 && $_SESSION['ptid'] != 4) {
  $re = new _redirect;
  $re->redirect($BaseUrl . "/artandcraft");
}

if(isset($_SESSION['pro-ac']) && $_SESSION['pro-ac'] == 1){
  $proffesionalAc = 1;
}

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
header("Location: $BaseUrl/artandcraft/dashboard/?msg=notverified");
}
} else {
header("Location: $BaseUrl/artandcraft/dashboard/?msg=notverified");
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
header("Location: $BaseUrl/job-board/dashboard/?msg=notverified");
}
}
}


if (!$postid) {

unset($_SESSION['spPostCountry']);
unset($_SESSION['spPostState']);
unset($_SESSION['spPostCity']);


if (isset($_POST['btn_save'])) {
$_SESSION['spPostCountry'] = $_POST['spPostingsCountry'];
$_SESSION['spPostState'] = $_POST['spPostingsState'];
$_SESSION['spPostCity'] = $_POST['spPostingsCity'];
}

if (isset($_SESSION["spPostCountry"])) {
$usercountry =    $_SESSION['spPostCountry'];
$userstate = $_SESSION['spPostState'];
$usercity = $_SESSION['spPostCity'];
} else {
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
$ruser = mysqli_fetch_assoc($res);
$usercountry = $ruser["spUserCountry"];
$userstate = $ruser["spUserState"];
$usercity = $ruser["spUserCity"];
$username = $ruser["spUserName"];
}
}
} else {
$p = new _artCategory;

if (isset($_POST['btn_save'])) {
$aa = $_POST['spPostingsCountry'];
$bb = $_POST['spPostingsState'];
$cc = $_POST['spPostingsCity'];
}


if ($aa) {
$arr = array(
"spPostingsCountry" => $aa,
"spPostingsState" => $bb,
"spPostingsCity " => $cc
);
$p->update_state($arr, $postid);
}

$r = $p->read_state($postid);
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {

$usercountry = $row['spPostingsCountry'];
$userstate = $row['spPostingsState'];
$usercity = $row['spPostingsCity'];
}
}
}

// $p = new _artCategory;
// if (isset($_GET["postid"])) {

// $r = $p->read_state($_GET["postid"]);
// //echo $p->ta->sql;
// if ($r != false) {
// while ($row = mysqli_fetch_assoc($r)) {
// // print_r($row);
// $usercountry = $row['spPostingsCountry'];
// $userstate = $row['spPostingsState'];
// $usercity = $row['spPostingsCity'];

// }
// }
// }


// else{

// if(!isset($_SESSION["spPostCountry"])){
// $u = new _spuser;
// $res = $u->read($_SESSION["uid"]);
// if ($res != false) {
// $ruser = mysqli_fetch_assoc($res);
// $usercountry = $ruser["spUserCountry"];
// $userstate = $ruser["spUserState"];
// $usercity = $ruser["spUserCity"];
// }

// }else{


//  $usercountry =    $_SESSION['spPostCountry'];
//  $userstate = $_SESSION['spPostState'] ;
//  $usercity = $_SESSION['spPostCity'];
// }

// }




// if (isset($_POST['spUserCountry'])) {

// $u = new _spuser;
// $res = $u->update($_POST, $_SESSION["uid"]);
// header("location:" . $BaseUrl . "/post-ad/photos/?post");
// }

if ($postid) {
//$p = new _postingviewartcraft;
//$r = $p->read($_GET["postid"]);
//$postid = $_GET["postid"];
$con = mysqli_connect(DOMAIN, UNAME, PASS);
mysqli_select_db($con, DBNAME);
$sql = "SELECT * FROM `sppostingsartcraft` WHERE idspPostings=$postid";

$r = mysqli_query($con, $sql);

if ($r != false) {
//die('==========');
while ($row = mysqli_fetch_assoc($r)) {
if ($_SESSION['pid'] != $row['spProfiles_idspProfiles']) {
$re = new _redirect;
$location = $BaseUrl . "/artandcraft";
$re->redirect($location);
}
}
}
}


if ($postid) {
//$p = new _postingviewartcraft;
//$r = $p->read($_GET["postid"]);
//$postid = $_GET["postid"];
$con = mysqli_connect(DOMAIN, UNAME, PASS);
mysqli_select_db($con, DBNAME);
$sql = "SELECT * FROM `sppostingsartcraft` WHERE idspPostings=$postid";
$r = mysqli_query($con, $sql);
$cp = $r->num_rows;
if ($cp == false) {

header("Location: $BaseUrl/artandcraft/dashboard/index.php?msg=notacess");
}

if ($r != false) {


while ($row = mysqli_fetch_assoc($r)) {

$spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];
//echo $idspPostings ;
if ($_SESSION['pid'] != $spProfiles_idspProfiles) {

header("Location: $BaseUrl/artandcraft/dashboard/index.php?msg=notacess");
}
}
}
}


?>

<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="The SharePage">
<meta name="author" content="Adnan Ghouri(skype:adnanghouri3)">
<title>The SharePage</title>
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
<!--custom css jis ki wja say issue ho rha tha form submit main-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

<!--<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>-->
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/photos.js?<?php echo rand(); ?>"></script>
<link rel="stylesheet" type="text/css" href="https://dev.thesharepage.com/assets/css/style.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

<!-- DATE AND TIME PICKER -->
<link href="<?php echo $BaseUrl; ?>/assets/css/date-time/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<!--post group button on btm of the form-->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

<!--CSS FOR MULTISELECTOR-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
<style>
/*mobile*/
@media screen and (max-width: 800px) {	
	form.inner_top_form {
    display: flex;
}
.form-group.onpage {
    flex: 0 0 40%;
	padding: 0 5px 0 0;
}
.form-group {
    display: flex;
}
.inner_top_form button {
    margin-left: 2px;
}
.right_head_top ul li i {
    vertical-align: bottom !important;
	margin: 8px 0 0 0;
}
.col-md-3.no-padding.hero-bnr {
    padding: 0px !important;
}
.art_form h3 {
    font-size: 14px;
}
.col-md-6.tab-data .form-group {
    width: 100%;
    margin: 0 auto;
}
label.lbl_7a {
    padding: 0 10px 0 0;
}
.row.no-margin.frm-bdy a {
    margin-left: 72px;
}
.col-md-6.tab-data {
    padding: 0px !important;
}
.form-group.frm-left {
    display: block;
}
div#forartsoldby {
    width: 90%;
    margin: 0 auto;
}
.form-group.radio-fld {
    margin: 0 auto;
    display: flex;
    padding: 10px 50px 10px 15px;
}
#cost {
    top: 0px !important;
}
.input-group.scnd-clm {
    margin-left: 17px;
   margin-bottom: 12px;
}
.mmm{
	width: 100% !important;
}
a.btn.btn-danger.btn-border-radius.btn-prmy {
    width: 30%;
    margin: 10px 0;
}
div#wdth_bx {
    width: 296px !important;
}
input#wdth_bx {
    width: 241px !important;
}
input#wdth_bxs {
    width: 298px !important;
}
a#dsk_phn {
    display: none;
}
}
a#mbl_phn {
    display: none;
}
	#dvPreview .closed, .imagepost .closed{
		border: 2px solid black;
		background: white;
		color: black;
	}
span.fa.fa-remove.dynamicimg.closed {
color: #e30000;
}
.postingpic{
	display: block;
}
.btn_searchArt {
background-color: #99068a !important;
border-radius: 5px !important;
}

.btn-warning {

border-radius: 5px !important;
}

button#indent {
padding: 9px;
}
.modal-title2 {
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
<script type="text/javascript">
//USER ONE
$(function() {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});

});
</script>
<script>
function numericFilter(txb) {
txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>
<?php
$urlCustomCss = $BaseUrl . '/component/custom.css.php';
include $urlCustomCss;
?>
</head>

<body onload="pageOnload('post')">
<div class="loadbox">
<div class="loader"></div>
</div>


<!-- this model is show when user is not a member of jobseekr -->
<div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content no-radius">

<div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
<h2>Your current profile does not have <br>access to this page. Please create or switch<br> your current profile to either <span>"Professional Profile"</span> to access this page.</h2>
<div class="space-md"></div>
<a href="<?php echo $BaseUrl . '/my-profile'; ?>" class="btn">Create or Switch Profile</a>
<a href="<?php echo $BaseUrl . '/photos'; ?>" class="btn">Back to Home</a>
</div>

</div>
</div>
</div>
<style>
#car1 {
margin-top: 8px !important;
}
</style>

<?php
$header_photo = "header_photo";
include_once("../../header.php");



$p = new _classified;
if ($postid) {

$r = $p->readcreaft($postid);
//echo $p->ta->sql;
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {
// print_r($row);
$currentcountry_f = $row['spPostingsCountry'];
$currentstate_f = $row['spPostingsState'];
$currentcity_f = $row['spPostingsCity'];
}
}
}






$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);
$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
if ($res != false) {
$r = mysqli_fetch_assoc($res);
$name = $r['spProfileName'];
$icon = $r['spprofiletypeicon'];
} else {
$name = "Select Profile";
$icon = "<i class='fa fa-user'></i>";
}

//////////////////////// subscription payment

$p = new _spprofiles;

$res = $p->read($_SESSION['pid']);
if(empty($postid)){
if ($res != false) {

$r = mysqli_fetch_assoc($res);
//echo "<pre>";
//print_r($r);
$name = ucwords(strtolower($r['spProfileName']));
$icon = $r['spprofiletypeicon'];
$spdate_created = $r['spdate_created'];
$Date =  $spdate_created;
$date1 =  strtotime($Date);

$date2 =  date('Y-m-d H:i:s');
$date3 = strtotime($date2);
//echo $date1."<br>".$date3; 



$datediff = $date3  -  $date1;
//echo "<br>";
$final_date = round($datediff / (60 * 60 * 24));

if ($_SESSION['ptid'] == 1) {

$pr = new _postingviewartcraft;
$prf = $pr->profile_listing($_SESSION['pid']);
$da = $prf->num_rows;
//echo $da;
//die('gggggrrrrrrrrrrrrrrrrrrrrr');
if (5 <= $da) {

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
window.location.replace("/membership?msg=notaccess");
</script>

<?php
}
//}
}
//die('rrrrrrrrrrrrrrrrrrrrr');
} else {
// die('sssssssssssss');

$mb = new _spmembership;
$result_1 = $mb->read_artcraft($_SESSION['pid']);
$num = 0;
if ($result_1) {
$num = mysqli_num_rows($result_1);
}

if ($num >= 2) {


?>
<script>
window.location.replace("/membership?msg=notaccess");
</script>
<?php
}
}
}
}

}
}

?>
<!--Add album size-->


<div class="modal fade" id="sizeAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos no-radius">
<form action="../../album/createsize.php" method="post" id="sp-create-album" class="no-margin">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Add size</b></h4>
</div>
<div class="modal-body">

<input type="hidden" id="myprofileid" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="form-group">
<label for="spSize" class="control-label">Add Size</label>
<input type="text" class="form-control" id="spSizeTitle" name="spSizeTitle">
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button id="spaddSize" type="submit" class="btn btn-primary btn-border-radius">Add</button>
</div>
</form>
</div>
</div>
</div>
<!--Done-->
<!--Album creation modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos no-radius">
<form action="../../album/createalbum.php" method="post" id="sp-create-album" class="no-margin">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Create New Album</b></h4>
</div>
<div class="modal-body">

<input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="sppostingalbumFlag" value="<?php echo $_GET["module"]; ?>">

<div class="form-group">
<label for="spAlbumName" class="control-label contact">Album Name</label>
<input type="text" class="form-control" id="spAlbumName" name="spPostingAlbumName">
</div>

<div class="form-group">
<label for="spAlbumDescription" class="contact">Description</label>
<textarea class="form-control" id="spAlbumDescription" name="spPostingAlbumDescription"></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button id="spaddalbum" type="submit" class="btn btn-primary btn-border-radius">Add</button>
</div>
</form>
</div>
</div>
</div>
<!--Done-->

<section>
<div class="container-fluid">
<div class="row">
<div class="col-md-3 no-padding hero-bnr">
<div class="left_artform" id="leftArtFrm">
<img src="<?php echo $BaseUrl; ?>/assets/images/art/left-art-form.jpg" class="img-responsive" alt="" />
</div>
</div>
<div class="col-md-9">

<div class="row">
<div class="col-md-12">
<form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopostartcraft.php" method="post" id="sp-form-post" name="postform">
<div class="modTitle" style="padding-left: 15px;">
<h2>Module : <span>Art And Craft</span></h2>
</div>


<div class="art_form">
<h3><i class="fa fa-pencil" style="color:white;"></i>

<?php
if ($postid) {
echo "EDIT";
} else {
echo "ADD";
}
?>

PRODUCT 
<a href="<?php echo $BaseUrl . '/artandcraft'; ?>" class="pull-right" style="color: #000;">&nbsp; | &nbsp;Back to Home </a>
<a href="<?php echo $BaseUrl . '/artandcraft/dashboard/'; ?>" class="pull-right" style="color: #000;">
DASHBOARD </a>
</h3>

<div class="add_form_body">

<div class="">
<div class="">

<div class="space"></div>
<div>
<?php
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

$return_if_applicable = '1';
$return_within = '';
$is_cancellable = '';

$sippingcharge = '';
$fixedamount = '';
$weight_shipping = '';

$width_shipping = '';
$height_shipping = '';
$depth_shipping = '';


$discountphoto = "";
//echo  $_GET["postid"];

if ($postid) {
//$p = new _postingviewartcraft;
//$r = $p->read($_GET["postid"]);
//$postid = $_GET["postid"];
$con = mysqli_connect(DOMAIN, UNAME, PASS);
mysqli_select_db($con, DBNAME);
$sql = "SELECT * FROM `sppostingsartcraft` WHERE idspPostings=$postid";
$r = mysqli_query($con, $sql);

if ($r != false) {


while ($row = mysqli_fetch_assoc($r)) {

//die("--------------fdjkdseh-555-----------");

echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";

$spProfiles_idspProfiles = $row["spProfiles_idspProfiles"];
//echo $idspPostings ;
if ($_SESSION['pid'] != $spProfiles_idspProfiles) {

header("Location: $BaseUrl/artandcraft/dashboard/index.php");
}
//print_r($row);
//echo "<pre>";
$ad_type = $row["ad_type"];
$ePostTitle = $row["spPostingTitle"];
$ePostNotes = $row["spPostingNotes"];
$eExDt = $row["spPostingExpDt"];
$ePrice = $row["spPostingPrice"];
$profileid = $row['idspProfiles'];
$postingflag = $row['spPostingsFlag'];
$phone = $row['spPostingPhone'];
$shipping = $row['sppostingShippingCharge'];
$eCountry = $row['spPostingsCountry'];
$eCity = $row['spPostingsCity'];
$discountphoto = $row['discountphoto'];
$craftcategory = $row['craftcategory'];
$artsubcategoryid = $row['subcategoryforart'];
$craftsubcategoryid = $row['subcategoryforcraft'];

$return_if_applicable = $row['return_if_applicable'];
$return_within = $row['return_within'];
$is_cancellable = $row['is_cancellable'];

$sippingcharge = $row['sippingcharge'];
$fixedamount = $row['fixedamount'];
$weight_shipping = $row['weight_shipping'];

$width_shipping = $row['width_shipping'];
$height_shipping = $row['height_shipping'];
$depth_shipping = $row['depth_shipping'];

$usercountry = $row["spPostingsCountry"];
//echo $userstate = $row["spPostingsState"]; 
$usercity = $row["spPostingsCity"];

$imagecost = $row["imagecost"];
/*$usercity = $row["spPostingsCity"];
$usercity = $row["spPostingsCity"];
*/
//die('============');
//get orgaizer id
$pf  = new _postfield;
$result_pf = $pf->read($postid);
//echo $pf->ta->sql."<br>";
$organizerId = "";
$categoryid = "";



$mediam = "";
$artSoldBy = "";
$mediaPrinted = "";
$frameType = "";
$quantity = "";
if ($result_pf) {


while ($row2 = mysqli_fetch_assoc($result_pf)) {

if ($organizerId == '') {
if ($row2['spPostFieldName'] == 'spPostingEventOrgId_') {
$organizerId = $row2['spPostFieldValue'];
}
}
if ($categoryid == '') {
if ($row2['spPostFieldName'] == 'photos_') {
$categoryid = $row2['spPostFieldValue'];
}
}
if ($mediam == '') {
if ($row2['spPostFieldName'] == 'medium_') {
$mediam = $row2['spPostFieldValue'];
}
}
if ($artSoldBy == '') {
if ($row2['spPostFieldName'] == 'spArtsoldby_') {
$artSoldBy = $row2['spPostFieldValue'];
}
}
if ($mediaPrinted == '') {
if ($row2['spPostFieldName'] == 'mediaprinted_') {
$mediaPrinted = $row2['spPostFieldValue'];
}
}
if ($frameType == '') {
if ($row2['spPostFieldName'] == 'framingtype_') {
$frameType = $row2['spPostFieldValue'];
}
}
if ($quantity == '') {
if ($row2['spPostFieldName'] == 'quantity_') {
$quantity = $row2['spPostFieldValue'];
}
}
}
}
}
}
}
$p = new _spprofiles;
$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);

if ($res != false) {
$r = mysqli_fetch_assoc($res);
$profileid = $r['idspProfiles'];
$country = $r["spProfilesCountry"];
$city = $r["spProfilesCity"];
}
?>
<?php
if ($postid == '' || $postid == 0) {
?>
<input type="hidden" id="spPostingExpDt" name="spPostingExpDt" value="<?php echo date('Y-m-d', strtotime('+30 days')); ?>">
<?php } else {
if ($_GET['exp'] == 1) { ?>
<input type="hidden" id="spPostingExpDt" name="spPostingExpDt" value="<?php echo date('Y-m-d', strtotime('+30 days')); ?>" --->
<?php } else { ?>
<input type="hidden" id="spPostingExpDt" name="spPostingExpDt" value="<?php echo $eExDt; ?>"===>
<?php }
}
?>

<input type="hidden" id="postid" value="<?php if (isset($_GET['postif'])) {
// echo $_GET["postid"];
} ?>">
<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
<input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">

<input type="hidden" name="spuser_idspuser" value="<?php echo $_SESSION['uid']; ?>">

<input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
<?php
if ($postid) {
echo "<input id='idspPostings' name='idspPostings' value=" . $postid . " type='hidden' >";
}
?>
<!--Art Gallery-->
<!--Art Gallery complete-->

<?php




?>
<div class="row no-margin frm-bdy">
<div class="col-md-12 no-padding ">
</div>

<div class="col-md-6 tab-data">
<div class="form-group">

<label class="lbl_7a">Type</label>
<label class="radio-inline">
<input <?php if ($postid) {
    echo'disabled="disabled"';
if ($ad_type == 1) {
echo 'checked="checked"';
}
} else {
echo 'checked="checked"';
}  ?> checked="checked" type="radio" name="ad_type" id="forart" value="1">Art
<!-- 1 for Art -->
</label>
<label class="radio-inline">
<input type="radio" <?php 
if ($postid) {
    echo'disabled="disabled"';
if ($ad_type == 2) {
echo 'checked="checked"';
}  } ?> name="ad_type" id="forcraft" value="2">Craft
<!-- 2 for Craft -->
</label>

<!----<input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle"  value="<?php echo $ePostTitle ?>" placeholder="" required />--->
<a id="mbl_phn" style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>
</div>
</div>
<div class="col-md-6 text-right">

<input type="hidden" value="" name="saveasdraft" id="saveasdraft">

<a id="dsk_phn" style="cursor:pointer; color: #337ab7;" data-toggle="modal" data-target="#myModal">Change Location</a>
<div style="margin-left: 40px;margin-right: -15px;">
<!--<p >
<?php
if ($_SESSION["Country"]) {
$usercountry = $_SESSION["Country"];
}
//echo $usercountry;
if ($_SESSION["State"]) {
$userstate = $_SESSION["State"];
}
//echo $userstate;
//die('======');
if ($_SESSION["City"]) {
$usercity = $_SESSION["City"];
}
//echo $usercity;		
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
//print_r($row3);


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
while ($row2 = mysqli_fetch_assoc($result2)) { //print_r($row2);
//die('===');
if (isset($userstate) && $userstate == $row2["state_id"]) {
$currentstate_id = $row2["state_id"];
$currentstate = $row2["state_title"];
//echo $currentstate;		
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
//print_r($row3);
if (isset($usercity) && $usercity == $row3['city_id']) {
$currentcity = $row3['city_title'];
//echo $currentcity;
$currentcity_id = $row3['city_id'];
}
}
}
};
?>

</p>-->

<p>

<small style="font-size: medium;">
<!--Current Location: -->

<?php
if ($currentcity) {
echo $currentcity;
}
if ($currentstate) {
echo ', ' . $currentstate;
}
if ($currentcountry) {
echo ', ' . $currentcountry;
}

//echo $currentcity.', '.$currentstate.', '.$currentcountry; 
//echo $result;


?>
<br>
</small>
</p>

</div>

<input type="hidden" name="spPostingsCountry" id="spUserCountry1" value="<?php echo $usercountry; ?>">
<input type="hidden" name="spPostingsState" id="spUserState1" value="<?php echo $userstate; ?>">
<input type="hidden" name="spPostingsCity" id="spUserCity1" value="<?php echo $usercity; ?>">

<!--<p><small>

<a style="cursor:pointer;" data-toggle="modal" data-target="#myModal">Change Location</a>
</small>
</p>-->
</div>
<div class="col-md-12">
<div class="form-group">
<!--<label for="spPostingTitle" class="lbl_1">Currency</label><span style="color:red;"> * </span>-->

<?php

$bc = new _currency;
$uid = $_SESSION['uid'];

$dataucurrency = $bc->readCurrencyuser($uid);
$rowucurrency = mysqli_fetch_array($dataucurrency);

?>
<input type="hidden" readonly class="form-control" value="<?php echo $rowucurrency['currency']; ?>" name="defaltcurrency">

</div>
</div>
<div class="col-md-12">

<div class="form-group frm-left">
<label for="spPostingTitle" class="lbl_1">Title</label><span id="addtitle" style="color:red;"> * </span>

<input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle" value="<?php echo $ePostTitle ?>" placeholder="" required maxlength="60" />

</div>
</div>


<!-- <div class="row">
<div class="col-md-4">
<div class="form-group">
<label for="spPostingCountry" class="lbl_2">Country</label>
<select id="spUserCountry" class="form-control " name="spPostingsCountry">
<option value="">Select Country</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id']) ? 'selected' : ''; ?>   ><?php echo $row3['country_title']; ?></option>
<?php
}
}
?>
</select>--->
<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
<!----</div>
</div>
<div class="col-md-4">
<div class="loadUserState">
<label for="spPostingCity" class="lbl_3">State</label>
<select class="form-control" name="spPostingsState">
<option>Select State</option>
<?php
if (isset($userstate) && $userstate > 0) {
$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($countryId);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"]) ? 'selected' : ''; ?> ><?php echo $row2["state_title"]; ?> </option>
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
<select class="form-control" name="spPostingsCity" >
<option>Select City</option>
<?php
if (isset($usercity) && $usercity > 0) {
$stateId = $userstate;
$co = new _city;
$result3 = $co->readCity($stateId);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row3['city_id']) ? 'selected' : ''; ?> ><?php echo $row3['city_title']; ?></option> <?php
}
}
} ?>
</select>--->
<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> 
</div>
</div>
</div>-->
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
</div> 

</div> -->



<!-- <div class="row">
<div class="col-md-6">
<div class="form-group">
<label for="spPostingArtType_">Join Art</label>
<select class="form-control artType spPostField" name="spPostingArtType_" id="spPostingArtType_" >
<option value="-1">None</option>
<option value="-2">Exibition</option>
<option value="-3">Event</option>
</select>
</div>
</div>
<div id="eventDiv">  

</div>

</div> -->
<div class="addcustomfields">
<!--add custom fields-->
<?php
if ($postid) {
$f = new _postfield;
$res = $f->field($postid);
if ($res != false)
while ($result = mysqli_fetch_assoc($res)) {
$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
//$idspPostField = $result["idspPostField"];
}
}

include("../photos-images.php");   
?>
<!--Getcustomfield-->
</div>


<div class="col-md-3">
<div class="form-group">
<label class="lbl_7a">Shipping Charge</label> <br>
<label class="radio-inline">
<input checked="checked" type="radio" id="forfreeshipping" name="sippingcharge" <?php if ($sippingcharge == 1) {
echo 'checked="checked"';
} ?> value="1">Free
<!-- 1 for Art -->
</label>
<label class="radio-inline">
<input type="radio" id="forfixedamountshipping" name="sippingcharge" <?php if ($sippingcharge == 2) {
echo 'checked="checked"';
} ?> value="2">Fixed Amount
<!-- 2 for Craft -->
</label>
<!--label class="radio-inline" style=" margin-left: 0px; ">
<input type="radio" id="forpercompanyahipping" name="sippingcharge" <?php if ($sippingcharge == 3) {
echo 'checked="checked"';
} ?>  value="3">Per Shipping Company
< 3 for Craft -->
</label>
</div>
</div>


<div class="col-md-9" id="forhideandshowshippingforbhak">
<div class="row">
<div class="col-md-6">



<div class="form-group">
<div id="ifYes">
<label for="quantity_" class="error_fixedamount">Add Fixed Amount<span class="red">*</span></label>
<input style=" width: 100px; " id="fixd_amount" onkeypress="return onlyNumberKey(event)" maxlength="5" type="text" class="form-control" name="fixedamount" value="<?php echo $fixedamount; ?>" placeholder="" required />
</div>
</div>
</div>

</div>
</div>

<div class="col-md-9" style="display: none;" id="forhideandshowshipping">
<div class="row">
<div class="col-md-6">

<label for="" class="">Add Weight And Size For Shipping</label>

<div class="row">
<div class="col-md-6">

<div class="form-group">
<div id="ifYes">
<label for="quantity_" class="lbl_8">Weight(G) </label>
<input onkeyup="numericFilter(this);" type="text" class="form-control" name="weight_shipping" value="<?php echo $weight_shipping; ?>" placeholder="" required />
</div>
</div>
</div>

<div class="col-md-6">
<div class="form-group">
<div id="ifYes">
<label for="quantity_" class="lbl_8">Width </label>
<input onkeyup="numericFilter(this);" type="text" class="form-control" name="width_shipping" value="<?php echo $width_shipping; ?>" placeholder="" required />
</div>
</div>
</div>
</div>
</div>

<div class="col-md-3" style=" margin-top: 19px; ">
<div class="form-group">
<div id="ifYes">
<label for="quantity_" class="lbl_8">Height </label>
<input onkeyup="numericFilter(this);" type="text" class="form-control" name="height_shipping" value="<?php echo $height_shipping; ?>" placeholder="" required />
</div>
</div>
</div>

<div class="col-md-3" style=" margin-top: 19px; ">
<div class="form-group">
<div id="ifYes">
<label for="quantity_" class="lbl_8">Depth </label>
<input onkeyup="numericFilter(this);" type="text" class="form-control" name="depth_shipping" value="<?php echo $depth_shipping; ?>" placeholder="" required />
</div>
</div>
</div>
</div>
</div>





<div class="col-md-12">
<div class="form-group frm-left">
<label for="spPostingNotes">Description</label>
<textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="1500" equired><?php echo $ePostNotes ?> </textarea>
</div>
</div>

<!--Testing-->

<!--Testing Complete-->
<div class="col-md-3">
<div class="form-group frm-left">
<label for="postingpic" class="error_fix" >Add Images</label><span style="color:red; font-size:15px;">*</span>

<input type="file" class="postingpic" name="spPostingPic[]" multiple="multiple" <?php if ($postid) { ?> <?php } else { ?> id="ppostingpicimage" <?php } ?> required>
<input type="hidden" <?php if ($postid) { ?> id="ppostingpicimage" <?php } ?> value="ok">
<p class="help-block"><small>Browse files</small></p>
</div>
</div>
<div class="col-md-9">
<div class="form-group">
<label for="postingPicPreview">Picture Preview</label>
<div id="imagePreview"></div>
<div id="postingPicPreview">
<div class="row">
<div id="">
<?php
echo "<div class='row no-margin' id='dvPreview'>";
if ($postid) {
$pic = new _postingpicartcraft;
$res = $pic->read($postid);
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$picture = $rows['spPostingPic'];
echo "<div class='col-md-2 imagepost'>
<span class='glyphicon glyphicon-remove closed' data-pic='" . $rows['idspPostingPic'] . "'   data-work='imgpostpvs' data-aws='7'  data-src='" . $picture . "' style='color:black;background:white;padding:2px;'></span>
<img style='width:100px; height: 100px; margin-right:5px;;' src='" . ($picture) . "' class='overlayImage'>
</div>";
}
}
}

echo "</div>";
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


</div>
</div>

</div>



<div class="row no-margin">
<div class="col-md-3">
<!--<button type="submit" id="preview" class="btn btn-info">Preview</button>-->
<!-- <div class="btn-group">
<button id="spPostSubmit" type="submit" class="btn btn-success">Public Post</button>-->
<!-- <button id="postingtype" type="button" class="btn btn-success <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public</button>

<button type="button" class="btn  btn-success dropdown-toggle <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false" style="height: 34px;"><span class="caret"></span></button>
<ul class="dropdown-menu posttype">
<li><a id="postpublic" style="cursor:pointer;">Public</a></li>
<li><a id="postgroup" style="cursor:pointer;">Group</a></li>
</ul> -->
<!-- </div> -->
</div>
<div class="col-md-4">
<div id="sp-group-container" class="input-group hidden">
<input class="form-control" id='group_' name="group_" type="text" placeholder="Type to Select Group...">

<span class="input-group-btn">
<!--<button class="btn btn-default" type="button" data-toggle="modal" data-target="#addGroup">Add New</button>-->
<a href="../../my-groups/" class="btn btn-default" type="button">Add New</a>
</span>
</div>
</div>
<div class="col-md-6 text-right"></div>
<div class="col-md-6 text-right">
<!-- <button id="spPostSubmit" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Repost" : "Submit") ?></button> -->
<a href="<?php if(isset($_SESSION['sign-up']) && $_SESSION['sign-up'] == 1) { echo $BaseUrl . '/registration-steps.php?pageid=8'; } else {echo $BaseUrl . '/artandcraft/dashboard'; }?>" class="btn btn-danger btn-border-radius btn-prmy" style="min-width:82px!important;">Cancel</a>
<?php
  $proprofile = selectQ("select * from spprofessional_profile where spprofiles_idspProfiles = ?", "i", [$_SESSION['pid']], "one");
  if(isset($proprofile) && !empty($proprofile)){
    $proffesionalAc = 0;
  }
?>
<input type="hidden" id="proValidation" value="<?php if($proffesionalAc == 1) { echo 1; } else { echo 0; } ?>">
<?php if (!isset($_SESSION['sign-up']) || $_SESSION['sign-up'] != 1) { ?>
<button id="spPostSavedraftPhoto" type="button"class="btn btn-primary btn-border-radius  <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Save As Draft" : "Save As Draft") ?></button>
 <?php } ?>
<?php if(isset($_GET["exp"]) == 1) {?>
<button style="color:white;" id="spPostSubmitPhoto" type="button" class="btn btn-primary btn-border-radius <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Repost" : "Submit") ?></button>
<?php } else{?>
	<button style="color:white;" id="<?php if($proffesionalAc == 1) { echo "spPostSubmitPhotoPro"; } else { echo "spPostSubmitPhoto"; } ?>" type="button" class="btn btn-primary btn-border-radius <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Update" : "Submit") ?></button>
<?php } ?>
<!-- <button id="spSaveDraft" type="submit" class="btn butn_draf">Save Draft</button> -->

<!-- <button type="reset" class="btn butn_cancel">Cancel Post</button> -->

<div id="myModals" style="display:none;" class="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title2 text-center" style="margin-bottom: 10px; margin-top: 10px; ">Create Professional Profile</h5>
          <div class="form-group">
            <label for="pro_profilename" class="text-left proname">Professional Profile Name</label>
            <input type="text" class="form-control" id="pro_profilename" name="spProfileName" aria-describedby="emailHelp" placeholder="Enter Name" value="<?php if(isset($username) && $proffesionalAc == 1){ echo $username; }?>" required>
          </div>
          <div class="form-group text-start py-lg-1 py-0 cntry_clm_2">
            <div class="">
              <label for="carrerhighlight" class=" my-2 text-capitalize carrerhighlight">Career Highlights<span class="req_star">*</span></label>
              <input type="text" class="form-control" name="carrerhighlight" id="pro_highlights" required>
            </div>
            <div class="form-group">
              <div class="">
                <label for="pro_category" class="my-2 text-capitalize careercat">Career Category<span class="req_star">*</span></label>
                <select class="form-control" id="pro_category" name="category"  aria-label="Default select example" required>
                <option value="">Select Category</option>
                <?php
	                $m = new _masterdetails;
                  $result = $m->read(25);
                  if($result != false){
                    while($rows = mysqli_fetch_assoc($result)){ ?>
                      <option value='<?php echo $rows["idmasterDetails"]; ?>'><?php echo ucfirst(strtolower($rows["masterDetails"]));?></option><?php
                    }
                  }
                ?>
                </select>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button  id="spPostSubmitPhoto" type="button" class="btn butn_save btn-border-radius">Submit
        <button id="spPostSubmitPhotoProClose"  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

</div>
</div>

</form>
</div>



</div>
</div>
</div>
</section>


<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Change Current Location <?php //echo $usercountrypost.'=='; 
?></h4>
</div>
<!----action="<?php echo $BaseUrl ?>/post-ad/dopost.php"--->
<div class="modal-body">
<form action="" method="POST">
<div class="row">

<div class="col-md-4">
<div class="form-group">
<label for="spPostCountry_" class="lbl_2">Country</label>
<select class="form-control " name="spPostingsCountry" id="spUserCountry">
<option value="">Select Country </option>
<?php


$co = new _country;
// print_r($co);    
$result3 = $co->readCountry();

if ($result3 != false) {

// echo $currentcountry.'============';
while ($row3 = mysqli_fetch_assoc($result3)) {
// 	$currentcountry_f;   
// 	print_r($row3);
// die('hhhhh'); 
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
<label for="spPostingCity" style="float:left;" class="lbl_3">State</label>
<select class="form-control spPostingsState" name="spPostingsState" id="spUserState">
<option>Select State</option>
<?php


$countryId = $usercountry;
$pr = new _state;
$result2 = $pr->readState($usercountry);
if ($result2 != false) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && $userstate == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
<?php
}
}

?>
</select>
</div>
</div>
<div class="col-md-4">
<div class="loadCity">
<div class="form-group">
<label for="spPostingCity" style="float: left;" class="">City</label>
<select class="form-control" name="spPostingsCity" id="spUserCity">
<option>Select City</option>
<?php
// $stateId = $userstate;

$co = new _city;
$result3 = $co->readCity($userstate);
//echo $co->ta->sql;
if ($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && $usercity  == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                    }
                                } ?>
</select>

<!--													  <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php // echo (isset($eCity) ? $eCity : $city); 
?>">   -->
</div>
</div>
</div>

</div>
</div>
<div class="modal-footer">
<!--<button type="submit" class="btn btn-primary"  name ="changelc" >Change</button>-->
<button type="button"  class="btn btn-danger btn-border-radius"  data-dismiss="modal">Cancel</button>

<button type="submit" name="btn_save" class="btn btn-success btn-border-radius">Save</button>

</div>
</form>
</div>

</div>
</div>

<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
<script>
var ad_type = $("input[name='ad_type']:checked").val();

if (ad_type == 1) {
$("#artcateforhideshow").show();
$("#craftcateforhideshow").hide();

$("#forMedium").show();
$("#forartsoldby").show();
$("#forExpirayDate").show();
$("#forMediaPrintedyear").show();
$("#forFramingType").show();
}
if (ad_type == 2) {
$("#artcateforhideshow").hide();
$("#craftcateforhideshow").show();


$("#forMedium").hide();
$("#forartsoldby").hide();
$("#forExpirayDate").hide();
$("#forMediaPrintedyear").hide();
$("#forFramingType").hide();
}


/*$(function() {
var $radios = $('#forcraft');
if($radios.is(':checked') === true) {
$("#artcateforhideshow").hide(); 
$("#craftcateforhideshow").show(); 


$("#forMedium").hide(); 
$("#forartsoldby").hide(); 
$("#forExpirayDate").hide(); 
$("#forMediaPrintedyear").hide(); 
$("#forFramingType").hide(); 
}
});*/


$('#forart').click(function() {
$("#artcateforhideshow").show();
$("#craftcateforhideshow").hide();

$("#forMedium").show();
$("#forartsoldby").show();
$("#forExpirayDate").show();
$("#forMediaPrintedyear").show();
$("#forFramingType").show();
});

$('#forcraft').click(function() {
$("#artcateforhideshow").hide();
$("#craftcateforhideshow").show();


$("#forMedium").hide();
$("#forartsoldby").hide();
$("#forExpirayDate").hide();
$("#forMediaPrintedyear").hide();
$("#forFramingType").hide();
});

function loadDocReturn(id) {

if (id == 0) {
document.getElementById("ifYes").style.display = "none";
$('#return_within_iid').val('');
}
if (id == 1) {
document.getElementById("ifYes").style.display = "block";
}
}


$('#forfreeshipping').click(function() {
$("#forhideandshowshipping").hide();
$("#forhideandshowshippingforbhak").hide();
});
$('#forfixedamountshipping').click(function() {
$("#forhideandshowshipping").hide();
$("#forhideandshowshippingforbhak").show();
});
$('#forpercompanyahipping').click(function() {
$("#forhideandshowshipping").show();
$("#forhideandshowshippingforbhak").hide();
});

if ($('#return_if_applicable_iid').is(':checked')) {
document.getElementById("ifYes").style.display = "none";
}

if ($('#forart').is(':checked')) {
document.getElementById("craftcateforhideshow").style.display = "none";
}
if ($('#forcraft').is(':checked')) {
document.getElementById("artcateforhideshow").style.display = "none";
}

if ($('#forfreeshipping').is(':checked')) {
document.getElementById("forhideandshowshipping").style.display = "none";
document.getElementById("forhideandshowshippingforbhak").style.display = "none";
}
</script>


</body>

</html>
<?php
} ?>
