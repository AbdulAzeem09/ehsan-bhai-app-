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

$pageactive = 73;
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



<style>
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}
/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
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
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}						

</style>



<div class="content">
<div class="col-md-12 ">

<div class="row">




<div class="col-md-12 ">
<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">

<div class="panel-body">
<div class="tab-content">
<div class="tab-pane fade in active" id="tab1warning">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>

<div class="col-md-12 no-padding">  






<div class="col-md-12">
<div class="titlePage text-center">

<h2 style="padding:15px; color:black; background-color:skyblue;">BUSINESS ACCOUNT SUPPORT PLANS</h2>
</div>
</div>

<div class="row">
<div class="col-md-12 ">
<?php
$pr = new _spprofiles;
$m = new _spmembership;
$res = $m->read_package();
//print_r($res);die('====');

//echo $m->ta->sql;
if($res != false){
while ($rows = mysqli_fetch_assoc($res)) {
//print_r($rows);
//echo $rows['pack_description'];die('===');

?>


<div class="col-md-4 col-sm-6">
<div class="serviceBox">
<div class="service-icon">
<?php
//	 print_r($rows);
if ($rows["pack_amount"] != 0) {
$amt = "$".$rows["pack_amount"];
}else{
$amt = "<i class='fa fa-envelope'></i>";
}
echo $amt; 
?>
</div>
<h3 class="title"><?php echo $rows["pack_name"]; ?></h3>
<p class="description">
Description : <?php echo $rows["pack_description"]; ?>
</p>
<?php
$m = new _spmembership;
$ids=$rows["id"];
$res11 = $m->get_pack_data($_SESSION['uid'],$ids);
if($res11 ){
$row11 = mysqli_fetch_assoc($res11);
}
//print_r($row11);die('==='); 
$pro_id= isset($row11) ? $row11['membership_id'] : "";
$uid= isset($row11) ? $row11['uid'] : "";
$review= isset($row11) ? $row11['is_reviewed'] : "";





//echo $remainingday;
// ../finance/?membership=".$rows["idspMembership"]." this is href
if($res11)
echo "<a href='#'  class='btn '>Purchased</a><br>
Is this work completed?
<br><a href='".$baseurl."review.php?id=".$row11["id"]."&status=1'  class='' type='radio'><input type='radio' id='html' name='fav_language' value='HTML'><label for=html'>Yes</label></a>

&nbsp;<a href='".$baseurl."review.php?id=".$row11["id"]."&status=0'  class=''><input type='radio' id='html name='fav_language' value=HTML'><label for='html'>No</label></a>


";
else

echo "<a href='".$baseurl."purchase_package.php?id=".$rows["id"]."'  class='btn btn-border-radius'>Buy Now</a>";


?>

</div>
</div>


<?php
//  die();
}
}
?>
</div>


<div class="row">
<div class="col-sm-3">

</div>
<div class="col-sm-6">
Once a user has completed a job, The SharePage pays the user 70% of the support fee for their services. 

It’s important to note that users will need to comply with SharePage’s policies and guidelines to ensure a positive experience for both the user and the business.
</div>

<div class="col-sm-3">

</div>

</div>
</div>

<!--Pop-up Box for contact form-->

<!--Done-->


</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->


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





