<?php
//   error_reporting(E_ALL);
// ini_set('display_errors', 'On');

include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
$_SESSION['afterlogin'] = "business-directory/";
include_once ("../authentication/check.php");

}else{
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
require_once "../helpers/image.php";
spl_autoload_register("sp_autoloader");

$header_directy = "header_directy";
//$activePage = 8;  
$page = "dashboardPage";  
?>


<?php
$cid = isset($_GET['id']) ? (int) $_GET['id'] : 0;
 
if(isset($_POST['submit_module'])){  

$prof = new _spprofiles;

//$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);
//$cid = $_GET['id'];
$title = $_POST['title'];
$description = $_POST['description']; 
$menu_name = $_POST['menu_name'];    
$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];





$arr1= array("title"=>$title,
"description"=>$description,  
"menu_name"=>$menu_name



);      

$image = new Image();

$id = $prof->update_menu($arr1,$cid);       

if(isset($_FILES['images'])){
$validationError = $image->validateFileImageExtensions($_FILES['images']);
foreach($_FILES["images"]["tmp_name"] as $key=>$tmp_name) {		

$filename = $_FILES["images"]["name"][$key];
$tempname = $_FILES["images"]["tmp_name"][$key];
$folder = "../upload/".$filename;  


if (move_uploaded_file($tempname, $folder)) {
$msg = "Image uploaded successfully";

$imgdata = array(
"menu_id"=>$cid, 
"file"=>$filename);  

$prof->create_menu_img($imgdata);       


}
}
}

// print_r($_FILES['images']);
// die('=============================');

//$cid = $_GET['id'];
$countfiles = count($_FILES['images']['name']);
$validationError = $image->validateFileImageExtensions($_FILES['sec_img']);
for($i=0;$i<$countfiles;$i++){
$sec_name = $_POST['sec_name'][$i];
$sec_desc = $_POST['sec_desc'][$i];
$id1= $_POST['sec_hidden'][$i];
$file_name = $_FILES['sec_img']['name'][$i];
$file_size =$_FILES['sec_img']['size'][$i];
$file_tmp =$_FILES['sec_img']['tmp_name'][$i];
$folder = "../upload/".$file_name;  


if($id1){
if(move_uploaded_file($file_tmp, $folder)){ 

$arr=array(  
'section_name'=>$sec_name,
'section_desc'=>$sec_desc,
'section_img'=>$file_name
);
$id = $prof->create_menu3($arr,$cid,$id1);
//update 

}
else {
$arr=array(  
'section_name'=>$sec_name,
'section_desc'=>$sec_desc,
);
$id = $prof->create_menu3($arr,$cid,$id1);
//update 
}


} else {

if(move_uploaded_file($file_tmp, $folder)){  
$arr=array(
'menu_id'=>$cid,
'section_name'=>$sec_name,
'section_desc'=>$sec_desc,
'section_img'=>$file_name

);
$id = $prof->update_menu_1($arr); 
}else{

$arr=array(
'menu_id'=>$cid,
'section_name'=>$sec_name,
'section_desc'=>$sec_desc,
//'section_img'=>$file_name

);
$id = $prof->update_menu_1($arr); 
}
}








/*
if(move_uploaded_file($file_tmp, $folder)){ 
if($id1){

$arr=array(  
'section_name'=>$sec_name,
'section_desc'=>$sec_desc,
'section_img'=>$file_name
);
$id = $prof->create_menu3($arr,$cid,$id1);
//update 
}

else {
//$res= $prof->read_data($id1);  
$stt = mysqli_fetch_assoc( $res);
$arr=array(
'menu_id'=>$cid,
'section_name'=>$sec_name,
'section_desc'=>$sec_desc,
'section_img'=>$stt['section_img']

);
$id = $prof->update_menu_1($arr,$id1); 
//insert
}   



}
else {

}*/
/*}
else{

$res= $prof->read_data($id1);  
$stt = mysqli_fetch_assoc( $res);
$arr=array(
'menu_id'=>$cid,
'section_name'=>$sec_name,
'section_desc'=>$sec_desc,
'section_img'=>$stt['section_img']

);
$id = $prof->update_menu_1($arr,$id1);  

}*/

}
// }



$re = new _redirect;
$redirctUrl = $BaseUrl."/business-directory/create_new_menu.php";
$re->redirect($redirctUrl);




/* $re = new _redirect;
$redirctUrl = $BaseUrl . "/timeline/";
$re->redirect($redirctUrl); header("Location: $BaseUrl/business-directory/create_new_menu.php");       
*/

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

.datainputs{
margin-top:20px;
}

.datainputs input{
font-size: 18px;
line-height: 21px;
color: #3D3D3D;
height: 50px;
padding: 0px 20px;
border-radius: 5px;
border: 1px solid #ddd;
box-shadow: 0px 0px 1px #D8D8D8;
margin: 0px 30px 20px 0px !important;
}
input:focus{
outline:none;
}
.add_input, .inputRemove{
display: inline-block;
color:#3d3d3d;
text-align:center;
text-decoration:none;
width:auto;
height:40px;
line-height:40px;
border:2px solid #3d3d3d;
padding:0px 15px;
border-radius: 5px;
}
.inputRemove{  
cursor:pointer;
}
#mceu_19{
display: none!important;
}

#deletidup{
margin-top: 15px;
}

#deletid{
margin-top: -11px;
}

#imgid{
margin-top: 20px;
}

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
<?php //include('search-form.php');?>
<?php //include('top-dashboard.php');?>  
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

$rpvt = $p->read_menu_by_id($cid); 

if ($rpvt != false){
$row_p = mysqli_fetch_assoc($rpvt);

//echo "<pre>";
//print_r($row_p); 
$title = $row_p['title'];
$description = $row_p['description'];
$menu_name = $row_p['menu_name'];
$id = $row_p['id'];


}
?>

<!--<div class="row">

<div class="col-md-12" >

<label for="w3review">Menu Name</label><br>
<input type="text"  class="form-control" name="menu_name" value="<?php echo $menu_name; ?>" >    
</div>

</div>-->

<div class="row">  
<h4 class="text-center"><b>CREATE A NEW PAGE</b></h4>   
<div class="col-md-12" >

<label for="w3review">Page Title</label><br>
<input type="text"  class="form-control" name="title" value="<?php echo $title; ?>" required>    
</div>






</div>

<div class="row">
<div class="col-md-12">
<label for="w3review">Description</label><br>
<textarea  class="form-control c-with-editor"  id ="eg-editor" name="description" required><?php echo $description; ?></textarea>        
</div>

</div>

<br>

<div class="row">

<?php 




$p = new _spprofiles;

$rpvtt = $p->read_menu_id($id); 

if ($rpvtt != false){
while($row_1 = mysqli_fetch_assoc($rpvtt)){ ?>

<img src="<?php  echo $BaseUrl; ?>/upload/<?php echo $row_1['file']; ?>" alt="" width="150" height="150"> 
<a href="<?php echo $BaseUrl . '/business-directory/deletemenu.php?newsid=' . $id; ?>&imgid=<?php echo $row_1['id'] ?>" class="btn btn-danger btn-border-radius" style="margin-left: -80px;
margin-top: 194px;">Remove</a>   

<?php   
}
}
?> 

<div class="col-md-6">

<label for="w3review">Images</label><br>
<input type="file" style="display:block"  class="form-control" name="images[]" value="" multiple>       
</div>
</div>
<?php


$result = $p->read_menu_id_serv($cid); 


?>
<br>
<div class="container1">
<button class="add_form_field btn btn-primary btn-border-radius">Add New Section &nbsp; 
<span style="font-size:16px; font-weight:bold;">+ </span>
</button>
<div>
<div>
<?php if ($result != false){

while($row_2 = mysqli_fetch_assoc($result)){ ?>
<div class="row">
<div class="col-md-5">
<label for="w3review">Section Name</label>
<input type="text" name="sec_name[]" class="form-control" value="<?php echo $row_2['section_name']; ?>" ></div>





<div class="col-md-5">
<label for="w3review">Section Image</label>


<input type="file" style="display:block;"  class="form-control" name="sec_img[]" value=""  >
<input type="hidden" name="sec_hidden[]" class="form-control " value="<?php echo $row_2['id']; ?>"  >
</div>


<div class="col-md-2" id= "deletidup">    
<?php $menu= $cid; ?>
<a href="<?php echo $BaseUrl . '/business-directory/deletemenu.php?menu_id=' . $menu; ?>&image_id=<?php echo $row_2['id'] ?>" class="" 
><i class="fa fa-trash" style="color:red;font-size: 40px;" aria-hidden="true"></i></a>   </div> 


<div class="col-md-8"> 
<label for="w3review">Section Description</label>
<textarea style="height: 160px;" id="text1" name="sec_desc[]" class="form-control"><?php echo $row_2['section_desc']; ?></textarea> 
<!--<input type="text" name="sec_desc[]" class="form-control " value="<?php echo $row_2['section_desc']; ?>">--></div>
<div class="col-md-4"  id="imgid">
<?php if($row_2['section_img']){   ?>
<img src="<?php  echo $BaseUrl; ?>/upload/<?php echo $row_2['section_img']; ?>" alt="" width="280" height="160"> 
<?php }else{ ?>
<img src="<?php  echo $BaseUrl; ?>/img/no.png" alt="" width="280" height="160">

<?php } ?>
</div>
</div>

<?php  } 
}

?>

</div>
</div>
</div>


<div class="col-md-12">
<button class="pull-right btn btn-warning btn-border-radius" type="submit" name="submit_module">update</button>
</div>
</form>
</div>

</div>


</div>
</div>

</div>
</div>
</section>
<div class="space-lg"></div>


<?php 
header("Location: $BaseUrl/business-directory/create_new_menu.php");       

include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- notification js -->


<script src="https://design.sleekr.id/assets/scripts/main.js"></script>
<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>      

<script type="text/javascript">
tinymce.init({ selector:'.c-with-editor', skin: "lightgray",  height: 100, menubar: false, statusbar: false, plugins: ['advlist autosave lists hr spellchecker nonbreaking'], toolbar: [ 'bold italic underline | alignleft aligncenter alignright alignjustify | styleselect | numlist bullist |' ], });  
</script>

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


</script>

<script>$(document).ready(function() {
var max_fields = 10;
var wrapper = $(".container1");
var add_button = $(".add_form_field");

var x = 1;
$(add_button).click(function(e) {
e.preventDefault();
if (x < max_fields) {
x++;   //<a href="#" class="delete" style="font-size: x-large;">Delete</a>
$(wrapper).append('<br><div class="row"><div class="col-md-5"><input type="text" name="sec_name[]" class="form-control" /></div><div class="col-md-5"><input type="file" style="display:block;"   class="form-control" name="sec_img[]" value="" multiple > </div><div class="col-md-2" id= "deletid"><a href="" class=" delete btn"><i class="fa fa-trash" style="color:red;font-size: 40px;" aria-hidden="true"></a></div><div class="col-md-8"><textarea style="height: 160px;" id="w3review" name="sec_desc[]" rows="" cols="" class="form-control"></textarea></div><div class="col-md-4" id="imgid"></div></div>'); //add input box      
} else {
alert('You Reached the limits')
}
});

$(wrapper).on("click", ".delete", function(e) {
e.preventDefault();
$(this).closest(".row").remove();
x--;
})
});
</script>

