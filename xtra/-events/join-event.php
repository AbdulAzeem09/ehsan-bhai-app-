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
    $activePage = 6;
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
                        <h3>Join Event</h3>
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
                                        <th>Start Date</th>
                                        <th>Start Time</th>
                                        <th>Category</th>
                                        <th class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $p      = new _postingview;
                                    $pf     = new _postfield;
                                    $ej     = new _eventJoin;
                                    $joinPost = array();
                                    //get all post id from organizer id
                                    $res = $p->getOrganzerPost($_GET['categoryID'], $_SESSION['pid']);
                                    if($res != false){
                                        while ($row = mysqli_fetch_assoc($res)) {
                                            //array_push($joinPost, $row['idspPostings']);
                                            $res3 = $ej->chekEventExixt($row['idspPostings'], 1, $_SESSION['pid']);
                                            if($res3 != false){
                                                //exist krta ha to show ni ho ga.
                                            }else{
                                                //agr exixt ni krta to show ho jaen ga.
                                                $res4 = $p->singletimelines($row['idspPostings']);
                                                if($res4 != false){
                                                    $row4 = mysqli_fetch_assoc($res4);
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
                                                            <td><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row4['idspPostings'];?>"><?php echo $row4['spPostingtitle'];?></a></td>
                                                            <td><?php echo $startDate;?></td>
                                                            <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                                                            <td><?php echo $catName;?></td>
                                                            <td class="text-center"><a href="<?php echo $BaseUrl.'/events/aprove.php?org=1&postid='.$row4['idspPostings'].'&pid='.$_SESSION['pid'].'&stat=1';?>">Aprove</a> | <a href="<?php echo $BaseUrl.'/events/aprove.php?org=1&postid='.$row4['idspPostings'].'&pid='.$_SESSION['pid'].'&stat=0';?>">Reject</a></td>
                                                        </tr> <?php
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    //get all sponsor ids
                                    $res2 = $p->getCoHostPost($_GET['categoryID'], $_SESSION['pid']);
                                    if($res2 != false){
                                        while ($row3 = mysqli_fetch_assoc($res2)) {
                                            $res3 = $ej->chekEventExixt($row3['idspPostings'], 2, $_SESSION['pid']);
                                            if($res3 != false){
                                                //exist krta ha to show ni ho ga.
                                            }else{
                                                //agr exixt ni krta to show ho jaen ga.
                                                $res4 = $p->singletimelines($row3['idspPostings']);
                                                if($res4 != false){
                                                    $row4 = mysqli_fetch_assoc($res4);
                                                    //posting fields
                                                    $result_pf = $pf->read($row3['idspPostings']);
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
                                                            <td><a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row4['idspPostings'];?>"><?php echo $row4['spPostingtitle'];?></a></td>
                                                            <td><?php echo $startDate;?></td>
                                                            <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                                                            <td><?php echo $catName;?></td>
                                                            <td class="text-center"><a href="<?php echo $BaseUrl.'/events/aprove.php?org=2&postid='.$row4['idspPostings'].'&pid='.$_SESSION['pid'].'&stat=1';?>">Aprove</a> | <a href="<?php echo $BaseUrl.'/events/aprove.php?org=2&postid='.$row4['idspPostings'].'&pid='.$_SESSION['pid'].'&stat=0';?>">Reject</a></td>
                                                        </tr> <?php
                                                    }
                                                }
                                            }

                                        }
                                    }
                                    
                                     ?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
