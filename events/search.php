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
    

     if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }

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
.dropdown-menu {
		    border: none;
	}
	#profileDropDown li.active {
    background-color: #c11f50;
}
#profileDropDown li.active a {
    color: #fff;
}
</style>
    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>Search Events</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="main_box no-padding">
            
            <div class="container eventExplrthefun explorecontainer">
                <div class="row">
                    <div class="col-sm-12">
                        
                        <div class="col-md-6 no-padding">
                          <ol class="breadcrumb"  style="padding: 8px 0px;margin-bottom: 20px!important;list-style: none;background-color: unset!important;border-radius: 4px;">
                                  <li><a href="<?php echo $BaseUrl ?>/events"><i class="fa fa-home"></i> Home</a></li>
                                  <li class="active">Search Event</li>
                          </ol>
                        </div>

                     
                    <div class="col-md-6 no-padding">
                        <div class="topBoxEvent text-right">
                           <a href="<?php echo $BaseUrl.'/events';?>" class="btn butn_cancel homecancelbtn  btn-border-radius"><i class="fa fa-home"></i>Home</a>

                           <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save submitevent btn-border-radius">Submit an event</a>

                           <a href="<?php echo $BaseUrl.'/events/dashboard/';?>" class="btn butn_cancel eventdashboard  btn-border-radius"><i class="fa fa-dashboard "></i> Dashboard</a>
                            

                        </div>

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
               <!--  <div class="row">
                    <div class="col-md-12">
                        <div class="titleEvent text-center">
                            <h2><span>Events</span></h2>
                            <p>Pellentesque id felis ut neque malesuada maximus quis id arcu</p>
                        </div>
                    </div>
                </div> -->
                <div class="row">
                    <?php
                    $p      = new _spevent;
                   // $pf     = new _postfield;
                    if(isset($_POST['txttitle']) && $_POST['txttitle'] != ''){
                        $txttitle       = $_POST['txttitle'];
                        $txtDate        = $_POST['txtDate'];
                        $txtCategory    = $_POST['txtCategory'];
                        $txtLocation    = $_POST['txtLocation'];
                        if($txttitle != '' AND $txtDate != '' AND $txtCategory != '' AND $txtLocation != ''){
                            $res = $p->searchEvent($_GET["categoryID"], $txttitle, $txtDate, $txtCategory, $txtLocation,$countery,$state);
                        }else{
                            $res = $p->searchEvent($_GET["categoryID"], $txttitle, $txtDate, $txtCategory, $txtLocation,$_SESSION['spPostCountry'], $_SESSION['spPostState']);
                        }
                       //echo $p->ta->sql;
                        //die("===");
                    }
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { 
						//print_r($row);


                             $venu = "";
                            $startDate = "";
                            $startTime    = "";
                            $endTime = "";
                            $OrganizerName = "";


                             $venu = $row['spPostingEventVenue'];
                                     $startDate = $row['spPostingStartDate'];
                                     $startTime = $row['spPostingStartTime'];
                                     $endTime = $row['spPostingEndTime'];
                                     $OrganizerName = $row2['spPostingEventOrgName'];

                                     $dtstrtTime = strtotime($startTime);
                                     $dtendTime = strtotime($endTime);
                            //posting fields
                            //$result_pf = $pf->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                            /*if($result_pf){
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
                            <div class="col-md-4" >
                                <div class="upEventBox upcomingbox">
                                    <div class="mainOverlay">
                                        <?php
                                        $pic = new _eventpic;
                                        $res2 = $pic->read($row['idspPostings']);
                                        if ($res2 != false) {
                                          // echo $rp['spPostingPic'];
                                            $rp = mysqli_fetch_assoc($res2);
											//print_r($rp);
                                            $pic2 = $rp['spPostingPic'];
                                            echo "<img alt='Posting Pic' class='img-responsive upcomingimg' src=' " . ($pic2) . "' >"; ?>
                                            <div class="overlay">
                                                <div class="text">
                                                    <a href='<?php echo ($pic2);?>' class='test-popup-link btn' title='<?php echo $row['spPostingtitle']; ?>'><i class="fa fa-search-plus"></i></a>
                                                    <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>" class="btn viewPage"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </div> <?php
                                        
                                        } else {

                                            echo "<a href='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='test-popup-link' title='".$row['spPostingtitle']."'><img alt='Posting Pic' src='../img/xnoevent.jpg.pagespeed.ic.VLoUF7pX4o.webp' class='img-responsive upcomingimg'></a>"; ?>
                                           
                                            <div class="overlay">
                                                
                                                <div class="text">No Image</div>
                                           
                                            </div> 

                                     <?php
                                        } 
                                     ?>
                                    </div>
                                    <div class="bodyEventBox">
                                        <a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a>
                                        <span  class="text-left"><i class="fa fa-map-marker"></i> <?php echo $venu;?></span>
                                         <!-- <p class="text-justify" style="overflow:hidden;">
                                            <?php
                                            if(strlen($row['spPostingNotes']) < 170){
											
                                                echo $row['spPostingNotes'];
                                            }else{
                                                echo substr($row['spPostingNotes'], 0,170)."...";
                                                
                                            } ?>
                                        </p>  -->

                                        <span>

                                        <?php
                                            if(strlen($row['spPostingNotes']) < 170){
											
                                                echo $row['spPostingNotes'];
                                            }else{
                                                echo substr($row['spPostingNotes'], 0,170)."...";
                                                
                                            } ?>


                                        </span>



                                    </div>
									<?php 
										
										$s2=$p->read_favorite_event($row['idspPostings']);
										$view=$s2->num_rows;
										?>
                                    <div class="footEventBox footupcoming">
                                        <p><span class="date"><i class="fa fa-calendar"></i> <?php echo $startDate;?>  | <?php echo date("h:i A", $dtstrtTime); ?> - <?php echo date("h:i A", $dtendTime);?></span><span><//i class="fa fa-heart"></i><?//php echo $view;?></span></p>
                                    </div>
                                </div>
                            </div> <?php
                        }
                    }else{

                    	echo "<h3 style='text-align: center;'>No Record Found!</h3>";
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
