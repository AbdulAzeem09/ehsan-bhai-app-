<?php
ob_start();
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
    include_once("../authentication/check.php");
    $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
}

include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');

/*$pid=$_SESSION['pid'];
$getid=$_GET['groupid'];
$obj2=new _spAllStoreForm;	
$ress2=$obj2->readdatabymulid($getid,$pid);
if($ress2 ==false){
//die("=======");
header("location:$BaseUrl/my-groups/?msg=notaccess");

}*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group_inner.css">

    <?php include('../component/links.php'); ?>
    <!--This script for posting timeline data Start-->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
    <!--This script for posting timeline data End-->
    <!--This script for sticky left and right sidebar STart-->
    <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
    <script>
        function execute(settings) {
            $('#sidebar').hcSticky(settings);
        }
        // if page called directly
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
        // if page called directly
        jQuery(document).ready(function($) {
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

    include_once("../header.php");

    $g = new _spgroup;
    $result = $g->groupdetails($_GET["groupid"]);
    //echo $g->ta->sql;
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $gimage = $row["spgroupimage"];
        $spGroupflag = $row['spgroupflag'];
    }
    ?>
    <!-- Trigger the modal with a button -->
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
                        <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn_blue commentboxpost btn-border-radius">Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- COMMENT MODEL FOR TIMELINE START -->
    <section class="landing_page">
        <div class="container">
            <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

            <input type="hidden" id="grpid" value="<?php echo $_GET["groupid"]; ?>">
            <input type="hidden" id="grpName" value="<?php echo $_GET["groupname"]; ?>">
            <input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
            <div class="row">

                <div class="col-md-12">
                    <?php
                    $g = new _spgroup;
                    $result = $g->groupdetails($_GET["groupid"]);

                    // echo $g->ta->sql;

                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
                        $gname = $row["spGroupName"];
                        $gtag = $row["spGroupTag"];
                        $gdes = $row["spGroupAbout"];
                        $grules = $row["spGroupRules"];
                        $gtype = $row["spgroupflag"];
                        $gcategory = $row["spgroupCategory"];
                        $glocation = $row["spgroupLocation"];
                        $gimage = $row["spgroupimage"];
                    }

                    ?>
                    <div class="group-wrapper">
                        <div class="side-bar" id="side-bar">
                            <?php include('../component/left-group.php'); ?>
                        </div>

                        <div class="group-body-wrapper">
                            <div class="text-wrapper-2">
                                <div class="main-heading" style="margin-bottom:0%">
                                    <div class="top-heading">
                                        Group Rules
                                    </div>
                                </div>
                                <div class="text">
                                    <p style="color: #000; white-space: pre-wrap;">
                                        <?php echo $grules; ?>
                                    </p>

                                </div>


                            </div>

                        </div>


                    </div>

                </div>
            </div>
    </section>
    <?php include('../component/footer.php'); ?>
    <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
    <?php include('../component/btm_script.php'); ?>

</body>

<script type="text/javascript">
    //function get_approvedata(id){

    $("#btnaboutus").click(function() {
        //alert();

        var gid = $("#idspGroup").val();
        var about = $("#spGroupAbout").val();
        var rules = $("#spGroupRules").val();
        var location = $("#spgroupLocation").val();
        // alert(txn_id);
        // alert(buyerprofil_id);
        // alert(sellerprofil_id);

        if (about == "") {

            $("#aboutgroup_error").text("This field is required.");
            $("#spGroupAbout").focus();


            return false;
        }
        if (rules == "") {

            $("#rulesgroup_error").text("This field is required.");
            $("#spGroupRules").focus();


            return false;
        }
        if (location == "") {

            $("#grouplocation_error").text("This field is required.");
            $("#spgroupLocation").focus();


            return false;
        } else {
            $.ajax({
                type: 'POST',
                url: '../post-ad/addgroup.php',
                data: {
                    idspGroup: gid,
                    spGroupRules: rules,
                    spGroupAbout: about,
                    spgroupLocation: location
                },


                success: function(response) {

                    //console.log(data);
                    window.location.reload();
                    /*    swal({

                    title: "Update Successfully!",
                    type: 'success',
                    showConfirmButton: true

                    },
                    function() {

                    window.location.reload();

                    });*/


                }
            });


        }

    });
</script>

</html>