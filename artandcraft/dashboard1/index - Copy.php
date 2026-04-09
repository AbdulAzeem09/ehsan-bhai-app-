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

    // background color
    
    
    $als = new _allSetting;
    $query = $als->showBanner(20);
    if ($query) {
        $row = mysqli_fetch_assoc($query);
        $home_banner = $row['spSettingBanner'];
    }
    // get color code of store
    $query2 = $als->showBanner(1);
    if ($query2) {
        $row2 = mysqli_fetch_assoc($query2);
        $store_clr = $row2['spSettingMainClr'];
        $store_btn_clr = $row2['spSettingBtnClr'];
    }
    //FREELANCE COLOR
    $query3 = $als->showBanner(5);
    if ($query3) {
        $row3 = mysqli_fetch_assoc($query3);
        $freelance_clr = $row3['spSettingMainClr'];
    }
    //JOB BOARD COLOR
    $query4 = $als->showBanner(2);
    if ($query4) {
        $row4 = mysqli_fetch_assoc($query4);
        $jobboard_clr = $row4['spSettingMainClr'];
    }
     //REAL ESTATE COLOR
    $query5 = $als->showBanner(3);
    if ($query5) {
        $row5 = mysqli_fetch_assoc($query5);
        $realEstate_clr = $row5['spSettingMainClr'];
    }
    // EVENTS COLOR
    $query6 = $als->showBanner(9);
    if ($query6) {
        $row6 = mysqli_fetch_assoc($query6);
        $event_clr = $row6['spSettingMainClr'];
    }
    // ART GALLERY COLOR
    $query7 = $als->showBanner(13);
    if ($query7) {
        $row7 = mysqli_fetch_assoc($query7);
        $photo_clr = $row7['spSettingMainClr'];
    }
    // MUSIC COLOR
    $query8 = $als->showBanner(14);
    if ($query8) {
        $row8 = mysqli_fetch_assoc($query8);
        $music_clr = $row8['spSettingMainClr'];
    }
    // VIDEOS COLOR
    $query9 = $als->showBanner(10);
    if ($query9) {
        $row9 = mysqli_fetch_assoc($query9);
        $videos_clr = $row9['spSettingMainClr'];
    }
    // TRAININGS COLOR
    $query10 = $als->showBanner(8);
    if ($query10) {
        $row10 = mysqli_fetch_assoc($query10);
        $train_clr = $row10['spSettingMainClr'];
    }
    // CLASIFIED ADD COLOR
    $query11 = $als->showBanner(7);
    if ($query11) {
        $row11 = mysqli_fetch_assoc($query11);
        $clasifiedAdd_clr = $row11['spSettingMainClr'];
    }
    // BUSINESS DIRECTORY ADD COLOR
    $query12 = $als->showBanner(19);
    if ($query12) {
        $row12 = mysqli_fetch_assoc($query12);
        $busDirctry_clr = $row12['spSettingMainClr'];
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/admin/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/admin/css/dashboard.css">

        

          
        <style type="text/css">
            .bg_store{
                background-color: <?php echo $store_clr; ?>;
            }
            .bg_freelance{
                background-color: <?php echo $freelance_clr; ?>;
            }
            .bg_jobboard{
                background-color: <?php echo $jobboard_clr; ?>;
            }
            .bg_realestate{
                background-color: <?php echo $realEstate_clr; ?>;
            }
            .bg_events{
                background-color: <?php echo $event_clr; ?>;
            }
            .bg_artgallery{
                background-color: <?php echo $photo_clr; ?>;
            }
            .bg_music{
                background-color: <?php echo $music_clr; ?>;
            }
            .bg_video{
                background-color: <?php echo $videos_clr; ?>;
            }
            .bg_training{
                background-color: <?php echo $train_clr; ?>;
            }
            .bg_clasifidedads{
                background-color: <?php echo $busDirctry_clr; ?>;
            }
            .bg_business{
                background-color: <?php echo $clasifiedAdd_clr; ?>;
            }
            .bg_groups{
                background-color: <?php echo $busDirctry_clr; ?>;
            }
        </style>
        <script type="text/javascript">
            
        </script>
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <div class="leftDashboard">
                            <div class="userProfile">
                                <img src="../img/noman.png" class="img-responsive">
                                <a href="javascript:void(0)">Marina</a>
                                <p>Business Profile</p>
                            </div>
                            <h2>Main Menu</h2>

                            <ul>
                                <li><a href="<?php echo $BaseUrl.'/timeline';?>">Timeline</a></li>
                                <li><a href="<?php echo $BaseUrl.'/dashboard';?>">Dashboard</a></li>
                                <li><a href="javascript:void(0)">All Modules</a></li>
                            </ul>





                        </div>

                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Dashboard<small>Control panel</small></h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Dashboard</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-default">
                                            <div class="panel-heading"><a href=""><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">My Store</h3></a></div>
                                            <div class="panel-body">
                                                <div align="center"><span style="color:gray">Total Posts </span><span style="font-size:40px;"></span></div>
                                                <hr>
                                                <div id="container"></div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-md-8">
                                        <?php
                                        
                                        $p = new _postingview;
                                        // ==============================================
                                        // store
                                        $t_store = 0; 
                                        $result = $p->myStoreProduct($_SESSION['pid']);
                                        if ($result) {
                                            $t_store = $result->num_rows;
                                        }else{
                                            $t_store = 0;
                                        }
                                        // freelancer
                                        $t_freelance = "";
                                        $result2 = $p->publicpost_all_post(5);
                                        //echo $p->ta->sql;
                                        if ($result2) {
                                            $t_freelance = $result2->num_rows;
                                        }else{
                                            $dat_freelancesh = 0;
                                        }
                                        // JOB BOARD
                                        $t_job = "";
                                        $result3 = $p->myAllJobsPosted(2, $_SESSION['pid']);
                                        //echo $p->ta->sql;
                                        if($result3){
                                            $t_job = $result3->num_rows;
                                        }else{
                                            $t_job = 0;
                                        }
                                        // REAL ESTATE
                                        $t_real = "";
                                        $type = "Sell";
                                        $result4 = $p->myAllSellReal(3, $_SESSION['pid'], $type);
                                        if ($result4) {
                                            $t_real =  $result4->num_rows;
                                        }else{
                                            $t_real = 0;
                                        }
                                        // EVENTS
                                        $t_events = "";
                                        $result5 = $p->publicpost_event(9);
                                        if ($result5) {
                                            $t_events =  $result5->num_rows;
                                        }else{
                                            $t_events = 0;
                                        }
                                        // ART GALLERY
                                        $t_art = "";
                                        $result6 = $p->singleFriendProduct($_SESSION['pid'], 13);
                                        if ($result6) {
                                            $t_art = $result6->num_rows;
                                        }else{
                                            $t_art = 0;
                                        }
                                        // Music
                                        $t_music = 0; 
                                        $result7 = $p->myAllSongs($_SESSION['pid'], 14);
                                        if ($result7) {
                                            $t_music = $result7->num_rows;
                                        }else{
                                            $t_music = 0;
                                        }
                                        // VIDEOS
                                        $t_video = 0; 
                                        $result8 = $p->myAllSongs($_SESSION['pid'], 10);
                                        if ($result8) {
                                            $t_video = $result8->num_rows;
                                        }else{
                                            $t_video = 0;
                                        }
                                        // TRAINING
                                        $t_training = 0; 
                                        $result9 = $p->myAllSongs($_SESSION['pid'], 8);
                                        if ($result9) {
                                            $t_training = $result9->num_rows;
                                        }else{
                                            $t_training = 0;
                                        }
                                        // CLASSIFIED ADS
                                        $t_clasified = 0; 
                                        $result10 = $p->myposted_service(7, $_SESSION['pid']);
                                        if ($result10) {
                                            $t_clasified = $result10->num_rows;
                                        }else{
                                            $t_clasified = 0;
                                        }
                                        // GROUPS
                                        $g = new _spgroup;
                                        $t_groups = "";
                                        $result11 = $g->groupmember($_SESSION['uid']);
                                        if($result11){
                                            $t_groups = $result11->num_rows;
                                        }else{
                                            $t_groups = 0;
                                        }







                                        ?>
                                        <div class="row">
                                            <!-- right side show icon -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_store">
                                                    <div class="inner">
                                                      <h3><?php echo $t_store; ?></h3>
                                                      <p>Stores</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="ion ion-bag"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/store';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_freelance">
                                                    <div class="inner">
                                                      <h3><?php echo $t_freelance; ?></h3>
                                                      <p>Freelancer</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-user-circle"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/freelancer';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_jobboard">
                                                    <div class="inner">
                                                      <h3><?php echo $t_job; ?></h3>
                                                      <p>Job Board</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-book"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/job-board';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_realestate">
                                                    <div class="inner">
                                                      <h3><?php echo $t_real; ?></h3>
                                                      <p>Real Estate</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-home"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/real-estate';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_events">
                                                    <div class="inner">
                                                      <h3><?php echo $t_events; ?></h3>
                                                      <p>Events</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/events';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_artgallery">
                                                    <div class="inner">
                                                      <h3><?php echo $t_art; ?></h3>
                                                      <p>Art Gallery</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-camera"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/photos';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_music">
                                                    <div class="inner">
                                                      <h3><?php echo $t_music; ?></h3>
                                                      <p>Music</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-music"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/music';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_video">
                                                    <div class="inner">
                                                      <h3><?php echo $t_video; ?></h3>
                                                      <p>Video</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-video-camera"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/videos';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_training">
                                                    <div class="inner">
                                                      <h3><?php echo $t_training; ?></h3>
                                                      <p>Training</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-transgender-alt"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/trainings';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_clasifidedads">
                                                    <div class="inner">
                                                      <h3><?php echo $t_clasified; ?></h3>
                                                      <p>Classified Ads</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-bell-o"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/services';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_business">
                                                    <div class="inner">
                                                      <h3>0</h3>
                                                      <p>Directory Seervices</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-tag"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/business-directory';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-lg-3 col-xs-6">
                                                <!-- small box -->
                                                <div class="small-box bg_groups">
                                                    <div class="inner">
                                                      <h3><?php echo $t_groups; ?></h3>
                                                      <p>Groups</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-users"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/my-groups';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->


                                        </div>
                                    </div>
                                    
                                    

                                  </div><!-- /.row -->
                            </div>


                        
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

        <script src="http://code.highcharts.com/highcharts.js"></script>
        <?php include('../component/footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../component/btm_script.php'); ?>
    </body>	
</html>