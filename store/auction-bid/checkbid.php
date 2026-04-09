
<?php
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

/*	old table*/
	//$c = new _postfield;
	//$id = $c->create($_POST);

 // print_r($_POST);
 /* new table */ 
    $c = new _spauctionbid;


    //$higestbid = $c->auctionhighestbid($_POST['spPostings_idspPostings']);
	$higestbid = $c->auctionhighestbid2($_POST['spPostings_idspPostings']);

if(!empty($higestbid)){

	$row = mysqli_fetch_assoc($higestbid);




/*


	if($_POST['currentBid'] > $row['auctionPrice']){

                	
$data=array(


	'spPostings_idspPostings' => $_POST['spPostings_idspPostings'], 
	'spProfiles_idspProfiles' => $_POST['spProfiles_idspProfiles'], 
	'auctionPrice' => $_POST['currentBid'], 
	'lastBid' => $row['auctionPrice']
);
*/


/*$id = $c->create($data);*/


	/*}*//*else if($_POST['currentBid'] > $row['auctionPrice']){




	}*/

/*	print_r($row);
*/


   echo json_encode(array('auctionPrice'=>(int)$row['auctionPrice']));
   /* $c->updateauctionbid($row['id'],$_POST['auctionPrice'],$_POST['lastBid']);

    echo json_encode(array('total_project'=>$_POST['auctionPrice'],'query' => $this->db->last_query(),'budget'=>$budget));*/

}else{
	echo json_encode(array('auctionPrice'=>0));
}



/*         $allreadybid = $c->Mylastbid($_POST['spPostings_idspPostings'],$_POST['spProfiles_idspProfiles']);


if(!empty($allreadybid)){

$row = mysqli_fetch_assoc($allreadybid);

    $c->updateauctionbid($row['id'],$_POST['auctionPrice'],$_POST['lastBid']);

}else{

	$id = $c->create($_POST);
}
*/
	/*$id = $c->create($_POST);*/

?>
