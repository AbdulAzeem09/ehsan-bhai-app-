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
        
        <?php include('../component/links.php');?>
		


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
                
				
				
    </head>

    <body class="bg_gray">
        <?php
        //session_start();
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="col-xs-12 freelancer_banner text-center">
                <h1 class="find_freelancer">Find the top <span>freelancers</span> Globally</h1>
                <?php
                
                if($_SESSION['ptid'] == 1){ 
                    $u = new _spuser;
                    // IS EMAIL IS VERIFIED
                    $p_result = $u->isverify($_SESSION['uid']);
                    if ($p_result == 1) {
                        $pv = new _postingview;
                        $reuslt_vld = $pv->chekposting(5,$_SESSION['pid']);
                        if ($reuslt_vld == false) {
                            ?>
                            <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn post-project postproject">Post a project - It’s Free</a>
                            <?php
                        }
                    }
                }else{ ?>
                    <!-- Modal -->
                    <div id="Notabussiness" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content no-radius sharestorepos bradius-10">
                                <div class="modal-header br_radius_top bg-white">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                                </div>
                                <div class="modal-body nobusinessProfile">
                                    <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                    <h2>Please switch to your bussiness profile to <span>post project.</span></h2>
                                    <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn" style = "background: #eb6c0b!important;">Switch/Create Profile</a>
                                </div>
                                <div class="modal-footer br_radius_bottom bg-white">
                                    <button type="button" style="background: #eb6c0b!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="" class="btn post-project postproject"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
                }
                ?>
                
                <p class="looking-for-freelancer">Looking for freelance work? - Review our benefits and apply for a profile</p>
            </div>
            <div class="col-xs-12 search-freelancer">
                <div class="container">
                    <div class="searchbar col-xs-12 mt-40 bradius-10">
                        <form class="col-xs-12" method="post" action="search.php" >
                            <div class="form-group">
                                
                                <input class="form-control searchfiled searchborder" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
                                <input class="btn search-freelancer-btn searchborder" value="Search" name="btnSearchProject" type="submit">
                            </div>
                        </form>
                        <div class="col-xs-12 col-sm-10">
                            <ul class="dashboardlink">

                          <li><a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat=ALL';?>">Browse all projects</a></li>
                                <li><span>|</span></li>
                                <li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?>">Browse all freelancer</a></li>
                                
                                <li><span>|</span></li>
                                <?php
                                if($_SESSION['ptid'] == 1){ 
                                    ?>
                                <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/poster_dashboard.php';?>">My Dashboard</a></li>
                           <?php
                            }else{

                                ?>

                                <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard/';?>">My Dashboard</a></li>


                               <?php

                                  }

                                ?>
                          
                                    
                                
                            </ul>
                            
                        
                        
                        
                        
                        </div>
                    </div>
                    <!--<div class="col-xs-12">
                                -->
                        <?php
                       
                        $result_count = $f->freelancers($_SESSION['uid']);
                        $total_frelance = $result_count->num_rows;
                        ?>
                       
                        
                        
                    </div>
                   
                </div>
            </div>
            <?php include('btm-category.php'); ?>
            <div class="col-xs-12 how-itworks">
                 <div class="container">
                    <h2>How it <span>works</span></h2>
                    <div class="col-xs-12 col-sm-3">
                        <div class="how-itworks-content br-15-overflow">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/find.png" class="img-responsive center-block">
                            <p class="how-itworks-name">Find</p>
                            <p class="how-itworks-description pb-34">
                                Post a job to tell us about your project. We'll quickly match you with the right freelancers.
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 ">
                        <div class="how-itworks-content br-15-overflow">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/hire.png" class="img-responsive center-block">
                            <p class="how-itworks-name">Hire</p>
                            <p class="how-itworks-description pb-34">
                                Post a job to tell us about your project. We'll quickly match you with the right freelancers.
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 ">
                        <div class="how-itworks-content br-15-overflow">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/work.png" class="img-responsive center-block">
                            <p class="how-itworks-name">Work</p>
                            <p class="how-itworks-description pb-34">
                                Use the SharePage platform to chat, share files, and collaborate from your desktop or on the go.
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 ">
                        <div class="how-itworks-content br-15-overflow">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/pay.png" class="img-responsive center-block">
                            <p class="how-itworks-name">Pay</p>
                            <p class="how-itworks-description">
                                Invoicing and payments happen through Upwork. With SharePage Protection, only pay for work you authorize.
                            </p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-xs-12 our-clients">
                <div class="container">
                    <h2 class="our-clients-heading">Hear what our <span>clients</span> have to say</h2>
                     <div class="carousel slide" id="fade-quote-carousel" data-ride="carousel" data-interval="3000">
                  <!-- Carousel indicators -->
                  <ol class="carousel-indicators">
                    <li data-target="#fade-quote-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="1"></li>
                    <li data-target="#fade-quote-carousel" data-slide-to="2"></li>
                  </ol>
                  <!-- Carousel items -->
                  <div class="carousel-inner">
                    <div class="item">
                        <div class="col-xs-12 col-sm-3">
                            <div class="profile-circle">
                                <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/client-avatar.jpg" class="img-responsivec center-block">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <p class="freelancerthansk">SharePage Freelancer is an amazing service that I highly recommend to businesses of all sizes looking to find short or long-term, high quality resources.</p>
                            <p class="freelancername">Bev Flaxington</p>
                            <p class="freelancerdesignation">CEO of Innovative</p>
                        </div>   
                    </div>
                    <div class="item">
                        <div class="col-xs-12 col-sm-3">
                            <div class="profile-circle">
                                <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/client-avatar.jpg" class="img-responsivec center-block">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <p class="freelancerthansk">SharePage Freelancer is an amazing service that I highly recommend to businesses of all sizes looking to find short or long-term, high quality resources.</p>
                            <p class="freelancername">Bev Flaxington</p>
                            <p class="freelancerdesignation">CEO of Innovative</p>
                        </div>
                    </div>
                    <div class="active item">
                        <div class="col-xs-12 col-sm-3">
                            <div class="profile-circle">
                                <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/client-avatar.jpg" class="img-responsivec center-block">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <p class="freelancerthansk">SharePage Freelancer is an amazing service that I highly recommend to businesses of all sizes looking to find short or long-term, high quality resources.</p>
                            <p class="freelancername">Bev Flaxington</p>
                            <p class="freelancerdesignation">CEO of Innovative</p>
                        </div>
                    </div>
                  </div>
                  <!-- Carousel Buttons Next/Prev -->
                    <a data-slide="prev" href="#quote-carousel" class="carousel-control-prev">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/left-comas.png" class="img-responsive">
                    </a>
                    <a data-slide="next" href="#quote-carousel" class="carousel-control-next">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/right-comas.png" class="img-responsive">
                    </a>
                </div>
                </div>
            </div>
          
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