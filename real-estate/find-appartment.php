<?php
	
	
    include('../univ/baseurl.php');
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
		if(isset($_GET['dream']) && $_GET['dream'] == 'buy'){
			$breadTitle = "Buy";
			}else if(isset($_GET['dream']) && $_GET['dream'] == 'rent'){
			$breadTitle = "Rent";
			}else if(isset($_GET['dream']) && $_GET['dream'] == 'open'){
			$breadTitle = "Open";
			}else{
			$breadTitle = "Listing";
		}
	?>
	<!DOCTYPE html>
	<html lang="en-US">
		
		<head>
			<?php include('../component/f_links.php');?>
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
			<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
			<script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>
		</head>
		<!--	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
		<style>
			
			.iconss {
			padding-left: 25px;
			background: url("https://png.pngtree.com/png-vector/20190419/ourmid/pngtree-vector-location-icon-png-image_956422.jpg") no-repeat left;
			background-size: 20px;
			}
			input#spPostingAddress_ {
			background-color: white;
			}
			
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
		<body class="bg_gray">
			<?php include_once("../header.php");?>
			<section class="realTopBread">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="row" style="margin-top:22px">
								<div class="col-md-6">
									<div class="text-left agentbreadCrumb">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
											<li class="breadcrumb-item active">Condominium Type Property</li>
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
						<!---<div class="col-md-12">
							<div class="heading07 text-center">
                            <h2>All <span>Property</span></h2>
							</div>
							</div>-
							<!---<div class="col-md-12">
							<div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
							<li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate/all-property.php?dream=buy';?>">Sell</a></li>
							<li class="breadcrumb-item active"><?php echo $breadTitle;?></li>
                            </ol>
							</div>
						</div>--->
					</div>  
				</div>
			</section>
			
								<?php
									if(isset($_GET['btnAdresSearch'])){
							$defaultnewaddress = $_GET['txtAddress'];
												$Lists = explode(',', $defaultnewaddress);
												
												
												$defcount =  count($Lists);
												$_SESSION['realstate_default_country'] = $Lists[$defcount-1];
												$_SESSION['realstate_default_state'] = $Lists[$defcount-2];
												$_SESSION['realstate_default_city'] = $Lists[$defcount-3];
							}
						?>
			
			<section class="" style="padding: 30px;">
				<div class="container"> 
					
					
					<div class="row">
				
						<form class="searchReal" action="find-appartment.php">
						<div class="col-md-3"></div>
							<div class="col-md-5">
								<div class="form-group">
									
									<?php 
										
										//unset($_SESSION['realstate_default_address']);
										
										
										if($_SESSION['realstate_default_city'] !="" ||  $_SESSION['realstate_default_state'] !="" || $_SESSION['realstate_default_country'] !=""){ 
											$defcountry = $_SESSION['realstate_default_country'];
											$defstate = $_SESSION['realstate_default_state'];
											$defcity = $_SESSION['realstate_default_city'];
											
											$totalSessionAddress = $_SESSION['realstate_default_city'].','.$_SESSION['realstate_default_state'].','.$_SESSION['realstate_default_country'];
											
										?>
										<input style="border-radius: 4px;" type="text" class="form-control iconss" data-filter="0" id="spPostingAddress_" name="txtAddress" value="<?php  echo $totalSessionAddress; ?>"  autocomplete="off" maxlength="40"  required />
										<?php	}
										else{ 
											$p = new _spuser;
											$defAdd = $p->read($_SESSION['uid']);
											
											$default_address = 	mysqli_fetch_assoc($defAdd);
											
											$defcountry = $default_address['default_country'];
											$defstate = $default_address['default_state'];
											$defcity = $default_address['default_city'];
											
											$totaladdress = $defcity.', '.$defstate.', '.$defcountry;
											
										?>
										<input style="border-radius: 4px;" type="text" class="form-control iconss" data-filter="0" id="spPostingAddress_" name="txtAddress" value="<?php  echo $totaladdress ;?>" autocomplete="off" maxlength="40"  required />
										<?php	}
										
									?>
									
								</div>
							</div>
							

							
							<div class="col-md-1" style=" margin-left: -74px; ">
								<div class="form-group">
									<button style="border-radius: 3px;background-color: #5d7425 !important;color: white;" name="btnAdresSearch" type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
								</div>       
							</div>
							<div class="col-md-3"></div>
						</form>
					</div>
					
					<div class="row">
						
						<?php
						
					
							$start = 0;
							$limit = 1;
							
							$p      = new _realstateposting;
							$pf     = new _postfield;
							
							if(isset($_GET['dream']) && $_GET['dream'] != ""){
								
								//show all listing which is type is buy
								if($_GET['dream'] == 'buy'){
									//die('------');
									$fieldName = 'Sell';
									$res = $p->countTotalPost($_GET["categoryID"], $fieldName);
									
									}else if($_GET['dream'] == 'rent'){
									$fieldName = 'Rent';
									$res = $p->countTotalPost($_GET["categoryID"], $fieldName);
									
									}else if($_GET['dream'] == 'open'){
									$fieldName = 'Open';
									$res = $p->countTotalPost($_GET["categoryID"], $fieldName);
									
									}else{
									$res = $p->publicpost_event($_GET["categoryID"]);
									
								} 
								}else{
								$type = "Sell"; 
								
								$start=0;
								$limit=12;
								
								if($_GET['page']==1){
									$start=0;
									}else{
									$start=($_GET['page']*$limit)-$limit;
								}
								
								
								
if($_SESSION['realstate_default_city'] !="" ||  $_SESSION['realstate_default_state'] !="" || $_SESSION['realstate_default_country'] !=""){ 
									$defcountry = $_SESSION['realstate_default_country'];
									$defstate = $_SESSION['realstate_default_state'];
									$defcity = $_SESSION['realstate_default_city'];
									
									
								}
								else{ 
									$p = new _spuser;
									$defAdd = $p->read($_SESSION['uid']);
									
									$default_address = 	mysqli_fetch_assoc($defAdd);
									
									$defcountry = $default_address['default_country'];
									$defstate = $default_address['default_state'];
									$defcity = $default_address['default_city'];
									
									
								}
								
								
								
								$proptype = "Condo";
								$pr      = new _realstateposting;
								$res = $pr->showAllPropertybytype($proptype,$defcountry,$defstate,$defcity);
								$numrowsw = mysqli_num_rows($res); 
								//$res = $p->publicpost_event($_GET["categoryID"]); showAllProperty showAllPropertylimit
							}
							
							
						?>
						
						<div class="list-wrapper">
							
							<?php
								//echo $p->ta->sql;
								if($res != false){
									echo "<h1 class='text-center'>Condominium Type Property</h1>";
									while ($row = mysqli_fetch_assoc($res)) {
										//posting fields
										$result_pf = $pf->read($row['idspPostings']);
										//echo $pf->ta->sql."<br>";
										if($result_pf){
											/*$address = "";
												$bedroom = "";
												$bathroom = "";
												$sqrfoot = "";
												$basement = "";
											$propertyType = "";*/
											
											while ($row2 = mysqli_fetch_assoc($result_pf)) {
												
												if($propertyType == ''){
													if($row2['spPostFieldName'] == 'spPostingPropertyType_'){
														$propertyType = $row2['spPostFieldValue'];
													}
												}
												if($address == ''){
													if($row2['spPostFieldName'] == 'spPostingAddress_'){
														$address = $row2['spPostFieldValue'];
													}
												}
												if($bedroom == ''){
													if($row2['spPostFieldName'] == 'spPostingBedroom_'){
														$bedroom = $row2['spPostFieldValue'];
													}
												}
												if($bathroom == ''){
													if($row2['spPostFieldName'] == 'spPostingBathroom_'){
														$bathroom = $row2['spPostFieldValue'];
													}
												}
												if($sqrfoot == ''){
													if($row2['spPostFieldName'] == 'spPostingSqurefoot_'){
														$sqrfoot = $row2['spPostFieldValue'];
													}
												}
												if($basement == ''){
													if($row2['spPostFieldName'] == 'spPostBasement_'){
														$basement = $row2['spPostFieldValue'];
													}
												}
												
											}
											
										}
									?>
									<div class="list-item">
										<div class="col-md-3">
											<div class="realBox">
												<a href="<?php echo $BaseUrl.'/real-estate/property-detail.php?postid='.$row['idspPostings'];?>">
													<div class="boxHead">
														<h2>
															<?php 
																//print_r($row); die('==============');
																if(strlen($row['spPostingTitle']) < 15){
																	echo ucwords($row['spPostingTitle']);
																	}else{
																	echo ucwords(substr($row['spPostingTitle'], 0,15)).'...';
																}
															?>
															
														</h2>
														<p style="white-space: nowrap; width: 175px; overflow: hidden; text-overflow: ellipsis;">
															<i class="fa fa-map-marker"></i> 
															<?php //spPostingAddress_
																if(strlen($row['spPostingAddress']) < 30){
																	echo $row['spPostingAddress'];
																	}else{
																	echo substr($row['spPostingAddress'], 0,30)."...";
																}
															?>
														</p>
													</div>
													<?php
														$pic = new _realstatepic;
														
														$res2 = $pic->readFeature($row['idspPostings']);
														if($res2 != false){
															if($res2->num_rows > 0){
																if ($res2 != false) {
																	$rp = mysqli_fetch_assoc($res2);
																	$pic2 = $rp['spPostingPic'];
																	echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
																}
																}else{
																$res2 = $pic->read($row['idspPostings']);
																if ($res2 != false) {
																	$rp = mysqli_fetch_assoc($res2);
																	$pic2 = $rp['spPostingPic'];
																	echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
																}
															}
															}else{
															$res2 = $pic->read($row['idspPostings']);
															if ($res2 != false) {
																$rp = mysqli_fetch_assoc($res2);
																$pic2 = $rp['spPostingPic'];
																echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
																} else{
																echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>"; 
															}
														}?>
														<div class="midLayer">
															<ul>
																<li data-toggle="tooltip" title="Square Foot"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-1.png"><?php echo ($row['spPostingSqurefoot']  > 0)?$row['spPostingSqurefoot']:0; ?></li>
																<li data-toggle="tooltip" title="Bed Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-2.png"><?php echo ($row['spPostingBedroom'] > 0)?$row['spPostingBedroom'] :0;?></li>
																<li data-toggle="tooltip" title="Bath Room" class="text-center"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-3.png"><?php echo ($row['spPostingBathroom']  > 0)?$row['spPostingBathroom']:0; ?></li>
																<li data-toggle="tooltip" title="Basement" class="text-right"><img src="<?php echo $BaseUrl;?>/assets/images/real/icon-4.png"><?php echo ($row['spPostBasement']  > 0)?$row['spPostBasement'] :0; ?></li>
															</ul>
														</div>
														<div class="boxFoot bg_white text-center"> 
															<p class="proType"><?php echo $propertyType;?></p>
															<p><span><?php echo $row['defaltcurrency'].' '.$row['spPostingPrice'];?></span></p>
														</div>
												</a>
											</div>
										</div>
									</div>
									
									<?php
									}
									
								}else{
							
								echo "<h3 class='text-center'>There is no property found of TOWN TYPE  in "  .$defcity. ','.$defstate.','.$defcountry ."</h3>";
								?>
								<style>
								      #pagination-container{
									  display:none;
									  }
								</style>
								<?php
								}
				
							?>
						</div>
						<div id="pagination-container"></div>
					</div>
					<div class="row">	
						<div class="col-md-6" style=" text-align: left; ">
							
						</div>	
						
						<div class="col-md-6" style=" text-align: right; ">
							
						</div>
					</div>
					
					
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
	
	// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/
	
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

<script>
	var input = document.getElementById('spPostingAddress_');
	var autocomplete = new google.maps.places.Autocomplete(input);
</script>  
<script type="text/javascript">
	$(document).ready(function(){
		$(".usercountry").hide();
	});
	//==========ON CHANGE LOAD CITY==========
	$(".spPostingsState").on("change", function () {
		
		//alert(this.value);
		var state = this.value;
		$.post("loadUserCity.php", {state: state}, function (r) {
			//alert(r);
			$(".loadCity").html(r);
		});
		
	});
	//==========ON CHANGE LOAD CITY==========
</script>