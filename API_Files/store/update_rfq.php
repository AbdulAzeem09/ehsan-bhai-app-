<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$p = new _rfq;



/*Array
(
    [spPostings_idspPostings] => 30
    [spProfiles_idspProfiles] => 510
    [auctionPrice] => 45
    [lastBid] => 42
)
 */
/* [spOrderAdid_] => 40
    [spByuerProfileId] => 521
    [spBuyeruserId] => 384
    [size] => 
    [sporderAmount] => 123
    [spSellerProfileId] => 510
    [spOrderQty] => 1
	print_r($_POST);*/
	//$result = $p-> priviousorder($_POST["spOrderAdid_"],$_POST["spByuerProfileId"]);
	
	

	if(!empty($_POST['quote_id'])){
		//echo "here";

		//print_r($_POST);
		$p->updatequote($_POST['deleveryprice'], "WHERE idspRfq =" . $_POST["quote_id"]);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success");
	}else{

		$data = array("status" => 1, "message" => "Enter Quote id");
	}	



echo json_encode($data);

?>