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
                                    <?php if ($_GET['msg'] == "update") {
                                    ?>
                                        <div class="alert alert-success" id="alert1" style="margin-left: 218px;margin-right:17px" onload="setTimeout()" role="alert">
                                            Group Page Update Successfully!
                                        </div>

                                    <?php    }

                                    ?>
                                    <div class="main-heading">
                                        <div class="top-heading">
                                            Setting
                                        </div>
                                    </div>
                                    <div class="tag" data-bs-toggle="modal" data-bs-target="#change-name-desc">
                                        <div class="text">Name and Description</div>
                                        <span><img src="../assets/images/inner_group/edit-4.svg" alt=""></span>
                                    </div>
                                    <div class="tag" data-toggle="modal" data-target="#change_privacy">
                                        <div class="text">Group Privacy</div>
                                        <span><img src="../assets/images/inner_group/edit-4.svg" alt=""></span>
                                    </div>
                                    <div class="tag">
                                        <div class="text">Group Rules</div>
                                        <span><img src="../assets/images/inner_group/edit-4.svg" alt=""></span>
                                    </div>

                                    <div class="tag" data-toggle="modal" data-target="#change_Location">
                                        <div class="text">Location</div>
                                        <span><img src="../assets/images/inner_group/edit-4.svg" alt=""></span>
                                    </div>
                                    <div class="tag">
                                        <div class="text">Asst Admin Rights</div>

                                        <a href="<?php echo $BaseUrl ?>/grouptimelines/asst-admin-setting.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&asst">
                                            <span><img src="../assets/images/inner_group/edit-4.svg" alt=""></span>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </section>
        <div class="modal add-album-modal" id="change-name-desc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Group <?php echo $_GET['groupname'] ?></h1>
                    </div>
                    <div class="modal-body">
                        <form id="address" action="uploadgroupbanner.php" method="post" enctype="multipart/form-data">
                            <div class="input-group in-1-col">
                                <label>Name<span style="color: #EF1D26;">*</span></label>
                                <input type="hidden" name="gname" value="<?php echo $_GET['groupname']; ?>">
                                <input type="text" id="gname" maxlength="25" name="gname" onkeyup="clearerror();" value="<?php echo $_GET['groupname']; ?>" class="form-control " required>
                                <span style="color:red; font-size:12px" id="msg1"></span>
                            </div>
                            <div class="input-group in-1-col">
                                <label>Description<span style="color: #EF1D26;">*</span></label>

                                <textarea onkeyup="clearerror();" id="spGroupAbout" name="spGroupAbout" rows="6" cols="50" required>

                                     <?php
                                        echo $spGroupAbout;
                                        ?>

                                     </textarea>
                                <span style="color:red;font-size:12px" id="msg9"></span>
                            </div>
                            <div class=" hid_input modal-body">




                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <?php
                                        $res = $g->read($group_id);
                                        if ($res != false) {
                                            $ruser = mysqli_fetch_assoc($res);
                                            $spUserCountry = $ruser["spUserCountry"];
                                            $spUserState = $ruser["spUserState"];
                                            $spUserCity = $ruser["spUserCity"];
                                            $address = $ruser["address"];
                                            $zipcode = $ruser["zipcode"];
                                            $spgroupflag1 = $ruser["spgroupflag"];
                                            $spGroupAbout = $ruser["spGroupAbout"];
                                        }
                                        ?>

                                        <input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
                                        <div class="form-group">

                                            <label for="spProfilesCountry" class="add_shippinglabel">
                                                <h4 style="color:#333333">Country <span style="font-size:12px" class="red">*</span></h4>
                                            </label>
                                            <select id="spUserCountry_default_address" class="form-control " name="spUserCountry" required>
                                                <option value="0">Select Country</option>
                                                <?php
                                                $co = new _country;
                                                $result3 = $co->readCountry();
                                                if ($result3 != false) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                ?>
                                                        <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id']) ? 'selected' : ''; ?>>
                                                            <?php echo $row3['country_title']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span style="font-size:12px" class="red" id="msg2"></span>
                                            <span id="shippcounrty_error" style="color:red;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="loadUserState">
                                                <label for="spUserState" class="add_shippinglabel">
                                                    <h4 style="color:#333333">State <span style="font-size:12px" class="red">*</span></h4>
                                                </label>
                                                <select class="form-control" name="spUserState" id="spUserState" required>
                                                    <option value="0">Select State</option>
                                                    <?php

                                                    $pr = new _state;
                                                    $result2 = $pr->readState($spUserCountry);
                                                    if ($result2 != false) {
                                                        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                            <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                                                    <?php
                                                        }
                                                    }
                                                    //  }
                                                    ?>
                                                </select><span style="font-size:12px" class="red" id="msg3"></span>
                                                <span id="shippstate_error" style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="loadCity">
                                                <label class="add_shippinglabel" for="spUserCity">
                                                    <h4 style="color:#333333">City <span style="font-size:12px" class="red">*</span></h4>
                                                </label>
                                                <select class="form-control" name="spUserCity" id="spUserCity" required>
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $co = new _city;
                                                    $result3 = $co->readCity($spUserState);
                                                    if ($result3 != false) {
                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            //    } 
                                                                                                                                                                                                                                                    ?>
                                                </select>
                                                <span style="font-size:12px" class="red" id="msg4"></span>
                                                <span id="shippcity_error" style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="add_shippinglabel" for="shipp_zipcode">
                                                <h4 style="color:#333333">Zipcode (Max 6 Characters) <span style="color:red;font-size:12px">*</span></h4>
                                            </label>
                                            <input type="text" class="form-control" maxlength="8" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>" required>
                                            <span style="color:red;font-size:12px" id="msg6"></span>
                                            <span id="shippzipcode_error" style="color:red;"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <h4>Select Privacy</h4>
                                        <div id=""></div>


                                        <div class="form-control bg_gray_light no-radius ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag1 == 0) {
                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                } ?>>Public</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag1 == 1) {
                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                } ?>>Private</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="groupid" value="<?= $group_id; ?>">
                                        <h4>Short Description (Max 50 words) <span style="color:red;font-size:12px">*</span></h4>
                                        <div id=""></div>


                                        <input type="text" class="form-control " id="spGroupTagline" name="spGroupTag" maxlength="50" value="<?php echo $row['spGroupTagline']; ?>" required>
                                        <span style="color:red;font-size:12px" id="msg7"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <h4>Group Category <span style="color:red;font-size:12px">*</span></h4>
                                        <div id=""></div>
                                        <select class="form-control " onclick="clearerror();" id="grpcategory" name="spgroupCategory" required>
                                            <option value="<?php echo $id; ?>">Select Category </option>

                                            <?php
                                            $g = new _spgroup;
                                            $result = $g->groupdetails($group_id);
                                            if ($result != false) {
                                                $row = mysqli_fetch_assoc($result);
                                                $spgroupCategory = $row['spgroupCategory'];
                                            }

                                            $sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


                                            $result = mysqli_query($dbConn, $sql);
                                            if ($result) {
                                                while ($rows = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <?php echo $spgroupCategory;
                                                    ?>
                                                    <option value='<?php echo $rows['id']; ?>' <?php if ($spgroupCategory == $rows["id"]) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                        <?php echo $rows["group_category_name"]; ?>
                                                    </option>


                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                        <span style="color:red;font-size:12px" id="msg8"></span>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <h4>Choose your banner <span style="color:red;font-size:12px" id="msg10">*</span></h4>
                                        <div id=""></div>
                                        <input type="file" name="bannerfile" onchange="readURL(this);" class="basestorebanner" id="basestorebannerid" style="display: block;" />
                                        <input type="hidden" id="spProfileId" value="<?php echo  $profileId; ?>">
                                        <input type="hidden" id="spuserId" value="<?php echo $spUserid; ?>">
                                        <input type="hidden" id="sgroupid" value="<?php echo $group_id ?>">
                                        <span id="bannerfile_error" class="red"></span>

                                    </div>
                                    <?php
                                    $g = new _spgroup;
                                    $result = $g->groupdetails($group_id);
                                    if ($result != false) {
                                        $row = mysqli_fetch_assoc($result);

                                        $bannerpicture = $row["spgroupimage"];
                                    }
                                    ?>
                                    <div class=" hid_input col-md-6">
                                        <h4>Your selected banner will appear here...</h4>
                                        <div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">
                                            <?php if ($bannerpicture) { ?>
                                                <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">
                                            <?php } else { ?>
                                                <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg " alt="Profile Pic22" class="img-responsive" style="width: 100%;height:175px;">

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" style="background-color: #7649B3; color : white;">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal add-album-modal" id="change_privacy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Privacy <?php echo $_GET['groupname'] ?></h1>
                    </div>
                    <div class="modal-body">
                        <form id="address" action="uploadgroupbanner.php" method="post" enctype="multipart/form-data">
                            <div class="hid_input input-group in-1-col">
                                <label>Name<span style="color: #EF1D26;">*</span></label>
                                <input type="hidden" name="gname" value="<?php echo $_GET['groupname']; ?>">
                                <input type="hidden" type="text" id="gname" maxlength="25" name="gname" onkeyup="clearerror();" value="<?php echo $_GET['groupname']; ?>" class="form-control " required>
                                <span style="color:red; font-size:12px" id="msg1"></span>
                            </div>
                            <div class=" hid_input input-group in-1-col">
                                <label>Description<span style="color: #EF1D26;">*</span></label>

                                <textarea type="hidden" onkeyup="clearerror();" id="spGroupAbout" name="spGroupAbout" rows="6" cols="50" required>

                                     <?php
                                        echo $spGroupAbout;
                                        ?>

                                     </textarea>
                                <span style="color:red;font-size:12px" id="msg9"></span>
                            </div>
                            <div class=" hid_input modal-body">




                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <?php
                                        $res = $g->read($group_id);
                                        if ($res != false) {
                                            $ruser = mysqli_fetch_assoc($res);
                                            $spUserCountry = $ruser["spUserCountry"];
                                            $spUserState = $ruser["spUserState"];
                                            $spUserCity = $ruser["spUserCity"];
                                            $address = $ruser["address"];
                                            $zipcode = $ruser["zipcode"];
                                            $spgroupflag1 = $ruser["spgroupflag"];
                                            $spGroupAbout = $ruser["spGroupAbout"];
                                        }
                                        ?>

                                        <input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
                                        <div class="form-group">

                                            <label for="spProfilesCountry" class="add_shippinglabel">
                                                <h4 style="color:#333333">Country <span style="font-size:12px" class="red">*</span></h4>
                                            </label>
                                            <select id="spUserCountry_default_address" class="form-control " name="spUserCountry" required>
                                                <option value="0">Select Country</option>
                                                <?php
                                                $co = new _country;
                                                $result3 = $co->readCountry();
                                                if ($result3 != false) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                ?>
                                                        <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id']) ? 'selected' : ''; ?>>
                                                            <?php echo $row3['country_title']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span style="font-size:12px" class="red" id="msg2"></span>
                                            <span id="shippcounrty_error" style="color:red;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="loadUserState">
                                                <label for="spUserState" class="add_shippinglabel">
                                                    <h4 style="color:#333333">State <span style="font-size:12px" class="red">*</span></h4>
                                                </label>
                                                <select class="form-control" name="spUserState" id="spUserState" required>
                                                    <option value="0">Select State</option>
                                                    <?php

                                                    $pr = new _state;
                                                    $result2 = $pr->readState($spUserCountry);
                                                    if ($result2 != false) {
                                                        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                            <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                                                    <?php
                                                        }
                                                    }
                                                    //  }
                                                    ?>
                                                </select><span style="font-size:12px" class="red" id="msg3"></span>
                                                <span id="shippstate_error" style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="loadCity">
                                                <label class="add_shippinglabel" for="spUserCity">
                                                    <h4 style="color:#333333">City <span style="font-size:12px" class="red">*</span></h4>
                                                </label>
                                                <select class="form-control" name="spUserCity" id="spUserCity" required>
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $co = new _city;
                                                    $result3 = $co->readCity($spUserState);
                                                    if ($result3 != false) {
                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            //    } 
                                                                                                                                                                                                                                                    ?>
                                                </select>
                                                <span style="font-size:12px" class="red" id="msg4"></span>
                                                <span id="shippcity_error" style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="add_shippinglabel" for="shipp_zipcode">
                                                <h4 style="color:#333333">Zipcode (Max 6 Characters) <span style="color:red;font-size:12px">*</span></h4>
                                            </label>
                                            <input type="text" class="form-control" maxlength="8" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>" required>
                                            <span style="color:red;font-size:12px" id="msg6"></span>
                                            <span id="shippzipcode_error" style="color:red;"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <h4>Select Privacy</h4>
                                        <div id=""></div>


                                        <div class="form-control bg_gray_light no-radius ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag1 == 0) {
                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                } ?>>Public</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag1 == 1) {
                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                } ?>>Private</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="groupid" value="<?= $group_id; ?>">
                                        <h4>Short Description (Max 50 words) <span style="color:red;font-size:12px">*</span></h4>
                                        <div id=""></div>


                                        <input type="text" class="form-control " id="spGroupTagline" name="spGroupTag" maxlength="50" value="<?php echo $row['spGroupTagline']; ?>" required>
                                        <span style="color:red;font-size:12px" id="msg7"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <h4>Group Category <span style="color:red;font-size:12px">*</span></h4>
                                        <div id=""></div>
                                        <select class="form-control " onclick="clearerror();" id="grpcategory" name="spgroupCategory" required>
                                            <option value="<?php echo $id; ?>">Select Category </option>

                                            <?php
                                            $g = new _spgroup;
                                            $result = $g->groupdetails($group_id);
                                            if ($result != false) {
                                                $row = mysqli_fetch_assoc($result);
                                                $spgroupCategory = $row['spgroupCategory'];
                                            }

                                            $sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


                                            $result = mysqli_query($dbConn, $sql);
                                            if ($result) {
                                                while ($rows = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <?php echo $spgroupCategory;
                                                    ?>
                                                    <option value='<?php echo $rows['id']; ?>' <?php if ($spgroupCategory == $rows["id"]) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                        <?php echo $rows["group_category_name"]; ?>
                                                    </option>


                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                        <span style="color:red;font-size:12px" id="msg8"></span>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <h4>Choose your banner <span style="color:red;font-size:12px" id="msg10">*</span></h4>
                                        <div id=""></div>
                                        <input type="file" name="bannerfile" onchange="readURL(this);" class="basestorebanner" id="basestorebannerid" style="display: block;" />
                                        <input type="hidden" id="spProfileId" value="<?php echo  $profileId; ?>">
                                        <input type="hidden" id="spuserId" value="<?php echo $spUserid; ?>">
                                        <input type="hidden" id="sgroupid" value="<?php echo $group_id ?>">
                                        <span id="bannerfile_error" class="red"></span>

                                    </div>
                                    <?php
                                    $g = new _spgroup;
                                    $result = $g->groupdetails($group_id);
                                    if ($result != false) {
                                        $row = mysqli_fetch_assoc($result);

                                        $bannerpicture = $row["spgroupimage"];
                                    }
                                    ?>
                                    <div class=" hid_input col-md-6">
                                        <h4>Your selected banner will appear here...</h4>
                                        <div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">
                                            <?php if ($bannerpicture) { ?>
                                                <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">
                                            <?php } else { ?>
                                                <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg " alt="Profile Pic22" class="img-responsive" style="width: 100%;height:175px;">

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <h4>Select Privacy</h4>
                                <div id=""></div>


                                <div class="form-control bg_gray_light no-radius ">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag1 == 0) {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        } ?>>Public</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag1 == 1) {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        } ?>>Private</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" style="background-color: #7649B3; color : white;">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal add-album-modal" id="change_Location" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Privacy <?php echo $_GET['groupname'] ?></h1>
                    </div>
                    <div class="modal-body">
                        <form id="address" action="uploadgroupbanner.php" method="post" enctype="multipart/form-data">
                            <div class="hid_input input-group in-1-col">
                                <label>Name<span style="color: #EF1D26;">*</span></label>
                                <input type="hidden" name="gname" value="<?php echo $_GET['groupname']; ?>">
                                <input type="hidden" type="text" id="gname" maxlength="25" name="gname" onkeyup="clearerror();" value="<?php echo $_GET['groupname']; ?>" class="form-control " required>
                                <span style="color:red; font-size:12px" id="msg1"></span>
                            </div>
                            <div class=" hid_input input-group in-1-col">
                                <label>Description<span style="color: #EF1D26;">*</span></label>

                                <textarea type="hidden" onkeyup="clearerror();" id="spGroupAbout" name="spGroupAbout" rows="6" cols="50" required>

                                     <?php
                                        echo $spGroupAbout;
                                        ?>

                                     </textarea>
                                <span style="color:red;font-size:12px" id="msg9"></span>
                            </div>
                            <div class=" hid_input modal-body">




                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                        $res = $g->read($group_id);
                                        if ($res != false) {
                                            $ruser = mysqli_fetch_assoc($res);
                                            $spUserCountry = $ruser["spUserCountry"];
                                            $spUserState = $ruser["spUserState"];
                                            $spUserCity = $ruser["spUserCity"];
                                            $address = $ruser["address"];
                                            $zipcode = $ruser["zipcode"];
                                            $spgroupflag1 = $ruser["spgroupflag"];
                                            $spGroupAbout = $ruser["spGroupAbout"];
                                        }
                                        ?>

                                        <input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
                                        <div class="form-group">

                                            <label for="spProfilesCountry" class="add_shippinglabel">
                                                <h4 style="color:#333333">Country <span style="font-size:12px" class="red">*</span></h4>
                                            </label>
                                            <select id="spUserCountry_default_address" class="form-control " name="spUserCountry" required>
                                                <option value="0">Select Country</option>
                                                <?php
                                                $co = new _country;
                                                $result3 = $co->readCountry();
                                                if ($result3 != false) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                ?>
                                                        <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id']) ? 'selected' : ''; ?>>
                                                            <?php echo $row3['country_title']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <span style="font-size:12px" class="red" id="msg2"></span>
                                            <span id="shippcounrty_error" style="color:red;"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="loadUserState">
                                                <label for="spUserState" class="add_shippinglabel">
                                                    <h4 style="color:#333333">State <span style="font-size:12px" class="red">*</span></h4>
                                                </label>
                                                <select class="form-control" name="spUserState" id="spUserState" required>
                                                    <option value="0">Select State</option>
                                                    <?php

                                                    $pr = new _state;
                                                    $result2 = $pr->readState($spUserCountry);
                                                    if ($result2 != false) {
                                                        while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                            <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                                                    <?php
                                                        }
                                                    }
                                                    //  }
                                                    ?>
                                                </select><span style="font-size:12px" class="red" id="msg3"></span>
                                                <span id="shippstate_error" style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="loadCity">
                                                <label class="add_shippinglabel" for="spUserCity">
                                                    <h4 style="color:#333333">City <span style="font-size:12px" class="red">*</span></h4>
                                                </label>
                                                <select class="form-control" name="spUserCity" id="spUserCity" required>
                                                    <option value="0">Select City</option>
                                                    <?php
                                                    $co = new _city;
                                                    $result3 = $co->readCity($spUserState);
                                                    if ($result3 != false) {
                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                            //    } 
                                                                                                                                                                                                                                                    ?>
                                                </select>
                                                <span style="font-size:12px" class="red" id="msg4"></span>
                                                <span id="shippcity_error" style="color:red;"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="add_shippinglabel" for="shipp_zipcode">
                                                <h4 style="color:#333333">Zipcode (Max 6 Characters) <span style="color:red;font-size:12px">*</span></h4>
                                            </label>
                                            <input type="text" class="form-control" maxlength="8" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>" required>
                                            <span style="color:red;font-size:12px" id="msg6"></span>
                                            <span id="shippzipcode_error" style="color:red;"></span>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <h4>Select Privacy</h4>
                                        <div id=""></div>


                                        <div class="form-control bg_gray_light no-radius ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag1 == 0) {
                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                } ?>>Public</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag1 == 1) {
                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                } ?>>Private</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="groupid" value="<?= $group_id; ?>">
                                        <h4>Short Description (Max 50 words) <span style="color:red;font-size:12px">*</span></h4>
                                        <div id=""></div>


                                        <input type="text" class="form-control " id="spGroupTagline" name="spGroupTag" maxlength="50" value="<?php echo $row['spGroupTagline']; ?>" required>
                                        <span style="color:red;font-size:12px" id="msg7"></span>
                                    </div>

                                    <div class="col-md-6">
                                        <h4>Group Category <span style="color:red;font-size:12px">*</span></h4>
                                        <div id=""></div>
                                        <select class="form-control " onclick="clearerror();" id="grpcategory" name="spgroupCategory" required>
                                            <option value="<?php echo $id; ?>">Select Category </option>

                                            <?php
                                            $g = new _spgroup;
                                            $result = $g->groupdetails($group_id);
                                            if ($result != false) {
                                                $row = mysqli_fetch_assoc($result);
                                                $spgroupCategory = $row['spgroupCategory'];
                                            }

                                            $sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


                                            $result = mysqli_query($dbConn, $sql);
                                            if ($result) {
                                                while ($rows = mysqli_fetch_assoc($result)) {
                                            ?>
                                                    <?php echo $spgroupCategory;
                                                    ?>
                                                    <option value='<?php echo $rows['id']; ?>' <?php if ($spgroupCategory == $rows["id"]) {
                                                                                                    echo "selected";
                                                                                                } ?>>
                                                        <?php echo $rows["group_category_name"]; ?>
                                                    </option>


                                            <?php
                                                }
                                            }
                                            ?>

                                        </select>
                                        <span style="color:red;font-size:12px" id="msg8"></span>
                                    </div>
                                </div>
                                <div class=" hid_input row">
                                    <div class="col-md-6">
                                        <h4>Choose your banner <span style="color:red;font-size:12px" id="msg10">*</span></h4>
                                        <div id=""></div>
                                        <input type="file" name="bannerfile" onchange="readURL(this);" class="basestorebanner" id="basestorebannerid" style="display: block;" />
                                        <input type="hidden" id="spProfileId" value="<?php echo  $profileId; ?>">
                                        <input type="hidden" id="spuserId" value="<?php echo $spUserid; ?>">
                                        <input type="hidden" id="sgroupid" value="<?php echo $group_id ?>">
                                        <span id="bannerfile_error" class="red"></span>

                                    </div>
                                    <?php
                                    $g = new _spgroup;
                                    $result = $g->groupdetails($group_id);
                                    if ($result != false) {
                                        $row = mysqli_fetch_assoc($result);

                                        $bannerpicture = $row["spgroupimage"];
                                    }
                                    ?>
                                    <div class=" hid_input col-md-6">
                                        <h4>Your selected banner will appear here...</h4>
                                        <div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">
                                            <?php if ($bannerpicture) { ?>
                                                <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">
                                            <?php } else { ?>
                                                <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg " alt="Profile Pic22" class="img-responsive" style="width: 100%;height:175px;">

                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" hid_input col-md-9">
                                <h4>Select Privacy</h4>
                                <div id=""></div>


                                <div class="form-control bg_gray_light no-radius ">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag1 == 0) {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        } ?>>Public</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag1 == 1) {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        } ?>>Private</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    $res = $g->read($group_id);
                                    if ($res != false) {
                                        $ruser = mysqli_fetch_assoc($res);
                                        $spUserCountry = $ruser["spUserCountry"];
                                        $spUserState = $ruser["spUserState"];
                                        $spUserCity = $ruser["spUserCity"];
                                        $address = $ruser["address"];
                                        $zipcode = $ruser["zipcode"];
                                        $spgroupflag1 = $ruser["spgroupflag"];
                                        $spGroupAbout = $ruser["spGroupAbout"];
                                    }
                                    ?>

                                    <input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
                                    <input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
                                    <div class="form-group">

                                        <label for="spProfilesCountry" class="add_shippinglabel">
                                            <h4 style="color:#333333">Country <span style="font-size:12px" class="red">*</span></h4>
                                        </label>
                                        <select id="spUserCountry_default_address" class="form-control " name="spUserCountry" required>
                                            <option value="0">Select Country</option>
                                            <?php
                                            $co = new _country;
                                            $result3 = $co->readCountry();
                                            if ($result3 != false) {
                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                            ?>
                                                    <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $row3['country_title']; ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span style="font-size:12px" class="red" id="msg2"></span>
                                        <span id="shippcounrty_error" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="loadUserState">
                                            <label for="spUserState" class="add_shippinglabel">
                                                <h4 style="color:#333333">State <span style="font-size:12px" class="red">*</span></h4>
                                            </label>
                                            <select class="form-control" name="spUserState" id="spUserState" required>
                                                <option value="0">Select State</option>
                                                <?php

                                                $pr = new _state;
                                                $result2 = $pr->readState($spUserCountry);
                                                if ($result2 != false) {
                                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                        <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                                                <?php
                                                    }
                                                }
                                                //  }
                                                ?>
                                            </select><span style="font-size:12px" class="red" id="msg3"></span>
                                            <span id="shippstate_error" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="loadCity">
                                            <label class="add_shippinglabel" for="spUserCity">
                                                <h4 style="color:#333333">City <span style="font-size:12px" class="red">*</span></h4>
                                            </label>
                                            <select class="form-control" name="spUserCity" id="spUserCity" required>
                                                <option value="0">Select City</option>
                                                <?php
                                                $co = new _city;
                                                $result3 = $co->readCity($spUserState);
                                                if ($result3 != false) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                        <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        //    } 
                                                                                                                                                                                                                                                ?>
                                            </select>
                                            <span style="font-size:12px" class="red" id="msg4"></span>
                                            <span id="shippcity_error" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary" style="background-color: #7649B3; color : white;">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <script src="script.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



        <?php include('../component/footer.php'); ?>
        <?php include('../component/btm_script.php'); ?>
        <div id="StorebannerUpload" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <form id="address" action="uploadgroupbanner.php" method="post" enctype="multipart/form-data">
                    <div class="modal-content sharestorepos bradius-15" style="width: 800px;">
                        <div class="modal-header br_radius_top bg-white">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Group Settings For <?php echo $_GET['groupname'] ?></h4>
                        </div>

                        <div class="modal-body">




                            <div class="row">
                                <div class="col-md-6">
                                    <?php
                                    $res = $g->read($group_id);
                                    if ($res != false) {
                                        $ruser = mysqli_fetch_assoc($res);
                                        $spUserCountry = $ruser["spUserCountry"];
                                        $spUserState = $ruser["spUserState"];
                                        $spUserCity = $ruser["spUserCity"];
                                        $address = $ruser["address"];
                                        $zipcode = $ruser["zipcode"];
                                        $spgroupflag1 = $ruser["spgroupflag"];
                                        $spGroupAbout = $ruser["spGroupAbout"];
                                    }
                                    ?>

                                    <input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
                                    <input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
                                    <div class="form-group">

                                        <label for="spProfilesCountry" class="add_shippinglabel">
                                            <h4 style="color:#333333">Country <span style="font-size:12px" class="red">*</span></h4>
                                        </label>
                                        <select id="spUserCountry_default_address" class="form-control " name="spUserCountry" required>
                                            <option value="0">Select Country</option>
                                            <?php
                                            $co = new _country;
                                            $result3 = $co->readCountry();
                                            if ($result3 != false) {
                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                            ?>
                                                    <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id']) ? 'selected' : ''; ?>>
                                                        <?php echo $row3['country_title']; ?>
                                                    </option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <span style="font-size:12px" class="red" id="msg2"></span>
                                        <span id="shippcounrty_error" style="color:red;"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="loadUserState">
                                            <label for="spUserState" class="add_shippinglabel">
                                                <h4 style="color:#333333">State <span style="font-size:12px" class="red">*</span></h4>
                                            </label>
                                            <select class="form-control" name="spUserState" id="spUserState" required>
                                                <option value="0">Select State</option>
                                                <?php

                                                $pr = new _state;
                                                $result2 = $pr->readState($spUserCountry);
                                                if ($result2 != false) {
                                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                        <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                                                <?php
                                                    }
                                                }
                                                //  }
                                                ?>
                                            </select><span style="font-size:12px" class="red" id="msg3"></span>
                                            <span id="shippstate_error" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="loadCity">
                                            <label class="add_shippinglabel" for="spUserCity">
                                                <h4 style="color:#333333">City <span style="font-size:12px" class="red">*</span></h4>
                                            </label>
                                            <select class="form-control" name="spUserCity" id="spUserCity" required>
                                                <option value="0">Select City</option>
                                                <?php
                                                $co = new _city;
                                                $result3 = $co->readCity($spUserState);
                                                if ($result3 != false) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                        <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                        //    } 
                                                                                                                                                                                                                                                ?>
                                            </select>
                                            <span style="font-size:12px" class="red" id="msg4"></span>
                                            <span id="shippcity_error" style="color:red;"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="add_shippinglabel" for="shipp_zipcode">
                                            <h4 style="color:#333333">Zipcode (Max 6 Characters) <span style="color:red;font-size:12px">*</span></h4>
                                        </label>
                                        <input type="text" class="form-control" maxlength="8" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>" required>
                                        <span style="color:red;font-size:12px" id="msg6"></span>
                                        <span id="shippzipcode_error" style="color:red;"></span>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <h4>Select Privacy</h4>
                                    <div id=""></div>


                                    <div class="form-control bg_gray_light no-radius ">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag1 == 0) {
                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                            } ?>>Public</label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag1 == 1) {
                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                            } ?>>Private</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="groupid" value="<?= $group_id; ?>">
                                    <h4>Short Description (Max 50 words) <span style="color:red;font-size:12px">*</span></h4>
                                    <div id=""></div>


                                    <input type="text" class="form-control " id="spGroupTagline" name="spGroupTag" maxlength="50" value="<?php echo $row['spGroupTagline']; ?>" required>
                                    <span style="color:red;font-size:12px" id="msg7"></span>
                                </div>

                                <div class="col-md-6">
                                    <h4>Group Category <span style="color:red;font-size:12px">*</span></h4>
                                    <div id=""></div>


                                    <select class="form-control " onclick="clearerror();" id="grpcategory" name="spgroupCategory" required>
                                        <option value="<?php echo $id; ?>">Select Category </option>

                                        <?php
                                        $g = new _spgroup;
                                        $result = $g->groupdetails($group_id);
                                        if ($result != false) {
                                            $row = mysqli_fetch_assoc($result);
                                            $spgroupCategory = $row['spgroupCategory'];
                                        }

                                        $sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


                                        $result = mysqli_query($dbConn, $sql);
                                        if ($result) {
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                        ?>
                                                <?php echo $spgroupCategory;
                                                ?>
                                                <option value='<?php echo $rows['id']; ?>' <?php if ($spgroupCategory == $rows["id"]) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                    <?php echo $rows["group_category_name"]; ?>
                                                </option>


                                        <?php
                                            }
                                        }
                                        ?>

                                    </select>
                                    <span style="color:red;font-size:12px" id="msg8"></span>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Choose your banner <span style="color:red;font-size:12px" id="msg10">*</span></h4>
                                    <div id=""></div>
                                    <input type="file" name="bannerfile" onchange="readURL(this);" class="basestorebanner" id="basestorebannerid" style="display: block;" />
                                    <input type="hidden" id="spProfileId" value="<?php echo  $profileId; ?>">
                                    <input type="hidden" id="spuserId" value="<?php echo $spUserid; ?>">
                                    <input type="hidden" id="sgroupid" value="<?php echo $group_id ?>">
                                    <span id="bannerfile_error" class="red"></span>

                                </div>

                                <?php
                                $g = new _spgroup;
                                $result = $g->groupdetails($group_id);
                                if ($result != false) {
                                    $row = mysqli_fetch_assoc($result);

                                    $bannerpicture = $row["spgroupimage"];
                                }



                                ?>




                                <div class="col-md-6">
                                    <h4>Your selected banner will appear here...</h4>
                                    <div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">
                                        <?php if ($bannerpicture) { ?>
                                            <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">
                                        <?php } else { ?>
                                            <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg " alt="Profile Pic22" class="img-responsive" style="width: 100%;height:175px;">

                                        <?php } ?>
                                    </div>
                                </div>



                            </div>






                            <div class="modal-footer bg-white br_radius_bottom">


                                <button type="button" class="btn btn-danger  btn-border-radius" style="   padding-top: 5px!important;
                                                             padding-bottom: 7px!important; " data-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary  btn-border-radius" id="update3" style="">Update </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </body>

    </html>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const threeDots = document.querySelectorAll('.three-dot');

            threeDots.forEach(dot => {
                const optionIcon = dot.querySelector('.option-icon');
                const moreLinks = dot.querySelector('.more-links');

                optionIcon.addEventListener('click', function() {
                    if (moreLinks.style.display === 'none' || moreLinks.style.display === '') {
                        moreLinks.style.display = 'flex';
                    } else {
                        moreLinks.style.display = 'none';
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(".sp-group-details").on("click", ".accept_request", function() {

            var btn = this;
            $.get("../my-groups/accept_request.php", {
                pid: $(this).data("pid"),
                gid: $(this).data("gid"),
                flag: 1
            }, function(r) {
                window.location.replace("<?php echo $BaseUrl; ?>/grouptimelines/member.php?groupid=<?php echo $getid; ?>&groupname=<?php echo $_GET['groupname']; ?>&members&tab=memberreq");
                //location.reload();
            });
        });

        $(".sp-group-details").on("click", ".reject_request", function() {
            var btn = this;
            $.get("../my-groups/accept_request.php", {
                pid: $(this).data("pid"),
                gid: $(this).data("gid"),
                flag: 100
            }, function(r) {
                // location.reload();
                window.location.replace("<?php echo $BaseUrl; ?>/grouptimelines/member.php?groupid=<?php echo $getid; ?>&groupname=<?php echo $_GET['groupname']; ?>&members&tab=memberreq");
            });
        });

        $(".sp-group-details").on("click", ".addtodelete", function() {
            var btn = this;
            if (confirm("Are you sure you want to delete member from group?")) {
                $.get("../my-groups/removeMember.php", {
                    pid: $(this).data("pid"),
                    gid: $(this).data("gid")
                }, function(r) {
                    $(btn).closest("li").remove();
                    $(btn).closest(".groupmembers").find(".sp-group-details").remove();
                    location.reload();
                });
            }
        });
    </script>

    <script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>
    <script type="text/javascript">
        $(".Group_delete").on("click", function() {
            //alert('okkk');
            var groupid = $(this).attr("data-id");
            // alert(groupid);

            var flag = 1;
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
                    $.get("../my-groups/deletegroup.php", {
                        groupid: groupid
                    }, function(data) {
                        //console.log(data);
                        window.location = '../my-groups';

                    });
                    $(".groupdiv_" + groupid).html("");

                }
            })
        });


        setTimeout(function() {
            $('#alert1').hide();
        }, 2000);
    </script>
    <?php
    if (isset($_POST['submit'])) {
        $date = $_POST['date'];
        $title = $_POST['title'];
        $texarea = $_POST['textarea'];
        $groupid = $group_id;
        $crent = date("Y-m-d");
        $data = array(
            'announcemt_date' => $date,
            'title' => $title,
            'message' => $texarea,
            'group_id' => $groupid,
            'user_id' => $_SESSION['uid'],
            'profile_id' => $_SESSION['pid'],
            'date' => $crent

        );

        $obj =  new _groupsponsor;
        $obj->create22($data);
    }

    ?>