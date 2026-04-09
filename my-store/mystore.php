<?php
	session_start();
	spl_autoload_register(function ($class) {
	include '../mlayer/' . $class . '.class.php';
	});

	$p = new _postingview;
	$res = $p->monthlyPosts($_SESSION['uid']);
	$category = array();
	$chartdata = array();
	if($res != false){ 
		while($row = mysqli_fetch_assoc($res))
		{
			$category[0] = $row["spCategoryname"];
			$category[1] = $row['count'];
			array_push($chartdata, $category);
		}
		print json_encode($chartdata, JSON_NUMERIC_CHECK);
	}
?>