<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$versions = 11;
require_once "../classes/Base.php";
require_once "../classes/Header.php";
require_once("../helpers/start.php");

if(isset($page) && $page == "subscription") {
    $redirectUrl = "membership/dash_index.php";
} else if(isset($page) && $page == 'profilepage'){
    $redirectUrl = "my-profile/newprofile.php";
} else if(isset($page) && $page == 'neweditprofile'){
    $redirectUrl = "my-profile/";
} else if(isset($page) && $page == 'connection'){
    $redirectUrl = "my-friend//";
} else {
    $redirectUrl = "timeline/";
}

if(isset($access_without_login) && $access_without_login == true) {
} else {
    checkLogin($redirectUrl);
}

$pt = new Header;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>The SharePage</title>
    <?php if (isset($page) && $page == "subscription") { ?>
        <link rel="stylesheet" href="<?php echo $BaseUrl ?>/assets/css/style1.css?v=<?php echo $versions;?>">
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo $BaseUrl ?>/assets/css/all.css">
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <?php } ?>
    <link rel="icon" type="image/x-icon" href="<?php echo $BaseUrl;?>/assets/images/logo/tsp_trans.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if(isset($page) && $page == 'job-detail') {
        include_once "../ssp/custom-mysql.php";
        $header_job_data = selectQuery('spjobboard',' idspPostings = '.$_GET['postid']);
        $header_job_data = $header_job_data->fetch_assoc();
        $description = strip_tags($header_job_data['spPostingNotes']);
        if(!empty($header_job_data['spPostingsCity'])){
            $co = new _city;
            $result3 = $co->readCityName($header_job_data['spPostingsCity']);
            if ($result3 != false) {
                $cityData = mysqli_fetch_assoc($result3);
                $city = $cityData['city_title'];
                $description .= '. &#10; City - ' . $city;
            }
        }
        ?>
        <meta name="description" content="<?php echo $description ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo $header_job_data['spPostingTitle'] ?>">
        <meta property="og:description" content="<?php echo $description ?>">
        <meta property="og:image" content="<?php echo $BaseUrl ?>/assets/images/logo/tsp_trans.png">
        <meta property="og:url" content="<?php echo $BaseUrl . $_SERVER['REQUEST_URI']; ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo $header_job_data['spPostingTitle'] ?>">
        <meta name="twitter:description" content="<?php echo $description ?>">
        <meta name="twitter:image" content="<?php echo $BaseUrl ?>/assets/images/logo/tsp_trans.png">
    <?php } ?>

    <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/time-line.css?v=<?php echo $versions;?>">
    <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/InvitePage.css">
    <link href="<?php echo $BaseUrl;?>/assets/css/5.3.3/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/5.15.4/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/preview/public-job-module.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery_3.5.1/jquery.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap.min.js"></script>
    <script src="<?php echo $BaseUrl?>/assets/js/sweetalert.js"></script>
    <script src="<?php echo $BaseUrl?>/assets/js/5.3.3/bootstrap.bundle.min.js"></script>
    <link href="<?php echo $BaseUrl?>/assets/css/select2.min.css" rel="stylesheet">
    <script src="<?php echo $BaseUrl?>/assets/js/select2.full.min.js"></script>
    <script src="<?php echo $BaseUrl?>/assets/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo $BaseUrl ?>/assets/css/jquery-ui.css">
    <?php
    if(isset($page) && $page == 'profilehomepage') {
        ?>
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/profile.css?v=<?php echo $versions;?>">
        <?php
    }
    if(isset($page) && $page == 'publicview') {
        ?>
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/personal-profile.css?v=<?php echo $versions;?>">
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/magnific-popup/magnific-popup.css">
        <script src="<?php echo $BaseUrl?>/assets/js/jquery.magnific-popup.min.js"></script>
        <?php
    }
    ?>
    <link href="<?php echo $BaseUrl; ?>/assets/quill/quill.snow.css" rel="stylesheet" />
    <?php if(isset($page) && ( in_array($page, ["timeline",'connection','jobBoard','profile_search', 'businessPage'] )) ){ ?>
        <link href="<?php echo $BaseUrl; ?>/assets/quill/quill.snow.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php } ?>
    <?php
    if (isset($page) && ($page == 'neweditprofile' || $page == 'profilepage')) {
        ?>
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/editprofile.css?v=<?php echo $versions;?>">
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/create-profile.css?v=<?php echo $versions;?>">
        <link href="<?php echo $BaseUrl;?>/assets/css/5.3.3/bootstrap.min.css" rel="stylesheet">
        <?php
    }?>
    <?php
    if (isset($page) && ($page == 'connection' || $page == 'profile_search' )) {
        ?>
        <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/connection.css?v=<?php echo $versions;?>">
        <?php
    }?>
    <?php
    if (isset($page) && (in_array($page, ['jobBoard', 'apply&preview', 'job-emp-preview']))) {
        ?>
        <!-- Vendor CSS Files -->
        <!-- <link rel="stylesheet" href="<?php //echo $BaseUrl; ?>/job-board/assets/css/bootstrap.css" />

      <link
        href="<?php //echo $BaseUrl; ?>/job-board/assets/vendor/bootstrap-icons/bootstrap-icons.css"
        rel="stylesheet"
      />
      <link href="<?php //echo $BaseUrl; ?>/job-board/assets/css/font-awesome.css?v=<?php //echo $versions;?>" rel="stylesheet" /> -->

        <!-- Template Main CSS File -->
        <!-- <link href="<?php //echo $BaseUrl; ?>/job-board/assets/css/style_jobboard.css?v=<?php //echo $versions;?>" rel="stylesheet" /> -->

        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/job-board/assets/css/public-job-module.css?v=<?php echo $versions;?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <?php
    } else { ?>
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/job-board/assets/css/public-job-module.css?v=<?php echo $versions;?>">
    <?php } ?>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <!-- <script>
        $(document).ready(function() {
            var $inputFields = $('.input-wrapper input, .input-wrapper textarea, .input-wrapper select');
            var $updateProfileButton = $('#updateprofile');

            $inputFields.on('input', function() {
                $updateProfileButton.attr('data-changed', 'true'); // Equivalent to addAttr
                $updateProfileButton.show();
            });

            $updateProfileButton.hide();

            function cancelForm() {
                $updateProfileButton.removeAttr('data-changed'); // Equivalent to removeAttr
                $updateProfileButton.hide();
            }

            $('#cancel').on('click', cancelForm);
        });
    </script> -->

    <style>
        button:disabled,
        button[disabled]{
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
        button:disabled, button[disabled]{
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
        .body-wrapper{
            max-width:100%;
        }
        <?php if(isset($page) && $page == 'apply&preview') {   ?>
        .add-btn{
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
        .dataTable th,.dataTable td{
            text-align:left !important;
        }
        [name=example_length]{
            margin-right:5px;
        }
        .detail,.question-wrapper,.job,.modal-body,.modal-title,.skills,.cover,.name{
            word-wrap: break-word;
            width: 100%;
        }
        .dt-layout-cell{

        }
        table{
            table-layout: fixed;
            word-wrap: break-word;
        }
        .theme-btn{
            background: #3e1f48;
            border: 0px;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration:none;
        }

        .global_spanner{
            position:fixed;
            top: 50%;
            left: 0;
            background: #2a2a2a;
            width: 100%;
            display:block;
            text-align:center;
            height: 300px;
            color: #FFF;
            transform: translateY(-50%);
            z-index: 9999999;
            visibility: hidden;
        }

        .global_overlay{
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
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

        .show{
            visibility: visible;
        }

        .global_spanner, .global_overlay{
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
    </style>
    <script>
        $(document).ready(function(){
            $("input,select,textarea").change(function(){
                $('#updateprofile').removeAttr('disabled');
            });

            $(document).on('change','input,select,textarea', function(){
                $('#updateprofile').removeAttr('disabled');
            });
        });

        function profilechange(id, link) {
            var btn = this;
            $.post(
                "../api.php?class=Header&action=makeprofiledefault",
                {
                    profileid: id,
                },
                function (r) {
                    if (link == 0) {
                        location.reload();
                    } else {
                        window.location.href = window.location.origin + "/my-profile/";
                    }
                }
            );
        }
    </script>

    <?php if(strpos($_SERVER['REQUEST_URI'],'job-employee') || strpos($_SERVER['REQUEST_URI'],'job-seeker') || strpos($_SERVER['REQUEST_URI'],'job-board')){ ?>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
        <link rel="stylesheet" href="./job-employee.css">
    <?php } ?>
    <?php if(isset($page)&&$page=='profile_search'){ ?>
        <link href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">
    <?php } ?>
    <script src='<?php echo $BaseUrl; ?>/assets/js/custom_validation.js'></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,           // Show the close button
            "debug": false,                // Enable debug mode
            "newestOnTop": true,           // Display the newest toast on top
            "progressBar": true,           // Display a progress bar
            "positionClass": "toast-top-right", // Position of the toast
            "preventDuplicates": true,     // Prevent duplicate messages
            "onclick": null,               // Callback when the toast is clicked
            "showDuration": "300",         // Show duration in ms
            "hideDuration": "1000",        // Hide duration in ms
            "timeOut": "5000",             // Duration before the toast disappears (ms)
            "extendedTimeOut": "1000",     // Time for which the toast is visible after hover (ms)
            "showEasing": "swing",         // Easing for showing toast
            "hideEasing": "linear",        // Easing for hiding toast
            "showMethod": "fadeIn",        // Animation for showing toast
            "hideMethod": "fadeOut"        // Animation for hiding toast
        };
        $(document).ready(function (event) {
            // Attach the submit event handler to the form with class `global_search_form`
            $(".global_search_form").on("submit", function (e) {
                // Get the selected value of the dropdown with ID `global_search_option`
                var selectedOption = $("#global_search_option").val();

                // Define the values that should trigger the redirection
                var redirectValues = ["-p", "1-p", "2-p", "3-p", "4-p", "5-p", "6-p"];

                // Check if the selected option matches any of the redirect values
                if (redirectValues.includes(selectedOption)) {
                    // Prevent the form from submitting
                    e.preventDefault();

                    // Get the value of the input field with ID `global_search_value`
                    var searchTerm = $("#global_search_value").val();

                    // Construct the redirection URL with the search term
                    var redirectUrl = `<?php echo $BaseUrl ?>/profile-search/?term=${encodeURIComponent(searchTerm)}&txtCategory=${encodeURIComponent(selectedOption)}`;

                    // Redirect to the constructed URL
                    window.location.href = redirectUrl;
                }
            });

            $(".search-mobile").click(function(){
                $(".search-box").css('display','block');
                $(".search-box").css('position','absolute');
                $(".search-box").css('width','85%');
                $(".search-box").css('z-index','99');
                $(".global_search_form").css('display','flex');
                $(".global_search_form").css('width','84%');
            });

            $('body').click(function(event) {
                if(event.target.id != "search-mobile-img"){
                    if($("#three-dot-mobile-img").is(":visible")){
                        $('.search-box').hide();
                    }
                }

                if(event.target.id != "three-dot-mobile-img"){
                    if($("#three-dot-mobile-img").is(":visible")){
                        $('.import-links').css('overflow','unset');
                        $('.import-links .hide-mobile').css('display','none');
                    }
                }
            });

            $('.search-box').click(function(event) {
                event.stopPropagation();
            });

            $('#three-dot-mobile').click(function(event) {
                event.stopPropagation();
            });

            // three-dot-mobile-img
            $("#three-dot-mobile").click(function(){
                $('.import-links').css('overflow','overlay');
                $('.import-links .hide-mobile').css('display','block');
            });

        });

        const sideBar = document.getElementById('side-bar');
        function openAndCloseSideBar(){
            if(sideBar.style.transform == 'translateY(-300%)') {
                sideBar.style.transform = 'translateY(0%)'
            } else {
                sideBar.style.transform = 'translateY(-300%)'
            }
        }
        const dotContent = document.getElementById('three-dot')
        function threeDot() {
            if(dotContent.style.display == 'none') {
                dotContent.style.display = 'flex'
            } else {
                dotContent.style.display = 'none'
            }
        }
    </script>
</head>

<body>
<div class="global_overlay"></div>
<div class="global_spanner">
    <div class="global_loader"></div>
    <p>We are working on request, please be patient.</p>
</div>

<div class="body-wrapper">
    <div class="nav-bar">
        <div class="logo-menu">
            <div class="logo-wrapper" id="logo-wrapper">
                <a href="<?php echo (isset($page)&&$page=='timeline' ? $BaseUrl :  $BaseUrl.'/timeline/') ?>">
                    <img src="<?php echo $BaseUrl?>/assets/images/logo.svg" alt="">
                </a>
            </div>

            <?php if(isset($page) && ($page == "timeline" || $page == 'profile_search' || $page == 'connection' || $page == 'jobBoard')) { ?>
                <div class="menu" id="collapse-sidebar">
                    <img src="<?php echo $BaseUrl?>/assets/images/menu-icon-2.svg" alt="">
                </div>
            <?php } ?>
        </div>

        <div class="search-box">
            <form class="search-box global_search_form" method="POST" action="<?php echo $BaseUrl; ?>/search/index.php">
                <div class="select-options" style="width: 150px;">
                    <select class="cate_drop" id='global_search_option' name="txtCategory" onchange="getComboA(this.value)" style="background-color: transparent; border: none; outline: none;">
                        <?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>
                            <optgroup label="Profiles">
                                <option value="-p">All Profiles</option>
                                <?php
                                $rpt = $pt->readProfileTypes();
                                if(isset($rpt['data']) && count($rpt['data']) > 0) {
                                    foreach($rpt['data'] as $row) {
                                        ?>
                                        <option value="<?php echo $row['idspProfileType']; ?>-p" <?php if (isset($categoryvalue)) {
                                            if ($categoryvalue == $row['idspProfileType']) {
                                                echo "selected";
                                            }
                                        } ?>><?php echo $row['spProfileTypeName'] ?></option> <?php
                                    }
                                }?>
                            </optgroup>
                        <?php } ?>
                        <optgroup label="Product">
                            <?php
                            $result = $pt->readCategories();
                            if (isset($result['data']) && count($result['data']) > 0) {
                                foreach ($result['data'] as $rows) {
                                    ?>
                                    <option value="<?php echo $rows['idspCategory']; ?>" <?php if (isset($categoryvaluepro)) {
                                        if ($categoryvaluepro == $rows['idspCategory']) {
                                            echo "selected";
                                        }
                                    } ?>><?php echo $rows['spCategoryName']; ?></option> <?php
                                }
                            }
                            ?>
                        </optgroup>
                    </select>
                </div>

                <div class="search-box-wrapper">
                    <input type="text" placeholder="Search" name="txtSearch" id='global_search_value'>
                    <div class="search-icon">
                        <button type="submit" style="background: transparent; border: none;" id="indent" name="btnSearch">
                            <svg width="13" height="12" viewBox="0 0 13 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.97342 7.70191C4.34676 7.70191 3.73418 7.51609 3.21313 7.16793C2.69208 6.81978 2.28597 6.32494 2.04616 5.74598C1.80635 5.16702 1.7436 4.52995 1.86585 3.91533C1.98811 3.30071 2.28988 2.73615 2.73299 2.29304C3.17611 1.84992 3.74067 1.54816 4.35528 1.4259C4.9699 1.30364 5.60698 1.36639 6.18594 1.6062C6.7649 1.84602 7.25974 2.25212 7.60789 2.77317C7.95604 3.29422 8.14186 3.90681 8.14186 4.53347C8.14413 4.95019 8.06374 5.36322 7.90531 5.74866C7.74689 6.1341 7.51358 6.48429 7.21891 6.77896C6.92424 7.07363 6.57406 7.30693 6.18862 7.46535C5.80318 7.62378 5.39014 7.70418 4.97342 7.70191ZM9.19259 7.70191H8.62998L8.41932 7.49125C8.85347 6.98286 9.17254 6.38658 9.35464 5.74331C9.53675 5.10005 9.57757 4.425 9.47432 3.76448C9.3045 2.80285 8.82985 1.92136 8.1205 1.25025C7.41115 0.579146 6.50473 0.154022 5.53518 0.0376972C4.34755 -0.115397 3.14708 0.201518 2.18977 0.920867C1.23246 1.64022 0.594051 2.70508 0.410642 3.88841C0.227234 5.07174 0.513345 6.27991 1.20798 7.2553C1.90262 8.23069 2.95082 8.89613 4.12907 9.10973C4.7896 9.21298 5.46465 9.17215 6.10792 8.99005C6.75119 8.80795 7.34745 8.48888 7.85584 8.05472L8.0665 8.26538V8.828L11.02 11.7815C11.0893 11.8508 11.1715 11.9057 11.262 11.9432C11.3525 11.9807 11.4495 12 11.5475 12C11.6455 12 11.7425 11.9807 11.833 11.9432C11.9235 11.9057 12.0057 11.8508 12.075 11.7815C12.1443 11.7122 12.1992 11.63 12.2367 11.5395C12.2742 11.449 12.2935 11.352 12.2935 11.254C12.2935 11.156 12.2742 11.059 12.2367 10.9685C12.1992 10.878 12.1443 10.7958 12.075 10.7265L9.19259 7.70191Z" fill="#1F1216"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="import-links">
            <div class="search-mobile link">
                <img id="search-mobile-img" src="<?php echo $BaseUrl?>/assets/images/search-2.svg" alt="">
            </div>
            <a href="<?php echo $BaseUrl?>/my-friend/" class="hide-mobile">
                <div class="hand-shake link">
                    <img src="<?php echo $BaseUrl?>/assets/images/hand-shake.svg" alt="">
                </div>
            </a>
            <a href="<?php echo $BaseUrl?>/inbox.php?msg=inbox_msg" class="hide-mobile">
                <div class="persons link">
                    <img src="<?php echo $BaseUrl?>/assets/images/person-2.svg" alt="">
                    <div class="count">
                        <?php
                        $unreadMessageCount = 0;
                        if (isset($_SESSION["pid"])) {
                            $unreadMessage = $pt->unreadMessage($_SESSION["pid"]);
                        }
                        if(isset($unreadMessage['data']) && isset($unreadMessage['data']['unread_count'])){
                            $unreadMessageCount = $unreadMessage['data']['unread_count'];
                        }
                        echo $unreadMessageCount;
                        ?>
                    </div>
                </div>
            </a>
            <a href="" class="hide-mobile">
                <div class="help link">
                    <img src="<?php echo $BaseUrl?>/assets/images/help.svg" alt="">
                </div>
            </a>
            <a href="<?php echo $BaseUrl?>/enquiry/notification.php" class="hide-mobile">
                <div class="notification link">
                    <img src="<?php echo $BaseUrl?>/assets/images/notification.svg" alt="">
                    <div class="count">
                        <?php
                        $unreadNotiCount = 0;
                        if (isset($_SESSION["uid"])) {
                            $unreadNoti = $pt->unreadNotification($_SESSION["uid"]);
                        }
                        if(isset($unreadNoti['data']) && isset($unreadNoti['data']['unread_count'])){
                            $unreadNotiCount = $unreadNoti['data']['unread_count'];
                        }
                        echo $unreadNotiCount;
                        ?>
                    </div>
                </div>
            </a>
            <a href="<?php echo $BaseUrl?>/cart/" class="hide-mobile">
                <div class="cart link">
                    <img src="<?php echo $BaseUrl?>/assets/images/cart.svg" alt="">
                </div>
            </a>
            <div class="dropdown setting link hide-mobile">
                <img src="<?php echo $BaseUrl?>/assets/images/setting.svg" alt="" id="dropdown-toggle">
                <ul class="dropdown-menu setting_left" id="dropdown-content" style="z-index: 999; min-width: 200px;margin-left: -44px;top: calc(100%);">
                    <?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>
                        <li><a href='<?php echo $BaseUrl; ?>/public_rfq/?condition=All&folder=rfq&page=1' id='rfq'><span class="fa fa-file setting-link"></span> Manage RFQ</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/my-groups/"><span class="fa fa-users setting-link"></span> My Groups</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/my-profile/"><span class="fa fa-user setting-link"></span> My Profiles</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/my-friend/"><span class="fa fa-handshake setting-link"></span> My Friends</a></li>
                        <li><a data-toggle="modal" class="pointer" data-target="#inviteFriend"><span class="fa fa-user setting-link"></span> Invite Friends</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/membership/"><span class="fa fa-credit-card setting-link"></span> Subscription</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/dashboard/settings/"><span class="fa fa-cog setting-link"></span> Master Dashboard</a></li>
                    <?php } ?>
                    <li><a href="<?php echo $BaseUrl; ?>/authentication/logout.php" data-toggle="tooltip" data-placement="bottom" title="Logout"><span class="fa fa-sign-out-alt setting-link"></span> Logout</a></li>
                </ul>
            </div>

            <div id="three-dot-mobile" class="three-dot link">
                <img id="three-dot-mobile-img" src="<?php echo $BaseUrl?>/assets/images/three-dot.svg" alt="">
            </div>
            <div class="line"></div>
            <div class="perfile-detail">
                <?php
                if (isset($_SESSION["uid"])) {
                    $profiles = $pt->readProfiles($_SESSION["uid"]);
                }
                if(isset($profiles['data']) && count($profiles['data']) > 0){
                foreach($profiles['data'] as $pro){
                if($_SESSION['pid'] == $pro['idspProfiles']) {
                ?>
                <div class="profile-item">
                    <div class="img-wrapper">
                        <div class="circle">
                            <img src="<?php if(isset($pro['spProfilePic'])) { echo $pro['spProfilePic'];} else { echo $BaseUrl."/assets/images/icon/blank-img.png"; } ?>" alt="">
                        </div>
                    </div>
                    <div class="profile-detail-wrapper">
                        <div class="name"><?php echo $pro['spProfileName']; ?></div>
                        <div class="title"><?php echo $pro['spProfileTypeName'] . " Profile"; ?></div>
                    </div>
                    <div id="profiledrop-down" class="down-icon" onclick="toggleDropdown(this)">
                        <img src="<?php echo $BaseUrl?>/assets/images/down-arrow-2.svg" alt="">
                    </div>
                    <ul class="dropdown-menu">
                        <?php
                        if(isset($profiles['data']) && count($profiles['data']) > 0){
                            foreach($profiles['data'] as $pro){
                                ?>
                                <li class="<?php echo ($_SESSION['pid'] == $pro['idspProfiles']) ? 'active' : ''; ?>">
                                    <a href="javascript:;void(0);" class="dropdown-item d-flex align-items-center headProfile" onclick="profilechange(<?php echo $pro['idspProfiles']; ?>, 0)">
                                        <div class="pro_img_pic" style="width:40px;">
                                            <?php
                                            if ($pro["spProfilePic"] == '') {
                                                ?>
                                                <img src="<?php echo $BaseUrl . '/img/noman.png' ?>" alt="" class="img-fluid"  style="width: 100%; height: 100%;">
                                                <?php
                                            } else {
                                                ?>
                                                <img src="<?php echo $pro["spProfilePic"]; ?>" class="img-fluid"  style="width: 100%; height: 100%;">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="pro_cnt">
                                            <span class="profile-name"><?php echo ucwords(substr($pro['spProfileName'], 0, 15)); ?></span>
                                            <p class="m-0 text-muted">
                                                <?php if (isset($_SESSION['guet_yes']) && $_SESSION['guet_yes'] == 'yes') {
                                                    echo "Guest Profile";
                                                } else {
                                                    echo $pro['spProfileTypeName'] . " Profile";
                                                } ?>
                                            </p>
                                        </div>
                                    </a>
                                    <hr class="m-0">
                                </li>
                                <?php
                            }
                        }
                        ?>
                        <li class="text-center" style="margin-top: 3px;background-color: orange;">
                            <a href="<?php echo $BaseUrl . '/my-profile'; ?>" style="color: black;text-decoration: none;">Add/Edit Profiles</a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
            }
            }
            }
            ?>
        </div>
    </div>

    <div class="group-wrapper">
        <?php
        if(isset($page)){
        if ($page == "subscription") { ?>
        <div id="loader" style="display: none;">
            <img src="<?php echo $BaseUrl?>/assets/images/loading.gif" alt="Loader">
        </div>
        <section class="container-fluid mt-3">
            <div class="row">
                <div class="col-xl-2 col-lg-6 col-md-12 col-12  order-xl-1 order-lg-1 order-1">
                    <?php } if(isset($page) && (in_array($page, ['timeline','subscription','profilehomepage','publicview','connection','profile_search']))){
                    if($page == 'profilehomepage'|| $page == 'publicview'){  ?>
                    <div class="profile-wrapper">
                        <?php }
                        include_once("../views/common/leftside-bar.php");
                        } else if(isset($page) && (in_array($page,['profilepage','neweditprofile']))) {  ?>
                        <div class="profile-wrapper">
                            <?php include_once("../views/common/create-profile-leftside-bar.php");
                            }
                            }
                            ?>

