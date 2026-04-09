<div class="row">
	<div class="col-md-8">
		<div class="video social">
			<!--Audio and video uploading interface for watching-->
		</div>
		
		
	</div>
	<div class="col-md-4">
		<div class="well title" align="center" style="font-size:20px;color:gray;">My Playlist</div>
		<ul class="list-group myplaylist">
		  <?php
			$p = new _album;
			$res = $p->myalbum($_SESSION['uid']);
			if ($res != false)
			{
				while($rows = mysqli_fetch_assoc($res))
				{
					echo "<li class='list-group-item albmlist'><span class='playlistdd ' data-albumid='".$rows['idspPostingAlbum']."'><span class='".($rows['sppostingalbumFlag'] == 10 ?"glyphicon glyphicon-facetime-video":"glyphicon glyphicon-music")."' ></span> <span class='albmname'>".$rows['spPostingAlbumName']."</span></span></span><span class='pull-right'><button type='button' class='btn btn-danger btn-xs deletealbm' data-albumid='".$rows['idspPostingAlbum']."'><span class='glyphicon glyphicon-remove'></span></button>&nbsp;<button type='button' class='btn btn-primary btn-xs editalbm' data-albumid='".$rows['idspPostingAlbum']."' data-toggle='modal' data-target='#exampleModal'><span class='fa fa-pencil-square-o'></span></button></span></li>";					
				}
			}
			?>
		</ul>
		
		<!--Edit playlist album modal-->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel"><b>Edit Album</b></h4>
			</div>
			<div class="modal-body">
				<form>
					
					<div class="albumdet"></div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button id="saveplylist" type="button" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!--Done-->
<!--Complete-->
		
		<div class="loadmyplaylist playlistitm loadmyplayer">
			<!--All my playlist Item-->
		</div>
	</div>
</div>