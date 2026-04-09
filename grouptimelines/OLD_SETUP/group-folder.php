<?php

//die("==========");
ob_start();
include ('../univ/baseurl.php');
session_start();

function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
    include_once ("../authentication/check.php");
    $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&timeline";
}
include ('email_campaign/Classes/PHPExcel/IOFactory.php');
include ('../mlayer/emailCampaignUser.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group_inner.css">

    <?php include('../component/links.php'); ?>
    <link rel="stylesheet" href="https://unpkg.com/emoji-mart/css/emoji-mart.css">
    <script src="https://unpkg.com/emoji-mart/dist/emoji-mart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/emoji-mart/css/emoji-mart.css">
    <?php include ('../component/links.php'); ?>

    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

    <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">

    <script>
        function execute(settings) {
            $('#sidebar').hcSticky(settings);
        }
        // if page called directly
        jQuery(document).ready(function ($) {
            if (top === self) {
                execute({
                    top: 20,
                    bottom: 50
                });
            }
        });

        function execute_right(settings) {
            $('#sidebar_right').hcSticky(settings);
        }
        // if page called directly
        jQuery(document).ready(function ($) {
            if (top === self) {
                execute_right({
                    top: 20,
                    bottom: 50
                });
            }
        });
    </script>



</head>

<body onload="pageOnload('groupdd')" class="bg_gray">

    <?php

    include_once ("../header.php");

    $g = new _spgroup;
    $result = $g->groupdetails($group_id);
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $gimage = $row["spgroupimage"];
        $spGroupflag = $row['spgroupflag'];
    }
    ?>
    <?php

    $getPendingMembers = $g->joinedMembersOfGroup($group_id);

    if ($getPendingMembers != false) {
        $pendCounter = mysqli_num_rows($getPendingMembers);
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




    //}
    ?>


    <div class="modal fade" id="newfile" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content no-radius">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" class="tcenter" id="fileheader">Create a folder</h3>
                </div>
                <div class="modal-body">
                    <form action="folderinsert.php" method="POST" novalidate>
                        <input type="hidden" id="grpid" name="grpid" value="<?php echo $group_id; ?>" />
                        <input type="hidden" name="grpname" value="<?php echo $_GET["groupname"]; ?>">
                        <div class="row folder_form">

                            <div class="col-md-12">
                                <script type="text/javascript">
                                    function folderShow() {
                                        $("#hidDiv").hide();
                                        $("#shoDiv").show();
                                        $("#txtFoldTitle").focus();
                                    }
                                </script>
                                <?php
                                $profileid = $_SESSION['pid'];
                                $g = new _spgroup;
                                $pr = $g->admin_Member($profileid, $group_id);
                                if ($pr) {
                                    foreach ($pr as $key => $isAdmin) {
                                        $isAmdinha = $isAdmin['spProfileIsAdmin'];
                                        $isAssAdmin = $isAdmin['spAssistantAdmin'];
                                        if ($isAmdinha == 0 || $isAssAdmin == 1) { ?>
                                            <div class="form-group">

                                                <input type="hidden" name="txtFolerName" id="txtFolerName">
                                                <div id="hidDiv">

                                                </div>

                                                <input type="text" class="form-control" name="txtfoldername"
                                                    title="Type a folder name..." placeholder="Type a folder name..." maxlength="40"
                                                    required />
                                            </div>
                                            <?php
                                        }
                                    }
                                }

                                ?>

                            </div>

                            <div class="col-md-12" style="display: none;">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">
                                        <h4>File Title</h4>
                                    </label>
                                    <input type="text" class="form-control" id="mediatitle"
                                        title="Please fill this field..." maxlength="50" value="emp">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <input type="file" id="adddocument" class="spmedia" name="spPostingMedia[]"
                                        multiple="multiple" required>
                                </div>
                            </div>
                        </div>
                        <div id="media-container"></div>

                        <div class="modal-footer" class="uploadupdate">
                            <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal"
                                style="color:white;">Cancel</button>
                            <button type="sumbit" class="btn btn-primary btn-border-radius">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uloadfile" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content no-radius">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="fileheader">Upload New File</h3>
                </div>
                <div class="modal-body">
                    <form id="uploadFileForm" action="../myjobboard/addfiletofolder.php" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" id="grpid" name="grpid" value="<?php echo $group_id; ?>" />
                        <input type="hidden" id="profileid" name="profileid" value="<?php echo $_SESSION['pid']; ?>" />
                        <input type="hidden" id="grpName" name="grpName" value="<?php echo $_GET["groupname"]; ?>" />
                        <br>
                        <div class="row folder_form">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">
                                        <h4>Select Folder</h4>
                                    </label>
                                    <select class="form-control" name="txtFolerName" id="txtFolerName">
                                        <option value="">Select Folder</option>
                                        <?php
                                        $folder = isset($_GET['folder']) ? (int) $_GET['folder'] : 0;
                                        $spf = new _postingalbum;
                                        $result_fold2 = $spf->allfolder($group_id);
                                        if ($result_fold2) {
                                            while ($row2 = mysqli_fetch_assoc($result_fold2)) { ?>
                                                <option value="<?php echo $row2['spf_id']; ?>" <?php echo ($folder && $folder == $row2['spf_id']) ? 'selected' : '' ?>>
                                                    <?php echo $row2['spf_title']; ?>
                                                </option> <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <script type="text/javascript">
                                    function folderShow() {
                                        $("#hidDiv").hide();
                                        $("#shoDiv").show();
                                        $("#txtFoldTitle").focus();
                                    }
                                </script>
                                <?php


                                ?>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">
                                        <h4>File Title</h4>
                                    </label>
                                    <input type="text" class="form-control" id="mediatitle" name="mediatitle"
                                        maxlength="50" title="Please fill this field..."
                                        placeholder="Please enter filename" required>
                                </div>
                            </div>
                            <?php
                            if ($folder && $folder != '') {
                                $backUrl = $BaseUrl . "/grouptimelines/group-folder.php?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&files&folder=" . $folder;
                            } else {
                                $backUrl = $BaseUrl . "/grouptimelines/group-folder.php?groupid=" . $group_id . "&groupname=" . $_GET['groupname'] . "&files";
                            } ?>
                            <input type="hidden" name="backPageUrl" value="<?php echo $backUrl; ?>">
                            <div class="col-md-6">
                                <div class="form-group custom-file-upload">

                                    <input type="file" id="adddocument" style="display: block;" class="spmedia"
                                        name="spPostingMedia" required>
                                </div>
                            </div>
                        </div>
                        <div id="media-container"></div>

                        <div class="modal-footer" class="uploadupdate">
                            <button type="button" style="border-radius:5px;" class="btn btn-danger"
                                data-dismiss="modal">Close</button>
                            <button type="submit" style="border-radius:5px;" id="uploadfilemedia"
                                class="btn btn_blue">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--Adding new resume modal complete-->
    <section class="landing_page">
        <div class="container">
            <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

            <input type="hidden" id="grpid" value="<?php echo $group_id; ?>">
            <input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
            <input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['pid']; ?>">
            <div class="row">


                <div class="col-md-12">

                    <div class="group-wrapper">
                        <div class="side-bar" id="side-bar">
                            <?php include ('../component/left-group.php'); ?>
                        </div>
                        <div class="group-body-wrapper">
                            <div class="cover-img-wrapper">
                                <img src="../assets/images/inner_group/cover.svg" class="cover">
                                <div class="edit-icon">
                                    <img src="../assets/images/inner_group/edit-2.svg" alt="">
                                    <span>Edit</span>
                                </div>
                            </div>
                            <div class="business-networking">
                                <div class="main-heading">
                                    <div class="text-wrapper">
                                        <div class="top-heading">
                                            <?php echo $_GET["groupname"]; ?>
                                        </div>
                                        <div class="popup-detail">
                                            <div class="privacy">
                                                <span> <?php if ($spGroupflag == 1) {
                                                    echo '<h6><i class="fa fa-lock"></i> Private</h6>';
                                                } else {
                                                    echo '<h6><i class="fa fa-globe"></i> Public</h6>';
                                                } ?></span>
                                            </div>
                                            <span>.</span>
                                            <div class="member">
                                                <?php echo $pendCounter ?> Members
                                            </div>
                                        </div>
                                    </div>
                                    <div class="share-btn">
                                        <img src="../assets/images/inner_group/share-2.svg" alt="">
                                        Share
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="group-navigation">
                                    <div class="link border-0 active-link">FEEDS</div>
                                    <div class="link border-0">PHOTOS</div>
                                    <div class="link border-0">VIDEOS</div>
                                    <div class="link border-0">EVENTS</div>
                                    <div class="link border-0">DISCUSSIONS</div>
                                    <div class="link border-0">STORE</div>
                                    <div class="link border-0 ">FILES</div>
                                </div>
                                <div id="file_page" class="inner_pages">
                                        <?php include("../grouptimelines/grouptimelineform.php"); ?>
                                        <?php include("../publicpost/grouptimeline.php"); ?>
                                </div>
                                <div id="files_page" class="inner_pages d-none">
                                    <div class="files">
                                        <div class="heading-wrapper">
                                            <div class="main-heading">
                                                Folders
                                            </div>
                                            <div class="more-btn">
                                                <?php if ($admin_Id == $_SESSION['pid']) { ?>
                                                    <a href="#" class="text-decoration-none" data-toggle="modal"
                                                        data-target="#newfile" id="nwfile">
                                                        <div class="btn"> <img src="../assets/images/inner_group/add-4.svg"
                                                                alt="">
                                                            <span>Create Folder</span>
                                                        </div>

                                                    </a>
                                                <?php } ?>

                                                <a href="#" class="text-decoration-none" data-toggle="modal"
                                                    data-target="#uloadfile" id="uploadfile2">
                                                    <div class="btn"><img src="../assets/images/inner_group/add-4.svg"
                                                            alt="">
                                                        <span>Upload files</span>
                                                    </div>

                                                </a>
                                            </div>
                                        </div>
                                        <?php
                                        if (isset($_GET['restorefile']) && $_GET['restorefile'] > 0) {
                                            $spf = new _postingalbum;
                                            $result_fold = $spf->restore_files($_GET['restorefile']);
                                        }

                                        if (isset($_GET['restore']) && $_GET['restore'] > 0) {
                                            $spf = new _postingalbum;
                                            $result_fold = $spf->restore_folder($_GET['restore']);
                                        }

                                        if (isset($_GET['miscTrash']) && $group_id > 0) {
                                            include ('misctrash.php');
                                        } else if (isset($_GET['misc']) && $group_id > 0) {
                                            include ('miscellaneous.php');
                                        } else if (isset($_GET['trash']) && $group_id > 0) {
                                            include ('trash.php');
                                        } else if ($folder && $folder > 0) {

                                            include ('folder.php');
                                        } else if (isset($_GET['shared'])) {
                                            include ('shared.php');
                                        } else {

                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="table-responsive">
                                                                        <table class="table table_green_head tab_folder"
                                                                            style="margin-top: 15px;">
                                                                            <thead id="bgcl">
                                                                                <th>Folder Name</th>
                                                                                <th class="text-center">Files</th>
                                                                                <th class="text-center">Date</th>
                                                                                <th></th>
                                                                            </thead>
                                                                            <tbody>
                                                                    <?php
                                                                    //DELETE FOLDER FROM FOLDER START
                                                                    if (isset($_GET['delfolder']) && $_GET['delfolder'] > 0) {
                                                                        $spf = new _postingalbum;
                                                                        $result_fold = $spf->allfolder_dell($_GET['delfolder']);
                                                                    }
                                                                    //DELETE FOLDER FROM FOLDER END
                                                                    $spf = new _postingalbum;
                                                                    $result_fold = $spf->allfolder($group_id);
                                                                    //echo $spf->spf->sql;
                                                                    if ($result_fold) {
                                                                        // print_r(mysqli_fetch_assoc($result_fold));
                                                                        // exit;
                                                                        while ($row = mysqli_fetch_assoc($result_fold)) {
                                                                            $countfile = $spf->countfile($row['spf_id']);
                                                                            ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <a class="text-decoration-none"
                                                                                                    href="<?php echo $BaseUrl . '/grouptimelines/group-folder_old.php?groupid=' . $group_id . '&groupname=' . $_GET['groupname'] . '&files&folder=' . $row['spf_id']; ?>">
                                                                                                    <img class="me-2" style="max-width:24px"
                                                                                                        src="<?php echo $BaseUrl; ?>/assets/images/inner_group/folder.svg"
                                                                                                        -> <?php echo $row['spf_title']; ?>
                                                                                                </a>
                                                                                            </td>
                                                                                            <td class="text-center"><?php echo $countfile; ?></td>
                                                                                            <td class="text-center date-td">
                                                                                    <?php
                                                                                    $p = new _spprofiles;
                                                                                    $creatName = $p->read($row['spProfiles_idspProfiles']);

                                                                                    if ($creatName != false) {
                                                                                        $spf_rpr = mysqli_fetch_assoc($creatName);
                                                                                    } ?>
                                                                                                <div class="date">

                                                                                    <?php echo $row['spf_date']; ?>
                                                                                                </div>
                                                                                <?php if ($spf_rpr["spProfileName"]) { ?>
                                                                                                    <div class="title" style="font-size: 10px">
                                                                                                        By <a
                                                                                                            href="<?php echo $BaseUrl . '/friends/?profileid=' . $row['spProfiles_idspProfiles']; ?>"><?php echo $spf_rpr["spProfileName"]; ?></a>
                                                                                                    </div>
                                                                                <?php } ?>
                                                                                            </td>
                                                                                            <td class="action">
                                                                                    <?php
                                                                                    $profileid = $_SESSION['pid'];
                                                                                    $g = new _spgroup;
                                                                                    $pr = $g->admin_Member($profileid, $group_id);
                                                                                    if ($pr) {
                                                                                        foreach ($pr as $key => $isAdmin) {
                                                                                            $isAmdinha = $isAdmin['spProfileIsAdmin'];
                                                                                            $isAssAdmin = $isAdmin['spAssistantAdmin'];
                                                                                        }
                                                                                        if ($isAmdinha == 0 || $isAssAdmin == 1) { ?>
                                                                                                        <img src="../assets/images/inner_group/dot-2.svg"
                                                                                                            alt="" class="" onclick="threeDot(this)">
                                                                                                        <div class="more-links " id="three-dot"
                                                                                                            style="display: none;">


                                                                                                            <div class="link ">
                                                                                                                <a href="#" id="folderView" class="dellink"
                                                                                                                    data-toggle="modal"
                                                                                                                    data-target="#updatefile<?php echo $row['spf_id'] ?>">
                                                                                                                    <span class="img">
                                                                                                                        <img src="../assets/images/inner_group/delete.svg"
                                                                                                                            alt="">
                                                                                                                    </span>
                                                                                                                    <span>Rename</span></a>


                                                                                                            </div>
                                                                                                            <div class="link">
                                                                                                                <input type="hidden" name=""
                                                                                                                    value="<?php echo $BaseUrl . '/grouptimelines/group-folder.php?groupid=' . $group_id . '&groupname=' . $_GET['groupname'] . '&files&delfolder=' . $row['spf_id']; ?>"
                                                                                                                    id="txtDelfold<?php echo $row['spf_id'] ?>" />
                                                                                                                <a href="javascript:void(0)"
                                                                                                                    id="folderDel<?php echo $row['spf_id'] ?>"
                                                                                                                    onclick="fol_del(<?php echo $row['spf_id']; ?>)">
                                                                                                                    <span class="img">
                                                                                                                        <img src="../assets/images/inner_group/edit-3.svg"
                                                                                                                            alt="">
                                                                                                                    </span>
                                                                                                                    <span>Delete</span>
                                                                                                                </a>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="modal fade"
                                                                                                            id="updatefile<?php echo $row['spf_id'] ?>"
                                                                                                            tabindex="-1" role="dialog"
                                                                                                            aria-labelledby="resumeModalLabel">
                                                                                                            <div class="modal-dialog" role="document">
                                                                                                                <div class="modal-content no-radius">
                                                                                                                    <div class="modal-header">
                                                                                                                        <button type="button" class="close"
                                                                                                                            data-dismiss="modal"
                                                                                                                            aria-label="Close"><span
                                                                                                                                aria-hidden="true">&times;</span></button>
                                                                                                                        <h3 class="modal-title text-left"
                                                                                                                            id="fileheader">Update Folder
                                                                                                                            Name</h3>
                                                                                                                    </div>
                                                                                                                    <div class="modal-body">
                                                                                                                        <form class="">
                                                                                                                            <input type="hidden"
                                                                                                                                id="txtGroupId"
                                                                                                                                value="<?php echo $group_id; ?>" />
                                                                                                                            <input type="hidden"
                                                                                                                                id="txtFolderId<?php echo $row['spf_id'] ?>"
                                                                                                                                value="<?php echo $row['spf_id']; ?>" />
                                                                                                                            <!--Choose your new Resume-->
                                                                                                                            <br>
                                                                                                                            <div
                                                                                                                                class="row folder_form text-left">
                                                                                                                                <div class="col-md-12">
                                                                                                                                    <div class="form-group">
                                                                                                                                        <label
                                                                                                                                            for="recipient-name"
                                                                                                                                            class="control-label text-left">Rename
                                                                                                                                            Folder
                                                                                                                                            Name</label>
                                                                                                                                        <input type="text"
                                                                                                                                            class="form-control"
                                                                                                                                            id="txtFolderTitle<?php echo $row['spf_id'] ?>"
                                                                                                                                            value="<?php echo $row['spf_title'] ?>"
                                                                                                                                            required />
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <!-- Choose resume code complete -->
                                                                                                                            <div class="modal-footer"
                                                                                                                                class="uploadupdate">
                                                                                                                                <button type="button"
                                                                                                                                    class="btn btn-danger"
                                                                                                                                    data-dismiss="modal">Close</button>
                                                                                                                                <button type="button"
                                                                                                                                    id="updateFolderFile<?php echo $row['spf_id'] ?>"
                                                                                                                                    class="btn btn-primary">Update</button>
                                                                                                                            </div>
                                                                                                                        </form>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <script type="text/javascript">
                                                                                                            //Update folder Name
                                                                                                            $("#updateFolderFile<?php echo $row['spf_id'] ?>").on("click", function () {

                                                                                                                var txtGroupId = document.getElementById("txtGroupId").value;
                                                                                                                var txtFolderId = document.getElementById("txtFolderId<?php echo $row['spf_id'] ?>").value;
                                                                                                                var txtFolderTitle = document.getElementById("txtFolderTitle<?php echo $row['spf_id'] ?>").value;

                                                                                                                $.post("../myjobboard/updateresume.php", {
                                                                                                                    txtGroupId: txtGroupId,
                                                                                                                    txtFolderId: txtFolderId,
                                                                                                                    txtFolderTitle: txtFolderTitle
                                                                                                                }, function () {
                                                                                                                    location.reload();
                                                                                                                    $(".modal").modal('hide');

                                                                                                                });

                                                                                                            })
                                                                                                        </script>
                                                                                        <?php
                                                                                        }
                                                                                    }


                                                                                    ?>
                                                                                            </td>
                                                                                        </tr>
                                                                        <?php

                                                                        }
                                                                    }
                                                                    $countMiscFile = $spf->countMiscFile($group_id);
                                                                    $countTrashFile = $spf->countTrashFolder($group_id);
                                                                    ?>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>

                                            <?php
                                        } ?>
                                    </div>
                                </div>
                                <div id="vedio_page" class="inner_pages d-none">
                                    <div class="files">
                                        <?php include ('../grouptimelines/group-video.php'); ?>

                                    </div>
                                </div>
                                <div id="photo_page" class="inner_pages d-none">
                                    <div class="files">
                                        <?php include ('../grouptimelines/group-photo.php'); ?>
                                    </div>
                                </div>
                                <div id="vedio_page" class="inner_pages d-none">
                                    <div class="files">
                                        <?php include ('../grouptimelines/discussion-board.php'); ?>
                                    </div>
                                </div>
                                <div id="event_page" class="inner_pages d-none">
                                    <div class="files">
                                        <?php include('../grouptimelines/group-event.php'); ?>

                                    </div>
                                </div>
                                <div id="photo_page" class="inner_pages d-none">
                                    <div class="files">
                                        <?php include('../grouptimelines/group-store.php'); ?>

                               
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
        </div>

        </div>
        </div>
    </section>
    <script src="https://unpkg.com/emoji-mart/dist/emoji-mart.js"></script>

    <script type="text/javascript">
        var hostUrl = window.location.host;
        var hostSchema = window.location.protocol;
        var MAINURL = hostSchema + '//' + hostUrl;

        $("#uploadfile").on("click", function () {

            var time = new Date();
            var d = $.datepicker.formatDate("dd M", new Date());
            /*alert($("#mediatitle").val())*/
            if ($("#mediatitle").val() != "") {


                var txtFolerName = document.getElementById("txtFolerName").value;
                if (txtFolerName == "") {
                    var txtFoldTitle = document.getElementById("txtFoldTitle").value;
                } else {
                    var txtFoldTitle = "";
                }


                $.post("../myjobboard/addgroupfile.php", {
                    txtFolerName: txtFolerName,
                    txtFoldTitle: txtFoldTitle,
                    mediatitle: $("#mediatitle").val(),
                    profileid: $(".dynamic-pid").val(),
                    groupid: $("#grpid").val()
                }, function (r) {

                    location.reload();

                });
            }

        });



        $("#uploadfilemedia").on("click", function () {

            var time = new Date();
            var d = $.datepicker.formatDate("dd M", new Date());

            if ($("#adddocument").val() != "" && $("#mediatitle").val() != "") {

                $(".media-file-data").each(function (i, e) {
                    var base64image = $(e).attr("data-media");
                    var arr = base64image.match(/data:[a-zA-Z0-9 -/]+;/);
                    var ext = arr[0].replace("data:", "");

                    var txtFolerName = document.getElementById("txtFolerName").value;
                    if (txtFolerName == "") {
                        var txtFoldTitle = document.getElementById("txtFoldTitle").value;
                    } else {
                        var txtFoldTitle = "";
                    }


                    $.post("../myjobboard/addgroupfile.php", {
                        txtFolerName: txtFolerName,
                        txtFoldTitle: txtFoldTitle,
                        spPostingMedia: base64image,
                        ext: ext,
                        mediatitle: $("#mediatitle").val(),
                        profileid: $(".dynamic-pid").val(),
                        filename: $("#adddocument").val(),
                        groupid: $("#grpid").val()
                    }, function (r) {

                        var mediaid = r;
                        mediaid = mediaid.trim();
                        $.post('../grouptimelines/priviewfile.php', {
                            mediaid: mediaid
                        }, function (response) {
                            var previewfile = response;

                            $('.table > tbody:last').append("<tr class='resumeoperation'><td width='72%' data-toggle='modal' data-target='#previewfile' data-src='" + mainUrl + "/resume/" + previewfile.trim() + "' class='preview'><a href='#'>" + $("#mediatitle").val() + "</a></td><td width='10%'><b>" + $(".dynamic-profilename").val() + "</b></td><td width='10%'>" + d + " " + time.getHours() + ":" + time.getMinutes() + "</td><td width='2%'><a href='" + mainUrl + "/resume/" + previewfile.trim() + "'  ata-toggle='tooltip' data-placement='left' title='Download'><span class='glyphicon glyphicon-download'  ></span></a></td><td width='6%'><button type='button' class='btn btn-link deleteresume' data-mediaid='" + mediaid + "'><span class='glyphicon glyphicon-trash'></span> Delete</td></tr>");
                            $('#newfile').modal('toggle');
                            location.reload();
                        });
                    });
                });
            }

        });
    </script>
    <script src='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.min.js'></script>

    <script>
        function fol_del(mm) {

            swal({
                title: "Are you sure to delete?",
                type: "warning",
                confirmButtonClass: "sweet_ok",
                confirmButtonText: "Yes",
                cancelButtonClass: "sweet_cancel",
                cancelButtonText: "No",
                showCancelButton: true,
            }, function (isConfirm) {
                if (isConfirm) {

                    $.post("../social/deletefol.php", {

                        id: mm
                    }, function (response) {
                        window.location.reload();
                    });



                }
            });
        }
    </script>


    <div class="modal" tabindex="-1" id="videoUploading">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Video Uploading</h5>
                    <button type="button" class="btn-close btn-border-radius" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form
                        action="<?php echo $BaseUrl; ?>/grouptimelines/upload_video.php?groupid=<?php echo $group_id; ?>&groupname=<?php echo $groupname; ?>&files&video"
                        method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="gid" name="gid"
                                value="<?php echo $group_id; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">UPLOAD VIDEO :</label>
                            <input type="file" class="form-control" id="file" name="file"
                                accept="video/mp4,video/x-m4v,video/*" style="display:block;">
                        </div><br>
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="date" name="date"
                                value="<?php echo date("Y-m-d"); ?>">
                        </div>
                        <button style="margin-top: -12px;" type="submit"
                            class="btn btn-primary pull-right btn-border-radius" name="upload">UPLOAD</button>
                        <button style="margin-top: -12px; margin-right:10px;" type="button"
                            class="btn btn-danger pull-right btn-border-radius" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include ('../component/footer.php'); ?>
    <?php include ('../component/btm_script.php'); ?> <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->


</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('.group-navigation .link');
        const contentDivs = document.querySelectorAll('.inner_pages');

        // Function to show the content div corresponding to the active link
        const showActiveContent = () => {
            const activeLinkIndex = [...links].findIndex(link => link.classList.contains('active-link'));
            if (activeLinkIndex !== -1) {
                contentDivs.forEach(div => div.classList.add('d-none'));
                contentDivs[activeLinkIndex].classList.remove('d-none');
            }
        };

        // Add click event listeners to each link
        links.forEach((link, index) => {
            link.addEventListener('click', function () {
                // Remove active-link class from all links
                links.forEach(link => link.classList.remove('active-link'));

                // Add active-link class to the clicked link
                this.classList.add('active-link');

                // Show the content div corresponding to the clicked link
                showActiveContent();
            });
        });

        // Initial setup to show the active content div
        showActiveContent();
    });
    let currentlyOpen = null;

    function threeDot(dotElement) {
        const moreLinks = dotElement.nextElementSibling;
        if (currentlyOpen && currentlyOpen !== moreLinks) {
            currentlyOpen.style.display = 'none';
        }
        if (moreLinks.style.display === 'none' || moreLinks.style.display === '') {
            moreLinks.style.display = 'block';
            currentlyOpen = moreLinks;
        } else {
            moreLinks.style.display = 'none';
            currentlyOpen = null;
        }
    }

    document.addEventListener('click', function (event) {
        if (currentlyOpen && !event.target.closest('div')) {
            currentlyOpen.style.display = 'none';
            currentlyOpen = null;
        }
    });
</script>