<?php
include('../univ/baseurl.php');


ob_start();
session_start();
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

include('../univ/main.php');
$dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}


spl_autoload_register("sp_autoloader");

include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');
$getid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;

$obj = new _spAllStoreForm;
$ress = $obj->readdatabyid($getid);
if ($ress != "") {
    $roww = mysqli_fetch_assoc($ress);
}
$pid = $_SESSION['pid'];


$obj2 = new _spAllStoreForm;
$ress2 = $obj2->readdatabymulid($getid, $pid);



?>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<?php
if (isset($_GET['grouptimelinePage']) && $_GET['grouptimelinePage'] == 'yes') {
} else { ?>
    <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<?php } ?>

<style>
    .left_grid ul li a p {
        margin-left: 35px;
    }

    .modal-title {
        font-family: Marksimon;
        font-size: none;
    }

    .left_group_gr {
        background-color: #fff;
        padding-left: 10px;
        padding-top: 5px;
        padding-bottom: 10px;
        border-radius: 15px;
        margin-top: 0px;
    }

    .hid_input {
        display: none !important;
    }
</style>
<?php
include('../univ/main.php');
$dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
?>
<div class="w-100">

    <?php


    $group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
    $g = new _spgroup;
    if (isset($group_id)) {
        $result_grp_admin = $g->readgroupAdmin($group_id);
        if ($result_grp_admin != false) {

            $row_grp_admin = mysqli_fetch_assoc($result_grp_admin);
            $admin_profile = $row_grp_admin['spProfilePic'];

            $admin_Id = $row_grp_admin['idspProfiles'];
            $admin_Name = $row_grp_admin['spProfileName'];
            $create_date111 = $row_grp_admin['CreatedDate'];

            $admin_ptype = $row_grp_admin['spProfileType_idspProfileType'];
        }

        $result_ismember = $g->ismember($group_id, $_SESSION['pid']);
        if ($result_ismember != false) {
            $row_ismember = mysqli_fetch_assoc($result_ismember);
            $profile_exist = $row_ismember['spProfiles_idspProfiles'];
            $approve =   $row_ismember['spApproveRegect'];
        }
    }


    $p      = new _spgroup_event;


    $res  = $p->publicgroup_event($group_id);

    if ($res != false) {


        $row = mysqli_fetch_assoc($res);


        $adminprofileid = $row['spProfiles_idspProfiles'];
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group_inner.css">

        <?php include('../component/links.php'); ?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            jQuery(document).ready(function($) {
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
            jQuery(document).ready(function($) {
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            <?php


            $group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
            $g = new _spgroup;
            if (isset($group_id)) {
                $result_grp_admin = $g->readgroupAdmin($group_id);
                if ($result_grp_admin != false) {

                    $row_grp_admin = mysqli_fetch_assoc($result_grp_admin);
                    $admin_profile = $row_grp_admin['spProfilePic'];

                    $admin_Id = $row_grp_admin['idspProfiles'];
                    $admin_Name = $row_grp_admin['spProfileName'];
                    $create_date111 = $row_grp_admin['CreatedDate'];

                    $admin_ptype = $row_grp_admin['spProfileType_idspProfileType'];
                }

                $result_ismember = $g->ismember($group_id, $_SESSION['pid']);
                if ($result_ismember != false) {

                    $row_ismember = mysqli_fetch_assoc($result_ismember);

                    $profile_exist = $row_ismember['spProfiles_idspProfiles'];

                    $approve =   $row_ismember['spApproveRegect'];
                }
            }


            $p      = new _spgroup_event;


            $res  = $p->publicgroup_event($group_id);

            if ($res != false) {

                $row = mysqli_fetch_assoc($res);

                $adminprofileid = $row['spProfiles_idspProfiles'];
            }

            ?>
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-toggle="popover"]').popover({
                    placement: 'left'
                });
            });
        </script>


        <script>
            function selectNewFolder() {
                var x = document.getElementById("txtFolerName").value;
                if (x == 'New') {
                    document.getElementById("txtDisable").style.display = "none";
                    document.getElementById("txtFoldTitle").style.display = "inline";
                } else {
                    document.getElementById("txtDisable").style.display = "inline";
                    document.getElementById("txtFoldTitle").style.display = "none";
                }
            }
        </script>
    </head>

    <body onload="pageOnload('groupdd')" class="bg_gray">
        <?php

        include_once("../header.php");


        if (!isset($_SESSION['pid'])) {
            include_once("../authentication/check.php");
            $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $getid . "&groupname=" . $_GET['groupname'] . "&timeline";
        }
        $g = new _spgroup;
        $result = $g->groupdetails($getid);
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);

            $gimage = $row["spgroupimage"];
            $spGroupflag = $row['spgroupflag'];
        }
        $idspProfiles = $row['spProfiles_idspProfiles'];

        ?>


        <section class="landing_page">
            <div class="container">
                <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

                <input type="hidden" id="grpid" value="<?php echo $getid; ?>">
                <input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
                <input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
                <div class="row">


                    <div class="col-md-12">


                        <div class="group-wrapper">
                            <div class="side-bar" id="side-bar">
                                <?php include('../component/left-group.php'); ?>
                            </div>
                            <div class="group-body-wrapper">
                                <div class="setting">
                                    <div class="main-heading">
                                        <div class="top-heading">
                                            Asst Admin Rights
                                        </div>
                                    </div>
                                    <div class="tag">
                                        <div class="text">Can Create discussion topics. </div>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="tag">
                                        <div class="text">Remove Members</div>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="tag">
                                        <div class="text">Send email campaigns</div>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                    <div class="tag">
                                        <div class="text">Add announcements</div>
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>

                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </section>
        <script src="script.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



        <?php include('../component/footer.php'); ?>
        <?php include('../component/btm_script.php'); ?>

    </body>

    </html>