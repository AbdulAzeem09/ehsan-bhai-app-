<?php
	//session_start();
	$unread = new _friendchatting;
	$res = $unread->totalunread($_SESSION["pid"]);
	//echo $unread->ta->sql;
	$totalunread = 0;
	if($res != false){
		$totalunread = $res->num_rows;
	}

?>
