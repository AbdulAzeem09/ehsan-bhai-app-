<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$spPostings_idspPostings = $_POST['spPostings_idspPostings'];
$spProfiles_idspProfiles = $_POST['spProfiles_idspProfiles'];
$spUserid =  $_POST['spUserid'];

 //print_r($_POST);
		$sp = new _savepost;
									

     if(!empty($spPostings_idspPostings)){

  
 $result = $sp->savepost($spPostings_idspPostings, $spProfiles_idspProfiles, $spUserid);


   
     if ($result != false) {
     $row = mysqli_fetch_assoc($result);

	$result = $sp->removpost($spPostings_idspPostings, $spProfiles_idspProfiles, $spUserid);

		 $data = array("status" => 200, "message" => "success");
	
    }else{

    	
    	$savedata= array( 


'spPostings_idspPostings' => $spPostings_idspPostings,
'spProfiles_idspProfiles'=>  $spProfiles_idspProfiles,
'spUserid'=>  $spUserid

              );

		//echo "here";
      $id = $sp->create($spPostings_idspPostings, $spProfiles_idspProfiles, $spUserid);
		//print_r($_POST);

		 $data = array("status" => 200, "message" => "success","data"=>$savedata);
	}	


	}else{

		$data = array("status" => 1, "message" => "No Record Available");
	}	



echo json_encode($data);

?>