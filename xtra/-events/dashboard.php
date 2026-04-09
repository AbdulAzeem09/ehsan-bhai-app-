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

    $_GET["categoryid"] = $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";
    $activePage = 7;
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <?php include('../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
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
                    <div class="col-md-12 eventDashboard">
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
                <div class="row m_top_15">
                    <div class="col-md-5">
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
                                    $po = new _postings;
                                    $en = new _postenquiry;
                                    // total Products
                                    $totalProducts = 0; 
                                    $result = $p->mycatProduct($_GET['categoryid'], $_SESSION['pid']);
                                    //echo $p->ta->sql;
                                    if ($result) {
                                        $totalProducts = $result->num_rows;
                                    }else{
                                        $totalProducts = 0;
                                    }
                                    // =========ACTIVE POST
                                    $totalActive = 0;
                                    $result4 = $p->profileactivepost($_GET["categoryid"], $_SESSION['pid']);
                                    //echo $p->ta->sql;
                                    if ($result4) {
                                        $totalActive = $result4->num_rows;
                                    }
                                    // =========IN-ACTIVE POST
                                    $totInActive = $totalProducts - $totalActive;
                                    // ==========DRAFT
                                    $totalDraft = 0;
                                    $result3 = $p->readMyDraftprofile($_GET["categoryid"], $_SESSION['pid']);
                                    //echo $p->ta->sql;
                                    if ($result3) {
                                        $totalDraft = $result3->num_rows;
                                    }else{
                                        $totalDraft = 0;
                                    }
                                    // =========FAVOURITE POST
                                    $totFav = 0;
                                    $result5 = $p->myfavourite_music($_SESSION['pid'], $_GET['categoryid']);
                                    //echo $p->ta->sql;
                                    if ($result5) {
                                        $totFav = $result5->num_rows;
                                    }

                                    ?>
                                    <table class="table table-striped no-margin">
                                        <tbody>
                                            <tr>
                                                <td><a href="javascript:void(0)">Total Events</a></td>
                                                <td><span class="label label-success"><?php echo $totalProducts; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="<?php echo $BaseUrl.'/events/active-event.php';?>">Active Events</a></td>
                                                <td><span class="label label-info"><?php echo $totalActive; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="<?php echo $BaseUrl.'/events/past-event.php';?>">Past Events</a></td>
                                                <td><span class="label label-info"><?php echo $totInActive; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="<?php echo $BaseUrl.'/events/draft-event.php';?>">Draft Events</a></td>
                                                <td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td><a href="<?php echo $BaseUrl.'/events/event-favourite.php';?>">Bookmark Events</a></td>
                                                <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                            </tr>             
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                            
                        </div><!-- /.box -->
                        <!-- =======donut chart===== -->
                        <div class="nav-tabs-custom">
                            <!-- Tabs within a box -->
                            <ul class="nav nav-tabs pull-right">
                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <div class="chart tab-pane active" id="chart-two" style="position: relative; height: 292px;">   

                                </div>                                        
                            </div>
                        </div><!-- /.nav-tabs-custom -->
                    </div>

                    <div class="col-md-7">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 213px;">
                                    <div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                </div>
                                <!-- this is xxtra chart for dummy -->
                                <div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 213px;">

                                </div>
                            </div>
                        </div><!-- /.nav-tabs-custom -->
                    
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Pie Chart</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 292px;">   
                                    <div id="allmodule"></div>
                                </div>                                        
                            </div>
                        </div><!-- /.nav-tabs-custom -->

                        <!-- solid sales graph -->
                        <div class="box box-solid bg-teal-gradient">
                            <div class="box-header">
                              <i class="fa fa-th"></i>
                              <h3 class="box-title">Sales Graph</h3>
                              <div class="box-tools pull-right">
                                <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                              </div>
                            </div>
                            <div class="box-body border-radius-none">
                              <div class="chart" id="line-chart" style="height: 250px;"></div>
                            </div><!-- /.box-body -->
                            <div class="box-footer no-border">
                              <div class="row">
                                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                  <div class="knob-label">Mail-Orders</div>
                                </div><!-- ./col -->
                                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                  <div class="knob-label">Online</div>
                                </div><!-- ./col -->
                                <div class="col-xs-4 text-center">
                                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                  <div class="knob-label">In-Store</div>
                                </div><!-- ./col -->
                              </div><!-- /.row -->
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                    </div>
                </div><!-- /.row -->


            </div>
        </section>

        <?php 
        include('loaddetail.php');
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>




        <!-- ========DASHBOARD FOOTER CHARTS====== -->

        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
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
                    name: 'Events',
                    colorByPoint: true,
                    data: [{
                        name: "Total Events",
                        y: <?php echo $totalProducts;?>
                    },{
                        name: "Active Events",
                        y: <?php echo $totalActive;?>
                    },{
                        name: "Past Events",
                        y: <?php echo $totInActive; ?>
                    },{
                        name: "Draft Events",
                        y: <?php echo $totalDraft; ?>
                    },{
                        name: "Bookmark Events",
                        y: <?php echo $totFav;?>
                    }]
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
                        {label: "Total Events", value: <?php echo $totalProducts;?>},
                        {label: "Active Events", value: <?php echo $totalActive;?>},
                        {label: "Past Events", value: <?php echo $totInActive; ?>},
                        {label: "Draft Events", value: <?php echo $totalDraft; ?>},
                        {label: "Bookmark Events", value: <?php echo $totFav;?>}
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
                            name: "Total Events",
                            y: <?php echo $totalProducts;?>
                        },{
                            name: "Active Events",
                            y: <?php echo $totalActive;?>
                        },{
                            name: "Past Events",
                            y: <?php echo $totInActive; ?>
                        },{
                            name: "Draft Events",
                            y: <?php echo $totalDraft; ?>
                        }, {
                            name: "Bookmark Events",
                            y: <?php echo $totFav;?>
                        }]                       
                    }]
                }
                chart = new Highcharts.Chart(ctoptions);
            });
        </script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="<?php echo $BaseUrl?>/assets/admin/dist/js/pages/dashboard.js" type="text/javascript"></script> 
	</body>
</html>
