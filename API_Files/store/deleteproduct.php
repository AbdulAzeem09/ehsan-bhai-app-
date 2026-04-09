<?php
    


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");

    $p = new _productposting;
  
    if (isset($_POST['product_id']) && $_POST['product_id'] > 0) {
    	$postid = $_POST['product_id'];

    	$result = $p->trashpost($postid);
         $data = array("status" => 200, "message" => "success");
    }else{
    	$data = array("status" => 1, "message" => "Enter Product id");
    }
    
    echo json_encode($data);
?>