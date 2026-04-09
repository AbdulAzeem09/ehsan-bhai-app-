    

    <div class="box-header with-border">
        <h3 class="box-title">Dashboard</h3>
        
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="row">
    		<div class="col-md-8">
    			<div class="row userDash">
		        	<div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Total Friend</span>
			                  	<span class="info-box-number"><?php totalProfileFriends($dbConn, $pid);?> <small>People</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Total Groups</span>
			                  	<?php  totalProfileGroups($dbConn, $pid); ?>
			                  	
			                  	
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-store"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Store </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'spproduct', $pid);?><small> Products</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-freelance"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Freelancer </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'spfreelancer', $pid);?> <small>Projects</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		             <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-jobboard"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Job Board </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'spjobboard', $pid);?> <small>Jobs</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-realestate"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Real Estate </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'sprealstate', $pid);?> <small>Property</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		             <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-events"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Events </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'spevent', $pid);?> <small>Events</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-artgallery"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Art Gallery </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'sppostingsartcraft', $pid);?> <small>Photos</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		             <!--<div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-music"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Music </span>
			                  	<span class="info-box-number"><?php totalMyStoreProduct($dbConn, 14, $pid);?> <small>Songs</small></span>
			                </div>
		              	</div> 
		            </div>  -->
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-video"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Videos </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'spvideo', $pid);?> <small>Videos</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		             <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-trainings"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Trainings </span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'sptraining', $pid);?><small> Course</small></span>
			                </div><!-- /.info-box-content -->
		              	</div><!-- /.info-box -->
		            </div><!-- /.col -->
		            <div class="col-md-6 col-sm-6 col-xs-12">
		              	<div class="info-box">
			                <span class="info-box-icon label-clasified"><i class="ion ion-ios-gear-outline"></i></span>
			                <div class="info-box-content">
			                  	<span class="info-box-text">Classified Adds</span>
			                  	<span class="info-box-number"><?php totalMyProduct($dbConn, 'spclassified', $pid);?> <small>Servoces</small></span>
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
							<?php 
						  $sql="SELECT * FROM `spprofile_feature` WHERE idspProfile_to = $pid";
						  $result = dbQuery($dbConn, $sql);
						  if(dbNumRows($result) > 0){
							$count = dbNumRows($result);
						}else{
							$count = '0';
						}
						  ?>
                        	<strong>Report of that user : <?php echo $count ;?></strong>
                      	</p>
                      	<div class="chart">
                        	<!-- Sales Chart Canvas -->
                        	<canvas id="pieChart" height="250"></canvas>
                      	</div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="space"></div>
    			<div class="box-footer no-padding">
                  	<ul class="nav nav-pills nav-stacked">
	                    <li><a href="#">Store <span class="pull-right text-store">			 <?php totalMyProduct($dbConn, 'spproduct', $pid);?> Products</span></a></li>

	                    <li><a href="#">Freelance <span class="pull-right text-freelance">		 <?php totalMyProduct($dbConn, 'spfreelancer', $pid);?> Projects</span></a></li>

	                    <li><a href="#">Job Board <span class="pull-right text-jobboard">		 <?php totalMyProduct($dbConn, 'spjobboard', $pid);?> Jobs</span></a></li>

	                    <li><a href="#">Real Estate <span class="pull-right text-realestate">		 <?php totalMyProduct($dbConn, 'sprealstate', $pid);?> Property</span></a></li>

	                    <li><a href="#">Events <span class="pull-right text-events">			 <?php totalMyProduct($dbConn, 'spevent', $pid);?> Events</span></a></li>

	                    <li><a href="#">Art Gallery <span class="pull-right text-artgallery">	 <?php totalMyProduct($dbConn, 'sppostingsartcraft', $pid);?> Photos</span></a></li>

	                    <!-- <li><a href="#">Music <span class="pull-right text-music">			 <?php totalMyProduct($dbConn, 'spproduct', $pid);?> Songs</span></a></li> -->

	                    <li><a href="#">Videos <span class="pull-right text-video">			 <?php totalMyProduct($dbConn, 'spvideo', $pid);?> Videos</span></a></li>

	                    <li><a href="#">Trainings <span class="pull-right text-trainings">		 <?php totalMyProduct($dbConn, 'sptraining', $pid);?> Courses</span></a></li>

	                    <li><a href="#">Classified Adds <span class="pull-right text-clasified"><?php totalMyProduct($dbConn, 'spclassified', $pid);?> Services</span></a></li>
                  	</ul>
                </div><!-- /.footer -->
    		</div>
    	</div>
        
    </div><!-- /.box-body -->




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
			      	value: <?php totalMyStoreProduct($dbConn, 1, $pid);?>,
			      	color: "#00A3C0",
			      	highlight: "#00A3C0",
			      	label: "Store"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 5, $pid);?>,
			      	color: "#FF6600",
			      	highlight: "#FF6600",
			      	label: "Freelancer"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 2, $pid);?>,
			      	color: "#3FC5F0",
			      	highlight: "#3FC5F0",
			      	label: "Job Board"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 3, $pid);?>,
			      	color: "#0091CA",
			      	highlight: "#0091CA",
			      	label: "Real Estate"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 9, $pid);?>,
			      	color: "#FE2232",
			      	highlight: "#FE2232",
			      	label: "Events"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 13, $pid);?>,
			      	color: "#FF6600",
			      	highlight: "#FF6600",
			      	label: "Art Gallery"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 14, $pid);?>,
			      	color: "#BF0F4D",
			      	highlight: "#BF0F4D",
			      	label: "Music"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 10, $pid);?>,
			      	color: "#1758B4",
			      	highlight: "#1758B4",
			      	label: "Videos"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 8, $pid);?>,
			      	color: "#417281",
			      	highlight: "#417281",
			      	label: "Trainings"
			    },
			    {
			      	value: <?php totalMyStoreProduct($dbConn, 7, $pid);?>,
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
    