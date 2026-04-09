<!DOCTYPE html>
<html lang="en">
<head>
	<title>TheSharePage.com</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery-ui.min.css"> 
	<link rel="stylesheet" href="../css/font-awesome.min.css"> 
	<link rel="stylesheet" href="../css/home.css"> 
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/home.js"></script>
 </head>
<body onload="pageOnload('dashdd)">
<?php 
	session_start();
	if(!isset($_SESSION['pid']))
		{	
			include_once ("../authentication/check.php");
			$_SESSION['afterlogin']="my-activity/";
		}
	
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../header.php");
?>
<div class="container-fluid">
	<div class="row">
		<input class="dynamic-pid" type="hidden" value="<?php echo $_SESSION['pid']?>">
		<div class="col-md-1">
			<?php
				include_once("../categorysidebar.php");
			?>
		</div>
		
		<div class="col-md-10">
			<div class="panel panel-success">
				<div class="panel-heading">
					<p class='panel-title'>Dating</p>
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