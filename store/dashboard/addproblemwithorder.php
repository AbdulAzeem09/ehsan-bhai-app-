<?php

	function sp_autoloader($class){
	 include '../../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");

//print_r($_POST['reply_id']);

//print_r($_POST['sellerreply']);
//echo "here";



$data = array( 
         	   "order_id" =>$_POST["order_id"], 
         	   "txn_id" =>$_POST["txn_id"], 
         	   "buyerprofil_id" =>$_POST["buyerprofil_id"], 
         	   "sellerprofil_id" =>$_POST["sellerprofil_id"], 
	           "buyerproblem"=>$_POST["buyerproblem"]
	           );

//print_r($data);


$sl = new _store_problemwithorder;

$sl->create($data);

//echo $sl->ta->sql;




$commentdata = array( 
         	   "comment_id" =>$_POST["comment_id"], 
         	 
	           "sellercomments"=>$_POST["sellercomments"]
	           );

//print_r($commentdata);


$sl = new _store_problemwithorder;

$sl->createcomment($commentdata);


?>