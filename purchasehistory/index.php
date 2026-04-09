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
<body onload="pageOnload('admin')">

	<?php
		session_start();
		if(!isset($_SESSION['pid']))
		{	
			include_once ("../authentication/check.php");
			$_SESSION['afterlogin']="cart/";
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
		
		<div class="col-md-10">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Product</th>
						<th>Amount</th>
						<th>Shipping Charge</th>
						<th>Transaction Date</th>
						<th><?php echo ($_GET["transaction"] == 1 ?"Seller" : "Buyer");?></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$p = new _order;
						$pr = new _spprofiles;
						switch ($_GET["transaction"])
						{
							case 1:
								$result = $p->purchase($_SESSION["uid"]);//Purchase History
							break;
							
							case 2:
								$result = $p->selling($_SESSION["uid"]);//Selling History
							break;
						}
						
						if($result != false)
						{
							while($rows = mysqli_fetch_assoc($result))
							{
								echo "<tr>";
									echo "<td width='40%'>".$rows["spPostingTitle"]."</td>";
									echo "<td width='15%'>$ ".$rows["sporderAmount"]."</td>";
									echo "<td width='15%'>$ ".$rows["sppostingShippingCharge"]."</td>";
									echo "<td width='15%'>".$rows["sporderdate"]."</td>";
									
									if($_GET["transaction"] == 1)
									{
										$profileid = $rows["spSellerProfileId"];
									}
									else
										$profileid = $rows["spByuerProfileId"];
									$res = $pr->read($profileid);
									if($res != false)
									{
										$row = mysqli_fetch_assoc($res);
										echo "<td width='15%'><img alt='Posting Pic' src=' ".($row["spProfilePic"])."' height='32' width='32' class='img-circle'> ".$row["spProfileName"]."</td>";
									}
								echo "</tr>";
							}
						}
					?>
				</tbody>
			</table>
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