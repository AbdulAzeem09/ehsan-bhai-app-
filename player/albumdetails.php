<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
  $p = new _album;
	$result = $p->readdetails($_POST['albumid']);
	 if ($result != false){
	   while($row = mysqli_fetch_assoc($result))
	   {
			
			$albumname = $row['spPostingAlbumName'];
			$description = $row['spPostingAlbumDescription'];
		}
	}
?>

<input type="hidden" id="palylistalbumid" value="<?php echo $_POST['albumid'];?>">

<input type="hidden" id="plylistname" value="<?php echo $albumname;?>">

<div class="form-group">
	<label for="spAlbumName" class="control-label contact">Album Name</label>
	<input type="text" class="form-control" id="spAlbumName" name="spPostingAlbumName" value="<?php echo $albumname;?>">
</div>

<div class="form-group">
	<label for="spAlbumDescription" class="contact">Description</label>
	<textarea class="form-control" id="spAlbumDescription" name="spPostingAlbumDescription" value="<?php echo $description;?>"><?php echo $description;?></textarea>
</div>