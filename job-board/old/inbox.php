<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    $activePage = 9;

    $header_jobBoard = "header_jobBoard";
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardInbox">
                <div class="col-xs-12 col-sm-3 leftsidebar">
                    <?php 
                    include('../component/left-jobboard.php');
                    if($_SESSION['ptid'] == 5){
                        include('left-btm-jobseakr.php');
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php 
                        include('top-job-search.php');
                        include('inner-breadcrumb.php');
                    ?>
                    <div class="col-xs-12 nopadding dashboard-inbox-section">
                        <div class="col-xs-12 col-sm-4 inbox-peoples" id="inbox-job">
                            <div class="col-sm-12 nopadding">
                                <h2 class="">Inbox</h2>
                            </div>
                            <div class="space"></div>
                            <div class="col-xs-12 nopadding" id="">
                                
                                <?php 
                                include('load_chat.php');
                                ?>
                                
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8 chat-box nopadding chattingsystem">
                            <div class="col-xs-12 nopadding topbar">
                                
                            </div>
                            <div class="col-xs-12 message-area" id="jobChatHead">
                                <div id="message_box"></div>

                            </div>
                            
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
