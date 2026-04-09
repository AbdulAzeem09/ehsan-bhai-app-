<?php
// function sp_autoloader($class)
// {
//     include 'mlayer/' . $class . '.class.php';
// }
// spl_autoload_register("sp_autoloader");
$als = new _allSetting;


//JOB BOARD COLOR
$query4 = $als->showBanner(2);
if ($query4) {
    $row4 = mysqli_fetch_assoc($query4);
    $jobboard_clr = $row4['spSettingMainClr'];
}


//freelancer COLOR
$query7 = $als->showBanner(5);
if ($query7) {
    $row7 = mysqli_fetch_assoc($query7);
    $freelancer_clr = $row7['spSettingMainClr'];
}
//REAL ESTATE COLOR
$query5 = $als->showBanner(3);
if ($query5) {
    $row5 = mysqli_fetch_assoc($query5);
    $realEstate_clr = $row5['spSettingMainClr'];
}
// EVENTS COLOR
$query6 = $als->showBanner(9);
if ($query6) {
    $row6 = mysqli_fetch_assoc($query6);
    $event_clr = $row6['spSettingMainClr'];
}

//ARTANDCRAFT COLOR

$query8 = $als->showBanner(21);
if ($query8) {
    $row7 = mysqli_fetch_assoc($query8);
    $artcraft_clr = $row7['spSettingMainClr'];
}
$userpnone = "";
$userpnonecode = "";
$spUserPhone = "";
$u = new _spuser;
$res = $u->read($_SESSION["uid"]);
if ($res != false) {
    $ruser = mysqli_fetch_assoc($res);

    $userpnone = $ruser["spUserPhone"];
    $userpnonecode = $ruser["phone_code"];
    $spUserPhone = $ruser["spUserPhone"];
}
?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VJPY80XYLY"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'G-VJPY80XYLY');
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" defer></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>-->

<!--css from views/common/header.php-->
<style>
    button:disabled,
    button[disabled] {
        border: 1px solid #999999 !important;
        background-color: #cccccc !important;
        color: #666666 !important;
    }

    .swal2-popup {
        max-height: 300px !important;
    }

    .swal2-icon {
        font-size: 5px !important;
    }

    .swal2-popup .swal2-title {
        font-size: 14px !important;
    }

    button:disabled, button[disabled] {
        border: 1px solid #999999 !important;
        background-color: #cccccc !important;
        color: #666666 !important;
    }

    .foot {
        background-color: #202548;
        padding: 20px;
    }

    .btm_foot {
        background-color: #203248;
        padding: 10px;
    }

    .foot p {
        color: #fff;
        font-size: 14px;
        line-height: 23px;
        padding: 0 0 8px 0;
    }

    .foot h2 {
        color: #fff;
        text-transform: uppercase;
        margin: 0 0 20px 0 !important;
        font-size: 16px;
    }

    .foot p a {
        color: #fff;
        font-size: 14px;
        text-decoration: none;
    }

    .body-wrapper {
        max-width: 100%;
    }

    <?php if(isset($page) && $page == 'apply&preview') {   ?>
    .add-btn {
        width: 180px;
        border: none;
        border-radius: 75px;
        color: white;
        background-color: #7649B3;
        cursor: pointer;
        margin: 10px 0px;
        text-decoration: none;
        padding: 10px;
    }

    <?php  }
    ?>
    .dataTable th, .dataTable td {
        text-align: left !important;
    }

    [name=example_length] {
        margin-right: 5px;
    }

    .detail, .question-wrapper, .job, .modal-body, .modal-title, .skills, .cover, .name {
        word-wrap: break-word;
        width: 100%;
    }

    .dt-layout-cell {

    }

    table {
        table-layout: fixed;
        word-wrap: break-word;
    }

    .theme-btn {
        background: #3e1f48;
        border: 0px;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
    }

    .global_spanner {
        position: fixed;
        top: 50%;
        left: 0;
        background: #2a2a2a;
        width: 100%;
        display: block;
        text-align: center;
        height: 300px;
        color: #FFF;
        transform: translateY(-50%);
        z-index: 9999999;
        visibility: hidden;
    }

    .global_overlay {
        position: fixed;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        visibility: hidden;
        z-index: 99999;
    }

    .global_loader,
    .global_loader:before,
    .global_loader:after {
        border-radius: 50%;
        width: 2.5em;
        height: 2.5em;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation: load7 1.8s infinite ease-in-out;
        animation: load7 1.8s infinite ease-in-out;
    }

    .global_loader {
        color: #ffffff;
        font-size: 10px;
        margin: 80px auto;
        position: relative;
        text-indent: -9999em;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    .global_loader:before,
    .global_loader:after {
        content: '';
        position: absolute;
        top: 0;
    }

    .global_loader:before {
        left: -3.5em;
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .global_loader:after {
        left: 3.5em;
    }

    @-webkit-keyframes load7 {
        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }
        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }

    @keyframes load7 {
        0%,
        80%,
        100% {
            box-shadow: 0 2.5em 0 -1.3em;
        }
        40% {
            box-shadow: 0 2.5em 0 0;
        }
    }

    .show {
        visibility: visible;
    }

    .global_spanner, .global_overlay {
        opacity: 0;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        transition: all 0.3s;
    }

    .global_spanner.show, .global_overlay.show {
        opacity: 1
    }

    .jconfirm-box .jconfirm-title-c {
        pointer-events: none !important;
    }

    #mceu_19 {
        display: none !important;
    }
</style>
<style>
    .center {
        text-align: center;
    }

    .right_head_top ul li p {
        color: #fff;
        font-family: lucidaSans;
        font-size: 12px;
        margin: 0;
        padding-top: 4px;
        float: left;
    }

    i.fa.fa-eye {
        color: #ff8320;
    }


    thead {
        background-color: black;
        color: white;
    }


    #profileDropDown li a {
        padding: 0px 0;
        display: block;
    }

    .inner_top_form input[type=text] {
        width: 60%;
        float: left;
        margin-top: 5px;
        border-radius: 0;
        background-size: 25px;
    }

    header.header_photo.header_front {
        background-color: <?php echo $artcraft_clr; ?>;
    }


    header.header_servic.header_front {
        background-color: #09a4ae;
    }


    .business_for_sale {
        background-color: #608A36;
        padding: 0 10px
    }

    .mce-notification-inner {
        display: none !important;
    }

    .header_jobBoard {
        background-color: <?php echo $jobboard_clr; ?>;
        padding: 0px 10px 5px;
    }


    .header_train {
        background-color: #417281;
        padding: 0px 10px 5px;
    }


    /*JOB BOARD HEADER COLOR*/
    .header_jobBoard {
        background-color: <?php echo $jobboard_clr; ?>;
        padding: 0px 10px 5px;
    }


    /*freelancer HEADER COLOR*/
    .header_freelancer {
        background-color: <?php echo $freelancer_clr; ?>;
        padding: 0px 10px 5px;
    }

    /*REAL ESTATE HEADER COLOR*/
    .header_realEstate {
        background-color: <?php echo $realEstate_clr; ?>;
        padding: 0px 10px 5px;
    }

    /*EVENT HEADER COLOR*/
    .header_events {
        background-color: <?php echo $event_clr; ?>;
        padding: 0px 10px 5px;
    }


    .dropdown-menu {
        display: none;
        position: absolute;
        background-color: white !important;
        min-width: 122px;
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
        height: 35px;
        width: 35px;
        margin-bottom: 4px;
    }

    .msgNotify {
        z-index: 0;
    }

    <?php if ((isset($_GET['favourite']) && $_GET['favourite']) || (isset($_GET['save_Post']) && $_GET['save_Post'])) { ?>.dropdown-menu > li > a:hover,
    .dropdown-menu > li > a:focus {
        background-color: #964B00 !important;
        color: #000;
    }

    <?php } else { ?>.dropdown-menu > li > a:hover,
    .dropdown-menu > li > a:focus {
        background-color: #568e8c !important;
        color: #000;
    }

    <?php } ?>.msgNotify {

    / / margin-top: 1 px !important;
    }


    ::placeholder {

        color: #9aa2ab !important;
        opacity: 1 !important;
    }

    #p2:hover {
        color: white !important;
    }

    .msgNotify {
        margin-top: 4px !important;
        margin-left: 7px !important;
        font-size: 11px !important;
    }

    #notify1 {
        margin-top: 4px !important;
        margin-left: -12px !important;
        font-size: 11px !important;
    }

    #notification_count {
        margin-top: -7px !important;
    / / margin-left: 6 x !important;
        margin-left: -18px;
    }

    .aaa {
        margin-left: 5px !important;
    }

    .msgNotify {
        padding: 0px 5px 0px 5px;
    }

    .dropdown-menu {
        border: #eee;
    }

    .dropdown-toggle i, .right_head_top a i {

        font-size: 16px;

    }

    .btn-border-radius {
        border-radius: 10px !important;
    }


    .img_text {
        font-weight: 500;
        color: white;
        font-size: 20px !important;
        text-shadow: 2px 2px 2px #3e2048;
        margin-top: 10px;

    }

    @media (max-width: 480px) {
        .img_text {
            text-align: center;
        }
    }
</style>
<?php


if (isset($_GET["post"])) {
    include("friendmessage/totalunreadmsg.php");
} else {
    include("friendmessage/totalunreadmsg.php");
}


$r = new _spprofilehasprofile;
//echo $r->ta->sql;

$verify = new _spprofiles;
$vercod = $verify->read($_SESSION["pid"]);
//echo $verify->ta->sql;
if ($vercod != false) {
    $row = mysqli_fetch_assoc($vercod);
    if ($row['spProfileVerification'] == 0) {
        $unverified = 1;
    }
}

$friendrequest = 0;
if (isset($_SESSION["pid"])) {
    $res11 = $r->friendReequestAll($_SESSION["pid"]);
    if ($res11 != false) {
        $friendrequest = $res11->num_rows;
    }
}

//this is for header
if (isset($header_store) && $header_store == "header_store") {
//store module header
    $header = 'header_store';
} else if (isset($header_select) && $header_select == 'freelancers') {
//freelancer module header
    $header = 'header_freelancer';
} else if (isset($header_jobBoard) && $header_jobBoard == 'header_jobBoard') {
//freelancer module header
    $header = 'header_jobBoard';
} else if (isset($header_event) && $header_event == 'events') {
//event module header
    $header = 'header_events';
} else if (isset($header_realEstate) && $header_realEstate == 'realEstate') {
//real estate header
    $header = 'header_realEstate';
} else if (isset($header_photo) && $header_photo == 'header_photo') {
//real estate header
    $header = 'header_photo';
} else if (isset($header_entertain) && $header_entertain == 'entertain') {
//entertainment module
    $header = 'header_entertain';
} else if (isset($header_video) && $header_video == 'header_video') {
//video module
    $header = 'header_video';
} else if (isset($header_train) && $header_train == 'header_train') {
//TRAINING module
    $header = 'header_train';
} else if (isset($header_servic) && $header_servic == 'header_servic') {
//TRAINING module
    $header = 'header_servic';
} else if (isset($header_directy) && $header_directy == 'header_directy') {
//TRAINING module
    $header = 'header_directy';
} else if (isset($header_coupon) && $header_coupon == 'header_coupon') {
//TRAINING module
    $header = 'header_coupon';
} else if (isset($business_for_sale) && $business_for_sale == 'business_for_sale') {
//TRAINING module
    $header = 'business_for_sale';
} else {
    $header = 'header_two';
}


?>


<script type="text/javascript">
    function getComboA(selectObject) {
//var value = selectObject.value;
        var questionText = selectObject.replace(/[0-9]/g, '');
//alert($('option:selected'.text());
//alert($(".cate_drop :selected").text());
        var newtext = $(".cate_drop :selected").text();
//alert(questionText);
        if (questionText == '-p') {
            $(".cate_drop").find("option").each(function (index, option) {
                $(option).html($(option).html().replace(/ - Profile/g, ''));
            });

            $(".cate_drop").find("option").each(function (index, option) {
                $(option).html($(option).html().replace(/ - Product/g, ''));
            });

            $('.cate_drop option:selected ').text(newtext + " - Profile");

        } else if (questionText == '-c') {
            $(".cate_drop").find("option").each(function (index, option) {
                $(option).html($(option).html().replace(/ - Product/g, ''));
            });
            $(".cate_drop").find("option").each(function (index, option) {
                $(option).html($(option).html().replace(/ - Profile/g, ''));
            });

            $('.cate_drop option:selected ').text(newtext + " - Product");
        }
    }
</script>

<?php
if (isset($_SESSION['uid']) && $_SESSION['uid'] == 2324) {
    ?>

    <?php
    if (isset($_SESSION['msg']) && $_SESSION['count'] == 1) {
        ?>
        <div class="notificatontop">
            <p class="no-margin">
                <span class="pull-right"><?php echo $_SESSION['msg']; ?></span>
            </p>
        </div>
        <?php
        $_SESSION['count'] = 2;
        unset($_SESSION['msg']);
    }
    ?>
    <?php
} else {
    if (isset($_SESSION['uid']) && $_SESSION['uid'] > 0) {
        $u = new _spuser;
// IS EMAIL IS VERIFIED
        $p_result = $u->isverify($_SESSION['uid']);
        if ($p_result) {
            if ($p_result == 4) { ?>


                <div class="notificatontop">
                    <p class="no-margin">
                        <i class="fa fa-info-circle"></i> Your Mobile Number And Email Is Not Verified. Kindly Verifiy
                        Your Mobile Number And Email.


                        <a href="<?php echo $BaseUrl; ?>/authentication/resend.php?sendby=sms&code=<?php echo $_SESSION['uid']; ?>">Resend
                            Code To Phone</a>
                        <span>&nbsp;|&nbsp;</span>
                        <a href="<?php echo $BaseUrl; ?>/authentication/resend.php?sendby=email&code=<?php echo $_SESSION['uid']; ?>">Resend
                            Code To Email</a>
                        <span>&nbsp;|&nbsp;</span>
                        <a href="#" data-toggle="modal" data-target="#mynumberVerify">Verify Now</a>

                        <?php
                        if (isset($_SESSION['msg']) && $_SESSION['count'] == 1) {
                            ?><span class="pull-right"><?php echo $_SESSION['msg']; ?></span> <?php
                            $_SESSION['count'] = 2;
                            unset($_SESSION['msg']);
                        }
                        ?>
                    </p>
                </div>

                <?php

            } else if ($p_result == 3) {
                ?>
                <!-- <div class="notificatontop"> -->
                <!-- <p class="no-margin"> -->
                <!-- <i class="fa fa-info-circle"></i>Your Mobile Number Is Not Verified. -->

                <!-- <a href="#" data-toggle="modal" data-target="#mynumberVerify">Kindly Verifiy Your Mobile
                Number.</a> -->

                <!-- <a href="<?php echo $BaseUrl; ?>/authentication/resend.php?sendby=sms&code=<?php echo $_SESSION['uid']; ?>">Resend Code To Phone</a> -->

                <?php
                if (isset($_SESSION['msg']) && $_SESSION['count'] == 1) {
                    ?><span class="pull-right"><?php echo $_SESSION['msg']; ?></span> <?php
                    $_SESSION['count'] = 2;
                    unset($_SESSION['msg']);
                }
                ?>
                <!-- </p> -->
                <!-- </div> -->
                <?php
            } else if ($p_result == 2) {
                ?>
                <div class="notificatontop">
                    <p class="no-margin">
                        <i class="fa fa-info-circle"></i> Your Email Is Not Verified. Kindly Verifiy Your Email.
                        <a href="<?php echo $BaseUrl; ?>/authentication/resend.php?sendby=email&code=<?php echo $_SESSION['uid']; ?>">Resend
                            Code To Email</a>
                        <span>&nbsp;|&nbsp;</span>
                        <a href="#" data-toggle="modal" data-target="#mynumberVerify">Verify Now.</a>

                        <?php
                        if (isset($_SESSION['msg']) && $_SESSION['count'] == 1) {
                            ?><span class="pull-right"><?php echo $_SESSION['msg']; ?></span> <?php
                            $_SESSION['count'] = 2;
                            unset($_SESSION['msg']);
                        }
                        ?>
                    </p>
                </div>
                <?php
            }
        }
    } else {
        $re = new _redirect;
        $location = $BaseUrl . "/login.php";
    }
}

?>

<div class="modal fade" id="mynumberVerify" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content sharestorepos">

            <div class="modal-header">

                <h4 class="modal-title" id="userModalLabel">Verify Phone</h4>
            </div>
            <div class="modal-body" style="background-color:white;">

                <form action="" method="post" class="" id="form1">
                    <div class="row">
                        <?php

                        $u = new _spuser;
                        $result2 = $u->isPhoneVerify($_SESSION['uid']);

                        if ($result2) {

                            ?>
                            <div class="col-sm-12">
                                <p>Your Phone Number is Verified.</p>
                                <hr>
                            </div>

                            <?php
                        } else {
                            $u = new _spuser;


                            $data = $u->read_phoneNo($_SESSION['uid']);
                            if ($data) {
                                $row_1 = mysqli_fetch_assoc($data);
                            }


                            ?>
                            <input type="hidden" name="spUserVerfiyBy" value="sms"/>
                            <input type="hidden" name="idspUser" value="<?php echo $_SESSION["uid"]; ?>">
                            <input type="hidden" name="idspProfile" value="<?php echo $_SESSION['pid']; ?>">

                            <div class="col-md-8">

                                <div class="form-group">
                                    <label>Your Phone &nbsp;&nbsp; <a data-toggle="modal" class="pointer"
                                                                      data-target="#changemobile1"
                                                                      style="border-bottom: 1px solid #006aff;">Change
                                            Phone</a></label>
                                    <input type="text" name="phone_no" class="form-control"
                                           placeholder="Enter Phone Number here" required="" id="phone_no"
                                           value="<?php echo '+' . $userpnonecode . $userpnone; ?>" disabled>
                                    <span id="error2"></span>

                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <?php if ($row_1['spUserPhone']) { ?>
                                        <button type="button" name="btnVerifyCode"
                                                class="btn btn-primary btn-border-radius" style="width: 100%"
                                                id="btn_change" onclick="abc_head()">Send Otp
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>


                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Phone Verification Code</label>
                                    <input type="text" name="spUserVerifyCode" class="form-control"
                                           placeholder="Enter verification code here" required=""
                                           id="spUserVerifyCode11">
                                    <span id="error1"></span>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <?php if ($row_1['spUserPhone']) { ?>
                                        <button type="button" name="btnVerifyCode"
                                                class="btn btn-primary btn-border-radius" style="width: 100%"
                                                onclick="varify_phone('<?php echo $BaseUrl; ?>/authentication/updatedetails.php')">
                                            Verify Phone
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>


                    </div>
                </form>

                <!-- <button type="button" name="resend" class="btn btn-primary pull-right"  onclick="abc_head()">Resend</button> -->

                <form action="<?php echo $BaseUrl; ?>/authentication/updatedetails.php" method="post" class="">
                    <div class="row">
                        <?php
                        $u = new _spuser;
                        $result2 = $u->isEmailVerify($_SESSION['uid']);

                        if ($result2) {
                            $data = $u->read_phoneNo($_SESSION['uid']);
                            $row_d = mysqli_fetch_assoc($data);
                            ?>
                            <!-- <div class="col-md-12">
<p>Sent verification code <?php echo $row_d['spUserPhone']; ?></p>
<hr>
</div> -->

                            <?php
                        } else {
                            ?>
                            <input type="hidden" name="spUserVerfiyBy" value="email"/>
                            <input type="hidden" name="idspUser" value="<?php echo $_SESSION["uid"]; ?>">
                            <input type="hidden" name="idspProfile" value="<?php if (isset($_SESSION['pid'])) {
                                echo $_SESSION['pid'];
                            } ?>">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="spUserVerifyCode" class="control-label">Email Verification Code</label>
                                    <input type="text" class="form-control" id="spUserVerifyCode"
                                           id="spUserVerifyCode_1" name="spUserVerifyCode" value="" required=""/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label><br>
                                    <button type="submit" name="btnVerifyCode" class="btn btn-primary btn-border-radius"
                                            style="width: 100%">Verify Email
                                    </button>

                                </div>
                            </div>
                            <?php
                        } ?>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
$d = new _spuser;
$data = 20;


$sql = $d->readlogo($data);
if ($sql != false) {
    $img = mysqli_fetch_assoc($sql);
//print_r($img);
    $img1 = $img['spSettingLogo'];

// 02c21a6824d8aad82b8019248292be9f.png
} else {
    $img1 = "";
}
//die('=====');


?>


<header class="<?php echo $header; ?> header_front" id="header_name"
        style="height:69px; ">

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-VJPY80XYLY">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'G-VJPY80XYLY');
    </script>

    <div class="nav-bar">
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="left_head_top">
                    <div style="margin-top: 15px; height:100%; display:flex; align-items:center; ">

                        <!-- Logo -->
                        <div class="col-md-4"
                             style="display: flex; align-items: center; justify-content: flex-start; padding-right: 10px;">
                            <a href="<?php echo(isset($page) && $page == 'timeline' ? $BaseUrl : $BaseUrl . '/timeline/') ?>">
                                <img style="width:190px;" src="<?php echo $BaseUrl ?>/assets/images/logo.svg" alt="">
                            </a>
                        </div>

                        <!-- Search form -->
                        <div class="col-md-8 search-box" style="display:flex; align-items:center;
                            width:400px !important; height:30px !important; border-radius:75px !important">
                            <form class="inner_top_form" method="POST" action="<?php echo $BaseUrl; ?>/search/index.php"
                                  style="display: flex; align-items: center; height: 30px !important; width:400px !important; border-radius: 75px; overflow: hidden;">

                                <!-- Dropdown -->
                                <div class="form-group onpage" style="margin: 0;">
                                    <select class="form-control cate_drop" name="txtCategory"
                                            onchange="getComboA(this.value)"

                                            style="background-color: #F9FAFB !important;

                                          border-radius:75px 0px 0px 75px !important;
                                          font-size: 14px !important;
                                          height: 100% !important;
                                          display: flex !important;
                                          justify-content: center !important;
                                          align-items: center !important;
                                          width: 140px !important;
                                          gap:20px !important;
                                          padding-left: 20px !important;
                                          padding-right: 5px !important;
                                          border-right:0.7px solid #b0b0b0 !important;">
                                        <?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>
                                            <optgroup label="Profiles">
                                                <option value="-p">All Profiles</option>
                                                <?php
                                                $pt = new _profiletypes;
                                                $rpt = $pt->read();
                                                while ($row = mysqli_fetch_assoc($rpt)) {
                                                    ?>
                                                    <option value="<?php echo $row['idspProfileType']; ?>-p" <?php if (isset($categoryvalue)) {
                                                        if ($categoryvalue == $row['idspProfileType']) {
                                                            echo "selected";
                                                        }
                                                    } ?>><?php echo $row['spProfileTypeName'] ?></option>
                                                <?php } ?>
                                            </optgroup>
                                        <?php } ?>
                                        <optgroup label="Product">
                                            <?php
                                            $ca = new _categories;
                                            $result = $ca->read();
                                            if ($result != false) {
                                                while ($rows = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value="<?php echo $rows['idspCategory']; ?>" <?php if (isset($categoryvaluepro)) {
                                                        if ($categoryvaluepro == $rows['idspCategory']) {
                                                            echo "selected";
                                                        }
                                                    } ?>><?php echo $rows['spCategoryName']; ?></option>
                                                <?php }
                                            } ?>
                                        </optgroup>
                                    </select>
                                </div>

                                <!-- Text input -->
                                <div class="form-group"
                                     style="width: calc(100% - 130px); position: relative; height:100%">
                                    <input type="text" class="form-control" placeholder="Search"
                                           aria-describedby="basic-addon1" name="txtSearch"
                                           value="<?php if (isset($txtSearchvalue)) {
                                               echo $txtSearchvalue;
                                           } ?>" required
                                           style="width:100%; height:114%; border-radius: 0px 75px 75px 0px;
                               border:none; padding: 0px 10px; outline:none; background-color:white">

                                    <div class="search-icon" style="
                                                position: absolute !important;
                                                top: 7px !important;
                                                right: 0px !important;
                                                height: 30px !important;
                                                width: 30px !important;
                                                display: flex !important;
                                                justify-content: center !important;
                                                align-items: center !important;
                                                border-radius:50% !important;
                                                background-color: #FB8308 !important">
                                        <!-- Button -->
                                        <button id="indent" class="btn btn-light" type="submit" name="btnSearch"
                                                style="padding:0; border-style:none; background:transparent; border:none; cursor:pointer">
                                            <svg width="13" height="12" viewBox="0 0 13 12" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z"
                                                      fill="#1F1216"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                .zoom {
                / / padding: 50 px;
                / / background-color: green;
                    transition: transform .2s;
                / / width: 19 px;
                / / height: 19 px;
                / / margin: 0 auto;
                }

                .zoom:hover {
                    -ms-transform: scale(1.1);
                    /* IE 9 */
                    -webkit-transform: scale(1.1);
                    /* Safari 3-8 */
                    transform: scale(1.1);
                }

                .dropdown-backdrop {
                    display: none !important;
                }
            </style>

            <?php
            $p = new _spprofiles;
            $rp = $p->readDefaultProfile($_SESSION['uid']);
            if ($rp == false) {
                $rp = $p->readDefaultProfile_causal($_SESSION['uid']);
            }

            if ($rp != false) {


                $row = mysqli_fetch_array($rp);

                $updateid = $p->update(array('is_active' => 1), "WHERE t.idspProfiles =" . $row['idspProfiles']);

                $_SESSION['pid'] = $row['idspProfiles'];
                $_SESSION['myprofile'] = $row["spProfileName"];
                $_SESSION['MyProfileName'] = $row["spProfileName"];
                $_SESSION['ptname'] = $row["spProfileTypeName"];
                $_SESSION['ptpeicon'] = $row["spprofiletypeicon"];
                $_SESSION['ptid'] = $row["spProfileType_idspProfileType"];
                $_SESSION['isActive'] = 1;
                $c = new _order;
                $res = $c->read($_SESSION['pid']);
                if ($res != false) {
                    $_SESSION['cartcount'] = $res->num_rows;
//echo $_SESSION['cartcount'];
                } else {
                    $_SESSION['cartcount'] = 0;
                }
            }


            ?>


            <div class="col-md-4 col-xs-12 no-padding">
                <div class="right_head_top">
                    <ul>


                        <li id="notification_li" style="margin-left: -8px !important;">
                            <a href="#" id="notificationLink" data-placement="bottom" title="Request">
                                <img src="<?php echo $BaseUrl ?>/assets/images/hand-shake.svg" alt="">
                            </a>
                            <div id="notificationContainer">
                                <div id="notificationTitle">
                                    <?php echo($friendrequest == 0 ? "No Request" : "Friend Requests"); ?>
                                </div>
                                <div class="notifications notificationsBody">
                                    <?php
                                    $r = new _spprofilehasprofile;
                                    $res = $r->friendReequestList($_SESSION["pid"]);
                                    //echo $r->ta->sql;
                                    $total = 0;
                                    if ($res != false) {
                                        $i = 1;
                                        while ($rows = mysqli_fetch_assoc($res)) {
//print_r($rows);
                                            $total = $res->num_rows;
//echo $total.'love';
                                            $p = new _spprofiles;
                                            $sender = $rows["spProfiles_idspProfileSender"];
                                            $receiver = $rows["spProfiles_idspProfilesReceiver"];
                                            $result = $p->read($sender);
//var_dump($result);
                                            if ($result) {

                                                $row = mysqli_fetch_assoc($result);
                                                ?>
                                                <div id="friend_boxx<?php echo $i; ?>" class="row no-margin ">
                                                    <div class="col-md-2 no-padding">
                                                        <?php
                                                        echo "<img  alt='profile-Pic' class='img-responsive' style='width:46px; height: 46px;margin-top:5px;' src='" . (isset($row['spProfilePic']) ? " " . ($row['spProfilePic']) . "" : "../assets/images/icon/blank-img.png") . "'>";
                                                        ?>
                                                    </div>
                                                    <div class='col-md-10 friendsname no-padding-right'>
                                                        <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $rows["spProfiles_idspProfileSender"] ?>"><?php echo $row["spProfileName"] . " (" . $row["spProfileTypeName"] . ")"; ?></a>
                                                        <div class='btn-group' role='group' aria-label='Basic example'>
                                                            <button type='button' id="<?php echo $i; ?>"
                                                                    onclick="acceptrequest(<?php echo $sender; ?>,<?php echo $receiver; ?>)"
                                                                    style="margin-right: 20px;"
                                                                    class='btn btn-primary btn-sm btn-border-radius'
                                                                    data-sender='<?php echo $sender; ?>'
                                                                    data-receiver='<?php echo $receiver; ?>'>Confirm
                                                            </button>
                                                            <button type='button' id="<?php echo $i; ?>"
                                                                    onclick="rejectrequest(<?php echo $sender; ?>,<?php echo $receiver; ?>)"
                                                                    class='btn btn-warning btn-sm btn-border-radius'
                                                                    data-sender='<?php echo $sender; ?>'
                                                                    data-receiver='<?php echo $receiver; ?>'>Ignore
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <?php
                                            }
                                            $i++;
                                        }
                                    }
                                    ?>
                                </div>
                                <div id="notificationFooter" class="<?php echo($friendrequest <= 3 ? "hidden" : "") ?>">
                                    <span style="cursor:pointer;">See All</span></div>
                                <div>
                                    <div class="notifications notificationsBody 33"
                                         style="overflow:scroll; display:none;height:300px; overflow-x: hidden;"
                                         id="footerbody">
                                        <?php
                                        include("allfriend.php"); //All Friend Request
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <span class="<?php echo($friendrequest == 0 ? "hidden" : ""); ?> aaa bbb"
                                  id="notification_count"><?php echo $friendrequest; ?></span>
                        </li>
                        <!--Complete-->
                        <li style="margin-left: -8px !important;"><a href="<?php echo $BaseUrl; ?>/timeline/"
                                                                     title="Timeline" data-placement="bottom">
                                <img style="height:20px !important; margin-top:6px"
                                     src="<?php echo $BaseUrl ?>/assets/images/help.svg" alt="">
                            </a></li> &nbsp;
                        <li style="margin-left: -10px !important;">
                            <a href="<?php echo $BaseUrl; ?>/inbox.php?msg=inbox_msg" id="notification_msg"
                               data-placement="bottom" title="Message">
                                <img style="height:20px !important; margin-top:6px"
                                     src="<?php echo $BaseUrl ?>/assets/images/messenger.svg" alt="">

                            </a>&nbsp;
                            <span class="<?php echo($totalunread == 0 ? "hidden" : ""); ?>"
                                  id="notification_count"><?php if (isset($totalunread)) {
                                    echo $totalunread;
                                } ?></span>&nbsp;
                        </li>
                        <li style="margin-left: -10px !important;"><a
                                    href="<?php echo $BaseUrl; ?>/enquiry/notification.php" title="Notification"
                                    data-placement="bottom">
                                <img style="height:20px !important; margin-top:6px"
                                     src="<?php echo $BaseUrl ?>/assets/images/notification.svg" alt="">
                            </a>&nbsp;

                            <?php
                            $p = new _postenquiry;
                            $res1 = $p->readnotid($_SESSION['uid']);
                            if ($res1 != false) {
                                $noti = $res1->num_rows;
                            } else {
                                $noti = 0;
                            }
                            ?>

                            <span class="<?php echo($noti == 0 ? "hidden" : ""); ?>"
                                  id="notification_count"><?php if (isset($noti)) {
                                    echo $noti;
                                } ?></span>&nbsp;
                        </li>
                        <?php
                        $pbasket = new _spcustomers_basket;
                        $totorder = 0;
                        $resultbasket = $pbasket->readCartItem($_SESSION['uid']);
                        //echo $resultbasket->num_rows;die('=====');
                        if ($resultbasket != false) {

                            $totorder = $resultbasket->num_rows;

                            while ($cartrow = mysqli_fetch_assoc($resultbasket)) {
                                //$totorder ++;
                                //$totorder = $cartrow['spOrderQty'];
                                //$totorder =  $totorder + $cartrow['spOrderQty'];
                            }
                        }

                        ?>
                        <li style="margin-left: -10px !important;" id="cart">
                            <a href="<?php echo $BaseUrl; ?>/cart/" title="Cart" data-placement="bottom">
                                <img style="height:20px !important; margin-top:6px"
                                     src="<?php echo $BaseUrl ?>/assets/images/cart.svg" alt="">
                                <span class="<?php echo($totorder == 0 ? "hidden" : ""); ?>"
                                      id="notification_count"><?php if (isset($totorder)) {
                                        echo $totorder;

                                    } ?></span> </a> &nbsp;
                        </li>
                        <li class="cls" style="padding-left: inherit;">
                            <div class="btn-group" role="group" style="cursor:pointer;">
                            <span class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                  aria-expanded="false"><span title="Settings" data-placement="bottom">
                            <img style="height:20px !important; margin-left:-3px !important; margin-right:-4px !important; margin-top:6px"
                                 src="<?php echo $BaseUrl ?>/assets/images/setting.svg" alt="">
                                </span>
                                <!-- <span class="caret"></span>-->

                            </span>

                                <ul class="dropdown-menu setting_left" style="z-index: 15;">
                                    <!--<li><a href="<?php echo $BaseUrl; ?>/
"><span class="fa fa-dashboard"></span> Dashboard</a></li>-->
                                    <?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>
                                        <!--                                        <li><a href='--><?php //echo $BaseUrl; ?><!--/public_rfq/?condition=All&folder=rfq&page=1' id='rfq'><span class="fa fa-file"></span> Manage RFQ</a></li>-->
                                        <!--<li><a href="/my-posts/">My Posts </a></li>-->
                                        <!--                                        <li><a href="--><?php //echo $BaseUrl; ?><!--/my-groups/"><span class="fa fa-users"></span> My Groups </a></li>-->
                                        <li><a href="<?php echo $BaseUrl; ?>/my-profile/"><span
                                                        class="fa fa-user"></span> My Profiles</a></li>
                                        <!--                                        <li><a href="--><?php //echo $BaseUrl; ?><!--/my-friend/"><span class="fa fa-handshake-o"></span> My Friends</a></li>-->
                                        <li><a data-toggle="modal" class="pointer" data-target="#inviteFriend"><span
                                                        class="fa fa-user"></span> Invite Friends </a>
                                        </li>
                                        <!--   <li><a href="<?php echo $BaseUrl; ?>/public-group/">Public Group</a></li> -->
                                        <li><a href="<?php echo $BaseUrl; ?>/membership/"><span
                                                        class="fa fa-credit-card"></span> Subscription</a></li>
                                        <li><a href="<?php echo $BaseUrl; ?>/dashboard/settings/"><span
                                                        class="fa fa-cog"></span> Master Dashboard </a></li>
                                        <!--  <li><a href="<?php //echo $BaseUrl;
                                        ?>/purchasehistory/?transaction=1">Purchase History</a></li>
<li><a href="<?php //echo $BaseUrl;
                                        ?>/purchasehistory/?transaction=2">Selling History</a></li> -->
                                    <?php } ?>
                                    <li><a href="<?php echo $BaseUrl; ?>/authentication/logout.php"
                                           data-toggle="tooltip" data-placement="bottom" title="Logout"><span
                                                    class="fa fa-sign-out"></span> Logout </a></li>
                                </ul>
                            </div>

                        </li>
                        <!--                        <div style="height:32px !important; width:1.9px !important; background:white"> </div>-->

                        </li>
                        <li>
                            <div class="line" style="height:32px; width:1.5px; background-color:white;"></div>

                        </li>
                        <li>
                            <div class="dropdown" style="width: 179px; margin-top: 0px!important;">
                                <a href="JavaScript:void(0)" style="height:40px;" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                    $p = new _spprofiles;
                                    $result = $p->read($_SESSION['pid']);
                                    if ($result != false) {
                                        $row = mysqli_fetch_assoc($result);
                                        echo '<div style="display: flex; align-items: center; gap: 10px;">';
                                        if (isset($row["spProfilePic"]) && $row['spProfilePic'] != '') {
                                            echo "<img alt='profilepic' style='height:32px; width:32px; border-radius:50%;' class='img-responsive' src='" . ($row["spProfilePic"]) . "' >";
                                        } else {
                                            echo "<div style='width:32px; height:32px; background-color:white; border-radius:50%; display:flex; justify-content:center; align-items:center;'>
                            <img src='' alt='' style='width: 32px; height: 32px;'>
                          </div>";
                                        }
                                        echo '<div style="display: flex; flex-direction: column;">';
                                        echo '<span style="font-size: 14px; font-weight: 600; color: white; text-transform:lowercase">' .
                                            (isset($_SESSION['MyProfileName']) && !empty($_SESSION['MyProfileName'])
                                                ? substr(ucwords(strtolower($row['spProfileName'])), 0, 15)
                                                : substr(ucwords(strtolower($_SESSION['username'])), 0, 15)) .
                                            '</span>';
                                        echo '<span style="font-size: 12px; color:white">' . (isset($_SESSION['guet_yes']) && $_SESSION['guet_yes'] == 'yes' ? "Guest Profile" : $row['spProfileTypeName'] . " Profile") . '</span>';
                                        echo '</div><img class="" src="' . $BaseUrl . '/assets/images/down-arrow-2.svg" style="margin-left:auto; height:16px; width: 16px"></div>';
                                    }
                                    ?>
                                </a>

                                <ul class="dropdown-menu" id="profileDropDown">
                                    <?php
                                    $p = new _spprofiles;
                                    $rpvt = $p->readProfiles($_SESSION["uid"]);
                                    $user_profiles_list = array();
                                    if ($rpvt != false) {
                                        while ($row = mysqli_fetch_assoc($rpvt)) {
                                            ?>
                                            <li class="<?php echo ($_SESSION['pid'] == $row['idspProfiles']) ? 'active' : ''; ?>">
                                                <a style="padding:8px" class="sp-user-profile-label headProfile" href="javascript:void(0)"
                                                   data-profileid='<?php echo $row['idspProfiles']; ?>'>
                                                    <div style="display: flex; align-items: center; gap: 10px;">
                                                        <?php if ($row["spProfilePic"] == '') { ?>
                                                            <img src="<?php echo $BaseUrl . '/img/noman.png' ?>" alt=""
                                                                 style="width:32px; height:32px; border-radius:50%;">
                                                        <?php } else { ?>
                                                            <img src="<?php echo($row["spProfilePic"]); ?>"
                                                                 style="width:32px; height:32px; border-radius:50%;">
                                                        <?php } ?>
                                                        <div style="display: flex; flex-direction: column;">
                                    <span ><?php echo isset($row['spProfileName']) && $row['spProfileName'] !== ''
                                            ? ucwords(substr($row['spProfileName'], 0, 15))
                                            : ucwords(substr($_SESSION['username'], 0, 15)); ?>
                                    </span>
                                                            <span style="font-size: 10px;">
                                        <?php echo isset($_SESSION['guet_yes']) && $_SESSION['guet_yes'] == 'yes'
                                            ? "Guest Profile"
                                            : $row['spProfileTypeName'] . " Profile"; ?>
                                    </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <?php
                                            array_push($user_profiles_list, $row['idspProfiles']);
                                        }
                                    }
                                    ?>
                                    <?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>
                                        <li class="text-center" style="margin-top: 3px;">
                                            <a href="<?php echo $BaseUrl . '/my-profile'; ?>">Add/Edit Profiles</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="inviteFriend" tabindex="-1" role="dialog" aria-labelledby="inviteFriendLabel"
         aria-hidden="true" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inviteFriendLabel">Invite Friends
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </h5>
                </div>
                <div class="modal-body">
                    <form action="<?php echo $BaseUrl . '/my-profile/invitefriend.php'; ?>" method="post" class=""
                          id="form_submit">
                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="yourName" class="control-label contact">Your Name <span class="red">*</span></label>
                                <input type="text" class="form-control" id="yourName"
                                       value="<?php echo $_SESSION['MyProfileName']; ?>" readonly/>
                            </div>

                            <div class="form-group">
                                <label for="sendTo" class="control-label contact">Send To <span
                                            style="font-size: 12px; color: red;">Add multiple emails by separating with semicolon ;</span>
                                    <span class="red">*</span></label>
                                <textarea class="form-control" id="if_email" name="if_email" placeholder=""
                                          required=""></textarea>
                            </div>
                            <div class="form-group">
                            </div>
                            <?php
                            $p = new _spprofiles;

                            $d = $p->inviteFrd_description(4);
                            if (isset($_SESSION['uid'])) {
                                $a = $p->read_reffer($_SESSION['uid']);
                                if ($a) {
                                    $reff = mysqli_fetch_array($a);
                                }

                            }


                            if ($d) {
                                $ro = mysqli_fetch_array($d);
                                $notification_description = $ro['notification_description'];
//$subject = $ro['subject'];
                            }


                            // relevant table 'spemailcontent' does not exist
                            /*$email_data = $p->read_invite_desc();
                             if($email_data != false){
                               $email_data_read = mysqli_fetch_array($email_data);
                             }*/
                            ?>
                            <div class="form-group">
                                <!-- <label for="txtmessage" class="control-label contact">Message <span class="red">*</span></label>
                                 -->
                                <textarea class="form-control c-with-editor" id="eg-editor" name="if_message"
                                          required="" style="display: none;">
<?php
// relevant table 'spemailcontent' does not exist
/*$string_email = str_replace("{{referral_code}}", $reff['userrefferalcode'], $email_data_read['content']);

echo $string_email; */

?>

<!-- <p>Hello there, </p>

<p>Check out this exciting Social and Business Networking platform called "The SharePage" - it is a one-stop shop for many things and offers many modules to advertise your products/services with 0 listing fee plus they offer referral commissions!</p>

<p>Also you can get a webpage for yourself or for your business with no cost!!</p>

<p>Here is the link:</p>
https://thesharepage.com and use my referral code "<?php // echo $reff['userrefferalcode']; ?>".
<p>Sign up and lets make the most of it at The SharePage!</p>
<br></p> -->
</textarea>


                                <!-- <textarea class="form-control" rows="7" id="if_message" name="if_message" required=""><?php echo $notification_description; ?>
https://thesharepage.com, use my referral code <?php echo $reff['userrefferalcode']; ?>. Thank you</textarea> -->
                            </div>
                        </div>

                        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

                        <script type="text/javascript">
                            tinymce.init({
                                selector: '.c-with-editor',
                                skin: "lightgray",
                                height: 300,
                                menubar: false,
                                statusbar: false,
                                plugins: ['advlist autosave lists hr spellchecker nonbreaking'],
                                toolbar: ['bold italic underline | alignleft aligncenter alignright alignjustify | styleselect | numlist bullist |'],
                            }).then(function (editors) {
                                $("#mceu_19").remove();
                            });

                        </script>

                        <div class="modal-footer bg-white br_radius_bottom">
                            <!--<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>-->
                            <button type="button" onclick="validateEmail()"
                                    class="btn btn-submit db_btn db_primarybtn  btn-border-radius"><i
                                        class="fa fa-user"></i> Invite Friends
                            </button>
                        </div>
                    </form>
                    <!-- Add your modal content here -->
                </div>

            </div>
        </div>
    </div>

    <script>


        function acceptrequest(sender, receiver
        ) {

            var noti = $("#notification_count").html();
            noti = noti - 1;
            $.post('../friends/accept.php', {
                sender: sender,
                receiver: receiver

            }, function (d) {
//alert(d);
                if (noti == 0) {
                    $("#notification_count").addClass('hidden');
                    $("#notificationTitle").html("");
                    $("#notificationTitle").html("No Request");
                    $(".notificationsBody").remove();


                } else {
                    $("#notification_count").html(noti);

                }
                window.location.reload();
            });
            $("#friend_boxx" + this.id).css("display", "none");


        }

        function rejectrequest(sender, receiver
        ) {

            var noti = $("#notification_count").html();
            noti = noti - 1;
            $.post('../friends/reject.php', {
                sender: sender,
                receiver: receiver

            }, function (d) {
//alert(d);
                if (noti == 0) {
                    $("#notification_count").addClass('hidden');
                    $("#notificationTitle").html("");
                    $("#notificationTitle").html("No Request");
                    $(".notificationsBody").remove();


                } else {
                    $("#notification_count").html(noti);

                }
                window.location.reload();
            });
            $("#friend_boxx" + this.id).css("display", "none");


        }


        function timeline_sms() {

            $.ajax({
                url: "<?php echo $BaseUrl . '/phone_sms/send_setting_sms.php'; ?>",
                type: "POST",
                data: {},
                success: function (html) {


                }
            });
        }

        function abc_head() {
            if ($('#phone_no').val().trim() == '') {
                alert('Enter Phone Number');
            } else {
                $.ajax({
                    url: "<?php echo $BaseUrl . '/phone_sms/send_setting_sms.php'; ?>",
                    type: "POST",
                    data: {},
                    success: function (data) {

                        $("#error2").html("<div class='alert alert-success' id='resend_sms'style='padding:10px'>Otp Sent Successfully.</div>");
                        $('#btn_change').html('Resend Otp');

                        setTimeout(function () {
                            $("#resend_sms").hide()
                        }, 3000);


                    }
                });
            }
        }

        function varify_phone(url) {
            if ($('#spUserVerifyCode11').val().trim() == '') {
                alert('Enter verification code');
            } else {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#form1').serialize(),
                    success: function (data) {
//alert(data);

                        if (data.trim() == 1) {
                            $("#error1").html("<div class='alert alert-success' style='padding:10px'>Your Phone Number Is Verified Successfully.</div>");
                            setInterval(function () {

                                window.location.href = BASE_URL + "/dashboard/settings/";
                            }, 3000);

                        } else {
                            $('#spUserVerifyCode11').val('');

                            $("#error1").html("<div class='alert alert-danger' id='abc' style='padding:10px'>Incorrect Code. Please try again and enter a valid code</div>");

                            setTimeout(function () {
                                $("#abc").hide()
                            }, 3000);

                        }

                    }
                });
            }
        }


    </script>

    <script>
        function validateEmail() {
            var emailField = $('#if_email').val();
//alert(emailField)

            var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.;])+\.([A-Za-z]{2,4})$/;


            /*if (reg.test(emailField.value) == false)
            {
            alert('Invalid Email Address');
            //return false;
            }
            else{
            $('#form_submit').submit();

            }*/
            $('#form_submit').submit();
        }
    </script>
    <div class="modal fade" id="changemobile1" tabindex="-1" role="dialog" aria-labelledby="userModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content sharestorepos bradius-15">

                <div class="modal-header br_radius_top bg-white">
                    <button type="button" id="update_close" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title" id="changeModalLabel"><b>Change Phone Number</b></h3>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-9">
                            <!-- <div class="alert alert-success" id="smsg" style="display:none;">
                            <div id="msg"></div>
                            </div> -->
                            <div class="form-group">
                                <label for="update_mobile" class="control-label">Current Phone Number:</label>
                                <span class="phone-display"><?php echo '+' . $userpnonecode . $userpnone ?></span>
                                <input type="hidden" class="form-control" id="old_number1" name=""
                                       value="<?php echo $userpnone; ?>">
                            </div>

                            <div>
                                <label for="">Select country code</label>
                                <input type="hidden" class="form-control txtbox" id="hidden_phone1" name="hidden_phone"
                                       value="<?php echo '+' . $userpnonecode . $spUserPhone; ?>">

                                <label for="respUserEphone" class="lbl_9"> <span
                                            style="color: #938b80;font-size: 10px;"> (select country code first)</span><span
                                            class="red">* </span></label><br/>
                                <input type="text" class="form-control txtbox" id="txtPhone1" name="spUserPhone"
                                       value="">


                                <input type="hidden" id="hiddenDialCode" name="dialCode" value="91">

                            </div>
                            <span id="err_phone" class="red"></span>

                        </div>
                    </div>


                    <div class="row" id="enter_otp" style="display:none;">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="otp" class="control-label">Enter OTP<span class="red">* </span></label>
                                <input type="text" class="form-control" id="otp" name="otp" value="">
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-top:18px">
                            <div class="form-group">
                                <button type="button" id="re_send_otp"
                                        class="btn btn-submit btn-border-radius db_btn db_primarybtn"
                                        data-dismiss="modal">Re-Send OTP
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-white br_radius_bottom center">
                    <!--<button type="button" class="btn butn_cancel btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>-->
                    <span id="sendotp">
<button type="button" data-dismiss="modal" id="up_mobile_btn_1"
        class="btn btn-submit btn-border-radius db_btn db_primarybtn">Update Phone</button>
</span>
                    <span id="change_number" style="display:none;">
<button type="button" id="up_mobile_btn_2_1"
        class="btn btn-submit btn-border-radius db_btn db_primarybtn">Update Phone</button>
</span>
                </div>

            </div>
        </div>
    </div>

</header>


<script>
    var MAINURL = window.location.origin;
    var millisecondsLag = 10000;

    setInterval(function () {
        $.ajax({
            type: "post",
            url: MAINURL + "/header_new.php",
            datatype: "html",
            success: function (data) {
                if (data != "") {
                    $(".notificationsBody").html(data);
                    $("#notificationTitle").html("Friend Requests");
                } else {
                    $(".notificationsBody").html(data);
                    $("#notificationTitle").html("No Request");
                }
                $.ajax({
                    type: "post",
                    url: MAINURL + "/header_count.php",
                    datatype: "html",
                    success: function (data) {
                        if (data > 0) {
                            $("#notification_count").removeClass("hidden");
                            document.getElementById("notification_count").innerHTML = '' + data + '';
                        } else {
                            $("#notification_count").addClass("hidden");
                        }
                    }
                });

            }
        });
    }, millisecondsLag); //time in milliseconds
</script>
<script>
    setInterval(function () {
        $.ajax({
            type: "post",
            url: MAINURL + "/msg_notificationCount.php",
            datatype: "html",
            success: function (data) {
                if (data > 0) {
                    $("#notify1").removeClass("hidden");
                    document.getElementById("notify1").innerHTML = '' + data + '';
                } else {
                    $("#notify1").addClass("hidden");
                }
            }
        });
    }, millisecondsLag); //time in milliseconds
</script>


<script>
    $("#country").change(function () {
        let countryCode = $(this).find('option:selected').data('country-code');
        let value = "+" + $(this).val();
        $('#txtPhone1').val(value).intlTelInput("setCountry", countryCode);
    });

    var code = $('#hidden_phone1').val();
    $('#txtPhone1').val('').intlTelInput();


    $("#up_mobile_btn_1").click(function () {

//var str1 = "+";
//var str2 = countryCode;
//var res = str1.concat(str2);
        var mobile = $("#update_mobile").val();
        var companyExtNo_ = $("#companyExtNo_").val();
        var hiddenDialCode = $("#hiddenDialCode").val();
        var txtPhone = $("#txtPhone1").val();

        $("#phone_no").val(txtPhone);

        var old_number = $("#old_number1").val();
        var selectedValue = $('#companyExtNo_ option:selected').val();
        var otplength = ($("#txtPhone1").val().length);
        if (mobile == "") {
            swal({
                    title: "Please enter phone number!",
                    type: 'warning',
                    showConfirmButton: true
                },
                function () {

                });
            return false;
        } else if (otplength < 5) {
            $("#err_phone").text("Please enter valid number number.")
            return false;
        } else {


            $.ajax({
                type: 'POST',
                url: BASE_URL + "/dashboard/settings/update_mobile.php",
                cache: false,
                data: {
                    'phone_no': txtPhone,
                    'phoneno': txtPhone,
                    'phone_code': hiddenDialCode,
                    'companyExtNo': companyExtNo_,
                    'mobile1': mobile,
                    'send_otp': 0
                },
                beforeSend: function () {
                    $('#up_mobile_btn_1').attr("disabled", "disabled");

                },
                success: function (response) {
                    $("#up_mobile_btn_1").removeAttr("disabled");
                    var respomses = response.trim();
                    if (respomses == 'success') {
                        $("#msg").html(response.msg);
                        $("#smsg").css("color", "black");
                        $("#smsg").css("display", "block");
                        $("#enter_otp").css("display", "block");
                        $("#sendotp").css("display", "none");
                        $("#change_number").css("display", "inline");

                        $('#update_close').trigger('click');


//window.location.href = BASE_URL+"/dashboard/settings/";


                    } else {

                        $("#msg").html(response.msg);
                        $("#smsg").css("display", "block");
                        $("#smsg").css("color", "red");
                    }


                }

            });
        }
    });
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $('li').click(function () {

            var clickedValue = $(this).data('dial-code');

            //alert(clickedValue);
            $('#hiddenDialCode').val(clickedValue);

        });
    });

    /*let counter = 0;

      function addFields() {
        counter++;
        var container = document.getElementById('container');
        var newField = document.createElement('div');
        newField.className = 'row'; // assuming you want a new row for each pair of input and remove button
        newField.innerHTML = '<div class="col-sm-8" id="textname' + counter + '"><input type="text" name="textname[]" class="form-control"></div><div class="col-sm-4"><button class="btn btn-danger" id="textname' + counter + '"onclick="removeField(' + counter + ')">Remove</button></div>';
        container.appendChild(newField);
        counter++; // increment counter for unique ids
      }

      function removeField(id) {
        var fieldToRemove = document.getElementById('textname' + id).parentNode.parentNode;
        fieldToRemove.remove();
      } */
</script>
