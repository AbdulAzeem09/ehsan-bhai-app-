<?php
include('../univ/baseurl.php');
session_start();

if(!isset($_SESSION['pid'])){ 
include_once ("../authentication/check.php");
$_SESSION['afterlogin']="my-posts/";
}
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$rfq = isset($_GET['rfq']) ? (int)$_GET['rfq'] : 0;
if ($rfq > 0) {

}else{
$re = new _redirect;
$re->redirect("index.php");
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<style type="text/css">
.validation{
color:red;
font-size: 12px;
} 


input[type="file"] {
display: block!important;
}
</style>
</head>

<body class="bg_gray">
<?php


//this is for store header
$header_store = "header_store";

include_once("../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!--   <div id="sidebar" class="col-md-2 hidden-xs no-padding">
<?php
//include('../component/left-store.php');
?>
</div> -->

<div class="col-md-12">
<ul class="breadcrumb" style="padding-bottom: 0px;font-size: 14px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 0px;">
<li><a href="<?php echo $BaseUrl.'/store'; ?>"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

<li><a href="<?php echo $BaseUrl.'/public_rfq?page=1'; ?>">Public RFQ</a></li>

<li><a href="<?php echo $BaseUrl.'/public_rfq/rfq-detail.php?rfq='.$rfq;?>">RFQ Detail</a></li>

<li><a href="<?php echo $BaseUrl.'/public_rfq/quote-form.php?rfq='.$rfq;?>">Quote Submitted</a></li>

</ul>
</div>
<div class="col-md-12">

<?php 
$activePage = 8;
$storeTitle = " (<small>RFQ Detail</small>)";
//include('top-dashboard.php');

$r = new _rfq;
$result = $r->rfqRead($rfq);
if ($result) {
$row = mysqli_fetch_assoc($result);
}

?>
<div class="bg_white_border quoteDetail bradius-10">
<div class="row">
<div class="col-md-6">
<p class="no-margin"><strong>RFQ Title:</strong> 
<strong style="text-transform: capitalize;"><?php echo $row['rfqTitle'];?></strong></p>
</div>
<div class="col-md-6">
<p class="no-margin"><strong>Quantity Required:</strong> <?php echo $row['rfqQty']; ?></p>
</div>
</div>
</div>
<div class="bg_white_border quoteDetail bradius-10">

<h6 style="font-size: 22px; margin-bottom: 19px; margin-top: 0px;">Fill the form below if you can supply your requested product.</h6>
<form action="addrfquser.php" method="post" class="rfq_form" enctype="multipart/form-data" id="quotationform">
<input type="hidden" name="idspRfq" value="<?php echo $rfq; ?>">
<input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="rfq_spProfiles_idspProfiles" value="<?php echo $row['spProfile_idspProfiles'];?>">



<div class="row">


<input type="hidden" class="form-control" name="rfqProductTitle" id="rfqProductTitle" value="<?php echo $row['rfqTitle'];?>"> 
<!--  <div class="col-md-4">
<div class="form-group">
<label>Product Name<span class="red">*</span></label><span id="rfqProductTitle_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="text" class="form-control" name="rfqProductTitle" id="rfqProductTitle" onkeyup="keyupQuotationfun()">
</div>
</div> -->
<div class="col-md-6">
<div class="form-group">
<label>Model Number (optional)</label>
<input type="text" class="form-control" name="rfqModelNumber">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Cost per item/piece ($)<span class="red">*</span></label><span id="rfqPrice_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="number" class="form-control" name="rfqPrice" id="rfqPrice" onkeyup="keyupQuotationfun()">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Minimum order<span class="red">*</span></label><span id="rfqMinOrder_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="number" class="form-control" name="rfqMinOrder" id="rfqMinOrder" onkeyup="keyupQuotationfun()">
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label>Maximum supply per month<span class="red">*</span></label><span id="rfqMaxOrder_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="text" class="form-control" name="rfqMaxOrder" id="rfqMaxOrder" onkeyup="keyupQuotationfun()">
</div>
</div>
<!--  <div class="col-md-12">
<div class="form-group">
<label>link to product (from store)<span class="red">*</span></label><span id="rfqLink_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="text" class="form-control" name="rfqLink" id="rfqLink" onkeyup="keyupQuotationfun()">
</div>
</div> -->
<div class="col-md-12">
<div class="form-group">
<label>Video Link<span class="red">*</span></label><span id="rfqvideolink_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="text" class="form-control" rows="3" name="rfqvideolink" id="rfqvideolink" onkeyup="keyupQuotationfun()">


</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Images<span class="red">*</span></label><span id="fileimage_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="file" name="spPostingsMedia" id="filemediaupload"  class="fileimage" >
<span class="validation" style="display:none;"> Upload  Files allowed </span>
</div>
<!-- name="spPostingsMedia[]" -->

</div>
<div class="col-md-12">
<div class="form-group">
<label>Description<span class="red">*</span></label><span id="rfqDesc_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<textarea placeholder="Post a comment." class="form-control" rows="4" name="rfqDesc" id="rfqDesc" onkeyup="keyupQuotationfun()"></textarea>

</div>
<input type="submit" name="" class="btn btn-submit db_btn db_primarybtn btn-border-radius" value="Submit Quote" id="quotationsubmit">
<!-- <button type="submit" class="btn btn-success green">Post Comment</button> -->
</div>                                    

</div>
</form>
</div>



</div>
</div>
</div>
</section>



<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<script type="text/javascript">


$(document).ready(function(e){
// Submit form data via Ajax

//$("#shipaddfrm").on('submit', function(e){


$("#quotationsubmit").on("click", function () {
// alert();                                                 

// e.preventDefault();
// var shipadd= $("#shipping_address").val()
var rfqProductTitle= $("#rfqProductTitle").val()
var rfqPrice = $("#rfqPrice").val()
var rfqMinOrder = $("#rfqMinOrder").val()
var rfqMaxOrder = $("#rfqMaxOrder").val()
var rfqLink = $("#rfqLink").val()
var rfqvideolink = $("#rfqvideolink").val()
var fileimage = $(".fileimage").val()

var rfqDesc = $("#rfqDesc").val()




if(rfqProductTitle == "" &&  rfqPrice == "" && rfqMinOrder == "" && rfqMaxOrder == "" && rfqLink == "" && rfqvideolink == "" && fileimage == "" && rfqDesc == ""){



$("#rfqProductTitle_error").text("Product name is required.");
$("#rfqProductTitle").focus();

$("#rfqPrice_error").text("Cost is required.");
$("#rfqPrice").focus();

$("#rfqMinOrder_error").text("Enter Minimum Order.");
$("#rfqMinOrder").focus();

$("#rfqMaxOrder_error").text("Enter Max supply.");
$("#rfqMaxOrder").focus();

$("#rfqLink_error").text("This field is required.");
$("#rfqLink").focus();

$("#rfqvideolink_error").text("Enter a Link.");
$("#rfqvideolink").focus();

$("#fileimage_error").text("Choose Picture.");
$(".fileimage").focus();

$("#rfqDesc_error").text("Enter Description.");
$("#rfqDesc").focus();



return false;
}else if (rfqProductTitle == "") {
$("#rfqProductTitle_error").text("Product name is required.");
$("#rfqProductTitle").focus();


return false;
}else if (rfqPrice == "" ) {


$("#rfqPrice_error").text("Cost is required.");
$("#rfqPrice").focus();



return false;
}else if (rfqMinOrder == "") {

$("#rfqMinOrder_error").text("Enter Minimum Order.");
$("#rfqMinOrder").focus();

return false;
}else if (rfqMaxOrder == "") {

$("#rfqMaxOrder_error").text("Enter Max supply.");
$("#rfqMaxOrder").focus();



return false;
}else if (rfqLink == "") {

$("#rfqLink_error").text("This field is required.");
$("#rfqLink").focus();


return false;
}else if (rfqvideolink == "") {


$("#rfqvideolink_error").text("Enter a Link.");
$("#rfqvideolink").focus();
return false;
}else if (fileimage == "") {


$("#fileimage_error").text("Choose Picture.");
$(".fileimage").focus();
return false;
}else if (rfqDesc == "") {

$("#rfqDesc_error").text("Enter Description.");
$("#rfqDesc").focus();



return false;
}
else {
$("#quotationform").submit();
//alert("Form Submitted Successfuly!");
return true;
}

});
}); 



function keyupQuotationfun() {

//alert();

var rfqProductTitle= $("#rfqProductTitle").val()
var rfqPrice = $("#rfqPrice").val()
var rfqMinOrder = $("#rfqMinOrder").val()
var rfqMaxOrder = $("#rfqMaxOrder").val()
var rfqLink = $("#rfqLink").val()
var rfqvideolink = $("#rfqvideolink").val()
var rfqDesc = $("#rfqDesc").val()



//alert(category);
//alert(category.length);

if(rfqProductTitle != "")
{
$('#rfqProductTitle_error').text(" ");

}

if(rfqPrice != "" )
{
$('#rfqPrice_error').text(" ");

}
if(rfqMinOrder != "")
{
$('#rfqMinOrder_error').text(" ");

}

if(rfqMaxOrder != "")
{
$('#rfqMaxOrder_error').text(" ");

}if(rfqLink != "")
{
$('#rfqLink_error').text(" ");

}

if(rfqvideolink != "")
{
$('#rfqvideolink_error').text(" ");

}
if(rfqDesc != "")
{
$('#rfqDesc_error').text(" ");

}


}

</script>

<script type="text/javascript">
$(document).ready(function(){
$('#filemediaupload').change(function(){
//alert();
//get the input and the file list
var input = document.getElementById('filemediaupload');
if(input.files.length>5){
$('.validation').css('display','block');
}else{
$('.validation').css('display','none');
}
});
});
</script>

</body>
</html>
