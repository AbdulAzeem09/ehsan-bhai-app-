<?php
ob_start();
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
}

include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');

/*$pid=$_SESSION['pid'];
$getid=$_GET['groupid'];
$obj2=new _spAllStoreForm;	
$ress2=$obj2->readdatabymulid($getid,$pid);
if($ress2 ==false){
//die("=======");
header("location:$BaseUrl/my-groups/?msg=notaccess");

}*/
?>

<!DOCTYPE html>
<html lang="en"> 
<head>	
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<?php include('../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>   
<!--This script for posting timeline data End-->
<!--This script for sticky left and right sidebar STart-->
<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
<script>
function execute(settings) {
$('#sidebar').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute({
top: 20,
bottom: 50
});
}
});
function execute_right(settings) {
$('#sidebar_right').hcSticky(settings);
}
// if page called directly
jQuery(document).ready(function($){
if (top === self) {
execute_right({
top: 20,
bottom: 50
});
}
});

</script>

</head>
<body onload="pageOnload('groupdd')" class="bg_gray">
<?php

include_once ("../header.php");

$g = new _spgroup;
$result = $g->groupdetails($_GET["groupid"]);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
?>
<!-- Trigger the modal with a button -->
<div class="modal fade" id="mycomment" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<form action="../social/addcomment.php" method="post">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="commentModalLabel">Comments</h4>
</div>
<div class="modal-body">
<div id="commentUploading">

</div>

<div class="row">

<div class="col-md-12" >
<div class="input-group">
<div class="input-group-addon commentprofile inputgroupadon">
<div id="profilepictures"></div>
</div>
<input type="text" class="form-control" name="comment" id="comment"  placeholder="Type your comment here ..." style='height:45px;border-radius: 0px;'>
</div>

<input type="hidden" id="postcomment" name="spPostings_idspPostings" value="" />
<input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
<input name="userid" type="hidden" value="<?php echo $_SESSION['uid']?>">
</div>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
<button type="button" class="btn btn_blue commentboxpost btn-border-radius">Comment</button>
</div>
</form>
</div>
</div>
</div>
<!-- COMMENT MODEL FOR TIMELINE START -->
<section class="landing_page">
<div class="container">
<input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" id="grpid" value="<?php echo $_GET["groupid"]; ?>">
<input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
<input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
<div class="row">		
<div id="sidebar" class="col-md-2 no-padding">
<?php include('../component/left-group.php');?>
</div>	

<div class="col-md-10">
<?php
$g = new _spgroup;
$result = $g->groupdetails($_GET["groupid"]);

// echo $g->ta->sql;

if($result != false)
{
$row = mysqli_fetch_assoc($result);
$gname = $row["spGroupName"];
$gtag = $row["spGroupTag"];
$gdes = $row["spGroupAbout"];
$grules = $row["spGroupRules"];
$gtype = $row["spgroupflag"];
$gcategory= $row["spgroupCategory"];
$glocation= $row["spgroupLocation"];
$gimage = $row["spgroupimage"];

}

?>
<div class="row">
<div class="col-md-12" id="ip6">
    <div class="about_banner" id="ip6">



<div class="top_heading_group " id="ip6">
<div class="row">
<div class="col-md-6">
<!--                                                 <span ><p id="size1" >Group </p><small>[Discussion Board]</small></span>
-->                                                <span id="size1">Group <small>[About]</small></span> 



</div>

<div class="col-md-6">
<a class="pull-right" href="<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname'] ?>&timeline&page=1">Back</a>

<?php if ($row["spProfiles_idspProfiles"] == $_SESSION['pid']) { ?>
<a href="javascript:void(0)" class="" data-toggle="modal" data-target="#myaboutdata" style="color: #202548!important; float: right; font-size: 30px;"><i class="fa fa-edit"></i></a>
<?php }?>

</div> 


<div id="myaboutdata" class="modal fade" role="dialog">
<div class="modal-dialog">


<div class="modal-content sharestorepos bradius-15" style="width: 800px;">
<div class="modal-header br_radius_top bg-white" style="background-color: #202548!important; color: #fff;">
<button type="button" class="close" data-dismiss="modal" style="color: #fff!important;">&times;</button>
<h4 class="modal-title">Group [About]</h4>
</div>
<div class="modal-body">       

<input type="hidden" name="idspGroup" id="idspGroup" value="<?php echo $row['idspGroup'];?>">


<div class="form-group">
<label for="sell1">About group<span class="red">*</span></label>

<input type="text" class="form-control" name="spGroupAbout" id="spGroupAbout" value="<?php echo $gdes; ?>"> 

<span id="aboutgroup_error" style="color:red;"></span>

</div>

<div class="form-group">
<label for="sell1">Group Rules<span class="red">*</span></label>

<textarea type="text" class="form-control" name="spGroupRules" id="spGroupRules" ><?php echo $grules; ?></textarea>

<span id="rulesgroup_error" style="color:red;"></span>

</div>

<div class="form-group">
<label for="sell1">Group Location<span class="red">*</span></label>

<input type="text" class="form-control" name="spgroupLocation" id="spgroupLocation" value="<?php echo $glocation; ?>"> 

<span id="grouplocation_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal" style="background-color: #202548; color: #fff; min-width: 100px;" >Close</button>

<button type="button" class="btn btn-primary btn-border-radius" id="btnaboutus"  style="background-color: #A60000; color: #fff;border: none; min-width: 100px;" >Update</button>


</div>
</div>
</div>
</div>



<!-- <div class="col-md-6">
<a href="#" data-toggle="modal" data-target="#conversationModal"  class="btn btnPosting db_btn db_primarybtn pull-right"><i  class="fa fa-plus"></i><span class="hv"> New Discussion</span></a>
</div> -->
</div>
</div>

<div class="desc_desc">
<p style="color: #000;word-break: break-all;"><?php echo trim($gdes," ");?></p>     
</div>
<h2>Group Rules</h2>
<div class="desc_desc">
<p style="color: #000; white-space: pre-wrap;"><?php echo $grules;?></p>
</div>


<h2>Location</h2>
<div class="desc_desc">



<p>
<?php
//$p = new _spuser

$res = $g->read($_GET['groupid']);
if ($res != false) {

$ruser = mysqli_fetch_assoc($res);

 $spUserCountry = $ruser["spUserCountry"];
 $spUserState = $ruser["spUserState"];
 $spUserCity = $ruser["spUserCity"];  
$address = $ruser["address"];
$zipcode = $ruser["zipcode"];
$spGroupAbout = $ruser["spGroupAbout"];
//print_r($ruser);
//echo $spUserCity;
//die('==');
}
//die('===');            
$co = new _country;
$result3 = $co->readCountryName($spUserCountry);
if ($result3 != false) {
$row3 = mysqli_fetch_assoc($result3);
$country = $row3['country_title'];
}


$pr = new _state;
$result2 = $pr->readStateName($spUserState);
if ($result2 != false) { 
$row2 = mysqli_fetch_assoc($result2);

  $state = $row2["state_title"];

}


$cop = new _city;
$result4 = $cop->readCityName($spUserCity);
if ($result4 != false) { 
 $row4 = mysqli_fetch_assoc($result4);   
 

$city = $row4['city_title'];  

}

$glocation = $country.', '.$state.', '.$city ;     

?>


    <?php
if (isset($glocation) && $glocation != '') {

echo $glocation;
}else{ echo "No record available"; }?></p>
<div class="space-lg"></div>
<div class="space-lg"></div>
<div class="space-lg"></div>
</div>
</div>
</div>
</div>
</div>	

</div>
</div>	
</section>
<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>

</body>	

<script type="text/javascript">
//function get_approvedata(id){

$("#btnaboutus").click(function(){
//alert();

var gid = $("#idspGroup").val();
var about = $("#spGroupAbout").val();
var rules = $("#spGroupRules").val();
var location = $("#spgroupLocation").val();
// alert(txn_id);
// alert(buyerprofil_id);
// alert(sellerprofil_id);

if (about == "") {

$("#aboutgroup_error").text("This field is required.");
$("#spGroupAbout").focus();


return false;
}if (rules == "") {

$("#rulesgroup_error").text("This field is required.");
$("#spGroupRules").focus();


return false;
}if (location == "") {

$("#grouplocation_error").text("This field is required.");
$("#spgroupLocation").focus();


return false;
}else{
$.ajax({
type: 'POST',
url: '../post-ad/addgroup.php',
data: {idspGroup: gid, spGroupRules: rules,spGroupAbout: about, spgroupLocation: location},


success: function(response){ 

//console.log(data);
window.location.reload();
/*    swal({

title: "Update Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});*/


}
});


}

});



</script>
</html>
