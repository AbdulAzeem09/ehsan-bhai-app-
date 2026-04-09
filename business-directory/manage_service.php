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
$activePage = 8;
$page = "dashboardPage";  
?>


<?php 
if(isset($_POST['submit_module'])){  

$prof = new _spprofiles;

//$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

$Service_1 = $_POST['Service_1'];
$Service_2 = $_POST['Service_2'];
$Service_3 = $_POST['Service_3'];
$Service_4 = $_POST['Service_4'];
$favcolor_1 = $_POST['favcolor_1']; 




$arr1= array("Service_1"=>$Service_1,
	         "Service_2"=>$Service_2,
	         "Service_3"=>$Service_3,
	         "Service_4"=>$Service_4,   
           "favcolor_1"=>$favcolor_1 
	         
);      


$prof->updatebannerimg($arr1,$_SESSION['pid']); 




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
</style>

<body class="bg_gray">
<?php
include_once("../header.php"); 
?>
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
$Service_1 = $row_p['Service_1'];
$Service_2 = $row_p['Service_2'];
$Service_3 = $row_p['Service_3'];
$Service_4 = $row_p['Service_4'];    
$favcolor_1 = $row_p['favcolor_1'];    

}
?>

<div class="row">
<div class="col-md-6">
<label for="w3review">First Service</label><br>
  <textarea  class="form-control" name="Service_1" ><?php echo $Service_1; ?></textarea>
</div>
<div class="col-md-6" >

<label for="w3review">Second Service</label><br>
  <textarea class="form-control" name="Service_2" ><?php echo $Service_2; ?></textarea>  
</div>



</div>
	
<div class="row">
<div class="col-md-6">
<label for="w3review">Third Service</label><br>
  <textarea  class="form-control" name="Service_3" ><?php echo $Service_3; ?></textarea>
</div>
<div class="col-md-6" >

<label for="w3review">Forth Service</label><br>
  <textarea class="form-control" name="Service_4" ><?php echo $Service_4; ?></textarea>  
</div>



</div>

<div class="row">
<div class="col-md-6">

 <label for="w3review">Pickup color for bar</label><br>
<input type="color" class="form-control" name="favcolor_1" value="<?php echo  $favcolor_1; ?>">   
 </div>
</div>

<br>

<div class="col-md-12">
<button class="pull-right btn btn-warning btn-border-radius" type="submit" name="submit_module">submit</button>
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
