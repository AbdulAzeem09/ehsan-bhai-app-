<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "events/";
include_once("../../authentication/islogin.php");
} else {
function sp_autoloader($class)
{
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";
$activePage = 5;

if ($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6) {
} else {
$re = new _redirect;
$re->redirect($BaseUrl . "/events");
}

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/links.php'); ?>
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>

<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
<!-- <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script> -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<style type="text/css">
.sponsorPic {
display: block !important;
}
</style>
</head>
<style>
.dropdown-menu {
border: none;
}


div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
}

#profileDropDown li.active {
background-color: #c11f50;
}

#profileDropDown li.active a {
color: #fff;
}
</style>

<body class="bg_gray">

<?php include_once("../../header.php"); ?>
<script type="text/javascript">
$(function() {
$('#spsponsorPrice').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});


$('#spsponsorPrice1').keypress(function(e) {
if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
e.preventDefault(); //stop character from entering input
}
});

});
</script>
<section class="topDetailEvent innerEvent">
<div class="container">
<div class="row">
<div class="col-sm-12 text-center">
<h3>Sponsor List</h3>
</div>
</div>
</div>
</section>


<section class="m_top_15">
<div class="container">
<div class="row">
<div class="col-sm-12 no-padding ">
<ul class="breadcrumb">
<li style="font-weight: 600;font-size: 15px;"><a href="<?php echo $BaseUrl; ?>/events/">HOME</a></li>
<li style="font-weight: 600;font-size: 15px;">SPONSOR LIST</li>

<a  class ="btn butn_dash_real m_top_20 pull-right"data-toggle="modal" style="background-color:#c11f50; margin-top: -7px; margin-right: -14px;    text-decoration: underline;cursor: pointer;" data-target="#sponsorAddModal">Add Sponsor</a>
</ul>
</div>
</div>
<div class="row">
<?php //include('eventmodule.php'); 
?>
<div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar">
<?php include('left-menu.php'); ?>
</div>
<div class="col-md-10">
<div class="form-group">

<?php
$sponsor = 1;
//include('top-button-dashboard.php'); 
?>
</div>
<div class="row">
<!--Add album size-->

<div class="modal fade" id="sponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="loadbox">
<div class="loader"></div>
</div>

<div class="modal-dialog" role="document">


<div class="modal-content sharestorepos no-radius bradius-15">
<form action="createsponsor.php" method="post" id="" class="" enctype="multipart/form-data">
<div class="modal-header  bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor</b></h4>
</div>
<div class="modal-body">


<input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
<div class="row">





<div class="col-md-6">
<div class="form-group">
<label for="sponsorTitle">Company<span style="color:red;">*</span></label><span id='span1' style="color:red;"></span>
<span id="sponsorTitle_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value="" onkeyup="keyupsponsorfun()" />


</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
<span id="sponsorWebsite_error" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
<input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" onkeyup="keyupsponsorfun()" />

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
<span id="spsponsorPrice_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<input type="number" class="form-control" id="spsponsorPrice" name="spsponsorPrice" placeholder="$" maxlength="8" onkeyup="keyupsponsorfun()" />

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorCategory">Category<span style="color:red;">*</span></label>
<span id="sponsorCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<select class="form-control" name="sponsorCategory" id="sponsorCategory" onkeyup="keyupsponsorfun()">
<option value="">Select Category</option>
<option class="General">General</option>
<option class="Prime">Prime</option>
<option class="Platinum">Platinum</option>
<option class="Gold">Gold</option>
<option class="Silver">Silver</option>
<option class="Media">Media</option>
</select>

</div>
</div>

<div class="col-sm-12">
<div class="form-group">
<label for="sponsorDesc">Short Description<span style="color:red;">*</span></label>
<span id="spsponsorDesc_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<textarea class="form-control" name="sponsorDesc" id="spsponsorDesc" maxlength="500" onkeyup="keyupsponsorfun()"></textarea>

</div>
</div>
<div class="col-sm-12">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>

<input type="file" class="sponsorPic" name="sponsorImg" id="sponsorImg" onkeyup="keyupsponsorfun()">
<span id="sponsorImg_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<p class="help-block"><small>Browse files from your device</small></p>
</div>
</div>
<div class="col-md-9" style="padding-left: 130px;">
<div class="form-group">
<label for="sponsorPreview">Logo Preview</label>


<div id="sponsorPreview"></div>
<div id="postingsponsorPreview">
<div class="row">
<div id="spPreview">

</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal">Close</button>
<button id="" type="submit" class="btn btn-primary db_btn db_primarybtn">Add</button>
</div>
</form>
</div>
</div>
</div>
<!--Done-->
<?php
$sp  = new _sponsorpic;
$p = new _spprofiles;

$result = $sp->readAll($_SESSION['pid']);
//$res = $p->draftEvent($_GET['categoryID']);
//echo $sp->ta->sql;
$i = 1;
if ($result != false) {
$table = "example";
} else {
$table = "";
}
?>
<div class="col-sm-12">
<div class="box box-danger">
<div class="box-body">

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<div class="table-responsive">
<table class="table table-striped " class="table table-striped table-bordered dashServ display" id="<?php echo $table; ?>">
<thead>
<tr>
<th></th>
<th>ID</th>
<th>Title</th>
<th>Website</th>
<th>Category</th>
<th>Profile</th>
<th>Price</th>
<th>Logo</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$st = new _spuser;
$st1 = $st->readdatabybuyerid($_SESSION['uid']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
//print_r($stt);
$account_status = $stt['deactivate_status'];
$currency=$stt['currency'];
}
$sp  = new _sponsorpic;
$p = new _spprofiles;

$result = $sp->readAll($_SESSION['pid']);
//$res = $p->draftEvent($_GET['categoryID']);
//echo $sp->ta->sql;
$i = 1;
if ($account_status != 1) {
if ($result != false) {
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);die("-------------");
?>
<tr>

<!--  <?php print_r($row['idspSponsor']); ?> -->
<td></td>
<td><?php echo $i; ?></td>
<td class="eventcapitalize"><?php echo $row['sponsorTitle']; ?></td>

<td><a href="//<?php echo $row['sponsorWebsite']; ?>" target="_blank"><?php echo $row['sponsorWebsite']; ?></a></td>
<td><?php echo $row['sponsorCategory']; ?></td>
<td class="eventcapitalize"><?php

$result2 = $p->readUserId($row['spProfile_idspProfile']);
//echo $p->ta->sql;
if ($result2) {
$row2 = mysqli_fetch_assoc($result2);

// print_r($row2);
$num= number_format((float)$row['spsponsorPrice'], 2, '.', '');
echo "<a href='javascript:void(0)' >" . $row2['spProfileName'] . "</a>";
}
?></td>
<td><?php echo ($row['spsponsorPrice'] > 0) ? $currency.' '. $num: ''; ?></td>
<td>
<?php
$folder = "image/";
$data = $_FILES['sponsorImg']['name'];
move_uploaded_file($_FILES['sponsorImg']["tmp_name"], "$folder" . $_FILES['sponsorImg']["name"]);


//print_r($row['sponsorImg']); die("==========");
if (isset($row['sponsorImg'])) {

echo '<img src=" ' . $BaseUrl . '/events/image/' . ($row['sponsorImg']) . '" class="img-responsive" alt="" style="height: 50px;width: 50px;">';

/* echo '<img src="'.$row['sponsorImg'].'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';*/
} else {
echo '<img src="' . $BaseUrl . '/assets/images/blank-img/no-store.png" class="img-responsive" alt="" style="height: 50px;width: 50px;">';
}

?>

</td>
<td><a class='sendSponsorEdit' href='javascript:void(0)' data-toggle='modal' data-target='#sponsorEdit<?php echo $row['idspSponsor'];  ?>' data-sponsor="<?php echo $row['idspSponsor']; ?>"><i title="Edit" class="fa fa-pencil"></i></a>

<a href="javascript:void(0)" data-postid="<?php echo $row['idspSponsor']; ?>" class="delsponsor"><i title="Delete" class="fa fa-trash"></i></a>
</td>
</tr> <?php
$i++;


?>

<!--Edit album size-->
<div class="modal fade" id="sponsorEdit<?php echo $row['idspSponsor'];  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="loadbox">
<div class="loader"></div>
</div>
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">

<!-- <?php print_r([$row['idspSponsor']]); ?>
-->
<form action="createsponsor.php" method="post" id="sp-create-album" enctype="multipart/form-data">

<div class="modal-header  bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Edit Sponsor</b></h4>
</div>
<div class="modal-body">



<input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">



<?php
// print_r($row3['idspSponsor']);

$SponsorId  = $row['idspSponsor'];

// print_r($SponsorId);

$res = $sp->readSponsor($SponsorId);

// $sp  = new _sponsorpic;


if ($res) {
while ($row1 = mysqli_fetch_assoc($res)) {

// $row1 = mysqli_fetch_assoc($res);

// print_r($row1['sponsorTitle']);
/* print_r($row1['sponsorImg']);*/

//print_r($row1);


?>

<input type="hidden" name="idspSponsor" value="<?php echo $row1['idspSponsor']; ?>">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label for="sponsorTitle">Company<span style="color:red;" id="err_com">*</span></label>
<span id="sponsorTitle_error1" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="text" class="form-control" id="sponsorTitle1" name="sponsorTitle" value="<?php echo $row1['sponsorTitle']; ?>" onkeyup="keyupsponsorfun1()" />



</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorWebsite">Company Website<span style="color:red;" id="err_web">*</span></label>
<span id="sponsorWebsite_error1" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
<input type="text" class="form-control" id="sponsorWebsite1" name="sponsorWebsite" value="<?php echo $row1['sponsorWebsite']; ?>" onkeyup="keyupsponsorfun1()" />

</div>
</div>

<div class="col-md-6">
<div class="form-group">
<label for="spsponsorPrice">Price<span style="color:red;" id="err_price">*</span></label>
<span id="spsponsorPrice_error1" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<input type="number" class="form-control" id="spsponsorPrice1" name="spsponsorPrice" maxlength="8" value="<?php echo $row1['spsponsorPrice']; ?>" onkeyup="keyupsponsorfun1()" />


</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorCategory">Category<span style="color:red;" id="err_cat">*</span></label>
<span id="sponsorCategory_error1" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<select class="form-control" id="sponsorCategory1" name="sponsorCategory" value="<?php echo $row1['sponsorCategory']; ?>" onkeyup="keyupsponsorfun1()">
<option value="">Select Category</option>

<option class="General" value="General" <?php if ($row1['sponsorCategory'] == "General") {
echo "selected";
} ?>>
General</option>
<option class="Prime" value="Prime" <?php if ($row1['sponsorCategory'] == "Prime") {
echo "selected";
} ?>>Prime</option>
<option class="Platinum" value="Platinum" <?php if ($row1['sponsorCategory'] == "Platinum") {
echo "selected";
} ?>>Platinum</option>
<option class="Gold" value="Gold" <?php if ($row1['sponsorCategory'] == "Gold") {
echo "selected";
} ?>>Gold</option>
<option class="Silver" value="Silver" <?php if ($row1['sponsorCategory'] == "Silver") {
echo "selected";
} ?>>Silver</option>
<option class="Media" value="Media" <?php if ($row1['sponsorCategory'] == "Media") {
echo "selected";
} ?>>Media</option>
</select>



</div>
</div>

<div class="col-sm-12">
<div class="form-group">
<label for="sponsorDesc">Short Description<span style="color:red;" id="err_desc">*</span></label> <span id="spsponsorDesc_error1" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<textarea class="form-control" id="spsponsorDesc1" name="sponsorDesc" value="<?php $row1['sponsorDesc'];  ?>" maxlength="500" onkeyup="keyupsponsorfun1()"><?php echo $row1['sponsorDesc'];  ?></textarea>

</div>
</div>
<div class="col-sm-12">
<div class="row">
<div class="col-md-5">
<div class="form-group">
<label for="spSponsorPic">Add Logo<span style="color:red;" id="err_img">*</span></label>




<input type="file" class="sponsorPic" id="sponsorImg1" name="sponsorImg">
<!--    <span id="sponsorImg_error1" style="color:red; "></span>
-->
<p class="help-block"><small>Browse files from your device</small></p>


<?php if (!empty($row1['sponsorImg'])) {

echo '<img src="' . $BaseUrl . '/events/image/' . ($row1['sponsorImg']) . '" class="img-responsive" alt="" style="height: 50px;width: 50px;">';
} else { ?>

<img src='<?php echo $BaseUrl; ?>/assets/images/blank-img/no-store.png' style="height: 50px;width: 50px;" />
<?php }
?>
</div>
</div>
<script>
$(document).ready(() => {
$('#sponsorImg1').change(function() {
$("#blah").show();
const file = this.files[0];
console.log(file);
if (file) {
let reader = new FileReader();
reader.onload = function(event) {
console.log(event.target.result);
$('#blah').attr('src', event.target.result);
}
reader.readAsDataURL(file);
}
});
});
</script>
<div class="col-md-6" style="padding-left: 130px">
<div class="form-group">
<label for="sponsorPreview">Logo Preview</label>
<div id="sponsorPreview"></div>
<div id="postingsponsorPreview">
<div class="row">
<div id="spPreview">
<img id="blah" src="#" alt="your image" height="150px" width="150px" style="display: none;" />
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

<?php }
} ?>


</div>

<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal" style="background-color: orange!important;">Close</button>
<button id="EditSponser" type="submit" class="btn btn-primary db_btn db_primarybtn EditspSponser">Update</button>
</div>
</form>
</div>
</div>
</div>

<?php }
}
} else { ?>

<td colspan="8">
<center>No Record Found</center>
</td><?php } ?>


</tbody>
</table>
</div>

</div>
</div>
</div>

</div>
</div>
</div>
</div>
</section>

<div class="space"></div>
<?php

include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>
<script type="text/javascript">
function keyupsponsorfun() {

//alert();

var company = $("#sponsorTitle").val()

var Website = $("#sponsorWebsite").val()
var Price = $("#spsponsorPrice").val()
var category = $("#sponsorCategory").val()
var Description = $("#spsponsorDesc").val()
var sponsorImage = $("#sponsorImg").val()

//alert(category);
//alert(category.length);

if (company != "") {
{
$('#sponsorTitle_error').text(" ");
$.ajax({
type: "POST",
url: "<?= $BaseUrl; ?>/post-ad/sponsor_check.php",
cache:false,
data: {'company':company},
success: function(data) {
if(data==1){
$("#span1").html("Enter Unique Name");
return false;
}
}
});

}

}
if (Website != "") {
$('#sponsorWebsite_error').text(" ");
}
if (Price != "") {
$('#spsponsorPrice_error').text(" ");

}
if (category.length != 0) {
$('#sponsorCategory_error').text(" ");

}
if (Description != "") {
$('#spsponsorDesc_error').text(" ");
}
if (sponsorImage != "") {
$('#sponsorImg_error').text(" ");

}


}
</script>


<script type="text/javascript">
function keyupsponsorfun1() {

//alert();

var company = $("#sponsorTitle1").val()

var Website = $("#sponsorWebsite1").val()
var Price = $("#spsponsorPrice1").val()
var category = $("#sponsorCategory1").val()
var Description = $("#spsponsorDesc1").val()
//var sponsorImage = $("#sponsorImg1").val()

//alert(category);
//alert(category.length);

if (company != "") {
$('#sponsorTitle_error1').text(" ");

}
if (Website != "") {
$('#sponsorWebsite_error1').text(" ");
}
if (Price != "") {
$('#spsponsorPrice_error1').text(" ");

}
if (category.length != 0) {
$('#sponsorCategory_error1').text(" ");

}
if (Description != "") {
$('#spsponsorDesc_error1').text(" ");
}
/* if(sponsorImage != "")
{
$('#sponsorImg_error').text(" ");

}*/


}
</script>
<script>
$("#EditSponser").click(function() {

var company = $("#sponsorTitle1").val();

var Website = $("#sponsorWebsite1").val();
var Price = $("#spsponsorPrice1").val();
var category = $("#sponsorCategory1").val();
var Description = $("#spsponsorDesc1").val();
var image = $("#sponsorImg1").val();
if ((company == "") || (Price == "") || (Website == "") || (category == "") || (Description == "") || (image == "")) {
if (company == "") {
$("#err_com").text("This is required field.");
} else {
$("#err_com").text("");
}
if (Website == "") {
$("#err_web").text("This is required field.");
} else {
$("#err_web").text("");
}
if (Price == "") {
$("#err_price").text("This is required field.");
} else {
$("#err_price").text("");
}
if (category == "") {
$("#err_cat").text("This is required field.");
} else {
$("#err_cat").text("");
}
if (Description == "") {
$("#err_desc").text("This is required field.");
} else {
$("#err_desc").text("");
}
if (image == "") {
$("#err_img").text("This is required field.");
} else {
$("#err_img").text("");
}

return false;
} else {
//$("#sp-create-album").submit();
}


});
</script>


<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false
}]
}); //End of create main table


$('#example tbody').on('click', 'tr', function() {

// alert(table.row( this ).data()[0]);

});
});
</script>
</body>

</html>
<?php
} ?>
<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>