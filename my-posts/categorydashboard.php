<?php
	session_start();
	function sp_autoloader($class)
	{
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	$p = new _postingview;
	$rpvt = $p->readPrivate($_SESSION["pid"]);
	$rpub = $p->readPublic($_SESSION["pid"]);
?>
	<div class="row">
	<div class="col-md-12">
	<div class="row panel panel-success"> 
		<div class="panel-heading">Group</div>
		<div class="panel-body">
			<ul class="nav nav-tabs">
				<li class="active" role="presentation"><a href="#sp-activePost"  aria-controls="sp-activePost" role="tab" data-toggle="tab">Active </a></li>
				<li role="presentation"><a href="#sp-expiredPost"  aria-controls="sp-expiredPost" role="tab" data-toggle="tab">Expired </a></li>
				<li role="presentation"><a href="#sp-completedPost"  aria-controls="sp-completedPost" role="tab" data-toggle="tab">Sold</a></li>
				<li role="presentation"><a href="#sp-draftPost"  aria-controls="sp-draftPost" role="tab" data-toggle="tab">Draft</a></li>
				
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
				
				<div role="tabpanel"  class= "tab-pane "  id="sp-draftPost" >
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
</div>
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
</div><!---->