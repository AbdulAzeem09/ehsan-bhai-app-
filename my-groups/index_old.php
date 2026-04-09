<?php
//error_reporting(E_ALL);
// ini_set('display_errors', '1');


include ('../univ/baseurl.php');
include ('../univ/main.php');
session_start();
$dbConn = mysqli_connect(DOMAIN, UNAME, PASS, DBNAME);



if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once ("../authentication/check.php");
} else {

    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    $pr = new _spprofiles;
    $result = $pr->read($_SESSION["pid"]);
    if ($result != false) {
        $sprows = mysqli_fetch_assoc($result);
        $profileCity = $sprows["spProfilesCity"];
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/group.css">
        <?php include ('../component/f_links.php'); ?>
        <link href=" https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css " rel="stylesheet" />

        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
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
        <!--This script for sticky left and right sidebar END-->

        <style>
            .select2-container--default .select2-selection--single {
                height: 33px;
            }

            .select2-container {
                margin-top: 6px !important;
                margin-left: -5px !important;

            }

            .w-wrap {
                word-wrap: break-word;
                margin-left: 5px;
                margin-left: 60px;
                text-align: left;
            }

            .pgroup {
                margin-top: 10px;
            }

            .f-group-wrap {
                word-wrap: break-word;
                margin-left: 5px;
                margin-left: 60px;
                text-align: left;
                margin-top: 20px;
            }






            .join-wrap {
                word-wrap: break-word;
                margin-left: 5px;
                margin-left: 60px;
                text-align: left;
                margin-top: 10px;
            }

            h6.suggest {
                margin: 10px !important;
            }

            .main_grop_box h6 {
                color: #000;
                text-align: center;
                font-size: 13px;
                font-family: MarksimonLight;
                text-transform: none;
                margin: 0px 0 -5px;
            }

            body {
                font-family: 'Roboto', sans-serif;
                font-size: 14px;
                line-height: 18px;
                background: #f4f4f4;
            }

            .list-wrapper {
                padding: 15px;
                overflow: hidden;
            }

            .list-item {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item p {
                margin: 0;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #FFF;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #3e2048;
                border-color: #3e2048;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #3e2048;
            }

            /*-----------------------*/
            body {
                font-family: 'Roboto', sans-serif;
                font-size: 14px;
                line-height: 18px;
                background: #f4f4f4;
            }

            .list-wrapper1 {
                padding: 15px;
                overflow: hidden;
            }

            .list-item1 {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item1 h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item1 p {
                margin: 0;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #FFF;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #3e2048;
                border-color: #3e2048;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #3e2048;
            }

            /*--------------*/
            body {
                font-family: 'Roboto', sans-serif;
                font-size: 14px;
                line-height: 18px;
                background: #f4f4f4;
            }

            .list-wrapper2 {
                padding: 15px;
                overflow: hidden;
            }

            .list-item2 {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item2 h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item2 p {
                margin: 0;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #FFF;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #3e2048;
                border-color: #3e2048;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #3e2048;
            }

            /*--------------*/
            body {
                font-family: 'Roboto', sans-serif;
                font-size: 14px;
                line-height: 18px;
                background: #f4f4f4;
            }

            .list-wrapper3 {
                padding: 15px;
                overflow: hidden;
            }

            .list-item3 {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item3 h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item3 p {
                margin: 0;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #FFF;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #3e2048;
                border-color: #3e2048;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #3e2048;
            }

            /*---------------*/
            body {
                font-family: 'Roboto', sans-serif;
                font-size: 14px;
                line-height: 18px;
                background: #f4f4f4;
            }

            .list-wrapper4 {
                padding: 15px;
                overflow: hidden;
            }

            .list-item4 {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item4 h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item4 p {
                margin: 0;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #FFF;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #3e2048;
                border-color: #3e2048;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #3e2048;
            }

            /*------------*/
            body {
                font-family: 'Roboto', sans-serif;
                font-size: 14px;
                line-height: 18px;
                background: #f4f4f4;
            }

            .fa .list-wrapper5 {
                padding: 15px;
                overflow: hidden;
            }

            .list-item5 {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item5 h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item5 p {
                margin: 0;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #FFF;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #3e2048;
                border-color: #3e2048;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #3e2048;
            }

            /*---------------------*/
            body {
                font-family: 'Roboto', sans-serif;
                font-size: 14px;
                line-height: 18px;
                background: #f4f4f4;
            }

            .list-wrapper6 {
                padding: 15px;
                overflow: hidden;
            }

            .list-item6 {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item6 h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item6 p {
                margin: 0;
            }

            .simple-pagination ul {
                margin: 0 0 20px;
                padding: 0;
                list-style: none;
                text-align: center;
            }

            .simple-pagination li {
                display: inline-block;
                margin-right: 5px;
            }

            .simple-pagination li a,
            .simple-pagination li span {
                color: #666;
                padding: 5px 10px;
                text-decoration: none;
                border: 1px solid #EEE;
                background-color: #FFF;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .simple-pagination .current {
                color: #FFF;
                background-color: #3e2048;
                border-color: #3e2048;
            }

            .simple-pagination .prev.current,
            .simple-pagination .next.current {
                background: #3e2048;
            }

            .heading07 h2 span,
            .heading08 h2 span {
                color: #6a7e3b;
            }

            @media screen and (min-width: 650px) {
                .main_grop_box h2 {
                    margin: -19px 0 10px;
                }
            }

            .groupBtnSearch {
                color: #fff !important;
                background-color: #1c4994;
                /* margin-right: 133px!important; */
            }

            .btn {
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 0;
                font-size: 14px;
                font-weight: normal;
                line-height: 1.42857143;
                text-align: center;
                white-space: nowrap;
                vertical-align: middle;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                background-image: none;
                border: 1px solid transparent;
                border-radius: 4px;
            }

            .topstatus.timeline-topstatus .row {
                padding-left: 15px;
                padding-right: 15px;
            }

            .hover_on_btn :hover {
                font-size: 16px !important;
            }

            .list-wrapper11 {
                padding: 15px;
                overflow: hidden;
            }

            .list-item11 {
                display: contents;
                border: 1px solid #EEE;
                background: #FFF;
                margin-bottom: 10px;
                padding: 10px;
                box-shadow: 0px 0px 10px 0px #EEE;
            }

            .list-item11 h4 {
                color: #FF7182;
                font-size: 18px;
                margin: 0 0 5px;
            }

            .list-item11 p {
                margin: 0;
            }
        </style>
    </head>
    <!---#e04e60-->

    <body onload="pageOnload('admin')" class="bg_gray">
        <?php
        include_once ("../header.php");
        $p = new _spprofiles;
        $rp = $p->readProfiles($_SESSION['uid']);
        ?>
        <section class="landing_page">
            <div class="container">
                <div id="sidebar" class="col-md-2 no-padding">
                    <?php include ('../component/left-landing.php'); ?>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <input type="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_"
                            class="album_id" value="">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading01 text-center" id="ip6" style="background-color: white;">
                                <div class="left_head_top" style="margin-left: 10px;margin-top:7px!important;">
                                    <form class="inner_top_form" method="POST"
                                        action="<?php echo $BaseUrl; ?>/my-groups/search-group-old.php">
                                        <div class="row">

                                            <div class="form-group col-sm-3" style="margin-bottom: -8px!important;">
                                                <select class="form-control cate_drop" name="txtCategory" id="SelExample"
                                                    style="width:120%;margin-top:3px;">
                                                    <option value="all">All</option>
                                                    <?php
                                                    //new title
                                                
                                                    $g_cat = new _spgroup;


                                                    $search_title = $g_cat->read_title();
                                                    while ($rows = mysqli_fetch_assoc($search_title)) {
                                                        // print_r($rows);
                                                        ?>
                                                        <option value='<?php echo $rows["id"]; ?>' <?php echo (isset($_POST['txtCategory']) && $_POST['txtCategory'] == $rows["group_category_name"]) ? 'selected' : ''; ?>>
                                                            <?php echo $rows["group_category_name"]; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-5">
                                                <input type="text" style="width:95% !important;margin-left:25px!important;"
                                                    class="form-control searchbox" aria-describedby="basic-addon1"
                                                    name="txtSearch" value="<?php if (isset($_POST['txtSearch'])) {
                                                        echo $_POST['txtSearch'];
                                                    } ?>" placeholder="Search by group title">
                                            </div>
                                            <div class="col-sm-2">
                                                <button class="db_btn groupBtnSearch btn-border-radius" type="submit"
                                                    name="btnSearch" style="height:35px;"><i class="fa fa-search"></i>
                                                    Search</button>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
                                                    <div class="pull-right" style="margin-top: 5px;">
                                                        <label><a href="<?php echo $BaseUrl; ?>/my-groups/create-group.php"
                                                                class="btn btnPosting db_btn db_primarybtn btn-border-radius">
                                                                Create Group</a></label>
                                                    </div>

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="bs-example bs-example-tabs " role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs nav-tabs-responsive text-center" role="tablist"
                                    style="background-color: #ffffff; margin-top: 10px;height: 92px;">
                                    <style>
                                        .nav>li>a {
                                            position: relative;
                                            display: block;
                                            padding: 12px;
                                        }
                                    </style>
                                    <li class="pull-left" role="presentation" class="next">
                                        <a href="#mygroup" role="tab" id="mygroup-tab" data-toggle="tab"
                                            aria-controls="mygroup">
                                            <span class="text">My Group</span>
                                        </a>
                                    </li>
                                    <li class="pull-left" role="presentation" class="next">
                                        <a href="#suggest" id="suggest-tab" role="tab" data-toggle="tab"
                                            aria-controls="suggest" aria-expanded="true">
                                            <span class="text">Suggested Group</span>
                                        </a>
                                    </li>
                                    <li class="pull-left" role="presentation" class="next">
                                        <a href="#pending" id="pending-tab" role="tab" data-toggle="tab"
                                            aria-controls="pending" aria-expanded="true">
                                            <span class="text">Pending Request</span>
                                        </a>
                                    </li>
                                    <li class="pull-left" role="presentation" class="next">
                                        <a href="#profile" role="tab" id="profile-tab" data-toggle="tab"
                                            aria-controls="profile" aria-expanded="true">
                                            <span class="text">Joined Group</span>
                                        </a>
                                    </li>
                                    <li class="pull-left" role="presentation" class="next">
                                        <a href="#friend" id="friend-tab" role="tab" data-toggle="tab"
                                            aria-controls="friend" aria-expanded="true">
                                            <span class="text">Friends Group</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="friend"
                                    aria-labelledby="friend-tab">
                                    <div class="topstatus timeline-topstatus " style="margin-top: 23px;">
                                        <div class="row ">
                                            <div class="list-wrapper">
                                                <h4 style="color: #0b241e;border-bottom: 1px solid #0b241e;">GROUPS BY MY
                                                    FRIENDS</h4>
                                                <!-- <p style="text-align:end"><a href="<?php echo $BaseUrl; ?>/my-groups/group-intrest.php">View/Update My Interest</a></p> -->
                                                <?php
                                                    $r = new _spprofilehasprofile;
                                                    $res = $r->readallfriend($_SESSION["pid"]); //As a sender
                                                    //print_r($res);
                                                    //die("===");   
                                            
                                                if ($res != false) {
                                                    while ($rows = mysqli_fetch_assoc($res)) {

                                                        $g = new _spgroup;
                                                        $result = $g->profilegroupmember_d($rows['spProfiles_idspProfilesReceiver']);



                                                        if ($result != false) {
                                                            $bg_clr = 1;
                                                            while ($row5 = mysqli_fetch_assoc($result)) {


                                                                // print_r($row5);
                                                                // die('xxxxx');
                                            
                                                                $r = new _spprofilehasprofile;

                                                                $result6 = $g->groupmember($_SESSION['uid']);
                                                                if ($result6 != false) {
                                                                    $i = 0;
                                                                    while ($row6 = mysqli_fetch_assoc($result6)) {

                                                                        if ($row5['idspGroup'] == $row6['idspGroup']) {
                                                                            $i++;
                                                                        }
                                                                    }
                                                                }
                                                                //echo $i;
                                                                // die('========');
                                                                //IF GROUP IS NOT FOUND THEN SHOW IT;
                                                                //if ($i == 1) {
                                            
                                                                $friendcount++;
                                                                $result2 = $g->groupdetails($row5['idspGroup']);
                                                                if ($result2 != false) {
                                                                    $row2 = mysqli_fetch_assoc($result2);
                                                                    $gdes = $row2["spGroupAbout"];

                                                                    $gimage = $row2["spgroupimage"];
                                                                }
                                                                //GET ADMIN  NAME OR IMAGE
                                                                $rpvt = $g->members($row5['idspGroup']);
                                                                // echo $g->ta->sql;
                                                                if ($rpvt != false) {
                                                                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                        if ($row3['spUser_idspUser'] != NULL) {
                                                                            $st = new _spuser;
                                                                            $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                                                                            if ($st1 != false) {
                                                                                $stt = mysqli_fetch_assoc($st1);
                                                                                $account_status = $stt['deactivate_status'];
                                                                            }
                                                                        }
                                                                        if ($row3['spProfileIsAdmin'] == 0) {
                                                                            $spProfilePic = $row3['spProfilePic'];
                                                                            $Group_Admin_Name = $row3['spProfileName'];
                                                                        }
                                                                    }
                                                                }
                                                                // echo $rGroup_Admin_Name; die;
                                                                if ($account_status != 1) { ?>
                                                                    <div class="list-item">
                                                                        <div class="col-md-4 no-padding 11" style=" border-style: groove;">
                                                                            <a
                                                                                href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row5['idspGroup']; ?>&groupname=<?php echo $row5['spGroupName']; ?>&timeline&page=1">
                                                                                <div class="main_grop_box <?php echo ''; ?>"
                                                                                    style="min-height: 215px!important;">
                                                                                    <?php
                                                                                    if ($gimage == "") { ?>
                                                                                        <img 11
                                                                                            src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp"
                                                                                            class="img-responsive group_banner" alt=""
                                                                                            style="height:160px;" /><?php
                                                                                    } else { ?>
                                                                                        <img 222
                                                                                            src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>"
                                                                                            class="img-responsive group_banner" alt=""
                                                                                            style="height:160px;" /><?php
                                                                                    }

                                                                                    if ($spProfilePic != "") { ?>
                                                                                        <img src="<?php echo ($spProfilePic); ?>"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:145px;" /> <?php
                                                                                    } else { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:145px;" /> <?php
                                                                                    } ?>
                                                                                    <div style=" background-color:white;">
                                                                                        <!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->
                                                                                        <style>
                                                                                            /* .smalldot {
                                                                                            width: 100px;
                                                                                            overflow: hidden;
                                                                                            display: inline-block;
                                                                                            text-overflow: ellipsis;
                                                                                            white-space: nowrap;
                                                                                            }   */
                                                                                        </style>
                                                                                        <h2><?php echo ucwords(strtolower($row['spGroupName'])); ?><?php if ($row['spgroupflag'] == 1) {
                                                                                               echo '<h6 style="color:black;"><i class="fa fa-lock"></i> Private Group</h6>';
                                                                                           } else {
                                                                                               echo '<div class="f-group-wrap" style="color:black;"><i class="fa fa-globe gname "></i>' . ucwords(strtolower($row5['spGroupName'])) . '</div>';
                                                                                           } ?>
                                                                                           </h2>


                                                                                        <span style="word-wrap: break-word;
    
                                                                                            margin-left: 60px;
                                                                                            text-align: left;">


                                                                                            (
                                                                                            <?php

                                                                                            $gcate = $g->read_category($row5['spgroupCategory']);
                                                                                            //echo $g->ta->sql;
                                                                                            if ($gcate != false) {
                                                                                                while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                                                                    echo $groupcate['group_category_name'];
                                                                                                }
                                                                                            } ?>
                                                                                            )
                                                                                        </span>
                                                                                        <?php ?>







                                                                                        <?php
                                                                                        //count member old and new
                                                                                        $result3 = $g->allgrpmember($row5['idspGroup']);
                                                                                        $total_member = mysqli_num_rows($result3);
                                                                                        $result4 = $g->newgrpmember($row5['idspGroup']);
                                                                                        // echo $g->tad->sql;
                                                                                        if (!empty($result4)) {
                                                                                            $new_tot_member = mysqli_num_rows($result4);
                                                                                        } else {
                                                                                            $new_tot_member = 0;
                                                                                        }
                                                                                        ?>
                                                                                        <h6 style="text-align:left; padding:8px ;color:black;">
                                                                                            <?php echo $total_member; ?> members
                                                                                        </h6>
                                                                                        <h6
                                                                                            style="float:right; padding:8px ;color:black;margin-top: -25px;">
                                                                                            <?php echo $new_tot_member; ?> new members
                                                                                        </h6>
                                                                                    </div>
                                                                                    <!-- <span class="btn pull-left btn btnPosting db_btn db_primarybtn" style="top:50px;margin-bottom: 5px;margin-left: 80px;"><img src="<?php echo $BaseUrl; ?>" class="img-responsive" alt="" />Timeline</span> -->
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                            }
                                                        }
                                                    }
                                                }


                                                /////////+++++++++++++++++++++++++**************************\\\\\\\\\\\\
                                                $r = new _spprofilehasprofile;
                                                $res = $r->readall($_SESSION["pid"]); //As a sender
//print_r($res);
//die("===");
                                            
                                                if ($res != false) {
                                                    while ($rows = mysqli_fetch_assoc($res)) {
                                                        //print_r($rows);
                                                        $g = new _spgroup;
                                                        $result = $g->profilegroupmember_d($rows['spProfiles_idspProfileSender']);
                                                        //print_r($result);
                                            

                                                        if ($result != false) {
                                                            $bg_clr = 1;
                                                            while ($row5 = mysqli_fetch_assoc($result)) {

                                                                $r = new _spprofilehasprofile;

                                                                $result6 = $g->groupmember($_SESSION['uid']);
                                                                if ($result6 != false) {
                                                                    $i = 0;
                                                                    while ($row6 = mysqli_fetch_assoc($result6)) {

                                                                        if ($row5['idspGroup'] == $row6['idspGroup']) {
                                                                            $i++;
                                                                        }
                                                                    }
                                                                }
                                                                //echo $i;
// die('========');
//IF GROUP IS NOT FOUND THEN SHOW IT;
//if ($i == 1) {
                                            
                                                                $friendcount++;
                                                                $result2 = $g->groupdetails($row5['idspGroup']);
                                                                if ($result2 != false) {
                                                                    $row2 = mysqli_fetch_assoc($result2);
                                                                    $gdes = $row2["spGroupAbout"];

                                                                    $gimage = $row2["spgroupimage"];
                                                                }
                                                                //GET ADMIN  NAME OR IMAGE
//echo $row5['idspGroup'];
                                                                $rpvt = $g->members($row5['idspGroup']);
                                                                //print_r($rpvt);
// echo $g->ta->sql;
                                                                if ($rpvt != false) {
                                                                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                        //print_r($row3);
                                                                        if ($row3['spUser_idspUser'] != NULL) {
                                                                            $st = new _spuser;
                                                                            $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                                                                            //print_r($st1);
                                                                            if ($st1 != false) {
                                                                                $stt = mysqli_fetch_assoc($st1);
                                                                                $account_status = $stt['deactivate_status'];
                                                                            }
                                                                        }
                                                                        if ($row3['spProfileIsAdmin'] == 0) {
                                                                            $spProfilePic = $row3['spProfilePic'];
                                                                            $Group_Admin_Name = $row3['spProfileName'];
                                                                        }
                                                                    }
                                                                }
                                                                // echo $rGroup_Admin_Name; die;
                                                                if ($account_status != 1) { ?>
                                                                    <div class="list-item">
                                                                        <div class="col-md-4 no-padding 22" style=" border-style: groove;">
                                                                            <a
                                                                                href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row5['idspGroup']; ?>&groupname=<?php echo $row5['spGroupName']; ?>&timeline&page=1">
                                                                                <div class="main_grop_box <?php echo ''; ?>"
                                                                                    style="min-height: 215px!important;">
                                                                                    <?php
                                                                                    if ($gimage == "") { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp"
                                                                                            class="img-responsive group_banner" alt=""
                                                                                            style="height:160px;" /><?php
                                                                                    } else { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>"
                                                                                            class="img-responsive group_banner" alt=""
                                                                                            style="height:160px;" /><?php
                                                                                    }

                                                                                    if ($spProfilePic != "") { ?>
                                                                                        <img src="<?php echo ($spProfilePic); ?>"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:145px;" /> <?php
                                                                                    } else { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:145px;" /> <?php
                                                                                    } ?>
                                                                                    <div style=" background-color:white;">
                                                                                        <!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->
                                                                                        <style>
                                                                                            /* .smalldot {
                                                                        width: 100px;
                                                                        overflow: hidden;
                                                                        display: inline-block;
                                                                        text-overflow: ellipsis;
                                                                        white-space: nowrap; style="height:20px;"
                                                                        } */
                                                                                        </style>
                                                                                        <h2><?php echo ucwords(strtolower($row['spGroupName'])); ?><?php if ($row['spgroupflag'] == 1) {
                                                                                               echo '<h6 style="color:black;"><i class="fa fa-lock"></i> Private Group</h6>';
                                                                                           } else {
                                                                                               echo '<h6 style="color:black;margin-top:20px;margin-left: 5px;height:40px;font-family: MarksimonRegula;margin-right: 85px;font-size: 17px;">' . ucwords(strtolower($row5['spGroupName'])) . '</h6>';
                                                                                           } ?></h2>

                                                                                        <span style="word-wrap: break-word;
    
    margin-left: 60px;
    text-align: left;">


                                                                                            (
                                                                                            <?php

                                                                                            $gcate = $g->read_category($row5['spgroupCategory']);
                                                                                            //echo $g->ta->sql;
                                                                                            if ($gcate != false) {
                                                                                                while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                                                                    echo $groupcate['group_category_name'];
                                                                                                }
                                                                                            } ?>
                                                                                            )
                                                                                        </span>
                                                                                        <?php
                                                                                        //count member old and new
                                                                                        $result3 = $g->allgrpmember($row5['idspGroup']);
                                                                                        $total_member = mysqli_num_rows($result3);
                                                                                        $result4 = $g->newgrpmember($row5['idspGroup']);
                                                                                        // echo $g->tad->sql;
                                                                                        if (!empty($result4)) {
                                                                                            $new_tot_member = mysqli_num_rows($result4);
                                                                                        } else {
                                                                                            $new_tot_member = 0;
                                                                                        }
                                                                                        ?>
                                                                                        <div class="row" style="margin-bottom:-8px">
                                                                                            <div class="col-md-6">
                                                                                                <h6
                                                                                                    style="text-align:left; padding:8px ;color:black;">
                                                                                                    <i
                                                                                                        class="fa fa-globe"></i><?php echo $total_member; ?>
                                                                                                    members
                                                                                                </h6>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <h6
                                                                                                    style="float:right; padding:8px ;color:black;">
                                                                                                    <?php echo $new_tot_member; ?> Members
                                                                                                </h6>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--<span class="btn pull-left btn btnPosting db_btn db_primarybtn" style="top:50px;margin-bottom: 5px;margin-left: 80px; margin-top: 10px"><img src="<?php echo $BaseUrl; ?>" class="img-responsive" alt="" />Timeline</span>-->
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                                //}
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    //echo "<p class='text-center'>Friend group not available.</p>";
                                                }
                                                if ($friendcount > 3) {
                                                    ?>
                                                    <span class="pull-right seemore">
                                                        <a class="pull-right" href="all_friends_group.php"
                                                            style="color: #0b241e;">View More</a></span>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            if ($result5 != false) {
                                                ?>
                                                <div id="pagination-container"></div>
                                            <?php } ?>
                                            <div class="list-wrapper6">
                                                <h4 style="color: #0b241e;border-bottom: 1px solid #0b241e;">GROUPS IN MY
                                                    CITY</h4>
                                                <?php
                                                $u = new _spuser;
                                                $res = $u->read($_SESSION["uid"]);
                                                if ($res != false) {
                                                    $ruser = mysqli_fetch_assoc($res);
                                                    $usercity = $ruser["spUserCity"];
                                                }
                                                //echo $usercity.'hello';  
                                            
                                                $g = new _spgroup;
                                                $result = $g->getMyCityGroup($_SESSION['pid'], $usercity);


                                                // echo $g->ta->sql;
                                                if ($result != false) {
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $citycount = 0;

                                                        $gdes = $row2["spGroupAbout"];
                                                        $result2 = $g->groupdetailspublicprivate($row['idspGroup']);

                                                        $baneer_iamge = $g->read_bannerimage($row['idspGroup']);
                                                        $baneer_iamge_row = mysqli_fetch_assoc($baneer_iamge);
                                                        $gimage = $baneer_iamge_row['spgroupimage'];

                                                        if ($result2 != false) {
                                                            $row2 = mysqli_fetch_assoc($result2);

                                                            $gname = $row2["spGroupName"];
                                                            $gtag = $row2["spGroupTag"];
                                                            $gdes = $row2["spGroupAbout"];
                                                            $gtype = $row2["spgroupflag"];
                                                            $gcategory = $row2["spgroupCategory"];
                                                            $glocation = $row2["spgroupLocation"];
                                                        }

                                                        $rpvt = $g->members($row['idspGroup']);
                                                        //echo $g->ta->sql;
                                                        if ($rpvt != false) {
                                                            while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                if ($row3['spProfileIsAdmin'] == 0) {

                                                                    $citycount++;

                                                                    $spProfilePic = $row3['spProfilePic'];
                                                                    $Group_Admin_Name = $row3['spProfileName'];
                                                                }
                                                            }
                                                        }

                                                        if ($row['spgroupstatus'] == 0) {
                                                            ?>
                                                            <div class="list-item6">
                                                                <div class="col-md-4 no-padding 33" style=" border-style: groove; ">
                                                                    <a
                                                                        href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup']; ?>&groupname=<?php echo $row['spGroupName']; ?>&timeline&page=1">
                                                                        <div class="main_grop_box <?php echo ''; ?>"
                                                                            style="min-height: 215px!important;">
                                                                            <?php
                                                                            if ($gimage == "") { ?>
                                                                                <img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp"
                                                                                    class="img-responsive group_banner" alt=""
                                                                                    style="height:160px;" /><?php
                                                                            } else { ?>
                                                                                <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>"
                                                                                    class="img-responsive group_banner" alt=""
                                                                                    style="height:160px;" /><?php
                                                                            }

                                                                            if ($spProfilePic != "") { ?>
                                                                                <img src="<?php echo ($spProfilePic); ?>"
                                                                                    class="img-circle group_create" alt=""
                                                                                    style="top:145px;" /> <?php
                                                                            } else { ?>
                                                                                <img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png"
                                                                                    class="img-circle group_create" alt=""
                                                                                    style="top:145px;" /> <?php
                                                                            } ?>
                                                                            <div style=" background-color:white;">
                                                                                <!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->


                                                                                <h2 style="    color: black;
margin-top: 0px;
word-wrap: break-word;
    margin-left: 60px;
    text-align: left;
height: 10px;
font-family: MarksimonRegula;
margin-right: 85px;
font-size: 17px;">
                                                                                    <?php
                                                                                    if (strlen($row['spGroupName'])) {
                                                                                        echo ucwords(strtolower($row['spGroupName']));
                                                                                    } else {
                                                                                        echo ucwords(strtolower($row['spGroupName']));
                                                                                    }
                                                                                    ?>

                                                                                </h2>
                                                                                <br>
                                                                                <span style="display: flex;
  justify-content: center;
  align-items: center;">


                                                                                    (
                                                                                    <?php

                                                                                    $gcate = $g->read_category($row['spgroupCategory']);
                                                                                    //echo $g->ta->sql;
                                                                                    if ($gcate != false) {
                                                                                        while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                                                            echo $groupcate['group_category_name'];
                                                                                        }
                                                                                    } ?>
                                                                                    )
                                                                                </span>




                                                                                <!-- <span>dfgdfg</span> -->
                                                                                <div class="row" style="margin-top: 10px;">
                                                                                    <div class="col-md-6">
                                                                                        <?php if ($row['spgroupflag'] == 1) {
                                                                                            echo '<h6 style="color:black;"><i class="fa fa-lock"></i> Private Group</h6>';
                                                                                        } else {
                                                                                            echo '<h6 style="color:black;"><i class="fa fa-globe"></i> Public Group</h6>';
                                                                                        } ?>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <?php
                                                                                        //count member old and new
                                                                                        $result3 = $g->joinedMembersOfGroup($row['idspGroup']);
                                                                                        $total_member = mysqli_num_rows($result3);
                                                                                        $result4 = $g->newgrpmember($row['idspGroup']);
                                                                                        //echo $g->tad->sql;
                                                                                        if (!empty($result4)) {
                                                                                            $new_tot_member = mysqli_num_rows($result4);
                                                                                        } else {
                                                                                            $new_tot_member = 0;
                                                                                        }
                                                                                        ?>
                                                                                        <h6 style=" color:black;">
                                                                                            <?php echo $total_member; ?> members
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <!-- <span class="btn pull-left btn btnPosting db_btn db_primarybtn" style="top:50px;margin-bottom: 5px;margin-left: 70px;margin-top: 10px"><img src="<?php echo $BaseUrl; ?>" class="img-responsive" alt="" />Timeline</span> -->
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                    }
                                                }
                                                if ($citycount == 3) {
                                                    ?>
                                                    <span class="pull-right seemore">
                                                        <a class="pull-right" href="all_city_group.php"
                                                            style="color: #0b241e;">View More</a>
                                                    </span>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            if ($result != false) {
                                                ?>
                                                <div id="pagination-container6"></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- friend group -->
                                <!---- <div role="tabpanel" class="tab-pane fade" id="friend" aria-labelledby="friend-tab">
<div class="topstatus timeline-topstatus " style="margin-top: 23px;">
<div class="row" >
<div class="list-wrapper1">
<?php
        $r = new _spprofilehasprofile;
        $res = $r->friends($_SESSION["pid"]);
        // echo $r->ta->sql;
        if ($res != false) {
            while ($row4 = mysqli_fetch_assoc($res)) {

                $g = new _spgroup;
                $result5 = $g->group($row4['spProfiles_idspProfileSender']);
                // echo $g->ta->sql;
    
                if ($result5 != false) {

                    while ($row5 = mysqli_fetch_assoc($result5)) {
                        $result6 = $g->groupmember($_SESSION['uid']);
                        if ($result6 != false) {
                            $i = 0;
                            while ($row6 = mysqli_fetch_assoc($result6)) {
                                if ($row5['idspGroup'] == $row6['idspGroup']) {
                                    $i++;
                                }
                            }
                            //IF GROUP IS NOT FOUND THEN SHOW IT;
                            if ($i == 0) {
                                $result2 = $g->groupdetails($row5['idspGroup']);
                                if ($result2 != false) {
                                    $row2 = mysqli_fetch_assoc($result2);
                                    $gdes = $row2["spGroupAbout"];
                                    $gimage = $row2["spgroupimage"];
                                }
                                //GET ADMIN  NAME OR IMAGE
                                $rpvt = $g->members($row['idspGroup']);
                                // echo $g->ta->sql;
                                if ($rpvt != false) {
                                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                        if ($row3['spProfileIsAdmin'] == 0) {
                                            $spProfilePic = $row3['spProfilePic'];
                                            $Group_Admin_Name = $row3['spProfileName'];
                                        }
                                    }
                                }
                                ?>
<div class="list-item1">
<div class="col-md-4 no-padding" style=" border-style: groove; ">
<a href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row5['idspGroup'] ?>&groupname=<?php echo $row5['spGroupName'] ?>&timeline" >
<div class="main_grop_box bg_brown_dark">
<?php
                                                        if ($gimage == "") { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_main_banner.jpg" class="img-responsive group_banner" alt="" /><?php
                                                        } else { ?>
<img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>" class="img-responsive group_banner" alt="" /><?php
                                                        }

                                                        if ($spProfilePic != "") { ?>
<img src="<?php echo ($spProfilePic); ?>" class="img-circle group_create" alt="" /> <?php
                                                        } else { ?>
<img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png" class="img-circle group_create" alt="" /> <?php
                                                        } ?>

<h4><?php echo $Group_Admin_Name; ?></h4>
<h2><?php echo ucwords(strtolower($row5['spGroupName'])); ?></h2>
<?php
                                                        //count member old and new
                                                        $result3 = $g->allgrpmember($row5['idspGroup']);
                                                        $total_member = mysqli_num_rows($result3);
                                                        $result4 = $g->newgrpmember($row5['idspGroup']);
                                                        // echo $g->tad->sql;
                                                        if (!empty($result4)) {
                                                            $new_tot_member = mysqli_num_rows($result4);
                                                        } else {
                                                            $new_tot_member = 0;
                                                        }
                                                        ?>
<h6><?php echo $total_member; ?> members · <?php echo $new_tot_member; ?> new members</h6>
<span class="btn pull-right btn_gray_light"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_multi_user_btn.png" class="img-responsive" alt="" />Timeline</span>



</div>
</a>
</div> 
</div>
<?php
                            }
                        }
                    }
                    ?>
<div id="pagination-container1"></div>
<?php
                }
            }
        } else {
            echo "<p class='text-center'>Friend group not available.</p>";
        }
        ?>
</div>

</div>
</div>
</div>-->
                                <!----   pending request -->
                                <div role="tabpanel" class="tab-pane fade" id="pending" aria-labelledby="pending-tab">
                                    <div class="topstatus timeline-topstatus " style="margin-top: 23px;">
                                        <div class="row ">
                                            <div class="list-wrapper2">
                                                <!-- <//h4 style="color: #0b241e;margin-top: 0px;border-top: 1px solid #0b241e;"> -->
                                                <h4 style="color: #0b241e;border-bottom: 1px solid #0b241e;">PENDING
                                                    REQUESTS</h4>
                                                <!-- <a class="pull-right" href="<?php //echo $BaseUrl;
                                                    ?>/my-groups/group-intrest.php">ACC/UPDATE MY INTEREST</a></h4>-->
                                                <h5 style="color: #0b241e;margin-top:-10px;">
                                                    <?php
                                                    $g = new _spgroup;
                                                    /*
                                                    $re = $g->profilegroupmember($_SESSION['pid']);


                                                    if ($re != false) {

                                                    while ($r = mysqli_fetch_assoc($re)) {*/
                                                    //print_r($r);
                                                    $result = $g->readpendingrequest($_SESSION['pid']);

                                                    //$result = $g->readpendingrequest($_SESSION['pid']);
                                                    //  echo $g->ta->sql;
                                                    if ($result != false) {
                                                        $bg_clr = 1;
                                                        //  print_r($result);
                                                
                                                        while ($row = mysqli_fetch_assoc($result)) {

                                                            if ($row['spuser_idspuser'] != NULL) {
                                                                $st = new _spuser;
                                                                $st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
                                                                if ($st1 != false) {
                                                                    $stt = mysqli_fetch_assoc($st1);
                                                                    $account_status = $stt['deactivate_status'];
                                                                }
                                                            }
                                                            $id = $row['id'];
                                                            //echo "<pre>";
                                                            // print_r($row);
                                                            //color background
                                                            if ($bg_clr == 1) {
                                                                $bg_clr_box = "bg_black";
                                                            } else if ($bg_clr == 2) {
                                                                $bg_clr_box = "bg_green_dark";
                                                            } else if ($bg_clr == 3) {
                                                                $bg_clr_box = "bg_pink_dark";
                                                            } else if ($bg_clr == 4) {
                                                                $bg_clr_box = "bg_red_dark";
                                                            } else if ($bg_clr == 5) {
                                                                $bg_clr_box = "bg_color_2";
                                                            } else if ($bg_clr == 6) {
                                                                $bg_clr_box = "bg_color_1";
                                                            }

                                                            //  if($row['spProfileIsAdmin'] == 1){
                                                            //$g = new _spgroup;
                                                            //GET GROP BANNER, GROP DESCRIPTION 
                                                            $result2 = $g->groupdetailspublicprivate($row['spGroup_idspGroup']);

                                                            if ($result2 != false) {
                                                                $row2 = mysqli_fetch_assoc($result2);

                                                                $gname = $row2["spGroupName"];
                                                                $gtag = $row2["spGroupTag"];
                                                                $gdes = $row2["spGroupAbout"];
                                                                $gtype = $row2["spgroupflag"];
                                                                $gcategory = $row2["spgroupCategory"];
                                                                $glocation = $row2["spgroupLocation"];
                                                                //$gimage = $row2["spgroupimage"];
                                                                //echo $gimage;
                                                            }
                                                            //GET ADMIN  NAME OR IMAGE
                                                            // $p = new _spgroup; //Admin will come on top
                                                            $rpvt = $g->members($row['idspGroup']);
                                                            //echo $g->ta->sql;
                                                            if ($rpvt != false) {
                                                                while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                    if ($row3['spProfileIsAdmin'] == 0) {
                                                                        $spProfilePic = $row3['spProfilePic'];
                                                                        $Group_Admin_Name = $row3['spProfileName'];
                                                                    }
                                                                }
                                                            }
                                                            if ($row['spgroupstatus'] == 0) {
                                                                ?>
                                                                <div class="list-item2">
                                                                    <?php if ($account_status != 1) { ?>
                                                                        <div class="col-md-4 no-padding 44"
                                                                            style="border-style: groove; margin-top:20px;">
                                                                            <a
                                                                                href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline&page=1">
                                                                                <div class="main_grop_box <?php echo ''; ?>"
                                                                                    style="min-height: 200px!important;">

                                                                                    <?php
                                                                                    if ($r->spgroupimage == "") { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp"
                                                                                            class="img-responsive group_banner"
                                                                                            style="height:160px;" alt="" /><?php
                                                                                    } else { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $r['spgroupimage']; ?>"
                                                                                            class="img-responsive group_banner" alt=""
                                                                                            style="height:160px;" /><?php
                                                                                    }

                                                                                    if ($spProfilePic != "") { ?>
                                                                                        <img src="<?php echo ($spProfilePic); ?>"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:140px;" /> <?php
                                                                                    } else { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:140px;" /> <?php
                                                                                    } ?>
                                                                                    <div class="row pt-5">
                                                                                        <?php if (strlen($row['spGroupName']) < 10) { ?>
                                                                                            <h2
                                                                                                style="color: black;margin-top: 5px;height:20px">
                                                                                                <?php echo ucwords(strtolower($row['spGroupName'])); ?>
                                                                                            <?php } else { ?>
                                                                                                <h2
                                                                                                    style="color: black;margin-top: 5px;height:20px">
                                                                                                    <?php echo ucwords(strtolower(substr($row['spGroupName'], 0, 10) . '...')); ?>
                                                                                                <?php } ?>
                                                                                                <br>
                                                                                                <span>(
                                                                                                    <?php
                                                                                                    //  $gcate = ($row['spgroupCategory']); 
                                                                                                    $gcate = $g->read_category($row['spgroupCategory']);
                                                                                                    //echo $g->ta->sql;
                                                                                                    if ($gcate != false) {
                                                                                                        while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                                                                            echo $groupcate['group_category_name'];
                                                                                                        }
                                                                                                    }

                                                                                                    ?> )
                                                                                                </span>
                                                                                            </h2>
                                                                                            <div class="col-md-6 pt-5">
                                                                                                <!-- <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->
                                                                                                <?php if ($row['spgroupflag'] == 1) {
                                                                                                    echo '<h6><i class="fa fa-lock"></i> Private Group</h6>';
                                                                                                } else {
                                                                                                    echo '<h6 style="margin-top: 25px;margin-right: 0px"><i class="fa fa-globe"></i> Public Group</h6>';
                                                                                                } ?>
                                                                                                <?php
                                                                                                //count member old and new
                                                                                                $result3 = $g->joinedMembersOfGroup($row['idspGroup']);
                                                                                                if ($result3 != false) {
                                                                                                    $total_member = mysqli_num_rows($result3);
                                                                                                }
                                                                                                $result4 = $g->newgrpmember($row['idspGroup']);
                                                                                                //echo $g->tad->sql;
                                                                                                if (!empty($result4)) {
                                                                                                    $new_tot_member = mysqli_num_rows($result4);
                                                                                                } else {
                                                                                                    $new_tot_member = 0;
                                                                                                }
                                                                                                ?>
                                                                                            </div>
                                                                                            <div class="col-md-6">
                                                                                                <h6 style="text-align: right;margin-top:25px;
            ">
                                                                                                    <?php echo $total_member; ?> members
                                                                                                    <!--<?php echo $new_tot_member; ?> new members -->
                                                                                                </h6>
                                                                                                <br>
                                                                                                <!--  <span  class="btn pull-left btn btnPosting db_btn db_primarybtn" style="top:100px; margin-bottom: 5px; margin-top:10px;">Timeline33</span> -->
                                                                                            </div>
                                                                                            &nbsp;&nbsp;&nbsp;
                                                                                            <button class="view_left_joinbtn btn-success"
                                                                                                type="sumbit"
                                                                                                style="margin-top:8px;margin-left: 60px;">
                                                                                                <a href="<?php echo $BaseUrl . '/my-friend/acceptrequest.php?pid=' . $row['spProfiles_idspProfiles'] . '&gid=' . $row['idspGroup'] . '&groupname=' . $row['spGroupName'] . '&timeline'; ?>"
                                                                                                    onclick="return confirm('Are You Sure Want to Accept !')"
                                                                                                    style="color: #fff;">Accept</a></button>
                                                                                            <button class="view_left_joinbtn btn-success"
                                                                                                type="sumbit" style="margin-top:8px;"><a
                                                                                                    href="pending_reqest2.php?postid=<?php echo $id ?>"
                                                                                                    style="color: #fff;">Reject</a></button>
                                                                                            <?php
                                                                                            $d = $g->read_profileName($row['spProfiles_idspProfiles']);
                                                                                            if ($d != false) {
                                                                                                $da = mysqli_fetch_assoc($d);
                                                                                                //print_r($da);
                                                                                            }

                                                                                            ?>
                                                                                            <a
                                                                                                href="<?php echo $BaseUrl; ?>/friends/?profileid=<?php echo $da['idspProfiles'] ?>">
                                                                                                <!-- <?php if (strlen($da['spProfileName']) < 15) { ?>
                                                                                        <span><b><?php echo ucwords(strtolower($da['spProfileName'])); ?></b></span>
                                                                                        <?php } else { ?>
                                                                                        <span><b><?php echo ucwords(strtolower(substr($da['spProfileName'], 0, 15) . '...')); ?></b></span>
                                                                                        <?php } ?> -->
                                                                                            </a>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php }
                                                            if ($bg_clr < 6) {
                                                                $bg_clr++;
                                                            } else {
                                                                $bg_clr = 1;
                                                            }
                                                            /*  }*/ ?>
                                                            <?php
                                                            /*}
                                                            }*/
                                                        }
                                                    } else {

                                                        echo "<p class='text-center mb-10'>No Pending Request.</p>";
                                                    }

                                                    ?>
                                            </div>
                                            &nbsp;&nbsp;&nbsp;
                                        </div>
                                        <?php
                                        if ($result != false) {
                                            ?>
                                            <div id="pagination-container2"></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="suggest" aria-labelledby="suggest-tab">
                                    <div class="topstatus timeline-topstatus " style="margin-top: 23px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="heading01 text-center" style="background: white;height: auto;">
                                                    <div class="">
                                                        <h4 style="color: #0b241e;margin-top: 8px;    font-size: 14px;">
                                                            Groups You Might Be Interested In. <a style="margin-right: 9px;"
                                                                class="pull-right" href="<?php //echo $BaseUrl;
                                                                    ?>/my-groups/group-intrest.php">View/Update My
                                                                Interest</a></h4>
                                                    </div>
                                                    <div>
                                                        <!--
                                                        <span class="pull-right seemore" style="margin-right: 20px;">
                                                        <button class="view_right_joinbtn hover_on_btn">&nbsp;
                                                        <a class="pull-right" href="all_suggested_group.php" style="color: #fff; width:80px;">View More</a></button></span>-->

                                                        <div class="suggest list-wrapper11">
                                                            <?php
                                                            $g = new _spgroup;
                                                            $suggest = $g->suggest_group();
                                                            // $result2 = $g->groupdetailspublic($row['idspGroup']);
                                                            $count = $suggest->num_rows;

                                                            $intr = new _groupsponsor;
                                                            $data = $intr->get_id($_SESSION["pid"]);
                                                            $aa = [];

                                                            if ($data != false) {
                                                                while ($row = mysqli_fetch_assoc($data)) {

                                                                    $aa[] = $row['intrest_id'];

                                                                }
                                                            }

                                                            if ($suggest) {

                                                                while ($row2 = mysqli_fetch_assoc($suggest)) {
                                                                    if ($row2['spProfiles_idspProfiles'] == $_SESSION['pid']) {
                                                                        continue;
                                                                    }
                                                                    if (!in_array($row2['spgroupCategory'], $aa)) {
                                                                        continue;
                                                                    }

                                                                    $gname = $row2["spGroupName"];
                                                                    $gtag = $row2["spGroupTag"];
                                                                    $gdes = $row2["spGroupAbout"];
                                                                    $gtype = $row2["spgroupflag"];
                                                                    $gcategory = $row2["spgroupCategory"];
                                                                    $glocation = $row2["spgroupLocation"];
                                                                    $gimage = $row2["spgroupimage"];
                                                                    $sp_group = $row2['idspGroup'];
                                                                    $sp_images = "";
                                                                    $kk = new _spgroup;
                                                                    $rshow = $kk->skk_gg($sp_group);
                                                                    if ($rshow) {
                                                                        $ressult11 = mysqli_fetch_assoc($rshow);


                                                                        $pidd = $ressult11['spProfiles_idspProfiles'];



                                                                        $mhk = $kk->smmkk($pidd);
                                                                        if ($mhk != false) {
                                                                            $result33 = mysqli_fetch_assoc($mhk);

                                                                            $sp_images = $result33['spProfilePic'];

                                                                        }
                                                                    }

                                                                    ?>



                                                                    <div class="list-item11">
                                                                        <div class="col-md-4 no-padding suggest"
                                                                            style=" border-style: groove; background-color: white;">
                                                                            <a
                                                                                href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $sp_group; ?>&groupname=<?php echo $gname; ?>&timeline">
                                                                                <div class="main_grop_box <?php echo $bg_clr_box; ?>"
                                                                                    style="min-height: 215px!important;">
                                                                                    <?php

                                                                                    if ($gimage == "") { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp"
                                                                                            class="img-responsive group_banner" alt=""
                                                                                            style="height:160px;" /><?php
                                                                                    } else { ?>
                                                                                        <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>"
                                                                                            class="img-responsive group_banner" alt=""
                                                                                            style="height:160px;" /><?php
                                                                                    }

                                                                                    if ($sp_images != "") { ?>
                                                                                        <img src="<?php echo $sp_images; ?>"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:145px;" /> <?php
                                                                                    } else { ?>

                                                                                        <img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png"
                                                                                            class="img-circle group_create" alt=""
                                                                                            style="top:145px;" /> <?php
                                                                                    } ?>
                                                                                    <div style=" background-color:white;">
                                                                                        <!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->

                                                                                        <!--    <h4 class="textblack"><?php //echo ucfirst($Group_Admin_Name); 
                                                                                                    ?></h4> -->
                                                                                        <style>
                                                                                            #group {
                                                                                                width: 100px;
                                                                                                overflow: hidden;
                                                                                                display: inline-block;
                                                                                                text-overflow: ellipsis;
                                                                                                white-space: nowrap;
                                                                                            }
                                                                                        </style>
                                                                                        <h2 style="color: black;margin-top: 5px;">
                                                                                            <span class="smalldot" id="group"
                                                                                                style="text-overflow:hidden;color:black!important;font-size:15px!important;font-family: 'MarksimonRegular';"><?php echo ucwords(strtolower($gname)); ?></span>
                                                                                            <br>
                                                                                            <span
                                                                                                style="color:black!important;font-size:15px!important;font-family: 'MarksimonRegular';">(
                                                                                                <?php
                                                                                                //  $gcate = ($row['spgroupCategory']); 
                                                                                                $gcate = $g->read_category($row2['spgroupCategory']);
                                                                                                //echo $g->ta->sql;
                                                                                                if ($gcate != false) {
                                                                                                    while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                                                                        echo $groupcate['group_category_name'];
                                                                                                        // echo $groupcate['id'];
                                                                                                    }
                                                                                                }

                                                                                                ?> )
                                                                                            </span>
                                                                                        </h2>

                                                                                        <div class="row">
                                                                                            <div class="col-md-6">


                                                                                                <span>

                                                                                                    <?php if ($row2['spgroupflag'] == 1) {
                                                                                                        echo '<h6 style="color:black;"><i class="fa fa-lock"></i> Private Group</h6>';
                                                                                                    } else {
                                                                                                        echo '<h6 style="color:black;"><i class="fa fa-globe"></i> Public Group</h6>';
                                                                                                    } ?></span>
                                                                                            </div>
                                                                                            <?php
                                                                                            //count member old and new
                                                                                            $result3 = $g->joinedMembersOfGroup($row2['idspGroup']);

                                                                                            $total_member = $result3->num_rows;
                                                                                            //print_r($total_member);
                                                                                
                                                                                            $result4 = $g->newgrpmember($row2['idspGroup']);
                                                                                            //echo $g->tad->sql;
//var_dump($result4);
                                                                                            if (!empty($result4)) {

                                                                                                $new_tot_member = $result4->num_rows;
                                                                                            } else {
                                                                                                $new_tot_member = 0;
                                                                                            }

                                                                                            ?>
                                                                                            <div class="col-md-6">
                                                                                                <h6
                                                                                                    style="text-align:right;margin-bottom:-30px;color:black;">
                                                                                                    <?php echo $total_member; ?>
                                                                                                    members
                                                                                                </h6>
                                                                                            </div>

                                                                                        </div>
                                                                                        <!-- <span class="btn pull-left btn btnPosting db_btn db_primarybtn" style="margin-top: 25px;margin-bottom:5px;text-align:left;margin-left:80px;"><img src="<?php echo $BaseUrl; ?>" class="img-responsive" alt="" />Timeline</span> -->
                                                                                    </div>



                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <?php

                                                                }


                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  -->
                                        </div>

                                        <?php if ($count > 9) { ?>
                                            <div id="pagination-container11" style="margin-top: 20px;"></div>
                                        <?php } ?>
                                    </div>

                                </div>









                                <div role="tabpanel" class="tab-pane fade" id="mygroup" aria-labelledby="mygroup-tab">
                                    <div class="topstatus timeline-topstatus " style="margin-top: 23px;">
                                        <!-- <div class="cententdatadetail bg_white" > -->
                                        <div class="row">
                                            <div class="list-wrapper4   555555555555">
                                                <?php
                                                $g = new _spgroup;
                                                $result = $g->profilegroupmember($_SESSION['pid']);

                                                //die("+++++++++++++");
                                                if ($result != false) {
                                                    $bg_clr = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        // print_r($row);
                                                        // echo "<pre>";  
                                                        //print_r($row);
                                                        //color background
                                                        if ($bg_clr == 1) {
                                                            $bg_clr_box = "bg_black";
                                                        } else if ($bg_clr == 2) {
                                                            $bg_clr_box = "bg_green_dark";
                                                        } else if ($bg_clr == 3) {
                                                            $bg_clr_box = "bg_pink_dark";
                                                        } else if ($bg_clr == 4) {
                                                            $bg_clr_box = "bg_red_dark";
                                                        } else if ($bg_clr == 5) {
                                                            $bg_clr_box = "bg_color_2";
                                                        } else if ($bg_clr == 6) {
                                                            $bg_clr_box = "bg_color_1";
                                                        }

                                                        // if($row['spgroupflag'] == 1){
                                                        //$g = new _spgroup;
                                                        //GET GROP BANNER, GROP DESCRIPTION 
                                                        // $result2 = $g->groupdetailsprivate($row['idspGroup']);
                                                        $gdes = $row2["spGroupAbout"];
                                                        $result2 = $g->groupdetailspublicprivate($row['idspGroup']);

                                                        $baneer_iamge = $g->read_bannerimage($row['idspGroup']);
                                                        $baneer_iamge_row = mysqli_fetch_assoc($baneer_iamge);
                                                        //print_r($baneer_iamge_row);
                                                        $gimage = $baneer_iamge_row['spgroupimage'];

                                                        // new for title bar
                                            
                                                        //echo $g->ta->sql;
                                                        if ($result2 != false) {
                                                            $row2 = mysqli_fetch_assoc($result2);

                                                            $gname = $row2["spGroupName"];
                                                            $gtag = $row2["spGroupTag"];
                                                            $gdes = $row2["spGroupAbout"];
                                                            $gtype = $row2["spgroupflag"];
                                                            $gcategory = $row2["spgroupCategory"];
                                                            $glocation = $row2["spgroupLocation"];
                                                            // $gimage = $row2["spgroupimage"];
                                            
                                                            //echo  $gimage; die(-------);
                                                        }
                                                        //GET ADMIN  NAME OR IMAGE
                                                        //$p = new _spgroup; //Admin will come on top
                                                        $img = new _spprofiles;
                                                        $rpvt = $img->read_img($_SESSION['pid']);
                                                        //echo $g->ta->sql;die;
                                                        if ($rpvt != false) {
                                                            while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                //print_r($row3);
//die('==');
                                                                if ($row3['spUser_idspUser'] != NULL) {
                                                                    $st = new _spuser;
                                                                    $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                                                                    if ($st1 != false) {
                                                                        $stt = mysqli_fetch_assoc($st1);
                                                                        $account_status = $stt['deactivate_status'];
                                                                    }
                                                                }

                                                                $spProfilePic = $row3['spProfilePic'];
                                                                $Group_Admin_Name = $row3['spProfileName'];
                                                            }
                                                        }

                                                        // echo "here";
// print_r($gtype);
                                                        if ($account_status != 1) {
                                                            //if ($row['spgroupstatus'] == 0) {
                                                            ?>
                                                            <div class="list-item4">
                                                                <div class="col-md-4 no-padding 55" style=" border-style: groove;">
                                                                    <a
                                                                        href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline&page=1">
                                                                        <div class="main_grop_box <?php echo ''; ?>"
                                                                            style="min-height: 215px!important;">
                                                                            <?php
                                                                            if ($gimage == "") { ?>
                                                                                <img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp"
                                                                                    class="img-responsive group_banner" alt=""
                                                                                    style="height:160px;" /><?php
                                                                            } else { ?>
                                                                                <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $gimage; ?>"
                                                                                    class="img-responsive group_banner" alt=""
                                                                                    style="height:160px;" /><?php
                                                                            }

                                                                            if ($spProfilePic != "") { ?>
                                                                                <img src="<?php echo $spProfilePic; ?>"
                                                                                    class="img-circle group_create" alt=""
                                                                                    style="top:145px;" /> <?php
                                                                            } else { ?>
                                                                                <img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png"
                                                                                    class="img-circle group_create" alt=""
                                                                                    style="top:145px;" /> <?php
                                                                            } ?>
                                                                            <div class="row">
                                                                                <h2 style="color: black;margin-top: 5px;">
                                                                                    <?php
                                                                                    if (strlen($row['spGroupName'])) {

                                                                                        ?>
                                                                                        <span class="smalldot">
                                                                                            <div class="w-wrap" style="height:20px;">
                                                                                                <?php echo ucwords(strtolower($row['spGroupName'])); ?>
                                                                                            </div>
                                                                                        </span>
                                                                                    <?php } else { ?>
                                                                                        <span
                                                                                            class="smalldot"><?php echo ucwords(strtolower($row['spGroupName'])); ?></span>
                                                                                    <?php } ?>
                                                                                    <br>
                                                                                    <span>

                                                                                        (
                                                                                        <?php
                                                                                        //part is not moved to new page 
                                                                                        //  $gcate = ($row['spgroupCategory']); 
                                                                                        $gcate = $g->read_category($row['spgroupCategory']);
                                                                                        //echo $g->ta->sql;
                                                                                        if ($gcate != false) {
                                                                                            while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                                                                echo $groupcate['group_category_name'];
                                                                                            }
                                                                                        }

                                                                                        ?>
                                                                                        )
                                                                                    </span>
                                                                                </h2>
                                                                                <div style=" background-color:white;">
                                                                                    <!--<div class="col-md-6">-->
                                                                                    <div style="float:left;margin-left: 10px;">


                                                                                        <!--  <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->
                                                                                        <?php if ($row['spgroupflag'] == 1) {
                                                                                            echo '<h6 style="color:black;"><i class="fa fa-lock"></i> Private Group</h6>';
                                                                                        } else {
                                                                                            echo '<h6 style="color:black;"><i class="fa fa-globe"></i> Public Group</h6>';
                                                                                        } ?>
                                                                                        <?php
                                                                                        //count member old and new
                                                                                        $result3 = $g->joinedMembersOfGroup($row['idspGroup']);
                                                                                        $total_member = mysqli_num_rows($result3);
                                                                                        $result4 = $g->newgrpmember($row['idspGroup']);
                                                                                        //echo $g->tad->sql;
                                                                                        if (!empty($result4)) {
                                                                                            $new_tot_member = mysqli_num_rows($result4);
                                                                                        } else {
                                                                                            $new_tot_member = 0;
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <!--<div class="col-md-6">-->
                                                                                    <div style="float:right;margin-right: 13px;">
                                                                                        <h6 style="text-align: right;">
                                                                                            <?php echo $total_member; ?>
                                                                                            <?php
                                                                                            if ($total_member > 1) {
                                                                                                echo " members";
                                                                                            } else {
                                                                                                echo " member";
                                                                                            } ?>
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- <span class="btn pull-left btn btnPosting db_btn db_primarybtn" style="top:50px;margin-bottom: 5px;" ><img src="<?php echo $BaseUrl; ?>" class="img-responsive" alt=""   />Timeline</span> -->
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php //}
                                                        }
                                                        if ($bg_clr < 6) {
                                                            $bg_clr++;
                                                        } else {
                                                            $bg_clr = 1;
                                                        }
                                                        /*  }*/
                                                    }
                                                } else {
                                                    if ($_SESSION['guet_yes'] != 'yes') {
                                                        echo "<p class='text-center'>Private group not available.<a href='" . $BaseUrl . "/my-groups/create-group.php'>Create a new group</a> </p>";
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <?php
                                            if ($result != false) {
                                                ?>
                                                <div id="pagination-container4"></div>
                                            <?php } ?>
                                        </div>
                                        <div class="space"></div>
                                        <div class="space-md"></div>
                                        <!--    <div class="row">
<div class="col-md-12">

<div class="footer_see_all text-center">
<a href="#">See All</a>
</div>
</div>
</div>  -->
                                    </div>
                                    <!-- <div class="row">
<div class="col-md-12">
<div class="heading01 text-center">
<h2>Friends Groups</h2>
<a href="#"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_main_inbox.png" class="img-responsive right_img_1" alt="" /></a>
<a href="#"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_main_email.png" class="img-responsive right_img_2" alt="" /></a>
</div>
</div>
</div> -->
                                    <!-- <div class="cententdatadetail bg_white timeline_comm_box">
<?php include ('friendsGroup.php'); ?>
</div>  -->
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                    <div class="topstatus timeline-topstatus " style="margin-top: 23px;">
                                        <!--  <div class="cententdatadetail bg_white"> -->
                                        <div class="row no-margin">
                                            <div class="list-wrapper5">
                                                <?php
                                                $g = new _spgroup;
                                                $result = $g->joingroupmember($_SESSION['pid']);
                                                $count = $result->num->rows;

                                                //print_r($result);
                                            
                                                //  echo $g->ta->sql;
                                                if ($result != false) {
                                                    $bg_clr = 1;
                                                    //  print_r($result);
                                            
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        //echo $row['idspGroup'];
                                                        //echo "<pre>";
                                                        // print_r($row);
                                                        //color background
                                                        if ($bg_clr == 1) {
                                                            $bg_clr_box = "bg_black";
                                                        } else if ($bg_clr == 2) {
                                                            $bg_clr_box = "bg_green_dark";
                                                        } else if ($bg_clr == 3) {
                                                            $bg_clr_box = "bg_pink_dark";
                                                        } else if ($bg_clr == 4) {
                                                            $bg_clr_box = "bg_red_dark";
                                                        } else if ($bg_clr == 5) {
                                                            $bg_clr_box = "bg_color_2";
                                                        } else if ($bg_clr == 6) {
                                                            $bg_clr_box = "bg_color_1";
                                                        }

                                                        //  if($row['spProfileIsAdmin'] == 1){
                                                        //$g = new _spgroup;
                                                        //GET GROP BANNER, GROP DESCRIPTION 
                                                        $result2 = $g->groupdetailspublicprivate($row['idspGroup']);

                                                        if ($result2 != false) {
                                                            $row2 = mysqli_fetch_assoc($result2);


                                                            $gname = $row2["spGroupName"];
                                                            $gtag = $row2["spGroupTag"];
                                                            $gdes = $row2["spGroupAbout"];
                                                            $gtype = $row2["spgroupflag"];
                                                            $gcategory = $row2["spgroupCategory"];
                                                            $glocation = $row2["spgroupLocation"];
                                                            //$gimage = $row2["spgroupimage"];
                                                        }
                                                        //GET ADMIN  NAME OR IMAGE
                                                        // $p = new _spgroup; //Admin will come on top
                                                        $rpvt = $g->members($row['idspGroup']);
                                                        //var_dump($rpvt);die;
                                                        //echo $g->ta->sql;
                                                        if ($rpvt != false) {
                                                            while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                //print_r($row3);
                                                                if ($row3['spUser_idspUser'] != NULL) {
                                                                    $st = new _spuser;
                                                                    $st1 = $st->readdatabybuyerid($row3['spUser_idspUser']);
                                                                    if ($st1 != false) {
                                                                        $stt = mysqli_fetch_assoc($st1);
                                                                        $account_status = $stt['deactivate_status'];
                                                                    }
                                                                }
                                                                if ($row3['spProfileIsAdmin'] == 0) {
                                                                    $spProfilePic = $row3['spProfilePic'];
                                                                    //echo "<pre>";
                                                                    //echo $spProfilePic;
                                                                    $Group_Admin_Name = $row3['spProfileName'];
                                                                }
                                                            }
                                                        }
                                                        if ($account_status != 1) {
                                                            if ($row['spgroupstatus'] == 0) {
                                                                ?>
                                                                <div class="list-item5">
                                                                    <div class="col-md-4 no-padding 66" style="border-style: groove;">
                                                                        <a
                                                                            href="<?php echo $BaseUrl; ?>/grouptimelines/?groupid=<?php echo $row['idspGroup'] ?>&groupname=<?php echo $row['spGroupName'] ?>&timeline&page=1">
                                                                            <div class="main_grop_box <?php echo ''; ?>"
                                                                                style="min-height: 200px!important;">
                                                                                <?php

                                                                                if ($row2["spgroupimage"] == "") {
                                                                                    ?>
                                                                                    <img src="<?php echo $BaseUrl; ?>/assets/images/bg/xtop_banner.jpg.pagespeed.ic.pG0MpHuNM1.webp"
                                                                                        class="img-responsive group_banner" alt=""
                                                                                        style="height:160px;" /><?php
                                                                                } else {

                                                                                    ?>
                                                                                    <img src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $row["spgroupimage"]; ?>"
                                                                                        class="img-responsive group_banner" alt=""
                                                                                        style="height:160px;" /><?php
                                                                                }

                                                                                if ($spProfilePic != "") { ?>
                                                                                    <img src="<?php echo ($spProfilePic); ?>"
                                                                                        class="img-circle group_create" alt=""
                                                                                        style="top:145px;" /> <?php
                                                                                } else { ?>
                                                                                    <img src="<?php echo $BaseUrl; ?>/assets/images/icon/blank-img.png"
                                                                                        class="img-circle group_create" alt=""
                                                                                        style="top:145px;" /> <?php
                                                                                } ?>
                                                                                <div class="row pt-5">
                                                                                    <h2 style="color: black;margin-top: 5px;">
                                                                                        <?php if (strlen($row['spGroupName'])) { ?>
                                                                                            <div class="join-wrap">
                                                                                                <?php echo ucwords(strtolower($row['spGroupName'])); ?>
                                                                                            </div>
                                                                                        <?php } else { ?>
                                                                                            <div class="join-wrap">
                                                                                                <?php echo ucwords(strtolower($row['spGroupName'])); ?>
                                                                                            </div>
                                                                                        <?php } ?>
                                                                                        <br>
                                                                                        <span>(
                                                                                            <?php
                                                                                            //  $gcate = ($row['spgroupCategory']); 
                                                                                            $gcate = $g->read_category($row['spgroupCategory']);
                                                                                            //echo $g->ta->sql;
                                                                                            if ($gcate != false) {
                                                                                                while ($groupcate = mysqli_fetch_assoc($gcate)) {
                                                                                                    echo $groupcate['group_category_name'];
                                                                                                }
                                                                                            }

                                                                                            ?> )
                                                                                        </span>
                                                                                    </h2>
                                                                                    <div class="col-md-6 pt-5">
                                                                                        <!-- <h2 style="font-size: 19px;"><?php echo ucfirst($Group_Admin_Name); ?></h2> -->
                                                                                        <?php if ($row['spgroupflag'] == 1) {
                                                                                            echo '<h6 style="font-size:11px;"><i class="fa fa-lock" ></i> Private Group</h6>';
                                                                                        } else {
                                                                                            echo '<h6 style="font-size:11px;"><i class="fa fa-globe"></i> Public Group</h6>';
                                                                                        } ?>
                                                                                        <?php
                                                                                        //count member old and new
                                                                                        $result3 = $g->joinedMembersOfGroup($row['idspGroup']);
                                                                                        if ($result3 != false) {
                                                                                            $total_member = mysqli_num_rows($result3);
                                                                                        }
                                                                                        $result4 = $g->newgrpmember($row['idspGroup']);
                                                                                        //echo $g->tad->sql;
                                                                                        if (!empty($result4)) {
                                                                                            $new_tot_member = mysqli_num_rows($result4);
                                                                                        } else {
                                                                                            $new_tot_member = 0;
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <h6 style="text-align: right;">
                                                                                            <?php echo $total_member; ?>
                                                                                            <?php
                                                                                            if ($total_member > 1) {
                                                                                                echo "members";
                                                                                            } else {
                                                                                                echo "member";
                                                                                            } ?>
                                                                                            <!--<?php echo $new_tot_member; ?> new members -->
                                                                                        </h6>
                                                                                        <!--  <span  class="btn pull-left btn btnPosting db_btn db_primarybtn" style="top:100px; margin-bottom: 5px; margin-top:10px;">Timeline33</span> -->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        }
                                                        if ($bg_clr < 6) {
                                                            $bg_clr++;
                                                        } else {
                                                            $bg_clr = 1;
                                                        }
                                                        /*  }*/
                                                    }
                                                } else {

                                                    echo "<p class='text-center'>Join group not available.</p>";
                                                }
                                                ?>
                                            </div>





                                        </div>
                                        <div class="space"></div>
                                        <div class="space-md"></div>

                                        <div 111 id="pagination-container5"></div>

                                        <!-- <div class="row">
<div class="col-md-12">

<div class="footer_see_all text-center">
<a href="#">See All</a>
</div>
</div>
</div> -->
                                    </div>
                                    <!-- <div class="row">
<div class="col-md-12">
<div class="heading01 text-center">
<h2>Friends Groups</h2>
<a href="#"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_main_inbox.png" class="img-responsive right_img_1" alt="" /></a>
<a href="#"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group_main_email.png" class="img-responsive right_img_2" alt="" /></a>
</div>
</div>
</div> -->
                                    <!-- <div class="cententdatadetail bg_white timeline_comm_box">
<?php include ('friendsGroup.php'); ?>
</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="modal fade" id="interestModal" tabindex="-1" role="dialog" aria-labelledby="interestModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel">Add Your Interests </h4>
                        </div>
                        <form id="addinterestForm" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category" class="lbl_7">Category
                                        <span class="red">* <span class="spUserCountry erormsg"></span></span>
                                    </label>
                                    <select id="category" class="multiple-select2 form-control" name="category[]" multiple>
                                        <!-- <option value="">Select Category</option> -->
                                        <?php
                                        $cat = "SELECT * FROM `group_category` WHERE `status` = 0 ORDER BY group_category_name asc";
                                        $result = mysqli_query($dbConn, $cat);
                                        while ($rows = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value='<?php echo $rows['id']; ?>'>
                                                <?php echo $rows['group_category_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-default" data-dismiss="myodal">Close</button> -->
                                <button type="button" id="channelSubmit" name="channelSubmit"
                                    class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="interestupdModal" tabindex="-1" role="dialog"
                aria-labelledby="interestupdModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="exampleModalLabel1">Update Your Interests </h4>
                        </div>
                        <form id="updinterestForm" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="category" class="lbl_7">Category
                                        <span class="red">* <span class="spUserCountry erormsg"></span></span>
                                    </label>
                                    <input type="hidden" value="0" id="edit_id" name="edit_id">
                                    <select id="upd_category" class="form-control" name="upd_category">
                                        <option value="">Select Category</option>
                                        <?php
                                        $cat = "SELECT * FROM `group_category` WHERE `status` = 0 ORDER BY `group_category_name` asc";
                                        $result = mysqli_query($dbConn, $cat);
                                        while ($rows = mysqli_fetch_array($result)) {

                                            ?>
                                            <option value='<?php echo $rows['id']; ?>'>
                                                <?php echo $rows['group_category_name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-default" data-dismiss="myodal">Close</button> -->
                                <button type="button" id="upd_int" name="upd_int" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include ('../component/f_footer.php');
        include ('../component/f_btm_script.php');
        ?>
    </body>

    </html>
    <?php
}
?>
<script type="text/javascript">
    $('#channelSubmit').click(function () {
        var cat = $('#category').val();

        $.ajax({
            url: "add_interest.php",
            type: "POST",
            data: {
                cat: cat

            },
            success: function (response) {
                if (response = '1') {
                    window.location = 'index.php';
                } else {
                    // alert('something went wrong')
                }


            },

        });
    });

    function editRecord(id) {
        $('#interestupdModal').modal('show');
        $('#upd_int').click(function () {
            $('#edit_id').val(id);
            var cat_id = $('#upd_category').val();
            // $('#upd_category').val(cat_id);

            $.ajax({
                url: "upd_interest.php",
                type: "POST",
                data: {
                    cat_id: cat_id,
                    id: id
                },

                success: function (response) {
                    if (response = '1') {
                        window.location = 'index.php';
                    } else {
                        // alert('something went wrong')
                    }


                },

            });
        });
    }
    // $('#upd_int').click(function(){
    // var upd_cat = $('#upd_category').val();
    // var id = $('#id').val();

    // $.ajax({
    // url: "upd_interest.php",
    // type: "POST",
    // data: {
    // upd_cat: upd_cat,
    // id: id

    // },
    // success: function (response) {
    // if(response = '1')
    // {
    // window.location = 'index.php';
    // }
    // else
    // {
    // // alert('something went wrong')
    // }


    // },

    // });
    // });
</script>
<script type="text/javascript">
    $('#addmemontimeline').click(function () {
        var gid = $('#grpid').val();
        var pid = $('#pid').val();
        var gname = $('#gname').val();
        $.ajax({
            url: "join_group.php",
            type: "POST",
            data: {
                gid: gid,
                pid: pid,
                gname: gname
            },
            success: function (response) {
                if (response = '1') {
                    // var link = document.getElementById('link').value;

                    window.location = 'index.php';
                } else {
                    alert('something went wrong')
                }

                // $('#bottom_reaction').html(response);
            },

        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
<script>
    // jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

    var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 6;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });


    var items1 = $(".list-wrapper1 .list-item1");
    var numItems1 = items1.length;
    var perPage1 = 6;

    items1.slice(perPage1).hide();

    $('#pagination-container1').pagination({
        items: numItems1,
        itemsOnPage: perPage1,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom1 = perPage1 * (pageNumber - 1);
            var showTo1 = showFrom1 + perPage1;
            items.hide().slice(showFrom1, showTo1).show();
        }
    });


    var items2 = $(".list-wrapper2 .list-item2");
    var numItems2 = items2.length;
    var perPage2 = 6;

    items.slice(perPage2).hide();

    $('#pagination-container2').pagination({
        items: numItems2,
        itemsOnPage: perPage2,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom2 = perPage2 * (pageNumber - 1);
            var showTo2 = showFrom2 + perPage2;
            items2.hide().slice(showFrom2, showTo2).show();
        }
    });



    var items3 = $(".list-wrapper3 .list-item3");
    var numItems3 = items.length;
    var perPage3 = 6;

    items.slice(perPage3).hide();

    $('#pagination-container3').pagination({
        items: numItems3,
        itemsOnPage: perPage3,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom3 = perPage3 * (pageNumber - 1);
            var showTo3 = showFrom3 + perPage3;
            items3.hide().slice(showFrom3, showTo3).show();
        }
    });


    var items4 = $(".list-wrapper4 .list-item4");
    var numItems4 = items4.length;
    var perPage4 = 6;

    items4.slice(perPage4).hide();

    $('#pagination-container4').pagination({
        items: numItems4,
        itemsOnPage: perPage4,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom4 = perPage4 * (pageNumber - 1);
            var showTo4 = showFrom4 + perPage4;
            items4.hide().slice(showFrom4, showTo4).show();
        }
    });

    var items5 = $(".list-wrapper5 .list-item5");
    var numItems5 = items5.length;
    var perPage5 = 9;

    items5.slice(perPage5).hide();
    if (numItems5 > perPage5) {
        $('#pagination-container5').show();
    } else {
        $('#pagination-container5').hide();
    }

    $('#pagination-container5').pagination({
        items: numItems5,
        itemsOnPage: perPage5,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom5 = perPage5 * (pageNumber - 1);
            var showTo5 = showFrom5 + perPage5;
            items5.hide().slice(showFrom5, showTo5).show();
        }
    });



    var items6 = $(".list-wrapper6 .list-item6");
    var numItems6 = items6.length;
    var perPage6 = 6;

    items.slice(perPage6).hide();
    if (numItems6 < perPage6) {
        $('#pagination-container6').hide();
    } else {
        $('#pagination-container6').show();
    }
    $('#pagination-container6').pagination({
        items: numItems6,
        itemsOnPage: perPage6,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom6 = perPage6 * (pageNumber - 1);
            var showTo6 = showFrom6 + perPage6;
            items6.hide().slice(showFrom6, showTo6).show();
        }
    });

    var items11 = $(".list-wrapper11 .list-item11");
    var numItems11 = items11.length;
    var perPage11 = 6;

    items.slice(perPage11).hide();

    $('#pagination-container11').pagination({
        items: numItems11,
        itemsOnPage: perPage11,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom11 = perPage11 * (pageNumber - 1);
            var showTo11 = showFrom11 + perPage11;
            items11.hide().slice(showFrom11, showTo11).show();
        }
    });
</script>
<script src=" https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js "></script>
<script>
    $('#category').select2({
        selectOnClose: true
    });
</script>




<script>
    $('#mygroup-tab').trigger('click');
</script>
<script>
    function joinGroup(pid, gid) {
        //alert(gid);
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        /*alert(2);*/
        today = yyyy + '-' + mm + '-' + dd;
        //var pid = $("#addmemontimeline").attr('data-pid');
        //var gid = $("#addmemontimeline").attr('data-gid');
        $.post("../my-groups/addmember.php", {
            spProfiles_idspProfiles: pid,
            spGroup_idspGroup: gid,
            spProfileIsAdmin: 1,
            spApproveRegect: 1,
            spGroup_newMember_Date: today
        }, function (r) {
            location.reload();
            //$(e).closest(".hidefriend").html("");
        });
    }
</script>


<script type="text/javascript">
    $('#SelExample').select2({
        selectOnClose: true
    });
</script>