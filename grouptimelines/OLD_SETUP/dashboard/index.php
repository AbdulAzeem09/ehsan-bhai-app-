<?php 
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 

    $_SESSION['afterlogin']="event/";
    include_once ("../../authentication/islogin.php");
    
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }


    spl_autoload_register("sp_autoloader");
    if (!isset($_SESSION['pid'])) {
        include_once ("../../authentication/check.php");
        $_SESSION['afterlogin'] = "../timeline/";
    }

    $_GET["categoryid"] = $_GET["categoryID"] = "10";
    $_GET["categoryName"] = "GroupEvents";
  //  $header_event = "events";
    $activePage = 1;

     
       if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/grouptimelines");
    }





    //print_r($_SESSION['pid']);
?>



<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
    </head>

    <body class="bg_gray">
        <?php include_once("../../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h3>Dashboard</h3>
                    </div>
                </div>
            </div>
        </section>
        <section class="m_top_15">
            <div class="container">
                <div class="row">
                    
                        
                    
                    <div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar">
                      <!--   <div class="left_event_top"> -->
                        <?php include('left-menu.php'); ?> 
                    <!-- </div> -->
                    </div>

                    <div class="col-md-10">
                        
                        <div class="row">
                            <?php
                            $or = new _orderSuccess;
                            $result8 = $or->readMyBalance($_SESSION['pid']);
                            if ($result8) {
                                $row8 = mysqli_fetch_assoc($result8);
                                $balance = $row8['blance'];
                            }else{
                                $balance = 0;
                            }
                        

                            
                            $ev = new _spevent;
                            $result9 = $ev->readeventPost($_SESSION['pid']);
                            //echo $ev->ta->sql;

                            if($result9){
                                            $postevent = $result9->num_rows;

                                          //  echo $postevent;
                                        }else{
                                            $postevent = 0;
                                        }

                           $pet = new _spevent_transection;

                           $result10 = $pet->mybooking($_SESSION['pid']); 
                          // echo $pet->ta->sql;
                             if($result10){
                                            $mybooking = $result10->num_rows;

                                          //  echo $postevent;
                                        }else{
                                            $mybooking = 0;
                                        }

                              $wt = new _spwithdraw;
                                       
                                        $result11 = $wt->withdrawread($_SESSION['uid']);

                                        //print_r($result12);

                                        //echo $et->ta->sql;

                                        if($result11){

                                            while ($row2 = mysqli_fetch_assoc($result13)) {


                                                $withdraw_amount += $row2['withdraw_amount'];

                                              }

                                               //echo $t_eventtotalearn;

                                            
                                        }
                                       
                                       $total_balance = $t_eventtotalearn - $withdraw_amount;

                                        //print_r($total_balance);          


                            ?>
                            <div class="col-md-3">
                                <div class="small-box bg-green" style="    border-radius: 15px;">
                                    <div class="inner">
                                      <h3><?php echo $mybooking; ?></h3>
                                      <p>My Booking</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </div>
                                    <a href="<?php echo $BaseUrl.'/events/mybookedtickets.php';?>" class="small-box-footer" style="border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                           <!--  <div class="col-md-3">
                                <div class="small-box bg-aqua" style="    border-radius: 15px;">
                                    <div class="inner">
                                      <h3><?php echo $postevent;?></h3>
                                      <p>Total My Events</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </div>
                                    <a href="<?php echo $BaseUrl.'/events';?>" class="small-box-footer" style="border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div> -->
                            <div class="col-md-3">
                                <div class="small-box bg-yellow" style="    border-radius: 15px;">
                                    <div class="inner">
                                      <h3>$<?php  if($total_balance > 0 ){ echo $total_balance; }else{ echo "0" ; } ?></h3>
                                      <p>My Balance</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-dollar"></i>
                                    </div>
                                    <a href="javascript:void(0)" class="small-box-footer" style="border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3"> 
                           <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn butn_save submitevent">Submit an event</a></div>
                        </div>
                        <div class="row m_top_15">
                            
                            <div class="col-md-5">
                                <!-- TABLE: LATEST ORDERS -->
                                <div class="box box-info" style="height: 286px;">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Events</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body" style="padding-top: 20px;">
                                        <div class="table-responsive">
                                            <?php
                                            /*$p = new _postingview;
                                            $po = new _postings;
                                            $en = new _postenquiry;*/

                                            $ev = new _spevent;
                                            $fv = new _event_favorites;
                                            
                                            // =========ACTIVE POST
                                            $totalActive = 0;

                                           

                                            $result2 = $ev->myActPost($_SESSION['pid'], -1, $_GET["categoryid"]);

                                            //echo $ev->ta->sql;

                                            if ($result2) {
                                                $totalActive = $result2->num_rows;

                                                //echo  $totalActive;
                                            }
                                            // =========IN-ACTIVE POST
                                            $totPast = 0;
                                            $today  = date('Y-m-d');
                                            $result4 = $ev->myExpireProduct($_GET['categoryid'], $_SESSION['pid']);
                                            //$result4 = $p->pastEvent($_GET['categoryid'], $today);
                                            if ($result4) {
                                                $totPast = $result4->num_rows;
                                            }
                                            // ==========DRAFT
                                            $totalDraft = 0;
                                            $result3 = $ev->readMyDraftprofile($_GET["categoryid"], $_SESSION['pid']);
                                            //echo $ev->ta->sql;
                                            if ($result3) {
                                                $totalDraft = $result3->num_rows;
                                            }else{
                                                $totalDraft = 0;
                                            }
                                            // =========FAVOURITE POST
                                            $totFav = 0;
                                            $result5 = $fv->myfavourite_event($_SESSION['pid']);

                                           // echo $fv->ta->sql;
                                            if ($result5) {
                                                $totFav = $result5->num_rows;
                                            }
                                            // ===========TOTAL SPONSORS
                                            $totSpon = 0;
                                            $sp  = new _sponsorpic;
                                            $result6 = $sp->readAll($_SESSION['pid']);
                                            //echo $sp->ta->sql;
                                            if ($result6) {
                                                $totSpon = $result6->num_rows;
                                            }
                                            // ========TOTAL FLAG EVENT
                                            $fl = new _flagpost;
                                            $totFlag = 0;
                                            $result7 = $fl->myflagPost($_GET['categoryid'], $_SESSION['pid']);
                                             //echo $fl->ta->sql;
                                            if ($result7) {
                                                $totFlag = $result7->num_rows;
                                            }
                                            // ====END
                                            ?>
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/events/dashboard/active-event.php'; ?>">Active Events</a></td>
                                                        <td><span class="label label-info"><?php echo $totalActive; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/events/dashboard/past-event.php';?>">Past Events</a></td>
                                                        <td><span class="label label-info"><?php echo $totPast; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/events/dashboard/draft-event.php';?>">Draft Events</a></td>
                                                        <td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/events/dashboard/sponsor-list.php'; ?>">Total Sponsors</a></td>
                                                        <td><span class="label label-success"><?php echo $totSpon; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/events/dashboard/bookmark.php';?>">Bookmark Events</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                    </tr> 
                                                    <!-- <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/events/dashboard/myFlag.php';?>">Flagged Events</a></td>
                                                        <td><span class="label label-success"><?php echo $totFlag; ?></span></td>
                                                    </tr>    -->
                                                             
                                                </tbody>
                                            </table>
                                        </div><!-- /.table-responsive -->
                                    </div><!-- /.box-body -->
                                    
                                </div><!-- /.box -->
                                <!-- =======donut chart===== -->
                               <!--  <div class="nav-tabs-custom">
                                   
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <div class="chart tab-pane active" id="chart-two" style="position: relative; height: 292px;">   

                                        </div>                                        
                                    </div>
                                </div> --><!-- /.nav-tabs-custom -->
                            </div>

                            <div class="col-md-7">
                                <!-- Custom tabs (Charts with tabs)-->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 250px;">
                                            <div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                        </div>
                                        <!-- this is xxtra chart for dummy -->
                                        <div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 213px;">

                                        </div>
                                    </div>
                                </div><!-- /.nav-tabs-custom -->
                            
                               <!--  <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-pie-chart"></i> Pie Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 292px;">   
                                            <div id="allmodule"></div>
                                        </div>                                        
                                    </div>
                                </div> --><!-- /.nav-tabs-custom -->


                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        
       

        <?php 
        
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>




        <!-- ========DASHBOARD FOOTER CHARTS====== -->

        <!-- Morris.js charts -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- Slimscroll -->
        <script src="<?php echo $BaseUrl?>/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        
        
        <script type="text/javascript">
            // Create the chart
            Highcharts.chart('jobBoardChart', {
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
                        y: <?php echo $totalActive;?>
                    },{
                        name: "Past Events",
                        y: <?php echo $totPast; ?>
                    },{
                        name: "Draft Events",
                        y: <?php echo $totalDraft; ?>
                    },{
                        name: "Total Sponsors",
                        y: <?php echo $totSpon;?>
                    },{
                        name: "Bookmark Events",
                        y: <?php echo $totFav;?>
                    }]/*{
                        name: "Flagged Events",
                        y: <?php echo $totFlag;?>
                    }]*/
                }],
                
            });
        </script>
        <script type="text/javascript">
            $(function () {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [
                        {label: "Active Events", value: <?php echo $totalActive;?>},
                        {label: "Past Events", value: <?php echo $totPast; ?>},
                        {label: "Draft Events", value: <?php echo $totalDraft; ?>},
                        {label: "Total Sponsors", value: <?php echo $totSpon; ?>},
                        {label: "Bookmark Events", value: <?php echo $totFav; ?>}
                        /*{label: "Flagged Events", value: <?php echo $totFlag;?>}*/
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                var ctoptions = {// My store pi chart
                    chart: {
                        height: 290,
                        renderTo: 'allmodule',
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false
                    },
                    title: {
                        text: 'All Module',
                        style: {
                            fontWeight: 'normal',
                            fontSize: '13px'
                        }
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                    },
                    legend: {
                        itemStyle: {
                            color: '#777',
                            fontWeight: 'normal',
                            fontSize: '9px'
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    plotOptions: {
                        pie: {
                            size: 200,
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true,
                            point: {
                                events: {
                                    click: function () {
                                        console.log('events');
                                        //window.location.href = "../my-store/";
                                    }
                                }
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                        name: 'John',
                        data: [{
                            name: "Active Events",
                            y: <?php echo $totalActive;?>
                        },{
                            name: "Past Events",
                            y: <?php echo $totPast; ?>
                        },{
                            name: "Draft Events",
                            y: <?php echo $totalDraft; ?>
                        },{
                            name: "Total Sponsors",
                            y: <?php echo $totSpon;?>
                        },{
                            name: "Bookmark Events",
                            y: <?php echo $totFav;?>
                        }]/*{
                            name: "Flagged Events",
                            y: <?php echo $totFlag;?>
                        }]      */                 
                    }]
                }
                chart = new Highcharts.Chart(ctoptions);
            });
        </script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo $BaseUrl?>/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script> 
	</body>
</html>
<?php
}
?>