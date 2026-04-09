    
<?php
    if (!defined('WEB_ROOT')) {
        exit;
    }


?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
	    <h1>Posting Dashboard</h1>
	    <ol class="breadcrumb">
	        <li><a href="<?php echo WEB_ROOT_ADMIN; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	       <li class="active">Posting Dashboard</li>
	    </ol>
	</section>
    
    <section class="content">
	    <div class="">
	    	<div class="row">
	    		<div class="col-md-8">
	    			<div class="row userDash">
			        	
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-store"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Store </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 1);?> <small>Products</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-freelance"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Freelancer </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 5);?> <small>Projects</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			             <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-jobboard"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Job Board </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 2);?> <small>Jobs</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-realestate"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Real Estate </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 3);?> <small>Property</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			             <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-events"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Events </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 9);?> <small>Events</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-artgallery"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Art Gallery </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 13);?> <small>Photos</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			             <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-music"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Music </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 14);?> <small>Songs</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-video"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Videos </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 10);?> <small>Videos</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			             <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-trainings"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Trainings </span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 8);?> <small>Course</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->
			            <div class="col-md-6 col-sm-6 col-xs-12">
			              	<div class="info-box">
				                <span class="info-box-icon label-clasified"><i class="ion ion-ios-gear-outline"></i></span>
				                <div class="info-box-content">
				                  	<span class="info-box-text">Classified Adds</span>
				                  	<span class="info-box-number"><?php totalPostProduct($dbConn, 7);?> <small>Services</small></span>
				                </div><!-- /.info-box-content -->
			              	</div><!-- /.info-box -->
			            </div><!-- /.col -->





			        </div>
	    		</div>
	    		<div class="col-md-4">
	    			<!-- CHART OR GRAPH -->
	    			<div class="row">
	                    <div class="col-md-12">
	                      	<p class="text-center">
	                        	<strong>Report of that user</strong>
	                      	</p>
	                      	<div class="chart">
	                        	<!-- Sales Chart Canvas -->
	                        	<canvas id="pieChart" height="250"></canvas>
	                      	</div><!-- /.chart-responsive -->
	                    </div><!-- /.col -->
	                </div><!-- /.row -->
	                
	    		</div>
	    	</div>
	        
	    </div><!-- /.box-body -->
	</section>



    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo WEB_ROOT_TEMPLATE;  ?>/assets/admin/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
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
			      	value: <?php totalPostProduct($dbConn, 1);?>,
			      	color: "#00A3C0",
			      	highlight: "#00A3C0",
			      	label: "Store"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 5);?>,
			      	color: "#FF6600",
			      	highlight: "#FF6600",
			      	label: "Freelancer"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 2);?>,
			      	color: "#3FC5F0",
			      	highlight: "#3FC5F0",
			      	label: "Job Board"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 3);?>,
			      	color: "#0091CA",
			      	highlight: "#0091CA",
			      	label: "Real Estate"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 9);?>,
			      	color: "#FE2232",
			      	highlight: "#FE2232",
			      	label: "Events"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 13);?>,
			      	color: "#FF6600",
			      	highlight: "#FF6600",
			      	label: "Art Gallery"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 14);?>,
			      	color: "#BF0F4D",
			      	highlight: "#BF0F4D",
			      	label: "Music"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 10);?>,
			      	color: "#1758B4",
			      	highlight: "#1758B4",
			      	label: "Videos"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 8);?>,
			      	color: "#417281",
			      	highlight: "#417281",
			      	label: "Trainings"
			    },
			    {
			      	value: <?php totalPostProduct($dbConn, 7);?>,
			      	color: "#09A4AE",
			      	highlight: "#09A4AE",
			      	label: "Classified Adds"
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
			    tooltipTemplate: "<%=value %> <%=label%> users"
		  	};
		  	//Create pie or douhnut chart
		  	// You can switch between pie and douhnut using the method below.  
		  	pieChart.Doughnut(PieData, pieOptions);
		  	//-----------------
		  	//- END PIE CHART -
		  	//-----------------
    	});
    </script>
    