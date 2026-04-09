<?php

include('../univ/baseurl.php');
session_start();
/*if (!isset($_SESSION['pid'])) {
  $id = $_GET['business'];
  $_SESSION['afterlogin'] = "business-directory-services/details.php?business=" . $id;
  //print_r($_SESSION);die('=========');
  include_once("../authentication/check.php");
}*/ // else {
  function sp_autoloader($class)
  {
    include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");

  $header_directy = "header_directy";
  
  $businessId = isset($_GET["business"]) ? (int) $_GET["business"] : 0;

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
    }
  }
?>


  <?php
  if (isset($_POST['send_mail'])) {

    $em = new _email;

    //$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $owner_email = $_POST['owner_email'];





    //$res = $em->buss_send_mail($name, $owner_email, $message, $email, $subject);
  }


  ?>





  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
<?php 


$p = new _spprofiles;

$rpvt = $p->readlimit($businessId);
$content_header ="";
if ($rpvt != false) {
  $row_p = mysqli_fetch_assoc($rpvt);
  $content_header = $row_p['buss_content_header'];


}
?>
        <title><?php echo $content_header; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.pn" rel="icon">
    <link href="assets/img/apple-touch-icon.pn" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <?php include('../component/f_links.php'); ?>
  </head>
  
  <?php


  $p = new _spprofiles;

  $rpvt = $p->readlimit($businessId);

  if ($rpvt != false) {
    $row_p = mysqli_fetch_assoc($rpvt);

    //echo "<pre>";
    //print_r($row_p);
    $spfile = $row_p['spfile'];
    $spfile1 = $row_p['spfile1'];
    $content1 = $row_p['buss_content_1'];
    $content2 = $row_p['buss_content_2'];
    $content3 = $row_p['buss_content_3'];
    $content4 = $row_p['buss_content_4'];
    $main_desc = $row_p['main_desc'];

    $title1 = $row_p['first_title'];
    $title2 = $row_p['second_title'];
    $title3 = $row_p['third_title'];
    $title4 = $row_p['fourth_title'];
    $main_title = $row_p['main_title'];
    $content_header = $row_p['buss_content_header'];
    $favcolor = $row_p['favcolor'];
  }

  ?>

  <style type="text/css">
    .topdircty2 {
      width: 100%;
      height: 40vh;
      background-image: url("<?php echo $BaseUrl; ?>/business-directory/upload/<?php echo $spfile; ?>");
      background-size: cover;
      position: relative;
      border-bottom: 1px solid #222;
      background-size: unset;
    }

    .topdircty3 {
      width: 100%;
      height: 40vh;
      background-image: url("<?php echo $BaseUrl; ?>/business-directory-services/images/default.jpg");
      background-size: cover;
      position: relative;
      border-bottom: 1px solid #222;
      background-size: unset;
    }

    #navbar {
      margin-top: 20px;

    }

    .logo {
      margin-left: 10px;

    }


    #header1 {
      height: 70px;
      z-index: 997;
      transition: all 0.5s;
      background: <?php echo $favcolor ?>;
      box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);
    }
  </style>

  <body>  



    <div class="wrap">
    
      <!-- ======= Hero Section ======= 
      <section id="<?php echo ((isset($spfile)) ? 'topdircty1' : 'hero'); ?>">-->
      <?php include('top-banner.php'); ?>

      <!-- End Hero -->
      <?php
      $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      ?>
      <!-- ======= Header ======= -->
      <header id="<?php echo ((isset($favcolor)) ? 'header1' : 'header'); ?>" class="d-flex align-items-center">
        <div class="container-flude d-flex align-items-center justify-content-between">

          <div class="logo">
            <!--<h1 class="text-light"><a href="<?php echo $actual_link; ?>"><span style="color:white;">Business</span></a></h1>-->  
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>

          <nav id="navbar" class="navbar navbar-expand-lg">    
            <ul id="wecount">   
              <?php include('top-bar-tab.php'); ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

             

        </div>
      </header><!-- End Header -->


  

      <main id="main">

        <div id="menu2" class="tab-pane fade">
          <?php //include('videos.php');
          ?>
        </div>

        <!-- ======= About Section ======= -->
        <section id="about" class="about" style="display: none;">
          <div class="container">

            <div class="row">
              <?php

              if ($spfile1) { ?>
                <div style="background: url('<?php echo $BaseUrl; ?>/business-directory/upload/<?php echo $spfile1; ?>'); background-repeat: no-repeat;" data-aos="fade-right" class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
              <?php } else { ?>
                <div style="background-image: url('<?php echo $BaseUrl; ?>/business-directory-services/images/default.jpg')" data-aos="fade-right" class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
              <?php } ?>
              <div class="col-xl-7 pt-4 pt-lg-0 d-flex align-items-stretch">
                <div class="content d-flex flex-column justify-content-center" style="word-break: break-all;" data-aos="fade-left">
                  <h3><?php echo $main_title; ?></h3>
                  <p>
                    <?php echo $main_desc; ?>
                  </p>
                  <div class="row">
                    <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                      <i class="bx bx-receipt"></i>
                      <h4><?php echo $title1; ?></h4>
                      <p><?php echo $content1; ?></p>
                    </div>
                    <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                      <i class="bx bx-cube-alt"></i>
                      <h4><?php echo $title2; ?></h4>
                      <p><?php echo $content2; ?></p>
                    </div>
                    <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                      <i class="bx bx-images"></i>
                      <h4><?php echo $title3; ?></h4>
                      <p><?php echo $content3; ?></p>
                    </div>
                    <div class="col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="400">
                      <i class="bx bx-shield"></i>
                      <h4><?php echo $title4; ?></h4>
                      <p><?php echo $content4; ?></p>
                    </div>
                  </div>
                </div><!-- End .content-->
              </div>
            </div>

          </div>
        </section><!-- End About Section -->

        <!-- ======= Contact Us Section ======= -->

        <?php
        $pr = new _spprofiles;
        $country = 0;
        $state = 0;
        $city = 0;
        $profile_country = '';
        $profile_state = '';
        $profile_city = '';
        $result  = $pr->read($businessId);
        $sprows = mysqli_fetch_assoc($result);
        $country = $sprows["spProfilesCountry"];
        $spProfileEmail = $sprows["spProfileEmail"];
        $state = $sprows['spProfilesState'];
        $city = $sprows["spProfilesCity"];
        $profile_additional_address = $sprows["address"];
        $spfile = $sprows["spfile"];
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
        } ?>

        <?php

        $p = new _spbusiness_profile;

        $rpvt = $p->read($businessId);

        if ($rpvt != false) {
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
          $CompanyWebsite = $row_p['CompanyWebsite'];
          $companyEmail = $row_p['companyEmail'];
          $companyPhoneNo = $row_p['companyPhoneNo'];
        }
        ?>
        <?php 
        $tp6 = new _spbusiness_profile;

        $reshtp6 = $tp6->sp_read($businessId);
        $resh66 = mysqli_fetch_assoc($reshtp6);
        $spUser_idspUser= $resh66['spUser_idspUser'];
        ?>
      <?php 
      $ts6 = new _spbusiness_profile;
      $reshtp8 = $ts6->sp_read_8($spUser_idspUser);
      $resh77 = mysqli_fetch_assoc( $reshtp8);
        $addres1 = $resh77['business_address'];
         $email1 = $resh77['business_email'];
          $phone1 = $resh77['business_phone'];
      ?>



        <section id="contact" class="contact">
          <div class="container">

            <div class="section-title" data-aos="fade-down">
              <span>Contact Us</span>
              <h2>Contact Us</h2>
            </div>

            <div class="row justify-content-center">
              <div class="col-lg-4 col-md-12" data-aos="fade-up" data-aos-delay="100">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p><?php echo $addres1; ?></p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="200">
                <div class="info-box">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p><?php echo $email1; ?></p>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                <div class="info-box">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p><?php echo $phone1; ?></p>
                </div>
              </div>
            </div>


            <!--<form action="" method="post" role="form" class="php-email-form mt-4" data-aos="fade-up" data-aos-delay="400">  -->
            <form action="" method="post">
              <div class="row">
                <input type="hidden" name="owner_email" value="<?php echo $spProfileEmail; ?>">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" value="" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enquiry" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
              </div>
              <!--<div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>-->
              <div class="text-center"><button class="btn btn-primary" type="submit" name="send_mail">Send Message</button></div>
            </form>

          </div>
        </section><!-- End Contact Us Section -->

      </main><!-- End #main -->

    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
 <?php //include('share_with_other.php'); ?>       
    <!-- Vendor JS Files -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

  </body>

  </html>

<?php
//}    
?>
