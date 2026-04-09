<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    $topPage = 2;
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
         <?php
        include_once("../header.php");
        ?>
        <section>
            <div class="row no-margin">
                <div class="col-md-2 no-padding">
                    <?php 
                    include('../component/left-services.php');
                    ?>
                </div>
                <div class="col-md-10 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <?php
                            include('top-head-inner.php');
                            ?>
                            <div class="col-md-12 no-padding">
                                <div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active serviceDashboard" id="video1">
                                        <?php include('search-form.php');?>
                                        <?php include('top-dashboard.php');?>

                                        <div class="row m_top_15">
                        <div class="col-md-5">
                            <!-- TABLE: LATEST ORDERS -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Freelance</h3>
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
                                        // =========EXPIRE POST
                                        $totExp = 0;
                                        $result6 = $p->myposted_expire_service($_GET['categoryid'], $_SESSION['pid']);
                                        if ($result6) {
                                            $totExp = $result6->num_rows;
                                        }
                                        // =========FLAGED POST
                                        $totFlgPst = 0;
                                        $result7 = $p->flag_post($_GET['categoryid'], $_SESSION['pid']);
                                        if ($result7) {
                                            $totFlgPst = $result7->num_rows;
                                        }

                                        ?>
                                        <table class="table table-striped no-margin">
                                            <tbody>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Total Post</a></td>
                                                    <td><span class="label label-success"><?php echo $totalProducts; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Active Post</a></td>
                                                    <td><span class="label label-info"><?php echo $totalActive; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Expire Post</a></td>
                                                    <td><span class="label label-info"><?php echo $totExp; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Draft Product</a></td>
                                                    <td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Favourite Post</a></td>
                                                    <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="javascript:void(0)">Flaged Post</a></td>
                                                    <td><span class="label label-warning"><?php echo $totFlgPst; ?></span></td>
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
                                    <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 248px;">
                                        <div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                    </div>
                                    <!-- this is xxtra chart for dummy -->
                                    <div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 292px;">

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
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="space-lg"></div>

        <?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>




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
                    name: 'Classified Ads',
                    colorByPoint: true,
                    data: [{
                        name: "Total Post",
                        y: <?php echo $totalProducts;?>
                    },{
                        name: "Active Post",
                        y: <?php echo $totalActive;?>
                    },{
                        name: "Expire Post",
                        y: <?php echo $totExp; ?>
                    },{
                        name: "Draft Post",
                        y: <?php echo $totalDraft; ?>
                    },{
                        name: "Favourite Post",
                        y: <?php echo $totFav;?>
                    },{
                        name: "Flaged Post",
                        y: <?php echo $totFlgPst;?>
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
                        {label: "Total Post", value: <?php echo $totalProducts;?>},
                        {label: "Active Post", value: <?php echo $totalActive;?>},
                        {label: "Expire Post", value: <?php echo $totExp; ?>},
                        {label: "Draft Post", value: <?php echo $totalDraft; ?>},
                        {label: "Favourite Post", value: <?php echo $totFav;?>},
                        {label: "Flaged Post", value: <?php echo $totFlgPst;?>}
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
                            name: "Total Post",
                            y: <?php echo $totalProducts;?>
                        },{
                            name: "Active Post",
                            y: <?php echo $totalActive;?>
                        },{
                            name: "Expire Post",
                            y: <?php echo $totExp; ?>
                        },{
                            name: "Draft Post",
                            y: <?php echo $totalDraft; ?>
                        },{
                            name: "Favourite Post",
                            y: <?php echo $totFav;?>
                        },{
                            name: "Flaged Post",
                            y: <?php echo $totFlgPst;?>
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
