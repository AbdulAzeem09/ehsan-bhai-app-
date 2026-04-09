<?php
/*	error_reporting(E_ALL);
ini_set('display_errors', '1');*/
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

?>
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
<style>
div:where(.swal2-container).swal2-center>.swal2-popup {
    height: 297px;
    font-size: 15px;
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
$gimage = $row["spgroupimage"];
$spGroupflag = $row['spgroupflag'];
}
//print_r($result);
//die("=======");
?>


<?php
$obj=new _groupconversation;
$result2=$obj->readpa($group_id);

while($row2 = mysqli_fetch_assoc($result2)){
//print_r($row);
//die("=======");
//die("=======");
}
//print_r($result2);
//die("=======");
?> 


<?php

$objmem=new _groupconversation;
$result3=$objmem->readmember($group_id,$_SESSION['pid']);

if($result3 != false)
{
while($row3 = mysqli_fetch_assoc($result3)){

//print_r($row3);
//die("=======");

}}
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
<span id="size1">Group <small>[Photos]</small></span>
</div>

<div class="col-md-6">
<a class="pull-right" href="<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname'] ?>&timeline&page=1">Back</a>
</div>

</div>
</div>
<div class="row no-margin" style="padding: 10px;">

<?php
$p = new _postings;
$p2 = new _postings;
$start = 0;
//$res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);

$conn = _data::getConnection();

$gid = $group_id;


$sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid WHERE spShareToGroup = $gid AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid ORDER BY timelineid DESC";

//echo $sql;
$res = mysqli_query($conn, $sql);
//var_dump($res);


$pg = new _spgroup;
$rpvt = $pg->readgroupAdmin($group_id);
if ($rpvt != false) {
while ($row = mysqli_fetch_assoc($rpvt)) {


$admin = $row['idspProfiles'];

}
}

if ($res != false){
while ($timeline = mysqli_fetch_assoc($res)) {

/*print_r($timeline);*/

$_GET["timelineid"] = $timeline['timelineid'];
$res2 = $p2->singletimelines($_GET["timelineid"]);
//var_dump($res2);
//echo $p2->ta->sql;
if ($res2 != false){
while ($rows = mysqli_fetch_assoc($res2)) {

// print_r($rows);
$pr = new _spprofiles;
$NameOfProfile = $pr->getProfileName($rows['spProfiles_idspProfiles']);
// var_dump($NameOfProfile);
$dt = new DateTime($rows['spPostingDate']);

$pic = new _postingpic;
$result = $pic->read($rows['idspPostings']);
//var_dump($result);
//echo $pic->ta->sql;
if ($result != false) {
while ($rp = mysqli_fetch_assoc($result)) {
//print_r($rp);
$pict = $rp['spPostingPic'];
}
} else {
$pict = NULL;
} 
if($pict == NULL){

}else { ?>
<div class="col-md-3 no-padding searchable text-center">
<div class="groupGallery">
<a class="thumbnail" rel="lightbox[group]" href="<?php echo $BaseUrl?>/grouptimelines/?groupid=<?php echo $group_id?>&groupname=<?php echo $_GET['groupname'];?>&timeline">
<?php
echo "<img alt='Posting Pic' src='" . ($pict) . "' style='width: 74%;height: 181px;' class='postpic img-thumbnail img-responsive'>";
?>
</a>
<div class="btmFoot">
<p class="date"><?php echo $dt->format('d-M-Y'); ?></p>
<a class="name" href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['spProfiles_idspProfiles'];?>"><?php echo $NameOfProfile;?></a>
<?php if($admin == $_SESSION['pid']){ ?>

    

    <a onclick="remove_member('<?php echo $BaseUrl.'/post-ad/deletegrouppost.php?postid='.$rows['idspPostings'].'&flag=1';?>')">
  <i class="fa fa-trash"></i> Delete Post
</a>


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
<?php include('../component/btm_script.php'); ?>
<!-- image gallery script strt -->


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>   

<script>
function remove_member(id){

Swal.fire({
title: 'Are you sure you want to delete ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
confirmButtonText: 'Yes',
cancelButtonColor: '#FF0000',
cancelButtonText: 'No',


}).then((result) => {
if (result.isConfirmed) {
window.location.href = id;
}
});

}
</script>

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
</body>
</html>
