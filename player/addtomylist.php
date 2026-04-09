<span class="dropdown">
<span class="dropdown-toggle myplaylist" id="addtolist" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="fa fa-plus"></span> Add to</span>
	<ul class="dropdown-menu" id="mlist" aria-labelledby="addtolist">
		<button type="button" class="pull-right" style="margin-right:5px;" id='closelist'><span aria-hidden="true">&times;</span></button>
		<div id="newply" style="margin-top:20px;">
		<?php
			$p = new _album;
			$media = new _postingalbum;
			$res = $p->myalbum($_SESSION['uid']);
			if ($res != false)
			{
				while($rows = mysqli_fetch_assoc($res))
				{
					if($rows['sppostingalbumFlag'] == $category)
					{
						$reslt = $media->checkitem($_POST["postid"],$rows['idspPostingAlbum']);
						$i = 0;
						$mid = "";
						if($reslt != false)
						{
							$row = mysqli_fetch_assoc($reslt);
							$i = 1;
							$mid = $row["idspPostingMedia"];
						}
						echo "<li class='playerlist'  style='padding-left:10px;'><a href='#' class='".($i == 1 ?"deleteitem":"playlist")."' data-albumid='".$rows['idspPostingAlbum']."' data-mid='".$mid."' data-postid='".$_POST["postid"]."'><div class='checkbox plylistchk'><label style='cursor:pointer;'><input type='checkbox' ".($i == 1 ?"checked":"").">".$rows['spPostingAlbumName']."</label></div></a></li>";	
					}					
				}
			}
		?>
		</div>
		<li role="separator" class="divider"></li>
		<li id="opencreatealbm"><a href="#">Create New Playlist</a></li>
		<li class="" id="newplylist" style="padding-left:20px;padding-right:20px;">
			<form action="../album/createalbum.php" method="post">
				
				<input class="dynamic-pid" type="hidden" id="myprofileid" name="spProfiles_idspProfiles" value="<?php echo $_SESSION['pid'];?>">
				
				<input type="hidden" id="pstid" value="<?php echo $_POST["postid"];?>">
				
				<input type="hidden" id="albumcat" name="sppostingalbumFlag" value="<?php echo $category;?>">
						
				<div class="form-group">
					<input type="text" class="form-control" id="playlisttitle" name="spPostingAlbumName" placeholder="Playlist Title..."/>
				</div>
				
				<div class="form-group">
					<textarea class="form-control" id="playlistDescription" name="spPostingAlbumDescription" placeholder="Playlist Description..."></textarea>
				</div>
				<button type="submit" id="createplaylist" class="btn btn-primary pull-right">Create</button>
			</form>
		</li>
	</ul>
</span>