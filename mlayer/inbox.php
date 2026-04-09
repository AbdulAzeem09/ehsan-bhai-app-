<style type="text/css">
    .messages-panel2 {

        width: 100%;

        background-color: #fbfcff;

        display: inline-block;

        border-top-left-radius: 5px;

        margin-bottom: 0;

    }

    .chat_img {

        width: 40px !important;

        height: 40px !important;

    }

    message-body {

        background-color: #2da9e9;

        border: 1px solid #2da9e9;

        color: #fff;

    }

    .friend_message .messages ul li img {

        width: 45px;

        height: 45px;

        border-radius: 0%;

        float: left;

    }

    .friend_message .messages ul li {

        display: inline-block;

        clear: both;

        float: left;

        margin: 15px 15px 5px 15px;

        width: calc(100% - 25px);

        font-size: 1.9em;

        padding: 0 25 0 25px !important;

    }

    .actives {

        background-color: #e6e6e6;

    }

    .contacts li {

        width: 119% !important;



    }

    .contacts-outter {

        overflow: hidden;

        position: relative;

    }
</style>

<?php

error_reporting(E_ALL);

ini_set('display_errors', 1);

include('univ/baseurl.php');



print_r($_SESSION);
//die('============');
if (!isset($_SESSION['pid'])) {
    include_once("authentication/check.php");
    $_SESSION['afterlogin'] = "friendmessage/";
} else {



    function sp_autoloader($class)
    {

        include 'mlayer/' . $class . '.class.php';
    }



    spl_autoload_register("sp_autoloader");

    date_default_timezone_set('Asia/Kolkata');

?>

    <!DOCTYPE html>

    <html lang="en">

    <head>

        <?php include('component/f_links.php'); ?>

        <!--    bashar design  links -->

        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Messages | The SHAREPAGE</title>

        <!-- <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap.min.css" > -->

        <!-- Optional theme -->

        <!-- <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-theme.min.css"> -->

        <!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->

        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/chat.css">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <!-- Latest compiled and minified JavaScript -->

        <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->

        <!--    bashar design links end  -->

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





        <!--This script for sticky left and right sidebar END-->

        <!--NOTIFICATION-->

        <!-- <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'> -->

    </head>



    <?php





    ?>





    <body class="bg_gray" onload="pageOnload('freiendmessage')">

        <?php

        include_once("header.php");

        ?>

        <?php

        $sp = new _spprofiles;



        $sprec = $sp->readprofileid2($_SESSION['pid']);

        if ($sprec != false) {

            $spall = mysqli_fetch_assoc($sprec);
        }

        ?>

        <div class="container">

            <div class="row">

                <div class="panel messages-panel2">

                    <div class="contacts-list">

                        <div class="row" style="margin-left:10px">

                            <?php if ($spall['spProfilePic']) { ?>

                                <span><img src="<?php echo $spall['spProfilePic']; ?>" style="height:50px;width:50px;border-radius:50%" 111>



                                </span>

                            <?php } else { ?>



                                <span><img src="<?php echo $BaseUrl . '/assets/images/icon/blank-img.png'; ?>" style="height:50px;width:50px;border-radius:50%" 111>



                                </span>



                            <?php } ?>

                            <!--span style="font-weight:500;margin-right:20px" ><?php //echo $spall['spProfileName']; 
                                                                                ?></span-->

                            <style>
                                #profileDropDown li {

                                    display: inline !important;
                                }

                                #li {

                                    padding-top: 0px !important;

                                    padding-right: 5px !important;

                                    padding-left: 5px !important;

                                }

                                .contacts-list .inbox-categories>div {

                                    padding: 7px 5px;

                                }

                                ul li img {

                                    margin-right: 15px;

                                    height: 32px;

                                    width: 32px;

                                }

                                li {

                                    white-space: nowrap;

                                    display: inline;

                                }



                                .contacts li>.info-combo {

                                    width: 150px !important;

                                    cursor: pointer !important;

                                }





                                #friendlist a {

                                    color: #fff;

                                    display: inline-block;

                                    margin-left: 8px;

                                    margin-top: 5px;

                                }



                                .dropdown-menu {

                                    display: none;

                                    position: absolute;

                                    background-color: white !important;

                                    min-width: 160px;

                                    box-shadow: 0 8px 16px 0 rgb(0 0 0 / 20%);

                                    z-index: 1;

                                    padding: 0;

                                }



                                #profileDropDown {

                                    margin-top: 10px !important;

                                    width: 200px;

                                    z-index: 997;



                                }

                                .right_head_top ul li img {

                                    float: left;

                                    margin-right: 5px;

                                    display: inline;

                                    height: 40px;

                                    width: 35px;

                                }



                                .msgNotify {

                                    z-index: 0;

                                }



                                element.style {}

                                .btn .caret {

                                    margin-left: 0;

                                }

                                .dropdown-toggle .caret {

                                    color: #fff !important;

                                    font-size: 25px;

                                }

                                span#car1 {

                                    margin-top: 10px;

                                }

                                .sa-button-container button.cancel {

                                    margin-top: 4 !important;

                                    border-radius: 22px !important;

                                    color: #fff;

                                }

                                .right_head_top ul li img {

                                    float: left;

                                    margin-right: 5px;

                                    display: inline;

                                    height: 35px;

                                    width: 35px;

                                }

                                #notification_count {

                                    margin-top: -30px !important;

                                    //margin-left: 6x!important;

                                    margin-left: 1px;

                                }

                                #friendlist a {
                                    color: #1c0202;
                                }

                                .message-time {
                                    margin: -4px;
                                }

                                .contacts li>.info-combo>h3.name {

                                    font-size: 14px !important;

                                }
                            </style>



                            <div class="dropdown" style="width:180px;">



                                <?php

                                $p = new _spprofiles;

                                $rpvt = $p->readProfiles($_SESSION["uid"]);



                                if ($rpvt != false) {

                                    while ($row = mysqli_fetch_assoc($rpvt)) {

                                        if ($_SESSION['pid'] == $row['idspProfiles']) {

                                ?>



                                            <p href="JavaScript:void(0)" class="dropdown-toggle" data-toggle="dropdown" style=" white-space: nowrap; width: 140px; overflow: hidden; text-overflow: ellipsis; width:145px;margin-left: 55px;margin-top: -40px; color:blue;" data-toggle="tooltip" data-placement="bottom" title="<?php echo ucwords(strtolower($_SESSION['MyProfileName'])); ?>"><?php echo (isset($_SESSION['MyProfileName']) ? substr(ucwords(strtolower($_SESSION['MyProfileName'])), 0, 20) : "Profile "); ?>&nbsp;<?php if ($spall['chat_status'] == '1') { ?>

                                                <span style="margin-left:-4px"><i class="fa fa-circle" aria-hidden="true" style="color:green; font-size:12px;"></i></span>

                                            <?php } else {

                                            ?>

                                                <span style="margin-left:-4px"><i class="fa fa-circle" aria-hidden="true" style="color:#f60; font-size:12px;"></i></span>

                                            <?php

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        }            ?>

                                            <br><span style="font-size: 12px;"><?php if ($_SESSION['guet_yes'] != 'yes') {
                                                                                    echo $row['spProfileTypeName'] . " Profile";
                                                                                } else {
                                                                                    echo "Guest Profile";
                                                                                } ?></span>

                                <?php

                                        }
                                    }
                                }

                                ?>
                                            </p>



                                            <ul class="dropdown-menu" id="profileDropDown" style="z-index:99">

                                                <?php

                                                $p = new _spprofiles;

                                                $rpvt = $p->readProfiles($_SESSION["uid"]);

                                                //echo $p->ta->sql;

                                                $user_profiles_list = array();

                                                if ($rpvt != false) {

                                                    while ($row = mysqli_fetch_assoc($rpvt)) {

                                                ?>

                                                        <li class="<?php echo ($_SESSION['pid'] == $row['idspProfiles']) ? 'active' : ''; ?>" style="">

                                                            <a class="sp-user-profile-label headProfile" style="line-height: 15px; padding-top:10px;  padding-bottom:5px;padding-left:5px;" href="javascript:void(0)" data-profileid='<?php echo $row['idspProfiles']; ?>'>

                                                                <?php

                                                                if ($row["spProfilePic"] == '') {

                                                                ?>

                                                                    <img src="<?php echo $BaseUrl . '/img/noman.png' ?>" style="height:30px; width:30px;float:left" alt="" class="img-responsive img-circle">

                                                                <?php

                                                                } else {

                                                                ?>

                                                                    <img src="<?php echo ($row["spProfilePic"]); ?>" style="height:30px; width:30px; float:left" class="img-responsive img-circle">



                                                                    <p>

                                                                    <?php

                                                                }

                                                                echo ucwords($row['spProfileName']); ?> <br><?php if ($_SESSION['guet_yes'] != 'yes') {
                                                                                                                echo $row['spProfileTypeName'] . " Profile";
                                                                                                            } else {
                                                                                                                echo "Guest Profile";
                                                                                                            } ?></p>

                                                            </a>

                                                        </li>

                                                <?php

                                                        array_push($user_profiles_list, $row['idspProfiles']);
                                                    }
                                                }

                                                ?>

                                                <li class="text-center">

                                                    <a href="<?php echo $BaseUrl . '/my-profile'; ?>">Add / Update Profile</a>

                                                </li>

                                            </ul>

                            </div>

                            <span class="dropdown">

                                <span class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">

                                    <input type="hidden" id="hiddendrpdwn" value="1">

                                    <i class="fa fa-gear footer_item" id="settin" onclick="chngecolor()" style="color:black; float: right;margin-top: -46px;margin-right: 25px; padding-left:12px"></i></span>

                                <ul class="dropdown-menu" style="margin-top:-5px;margin-left:120px">

                                    <li><a href="<?php echo $Baseurl; ?> /friendmessage/updatestatus.php/?status=1" <?php if ($spall['chat_status'] == '1') {
                                                                                                                        echo 'class="actives"';
                                                                                                                    } ?>>Online</a></li>

                                    <li><a href="<?php echo $Baseurl; ?>/friendmessage/updatestatus.php/?status=0" <?php if ($spall['chat_status'] == '0') {
                                                                                                                        echo 'class="actives"';
                                                                                                                    } ?>>Offline</a></li>

                                </ul>

                            </span>

                            <a href="<?php echo $BaseUrl . '/my-profile'; ?>"> <span><i class="fa fa-user footer_item" style="padding-right:12px; float: right;margin-top: -46px;margin-right: 72px; padding-top:13px;"></i></a>

                            </span>

                        </div>

                        <div class="inbox-categories">

                            <div data-toggle="tab" data-target="#inbox" id="div1" class="active">Inbox</div>

                            <div data-toggle="tab" data-target="#groups" id="div2">Groups</div>

                        </div>

                        <div class="tab-content">

                            <div id="inbox" class="contacts-outter-wrapper tab-pane active">

                                <div></div>

                                <div id="composeNewTxt" class="modal fade" role="dialog">

                                    <div class="modal-dialog">

                                        <!-- Modal content-->

                                        <div class="modal-content no-radius sharestorepos">

                                            <form method="post">

                                                <div class="modal-header">

                                                    <h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>

                                                </div>

                                                <div class="modal-body">

                                                    <input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid']; ?>">

                                                    <input type="hidden" name="module" id="module" value="inbox">

                                                    <div class="form-group">

                                                        <label>Select User<span class="red">* <span class="error_user"></span></span></label>

                                                        <select class="form-control" name="txtReceiver" id="txtReceiver">

                                                            <option value="0">Select User</option>

                                                            <?php

                                                            $b = array();

                                                            $r = new _spprofilehasprofile;

                                                            $pv = new _postingview;

                                                            $res = $r->readall($_SESSION["pid"]); //As a receiver

                                                            //var_dump($res);

                                                            if ($res != false) {

                                                                while ($rows = mysqli_fetch_assoc($res)) {

                                                                    $p = new _spprofiles;

                                                                    $sender = $rows["spProfiles_idspProfileSender"];

                                                                    array_push($b, $sender);

                                                                    $result = $p->read($rows["spProfiles_idspProfileSender"]);

                                                                    //echo $p->ta->sql;

                                                                    if ($result != false) {

                                                                        $row = mysqli_fetch_assoc($result);

                                                                        echo '<option value="' . $row['idspProfiles'] . '">' . ucwords(strtolower($row['spProfileName'])) . '&nbsp;(' . $row["spProfileTypeName"] . ')</option>';
                                                                    }
                                                                }
                                                            }

                                                            //   $r = new _spprofilehasprofile;

                                                            $res1 = $r->readallfriend($_SESSION["pid"]);

                                                            //	var_dump($res);die;

                                                            //As a sender

                                                            //echo $r->ta->sql;

                                                            if ($res1 != false) {

                                                                while ($rows = mysqli_fetch_assoc($res1)) {



                                                                    $rm = in_array($rows["spProfiles_idspProfilesReceiver"], $b, true);

                                                                    if ($rm == "") {

                                                                        $p = new _spprofiles;

                                                                        $result = $p->read($rows["spProfiles_idspProfilesReceiver"]);

                                                                        if ($result != false) {

                                                                            $receive = $rows["spProfiles_idspProfilesReceiver"];

                                                                            $row = mysqli_fetch_assoc($result);

                                                                            echo '<option value="' . $row['idspProfiles'] . '">' . ucwords(strtolower($row['spProfileName'])) . '&nbsp;(' . $row["spProfileTypeName"] . ')</option>';
                                                                        }
                                                                    }
                                                                }
                                                            }



                                                            ?>

                                                        </select>

                                                    </div>

                                                    <div class="form-group">

                                                        <label>Message<span class="red">* <span class="error_msg"></span></span></label>

                                                        <textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>

                                                    </div>

                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                    <input type="button" class="btn btn-primary composTxtNow" id="composTxtNow1" name="" value="Send Message" data-dismiss="modal">

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                                <style>
                                    * {

                                        box-sizing: border-box;

                                    }



                                    .zoom {

                                        // padding: 50px;

                                        // background-color: green;

                                        transition: transform .2s;

                                        font-size: 5px;

                                        //width: 19px;

                                        //height: 19px;

                                        //margin: 0 auto;

                                    }



                                    .zoom:hover {

                                        -ms-transform: scale(1.1);
                                        /* IE 9 */

                                        -webkit-transform: scale(1.1);
                                        /* Safari 3-8 */

                                        transform: scale(1.1);

                                    }

                                    .dropdown-toggle:focus,
                                    .editPostTimeline button:focus,
                                    .editPostTimeline button:hover,
                                    .timeline_butn .btnPosting:hover,
                                    .timeline_butn button:hover,
                                    .timeline_butn:focus {

                                        color: #121010;

                                        opacity: 0.8;

                                    }
                                </style>



                                <div class="row m_top_10" style="margin:-9px;">

                                    <div class="col-md-12 zoom" data-toggle="modal" data-target="#composeNewTxt" style="cursor: pointer;">

                                        <?php //var_dump($res);die; 



                                        if ((($res) || ($res1)) != false) {  ?>

                                            <div class="topstatus" style="border-bottom: 1px solid #CCC;padding: 4px 12px;background: navy;color: white;">

                                                <?php if ($_SESSION['guet_yes'] != 'yes') { ?>

                                                    <div class="createbox composeTxt">

                                                        <span><label style=" margin-bottom: 1px;"><i class="fa fa-envelope"></i> Compose Message</label></span>

                                                    </div>

                                                <?php } ?>

                                            </div>

                                        <?php  } ?>

                                    </div>

                                </div>

                                <form method="GET" action="" class="panel-search-form info form-group has-feedback no-margin-bottom" style="display: inline-flex; padding: 5px 20px;">

                                    <input type="text" class="form-control" name="search" placeholder="Search" style="margin-left:-15px;" value="<?php echo $_GET['search']; ?>" />

                                    <button type="submit" name="filter"><span class="fa fa-search" style="padding: 4px;"></span></button>

                                </form>

                                <div class="contacts-outter">



                                    <!--   <div class="dropdown" style="z-index:9; margin-left:5px;">

                              <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Filter <span class="caret"></span></button>

                              <ul class="dropdown-menu">

                                 <li><a href="#">Read</a></li>

                                 <li><a href="#">Unread</a></li>

                                 <li><a href="#">Sent</a></li>

                                 <li><a href="#">Draft</a></li>

                              </ul>

                           </div>-->

                                    <div class="panel-body" id="clikk">

                                        <div class="table-responsive myfriend">

                                            <ul class="list-unstyled contacts">

                                                <?php

                                                $g          = new _spgroup;

                                                $r          = new _spprofilehasprofile;

                                                $unread     = new _friendchatting;

                                                $p          = new _spprofiles;





                                                //all unread msg jo mjhy receive howy

                                                $aa = array();



                                                //echo "===yha main receiver ho===";

                                                $result1 = $unread->totalUnreadReceiver($_SESSION["pid"]);

                                                // print_r($result1);

                                                if ($result1 != false) {

                                                    // $resu= mysqli_fetch_assoc($);



                                                }

                                                //  print_r($result1).'===';

                                                //echo "<br>";

                                                $bb = array();

                                                $result2 = $unread->totalUnreadSender($_SESSION["pid"]);

                                                //print_r($result2);

                                                //echo $unread->ta->sql;

                                                if ($result2 != false) {

                                                    // print_r(mysqli_fetch_assoc($result2));

                                                    // exit;

                                                    while ($row2 = mysqli_fetch_assoc($result2)) {

                                                        // print_r($row2);

                                                        array_push($bb, $row2["spprofiles_idspProfilesReciver"]);

                                                        //  print_r($bb);

                                                        $rr = in_array($row2["spprofiles_idspProfilesReciver"], $aa, true);



                                                        $senderPidd     = $row2["spprofiles_idspProfilesSender"]; //My   

                                                        $receiverPidd   = $row2["spprofiles_idspProfilesReciver"]; //Friend

                                                        $total2 = 0;

                                                        //echo $

                                                        $unres2 = $unread->unreadmessage22($receiverPidd, $senderPidd);

                                                        //echo $unread->ta->sql."<br>";

                                                        if ($unres2 != false) {

                                                            $total2 = $unres2->num_rows;
                                                        }

                                                        if ($rr == "") {



                                                            $groupid = 0;

                                                            $groupname = "";



                                                            $rslt = $g->friendprofile($_SESSION["uid"], $row2["spprofiles_idspProfilesReciver"]);

                                                            //print_r($rslt);

                                                            if ($rslt != false) {

                                                                $rws = mysqli_fetch_assoc($rslt);

                                                                $groupid = $rws["idspGroup"];

                                                                $groupname = $rws["spGroupName"];

                                                                $groupname = str_replace(' ', '', $groupname);
                                                            }



                                                            $result3 = $p->read($row2["spprofiles_idspProfilesReciver"]);







                                                            $filter = $_GET['search'];



                                                            if ($filter) {



                                                                $result3 = $p->read9($row2["spprofiles_idspProfilesReciver"], $filter);



                                                                //print_r($result);



                                                                //die();



                                                            }









                                                            /*	if ($result3 != false) {//All friend details

                                       	

                                      

										

										

										}*/



                                                            if (strpos($row["spProfileName"], $filter) != false) {

                                                                continue;

                                                                //die("got it");

                                                            }





                                                            if (isset($_GET['msg']) == 'inbox_msg') {

                                                                $sp = new _spprofiles;







                                                                //$spup = $sp->upstatus($status,$_SESSION['pid']);

                                                                $obj = new _friendchatting;

                                                                $obj->updatemessagestatus($senderPidd, $receiverPidd);
                                                            }

                                                            //  }

                                                        }
                                                    }
                                                }  //if condition



                                                //echo $row1['spprofiles_idspProfilesSender'];die;

                                                if ($result1 != false) {

                                                    //  echo 1;die;

                                                    $ms = array();

                                                    while ($row1 = mysqli_fetch_assoc($result1)) {

                                                        //print_r($row1);

                                                        // $row1['spprofiles_idspProfilesSender'];

                                                        $res1 = $unread->read_id_msg($row1['spprofiles_idspProfilesSender']);

                                                        //print_r($res1);

                                                        if ($res1 != false) {

                                                            //echo 222;

                                                            $rss = mysqli_fetch_assoc($res1);

                                                            $idspfriendchatting = $rss['idspfriendChatting'];

                                                            //echo $idspfriendchatting;

                                                            array_push($ms, $idspfriendchatting);



                                                            //

                                                        }
                                                    }
                                                }

                                                // print_r($ms);



                                                //echo   $row2["spprofiles_idspProfilesReciver"];die;

                                                // echo $senderPidd.'   '.$receiverPidd;die;

                                                //print_r($result2);



                                                $result_2new = $unread->totalUnreadSender($_SESSION["pid"]);

                                                // print_r($result_2new);



                                                if ($result_2new != false) {



                                                    $ms1 = array();

                                                    while ($row3 = mysqli_fetch_assoc($result_2new)) {



                                                        //print_r($row3);

                                                        // die;



                                                        $reveiverPidd = $row3['spprofiles_idspProfilesReciver'];



                                                        $res = $unread->read_id_msg_rec($reveiverPidd);

                                                        //print_r($res);

                                                        //	die;



                                                        if ($res != false) {



                                                            $rss1 = mysqli_fetch_assoc($res);

                                                            //print_r($rss1);

                                                            $idspfriendchatting1 = $rss1['idspfriendChatting'];



                                                            array_push($ms1, $idspfriendchatting1);

                                                            //}

                                                        }
                                                    }
                                                }



                                                // print_r($ms1); 

                                                //echo "==========";

                                                //  print_r($ms); 



                                                // die('xxxxxxxxxxxx');



                                                //	print_r($ms1);

                                                //echo "<br>";

                                                //print_r($ms1);die('=====');

                                                if (($ms) && ($ms1)) {

                                                    //echo 333;

                                                    $merge_array = (array_merge($ms, $ms1));



                                                    //print_r($merge_array);





                                                    (arsort($merge_array));



                                                    $where = "";

                                                    foreach ($merge_array as $x => $x_value) {

                                                        // echo $x_value.',';

                                                        $where = $where . "idspfriendChatting=$x_value OR ";
                                                    }

                                                    // echo $where.' ';

                                                    $where = $where . 'idspfriendChatting=1';
                                                }





                                                if (($ms) && (empty($ms1))) {

                                                    //echo 333;

                                                    $merge_array = $ms;



                                                    //print_r($merge_array);





                                                    (arsort($merge_array));



                                                    $where = "";

                                                    foreach ($merge_array as $x => $x_value) {

                                                        // echo $x_value.',';

                                                        $where = $where . "idspfriendChatting=$x_value OR ";
                                                    }

                                                    // echo $where.' ';

                                                    $where = $where . 'idspfriendChatting=1';
                                                }



                                                if ((empty($ms)) && ($ms1)) {

                                                    //echo 333;



                                                    //die;

                                                    $merge_array = $ms1;



                                                    //print_r($merge_array);





                                                    (arsort($merge_array));



                                                    $where = "";

                                                    foreach ($merge_array as $x => $x_value) {

                                                        // echo $x_value.',';

                                                        $where = $where . "idspfriendChatting=$x_value OR ";
                                                    }

                                                    // echo $where.' ';

                                                    $where = $where . 'idspfriendChatting=1';
                                                }









                                                $result122 = $unread->totalUnreadReceiver_new($_SESSION["pid"], $where);



                                                //print_r($result122);





                                                if ($result122 != false) {

                                                    while ($row122 = mysqli_fetch_assoc($result122)) {

                                                        //print_r($row122);





                                                        //expire code strt

                                                        $rslt = $g->friendprofile($_SESSION["uid"], $row122["spprofiles_idspProfilesSender"]);

                                                        //print_r($rslt);

                                                        //echo $g->ta->sql;

                                                        $groupname = "";

                                                        $groupid = 0;

                                                        $g = new _spgroup;

                                                        if ($rslt != false) {

                                                            $rws = mysqli_fetch_assoc($rslt);

                                                            $groupid = $rws["idspGroup"];

                                                            $groupname = $rws["spGroupName"];

                                                            $groupname = str_replace(' ', '', $groupname);
                                                        }

                                                        //expire code end

                                                        array_push($aa, $row122["spprofiles_idspProfilesSender"]);



                                                        $senderPid      = $row122["spprofiles_idspProfilesSender"]; //Friend

                                                        $receiverPid    = $row122["spprofiles_idspProfilesReciver"]; //My

                                                        $total = 0;

                                                        $unres = $unread->unreadmessage($senderPid, $receiverPid);

                                                        //	print_r($unres);











                                                        //$receiver

                                                        //echo $unread->ta->sql;

                                                        if ($unres != false) {

                                                            $total = $unres->num_rows;
                                                        }



                                                        if ($_SESSION['pid'] == $row122["spprofiles_idspProfilesSender"]) {



                                                            $receiverPid = $row122["spprofiles_idspProfilesSender"];

                                                            //   echo $receiverPid; 

                                                            //   die;

                                                            $result = $p->read($row122["spprofiles_idspProfilesReciver"]);

                                                            //print_r($result); 

                                                        } else {

                                                            $receiverPid = $row122["spprofiles_idspProfilesReciver"];



                                                            $result = $p->read($row122["spprofiles_idspProfilesSender"]);

                                                            //print_r($result);

                                                        }



                                                        $filter = $_GET['search'];



                                                        if ($filter) {



                                                            $result = $p->read9($row122["spprofiles_idspProfilesSender"], $filter);



                                                            //



                                                            //die();



                                                        }

                                                        //print_r($result);



                                                        if ($result != false) {

                                                            $row = mysqli_fetch_assoc($result);

                                                            // echo "<pre>";

                                                            //print_r($row);

                                                            //die("===========");



                                                            if (strpos($row["spProfileName"], $filter) != false) {

                                                                continue;

                                                                //die("got it");



                                                                //print_r($result);



                                                            }











                                                ?>

                                                            <input type="hidden" value="<?php echo $row["spProfilePic"]; ?>" id="profile_img">

                                                            <?php

                                                            //	echo $receiverPid;



                                                            echo " <a href='javascript:void(0)' class=' friendchat myfriends " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . trim($groupname) . "' data-friendname='" . $row["spProfileName"] . "' data-friendid='" . $row["idspProfiles"] . "' data-frndicon='" . $row["spprofiletypeicon"] . "' data-friendname='" . $row["spProfileName"] . "' data-groupid='" . $groupid . "' data-myid='" . $receiverPid . "'>";



                                                            if (isset($_GET['msg']) == 'inbox_msg') {

                                                                $sp = new _spprofiles;

                                                                // $status=='0';





                                                                //$spup = $sp->upstatus($status,$_SESSION['pid']);

                                                                $obj = new _friendchatting;

                                                                $obj->updatemessagestatus($senderPid, $receiverPid);











                                                            ?>

                                                                <script>
                                                                    window.location.href = "<?php echo $BaseUrl; ?>/inbox.php";
                                                                </script>

                                                            <?php



                                                            }

                                                            //  if($res1!=false){

                                                            ?>





                                                            <li data-toggle="tab" data-target="#inbox-message-1" id="li1<?php echo $row["idspProfiles"]; ?>" class="active" style="margin-left: -17px;  padding-top: 20px;<?php if ($total) {
                                                                                                                                                                                                                                echo 'background-color:#e3cccc;';
                                                                                                                                                                                                                            } ?>" onclick="countbadge(<?php echo $row["idspProfiles"]; ?>)">

                                                                <?php if ($total) { ?>



                                                                    <div id="readcount<?php echo $row["idspProfiles"]; ?>">

                                                                        <div class="message-count"><?php echo "<span id='span1' class='badge totalunreadmsg no-radius " . ($total > 0 ? "" : "hidden") . " ' style='color:#fff;background-color:#3e2048;'>" . $total . "</span>"; ?></div>
                                                                    </div>

                                                                <?php   } ?>

                                                                <div class=""></div>

                                                                <?php

                                                                echo "  <img style='height: 40px!important;' alt='profile-Pic' class='img-responsive chat_img' id='" . $senderPid . "' style='' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png") . "' >";



                                                                ?>

                                                                <div class="vcentered info-combo">

                                                                    <h3 class="no-margin-bottom name"><span class='frndname'><?php echo ucwords(strtolower($row["spProfileName"])); ?></span>



                                                                        <?php if ($row['chat_status'] == '1') { ?>

                                                                            <span style=""><i class="fa fa-circle" aria-hidden="true" style="color:green; font-size:12px;"></i></span>

                                                                        <?php } else {

                                                                        ?>

                                                                            <span style=""><i class="fa fa-circle" aria-hidden="true" style="color:#f60; font-size:12px;"></i></span>

                                                                        <?php

                                                                        }            ?>

                                                                    </h3>

                                                                    <?php

                                                                    // GET LAST MSG AND DATE OF THAT USER

                                                                    // echo $row1["spprofiles_idspProfilesSender"]; 



                                                                    if ($_SESSION['pid'] == $row122["spprofiles_idspProfilesSender"]) {



                                                                        $result4 = $unread->lastmsg($row122["spprofiles_idspProfilesReciver"], $_SESSION['pid']);
                                                                    } else {

                                                                        $result4 = $unread->lastmsg($row122["spprofiles_idspProfilesSender"], $_SESSION['pid']);
                                                                    }



                                                                    //   $result4 = $unread->lastmsg($row122["spprofiles_idspProfilesReciver"], $_SESSION['pid']);



                                                                    //print_r($result4);

                                                                    // echo $unread->ta->sql;

                                                                    if ($result4 != false) {

                                                                        //die('===');

                                                                        $row4 = mysqli_fetch_assoc($result4);

                                                                        echo substr($row4['spfriendChattingMessage'], 0, 50);



                                                                        $dt = $row4['spMessageDate'];

                                                                        //echo $dt;

                                                                        date_default_timezone_set('Asia/Kolkata');

                                                                        $new_time = date("d M Y h:i:s", strtotime("{$dt} + 7 hours"));
                                                                    }

                                                                    ?>

                                                                </div>

                                                                <div class="contacts-add">

                                                                    <span class="message-time " style="font-size:11px;margin-left: -16px;"><?php echo $new_time; ?></span>

                                                                </div>

                                                                <!--i class="fa fa-paperclip"></i-->

                                                            </li>

                                                            </a>

                                                            <div>

                                                                <span class="delchatmessage pull-right" data-myid2="<?php echo $receiverPid; ?>" data-friendid2="<?php echo $row["idspProfiles"]; ?>"><i class="fa fa-trash-o zoom" id="" style=" margin-top:-68px; font-size: 15px; color:red; position: absolute;"></i></span>

                                                            </div>



                                                            <?php   //}

                                                            //echo " <a href='javascript:void(0)' class=' friendchat myfriends " . ($groupid != 0 ? "groupfriend" : "notgroup") . " " . trim($groupname) . "' data-friendname='" . $row["spProfileName"] . "' data-friendid='" . $row["idspProfiles"] . "' data-frndicon='" . $row["spprofiletypeicon"] . "' data-friendname='" . $row["spProfileName"] . "' data-groupid='" . $groupid . "' data-myid='".$receiverPid."'>

                                                            //<//img  alt='profile-Pic' class='img-responsive chat_img' id='".$senderPid."' style='' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../img/default-profile.png") . "' ><span class='frndname'>" . ucwords(strtolower($row["spProfileName"])) . " </span><span class='badge totalunreadmsg no-radius ".($total > 0 ?"":"hidden")." ' style=''>" . $total . "</span></a>";



                                                            ?>

                                                <?php

                                                        }
                                                    }
                                                } else {

                                                    //  echo "<center>No Record Found</center>";

                                                }

                                                //echo "===yha main sender ho===";

                                                ?>

                                            </ul>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <script>
                                $(document).ready(function() {



                                    setTimeout(function() {



                                        $('#clikk').click();



                                    }, 2000);



                                });
                            </script>



                            <div id="groups" class="contacts-outter-wrapper tab-pane">

                                <form class="panel-search-form info form-group has-feedback no-margin-bottom" style="    margin-top: 11px;display: inline-flex; padding: 5px 20px;">

                                    <input type="text" class="form-control" name="search" placeholder="Search" style="margin-left:-15px;" value="" />

                                    <button type="submit"><span class="fa fa-search" style="padding: 4px;"></span></button>
                                </form>

                                <div class="contacts-outter">

                                    <div class="dropdown" style="z-index:9; margin-left:5px;">

                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Filter <span class="caret"></span></button>

                                        <ul class="dropdown-menu">

                                            <li><a href="#">Archive</a></li>

                                            <li><a href="#">Personal</a></li>

                                            <li><a href="#">Other</a></li>

                                        </ul>

                                    </div>

                                    <!--ul class="list-unstyled contacts success">

                              <li data-toggle="tab" data-target="#sent-message-1">

                                  <img alt="" class="img-circle medium-image" src="https://www.iconpacks.net/icons/1/free-user-group-icon-296-thumb.png" />

                              

                                  <div class="vcentered info-combo">

                                      <h3 class="no-margin-bottom name">Happy Group</h3>

                                      <h5>Entertainment, Funny, Fun, Masti</h5>

                                  </div>

                                  <div class="contacts-add">

                                      <span class="message-time"> 44 <sup>Users</sup></span>

                                      <i class="fa fa-trash-o"></i>

                                  </div>

                              </li>

                              <li data-toggle="tab" data-target="#sent-message-2">

                                  <div class="message-count">7</div>

                                  <img alt="" class="img-circle medium-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ2v2q0Bt3eTqfgF2-xwPwA_Ywyl2BAakwo7w&usqp=CAU" />

                              

                                  <div class="vcentered info-combo">

                                      <h3 class="no-margin-bottom name">News Group</h3>

                                      <h5>Newspaper, Lates updates, Views, Media</h5>

                                  </div>

                                  <div class="contacts-add">

                                      <span class="message-time"> 804 <sup>Users</sup></span>

                                      <i class="fa fa-trash-o"></i>

                                  </div>

                              </li>

                              </ul-->

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="tab-content">

                        <div class="col-md-8" style="width: 73%;">

                            <div class="row m_top_15">

                                <div class="col-md-12">

                                    <!-- load Chat -->

                                    <div><span class="alert alert-success" id="span2" style="float: right;display:none;">Message Sent!</span> </div>

                                    <div class="chattingsystem " style="position: relative;">

                                        <div class="show_loader"></div>

                                        <div class="friendchatsystem myfriend abhishek">

                                            <!--Dynamic Loading Message-->

                                        </div>















                                        <!--Complete  action="sendmessage.php" method="post"-->

                                        <div class="chat_form" style="display:none;">

                                            <form method="post" id="myform" enctype="multipart/form-data">

                                                <input type="hidden" name="module" id="module" value="inbox">

                                                <input type="hidden" id="sender1" name="spprofiles_idspProfilesSender" value="<?php echo $_SESSION['pid']; ?>" />

                                                <?php

                                                //$sender_msg_img  = "";

                                                //date_default_timezone_set('Asia/Kolkata');

                                                // if ($sender_msg_img != '') {

                                                ?>

                                                <input type="hidden" id="mypic" value="<?php //echo ($sender_msg_img);
                                                                                        ?>">

                                                <?php

                                                //  }else{

                                                ?>

                                                <input type="hidden" id="mypic" value="../assets/images/blank-img/default-profile.png">

                                                <?php

                                                // }

                                                ?>

                                                <input type="hidden" id="mydate" value="<?php date_default_timezone_set('Asia/Kolkata');
                                                                                        echo date("Y-m-d H:i:s"); ?>" />

                                                <input type="hidden" id="myname" value="<?php echo 'ooooooooo'; ?>" />



                                                <input type="hidden" id="receiver1" name="spprofiles_idspProfilesReciver" value="<?php //echo $_POST["friendid"]; 
                                                                                                                                    ?>">





                                                <textarea class="form-control" id="freindmessage1" name="spfriendChattingMessage" placeholder="Type your message here..." style="height: 76px;"><?php  ?></textarea>

                                                <span style="margin-left: -60px;">



                                                    <label for="upload1"><i style="font-size:24px; margin-top:20px;" class="fa">&#xf093;</i></label></span>

                                                <input type="file" name="file" id="upload1" />





                                                <button class="sendmessagetofriend1 btn btn-success pull-right" type="button" style="height: 76px;width: 7%;"><i class="fa fa-paper-plane"></i></button>



                                            </form>

                                        </div>









                                    </div>

                                    <!-- END -->

                                </div>

                            </div>

                            <!-- <div id="sidebar_right" class="col-md-3 no-padding" style="left: auto" ></div> -->

                        </div>

                    </div>

                    <!--div class="tab-pane message-body active" id="inbox-message-1">

                  <div class="message-top"> 

                      <span class="name_title">Elon Musk <sup>Offline</sup></span>

                      <div class="dropdown name_report new-message">

                          <a class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i> </a>

                          <ul class="dropdown-menu">

                              <li><a href="#">Block</a></li>

                              <li><a href="#">Report</a></li>

                              <li><a href="#">Help</a></li>

                          </ul>

                      </div>

                  </div>

                  

                  <div class="message-chat">

                      <div class="chat-body">

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Elon Musk</h4>

                                      <h5><i class="fa fa-clock-o"></i> 2:25 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      I've seen your new template, Dauphin, it's amazing !

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 2:28 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Thanks, I think I will use this for my next dashboard system.

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Elon Musk</h4>

                                      <h5><i class="fa fa-clock-o"></i> 2:32 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      Hah, too late, I already bought it and my team is impleting the new design right now.

                                  </div>

                              </div>

                              <br />

                          </div>

                      </div>

                      <hr />

                      <div class="chat-footer">

                          <textarea class="send-message-text"></textarea>

                          <label class="upload-file">

                              <input type="file" required="" />

                              <i class="fa fa-paperclip"></i>

                          </label>

                          <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                      </div>

                  </div>

                  </div>

                  

                  <div class="tab-pane message-body" id="inbox-message-2">

                  <div class="message-top">

                      <span class="name_title">Mark Zuckerberg<sup>Online</sup></span>

                      <div class="dropdown name_report new-message">

                          <a class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i> </a>

                          <ul class="dropdown-menu">

                              <li><a href="#">Block</a></li>

                              <li><a href="#">Report</a></li>

                              <li><a href="#">Help</a></li>

                          </ul>

                      </div>

                  </div>

                  

                  <div class="message-chat">

                      <div class="chat-body">

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Mark Zuckerberg</h4>

                                      <h5><i class="fa fa-clock-o"></i> 3:45 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      Hi, Dennis. How's it going with your latest project?

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 3:52 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Hello. It's going well, thanks, but I may need your help tomorrow evening. Will you be available ?

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Mark Zuckerberg</h4>

                                      <h5><i class="fa fa-clock-o"></i> 3:56 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      Of course, just call me before that, in case I forget.

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 4:01 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Great, thank you.

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                      </div>

                      <hr />

                      <div class="chat-footer">

                          <textarea class="send-message-text"></textarea>

                          <label class="upload-file">

                              <input type="file" required="" />

                              <i class="fa fa-paperclip"></i>

                          </label>

                          <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                      </div>

                  </div>

                  </div>

                  

                  <div class="tab-pane message-body" id="inbox-message-3">

                  <div class="message-top">

                      <span class="name_title">Evan Williams<sup>Offline</sup></span>

                      <div class="dropdown name_report new-message">

                          <a class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i> </a>

                          <ul class="dropdown-menu">

                              <li><a href="#">Block</a></li>

                              <li><a href="#">Report</a></li>

                              <li><a href="#">Help</a></li>

                          </ul>

                      </div>

                  </div>

                  

                  <div class="message-chat">

                      <div class="chat-body">

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Evan Williams</h4>

                                      <h5><i class="fa fa-clock-o"></i> 5:07 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      Hey, you asked for my feedback, it's brilliant. Damn, I envy you I didn't come up with something this good :D Keep it up, man, it's going to be very popular. Trust me !

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 5:16 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Wow, thanks. You'll be my main template tester from now on :)

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Evan Williams</h4>

                                      <h5><i class="fa fa-clock-o"></i> 5:21 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      I'm all in, as long as you continue to make such great templates.

                                  </div>

                              </div>

                              <br />

                          </div>

                      </div>

                      <hr />

                      <div class="chat-footer">

                          <textarea class="send-message-text"></textarea>

                          <label class="upload-file">

                              <input type="file" required="" />

                              <i class="fa fa-paperclip"></i>

                          </label>

                          <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                      </div>

                  </div>

                  </div>

                  

                  <div class="tab-pane message-body" id="inbox-message-4">

                  <div class="message-top">

                      <span class="name_title">Jonahtan Ive<sup>Offline</sup></span>

                      <div class="dropdown name_report new-message">

                          <a class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i> </a>

                          <ul class="dropdown-menu">

                              <li><a href="#">Block</a></li>

                              <li><a href="#">Report</a></li>

                              <li><a href="#">Help</a></li>

                          </ul>

                      </div>

                  </div>

                  

                  <div class="message-chat">

                      <div class="chat-body">

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Jonahtan Ive</h4>

                                      <h5><i class="fa fa-clock-o"></i> 6:12 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      I'm coming to your place at 9 pm and I hope you'll have those tasty brownies again :)

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 6:16 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Ye, I still have a bag full of them.

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Jonahtan Ive</h4>

                                      <h5><i class="fa fa-clock-o"></i> 6:12 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      Great, we have a lot of work to do and we need fuel :D

                                  </div>

                              </div>

                              <br />

                          </div>

                          <div class="message info">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Jonahtan Ive</h4>

                                      <h5><i class="fa fa-clock-o"></i> 6:13 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      And invite Daniel too, please.

                                  </div>

                              </div>

                              <br />

                          </div>

                      </div>

                      <hr />

                      <div class="chat-footer">

                          <textarea class="send-message-text"></textarea>

                          <label class="upload-file">

                              <input type="file" required="" />

                              <i class="fa fa-paperclip"></i>

                          </label>

                          <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                      </div>

                  </div>

                  </div>

                  

                  <div class="tab-pane message-body" id="sent-message-1">

                  <div class="message-top">

                      <span class="name_title">

                          Happy Group<a type="button" data-toggle="modal" data-target="#userlist"><sup>44 Users</sup></a>

                      </span>

                      <div class="dropdown name_report new-message">

                          <a class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i> </a>

                          <ul class="dropdown-menu">

                              <li><a href="#">Block</a></li>

                              <li><a href="#">Report</a></li>

                              <li><a href="#">Help</a></li>

                          </ul>

                      </div>

                      <a class="btn btn btn-primary new-message" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Add Users </a>

                  

                      <div class="new-message-wrapper">

                          <div class="form-group">

                              <input type="text" class="form-control" placeholder="Send message to..." />

                              <a class="btn btn-danger close-new-message" href="#"><i class="fa fa-times"></i></a>

                          </div>

                  

                          <div class="chat-footer new-message-textarea">

                              <textarea class="send-message-text"></textarea>

                              <label class="upload-file">

                                  <input type="file" required="" />

                                  <i class="fa fa-paperclip"></i>

                              </label>

                              <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                          </div>

                      </div>

                  </div>

                  

                  <div class="message-chat">

                      <div class="chat-body">

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 2:05 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Hi, I've just finished the stickers you wanted. I'll send them to you in an archive in 10 minutes.

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message success">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>David Beckham</h4>

                                      <h5><i class="fa fa-clock-o"></i> 2:11 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      Hello, Dennis. Thanks. Also how's it going with our latest football website. Do you need any additional help or information?

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message success">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>David Beckham</h4>

                                      <h5><i class="fa fa-clock-o"></i> 2:24 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      I would like to take a look at it this evening, is it possible ?

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 2:25 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          It's going well, no need for any other help, thanks. Sure, send me a message when you'll be ready.

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                      </div>

                      <hr />

                      <div class="chat-footer">

                          <textarea class="send-message-text"></textarea>

                          <label class="upload-file">

                              <input type="file" required="" />

                              <i class="fa fa-paperclip"></i>

                          </label>

                          <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                      </div>

                  </div>

                  </div>

                  

                  <div class="tab-pane message-body" id="sent-message-2">

                  <div class="message-top">

                      <span class="name_title">

                          News Group<a type="button" data-toggle="modal" data-target="#userlist"><sup>804 Users</sup></a>

                      </span>

                      <div class="dropdown name_report new-message">

                          <a class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i> </a>

                          <ul class="dropdown-menu">

                              <li><a href="#">Block</a></li>

                              <li><a href="#">Report</a></li>

                              <li><a href="#">Help</a></li> 

                          </ul>

                      </div> 

                      <a class="btn btn btn-primary new-message" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus"></i> Add Users </a>

                  

                      <div class="new-message-wrapper">

                          <div class="form-group">

                              <input type="text" class="form-control" placeholder="Send message to..." />

                              <a class="btn btn-danger close-new-message" href="#"><i class="fa fa-times"></i></a>

                          </div>

                  

                          <div class="chat-footer new-message-textarea">

                              <textarea class="send-message-text"></textarea>

                              <label class="upload-file">

                                  <input type="file" required="" />

                                  <i class="fa fa-paperclip"></i>

                              </label>

                              <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                          </div>

                      </div>

                  </div>

                  

                  <div class="message-chat">

                      <div class="chat-body">

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 12:36 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Hi, can you please test my new template Dauphin and tell me if you like it ?

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message success">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-info">

                                      <h4>Jeff Williams</h4>

                                      <h5><i class="fa fa-clock-o"></i> 12:41 PM</h5>

                                  </div>

                                  <hr />

                                  <div class="message-text">

                                      Hello, Dennis. I will take a look at it tomorrow, because I'm already fed up with the current project.

                                  </div>

                              </div>

                              <br />

                          </div>

                  

                          <div class="message my-message">

                              <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png" />

                  

                              <div class="message-body">

                                  <div class="message-body-inner">

                                      <div class="message-info">

                                          <h4>Dennis Novac</h4>

                                          <h5><i class="fa fa-clock-o"></i> 12:46 PM</h5>

                                      </div>

                                      <hr />

                                      <div class="message-text">

                                          Thanks :)

                                      </div>

                                  </div>

                              </div>

                              <br />

                          </div>

                      </div>

                      <hr />

                      <div class="chat-footer">

                          <textarea class="send-message-text"></textarea>

                          <label class="upload-file">

                              <input type="file" required="" />

                              <i class="fa fa-paperclip"></i>

                          </label>

                          <button type="button" class="send-message-button btn-info"><i class="fa fa-paper-plane"></i></button>

                      </div>

                  </div>

                  </div>

                  </div-->

                </div>

            </div>

        </div>

        <!-- Modal Add User >

         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

             <div class="modal-dialog" role="document">

                 <div class="modal-content">

                     <div class="modal-header">

                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                         <h4 class="modal-title" id="myModalLabel">User List</h4>

                     </div>

                     <div class="modal-body">

                         <div class="input-group input-group-sm">

                             <span class="input-group-addon" id="sizing-addon3">@</span>

                             <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon3" />

                         </div>

                         <div class="main-box no-header clearfix">

                             <div class="main-box-body clearfix">

                                 <div class="table-responsive">

                                     <table class="table user-list">

                                         <thead>

                                             <tr>

                                                 <th><span>User</span></th>

                                                 <th class="text-center"><span>Status</span></th>

                                                 <th><span>Email</span></th>

                                                 <th>Add Action</th>

                                             </tr>

                                         </thead>

                                         <tbody>

                                             <tr>

                                                 <td>

                                                     <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" />

                                                     <a href="#" class="user-link">Dave</a>

                                                     <span class="user-subhead">Member</span>

                                                 </td>

                                                 <td class="text-center">

                                                     <span class="label label-default">pending</span>

                                                 </td>

                                                 <td>

                                                     <a href="#">marlon@brando.com</a>

                                                 </td>

                                                 <td style="width: 20%;">

                                                     <a href="#" class="table-link text-info">

                                                         <span class="fa-stack">

                                                             <i class="fa fa-square fa-stack-2x"></i>

                                                             <i class="fa fa-plus fa-stack-1x fa-inverse"></i>

                                                         </span>

                                                     </a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td>

                                                     <img src="https://bootdey.com/img/Content/user_3.jpg" alt="" />

                                                     <a href="#" class="user-link">Syed</a>

                                                     <span class="user-subhead">Admin</span>

                                                 </td>

                                                 <td class="text-center">

                                                     <span class="label label-success">Active</span>

                                                 </td>

                                                 <td>

                                                     <a href="#">marlon@brando.com</a>

                                                 </td>

                                                 <td style="width: 20%;">

                                                     <a href="#" class="table-link text-info">

                                                         <span class="fa-stack">

                                                             <i class="fa fa-square fa-stack-2x"></i>

                                                             <i class="fa fa-plus fa-stack-1x fa-inverse"></i>

                                                         </span>

                                                     </a>

                                                 </td>

                                             </tr>

                                             <tr>

                                                 <td>

                                                     <img src="https://bootdey.com/img/Content/user_2.jpg" alt="" />

                                                     <a href="#" class="user-link">Maria</a>

                                                     <span class="user-subhead">Member</span>

                                                 </td>

                                                 <td class="text-center">

                                                     <span class="label label-danger">inactive</span>

                                                 </td>

                                                 <td>

                                                     <a href="#">marlon@brando.com</a>

                                                 </td>

                                                 <td style="width: 20%;">

                                                     <a href="#" class="table-link text-info">

                                                         <span class="fa-stack">

                                                             <i class="fa fa-square fa-stack-2x"></i>

                                                             <i class="fa fa-plus fa-stack-1x fa-inverse"></i>

                                                         </span>

                                                     </a>

                                                 </td>

                                             </tr>

                                         </tbody>

                                     </table>

                                 </div>

                             </div>

                         </div>

                     </div>

                     <div class="modal-footer">

                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                         <button type="button" class="btn btn-primary">Add</button>

                     </div>

                 </div>

             </div>

         </div-->

        <!-- Modal Group User Lsit >

         <div class="modal fade" id="userlist" tabindex="-1" role="dialog" aria-labelledby="userlist">

             <div class="modal-dialog" role="document">

                 <div class="modal-content">

                     <div class="modal-header">

                         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                         <h4 class="modal-title" id="myModalLabel">User List</h4>

                     </div>

                     <div class="modal-body">

                        <div class="input-group input-group-sm">

                           <span class="input-group-addon" id="sizing-addon3">@</span>

                           <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon3" />

                        </div>

                        <div class="main-box-body clearfix">

                           <div class="main-box clearfix">

                                  <div class="table-responsive">

                                      <table class="table user-list">

                                          <thead>

                                              <tr>

                                                  <th><span>User</span></th>

                                                  <th><span>Created</span></th>

                                                  <th class="text-center"><span>Status</span></th>

                                                  <th><span>Email</span></th>

                                                  <th>&nbsp;</th>

                                              </tr>

                                          </thead>

                                          <tbody>

                                              <tr>

                                                  <td>

                                                      <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" />

                                                      <a href="#" class="user-link">Mila Kunis</a>

                                                      <span class="user-subhead">Admin</span>

                                                  </td>

                                                  <td>

                                                      2013/08/08

                                                  </td>

                                                  <td class="text-center">

                                                      <span class="label label-default">Inactive</span>

                                                  </td>

                                                  <td>

                                                      <a href="#">mila@kunis.com</a>

                                                  </td>

                                                  <td style="width: 20%;">

                                                      <a href="#" class="table-link">

                                                          <span class="fa-stack">

                                                              <i class="fa fa-square fa-stack-2x"></i>

                                                              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>

                                                          </span>

                                                      </a>

                                                      <a href="#" class="table-link danger">

                                                          <span class="fa-stack">

                                                              <i class="fa fa-square fa-stack-2x"></i>

                                                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>

                                                          </span>

                                                      </a>

                                                  </td>

                                              </tr>

                                              <tr>

                                                  <td>

                                                      <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="" />

                                                      <a href="#" class="user-link">George Clooney</a>

                                                      <span class="user-subhead">Member</span>

                                                  </td>

                                                  <td>

                                                      2013/08/12

                                                  </td>

                                                  <td class="text-center">

                                                      <span class="label label-success">Active</span>

                                                  </td>

                                                  <td>

                                                      <a href="#">marlon@brando.com</a>

                                                  </td>

                                                  <td style="width: 20%;">

                                                      <a href="#" class="table-link">

                                                          <span class="fa-stack">

                                                              <i class="fa fa-square fa-stack-2x"></i>

                                                              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>

                                                          </span>

                                                      </a>

                                                      <a href="#" class="table-link danger">

                                                          <span class="fa-stack">

                                                              <i class="fa fa-square fa-stack-2x"></i>

                                                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>

                                                          </span>

                                                      </a>

                                                  </td>

                                              </tr>

                                              <tr>

                                                  <td>

                                                      <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" />

                                                      <a href="#" class="user-link">Ryan Gossling</a>

                                                      <span class="user-subhead">Registered</span>

                                                  </td>

                                                  <td>

                                                      2013/03/03

                                                  </td>

                                                  <td class="text-center">

                                                      <span class="label label-danger">Banned</span>

                                                  </td>

                                                  <td>

                                                      <a href="#">jack@nicholson</a>

                                                  </td>

                                                  <td style="width: 20%;">

                                                     <a href="#" class="table-link">

                                                          <span class="fa-stack">

                                                              <i class="fa fa-square fa-stack-2x"></i>

                                                              <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>

                                                          </span>

                                                      </a>

                                                      <a href="#" class="table-link danger">

                                                          <span class="fa-stack">

                                                              <i class="fa fa-square fa-stack-2x"></i>

                                                              <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>

                                                          </span>

                                                      </a>

                                                  </td>

                                              </tr>

                                          </tbody>

                                      </table>

                                  </div>

                                  <ul class="pagination pull-right">

                                      <li>

                                          <a href="#"><i class="fa fa-chevron-left"></i></a>

                                      </li>

                                      <li><a href="#">1</a></li>

                                      <li><a href="#">2</a></li>

                                      <li><a href="#">3</a></li>

                                      <li><a href="#">4</a></li>

                                      <li><a href="#">5</a></li>

                                      <li>

                                          <a href="#"><i class="fa fa-chevron-right"></i></a>

                                      </li>

                                  </ul>

                           </div>

                        </div>                

                     </div>

                     <div class="modal-footer">

                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                         <button type="button" class="btn btn-primary">Submit</button>

                     </div>

                 </div>

             </div>

         </div-->

        </div>

        <?php

        include('component/f_footer.php');

        // include('component/footer.php');

        include('component/f_btm_script.php');

        ?>





        <script type="text/javascript">
            function countbadge(friend) {



                $('.chat_form').css('display', 'block');

                var frid = friend;



                document.getElementById("receiver1").value = friend;









                document.getElementById("readcount" + frid).innerHTML = "";

                document.getElementById("li1" + frid).style.backgroundColor = "#fbfcff";







            }





            var pad_top_val = "15px";

            $(".chat_form").css("padding-top", pad_top_val);



            $(".chat-row").click(function() {

                window.scrollTo(2, document.body.scrollHeight);

            });



            function chngecolor() {



                var hiddenval = document.getElementById("hiddendrpdwn").value;

                if (hiddenval == 1) {

                    $("#settin").css("color", "white").css("background-color", "green");

                    document.getElementById("hiddendrpdwn").value = 0;

                }



                if (hiddenval == 0) {

                    $("#settin").css("color", "black").css("background-color", "#e6e6e6");

                    document.getElementById("hiddendrpdwn").value = 1;

                }

            }







            $(document).ready(function() {







                $('.delchatmessage').click(function() {

                    var i1 = $(this).attr('data-myid2');

                    var i2 = $(this).attr('data-friendid2');

                    swal({

                            title: "Are you sure?",

                            

                            type: "warning",

                            showCancelButton: true,

                            confirmButtonColor: '#DD6B55',

                            confirmButtonText: 'Yes, I am sure!',

                            cancelButtonText: "No, cancel it!",

                            closeOnConfirm: false,

                            closeOnCancel: false

                        },

                        function(isConfirm) {



                            if (isConfirm) {



                                ///alert(i1);

                                ///alert(i2);



                                $.ajax({

                                    url: "friendmessage/deletechat.php",

                                    type: "POST",

                                    cache: false,

                                    data: {

                                        'data_myid2': i1,

                                        'data_friendid2': i2

                                    },

                                    success: function(data) {

                                        // location.reload();

                                        //$('#rpllybox'+i2).html(' ');	



                                        location.reload();



                                    }



                                });



                            } else {



                                //location.reload();

                                swal("Cancelled", " Your imaginary file is safe :)", "error");

                                //return false;

                                e.preventDefault();

                            }

                        });





                });







                // draft message	 



                $('#div1').on('click', function() {

                    $('#div1').css("background-color", "#bf0f4d");

                    $('#div1').css("border-bottom", "4px solid #bf0f4d");

                    $('#div2').css("background-color", "");

                    $('#div2').css("border-bottom", "");



                });



                $('#div2').on('click', function() {

                    $('#div2').css("background-color", "#bf0f4d");

                    $('#div2').css("border-bottom", "4px solid #bf0f4d");

                    $('#div1').css("background-color", "");

                    $('#div1').css("border-bottom", "");

                });









            });



            $(document).ready(function() {

                $("#composTxtNow1").click(function() {

                    $("#span2").show();

                    setTimeout(function() {

                        $('#span2').hide();

                    }, 2000);





                });

            });



            // $("#li1").on('click',function(){

            //	  $("#li1").css("backgroundColor", "black");

            // });
        </script>

        <!--script src="https://dev.thesharepage.com/assets/js/home.js"></script -->

    </body>

    </html>

<?php

}

?>