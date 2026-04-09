<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "8";
    $_GET["categoryName"] = "Trainings";
    $header_train = "header_train";

    $topPage = 4;
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!-- owl carousel -->
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
        <!--NOTIFICATION-->
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
        <!-- this script for slider art -->
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    autoPlay: true,
                    responsiveClass: true,
                    responsive: {
                      0: {
                        items: 1,
                        nav: false
                      },
                      600: {
                        items: 3,
                        nav: false
                      },
                      1000: {
                        items: 4,
                        nav: false
                      }
                    }
                });
            });    
        </script>
    </head>

    <body class="bg_gray">
         <?php
        include_once("../header.php");
        ?>
        <section>
            <div class="row no-margin">
                <div class="col-md-3 no-padding">
                    <?php 
                    include('../component/left-training.php');
                    ?>
                </div>
                <div class="col-md-9 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <?php
                            include('top-head-inner.php');
                            ?>
                            <div class="col-md-12 no-padding">
                                <div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active" id="video1">

                                        
                                        <div class="bg_white" style="padding: 20px;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="PaymentBox">
                                                        <h3>Payment</h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">

                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered dashTab">
                                                            <tbody>
                                                                <tr>
                                                                    <td><a href="<?php echo $BaseUrl.'/trainings/mytraining.php';?>">My Trainings</a></td>
                                                                    <td>
                                                                        <?php
                                                                        $totaltraing = 0; 
                                                                        $p = new _postingview;
                                                                        $result = $p->myAllSongs($_SESSION['pid'], $_GET['categoryID']);
                                                                        if ($result) {
                                                                            echo $totaltraing = $result->num_rows;
                                                                        }else{
                                                                            echo $totaltraing = 0;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><a href="<?php echo $BaseUrl.'/trainings/favourite.php';?>">Favourite Course</a></td>
                                                                    <td>
                                                                        <?php
                                                                        $favSong = 0; 
                                                                        $p = new _postingview;
                                                                        $result2 = $p->myfavourite_music($_SESSION['pid'], $_GET['categoryID']);
                                                                        if ($result2) {
                                                                            echo $favSong = $result2->num_rows;
                                                                        }else{
                                                                            echo $favSong = 0;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="righ_chart_box">
                                                        <div class="chart">
                                                            <!-- Sales Chart Canvas -->
                                                            <canvas id="pieChart" height="250"></canvas>
                                                        </div><!-- /.chart-responsive -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        <!-- ChartJS 1.0.1 -->
        <script src="<?php echo $BaseUrl; ?>/backofadmin/template/xpert/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script type="text/javascript">
            $(function () {
                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
                var pieChart = new Chart(pieChartCanvas);
                var PieData = [
                    {
                        value: <?php echo $totaltraing; ?>,
                        color: "#00A3C0",
                        highlight: "#00A3C0",
                        label: "Total Course"
                    },
                    {
                        value: <?php echo $favSong; ?>,
                        color: "#FF6600",
                        highlight: "#FF6600",
                        label: "Favourite Course"
                    }
                ];
                var pieOptions = {
                    //Boolean - Whether we should show a stroke on each segment
                    segmentShowStroke: true,
                    //String - The colour of each segment stroke
                    segmentStrokeColor: "#fff",
                    //Number - The width of each segment stroke
                    segmentStrokeWidth: 1,
                    //Number - The percentage of the chart that we cut out of the middle
                    percentageInnerCutout: 50, // This is 0 for Pie charts
                    //Number - Amount of animation steps
                    animationSteps: 100,
                    //String - Animation easing effect
                    animationEasing: "easeOutBounce",
                    //Boolean - Whether we animate the rotation of the Doughnut
                    animateRotate: true,
                    //Boolean - Whether we animate scaling the Doughnut from the centre
                    animateScale: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,
                    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: false,
                    //String - A legend template
                    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
                    //String - A tooltip template
                    tooltipTemplate: "<%=value %> <%=label%>"
                };
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.  
                pieChart.Doughnut(PieData, pieOptions);
                //-----------------
                //- END PIE CHART -
                //-----------------
            });
        </script>
	</body>
</html>
