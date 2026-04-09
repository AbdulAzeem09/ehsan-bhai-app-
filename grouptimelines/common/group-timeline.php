<?php
  $_SESSION['groupid'] = $_GET['groupid'];
  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;}
  $post_status = (in_array($role, ['owner','admin','asstadmin'])) ? 2 : 1;
?>

<div class="create-post-wrapper" style="width:100%">
  <form method="post" action=""  id="sp-form-post" enctype="multipart/form-data" >
    <input type="hidden" id="userid" value="<?php echo $_SESSION['uid'];?>">
    <input type="hidden" id="profileid" value="<?php echo $_SESSION['pid'];?>">
    <input type="hidden" id="groupid" name="groupid" value="<?php echo $_GET['groupid'];?>">
    <input type="hidden" id="post_status" name="post_status" value="<?= $post_status ?>">
    <div class="main-heading">
      Create a post
      <div class="menu-icon" onclick="leftsideBarOpen()">
        <img src="<?php echo $BaseUrl?>/assets/images/menu-icon.svg" alt="">
      </div>
    </div>
    <input type="hidden" id="catname" value="">
    <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
    <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="<?php echo $_GET['groupid']?>">
    <input type="hidden" class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION["pid"]; ?>">
    <input type="hidden" name="spPostingDate" id="spPostingDate" value="<?php echo date("Y-m-d H:i:s");?>">
      
    <div class="create-new-post">
      <textarea id="emojiManager" style="display:none" ></textarea>
      <div id="grptimelinefrmtxt" class="postBox" style="height: 125px">
      </div>
      
      <div class="create-ions">        
        <div class="emojy-icon" id="input-left-position">
          <img class="second-btn" src="<?php echo $BaseUrl?>/assets/images/emogy-icon.svg" alt="">
        </div>
        <div class="photo">
          <img src="<?php echo $BaseUrl?>/assets/images/photo-icon.svg" alt="">
          PHOTO
          <input class="postingpic fileupload" type="file" id="addphoto" onchange="validatephotoSize()" name="spPostingPic[]" accept="image/*" multiple="multiple">
        </div>
        <div class="photo">
          <img src="<?php echo $BaseUrl?>/assets/images/video-icon.svg" alt="">
          AUDIO/VIDEO
          <input class="spmedia fileupload" type="file" id="addvideo" onchange="validateMediaSize()" name="spPostingMedia" accept=".mp3,.mp4,.webm,.ogg">
        </div>
        <div class="photo">
          <img src="<?php echo $BaseUrl?>/assets/images/document-icon.svg" alt="">
          DOCUMENT
          <input class="spDocument fileupload" type="file" id="addDocument" onchange="validateDocumentSize()" name="spPostingDocument" accept=".pdf,.doc,.xls,.docx">
        </div>
        <div class="post-btn" id="spPostSubmitTimeline">
          <img src="<?php echo $BaseUrl?>/assets/images/post-icon.svg" alt="">
          POST
        </div>
      </div>
    </div>
    <span style="color: red; display: none;" id="posterror"></span>
    <div class="col-md-12 hidden" id="showchekbox">
      <div class="post_timeline acknowled" style="padding: 5px;">
        <label class="checkbox-inline">
        <label class="checkbox-inline"><input type="checkbox" id="chkAgree" value="1" checked="">I agree to the <a href="<?php echo $BaseUrl;?>/page/?page=copyrights" target="_blank" class="anchor_default">copyright  </a>violation information</label>
      </div>
    </div> 
    <div id="postingPicPreview"> 
      <div id="dvPreview" class="hidden timelineimg"></div>
      </div>
    <div id="media-container"></div>
  </form>

  <div class="timelineload loader_back">
    <div class="loader timeline_loader"></div>
  </div>

  <div class="row no-margin" style="margin-bottom: 10px;">
    <div class="col-md-12 no-padding">
      <div id="mediaTitle" class=""></div>
      <div id="mediaTitlevideo" class="">
        <div class="row">
          <div class="col-sm-4">
            <b id="s1" style="display:none;">File Preview :</b>
          </div>
          <div class="col-sm-8" style="float:none;position: relative;">
            <button onclick="remove()" id="g2" class="fa fa-remove bg-black" style=" color:red; display:none;position: absolute;left: 306px; width: 13px; height: 13px;"  title="Remove File"></button> 
          </div>
        </div>
        <video width="320" height="240" style="display:none;" controls id="makemepreview">
          <!-- <source id="videoSourcemakemepreview" type="video/mp4">
          Your browser does not support the video tag. -->
        </video>
      </div>
      <div id="groupTitle" class=""></div>
    </div>
  </div>

  <div id="timeline-container" class="time-line">
    <div id="loadMore">
      <h4 class="load-more 111" >Load More</h4>
      <input type="hidden" id="row" value="0">
      <input type="hidden" id="all" value="0">
      <input type="hidden" id="profiddd" value="<?php echo $_SESSION["pid"]; ?>">
    </div>
  </div>
</div>

<div id="flagPost" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form onsubmit="return false;" method="post" id="flagpostfrm">
        <div class="modal-header">
          <h6>Flag this Post</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <input type="hidden" name="spProfile_idspProfile" id="spProfile_idspProfile" value="<?php if(isset($_SESSION['pid'])) { echo $_SESSION['pid']; }?>">
            <input type="hidden" name="flagpostprofileid" id="flagpostprofileid">
            <input type="hidden" name="spPosting_idspPosting" id="spPosting_idspPosting">
            <div class="col-md-12" style="display: grid;">
              <label><input type="radio" name="radReport" checked class="radReport mr_right_7" value="This person is annoying me">This post is annoying me</label>
              <label><input type="radio" name="radReport" class="radReport mr_right_7" value="They're pretending to be me or someone I know">They're pretending to be me or someone I know</label>
              <label><input type="radio" name="radReport" class="radReport mr_right_7" value="This is a fake account">This is a fake account Post</label>
              <label><input type="radio" name="radReport" class="radReport mr_right_7" value="This profile represents a business or organization">This Post represents a business or organization</label>
              <label><input type="radio" name="radReport" class="radReport mr_right_7" value="They're using a different name than they use in everyday life">They're using a different name than they use in everyday life</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="flagPost();" name="btnReport" id="flagtimelinepost">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div> 
               
<?php include_once("../views/common/share-modal.php"); ?>
