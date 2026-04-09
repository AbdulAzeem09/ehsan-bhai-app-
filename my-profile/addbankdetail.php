<?php

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


//print_r($_POST["spProfileType_idspProfileType"]);

	


$data= array(
	                  "spProfile_idspProfile"=>$_POST["spProfile_idspProfile"],
	                  "uid"=>$_POST["uid"],
	                  "spBankusername"=>$_POST["spBankusername"],
	                  "spBankname"=>$_POST["spBankname"],
	                  "spBanknumber"=>$_POST["spBanknumber"],
	                  "spBranchnumber"=>$_POST["spBranchnumber"],
	                  "spAccountnumber"=>$_POST["spAccountnumber"],
	                  "spBankcode"=>$_POST["spBankcode"],
	                  "spcity"=>$_POST["spcity"],
	                  "spbankAddress"=>$_POST["spbankAddress"],
	                  "spcountry"=>$_POST["spcountry"],
	                  "spstate"=>$_POST["spstate"],
	                  "sppostalcode"=>$_POST["sppostalcode"],
	                  "spAddress"=>$_POST["spAddress"]
	                  
                  );

//print_r($data);


$b = new _spbankdetail;
$b->delete($_POST["uid"]);
$id = $b->create($data);
//echo $b->ta->sql;
 ?>
