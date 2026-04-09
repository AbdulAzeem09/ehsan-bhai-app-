<?php
	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
	spl_autoload_register("sp_autoloader");
	$r = new _speventrating;
	$result = $r->read($_POST["profileid"],$_POST["postid"]);
	if($result != false)
	{
		$r->updaterate($_POST["postid"],$_POST["profileid"],$_POST["rate"]);
	}
	else
		$r->create($_POST["postid"],$_POST["profileid"],$_POST["rate"]);
	
	//echo $r->ta->sql;
	$result = $r->review($_POST["postid"]);
	if($result != false)
	{
		$total = 0;
		$review = $result->num_rows;
		while($rows = mysqli_fetch_assoc($result))
		{
			$total += $rows["spPostRating"];
		}
		$rating = $total/$review;
		echo round($rating,2);
	}
	
?>