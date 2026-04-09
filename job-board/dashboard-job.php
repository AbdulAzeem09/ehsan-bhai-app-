<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 1;
     //check profile is job board or not
    if($_SESSION['ptid'] != 5){
		
        header('location:'.$BaseUrl.'/job-board/?msg=notaccesss');
    }

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
    </head>

    <body class="bg_gray">
        <?php
        include_once("../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 no-padding">
                        <?php 
                        include('../component/left-jobboard.php');
                        include('left-btm-jobseakr.php');
                        ?>
                        
                    </div>
                    <div class="col-md-9">
                        <?php 
                        include('top-job-search.php');
                        include('inner-breadcrumb.php');
                        ?>
                        
                        
                        <div class="whiteboardmain top_job_head">
                            <h2>What can you do next ?</h2>
                            <div class="space"></div>
                            <p>Search for jobs and create alerts for them.</p>
                            <p>Invite your friends to join and grow your Rozee network.</p>
                            <p>Follow companies to stay updated on their latest job openings.</p>
                            <p>Don't forget - a complete profile always attracts more employers</p>
                            <div class="space-lg"></div>
                            <div class="space"></div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
        
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
