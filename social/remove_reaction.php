<?php
session_start();

		function sp_autoloader($class){
				include '../mlayer/' . $class . '.class.php';
			}
			spl_autoload_register("sp_autoloader");
			
			
			
				$postid = $_POST["spPostings_idspPostings"];
	$uid = $_SESSION['uid'];
	$profId = $_SESSION['pid'];
	
	
	
    $pl = new _postlike; 
    $r = $pl->likeread($postid, $profId, $uid);
			
	if (!empty($r) && $r->num_rows > 0) {
	$row22 = $r->num_rows;
	
	if($row22 > 0){	
			
				
	$ul = new _postlike;
	
	
	
	$ul->unlike( $_POST["spPostings_idspPostings"],$_SESSION['pid']);
	echo 1;
	}
	}
	
	else{
		echo 0;
	}
?>