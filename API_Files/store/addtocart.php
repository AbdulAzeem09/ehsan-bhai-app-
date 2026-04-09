<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$p = new _order;

$orderdata= array( 
	          "spByuerProfileId" => $_POST['spByuerProfileId'],
	          "spBuyeruserId" => $_POST['spBuyeruserId'],
	          "size" => $_POST['size'],
	          "sporderAmount" => $_POST['sporderAmount'],
	          "spSellerProfileId" => $_POST['spSellerProfileId'],
	          "spOrderQty" => $_POST['spOrderQty']

              );
/* [spOrderAdid_] => 40
    [spByuerProfileId] => 521
    [spBuyeruserId] => 384
    [size] => 
    [sporderAmount] => 123
    [spSellerProfileId] => 510
    [spOrderQty] => 1
	print_r($_POST);*/
	//$result = $p-> priviousorder($_POST["spOrderAdid_"],$_POST["spByuerProfileId"]);
	$result = $p-> priviousorder($_POST["spOrderAdid"],$_POST["spByuerProfileId"]);
	

	if($result != false){
		

		$data = array("status" => 1, "message" => "You have already added this post");

	
	}else{
		//echo "here";

		//print_r($_POST);
		$id = $p->create($orderdata, $_POST["spOrderAdid"]);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$orderdata);
	}	



echo json_encode($data);

?>