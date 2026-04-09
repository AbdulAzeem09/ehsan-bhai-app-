<?php
include('../univ/baseurl.php');
session_start();
include('../univ/main.php');
$dbConn = mysqli_connect(DBHOST,UNAME,PASS,DBNAME);

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}

$g = new _spgroup;
$result = $g->groupdetails($group_id);
//echo $g->ta->sql;die;
if ($result != false) {
$row = mysqli_fetch_assoc($result);

//print_r($row);
//		die("========");
$profileId = $row["idspProfiles"];
$spUserid = $row["spUser_idspUser"];
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
$spgroupCategory=$row['spgroupCategory'];
$spGroupTag = $row['spGroupTagline'];
$id=$row['idspGroup'];
//echo $spgroupCategory;die;
$bannerpicture = $row["spgroupimage"];
$sdesc = $row['spGroupTagline'];
$spGroupAbout = $row['spGroupAbout'];
$zipcode = $row['zipcode'];

}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

<?php include('../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>


<!--This script for posting timeline data End-->
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
</head>
<style>
.swal2-popup {


font-size:1.5rem!important;
}
</style>
<body class="bg_gray" onload="pageOnload('groupdd')">
<?php

include_once ("../header.php");

$g = new _spgroup;
$result = $g->groupdetails($group_id);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
//print_r($row);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
?>

<section class="landing_page">
<div class="container">
<div class="row">
<div class="col-md-2 no-padding">
<?php include('../component/left-group.php');?>
</div>
<div class="col-md-10">

<div class="row">
<div class="col-md-12">
<div class="about_banner" id="ip6">
<div class="top_heading_group " id="ip6">
<div class="row">
<div class="col-md-6">
<span id="size1">Group <small>[Notification]</small></span>
</div>

</div>
</div>
<div class="row no-margin" style="padding: 10px;">

<a href="javascript:void(0)" id="edit_group" class="" data-toggle="modal" data-target="#StorebannerUpload" style="color: #202548!important; float: right; font-size: 30px;display:none"><i class="fa fa-edit zoom1"></i></a>

<?php

$p = new _spgroup;
$rpvt = $p->joinrequest($group_id);
//echo $p->ta->sql;
if ($rpvt != false) {
while ($row = mysqli_fetch_assoc($rpvt)) {

$spprofile = $row['spProfileType_idspProfileType'];

$spdata = $p->spprofilestypedata($spprofile);
$resdata = mysqli_fetch_assoc($spdata);




//print_r($row);
/*print_r($admin_Id);*/
if ($row['spApproveRegect'] == 0) {

if ($row['spProfileIsAdmin'] == 1) { 

if ($admin_Id == $_SESSION['pid']){
?>

<div class="col-md-4">
<div class="member_box " id="ip2" style="color: black; border: 1px solid black;background-color: #f1f1f2;min-height: auto;">
<div class="row">
<div class="col-md-4">
<?php
if(isset($row['spProfilePic'])){ ?>
<img src='<?php echo ($row['spProfilePic']); ?>' class="img-responsive profilePic" style="margin-top:22px;" alt="" /> <?php
}else{ ?>
<img src='<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png' class="img-responsive" style="margin-top:15px;" alt="" /> <?php
}
?>
</div>
<div class="col-md-8 no-padding sp-group-details">
<h3 style="display: block;"><a style="color: black" href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>"><?php echo ucwords($row['spProfileName']);?> <img src="<?php echo $BaseUrl;?>/assets/images/icon/member/group_sub_admin.png" class="img-responsive" alt=""></a></h3><i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="<?php echo $resdata['spProfileTypeName'] ?>" disable></i>

<span><?php echo $resdata['spProfileTypeName'] ?></span>
<!-- <h4><?php echo $row['spProfilesCity']." , ".$row['spProfilesCountry'];?></h4> -->
<!--  <p>Added on <?php echo $row['spGroup_newMember_Date'];?></p> -->
<?php
if ($admin_Id == $_SESSION['pid']) {
?>
<p style="padding-top: 10px;">

<a onclick="accept_status('<?php echo $BaseUrl.'/my-friend/acceptrequest.php?pid='.$row['idspProfiles'].'&gid='.$group_id.'&groupname='.$_GET['groupname'].'&timeline';?>')" style="font-size: 10px;background-color: #1074ca!important;color: black;padding-top: 5px!important;padding-bottom: 5px!important;" class="btn add_member_btn btn-border-radius"><i class="fa fa-user"></i> Accept</a>

<a onclick="reject_status('<?php echo $BaseUrl.'/my-friend/removegroupmember.php?pid='.$row['idspProfiles'].'&gid='.$group_id.'&groupname='.$_GET['groupname'].'&timeline';?>')" style="font-size: 10px;padding-right: 13px!important;padding-left: 13px!important;background-color: #ec3c55!important;padding-top: 5px!important;
padding-bottom: 5px!important;" class="btn add_member_btn btn-border-radius"><i class="fa fa-user"></i> Reject</a>
</p>

<?php
}
?>
<h5>



<span class="pull-right">
<?php
if ($admin_Id == $_SESSION['pid']) {
?>
<!-- <a data-toggle="popover" data-placement="top" data-html="true" data-content="<div class='popover_content'><a class='addtodelete' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $group_id;?>' ><i class='fa fa-trash'></i> Delete Member</a><a href='javascript:void(0);' class='assistant_admin' style='font-size:14px!important;' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $group_id;?>'><i class='fa fa-user' aria-hidden='true'></i> Make Admin Assistant</a> </div>"><i class="fa fa-cog"></i></a> -->
<?php
/* echo "<a href='#' class='btn btn-success assistant_admin' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_GET["groupid"] . "'>Make Admin Assistant</a><span style='".(($row['spAssistantAdmin'] == 0) ? "margin:0px -8px 0px 8px" : "")."' class='separator1'></span>";*/
}
?>
</span></h5>

</div>
</div>
</div>
</div>


<?php
//src=' ".($row['spProfilePic'])."'       
}else{

echo"<h4 style='text-align:center;'>No Request Found</h4>";
}                                                         
}

}
}
}else{

echo"<h4 style='text-align:center;'>No Request Found</h4>";
}   

?>
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
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>

<script>
var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
s.parentNode.insertBefore(g,s)}(document,'script'));
// Colorbox Call
$(document).ready(function(){
$("[rel^='lightbox']").prettyPhoto();
});
</script>
<!-- image gallery script end -->

<div id="StorebannerUpload" class="modal fade" role="dialog">
<div class="modal-dialog">

<form id="address" action="uploadgroupbanner.php" method="post" enctype="multipart/form-data">
<div class="modal-content sharestorepos bradius-15" style="width: 800px;">
<div class="modal-header br_radius_top bg-white">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Group Setting For11 <?php echo $_GET['groupname'] ?></h4>
</div>

<div class="modal-body">
<div class="row">
<div class="col-md-12">
<h4>Group Name</h4>
<div id=""></div>
<input type="hidden" name="gname" value="<?php echo $_GET['groupname']; ?>">
<input type="text" id="gname" name="gname" onkeyup="clearerror();" value="<?php echo $_GET['groupname']; ?>" class="form-control bradius-10"   >
</div>


</div>



<div class="row">
<div class="col-md-6">

<?php 
//$p = new _spuser

$res = $g->read($group_id);
if($res != false){
$ruser = mysqli_fetch_assoc($res);

$spUserCountry=$ruser["spUserCountry"]; 
$spUserState=$ruser["spUserState"];
$spUserCity=$ruser["spUserCity"];
}

$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if($res != false){
$ruser = mysqli_fetch_assoc($res);
$spUserCountry = $ruser["spUserCountry"]; 
$spUserState = $ruser["spUserState"]; 
$spUserCity = $ruser["spUserCity"]; 
}
?>

<input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
<div class="form-group">

<label for="spProfilesCountry" class="add_shippinglabel" ><h4>Country:</h4><span class="red"></span></label>
<select id="spUserCountry" class="form-control " name="spUserCountry">
<option value="0">Select Countr55555555555555y</option>
<?php
$co = new _country;
$result3 = $co->readCountry();
if($result3 != false){
while ($row3 = mysqli_fetch_assoc($result3)) {
?>
<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id'])?'selected':''; ?>>
<?php echo $row3['country_title'];?>
</option>
<?php
}
} 
?>
</select>
<span id="shippcounrty_error" style="color:red;"></span>
</div> </div>
<div class="col-md-6">
<div class="form-group">
<div class="loadUserState">
<label for="spUserState" class="add_shippinglabel"><h4>State:</h4><span class="red"></span></label>
<select class="form-control" name="spUserState" id="spUserState" >
<option value="0">Select State</option>
<?php 
//echo $spUserState; die('');
// if (isset($spUserState) && $spUserState > 0) {
$pr = new _state;
$result2 = $pr->readState($spUserCountry);
if($result2 != false){
while ($row2 = mysqli_fetch_assoc($result2)) { ?>
<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
<?php
}
}
//  }
?> 
</select>
<span id="shippstate_error" style="color:red;"></span>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<div class="loadCity">
<label class="add_shippinglabel" for="spUserCity"><h4>City:</h4><span class="red"></span></label>
<!--<input type="text" class="form-control" name="city" id="shipp_city">-->
<select class="form-control" name="spUserCity" id="spUserCity" >
<option value="0">Select City</option>
<?php 
//    if (isset($usercity) && $usercity > 0) {
$co = new _city;
$result3 = $co->readCity($spUserState);
if($result3 != false) {
while ($row3 = mysqli_fetch_assoc($result3)) { ?>
<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
}
}
//    } 
?>
</select>
<span id="shippcity_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label class="add_shippinglabel" for="shipp_address"><h4>Address:</h4><span class="red"></span></label> 


<input  class="form-control" type="text" id="shipp_address"  value="<?php 
echo(isset($address) && !empty($address))?$address:''; ?>" name="address" autocomplete="off"/>

<span id="shippaddress_error" style="color:red;"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="form-group">
<label class="add_shippinglabel" for="shipp_zipcode"><h4>Zipcode:</h4></label>
<input type="text" class="form-control" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>">
<span id="shippzipcode_error" style="color:red;"></span>
</div>
</div>


<div class="col-md-6">
<h4>Select Privacy</h4>
<div id=""></div>


<div class="form-control bg_gray_light no-radius bradius-10">
<div class="row">
<div class="col-md-4">
<label class="checkbox-inline"><input type="radio" id="spgroupflag"style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if($spgroupflag == 0){echo "checked";} ?>>Public</label>
</div>
<div class="col-md-4">
<label class="checkbox-inline"><input type="radio" id="spgroupflag"style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if($spgroupflag == 1){echo "checked";} ?>>Private</label>
</div>

</div>
</div>
</div>

</div>

<div class="row">
<div class="col-md-6">
<input type="hidden" name="groupid" value="<?= $group_id; ?>">
<h4>Short Description (Max 50 words)</h4>
<div id=""></div>
<br/>

<input type="text"  class="form-control bradius-10" id="spGroupTagline" name="spGroupTag" value="<?php echo $sdesc ?>">
</div>

<div class="col-md-6">
<h4>Group Category</h4>
<div id=""></div>
<br/>

<select class="form-control bradius-10" onclick="clearerror();" id="grpcategory" name="spgroupCategory" >
<option value="<?php echo $id ;?>">Select Category </option>

<?php

$sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


$result=mysqli_query($dbConn,$sql);
//var_dump($result);

while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);die('===');
?>
<?php //echo $spgroupCategory ;?>
<option value='<?php echo $rows['id'] ;?>' <?php if($spgroupCategory == $rows["id"]){echo "selected";} ?>>
<?php echo $rows["group_category_name"];?>
</option>


<?php
}
?>

</select>

</div>
</div>

<div class="row">
<div class="col-md-12">
<h4>Description</h4>
<div id=""></div>
<br/>

<textarea onkeyup="clearerror();" class="form-control bradius-10" id="spGroupAbout" name="spGroupAbout">
<?php
echo $spGroupAbout;
?>

</textarea>
</div>
</div>
<div class="row">
<div class="col-md-6">
<h4>Choose your banner</h4>
<div id=""></div>
<br/>
<?php //echo  $bannerfile.'---------';?>

<input type="file" name="bannerfile" class="basestorebanner" id="basestorebannerid" style="display: block;" />
<input type="hidden" id="spProfileId" value="<?php echo  $profileId;?>">
<input type="hidden" id="spuserId" value="<?php echo $spUserid;?>">
<input type="hidden" id="sgroupid" value="<?php echo $group_id ?>">
</div>
<div class="col-md-6">
<h4>Your selected banner will appear here...</h4>
<div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">

<img id="profilepic" data-media="<?php echo (isset($bannerpicture)?"1":"0");?>" src="<?php echo $BaseUrl;?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">

</div>
</div>
</div>
<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-primary btn-border-radius" id="update3"  style="">Update Data</button>

<button type="button" class="btn btn-default db_btn db_orangebtn btn-border-radius"style="   padding-top: 5px!important;
padding-bottom: 7px!important;" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</form>
</div>
</div>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
$("#update3").on('click',function () {

Swal.fire({
title: 'Are you sure?',

icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Update it!'
}).then((result) => {
if (result.isConfirmed) { 
$('#address').submit();

}
})
});

function accept_status(url) {
//alert(url);
Swal.fire({
title: 'Are You Sure You Want to Accept?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Accept it!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});
}


function reject_status(url) {
//alert(url);
Swal.fire({
title: 'Are You Sure You Want to Reject?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Reject it!'
}).then((result) => {
if (result.isConfirmed) {
window.location.href = url;
}
});
}

$("#spUserCountry").on("change", function () {
var countryId = this.value;
$.post("loadUserState.php", {
countryId: countryId
}, function (r) {
$(".loadUserState").html(r);
});
var state = 0;
$.post("loadUserCity.php", {
state: state
}, function (r) {
$(".loadCity").html(r);
});
});
</script>
<script>

function CancelRequ(pid,gid){
//alert(pid);
$.ajax({
method: "POST",
url: "../my-groups/cancel_join.php",
data: {
'pid': pid,
'gid': gid
},
cache: false,
success: function(data) {
location.reload();
},
});

}
</script>
</body>
</html>


