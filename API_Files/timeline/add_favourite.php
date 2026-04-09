<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $profile_id = $_POST['profile_id'];
    



	$pl = new _favorites;
                                    $res_ev = $pl->chekFavourite($product_id, $profile_id, $user_id);
                                    //$res_ev = $ev->read($_GET["postid"]);

                                    

                                        
                                    

                                    if($res_ev != false){ 

                                      

		// print_r($data);
$id = $pl->removetimelinefav($product_id, $profile_id, $user_id);


                             // echo $pl->ta->sql; 
		 
  $favourite = 0;

		 $favouratedata =array(
		 	"spProfiles_idspProfiles" => $profile_id,
		 	 "spPostings_idspPostings" => $product_id, 
		 	 "spUserid" => $user_id,
		 	 "favourite" => $favourite
		 	);
                                      }else{
                                      	   $timelinedata = array(
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

                                      	$id = $pl->addfavorites($timelinedata);
                                      }

                                      $data = array("status" => 200, "message" => "success","data"=>$favouratedata);


     echo json_encode($data);                                 
		?>