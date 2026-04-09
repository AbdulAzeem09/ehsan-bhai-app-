<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


	$p = new _addServiceEnq;
 
if($_POST["spPosting_idspPosting"] ){


    $enqdata = array(
    
     "spProfile_idspProfile"=>$_POST["spProfile_idspProfile"],
     "sender_id"=>$_POST["sender_id"],
     "spPosting_idspPosting"=>$_POST["spPosting_idspPosting"],
     "enquiry_msg"=>$_POST["enquiry_msg"]
    
   );



		$postid = $p->create($enqdata);
  
    $enquerypdata[] = array(
    	"enquery_id"=>$postid,
     "spProfile_idspProfile"=>$_POST["spProfile_idspProfile"],
     "sender_id"=>$_POST["sender_id"],
     "spPosting_idspPosting"=>$_POST["spPosting_idspPosting"],
     "enquiry_msg"=>$_POST["enquiry_msg"]
 );

      $data = array("status" => 200, "message" => "success","data"=>$enquerypdata);
		
	}else{

		$data = array("status" => 1, "message" => "Post Not Found");
	}
	
	




echo json_encode($data);

?>