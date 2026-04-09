<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid'])){ 
      include_once ("../authentication/check.php");
      $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class){
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script> 
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END--> 
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
            
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#itemslider').carousel({ interval: 3000 });
                $('.carousel-showmanymoveone .item').each(function(){
                  var itemToClone = $(this);
                for (var i=1;i<3;i++) {
                  itemToClone = itemToClone.next();
                  if (!itemToClone.length) {
                    itemToClone = $(this).siblings(':first');
                  }
                  itemToClone.children(':first-child').clone()
                    .addClass("cloneditem-"+(i))
                    .appendTo($(this));
                  }
                });
            });
        </script>
    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        
                        <?php 
                        $activePage = 1;
                        $storeTitle = " (My Account)";
                        include('top-dashboard.php');
                        include('searchform.php');
                        include('top-dash-menu.php');
                        ?>
                        
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="dash_bg_white" style="min-height: 400px;">
                                    <div class="row">
                                        <div class="col-md-8">

                                            <div class="row">
                                                <div class="col-md-6 " style="padding-right: 0px;">
                                                    <a href="javascript:void(0)">
                                                        <div class="s_m_box text-center bg_store_green">
                                                            <h2>Total Products</h2>
                                                            <h4>
                                                                <?php
                                                                $totalProducts = 0; 
                                                                $p = new _postingview;
                                                                $result = $p->myStoreProduct($_SESSION['pid']);
                                                                if ($result) {
                                                                    echo $totalProducts = $result->num_rows;
                                                                }else{
                                                                    echo 0;
                                                                }
                                                                ?>
                                                            </h4>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-6" style="padding-left: 0px;">
                                                    <a href="javascript:void(0)">
                                                        <div class="s_m_box text-center bg_store_green">
                                                            <h2>Enquires</h2>
                                                            <h4>
                                                                <?php
                                                                $totalEnquires = 0;
                                                                $en = new _postenquiry;
                                                                $result2 = $en->getMyEnquery($_SESSION['pid']);
                                                                if ($result2) {
                                                                    echo $totalEnquires = $result2->num_rows;
                                                                }else{
                                                                    echo 0;
                                                                }
                                                                ?>
                                                            </h4>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-6 " style="padding-right: 0px;">
                                                    <a href="javascript:void(0)">
                                                        <div class="s_m_box text-center bg_store_green">
                                                            <h2>Draft Product</h2>
                                                            <h4>
                                                                <?php
                                                                $totalDraft = 0;
                                                                $en = new _postingview;
                                                                $result3 = $en->readMyDraft($_SESSION['pid']);
                                                                if ($result3) {
                                                                    echo $totalDraft = $result3->num_rows;
                                                                }else{
                                                                    echo 0;
                                                                }
                                                                ?>
                                                            </h4>
                                                        </div>
                                                    </a>
                                                </div>
                                                 <div class="col-md-6 " style="padding-left: 0px;">
                                                    <a href="javascript:void(0)">
                                                        <div class="s_m_box text-center bg_store_green">
                                                            <h2>Order</h2>
                                                            <h4>0</h4>
                                                        </div>
                                                    </a>
                                                </div>


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
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
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
                        value: <?php echo $totalProducts; ?>,
                        color: "#00A3C0",
                        highlight: "#00A3C0",
                        label: "Total Products"
                    },
                    {
                        value: <?php echo $totalEnquires; ?>,
                        color: "#FF6600",
                        highlight: "#FF6600",
                        label: "Enquiry"
                    },
                    {
                        value: <?php echo $totalDraft; ?>,
                        color: "#FF6600",
                        highlight: "#FF6600",
                        label: "Draft"
                    },
                    {
                        value: 0,
                        color: "#3FC5F0",
                        highlight: "#3FC5F0",
                        label: "Order"
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
