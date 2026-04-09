<!DOCTYPE html>
<html lang="en">
<head>
	<title>TheSharePage.com</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery-ui.min.css"> 
	<link rel="stylesheet" href="../css/font-awesome.min.css"> 
	<link rel="stylesheet" href="../css/home.css"> 
	<script src="../js/jquery-2.1.4.min.js"></script>
	<script src="../js/jquery-1.11.4-ui.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/home.js"></script>
 </head>
<body onload="pageOnload('admin')">
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
	$p = new _spprofiles;
	$rp = $p->readProfiles($_SESSION['uid']);
?>
<div class="container-fluid">
  <div class="row">
	<div class="col-md-1">
		<?php
			include_once("../categorysidebar.php");
		?>
	</div>
	<div class="col-md-10">
		<div class="row panel panel-default">
		<div class="panel-heading ">
			<span><span>Group Adminstration</span><button class="pull-right" id="newgrp"><b>Create New Group</b></button></span>
			
		</div>
		<div class="panel-body">
				<div class="col-sm-3">
					<div class="list-group sp-profile-Group">
					  <!-- Group loading in this section -->
					  <?php
						/*$p = new _spgroup;
							$rpvt = $p->read($_SESSION['pid']);
							 if ($rpvt != false){
							   while($row = mysqli_fetch_assoc($rpvt)) {
									echo "<a  id='gradmin-gid". $row['idspGroup'] ."' href='members.php' class='list-group-item sp-group-label' data-gid='" . $row['idspGroup'] . "'>";
									echo $row['spGroupName'] . "</a>";
								}
							}
							*/
							
							$g = new _spgroup;
							$result = $g->groupmember($_SESSION['uid']);
							if ($result != false)
							{
								while($row = mysqli_fetch_assoc($result))
								{
									$rpvt = $g ->members($row['idspGroup']);
									if ($rpvt != false){
										while($rows = mysqli_fetch_assoc($rpvt)) {
											if($rows['spProfileIsAdmin'] == 0){
												$ptid = $rows["spProfileType_idspProfileType"];
											}
										}
									}
								echo "<a class='gradmin-gid". $row['idspGroup'] ." list-group-item sp-group-label' href='members.php' class='' data-gid='" . $row['idspGroup'] . "' data-createrptid='".$ptid."'><span class='".($row['spgroupflag'] == 1 ? "glyphicon glyphicon-lock":"fa fa-globe")."'> </span> ".$row['spGroupName'] . "</a>";
								}
							}
						?>
					</div>
					<!--Group crewation Code-->
					
				</div>
				<div class="col-sm-9 ">
					<div class="sp-group-details"></div>
					<!--Create New Group-->
					<div class="nwgrp hidden">
						<form action="../post-ad/addgroup.php" method="post" id="sp-add-group" style="padding:20px;">
						
							<!-- all the hidden value-->
							<input class="dynamic-pid" type="hidden" id="myprofileid" name="pid_" value="<?php echo $_SESSION['pid'];?>">
							
							<input id="spProfileTypes_idspProfileTypes" type="hidden" value=<?php echo $_SESSION['ptid']; ?>>
							
							<input id="userid" type="hidden" value="<?php echo $_SESSION['uid']; ?>" value="1">
							
							<div class="groupfield"><!--Load Dynamic--></div>
							
						</form><br><br>
					</div>
					<!--Testing COmplete-->
				</div>
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