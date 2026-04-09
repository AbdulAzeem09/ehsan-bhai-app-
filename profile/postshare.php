	

	<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content no-radius bradius-15 bg-white">
				<form action="share.php" method="POST" class="sharestorepos">
					<div class="modal-header br_radius_top bg-white">
						<h4 class="modal-title">Share Post</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				 	<div class="modal-body sharedimage">
				 		<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
						<input type="hidden" id="shareposting" name="spPostings_idspPostings">
						<div class="row">
							
							<div class="col-md-12" id="">
								<div class="">
									<input type="hidden" class="form-control" id="spgroupshareid" name="spShareToGroup">
									<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
								</div>
							</div>
								
								
							<div class="col-md-6 hidden" id="profileshow">
								<div class="">
									<input type="hidden" id="spfriendshareid" name="spShareToWhom">
									<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
								</div>
							</div>
							<div class="col-md-12">
								<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
							</div>
						</div>
					<!-- 	<div class="row">
							<div class="col-md-offset-3 col-md-6">
								<img id="modalpostingpic" src="../img/no.png" alt="Posting Pic" class="img-rounded img-thumbnail" />
							</div>
						</div> -->
				  	</div>
				  	<div class="modal-footer br_radius_bottom bg-white">
						<button type="" class="btn btn-default db_btn db_orangebtn btn-border-radius" data-dismiss="modal">Cancel</button>
						<button type="submit" id="share" class="btn btn-primary db_btn db_primarybtn btn-border-radius">Share</button>
					</div>
				</form>
			</div>
		</div>
	</div>