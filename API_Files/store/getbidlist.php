

    <?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");





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
	

    $po = new _spauctionbid;
	$result_bid = $po->auctionbid($_POST['spPostings_idspPostings']);
	//echo $po->ta->sql;
	
	if($result_bid != false){
	    while($row_bid = mysqli_fetch_assoc($result_bid)){ 
              

             // print_r($row_bid);
	    	 $p = new _spprofiles;
             $NameOfProfile = $p->getProfileName($row_bid['spProfiles_idspProfiles']);
		//echo "here";
		/*$row_bid = mysqli_fetch_assoc($higestbid);*/

		 $biddata[] = array("id"=>$row_bid['id'],"spPostings_idspPostings"=>$row_bid['spPostings_idspPostings'],"spProfiles_idspProfiles"=>$row_bid['spProfiles_idspProfiles'],"profilename"=>$NameOfProfile,"auctionPrice"=>$row_bid['auctionPrice'],"lastBid"=>$row_bid['lastBid'],"status"=>$row_bid['status']); 
       }
		//print_r($_POST);
		/*$id = $c->create($biddata);*/
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$biddata);
	}else{

		$data = array("status" => 1, "message" => "No bid found");
	}	



echo json_encode($data);

?>