<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $profile_id = $_POST['profile_id'];
    



	$fe = new _freelance_favorites;
                                    $res_ev = $fe->chekFavourite($product_id, $profile_id, $user_id);
                                    //$res_ev = $ev->read($_GET["postid"]);

                                    

                                        
                                    

                                    if($res_ev != false){ 

                                      

		// print_r($data);
$id = $fe->removefavorites1($product_id,$user_id);


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

                                      	$id = $fe->addfavorites($timelinedata);
                                      }

                                      $data = array("status" => 200, "message" => "success","data"=>$favouratedata);


     echo json_encode($data);                                 
		?>