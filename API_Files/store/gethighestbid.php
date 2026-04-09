

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$c = new _spauctionbid;


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
	
	  $c = new _spauctionbid;


    $higestbid = $c->auctionhighestbid($_POST['spPostings_idspPostings']);

	if(!empty($higestbid)){
		//echo "here";
		$row_bid = mysqli_fetch_assoc($higestbid);

		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$row_bid);
	}else{

		$data = array("status" => 1, "message" => "No bid found");
	}	



echo json_encode($data);

?>