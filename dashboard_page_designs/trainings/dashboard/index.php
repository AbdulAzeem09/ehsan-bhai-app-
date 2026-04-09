<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = $_GET["categoryID"] = "8";
    $_GET["categoryName"] = "Trainings";
    $header_train = "header_train";

    $activePage = 1;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for sticky left and right sidebar STart-->

        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <?php include('../../component/dashboard-link.php'); ?>

    </head>

    <body class="bg_gray">
         <?php
        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_train_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="col-xs-12 trainDashTop text-center">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <!-- TABLE: LATEST ORDERS -->
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Total Spent</h3>
                                        <div class="box-tools pull-right"><a href="#" >View Spent Details</a>
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                           

                                           
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.$pageLink.'my_order.php'; ?>">Daily Spent</a></td>
                                                        <td><span class="label label-warning">2000</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Weekly Spent </a></td>
                                                        <td><span class="label label-warning">40000</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Monyhly Spent</a></td>
                                                        <td><span class="label label-warning">80000</span></td>
                                                    </tr>
                                                 
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Yearly Spent</a></td>
                                                        <td><span class="label label-warning">122222</span></td>
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
                            <div class="col-md-6">
                                <!-- TABLE: LATEST ORDERS -->
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Total Earned</h3>
                                        <div class="box-tools pull-right"><a href="#" >View Earned Details</a>
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                           

                                           
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.$pageLink.'my_order.php'; ?>">Daily Earned</a></td>
                                                        <td><span class="label label-warning">2000</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Weekly Earned </a></td>
                                                        <td><span class="label label-warning">40000</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Monyhly Earned</a></td>
                                                        <td><span class="label label-warning">80000</span></td>
                                                    </tr>
                                                 
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Yearly Earned</a></td>
                                                        <td><span class="label label-warning">122222</span></td>
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
       <div class="col-md-6">
                                <!-- TABLE: LATEST ORDERS -->
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Trainings</h3>
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
                                            
                                            // =========ACTIVE POST
                                            $totalActive = 0;
                                            $result4 = $p->myAllSongs($_SESSION['pid'], $_GET['categoryid']);
                                            //echo $p->ta->sql;
                                            if ($result4) {
                                                $totalActive = $result4->num_rows;
                                            }

                                            // =========FAVOURITE POST
                                            $totFav = 0;
                                            $result5 = $p->myfavourite_music($_SESSION['pid'], $_GET['categoryid']);
                                            //echo $p->ta->sql;
                                            if ($result5) {
                                                $totFav = $result5->num_rows;
                                            }
                                            
                                            // ==========FLAGGED
                                            $totFlag = 0;
                                            $result9 = $p->myflagPost($_GET['categoryid'], $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if ($result9) {
                                                $totFlag = $result9->num_rows;
                                            }

                                            ?>
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.$pageLink.'active.php'; ?>">Active Trainings</a></td>
                                                        <td><span class="label label-success"><?php echo $totalActive; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.$pageLink.'favourite.php'; ?>">Favourite Trainings</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.$pageLink.'myFlag.php'; ?>">Flagged Trainings</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFlag; ?></span></td>
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
                            <div class="col-md-6">
                                <!-- Custom tabs (Charts with tabs)-->
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-bar-chart"></i> Bar Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <!-- Morris chart - Sales -->
                                        <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 140px;">
                                            <div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
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

                               
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <div class="space-lg"></div>

        <?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
        







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
                    name: 'Trainings',
                    colorByPoint: true,
                    data: [{
                        name: "Active Trainings",
                        y: <?php echo $totalActive;?>
                    },{
                        name: "Favourite Trainings",
                        y: <?php echo $totFav;?>
                    },{
                        name: "Flagged Trainings",
                        y: <?php echo $totFlag; ?>
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
                        {label: "Active Trainings", value: <?php echo $totalActive;?>},
                        {label: "Favourite Trainings", value: <?php echo $totFav;?>},
                        {label: "Flagged Trainings", value: <?php echo $totFlag; ?>}
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
                            name: "Active Trainings",
                            y: <?php echo $totalActive;?>
                        },{
                            name: "Favourite Trainings",
                            y: <?php echo $totFav;?>
                        },{
                            name: "Flagged Trainings",
                            y: <?php echo $totFlag; ?>
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
<?php
}
?>