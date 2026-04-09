<?php

include('../univ/baseurl.php');
session_start();
 /*if (!isset($_SESSION['pid'])) {
  $id = $_GET['business'];
  $_SESSION['afterlogin'] = "business-directory-services/details.php?business=" . $id;
  //print_r($_SESSION);die('=========');
  include_once("../authentication/check.php");
} else { */
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

    $e = new _spprofiles;

    $result = $e->read_description(11);
    $rows = mysqli_fetch_assoc($result);
    $messages = $rows['notification_description'];



    $res = $em->bussiness_send_mail($messages,$name, $owner_email, $message, $email, $subject);
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
    <title><?php echo $content_header;  ?> </title>
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
      margin-top: 5px;

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
           <!-- <h1 class="text-light"><a href="<?php echo $actual_link; ?>"><span style="color:white;">Business</span></a></h1>-->
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
          </div>

          <nav id="navbar" class="navbar">
            <ul>
              <?php include('top-bar-tab.php'); ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

        </div>
      </header><!-- End Header -->

      <main id="main">

        <!-- ======= Gallery Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
          <div class="container">

            <div class="section-title" data-aos="fade-down">
              <span>Gallery</span>
              <h2>Gallery</h2>
              <!--<p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>-->
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-lg-12 d-flex justify-content-center">
                <ul id="portfolio-flters">
                  <li data-filter="*" class="filter-active">All</li>
                  <?php 
                  $cn = new _spprofiles;
$result1 = $cn->read_gall($businessId);   
//echo $cn->ta->sql;
if ($result1) {
 while ($row = mysqli_fetch_assoc($result1)) {

                   ?>
               <li data-filter=".filter-cat<?php echo $row['id'] ?>"><?php echo $row['title'] ?></li>   

                 <?php }} ?>
                  <!--<li data-filter=".filter-cat1">Timeline</li>
                  <li data-filter=".filter-cat2">Store</li>
                  <li data-filter=".filter-cat3">Real Estate</li>
                  <li data-filter=".filter-cat4">Rental</li>
                  <li data-filter=".filter-cat5">Events</li>
                  <li data-filter=".filter-cat6">Art & Craft</li>
                  <li data-filter=".filter-cat7">Classified Ad</li>
                  <li data-filter=".filter-cat8">Business For Sale</li>
                  <li data-filter=".filter-cat9">Trainings</li>-->
                </ul>
              </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="300">

              <?php /*
              $p2 = new _postings;
              $sp = new _spprofiles;
              $res2 = $p2->businesspost($_GET['business']);
              if ($res2 != false) {

                while ($rows = mysqli_fetch_assoc($res2)) {
                  $pic = new _postingpic;
                  $result = $pic->read($rows['idspPostings']);
                  if ($result != false) {
                    $rp = mysqli_fetch_assoc($result);
                    $pict = $rp['spPostingPic'];
                    $idspPostingPic = $rp['idspPostingPic'];
                    if (isset($pict)) {

              ?>

                      <div class="col-lg-4 col-md-6 portfolio-item filter-cat1">
                        <div class="portfolio-wrap">
                          <img src="<?php echo  $pict; ?>" style="max-height: 310px;min-width: 415px;min-height: 310px;" class="img-fluid" alt="">
                          <div class="portfolio-info">

                          </div>
                          <div class="portfolio-links">
                            <a href="<?php echo  $pict; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Cat 1"><i class="bx bx-plus"></i></a>
                            <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                          </div>
                        </div>
                      </div>

              <?php } else {
                      echo "<h4 style='text-align: center;'>No Records Found .</h4>";
                    }
                  }
                }
              } else {
                echo "<h4 style='text-align: center;'>No Records Found .</h4>";
              } */ ?>   

<style type="text/css">
  .img-fluid{

    max-height: 310px;
    min-width: 415px;
    min-height: 310px; 
  }

  #norec{
    margin: 10px;  
  }

</style>

   
<?php 
                  $cn = new _spprofiles;
$result1 = $cn->read_gall($businessId);   
//echo $cn->ta->sql;
if ($result1) {
 while ($row = mysqli_fetch_assoc($result1)) {  


 
$result2 = $cn->read_album_title($row['title']);  
//echo $cn->ta->sql;
if ($result2) {
while ($row1 = mysqli_fetch_assoc($result2)) {
$pict = $row1['file']; 
  ?>
              <div class="col-lg-4 col-md-6 portfolio-item filter-cat<?php echo $row['id'] ?>">  


               <div class="portfolio-wrap">
                          <img src="<?php echo $BaseUrl;?>/upload/<?php echo  $pict; ?>"  class="img-fluid" alt="">
                          <div class="portfolio-info">

                          </div>
                          <div class="portfolio-links">
                            <a href="<?php echo $BaseUrl;?>/upload/<?php echo  $pict; ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" title="<?php echo $row['title'] ?>"><i class="bx bx-plus"></i></a>  
                            <a href="//<?php echo $row1['url'] ?>" title="More Details"><i class="bx bx-link"></i></a>
                     </div> 
                 </div>
              </div>
<?php }} else {
                echo "<h4 id = 'norec'>No Records Found .</h4>"; 
              }  


}} ?>    

              <!--  <div class="col-lg-4 col-md-6 portfolio-item filter-cat3">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Cat 3</h4>
                  <p>Cat 3</p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Cat 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-cat1">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>cat 2</h4>
                  <p>cat </p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="cat 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div> 
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-cat2">  
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Card 2</h4>
                  <p>Card</p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-cat3">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Cat 3</h4>
                  <p>Cat 3</p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Cat 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-cat1">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Cat 3</h4>
                  <p>Cat</p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-cat2">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Card 1</h4>
                  <p>Card</p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-cat2">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Card 3</h4>
                  <p>Card</p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 portfolio-item filter-cat3">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Cat 3</h4>
                  <p>Cat 3</p>
                </div>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Cat 3"><i class="bx bx-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
                </div>
              </div>
            </div>-->

            </div>

          </div>
        </section><!-- End Gallery Section -->

        <!-- ======= About Section ======= -->
       <!-- End About Section --> 

        <!-- ======= Contact Us Section ======= -->

       <!-- End Contact Us Section -->

      </main><!-- End #main -->

    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
