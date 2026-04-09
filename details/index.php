<?php
    require_once("../univ/baseurl.php" );
     session_start();
     function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin'] = "../my-profile/";
    }

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/AdminLTE.min.css">
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END-->
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../header.php");
        ?>

        <section class="landing_page">
            <div class="container pubpost">

                <div id="sidebar" class="col-md-2 no-padding">
                    <?php include('../component/left-landing.php');?>
                </div>
                <div class="col-md-7" >
                    <div class="row m_top_10" style="">
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <?php
                                    $g = new _spgroup;
                                    $res = $g->readGroup($_SESSION['pid']);
                                    if ($res != false) {
                                        $total = $res->num_rows;
                                        
                                    }
                                    ?>
                                  <h3><?php echo ($total == 0 ? "NO DATA" : $total); ?></h3>
                                  <p>Groups</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-globe"></i>
                                </div>
                                <a href="<?php echo $BaseUrl.'/my-groups';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4 no-padding">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <?php 
                                        include("friends.php");
                                         ?>
                                  <h3><?php if (isset($i)) { echo ($i == 0 ? "NO DATA" : $i); } ?></h3>
                                  <p>Friends</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-users"></i>
                                </div>
                                <a href="<?php echo $BaseUrl.'/my-friend';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <?php
                                    $p = new _spprofiles;
                                    $rpvt = $p->readProfiles($_SESSION["uid"]);
                                    if ($rpvt != false) {
                                        $total = $rpvt->num_rows;
                                    }else{
                                        echo $total = 0;
                                    }
                                    ?>
                                  <h3><?php echo $total; ?></h3>
                                  <p>Profiles</p>
                                </div>
                                <div class="icon">
                                  <i class="fa fa-globe"></i>
                                </div>
                                <a href="<?php echo $BaseUrl.'/my-profile';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>



                        <div class="col-md-12">

                                    <?php
                                    $p = new _postingview;
                                    $res = $p->countPosts($_SESSION['uid']);
                                    $sum = 0;
                                    if ($res != false) {
                                        while ($row = mysqli_fetch_assoc($res)) {//My Store
                                            $sum += $row['count'];
                                        }
                                    }

                                    $res = $p->soldpost($_SESSION['uid']);
                                    if ($res != false) {//Executed
                                        $executed = $res->num_rows;
                                    } else {
                                        $executed = 0;
                                    }

                                    $res = $p->activepost($_SESSION['uid']);
                                    if ($res != false) {//Active
                                        $active = $res->num_rows;
                                    } else {
                                        $active = 0;
                                    }

                                    $res = $p->expiredpost($_SESSION['uid']);
                                    if ($res != false) {//Expired
                                        $expired = $res->num_rows;
                                    } else {
                                        $expired = 0;
                                    }
                                    $total = $executed + $active + $expired;


                                    $res = $p->myfavoritepost($_SESSION['uid']);
                                    $favorite = 0;
                                    if ($res != false) {
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            $favorite += $row['count'];
                                        }
                                    }
                                    ?>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a href="../my-store/"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">My Store</h3></a></div>
                                <div class="panel-body">
                                    <div align="center"><span style="color:gray">Total Posts </span><span style="font-size:40px;"><?php echo $sum; ?></span></div>
                                    <hr>
                                    <div id="container"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 no-padding">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a href="../favorite/"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">My Favorites</h3></a></div>
                                <div class="panel-body">
                                    <div align="center"><span style="color:gray">Total Favorites </span><span style="font-size:40px;"><?php echo $favorite; ?></span></div>
                                    <hr>
                                    <div id="favoritecontainer"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a href="../my-posts/"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">My Posts</h3></a></div>
                                <div class="panel-body">
                                    <div align="center"><span style="color:gray">Total </span><span style="font-size:40px;"><?php echo $total; ?></span></div>
                                    <hr>
                                    <div id="mypostcontainer"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                
                        </div><!--Row 10-->
            
                    </div>

                </div>
                <div id="sidebar_right" class="col-md-3 no-padding" style="left: auto" >
                    <?php include('../component/right-landing.php');?>
                </div>
            </div>
        </section>



        <script src="http://code.highcharts.com/highcharts.js"></script>
    <script src="/assets/js/home.js"></script>

        <?php include('../component/footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../component/btm_script.php'); ?>
    </body>	
</html>