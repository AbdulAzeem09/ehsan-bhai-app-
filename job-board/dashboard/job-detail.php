<?php
	
    include('../univ/baseurl.php');
    session_start();
	if(!isset($_SESSION['pid'])){
		$_SESSION['afterlogin']="job-board/";
		include_once ("../authentication/check.php");
		
		}else{
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		
		$_GET["categoryid"] = $_GET['categoryID'] = "2";
		$_GET["categoryName"] = "Job Board";
		
		$f = new _spprofiles;
		$sl = new _shortlist;
		
		
		if(isset($_POST['Change_Current_Location'])){
			session_start();	
			
			$_SESSION["Countryfilter"] = $_POST['spUserCountry'];
			$_SESSION["Statefilter"] = $_POST['spUserState'];
			$_SESSION["Cityfilter"] = $_POST['spUserCity'];
			
			
			//unset($_SESSION['Products']);
		}
		
		if(isset($_POST['Closeresetlocation'])){
			session_start();	
			
			unset($_SESSION['Countryfilter']);
			unset($_SESSION['Statefilter']);
			unset($_SESSION['Cityfilter']);
			
		}
		
	?>
	<!DOCTYPE html>
	<html lang="en-US">
		
		<head>
			<?php include('../component/f_links.php');?>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
			<!--This script for posting timeline data End-->
			<script type="text/javascript">
				function printContent(el){
					var restorepage = document.body.innerHTML;
					var printcontent = document.getElementById(el).innerHTML;
					document.body.innerHTML = printcontent;
					window.print();
					document.body.innerHTML = restorepage;
				}
				
			</script>
		</head>
		<style media="screen">
			
			.midjob form.job_search {
			box-shadow: 0 0 6px 0 rgb(0 0 0 / 12%), 0 4px 10px 0 rgb(0 0 0 / 16%);
			background-color: #fff !important;
			padding: 10px;
			}
			.container {
			padding-right: 0px;
			padding-left: 0px;
			margin-right: auto;
			margin-left: auto;
			}
			.midjob {
			padding: 10px;
			}
			.space-lg {
			min-height: 0px;
			}
			
            .midjob {
			margin: 10px 0px;
			}
			.midjob form.job_search {
			box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.12), 0 4px 10px 0 rgba(0, 0, 0, 0.16);
			background-color: #fff !important;
			padding: 16px;
			}
			.midjob form.job_search .form-group input {
			height: 48px;
			border-radius: 50px;
			}
			.midjob form.job_search button#btnJobSearch {
			padding: 12px 30px !important;
			border-radius: 0 !important;
			width: 100%;
			}
			section.landing_page.bg_white {
			margin-bottom: 16px;
			}
			.whiteboardmain {
			padding: 15px 23px 15px 15px;
			margin-bottom: 20px;
			}
			.whiteboardmain h4 {
			margin-bottom: 20px;
			margin-top: 30px;
			font-size: 20px;
			}
			.whiteboardmain p {
			margin-bottom: 6px;
			}
			.right_main_top .row:hover {
			background-color: #f1f1f1f1;
			cursor: pointer;
			}
			.right_main_top h4 {
			margin-top: 10px;
			line-height: 26px;
			}
			.right_main_top h4 a {
			font-size: 18px;
			color: #000;
			}
			.right_main_top button.jobbutton.btn-primary {
			margin-top: 20px !important;
			}
			.right_main_top span {
			padding: 0px 4px;
			margin-right: 2px;
			margin-left: 8px;
			}
			.right_main_top button.jobbutton.btn-primary {
			margin-top: 20px !important;
			padding: 5px 10px;
			border: 1px solid #fff;
			}
			.skilllink {
			margin-right: 10px !important;
			}
			
			/* --------new-job-list-css----------- */
			
			.right-job-listing {
			margin-top: 10px;
			background-color: #fff;
			}
			.right-job-listing table#task-list-tbl {
			width: 100%;
			}
			.job-content {
			padding: 0 16px;
			border-bottom: 1px solid #DEDEDE;
			}
			.job-content .job-card {
			padding: 24px 0;
			}
			.job-content .job-card .card-primary .pri-head {
			margin-bottom: 16px;
			}
			.job-content .job-card .card-primary .pri-head .head-link {
			font-size: 16px;
			line-height: 1.5;
			color: #0e1724;
			font-weight: 700;
			margin-right: 4px;
			}
			.job-content .job-card .card-primary .pri-head .head-days {
			margin-right: 12px;
			}
			.job-content .job-card .card-primary .pri-head .new-head {
			background-color: #4fb55d;
			color: #fff;
			padding: 2px 4px;
			font-size: 12px;
			margin-right: 3px;
			border: 1px solid #4fb55d;
			margin-bottom: 3px;
			display: inline-block;
			}
			.job-content .job-card .card-primary .pri-head .new-head {
			padding: 0px 4px;
			margin-right: 2px;
			margin-left: 2px;
			}
			.job-content .job-card .card-primary .pri-para {
			margin-bottom: 16px;
			font-size: 14px;
			line-height: 1.4;
			color: #0e1724;
			}
			.job-content .job-card .card-primary .pri-tags a {
			margin-bottom: 8px;
			margin-right: 8px;
			text-decoration: none;
			color: #007fed !important;
			}
			.job-content .job-card .card-secondary .price {
			font-size: 16px;
			line-height: 1.5;
			font-weight: 700;
			margin-bottom: 8px;
			color: #0e1724;
			}
			.job-content .job-card .card-secondary .price .avg {
			font-size: 13px;
			font-weight: 400;
			line-height: 1.2;
			font-weight: 400;
			}
			.job-content .job-card .card-secondary .entry {
			font-size: 14px;
			line-height: 1.43;
			color: #0e1724;
			}
			.job-content .job-card .card-secondary .avg-btn {
			display: block;
			margin-top: 10px;
			}
			.job-content .job-card .card-secondary .avg-btn .avg-bid {
			background: #337ab7;
			border: 1px solid #337ab7;
			color: #F7F7F7;
			font-weight: 700;
			text-shadow: 0 -1px transparent;
			padding: 4px 12px;
			font-size: 13px;
			border-radius: 50px;
			}
			.job-content:hover {
			background-color: #F7F7F7;
			cursor: pointer;
			}
			.job-content:hover .avg-btn {
			display: block !important;
			margin-top: 12px;
			}
			.avg-bid {
			background: #5dc26a;
			border-color: #5dc26a;
			color: #F7F7F7;
			}
			.location-btn {
			margin-top: 16px;
			margin-left: 2px;
			}
			.location-btn a.loc-btn {
			color: #000;
			font-size: 15px;
			}
			
			/* ----start-media-query-css----- */
			
			@media only screen and (max-width: 767px) {
			
			.home_top_job {
			padding: 0px;
			}
			.midjob form.job_search button#btnJobSearch {
			margin-top: 20px;
			}
			
			}
			
			.box {
			background: linear-gradient(to right, #31abe3, #31abe3);
			color: white;
			--width: aliceblue;
			--height: calc(var(--width) / 3);
			height: var(--height);
			text-align: center;
			line-height: var(--height);
			font-size: calc(var(--height) / 1.5);
			font-family: sans-serif;
			letter-spacing: 0.2em;
			border: 1px solid #31abe3;
			border-radius: 0em;
			transform: perspective(500px) rotateY(-15deg);
			text-shadow: 6px 3px 2px rgba(0, 0, 0, 0.2);
			box-shadow: 1px 2px 0px 3px rgb(0 0 0 / 9%);
			transition: 0.5s;
			position: relative;
			overflow: hidden;
			margin-top: 20px;
			margin-left: 0;
			width: 54%;
			margin: 16px auto;
			padding: 16px 0;
			}
			
			.box:hover {
			transform: perspective(500px) rotateY(15deg);
			text-shadow: -6px 3px 2px rgba(0, 0, 0, 0.2);
			box-shadow: -2px 0 0 5px rgba(0, 0, 0, 0.2);
			}
			
			.box::before {
			content: '';
			position: absolute;
			width: 100%;
			height: 100%;
			background: linear-gradient(to right, transparent, white, transparent);
			left: -100%;
			transition: 0.5s;
			}
			
			.box:hover::before {
			left: 100%;
			}
			.bradius-10 {
			border-radius: 10px!important;
			background: #f1f1f1;
			}
			.modal-header.br_radius_top.bg-white button.close {
			font-size: 28px;
			color: #fff;
			opacity: 1;
			border: 1px solid #31abe3;
			line-height: 20px;
			padding: 6px;
			border-radius: 6px;
			background: #31abe3;
			}
			.modal-body h2 {
			padding: 6px 0;
			font-size: 18px;
			line-height: 26px;
			letter-spacing: 0.5px;
			}
			
			/* -----style-css-23-june---- */
			
			h6.back-block {
			clear: both;
			margin: 18px 0px;
			padding-top: 10px;
			}
			h6.back-block i.fa.fa-arrow-left {
			margin-right: 2px;
			}
			.right_job_detail h3 {
			/*        padding-bottom: 8px;
			*/    }
			.right_detail_job.first {
			margin-bottom: 16px;
			}
			.right_detail_job {
			margin-bottom: 30px;
			margin-left: -15px;
			}
			.right_detail_job h1 {
			margin-top: 0px;
			}
			.right_job_detail {
			margin-bottom: 20px;
			
			}
			.right_detail_job h2 {
			padding-bottom: 14px;
			padding-top: 10px;
			}
			.right_job_detail p {
			margin-bottom: 10px;
			}
			.left_detail_job ul.skills-list li {
			margin-top: 10px;
			display: inline-block;
			margin-right: 12px;
			font-size: 13px;
			font-weight: 400;
			border: 1px solid #ccc;
			border-radius: 14px;
			padding: 4px 12px;
			margin-bottom: 6px;
			text-align: center;
			position: relative;
			background: #31abe3;
			color: #fff;
			}
			.left_detail_job ul.skills-list li i.fa {
			margin-right: 6px;
			}
			.midjob {
			margin: 0px 0px !important;
			}
			.breadcrumb {
			padding: 0px 7px !important;
			margin-bottom: 0px !important;
			list-style: none;
			background-color: #f5f5f5;
			border-radius: 4px;
			}
			
			.container.whiteboardmain.country {
			padding: 0px 0px 0px 0px !important;
			margin-bottom: 20px !important;
			}
			
			
			media (min-width: 992px){
			.col-md-2 {
			
			}
			}
			
		</style>
		
		<body class="bg_gray">
			<?php
				$header_jobBoard = "header_jobBoard";
				include_once("../header.php");
			?>
			<!-- <section class="" style="border-bottom: 2px solid #CCC"> -->
			
            <section class="" >
				<!--  <div class="container" style="padding-top: 20px;">
					<div class="col-md-12  dashboard-section " style="background-color: #fff; border: 1px solid #ccc;margin-bottom: 10px;border-radius: 5px;width: 100%;">
					
					<h3 style="margin-top: 10px!important;">Job Board Module</h3>
					
					
					
					<a style="float:right;margin-top:-3%;" href="<?php echo $BaseUrl.'/job-board/dashboard/emp_dashboard.php';?>">My Dashboard</a>
					
					</div>
					<?php
						if(isset($_SESSION['email_msg']) ){
						?>
						<div class="space" style="margin:10px;"></div>
						<p class="alert alert-info"><?php echo $_SESSION['email_msg'];  ?></p> <?php
							unset($_SESSION['email_msg']);
							
						} ?>
				-->
				<!--       <h6 class="back-block"> <a href="<?php echo $BaseUrl; ?>/job-board/"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Home</a></h6> -->
				<?php if($_GET["job"] == "success") { ?>
					<div style="width: 100%;">
						<div class="alert alert-success">
							Your Application has been Submited Successfully
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				<?php } ?>
                <?php
					
                    $p = new _jobpostings;
                    $res = $p->singletimelines($_GET['postid']);
                    //echo $p->ta->sql;
                    if($res){
                        $row = mysqli_fetch_assoc($res);
						
                        $title      = $row['spPostingTitle'];
                        $overview   = $row['spPostingNotes'];
                        $country    = $row['spPostingsCountry'];
                        $city       = $row['spPostingsCity'];
                        $dt         = new DateTime($row['spPostingDate']);
                        $postingDate = $p->spPostingDate($row["spPostingDate"]);
                        $clientId   = $row['spProfiles_idspProfiles'];
                        $postedPerson = $row['spUser_idspUser'];
                        $CloseDate  = $row['spPostingExpDt'];
						
						$skill      = explode(',', $row['spPostingSkill']);
						$jobType    = $row['spPostingJobType'];
						$jobTypennnn    = $row['spPostingJobType'];
						$jobLevel   = $row['spPostingJoblevel'];
						$location   = $row['spPostingsCity'];
						$salaryStrt = $row['spPostingSlryRngTo'];
						$salaryEnd  = $row['spPostingSlryRngFrm'];
						
						if($row['spPostingSlryRngFrm']>0){$salaryyy = $row['job_currency'].' '.$row['spPostingSlryRngFrm'].' - '. $row['job_currency'].' '.$row['spPostingSlryRngTo'].'';} 
						
						
						$Experience = $row['spPostingExperience'];
						$howAply    = $row['spPostingApply'];
						$noOfPos    = $row['spPostingNoofposition'];
                        // company profile information
                        $u = new  _spbusiness_profile;
                        $result3 = $u->read($clientId);
                        //echo $u->ta->sql;
                        if ($result3) {
                            $CmpnyName = "";
                            $CmpnyDesc  = "";
                            $CmpSize    = "";
							
                            $row3 = mysqli_fetch_assoc($result3);
							
                            //print_r($row3);
							
							$CmpSize = $row3['CompanySize'];
							//$CmpnyDesc = $row3['skill'];
							$CmpnyName = ucfirst($row3['companyname']);
							/*
								while ($row3 = mysqli_fetch_assoc($result3)) {
                                if($CmpnyName == ''){
								if($row3['spProfileFieldName'] == 'companyname_'){
								$CmpnyName = $row3['companyname'];
								}
                                }
                                if($CmpnyDesc == ''){
								if($row3['spProfileFieldName'] == 'companytagline_'){
								$CmpnyDesc = $row3['skill'];
								}
                                }
                                if($CmpSize == ''){
								if($row3['spProfileFieldName'] == 'CompanySize_'){
								$CmpSize = $row3['CompanySize'];
								}
                                }
							}*/
						}
                        // ========================END======================
                        $pf = new _postfield;
                        $result_pf = $pf->read($row['idspPostings']);
                        //echo $pf->ta->sql."<br>";
                        if($result_pf){
							
							
                            /*$skill      = "";
								$jobType    = "";
								$jobLevel   = "";
								$location   = "";
								
								$salaryStrt = "";
								$salaryEnd  = "";
								$Experience = "";
								$howAply    = "";
							$noOfPos    = "";*/
							
                            /*while ($row2 = mysqli_fetch_assoc($result_pf)) {
								
								
                                if($noOfPos == ''){
								if($row2['spPostFieldName'] == 'spPostingNoofposition_'){
								$noOfPos = $row2['spPostFieldValue'];
								}
                                }
								
                                if($howAply == ''){
								if($row2['spPostFieldName'] == 'spPostingApply_'){
								$howAply = $row2['spPostFieldValue'];
								}
                                }
                                if($Experience == ''){
								if($row2['spPostFieldName'] == 'spPostingExperience_'){
								$Experience = $row2['spPostFieldValue'];
								}
                                }
                                if($salaryEnd == ''){
								if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
								$salaryEnd = $row2['spPostFieldValue'];
								}
                                }
                                if($salaryStrt == ''){
								if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
								$salaryStrt = $row2['spPostFieldValue'];
								}
                                }
								
								
                                if($skill == ''){
								if($row2['spPostFieldName'] == 'spPostingSkill_'){
								$skill = explode(',', $row2['spPostFieldValue']);
								}
                                }
                                if($jobType == ''){
								if($row2['spPostFieldName'] == 'spPostingJobType_'){
								$jobType = $row2['spPostFieldValue'];
								}
                                }
                                if($jobLevel == ''){
								if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
								$jobLevel = $row2['spPostFieldValue'];
								}
                                }
                                if($location == ''){
								if($row2['spPostFieldName'] == 'spPostingLocation_'){
								$location = $row2['spPostFieldValue'];
								}
                                }
								
							}*/
							// echo $postingDate;
                            //echo $row["spPostingDate"];
                            date_default_timezone_set("Asia/Karachi");
							
                            $postingDate = $p->get_timeago(strtotime($row["spPostingDate"]));
                            //$postingDate = $p-> spPostingDate($row["spPostingDate"]);
						}
					} ?>
					
					<!--     <div class="row top_detail_board m_top_20">
						<div class="col-md-3">
                        <a href="<?php echo $BaseUrl;?>/job-board/all-jobs.php"><i class="fa fa-angle-left"></i> Back to Jobs</a>
						</div>
						<div class="col-md-7">
                        <h1><?php echo $title;?></h1>
                        <p class="btmjobtitle">@ <?php echo $CmpnyName;?></p>
						</div>
						<div class="col-md-2">
                        <?php
							if($_SESSION['ptid'] == 1){
								$u = new _spuser;
								$p_result = $u->isverify($_SESSION['uid']);
								if ($p_result == 1) {
								?>
                                <a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?>" class="btn butn_jobboard">Post a job</a> <?php
								}
							}?>
							<p class="lightrightjob">Posted <?php echo $postingDate;?></p>
							</div>
					</div> -->
			</div>
		</section>
		<section class="midjob">
            <div class="container">
                <form class="job_search" id="job_search" method="post" action="https://dev.thesharepage.com/job-board/">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group no-margin">
                                        <input type="text" name="txtJobTitle" id="txtJobTitle" class="form-control" value="<?php echo $_POST['txtJobTitle']; ?>"  placeholder="Job Title" />
                                        <span id="title_err" style="color: red;"></span>
									</div>
								</div>
                                <div class="col-md-4">
                                    <div class="form-group no-margin">
                                        <input type="text" id="txtJobLoc"  name="txtJobLoc" class="form-control" list="suggested_address" onkeyup="getaddress();" value="<?php echo $_POST['txtJobLoc']; ?>"  placeholder="Location" />
                                        <datalist id="suggested_address"></datalist>
										
                                        <span id="loc_err" style="color: red;"></span>
									</div>
								</div>
								<div class="col-md-4">
									<button type="submit" name="btnJobSearch" class="btn btnPosting db_btn ">Search</button>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-2">
									<div class="form-group no-margin">
										<?php
											if($_SESSION['ptid'] == 1){
												$u = new _spuser;
												$p_result = $u->isverify($_SESSION['uid']);
												if ($p_result == 1) {
													$pv = new _postingview;
													$reuslt_vld = $pv->chekposting(2,$_SESSION['pid']);
													if ($reuslt_vld == false) {
													?>
													<a href="<?php echo $BaseUrl.'/post-ad/job-board/?post';?> " class="btn" style="background-color:#7989b7; color:white">Post a job</a>
													<?php
													}
												}
											} ?>
									</div>
								</div>
								
								<div class="col-md-3" style="margin-right:-10px">
                                    <div class="form-group no-margin">
										<a href="<?php echo $BaseUrl.'/job-board/forwarded-Jobs.php'; ?>" class="btn btn-primary">Forwarded Jobs</a>
									</div>
								</div>
								<div class="col-md-2">
                                    <div class="form-group no-margin">
										<a href="/job-board/dashboard/" class="btn" style="background-color:purple; color:white;">Dashboard</a>
									</div>
								</div>
								
								<script type="text/javascript">
									function getaddress(){
										
										var address = $("#txtJobLoc").val();
										
										$.ajax({
											type: "POST",
											url: "../address.php",
											cache:false,
											data: {'address':address},
											success: function(data) {
												
												var obj = JSON.parse(data);
												
												$("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');
												
												
												$("#latitude").val(obj.latitude);
												$("#longitude").val(obj.longitude);
												
											}
										});
									}
									
									
								</script>
								<!--  <div class="col-md-3">
                                    <div class="form-group no-margin">
									<select class="form-control" name="txtJobLevel" >
									<option value="">Select Job Level</option>
									<?php
										$m = new _masterdetails;
										$masterid = 2;
										$result = $m->read($masterid);
										if($result != false){
											while($rows = mysqli_fetch_assoc($result)){
												echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
											}
										}
									?>
									</select>
                                    </div>
								</div> -->
								
							</div>
						</div>
						
						
					</div>
				</form>
			</div>
		</section>
		
		<section>
			
		</section>
		
		
		<div class="col-md-12" style="margin-top:3px;">
			
			<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
			
			
		</div>
		
		
		
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Change Current Location</h4>
					</div>
					<!----action="<?php echo $BaseUrl?>/post-ad/dopost.php"--->
					<form method="post">
						<div class="modal-body">
							<div class="row">
								
								<div class="col-md-4">
									<div class="form-group">
										<label for="spPostingCountry" class="lbl_2">Country</label>
										<select class="form-control " name="spUserCountry" id="spUserCountry" >
											<option value="">Select Country</option>
											<?php
												$co = new _country;
												$result3 = $co->readCountry();
												if($result3 != false){
													while ($row3 = mysqli_fetch_assoc($result3)) {
													?>
													<option value='<?php echo $row3['country_id'];?>' <?php echo (isset($_SESSION["Countryfilter"] ) && $_SESSION["Countryfilter"]  == $row3['country_id'])?'selected':''; ?>   ><?php echo $row3['country_title'];?></option>
													<?php
													}
												}
											?>
										</select>
										<!-- <input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>"> -->
									</div>
								</div>
								<div class="col-md-4">
									<div class="loadUserState">
										<label for="spPostingCity" class="lbl_3">State</label>
										<select class="form-control" name="spUserState">
											<option>Select State</option>
											<?php 
												if (isset($_SESSION["Statefilter"] ) && $_SESSION["Statefilter"] > 0) {
													$countryId = $_SESSION["Countryfilter"];
													$pr = new _state;
													$result2 = $pr->readState($countryId);
													if($result2 != false){
														while ($row2 = mysqli_fetch_assoc($result2)) { ?>
														<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($_SESSION["Statefilter"] ) && $_SESSION["Statefilter"] == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
														<?php
														}
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="loadCity">
										<div class="form-group">
											<label for="spPostingCity">City</label>
											<select class="form-control" name="spUserCity" >
												<option>Select City</option>
												<?php 
													if (isset($_SESSION["Cityfilter"] ) && $_SESSION["Cityfilter"] > 0) {
														$stateId = $_SESSION["Statefilter"];
														$co = new _city;
														$result3 = $co->readCity($stateId);
														//echo $co->ta->sql;
														if($result3 != false){
															while ($row3 = mysqli_fetch_assoc($result3)) { ?>
															<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($_SESSION["Cityfilter"] ) && $_SESSION["Cityfilter"])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
															}
														}
													} ?>
											</select>
											<!-- <input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>"> -->
										</div>
									</div>
								</div>
								<!--  <div class="col-md-6">
									<div class="form-group">
									<label for="spPostingCountry">Country</label>
									<input type="text" class="form-control" id="spPostingCountry" name="spPostingsCountry" value="<?php echo (isset($eCountry) ? $eCountry : $country); ?>">
									</div>
									</div>
									<div class="col-md-6">
									<div class="form-group">
									<label for="spPostingCity">Location/City</label>
									<input type="text" class="form-control" id="spPostingCity" name="spPostingsCity" value="<?php echo (isset($eCity) ? $eCity : $city); ?>">
									</div>
								</div> -->
								
							</div>
						</div>
						<div class="modal-footer">
							<input type="submit" value="Change" class="btn btn-primary" name="Change_Current_Location">
							<input type="submit" class="btn btn-danger" name="Closeresetlocation" value="Reset">
						</div>
					</form>
				</div>
				
			</div>
		</div>
		
		<div class="col-md-12" style="margin-top:10px;">
			
			<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
			<form  action="https://dev.thesharepage.com/job-board/">
				<div class="container whiteboardmain">
					<div class="row">
						
						<!--	<div class="col-md-2 topbread">
							<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="/job-board"  style="color:#1f3060;"><i class="fa fa-home"></i></a></li>    
							
							<li class="breadcrumb-item active" aria-current="page"><a href="/job-board/dashboard/" style="color:#31abe3;">Dashboard</a></li> 
							
							</ol>
						</div>  -->
						<div class="col-md-2" style=" width: 15.666667%  !important;">
							<input type = "date" id = "" name="fromdate" class="datepicker form-control" value="<?php echo $_GET['fromdate']; ?>" placeholder="Start Date">           
						</div>
						<!--   <div class="col-md-2">
							<input type = "text" id = "end-date" name="todate" class="datepicker form-control" value="<?php echo $_GET['todate']; ?>" placeholder="End Date">           
						</div> -->
						
						
						
						
						<script>
							$(function() {                   
								$("#start-date").datepicker({
									dateFormat: "dd/mm/yy",
									maxDate: 0,
									onSelect: function (date) {
										var dt2 = $('#end-date');
										var startDate = $(this).datepicker('getDate');
										var minDate = $(this).datepicker('getDate');
										if (dt2.datepicker('getDate') == null){
											dt2.datepicker('setDate', minDate);
										}              
										//dt2.datepicker('option', 'maxDate', '0');
										dt2.datepicker('option', 'minDate', minDate);
									}
								});
								$('#end-date').datepicker({
									dateFormat: "dd/mm/yy",
									maxDate: 0
								});           
							});
						</script>
						<div class="col-md-2" style=" width: 15.666667%  !important;">
							<select name="jobtype" class="form-control btn-secondary text-dark" style="color:black;">
								<option value="">Job type</option>
								<option <?php if($_GET['jobtype']=='Office'){ echo 'selected'; } ?> value="Office">Office</option>
								<option <?php if($_GET['jobtype']=='Remote'){ echo 'selected'; } ?> value="Remote">Remote</option>
							</select>
							
						</div>
						<div class="col-md-2" style=" width: 15.666667%  !important;">
							<select name="joblevel" class="form-control btn-secondary text-dark" style="color:black;">
								<option value="">Job Level </option>
								<?php
									$jl = new _spAllStoreForm;
									$result2 = $jl->readJobLevel();
									if($result2){
										while ($row2 = mysqli_fetch_assoc($result2)) {
										?>
										<option <?php if($_GET['joblevel']==$row2['jobLevelTitle']){ echo 'selected'; } ?> value="<?php echo $row2['jobLevelTitle']; ?>" <?php if(isset($jobLevel)){if($jobLevel == $row2["jobLevelTitle"]){ echo 'selected';}}?> ><?php echo $row2['jobLevelTitle']; ?></option>
										<?php
										}
									}
								?>
							</select>
							
						</div>
						
						<div class="col-md-2" style=" width: 15.666667%  !important;">
							<select name="salaryrange" class="form-control btn-secondary text-dark" style="color:black;">
								<option value="">Salary Range</option>
								<option <?php if($_GET['salaryrange']=='u100'){ echo 'selected'; } ?> value="u100">Under 100</option>
								<option <?php if($_GET['salaryrange']=='o100'){ echo 'selected'; } ?> value="o100">Over 100</option>
								<option <?php if($_GET['salaryrange']=='o500'){ echo 'selected'; } ?> value="o500">Over 500</option>
								<option <?php if($_GET['salaryrange']=='o1000'){ echo 'selected'; } ?> value="o1000">Over 1000</option>
							</select>
							
						</div>
						<!---<div class="col-md-2">
							<select name="salarytype" class="form-control btn-secondary text-dark" style="color:black;">
							<option>Salary Type</option>
							<option value="Hourly">Hourly</option>
							<option value="Monthly">Monthly</option>
							<option value="Yearly">Yearly</option>
							</select>
							
							</div>
							<div class="col-md-2">
							<select name="jobcategory" class="form-control btn-secondary text-dark" style="color:black;">
							<option>Job Category</option>
							<?php
								$m = new _subcategory;
								$catid = 2;
								$result = $m->read($catid);
								
								/*echo $m->ta->sql;*/
								if($result){
									while($rows = mysqli_fetch_assoc($result)){ ?>
									<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php if(isset($jobType)){if($jobType == $rows['subCategoryTitle']){echo "selected";}}?>><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>
									<?php
									}
								}
							?>
							</select>
							
							</div>
							<div class="col-md-2">
							<select class="form-control btn-secondary text-dark" style="color:black;">
							<option>Company</option>
							<option>aaaaaaaaaaa</option>
							<option>aaaaaaaaaaa</option>
							<option>aaaaaaaaaaa</option>
							</select>
							
						</div>--->
						<div class="col-md-1">
							<button type="submit" class="btn btnPosting db_btn " name="searchforstorebtn" style="background-color:#918b8b;">Filter</button>
						</div>
						<div class="col-md-1">
							<a href="/job-board/" class="btn btnPosting db_btn " style="background-color:#f60;">Reset</a>
						</div>
						
						<div class="col-md-2">
							<div style="float:right; margin-top: -10px;">
								<p >
									<?php
										
										$usercountry = $_SESSION["Countryfilter"];
										$userstate = $_SESSION["Statefilter"];
										$usercity = $_SESSION["Cityfilter"];
										
										$co = new _country;
										$result3 = $co->readCountry();
										if($result3 != false){
											while ($row3 = mysqli_fetch_assoc($result3)) {
												if(isset($usercountry) && $usercountry == $row3['country_id']){
													$currentcountry = $row3['country_title']; 
													$currentcountry_id = $row3['country_id']; 
													
												}
											}
										}
										
										if (isset($userstate) && $userstate > 0) {
											$countryId = $currentcountry_id;
											$pr = new _state;
											$result2 = $pr->readState($countryId);
											if($result2 != false){
												while ($row2 = mysqli_fetch_assoc($result2)) { 
													if(isset($userstate) && $userstate == $row2["state_id"] ){
														$currentstate_id = $row2["state_id"];
														$currentstate = $row2["state_title"];
													}
												}
											}
											}if (isset($usercity) && $usercity > 0) {
											$stateId = $currentstate_id;
											$co = new _city;
											$result3 = $co->readCity($stateId);
											//echo $co->ta->sql;
											if($result3 != false){
												while ($row3 = mysqli_fetch_assoc($result3)) { 
													if(isset($usercity) && $usercity == $row3['city_id']){
														$currentcity = $row3['city_title'];
														$currentcity_id = $row3['city_id'];
													}                                                                                               }                                                                                             }
										}                                                      
										;
									?>
									<?php
										if(!empty($currentcity)){
											echo $currentcity.', ';
										}
												if(!empty($currentstate)){
													$words = explode(' ', $currentstate); 
		                                        		$result = $words[0][0]. $words[1][0];
											echo ', '.$result;
										}
										
										if(!empty($currentcountry)){
											echo ', '.$currentcountry;
										}
								
										
									?>
								</p>
								<a href="#" style="cursor:pointer;" data-toggle="modal" data-target="#myModal">Change Location</a>
								
							</div>
						</div>
					</div>
				</div>
			</form>  
			
		</div>
		
        <section>
            <div class="container">
                <div class="row no-margin">
					
					<!--   <div class="left_btm_detail_job ">
						<h2><a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$clientId;?>">About Company</a></h2>
						<h4><?php echo $CmpnyName;?></h4>
						<p class="text-justify"><?php echo $CmpnyDesc;?></p>
						
					</div> -->
					
				</div>
				
				<div class="col-md-3">
					<div class="">
						
						
						
						
						<?php
							
							$usercountry = $_SESSION["Countryfilter"];
							$userstate = $_SESSION["Statefilter"];
							$usercity = $_SESSION["Cityfilter"];
							
							$co = new _country;
							$result3 = $co->readCountry();
							if($result3 != false){
								while ($row3 = mysqli_fetch_assoc($result3)) {
									if(isset($usercountry) && $usercountry == $row3['country_id']){
										$currentcountry = $row3['country_title']; 
										$currentcountry_id = $row3['country_id']; 
										
									}
								}
							}
							
							if (isset($userstate) && $userstate > 0) {
								$countryId = $currentcountry_id;
								$pr = new _state;
								$result2 = $pr->readState($countryId);
								if($result2 != false){
									while ($row2 = mysqli_fetch_assoc($result2)) { 
										if(isset($userstate) && $userstate == $row2["state_id"] ){
											$currentstate_id = $row2["state_id"];
											$currentstate = $row2["state_title"];
										}
									}
								}
								}if (isset($usercity) && $usercity > 0) {
								$stateId = $currentstate_id;
								$co = new _city;
								$result3 = $co->readCity($stateId);
								//echo $co->ta->sql;
								if($result3 != false){
									while ($row3 = mysqli_fetch_assoc($result3)) { 
										if(isset($usercity) && $usercity == $row3['city_id']){
											$currentcity = $row3['city_title'];
											$currentcity_id = $row3['city_id'];
										}                                                                                               }                                                                                             }
							}                                                      
							;
						?>	
						<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
						
						<div class="right_detail_job" id="">
							<div class="job-descrip-block">
								<p style="color: #31ace3;">
									<?php echo "Similar Jobs <br>"; 
										if(!empty($currentcity)){
										echo "In ";
											echo $currentcity;
										}
										if(!empty($currentstate)){
											$words = explode(' ', $currentstate); 
                                    		$result = $words[0][0]. $words[1][0];
											echo ', '.$result;
										}
										if(!empty($currentcountry)){
											echo ', '.$currentcountry;
										}
										
										
									?>
								</p>
							</div>
							
							<div class="row">
								
								
								
								<?php
									$joblevelfilter = "";
									$jobtypefilter = "";
									$startenddate = "";
									$salaryrangefilter = "";
									$Countryfilter = "";
									$Statefilter = "";
									$Cityfilter = "";
									$limit = "100";
									/*$p   = new _postingview;*/
								$p   = new _jobpostings;
								$pf  = new _postfield;
								if(isset($_SESSION['Countryfilter'])){
								if(!empty($_SESSION['Countryfilter'])){
								$ccff = $_SESSION['Countryfilter'];
								$Countryfilter = "AND spPostingsCountry = $ccff" ;
								}
								}
								
								if(isset($_SESSION['Statefilter'])){
								if(!empty($_SESSION['Statefilter'])){
								$ssf = $_SESSION['Statefilter'];
								$Statefilter = "AND spPostingsState = $ssf" ;
								}
								}
								
								if(isset($_SESSION['Cityfilter'])){
								if(!empty($_SESSION['Cityfilter'])){
								$ciicff = $_SESSION['Cityfilter'];
								$Cityfilter = "AND spPostingsCity = $ciicff" ;
								}
								}
								
								//echo $jobTypennnn; die('===============');
								
								$res = $p->publicpost_jobBoardwithfilterfordetailspage($limit, $jobTypennnn, $startenddate, $jobtypefilter, $joblevelfilter, $salaryrangefilter, $Countryfilter, $Statefilter, $Cityfilter);
								//echo $p->ta->sql; die('pppppppppppoooooo');
								
								//$res = $p->publicpost_jobBoard($limit, 2);
								
								
								
								
								//echo $p->ta->sql;
								if($res){
								$bb = 1;
								while ($row = mysqli_fetch_assoc($res)) {
								//print_r($row);
								?>
								
								<div onclick="location.href='<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>'" class="col-md-12" style="border: 1px solid gainsboro;padding: 10px;margin-bottom: 30px;border-radius: 10px; cursor: pointer;">
								<small style="color:red;">NEW</small>	
								<h2 style="font-weight: bold;color: #1f3060;"><?php echo ucfirst($row['spPostingTitle']);?></h2>
								<p>
								<?php
								$string = strip_tags($row['spPostingNotes']);
								if (strlen($string) > 200) {
								
								// truncate string
								$stringCut = substr($string, 0, 200);
								$endPoint = strrpos($stringCut, ' ');
								
								//if the string doesn't contain any space then it will cut without word basis.
								$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
								$string .= '... <a href='.$BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'].'>Read More</a>';
								}
								
								?>
								<?php echo ucfirst($string); ?>
								</p>
								<p><?php echo ucfirst($row["spPostingLocation"]);?></p>
								<p><?php if($row['spPostingSlryRngFrm']>0){echo $row['job_currency'].' '.$row['spPostingSlryRngFrm'].' - '. $row['job_currency'].' '.$row['spPostingSlryRngTo'].'';} ?></p>
								
								<h2 style="font-weight: bold;color: #1f3060;">Skills Required</h2>
								
								<ul>
								<?php
								$skills=explode(',',$row['spPostingSkill']);
								foreach ($skills as $key => $value) {
								?>
								
								<li><?php echo ucfirst($value); ?></li>
								
								<?php
								} ?>
								</ul>
								<?php $dt = new DateTime($row['spPostingDate']); echo $dt->format('d M Y') ?>	
								</div>
								<?php
								if($bb==5){
								break;
								}
								$bb++;	}
								}
								?>
								<!--<div class="col-md-12" style="border: 1px solid gainsboro;padding: 10px;margin-bottom: 30px;border-radius: 10px;">
								<small style="color:red;">NEW</small>	
								<h2 style="color:black;">site manager</h2>
								<p>whitecap RSC Medical</p>
								<p>Vancouver, BC</p>
								<h2 style="color:black;">$31 - $37 an hour</h2>
								
								<i class='fa fa-arrow-right' style='font-size: 27px;color: #5f6af7;'></i> <span style=" font-size: 20px; ">Easily Apply</span>
								
								<ul>
								<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
								<li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li>
								</ul>
								Today	
								</div>--->
								
								
								
								
								
								
								
								</div>
								</div>
								
								</div>
								
								</div>
								
								<div class="col-md-6">
								<div class="" id="printArea" >
								<div class="right_detail_job first" id="">
								<div class="job-descrip-block">
								<h1 style="color: #1f3060;"><b><?php echo ucfirst($title);?></b></h1>
								<h2>Job Description</h2>
								<p><?php echo $overview;?></p>
								</div>
								
								<h2>Job Details</h2>
								<div class="row">
								<div class="col-md-12">
								<div class="table-responsive">
								<table class="table table-striped job-table">
								<tbody>
								<tr>
								<td>Company Name</td>
								<td>
								<a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$clientId;?>" style="color:#31ace3;"><?php echo $CmpnyName; ?></a>
								</td>
								</tr>
								<tr>
								<td>Company Size: </td>
								<td><?php echo $CmpSize; ?></td>
								</tr>
								<tr>
								<td>Total Positions:  </td>
								<td><?php echo ($noOfPos > 0)?$noOfPos:'Not Define'; ?></td>
								</tr>
								<!-- <tr>
								<td>How to apply: </td>
								<td><?php echo $howAply;?></td>
								</tr> -->
								<tr>
								<td>Job Type: </td>
								<td><?php echo ($jobType == '')?'Not Define': $jobType; ?></td>
								</tr>
								<tr>
								<td>Job Level: </td>
								<td><?php echo $jobLevel; ?></td>
								</tr>
								<tr>
								<td>Salary: </td>
								<td><?php echo $salaryyy; ?></td>
								</tr>
								<tr>
								<td>Closing Date: </td>
								<td><?php echo $CloseDate; ?></td>
								</tr>
								<tr>
								<td>Min Experience: </td>
								<td><?php echo ($Experience == '')?'Not Define': $Experience.' Years '; ?></td>
								</tr>
								<tr>
								<td>Location: </td>
								
								<?php
								$res88 = $p->readtblCity($location);
								$tbl_city3 = mysqli_fetch_assoc($res88);
								$tbl_city4 =	$tbl_city3['city_title'];
								?>
								
								<td><?php echo ($tbl_city4 == '')?'Not Define':$tbl_city4;?></td>
								</tr>
								</tbody>
								</table>
								</div>
								</div>
								
								</div>
								</div>
								</div>
								<!--  <div class="m_btm_10">
								<?php
								if($_SESSION['ptid'] == 5){
								if($_SESSION['uid'] != $postedPerson){
								$ac = new _sppost_has_spprofile;
								$chkAplyPost = $ac->myapplyJobs($_SESSION['pid'], $_GET["postid"]);
								//echo $ac->ta->sql;
								if($chkAplyPost != false){ ?>
								<a href="javascript:void(0);" class="btn create_add no-radius" disabled >Already Applied</a><?php
								}else{
								?>
								<a href="#" class="btn create_add no-radius"  data-toggle='modal' data-target='#coverletter' id='applybtn' >APPLY NOW</a> <?php
								}
								}
								}
								?>
								</div> -->
								</div>
								<!--    <div class="right_detail_job">
								<div class="title_job">
								<h2>Similar Jobs on TSP- Job Board</h2>
								<div class="space"></div>
								<div class="row">
								<?php
								
								$limit = 4;
								$p   = new _jobpostings;
								$pf  = new _postfield;
								$res = $p->publicpost_jobBoard($limit, 2);
								//echo $p->ta->sql;
								if($res){
								while ($row = mysqli_fetch_assoc($res)) { ?>
								<div class="col-md-12">
								<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo ucfirst($row['spPostingTitle']);?></a>
								<p>
								<?php
								if(strlen($row['spPostingNotes']) < 400){
								echo $row['spPostingNotes'];
								}else{
								echo substr($row['spPostingNotes'], 0,400);
								
								} ?>
								<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="readmore">...Read More</a>
								</p>
								</div>
								<?php
								}
								}
								?>
								</div>
								</div>
								</div> -->
								
								<div class="col-md-3 no-padding">
								<div class="left_detail_job right_job_detail">
								
								
								<div class="left_detail_job">
								<p>  <?php echo $jobType;?></p>
								<p><i class="fa fa-clock-o"></i> Level : &nbsp;<?php echo $jobLevel;?></p>
								
								<?php
								$res99 = $p->readtblCity($location);
								$tbl_city2 = mysqli_fetch_assoc($res99);
								$tbl_city3 =	$tbl_city2['city_title'];
								?>
								
								<p><i class="fa fa-map-marker"></i> Location : &nbsp;&nbsp;<?php echo $tbl_city3;?></p>
								<h3 style="margin-bottom: -5px;">Skills :</h3>
								<ul class="skills-list">
								<?php
								if($skill != ''){
								if(count($skill) >0){
								foreach($skill as $key => $value){
								if($value != ''){
								echo "<li><i class='fa fa-tag'></i> ".$value."</li>";
								}
								
								}
								}
								}
								
								?>
								
								</ul>
								<!-- <h3>Share With:</h3>
								<div class="social_share_job">
								<a href=""><i class="fa fa-facebook"></i></a>
								<a href=""><i class="fa fa-twitter"></i></a>
								<a href=""><i class="fa fa-linkedin"></i></a>
								</div> -->
								<div class="space-lg"></div>
								<div id="Notabussiness" class="modal fade" role="dialog">
								<div class="modal-dialog" style="text-align: center;">
								
								<!-- Modal content-->
								<div class="modal-content no-radius sharestorepos bradius-10">
								<div class="modal-header br_radius_top bg-white">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								
								</div>
								<div class="modal-body nobusinessProfile">
								<h1><i class="fa fa-info" style="color:red;" aria-hidden="true"></i></h1>
								<h2>Only EMPLOYMENT profile can apply to a job, Please create or switch to your Employment to apply to a job.</h2>
								<!-- <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn" style = "background: #31abe3!important;">Switch/Create Profile</a> -->
								<a href="<?php echo $BaseUrl.'/my-profile';?>"><div class="box">Switch Profile/Create Profile</div></a>
								
								</div>
								<div class="modal-footer br_radius_bottom bg-white">
								<button type="button" style="background: #31abe3!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>
								</div>
								</div>
								
								</div>
								</div>
								<?php
								
								$p= new _spprofiles;
								$users=mysqli_fetch_assoc($p->read($clientId));
								
								/*print_r($_SESSION);*/
								if($_SESSION['uid']!=$users['spUser_idspUser'])
								{
								if($_SESSION['ptid'] == 5){
								if($_SESSION['uid'] != $postedPerson){
								$ac = new _sppost_has_spprofile;
								$chkAplyPost = $ac->myapplyJobs($_SESSION['pid'], $_GET["postid"]);
								//echo $ac->ta->sql;
								if($chkAplyPost != false){ ?>
								<a href="javascript:void(0);" class="btn create_add no-radius" disabled style="width: 100%;background-color: #1f3060!important;border:0px!important;" >Already Applied</a><?php
								}else{
								
								?>
								<a href="#" class="btn create_add no-radius" style="width: 100%;background-color: #1f3060!important;border:0px!important;" data-toggle='modal' data-target='#coverletter' id='applybtn' >APPLY NOW</a> <?php
								
								
								}
								}
								}
								else
								{        ?>
								<a href="" class="btn create_add no-radius"  style="margin-bottom: 15px;width: 100%;background-color: #1f3060!important;border:0px!important;" data-toggle="modal" data-target="#Notabussiness" >APPLY NOW</a>
								
								<?php }
								
								} ?>
								
								<br>
								<h3 style="margin-top:12px">Actions:</h3>
								<?php
								$sj = new _save_job;
								$result2 = $sj->chekJobSave($_GET['postid'], $_SESSION['pid']);
								if($result2){
								if($result2->num_rows > 0){
								$row2 = mysqli_fetch_assoc($result2);
								?>
								<a href="<?php echo $BaseUrl.'/job-board/savejob.php?unsave='.$row2['save_id'];?>"><p>Unsave</p></a> <?php
								}else{ ?>
								<a href="<?php echo $BaseUrl.'/job-board/savejob.php?postid='.$_GET['postid'];?>"><p>Save</p></a> <?php
								}
								}else{ ?>
								<a href="<?php echo $BaseUrl.'/job-board/savejob.php?postid='.$_GET['postid'];?>"><p>Save</p></a> <?php
								}
								
								?>
								<?php
								if($_SESSION['ptid'] !=5)
								{
								?>
								<a href="" data-toggle="modal" data-target="#fwdjob"><p>Forward</p></a>
								
								<?php
								}
								?>
								
								<a href="" onclick="printContent('printArea')"><p>Print</p></a>
								<a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$clientId;?>"><p>View Company Detail</p></a>
								<a href="<?php echo $BaseUrl.'/job-board/company.php?cmpyid='.$clientId.'&job=posted';?>"><p>View all jobs</p></a>
								<?php
								if ($_SESSION['pid'] != $clientId ) {
								?>
								<a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" ><p>Flag This Job</p></a>
								<?php
								}
								?>
								
								<!-- Modal -->
								<div id="flagPost" class="modal fade" role="dialog">
								<div class="modal-dialog">
								<!-- Modal content-->
								<form method="post" action="addtoflag.php" id="flagpost_frm"  class="sharestorepos">
								<div class="modal-content no-radius">
								<input type="hidden" name="spPosting_idspPosting" value="<?php echo $_GET['postid'];?>">
								<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
								<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Flag Post</h4>
								</div>
								<div class="modal-body">
								<div class="radio">
								<label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
								</div>
								<div class="radio">
								<label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
								</div>
								<div class="radio">
								<label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
								</div>
								<div class="radio">
								<label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
								</div>
								
								<!-- <label>Why flag this post?</label> -->
								<textarea class="form-control" name="flag_desc" id="flag_desc" placeholder="Add Comments"></textarea>
								
								<span id="fdesc_err" style="color: red;"></span>
								</div>
								<div class="modal-footer">
								<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
								<input type="button" name="" id="flag_sub" class="btn btn-submit" value="Flag Now" >
								
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
								</section>
								
								<!-- Modal -->
								<div id="fwdjob" class="modal fade" role="dialog">
								<div class="modal-dialog sharestorepos">
								<!-- Modal content-->
								<div class="modal-content no-radius">
								<form method="post" action="sendEmail.php" id="frd_frm">
								<input type="hidden" value="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$_GET['postid'];?>" name="txtlink" />
								<input type="hidden" value="<?php echo $_GET['postid'];?>" name="postid" />
								<input type="hidden" value="<?php echo $_SESSION['pid'];?>" name="sender_id" />
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Job Forward</h4>
								</div>
								<div class="modal-body">
								<div class="form-group">
								<label>Enter Email</label>
								
								<input type="email" name="txtemail" class="form-control" />
								<p style="text-align: center;">Or</p>
								<label for="">Select Friend</label>
								
								<select class="mySelect form-control" name="txtFriend[]" multiple style="width:100%;">
								<option value="" disabled>Select Friends</option>
								<?php
								$f = new _spprofilehasprofile;
								$p= new _spprofiles;
								
								$myFrndList=$f->readallfriend($_SESSION['pid']);
								
								if($myFrndList){
								while($rows = mysqli_fetch_assoc($myFrndList)){
								$profile=$p->read($rows['spProfiles_idspProfilesReceiver']);
								$profile = mysqli_fetch_assoc($profile);
								?>
								<option value="<?php echo $profile['idspProfiles']; ?>"><?php echo $profile['spProfileName']; ?></option>
								
								<?php
								}
								
								} ?>
								
								</select>
								
								
								<span id="email_err" style="color: red;"></span>
								</div>
								<div class="form-group">
								<label>Enter Message</label>
								<textarea name="txtmsg" rows="4" cols="40" class="form-control" >
								I am sharing a job from TheSharePage.com that I thought may be of interest to you.
								</textarea>
								<!-- <input type="email" name="txtemail"  id="txtemail" class="form-control" list="friendname" /> -->
								
								</div>
								</div>
								<div class="modal-footer">
								<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
								<button type="button" class="btn btn-submit" style='background-color: #31abe3!important;border:0px!important;    color: #fff;background-image: unset;
								' id="sub_email" >Forward</button>
								</div>
								</form>
								</div>
								</div>
								</div>
								
								<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>
								<script type="text/javascript">
								
								$(document).ready(function(){
								$(".mySelect").select2();
								/*flag validate*/
								$("#flag_sub").click(function(){
								
								
								
								
								var desc = $("#flag_desc").val();
								//alert(desc);
								
								if (desc == "" ) {
								
								$("#fdesc_err").text("Please Enter Description.");
								
								return false;
								
								}else{
								$("#flagpost_frm").submit();
								}
								
								
								
								});
								
								/*Forward validate*/
								
								
								$("#sub_email").click(function(){
								
								
								var txtemail = $("#txtemail").val();
								//alert(desc);
								
								if (txtemail == "" ) {
								
								$("#email_err").text("Please Enter Email.");
								
								return false;
								
								}else{
								$("#frd_frm").submit();
								}
								
								
								
								});
								
								
								
								
								
								
								
								});
								
								
								</script>
								
								<?php
								include("coverletter.php");
								
								include('../component/f_footer.php');
								include('../component/f_btm_script.php');
								?>
								</body>
								</html>
								<?php
								}
								?>
																