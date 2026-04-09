<?php
//  error_reporting(E_ALL);
//  ini_set('display_errors', 'On');

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
$activePage = 5;
$page = "dashboardPage";
?>


<?php 
if(isset($_POST['submit_module'])){





$prof = new _spprofiles;

$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

if($_POST['job']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Job",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Job",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['video']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Videos",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Videos",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['store']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Store",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Store",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['real_estate']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Real Estate",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Real Estate",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['rental']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Rental",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Rental",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['freelancer']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Freelancer",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Freelancer",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['event']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Events",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Events",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['art_craft']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Art and Craft",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Art and Craft",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['classified']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Classified Ad",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Classified Ad",
"status"=> 0 );

$prof->business_tabs($data);

}  

/*if($_POST['bussiness_space']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"My Business Space",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"My Business Space",
"status"=> 0 );

$prof->business_tabs($data);

}  */

if($_POST['business_sale']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Business For Sale",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Business For Sale",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['training']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Trainings",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Trainings",
"status"=> 0 );

$prof->business_tabs($data);

}  

if($_POST['new']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Company News",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'], 
"uid"=>$_SESSION['uid'],
"module_name"=>"Company News",
"status"=> 0 );

$prof->business_tabs($data);

}  


/*
if($_POST['business_space']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"Business Space",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'], 
"uid"=>$_SESSION['uid'],
"module_name"=>"Business Space",
"status"=> 0 );

$prof->business_tabs($data);

}  



if($_POST['nft']=="1"){

$data = array("pid"=>$_SESSION['pid'],
"uid"=>$_SESSION['uid'],
"module_name"=>"NFT",
"status"=> 1 );

$prof->business_tabs($data);

} else{
$data = array("pid"=>$_SESSION['pid'], 
"uid"=>$_SESSION['uid'],
"module_name"=>"NFT",
"status"=> 0 );

$prof->business_tabs($data);

}  
*/  

// custome page code


$cn = new _spprofiles;
$result1 = $cn->read_menu($_SESSION['pid']);

if($result1){
while($row = mysqli_fetch_assoc($result1)){
    
        if(in_array($row['id'],$_POST['custom'])){
            $data = array("status"=> 1);
            $cn->update_dynamic($data,$row['id']);
    }
    else{
        $data = array("status"=> 0);
        $cn->update_dynamic($data,$row['id']);

    }
   
    } 
   }


   $_SESSION['menu1']='menu';
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
</style>

<body class="bg_gray">
<?php
include_once("../header.php"); 
?>


<?php

if($_SESSION['menu1']=='menu'){
  unset($_SESSION['menu1']);
  ?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
swal("Menu is saved successfully!", "", "success");

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

  <!-- <div class="row">
      <div class="col-md-3 pull-left">     
         <a href="<?php echo $BaseUrl.'/business-directory/manage_dynamic_menu.php';?>" class="btn btn_bus_dircty "  style=" background-color:#e39b0f;">MANAGE PAGE</a> 

      </div>
   </div>-->

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
<form action ="" method="post">
   <div class="row" >
   <div class="col-md-1"></div>
<div class="col-md-4"> 
   <h4 class="text-center"><b>SHAREPAGE MODULES</b></h4>  

<div class="table-responsive">
<table class="table table-striped table-bordered  tabDirc dashServ">
<thead class="">
<tr>
<th>Module</th>
<th>Mode</th>
</tr>
</thead>
<tbody>
<?php 
$prof = new _spprofiles;

$res = $prof->read_business_tab_mark($_SESSION['uid'],$_SESSION['pid']);
//$res = $prof->read_business_tab($_GET['business']);
if($res != false){

while($row_tab = mysqli_fetch_assoc($res)){ 


?>
<tr>
<td><?php echo $row_tab['module_name']; ?></td>
<td><input <?php  if($row_tab['status']=="1"){echo 'checked';} ?> type="checkbox" name="<?php if($row_tab['module_name']=="Job"){ echo 'job';}if($row_tab['module_name']=="Videos"){ echo 'video';}if($row_tab['module_name']=="Store"){ echo 'store';}if($row_tab['module_name']=="Real Estate"){ echo 'real_estate';}if($row_tab['module_name']=="Rental"){ echo 'rental';}if($row_tab['module_name']=="Freelancer"){ echo 'freelancer';}if($row_tab['module_name']=="Events"){ echo 'event';}if($row_tab['module_name']=="Art and Craft"){ echo 'art_craft';}if($row_tab['module_name']=="Classified Ad"){ echo 'classified';}if($row_tab['module_name']=="Business For Sale"){ echo 'business_sale';}if($row_tab['module_name']=="Trainings"){ echo 'training';}if($row_tab['module_name']=="Company News"){ echo 'new';}  ?>" value="1"></td>        
</tr> 
<!--<tr>
<td>Videos</td>
<td><input <?php if($row_tab['module_name']=="videos"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="video" value="1"></td>
</tr>
<tr>
<td>Store</td>
<td><input <?php if($row_tab['module_name']=="store"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="store" value="1"></td>
</tr>
<tr>
<td>Real Estate</td>
<td><input  <?php if($row_tab['module_name']=="Real Estate"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="real_estate" value="1"></td>
</tr>
<tr>
<td>Rental</td>
<td><input  <?php if($row_tab['module_name']=="Rental"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="rental" value="1"></td>
</tr>
<tr>
<td>Freelancer</td>
<td><input <?php if($row_tab['module_name']=="Freelancer"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="freelancer" value="1"></td>
</tr>
<tr>
<td>Events</td>
<td><input  <?php if($row_tab['module_name']=="Events"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="event" value="1"></td>
</tr>
<tr>
<td>Art and Craft</td>
<td><input <?php if($row_tab['module_name']=="Art and Craft"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="art_craft" value="1"></td>
</tr>
<tr>
<td>Classified Ad</td>
<td><input  <?php if($row_tab['module_name']=="Classified Ad"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="classified" value="1"></td>
</tr>
<tr>
<td>My Business Space</td>
<td><input <?php if($row_tab['module_name']=="My Business Space"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="bussiness_space" value="1"></td>
</tr>
<tr>
<td>Business For Sale</td>
<td><input <?php if($row_tab['module_name']=="Business for Sale"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="business_sale" value="1"></td>
</tr>
<tr>
<td>Trainings</td>
<td><input <?php if($row_tab['module_name']=="Trainings"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="training" value="1"></td>
</tr>
<tr>
<td>News</td>
<td><input <?php if($row_tab['module_name']=="News"){ if($row_tab['status']=="1"){echo 'checked';}} ?> type="checkbox" name="new" value="1"></td>
</tr>-->

<?php }}else{

?>
<tr>

<td>Job</td>
<td><input type="checkbox" name="job" value="1"></td>
</tr>
<tr>
<td>Videos</td>
<td><input type="checkbox" name="video" value="1"></td>
</tr>
<tr>
<td>Store</td>
<td><input type="checkbox" name="store" value="1"></td>
</tr>
<tr>
<td>Real Estate</td>
<td><input type="checkbox" name="real_estate" value="1"></td>
</tr>
<tr>
<td>Rental</td>
<td><input type="checkbox" name="rental" value="1"></td>
</tr>
<!-- <tr>
<td>Freelancer</td>
<td><input type="checkbox" name="freelancer" value="1"></td>
</tr> -->
<tr>
<td>Events</td>
<td><input type="checkbox" name="event" value="1"></td>
</tr>
<tr>
<td>Art and Craft</td>
<td><input type="checkbox" name="art_craft" value="1"></td>
</tr>
<tr>
<td>Classified Ad</td>
<td><input type="checkbox" name="classified" value="1"></td>
</tr>
<tr>
<td>My Business Space</td>
<td><input type="checkbox" name="bussiness_space" value="1"></td>
</tr>
<!-- <tr>
<td>Business For Sale</td>
<td><input type="checkbox" name="business_sale" value="1"></td>
</tr> -->
<!-- <tr>
<td>Trainings</td>
<td><input type="checkbox" name="training" value="1"></td>
</tr> -->
<tr>
<td>Company News</td>   
<td><input type="checkbox" name="new" value="1"></td>
</tr>
<!--<tr>
<td>NFT</td>  
<td><input type="checkbox" name="Nft" value="1"></td>
</tr>
<tr>
<td>Business Space</td>
<td><input type="checkbox" name="business_space" value="1"></td>
</tr>-->


<?php  
 /*$cn = new _spprofiles;
 $result1 = $cn->read_menu($_SESSION['pid']);

 if ($result1) {
    while ($row = mysqli_fetch_assoc($result1)) {
?>
<tr>
<td><?php echo $row['title']; ?></td>  
<td><input type="checkbox" name="custom[]" value="<?php echo $row['title']; ?>">
<input type="hidden" name="hidden[]" value="<?php echo $row['title']; ?>"></td>
</tr>
<?php  } 
} */  
?>




<?php }?>

</tbody>
</table>
</div>


</div>
<div class="col-md-2"></div>

<div class="col-md-4"> 
   <h4 class="text-center"><b>CUSTOM PAGES</b></h4>   
   <div class="table-responsive">
<table class="table table-striped table-bordered  tabDirc dashServ">
<thead class="">
<tr>
<th>Module</th>
<th>Mode</th>
</tr>
</thead>
<tbody>




<?php  
 $cn = new _spprofiles;
 $result1 = $cn->read_menu($_SESSION['pid']);

 if ($result1) {
    while ($row = mysqli_fetch_assoc($result1)) {  
?>
<tr>
<td><?php echo $row['title']; ?></td>  
<td><input type="checkbox" name="custom[]" value="<?php echo $row['id']; ?>" <?php if($row['status']==1){
    echo "checked";
} ?>></td>
</tr>
<?php  } 
} 
?>


</tbody>
</table>
</div>

</div>
<div class="col-md-1"></div>
</div>
<div class="row" >
<div class="col-md-3"></div>

<div class="col-md-8">
<button class="pull-right btn btn-warning btn-border-radius" type="submit" name="submit_module">Save Menu</button> 
</div>
<div class="col-md-1"></div>    
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
