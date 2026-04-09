<?php
include('../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/check.php");
}else{
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<?php include('../component/f_links.php');?>
<?php include('../store/store_headpart.php');?>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" class="">
<style type="text/css">

p.img_text {
    margin-top: 17px;
}

.dropdown-toggle::after {
content: none;
}
.navbar-nav li {
padding: 10px 4px !important;
}
.innerBoxvdo {
padding: 13px 10px 0px 10px !important;
}
textarea {
resize: none!important;
}
body {
font-family: 'Roboto', sans-serif;
/* font-size: 14px; */
line-height: 18px;
background: #f4f4f4;
}
.list-wrapper {
padding: 15px;
overflow: hidden;
}
.form-select {
font-size:1.5rem!important;
} 
.form-control {
font-size:1.5rem!important;
}
.btn.btn-primary {
font-size:1.5rem!important;
}
.input-group .btn {
font-size:1.5rem!important;
}
.list-item {
display: contents;
border: 1px solid #EEE;
background: #FFF;
margin-bottom: 10px;
padding: 10px;
box-shadow: 0px 0px 10px 0px #EEE;
}
.list-item h4 {
color: #FF7182;
font-size: 18px;
margin: 0 0 5px;	
}
.simple-pagination ul {
margin: 0 0 20px;
padding: 0;
list-style: none;
text-align: center;
}
.simple-pagination li {
display: inline-block;
margin-right: 5px;
}
.simple-pagination li a,
.simple-pagination li span {
color: #666;
padding: 5px 10px;
text-decoration: none;
border: 1px solid #EEE;
background-color: #FFF;
box-shadow: 0px 0px 10px 0px #EEE;
}
.simple-pagination .current {
color: #FFF;
background-color: #FF7182;
border-color: #FF7182;
}
.simple-pagination .prev.current,
.simple-pagination .next.current {
background: #e04e60;
}
#profileDropDown li.active {
background-color: #0f8f46;
}
#profileDropDown li.active a {
color:white;
}
.inner_top_form button{
padding: 8.9px 12px !important;
}


</style>
</head>
<body class="bg_gray">
<?php
$header_store = "header_store";
include_once("../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">

<div class="col-md-12 rfqpage">
<?php 
$activePage = 8;
include('../store/top-dashboard.php');
?>
<?php 
$activePage = 8;
include('search-form.php');
?>
</div>
<div class="mt-5">
<div class="row ">
<?php
$p = new _rfq;
if($_POST['rfqTitle'] != "" && $_POST['rfqCategory'] == "all"){
$txtrfqTitle   = $_POST['rfqTitle']; 
if($_GET['page']==1){
$start = 0;
}else{
$sss = $_GET['page']-1;
$start = 10*$sss;
}
$limitaa = 8;
$result = $p->search_rfqtitle(1, $txtrfqTitle,$start,$limitaa);
}else if($_POST['rfqCategory'] != "all" && $_POST['rfqTitle'] == ""){
$txtRfqCategory   = $_POST['rfqCategory'];
if($_GET['page']==1){
$start = 0;
}else{
$sss = $_GET['page']-1;
$start = 10*$sss;
}
$limitaa = 8;
$result = $p->search_rfqcategory(1, $txtRfqCategory,$start,$limitaa);
//echo $p->ta->sql;
}else if($_POST['rfqCategory'] == "all"){
if($_GET['page']==1){
$start = 0;
}else{
$sss = $_GET['page']-1;
$start = 10*$sss;
}
$limitaa = 8;
$result = $p->readAllRfq(1,$start,$limitaa);
//  echo $p->ta->sql;
}else if($_POST['rfqCategory'] != "all" && $_POST['rfqTitle'] != ""){
$category = $_POST['rfqCategory'];
$title = $_POST['rfqTitle'];
if($_GET['page']==1){
$start = 0;
}else{
$sss = $_GET['page']-1;
$start = 10*$sss;
}
$limitaa = 8;
$result = $p->search_title_cat($category, $title,$start,$limitaa);
}
else{
if($_GET['page']==1){
$start = 0;
}else{
$sss = $_GET['page']-1;
$start = 10*$sss;
}
$limitaa = 8;
$result = $p->readAllRfq(1,$start,$limitaa);
}
if($account_status!=1){
if ($result) {
while ($row = mysqli_fetch_assoc($result)) {

?>
<div class="col-md-3">
<div class="course_Box rounded shadow p-3">
<div class="img_fe_box ">
<a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$row['idspRfq'];?>">

<?php
$image = $row['rfqImage'];
$x=0;                                                
$car_img = explode(",",$image);
foreach($car_img as $images){                                                 
$x+=1;
}
if(!empty($images)){ ?>                                            
<img alt='RFQ Img' class='img-fluid imgMain' src='<?php echo $BaseUrl.'/upload/store/rfq/'.$images; ?>'> 
<?php
}else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-fluid blank'>";
}
?>     
</a>
</div>
<div class="innerBoxvdo">
<a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$row['idspRfq'];?>" class="title eventcapitalize" data-toggle="tooltip" title="<?php echo $row['rfqTitle'];?>" >
<?php 
if(strlen($row['rfqTitle']) < 15){
echo $row['rfqTitle'];
}else{
echo substr($row['rfqTitle'], 0,15)."...";
} 
?>     
</a>
<?php if($_SESSION['guet_yes']!='yes'){?>
<!-- <a  href="javascript:void(0)" data-toggle="modal" data-target="#myflag<?php echo $row['idspRfq'];?>"><i class="fa fa-flag float-end"></i></a> -->
<?php } ?>
<!-- Modal -->
<div class="modal fade" id="myflag<?php echo $row['idspRfq'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<!--   <form id="sellercommentfrm"action="addsellercomment.php" method="post" enctype="multipart/form-data"> -->
<div class="modal-content no-radius bradius-15">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
</button>
<h3 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Flag RFQ</h3>
</div>
<div class="modal-body">
<input type="hidden" name="spPosting_idspPosting" id="spPosting_idspPosting<?php echo $row['idspRfq'];?>" value="<?php echo $row['idspRfq'];?>">
<input type="hidden" name="spProfile_idspProfile" 
id="spProfile_idspProfile<?php echo $row['idspRfq'];?>" value="<?php echo $row['spProfile_idspProfiles']; ?>">
<input type="hidden" name="spCategory_idspCategory" 
id="spCategory_idspCategory<?php echo $row['idspRfq']; ?>"
value="<?php echo $row['spCategory_idspCategory'];?>">
<div class="radio">
<label><input type="radio" name="rfq_flag" id="rfq_flag<?php echo $row['idspRfq'];?>" value="Duplicate RFQ" checked="">Duplicate RFQ</label>
</div>
<div class="radio">
<label><input type="radio" name="rfq_flag" id="rfq_flag<?php echo $row['idspRfq'];?>" value="RFQ Violation">RFQ Violation</label>
</div>
<div class="radio">
<label><input type="radio" name="rfq_flag" id="rfq_flag<?php echo $row['idspRfq'];?>" value="Suspicious RFQ">Suspicious RFQ</label>
</div>
<div class="radio">
<label><input type="radio" name="rfq_flag" id="rfq_flag<?php echo $row['idspRfq'];?>" value="Copied My RFQ">Copied My RFQ</label>
</div> 
<!-- <label>Why flag this post?</label> -->
<span id="flag_desc_error<?php echo $row['idspRfq'];?>" style="color:red;"></span>
<textarea class="form-control" name="flag_desc" id="flag_desc<?php echo $row['idspRfq'];?>" placeholder="Add Comments"></textarea>
<div class="modal-footer">


<button type="button" class="btn btn-primary" 
onclick="get_flagdata(<?php echo $row['idspRfq'];?>)" style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
</div>
</div>
<!--    </form>  -->
</div>
</div>
</div>
<?php
$p = new _spprofiles;
$pres1 = $p->readUserId($row['spProfile_idspProfiles']);
if($pres1 != false){
$prow = mysqli_fetch_assoc($pres1);
?>
<!-- <a href="<?php //echo $BaseUrl.'/friends/?profileid='.$prow['idspProfiles']?>" class="name"><?php //echo $prow['spProfileName']; ?></a> -->
<?php
}
?>

</div>
<div style="position:relative;margin-top:22px;font-size:16px;font-family:Marksimon;">
<?php echo ($row['rfqQty'] > 0)?'Qty : '.$row['rfqQty']:'';?>
</div>
<div style="text-align:center;margin-top:15px;">
<a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$row['idspRfq'];?>" class="btn btn-primary btn-border-radius">Read More</a>
</div>
</div>
</div>
</div>
<?php
}
}}else{ 
if (isset($txtrfqTitle)) { ?>
<center><div style='min-height: 300px; font-size: 16px;' >
Search Results "<?php echo $txtrfqTitle; ?>" RFQ not found.</div> </center>
<?php }elseif (isset($txtRfqCategory)) {?>
<center><div style='min-height: 300px; font-size: 16px;' >
Search Results "<?php echo $txtRfqCategory; ?>" RFQ not found.</div> </center>
<?php }else{ ?>
<center><div style='min-height: 300px; font-size: 16px;' >
Search Results RFQ not found.</div> </center>   
<?php  } 
?>
<?php }
?>
</div>
<?php if($account_status!=1){ if($_GET['page'] != "1"){ ?>
<a class="float-left btn btn-primary" style="margin-left:10px;" href="<?php echo $BaseUrl.'/public_rfq/index.php?page='.$_GET['page']-1;?>">Previous</a>
<?php } else {?>
<a class="float-left btn" style="margin-left:10px;" href=""></a>
<?php
}
if($result->num_rows == "8"){ ?>
<?php if($_GET['page'] == "1"){ ?>
<a class="float-right  btn btn-primary" style="margin-right:10px; margin-top: -14px;" href="<?php echo $BaseUrl.'/public_rfq/index.php?page='.$_GET['page']+1;?>">Next</a>
<?php } else { ?>
<a class="float-right  btn btn-primary" style="margin-right:10px; margin-top: 0px;" href="<?php echo $BaseUrl.'/public_rfq/index.php?page='.$_GET['page']+1;?>">Next</a> 
<?php } } }?>  
</div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
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
function get_flagdata(id){
var spPosting_idspPosting = $("#spPosting_idspPosting"+id).val()
var spProfile_idspProfile = $("#spProfile_idspProfile"+id).val()
var spCategory_idspCategory = $("#spCategory_idspCategory"+id).val()
$('input[name=radioName]:checked', '#myForm').val()
var why_flag = $("#rfq_flag"+id+":checked").val()
var flag_desc = $("#flag_desc"+id).val()
if (flag_desc == "") {
$("#flag_desc_error"+id).text("This field is required.");
$("#flag_desc").focus();
return false;
}else{
$.ajax({
type: 'POST',
url: 'addrfqflag.php',
data: {spPosting_idspPosting: spPosting_idspPosting, spProfile_idspProfile: spProfile_idspProfile,  spCategory_idspCategory: spCategory_idspCategory,  why_flag: why_flag,  flag_desc: flag_desc},
success: function(response){ 
swal({
title: "Flag Submitted Successfully!",
type: 'success',
showConfirmButton: true
},
function() {
window.location.reload();
});
}
});
}
}

</script>
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
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
jQuery(document).ready(function($){
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>		
<!--This script for sticky left and right sidebar END--> 
</body>
</html>
<?php
}
?>