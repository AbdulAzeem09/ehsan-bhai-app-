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

//print_r($data);


$sl = new _sellercomment;

$sl->create($data);

//echo $sl->ta->sql;

$rl = new _sellerenqreply;



$replydata = array( 
         	   "reply_id" =>$_POST["reply_id"], 
	           "sellerreply"=>$_POST["sellerreply"]
	           );

print_r($replydata);


$rl->createreply($replydata);

//echo $rl->ta->sql;



?>