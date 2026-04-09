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
    

    $_GET["categoryid"] = "13";
    $moduleTitle = "Art Gallery";
    $pageactive = 10;
    // background color
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!--This script for posting timeline data Start-->
        <!--This script for posting timeline data End-->
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
                                <h1><?php echo $moduleTitle;?> Module Dashboard</h1>
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
                                    <li class="active"><?php echo $moduleTitle;?></li>
                                </ol>
                            </section>

                            <div class="content">
                                <div class="row">
                                    <div class="col-md-5">
                                        <!-- TABLE: LATEST ORDERS -->
                                        <div class="box box-info">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><?php echo $moduleTitle;?></h3>
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
                                            $atb = new _addtoboard;
                                            $ag = new _artgalleryenquiry;
                                            $o = new _artcraftOrder;

                                            // MY TOTAL ORDER WHICH I BUY
                                            $totBuyOrdr = 0;
											$numrows=0;
											$cancel_count = 0;
											$return_request=0;
                                           $st= new _orderSuccess;
             $result= $st->readstatus_art($_SESSION['pid'],$_SESSION['uid']);
                                            if ($result) {
														//print_r($result);
                                                $totBuyOrdr = $result->num_rows;
                                            }
											
		$status= $st->readstatus_art_cancel($_SESSION['pid'],$_SESSION['uid']);
					 if ($status) {
														//print_r($result);
                                                $cancel_count = $status->num_rows;
                                            }
	$refund= $st->readstatus_art_refund($_SESSION['pid'],$_SESSION['uid']);
	 if ($refund) {
														//print_r($result);
                                                $return_request = $refund->num_rows;
                                            }
											
                                            // =========FAVOURITE POST
                                            $totFav = 0;
											$pr= new _postingviewartcraft;
                                            $result5 = $pr->event_favorite($_GET['categoryid'],$_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if ($result5) {
                                                $totFav = $result5->num_rows;
                                            }





         $o = new _artcraftOrder;
                                                $result = $o->readBuyerOrder($_SESSION['pid']);
											
                                                //echo $o->ta->sql; die();
                                                // $p = new _orderSuccess;
                                                // $result = $p->readmyOrder($_SESSION['pid']);
                                                // //echo $p->ta->sql;
                                                if ($result) {
                                                    $i = 1;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                      extract($row);
                                                        
                                                    $result1 = $o->readBuyerOrdertotalpro($id);
												//echo $o->tad->sql; die();		
												//print_r($result1); die('-=======================-===========');
													if ($result1) {
                                                while ($row1 = mysqli_fetch_assoc($result1)) {	
												      
	   												$products_checkout_id = $row1['id'];
													$productid = $row1['spPostings_idspPostings'];
													$price = $row1['price']; 
													
												
					$p = new _postingviewartcraft;
					 
			        $pres = $p->singletimelines($productid);
					 if($pres=="")
					 {
						$resrp=""; 
					 }
					 else{
					$resrp = mysqli_fetch_array($pres);
												 
                                                     $result2 = $o->existStatus($products_checkout_id);
												
												$row2 = mysqli_fetch_assoc($result2);
												//print_r($row2); die("-------------------");
												if($row2['Cancel']==1){
													
													
													//$cancel_count = $cancel_count+1;
													
												}
												
												if($row2['return_request'] ==1){
													
													
													//$return_request = $return_request+1;
													
												}
												
												}}}}}








                                            // ============YOUR BOARD
                                            
         $result6 = $atb->readMyBoard($_SESSION['pid']);
		 $numrowsw = $result6->num_rows;
		 //echo $numrowsw;
		 //print_r($numrowsw);
											 if($result6 ){
						//print_r($result6);
                                while ($rows = mysqli_fetch_assoc($result6)) {
                                    
                            $res = $p->singletimelines($rows['spPosting_idspPosting']);
							  if($res != false){
							// print_r($res);
                                       
										
										$board=$numrowsw;
										//echo $board;
                                          /*  if ($result6) {

                                                $board = $result6->num_rows;
                                            }*/
											
											 }}}
                           $result = $atb->readMyBoard($_SESSION['pid']);
							$numrows = $result->num_rows;  
                              if($numrows==""){
								  $numrows=0;
							  }							
                                                                                                    
                                                    ?>
                                                    <table class="table table-striped no-margin">
                                                        <tbody>
                                                           <tr>
 <td><a href="<?php echo $BaseUrl.'/artandcraft/dashboard/my_order.php'; ?>">My Orders (New Purchased)</a></td>
                                                        <td><span class="label label-warning"><?php echo $totBuyOrdr; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/artandcraft/dashboard/cancel_order.php';?>">Cancel Orders</a></td>
                                                        <td><span class="label label-warning"><?php echo $cancel_count ; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/artandcraft/dashboard/return_request.php';?>">Return Request</a></td>
                                                        <td><span class="label label-warning"><?php echo $return_request; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/artandcraft/dashboard/your_board.php?page=1';?>">Your Board</a></td>
                                                        <td><span class="label label-warning"><?php echo $return_request; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/artandcraft/dashboard/my_favourite.php';?>">Favourite Photos</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                    </tr>
                                                                                                                       
                                                        </tbody>
                                                    </table>
                                                    </div><!-- /.table-responsive -->
                                            </div><!-- /.box-body -->
                                            <div class="box-footer clearfix">
                                                <a href="<?php echo $BaseUrl.'/artandcraft/dashboard/';?>" class="btn btn-sm btn-info btn-flat pull-left btn-border-radius">View Module Dashboard</a>
                                                <a href="<?php echo $BaseUrl.'/artandcraft/';?>" class="btn btn-sm btn-primary btn-flat pull-right btn-border-radius">View Module</a>
                                            </div><!-- /.box-footer -->
                                        </div><!-- /.box -->
                                    </div>

                                    <div class="col-md-7">
                                        <!-- Custom tabs (Charts with tabs)-->
                                        <div class="nav-tabs-custom">
                                            <!-- Tabs within a box -->
                                            <ul class="nav nav-tabs pull-right">
                                                <li class="active"><a href="#bar-chart" data-toggle="tab">Bar Chart</a></li>
                                                <!--<li class=""><a href="#chart-two" data-toggle="tab">Donut Chart</a></li>
                                                <li class=""><a href="#pie-chart" data-toggle="tab">Pie Chart</a></li>-->
                                                <li class="pull-left header"><i class="fa fa-pie-chart"></i> Charts</li>
                                            </ul>
                                            <div class="tab-content no-padding">
                                                <!-- Morris chart - Sales -->
                                                <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 348px;">
                                                    <div id="jobBoardChart" style="width: 100%; height: 100%; margin: 0 auto"></div>
                                                </div>
                                                <!-- this is xxtra chart for dummy -->
                                                <div class="chart tab-pane " id="revenue-chart" style="position: relative; height: 348px;">
                                                    
                                                    
                                                </div>
                                                <div class="chart tab-pane" id="chart-two" style="position: relative; height: 348px;">
                                                    
                                                    
                                                </div>
                                                <div class="chart tab-pane" id="pie-chart" style="position: relative; height: 348px;">
                                                    <div id="allmodule"></div>
                                                    
                                                </div>
                                            </div>
                                        </div><!-- /.nav-tabs-custom -->




                                        <!-- solid sales graph -->
                                       <!-- <div class="box box-solid bg-teal-gradient">
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
                                         <!--   <div class="box-footer no-border">
                                              <div class="row">
                                                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                                  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                                  <div class="knob-label">Mail-Orders</div>
                                                </div><!-- ./col -->
                                              <!--  <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                                  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                                  <div class="knob-label">Online</div>
                                                </div><!-- ./col -->
                                              <!--  <div class="col-xs-4 text-center">
                                                  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC"/>
                                                  <div class="knob-label">In-Store</div>
                                                </div><!-- ./col -->
                                            <!--  </div><!-- /.row -->
                                          <!--  </div><!-- /.box-footer -->
                                     <!--   </div><!-- /.box -->
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
                    text: 'Buyer Graph'
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
                    name: 'Art Gallery',
                    colorByPoint: true,
                    data: [{
                        name: "My Orders",
                        y: <?php echo $totBuyOrdr;?>
                    },{
                        name: "Cancel Orders",
                        y: <?php echo $cancel_count;?>
                    },{
                        name: "Return Request",
                        y: <?php echo $return_request; ?>
                    },{
                        name: "Your Board",
                        y: <?php echo $numrows; ?>
                    },{
                        name: "Favourite Photos",
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
                        {label: "Total Art", value: <?php echo $totalProducts;?>},
                        {label: "Active Art", value: <?php echo $totalActive;?>},
                        {label: "Past Art", value: <?php echo $totInActive; ?>},
                        {label: "Draft Art", value: <?php echo $totalDraft; ?>},
                        {label: "Flaged Art", value: <?php echo $totFav;?>},
                        {label: "Your Board", value: <?php echo $numrows;?>},
                        {label: "Total Enquiry", value: <?php echo $totenquiry;?>}
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
                            name: "Total Art",
                            y: <?php echo $totalProducts;?>
                        },{
                            name: "Active Art",
                            y: <?php echo $totalActive;?>
                        },{
                            name: "Past Art",
                            y: <?php echo $totInActive; ?>
                        },{
                            name: "Draft Art",
                            y: <?php echo $totalDraft; ?>
                        }, {
                            name: "Flaged Art",
                            y: <?php echo $totFav;?>
                        },{
                            name: "Your Board",
                            y: <?php echo $numrows;?>
                        },{
                            name: "Total Enquiry",
                            y: <?php echo $totenquiry;?>
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
} ?>