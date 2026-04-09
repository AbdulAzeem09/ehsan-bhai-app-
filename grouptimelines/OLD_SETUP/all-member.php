<style>
.zoom1:hover {
-ms-transform: scale(1.05); /* IE 9 */
-webkit-transform: scale(1.05); /* Safari 3-8 */
transform: scale(1.05); 
}



</style>

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<?php
$getid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$p = new _spgroup;
$rpvt = $p->members($getid);
$gcdate =	$p->groupCreatedDate($getid);
if($gcdate){
$groupCrDate = mysqli_fetch_assoc($gcdate);
}
$CreatedDate =  $groupCrDate['CreatedDate'];



//echo $p->ta->sql;
if ($rpvt != false) {
while ($row = mysqli_fetch_assoc($rpvt)) {
    // print_r($row);
if ($row['spApproveRegect'] == 1) {
if ($row['spProfileIsAdmin'] == 0) { ?>
<div class="col-md-4">
<div class="member_box" id="ip2"   style="background-color: #e78cdd">
<div class="row">
<div class="col-md-4" style="margin-top: 8px;">   
<?php
if(isset($row['spProfilePic'])){ ?>
<img src='<?php echo ($row['spProfilePic']); ?>' class="img-responsive profilePic" alt="" /> <?php
}else{ ?>
    <img src='<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png' class="img-responsive" alt="" />
<!--<img src='<?php echo $BaseUrl;?>/assets/images/icon/member/member_blank.jpg' class="img-responsive" alt="" />--> <?php
}
?>
</div>
<div class="col-md-8 no-padding"  >
<h3><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>" style=" color: black;"><?php 

if(strlen($row['spProfileName'])>0){

echo ucwords(substr($row['spProfileName'],0,20).'....');}
else{echo ucwords($row['spProfileName']);}?> </a></h3>
<!--  <h4><?php echo $row['spProfilesCity']." , ".$row['spProfilesCountry'];?></h4> -->
<h5 style=" color: black;">
Joined
<?php if($_SESSION['pid'] != $row['idspProfiles']){ ?>
<span class="pll-right" style="float: right;">
<img src="<?php echo $BaseUrl;?>/assets/images/icon/member/group_admin.png" class="img-responsive" alt="">
</span>
<?php } ?>
</h5>
<p style=" color: black;">Added on <?php 
if($row['spGroup_newMember_Date']=="0000-00-00"){
echo $CreatedDate;

}
else {
echo $row['spGroup_newMember_Date'];
}
?></p>
<!-- //<button type="sumbit" class="btn btn-success">save</button> -->
</div>
</div>
</div>
</div> <?php
//src=' ".($row['spProfilePic'])."'                                                                
}else{

//if admin = 0  and spAssistantAdmin = 0 then make assistent admin
if (isset($admin) && $row['spAssistantAdmin'] == 0) {?>
<div class="col-md-4">
<div class="member_box " id="ip2" style="background-color: #e978dd">
<div class="row">
<div class="col-md-4" style="margin-top: 8px;">  
<?php
if(isset($row['spProfilePic'])){ ?>
<img src='<?php echo ($row['spProfilePic']); ?>' class="img-responsive profilePic" alt="" /> <?php
}else{ ?>
     <img src='<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png' class="img-responsive" alt="" />
<!--<img src='<?php echo $BaseUrl;?>/assets/images/icon/member/member_blank.jpg' class="img-responsive" alt="" /> -->
<?php
}
?>
</div>
<div class="col-md-8 no-padding sp-group-details">
<h3><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>" style=" color: black;"><?php echo ucwords($row['spProfileName']);?>
</a></h3>
<!-- <h4><?php echo $row['spProfilesCity']." , ".$row['spProfilesCountry'];?></h4> -->
<h5 style=" color: black;">Joined<span class="pull-right">
<!--img style="margin-right: 10px;" src="<?php //echo $BaseUrl;?>/assets/images/icon/member/group_sub_admin.png" class="img-responsive" alt=""-->
<?php
if ($admin_Id == $_SESSION['pid']) {
$pid_1 = 	$row['idspProfiles'];
$gid_1   =   $getid;

?>


<a data-toggle="popover" data-placement="top" data-html="true"  data-content="<div class='popover_content'><a class='addtodeletes zoom1' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid;?>' ><i class='fa fa-trash'></i> Delete Member</a>
<a href='javascript:void(0);' class='assistant_admin zoom1'  style='font-size:14px!important;' data-name='<?php echo $row['spProfileName']; ?>' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid;?>'><i class='fa fa-user' aria-hidden='true'></i> Make Admin Assistant</a> </div>"><i class="fa fa-cog"></i></a>
<?php
/* echo "<a href='#' class='btn btn-success assistant_admin' data-pid='" . $row['idspProfiles'] . "' data-gid='" . $_GET["groupid"] . "'>Make Admin Assistant</a><span style='".(($row['spAssistantAdmin'] == 0) ? "margin:0px -8px 0px 8px" : "")."' class='separator1'></span>";*/
}
?>
</span></h5>
<p style=" color: black;">Added on  <?php echo $row['CreatedDate'];?></p>
</div>
</div>
</div>
</div>
<?php

} elseif (isset($admin) && $row['spAssistantAdmin'] == 1) {
?>
<div class="col-md-4">
<div class="member_box " id="ip2" style="background-color: #202548">
<div class="row">
<div class="col-md-4">
<?php
if(isset($row['spProfilePic'])){ ?>
<img src='<?php echo ($row['spProfilePic']); ?>' class="img-responsive profilePic" alt="" /> <?php
}else{ ?>
 <img src='<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png' class="img-responsive" alt="" />
<!--<img src='<?php echo $BaseUrl;?>/assets/images/icon/member/member_blank.jpg' class="img-responsive" alt="" /> -->
<?php
}
?>
</div>
<div class="col-md-8 no-padding sp-group-details">
<h3><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>" style=" color: black;"><?php echo ucwords($row['spProfileName']);?></a></h3>

<h5 style=" color: black;">Joined<span class="pull-right">
<?php
if ($admin_Id == $_SESSION['pid']) {
?>
<a data-toggle="popover" data-placement="top" data-html="true" data-content="<div class='popover_content'><a class='addtodeletes' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid;?>' ><i class='fa fa-trash'></i> Delete Member</a> </div>"><i class="fa fa-cog"></i></a>
<?php
}
?>
</span></h5>
<p style=" color: black;">Added on <?php echo $row['spGroup_newMember_Date'];?></p>
</div>
</div>
</div>
</div>
<?php

} 

}
}
}
}
?>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">

$(".sp-group-details1").on("click", ".assistant_admin1", function () {
var btn = this;
var name = $(this).data("name");
//alert(name);
if (confirm("Are you sure you want to make " + name + " assistant admin for this group?")){
$.get("../my-groups/makeAssistant.php", {pid: $(this).data("pid"), gid: $(this).data("gid")}, function (r) {
location.reload();
});
}
});


$(".sp-group-details1").on("click", ".addtodeletes1", function () {
var btn = this;
if (confirm("Are you sure you want to delete member from group?"))
{
$.get("../my-groups/removeMember.php", {pid: $(this).data("pid"), gid: $(this).data("gid")}, function (r) {
$(btn).closest("li").remove();
$(btn).closest(".groupmembers").find(".sp-group-details").remove();
location.reload();
});
}
});
</script>



<script type="text/javascript">
/*$(".sp-group-details").on("click", ".assistant_admin", function () {  
//alert('fghfjgdf');
var btn = this;
var name = $(this).data("name");
var pid = $(this).data("pid");
var gid = $(this).data("gid");
//alert($(this).data("gid"));

swal.fire({ title: "Are you sure you want to make "+ name + " assistant admin for this group?", type: "warning", confirmButtonClass: "sweet_ok", confirmButtonText: "Yes", cancelButtonClass: "sweet_cancel", cancelButtonText: "No", showCancelButton: true }).then((result) => {
if (result.isConfirmed) {
$.get("../my-groups/makeAssistant.php", {pid: pid, gid: gid }, function () {
//location.reload();
window.location.replace("<?php echo $BaseUrl; ?>/grouptimelines/member.php?groupid=<?php echo $getid;?>&groupname=<?php echo $_GET['groupname'];?>&members&tab=allmemder");
});

}
});

});*/

$(".sp-group-details").on("click", ".addtodeletes", function () { 
var btn = this;
var pid = $(this).data("pid");
var gid = $(this).data("gid");

swal.fire({ title: "Are you Sure you want to delete ?", type: "warning", confirmButtonClass: "sweet_ok", confirmButtonText: "Yes", cancelButtonClass: "sweet_cancel", cancelButtonText: "No", showCancelButton: true }).then((result) => {
if (result.isConfirmed) {
//alert('kkkkkkk');
$.get("../my-groups/removeMember.php", {pid: pid, gid: gid }, function () {
$(btn).closest("li").remove();
$(btn).closest(".groupmembers").find(".sp-group-details").remove();
// location.reload();
window.location.replace("<?php echo $BaseUrl; ?>/grouptimelines/member.php?groupid=<?php echo $getid;?>&groupname=<?php echo $_GET['groupname'];?>&members&tab=allmemder");
});

}
});

});

</script>
