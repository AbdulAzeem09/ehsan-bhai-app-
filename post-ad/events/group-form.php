<?php
session_start();
include('../../univ/baseurl.php');
$_GET["module"] = "16";
$_GET["categoryid"] = "16";
$_GET["profiletype"] = "1";
$_GET["categoryname"] = "GroupEvents";

function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");


if (!isset($_SESSION['pid'])) {
    include_once("../../authentication/check.php");
    $_SESSION['afterlogin'] = "post-ad/sell/";
}


$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
    $ruser = mysqli_fetch_assoc($res);
    $usercountry = $ruser["spUserCountry"];
    $userstate = $ruser["spUserState"];
    $usercity = $ruser["spUserCity"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="The SharePage">

    <title>The SharePage.</title>
    <!--Bootstrap core css-->
    <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $BaseUrl; ?>/assets/css/custom.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $BaseUrl; ?>/assets/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!--Font awesome core css-->
    <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--custom css jis ki wja say issue ho rha tha form submit main-->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>

    <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/event.js"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
    <script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>

    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
    <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
    <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(function() {
            $(".datepicker").datepicker({
                minDate: 0,
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

    <?php
    $urlCustomCss = $BaseUrl . '/component/custom.css.php';
    include $urlCustomCss;
    ?>

    <style type="text/css">
        .ui-widget-header {
            background-color: #ffb8bd !important;
        }


        input[type=time]::-webkit-inner-spin-button,
        input[type=time]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            margin: 0;
        }

        /*
input[type=time]::-webkit-datetime-edit-ampm-field {
   display: none;
 }
 input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 }*/
    </style>

</head>

<body onload="pageOnload('post')" class="bg_gray">
    <div class="loadbox">
        <div class="loader"></div>
    </div>
    <?php
    include_once("../../header.php");

    $p = new _spprofiles;
    $rp = $p->readProfiles($_SESSION['uid']);
    $res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);
    if ($res != false) {
        $r = mysqli_fetch_assoc($res);
        $name = $r['spProfileName'];
        $icon = $r['spprofiletypeicon'];
    }
    $g = new _spgroup;
    $result = $g->groupdetails($_GET["groupid"]);

    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        $gimage = $row["spgroupimage"];
        $spGroupflag = $row['spgroupflag'];
    }
    ?>
    <!--Modal-->
    <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="addGroupLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close><span aria-hidden=" true">&times;</span></button>
                </div>
                <form action="addgroup.php" method="post" id="sp-add-group">
                    <div class="modal-body">
                        <label for="existing-group" class="control-label">Existing Group</label>

                        <table class="table table-hover table-condensed">
                            <?php
                            $p = new _spgroup;
                            $rpvt = $p->read($_SESSION['pid']);
                            if ($rpvt != false) {
                                while ($row = mysqli_fetch_assoc($rpvt)) {
                                    echo "<tr>";
                                    echo "<td class='hidden'>" . $row['idspGroup'] . "</td>";
                                    echo "<td>" . $row['spGroupName'] . "</td>";
                                    echo "<td><a href='deleteGroup.php/?groupid=" . $row['idspGroup'] . "'> <span class='glyphicon glyphicon-trash pull-right' aria-hidden='true'> </a></td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </table>

                        <div class="form-group">
                            <label for="group-name" class="control-label">Create New Group</label>
                            <input class="dynamic-pid" type="hidden" name="pid_" value="$_SESSION['pid']">
                            <input type="text" class="form-control" id="spGroupName" name="spGroupName" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="spgroupSubmit">Add</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Modal Complete-->
    <section class="landing_page">
        <div class="container">
            <div class="row">
                <!--    <div class="col-md-2">
                        
                    </div> -->
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="about_banner">
                                <div class="top_heading_group ">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="eventcapitalize">Event Post in the <?php echo $_GET["groupname"]; ?></h3>
                                        </div>

                                        <div class="col-md-6">
                                            <a href="<?php echo $BaseUrl ?>/grouptimelines/group-event.php?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname']; ?>&event" class="pull-right">
                                                <h3 style="color: #23527c; font-weight: bold;">Back to Group Event</h3>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                                <div class="event_form">


                                    <div class="row">
                                        <div class="col-md-offset-6 col-md-6">

                                        </div>
                                    </div>
                                    <!-- <div class="row no-margin"> -->
                                    <div class="col-md-12 no-padding">
                                        <!-- <h4>Your Contact Information</h4> -->
                                        <button data-toggle="modal" style="float:right;" data-target="#sponsorAddModal" class="btn btn-submit sponsorbtn " style="border-radius: 20px; border-color: green;">Add Sponsor</button>
                                        <!--   <p>This information will not be shared on the website. We will only use this to contact you if we have questions about your submission.</p> -->
                                    </div>
                                    <!--   </div> -->

                                    <div class="modal fade" id="sponsorAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                        <div class="loadbox">
                                            <div class="loader"></div>
                                        </div>

                                        <div class="modal-dialog" role="document">


                                            <div class="modal-content sharestorepos no-radius bradius-15" style="border-radius: 15px!important;">
                                                <form action="creategroup_sponsor.php" method="post" id="sp-create-album" class="no-margin" enctype="multipart/form-data">
                                                    <div class="modal-header  bg-white br_radius_top" style="border-top-left-radius: 15px!important;border-top-right-radius: 15px!important;background-color: #fff!important;">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="exampleModalLabel"><b>Add Sponsor</b></h4>
                                                    </div>
                                                    <div class="modal-body">


                                                        <input type="hidden" id="spProfile_idspProfile" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">

                                                        <input type="hidden" id="spgroupid" name="spgroupid" value="<?php echo $_GET["groupid"]; ?>">

                                                        <input type="hidden" id="spgroupname" name="spgroupname" value="<?php echo $_GET['groupname']; ?>">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="sponsorTitle">Company<span style="color:red;">*</span></label>
                                                                    <span id="sponsorTitle_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                                    <input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value="" onkeyup="keyupsponsorfun()" />

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="sponsorWebsite">Company Website<span style="color:red;">*</span></label>
                                                                    <span id="sponsorWebsite_error" style="color:red; margin-bottom: 0px;font-size: 12px;"></span>
                                                                    <input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="" onkeyup="keyupsponsorfun()" />

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="spsponsorPrice">Price<span style="color:red;">*</span></label>
                                                                    <span id="spsponsorPrice_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                                    <input type="text" class="form-control" id="spsponsorPrice" name="spsponsorPrice" placeholder="$" maxlength="8" onkeyup="keyupsponsorfun()" />

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="sponsorCategory">Category<span style="color:red;">*</span></label>
                                                                    <span id="sponsorCategory_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
                                                                    <select class="form-control" name="sponsorCategory" id="sponsorCategory" onkeyup="keyupsponsorfun()">
                                                                        <option value="">Select Category</option>
                                                                        <option class="General">General</option>
                                                                        <option class="Prime">Prime</option>
                                                                        <option class="Platinum">Platinum</option>
                                                                        <option class="Gold">Gold</option>
                                                                        <option class="Silver">Silver</option>
                                                                        <option class="Media">Media</option>
                                                                    </select>

                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="sponsorDesc">Short Description<span style="color:red;">*</span></label>
                                                                    <span id="spsponsorDesc_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                                    <textarea class="form-control" name="sponsorDesc" id="spsponsorDesc" maxlength="500" onkeyup="keyupsponsorfun()"></textarea>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="spSponsorPic">Add Logo<span style="color:red;">*</span></label>

                                                                            <input type="file" class="sponsorPic" name="sponsorImg" id="sponsorImg" onkeyup="keyupsponsorfun()">
                                                                            <span id="sponsorImg_error" style="color:red; margin-bottom: 0px; font-size: 12px;"></span>
                                                                            <p class="help-block"><small>Browse files from your device</small></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-9" style="padding-left: 130px;">
                                                                        <div class="form-group">
                                                                            <label for="sponsorPreview">Logo Preview</label>


                                                                            <div id="sponsorPreview"></div>
                                                                            <div id="postingsponsorPreview">
                                                                                <div class="row">
                                                                                    <div id="spPreview">

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer bg-white br_radius_bottom" style="border-bottom-left-radius: 15px!important;border-bottom-right-radius: 15px!important;background-color: #fff!important;">
                                                        <button type="button" class="btn btn-default db_btn db_orangebtn" data-dismiss="modal" style="background: #fab318!important;border-radius: 30px!important;color:#fff;">Close</button>
                                                        <button id="addSponsergroup" type="submit" class="btn btn-primary db_btn db_primarybtn" style="background: #032350!important;border-radius: 30px!important;">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="space"></div>
                                    <div>
                                        <?php
                                        $profileid = "";
                                        $eCountry = "";
                                        $eCity = "";
                                        $eCityID = "";
                                        $eCategory = "";
                                        $eSubCategoryID = "";
                                        $eSubCategory = "";
                                        $ePostTitle = "";
                                        $ePostNotes = "";
                                        $eExDt = "";
                                        $ePrice = "";
                                        $shipping = "";
                                        $estate = "";
                                        $venu = "";
                                        $hallcapicty = "";
                                        $ticketCapty = "";
                                        $spStartDate = "";
                                        $spEndDate = "";
                                        $srtTime = "";
                                        $endTime = "";

                                        if (isset($_GET["postid"])) {
                                            $p = new _spgroup_event;
                                            $r = $p->read($_GET["postid"]);
                                            if ($r != false) {
                                                while ($row = mysqli_fetch_assoc($r)) {
                                                    echo "<input type='hidden' id='postprofile' value='" . $row["idspProfiles"] . "'>";
                                                    $ePostTitle = $row["spPostingTitle"];
                                                    $ePostNotes = $row["spPostingNotes"];
                                                    $eExDt = $row["spPostingExpDt"];
                                                    $ePrice = $row["spPostingPrice"];
                                                    $profileid = $row['idspProfiles'];
                                                    $postingflag = $row['spPostingsFlag'];
                                                    $phone = $row['spPostingPhone'];
                                                    $shipping = $row['sppostingShippingCharge'];
                                                    $eCountry = $row['spPostingsCountry'];
                                                    $eCity = $row['spPostingsCity'];
                                                    $estate = $row['spPostingState'];
                                                    $venu = $row['spPostingEventVenue'];
                                                    $hallcapicty = $row['hallcapacity'];
                                                    $ticketCapty = $row['ticketcapacity'];
                                                    $spStartDate = $row['spPostingStartDate'];
                                                    $spEndDate = $row['spPostingEndDate'];
                                                    $srtTime = $row['spPostingStartTime'];
                                                    $endTime = $row['spPostingEndTime'];
                                                    $usercountry = $row["spPostingsCountry"];
                                                    $userstate = $row["spPostingsState"];
                                                    $usercity = $row["spPostingsCity"];
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!--<div class="page-header" style="margin-top: 10px;">-->


                                                <form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopostgroupevent.php" method="post" name="postform">



                                                    <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">

                                                    <input id="catname" type="hidden" name="categoryname" value="<?php echo $_GET["categoryname"]; ?>">


                                                    <input id="spgroupid" name="spgroupid" id="spgroupid" type="hidden" value="<?php echo $_GET["groupid"]; ?>">

                                                    <input name="spgroupname" id="spgroupname" type="hidden" value="<?php echo $_GET["groupname"]; ?>">
                                                    <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">

                                                    <input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">

                                                    <input type="hidden" value="<?php
                                                                                if (isset($_GET["postid"]))
                                                                                    echo $_GET["postid"];
                                                                                else
                                                                                    echo ""; ?>" name="idspPostings">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="spPostingTitle">Group Event Title

                                                                    <span style="color:red;">*</span><span id="lbl_1" class="label_error"></span></label>
                                                                <input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle" value="<?php echo $ePostTitle ?>" placeholder="" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="spPostingNotes">What is this event about?<span id="evadd_err" class="label_error"></span></label>
                                                                <textarea class="form-control" id="spPostingNotes" name="spPostingNotes" rows="3" equired><?php echo $ePostNotes ?> </textarea>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="spPostingCountry">Country<span style="color:red;">*</span><span id="lbl_2" class="label_error"></span></label>
                                                                        <select id="spUserCountry-1" class="form-control " name="spPostingsCountry">
                                                                            <option value="">Select Country</option>
                                                                            <?php
                                                                            $co = new _country;
                                                                            $result3 = $co->readCountry();
                                                                            if ($result3 != false) {
                                                                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                                                            ?>
                                                                                    <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && ($usercountry == $row3['country_id'] || $row3['country_id'] == $eCountry)) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                        <!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="loadUserState">
                                                                        <label for="spPostingCity">State <span style="color:red;">*</span><span id="lbl_3" class="label_error"></span></label>
                                                                        <select class="form-control" id="spUserState" name="spPostingsState">
                                                                            <option>Select State</option>
                                                                            <?php
                                                                            if (isset($userstate) && $userstate > 0) {
                                                                                echo $countryId = $usercountry;
                                                                                $pr = new _state;
                                                                                $result2 = $pr->readState($countryId);
                                                                                if ($result2 != false) {
                                                                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                                                                        <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($userstate) && ($userstate == $row2["state_id"] || $row2["state_id"] == $estate)) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                                                                            <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="loadCity">
                                                                        <div class="form-group">
                                                                            <label for="spPostingCity">City<span style="color:red;">*</span> <span id="lbl_city" class="label_error"></span></label>
                                                                            <select class="form-control" name="spPostingsCity">
                                                                                <option>Select City</option>
                                                                                <?php
                                                                                if (isset($usercity) && $usercity > 0) {
                                                                                    $stateId = $userstate;
                                                                                    $co = new _city;
                                                                                    $result3 = $co->readCity($stateId);
                                                                                    //echo $co->ta->sql;
                                                                                    if ($result3 != false) {
                                                                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                                                                            <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($usercity) && ($usercity == $row3['city_id'] || $row3['city_id'] == $eCity)) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                                                                                                                                                    }
                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                            } ?>
                                                                            </select>
                                                                            <!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt" value="
                                                                            <?php
                                                                            if ($eExDt) {
                                                                                echo date('Y-m-d', strtotime($eExDt));
                                                                            } else {
                                                                                echo date('Y-m-d', strtotime("+30 days"));
                                                                            }
                                                                            ?>">
                                                            </div>
                                                            <div class="addcustomfields">
                                                                <!--add custom fields-->
                                                                <?php
                                                                if (isset($_GET["postid"])) {
                                                                    $f = new _postfield;
                                                                    $res = $f->field($_GET["postid"]);
                                                                    if ($res != false)
                                                                        while ($result = mysqli_fetch_assoc($res)) {
                                                                            $row[$result["spPostFieldLabel"]] = $result["spPostFieldValue"];
                                                                            //$idspPostField = $result["idspPostField"];
                                                                        }
                                                                }


                                                                $_GET["module"] = $_GET["categoryid"];
                                                                include("../group-event.php");
                                                                ?>
                                                                <!--Getcustomfield-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--Testing-->

                                                    <!--Testing Complete-->
                                                    <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="postingpic">Add Poster</label>
                                                                <input type="file" class="postingpic" name="spPostingPic[]" multiple="multiple" required>
                                                                <p class="help-block"><small>Browse files from your device</small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <label for="postingPicPreview">Picture Preview</label>
                                                                <div id="imagePreview"></div>
                                                                <div id="postingPicPreview">
                                                                    <div class="row">
                                                                        <div id="dvPreview">
                                                                            <?php
                                                                            $i = 1;
                                                                            $pic = new _groupeventpic;
                                                                            if (isset($_GET['postid'])) {
                                                                                $res = $pic->read($_GET["postid"]);
                                                                                if ($res != false) {
                                                                                    while ($rows = mysqli_fetch_assoc($res)) {
                                                                                        $picture = $rows['spPostingPic'];
                                                                                        if ($rows['spFeatureimg'] == 1) {
                                                                                            $select = "checked";
                                                                                        } else {
                                                                                            $select = '';
                                                                                        }

                                                                                        echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "' ></span><img class='overlayImage' style='width:100px; height: 100px; margin-right:5px;' data-name='fi_" . $i . "' src=' " . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['idspPostingPic'] . "'><input type='radio' class='featureImg' name='featureImg_' id='fi_" . $i . "' value='0' " . $select . " />Feature Image</label></div>";

                                                                                        $i++;
                                                                                    }
                                                                                }
                                                                            }

                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" class="count" id="count" value="<?php echo (isset($i) && $i > 0) ? $i : '1' ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row sponsorInfo ">
                                                        <h3>Sponsor Information</h3>
                                                        <div class="col-md-3">
                                                            <div class="form-group add_spon">
                                                                <!-- (<a href="javascript:void(0)" data-toggle="modal" data-target="#sponsorAddModal">Add Sponsor</a>) -->
                                                                <label for="sponsorId_">Select Sponsor</label>
                                                                <select id="rightmenu" class="sp_Sponsor form-control spPostField " name="sponsorId" multiple="multiple" style="width: 100%;">
                                                                    <?php


                                                                    $sp = new _groupsponsor;
                                                                    $result2 = $sp->readAll($_SESSION['pid']);
                                                                    // print_r($result2);
                                                                    //echo $sp->ta->sql;
                                                                    if ($result2 != false) {
                                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                                            //print_r($row2);
                                                                            $sp1 = $sp->read();
                                                                            //print_r($sp1);die;
                                                                            $spo = mysqli_fetch_array($sp1);
                                                                            $allSponsor[] = $spo;
                                                                            if (in_array($row2['idspSponsor'], $allSponsor)) {

                                                                                $spSelect = "selected";
                                                                            } else {
                                                                                $spSelect = '';
                                                                            }
                                                                            //
                                                                            echo "<option value='" . $row2['idspSponsor'] . "' " . $spSelect . ">" . $row2['sponsorTitle'] . "</option>";
                                                                        }
                                                                    }

                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">

                                                        </div>
                                                    </div>
                                                    <!--complete-->


                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="btn-group">
                                                                <button id="postingtype" type="button" class="btn btn-success <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public</button>

                                                                <button type="button" class="btn  btn-success dropdown-toggle <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></button>
                                                                <ul class="dropdown-menu posttype">
                                                                    <li><a id="postpublic" style="cursor:pointer;">Public</a></li>
                                                                    <li><a id="postgroup" style="cursor:pointer;">Group</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div id="sp-group-container" class="input-group hidden">
                                                                <input class="form-control" id='group_' name="group_" type="text" placeholder="Type to Select Group...">

                                                                <span class="input-group-btn">
                                                                    <!--<button class="btn btn-default" type="button" data-toggle="modal" data-target="#addGroup">Add New</button>-->
                                                                    <a href="../../my-groups/" class="btn btn-default" type="button">Add New</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-5 text-right">
                                                            <!---------
                                                                        <button id="spPostgroupSubmit" style="border-radius: 20px;  border-color: green;" type="button" class="btn btn-success <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Repost" : "Submit") ?></button>
                                                                        ------->
                                                            <button id="spPostgroupSubmitqqq" style="border-radius: 20px;  border-color: green;" type="submit" class="btn btn-success <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>"><?php echo (isset($_GET["postid"]) ? "Update" : "Submit") ?></button> &nbsp;

                                                            <?php
                                                            if (isset($_GET["postid"])) {
                                                                echo "
                                                                     <a class='btn btn-danger' style='border-radius: 20px;'
                                                                     href='deletePost.php?postid=" . $_GET['postid'] . "'>
                                                                     Delete post</a>";
                                                            }
                                                            ?>


                                                        </div>
                                                    </div>
                                                </form>
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
    <?php include('../../component/footer.php'); ?>
    <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
    <?php include('../../component/btm_script.php'); ?>
    <div class="retail-wholesheller">

        <script type="text/javascript">
            $(function() {
                $('#spPostingPrice').keypress(function(e) {
                    if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                        e.preventDefault(); //stop character from entering input
                    }
                });
                $('#hallcapacity_').keypress(function(e) {
                    if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                        e.preventDefault(); //stop character from entering input
                    }
                });

                $('#ticketcapacity_').keypress(function(e) {
                    if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                        e.preventDefault(); //stop character from entering input
                    }
                });

            });
        </script>

    </div>
    <script type="text/javascript">
        //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======
        $("#spUserCountry-1").on("change", function() {
            var countryId = this.value;
            $.post("../loadUserState.php", {
                countryId: countryId
            }, function(r) {
                $(".loadUserState").html(r);
            });
            var state = 0;
            $.post("../loadUserCity.php", {
                state: state
            }, function(r) {
                $(".loadCity").html(r);
            });
        });

        //==========ON CHANGE LOAD CITY==========
        $("#spUserState").on("change", function() {

            //alert(this.value);
            var state = this.value;
            $.post("../loadUserCity.php", {
                state: state
            }, function(r) {
                //alert(r);
                $(".loadCity").html(r);
            });

        });

        function Endtimecheck() {
            var starttime = $('#spPostingStartTime_').val();


            alert(starttime);

        }

        var endtime = document.getElementById('spPostingEndTime_');

        var starttime = document.getElementById('spPostingStartTime_');

        function onTimeChange() {
            /*  var timeSplit = endtime.value.split(':'),
                endhours,
                endminutes,

            var timeSplit2 = starttime.value.split(':'),
                starthours,
                startminutes,
                
              starthours = timeSplit2[0];
              startminutes = timeSplit2[1];

            if(starthours > endhours ){

            alert(start houer is greter)

            }else{
               
               alert(start houer is greter) 

            }*/
            /*if (hours > 12) {
              meridian = 'PM';
              hours -= 12;
            } else if (hours < 12) {
              meridian = 'AM';
              if (hours == 0) {
                hours = 12;
              }
            } else {
              meridian = 'PM';
            }*/
            /*  alert(hours + ':' + minutes + ' ' + meridian);*/
        }


        /*


        $(function () {
            $("#spPostingStartDate_").datepicker({
                numberOfMonths: 2,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() + 1);
                    $("#spPostingExpDt").datepicker("option", "minDate", dt);
                }
            });
            $("#spPostingExpDt").datepicker({
                numberOfMonths: 2,
                onSelect: function (selected) {
                    var dt = new Date(selected);
                    dt.setDate(dt.getDate() - 1);
                    $("#spPostingStartDate_").datepicker("option", "maxDate", dt);
                }
            });
        });
        */
    </script>

    <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
    <script type="text/javascript">
        function keyupsponsorfun() {

            //alert();

            var company = $("#sponsorTitle").val()

            var Website = $("#sponsorWebsite").val()
            var Price = $("#spsponsorPrice").val()
            var category = $("#sponsorCategory").val()
            var Description = $("#spsponsorDesc").val()
            var sponsorImage = $("#sponsorImg").val()

            //alert(category);
            //alert(category.length);

            if (company != "") {
                $('#sponsorTitle_error').text(" ");

            }
            if (Website != "") {
                $('#sponsorWebsite_error').text(" ");
            }
            if (Price != "") {
                $('#spsponsorPrice_error').text(" ");

            }
            if (category.length != 0) {
                $('#sponsorCategory_error').text(" ");

            }
            if (Description != "") {
                $('#spsponsorDesc_error').text(" ");
            }
            if (sponsorImage != "") {
                $('#sponsorImg_error').text(" ");

            }


        }
    </script>


</body>

</html>