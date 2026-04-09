<?php
session_start();
	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

/*	old table*/
	//$c = new _postfield;
	//$id = $c->create($_POST);

 
 /* new table */ 
    $c = new _spauctionbid;


    $higestbid = $c->auctionhighestbid($_POST['spPostings_idspPostings']);

              /* echo $c->ta->sql;*/
               /*print_r($c->ta->sql);*/

  /*  print_r($higestbid);*/

if(!empty($higestbid)){

	$row = mysqli_fetch_assoc($higestbid);
	$result_my_au = $po->checkMyAuctionbid($_GET['postid'], $_SESSION['pid']);
                                                        //echo $po->ta->sql;

                                                        //print_r($result_my_au);
                                                        
/*print_r($row);*/
if($_SESSION['pid'] == $row['spProfiles_idspProfiles']){

 $data = "<div class='alert alert-success'  id='auct'>
  <strong>You're the higest bidder.</strong>
</div>";

}else if($result_my_au == true){ 

$data = "<div class='alert alert-danger'  id='auct'>
  <strong>You're Bid is out bidded.Please increase your bid.</strong>
</div>";



}



   echo json_encode(array('auctionPrice'=>(int)$row['auctionPrice'],'bidcheck'=>$data ,'spProfiles_idspProfiles'=>$row['spProfiles_idspProfiles']));
   /* $c->updateauctionbid($row['id'],$_POST['auctionPrice'],$_POST['lastBid']);

    echo json_encode(array('total_project'=>$_POST['auctionPrice'],'query' => $this->db->last_query(),'budget'=>$budget));*/

}/*else{
   $data = "<div class='alert alert-warning' id='auct'>
  <strong>Plesase plase your bid.</strong>
</div>";
	echo json_encode(array('auctionPrice'=>0,'bidcheck'=>$data,'spProfiles_idspProfiles'=>0));
	 
}*/

/*echo json_encode($data);*/


?>