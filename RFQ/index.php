<!DOCTYPE html>
<html lang="en">
<head>
	<title>SharePage.com</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery-ui.min.css"> 
	<link rel="stylesheet" href="../css/font-awesome.min.css"> 
	<link rel="stylesheet" href="../css/home.css">
	<script src="../js/jquery-2.1.4.min.js"></script>
	<script src="../js/jquery-1.11.4-ui.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/home.js"></script>
  <?php 
		session_start();
			function sp_autoloader($class){
					include '../mlayer/' . $class . '.class.php';
				}
				spl_autoload_register("sp_autoloader");
				include_once("../header.php");
			
			$profile = new _spprofiles;
			$res = $profile->read($_SESSION["pid"]);
			if($res != false)
			{
				$row = mysqli_fetch_assoc($res);
				$buyeremail = $row["spProfileEmail"];
				$buyername =  $row["spProfileName"];
				$buyerphone = $row["spProfilePhone"];
			}
	?>
</head>
<body onload="pageOnload('admin')">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1 hidden-sm hidden-xs">
				<?php
					include_once("../categorysidebar.php");
				?>
			</div>
			<div class="col-md-10">
			<div class="panel panel-success">
			  <div class="panel-heading">
				<div class="btn-group" role="group" aria-label="...">
				
					<a href="../RFQ/" type="button" class="btn btn-default <?php echo ($_GET["quotationid"]=="" ? "active" : "")?>">Active</a>
					
					<a href="../acceptedquote/" type="button" class="btn btn-default <?php echo ($_GET["quotationid"]==1 ? "active": "")?>">Accepted</a>
					
					<a href="../rejectedquote/" type="button" class="btn btn-default <?php echo ($_GET["quotationid"]==2 ? "active" : "")?>">Archived</a>
					
					<a href="../draftquote/" type="button" class="btn btn-default <?php echo ($_GET["quotationid"]==4 ? "active" : "")?>">Draft</a>
				</div>
			  </div>
				 <div class="panel-body">
					<?php
							if( $_GET["quotationid"]==1)
							{
								$_GET["quoteid"]= 1; //Accepted
								include("quotation.php");
							}
							
							elseif($_GET["quotationid"]==2)
							{
								$_GET["quoteid"]= 2; //Archived
								include("quotation.php");
							}
							
							elseif($_GET["quotationid"]=="")
							{
								$_GET["quoteid"]= 3; //Active
								include("quotation.php");
							}
							
							elseif($_GET["quotationid"]==4)
							{
								$_GET["quoteid"]= 4; //Draft
								include("quotation.php");
							}
					?>
				 </div>
			 </div>
		</div>
			<div class="col-md-1">
				<?php
						include_once("../sidebar.php");
					?>
			</div>
		</div>
	</div>
</body>
</html>
