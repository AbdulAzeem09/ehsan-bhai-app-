<?php


/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

 
require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 94;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}
.dataTables_filter	{
margin-bottom:3px;
}
.dataTables_empty{text-align:center!important;}

</style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
;
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->





<?php 
$dp = new _spgroup;

$result= $dp ->group_spd($_SESSION['uid']);
$row=mysqli_fetch_assoc($result);
 $membership_id=$row['membership_id'];
//echo $membership_id;

 $result1= $dp ->group_spd_1($membership_id);
 $row1=mysqli_fetch_assoc($result1);
    $idspMembership=$row1['idspMembership'];
    $spMembershipName=$row1['spMembershipName'];
    $spMembershipPostlimit=$row1['spMembershipPostlimit'];
    $spMembershipDuration=$row1['spMembershipDuration'];
    $spMembershipAmount= $row1['spMembershipAmount'];
    $date= $row1['date'];

//print_r($row);die('=======');
?>
Memersip ID : <?php echo $idspMembership.'</br>'; ?>
Memersip Name : <?php echo $spMembershipName.'</br>'; ?>
Memersip Post Limit :<?php echo  $spMembershipPostlimit.'</br>'; ?>
Memersip Duration : <?php echo $spMembershipDuration.'</br>'; ?>
Memersip Price : <?php echo $spMembershipAmount.'</br>'; ?>
Memersip Date : <?php echo $date.'</br>'; ?>












</div>
</div>
</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>


</div>
</section>

<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->




</body> 
</html>
<?php
} ?>







