<?php
include('../univ/baseurl.php');
session_start();

if ($_SESSION['ptid'] != 1  && $_SESSION['ptid'] != 3) {
//die('++++++000');
header('location:' . $BaseUrl . '/business-directory-services/?category=A');
}


if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once("../authentication/check.php");
} else {
function sp_autoloader($class)
{


include '../mlayer/' . $class . '.class.php';  
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
$activePage = 9;
$page = "dashboardPage";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?> 
<!-- owl carousel -->
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl; ?>/assets/js/owl.carousel.min.js"></script>
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
<!-- this script for slider art -->
<script>
$(document).ready(function() {
$('.owl-carousel').owlCarousel({
loop: true,
autoPlay: true,
responsiveClass: true,
responsive: {
0: {
items: 1,
nav: false
},
600: {
items: 3,
nav: false
},
1000: {
items: 4,
nav: false
}
}
});
});
</script>
</head>

<body class="bg_gray">
<?php
include_once("../header.php");
?>
<!-- Modal -->
<!--Adding new Resume modal-->
<div class="modal fade jobseeker" id="addnews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Add111 News</h3>  
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl . '/business-directory/addnews.php'; ?>" id="addnew_form" method="post" class="">
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<div class="form-group">
<label for="recipient-name" class="control-label">
Title<span class="red">*</span><span class="red" id="error_title"></span>
</label>
<input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
</div>
<div class="row">
<?php
$prof = new _spprofiles;
$result2 = $prof->chekProfileIsBusiness($_SESSION['uid']);
//echo $prof->ta->sql;
if ($result2) {
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<div class="col-md-6">
<div class="checkbox">
<label><input type="checkbox" value="<?php echo $row2['idspProfiles']; ?>" name="profileCheck[]" <?php echo ($_SESSION['pid'] == $row2['idspProfiles']) ? 'checked' : ''; ?>><?php echo $row2['spProfileName']; ?></label>
</div>
</div>
<?php
}
}

?>

</div>
<div class="form-group">
<label for="recipient-name" class="control-label">
Description<span class="red">*</span><span class="red" id="error_desc"></span>
</label>
<textarea class="form-control no-radius" id="cmpanynewsDesc" name="cmpanynewsDesc"></textarea>
</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" id="btnsubmit" class="btn btn-primary btn-border-radius">Add</button>
</div>
</form>
</div>
</div>
</div>
</div>
<!--READALL NEWS-->
<div class="modal fade jobseeker" id="ReadNews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Update News</h3>
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl . '/business-directory/updatenews.php'; ?>" method="post" class="">
<div id="updateNews"></div>
<div class="modal-footer" class="uploadupdate">
<button type="submit" class="btn btn-primary btn-border-radius">Update</button>
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

</div>
</form>
</div>
</div>
</div>
</div>

<section>
<div class="row no-margin">
<!-- <div class="col-md-3 no-padding">
<?php
//include('../component/left-business.php');
?>
</div>-->
<div class="col-md-12 no-padding">
<div class="head_right_enter">
<div class="row no-margin">
<?php
include('top-head-inner.php');
?>
<div class="col-md-12 no-padding">
<div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active serviceDashboard" id="video1">
<?php include('search-form.php'); ?>
<?php include('top-dashboard.php'); ?>
<div class="bg_white" style="padding: 20px;">

<div class="row">
<div class="col-md-12 m_btm_15 ">   
<?php
//echo $_SESSION['ptid'];
if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 3) {
?>
<a href="<?php echo $BaseUrl; ?>/business-directory/add_new_menu.php" class="btn btn_bus_dircty btn-border-radius pull-right"  style=" background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> ADD A PAGE</a> 
<?php
}
?>


</div>







<div class="col-md-12">
<div class="row">

</tr>
</thead>
<tbody>
<div class="col-md-12" style="margin-top:10px;">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<style type="text/css">
.paginate_button {
border-radius: 0 !important;	
}

div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
}
</style>
<!-- partial:index.partial.html -->
<table id="example" class="display table table-striped table-bordered  tabDirc dashServ">
<thead style="background-color: black;
color: white;">
<tr>

<th>Title</th>
<th>Title</th>
<th>Description</th>
<th>Posted Date</th>
<th class="text-center" style="width: 150px;">Action</th>
</tr>

</thead>
<tbody>
<?php
$cn = new _spprofiles;
$result1 = $cn->read_menu($_SESSION['pid']);
//echo $cn->ta->sql;

if ($result1) {
while ($row = mysqli_fetch_assoc($result1)) {
$postTime = strtotime($row['postdate']); ?>  
<tr>
<td></td>
<td><?php echo $row['title'] ?></td>
<td><?php echo $row['description'] ?></td>
<td style="width: 100px;"><?php echo date("d-M-Y", $postTime); ?></td>
<td>
<a href="<?php echo $BaseUrl . '/business-directory/edit_menu.php?id=' . $row['id']; ?>"  class="editNews"><i title="Edit" style="color: #428bca" class="fa fa-pencil"></i></a>  
<!-- <a href="</?php echo $BaseUrl . '/business-directory/deletemenu.php?newsid=' . $row['id']; ?>" class="btn"> -->

<a onclick="del_1('<?php echo $BaseUrl . '/business-directory/deletemenu.php?newsid=' . $row['id'];?>')" ><i title="Delete" class="fa fa-trash"></i></a>  

</td>
</tr>
<?php
}
}
?>


</tbody>

</table>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script> <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});


$('#example tbody').on( 'click', 'tr',                                    function () {



} );
});
</script>
</div>
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
</div>

</div>
</div>
</section>
<div class="space-lg"></div>

<?php
include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<!-- notification js -->
<script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
<script>
function del_1(url1){
Swal.fire({
title: 'Are You Sure You Want to Delete?',
text: "",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
cancelButtonText: 'No',
confirmButtonText: 'Yes'
}).then((result) => {
if (result.isConfirmed) {

// //alert(isfavourite);
// $.post("../social/remfavdes11.php", {

//     id: id
// }, function (response) {
//     //alert(response);
//     window.location.reload();
// });
//   alert(url);
window.location.href = url1;



}
});
}
</script>
</body>

</html>
<?php
} ?>

<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>


<script>
$(document).ready(function() {
$('#myTable').DataTable();
});
</script>

<script>
$("#btnsubmit").click(function() {

var title = $("#cmpanynewsTitle").val();
var desc = $("#cmpanynewsDesc").val();


if ((title == "") || (desc == "")) {
if (title == "") {
$("#error_title").text("This is required field");
} else {
$("#error_title").text("");
}
if (desc == "") {
$("#error_desc").text("This is required field");
} else {
$("#error_desc").text("");
}
return false;
} else {
$("#addnew_form").submit();
}

});
</script>