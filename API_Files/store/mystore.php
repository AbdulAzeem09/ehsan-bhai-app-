<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


    $sell_list = $_POST['sell_type'];
     $profile_id = $_POST['profile_id'];
/*print_r($_POST);*/
if($sell_list == 1){

  $sell_type= "Retail";

}else if($sell_list == 2){
  $sell_type= "Wholesaler";
  
}else if($sell_list == 3){

  $sell_type= "Auction";
  
}
//print_r($sell_type);


           /*   $limit = 10;
               if($offset > 0 ){
                  //$offset = $offset 

                  $offset = $limit * $offset;
               } */
     /*print_r($offset);*/
                                  $p = new _productposting;
                                  if($sell_type == "Retail"){

                                    $res = $p->myretailproduct(1,$profile_id);


                                  }else if($sell_type == "Wholesaler"){

                                     $res = $p->mywholesaleproduct(1,$profile_id);

                                     
                                  }else if($sell_type == "Auction"){

                                     $res = $p->myauctionproduct(1,$profile_id);
                                     
                                  }
                                  
                                                      ///echo $p->ta->sql;
                                      if($res != false){
                                          while ($rows = mysqli_fetch_assoc($res)) {

                                           /* print_r($rows);*/
                                              
                                              $pic = new _productpic;
                                              $result = $pic->read($rows['idspPostings']);
                                           $pict=array();
                                          if ($result != false) {
                                             /* while ($rp = mysqli_fetch_assoc($result)) {*/

                                              $rp = mysqli_fetch_assoc($result);

                                               // print_r($rp);
                                                  $pict = ($rp['spPostingPic']);
                                             /* }*/
                                          } else{
                                              $pict = " ";
                                          }

                                           $productdata[]= array(
                                      "idspPostings"=> $rows['idspPostings'],
                                      "spPostingTitle"=> $rows['spPostingTitle'],
                                      "spPostingPrice"=> $rows['spPostingPrice'],
                                      "sellType"=> $rows['sellType'],
                                      "picture"=> $pict
                                     
                                    );
                                             /* $statedata[] = array('country_id' =>$row3['country_id'],'state_id' =>$row3['state_id'],'state' =>$row3['state_title']);*/
                                          }

                                          $data = array("status" => 200, "message" => "success","data"=>$productdata);
                                      }else{

                                         $data = array("status" => 1, "message" => "No Record Found.");

                                        }
                                                 


   echo json_encode($data);
	
?>  