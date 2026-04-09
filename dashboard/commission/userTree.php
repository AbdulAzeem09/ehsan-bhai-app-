<?php


//  error_reporting(E_ALL);
// ini_set('display_errors', '1');


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

$pageactive = 72;
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

/* .tree li:only-child {
   
    margin-top: 25px!important;
} */




.dataTables_filter	{
margin-bottom:3px;
}
.dataTables_empty{text-align:center!important;}
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}

.panel-warning {
    border-color: #ececec!important;
}

.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
}

.tab button:hover {
background-color: #ddd;
}

.tab button.active {
background-color: #ccc;
}

/* li:first-child a {
  display: none;
} */
.tabcontent {
display: none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}			
</style>
<link rel="stylesheet" href="assets/css/treeData.min.css">
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


</style>



<div class="content">
<div class="col-md-12" >
<div class="text-center" style="background: #c2c2c2ed;  padding: 17px 0px 16px 0px;">
<h1 style="margin: 0px; font-weight: bolder;margin-bottom:5px;">Referral Tree</h1>
</div>
</div>
<div class="col-md-12 " style="margin-top: 20px;">

<div class="row">




<div class="col-md-12 ">
<div class=" with-nav-tabs panel-warning" >


<?php

$u = new _spuser;
$getcode = $u->getcode($_SESSION['uid']);
$fetchcode = mysqli_fetch_assoc($getcode);
$mycode = $fetchcode['userrefferalcode'];// this is my code
$username = $fetchcode['spUserName'];     
$userrefercodeused=[];
$refercodeused = $u->getrefrecode($mycode);
/*while ($row1=mysqli_fetch_assoc($refercodeused )) {
$userrefercodeused[] =  $row1['spUserName'];    // name of users who useed my refercode
}
print_r($userrefercodeused);
*/

$gettotalcommmision = $u->get_amount($_SESSION['uid']);
$totalCommission = 0;
while ($fetamount = mysqli_fetch_assoc($gettotalcommmision)) {

$totalCommission +=$fetamount['spuser_commission'];

}
//if total commison is 0 then show 0 otherwise data with 2 desimal
if($totalCommission ==0){
  $commisionformated = '0';
}
else{
  $commisionformated = number_format($totalCommission,2);
}

// echo $totalCommission;
// die('xxxxxxx');

?>
<input type="hidden" value="<?php echo $userrefercodeused?>" id="refercode">
<div id="tree" style="margin-left: 100px;">


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

<script type="text/javascript" src="assets/js/treeData.js"></script>
<script>
var aa = <?php echo json_encode($userrefercodeused); ?>;
// console.log(aa);
var tree = {

// c : {value : "", parent : "b"},
d : {value : "<?php echo $username ,' ('.$commisionformated.')' ?>", parent : ""}, 
<?php 

$alpha=['e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
$i=0;

//for the first level tree
while ($row1 = mysqli_fetch_assoc($refercodeused)) {
$levelamount = $u->fetchamount($row1['idspUser']);  //FETCHING THE COMMISION BASED ON ID
$totalCommission = 0;
if($levelamount){
while ($fetamount = mysqli_fetch_assoc($levelamount)) {

$totalCommission +=$fetamount['spuser_commission']; //ADDING ALL THE COMMISION 

}
}
//if total commison is 0 then show 0 otherwise data with 2 desimal
if($totalCommission ==0){
  $commisionformated = '0';
}
else{
  $commisionformated = number_format($totalCommission,2);
}

$aa = $alpha[$i % count($alpha)];
echo $aa . ':{value :"'.$row1['spUserName'].' ('.$commisionformated.')", parent : "d"},'; //SHOWING NAME  AND COMMISON


//for the second level tree
$secondlevel = $u->getrefrecode($row1['userrefferalcode']);
if ($secondlevel != false) {
while ($row2 = mysqli_fetch_assoc($secondlevel)) {

$levelamount = $u->fetchamount($row2['idspUser']); //FETCHING THE COMMISION BASED ON ID
$totalCommission = 0;
if($levelamount){
while ($fetamount = mysqli_fetch_assoc($levelamount)) {

$totalCommission +=$fetamount['spuser_commission'];  //AADDING ALL THE COMMISION 

}
}
//if total commison is 0 then show 0 otherwise data with 2 desimal
if($totalCommission ==0){
  $commisionformated = '0';
}
else{
  $commisionformated = number_format($totalCommission,2);
}

$i++;
$bb =  $alpha[$i % count($alpha)];
echo $bb  . ':{value :"'.$row2['spUserName'].' ('.$commisionformated.')", parent : "'.$aa.'"},'; //SHOWING NAME  AND COMMISON

//for the third level tree
$thirdlevel = $u->getrefrecode($row2['userrefferalcode']);
if($thirdlevel != false){
while($row3 = mysqli_fetch_assoc($thirdlevel)){
$levelamount = $u->fetchamount($row3['idspUser']); //FETCHING THE COMMISION BASED ON ID
$totalCommission = 0;
if($levelamount){
while ($fetamount = mysqli_fetch_assoc($levelamount)) {

$totalCommission +=$fetamount['spuser_commission'];   //ADDING ALL THE COMMISION 

}
}
//if total commison is 0 then show 0 otherwise data with 2 desimal
if($totalCommission ==0){
  $commisionformated = '0';
}
else{
  $commisionformated = number_format($totalCommission,2);
}

$i++;
echo $alpha[$i % count($alpha)] . ':{value :"'.$row3['spUserName'].' ('.$commisionformated.')", parent : "'.$bb.'"},'; //SHOWING NAME  AND COMMISON
}
}

}
}
$i++;
}
?>

};

TreeData(tree, "#tree");
</script>
</html>
<?php
} ?>

