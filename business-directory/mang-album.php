<?php
include('../univ/baseurl.php');
session_start();
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
$activePage = 1;
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
<h3 class="modal-title" id="resumeheadr">Add News</h3>
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
if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1) {
?>
<a href="#" class="btn btn_bus_dircty pull-right" data-toggle="modal" data-target="#addnews" id="addnews" style=" background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> Add News</a>
<?php
}
?>


</div>
<div class="col-md-12">

<div class="table-responsive">
<table class="table table-striped table-bordered  tabDirc dashServ">
<thead class="">
<tr>
<th style="width: 100px;">Title</th>
<th>Description</th>
<th>Posted Date</th>
<th class="text-center" style="width: 150px;">Action</th>
</tr>
</thead>
<tbody>
<?php
$cn = new _company_news;
$result1 = $cn->readMyNews($_SESSION['pid']);
//echo $cn->ta->sql;
if ($result1) {
while ($row = mysqli_fetch_assoc($result1)) {
$postTime = strtotime($row['cmpanynewsdate']); ?>
<tr>
<td><?php echo $row['cmpanynewsTitle'] ?></td>
<td><?php echo $row['cmpanynewsDesc'] ?></td>
<td style="width: 100px;"><?php echo date("d-M-Y", $postTime); ?></td>
<td align="center">
<a href="javascript:void(0)" data-newsid="<?php echo $row['idcmpanynews']; ?>" data-toggle="modal" data-target="#ReadNews" class="editNews"><i class="fa fa-edit"></i></a>
<a href="<?php echo $BaseUrl . '/business-directory/deletenews.php?newsid=' . $row['idcmpanynews']; ?>" class="btn "><i class="fa fa-trash"></i></a>

</td>
</tr>
<?php
}
}
?>


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
</body>

</html>
<?php
} ?>
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