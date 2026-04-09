<?php
include('../univ/baseurl.php');
function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _postingview;
$postid = $_POST['postid'];
$result = $p->singletimelines($postid);
//echo $p->ta->sql;
//update text of every post
if ($result) {
$row = mysqli_fetch_assoc($result);
$spPostingNotes = $row['spPostingNotes'];
}

?>

<script type="text/javascript">
//remove dynamic photo
function loadDocdelete(id) {
//	alert('ooooooooo');
const xhttp = new XMLHttpRequest();
xhttp.onload = function() {
document.getElementById("demo").innerHTML =
this.responseText;
}
xhttp.open("GET", "../post-ad/aaddpostingnewtime.php?id=" + id);
xhttp.send();
}

$("#postingPicPreviewedit").on("click", ".dynamicimgedit", function() {
$(this).closest(".imagepost").remove();
});

//add new photo
$(".postingpic").change(function() {

//  alert($("#dvPreview img").length);

if (typeof(FileReader) != "undefined") {
var dvPreview = $("#dvPreview1");
//dvPreview.html("");
var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
$($(this)[0].files).each(function() {
var file = $(this);
//alert(file[0].size);
if (file[0].size <= 5242880) {
if (regex.test(file[0].name.toLowerCase())) {

var reader = new FileReader();
reader.onload = function(e) {
var img = $("<div class='col-md-2 imagepost 111'><span class='fa fa-remove dynamicimgedit closed'></span><img class='postingimg  overlayImage new_image' style='width:100%; margin-right:5px;' src='" + e.target.result + "'/></div>");
dvPreview.append(img);
document.getElementById("dvPreview1").classList.remove('hidden');
}
reader.readAsDataURL(file[0]);
} else {
alert(file[0].name + " is not a valid image file.");
//dvPreview.html("");
return false;
}
} else {
swal(file[0].name + " is too large. Please upload image less then 5Mb.");
return false;
}
});
} else {
alert("This browser does not support HTML5 FileReader.");
}
});
</script>


<input type="hidden" name="idspPostings" id="idspPostings" value="<?php echo $postid; ?>">
<textarea type="text" id="edit_text" class="grptimeline form-control" required placeholder="" name="spPostingNotes" rows="3"><?php echo $spPostingNotes; ?></textarea>

<div class="row">
<div id="postingPicPreviewedit">
<div id="dvPreview1" class="timelineimg">
<?php
//update pics
$pic = new _postingpic;
$result2 = $pic->read_timeline($postid); 
//echo $pic->ta->sql;
if ($result2 != false) {
while ($rp = mysqli_fetch_assoc($result2)) {

// print_r($rp);
$ididspPostingPic = $rp['idspPostingPic'];
$pict = $rp['spPostingPic'];
?>
<div class='col-md-2 imagepost 33'>
<span class='fa fa-remove dynamicimgedit closed' onclick="loadDocdelete(<?php echo $ididspPostingPic; ?>)"></span>
<?php
echo "<img class='postingimg overlayImage fdgfdhgfhfg' style='width:100%; height: 50px; margin-right:5px;' alt='Posting Pic' src='" . ($pict) . "' >"; ?>
</div>
<?php
}
}
?>
</div>
<?php
if (isset($pict)) { ?>
<div class="col-md-2">
<div class="topstatus modelAddPhoto">
<div class="createbox">
<!-- accept="image/*" -->
<span><label class="btn-bs-file"><i class="fa fa-plus"></i><input type="file" class="postingpic " id="postingpic1" name="spPostingPic[]" multiple="multiple"></label></span>
</div>
</div>
</div> <?php
}
?>

<?php
//update video

$media = new _postingalbum;
$result3 = $media->read($postid);


if ($result3 != false) {
$r = mysqli_fetch_assoc($result3);
//print_r($r);
$picture = $r['spPostingMedia'];
$sppostingmediaTitle = $r['sppostingmediaTitle'];
$sppostingmediaExt = $r['sppostingmediaExt'];


if ($sppostingmediaExt == 'mp3') { ?>
<div style='margin-left:15px;margin-right:15px;'>
<audio controls>
<source src="<?php echo $sppostingmediaTitle; ?>" type="audio/<?php echo $sppostingmediaExt; ?>">
Your browser does not support the audio element.
</audio>
</div>


<div class="col-md-4">

<label class="btn-bs-file custom-file-upload db_btn db_lightbluebtn"><input type="file" id="addvideo_1" class="spmedia foo" name="spPostingMedia" accept=".mp3,.mpa,.wav,.wma,.midi,.mid"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Change Audio</label>

</div>
<?php
} else if ($sppostingmediaExt == 'mp4' || $sppostingmediaExt == 'webm') { ?>
<div class="col-md-4">
<!--  <div style='margin-left:15px;margin-right:15px;'> -->
<video style='max-height:100px;width: 100%;border-radius: 17px;' controls>
<source src='<?php echo $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
</video>


<!-- </div> -->
</div>

<div class="col-md-5">

<label class="btn-bs-file custom-file-upload db_btn db_lightbluebtn"><input type="file" id="addvideo_1" class="spmedia foo" name="spPostingMedia" accept="video/*"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Change Video</label>

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
<a href="<?php echo $sppostingmediaTitle; ?>" target="_blank" class="db_btn db_primarybtn"><i class="fa fa-download" aria-hidden="true"></i>&nbsp; Download</a>
</div>
</div>
<br>
<div class="col-md-5">
<label class="btn-bs-file custom-file-upload db_btn db_orangebtn"><input type="file" id="addDocument_1" class="spDocument foo" name="spPostingDocument" accept=".pdf,.doc,.xls,.docx "><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Change Document</label>
</div>
<?php
}

?>


<input type="hidden" name="idspPostingMedia" id="" value="<?php echo $r['idspPostingMedia']; ?>">


<?php
}
/* $pic = new _postingpic;
$result2 = $pic->read($postid);*/
//echo $pic->ta->sql;
/*  if ($result2 != false) {
while ($rp = mysqli_fetch_assoc($result2)) {
$pict = $rp['spPostingPic'];
?>
<div class='col-md-2 imagepost'>
<span class='fa fa-remove dynamicimgedit closed'></span>
<?php
echo "<img class='postingimg overlayImage' style='width:100%; height: 50px; margin-right:5px;' alt='Posting Pic' src='" . ($pict) . "' >"; ?>
</div>
<?php
}
}*/
?>
</div>
<!--   <?php
if ($sppostingmediaExt == 'mp3') { ?>

<?php
}
?>


<?php
if (isset($pict)) { ?>
<div class="col-md-2">
<div class="topstatus modelAddPhoto">
<div class="createbox">
<span><label class="btn-bs-file"><i class="fa fa-plus"></i><input type="file" class="postingpic" name="spPostingPic[]" accept="image/*" multiple="multiple"></label></span>
</div>
</div>
</div> <?php
}
?>

<?php
if (isset($pict)) { ?>
<div class="col-md-2">
<div class="topstatus modelAddPhoto">
<div class="createbox">
<span><label class="btn-bs-file"><i class="fa fa-plus"></i><input type="file" class="postingpic" name="spPostingPic[]" accept="image/*" multiple="multiple"></label></span>
</div>
</div>
</div> <?php
}
?> -->

</div>
</div>