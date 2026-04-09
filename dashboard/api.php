<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
    require_once("../univ/baseurl.php" );
	session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="dashboard/";
		include_once ("../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		
		$pageactive = 54;
	?>
	<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php include('../component/f_links.php');?>
			<!-- ===========DSHBOARD LINKS================= -->
			<?php include('../component/dashboard-link.php');?>
			<!-- ===========PAGE SCRIPT==================== -->
			
			<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
			<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
			<style>
			section.content-header {
    margin-top: -10px;
    padding-left: 30px;
    margin-bottom: -5px;
}
ol.breadcrumb {
    margin-right: 25px;
}
			</style>
		</head>
		<body class="bg_gray">
			<?php
				
				include_once("../header.php");
			?>
			
			<section class="">
				<div class="container-fluid no-padding">
					<div class="row">
						<!-- left side bar -->
						<div class="col-md-2 no_pad_right">
							<?php
								include('../component/left-dashboard.php');
							?>
						</div>
						<!-- main content -->
						<div class="col-md-10 no_pad_left">
							<div class="rightContent">
								
								<!-- breadcrumb -->
								<section class="content-header">
									<h1>API Keys</h1>
									<ol class="breadcrumb">
										<li><a href="<?php echo $BaseUrl.'/dashboard';?>"><i class="fa fa-dashboard"></i> Home</a></li>
										<li class="active">API Keys</li>
									</ol>
								</section>
								
								<div class="content">
								
											<div class="box box-success">
												<div class="box-header">
													
				</div><!-- /.box-header -->
				<div class="box-body">
														
														
		<div class="container col-md-12">
		<form method="post" action="apiInsert.php" enctype="multipart/form-data">
<div class="row">

<?php
																		$uid = $_SESSION['uid'];
$b = new _pos_po;
																		$data = $b->readApi($uid);
if($data!=false){
																		$row = mysqli_fetch_array($data);
						}
																		//print_r($row);	
	?>																
<div class="col-md-6">
																		<div class="form-group">
																			<input type="hidden" id="uid" name="uid" value="<?php echo $_SESSION['uid'];?>">
	<label for="client_id" class="control-label">Client_id</label>
																		<input type="text" class="form-control" name="clientId" id="spBankuser" value="<?php echo $row['client_id']; ?>" >
	
																		</div>
					</div>
					<div class="col-md-6">
																		<div class="form-group">
																			<label for="Client_secret" class="control-label">Client_Secret</label>
																			<input type="text" class="form-control" name="clientSecret" id="Client_secret" value="<?php echo $row['client_secret']; ?>" >
	
																		</div>
	</div>
	<div class="row">
	<div class="col-md-12">
	<div class="col-md-6">
																		<div class="form-group">
																			<label for="key_json" class="control-label">key_json</label>
																			<input type="file" class="form-control" name="key_json1" id="key_json" value="" style="display:block;">																		</div>
	</div> 
	<div class="col-md-6">
																		<div class="form-group">	
	<input type="hidden" class="form-control" name="hidden1" id="hidden" value="<?php echo $row['key_json']; ?>">																		</div>
	</div> 
	</div>
	</div>   
	
																		
	<div class="col-md-6">
																		<button type="submit" style="margin-bottom:25px"  id="apiDetail"class="btn btn-submit db_btn db_primarybtn">Submit</button>
																	</div>
															</div>
															</form>
															
		</div>								
														
												</div>
											</div>
											
											
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			
			
			
			<?php include('../component/f_footer.php');?>
			<!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
			<?php include('../component/f_btm_script.php'); ?>
			
			
			
			
		</body> 
	</html>
	<?php
	} ?>																			