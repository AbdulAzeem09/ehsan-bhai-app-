<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

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

//$p = new _postingview;  

$sf = new _freelancerposting;

$fps = new _freelance_project_status;

$r = new _redirect;

$postId = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;

$res = $sf->singletimelines1($postId);

//echo $p->ta->sql;
if ($res) {
$row = mysqli_fetch_assoc($res);
if ($_SESSION['pid'] != $row['idspProfiles']) {

// $url = $r->redirect($BaseUrl.'/freelancer/dashboard/active-bid.php');
}
$title = $row['spPostingtitle'];
} else {
// $url = $r->redirect($BaseUrl.'/freelancer/dashboard/active-bid.php');
}
// $activePage = 18;
//echo $_SESSION["uid"]; exit;


if ($postId > 0) {
//$p = new _postingview;
$sf  = new _freelancerposting;

// $r = $p->read($_GET["postid"]);

$r = $sf->read1($postId);

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

// header("Location: $BaseUrl/freelancer/dashboard/poster_dashboard.php?msg=notacess");
}
}
}
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>
<!--This script for posting timeline data End-->
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
Stripe.setPublishableKey('<?php echo PUBLIC_KEY ?>');

function checkqty(txb) {
var qty = parseInt(txb);
var actualQty = $("#spOrderQty").val();
//alert(actualQty);return false;
//console.log(actualQty);
if (qty > actualQty) {
document.getElementById("newValue").value = actualQty;
}
if (qty < 1) {
document.getElementById("newValue").value = 1;
//alert("less");
}

$('#payqty').val($('#newValue').val());
}

function checkqtynew(txb, limit, id) {
var qty = parseInt(txb);

if (qty > limit) {
document.getElementById("newValue" + id).value = limit;
alert("you can not enter more than available qty");
}
if (qty < 1) {
document.getElementById("newValue" + id).value = 0;
//  alert("please enter more than 1 qty");
}
if (qty == "") {
document.getElementById("newValue" + id).value = 0;
//  alert("please enter more than 1 qty");
}


}

function checkqty() {
$checkboxTicket_Type = $('.Ticket_Typenew');
var chkArray = [];
chkArray = $.map($checkboxTicket_Type, function(el) {
return el.value;
});
var totval = 0;
$.each(chkArray, function(key, value) {

totval = totval + value;

});
if (totval > 0) {
return true;
} else {
alert("Please enter some ticket quantity.");
return false;
}

}
</script>
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>

<style>
.cls {}

/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}
.star1
{
font-size: 18px;
border-radius: 10px 10px 10px 10px;
margin-left: -15px;
color: #b0b016;
}
/* Style the buttons inside the tab */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display: none;
border: 1px solid #ccc;
border-top: none;
}

.btn-info {
background-color: #e97524;
border-color: #c45508;
}

.btn-info:hover {
color: #fff;
background-color: #e97524;
border-color: #e97524;
}
.swal2-popup {
font-size:1.5rem!important;
}

.dashboardpage .dashboard-section .dashboardtable .table thead tr th {
font-size: 14px;
}
.table tbody tr td {
vertical-align : none!important;
font-size: 18px!important;
}
</style>
</head>

<body class="bg_gray">
<?php
$header_select = "freelancers";
include_once("../../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">
<div class="sidebar col-xs-3 col-sm-3" id="sidebar">
<?php include('left-menu.php'); ?>
</div>
<div class="col-xs-12 col-sm-6 nopadding   111">
<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard/active-bid.php">Active Projects</a></li>
<li>Details </li>
</ul>
</div>
<?php if ($_SESSION['awarded'] == 1) { ?>
<div class="col-xs-12 dashboardbreadcrum fgfgf">
<div class="alert alert-success">
Project Awarded Successfully.

</div>
</div>
<script>
setTimeout(function() {
$(".fgfgf").hide();
}, 3000);
</script>
<?php unset($_SESSION['awarded']); } 

?>
<?php if ($_SESSION['awarded'] == 2) { ?>
<div class="col-xs-12 dashboardbreadcrum fgfgf">
<div class="alert alert-danger">
Project Rejected Successfully.

</div>
</div>
<script>
setTimeout(function() {
$(".fgfgf").hide();
}, 3000);
</script>
<?php unset($_SESSION['awarded']); } 

?>
</div>
<!--  <div class="col-sm-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php //echo $BaseUrl; 
?>/freelancer/dashboard/">Dashboard</a></li>
<li><a href="<?php //echo $BaseUrl; 
?>/freelancer/dashboard/active-bid.php">Active Bids</a></li>
<li><?php //echo $title; 
?></li>
</ul>
</div>
</div> -->



<div class="tab">
<button class="tablinks" onclick="openCity(event,'projDetail')" id="tabclick">Project Details</button>

<button class="tablinks " id="bid" onclick="openCity(event,'bids3')">Bids</button>

<?php
$sf = new _freelancerposting;
$sff = new _freelance_project_status;


$res_data1 = $sff->readAceptid_accpted($postId, $_SESSION["pid"]);


if ($res_data1) {

?>
<button class="tablinks" onclick="openCity(event,'mstone')">Milestone</button>
<?php
}




$res_data = $sf->singletimelines1($postId);

if ($res_data) {
$row_data = mysqli_fetch_assoc($res_data);

if ($_SESSION["pid"] == $row_data['spProfiles_idspProfiles']) {

?>
<button class="tablinks" onclick="openCity(event,'mstone')">Milestone</button>

<?php }
} ?>



<button class="tablinks" id="tabclick12" onclick="openCity(event,'review_rating_new')">Review</button>


</div>
<div id="projDetail" class="tabcontent">
<div class="col-xs-12 nopadding dashboard-section">
<div class="">
<h1 style="margin-left: 8px;">This is Project details tab</h1>
<?php
//$p = new _postingview;
$sf = new _freelancerposting;
$sp = new _spprofiles;
// $res = $p->singletimelines($_GET['postid']);
$res = $sf->singletimelines1($postId);

//echo $p->ta->sql;
$row = array();
$row5 = array();
// $profilesname = array();
// echo $sf->ta->sql;
//echo $p->ta->sql;
if ($res) {
$row = mysqli_fetch_assoc($res);
//echo $_SESSION["pid"];
//echo "<pre>"; print_r($row); exit;
$title = $row['spPostingTitle'];
$overview = $row['spPostingNotes'];

$price = $row['spPostingPrice'];
$dt = new DateTime($row['spPostingDate']);
$member = new DateTime($row['spProfileSubscriptionDate']);
$clientId = $row['idspProfiles'];

//$pf = new _postfield;
$result_pf = $sf->read1($row['idspPostings']);

$get_profile = $sp->get_user_id($row['spProfiles_idspProfiles']);
//echo $sp->ta->sql;
if($get_profile){
$profilesname = mysqli_fetch_assoc($get_profile);
}
//echo "<pre>"; print_r($profilesname); exit;
//echo $pf->ta->sql."<br>";
if ($result_pf) {
$closingdate = "";
$Fixed = "";
$Category = "";
$hourly = "";
$skill = "";
$projectType = "";

while ($row22 = mysqli_fetch_assoc($result_pf)) {
if ($closingdate == '') {
//if($row2['spPostFieldName'] == 'spClosingDate_'){
//$closingdate = $row2['spPostFieldValue']; 
$closingdate = $row22['spPostingExpDt'];
//}
}
/* if($Fixed == ''){
if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
if($row2['spPostFieldValue'] == 1){
$Fixed = "Fixed";
}
}
} */
if ($Fixed == '') {

if ($row22['spPostingPriceFixed'] == 1) {
$Fixed = "Fixed Rate";
} else {
$hourly = "Hourly Rate";
}
}
if ($Category == '') {
/* if($row2['spPostFieldName'] == 'spPostingCategory_'){
$Category = $row2['spPostFieldValue'];
} */
$Category = $row22['spPostingCategory'];
}
/* if($hourly == ''){
if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
if($row2['spPostFieldValue'] == 1){
$hourly = "Rate Per hour";
}
}
} */
if ($skill == '') {
/* if($row2['spPostFieldName'] == 'spPostingSkill_'){
$skill = explode(',', $row2['spPostFieldValue']);
} */

$skill = explode(',', $row22['spPostingSkill']);
}
if ($projectType == '') {
if ($row2['spPostFieldName'] == 'spPostingProfiletype_') {
$projectid = $row22['spPostFieldValue'];
}
}
}
$postingDate = $sf->get_timeago1($row["spPostingDate"]);
}
}
?>
<div class="col-xs-12 freelancer-post-detail">
<h2 class="designation-haeding freelancer_capitalize">
<?php echo $title; ?>
<div style="font-size:15px; float:right">
<?php
if ($_SESSION["pid"] != $row['spProfiles_idspProfiles']) {
?>
<?php echo $profilesname["spProfileName"]; ?>
<br><a href="<?php echo $BaseUrl . '/business-directory/detail.php?business=' . $profilesname["idspProfiles"]; ?>">Business Profile</a>
<?php if ($row['complete_status'] == 1) { ?>
<br><span>Project - Close</span>
<?php } else { ?>
<br><span>Project - Open</span>
<?php } ?>
<?php } ?>
<?php
$acceptpr = $fps->readAceptproject($postId);

if ($acceptpr != FALSE) {
//echo 1;
if ($row['complete_status'] == 0) {
//echo 2;
?>
<?php
//$getid1=$_GET['postid'];

if ($_SESSION['ptid'] != 2) {
// echo 3;
?>
<a class="btn btn-warning incomplete2" style="float:right;color: #fff;" onclick="myInComplete('<?php echo $BaseUrl . "/freelancer/dashboard/complete_posted_project.php?status=2&postid=" . $postId; ?>')">In Complete</a>&nbsp;&nbsp;

<a class="btn btn-info complete3" style="float:right;color: #fff;margin-right: 10px;" onclick="myComplete('<?php echo $BaseUrl . "/freelancer/dashboard/complete_posted_project.php?status=1&postid=" . $postId; ?>')">Complete</a>




<?php  } ?>
<?php
} else if ($row['complete_status'] == 1) {

echo "<br><span style='font-size:15px;float:right;'>Project is Completed</span>";
?>
<br><br>
<?php
$p_review = new _contact;
$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];
$read_review = $p_review->read_review_rating_button($postId,$pid);
if (!$read_review) {
$num_review = $read_review->num_rows;



?>

<button class="btn btn-primary" onclick="openmodal()" >Review</button>


<?php

}
} else {

echo "<br><span style='font-size:15px;float:right;'>In Completed</span>";
}
}
?>
</div>
</h2>
<!--      <p class="timing-week"><?php // echo ($Fixed != '')? $Fixed: $hourly;
                        ?></p>   -->
<div class="col-xs-12 nopadding">
<?php
if (count($skill) > 0) {
foreach ($skill as $key => $value) {
if ($value != '') {
echo "<span class='skills-tags freelancer_uppercase'>" . $value . "</span>";
}
}
}
?>
</div>
<div class="col-xs-12 nopadding margin-top-13">
<div class="col-xs-12 col-sm-6 nopadding 2222">
<!--  <div class="col-xs-2 col-sm-1 nopadding">
<img src="<?php echo $BaseUrl ?>/assets/images/freelancer/timer.png">
</div> -->
<div class="col-xs-10 col-sm-11 nopadding">
<p><span class="time-level">Category</span>
</p>
<p class="time-level-detail"><?php echo $Category; ?></p>
</div>
</div>
<div class="col-xs-12 col-sm-6 nopadding 3333">
<div class="">
<!--    <p>$<?php // echo $price;
        ?></p> -->
</div>
</div>
</div>
<div class="col-xs-12 detail-description text-justify">
<p style=" word-break: break-all;"><?php echo $overview; ?></p>
</div>
</div>
</div>
</div>
</div>

<?php if ($_GET['action'] == 'a_bid') {



?>
<script>
setTimeout(function() {
$('#bid').click();
document.getElementById('bid').className += ' active';

}, 500);
</script>

<?php } ?>

<div id="bids3" class="tabcontent">
<?php //if ($_SESSION["pid"] == $row['spProfiles_idspProfiles']) {
// $post = new _postings;
$sf = new _freelancerposting;
$result = $sf->chkProjectStatus1($row['idspPostings']);

$result_status = $fps->getstatus($row['idspPostings']);

//echo "<pre>"; print_r($result_status); exit;                                      
//echo $fpsss->ta->sql;
if (empty($result_status)) {
$status_on_bid = 0;
} else {
$status_on_bid = mysqli_fetch_assoc($result_status);
}
//echo $status_on_bid['status'];
//echo "<pre>"; print_r($status_on_bid);
//exit;
?>
<?php if ($result == true) {
?>
<?php
$curnt_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//echo $curnt_url;
//die();

if (isset($_GET['sort'])) {

$curnt_url = substr($curnt_url, 0, strpos($curnt_url, "&"));

// $curnt_url;
}
//die();
?>
<!--  <h2>Bids</h2>  -->
<div class="col-sm-12 nopadding dashboard-section">
<div class="col-xs-12 dashboardtable">
<div>
<button type='button' id='toggle' value='hide/show' class="btn btn-primary" style="float: right;margin-right: 5px;margin-top: 3px;">More Filters &nbsp;<i class="fa fa-caret-down"></i></button>
<br>
<br>
<div style="float: right;margin-right: 15px;" id="content">
<a href=<?php echo $curnt_url . "&sort=lowestbid&action=a_bid";  ?>>Lowest Bid </a><br>
<a href=<?php echo $curnt_url . '&sort=highestbid&action=a_bid'; ?>>Highest Bid </a><br>
<a href=<?php echo $curnt_url . '&sort=latestbid&action=a_bid'; ?>>Latest Bid </a><br>
<a href=<?php echo $curnt_url . '&sort=oldbid&action=a_bid'; ?>>Oldest Bid </a>
</div>
</div>
<!--  <div class="table-responsive"> -->

<div class="">
<table class="table text-center tbl_activebid">
<thead>
<tr>

<th style="text-align: justify;">Freelancer</th>
<th>Bids</th>
<!--  <th>Upfront</th> -->
<th>Days Delivered</th>
<th>Chat</th>
<!--  <th style="text-align: center;">Short List</th> -->
<th class="action">Proposal</th>

<?php
if ($status_on_bid['status'] == 0 || $status_on_bid['status'] == 2 || $status_on_bid['status'] == 3) {
//echo $status_on_bid['status'];
?>
<!--     <th class="action">Cancel</th>  -->
<?php } ?>
</tr>
</thead>
<tbody>
<?php
//  $sf  = new _freelancerposting;
//$p = new _postfield;

$sf = new _freelance_placebid;
//die('jkuhgkujigb');

if ($_GET['sort']) {
$srt = $_GET['sort'];
if ($srt == 'lowestbid') {
$order = 'ORDER BY bidPrice ASC';
}
if ($srt == 'highestbid') {
$order = 'ORDER BY bidPrice DESC';
}
if ($srt == 'latestbid') {
$order = 'ORDER BY id DESC';
}
if ($srt == 'oldbid') {
$order = 'ORDER BY id ASC';
}
} else {
$order = '';
}

$res2 = $sf->readallbids($postId, $order);
if ($res2 == true) {
while ($row2 = mysqli_fetch_assoc($res2)) {
//get bid detail
$SellId = $row2['spProfiles_idspProfiles'];
$d = new _spprofiles;
$freelancerName = $d->getProfileName($row2['spProfiles_idspProfiles']);
$receiver_name = $freelancerName;
//echo $bd->ta->sql;
if ($result_pf) {
  $bidPrice = "";
  $initialPercentage = "";
  $totalDays = "";
  $coment = "";
  //chek if project is rejected
  $result4 = $fps->chekProjectReject($postId);
  //$result5 = $fps->readFreelanceProject($_GET['postid']);
  if ($bidPrice == "") {
    $bidPrice = $row2['bidPrice'];
  }
  if ($initialPercentage == "") {
    $initialPercentage = $row2['initialPercentage'];
  }
  if ($totalDays == "") {
    $totalDays = $row2['totalDays'];
  }
  if ($coment == "") {
    $coment = $row2['coverLetter'];
  }
?>
  <tr>
    <td style="text-align: left;">
      <?php if($freelancerName){ ?>
      <a class="red" href="<?php echo $BaseUrl . '/freelancer/user-newprofile.php?profile=' . $row2['spProfiles_idspProfiles']; ?>">
        <?php echo $freelancerName; ?>
        <?php }else{

                  echo "Freelancer Removed";
              }?>

    </td>
    <td><?php echo $row['Default_Currency'] . ' ' . $bidPrice; ?></td>
    <td><?php echo $totalDays; ?> Days</td>
    <td>
      <div class="col-sm-12 zoom" data-toggle="modal" data-target="#composeNewTxt" style="cursor: pointer;">
        <a href="javascript:void(0)" id="composeNewTxt1" class="red"><i class='fas fa-comment-dots'></i></a>
      </div>
    </td>
    <td>
      <?php
      $result5 = $fps->readAceptid($postId, $row2['spProfiles_idspProfiles']);
      if ($result5 == false) {
        if ($_SESSION["pid"] == $row['spProfiles_idspProfiles']) {
      ?>
          <!-- <a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>" class="btn btn-info" onclick="awarded_1('<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>')">Award</a> -->
<?php if($freelancerName){ ?>
          <button class="btn btn-info" onclick="awarded_1('<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $postId . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>')">Award</button>

<?php } ?>

          <!-- <a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=reject&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>" class="btn btn-danger">Reject</a> -->


          <!-- <button class="btn btn-danger" onclick="rejected_1('<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=reject&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>')">Reject</button> -->


        <?php
        } else {
          echo "N/A";
        }
      } else {
        $row5 = mysqli_fetch_assoc($result5);
        $fps_sta = $row5['fps_status'];
        echo $fps_sta;
        ?>
      <?php
      }
      ?>
    </td>
  </tr>
 <?php
}
}
} else {
?>
<td colspan="7" style="text-align: center;">No Bid Found</td>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
<?php }
?>
</div>
<!-- new code start -->

<div id="review_rating_new" class="tabcontent">

<div class="col-sm-12 nopadding dashboard-section">
<div class="col-xs-12 dashboardtable">
<?php
$p_review1 = new _contact;
$pid1 = $_SESSION['pid'];
$uid1 = $_SESSION['uid'];
$read_review1 = $p_review1->read_review_rating($postId);
if ($read_review1) {
while ($rating_view = mysqli_fetch_assoc($read_review1)) {

$comment = $rating_view['description'];
$reting = $rating_view['rating'];
$date = $rating_view['date'];
$pid = $rating_view['pid'];

$sp = new _spprofiles;
$result = $sp->readname($pid);

if ($result != false) {
$row1 = mysqli_fetch_assoc($result);
}

?>
<div class="comment-section">
<div class="d-flex justify-content-between align-items-center">

<div class="row ">
<div class="col-md-3" class="no-padding" style="width: 13%;margin-top: 20px;">
<?php if ($row1['spProfilePic']) { ?>
  <img src="<?php echo $row1['spProfilePic'];
            ?> " class="rounded-circle profile-image" style=" border-radius: 50%; height: 45px;width: 45px;margin-left: 15px;">
<?php } else { ?>
  <img src="<?php echo $BaseUrl ?>/assets/images/icon/blank-img.png" class="rounded-circle profile-image" style=" border-radius: 50%; height: 40px;width: 40px;margin-left: 15px;">
<?php } ?>
</div>
<div class="col-md-6" class="no-padding" style="margin-top: 10px;">
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $pid;
                                                    ?>"><span class="username">
    <?php echo $row1['spProfileName']; ?>
  </span></a>
</div>

</div>
<br>
<div class="d-flex flex-column ml-1 comment-profile" style="margin-left: 80px;">

<?php

$star = "<i class='fa fa-star'></i>  ";
$count = $reting;

for ($int = 1; $int <= $count; $int++) {
echo  "<span style='color:orange';>" . $star . "</span>";
}
echo "<br>";
?>

<span class="username"><?php echo $comment; ?></span>
</div>

<div class="date" style="margin-left: 80px;">
<span class="text-muted"><?php echo $date; ?></span>
</div>
</div>
</div>
<br>

<?php
}
}
?>
</div>
</div>
</div>

<!-- new code end here --->



<div id="composeNewTxt" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content no-radius sharestorepos">
<form method="post">
<div class="modal-header">
<h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
</div>
<div class="modal-body">
<input type="hidden" name="module" id="module" value="freelancer">
<input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="txtReceiver" id="txtReceiver" value="<?php echo $SellId; ?>">
<div class="form-group">
<label>To (<?php echo $receiver_name; ?>)<span class="red"> * <span class="error_user"></span></span></label>

</div>
<div class="form-group">
<label>Message<span class="red"> * <span class="error_msg"></span></span></label>
<textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<input type="button" class="btn btn-primary composTxtNow" id="composTxtNow1" name="" value="Send Message" data-dismiss="modal">
</div>
</form>
</div>
</div>
</div>


<div id="mstone" class="tabcontent">
<div class="col-sm-12 nopadding dashboard-section">
<h4 style="padding-left: 10px;"><?= $awardName ?> </h4>
<?php
$pre = new _freelance_project_status;

$free = $pre->readAceptproject($row['idspPostings']);

//echo $pre->ta->sql;
if (empty($free)) {
$freelancerhire = "";
} else {
$freelancerhire = mysqli_fetch_assoc($free);
}


/*  print_r($freelancerhire['spProfiles_idspProfiles']);
print_r($_SESSION['pid']); */
?>
<!--
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">


<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Create Milestone</h4>
</div>
<form action="create_milestone.php" id="milestone_frm" method="post">
<div class="modal-body">
-->
<div class="table-responsive">
<table class="table table-striped tbl_store_setting">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Date </th>
<th style="color:#fff;">Description </th>
<th style="color:#fff;">Freelancer Name</th>
<th style="color:#fff;">Amount</th>
<th style="color:#fff;">Status</th>
</tr>
</thead>
<tbody>
<?php
//  $p = new _postingview;
$i = 1;
$sf = new _milestone;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$resm = $sf->checkmilestoneposted($postId);


// echo $sf->ta->sql;
//die('------=======-');   
if ($resm->num_rows > 0) {
//print_r($resm);die;

while ($rowm = mysqli_fetch_assoc($resm)) {


//print_r($row);
$f = new _spprofiles;

$pro = $f->read($rowm['receiver_idspProfiles']);
if ($pro) {
$pro_data = mysqli_fetch_assoc($pro);
}

?>
<tr>
<td><?php echo $i; ?></td>
<td>
<p><?php echo date('d-m-Y', (strtotime($rowm['created']))); ?></p>
</td>
<td><?php echo $rowm['description']; ?></td>
<td><?php  
$profiles_name = $sf->profile_11($rowm['freelancer_profile_id']);
if($profiles_name){ 
$record_11 = mysqli_fetch_assoc($profiles_name);}
?>

<a href="<?php echo $BaseUrl.'/freelancer/user-newprofile.php?profile='.$record_11['idspProfiles']; ?>"><?php echo $record_11['spProfileName']; ?></a>




</td>
<td><?php echo $row['Default_Currency'] ?> <?php echo $rowm['amount']; ?></td>
<td class="">
<?php
if ($rowm['request_status'] == 0) {

  if ($rowm['bussiness_profile_id'] == $_SESSION['pid']) {
?> <a id="realease" onclick="myRelease('<?php echo $BaseUrl . "/freelancer/dashboard/milestone_posted_update.php?status=1&postid=" . $rowm['id'] . "&getid=" . $postId; ?>')" class="btn btn-info" style="color:#fff;">Release</a>

    <a onclick="myCancel('<?php echo $BaseUrl . "/freelancer/dashboard/milestone_posted_update.php?status=2&postid=" . $rowm['id'] . "&getid=" . $postId; ?>')" style="margin-top: 5px;" class="btn btn-primary rejmile" style="color:#fff;">Cancel</a>


    <!--      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
<span class="caret"></span></button>
<ul class="dropdown-menu setting_left">
<li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/milestone_posted_update.php?status=1&postid=' . $rowm['id']; ?>">Realease</a></li>
<li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/milestone_posted_update.php?status=2&postid=' . $rowm['id']; ?>">Cancel</a></li>

</ul> -->
  <?php
  } else {

    echo "Pending";
  }
} elseif ($rowm['request_status'] == 1) {

  echo "Released";
  ?>
<?php
} elseif ($rowm['request_status'] == 2) {

  echo "cancelled";
}
?>
</section>
</td>
</tr> <?php
$i++;
}
} else {   ?>
<?php
if ($acceptpr != FALSE) {

// die("===============");
if ($_SESSION['ptid'] != 2) {

$sd = new _spprofiles;
$ps = new  _freelance_project_status;
//$sd->read();
// echo $row2['spProfiles_idspProfiles'];
$sf = new _freelance_placebid;
$order = "";
$res2 = $sf->readallbids($postId, $order);
if($res2){
$ss = mysqli_fetch_assoc($res2);
}

//print_r($ss);
//die('=========');
$profid = $ss['spProfiles_idspProfiles'];
$dd = $sd->read($profid);
if ($dd) {
$ff = mysqli_fetch_assoc($dd);
$pics = $ff['spProfilePic'];
}


$freest = $ps->checkStatusExist($postId, $profid);
if ($freest != false) {
$fs = mysqli_fetch_assoc($freest);

$awardedon = $fs['fps_start_date'];
}
?>
<div class="row">
<div class="col-md-2">
<img src="<?= $pics ?>" width="60px">
</div>
<div class="col-md-5" data-toggle="modal" data-target="#composeNewTxt" style="cursor: pointer;">
<a href="javascript:void(0)" id="composeNewTxt1" class="red"><i class='fas fa-comment-dots'></i></a>
</div>
<div class="col-md-5">
<p>Awarded on <?php echo $awardedon; ?></p>
<p>Bid <?php echo $row['Default_Currency'] . ' ' . $bidPrice; ?></p>
</div>
</div>
<div class="col-sm-12 dashboard-section">
<h4 style="no-padding">Create Milestone Payment <?= $awardName ?> <h4>
<div style="padding-left: 5px;">
<!--<form class="form-inline" id="milestone_frm" action="create_milestone.php" method="post">


</form> -->

</div>
</div>



<!-- Modal -->


</div>

<?php
}
}
?>
<?php
echo "<td colspan='5'><center>No Milestone </center></td>";
}
// print_r($_SESSION);
//die('sss');
?>
</tbody>

<?php
if ($_SESSION['ptname'] != 'Freelancer') {

echo '<br><button type="button" id="" data-toggle="modal" data-target="#myModal" class="btn btn-info    " style="float:right; margin-top: 18px;margin-right: 18px; margin-bottom: 18px;">Create Milestone</button><br><br> ';
}

?>
</table>
</div>
</div>
</div>
<?php
//$post = new _postings;

$fpsss = new _freelance_project_status;
$sf1 = new _freelancerposting;
// $result = $post->chkProjectStatus1($row['idspPostings']);
//echo "<pre>"; print_r($row); exit;
$result = $sf1->chkProjectStatus1($row['idspPostings']);

if ($result == false) {
?>
<!-- Modal -->
<div id="projectCancel" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<form method="post" action="project-status.php">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title"><?php echo $row['spPostingTitle']; ?></h4>
</div>
<div class="modal-body">
<input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
<div class="row add_form_body">
<div class="col-sm-12">
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
<a href="<?php echo $BaseUrl . '/freelancer/project-status.php?postid=' . $postId . '&action=complete'; ?>" class="btn create_add">Completed</a>
<a href="#" data-toggle="modal" data-target="#projectCancel" class="btn btn_freelancer">Canceled</a>
</div>
<?php
}



?>
<!--    Milestone -->
<?php
// print_r($row);

?>
<!-- 
End Milestone -->
</div>
<?php
$bdp = new _freelance_placebid;


$bds = $bdp->bidsp($postId);
if ($bds) {
$total_bid = $bds->num_rows;

$sum = 0;
//$count= mysqli_fetch_assoc($bds);
while ($count = mysqli_fetch_assoc($bds)) {

$cnt =  $count['bidPrice'];
$sum = $sum +  $cnt;
}

$avg = $sum / $total_bid;
} else {
$avg = 0;
$total_bid = 0;
}
?>
<div class="sidebar col-xs-12 col-sm-3  " class="float-right" class="right_freelance_top" style="margin-top:24px;">
<style>
p.bid-price {
font-weight: bold;
font-size: 18px;
}

* {
box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
float: left;
width: 50%;
padding: 10px;
height: 80px;
/* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
content: "";
display: inline-flex;
/*clear: both;*/
}

#content {
display: none;
}
</style>
<div class="row" style="    margin-left: 10px;">
<div class="column" style="background-color:#FFFFFF;">
<h5 style="text-align: center; border-right: groove;">Bids<?php echo '<br><p class="bid-price">' . $total_bid; ?></p>
</h5>
<br>

</div>
<div class="column" style="background-color:#FFFFFF;">
<h5 style="text-align: center ;"> Avg Bid<?php echo '<br><p class="bid-price">' . $avg; ?></p>
</h5>
</div>

</div>




<div class="modal fade" id="myModal" role="dialog">
<form action="create_milestone.php" method="POST" id="paymentForm" class="frm">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content ">

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 align="center">Create Milestone</h4>
</div>
<?php
$sf = new _freelancerposting;
$res74 = $sf->currency_code1($_SESSION['uid']);
$row74 = mysqli_fetch_assoc( $res74);
?>
<input type="hidden" name="currency_code" value="<?php echo $row74['currency'] ?>">
<input type="hidden" name="postid" value="<?php echo $postId ?>">
<input type="hidden" name="freelancer_projectid" value="<?php echo $row['idspPostings'] ?>">
<input type="hidden" name="freelancer_profileid" value="<?php echo $row5['spProfiles_idspProfiles']; ?>">
<input type="hidden" name="bussiness_profile_id" value="<?php echo $_SESSION['pid'] ?>">
<input type="hidden" name="hired" value="0">
<input type="hidden" name="created" value="<?php echo date('Y-m-d h:i:s'); ?>">
<div class="modal-body" style="padding-left:130px">
<div class="form-group">
<label for="freelancer">Choose Freelancer<span class="text-danger">*</span></label>
<select class="form-control" name="freelancer_cat" style="width:300px;" required>
<option value="0" style="color: black;">Choose Freelancer <i class="fa fa-down icon"></option>
<?php 
$sf = new _freelancerposting;
$freelancer_status1 = $sf->freelancer_status($postId);
if($freelancer_status1){
while ($freelancer_view = mysqli_fetch_assoc($freelancer_status1)) {
?>
<option value="<?php echo $freelancer_view['spProfiles_idspProfiles'];?>" style="color: black;"> 					<?php

$chafan = $sf->freelancer_category($freelancer_view['spProfiles_idspProfiles']);
if($chafan){
$record = mysqli_fetch_assoc($chafan);

echo $record['spProfileName']; 

}
?> 


</option>

<?php } } ?>
</select><br>


<div class="form-group">
<label for="amount">Amount $:<span class="text-danger">*</span></label>
<input type="number" required class="form-control" style="width:300px;" id="amount" name="total_amount">
<span id="amt_err" style="color:red"></span>
</div>
<div class="form-group">
<label for="description">Milestone Name:<span class="text-danger">*</span></label>
<input type="text" required class="form-control" style="width:300px;" id="description" name="description">
<span id="desc_err" style="color:red"></span>
</div>
<div class="form-group">
<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
<input type="text" name="customerName" id="customerName" style="width:300px;" class="form-control" value="" required>
<span id="errorCustomerName" class="text-danger"></span>
</div>
<div class="form-group">
<label>Card Number <span class="text-danger">*</span></label>
<input type="text" name="cardNumber" id="cardNumber" style="width:300px;" class="form-control" maxlength="20" onkeypress="return validateNumber(event);">
<span id="errorCardNumber" class="text-danger"></span>
</div>
<div class="form-group">
<div class="row">
<div class="col-md-4" style="margin-right: -33px;margin-left: -13px;" >
<label>Expiry Month</label>
<input type="text" name="cardExpMonth" style="width:110px;" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);">
<span id="errorCardExpMonth" class="text-danger"></span>
</div>
<div class="col-md-4" style="margin-right: -33px;" >
<label>Expiry Year</label>
<input type="text" name="cardExpYear" id="cardExpYear" style="width:110px;" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);">
<span id="errorCardExpYear" class="text-danger"></span>
</div>
<div class="col-md-4">
<label>CVC</label>
<input type="text" name="cardCVC" id="cardCVC" style="width:90px;" class="form-control" maxlength="3" onkeypress="return validateNumber(event);">
<span id="errorCardCvc" class="text-danger"></span>
</div>
</div>
</div>
<br>
<div align="left">



<!-- <input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
</div>

<br>
<br>
<div style="margin-right:100px;"> <button type="submit" class="btn butn_cancel  btn-border-radius" name="payNow" id="payNow"  onclick="stripePay(event)" value="Pay Now"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now</button><br><br></div>
</div>


</div>





</div>
</form>
</div>

<!-- <div class="container">
<form action="create_review.php" method="POST" class="newRating">
<div class="modal fade" id="myModal_review" role="dialog">

<div class="modal-dialog">

<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>

</div>
<div class="modal-body">
<input type="hidden" name="postid" value="<?php echo $_GET['postid'] ?>">
<input type="hidden" name="pid" value="<?php //echo $_SESSION['pid'] 
                              ?>">
<input type="hidden" name="uid" value="<?php //echo $_SESSION['uid'] 
            ?>"> -->
            <?php
            //echo $_SESSION["pid"].'+++<br>';
            //echo $row['spProfiles_idspProfiles'].'===';
if ($_SESSION["pid"] != $row['spProfiles_idspProfiles']) {
?>
          
            
            <!-- <input type="hidden" name="to_person" id="to_person" value="<?php echo $_SESSION['pid'] ?>">

           <?php } else { 
            $postid_m = $_GET['postid'];
            $freelancer_statusm = $sf->freelancer_status_m($postid_m);
            if($freelancer_statusm){
            $store_data = mysqli_fetch_assoc($freelancer_statusm);
            }
             ?>

           <input type="hidden" name="to_person" id="to_person" value="<?php echo $store_data['spProfiles_idspProfiles'] ?>">
          <?php } ?> 
           

          <?php
            //echo $_SESSION["pid"].'+++<br>';
            //echo $row['spProfiles_idspProfiles'].'===';
if ($_SESSION["pid"] != $row['spProfiles_idspProfiles']) {
?>
          
            
            <input type="hidden" name="project_owner" id="project_owner" value="0">

           <?php } else { 
            $postid_m = $_GET['postid'];
            $freelancer_statusm = $sf->freelancer_status_m($postid_m);
            if($freelancer_statusm){
            $store_data = mysqli_fetch_assoc($freelancer_statusm);
            }
             ?>

           <input type="hidden" name="project_owner" id="project_owner" value="1">
          <?php } ?>
           
           
        

<!-- <div class="form-group">
<label for="DESC">Description</label>
<input type="text" name="description" id="desc" class="form-control">
<span id="errorDescription" class="text-danger"></span>
</div>

<div class="form-group">
<label for="rating_choose">Review</label>
<br> -->

<!-- <style>
* {
margin: 0;
padding: 0;
}

.rate {
float: left;
height: 46px;
padding: 0 10px;
}

.rate:not(:checked)>input {
position: absolute;
top: -9999px;
}

.rate:not(:checked)>label {
float: right;
width: 1em;
overflow: hidden;
white-space: nowrap;
cursor: pointer;
font-size: 30px;
color: #ccc;
}

.rate:not(:checked)>label:before {
content: '★ ';
}

.rate>input:checked~label {
color: #ffc700;
}

.rate:not(:checked)>label:hover,
.rate:not(:checked)>label:hover~label {
color: #deb217;
}

.rate>input:checked+label:hover,
.rate>input:checked+label:hover~label,
.rate>input:checked~label:hover,
.rate>input:checked label:hover label,
.rate>label:hover input:checked label {
color: #c59b08;
}
</style> -->
<!-- <div class="rate">
<input type="radio" id="star5" name="review_rating" value="5" />
<label for="star5" title="text">5 stars</label>
<input type="radio" id="star4" name="review_rating" value="4" />
<label for="star4" title="text">4 stars</label>
<input type="radio" id="star3" name="review_rating" value="3" />
<label for="star3" title="text">3 stars</label>
<input type="radio" id="star2" name="review_rating" value="2" />
<label for="star2" title="text">2 stars</label>
<input type="radio" id="star1" name="review_rating" value="1" />
<label for="star1" title="text">1 star</label>
</div> -->


</div>
</div>
<!-- <div class="modal-footer">
<input type="submit" class="btn btn-primary" value="submit">
</div> -->
</div>

</div>

</div>
</form>
</div> 



</div>


<div class ="container">
<form action="create_review.php" method="POST" class="newRating">
<div class="modal fade" id="myModal1111" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Please Provide Review</h4>
</div>
<div class="modal-body">
<input type="hidden" name="postid" value="<?php echo $postId ?>">
<!-- <input type="hidden" name="pid" value="<?php //echo $_SESSION['pid'] 
                              ?>">
<input type="hidden" name="uid" value="<?php //echo $_SESSION['uid'] 
            ?>"> -->
            <?php
            //echo $_SESSION["pid"].'+++<br>';
            //echo $row['spProfiles_idspProfiles'].'===';
if ($_SESSION["pid"] != $row['spProfiles_idspProfiles']) {
?>
          
            
            <input type="hidden" name="to_person" id="to_person" value="<?php echo $_SESSION['pid'] ?>">

           <?php } else { 
            $freelancer_statusm = $sf->freelancer_status_m($postId);
            if($freelancer_statusm){
            $store_data = mysqli_fetch_assoc($freelancer_statusm);
            }
             ?>

           <input type="hidden" name="to_person" id="to_person" value="<?php echo $store_data['spProfiles_idspProfiles'] ?>">
          <?php } ?>
           

          <?php
            //echo $_SESSION["pid"].'+++<br>';
            //echo $row['spProfiles_idspProfiles'].'===';
if ($_SESSION["pid"] != $row['spProfiles_idspProfiles']) {
?>
          
            
            <input type="hidden" name="project_owner" id="project_owner" value="0">

           <?php } else { 
            $freelancer_statusm = $sf->freelancer_status_m($postId);
            if($freelancer_statusm){
            $store_data = mysqli_fetch_assoc($freelancer_statusm);
            }
             ?>

           <input type="hidden" name="project_owner" id="project_owner" value="1">
          <?php } ?>
           
           
        

<div class="form-group">
<label for="DESC">Description</label>
<input type="text" name="description" id="desc" class="form-control">
<span id="errorDescription" class="text-danger"></span>
</div>

<div class="form-group">
<label for="rating_choose">Review</label>
<br>

<style>
* {
margin: 0;
padding: 0;
}

.rate {
float: left;
height: 46px;
padding: 0 10px;
}

.rate:not(:checked)>input {
position: absolute;
top: -9999px;
}

.rate:not(:checked)>label {
float: right;
width: 1em;
overflow: hidden;
white-space: nowrap;
cursor: pointer;
font-size: 30px;
color: #ccc;
}

.rate:not(:checked)>label:before {
content: '★ ';
}

.rate>input:checked~label {
color: #ffc700;
}

.rate:not(:checked)>label:hover,
.rate:not(:checked)>label:hover~label {
color: #deb217;
}

.rate>input:checked+label:hover,
.rate>input:checked+label:hover~label,
.rate>input:checked~label:hover,
.rate>input:checked label:hover label,
.rate>label:hover input:checked label {
color: #c59b08;
}
</style>
<div class="rate">
<select name="review_rating" class="star1" id="review_rating">

<option value="1">★</option>
<option value="2">★★</option>
<option value="3">★★★</option>
<option value="4">★★★★</option>
<option value="5">★★★★★</option>




</select>


<!-- <input type="radio" id="star5" name="review_rating" value="5" />
<label for="star5" title="text">5 stars</label>
<input type="radio" id="star4" name="review_rating" value="4" />
<label for="star4" title="text">4 stars</label>
<input type="radio" id="star3" name="review_rating" value="3" />
<label for="star3" title="text">3 stars</label>
<input type="radio" id="star2" name="review_rating" value="2" />
<label for="star2" title="text">2 stars</label>
<input type="radio" id="star1" name="review_rating" value="1" />
<label for="star1" title="text">1 star</label> -->
</div>


</div>


</div>
<div class="modal-footer">
<input type="submit" class="btn btn-primary" value="submit">
</div>
</div>

</div>
</div>
</form>
</div>

</section>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>
<script type="text/javascript">
var toggle = document.getElementById("toggle");
var content = document.getElementById("content");

toggle.addEventListener("click", function() {
content.style.display = (content.dataset.toggled ^= 1) ? "block" : "none";
});
$(".complete1").click(function(e) {

var link = $(this).attr('href');

swal({
title: "Are you sure you want to Complete Project?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = link;
}
});

});

function myComplete(url) {

Swal.fire({
title: 'Are you sure you want to Complete Project?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Complete it!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});

}

function myInComplete(url) {

Swal.fire({
title: 'Are you sure you want to In-Complete Project ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes , In-Complete it!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});

}

function myRelease(url) {

Swal.fire({
title: 'Are you sure you want to Realease ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, release it!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});

}

function myCancel(url) {

Swal.fire({
title: 'Are you sure you want to Cancel ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, cancel it!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});

}





$("#realease11").click(function(e) {
//alert('1111111111');
var link = $(this).attr('href');
swal({
title: "Are you sure you want to Realease ?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
//window.location.href = link;
}
});

});


$(".rejmile11").click(function(e) {
//alert('2222');
var link = $(this).attr('href');
swal({
title: "Are you sure you want to Cancel ?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
//window.location.href = link;
}
});
});


$(".incomplete1").click(function(e) {
// alert();
//e.preventDefault();
/*var postid = $(this).attr("data-postid");*/
var link = $(this).attr('href');

// alert(link);
// alert(postid);

swal({
title: "Are you sure you want to In Complete Project?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = link;
}
});

});





$('#m_submit').on('click', function() {

var amount = $("#amount").val();
var description = $("#description").val();

if (amount == "" && description == "") {

$("#amt_err").text("Please Enter Amount");
$("#desc_err").text("Please Enter Milestone Name");
$("#amount").focus();

} else if (amount == "") {

$("#amt_err").text("Please Enter Amount");
$("#amount").focus();

} else if (description == "") {

$("#desc_err").text("Please Enter Milestone Name");
$("#amt_err").text("");
$("#description").focus();
} else {

$("#milestone_frm").submit();

}


});



function awarded_1(url){
//alert(url);
Swal.fire({
title: 'Are You Sure You Want to Accept it?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes',
cancelButtonText: 'No'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});
}
//rejected swal
function rejected_1(url){
Swal.fire({
title: 'Are You Sure You Want to Rejected?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Rejected it!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});

}

</script>
<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>
</body>

</html>
<?php }
?>

<script>
function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
</script>
<script>
(function() {
document.getElementById('tabclick').click();
})();
</script>

<script>
(function() {
document.getElementById('tabclick1').click();
})();
</script>
<script>

function openmodal(){
$('#myModal1111').modal('show');


}
</script>
