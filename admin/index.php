<!DOCTYPE html>
<html lang="en">
<head>
    <title>TheSharePage.com</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.min.css">
	<link rel="stylesheet" href="/css/home.css"> 
	<link rel="stylesheet" href="/css/font-awesome.min.css"> 
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/home.js"></script>
	<link rel="stylesheet" href="/css/sweetalert.css">
	<script src="/js/sweetalert-dev.js"></script>
	<script src="/js/sweetalert.min.js"></script>
</head>
<body onload="pageOnload('cart')">

	<?php
		session_start();
		function sp_autoloader($class){
		//include $BaseUrl . '/mlayer/' . $class . '.class.php';
		include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../../masterheader.php");
	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
				<?php include ("mastercat.php")?>
			</div>
			<div class="col-md-10">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $_GET["categoryname"];?></h3>
					</div>
					<div class="panel-body">
						<?php
							switch($_GET["module"]){
							case 1: 
								include("buysell.php");
							break;

							case 2:
								include("jobboard.php");
							break;

							case 3:
								include("realestate.php");
							break;

							case 4:
								include("cartransport.php");
							break;

							case 5:
								include ("freelancer.php");
							break;

							case 6:
								include ("document.php");
							break;

							case 7:
								include ("services.php");
							break;
							case 8:
								include ("training.php");
							break;

							case 9:
							include ("event.php");
							break;

							case 10:
								include ("videos.php");
							break;

							case 11:
								include ("recipe.php");
							break;

							case 12:
								include ("datingmatch.php");
							break;

							case 13:
								include ("photos-images.php");
							break;

							case 14:
								include ("music.php");
							break;

							case 15:
								include ("coupons.php");
							break;
							
							case 18:
								include ("buy.php");
							break;
							
							case 23:
								include ("genre.php");
							break;
							
							}
							
							
							
							if($_GET["membershipdetails"] == 1)
							{
							 echo "<div class='row'>";
							  echo "<div class='col-md-11'>";
								$mem = new _spmembership;
								$res = $mem->read();
								if($res != false)
								{
									echo "<table class='table'>";
										echo "<thead>
										  <tr>
											<th>Membeship type</th>
											<th>Membership limit</th>
											<th>Membership Duration</th>
											<th>Membership Amount</th>
										  </tr>
										</thead>";
										echo "<tbody>";
									while($rows = mysqli_fetch_assoc($res))
									{
										
										if($rows["idspMembership"] != 0)
										{
											echo "<tr class='membershipdetail' data-memid='".$rows["idspMembership"]."' >";
												echo "<td><input type='text' class='form-control memershipdet memname' value='".$rows["spMembershipName"]."'></td>";
												
												echo "<td><input type='text' class='form-control memershipdet mlimit' value='".$rows["spMembershipPostlimit"]."'></td>";
												
												echo "<td><input type='text' class='form-control memershipdet mdurarion' value='".$rows["spMembershipDuration"]."'></td>";
												
												echo "<td><input type='text' class='form-control memershipdet mamount' value='".$rows["spMembershipAmount"]."'></td>";
												
												//echo "<td><a href='#' data-memid='".$rows["idspMembership"]."' class='savemembership'><span class='glyphicon glyphicon-save'></span> Save</a></td>";
												
											 echo "</tr>";
												
										}
										
									}
				
									echo "</tbody>";
									echo "</table>";
									
								}
							 echo "</div>";
							 echo "<div class='col-md-1'>";
								echo "<a href='#' class='savemembership'><span class='glyphicon glyphicon-save'></span> Save</a>";
							 echo "</div>";
							 echo "</div>";
							}
						?>
						
						
					</div>
				</div>
			</div>
			<div class="col-md-1">
				<?php include ("manageothers.php")?>
			</div>
		</div>
	</div><!--Container-->
		
	<!--Modal-->
	<div class="modal fade" id="addupdate" tabindex="-1" role="dialog" aria-labelledby="addUpdateModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="addUpdateModalLabel" style="font-weight:bold;"><!--Dynamic Load--></h3>
				</div>
				<div class="modal-body">
					<form action="../addDetails.php" method="post">
						<div class="form-group">
							<input type="hidden" class="master_idmaster" name="master_idmaster" value="<?php echo $masterid;?>">
							
							<input type="hidden" class="idmasterDetails" name="idmasterDetails_">
							
							<label for="message-text" class="control-label"><!--Dynamic Load--></label>
							
							<input type="text" class="form-control" id="masterDetails" name="masterDetails">
							
							<input type="hidden" name="categoryfolder_" value="<?php echo $_GET["categoryfolder"]; ?>">
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--Modal Complete-->
</body>
</html>