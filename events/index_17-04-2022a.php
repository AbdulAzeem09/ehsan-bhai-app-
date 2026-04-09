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
        <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static"  data-keyboard="false" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content no-radius">
                    
                    <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                        <h2>Your current profile does not have access to this page. Please create or  switch your current profile to either  <span>"Professional Profile,Business Profile or Personal profile "</span> to access this page.</h2>
                        <div class="space-md"></div>
                        <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Create or Switch Profile</a>
                        <a href="<?php echo $BaseUrl.'/events';?>" class="btn">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>


        <section class="main_box no-padding">
            
            <div class="Eventmap">

                <img src="../assets/images/events/newevent3.jpg" style="background-size: cover;width: 100%;height: 400px;">
              <!--   <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d13931873.302173598!2d74.27075075!3d31.514923349999993!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1516348101457" frameborder="0" style="border:0" allowfullscreen></iframe>
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

                <p><?php echo $total;?><br> <span>Global live events</span></p> -->
            </div>

            <div class="container eventExplrthefun explorecontainer" style="margin-top: 40px;">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="topBoxEvent text-right">
                           <?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>
                             <a href="<?php echo $BaseUrl.'/events/dashboard/booking.php';?>" class="btn butn_cancel eventdashboard"></i> My Bookings</a>

                             <?php  }else{ ?>
                                <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_cancel eventdashboard">My Bookings</a> 
                           <?php
                            }
                           ?>

                            <?php

                           /* print_r($_SESSION['ptid']);*/
                            if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 
                                $u = new _spuser;
                                // IS EMAIL IS VERIFIED
                                $p_result = $u->isverify($_SESSION['uid']);
                                if ($p_result == 1) {
                                    $pv = new _postingview;
                                    $reuslt_vld = $pv->chekposting(9,$_SESSION['pid']);
                                    if ($reuslt_vld == false) {
                                        ?>
                                        <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save submitevent">Submit an event</a>
                                        <?php
                                    }
                                
                                }else{
                                    ?>
                                    <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent">Submit an event</a> <?php
                                }
                                ?>
                                <a href="<?php echo $BaseUrl.'/events/dashboard/';?>" class="btn eventdashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                                 <?php
                            }else{ ?>
                                <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn butn_save submitevent">Submit an event</a> <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="">
                            <h1>Explore the <span>fun</span></h1>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <?php include('search-form.php');?>
                    </div>
                </div>
            </div>
            
        </section>
        <section class="UpcomingSec">
            <div class="container">

				<!-- Retail Open -->      
                         <!--<div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
							 <?php
                                    $m = new _subcategory;
                                    $catid = 9;
                                    $result = $m->read($catid);
                                    if($result){
                                        while($rows = mysqli_fetch_assoc($result)){
											?>
                              <div class="heading03">
                                <h3 style="color: #0b241e;border-bottom: 1px solid #0b241e;"><?php echo $rows["subCategoryTitle"]; ?><span class="pull-right seemore">
 <a class="pull-right" href="https://dev.thesharepage.com/retail/view-all.php?condition=All&folder=retail&page=1" style="color: #0b241e;">See More</a></span></h3>
                              </div>

                        <div class="carousel carousel-showmanymoveone c_one slide" id="itemslider_one">
                                <div class="carousel-inner">
                              




                                     
                                  
                                 <div class="item active">
                                        <div class="col-xs-5ths">
                                          <!-- <div class="featured_box text-center"> -->
                                            <!-- <div class="featured_box " style="height:255px;">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                <a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=484">

                                     <img alt='Posting Pic' class='img-responsive' style='border-radius:5px;' src='https://storemodule.s3.ca-central-1.amazonaws.com/3759287222'>
                                               
                                              </a>
                                            </div>

                                            <ul style="padding-left: 10px;display: grid;">

                                              <li>
                                            <h4 style="background-color: unset;float: left;padding: 0px;">

                                                 <a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=484" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="dishwasher">Dishwasher</a>    
                                            
                                            </h4>
                                          </li>
                                            
                                            <li>
                                            <h5 style="float: left;">

<div class='postprice' style='' data-price='1200'>USD 1200</div><span class=''></span>
                                             
                                            </h5>
                                          </li>
                                            

                                                                         <li>
                        <p class="rating_box">
                          
                             <div class="rating-box">
                                      <div class="ratings" style="width:0%;"></div>
                                    </div>

                                
                            
                       <!--      <a href="#">(0)</a> -->
                    <!--     </p>
                                 </li>           
                                   </ul>
                                          </div>
                                        </div>
                                      </div>




                                       
                                  
                                 <div class="item ">
                                        <div class="col-xs-5ths">
                                          <!-- <div class="featured_box text-center"> -->
                                           <!--  <div class="featured_box " style="height:255px;">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                <a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=481">

                                     <img alt='Posting Pic' class='img-responsive' style='border-radius:5px;' src='https://event11.s3.ca-central-1.amazonaws.com/7174008091'>
                                               
                                              </a>
                                            </div>

                                            <ul style="padding-left: 10px;display: grid;">

                                              <li>
                                            <h4 style="background-color: unset;float: left;padding: 0px;">

                                                 <a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=481" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="Agra fort">Agra Fort</a>    
                                            
                                            </h4>
                                          </li>
                                            
                                            <li>
                                            <h5 style="float: left;">

<div class='postprice' style='' data-price='500'>USD 500</div><span class=''></span>
                                             
                                            </h5>
                                          </li>
                                            

                                                                         <li>
                        <p class="rating_box">
                          
                             <div class="rating-box">
                                      <div class="ratings" style="width:0%;"></div>
                                    </div>

                                
                            
                       <!--      <a href="#">(0)</a> -->
                       <!--  </p>
                                 </li>           
                                   </ul>
                                          </div>
                                        </div>
                                      </div>




                                       
                                  
                                 <div class="item ">
                                        <div class="col-xs-5ths">
                                          <!-- <div class="featured_box text-center"> -->
                                        <!--     <div class="featured_box " style="height:255px;">
                                            <div class="img_fe_box" style="border: 0px solid #ccc;">
                                <a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=463">

                                     <img alt='Posting Pic' src='https://dev.thesharepage.com/assets/images/blank-img/xno-store.png.pagespeed.ic.32z1jkxJGT.webp' class='img-responsive' style='border-radius:5px;'>
                                               
                                              </a>
                                            </div>

                                            <ul style="padding-left: 10px;display: grid;">

                                              <li>
                                            <h4 style="background-color: unset;float: left;padding: 0px;">

                                                 <a href="https://dev.thesharepage.com/store/detail.php?catid=1&postid=463" style="color: #0b241e;font-weight: 600;" data-toggle="tooltip" title="Demo">Demo</a>    
                                            
                                            </h4>
                                          </li>
                                            
                                            <li>
                                            <h5 style="float: left;">

<div class='postprice' style='' data-price='500'>USD 500</div><span class=''></span>
                                             
                                            </h5>
                                          </li>
                                            

                                                                         <li>
                        <p class="rating_box">
                          
                             <div class="rating-box">
                                      <div class="ratings" style="width:0%;"></div>
                                    </div>

                                
                            
                       <!--      <a href="#">(0)</a> -->
                        <!-- </p>
                                 </li>           
                                   </ul>
                                          </div>
                                        </div>
                                      </div>










                                                                         
                                </div>
								<?php
										}
									}
								?>

                                <div id="slider-control" class="scndSlideStr">
                                  <a class="left carousel-control" href="#itemslider_one" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_one" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            

                            </div>
                            </div>  -->

                          <!-- Retail Close -->      


                <div class="row">
                    <div class="col-md-12">
                        <div class="titleEvent text-center">
                            <h2>Upcoming <span>Events</span></h2>
                            <p>Your local upcoming events</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php

                    $start = 0;
                    $limit = 2;
                    $count = 1;
                    //$p      = new _postingview;
                      $p      = new _spevent;
                   // $pf     = new _spevent;

                    // $e = getall_event
                    /* $pf     = new _spevent;*/


                    
                    
                    
                    $res    = $p->publicpost_eventnew($_GET["categoryID"]);
                    //echo $p->ta->sql;
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { 
                              $venu = $row['spPostingEventVenue'];
                                     $startDate = $row['spPostingStartDate'];
                                     $startTime = $row['spPostingStartTime'];
                                     $endTime = $row['spPostingEndTime'];

                                     $dtstrtTime = strtotime($startTime);
                                     $dtendTime = strtotime($endTime);
                           /* echo"<pre>";
                            print_r($row);*/
                            //posting fields
                           /* $result_pf = $p->read($row['idspPostings']);
                            echo $pf->ta->sql."<br>";
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
                               
                            }*/
                            ?>
                            <div class="col-md-4">
                    <div class="upEventBox upcomingbox" style="width: 90%; margin-left: 22px;border:1px solid darkgray;">

                         <?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>
                        
                        <!-- <div class="eidt-con">
  <a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
</div>
 -->
                            <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class="eventcapitalize">

                          <?php }else{ ?>
                                 
                                   <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

                             <?php } ?>

                                        <?php
                                        $pic = new _eventpic;
                                        
                                        $res2 = $pic->readFeature($row['idspPostings']);
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src='" .$pic2. "'  >"; 
                                                } else{
                                                    echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
                                                }
                                            }else{
                                                $res2 = $pic->read($row['idspPostings']);
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive upcomingimg eventimg' src='".$pic2. "' >"; 
                                                } else{
                                                    echo "<img alt='Posting Pic' src='../img/noevent.jpg' class='img-responsive upcomingimg eventimg'>"; 
                                                }
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
                                         ?>
                                    </a>
                                    <div class="bodyEventBox" style="min-height: 252px;">
                                        <?php
                                        if(!empty($startDate)){
                                            echo $start_date;
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
                                        <span class="datetop pull-right" ><?php echo $month.' '.$day;?><?php echo ' '.$weak;?></span>
                                             <?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

                            <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class="eventcapitalize">

                          <?php }else{ ?>
                                 
                                   <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="eventcapitalize">

                             <?php } ?>
                                       <!--  <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class="eventcapitalize"> -->

                                            <?php echo $row['spPostingTitle'];?></a>
                                        <span  class="" style="margin-left: 0px;min-height: 20px!important;"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
                                        <p class="text-justify eventcapitalize" style="min-height: 18px!important;word-break: break-word;">
                                            <?php
                                            if(strlen($row['spPostingNotes']) < 50){
                                                echo $row['spPostingNotes'];
                                            }else{
                                                echo substr($row['spPostingNotes'], 0,170)."...";
                                            } ?>
                                        </p>
                                        <?php
                                        $area2 = "";
                                        $area1 = "";
                                        $area0 = "";
                                        $title = "";
                                        $ei = new _eventIntrest;
                                        $result = $ei->chekAlready($row['idspPostings'], $_SESSION['pid']);
                                        if($result != false){
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
                                        }

                                          $ie = new _eventIntrest;
                                                                        $resulti1 = $ie->chekGoing($row['idspPostings'], 2);
                                                                       // echo $ie->ta->sql;
                                                                        if($resulti1 != false && $resulti1->num_rows >0){
                                                                        $going = $resulti1->num_rows;
                                                                        }else{
                                                                          $going =  0;
                                                                        }

                                                                           $resulti2 = $ie->chekGoing($row['idspPostings'], 1);
                                                                       // echo $ie->ta->sql;
                                                                        if($resulti2 != false && $resulti2->num_rows >0){
                                                                        $interested = $resulti2->num_rows;
                                                                        }else{
                                                                          $interested =  0;
                                                                        }


                                                                          $resulti3 = $ie->chekGoing($row['idspPostings'], 0);
                                                                       // echo $ie->ta->sql;
                                                                        if($resulti3 != false && $resulti3->num_rows >0){
                                                                        $MayBe = $resulti3->num_rows;
                                                                        }else{
                                                                          $MayBe =  0;
                                                                        }
                                        ?>
                                        <div class="ie_<?php echo $row['idspPostings'];?>">
                                            <div class="dropdown intrestEvent" style="display: inline">

                                                 <?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>
                            <button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>

                             <?php  }else{ ?>

                                 <button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle='modal' data-target='#alertNotEmpProfile' aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button>
                              <?php
                            }
							$po = new _spevent;
							$resultt = $po->singletimelines($row['idspPostings']);
        //echo $po->ta->sql;
		
        if($resultt != false){
            $row33 = mysqli_fetch_assoc($resultt);
             $Organizername = $row33['spPostingEventOrgName'];
			echo "<br>";
			echo "<br>";
			echo "<strong>" .$Organizername."</strong>";
		}
                            ?>


                                            <!--   <button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button> -->

                                               <!--  <button class="btn btn_group_join dropdown-toggle eventiconbtn " type="button" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-star" aria-hidden="true" style="margin: 0px;"></i> <?php echo $title;?></button> -->
                                                <ul class="dropdown-menu ">
                                                    <li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="2"><?php echo $area2;?> Going (<?php echo $going; ?>)</a></li>
                                                    <li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="1"><?php echo $area1;?> Interested (<?php echo $interested; ?>)</a></li>
													
													       <label style="margin-left: 15px;">Organizer (s):</label>
 
                                                                <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $Organizername;?></a>
													
                                                    <li><a href="javascript:void(0)" class="intestDetail" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $row['idspPostings'];?>" data-area="0"><?php echo $area0;?> May Be (<?php echo $MayBe; ?>)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="footEventBox footupcoming">
                                        <p><span class="date"  style="margin-left: 10px;"><i class="fa fa-calendar" style="font-size: 15px;"></i> <?php echo $startDate;?>  | <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span></p>
                                    </div>
                                </div>
                            </div> <?php
                            $count++;
                            if($count > 3){
                                break;
                            }
                        }
                    }else{
                        echo"<h3 class='text-center'>No Record Found!</h3>";
                    }
                    ?>
                    
                    <div class="col-md-12 text-center">
                        <div class="viewAllEvent">
                              <?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>
                         
                          <a href="<?php echo $BaseUrl.'/events/all-event.php';?>" class="btn btn_event viewallbtn">View All</a>

                             <?php  }else{ ?>

                               <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' class="btn btn_event viewallbtn">View All</a> 

                              <?php
                            }
                            
                            ?>


                           
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="UpcomingSec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="titleEvent text-center">
                            <h2>Event <span>Schedule</span></h2>
                            <p>Your local upcoming events</p>
                        </div>
                    </div>
                </div>
                <div class="row bg_white no-margin schedulecontainer" >
                    <div class="col-md-12 no-padding">
                        <div class="">
                            <div class="board">
                                <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                                <div class="board-inner">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <?php
                                        $arrWeek = array("sun", "mon", "tue", "wed", "thu", "fri", "sat");
                                        ?>
             <li class="active" style="padding: 10px 8px;">
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

                                        <li style="padding: 10px 8px;">
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
                                        <li style="padding: 10px 8px;">
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

                                        <li style="padding: 10px 8px;">
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

                                        <li style="padding: 10px 8px;">
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
                                         <li style="padding: 10px 8px;">
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
                                         <li style="padding: 10px 8px;">
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
        
<!--         <section class="EventregisterBox">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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
                        <div class="col-md-12 text-center">
                            <input type="submit" name="" value="Register" class="btn registerbtn">
                        </div>
                    </form>
                    
                </div>
            </div>
        </section> -->
        <!-- <section class="eventGallery">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
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
                    $p      = new _spevent;
                    $res    = $p->publicpost($start, $_GET["categoryID"]);
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { ?>
                            
                                        <?php
                                        $pic = new _eventpic;
                                        $res2 = $pic->read($row['idspPostings']);
                                        if ($res2 != false) {
                                            while ($rp = mysqli_fetch_assoc($res2)) {

                                           // $rp = mysqli_fetch_assoc($res2);
                                            ?>

                                            <div class="col-md-3">
                                <div class="EvntImg">


                                    <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" >

                                <?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

                            <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" >

                          <?php }else{ ?>
                                 
                                   <a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' >

                             <?php } ?>




                                        <?php
                                            
                                            $pic2 = $rp['spPostingPic'];
                                            echo "<img alt='Posting Pic' class='img-responsive  btn-border-radius'  src=' " . ($pic2) . "' >"; ?>
                                                </a>
                                </div>
                            </div> 
                                            <?php
                                        } 

                                    }

                                    ?>
                                <?php
                            $count++;
                            if($count > 8){
                                break;
                            }
                        }
                    }else{
                        echo"<h3 class='text-center'>No Record Found!</h3>";
                    }
                    ?>
                    
                            

                </div>
            </div>
        </section> -->
        
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}
?>