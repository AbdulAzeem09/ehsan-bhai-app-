<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
 
//print_r($_POST["postid"]);

      if(!empty($_POST["spProfiles_idspProfiles"])){

      $company = array("spProfiles_idspProfiles" => $_POST["spProfiles_idspProfiles"],
                       "cmpanynewsTitle" => $_POST["cmpanynewsTitle"],
                       "cmpanynewsDesc" => $_POST["cmpanynewsDesc"]
                      );


    $cn = new _company_news;
   $postid = $cn->create($company);

 $company_data  = array( 
                  'news_id' => $postid,
                  "spProfiles_idspProfiles" => $_POST["spProfiles_idspProfiles"],
                       "cmpanynewsTitle" => $_POST["cmpanynewsTitle"],
                       "cmpanynewsDesc" => $_POST["cmpanynewsDesc"]
                 

                 );


                          

          $data = array("status" => 200, "message" => "success","data"=>$company_data);

        }else{

         $data = array("status" => 1, "message" => "Some Field Missing.");

        }



   echo json_encode($data);
	
?>  