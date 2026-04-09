<?php
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
$activePage = 4;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>
<!-- owl carousel -->
<link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
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
<form action="<?php echo $BaseUrl.'/business-directory/addphoto.php';?>" method="post" enctype="multipart/form-data" class="sharestorepos" > 
<div class="modal-content no-radius" >
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Upload Photo</h3>
</div>
<div class="modal-body">

<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
<div class="form-group">
<!--<label for="recipient-name" class="control-label"><h4>Add Photo</h4></label>-->
<input type="file"  id="spPostingMedia" name="spPostingMedia" style="display:block;" />
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary btn-border-radius">Add</button>
</div>
</div>
</form>
</div>
</div>

<section>
<div class="row no-margin">
<div class="col-md-3 no-padding">
<?php 
include('../component/left-business.php');
?>
</div>
<div class="col-md-9 no-padding">
<div class="head_right_enter">
<div class="row no-margin">
<?php
include('top-head-inner.php');
?>
<div class="col-md-12 no-padding">
<div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
<!--PopularArt-->
<div role="tabpanel" class="tab-pane active serviceDashboard" id="video1">
<?php include('search-form.php');?>
<?php include('top-dashboard.php');?>
<div class="bg_white" style="padding: 20px;">

<div class="row" >
<div class="col-md-12 m_btm_15 ">
<?php
//echo $_SESSION['ptid'];
if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1) {
?>
<a  href="#" class="btn btn_bus_dircty pull-right" data-toggle="modal" data-target="#addnews" id="addnews" style="background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> Add Gallery Images</a>
<?php
}
?>


</div>
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-striped table-bordered  tabDirc dashServ">
<thead class="">
<tr>
<th style="width: 100px;">Image</th>
<th class="text-center" style="width: 150px;">Action</th>
</tr>
</thead>
<tbody>
<?php
$dg = new _direcctory_gallery;
$result = $dg->mygallery($_SESSION['pid']);
if($result){
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
<td>
<img src="<?php echo $BaseUrl.'/upload/directory-gallery/'.$row['gallery_img'];?>" style="width: 100px;height: 100px;" class="img-responsive" />
</td>
<td class="text-center">
<a href="<?php echo $BaseUrl.'/business-directory/delgallery.php?gallery='.$row['gallery_id'];?>"><i class="fa fa-trash"></i></a>
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
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>

