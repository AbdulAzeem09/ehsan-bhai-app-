<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $profile_id = $_POST['profile_id'];
    


 $bd  = new _freelance_placebid;

                            

                            $chkBidPost = $bd->allbids1($_POST['spProfiles_idspProfiles'], $_POST['spPostings_idspPostings']);
                                    //$res_ev = $ev->read($_GET["postid"]);

                                    //echo $bd->ta->sql;

                                        
                                    

                                    if($chkBidPost){ 

                                      
$data = array("status" => 1, "message" => "Allready Submited.");
		// print_r($data);

                                      }else{


                                      	   $timelinedata = array(
										 	"spProfiles_idspProfiles" => $_POST['spProfiles_idspProfiles'],
										 	 "spPostings_idspPostings" => $_POST['spPostings_idspPostings'], 
										 	 "idspUserProfiles" => $_POST['idspUserProfiles'],
										 	 "bidPrice" => $_POST['bidPrice'],
										 	 "initialPercentage" => $_POST['initialPercentage'],
										 	 "totalDays" => $_POST['totalDays'],
										 	 "coverLetter" => $_POST['coverLetter']

										 	);
                                              



          $b = new _freelance_placebid;

         $id = $b->create($_POST);

                                      	     $data = array("status" => 200, "message" => "success","data"=>$timelinedata);
                                      }

                                 


     echo json_encode($data);                                 
		?>