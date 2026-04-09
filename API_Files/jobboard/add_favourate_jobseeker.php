<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
 
//print_r($_POST["postid"]);

      if(!empty($_POST["fav_id"])){

      $jobdata = array(
      "spProfiles_idspProfiles" => $_POST["pid"],
       "spPostings_idspPostings" => $_POST["fav_id"], 
       "spUserid" => $_POST["uid"]);



     $js = new _job_favorites;
   $postid = $js->addjobfavorites($jobdata);

 $company_data  = array( 
                  
                  "spProfiles_idspProfiles" => $_POST["pid"],
                  "spPostings_idspPostings" => $_POST["fav_id"], 
                  "spUserid" => $_POST["uid"]
                 

                 );


                          

          $data = array("status" => 200, "message" => "success","data"=>$company_data);

        }else{

         $data = array("status" => 1, "message" => "Some Field Missing.");

        }



   echo json_encode($data);
	
?>  