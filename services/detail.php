<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "services/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader"); 

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    
    $postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;



    if ($postid > 0) {
        $p = new _classified;
        $pf  = new _postfield;

        $result = $p->singletimelines($postid);
//echo $p->ta->sql;
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
//echo "<pre>"; print_r($row);die('+++++');

            $ProTitle   = $row['spPostingTitle'];
            $ProCat   = $row['spPostSerComty'];
            $skill   = $row['skill'];
            $ProDes     = $row['spPostingNotes'];
/* $ArtistName = $row['spProfileName'];
$ArtistId   = $row['spProfiles_idspProfiles'];
$ArtistAbout= $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];*/
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city       = $row['spPostingsCity'];
$state       = $row['spPostingsState'];

/*  $UserEmail  = $row['spProfileEmail'];
$UserPhone  = $row['spProfilePhone'];*/

$category = $row['servicecategory'];

$countryAdd    = $row['spPostCountry'];
$state1 = $row['spPostState'];
$cityAdd = $row['spPostCity'];
$dt = new DateTime($row['spPostingDate']);
$dtime = $row['spPostingDate'];
$PostingDate = $dt->format('d-m-Y');
$postalCod = $row['spPostPostalCode'];
$isPhoneShow = $row['spPostShowPhone'];
$isEmailShow = $row['spPostShowEmail'];
$pro = new  _spprofiles;
$resultpro = $pro->read($row['spProfiles_idspProfiles']);

$rowsp = mysqli_fetch_assoc($resultpro);

$ArtistName = $rowsp['spProfileName'];
$ArtistId   = $row['spProfiles_idspProfiles'];
$ArtistAbout = $rowsp['spProfileAbout'];
$ArtistPic  = $rowsp['spProfilePic'];
$UserEmail  = $rowsp['spProfileEmail'];
$UserPhone  = $rowsp['spProfilePhone'];

/* print_r($rowsp);*/

//posting fields
/*          $result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$category = "";

$countryAdd    = "";
$state = "";
$cityAdd = "";
$postalCod = "";
$isPhoneShow = "";
$isEmailShow = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if($category == ''){
if($row2['spPostFieldName'] == 'servicecategory_'){
$category = $row2['spPostFieldValue'];
}
}
if($state == ''){
if($row2['spPostFieldName'] == 'spPostState_'){
$state = $row2['spPostFieldValue'];
}
}
if($countryAdd == ''){
if($row2['spPostFieldName'] == 'spPostCountry_'){
$countryAdd = $row2['spPostFieldValue'];
}
}
if($cityAdd == ''){
if($row2['spPostFieldName'] == 'spPostCity_'){
$cityAdd = $row2['spPostFieldValue'];
}
}
if($postalCod == ''){
if($row2['spPostFieldName'] == 'spPostPostalCode_'){
$postalCod = $row2['spPostFieldValue'];
}
}
if($isPhoneShow == ''){
if($row2['spPostFieldName'] == 'spPostShowPhone_'){
$isPhoneShow = $row2['spPostFieldValue'];
}
}
if($isEmailShow == ''){
if($row2['spPostFieldName'] == 'spPostShowEmail_'){
$isEmailShow = $row2['spPostFieldValue'];
}
}
}
}*/
}

//rating
$r = new _sppostrating;
$res = $r->read($_SESSION["pid"], $postid);
if ($res != false) {
    $rows = mysqli_fetch_assoc($res);
    $rat = $rows["spPostRating"];
} else {
    $rat = 0;
}

$result = $r->review($postid);
if ($result != false) {
    $total = 0;
    $count = $result->num_rows;
    while ($rows = mysqli_fetch_assoc($result)) {
        $total += $rows["spPostRating"];
    }
    $ratings = $total / $count;
} else {
    $ratings = 0;
}
} else {
    $re = new _redirect;
    $redirctUrl = "../services";
    $re->redirect($redirctUrl);
}

$st  = new _state;
$c   = new _country;
$ci  = new _city;
// provision name
$result2 = $st->readStateName($state);
//echo $st->ta->sql;
if ($result2 != false) {
    $row2 = mysqli_fetch_assoc($result2);
    $stateTitle = $row2['state_title'];
} else {
    $stateTitle = "";
}
// county name
$result3 = $c->readCountryName($country);
//echo $c->ta->sql;
if ($result3 != false) {
    $row3 = mysqli_fetch_assoc($result3);
    $countryTitle = $row3['country_title'];
} else {
    $countryTitle = "";
}
// city name
$result4 = $ci->readCityName($city);
//echo $ci->ta->sql;
if ($result4 != false) {
    $row4 = mysqli_fetch_assoc($result4);
    $cityTitle = $row4['city_title'];
} else {
    $cityTitle = "";
}

?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <?php include('../component/f_links.php'); ?>
    <link href="<?php echo $BaseUrl; ?>/assets/zoom/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <script src="<?php echo $BaseUrl; ?>/assets/zoom/lib/blowup.js"></script>
</head>
<style>
    ::marker {
        color: white !important;

    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

/* The Modal (background) */
.modal2 {
    display: none;
/* Hidden by default */
position: fixed;
/* Stay in place */
z-index: 1;
/* Sit on top */
padding-top: 100px;
/* Location of the box */
left: 0;
top: 0;
width: 100%;
/* Full width */
height: 100%;
/* Full height */
overflow: auto;
/* Enable scroll if needed */
background-color: rgb(0, 0, 0);
/* Fallback color */
background-color: rgba(0, 0, 0, 0.9);
/* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content2 {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

.active_car {
    border: 3px solid #09a4ae !important;
}

/* Add Animation */
.modal-content2,
#caption {
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {
        -webkit-transform: scale(0)
    }

    to {
        -webkit-transform: scale(1)
    }
}

@keyframes zoom {
    from {
        transform: scale(0)
    }

    to {
        transform: scale(1)
    }
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #FFFFFF;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #FFFFFF;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px) {
    .modal-content2 {
        width: 100%;
    }
}

#targett {
    target: none;
    height: opx;
}

.hide-bullets {
    list-style: none;
    margin-top: 300px;
    padding: 0;
}

div#carousel-bounding-box {
    height: 4px;
}

.img-responsive {
    margin-top: 0px !important;
}

.txt {
    resize: none;
}

.f_txt {
    resize: none;
}

.btn_fb {
    background-color: #3b5999;
    font-size: 20px;
    color: white;
    padding: 7px 12px;
    border-radius: 8px;
}

.btn_fb:hover {
    color: white;
    background-color: #6178ab;
}

.btn_google {
    background-color: #3b5999;
    font-size: 20px;
    color: white;
    padding: 7px 12px;
    border-radius: 8px;
}

.btn_tweet {
    background-color: #55acee;
    font-size: 20px;
    color: white;
    padding: 7px 2px 7px 9px;
    border-radius: 8px;
}

.btn_tweet:hover {
    color: white;
    background-color: #6178ab;
}

.btn_linkdin {
    background-color: #3b5999;
    font-size: 20px;
    color: white;
    padding: 7px 4px 7px 10px;
    border-radius: 8px;
    margin: 5px;
}

.btn_linkdin:hover {
    color: white;
    background-color: #6178ab;
}

.btn_whatsapp {
    background-color: #0f8f46;
    font-size: 20px;
    color: white;
    padding: 7px 12px;
    border-radius: 8px;
}

.btn_whatsapp:hover {
    color: white;
    background-color: #35b96e;
}

.mt_d {
    margin-top: 10px;
}
</style>


<!-- //////////////////////////////////////////////------------------slider  cssss-->
<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,600,700);
/** /!!! core css Should not edit !!!/**/


.csSlideOuter {
    overflow: hidden;
}

.lightSlider:before,
.lightSlider:after {
    content: " ";
    display: table;
}

.csSlideWrapper>.lightSlider:after {
    clear: both;
}

.csSlideWrapper .csSlide {
    -webkit-transform: translate(0px, 0px);
    -ms-transform: translate(0px, 0px);
    transform: translate(0px, 0px);
    -webkit-transition: all 1s;
    transition: all 1s;
    -webkit-transition-duration: inherit;
    transition-duration: inherit;
    -webkit-transition-timing-function: inherit;
    transition-timing-function: inherit;
}

.csSlideWrapper .csFade {
    position: relative;
}

.csSlideWrapper .csFade>* {
    position: absolute !important;
    top: 0;
    left: 0;
    z-index: 9;
    margin-right: 0;
    width: 100%;
}

.csSlideWrapper.usingCss .csFade>* {
    opacity: 0;
    -webkit-transition-delay: 0s;
    transition-delay: 0s;
    -webkit-transition-duration: inherit;
    transition-duration: inherit;
    -webkit-transition-property: opacity;
    transition-property: opacity;
    -webkit-transition-timing-function: inherit;
    transition-timing-function: inherit;
}

.csSlideWrapper .csFade>*.active {
    z-index: 10;
}

.csSlideWrapper.usingCss .csFade>*.active {
    opacity: 1;
}

/** /!!! End of core css Should not edit !!!/**/

/* Pager */
.csSlideOuter .csPager.cSpg {
    margin: 10px 0 0;
    padding: 0;
    text-align: center;
}

.csSlideOuter .csPager.cSpg>li {
    cursor: pointer;
    display: inline-block;
    padding: 0 5px;
    list-style-type: none;
}

.csSlideOuter .csPager.cSpg>li a {
    background-color: #222222;
    border-radius: 30px;
    display: inline-block;
    height: 8px;
    overflow: hidden;
    text-indent: -999em;
    width: 8px;
    position: relative;
    z-index: 99;
    -webkit-transition: all 0.5s linear 0s;
    transition: all 0.5s linear 0s;
}

.csSlideOuter .csPager.cSpg>li:hover a,
.csSlideOuter .csPager.cSpg>li.active a {
    background-color: #428bca;
}

.csSlideOuter .media {
    opacity: 0.8;
}

.csSlideOuter .media.active {
    opacity: 1;
}

/* End of pager */

/** Gallery */
.csSlideOuter .csPager.cSGallery {
    list-style: none outside none;
    padding-left: 0;
    margin: 0;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.csSlideOuter .csPager.cSGallery li {
    opacity: 0.7;
    -webkit-transition: opacity 0.35s linear 0s;
    transition: opacity 0.35s linear 0s;
}

.csSlideOuter .csPager.cSGallery li.active,
.csSlideOuter .csPager.cSGallery li:hover {
    opacity: 1;
}

.csSlideOuter .csPager.cSGallery img {
    display: block;
    height: auto;
    max-width: 100%;
}

.csSlideOuter .csPager.cSGallery:before,
.csSlideOuter .csPager.cSGallery:after {
    content: " ";
    display: table;
}

.csSlideOuter .csPager.cSGallery:after {
    clear: both;
}

/* End of Gallery*/

/* slider actions */
.csAction>a {
    width: 32px;
    display: block;
    top: 50%;
    height: 32px;
/* background-image: url('../img/controls.png');*/
cursor: pointer;
position: absolute;
z-index: 99;
margin-top: -16px;
opacity: 0.5;
-webkit-transition: opacity 0.35s linear 0s;
transition: opacity 0.35s linear 0s;
}

.csAction>a:hover {
    opacity: 1;
}

.csAction>.csPrev {
    left: 10px;
    font-size: 30px;
    color: #FFF;
    background: #000;
    text-align: center;

}

.csAction>.csNext {
    font-size: 30px;
    color: #FFF;
    background: #000;
    text-align: center;
    right: 10px;
}

.cS-hidden {
    height: 1px;
    opacity: 0;
    filter: alpha(opacity=0);
    overflow: hidden;
}

ul {

    list-style-type: none;
}

.center {
    max-width: 650px;
    width: 100%;
    margin: auto;
    display: block;
    margin-top: 1rem;
    ;
}

h1 {
    color: #fff;
    font-size: 38px;
    font-family: raleway;
    text-transform: uppercase;
    font-weight: 800;
    font-size: 29px;
    text-shadow: 3px 3px rgba(0, 0, 0, 0.25);
}

#lightSlider {
    padding: 0;
    margin: 0 0 9px 0;
}
</style>

<body class="bg_gray">
    <?php
    include_once("../header.php");
    ?>
    <?php if ($_SESSION['share_msg'] == 2) {

        unset($_SESSION['share_msg']);
        ?>
        <span id="pop_msg">
            <div class="alert alert-success" style="background:#3da133">
                <span style="color:white"><strong>Shared Successfully !</strong> </span>
            </div>
        </span>



        <script>
            setTimeout(function() {
                $('#pop_msg').html("");

            }, 2000);
        </script>
    <?php } ?>

    <?php include('postshare.php'); ?>
    <section>
        <div class="row no-margin">
<!-- <div class="col-md-2 no-padding">
<?php include('../component/left-services.php'); ?> 
</div> -->
<div class="col-sm-12 no-padding">
    <div class="head_right_enter">
        <div class="row no-margin">



            <!-- <?php include('servicemodule.php'); ?> --> 
            <?php
            $post_name = new _classified;
            $result1 = $post_name->singletimelines($postid);
            if ($result1 != false) {
                $row2 = mysqli_fetch_assoc($result1); ?>
                <div class="col-sm-12  dashboard-section " style="background-color: #fff; border: 1px solid #ccc;margin-bottom: 10px;border-radius: 5px;width: 97%;margin-top: 22px;margin: 20px 8px 20px 13px;">

                    <h3 style="margin-top: 10px!important;">Classified Ads - <strong><?php echo $row2['spPostSelection'] ?></strong>

                        <a href="<?php echo $BaseUrl . '/services/dashboard'; ?>" class="pull-right" style="font-size:20px">&nbsp;DASHBOARD&nbsp;</a>
                        <a href="<?php echo $BaseUrl . '/services'; ?>" class="pull-right" style="font-size:20px">&nbsp;HOME&nbsp;/</a>

                    </h3>




                </div>
            <?php } ?>


            <div class="col-sm-12">
                <?php
                if (isset($_SESSION['err']) && $_SESSION['count'] == 0) { ?>
                    <p class="alert alert-success error_show" style="background-color: #00a65a !important;color:#FFF!important;"><?php echo $_SESSION['err']; ?></p><?php
                    $_SESSION['count']++;
                    unset($_SESSION['err']);
                }
                ?>
            </div>
            <div class="tab-content no-radius otherTimleineBody" style="padding: 20px 20px;">



                <!--PopularArt-->
                <div role="tabpanel" class="tab-pane active" id="video1">
                    <div class="artistDetail">

                        <div class="">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="bg_white ArtistSong leftServ">
                                        <!-- <h4><a href="<?php echo $BaseUrl . '/services'; ?>" class=""><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back to Home </a></h4>-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3><strong style=""><?php echo ucwords($ProTitle); ?> </strong>
                                                    <?php if ($cityTitle != '' && $stateTitle != '') { ?>
                                                        <small>(<?php echo $cityTitle . ', ' . $stateTitle; ?>)</small>
                                                    <?php } ?>
                                                </h3>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="row reviewdetail social socialicon ">
                                                    <?php if ($ArtistId != $_SESSION['pid']) { ?>
                                                        <div class="col-md-1 classified">

                                                            <?php
                                                            $fv = new _favorites;
                                                            $res_fv = "";
                                                //$res_fv = $fv->chekFavourite($postid, $_SESSION['pid'], $_SESSION['uid']);
                                                //echo $fv->ta->sql;
                                                            if ($res_fv != false) { ?>
                                                                <a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $postid; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
                                                                    <span id="removetofavouriteeve"><i class="fa fa-heart"></i></span>
                                                                    </a><?php
                                                        //echo '<li><a data-postid="'. $postid.'" class="remtofavorites"><img src="'.$BaseUrl.'/assets/images/icon/store/favourite.png"><span id="remtofavorites"> Unfavourite</span></a></li>';
                                                                } else {
                                                                    ?>
                                                                    <a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $postid; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
                                                                        <span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
                                                                    </a>
                                                                    <?php
                                                                }

                                                                $pc = new _classifiedpic;
                                                                $res = $pc->readall($postid);

                                                                $active1 = 0;
                                                                if ($res != false) {
                                                                    $postr = mysqli_fetch_assoc($res);
                                                                    $pictp = $postr['spPostingPic'];
                                                                }


                                                                ?>

                                                            </div>

                                                        <?php } ?>

                                                        <div class="col-md-6" >
                                                            <a href="javascrpit:void(0)" data-toggle='modal' data-target='#myshare' class="shareimgicon">
                                                                <span class='sp-share-art'  style="margin-right:30px;" data-postid='<?php echo $postid; ?>' src='<?php echo ($pictp); ?>'>
                                                                    <i class="fa fa-share-alt" ></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">

                                                    <div style="float:right">
                                                        <?php
                                        // $diff = strtotime(date("d-m-Y")) - strtotime($PostingDate);
                                                        echo "Posted on <br>" . $dtime;
                                        //echo "Posted ".abs(round($diff / 86400))." Days Ago";
                                        //echo "<br>";
                                        //echo "on ".$PostingDate; 
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="margin-bottom:-7px">
                                                    <p><span><strong></strong> </span><?= $ProCat; ?> /
                                                        <?php echo ucwords($ProTitle); ?></p>
                                                        <p><span><strong></strong> </span></ /?=$ProCat; ?>
                                                        </p>
                                                    </div>
                                                    <?php
                                                    $pc = new _classifiedpic;
                                                    $res = $pc->readall($postid);  ?>

                                                    <div class="col-md-7">
                                                        <div class="center">

                                                            <ul id="lightSlider">

                                                                <?php
                                                                if ($res != false) {
                                                                    while ($postr = mysqli_fetch_assoc($res)) {
                                                                        $picture = $postr['spPostingPic'];
                                                                        ?>



                                                                        <li data-thumb="<?= $picture; ?>" style="">
                                                                            <img src="<?= $picture; ?>" style="width: 440px;height:400px" />
                                                                        </li>

                                                                        <?php

                                                                    }
                                                                }
                                                                ?>






                                                            </ul>

                                                        </div>

                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $(".img_zoom_<?php echo $active2; ?>_b").blowup();
                                                        });
                                                    </script>
                                                    <script>
                                    // Get the modal
                                                        var modal = document.getElementById("myModal<?php echo $active2; ?>");

                                    // Get the image and insert it inside the modal - use its "alt" text as a caption
                                                        var img = document.getElementById("myImg_<?php echo $active2; ?>");
                                    //img.removeClass("img_zoom_");
                                                        var modalImg = document.getElementById("img01<?php echo $active2; ?>");
                                                        var captionText = document.getElementById("caption<?php echo $active2; ?>");
                                                        img.onclick = function() {
                                                            modal.style.display = "block";
                                                            modalImg.src = this.src;
                                                            captionText.innerHTML = this.alt;
                                                        }

                                    // Get the <span> element that closes the modal
                                    //var span = document.getElementsByClassName("close")[0];

                                    // When the user clicks on <span> (x), close the modal
                                    //span.onclick = function() { 
                                                        $("#close<?php echo $active2; ?>").click(function() {
                                                            $("#myModal<?php echo $active2; ?>").css("display", "none");
                                        //modal.style.display = "none";
                                        //}
                                                        });
                                                    </script>
                                                    <div class="col-md-5">
                                                        <div class="table-responsive">

                                                            <script>
                                                                function initMap() {
                                                                    var map = new google.maps.Map(document.getElementById('map'), {
                                                                        zoom: 5,
                                                                        center: {
                                                                            lat: -34.397,
                                                                            lng: 150.644
                                                                        }
                                                                    });
                                                                    var geocoder = new google.maps.Geocoder();
                                                                    geocodeAddress(geocoder, map);
                                                                }

                                                                function geocodeAddress(geocoder, resultsMap) {
                                                                    var address = "<?php echo $cityTitle . ' ' . $countryTitle; ?>";
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
                                                            <table class="table table-striped table-bordered">
                                                                <tbody>

                                                                    <tr>

                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Postal Code</strong></td>
                                                                        <td><?php echo $postalCod; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Country</strong></td>
                                                                        <td><?php echo $countryTitle; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>State</strong></td>
                                                                        <td><?php echo $stateTitle; ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>City</strong></td>
                                                                        <td><?php echo $cityTitle; ?></td>
                                                                    </tr>



                                                                </tbody>

                                                            </table>
                                                        </div>


                                                        <h3 style="margin-top:10px">HIGHLIGHTS OF SERVICES</h3>
                                                        <ul>
                                                            <?php
                                                            $data1 = explode(",", $skill);
                                                            foreach ($data1 as $data) {
                                                                echo "<li>" . $data . "</li>";
                                                            } ?>
                                                        </ul>
                                                    </div>


                                                </div>
                                                <style>
                                                    .box {

                                                        word-wrap: break-word;
                                                    }
                                                </style>

                                                <div class="row serv_detail_pge">

                                                    <div class="space"></div>
                                                    <div class="col-sm-12 box">

                                                        <?php echo $ProDes; ?>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'] ?>" />
                                                        <input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings" value="<?php echo $postid ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-left: 0px;">
                                            <div class="bg_white ArtistSong map_serv_detail m_btm_15">

                                                <div id="map"></div>

                                            </div>

                                            <div class="bg_white ArtistSong map_serv_detail m_btm_15">
                                                <h3>Posted By:</h3>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="img_serv_box m_btm_20">
                                                            <?php
                                                            if (isset($ArtistPic)) { ?>
                                                                <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $ArtistId; ?>">

                                                                    <img src=" <?php echo ($ArtistPic); ?>" class="img-responsive img-circle">
                                                                </a>
                                                                <?php
                                                            } else { ?>
                                                                <img src="../img/noman.png" class="img-responsive">
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 no-padding">
                                                        <div class="rightBusinePro">
                                                            <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $ArtistId; ?>" class="title"><?php echo ucfirst($ArtistName); ?></a>
                                                            <?php
                                                            $pp = new _spprofiles;
                                                            $rpvt = $pp->read($ArtistId);
                                        //echo $p->ta->sql;
                                                            if ($rpvt != false) {

                                                                $row = mysqli_fetch_assoc($rpvt);
                                                            }

                                                            $pf = new _profilefield;
                                                            $res = $pf->read($ArtistId);
                                                            if ($res != false) {

                                                                while ($resultr = mysqli_fetch_assoc($res)) {
                                                //$row[$resultr["spProfileFieldLabel"]] = $resultr["spProfileFieldValue"];							print_r($row);
                                                                }
                                                            }
                                        //echo $row['idspProfiles'];
                                                            $s = new _spprofilehasprofile;
                                                            $resultrs = $s->frndLeevel($_SESSION['pid'], $row['idspProfiles']);

                                                            $chkFriendForConn = $s->checkfriend($_SESSION["pid"], $ArtistId);


                                        // Show connection only for added as friend.

                                                            if ($chkFriendForConn != false) {
                                                                $chkFriendForConnRow = mysqli_fetch_assoc($chkFriendForConn);


                                                                if ($resultrs == 0 && $chkFriendForConnRow['spProfiles_has_spProfileFlag'] == 1) {

                                                                    $level = '1st';
                                                                } else if ($resultrs == 1) {
                                                                    $level = '1st';
                                                                } else if ($resultrs == 2) {
                                                                    $level = '2nd';
                                                                } else if ($resultrs == 3) {
                                                                    $level = '3rd';
                                                                } else {
                                                                    $level = 'No';
                                                                }
                                                            } else {

                                                                $level = '3rd';
                                                            }
                                        //echo $level;
                                                            $checkfriend = $s->checkfriend($_SESSION["pid"], $ArtistId);
                                                            if ($checkfriend != false) {
                                                                $checkResult = mysqli_fetch_assoc($checkfriend);
                                                                if ($checkResult['spProfiles_has_spProfileFlag'] == '1' && $checkIsBlocked == false && $checkIsBlocked2 == false) {
                                                                    echo '-' . $level . ' Connection';
                                                                }
                                                            }
                                                            ?>

                                                            <p>Business Profile</p>

                                                            <!--  <a href="javascript:void">Show Other Post(0)</a> -->
                                        <!--    <?php
                                                if (isset($isPhoneShow) && $isPhoneShow == 1) {
                                                    echo "<p><i class='fa fa-phone'></i>: " . $UserPhone . "</p>";
                                                }
                                                if (isset($isEmailShow) && $isEmailShow == 1) {
                                                    echo "<p><i class='fa fa-envelope'></i>: " . $UserEmail . "</p>";
                                                }

                                            ?> -->
                                            <br>

                                        </div>
                                    </div>
                                </div>



                                <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $ArtistId; ?>" class="btn">View Profile</a>
                                <p>&nbsp;</p>

                                <?php
                                $title = "whatsapp";

                                $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                                ?>

                                <div id="social-share" class="mt_d">
                                    <strong><span>Sharing is caring</span></strong> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
                                    <a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb"><i class='fa fa-facebook '></i></a>
                                    <!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
                                    <a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa fa-twitter"></i> </a>
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa fa-linkedin"></i> </a>
                                    <a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i class="fa fa-whatsapp"></i></a>
                                </div>




                                <?php


                                /*print_r($ArtistId);*/
                            //print_r($row);
                                /* print_r($_SESSION['pid']);*/



                                if ($ArtistId != $_SESSION['pid'] && !in_array($ArtistId, $user_profiles_list, TRUE)) { ?>


                                    <h3>Contact <?php echo $ArtistName; ?></h3>

                                    <form method="post" action="addenquiry.php" class="sndmsgservFrm">
                                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $ArtistId; ?>">
                                        <input type="hidden" name="sender_id" value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postid; ?>">
                                        <textarea class="form-control no-radius m_btm_5 txt" placeholder="Send a message" rows="4" name="enquiry_msg"></textarea>
                                        <?php
                                        if ($_SESSION['guet_yes'] != "yes") {
                                            ?>

                                            <input type="submit" name="" value="Send Message" class="btn ">

                                        </form>





                                    </div>
                                    <a href="javascript:void(0)" style="padding: 2px 10px; color: #000;margin-bottom: 15px;display: block;" data-toggle="modal" data-target="#flagPost">Flag This Post?</a>
                                    <?php
                                }
                                ?>
                                <!-- Modal -->
                                <div id="flagPost" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <form method="post" action="addtoflag.php" class="sharestorepos">
                                            <div class="modal-content no-radius">
                                                <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postid; ?>">
                                                <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                                <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID'] ?>">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Flag Post</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="radio">
                                                        <label><input type="radio" name="why_flag" value="Duplicate post" checked>Duplicate post</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
                                                    </div>
                                                    <div class="radio">
                                                        <label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
                                                    </div>

                                                    <!-- <label>Why flag this post?</label> -->
                                                    <textarea class="form-control f_txt" name="flag_desc" placeholder="Add Comments"></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" name="" class="btn butn_mdl_submit ">
                                                    <button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>



                            <?php } ?>
                <!--            <div class="bg_white ArtistSong map_serv_detail m_btm_15">
<h3>Related Services</h3>
<?php
$limit = 3;
$orderBy = "DESC";
$p   = new _postingview;
$pf  = new _postfield;
$res = $p->publicpost_music($limit, $_GET["categoryID"], $orderBy);
//echo $p->ta->sql;
if ($res) {
while ($row = mysqli_fetch_assoc($res)) {
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if ($result_pf) {
$sercom = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
if ($sercom == '') {
if ($row2['spPostFieldName'] == 'spPostSelection_') {
$sercom = $row2['spPostFieldValue'];
}
}
}
}
?>
<div class="row">
<div class="col-md-4">
<?php
$pic = new _postingpic;
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
} else {
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
<?php
} ?>
</div>
<div class="col-md-8 no-padding">
<a href="<?php echo $BaseUrl . '/services/detail.php?postid=' . $row['idspPostings']; ?>" class="title"><?php echo $row['spPostingtitle']; ?></a>
<span class="views"><?php echo (isset($sercom) && $sercom != '') ? $sercom : '&nbsp;'; ?></span>
<span class="expiry">Expires on <?php echo $row['spPostingExpDt']; ?></span>
</div>
<div class="col-md-12">
<hr>
</div>
</div>
<?php
}
}
?>

</div> -->
</div>
</div>
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

<?php

include('../component/f_footer.php');
include('../component/f_btm_script.php');
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initMap"></script>
</body>
<script>
/* jquery lightSlider.js v1.0.0 *** https://sachinchoolur.github.io/lightslider */
    eval(function(p, a, c, k, e, r) {
        e = function(c) {
            return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
        };
        if (!''.replace(/^/, String)) {
            while (c--) r[e(c)] = k[c] || e(c);
            k = [function(e) {
                return r[e]
            }];
            e = function() {
                return '\\w+'
            };
            c = 1
        };
        while (c--)
            if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('!4(e){"3a 38";5 i={Z:36,9:0,j:1,X:1,1v:8,1r:"",7:"q",1X:!0,y:1L,V:"",19:!1,1c:35,1f:!0,1e:!0,1G:"",1K:"",1a:!0,15:!0,z:!1,R:34,11:3,20:"22",26:33,2f:4(){},2l:4(){},2p:4(){},1D:4(){},1x:4(){},1A:4(){}};e.31.O=4(t){b(6.I>1)13 6.30(4(){e(6).O(t)}),6;5 s={},n=e.2Z(!0,{},i,t),a=6;s.$2X=6;5 l=a.27(),o=0,d=0,r=!1,c=0,u="",f=0,h=0,g=0,v=!1,m=!1,p="",S="2W"1S 1w.1V,M=2V 2U;13 s={B:4(){5 e=4(){1q(5 e=["U","2S","2R","2r","2P","2N"],i=1w.1V,t=0;t<e.I;t++)b(e[t]1S i.28)13!0};13 n.1X&&e()?!0:!1},1a:4(){n.1a===!0&&e(1w).1l("2L",4(e){37===e.2j?(a.1d(),C(p)):39===e.2j&&(a.K(),C(p))})},1e:4(){b(n.1e){a.1E(\'<Q P="1H"><a P="1I">\'+n.1G+\'</a><a P="1T">\'+n.1K+"</a></Q>");5 i=u.x(".1I"),t=u.x(".1T");i.1l("1g",4(){a.1d(),C(p)}),t.1l("1g",4(){a.K(),C(p)}),l.I<=1&&e(".1H").2K()}},1N:4(){a.A("O").2I("<Q P=\'2H\'><Q P=\'1R\'></Q></Q>"),u=a.14(".1R"),n.2f.D(6),c=a.1U();5 e,i;b(M.1i=4(){e=(c-(n.X*n.9-n.9))/n.X,i=(c-(n.1v*n.9-n.9))/n.1v,""===n.Z?(g=e,n.j=n.X):e<n.Z?(g=e,n.j=n.X):g=i>n.Z?i:n.Z},M.1j=4(){o=l.I,d=o*(g+n.9),d%1&&(d+=1),a.k("Y",d+"E"),l.k("Y",g+"E"),l.k({"1Z":"18","21-1o":n.9+"E"})},M.1B=4(){l=a.27(),o=l.I},6.B()&&u.A("2E"),M.1B(),l.25().A("w"),"q"===n.7)M.1i(),M.1j();W{b(""!==n.1r)a.k({1u:"G","29-2a":n.1r});W{5 t=l.1u(),s=2b*t/c;a.k({1u:"G","29-2a":s+"%"})}a.A("2C"),6.B()||l.2A(".w").k("2z","2x")}u.k({"2w-Y":"2b%",2h:"2i"})},15:4(){5 e=6;b(M.1z=4(){5 i="";b("q"===n.7){i=2k(o/n.j);5 t=o%n.j;t&&(i+=1)}W i=o;5 s=0,r="",v=0;1q(s=0;i>s;s++){"q"===n.7&&(v=s*(g+n.9)*n.j);5 m=l.12(s*n.j).2v("2Q-2s");b(r+=n.z===!0?\'<J 28="1Z:18;Y:\'+n.R+"E;21-1o:"+n.11+\'E"><a 2q="2o:2n(0)"><2t 2u="\'+m+\'" /></a></J>\':\'<J><a 2q="2o:2n(0)">\'+(s+1)+"</a></J>","q"===n.7&&v>=d-c-n.9){s+=1,1>=s&&(r=2m);1y}}1>=i&&(r=2m);5 S=u.14();S.x(".L").2y(r),n.z===!0&&(h=s*(n.11+n.R),S.x(".L").k({Y:h+"E",2e:"2d(G, G, G)",U:"1s 2B"}));5 M=S.x(".L").x("J");M.25().A("w"),M.F("1g",4(){f=M.2D(6),a.7(),n.z===!0&&e.H(),C(p)})},n.15){5 i="";i=n.z?"2F":"2G",u.1E(\'<1Q P="L \'+i+\'"></1Q>\'),M.1z()}n.2l.D(6)},w:4(e,i){6.B()&&"N"===n.7&&(u.2J("F")||u.A("F"));5 t=0;b(f*n.j<o){b(e.1p("w"),6.B()||"N"!==n.7||i!==!1||e.1C(n.y),t=i===!0?f:f*n.j,i===!0){5 s=e.I,a=s-1;t+1>=s&&(t=a)}6.B()||"N"!==n.7||i!==!1||e.12(t).2g(n.y),e.12(t).A("w")}W e.1p("w"),e.12(e.I-1).A("w"),6.B()||"N"!==n.7||i!==!1||(e.1C(n.y),e.12(t).2g(n.y))},1k:4(e,i){6.B()?e.k("2e","2d(-"+i+"E, G, G)"):e.k("2h","2i").2M({18:-i+"E"},n.y,n.V);5 t=u.14().x(".L").x("J");6.w(t,!0)},N:4(){6.w(l,!1);5 e=u.14().x(".L").x("J");6.w(e,!0)},q:4(){5 e=6;M.1m=4(){5 i=f*(g+n.9)*n.j;e.w(l,!1),i>d-c-n.9?i=d-c-n.9:0>i&&(i=0),e.1k(a,i)},M.1m(),m=!0},H:4(){5 e;2O(n.20){1n"18":e=0;1y;1n"22":e=c/2-n.R/2;1y;1n"1o":e=c-n.R}5 i=f*(n.R+n.11)-e;i+c>h&&(i=h-c-n.11),0>i&&(i=0);5 t=u.14().x(".L");6.1k(t,i)},19:4(){n.19&&(p=24(4(){a.K()},n.1c))},23:4(){b(S){5 e={},i={};u.F("2T.O",4(t){i=t.17.16[0],e.T=t.17.16[0].T,e.1b=t.17.16[0].1b}),u.F("2Y.O",4(t){5 s=t.17;i=s.16[0];5 n=1Y.1W(i.T-e.T),a=1Y.1W(i.1b-e.1b);3*n>a&&t.1J()}),u.F("32.O",4(){5 t=i.T-e.T,s=n.26;t>=s?(a.1d(),C(p)):-s>=t&&(a.K(),C(p))})}},2c:4(){5 e=6;e.1N(),e.19(),e.23(),e.15(),e.1e(),e.1a()}},s.2c(),M.1t=4(){v=!0,M.1B(),"q"===n.7&&a.1p("1h"),c=u.1U(),"q"===n.7&&(M.1i(),M.1j()),1M(4(){v===!0&&("q"===n.7&&a.A("1h"),v=!1)},1L),n.15&&M.1z(),n.z===!0&&s.H(),m&&M.1m()},a.1d=4(){b(f>0)n.1A.D(6),f--,a.7(),n.z===!0&&s.H();W b(n.1f===!0){b(n.1A.D(6),"q"===n.7){1q(5 e=0,i=0;o>i&&(e=i*(g+n.9)*n.j,!(e>=d-c-n.9));i++);f=i}W{5 t=o;t-=1,f=2k(t/n.j,10)}a.7(),n.z===!0&&s.H()}},a.K=4(){5 e=!0;b("q"===n.7)5 i=f*(g+n.9)*n.j,e=i<d-c-n.9;f*n.j<o-n.j&&e?(n.1x.D(6),f++,a.7(),n.z===!0&&s.H()):n.1f===!0&&(n.1x.D(6),f=0,a.7(),n.z===!0&&s.H())},a.7=4(){r===!1&&("q"===n.7?s.B()&&(a.A("1h"),""!==n.y&&u.k("U-1P",n.y+"1O"),""!==n.V&&u.k("U-1F-4",n.V)):s.B()&&(""!==n.y&&a.k("U-1P",n.y+"1O"),""!==n.V&&a.k("U-1F-4",n.V))),n.2p.D(6),"q"===n.7?s.q():s.N(),1M(4(){n.1D.D(6)},n.y),r=!0},a.3b=4(){C(p),a.K(),p=24(4(){a.K()},n.1c)},a.1c=4(){C(p)},a.3c=4(){M.1t()},a.3d=4(){13 f+1},a.3e=4(e){f=e,a.7()},e(3f).F("3g",4(e){e.1J(),M.1t()}),6}}(3h);', 62, 204, '||||function|var|this|mode||slideMargin||if||||||||slideMove|css||||||slide||||||active|find|speed|gallery|addClass|doCss|clearInterval|call|px|on|0px|slideThumb|length|li|goToNextSlide|csPager||fade|lightSlider|class|div|thumbWidth||pageX|transition|easing|else|minSlide|width|slideWidth||thumbMargin|eq|return|parent|pager|targetTouches|originalEvent|left|auto|keyPress|pageY|pause|goToPrevSlide|controls|loop|click|csSlide|calSW|sSW|move|bind|calSlide|case|right|removeClass|for|proportion||init|height|maxSlide|document|onBeforeNextSlide|break|createPager|onBeforePrevSlide|calL|fadeOut|onAfterSlide|after|timing|prevHtml|csAction|csPrev|preventDefault|nextHtml|1e3|setTimeout|initialStyle|ms|duration|ul|csSlideWrapper|in|csNext|outerWidth|documentElement|abs|useCSS|Math|float|currentPagerPosition|margin|middle|enableTouch|setInterval|first|swipeThreshold|children|style|padding|bottom|100|build|translate3d|transform|onBeforeStart|fadeIn|position|relative|keyCode|parseInt|onSliderLoad|null|void|javascript|onBeforeSlide|href|OTransition|thumb|img|src|attr|max|none|html|display|not|all|csFade|index|usingCss|cSGallery|cSpg|csSlideOuter|wrap|hasClass|hide|keyup|animate|KhtmlTransition|switch|msTransition|data|WebkitTransition|MozTransition|touchstart|Object|new|ontouchstart|el|touchmove|extend|each|fn|touchend|40|50|3e3|270||strict||use|play|refresh|getCurrentSlideCount|goToSlide|window|resize|jQuery'.split('|'), 0, {}))

$(document).ready(function() {
    $('#lightSlider').lightSlider({
        gallery: true,
        minSlide: 1,
        maxSlide: 1,
        currentPagerPosition: 'left',
        thumbWidth: 90,
        thumbMargin: 5,
        prevHtml: '<i class="fa fa-angle-double-left"></i>',
        nextHtml: '<i class="fa fa-angle-double-right"></i>',
    });
});



$("#share").click(function() {
  
  var dropdownShare = $("#dropdownShare").text();
  var aboutshare = $("#aboutshare").val();
  var groupSelect = $("#groupSelect :selected").text();
  var friendSelect = $("#friendSelect :selected").text();
    //alert(dropdownShare);
  if (dropdownShare == "Select group or friend") {
    //alert("22222");
    $("#shareError1").html("This field is required");
    return false;
} else if (dropdownShare == "Share in a group ") {
   // alert("333333");
    $("#shareError1").html("");
    if (groupSelect == "") {
      $("#shareError2").html("This field is required");
      return false;
  } else {
      $("#shareError2").html("");
  }
} else {
    $("#shareError1").html("");
    if (friendSelect == "") {
      $("#shareError3").html("This field is require");
      return false;
  } else {
      $("#shareError3").html("");
  }
}

//   if (aboutshare == "") {
//     $("#shareError").html("This field is required");
//     return false;
//   } else {
//     $("#shareError").html("");
//   }
});
</script>

</html>
<?php
} ?>
