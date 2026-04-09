<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
	session_start();
	spl_autoload_register(function ($class) {
	  include '../mlayer/' . $class . '.class.php';
	});
  if(!isset($_SESSION['uid'])){
    $total = 0;
  } else {
    $p = new _postingview;
	  $res = $p->soldpost($_SESSION['uid']);
	  if($res != false)//Executed
	  {
		   $executed = $res->num_rows;
	  }
	  else
	  {
		  $executed = 0;
	  }
	  $res = $p->activepost($_SESSION['uid']);
	  if($res != false)//Active
	  {
		   $active = $res->num_rows;
	  }
	  else
	  {
		  $active = 0;
	  }
	  $res = $p->expiredpost($_SESSION['uid']);
	  if($res != false)//Expired
	  {
		   $expired = $res->num_rows;
	  }
	  else
	  {
		  $expired = 0;
	  }
	  $total = $executed +  $active + $expired;
  }
	//echo $total;
	if($total==0){
	$expired = 0;
	$active = 0;
	$executed=0;
	}
	else{
	$active = ($active/$total)*100;
	$executed =($executed/$total)*100;
	$expired = ($expired/$total)*100;
	}
	
	$executed = array(["Active",$active], ["Sold",$executed], ["Expired",$expired]);
	print json_encode($executed , JSON_NUMERIC_CHECK);
	
	/*$sum = 0;
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
			$category[1] = (($row['count']/$sum)*100);
			array_push($chartdata, $category);
		}
		print json_encode($chartdata, JSON_NUMERIC_CHECK);
	}*/
?>
