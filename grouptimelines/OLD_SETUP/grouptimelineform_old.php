<?php
// error_reporting(E_ALL);
// 	ini_set('display_errors', '1');
$p = new _spprofiles;
$profileid = $_SESSION['pid'];
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$result = $p->readMember(isset($_SESSION['uid']), isset($_SESSION['gid']));
//echo $p->ta->sql;
if ($result != false) {
$row = mysqli_fetch_assoc($result);
$profileid = $row["idspProfiles"];
$profilename = $row["spProfileName"];
}

$p = new _spgroup;

?>
<form enctype="multipart/form-data" action="../post-ad/dopost.php" method="post" id="sp-form-post">
<!------
<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
---->
<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
<input type="hidden" id="catname" value="">
<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="<?php echo $group_id ?>">
<input id="groupid" name="groupid" type="hidden" value="<?php echo $group_id ?>">
<input name="spProfiles_idspProfiles" id="spProfiles_idspProfiles" class="business" value="<?php echo $profileid; ?>" type="hidden">
<input type="hidden" name="spPostingDate" id="spPostingDate" value="">
<?php
// $rpvt = $p->members($_GET["groupid"]);
// if ($rpvt != false) {
//     while ($row = mysqli_fetch_assoc($rpvt)) {
//         if ($row['spApproveRegect'] == 1) {
//             if ($row['spProfileIsAdmin'] == 0) {
//                 if ($row['spProfiles_idspProfiles'] != $_SESSION['pid']  && $row['spUser_idspUser'] != $_SESSION['uid']) {
// 
?>  

<!--<input type="hidden" name="post_status" id="spPostingDate" value="0">-->
<?php
//                 }
//             }
//         }
//     }
// }
$r = $p->checkSubadmin($group_id, $_SESSION['pid']);

if ($r != false) {
?>
<input type="hidden" name="post_status" id="post_status" value="2">
<?php
} elseif($r == false) {
?>
<input type="hidden" name="post_status" id="post_status" value="0">
<?php
} else{
    $p = new _spgroup;
    $res_1=$p->get_spflage($group_id);
    if($res_1){
    $row_1= mysqli_fetch_assoc($res_1);
    }
    
    if ($row_1['spgroupflag'] == 1) {
    echo '<input type="hidden" name="post_status" id="post_status" value="0">';
    } else {
    echo '<input type="hidden" name="post_status" id="post_status" value="2">';
    }
}
?>
<script type="text/javascript">
$(document).ready(function() {


setInterval(function() {

var today = new Date();

var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

var dateTime = date + ' ' + time;
document.getElementById("spPostingDate").value = dateTime;


}, 1000);
});
</script>



<?php
$p = new _album;
$res = $p->read($profileid);
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {
if ($row['spPostingAlbumName'] == "Timeline") {
$albumid = $row["idspPostingAlbum"];
}
}
if (!isset($albumid)) {
$pid = $profileid;
$albumid = $p->timelinealbum($pid);
}
} else {
$pid = $profileid;
$albumid = $p->timelinealbum($pid);
}
?>
<input type="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">

<div class="row" style="margin-top:35px;">

<div class="col-md-12 ">
<div class="topstatus timeline-topstatus">
<div class="createbox">
<span><label><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/create_post_icon_enable.png" alt="" class="img-responsive"> <strong>Create a post</strong></label></span>
<!--  <span class="seprate">|</span>
<span><label class="btn-bs-file"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/post_photo_icon_enable.png" alt="" class="img-responsive" /> Post Photo<input type="file" class="postingpic" name="spPostingPic[]" accept="image/*" multiple="multiple"></label></span>
<span class="seprate">|</span>
<span><label class="btn-bs-file"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/audio_video_icon_enable.png" alt="" class="img-responsive" /> Audio/Video<input type="file" id="addvideo" class="spmedia"  name="spPostingMedia"  accept=""></label></span>
<span class="seprate">|</span>
<span><label class="btn-bs-file"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/doscuments_icon_enable.png" alt="" class="img-responsive" /> Documents<input type="file" id="addDocument" class='spDocument' name="spPostingDocument" accept="" /></label></span> -->



</div>
</div>
</div>
<div class="col-md-12">
<div class="statusimage commentprofile1">
<?php
$p = new _spprofiles;
$result = $p->read($profileid);
if ($result != false) {
$row = mysqli_fetch_assoc($result);
if (isset($row["spProfilePic"]))
echo "<img alt='profilepic' class='img-circle img_posting_absolut' src=' " . ($row["spProfilePic"]) . "' >";
else
echo "<img alt='profilepic' class='img-circle img_posting_absolut' src='" . $BaseUrl . "/img/default-profile.png' >";
} ?>
<!-- <img id="loading_indicator" src="<?php echo $BaseUrl; ?>/assets/images/loader/ajax-loader.gif" style="width: 16px;height: 11px;left: 94%;top: 3px;right: 0px;" > -->
<textarea type="text" class="grptimeline form-control post_box " id="grptimelinefrmtxt" data-emojiable="true" placeholder="Share your views here" name="spPostingNotes" rows="3"></textarea>

</div>
<div class="post_btn_footer post_footer_timeline">
<label class="tel_feel"></label>
<label class="btn-bs-file custom-file-upload db_btn db_orangebtn btn-border-radius"><input type="file" class="postingpic foo" onchange="validatephotoSize1()" id="addphoto1" name="spPostingPic[]" accept="image/*" multiple="multiple"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Photo</label>

<label class="btn-bs-file custom-file-upload db_btn db_orangebtn btn-border-radius"><input type="file" id="addvideo" class="btn-border-radius spmedia foo" id="addvideo1" onchange="validateMediaSize1()" name="spPostingMedia" accept="video/*,.mp3,.mpa,.wav,.wma,.midi,.mid"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Audio / Video</label>

<label class="btn-bs-file custom-file-upload db_btn db_orangebtn btn-border-radius"><input type="file" id="addDocument" class="spDocument foo btn-border-radius" id="addDocument1"  onchange="validateDocumentSize1()" name="spPostingDocument" accept=".pdf,.doc,.xls,.docx "><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; Document</label>

<div class="dropdown pull-right timeline_butn">
<?php if ($_SESSION['guet_yes'] != 'yes') { ?>
<button id="spPostSubmitTimeline" type="button" data-grouptimeline="grouptimeline" class="btn butn-post btnPosting db_btn db_primarybtn 1 btn-border-radius" data-loading-text="Posting...">Post</button>
<?php } ?>
<!-- <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><span class="caret"></span></button>
<ul class="dropdown-menu timelinedrop">
<li><a href="#"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/group-icon-1.png"> Post in Groups</a></li>
<li><a href="#"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/event_icon_2.png"> Post in Events</a></li>
<li><a href="#"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/time-line/friends_icon_3.png"> Post in Friend's Timeline</a></li>
</ul> -->
</div>
</div>
</div>
<div id="postingPicPreview">
<div id="dvPreview" class="hidden timelineimg"></div>
</div>
<div id="media-container"></div>

</div>

</form>
<div class="timelineload loader_back">
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
               <div class="col-sm-8" style="float:none">
               <button onclick="remove()" id="g2" class="fa fa-remove bg-black" style=" color:red; display:none;"  title="Remove File"></button> 
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


<style>
.separator {
border-right: 1px solid #ccc;
/* margin-bottom: 10px; */
height: 60px;
margin: 0px 0px 10px -30px;
}

.btn-bs-file {
position: relative;
}

.btn-bs-file input[type="file"] {
position: absolute;
top: -9999999;
filter: alpha(opacity=0);
opacity: 0;
width: 0;
height: 0;
outline: none;
cursor: inherit;
}
</style>


<script>
$(document).on('ready', function() {
//$("#input-43").fileinput({
/* $("#input-43").find("input:file").each(function() {  
showPreview: false,
allowedFileExtensions: ["jpg", "jpeg", "gif", "png"],
elErrorContainer: "#errorBlock"
});*/
});
</script>


<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
<script>
function validatephotoSize1() {
  
   
    const fileList = document.getElementById('addphoto1');

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
function validateMediaSize1() {
    
   
  const input = document.getElementById('addvideo1');
  if (input.files && input.files[0]) {
    if (input.files[0].type.indexOf('video/') === 0) {
      
      const maxAllowedSize = 50 * 1024 * 1024;
     
      if (input.files[0].size > maxAllowedSize) {
        
        swal('Video file is too big. Please select a file smaller than 50MB.');
        input.value = '';
      }
    } else if (input.files[0].type.indexOf('audio/') === 0) {
      const maxAllowedSize = 50 * 1024 * 1024;
      if (input.files[0].size > maxAllowedSize) { 
        swal('Audio file is too big. Please select a file smaller than 50MB.');
        input.value = '';
      }
    }
  }
}

</script>


<script>
function validateDocumentSize1() {
 
  const input = document.getElementById('addDocument1');
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
