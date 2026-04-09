<?php 
    include('../univ/baseurl.php');
    session_start();
    if(isset($_GET['pro']) && $_GET['pro'] >0){

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
        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="col-xs-12 category_selected_banner text-center">
                <h1 class="category_name">
                    <?php
                    $p = new _projecttype;
                    $result = $p->getProjectName($_GET['pro']);
                    if($result != false){
                        $row = mysqli_fetch_assoc($result);
                        echo $row['project_title'];
                    }
                    ?>
                </h1>
                <p class="choose_among">Choose among top mobile engineers & designers</p>
                <a href="<?php echo $BaseUrl.'/post-ad/freelancer/?post';?>" class="btn get-started">Get Started</a>
            </div>
            <div class="col-xs-12 category_tabs">
                <div class="container">
                    <div id="horizontalTab">
                        <ul class="resp-tabs-list">
                            <li class="<?php echo (isset($_GET['pro']) && $_GET['pro'] == 1)?'resp-tab-active': '';?>">WEB <br>DEVELOPERS</li>
                            <li class="<?php echo (isset($_GET['pro']) && $_GET['pro'] == 2)?'resp-tab-active': '';?>">MOBILE <br>DEVELOPERS </li>
                            <li class="<?php echo (isset($_GET['pro']) && $_GET['pro'] == 3)?'resp-tab-active': '';?>">DESIGNER & <br>CREATIVE TALENTS</li>
                            <li class="single-word <?php echo (isset($_GET['pro']) && $_GET['pro'] == 4)?'resp-tab-active': '';?>">WRITERS</li>
                            <li class="<?php echo (isset($_GET['pro']) && $_GET['pro'] == 5)?'resp-tab-active': '';?>">CUSTOMER <br>SERVICE AGENTS</li>
                            <li class="<?php echo (isset($_GET['pro']) && $_GET['pro'] == 6)?'resp-tab-active': '';?>">SALES & <br>MARKETING EXPERTS</li>
                            <li class="<?php echo (isset($_GET['pro']) && $_GET['pro'] == 7)?'resp-tab-active': '';?>">ACCOUNTANT & <br>CONSULTANTS</li>
                            <li class="<?php echo (isset($_GET['pro']) && $_GET['pro'] == 8)?'resp-tab-active': '';?>">Admin <br>Support</li>
                        </ul>
                        <div class="resp-tabs-container">
                            <div class="web-developer <?php echo (isset($_GET['pro']) && $_GET['pro'] == 1)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">WEB DEVELOPERS</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],1);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="mob-developer <?php echo (isset($_GET['pro']) && $_GET['pro'] == 2)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">MOBILE DEVELOPERS</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],2);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="designer-creative-talents <?php echo (isset($_GET['pro']) && $_GET['pro'] == 3)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">DESIGNER & CREATIVE TALENTS</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],3);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="writers <?php echo (isset($_GET['pro']) && $_GET['pro'] == 4)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">WRITERS</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],4);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="CUSTOMER-SERVICE-AGENTS <?php echo (isset($_GET['pro']) && $_GET['pro'] == 5)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">CUSTOMER SERVICE AGENTS</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],5);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="SALES-MARKETING-EXPERTS <?php echo (isset($_GET['pro']) && $_GET['pro'] == 6)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">SALES & MARKETING EXPERTS</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],6);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="ACCOUNTANT-CONSULTANTS <?php echo (isset($_GET['pro']) && $_GET['pro'] == 7)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">ACCOUNTANT & CONSULTANTS</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],7);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="ADMIN-SUPPORT <?php echo (isset($_GET['pro']) && $_GET['pro'] == 8)?'resp-tab-content-active': '';?>">
                                <h4 class="browse-category-engineer">ADMIN SUPPORT</h4>
                                <?php
                                $f = new _spprofiles;
                                $result = $f->get_category_freelancers($_SESSION['uid'],8);
                                //echo $f->ta->sql;
                                if($result){
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $fi = new _profilefield;
                                        $result_fi = $fi->read($row['idspProfiles']);
                                        //echo $fi->ta->sql;
                                        if($result_fi){
                                            $ProjectName = '';
                                            $perhour = '';
                                            $skill = '';
                                            while($row_fi = mysqli_fetch_assoc($result_fi)){
                                                $pro = new _projecttype;
                                                $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
                                                //echo $pro->ta->sql;
                                                if($ProjectName == ''){
                                                    if($result_pro){
                                                        $row_pr = mysqli_fetch_assoc($result_pro);
                                                        $ProjectName = $row_pr['project_title'];
                                                    }
                                                }

                                                if($perhour == ''){
                                                    if($row_fi['spProfileFieldName'] == 'hourlyrate_'){
                                                        $perhour = $row_fi['spProfileFieldValue'];
                                                    }
                                                }

                                                if($skill == ''){
                                                    if($row_fi['spProfileFieldName'] == 'skill_'){
                                                        $skill = explode(',', $row_fi['spProfileFieldValue']);
                                                        
                                                    }
                                                }
                                            }  
                                            ?>
                                            <div class="col-md-12 nopadding">
                                                <div class="category-engineer">
                                                    <div class="category-engineer-content">
                                                        <div class="engineer-avatar">
                                                            <?php
                                                            if(isset($row['spProfilePic'])){
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src=' ".($row['spProfilePic'])."' >" ;
                                                            }else{
                                                                echo "<img  alt='Posting Pic' class='img-responsive center-block' src='../img/default-profile.png' >" ;
                                                            }
                                                            ?>
                                                            <h3 class="engineer-name"><?php echo $row['spProfileName'];?></h3>
                                                            <p class="engineer-designation"><?php echo $ProjectName;?></p>
                                                        </div>
                                                        <div class="col-xs-12 engineer-details">
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate</span><span class="red pull-right">$<?php echo $perhour;?>/hr</span></div>
                                                            <div class="col-xs-12 nopadding"><span class="black pull-left">Location</span><span class="red pull-right"><?php echo $row['spProfilesCountry'];?></span></div>
                                                            <div class="col-xs-12 specialities">
                                                                <?php
                                                                $i = 1;
                                                                if($skill != ''){
                                                                    foreach($skill as $key => $value){
                                                                        if($i <= 5){
                                                                            echo "<span>".$value."</span>";
                                                                        }
                                                                        $i++;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <a href="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$row['idspProfiles'];?>" class="btn engineer-view-profile">View Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 browse-projects">
                <h2 class="browse-projects-heading">Browse Open <span>Projects</span></h2>
                <div class="container text-center">
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=1';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/web_developers.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">Web Developers</h4>
                        </div>
                    </a>
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=2';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/mobile_developers.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">Mobile Developers</h4>
                        </div>
                    </a>
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=3';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/designers_creatives.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">Designers Creatives</h4>
                        </div>
                    </a>
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=4';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/writers.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">Writers</h4>
                        </div>
                    </a>
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=5';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/customer_service.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">customer service agents</h4>
                        </div>
                    </a>
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=6';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/sales_marketing.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">Sales & marketing experts</h4>
                        </div>
                    </a>
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=7';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/account-consultants.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">accountant & consultants</h4>
                        </div>
                    </a>
                    <a href="<?php echo $BaseUrl.'/freelancer/category.php?pro=8';?>">
                        <div class="col-xs-12 col-sm-3 browse-projects-content">
                            <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/admin_suppot.png" class="img-responsive center-block">
                            <h4 class="browse-projects-content-h4">admin support</h4>
                        </div>
                    </a>
                    <a href="javascript:void(0);" class="btn see-all-category">See All Categories</a>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
