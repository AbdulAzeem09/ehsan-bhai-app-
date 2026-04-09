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
	  
 </head>
<body onload="pageOnload('dashdd')">
<?php session_start();?>

<input class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid']?>">

<?php
	if(!isset($_SESSION['pid']))
		{	
			include_once ("../authentication/check.php");
			$_SESSION['afterlogin']="my-posts/";
		}
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../header.php");
	// idspPostings, spPostingTitle, spPostingNotes, spPostingEmail, spPostingPhone, spPostingVisibility, spSubCategories_idspSubCategory, spProfiles_idspProfiles, spCities_idspCity	
	$p = new _postingview;
	$rpvt = $p->readPrivate($_SESSION["pid"]);
    $rpub = $p->readPublic($_SESSION["pid"]);
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
			<?php
				include_once("../categorysidebar.php");
			?>
		</div>
		<div class="col-md-10">
			
		<?php 
			//include_once("../Filter/storesearch.php");
		   include_once("../Filter/storesearch.php");
		   include_once("../Filter/index.php");
						
		?>
		<div class="row panel panel-info" style="margin-top:10px;">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-2">
						<h4>My Dashboard</h4>
					</div>
					<div class="col-md-10">
						<button class="btn btn-default pull-right" style="cursor:pointer" id="mydrftflder"><span class="fa fa-folder"></span> Draft</button>
					</div>
					<!--<div class="col-md-1">
						<div class="buttons text-right btngrid2list">
							<button class="btn btn-primary btn-sm active grd"><span class="glyphicon glyphicon-th" aria-hidden="true"></span></button>
							<button class="btn btn-primary btn-sm lst"><span class= "glyphicon glyphicon-th-list" aria-hidden="true"></span></button>
						</div>
					</div>-->
				</div>
			</div>
			
			<div class="panel-body">
				<!--My draf testing-->
				<div class="saveddraftpost hidden">
					<?php 
						$_GET["uid"] = $_SESSION["uid"];
						$_GET["viewtype"] = "3";
						include("poststable.php"); 
					?>
				</div>
				<!--Code Complete-->
			  <div class="myallpostinfo table information dashboard-container category-loaded" id="searched">
				<div class="row">
				<div class="col-md-12">
				<div class="row panel panel-success"> 
					<div class="panel-heading">Group</div>
					<div class="panel-body">
						<ul class="nav nav-tabs">
							<li class="active" role="presentation"><a href="#sp-activePost"  aria-controls="sp-activePost" role="tab" data-toggle="tab">Active </a></li>
							<li role="presentation"><a href="#sp-expiredPost"  aria-controls="sp-expiredPost" role="tab" data-toggle="tab">Expired </a></li>
							<li role="presentation"><a href="#sp-completedPost"  aria-controls="sp-completedPost" role="tab" data-toggle="tab"><?php echo ($_GET["categoryID"] == 12 ?"":"Sold")?></a></li>
							<!--<li role="presentation"><a href="#sp-draftPost"  aria-controls="sp-draftPost" role="tab" data-toggle="tab">Draft</a></li>-->
							
							<!--<li role="presentation"><a href="#sp-draftPost" id="freelancer_jobboard" aria-controls="sp-draftPost" role="tab" data-toggle="tab"></a></li>-->
						</ul>
						<div class="tab-content sp-container-active">
						
							<div role="tabpanel" class="tab-pane active"  id="sp-activePost" >
								<?php 
									$_GET["uid"] = $_SESSION["uid"];
									$_GET["viewtype"] = "1";
									include("poststable.php");
								?>
							</div> <!-- active close -->
							
							<div role="tabpanel"  class= "tab-pane "  id="sp-expiredPost" >
								<?php 
									
									$_GET["uid"] = $_SESSION["uid"];
									$_GET["viewtype"] = "2";
									include("poststable.php"); 
								?>
							</div><!--Expired close  -->
							
							<!--<div role="tabpanel"  class= "tab-pane "  id="sp-draftPost" >
								<?php 
									$_GET["uid"] = $_SESSION["uid"];
									$_GET["viewtype"] = "3";
									include("poststable.php"); 
								?>
							</div>	<!-- Draft close -->
							
							<div role="tabpanel"  class= "tab-pane"  id="sp-completedPost" >
								<?php 
									
									$_GET["uid"] = $_SESSION["uid"];
									$_GET["viewtype"] = "6";
									include("poststable.php"); 
								?>
							</div><!--Sold Post-->
						</div><!-- tab content close -->
					</div><!-- panel body -->
				</div><!-- panel info -->
			</div><!--checking-->
		
		<div class="row">
			<div class="col-md-12">
			<div class="row panel panel-success">
				<div class="panel-heading">Public</div><!-- panel heading -->
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active" role="presentation"><a href="#sp-activePostPublic"  aria-controls="sp-activePostPublic" role="tab" data-toggle="tab">Active </a></li>
						<li role="presentation"><a href="#sp-expiredPostPublic"  aria-controls="sp-expiredPostPublic" role="tab" data-toggle="tab">Expired </a></li>
						<li role="presentation"><a href="#sp-completedPostPublic"  aria-controls="sp-completedPostPublic" role="tab" data-toggle="tab">Sold</a></li>
					</ul>
					<div class="tab-content">
					<div role="tabpanel" class="tab-pane  in active"  id="sp-activePostPublic" >
						<?php 
							$_GET["uid"] = $_SESSION["uid"];
							$_GET["viewtype"] = "4";
							include("poststable.php"); 
						?>							
					</div><!--active close -->
					
						<div role="tabpanel"  class= "tab-pane "  id="sp-expiredPostPublic">
							<?php 
								$_GET["uid"] = $_SESSION["uid"];
								$_GET["viewtype"] = "5";
								include("poststable.php"); 
							?>
						 </div><!--Expired close  -->
						 
						 <div role="tabpanel"  class= "tab-pane "  id="sp-completedPostPublic">
							<?php 
								$_GET["uid"] = $_SESSION["uid"];
								$_GET["viewtype"] = "7";
								include("poststable.php"); 
							?>
						 </div>
						 
						</div><!--tab- content-->
					</div> <!--panel-body-->
				</div> <!-- panel-success-->
			</div><!---->
		</div>
		</div>
		</div>
	</div><!--panel-primary-->
  </div>
</div>
	<div class="col-md-1">
		<?php
			include_once("../sidebar.php");
		?>
	</div>
  </div>
</div>
	<script src="../js/home.js"></script>
</body>
</html>