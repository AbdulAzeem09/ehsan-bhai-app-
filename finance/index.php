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
<body>
<?php 
	session_start();
	if(!isset($_SESSION['pid']))
		{	
			include_once ("../authentication/check.php");
			$_SESSION['afterlogin']="my-groups/";
		}
	
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../header.php");
?>
<div class="container-fluid" style="margin-bottom:50x;">
	<div class="row">
		<div class="col-md-1">
			<?php
				include_once("../categorysidebar.php");
			?>
		</div>
		<div class="col-md-10" style="margin-top:80px;">
			<div class='row'>
			<div class='col-md-3'></div>
			<div class='col-md-6 thumbnail buymembership'>
			<?php
				$m = new _spmembership;
				$res = $m->readmembership($_GET["membership"]);
				if($res != false)
				{	
					$rows =  mysqli_fetch_assoc($res);
					if($rows["idspMembership"] != 0)
					{
						echo "<div class='memdetails'><h3 align='center' style='color:#408180;font-weight:bold;'>Membership Details</h3></div>";
						echo "<div style='background-color:#f2f2f2;'>";
							echo "<div style='background-color:	#E6E6FA;'>";
							
							echo "<div class='metric'><h3 align='center' class='mname'>".$rows["spMembershipName"]."</h3></div>";
							
							
							echo "<div class='amount'><h2 align='center'>$".$rows["spMembershipAmount"]."</h2></div>";
							echo "</div>";
							
							echo "<div class='amount'><h3 align='center'>Post Limit&nbsp;:&nbsp;".$rows["spMembershipPostlimit"]."</h3></div>";
							
							echo "<div><h4 align='center'>Membership Duration&nbsp;:&nbsp;".$rows["spMembershipDuration"]." days</h4></div>";
					  echo "</div>";
					  $mduration  = $rows["spMembershipDuration"];
					  $memid = $rows["idspMembership"];
					  $mname = $rows["spMembershipName"];
					  $amount = $rows["spMembershipAmount"];
					  //Testing
					  $_SESSION['memid'] = $rows["idspMembership"];
					  $_SESSION['mduration'] = $rows["spMembershipDuration"];
					  $_SESSION['mname'] = $rows["spMembershipName"];
					  $_SESSION['amount'] = $rows["spMembershipAmount"];
					  
					  //Testing Complete
					}
				}
			?>
			
			<!--<button type='button' data-duration='<?php echo $mduration;?>' data-membershipid='<?php echo memid;?>' class='btn btn-success membershipbuy'>Pay</button>-->	
			 
			  
			  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="business" value="mksseller@shop.com">
				<input type="hidden" name="cmd" value="_xclick">

				<input type="hidden" name="item_name" value="The SharePage <?php echo $mname;?> Membership">
				<input type="hidden" name="amount" value="<?php echo $amount;?>">
				<input type="hidden" name="currency_code" value="USD">
				<div class="pull-right">
					<button type='submit' data-duration='<?php echo $_SESSION['mduration'];?>' data-membershipid='<?php echo $_SESSION['memid'];?>' class='btn btn-success membershipbuy' style="margin-left:5px;">Pay with Paypal</button>
					
					 <a href='../membership/' type='button' role='button' class='btn btn-danger'>Cancel</a>
				 </div>
				 <!--Payment success-->
				<input type="hidden" name="return" value="http://dev.thesharepage.com/finance/paymentsucess.php">
			
				<!--Payment Cancel-->
				<input type="hidden" name="cancel_return" value="http://dev.thesharepage.com/finance/paymentcancel.php"/>
				
				<img alt="" border="0" width="1" height="1"
				src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
				</form>
			</div>
			<div class='col-md-3'></div>
		</div>
	</div>
		<div class="col-md-1 rightposition">
			<?php
				include_once("../sidebar.php");
			?>
		</div>
	</div>
</div>
</body>	
</html>