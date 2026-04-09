<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On'); 
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "store/";
    include_once("../../authentication/islogin.php");
} else {
    function sp_autoloader($class)
    {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "1";
?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

        <?php include('../../component/f_links.php'); ?>
        <!-- ===== INPAGE SCRIPTS====== -->
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

        <?php include('../../component/dashboard-link.php'); ?>


    </head>

    <body class="bg_gray">
        <?php

        $activePage = 21;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <!--  <div class="sidebar col-md-2 no-padding left_store_menu1" id="sidebar" style="border-radius: 11px;" > -->
                    <!--    <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" style="" >
                        
                        <?php //include('left-menu.php'); 
                        ?> 

                    </div> -->
                    <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                            include('left-sellermenu.php');
                            ?>
                        </div>
                    </div>
                    <style>
                        btn:hover,
                        .btn:focus,
                        .btn.focus {
                            color: #000;
                            text-decoration: none;
                        }

                        .bg-event {
                            background: #ff8ab8;
                        }

                        .bg-store {
                            background: #8cf6ba;
                        }

                        .bg-freelance {
                            background: rgba(255, 215, 190);
                        }

                        .tagLine-max-char {

                            font-size: smaller;
                            font-weight: 600;

                        }

                        .panel-body {
                            width: 300px;
                            border-radius: 25px 25px 0 0;
                            border: 1px solid;
                            box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
                        }

                        .border-event {
                            border-color: #ff8ab8;
                        }

                        .border-freelance {
                            border-color: rgba(255, 215, 190);
                        }

                        .border-store {
                            border-color: rgb(140, 246, 186);
                        }

                        .bg_events:hover {
                            color: #000
                        }

                        .panel-footer {
                            width: 300px;
                            box-shadow: rgb(0 0 0 / 24%) 0 3px 8px;
                            border-radius: 0 0 25px 25px;
                            text-align: center;

                        }

                        .panel-footer>a {
                            color: #000;
                            text-transform: uppercase;
                            text-decoration: none;
                            padding: 10px 10px;
                            font-size: 20px;
                            font-weight: bolder;
                        }

                        .rightContent {
                            background-color: #fff;
                        }
                    </style>
                    <div class="col-md-10">
                        <div class="rightContent">
                            <?php

                            $storeTitle = " (Seller Dashboard)";
                            /*include('../top-dashboard.php');
                        include('../searchform.php');*/


                            $st = new _spuser;
                            $st1 = $st->readdatabybuyerid($_SESSION['uid']);
                            if ($st1 != false) {
                                $stt = mysqli_fetch_assoc($st1);
                                $account_status = $stt['deactivate_status'];
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-12">

                                    <ul class="breadcrumb" style="background-color: #fff; font-size: 20px; text-align: center;">
                                        <li><a href="<?php echo $BaseUrl . '/store/dashboard/sell_dashboard.php'; ?>" style=" color: #0B241E; padding-right: 180px; font-weight: bold; ">SELLER DASHBOARD</a></li>

                                    </ul>
                                    <?php /* if($_SESSION['ptid']==1){?> 
									
									
	<a href="<?php echo $BaseUrl.'/store/pos-dashboard/index.php'; ?>" class="pull-right" style=" color: #0B241E; margin-top: -57px;
    margin-right: 19px;"><b style=" font-size: 23px;">Switch To POS</b></a> 
									<?php }*/ ?>
                                </div>





                            </div>

                            <!--    <div class="text-right">
                                       <ul class="dualDash"   style="float:left!important;">
                                        <li><a href="<?php echo $BaseUrl . '/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13) ? 'active' : '' ?>">Seller Dashboard</a></li>
                                        <li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24) ? 'active' : '' ?>">Buyer Dashboard</a></li>
                                       </ul>
                                </div>
                            </div>
 -->
                            <!--  <div class="col-md-12">
                      <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 8px;">
                            <li><a href="<?php echo $BaseUrl . '/store/dashboard/'; ?>">Buyer Dashboard</a></li>

                       
                                     
                          </ul>
                            </div>
 -->
                            <!-- <div class="col-md-3">
                                <div class="small-box bg-green">
                                    <div class="inner">
                                      <h3>0</h3>
                                      <p>Total Sold</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-arrows"></i>
                                    </div>
                                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-aqua">
                                    <div class="inner">
                                      <h3>0</h3>
                                      <p>Total New</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-plus-square"></i>
                                    </div>
                                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-yellow">
                                    <div class="inner">
                                       <?php   /* $en = new _sppostenquiry;
                                                $result_e = $en->getsellerEnquery($_SESSION['pid']);
                                               if ($result_e) {
                                            echo "<h3>".$result_e->num_rows."</h3>";
                                        }else{
                                            echo "<h3>0</h3>";
                                        } */ ?>

                                       <p>Total Enquiry Product</p>
                                    </div>
                                    <div class="icon">
                                     <i class="fa fa-product-hunt"></i>
                                    </div>
                                    <a href="<?php echo $BaseUrl . '/store/dashboard/my-enquiry.php'; ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                      <h3>0</h3>
                                      <p>Sale This Month</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <a href="javascript:void(0)" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>-->
                            <?php
                            $oi = new _spcustomers_basket;
                            $oid = $oi->readid($_SESSION['uid']);

                            if ($oid != false) {
                                //$amount=0;
                                while ($r = mysqli_fetch_assoc($oid)) {
                                    //print_r($r);
                                    if ($account_status != 1) {
                                        $amount1 += $r['amount'];
                                    } else {
                                        $amount1 = 0;
                                    }
                                } ?>

                                <?php
                                $module = "store";
                                $w = new _orderSuccess;
                                $res = $w->readid($_SESSION['uid'], $module);
                                //var_dump($res);
                                if ($res != false) {
                                    //$amount=0;
                                    while ($ra = mysqli_fetch_assoc($res)) {
                                        //print_r($ra);
                                        if ($account_status != 1) {
                                            $amount2 += $ra['amount'];
                                        } else {
                                            $amount2 = 0;
                                        }
                                        //$dated = $ra['date'];
                                        //echo $dated;

                                    }
                                    //echo $amount2;
                                    $amount3 = ($amount1 - $amount2);
                                }

                                ?>

                                <?php
                                //echo $_SESSION['uid'];
                                $sp = new _spuser;
                                $result = $sp->readcurrency($_SESSION['uid']);

                                if ($result != false) {

                                    while ($row_n = mysqli_fetch_assoc($result)) {


                                        $currency = $row_n['currency'];
                                    }
                                }

                                ?>

                                <br>
                                <div class="row">
                                    <div class="col-md-4" style="margin-left:-10px;">
                                        <div class="panel">
                                            <div class="panel-body border-event">
                                                <div class="small-box bg_events">
                                                    <div class="inner">
                                                        <h3><?php echo $currency . ' ' . $amount1; ?></h3>
                                                    </div>

                                                    <div class="icon">
                                                        <i class="fa fa-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer bg-event">
                                                <a href="<?php echo $BaseUrl ?>/dashboard/finance/store_wallet.php">Lifetime Sale </a>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="col-md-4">
                                        <div class="panel">
                                            <div class="panel-body border-freelance">
                                                <div class="small-box bg_events">
                                                    <div class="inner">
                                                        <h3><?php $amut = 0;
                                                            if ($amount2) {
                                                                echo $currency . ' ' . $amount2;
                                                            } else {
                                                                echo $currency . ' ' . $amut;
                                                            } ?></h3>
                                                    </div>

                                                    <div class="icon">
                                                        <i class="fa fa-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer bg-freelance">
                                                <a href="">Total Withdrawal </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="panel">
                                            <div class="panel-body border-store">
                                                <div class="small-box bg_events">
                                                    <div class="inner">
                                                        <h3><?php if ($amount3) {
                                                                echo $currency . ' ' . $amount3;
                                                            } else {
                                                                echo $currency . ' ' . $amount1;
                                                            }

                                                            ?></h3>
                                                    </div>

                                                    <div class="icon">
                                                        <i class="fa fa-dollar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer bg-store">
                                                <a href="">Total Amount left</a>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            <?php } ?>


                            <div class="row">
                                <!--        <div class="col-md-5">
                                
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">My Orders</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="table-responsive">
                                           
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">New Orders (New Purchased)</a></td>
                                                        <td><span class="label label-success"><?php echo 0; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Cancel Order</a></td>
                                                        <td><span class="label label-info"><?php echo 0; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Return Request</a></td>
                                                        <td><span class="label label-danger"><?php echo 0; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl . '/store/dashboard/my-enquiry.php'; ?>">My Enquiries</a></td>
                                                        <td><span class="label label-info"><?php echo 0; ?></span></td>
                                                    </tr>
                                                                                               
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                               
                            </div> -->

                                <!-- <div class="col-md-7">
                                
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Purchase Summery</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Today</a></td>
                                                        <td><span class="label label-success"><?php echo 0; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">7 Days</a></td>
                                                        <td><span class="label label-info"><?php echo 0; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">15 Days</a></td>
                                                        <td><span class="label label-danger"><?php echo 0; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">30 Days</a></td>
                                                        <td><span class="label label-info"><?php echo 0; ?></span></td>
                                                    </tr>
                                                                                               
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
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
                                                $p = new _productposting;
                                                $en = new _postenquiry;
                                                // ==========TOTAL ACTIVE PRODUCTS
                                                $totActivePro = 0;
                                                $result = $p->myStoreProduct($_SESSION['pid']);
                                                if ($account_status != 1) {
                                                    if ($result) {
                                                        $totActivePro = $result->num_rows;
                                                    }
                                                }

                                                // ==========TOTAL DE-ACTIVE PRODUCTSS
                                                $totDeActivePro = 0;
                                                $result2 = $p->myProductVis($_SESSION['pid'], -2, 1);
                                                if ($account_status != 1) {
                                                    if ($result2) {
                                                        $totDeActivePro = $result2->num_rows;
                                                    }
                                                }

                                                // ==========TOTAL DRAFT PRODUCTS
                                                $totalDraft = 0;
                                                $result3 = $p->readMyDraftprofile(1, $_SESSION['pid']);
                                                if ($account_status != 1) {
                                                    if ($result3) {
                                                        $totalDraft = $result3->num_rows;
                                                    }
                                                }

                                                // =========EXPIRED POST
                                                $totExpirdPro = 0;
                                                $result4 = $p->myExpireProduct(1, $_SESSION['pid']);
                                                if ($account_status != 1) {
                                                    if ($result4) {
                                                        $totExpirdPro = $result4->num_rows;
                                                    }
                                                }

                                                // =========ENQUIRY
                                                $totalEnquires = 0;
                                                $en = new _sppostenquiry;
                                                $result5 = $en->getsellerEnquery($_SESSION['pid']);
                                                if ($account_status != 1) {
                                                    if ($result5) {
                                                        $totalEnquires = $result5->num_rows;
                                                    }
                                                }

                                                // =========FAVOURITE POST
                                                $totFav = 0;
                                                $result6 = $p->readallfavrouiteproduct(1, $_SESSION['pid']);
                                                if ($account_status != 1) {
                                                    if ($result6) {
                                                        $totFav = $result6->num_rows;
                                                    }
                                                }

                                                // ==========TOTAL FLAGGED PRODUCTS
                                                $totalFlag = 0;
                                                /*  $result7 = $p->myProductVis($_SESSION['pid'], 3, $_GET["categoryid"]);
                                            if ($result7) {
                                                $totalFlag = $result7->num_rows;
                                            }
*/
                                                ?>
                                                <table class="table table-striped no-margin">
                                                    <tbody>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl . '/store/dashboard/active_product.php'; ?>">Active Products</a></td>
                                                            <td><span class="label label-success"><?php echo $totActivePro; ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl . '/store/dashboard/deactive.php'; ?>">De-activated Products</a></td>
                                                            <td><span class="label label-info"><?php echo $totDeActivePro; ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl . '/store/dashboard/my-draft.php'; ?>">Draft Product</a></td>
                                                            <td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl . '/store/dashboard/expire.php'; ?>">Expired Products</a></td>
                                                            <td><span class="label label-info"><?php echo $totExpirdPro; ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl . '/store/dashboard/my-enquiry.php'; ?>">Enquiries</a></td>
                                                            <td><span class="label label-warning"><?php echo $totalEnquires; ?></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="<?php echo $BaseUrl . '/store/dashboard/my-favourite.php'; ?>">Favourite Product</a></td>
                                                            <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                        </tr>
                                                        <!--   <tr>
                                                        <td><a href="<?php echo $BaseUrl . '/store/dashboard/myFlag.php'; ?>">Flagged Posting</a></td>
                                                        <td><span class="label label-warning"><?php echo $totalFlag; ?></span></td>
                                                    </tr> -->

                                                    </tbody>
                                                </table>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.box-body -->

                                    </div><!-- /.box -->
                                    <!-- =======donut chart===== -->
                                    <!--   <div class="nav-tabs-custom">
                                   
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <div class="chart tab-pane active" id="chart-two" style="position: relative; height: 292px;">   

                                        </div>                                        
                                    </div>
                                </div> -->
                                    <!-- /.nav-tabs-custom -->
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
                                    <!-- 
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-pie-chart"></i> Pie Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 292px;">   
                                            <div id="allmodule"></div>
                                        </div>                                        
                                    </div>
                                </div> -->
                                    <!-- /.nav-tabs-custom -->


                                </div>



                            </div><!-- /.row -->


                        </div>
                    </div>
                </div>
            </div>
        </section>



        <?php
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php');

        ?>
        <script src="<?php echo $BaseUrl ?>/assets/admin/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- ========DASHBOARD FOOTER CHARTS====== -->
        <?php include('../../component/dash_btm_script.php'); ?>


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
                            y: <?php echo $totActivePro; ?>
                        }, {
                            name: "De-activate Products",
                            y: <?php echo $totDeActivePro; ?>
                        }, {
                            name: "Draft Products",
                            y: <?php echo $totalDraft; ?>
                        }, {
                            name: "Expired Products",
                            y: <?php echo $totExpirdPro; ?>
                        }, {
                            name: "Enquiries",
                            y: <?php echo $totalEnquires; ?>
                        }, {
                            name: "Favourite Product",
                            y: <?php echo $totFav; ?>
                        },
                        /*{
                                               name: "Flagged Product",
                                               y: <?php echo $totalFlag; ?>
                                           }*/
                    ]
                }],

            });
        </script>
        <script type="text/javascript">
            $(function() {
                //Donut Chart
                var donut = new Morris.Donut({
                    element: 'chart-two',
                    resize: true,
                    colors: ["#3c8dbc", "#f56954", "#00a65a", "#F00"],
                    data: [{
                            label: "Active Products",
                            value: <?php echo $totActivePro; ?>
                        },
                        {
                            label: "De-activate Products",
                            value: <?php echo $totDeActivePro; ?>
                        },
                        {
                            label: "Draft Products",
                            value: <?php echo $totalDraft; ?>
                        },
                        {
                            label: "Expired Products",
                            value: <?php echo $totExpirdPro; ?>
                        },
                        {
                            label: "Enquiries",
                            value: <?php echo $totalEnquires; ?>
                        },
                        {
                            label: "Favourite Product",
                            value: <?php echo $totFav; ?>
                        },
                        /* {label: "Flagged Product", value: <?php echo $totalFlag; ?>}*/
                    ],
                    hideHover: 'auto'
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                var ctoptions = { // My store pi chart
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
                                    click: function() {
                                        //console.log('events');
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
                                y: <?php echo $totActivePro; ?>
                            }, {
                                name: "De-activate Products",
                                y: <?php echo $totDeActivePro; ?>
                            }, {
                                name: "Draft Products",
                                y: <?php echo $totalDraft; ?>
                            }, {
                                name: "Expired Products",
                                y: <?php echo $totExpirdPro; ?>
                            }, {
                                name: "Enquiries",
                                y: <?php echo $totalEnquires; ?>
                            }, {
                                name: "Favourite Product",
                                y: <?php echo $totFav; ?>
                            },
                            /*{
                                                       name: "Flagged Product",
                                                       y: <?php echo $totalFlag; ?>
                                                   }*/
                        ]
                    }]
                }
                chart = new Highcharts.Chart(ctoptions);
            });
        </script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    </body>

    </html>
<?php
} ?>