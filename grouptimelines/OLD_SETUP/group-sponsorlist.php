<?php
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

$_GET["categoryid"] = "16";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "GroupEvents";
// $header_event = "events";

if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>

<?php include('../component/links.php');?>
<script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/event.js"></script>

<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->


<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
<!-- <script src="<?php echo $BaseUrl;?>/assets/js/home.js"></script> -->

<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

<style type="text/css">
.sponsorPic{
display: block!important;
}

</style>
</head>
<body class="bg_gray" onload="pageOnload('groupdd')">
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
<span id="size1">Group  <small>[Sponsor]</small></span>
<!--                                                 <h3><span >Events</span></h3>
-->                                            </div>

<?php if ($row["spProfiles_idspProfiles"] == $_SESSION['pid']) { ?>

<div class="col-md-6">
<!-- <a href="<?php echo $BaseUrl;?>/grouptimelines/group-sponsor.php" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-eye"></i><span > View Sponsor</span></a> -->

<!--   <a href="<?php echo $BaseUrl;?>/grouptimelines/dashboard/" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-plus"></i><span > Sponsor</span></a> 
-->


<div class="modal fade" id="groupsponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="loadbox" >
<div class="loader"></div>
</div>

<div class="modal-dialog" role="document">


<div class="modal-content sharestorepos no-radius bradius-15" style="border-radius: 15px!important;">
<form action="../post-ad/events/creategroup_sponsor.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data">
<div class="modal-header  bg-white br_radius_top" style="border-top-left-radius: 15px!important;border-top-right-radius: 15px!important;background-color: #fff!important;">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor3</b></h4>
</div>
<div class="modal-body">


<input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" id="spgroupid" name="spgroupid" value="<?php echo $_GET["groupid"]; ?>">

<input type="hidden" id="spgroupname" name="spgroupname" value="<?php echo $_GET['groupname']; ?>">
<div class="row">





<div class="col-md-6">
<div class="form-group">
<label for="sponsorTitle">Company<span style="color:red;">*</span></label>
<span id="sponsorTitle_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value=""  onkeyup="keyupsponsorfun()" />

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
<span id="sponsorWebsite_error" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
<input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" onkeyup="keyupsponsorfun()" />

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
<span id="spsponsorPrice_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<input type="text" class="form-control" id="spsponsorPrice" name="spsponsorPrice" placeholder="$" maxlength="8" onkeyup="keyupsponsorfun()"/>

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorCategory">Category<span style="color:red;">*</span></label>
<span id="sponsorCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<select class="form-control" name="sponsorCategory" id="sponsorCategory" onkeyup="keyupsponsorfun()">
<option value="">Select Category</option>
<option class="General">General</option>
<option class="Prime">Prime</option>
<option class="Platinum">Platinum</option>
<option class="Gold">Gold</option>
<option class="Silver">Silver</option>
<option class="Media">Media</option>
</select>

</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label for="sponsorDesc">Short Description<span style="color:red;">*</span></label>
<span id="spsponsorDesc_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<textarea class="form-control" name="sponsorDesc" id="spsponsorDesc" 
maxlength="500" onkeyup="keyupsponsorfun()"></textarea>

</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>

<input type="file" class="sponsorPic" name="sponsorImg" id="sponsorImg" onkeyup="keyupsponsorfun()">
<span id="sponsorImg_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<p class="help-block"><small>Browse files from your device</small></p>
</div>
</div>
<div class="col-md-9" style="padding-left: 130px;">
<div class="form-group">
<label for="sponsorPreview">Logo Preview</label>


<div id="sponsorPreview"></div>
<div id="postingsponsorPreview">
<div class="row">
<div id="spPreview">

</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

</div>
<div class="modal-footer bg-white br_radius_bottom" style="border-bottom-left-radius: 15px!important;border-bottom-right-radius: 15px!important;background-color: #fff!important;">
<button type="button" class="btn btn-default db_btn db_orangebtn btn-border-radius" data-dismiss="modal" style="background: #fab318!important;color:#fff;">Close</button>
<button id="addSponsergroup" type="submit" class="btn btn-primary db_btn db_primarybtn btn-border-radius" style="background: #032350!important;">Add</button>
</div>
</form>
</div>
</div>
</div>


<!--     <a  href="<?php echo $BaseUrl?>/grouptimelines/group-event.php?groupid=<?php echo $_GET['groupid']?>&groupname=<?php echo $_GET['groupname'];?>&event" class="btn btnPosting db_btn db_primarybtn pull-right"><i class="fa fa-arrow-left"></i><span > Back</span></a> -->

<button data-toggle="modal" data-target="#groupsponsorAddModal" class="btn btnPosting db_btn db_primarybtn pull-right btn-border-radius" ><i class="fa fa-plus"></i> Sponsor</button>

</div>
<?php } ?>
</div>
</div>
<div class="row" style="margin-top: 25px;">


<div class="col-md-12">
<div class="box groupbox-danger">
<div class="box-body">

<div class="table-responsive bg_white">
<table class="table table-striped groupeventTable" id="sponMod">
<thead>
<tr>
<th>ID</th>
<th>Title</th>
<th>Website</th>
<th>Category</th>
<th>Profile</th>
<th>Price</th>
<th>Logo</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php

$sp  = new _groupsponsor;
$p = new _spprofiles;

$result = $sp->readAll($_SESSION['pid']);
//$res = $p->draftEvent($_GET['groupid']);
//echo $sp->ta->sql;
$i = 1;
if($result){
while ($row = mysqli_fetch_assoc($result)) { 

?>
<tr>

<!--  <?php print_r($row['idspSponsor']);?> --> 

<td><?php echo $i; ?></td>
<td class="eventcapitalize"><?php echo $row['sponsorTitle'];?></td>
<td><a href="<?php echo $row['sponsorWebsite']?>" target="_blank" ><?php echo $row['sponsorWebsite'];?></a></td>
<td><?php echo $row['sponsorCategory'];?></td>
<td class="eventcapitalize"><?php 

$result2 = $p->readUserId($row['spProfile_idspProfile']);
//echo $p->ta->sql;
if($result2){
$row2 = mysqli_fetch_assoc($result2); ?>



<a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['spProfile_idspProfile'];?>"><?php echo $row2['spProfileName'];?></a>                                                        
<?php  }
?></td>
<td><?php echo ($row['spsponsorPrice'] > 0)?'$'.$row['spsponsorPrice']:'';?></td>
<td>
<?php

//print_r($row['sponsorImg']); 
if(isset($row['sponsorImg'])){

echo '<img src="'.($row['sponsorImg']).'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';

/* echo '<img src="'.$row['sponsorImg'].'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';*/
}else{
echo '<img src="../assets/images/blank-img/no-store.png" class="img-responsive" alt="" style="height: 50px;width: 50px;">';
}

?>

</td>
<td><!-- <a class='sendSponsorEdit' href='javascript:void(0)' data-toggle='modal' data-target='#sponsorEdit<?php echo $row['idspSponsor'];  ?>' data-sponsor="<?php echo $row['idspSponsor'];?>"><i class="fa fa-edit"></i></a> -->

<a href="javascript:void(0)" data-postid="<?php echo $row['idspSponsor']; ?>" class="delgroupsponsor" ><i class="fa fa-trash"></i></a></td>
</tr> <?php
$i++;


?>

<!--Edit album size-->
<div class="modal fade" id="sponsorEdit<?php echo $row['idspSponsor'];  ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="loadbox">
<div class="loader"></div>
</div>
<div class="modal-dialog" role="document">
<div class="modal-content sharestorepos bradius-15">

<!-- <?php print_r([$row['idspSponsor']]); ?>
-->
<form action="../post-ad/events/creategroup_sponsor.php" method="post" id="sp-create-album" enctype="multipart/form-data">

<div class="modal-header  bg-white br_radius_top">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Edit Sponsor</b></h4>
</div>
<div class="modal-body">



<input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" id="spgroupid" name="spgroupid" value="<?php echo $_GET['groupid']; ?>">

<input type="hidden" id="spgroupname" name="spgroupname" value="<?php echo $_GET['groupname']; ?>">



<?php               
// print_r($row3['idspSponsor']);

$SponsorId  = $row['idspSponsor'];

// print_r($SponsorId);

$res = $sp->readSponsor($SponsorId);

// $sp  = new _sponsorpic;


if($res){
while ($row1 = mysqli_fetch_assoc($res)) {

// $row1 = mysqli_fetch_assoc($res);

// print_r($row1['sponsorTitle']);
/* print_r($row1['sponsorImg']);*/

//print_r($row1);


?>

<input type="hidden" name="idspSponsor" value="<?php echo $row1['idspSponsor'];?>">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label for="sponsorTitle">Company<span style="color:red;">*</span></label>
<span id="sponsorTitle_error1" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<input type="text" class="form-control"
id="sponsorTitle1" name="sponsorTitle" value="<?php echo $row1['sponsorTitle'];?>"  onkeyup="keyupsponsorfun1()"/>



</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
<span id="sponsorWebsite_error1" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
<input type="text" class="form-control" id="sponsorWebsite1" name="sponsorWebsite" value="<?php echo $row1['sponsorWebsite'];?>"  onkeyup="keyupsponsorfun1()" />

</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
<span id="spsponsorPrice_error1" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<input type="text" class="form-control" id="spsponsorPrice1" name="spsponsorPrice" maxlength="8" value="<?php echo $row1['spsponsorPrice'];?>" onkeyup="keyupsponsorfun1()" />


</div>
</div>
<div class="col-md-6">
<div class="form-group">
<label for="sponsorCategory">Category<span style="color:red;">*</span></label>
<span id="sponsorCategory_error1" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
<select class="form-control" id="sponsorCategory1" name="sponsorCategory" value="<?php echo $row1['sponsorCategory'];?>"  onkeyup="keyupsponsorfun1()">
<option value="">Select Category</option>

<option class="General" value="General"  <?php if ( $row1['sponsorCategory'] == "General" ) { echo "selected"; } ?>>
General</option>
<option class="Prime" value="Prime"<?php if ( $row1['sponsorCategory'] == "Prime" ) { echo "selected"; } ?> >Prime</option>
<option class="Platinum" value="Platinum"<?php if ( $row1['sponsorCategory'] == "Platinum" ) { echo "selected"; } ?>>Platinum</option>
<option class="Gold" value="Gold"<?php if ( $row1['sponsorCategory'] == "Gold" ) { echo "selected"; } ?>>Gold</option>
<option class="Silver" value="Silver"<?php if ( $row1['sponsorCategory'] == "Silver" ) { echo "selected"; } ?>>Silver</option>
<option class="Media" value="Media"<?php if ( $row1['sponsorCategory'] == "Media" ) { echo "selected"; } ?>>Media</option>
</select>



</div>
</div>

<div class="col-md-12">
<div class="form-group">
<label for="sponsorDesc">Short Description<span style="color:red;">*</span></label> <span id="spsponsorDesc_error1" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
<textarea class="form-control" id="spsponsorDesc1" name="sponsorDesc" value="<?php $row1['sponsorDesc'];  ?>" maxlength="500" onkeyup="keyupsponsorfun1()"><?php echo $row1['sponsorDesc'];  ?></textarea>

</div>
</div>
<div class="col-md-12">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>




<input type="file" class="sponsorPic" id="sponsorImg1" name="sponsorImg">
<!--    <span id="sponsorImg_error1" style="color:red; "></span>
-->    <p class="help-block"><small>Browse files from your device</small></p>


<?php if (!empty($row1['sponsorImg'])) { 

echo '<img src="'.($row1['sponsorImg']).'" class="img-responsive" alt="" style="height: 50px;width: 50px;">';
}else{?>

<img src='../assets/images/blank-img/no-store.png' style="height: 50px;width: 50px;" />
<?php }
?>
</div>
</div>

<div class="col-md-9" style="padding-left: 130px">
<div class="form-group">
<label for="sponsorPreview">Logo Preview</label>
<div id="sponsorPreview"></div>
<div id="postingsponsorPreview">
<div class="row">
<div id="spPreview" >

</div>
</div>
</div>
</div>
</div>
</div>
</div>

</div>

<?php }

}?>


</div>

<div class="modal-footer bg-white br_radius_bottom">
<button type="button" class="btn btn-default db_btn db_orangebtn btn-border-radius" data-dismiss="modal">Close</button>
<button id="EditSponser" type="submit" class="btn btn-primary db_btn db_primarybtn EditgroupSponser btn-border-radius" >Update</button>
</div>
</form>
</div>
</div>
</div>

<?php }
}else{ ?>

<td colspan="8"><center>No Record Found</center></td><?php }?>


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
<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>


<script type="text/javascript">

function keyupsponsorfun() {

//alert();

var company= $("#sponsorTitle").val()

var Website = $("#sponsorWebsite").val()
var Price = $("#spsponsorPrice").val()
var category = $("#sponsorCategory").val()
var Description = $("#spsponsorDesc").val()
var sponsorImage = $("#sponsorImg").val()

//alert(category);
//alert(category.length);

if(company != "")
{
$('#sponsorTitle_error').text(" ");

}
if(Website != "")
{
$('#sponsorWebsite_error').text(" ");
}
if(Price != "" )
{
$('#spsponsorPrice_error').text(" ");

}
if(category.length != 0)
{
$('#sponsorCategory_error').text(" ");

}
if(Description != "")
{
$('#spsponsorDesc_error').text(" ");
}
if(sponsorImage != "")
{
$('#sponsorImg_error').text(" ");

}


}

</script>


<script type="text/javascript">

function keyupsponsorfun1() {

//alert();

var company= $("#sponsorTitle1").val()

var Website = $("#sponsorWebsite1").val()
var Price = $("#spsponsorPrice1").val()
var category = $("#sponsorCategory1").val()
var Description = $("#spsponsorDesc1").val()
//var sponsorImage = $("#sponsorImg1").val()

//alert(category);
//alert(category.length);

if(company != "")
{
$('#sponsorTitle_error1').text(" ");

}
if(Website != "")
{
$('#sponsorWebsite_error1').text(" ");
}
if(Price != "" )
{
$('#spsponsorPrice_error1').text(" ");

}
if(category.length != 0)
{
$('#sponsorCategory_error1').text(" ");

}
if(Description != "")
{
$('#spsponsorDesc_error1').text(" ");
}
/* if(sponsorImage != "")
{
$('#sponsorImg_error').text(" ");

}*/


}

</script>
</body>
</html>
