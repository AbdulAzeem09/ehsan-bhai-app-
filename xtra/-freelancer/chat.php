<?php 
    include('../univ/baseurl.php');
    session_start();
    
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
        //session_start();
        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");
        $header_select = "freelancers";
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardInbox">
                <div class="col-xs-12 col-sm-3 leftsidebar">
                    <?php include('../component/left-freelancer.php');?>
                </div>
                <div class="col-xs-12 col-sm-9 nopadding">
                    <?php include('top-banner-freelancer.php');?>
                    <div class="col-xs-12 nopadding dashboard-inbox-section">
                        <div class="col-xs-12 col-sm-4 inbox-peoples">
                            <div class="col-md-12 nopadding">
                                <h2 class="">Inbox</h2>
                            </div>
                            <div class="space"></div>
                            <div class="col-xs-12 nopadding">
                                
                                <?php 
                                include('freelance_chat.php');
                                ?>
                                
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8 chat-box nopadding chattingsystem">
                            <div class="col-xs-12 nopadding topbar">
                                <div class="">
                                    <p class="username">User Conversation</p>
                                </div>
                                
                            </div>
                            <div class="col-xs-12 message-area">
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
