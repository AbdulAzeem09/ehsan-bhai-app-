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
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
	?>
	
	
	
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<h3>Payment has been Cancel</h3>
			<h3>Your Payment has not been successfull,Go back to Membership Details and try again.<h3>
			<h3><a href="../membership/">Go to Membership Details</a></h3>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
</body>
</html>