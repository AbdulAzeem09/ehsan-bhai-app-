<?php 
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="artandcraft/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryID"] = 13;

$activePage = 5;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!--This script for sticky left and right sidebar STart-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>

</head>

<body class="bg_gray">
<?php 
$header_photo = "header_photo";
include_once("../../header.php");



?>

<section class="">
<div class="container-fluid">
<div class="row">
<div class="sidebar col-md-2 no-padding left_photo_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>
<div class="col-md-10" style="margin-top:10px;">
<div class="row">
<div class="panel panel-default">
<div class="panel-heading"> Dashboard / Your Board </div>
</div>
<?php

$atb = new _addtoboard;
$p = new _postingviewartcraft;

if($_GET['page']==1){
$start = 0;
}


else{
$sss = $_GET['page']-1;
$start = 8*$sss;
}
$limit = 1;

$limitaa = 8;
//echo $_SESSION['pid'];
//pg 1 , 0,8
//pg 2  , 8,
$result = $atb->readMyBoard($_SESSION['pid']);

$numrowsw = $result->num_rows; 
//echo $numrowsw;


if($result ){
//	
while ($rows = mysqli_fetch_assoc($result)) {



$res = $p->singletimelines($rows['spPosting_idspPosting']);
//$board=$res->num_rows;
//echo $board;
//print_r($res);
//echo $p->ta->sql; die;
// print_r($res);
if($res != false){

//echo "12344";
$row = mysqli_fetch_assoc($res); 
?>
<div class="col-md-3 x <?php echo $row['idspPostings']; ?>">
<div class="artBox">
<div class="topartBox">
<?php if(!empty($row['discountphoto'])){ ?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<?php } ?>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<div class="mainOverlay">
<?php
$pic = new _postingpicartcraft;
$res2 = $pic->read($row['idspPostings']);
//print_r($res2); die('======');
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<div class="overlay">
<div class="text">
<a href='<?php echo ($pic2);?>' class='test-popup-link btn' title='<?php echo $row['spPostingTitle']; ?>'><i class="fa fa-search-plus"></i></a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn viewPage"><i class="fa fa-eye"></i></a>
</div>
</div> <?php
} else{
echo "<img alt='Posting Pic' src='../../img/no.png' class='img-responsive'>"; ?>
<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>">
<div class="overlay">
<div class="text">No Image</div>
</div> 
</a>
<?php
} ?>
</div>

<a class="title" href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a>
<p>
<?php
if(strlen($row['spPostingNotes']) < 80){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,80)."...";

} ?>
</p>
<hr>
<div class="row">
<div class="col-md-12">
<!-- <strike>#40.00</strike> -->
<?php


$userid=$_SESSION['uid'];
$c= new _orderSuccess;
$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];



if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
if(empty($row['discountphoto'])){	
echo '<span class="price">  ' .$curr.' '.$row['spPostingPrice'].  '  </span>';
}else{
echo '<span class="price"> ' .$curr.' '.$row['discountphoto'].  '  </span>'; 
}
} 
if(empty($row['discountphoto'])){
}else{ 
echo '  <span class="price text-success" style="color:green;">  <del>  ' .$curr.' '.$row['spPostingPrice']. '  </del></span>  ';

$perto =  ($row['spPostingPrice']-$row['discountphoto'])/$row['spPostingPrice']*100;
echo '  ('.round($perto, 2).'%)  ';
}
if($row['sippingcharge']==1){

echo '<br>  <span class="badge badge-success" style=" background-color: green; ">Free Delivery</span>';
}
else{

echo '<br><br>';
}
?>
</div>
</div>
</div>
<div class="btmartBox">
<ul>
<!-- <img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"> -->

<li><a class="removetoboardashboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove from board"><i class="fa fa-times-circle-o" style="color:white;font-size:27px;"></i></a></li>

<!-- <li><a href="javascrpit:void(0)" data-toggle="tooltip" title="Share"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></a></li> -->
<li><a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" data-toggle="tooltip" title="View Product">
<i class="fa fa-info-circle" aria-hidden="true" style=" font-size: 27px; color: white; "></i>
</a></li>
</ul>
</div>
</div>
</div> <?php
}
}
}
?>

</div>

<div class="row" style=" margin-bottom: 30px; ">	
<div class="col-md-6" style=" text-align: left; ">
<?php
/*
$resallcount = $atb->readMyBoardallcount($_SESSION['pid']);
$allprocount = mysqli_num_rows($resallcount);

$pre = $_GET['page']-1;
$nex = $_GET['page'];
$c2 = $nex*$numrowsw;

if($pre==0){
$c1 = 1;
}else{
$c1 = $pre*8;			
if($c1*2 != $c2){
$c2 = $allprocount;
}
}



echo 'Showing '.$c1.' to '.$c2.' of '.$allprocount.' entries ';
*/
?>
</div>
<div class="col-md-6" style=" text-align: right; ">
<?php if($_GET['page']!=1){ ?>

<a href="/artandcraft/dashboard/your_board.php?page=<?php echo $_GET['page']-1 ;?>">Previous</a>
<?php }  ?>

<?php if($_GET['page']!=1 && $numrowsw==8){ ?>

<span> || </span>

<?php } ?>		
<?php if($numrowsw==8){ ?>	

<a href="/artandcraft/dashboard/your_board.php?page=<?php echo $_GET['page']+1 ;?>">Next</a>

<?php } ?>
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
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>
