<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin'] = "../timeline/";
    }

    $f = new _spprofiles;
    //check profile is freelancer or not
    $chekIsFreelancer = $f->readfreelancer($_SESSION['uid']);
    if($chekIsFreelancer == false){
        header('location:'.$BaseUrl.'/my-profile/');
    }

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        
        <?php include('../component/links.php');?>


        <!-- owl carousel -->
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/percentage.css">

        <!-- responsive tabs -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/easy-responsive-tabs.css">
        <link href="<?php echo $BaseUrl;?>/assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
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
                        ?>
                        <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn post-project">Post a project - It’s Free</a>
                        <?php
                    }
                }else{ ?>
                    <!-- Modal -->
                    <div id="Notabussiness" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content no-radius sharestorepos">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                
                                </div>
                                <div class="modal-body nobusinessProfile">
                                    <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                                    <h2>You have no business profile. If you want to <span>post job</span> then make your own business profile. </h2>
                                    <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Creat Business Profile</a>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a href="" class="btn post-project"  data-toggle="modal" data-target="#Notabussiness" >Post a project - It’s Free</a> <?php
                }
                ?>
                
                <p class="looking-for-freelancer">Looking for freelance work? - Review our benefits and apply for a profile</p>
            </div>
            <div class="col-xs-12 search-freelancer">
                <div class="container">
                    <div class="searchbar col-xs-12">
                        <form class="col-xs-12" method="post" action="search.php" >
                            <div class="form-group">
                                
                                <input class="form-control searchfiled" name="txtSearchProject" placeholder="Search a project" type="text" required="" />
                                <input class="btn search-freelancer-btn" value="Search" name="btnSearchProject" type="submit">
                            </div>
                        </form>
                        <div class="col-xs-12 col-sm-10">
                            <ul class="dashboardlink">
                                <li><a href="<?php echo $BaseUrl.'/freelancer/projects.php';?>">Browse all projects</a></li>
                                <li><span>|</span></li>
                                <li><a href="<?php echo $BaseUrl.'/freelancer/freelancer.php';?>">Browse all freelancer</a></li>
                                <?php
                                // this is only business or professional profiles
                                if ($_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 2 || $_SESSION['ptid'] == 3) { ?>
                                    <li><span>|</span></li>
                                    <li><a href="<?php echo $BaseUrl.'/freelancer/dashboard.php';?>">My Dashboard</a></li>
                                    <?php
                                }
                                ?>
                                
                            </ul>
                            
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <?php
                       
                        $result_count = $f->freelancers($_SESSION['uid']);
                        $total_frelance = $result_count->num_rows;
                        ?>
                        <h2 class="top-freelancer">Sharepage is a Curated Talent Network of <span>#<?php echo $total_frelance;?></span> Top Freelancer</h2>
                        <p class="offer-note">We offer exclusive access to thousands of freelancers used by the best startups, agencies and businesses. Easily find talent, or have us do the search for you. Then hire direct with no restrictions!</p>
                    </div>
                    <div class="col-xs-12 freelancers-ids">
                        <div class="owl-carousel owl-theme">
                            <?php
                            
                            $result = $f->freelancers($_SESSION['uid']);
                            //echo $f->ta->sql;
                            if($result != false){
                                while($rows = mysqli_fetch_assoc($result)){  ?> 
                                    <div class="item">
                                        <div class="freelancer-content">
                                            <div class="avatar">
                                                <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$rows['idspProfiles'];?>">
                                                <?php 
                                                $picture = $rows['spProfilePic'];
                                                if(isset($picture)){
                                                    echo "<img  alt='Posting Pic' class='img-responsive' src=' ".($picture)."' >" ;
                                                }else{
                                                    echo "<img  alt='Posting Pic' class='img-responsive' src='../img/default-profile.png' >" ;
                                                }
                                                
                                                ?>
                                                </a>
                                            </div>
                                            <div class="col-xs-12 nopadding">
                                                <h5 class="freelancer-name"><a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$rows['idspProfiles'];?>"><?php echo $rows["spProfileName"];?></a></h5>
                                                <?php
                                                $fi = new _profilefield;
                                                $result_fi = $fi->getType($rows['idspProfiles']);
                                                //echo $fi->ta->sql;
                                                if($result_fi){
                                                    $row_fi = mysqli_fetch_assoc($result_fi);
                                                    $pro = new _projecttype;
                                                    $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                    //echo $pro->ta->sql;
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }else{
                                                        $ProjectName = "Not Define";
                                                    }
                                                }else{
                                                    $ProjectName = "Not Define";
                                                }
                                                //gettotal skills
                                                $result_sk = $fi->getSkill($rows['idspProfiles']);
                                                if($result_sk){
                                                    $row_sk = mysqli_fetch_assoc($result_sk);
                                                    $string_sk = explode(',', $row_sk['spProfileFieldValue']);
                                                    $totalSkil = count($string_sk);
                                                    //print_r($string_sk);
                                                }else{
                                                    $totalSkil = 0;
                                                }
                                                ?>
                                                <p class="freelancer-designation"><?php echo $ProjectName;?></p>
                                                <p class="skill-rating">Skills: (<span><?php echo $totalSkil;?> Skills</span>)</p>
                                                
                                                <!--<p class="job-success">Job Success <span>70%</span></p>
                                                <div class="progress-wrap progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                                      <span class="sr-only">70% Complete</span>
                                                    </div>
                                                </div>-->
                                                
                                            </div>
                                        </div>
                                    </div> <?php
                                    
                                    
                                }
                            }
                            ?>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 how-itworks">
                 <div class="container">
                    <h2>How it <span>works</span></h2>
                    <div class="col-xs-12 col-sm-3">
                        <div class="how-itworks-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/find.png" class="img-responsive center-block">
                            <p class="how-itworks-name">Find</p>
                            <p class="how-itworks-description">
                                Post a job to tell us about your project. We'll quickly match you with the right freelancers.
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="how-itworks-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/hire.png" class="img-responsive center-block">
                            <p class="how-itworks-name">Hire</p>
                            <p class="how-itworks-description">
                                Post a job to tell us about your project. We'll quickly match you with the right freelancers.
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="how-itworks-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/work.png" class="img-responsive center-block">
                            <p class="how-itworks-name">Work</p>
                            <p class="how-itworks-description">
                                Use the SharePage platform to chat, share files, and collaborate from your desktop or on the go.
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <div class="how-itworks-content">
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
            <?php include('btm-category.php'); ?>
        </section>



        
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
