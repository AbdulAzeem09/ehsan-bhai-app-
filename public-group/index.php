<!DOCTYPE html>
<html lang="en">
<head>
    <title>TheSharePage.com</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.min.css">
	<link rel="stylesheet" href="/css/home.css">
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/home.js"></script>
</head>
<body onload="pageOnload('cart')">

		<?php
			session_start();
			if(!isset($_SESSION['pid']))
			{	
				include_once ("../authentication/check.php");
				$_SESSION['afterlogin']="public-group/";
			}
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../header.php");
		?>
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-1">
				<?php
					include_once("../categorysidebar.php");
				?>
				</div>
				<div class="col-md-10" style="margin-top:45px;">
				<!-- Search Group -->
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">Search Group</span>
							<input type="text" class="form-control" placeholder="Type Group Name" id="searchtx">
						</div>
					</div>
					<div class="col-md-4"></div>
				</div>
				<!-- Search Group-->
				
				<?php
					$g = new _spgroup;
					$result = $g->publicgroup();
					if ($result != false)
					{
						while($row = mysqli_fetch_assoc($result))
						{
							echo "<div class='pubgroup searchable'>";
								echo "<div class='title' style='font-size:18px;'>".$row['spGroupName']."</div>";
								
								echo "<div class='pgroup'>".$row["spGroupAbout"]."</div>";
								
								$res = $g->grpmember($row['idspGroup']); 
								if($res != false)
								{
									$total = $res->num_rows;
									echo "<div>Total Memebr : <b>".$total."</b></div>"; 
								}
								
								$rs = $g->checkmember($row['idspGroup'] , $_SESSION["uid"]);
								
								if($rs != false)
								{
									echo "<div><button type='button' class='btn btn-success pull-right disabled' data-gid='".$row['idspGroup']."' data-pid='".$_SESSION['pid']."'>Joined</button></div><br>";
								}
									
								else
									echo "<div><button type='button' class='btn btn-success pull-right joingroup' data-gid='".$row['idspGroup']."' data-pid='".$_SESSION['pid']."'>Join</button></div><br>";
									
							echo "<hr></hr>";
							echo "</div>";
						}
					}
				?>
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