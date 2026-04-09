<?php
$page = 'apply&preview'; // Set the page variable

include_once("../views/common/header.php");
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "job-board/";
	include_once("../authentication/check.php");
}else{
	function sp_autoloader($class){
	include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$cmpyid = isset($_GET["cmpyid"]) ? (int) $_GET["cmpyid"] : 0;
	$p =  new _spprofiles;
    $result = $p->read($cmpyid);
	$result = mysqli_fetch_assoc($result);

	$fi = new _spbusiness_profile;
    $result_fi = $fi->read($cmpyid);
	$result_fi = mysqli_fetch_assoc($result_fi);
	//print_r($result);
?>
<style>
	.company_profile .nav-link{
		color: #3E2048;
	}
	.company_profile a.nav-link.active{
		background-color: #3E2048;
		color: #fff
	}
	.company_profile div.tab-pane {
		margin: 0px;
		padding: 0px;
		padding-top:10px;
	}
	.company_profile img{
		border: 4px solid #33b0e5;
	}
	.company_profile .nav-tabs{
		margin-top:20px;
	}
	.company_profile a{
		color:#000;
		text-decoration: none;
	}
</style>

          <div class='body-wrapper company_profile'>
              <div class='job-wrapper'>
				  <div class='job-body-wrapper'>
						<div class="row">
							<div class="col-md-2 d-inline-flex">
								<img src='<?= $result['spProfilePic'] ?>' width='105px'>
							</div>
							<div class="col-md-10">
								<h3><?= $result_fi['companyname'] ?></h3>
								<p><?= $result_fi['spProfilesAboutStore'] ?></p>
								<span style='border: 1px solid #b7b7b7;background-color: #f6f6f6;padding: 2px 8px;'><?= $result_fi['skill'] ?></span>
                            </div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<ul class="nav nav-tabs">
									<li class="nav-item">
										<a class="nav-link <?= !isset($_REQUEST['job']) ? 'active' : '' ?>" data-bs-toggle="tab" href="#company-overview">Company Overview </a>
									</li> 
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#business-overview">Business Overview</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?= isset($_REQUEST['job']) ? 'active' : '' ?>" data-bs-toggle="tab" href="#job-posted">Job Posted</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#news">News</a>
									</li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane container <?= !isset($_REQUEST['job']) ? 'active' : '' ?>" id="company-overview">
										<h5>Company Overview</h5>
										<p><?= $result_fi['spProfilesAboutStore'] ?></p>
									</div>
									<div class="tab-pane container fade" id="business-overview">
										<h5>Business Overview</h5>
										<p><?= $result_fi['BussinessOverview'] ?></p>
									</div>
									<div class="tab-pane container  <?= isset($_REQUEST['job']) ? 'active' : '' ?>" id="job-posted">
										<h5>Job Posted</h5>
										<table id="example" class="display" style="width:100%">
											<thead>
												<tr>
													<th>Job Title</th>
													<th>Date Posted	</th>
												</tr>
											</thead>
										</table> 
									</div>
									<div class="tab-pane container fade" id="news">
										<h5>News</h5>
										<table id="newstable" class="display" style="width:100%">
											<thead>
												<tr>
													<th>&nbsp;</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
				  </div>
              </div>
		  </div>

        </div>
    <?php include "../views/common/footer.php"; ?>
	<script>
		$(document).ready(function() {
			$('#example').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": { 
					"url": "../ssp/job-board/active-jobs.php?id=<?= $cmpyid ?>",  // Ensure this points to your PHP file
					"type": "POST"
				},
				"columns": [
					{ "data": "0" }, // ID
					{ "data": "1" }, 
				],
				"createdRow": function(row, data, dataIndex) {
					// Find the last 'td' and add a class to it
					$('td:last', row).addClass('action');
				},
				"language": {
					"infoFiltered": "" // Remove the "(filtered from X total entries)" part
				}
			});
		
		});


		$(document).ready(function() {
			$('#newstable').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": { 
					"url": "../ssp/job-board/company_news.php?id=<?= $cmpyid ?>",  // Ensure this points to your PHP file
					"type": "POST"
				},
				"columns": [
					{ "data": "0" }, 
				],
				
				"language": {
					"infoFiltered": "" // Remove the "(filtered from X total entries)" part
				}
			});
		
		});
		
	</script>
 </body>
</html>
<?php } ?>