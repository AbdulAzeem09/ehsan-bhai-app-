<?php

function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");
	
	$b = new _storebanner;

     echo  $_POST["profileid"];  

     echo  $_POST["userid"]; 

     echo  $_POST["bannerPic"];  

	$img = $_POST["bannerPic"];
	$img = str_replace("data:image/".$_POST["ext"].";base64,", "", $img);
	$img = str_replace(" ", "+", $img);
	$data = base64_decode($img);
	//$p->updateprofilepic($_POST["profileid"], $data);


	  $data= array( 
         	   "idspProfiles" =>$_POST["profileid"],
	           "idspUser" => $_POST["userid"],
	           "spStorebanner"=>$_POST["bannerPic"]
	         
	          
	           );

$bannerdata = $b->create($data);
echo $b->ta->sql; 

	//echo $_POST["profileid"];
?>