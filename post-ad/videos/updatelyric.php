<?php
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	// update course outlinge

	$c = new _postfield;
	$c->updateCourse($_POST['lyrics'], $_POST["postid"]);
	$lyric = $_POST['lyrics'];
	$postid = $_POST['postid'];
	$label = "Music Lyrics";
	$fieldName = "lyrics_";

	$c->updateCustomLyric($lyric, $postid, $label, $fieldName);
	//echo $c->ta->sql;
?>
