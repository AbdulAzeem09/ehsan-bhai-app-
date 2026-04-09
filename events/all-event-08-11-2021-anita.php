<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";

     if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- this script for slider art -->
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
    </head>
<style>
	/*------------------Edit-button-css---------------*/
	.upEventBox.upcomingbox {
		position: relative;
	}
	.upEventBox.upcomingbox .eidt-con {
		position: absolute;
		left: auto;
		right: 9px;
		margin-top: 14px;
	}
	.upEventBox.upcomingbox .eidt-con a {
		color: #fff;
	}
	.upEventBox.upcomingbox .eidt-con i.fa {
		border: 1px solid #da1919;
		background: -webkit-linear-gradient(90deg,#9c0202 0,#da1919 100%);
		text-align: center;
		border-radius: 6px;
		padding: 4px 4px;
	}
	</style>
    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>Events</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="main_box no-padding">
            
            <div class="container eventExplrthefun explorecontainer">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="topBoxEvent text-right">
                            <a href="<?php echo $BaseUrl.'/events';?>" class="btn btn_event homeeventbtn">
                                <i class="fa fa-home"></i>Home</a>
                            <a href="<?php echo $BaseUrl.'/events/dashboard/';?>" class="btn btn_event eventdashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                            <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn btn_event submitevent">Submit an event</a>

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
                            <h2><span>Events</span></h2>
                            <p>Your local upcoming events</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php

                    $start = 0;
                    $p      = new _spevent;
                   // $pf     = new _postfield;
                    $res    = $p->publicpost($start, $_GET["categoryID"]);
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { 


                            $venu = "";
                            $startDate = "";
                            $startTime    = "";
                            $endTime = "";
                            $OrganizerName = "";


                             $venu = $row['spPostingEventVenue'];
                                     $startDate = $row['spPostingStartDate'];
                                     $startTime = $row['spPostingStartTime'];
                                     $endTime = $row['spPostingEndTime'];
                                    // $OrganizerName = $row2['spPostingEventOrgName'];

                                     $dtstrtTime = strtotime($startTime);
                                     $dtendTime = strtotime($endTime);
                            //posting fields
                           // $result_pf = $pf->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                           /* if($result_pf){
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
                            }*/
                            ?>
                            <div class="col-md-4">
                         <div class="upEventBox upcomingbox" style="width: 90%; margin-left: 22px;
">
                                    <div class="mainOverlay">
														<div class="eidt-con">
  <a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
</div>
                    <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"
                            >

                                        <?php
                                        $pic = new _eventpic;
                                        
                                        $res2 = $pic->readFeature($row['idspPostings']);
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' 
                                                    class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
                                                } else{
                                                    echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
                                                }
                                            }else{
                                                $res2 = $pic->read($row['idspPostings']);
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src=' " . ($pic2) . "' >"; 
                                                } else{
                                                    echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
                                                }
                                            }
                                        }else{
                                            $res2 = $pic->read($row['idspPostings']);
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive eventimg' src=' " . ($pic2) . "' >"; 
                                            } else{
                                                echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive eventimg'>"; 
                                            }
                                        }
                                         ?>
                                    </div>
                                     </a>
                                    <div class="bodyEventBox">
                                        <?php
                                        if(!empty($startDate)){
                                            //echo $start_date;
                                            $dy = new DateTime($startDate);
                                            $day = $dy->format('d');
                                            $month = $dy->format('M');
                                            $weak = $dy->format('D');
                                        }else{
                                            $day = 0;
                                            $month = "&nbsp;";
                                            $weak = "&nbsp;";
                                        }
                                        ?>

                                         <span class="datetop pull-right">
                                    <?php echo $month.' '.$day;?><?php echo $weak;?></span>


                                        <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class="eventcapitalize">

                                            <?php echo $row['spPostingTitle'];?></a>

                                     
                                        <span  class="" style="margin-left: 0px;"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
                                        <p class="text-justify eventcapitalize">
                                            <?php
                                            if(strlen($row['spPostingNotes']) < 170){
                                                echo $row['spPostingNotes'];
                                            }else{
                                                echo substr($row['spPostingNotes'], 0,170)."...";
                                                
                                            } ?>
                                        </p>
                                        <?php
                                        $area2 = "";
                                        $area1 = "";
                                        $area0 = "";
                                        $ei = new _eventIntrest;
                                        $result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
                                        //echo $ei->ta->sql;
                                        if($result != false && $result->num_rows > 0){
                                            $row3 = mysqli_fetch_assoc($result);
                                            $area = $row3['intrestArea'];
                                            if($area == 2){
                                                $area2 = "<i class='fa fa-check'></i>";
                                                $title = "Going";
                                            }else if($area == 1){
                                                $area1 = "<i class='fa fa-check'></i>";
                                                $title = "Interested";                                
                                            }else if($area == 0){
                                                $area0 = "<i class='fa fa-check'></i>";
                                                $title = "May Be";
                                            }
                                        }else{
                                            $title = "Going";
                                        }
                                        ?>
                                        <div class="ie_<?php echo $row['idspPostings'];?>">
                                            <div class="dropdown intrestEvent" style="display: inline">
                                                <button class="btn btn_group_join dropdown-toggle eventiconbtn" type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>
                                                <ul class="dropdown-menu ">
                                                    <li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="2"><?php echo $area2;?> Going</a></li>
                                                    <li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="1"><?php echo $area1;?> Interested</a></li>
                                                    <li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="0"><?php echo $area0;?> May Be</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footEventBox footupcoming">
                                        <p><span class="date" 
                                      style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate;?>  | <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
                                    </div>
                                </div>
                            </div> <?php
                        }
                    }
                    ?>
                    
                   
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
}
?>
