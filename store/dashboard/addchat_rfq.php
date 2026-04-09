<?php

	function sp_autoloader($class){
	 include '../../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");

//print_r($_POST['reply_id']);

//print_r($_POST['sellerreply']);
//echo "here";

$data = array( 
         	   "comment_id" =>$_POST["comment_id"], 
	           "sellercomments"=>$_POST["sellercomments"]
	           );

print_r($data);


$ch = new _rfqchat;

$ch->create($data);

//echo $sl->ta->sql;



?>