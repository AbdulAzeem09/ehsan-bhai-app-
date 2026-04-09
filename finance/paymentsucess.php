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
	
	<!--Testing-->
	<?php
	session_start();
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$up = new _spprofiles;
		$res = $up->read($_SESSION["pid"]);
		if($res != false)
		{
			$row = mysqli_fetch_assoc($res);
			$profiletype = $row["spProfileType_idspProfileType"];
			$profilename= strtolower($row["spProfileName"]);
			$profilename = str_replace(' ', '-', $profilename);
			$profileid = $row["idspProfiles"];
			$membership = $row["spMembership_idspMembership"];
			$store = strtolower($row["spDynamicWholesell"]);
			$store = str_replace(' ', '-', $store);
		}	
		$id = $up->setmembership($_SESSION['memid'],$_SESSION['mduration'],$_SESSION["pid"]);
		
		mkdir("../".$store);
		$wholesellerstore = fopen("../".$store . "/index.php", "w") or die("Unable to open file!");
		
		$txt ='<?php 
		session_start();
		$_GET["categoryID"]= "1";
		$_GET["spPostingsFlag"] = "0";
		$_GET["categoryName"] = "Buy&Sell";
		$_GET["profileid"]= "'.$row["idspProfiles"].'";
		$_SESSION["pid"]= "'.$row["idspProfiles"].'";
		include "../publicpost/index.php";
		?>';
		

		fwrite($wholesellerstore, $txt);
		fclose($wholesellerstore);
		$up->wholeselldirectory($_SESSION["pid"],$store);
			
?>

	<!--Testing Complete-->
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
		
			<h3>Your Payment has been successfully Completed</h3>
			<h3><a href="../my-profile/">Go to your account</a></h3>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
</body>
</html>