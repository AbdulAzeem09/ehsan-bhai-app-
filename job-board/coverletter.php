
<div class="modal fade" id="coverletter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
	<div class="modal-dialog sharestorepos" role="document" >
	    <div class="modal-content no-radius">
	    	<form  action="<?php echo $BaseUrl; ?>/my-activity/jobapply.php" method="post" id="sub_resume" enctype="multipart/form-data">
	    	<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Apply Now</h4>
            </div>

	      	<div class="modal-body" style="background-color:white;">
	      		<span id="ltr_err" style="color: red;"></span>
				<textarea rows="10" name="coverletter" class="form-control no-radius" id="letter" placeholder="Write cover letter"></textarea>
				<label>Upload Resume</label>
				<input type="file" id="resume" name="resume" style="display: block;">
				<span id="res_err" style="color: red;"></span>
	      	</div>
			<div class="modal-footer" style="background-color:white;">
				<div class="row">

					
				 	<div class='col-md-4'>
					<!--<?php
						echo "<div class='dropdown'>";
						echo "<button class='btn btn-default dropdown-toggle' type='button' id='' data-toggle='dropdown' aria-haspopup='true' aria-expanded='true' style='float: left'><span id='applyjob'></span><span class='caret'></span></button>";
						echo "<ul class='dropdown-menu' aria-labelledby='dropdownMenu1' style='margin-top:40px;'>";
							
							$pc = new _postingalbum;
							$result = $pc->getProfileResume($_SESSION['pid']);
							if ($result != false){
								while($rows = mysqli_fetch_assoc($result)){
									echo "<li><a href='#' class='resumes' data-resumeid='".$rows["idspPostingMedia"]."'>".$rows["sppostingmediaTitle"]."</a></li>";
								}
							}else{
								echo "<li role='separator' class='divider'></li>";
								$profile = new _spprofiles;
								$rs = $profile->readjobseeker($_SESSION["uid"]);
								if($rs != false){
									$row = mysqli_fetch_assoc($rs);
									echo "<li><a href='".$BaseUrl."/job-board/dashboard/cv-manager.php'>Add Resume</a></li>";
								}else{
									echo "<li><a href='".$BaseUrl."/my-profile/?back=back'>Create Jobseeker Profile</a></li>";
								}
							}
							
						echo "</ul>";
						echo "</div>";
					?>-->
					<input type="hidden" name="postid" value="<?php echo  $_REQUEST["postid"]; ?>">
					<input type="hidden" name="categoryid" value="2">
					<input type="hidden" name="clientid" value="<?php echo $clientId; ?>">
					
					
					<input type="hidden" name="activitydate" value="<?php echo date("Y-m-d") ?>">
					</div> 
					<div class="col-md-8">
						<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>&nbsp;
						<?php
							/*echo "<button type='button' class='btn btn-submit jobapply' id='jopapp' data-postid='".$_REQUEST["postid"]."' data-categoryid='2' data-activitydate='".date("Y-m-d")."'   data-closingdate='' data-resumeid='' data-toggle='modal' data-target='#coverletter'>Apply</button>";*/

							echo "<button type='button' style='background-color: #31abe3!important;border:0px!important;    color: #fff;background-image: unset;
' class='btn btn-submit' id='jopapp' data-postid='".$_REQUEST["postid"]."' data-categoryid='2' data-activitydate='".date("Y-m-d")."'   data-closingdate='' data-resumeid='' data-toggle='modal' data-target='#coverletter'>Apply</button>";
						?>
					</div>

				</form>


				</div>
			</div>
	    </div>
	</div>
</div>

<script type="text/javascript">
 
 $(document).ready(function(){
  $("#jopapp").click(function(){


  /*	alert();*/

  	var desc = $("#letter").val();

if (desc == "" && $('#resume').get(0).files.length === 0) {
   
    $("#ltr_err").text("Please Enter cover letter.");
     $("#res_err").text("Please Upload resume.");
     return false;

}else if (desc == "") {
   
    $("#ltr_err").text("Please Enter cover letter.");
    $("#res_err").text("");
    return false;

}else if ($('#resume').get(0).files.length === 0) {
	$("#ltr_err").text("");
    $("#res_err").text("Please Upload resume.");
    return false;

}else{
        $("#sub_resume").submit();
}


    
  });
});	


</script>