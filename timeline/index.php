<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/backofadmin/library/config.php";
require_once('../helpers/image.php');
$image = new Image;
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Base.php';
// //require_once "../backofadmin/faq/_spAllStoreForm.class.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/backofadmin/faq/_spAllStoreForm.class.php';
// //require_once "../classes/Header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Header.php';

// //require_once("../helpers/start.php");
// 
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/start.php';

require_once "../classes/Timeline.php";

$t = new Timeline;
$h = new Header;


$profiles = $h->readProfileOnConsultation($_SESSION["uid"]);

$env = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");
$secretKey = $env["CONSULT_SECRET_KEY"] ?? "THESHAREWATERBROOK860";

$payload = [
    'user_id'           => $_SESSION['uid'],
    'email'             => $_SESSION['spUserEmail'],
    'user_name'         => $_SESSION['login_user'],
    'country'           => $_SESSION['spPostCountry'],
    'state'             => $_SESSION['spPostState'],
    'profile_id'        => $_SESSION['pid'],
    'profile_pic'        => $_SESSION['spProfilePic'],
    'profile_name'      => $_SESSION['myprofile'],
    'profile_data'	    => $profiles['data'],
    'profile_type_name' => $_SESSION['ptname'],
    'status'            => $_SESSION['isActive'],
    'iat'               => time(),                       // Issued at time
    'exp'               => time() + 3600                 // Token expiry (1 hour)
];

require_once "../classes/CreateProfile.php";
require_once "../classes/EditProfile.php";
require_once "../classes/Timeline.php";
require_once "../mlayer/_country.class.php";
require_once "../mlayer/_state.class.php";
require_once "../mlayer/_city.class.php";


$success_message= "";
$errors_message= "";
$time = new Timeline();
$edit = new EditProfile();
$t = new CreateProfile();
$sp_pid = $_SESSION['pid'];
$sp_uid = $_SESSION['uid'];
$row  = $edit->fetchUserData($_SESSION["pid"]);
$country = 0;
$state = 0;
$city = 0;

if (isset($_POST["Business_Name"])) {
    
    $businame_name = $_POST['Business_Name'];
    $address = $_POST['spaddress'];
    $country = $_POST['Country'];
    $state = $_POST['spUserState'];
    $city = $_POST['spUserCity'];
    $file_error = $image->validateFileImageExtensionsWithPDF($_FILES['Profiles']);
    if(!$file_error){
        $errors_message ="Please upload only image files or PDF for Profiles.";
    }

    $image->validateFileImageExtensionsWithPDF($_FILES['upload_bills']);
    if(!$file_error){
        $errors_message ="Please upload only image files or PDF for Profiles.";
    }
    if(empty($errors_message)){
         $profiles = $_FILES['Profiles']['name'];
        if ($profiles == "") {
            $profiles = $licenspic;
        }
        $profiles2 = $_FILES['Profiles']['tmp_name'];
        $spdir = "profile_pic/" . $profiles;
        move_uploaded_file($profiles2, $spdir);

        $upload_bills = $_FILES['upload_bills']['name'];
        if ($upload_bills == "") {
            $upload_bills = $billpic;
        }
        $upload_bills2 = $_FILES['upload_bills']['tmp_name'];
        $billdr = "profile_pic/" . $upload_bills;
        move_uploaded_file($upload_bills2, $billdr);
        $bswebsite = $_POST['bswebsite'];
        $spcmd = "insert into spbuiseness_files(sp_pid,sp_uid,Business_Name,Address,Country,State,City,Profiles,upload_bills,bswebsite,counts) values('$sp_pid','$sp_uid','$businame_name','$address','$country','$state','$city','$profiles','$upload_bills','$bswebsite','$numcounts')";

        $inserts = mysqli_query($dbConn, $spcmd); 
        $success_message = "Business verification documents successfully submitted!";
      }
    }

    if(isset($row['data'])){
        $country = isset($row['data']["spProfilesCountry"]) ? $row['data']["spProfilesCountry"] : 0;
        $state = isset($row['data']["spProfilesState"]) ? $row['data']["spProfilesState"] : 0;
        $city = isset($row['data']["spProfilesCity"]) ? $row['data']["spProfilesCity"] : 0;
    }
// echo '<pre>';
$profile_type = isset($row['data']["spProfileType_idspProfileType"]) ? $row['data']["spProfileType_idspProfileType"] : 0;
// echo "</pre>";
if (isset($_SESSION['deactivateStatus']) && $_SESSION['deactivateStatus'] == 1) {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      window.onload = function() {
        Swal.fire({
          title: 'Your account is deactivated!',
          text: 'Go to settings to enable it.',
          icon: 'warning',
          showCancelButton: false,
          confirmButtonText: 'Go to Settings',
          allowOutsideClick: false, // Don't allow closing by clicking outside
          allowEscapeKey: false // Don't allow closing with Escape key
        }).then((result) => {
          if (result.isConfirmed) {
            // Navigate to dashboard/settings
            window.location.href = '/dashboard/settings';
          }
        });
      };
    </script>
    <?php
}
?>
<?php
$page = "timeline";
include_once("../views/common/header.php");
?>
<style>
    .plan-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #FB8308;
        position: absolute;
        right: 10px;
        z-index: 9;
    }
    .dropdown-menu {
        --bs-dropdown-min-width: 3rem !important;
        cursor : pointer;
    }
</style>
<style>
    .card{
        background-color: #fff;
        border: none;
    }
    .form-color{
        background-color: #fafafa;
    }

    .form-control{
        height: 48px;
        border-radius: 5px;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #FB8308;
        outline: 0;
        box-shadow: none;
        text-indent: 10px;
    }

    .c-badge{
        background-color: #FB8308;
        color: white;
        height: 20px;
        font-size: 11px;
        width: 92px;
        border-radius: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 2px;
    }
    .time{
        font-size: 12px;
    }

    .comment-text{
        font-size: 15px;
    }

    .wish{
        padding-right: 5px;
        color:#FB8308;
    }


    .user-feed{
        font-size: 14px;
        margin-top: 12px;
    }
    .user-feed span a{
        text-decoration : none;
    }
    .fs-sm{
        font-size: 12px;
    }
    .commentsBar{
        position:sticky;
        bottom: 0;
    }
</style>

<style>
    .comment-item{
        padding: 5px 0;
    }
    .comment-item p{
        padding : 10px 0px;
        margin-bottom: 1px;
    }

    .group-wrapper .create-post-wrapper .blogs p {
        color: #494c4f !important;
    }

    .group-wrapper .create-post-wrapper .blogs strong {
        color: #494c4f !important;
    }

    #business .modal-dialog,
    #business .modal-content {
    max-width: 700px !important;
    width: 100% !important;
    }

    .red {
        color: red;
    }
    .custom-file-label::after {
        content: "Browse";
    }
    .preview-img {
        max-width: 200px;
        max-height: 200px;
        border: 1px solid #ddd;
        padding: 5px;
        margin-top: 10px;
    }
    .status-label {
        font-weight: bold;
    }
    .status-pending {
        color: orange;
    }
    .status-accepted {
        color: green;
    }
    .status-rejected {
        color: red;
    }
    .form-group {
        margin-bottom: 1.5rem; /* Increases space between form groups/fields */
    }
</style>
<div class="create-post-wrapper">
    <input type="hidden" id="userid" value="<?php echo $_SESSION['uid'];?>">
    <input type="hidden" id="profileid" value="<?php echo $_SESSION['pid'];?>">
    <form method="post" action="../post-ad/dopost.php"  id="sp-form-post" enctype="multipart/form-data" >
        <?php
         if ($success_message != "") {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="top:-15px">
            <strong>Success!</strong> <?php echo $success_message?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php } 
            if ($errors_message != "") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="top:-15px">
                    <strong>Error!</strong> <?php echo $errors_message?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php    }
        ?>
        <div class="main-heading">
            Create a post
            <div class="menu-icon" onclick="leftsideBarOpen()">
                <img src="<?php echo $BaseUrl?>/assets/images/menu-icon.svg" alt="">
            </div>
        </div>
        <?php
        $albumData = $t->getAlbumId($_SESSION['pid']);
        if(isset($albumData['data']) && !empty($albumData['data'])){
            if($albumData['data']['spPostingAlbumName'] == 'Timeline'){
                $albumid = $albumData['data']['idspPostingAlbum'];
            }
        }

        if(!isset($albumid)){
            $albumid = $t->addAlbum($_SESSION['pid']);
            if(isset($albumid['data'])){
                $albumid = $albumid['data'];
            }
        }
        ?>
        <input type="hidden" id="catname" value="">
        <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid; ?>">
        <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
        <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">
        <input type="hidden" class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" value="<?php echo $_SESSION["pid"]; ?>">
        <input type="hidden" name="spPostingDate" id="spPostingDate" value="<?php echo date("Y-m-d H:i:s");?>">
        <div class="create-new-post">
            <textarea id="emojiManager" style="display:none" ></textarea>
            <div id="grptimelinefrmtxt" class="postBox" style="height: 125px"></div>
            <div id="char-count" style="margin-top: 5px; color: gray; font-size: 12px;">1000 characters remaining | 10 emojis remaining</div>
            <div class="create-ions">
                <div class="emojy-icon" id="input-left-position" >
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
    <div class="timelineload loader_back" >
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
                <video width="320" height="240" style="display:none;" controls id="makemepreview"></video>
            </div>
            <div id="groupTitle" class=""></div>
        </div>
    </div>
    <div id="timeline-container">
        <div id="loadMore">
            <h4 class="load-more 111" >Load More</h4>
            <input type="hidden" id="row" value="0">
            <input type="hidden" id="all" value="0">
            <input type="hidden" id="profiddd" value="<?php echo $_SESSION["pid"]; ?>">
        </div>
    </div>
    <div id="comment-wrapper"></div>
</div>
<?php
include_once("../views/common/right-bar.php");
?>
</div>
<?php
include_once("../views/common/footer.php");
?>
</div>
<?php
include_once("../views/common/share-modal.php");
?>

<div class="modal fade" id="editPost" tabindex="-1" aria-labelledby="editPostlabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Edit Post</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row height d-flex justify-content-center align-items-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="p-3">
                                <div id="postMessagae" style="height:300px;">
                                </div>
                                <input type="hidden" id="edit_post_id" name="edit_post_id">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updatePost">Save changes</button>
            </div>
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

<div class="modal fade" id="business" tabindex="-1" role="dialog" aria-labelledby="businessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" id="businessPr" enctype="multipart/form-data">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h4 class="modal-title" id="businessModalLabel">Business Profile Verification</h4>
                        <h5 class="modal-title" style="margin-top: 8px;">Submit the documents requested to verify your business</h5>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 32px;border: none;background: none;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Business Name -->
                    <div class="form-group">
                        <label for="Business_Name">Business Name <span class="red" id="err_businessN">*</span></label>
                        <input type="text" class="form-control" name="Business_Name" id="Business_Name" value="<?php echo htmlspecialchars($businesname ?? ''); ?>" required>
                    </div>

                    <!-- Address -->
                    <div class="form-group">
                        <label for="spaddress">Address <span class="red" id="err_address">*</span></label>
                        <input type="text" class="form-control" name="spaddress" id="spaddress" value="<?php echo htmlspecialchars($spaddr ?? ''); ?>" required>
                    </div>

                    <!-- Country, State, City Row -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="spUser_Country" class="lbl_2">Country <span class="red">*</span></label>
                                <select class="form-control" name="Country" id="spUser_Country" required>
                                    <option value="">Select Country</option>
                                    <?php
                                    $co = new _country;
                                    $result3 = $co->readCountry();
                                    if ($result3 != false) {
                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                            $selected = (isset($country) && $country == $row3['country_id']) ? 'selected' : '';
                                            echo "<option value='{$row3['country_id']}' {$selected}>{$row3['country_title']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="red" id="err_country"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group states">
                                <label for="spUserState">State <span class="red">*</span></label>
                                <select class="form-control spPostingsState" id="spUserState" name="spUserState" required>
                                    <option value="">Select State</option>
                                    <?php
                                    if (isset($country) && $country > 0) {
                                        $pr = new _state;
                                        $result2 = $pr->readState($country);
                                        if ($result2 != false) {
                                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                                $selected = (isset($state) && $state == $row2["state_id"]) ? 'selected' : '';
                                                echo "<option value='{$row2["state_id"]}' {$selected}>{$row2["state_title"]}</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="red" id="err_state"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group cities">
                                <label for="spUserCity">City <span class="red">*</span></label>
                                <select class="form-control spPostingsCity" id="spUserCity" name="spUserCity" required>
                                    <option value="">Select City</option>
                                    <?php
                                    if (isset($state) && $state > 0) {
                                        $co = new _city;
                                        $result3 = $co->readCity($state);
                                        if ($result3 != false) {
                                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                                $selected = (isset($city) && $city == $row3['city_id']) ? 'selected' : '';
                                                echo "<option value='{$row3['city_id']}' {$selected}>{$row3['city_title']}</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                                <span class="red" id="err_city"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Business License -->
                    <div class="form-group" >
                        <label for="Profiles">Business License <span class="red" id="err_businessL">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="Profiles" name="Profiles" accept="image/*" required>
                        </div>
                        <img src="<?php echo $licenspic ? 'profile_pic/' . htmlspecialchars($licenspic) : 'profile_pic/no_image.jpg'; ?>" class="preview-img" id="license" alt="License Preview" style="display: none">
                    </div>

                    <!-- Upload Bills -->
                    <div class="form-group">
                        <label for="upload_bills">Upload any bills addressed to the business Location 
                        <br />    
                        <span class="red" id="err_bills">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="upload_bills" name="upload_bills" accept="image/*" required>
                        </div>
                        <img src="<?php echo $billpic ? 'profile_pic/' . htmlspecialchars($billpic) : 'profile_pic/no_image.jpg'; ?>" class="preview-img" id="img_bills" alt="Bills Preview" style="display: none">
                    </div>

                    <!-- Business Website -->
                    <div class="form-group">
                        <label for="bswebsite">Business Website <span class="red" id="err_website">*</span></label>
                        <input type="url" class="form-control" name="bswebsite" id="bswebsite" value="<?php echo htmlspecialchars($spwebname ?? ''); ?>" placeholder="https://example.com" required>
                    </div>

                    <!-- Status -->
                    <?php if (isset($userstatus)): ?>
                        <div class="form-group">
                            <?php if ($userstatus == 1): ?>
                                <label class="status-label">Status: <span class="status-pending">Pending</span></label>
                            <?php elseif ($userstatus == 2): ?>
                                <label class="status-label">Status: <span class="status-accepted">Accepted</span></label>
                            <?php elseif ($userstatus == 3): ?>
                                <label class="status-label">Comments: <?php echo htmlspecialchars($reject_reason ?? ''); ?></label><br>
                                <label class="status-label">Status: <span class="status-rejected">Rejected</span></label>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnsubmit_b" name="btns" style="background: linear-gradient(135deg, #FB8308, #f1a500);" <?php if (isset($userstatus) && ($userstatus == 1 || $userstatus == 2)) echo 'disabled'; ?>>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php if (isset($_GET['cpid'])) { ?>
    <script>
        $(document).ready(function(){
            var cid = "<?= $_GET['cpid']; ?>";
            loadComment(cid);
        });
    </script>
<?php } ?>

<script src="<?php echo $BaseUrl; ?>/assets/emoji/vanillaEmojiPicker.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>

<script>

    $(document).ready(function(){
        $(document).on('keydown', function(event) {
            if (event.key === "Enter" && event.shiftKey) {
                console.log("Shift + Enter was pressed for a new line");
            }else if (event.key === "Enter") {
                if(event.target.className == "ql-editor" && event.target.offsetParent.id == "grptimelinefrmtxt"){
                    $('#spPostSubmitTimeline').trigger('click');
                }
            }
        });
    });

    function deletecommentreply(id) {
        Swal.fire({
            title: "Message will be deleted permanently. Are you sure you want to delete it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '../publicpost/replycommentdelete.php',
                    data: {
                        idComment: id
                    },
                    success: function(response) {
                        $("#repcmtdiv"+id).remove();
                        toastr.success('Comment deleted successfully.');
                    }
                })
            }
        })
    }

    function loadComment(id){
        $.ajax({
            type: 'POST',
            url: "loadcomment.php",
            data: {
                'id' : id
            },
            dataType: "html",
            success: function(response) {
                $("#comment-wrapper").html(response);
                $("#postComments").modal('show');
            }
        })
    }

    function deletecomment(id) {
        Swal.fire({
            title: "Message will be deleted permanently. Are you sure you want to delete it?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: '../publicpost/commentdelete.php',
                    data: {
                        idComment: id
                    },
                    success: function(response) {
                        $(".cmtdiv" + id).remove();
                        toastr.success('Comment deleted successfully.');
                    }
                })
            }
        })
    }

    $(document).ready(function(){
        $(".show_edit_comment").click(function(){
            $('#postComments').modal('hide');
            $($(this).data('target')).modal('show');
        });
    });

    $(document).on("click", ".comment_like", function() {
        var commentId = $(this).attr("data-commentId");
        var likedBy = $(this).attr("data-userId");
        var postId = $(this).attr("data-postid");
        var postAction = $(this).attr("data-postAction");

        $.post("../social/addcommentlike.php", {
            comment_id: commentId,
            post_id: postId,
            liked_by: likedBy,
            postAction: postAction
        }, function(response) {
            var resp = JSON.parse(response);
            $('#cmnt_like_' + commentId).remove();
            $(".comment_like_area_" + commentId).html(resp.liked);
        });
    });

    function loadCommentReply(cid){
        $.ajax({
            type: 'POST',
            url: "loadreplycomment.php",
            data: {
                'cid' : cid
            },
            dataType: "html",
            success: function(response) {
                $("#reply_comment_wrapper_"+cid).html(response);
            }
        })
    }

    $(document).on("click", ".replycomment", function(){
        var cid = $(this).data('cid');
        var text = $("#message"+cid).val();
        var formData = $("#recomments"+cid).serialize();
        if(text == ""){
            toastr.error('Please enter message.');
            return false;
        }

        $.ajax({
            type: 'POST',
            url: "../publicpost/reply_comment.php",
            data: formData,
            success: function(response) {
                $("#reply_comment_wrapper_"+cid).html('');
            }
        })
    })

    $('#Profiles').on('change', function() {
      var file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#license').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            // If no file or not an image, hide the preview
            $('#license').hide();
        }
    });

    $('#upload_bills').on('change', function() {
      var file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_bills').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            // If no file or not an image, hide the preview
            $('#img_bills').hide();
        }
    });

   

    $("#btnsubmit_b").click(function() {
    var Business_Name = $("#business").find("#Business_Name").val();
    var spaddress = $("#business").find("#spaddress").val();
    var spUser_Country = $("#business").find("#spUser_Country").val();
    var spUserState = $("#business").find("#spUserState").val();
    var spUserCity = $("#business").find("#spUserCity").val();
    var Profiles = $("#business").find("#Profiles")[0].files[0];
    var upload_bills = $("#business").find("#upload_bills")[0].files[0];
    var bswebsite = $("#business").find("#bswebsite").val();
    // Reset error messages
    $(".error").text("");
    // Check for empty fields
    if (
        Business_Name == "" ||
        spaddress == "" ||
        spUser_Country == "" ||
        spUserState == "" ||
        spUserCity == "" ||
        Profiles == undefined ||
        upload_bills == undefined ||
        bswebsite == ""
    ) {
           // Display error messages for empty fields
            if (Business_Name == "") {
                $("#err_businessN").text("This is a required field.");
            }
            if (spaddress == "") {
                $("#err_address").text("This is a required field.");
            }
            if (spUser_Country == "") {
                $("#err_country").text("This is a required field.");
            }
            if (spUserState == "") {
                $("#err_state").text("This is a required field.");
            }
            if (spUserCity == "") {
                $("#err_city").text("This is a required field.");
            }
            if (Profiles == undefined) {
                $("#err_businessL").text("Accpetable format - PDF, JPG,PNG.");
            }
            if (upload_bills == undefined) {
                $("#err_bills").text("Accpetable format - PDF, JPG,PNG.");
            }
            if (bswebsite == "") {
                $("#err_website").text("This is a required field.");
            }
            return false;
        } else {
          // Check if the selected files are images
          var validImageOrPdfTypes = [
            "image/jpeg", "image/png", "image/gif", "image/jpg",
            "image/tif", "image/tiff", "image/bmp", "image/svg+xml",
            "image/webp", "image/heic", "image/heif",
            "application/pdf"           // added PDF
            ];

            if ($.inArray(Profiles.type, validImageOrPdfTypes) === -1) {
                $("#business").find("#err_businessL")
                    .text("Please select a valid image **or PDF** file for Profiles.");
                return false;
            }
            if ($.inArray(upload_bills.type, validImageOrPdfTypes) === -1) {
                $("#business").find("#err_bills")
                    .text("Please select a valid image **or PDF** file for upload bills.");
                return false;
            }
            // If all checks pass, submit the form
             $("#business").find("#businessPr").submit();
            
            // Additional check after submission for non-image files
             $("#business").find("#businessPr").on('submit', function(e) {
                if ($.inArray(Profiles.type, validImageOrPdfTypes) === -1 || $.inArray(upload_bills.type, validImageOrPdfTypes) === -1) {
                    e.preventDefault(); // Prevent form submission
                    alert("Please select valid image files.");
                    return false;
                }
            });
        }
    });
    $(document).ready(function() {
        $(document).on('keyup', 'input', function(e) {
            const element = $(this);
            const value   = element.val();
            const hasLeadingSpace = value.length > 0 && value[0] === ' ';
            const isEmptyOrSpaces = value.trim() === '';

            // Regex (or URL constructor) for validating website URLs
            const urlPattern = /^(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w-]*)*$/i;  // see: example regex :contentReference[oaicite:0]{index=0}

            if ((e.which === 32 && this.selectionStart === 0) || hasLeadingSpace || isEmptyOrSpaces) {
                element.prev().find('.red').text("This is a required field.");
                element.val('');
                e.preventDefault();
            } else {
                // Additional check if this is the "bswebsite" field
                if (element.attr('id') === "bswebsite") {
                    if (!urlPattern.test(value)) {
                        element.prev().find('.red').text("Please enter a valid website URL.").show();
                        // maybe keep value or clear it depending on your UX
                        return;
                    } else {
                        element.prev().find('.red').text("*").show();
                        return;
                    }
                }

                element.prev().find('.red').text("*").show();
            }
        });

        $(document).on('change', 'select', function(e) {
            const element = $(this);
            const value   = element.find('option:selected').val();

            // Example check: if value is empty or default
            if (!value || value.trim() === '') {
                element.next().text("This is a required field.").show();
            } else {
                element.next().text("*").hide();
            }
        });

        $(document).on('change', 'input[type="file"]', function(e) {
            const element = $(this);
            const files   = this.files;  // FileList
            const errorMessage = "Accpetable format - PDF, JPG,PNG.";
            
            // If no file selected
            if (!files || files.length === 0) {
                element.parent().prev().find('.red').text(errorMessage).show();
                return;
            }
            
            const file = files[0];
            const fileName = file.name;
            const mimeType = file.type;
            const allowedExtensions = /(\.pdf|\.jpg|\.jpeg|\.png|\.gif)$/i;
            const allowedMimeTypes    = ["application/pdf", "image/jpeg", "image/png", "image/gif"];
            
            // Check extension
            if (!allowedExtensions.test(fileName)) {
                element.val('');  // clear the file input
                element.parent().prev().find('.red')
                    .text("Invalid file type. Only PDF or image allowed.")
                    .show();
                return;
            }
            
            // Check MIME type
            if (allowedMimeTypes.indexOf(mimeType) < 0) {
                element.val('');
                element.parent().prev().find('.red')
                    .text("Invalid file type. File appears not to be a PDF or allowed image.")
                    .show();
                return;
            }
            
            // If passed all checks
            element.parent().prev().find('.red').text("*").hide();
        });


        $('#spUser_Country').on('change', function() {
        var countryId = $(this).val();
        if (countryId) {
            $.ajax({
                url: '../dashboard/settings/loadPlainUserState.php',
                method: 'POST',
                data: { countryId: countryId },
                success: function(response) {
                    // Assuming response is HTML options or JSON array of states
                    // If JSON, parse and build options; if HTML, directly insert
                    $(".states").find("#spUserState").html(response);
                    console.log($('#spUserState').html());
                    // Reset city select
                    $(".cities").find("#spUserCity").html('<option value="">Select City</option>')
                },
                error: function() {
                    alert('Error loading states. Please try again.');
                }
            });
        } else { // Reset state and city if no country selected
                $('#spUserState').html('<option value="">Select State</option>');
                $('#spUserCity').html('<option value="">Select City</option>');
            }
        });

        // Similarly, handle state change to load cities (assuming a similar endpoint exists)
        $('.spPostingsState').on('change', function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '../dashboard/settings/loadPlainUserCity.php', // Adjust endpoint if different
                    method: 'POST',
                    data: { state: stateId },
                    success: function(response) {
                        $(".cities").find("#spUserCity").html(response);
                    },
                    error: function() {
                        alert('Error loading cities. Please try again.');
                    }
                });
            } else {
                $(".cities").find("#spUserCity").html('<option value="">Select City</option>');
            }
        });
    })
</script>
</body>
</html>
