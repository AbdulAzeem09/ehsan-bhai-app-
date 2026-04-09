<!DOCTYPE html>
<html lang="en-US">

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
    <?php include('../component/links.php'); ?>
    <!--This script for posting timeline data Start-->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
    <!--This script for posting timeline data End-->
    <!-- image gallery script strt -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
    <!-- image gallery script end -->
</head>

<body class="bg_gray" onload="pageOnload('groupdd')">
    <?php
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
    if (isset($_POST['upload'])) {
        $image = new Image();
        $image->validateFileVideoExtensions($_FILES['file']);

        $id = $_POST['id'];

        $uid = $_SESSION['uid'];
        $pid = $_SESSION['pid'];
        $gid = $_POST['gid'];
        $dir = 'group_video_upload/';
        $tmp_file = $_FILES['file']['tmp_name'];
        $file = $_FILES['file']['name'];
        move_uploaded_file($tmp_file, "$dir/$file");
        $date = $_POST['date'];
        $dt = array(
            "user_id" => $uid,
            "profile_id" => $pid,
            "group_id" => $gid,
            "file" => $file,
            "date_created" => $date
        );
        $obj = new _postingalbum;
        $obj->insertfile($dt);
    }

    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="videos">
                <div class="heading-wrapper">
                    <div class="main-heading">
                        Videos
                    </div>
                    <?php
                    $pg = new _spgroup;
                    $ress2 = $pg->readdatabyspid($group_id);
                    if ($ress2 != false) {
                        $roww2 = mysqli_fetch_assoc($ress2);
                        $idspProfiles =  $roww2['idspProfiles'];
                        $pid = $_SESSION['pid'];
                        if ($pid == $roww2['idspProfiles']) {

                    ?>
                            <div class="more-btn">
                                <div class="btn">

                                    <a class="text-decoration-none" href="#" data-toggle="modal" data-target="#videoUploading"><img src="../assets/images/inner_group/add-4.svg" alt="">
                                        <span class="text-white">Add Video</span></a>

                                </div>
                            </div>

                    <?php }
                    } ?>

                </div>
                <div class="album-wrapper">


                    <?php
                    $obj = new _postingalbum;
                    $ress = $obj->readdatabygid($group_id);
                    if ($ress != '') {

                        while ($roww = mysqli_fetch_assoc($ress)) {

                    ?>
                            <div class="album" data-bs-toggle="modal" data-bs-target="#view-video">
                                <div class="img-wrapper">
                                    <video width="100%" height="200" controls>
                                        <source src="group_video_upload/<?php echo $roww['file']; ?>" type="video/mp4">

                                        Your browser does not support the video tag.
                                    </video>
                                </div>

                                <?php
                                $groupid = $group_id;
                                $groupname = $_GET['groupname'];

                                if ($pid == $roww2['idspProfiles']) {
                                ?>
                                    <?php $aaa = $BaseUrl . '/grouptimelines/delete_video.php?id=' . $roww['id'] . '&flag=1&groupid=' . $groupid . '&groupname=' . $groupname . ''; ?>

                                    <a id="dell" onclick="video('<?php echo $aaa;  ?>')" style="cursor:pointer">
                                        <i class="fa fa-trash  btn-outline-danger btn-border-radius"></i> Delete Video</a>

                                <?php } ?>

                            </div>
                        <?php } ?>

                </div>


                <div class="row no-margin" style="padding: 10px;">


                    <?php
                        $p = new _postings;
                        $p2 = new _postings;
                        $start = 0;

                        $conn = _data::getConnection();

                        $gid = $group_id;


                        $sql = "SELECT s.timelineid,s.spPostings_idspPostings, s.spShareByWhom,s.spShareComment FROM share AS s INNER JOIN sppostings AS f ON f.idspPostings = s.timelineid INNER JOIN sppostingmedia h on f.idspPostings = h.spPostings_idspPostings WHERE spShareToGroup = $gid AND h.sppostingmediaExt = 'mp4' AND f.spCategories_idspCategory = 16 AND f.spPostingVisibility = -1 UNION ALL SELECT t.idspPostings,t.spCategories_idspCategory ,t.spPostingsFlag,t.spPostingsFlag FROM sppostings AS t inner join spprofiles as d on t.spProfiles_idspProfiles = d.idspprofiles where t.spCategories_idspCategory = 16 and t.sppostingvisibility = $gid ORDER BY timelineid DESC";

                        $res = mysqli_query($conn, $sql);

                        if ($res != false) {
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
                            if ($res2 != false) {
                                while ($rows = mysqli_fetch_assoc($res2)) {

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
                                        if ($sppostingmediaExt == 'mp4') { ?>
                                        <div class="col-md-4 no-padding searchable text-center">
                                            <div class="groupGallery">
                                                <div class="video_box">
                                                    <video style='width: 100%' controls width="100%">
                                                        <source src='<?php echo $BaseUrl . '/upload/' . $sppostingmediaTitle; ?>' type="video/<?php echo $sppostingmediaExt; ?>">
                                                    </video>
                                                </div>
                                                <div class="btmFoot">
                                                    <p class="date"><?php echo $dt->format('d-M-Y'); ?></p>
                                                    <a class="name" href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows['spProfiles_idspProfiles']; ?>"><?php echo $NameOfProfile; ?></a>
                                                    <?php if ($admin == $_SESSION['pid']) { ?>
                                                        <a href="<?php echo $BaseUrl . '/post-ad/deletegrouppost.php?postid=' . $rows['idspPostings'] . '&;flag=1'; ?>"><i class="fa fa-trash"></i> Delete Post</a>

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

    <!-- Modal -->
    <div class="modal" tabindex="-1" id="videoUploading">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Video Uploading</h5>
                    <button type="button" class="btn-close btn-border-radius" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $BaseUrl; ?>/grouptimelines/upload_video.php?groupid=<?php echo $group_id; ?>&groupname=<?php echo $groupname; ?>&files&video" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="gid" name="gid" value="<?php echo $group_id; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">UPLOAD VIDEO :</label>
                            <input type="file" class="form-control" id="file" name="file" accept="video/mp4,video/x-m4v,video/*" style="display:block;">
                        </div><br>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="date" name="date" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <button style="margin-top: -12px;" type="submit" class="btn btn-primary pull-right btn-border-radius" name="upload">UPLOAD</button>
                        <button style="margin-top: -12px; margin-right:10px;" type="button" class="btn btn-danger pull-right btn-border-radius" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

    <script>
        var _gaq = [
            ['_setAccount', 'UA-XXXXX-X'],
            ['_trackPageview']
        ];
        (function(d, t) {
            var g = d.createElement(t),
                s = d.getElementsByTagName(t)[0];
            g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g, s)
        }(document, 'script'));
        // Colorbox Call
        $(document).ready(function() {
            $("[rel^='lightbox']").prettyPhoto();
        });
    </script>
    <!-- image gallery script end -->


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