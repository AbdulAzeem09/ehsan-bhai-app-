<?php
	/*error_reporting(E_ALL);
    ini_set('display_errors', '1');*/

    include('../univ/baseurl.php');
    session_start();
    if (!isset($_SESSION['pid'])) {
        $_SESSION['afterlogin'] = "business-directory/";
        include_once ("../authentication/check.php");

    }else{
        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");

        $header_directy = "header_directy";


        if (isset($_GET['business']) && $_GET['business'] > 0) {
           $profileId = $_GET['business'];

           $p = new _spprofiles;
           $res = $p->read($profileId);
        //echo $p->ta->sql;
           if ($res != false) {

            while ($row = mysqli_fetch_assoc($res)) { 
                $name       = $row["spProfileName"];
                $picture    = $row['spProfilePic'];
                $about      = $row["spProfileAbout"];
                $phone      = $row["spProfilePhone"];
                $country    = $row["spProfilesCountry"];
                $city       = $row["spProfilesCity"];
                $state      = $row["spProfilesState"];
                $profiletype        = $row["spProfileType_idspProfileType"];
                $profileTypeName    = $row['spProfileTypeName'];
                $icon       = $row["spprofiletypeicon"];
                $ptypeid    = $row["idspProfileType"];
                $email      = $row["spProfileEmail"];
                $location   = $row["spprofilesLocation"];
                $language   = $row["spprofilesLanguage"];
                $storeName  = $row["spDynamicWholesell"];
                $postalCode = $row['spProfilePostalCode'];

                $pf = new _profilefield;
                $query = $pf->read($row["idspProfiles"]);
                if ($query != false) {
                    $cmpnyName = "";
                    $cmpnyAddress = "";
                    $cmpnyEmail = "";
                    $cmpnyPhone = "";
                    $cmpnySize = "";
                    $cmpnyRevenue = "";
                    $cmpnyFounded = "";
                    $cmpnyOwnership = "";
                    $cmpnyWebsite = "";
                    $cmpnyOperatingHour = "";
                    $cmpnyStockSymbol = "";
                    $cmpnyStockWeblink = "";
                    $cmpnyTagline = "";
                    $cmpnnyCategory = "";
                    $cmpnyProdServ = "";
                    $cmpnySpeclities = "";
                    $cmpnyLanguage ="";
                    

                    while ($row2 = mysqli_fetch_assoc($query)) {
                        // print_r($row2);
                        // exit;
                        if($cmpnyLanguage == ''){
                            if($row2['spProfileFieldName'] == 'languageSpoken_'){
                                $cmpnyLanguage = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnySpeclities == ''){
                            if($row2['spProfileFieldName'] == 'skill_' || $row2['spProfileFieldName'] == 'skill'){
                                $cmpnySpeclities = $row2['spProfileFieldValue_'];
                            }
                        }
                        if($cmpnyProdServ == ''){
                            if($row2['spProfileFieldName'] == 'companyProductService_' || $row2['spProfileFieldName'] == 'companyProductService'){
                                $cmpnyProdServ = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnnyCategory == ''){
                            if($row2['spProfileFieldName'] == 'businesscategory_' || $row2['spProfileFieldName'] == 'businesscategory'){
                                $cmpnnyCategory = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyTagline == ''){
                            if($row2['spProfileFieldName'] == 'companytagline_' || $row2['spProfileFieldName'] == 'companytagline'){
                                $cmpnyTagline = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyName == ''){
                            if($row2['spProfileFieldName'] == 'companyname_' || $row2['spProfileFieldName'] == 'companyname'){
                                $cmpnyName = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyAddress == ''){
                            if($row2['spProfileFieldName'] == 'companyaddress_' || $row2['spProfileFieldName'] == 'companyaddress'){
                                $cmpnyAddress = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyEmail == ''){
                            if($row2['spProfileFieldName'] == 'companyEmail_' || $row2['spProfileFieldName'] == 'companyEmail'){
                                $cmpnyEmail = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyPhone == ''){
                            if($row2['spProfileFieldName'] == 'companyPhoneNo_' || $row2['spProfileFieldName'] == 'companyPhoneNo'){
                                $cmpnyPhone = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnySize == ''){
                            if($row2['spProfileFieldName'] == 'CompanySize_' || $row2['spProfileFieldName'] == 'CompanySize'){
                                $cmpnySize = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyRevenue == ''){
                            if($row2['spProfileFieldName'] == 'cmpyRevenue_' || $row2['spProfileFieldName'] == 'cmpyRevenue'){
                                $cmpnyRevenue = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyFounded == ''){
                            if($row2['spProfileFieldName'] == 'yearFounded_' || $row2['spProfileFieldName'] == 'yearFounded'){
                                $cmpnyFounded = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyOwnership == ''){
                            if($row2['spProfileFieldName'] == 'CompanyOwnership_' || $row2['spProfileFieldName'] == 'CompanyOwnership'){
                                $cmpnyOwnership = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyWebsite == ''){
                            if($row2['spProfileFieldName'] == 'CompanyWebsite_' || $row2['spProfileFieldName'] == 'CompanyWebsite'){
                                $cmpnyWebsite = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyOperatingHour == ''){
                            if($row2['spProfileFieldName'] == 'operatinghours_' || $row2['spProfileFieldName'] == 'operatinghours'){
                                $cmpnyOperatingHour = $row2['spProfileFieldValue_'];
                            }
                        }
                        if($cmpnyStockSymbol == ''){
                            if($row2['spProfileFieldName'] == 'stockSymbol_' || $row2['spProfileFieldName'] == 'stockSymbol'){
                                $cmpnyStockSymbol = $row2['spProfileFieldValue'];
                            }
                        }
                        if($cmpnyStockWeblink == ''){
                            if($row2['spProfileFieldName'] == 'cmpnyStockLink_' || $row2['spProfileFieldName'] == 'cmpnyStockLink'){
                                $cmpnyStockWeblink = $row2['spProfileFieldValue'];
                            }
                        }
                        // print_r($row2);

                    }
                    // exit;
                }
            }
        }


    }else{
        $re = new _redirect;
        $redirctUrl = "../business-directory";
        $re->redirect($redirctUrl);
    }
    // SHOW ALL COUNTRY , STATE, CITY
    $st  = new _state;
    $c   = new _country;
    $ci  = new _city;
    // county name
    $result3 = $c->readCountryName($country);
    if($result3 != false){
        $row3 = mysqli_fetch_assoc($result3);
    }
    // provision name
    $result2 = $st->readStateName($state);
    if($result2 != false){
        $row5 = mysqli_fetch_assoc($result2);
    }
    // city name
    $result4 = $ci->readCityName($city);
    if($result4){
        $row4 = mysqli_fetch_assoc($result4);
    }

    ?>
    <!DOCTYPE html>
    <html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!-- image gallery script strt -->
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/prettyPhoto.css">
        <!-- image gallery script end -->
        <script type="text/javascript">
         jQuery(document).ready(function($) {
            $('#myCarousel').carousel({
                interval: 5000
            });         
            $('#carousel-text').html($('#slide-content-0').html());
                //Handles the carousel thumbnails
                $('[id^=carousel-selector-]').click( function(){
                    var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                    var id = parseInt(id);
                    $('#myCarousel').carousel(id);
                });
                // When the carousel slides, auto update the text
                $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                 $('#carousel-text').html($('#slide-content-'+id).html());
             });
            });
        </script>
        <script type="text/javascript">
            function geocodeAddress(geocoder, resultsMap, address) {
                //alert(address);
                geocoder.geocode({'address': address}, function(results, status) {
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
        <style type="text/css">
            .rating:not(:checked)>label:hover, .rating:not(:checked)>label:hover~label, .rating>input:checked~label {
                color: #2f9000 !important;
            }
        </style>

<style media="screen">
            .midjob {
                padding: 0px !important;
            }

            .midjob form.job_search {
                box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.12), 0 4px 10px 0 rgba(0, 0, 0, 0.16);
                background-color: #fff !important;
                padding: 16px;
            }

            .midjob form.job_search .form-group input {
                height: 40px;
                border-radius: 50px;
                padding: 0px 10px;
            }

            .midjob form.job_search button#btnJobSearch {
                padding: 10px 0px !important;
                border-radius: 40px !important;
                width: 100%;
            }

            section.landing_page.bg_white {
                margin-bottom: 16px;
            }

            /*.whiteboardmain {
                padding: 15px 15px 30px 15px;
                margin-bottom: 20px;
                }*/
            .whiteboardmain h4 {
                margin-bottom: 20px;
                margin-top: 30px;
                font-size: 20px;
            }

            .whiteboardmain p {
                margin-bottom: 6px;
            }

            .right_main_top .row:hover {
                background-color: #f1f1f1f1;
                cursor: pointer;
            }

            .right_main_top h4 {
                margin-top: 10px;
                line-height: 26px;
            }

            .right_main_top h4 a {
                font-size: 18px;
                color: #000;
            }

            .right_main_top button.jobbutton.btn-primary {
                margin-top: 20px !important;
            }

            .right_main_top span {
                padding: 0px 4px;
                margin-right: 2px;
                margin-left: 8px;
            }

            .right_main_top button.jobbutton.btn-primary {
                margin-top: 20px !important;
                padding: 5px 10px;
                border: 1px solid #fff;
            }

            .skilllink {
                margin-right: 10px !important;
            }

            /* --------new-job-list-css----------- */

            .right-job-listing {
                margin-top: 10px;
                background-color: #fff;
            }

            .right-job-listing table#task-list-tbl {
                width: 100%;
            }

            .job-content {
                padding: 0 16px;
                border-bottom: 1px solid #DEDEDE;
            }

            .job-content .job-card {
                padding: 24px 0;
            }

            .job-content .job-card .card-primary .pri-head {
                margin-bottom: 16px;
            }

            .job-content .job-card .card-primary .pri-head .head-link {
                font-size: 16px;
                line-height: 1.5;
                color: #0e1724;
                font-weight: 700;
                margin-right: 4px;
            }

            .job-content .job-card .card-primary .pri-head .head-days {
                margin-right: 12px;
            }

            .job-content .job-card .card-primary .pri-head .new-head {
                background-color: #4fb55d;
                color: #fff;
                padding: 2px 4px;
                font-size: 12px;
                margin-right: 3px;
                border: 1px solid #4fb55d;
                margin-bottom: 3px;
                display: inline-block;
            }

            .job-content .job-card .card-primary .pri-head .new-head {
                padding: 0px 4px;
                margin-right: 2px;
                margin-left: 2px;
            }

            .job-content .job-card .card-primary .pri-para {
                margin-bottom: 16px;
                font-size: 14px;
                line-height: 1.4;
                color: #0e1724;
            }

            .job-content .job-card .card-primary .pri-tags a {
                margin-bottom: 8px;
                margin-right: 8px;
                text-decoration: none;
                color: #007fed !important;
            }

            .job-content .job-card .card-secondary .price {
                font-size: 16px;
                line-height: 1.5;
                font-weight: 700;
                margin-bottom: 8px;
                color: #0e1724;
            }

            .job-content .job-card .card-secondary .price .avg {
                font-size: 13px;
                font-weight: 400;
                line-height: 1.2;
                font-weight: 400;
            }

            .job-content .job-card .card-secondary .entry {
                font-size: 14px;
                line-height: 1.43;
                color: #0e1724;
            }

            .job-content .job-card .card-secondary .avg-btn {
                display: block;
                margin-top: 10px;
            }

            .job-content .job-card .card-secondary .avg-btn .avg-bid {
                background: #337ab7;
                border: 1px solid #337ab7;
                color: #F7F7F7;
                font-weight: 700;
                text-shadow: 0 -1px transparent;
                padding: 4px 12px;
                font-size: 13px;
                border-radius: 50px;
            }

            .job-content:hover {
                background-color: #F7F7F7;
                cursor: pointer;
            }

            .job-content:hover .avg-btn {
                display: block !important;
                margin-top: 12px;
            }

            .avg-bid {
                background: #5dc26a;
                border-color: #5dc26a;
                color: #F7F7F7;
            }

            .location-btn {
                margin-top: 16px;
                margin-left: 2px;
            }

            .location-btn a.loc-btn {
                color: #000;
                font-size: 15px;
            }

            /* ----start-media-query-css----- */

            @media only screen and (max-width: 767px) {

                .home_top_job {
                    padding: 0px;
                }

                .midjob form.job_search button#btnJobSearch {
                    margin-top: 20px;
                }

                li.cls {
                    margin-top: -19px !important;
                }
            }

            #profileDropDown li.active {
                background-color: #1f3060 !important;
            }

            #profileDropDown li.active a {
                color: #fff !important;
            }
        </style>

    </head>

    <body class="bg_gray">
     <?php
     include_once("../header.php");
     ?>

     <section>
        <div class="row no-margin">
              <!--  <div class="col-md-3 no-padding">
                    <?php //include('../component/left-business.php');?>
                </div>-->
                <div class="col-sm-12 ">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <div class="col-sm-12 no-padding">
                                <div class="fulmainarttab">
                                    <ul class='nav nav-tabs' id='navtabVdo' >
                                        <li role="presentation" class="active"><a href="#video1" aria-controls="home" role="tab" data-toggle="tab">Detail</a></li> 
                                        <li><a href="<?php echo $BaseUrl.'/business-directory/business.php'?>">Business Space</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/business-directory/profiles.php'?>"> Business Profiles</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/business-directory/dashboard.php'?>">Dashboard</a></li>
                                        
                                    </ul>
                                    <div class="linebtm"></div>
                                </div>
                            </div>
                            <div class="col-sm-12 no-padding">
                                <div class="row no-margin topVdoBread">
                                    <div class="col-sm-12 no-padding">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/business-directory';?>"><i class="fa fa-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/business-directory/business.php';?>">All Businesss</a></li> 
                                                <li class="breadcrumb-item active" aria-current="page">Title</li> 
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="" style="width: 90%;margin: 0 auto">
                                    <?php //include('search-form.php');?>
                                </div>
                                <div class="tab-content no-radius otherTimleineBody" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active" id="video1">
                                        <div class="artistDetail">
                                            <div class="topArtistBanner" id="topdircty">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="leftADetail busDetTop">
                                                            <img alt="Profile Pic" class="img-responsive img-big m_btm_10" src="<?php echo ((isset($picture))?" ". ($picture)."":"../img/default-profile.png");?>">
                                                            
                                                            <h3 class="TitleArtist"><?php echo $cmpnyName; ?></h3>
                                                            <?php if ($cmpnyAddress != '') { ?>
                                                             <p> <?php
                                                                    //$googleMap = [];

                                                             $pr = new _spprofiles;
                                                             $country = 0;
                                                             $state = 0;
                                                             $city = 0;
                                                             $profile_country = '';
                                                             $profile_state='';
                                                             $profile_city='';
                                                             $result  = $pr->read($_GET['business']);
                                                             $sprows = mysqli_fetch_assoc($result);
                                                             $country = $sprows["spProfilesCountry"];
                                                             $state = $sprows['spProfilesState'];
                                                             $city = $sprows["spProfilesCity"];
                                                             $profile_additional_address = $sprows["address"];
                                                             $co = new _country;
                                                             $result3 = $co->readCountryName($country);
                                                             if ($result3) {
                                                                $rowcon = mysqli_fetch_assoc($result3);
                                                                $profile_country =  $rowcon['country_title'];
                                                            }

                                                            $stateObj = new _state;
                                                            $result4 = $stateObj->readStateName($state);

                                                            if ($result4) {
                                                                $rowstate = mysqli_fetch_assoc($result4);
                                                                $profile_state =  $rowstate['state_title'];
                                                            }

                                                            $cityObj = new _city;
                                                            $result5 = $cityObj->readCityName($city);
                                                            if ($result5) {
                                                                $rowcity = mysqli_fetch_assoc($result5);
                                                                $profile_city =  $rowcity['city_title'];
                                                            }
                                                            if ($profile_additional_address != '' || $profile_city != '' || $profile_state != '' || $profile_country != '') {
                                                              echo '<i class="fa fa-home"></i>&nbsp&nbsp';


                                                              if ($profile_additional_address != '') {

                                                                  echo $profile_additional_address.','; 
                                                              }
                                                              if ($profile_city != '') {
                                                                  echo $profile_city.','; 
                                                              }
                                                              if ($profile_state != '') {
                                                                  echo $profile_state.','; 
                                                              }
                                                              if ($profile_country != '') {
                                                                  echo $profile_country.'.'; 
                                                              }
                                                          }
                                                      ?></p>
                                                  <?php  } 
                                                                // SHOW ALL COUNTRY , STATE, CITY
                                                  $st  = new _state;
                                                  $c   = new _country;
                                                  $ci  = new _city;
                                                                // county name
                                                  $result3 = $c->readCountryName($country);
                                                  if($result3 != false){
                                                    $row3 = mysqli_fetch_assoc($result3);
                                                }
                                                                // provision name
                                                $result2 = $st->readStateName($state);
                                                if($result2 != false){
                                                    $row5 = mysqli_fetch_assoc($result2);
                                                }
                                                                // city name
                                                $result4 = $ci->readCityName($city);

                                                if($result4 != false){
                                                    $row4 = mysqli_fetch_assoc($result4);

                                                }
                                                $addr = $row4['city_title'].' '.$row3['country_title'];
																//echo $addr;
                                                $googleMap=[];
                                                array_push($googleMap, $addr);
                                                ?>

                                                <?php if ($cmpnyEmail != '') { ?>
                                                 <span style="margin-right: 25px;"><i class="fa fa-envelope"></i> : <?php echo $cmpnyEmail; ?></span>
                                             <?php  } ?>

                                             <?php if ($cmpnyPhone != '') { ?>
                                                 <span><i class="fa fa-phone"></i> : <?php echo $cmpnyPhone; ?> </span>
                                             <?php  } ?>
                                             &nbsp;&nbsp;
                                             <?php
                                             $fd = new _favouriteBusiness;
                                             $result_fav = $fd->chkFavAlready($_GET['business'], $_SESSION['pid'], 1);
                                             if($result_fav){
                                                ?>
                                                <a href="javascript:void(0)" class="removeToProfileFav" data-favourite="1" data-company="<?php echo $_GET['business'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                    <span id="addtofavouriteeve"><i class="fa fa-heart"></i></span>
                                                    Remove From My Favourite
                                                </a>
                                                <?php
                                            }else{
                                                ?>
                                                <a href="javascript:void(0)" class="addToProfileFav" data-favourite="1" data-company="<?php echo $_GET['business'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                    <span id="addtofavouriteeve"><i class="fa fa-heart-o"></i></span>
                                                    Add To Favourite
                                                </a>
                                                <?php
                                            }
                                            ?>



                                            <?php 
                                            if ($_GET['business'] != $_SESSION['pid']) {                                            
                                                $bR = new _businessrating;
                                                $totalRating = $bR->getRatingOfBusiness($_GET['business'],$_SESSION['pid']);
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-3 no-padding">

                                                        <fieldset id='buss_postrating' class="rating no-padding">
                                                            <input class="stars" type="radio" id="star5" name="rating" value="5" 
                                                            <?php echo ($totalRating == 5)? 'checked': '';?>/>
                                                            <label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                            <input class="stars" type="radio" id="star4" name="rating" value="4" <?php echo ($totalRating == 4)? 'checked': '';?> />
                                                            <label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                            <input class="stars" type="radio" id="star3" name="rating" value="3" <?php echo ($totalRating == 3)? 'checked': '';?> />
                                                            <label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
                                                            <input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" <?php echo ($totalRating == 2)? 'checked': '';?> />
                                                            <label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                            <input class="stars" type="radio" id="star1" name="rating" value="1" <?php echo ($totalRating == 1)? 'checked': '';?> />
                                                            <label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                        </fieldset>

                                                    </div>
                                                </div>
                                                <?php if($_SESSION['guet_yes']!='yes'){?>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <?php
                                                            $fd = new _favouriteBusiness;
                                                            $result_fav = $fd->chkFavAlready($_GET['business'], $_SESSION['pid'], 2);
                                                            if($result_fav){
                                                                ?>
                                                                <a href="javascript:void(0)" class="removeToResorc" data-favourite="2" data-company="<?php echo $_GET['business'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                                    <span id="addtofavouriteeve"><i class="fa fa-star"></i></span>
                                                                    Remove From My Resources
                                                                </a>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <a href="javascript:void(0)" class="addtoResorc" data-favourite="2" data-company="<?php echo $_GET['business'];?>" data-pid="<?php echo $_SESSION['pid'];?>">
                                                                    <span id="addtofavouriteeve"><i class="fa fa-star-o"></i></span>
                                                                    Add To My Resources
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                &nbsp;
                                            <?php }else{ ?>
                                                <div class="row">
                                                    <div class="col-md-3">

                                                        <a href="<?php echo $BaseUrl.'/my-profile/'?>"><i class="fa fa-edit" style="margin-top:15px; margin-left: -16px;">Edit</a></i>
                                                    </div>
                                                </div>
                                            <?php } ?>

                                            <p><?php echo $cmpnyTagline;?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="bg_white ArtistSong">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="nav nav-tabs" id="navtabDircty">
                                            <li class="active"><a data-toggle="tab" href="#home">Business Profile</a></li>

                                            
                                            <?php $prof = new _spprofiles;
                                
                                      $res = $prof->read_business_tab($_GET['business']);
                                        if($res != false){

                                          while($row_tab = mysqli_fetch_assoc($res)){
                                      

                                       ?>

                                       <?php if($row_tab['module_name']=="Job"){
                                         if($row_tab['status']=="1"){                                  ?>
                                            <li><a data-toggle="tab" href="#menu1">Job</a></li>
                                        <?php }} ?>
                                        <?php if($row_tab['module_name']=="videos"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu2">Videos</a></li>
                                        <?php }} ?>
                                            <!-- <li><a data-toggle="tab" href="#menu3">Additional Info</a></li>-->
                                            <?php if($row_tab['module_name']=="store"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu4">Store</a></li>
                                        <?php }} ?>
                                         <?php if($row_tab['module_name']=="Real Estate"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu8">Real Estate</a></li><?php }} ?>
                                             <?php if($row_tab['module_name']=="Rental"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu9">Rental</a></li>
                                        <?php }} ?>

                                         <?php if($row_tab['module_name']=="Freelancer"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu10">Freelancer</a></li><?php }} ?>

                                             <?php if($row_tab['module_name']=="Events"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu11">Events</a></li>
                                        <?php }} ?>

                                         <?php if($row_tab['module_name']=="Art and Craft"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu12">Art and Craft</a></li><?php }} ?>

                                             <?php if($row_tab['module_name']=="Classified Ad"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu13">Classified Ad</a></li>

                                        <?php }} ?>

                                         <?php if($row_tab['module_name']=="My Business Space"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu14">My Business Space</a></li>

                                        <?php }} ?>

                                        <?php if($row_tab['module_name']=="Business for Sale"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu15">Business for Sale</a></li>
                                          <?php }} ?>
                                             <?php if($row_tab['module_name']=="Trainings"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu16">Trainings</a></li><?php }} ?>

                                             <?php if($row_tab['module_name']=="News"){
                                         if($row_tab['status']=="1"){?>
                                            <li><a data-toggle="tab" href="#menu5">News</a></li>

                                        <?php }} }} ?>
                                            <li><a data-toggle="tab" href="#menu6">Contact</a></li>
                                            <li><a data-toggle="tab" href="#menu7">Gallery</a></li>
                                        </ul>

                                        <div class="tab-content" style="min-height: 200px;">
                                            <!-- user profile -->
                                            <div id="home" class="tab-pane fade in active">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive">
                                                            <table class="table tbl_profile">
                                                                <body>

                                                                    <?php 

                                                                    $p = new _spbusiness_profile;

                                                                    $rpvt = $p->read($_GET["business"]);

                                                                    if ($rpvt != false){
                                                                       $row_p = mysqli_fetch_assoc($rpvt);
                                                                       $cmpnyName = $row_p['companyname'];
                                                                       $cmpnnyCategory = $row_p['businesscategory'];
                                                                       $cmpnyProdServ = $row_p['companyProductService'];
                                                                       $cmpnySize = $row_p['CompanySize'];
                                                                       $cmpnySpeclities = $row_p['skill'];
                                                                       $about = $row_p['BussinessOverview'];
                                                                       $cmpnyRevenue = $row_p['cmpyRevenue'];
                                                                       $cmpnyLanguage = $row_p['languageSpoken'];
                                                                       $cmpnyFounded = $row_p['yearFounded'];
                                                                       $cmpnyOwnership = $row_p['CompanyOwnership'];
                                                                       $cmpnyOperatingHour = $row_p['operatinghours'];
                                                                       $cmpnyStockSymbol = $row_p['stockSymbol'];
                                                                       $cmpnyStockWeblink = $row_p['cmpnyStockLink'];

																							// echo "<pre>";
																							//print_r($row);

                                                                   }
                                                                   ?>
                                                                   <tr>
                                                                    <td>Company Name</td>
                                                                    <td><?php echo $cmpnyName; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Company Sector (Category)</td>
                                                                    <td><?php echo $cmpnnyCategory;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Product And Services</td>
                                                                    <td><?php echo $cmpnyProdServ;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Company size</td>
                                                                    <td><?php echo $cmpnySize;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Company Revenue</td>
                                                                    <td><?php echo $cmpnyRevenue;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Language Spoken</td>
                                                                    <td><?php echo $cmpnyLanguage;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Year Founded</td>
                                                                    <td><?php echo $cmpnyFounded;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ownership</td>
                                                                    <td><?php echo $cmpnyOwnership;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Operating Hours</td>
                                                                    <td><?php echo $cmpnyOperatingHour;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stock Symbol</td>
                                                                    <td><?php echo $cmpnyStockSymbol;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stock Weblink</td>
                                                                    <td><?php echo $cmpnyStockWeblink;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Company Specialities</td>
                                                                    <td><?php echo $cmpnySpeclities;?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Region (city/Province)</td>
                                                                    <td><?php echo (isset($row4['city_title']))?$row4['city_title']:'';?> , <?php echo (isset($row5['state_title']))?$row5['state_title']:'';?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Business Overview</td>
                                                                    <td><?php echo $about;?></td>
                                                                </tr>


                                                            </body>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- JOB BOARD PROFILE DETAIL -->
                                        <div id="menu1" class="tab-pane fade">
                                           <h3 class="heading11">Job</h3> 
                                                 
                                                    
                                                    
                                                        <?php
                                                                           // $m = new  _postingview;
                                                        $m = new  _jobpostings;
                                                                           // $result = $m->myProfilejobpost($_GET['business']);
                                                        $result = $m->myProfilejobpost($_GET['business']);
                                                                            //echo $m->ta->sql;
                                                        if($result){
                                                            while ($row = mysqli_fetch_assoc($result)) { 
                                                                $postDate = new DateTime($row['spPostingDate'])
                                                                ?>
                                                               
                                                               <div class="job-content">
    <div class="job-card" style="font-size: 16px;">
        <div class="row">
            <div class="col-sm-12 col-sm-12">
                <div class="card-primary">
                    <div class="col-md-9 col-sm-12">
                        <div class="pri-head">
                            <a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="head-link"><?php echo ucfirst($row['spPostingTitle']); ?></a>



                            <?php
                            // Creates DateTime objects
                            $date = strtotime($row["spPostingDate"]);
                            $date1 = date('Y-m-d');
                            $date2 = $row["spPostingExpDt"];

                            $date1_ts = strtotime($date1);
                            $date2_ts = strtotime($date2);
                            $diff = $date2_ts - $date1_ts;


                            ?>
                            <span class="head-days"><?php echo round($diff / 86400); ?> days left</span>

                            <span class="new-head">New</span>
                        </div>
                        <div class="pri-head">
                            <?php

                            $usercountryn = $row["spPostingsCountry"];
                            $userstaten = $row["spPostingsState"];
                            $usercityn = $row["spPostingsCity"];

                            $co = new _country;
                            $result3 = $co->readCountry();
                            if ($result3 != false) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    if (isset($usercountryn) && $usercountryn == $row3['country_id']) {
                                        $currentcountryn = $row3['country_title'];
                                        $currentcountry_id = $row3['country_id'];
                                    }
                                }
                            }

                            if (isset($userstaten) && $userstaten > 0) {
                                $countryId = $currentcountry_id;
                                $pr = new _state;
                                $result2 = $pr->readState($countryId);
                                if ($result2 != false) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                        if (isset($userstaten) && $userstaten == $row2["state_id"]) {
                                            $currentstate_id = $row2["state_id"];
                                            $currentstaten = $row2["state_title"];
                                        }
                                    }
                                }
                            }
                            if (isset($usercityn) && $usercityn > 0) {
                                $stateId = $currentstate_id;
                                $co = new _city;
                                $result3 = $co->readCity($stateId);
                                //echo $co->ta->sql;
                                if ($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        if (isset($usercityn) && $usercityn == $row3['city_id']) {
                                            $currentcityn = $row3['city_title'];
                                            $currentcity_id = $row3['city_id'];
                                        }
                                    }
                                }
                            };
                            ?>
                            <?php
                            if (!empty($currentcountryn)) {
                                echo $currentcountryn;
                            }
                            if (!empty($currentstaten)) {
                                echo ', ' . $currentstaten;
                            }
                            if (!empty($currentcityn)) {
                                echo ', ' . $currentcityn;
                            }
                            ?>
                        </div>
                        <?php
                        $string = strip_tags($row['spPostingNotes']);
                        if (strlen($string) > 200) {

                            // truncate string
                            $stringCut = substr($string, 0, 200);
                            $endPoint = strrpos($stringCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '... <a href=' . $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings'] . '>Read More</a>';
                        }

                        ?>
                        <p class="pri-para"><?php echo ucfirst($string); ?></p>
                        <div class="pri-tags">
                            <?php
                            $skills = explode(',', $row['spPostingSkill']);
                            foreach ($skills as $key => $value) {
                            ?>
                                <a><?php echo ucfirst($value); ?></a>

                            <?php
                            } ?>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <div class="card-secondary">
                            <div class="price">
                                <?php if ($row['spPostingSlryRngFrm'] > 0) {
                                    echo $row['job_currency'] . ' ' . $row['spPostingSlryRngFrm'] . ' - ' . $row['job_currency'] . ' ' . $row['spPostingSlryRngTo'] . '';
                                } ?>
                            </div>
                            <div class="avg-btn">
                                <a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>" class="avg-bid btn zoom1">Apply now </a>
                            </div>
                            <div class="location-btn">
                                <a href="#" class="loc-btn"><?php echo ucfirst($row["spPostingLocation"]); ?> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
                                                               <?php  }
                                                            }else{?>
                                                        <center>No Record Found</center>
                                                           <?php }
                                                            ?>
                                                       
                                            </div>
                                            <!-- THIS IS VIDEO SECTON -->
                                            <div id="menu2" class="tab-pane fade">
                                                <?php include('myvideo.php');?>
                                            </div>
                                            <!-- THIS IS ADDITIONAL INFORMATION -->
                                            <div id="menu3" class="tab-pane fade">
                                                <h3 class="heading11">Additional Information</h3>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped ">
                                                                <body>
                                                                    <?php 

                                                                    $p = new _spbusiness_profile;

                                                                    $rpvt = $p->read($_GET["business"]);

                                                                    if ($rpvt != false){
                                                                       $row = mysqli_fetch_assoc($rpvt);
                                                                       $cmpnyRevenue = $row['cmpyRevenue'];
                                                                       $cmpnyLanguage = $row['languageSpoken'];
                                                                       $cmpnyFounded = $row['yearFounded'];
                                                                       $cmpnyOwnership = $row['CompanyOwnership'];
                                                                       $cmpnyOperatingHour = $row['operatinghours'];
                                                                       $cmpnyStockSymbol = $row['stockSymbol'];
                                                                       $cmpnyStockWeblink = $row['cmpnyStockLink'];

																							// echo "<pre>";
																							//print_r($row);

                                                                   }
                                                                   ?>

                                                                   <tr>
                                                                    <td>Company Revenue</td>
                                                                    <td><?php echo $cmpnyRevenue; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Language Spoken</td>
                                                                    <td><?php echo $cmpnyLanguage; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Year Founded</td>
                                                                    <td><?php echo $cmpnyFounded; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ownership</td>
                                                                    <td><?php echo $cmpnyOwnership; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Operating Hours</td>
                                                                    <td><?php echo $cmpnyOperatingHour; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stock Symbol</td>
                                                                    <td><?php echo $cmpnyStockSymbol; ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Stock Weblink</td>
                                                                    <td><?php echo $cmpnyStockWeblink; ?></td>
                                                                </tr>


                                                            </body>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- SHOW MY ALL STORE PRODUCTS -->
                                        <div id="menu4" class="tab-pane fade">
                                            <h3 class="heading11">Store</h3>
                                            <?php include('store.php');?>
                                        </div>
                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu8" class="tab-pane fade">
                                            <h3 class="heading11">Real Estate</h3>
                                            <?php include('real-estate.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu9" class="tab-pane fade">
                                            <h3 class="heading11">Rental</h3>
                                            <?php include('rental.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu10" class="tab-pane fade">
                                            <h3 class="heading11">Freelancer</h3>
                                            <?php include('freelan.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu11" class="tab-pane fade">
                                            <h3 class="heading11">Events</h3>
                                            <?php include('events.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu12" class="tab-pane fade">
                                            <h3 class="heading11">Art and Craft</h3> 
                                            <?php include('art_craft.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu13" class="tab-pane fade">
                                            <h3 class="heading11">Classified Ad</h3> 
                                            <?php include('classified.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu14" class="tab-pane fade">
                                            <h3 class="heading11">My Business Space</h3> 
                                            <?php include('business_space.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu15" class="tab-pane fade">
                                            <h3 class="heading11">Business for Sale </h3> 
                                            <?php include('business_sale.php');?>
                                        </div>

                                        <!-- SHOW MY ALL REAL ESTATE PRODUCTS -->
                                        <div id="menu16" class="tab-pane fade">
                                            <h3 class="heading11">Trainings</h3>  
                                            <?php include('trainings.php');?>
                                        </div>

                                        <!-- THIS IS NEWS DESCRIPTION -->
                                        <div id="menu5" class="tab-pane fade">
                                            <h3 class="heading11">News</h3>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Title</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $cn = new _company_news;
                                                        $result1 = $cn->readMyNews($_GET['business']);
                                                                            //echo $cn->ta->sql;
                                                        if($result1){
                                                            while ($row = mysqli_fetch_assoc($result1)) { 
                                                                $postTime = strtotime($row['cmpanynewsdate']); ?>
                                                                <tr>
                                                                    <td style="width: 100px;"><?php echo date("d-M-Y", $postTime); ?></td>
                                                                    <td><a href="javascript:void(0)" class="readCmpnyNews" data-newsid="<?php echo $row['idcmpanynews'];?>" data-toggle="modal" data-target="#cmpnyNewsModal"  ><?php echo $row['cmpanynewsTitle']?></a></td>

                                                                </tr>
                                                                <?php
                                                            }
                                                        }else{
echo "<td colspan='6'><center>No Record Found</center></td>";
}
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- CONTACT INFORMATION SHOW -->
                                        <div id="menu6" class="tab-pane fade">
                                            <h3 class="heading11">Contact Information</h3>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><?php
                                                    $pr = new _spprofiles;
                                                    $country = 0;
                                                    $state = 0;
                                                    $city = 0;
                                                    $profile_country = '';
                                                    $profile_state='';
                                                    $profile_city='';
                                                    $result  = $pr->read($_GET['business']);
                                                    $sprows = mysqli_fetch_assoc($result);
                                                    $country = $sprows["spProfilesCountry"];
                                                    $state = $sprows['spProfilesState'];
                                                    $city = $sprows["spProfilesCity"];
                                                    $profile_additional_address = $sprows["address"];
                                                    echo $profile_additional_address;?>, <br><?php echo (isset($row4['city_title']))?$row4['city_title']:'';?>,<?php (isset($row5['state_title']))?$row5['state_title']:'';?><br><?php echo isset($row3['country_title'])?$row3['country_title']:''; ?></p>
                                                    <p><strong>Postal Code</strong> : <?php echo $postalCode; ?></p>
                                                    <p><strong>Phone No</strong> &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $cmpnyPhone; ?></p>
                                                    <p><strong>Email</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $cmpnyEmail ?></p>
                                                    <?php 
                                                    $p = new _spbusiness_profile;

                                                    $rpvt = $p->read($_GET["business"]);

                                                    if ($rpvt != false){
                                                       $row = mysqli_fetch_assoc($rpvt);
                                                       $cmpnyWebsite = $row['CompanyWebsite'];


																							// echo "<pre>";
																							//print_r($row);

                                                   }

                                                   ?>

                                                   <p><strong>Website</strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <a href="<?php echo $cmpnyPhone;?>" target="_blank"><?php echo $cmpnyWebsite; ?></a></p>
                                               </div>
                                               <div class="col-md-4">
                                                <script>
                                                    function initMap() {
                                                        var map = new google.maps.Map(document.getElementById('map'), {
                                                            zoom: 5,
                                                            center: {lat: -34.397, lng: 150.644}
                                                        });
                                                        var geocoder = new google.maps.Geocoder();
                                                        geocodeAddress(geocoder, map);
                                                    }
                                                    function geocodeAddress(geocoder, resultsMap) {
                                                        var address = "<?php echo $row4['city_title'].' '.$row3['country_title']; ?>";
                                                                //alert(address);
                                                                geocoder.geocode({'address': address}, function(results, status) {
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
                                                        <div class="ArtistSong map_serv_detail m_btm_15">
                                                            <div id="map" style="width: 177%;height: 30%;"></div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <!-- CONTACT INFORMATION SHOW -->
                                            <div id="menu7" class="tab-pane fade">
                                                <h3 class="heading11">Gallery</h3>
                                                <div class="row">
                                                    <?php
                                                    $dg = new _direcctory_gallery;
                                                    $result = $dg->mygallery($_SESSION['pid']);
                                                    if($result){
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            ?>
                                                            <div class="col-md-3">
                                                                <div class="EvntImg">
                                                                    <a class="thumbnail" rel="lightbox[group]" href="<?php echo $BaseUrl.'/upload/directory-gallery/'.$row['gallery_img'];?>" title="">
                                                                        <img class="group1" src="<?php echo $BaseUrl.'/upload/directory-gallery/'.$row['gallery_img'];?>" style="height: 150px;">
                                                                    </a>

                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <!-- End tabs -->
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="space"></div>

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
<!-- THIS IS DESCRIPTION OF NEWS -->
<div id="cmpnyNewsModal" class="modal fade" role="dialog">
    <div class="modal-dialog sharestorepos">
        <!-- Modal content-->

        <div class="modal-content no-radius">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">News Description</h4>
            </div>
            <div class="modal-body">
                <div id="loadNews"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>
        </div>

    </div>
</div>
<?php 

include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<!-- image gallery script strt -->
<script src="<?php echo $BaseUrl;?>/assets/js/jquery.prettyPhoto.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&callback=initMap"></script>
<script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
        g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g,s)}(document,'script'));
            // Colorbox Call
            $(document).ready(function(){
                $("[rel^='lightbox']").prettyPhoto();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                //Rating Testing
                $("#buss_postrating .stars").click(function () {
                    $("#spPostRating").val($(this).val());
                    var userId = <?php echo $_SESSION['pid']?>;
                    var bussId = <?php echo $_GET['business']?>;
                    $.post('../social/businessRating.php', {rating: $(this).val(), profileid: userId, bussinessId: bussId}, function (d) {
                    });
                });
            });
        </script>
        <!-- image gallery script end -->
    </body>
    </html>
    <?php
} ?>



<!-- $records = mysqli_num_rows($res);
                                                        $total_pages = ceil($records / $limit);
                                                        
                                                        $pagLink = "<ul class='pagination'>";  
                                                        for ($i=1; $i<=$total_pages; $i++) {
                                                            $pagLink .= "<li class='page-item'><a class='page-link' href='allads.php?page=".$i."'>".$i."</a></li>";   
                                                            }
                                                            echo $pagLink . "</ul>"; -->