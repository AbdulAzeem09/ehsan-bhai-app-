<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $profile_id = $_POST['profile_id'];
    



$st = new _store_favorites;
                                    $res_ev = $st->chekFavourite($product_id, $profile_id, $user_id);
                                    //$res_ev = $ev->read($_GET["postid"]);

                                   // echo $ev->ta->sql; 

                                        
                                    

                                    if($res_ev != false){ 

                                      

		// print_r($data);
$id = $st->removestorefavorites($product_id, $user_id,$profile_id);
		 
  $favourite = 0;

		 $favouratedata =array(
		 	"spProfiles_idspProfiles" => $profile_id,
		 	 "spPostings_idspPostings" => $product_id, 
		 	 "spUserid" => $user_id,
		 	 "favourite" => $favourite
		 	);
                                      }else{
                                      	   $storedata = array(
										 	"spProfiles_idspProfiles" => $profile_id,
										 	 "spPostings_idspPostings" => $product_id, 
										 	 "spUserid" => $user_id);
                                              
                                              $favourite = 1;

                                               $favouratedata =array(
															 	"spProfiles_idspProfiles" => $profile_id,
															 	 "spPostings_idspPostings" => $product_id, 
															 	 "spUserid" => $user_id,
															 	 "favourite" => $favourite
															 	);

                                      	$id = $st->addstorefavorites($storedata);
                                      }

                                      $data = array("status" => 200, "message" => "success","data"=>$favouratedata);


     echo json_encode($data);                                 
		?>