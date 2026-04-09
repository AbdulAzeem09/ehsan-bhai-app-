<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


	$p = new _classified;
 
 if (isset($_POST['postid']) && $_POST['postid'] > 0) {
    	$postid = $_POST['postid'];

    	$result = $p->trashpost($postid);

      $data = array("status" => 200, "message" => "success");
		
	}else{

		$data = array("status" => 1, "message" => "Post Not Found");
	}
	
echo json_encode($data);

?> 