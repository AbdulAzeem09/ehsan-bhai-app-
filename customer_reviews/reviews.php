<?php
function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		$r = new _sppostreview;
		$res = $r->read($_POST["postid"],$_POST["profieid"]);
		if($res != false)
		{
			$row = mysqli_fetch_assoc($res);
			$review = $row["spPostReviewText"];
			echo $review;
		}
?>