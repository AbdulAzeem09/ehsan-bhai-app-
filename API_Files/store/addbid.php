<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$c = new _spauctionbid;

$biddata= array( 
	          "spPostings_idspPostings" => $_POST['spPostings_idspPostings'],
	          "spProfiles_idspProfiles" => $_POST['spProfiles_idspProfiles'],
	          "auctionPrice" => $_POST['auctionPrice'],
	          "lastBid" => $_POST['lastBid']
              );

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
	
	

	if(!empty($_POST['spPostings_idspPostings'])){
		//echo "here";

		//print_r($_POST);
		$id = $c->create($biddata);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$biddata);
	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}	



echo json_encode($data);

?>