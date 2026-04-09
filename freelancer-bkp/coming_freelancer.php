<?php 
include('../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "freelacer/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $f = new _spprofiles;
    $re = new _redirect;

    //check profile is freelancer or not
    $chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
    if($chekIsFreelancer == false){
        $redirctUrl = $BaseUrl . "/my-profile/";
        $_SESSION['count'] = 0;
        $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
        $re->redirect($redirctUrl);
    }else{



?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        
        <?php include('../component/f_links.php');?>


       <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">


        <!-- owl carousel -->


        <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/percentage.css">

        <!-- responsive tabs -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/easy-responsive-tabs.css">
        <link href="<?php echo $BaseUrl;?>/assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

        
        
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/easy-responsive-tabs.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/dropzone.min.js"></script>
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/dropzone.min.css">
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    autoPlay: true,
                    responsiveClass: true,
                    responsive: {
                      0: {
                        items: 1,
                        nav: false
                      },
                      600: {
                        items: 3,
                        nav: false
                      },
                      1000: {
                        items: 7,
                        nav: false
                      }
                    }
                });
                $('#horizontalTab').easyResponsiveTabs({
                    type: 'default', //Types: default, vertical, accordion           
                    width: 'auto', //auto or any width like 600px
                    fit: true,   // 100% fit in a container
                    closed: 'accordion', // Start closed if in accordion view
                    activate: function(event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                    }
                });
            });
            
        </script>

       <!--  <style type="text/css">
            
            .coming_banner {
    background: url(../images/freelancer/Coming-Soon.jpg) no-repeat;
    background-size: cover!important;
}
        </style>
                 -->
    </head>

    <body class="bg_gray">

 <?php
        //session_start();
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
           <!--  <div class="col-xs-12  text-center">
 -->
             <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/coming-soon.png" style="width: 100%; background-size: cover!important;">



        <!--     </div> -->
</section>
        
<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
    </body>
</html>
    <?php 
    }
}
?>