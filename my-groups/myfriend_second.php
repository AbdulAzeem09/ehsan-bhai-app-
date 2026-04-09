<?php

$b = array();
$g = new _spgroup;
$r = new _spprofilehasprofile;
$p = new _spprofiles;
$res = $r->friends_new($_SESSION["pid"]); //As a receiver   
//echo $r->ta->sql;         
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {

if ($rows["spProfiles_has_spProfileFlag"] == 1) {
$p = new _spprofiles;
$sender = $rows["spProfiles_idspProfilesReceiver"];
array_push($b, $sender);
}
}
}
//print_r($b);
$res = $r->friend_new($_SESSION["pid"]); //As a sender
//echo $r->ta->sql;
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
if ($rows["spProfiles_has_spProfileFlag"] != 0) {
//echo $rows["spProfiles_idspProfilesReceiver"];
$rm = in_array($rows["spProfiles_idspProfileSender"], $b, true);
if ($rm == "") {
array_push($b, $rows["spProfiles_idspProfileSender"]);
}
}
}
}

$rpvt = $g->members($_GET["groupid"]);
// print_r($rpvt);
//echo $p->ta->sql;
$member = array();
if ($rpvt != false) {
while ($row2 = mysqli_fetch_assoc($rpvt)) {
array_push($member, $row2['spProfiles_idspProfiles']);
}
}
$count = 0;


/* print_r(array_intersect($b, $member));*/

$fremember = array_intersect($b, $member);
//print_r($fremember);
//if(empty($fremember)){

foreach ($b as $key => $value) {


if (!in_array($value, $member)) {

$result = $p->read($value);
if ($result != false) {


$row = mysqli_fetch_assoc($result);
?>
<div class="member_add 1111" style="margin-bottom:1px">
<div class="">
<div class="" style="float:left">
<?php
if (isset($row['spProfilePic'])) {
echo "<img  alt='profile-Pic' class='img-responsive' style='border-radius:40px' src=' " . ($row['spProfilePic']) . "' >";
} else { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png" style="border-radius:40px" class="img-responsive" alt="" /> <?php
}  ?>
</div>
<div>
<h3 style="white-space: nowrap;overflow: clip;text-overflow: ellipsis; "><a title="<?php echo ucfirst($row["spProfileName"]); ?>" style="background-color:white; border:none; color:black; font-size:15px" href="<?php echo $BaseUrl . '/friends/?profileid=' . $row['idspProfiles']; ?>"><?php echo ucfirst($row["spProfileName"]); ?></a></h3>
</div>
<!--<a data-toggle="popover" data-placement="top" data-html="true" data-content="<div class='popover_content'><a class='addtodeletes' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $_GET["groupid"]; ?>' ><i class='fa fa-trash'></i> Delete Member</a> </div>"><i class="fa fa-cog"></i></a>-->

<a data-pid="<?php echo $row['idspProfiles'] ?>" data-gid="<?php echo $_GET['groupid'] ?>" data-gname="<?php echo $_GET['groupname'] ?>" class="btn addtodeletes btn-border-radius" style="display:inline-block;margin:6px;background-color:#a96cfd;color:aliceblue;"><i class="fa fa-user"></i> Add</a>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
</div>
</div>

<?php
} else {

// echo "<p>All member have been added to group.No new member available.</p>";
}
$count++;
if ($count > 5) {
break;
}
} else {
}






/*   if(in_array($value, $member)){



}else{

$result = $p->read($value);
if ($result != false) {
$row = mysqli_fetch_assoc($result);
?>
<div class="member_add">
<div class="">
<?php
if(isset($row['spProfilePic'])){
echo "<img  alt='profile-Pic' class='img-responsive' src=' " . ($row['spProfilePic']) . "' >";
}else{ ?>
<img src="<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png" class="img-responsive" alt="" /> <?php
}  ?>
<h3><?php echo $row["spProfileName"];?></h3>
<a href="<?php echo $BaseUrl.'/my-friend/addtogroupmember.php?pid='.$row['idspProfiles'].'&gid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&timeline';?>" class="btn add_member_btn"><i class="fa fa-user"></i> Add Member</a>
</div>
</div>
<?php
}
$count++;
if($count > 3){
break;
}
}*/
}


//}else{

// echo "<h5 style='text-align: center;'>No Members Found</h5>";

//}


?>
<script>
$(".addtodeletes").on("click", function() {

var btn = this;
var pid = $(this).data("pid");
var gid = $(this).data("gid");

var gname = $(this).data("gname");

Swal.fire({

title: 'Are you sure you want to add this member to group?',
text: "You won't be able to revert this!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Add it!'
}).then((result) => {
if (result.isConfirmed) {
$.get("../my-friend/addtogroupmember.php", {
pid: pid,
gid: gid,
gname: gname
}, function() {
// $(btn).closest("li").remove();
//$(btn).closest(".groupmembers").find(".sp-group-details").remove();
location.reload();
});
}
})


});
</script>