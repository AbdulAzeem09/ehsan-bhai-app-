
<?php
    include('../univ/baseurl.php');
	//require_once '../library/config.php';
	require_once '../backofadmin/library/config.php';
	
	//require_once '../library/functions.php';
    session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="real-estate/";
		include_once ("../authentication/check.php");
		
		}else{
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		$_GET["categoryID"] = "3";
		$_GET["categoryName"] = "Realestate";
		$header_realEstate = "realEstate";
	?>
	<!DOCTYPE html>
	<html lang="en-US">
		
		<head>
			<?php include('../component/f_links.php');?>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
			
			
			<style>
				
				.list-wrapper {
				padding: 15px;
				overflow: hidden;
				}
				
				.list-item {
				border: 1px solid #EEE;
				background: #FFF;
				margin-bottom: 10px;
				padding: 10px;
				box-shadow: 0px 0px 10px 0px #EEE;
				display: contents;
				}
				
				.list-item h4 {
				color: #FF7182;
				font-size: 18px;
				margin: 0 0 5px;	
				}
				
				.list-item p {
				margin: 0;
				}
				
				.simple-pagination ul {
				margin: 0 0 20px;
				padding: 0;
				list-style: none;
				text-align: center;
				}
				
				.simple-pagination li {
				display: inline-block;
				margin-right: 5px;
				}
				
				.simple-pagination li a,
				.simple-pagination li span {
				color: #666;
				padding: 5px 10px;
				text-decoration: none;
				border: 1px solid #95ba3d;
				background-color: #95ba3d;
				box-shadow: 0px 0px 10px 0px #EEE;
				}
				
				.simple-pagination .current {
				color: #FFF;
				
				}
				.heading07 h2 span, .heading08 h2 span {
				color: #6a7e3b;
				}
				
				.simple-pagination .prev.current,
				.simple-pagination .next.current {
				
				}
			</style>
		</head>
		
		<body class="bg_gray">
			<?php include_once("../header.php");?>
			<section class="realTopBread " >
				<div class="container">
					<div class="row"  style="margin-top:22px">
						<div class="col-md-6">
							<div class="text-left agentbreadCrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
									<li class="breadcrumb-item active">All Agents</li>
								</ol>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-right">
								<?php include_once("top-buttons.php");?>
							</div>
						</div>
						
					</div>
					
				</div>
			</section>
			
			
			
			
			<section class="" style="padding: 40px;">
				<div class="container">
					
					<div class="row">
						<div class="list-wrapper">
							
							<?php
							$bprofile = new _spprofiles;
								$profiledata = $bprofile->read($_SESSION['pid']);
								$profileDetail = mysqli_fetch_assoc($profiledata);
								//echo $profileDetail['businesscategory'];
								
								
								//REAL ESTATE SERVICES
								
								$sql = "SELECT DISTINCT spProfiles_idspProfiles FROM sprealstate";
								$result = mysqli_query($dbConn,$sql);
						
								while($row = mysqli_fetch_array($result)){
									
									
									$bprofile = new _spprofiles;
									$newsdata1 = $bprofile->read($row['spProfiles_idspProfiles']);
									$newdata1 = mysqli_fetch_assoc($newsdata1); 
									$profileId = $newdata1['idspProfiles'];
									
									
									$bp = new _spbusiness_profile;
									$alldet = $bp->read($row['spProfiles_idspProfiles']);
									$alldetails = mysqli_fetch_assoc($alldet);
								
									$category = $alldetails['businesscategory'];
								/*	die("5454444441111000011");
									if($category != "REAL ESTATE SERVICES"){
										continue;
									}
									*/
									// print_r($alldetails);
										
								?>
								
								<div class="list-item">
									<div class="col-md-3">
										<div class="realAgentBox">
											<a href="<?php echo $BaseUrl.'/real-estate/agent-detail.php?agentId='.$profileId;?>">
												<div class="imgAgntBox">
													<?php if($newdata1['spProfilePic']){ ?>
														<img src="<?php echo ($newdata1['spProfilePic']); ?>" class="img-responsive center-block">
														<?php	}else{ ?>
														<img src="<?php echo $BaseUrl ?>/img/no.png" class="img-responsive center-block">
													<?php } ?>
												</div>
												<div class="titlebox text-center " style="background-color: #6a7e3b">
												<h2 style="white-space: nowrap; width: 243px; overflow: hidden; text-overflow: ellipsis;"><?php echo $newdata1['spProfileName'];?></h2>
												<p><?php echo $newdata1['spProfileTypeName']?> </p>
												</div>
												<p class="font"><i class="fa fa-phone"></i> <?php echo $newdata1['spProfilePhone'];?></p>
												<p class="font" style="white-space: nowrap; width: 243px; overflow: hidden; text-overflow: ellipsis;"><i class="fa fa-envelope"></i> <?php echo $newdata1['spProfileEmail'];?></p>
												</a>
												</div>
												</div>
												</div>
												
												<?php } ?>
												
												
												
												</div>
												<div id="pagination-container"></div>
												</div>
												</section>
												
												
												<?php 
												include('../component/f_footer.php');
												include('../component/f_btm_script.php'); 
												?>
												
												</body>
												</html>
												<?php
												}
												?>
												<script>
												
												
												var items = $(".list-wrapper .list-item");
												var numItems = items.length;
												var perPage = 8;
												
												items.slice(perPage).hide();
												
												$('#pagination-container').pagination({
												items: numItems,
												itemsOnPage: perPage,
												prevText: "&laquo;",
												nextText: "&raquo;",
												onPageClick: function (pageNumber) {
												var showFrom = perPage * (pageNumber - 1);
												var showTo = showFrom + perPage;
												items.hide().slice(showFrom, showTo).show();
												}
												});
												
												</script>												