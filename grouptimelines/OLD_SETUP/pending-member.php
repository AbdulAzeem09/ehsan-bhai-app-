<style>
    i.fa.fa-cog {
        color: white !important;
    }
</style>

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
    <style>
        .member_box img.profilePic {
            height: 70px;

        }

        .member_box {
            background-color: white !important;

            border: solid !important;
        }


        #sendrequest {
            margin-top: 4px;
        }

        .inner_top_form button {
            padding: 9px 12px !important;
        }
    </style>


    <div class="modal fade" id="mycomment" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content no-radius">
                <form action="../social/addcomment.php" method="post">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title" id="commentModalLabel">Comments</h4>
                    </div>
                    <div class="modal-body">
                        <div id="commentUploading">

                        </div>

                        <div class="row">

                            <div class="col-md-12">
                                <div class="input-group">
                                    <div class="input-group-addon commentprofile inputgroupadon">
                                        <div id="profilepictures"></div>
                                    </div>
                                    <input type="text" class="form-control" name="comment" id="comment" placeholder="Type your comment here ..." style='height:45px;border-radius: 0px;'>
                                </div>

                                <input type="hidden" id="postcomment" name="spPostings_idspPostings" value="" />
                                <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>">
                                <input name="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn_gray" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn_blue commentboxpost">Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <section class="landing_page">
        <div class="container">
            <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

            <input type="hidden" id="grpid" value="<?php echo $getid; ?>">
            <input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
            <input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
            <div class="row">


                <div class="col-md-12">

                    <?php
                    //Edit and delete 
                    $p = new _spprofiles;
                    $result = $p->readMember($_SESSION['uid'], $getid);
                    //echo $p->ta->sql;
                    if ($result != false) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $profileid = $row["idspProfiles"];
                            $profilename = $row["spProfileName"];
                            $g = new _spgroup;
                            $pr = $g->admin_Member($profileid, $getid);
                            if ($pr != false) {
                                $rw = mysqli_fetch_assoc($pr);
                                if ($rw["spProfileIsAdmin"] == 0) {
                                    $admin = $rw["spProfileIsAdmin"];
                                }
                            }
                        }
                    }
                    $p = new _spgroup;
                    $rpvt = $p->joinedMembersOfGroup($getid);
                    if ($rpvt != false) {

                        $totMember = mysqli_num_rows($rpvt);

                        $admin = 0;
                        $subadmin = 0;
                        $civilian = 0;
                        $notapprove = 0;
                        while ($row = mysqli_fetch_assoc($rpvt)) {

                            if ($row['spAssistantAdmin'] == 1) {
                                $subadmin++;
                            }

                            if ($row['spApproveRegect'] == 1) {
                                if ($row['spProfileIsAdmin'] == 0) {
                                    $admin++;
                                } else {
                                    if (isset($admin) && $row['spAssistantAdmin'] == 0) {
                                        $civilian++;
                                    } elseif (isset($admin) && $row['spAssistantAdmin'] == 1) {
                                        $subadmin++;
                                    }
                                }
                            } else {

                                if (isset($admin) && $row['spApproveRegect'] == 2) {
                                    $notapprove++;
                                }
                            }
                        }
                    }
                    ?>
                    <div class="group-wrapper">
                        <div class="side-bar" id="side-bar">
                            <?php include('../component/left-group.php'); ?>
                        </div>
                        <div class="group-body-wrapper">
                            <div class="members">
                                <div class="main-heading">
                                    <div class="top-heading">
                                        Pending Members
                                    </div>
                                </div>
                                <div id="pendingMembers" class="friend-list-wrapper">
                                    <?php
                                    $getid = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
                                    $p = new _spgroup;
                                    $rpvt = $p->members_pending($getid);
                                    if ($rpvt != false) {
                                        $i = 0;

                                        while ($row = mysqli_fetch_assoc($rpvt)) {

                                            if ($row['spApproveRegect'] == 0) {


                                    ?>
                                                <div class="friend">

                                                    <div class="img-wrapper">
                                                        <?php
                                                        if (isset($row['spProfilePic'])) { ?>
                                                            <img src='<?php echo ($row['spProfilePic']); ?>' class="img-responsive profilePic" alt="" /> <?php } else { ?>
                                                            <img src='<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png' class="img-responsive" alt="" />
                                                        <?php } ?>
                                                    </div>
                                                    <div class="detail">
                                                        <div class="name"><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $row['idspProfiles']; ?>" style="color:black;"><?php echo ucwords($row['spProfileName']); ?></a></div>
                                                    </div>
                                                    <div class="icons">
                                                        <div class="three-dot">
                                                            <img src="../assets/images/inner_group/three-dot-3.svg" alt="" class="option-icon">
                                                            <div class="more-links" id="three-dot" style="display: none; width: 160px;">
                                                                <a href='javascript:void(0);' class='accept_request' style='' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid; ?>'>

                                                                    <div class="link">
                                                                        <span class="img">
                                                                            <img src="../assets/images/inner_group/add-friend.svg" alt="">
                                                                        </span>
                                                                        <span>Accept</span>
                                                                    </div>
                                                                </a>
                                                                <a href='javascript:void(0);' class='reject_request' style='' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid; ?>'>

                                                                    <div class="link">
                                                                        <span class="img">
                                                                            <img src="../assets/images/inner_group/block.svg" alt="">
                                                                        </span>
                                                                        <span>Reject</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="message">
                                                            <img src="../assets/images/inner_group/message-2.svg" alt="" class="option-icon">
                                                        </div>
                                                    </div>
                                                    <!-- <div style="padding-top: 20px;">
                                                        <a href='javascript:void(0);' class='accept_request' style='' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid; ?>'>
                                                            <button id="sendrequest" type="button" class="btn btnPosting db_btn btn-border-radius" style=" background-color: #000066; text-color:green;">
                                                                Accept
                                                            </button>
                                                        </a>
                                                        <a href='javascript:void(0);' class='reject_request' style='' data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid; ?>'>
                                                            <button id="sendrequest" type="button" class="btn btnPosting db_btn pull-right btn-border-radius" style=" background-color:  #00ace6
                                                                        ; float: right;" data-pid='<?php echo $row['idspProfiles']; ?>' data-gid='<?php echo $getid; ?>'>
                                                                Reject
                                                            </button>
                                                        </a>
                                                    </div> -->
                                                </div>
                                        <?php


                                                $i++;
                                            }
                                        }
                                    } else { ?>
                                        <div class="friend">

                                            <div class="img-wrapper">
                                                <h2>No Pending Request Here !</h2>
                                            </div>
                                        </div>

                                    <?php }
                                    ?>


                                </div>
                            </div>

                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>

    <div id="StorebannerUpload" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <form id="address" action="<?php echo $BaseUrl . '/grouptimelines/uploadgroupbanner.php'; ?>" method="post" enctype="multipart/form-data">
                <div class="modal-content sharestorepos bradius-15" style="width: 800px;">
                    <div class="modal-header br_radius_top bg-white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Group Setting <?php echo $_GET['groupname'] ?></h4>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Group Name</h4>
                                <div id=""></div>
                                <input type="hidden" name="gname" value="<?php echo $_GET['groupname']; ?>">
                                <input type="text" id="gname" name="gname" onkeyup="clearerror();" value="<?php echo $_GET['groupname']; ?>" class="form-control bradius-10">
                            </div>


                        </div>



                        <div class="row">
                            <div class="col-md-6">




                                <?php

                                $res = $g->read($getid);
                                if ($res != false) {
                                    $ruser = mysqli_fetch_assoc($res);

                                    $spUserCountry = $ruser["spUserCountry"];
                                    $spUserState = $ruser["spUserState"];
                                    $spUserCity = $ruser["spUserCity"];
                                }

                                $u = new _spuser;
                                $res = $u->read($_SESSION["uid"]);
                                if ($res != false) {
                                    $ruser = mysqli_fetch_assoc($res);
                                    $spUserCountry = $ruser["spUserCountry"];
                                    $spUserState = $ruser["spUserState"];
                                    $spUserCity = $ruser["spUserCity"];
                                }


                                ?>

                                <input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
                                <input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
                                <div class="form-group">

                                    <label for="spProfilesCountry" class="add_shippinglabel">
                                        <h4>Country:</h4><span class="red"></span>
                                    </label>
                                    <select id="spUserCountry_default_address" class="form-control " name="spUserCountry">
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
                                    <span id="shippcounrty_error" style="color:red;"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="loadUserState">
                                        <label for="spUserState" class="add_shippinglabel">
                                            <h4>State:</h4><span class="red"></span>
                                        </label>
                                        <select class="form-control" name="spUserState" id="spUserState">
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
                                        </select>
                                        <span id="shippstate_error" style="color:red;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="loadCity">
                                        <label class="add_shippinglabel" for="spUserCity">
                                            <h4>City:</h4><span class="red"></span>
                                        </label>
                                        <select class="form-control" name="spUserCity" id="spUserCity">
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
                                        <span id="shippcity_error" style="color:red;"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="add_shippinglabel" for="shipp_address">
                                        <h4>Address:</h4><span class="red"></span>
                                    </label>


                                    <input class="form-control" type="text" id="shipp_address" value="<?php
                                                                                                        echo (isset($address) && !empty($address)) ? $address : ''; ?>" name="address" autocomplete="off" />

                                    <span id="shippaddress_error" style="color:red;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="add_shippinglabel" for="shipp_zipcode">
                                        <h4>Zipcode:</h4>
                                    </label>
                                    <input type="text" class="form-control" maxlength="6" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>">
                                    <span id="shippzipcode_error" style="color:red;"></span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <h4>Select Privacy</h4>
                                <div id=""></div>


                                <div class="form-control bg_gray_light no-radius bradius-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag == 0) {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        } ?>>Public</label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag == 1) {
                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                        } ?>>Private</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="groupid" value="<?= $getid; ?>">
                                <h4>Short Description (Max 50 words)</h4>
                                <div id=""></div>
                                <br />

                                <input type="text" class="form-control bradius-10" id="spGroupTagline" name="spGroupTag" value="<?php echo $row['spGroupTagline']; ?>">
                            </div>

                            <div class="col-md-6">
                                <h4>Group Category</h4>
                                <div id=""></div>
                                <br />

                                <select class="form-control bradius-10" onclick="clearerror();" id="grpcategory" name="spgroupCategory">
                                    <option value="<?php echo $id; ?>">Select Category </option>

                                    <?php

                                    $sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


                                    $result = mysqli_query($dbConn, $sql);

                                    while ($rows = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <?php
                                        ?>
                                        <option value='<?php echo $rows['id']; ?>' <?php if ($spgroupCategory == $rows["id"]) {
                                                                                        echo "selected";
                                                                                    } ?>>
                                            <?php echo $rows["group_category_name"]; ?>
                                        </option>


                                    <?php
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-12">
                                <h4>Description</h4>
                                <div id=""></div>
                                <br />

                                <textarea onkeyup="clearerror();" class="form-control bradius-10" id="spGroupAbout" name="spGroupAbout">
                <?php
                echo $spGroupAbout;
                ?>

                </textarea>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Choose your banner</h4>
                                <div id=""></div>
                                <br />
                                <?php
                                ?>

                                <input type="file" name="bannerfile" class="basestorebanner" id="basestorebannerid" style="display: block;" />
                                <input type="hidden" id="spProfileId" value="<?php echo  $profileId; ?>">



                                <input type="hidden" id="spuserId" value="<?php echo $spUserid; ?>">
                                <input type="hidden" id="sgroupid" value="<?php echo $getid ?>">
                            </div>






                            <div class="col-md-6">
                                <h4>Your selected banner will appear here...</h4>
                                <div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">
                                    <?php if ($bannerpicture) { ?>
                                        <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" style="width: 100%;">
                                    <?php } else { ?>
                                        <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg " alt="Profile Pic22" style="width: 100%;height:175px;">

                                    <?php } ?>
                                </div>
                            </div>



                        </div>






                        <div class="modal-footer bg-white br_radius_bottom">
                            <button type="submit" class="btn btn-primary" id="update3" style="">Update Data</button>

                            <button type="button" class="btn btn-default db_btn db_orangebtn" style="   padding-top: 5px!important;
padding-bottom: 7px!important;" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <?php include('../component/footer.php'); ?>
    <?php include('../component/btm_script.php'); ?>

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