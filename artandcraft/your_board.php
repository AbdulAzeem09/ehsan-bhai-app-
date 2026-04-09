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
<div class="panel-heading"> Dashboard / your Board </div>
</div>
<?php

if($_GET['page']==1){
$start = 0;
}else{
$sss = $_GET['page']-1;
$start = 2*$sss;
}

$limitaa = 2;


$atb = new _addtoboard;
$p = new _postingview;

$total = $atb->total_data($_SESSION['pid']);
//var_dump($total);
$countpp=mysqli_num_rows($total);


$result = $atb->readMyBoard($_SESSION['pid'],$start,$limitaa);


if($result != false){
while ($rows = mysqli_fetch_assoc($result)) {

$res = $p->singletimelines($rows['spPosting_idspPosting']);
//var_dump($res);
//echo $p->ta->sql; die;
if($res != false){
$row = mysqli_fetch_assoc($res); 
//var_dump($row);
?>
<div class="col-md-3 <?php echo $row['idspPostings']; ?>">
<div class="artBox">
<div class="topartBox">
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_purple btn-border-radius">Sale</a>
<a href="<?php echo $BaseUrl.'/artandcraft/detail.php?postid='.$row['idspPostings'];?>" class="btn btn_custom bg_green_art btn-border-radius">New</a>
<div class="mainOverlay">
<?php
$pic = new _postingpic;
$res2 = $pic->read($row['idspPostings']);
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
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
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
if(empty($row['spPostingPrice'])){
echo "<span class='price'>Free</span>";
}else{
echo '<span class="price">$ '.$row['spPostingPrice'].'</span>';
}
?>
</div>
</div>
</div>
<div class="btmartBox">
<ul>
<li><a class="removetoboardashboard" data-postid="<?php echo $row['idspPostings']; ?>" data-pid="<?php echo $_SESSION['pid'];?>" data-toggle="tooltip" title="Remove from board"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-add.png" alt="" class="img-responsive"></a></li>

<li><a href="javascrpit:void(0)" data-toggle="tooltip" title="Share"><img src="<?php echo $BaseUrl?>/assets/images/art/icon-share.png" alt="" class="img-responsive"></a></li>
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
<?php 


$page1=$start;


?>
showing <?=$page1?> to <?=$limit?> of <?=$countpp?>





<?php

if($_GET['page']!=''){

?>
<div>
<a href="<?php echo $BaseUrl ?>/artandcraft/dashboard/your_board.php?page=<?=$page+1?>">Next</a>

<div>
</div>
<?php 
}else{
?>
<span>
<a href="<?php echo $BaseUrl ?>/artandcraft/dashboard/your_board.php?page=<?=$page-1?>">Previous</a>

</span>";
<?php
}
}

?>


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
