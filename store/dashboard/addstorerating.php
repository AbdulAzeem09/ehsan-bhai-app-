<?php

	function sp_autoloader($class){
	 include '../../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");


print_r($_POST);

	
$currentDateTime = date('Y-m-d H:i:s');


$data= array(         "spPostings_idspPostings"=>$_POST["spPostings_idspPostings"],
	                  "spProfile_idspProfile"=>$_POST["spProfile_idspProfile"],
	                  "uid"=>$_POST["uid"],
	                  "idspOrder"=>$_POST["idspOrder"],
	                  "rating"=>$_POST["rating"],
	                  "review"=>$_POST["review"],
                      "currentdate"=> $currentDateTime

    
	                  
	                  
                  );

//print_r($data);

$r = new _spstorereview_rating;
$id = $r->create($data);

//echo $b->ta->sql;


 ?>