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
$activePage = 6;
$page = "dashboardPage";
?>


<?php
include('../helpers/image.php');
$image = new Image();
if (isset($_POST['submit_module'])) {

    $image->validateFileImageExtensions($_FILES["image"]);

        $prof = new _spprofiles;
        
        $filename = $_FILES["image"]["name"];
        $tempname = $_FILES["image"]["tmp_name"];
        $folder = "upload/" . $filename;
        
        if (move_uploaded_file($tempname, $folder)) {
            $arr1 = array("spfile" => $filename);
            $prof->updatebannerimg($arr1, $_SESSION['pid']);
        
    }
    
    $image->validateFileImageExtensions($_FILES["image1"]);
    if ($validationResult !== null) {
        echo "<script>alert('$validationResult');</script>";
        echo "<script>window.history.back();</script>"; 
        exit;
    } else {
        $filename1 = $_FILES["image1"]["name"];
        $tempname1 = $_FILES["image1"]["tmp_name"];
        $folder1 = "upload/" . $filename1;
        
        if (move_uploaded_file($tempname1, $folder1)) {
            $arr2 = array("spfile1" => $filename1);
            $prof->updatebannerimg($arr2, $_SESSION['pid']);
        }
    }
    
    $_SESSION['bann']='banner';
}

?>

<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php'); ?>
<!-- owl carousel -->
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $BaseUrl; ?>/assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/validations.js"></script>
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
<style type="text/css">
#right_infom {
display: none !important;
}

.swal2-popup {
font-size: 2rem !important;
}
</style>

<body class="bg_gray">
<?php
include_once("../header.php");
?>

<?php

if($_SESSION['bann']=='banner'){
  unset($_SESSION['bann']);
  ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
swal("Save Successfully!", "", "success");

</script>

<?php } ?>
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
<form action="<?php echo $BaseUrl . '/business-directory/addnews.php'; ?>" method="post" class="">
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<div class="form-group">
<label for="recipient-name" class="control-label">
<h4>Title</h4>
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
<h4>Description</h4>
</label>
<textarea class="form-control no-radius" name="cmpanynewsDesc"></textarea>
</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary btn-border-radius">Add</button>
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
<!--<div class="col-md-12 m_btm_15 ">
<?php
//echo $_SESSION['ptid'];
if (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1) {
?>
<a  href="#" class="btn btn_bus_dircty pull-right" data-toggle="modal" data-target="#addnews" id="addnews" style=" background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> Add News</a>
<?php
}
?>


</div>-->
<form action="" method="post" enctype="multipart/form-data">
<div class="row">
	
<div class="col-md-6">
<h4 class=""><b>HEADER BANNER IMAGE</b></h4>
<div class="table-responsive">
<span style="display:flex;"> 
<input style="display: block;" type="file" name="image" id="image_file"  ><!-- <span>Banner files size : "950 By 633"</span>
</span> -->
</span>
<span class="error_message" id="headerbanner_error"style="color: red;"></span>
<br>
<img id="previweImage" height="150px" width="150px" src="" style="display: none;"> 

</div>


</div>
<div class="col-md-6" id="remove_hd">
<?php




$p = new _spprofiles;

$rpvt = $p->readlimit($_SESSION['pid']);

if ($rpvt != false) {
$row_p = mysqli_fetch_assoc($rpvt);

//echo "<pre>";
//print_r($row_p);
$spfile = $row_p['spfile'];
}
?>

<?php if($spfile) { ?>
<img id="preview_img" style="border: 2px solid #e39b0f;height: 170px;" alt="Profile Pic" class="img-responsive img-big m_btm_10" src="<?php echo ((isset($spfile)) ? "" . ($BaseUrl) . "/business-directory/upload/" . ($spfile) . "" : "../img/default-profile.png"); ?>">


<span onclick="deletefun('<?php echo $_SESSION['pid'] ?>','image')" class=" btn btn-danger btn-border-radius">Remove</span>
<?php } ?>

</div>
</div>
<br>
<hr style="border-bottom: 1px solid #000;">
<!----second image--->

<div class="row">

<div class="col-md-6">
<h4 class=""><b>HOME PAGE BODY IMAGE</b></h4>
<div class="table-responsive">
<span style="display:flex;"> 
<input style="display: block;" type="file" name="image1" id="image_file1"><!--<span>Files size : "276 By 183"</span>-->
</span>
<span class="error_message" id="body_image_error"style="color: red;"></span>
<br>
<img id="previweImage1" height="150px" width="150px" style="display: none;" src> 
</div>


</div>
<div class="col-md-6" id="remove_hd1">
<?php




$p = new _spprofiles;

$rpvt = $p->readlimit($_SESSION['pid']);

if ($rpvt != false) {
$row_p = mysqli_fetch_assoc($rpvt); 

//echo "<pre>";
//print_r($row_p);
$spfile = $row_p['spfile1'];
}
?>

<?php if($spfile) { ?>
<img id="preview_img" style="border: 2px solid #e39b0f;height: 170px;" alt="Profile Pic" class="img-responsive img-big m_btm_10" src="<?php echo ((isset($spfile)) ? "" . ($BaseUrl) . "/business-directory/upload/" . ($spfile) . "" : "../img/default-profile.png"); ?>">


<span onclick="deletefun('<?php echo $_SESSION['pid'] ?>','image1')" class=" btn btn-danger btn-border-radius">Remove</span>
<?php } ?>
</div>
</div>



<div class="col-md-12">
<button class="pull-right btn btn-warning btn-border-radius" type="submit" style="color: #000;" name="submit_module">SUBMIT</button>
</div>
</form>
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

<script type="text/javascript">
	/*var _URL = window.URL || window.webkitURL;
$('#image_file').bind('change', function() {   
   var file = this.files[0];//get file       
   var img = new Image();
   var sizeKB = file.size / 1024;
   img.onload = function() {
     // $('#preview').append(img);
      alert("Size: " + sizeKB + "KB\nWidth: " + img.width + "\nHeight: " + img.height);
   }
   img.src = _URL.createObjectURL(file);     
}*/   


$('#image_file').bind('change', function() {
  $("#previweImage").show();
  //this.files[0].size gets the size of your file.
 // alert(this.files[0].size); 
//var oursize = "79,462"; 
  // if(this.files[0].size > 79462 ){ 
  // 	alert('Please upload file to give ratio .'); 
  // 	$('#image_file').val('');
  // 	//$("#previweImage").hide();    
  // } else{
  // 	$("#previweImage").show();
  // }

});


$('#image_file1').bind('change', function() {
  $("#previweImage1").show(); 
  //this.files[0].size gets the size of your file.
  //alert(this.files[0].size);
//var oursize = "79,462"; 
  /*if(this.files[0].size > 7813 ){ 
  	alert('Please upload file to give ratio .'); 
  	$('#image_file1').val('');
  	//$("#previweImage").hide();    
  } else{
  	$("#previweImage1").show(); 
  }*/

});
</script>

<script type="text/javascript">
image_file.onchange = evt => {
const [file] = image_file.files
if (file) {
preview_img.src = URL.createObjectURL(file)
}
}
</script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

<script type="text/javascript">
function deletefun(id, img) {
//alert(id);
//var my_path1 = $("#my_path1").val();

Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No'

}).then((result) => {
if (result.isConfirmed) {
$.ajax({
type: "GET",
url: "remove_img.php",
data: {
postid: id,
type: img
},
success: function(response) {

if (img == "image") {
$('#remove_hd').hide();
}

if (img == "image1") {
$('#remove_hd1').hide();
}
}

});
}
})



}
</script>
<script>
image_file.onchange = evt => {

const [file] = image_file.files
if (file) {
previweImage.src = URL.createObjectURL(file)
}
}


image_file1.onchange = evt => {

const [file] = image_file1.files
if (file) {
previweImage1.src = URL.createObjectURL(file)
}
}

//image extension validations
document.getElementById("image_file").addEventListener("change", function() {
  validateImageFile("image_file", "headerbanner_error");
});

document.getElementById("image_file1").addEventListener("change", function() {
  validateImageFile("image_file1", "body_image_error");
});


</script>
