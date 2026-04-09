<!DOCTYPE html>
<html lang="en">
<head>
	<title>TheSharePage.com</title>
	<link rel="stylesheet" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" href="../../css/jquery-ui.min.css"> 
	<link rel="stylesheet" href="../../css/font-awesome.min.css"> 
	<link rel="stylesheet" href="../../css/home.css"> 
	<script src="../../js/jquery-2.1.4.min.js"></script>
	<script src="../../js/jquery-1.11.4-ui.min.js"></script>
	<script src="../../js/bootstrap.min.js"></script>
	<script src="../../js/home.js"></script>
	<link href="https://api.highcharts.com/highcharts">
</head>
<body onload="pageOnload('details')">
<?php 
		session_start();
	
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		include_once("../masterheader.php");
?>


<div class="container-fluid">
   <div class="row" style="margin-top:20px;">
	<div class="col-md-3">
		<!--Most Liked Post-->
		<div class="panel panel-default ">
			<div class="panel-heading"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">Most Liked Posts</h3></div>
			<div class="panel-body">
				<div id="mostlikedpost">
					<?php
						$p = new _postlike;
						//$res = $p->mostlikedpost($_SESSION["uid"]);
						$res = $p->admininfo();								
						if($res != false)
						{
							while($row = mysqli_fetch_array($res))
							{
								//echo $row["spPostings_idspPostings"]." ".$row["count"] ."<br>";
								echo "<div class='imagehover post-highlight'><a href='../../post-details/?postid=".$row["spPostings_idspPostings"]."' style='text-decoration:none;'>";
								$title = new _postings;
								$re = $title->read($row["spPostings_idspPostings"]);
								if($re!= false)
								{
									$rw = mysqli_fetch_assoc($re);
									echo "<div class='title commentoverflow' style='font-size:18px;'>".$rw["spPostingTitle"]."</div>";
								}
								
								$pic = new _postingpic;
								$result = $pic->read($row["spPostings_idspPostings"]);
								if($result!= false)
								{	
										$rp = mysqli_fetch_assoc($result);
										$picture = $rp['spPostingPic'];

								}
								
								echo "<div class='row' style='margin-top:10px;'>";
									echo "<div class='col-md-6'><img alt='Posting Pic' class='img-thumbnail post-img' src=' ".($picture)."' height='80' width='80'></div>" ;
									
									echo "<div class='col-md-6'><span style='font-size:40px;'>".$row["count"]."</span><span style='color:gray;'> Likes</span></div>";
								echo "</div>";
								echo "</a></div>";
								echo "<hr class='hrline' style='margin-top:10px;'></hr><br>";
							}
						}
					?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default dashborddiv">
					<div class="panel-heading"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">Total Groups</h3></div>
					<div class="panel-body">
						<?php 
							$g = new _spgroup;
							$res = $g->totalgroup();
							$total = 0 ; 
							if ($res != false){
								$total = $res->num_rows;
								while($row = mysqli_fetch_assoc($res)) {
									//echo $row['spGroupName'];					
								}
							}
						?>
						<div style="font-size:40px; margin-left:20px;"><?php echo ($total == 0 ?"NO DATA ":$total); ?></div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default dashborddiv">
					<div class="panel-heading"><a href="#" ><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">Total User</h3></a></div>
					<div class="panel-body">
						<?php
							$total = 0;
							$u = new _spuser;
							$res = $u->totaluser();
							
							if($res != false)
							{
								$total = $res->num_rows;
							}
							
						?>
						
						<div><a href="../my-friend/" style="<?php echo ($total == 0 ?"font-size:18px; color:#114b5f;":"text-decoration:none;font-size:40px; color:#114b5f; margin-left:17px;"); ?>"><?php echo ($total == 0 ?"NO DATA FOUND":$total); ?></a></div>

					</div>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="panel panel-default dashborddiv">
					<div class="panel-heading"><a href="#"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">User Profiles</h3></a></div>
					<div class="panel-body">
						<?php
							$total = 0;
							$p = new _spprofiles;
							$rpvt = $p->totalprofiles();		
							if($rpvt != false)
							{
								$total = $rpvt->num_rows;
							}
						?>
						<div><a href="../my-profile/" style="<?php echo ($total == 0 ?"font-size:18px; color:#114b5f;":"text-decoration:none;font-size:40px; color:#114b5f; margin-left:17px;"); ?>"><?php echo ($total == 0 ?"NO DATA FOUND":$total); ?></a></div>
						
					</div>
				</div>
			</div>

		<div class="col-md-3">
			<div class="panel panel-default dashborddiv">
				<div class="panel-heading"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">Sharepage Points</h3></div>
				<div class="panel-body">
					<?php
						$p = new _order;
						$res = $p->totalpoint();
						//echo $p->ta->sql;
						$sharepagepoint = 0;
						if($res != false){ 
							while($row = mysqli_fetch_assoc($res))//My Store
							{
								$cat = new _postingview;//Getting Category Id
								$re = $cat->read($row['spPostings_idspPostings']);
								if($re != false)
								{ 
									$rw = mysqli_fetch_assoc($re);
									$category = $rw["idspCategory"];
								}
								
								$c = new _sharepagecharge;//For Getting Sharepage Charges
								$result = $c->read($category);
								if($result != false)
								{
									$rows = mysqli_fetch_assoc($result);
									$chargevariable= $rows["spSharePageChargesVariable"];
									$charges = $rows["spSharePageCharges"];
								}
								
								$sharepagepoint += ($row['sporderAmount']*($charges/100)*$chargevariable);
							}
						}
					?>
					<div style="font-size:30px; color:#114b5f;"><?php echo ($sharepagepoint== 0 ?"NO DATA FOUND" : $sharepagepoint);?></div>

				</div>
			</div>
		</div>
		
		</div>
		<?php
			$p = new _postingview;
			$res = $p->totalposts();
			$sum = 0;
			if($res != false)
			{ 
				$sum = $res->num_rows;
			}
			
			$executed = 0;
			$res = $p->totalsoldpost();
			if($res != false)//Executed
			{
				 $executed = $res->num_rows;
			}
			
			$active = 0;
			$res = $p->totalactivepost();
			if($res != false)//Active
			{
				 $active = $res->num_rows;
			}
			
			$expired = 0;
			$res = $p->totalexpiredpost();
			if($res != false)//Expired
			{
				 $expired = $res->num_rows;
			}
			
			$total = $executed +  $active + $expired;
			
			
			$res = $p->myfavoritepost($_SESSION['uid']);
			$favorite = 0;
			if($res != false){ 
				while($row = mysqli_fetch_assoc($res))
				{
					$favorite += $row['count'];
				}
			}
		?>
		
		<div class="row">
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading"><a href="../my-store/"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">Sharepage Stores</h3></a></div>
					<div class="panel-body">
						<div align="center"><span style="color:gray">Total Posts </span><span style="font-size:40px;"><?php echo $sum ;?></span></div>
						<hr>
						<div id="container"></div>
					</div>
				</div>
			</div>
			
			<div class="col-md-3">
				<div class="panel panel-default ">
					<div class="panel-heading"><a href="../my-posts/"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">About Posts</h3></a></div>
					<div class="panel-body">
						<div align="center"><span style="color:gray">Total </span><span style="font-size:40px;"><?php echo $total  ;?></span></div>
						<hr>
						<div id="mypostcontainer"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6"></div>
		</div>
		<!--Revanue Chart Month wise and year wise-->
			<div class="panel panel-default "><!--Year wise-->
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-3">
							<a href="#"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">Revenue Chart (Year - <span id="currentyear"><?php echo $_SESSION['year']?></span>) </h3></a>
						</div>
						<!--Month droup down list-->
						<div class="col-md-9">
							<div class="dropdown pull-right">
								<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span><?php echo $_SESSION['year']?></span><span class="caret"></span></button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<?php
										$p = new _postings;
										$result = $p->year($_GET["year"]);
										if($result != false)
										{
											while($rows = mysqli_fetch_assoc($result))
											{
												$date = new datetime($rows["sppostingsTransactionDate"]);
												echo "<li><a href='/admin/dashboard.php/' class='years'>".$date->format('Y')."</a></li>";
											}
										}
										
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div id="revanuecontainer" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
				</div>
			</div>
		<!--Revanue Chart Code Complete-->
		
		<!--Revanue Chart Category wise-->
			<div class="panel panel-default "><!--Category wise-->
				<div class="panel-heading">
					<div class="row">
						<div class="col-md-4">
							<a href="#"><h3 class="panel-title title" style="color:#114b5f; font-size:17px;" id="mystoreChart">Revenue Chart (Category wise) </h3></a>
						</div>
						<div class="col-md-8">
							<div class="dropdown pull-right">
								<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span id="monthdet" data-monthval="<?php echo $_SESSION['monthvalue']?>"><?php echo $_SESSION['monthtext'];?></span><span class="caret"></span></button>
								<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									<li><a href="/admin/dashboard.php/" class="mnth"  data-month="01">January</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="02">February</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="03">March</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="04">April</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="05">May</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="06">June</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="07">July</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="08">August</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="09">September</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="10">October</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="11">November</a></li>
									
									<li><a href="/admin/dashboard.php/" class="mnth" data-month="12">December</a></li>
									
									
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-body">
					<div id="revanuecategory" style="min-width: 300px; height: 400px; margin: 0 auto"><!--Rendering--></div>
				</div>
			</div>
		<!--Revanue Chart Code Complete-->
	</div><!--Row 10-->
   </div><!--Row-->
   <script src="http://code.highcharts.com/highcharts.js"></script>
</div>
</body>	
</html>