<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">

<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/



include('../univ/main.php');
$dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
// Check connection
if (mysqli_connect_errno()) {
echo "Failed to connect to MySQL: " . mysqli_connect_error();
exit();
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$g = new _spgroup;
$result = $g->groupdetails($groupid);
//echo $g->ta->sql;die;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
//echo "<pre>";
// print_r($row);
$profileId = $row["idspProfiles"];
$spUserid = $row["spUser_idspUser"];
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
$spgroupCategory = $row['spgroupCategory'];
$spGroupTag = $row['spGroupTagline'];
$id = $row['idspGroup'];
//echo $spgroupCategory;die;
$bannerpicture = $row["spgroupimage"];
}


$b = new _storegroupbanner;


$result2  = $b->read($spUserid);
if ($result2 != false) {
$bannerrow = mysqli_fetch_assoc($result2);

// $bannerpicture = $bannerrow["spStorebanner"];


}
//////////////////////////
$gr_id = $group_id;
$gr_sql = "SELECT * FROM spgroup WHERE idspGroup ='$gr_id'";
$gr_result = mysqli_query($dbConn, $gr_sql);
$gr_row    = mysqli_fetch_assoc($gr_result);
//print_r($gr_row);die('===');
//extract($gr_row);
/// //////////////////////

?>



<?php
include('../univ/baseurl.php');
include("../univ/main.php");
?>
<style>
.zoom1:hover {
-ms-transform: scale(1.15);
/* IE 9 */
-webkit-transform: scale(1.15);
/* Safari 3-8 */
transform: scale(1.15);
}
</style>


<!--    <div class="topstatus timeline-topstatus right_sidebar" style="margin-bottom: 15px;"> -->

<div class="row no-margin">
<div class="col-md-12 no-padding">
<div class="top_banner">



<?php if ($row["idspProfiles"] == $_SESSION['pid']) { ?>

<?php if (strlen($_GET['groupname']) < 50) { ?>
<span class="no_margin 555" style="font-weight: bold;font-size: 22px;color: #202548;"><?php echo ucwords(strtolower($_GET['groupname'])); ?></span>
<?php } else { ?>
<span class="no_margin 555" style="font-weight: bold;font-size: 22px;color: #202548;"><?php echo ucwords(strtolower(substr($_GET['groupname'], 0, 50) . '...')); ?></span>
<?php } ?>

<a href="javascript:void(0)" id="edit_group" class="" data-toggle="modal" data-target="#StorebannerUpload" style="color: #202548!important; float: right; font-size: 30px;"><i class="fa fa-edit zoom1"></i></a>
<div><span class="alert alert-success" id="span4" style="float: right;        margin-top: -51px;
margin-right: -133px; display:none;">Update Successfully!</span> </div>
<?php  } ?>



<?php


if (isset($gimage) && $gimage != '' && !isset($bannerpicture)) {
?>


<img src="<?php echo $BaseUrl; ?>//upload/group/<?php echo $gimage; ?>" class="img-responsive" alt="" />

<?php
} elseif (isset($bannerpicture) && $bannerpicture != '') {
?>

<img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">
<!--div style ="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);  color: white ; font-size:59px"><?php //echo $_GET["groupname"]; 
																								?></div-->

<?php } else { ?>

<img src="<?php echo $baseurl; ?>/assets/images/bg/top_banner.jpg" class="img-responsive" alt="" />

<?php

}

?>

</div>

<?php $pid = $_SESSION['pid'];

$obj2 = new _spAllStoreForm;
$ress2 = $obj2->readdatabymulid($groupid, $pid);
if ($ress2 == false) {
//die("=======");
//header("location:$BaseUrl/my-groups/?msg=notaccess");

?>
<div class="pull-left" style="margin-top:30px; margin-bottom:10px; margin-left:-40px;">
<ul style="display:flex;">
<li><a href="https://dev.thesharepage.com/grouptimelines/about.php?groupid=<?php echo $groupid ?>&groupname=<?php echo $_GET['groupname'] ?>&about">About</a></li>&nbsp;&nbsp;&nbsp;
<li><a href=" https://dev.thesharepage.com/grouptimelines/group-announcement.php?groupid=<?php echo $groupid ?>&groupname=<?php echo $_GET['groupname'] ?>&announcement">Announcement</a></li>&nbsp;&nbsp;&nbsp;
<li><a href=" https://dev.thesharepage.com/grouptimelines/discussion-board.php?groupid=<?php echo $groupid ?>&groupname=<?php echo $_GET['groupname'] ?>&disc">Discussion</a></li>&nbsp;&nbsp;&nbsp;
<li><a href="https://dev.thesharepage.com/grouptimelines/group-photo.php?groupid=<?php echo $groupid ?>&groupname=<?php echo $_GET['groupname'] ?>&photo">Photos</a></li>
</ul>
</div>
<?php } ?>
</div>

</div>

<style>
.sharestorepos .modal-footer button {
border-radius: 6px;
}

input[type="radio"],
input[type="checkbox"] {
margin: 4px 5px 0;
margin-top: 1px \9;
line-height: normal;
}

.swal2-popup {
font-size: inherit !important;
}
</style>



<!-- <div class="row">
<div class="col-md-12">
<div class="group_banner">
<?php
if (isset($gimage) && $gimage != "") {
?>
<img src="<?php echo $BaseUrl; ?>/upload/group/<?php echo $gimage; ?>" class="img-responsive banner_img" alt="" />

<?php
} else {
?>
<img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_banner.jpg" class="img-responsive banner_img" alt="" /><?php
																	}
																		?>

<?php
if ($admin_Id == $_SESSION['pid']) { ?>
<form method="post" action="addbanner.php" class="grpfrm" enctype="multipart/form-data" >
<input type="hidden" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="spGroupId" value="<?php echo $_GET['groupid']; ?>">
<input type="hidden" name="spGroupName" value="<?php echo $_GET['groupname']; ?>">
<div class="upload_banner">
<span class="input-group-btn text-right"> 
<div class="btn btn-default image-preview-input"> 
<span class="glyphicon glyphicon-folder-open"></span> 
<span class="image-preview-input-title">Browse</span>
<input type="file" accept="image/png, image/jpeg, image/gif" name="spPostingPic"/>
</div>
<button type="submit" class="btn btn-labeled btn-primary" name="groupBanner" > <span class="btn-label"><i class="glyphicon glyphicon-upload"></i> </span>Upload</button>
</span>
</div>
</form>
<?php
}
?>


</div>
</div>
</div> -->
<!-- </div>-->



<!-------- <div class="row">
<div class="col-md-12 ">
<div class="banner_btn">
<div class="row">
<div class="col-md-6">
<div class="row">
<div class="col-md-2">
<?php
$p = new _spprofiles;
$result = $p->read($admin_Id);
if ($result) {
$row = mysqli_fetch_assoc($result);
echo "<img  alt='profile-Pic' class='img-responsive' style='width:100%; height: 46px;' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../assets/images/icon/blank-img.png") . "'>";
}
?>
</div>
<div class="col-md-10"  style="padding-left: 0px;">
<h2><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $admin_Id; ?>"><?php echo $admin_Name; ?></a></h2>
<p>Admin</p>
</div>
</div>

</div>
<div class="col-md-6 text-right">
<?php
$result_is_admin = $g->checkmember($_GET['groupid'], $_SESSION['uid']);
//echo $g->ta->sql;
if ($result_is_admin == false) {
?>
<div class="join_timeline_main" style="display: inline">
<button class="btn btn_group_join" data-pid="<?php echo $_SESSION['pid']; ?>" data-gid="<?php echo $_GET['groupid']; ?>" id="addmemontimeline">Joined</button>
</div>
<?php
}
?>

<?php
if ($result_is_admin != false) { ?>
<a href="#" class="notify">Notification <img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/tick.png" class="img-responsive" alt="" /></a>

<div class="dropdown" style="display: inline">
<button class="btn btn_group_join dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true" style="margin: 0px;"></i></button>
<ul class="dropdown-menu">
<li><a href="#">Leave</a></li>

</ul>
</div><?php
}
?>


</div>

</div>

</div>
</div>
</div>--------->

<!-- <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>-->
<script type="text/javascript">
$(function() {

$(".basestorebanner").change(function() {
$(".basestorebanner").change(function() {
 alert("dgjdbhujhgrjg");
if (typeof(FileReader) != "undefined") {
var bannerresults = $("#bannerresults");
//spPreview.html("");
var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
$($(this)[0].files).each(function() {
var file = $(this);
// alert(file[0].size);
if (file[0].size <= 2097152) {
if (regex.test(file[0].name.toLowerCase())) {
var reader = new FileReader();
reader.onload = function(e) {
var img = $("<span class='fa fa-remove dynamicspimg closed'></span><img class='divbannerimg overlayImage' style='width: 100%; height: 200px;overflow: hidden;' src='" + e.target.result + "'/></div>");

bannerresults.append(img);
// alert(img);
document.getElementById("bannerresults").classList.remove('hidden');
}
reader.readAsDataURL(file[0]);
} else {
alert(file[0].name + " is not a valid image file.");
//spPreview.html("");
return false;
}
} else {
alert(file[0].name + " is too large. Please upload image less then 2Mb++++++++++++.");
return false;
}
});
} else {
alert("This browser does not support HTML5 FileReader.");
}
});
});



$("#btnbannerimg").click(function() {
//alert('ok');
var pid = $("#spProfileId").val();
var uid = $("#spuserId").val();


var grpcategory = $("#grpcategory").val();
var spGroupTagline = $("#spGroupTagline").val();
var spGroupAbout = $("#spGroupAbout").val();
// alert(spGroupAbout);
var sgroupid = $("#sgroupid").val();
var spGroupName = $("#spGroupName").val();
var spgroupLocation = $("#spgroupLocation").val();
var spUserCountry_default_address = $("#spUserCountry_default_address").val();
var spUserState = $("#spUserState").val();
var spUserCity = $("#spUserCity").val();
var shipp_address = $("#shipp_address").val();
var shipp_zipcode = $("#shipp_zipcode").val();
//var spgroupflag = $("#spgroupflag").val();
var spgroupflag = $('input[name="spgroupflag"]:checked').val();

if ($(".divbannerimg").length) {
var imgCount = $(".divbannerimg").length;
var base64image = $(".divbannerimg").attr("src");
var arr = base64image.match(/data:image\/[a-z]+;/);

var ext = arr[0].replace("data:image/", "");
ext = ext.replace(";", "");

} else {
var base64image = '';
var ext = '';
}
var form_data = new FormData();
form_data.append('profileid', pid);
form_data.append('userid', uid);
form_data.append('ext', ext);
form_data.append('grpcategory', grpcategory);
form_data.append('spGroupTagline', spGroupTagline);
form_data.append('spGroupAbout', spGroupAbout);
form_data.append('sgroupid', sgroupid);
form_data.append('spGroupName', spGroupName);
form_data.append('spgroupLocation', spgroupLocation);
form_data.append('spUserCountry', spUserCountry_default_address);
form_data.append('spUserState', spUserState);
form_data.append('spUserCity', spUserCity);
form_data.append('address', shipp_address);
form_data.append('zipcode', shipp_zipcode);
form_data.append('spgroupflag', spgroupflag);


form_data.append("bannerPic", $("input[type=file]")[0].files[0]);
// alert(img);


$.ajax({
url: "uploadgroupbanner.php",
type: 'post',
data: form_data,
dataType: 'json',
contentType: false,
processData: false,
complete: function(data) {
//   console.log(data);
window.location.reload();

/*  swal({

title: "Banner Added Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});*/
}

});
});
});
</script>

<script>
$("#gname").change(function() {
$("#msg1").html("");
});
$("#spUserCountry_default_address").change(function() {
$("#msg2").html("");
});
$("#spUserState").change(function() {
$("#msg3").html("");
});
$("#spUserCity").change(function() {
$("#msg4").html("");
});
$("#shipp_address").change(function() {
$("#msg5").html("");
});
$("#shipp_zipcode").change(function() {
$("#msg6").html("");
$("#shippzipcode_error").html("");
});
$("#spGroupTagline").change(function() {
$("#msg7").html("");
});
$("#grpcategory").change(function() {
$("#msg8").html("");
});
$("#spGroupAbout").change(function() {
$("#msg9").html("");
});
</script>


<script>
$("#update3").on('click', function() {
var gname = $("#gname").val();
var spUserCountry_default_address = $("#spUserCountry_default_address").val();
var spUserState = $("#spUserState").val();
var spUserCity = $("#spUserCity").val();
var shipp_address = $("#shipp_address").val();
var shipp_zipcode = $("#shipp_zipcode").val();
var zipcode_length = $("#shipp_zipcode").val().length;
var spGroupTagline = $("#spGroupTagline").val();
var grpcategory = $("#grpcategory").val();

var spGroupAbout = $("#spGroupAbout").val();


if ((gname == "") || (spUserCountry_default_address == "0") || (spUserState == "0") || (spUserCity == "0") || (shipp_address == "") || (shipp_zipcode == "") || (spGroupTagline == "") || (grpcategory == "") || (spGroupAbout == "") || (zipcode_length < 4)) {
if (gname == "") {
$("#msg1").html("this field is required");

}
if (spUserCountry_default_address == "0") {
$("#msg2").html("this field is required");

}
if (spUserState == "0") {
$("#msg3").html("this field is required");

}
if (spUserCity == "0") {
$("#msg4").html("this field is required");

}
if (shipp_address == "") {
$("#msg5").html("this field is required");

}
if (shipp_zipcode == "") {
$("#msg6").html("this field is required");

}
if (spGroupTagline == "") {
$("#msg7").html("this field is required");

}
if (grpcategory == "") {
$("#msg8").html("this field is required");

}
if (spGroupAbout == "") {
$("#msg9").html("this field is required");

}
if (zipcode_length < 4) {
$("#shippzipcode_error").html("Please enter valid zipcode");

}

return false;
}





/*Swal.fire({
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
})*/
});
</script>
