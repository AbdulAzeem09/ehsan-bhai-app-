<?php
//die('+++++++++++');
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
session_start();
include('../univ/baseurl.php');


// print_r($_SESSION['pid']);
//echo $BaseUrl;die('+++++++++++');

if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");

}else{

function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET['categoryID'] = 1;



?>

<!DOCTYPE html>
<html lang="en-US">

<head>

<?php include('../component/f_links.php');?>
<?php include('store_headpart.php');?>

<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>

<!--CSS FOR MULTISELECTOR-->
<link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<script type="text/javascript">
//USER ONE
$(function () {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});

});


$(function(){
$("#dynamic_price").on('change', function(){
// alert();

$("#price_form").submit();
return true;


});

});

</script>
<style type="text/css">
  .left_head_top img {
 margin: -4px 31px 0px 0px !important;

}

.dropdown-toggle::after {
    content: none;
  }

.featured_box img {
margin: 0 auto!important;
height: 112px!important;
}


.carousel-inner > .item {

display: block;

}
#profileDropDown li.active {
background-color: #0f8f46;
}
#profileDropDown li.active a {
color:white;
}
</style>   
</head>

<body class="bg_gray">



<?php
//this is for store header
$header_store = "header_store";
include_once("../header.php");
//echo $_SESSION["pid"]; 



?>


<section class="main_box">
<div class="container">
<div class="row">

<div class="col-md-12">
<?php 
include('top-dashboard.php');
//include('searchform.php');
?>
<?php
//   echo $p->ta->sql;
$g = new _spgroup;
// $p = new _postingview;
$res = $g->profilememberslimit($_SESSION['pid']);
//  echo $g->ta->sql;


$active = 0;
?>



<!-- Retail Open -->      
<!--    <div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Group store<span class="pull-right seemore">
<?php if($res != false){ ?>
<a class="pull-right" href="<?php echo $BaseUrl.'/store/view_all_group_store.php?groupstore=group';?>" style="color: #0b241e;">See More</a>
<?php } ?>
</span></h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_one">
<div class="carousel-inner">

<?php





if($res != false){

while ($rows = mysqli_fetch_assoc($res)) {
if($rows['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($rows['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
}
//print_r($rows);

// print_r($rows['spGroupName']);
//https://thesharepage.com/grouptimelines/group-store.php?groupid=297&groupname=My%20First%20Group%201&store
if($account_status!=1){ ?>


<div class="item <?php echo ($active == 0)?'active':'';?>">

<div class="col-xs-5ths">
<div class="featured_box">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl.'/grouptimelines/group-store.php?groupid='.$rows['idspGroup'].'&groupname='.$rows['spGroupName'].'&store';?>"> 

<?php 
$picture1 = $rows['spgroupimage'];
//echo $picture;


?> 
<?php   if ($picture1) { ?>

<img src= "<?php echo $BaseUrl.'/uploadimage/'.$picture1; ?>"   alt="banner Pic" class="img-responsive"  >


<?php } else{ ?>

<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>
<?php }?>



</a>
</div>

<ul style="padding-left: 10px;display: grid;">

<li>
<h4 style="background-color: unset;float: left;padding: 0px;">

<?php 



if(!empty($rows['spGroupName'])){
if(strlen($rows['spGroupName']) < 15){
?><a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $rows['idspGroup']?>&groupname=<?php echo $rows['spGroupName']?>&timeline&page=1" data-toggle="tooltip" title="<?php echo $rows['spGroupName']; ?>" style="color: #0b241e; font-weight: 600; text-transform: capitalize;"><?php echo ucwords($rows['spGroupName']); ?></a><?php
}else{
?><a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $rows['idspGroup']?>&groupname=<?php echo $rows['spGroupName']?>&timeline&page=1" data-toggle="tooltip" title="<?php echo $rows['spGroupName']; ?>" style="color: #0b241e;font-weight: 600; text-transform: capitalize;"><?php echo ucwords(substr($rows['spGroupName'], 0,15)).'...'; ?></a><?php
  }
}else{
  echo "&nbsp;";
}
?>    
</h4>
</li>

<li>
<h5 style="float: left;">


<?php
if ($rows['spProfileName'] != false) {?>
<a href="<?php echo $BaseUrl?>/friends/?profileid=<?php echo $rows['idspProfiles']?>" style="color: #0b241e; font-weight: 600; text-transform: capitalize;"><?php echo ucwords(substr($rows['spProfileName'], 0,15)); ?></a>

<?php }?>
 

</h5>
</li>
<?php  
$result3 = $g->joinedMembersOfGroup($rows['idspGroup']);
// echo $rows['idspGroup'];

$total_member = mysqli_num_rows($result3);
$result4 = $g->newgrpmember($rows['idspGroup']);

                          //echo $g->tad->sql;
if(!empty($result4)){
$new_tot_member = mysqli_num_rows($result4);
}else{
$new_tot_member = 0;
                  }
?>

<li>
<h5 style="float: left;">


<a style="color: #1c6121; color: #0b241e; font-weight: 600; text-transform: capitalize;" href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $rows['idspGroup']?>&groupname=<?php echo $rows['spGroupName']?>&timeline"><?php echo $total_member; ?> members.</a>


</h5>
</li>




</ul>
</div>
</div>


</div> <?php
$active++;
}
}}else{

echo "<h4 class='text-center'>No Group Store Available</h4>";
}
?>

</div>

<!--     <div id="slider-control" class="scndSlideStr" >
<a class="left carousel-control" href="#itemslider_one" data-slide="prev"><i class="fa fa-angle-left"></i></a>
<a class="right carousel-control" href="#itemslider_one" data-slide="next"><i class="fa fa-angle-right"></i></a>
</div> 
</div>


</div>
</div> --> 
<!-- group close -->


<!-- Retail Open -->      
<div class="row">
<?php

$g = new _spgroup;
// $p = new _postingview;
$resR = $g->readmyretailgroupstorelimit($_SESSION['pid']);


$active = 0;
?>


<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Retail<span class="pull-right seemore">
<?php  if($resR != false){ ?>
<a class="pull-right" href="<?php echo $BaseUrl.'/store/view_all_group_store.php?groupstore=retail';?>" style="color: #0b241e;">See More</a>
<?php } ?>
</span></h3>
</div>


<div class="carousel carousel-showmanymoveone slide" id="itemslider_one">
<div class="carousel-inner">

<?php


if($resR != false){

while ($rows = mysqli_fetch_assoc($resR)) {
if($rows['spuser_idspuser']!=NULL){
$st= new _spuser;

$st1=$st->readdatabybuyerid($rows['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
}

if($account_status!=1){
?>


<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<!-- <div class="featured_box text-center"> -->
<div class="featured_box ">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>">

<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
    $rp = mysqli_fetch_assoc($result);
    $picture = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
    echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
    $rp = mysqli_fetch_assoc($result);
    $picture = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
    echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>


</a>
</div>

<ul style="padding-left: 10px;display: grid;">

<li>
<h4 style="background-color: unset;float: left;padding: 0px;">

<?php 

if(!empty($rows['spPostingTitle'])){
if(strlen($rows['spPostingTitle']) < 15){
      ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
  }else{
      ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
  }
}else{
  echo "&nbsp;";
}
?>    

</h4>
</li>

<li>
<h5 style="float: left;">
<?php

$userid=$_SESSION['uid'];


$c= new _orderSuccess;


$currency= $c->readcurrency($userid);
$res1= mysqli_fetch_assoc($currency);
$curr=$res1['currency'];
?>
<?php
if ($rows['spPostingPrice'] != false) {
echo "<div class='postprice' style='' data-price='" . $rows['spPostingPrice'] . "'>" .$rows['default_currency'].' '. $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}else{
echo "Expires on".$rows['spPostingExpDt'];
}
?>


</h5>
</li>


<?php


$mr = new _spstorereview_rating;

$resultsum1 = $mr->readstorerating($rows['idspPostings']);

// echo $mr->ta->sql;

if($resultsum1 != false){



$totalmyreviews1 = $resultsum1->num_rows;

//echo"here";  
//  echo $totalreviews;


while($rowreview1 = mysqli_fetch_assoc($resultsum1)){

$sumrevrating1 += $rowreview1['rating'];

$rateingarr1[] =  $rowreview1['rating'];

}  

$count1 = count($rateingarr1);

$reviewaveragerate1 = $sumrevrating1 / $count1;

$totalreviewrate1  = round($reviewaveragerate1, 1);

//   echo $totalreviewrate1;

}      


?>
<li>
<p class="rating_box">

<div class="rating-box">
<?php if($totalreviewrate1 >= "5") { 
echo '<div class="ratings" style="width:100%;"></div>';
}else  if($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") { 
echo '<div class="ratings" style="width:92%;"></div>';
}
else  if($totalreviewrate1 >= "4") { 
echo '<div class="ratings" style="width:80%;"></div>';
}else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
echo '<div class="ratings" style="width:72%;"></div>';
}else  if($totalreviewrate1 >= "3") { 
echo '<div class="ratings" style="width:60%;"></div>';
}else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
echo '<div class="ratings" style="width:51%;"></div>';
}else  if($totalreviewrate1 >= "2") { 
echo '<div class="ratings" style="width:38%;"></div>';
}else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
echo '<div class="ratings" style="width:29%;"></div>';
}else  if($totalreviewrate1 >= "1") { 
echo '<div class="ratings" style="width:16%;"></div>';
}else  if($totalreviewrate1 <= "0") { 
echo '<div class="ratings" style="width:0%;"></div>';
}

?>

</div>



<!--      <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a> -->
</p>
</li>           
</ul>
</div>
</div>
</div>



<?php
$active++;
}

}}else{

echo "<h4 class='text-center'>No Group Store Available</h4>";
}?>

</div>

<!--     <div id="slider-control" class="scndSlideStr" >
<a class="left carousel-control" href="#itemslider_one" data-slide="prev"><i class="fa fa-angle-left"></i></a>
<a class="right carousel-control" href="#itemslider_one" data-slide="next"><i class="fa fa-angle-right"></i></a>
</div> -->
</div>
</div>

</div>  

<!-- Retail Close -->   



<!-- Wholesale Open -->

<div class="row">
<?php

$g = new _spgroup;
// $p = new _postingview;
$resw = $g->readmywholesalegroupstorelimit($_SESSION['pid']);
//echo $g->ta->sql;

$active = 0;
?>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>WholeSale<span class="pull-right seemore">
<?php if($resw != false){?>
<a class="pull-right" href="<?php echo $BaseUrl.'/store/view_all_group_store.php?groupstore=wholesale';?>" style="color: #0b241e;">See More</a>
<?php } ?>
</span></h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_four">
<div class="carousel-inner">


<?php


if($resw != false){
while ($rowsw = mysqli_fetch_assoc($resw)) {
if($rowsw['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($rowsw['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
}
if($account_status!=1){

// print_r($rows);

?>



<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<!-- <div class="featured_box text-center"> -->
<div class="featured_box">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>">
<?php
$pic = new _productpic;
$result = $pic->read($rowsw['idspPostings']);
//echo $pic->ta->sql;
if ($rowsw['idspCategory'] != 5 && $rowsw['idspCategory'] != 2) {
if ($result != false) {
    $rp = mysqli_fetch_assoc($result);
    $picture = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
    echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
    $rp = mysqli_fetch_assoc($result);
    $picture = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
    echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>

</a>
</div>
<ul style="padding-left: 10px;display: grid;">

<li>
<h4 style="background-color: unset;float: left;padding: 0px;">

<?php 

if(!empty($rowsw['spPostingTitle'])){
  if(strlen($rowsw['spPostingTitle']) < 15){
      ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords($rowsw['spPostingTitle']); ?></a><?php
  }else{
      ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rowsw['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords(substr($rowsw['spPostingTitle'], 0,15)).'...'; ?></a><?php
  }
}else{
  echo "&nbsp;";
}
?>    

</h4>
</li>


<li>
<h5 style="float: left;">

<?php
if ($rowsw['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rowsw['spPostingPrice'] . "'>".$rowsw['default_currency'].' ' . $rowsw['spPostingPrice'] . "/Pieces</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}else{
echo "Expires on ".$rowsw['spPostingExpDt'];
}
?>


</h5>

<?php


$mr = new _spstorereview_rating;

$resultsum3 = $mr->readstorerating($rowsw['idspPostings']);

//  echo $mr->ta->sql;

if($resultsum3 != false){



$totalmyreviews3 = $resultsum3->num_rows;

//echo"here";  
//  echo $totalreviews;


while($rowreview3 = mysqli_fetch_assoc($resultsum3)){

$sumrevrating3 += $rowreview3['rating'];

$rateingarr3[] =  $rowreview3['rating'];

}  

$count3 = count($rateingarr3);

$reviewaveragerate3 = $sumrevrating3 / $count3;

$totalreviewrate3  = round($reviewaveragerate3, 1);

}      


?>
</li>
<li>
<h5>Min order: <?php echo $rowsw['minorderqty'];  ?> Pieces</h5>

</li>
<li>
<p class="rating_box">

<div class="rating-box">
<?php if($totalreviewrate3 >= "5") { 
echo '<div class="ratings" style="width:100%;"></div>';
}else  if($totalreviewrate3 >= "4" && $totalreviewrate3 < "5") { 
echo '<div class="ratings" style="width:92%;"></div>';
}
else  if($totalreviewrate3 >= "4") { 
echo '<div class="ratings" style="width:80%;"></div>';
}else  if($totalreviewrate3 > "3" && $totalreviewrate3 < "4") { 
echo '<div class="ratings" style="width:72%;"></div>';
}else  if($totalreviewrate3 >= "3") { 
echo '<div class="ratings" style="width:60%;"></div>';
}else  if($totalreviewrate3 > "2" && $totalreviewrate3 < "3") { 
echo '<div class="ratings" style="width:51%;"></div>';
}else  if($totalreviewrate3 >= "2") { 
echo '<div class="ratings" style="width:38%;"></div>';
}else  if($totalreviewrate3 > "1" && $totalreviewrate3 < "2") { 
echo '<div class="ratings" style="width:29%;"></div>';
}else  if($totalreviewrate3 >= "1") { 
echo '<div class="ratings" style="width:16%;"></div>';
}else  if($totalreviewrate3 <= "0") { 
//echo '<div class="ratings" style="width:0%;"></div>';
}

?>

</div>


<!--      <a href="#">(<?php if($totalmyreviews > 0){ echo $totalmyreviews; }else{ echo "0"; }?>)</a> -->
</p>
</li>

</div>
</div>
</div> 



<?php
$active++;
}
}}else{

echo "<h4 class='text-center'>No Group Store Available</h4>";
}?>

</div>

<!--      <div id="slider-control" class="scndSlideStr" >
<a class="left carousel-control" href="#itemslider_four" data-slide="prev"><i class="fa fa-angle-left"></i></a>
<a class="right carousel-control" href="#itemslider_four" data-slide="next"><i class="fa fa-angle-right"></i></a>
</div> -->
</div>


</div>
</div>  



<!-- wholesaler close  -->


<!-- Auction open -->



<div class="row">
<?php
$g = new _spgroup;
// $p = new _postingview;
$resA = $g->readmyauctiongroupstorelimit($_SESSION['pid']);

$active = 0;
?>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="heading03">
<h3>Auction<span class="pull-right seemore">
<?php if($resA != false){ ?>
<a class="pull-right" href="<?php echo $BaseUrl.'/store/view_all_group_store.php?groupstore=auction';?>" style="color: #0b241e;">See More</a>
<?php } ?>
</span></h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_five">
<div class="carousel-inner">



<?php

if($resA != false){
while ($rows = mysqli_fetch_assoc($resA)) {
if($rows['spuser_idspuser']!=NULL){
$st= new _spuser;
$st1=$st->readdatabybuyerid($rows['spuser_idspuser']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
}
if($account_status!=1){
/* echo "<pre>";
print_r($rows) ; */

?>


<div class="item <?php echo ($active == 0)?'active':'';?>">
<div class="col-xs-5ths">
<!--  <div class="featured_box text-center"> -->
<div class="featured_box ">
<div class="img_fe_box" style="border: 0px solid #ccc;">
<a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
    $rp = mysqli_fetch_assoc($result);
    $picture = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
    echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}else{
if ($result != false) {
    $rp = mysqli_fetch_assoc($result);
    $picture = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
    echo "<img alt='Posting Pic' src='../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>

</a>
</div>
<ul style="padding-left: 10px;display: grid;">

<li>
<h4 style="background-color: unset;float: left;padding: 0px;">

<?php 

if(!empty($rows['spPostingTitle'])){
  if(strlen($rows['spPostingTitle']) < 15){
      ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
  }else{
      ?><a href="<?php echo $BaseUrl.'/store/detail.php?catid=1&postid='.$rows['idspPostings'];?>" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0,15)).'...'; ?></a><?php
  }
}else{
  echo "&nbsp;";
}
?>    

</h4>
<li>
<h5 style="float: left;">

<?php
if ($rows['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>" .$rows['default_currency'].' '. $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
}else{
echo "Expires on ".$rows['spPostingExpDt'];
}
?>


</h5>
</li>
<input type="hidden" id="auctionexpid<?php echo $rows['idspPostings']?>" value="<?php echo $rows['idspPostings']?>">

<input type="hidden" id="auctionexp<?php echo $rows['idspPostings']?>" value="<?php echo $rows['spPostingExpDt']?>">

<script type="text/javascript">

$(document).ready(function(){
// we call the function
get_auctionexpdata("<?php echo $rows['idspPostings'];?>");


});
</script> 

<li style="padding-top: 10px;">
<span id="auction_enddate<?php echo $rows['idspPostings']?>"></span>  
</li>   


</div>
</div>
</div> 


<?php
$active++;
}
}}else{

echo "<h4 class='text-center'>No Group Store Available</h4>";
}?>

</div>


</div>


</div>
</div>   

<!-- Auction close -->

</div>
</div>
</div>
</section>




<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!--Javascript-->
          <!-- <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-3.2.1.slim.min.js"></script> -->
          <!-------<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script> ---------->
          <script>
            (function ($) {
              "use strict";
              var fullHeight = function () {
                $(".js-fullheight").css("height", $(window).height());
                $(window).resize(function () {
                  $(".js-fullheight").css("height", $(window).height());
                });
              };
              fullHeight();
              $("#leftsidebarCollapse").on("click", function () {
                $("#leftsidebar").toggleClass("active");
              });
            })(jQuery);
          </script>
<script type="text/javascript">

function get_auctionexpdata(id){


var auction_exp = $("#auctionexp"+id).val()

// alert(auction_exp);
//if(selltype == "Auction"){

var countDownDate = new Date(auction_exp).getTime();


var x = setInterval(function() {

// Get today's date and time
var now = new Date().getTime();


/* alert(now);*/

// Find the distance between now and the count down date
var distance = countDownDate - now;
/*
alert(distance);*/

// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);



if(days > 0 && hours > 0 && minutes > 0 && seconds > 0){

document.getElementById("auction_enddate"+id).innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";

document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";

document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h "
+ minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours > 0 && minutes > 0 && seconds > 0){

document.getElementById("auction_enddate"+id).innerHTML = hours + "h "
+ minutes + "m " + seconds + "s ";

document.getElementById("oldbidtime").innerHTML =  hours + "h "
+ minutes + "m " + seconds + "s ";

document.getElementById("lowbidtime").innerHTML =  hours + "h "
+ minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours <= 0 && minutes > 0 && seconds > 0){

document.getElementById("auction_enddate"+id).innerHTML =  minutes + "m " + seconds + "s ";

document.getElementById("oldbidtime").innerHTML =   minutes + "m " + seconds + "s ";

document.getElementById("lowbidtime").innerHTML =   minutes + "m " + seconds + "s ";

}else if(days <= 0 && hours <= 0 && minutes <= 0 && seconds > 0){

document.getElementById("auction_enddate"+id).innerHTML = seconds + "s ";

document.getElementById("oldbidtime").innerHTML =   seconds + "s ";

document.getElementById("lowbidtime").innerHTML =  seconds + "s ";

}

// Output the result in an element with id="demo"



if(days == 0 && hours == 0 && minutes <= 5 ){

$('#auction_end').show();
$('#AuctionPrice').hide();
$('.placebidAuction').hide();
$('#bidmsg').hide();
/*alert();*/
}
// If the count down is over, write some text 
if (distance < 0) {
clearInterval(x);
document.getElementById("auction_enddate"+id).innerHTML = "EXPIRED";
}
}, 1000);


//alert(auction_exp);



}
</script>
<script>

function execute(settings) {
$('#sidebar').hcSticky(settings);
}

// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute({
top: 20,
bottom: 50
});
}
});

function execute_right(settings) {
$('#sidebar_right').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});

</script>
<!--This script for sticky left and right sidebar END--> 

</body>
</html>
<?php
}
?>