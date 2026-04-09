<?php
session_start();
$_GET["myfavorite"]="3";
	if(isset($_SESSION['pid']))
		include "../publicpost/index.php";
	else
		{
			include_once ("../authentication/check.php");
			$_SESSION['afterlogin']="favorite/";
		}
?>