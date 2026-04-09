<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "freelancer/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$activePage = 4;

$p      = new _postingview;
$fa     = new _freelance_account;
// ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
$f = new _spprofiles;
$re = new _redirect;
//check profile is freelancer or not
$chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
if ($chekIsFreelancer == false) {
$redirctUrl = $BaseUrl . "/my-profile/";
$_SESSION['count'] = 0;
$_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
$re->redirect($redirctUrl);
}
// END
?>
<!DOCTYPE html>
<html lang="en-US">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<head>
<?php include('../component/f_links.php'); ?>
<style>

    #example1_wrapper{
        margin: 7px;
    }
    /* #example1_paginate {
        float: right !important;

    } */

	div#example1_filter {
    float: right;
    margin-bottom: 6px;
    margin-right: 8px;
    margin-top: -7px;
}
div#example1_length {
    margin-bottom: -13px;
    padding-top: 10px;
    margin-left: 6px;
}


</style>
</head>

<body class="bg_gray">
<?php

$header_select = "freelancers";
include_once("../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">

<div class="col-xs-12 col-sm-3">
<div class="leftsidebar ">
<?php include('../component/left-freelancer.php'); ?>
</div>
</div>
<div class="col-xs-12 col-sm-9 nopadding">
<?php include('top-banner-freelancer.php'); ?>
<!-- <div class="col-xs-12  dashboard-section payment_margin bradius-15">
<div class="dashboardbreadcrum">

<?php
/*$result3 = $fa->readProBlnc($_SESSION['pid']);
if ($result3) {
$row3 = mysqli_fetch_assoc($result3);
$myBlnc = $row3['fa_current_amount'];
}*/
?>-->
<!-- Modal -->
<!--<div id="addPayment" class="modal fade" role="dialog">
<div class="modal-dialog">


<div class="modal-content sharestorepos proposal_dialogbox">
<form action="" method="post">


<input type="hidden" name="email" value="sharepage_receiver@jouple.com">

<input type="hidden" name="currencyCode" value="USD">
<input type="hidden" name="cancelUrl" value="http://localhost/share-page/freelancer/payment_cancel.php" />
<input type="hidden" name="returnUrl" value="http://localhost/share-page/freelancer/payment_success.php">
<input type="hidden" name="requestEnvelope.errorLanguage" value="en_US">


<div class="modal-header proposalheader_topborder">

<h4 class="modal-title">Deposit Amount</h4>
</div>
<div class="modal-body">

<div class="form-group">
<label for="Amount">Amount in Dollar ($)</label>
<input type="text" class="form-control no-radius" id="amount" required="" name="amount" />
</div>
</div>
<div class="modal-footer proposalheader_bottomborder">
<button type="button" class="btn butn_cancel projetproperty_btn" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success projetproperty_btn" style="min-width: 130px;">Deposit Now</button>

</div>
</form>
</div>
</div>
</div>
<button type="button" class="btn btn_freelancer pull-right" style="margin-top: 5px; border-radius: 30px!important;" data-toggle="modal" data-target="#addPayment">Deposit Amount</button>-->
<!--<p class="pull-right">My Balance : <span>$<?php echo isset($myBlnc) ? $myBlnc : '0'; ?></span></p>
</div>
</div>-->
<div class="col-xs-12 nopadding dashboard-section  bradius-15 " style="margin-top: 5px;">

<div class="col-xs-12 dashboardtable">
<div class="table-responsive" style="height: auto; border-radius:15px;">

<table class="table text-center tbl_activebid table-striped tbl_store_setting display" id="example1">
<thead>
<tr>

<th>Id</th>
<th>Project Name</th>
<th>Description</th>

<th>Amount</th>

<th style="text-align: center;">Date</th>
</tr>
</thead>
<tbody>
<?php
$fp_new  = new _freelancerposting;


$result = $fa->readUser_d($_SESSION['pid']);
$i = 1;
if($i){
$i = $result->num_rows;
}
if (!empty($result)) {

while ($row = mysqli_fetch_assoc($result)) {
// print_r($row);
// die('==');
$projectId     = $row['freelancer_projectid'];
$amount      = $row['amount'];
$description      = $row['description'];
$transrDate = $row['created'];
$dt = new DateTime($transrDate);
$result_new = $fp_new->read($projectId);
if ($result_new) {
$row_new = mysqli_fetch_assoc($result_new);
$currency_new = $row_new['Default_Currency'];
}
?>
<tr>
	<td><?php echo $i; ?></td>


<td>
<?php
//echo $postId;
$fp  = new _freelancerposting;
$result2 = $fp->read($projectId);
if ($result2) {
$row2 = mysqli_fetch_assoc($result2);
//print_r($row2);
$ProjectName = $row2['spPostingTitle'];
}

?>
<a href="<?php echo $BaseUrl . '/freelancer/project-detail.php?project=' . $projectId; ?>" class="red freelancer_capitalize"><?php echo $ProjectName; ?></a>
</td>
<td><?php echo $description; ?></td>
<td><?php echo $currency_new.' '.$amount; ?></td>

<td><?php echo $dt->format('d M, Y'); ?></td>
</tr><?php


}
} else {

echo "

<td colspan='6'>No Record Found</td>";
}


?>




</tbody>
</table>
</div>
</div>
</div>

</div>
</div>
</section>

<script src='https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js'></script>

<script>
var table = $('#example1').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
</script>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
</body>

</html>
<?php
} ?>