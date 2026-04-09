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




    .mapp {
      font-size: 22px !important;
      color: #212529 !important;
      text-align: center !important;
      position: absolute !important;
      left: 6% !important;
      top: 55px !important;
      transform: translateX(-50%) translateY(-50%) !important;
      z-index: 1 !important;
    }

    .starr {
      font-size: 22px !important;
      color: #212529 !important;
      text-align: center !important;
      position: absolute !important;
      left: 92% !important;
      top: 86% !important;
      transform: translateX(-50%) translateY(-50%) !important;
      z-index: 1 !important;
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

          <nav id="navbar" class="navbar">
            <ul>
              <?php include('top-bar-tab.php'); ?>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
          </nav><!-- .navbar -->

        </div>
      </header><!-- End Header -->

      <main id="main">

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">
          <div class="container">
            <div class="section-title" data-aos="fade-down">
              <span>Events</span>
              <h2>Events</h2>
              <!--<p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>-->
            </div>
            <div class="row">

              <?php
              $st = new _spuser;


              $start = 0;
              $p      = new _spevent;

              $_GET["categoryID"] = "9";
              $res    = $p->getActiveEventsrecord($businessId, -1, $_GET["categoryID"]);

              if ($res != false) {
                while ($row = mysqli_fetch_assoc($res)) {
                  //print_r($row);
                  // die("+++++");
                  $venu = "";
                  $startDate = "";
                  $startTime    = "";
                  $endTime = "";
                  $OrganizerName = "";

                  $gid = $row['groupid'];
                  //echo $gid;
                  $venu = $row['spPostingEventVenue'];
                  $startDate = $row['spPostingStartDate'];
                  $startTime = $row['spPostingStartTime'];
                  $endTime = $row['spPostingEndTime'];
                  $desc = $row['spPostingNotes'];
                  $pid = $row['spProfiles_idspProfiles'];

                  //---read profile name-------
                  $pro = new _spprofiles;
                  $result7 = $pro->profile_name($pid);
                  if ($result7 != false) {
                    $row7 = mysqli_fetch_assoc($result7);
                  }
              ?>
                  <div class="col-lg-4 col-md-6 mt-5 mt-md-0 d-flex align-items-stretch">
                    <div class="card" data-aos="fade-up">
                      <?php
                      $pic = new _eventpic;

                      $res2 = $pic->readFeature($row['idspPostings']); 
                      if ($res2 != false) {
                        $rp = mysqli_fetch_assoc($res2);
                        $pic2 = $rp['spPostingPic'];
                      ?> <a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>">
                          <img src="<?php echo $pic2; ?>" style="height: 275px; min-width: 380px;" class="card-img-top" alt="...">
                        </a>
                      <?php } else { ?>
                        <img src="../img/noevent.jpg" style="height: 275px; min-width: 380px;" class="card-img-top" alt="...">
                      <?php } ?>

                      <div class="card-body">
                        <div class="d-flex justify-content-between">


                          <?php
                          if (!empty($startDate)) {
                            //echo $start_date;
                            $dy = new DateTime($startDate);
                            $day = $dy->format('d');
                            $month = $dy->format('M');
                            $weak = $dy->format('D');
                          } else {
                            $day = 0;
                            $month = "&nbsp;";
                            $weak = "&nbsp;";
                          }
                          ?>
                          <h6 class="card-title"><a href="<?php echo $BaseUrl . '/events/event-detail.php?postid=' . $row['idspPostings']; ?>"><?php echo $row['spPostingTitle']; ?></a></h6>
                          <h6 class="card-title"><span><?php echo $month . ' ' . $day; ?>&nbsp;&nbsp;<?php echo $weak; ?></span></h6>
                        </div>
                        <span><i class="bx bx-map mapp"></i><span style="margin-left: 20px;"><?php echo $venu; ?></span></span>
                        <?php if (strlen($desc) < 40) { ?>
                          <p class="card-text"><?php echo $desc; ?></p>
                        <?php } else { ?>
                          <p class="card-text"><?php echo substr($desc, 0, 40) . '...'; ?></p>
                        <?php } ?>
                        <div class="d-flex justify-content-between">
                          <a class="btn btn-outline-secondary mx-1" href="#" role="button">Posted By: <?php echo $row7['spProfileName']; ?></a>
                          <!--<a class="btn btn-outline-secondary mx-1" href="#" role="button">Out Dated</a>
                          <a class="btn btn-outline-secondary mx-1" href="#" role="button"><i class="bx bx-star starr"></i></i></a>-->
                        </div>
                      </div>
                      <!--<div class="card-footer bg-transparent text-center d-flex justify-content-between">
                        <a href="#">Proposal: <span>2</span></a>
                        <a href="#">USD: <span>20</span></a>
                      </div>-->
                    </div>
                  </div>
              <?php }
              } else {
                echo "<h4 style='text-align: center;'>No Records Found .</h4>";
              }  ?>

              <!-- <div class="col-lg-4 col-md-6 mt-5 mt-md-0 d-flex align-items-stretch">
            <div class="card" data-aos="fade-up" data-aos-delay="150">
              <img src="assets/img/features-1.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                <h6 class="card-title"><a href="">Graphics</a></h6>
                <h6 class="card-title"><span>24 Dec 2022</span></h6>
                </div>
                <span><i class="bx bx-map"></i> Canada</span>
                <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                <div class="d-flex justify-content-between">
                  <a class="btn btn-outline-secondary mx-1" href="#" role="button">Posted By: ABC</a>
                  <a class="btn btn-outline-secondary mx-1" href="#" role="button">Out Dated</a>
                  <a class="btn btn-outline-secondary mx-1" href="#" role="button"><i class="bx bx-star"></i></i></a>
                </div>
              </div>
              <div class="card-footer bg-transparent text-center d-flex justify-content-between">
                <a href="#">Proposal: <span>2</span></a>
                <a href="#">USD: <span>20</span></a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mt-5 mt-lg-0 d-flex align-items-stretch">
            <div class="card" data-aos="fade-up" data-aos-delay="300">
              <img src="assets/img/features-1.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                <h6 class="card-title"><a href="">Digital Marketing</a></h6>
                <h6 class="card-title"><span>24 Dec 2022</span></h6>
                </div>
                <span><i class="bx bx-map"></i> Canada</span>
                <p class="card-text">Nemo enim ipsam voluptatem quia voluptas sit aut odit aut fugit, sed quia magni dolores eos qui ratione voluptatem sequi nesciunt Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet. </p>
                <div class="d-flex justify-content-between">
                  <a class="btn btn-outline-secondary mx-1" href="#" role="button">Posted By: ABC</a>
                  <a class="btn btn-outline-secondary mx-1" href="#" role="button">Out Dated</a>
                  <a class="btn btn-outline-secondary mx-1" href="#" role="button"><i class="bx bx-star"></i></i></a>
                </div>
              </div>
              <div class="card-footer bg-transparent text-center d-flex justify-content-between">
                <a href="#">Proposal: <span>2</span></a>
                <a href="#">USD: <span>20</span></a>
              </div>
            </div>
          </div>-->
            </div>

          </div>
        </section><!-- End Features Section -->

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
