<?php
	session_start();
	if(!isset($_SESSION['monthtext']) && !isset($_SESSION['monthvalue']))
	{
		$_SESSION['monthtext'] = date('F');
		$_SESSION['monthvalue'] = date('m');
	}
	spl_autoload_register(function ($class) {
	include '../mlayer/' . $class . '.class.php';
	});
  $publicstore = 0;
	$realest = 0;
	$transport = 0;
	$document = 0;
	$training = 0 ;
	$event = 0;
	$video = 0;
	$recipe = 0;
	$photo = 0;
	$music = 0;
	$coupons = 0;
	if(isset($_SESSION['monthvalue'])){
	  $p = new _postings;
	  $result = $p->categoryrevanue($_SESSION['monthvalue']);
	  if($result != false)
	  {
		  while($rows = mysqli_fetch_assoc($result))
		  {
			  if($rows["spCategories_idspCategory"] == "1")
			  {
				  $publicstore = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "3")
			  {
				  $realest = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "4")
			  {
				  $transport = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "6")
			  {
				  $document = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "8")
			  {
				  $training = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "9")
			  {
				  $event = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "10")
			  {
				  $video = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "11")
			  {
				  $recipe = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "13")
			  {
				  $photo = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "14")
			  {
				  $coupons = $rows["sum"];
			  }
			  if($rows["spCategories_idspCategory"] == "15")
			  {
				  $coupons = $rows["sum"];
			  }
		  }
	  }
	}
	
	$executed = array(["Public Store",$publicstore], ["Real Estate",$realest], ["Transport",$transport], ["Document",$document],["Training",$training], ["Event",$event],["Videos",$video],["Recipes",$recipe] , ["Photos",$photo] ,["Music",$music],["Coupons",$coupons]);
	print json_encode($executed , JSON_NUMERIC_CHECK);
	
?>
