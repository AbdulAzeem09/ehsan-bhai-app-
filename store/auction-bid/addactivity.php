
<?php
	function sp_autoloader($class){
		include '../../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

/*	old table*/
	//$c = new _postfield;
	//$id = $c->create($_POST);

 /* print_r($_POST);*/
 /* new table */ 
    $c = new _spauctionbid;

/*         $allreadybid = $c->Mylastbid($_POST['spPostings_idspPostings'],$_POST['spProfiles_idspProfiles']);


if(!empty($allreadybid)){

$row = mysqli_fetch_assoc($allreadybid);

    $c->updateauctionbid($row['id'],$_POST['auctionPrice'],$_POST['lastBid']);

}else{

	$id = $c->create($_POST);
}
*/
	$id = $c->create($_POST);

?>
