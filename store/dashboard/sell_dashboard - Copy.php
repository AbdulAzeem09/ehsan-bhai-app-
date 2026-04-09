<?php
    include('../../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){ 
      include_once ("../../authentication/check.php");
      $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "1";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> 
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
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
                        
                        <?php include('left-menu.php'); ?> 

                    </div>
                    <div class="col-md-10">
                        
                        <?php 
                        
                        $storeTitle = " (My Dashboard)";
                        include('../top-dashboard.php');
                        include('../searchform.php');
                        
                        ?>
                        
                        
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
                                            $en = new _postenquiry;
                                            // ==========TOTAL ACTIVE PRODUCTS
                                            $totActivePro = 0;
                                            $result = $p->myActPost($_SESSION['pid'], -1, $_GET["categoryid"]);
                                            if ($result) {
                                                $totActivePro = $result->num_rows;
                                            }

                                            // ==========TOTAL DE-ACTIVE PRODUCTSS
                                            $totDeActivePro = 0;
                                            $result2 = $p->myActPost($_SESSION['pid'], -2, $_GET["categoryid"]);
                                            if ($result2) {
                                                $totDeActivePro = $result2->num_rows;
                                            }

                                            // ==========TOTAL DRAFT PRODUCTS
                                            $totalDraft = 0;
                                            $result3 = $p->myProductVis($_SESSION['pid'], 0, $_GET["categoryid"]);
                                            if ($result3) {
                                                $totalDraft = $result3->num_rows;
                                            }

                                            // =========EXPIRED POST
                                            $totExpirdPro = 0;
                                            $result4 = $p->myExpireProduct($_GET["categoryid"], $_SESSION['pid']);
                                            if ($result4) {
                                                $totExpirdPro = $result4->num_rows;
                                            }

                                            // =========ENQUIRY
                                            $totalEnquires = 0;
                                            $result5 = $en->getMyEnquery($_SESSION['pid']);
                                            if ($result5) {
                                                $totalEnquires = $result5->num_rows;
                                            }
                                            
                                            // =========FAVOURITE POST
                                            $totFav = 0;
                                            $result6 = $p->myfavourite_music($_SESSION['pid'], $_GET['categoryid']);
                                            if ($result6) {
                                                $totFav = $result6->num_rows;
                                            }

                                            // ==========TOTAL FLAGGED PRODUCTS
                                            $totalFlag = 0;
                                            $result7 = $p->myProductVis($_SESSION['pid'], 3, $_GET["categoryid"]);
                                            if ($result7) {
                                                $totalFlag = $result7->num_rows;
                                            }

                                            ?>
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/active_product.php';?>">Active Products</a></td>
                                                        <td><span class="label label-success"><?php echo $totActivePro; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/deactive.php';?>">De-activate Products</a></td>
                                                        <td><span class="label label-info"><?php echo $totDeActivePro; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-draft.php';?>">Draft Product</a></td>
                                                        <td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/expire.php';?>">Expired Products</a></td>
                                                        <td><span class="label label-info"><?php echo $totExpirdPro; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-enquiry.php';?>">Enquiries</a></td>
                                                        <td><span class="label label-warning"><?php  echo $totalEnquires; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-favourite.php'; ?>">Favourite Product</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/store/dashboard/myFlag.php'; ?>">Flagged Posting</a></td>
                                                        <td><span class="label label-warning"><?php echo $totalFlag; ?></span></td>
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
                                        <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 286px;">
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
        </section>



    	<?php 
        include('../../component/footer.php');
        include('../../component/btm_script.php'); 
        ?>

        <!-- ========DASHBOARD FOOTER CHARTS====== -->

        <!-- Morris.js charts -->
        <script src="<?php echo $BaseUrl?>/assets/js/raphael-min.js"></script>
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
                    text: 'Store Graph'
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
                    name: 'Store',
                    colorByPoint: true,
                    data: [{
                        name: "Active Products",
                        y: <?php echo $totActivePro;?>
                    },{
                        name: "De-activate Products",
                        y: <?php echo $totDeActivePro;?>
                    },{
                        name: "Draft Products",
                        y: <?php echo $totalDraft; ?>
                    },{
                        name: "Expired Products",
                        y: <?php echo $totExpirdPro; ?>
                    }, {
                        name: "Enquiries",
                        y: <?php echo $totalEnquires;?>
                    }, {
                        name: "Favourite Product",
                        y: <?php echo $totFav;?>
                    }, {
                        name: "Flagged Product",
                        y: <?php echo $totalFlag;?>
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
                        {label: "Active Products", value: <?php echo $totActivePro;?>},
                        {label: "De-activate Products", value: <?php echo $totDeActivePro;?>},
                        {label: "Draft Products", value: <?php echo $totalDraft; ?>},
                        {label: "Expired Products", value: <?php echo $totExpirdPro; ?>},
                        {label: "Enquiries", value: <?php echo $totalEnquires;?>},
                        {label: "Favourite Product", value: <?php echo $totFav;?>},
                        {label: "Flagged Product", value: <?php echo $totalFlag;?>}
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
                        name: "Active Products",
                            y: <?php echo $totActivePro;?>
                        },{
                            name: "De-activate Products",
                            y: <?php echo $totDeActivePro;?>
                        },{
                            name: "Draft Products",
                            y: <?php echo $totalDraft; ?>
                        },{
                            name: "Expired Products",
                            y: <?php echo $totExpirdPro; ?>
                        }, {
                            name: "Enquiries",
                            y: <?php echo $totalEnquires;?>
                        }, {
                            name: "Favourite Product",
                            y: <?php echo $totFav;?>
                        }, {
                            name: "Flagged Product",
                            y: <?php echo $totalFlag;?>
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
