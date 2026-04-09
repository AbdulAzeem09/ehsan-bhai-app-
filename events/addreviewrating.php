<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


//print_r($_POST["spProfileType_idspProfileType"]);

	
$currentDateTime = date('Y-m-d H:i:s');


$data= array(
	                  "spProfile_idspProfile"=>$_POST["spProfile_idspProfile"],
	                  "uid"=>$_POST["uid"],
	                  "idspPostings"=>$_POST["idspPostings"],
	                  "rating"=>$_POST["rating"],
	                  "review"=>$_POST["review"],
                      "currentdate"=> $currentDateTime

    
	                  
	                  
                  );

//print_r($data);

$r = new _speventreview_rating;
$id = $r->create($data);

//echo $b->ta->sql;


 ?>