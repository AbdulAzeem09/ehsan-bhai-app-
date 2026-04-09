<?php
    require_once("../univ/baseurl.php" );
     session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "dashboard/";
    include_once ("../authentication/check.php");
    
}else{
     function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
   
    $pageactive = 2;
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
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- custom page script -->
        <?php include('../component/dashboard-link.php'); ?>

        <script src="<?php echo $BaseUrl; ?>/assets/admin/js/mainchart.js"></script>
        <link href="http://api.highcharts.com/highcharts">
          
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
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
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
                        <?php include('../component/left-dashboard.php'); ?>

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
                                    
                                    <div class="col-md-12">
                                        <?php
                                        
                                        $p = new _postingview;
                                        // ==============================================
                                        // store
                                        $t_store = 0; 
                                        $result = $p->myStoreProduct($_SESSION['pid']);
                                        //echo $p->ta->sql;
                                        if ($result) {
                                            $t_store = $result->num_rows;
                                        }
                                        // freelancer
                                        $t_freelance = 0;
                                        $result2 = $p->readMyAllProfileProduct(5, $_SESSION['pid']);
                                        //echo $p->ta->sql;
                                        if ($result2) {
                                            $t_freelance = $result2->num_rows;
                                        }
                                        // JOB BOARD
                                        $t_job = 0;
                                        $result3 = $p->myAllJobsPosted(2, $_SESSION['pid']);
                                        //echo $p->ta->sql;
                                        if($result3){
                                            $t_job = $result3->num_rows;
                                        }
                                        // REAL ESTATE
                                        $t_real = 0;
                                        $type = "Sell";
                                        $result4 = $p->readMyAllProfileProduct(3, $_SESSION['pid']);
                                        if ($result4) {
                                            $t_real =  $result4->num_rows;
                                        }
                                        // EVENTS
                                        $t_events = 0;
                                        $result5 = $p->publicpost_event(9);
                                        if ($result5) {
                                            $t_events =  $result5->num_rows;
                                        }
                                        // ART GALLERY
                                        $t_art = 0;
                                        $result6 = $p->readMyAllProfileProduct(13, $_SESSION['pid']);
                                        if ($result6) {
                                            $t_art = $result6->num_rows;
                                        }
                                        // Music
                                        $t_music = 0; 
                                        $result7 = $p->readMyAllProfileProduct(14, $_SESSION['pid']);
                                        if ($result7) {
                                            $t_music = $result7->num_rows;
                                        }
                                        // VIDEOS
                                        $t_video = 0; 
                                        $result8 = $p->readMyAllProfileProduct(10, $_SESSION['pid']);
                                        if ($result8) {
                                            $t_video = $result8->num_rows;
                                        }
                                        // TRAINING
                                        $t_training = 0; 
                                        $result9 = $p->readMyAllProfileProduct(8, $_SESSION['pid']);
                                        if ($result9) {
                                            $t_training = $result9->num_rows;
                                        }
                                        // CLASSIFIED ADS
                                        $t_clasified = 0; 
                                        $result10 = $p->readMyAllProfileProduct(7, $_SESSION['pid']);
                                        if ($result10) {
                                            $t_clasified = $result10->num_rows;
                                        }
                                        // GROUPS
                                        $g = new _spgroup;
                                        $t_groups = 0;
                                        $result11 = $g->groupmember($_SESSION['uid']);
                                        if($result11){
                                            $t_groups = $result11->num_rows;
                                        }


                                        // GROUPS
                                        $et = new _spevent_transection;
                                        $t_eventtotalearn = 0;
                                        $result12 = $et->readeventtransection($_SESSION['uid']);

                                        //print_r($result12);



                                        //echo $et->ta->sql;

                                        if($result12){

                                            while ($row = mysqli_fetch_assoc($result12)) {


                                                $t_eventtotalearn += $row['payment_gross'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }

                                        
                                      $wt = new _spwithdraw;
                                       
                                        $result13 = $wt->withdrawreadevent($_SESSION['uid']);

                                        //print_r($result12);



                                        //echo $et->ta->sql;

                                        if($result13){

                                            while ($row2 = mysqli_fetch_assoc($result13)) {


                                                $withdraw_amount += $row2['withdraw_amount'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }
                                       
                                       $total_balance = $t_eventtotalearn - $withdraw_amount;

                                        //print_r($total_balance);
                                       



                                        ?>
                                        <div class="row">
                                        <!--     <div class="col-md-2">
                                                <div class="small-box bg-aqua">
                                                    <div class="inner">
                                                      <h3>0</h3>
                                                      <p>Total Point Earned</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div> -->

                                      <!--       <div class="col-md-2">
                                                <div class="small-box bg-green">
                                                    <div class="inner">
                                                        <?php
                                                        $sp = new _orderSuccess; 
                                                        $result13 = $sp->readlastBlnc($_SESSION['pid']);
                                                        if ($result13) {
                                                            $row13 = mysqli_fetch_assoc($result13);
                                                            echo "<h3>".$row13['pointAmount']."</h3>";
                                                        }else{
                                                            echo "<h3>0</h3>";
                                                        }
                                                        ?>
                                                        <p>Sp Points</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </div>
                                                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div> -->
                                            <!-- right side show icon -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_store">
                                                    <div class="inner">
                                                      <h3><?php echo $t_store; ?></h3>
                                                      <p>Store</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-shopping-cart"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/store';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_freelance">
                                                    <div class="inner">
                                                      <h3><?php echo $t_freelance; ?></h3>
                                                      <p>Freelancer</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa fa-user-circle"></i>
                                                    </div>
                                                    <!-- <a href="<?php echo $BaseUrl.'/freelancer';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                                                    <a href="<?php echo $BaseUrl.'/freelancer/coming_freelancer.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_jobboard">
                                                    <div class="inner">
                                                      <h3><?php echo $t_job; ?></h3>
                                                      <p>Job Board</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-book"></i>
                                                    </div>
                                                  <!--   <a href="<?php echo $BaseUrl.'/job-board';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                                                    <a href="<?php echo $BaseUrl.'/job-board/coming_jobboard.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_realestate">
                                                    <div class="inner">
                                                      <h3><?php echo $t_real; ?></h3>
                                                      <p>Real Estate</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-home"></i>
                                                    </div>
                                                    <!-- <a href="<?php echo $BaseUrl.'/real-estate';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                                                    <a href="<?php echo $BaseUrl.'/real-estate/coming_real.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_events">
                                                    <div class="inner">
                                                      <h3><?php echo $t_events; ?></h3>
                                                      <p>Events</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <!-- <a href="<?php echo $BaseUrl.'/events';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->

                                                    <a href="<?php echo $BaseUrl.'/events/coming_events.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>


                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_artgallery">
                                                    <div class="inner">
                                                      <h3><?php echo $t_art; ?></h3>
                                                      <p>Art Gallery</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-camera"></i>
                                                    </div>
                                                   <!--  <a href="<?php echo $BaseUrl.'/photos';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->

                                                   <a href="<?php echo $BaseUrl.'/photos/coming_photos.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_music">
                                                    <div class="inner">
                                                      <h3><?php echo $t_music; ?></h3>
                                                      <p>Music</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-music"></i>
                                                    </div>
                                                    <!-- <a href="<?php echo $BaseUrl.'/music';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
                                                    <a href="<?php echo $BaseUrl.'/music/coming_music.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_video">
                                                    <div class="inner">
                                                      <h3><?php echo $t_video; ?></h3>
                                                      <p>Video</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-video-camera"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/videos/coming_videos.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                            <div class="col-md-2">
                                                <!-- small box -->
                                                <div class="small-box bg_training">
                                                    <div class="inner">
                                                      <h3><?php echo $t_training; ?></h3>
                                                      <p>Training</p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-transgender-alt"></i>
                                                    </div>
                                                    <a href="<?php echo $BaseUrl.'/trainings/coming_trainings.php';?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div><!-- ./col -->
                                           <!--  <div class="col-md-2">
                                               
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
                                            </div> -->
                                            
                                            <!-- <div class="col-md-2">
                                                
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
                                            </div> -->

                                         <!--     <div class="col-md-2">
                                                
                                                <div class="small-box" style="background-color: #90EE90;">
                                                    <div class="inner">
                                                      <h3>$<?php  if($total_balance > 0 ){ echo $total_balance; }else{ echo "0" ; } ?></h3>
                                                      <p>Event Total Earning </p>
                                                    </div>
                                                    <div class="icon">
                                                      <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div> -->


                                        </div>
                                        <div class="row">
                                           <!--  <div class="col-md-6">
                                                
                                                <div class="box box-warning direct-chat direct-chat-warning">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title">All Module (%)</h3>
                                                        
                                                    </div>
                                                    <div class="box-body" style="min-height: 74px;">
                                                        <div id="allmodule"></div>
                                                    </div>
                                                </div>
                                            </div> -->
                                       

                            <!--                 <div class="col-md-6">
                                                
                                                <div class="box box-primary">
                                                    <div class="box-header">
                                                        <i class="fa fa-clipboard"></i>
                                                        <h3 class="box-title">Sticky Notes</h3>
                                                      
                                                    </div>
                                                    <div class="box-body">
                                                        <ul class="todo-list">
                                                            <?php
                                                                $i =1;
                                                                $limit = 6;
                                                                $p = new _spAllStoreForm;
                                                                $result12 = $p->readStickyLimit($_SESSION['pid'], $limit);
                                                              
                                                                if ($result12) {
                                                                    while ($row12 = mysqli_Fetch_assoc($result12)) {
                                                                        ?>
                                                                        <li>
                                                                           
                                                                            <span class="handle">
                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                            </span>
                                                                         
                                                                          
                                                                            <span class="text"><?php echo $row12['spStickyTitle']; ?></span>
                                                                            
                                                                            <div class="tools">
                                                                                <a href="<?php echo $BaseUrl.'/dashboard/sticky/detail.php?id='.$row12['idspSticky'];?>" data-original-title="view" data-toggle="tooltip" data-placement="top" class="vd_green"> <i class="fa fa-eye"></i> </a> 
                                                                                <a href="<?php echo $BaseUrl.'/dashboard/sticky/modify.php?id='.$row12['idspSticky'];?>" data-original-title="edit" data-toggle="tooltip" data-placement="top" class="vd_yellow"> <i class="fa fa-pencil"></i> </a> 
                                                                                <a href="<?php echo $BaseUrl.'/dashboard/sticky/proSticy.php?action=delete&id='.$row12['idspSticky'];?>" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="vd_red"> <i class="fa fa-times"></i> </a>
                                                                                

                                                                            </div>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            

                                                        </ul>
                                                    </div>
                                                    <div class="box-footer clearfix no-border">
                                                        <a href="<?php echo $BaseUrl.'/dashboard/sticky/add.php';?>" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add Sticky Notes</a>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div> -->
                                        </div>
                                    </div>
                                    
                                    

                                </div><!-- /.row -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#dash-store">Store</a></li>
                                    <!-- <li><a data-toggle="tab" href="#dash-freelance">Freelancer</a></li>
                                    <li><a data-toggle="tab" href="#dash-job">Job Board</a></li>
                                    <li><a data-toggle="tab" href="#dash-realestate">Real Estate</a></li>
                                    <li><a data-toggle="tab" href="#dash-event">Events</a></li>
                                    <li><a data-toggle="tab" href="#dash-gallery">Art Gallery</a></li>
                                    <li><a data-toggle="tab" href="#dash-music">Music</a></li>
                                    <li><a data-toggle="tab" href="#dash-video">Videos</a></li>
                                    <li><a data-toggle="tab" href="#dash-training">Training</a></li>
                                    <li><a data-toggle="tab" href="#dash-ads">Classified Ads</a></li> -->
                                </ul>

                                <div class="tab-content">
                                    <div id="dash-store" class="tab-pane fade in active">
                                        <div class="" style="padding: 20px 0px;">
                                            <!-- STORE DASHBOARD -->
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <!-- TABLE: LATEST ORDERS -->
                                                    <div class="box box-info">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Store</h3>
                                                            <div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="table-responsive">
                                                                <?php
                                                                $p = new _postingview;
                                                                $pp = new _productposting;
                                                                $en = new _postenquiry;
                                                                $po = new _postings;
                                                                $fps = new _freelance_project_status;
                                                                $atb = new _addtoboard;
                                                                $ag = new _artgalleryenquiry;
                                                                $cl = new _createplaylist;
                                                                $al = new _album;
                                                                $pl = new _addtolyric;


                                                                // ==========TOTAL ACTIVE PRODUCTS
                                                                $str_totActivePro = 0;
                                                                $result = $pp->myStoreProduct($_SESSION['pid']);
                                                                if ($result) {
                                                                    $str_totActivePro = $result->num_rows;
                                                                }

                                                                // ==========TOTAL DE-ACTIVE PRODUCTSS
                                                                $str_totDeActivePro = 0;
                                                                $result2 = $pp->myProductVis($_SESSION['pid'], -2, 1);
                                                                if ($result2) {
                                                                    $str_totDeActivePro = $result2->num_rows;
                                                                }

                                                                // ==========TOTAL DRAFT PRODUCTS
                                                                $str_totalDraft = 0;
                                                                $result3 = $pp->readMyDraftprofile(1,$_SESSION['pid']);
                                                                if ($result3) {
                                                                    $str_totalDraft = $result3->num_rows;
                                                                }

                                                                // =========EXPIRED POST
                                                                $str_totExpirdPro = 0;
                                                                $result4 = $pp->myExpireProduct(1, $_SESSION['pid']);
                                                                if ($result4) {
                                                                    $str_totExpirdPro = $result4->num_rows;
                                                                }

                                                                // =========ENQUIRY
                                                                $str_totalEnquires = 0;
                                                                $result5 = $en->getMyEnquery($_SESSION['pid']);
                                                                if ($result5) {
                                                                    $str_totalEnquires = $result5->num_rows;
                                                                }
                                                                
                                                                // =========FAVOURITE POST
                                                                $str_totFav = 0;
                                                                $result6 = $pp->readallfavrouiteproduct(1,$_SESSION['pid']);
                                                                if ($result6) {
                                                                    $str_totFav = $result6->num_rows;
                                                                }

                                                                // ==========TOTAL FLAGGED PRODUCTS
                                                               /* $str_totalFlag = 0;
                                                                $result7 = $p->myProductVis($_SESSION['pid'], 3, 1);
                                                                if ($result7) {
                                                                    $str_totalFlag = $result7->num_rows;
                                                                }*/

                                                                ?>
                                                                <table class="table table-striped no-margin">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/store/dashboard/active_product.php';?>">Active Products</a></td>
                                                                            <td><span class="label label-success"><?php echo $str_totActivePro; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/store/dashboard/deactive.php';?>">De-activate Products</a></td>
                                                                            <td><span class="label label-info"><?php echo $str_totDeActivePro; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-draft.php';?>">Draft Product</a></td>
                                                                            <td><span class="label label-danger"><?php echo $str_totalDraft; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/store/dashboard/expire.php';?>">Expired Products</a></td>
                                                                            <td><span class="label label-info"><?php echo $str_totExpirdPro; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-enquiry.php';?>">Enquiries</a></td>
                                                                            <td><span class="label label-warning"><?php  echo $str_totalEnquires; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-favourite.php'; ?>">Favourite Product</a></td>
                                                                            <td><span class="label label-warning"><?php echo $str_totFav; ?></span></td>
                                                                        </tr>
                                                                       <!--  <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/store/dashboard/myFlag.php'; ?>">Flagged Posting</a></td>
                                                                            <td><span class="label label-warning"><?php echo $str_totalFlag; ?></span></td>
                                                                        </tr> -->
                                                                                                                                   
                                                                    </tbody>
                                                                </table>
                                                            </div><!-- /.table-responsive -->
                                                        </div><!-- /.box-body -->
                                                        
                                                    </div><!-- /.box -->
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- =======donut chart===== -->
                                                    <div class="nav-tabs-custom">
                                                        <!-- Tabs within a box -->
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-pie-chart"></i> Store Donut Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                            <div class="chart tab-pane active" id="chart-two-store" style="position: relative; height: 292px;">   
                                                            </div>                                        
                                                        </div>
                                                    </div><!-- /.nav-tabs-custom -->
                                                </div>
                                               <!--  <div class="col-md-4">
                                                   
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                          
                                                            <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 286px;">
                                                                <div id="storeBarChrt" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dash-freelance" class="tab-pane fade">
                                        <div style="padding: 20px 0px;">
                                            <div class="row ">
                                                <div class="col-md-4">
                                                    <!-- TABLE: LATEST ORDERS -->
                                                    <div class="box box-info">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Freelancer</h3>
                                                            <div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="table-responsive">
                                                                <?php
                                                               
                                                                // TOTAL ACTIVE PROJECTS
                                                                $fre_totalActive = 0; 
                                                                $result = $p->mycatProduct(5, $_SESSION['pid']);
                                                                if ($result) {
                                                                    $fre_totalActive = $result->num_rows;
                                                                }

                                                                // =========EXPIRE PROJECTS
                                                                $fre_totalExpire = 0;
                                                                $result4 = $p->myExpireProduct(5, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result4) {
                                                                    $fre_totalExpire = $result4->num_rows;
                                                                }

                                                                // ==========DRAFT
                                                                $fre_totalDraft = 0;
                                                                $result3 = $p->readMyDraftprofile(5, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result3) {
                                                                    $fre_totalDraft = $result3->num_rows;
                                                                }

                                                                // =========COMPLETE PROJECTS
                                                                $fre_totCmpPro = 0;
                                                                $res = $po->myCmpPro(5, $_SESSION['pid']);
                                                                if ($res) {
                                                                    $fre_totCmpPro = $res->num_rows;
                                                                }

                                                                // ==========FLAGGED PROJECTS
                                                                $fre_totFlagPost = 0;
                                                                $result5 = $p->myflagPost(5, $_SESSION['pid']);
                                                                if ($result5) {
                                                                    $fre_totFlagPost = $result5->num_rows;
                                                                }

                                                                // ===========active bids
                                                                $fre_totActBid = 0;
                                                                $result2 = $po->client_publicpost(5, $_SESSION['pid']);
                                                                if ($result2) {
                                                                    $fre_totActBid = $result2->num_rows;
                                                                }
                                                                ?>
                                                                <table class="table table-striped no-margin">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active.php'; ?>">Active Projects</a></td>
                                                                            <td><span class="label label-info"><?php echo $fre_totalActive; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/active-bid.php';?>">Active Bids</a></td>
                                                                            <td><span class="label label-warning"><?php  echo $fre_totActBid; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/expire.php'; ?>">Expired Projects</a></td>
                                                                            <td><span class="label label-info"><?php echo $fre_totalExpire; ?></span></td>
                                                                        </tr>
                                                                       
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/draft.php';?>">Draft Projects</a></td>
                                                                            <td><span class="label label-danger"><?php echo $fre_totalDraft; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/complete.php'; ?>">Complete Projects</a></td>
                                                                            <td><span class="label label-danger"><?php echo $fre_totCmpPro; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/freelancer/dashboard/myFlag.php'; ?>">Flagged Projects</a></td>
                                                                            <td><span class="label label-success"><?php echo $fre_totFlagPost; ?></span></td>
                                                                        </tr>                                                                                                          
                                                                    </tbody>
                                                                </table>
                                                            </div><!-- /.table-responsive -->
                                                        </div><!-- /.box-body -->
                                                        
                                                    </div><!-- /.box -->
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- =======donut chart===== -->
                                                    <div class="nav-tabs-custom">
                                                        <!-- Tabs within a box -->
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-pie-chart"></i> Freelance Donut Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                            <div class="chart tab-pane active" id="chart-two-freelance" style="position: relative; height: 292px;">   

                                                            </div>                                        
                                                        </div>
                                                    </div><!-- /.nav-tabs-custom -->
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- Custom tabs (Charts with tabs)-->
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                            <!-- Morris chart - Sales -->
                                                            <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 177px;">
                                                                <div id="freelanceChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.nav-tabs-custom -->
                                                    <!-- solid sales graph -->
                                                </div>
                                            </div><!-- /.row -->
                                        </div>
                                    </div>
                                    <div id="dash-job" class="tab-pane fade">
                                        <div style="padding: 20px 0px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <!-- TABLE: LATEST ORDERS -->
                                                    <div class="box box-info">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Job Board</h3>
                                                            <div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="table-responsive">
                                                                <?php
                                                                
                                                                
                                                                // =========ACTIVE POST
                                                                $job_totalActive = 0;
                                                                $result4 = $p->profileactivepost(2, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result4) {
                                                                    $job_totalActive = $result4->num_rows;
                                                                }

                                                                // =========EXPIRED POST
                                                                $job_totExpPost = 0;
                                                                $result7 = $p->myExpireProduct(2, $_SESSION['pid']);
                                                                if ($result7) {
                                                                    $job_totExpPost = $result7->num_rows;
                                                                }
                                                                
                                                                // ==========DRAFT POST
                                                                $job_totalDraft = 0;
                                                                $result3 = $p->readMyDraftprofile(2, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result3) {
                                                                    $job_totalDraft = $result3->num_rows;
                                                                }
                                                                // =========SAVED POST
                                                                $job_totFav = 0;
                                                                $result5 = $p->mySaveJob(2, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result5) {
                                                                    $job_totFav = $result5->num_rows;
                                                                }

                                                                // =========MY FLAGGED POST
                                                                $job_totFlag = 0;
                                                                $result2 = $p->myflagPost(2, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if($result2){
                                                                    $job_totFlag = $result2->num_rows;
                                                                }
                                                                // =========TRASH POST
                                                                $job_totTrash = 0;
                                                                $result6 = $p->myTrashPost($_SESSION['pid'], -3, 2);
                                                                if($result6){
                                                                    $job_totTrash = $result6->num_rows;
                                                                }

                                                                ?>
                                                                <table class="table table-striped no-margin">
                                                                    <tbody>
                                                                        
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/active-post.php'; ?>">Active Jobs</a></td>
                                                                            <td><span class="label label-info"><?php echo $job_totalActive; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/expired-post.php'; ?>">Expired Jobs</a></td>
                                                                            <td><span class="label label-info"><?php echo $job_totExpPost; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/draft-post.php'; ?>">Draft Jobs</a></td>
                                                                            <td><span class="label label-danger"><?php echo $job_totalDraft; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/saved-post.php'; ?>">Saved Jobs</a></td>
                                                                            <td><span class="label label-warning"><?php echo $job_totFav; ?></span></td>
                                                                        </tr>
                                                                        
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/myFlag.php'; ?>">Flagged Jobs</a></td>
                                                                            <td><span class="label label-warning"><?php echo $job_totFlag; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/job-board/dashboard/trash-post.php'; ?>">Trash Jobs</a></td>
                                                                            <td><span class="label label-warning"><?php echo $job_totTrash; ?></span></td>
                                                                        </tr>                         
                                                                    </tbody>
                                                                </table>
                                                            </div><!-- /.table-responsive -->
                                                        </div><!-- /.box-body -->
                                                        
                                                    </div><!-- /.box -->
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- =======donut chart===== -->
                                                    <div class="nav-tabs-custom">
                                                        <!-- Tabs within a box -->
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-pie-chart"></i> Job Board Donut Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                            <div class="chart tab-pane active" id="chart-two-job" style="position: relative; height: 285px;">   

                                                            </div>                                        
                                                        </div>
                                                    </div><!-- /.nav-tabs-custom -->
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- Custom tabs (Charts with tabs)-->
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                            <!-- Morris chart - Sales -->
                                                            <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 248px;">
                                                                <div id="jobChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div><!-- /.nav-tabs-custom -->
                                                </div>
                                            </div><!-- /.row -->
                                        </div>
                                    </div>
                                    <div id="dash-realestate" class="tab-pane">
                                        <div class="" style="padding: 20px 0px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <!-- TABLE: LATEST ORDERS -->
                                                    <div class="box box-info">
                                                        <div class="box-header with-border">
                                                            <h3 class="box-title">Real Estate</h3>
                                                            <div class="box-tools pull-right">
                                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                                <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                            </div>
                                                        </div><!-- /.box-header -->
                                                        <div class="box-body">
                                                            <div class="table-responsive">
                                                                <?php
                                                               
                                                                // total Products
                                                                $real_totalProducts = 0; 
                                                                $result = $p->mycatProduct(3, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result) {
                                                                    $real_totalProducts = $result->num_rows;
                                                                }
                                                                // =========ACTIVE POST
                                                                $real_totalActive = 0;
                                                                $type = "Sell";
                                                                $result4 = $p->myAllSellReal(3, $_SESSION['pid'], $type);
                                                                //$result4 = $p->profileactivepost($_GET["categoryid"], $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result4) {
                                                                    $real_totalActive = $result4->num_rows;
                                                                }
                                                                
                                                                // ==========DRAFT
                                                                $real_totalDraft = 0;
                                                                $result3 = $p->readMyDraftprofile(3, $_SESSION['pid']);
                                                                //echo $p->ta->sql;
                                                                if ($result3) {
                                                                    $real_totalDraft = $result3->num_rows;
                                                                }
                                                                // =========FAVOURITE POST
                                                                $real_totFav = 0;
                                                                $result5 = $p->event_favorite(3, $_SESSION['pid']);
                                                                if ($result5) {
                                                                    $real_totFav = $result5->num_rows;
                                                                }

                                                                // =========RENT ENTIRE PLACE
                                                                $real_rent_entire_place = 0;
                                                                $type2 = "Rent Entire Place";
                                                                $result6 = $p->myAllSellReal(3, $_SESSION['pid'], $type2);
                                                                if ($result6) {
                                                                    $real_rent_entire_place = $result6->num_rows;
                                                                }

                                                                // ========RENT A ROOM
                                                                $real_rentaroom = 0;
                                                                $fieldName = 'Rent';
                                                                $result7 = $p->myDraftJob(3, $_SESSION['pid']);
                                                                if ($result7) {
                                                                    $real_rentaroom = $result7->num_rows;
                                                                }
                                                                // ==========MY ENQUIRY
                                                                $real_myEnquiry = 0;
                                                                $result2 = $p->myEnquery(3, $_SESSION['pid']);
                                                                if ($result2) {
                                                                    $real_myEnquiry = $result2->num_rows;
                                                                }

                                                                // ==========MY FLAG
                                                                $real_myFlag = 0;
                                                                $result8 = $p->myflagPost(3, $_SESSION['pid']);
                                                                if ($result8) {
                                                                    $real_myFlag = $result8->num_rows;
                                                                }

                                                                ?>
                                                                <table class="table table-striped no-margin">
                                                                    <tbody>
                                                                        
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/real-estate/dashboard/active-property.php'; ?>">Active Property</a></td>
                                                                            <td><span class="label label-info"><?php echo $real_totalActive; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/real-estate/dashboard/rent-property.php';?>">Rent Entire Place</a></td>
                                                                            <td><span class="label label-warning"><?php echo $real_rent_entire_place; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/real-estate/dashboard/rent-room.php';?>">Rent Room</a></td>
                                                                            <td><span class="label label-warning"><?php echo $real_rentaroom; ?></span></td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/real-estate/dashboard/draft-property.php';?>">Draft Property</a></td>
                                                                            <td><span class="label label-danger"><?php echo $real_totalDraft; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/real-estate/dashboard/my-enquiry.php';?>">My Enquires</a></td>
                                                                            <td><span class="label label-danger"><?php echo $real_myEnquiry; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/real-estate/dashboard/flag.php';?>">Favourite Listing</a></td>
                                                                            <td><span class="label label-danger"><?php echo $real_totFav; ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><a href="<?php echo $BaseUrl.'/real-estate/dashboard/flag.php'; ?>">Flaged Property</a></td>
                                                                            <td><span class="label label-warning"><?php echo $real_myFlag; ?></span></td>
                                                                        </tr>
                                                                        
                                                                                                             
                                                                    </tbody>
                                                                </table>
                                                            </div><!-- /.table-responsive -->
                                                        </div><!-- /.box-body -->
                                                        
                                                    </div><!-- /.box -->
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- =======donut chart===== -->
                                                    <div class="nav-tabs-custom">
                                                        <!-- Tabs within a box -->
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                            <div class="chart tab-pane active" id="chart-two-real" style="position: relative; height: 287px;">   

                                                            </div>                                        
                                                        </div>
                                                    </div><!-- /.nav-tabs-custom -->
                                                </div>
                                                <div class="col-md-4">
                                                    <!-- Custom tabs (Charts with tabs)-->
                                                    <div class="nav-tabs-custom">
                                                        <ul class="nav nav-tabs pull-right">
                                                            <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                                        </ul>
                                                        <div class="tab-content no-padding">
                                                            <!-- Morris chart - Sales -->
                                                            <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 287px;">
                                                                <div id="realChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div><!-- /.nav-tabs-custom -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="dash-event" class="tab-pane ">
                                        <div class="" style="padding: 20px 0px;">
                                            <div class="row">
                            
                                    <div class="col-md-4">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Events</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <?php
                                                    
                                                    
                                                    // =========ACTIVE POST
                                                    $event_totalActive = 0;
                                                    $result2 = $p->myActPost($_SESSION['pid'], -1, 9);
                                                    //echo $p->ta->sql;
                                                    if ($result2) {
                                                        $event_totalActive = $result2->num_rows;
                                                    }
                                                    // =========IN-ACTIVE POST
                                                    $event_totPast = 0;
                                                    $today  = date('Y-m-d');
                                                    $result4 = $p->myExpireProduct(9, $_SESSION['pid']);
                                                    //$result4 = $p->pastEvent($_GET['categoryid'], $today);
                                                    if ($result4) {
                                                        $event_totPast = $result4->num_rows;
                                                    }
                                                    // ==========DRAFT
                                                    $event_totalDraft = 0;
                                                    $result3 = $p->readMyDraftprofile(9, $_SESSION['pid']);
                                                    //echo $p->ta->sql;
                                                    if ($result3) {
                                                        $event_totalDraft = $result3->num_rows;
                                                    }
                                                    // =========FAVOURITE POST
                                                    $event_totFav = 0;
                                                    $result5 = $p->myfavourite_music($_SESSION['pid'], 9);
                                                    //echo $p->ta->sql;
                                                    if ($result5) {
                                                        $event_totFav = $result5->num_rows;
                                                    }
                                                    // ===========TOTAL SPONSORS
                                                    $event_totSpon = 0;
                                                    $sp  = new _sponsorpic;
                                                    $result6 = $sp->readAll($_SESSION['pid']);
                                                    if ($result6) {
                                                        $event_totSpon = $result6->num_rows;
                                                    }
                                                    // ========TOTAL FLAG EVENT
                                                    $event_totFlag = 0;
                                                    $result7 = $p->myflagPost(9, $_SESSION['pid']);
                                                    if ($result7) {
                                                        $event_totFlag = $result7->num_rows;
                                                    }
                                                    // ====END
                                                    ?>
                                                    <table class="table table-striped no-margin">
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/events/dashboard/active-event.php'; ?>">Active Events</a></td>
                                                                <td><span class="label label-info"><?php echo $event_totalActive; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/events/dashboard/past-event.php';?>">Past Events</a></td>
                                                                <td><span class="label label-info"><?php echo $event_totPast; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/events/dashboard/draft-event.php';?>">Draft Events</a></td>
                                                                <td><span class="label label-danger"><?php echo $event_totalDraft; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/events/dashboard/sponsor-list.php'; ?>">Total Sponsors</a></td>
                                                                <td><span class="label label-success"><?php echo $event_totSpon; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/events/dashboard/bookmark.php';?>">Bookmark Events</a></td>
                                                                <td><span class="label label-warning"><?php echo $event_totFav; ?></span></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/events/dashboard/myFlag.php';?>">Flagged Events</a></td>
                                                                <td><span class="label label-success"><?php echo $event_totFlag; ?></span></td>
                                                            </tr>   
                                                                     
                                                        </tbody>
                                                    </table>
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            
                                        </div><!-- /.box -->
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <!-- =======donut chart===== -->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <div class="chart tab-pane active" id="chart-two-event" style="position: relative; height: 292px;">   

                                                </div>                                        
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 250px;">
                                                    <div id="eventChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                
                                </div>
                                        </div>
                                    </div>
                                    <div id="dash-gallery" class="tab-pane">
                                        <div class="" style="padding: 20px 0px;">
                                            <div class="row">
                                    <div class="col-md-4">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Art Gallery</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <?php
                                                    
                                                   
                                                    // =========ACTIVE POST
                                                    $pho_totalActive = 0;
                                                    $result4 = $p->singleFriendProduct($_SESSION['pid'], 13);
                                                    if ($result4) {
                                                        $pho_totalActive = $result4->num_rows;
                                                    }
                                                    // =========PAST POST
                                                    $pho_totExp = 0;
                                                    $result5 = $p->myExpireProduct(13, $_SESSION['pid']);
                                                    //echo $p->ta->sql;
                                                    if ($result5) {
                                                        $pho_totExp = $result5->num_rows;
                                                    }

                                                    // ============YOUR BOARD
                                                    $pho_myflag = 0;
                                                    $result6 = $p->myflagPost(13, $_SESSION['pid']);
                                                    if ($result6) {
                                                        $pho_myflag = $result6->num_rows;
                                                    }

                                                    // =============ENQUIRY
                                                    $pho_totenquiry = 0;
                                                    $result7 = $ag->readMyEnquery($_SESSION['pid']);
                                                    if ($result7) {
                                                        $pho_totenquiry = $result7->num_rows;
                                                    }

                                                    ?>
                                                    <table class="table table-striped no-margin">
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/photos/dashboard/active-art.php'; ?>">Active Photos</a></td>
                                                                <td><span class="label label-info"><?php echo $pho_totalActive; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/photos/dashboard/past-art.php';?>">Past Photos</a></td>
                                                                <td><span class="label label-info"><?php echo $pho_totExp; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/photos/dashboard/my-enquiry.php'; ?>">Total Enquiry</a></td>
                                                                <td><span class="label label-warning"><?php echo $pho_totenquiry; ?></span></td>
                                                            </tr> 
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/photos/dashboard/myflag.php';?>">Flagged Art</a></td>
                                                                <td><span class="label label-warning"><?php echo $pho_myflag; ?></span></td>
                                                            </tr>
                                                              

                                                        </tbody>
                                                    </table>
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            
                                        </div><!-- /.box -->
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <!-- =======donut chart===== -->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Art Gallery Donut Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <div class="chart tab-pane active" id="chart-two-photo" style="position: relative; height: 292px;">   

                                                </div>                                        
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 175px;">
                                                    <div id="photoChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->                                        
                                    </div>
                                </div><!-- /.row -->
                                        </div>
                                    </div>
                                    <div id="dash-music" class="tab-pane">
                                        <div class="" style="padding: 20px 0px;">
                                            <div class="row">
            
                                    <div class="col-md-4">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Music</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <?php
                                                    
                                                    
                                                    // =========MY UPLOAD SONGS ACTIVE
                                                    $mus_totalActive = 0;
                                                    $result4 = $p->myAllSongs($_SESSION['pid'], 14);
                                                    if ($result4) {
                                                        $mus_totalActive = $result4->num_rows;
                                                    }
                                                    // =========PAST MUSIC
                                                    $mus_totPast = 0;
                                                    $result2 = $p->myExpireProduct(14, $_SESSION['pid']);
                                                    if ($result2) {
                                                        $mus_totPast = $result2->num_rows;
                                                    }
                                                    // ========PLAYLIST
                                                    $mus_playList = 0; 
                                                    $result6 = $cl->readList($_SESSION['pid'], 14);
                                                    if ($result6) {
                                                        $mus_playList = $result6->num_rows;
                                                    }
                                                    // =======ALBUM
                                                    $mus_album = 0; 
                                                    $result7 = $al->readMyalbum($_SESSION['pid'], 14);
                                                    //echo $al->ta->sql;
                                                    if ($result7) {
                                                        $mus_album = $result7->num_rows;
                                                    }
                                                    // MY PRIVATE SONG
                                                    $mus_private = 0; 
                                                    $result8 = $p->myAllPrivateSongs($_SESSION['pid'], 14, 0);
                                                    if ($result8) {
                                                        $mus_private = $result8->num_rows;
                                                    }
                                                    // =========FAVOURITE POST
                                                    $mus_totFav = 0;
                                                    $result5 = $p->myfavourite_music($_SESSION['pid'], 14);
                                                    //echo $p->ta->sql;
                                                    if ($result5) {
                                                        $mus_totFav = $result5->num_rows;
                                                    }
                                                    // =========LYRICS
                                                    $mus_totLyri = 0;
                                                    $result3 = $pl->readMyLyric($_SESSION['pid'], 14);
                                                    if ($result3) {
                                                        $mus_totLyri = $result3->num_rows;
                                                    }
                                                    // ==========DRAFT
                                                    $mus_totFlag = 0;
                                                    $result9 = $p->myflagPost(14, $_SESSION['pid']);
                                                    //echo $p->ta->sql;
                                                    if ($result9) {
                                                        $mus_totFlag = $result9->num_rows;
                                                    }
                                                    
                                                    ?>
                                                    <table class="table table-striped no-margin">
                                                        <tbody>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/active-music.php'; ?>">Active Music</a></td>
                                                                <td><span class="label label-success"><?php echo $mus_totalActive; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/past-music.php'; ?>">Past Music</a></td>
                                                                <td><span class="label label-info"><?php echo $mus_totPast; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/playlist.php'; ?>">Playlist</a></td>
                                                                <td><span class="label label-warning"><?php echo $mus_playList; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/album.php'; ?>">Album</a></td>
                                                                <td><span class="label label-warning"><?php echo $mus_album; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/private.php'; ?>">My Private Music</a></td>
                                                                <td><span class="label label-warning"><?php echo $mus_private; ?></span></td>
                                                            </tr>   
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/favourite.php'; ?>">Favourite Music</a></td>
                                                                <td><span class="label label-warning"><?php echo $mus_totFav; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/lyrics.php'; ?>">Lyrics</a></td>
                                                                <td><span class="label label-warning"><?php echo $mus_totLyri; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/music/dashboard/myFlag.php'; ?>">Flagged Music</a></td>
                                                                <td><span class="label label-warning"><?php echo $mus_totFlag; ?></span></td>
                                                            </tr>
                                                                                                   
                                                        </tbody>
                                                    </table>
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            
                                        </div><!-- /.box -->                                        
                                    </div>
                                    <div class="col-md-4">
                                        <!-- =======donut chart===== -->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Music Donut Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <div class="chart tab-pane active" id="chart-two-music" style="position: relative; height: 292px;">   

                                                </div>                                        
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->

                                    </div>
                                    <div class="col-md-4">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 325px;">
                                                    <div id="musicChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                
                                </div>
                                        </div>
                                    </div>
                                    <div id="dash-video" class="tab-pane ">
                                        <div class="" style="padding: 20px 0px;">
                                            <div class="row">
                            
                                    <div class="col-md-4">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Videos</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <?php
                                                    
                                                    
                                                    // =========MY UPLOAD SONGS ACTIVE
                                                    $vdo_totalActive = 0;
                                                    $result4 = $p->myAllSongs($_SESSION['pid'], 10);
                                                    if ($result4) {
                                                        $vdo_totalActive = $result4->num_rows;
                                                    }
                                                    // =========PAST MUSIC
                                                    $vdo_totPast = 0;
                                                    $result2 = $p->myExpireProduct(10, $_SESSION['pid']);
                                                    if ($result2) {
                                                        $vdo_totPast = $result2->num_rows;
                                                    }
                                                    // ========PLAYLIST
                                                    $vdo_playList = 0; 
                                                    $result6 = $cl->readList($_SESSION['pid'], 10);
                                                    if ($result6) {
                                                        $vdo_playList = $result6->num_rows;
                                                    }
                                                    // =======ALBUM
                                                    $vdo_album = 0; 
                                                    $result7 = $al->readMyalbum($_SESSION['pid'], 10);
                                                    //echo $al->ta->sql;
                                                    if ($result7) {
                                                        $vdo_album = $result7->num_rows;
                                                    }
                                                    // MY PRIVATE SONG
                                                    $vdo_private = 0; 
                                                    $result8 = $p->myAllPrivateSongs($_SESSION['pid'], 10, 0);
                                                    if ($result8) {
                                                        $vdo_private = $result8->num_rows;
                                                    }
                                                    // =========FAVOURITE POST
                                                    $vdo_totFav = 0;
                                                    $result5 = $p->myfavourite_music($_SESSION['pid'], 10);
                                                    //echo $p->ta->sql;
                                                    if ($result5) {
                                                        $vdo_totFav = $result5->num_rows;
                                                    }
                                                    // =========LYRICS
                                                    $vdo_totLyri = 0;
                                                    $result3 = $pl->readMyLyric($_SESSION['pid'], 10);
                                                    if ($result3) {
                                                        $vdo_totLyri = $result3->num_rows;
                                                    }
                                                    // ==========DRAFT
                                                    $vdo_totFlag = 0;
                                                    $result9 = $p->myflagPost(10, $_SESSION['pid']);
                                                    //echo $p->ta->sql;
                                                    if ($result9) {
                                                        $vdo_totFlag = $result9->num_rows;
                                                    }
                                                    
                                                    ?>
                                                    <table class="table table-striped no-margin">
                                                        <tbody>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/active-video.php'; ?>">Active Videos</a></td>
                                                                <td><span class="label label-success"><?php echo $vdo_totalActive; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/past-video.php'; ?>">Past Videos</a></td>
                                                                <td><span class="label label-info"><?php echo $vdo_totPast; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/playlist.php'; ?>">Playlist</a></td>
                                                                <td><span class="label label-warning"><?php echo $vdo_playList; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/album.php'; ?>">Album</a></td>
                                                                <td><span class="label label-warning"><?php echo $vdo_album; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/private.php'; ?>">My Private Videos</a></td>
                                                                <td><span class="label label-warning"><?php echo $vdo_private; ?></span></td>
                                                            </tr>   
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/favourite.php'; ?>">Favourite Videos</a></td>
                                                                <td><span class="label label-warning"><?php echo $vdo_totFav; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/lyrics.php'; ?>">Lyrics</a></td>
                                                                <td><span class="label label-warning"><?php echo $vdo_totLyri; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/videos/dashboard/myFlag.php'; ?>">Flagged Videos</a></td>
                                                                <td><span class="label label-warning"><?php echo $vdo_totFlag; ?></span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            
                                        </div><!-- /.box -->

                                    </div>
                                    <div class="col-md-4">
                                        <!-- =======donut chart===== -->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Videos Donut Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <div class="chart tab-pane active" id="chart-two-video" style="position: relative; height: 292px;">   

                                                </div>                                        
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 325px;">
                                                    <div id="videoChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                </div>

                                        </div>
                                    </div>
                                    <div id="dash-training" class="tab-pane">
                                        <div class="" style="padding: 20px 0px;">
                                            <div class="row">

                                    <div class="col-md-4">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Trainings</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <?php
                                                    
                                                    // =========ACTIVE POST
                                                    $train_totalActive = 0;
                                                    $result4 = $p->myAllSongs($_SESSION['pid'], 8);
                                                    //echo $p->ta->sql;
                                                    if ($result4) {
                                                        $train_totalActive = $result4->num_rows;
                                                    }

                                                    // =========FAVOURITE POST
                                                    $train_totFav = 0;
                                                    $result5 = $p->myfavourite_music($_SESSION['pid'], 8);
                                                    //echo $p->ta->sql;
                                                    if ($result5) {
                                                        $train_totFav = $result5->num_rows;
                                                    }
                                                    
                                                    // ==========FLAGGED
                                                    $train_totFlag = 0;
                                                    $result9 = $p->myflagPost(8, $_SESSION['pid']);
                                                    //echo $p->ta->sql;
                                                    if ($result9) {
                                                        $train_totFlag = $result9->num_rows;
                                                    }

                                                    ?>
                                                    <table class="table table-striped no-margin">
                                                        <tbody>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/trainings/dashboard/active.php'; ?>">Active Trainings</a></td>
                                                                <td><span class="label label-success"><?php echo $train_totalActive; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/trainings/dashboard/favourite.php'; ?>">Favourite Trainings</a></td>
                                                                <td><span class="label label-warning"><?php echo $train_totFav; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/trainings/dashboard/myFlag.php'; ?>">Flagged Trainings</a></td>
                                                                <td><span class="label label-warning"><?php echo $train_totFlag; ?></span></td>
                                                            </tr>                                                 
                                                        </tbody>
                                                    </table>
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            
                                        </div><!-- /.box -->
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <!-- =======donut chart===== -->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Trainings Donut Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <div class="chart tab-pane active" id="chart-two-train" style="position: relative; height: 292px;">   

                                                </div>                                        
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 140px;">
                                                    <div id="trainingChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                
                                </div>
                                        </div>
                                    </div>
                                    <div id="dash-ads" class="tab-pane">
                                        <div class="" style="padding: 20px 0px;">
                                            <div class="row">
                                    <div class="col-md-4">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title">Classified Ads</h3>
                                                <div class="box-tools pull-right">
                                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
                                                <div class="table-responsive">
                                                    <?php
                                                   
                                                    
                                                    // =========ACTIVE POST
                                                    $ad_totalActive = 0;
                                                    $result4 = $p->myposted_service(7, $_SESSION['pid']);
                                                    //echo $p->ta->sql;
                                                    if ($result4) {
                                                        $ad_totalActive = $result4->num_rows;
                                                    }

                                                    // =========EXPIRE POST
                                                    $ad_totExp = 0;
                                                    $result6 = $p->myposted_expire_service(7, $_SESSION['pid']);
                                                    if ($result6) {
                                                        $ad_totExp = $result6->num_rows;
                                                    }

                                                    // =========FAVOURITE POST
                                                    $ad_totFav = 0;
                                                    $result5 = $p->myfavourite_music($_SESSION['pid'], 7);
                                                    //echo $p->ta->sql;
                                                    if ($result5) {
                                                        $ad_totFav = $result5->num_rows;
                                                    }

                                                    // =========FLAGED POST
                                                    $ad_totFlgPst = 0;
                                                    $result7 = $p->flag_post(7, $_SESSION['pid']);
                                                    if ($result7) {
                                                        $ad_totFlgPst = $result7->num_rows;
                                                    }

                                                    // ==========DRAFT
                                                    $ad_totalDraft = 0;
                                                    $result3 = $p->readMyDraftprofile(7, $_SESSION['pid']);
                                                    //echo $p->ta->sql;
                                                    if ($result3) {
                                                        $ad_totalDraft = $result3->num_rows;
                                                    }
                                                    
                                                    
                                                    

                                                    ?>
                                                    <table class="table table-striped no-margin">
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/services/dashboard/active.php'; ?>">Active Ads</a></td>
                                                                <td><span class="label label-info"><?php echo $ad_totalActive; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/services/dashboard/past.php'; ?>">Expired Ads</a></td>
                                                                <td><span class="label label-info"><?php echo $ad_totExp; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/services/dashboard/favourite.php'; ?>">Favourite Ads</a></td>
                                                                <td><span class="label label-warning"><?php echo $ad_totFav; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/services/dashboard/myFlag.php'; ?>">Flagged Ads</a></td>
                                                                <td><span class="label label-warning"><?php echo $ad_totFlgPst; ?></span></td>
                                                            </tr>   
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/services/dashboard/draft.php'; ?>">Draft Ads</a></td>
                                                                <td><span class="label label-danger"><?php echo $ad_totalDraft; ?></span></td>
                                                            </tr>
                                                                                       
                                                        </tbody>
                                                    </table>
                                                </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            
                                        </div><!-- /.box -->
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <!-- =======donut chart===== -->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <div class="chart tab-pane active" id="chart-two-ad" style="position: relative; height: 292px;">   

                                                </div>                                        
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    </div>
                                    <div class="col-md-4">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 215px;">
                                                    <div id="adChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                                
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->
                                    
                                        
                                    </div>
                                
                                </div>
                                        </div>
                                    </div>





                                </div>
                                
                                                                            
                                

                                
                                       
                                

                                

                                

                                

                                
                                


                                
                                <!-- END -->


                            </div>
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/assets/admin/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

        <script src="http://code.highcharts.com/highcharts.js"></script>
       
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>




        <!-- Sky Icons -->
        <script type="text/javascript" src='<?php echo $BaseUrl;?>/assets/plugins/skycons/skycons.js'></script>
        <script type="text/javascript">
            $(window).load(function () {
                // Skycons
                var icons = new Skycons({"color": "white","resizeClear": true}),
                    icons_btm = new Skycons({"color": "#fff","resizeClear": true}),
                    list  = "clear-day",
                    livd_btm = ["rain", "wind"];
                    icons.set(list,list)
                    for(var i = livd_btm.length; i--; )
                        icons_btm.set(livd_btm[i], livd_btm[i]);

                    icons.play();
                    icons_btm.play();
            });
        </script>

        <!-- OTHER DASHBOARD STORE DETAIL -->
        <!-- Morris.js charts -->
        <script src="<?php echo $BaseUrl?>/assets/js/raphael-min.js"></script>
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-store',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Products", value: <?php echo $str_totActivePro;?>},
                        {label: "De-activate Products", value: <?php echo $str_totDeActivePro;?>},
                        {label: "Draft Products", value: <?php echo $str_totalDraft; ?>},
                        {label: "Expired Products", value: <?php echo $str_totExpirdPro; ?>},
                        {label: "Enquiries", value: <?php echo $str_totalEnquires;?>},
                        {label: "Favourite Product", value: <?php echo $str_totFav;?>},
                       /* {label: "Flagged Product", value: <?php echo $str_totalFlag;?>}*/
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('storeBarChrt', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Store Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Store',
                    colorByPoint: true,
                    data: [{
                        name: "Active Products",
                        y: <?php echo $str_totActivePro;?>
                    },{
                        name: "De-activate Products",
                        y: <?php echo $str_totDeActivePro;?>
                    },{
                        name: "Draft Products",
                        y: <?php echo $str_totalDraft; ?>
                    },{
                        name: "Expired Products",
                        y: <?php echo $str_totExpirdPro; ?>
                    }, {
                        name: "Enquiries",
                        y: <?php echo $str_totalEnquires;?>
                    }, {
                        name: "Favourite Product",
                        y: <?php echo $str_totFav;?>
                    }/*, {
                        name: "Flagged Product",
                        y: <?php echo $str_totalFlag;?>
                    }*/]
                }],
                
            });
        </script>
        <!-- FREELANCER MODULE CHART -->
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('freelanceChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Freelancer Poster Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Freelance',
                    colorByPoint: true,
                    data: [{
                        name: "Active Projects",
                        y: <?php echo $fre_totalActive;?>
                    },{
                        name: "Expired Projects",
                        y: <?php echo $fre_totalExpire;?>
                    },{
                        name: "Draft Projects",
                        y: <?php echo $fre_totalDraft; ?>
                    }, {
                        name: "Complete Projects",
                        y: <?php echo $fre_totCmpPro;?>
                    }, /*{
                        name: "Flagged Projects",
                        y: <?php echo $fre_totFlagPost;?>
                    }*/]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-freelance',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Projects", value: <?php echo $fre_totalActive;?>},
                        {label: "Expired Projects", value: <?php echo $fre_totalExpire;?>},
                        {label: "Draft Projects", value: <?php echo $fre_totalDraft; ?>},
                        {label: "Complete Projects", value: <?php echo $fre_totCmpPro;?>},
                        /*{label: "Flagged Projects", value: <?php echo $fre_totFlagPost;?>}*/
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('jobChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Job Board Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Job Board',
                    colorByPoint: true,
                    data: [{
                        name: "Active Jobs",
                        y: <?php echo $job_totalActive;?>
                    },{
                        name: "Expired Jobs",
                        y: <?php echo $job_totExpPost; ?>
                    },{
                        name: "Draft Jobs",
                        y: <?php echo $job_totalDraft; ?>
                    }, {
                        name: "Saved Jobs",
                        y: <?php echo $job_totFav;?>
                    }, {
                        name: "Flagged Post",
                        y: <?php echo $job_totFlag;?>
                    }, {
                        name: "Trash Jobs",
                        y: <?php echo $job_totTrash;?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-job',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Jobs", value: <?php echo $job_totalActive;?>},
                        {label: "Expired Jobs", value: <?php echo $job_totExpPost; ?>},
                        {label: "Draft Jobs", value: <?php echo $job_totalDraft; ?>},
                        {label: "Saved Jobs", value: <?php echo $job_totFav;?>},
                        {label: "Flagged Job", value: <?php echo $job_totFlag;?>},
                        {label: "Trash Jobs", value: <?php echo $job_totTrash;?>}
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('realChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Real Estate Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Real Estate',
                    colorByPoint: true,
                    data: [{
                        name: "Active Property",
                        y: <?php echo $real_totalActive;?>
                    },{
                        name: "Rent Entire Place",
                        y: <?php echo $real_rent_entire_place; ?>
                    },{
                        name: "Rent Room",
                        y: <?php echo $real_rentaroom; ?>
                    },{
                        name: "Draft Property",
                        y: <?php echo $real_totalDraft;?>
                    },{
                        name: "My Enquires",
                        y: <?php echo $real_myEnquiry;?>
                    },{
                        name: "Favourite Listing",
                        y: <?php echo $real_totFav;?>
                    },{
                        name: "Flagged Property",
                        y: <?php echo $real_myFlag;?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-real',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Property", value: <?php echo $real_totalActive;?>},
                        {label: "Rent Entire Place", value: <?php echo $real_rent_entire_place; ?>},
                        {label: "Rent Room", value: <?php echo $real_rentaroom; ?>},
                        {label: "Draft Property", value: <?php echo $real_totalDraft;?>},
                        {label: "My Enquires", value: <?php echo $real_myEnquiry;?>},
                        {label: "Favourite Listing", value: <?php echo $real_totFav;?>},
                        {label: "Flagged Property", value: <?php echo $real_myFlag;?>}
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('eventChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Event Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Events',
                    colorByPoint: true,
                    data: [{
                        name: "Active Events",
                        y: <?php echo $event_totalActive;?>
                    },{
                        name: "Past Events",
                        y: <?php echo $event_totPast; ?>
                    },{
                        name: "Draft Events",
                        y: <?php echo $event_totalDraft; ?>
                    },{
                        name: "Total Sponsors",
                        y: <?php echo $event_totSpon;?>
                    },{
                        name: "Bookmark Events",
                        y: <?php echo $event_totFav;?>
                    },{
                        name: "Flagged Events",
                        y: <?php echo $event_totFlag;?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-event',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Events", value: <?php echo $event_totalActive;?>},
                        {label: "Past Events", value: <?php echo $event_totPast; ?>},
                        {label: "Draft Events", value: <?php echo $event_totalDraft; ?>},
                        {label: "Total Sponsors", value: <?php echo $event_totSpon; ?>},
                        {label: "Bookmark Events", value: <?php echo $event_totFav; ?>},
                        {label: "Flagged Events", value: <?php echo $event_totFlag;?>}
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('photoChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Art Gallery Seller Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Art Gallery',
                    colorByPoint: true,
                    data: [{
                        name: "Active Photos",
                        y: <?php echo $pho_totalActive;?>
                    },{
                        name: "Past Photos",
                        y: <?php echo $pho_totExp;?>
                    },{
                        name: "Total Enquiry",
                        y: <?php echo $pho_totenquiry; ?>
                    },{
                        name: "Flagged Photos",
                        y: <?php echo $pho_myflag; ?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-photo',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Photos", value: <?php echo $pho_totalActive;?>},
                        {label: "Past Photos", value: <?php echo $pho_totExp;?>},
                        {label: "Total Enquiry", value: <?php echo $pho_totenquiry; ?>},
                        {label: "Flagged Photos", value: <?php echo $pho_myflag; ?>}
                        
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('musicChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Music Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Music',
                    colorByPoint: true,
                    data: [{
                        name: "Active Music",
                        y: <?php echo $mus_totalActive;?>
                    },{
                        name: "Past Music",
                        y: <?php echo $mus_totPast;?>
                    },{
                        name: "Playlist",
                        y: <?php echo $mus_playList;?>
                    },{
                        name: "Album",
                        y: <?php echo $mus_album;?>
                    },{
                        name: "My Private Music",
                        y: <?php echo $mus_private;?>
                    },{
                        name: "Favourite Music",
                        y: <?php echo $mus_totFav;?>
                    },{
                        name: "Lyrics",
                        y: <?php echo $mus_totLyri;?>
                    },{
                        name: "Flagged Music",
                        y: <?php echo $mus_totFlag;?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-music',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Music", value: <?php echo $mus_totalActive;?>},
                        {label: "Past Music", value: <?php echo $mus_totPast;?>},
                        {label: "Playlist", value: <?php echo $mus_playList;?>},
                        {label: "Album", value: <?php echo $mus_album; ?>},
                        {label: "My Private Music", value: <?php echo $mus_private; ?>},
                        {label: "Favourite Music", value: <?php echo $mus_totFav;?>},
                        {label: "Lyrics", value: <?php echo $mus_totLyri;?>},
                        {label: "Flagged Music", value: <?php echo $mus_totFlag;?>}
                    ],
                    hideHover: 'auto'
                });
            });
        </script>

        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('videoChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Videos',
                    colorByPoint: true,
                    data: [{
                        name: "Active Music",
                        y: <?php echo $vdo_totalActive;?>
                    },{
                        name: "Past Music",
                        y: <?php echo $vdo_totPast;?>
                    },{
                        name: "Playlist",
                        y: <?php echo $vdo_playList;?>
                    },{
                        name: "Album",
                        y: <?php echo $vdo_album;?>
                    },{
                        name: "My Private Music",
                        y: <?php echo $vdo_private;?>
                    },{
                        name: "Favourite Music",
                        y: <?php echo $vdo_totFav;?>
                    },{
                        name: "Lyrics",
                        y: <?php echo $vdo_totLyri;?>
                    },{
                        name: "Flagged Music",
                        y: <?php echo $vdo_totFlag;?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-video',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Music", value: <?php echo $vdo_totalActive;?>},
                        {label: "Past Music", value: <?php echo $vdo_totPast;?>},
                        {label: "Playlist", value: <?php echo $vdo_playList;?>},
                        {label: "Album", value: <?php echo $vdo_album; ?>},
                        {label: "My Private Music", value: <?php echo $vdo_private; ?>},
                        {label: "Favourite Music", value: <?php echo $vdo_totFav;?>},
                        {label: "Lyrics", value: <?php echo $vdo_totLyri;?>},
                        {label: "Flagged Music", value: <?php echo $vdo_totFlag;?>}
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('trainingChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Trainings',
                    colorByPoint: true,
                    data: [{
                        name: "Active Trainings",
                        y: <?php echo $train_totalActive;?>
                    },{
                        name: "Favourite Trainings",
                        y: <?php echo $train_totFav;?>
                    },{
                        name: "Flagged Trainings",
                        y: <?php echo $train_totFlag; ?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-train',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Trainings", value: <?php echo $train_totalActive;?>},
                        {label: "Favourite Trainings", value: <?php echo $train_totFav;?>},
                        {label: "Flagged Trainings", value: <?php echo $train_totFlag; ?>}
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('adChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Graph'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: ''
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.0f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                },

                series: [{
                    name: 'Classified Ads',
                    colorByPoint: true,
                    data: [{
                        name: "Active Ads",
                        y: <?php echo $ad_totalActive;?>
                    },{
                        name: "Expired Ads",
                        y: <?php echo $ad_totExp; ?>
                    },{
                        name: "Favourite Ads",
                        y: <?php echo $ad_totFav;?>
                    },{
                        name: "Flagged Ads",
                        y: <?php echo $ad_totFlgPst;?>
                    },{
                        name: "Draft Ads",
                        y: <?php echo $ad_totalDraft; ?>
                    }]
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two-ad',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        
                        {label: "Active Ads", value: <?php echo $ad_totalActive;?>},
                        {label: "Expired Ads", value: <?php echo $ad_totExp; ?>},
                        {label: "Favourite Ads", value: <?php echo $ad_totFav;?>},
                        {label: "Flagged Ads", value: <?php echo $ad_totFlgPst;?>},
                        {label: "Draft Ads", value: <?php echo $ad_totalDraft; ?>}                        
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <!-- END -->
        <!-- Specific Page Scripts END -->

        <!-- FLOT CHARTS -->
        <script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/assets/admin/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
       
        <!-- Page script -->
        <script type="text/javascript">

            $(function () {
                var data = [], totalPoints = 100;
                /*
                 * LINE CHART
                 * ----------
                 */
                //LINE randomly generated data
                var store = {
                    data: [
                        [2013, 15],
                        [2014, 9],
                        [2015, 11],
                        [2016, 11],
                        [2017, 20],
                        [2018, 7]
                    ],
                    color: "#56966f"
                };
                var freelance = {
                    data: [
                        [2013, 17],
                        [2014, 5],
                        [2015, 13],
                        [2016, 9],
                        [2017, 29],
                        [2018, 17]
                    ],
                    color: "#ff6400"
                };
                var job = {
                    data: [
                        [2013, 16],
                        [2014, 13],
                        [2015, 9],
                        [2016, 13],
                        [2017, 25],
                        [2018, 13]
                    ],
                    color: "#31abe3"
                };
                
                // $.plot("#line-chart", [store, freelance, job], {

                //     grid: {
                //         hoverable: true,
                //         borderColor: "#f3f3f3",
                //         borderWidth: 1,
                //         tickColor: "#f3f3f3"
                //     },
                //     series: {
                //         shadowSize: 0,
                //         lines: {
                //           show: true
                //         },
                //         points: {
                //           show: true
                //         }
                //     },
                //     lines: {
                //         fill: false,
                //         color: ["#3c8dbc", "#f56954"]
                //     },
                //     yaxis: {
                //         show: true,
                //     },
                //     xaxis: {
                //         show: true
                //     }
                // });
                //Initialize tooltip on hover
                $("<div class='tooltip-inner' id='line-chart-tooltip'></div>").css({
                    position: "absolute",
                    display: "none",
                    opacity: 0.8
                }).appendTo("body");
                $("#line-chart").bind("plothover", function (event, pos, item) {

                    if (item) {
                        var x = item.datapoint[0].toFixed(2),
                            y = item.datapoint[1].toFixed(2);

                        $("#line-chart-tooltip").html(item.series.label + " of " + x + " = " + y)
                            .css({top: item.pageY + 5, left: item.pageX + 5})
                            .fadeIn(200);
                    } else {
                        $("#line-chart-tooltip").hide();
                    }
                });
                /* END LINE CHART */
            });
        </script>
        <!-- ALL DASHBOARD GRAPHS -->
        
        
        <!-- END -->

    </body>	
</html>
<?php
}
?>