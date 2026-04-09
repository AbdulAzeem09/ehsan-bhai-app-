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
	?>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1 hidden-sm hidden-xs">
				<?php
					include_once("../categorysidebar.php");
				?>
			</div>
			<div class="col-md-10" style="margin-top:28px;">
				<?php
					$q = new  _spquotation;
					$res = $q->read($_SESSION['pid']);
					if($res != false)
					{
						while($row = mysqli_fetch_assoc($res))
						{  
							$qpic = new  _quotationpic;
							$result = $qpic->read($row["idspQuotation"]);
							if($result != false)
							{
								$rows = mysqli_fetch_assoc($result);
								$qpicture = $rows["spQuotationPic"];
							}
							echo "<div class='row'>";
								
								echo "<div class='col-md-3'><img alt='Posting Pic' class='img-thumbnail post-img' src=' ".($qpicture )."' ></div>" ;
								
								echo "<div class='col-md-6'>";
									echo "<div class='row'>";
										echo "<div class='col-md-3'><h4 style='color:gray;'>Product</h4><span style='margin-left:20px;'>" .$row["spQuotationProductName"]."</span></div>" ;
										
										echo "<div class='col-md-3'><h4 style='color:gray;'>Quantity Available</h4><span style='margin-left:20px;'>" .$row["spQuotationTotalQty"]."</span></div>" ;
										
										echo "<div class='col-md-3'><h4 style='color:gray;'>Delevery Time</h4><span style='margin-left:20px;'>" .$row["spQuotationDelevery"]."</span></div>" ;
									echo "</div><br>";
									
									echo "<div class='row'>";
										echo "<div class='col-md-3'><h4 style='color:gray;'>Stock Validity</h4><span style='margin-left:20px;'>" .$row["spQuotationStockValidity"]."</span></div>" ;
										
										echo "<div class='col-md-3'><h4 style='color:gray;'>Shipping Charges</h4><span style='margin-left:20px;'>" .$row["spQuotationShippingCharges"]."</span></div>" ;
										
										echo "<div class='col-md-3'><h4 style='color:gray;'>Price</h4><span style='margin-left:20px;'>" .$row["spQuotationPrice"]."</span></div>" ;
									echo "</div><br>";
									echo "<div><h4 style='color:gray;'>Details</h4> <span style='margin-left:20px;'>" .$row["spQuotatioProductDetails"]."</span></div>" ;
								echo "</div>";	
								echo "<div class='col-md-3'>";
									$profilepic = new _spprofiles;
									$r = $profilepic->read($row["spQuotationSellerid"]);
									if($r != false)
									{
										$rw = mysqli_fetch_assoc($r);
										$pic = $rw["spProfilePic"]; 
										echo "<img alt='Posting Pic' class='img-circle' height='120' width='120' src=' ".($pic )."'><br>";
										echo "<h4 style='margin-left:8px;'>".$rw["spProfileName"]."</h4>";
									}
									echo "<br><button type='button' id='accepted' class='btn 	   btn-primary'>Accepted</button>
										<button type='button' id='response' class='btn btn-success'>Response</button>
										<button type='button' id='rejected' class='btn btn-danger'>Rejected</button>";
								echo "</div>";
							echo "</div><br>";
							echo "<hr class='hrline'>";
						}
					}
				?>
			</div>
			<div class="col-md-1 hidden-sm hidden-xs">
				<?php
						include_once("../sidebar.php");
					?>
			</div>
		</div>
	</div>
</body>
</html>
