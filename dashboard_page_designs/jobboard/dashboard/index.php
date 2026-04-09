<?php

    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){
    $_SESSION['afterlogin']="job-board/";
    include_once ("../../authentication/islogin.php");

}else{
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
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
        $totalJobs = 1;
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

      <?php include('../../component/f_links.php');?>
        <?php include('../../component/links.php');?>
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
        <?php include('../../component/dashboard-link.php'); ?>
        <!-- Morris chart -->
        <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="bg_gray">
        <?php
        include_once("../../header.php");
        ?>
        <section class="landing_page">
            <div class="container">
                <div class="row">

                    <?php include('../thisisjobboard.php'); ?>

                    <div class="sidebar col-md-3 no-padding" id="sidebar" >
                        <?php include('left-menu.php'); ?>
                    </div>
                    <div class="col-md-9">
                        <?php
                        include('top-job-search.php');
                        /*include('inner-breadcrumb.php');*/
                        ?>

                        <div class="row m_top_15">
                            <div class="col-md-5">
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
                               <!--  <div class="nav-tabs-custom">

                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-pie-chart"></i> Donut Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <div class="chart tab-pane active" id="chart-two" style="position: relative; height: 285px;">

                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-md-5">
                                <!-- TABLE: LATEST ORDERS -->
                                <div class="box box-info">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Job Board</h3>
                                        <div class="box-tools pull-right">
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div><!-- /.box-header -->
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <?php
                                            /*$p = new _postingview;*/
                                            $p = new _jobpostings;
                                            $po = new _postings;
                                            $en = new _postenquiry;

                                            // =========ACTIVE POST
                                            $totalActive = 0;
                                            $result4 = $p->profileactivepost(2, $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if ($result4) {
                                                $totalActive = $result4->num_rows;
                                            }

                                            // =========EXPIRED POST
                                            $totExpPost = 0;
                                            $result7 = $p->myExpireProduct(2, $_SESSION['pid']);
                                            if ($result7) {
                                                $totExpPost = $result7->num_rows;
                                            }

                                            // ==========DRAFT POST
                                            $totalDraft = 0;
                                            $result3 = $p->readMyDraftprofile(2, $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if ($result3) {
                                                $totalDraft = $result3->num_rows;
                                            }else{
                                                $totalDraft = 0;
                                            }
                                            // =========SAVED POST
                                          /*  $totFav = 0;
                                            $result5 = $p->mySaveJob($_GET['categoryid'], $_SESSION['pid']);
                                            //echo $p->ta->sql;
                                            if ($result5) {
                                                $totFav = $result5->num_rows;
                                            }

                                            // =========MY FLAGGED POST
                                            $totFlag = 0;
                                            $result2 = $p->myflagPost($_GET['categoryid'], $_SESSION['pid']);

                                            if($result2){
                                                $totFlag = $result2->num_rows;
                                            }
                                            // =========TRASH POST
                                            $totTrash = 0;
                                            $result6 = $p->myTrashPost($_SESSION['pid'], -3, $_GET['categoryid']);
                                            if($result6){
                                                $totTrash = $result6->num_rows;
                                            }
*/
                                            ?>
                                            <table class="table table-striped no-margin">
                                                <tbody>

                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/active-post.php'; ?>">Active Jobs</a></td>
                                                        <td><span class="label label-info"><?php echo $totalActive; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/expired-post.php'; ?>">Expired Jobs</a></td>
                                                        <td><span class="label label-info"><?php echo $totExpPost; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/draft-post.php'; ?>">Draft Jobs</a></td>
                                                        <td><span class="label label-danger"><?php echo $totalDraft; ?></span></td>
                                                    </tr>
                                                     <?php
            if($_SESSION['ptid'] != 1){ ?>
                                               <!--      <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/saved-post.php'; ?>">Saved Jobs</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFav; ?></span></td>
                                                    </tr>

                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/myFlag.php'; ?>">Flagged Jobs</a></td>
                                                        <td><span class="label label-warning"><?php echo $totFlag; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="<?php echo $BaseUrl.'/'.$pageLink.'/dashboard/trash-post.php'; ?>">Trash Jobs</a></td>
                                                        <td><span class="label label-warning"><?php echo $totTrash; ?></span></td>
                                                    </tr>   -->

                                                    <?php } ?>
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
                                        <div class="chart tab-pane active" id="chart-two" style="position: relative; height: 285px;">

                                        </div>
                                    </div>
                                </div> -->
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

                                    </div>
                                </div><!-- /.nav-tabs-custom -->

                               <!--  <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs pull-right">
                                        <li class="pull-left header"><i class="fa fa-pie-chart"></i> Pie Chart</li>
                                    </ul>
                                    <div class="tab-content no-padding">
                                        <div class="chart tab-pane active" id="pie-chart" style="position: relative; height: 285px;">
                                            <div id="allmodule"></div>
                                        </div>
                                    </div>
                                </div> --><!-- /.nav-tabs-custom -->


                            </div>
                        </div><!-- /.row -->



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
                    text: 'Job Board Graph'
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
                        name: "Active Jobs",
                        y: <?php echo $totalActive;?>
                    },{
                        name: "Expired Jobs",
                        y: <?php echo $totExpPost; ?>
                    },{
                        name: "Draft Jobs",
                        y: <?php echo $totalDraft; ?>
                    }, /*{
                        name: "Saved Jobs",
                        y: <?php echo $totFav;?>
                    }, {
                        name: "Flagged Post",
                        y: <?php echo $totFlag;?>
                    }, {
                        name: "Trash Jobs",
                        y: <?php echo $totTrash;?>
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
                        {label: "Active Jobs", value: <?php echo $totalActive;?>},
                        {label: "Expired Jobs", value: <?php echo $totExpPost; ?>},
                        {label: "Draft Jobs", value: <?php echo $totalDraft; ?>},
                       /* {label: "Saved Jobs", value: <?php echo $totFav;?>},
                        {label: "Flagged Job", value: <?php echo $totFlag;?>},
                        {label: "Trash Jobs", value: <?php echo $totTrash;?>}*/
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
                            name: "Active Jobs",
                            y: <?php echo $totalActive;?>
                        },{
                            name: "Expired Jobs",
                            y: <?php echo $totExpPost; ?>
                        },{
                            name: "Draft Jobs",
                            y: <?php echo $totalDraft; ?>
                        }, /*{
                            name: "Saved Jobs",
                            y: <?php echo $totFav;?>
                        }, {
                            name: "Flagged Post",
                            y: <?php echo $totFlag;?>
                        }, {
                            name: "Trash Jobs",
                            y: <?php echo $totTrash;?>
                        }]*/
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
}?>
