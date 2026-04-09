<?php 
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin'] = "../timeline/";
    }

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- this script for slider art -->
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static"  data-keyboard="false" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content no-radius">
                    
                    <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
                        <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                        <h2>Your current profile does not have <br>access to this page. Please create or  switch<br> your current profile to either  <span>"Professional Profile"</span> to access this page.</h2>
                        <div class="space-md"></div>
                        <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Create or Switch Profile</a>
                        <a href="<?php echo $BaseUrl.'/events';?>" class="btn">Back to Home</a>
                    </div>
                    
                </div>
            </div>
        </div>
        <section class="main_box no-padding">
            
            <div class="Eventmap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13931873.302173598!2d74.27075075!3d31.514923349999993!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1516348101457" frameborder="0" style="border:0" allowfullscreen></iframe>
                <?php
                $p      = new _postingview;
                $pf     = new _postfield;
                $res    = $p->publicpost_event($_GET["categoryID"]);
                if($res != false){
                    $total = $res->num_rows;
                }else{
                    $total = 0;
                }
                ?>
                <p><?php echo $total;?><br> <span>Global live events</span></p>
            </div>
            <div class="container eventExplrthefun">
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="topBoxEvent text-right">
                            <?php
                            if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4){ ?>
                                <a href="<?php echo $BaseUrl.'/events/dashboard.php';?>" class="btn butn_cancel"><i class="fa fa-dashboard"></i> Dashboard</a>
                                <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save">Submit an event</a> <?php
                            }else{ ?>
                                <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save">Submit an event</a> <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <h1>Explore the <span>fun</span></h1>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?php include('search-form.php');?>
                    </div>
                </div>
            </div>
            
        </section>
        <section class="UpcomingSec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="titleEvent text-center">
                            <h2>Upcoming <span>Events</span></h2>
                            <p>Pellentesque id felis ut neque malesuada maximus quis id arcu</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php

                    $start = 0;
                    $limit = 2;
                    $count = 1;
                    $p      = new _postingview;
                    $pf     = new _postfield;
                    $res    = $p->publicpost_event($_GET["categoryID"]);
                    //echo $p->ta->sql;
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { 
                            //posting fields
                            $result_pf = $pf->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                            if($result_pf){
                                $venu = "";
                                $startDate = "";
                                $startTime    = "";
                                $endTime = "";
                                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                    
                                    if($venu == ''){
                                        if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
                                            $venu = $row2['spPostFieldValue'];

                                        }
                                    }
                                    if($startDate == ''){
                                        if($row2['spPostFieldName'] == 'spPostingStartDate_'){
                                            $startDate = $row2['spPostFieldValue'];

                                        }
                                    }
                                    if($startTime == ''){
                                        if($row2['spPostFieldName'] == 'spPostingStartTime_'){
                                            $startTime = $row2['spPostFieldValue'];

                                        }
                                    }
                                    if($endTime == ''){
                                        if($row2['spPostFieldName'] == 'spPostingEndTime_'){
                                            $endTime = $row2['spPostFieldValue'];

                                        }
                                    }
                                }
                                $dtstrtTime = strtotime($startTime);
                                $dtendTime = strtotime($endTime);
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="upEventBox">
                                    <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>">
                                        <?php
                                        $pic = new _postingpic;
                                        
                                        $res2 = $pic->readFeature($row['idspPostings']);
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                                } else{
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
                                                }
                                            }else{
                                                $res2 = $pic->read($row['idspPostings']);
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                                } else{
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
                                                }
                                            }
                                        }else{
                                            $res2 = $pic->read($row['idspPostings']);
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; 
                                            } else{
                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; 
                                            }
                                        }
                                         ?>
                                    </a>
                                    <div class="bodyEventBox">
                                        <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a>
                                        <span  class="text-center"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
                                        <p class="text-justify">
                                            <?php
                                            if(strlen($row['spPostingNotes']) < 170){
                                                echo $row['spPostingNotes'];
                                            }else{
                                                echo substr($row['spPostingNotes'], 0,170)."...";
                                                
                                            } ?>
                                        </p>
                                    </div>
                                    <div class="footEventBox">
                                        <p><span class="date"><i class="fa fa-calendar"></i> <?php echo $startDate;?>  | <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
                                    </div>
                                </div>
                            </div> <?php
                            $count++;
                            if($count > 3){
                                break;
                            }
                        }
                    }
                    ?>
                    
                    <div class="col-sm-12 text-center">
                        <div class="viewAllEvent">
                            <a href="<?php echo $BaseUrl.'/events/all-event.php';?>" class="btn btn_event">View All</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="UpcomingSec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="titleEvent text-center">
                            <h2>Event <span>Schedule</span></h2>
                            <p>Pellentesque id felis ut neque malesuada maximus quis id arcu</p>
                        </div>
                    </div>
                </div>
                <div class="row bg_white no-margin">
                    <div class="col-sm-12 no-padding">
                        <div class="">
                            <div class="board">
                                <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                                <div class="board-inner">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <?php
                                        $arrWeek = array("sun", "mon", "tue", "wed", "thu", "fri", "sat");
                                        ?>
                                        <li class="active">
                                            <a href="#sun" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php 
                                                        $today = new DateTime(date('M-d-Y'));
                                                        // Display full day name
                                                        echo $today->format('l') . PHP_EOL; // lowercase L 
                                                        ?>
                                                    </p>
                                                    <p><?php echo date('M-d-Y');?></p>
                                                </div>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#mon" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php 
                                                        $day1 = strtotime("+1 day", strtotime(date('M-d-Y')));
                                                        $today1 = new DateTime(date("M-d-Y", $day1));
                                                        // Look a year into the future for example sake
                                                        //$today->modify('+1 year 12 days');
                                                        // Display full day name
                                                        echo $today1->format('l') . PHP_EOL; // lowercase L 
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+1 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#tue" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today2 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today2->modify('+2 day');
                                                        // Display full day name
                                                        echo $today2->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+2 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div> 
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#wed" data-toggle="tab" >
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today3 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today3->modify('+3 day');
                                                        // Display full day name
                                                        echo $today3->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+3 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div> 
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#thu" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today4 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today4->modify('+4 day');
                                                        // Display full day name
                                                        echo $today4->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+4 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                         </li>
                                         <li>
                                            <a href="#fri" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today5 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today5->modify('+5 day');
                                                        // Display full day name
                                                        echo $today5->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+5 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                         </li>
                                         <li>
                                            <a href="#sat" data-toggle="tab" >
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today6 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today6->modify('+6 day');
                                                        // Display full day name
                                                        echo $today6->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+6 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                         </li>
                                     
                                     </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="sun">
                                        <?php 
                                        $showtoday = date('Y-m-d');
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="mon">
                                        <?php 
                                        $day1 = strtotime("+1 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day1);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="tue">
                                        <?php 
                                        $day2 = strtotime("+2 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day2);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="wed">
                                        <?php 
                                        $day3 = strtotime("+3 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day3);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="thu">
                                        <?php 
                                        $day4 = strtotime("+4 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day4);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="fri">
                                        <?php 
                                        $day5 = strtotime("+5 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day5);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="sat">
                                        <?php 
                                        $day6 = strtotime("+6 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day6);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="EventregisterBox">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="headingreg text-center">
                            <h2>REGISTER NOW AND JOIN WITH US!!</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <form class="">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/map.png"> Name</label>
                                <input type="text" name="" class="form-control" placeholder="Enter your name">
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/email.png"> Email</label>
                                <input type="email" name="" class="form-control" placeholder="Enter your email">
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/phone.png"> Phone</label>
                                <input type="text" name="" class="form-control" placeholder="Enter your phone">
                            </div>
                        </div>  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label><img src="<?php echo $BaseUrl;?>/assets/images/events/password.png"> Password</label>
                                <input type="password" name="" class="form-control" placeholder="Enter your password">
                            </div>
                        </div>  
                        <div class="col-sm-12 text-center">
                            <input type="submit" name="" value="Register" class="btn">
                        </div>
                    </form>
                    
                </div>
            </div>
        </section>
        <section class="eventGallery">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="titleEvent text-center">
                            <h2>Event Gallery</h2>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    
                    $start = 0;
                    $limit = 8;
                    $count = 1;
                    $p      = new _postingview;
                    $res    = $p->publicpost($start, $_GET["categoryID"]);
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { ?>
                            <div class="col-md-3">
                                <div class="EvntImg">
                                    <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" >
                                        <?php
                                        $pic = new _postingpic;
                                        $res2 = $pic->read($row['idspPostings']);
                                        if ($res2 != false) {
                                            $rp = mysqli_fetch_assoc($res2);
                                            $pic2 = $rp['spPostingPic'];
                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                            <?php
                                        } ?>
                                    </a>
                                </div>
                            </div> <?php
                            $count++;
                            if($count > 8){
                                break;
                            }
                        }
                    }
                    ?>
                    
                            

                </div>
            </div>
        </section>
        
        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
