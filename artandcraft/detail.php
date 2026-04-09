<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include ('../univ/baseurl.php');
session_start();
if (!isset ($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "artandcraft/";
  include_once ("../authentication/check.php");
} else {
  function sp_autoloader($class)
  {
    include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");

  $postId = isset ($_GET['postid']) ? (int) $_GET['postid'] : 0;

  $_GET["categoryID"] = 13;
  $header_photo = "header_photo";
  if ($postId > 0) {

    $p = new _postingviewartcraft;
    $pf = new _postfield;

    $result = $p->singletimelines($postId);
    //echo $p->ta->sql;
    if ($result != false) {
      $row = mysqli_fetch_assoc($result);
      //  print_r($row);
      $spProfiles_idspProfilesid = $row['spProfiles_idspProfiles'];
      $posttype = $row['ad_type'];
      $ProTitle = $row['spPostingTitle'];
      $ProDes = $row['spPostingNotes'];
      $ArtistName = $row['spProfileName'];
      $ArtistId = $row['idspProfiles'];
      $ArtistAbout = $row['spProfileAbout'];
      $ArtistPic = $row['spProfilePic'];

      if ($row['ad_type'] == 1) {
        $ad_type = 'art';
        $subcategoryforartcraft = $row['subcategoryforart'];
      }
      if ($row['ad_type'] == 2) {
        $ad_type = 'craft';
        $subcategoryforartcraft = $row['subcategoryforcraft'];
      }


      $price = $row['discountphoto'];
      if (empty ($price)) {
        $price = $row['spPostingPrice'];
      }

      $symbol = $row['defaltcurrency'];

      $country = $row['spPostingsCountry'];
      $state = $row['spPostingsState'];
      $city = $row['spPostingsCity'];

      $return_if_applicable = $row['return_if_applicable'];
      $return_within = $row['return_within'];


      $is_cancellable = $row['is_cancellable'];

      $sippingcharge = $row['sippingcharge'];

      $fixedamount = $row['fixedamount'];

      $weight_shipping = $row['weight_shipping'];
      $width_shipping = $row['width_shipping'];
      $height_shipping = $row['height_shipping'];
      $depth_shipping = $row['depth_shipping'];



      $pr = new _spprofilehasprofile;
      $result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
      if ($result3 == 0) {
        $level = '1st Connection';
      } else if ($result3 == 1) {
        $level = '1st Connection';
      } else if ($result3 == 2) {
        $level = '2nd Connection';
      } else if ($result3 == 3) {
        $level = '3rd Connection';
      } else {
        $level = '';
      }

      //posting fields    $pf  = new _postfield;
      $result_pf = $pf->read($row['idspPostings']);
      //echo $pf->ta->sql."<br>";
//print_r($result_pf);   die('===========');
      if ($result_pf) {


        $catName = "";
        $imageSize = "";
        $printedYear = "";
        $OrganizerId = "";
        $Quantity = "";
        while ($row2 = mysqli_fetch_assoc($result_pf)) {


          //print_r($row2);
          if ($catName == '') {
            //   echo $row2['spPostFieldName']; die("---");
            if ($row2['spPostFieldName'] == 'photos_') {
              $catName = $row2['spPostFieldValue'];
            }
          }


          if ($imageSize == '') {
            if ($row2['spPostFieldName'] == 'imagesize_') {
              $imageSize = $row2['spPostFieldValue'];
            }
          }
          if ($printedYear == '') {
            if ($row2['spPostFieldName'] == 'mediaprinted_') {
              $printedYear = $row2['spPostFieldValue'];
            }
          }
          if ($OrganizerId == '') {
            if ($row2['spPostFieldName'] == 'spPostingEventOrgId') {
              $OrganizerId = $row2['spPostFieldValue'];
            }
          }
          if ($Quantity == '') {
            if ($row2['spPostFieldName'] == 'quantity_') {
              $Quantity = $row2['spPostFieldValue'];
            }
          }
        }
      }
    }

    //rating
    $r = new _sppostrating;
    $res = $r->read($_SESSION["pid"], $postId);
    if ($res != false) {
      $rows = mysqli_fetch_assoc($res);
      $rat = $rows["spPostRating"];
    } else {
      $rat = 0;
    }

    $result = $r->review($postId);
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
    $r = new _sppostreview;
    $result = $r->review($postId);
    if ($result != false) {
      $rows = mysqli_fetch_assoc($result);
      $review = $result->num_rows;
    } else
      $review = 0;
  } else {
    $re = new _redirect;
    $redirctUrl = "../artandcraft";
    $re->redirect($redirctUrl);
    //header('location:../photos/');
  }


  $sr = new _spproduct_review;
  $review = $sr->read_review($postId);
  if ($review != false) {
    $rev = mysqli_fetch_assoc($review);
    //print_r($rev);
    $review_comment = $rev['review_comment'];

    // echo $review_comment;
  }
  // $header_photo = "header_photo";
  ?>
  <!DOCTYPE html>
  <html lang="en-US">

  <head>
    <?php include ('../component/f_links.php'); ?>
    <!-- rps.html links -->

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <!-- <link rel="stylesheet" href="newcss/bootstrap1.min.css" > -->

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="newcss/bootstrap-theme1.min.css"> -->


    <!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="newcss/style1.css"> -->

    <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
Latest compiled and minified JavaScript
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
-->

    <!-- rps.html links End -->

    <!--NOTIFICATION-->
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
    <!-- image gallery script strt -->
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/prettyPhoto.css">
    <!-- image gallery script end -->
    <!-- Magnific Popup core JS file -->
    <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
    <script>
      function checkqty(txb) {
        var qty = parseInt(txb);
        var actualQty = $("#spOrderQty").val();
        //alert(actualQty);return false;
        //console.log(actualQty);
        if (qty > actualQty) {
          document.getElementById("newValue").value = actualQty;
        }
        if (qty < 1) {
          document.getElementById("newValue").value = 1;
          //alert("less");
        }
      }
    </script>


  </head>

  <body class="bg_gray">
    <!-- Modal -->
    <div id="flagPost" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <form method="post" action="addtoflag.php" class="sharestorepos">
          <div class="modal-content no-radius">
            <input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid']; ?>">
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
              <input type="submit" name="" class="btn butn_mdl_submit btn-border-radius">
              <button type="button" class="btn butn_cancel btn-border-radius" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <?php include_once ("../header.php"); ?>
    <section class="innerArtBanner">
      <?php include ('top-search.php'); ?>
    </section>
    <section class="bg_white" style="border-bottom: 2px solid #CCC">
      <div class="container">
        <!---<div class="row">
<div class="col-md-12">
<ul class="art_scnd_levl">
<li><a href="<?php echo $BaseUrl . '/artandcraft/artist.php?cat=1'; ?>">Visual Artist</a></li>
<li><a href="<?php echo $BaseUrl . '/artandcraft/artist.php?cat=2'; ?>">Graphics Designer</a></li>
<li><a href="<?php echo $BaseUrl . '/artandcraft/artist.php?cat=3'; ?>">Contemporary</a></li>
<li><a href="<?php echo $BaseUrl . '/artandcraft/artist.php?cat=4'; ?>">Animation</a></li>
<li><a href="<?php echo $BaseUrl . '/artandcraft/artist.php?cat=5'; ?>">Musician</a></li>
</ul>
</div>
</div>--->
    </div>
  </section>
  <!--Write Reviews-->
    <div class="modal fade" id="reviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content no-radius">
          <form action="../review/addreview.php" method="POST" class="sharestorepos">
            <input type="hidden" class="dynamic-pid" name="spProfiles_idspProfiles"
              value="<?php echo $_SESSION['pid'] ?>" />
            <input type="hidden" name="spPostings_idspPostings" id="spPostings_idspPostings"
              value="<?php echo $_GET["postid"] ?>">
            <input type="hidden" name="spPostRating" id="spPostRating" value="<?php echo $rat; ?>">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                  aria-hidden="true">&times;</span></button>
              <h3 class="modal-title" id="exampleModalLabel"><b>Write Review</b></h3>
            </div>
            <div class="modal-body">
              <?php
              if (isset ($folder)) {
                $_SESSION['folder'] = $folder;
              } else {
                $_SESSION['folder'] = "photos";
              }
              ?>
              <div class="form-group">
                <textarea class="form-control" id="reviewtext" name="spPostReviewText" placeholder="Write your Review..."
                  rows="5"></textarea>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary writereview btn-border-radius">Add Review</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!--Reviews Complete-->
    <div class="space"></div>
    <section class="m_btm_40">
      <div class="container">
        <div class="row">
          <div class="col-md-6 topbread">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl . '/artandcraft'; ?>"><i
                      class="fa fa-home"></i></a></li>
                <?php
                $m = new _subcategory;
                if ($posttype == 1) {
                  //  die($catName);
                  $result7 = $m->art_categorylist($catName);
                  if ($result7) {
                    $row7 = mysqli_fetch_assoc($result7);
                    //  print_r($row7); 
                    $CatNameNew = $row7['spArtgalleryTitle'];
                  } else {
                    $CatNameNew = "";
                  }
                } else {
                  $result7 = $m->craft_categorylist($catName);
                  if ($result7) {
                    die;
                    $row7 = mysqli_fetch_assoc($result7);
                    $CatNameNew = $row7['craft_title'];
                  } else {
                    $CatNameNew = "";
                  }
                }

                ?>
                <li class="breadcrumb-item active" aria-current="page"><a
                    href="<?php echo $BaseUrl . '/artandcraft/search.php?txtSearchCategory=13&txtArtSearch=&Art=' . $ad_type . '&btnArtSearch=Search'; ?>&page=1">
                    <?php echo ucfirst($ad_type); ?>
                  </a></li>

                <li class="breadcrumb-item active" aria-current="page"><a
                    href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?'; ?>catId=<?php echo $catName; ?>&for=<?php echo $ad_type; ?>&page=1">
                    <?php echo $CatNameNew; ?>
                  </a></li>
                <li class="breadcrumb-item active" aria-current="page">
                  <?php echo $ProTitle; ?>
                </li>
              </ol>
            </nav>
          </div>
          <div class="col-md-6 topbread text-right">
            <p>Location:
              <?php
              $rc = new _country;
              $result_cntry = $rc->readCountryName($country);
              if ($result_cntry) {
                $row4 = mysqli_fetch_assoc($result_cntry);
                echo $countryName = $row4['country_title'] .", " ;
                $currentcountry_id = $row4['country_id'];
              } else {
                echo "";
              }

              $countryId = $currentcountry_id;
              $pr = new _state;
              $result2 = $pr->readState($countryId);
              if ($result2 != false) {
                while ($row2 = mysqli_fetch_assoc($result2)) { 
                  if (isset ($state) && $state == $row2["state_id"]) {
                    $currentstate_id = $row2["state_id"];
                    $currentstate = $row2["state_title"];
                   echo  $currentstate.", " ; 
                  }
                }
              }

              ?>
              <?php
              $rcty = new _city;
              $result_cty = $rcty->readCityName($city);
              if ($result_cty) {
                $row5 = mysqli_fetch_assoc($result_cty);
                $cityName = $row5['city_title']; 
                echo $cityName; 
              } else {
                echo "";
              }
              ?>
            </p>
          </div>
        </div>
        <div class="row">

          <style type="text/css">
            .about .btn_box button#buytocart {
              /*14-3-24*/
              background-color: #99068A !important;
            }

            .card .similar-products a>img {
              /*14-3-24*/
              height: 80px;
              object-fit: cover;
            }

            .innerArtBanner{
              background-image: unset !important;
              background-color: #cbcbcb !important;
            }
            .nav > li > a{
              padding: 10px 12px !important;
            }
            .about .btn_box button#addtocart {
              background-color: #700165 !important;
              background-image: unset;
            }

            .seller_info {
              background-color: #ffffff;
              border: none;
              padding: 10px;
            }

            .panel {
              margin-top: 70px;
              margin-bottom: 20px;
              background-color: #fff;
              border: 1px solid transparent;
              border-radius: 4px;
              -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
              box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
            }

            .card {
              background-color: #fff;
              padding: 14px;
              border: none;
            }

            .demo {
              width: 100%;
            }

            ul {
              list-style: none outside none;
              padding-left: 0;
              margin-bottom: 10px;
            }

            li {
              display: block;
              float: left;
              /*margin-right: 6px;*/
              cursor: pointer;
            }

            img {
              display: block;
              height: auto;
              width: 100%;
            }

            .stars i {
              color: #f6d151;
            }

            .stars span {
              font-size: 13px;
            }

            hr {
              color: #d4d4d4;
            }

            .badge {
              padding: 5px !important;
              padding-bottom: 6px !important;
            }

            .badge i {
              font-size: 10px;
            }

            .profile-image {
              width: 35px;
            }

            .comment-ratings i {
              font-size: 13px;
            }

            .username {
              font-size: 12px;
            }

            .comment-profile {
              line-height: 17px;
            }

            .date span {
              font-size: 12px;
            }

            @media only screen {
              .aaa1 {
                color: green;
                position: absolute;
                left: 235px;
                top: 110px;
                font-size: 14px;

              }
            }

            .aaa1 {
              color: green;
              position: absolute;
              left: 263px;
              top: 97px;
              font-size: 14px;

            }

            .p-ratings i {
              color: #f6d151;
              font-size: 12px;
            }

            .btn-long {
              padding-left: 35px;
              padding-right: 35px;
            }

            .buttons {
              margin-top: 15px;
            }

            .buttons .btn {
              height: 46px;
            }

            .buttons .cart {
              border-color: #fff;
              color: #fff;
            }

            .buttons .cart:hover {
              background-color: #e86464 !important;
              color: #fff;
            }

            .buttons .buy {
              color: #fff;
              background-color: #ff7676;
              border-color: #ff7676;
            }

            .buttons .buy:focus,
            .buy:active {
              color: #fff;
              background-color: #ff7676;
              border-color: #ff7676;
              box-shadow: none;
            }

            .buttons .buy:hover {
              color: #fff;
              background-color: #e86464;
              border-color: #e86464;
            }

            .buttons .wishlist {
              background-color: #fff;
              border-color: #ff7676;
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
              color: #f6d151;
            }

            .followers {
              font-size: 9px;
              color: #d6d4d4;
            }

            .store-image {
              width: 42px;
            }

            .dot {
              height: 10px;
              width: 10px;
              background-color: #bbb;
              border-radius: 50%;
              display: inline-block;
              margin-right: 5px;
            }

            .bullet-text {
              font-size: 12px;
            }

            .my-color {
              margin-top: 10px;
              margin-bottom: 10px;
              display: flex;
            }

            label.radio {
              cursor: pointer;
            }

            label.radio input {
              position: absolute;
              top: 0;
              left: 0;
              visibility: hidden;
              pointer-events: none;
            }

            label.radio span {
              border: 2px solid #8f37aa;
              display: inline-block;
              color: #8f37aa;
              border-radius: 50%;
              width: 25px;
              height: 25px;
              text-transform: uppercase;
              transition: 0.5s all;
            }

            label.radio .red {
              background-color: red;
              border-color: red;
            }

            label.radio .blue {
              background-color: blue;
              border-color: blue;
            }

            label.radio .green {
              background-color: green;
              border-color: green;
            }

            label.radio .orange {
              background-color: orange;
              border-color: orange;
            }

            label.radio input:checked+span {
              color: #fff;
              position: relative;
            }

            label.radio input:checked+span::before {
              opacity: 1;
              content: "\2713";
              position: absolute;
              font-size: 13px;
              font-weight: bold;
              left: 4px;
            }

            .card-body {
              padding: 0.3rem 0.3rem 0.2rem;
            }

            .font-weight-bold {
              font-weight: bold;
            }

            .similar-products {
              display: flex;
              column-gap: 7px;
            }

            .card-body>a{
              color: black !important;
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

            .flickity-enabled {
              position: relative;
            }

            .flickity-enabled:focus {
              outline: none;
            }

            .flickity-viewport {
              overflow: hidden;
              position: relative;
              height: 100%;
            }

            .flickity-slider {
              position: absolute;
              width: 100%;
              height: 100%;
            }

            .flickity-enabled.is-draggable {
              -webkit-tap-highlight-color: transparent;
              tap-highlight-color: transparent;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
            }

            .flickity-enabled.is-draggable .flickity-viewport {
              cursor: move;
              cursor: -webkit-grab;
              cursor: grab;
            }

            .flickity-enabled.is-draggable .flickity-viewport.is-pointer-down {
              cursor: -webkit-grabbing;
              cursor: grabbing;
            }

            .flickity-prev-next-button {
              position: absolute;
              top: 50%;
              width: 44px;
              height: 44px;
              border: none;
              border-radius: 50%;
              background: white;
              background: hsla(0, 0%, 100%, 0.75);
              cursor: pointer;
              /* vertically center */
              -webkit-transform: translateY(-50%);
              transform: translateY(-50%);
            }

            .flickity-prev-next-button:hover {
              background: white;
            }

            .flickity-prev-next-button:focus {
              outline: none;
              box-shadow: 0 0 0 5px #09f;
            }

            .flickity-prev-next-button:active {
              opacity: 0.6;
            }

            .flickity-prev-next-button.previous {
              left: 10px;
            }

            .flickity-prev-next-button.next {
              right: 10px;
            }

            .flickity-prev-next-button:disabled {
              opacity: 0.3;
              cursor: auto;
            }

            .flickity-prev-next-button svg {
              position: absolute;
              left: 20%;
              top: 20%;
              width: 60%;
              height: 60%;
            }

            .flickity-prev-next-button .arrow {
              fill: #333;
            }

            .carousel {
              background: #fafafa;
            }

            .carousel-main {
              margin-bottom: 8px;
            }

            .carousel-cell {
              width: 100%;
              margin-right: 8px;
              background: #8c8;
              border-radius: 5px;
            }

            .carousel-nav .carousel-cell {
              height: 90px;
              width: 120px;
            }

            .carousel-main img {
              display: block;
              margin: 0 auto;
            }

            .pro_detail_box.dfhfgbhcgf.col-md-10 {
              border: 1px solid #ccc;
              border-radius: 12px !important;
              padding: 5px;
              background-color: #fff;
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

            .fit-image {
              max-width: 100%;
              max-height: 100%;
              width: auto;
              height: auto;
            }
          </style>



          <!--  rps.html code -->

          <div class="container">
            <div class="col-md-7 pr-2">
              <div class="card">
                <div class="demo">
                  <ul id="lightSlider" class="list-unstyled">
                    <?php

                    $pic = new _postingpicartcraft;
                    $res2 = $pic->read($postId);

                    if ($res2 != false) {




                      while ($rp = mysqli_fetch_assoc($res2)) {
                        $pic2 = $rp['spPostingPic'];


                        ?>
                        <li data-thumb="<?php echo $pic2; ?>" class="list-inline-item">
                          <img src="<?php echo $pic2; ?>" class="img-fluid fit-image" />
                        </li>

                        <?php
                      }
                    } else {
                      ?>
                      <li class="list-inline-item">
                        <img src="<?php echo $BaseUrl ?>/assets/images/blank-img/no-store.png" class="img-fluid fit-image">
                      </li>
                      <?php
                    }
                    ?>

                  </ul>
                </div>
              </div>
              <div class="card mt-2">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-nav">
                    <ul class="nav nav-tabs">
                      <li role="presentation">
                        <a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a>
                      </li>
                      <li role="presentation">
                        <a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a>
                      </li>
                      <li role="presentation">
                        <a href="#specifications" aria-controls="specifications" role="tab"
                          data-toggle="tab">Specifications</a>
                      </li>
                      <li role="presentation">
                        <a href="#seller" aria-controls="seller" role="tab" data-toggle="tab">Seller</a>
                      </li>
                      <li role="presentation">
                        <a href="#termandcondition" aria-controls="termandcondition" role="tab" data-toggle="tab">T&C And
                          Shipping Charge</a>
                      </li>
                    </ul>
                  </div>
                  <div class="panel-body">
                    <div class="tab-content">

                      <div role="tabpanel" class="tab-pane fade in active" id="reviews">
                        <?php //echo $review_comment; 
                          ?>
                        <div role="tabpanel" class="tab-pane fade in active" id="reviews">
                          <?php
                          $sr = new _spproduct_review;

                          $status = $sr->readallrating($postId, 'artandcraft');

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
                                      <div class="col-md-3" class="no-padding" style="width: 15%;">
                                        <?php if ($row1['spProfilePic']) { ?>
                                          <img src="<?php echo $row1['spProfilePic']; ?> " class="rounded-circle profile-image"
                                            style=" border-radius: 50%; height: 45px;width: 45px;">
                                        <?php } else { ?>
                                          <img src="<?php echo $BaseUrl ?>/assets/images/icon/blank-img.png"
                                            class="rounded-circle profile-image"
                                            style=" border-radius: 50%; height: 40px;width: 40px;">
                                        <?php } ?>
                                      </div>
                                      <div class="col-md-6" class="no-padding"> <a
                                          href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $user_profileid; ?>"><span
                                            class="username">
                                            <h5>
                                              <?php echo $row1['spProfileName']; ?>
                                            </h5>
                                          </span></a></div>
                                    </div>
                                    <div class="d-flex flex-column ml-1 comment-profile">

                                      <?php

                                      $star = "<i class='fa fa-star'></i>  ";
                                      $count = $review;

                                      for ($int = 1; $int <= $count; $int++) {
                                        echo "<span style='color:orange';>" . $star . "</span>";
                                      }
                                      echo "<br>";
                                      ?>

                                      <span class="username">
                                        <?php echo $row['review_comment']; ?>
                                      </span>
                                    </div>
                                  </div>
                                  <div class="date"> <span class="text-muted">
                                      <?php echo $date; ?>
                                    </span> </div>
                                </div>
                              </div>
                              <hr>
                            <?php }
                          } else {

                            echo "<h5>No Reviews Yet.</h5>";
                          } ?>

                        </div>
                      </div>
                      <?php

                      $p = new _postingviewartcraft;
                      $pf = new _postfield;

                      $result = $p->singletimelines($postId);
                      //echo $p->ta->sql;
                      if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
                        //print_r($row);
// die("++==");
                        $spProfiles_idspProfilesid = $row['spProfiles_idspProfiles'];
                        $posttype = $row['ad_type'];
                        $ProTitle = $row['spPostingTitle'];
                        $ProDes = $row['spPostingNotes'];
                        $ArtistName = $row['spProfileName'];
                        $ArtistId = $row['idspProfiles'];
                        $ArtistAbout = $row['spProfileAbout'];
                        $ArtistPic = $row['spProfilePic'];
                        $curr = $row['defaltcurrency'];
                        $prrise = $row['spPostingPrice'];
                      }

                      ?>


                      <div role="tabpanel" class="tab-pane fade" id="description">
                        <div class="mt-2"> <span class="font-weight-bold"></span>
                          <?php echo $ProDes; ?>

                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="specifications">

                        <div class="row">
                          <div class="descbOx">
                            <div class="col-md-12">

                              <p>
                                <?php //echo $ProDes;
                                  ?>
                              </p>
                              <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                  <tbody>
                                    <tr>
                                      <td>Reference</td>
                                      <td>
                                        <?php echo "Art-00" . $_GET['postid']; ?>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Artist</td>

                                      <!-- <a style="padding-left: 8px;" href="<?php echo $BaseUrl . '/artandcraft/seller-store.php?profileid=' . $ArtistId . '&page=1'; ?>">Visit Store</a> -->

                                      <td><a
                                          href="<?php echo $BaseUrl . '/artandcraft/seller-store.php?profileid=' . $ArtistId . '&page=1'; ?>">
                                          <?php echo $ArtistName; ?>
                                        </a></td>
                                    </tr>
                                    <tr>
                                      <td>Category</td>
                                      <td>
                                        <?php
                                        $m = new _subcategory;
                                        $result7 = $m->showName($catName);
                                        if ($result7) {
                                          $row7 = mysqli_fetch_assoc($result7);
                                          echo $row7['subCategoryTitle'];
                                        } else {
                                          echo "Not Define";
                                        }
                                        ?>

                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Location</td>
                                      <td>
                                        <?php
                                        $rcty = new _city;
                                        $result_cty = $rcty->readCityName($city);
                                        if ($result_cty) {
                                          $row5 = mysqli_fetch_assoc($result_cty);
                                          echo $cityName = $row5['city_title'];
                                        } else {
                                          echo "";
                                        }
                                        ?>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td>Country</td>
                                      <td>
                                        <?php
                                        $rc = new _country;
                                        $result_cntry = $rc->readCountryName($country);
                                        if ($result_cntry) {
                                          $row4 = mysqli_fetch_assoc($result_cntry);
                                          echo $countryName = $row4['country_title'];
                                        } else {
                                          echo "";
                                        }
                                        ?>
                                      </td>
                                    </tr>



                                    <tr>
                                      <td>Product Term</td>
                                      <td>


                                        <?php if ($is_cancellable == 0) {
                                          echo "Cancellation Not Allowed";
                                        } ?>
                                        <?php if ($is_cancellable == 1) {
                                          echo "Cancellation Allowed";
                                        } ?>

                                      </td>
                                    </tr>

                                    <tr>
                                      <td>Product Term</td>
                                      <td>




                                        <?php if ($return_if_applicable == 0) {
                                          echo "Return Not Acceptable";
                                        } ?>
                                        <?php if ($return_if_applicable == 1) {
                                          echo "Replacement in {$return_within} days";
                                        }
                                        ?>


                                      </td>
                                    </tr>

                                    <tr>
                                      <td>Shipping Charges</td>
                                      <td>
                                        <?php
                                        if ($sippingcharge == 1) {
                                          echo "Free";
                                        }
                                        if ($sippingcharge == 2) {
                                          echo "Fixed  ($curr $fixedamount)";
                                        }
                                        if ($sippingcharge == 3) {
                                          echo "As Per Cartier";
                                        }
                                        ?>


                                      </td>
                                    </tr>



                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane fade" id="seller">
                        <div class="seller_info bradius-15">
                          <div class="row no-margin">
                            <div class="col-md-1 no-padding">

                              <?php
                              $p = new _spprofiles;
                              $rd = $p->read($postId);

                              if ($rd != false) {

                                $row = mysqli_fetch_assoc($rd);
                              }
                              $SellId = $row['spProfiles_idspProfiles'];
                              //echo $row['spProfiles_idspProfiles'];
//die("++++++++++++++");
                              $result = $p->read($SellId);
                              if ($result != false) {
                                $row = mysqli_fetch_assoc($result);

                                //print_r($row["spProfileName"]);
                                $receiver_name = $row["spProfileName"];
                                $address = $row['address'];

                                if (isset ($row["spProfilePic"]))
                                  echo "<img alt='profilepic' class='img-responsive sellerPic' src=' " . ($row["spProfilePic"]) . "'  >";
                                else
                                  echo "<img alt='profilepic' class='img-responsive sellerPic' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' style='width: 40px;' >";
                              }

                              $pr = new _spprofilehasprofile;
                              $result6 = $pr->frndLeevel($_SESSION['pid'], $SellId);
                              //echo $pr->ta->sql;
//echo $result3;
                              if ($result6 == 0) {
                                $level = '1st';
                              } else if ($result6 == 1) {
                                $level = '1st';
                              } else if ($result6 == 2) {
                                $level = '2nd';
                              } else if ($result6 == 3) {
                                $level = '3rd';
                              } else {
                                $level = 'Not Defined';
                              }

                              $resultOfCurrentUser = $p->read($SellId);
                              if ($resultOfCurrentUser != false) {
                                $sprows = mysqli_fetch_assoc($resultOfCurrentUser);
                                $userCountry = $sprows["spProfilesCountry"];
                                $userState = $sprows['spProfilesState'];
                                $userCity = $sprows["spProfilesCity"];
                                $profile_additional_address = $sprows["address"];
                                $profile_zipcode = $sprows["spUserzipcode"];
                              }

                              $p = new _productposting;
                              $result4 = $p->publicpost_count_artcraft($SellId);
                              if ($result4 != false) {
                                $SelProduct = mysqli_num_rows($result4);
                              } else {
                                $SelProduct = 0;
                              }

                              $q = new _postingviewartcraft;
                              $res = $q->getcount($SellId);
                              $count = $res->num_rows;



                              ?>

                            </div>
                            <div class="col-md-10">
                              <h4><a href="<?php echo $BaseUrl . '/friends/?profileid=' . $SellId; ?>">
                                  <?php echo ucwords($row["spProfileName"]); ?>
                                  <br><!-- <small><?php echo $level; ?></small> -->
                                </a></h4>



                              <p class="pro_qty"><a
                                  href="<?php echo $BaseUrl . '/artandcraft/seller-store.php?profileid=' . $SellId . '&page=1'; ?>">(
                                  <?php echo $count; ?> Products)
                                </a></p>
                            </div>
                          </div>
                          <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                              <!-- <p class="active_site">&nbsp;</p> -->
                              <p class="adds" style="margin-left:20px;">Seller Details</p>

                              <?php
                              $ch = new _spAllStoreForm;
                              $result7 = $ch->readProfileWise($SellId);
                              if ($result7) {
                                $row7 = mysqli_fetch_assoc($result7);
                                $phoneVis = $row7['spGenPhone'];
                                $emailVis = $row7['spGenEmail'];
                              } else {
                                $phoneVis = 0;
                                $emailVis = 0;
                              }

                              ?>
                              <!-- <br> -->
                              <div id="composeNewTxt" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <div class="modal-content no-radius sharestorepos">
                                    <form method="post">
                                      <div class="modal-header">
                                        <h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
                                      </div>
                                      <div class="modal-body">
                                        <input type="hidden" name="txtSender" id="txtSender"
                                          value="<?php echo $_SESSION['pid']; ?>">
                                        <input type="hidden" name="txtReceiver" id="txtReceiver"
                                          value="<?php echo $SellId; ?>">
                                        <div class="form-group">
                                          <label>To (
                                            <?php echo $receiver_name; ?>)<span class="red"> * <span
                                                class="error_user"></span></span>
                                          </label>

                                        </div>
                                        <div class="form-group">
                                          <label>Message<span class="red"> * <span
                                                class="error_msg"></span></span></label>
                                          <textarea class="form-control" name="spfriendChattingMessage" id="friendMessage"
                                            required=""></textarea>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-border-radius"
                                          data-dismiss="modal">Close</button>
                                        <input type="button" class="btn btn-primary composTxtNow btn-border-radius"
                                          id="composTxtNow1" name="" value="Send Message" data-dismiss="modal">
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>


                              <p class="<?php echo ($phoneVis == 0) ? 'hidden' : ''; ?>"><img
                                  src="<?php echo $BaseUrl; ?>/assets/images/icon/store/phone.png">
                                <?php echo $SellPhone; ?>
                              </p>
                              <p class="<?php echo ($emailVis == 0) ? 'hidden' : ''; ?>"><img
                                  src="<?php echo $BaseUrl; ?>/assets/images/icon/store/email.png">
                                <?php echo wordwrap($SellEmail, 26, "<br />\n", true); ?>
                              </p>
                              <p class="<?php echo ($phoneVis == 0) ? 'hidden' : ''; ?>"><img
                                  src="<?php echo $BaseUrl; ?>/assets/images/icon/store/location.png">
                                <?php echo $SellAdres . ', ' . $SellCounty; ?>
                              </p>

                              <?php
                              $rc = new _country;
                              $result_cntry = $rc->readCountryName($Country);
                              if ($result_cntry) {
                                $row4 = mysqli_fetch_assoc($result_cntry);
                                $countryName = $row4['country_title'];
                              }

                              $rcty = new _city;
                              $result_cty = $rcty->readCityName($City);
                              if ($result_cty) {
                                $row5 = mysqli_fetch_assoc($result_cty);
                                $cityName = $row5['city_title'];
                              }
                              ?>

                              <p class="sel_chat">
                                <i class="fa fa-map-marker" style="color: #035049;
font-size: 15px;"></i>
                                <?php
                                if (empty ($userCity) && empty ($userState) && empty ($userCountry)) {
                                  echo "<a href='javascript:void(0);' style='padding-left: 10px;'>N/A</a>";
                                } else {
                                  // $fullAddr = "".$userCountry.",".$userState.",".$userCity.",".$profile_additional_address."";
                                  $fullAddr = "" . $profile_additional_address . ", " . $userCity . ", " . $userState . ", " . $userCountry . "";

                                  echo "<a href='https://www.google.com/maps/place/" . $fullAddr . "' target='_blank' style='padding-left: 10px;'>" . $fullAddr . "</a>";
                                }
                                ?>
                              </p>
                              <?php if ($SellId == $_SESSION['pid']) { ?>

                                <!-- <p class="sel_chat" ><i class="fa fa-commenting "style="color: #035049;
font-size: 15px;"></i> <a href="javascript:void(0)" style="padding-left: 5px;" onclick="javascript:check_chat()">Lets Chat22</a></p>  -->

                              <?php } elseif ($myuserid != $_SESSION['uid']) { ?>

                                <div class="" data-toggle="modal" data-target="#composeNewTxt" style="cursor: pointer;">
                                  <p class="sel_chat"><i class="fa fa-commenting " style="color: #035049;
font-size: 15px;"></i> <a href="javascript:void(0)" style="padding-left: 5px;" id="composeNewTxt">Lets Chat</a></p>
                                </div>

                                <?php
                              }
                              ?>

                              <p class="sel_chat"><i class="fa fa-shopping-cart" style="color: #035049;
font-size: 15px;" aria-hidden="true"></i> <a style="padding-left: 8px;"
                                  href="<?php echo $BaseUrl . '/artandcraft/seller-store.php?profileid=' . $SellId . '&page=1'; ?>">Visit
                                  Store</a></p>
                              <?php if ($SellId != $_SESSION['pid']) { ?>

                                <?php
                                $pids = $_SESSION['pid'];
                                $sp = new _flagpost;
                                $spflag = $sp->readflag2($pids, $postId);
                                if ($_SESSION['guet_yes'] != 'yes') {
                                  if ($spflag != false) {
                                    ?>
                                    <p class="sel_chat" onclick="flags()"><i class="fa fa-flag" style="color: #035049;
font-size: 15px;"></i> &nbsp; <a>Flag this post</a></p>
                                    <p id="flags" style="color:red;font-size:15px"></p>
                                  <?php } else {
                                    ?>
                                    <p class="sel_chat"><i class="fa fa-flag" style="color: #035049;
font-size: 15px;"></i> &nbsp;<a href="javascript:void(0)" style="padding-left: 4px;" data-toggle="modal"
                                        data-target="#flagPost">Flag this post</a></p>
                                    <?php
                                  }
                                }
                              } ?>
                              <!-- Modal -->
                              <div id="flagPost" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                  <!-- Modal content-->
                                  <form method="post" action="addtoflag.php" class="sharestorepos">
                                    <div class="modal-content no-radius bradius-15">
                                      <input type="hidden" name="spPosting_idspPosting" value="20">
                                      <input type="hidden" name="spProfile_idspProfile" value="2354">
                                      <input type="hidden" name="spCategory_idspCategory" value="1">
                                      <div class="modal-header bg-white br_radius_top">
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                        <h4 class="modal-title">Flag Post</h4>
                                      </div>
                                      <div class="modal-body">
                                        <div class="radio">
                                          <label><input type="radio" name="why_flag" value="Duplicate post"
                                              checked="">Duplicate post</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" name="why_flag" value="Posting Violation">Posting
                                            Violation</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious
                                            Post</label>
                                        </div>
                                        <div class="radio">
                                          <label><input type="radio" name="why_flag" value="Copied My Post">Copied My
                                            Post</label>
                                        </div>

                                        <!-- <label>Why flag this post?</label> -->
                                        <textarea class="form-control" name="flag_desc"
                                          placeholder="Add Comments"></textarea>
                                      </div>
                                      <div class="modal-footer bg-white br_radius_bottom">
                                        <input type="submit" name=""
                                          class="btn butn_mdl_submit db_btn db_primarybtn btn-border-radius">
                                        <button type="button"
                                          class="btn butn_cancel btn-border-radius db_btn db_orangebtn"
                                          data-dismiss="modal">Cancel</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <script type="text/javascript">
                        function flags() {
                          document.getElementById('flags').innerText = 'You have already flagged this post.';
                        }
                      </script>
                      <div role="tabpanel" class="tab-pane fade" id="termandcondition">




                        <b>Shipping :</b>
                        <span>
                          <?php
                          if ($sippingcharge == 1) {
                            echo "Free";
                          }
                          if ($sippingcharge == 2) {
                            echo "<b>{$fixedamount} {$symbol}</b> standard";
                          }
                          if ($sippingcharge == 3) {
                            echo "As Per Cartier";
                          }
                          ?>

                          <br><br>

                          <b>Refund :</b>

                          <?php if ($return_if_applicable == 0) {
                            echo "Refund Not Acceptable";
                          } ?>
                          <?php if ($return_if_applicable == 1) {
                            echo "Refund in {$return_within} days";
                          }
                          ?>

                          <br><br>
                          <td>


                            <?php if ($is_cancellable == 0) {
                              echo "Cancellation Not Allowed";
                            } ?>
                            <?php if ($is_cancellable == 1) {
                              echo "Cancellation Allowed";
                            } ?>

                          </td>
                        </span>

                        <!--<p style="color:red;margin-top: 12px;">




<?php /*if($return_if_applicable==''){
//  echo "Return Not Acceptable";
} ?>
<?php if($return_if_applicable==1 && $return_within!=0){ 
echo "{$return_within} days returns";
}*/
    ?>
</p>-->

                      </div>


                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="pull-right">
                <ul>
                  <li style="cursor:auto">


                    Product ID: <span>
                      <?php if ($posttype == 1) {
                        echo 'Art';
                      } else {
                        echo 'Craft';
                      } ?>
                      <?php echo $postId; ?>
                    </span></li>
                </ul>
              </div>




              <div class="card">
                <div class="about">
                  <h2 class="font-weight-bold">
                    <?php echo $ProTitle; ?>
                  </h2>

                  <table class="table-responsive table-bordered">
                    <tr>

                    </tr>

                    <tr>
                      <form action="../cart/addorder.php" method="post" class="form-inline detailform">
                        <input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"] ?>">
                        <input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId"
                          value="<?php echo $_SESSION['pid'] ?>" />
                        <input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount"
                          value="<?php echo $price ?>" />
                        <input type="hidden" id="spSellerProfileId" name="spSellerProfileId"
                          value="<?php echo $ArtistId; ?>" />

                        <input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId"
                          value="<?php echo $_SESSION['uid'] ?>" />
                        <input type="hidden" id="cartItemType" name="cartItemType" value="artandcraft" />

                        <div class="product_detail_right">
                          <table class="table table-striped table-hovered">
                            <tr>
                              <?php
                              $userid = $_SESSION['uid'];
                              $c = new _orderSuccess;
                              $currency = $c->readcurrency($userid);
                              $res1 = mysqli_fetch_assoc($currency);
                              // $curr=$res1['currency'];
//echo $curr;
                              ?>
                              <td style=" vertical-align: middle; "><strong>Price</strong></td>
                              <td>
                                <?php if ($prrise > $price) { ?>
                                  <input type="text" class="form-control" position="relative" value="<?php if (!empty ($price)) {


                                    echo $curr . ' ' . $price;
                                  } else {
                                    echo 'Free';
                                  } ?>" readonly style="background-color: #f9f9f9;border: 0px;">
                                  <?php if (empty ($price)) { ?>
                                  <?php } else {
                                    echo '<span class="price text-success aaa1"> <del> ' . $curr . ' ' . $prrise . '  </del></span>';
                                  } ?>
                                <?php } else { ?>
                                  <input type="text" class="form-control" position="relative" value="<?php if (!empty ($price)) {


                                    echo $curr . ' ' . $price;
                                  } else {
                                    echo 'Free';
                                  } ?>" readonly style="background-color: #f9f9f9;border: 0px;">
                                <?php } ?>
                              </td>
                            </tr>
                            <tr>
                              <?php $result7 = $pf->readSizePost($postId);
                              while ($row7 = mysqli_fetch_assoc($result7)) {
                                $data = $row7['spPostFieldValue'];
                              }

                              if ($data != "") {
                                if ($data != 'None selected') {

                                  ?>

                                  <td style=" vertical-align: middle; "><strong>Size (inches)</strong></td>
                                  <td>
                                    <select class="form-control">
                                      <?php
                                      $result6 = $pf->readSizePost($postId);
                                      //echo $pf->ta->sql."<br>";
                                      if ($result6 != false) {

                                        while ($row6 = mysqli_fetch_assoc($result6)) {
                                          if ($row6['spPostFieldValue'] != '') { ?>
                                            <option value="<?php echo $row6['spPostFieldValue']; ?>">
                                              <?php echo $row6['spPostFieldValue']; ?>
                                            </option>
                                            <?php
                                          }
                                        }
                                      }
                                      ?>
                                    </select>
                                  </td>
                                <?php }
                              } ?>


                            </tr>
                            <tr>
                              <td style=" padding-top:15px; "><strong>Quantity </strong></td>
                              <td>
                                <input type="hidden" id="spOrderQty"
                                  value="<?php echo (isset ($Quantity)) ? $Quantity : '1'; ?>">

                                <input type="hidden" id="sporderAmount" name="sporderAmount" value="<?php echo $price ?>">




                                <!----<input type="number" class="form-control" id="newValue" name="spOrderQty" value="1" onkeyup="checkqty(this.value);" style="width: 80px;" >---->
                                <?php //echo $Quantity; die('===================');   
                                  ?>


                                <?php if ($Quantity <= 10) { ?>

                                  <select name='spOrderQty' class="form-control" id="newValue" required>
                                    <?php
                                    for ($i = 1; $i <= $Quantity; $i++) {
                                      ?>

                                      <option value='<?php echo $i; ?>'>
                                        <?php echo $i; ?>
                                      </option>

                                    <?php } ?>
                                  </select>

                                <?php } else { ?>
                                  <input type="hidden" value="<?php echo $Quantity ?>" id="qua">
                                  <input type="number" onchange="numericFilter()" maxlength="3" name='spOrderQty'
                                    class="form-control" style="width: 25%;" id="newValue" required>
                                  <script>
                                    function numericFilter() {

                                      //txb.value = txb.value.replace(/[^\0-9]/ig, "");
                                      // var a = document.getElementById("qua").value;
                                      var a = document.getElementById("qua").value;
                                      var b = document.getElementById("newValue").value;
                                      //alert(a);
                                      // alert(b);
                                      if (parseInt(b) > parseInt(a)) {

                                        document.getElementById("newValue").value = "";
                                        alert("Enter Quantity is greater than available Quantity");
                                        //return false;
                                      }
                                    }
                                  </script>

                                <?php }
                                if ($Quantity != false) {
                                  echo '<br>'; ?> <span id="qualiti">
                                    <?php echo $Quantity ?>
                                  </span>&nbsp;available
                                <?php } else {
                                  echo '<br>'; ?> <span id="qualiti">
                                    <?php echo "No Stock" ?>
                                  </span>&nbsp;available
                                <?php }
                                ?>
                              </td>
                            </tr>
                          </table>


                          <div class="btn_box ">
                            <!------<form action="../cart/addorder.php" method="post">
<input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="232">
<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="2372">

<input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId" value="2084">

<input type="hidden" class="dynamic-pid" id="size" name="size">

<input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="500">
<input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="1604">
<input type="hidden" id="cartItemType" name="cartItemType" value="Store">
<input type="hidden" id="spOrdrQty" name="spOrderQty" value="1">------->
                          <?php
                          $buyerid = $_SESSION['pid'];
                          $od = new _order;
                          $res = $od->checkorder($postId, $buyerid);
                          if ($buyerid != $spProfiles_idspProfilesid) {
                            ?>

                          <?php
                          if ($Quantity != '') {
                            $spc = new _spcustomers_basket;
                            $spc1 = $spc->readitemartcraft($postId, $_SESSION['uid']);
                            if ($spc1 == false) {
                              if ($_SESSION['guet_yes'] != 'yes') {

                                echo "<button type='submit' class='btn btn_cart_buy btn_buy_now btn-border-radius' name='buy_now' id='buytocart'  data-postid='" . $_GET["postid"] . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='13' >Buy Now</button>";

                                echo "<button type='submit' class='btn btn_cart btn_add_to_cart btn-border-radius' name='addtocart' id='addtocart'  data-postid='" . $_GET["postid"] . "'  data-profileid='" . $_SESSION["pid"] . "' data-categoryid='13'>Add to cart <i class = 'fa fa-shopping-cart'></i></button>";
                              }
                            } else {
                              echo "<span style='font-size:15px; color:green;'>Product Already Added To Cart</span>";
                            }
                          } else {

                            echo "<span class='pull-right' style='color:red; font-size:20px;'><b>Out Of Stock</b></span>";
                          }

                            /* if ($res != false){
                            echo "<button type='button' class='btn btn_cart btn_add_to_cart disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='13'>Added to cart<i class = 'fas fa-shopping-cart'></i></button>";
                            }else{
                            echo "<button type='submit' class='btn btn_cart btn_add_to_cart' id='addtocart'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='13'>Add to cart<i class = 'fas fa-shopping-cart'></i></button>";
                            }*/
                          }
                          ?>

                          <div class="btn_box " style="margin-left: 20px;  margin-top: -3px;">


                            <td style="font-size: 35px;"><span class="listing_fvrt_art">
                                <?php
                                $fv = new _favorites;
                                $res_fv = "";
                                $res_fv = $fv->chekFavourite_art($postId, $_SESSION['pid'], $_SESSION['uid']);
                                // print_r($res_fv);
// die('==========');
                                if ($res_fv != false) { ?>
                                <a title="Remove to Wishlist" href="javascript:void(0)" id="remtofavoriteart"
                                  data-postid="<?php echo $_GET['postid']; ?>"
                                  data-pid="<?php echo $_SESSION['pid']; ?>">
                                  <span id="removetofavouriteeve"><i class="fa fa-heart"
                                      style="font-size:20px;color:red;"></i></span>
                                </a>
                                <?php
                                } else {
                                  ?>
                                <?php if ($_SESSION['guet_yes'] != 'yes') { ?>

                                <a href="javascript:void(0)" id="addtofavouriteart"
                                  data-postid="<?php echo $_GET['postid']; ?>"
                                  data-pid="<?php echo $_SESSION['pid']; ?>">
                                  <span title="Add to Wishlist" id="addtofavouriteeve"><i class="fa fa-heart-o"
                                      style="font-size:20px;color:red;"></i></span>
                                </a>
                                <?php
                                }
                                }
                                ?>
                              </span></td>
                            <div id="ssaddtcart"></div>

                          </div>

                          <div id="ssaddtcart"></div>

                        </div>
                      </div>
                    </form>
                  </tr>
                  <!-- tr>
<td class="font-weight-bold">Quantity</td>
<td class="font-weight-bold">
<div class="input-group">
<span class="input-group-btn">
<button type="button" class="quantity-left-minus btn btn-primary btn-number"  data-type="minus" data-field="">
<span class="glyphicon glyphicon-minus"></span>
</button>
</span>
<input type="text" id="quantity" name="quantity" class="form-control input-number" value="10" min="1" max="100">
<span class="input-group-btn">
<button type="button" class="quantity-right-plus btn btn-primary btn-number" data-type="plus" data-field="">
<span class="glyphicon glyphicon-plus"></span>
</button>
</span>
</div>
</td>
</tr>
<tr>
<td class="font-weight-bold">Colors:</td>
<td class="font-weight-bold">
<div class="my-color"> 
<label class="radio"> 
<input type="radio" name="gender" value="MALE" checked> 
<span class="red"></span> 
</label> 
<label class="radio"> 
<input type="radio" name="gender" value="FEMALE"> 
<span class="blue"></span> 
</label> 
<label class="radio"> 
<input type="radio" name="gender" value="FEMALE"> 
<span class="green"></span> 
</label> 
<label class="radio"> 
<input type="radio" name="gender" value="FEMALE"> 
<span class="orange"></span> 
</label> 
</div>
</td>
</tr -->
                  </table>

                </div>

                <hr>
                <!--div class="product-description">
<div class="d-flex flex-row align-items-center"> <i class="fa fa-calendar-check-o"></i> 
<span class="ml-1">Delivery from sweden, 15-45 days</span> 
</div>
<div class="d-flex flex-row align-items-center"> <i class="fa fa-shield"></i>
<span>Safety Tips for Buyers</span>
<p>Meet seller at a safe location
Check the item before you buy
Pay only after collecting item</p>

</div>              
</div -->







                <?php
                $title = "whatsapp";

                $url = (isset ($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                ?>

                <div id="social-share" class=" card mt_d">
                  <strong><span>Sharing is caring</span></strong> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
                  <a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank"
                    class="facebook btn_fb"><i class='fab fa-facebook '></i></a>
                  <!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
                  <a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE"
                    target="_blank" class="twitter btn_tweet"><i class="fab fa-twitter"></i> </a>
                  <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank"
                    class="linkedin btn_linkdin"><i class="fab fa-linkedin"></i> </a>
                  <a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i
                      class="fab fa-whatsapp"></i></a>
                </div>
              </div>
              <div class="card mt-2"> <span>Similar items:</span>
                <a href="<?php echo $BaseUrl . '/artandcraft/view-all.php?'; ?>catId=<?php echo $catName; ?>&for=<?php echo $ad_type; ?>&page=1"
                  class="pull-right"> View more</a>
                <div class="similar-products mt-2 d-flex flex-row">


                  <?php
                  $userid = $_SESSION['uid'];
                  $c = new _orderSuccess;
                  $currency = $c->readcurrency($userid);
                  $res1 = mysqli_fetch_assoc($currency);
                  //$curr=$res1['currency'];
                  ?>

                  <?php

                  $pid = $_SESSION['pid'];
                  $con = mysqli_connect(DOMAIN, UNAME, PASS);
                  if (mysqli_select_db($con, DBNAME)) {
                    $sql = "SELECT * FROM `sppostingsartcraft` ORDER BY spPostingDate ASC";
                    $result = mysqli_query($con, $sql);

                    if ($result) {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        //print_r($row); die("----------");
                
                        $pf = new _postfield;
                        $result_pf = $pf->read_photo($row['idspPostings']);
                        $row21 = mysqli_fetch_assoc($result_pf);
                        // print_r($row21); die("-------");
//  echo $row21['spPostFieldName'].'xxxxxxxx'.$catName;
                        if (($row21['spPostFieldName'] == 'photos_') && ($row21['spPostFieldValue'] == $catName)) {
                          // die("--------");
                          $postid = $row['idspPostings'];
                          if ($postid != $postId) {
                            if ($i <= 4) {
                              $sqaal = "SELECT * FROM `sppostingpicsartcraft` where spPostings_idspPostings = $postid";
                              $res2 = mysqli_query($con, $sqaal);

                              if ($res2 != false) {
                                $rpaa = mysqli_fetch_assoc($res2);
                                //print_r($rpaa ); die('===============');
                                $pic2a = $rpaa['spPostingPic'];
                              }
                              if ($pic2a == false) {
                                $pic2a = '/img/no.png';
                              }


                              ?>

                              <a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $postid; ?>">

                                <div class="card border p-1" style="width:10rem;">
                                  <?php
                                  if ($rpaa['spPostingPic']) {
                                    // die('========');
                    
                                    echo '<img src="' . $pic2a . '" class="card-img-top" alt="..." style="height:120px;">';

                                  } else {
                                    //die('========111111111');
                    
                                    echo "<img height='50px;' src='" . $BaseUrl . "/assets/images/blank-img/no-store.png'>";
                                  }
                                  ?>





                                  <div class="card-body">

                                    <h6 class="card-title">
                                      <?php if (empty ($row['spPostingPrice'])) {
                                        echo "<span class='price'>Free</span>";

                                      } else
                                        echo '<span class="price"> ' . $row['defaltcurrency'] . ' ' . $row['discountphoto'] . '</span>'; ?>
                                    </h6>
                                    <h6 class="card-price" style="word-wrap: break-word;"> <a
                                        href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $postid; ?>">
                                        <?php echo $row['spPostingTitle']; ?>
                                      </a></h6>
                                  </div>

                                </div>
                              </a>
                              <?php $i++;
                            }
                          }
                        }
                      }
                    }
                  } ?>

                </div>
              </div>
            </div>

            <!-- rps.html code end -->



          </div>





        </div>
    </section>
    <!--section class="section_event_art">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="heading02 text-center">
<h1><span>More Products from Seller</span></h1>
</div>
</div>
<div class="col-md-12">

<<h2><span>Art</span> Work<a href="<?php //echo $BaseUrl.'/artandcraft/artist-product.php?cat=1&artist='.$ArtistId;
  ?>" class="pull-right">View All</a></h2>>
<?php

    $pid = $_SESSION['pid'];
    $con = mysqli_connect(DOMAIN, UNAME, PASS);
    if (mysqli_select_db($con, DBNAME)) {
      $sql = "SELECT * FROM `sppostingsartcraft` where spProfiles_idspProfiles= $pid AND saveasdraft=0 ORDER BY spPostingDate ASC";
      $result = mysqli_query($con, $sql);

      if ($result) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          $postid = $row['idspPostings'];
          if ($postid != $_GET['postid']) {
            if ($i <= 4) {
              $sqaal = "SELECT * FROM `sppostingpicsartcraft` where spPostings_idspPostings = $postid";
              $res2 = mysqli_query($con, $sqaal);

              if ($res2 != false) {
                $rpaa = mysqli_fetch_assoc($res2);
                //print_r($rpaa ); die('===============');
                $pic2a = $rpaa['spPostingPic'];
              }
              if ($pic2a == false) {
                $pic2a = '/img/no.png';
              }
              ?>        
<div class="col-md-3 no-padding"> 

<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $postid; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $row['spPostingTitle']; ?>"></a>   

<div class="product_box bradius-15">  
<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $postid; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $row['spPostingTitle']; ?>">
<img alt="Posting Pic" class="img-responsive" src=" <?php echo ($pic2a); ?>">

</a>
<h2>


<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $postid; ?>" data-toggle="tooltip" title="" data-original-title="<?php $row['spPostingTitle']; ?>"></a>
<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $postid; ?>" data-toggle="tooltip" style="border-bottom: 0px solid #909295;" title="" data-original-title="Immuno First 60 VCaps">


<?php echo $row['spPostingTitle']; ?>
</a></h2>
<p class="price_pro">
<?php
                        if (empty ($row['spPostingPrice'])) {
                          echo "<span class='price'>Free</span>";
                        } else {
                          if (empty ($row['discountphoto'])) {
                            echo '<span class="price"> ' . $curr . ' ' . $row['spPostingPrice'] . '</span>';
                          } else {
                            echo '<span class="price"> ' . $curr . ' ' . $row['discountphoto'] . '</span>';
                          }
                        }

                        ?>

</p>
<div class="rating-box">
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<i class="fa fa-star" aria-hidden="true"></i>
<a href="#">(0)</a>
</div>
<p></p>
</div>
</div>  

<?php $i++;
            }
          }
        }
      }
    } ?>



</div>                    
</div>
<div class="row">
<?php
    $p = new _postingviewartcraft;
    $result4 = $p->artistPost($ArtistId, 13);
    if ($result4 != false) {
      while ($row4 = mysqli_fetch_assoc($result4)) { ?>
<div class="col-md-3">
<div class="artistAcce">
<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $row4['idspPostings']; ?>" >
<?php
            $pic = new _postingpicartcraft;
            $res2 = $pic->read($row4['idspPostings']);
            if ($res2 != false) {
              $rp = mysqli_fetch_assoc($res2);
              $pic2 = $rp['spPostingPic'];
              echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
<?php
            } else {
              echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
<?php
            } ?>
</a>



<a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $row4['idspPostings']; ?>"><?php echo $row4['spPostingtitle']; ?></a>
<hr>
<p class="price"><?php echo ($row4['spPostingPrice'] == '') ? 'Free' : '$' . $row4['spPostingPrice']; ?> <span class="pull-right"><a href="<?php echo $BaseUrl . '/artandcraft/detail.php?postid=' . $row4['idspPostings']; ?>"><i class="fa fa-shopping-cart"></i></a></span></p>
</div>
</div> <?php
      }
    }

    ?>


</div>
</div>

</section--->
  <section class="cateHomeArt">
    <div class="container">
      <div class="row keywordbox ">
        <div class="col-md-12">
          <div class="titleTop text-center m_btm_40">
            <h2>Browse Pictures by art category</h2>
          </div>
        </div>

        <?php
        $m = new _subcategory;
        $catid = 13;
        $result = $m->art_subcategoryalllist();

        //echo $m->ta->sql; die;
      
        $p = new _postingviewartcraft;

        $rowCount = 1;
        $colCount = 1;
        if ($result != false) {
          while ($rows = mysqli_fetch_assoc($result)) {
            $count = 0;
            $res = $p->sameCategoryPiccateart($rows["idspArtgallery"], 13);

            //echo $p->ta->sql; die;
      
            if ($res != false) {
              $count = $res->num_rows;
            } else {
              $count = 0;
            }
            if ($rowCount == 1) {
              echo '<div class="col-md-3 pad_left_right_5">';
            }
            if (strlen($rows["subCategoryTitle"]) < 20) {
              ?>
        <a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspArtgallery']; ?>&for=art&page=1"
          class="">
          <?php echo ucfirst(strtolower($rows["spArtgalleryTitle"])); ?> <span class="pull-right">(
            <?php echo $count; ?>)
          </span>
        </a>
        <?php
            } else {
              ?>
        <a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspArtgallery']; ?>&for=art&page=1"
          class="">
          <?php echo substr(ucfirst(strtolower($rows["spArtgalleryTitle"])), 0, 20) . "..."; ?> <span
            class="pull-right">(
            <?php echo $count; ?>)
          </span>
        </a>
        <?php
            }

            ?>
        <?php
        if ($colCount == 4) {
          $rowCount = 0;
          $colCount = 0;
        }

        if ($rowCount == 0) {
          echo '</div>';
        }
        $rowCount++;
        $colCount++;
          }
          if ($rowCount != 0) {
            echo '</div>';
          }
        }
        ?>
      </div>
    </div>
  </section>
  <section class="cateHomeArt">
    <div class="container">
      <div class="row keywordbox ">
        <div class="col-md-12">
          <div class="titleTop text-center m_btm_40">
            <h2>Browse Pictures by craft category</h2>
          </div>
        </div>

        <?php
        $m = new _subcategory;
        $catid = 13;
        $result = $m->craft_categoryalllist();

        $p = new _postingviewartcraft;

        $rowCount = 1;
        $colCount = 1;
        if ($result != false) {
          while ($rows = mysqli_fetch_assoc($result)) {
            //print_r($rows); die;
            $count = 0;
            $res = $p->sameCategoryPiccatecraft($rows["idspCraftgallery"], 13);

            //echo $p->ta->sql; die;
      
            if ($res != false) {
              $count = $res->num_rows;
            } else {
              $count = 0;
            }
            if ($rowCount == 1) {
              echo '<div class="col-md-3 pad_left_right_5">';
            }
            if (strlen($rows["subCategoryTitle"]) < 20) {
              ?>
        <a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspCraftgallery']; ?>&for=craft&page=1"
          class="">
          <?php echo ucfirst(strtolower($rows["spCraftgalleryTitle"])); ?> <span class="pull-right">(
            <?php echo $count; ?>)
          </span>
        </a>
        <?php
            } else {
              ?>
        <a href="<?php echo $BaseUrl . '/artandcraft/shop-top-category.php?catId=' . $rows['idspCraftgallery']; ?>&for=craft&page=1"
          class="">
          <?php echo substr(ucfirst(strtolower($rows["spCraftgalleryTitle"])), 0, 20) . "..."; ?> <span
            class="pull-right">(
            <?php echo $count; ?>)
          </span>
        </a>
        <?php
            }

            ?>
        <?php
        if ($colCount == 4) {
          $rowCount = 0;
          $colCount = 0;
        }

        if ($rowCount == 0) {
          echo '</div>';
        }
        $rowCount++;
        $colCount++;
          }
          if ($rowCount != 0) {
            echo '</div>';
          }
        }
        ?>
      </div>
    </div>
  </section>

  <?php include ('postshare1.php'); ?>


  <?php
  include ('../component/f_footer.php');
  include ('../component/f_btm_script.php');
  ?>
  <!-- notification js -->
    <script src='<?php echo $BaseUrl . '/assets/'; ?>js/bootstrap-notify.min.js'></script>
    <!-- image gallery script strt -->
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery.prettyPhoto.js"></script>
    <script>
      var _gaq = [
        ['_setAccount', 'UA-XXXXX-X'],
        ['_trackPageview']
      ];
      (function (d, t) {
        var g = d.createElement(t),
          s = d.getElementsByTagName(t)[0];
        g.src = ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js';
        s.parentNode.insertBefore(g, s)
      }(document, 'script'));
      // Colorbox Call
      $(document).ready(function () {
        $("[rel^='lightbox']").prettyPhoto();
      });
    </script>

    <!-- rps js -->

    <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
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
      $(document).ready(function () {

        var quantitiy = 0;
        $('.quantity-right-plus').click(function (e) {

          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

          $('#quantity').val(quantity + 1);


          // Increment

        });

        $('.quantity-left-minus').click(function (e) {
          // Stop acting like a button
          e.preventDefault();
          // Get the field name
          var quantity = parseInt($('#quantity').val());

          // If is not undefined

          // Increment
          if (quantity > 0) {
            $('#quantity').val(quantity - 1);
          }
        });

      });
    </script>
    <script type="text/javascript">
      function check_chat() {

        var logo = MAINURL + "/assets/images/logo/tsplogo.PNG";

        swal({
          title: "This is My Product.",
          imageUrl: logo
        });


      }
    </script>

    <!-- rps js end-->


  </body>

  </html>
  <?php
}
?>
