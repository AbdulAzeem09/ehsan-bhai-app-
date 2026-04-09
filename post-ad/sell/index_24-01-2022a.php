<?php
include('../../univ/baseurl.php');
session_start();



if (!isset($_SESSION['pid'])) {

    $_SESSION['afterlogin'] = "store/";
    include_once("../../authentication/islogin.php");
} else {
    function sp_autoloader($class)
    {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $re = new _redirect;
    $p = new _productposting;

    if ($_SESSION['ptid'] == 2 ||  $_SESSION['ptid'] == 5) {
        $redirctUrl = $BaseUrl . "/store/storeindex.php";
        $_SESSION['count'] = 0;
        $_SESSION['msg'] = "Selling not allowed on this profile. Please switch to other one.";
        $re->redirect($redirctUrl);
    }

    $_GET["module"] = "1";
    $_GET["categoryid"] = "1";
    $_GET["profiletype"] = "1";
    $_GET["categoryname"] = "Sell";
    //include "../index.php";

    /* if (isset($_GET['postid']) && $_GET['postid'] > 0) {
        # code...
    }else{
        // CHEK HOW MANY POST IS POSTING
        
        $reuslt5 = $p->chekposting($_GET['categoryid'],$_SESSION['pid']);
        if ($reuslt5 == true) {
            //echo "get out";
            $redirctUrl = $BaseUrl . "/store/";
            $re->redirect($redirctUrl);
        }
    } */


    $u = new _spuser;
    $res = $u->read($_SESSION["uid"]);
    if ($res != false) {
        $ruser = mysqli_fetch_assoc($res);
        $usercountry = $ruser["spUserCountry"];
        $userstate = $ruser["spUserState"];
        $usercity = $ruser["spUserCity"];
    }
    // THIS IS POSTING DETAIL 

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
    $visibility = "";

    if (isset($_GET["postid"])) {

        $r = $p->read($_GET["postid"]);
        //echo $p->ta->sql;
        if ($r != false) {
            while ($row = mysqli_fetch_assoc($r)) {

                //echo"<pre>";
                //print_r($row);
                //echo "<input type='hidden' id='postprofile' value='" . $profileid . "'>";
                $ePostTitle     = $row["spPostingTitle"];
                $ePostNotes     = $row["spPostingNotes"];
                $specification     = $row["specification"];
                $eExDt          = $row["spPostingExpDt"];
                $ePostDate      = $row['spPostingDate'];
                $ePrice         = $row["spPostingPrice"];
                $profileid      = $row['spProfiles_idspProfiles'];
                $postingflag    = $row['spPostingsFlag'];

                $category    = $row['subcategory'];



                $quantitytype = $row['quantitytype'];
                //$phone = $row['spPostingPhone'];
                $shipping       = $row['sppostingShippingCharge'];
                $eCountry       = $row['spPostingsCountry'];
                $eCity          = $row['spPostingsCity'];
                $visibility     = $row['spPostingVisibility'];
            }
        }

        $po = new _productposting;

        $result_fel = $po->read($_GET['postid']);
        //echo $po->ta->sql;
        $ItemCondition = '';
        $ExpiryDate = '';


        if ($result_fel != false) {
            while ($row_fel = mysqli_fetch_assoc($result_fel)) {

                // echo"<pre>";
                //print_r($row_fel);




                $auctionStatus = $row_fel['auctionStatus'];


                $selltype = $row_fel['sellType'];

                $retailQuantity = $row_fel['retailQuantity'];
                $retailSpecDiscount = $row_fel['retailSpecDiscount'];
                $retailDiscount = $row_fel['retailDiscount'];
                $retailStatus = $row_fel['retailStatus'];
                //$retailQuantity = $row_fel['retailQuantity'];



                if ($selltype == "Auction") {

                    $Quantity = $row_fel['auctionQuantity'];
                } elseif ($selltype == "Retail") {

                    $Quantity = $row_fel['retailQuantity'];
                } elseif ($selltype == "Wholesaler") {

                    $Quantity = $row_fel['supplyability'];
                }

                if ($selltype == "Auction") {

                    $ItemCondition = $row_fel['auctionStatus'];
                } elseif ($selltype == "Retail") {

                    $ItemCondition = $row_fel['retailStatus'];
                }/*elseif($selltype == "Wholesaler"){

                     $ItemCondition = $row['supplyability'];
                }*/


                $price = $row_fel['spPostingPrice'];

                if ($selltype == "Auction") {

                    $ExpiryDate = $row_fel['spPostingExpDt'];
                } elseif ($selltype == "Retail") {

                    $ExpiryDate = $row_fel['spPostingExpDt'];
                }



                $minorderqty = $row_fel['minorderqty'];
                $supplyability = $row_fel['supplyability'];
                $paymentterm = $row_fel['paymentterm'];
                $industryType = $row_fel['industryType'];

                $sizeXS = $row_fel['sizeXS'];
                $sizeS = $row_fel['sizeS'];
                $sizeM = $row_fel['sizeM'];
                $sizeL = $row_fel['sizeL'];
                $sizeXL = $row_fel['sizeXL'];
                /*$sizeXS = $row_fel['sizeXS'];
               $sizeXS = $row_fel['sizeXS'];*/

                $sizeuk6 = $row_fel['sizeuk6'];
                $sizeuk7 = $row_fel['sizeuk7'];
                $sizeuk8 = $row_fel['sizeuk8'];
                $sizeuk9 = $row_fel['sizeuk9'];
                $sizeuk10 = $row_fel['sizeuk10'];
                //$sizeXS = $row_fel['sizeXS'];



                /*       if($row_fel['spPostFieldName'] == 'sellType_'){
                                                                            $spPostFieldValue = $row_fel['spPostFieldValue'];
                                                                    } 

                                                                    if($row_fel['spPostFieldName'] == 'subcategory_'){
                                                                            $category = $row_fel['spPostFieldValue'];
                                                                    } 

                                                                     if($row_fel['spPostFieldName'] == 'quantitytype'){
                                                                            $quantitytype = $row_fel['spPostFieldValue'];
                                                                    } 

                                                                     if($row_fel['spPostFieldName'] == 'auctionQuantity_'){
                                                                            $auctionQuantity = $row_fel['spPostFieldValue'];
                                                                    } 

                                                                 
                                                                    if($row_fel['spPostFieldName'] == 'spPostingPrice'){
                                                                            $spPostingPrice = $row_fel['spPostFieldValue'];
                                                                    } 

                                                                    
                                                                      if($row_fel['spPostFieldName'] == 'retailDiscount_'){
                                                                            $retailDiscount = $row_fel['spPostFieldValue'];
                                                                    } 

                                                                    if($row_fel['spPostFieldName'] == 'retailSpecDiscount_'){
                                                                            $retailSpecDiscount = $row_fel['spPostFieldValue'];
                                                                    } 


                                                                    if($row_fel['spPostFieldName'] == 'retailQuantity_'){
                                                                            $retailQuantity = $row_fel['spPostFieldValue'];
                                                                    } 


                                                                    if($row_fel['spPostFieldName'] == 'retailStatus_'){
                                                                            
                                                                            $retailStatus = $row_fel['spPostFieldValue'];
                                                                    
                                                                    } */



                /*Wholesale fields value*/
                /*
                                                                    if($row_fel['spPostFieldName'] == 'industryType_'){
                                                                            
                                                                            $industryType = $row_fel['spPostFieldValue'];
                                                                    
                                                                    } 


                                                                    if($row_fel['spPostFieldName'] == 'supplyability_'){
                                                                            
                                                                            $supplyability = $row_fel['spPostFieldValue'];
                                                                    
                                                                    } 


                                                                     if($row_fel['spPostFieldName'] == 'paymentterm_'){
                                                                            
                                                                            $paymentterm = $row_fel['spPostFieldValue'];
                                                                    
                                                                    } 

                                                                    if($row_fel['spPostFieldName'] == 'minorderqty_'){
                                                                            
                                                                            $minorderqty = $row_fel['spPostFieldValue'];
                                                                    
                                                                    } */



                /*
                                                                    if($row_fel['spPostFieldName'] == 'auctionStatus_'){
                                                                        $ItemCondition = $row_fel['spPostFieldValue'];
                                                                    } if($row_fel['spPostFieldName'] == 'retailStatus_'){
                                                                        $ItemCondition = $row_fel['spPostFieldValue'];
                                                                    }else{
                                                                        if($ItemCondition == ''){
                                                                            $ItemCondition = "Not Define";
                                                                        }
                                                                    }
                                                                    */
            }
        }

        /*print_r($ItemCondition);*/

        $or = new _order;
        $total = 0;
        $res = $or->quantityavailable($_GET["postid"]);
        if ($res != false) {
            while ($order = mysqli_fetch_assoc($res)) {
                if ($order["spOrderStatus"] == 0) {
                    $soldquantity += $order["spOrderQty"];
                }
            }
        }

        if (isset($soldquantity)) {
            $available = $totalquantity - $soldquantity;
        } else {
            $available = 0;
        }


        //print_r($available);
        /*if($result_po == true){
                                                            $result_fel = $po->field($_GET['postid']);
                                                            //echo $po->ta->sql;
                                                            $ItemCondition = '';
                                                            $ExpiryDate = '';

                                                            if($result_fel != false){
                                                                while ($row_fel = mysqli_fetch_assoc($result_fel)) {}*/
    }
    $p = new _spprofiles;
    $res = $p->readprofilepic($_GET["profiletype"], $_SESSION['uid']);

    if ($res != false) {
        $r = mysqli_fetch_assoc($res);
        $profileid = $r['idspProfiles'];
        $country = $r["spProfilesCountry"];
        $city = $r["spProfilesCity"];
    }



?>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="description" content="The SharePage">


        <title>The SharePage.</title>
        <!--  <link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/logo-black.png' ?>" sizes="16x16" type="image/png"> -->

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

        <link rel="icon" href="<?php echo $BaseUrl . '/assets/images/logo/tsp_trans.png' ?>" sizes="16x16" type="image/png">

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
        <!-- Bootstrap Color Picker -->
        <link href="<?php echo $BaseUrl;  ?>/assets/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" />


        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!-- PAGE SCRIPT -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/posting/store.js"></script>

        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.core.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.default.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/alert.lite.min.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/alert.min.js"></script>
        <!-- DATE AND TIME PICKER -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-timepicker.min.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-timepicker.min.js"></script>

        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css">
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert-dev.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
        <!--post group button on btm of the form-->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/jquery-ui.min.css">
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>



        <script>
            function numericFilter(txb) {
                txb.value = txb.value.replace(/[^\0-9]/ig, "");
            }
        </script>
        <script type="text/javascript">
            $(function() {

                $('#sppostingShippingCharge').keypress(function(event) {
                    if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                        event.preventDefault(); //stop character from entering input
                    }
                });
            });
        </script>
        <?php
        $urlCustomCss = $BaseUrl . '/component/custom.css.php';
        include $urlCustomCss;
        ?>
        <link href="<?php echo $BaseUrl; ?>/assets/css/design.css" rel="stylesheet" type="text/css">
        <!-- <link href="<?php echo $BaseUrl; ?>/assets/css/style.css" rel="stylesheet" type="text/css"> -->

        <!-- <style type="text/css" >
    [type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
}
[type="radio"]:checked + label,
[type="radio"]:not(:checked) + label
{
    position: relative;
    padding-left: 28px;
    cursor: pointer;
    line-height: 20px;
    display: inline-block;
    color: #666;
}
[type="radio"]:checked + label:before,
[type="radio"]:not(:checked) + label:before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 18px;
    height: 18px;
    border: 1px solid #ddd;
    border-radius: 100%;
    background: #fff;
}
[type="radio"]:checked + label:after,
[type="radio"]:not(:checked) + label:after {
    content: '';
    width: 12px;
    height: 12px;
    background: #F87DA9;
    position: absolute;
    top: 4px;
    left: 4px;
    border-radius: 100%;
    -webkit-transition: all 0.2s ease;
    transition: all 0.2s ease;
}
[type="radio"]:not(:checked) + label:after {
    opacity: 0;
    -webkit-transform: scale(0);
    transform: scale(0);
}
[type="radio"]:checked + label:after {
    opacity: 1;
    -webkit-transform: scale(1);
    transform: scale(1);
}
</style> -->
        <style type="text/css" media="screen">
            .btn:focus {
                ouline: 0px;
            }
        </style>
    </head>

    <body onload="pageOnload('post')">

        <?php
        $header_store = "header_store";
        include_once("../../header.php");
        /* <?php*/
        //this is for store header
        /* $header_store = "header_store";
            include_once("../header.php");
            */

        $p = new _spprofiles;
        //$rp = $p->readProfiles($_SESSION['uid']);
        //$res = $p->readprofilepic($_GET["profiletype"],$_SESSION['uid']);
        $res = $p->read($_SESSION['pid']);
        //echo $p->ta->sql;
        if ($res != false) {

            $r = mysqli_fetch_assoc($res);
            $name = ucwords(strtolower($r['spProfileName']));
            $icon = $r['spprofiletypeicon'];
        } else {

            $name = "Select Profile";
            $icon = "<i class='fa fa-user'></i>";
        }
        $resultOfProfile  = $p->read($_SESSION["pid"]);
        if ($resultOfProfile != false) {
            $sprows = mysqli_fetch_assoc($resultOfProfile);
            $profileType = $sprows["spProfileType_idspProfileType"];
            // 2 and 5 are employment and freelance types
        }
        ?>
        <div class="loadbox">
            <div class="loader"></div>
        </div>

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 no-padding hidden-xs">
                        <div class="left_saa">
                            <img src="<?php echo $BaseUrl; ?>/assets/images/submit-add/l-sadd.jpg" class="img-responsive" alt="" />
                        </div>
                    </div>

                    <div class="col-md-9 col-xs-12">

                        <div class="row">
                            <div class="col-md-12">
                                <!-- <form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopost.php" method="post" id="sp-form-post" name="postform"> -->
                                <form enctype="multipart/form-data" action="<?php echo $BaseUrl ?>/post-ad/dopostproduct.php" method="post" id="sp-form-post" name="postform">
                                    <div class="modTitle" style="padding-left: 15px;">
                                        <h2><a href="<?php echo $BaseUrl . '/store'; ?>" style="color: #337ab7!important;font-size:12.5px"><span>RETURN TO STORE</span></a></h2>
                                    </div>
                                    <div class="add_form bradius-15" style="border-radius: 20px;border-top-left-radius: 20px;border-top-right-radius: 20px;">
                                        <?php


                                        if (isset($_GET['postid']) && $_GET['postid'] > 0) {
                                            if ($visibility == 0) {
                                                $lblpage = "This is a draft posting";
                                            } else if ($visibility == -2) {
                                                $lblpage = "De-Activate Product";
                                            } else if (isset($_GET['exp']) && $_GET['exp'] == 1) {
                                                $lblpage = "Expird Post";
                                            } else {
                                                $lblpage = "Update post";
                                            }
                                        } else {
                                            //$lblpage = "SUBMIT AN AD";
                                            $lblpage = "SELL YOUR ITEMS";
                                        }
                                        ?>
                                        <h3 style="border-top-left-radius: 20px!important;border-top-right-radius: 20px!important;font-size: 20px;"><i class="fa fa-pencil"></i> <b><?php echo $lblpage; ?></b> <a href="<?php echo $BaseUrl . '/store/dashboard'; ?>" class="pull-right stordashclr" style=""><i class="fa fa-dashboard"></i> Dashboard</a></h3>

                                        <div class="add_form_body">
                                            <?php if ($profileType == '2' || $profileType == '5') {
                                                echo "Please choose other profile for selling products.";
                                                exit;
                                            } ?>
                                            <div class="">
                                                <div class="">
                                                    <div style="padding-bottom: 0px;padding-top: 11px;">
                                                        <div class="row no-margin">
                                                            <div class="col-md-2 no-padding">
                                                                <!-- <h4>Build trust with Seller and Buyer</h4> -->
                                                                <!--  <a href="<?php echo $BaseUrl . '/store'; ?>" style="color: #337ab7!important;" ><h4>RETURN TO STORE HOME</h4></a> -->
                                                            </div>
                                                            <!--    <div class="col-md-4 col-xs-12 no-padding">
                                                            <div class="addcustomsell <?php echo (isset($_GET['postid'])) ? 'hidden' : ''; ?>">
                                                                <div class="form-group">
                                                                    <label for="sellType_" class="sellTypeLbl">Sell Type&nbsp;</label>
                                                                    <select class="form-control spPostField" data-filter="1" name="sellType_" id="sellType_" style="width: 120px;display: inline;">
                                                                      
                                                                        <option value="0">Select Type</option>
                                                                        <option value="Auction">Auction</option>
                                                                        <option value="Retail">Retail</option>
                                                                        <option value="Wholesaler">Wholesaler</option>
                                                                       
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div> -->

                                                            <div class="col-md-6 col-xs-12 ">
                                                                <!-- <div class="addcustomsell <?php echo (isset($_GET['postid'])) ? 'hidden' : ''; ?>"> -->

                                                                <?php
                                                                echo "<input type='hidden' id='postprofile' value='" . $profileid . "'>";
                                                                // print_r($selltype);
                                                                ?>
                                                                <div class="addcustomsell ">
                                                                    <div class="form-group">
                                                                        <div class="sell_rad" style="padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px; <?php if (isset($_GET['postid'])) {
                                                                                                                                                                                        echo "text-align: center;";
                                                                                                                                                                                    } ?>">


                                                                            <?php if (isset($_GET['postid'])) { ?>

                                                                                <label for="sellType_" class="">Selected Sell Type :&nbsp;</label>
                                                                                <label><?php echo $selltype; ?></label>
                                                                                <input type="hidden" id="sellType_" name="sellType" value="<?php echo $selltype; ?>">


                                                                            <?php } else { ?>

                                                                                <label for="sellType_" class="">Select Sell Type :&nbsp;</label>
                                                                                <select class="form-control spPostField" data-filter="1" name="sellType" id="sellType_" style="width: 133px;display: inline;border-radius: 17px;border: 2px solid #5cb85c;" <?php if (!empty($selltype)) {
                                                                                                                                                                                                                                                                echo "disabled";
                                                                                                                                                                                                                                                            } ?>>

                                                                                    <option value="0">Select Type</option>

                                                                                    <option value="Auction" <?php if ($selltype == "Auction") {
                                                                                                                echo "selected";
                                                                                                            } ?>>Auction</option>

                                                                                    <option value="Retail" <?php if ($selltype == "Retail") {
                                                                                                                echo "selected";
                                                                                                            } ?>>Retail</option>

                                                                                    <option value="Wholesaler" <?php if ($selltype == "Wholesaler") {
                                                                                                                    echo "selected";
                                                                                                                } ?>>Wholesaler</option>

                                                                                </select>

                                                                            <?php } ?>

                                                                        </div>

                                                                        <!--    <div class="sell_rad" style="padding-top: 10px;padding-bottom: 10px;padding-left: 10px;padding-right: 10px;">
                                                                        <label for="sellType_" class="">Select Sell Type :&nbsp;</label>
                                                                    <label  ><input type="radio" class="spPostField" data-filter="1" name="sellType_"  id="sellType_" onclick="myFunction(this.value)" value="Auction" checked> Auction</label>
                                                                    <label ><input type="radio" class="spPostField"  data-filter="1" onclick="myFunction(this.value)" name="sellType_" id="sellType_" value="Retail">
                                                                     Retail</label>
                                                                   <label ><input type="radio" class="spPostField"  data-filter="1" name="sellType_" onclick="myFunction(this.value)" id="sellType_" value="Wholesaler">
                                                                    Wholesaler</label>
                                                                  </div> -->



                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- <div class="col-md-3 col-xs-12 no-padding">
                                                            <div class="addcustomsell <?php echo (isset($_GET['postid'])) ? 'hidden' : ''; ?>">
                                                                <div class="form-group">
                                                                    <label for="sellType_" class="sellTypeLbl">Auction Type&nbsp;</label>
                                                                    <select class="form-control spPostField" data-filter="1" name="sellType_" id="sellType_" style="width: 120px;display: inline;">
                                                                   
                                                                        <option value="0">Select Type</option>
                                                                        <option value="">Buy Now</option>
                                                                        <option value="">Auction</option>
                                                                    
                                                                    </select>
                                                                </div>
                                                            </div>
                                                          </div> -->


                                                            <div class="col-md-4 col-xs-12" style="padding-top: 10px;">



                                                                <div class="dropdown profilecentr pull-right <?php echo (isset($_GET['postid'])) ? 'hidden' : ''; ?>">
                                                                    <!-- <div class="btn-group top_profile_box" role="group" aria-label="Basic example">
                                                                    <button type="button" class="btn btn-success" style="cursor:default;width: 133px;display: inline;border-bottom-left-radius: 17px;border-top-left-radius: 17px;border: 2px solid #5cb85c;">Select Profile</button>
                                                                    <button class="btn butn_profile dropdown-toggle" style="width: 133px;display: inline;border-bottom-right-radius: 17px;border-top-right-radius: 17px;border: 2px solid #5cb85c;" type="button" id="profiles" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="<?php echo $icon; ?>"></span> <?php echo $name; ?><span class="caret"></span></button>

                                                                    <ul class="dropdown-menu" id="profilesdd" aria-labelledby="profiles">
                                                                        <?php
                                                                        $profile = new _spprofiles;
                                                                        $res = $profile->categoryprofiles($_GET["categoryid"], $_SESSION['uid']);
                                                                        //echo $profile->ta->sql;
                                                                        if ($res != false) {

                                                                            while ($row = mysqli_fetch_assoc($res)) {
                                                                                if ($row["spProfilePic"] != "") {
                                                                                    $proImg = " " . ($row["spProfilePic"]);
                                                                                } else {
                                                                                    $proImg = $BaseUrl . "/assets/images/blank-img/default-profile.png";
                                                                                }
                                                                                //echo "<li><a href='#' class='profiledd' data-pid='".$row['idspProfiles']."' data-profileicon='".$row["spprofiletypeicon"]."'><span class='".$row["spprofiletypeicon"]."'></span> " .$row["spProfileName"]."</a></li>";
                                                                                echo "<li><a href='#' class='profiledd' data-pid='" . $row['idspProfiles'] . "' data-profileicon='" . $row["spprofiletypeicon"] . "'><img  alt='Profile Pic' class='img-rounded' style='width:40px; height:40px;' src='" . $proImg . "' >&nbsp;&nbsp;<span class='" . $row["spprofiletypeicon"] . "'></span> " . ucwords(strtolower($row["spProfileName"])) . "</a></li><hr>";


                                                                                $profilename = $row["spProfileName"];
                                                                                $profilesid = $row["idspProfiles"];
                                                                                $profilepicture = $row["spProfilePic"];
                                                                                $country = $row["spProfilesCountry"];
                                                                                $city = $row["spProfilesCity"];
                                                                                $icon = $row["spprofiletypeicon"];
                                                                            }
                                                                        } else {
                                                                            echo "<li role='separator' class='divider'></li>
                                                                            <li id='myprofile'><a href='/my-profile/' id='sp-profile-register'>Add New Profile</a></li>";
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </div> -->
                                                                </div>

                                                                <?php if (isset($_GET['postid'])) { ?>
                                                                    <h5 style="float: right;"> Product Id : <?php echo $_GET['postid']; ?></h5>

                                                                <?php } ?>

                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="space"></div>
                                                    <?php if (isset($_GET['postid'])) { ?>

                                                        <div id="sell_frm">

                                                        <?php  } else { ?>


                                                            <div id="sell_frm" style="display:none;">


                                                            <?php  } ?>


                                                            <div class="row">
                                                                <div class="col-md-12">

                                                                    <input type="hidden" id="postid" value="<?php if (isset($_GET['postif'])) {
                                                                                                                echo $_GET["postid"];
                                                                                                            } ?>">

                                                                    <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="<?php echo $_GET["categoryid"]; ?>">

                                                                    <input id="catname" type="hidden" value="<?php echo $_GET["categoryname"]; ?>">


                                                                    <!--  <input type="hidden" id="buyid" name="buyid_" type="hidden"> -->

                                                                    <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="<?php echo (isset($_GET["groupid"]) ? $_GET["groupid"] : "-1"); ?>">

                                                                    <input id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" class="business" value="<?php echo $_SESSION['pid']; ?>" type="hidden">

                                                                    <?php
                                                                    if (isset($_GET["postid"])) {
                                                                        echo "<input id='idspPostings' name='idspPostings' value=" . $_GET["postid"] . " type='hidden' >";
                                                                    }
                                                                    ?>
                                                                    <!--Buy and Sell-->
                                                                    <!--Buy and Sell--complete-->
                                                                    <div class="row no-margin">
                                                                        <div id="invalid"></div>
                                                                        <div class="col-md-12 no-padding">
                                                                            <div class="form-group">
                                                                                <label for="spPostingTitle">Title <span>* <span class="lbl_1"></span></span></label>
                                                                                <!-- class for not enter numeric value
																			class=chekspvhar-->
                                                                                <input type="text" class="form-control" id="spPostingTitle" name="spPostingTitle" maxlength="40" value="<?php echo $ePostTitle ?>" placeholder="" required />
                                                                            </div>

                                                                            <div class="">
                                                                                <?php
                                                                                if ($eExDt) {
                                                                                    $todayDate = date("Y-m-d");
                                                                                    $dateExp = date('Y-m-d', strtotime($eExDt));
                                                                                    if ($todayDate > $dateExp) {
                                                                                        $expDate = date('Y-m-d', strtotime("+90 days"));
                                                                                    } else {
                                                                                        $expDate = $dateExp;
                                                                                    }
                                                                                    //echo date('Y-m-d', strtotime($eExDt));
                                                                                } else {
                                                                                    $expDate = date('Y-m-d', strtotime("+90 days"));
                                                                                }
                                                                                ?>
                                                                                <input type="hidden" class="form-control" id="spPostingExpDt" name="spPostingExpDt" value="<?php echo $expDate; ?>">
                                                                            </div>

                                                                            <div class="addcustomfields row">
                                                                                <!--add custom fields-->
                                                                                <?php
                                                                                if (isset($_GET["postid"])) {
                                                                                    $f = new _spproductsize;
                                                                                    $res = $f->read($_GET["postid"]);
                                                                                    if ($res != false) {


                                                                                        while ($result = mysqli_fetch_assoc($res)) {

                                                                                            // echo"<pre>";
                                                                                            // print_r($result);
                                                                                            $sizeXS = $result["sizeXS"];
                                                                                            $sizeS = $result["sizeS"];
                                                                                            $sizeM = $result["sizeM"];
                                                                                            $sizeL = $result["sizeL"];
                                                                                            $sizeXL = $result["sizeXL"];
                                                                                            $sizeXXL = $result["sizeXXL"];
                                                                                            $sizeXXXL = $result["sizeXXXL"];



                                                                                            $shoesize1 = $result["shoesize1"];
                                                                                            $shoesize2 = $result["shoesize2"];
                                                                                            $shoesize3 = $result["shoesize3"];
                                                                                            $shoesize4 = $result["shoesize4"];
                                                                                            $shoesize5 = $result["shoesize5"];
                                                                                            $shoesize6 = $result["shoesize6"];
                                                                                            $shoesize7 = $result["shoesize7"];
                                                                                            $shoesize8 = $result["shoesize8"];
                                                                                            $shoesize9 = $result["shoesize9"];
                                                                                            $shoesize10 = $result["shoesize10"];
                                                                                            $shoesize11 = $result["shoesize11"];
                                                                                            $shoesize12 = $result["shoesize12"];
                                                                                            $shoesize13 = $result["shoesize13"];
                                                                                            $shoesize14 = $result["shoesize14"];

                                                                                            //$idspPostField = $result["idspPostField"];
                                                                                        }
                                                                                    }
                                                                                }

                                                                                include("../sell.php");
                                                                                //include("../auction.php");

                                                                                ?>
                                                                                <!--Getcustomfield-->
                                                                            </div>
                                                                            <?php

                                                                            include("../variants.php");

                                                                            ?>


                                                                            <?php if (isset($_GET["postid"]) && $category == "Clothing") {
                                                                            ?>

                                                                                <div class="row" id="clothsize">
                                                                                <?php
                                                                            } else {
                                                                                ?>

                                                                                    <div class="row" id="clothsize" style="display:none;">
                                                                                    <?php
                                                                                }

                                                                                    ?>

                                                                                    <!--  <div class="row" id="clothsize" style="display:none;"> -->

                                                                                    <div class="col-md-12">
                                                                                        <div class="col-md-2 no-padding">
                                                                                            <div class="form-group">
                                                                                                <label for="spPostingNotes">XS (size) Quantity</label>
                                                                                                <input type="text" class="form-control size" value="<?php if ($sizeXS != 0) {
                                                                                                                                                        echo $sizeXS;
                                                                                                                                                    } ?>" name="sizeXS">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2" style="width: 20%;">
                                                                                            <div class="form-group">
                                                                                                <label for="spPostingNotes">S (size) Quantity</label>
                                                                                                <input type="text" class="form-control size" value="<?php if ($sizeS != 0) {
                                                                                                                                                        echo $sizeS;
                                                                                                                                                    } ?>" name="sizeS">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2" style="width: 20%;">
                                                                                            <div class="form-group">
                                                                                                <label for="spPostingNotes">M (size) Quantity</label>
                                                                                                <input type="text" class="form-control size" value="<?php if ($sizeM != 0) {
                                                                                                                                                        echo $sizeM;
                                                                                                                                                    } ?>" name="sizeM">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-2 " style="width: 20%;">
                                                                                            <div class="form-group">
                                                                                                <label for="spPostingNotes">L (size) Quantity</label>
                                                                                                <input type="text" class="form-control size" value="<?php if ($sizeL != 0) {
                                                                                                                                                        echo $sizeL;
                                                                                                                                                    } ?>" name="sizeL">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2 " style="width: 20%;">
                                                                                            <div class="form-group">
                                                                                                <label for="spPostingNotes">XL (size) Quantity</label>
                                                                                                <input type="text" class="form-control size" value="<?php if ($sizeXL != 0) {
                                                                                                                                                        echo $sizeXL;
                                                                                                                                                    } ?>" name="sizeXL">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2 no-padding">
                                                                                            <div class="form-group">
                                                                                                <label for="spPostingNotes">XXL (size) Quantity</label>
                                                                                                <input type="text" class="form-control size" value="<?php if ($sizeXXL != 0) {
                                                                                                                                                        echo $sizeXXL;
                                                                                                                                                    } ?>" name="sizeXXL">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-md-2 " style="width: 20%;">
                                                                                            <div class="form-group">
                                                                                                <label for="spPostingNotes">XXXL (size) Quantity</label>
                                                                                                <input type="text" class="form-control size" value="<?php if ($sizeXXXL != 0) {
                                                                                                                                                        echo $sizeXXXL;
                                                                                                                                                    } ?>" name="sizeXXXL">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>
                                                                                    </div>

                                                                                    <?php if (isset($_GET["postid"]) && $category == "Shoes") {
                                                                                    ?>

                                                                                        <div class="row" id="shoesize">
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>

                                                                                            <div class="row" id="shoesize" style="display:none;">

                                                                                            <?php

                                                                                        }

                                                                                            ?>

                                                                                            <div class="col-md-12">
                                                                                                <div class="col-md-2 no-padding">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(1) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize1 != 0) {
                                                                                                                                                                echo $shoesize1;
                                                                                                                                                            } ?>" name="shoesize1">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2" style="width: 18%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(2) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize2 != 0) {
                                                                                                                                                                echo $shoesize2;
                                                                                                                                                            } ?>" name="shoesize2">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2" style="width: 18%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(3) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize3 != 0) {
                                                                                                                                                                echo $shoesize3;
                                                                                                                                                            } ?>" name="shoesize3">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2" style="width: 18%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(4) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize4 != 0) {
                                                                                                                                                                echo $shoesize4;
                                                                                                                                                            } ?>" name="shoesize4">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2" style="width: 18%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(5) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize5 != 0) {
                                                                                                                                                                echo $shoesize5;
                                                                                                                                                            } ?>" name="shoesize5">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-2 no-padding">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(6) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize6 != 0) {
                                                                                                                                                                echo $shoesize6;
                                                                                                                                                            } ?>" name="shoesize6">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <!--  <div class="col-md-2 no-padding">
                                                                     <div class="form-group">
                                                                        <label for="spPostingNotes">Shoes size(6) Quantity</label>
                                                                        <input type="text" class="form-control size" name="sizeuk6">
                                                                     </div>
                                                                    </div> -->
                                                                                                <div class="col-md-2" style="width: 18%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(7) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize7 != 0) {
                                                                                                                                                                echo $shoesize7;
                                                                                                                                                            } ?>" name="shoesize7">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2" style="width: 18%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(8) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize8 != 0) {
                                                                                                                                                                echo $shoesize8;
                                                                                                                                                            } ?>" name="shoesize8">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2" style="width: 18%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(9) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize9 != 0) {
                                                                                                                                                                echo $shoesize9;
                                                                                                                                                            } ?>" name="shoesize9">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-md-2" style="width: 19%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(10) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize10 != 0) {
                                                                                                                                                                echo $shoesize10;
                                                                                                                                                            } ?>" name="shoesize10">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-2 no-padding" style="width: 17%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(11) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize11 != 0) {
                                                                                                                                                                echo $shoesize11;
                                                                                                                                                            } ?>" name="shoesize11">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-2" style="width: 19%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(12) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize12 != 0) {
                                                                                                                                                                echo $shoesize12;
                                                                                                                                                            } ?>" name="shoesize12">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-2" style="width: 19%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(13) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize13 != 0) {
                                                                                                                                                                echo $shoesize13;
                                                                                                                                                            } ?>" name="shoesize13">
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="col-md-2" style="width: 19%;">
                                                                                                    <div class="form-group">
                                                                                                        <label for="spPostingNotes">Shoes size(14) Quantity</label>
                                                                                                        <input type="text" class="form-control size" value="<?php if ($shoesize14 != 0) {
                                                                                                                                                                echo $shoesize14;
                                                                                                                                                            } ?>" name="shoesize14">
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            </div>

                                                                                            <!--  <div class="row" id="shoesize" style="display:none;">

                                                                <div class="col-md-12">
                                                                   <div class="col-md-2 no-padding">
                                                                     <div class="form-group">
                                                                        <label for="spPostingNotes">Shoes size(6) Quantity</label>
                                                                        <input type="text" class="form-control size" name="sizeuk6">
                                                                     </div>
                                                                    </div>
                                                                     <div class="col-md-2" style="width: 20%;">
                                                                     <div class="form-group">
                                                                        <label for="spPostingNotes">Shoes size(7) Quantity</label>
                                                                        <input type="text" class="form-control size" name="sizeuk7">
                                                                     </div>
                                                                    </div>
                                                                     <div class="col-md-2" style="width: 20%;">
                                                                     <div class="form-group">
                                                                        <label for="spPostingNotes">Shoes size(8) Quantity</label>
                                                                        <input type="text" class="form-control size" name="sizeuk8">
                                                                     </div>
                                                                    </div>
                                                                     <div class="col-md-2" style="width: 20%;">
                                                                     <div class="form-group">
                                                                        <label for="spPostingNotes">Shoes size(9) Quantity</label>
                                                                        <input type="text" class="form-control size" name="sizeuk9">
                                                                     </div>
                                                                    </div>
                                                                     <div class="col-md-2" style="width: 20%;">
                                                                     <div class="form-group">
                                                                        <label for="spPostingNotes">Shoes size(10) Quantity</label>
                                                                        <input type="text" class="form-control size" name="sizeuk10">
                                                                     </div>
                                                                    </div>

                                                                </div>
                                                            </div> -->
                                                                                            <!--   <?php
                                                                                                    if (isset($_GET['postid'])) {
                                                                                                    ?>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label for="spPostClearace_">Clearance</label>
                                                                                            <select class="form-control spPostField" name="spPostClearace_" id="spPostClearace_">
                                                                                                <option value="Yes">Yes</option>
                                                                                                <option value="No">No</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                        <div class="form-group">
                                                                                            <label for="spPostClearcePrice_">Clearance Discount(%)</label>
                                                                                            <input type="text" class="form-control spPostField" name="spPostClearcePrice_" id="spPostClearcePrice_">
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                                    }
                                                                                    ?> -->

                                                                                            <!-- <div class="col-md-12">
                                                                                <div class="forminertitle">
                                                                                    <h1 for="shipdestination_">Shipping Destination 
                                                                                        [
                                                                                            <label class="radio-inline"><input type="radio" class="shipdest spPostField" id="shipdestination_" name="shipdestination_" value="1" checked>Percentage</label>
                                                                                            <label class="radio-inline"><input type="radio" class="shipdest spPostField" id="shipdestination_" name="shipdestination_" value="0">Dollar</label>
                                                                                        ]
                                                                                    </h1>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <?php
                                                                                    $s = new _spshipping;
                                                                                    $result = $s->read($_SESSION["pid"]);
                                                                                    if ($result != false) {
                                                                                        $rset = mysqli_fetch_assoc($result);
                                                                                        $North  = $rset["spShippingNorthAmerica"];
                                                                                        $South  = $rset["spShippingSouthAmerica"];
                                                                                        $East   = $rset["spShippingEastEurope"];
                                                                                        $West   = $rset["spShippingWestEurope"];
                                                                                        $Middle = $rset["spShippingMiddleEast"];
                                                                                        $Southeast  = $rset["spShippingSoutheastAsia"];
                                                                                        $Australia  = $rset["spShippingAustralia"];

                                                                                        $spShipna   = $rset["spShipna"];
                                                                                        $spShipsa   = $rset["spShipsa"];
                                                                                        $spShipee   = $rset["spShipee"];
                                                                                        $spShipwe   = $rset["spShipwe"];
                                                                                        $spShipme   = $rset["spShipme"];
                                                                                        $spShipsoutha  = $rset["spShipsoutha"];
                                                                                        $spShipaus  = $rset["spShipaus"];
                                                                                    }

                                                                                    ?>
                                                                                </div>
                                                                                <div class="showpercentage">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <label for="isnorthshipping_" style="display: block;"><input type="checkbox" id="isnorthshipping_" name="isnorthshipping_" class="spPostField" checked="" value="1">North America</label>
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShippingNorthAmerica_" class="hidden">North America (%)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShippingNorthAmerica_" id="spShippingNorthAmerica_" value="<?php if (isset($North)) {
                                                                                                                                                                                                                                echo $North;
                                                                                                                                                                                                                            } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">%</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="issouthshipping_" style="display: block;"><input type="checkbox" id="issouthshipping_" name="issouthshipping_" class="spPostField" checked="" value="1">South America</label>
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="southshipping_" class="hidden">South America (%)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="southshipping_" id="southshipping_" value="<?php if (isset($South)) {
                                                                                                                                                                                                                echo $South;
                                                                                                                                                                                                            } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">%</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="isseastshipping_" style="display: block;"><input type="checkbox" id="isseastshipping_" name="isseastshipping_" class="spPostField" checked="" value="1">East Europe</label>
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShippingEastEurope_" class="hidden">East Europe (%)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShippingEastEurope_" id="spShippingEastEurope_" value="<?php if (isset($East)) {
                                                                                                                                                                                                                            echo $East;
                                                                                                                                                                                                                        } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">%</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="iswestshipping_" style="display: block;"><input type="checkbox" id="iswestshipping_" name="iswestshipping_" class="spPostField" checked="" value="1">West Europe</label>
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShippingWestEurope_" class="hidden">West Europe (%)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShippingWestEurope_" id="spShippingWestEurope_" value="<?php if (isset($West)) {
                                                                                                                                                                                                                            echo $West;
                                                                                                                                                                                                                        } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">%</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="ismiddleshipping_" style="display: block;"><input type="checkbox" id="ismiddleshipping_" name="ismiddleshipping_" class="spPostField" checked="" value="1">Middle East</label>
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShippingMiddleEas_" class="hidden">Middle East (%)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShippingMiddleEas_" id="spShippingMiddleEas_" value="<?php if (isset($Middle)) {
                                                                                                                                                                                                                            echo $Middle;
                                                                                                                                                                                                                        } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">%</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="issouthasiashipping_" style="display: block;"><input type="checkbox" id="issouthasiashipping_" name="issouthasiashipping_" class="spPostField" checked="" value="1">Southeast Asia</label>
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShippingSoutheastAsia_" class="hidden">Southeast Asia (%)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShippingSoutheastAsia_" id="spShippingSoutheastAsia_" value="<?php if (isset($Southeast)) {
                                                                                                                                                                                                                                    echo $Southeast;
                                                                                                                                                                                                                                } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">%</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="isaustrshipping_" style="display: block;"><input type="checkbox" id="isaustrshipping_" name="isaustrshipping_" class="spPostField" checked="" value="1">Australia</label>
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShippingAustralia_" class="hidden">Australia (%)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShippingAustralia_" id="spShippingAustralia_" value="<?php if (isset($spShipsoutha)) {
                                                                                                                                                                                                                            echo $spShipsoutha;
                                                                                                                                                                                                                        } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">%</span>
                                                                                                </div>
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                <div class="showdollar">
                                                                                    <div class="row">
                                                                                        <div class="col-md-4">
                                                                                            <label for="isnorthshipping_" style="display: block;"><input type="checkbox" id="isnorthshipping_" name="isnorthshipping_" class="spPostField" checked="" value="1">North America</label>
                                                                                            
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShipna_" class="hidden">North America ($)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShipna_" id="spShipna_" value="<?php if (isset($spShipna)) {
                                                                                                                                                                                                    echo $spShipna;
                                                                                                                                                                                                } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="issouthshipping_" style="display: block;"><input type="checkbox" id="issouthshipping_" name="issouthshipping_" class="spPostField" checked="" value="1">South America</label>
                                                                                            
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShipna_" class="hidden">South America ($)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShipna_" id="spShipna_" value="<?php if (isset($spShipsa)) {
                                                                                                                                                                                                    echo $spShipsa;
                                                                                                                                                                                                } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="isseastshipping_" style="display: block;"><input type="checkbox" id="isseastshipping_" name="isseastshipping_" class="spPostField" checked="" value="1">East Europe</label>
                                                                                            
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShipee_" class="hidden">East Europe ($)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShipee_" id="spShipee_" value="<?php if (isset($spShipee)) {
                                                                                                                                                                                                    echo $spShipee;
                                                                                                                                                                                                } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="iswestshipping_" style="display: block;"><input type="checkbox" id="iswestshipping_" name="iswestshipping_" class="spPostField" checked="" value="1">West Europe</label>
                                                                                            
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShipwe_" class="hidden">West Europe ($)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShipwe_" id="spShipwe_" value="<?php if (isset($spShipwe)) {
                                                                                                                                                                                                    echo $spShipwe;
                                                                                                                                                                                                } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="ismiddleshipping_" style="display: block;"><input type="checkbox" id="ismiddleshipping_" name="ismiddleshipping_" class="spPostField" checked="" value="1">Middle East</label>
                                                                                            
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShipme_" class="hidden">Middle East ($)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShipme_" id="spShipme_" value="<?php if (isset($spShipme)) {
                                                                                                                                                                                                    echo $spShipme;
                                                                                                                                                                                                } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="issouthasiashipping_" style="display: block;"><input type="checkbox" id="issouthasiashipping_" name="issouthasiashipping_" class="spPostField" checked="" value="1">Southeast Asia</label>
                                                                                            
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShipsoutha_" class="hidden">Southeast Asia ($)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShipsoutha_" id="spShipsoutha_" value="<?php if (isset($spShipsoutha)) {
                                                                                                                                                                                                            echo $spShipsoutha;
                                                                                                                                                                                                        } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <label for="isaustrshipping_" style="display: block;"><input type="checkbox" id="isaustrshipping_" name="isaustrshipping_" class="spPostField" checked="" value="1">Australia</label>
                                                                                            
                                                                                            <div class="m_btm_10" style="">
                                                                                                <div class="input-group">
                                                                                                    <label for="spShipaus_" class="hidden">Australia ($)</label>
                                                                                                    <input type="text" class="form-control spPostField" name="spShipaus_" id="spShipaus_" value="<?php if (isset($spShipaus)) {
                                                                                                                                                                                                        echo $spShipaus;
                                                                                                                                                                                                    } ?>">
                                                                                                    <span class="input-group-addon" id="basic-addon3">$</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                  
                                                                                   
                                                                            </div>-->
                                                                                            <!-- shipping End -->


                                                                                            <!--  </div> -->



                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label for="specification">Specification</label>
                                                                                            <textarea class="form-control" maxlength="500" id="specification" name="specification" required><?php if (!empty($specification)) {
                                                                                                                                                                                                echo $specification;
                                                                                                                                                                                            }  ?> </textarea>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label for="spPostingNotes">Description</label>
                                                                                            <textarea class="form-control" maxlength="500" id="spPostingNotes" name="spPostingNotes" required><?php if (!empty($ePostNotes)) {
                                                                                                                                                                                                    echo $ePostNotes;
                                                                                                                                                                                                }  ?> </textarea>
                                                                                        </div>


                                                                                </div>
                                                                        </div>

                                                                        <!-- featureimage -->
                                                                        <div style="padding: 15px;">
                                                                            <!--Testing Complete-->
                                                                            <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="featurepic">Add Feature Images <span class="lbl_15"></span></label>
                                                                                        <input type="file" class="featurepic" name="spPostingPic" id="filesaaa1" accept="image/*" required>
                                                                                        <p class="help-block"><small>Browse files from your device</small></p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="form-group">
                                                                                        <label for="featurePicPreview">Picture Preview</label>
                                                                                        <div id="imagePreview"></div>
                                                                                        <div id="featurePicPreview">
                                                                                            <div class="row">
                                                                                                <div id="fePreview">
                                                                                                    <?php
                                                                                                    $i = 1;
                                                                                                    $pic = new _productpic;
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
                                                                                                                //echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'></span><img class='postingimg overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' />Feature Image</label></div>";


                                                                                                                if ($i == 1) {

                                                                                                                    echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'  data-work='store' data-aws='2' data-src='" . $rows['spPostingPic'] . "'  data-pic='" . $rows['idspPostingPic'] . "'></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['idspPostingPic'] . "'></div>";
                                                                                                                }/*else{


                                    echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "' ></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='".$_GET['postid']."' data-picid='".$rows['idspPostingPic']."'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' ".$select." />Feature Image</label></div>";
                                }*/






                                                                                                                //echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "'></span><img class='postingimg overlayImage' style='width:100%; height: 80px;' data-name='fi_".$i."' src=' " . ($picture) . "' ><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' ".$select." value='0' />Feature Image</label></div>";
                                                                                                                $i++;
                                                                                                            }
                                                                                                        }
                                                                                                    }

                                                                                                    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--Testing-->
                                                                        <div style="padding: 15px;">
                                                                            <!--Testing Complete-->
                                                                            <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="postingpic">Add Sample Images</label>
                                                                                        <input type="file" class="postingpic" name="spPostingPic[]" id="filesaaa" accept="image/*" multiple="multiple">
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
                                                                                                    $pic = new _productpic;
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
                                                                                                                //echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'></span><img class='postingimg overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='0' />Feature Image</label></div>";


                                                                                                                if ($i == 1) {

                                                                                                                    /*echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "' ></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_".$i."' src=' " . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='".$_GET['postid']."' data-picid='".$rows['idspPostingPic']."'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' value='1' ".$select." checked />Feature Image</label></div>";*/
                                                                                                                } else {


                                                                                                                    echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed'  data-work='store' data-aws='2' data-src='" . $rows['spPostingPic'] . "'  data-pic='" . $rows['idspPostingPic'] . "'></span><img class='overlayImage' style='width:100%; height: 80px; margin-right:5px;' data-name='fi_" . $i . "' src='" . ($picture) . "'/><label style='font-size: 10px;' class='updateFeature' data-postid='" . $_GET['postid'] . "' data-picid='" . $rows['idspPostingPic'] . "'></div>";
                                                                                                                }






                                                                                                                //echo "<div class='col-md-2 imagepost'><span class='fa fa-remove dynamicimg closed' data-pic='" . $rows['idspPostingPic'] . "'></span><img class='postingimg overlayImage' style='width:100%; height: 80px;' data-name='fi_".$i."' src=' " . ($picture) . "' ><label style='font-size: 10px;'><input type='radio' class='featureImg' name='featureImg_' id='fi_".$i."' ".$select." value='0' />Feature Image</label></div>";
                                                                                                                $i++;
                                                                                                            }
                                                                                                        }
                                                                                                    }

                                                                                                    ?>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- <div class="row <?php echo ($_GET["categoryid"] == 13 || $_GET["categoryid"] == 2 || $_GET["categoryid"] == 5 ? "hidden" : ""); ?>">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="postingvideo">Add video</label>
                                                                            <input type="file" class="spmedia" name="spPostingMedia[]" accept="video/*">
                                                                            <p class="help-block"><small>Browse files from your device</small></p>
                                                                        </div>
                                                                    </div>
                                                                    <div id="media-container"></div>                                                
                                                                </div> -->
                                                                        <!--checking-->

                                                                        <div class="row" style="padding: 15px;">
                                                                            <div class="col-md-6">
                                                                                <!--<a id="PostViewAll" href="../../my-posts/" class="btn btn-primary" role="button" style="width:7cm;">View All Post</a>-->
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <?php
                                                                                if (isset($_GET["postid"])) {
                                                                                    echo "
                                                                             <a class='btn btn-info pull-right' style='width: 4cm;border-radius: 25px;'  
                                                                             href='deletePost.php?postid=" . $_GET['postid'] . "'>
                                                                             Delete post</a>";
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                        <!--complete-->

                                                                        <div class="row" style="padding: 15px;">

                                                                            <div class="col-md-4 ">
                                                                                <div class="form-group">
                                                                                    <label for="email">Contact By</label>
                                                                                    <div class="radio form-control no-margin" id="contatcby">
                                                                                        <label class="checkbox-inline">
                                                                                            <input type="checkbox" id="spPostingEmail" name="spPostingEmail" value="1" checked> Email
                                                                                        </label>
                                                                                        <label class="checkbox-inline">
                                                                                            <input type="checkbox" id="spPostingPhone" name="spPostingPhone" value="0"> Phone
                                                                                        </label>
                                                                                    </div>


                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-8 ">
                                                                                <!--   <button  type="button" style="float: right;outline: 0px;" class="btn btnd_store" id="sppreviewSaveDraftStore" data-toggle="modal" data-target="#preview"  >Preview</button> -->

                                                                                <!--  <button  type="button" style="float: right;outline: 0px;border-radius:20px;background-color: #1c6121;" class="btn btn_buy_now btn_cart  btnpublishpre" id="sppreviewSaveDraftStore">Preview And Draft</button> -->




                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>


                                                        </div>
                                                </div>

                                            </div>



                                            <?php if (isset($_GET['postid'])) { ?>


                                                <div class="row no-margin" id="bootomsellfrm" style="padding: 15px;">

                                                <?php  } else { ?>



                                                    <div class="row no-margin" id="bootomsellfrm" style="padding: 15px;;display:none;">


                                                    <?php  } ?>


                                                    <div class="col-md-3 col-xs-12">
                                                        <!--<button type="submit" id="preview" class="btn btn-info">Preview</button>-->
                                                        <div class="btn-group">
                                                            <!--<button id="spPostSubmit" type="submit" class="btn btn-success">Public Post</button>-->
                                                            <button id="postingtype" type="button" class="btn btn-success publicbtn <?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>">Public</button>


                                                            <button type="button" class="btn  btn-success dropdown-toggle publicbtn_drpdown yle<?php echo (isset($_GET["groupflag"]) ? "hidden" : "") ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: 34px;"><span class="caret"></span></button>
                                                            <ul class="dropdown-menu posttype" style="    border-radius: 15px!important;">
                                                                <li><a id="postpublic" style="cursor:pointer;" class="publicselect">Public</a></li>
                                                                <li><a id="postgroup" style="cursor:pointer;" class="publicselect">Group</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-xs-12">
                                                        <div id="sp-group-container" class="input-group hidden">
                                                            <input class="form-control publicbtn" id='group_' name="group" type="text" placeholder="Type to Select Group...">

                                                            <span class="input-group-btn">
                                                                <!--<button class="btn btn-default" type="button" data-toggle="modal" data-target="#addGroup">Add New</button>-->
                                                                <a href="../../my-groups/" class="btn btn-default publicbtn_drpdown" type="button">Add New</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 col-xs-12 no-padding" id="btnmobSet " style="">
                                                        <?php

                                                        if (isset($_GET['postid']) && $_GET['postid'] > 0) {
                                                            if ($visibility == 0) {
                                                        ?>
                                                                <button id="spPostSubmitStorepublish" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px!important;">Publish</button>
                                                                <!--  <button id="spSaveDraftStore" type="button" class="btn butn_draf bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px!important;">Save Draft</button> -->
                                                                <button id="spprevieweditSaveDraftStore" type="button" class="btn butn_draf bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px!important;">Save Draft</button>


                                                                <a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php/'; ?>" class="btn butn_cancel" style="border-radius: 20px!important;">Cancel Post</a>
                                                            <?php
                                                            } else if ($visibility == -2) {
                                                            ?>
                                                                <!-- <button id="spSaveDeactiveStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px!important;;">Update</button> -->
                                                                <button id="spPostSubmitStore" type="button" class="btn butn_draf" style="border-radius: 20px!important;;">Upadate & Activate Product</button>
                                                                <a href="<?php echo $BaseUrl . '/store/dashboard/deactive.php/'; ?>" class="btn butn_cancel bradius-20" style="border-radius: 20px!important;;">Cancel Post</a>
                                                            <?php

                                                            } else if (isset($_GET['exp']) && $_GET['exp'] == 1) {

                                                            ?>
                                                                <button id="spPostSubmitStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px;">Repost</button>
                                                                <a href="<?php echo $BaseUrl . '/store/dashboard/expire.php/'; ?>" class="btn butn_cancel" style="border-radius: 20px!important;;">Cancel Post</a>
                                                            <?php

                                                            } else {

                                                            ?>
                                                                <button id="spPostSubmitStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px;">Update</button>
                                                                <button id="spSaveDeactiveStore" type="button" class="btn butn_draf bradius-20" style="border-radius: 20px;">De-Activate</button>
                                                                <a href="<?php echo $BaseUrl . '/store/dashboard/active_product.php/'; ?>" class="btn butn_cancel bradius-20" style="border-radius: 20px!important;">Cancel Post</a>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <!--  <button id="spPostSubmitStore" type="button" class="btn btn-submit bradius-20 <?php echo (isset($_GET["postid"]) ? "editing" : ""); ?>" style="border-radius: 20px;">Submit</button> -->

                                                            <!--  <button id="spSaveDraftStore" type="button" class="btn butn_draf" style="border-radius: 20px">Save Draft</button> -->

                                                            <!-- <a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php'; ?>" id="sell_can" class="btn bradius-20" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);color:#fff;">View Draft</a> -->
                                                            <a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php'; ?>" id="sell_can" class=" bradius-20"><u>View All Drafts</u></a>&nbsp;&nbsp;
                                                            <!--  <button id="spSaveDraftStore" type="button" class="btn butn_draf" style="border-radius: 20px">Save Draft</button> -->

                                                            <button id="sppreviewSaveDraftStore" type="button" class="btn butn_draf" style="border-radius: 20px;background-color: #1c6121;background-image: -webkit-linear-gradient(90deg,#1c6121 0,#1c6121 99%);"> Preview</button>

                                                            <a href="<?php echo $BaseUrl . '/store/dashboard/active_product.php'; ?>" id="sell_can" class="btn butn_cancel bradius-20" style="border-radius: 20px;">Reset Post</a>

                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
        </section>
        <?php include('../../component/f_footer.php'); ?>

        <!-- bootstrap color picker -->
        <script src="<?php echo $BaseUrl . '/assets/colorpicker/bootstrap-colorpicker.min.js';  ?>" type="text/javascript"></script>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
        <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>

        <script type="text/javascript">
            //Colorpicker
            $(".my-colorpicker1").colorpicker();
            //color picker with addon
            $(".my-colorpicker2").colorpicker();
        </script>
    </body>

    </html>
<?php
}
?>
<script type="text/javascript">
    $(function() {

        $(".addcustomsell").on("change", "#sellType_", function(e) {

            //alert($(this).val());

            //console.log($(this).val());

            /* if ($(this).val() == "Buynow"){
                 $(".hidbuy").load("../buynow.php", {profileid: $("#spProfiles_idspProfiles").val(), retailflag: 1, postid: $("#postid").val()}, function (response) {
                     $("#sellflag").val(2);
                 });
             }*/


            if ($(this).val() == "Auction") {
                $(".hidbuy").load("../auction.php", {
                    profileid: $("#spProfiles_idspProfiles").val(),
                    retailflag: 1,
                    postid: $("#postid").val()
                }, function(response) {
                    $("#sellflag").val(2);
                    $("#industry_select").show();
                    $("#bootomsellfrm").show(1000);

                });

                $("#sell_frm").show(1000);
            } else if ($(this).val() == "Wholesaler") {

                //alert($(this).val());
                //wholesale panel
                $(".hidbuy").load("../wholesell.php", {
                    profileid: $("#spProfiles_idspProfiles").val(),
                    retailflag: 1,
                    postid: $("#postid").val()
                }, function(response) {
                    $("#sellflag").val(0);
                    $("#industry_select").show();
                    $("#bootomsellfrm").show(1000);
                });

                $("#sell_frm").show(1000);
            } else if ($(this).val() == "Retail") {
                //$("#industry_select").show();

                // alert($(this).val());
                $(".hidbuy").load("../retail.php", {
                    profileid: $("#spProfiles_idspProfiles").val(),
                    retailflag: 1,
                    postid: $("#postid").val()
                }, function(response) {
                    $("#sellflag").val(2);
                    $("#industry_select").show();
                    $("#bootomsellfrm").show(1000);
                });

                $("#sell_frm").show(1000);
            } else if ($(this).val() == "0") {

                $("#sell_frm").hide(1000);
                $("#bootomsellfrm").hide(1000);

            }



            /*   $("#sell_frm").hide(1000);*/

        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('#auctionPrice').keypress(function(e) {
            if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                e.preventDefault(); //stop character from entering input
            }
        });

        $('#auctionQuantity_').keypress(function(e) {
            if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                e.preventDefault(); //stop character from entering input
            }
        });

        $('.size').keypress(function(e) {
            if (isNaN(this.value + "" + String.fromCharCode(e.charCode))) {
                e.preventDefault(); //stop character from entering input
            }
        });


    });
</script>

<script>
    function myFunction(browser) {
        document.getElementById("selltype").value = browser;
    }

    $("#preview_product").click(function() {
        var selltype = $("#sellType_").val();
        var spPostingTitle = $("#spPostingTitle").val();
        var auctionQuantity_ = $("#auctionQuantity_").val();
        var auctionStatus_ = $("#auctionStatus_").val();
        var auctionPrice = $("#auctionPrice").val();
        var spPostingNotes = $("#spPostingNotes").val();
        /*alert(selltype);
        alert(spPostingTitle);
        alert(auctionQuantity_);
        alert(auctionStatus_);
        alert(auctionPrice);
        alert(spPostingNotes);*/



        //alert(images);
    });


    $("#spPostSubmitStorepublish").click(function() {

        /* var selltype = $("#sellType_").val();
         var spPostingTitle = $("#spPostingTitle").val();
         var auctionQuantity_ = $("#auctionQuantity_").val();
         var auctionStatus_ = $("#auctionStatus_").val();
         var auctionPrice = $("#auctionPrice").val();
         var spPostingNotes = $("#spPostingNotes").val();*/

        var postid = "<?php echo $_GET["postid"]; ?>"
        var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";


        /*alert(postid);*/
        $.ajax({
            url: MAINURL + "/store/prevpublish.php",
            type: "POST",
            data: 'postid=' + postid,

            success: function(vi) {


                window.location.href = MAINURL + "/post-ad/sell/posting.php?postid=" + postid.trim();
                /* swal({
                          title: "Publish Successfully!",
                          imageUrl: logo,
                          confirmButtonClass: "sweet_ok",
                          confirmButtonText: "Ok",
                      },
                      function(){
                         //window.location.reload();
                         //window.location.href = MAINURL+"/post-ad/sell/posting.php?postid="+postid.trim();
                      });
                 */
                //window.location.reload();
            },
            error: function(error) {

            }
        });


    });



    /*$("#subcategory_").change(function(){

    if ($("#subcategory_ option[value=Clothing]:selected").length > 0){
        alert('all is selected');
    }

    });*/

    // alert("The paragraph was clicked.");

    /*$( "#preview" ).on('shown', function(){
        alert("I want this to appear after the modal has opened!");
    });*/
    /*function productpreview() {
      
     

    }*/

    /*$(document).ready(function(){
        $("#subcategory_").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");


                alert(optionValue);
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();
    });*/
</script>