<!DOCTYPE html>
<html lang="en">
<head>
	<title>TheSharePage.com</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/jquery-ui.min.css"> 
	<link rel="stylesheet" href="../css/font-awesome.min.css"> 
	<link rel="stylesheet" href="../css/home.css"> 
	<link rel="stylesheet" href="../css/sweetalert.css">
	<script src="../js/sweetalert-dev.js"></script>
	<script src="../js/sweetalert.min.js"></script>
 </head>
<body onload="pageOnload('dashdd')">
<?php 
	session_start();
	if(!isset($_SESSION['pid']))
		{	
			include_once ("../authentication/check.php");
			$_SESSION['afterlogin']="my-activity/";
		}
	
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		include_once("../header.php");
	
	
?>
<div class="container-fluid">
	<div class="row dashboard-container">
		<div class="col-md-1 <?php echo ($_GET["flag"] == 1?"":"hidden");?>">
			<?php
				include_once("../categorysidebar.php");
			?>
		</div> 
		<div class="<?php echo ($_GET["flag"] == 1?"col-md-10":"col-md-12");?>">
			<input class="dynamic-pid" type="hidden" value="<?php echo $_SESSION['pid']?>">
			<!--Popup Box-->
			<div class="pop-up" style="margin-top:50px;">
				<p id="aboutprofile"></p>
			</div>
			<!--popupbox-->
			
				<div class="panel panel-default" style="margin-top:15px;">
					<div class="panel-heading">
					   <!--Freelancer tab-->
						<ul class="nav nav-tabs <?php echo ($_GET["category"] == 5 ? "" : "hidden");?>">
							
							<li class="active" role="presentation"><a href="#openebid"  aria-controls="sp-activePost" role="tab" data-toggle="tab">Open Projects</a></li>
							
							<li role="presentation"><a href="#ongoingprojects"  aria-controls="ongoingprojects" role="tab" data-toggle="tab">Ongoing Projects</a></li>
							
							<li role="presentation"><a href="#favouritefreelancer"  aria-controls="favouritefreelancers" role="tab" data-toggle="tab">Favourite Freelancers</a></li>
							
							<li role="presentation"><a href="#browsefreelancer"  aria-controls="browsefreelancer" role="tab" data-toggle="tab">Browse Freelancers</a></li>
							
							<li role="presentation"><a href="#mybid" id="myproject" aria-controls="mybid" role="tab" data-toggle="tab">My Current Projects</a></li>
							
							<li role="presentation"><a href="#closedproject"  aria-controls="closedproject" role="tab" data-toggle="tab">Closed Projects</a></li>
						</ul>
						<!--Freelancer Tab Complete-->
						<!--Job board tab-->
						<ul class="nav nav-tabs <?php echo ($_GET["category"] == 2 ? "" : "hidden");?>">
							
							<li  class="active" role="presentation"><a href="#jobappliedto" id="myproject" aria-controls="jobappliedto" role="tab" data-toggle="tab">Applied job</a></li>
							
							<li role="presentation"><a href="#jobadvertised"  aria-controls="jobadvertised" role="tab" data-toggle="tab">Job Advertised</a></li>
							
							<li role="presentation"><a href="#favouritejob"  aria-controls="favouritejob" role="tab" data-toggle="tab">Favourite Job</a></li>
							
							<li role='presentation'><a href='#myresumes'  aria-controls='myresumes' role='tab' data-toggle='tab'>My Resumes</a></li>
							
							<li  role="presentation"><a href="#myaccount"  aria-controls="myaccount" role="tab" data-toggle="tab">My Account</a></li>
							
						</ul>
						<!--job Board tab complete-->
					</div>

					<div class="panel-body previewdoc">
						<!--tab content for freelancer-->
						<div class="tab-content <?php echo ($_GET["category"] == 5 ? "" : "hidden");?> ">
							<div role="tabpanel" class="tab-pane active" id="openebid">
								<?php
								
									if( $_GET["category"]==5)//Othe person has done bid on my project
									{
										$_GET["activity"] = 1;
										include("../my-activity/activitypost.php");
									}
								?>
					
							</div>
							<div role="tabpanel" class="tab-pane" id="mybid">
								<?php
									$_GET["activity"] = 2;//By Bidden project
									include("../my-activity/activitypost.php");
								?>
							</div>
							
							<div role="tabpanel" class="tab-pane" id="browsefreelancer">
								<?php
									$freelancertimeline = 1;
									include("../my-activity/freelancer.php");
								?>
							</div>
							
							<div role="tabpanel" class="tab-pane" id="favouritefreelancer">
								<?php
									$freelancertimeline = 2;
									include("../my-activity/freelancer.php");
								?>
							</div>
							
							<div role="tabpanel" class="tab-pane" id="closedproject">
								
							</div>
							
							<div role="tabpanel" class="tab-pane" id="ongoingprojects">
								<div class="panel panel-success">
									<div class="panel-heading">
										<ul class="nav nav-tabs" style="width:250px;">
											<li  role="presentation" class="active"><a href="#asemployeer"  aria-controls="myaccount" role="tab" data-toggle="tab">As Employer</a></li>
											
											<li role="presentation" ><a href="#asfreelancer"  aria-controls="myresumes" role="tab" data-toggle="tab">As Freelancer</a></li>
										</ul>
									</div>
									<div class="panel-body">
										<div class="tab-content">
											<div role="tabpanel" class="tab-pane active" id="asemployeer">
													<?php
														$employer_freelancer = 1;
														include("../my-activity/ongoingproject.php");
													?>
											</div>
											
											<div role="tabpanel" class="tab-pane" id="asfreelancer">
												<?php
													$employer_freelancer = 2;
													include("../my-activity/ongoingproject.php");
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--tab content for freelancer Complete-->
						
						<!--tab content for job board-->
						<div class="tab-content <?php echo ($_GET["category"] == 2 ? "" : "hidden");?> ">
							<div role="tabpanel" class="tab-pane " id="myaccount">
								<?php
									include("../my-activity/myaccount.php");
								?>
							</div>
							<div role="tabpanel" class="tab-pane" id="jobadvertised">
								<?php
									$_GET["myjobfilter"] = 1;
									include("../my-activity/myjobs.php");
								?>
							</div>
							<div role="tabpanel" class="tab-pane" id="favouritejob">
								<?php
									$_GET["myjobfilter"] = 2;
									include("../my-activity/myjobs.php");
								?>
							</div>
							<!--Resume Work-->
							<div role="tabpanel" class="tab-pane" id="myresumes">
								<a  href="#" class="rsm pull-right" style="margin-bottom:20px;" data-toggle="modal" data-target="#newresume" id="resumenew"><span class="glyphicon glyphicon-plus"></span><b> Add New Resume</b></a></li>
								
								<!--All resumes-->
								<?php
									$pc = new _postingalbum;
									$result = $pc->profileresume($_SESSION['uid']);
									echo "<table class='table table-hover table-condensed' id='tableresume'>";
									echo "<tbody>";
									if ($result != false)
									{
										while($rw = mysqli_fetch_assoc($result))
										{	
											$resume = $rw["spPostingMedia"];
											$ext = $rw['sppostingmediaExtension'];
											
											//$previewfile = "../resume/'".$rw['idspPostingMedia'].".docx'";
											//$previewfile = "../resume/".$rw['idspPostingMedia'].".docx";								
											
											$previewfile = $rw['idspPostingMedia'].".".$rw['sppostingmediaExt']."";	
											
											file_put_contents("../resume/".$previewfile, $resume);
											
											$title = $rw['sppostingmediaTitle']; 
											
											 echo "<tr class='resumeoperation'>
												<td width='80%' class='resumetitle'>".$title."</td>
												
												<td width='7%'><button type='button' class='btn btn-link preview' data-toggle='modal' data-target='#previewresume' data-src='http://dev.thesharepage.com//resume/".$previewfile."'><span class='glyphicon glyphicon-search'></span> Preview</button></td>
												
												<td width='7%'><button type='button' class='btn btn-link editresume' data-toggle='modal' data-target='#newresume' data-mediaid='".$rw['idspPostingMedia']."' data-mediatitle='".$title."'><span class='glyphicon glyphicon-edit'></span> Edit</button></td>
												
												<td width='6%'><button type='button' class='btn btn-link deleteresume' data-mediaid='".$rw['idspPostingMedia']."'><span class='glyphicon glyphicon-trash'></span> Delete</button></td>
											</tr>";
										}
									}
									echo "</tbody>";
									echo "</table>";
								?>
								<!--All Resumes Code Complete-->
							</div>
							<!--Resume work completed-->
							
							<div role="tabpanel" class="tab-pane active" id="jobappliedto">
								<?php
									$_GET["myjobfilter"] = 3;
									include("../my-activity/myjobs.php");
								?>
							</div>
						</div>
						<!--tab content for job board complete-->
					</div>
				</div>
			</div>
			<div class="col-md-1 <?php echo ($_GET["flag"] == 1?"":"hidden");?>">
				<?php
					include_once("../sidebar.php");
				?>
			</div>
		</div>
			<!--Preview Resume-->
				<div class="modal fade" id="previewresume" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel">
					<div class="modal-dialog  modal-lg" role="document">
						<div class="modal-content" style="background-color:white;">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h3 class="modal-title" id="previewModalLabel"><b>Resume Preview</b></h3>
							</div>
							<div class="modal-body">
								<a id="" class='embed resumeid' href="#"></a>
							</div>
						</div>
					</div>
				</div>
			<!--Preview Resume Complete-->
		<!--Adding new Resume modal-->
			<div class="modal fade" id="newresume" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
			  <div class="modal-dialog" role="document">
				<div class="modal-content" style="background-color:white;">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="modal-title" id="resumeheadr"></h3>
				  </div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="recipient-name" class="control-label"><h4>Resume Title</h4></label>
								<input type="text" class="form-control" id="mediatitle">
							</div>
							 <input type="hidden" id="mediaid">
							<!--Choose your new Resume-->
							<br>
							<div class="form-group">
								<input type="file" id="adddocument" class="spmedia" name="spPostingMedia[]" multiple="multiple" required>
							</div>
							<div id="media-container"></div>
							<!--Choose resume code complete-->
								
							<div class="modal-footer" class="uploadupdate">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" id="uploadupdate" class="btn btn-primary uploadresume">Submit</button>
							</div>
						</form>
					</div>
				</div>
			  </div>
			</div>
		<!--Adding new resume modal complete-->
	</div>
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/gdocsviewer.min.js"></script>
	<script src="/js/home.js"></script>
</body>	
</html>