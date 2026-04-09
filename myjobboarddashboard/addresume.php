<?php

function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$p = new _postingalbum;
	$orext = $_POST["filename"];
	$orext = end((explode(".", $orext)));
	$img = $_POST["spPostingMedia"];
	$img = str_replace("data:".$_POST["ext"]."base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);
	if(isset($_POST["mediaid"])) //Updating Resume
	{
		$p->updateresume($data , $_POST["mediatitle"],$_POST["mediaid"]);
	}
	else //Uploading new
	{
		
			$album = new _album;//Album creation work
			$res = $album->readresume($_POST["profileid"]);
			if($res != false)
			{
				$row = mysqli_fetch_assoc($res);
				$albumid = $row["idspPostingAlbum"];
			}
			else
			{
				$albumid = $album->resumealbum($_POST["profileid"]);
			}
			
			$mediaid = $p->addresume($data , $_POST["mediatitle"],$_POST["profileid"] , $albumid , $_POST["ext"] , $orext);//Media
			echo trim($mediaid);
	}

?>