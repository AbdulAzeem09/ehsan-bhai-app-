<?php
require_once("../../univ/baseurl.php" );
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="dashboard/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$pageactive = 20;
?>


<?php


$action = isset($_GET['action']) ? (int) $_GET['action'] : 0;

if($action){
$prt_id =  $_GET['id'] ;
$imgid = $action;
//	$id = $_GET['id'];
$pf = new _spPortfolio;
// die("------------");
$deleteid =	$pf->delete_img($imgid );
?>
<script>

window.location.href = "<?php echo $BaseUrl; ?>/dashboard/portfolio/editPortfolio.php?id=<?php echo $prt_id; ?>";
</script>
<?php				
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<?php include('../../component/f_links.php');?>
<!--This script for posting timeline data End-->
<!-- ===========DSHBOARD LINKS================= -->
<?php include('../../component/dashboard-link.php');?>
<!-- ===========PAGE SCRIPT==================== -->
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
<style>
.sidebar {
padding-bottom: 265px;
}
</style>
</head>
<body class="bg_gray" onload="pageOnload('details')">
<?php

include_once("../../header.php");
?>

<section class="">
<div class="container-fluid no-padding">
<div class="row">
<!-- left side bar -->
<div class="col-md-2 no_pad_right">
<?php
;
include('../../component/left-dashboard.php');
?>
</div>
<!-- main content -->
<div class="col-md-10 no_pad_left">
<div class="rightContent">

<!-- breadcrumb -->
<!--   <section class="content-header">
<h1>My Selling Product</h1>
<ol class="breadcrumb">
<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">My Selling Product</li>
</ol>
</section>-->

<?php
$pf = new _spPortfolio;
// die("------------");
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$result = $pf->editport($id);


//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
//echo "<pre>";
//print_r($row); die("--------------------------");

$spPortname = $row['spTitle'];
$spWeblink = $row['spWeblink'];
$spPortdes = $row['desPort'];
$spImg = $row['spImg'];
}
}




?>

<style>
.tagLine-max-char {

font-size: smaller;
font-weight: 600;

}


</style>						


<div class="content">
<div class="row">
<div class="col-md-5">
<a href="<?php echo $BaseUrl.'/dashboard/portfolio/index.php';?> " style="color: #2d6361;;" ><i class="fa fa-chevron-left"></i>Return</a>
</div>
<div class="col-md-7">
<h4>MY PORTFOLIO</h4>
</div>
<div class="col-md-12">

<div class="box box-success">
<div class="box-header">

</div><!-- /.box-header -->
<div class="box-body">


<form enctype="multipart/form-data" action="<?php echo $BaseUrl.'/dashboard/portfolio/deactivate_port.php?portfolio_id='.$id ; ?>" method="post" >											
<div class="after-add-more">
<div class="row">
<div class="col-md-6" >                                
<div class="form-group" >
<label class="control-label">Title:</label>
<input  type="text" class="form-control" placeholder="Enter Title" required name="spPortname"  maxlength="60"   value="<?php echo (isset($spPortname))?$spPortname: ''; ?>" >
</div>
</div>
<div class="col-md-6"    style=" margin-top: 26px;" >
<span class="tagLine-max-char">Max 60 characters</span>
</div>
</div>
<div class="row">
<div class="col-md-6">                                
<div class="form-group">
<label class="control-label">Weblink:</label>
<input maxlength="200" type="text" class="form-control" required placeholder="Enter Weblink" name="spWeblink"   value="<?php echo (isset($spWeblink))?$spWeblink: ''; ?>" />
</div>
</div>
</div>

<div class="row">
<div class="col-md-12" id="yourAddresRemove" >
<div class="form-group">
<label for="spProfileAbout" class="control-label">Portfolio Item Description:</label>
<textarea class="form-control" rows="3" required id="spPortdes" name="spPortdes" value="<?php echo (isset($spPortdes))?$spPortdes: ''; ?>"><?php echo (isset($spPortdes))?$spPortdes: ''; ?></textarea>
</div>	
</div>
</div>
<br>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Upload File:</label>

<input type="file" class="form-control" name="spPortimg[]"   accept=" image/* " style="display:block;"  value="" multiple >
</div>
</div>
</div>

<br>

<div class="row">

<?php 

$pf = new _spPortfolio;
// die("------------");
$result = $pf->readimg($id);

if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$spImg =   $row['image'];
$idImg =   $row['id'];		
$portfolio_id =   $row['portfolio_id'];
echo  "   <div class='col-md-3'><img src='$BaseUrl/dashboard/portfolio/image/".$spImg."' alt='image' width='200' height='200' />"; ?><br>
<a href="<?php echo $BaseUrl.'/dashboard/portfolio/editPortfolio.php?action='.$idImg.'&id1='.$portfolio_id.'&idimg='.$idImg; ?>"  style="color:red; ">Delete</a>  
</div>

<?php
echo "     ";
}
}		




?>
<br>

</div>

<?php 







?>
<!--  <div class="col-md-3">
<div class="form-group">
<label class="control-label">Modem Serial Number</label>
<input maxlength="200" type="text" class="form-control" placeholder="Enter Modem Serial Number" name="lg_md_sl[]" />
</div>
</div>-->







<!-- <table class="table table-striped ">
<thead>
<tr>
<th class="text-center">Id</th>
<th>Product Title</th>
<th class="text-center">Qty</th>
<th>Transaction Id</th>
<th>Module</th>
<th>Date</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
$p = new _order;
$c = new _categories;

$result = $p->selling($_SESSION['pid']);
//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$dt = new DateTime($row['sporderdate']);

$result2 = $c->get_Category_Detail($row['spCategories_idspCategory']);
if ($result2) {
$row2 = mysqli_fetch_assoc($result2);
$CatName = $row2['spCategoryName'];
$catFold = $row2['spCategoryFolder'];

}else{
$CatName = "";
$catFold = "";
}
?>
<tr>
<td class="text-center"><?php echo $i;?></td>
<td>
<?php
if ($row['spCategories_idspCategory'] == 1) {
?>
<a href="<?php echo $BaseUrl.'/'.$catFold.'/detail.php?catid=1&postid='.$row['idspPostings']; ?>"><?php echo $row['spPostingTitle'];?></a>
<?php
}else{
echo $row['spPostingTitle'];
}
?>

</td>
<td class="text-center"><?php echo $row['spOrderQty'];?></td>
<td><?php echo $row['txn_id']; ?></td>
<td>
<a href="<?php echo $BaseUrl.'/'.$catFold;?>"><?php echo $CatName; ?></a>                                                                        
</td>
<td><?php echo $dt->format('d M Y');?></td>
<td class="menu-action text-center">
<a href="<?php echo $BaseUrl.'/dashboard/selorder/detail.php?orderid='.$row['idspOrder'];?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-green vd_green"> <i class="fa fa-eye"></i> </a>

</td>
</tr>
<?php
$i++;
}
}
?>


</tbody>
</table>-->



<h4>ADD TO PROFILES</h4>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped "  class="table table-striped table-bordered dashServ display">
<thead>
<tr>
<th  class="text-center">Freelancer</th>
<th  class="text-center">Business</th>
<th  class="text-center">Personal</th>
<th  class="text-center">Professional</th>
<th  class="text-center">Employment</th>

<th class="text-center">Family</th>
</tr>
</thead>

<tbody>
<tr>
<td>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="portFreelancer" value="1" id="portFreelancer">

</div>

</td>
<td>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="portBussiness" value="1" id="portBussiness">

</div>

</td>
<td>
<div class="form-check">
<input class="form-check-input" type="checkbox" name="portPersonal" value="1" id="portPersonal">

</div>

</td> <td>
<div class="form-check">
<input class="form-check-input" type="checkbox"  name="portProfessional" value="1" id="portProfessional">

</div>

</td> <td>
<div class="form-check">
<input class="form-check-input" type="checkbox"   name="portEmployment" value="1" id="portEmployment">

</div>

</td> <td>
<div class="form-check">
<input class="form-check-input" type="checkbox"    name="portFamily" value="1" id="portFamily">

</div>

</td>
</tr>

</tbody>


</table>



<div class="row">
<div class="modal-footer">
<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn btn-border-radius" name="submit" value="Update">
<!--<button type="button" class="btn btn-primary">Save changes</button>-->
</div>
</div>
<br>
</div>

</form> 

</div>
</div>


</div>
</div>

</div>


<?php
//echo "<pre>";
// print_r($_POST);   

if(isset($_POST['submit'])){

$spPortname = $_POST['spPortname'];
$spPortdes = $_POST['spPortdes'];
$spWeblink = $_POST['spWeblink'];
$portFreelancer = $_POST['portFreelancer'];
$portBussiness = $_POST['portBussiness'];
$portPersonal = $_POST['portPersonal'];
$portProfessional = $_POST['portProfessional'];
$portEmployment = $_POST['portEmployment'];
$portFamily = $_POST['portFamily'];



if(isset($_FILES['spPortimg'])){

$filename = $_FILES["spPortimg"]["name"];
$tempname = $_FILES["spPortimg"]["tmp_name"];	
$folder = "image/".$filename;


if (move_uploaded_file($tempname, $folder)) {
$msg = "Image uploaded successfully";
}
}


$uidp = $_SESSION['uid'];
$pidp = $_SESSION['pid'];

$data = array(
"spPid"=>$pidp, 
"spTitle"=>$spPortname,
"desPort"=>$spPortdes, 
"spImg"=>$filename , 
"spUid"=>$uidp,
"spWeblink"=>$spWeblink,
"portFreelancer"=>$portFreelancer,
"portBussiness"=>$portBussiness,
"portPersonal"=>$portPersonal,
"portProfessional"=>$portProfessional,
"portEmployment"=>$portEmployment,
"portFamily"=>$portFamily,

);
//echo "<pre>";
//print_r($data); //die("-----------");

$pf = new _spPortfolio;

$pf->create($data);

}		



?>								



<style>
.smalldot{
width : 100px;
overflow:hidden;
display:inline-block;
text-overflow: ellipsis;
white-space: nowrap;
}


</style>







</div>
</div>
</div>





</div>
</section>


<?php include('../../component/f_footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../component/f_btm_script.php'); ?>

<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

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
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});
</script>








<script>
$(function() {
$(':checkbox').checkboxpicker();
});
</script>

<script type="text/javascript">
$(document).ready(function() {
$("body").on("click",".add-more",function(){ 
var html = $(".after-add-more").first().clone();

//  $(html).find(".change").prepend("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");

$(html).find(".change").html("<label for=''>&nbsp;</label><br/><a class='btn btn-danger remove'>- Remove</a>");


$(".after-add-more").last().after(html);



});

$("body").on("click",".remove",function(){ 
$(this).parents(".after-add-more").remove();
});
});

</script>
<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-id");

var work = $(this).attr("data-work");
//alert(work);
if(work=='deactive'){
swal({
title: "Do You Want Deactive this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/dashboard/portfolio/deactivate_port.php?id=' +dataId+'&work='+work;
} 
});

}	
if(work=='delete'){
swal({
title: "Do You Want Delete this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/dashboard/portfolio/deactivate_port.php?id=' +dataId+'&work='+work;
} 
});
}	

// alert(dataId);
});
});

// function deactiveProp(propId){ 
//     swal({
//           title: "Do You Want Delete this User?",
//           /*text: "You Want to Logout!",*/
//           type: "warning",
//           confirmButtonClass: "sweet_ok",
//           confirmButtonText: "Yes, Delete!",
//           cancelButtonClass: "sweet_cancel",
//           cancelButtonText: "Cancel",
//           showCancelButton: true,
//         },
//     function(isConfirm) {
//       if (isConfirm) {
//        window.location.href = <?php //echo $BaseUrl.'/real-estate/dashboard/deactivate_post.php?postid='?> + propId;
//       } 
//     });
// }
</script>





<form enctype="multipart/form-data" action="deactivate_port.php" method ="post" >		
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title" id="UpdatePort">Update Portfolio</h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<div class="after-add-more">
<div class="row">
<div class="col-md-12">                                
<div class="form-group">
<label class="control-label">Title:</label>
<input maxlength="200" type="text" class="form-control" placeholder="Enter Title" name="spPortname" id="spPortname" />
<input type="hidden" name="portfolio_id" id="portfolio_id" value="">
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">                                
<div class="form-group">
<label class="control-label">Weblink:</label>
<input maxlength="200" type="text" class="form-control" placeholder="Enter Weblink" name="spWeblink"  id="spWeblink"/>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12" id="yourAddresRemove" >
<div class="form-group">
<label for="spProfileAbout" class="control-label">Portfolio Item Description:</label>
<textarea class="form-control" rows="3" name="spPortdes" id="spPortdesf" ></textarea>
</div>	
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="control-label">Upload File:</label>
<input type="file" class="form-control" name="spPortimg" id="spPortimg"  accept=" image/* " style="display:block;" >
</div>
</div></div>


<br>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" style="background-color: orange; color:white;">Close</button>
<input type="submit" class="btn btn-submit  addprofile db_btn db_primarybtn btn-border-radius" name="submit" value="Update">
<!--<button type="button" class="btn btn-primary">Save changes</button>-->
</div>
</div>
</div>
</div>
</form>	



</body> 
</html>
<?php
} ?>


<?php
$pf = new _spPortfolio;
// die("------------");
$result = $pf->editport($id);


//echo $p->ta->sql;
if ($result) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {

$freelancer =   $row['portFreelancer'];
$Bussiness =   $row['portBussiness'];
$Personal =   $row['portPersonal'];
$Professional =   $row['portProfessional'];
$Employment =   $row['portEmployment'];
$Family =   $row['portFamily'];
if($freelancer == 1){
?>
<script>
$('#portFreelancer').trigger('click');

</script>

<?php } 

if($Bussiness == 1){
?>
<script>
$('#portBussiness').trigger('click');

</script>

<?php } 
if($Personal == 1){
?>
<script>
$('#portPersonal').trigger('click');

</script>

<?php } 
if($Professional == 1){
?>
<script>
$('#portProfessional').trigger('click');

</script>

<?php } 
if($Employment == 1){
?>
<script>
$('#portEmployment').trigger('click');

</script>

<?php } 
if($Family == 1){
?>
<script>
$('#portFamily').trigger('click');

</script>

<?php } 

}
}
?>







