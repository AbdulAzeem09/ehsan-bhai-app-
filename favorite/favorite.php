<?php
	session_start();
	spl_autoload_register(function ($class) {
	  include '../mlayer/' . $class . '.class.php';
	});
  if(isset($_SESSION['uid'])){
    $p = new _postingview;
	  $res = $p->myfavoritepost($_SESSION['uid']);
	  $sum = 0;
	  if($res != false){
		  while($row = mysqli_fetch_assoc($res))
		  {
			  $sum += $row['count'];
		  }
	  }

	  $category = array();
	  $chartdata = array();
	  if($res != false){
		  mysqli_data_seek($res, 0);
		  while($row = mysqli_fetch_assoc($res))
		  {
			  $category[0] = $row["spCategoryname"];
			  //$category[1] = (($row['count']/$sum)*100);
			  $category[1] = $row['count'];
			  array_push($chartdata, $category);
		  }
		  print json_encode($chartdata, JSON_NUMERIC_CHECK);
	  }
  }
?>
