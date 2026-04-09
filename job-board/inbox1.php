<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="job-board/";
    include_once ("../authentication/check.php");
    
}else{
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
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
    	<?php
        //session_start();
        include_once("../header.php");
        ?>
        <section class="main_box" id="freelancers-page">
            <div class="container nopadding projectslist dashboardInbox">
                <div class="col-xs-12 col-sm-3 ">
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
                    <div class="col-xs-12 nopadding ">
                        <div class="panel panel-default">
                            <div class="panel-heading"><i class="fa fa-comments"></i> INBOX</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped all_inbox table-hover freelanceconversation">
                                        <tbody>
                                            <?php  include('load_chat.php'); ?>
                                        </tbody>                    
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        <!-- load Chat -->
                        <div class="chattingsystem m_btm_20" style="max-height: 650px;height: auto;min-height: 250px;">
                            <div class="show_loader"></div>
                            <div id="message_box"></div>
                        </div>
                        <!-- END -->
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
} ?>