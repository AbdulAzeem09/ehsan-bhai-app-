<!-- Favourite post start -->
<!-- <div class="post_timeline bradius-15 bg-white" style="padding: 5px 15px;">
<!-- Audio start -->
<!-- <input type="hidden" name="txtProfileId" id="txtProfileId" value="<?php echo $_SESSION['pid']; ?>">
<input type="hidden" name="txtPagid" id="txtPagid" value="5">
<div class="row filterArea no-margin bradius-20 bg-white">
<!--   <div class="col-md-4 " style="padding: 3px;">

</div>
<div class="col-md-4 no-padding">

</div> -->
<!-- <div class="col-md-4 no-padding">
<form class="">
<div class="">
<input type="text" name="" value="" id="searchtx" class="form-control searchkeywordbox" placeholder="search keyword, description" />
</div>
</form>
</div>
</div>
</div>-->
<style>
#searchtx {
margin-left: 393px !important;
}
</style>
<div class="" style='padding:0px 10px;'>

<div class="row ">
<div class="gallery-img" id="update_gallery">
<?php
//$res = $p->globaltimelinesProfile($start, $_SESSION["pid"]);
$hp = new _hidepost;
$res = $hp->getPost($_SESSION['pid']);
//echo $hp->ta->sql;
//die("++++++++++++++++++");

//$res = $p->globaltimelinesFavourite($start, $_SESSION['pid']);

if ($res != false) {
while ($timeline = mysqli_fetch_assoc($res)) {
//echo "<pre>"; print_r($timeline); 
$_GET["timelineid"] = $timeline['spPostings_idspPostings'];
?>

<div style="font-weight:bold;">
<?php


$p2 = new _postingview;
if (isset($grouptimelines) && $grouptimelines == 1) {
$res2 = $p2->allgrouptimelines($_GET["timelineid"]);
} else {
$res2 = $p2->singletimelines($_GET["timelineid"]);
}
//echo $p2->ta->sql;

?>

<?php
//echo $p2->ta->sql;

if ($res2 != false)
while ($rows = mysqli_fetch_assoc($res2)) {
$postingDate = $p2->spPostingDate($rows["spPostingDate"]); ?>
<div class="post_timeline  searchable post_timeline_all_post">
<div class="row <?php (isset($_GET["grouptimeline"]) ? "" : ($rows["spPostingVisibility"] != -1 && !isset($_GET["groupid"]) ? "highlight" : "")); ?>">
<div class="col-md-6">
<div class="left_profile_timeline">
<?php
$picture = $rows["spProfilePic"];
$profilename = $rows["spProfileName"];

if (isset($picture)) {
echo "<img alt='profilepic'  class='img-circle' src=' " . ($picture) . "'>";
} else {
echo "<img alt='profilepic'  class='' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
}
?>
</div>
<div class="title_profile">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$rows['spProfiles_idspProfiles']; ?>"><h4><?php echo ucwords($profilename); ?></h4></a>
<h5><?php echo $postingDate; ?> <i class="fa fa-globe"></i></h5>
</div>
</div>
<div class="col-md-6">
<div class="dropdown pull-right right_profile_timeline">
<button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
<ul class="dropdown-menu">
<?php
$sp = new _savepost;
$result2 = $sp->savepost($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
if ($result2) {
if ($result2->num_rows > 0) { ?>
<li><a href="<?php echo $BaseUrl . '/post-ad/savePost.php?unsave=' . $rows['idspPostings']; ?>"><i class="fa fa-save"></i> Unsave Post</a></li> <?php
} else { 

$Sav_Post = $BaseUrl . '/post-ad/savePost.php?postid=' . $rows['idspPostings'];
?>
<li><a onclick='save_Post("<?php echo $Sav_Post ?>")'><i class="fa fa-save"></i> Save Post</a></li> <?php
}
} else { 
$Sav_Post = $BaseUrl . '/post-ad/savePost.php?postid=' . $rows['idspPostings'];    
?>
<li><a onclick='save_Post("<?php echo $Sav_Post ?>")'><i class="fa fa-save"></i> Save Post</a></li> <?php
}
?>

<!-- <li><a href="#"><i class="fa fa-pencil"></i> Edit Post</a></li> -->
<!-- <li><a href="#"><i class="fa fa-map-o"></i> Add Location</a></li> -->
<?php
//Delete timeline by poster//
$pr = new _spprofiles;
$pres = $pr->checkprofile($_SESSION['uid'], $rows['idspProfiles']);
if ($pres != false) {
$id1= $rows['idspPostings'];
$href = '../post-ad/deletePost.php?postid=' . $rows['idspPostings'] . '&flag=1';
echo "<li><a onclick=\"DelePost('$href')\"><i class='fa fa-trash'></i> Delete Post</a></li>";

//echo "<li><a href='#'><i class='fa fa-trash'></i> Delete Post</a></li>";
}
//hide post from timeline
$id1= $BaseUrl ."/post-ad/hidePost.php?unhide=" . $rows['idspPostings'] . "&flag=0" ;
?>
<li><a id='Unhid_Post' onclick='Unhid_Post("<?php echo $id1 ?>")' ><i class='fa fa-minus-square-o'></i> Unhide Post</a></li>



<!-- <li><a href="#"><i class="fa fa-bell-o"></i> Notification On</a></li> -->

</ul>

</div>
</div>
<div class="col-md-12 ">
<h2><?php echo $rows['spPostingNotes']; ?></h2>
<?php
$pic = new _postingpic;
$result = $pic->read($rows['idspPostings']);
//echo $pic->ta->sql;
if ($result != false) {
while ($rp = mysqli_fetch_assoc($result)) {
$pict = $rp['spPostingPic'];
}
} else {
$pict = NULL;
}
$media = new _postingalbum;
$result = $media->read($rows['idspPostings']);
if ($result != false) {
$r = mysqli_fetch_assoc($result);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];
if ($sppostingmediaExt == 'mp3') { ?>
<div style='margin-left:15px;margin-right:15px;'>
<audio controls>
<source src="<?php echo $BaseUrl . '/upload/' . $sppostingmediaTitle; ?>" type="audio/<?php echo $sppostingmediaExt; ?>">
Your browser does not support the audio element.
</audio>
</div>
<?php
} else if ($sppostingmediaExt == 'mp4') { ?>
<div style='margin-left:15px;margin-right:15px;'>
<video style='max-height:300px;width: 100%' controls>
<source src='<?php echo $BaseUrl . '/upload/' . $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
</video>
</div>
<?php
} else if ($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx') {
?>
<div class="row timelinefile">
<div class="col-md-offset-1 col-md-1 no-padding">
<img src="<?php echo $BaseUrl . '/assets/images/pdf.png' ?>" alt="pdf" class="img-responsive" />
</div>
<div class="col-md-10">
<h3><?php echo $sppostingmediaTitle; ?></h3>
<small><?php echo $sppostingmediaExt; ?></small>
<a href="<?php echo $BaseUrl . '/upload/' . $sppostingmediaTitle; ?>" target="_blank">Download</a>
</div>
</div>
<?php
}
} else {
if (isset($pict)) {
echo "<div class='timlinepicture text-center'>";
echo "<img alt='Posting Pic' src='" . ($pict) . "' class='postpic img-thumbnail img-responsive'>";
include("postingpic.php");
echo "</div>";
}
/* else
echo "<img alt='Posting Pic' src='../img/no.png' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>" ; */
} ?>

</div>

<div class="col-md-12">
<div class="space"></div>
</div>


</div>
</div>
<?php
} ?>
</div>

<?php
}
}

?>


</div>
</div>
<!-- image gallery end -->
<!-- window.location.href = '/services/delete.php?action=delete&postid=' + userId;
" . $BaseUrl . "/post-ad/hidePost.php?unhide=" . $rows['idspPostings'] . "&flag=0 -->
</div>

<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script> 
<script>

function Unhid_Post(userId) {
// alert(userId);
Swal.fire({
title: 'Are You Sure You Want to Unhide Post ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Unhide!'
}).then((result) => {
if (result.isConfirmed) {
swal("Unhide Successfully !", "", "success");
window.location.href = userId;
}
});
}


function save_Post(userId) {
// alert(userId);
Swal.fire({
title: 'Are You Sure You Want to Save Post ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Save!'
}).then((result) => {
if (result.isConfirmed) {
swal("Save Successfully !", "", "success");
window.location.href = userId;
}
});
}

function DelePost(userId) {
// alert(userId);
Swal.fire({
title: 'Are You Sure You Want to Delete Post ?',
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: 'Yes, Delete!'
}).then((result) => {
if (result.isConfirmed) {
swal("Save Successfully !", "", "success");
window.location.href = userId;
}
});
}
</script>



