<?php
   
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");


    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";
    $activePage = 1;

     //check profile is job board or not
    if($_SESSION['ptid'] != 1){
        header('location:'.$BaseUrl.'/job-board/');
    }

    $p = new _postingview;
    //get my all jobs which i am posted
    $result = $p->myAllJobsPosted(2, $_SESSION['pid']);
    //echo $p->ta->sql;
    if($result){
        $totalJobs = $result->num_rows;
    }else{
        $totalJobs = 0;
    }
    //my active jobs
    $result2 = $p->myProfilejobpost($_SESSION['pid']);
    if($result2){
        $activejob = $result2->num_rows;
    }else{
        $activejob = 0;
    }
    //total jobs posted. Each job post have 100;
    $graph_job = ($totalJobs / 100) * 100;

    //calculate % of active jobs
    $active_percntage = ($activejob / $totalJobs) * 100;

    $result3 = $p->getAllAplicant(2, $_SESSION['pid']);
    //echo $p->ta->sql;
    if($result3){
        $totalAplicant = $result3->num_rows;
    }else{
        $totalAplicant = 0;
    }
    $totalAplicantGraph = ($totalAplicant / $totalJobs) * 100;
    //get total shortlist person
    $result4 = $p->getAllShortList(2, $_SESSION['pid']);
    //echo $p->ta->sql;
    if($result4){
        $totalShortlist = $result4->num_rows;
    }else{
        $totalShortlist = 0;
    }
    //calculate shortlisted %
    if($totalAplicant > 0){
        $sl_percentage = ($totalShortlist / $totalJobs) * 100;
    }else{
        $sl_percentage = 0;
    }

    $result5 = $p->myDeactiveProfilejob($_SESSION['pid']);
    //echo $p->ta->sql;
    if($result5){
        $totalDeactive = $result5->num_rows;
    }else{
        $totalDeactive = 0;
    }
    $deGraph = ($totalDeactive / $totalJobs) * 100;
     $header_jobBoard = "header_jobBoard";




     $_GET["categoryid"] = "2";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!-- High Charts script -->
        <script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <!--CSS FOR MULTISELECTOR-->
        <link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            //USER ONE
            $(function () {
                $('#leftmenu').multiselect({
                    includeSelectAllOption: true
                });
            });
            //JOB MENU
            $(function () {
                $('#jobmenu').multiselect({
                    includeSelectAllOption: true
                });
            });
            //form submit
            function sendJobid(e){
                
                var selected = $("#jobmenu option:selected");
                var ids = "";
                selected.each(function () {
                    ids += +$(this).val() + ",";
                });
                $.ajax({
                    type: "POST",
                    url: "getchart.php",
                    data:'postid='+ ids,
                    success: function(html){
                        $("#showgraph").html(html);
                    }
                });
            }
        </script>

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
        <section class="landing_page">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php include('../component/left-jobboard.php');?>
                    </div>
                    <div class="col-md-9 no-padding">
                        <?php 
                        include('top-job-search.php');
                        include('inner-breadcrumb.php');
                        ?>
                        <div class="whiteboardmain">
                            <div class="row">
                                <form method="post" action="search.php">
                                    <div class="col-md-3 ">
                                        <div class="form-group">
                                            <select class="form-control no-radius" name="txtYear">
                                                <option value="">Select Year</option>
                                                <?php 
                                                $start = 2014;
                                                $end = date('Y') + 1;
                                                while ($start <= $end) {
                                                    echo "<option value='".$start."'>".$start."</option>";
                                                    $start++;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 no-padding">
                                        <div class="form-group" id="monthjob">
                                            <select id="leftmenu" name="txtMonth[]" multiple="multiple" class="form-control" >  
                                                <option value="01">January</option>
                                                <option value="02">February</option>
                                                <option value="03">March</option>
                                                <option value="04">April</option>
                                                <option value="05">May</option>
                                                <option value="06">June</option>
                                                <option value="07">July</option>
                                                <option value="08">August</option>
                                                <option value="09">September</option>
                                                <option value="10">October</option>
                                                <option value="11">November</option>
                                                <option value="12">December</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2">
                                        <input type="submit" name="btndashboard" class="btn create_add" value="Go">
                                    </div>
                                </form>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select id="jobmenu" name="txtjob[]" multiple="multiple" class="form-control" >  
                                            <?php
                                            $result2 = $p->myProfilejobpost($_SESSION['pid']);
                                            if($result2){
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo '<option value="'.$row2['idspPostings'].'">'.$row2['spPostingtitle'].'</option>';
                                                }
                                            }
                                            ?>                                            
                                        </select>
                                        <input type="button" name="btnjobstat" id="btnjobstat" class="btn create_add" onclick="sendJobid();" value="Go">
                                    </div>
                                </div>
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

                                            // =========Applicant Received
                                            $totalAplicant = 0;
                                            $result2 = $p->getAllAplicant($_GET['categoryid'], $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if($result2){
                                                $totalAplicant = $result2->num_rows;
                                            }
                                            // =========SHORT LISTED
                                            $totalShortlist = 0;
                                            $result6 = $p->getAllShortList(2, $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if($result6){
                                                $totalShortlist = $result6->num_rows;
                                            }

                                            ?>
                                            <table class="table table-striped no-margin">
                                                <tbody>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Total Jobs</a></td>
                                                        <td><span class="label label-success"><?php echo $totalProducts; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/job-board/manage-jobs.php';?>">Active Jobs</a></td>
                                                        <td><span class="label label-info"><?php echo $totalActive; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/job-board/deactive-job.php';?>">Past Jobs</a></td>
                                                        <td><span class="label label-info"><?php echo $totInActive; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/job-board/drafts.php'; ?>">Draft Jobs</a></td>
                                                        <td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Favourite Jobs</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Applicant Received</a></td>
                                                        <td><span class="label label-warning"><?php  echo $totalAplicant; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="javascript:void(0)">Short Listed</a></td>
                                                        <td><span class="label label-warning"><?php  echo $totalShortlist; ?></span></td>
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
                                        <div class="chart tab-pane active" id="chart-two" style="position: relative; height: 285px;">   

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
                                        <div class="chart tab-pane active" id="bar-chart" style="position: relative; height: 285px;">
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
                                        <div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 285px;">   
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
                    name: 'Job Board',
                    colorByPoint: true,
                    data: [{
                        name: "Total Jobs",
                        y: <?php echo $totalProducts;?>
                    },{
                        name: "Active Jobs",
                        y: <?php echo $totalActive;?>
                    },{
                        name: "Past Jobs",
                        y: <?php echo $totInActive; ?>
                    },{
                        name: "Draft Jobs",
                        y: <?php echo $totalDraft; ?>
                    }, {
                        name: "Favourite Jobs",
                        y: <?php echo $totFav;?>
                    }, {
                        name: "Applicant Received",
                        y: <?php echo $totalAplicant;?>
                    }, {
                        name: "Short Listed",
                        y: <?php echo $totalShortlist;?>
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
                        {label: "Total Jobs", value: <?php echo $totalProducts;?>},
                        {label: "Active Jobs", value: <?php echo $totalActive;?>},
                        {label: "Past Jobs", value: <?php echo $totInActive; ?>},
                        {label: "Draft Jobs", value: <?php echo $totalDraft; ?>},
                        {label: "Favourite Jobs", value: <?php echo $totFav;?>},
                        {label: "Applicant Received", value: <?php echo $totalAplicant;?>},
                        {label: "Short Listed", value: <?php echo $totalShortlist;?>}
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
                            name: "Total Jobs",
                            y: <?php echo $totalProducts;?>
                        },{
                            name: "Active Jobs",
                            y: <?php echo $totalActive;?>
                        },{
                            name: "Past Jobs",
                            y: <?php echo $totInActive; ?>
                        },{
                            name: "Draft Jobs",
                            y: <?php echo $totalDraft; ?>
                        }, {
                            name: "Favourite Jobs",
                            y: <?php echo $totFav;?>
                        }, {
                            name: "Applicant Received",
                            y: <?php echo $totalAplicant;?>
                        }, {
                            name: "Short Listed",
                            y: <?php echo $totalShortlist;?>
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
