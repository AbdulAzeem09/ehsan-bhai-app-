<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        
    </head>

    <body class="bg_gray">
        <?php
        include_once("../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php include('../component/left-jobboard.php');?>
                    </div>
                    <div class="col-md-9 no-padding">
                        <?php include('top-job-search.php');?>
                        <div class="row no-margin" style="margin: 10px 0px; border: 1px solid #CCC;">
                            <div class="dashboard-section">
                                <div class="col-xs-12 bg_white no-padding">
                                    <div class="">
                                        <ul class="myjobboaardBread no-margin">
                                            <li><a href="#">Dashboard</a></li>
                                            <li><span>|</span></li>
                                            <li><a href="#">Manage Jobs</a></li>
                                            <li><span>|</span></li>
                                            <li><a href="#">Active( 1 )</a></li>
                                            <li><span>|</span></li>
                                            <li><a href="#">Deactivated ( 16 )</a></li>
                                            <li><span>|</span></li>
                                            <li><a href="#">Draft ( 16 )</a></li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- repeat able box -->
                        <div class="whiteboardmain m_top_10">
                            <div class="row no-margin">
                                <div class="col-xs-12 whiteboardmain" style="padding: 15px;">
                                    <div class="row top_job_head">
                                        <div class="col-md-4">
                                            <h2>Android Developer - Lahore </h2>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <h2>Jun 01, 2017 </h2>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <h2 class="clr_red">Deactivated</h2>
                                        </div>
                                        <div class="col-sm-12">
                                            <h1>Offered salary: 30K - 35K</h1>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                            <div class="wizard">
                                                <div class="wizard-inner">
                                                    <div class="connecting-line"></div>
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li role="presentation">
                                                            <a href="" >
                                                                <span class="round-tab tab_blue">
                                                                    314
                                                                </span>
                                                            </a>
                                                            <p>Applied</p>
                                                        </li>
                                                        <li role="presentation" >
                                                            
                                                        </li>
                                                        <li role="presentation" >
                                                            
                                                        </li>
                                                        <li role="presentation" >
                                                            <a href="#">
                                                                <span class="round-tab tab_orange">
                                                                    15
                                                                </span>
                                                            </a>
                                                            <p>Interviews</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>                                
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="footer_job">
                                            <div class="row">
                                                
                                                <div class="col-md-2">
                                                    <a href="#"><i class="fa fa-plus"></i> Upgrade</a>
                                                </div>
                                                <div class="col-md-2">
                                                    <a href="#"><i class="fa fa-times"></i> Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- repeat able box end -->
                        

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
