<?php
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "store/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$_GET['categoryid'] = 1;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>
<?php include('../../component/dashboard-link.php'); ?>


<!--This script for sticky left and right sidebar END-->
<!--CSS FOR MULTISELECTOR-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>

<style>

.featured_box {
  padding: 38px 5px !important;

}
<!--pagination start 
-->
body
{
font-family:
'Roboto',
sans-serif;
font-size:
14px;
line-height:
18px;
background:
#f4f4f4;
}
.list-wrapper
{
padding:
15px;
overflow:
hidden;
}
.list-item
{
display:
contents;
border:
1px
solid
#EEE;
background:
#FFF;
margin-bottom:
10px;
padding:
10px;
box-shadow:
0px
0px
10px
0px
#EEE;
}
.list-item
h4
{
color:
#FF7182;
font-size:
18px;
margin:
0
0
5px;
}
.simple-pagination
ul
{
margin:
0
0
20px;
padding:
0;
list-style:
none;
text-align:
center;
}
.simple-pagination
li
{
display:
inline-block;
margin-right:
5px;
}
.simple-pagination
li
a,
.simple-pagination
li
span
{
color:
#666;
padding:
5px
10px;
text-decoration:
none;
border:
1px
solid
#EEE;
background-color:
#FFF;
box-shadow:
0px
0px
10px
0px
#EEE;
}
.simple-pagination
.current
{
color:
#FFF;
background-color:
#008000;
border-color:
#c45508;
}
.simple-pagination
.prev.current,
.simple-pagination
.next.current
{
background:
#008000;
}
.featured_box
h4
{
margin:
0 !important;
padding:
-8px;
text-align:
center;
}
h4.b
{
white-space:
nowrap;
width:
180px;
overflow:
hidden;
text-overflow:
ellipsis;
}
#profileDropDown
li.active
{
background-color:
#0f8f46;
}
#profileDropDown
li.active
a
{
color:
white;
}
<!--pagination end -->
</style>


<style>
.clr {
color: black ! important;

}
</style>
</head>

<body class="bg_gray">
<?php


//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!--  <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php
$activePage = 7;
//  include('left-menu.php'); 
?>
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-buyermenu.php');
?>
</div>
</div>
<div class="col-md-10">



<?php

$storeTitle = " Dashboard / Favourite Products";
$folder = "store";
//  include('../top-dashboard.php');
//include('../searchform.php');

?>

<div class="row">
<div class="col-sm-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
<li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>">Buyer Dashboard</a></li>

<li><a href="#">My Favourite</a></li>

</ul>
</div>
<!-- Retail Open -->
<!--  <div class="row">  -->
<div class="col-sm-12">
<div class="heading03">
<h3>Retail<span class="pull-right"></span></h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_one">
<div class="carousel-inner">
<div class="list-wrapper">

<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}

$p = new _productposting;

$res = $p->allretailfavrouiteproduct(1, $_SESSION['pid']);
if ($account_status != 1) {
if ($res != false) {

while ($rows = mysqli_fetch_assoc($res)) {
$curr = $rows['default_currency'];
?>


<div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
<div class="list-item">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box" style="margin-bottom: 15px;">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">

<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img style='height:168px' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='height:168px' alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img style='height:168px' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='height:168px' alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>


</a>
</div>
<h4 class="b">

<?php
//echo $rows['spPostingTitle'];
if (!empty($rows['spPostingTitle'])) {

if (strlen($rows['spPostingTitle']) < 10) {
//echo 1;

?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
} else {
//echo 2;

?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 10)) . '...'; ?></a><?php
}
} else {
//echo 3;
echo "&nbsp;";
}
?>

</h4>

<h5>

<?php
if ($rows['retailSpecDiscount'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rows['retailSpecDiscount'] . "'>" . $curr . ' ' . $rows['retailSpecDiscount'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
} else {
echo "Expires on" . $rows['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div>
</div> <?php

// $i++;
}
}
} else {
echo "<h4 class='text-center'>No Product Available</h4>";
}



?>

</div>
</div>
<!--<div id="pagination-container"></div>-->
</div>


</div>

<div class="col-sm-12">
<div class="heading03">
<h3>WholeSale<span class="pull-right"></span></h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_four">
<div class="carousel-inner">


<?php

$resw = $p->allwholesalefavrouiteproduct(1, $_SESSION['pid']);
//print_r($resw);
//die('=====');

//  echo $p->ta->sql;
//  $active = 0;
if ($account_status != 1) {
if ($resw != false) {
while ($rowsw = mysqli_fetch_assoc($resw)) {
// print_r($rowsw);
// die('====='); 


?>

<div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box" style="margin-bottom: 15px;">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>">
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
echo "<img style='height:168px' alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img style='height:168px' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='height:168px' alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>

</a>
</div>
<h4>

<?php

if (!empty($rowsw['spPostingTitle'])) {
if (strlen($rowsw['spPostingTitle']) < 15) {
?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords($rowsw['spPostingTitle']); ?></a><?php
} else {
?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowsw['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rowsw['spPostingTitle']; ?>"><?php echo ucwords(substr($rowsw['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
}
} else {
echo "&nbsp;";
}
?>

</h4>
<h5>

<?php
if ($rowsw['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rowsw['spPostingPrice'] . "'>" . $curr . ' ' . $rowsw['spPostingPrice'] . "</div><span class='" . ($rowsw['idspCategory'] == 5 || $rowsw['idspCategory'] == 18 || $rowsw['idspCategory'] == 9 || $rowsw['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
} else {
echo "Expires on " . $rowsw['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div><?php

// $i++;
}
}
} else {
echo "<h4 class='text-center'>No Product Available</h4>";
}


?>


</div>

</div>


</div>
<div class="col-sm-12">
<div class="heading03">
<h3>Personal<span class="pull-right"></span></h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_one">
<div class="carousel-inner">
<div class="list-wrapper">

<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}

$p = new _productposting;

$res = $p->all__Personal(1, $_SESSION['pid']);


if ($account_status != 1) {
if ($res != false) {

while ($rows = mysqli_fetch_assoc($res)) {
$curr = $rows['default_currency'];

?>


<div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
<div class="list-item">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box" style="margin-bottom: 15px;">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">

<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
  //echo "heloo";
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img style='height:168px' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='height:168px' alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>


</a>
</div>
<h4 class="b">

<?php
//echo $rows['spPostingTitle'];
if (!empty($rows['spPostingTitle'])) {

if (strlen($rows['spPostingTitle']) < 10) {
//echo 1;

?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
} else {
//echo 2;

?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 10)) . '...'; ?></a><?php
}
} else {
//echo 3;
echo "&nbsp;";
}
?>

</h4>

<h5>

<?php
if ($rows['retailSpecDiscount'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rows['retailSpecDiscount'] . "'>" . $curr . ' ' . $rows['retailSpecDiscount'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
} else {
echo "Expires on" . $rows['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div>
</div> <?php

// $i++;
}
}
} else {
echo "<h4 class='text-center'>No Product Available</h4>";
}



?>

</div>
</div>
<!--<div id="pagination-container"></div>-->
</div>


</div>
<div class="col-sm-12">
<div class="heading03">
<h3>Auction<span class="pull-right"></span></h3>
</div>

<div class="carousel carousel-showmanymoveone slide" id="itemslider_five">
<div class="carousel-inner">



<?php


$resa = $p->allauctionfavrouiteproduct(1, $_SESSION['pid']);

// echo $p->ta->sql;  
//   $active = 0;
if ($account_status != 1) {
if ($resa != false) {
while ($rows = mysqli_fetch_assoc($resa)) {
/* echo "<pre>";
print_r($rows) ; */

?>


<div class="item <?php echo ($active == 0) ? 'active' : ''; ?>">
<div class="col-xs-5ths">
<div class="featured_box text-center">
<div class="img_fe_box" style="margin-bottom: 15px;">
<a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>">
<?php
$pic = new _productpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img style='height:168px' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='height:168px' alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
} else {
if ($result != false) {
$rp = mysqli_fetch_assoc($result);
$picture = $rp['spPostingPic'];
echo "<img style='height:168px' alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
} else
echo "<img style='height:168px' alt='Posting Pic' src='../../assets/images/blank-img/no-store.png' class='img-responsive'>";
}
?>

</a>
</div>
<h4>

<?php

if (!empty($rows['spPostingTitle'])) {
if (strlen($rows['spPostingTitle']) < 15) {
?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords($rows['spPostingTitle']); ?></a><?php
} else {
?><a class="clr" href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rows['idspPostings']; ?>" data-toggle="tooltip" title="<?php echo $rows['spPostingTitle']; ?>"><?php echo ucwords(substr($rows['spPostingTitle'], 0, 15)) . '...'; ?></a><?php
}
} else {
echo "&nbsp;";
}
?>

</h4>
<h5>

<?php
if ($rows['spPostingPrice'] != false) {
echo "<div class='postprice text-center' style='' data-price='" . $rows['spPostingPrice'] . "'>" . $curr . ' ' . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
} else {
echo "Expires on " . $rows['spPostingExpDt'];
}
?>


</h5>

</div>
</div>
</div> <?php

//$i++;
}
}
} else {
echo "<h4 class='text-center'>No Product Available</h4>";
}

?>

</div>
</div>
</div>
</div>
</tbody>
</table>
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
}
?>

