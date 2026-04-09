<?php
	$p = new _spprofiles;
	$result = $p->readMember($_SESSION['uid'],$_SESSION['gid']);
	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);
		$profileid = $row["idspProfiles"];
		$profilename = $row["spProfileName"];
	}
?>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div style="background-color: #FFFFFF ; height:240px; border-radius: 12px;">
		<form enctype="multipart/form-data" action="../post-ad/dopost.php" method="post" id="sp-form-post">
			
			<input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="17">
			
			<input type="hidden" id="catname" value="">
			
			<input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="<?php echo $_GET['groupid']?>">
			
			<input name="spProfiles_idspProfiles" id="spProfiles_idspProfiles" class="business" value="<?php echo $profileid;?>" type="hidden">
			
		<div class="row" style="padding-left:15px; padding-right:15px; padding-top:20px;">
			<div class="col-md-6">
				<div class="form-group" style="margin-left:80px;">
					<label for="postingpic">Add Image</label>
					<input type="file" class="postingpic" name="spPostingPic[]" multiple="multiple">
					<p class="help-block"><small>Browse files</small></p>
				</div>
				<div id="dvPreview" class="hidden">
				</div>
			</div>
			<div class="col-md-6">
				<!--<div class="form-group pull-right">
					<label for="addvideo">Add Video</label>
					<input type="file" id="addvideo" name="spPostingMedia[]"  accept="video/*"  multiple="multiple">
					<p class="help-block"><small>Browse files</small></p>
				</div>-->
				<div class="form-group">
					<label for="addvideo">Add Video</label>
					<input type="file" id="addvideo" class="spmedia"  name="spPostingMedia[]"  accept="video/*"  multiple="multiple">
					<p class="help-block"><small>Browse</small></p>
				</div>
				<div id="media-container"></div>
				
			</div>
		</div>
			<?php
				$p = new _album;
				$res = $p->read($profileid);
				if ($res != false){
					while($row = mysqli_fetch_assoc($res)) {
						if($row['spPostingAlbumName']=="Timeline"){
							$albumid = $row["idspPostingAlbum"];
						}
					}
					if(!isset($albumid))
					{
						$pid = $profileid;
						$albumid = $p->timelinealbum($pid);
					}
				}
				else
				{
					$pid = $profileid;
					$albumid = $p->timelinealbum($pid);
				}
			?>
			<input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="<?php echo $albumid;?>">
		
			
			<div class="row" style="margin-left:15px;margin-right:15px;">
				<div class="col-md-1 commentprofile">
					<?php
						$p = new _spprofiles;
						$result = $p->read($profileid);
						if($result != false)
						{
							$row = mysqli_fetch_assoc($result);
							if(isset($row["spProfilePic"]))
								echo "<img alt='profilepic' class='img-circle' src=' ". ($row["spProfilePic"])."' style='width: 40px; height: 40px;' >" ;
							else
								echo "<img alt='profilepic' class='img-circle' src='../img/default-profile.png' style='width: 40px; height: 40px;' >" ;
						}
					?>
				</div>
				<div class="col-md-11 form-group">
					<textarea type="text" class="form-control grptimeline" placeholder="What's on your Mind ?" name="spPostingNotes" rows="3"></textarea>
				</div>
			</div>
			<!--Testing-->
			<button id="spPostSubmit" type="button" style="margin-right:15px;" data-grouptimeline="grouptimeline" class="btn btn-success pull-right btn-border-radius" data-loading-text="Posting...">Post</button>
		</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div><br>