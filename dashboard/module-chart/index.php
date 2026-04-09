<?php
    require_once("../../univ/baseurl.php" );
     session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    
    $_GET["categoryid"] = "1";
    $pageactive = 5;
    // background color
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        
        <!-- custom page script -->
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        
        <link href="http://api.highcharts.com/highcharts">


    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../../header.php");
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php include('../../component/left-dashboard.php'); ?>

                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                        <div class="rightContent">
                            
                            <!-- breadcrumb -->
                            <section class="content-header">
                                <h1>Store Module Dashboard</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active">Store</li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
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
													$en = new _sppostenquiry;
                                            $result = $en->getsellerEnquery($_SESSION['pid']);
											$selleryenquery=$result->num_rows;
											if($selleryenquery==""){
												$selleryenquery=0;
											}
											$result1 = $en->getbuyerEnquery($_SESSION['pid']);
											$buyerenquery=$result1->num_rows;
											if($buyerenquery==""){
												$buyerenquery=0;
											}
											
											//echo $selleryenquery;
											//die('===');
                                                    $p = new _postingview;
                                                    $en = new _postenquiry;
                                                     $pp = new _productposting;
                                                    // ==========TOTAL ACTIVE PRODUCTS
                                                    $totActivePro = 0;
                                                    $result = $pp->myStoreProduct($_SESSION['pid']);
                                                    if ($result) {
                                                        $totActivePro = $result->num_rows;
                                                    }

                                                    // ==========TOTAL DE-ACTIVE PRODUCTSS
                                                    $totDeActivePro = 0;
                                                    $result2 = $pp->myProductVis($_SESSION['pid'], -2, 1);
                                                    if ($result2) {
                                                        $totDeActivePro = $result2->num_rows;
                                                    }

                                                    // ==========TOTAL DRAFT PRODUCTS
                                                    $totalDraft = 0;
                                                    $result3 = $pp->readMyDraftprofile(1,$_SESSION['pid']);
                                                    if ($result3) {
                                                        $totalDraft = $result3->num_rows;
                                                    }

                                                    // =========EXPIRED POST
                                                    $totExpirdPro = 0;
                                                    $result4 = $pp->myExpireProduct(1, $_SESSION['pid']);
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
                                                    $result6 = $pp->readallfavrouiteproduct(1,$_SESSION['pid']);
                                                    if ($result6) {
                                                        $totFav = $result6->num_rows;
                                                    }

                                                    // ==========TOTAL FLAGGED PRODUCTS
                                                  /*  $totalFlag = 0;
                                                    $result7 = $p->myProductVis($_SESSION['pid'], 3, $_GET["categoryid"]);
                                                    if ($result7) {
                                                        $totalFlag = $result7->num_rows;
                                                    }
*/
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
                                                                <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-enquiry.php';?>">Enquiries As Seller</a></td>
                                                                <td><span class="label label-warning"><?php  echo $selleryenquery; ?></span></td>
                                                            </tr>
															<tr>
                                                                <td><a href="<?php echo $BaseUrl.'/store/dashboard/my_send_enguiry.php';?>">Enquiries As Buyer</a></td>
                                                                <td><span class="label label-warning"><?php  echo $buyerenquery; ?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/store/dashboard/my-favourite.php'; ?>">Favourite Product</a></td>
                                                                <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                            </tr>
                                                           <!--  <tr>
                                                                <td><a href="<?php echo $BaseUrl.'/store/dashboard/myFlag.php'; ?>">Flagged Posting</a></td>
                                                                <td><span class="label label-warning"><?php echo $totalFlag; ?></span></td>
                                                            </tr>    -->                                         
                                                        </tbody>
                                                    </table>
                                                    </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            <div class="box-footer clearfix">
                                                <a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>" class="btn btn-sm btn-info btn-flat pull-left btn-border-radius">View Module Dashboard</a>
                                                <a href="<?php echo $BaseUrl.'/store/';?>" class="btn btn-sm btn-primary btn-flat pull-right btn-border-radius">View Module</a>
                                            </div><!-- /.box-footer -->
                                        </div><!-- /.box -->
                                    </div>

                                    <div class="col-md-7">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="active"><a href="#bar-chart" data-toggle="tab">Bar Chart</a></li>
                                               <!--  <li class=""><a href="#chart-two" data-toggle="tab">Donut Chart</a></li>
                                                <li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li> -->
                                                <!--<li class="pull-left header"><i class="fa fa-pie-chart"></i> Charts</li>-->
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 292px;">
                                                    <div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                                <!-- this is xxtra chart for dummy -->
                                                <div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 292px;">
                                                    
                                                    
                                                </div>
                                                <div class="chart tab-pane" id="chart-two" style="position: relative; height: 292px;">
                                                    
                                                    
                                                </div>
                                                <div class="chart tab-pane" id="pie-chart" style="position: relative; height: 292px;">
                                                    <div id="allmodule"></div>
                                                    
                                                </div>
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->




                                        <!-- solid sales graph -->
                                     <!--    <div class="box box-solid bg-teal-gradient">
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
                                            </div>
                                            <div class="box-footer no-border">
                                              <div class="row">
                                                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                                  <div class="knob-label">Mail-Orders</div>
                                                </div>
                                                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                                  <div class="knob-label">Online</div>
                                                </div>
                                                <div class="col-xs-4 text-center">
                                                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                                  <div class="knob-label">In-Store</div>
                                                </div>
                                              </div>
                                            </div>
                                        </div> -->
                                    </div>



                                </div><!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

        <script src="http://code.highcharts.com/highcharts.js"></script>
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>


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
                    },/* {
                        name: "Flagged Product",
                        y: <?php echo $totalFlag;?>
                    }*/]
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
                        /*{label: "Flagged Product", value: <?php echo $totalFlag;?>}*/
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
                        },/* {
                            name: "Flagged Product",
                            y: <?php echo $totalFlag;?>
                        }*/]                          
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
} ?>