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
    $activePage = 1;
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- this script for slider art -->
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Dashboard</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="main_box no-padding">
            
            <div class="container eventExplrthefun">
                <?php include('top-button-dashboard.php'); ?>
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
                <div class="row">
                    <div class="col-md-12 eventDashboard no-padding">
                        <nav class="navbar navbar_free">
                            <div class="container-fluid nopadding">
                                <!-- Brand and toggle get grouped for better mobile display -->
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>

                                <?php
                                include('top-dashboard.php');
                                ?>
                            </div><!-- /.container-fluid -->
                        </nav>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table tabe-striped eventTable">
                                <thead>
                                    <tr>
                                        <th>Event Title</th>
                                        <th>Price</th>
                                        <th>Start Date</th>
                                        <th>Start Time</th>
                                        <th>Category</th>
                                        <th class="text-center">Purchase Tickets</th>
                                        <th class="text-center">Intrested</th>
                                        <th class="text-center">Going</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p      = new _postingview;
                                    $pf     = new _postfield;
                                    $res    = $p->publicpost_event($_GET["categoryID"]);
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
                                                $catName = "";
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
                                                    if($catName == ''){
                                                        if($row2['spPostFieldName'] == 'eventcategory_'){
                                                            $catName = $row2['spPostFieldValue'];

                                                        }
                                                    }
                                                }
                                                $dtstrtTime = strtotime($startTime);
                                                $dtendTime = strtotime($endTime); ?>
                                                <tr>
                                                    <td><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a></td>
                                                    <td><?php echo ($row['spPostingPrice'] > 0)? '$'.$row['spPostingPrice']:'Free';?></td>
                                                    <td><?php echo $startDate;?></td>
                                                    <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                                                    <td><?php echo $catName;?></td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="1" >
                                                        <?php
                                                        $ie = new _eventIntrest;
                                                        $result = $ie->chekGoing($row['idspPostings'], 1);
                                                        if($result != false && $result->num_rows >0){
                                                            echo $result->num_rows;
                                                        }else{
                                                            echo 0;
                                                        }
                                                        ?>
                                                        </a>  
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" data-toggle='modal' data-target='#loaddetail' class="eventDetail" data-postid="<?php echo $row['idspPostings'];?>" data-pid="<?php echo $row['idspProfiles'];?>" data-intrest="2" >
                                                        <?php
                                                        $ie = new _eventIntrest;
                                                        $result = $ie->chekGoing($row['idspPostings'], 2);
                                                        if($result != false && $result->num_rows >0){
                                                            echo $result->num_rows;
                                                        }else{
                                                            echo 0;
                                                        }
                                                        ?>
                                                        </a>
                                                    </td>
                                                    <td><a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i class="fa fa-edit"></i> Edit</a></td>
                                                </tr> <?php
                                            }
                                        }
                                    } ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php 
        include('loaddetail.php');
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
