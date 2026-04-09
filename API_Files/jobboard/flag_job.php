<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
 
//print_r($_POST["postid"]);

      if(!empty($_POST["spProfile_idspProfile"])){

      $company = array("spProfile_idspProfile" => $_POST["spProfile_idspProfile"],
                       "spPosting_idspPosting" => $_POST["spPosting_idspPosting"],
                       "spCategory_idspCategory" => 2,
                       "why_flag" => $_POST["why_flag"],
                       "flag_desc" => $_POST["flag_desc"]

                      );


    $cn = new _flagpost;
   $postid = $cn->create($company);
        

          $data = array("status" => 200, "message" => "success","data"=>$company);

        }else{

         $data = array("status" => 1, "message" => "Some Field Missing.");

        }



   echo json_encode($data);
	
?>  