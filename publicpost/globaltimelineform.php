<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
include( "../univ/main.php");
$con = mysqli_connect(DOMAIN, UNAME, PASS);

if(!$con) {
echo 'Not connected to server';
}
//Connection to database
if(!mysqli_select_db($con, DBNAME)) {
echo 'Database Not Selected';
}
?>
<style>
#spFavouritePost{
margin-right: 20px !important;
}
.thumbnail mag{
margin-right: 6px !important;
}
</style>


<!-------------hover code --------->

<style>
* {
box-sizing: border-box;
}

.emoji-picker{
font-size: 25px!important;
margin-bottom: 3px!important;
}
.zoom {
// padding: 50px;
// background-color: green;
transition: transform .2s;
font-size:5px;
//width: 19px;
//height: 19px;
//margin: 0 auto;
}

.zoom:hover {
-ms-transform: scale(1.1); / IE 9 /
-webkit-transform: scale(1.1); / Safari 3-8 /
transform: scale(1.1); 
}

element.style {
margin-left: 60px;
/* color: white; */
/* padding-bottom: 0px; */
}
.zoom {
// padding: 50px;
// background-color: green;
transition: transform .2s;
font-size: 5px;
//width: 19px;
//height: 19px;
//margin: 0 auto;
}
.db_btn {

padding: 6px 20px 6px 20px!important;
}
</style>	


<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
<form method="post" action="../post-ad/dopost.php"  id="sp-form-post" enctype="multipart/form-data" >
<input type="hidden" id="catname" value="">
<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">
<input type="hidden" class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION["pid"]; ?>">

<input type="hidden" name="spPostingDate" id="spPostingDate" value="<?php echo date("Y-m-d H:i:s");?>">

<div class="row">
<!-- <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value=""> -->

<div class="col-md-12">
<div class="topstatus timeline-topstatus">
<div class="createbox1">
<span><label><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/create_post_icon_enable.png" alt="" class="img-responsive" >Create a post </label></span>
</div>
</div>
</div>
<?php
$albumObj = new _album;
// following commented line not works in some cases.
//$resultOfAlbum = $albumObj->readalbum($_SESSION["pid"]);

$pid = $_SESSION["pid"];
$query = "SELECT * FROM sppostingalbum as t
INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles
WHERE t.spProfiles_idspProfiles = ".$pid;

$resultOfAlbum = mysqli_query($con,$query);

if ($resultOfAlbum->num_rows > 0) {
while ($row = mysqli_fetch_array($resultOfAlbum)) {
if ($row['spPostingAlbumName'] == "Timeline") {
$albumid = $row["idspPostingAlbum"];
}
}
if (!isset($albumid)) {
$albumid = $albumObj->timelinealbum($pid);
}
}else {
$albumid = $albumObj->timelinealbum($pid);
}
?>
<input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">
<div class="col-md-12">
    <div class="textarea-time-line" style="background-color: white;    padding-left: 10px;    padding-right: 10px;"> 
<div class="statusimage commentprofile3">
<?php
$p = new _spprofiles;
$result = $p->read($_SESSION['pid']);
if ($result != false) {
$row = mysqli_fetch_assoc($result);
if (isset($row["spProfilePic"])){
echo "<img alt='profilepic'style='margin-top: -5px;' class='img-circle img_posting_absolut' src='".$row["spProfilePic"]. "'  >";
}else{
echo "<img alt='profilepic' class='img-circle img_posting_absolut'  src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 34px; height: 35px;' >";
}
}
?>
<img id="loading_indicator" src="<?php echo $BaseUrl;?>/assets/images/loader/ajax-loader.gif" style="width: 16px;height: 11px;left: 94%;top: 3px;right: 0px;" >
<textarea type="text"   class="grptimeline form-control post_box" id="grptimelinefrmtxt" data-emojiable="true" required placeholder="Share your views here"  name="spPostingNotes" rows="3" spellcheck="false" ></textarea>
</div>
</div>
<div class="post_btn_footer post_footer_timeline">
<label class="tel_feel"></label>   

<label class="btn-bs-file custom-file-upload db_btn db_orangebtn zoom"><input type="file" class="postingpic foo" onchange="validatephotoSize()"  id="addphoto" name="spPostingPic[]" accept="image/*" multiple="multiple"> <i class="fa-regular fa-image"></i></i>&nbsp; <span class="fa_icn_cnt">Photo</span> </label>

<label class="btn-bs-file custom-file-upload db_btn db_orangebtn zoom"><input type="file" id="addvideo" onchange="validateMediaSize()" class="spmedia foo"  name="spPostingMedia"  accept="video/*,.mp3,.mpa,.wav,.wma,.midi,.mid" ><i class="fa-solid fa-video"></i>&nbsp; <span class="fa_icn_cnt"> Audio / Video </span></label>

<label class="btn-bs-file custom-file-upload db_btn db_orangebtn zoom"><input type="file" id="addDocument"  onchange="validateDocumentSize()" class='spDocument foo' name="spPostingDocument" accept=".pdf,.doc,.xls,.docx " /><i class="fa-regular fa-folder-open"></i>&nbsp; <span class="fa_icn_cnt"> Document </span></label>

<?php if($_SESSION['guet_yes'] != 'yes'){ ?>

<button id="spPostSubmitTimeline" type="button" class=" btnPosting db_btn db_primarybtn zoom" data-visibility="-1" style="color:white;" data-loading-text="Posting...">Post </button>

<?php } ?>



<!-- <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" id="mygroup" ><span class="caret"></span></button>   <input type="checkbox" id="chkAcknw" value="1" checked=""> Is It my Attachment ?</label>-->
<ul class="dropdown-menu timelinedrop" id="allmygroup">
<li><label>Share with group</label></li>
<?php include("allmygroup.php"); ?>
</ul>
</div>
</div>
</div>
<div class="col-md-12 hidden" id="showchekbox">
<div class="post_timeline acknowled" style="padding: 5px;">
<label class="checkbox-inline">
<!-- <label class="checkbox-inline"> Is It my Attachment ?</label> -->
<!-- <input type="radio" id="chkAcknw1" name="attachment" value="1"> 
                   <label for="html">Yes</label>
                   <input type="radio" id="chkAcknw2" name="attachment" value="0">
                    <label for="css">No</label> -->


<label class="checkbox-inline"><input type="checkbox" id="chkAgree" value="1" checked="">I agree to the <a href="<?php echo $BaseUrl;?>/page/?page=copyrights" target="_blank" class="anchor_default">copyright  </a>violation information</label>
</div>
</div> 
<div id="postingPicPreview"> 
<div id="dvPreview" class="hidden timelineimg"></div>
</div>
<div id="media-container"></div>
</div>
</form>
<div class="timelineload loader_back" >
<div class="loader timeline_loader"></div>
</div>
<div class="row no-margin">
<div class="col-md-12 no-padding">
<div id="mediaTitle" class=""></div>

<div id="mediaTitlevideo" class="">
<!-- <button onclick="remove()" id="g2" class="fa fa-remove bg-black" style="margin-left:350px; margin-top:60px;color: red; display:none;" title="Remove File"></button>  -->
<div class="row">
<div class="col-sm-4">
<b id="s1" style="display:none;">File Preview :</b>
</div>
<div class="col-sm-8" style="float:none;position: relative;">
<button onclick="remove()" id="g2" class="fa fa-remove bg-black" style=" color:red; display:none;position: absolute;left: 306px;"  title="Remove File"></button> 
</div>


</div>


<video width="320" height="240" style="display:none;" controls id="makemepreview"></video>
</div>

<div id="groupTitle" class=""></div>
</div>
<div class="col-md-12 no-padding">
<div id="progressBox" style="" class="">
<progress id="progressBar" value="0" max="100" style="width:100%"></progress>
<span id="status">100% Loading</span>
</div>
</div>
</div>
<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<!-- <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script> -->
<script>
function validateMediaSize() {


const input = document.getElementById('addvideo');
if (input.files && input.files[0]) {
if (input.files[0].type.indexOf('video/') === 0) {

const maxAllowedSize = 50 * 1024 * 1024;

if (input.files[0].size > 52428800) {

swal('Video file is too big. Please select a file smaller than 50MB.');
input.value = '';
}
} else if (input.files[0].type.indexOf('audio/') === 0) {
const maxAllowedSize = 50 * 1024 * 1024;
if (input.files[0].size > 52428800) { 
swal('Audio file is too big. Please select a file smaller than 50MB.');
input.value = '';
}
}
}
}

</script>


<script>
function validatephotoSize() {


const fileList = document.getElementById('addphoto');

if (fileList.files.length > 0) {

for (const i = 0; i <= fileList.files.length - 1; i++) {

const maxAllowedSize = 5 * 1024 * 1024;
const fsize = fileList.files.item(i).size;


const file = Math.round((fsize / 1024));

// The size of the file.
if (fsize > maxAllowedSize) {
swal('Image size is too big, Please select a file that is less than  5MB.');
fileList.value = '';
} 
}
}
}

</script>
<script>
function validateDocumentSize() {

const input = document.getElementById('addDocument');
if (input.files && input.files[0]) {
const maxAllowedSize = 5 * 1024 * 1024;
if (input.files[0].size > maxAllowedSize) {
swal('Document size is too big, Please select a file that is less than  5MB.');
input.value = '';
}
}
}
</script>

<script>

document.getElementById("addvideo")
.onchange = function(event) {

let file = event.target.files[0];
if(event.target.files[0].size <= 52428800){
if (event.target.files[0].type.indexOf('video')) {
document.getElementById("makemepreview").style.height = "50px";

} else {
document.getElementById("makemepreview").style.height = "240px";

}


let blobURL = URL.createObjectURL(file);


document.getElementById("makemepreview").src = blobURL;
document.getElementById("makemepreview").style.display = "block";
document.getElementById("g2").style.display = "block";
document.getElementById("s1").style.display = "block";


}

}


document.addEventListener("DOMContentLoaded", function(event) {
document.getElementById("makemepreview").style.display = "none";


});

</script>

<script>
function remove() {

// var name = document.getElementById('addvideo').value("");
$("#addvideo").val("");
document.getElementById("makemepreview").style.display = "none";
document.getElementById("g2").style.display = "none";
document.getElementById("mediaTitle").innerText = "";
document.getElementById("s1").style.display = "none";




}
</script>
