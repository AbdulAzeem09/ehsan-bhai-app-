<?php
include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = $_GET["categoryID"] = "8";
$_GET["categoryName"] = "Trainings";
$header_train = "header_train";


if (isset($_GET['postid']) && $_GET['postid'] > 0) {
$postid = $_GET['postid'];
$p = new _postings;
$pf  = new _postfield;

$result = $p->read_training($postid);

//echo $p->ta->sql;
if($result != false){
$row = mysqli_fetch_assoc($result);
 //print_r($row);
 //exit;
$ProTitle   = $row['spPostingTitle'];
$Category	= $row['trainingcategory'];
$ProDes     = $row['spPostingNotes'];
$spPostingTraimnerBio =$row['spPostingTraimnerBio'];
$company=$row['spPostingCompany'];
$video_level=$row['videolevel'];
$total_hour=$row['totalhour'];
$ArtistName = $row['spProfileName'];
$ArtistId   = $row['idspProfiles'];
$ArtistAbout= $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city      = $row['spPostingsCity'];
$txtDiscount=$row['txtDiscount'];
$requirmnet=$row['spRequiremnt'];
$currency=$row['default_currency'];
$seller_pid=$row['spprofiles_idspprofiles'];
$seller_uid=$row['spuser_idspuser'];

if($price!='' && $txtDiscount!=''){

$discountedPrice = $price - ($price* ($txtDiscount/100));
//echo  $price.'xxxxxxxxxxx';
//echo  $txtDiscount;
//die("====");
}else{
$discountedPrice=$price;

}

}

}else{
$re = new _redirect;
$redirctUrl = "../trainings";
$re->redirect($redirctUrl);
}


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
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php include('../../component/dashboard-link.php'); ?>
</head>
<style>
.detail_h{
	font-size:20px;
}
#profileDropDown li.active {
  background-color: #417281 !important;
  margin-top: -1px;
}
#profileDropDown li.active a {
  color: #fff !important;
}
.sidebar-menu {
	    padding-bottom: 660px;
}
.main_box {
    padding-bottom: 0px;
}
</style>
<body class="bg_gray">
<?php
include_once("../../header.php");
?>
<section class="main_box">
<div class="container" style="width:100%;"> 
<div class="row">
<div class="sidebar col-md-2 no-padding left_train_menu" id="sidebar" >
<?php include('left-menu.php'); ?> 
</div>
<div class="col-md-10">

<!--<span class="detail_h">Course Title : </span></b>-->
<h1 class="text-justify" style="word-wrap: break-word; font-weight:bold !important;
"><?php echo strtoupper($ProTitle);  ?></h1>

<span class="detail_h"><b>Description :</b></span>
<span class="text-justify" style="word-wrap: break-word;"><?php echo $ProDes; ?></span>



<br>
<br>
<span class="detail_h"><b>Requirements :</b></span>
<span style="word-wrap: break-word;"><?php echo $requirmnet; ?></span>
<br>
<br>

<style>
*{
    margin: 0;
    padding: 0;
}
.rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:25px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: gold;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked  label:hover  label,
.rate > label:hover  input:checked  label {
    color: #c59b08;
}

/ Modified from: https://github.com/mukulkant/Star-rating-using-pure-css /


</style>
<?php 
$p = new _trainingrating;
    $result=$p->read_purchase($_GET["postid"]);
if($result != false){
$row = mysqli_fetch_assoc($result);
//print_r($row);die('===333');
$rating=$row['rating'];
}

?>
<form method="post">
 <div class="rate rate pull-right">
    <input type="radio" id="star5" name="rate" value="5" <?php if($rating==5){ echo "checked";} ?> />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rate" value="4"  <?php if($rating==4){ echo "checked";} ?> />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rate" value="3" <?php if($rating==3){ echo "checked";} ?> />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rate" value="2"  <?php if($rating==2){ echo "checked";} ?> />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rate" value="1"  <?php if($rating==1){ echo "checked";} ?> />
    <input type="hidden" id="post_id" name="post_id" value="<?php echo $_GET['postid']; ?>" />
    <input type="hidden" id="pid" name="pid" value="<?php echo $_SESSION['pid']; ?>" />
    <input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uid']; ?>" />
    <label for="star1" title="text">1 star</label>
  </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("input[name=rate]").click(function(){
   var aa=$("input[name=rate]:checked").val();
   var id=$("#post_id").val();
   var pid=$("#pid").val();
   var uid=$("#uid").val();
   $.ajax({
        url: "rating.php",
        type: "post",
        data: {rate : aa,post_id:id,pid:pid,uid:uid} ,
        success: function (response) {
          //alert(response);

        }
    });


  });
});
</script>

<h3>Details</h3>
<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody>
<tr>
<td>Category</td>
<td><?php echo $Category; ?></td>
</tr>


<tr>
<td>Company</td>
<td><?php echo $company; ?></td>
</tr>
<tr>
<td>Video Level</td>
<td><?php echo $video_level; ?></td>
</tr>
<tr>
<td>Total Hour</td>
<td><?php echo $total_hour; ?></td>
</tr>

</tbody>
</table>
</div>

<!--<div class="row">
<div class="col-md-12 ">
<h3>Cover Images</h3>
</div>
<div class="col-xs-5ths">
<?php
$limit = 10;
$orderBy = "DESC";
$p   = new _postings;


$res = $p->read_cover_images($_GET['postid']); 

if($res){
$i=0;
while ($row = mysqli_fetch_assoc($res)) {
	 $pic2 = $row['filename'];
if ($i < 4) {?>

<div class="course_Box">
<div class="">
<!--<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>">-->
<?php
/*$pic = new _postings;
$res2 = $pic->read_cover_images($row['id']);
//echo $pic->ta->sql;
                                               
$rp = mysqli_fetch_assoc($res2);*/
if($pic2 != false){ 
//echo "<a  target='blank' href='".$BaseUrl.'/post-ad/uploads/'.$pic2."'><img alt='Posting Pic' class='img-responsive imgMain' src=' " .$BaseUrl.'/post-ad/uploads/'.($pic2) . "' ></a>"; 

}else{
//echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
}
?>
<!--</a>


</div>

</div>-->

 <?php
$i++;
}else{
break;
}
}
}else{
//echo "<h4 style='text-align:center;'>No Cover Images !</h4>";
}
//}
?>
<!--</div>  
</div>-->




<div class="row" style="margin-left: 5px;">

<!--<div class="col-xs-5ths" style="width: 35%;">-->
<h3>Introduction Video</h3>

<?php
$limit = 10;
$orderBy = "DESC";
$p   = new _postings;


$res = $p->read_preview_video($_GET['postid']); 

if($res){
$i=0;
while ($row = mysqli_fetch_assoc($res)) {?>
<div class="col-md-4">
  <?php 
	 $pic2 = $row['filename'];
if ($i < 4) {?>

<!--<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>">-->
<?php
/*$pic = new _postings;
$res2 = $pic->read_cover_images($row['id']);
//echo $pic->ta->sql;
                                               
$rp = mysqli_fetch_assoc($res2);*/
if($pic2 != false){ 
echo "<video width='320' height=240' controls>
  <source src='$BaseUrl/post-ad/uploads/$pic2' type='video/mp4'></video>"; 

}else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>"; 
}
?>
</a>


 <?php
$i++;
}else{
break;
}
?>
</div>

<?php 
}
}else{
echo "<h4>No Introduction Video !</h4>";
}
//}
?>

</div>


<div class="row" style="margin-left: 5px;">
<!--<div class="col-xs-5ths" style="width: 100%;">-->
<h3>Description Video</h3>

<?php
$limit = 10;
$orderBy = "DESC";
$p   = new _postings;


$res = $p->read_video_tr($_GET['postid']);     

if($res){
$i=0;
while ($row = mysqli_fetch_assoc($res)) { ?>
<div class="col-md-4" >
  <?php 
	 $pic2 = $row['filename'];
if ($i < 4) {?>


<?php

if($pic2 != false){ 
echo "<span style='178px;'><video width='320' height='240'  controls>
  <source src='$BaseUrl/upload/training/$pic2' type='video/mp4'></video></span>";  

}else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
}
?>


 <?php
$i++;
}else{
break;
}
?>
</div>  
<?php 
}
}else{
echo "<h4>No Description Video !</h4>";    
}
//}
?>
<!--</div>-->

</div>
<!--</div>-->

<div class="row">
<div class="col-md-12 ">
<h3>Attachments</h3>
</div>
<div class="col-xs-5ths">
<div >
<?php
$limit = 10;
$orderBy = "DESC";
$p   = new _postings;


$res = $p->read_attachment($_GET['postid']); 

if($res){
$i=0;
while ($row = mysqli_fetch_assoc($res)) {
	 $pic2 = $row['filename'];
if ($i < 4) {?>


<?php

if($pic2 != false){ 
echo "<embed src='$BaseUrl/post-ad/uploads/$pic2' width='350px' height='250px' />
<a href='$BaseUrl/post-ad/uploads/$pic2' download>Download</a>
"; 

}else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
}
?>
</a>



 <?php
$i++;
}else{
break;
}
}
}else{
echo "<h4 style='text-align:center;'>No Attachments !</h4>";
}
//}
?>

</div>
</div>
</div>


</section>

<!--<div class="space-lg"></div>-->

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
$(document).ready(function(){
	
	 var table = $('#example').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false
        }]
});
   //End of create main table

  
  $('#example tbody').on( 'click', 'tr', function () {
   
   // alert(table.row( this ).data()[0]);

} );


$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-id");
swal({
title: "Delete Training",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/trainings/deletePost.php?postid=' + dataId;
} 
});
// alert(dataId);
});
});
</script>
</body>
</html>
<?php
}
?>
