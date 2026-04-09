<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

$or = new _orderSuccess;


$trancdata= array(  

	           

	              "txn_id"=>$_POST['txn_id'],
	              "idspUser"=>$_POST['idspUser'],
	               "spProfile_idspProfile"=>$_POST['spProfile_idspProfile'],
        	          "spPosting_idspPosting"=>$_POST['spPosting_idspPosting'],
        	          
        	          "payer_id"=>$_POST['payer_id'],
        	          "payer_email"=>$_POST['payer_email'],
        	         
        	        
        	          "first_name"=>$_POST['first_name'],
        	          "last_name"=>$_POST['last_name'],
        	            "amount"=>$_POST['amount'],
        	        
        	          "currency"=>$_POST['currency'],
        	          "country" => $_POST['country'],
        	         
        	          "txn_type"=>$_POST['txn_type'],
        	          "payment_type"=>$_POST['payment_type'],
        	         
        	          "payment_status"=>$_POST['payment_status'],
        	          "create_date"=>$_POST['create_date'],
        	           "payment_date"=>$_POST['payment_date']

        	         
        	        
              );

//print_r($trancdata);

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
	
	

	if(!empty($_POST['txn_id'])){
		//echo "here";
	/*$result2 = $or->createOrder($_SESSION['pid'],$_SESSION['uid'],$item_name, $amount, $currency, $payer_email, $first_name, $last_name, $country, $txn_id, $txn_type, $payment_status, $payment_type, $payer_id, $create_date, $payment_date);*/


		//print_r($_POST);
		$id = $or->createmystore($trancdata);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$trancdata);
	}else{

		$data = array("status" => 1, "message" => "Enter transaction id");
	}	



echo json_encode($data);

?>