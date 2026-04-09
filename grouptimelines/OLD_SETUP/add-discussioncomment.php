<?php

	function sp_autoloader($class){
	 include '../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");

//print_r($_POST['reply_id']);

//print_r($_POST['sellerreply']);
//echo "here";

	$currentDateTime = date('Y-m-d H:i:s');


$data = array( 
         	   "comment_id" =>$_POST["comment_id"], 
	           "sellercomments"=>$_POST["sellercomments"],
	           "spreplyerProfileId"=>$_POST["spreplyerProfileId"],
	            "currentdate"=> $currentDateTime
	           );

//print_r($data);


$sl = new _groupdiscussreply;

$sl->create($data);

//echo $sl->ta->sql;




?>