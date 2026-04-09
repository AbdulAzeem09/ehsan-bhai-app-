<?php
	session_start();
	spl_autoload_register(function ($class) {
	include '../mlayer/' . $class . '.class.php';
	});
  if(isset($_SESSION['pid'])){
    $p = new _postingview;
	  //$res = $p->countPosts($_SESSION['uid']);
	  $res = $p->countPostsprofile($_SESSION['pid']);
	  //echo $p->ta->sql;
	  $sum = 0;
	  if($res != false){
		  while($row = mysqli_fetch_assoc($res))
		  {
			  $sum += $row['count'];
		  }
	  }
	  $_SESSION["mystore"] = $sum ;

	  $category = array();
	  $chartdata = array();

	  if($res != false){
		  mysqli_data_seek($res, 0);
		  while($row = mysqli_fetch_assoc($res))
		  {
			  $category[0] = $row["spCategoryname"];
			  $category[1] = (($row['count']/$sum)*100);
			  array_push($chartdata, $category);
		  }
		  print json_encode($chartdata, JSON_NUMERIC_CHECK);
	  }
  }
?>
