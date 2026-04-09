<div class="panel panel-primary">
	<?php
		session_start();
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$p = new _album;
		$res = $p->readdetails($_POST["albumid"]);
		if ($res != false){
			$row = mysqli_fetch_assoc($res);
			$albumname = $row['spPostingAlbumName'];
			$description = $row['spPostingAlbumDescription'];
			
		}
	?>	
			

	<div class="panel-heading">
		<form action="createalbum.php" method="post" id="sp-rename">
			<input type="hidden" id="idspPostingAlbum" name="idspPostingAlbum" value=<?php echo $_POST["albumid"]; ?>></input> 
			<div class="input-group">
				<input class="form-control" type="text" required id="spPostingAlbumName" name="spPostingAlbumName" value="<?php echo $_POST["albumname"]; ?>"></input>
				<span class="input-group-btn">
				<button class="btn btn-default" type="submit" id="renamealbum">Rename!</button>
				</span>
			</div>
		</form>
	</div>
		
		<div class="panel-body">
		<div class="row">
		<div class="col-md-9">
			<div class="form-group">
				<label class="col-sm-2 control-label">Album</label>
				<div class="col-sm-10">
					<p class="form-control-static"><?php echo $albumname;?></p>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-sm-2 control-label">About</label>
				<div class="col-sm-10">
					<p class="form-control-static" ><?php echo $description;?></p>
				</div>
				
				<div class="col-md-12">
					<a href="deletealbum.php/?albumid=<?php echo $_POST["albumid"]; ?>"class="btn btn-danger" id="deleteAlbum" style="margin-left:19cm;"> Delete</a>
				</div>
			</div>
		</div>
	</div>
</div>


				
		
	
