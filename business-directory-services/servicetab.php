<?php

include('../univ/baseurl.php');
session_start();
/* if (!isset($_SESSION['pid'])) {
  $id=$_GET['business'];
  $_SESSION['afterlogin'] = "business-directory-services/details.php?business=".$id;  
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

$b_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
 
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
if(isset($_POST['send_mail'])){

$em = new _email;  

//$prof->remove_business_tab($_SESSION['uid'],$_SESSION['pid']);

$name= $_POST['name'];
$email= $_POST['email'];
$subject= $_POST['subject'];
$message= $_POST['message'];
$owner_email= $_POST['owner_email'];      
            
  
$e = new _spprofiles;

    $res1 = $e->read_description(11);
    $rows = mysqli_fetch_assoc($res1);
    $messages = $rows['notification_description'];



$res = $em->bussiness_send_mail($messages,$name,$owner_email,$message,$email,$subject);           
   



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

        <nav id="navbar" class="navbar"> 
          <ul>
             <?php include('top-bar-tab.php'); ?>     
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>  
        </nav><!-- .navbar -->

      </div>
    </header><!-- End Header -->

    <main id="main">

       <!-- ======= Services Section ======= -->
      <section id="services" class="services">
        <div class="container">

          <div class="section-title" data-aos="fade-down">

            <?php 




$p = new _spprofiles;

$rpvt = $p->read_menu_by_id($b_id); 

if ($rpvt != false){
$row_p = mysqli_fetch_assoc($rpvt);

//echo "<pre>";
//print_r($row_p);
$title = $row_p['title'];
$description = $row_p['description'];
$menu_name = $row_p['menu_name'];
$id = $row_p['id'];
 

}
?>
            <span><?php echo $title ?></span>
            <h2><?php echo $title; ?></h2>
            <p><?php echo $description; ?></p>   
          </div>

          <div class="row">
<?php 
            $cn = new _spprofiles;
                $result1 = $cn->read_menu_id_serv($b_id); 
                //echo $cn->ta->sql;
                if ($result1) {
                    while ($row = mysqli_fetch_assoc($result1)) {

?>
             <span style="font-weight: 900;"><?php echo  $row['section_name']; ?></span>
             <br> 
            <div class="col-lg-8 col-md-8 mt-5 mt-md-0 d-flex align-items-stretch">
              <div class="" data-aos="fade-up" data-aos-delay="100">
                
                <p><?php echo  $row['section_desc']; ?></p>       
              </div>
            </div>

             <div class="col-lg-4 col-md-4 mt-5 mt-md-0 d-flex align-items-stretch">    
                      <?php if($row['section_img']){ ?>
              <img  class= "" src="<?php  echo $BaseUrl; ?>/upload/<?php echo $row['section_img']; ?>" alt="" width="250" height="250">  
                        <?php }else{?>
                          <img  class= "" src="<?php  echo $BaseUrl; ?>/img/no.png" alt="" width="250" height="250">
                          <?php } ?>
              <div class="" data-aos="fade-up" data-aos-delay="100">

              </div>
            </div>

          <?php } } ?>
            <!--<div class="col-md-6">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-card-checklist" style="color: #07cc70;"></i>
                <h4><a href="#">Dolor Sitema</a></h4>
                <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-bar-chart" style="color: #e40373;"></i>
                <h4><a href="#">Sed ut perspiciatis</a></h4>
                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-binoculars" style="color: #f0b103;"></i>
                <h4><a href="#">Nemo Enim</a></h4>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="500">
                <i class="bi bi-brightness-high" style="color: #3145fa;"></i>
                <h4><a href="#">Magni Dolore</a></h4>
                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="icon-box" data-aos="fade-up" data-aos-delay="600">
                <i class="bi bi-calendar4-week" style="color: #a00098;"></i>
                <h4><a href="#">Eiusmod Tempor</a></h4>
                <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
              </div>
            </div>-->   
          </div>

        </div>
      </section><!-- End Services Section -->  


      <!-- ======= About Section ======= -->
      <!--<section id="about" class="about">
        <div class="container">  

          <div class="row">
            <?php

            if ($spfile1) { ?>        
              <div style="background-image: url('<?php echo $BaseUrl; ?>/business-directory/upload/<?php echo $spfile1; ?>')" data-aos="fade-right" class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
            <?php } else { ?>
              <div style="background-image: url('<?php echo $BaseUrl; ?>/business-directory-services/images/default.jpg')" data-aos="fade-right" class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
            <?php } ?>
            <div class="col-xl-7 pt-4 pt-lg-0 d-flex align-items-stretch">
              <div class="content d-flex flex-column justify-content-center" data-aos="fade-left">
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
              </div>--><!-- End .content-->  
            <!--</div>
          </div>

        </div>
      </section>--><!-- End About Section -->

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
