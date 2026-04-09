<?php
include('../univ/baseurl.php');
session_start();

if ($_SESSION['ptid'] != 1  && $_SESSION['ptid'] != 3) {
	//die('++++++000');
	header('location:' . $BaseUrl . '/business-directory-services/?category=A');
}

if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
$activePage = 7;
$page = "dashboardPage";
?>


<?php 
if(isset($_POST['submit_module'])){  

$prof = new _spprofiles;

//$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

$content1 = $_POST['content1'];
$content2 = $_POST['content2'];
$content3 = $_POST['content3'];
$content4 = $_POST['content4'];
$main_desc = $_POST['main_desc'];

$title1 = $_POST['title1'];
$title2 = $_POST['title2'];
$title3 = $_POST['title3'];
$title4 = $_POST['title4'];
$main_title = $_POST['main_title'];
$content_header = $_POST['content_header'];
$favcolor = $_POST['favcolor'];



$arr1= array("buss_content_1"=>$content1,
	         "buss_content_2"=>$content2,
	         "buss_content_3"=>$content3,
	         "buss_content_4"=>$content4,
	         "buss_content_header"=>$content_header,
           "first_title"=>$title1,
	         "second_title"=>$title2,
	         "third_title"=>$title3,
           "fourth_title"=>$title4,
			     "main_title"=>$main_title,
			     "main_desc"=>$main_desc,
           "favcolor"=>$favcolor 
);      


$prof->updatebannerimg($arr1,$_SESSION['pid']); 


$_SESSION['con']='contact';

}


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
<style type="text/css">
#right_infom{display: none!important;} 
.swal2-popup {font-size: 2rem!important;}

.t{
  margin-top: 10px;
}

.f{
  margin-top: 6px; 
}
</style>

<body class="bg_gray">
<?php
include_once("../header.php"); 
?>

<?php

if($_SESSION['con']=='contact'){
  unset($_SESSION['con']);
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
<div class="modal-content no-radius" >
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Add News</h3>
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl.'/business-directory/addnews.php';?>" method="post" class="">                            
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
<div class="form-group">
<label for="recipient-name" class="control-label"><h4>Title</h4></label>
<input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="cmpanynewsTitle" />
</div>
<div class="row">
<?php 
$prof = new _spprofiles;
$result2 = $prof->chekProfileIsBusiness($_SESSION['uid']);
//echo $prof->ta->sql;
if($result2){
while ($row2 = mysqli_fetch_assoc($result2)) {?>
<div class="col-md-6">
<div class="checkbox">
<label><input type="checkbox" value="<?php echo $row2['idspProfiles'];?>" name="profileCheck[]" <?php echo ($_SESSION['pid'] == $row2['idspProfiles'])?'checked':''; ?> ><?php echo $row2['spProfileName'];?></label>
</div>
</div>
<?php
}
}

?>

</div>
<div class="form-group">
<label for="recipient-name" class="control-label"><h4>Description</h4></label>
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
<div class="modal-content no-radius" >
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Update News</h3>
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl.'/business-directory/updatenews.php';?>" method="post" class="">                            
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
<?php include('search-form.php');?>
<?php include('top-dashboard.php');?>
<div class="bg_white" style="padding: 20px;">

<div class="row" >
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
<form action ="" method="post" enctype="multipart/form-data">

	<?php 




$p = new _spprofiles;

$rpvt = $p->readlimit($_SESSION['pid']);

if ($rpvt != false){
$row_p = mysqli_fetch_assoc($rpvt);

//echo "<pre>";
//print_r($row_p);
$content1 = $row_p['buss_content_1'];
$content2 = $row_p['buss_content_2'];
$content3 = $row_p['buss_content_3'];
$content4 = $row_p['buss_content_4']; 
$main_desc = $row_p['main_desc'];
   
  

$title1 = $row_p['first_title'];
$title2= $row_p['second_title'];
$title3 = $row_p['third_title']; 
$title4 = $row_p['fourth_title'];   
$favcolor = $row_p['favcolor'];   

$main_title = $row_p['main_title'];   

$buss_content_header = $row_p['buss_content_header'];   
}
?>

<div class="row">
<div class="col-md-6">
<label for="w3review" class="f">Main Title</label><br>
  <textarea  class="form-control t" name="main_title" maxlength="50"><?php echo $main_title; ?></textarea>
</div>
<div class="col-md-6" >

<label for="w3review" class="f">Main Description</label><br>
  <textarea class="form-control t" name="main_desc" maxlength="1000"><?php echo $main_desc; ?></textarea>  
</div>


 
</div>
	<div class="row"><br>

		<div class="col-md-12">

 <label for="w3review">Header Content <span>(MaxLength 30 Character)</span</label><br>
 <input type="text" class="form-control t" name="content_header" maxlength="30" value="<?php echo $buss_content_header; ?>">


</div>

<div class="col-md-6">

 <label for="w3review" class="f">First Title</label><br>
  <textarea class="form-control t" name="title1" maxlength="1000"><?php echo $title1; ?></textarea>


</div>
<div class="col-md-6">

 <label for="w3review" class="f">First Description</label><br>
  <textarea class="form-control t" name="content1" maxlength="1000"><?php echo $content1; ?></textarea>


</div>

</div>





<div class="row">
<div class="col-md-6">
<label for="w3review" class="f">Second Title</label><br>
  <textarea  class="form-control t" name="title2" ><?php echo $title2; ?></textarea>
</div>
<div class="col-md-6" >

<label for="w3review" class="f">Second Description</label><br>
  <textarea class="form-control t" name="content2" ><?php echo $content2; ?></textarea>  
</div>



</div>



<div class="row">
<div class="col-md-6">

 <label for="w3review" class="f">Third Title</label><br>
  <textarea  class="form-control t" name="title3" ><?php echo $title3; ?></textarea>


</div>
<div class="col-md-6" >

 <label for="w3review" class="f">Third Description</label><br>
  <textarea  class="form-control t" name="content3" ><?php echo $content3; ?></textarea>

 
</div>
</div>



<div class="row">
<div class="col-md-6">

 <label for="w3review" class="f">Fourth Title</label><br>
  <textarea  class="form-control t" name="title4" ><?php echo $title4; ?></textarea>


</div>
<div class="col-md-6" >

<label for="w3review" class="f">Fourth Description</label><br>
  <textarea  class="form-control t" name="content4"> <?php echo $content4; ?></textarea>   
</div>
</div>
<div class="row">
<div class="col-md-2">

 <label for="w3review" class="f">Pick a colour for the Menu Bar</label><br>
<input type="color" class="form-control t" name="favcolor" style="height: 100px;" value="<?php echo  $favcolor; ?>">      
 </div>  <br><br><br>
 <div class="col-md-10 ml-5">
 <div class="col-md-8">

</div>

<div class="col-md-4">
<button class=" btn btn-warning btn-border-radius" type="submit" name="submit_module" style="font-size: 18px;cursor:pointer;margin-left: 50px;">Save Content</button>
<a href="<?php echo $BaseUrl;?>/business-directory/manage_content.php" class="pull-right btn btn-danger btn-border-radius" type="submit" name="cancel_module" style="font-size: 18px;
">Cancel</a>  
</div>
</div>
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
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
</body>
</html>
<?php
} ?>

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
function deletefun(id){ 
//alert(id);
//var my_path1 = $("#my_path1").val();

Swal.fire({
title: 'Are you sure?',
text: "It will deleted permanently !",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, delete it!'
}).then((result) => {
if (result.isConfirmed) {
$.ajax({
type: "GET",
url: "remove_img.php",
data: {postid:id}, 
success: function(response){

$('#remove_hd').hide();

}

});
}
})  



}   



</script>
