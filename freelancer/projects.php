<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
include('../univ/baseurl.php');
session_start();
//print_r($_SESSION['uid']);

if(!isset($_SESSION['pid'])){ 
	$_SESSION['afterlogin']="freelancer/";
	include_once ("../authentication/check.php");

}else{

	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}

	require_once "../common.php";

	spl_autoload_register("sp_autoloader");

	$activePage = 2; 

	$p      = new _postingview;
	$pf     = new _postfield;
	$prof   = new _profilefield;
	$pr     = new _spprofiles;
	$pl     = new _postlike;
	$p2     = new _favorites;
	$re     = new _redirect;

	$sf  = new _freelancerposting;
	$fe = new _freelance_favorites;

	$bd = new _freelance_placebid;

//  print_r($_SESSION['pid']);

	$result_pr = $pr->myfreelanceraccount($_SESSION['uid']);

//print_r($result_pr); exit();

// echo $pr->ta->sql; exit;
//  exit();


	$skillMatch = '';

	if($result_pr){
		while ($row_pr = mysqli_fetch_assoc($result_pr)) {

			$result_prof = $prof->getSkill($row_pr['idspProfiles']);

// echo $prof->ta->sql;

			if($result_prof){
				$row_prof = mysqli_fetch_assoc($result_prof);
				$skill = $row_prof['spProfileFieldValue'];

//print_r($row_prof);
				if($skill != ''){
					$skillMatch = $skillMatch .','. $skill;


// echo "herecode -"; print_r($skillMatch);
				}
			}
		}
	}
// echo "<pre>";
//print_r($skillMatch); exit();

//check profile is freelancer or not
	$chekIsFreelancer = $pr->readfreelancer($_SESSION['pid']);
	if($chekIsFreelancer == false){
		$redirctUrl = $BaseUrl . "/my-profile/";
		$_SESSION['count'] = 0;
		$_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
		$re->redirect($redirctUrl);
	}
	
	$catId = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;

	$m = new _subcategory;

	$result = $m->showName($catId);
	if ($result) {
		$row3 = mysqli_fetch_assoc($result);

		$cate = $row3['subCategoryTitle']; 

	}
	?>
	<!DOCTYPE html>
	<html lang="en-US">
	<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">

	<head>
		<?php include('../component/f_links.php');?>

		<style type="text/css">



			.dashboard-section {
				border: 1px solid #b7b7b7;
				background-color: #fdfdfd;
				box-shadow: 0 2px 2px 0 rgba(0,0,0,.08);
				margin-bottom: 12px;
			}

			.dashboardbreadcrum {
				padding: 0;
			}

			.dashboard-section .dashboardbreadcrum .breadcrumb {
				padding: 10px 15px!important;
				margin-bottom: 0!important;
				background-color: #fdfdfd;
			}

			.dashboard-section .dashboardbreadcrum li .dash {
				color: #ff6b04;
				font-size: 18px;
				font-family: Marksimon;
				text-transform: uppercase;
			}
			.dashboard-section .dashboardbreadcrum li .draft {
				color: black;
				font-size: 18px;
				font-family: Marksimon;
				text-transform: uppercase;
			}


			.list-wrapper {
				padding: 15px;
				overflow: hidden;
			}

			.list-item {
				border: 1px solid #EEE;
				background: #FFF;
				margin-bottom: 10px;
				display: contents;
				padding: 10px;
				box-shadow: 0px 0px 10px 0px #EEE;
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
				border: 1px solid #EEE;
				background-color: #FFF;
				box-shadow: 0px 0px 10px 0px #EEE;
			}

			.simple-pagination .current {
				color: #FFF;
				background-color: #c45508;
				border-color: #c45508;
			}

			.simple-pagination .prev.current,
			.simple-pagination .next.current {
				background: #c45508;
			}
			#drop0
			{
				margin-right: -23px;
			}
			#caret0
			{
				margin-left: 5px;
			}
			button.btn.btn-primary.dropdown-toggle.freelancer_capitalize.sidedropdown {
				font-size: 13px!important;
				padding: 6px 5px!important;
			}
			#profileDropDown li.active {
				background-color: #c45508;
			}
			#profileDropDown li.active a {
				color: white;
			}

		</style>

	</head>

	<body class="bg_gray"> 
		<?php
		
		$header_select = "freelancers";
		include_once("../header.php");
		?>
		<section class="main_box" id="freelancers-page">
			<div class="container nopadding projectslist ">

				<div class="col-xs-12 col-sm-3 ">
					<div class="leftsidebar projectsidebar">
						<?php include('../component/left-freelancer.php'); ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-9 nopadding ">

					<div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
						<div class="col-xs-12 dashboardbreadcrum">
							<ul class="breadcrumb">

								<li><a class="dash" href="<?php echo $BaseUrl;?>/freelancer/dashboard/">Dashboard</a></li>
								<?php 

								$m = new _subcategory;
								//$cat = isset($_GET['cat']) ? strtoupper($_GET['cat']) : 'ALL';
								if($catId){
									$row = selectQ("select * from subcategory where idsubCategory=?", "i", [$catId], "one");
								}

								$cate = isset($row['subCategoryTitle']) ? $row['subCategoryTitle'] : ""; 

								?> 
								<?php if($catId == 0){ ?>
									<li><a class="draft" ><?php //echo $cate; ?>All Projects</a></li>
								<?php } else{ ?>
									<li><a href="" style="font-size: 18px; color:#ff6b04;"><?php echo $cate; ?>  Projects</a></li>
								<?php } ?>
								<!-- <li><?php echo $title;?></li> -->
								<!--  <a href="<?php echo $BaseUrl ?>/post-ad/freelancer/?post" class="btn post-project postproject" style="float: right;background-color: orange;color: #fff;margin-bottom: 4px;margin-top: -4px;padding-bottom: 4px;" >Post a project</a> -->
							</ul>
						</div> 
					</div>


					<div class="col-xs-12 nopadding" style="min-height: 300px; margin-top: 15px;">
						<input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">
						<?php  
						if(isset($_POST['cat'])){
							$cate = implode("', '", $_POST['cat']);
							$cate = "'" . implode ( "', '", $_POST['cat'] ) . "'";
							$res = $sf->total_post_freelancer_name1($cate);
						}else if($catId){
							if($catId == 0){
								$s = new _subcategory;
								$idresult = $s->showall_id(5);
								while($row4 = mysqli_fetch_assoc($idresult)){
									$catidall[]=$row4['idsubCategory'];
								}
								$commaseprated_id = "'" . implode ( "', '", $catidall) . "'";
								$result1 = $m->showall_Nameall($commaseprated_id);
								if ($result1) {
									while($row5 = mysqli_fetch_assoc($result1))
									{
										$subCategoryTitle[] =$row5['subCategoryTitle'];
									}
									if (($key = array_search("Admin", $subCategoryTitle)) !== false) {
										unset($subCategoryTitle[$key]);
									}
									$subCategoryTitle_name = "'" . implode ( "', '", $subCategoryTitle) . "'";
									$res = $sf->total_post_freelancer_name1($subCategoryTitle_name);
								}
								else{
								}
							}
// GET NAME OF THE PROJECTS
							$m = new _subcategory;
							$result = $m->showName($catId);
							if ($result!=false) {
								$row3 = mysqli_fetch_assoc($result);
								$cate = $row3['subCategoryTitle']; 
								$implode_profileids = implode("','", $ids);
								$res = $sf->total_post_freelancer1($row3['subCategoryTitle']);
								if($res == ""){
									echo "<h3 style='text-align:center;'>No Project Found</h3>";
									$dataaaaa="none";
								}
							}
						}else if($catId && $catId == 0){
						}else{
							$res = $sf->publicpost_skill1(5, $_SESSION['pid'], $skillMatch);
						}
						if($res){
							$closingdate = "";
							$Fixed = "";
							$Category = "";
							$hourly = "";
							$skill = "";
							?>
							<span><b style="font-size:25px;"> <?php //echo ucfirst(strtolower($cate)); ?> </b></span>

							<div class="list-wrapper">
								<?php 
								$rain =$res->num_rows;
								while ($row = mysqli_fetch_assoc($res)) {
									if($row['spuser_idspuser']!=NULL){
										$st= new _spuser;
										$st1=$st->readdatabybuyerid($row['spuser_idspuser']);
										if($st1!=false){
											$stt=mysqli_fetch_assoc($st1);
											$account_status=$stt['deactivate_status'];
										}
									}
									$pt = new _productposting;
									$idposting=$row['idspPostings']; 
									$flagcmd=$pt->flagcount(5,$idposting);
									$flagnums=$flagcmd->num_rows;
									if($flagnums=='9')
									{
										$updatestatus=$pt->freelancerstatus($idposting); 
									}
									if($closingdate == ''){
										if($row['spPostFieldName'] == 'spClosingDate_'){
											$closingdate = $row2['spPostFieldValue']; 
										}
									}
									if($Fixed == ''){
										if($row['spPostingPriceFixed'] == 1){
											$Fixed = "Fixed Rate";
										}else{
											$hourly ="Hourly Rate";                                                 }
										}
										if($Category == ''){
											$Category = $row['spPostingCategory']; 
										}
										if($skill == ''){
											$skill = explode(',', $row['spPostingSkill']);
										}
										$postingDate = $sf-> spPostingDate1($row["spPostingDate"]);
										?>

										<div class="list-item">
											<?php if($account_status!=1){?>

												
												<div class="col-xs-12 freelancer-post bradius-15 back">
													<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>">
														<div class="col-xs-12 col-sm-9 nopadding">
															<h2 class="designation-haeding">
																<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a></h2>
																<p class="timing-week" style="font-weight: bolder!important;">
																	<?php echo ($Fixed != '')? $Fixed: $hourly;?><!--  - <?php echo $Category;?> - <?php echo $postingDate;?> --></p>
																</div>
															</a>
															<div class="col-xs-12 col-sm-3 text-right social_freelancer">
																<?php
//echo $rw['spUserid'].'mmmmm';
																$re = $fe->read($row['idspPostings']);
																if($row['spProfiles_idspProfiles'] != $_SESSION['uid']){
																	if ($re != false) {
																		$i = 0;

																		while ($rw = mysqli_fetch_assoc($re)) {
	//print_r($rw);
																			if ($rw['spUserid'] == $_SESSION['uid']) {
	//echo ("fffffffffffff");
																				echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart removefavorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
																				$i++;
																			}
																		}
																		if ($i == 0) {
	//echo ("wwwwwwwwwwwwww");

																			echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
																		}
																	} else {
	//echo ("ccccccccccccccccc");

																		echo "<span  data-placement='bottom'  class='icon-favorites fa fa-heart-o sp-favorites' style='margin-left:10px;' data-postid='" . $row['idspPostings'] . "'></span>";
																	}
																}  
																?>
															</div>

															<div class="col-xs-12 nopadding">
																<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" style="color:black;">

																	<p class="post-details" style="word-break: break-all; "> 
																		<?php
																		if(strlen($row['spPostingNotes']) < 400){
																			echo $row['spPostingNotes'];
																		}else{
																			echo substr($row['spPostingNotes'], 0,400);
																		} ?>
																	</a>
																	<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" class="readmore ">...Read More</a>
																</p>
																<?php
																$skill = explode(',', $row['spPostingSkill']);

																if(count($skill) >0){
																	foreach($skill as $key => $value){
																		if($value != ''){
																			echo "<span class='skills-tags bradius-10 freelancer_uppercase skillfont'>".$value."</span>";
																		}

																	}
																}
																?>
															</div>
															<a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>">
																<div class="col-xs-12 nopadding margin-top-13">
																	<div class="col-xs-12 col-sm-4 nopadding">
																		<?php 
																		$bids = $bd->totalbids1($row['idspPostings']);
																		if($bids){
																			$totalbids = $bids->num_rows;
																		}else{
																			$totalbids = "0";
																		}
																		?>
																		<p><span class="proposals">Proposals:</span><span class="noofproposal">&nbsp;<?php echo $totalbids; ?></span></p>
																	</div>
																	<div class="col-xs-12 col-sm-4 nopadding">
																		<p class="proposals"><?php 
																		echo ($row['spPostingPrice'] > 0)?$row['Default_Currency'] .' '.$row['spPostingPrice'] : 0;?></p>
																	</div>
																</div>
															</a>
														</div>

													<?php } ?>
												</div>

												<?php
											}
										}
										?>

									</div>

									<?php if(($res!=false)&&($account_status!=1)){?>
										<?php
										if($rain > 10)
										{
											?>
											<div id="pagination-container" style="display:<?php echo $dataaaaa;?>" ></div>
										<?php } ?>
									<?php } ?>
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

			<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.js"></script>
			<script>
// jQuery Plugin: http://flaviusmatis.github.io/simplePagination.js/

				var items = $(".list-wrapper .list-item");
				var numItems = items.length;
				var perPage = 10;

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
