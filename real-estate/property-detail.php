<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    include_once("../authentication/check.php");
    $_SESSION['afterlogin'] = "timeline/";
}
if (!function_exists('sp_autoloader')){

    function sp_autoloader($class)
    {
        include '../mlayer/' . $class . '.class.php';
    }
}
spl_autoload_register("sp_autoloader");
$re = new _redirect;
$p = new _realstateposting;
$pf  = new _postfield;

$_GET["categoryID"] = "3";
$_GET["categoryName"] = "Realestate";
$postId = !empty($_GET['postid']) ? (int)$_GET['postid'] : "";
if ($postId > 0) {


    //all detail of single product
    $result = $p->singletimelines($postId);
    //echo $p->ta->sql;
    if ($result != false) {
        $row = mysqli_fetch_assoc($result);
        //print_r($row);
        $OwnerId   = $row['spProfiles_idspProfiles'];
        //	echo $_SESSION['pid'];
        $poster_data = $p->getPosterData($OwnerId);
        if ($poster_data) {
            $poster = mysqli_fetch_assoc($poster_data);
        }
        // echo "<pre>";
        // 	print_r($poster);
        $seller_image=$row['saller_picture'];
        $seller_name=$row['seller_name'];
        $OwnerName = $poster['spProfileName'];
        $OwnerAbout = $poster['spProfileAbout'];
        $OwnerPic  = $poster['spProfilePic'];
        $phoneNo    = $poster['spProfilePhone'];
        $poster_email    = $poster['spProfileEmail'];
        $country    = $row['spPostingsCountry'];
        $ProTitle   = $row['spPostingTitle'];
        $ProDes     = $row['spPostingNotes'];

        $price      = $row['spPostingPrice'];
        $defaltcurrency      = $row['defaltcurrency'];
        $seller_mnumber      = $row['seller_mnumber'];

        $spPostingOpenHouse      = $row['spPostingOpenHouse'];
        $openHouseDayone      = $row['openHouseDayone'];
        $openHouseDayoneStrtTime      = $row['openHouseDayoneStrtTime'];
        $openHouseDayoneEndTime      = $row['openHouseDayoneEndTime'];


        $state      = $row['spPostingsState'];
        $city      = $row['spPostingsCity'];
        $postDate = $row['spPostingDate'];
        $proStatus = $row['spPostingPropStatus'];
        $keyword = $row['spPostingkeyword'];
        $housStylle = $row['spPostingHouseStyle'];
        $taxYear = $row['spPostTaxYear'];
        $taxAmt = $row['spPostTaxAmt'];
        $unitNumber = $row['spPostUnitNum'];
        $squarefoot = $row['spPostingSqurefoot'];
        $basement = $row['spPostBasement'];
        $yearBuilt = $row['spPostingYearBuilt'];
        $postalCode = $row['spPostingPostalcode'];
        $bathroom = $row['spPostingBathroom'];
        $spPartialPostingBathroom = $row['spPartialPostingBathroom'];
        $bedroom = $row['spPostingBedroom'];
        $address = $row['spPostingAddress'];
        $propertyId = $row['spPostListId'];
        $propertyType = $row['spPostingPropertyType'];
        $community = $row['community'] ? $row['community'] : "";
        $lotSize = $row['lotSize'] ? $row['lotSize'] : "";
        



    }
} else {
    $redirctUrl = $BaseUrl . "/real-estate";
    $re->redirect($redirctUrl);
}
$header_realEstate = "realEstate";


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <?php include('../component/links.php'); ?>
    <?php include('../component/f_links.php'); ?>
    <!--This script for posting timeline data Start-->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
    <!--This script for posting timeline data End-->



    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ"></script>
    <script src="<?php echo $BaseUrl . '/assets/js/jquery.geocomplete.js'; ?>"></script>
    <style>
        .carousel-control.left {
            background-image: none;
        }

        .carousel-control.right {
            background-image: none;
        }
    </style>
    <script type="text/javascript">
        jQuery(document).ready(function($) {


            var options = {
                map: ".map_canvas",
                location: "<?php echo $address; ?>",
                zoom: 13
            };
            $("#geocomplete").geocomplete(options);

            /*$('#myCarousel').carousel({
                interval: 5000
            });
            $('#carousel-text').html($('#slide-content-0').html());
            //Handles the carousel thumbnails
            $('[id^=carousel-selector-]').click(function() {
                var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                var id = parseInt(id);
                $('#myCarousel').carousel(id);
            });
            // When the carousel slides, auto update the text
            $('#myCarousel').on('slid.bs.carousel', function(e) {
                var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-' + id).html());
            });*/
        });
    </script>

    <style>
        .layerPrprtyTop {
            display: block;
            height: 40px;
            width: 100%;
            background-color: rgba(0, 0, 0, .8);
            margin-top: -10px;

            .realTopBread {
                padding: 10px;
                / background-image: url(../images/real/in-bg-real.jpg);/ background-color: #6a7e3b;
                background-size: cover;
            }
    </style>

    <!-- Design.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
</head>
<style>
    .row.top_pro_detail {
        margin-bottom: 8px;
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

<body class="bg_gray">
    <?php include_once("../header.php"); ?>
    <section class="realTopBreadtop" style="background-color:#6a7e3b !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row" style="margin-top:22px">
                        <div class="col-md-6">
                            <div class="text-left agentbreadCrumb" style="margin-bottom: -7px; margin-left: 17px;">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo $BaseUrl . '/real-estate'; ?>">Home</a></li>
                                    <li style="color:white"><a><?php echo ucwords(strtolower($ProTitle)); ?><a /></li>
                                </ol>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="text-right">
                                <?php include_once("top-buttons.php"); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="layerPrprtyTop" style="
    background-color: #056608; 
">
        <ul>
            <li>Property Id: <?php echo $propertyId; ?></li>
            <li>Property Type: <?php echo $propertyType; ?></li>
            <li>Updated ON: <?php echo $postDate; ?></li>
        </ul>
    </div>
    <section class="">
        <div class="container">
            <div class="space-md"></div>
            <div class="row top_pro_detail">
                <div class="col-md-6">
                    <h2><?php echo ucwords(strtolower($ProTitle)); ?></h2>
                    <!-- <p><?php echo $address; ?></p>-->
                    <?php if ($price != '') { ?>
                      <p><span><?php echo $defaltcurrency . ' ' . number_format($price); ?></span></p>
                    <?php } ?>
                </div>

                <div class="col-md-2">

                   <!-- <div class="" role="alert" style="text-align: center; margin-top:30px">
                        <?php if ($price != '') { ?>
                            <span><?php echo $defaltcurrency . ' ' . $price; ?></span>
                        <?php } ?>
                    </div> -->

                </div>

                <div class="col-md-4">
                    <!-- Modal -->
                    <div id="flagPost" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <form method="post" action="addtoflag.php" class="sharestorepos">
                                <div class="modal-content no-radius">
                                    <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postId; ?>">
                                    <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                    <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID'] ?>">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Flag Post</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="radio">
                                            <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
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
                                        <textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="" class="btn butn_mdl_submit ">
                                        <button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="text-right bokmarktab">

                        <br>

                        <?php if (isset($_GET['msg']) && $_GET['msg'] == 1) { ?>
                            <div class="alert alert-success" role="alert" style="width: 312px;float: right;margin-top: -24px;">
                                Your message has been sent successfully.
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="bg_white setupProperty about_postbanner">
                <div class="row">
                    <div class="col-md-8">



                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $pc = new _realstatepic;
                                $res = $pc->read($postId);
                                //echo $pc->ta->sql;
                                $active1 = 0;
                                if ($res != false) {
                                    $active2 = 0;
                                    while ($postr = mysqli_fetch_assoc($res)) {
                                        $picture = $postr['spPostingPic'];
                                        if ($active2 == 0) {
                                            $pic = 'active';
                                        } else {
                                            $pic = '';
                                        }
                                        if (isset($picture)) {
                                        } else {
                                            $picture = "../img/no.png";
                                        }
                                        echo  '<div class="item ' . $pic . '">
													  <img src="' . $picture . '" alt="Los Angeles" style="width:100%;">
													</div>';

                                        $active2++;
                                    }
                                } else { ?>
                                    <img src="../img/no.png" alt="Posting Pic" class="img-responsive" style="margin: 0 auto;"><?php
                                                                                                                            }
                                                                                                                                ?>

                            </div>

                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>

                    </div>
                    <?php //if ($OwnerId = $_SESSION['pid']) { 
                    ?>
                    <div class="col-md-4">
                        <div class="rightProperty">
                            <div class="row">

                                <div class="col-md-12">

                                    <h2 class="leftH">Contact Agent for this property</h2>
                                    <div class="row">
                                        <div class="col-md-3" style="padding-bottom: 15px;">
                                            <?php
                                            if ($seller_image != '') {
                                                echo "<img alt='Posting Pic' class='img-circle freelancername' src=' " . ($seller_image) . "' >";
                                            } else {
                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive freelancername'>";
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-9 rit_pro_detail no-padding">
                                            <a href="<?php echo $BaseUrl . '/real-estate/agent-detail.php?postId=' . $postId; ?>" class="freelancername"><?php echo $seller_name; ?></a>
                                            <p></p>
                                        </div>
                                    </div>
                                    <form method="post" action="sendEnquiry.php" class="enqRealForm">
                                        <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postId; ?>">
                                        <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="text" pattern="[a-zA-Z]*" onkeypress="return (event.charCode > 64 && 
	event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" name="sprealName" class="form-control projetproperty_btn" placeholder="Full Name" required="">
                                        <input type="email" name="sprealEmail" class="form-control projetproperty_btn" placeholder="Email" required="">
                                        <input type="number" name="sprealPhone" class="form-control projetproperty_btn" placeholder="Phone" required="" style="background-color: #edeef0;">
                                        <textarea class="form-control" name="sprealMessage" placeholder="I'm Interested in this...." style="margin-top:5px;"></textarea>

                                        <?php if ($OwnerId != $_SESSION['pid']) {
                                            if ($_SESSION['guet_yes'] != 'yes') { ?>

                                                <input type="submit" value="Send Enquiry" style=" background-color: #acdf31 !important; " class="btn  projetproperty_btn <?php //echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';
                                                                                                                                                                            ?> " <?php //echo ($_SESSION['pid'] == $OwnerId )?'disabled':'';
                                                                                                                                                                                                                                            ?>>
                                        <?php }
                                        } ?>


                                    </form>
                                    <style>
                                        .fa-calculator:hover {
                                            color: #428bca !important;
                                        }

                                        .fa-calculator {
                                            color: #428bca !important;
                                        }
                                    </style>
                                    <div class="" style="margin-top:10px;margin-left: 30px;">
                                        <?php
                                        $fv = new _favorites;
                                        //$res_fv="";
                                        $res_fv = $fv->chekFavourite($postId, $_SESSION['pid'], $_SESSION['uid']);
                                        //echo $fv->ta->sql;
                                        //die('==');
                                        if ($res_fv != false) { ?>
                                            <span class="appendheart"><a href="javascript:void(0)" onclick="favoriteremove()" id="remtofavoritesevent" data-postid="<?php echo $postId; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
                                                    <i class="fa fa-heart" style="font-size: 20px;"></i>&nbsp Unfavourite</span>

                                            </a><?php

                                            } else {
                                                ?>
                                            <span class="appendheart"> <a href="javascript:void(0)" onclick="favoritereadd()" id="addtofavouriteevent" data-postid="<?php echo $postId; ?>" data-pid="<?php echo $_SESSION['pid']; ?>">
                                                    <i class="fa fa-heart-o" style="font-size: 20px;"></i>&nbsp Favourite</span>

                                            </a>
                                        <?php
                                            }

                                        ?>



                                        <p class="float-right" style="    margin-right: 30px;">
                                            <?php
                                            $pids = $_SESSION['pid'];
                                            $sp = new _flagpost;
                                            $spflag = $sp->readflag2($pids, $postId);
                                            if ($_SESSION['guet_yes'] != 'yes') {
                                                if ($spflag != false) {

                                            ?>
                                        <span class="sel_chat" onclick="flags()"><i class="fa fa-flag" style="color: #035049;
    font-size: 15px;"></i> &nbsp; <a>Flag this post</a></span>

    
                                        <p id="flags" style="color:red;font-size:15px; float:right; margin-top:-12px;"></p>
                                    <?php  } else {
                                    ?>
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost"><i class="fa fa-flag"></i> Flag This Post</a>
                                <?php }
                                            } ?>
                                </p>
                                    </div>
                                    <div class="" style=" margin-top: 15px; display: flex;">
                                        <a href="javascript:void(0)" class="btn btn_calculator" style="width: auto;" data-toggle="modal" data-target="#exampleCalcul"><i class="fa fa-calculator"></i></a>
                                        <a href="javascript:void(0)" class="btn butn_draf btn-border-radius" data-toggle="modal" data-target="#exampleModal" style=" background-color: #acdf31 !important; float:right ; margin:1% ; padding: 2%;"><i class="fa fa-phone"></i> Call Agent</a>
                                        <a href="<?php echo $BaseUrl . '/real-estate/agent-detail.php?postId=' . $postId; ?>" class="btn butn_draf btn-border-radius" style=" background-color: #acdf31 !important; margin:1% ; padding: 2%;"><i class="fa fa-user"></i> View Agent Listing</a>
                                    </div>

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







                                </div>

                            </div>
                        </div>
                    </div>
                    <?php //} 
                    ?>
                </div>

            </div>
            <div class="space"></div>

            <div class="row">
                <div class="col-md-8">
                    <div class="bg_white four_d_pro m_btm_20">
                        <div class="row">
                            <?php if ($propertyType != "Land/lot") { ?>
                                <div class="col-md-3">
                                    <p><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-b-2.png"> <?php echo ($bedroom > 0) ? $bedroom : 0; ?> Bed</p>
                                </div>
                                <div class="col-md-3">
                                    <p><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-b-3.png"> <?php echo ($bathroom > 0) ? $bathroom : 0; ?> Bath</p>
                                </div>
                            <?php } ?>
                            <div class="col-md-3">
                                <p><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-b-4.png"> <?php echo $squarefoot; ?> Square Foot</p>
                            </div>
                            <?php if ($propertyType != "Land/lot") { ?>
                                <div class="col-md-3">
                                    <p class="last"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-b-1.png"> <?php echo ($basement > 0) ? $basement : 0; ?> Basement</p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- MODEL FOR CALCULATOR -->
                <div class="modal fade" id="exampleCalcul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content sharestorepos no-radius">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Mortgage Calculator</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <?php
                                            if ($price != '') {
                                                $newPrice = preg_replace("/[^0-9]/", "", $price);

                                                $down = 0.2 * $newPrice;
                                            }
                                            ?>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Purchase Price</label>
                                                    <input type="text" name="" class="form-control" id="txtPurchasePrice" value="<?php echo $price; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Mortage Amount</label>
                                                    <input type="text" name="" class="form-control" id="txtMortageAmt" readonly="" value="<?php echo $newPrice - $down; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label>Down Payment</label>
                                                    <input type="text" name="" class="form-control" id="txtDownPaymnt" value="<?php echo $down; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Percent</label>
                                                    <input type="text" name="" class="form-control perC_pad" value="20" id="txtPercntage">
                                                    <span id="calPer">%</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Amortization</label>
                                                    <select class="form-control" id="txtAmortaztion">
                                                        <option value="5">5 Year</option>
                                                        <option value="10">10 Year</option>
                                                        <option value="15">15 Year</option>
                                                        <option value="20">20 Year</option>
                                                        <option value="25">25 Year</option>
                                                        <option value="30">30 Year</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Type And Term</label>
                                                    <select class="form-control" id="txtTypeTerm">
                                                        <option value="1">1 Yr Fixed</option>
                                                        <option value="2">2 Yr Fixed</option>
                                                        <option value="3">3 Yr Fixed</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Interest Rate</label>
                                                    <input type="text" name="" class="form-control perC_pad" value="2.00" id="txtIntrstRate">
                                                    <span id="calPer">%</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="bg_gray text-center right_cal" style="min-height: 260px;padding-top: 73px;">
                                            <?php
                                            $principal      = $newPrice; //Mortgage Amount 
                                            $interest_rate  = 2.00; //Interest Rate %
                                            //$down = $principal *0.20; //20% down payment
                                            $down_remain    = $down;
                                            $years          = 5;
                                            $months         = 0;
                                            $compound       = 2; //compound is always set to 2
                                            $frequency      = 12; //Number of months (Monthly (12), Semi-Monthly (24), Bi-Weekly(26) and Weekly(52) 

                                            function calcPay($MORTGAGE, $AMORTYEARS, $AMORTMONTHS, $INRATE, $COMPOUND, $FREQ, $DOWN)
                                            {
                                                $MORTGAGE = $MORTGAGE - $DOWN;
                                                $compound = $COMPOUND / 12;
                                                $monTime = ($AMORTYEARS * 12) + (1 * $AMORTMONTHS);
                                                $RATE = ($INRATE * 1.0) / 100;
                                                $yrRate = $RATE / $COMPOUND;
                                                $rdefine = pow((1.0 + $yrRate), $compound) - 1.0;
                                                $PAYMENT = ($MORTGAGE * $rdefine * (pow((1.0 + $rdefine), $monTime))) / ((pow((1.0 + $rdefine), $monTime)) - 1.0);
                                                if ($FREQ == 12) {
                                                    return $PAYMENT;
                                                }
                                                if ($FREQ == 26) {
                                                    return $PAYMENT / 2.0;
                                                }
                                                if ($FREQ == 52) {
                                                    return $PAYMENT / 4.0;
                                                }
                                                if ($FREQ == 24) {
                                                    $compound2 = $COMPOUND / $FREQ;
                                                    $monTime2 = ($AMORTYEARS * $FREQ) + ($AMORTMONTHS * 2);
                                                    $rdefine2 = pow((1.0 + $yrRate), $compound2) - 1.0;
                                                    $PAYMENT2 = ($MORTGAGE * $rdefine2 * (pow((1.0 + $rdefine2), $monTime2))) /  ((pow((1.0 + $rdefine2), $monTime2)) - 1.0);
                                                    return $PAYMENT2;
                                                }
                                            }

                                            $payment = calcPay($principal, $years, $months, $interest_rate, $compound, $frequency, $down_remain);

                                            ?>
                                            <h3 id="calMorggae"><?php echo $defaltcurrency; ?>
                                                <?php echo $result = round($payment); ?></h3>
                                            <p>Monthly</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                         <p style="font-size: 12px;">Type and Term and associated rates are the latest published values from the Bank of Canada.</p>
                                        <p style="font-size: 12px;">The Mortgage Payment Calculator is only for basic estimation purposes only and is not part of the application process. Payment amounts are based on the information you provide and may change upon consultation with a mortgage professional.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal call agent -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content sharestorepos">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel" style="display: inline-block;">Call Agent</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mobModel" style="">

                                <h2><i class="fa fa-phone"></i> Phone Number <span class="pull-right"><?php echo  $seller_mnumber; ?></span></h2>
                            </div>

                        </div>
                    </div>
                </div>
                <?php



                if ($openHouseDayone != "") {
                    //die("--------------");
                    //echo $openHouseDayone; die("--------------");
                    // $dt = new DateTime($openHouseDayone); 

                    $dayName = "";
                    $monName = "";
                    $yearu = "";
                }
                ?>
                <?php

                if ($openHouseDayone != "") {


                    if ($spPostingOpenHouse == 'Yes') { ?>
                        <div class="col-md-4 bg_white" style=" width: 369px; ">
                            <b style="color:#95ba3d;">Open house: <?php echo $openHouseDayone; ?><br> <?php echo date('h:i A', strtotime($openHouseDayoneStrtTime)); ?> - <?php echo date('h:i A', strtotime($openHouseDayoneEndTime)); ?></b>
                        </div>
                <?php }
                } ?>
            </div>

            <div class="bg_white setupPropertysetleft about_postbanner">
                <div class="row">
                    <div class="col-md-5">
                        <h2>Summary</h2>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>Price</td>
                                        <td><?php if($price != '') {echo $defaltcurrency . ' ' . number_format($price);} ?></td>
                                    </tr>
                                    <tr>
                                        <td>Square Footage</td>
                                        <td><?php echo $squarefoot; ?></td>
                                    </tr>
                                    <?php if($propertyType == "Detached House"){ ?>
                                    <tr>
                                        <td>Lot Size</td>
                                        <td><?php echo $lotSize; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>Status</td>
                                        <td><?php echo $proStatus; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Property Type</td>
                                        <td><?php echo $propertyType; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Location</td>
                                        <td><?php echo $address; ?></td>
                                    </tr>
                                    <?php if ($propertyType != "Land/lot") { ?>
                                        <tr>
                                            <td>Bedrooms</td>
                                            <td><?php echo ($bedroom > 0) ? $bedroom : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Full Bathrooms</td>
                                            <td><?php echo ($bathroom > 0) ? $bathroom : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Partial Bathrooms</td>
                                            <td><?php echo ($spPartialPostingBathroom > 0) ? $spPartialPostingBathroom : 0; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Basement</td>
                                            <td><?php echo ($basement > 0) ? $basement : 0; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>Postal Code</td>
                                        <td><?php echo $postalCode; ?></td>
                                    </tr>
                                    <?php if ($propertyType != "Land/lot") { ?>
                                        <tr>
                                            <td>Year Built</td>
                                            <td><?php echo $yearBuilt; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Unit Number</td>
                                            <td><?php echo $unitNumber; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tax Amount</td>
                                            <td><?php echo $taxAmt; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tax year</td>
                                            <td><?php echo $taxYear; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Community</td>
                                            <td><?php echo $community; ?></td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-7">
                        
                        <h2>Property Description</h2>
                        <p class="text-justify"><?php echo $ProDes; ?></p>
                        
                        <?php
                        $result6 = $pf->readCustomPost($postId, "spPostHighLit_");
                        //echo $pf->ta->sql."<br>";
                        if ($result6 != false) {
                        ?>
                        <h3>Features</h3>
                        <div class="bg_gray rightGrayFeature">
                            <div class="row">
                                <div class="col-md-12 proFeaturTag">
                                    <?php
                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                        if ($row6['spPostFieldValue'] != '') {
                                            echo "<span>" . $row6['spPostFieldValue'] . "</span>";
                                        }
                                    }                                
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php                        
                        }
                        ?>
                
                        <h3>House Style</h3>
                        <p class="text-justify"><?php echo $housStylle; ?></p>

                        <h3>Address Map</h3>
                        <div class="row btmMappro">
                            <div class="col-md-12">
                                <div class="map_canvas" style="height: 495px"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            
        </div>
<!-- <div class="space"></div> -->
<div class="container">         
<!-- <div class="space-lg"></div> -->
<div class="row">
<div class="col-md-12">
<div class="" role="alert" style="text-align: center; margin-top:30px">
<h1><b>Similar Listings Near you</b></h1>
</div>
</div>

<?php

$country=$_SESSION['spPostCountry'];
$state=$_SESSION['spPostState'];
$city=$_SESSION['spPostCity'];


$p = new _realstateposting;
$pf = new _postfield;
$type = "Sell";

$res = $p->showAllAdd($_GET["categoryID"], $type, $country, $state, $city);
//$res    = $p->publicpost_event($_GET["categoryID"]);
//echo $p->ta->sql;
if ($res != false) {
while ($row = mysqli_fetch_assoc($res)) {
//print_r($row);
if ($row['spuser_idspuser'] != NULL) {
$st = new _spuser;
$st1 = $st->readdatabybuyerid($row['spuser_idspuser']);
if ($st1 != false) {
$stt = mysqli_fetch_assoc($st1);
$account_status = $stt['deactivate_status'];
}
}
$pt = new _productposting;
$postids = $row['idspPostings'];
$flagcmd = $pt->flagcount(3, $postids);
$flagnums = $flagcmd->num_rows;
if ($flagnums == '9') {
$updatestatus = $pt->realstatus($idposting);
}
$address = $row['spPostingAddress'];
$bedroom = $row['spPostingBedroom'];
$bathroom = $row['spPostingBathroom'];
$sqrfoot = $row['spPostingSqurefoot'];
$basement = $row['spPostBasement'];
$propertyType = $row['spPostingPropertyType'];
$price = $row['spPostingPrice'];

//posting fields
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";

if ($account_status != 1) {
?>
<div class="col-md-3">
<div class="realBox">
<a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?postid=' . $row['idspPostings']; ?>">
<div class="boxHead">
<h2 class="text1"><?php echo $row['spPostingTitle']; ?></h2>
<p>
<i class="fa fa-map-marker"></i>
<?php
if (strlen($address) < 30) {
	echo $address;
} else {
	echo substr($address, 0, 30) . "...";
}
?>
</p>
</div>
<?php
$pic = new _realstatepic;

$res2 = $pic->readFeature($row['idspPostings']);
if ($res2 != false) {
if ($res2->num_rows > 0) {
if ($res2 != false) {
	$rp = mysqli_fetch_assoc($res2);
	$pic2 = $rp['spPostingPic'];
	echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
}
} else {
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
	$rp = mysqli_fetch_assoc($res2);
	$pic2 = $rp['spPostingPic'];
	echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
}
}
} else {
$res2 = $pic->read($row['idspPostings']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
} else {
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
}
} ?>
<div class="midLayer">
<ul>
<li title="Square Foot"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-1.png"><?php echo ($sqrfoot > 0) ? $sqrfoot : 0; ?></li>
<li title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0) ? $bedroom : 0; ?></li>
<li title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0) ? $bathroom : 0; ?></li>
<li title="Basement" class="text-right"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-4.png"><?php echo ($basement > 0) ? $basement : 0; ?></li>
</ul>
</div>
<div class="boxFoot bg_white text-center">
<p class="proType text1"><?php echo $propertyType; ?></p>
<p class="text1"><span><?php if($price != '') { echo $row['defaltcurrency'] . ' ' . number_format($price); } ?></span></p>
</div>
</a>
</div>
</div> <?php }
$limit++;
if ($limit > 8) {
break;
}
}
}
?>



</div>
<div class="space"></div>
</div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="realTitle text-center">
                        <!--                             <h2>Agent <span>Listing</span></h2> -->
                    </div>
                </div>
                <?php

                $start = 0;
                $limit = 1;
                $p      = new _realstateposting;
                $pf     = new _postfield;
                $res    = $p->getAgentList($_GET["categoryID"], $OwnerId);
                //echo $p->ta->sql;
                if ($res != false) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        //posting fields
                        $result_pf = $pf->read($row['idspPostings']);
                        //echo $pf->ta->sql."<br>";
                        if ($result_pf) {
                            $address = "";
                            $bedroom = "";
                            $bathroom = "";
                            $sqrfoot = "";
                            $basement = "";
                            $propertyType = "";

                            while ($row2 = mysqli_fetch_assoc($result_pf)) {

                                if ($propertyType == '') {
                                    if ($row2['spPostFieldName'] == 'spPostingPropertyType_') {
                                        $propertyType = $row2['spPostFieldValue'];
                                    }
                                }
                                if ($address == '') {
                                    if ($row2['spPostFieldName'] == 'spPostingAddress_') {
                                        $address = $row2['spPostFieldValue'];
                                    }
                                }
                                if ($bedroom == '') {
                                    if ($row2['spPostFieldName'] == 'spPostingBedroom_') {
                                        $bedroom = $row2['spPostFieldValue'];
                                    }
                                }
                                if ($bathroom == '') {
                                    if ($row2['spPostFieldName'] == 'spPostingBathroom_') {
                                        $bathroom = $row2['spPostFieldValue'];
                                    }
                                }
                                if ($sqrfoot == '') {
                                    if ($row2['spPostFieldName'] == 'spPostingSqurefoot_') {
                                        $sqrfoot = $row2['spPostFieldValue'];
                                    }
                                }
                                if ($basement == '') {
                                    if ($row2['spPostFieldName'] == 'spPostBasement_') {
                                        $basement = $row2['spPostFieldValue'];
                                    }
                                }
                            }
                        }
                ?>
                        <div class="col-md-3">
                            <div class="realBox">
                                <a href="<?php echo $BaseUrl . '/real-estate/property-detail.php?postid=' . $row['idspPostings']; ?>">
                                    <div class="boxHead">
                                        <h2><?php echo $row['spPostingTitle']; ?></h2>
                                        <p>
                                            <i class="fa fa-map-marker"></i>
                                            <?php
                                            if (strlen($address) < 30) {
                                                echo $address;
                                            } else {
                                                echo substr($address, 0, 30) . "...";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <?php
                                    $pic = new _postingpic;

                                    $res2 = $pic->readFeature($row['idspPostings']);
                                    if ($res2 != false) {
                                        if ($res2->num_rows > 0) {
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                            }
                                        } else {
                                            $res2 = $pic->read($row['idspPostings']);
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                            }
                                        }
                                    } else {
                                        $res2 = $pic->read($row['idspPostings']);
                                        if ($res2 != false) {
                                            $rp = mysqli_fetch_assoc($res2);
                                            $pic2 = $rp['spPostingPic'];
                                            echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >";
                                        } else {
                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>";
                                        }
                                    } ?>
                                    <div class="midLayer">
                                        <ul>
                                            <li data-toggle="tooltip" title="Square Foot"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-1.png"><?php echo ($sqrfoot > 0) ? $sqrfoot : 0; ?></li>
                                            <li data-toggle="tooltip" title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-2.png"><?php echo ($bedroom > 0) ? $bedroom : 0; ?></li>
                                            <li data-toggle="tooltip" title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-3.png"><?php echo ($bathroom > 0) ? $bathroom : 0; ?></li>
                                            <li data-toggle="tooltip" title="Basement" class="text-right"><img src="<?php echo $BaseUrl; ?>/assets/images/real/icon-4.png"><?php echo ($basement > 0) ? $basement : 0; ?></li>
                                        </ul>
                                    </div>
                                    <div class="boxFoot bg_white text-center">
                                        <p class="proType"><?php echo $propertyType; ?></p>
                                        <p><span>$<?php echo $row['spPostingPrice']; ?></span></p>
                                    </div>
                                </a>
                            </div>
                        </div> <?php
                            }
                        }
                                ?>


            </div>
        </div>
    </section>
    <script type="text/javascript">
        function flags() {
            document.getElementById('flags').innerText = 'You have already flagged this post .';
        }


        function favoritereadd() {
            //$("#addtofavouriteevent").click(function () {
            var postid = $('#addtofavouriteevent').attr('data-postid');
            var pid = $('#addtofavouriteevent').attr('data-pid');


            $.post("addfavorites.php", {
                postid: postid,
                pid: pid
            }, function(response) {
                $(".appendheart").html("<a href='javascript:void(0)' onclick='favoriteremove()' data-postid='" + postid + "'><i class='fa fa-heart' style='font-size: 20px;' aria-hidden='true'></i>&nbsp Unfavourite</a>");
                //window.location.reload();
            });
            // });
        }
        //=========VIDEO POST FAVOURITE end=============
        //=========VIDEO POST UNFAVOURITE Start=============

        function favoriteremove() {
            //$("#remtofavoritesevent").on("click", function () {
            var post = $('#remtofavoritesevent').attr('data-postid');
            var pid = $('#remtofavoritesevent').attr('data-pid');


            var btnremovefavorites = this;
            $.post("deletefavorites.php", {
                postid: post,
                pid: pid

            }, function(response) {
                $(".appendheart").html(" <a href='javascript:void(0)' onclick='favoritereadd()' data-postid='" + post + "'  data-pid='" + pid + "'><i class='fa fa-heart-o' style='font-size: 20px;' aria-hidden='true'></i>&nbsp Favourite </a>");
                //window.location.reload();
            });
            //});
        }
    </script>
    <div class="space-md"></div>
    <div class="hidden">
        <input id="geocomplete" type="text" placeholder="Type in an address" size="90" />
    </div>
    <?php
    include('../component/f_footer.php');
    include('../component/f_btm_script.php');
    ?>

</body>

</html>
