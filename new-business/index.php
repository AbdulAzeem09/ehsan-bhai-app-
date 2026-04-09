<?php 
						session_start();
						$_GET["categoryID"]= "1";
						$_GET["spPostingsFlag"] = "0";
						$_GET["categoryName"] = "Buy&Sell";
						$_GET["profileid"]= "165";
						$_SESSION["pid"]= "165";
						include "../publicpost/index.php";
						?>