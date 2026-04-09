<?php

    include('../univ/baseurl.php');
    session_start();
    if(isset($_GET['profile']) && $_GET['profile'] >0){
        $profileId = $_GET['profile'];
    }else{
        header('location:'.$BaseUrl.'/freelancer');
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
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/easy-responsive-tabs.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/dropzone.min.js"></script>
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/dropzone.min.css">
        
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectdetails userprofile">
                <p class="back-to-projectlist">
                    <a href="<?php echo $BaseUrl.'/freelancer/';?>"><i class="fa fa-chevron-left"></i>Back to Project list</a>
                </p>
                <?php
                $p =  new _spprofiles;
                $result = $p->read($profileId);
                //echo $p->ta->sql;
                if($result){
                    $row = mysqli_fetch_assoc($result);
                    $Title = $row['spProfileName'];
                    $country = $row['spProfilesCountry'];
                    $city = $row['spProfilesCity'];
                    $picture = $row['spProfilePic'];
                    $overview = $row['spProfileAbout'];


                    $fi = new _profilefield;
                    $result_fi = $fi->getType($row['idspProfiles']);
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

                    $fi = new _profilefield;
                    $result_fi = $fi->read($row['idspProfiles']);
                    //echo $fi->ta->sql;
                    if($result_fi){
                        $ProjectName = '';
                        $perhour = '';
                        $skill = '';
                        while($row_fi = mysqli_fetch_assoc($result_fi)){
                            if($skill == ''){
                                if($row_fi['spProfileFieldName'] == 'skill_'){
                                    $skill = explode(',', $row_fi['spProfileFieldValue']);
                                    
                                }
                            }
                        }
                    }

                }
                ?>
                <div class="col-xs-12 col-sm-9 no-left-padding">
                    <div class="col-xs-12 profile-detail">
                        <div class="col-xs-12 col-sm-2 nopadding">
                            <?php
                            if(isset($picture)){
                                echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src=' ".($picture)."' >" ;
                            }else{
                                echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src='../img/default-profile.png' >" ;
                            }
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-10 freelancer-details">
                            <p class="name"><?php echo $Title;?></p>
                            <p class="designation"><?php echo $ProjectName;?></p>
                            <p class="country"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $city.' , '.$country;?></p>
                        </div>
                        <div class="col-xs-12 col-sm-offset-2 col-sm-10 nopadding professional-skills">
                            <div class="col-xs-12 nopadding">
                                <?php
                                if($skill != ''){
                                    foreach($skill as $key => $value){
                                        echo "<span>".$value."</span>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-xs-12 overview">
                            <p class="heading">Overview</p>
                            <p class="details-description"><?php echo $overview;?></p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3  no-rigth-padding">
                    <div class="col-xs-12 nopadding">
                        <div class="col-xs-12 contact-marina">
                            <p class="contact-marina-heading">Contact <?php echo $Title;?> to Discuss</p>
                            <div class="col-xs-12 contact-marina-content">
                                <form>
                                    <div class="form-group">
                                      <input type="text" class="form-control inputField" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                      <input type="email" class="form-control inputField" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                      <textarea class="form-control inputField-textarea" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group">
                                      <input type="submit" class="form-control inputSubmitField" value="Contact">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--
                        <div class="col-xs-12 blackBox">
                            <p class="blackBox-heading">Work History</p>
                            <div class="col-xs-12 blackBox-content">
                                <p>8 jobs</p>
                                <p>$4k+ earned</p>
                            </div>
                        </div>

                        <div class="col-xs-12 blackBox">
                            <p class="blackBox-heading">Availability</p>
                            <div class="col-xs-12 blackBox-content">
                                <p>Available</p>
                                <p>More than 30 hrs/week</p>
                            </div>
                        </div>
                        -->
                        <div class="col-xs-12 profileLink">
                            <p>Profile Link</p>
                            <input type="text" name="" class="profileLinkField" value="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$profileId;?>">
                        </div>
                    </div>
                </div>
                <!--
                <div class="col-xs-12 portfolioImages nopadding">
                    <p class="heading">Portfolio Images</p>
                    <div class="portfolio">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg1.jpg" class="img-responsive">
                    </div>
                    <div class="portfolio">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg2.jpg" class="img-responsive">
                    </div>
                    <div class="portfolio">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg3.jpg" class="img-responsive">
                    </div>
                    <div class="portfolio">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg4.jpg" class="img-responsive">
                    </div>
                    <div class="portfolio">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg1.jpg" class="img-responsive">
                    </div>
                    <div class="portfolio">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg2.jpg" class="img-responsive">
                    </div>
                    <div class="portfolio">
                        <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg3.jpg" class="img-responsive">
                    </div>
                </div>
                <div class="col-xs-12 nopadding">
                    <div class="col-xs-12 col-sm-4 well"></div>
                    <div class="col-xs-12 col-sm-4 well"></div>
                    <div class="col-xs-12 col-sm-4 well"></div>
                </div>
                -->
                <div class="col-xs-12 nopadding text-center">
                    <a href="javascript:void(0);" class="btn submit-recomnedation-btn"> Submit a Recomnedation</a>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
