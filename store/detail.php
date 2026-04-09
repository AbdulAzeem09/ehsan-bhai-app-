    <?php 
    /* error_reporting(E_ALL);
    ini_set('display_errors', '1'); */
    include('../univ/baseurl.php');     
    ?>
     <?php
     $postId = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
     ?>
    <meta property="og:url" content='<?php echo $BaseUrl; ?>/store/detail.php?catid=1&postid=<?php echo $postId; ?>'/> 
    <?php
    session_start();
    if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "store/";
    //die("11111111111ssssssssssss");
    include_once("../authentication/check.php");
    } else {


    if ($postId && $postId > 0 && isset($_GET['catid']) && $_GET['catid'] == 1) {
    } else if ($postId && $postId > 0) {
    }

    

    function sp_autoloader($class)
    {
    include '../mlayer/' . $class . '.class.php';
    }

    require_once "../common.php";

    spl_autoload_register("sp_autoloader"); 

    $_GET['categoryID'] = 1;

    $pr = new _spprofiles;
    $result  = $pr->read($_SESSION["pid"]);
    if ($result != false) {
    $sprows = mysqli_fetch_assoc($result);
    $profileType = $sprows["spProfileType_idspProfileType"];
    }

    ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- <meta property="og:image" content="https://static.sacnilk.com/articles/entertainment/box_office/10319.jpg"> -->


    <!-- shani74747474 -->

    <meta property="og:title" content='TheSharePage Shani'/>
    <meta property="og:image" content='<?php echo $BaseUrl; ?>/assets/images/logo/tsp_trans.png'/>
    <meta property="og:description" content='Check Description Shani'/>
    <meta property="og:site_name" content="The Team SharePage shani"/>
    <!-- <meta property="og:url" content='<?php echo $BaseUrl; ?>/store/detail.php?catid=1&postid=<?php echo $_GET["postid"]; ?>'/> -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel='stylesheet' type="text/css"  href='<?php echo $BaseUrl; ?>/assets/css/lightslider.css'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

    <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">
    <?php include('../component/f_links.php'); ?>

    <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/jquery.hc-sticky.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
      function execute(settings) {
        $('#sidebar').hcSticky(settings);
      }
      if (top === self) {
        execute({
          top: 20,
          bottom: 50
        });
      }

      function execute_right(settings) {
        $('#sidebar_right').hcSticky(settings);
      }
      if (top === self) {
        execute_right({
          top: 20,
          bottom: 50
        });
      }
    
    });
    </script>

    <script type="text/javascript">
    //USER ONE
    $(function() {
    $('#leftmenu').multiselect({
    includeSelectAllOption: true
    });

    });
    </script>

    <script type="text/javascript">
    jQuery(document).ready(function($) {

    $('#carousel-text').html($('#slide-content-0').html());
    //Handles the carousel thumbnails
    $('[id^=carousel-selector-]').click(function() {
    var id = this.id.substr(this.id.lastIndexOf("-") + 1);
    var id = parseInt(id);
    $('#myCarousestore').carousel(id);
    });
    // When the carousel slides, auto update the text
    $('#myCarousestore').on('slid.bs.carousel', function(e) {
    var id = $('.item.active').data('slide-number');
    $('#carousel-text').html($('#slide-content-' + id).html());
    });
    });
    </script>


    <style type="text/css">
      /*mbl*/
     @media screen and (max-width: 800px) {
      .card {
      margin-top: 10px!important;
      margin-bottom: 10px!important;
      }
      table.table.table-borderless td {
       border: 1px solid #e7e5e5;
     }
   
.table tbody tr td:first-child, .table tbody tr td {
    font-size: 15px;
    font-weight: 300;
}
     }

    .btn_box button,
    .btn_box input[type="submit"] {
    width: 40%;
    margin-right: 5px;
    margin-bottom: 15px;
    }

    .panel-heading {
    height: 42px;
    padding: 0px 0px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    }

    ul.lSPager.lSGallery {
    height: 40px;
    }

    .right_head_top ul li p {
    color: #fff;
    font-family: lucidaSans;
    font-size: 12px;
    margin: 0;
    padding-top: 0px;
    float: left;
    }

    .col-md-4.col-xs-12.no-padding {
    height: 20px;
    }


    .rating-box {
    position: relative !important;
    vertical-align: middle !important;
    font-size: 18px;
    font-family: FontAwesome;
    display: inline-block !important;
    color: lighten(@grayLight, 25%);
    }

    .rating-box:before {
    content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
    }

    .ratings {
    position: absolute !important;
    left: 0;
    top: 0;
    white-space: nowrap !important;
    overflow: hidden !important;
    color: Gold !important;

    }

    .ratings:before {
    content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
    }

    .flag:hover {
    color: #428bca !important;
    }



    .heading {
    font-size: 25px;
    margin-right: 10px;
    }

    .checked {
    color: gold;
    }

    .side {
    float: left;
    width: 15%;
    margin-top: 10px;
    }

    .middle {
    margin-top: 10px;
    float: left;
    width: 68%;
    padding-left: 10px;
    }

    .right {
    text-align: right;
    }

    .row:after {
    content: "";
    display: table;
    clear: both;
    }

    html {
    scroll-behavior: smooth;
    }

    .bar-container {
    width: 100%;
    background-color: #f1f1f1;
    text-align: center;
    color: white;
    }

    .bar-5 {
    width: 60%;
    height: 18px;
    background-color: #4CAF50;
    }

    .bar-4 {
    width: 30%;
    height: 18px;
    background-color: #2196F3;
    }

    .bar-3 {
    width: 10%;
    height: 18px;
    background-color: #00bcd4;
    }

    .bar-2 {
    width: 4%;
    height: 18px;
    background-color: #ff9800;
    }

    .bar-1 {
    width: 15%;
    height: 18px;
    background-color: #f44336;
    }

    /* Responsive layout - make the columns stack on top of each other instead of next to each other */
    @media (max-width: 400px) {

    .side,
    .middle {
    width: 100%;
    }

    .right {
    display: none;
    }

    #p2 {

    line-height: 1.4;

    margin-top: -2px;
    }

    #composTxtNow1 {
    background-color: green !important;
    font-weight: 100 !important;
    }

    .btn-secondary {
    background-color: #cf0e0e !important;
    border-radius: 4px !important;
    font-weight: 100 !important;
    }

    #profileDropDown li a img {
    margin-top: 10px;
    }

    #profileDropDown li.active {
    background-color: #0f8f46;
    }

    #profileDropDown li.active a {
    color: #fff;
    }

    .caret {
    margin-bottom: 12px !important;
    }
    </style>
    <style type="text/css">
    .btn-light.wishlist {
    background-color: white;
    }

    @media (max-width: 480px){
.btn_search{
    margin-top:30px!important;
    margin-left:30px!important;
}
.search_text{
    width:100%!important;
}
#header_name{
    height:305px!important;
}
#seller_text{
    margin-left:80px!important;
}
#mob_view{

    margin-top:-30px!important;
}
    }

    .card {
    background-color: #fff;
    padding: 14px;
    border: none
    }

    .demo {
    width: 100%
    }

    ul {
    list-style: none outside none;
    padding-left: 0;
    margin-bottom: 0
    }

    .prod_pic {
    display: block;
    height: auto;
    width: 100%
    }

    .stars i {
    color: #f6d151
    }

    .stars span {
    font-size: 13px
    }

    hr {
    color: #d4d4d4
    }

    .badge {
    padding: 5px !important;
    padding-bottom: 6px !important
    }

    .badge i {
    font-size: 10px
    }

    .profile-image {
    width: 35px
    }

    .comment-ratings i {
    font-size: 13px
    }

    .username {
    font-size: 12px
    }

    .comment-profile {
    line-height: 17px
    }

    .date span {
    font-size: 12px
    }

    .p-ratings i {
    color: #f6d151;
    font-size: 12px
    }

    .btn-long {
    padding-left: 35px;
    padding-right: 35px
    }

    .buttons {
    margin-top: 15px
    }

    .buttons .btn {
    height: 46px
    }

    .buttons .cart {
    border-color: #fff;
    color: #fff;
    }

    .buttons .cart:hover {
    background-color: #e86464 !important;
    color: #fff
    }

    .buttons .buy {
    color: #fff;
    background-color: #ff7676;
    border-color: #ff7676
    }

    .buttons .buy:focus,
    .buy:active {
    color: #fff;
    background-color: #ff7676;
    border-color: #ff7676;
    box-shadow: none
    }

    .buttons .buy:hover {
    color: #fff;
    background-color: #e86464;
    border-color: #e86464
    }

    .buttons .wishlist {
    background-color: #fff;
    border-color: #ff7676
    }

    .buttons .wishlist:hover {
    background-color: #e86464;
    border-color: #e86464;
    color: #fff;
    }

    .buttons .wishlist:hover i {
    color: #fff;
    }

    .buttons .wishlist i {
    color: #ff7676;
    }

    .comment-ratings i {
    color: #f6d151
    }

    .followers {
    font-size: 9px;
    color: #d6d4d4
    }

    .store-image {
    width: 42px
    }

    .dot {
    height: 10px;
    width: 10px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    margin-right: 5px
    }

    .bullet-text {
    font-size: 12px
    }

    .my-color {
    margin-top: 10px;
    margin-bottom: 10px;
    display: flex;
    }

    label.radio {
    cursor: pointer
    }

    label.radio input {
    position: absolute;
    top: 0;
    left: 0;
    visibility: hidden;
    pointer-events: none
    }

    label.radio span {
    border: 2px solid #8f37aa;
    display: inline-block;
    color: #8f37aa;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    text-transform: uppercase;
    transition: 0.5s all
    }

    label.radio .red {
    background-color: red;
    border-color: red
    }

    label.radio .blue {
    background-color: blue;
    border-color: blue
    }

    label.radio .green {
    background-color: green;
    border-color: green
    }

    label.radio .orange {
    background-color: orange;
    border-color: orange
    }

    label.radio input:checked+span {
    color: #fff;
    position: relative
    }

    label.radio input:checked+span::before {
    opacity: 1;
    content: '\2713';
    position: absolute;
    font-size: 13px;
    font-weight: bold;
    left: 4px
    }

    .card-body {
    padding: 0.3rem 0.3rem 0.2rem
    }

    .font-weight-bold {
    font-weight: bold;
    }

    .similar-products {
    display: flex;
    }

    .checkbox+.checkbox,
    .radio+.radio {
    margin-top: 10px;
    }

    .border {
    border: thin solid #ccc;
    border-radius: 5px;
    padding: 2px;
    width: 18rem;
    margin-right: 3px;
    }

    #stittle {
    white-space: nowrap;
    width: 90px;
    overflow: hidden;
    text-overflow: ellipsis;
    }

    .example button {
    float: left;
    background-color: #4E3E55;
    color: white;
    border: none;
    box-shadow: none;
    font-size: 17px;
    font-weight: 500;
    font-weight: 600;
    border-radius: 3px;
    padding: 15px 35px;
    margin: 26px 5px 0 5px;
    cursor: pointer;
    }

    .example button:focus {
    outline: none;
    }

    .example button:hover {
    background-color: #33DE23;
    }

    .example button:active {
    background-color: #81ccee;
    }

    fieldset {
    display: none;
    }

    .msgNotify {
    margin-top: 5px !important;
    margin-left: 10px !important;
    font-size: 7px !important;
    }

    #notification_count {
    font-size: 7px;
    padding: 1px 6px 0px 5px;
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
    .header_store
    {
    padding: 0px 10px 10px;
    }
    </style>


    </head>

    <body cz-shortcut-listen="true">



    <?php

    //this is for store header

    $header_store = "header_store"; 

    $folder = "store";
    include("../header.php");
    ?>
    <style>
    .inner_top_form button {
    margin-top: 5px;
    border-radius: 0px;
    padding: 9.5px 12px; 
    }
    </style>

    <?php

    $ponv = new _spproductoptionsvalues;
    $pro = new _spprofiles;
    $p = new _productposting;
    $rd = $p->read($postId);
    //echo $p->ta->sql;
    //die("============");
    if ($rd != false) {


    $row = mysqli_fetch_assoc($rd);

    //print_r($row );
    $userId = $row['spuser_idspuser'];
    //echo $row['spuser_idspuser'].'<br>';                 
    //echo $_SESSION['uid'];

    $poster_id = $row['spProfiles_idspProfiles'];
    $poster_detail = $pro->read($poster_id);

    if ($poster_detail != false) {
    $poster_row = mysqli_fetch_assoc($poster_detail);
    }

    $auctionStatus = $row['auctionStatus'];
    $selltype = $row['sellType'];

    if ($selltype == "Auction") {

    $Quantity = $row['auctionQuantity'];
    } elseif ($selltype == "Retail") {

    $Quantity = $row['retailQuantity'];
    } elseif ($selltype == "Wholesale") {

    $Quantity = $row['supplyability'];
    } else {
    $Quantity = $row['retailQuantity'];
    }

    if ($selltype == "Auction") {

    $ItemCondition = $row['auctionStatus'];
    } elseif ($selltype == "Retail") {

    $ItemCondition = $row['retailStatus'];
    }

    $Itemdescription = $row['description'];

    $price = $row['spPostingPrice'];

    if ($selltype == "Auction") {

    $ExpiryDate = $row['spPostingExpDt'];
    } elseif ($selltype == "Retail") {

    $ExpiryDate = $row['spPostingExpDt'];
    }


    $curr = $row['default_currency'];
    //echo $curr;die("=====");
    $minorderqty = $row['minorderqty'];
    $supplyability = $row['supplyability'];
    $paymentterm = $row['paymentterm'];


    $spid = $row['idspPostings'];
    $myuserid   = $poster_row['idspProfiles'];


    $postingexpire = $row['spPostingExpDt'];
    $PostTitle  = $row['spPostingTitle'];
    $price      = $row['spPostingPrice'];
    if ($row['sellType'] == 'Retail') {
    if ($row['retailSpecDiscount'] != '') {
    $discount   = $row['retailSpecDiscount'];
    } else {
    $discount   = $row['spPostingPrice'];
    }
    }
    if ($row['sellType'] == 'Wholesale') {
    $discount   = $row['spPostingPrice'];
    }

    //echo $discount;
    $org_price = ((int)$discount * (int)$price) / 100;
    //echo $dis_price;
    $disc_price = $price - $org_price;
    //echo $disc_price;
    $catid      = $row["spCategories_idspCategory"];
    $wholesaleflag = $row["spPostingsFlag"];
    $button     = $row["spCategoriesButton"];
    $comment    = $row["sppostingscommentstatus"];
    $Country    = $row['spPostingsCountry'];
    $City       = $row['spPostingsCity'];
    $dt         = new DateTime($row['spPostingDate']);
    $desc       = $row['spPostingNotes'];
    $specification       = $row['specification'];
    $description       = $row['description'];

    $SellName   = $poster_row['spProfileName'];
    $SellEmail  = $poster_row['spProfileEmail'];
    $SellPhone  = $poster_row['spProfilePhone'];
    $SellAdres  = $row['spprofilesAddress'];
    $SellCity   = $poster_row['spProfilesCity'];
    $SellCounty = $poster_row['spProfilesCountry'];
    $SellId     = $row['spProfiles_idspProfiles'];

    $Sell_uid     = $row['spuser_idspuser'];
    $producttype = $row['product_type'];

    $category     = $row['subcategory'];
    $cancel     = $row['is_cancel'];
    $refund     = $row['is_refund'];
    $within     = $row['refund_within'];
    $sippingcharge = $row['sippingcharge'];
    $fixed = $row['fixedamount'];

    $p = new _productposting;
    $result4 = $p->publicpost_count($SellId);
    if ($result4 != false) {
    $SelProduct = mysqli_num_rows($result4);
    } else {
    $SelProduct = 0;
    }
    }


    $pv = new _productposting;
    $rdf = $pv->read($postId);

    if ($rdf != false) {

    $rowf = mysqli_fetch_assoc($rdf);
    $spPostFieldValue = $rowf['spPostFieldValue'];
    }

    $currentDateTime = date('Y-m-d H:i:s');
    $pv = new _spproduct_view;

    $allreadyviews =  $pv->readviewed($_SESSION['uid'], $spid);

    if ($allreadyviews != "") {
    $viewed = mysqli_fetch_assoc($allreadyviews);
    if (empty($allreadyviews)) {
    $resv = $pv->insertrecent_viewproduct($spid, $SellId, $_SESSION['uid'], $currentDateTime);
    }
    }
    ?>



    <div class="container">
    <div class="row">
    <div class="col-md-8" style="margin-top: 10px;">
    <?php if ($selltype == 'Retail') { ?>

    <ul class="breadcrumb 11" style="padding-bottom: 0px;font-size: 15px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 12px;">
    <li><a href="<?php echo $BaseUrl . '/store/storeindex.php?folder=home'; ?>" style="color:#428bca"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

    <li><a href="<?php echo $BaseUrl . '/retail/view-all.php?condition=All&folder=retail&page=1'; ?>" style="color:#428bca">Retail</a></li>

    <li><a><?php echo $PostTitle;?></a></li>

    </ul>

    <?php } ?>

    <?php if ($selltype == 'Personal') { ?>

    <ul class="breadcrumb 33" style="padding-bottom: 0px;font-size: 15px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 12px;">
    <li><a href="<?php echo $BaseUrl . '/store/storeindex.php?folder=home'; ?>" style="color:#428bca"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

    <li><a href="<?php echo $BaseUrl . '/store/personal.php'; ?>" style="color:#428bca">Personal</a></li>

    <li><a><?php echo $PostTitle;?></a></li>

    </ul>

    <?php } ?>


    <?php if ($selltype == 'Wholesale') { ?>





    <ul class="breadcrumb 55" style="padding-bottom: 0px;font-size: 15px; padding: 4px 0px; list-style: none;background: none !important;margin-bottom: 12px;">
    <li><a href="<?php echo $BaseUrl . '/store/storeindex.php?folder=home'; ?>" style="color:#428bca"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

    <li><a href="<?php echo $BaseUrl . '/wholesale/?condition=All&folder=wholesale&page=1'; ?>" style="color:#428bca">Wholesale</a></li>

    <li><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowf['idspPostings']; ?>" style="color:#428bca">Product Detail</a></li>

    </ul>

    <?php } ?>

    <?php if ($selltype == 'Auction') { ?>




    <ul class="breadcrumb 22" style="padding-bottom: 0px;font-size: 15px; padding: 4px 0px; list-style: none;background: none !important;margin-bottom: 12px;">
    <li><a href="<?php echo $BaseUrl . '/store/storeindex.php?folder=home'; ?>" style="color:#428bca"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

    <li><a href="<?php echo $BaseUrl . '/store/view-all-auction.php?type=auction&folder=store&page=1'; ?>" style="color:#428bca">Auction</a></li>
    <li><a href="<?php echo $BaseUrl . '/' . $folder . '/detail.php?catid=1&postid=' . $rowf['idspPostings']; ?>" style="color:#428bca">Product Detail</a></li>

    </ul>

    <?php } ?>

    </div>



    </div>


    <div class="store_searchbox" style="background-color: #ffff;border-radius: 36px; height:60px">
    <form method="POST" action="<?php echo $BaseUrl . '/store/search.php'; ?>">
    <div class="">
    <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore'])) ? $_GET['mystore'] : '1' ?>">
    <?php if ($profileType != '2' && $profileType != '5') {
    $priceWidth = "74%";
    } else {
    $priceWidth = "88%";
    }
    ?>
    <input style="border-radius: 19px;background-color: #e6eeff;padding:18px 10px;width: <?php echo $priceWidth ?>;" type="text" class="form-control search_text " name="txtStoreSearch" placeholder="Search For Products in <?php echo $selltype; ?>" required>
    <button type="submit" class=" btnd_store btn btn-info btn_search btn-border-radius" name="btnSearchStore" style="padding: 10px 36px;background-color: #035049;">Search</button>
    <?php if ($profileType != '2' && $profileType != '5') { ?>
    <a href="<?php echo $BaseUrl ?>/post-ad/sell/?post" class="btn sell btn_search  btn-border-radius" style="width: auto;background-color:#FFA500; color:white; font-size:13px; padding: 9px 30px!important;">Sell Product</a>
    <?php } ?>
    </div>
    </form>

    </div>


    <div class="col-md-7 pr-2">
    <div class="card">
    <div class="demo">
    <ul id="lightSlider">
    <?php
    $pc = new _productpic;
    //$res2 = $pc->read($postId);
    if($postId){
      $res2 = selectQ("select * from spproductpics where sppostings_idsppostings =? order by sppostings_idsppostings asc", "i", [$postId]);
    }

    if (isset($res2) && count($res2) > 0) {
    $x = 4;
    foreach($res2 as $rp) {
    $pic2 = $rp['spPostingPic'];
    ?>


    <li data-thumb="<?= $pic2; ?>"> <img src="<?= $pic2; ?>" width="200px" height="180px" class="prod_pic" /> </li>
    <?php }
    }else{
    
    ?>
   <img src="<?php echo $baseurl ?>/assets/images/blank-img/no-store.png" alt="">
    <?php
    }
    ?>

    <!--        <li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
    <li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>   -->


    </ul>
    </div>


    <ul class="produc_quote_box social">
    <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
    <li>
    <?php
    //echo $SellId;die;


    if ($Sell_uid != $_SESSION['uid']) { //echo 1;
    ?>

    <a id="enquire_sell" data-toggle="modal" data-target="#enqueryModal"><i class="fa fa-comments "></i> Enquiry</a>

    <?php } else { //echo 2;
    ?>

    <a href="#" id="enquire" data-toggle="modal" data-target="#enqueryModal1"><i class="fa fa-comments"></i> Enquiry</a>

    <?php }  ?>

    </li>
    <?php } ?>


    <?php
    $pc = new _productpic;
    $resp = $pc->read($postId);
    //echo $pc->ta->sql;
    if ($resp != false) {
    $postrp = mysqli_fetch_assoc($resp);
    $pictp = $postrp['spPostingPic'];
    }  ?>

    <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
    <li><a href="javascript:void(0)" data-toggle='modal' data-target='#myshare'><span class='sp-share' data-postid='<?php echo $postId; ?>' src='<?php echo ($pictp); ?>'><i class="fa fa-share-alt"></i> Share</span></a></li>

    <li>
    <?php } ?>
    <?php



    $r = new _spstorereview_rating;

    $sumres = $r->readstorerating($postId);
    //    echo $r->ta->sql;
    if ($sumres != false) {
    while ($sumrow = mysqli_fetch_assoc($sumres)) {
    //print_r($sumrow);

    $sumrating += $sumrow['rating'];

    $ratarr[] =  $sumrow['rating'];
    }

    $countrate = count($ratarr);

    $averagerate = $sumrating / $countrate;

    $totalrate  = round($averagerate, 1);
    ?>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">


    <!-- <div class="col-md-3 no-padding-left" style="width: 18%;">         -->
    <div class="rating-box" id="rating-box" data-container="body" data-toggle="popover" data-placement="right" data-content="10" data-original-title="" title="">
    <?php if ($totalrate >= "5") {
    echo '<div class="ratings" style="width:100%;"></div>';
    } else  if ($totalrate > "4" && $totalrate < "5") {
    echo '<div class="ratings" style="width:92%;"></div>';
    } else  if ($totalrate >= "4") {
    echo '<div class="ratings" style="width:80%;"></div>';
    } else  if ($totalrate > "3" && $totalrate < "4") {
    echo '<div class="ratings" style="width:72%;"></div>';
    } else  if ($totalrate >= "3") {
    echo '<div class="ratings" style="width:60%;"></div>';
    } else  if ($totalrate > "2" && $totalrate < "3") {
    echo '<div class="ratings" style="width:51%;"></div>';
    } else  if ($totalrate >= "2") {
    echo '<div class="ratings" style="width:38%;"></div>';
    } else  if ($totalrate > "1" && $totalrate < "2") {
    echo '<div class="ratings" style="width:29%;"></div>';
    } else  if ($totalrate >= "1") {
    echo '<div class="ratings" style="width:16%;"></div>';
    } else  if ($totalrate <= "0") {
    echo '<div class="ratings" style="width:0%;"></div>';
    }

    ?>

    </div>



    <?php

    }
    ?>

    </li>

    </ul>

    </div>


    <style>
    .nav>li>a {
    position: relative;
    display: block;
    padding: 10px 10px;
    </style>

    <div class="card mt-2">
    <div class="panel panel-default">

    <div class="panel-heading panel-heading-nav">

    <ul class="nav nav-tabs col-md-12">
    <li role="presentation" class="active">
    <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a>
    </li>
    <li role="presentation">
    <a href="#tab1default" aria-controls="tab1default" role="tab" data-toggle="tab">Description</a>
    </li>
    <li role="presentation">
    <a href="#tab2default" aria-controls="tab2default" role="tab" data-toggle="tab">Specifications</a>
    </li>
    <li role="presentation">
    <a href="#tab3default" aria-controls="tab3default" role="tab" data-toggle="tab">Seller</a>
    </li>
    <?php if ($selltype != 'Auction'  && $selltype != "Wholesale") { ?>
    <li role="presentation">

    <a href="#tab5default" aria-controls="tab5default" role="tab" data-toggle="tab">T&C</a>

    </li>
    <?php } ?>
    <li role="presentation">
    <a href="#tab6default" aria-controls="tab6default" role="tab" data-toggle="tab">Shipping Charges</a>


    </li>
    <?php if ($selltype == 'Auction') { ?>
    <li role="presentation">
    <a href="#tab4default" aria-controls="tab4default" role="tab" data-toggle="tab">All Bids</a>
    </li>
    <?php } ?>
    </ul>


    </div>

    <style type="text/css">
    }

    .rate-bg {
    height: 22px;
    background-color: #ffbe10;
    position: absolute;
    }
    </style>

    <div class="panel-body">
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="reviews">
    <?php
    $sr = new _spproduct_review;
    $status = $sr->readallrating($postId, 'Store');

    // print_r($status);
    // die("dskjfds");

    if ($status != false) {
    while ($row = mysqli_fetch_assoc($status)) {

    //while($data = mysqli_fetch_assoc($status)){


    //    }
    //echo "<br>";
    //print_r($row); 

    $date = $row['date'];
    //$date1 = date('Y-m-d', strtotime($date));
    $review = $row['review_star'];
    $user_profileid = $row['user_profileid'];


    $sp = new _spprofiles;
    $result = $sp->readname($user_profileid);

    if ($result != false) {
    $row1 = mysqli_fetch_assoc($result);
    }
    ?>




    <div class="comment-section">
    <div class="d-flex justify-content-between align-items-center">
    <div class="">
    <div class="row ">
    <div class="col-md-3" class="no-padding" style="width: 15%;"><img src="<?php echo $row1['spProfilePic']; ?> " class="rounded-circle profile-image" style=" border-radius: 50%; height: 45px;"></div>
    <div class="col-md-6" class="no-padding"> <a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $user_profileid; ?>"><span class="username">
    <h5><?php echo $row1['spProfileName']; ?></h5>
    </span></a></div>
    </div>
    <div class="d-flex flex-column ml-1 comment-profile">

    <?php

    $star = "<i class='fa fa-star'></i>  ";
    $count = $review;

    for ($int = 1; $int <= $count; $int++) {
    echo  "<span style='color:orange';>" . $star . "</span>";
    }
    echo "<br>";
    ?>

    <span class="username"><?php echo $row['review_comment']; ?></span>
    </div>
    </div>
    <div class="date"> <span class="text-muted"><?php echo $date; ?></span> </div>
    </div>
    </div>
    <hr>
    <?php }
    } else {

    echo "<h5>No Reviews Yet.</h5>";
    }                                                   ?>

    </div>
    <div class="tab-pane fade" id="tab1default">
    <p style="word-break: break-word;"><?php //echo $desc; ?></p>
    <p><strong style="color: #333333;">Item Description</strong>: <?php if($Itemdescription){echo $Itemdescription; } else{ echo "Not Defined";}?> </p>
    <?php if ($selltype != "Wholesale") { ?>
    <p><strong style="color: #333333;">Item Condition</strong>: <?php if($ItemCondition){echo $ItemCondition; } else{ echo "Not Defined";}?> </p>

    <?php } ?>
    </div>
    <div class="tab-pane fade" id="tab2default">
    <p><?php if (!empty($specification)) {
    echo $specification;
    } else {

    echo "No Specification Found";
    }

    ?></p>
    </div>


    <div class="tab-pane fade" id="tab3default">
    <style>
    .seller_info {

    background-color: #ffffff;
    border: none;
    padding: 10px;

    }
    </style>
    <p><?php

    include('../component/seller-info-tips.php'); 

    ?></p> 

    </div>


    <div class="tab-pane fade" id="tab5default">
    <?php 
    if ($selltype == 'Retail') {
    ?>
    <div class="d-flex flex-row align-items-center"> </i>
    <span class="ml-1"> Can Cancel ? &nbsp; &nbsp; <?php if ($cancel ==  "1") {
    echo "Yes";
    } else {
    echo "No";
    } ?></span>
    </div>

    <div class="d-flex flex-row align-items-center"></i>
    <span class="ml-1">Can Refund ? &nbsp; &nbsp; <?php if ($refund == "1") {
    echo "Yes";
    } else {
    echo "No";
    } ?></span>

    <p><?php if ($refund == "1") {
    echo "Refund within $within days";
    } ?></p>
    </div>


    <?php   } ?>

    <?php
    if ($selltype == 'Personal') {
    ?>
    <div class="d-flex flex-row align-items-center"> </i>
    <span class="ml-1"> Can Cancel ? &nbsp; &nbsp; <?php if ($cancel ==  "1") {
    echo "Yes";
    } else {
    echo "No";
    } ?></span>
    </div>

    <div class="d-flex flex-row align-items-center"></i>
    <span class="ml-1">Can Refund ? &nbsp; &nbsp; <?php if ($refund == "1") {
    echo "Yes";
    } else {
    echo "No";
    } ?></span>

    <p><?php if ($refund == "1") {
    echo "Refund within $within days";
    } ?></p>
    </div>

    <?php   } ?>


    </div>

    <div class="tab-pane fade" id="tab6default">
    <?php
    if ($sippingcharge == 1) {
    echo "Shipping Charges : Free";
    }

    if ($sippingcharge == 2) {
    $userid = $_SESSION['uid'];



    echo "Shipping Charges :" . $curr . ' ' . $fixed;
    }




    ?>

    </div>


    <div class="tab-pane fade" id="tab4default">
    <div class="table-responsive">
    <table class="table table-striped " border="1">
    <thead>
    <tr style="font-size: 18px;">
    <th>No.</th>
    <th>Bidder's Name</th>
    <th>Bid Price</th>
    <th>Bid Date/Time</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $po = new _spauctionbid;
    $result_bid = $po->auctionbid($postId);
    $i = 1;

    if ($result_bid != false) {

    while ($row_bid = mysqli_fetch_assoc($result_bid)) {

    $p = new _spprofiles;
    $NameOfProfile = $p->getProfileName($row_bid['spProfiles_idspProfiles']);

    ?>
    <?php if ($row_bid['auctionPrice']) { ?>
    <tr style="<?php if ($i == 1 && $result_bid->num_rows > 1) {
    echo "color:red; ";
    } else if ($i ==  $result_bid->num_rows) {
    echo "color:green; ";
    } ?>">
    <td ><?php echo $i; ?></td>
    <td><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $row_bid['spProfiles_idspProfiles']; ?>" style="font-size: 16px;<?php if ($i == 1 && $result_bid->num_rows > 1) {
    echo "color:red; ";
    } elseif ($i ==  $result_bid->num_rows) {
    echo "color:green; ";
    } else {
    echo "color: #428bca;";
    } ?>" onMouseOver="this.style.color='#00F'"><?php echo ucwords($NameOfProfile); ?></a></td>


    <td><?php echo $curr . ' ' . $row_bid['auctionPrice']; ?></td>

    <td><?php echo $row_bid['bid_timestamp']; ?></td>
    </tr> <?php }
    $i++;
    }
    } else {

    echo "<tr colspan='4'><td  colspan='4'><h3 style='text-align:center;' >No Bid Found.</h3></td></tr>";
    }
    ?>
    </tbody>
    </table>
    </div>

    </div>



    </div>

    </div>

    </div>

    </div>

    </div>


    <div class="col-md-5">
    <div class="pull-right">
    <ul>
    <li>
    <td style="font-size: 12px;"><b>
    <?php
    if ($selltype == "Personal") {
    echo "Personal";
    } else if ($selltype == "Retail") {
    echo "Retail";
    } else if ($selltype == "Wholesale") {
    echo "Wholesale";
    } else {
    echo "Auction";
    }

    ?> |</b>
    </td>
    <td style="font-size: 12px;">Product:</td>
    <td style="font-size: 12px;"> &nbsp;AEF-<?php echo $postId; ?></td>
    </li>
    </ul>
    </div>
    <div class="card">
    <div class="about">
    <h2 class="font-weight-bold" style="margin-top:20px;"><?php echo $PostTitle; //ucwords(substr($PostTitle,0,10)).'....';
    ?> </h2>

    <title> <?php echo $PostTitle; ?> </title>

    <table class="table table-borderless">
    <?php if ($selltype == "Wholesaler") { ?>
    <tr>
    <td>WholeSale</td>
    <td>Min Order Qty: <?php echo $minorderqty; ?></td>
    </tr>
    <?php
    }
    $or = new _order;
    $total = 0;
    $res = $or->quantityavailable($postId);

    if ($res != false) {
    while ($order = mysqli_fetch_assoc($res)) {
    if ($order["spOrderStatus"] == 0) {
    $soldquantity += $order["spOrderQty"];
    }
    }
    }

    if (isset($soldquantity)) {
    $available = $Quantity - $soldquantity;
    } else {
    $available = $Quantity;
    }
    if ($producttype == 1) {
    $resultadata = $ponv->readminmaxprice($postId, 'Store');
    if ($resultadata != false) {
    $attribadata = mysqli_fetch_assoc($resultadata);
    }
    $available = $attribadata['maxqty'];
    echo $available;
    }




    ?>
    <?php

    if ($row['sellType'] == 'Retail' || $row['sellType'] == 'Personal') {
    $p = new _productposting;
    $rd = $p->read($postId);

    if ($rd != false) {
    $row = mysqli_fetch_assoc($rd);

    $price = $row['spPostingPrice'];
    $discount1   = $row['retailSpecDiscount'];

    $discount = $row['retailSpecDiscount'];

    }
    }


    ?>

    <?php if (($discount != '') && ($selltype == "Retail") || ($selltype == "Personal")) { ?>
    <tr>
    <td><strong>Price</strong></td>
    <?php if ($price >  $discount) { ?>
    <td class="" style="margin-right:30px; text-align: center;"><?php echo $curr . ' ' . $discount; ?>&nbsp;<del class="text-success" style="color:green;"><?php echo $curr . ' ' . $price; ?></del></td>


    <?php } else { ?>

    <td class="" style="margin-right:30px;text-align-last:center;"><?php echo $curr . ' ' . $discount; ?>&nbsp;</td> <?php
    } ?>
    </tr>
    <?php } else { ?>
    <tr>
    <td style="width:70%;"><strong>Price</strong></td>

    <td class=""><?php echo $curr . ' ' . $price; ?></td>
    </tr>


    <?php  }

    if ($selltype != 'Auction') {

    if ($selltype != "Retail") {
    if ($selltype != "Wholesale") {

    ?>

    <tr>
    <td><strong>In Stock</strong></td>
    <td class="" style="margin-right:125px;text-align: center;"><?php echo $available; ?>
    <input type='hidden' value="<?php echo $available; ?>" id="qtyavailable">
    </td>
    </tr>
    <?php }
    } else {

    ?>

    <tr>
    <td><strong>In Stock</strong></td>
    <td class="" style="margin-right:125px; text-align: center;"><?php echo $Quantity; ?></td>
    <input type='hidden' value="<?php echo $Quantity; ?>" id="qtyavailable">
    </tr>
    <?php
    }
    }

    ?>



    <form action="<?php echo ($available == 0 ? " " : "../cart/addorder.php"); ?>" id="cart_data" method="post" onsubmit="doValidate(event)">
    <?php $s = $available;
    $sint = filter_var($s, FILTER_SANITIZE_NUMBER_INT); ?>
    <?php 
    ?>
    <tr id="out_stock">
    <?php if ($selltype != 'Auction') { ?>
    <td class="font-weight-bold">Quantity</td>
    <td class="font-weight-bold ">
    <div class="" style="display: flex; justify-content: center;">

    <?php if ($selltype == 'Wholesale') {

    $minorderqty = $minorderqty;
    } else {

    $minorderqty = 1;
    }

    ?>
    <input type="number" class="form-control input-number text-center " style="width: 45% !important; "  id="quantity" name="spOrderQty" value="<?php echo $minorderqty; ?>" min="<?php echo $minorderqty; ?>" onkeyup="this.value = minmax(this.value, <?php echo $minorderqty; ?>, <?php echo $available; ?>)"  maxlength="5" />

    </div>
    </td>
    </tr>


    <?php }
    //                                          }
    ?>

    </table>

    </div>






    <table class="table table-striped table-hovered">
    <tbody>


    <?php



    if ($selltype == "Auction") {

    $bid = new _spauctionbid;
    $result_bid = $bid->auctionbid($postId);
    $result_au  = $bid->get_heigh_auction_priceof_product($postId);
    if ($result_au != false) {
    $row_he = mysqli_fetch_assoc($result_au);
    $HeighestBid = $row_he['auctionPrice'];
    } else {
    $HeighestBid = $price;
    }

    if ($result_bid != false) {
    $totalBid = $result_bid->num_rows;
    } else {
    $totalBid = 0;
    }
    ?>
    <div class="auction_box">
    <input type="hidden" id="auctionexp" name="" value="<?php echo $postingexpire; ?>">
    <p style="width:60%;"><strong style="color: #333333;">Expiry Date</strong> <span id="auction_enddate" class="pull-right"> <?php echo $rowf['spPostingExpDt'];
    $date = date_create($rowf['spPostingExpDt']);
    $edate = date_format($date, "Y-m-d");
    $pdate = date('Y-m-d');                         ?> </span></p>
    <p style="width:33%;"><strong style="color: #333333;">Total Bids</strong><a href="#tab4default" class="pull-right" data-toggle="tab"> <?php echo $totalBid; ?></a></p>

    <?php if ($totalBid != 0) {
    if ($Sell_uid != $_SESSION['uid']) { ?>
    <p><strong style="color: #333333;">My Last Bid</strong>: <strong style="color: #333333;"><?php
    }

    $po = new _spauctionbid;

    $my_bid = $po->Mylastbid($postId, $_SESSION['pid']);

    if ($my_bid != "") {
      $mybid = mysqli_fetch_assoc($my_bid);
      $auctionPrice_co = $mybid['auctionPrice'];
      if ($Sell_uid != $_SESSION['uid']) {
        if (!empty($mybid)) {
          echo $curr . ' ' . $mybid['auctionPrice'];
        } else {
          echo '0';
        }
      }
    }


    ?></strong></p> <?php } ?>

    </div>
    <?php
    if ($Sell_uid != $_SESSION['uid']) {

    $p = new _spprofiles;

    $result2 = $p->read_bid_status($postId);

    if ($result2 == false) {


    ?>
    <div id="aucdiv" style="padding-bottom: 10px;padding-top: 9px;padding-bottom: 5px;padding-left: 4px;background-color: whitesmoke;margin-right: 76px;">
    <input type="hidden" name="lastBid" id="lastBid" value="<?php echo $HeighestBid; ?>">
    <input type="hidden" id="spPostings_idspPostings" name="spPostings_idspPostings" value="<?php echo $postId; ?>">
    <input type="hidden" id="spPostFieldBidFlag" value="1">
    <input type="hidden" class="auctioncat" value="1" />
    <input type="hidden" name="curdate" value="<?= date('Y-m-d h:i:s'); ?>" />
    <input type="hidden" name="austatus" value="0" />
    <input class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>">
    <?php if ($_SESSION['guet_yes'] != 'yes') {

    if ($rowf['spPostingExpDt'] > date('Y-m-d h:i:s')) {
    ?>
    <div class="row">
    <div class="col-md-9">
    <input type="text" class="form-control activity" id="AuctionPrice1" name="auctionPrice1" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" onkeypress="javascript:return isNumber(event)" maxlength="9" style="margin:0px;     margin-top: -1px;
    margin-left: 6px; " required />
    </div>
    <div class="col-md-3">
    <?php ?>
    <button type='submit' class='btn btn_cart btn_buy_now  example' style='float-right; padding-bottom:8px ;background-color: #337ab7; margin-top: -3px;' name="placebidAuction1" style='font-color:#FFFFFF;' id="b3">Bid</button>

    </div>
    </div>

    <?php } else {
    echo "<span class='text-danger'>Sorry, this item has expired. You can not bid on an expired item. </span>";
    }
    }
    ?>
    </div>
    <?php } else {
    echo "<b>Awarded</b>";
    }

    } ?>

    <?php

    } else {
    if ($price != false) {
    $pr = new _postfield;
    $re = $pr->readprice($postId);
    if ($re != false) {

    $fprice = "$ " . $price . "/hour";
    } else {
    if ($catid == 9) {
    $ticketprice = $price;
    $fprice = "Ticket Price $" . $price;
    } else {
    $fprice = '$' . $price;
    }
    }
    }
    if ($catid == 1 || $catid == 9 || $catid == 15 || $selltype == "Retail") {
    ?>
    <?php

    if ($producttype == 1) {

    include("variants.php");
    }
    }
    }
    ?>
    </tbody>
    </table>
    <div class="btn_box <?php echo ($Sell_uid == $_SESSION['uid']) ? 'hidden' : ''; ?>">
    <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $postId ?>">
    <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid'] ?>" />
    <input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId" value="<?php echo $_SESSION['uid'] ?>" />
    <input type="hidden" class="dynamic-pid" id="size" name="size" />
    <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $discount ?>" />
    <input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php echo $SellId; ?>" />
    <input type="hidden" id="cartItemType" name="cartItemType" value="Store" />
    <?php

    if ($catid == 18) {
    echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#quotation'><span class='fa fa-quote-left' aria-hidden='true'></span> Send Quotation</button>";
    } elseif ($catid == 2) {
    $p = new _postfield;
    $res = $p->readfield($postId);
    if ($res != false) {
    while ($rows = mysqli_fetch_assoc($res)) {

    if ($rows["spPostFieldLabel"] == "Closing Date")
    $closingdate = $rows["spPostFieldValue"];
    }
    }

    $profile = new _spprofiles;
    $profileid = "";
    $result = $profile->readjobseeker($_SESSION["uid"]);
    if ($result != false) {
    $row = mysqli_fetch_assoc($result);

    $profileid = $row['idspProfiles'];
    }

    $p = new _sppost_has_spprofile;
    $res = $p->read($postId, $profileid);
    if ($res != false) {
    echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled'>Applied</button>";
    } else {

    echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#coverletter' id='applybtn'>Apply Job</button>";
    }


    include("coverletter.php");
    } else if ($catid == 5) {

    echo "<button type='button' class='btn btn-success btn-sm pull-right' data-toggle='modal' data-categoryid='" . $catid . "' data-postid='" . $postId . "' data-target='#bid-system' data-profileid='" . $_SESSION['pid'] . "'><span class='fa fa-hand-paper-o'> </span> Bid</button>";
    } else if ($catid != 18 && $catid != 2 && $catid != 5 && $catid != 7 && $catid != 12) {
    // echo "here";
    if ($catid == 9) {
    if ($ticketprice > 0) {
    $buyerid = $_SESSION['pid'];
    $od = new  _order;
    $res = $od->checkorder($postId, $buyerid);

    //echo $od->ta->sql;
    if ($res != false) {
    echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Added to cart</button>";
    } else {
    echo "<button type='submit' class='btn btn-primary btn-sm pull-right " . ($available == 0 ? "disabled" : "") . "' id='" . ($available == 0 ? "" : "addtocart") . "'  data-postid='" . $postId . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span>  Buy Ticket</button>";
    }
    } else {

    $buyerid = $_SESSION['pid'];
    $od = new  _order;
    $res = $od->checkevent($postId, $buyerid);
    if ($res != false) {
    echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'>Joined</button>";
    } else {
    echo "<button type='button' class='btn btn-primary btn-sm pull-right joinevent' data-profileid='" . $_SESSION["pid"] . "'  data-postid='" . $postId . "' data-seller='" . $row['idspProfiles'] . "'>Join</button>";
    }
    }
    } else {

    $po = new _postfield;
    $result_po = $po->checkAuction($postId);
    if ($selltype == "Auction") {

    ?>

    <?php

    } else {

    $exda = date("Y-m-d", strtotime($ExpiryDate));

    $today = date("Y-m-d");
    $rit = new _spcustomers_basket;
    $rit1 = $rit->readitem($postId, $_SESSION['uid']);
    if ($rit1 == false) {
    //echo $minorderqty."<br>"; //245
    //echo $available;//24
    //die('==');    
    //echo $selltype.'--------------'.$minorderqty.'------'.$available; die;        


    if($selltype=='Wholesale'){
    $available  = $row['wholesaleQuantity'];

    }


    if ((($minorderqty || $available) != false) && ($minorderqty <= $available)) {
    //echo 1;
    if ($selltype == "Wholesaler" || $selltype == "Retail") {
    //die('======');
    if ($_SESSION['guet_yes'] != 'yes') {
    echo "<button type='submit' name='buy_now' style='width:94px;float:right;margin-top:-1px' class='btn btn_cart_buy btn_buy_now ' id='" . ($available == 0 ? "" : "buytocart") . "'  data-postid='" . $postId . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "' name='' " . ($available == 0 || $exda < $today ? "" : "") . "style='background-color:#ff901d!important;'>Buy Now</button>";
    }
    } else {

    echo "<button  type='submit' name='buy_now' style='width:94px;float:right' class='btn btn_cart_buy btn_buy_now ' id='" . ($available == 0 ? "" : "buytocart") . "'  data-postid='" . $postId . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "' name='' " . ($available == 0 || $exda < $today ? "disabled" : "") . "style='background-color:#ff901d!important;'>Buy Now</button>";
    }
    } else {
    echo "<span style='font-size:20px; color:red;'><b>Out Of Stock</b></span>"; ?>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <script>
    $(document).ready(function() {

    //$('#out_stock').hide();


    });
    </script>


    <?php   }
    $buyerid = $_SESSION['pid'];
    $od = new  _order;
    $res = $od->checkorder($postId, $buyerid);

    //echo $od->ta->sql;
    if ($res != false && $selltype != "Retail") {
    echo "<button type='button' style='width:90px;float:right' class='btn btn_cart disabled btn_add_to_cart' data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'  " . ($available == 0 || $exda < $today ? "disabled" : "") . ">Added to cart</button>";
    } else {
    if ($selltype != "Wholesaler") {
    if ($_SESSION['guet_yes'] != 'yes') {
    echo "<button type='submit'  style='width:90px;height:2.8em;float:right;margin-left: 10px;'  name='addtocart' class='btn btn_cart btn_add_to_cart " . ($available == 0 ? "disabled" : "") . "' id='" . ($available == 0 ? "" : "addtocart") . "'  data-postid='" . $postId . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='" . $catid . "'>Add to cart</button>";
    }
    }
    }
    } else {

    echo "<span style='font-size:15px; color:green;'>Product already added to cart.</span>";
    }
    }
    }
    }

    ?>

    </form>





    <form enctype="multipart/form-data" action="../buy-sell/sendquotation.php" method="post" id="quotationform">



    <!-- Modal -->
    <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close pull-right" style="width:3%;" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Request For Quotations</h4>
    </div>
    <div class="modal-body">
    <input type="hidden" name="buyeremail_" value="" />
    <input type="hidden" name="buyername_" value="" />
    <!-- ==================== -->
    <!-- jo product buy kr raha ha -->
    <input type="hidden" name="spQuotationBuyerid" value="<?php echo $_SESSION['pid'] ?>" />
    <!-- jo product sale kr raha ha -->
    <input type="hidden" class="dynamic-pid" name="spQuotationSellerid" id="spQuotationSellerid" value="<?php echo $row['spProfiles_idspProfiles'] ?>" />


    <!--  <?php   //echo $_POST['data-selrid'];
    ?>  -->

    <input type="hidden" name="spPostings_idspPostings" id="spPosting" value="<?php echo $postId ?>">

    <input type="hidden" class="dynamic-pid" name="createddatetime" value="<?php echo (date("F d, Y h:i:s", $timestamp)); ?>" />
    <div class="row">
    <div class="col-md-6">
    <div class="form-group">
    <label for="spQuotationTotalQty" class="control-label contact">Quantity Required <span class="red">*</span></label>
    <span id="spQuotationTotalQty_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
    <input type="number" class="form-control" id="spQuotationTotalQty" name="spQuotationTotalQty" onkeyup="keyupQuotationfun()" required>
    </div>
    </div>
    <div class="col-md-6">
    <div class="form-group">
    <label for="deleverytime" class="control-label contact">Delivery (Days) <span class="red">*</span></label>
    <span id="deleverytime_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
    <input type="number" required class="form-control" id="deleverytime" name="spQuotationDelevery" min="1" max="50" onkeyup="keyupQuotationfun()">
    </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
    <label for="spPostingCountry">Country <span class="red">*</span></label>
    <span id="spUserCountry_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
    <select id="spUserCountry" class="form-control " name="spQuotationCountry" onkeyup="keyupQuotationfun()">
    <option value="">Select Country</option>
    <?php




    $u = new _spuser;
    $res = $u->read($_SESSION['uid']);
    if ($res != false) {

    $ruser = mysqli_fetch_assoc($res);

    $default_country = $ruser["spUserCountry"];
    $default_state = $ruser["spUserState"];
    $default_city = $ruser["spUserCity"];
    }



    $co = new _country;
    $result3 = $co->readCountry();
    if ($result3 != false) {
    while ($row3 = mysqli_fetch_assoc($result3)) {
    //print_r($row3);
    ?>
    <option value='<?php echo $row3['country_id']; ?>' <?php echo ($default_country == $row3['country_id']) ? 'selected' : ''; ?>><?php echo $row3['country_title']; ?></option>
    <?php
    }
    }
    ?>
    </select>
    </div>
    </div>
    <div class="col-md-4">
    <div class="loadUserState">
    <div class="form-group">
    <label for="spPostingCity">State <span class="red">*</span></label>
    <span id="spUserState_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
    <select class="form-control" name="spQuotationState" id="spUserState" onkeyup="keyupQuotationfun()">
    <option value="">Select State</option>
    <?php if (isset($default_state) && $default_state > 0) {
    $countryId = $usercountry;
    $pr = new _state;
    $result2 = $pr->readState($default_country);
    if ($result2 != false) {
    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
    <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($default_state) && $default_state == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
    <?php
    }
    }
    }
    ?>
    </select>
    </div>
    </div>
    </div>
    <div class="col-md-4">
    <div class="loadCity">
    <div class="form-group">
    <label for="spPostingCity">City <span class="red">*</span></label>
    <span id="spUserCity_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
    <select class="form-control" name="spQuotationCity" id="spUserCity" onkeyup="keyupQuotationfun()">
    <option value="">Select City</option>
    <?php
    // $stateId = $userstate;

    $co = new _city;
    $result3 = $co->readCity($default_state);
    //echo $co->ta->sql;
    if ($result3 != false) {
    while ($row3 = mysqli_fetch_assoc($result3)) { ?>
    <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($default_city) && $default_city == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
    }
    } ?>
    </select>
    </div>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-12">
    <div class="form-group">
    <label for="productdetails" class="control-label contact">Comments <span class="red">*</span></label>
    <span id="productdetails_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
    <textarea class="form-control" id="productdetails" required name="spQuotatioProductDetails" onkeyup="keyupQuotationfun()"></textarea>
    </div>
    </div>
    </div>
    </div>

    <div class="modal-footer">
    <div class="modal-footer bg-white br_radius_bottom">
    <button type="button" class="btn btn-danger" data-dismiss="modal" 
    style="width:100px;margin-bottom: 0px; !important" >Close</button>
    <button type="submit" class="btn btn-primary" id="quotationsubmit" style="width: 100px;">Submit</button>
    </div>
    </div>
    </div>

    </div>
    </div>
    <?php if ($selltype != 'Auction') { ?>
    <?php if ($selltype != 'Retail') { ?>
    <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
    <!-- Trigger the modal with a button -->
    <?php if ($selltype == 'Wholesale') { ?>
    <a href="javascript:void(0)" data-toggle="modal" data-target="#myModal3" style="color:#FF0000;padding:2px; margin:3px">
    <button style="height:40px; width:150px;  background-color:#ff7676; float:right;background-color: #1a1299; color:white; margin-top: -5px;"> Request For Quote</button></a>

    <?php }
    }
    }
    } ?>
    </form>




    <?php
    $fv = new _store_favorites;

    $res_fv = $fv->chekFavourite($postId, $_SESSION['pid'], $_SESSION['uid']);

    if ($_SESSION['guet_yes'] != 'yes') {
    if ($res_fv != false) {   ?>


    <span id="wholsaleunfavt" style="margin-bottom:15px"><a onclick="wholsaleunfavte('<?php echo $postId ?>','<?php echo $_SESSION['pid']; ?>') " class="wholsaleunfav" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $postId ?>"><i class="fa fa-heart" style="font-size:25px;padding:5px 9px 0px;float:right; margin-bottom:12px;"></i> </a></span>&nbsp;&nbsp;&nbsp;&nbsp;

    <?php
    } else {
    ?>
    <span id="wholsalefavt" style="margin-bottom:15px">
    <a onclick="wholsalefavte('<?php echo $postId ?>','<?php echo $_SESSION['pid']; ?>')" class="wholsalefav" data-pid="<?php echo $_SESSION['pid']; ?>" data-postid="<?php echo $postId ?>"><i class="fa fa-heart-o" style="text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000; color:white; font-size:25px;padding:7px 9px;float:right;"></i></a></span>&nbsp;&nbsp;&nbsp;&nbsp;

    <?php
    }
    }

    ?>


    <!--<a  class="wholsalefav" id="add_heart" data-postid2="<?php echo $_GET['postid']; ?>"><i class="fa fa-heart-o alert2" style="font-size:25px;padding:7px 0px"></i></a>   


    <a  class="wholsalefav" id="del_heart" data-postid3="<?php echo $_GET['postid']; ?>"><i class="fa fa-heart-o alert2" style="font-size:25px;padding:7px 0px"></i></a>   -->
    <br>

    </div>
    <div style="margin-top: 10px;">
    
    </div>
    <?php if ($userId == $_SESSION['uid']) { ?>
    <div>

    <p>This is my product.</p>
    </div>
    <?php }
    $title = "whatsapp";

    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    ?>

    <div id="social-share" class="mt_d">
    <span>Sharing is caring</span> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
    <a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb" style="padding:0.3em 0.4em ;"><i class='fa-brands fa-facebook '></i></a>
    <!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
    <a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa-brands fa-twitter"></i> </a>
    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa-brands fa-linkedin"></i> </a>
    <a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp" style="padding:0.38em 0.47em;"><i class="fa-brands fa-whatsapp"></i></a>
    </div>








    <hr>



    <div class="product-description">


    <div class="d-flex flex-row align-items-center"> <i class="fa fa-map-marker"></i>
    <span class="ml-1"><?php echo "<a href='https://www.google.com/maps/place/" . $fullAddr . "' target='_blank' style='padding-left: 10px;'>" . $fullAddr . "</a>"; ?></span>
    </div>





    </div>
    </div>



    <div class="card mt-2"> <span>Similiar items:</span>
    <div class="similar-products mt-2 d-flex flex-row">

    <?php



    $p = new _productposting;
    $ps = $p->moreseller_product($SellId, $postId);

    if (isset($ps) && !empty($ps) && $ps != " ") {

    while ($row_ps = mysqli_fetch_assoc($ps)) {
    $price = $row_ps['retailSpecDiscount'];
    $curr = $row_ps['default_currency'];
    if ($row_ps['sellType'] == "Retail" || $row_ps['sellType'] == "Personal") {
    $pic = new _productpic;
    $result = $pic->read($row_ps['idspPostings']);
    if ($result != false) {

    ?>
    <a href="<?= $BaseUrl; ?>/store/detail.php?catid=1&postid=<?= $row_ps['idspPostings']; ?>">
    <div class="card border p-1" style="width:10rem">
    <?php if ($result != false) {
    $rp = mysqli_fetch_assoc($result);
    $picture = $rp['spPostingPic'];
    echo "<img alt='Posting Pic' style='width:90px;height:100px' class='card-img-top' src=' " . ($picture) . "' >";
    } else {
    echo "<img alt='Posting Pic' src='../img/no.png' style='width:90px;height:100px' class='card-img-top'>";
    }  ?>
    <div class="card-body">
    <h6 class="card-title">


    <?php

    if ($price > 0) {
    echo $curr . ' ' . $price;
    } else {
    echo "0";
    }


    ?>

    </h6>
    <p id="stittle" data-toggle="tooltip" title="<?= $row_ps['spPostingTitle']; ?>"><?= $row_ps['spPostingTitle']; ?></p>
    </div>
    </div>
    </a>
    <?php } 

    }
    }
    } else {
    echo "<b>No Similar Product Found.</b>";
    } ?>
    </div>

    </div>
    </div>
    <div>
    <?php
    //include('product-seller.php');
    ?>

    </div>



    </div>
    </div>

    <!--================================================== -->

    <script src='<?php echo $BaseUrl; ?>/assets/js/lightslider.js'></script>
    <script>
    $('#lightSlider').lightSlider({
      gallery: true,
      item: 1,
      loop: true,
      slideMargin: 0,
      thumbItem: 9
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function() {

    var quantitiy = 20;
    $('.quantity-right-plus').click(function(e) {

    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    var quantity = parseInt($('#quantity').val());

    // If is not undefined

    $('#quantity').val(quantity + 1);


    // Increment

    });

    $('.quantity-left-minus').click(function(e) {
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    var quantity = parseInt($('#quantity').val());

    // If is not undefined

    // Increment
    if (quantity > 20) {
    $('#quantity').val(quantity - 1);
    }
    });

    });

    function doValidate(event) {

    var qty = $('#quantity').val();
    //alert(qty);
    var minorder = "<?php echo $minorderqty; ?>";
    //alert(minorder);
    if (qty < minorder) {
    alert('Enter Min Order Value');
    event.preventDefault();
    return false;
    // 
    }


    // validate your inputs
    };
    </script>


    <?php include('postshare.php'); ?>

    <div class="modal fade" id="lowestbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content no-radius bradius-15">
    <form action="../store/auction-bid/rebid.php" method="POST" id="lowestbidfrm" class="sharestorepos">
    <div class="modal-header bg-white br_radius_top">
    <h4 class="modal-title success" style="color:red;"><span id="lowoldbid"></span> </h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>

    </div>

    <div class="modal-body sharedimage">
    <span id="lowbidtime" style="float: right;padding-top: 20px;"></span>
    <div class="row">

    <div class="col-md-12">
    <p style="color:red"><i class="fa fa-warning" style="color:red"></i>&nbsp;You've been outbid by someone else max bid!<br>
    <p style="color:black;    padding-left: 22px;">You can Still Win! Try bidding Again!</p>
    </p>
    </div>
    </div>

    <div class="row">

    <div class="col-md-12">



    <input type="hidden" name="spPostings_idspPostings" id="lownewspPostings_idspPostings">
    <input type="hidden" name="spProfiles_idspProfiles" id="lownewspProfiles_idspProfiles">
    <input type="hidden" name="lastBid" id="lownewlastBid">

    <div class="" style="padding-top: 27px;padding-bottom: 10px;display: flex;background-color: whitesmoke;margin-bottom: 15px;">




    <div class="col-md-8">

    <input type="text" class="form-control activity" id="AuctionPricenewlow" maxlength="7" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." onkeypress="javascript:return isNumber(event)" aria-describedby="basic-addon1" style="margin:0px;">&nbsp;&nbsp;
    </div>
    <div class="col-md-4">

    <button type="button" class="btn btn_cart btn_buy_now placenewbidAuctionlow" style="float:left;padding: 8px;background: #1c6121!important;width: 90%;">Bid</button>
    <span id="lowpriceerror" style="color:red;"></span>
    </div>

    </div>

    <p>By placing a bid,You're committing to buy this item if you Win.</p>

    </div>

    </div>

    </div>

    </form>
    </div>
    </div>
    </div>


    <div class="modal fade" id="higestbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content no-radius bradius-15">
    <form action="../store/auction-bid/rebid.php" method="POST" id="higestbidfrm" class="sharestorepos">
    <div class="modal-header bg-white br_radius_top">
    <h4 class="modal-title success" style="color:green;"><span id="oldbid"></span> </h4><button type="button" class="close" data-dismiss="modal">&times;</button>


    </div>

    <div class="modal-body sharedimage">

    <span id="oldbidtime" style="float: right;padding-top: 20px;"></span>
    <div class="row">

    <div class="col-md-12">

    <p style="color:green;"><i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i>&nbsp;You're the highest bidder!</p>
    <p>Your high bid amount &nbsp;<span id="highbid" style="font-weight: 600;font-size: 19px;"></span></p>

    <input type="hidden" name="spPostings_idspPostings" id="newspPostings_idspPostings">
    <input type="hidden" name="spProfiles_idspProfiles" id="newspProfiles_idspProfiles">
    <input type="hidden" name="lastBid" id="newlastBid">

    <div class="" style="padding-top: 27px;padding-bottom: 10px;display: flex;background-color: whitesmoke;margin-bottom: 15px;">



    <div class="col-md-8">
    <input type="text" class="form-control activity" id="AuctionPricenewhigh" onkeypress="javascript:return isNumber(event)" maxlength="7" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin-left: 19px;">&nbsp;&nbsp;
    </div>
    <div class="col-md-4">
    <button type="button" class="btn btn_cart btn_buy_now placenewbidAuctionhigh" style="float:left;padding: 8px;background: #1c6121!important;width: 90%;">Bid</button>
    <span id="highpriceerror"></span>
    </div>

    </div>

    <p>By placing a bid,You're committing to buy this item if you Win.</p>

    </div>

    </div>

    </div>

    </form>
    </div>
    </div>
    </div>


    <!--new modal -->

    <div class="modal fade" id="enqueryModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content no-radius sharestorepos bradius-15">
    <div class="modal-header bg-white br_radius_top">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <!--<h3 class="modal-title" id="enquireModalLabel" ><b>This is my product</b></h3> -->
    </div>

    <div>
    <h3 class="modal-title" style="text-align:center;"><b>This is my product</b></h3>
    </div>



    </div>
    </div>
    </div>



    <!--modal for Enquery-->
    <div class="modal fade" id="enqueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content no-radius sharestorepos bradius-15">
    <div class="modal-header bg-white br_radius_top">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <h3 class="modal-title" id="enquireModalLabel"><b>Send a Message</b></h3>
    </div>
    <form action="../enquiry/addmsgenquire.php" method="post" id="">
    <div class="modal-body">
    <?php

    $p = new _productposting;
    $res = $p->read($postId);

    if ($res != false) {
    while ($row2 = mysqli_fetch_assoc($res)) {
    $spProfile = $row2['spProfiles_idspProfiles'];
    }
    }

    ?>
    <input type="hidden" class="dynamic-pid" id="buyerProfileid" name="buyerProfileid" value="<?php echo $_SESSION['pid'] ?>" />

    <input type="hidden" id="sellerProfileid" name="sellerProfileid" value="<?php echo $spProfile; ?>" />
    <input type="hidden" id="modulename" name="modulename" value="Store Module" />

    <input type="hidden" id="spPostings_idspPostings" name="spPostings_idspPostings" value="<?php echo $postId ?>">

    <div class="form-group">
    <label for="message-text" class="form-control-label contact">Message</label>
    <textarea class="form-control" id="message-text" name="message" rows="5" maxlength="500" onkeyup="keyupmessage()"></textarea>

    <span id="messagetext_error" style="color:red; font-size: 14px;"></span>
    </div>
    </div>

    <div class="modal-footer bg-white br_radius_bottom">
    <button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-submit  db_btn db_primarybtn">Send message</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    <!--complete-->
    <!--Auction bid system-->
    <div class="modal fade" id="bid-auction" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content no-radius sharestorepos bradius-15">
    <div class="modal-header bg-white br_radius_top">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="bidModalLabel">Bid on Auction <span id="projecttitle" style="color:#1a936f;"></span></h4>
    </div>
    <form>
    <div class="modal-body">

    <label for="AuctionPrice">Your bid must be greater than $<?php echo $HeighestBid; ?></label>
    <div class="input-group" style="width:6cm;margin-bottom: 10px;">
    <span class="input-group-addon" id="basic-addon1">$</span>
    <input type="text" class="form-control activity" id="AuctionPrice" name="AuctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin:0px;" />
    </div>
    <div id="invalidBid"></div>
    <!--Hidden attribute-->
    <input type="hidden" name="lastBid" id="lastBid" value="<?php echo $HeighestBid; ?>">
    <input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $postId; ?>">
    <input type="hidden" id="spPostFieldBidFlag" value="1">
    <input type="hidden" class="auctioncat" value="1" />
    <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>">
    <!--Complete-->

    </div>
    <div class="modal-footer bg-white br_radius_bottom">
    <button type="button" class="btn btn-secondary db_btn db_orangebtn" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary placebidAuction db_btn db_primarybtn">Place Bid</button>
    </div>
    </form>
    </div>
    </div>
    </div>


    <?php
    include('../component/f_footer.php');
    include('../component/f_btm_script.php');
    ?>


    <?php
    } ?>
    <script type="text/javascript">
    // WRITE THE VALIDATION SCRIPT.
    function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode

    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57)) {
    return false;
    } else if (evt.which == 13) {
    evt.preventDefault();
    } else {
    return true;
    }
    }

    $(".placenewbidAuctionlow11").on("click", function() {
    var currentBid = $("#AuctionPricenewlow").val();
    var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";

    if (currentBid == "") {
    swal({
    title: 'Please Enter Your bid.',
    imageUrl: logo
    });
    } else {
    var postid = $("#spPostings_idspPostings").val();
    var profileid = $("#spProfiles_idspProfiles").val();
    $.ajax({
    type: 'POST',
    url: 'checkbidcondition.php',
    data: {
    'spPostings_idspPostings': postid
    },
    success: function(data) {
    var obj = JSON.parse(data);
    var highestbid = obj.auctionPrice;
    var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";
    if (obj.auctionPrice != 0) {
    var highestbid = obj.auctionPrice;

    if (currentBid == highestbid) {
    swal({
    title: 'Your bid Should be greater than $' + highestbid + '',
    imageUrl: logo
    });

    } else if (currentBid > highestbid) {
    $.post("../store/auction-bid/addactivity.php", {
    spPostings_idspPostings: postid,
    spProfiles_idspProfiles: profileid,
    auctionPrice: currentBid,
    lastBid: highestbid
    }, function(r) {});
    var newoldbid = " $" + highestbid;
    var newhighbid = " $" + currentBid;
    $("#oldbid").html(newoldbid);
    $("#highbid").html(newhighbid);

    $("#newspPostings_idspPostings").val(postid);
    $("#newspProfiles_idspProfiles").val(profileid);
    $("#newlastBid").val(highestbid);
    $("#higestbid").modal('show');
    } else if (currentBid < highestbid) {
    var newoldbid = " $" + highestbid;
    var newhighbid = " $" + currentBid;

    $("#lowoldbid").html(newoldbid);
    $("#lowbid").html(newhighbid);

    $("#lownewspPostings_idspPostings").val(postid);
    $("#lownewspProfiles_idspProfiles").val(profileid);
    $("#lownewlastBid").val(highestbid);

    $("#lowestbid").modal('show');

    }
    } else {
    $.post("../store/auction-bid/addactivity.php", {
    spPostings_idspPostings: postid,
    spProfiles_idspProfiles: profileid,
    auctionPrice: currentBid,
    lastBid: lastBid
    }, function(r) {});
    location.reload();
    }
    }
    });
    }
    });



    $(".placenewbidAuctionhigh22").on("click", function() {
    var currentBid = $("#AuctionPricenewhigh").val();
    var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";
    if (currentBid == "") {
    swal({
    title: 'Please Enter Your bid.',
    imageUrl: logo
    });
    } else {
    var postid = $("#spPostings_idspPostings").val();
    var profileid = $("#spProfiles_idspProfiles").val();
    $.ajax({
    type: 'POST',
    url: 'checkbidcondition.php',
    data: {
    'spPostings_idspPostings': postid
    },
    success: function(data) {

    var obj = JSON.parse(data);
    var highestbid = obj.auctionPrice;
    var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";

    if (obj.auctionPrice != 0) {
    var highestbid = obj.auctionPrice;
    if (currentBid == highestbid) {
    swal({
    title: 'Your bid Should be greater than $' + highestbid + '',
    imageUrl: logo
    });
    } else if (currentBid > highestbid) {
    $.post("../store/auction-bid/addactivity.php", {
    spPostings_idspPostings: postid,
    spProfiles_idspProfiles: profileid,
    auctionPrice: currentBid,
    lastBid: highestbid
    }, function(r) {});
    var newoldbid = " $" + highestbid;
    var newhighbid = " $" + currentBid;

    $("#oldbid").html(newoldbid);
    $("#highbid").html(newhighbid);

    $("#newspPostings_idspPostings").val(postid);
    $("#newspProfiles_idspProfiles").val(profileid);
    $("#newlastBid").val(highestbid);
    $("#higestbid").modal('show');
    } else if (currentBid < highestbid) {
    var newoldbid = " $" + highestbid;
    var newhighbid = " $" + currentBid;

    $("#lowoldbid").html(newoldbid);
    $("#lowbid").html(newhighbid);

    $("#lownewspPostings_idspPostings").val(postid);
    $("#lownewspProfiles_idspProfiles").val(profileid);
    $("#lownewlastBid").val(highestbid);

    $("#lowestbid").modal('show');
    }
    } else {
    $.post("../store/auction-bid/addactivity.php", {
    spPostings_idspPostings: postid,
    spProfiles_idspProfiles: profileid,
    auctionPrice: currentBid,
    lastBid: lastBid
    }, function(r) {
    //alert(r);
    });
    location.reload();
    }
    }
    });

    }
    });





    function keyupmessage() {

    //alert();
    var messagetext = $("#message-text").val()

    if (messagetext != "") {
    $('#messagetext_error').text(" ");

    }


    }



    $(document).ready(function() {

    var auction_exp = $("#auctionexp").val();

    var selltype = $("#selltype").val();

    //alert();
    if (selltype == "Auction") {

    var countDownDate = new Date(auction_exp).getTime();

    var x = setInterval(function() {
    // Get today's date and time
    var now = new Date().getTime();

    var distance = countDownDate - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("auction_enddate").innerHTML = days + "d " + hours + "h " +
    minutes + "m " + seconds + "s ";

    document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h " +
    minutes + "m " + seconds + "s ";

    document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h " +
    minutes + "m " + seconds + "s ";


    if (days == 0 && hours == 0 && minutes <= 5) {

    $('#auction_end').show();
    $('#AuctionPrice').hide();
    $('.placebidAuction').hide();
    $('#bidmsg').hide();
    }
    // If the count down is over, write some text 
    if (distance < 0) {
    clearInterval(x);
    document.getElementById("auction_enddate").innerHTML = "EXPIRED";



    } else {

    var x = document.getElementById("aucdiv");

    var y = document.getElementById("bidmsg");

    x.style.display = "flex";

    y.style.display = "block";

    }


    }, 1000);


    }


    });


    var number = document.getElementById('liveQty');

    // Listen for input event on numInput.
    /*number.onkeydown = function(e) {
    if(!((e.keyCode > 95 && e.keyCode < 106)
    || (e.keyCode > 47 && e.keyCode < 58) 
    || e.keyCode == 8)) {
    return false;
    }
    } */
    function minmax(value, min, max) {

    if (parseInt(value) > max)
    return max;
    else return value;
    }




    /*  $("#enquire_sell").click(function(){

    var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";

    swal({
    title: "This is My Product.",
    imageUrl: logo
    });

    });*/




    $('#showsize').on('change', function() {
    /*alert( this.value );*/
    $("#size").val(this.value);
    });

    $('#clothsize').on('change', function() {
    /*alert( this.value );*/
    $("#size").val(this.value);
    });
    </script>


    <!--<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

    Modal content-->
    <!--<div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Modal Header</h4>
    </div>
    <h3>kkkkk</h3>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>

    </div>
    </div>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>-->
    <script>
    $(document).ready(function() {
    // $(".mins1").click(function(event) {

    });





    $(document).ready(function() {
    //$(".plus1").click(function(event) {

    });

    function mins1Function() {

    var qunt = $("#quantity").val();
    var qunt = qunt - 1;

    if (qunt == 0) {
    alert('Quantity Cant Be less than 1');
    } else {



    $("#quantity").val(qunt);
    }
    //alert(qunt);

    //var mins $(this).attr("mins");
    //alert(mins);

    //$("#mins").html(mins);

    }

    function plus1Function() {
    var qunt = $("#quantity").val();
    var qunt = parseInt(qunt) + parseInt(1);

    var qtyavailable = $("#qtyavailable").val();
    var qtyavailable = qtyavailable.replace(/\D/g, "");

    //var qtyavailable = qtyavailable.replace( /^\D+/g, '');


    //5

    //alert(qtyavailable);

    if (qtyavailable == qunt - 1) {
    alert('This is Max Quantity ');
    } else

    {

    ///. 
    $("#quantity").val(qunt);
    }

    //  alert(qunt);

    }
    </script>

    <div class="modal fade" id="myModal22" role="dialog">
    <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title"></h4>
    </div>
    <ul style=font-size:20px;>
    <li>Postid :<span id="alert2">pos</span></li>


    </ul>

    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
    </div>

    </div>
    </div>

    <?php


    $p = new _productposting;
    $rd = $p->read($postId);
    if ($rd != false) {

    $row = mysqli_fetch_assoc($rd);
    $price_ac      = $row['spPostingPrice'];
    }
    ?>

    <script>
    $(document).ready(function() {
    $("#add_heart").click(function(event) {

    var username = $(this).attr("data-postid2");
    $.ajax({
    url: 'add_heartajax.php',
    type: "POST",
    data: {
    'postid': username,
    },
    success: function() {

    }

    });

    });
    });



    function showNofification(title, icon) {
    $.notify({
    title: title,
    icon: icon,
    message: ""
    }, {
    type: 'success',
    animate: {
    enter: 'animated fadeInUp',
    exit: 'animated fadeOutRight'
    },
    placement: {
    from: "top",
    align: "right"
    },
    offset: 20,
    spacing: 10,
    z_index: 1031,
    });
    }





    $(document).ready(function() {
    $("#del_heart").click(function(event) {

    var username = $(this).attr("data-postid3");
    alert(username);

    $.ajax({
    url: "del_heartajax.php",
    type: "POST",
    data: {
    'userId': username
    },
    success: function() {

    }

    });


    });
    
      if($("#b3").length > 0) {
        document.getElementById('b3').onclick = function(e) {
        var id = $('#AuctionPrice1').val();
        var auctionPrice_co = "<?php if(isset($auctionPrice_co)){ echo $auctionPrice_co; } else { echo 0; } ?>";
        var price = "<?php echo $price_ac; ?>";
        //alert(id);
        if (id == '') {
        swal("Please Enter Bid Value");

        } else {
        var idd = id - 1;
        if ((idd < auctionPrice_co) || (idd < price)) {
        swal("Please enter bid Value greater than price");
        return false;
        //e.preventDefault()
        } else {
        swal("Bid Placed Successfully!", "", "success");
        }
        }

        };
        
      }  
    
    });






    function wholsalefavte(postid, pid) {
    // $("#wholsalefavt").on("click", "#wholsaleunfavt", function () {
    // alert();


    $.post("../store/add_heart1.php", {
    'postid': postid,
    'pid': pid

    }, function(response) {

    $("#wholsalefavt").html('<span id="wholsaleunfavt"><a onclick="wholsaleunfavte(' + postid + ',' + pid + ')" class="wholsaleunfav" data-pid="' + pid + '" data-postid="' + postid + '"><i class="fa fa-heart" style="font-size:25px;padding:7px 9px;float:right;"></i> </a></span>');

    //show notification on the page
    var title = '<strong>Product added to My Favourites.</strong>';
    var icon = 'fa fa-heart';
    showNofification(title, icon);
    //window.location.reload(); 
    });
    }
    //  });
    //===END
    //===WHOLESALE POST UNFAVOURITE Start

    function wholsaleunfavte(postid, pid) {
    // $("#wholsalefavt").on("click", "#wholsaleunfavt", function () {
    // alert(postid);

    $.post("../store/del_heart1.php", {
    'postid': postid,
    'pid': pid
    }, function(response) {
    $("#wholsaleunfavt").html('<span id="wholsalefavt"><a onclick="wholsalefavte(' + postid + ',' + pid + ')" class="wholsalefav" data-pid="' + pid + '" data-postid="' + postid + '"><i class="fa fa-heart-o" style="font-size:25px;padding:7px 9px;float:right;text-shadow: -1px 0 #000, 0 1px #000, 1px 0 #000, 0 -1px #000; color:white;"></i></a></span>');

    //show notification on the page
    var title = '<strong>Product removed from My Favourites.</strong>';
    var icon = 'fa fa-heart-o';
    showNofification(title, icon);
    //window.location.reload();
    });
    }
    </script>


    <script>
    function add_cart() {

    // e.preventDefault(); // avoid to execute the actual submit of the form.

    var quantity = $('#quantity').val();
    var spOrderAdid_ = $('#spOrderAdid_').val();
    var spByuerProfileId = $('#spByuerProfileId').val();
    var spBuyeruserId = $('#spBuyeruserId').val();
    var size = $('#size').val();
    var sporderAmount = $('#sporderAmount').val();
    var spSellerProfileId = $('#spSellerProfileId').val();
    var cartItemType = $('#cartItemType').val();
    var addtocart = "addtocart";
    //alert(cartItemType);
    //var actionUrl = form.attr('action');
    //alert(actionUrl);   

    $.ajax({
    type: "POST",
    url: "<?php echo $BaseUrl ?>/cart/addorder.php",
    data: {
    spOrderQty: quantity,
    spOrderAdid_: spOrderAdid_,
    spByuerProfileId: spByuerProfileId,
    spBuyeruserId: spBuyeruserId,
    size: size,
    sporderAmount: sporderAmount,
    spSellerProfileId: spSellerProfileId,
    cartItemType: cartItemType,
    addtocart: addtocart
    },
    success: function(data) {
    // alert(data); // show response from the php script.msgNotify
    var msgNotify = $('.msgNotify').text();
    ///alert(msgNotify);
    //msgNotify = 1+msgNotify;
    // $('.msgNotify').val(msgNotify);
    }
    });




    }
    </script>
    <script>
    $(document).ready(function() {




    function fetchData() {
    var id = $("#spPostings_idspPostings").val();
    $.ajax({
    url: "fetchrating.php",
    method: "POST",
    async: false,
    data: {
    id: id
    },
    success: function(data) {
    var obj = JSON.parse(data);

    $('.rating-box').attr('data-content', obj.rating);

    }
    });

    }
    fetchData();

    $("#rating-box").popover({
    trigger: "manual",
    placement: "bottom",
    html: true,
    animation: false
    })
    .on("mouseenter", function() {
    var _this = this;
    $(this).popover("show");
    $(".popover").on("mouseleave", function() {
    $(_this).popover('hide');
    });
    }).on("mouseleave", function() {
    var _this = this;
    setTimeout(function() {
    if (!$(".popover:hover").length) {
    $(_this).popover("hide");
    }
    }, 300);
    });


    $("#share").click(function() {
    var dropdownShare = $("#dropdownShare").text();
    var aboutshare = $("#aboutshare").val();
    var groupSelect = $("#groupSelect :selected").text();
    var friendSelect = $("#friendSelect :selected").text();

    if (dropdownShare == "Select group or friend") {
    $("#shareError1").html("This field is required");
    return false;
    } else if (dropdownShare == "Share with a group ") {
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
    $("#shareError3").html("This field is required");
    return false;
    } else {
    $("#shareError3").html("");
    }
    }

    /* if (aboutshare == "") {
    $("#shareError").html("This field is required4");
    return false;
    } else {
    $("#shareError").html("");
    }
     */
     
    }); 


    });



    
    </script>

    </body>

    </html>
