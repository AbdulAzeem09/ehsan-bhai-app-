<?php

	function sp_autoloader($class){
	 include '../../mlayer/' . $class . '.class.php';

	}
	spl_autoload_register("sp_autoloader");


//print_r($_POST);
//echo "here";
//$currentDateTime = date('Y-m-d H:i:s');

$data= array(        
                    "spByuerProfileId"=>$_POST["spByuerProfileId"],
                     "spBuyeruserId"=>$_POST["spBuyeruserId"],
                     "spSellerProfileId"=>$_POST["spSellerProfileId"],
                     
	                  "txn_id"=>$_POST["txn_id"],
	                    "order_id"=>$_POST["cid"],
	                
	                  "spproduct_title"=>$_POST["spproduct_title"],
	                  "response"=>$_POST["response"],
                     "comments"=>$_POST["comments"]

         );

//print_r($data);

$r = new _spstorereturning_product;
$id = $r->create($data);

//echo $b->ta->sql;

//$sellcomment = array("sellercomments"=>$_POST["sellercomments"]);



$r = new _spstorereturning_product;

 $myreqdata = array("status"=>$_POST["status"]);

 $did = $r->updatereqstatus($myreqdata, "WHERE id =" . $_POST["rid"]);
//echo $r->ta->sql;



 ?>