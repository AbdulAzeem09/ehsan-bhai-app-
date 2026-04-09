<?php

$p = new _spprofiles;
$profileid = $_SESSION['pid'];

$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;

echo "gid ---" $_SESSION['groupid'];

/*
$_SESSION['gid'] is not set or found so ommited - ganesh

$result = $p->readMember(isset($_SESSION['uid']), isset($_SESSION['gid']));


if ($result != false) {
    $row = mysqli_fetch_assoc($result);
    $profileid = $row["idspProfiles"];
    $profilename = $row["spProfileName"];
}
*/
$p = new _spgroup;

?>

<?php
echo "<br> grouptimelineform.php - ganesh";
?>

<form enctype="multipart/form-data" action="../post-ad/dopost.php" method="post" id="sp-form-post">

    <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
    <input type="hidden" id="catname" value="">
    <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="<?php echo $group_id ?>">
    <input id="groupid" name="groupid" type="hidden" value="<?php echo $group_id ?>">
    <input name="spProfiles_idspProfiles" id="spProfiles_idspProfiles" class="business" value="<?php echo $profileid; ?>" type="hidden">
    <input type="hidden" name="spPostingDate" id="spPostingDate" value="">


    <?php

    $r = $p->checkSubadmin($group_id, $_SESSION['pid']);

    if ($r != false) {
    ?>
        <input type="hidden" name="post_status" id="post_status" value="2">
    <?php
    } elseif ($r == false) {
    ?>
        <input type="hidden" name="post_status" id="post_status" value="0">
    <?php
    } else {
        $p = new _spgroup;
        $res_1 = $p->get_spflage($group_id);
        if ($res_1) {
            $row_1 = mysqli_fetch_assoc($res_1);
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

    
    // the below code uses spPostingAlbumName table, which does not exist, so ommited  -ganesh

/*  $p = new _album;
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
*/

    ?>
<!--     <input type="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php // echo $albumid; ?>"> -->

    <div class="row" style="margin-top:35px;">

        <div class="col-md-12 ">
            <div class="time-line">

                <div class="main-heading">
                    <div class="createbox">
                        Create a post
                    </div>
                </div>


                <div class="create-new-post">

                    <textarea type="text" id="grptimelinefrmtxt" data-emojiable="true" placeholder="Share your views here" name="spPostingNotes" rows="3" style="margin-left: 0px!important; border-radius:5px!important;width:100%!important"></textarea>

                    <div class="create-ions" style="margin-bottom: 0!important;">
                        <div class="emojy-icon" style="margin-left: 0px;">
                            <img src="../assets/images/inner_group/emogy-icon.svg" alt="">

                        </div>
                        <div class="photo" onclick="triggerphotoInput()">
                            <input type="file" class="postingpic foo" onchange="validatephotoSize1()" id="addphoto1" name="spPostingPic[]" accept="image/*" multiple="multiple" style="display:none;">
                            <img src="../assets/images/inner_group/photo-icon.svg" alt="">
                            Photo
                        </div>

                        <div class="photo" onclick="triggerVedioInput()">
                            <input type="file" id="addvideo" id="addvideo1" onchange="validateMediaSize1()" name="spPostingMedia" accept="video/*,.mp3,.mpa,.wav,.wma,.midi,.mid" style="display:none;">
                            <img src="../assets/images/inner_group/video-icon.svg" alt="">
                            AUDIO/VIDEO
                        </div>
                        <div class="photo" onclick="triggerDocumentInput()">
                            <input type="file" id="addDocument" id="addDocument1" onchange="validateDocumentSize1()" name="spPostingDocument" accept=".pdf,.doc,.xls,.docx " style="display:none;">
                            <img src="../assets/images/inner_group/document-icon.svg" alt="">
                            DOCUMENT
                        </div>
                        <div class="post-btn px-1">
                            <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
                                <button class="btn bg-transparent border-0 w-100 text-white" id="spPostSubmitTimeline" type="button" data-grouptimeline="grouptimeline" data-loading-text="Posting...">
                                    <img src="../assets/images/inner_group/post-icon.svg" alt="" class="me-2">
                                    POST
                                </button>
                            <?php } ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<?php
echo "<br> grouptimelineform.php after form - ganesh";
?>
<div id="postingPicPreview">
    <div id="dvPreview" class="hidden timelineimg"></div>
</div>
<div id="media-container"></div>
<div class="timelineload loader_back">
    <div class="loader timeline_loader"></div>
</div>
<div class="row no-margin">


    <div class="col-md-12 no-padding">
        <div id="mediaTitle" class=""></div>

        <div id="mediaTitlevideo" class="">
            <div class="row">
                <div class="col-sm-4">
                    <b id="s1" style="display:none;">File Preview :</b>
                </div>
                <div class="col-sm-8" style="float:none">
                    <button onclick="remove()" id="g2" class="fa fa-remove bg-black" style=" color:red; display:none;" title="Remove File"></button>
                </div>
            </div>
            <video width="320" height="240" style="display:none;" controls id="makemepreview"></video>
        </div>
        <div id="groupTitle" class=""></div>

    </div>
    <div class="col-md-12 no-padding">
        <div id="progressBox" class="">
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



<script src="<?php echo $baseurl ?>/asaddvideosets/js/sweetalert.js"></script>
<script>
    function validatephotoSize1() {


        const fileList = document.getElementById('addphoto1');
        console.log(fileList)
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
            if (event.target.files[0].size <= 52428800) {
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

        $("#addvideo").val("");
        document.getElementById("makemepreview").style.display = "none";
        document.getElementById("g2").style.display = "none";
        document.getElementById("mediaTitle").innerText = "";
        document.getElementById("s1").style.display = "none";


    }

    function triggerphotoInput() {
        document.getElementById('addphoto1').click();
    }

    function triggerVedioInput() {
        document.getElementById('addvideo').click();
    }

    function triggerDocumentInput() {
        document.getElementById('addDocument').click();
    }
</script>

<?php echo '<br>grouptimelines/grouptimelineform.php endof file - ganesh' ?>

