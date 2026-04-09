<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "business-directory/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $header_directy = "header_directy";
    $page = "searchPage";
    if (isset($_POST['btnSearch'])) {
        # code...
    } else {
        $re = new _redirect;
        $redirctUrl = "../business-directory";
    }
?>
    <?php 
    include_once("../views/common/header.php");
    ?>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/custom.css">
        <style>
            .common_btn, .detail_btn a{
                border-radius: 75px;
                background-color: #FB8308 !important;
                color: white !important;
                border: none !important;
            }
            .common_btn:hover{
                background-color: #FB8308 !important;
            }
        </style>
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
        <link href="<?php echo $BaseUrl; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- this script for slider art -->
    
        <script type="text/javascript">
            function geocodeAddress(geocoder, resultsMap, address) {
                //alert(address);
                geocoder.geocode({
                    'address': address
                }, function(results, status) {
                    if (status === 'OK') {
                        resultsMap.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: resultsMap,
                            position: results[0].geometry.location
                        });
                    } else {
                        //alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
        </script>

        <section>
            <div class="row no-margin">
                <div class="col-md-3 no-padding">
                    <?php
                    include('../component/left-business.php');
                    ?>
                </div>
                <div class="col-md-9 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="fulmainarttab">
                                    <ul class='nav nav-tabs' id='navtabVdo'>
                                        <li class="btn"><a href="<?php echo $BaseUrl . '/business-directory-services/?category=A'; ?>" class="btn common_btn">Home</a></li>
                                        <li class="btn"><a href="<?php echo $BaseUrl . '/business-directory/dashboard.php'; ?>" class="btn common_btn">DashBoard</a>
                                        </li>
                                    </ul>
                                    <div class="linebtm"></div>
                                </div>
                            </div>
                            <div class="col-md-12 no-padding">
                                <div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active" id="video1">
                                        <div class="row">
                                            <div class="col-md-12 topVdoBread">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="<?php echo $BaseUrl . '/business-directory-services/?category=A'; ?>"><i class="fa fa-home"></i></a></li>                                                       
                                                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                                                    </ol>
                                                </nav>
                                            </div>
                                        </div>
                                        <?php include('search-form.php'); ?>
                                        <?php if (!empty($_POST['txtSearchBox'])) { ?>
                                            <div class="bg_white" style="padding: 20px;">
                                                <p>Search results For "<strong><?php echo $_POST['txtSearchBox']; ?></strong>" </p>
                                            </div>
                                        <?php  } ?>


                                        <div class="bg_white" style="padding: 20px;">
                                            <div class="row ">
                                                <?php
                                                $p = new _spprofiles;
                                                $txtSearchBox = $_POST['txtSearchBox'] ?? "";
                                                if (isset($_POST['txtForm']) && $_POST['txtForm'] == 1) {
                                                    $res = $p->searchByCmpnyName($txtSearchBox);
                                                } else {
                                                    $res = $p->searchByProfileName($txtSearchBox);
                                                }
                                                $googleMap = [];
                                                if (isset($_POST['txtForm']) && $_POST['txtForm'] == 1) {
                                                    include('search-business.php');
                                                } else if (isset($_POST['txtForm']) && $_POST['txtForm'] == 2) {
                                                    include('search-profile.php');
                                                }else{
                                                    echo "<h3 style='text-align: center;'>Please enter search keyword to search company business.</h3>";
                                                }
                                                ?>
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
        <div class="space-lg"></div>
        </div>
        <?php
        include('postshare.php');
        include('../views/common/footer.php');
        include('../component/f_btm_script.php');
        ?>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                if (
                    document.getElementById("dropdown-toggle") &&
                    document.getElementById("dropdown-content")
                ) {
                    var dropdownToggle = document.getElementById("dropdown-toggle");
                    var dropdownContent = document.getElementById("dropdown-content");

                    dropdownToggle.addEventListener("click", function (event) {
                    event.preventDefault();
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                    });
                }
                window.addEventListener("click", function (event) {
                    if (
                    !event.target.matches("#dropdown-toggle") &&
                    !event.target.matches("#dropdown-content")
                    ) {
                    dropdownContent.style.display = "none";
                    }
                    if (
                    !event.target.closest("#profiledrop-down") &&
                    !event.target.closest(".dropdown-menu")
                    ) {
                    var profileDropdown = document.getElementById("profiledrop-down");
                    var dropdownMenu = profileDropdown
                        .closest(".profile-item")
                        .querySelector(".dropdown-menu");
                    if (dropdownMenu.classList.contains("show")) {
                        dropdownMenu.classList.toggle("show");
                    }
                    }
                    if (!event.target.matches(".dropbtn")) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains("whr-drop-hide")) {
                        openDropdown.classList.remove("whr-drop-hide");
                        }
                    }
                    }
                });
                if (document.getElementById("collapse-sidebar")) {
                    var sidebar = document.getElementById("side-bar");
                    var collapseButton = document.getElementById("collapse-sidebar");
                    collapseButton.addEventListener("click", function () {
                    if (sidebar.style.transform === "translateY(-150%)") {
                        sideBarOpen(); // Open sidebar if closed
                    } else {
                        sideBarClose(); // Close sidebar if open
                    }
                    });
                }
            });
            
            function addfav_heart(a, b) {
                var idspProfiles_spProfileCompany = a;
                var spProfiles_idspProfiles = b;
                var isfavourite = "1";
                $.post("../social/addfavdir.php", {
                idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
                spProfiles_idspProfiles: spProfiles_idspProfiles,
                isfavourite: isfavourite
                }, function(response) {

                $('#favourite_heart' + idspProfiles_spProfileCompany).html('<span onclick="removfav_heart(' + idspProfiles_spProfileCompany + ',' + spProfiles_idspProfiles + ')" ><a href="javascript:void(0)"  class="removeToProfileFav' + idspProfiles_spProfileCompany + '" data-favourite="1" data-company="' + idspProfiles_spProfileCompany + '" data-pid="' + spProfiles_idspProfiles + '"><span id="addtofavouriteeve"><i class="fa fa-heart"></i></span></a></span>');
                });

            }

            function removfav_heart(a, b) {

                var idspProfiles_spProfileCompany = a;
                var spProfiles_idspProfiles = b;
                var isfavourite = "1";
                $.post("../social/remfavdir.php", {
                idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
                spProfiles_idspProfiles: spProfiles_idspProfiles,
                isfavourite: isfavourite
                }, function(response) {

                $('#favourite_heart' + idspProfiles_spProfileCompany).html('<span onclick="addfav_heart(' + idspProfiles_spProfileCompany + ',' + spProfiles_idspProfiles + ')" ><a href="javascript:void(0)"  class="addToProfileFav' + idspProfiles_spProfileCompany + '" data-favourite="1" data-company="' + idspProfiles_spProfileCompany + '" data-pid="' + spProfiles_idspProfiles + '"><span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span></a></span>');
                });

            }

            function add_star(a, b) {

                var idspProfiles_spProfileCompany = a;
                var spProfiles_idspProfiles = b;
                var isfavourite = "2";
                $.post("../social/addfavdir.php", {
                idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
                spProfiles_idspProfiles: spProfiles_idspProfiles,
                isfavourite: isfavourite
                }, function(response) {

                $('#star_Resorc' + idspProfiles_spProfileCompany).html('<span onclick="remov_star(' + idspProfiles_spProfileCompany + ',' + spProfiles_idspProfiles + ')" ><a href="javascript:void(0)"  class="removeToResorc' + idspProfiles_spProfileCompany + '" data-favourite="1" data-company="' + idspProfiles_spProfileCompany + '" data-pid="' + spProfiles_idspProfiles + '"><span id="addtofavouriteeve"><i class="fa fa-star "></span></a></span>');
                });

            }

            function remov_star(a, b) {

                var idspProfiles_spProfileCompany = a;
                var spProfiles_idspProfiles = b;
                var isfavourite = "2";
                $.post("../social/remfavdir.php", {
                idspProfiles_spProfileCompany: idspProfiles_spProfileCompany,
                spProfiles_idspProfiles: spProfiles_idspProfiles,
                isfavourite: isfavourite
                }, function(response) {

                $('#star_Resorc' + idspProfiles_spProfileCompany).html('<span onclick="add_star(' + idspProfiles_spProfileCompany + ',' + spProfiles_idspProfiles + ')" ><a href="javascript:void(0)"  class="addtoResorc' + idspProfiles_spProfileCompany + '" data-favourite="1" data-company="' + idspProfiles_spProfileCompany + '" data-pid="' + spProfiles_idspProfiles + '"><span id="addtofavouriteeve"><i class="fa fa-star-o"></i></span></a></span>');
                });

            }
        </script>

        <!-- notification js -->
        <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initMap"></script>
<?php
} ?>