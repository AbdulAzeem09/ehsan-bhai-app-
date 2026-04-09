<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

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
        
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="col-xs-12 category_selected_banner text-center">
                <h1 class="category_name">All <span>Freelancer</span></h1>
                <p class="choose_among">Choose among top mobile engineers & designers</p>
                
            </div>
            <div class="col-xs-12 category_tabs">
                <div class="container">
                    <div class="row">
                        <div class="resp-tabs-container" style="border-top: 0px;">
                            <div class="col-md-12 nopadding">
                                <?php
                               
                                $result = $f->freelancers($_SESSION['uid']);
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
             <?php include('btm-category.php'); ?>
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
