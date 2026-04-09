<?php
$getid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$p = new _spgroup;
$rpvt = $p->members_pending($getid); 
//echo $p->ta->sql;
if ($rpvt != false) {
$i= 0;

while ($row = mysqli_fetch_assoc($rpvt)) {

/*print_r($row);*/
if ($row['spApproveRegect'] == 0) {  


//  if (isset($admin) && $row['spAssistantAdmin'] == 1) {
?>
<div class="col-md-4">
<div class="member_box" id="ip2" style="background-color: #e6e1f4">
<div class="row">
<div class="col-md-4" style="margin-top: 8px;">  
<?php
if(isset($row['spProfilePic'])){ ?>
<img src='<?php echo ($row['spProfilePic']); ?>' class="img-responsive profilePic" alt="" /> <?php
}else{ ?>
<!--<img src='<?php echo $BaseUrl;?>/assets/images/icon/member/member_blank.jpg' class="img-responsive" alt="" /> -->  
<img src='<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png' class="img-responsive" alt="" /> 
<?php
}
?>
</div>
<style>
#sendrequest { 
    display: inline-block!important;  
    padding: 7px 20px!important;
}
</style>

<div class="col-md-8 no-padding sp-group-details">
<h3><a href="<?php echo $BaseUrl.'/friends/?profileid='.$row['idspProfiles'];?>" style="color:black;"><?php echo ucwords($row['spProfileName']);?></a></h3>
<!--  <h4><?php echo $row['spProfilesCity']." , ".$row['spProfilesCountry'];?></h4> -->

<div style="padding-top: 20px;">
<a href='javascript:void(0);' class='accept_request' style='' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid;?>'>
<button id="sendrequest" type="button" class="btn btnPosting db_btn btn-border-radius"
style=" background-color: #000066; text-color:green;">
Accept
</button>
</a>
<a href='javascript:void(0);' class='reject_request' style='' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid;?>'>
<button id="sendrequest" type="button" class="btn btnPosting db_btn pull-right btn-border-radius"
style=" background-color:  #00ace6
; float: right;"  data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid;?>'>
Reject
</button>
</a>
</div>
<!---
<h5>Joined<span class="pull-right">
<?php
if ($admin_Id == $_SESSION['pid']) {
?>
<a data-toggle="popover" data-placement="top" data-html="true" data-content="<div class='popover_content'><a class='addtodelete' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $_GET["groupid"];?>' ><i class='fa fa-trash'></i> Delete Member</a>
<a href='javascript:void(0);' class='accept_request' style='font-size:14px!important;' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $_GET["groupid"];?>'><i class='fa fa-user' aria-hidden='true'></i>Accept Request</a></div>"><i class="fa fa-cog"></i></a>
<?php
}
?>
</span></h5>
<p>Added on <?php echo $row['spGroup_newMember_Date'];?></p>
---->
</div>
</div>
</div>
</div>
<?php

//   }/*else{*/
/* if($i==0){

echo "<h5 style='text-align: center;'>No Assistant Admin Found</h5>";
}*/
$i++;
/* } */


}
}
}
?>

<script type="text/javascript">

$(".sp-group-details").on("click", ".accept_request", function () {

var btn = this;
$.get("../my-groups/accept_request.php", {pid: $(this).data("pid"), gid: $(this).data("gid"),flag:1}, function (r) {
window.location.replace("<?php echo $BaseUrl; ?>/grouptimelines/member.php?groupid=<?php echo $getid;?>&groupname=<?php echo $_GET['groupname'];?>&members&tab=memberreq");
//location.reload();
});
});

$(".sp-group-details").on("click", ".reject_request", function () {
var btn = this;
$.get("../my-groups/accept_request.php", {pid: $(this).data("pid"), gid: $(this).data("gid"),flag:100}, function (r) {
// location.reload();
window.location.replace("<?php echo $BaseUrl; ?>/grouptimelines/member.php?groupid=<?php echo $getid;?>&groupname=<?php echo $_GET['groupname'];?>&members&tab=memberreq");
});
});

$(".sp-group-details").on("click", ".addtodelete", function () {
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
