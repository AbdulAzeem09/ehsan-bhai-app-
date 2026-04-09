

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
include("../helpers/image.php");

$header_directy = "header_directy";
$activePage = 10;
$page = "dashboardPage"; 
$image = new Image;      
?>



<?php 


if(isset($_POST['submit_module_album'])){     

$prof = new _spprofiles;

//$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

$title = $_POST['Title'];
$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];





$arr1= array("title"=>$title,
             "pid"=>$pid,
             "uid"=>$uid
             
);      


$prof->create_gall($arr1);     




}




if(isset($_POST['submit_module'])){  

$prof = new _spprofiles;
//print_r($_POST); 
//print_r($_POST);  

//die('========'); 
//$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

$album = $_POST['album'];
$url = $_POST['url'];
$pid = $_SESSION['pid'];
$uid = $_SESSION['uid'];

if(isset($_FILES['image'])){

	//die('========='); 
  $image->validateFileImageExtensions($_FILES['image']);
  
			 $count =count($_FILES["image"]["name"]);
			for($i=0; $i<$count;$i++){
	$filename = $_FILES["image"]["name"][$i];
	$tempname = $_FILES["image"]["tmp_name"][$i];
		$folder = "../upload/".$filename;  
		

		if (move_uploaded_file($tempname, $folder)) { 
			$msg = "Image uploaded successfully";
			
			$data = array(
				"album"=>$album, 
				"pid"=>$pid, 
				"uid"=>$uid,
				"url"=>$url, 
				"file"=>$filename);
	
			 $prof->create_album($data);        
			
			
		}
	}
			}





}


if(isset($_POST['update_data'])){  

$prof = new _spprofiles;

//$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

$album = $_POST['album'];
$url = $_POST['url'];
$hidden_img = $_POST['hidden_img'];
$ids = $_POST['ids'];


$image->validateFileImageExtensions($_FILES['image']);
	

if($_FILES['image']['size'] != 0){
if(isset($_FILES['image'])){ 

			
	$filename = $_FILES["image"]["name"];
	$tempname = $_FILES["image"]["tmp_name"];
		$folder = "../upload/".$filename;  
		

		if (move_uploaded_file($tempname, $folder)) { 
			$msg = "Image uploaded successfully";
			
			$data = array(
				"album"=>$album,
				"url"=>$url,
				"file"=>$filename);
			
			 $prof->update_album($data,$ids);        
			
			
		}
		
			}} else {   

	


            $data1 = array(
				"album"=>$album, 
				"url"=>$url,
				"file"=>$hidden_img);  
			
			 $prof->update_album($data1,$ids);          


			}



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
<h3 class="modal-title" id="resumeheadr">Add Gallery</h3>
</div>
<div class="modal-body">
<form action="" id="addnew_form" method="post" class="" enctype="multipart/form-data" >  
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<div class="form-group">
<label for="recipient-name" class="control-label">
Upload Image<span class="red"></span><span class="red" id="error_title"></span>
</label>
<input style="display:block;" type="file" class="form-control no-radius" id="cmpanynewsTitle" name="image[]" multiple />  
</div>

<div class="form-group">
<label for="recipient-name111" class="control-label">
Add To Album<span class="red"></span><span class="red" id="error_title"></span>
</label>
 
<select class="form-control no-radius" name="album" >
	<option>Select album</option>  
<?php 
$cn = new _spprofiles;
$result1 = $cn->read_gall($_SESSION['pid']);
//echo $cn->ta->sql;
if ($result1) {
while ($row = mysqli_fetch_assoc($result1)) { ?>

<option value="<?php echo $row['title'] ?>" ><?php echo $row['title'] ?></option>   

<?php
}}


?> 
</select>
</div>
<div class="form-group">
<label for="recipient-name" class="control-label">
Url<span class="red"></span><span class="red" id="error_title"></span>
</label>
<input style="display:block;" type="text" class="form-control no-radius" id="cmnyurlnews" name="url"/>  
</div>
<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" name="submit_module"  class="btn btn-primary btn-border-radius" style="background-color:#e39b0f;color:white">Add</button> 
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
<form action="" method="post" class="" enctype="multipart/form-data" >
<div class="form-group">
	<input type="hidden" id="id_" name="ids" value="">
	<input type="hidden" id="hidden_img_" name="hidden_img" value="">
<label for="recipient-name" class="control-label">
Image<span class="red"></span><span class="red" id="image_1_error"></span>
</label>
<input style="display:block;" type="file" class="form-control no-radius" id="image_1" name="image" required /> 
<img src="" id= "img_prev" height="100px" width="100px"> 
</div>

<div class="form-group">
<label for="recipient-name111" class="control-label">
Album<span class="red"></span><span class="red" id="error_title"></span>
</label>
 
<select class="form-control no-radius" id="album_id" name="album" required>
	<option>Select album</option>  
<?php 
$cn = new _spprofiles;
$result1 = $cn->read_gall($_SESSION['pid']);
//echo $cn->ta->sql;
if ($result1) {
while ($row = mysqli_fetch_assoc($result1)) { ?>

<option value="<?php echo $row['title'] ?>" ><?php echo $row['title'] ?></option>   

<?php
}}


?> 
</select>
</div>
<div class="form-group">
<label for="recipient-name" class="control-label">
Url<span class="red"></span><span class="red" id="error_title"></span>
</label>
<input style="display:block;" type="text" class="form-control no-radius" id="urll_1" name="url" required/> 
</div>
<div class="modal-footer" class="uploadupdate">
<button style="color:white;" type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary btn-border-radius" name="update_data">Update</button> 


</div>
</form>
</div>
</div>
</div> 
</div>


<!-- Modal -->
<!--Adding new Resume modal-->
<div class="modal fade jobseeker" id="addnews_1" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Add Album</h3>
</div>
<div class="modal-body">
<form action="" id="addnew_form" method="post" class="">
<input type="hidden" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<div class="form-group">
<label for="recipient-name" class="control-label">
Album Name<span class="red"></span><span class="red" id="error_title"></span>
</label>
<input type="text" class="form-control no-radius" id="cmpanynewsTitle" name="Title" />  
</div>

<div class="modal-footer" class="uploadupdate">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="submit" name="submit_module_album"  class="btn btn-primary btn-border-radius btn-border-radius">Add</button> 
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
if ((isset($_SESSION['ptid']) && $_SESSION['ptid'] == 1)|| (isset($_SESSION['ptid']) && $_SESSION['ptid'] == 3)) {
?>

<style type="text/css">
	#addnews_1{margin-right: 50px;}  
	.matt {margin-top: 15px;}    


	div:where(.swal2-container).swal2-center>.swal2-popup {

height: 297px;
font-size: 15px;
}
</style>


<div class="row">
<form action="" id="addnew_form_1" method="get" class=""> 
    <div class="col-md-4 matt">  
    	
    	<select class="form-control no-radius" id="album_id" name="album" >
	<option>Select album</option>  
<?php 
$cn = new _spprofiles;
$result1 = $cn->read_gall($_SESSION['pid']);
//echo $cn->ta->sql;
if ($result1) {
while ($row = mysqli_fetch_assoc($result1)) { ?>

<option value="<?php echo $row['title'] ?>" <?php if($_GET['album'] == $row['title']){ echo 'selected'; } ?> ><?php echo $row['title'] ?></option>          

<?php
}}


?> 
</select>
    </div>
<div class="col-md-1 matt"> 
<button type="submit" class="btn btn-warning btn-border-radius" name="filter_data">Filter</button>   
</div>  

</form>
<div class="col-md-1 matt"> 
<a href="<?php echo $BaseUrl.'/business-directory/manage_gallery.php';?>" class="btn btn-border-radius"  style=" background-color:grey;color: white;">Reset</a>       
</div>
<div class="col-md-6">
<a href="#" class="btn btn_bus_dircty btn-border-radius pull-right" data-toggle="modal" data-target="#addnews" id="addnews" style=" background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> Add Gallery </a> 

<a href="#" class="btn btn_bus_dircty btn-border-radius pull-right" data-toggle="modal" data-target="#addnews_1" id="addnews_1" style=" background-color:#e39b0f;"><span class="glyphicon glyphicon-plus"></span> Add Album </a>
</div>
</div>
<?php
}
?>


</div>
<div class="col-md-12"> 

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<style type="text/css">
.paginate_button {
border-radius: 0 !important;	
}
</style>
<!-- partial:index.partial.html -->

<div class="table-responsive">
<table id="example" class="display table table-striped table-bordered  tabDirc dashServ"> 
<thead class="" style="background-color: black;color: white;">

<tr>
	<th></th>
<th style="width: 100px;">Album Name</th>
<th>Image</th>
<th>URl</th>
<th>Posted Date</th>
<th class="text-center" style="width: 150px;">Action</th>
</tr>
</thead>
<tbody>
<?php

$cn = new _spprofiles;

if(isset($_GET['filter_data'])){  

$album = $_GET['album'];  

$result1 = $cn->read_album_title($album);      
} else{

$result1 = $cn->read_album($_SESSION['pid']);
}
if ($result1) {
while ($row = mysqli_fetch_assoc($result1)) {
$postTime = strtotime($row['postingdate']); ?>  
<tr>
	<td><?php //echo $row['album'] ?></td>   
<td><?php echo $row['album'] ?></td>

<td style="width: 100px;" > <img  class= "" src="<?php  echo $BaseUrl; ?>/upload/<?php echo $row['file']; ?>" alt="" width="100" height="50"> </td>   
<td><?php echo $row['url'] ?></td>
<td style="width: 100px;"><?php echo date("d-M-Y", $postTime); ?></td>
<td align="center">
<a href="javascript:void(0)"  onclick="edit_data('<?php echo $row['id']; ?>','<?php echo $row['album']; ?>','<?php echo $row['file']; ?>','<?php echo $row['url']; ?>',)" class="editNews"><i style="color: #428bca" title="Edit" class="fa fa-pencil"></i></a>

<!-- <a href="<?php echo $BaseUrl . '/business-directory/deletealbum.php?id=' . $row['id']; ?>" class="btn ">-->
<a onclick="del_11('<?php echo $BaseUrl . '/business-directory/deletealbum.php?id=' . $row['id'];?>')" ><i title="Delete" class="fa fa-trash"></i></a>

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

<script src='<?php echo $baseurl?>/assets/js/sweetalert.js'></script>
 <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
 <script>
  	function del_11(url11){     
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
              //alert(url);
                window.location.href = url11;


                
            }
        });
    }
</script>


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


$('#example tbody').on( 'click', 'tr', function () {



} );   
});
</script>   

<script>
$("#btnsubmit").click(function() {

var title = $("#cmpanynewsTitle").val();
var desc = $("#cmpanynewsDesc").val();
var url = $("#cmnyurlnews").val();



if ((title == "") || (desc == "") || (url == "")) {
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
if (url == "") {
$("#error_title").text("This is required field");
} else {
$("#error_title").text("");
}
return false;
} else {
$("#addnew_form").submit();
}

});
</script>

<script type="text/javascript">
    function edit_data(a,b,c,d){
   $('#id_').val(a);
   $('#album_id').val(b);  
   $('#hidden_img_').val(c);  
   $('#urll_1').val(d); 

   var path = "<?php echo $BaseUrl;?>/upload/"+c;
  
   $('#img_prev').attr("src",path);       
   $('#ReadNews').modal('show');      
    }
    
document.getElementById("cmpanynewsTitle").addEventListener("change", function() {
  validateImageFile("cmpanynewsTitle", "error_title");
});
document.getElementById("image_1").addEventListener("change", function() {
  validateImageFile("image_1", "image_1_error");
});
</script>
