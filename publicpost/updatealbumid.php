
	<?php 
		session_start();
			function sp_autoloader($class){
					include '../mlayer/' . $class . '.class.php';
				}
				spl_autoload_register("sp_autoloader");
			
				$p = new _album;
				$res = $p->read($_POST['pid']);
				if ($res != false){
					while($row = mysqli_fetch_assoc($res)) {
						if($row['spPostingAlbumName']=="Timeline"){
							$albumid = $row["idspPostingAlbum"];
							echo $albumid;
						}
					}
					if(!isset($albumid))
					{
						$pid = $_POST["pid"];
						$albumid = $p->timelinealbum($pid);
						echo $albumid;
					}
				}
				else
				{
					$pid = $_POST["pid"];
					$albumid = $p->timelinealbum($pid);
					echo $albumid;
				}
	?>