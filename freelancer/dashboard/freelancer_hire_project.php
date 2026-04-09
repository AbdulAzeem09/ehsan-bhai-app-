<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', 1);*/
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 

$_SESSION['afterlogin']="freelancer/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$activePage = 19;

$fps = new _freelance_project_status;

 
?>
<style>
.freelancer_capitalize{
padding-left: 0px;
}
#profileDropDown li.active {
background-color: #c45508!important;
}
#profileDropDown li.active a {
color: #fff!important;
}
span#car1 {
margin-top: 10px;
}
</style>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<!-- Design css  -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
</head>

<style>
#example1_length{
margin-top: 7px;
margin-bottom: 9px;
margin-left: 7px;

}
#example1_filter{
margin-top: 6px;
margin-right: 6px;
}
#example1_info{
margin-left: 9px;

}
#example1_paginate{
margin-bottom: 6px;
}

div.dataTables_filter label {
margin-bottom: 5px;

}
.inner_top_form button {
    
    padding:9px!important;
}
</style>

<body class="bg_gray">
<?php
//session_start();

$header_select = "freelancers";
include_once("../../header.php");
?>
<section class="main_box" id="freelancers-page">
<div class="container nopadding projectslist dashboardpage">



<div class="sidebar col-xs-3 col-sm-3" id="sidebar" >

<?php include('left-menu.php');?>
</div>
<div class="col-xs-12 col-sm-9 nopadding">


<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
<div class="col-xs-12 dashboardbreadcrum">
<ul class="breadcrumb">
<li><a href="<?php echo $BaseUrl;?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
<li>Hired Freelancers </li>
<!-- <li><?php echo $title;?></li> -->
<a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a>
</ul>
</div>


</div>

<!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
<div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
<ul class="breadcrumb freelancer_dashboard">
<li><a href="<?php echo $BaseUrl;?>/freelancer">Dashboard</a></li>
<li>Expired Projects</li>

</ul>
</div>
</div> -->
<div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">


<ul class="nav nav-tabs">
<!-- <li class="active"><a data-toggle="tab" href="#home">Hired Freelancer</a></li>
<li><a data-toggle="tab" href="#menu1">Awarded Freelancer</a></li> -->
<!--  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
<li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
</ul>


<div class="col-xs-12 dashboardtable">
<div class="table-responsive" style="overflow-x:hidden;">

<div class="tab-content">

<div id="home" class="tab-pane fade in active">
<?php

$sf  = new _freelance_chat_project;
$res = $sf->getbussinesConversation($_SESSION['pid']);


if($res!=false){
$table1='example1';
}
else{
$table1='';

}

?>
<table class="table table-striped tbl_store_setting display" id="<?php echo $table1; ?>">
<thead style="background-color: #3e3e3e;color: #fff;">
<tr>

<th style="color:#fff;"></th>
<th style="color:#fff;">ID</th>
<th style="color:#fff;">Project Title1</th>
<th style="color:#fff;">Hired</th>
<th style="color:#fff;">Chat</th>
<th style="color:#fff;">Price($)</th>
<th style="color:#fff;">Price type</th>
<!--   <th style="color:#fff;">created</th> -->

<th class="action text-center" style="color:#fff;text-align: center;">Status</th>
</tr>
</thead>
<tbody>
<?php
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
$curr=$stt['currency'];
}
//  $p = new _postingview;
$i = 1;
$sf  = new _freelance_chat_project;
//$res = $p->myExpireProduct(5, $_SESSION['pid']);
$res = $sf->getbussinesConversation($_SESSION['pid']);

//echo $sf->ta->sql;
if($account_status!=1){
if($res!=false){ 

while($row = mysqli_fetch_assoc($res)){

//print_r($row);
$receiver=$row['receiver_idspProfiles'];

/* print_r($row);*/
$f = new _spprofiles;

$pro = $f->read($row['receiver_idspProfiles']);
if($pro){
$pro_data = mysqli_fetch_assoc($pro);
//print_r($pro_data);
$receiver_name=$pro_data['spProfileName'];
//print_r($pro_data);
}

/*print_r($pro_data['spProfileName']);*/
$dt = new DateTime($row['chat_date']);

?>  

<tr>

<td></td>
<td> <?php  echo $i; ?></td>

<td ><!-- <a href="<?php //echo $BaseUrl.'/freelancer/dashboard/detail.php?postid='.$row['idspPostings'];?>" class="red freelancer_capitalize"  > -->

<a href="<?php echo $BaseUrl.'/freelancer/dashboard/freelance_project_detail.php?postid='.$row['id'];?>" class="red freelancer_capitalize"target="_blanck"  ><?php echo "Project for " .ucfirst($pro_data['spProfileName']);?></a></td>

<td><a href="<?php echo $BaseUrl.'/freelancer/user-newprofile.php?profile='.$pro_data['idspProfiles'];?>"class="red freelancer_capitalize" target="_blanck">
<?php echo  ucfirst($pro_data['spProfileName']);?></a></td>

<td><div class="col-sm-12" data-toggle="modal" data-target="#composeNewTxt" style="cursor: pointer;" ><a href="javascript:void(0)"  id="composeNewTxt1"  class="red" data-id="<?php echo $receiver; ?>" data-receiver_name="<?php echo $receiver_name;?>" onclick="pass(<?php echo $receiver;?>,'<?php echo $receiver_name;?>')"> <i class='fas fa-comment-dots' style="color: #ff7208;"></i>Chat</a></div> </td>


<td><?php echo  $curr.' '.$row['bidPrice'];?></td>
<td><?php echo $row['PriceFixed']; ?></td>

<!--   <td><?php //echo $dt->format('d-M-Y'); ?></td> -->
<td class="text-center">
<?php if($row['status'] == 0){

echo "<span style='color:ff8320;'>Pending<span>";

}elseif ($row['status'] == 1) {

echo "<span style='color:green;'>Accepted</span>";
}else{

echo "<span style='color:red;'>Rejected</span>";
} 
?>
</td>

</tr> <?php 
$i++;
?>

<?php       }

}}else{
echo "<td colspan='8'><center>No Record Found</center></td>";
}
?>



</tbody>
</table>

</div>
<script>

function pass(a,b){
$('#txtReceiver').val(a);
$('#name').text(b);

}
</script>
<div id="composeNewTxt" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content no-radius sharestorepos">
<form method="post"  >
<div class="modal-header">
<h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
</div>
<div class="modal-body">
<input type="hidden" name="module" id="module" value="freelancer">
<input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid'];?>">
<input type="hidden" name="txtReceiver" id="txtReceiver" value="<?php echo $receiver;?>" >
<div class="form-group">
<label >To (<span id="name"></span>)<span class="red"> * <span class="error_user"></span></span></label>

</div>
<div class="form-group">
<label>Message<span class="red"> * <span class="error_msg"></span></span></label>
<textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<input type="button" class="btn btn-primary composTxtNow btn-border-radius" id="composTxtNow1" name="" value="Send Message"  data-dismiss="modal" > 
</div>
</form>
</div>
</div> 
</div>



<div id="menu1" class="tab-pane fade">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php



$sf  = new _freelancerposting;




?>





</div>

</div>


</div>

</div>
</div>
</div>
</div>
</section>



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
</body>
</html>
<?php 
} ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

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



<script>
var table = $('#example2').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
</script>	