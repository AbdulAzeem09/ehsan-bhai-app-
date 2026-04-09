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
    $activePage = 6;
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
                        <h3>Bookmark Event</h3>
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
                                <div class="table-responsive bg_white">
                                    <table class="table table-striped eventTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Event Title</th>
                                                <th>Price</th>
                                                <th>Start Date</th>
                                                <th>Start Time</th>
                                                <th>Category</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $p      = new _postingview;
                                            $pf     = new _postfield;
                                            
                                            $res = $p->event_favorite($_GET["categoryID"], $_SESSION['pid']);
                                            //$res = $p->pastEvent($_GET['categoryID'], $today);
                                            //$res = $p->draftEvent($_GET['categoryID']);
                                            //echo $p->ta->sql;
                                            if($res != false){
                                                $i = 1;
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
                                                        $strDate = new DateTime($startDate);


                                                        $dtstrtTime = strtotime($startTime);
                                                        $dtendTime = strtotime($endTime); ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?></a></td>
                                                            <td><?php echo ($row['spPostingPrice'] > 0)? '$'.$row['spPostingPrice']:'Free';?></td>
                                                            <td><?php echo $strDate->format('d-M-Y');?></td>
                                                            <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                                                            <td><?php echo $catName;?></td>
                                                            <!-- <td><a href="<?php echo $BaseUrl.'/post-ad/events/?postid='.$row['idspPostings']; ?>" class="" data-postid="<?php echo $row['idspPostings'];?>"><i class="fa fa-edit"></i> Edit</a></td> -->
                                                        </tr> <?php
                                                        $i++;
                                                    }
                                                }
                                            }  ?>
                                            
                                            
                                        </tbody>
                                    </table>
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
