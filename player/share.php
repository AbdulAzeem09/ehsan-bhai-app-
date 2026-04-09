<!--modal-->
<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<form action="../social/share.php" method="POST">
					<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
					<input type="hidden" id="shareposting" name="spPostings_idspPostings">
					<div class="row">
						<div class="col-md-4">
							<div class="dropdown">
							  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								Select group or friend 
								<span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" aria-labelledby="dropdownShare">
									<li id="groupshare" class="sppointer">Share in a group</li>
									<li id="friendshare" class="sppointer">Share to a friend</li>
							  </ul>
							</div>
						</div>
							<div class="col-md-5  hidden" id="groupshow">
								<div class="input-group">
									<input type="hidden" class="form-control" id="spgroupshareid" name="spShareToGroup">
									<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
								</div>
							</div>
							
							
							<div class="col-md-5 hidden" id="profileshow">
								<div class="input-group">
									<input type="hidden" id="spfriendshareid" name="spShareToWhom">
									<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
								</div>
							</div>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br>
							<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
					</div>
				<!--</form>-->
			</div>
			 <div class="modal-body">
				<img id="modalpostingpic" src="" alt="Posting Pic" class="img-rounded img-thumbnail" style="width:300px; height:300px; margin-left:120px">
			  </div>
			  <div class="modal-footer">
				<button type="" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" id="share" class="btn btn-primary">Share</button>
			  </div>
			  </form>
		</div>
	</div>
</div>
				<!--modal complete-->