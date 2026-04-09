<div class="modal fade" id="coverletter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header coverlet" style="background-color:#FFEBCD;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-title" id="myModalLabel">
			<p style="font-size:20px;font-weight:bold;"><?php echo $company;?></p>
			<p><?php echo $productname;?></p>
		</div>
      </div>
      <div class="modal-body" style="background-color:white;">
			<textarea rows="25" class="form-control" id="letter" placeholder="Write cover letter"></textarea>
      </div>
		<div class="modal-footer" style="background-color:white;">
			<div class="row">
				<div class='col-md-8'>
				<?php
					echo "<div class='dropdown'>";
					  echo "<button class='btn btn-default dropdown-toggle' type='button' id='' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true' style='float: left'><span id='applyjob'></span><span class='caret'></span></button>";
					 
					 echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1' style='margin-top:40px;'>";
						$postId = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;
						$pc = new _postingalbum;
						$result = $pc->profileresume($_SESSION['uid']);
						if ($result != false)
						{
							while($rows = mysqli_fetch_assoc($result))
							{
								echo "<li><a href='#' class='resumes' data-resumeid='".$rows["idspPostingMedia"]."'>".$rows["sppostingmediaTitle"]."</a></li>";
							}
						}
						else
						{
							echo "<li role='separator' class='divider'></li>";
							$profile = new _spprofiles;
							$rs = $profile->readjobseeker($_SESSION["uid"]);
							if($rs != false)
							{
								$row = mysqli_fetch_assoc($rs);
								echo "<li><a href='../my-posts/?back=back'>Add Resume</a></li>";
							}
							else
								echo "<li><a href='../my-profile/?back=back'>Create Jobseeker Profile</a></li>";
						}
						
					  echo "</ul>";
					echo "</div>";
				?>
				</div>
				<div class="col-md-4">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;
					<?php
						echo "<button type='button' class='btn btn-success jobapply' id='jopapp' data-postid='".$postId."' data-categoryid='".$catid."' data-activitydate='".date("Y-m-d")."'   data-closingdate='".$closingdate."' data-resumeid='' data-toggle='modal' data-target='#coverletter'>Apply</button>";
					?>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>
