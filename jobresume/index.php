<!DOCTYPE html>
<html lang="en">
<head>
	<title>SharePage.com</title>
	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/jquery-ui.min.css">
	<link rel="stylesheet" href="/css/font-awesome.min.css"> 
	<link rel="stylesheet" href="/css/home.css"> 
	<script src="/js/jquery-2.1.4.min.js"></script>
	<script src="/js/jquery-1.11.4-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/home.js"></script>
	<script src="/js/gdocsviewer.min.js"></script>
</head>
	<body>
		<?php 
			session_start(); 
			function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
			include_once("../header.php");
		?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1">
				<?php
						include_once("../categorysidebar.php");
					?>
			</div>
			
			<div class="col-md-10 previewdoc">
				<!--Job Description Code-->
				<div class="jobdetails">
					<div style="padding:20px;">
					<?php 
						$m = new  _postingview;
						$result = $m->read($_GET["jobid"]);
						if($result != false)
						{
							while($rows = mysqli_fetch_assoc($result))
							{
								echo "<h3 style='color:green;'>".$rows["spPostingtitle"]."</h3>";
								echo $rows["spPostingNotes"];
							}
						}
					?>
					</div>
				</div>
				<!--Complete-->
				<!--Total Applicants-->
				<br><div class="jobdetails">
					<div style="padding:20px;" class="dashboard-container">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th>Applicants</th>
									<th>Cover Letter</th>
									<th>Date</th>
									<th>Time</th>
									<th>CV Preview</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$ac = new _sppost_has_spprofile;
								$result = $ac->job($_GET["jobid"]);
								if($result != false)
								{
									while($row = mysqli_fetch_assoc($result))
									{
										$dt = new datetime($row["spActivityDate"]);
										$time =$dt->format("h:i:s"); 
										$date =$dt->format("Y-m-d"); 
										
										//About Resume
										$pc = new _postingalbum;
										$res = $pc->resume($row["sppostingResume"]);
										if ($res != false)
										{
											$rw = mysqli_fetch_assoc($res);
											$title = $rw["sppostingmediaTitle"];
											$resume = $rw["spPostingMedia"];
											
											$previewfile =$rw["sppostingmediaTitle"].$rw['idspPostingMedia'].".".$rw['sppostingmediaExt']."";
										}
										
										
										echo "<tr class='rselection'>";
											echo "<td width='19%'><img  alt='profile-Pic' class='img-rounded' style='width:50px; height:50px;' src=' ".($row['spProfilePic'])."' ><span class='jobseeker'>".$row["spProfileName"]."</span><p style='margin-left:65px;'>".$row["spProfileAbout"]."</p></td>";
											
											echo "<td width='50%'>".$row["sppostingscoverletter"]."</td>";
											
											echo "<td width='7%'>".$date."</td>";
											echo "<td width='5%'>".$time."</td>";
											
											//Testing
											echo "<td width='7%'><button type='button' class='btn btn-link preview pull-right' data-toggle='modal' data-target='#previewresume' data-src='http://dev.thesharepage.com/resume/".$previewfile."' data-filetitle='".$rw['sppostingmediaTitle']."'><span class='glyphicon glyphicon-search'></span> Preview</button></td>";
											
											echo "<td width='1%'><a href='http://dev.thesharepage.com/resume/".$previewfile."' type='button' class='btn btn-link' ata-toggle='tooltip' data-placement='left' title='Download'><span class='glyphicon glyphicon-download'></span></a></td>";
											
											echo "<td width='2%'><span class='glyphicon glyphicon-flag rselect ".($row["spSelectResume"] == 1?"deselect":"resumeselect")."' data-resumeid='".$row["sppostingResume"]."' data-postid='".$row["spPostings_idspPostings"]."' data-profileid='".$row["spProfiles_idspProfiles"]."' style='".($row["spSelectResume"] == 1?"color:#ea7831;":"color:gray;")."' data-toggle='tooltip' data-placement='bottom' title='".($row["spSelectResume"] == 1?"Discard":"Select")."'></span></td>";
										echo "</tr>";
									}
								}
								include("cvpreview.php");
							?>
							</tbody>
						</table>
					</div>
				</div>
				<!--Total Applicants Complete-->
			</div>
			
			<div class="col-md-1">
				<?php
					include_once("../sidebar.php");
				?>
			</div>
		</div>
	</div><!--container-->
</body>
</html>