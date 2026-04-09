<?php
 session_start();
?>
		<input class="dynamic-pid" type="hidden" value="<?php echo $_SESSION['pid']?>">
	<?php
		function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
			$p = new _album;
			$rpvt = $p->read($_SESSION['pid']);
			if ($rpvt != false){
			while($row = mysqli_fetch_assoc($rpvt)) {
				echo "<a  id='albumid". $row['idspPostingAlbum'] ."' href='albumdetails.php' class='list-group-item sp-album-label' data-albumid='" . $row['idspPostingAlbum'] . "'>";
			    echo $row['spPostingAlbumName'] . "</a>";
			}
		}
	?>
		