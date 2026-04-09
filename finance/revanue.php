<?php
	session_start();
	//$_SESSION['year'] = date('Y');
	spl_autoload_register(function ($class) {
	include '../mlayer/' . $class . '.class.php';
	});
  $january = 0;
	$february = 0;
	$march = 0;
	$april = 0;
	$may = 0 ;
	$june = 0;
	$july = 0;
	$august = 0;
	$september = 0;
	$october = 0;
	$novermber = 0;
	$december = 0;
	if(isset($_SESSION["year"])){
	  $p = new _postings;
	  $result = $p->monthlyrevanue($_SESSION["year"]);
	  if($result != false)
	  {
		  while($rows = mysqli_fetch_assoc($result))
		  {
			  $date = new datetime($rows["sppostingsTransactionDate"]);
			  $month = $date->format('m');
			  if($month == "01")
			  {
				  $january = $rows["sum"];
			  }
			  if($month == "02")
			  {
				  $february = $rows["sum"];
			  }
			  if($month == "03")
			  {
				  $march = $rows["sum"];
			  }
			  if($month == "04")
			  {
				  $april = $rows["sum"];
			  }
			  if($month == "05")
			  {
				  $may = $rows["sum"];
			  }
			  if($month == "06")
			  {
				  $june = $rows["sum"];
			  }
			  if($month == "07")
			  {
				  $july = $rows["sum"];
			  }
			  if($month == "08")
			  {
				  $august = $rows["sum"];
			  }
			  if($month == "09")
			  {
				  $september = $rows["sum"];
			  }
			  if($month == "10")
			  {
				  $october = $rows["sum"];
			  }
			  if($month == "11")
			  {
				  $november = $rows["sum"];
			  }
			  if($month == "12")
			  {
				  $december = $rows["sum"];
			  }
		  }
	  }
	}
	
	$executed = array(["January",$january], ["February",$february], ["March",$march], ["April",$april],["May",$may], ["June",$june],["July",$july],["August",$august] , ["September",$september] ,["October",$october] , ["November",$novermber] ,  ["December",$december]);
	print json_encode($executed , JSON_NUMERIC_CHECK);
	
?>
