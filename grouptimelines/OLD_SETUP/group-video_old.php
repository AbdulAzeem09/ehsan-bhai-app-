<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 'On');*/
include('../univ/baseurl.php');
session_start();

function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}

$pid=$_SESSION['pid'];
$getid=$group_id;
$obj2=new _spAllStoreForm;	
$ress2=$obj2->readdatabymulid($getid,$pid);
if($ress2 ==false){
//die("=======");
header("location:$BaseUrl/my-groups/?msg=notaccess");

}

?>
<style>
.swal2-popup {

font-size: 12px;
}


</style>


<!DOCTYPE html>
<html lang="en-US">

<head>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
<?php include('../component/links.php');?>
<!--This script for posting timeline data Start-->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
<!--This script for posting timeline data End-->
<!-- image gallery script strt -->
<link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
<!-- image gallery script end -->
</head>

<body class="bg_gray" onload="pageOnload('groupdd')">
<?php

include_once ("../header.php");

$g = new _spgroup;
$result = $g->groupdetails($group_id);
//echo $g->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
?>

<?php 
include('../helpers/image.php');
if(isset($_POST['upload'])) {
    $image = new Image();
    $image->validateFileVideoExtensions($_FILES['file']);
  
        $id=$_POST['id'];

        $uid=$_SESSION['uid'];
        $pid=$_SESSION['pid'];
        $gid=$_POST['gid'];
        $dir='group_video_upload/';
        $tmp_file=$_FILES['file']['tmp_name'];
        $file=$_FILES['file']['name'];
        move_uploaded_file($tmp_file, "$dir/$file");
        $date=$_POST['date'];
        $dt=array(
                "user_id"=>$uid,
                "profile_id"=>$pid,
                "group_id"=>$gid,
                "file"=>$file,
                "date_created"=>$date
        );
        $obj=new _postingalbum;
        $obj->insertfile($dt);


    
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
<div class="col-md-3">
<span id="size1">Group <small>[Videos]</small></span>

</div>
<?php 
$pg = new _spgroup;
$ress2 = $pg->readdatabyspid($group_id);
if ( $ress2 != false) {
$roww2 = mysqli_fetch_assoc($ress2);
$idspProfiles =  $roww2['idspProfiles'];
// $idspProfiles;

$pid=$_SESSION['pid'];
//print_r($roww2);
//	echo $pid.'====='.$roww2['idspProfiles'];
//die("=======");

if($pid==$roww2['idspProfiles']){

?>
<div class="col-md-3" style="float:right;">


<a href="#" style="float:right; padding:8px" data-toggle="modal" data-target="#videoUploading" class="btn btn-success  btn-border-radius" >Upload video</a>

</div>
<?php } ?>
</div>




</div>
<?php 
$obj=new _postingalbum;
$ress=$obj->readdatabygid($group_id);


if($ress != ''){




while($roww=mysqli_fetch_assoc($ress)){

?>
<div class="col-md-4" style="">
<video width="290" height="200" controls>
<source src="group_video_upload/<?php echo $roww['file']; ?>" type="video/mp4">

Your browser does not support the video tag.
</video>
<?php 
$groupid=$group_id;



$groupname=$_GET['groupname'];

if($pid==$roww2['idspProfiles']){
?>
<?php  $aaa= $BaseUrl.'/grouptimelines/delete_video.php?id='.$roww['id'].'&flag=1&groupid='.$groupid.'&groupname='.$groupname.'';?>

<a id="dell" onclick="video('<?php echo $aaa;  ?>')" style="cursor:pointer">
<i class="fa fa-trash  btn-outline-danger btn-border-radius"></i> Delete Video</a>			

<?php } ?>

</div>
<?php }} ?>
<div class="row no-margin" style="padding: 10px;">


<?php
$p = new _postings;
$p2 = new _postings;
$start = 0;
//$res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);

$conn = _data::getConnection();

$gid = $group_id;
/* $sql = "SELECT s.spPostings_idspPostings FROM spshare AS s INNER JOIN allpostdata AS f ON f.idspPostings = s.spPostings_idspPostings WHERE spShareToGroup = $gid AND f.idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings FROM allpostdata AS t inner join spprofiles as d on t.idspprofiles = d.idspprofiles where idspcategory = 17 and t.sppostingvisibility = $gid ORDER BY spPostings_idspPostings DESC";*/

/* $sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid ORDER BY timelineid DESC";*/

$sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid INNER JOIN sppostingmedia h on f.idspPostings = h.spPostings_idspPostings WHERE spShareToGroup = $gid AND h.sppostingmediaExt = 'mp4' AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid ORDER BY timelineid DESC";

//echo $sql;
$res = mysqli_query($conn, $sql);

if ($res != false){
while ($timeline = mysqli_fetch_assoc($res)) {


$pg = new _spgroup;
$rpvt = $pg->readgroupAdmin($group_id);
if ($rpvt != false) {
while ($row = mysqli_fetch_assoc($rpvt)) {


$admin = $row['idspProfiles'];

}
}

}




$_GET["timelineid"] = $timeline['timelineid'];
$res2 = $p2->singletimelines($_GET["timelineid"]);
//echo $p2->ta->sql;
if ($res2 != false){
while ($rows = mysqli_fetch_assoc($res2)) {

// echo "<pre>";
//print_r($rows);
$pr = new _spprofiles;
$NameOfProfile = $pr->getProfileName($rows['spProfiles_idspProfiles']);
$dt = new DateTime($rows['spPostingDate']);

$media = new _postingalbum;
$result = $media->read($rows['idspPostings']);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if($sppostingmediaExt == 'mp4'){ ?>
<div class="col-md-4 no-padding searchable text-center">
<div class="groupGallery">
<div class="video_box">
<video  style='width: 100%' controls>
<source src='<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
</video>
</div>
<div class="btmFoot">
<p class="date"><?php echo $dt->format('d-M-Y'); ?></p>
<a class="name" href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['spProfiles_idspProfiles'];?>"><?php echo $NameOfProfile;?></a>
<?php if($admin == $_SESSION['pid']){ ?>
<a href="<?php echo $BaseUrl.'/post-ad/deletegrouppost.php?postid='.$rows['idspPostings'].'&;flag=1';?>"><i class="fa fa-trash"></i> Delete Post</a>

<?php } ?>
</div>
</div>
</div>
<?php
}
}
}
}
}
} ?>
</div>
</div>
</div>
</div>

</div>

</div>
</div>
</section>



<!-- Modal -->

<div class="modal" tabindex="-1" id="videoUploading">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Video Uploading</h5>
<button type="button" class="btn-close btn-border-radius" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">



<form action="" method="POST" enctype="multipart/form-data">
<div class="mb-3">

<input type="hidden" class="form-control" id="id" aria-describedby="emailHelp" name="id" value="<?php echo $id; ?>">
</div>
<div class="mb-3">

</div>
<div class="mb-3">

</div>
<div class="mb-3">

<input type="hidden" class="form-control" id="gid" name="gid" value="<?php echo $group_id; ?>">
</div>
<div class="mb-3">
<label for="file" class="form-label">UPLOAD VIDEO :</label>
<input type="file" class="form-control" id="file" name="file" accept="video/mp4,video/x-m4v,video/*"
style="display:block;">
</div><br>
<div class="mb-3">


<input type="hidden" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d"); ?>">
</div>


<button style="margin-top: -12px;" type="submit" class="btn btn-primary pull-right  btn-border-radius"name="upload">UPLOAD</button>
<button style="margin-top: -12px; margin-right:10px;" type="submit" class="btn btn-danger pull-right  btn-border-radius"name="upload">Cancel</button>
</form>



</div>
<!--div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="button" class="btn btn-primary" name="upload">UPLOAD</button>
</div -->
</div>
</div>
</div>

<!--End Modal -->

<?php include('../component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../component/btm_script.php'); ?>
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>



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
</body>
</html>
<script>
function video(a) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = a;
        }
    });
}
</script>






