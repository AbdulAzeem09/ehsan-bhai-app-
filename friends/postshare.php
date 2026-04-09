
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
                <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/custom.css">

<div class="modal fade" id="myshare1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
<div class="modal-content no-radius bradius-15 bg-white">
			<form action="../social/share-timeline.php" method="POST" class="sharestorepos">
				<div class="modal-header br_radius_top bg-white ">
					<h4 class="modal-title">Share Post</h4>
					
				</div>
				
			 	<div class="modal-body sharedimage">
			 		<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
					<input type="hidden" id="shareposting" name="spPostings_idspPostings">
					<div class="row">
						<!-- <div class="col-md-4">
							<div class="dropdown">
							  	<button class="btn btn-default dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									Select group or friend
									<span class="caret"></span>
							  	</button>
							  	<ul class="dropdown-menu" aria-labelledby="dropdownShare">
									<li id="groupshare" class="sppointer sharedd"><a href="#">Share in a group</a></li>
									
									<li id="friendshare" class="sppointer sharedd"><a href="#">Share to a friend</a></li>
							  	</ul>
							</div>
						</div> -->
						<div class="col-md-12" id="">
							<div class="form-group">
								<label>Select Group</label>
								<input type="hidden" class="form-control" id="spgroupshareid" name="spShareToGroup">
								<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
							</div>
						</div>
							
							
						<div class="col-md-5 hidden" id="profileshow">
							<div class="form-group">
								<input type="hidden" id="spfriendshareid" name="spShareToWhom">
								<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Say something about this</label>
								<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
							</div>
						</div>
							
					</div>
					
			  	</div>
<div class="modal-footer br_radius_bottom bg-white">
					<button type=""  class="btn btn-danger db_btn db_orangebtn" data-dismiss="modal">Close5</button>
					<button type="submit" id="share" name="btnshare" class="btn btn-primary db_btn db_primarybtn">Share</button>
			  	</div>
			</form>
		</div>
	</div>
</div>