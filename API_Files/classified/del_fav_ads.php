<?php
	//echo"here";
	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
 
//print_r($_POST["postid"]);

      if(!empty($_POST["postid"])){




     $js = new _classified_fav;
   $postid = $js->removeclassfavorites($_POST["postid"], $_POST['uid'],$_POST['pid']);




                          

          $data = array("status" => 200, "message" => "success","data"=>$ads_data);

        }else{

         $data = array("status" => 1, "message" => "Some Field Missing.");

        }



   echo json_encode($data);
	
?>  