<?php

include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="videos/";
include_once ("../../authentication/islogin.php");

}else{

$_GET["module"] = "10";
$_GET["categoryid"]="10";
$_GET["profiletype"]="3";
$_GET["categoryname"]="Videos";

function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$header_video = "header_video";


?>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="The SharePage">
<meta name="author" content="Adnan Ghouri(skype:adnanghouri3)">
<title>The SharePage.</title>
<link rel="icon" href="<?php echo $BaseUrl.'/assets/images/logo/logo-black.png'?>" sizes="16x16" type="image/png">
<!--Bootstrap core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<!--Font awesome core css-->
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
<!--custom css jis ki wja say issue ho rha tha form submit main-->
<!-- <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/calendar/mootools.js"></script> -->
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

<script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/videos.js"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
<!--post group button on btm of the form-->
<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
<!--NOTIFICATION-->
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>

<!--CSS FOR MULTISELECTOR-->
<link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>

<script type="text/javascript">
//USER ONE
$(function () {
$('#leftmenu').multiselect({
includeSelectAllOption: true
});

});
$(function () {
$('#rightmenu').multiselect({
includeSelectAllOption: true
});
});
$(function () {
$('#cohost').multiselect({
includeSelectAllOption: true
});
});
</script>
<link href="<?php echo $BaseUrl;?>/assets/css/editor.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo $BaseUrl;?>/assets/js/editor.js"></script>
<script>

$(document).ready(function() {
$("#lyrics_").Editor();
});
</script>
<script>
function numericFilter(txb) {
txb.value = txb.value.replace(/[^\0-9]/ig, "");
}
</script>
<?php 
$urlCustomCss = $BaseUrl.'/component/custom.css.php';
include $urlCustomCss;
?>
</head>
<body onload="pageOnload('post')" >
<?php 

include_once("../../header.php");

$p = new _spprofiles;
$rp = $p->readProfiles($_SESSION['uid']);
$res = $p->readprofilepic($_GET["profiletype"],$_SESSION['uid']);
if ($res != false){
$r = mysqli_fetch_assoc($res);
$name = $r['spProfileName'];
$icon = $r['spprofiletypeicon'];
}else{
$name = "Select Profile";
$icon = "<i class='fa fa-user'></i>";
}

?>
<div class="loadbox" >
<div class="loader"></div>
</div>
<!--Album creation modal-->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<form action="../../album/createalbum.php" method="post" id="sp-create-album" class="sharestorepos no-margin">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="exampleModalLabel"><b>Create New Album</b></h4>
</div>
<div class="modal-body">

<input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid']; ?>">

<input type="hidden" name="sppostingalbumFlag" value="<?php echo $_GET["module"]; ?>">

<div class="form-group">
<label for="spAlbumName" class="control-label contact">Album Name</label>
<input type="text" class="form-control" id="spAlbumName" name="spPostingAlbumName">
</div>

<div class="form-group">
<label for="spAlbumDescription" class="contact">Description</label>
<textarea class="form-control" id="spAlbumDescription" name="spPostingAlbumDescription"></textarea>
</div>                                
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button id="spaddalbum" type="submit" class="btn btn-primary">Add</button>
</div>
</form>
</div>
</div>
</div><!--Done-->
<section>
<div class="container-fluid">
<div class="row">
<div class="col-md-3 no-padding">
<div class="left_video" id="leftArtFrm">
<img src="<?php echo $BaseUrl;?>/assets/images/videos/left-video.jpg" class="img-responsive" alt="" />
</div>
</div>
<div class="col-md-9">

<div class="row">
<div class="col-md-12">
<form enctype="multipart/form-data" action="<?php echo $BaseUrl?>/post-ad/dopost.php" method="post" id="sp-form-post" name="postform">
<div class="modTitle" style="padding-left: 15px;">
<h2>Module Name: <span>Videos</span></h2>
</div>
<div class="video_form ">

<h3>
<i class="fa fa-pencil"></i> Upload And Share
<a href="<?php echo $BaseUrl.'/videos';?>" class="pull-right">Back to Home</a>                                        
</h3>

<div class="add_form_body">

<div class="">
<div class="">
<div class="row no-margin">
<div class="col-md-4 no-padding">
<!-- if music file is upload then show in this box -->
<?php
$pm = new _postingmusicmedia;
if(isset($_GET['post']) && $_GET['post'] > 0 ){
$musicId = $_GET['post'];    
$result1 = $pm->readMusic($musicId);
//echo $pm->ta->sql;
if($result1 != false){
$row1 = mysqli_fetch_assoc($result1);
?>
<video style="width: 80%" controls>
<source src="<?php echo $BaseUrl.'/upload/videos/'.$row1['musicmediaTitle'];?>" type="video/mp4">

Your browser does not support the video tag.
</video>

<?php
}
}else{
$musicId = $_GET['postid'];    
$result1 = $pm->readPostMusic($musicId);
//echo $pm->ta->sql;
if($result1 != false){
$row1 = mysqli_fetch_assoc($result1);
?>
<video style="width: 80%" height="240" controls>
<source src="<?php echo $BaseUrl.'/upload/videos/'.$row1['musicmediaTitle'];?>" type="video/mp4">

Your browser does not support the video tag.
</video> <?php
}
}
?>

</div>
<div class="col-md-4 no-padding">
<p><?php echo isset($row1['musicmediaOrgName'])?$row1['musicmediaOrgName']:'';?></p>
</div>
<div class="col-md-4 no-padding">
<div class="dropdown pull-right">
<div class="btn-group top_profile_box" role="group" aria-label="Basic example">
<button type="button" class="btn btn-success" style="cursor:default;">Select Profile</button>
<button class="btn butn_profile dropdown-toggle" type="button" id="profiles" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="<?php echo $icon; ?>"></span> <?php echo $name; ?><span class="caret"></span></button>

<ul class="dropdown-menu" id="profilesdd" aria-labelledby="profiles">
<?php
$profile = new _spprofiles;
$res = $profile->categoryprofiles($_GET["categoryid"], $_SESSION['uid']);
//echo $profile->ta->sql;
if ($res != false) {

while ($row = mysqli_fetch_assoc($res)) {
if($row['spProfileType_idspProfileType'] == 2){
// freelance or job board profile not show
}else{
//echo "<li><a href='#' class='profiledd' data-pid='".$row['idspProfiles']."' data-profileicon='".$row["spprofiletypeicon"]."'><span class='".$row["spprofiletypeicon"]."'></span> " .$row["spProfileName"]."</a></li>";
echo "<li><a href='#' class='profiledd' data-pid='" . $row['idspProfiles'] . "' data-profileicon='" . $row["spprofiletypeicon"] . "'><img  alt='Profile Pic' class='img-rounded' style='width:40px; height:40px;' src=' " . ($row["spProfilePic"]) . "' >&nbsp;&nbsp;<span class='" . $row["spprofiletypeicon"] . "'></span> " . $row["spProfileName"] . "</a></li><hr>";


$profilename = $row["spProfileName"];
$profilesid = $row["idspProfiles"];
$profilepicture = $row["spProfilePic"];
$country = $row["spProfilesCountry"];
$city = $row["spProfilesCity"];
$icon = $row["spprofiletypeicon"];   
}

}
} else {
echo "<li role='separator' class='divider'></li>
<li id='myprofile'><a href='/my-profile/' id='sp-profile-register'>Add New Profile</a></li>";
}
?>
</ul>
</div>
</div>
</div>
</div>
<!-- <div >
<div class="row no-margin">
<div class="col-md-12 no-padding">
<h4>Your Contact Information</h4>
<p>This information will not be shared on the website. We will only use this to contact you if we have questions about your submission.</p>
</div>
</div>
</div> -->


<div >
<?php
$profileid = "";
$eCountry = "";
$eCity = "";
$eCityID = "";
$eCategory = "";
$eSubCategoryID = "";
$eSubCategory = "";
$ePostTitle = "";
$ePostNotes = "";
$eExDt = "";
$ePrice = "";
$shipping = "";
$visiblty = "";

if (isset($_GET["postid"])) {
$p = new _postingview;
$r = $p->read($_GET["postid"]);
//echo $p->ta->sql;
if ($r != false) {
while ($row = mysqli_fetch_assoc($r)) {
echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
$ePostTitle = $row["spPostingtitle"];
$ePostNotes = $row["spPostingNotes"];
$eExDt = $row["spPostingExpDt"];
$ePrice = $row["spPostingPrice"];
$profileid = $row['idspProfiles'];
$postingflag = $row['spPostingsFlag'];
$phone = $row['spProfilePhone'];
$shipping = $row['sppostingShippingCharge'];
$eCountry = $row['spPostingsCountry'];
$eCity = $row['spPostingsCity'];
$visiblty = $row['spPostingVisibility'];


$pf  = new _postfield;
$result_pf = $pf->read($_GET['postid']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$lyricup = "";
$category = "";
$musicLyric = "";
$newReleas = "";
$musiDirct = "";
$artistName = "";
$musiComp = "";
$musicLang = "";
$discount     = "";
$postAs    = "";
$tag = "";
$album = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($lyricup == ''){
if($row2['spPostFieldName'] == 'lyrics_'){
$lyricup = $row2['spPostFieldValue'];
}
}
if($category == ''){
if($row2['spPostFieldName'] == 'musiccategory_'){
$category = $row2['spPostFieldValue'];
}
}
if($musicLyric == ''){
if($row2['spPostFieldName'] == 'spPostMusicLyrics_'){
$musicLyric = $row2['spPostFieldValue'];
}
}
if($newReleas == ''){
if($row2['spPostFieldName'] == 'spPostNewRelease_'){
$newReleas = $row2['spPostFieldValue'];
}
}
if($musiDirct == ''){
if($row2['spPostFieldName'] == 'spPostMusicDirector_'){
$musiDirct = $row2['spPostFieldValue'];
}
}
if($artistName == ''){
if($row2['spPostFieldName'] == 'spPostArtistName_'){
$artistName = $row2['spPostFieldValue'];
}
}
if($musiComp == ''){
if($row2['spPostFieldName'] == 'spPostingMusicCmpId_'){
$musiComp = $row2['spPostFieldValue'];
}
}
if($musicLang == ''){
if($row2['spPostFieldName'] == 'spPostLanguage_'){
$musicLang = $row2['spPostFieldValue'];
}
}
if($tag == ''){
if($row2['spPostFieldName'] == 'tag_'){
$tag = $row2['spPostFieldValue'];
}
}
if($album == ''){
if($row2['spPostFieldName'] == 'musicalbum_'){
$album = $row2['spPostFieldValue'];
}
}

}
}
}
}
}
$p = new _spprofiles;
$res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
//echo $p->ta->sql;
if ($res != false) {
$r = mysqli_fetch_assoc($res);
$profileid = $r['idspProfiles'];
$country = $r["spProfilesCountry"];
$city = $r["spProfilesCity"];
}
?>

<div class="row">
<div class="col-md-12 m_top_10">

<input type="hidden" id="postid" value="<?php if (isset($_GET['postif'])) { echo $_GET["postid"]; } ?>">
<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">
<input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">
<!--<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">-->

<input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">
<input type="hidden" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) && $eCountry != '') ? $eCountry : $country; ?>">
<input type="hidden" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) && $eCity != '')? $eCity : $city; ?>">
<?php
$p = new _album;
$pid = $_SESSION['pid'];
$albumid = $p->timelinealbum($pid);
?>
<input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">
<?php
if (isset($_GET["postid"])) {
echo "<input id='idspPostings' name='idspPostings' value=" . $_GET["postid"] . " type='hidden' >";
}
?>
<!--Art Gallery-->
<!--Art Gallery complete-->
<div class="row no-margin">
<div class="col-md-12 no-padding">
<div class="form-group">
<label for="spPostingTitle" class="lbl_1">Title <span>*</span></label>
<input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle"  value="<?php echo $ePostTitle ?>" placeholder="" required />
</div>
<div class="row">

<!-- <div class="col-md-6">
<div class="form-group">
<label for="spPostListing_">Listing</label>
<select class="form-control spPostField" data-filter="1" id="spPostListing_" name="spPostListing_" value="">
<option value="Sell">Sell</option>
<option value="Rent">Rent</option>
</select>
</div>
</div> -->
</div>
<div class="">
<?php
if ($eExDt) {
$todayDate = date("Y-m-d");
$dateExp = date('Y-m-d', strtotime($eExDt));
if($todayDate > $dateExp){
$expDate = date('Y-m-d', strtotime("+30 days"));
}else{
$expDate = $dateExp;
}
//echo date('Y-m-d', strtotime($eExDt));
} else {
$expDate = date('Y-m-d', strtotime("+30 days"));
}
?>
<input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt"  value="<?php echo $expDate; ?>">
</div>
<div class="" id="cusFieldVdo">
<!--add custom fields-->
<?php
if(isset($_GET["postid"])){
$f = new _postfield;
$res = $f->field($_GET["postid"]);
if ($res != false){
while ($result = mysqli_fetch_assoc($res)) {
$row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
//$idspPostField = $result["idspPostField"];
}
}
}

include("../videos.php");

?>
<!--Getcustomfield-->
</div>


<div class="form-group">
<label for="spPostingNotes">Description</label>
<textarea class="form-control" id="spPostingNotes" name="spPostingNotes" equired><?php echo $ePostNotes ?> </textarea>
</div>


</div>
</div>
<!--Testing-->
<div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
<div class="col-md-3">
<div class="form-group">

<label for="postingpic">Upload Cover Images</label>
<input type="file" class="postingpic" name="spPostingPic[]" multiple="multiple">

<p class="help-block"><small>Browse files from your device</small></p>
</div>
</div>
<div class="col-md-9">
<div class="form-group">
<label for="postingPicPreview">Picture Preview</label>
<div id="imagePreview"></div>
<div id="postingPicPreview">
<div class="row">
<div id="dvPreview" >
<?php
$i = 1;
$pic = new _postingpic;
if(isset($_GET['postid'])){
$res = $pic->read($_GET["postid"]);
if ($res != false) {
while ($rows = mysqli_fetch_assoc($res)) {
$picture = $rows['spPostingPic'];
if($rows['spFeatureimg'] == 1){
$select = "checked";
}else{
$select = '';
}
//echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'></span><img class='postingimg overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' />Feature Image</label></div>";
echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "' ></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='".$_GET['postid']."' data-picid='".$rows['idspPostingPic']."'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' ".$select." />Feature Image</label></div>";
//echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "'></span><img class='postingimg overlayImage' style='width:100%; height: 80px;' data-name='fi_".$i."' src=' " . ($picture) . "' ><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' ".$select." value='0' />Feature Image</label></div>";
$i++;
}
}
}

?>
</div>
</div>
</div>
<input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0)?$i:'1'?>" >
</div>
</div>
</div>
<!-- <div class="row ">
<div class="col-md-3">
<div class="form-group">
<label for="postingvideo">Add video </label>
<input type="file" id="addvideo" class="spmedia" name="spPostingMedia" accept="video/*">
<p class="help-block"><small>Browse files from your device</small></p>
</div>
</div>
<div id="media-container"></div>                                                
</div> -->
<div class="row">
<div class="col-md-12">
<label><input type="checkbox" name="" value="" checked=""> Copyrights</label>
</div>
</div>
<!--complete-->
</div>
</div>

</div>
</div>


</div>
</div>

</div>
<div class="row no-margin">

<div class="col-md-1 hidden">


<!-- <div class="btn-group">
<!--<button id="spPostSubmit" type="submit" class="btn btn-success">Public Post</button>-->
<!-- <button id="postingtype" type="button" class="btn btn-success <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public</button>

<button type="button" class="btn  btn-success dropdown-toggle <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false" style="height: 34px;"><span class="caret"></span></button>
<ul class="dropdown-menu posttype">
<li><a id="postpublic" style="cursor:pointer;">Public</a></li>
<li><a id="postgroup" style="cursor:pointer;">Group</a></li>
</ul> -->
<!-- </div> -->
</div>
<div class="col-md-4">
<div id="sp-group-container" class="input-group hidden">
<input class="form-control" id='group_' name="group_" type="text"  placeholder="Type to Select Group..." >

<span class="input-group-btn">
<!--<button class="btn btn-default" type="button" data-toggle="modal" data-target="#addGroup">Add New</button>-->
<a href="../../my-groups/" class="btn btn-default" type="button">Add New</a>
</span> 
</div>
</div>
<div class="col-md-8 text-right">

<!-- this is preview button -->
<!-- <button type="submit" id="preview" class="btn butn_preview">Preview</button> -->
<!-- <button id="spPostSubmit" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Repost" : "Submit") ?></button> -->
<!-- <button id="spPostSubmitStore" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Publish" : "Submit") ?></button> -->
<button id="spPostVideo" type="button" class="btn butn_save <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Publish" : "Upload Video") ?></button>
<!-- <button id="spSaveDraft" type="submit" class="btn butn_draf <?php echo (isset($_GET['postid']))?'hidden':'';?>">Save Draft</button> -->
<a href="<?php echo $BaseUrl.'/videos';?>" class="btn butn_cancel" >Cancel</a>
<!-- <button type="reset" class="btn butn_cancel">Cancel Post</button> -->
</div>
</div>
</form>
</div>



</div>
</div>
</div>
</section>
<?php include('../../f_component/footer.php');?>
<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
<?php include('../../f_component/btm_script.php'); ?>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>


<!--  <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/calendar/calendar.js"></script>
<script type="text/javascript">     
//<![CDATA[
window.addEvent('domready', function() { 
myCal1 = new Calendar({ txtNewsDate: 'd-m-Y' }, { classes: ['alternate'], navigation: 2 } , { direction: 0, tweak: { x: 6, y: 0 }});
});
window.onload = function()
{
// Automatically calculates the editor base path based on the _samples directory.
// This is usefull only for these samples. A real application should use something like this:
// oFCKeditor.BasePath = '/fckeditor/' ;    // '/fckeditor/' is the default value.
var sBasePath = '<?php echo $BaseUrl; ?>/assets/fckeditor/' ;
var oFCKeditor = new FCKeditor('lyrics_') ;
oFCKeditor.BasePath = sBasePath ;
oFCKeditor.ReplaceTextarea() ;

}
</script> -->
</body>
</html>
<?php
}
?>