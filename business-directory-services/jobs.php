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

    $res1 = $e->read_description(11);
    $rows = mysqli_fetch_assoc($res1);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>

    <style>
      body {
	font-family: 'Roboto', sans-serif;
	font-size: 14px;
	line-height: 18px;
	background: #f4f4f4;
}

.list-wrapper {
	padding: 15px;
	overflow: hidden;
}

.list-item {
	/* border: 1px solid #EEE;
	background: #FFF; */
	margin-bottom: 10px;
	padding: 10px;
	/* box-shadow: 0px 0px 10px 0px #EEE; */
}

.list-item h4 {
	color: #FF7182;
	font-size: 18px;
	margin: 0 0 5px;	
}

.list-item p {
	margin: 0;
}

.simple-pagination ul {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	text-align: center;
}

.simple-pagination li {
	display: inline-block;
	margin-right: 5px;
}

.simple-pagination li a,
.simple-pagination li span {
	color: #666;
	padding: 5px 10px;
	text-decoration: none;
	border: 1px solid #EEE;
	background-color: #FFF;
	box-shadow: 0px 0px 10px 0px #EEE;
}

.simple-pagination .current {
	color: #FFF;
	background-color: #FF7182;
	border-color: #FF7182;
}

.simple-pagination .prev.current,
.simple-pagination .next.current {
	background: #e04e60;
}
    </style>
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
      <section id="<?php // echo ((isset($spfile)) ? 'topdircty1' : 'hero'); 
                    ?>">-->
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
              <span>Jobs</span>
              <h2>Jobs</h2>
              <!--<p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>-->
            </div>
            <div class="row list-wrapper">
              <?php
              $m = new  _jobpostings;
              // $result = $m->myProfilejobpost($_GET['business']);
              $result = $m->myProfilejobpost($businessId);
              //echo $m->ta->sql;
              if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                  //echo '<pre>'; 
                  // print_r($row);
                  $postDate = new DateTime($row['spPostingDate']);

                  $date = strtotime($row["spPostingDate"]);
                  $date1 = date('Y-m-d');
                  $date2 = $row["spPostingExpDt"];

                  $date1_ts = strtotime($date1);
                  $date2_ts = strtotime($date2);
                  $diff = $date2_ts - $date1_ts;

              ?>
                  <div class="col-lg-4 col-md-6 d-flex align-items-stretch list-item">
                    <div class="card" data-aos="fade-up">
                      <div class="card-body">
                        <h5 class="card-title"><a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>"><?php echo ucfirst($row['spPostingTitle']); ?></a></h5>

                        <table class="table table-bordered">
                          <tr>
                            <td>Company Name:</td>
                            <td>abc</td>
                          </tr>
                          <tr>
                            <td>Company Size:</td>
                            <td><?php echo ucfirst($row['spPostingSkill']); ?></td>
                          </tr>
                          <tr>
                            <td>Total Positions:</td>
                            <td><?php echo ucfirst($row['spPostingNoofposition']); ?></td>
                          </tr>
                          <tr>
                            <td>Job Type:</td>
                            <td><?php echo ucfirst($row['spPostingJobType']); ?></td>
                          </tr>
                          <tr>
                            <td>Job Level:</td>
                            <td><?php echo ucfirst($row['spPostingJoblevel']); ?></td>
                          </tr>
                          <tr>
                            <td>Salary:</td>
                            <td>
                              <?php if ($row['spPostingSlryRngFrm'] > 0) {
                                echo $row['job_currency'] . ' ' . $row['spPostingSlryRngFrm'] . ' - ' . $row['job_currency'] . ' ' . $row['spPostingSlryRngTo'] . '';
                              } ?>

                            </td>
                          </tr>
                          <tr>
                            <td>Closing Date:</td>
                            <td><?php echo round($diff / 86400); ?> days left</td>
                          </tr>
                          <tr>
                            <td>Min Experience:</td>
                            <td><?php echo ucfirst($row['spPostingExperience']); ?></td>
                          </tr>
                          <tr>
                            <td>Location:</td>
                            <td>
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
                                //echo $currentcountryn;
                              }
                              if (!empty($currentstaten)) {
                                //echo ', ' . $currentstaten;
                              }
                              if (!empty($currentcityn)) {
                                echo '' . $currentcityn;
                              }
                              ?>


                            </td>
                          </tr>
                        </table>
                      </div>
                      <div class="card-footer bg-transparent text-center">
                        <a href="<?php echo $BaseUrl . '/job-board/job-detail.php?postid=' . $row['idspPostings']; ?>">Apply Now</a>
                      </div>
                    </div>
                  </div>

              <?php }
              } ?>
              <!--<div class="col-lg-4 col-md-6 mt-5 mt-md-0 d-flex align-items-stretch">
              <div class="card" data-aos="fade-up" data-aos-delay="150">
                <div class="card-body">
                  <h5 class="card-title"><a href="">Job-2</a></h5>
                  <p class="card-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. </p>
                  <table class="table table-bordered">
                    <tr>
                      <td>Company Name:</td>
                      <td >abc</td>
                    </tr>
                    <tr>
                      <td>Company Size:</td>
                      <td >Accounts</td>
                    </tr>
                    <tr>
                      <td>Total Positions:</td>
                      <td >1</td>
                    </tr>
                    <tr>
                      <td>Job Type:</td>
                      <td >HOSPITALITY BUSINESS</td>
                    </tr>
                    <tr>
                      <td>Job Level:</td>
                      <td > Full Time</td>
                    </tr>
                    <tr>
                      <td>Salary:</td>
                      <td >USD 200 - USD 800</td>
                    </tr>
                    <tr>
                      <td>Closing Date:</td>
                      <td > 2023-06-30</td>
                    </tr>
                    <tr>
                      <td>Min Experience:</td>
                      <td >Fresh</td>
                    </tr>
                    <tr>
                      <td>Location:</td>
                      <td >Patras</td>
                    </tr>
                  </table>
                </div>
                <div class="card-footer bg-transparent text-center">
                  <a href="#">Apply Now</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-5 mt-lg-0 d-flex align-items-stretch">
              <div class="card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-body">
                  <h5 class="card-title"><a href="">Job-3</a></h5>
                  <p class="card-text">Nemo enim ipsam voluptatem quia voluptas sit aut odit aut fugit, sed quia magni dolores eos qui ratione voluptatem sequi nesciunt Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet. </p>
                  <table class="table table-bordered">
                    <tr>
                      <td>Company Name:</td>
                      <td >abc</td>
                    </tr>
                    <tr>
                      <td>Company Size:</td>
                      <td >Accounts</td>
                    </tr>
                    <tr>
                      <td>Total Positions:</td>
                      <td >1</td>
                    </tr>
                    <tr>
                      <td>Job Type:</td>
                      <td >HOSPITALITY BUSINESS</td>
                    </tr>
                    <tr>
                      <td>Job Level:</td>
                      <td > Full Time</td>
                    </tr>
                    <tr>
                      <td>Salary:</td>
                      <td >USD 200 - USD 800</td>
                    </tr>
                    <tr>
                      <td>Closing Date:</td>
                      <td > 2023-06-30</td>
                    </tr>
                    <tr>
                      <td>Min Experience:</td>
                      <td >Fresh</td>
                    </tr>
                    <tr>
                      <td>Location:</td>
                      <td >Patras</td>
                    </tr>
                  </table>
                </div>
                <div class="card-footer bg-transparent text-center">
                  <a href="#">Apply Now</a>
                </div>
              </div>
            </div>-->
            </div>
            <div id="pagination-container"></div>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
    <script>

var items = $(".list-wrapper .list-item");
    var numItems = items.length;
    var perPage = 6;

    items.slice(perPage).hide();

    $('#pagination-container').pagination({
        items: numItems,
        itemsOnPage: perPage,
        prevText: "&laquo;",
        nextText: "&raquo;",
        onPageClick: function (pageNumber) {
            var showFrom = perPage * (pageNumber - 1);
            var showTo = showFrom + perPage;
            items.hide().slice(showFrom, showTo).show();
        }
    });

    </script>
  </body>

  </html>

<?php
//}  
?>
