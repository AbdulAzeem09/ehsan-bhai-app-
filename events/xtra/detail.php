<?php 
    include('../../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../../authentication/check.php");
        $_SESSION['afterlogin'] = "../timeline/";
    }
    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";


    if (isset($_GET['postid']) && $_GET['postid'] >0) {
        $p = new _postingview;
        $pf  = new _postfield;

        $result = $p->singletimelines($_GET['postid']);
        //echo $p->ta->sql;
        if($result != false){
            $row = mysqli_fetch_assoc($result);
            $ProTitle   = $row['spPostingtitle'];
            $ProDes     = $row['spPostingNotes'];
            $ArtistName = $row['spProfileName'];
            $ArtistId   = $row['idspProfiles'];
            $ArtistAbout= $row['spProfileAbout'];
            $ArtistPic  = $row['spProfilePic'];
            $price      = $row['spPostingPrice'];
            $country    = $row['spPostingsCountry'];
            $city      = $row['spPostingsCity'];
            $expDate    = $row['spPostingExpDt'];

            $pr = new _spprofilehasprofile;
            $result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
            if($result3 == 0){
              $level = '1st Connection';
            }else if($result3 == 1){
              $level = '1st Connection';
            }else if($result3 == 2){
              $level = '2nd Connection';
            }else if($result3 == 3){
              $level = '3rd Connection';
            }else{
              $level = 'Not Define';
            }

            $result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
            if($result_pf){
                $venu = "";
                $startDate = "";
                $endDate = "";
                $startTime    = "";
                $endTime = "";
                $OrganizerId = "";
                $Quantity = '';
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
                    if($endDate == ''){
                        if($row2['spPostFieldName'] == 'spPostingEndDate_'){
                            $endDate = $row2['spPostFieldValue'];

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
                    if($OrganizerId == ''){
                        if($row2['spPostFieldName'] == 'spPostingEventOrgId_'){
                            $OrganizerId = $row2['spPostFieldValue'];

                        }
                    }
                    if($Quantity == ''){
                        if($row2['spPostFieldName'] == 'ticketcapacity_'){
                            $Quantity = $row2['spPostFieldValue'];

                        }
                    }
                }
                $sdt = new DateTime($startDate);
                $dtstrtTime = strtotime($startTime);
                $dtendTime = strtotime($endTime);
            }
        }

        

    }else{
        $re = new _redirect;
        $redirctUrl = $BaseUrl."/events";
        $re->redirect($redirctUrl);
    }

    if(isset($_GET['visibility']) && $_GET['visibility'] == -1){
        $visibil = 1;
    }else{
        $visibil = 0;
    }
    $activePage = 2;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        
    </head>

    <body class="bg_gray">
        <?php include_once("../../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>Event Detail</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="m_top_15">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_event_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="main_box eventExplrthefun" >
                            <?php include('../top-button-dashboard.php'); ?>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="eventDashDetail bg_white">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h2>Title: <span><?php echo ucwords(strtolower($ProTitle));?></span></h2>
                                            <p><i class="fa fa-map-marker"></i> <?php echo $venu;?></p>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <h2>Date: <span><?php echo $sdt->format('d-M-Y'); ?></span></h2>
                                        </div>
                                    </div>
                                    <?php
                                    $or = new _order;
                                    $result4 = $or->readMyEventTkt($_SESSION['pid'], $_GET['categoryID'], $_GET['postid']);
                                    if ($result4) {
                                        $totSoldTkt = $result4->num_rows;
                                    }else{
                                        $totSoldTkt = 0;
                                    }
                                    ?>
                                    <h2>Event Detail</h2>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="small-box bg-green">
                                                <div class="inner">
                                                  <h3><?php echo $totSoldTkt + $Quantity; ?></h3>
                                                  <p>Total Tickets To Sale</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-ticket"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="small-box bg-aqua">
                                                <div class="inner">
                                                  <h3><?php echo $totSoldTkt; ?></h3>
                                                  <p>Total Sold Tickets</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-ticket"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="small-box bg-yellow">
                                                <div class="inner">
                                                  <h3><?php echo $Quantity; ?></h3>
                                                  <p>Total Remaining Tickets</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-ticket"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="small-box bg-red">
                                                <div class="inner">
                                                  <h3><?php echo $totSoldTkt * $price; ?></h3>
                                                  <p>Total money collected</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa fa-dollar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <p><?php echo $ProDes; ?></p>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>Start Date</strong></td>
                                                            <td><?php echo $sdt->format('d-M-Y'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Start Time</strong></td>
                                                            <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Ticket Price</strong></td>
                                                            <td>$<?php echo $price; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Organizers</strong></td>
                                                            <td>
                                                                <?php
                                                                $pf  = new _postfield;
                                                                $pro = new _spprofiles;
                                                                $ei  = new _eventJoin;
                                                                $limit = 0;
                                                                if(isset($_GET['postid']) && $_GET['postid'] > 0){
                                                                    $fieldName = "spPostingCohost_";
                                                                    $result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
                                                                    //echo $pf->ta->sql."<br>";
                                                                    if($result6 != false){
                                                                        while ($row6 = mysqli_fetch_assoc($result6)) {
                                                                            if($row6['spPostFieldValue'] != ''){
                                                                                $profileId = $row6['spPostFieldValue'];
                                                                                $result7 = $pro->read($profileId);
                                                                                if($result7 != false){
                                                                                    $row7 = mysqli_fetch_assoc($result7);
                                                                                    ?>
                                                                                    <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $row7['spProfileName'];?></a>,
                                                                                    <?php
                                                                                    $limit++;
                                                                                    if($limit == 3){
                                                                                        break;
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <td><strong>End Date</strong></td>
                                                            <td><?php echo $expDate; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>End Time</strong></td>
                                                            <td><?php echo date("h:i A", $dtendTime); ?></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><strong>Ticket Quantity</strong></td>
                                                            <td><?php echo $Quantity; ?></td>
                                                        </tr>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h2><span>Tickets Purchase Detail</span></h2>
                                            <div class="table-responsive tkttab">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Buyer</th>
                                                            <th>Price</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $or = new _order;
                                                        $pro = new _spprofiles;
                                                        $i = 1;
                                                        $result4 = $or->readMyEventTkt($_SESSION['pid'], $_GET['categoryID'], $_GET['postid']);
                                                        //echo $or->ta->sql;
                                                        if ($result4) {
                                                            while ($row4 = mysqli_fetch_assoc($result4)) {
                                                                $dt = new DateTime($row4['sporderdate']);
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $i; ?></td>
                                                                    <td>
                                                                        <?php 
                                                                        $result5 = $pro->read($row4['spByuerProfileId']);
                                                                        if ($result5) {
                                                                            $row5 = mysqli_fetch_assoc($result5);
                                                                            ?>
                                                                            <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$row4['spByuerProfileId'];?>"><?php echo $row5['spProfileName'];?></a>,
                                                                            <?php
                                                                        }
                                                                        ?>                                                                            
                                                                    </td>
                                                                    <td>$<?php echo $row4['sporderAmount']; ?></td>
                                                                    <td><?php echo $dt->format('d-M-Y'); ?></td>
                                                                </tr> <?php
                                                                $i++;
                                                            }
                                                        } ?>
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h2><span>Gallery</span></h2>
                                            <div class="row">
                                                <?php
                                                $pic = new _postingpic;
                                                $res2 = $pic->read($_GET['postid']);
                                                if ($res2 != false) {
                                                    while ($rp = mysqli_fetch_assoc($res2)) {
                                                        $pic2 = $rp['spPostingPic'];
                                                        ?>
                                                        <div class="col-md-3">
                                                            <div class="EvntImg">
                                                                <a class="thumbnail" rel="" href="javascript:void(0)" title="<?php echo $ProTitle;?>">
                                                                    <img class="group1" src="<?php echo ($pic2);?>">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }                        
                                                } ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <h2><span>Sponsor</span></h2>
                                            <div class="row">
                                                <?php
                                                $pf  = new _postfield;
                                                $pro = new _spprofiles;
                                                $spo = new _sponsorpic;
                                                
                                                $result6 = $pf->readSponsorPost($_GET['postid']);
                                                //echo $pf->ta->sql."<br>";
                                                if($result6){
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        
                                                        if($row6['spPostFieldValue'] != ''){
                                                            $sponsorId = $row6['spPostFieldValue'];
                                                            $result8 = $spo->readSponsor($sponsorId);
                                                            //echo $spo->ta->sql;
                                                            if($result8){
                                                                $row8 = mysqli_fetch_assoc($result8);
                                                                ?>
                                                                <div class="col-md-4">
                                                                    <div class="row m_btm_20" >
                                                                        <div class="col-md-3">
                                                                            <img src="<?php echo ($row8['sponsorImg']);?>" class="img-responsive" alt="">
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <h3><?php echo $row8['sponsorTitle'];?></h3>
                                                                            <a href="<?php echo $row8['sponsorWebsite'];?>" target="_blank"><?php echo $row8['sponsorWebsite'];?></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h2><span>Featuring</span></h2>
                                            <div class="row">
                                                <?php
                                                $pf  = new _postfield;
                                                $pro = new _spprofiles;
                                                $result6 = $pf->readFeaturPost($_GET['postid']);
                                                //echo $pf->ta->sql."<br>";
                                                if($result6 != false){
                                                    while ($row6 = mysqli_fetch_assoc($result6)) {
                                                        if($row6['spPostFieldValue'] != ''){
                                                            $profileId = $row6['spPostFieldValue'];
                                                            $result7 = $pro->read($profileId);
                                                            if($result7 != false){
                                                                $row7 = mysqli_fetch_assoc($result7);
                                                                ?>
                                                                <div class="col-md-3">
                                                                    <div class="featuringBox row bg_white no-margin">
                                                                        <a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
                                                                            <div class="col-md-3 no-padding">
                                                                                <?php 
                                                                                echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                                                                ?>
                                                                            </div>
                                                                            <div class="col-md-9 no-padding">
                                                                                <h4><?php echo $row7['spProfileName'];?></h4>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <h2><span>Contact Organizer's</span></h2>
                                            <div class="row">
                                                <?php
                                                //organizer id......
                                                $pro = new _spprofiles;
                                                $result7 = $pro->read($OrganizerId);
                                                if($result7 != false){
                                                    $row7 = mysqli_fetch_assoc($result7);
                                                    ?>
                                                    <div class="col-md-3">
                                                        <div class="featuringBox row bg_white no-margin">
                                                            <a href="<?php echo $BaseUrl.'/friends/?profileid='.$OrganizerId;?>">
                                                                <div class="col-md-3 no-padding">
                                                                    <?php 
                                                                    echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-9 no-padding">
                                                                    <h4><?php echo $row7['spProfileName'];?></h4>
                                                                </div>
                                                            </a>
                                                            <div class="col-sm-12">
                                                                <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms">Contact Organizer</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } 
                                                //co-Host persons.
                                                $pf  = new _postfield;
                                                $pro = new _spprofiles;
                                                $ei  = new _eventJoin;
                                                if(isset($_GET['postid']) && $_GET['postid'] > 0){
                                                    $fieldName = "spPostingCohost_";
                                                    $result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
                                                    //echo $pf->ta->sql."<br>";
                                                    if($result6 != false){
                                                        while ($row6 = mysqli_fetch_assoc($result6)) {
                                                            if($row6['spPostFieldValue'] != ''){
                                                                $profileId = $row6['spPostFieldValue'];
                                                                $result7 = $pro->read($profileId);
                                                                if($result7 != false){
                                                                    $row7 = mysqli_fetch_assoc($result7);
                                                                    ?>
                                                                    <div class="col-md-3">
                                                                        <div class="featuringBox row bg_white no-margin">
                                                                            <a href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>">
                                                                                <div class="col-md-3 no-padding">
                                                                                    <?php 
                                                                                    echo "<img  alt='profile-Pic' class='img-responsive' src='".(isset($row7['spProfilePic'])?" ".($row7['spProfilePic'])."":"../img/default-profile.png")."'>";
                                                                                    ?>
                                                                                </div>
                                                                                <div class="col-md-9 no-padding">
                                                                                    <h4><?php echo $row7['spProfileName'];?></h4>
                                                                                </div>
                                                                            </a>
                                                                            <div class="col-sm-12">
                                                                                <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $profileId; ?>" data-sender="<?php echo $_SESSION['pid'];?>" class="sendasms getCntactid">Contact Organizer</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- <a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$profileId;?>"><?php echo $row7['spProfileName'];?></a>, -->
                                                                    <?php
                                                                }
                                                                
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                                

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="space"></div>


        <?php
        include('../../component/footer.php');
        include('../../component/btm_script.php'); 
        ?>
    </body>
</html>
