<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");


$timestamp = time();

     $datetime  = date("F d, Y h:i:s", $timestamp);

$flagdata = array( 
               "spPosting_idspPosting" =>$_POST["spPosting_idspPosting"], 
               "spProfile_idspProfile"=>$_POST["spProfile_idspProfile"],
               "spCategory_idspCategory"=>$_POST["spCategory_idspCategory"],
               "why_flag"=>$_POST["why_flag"],
               "flag_desc"=>$_POST["flag_desc"],
               "flag_date"=>$datetime

               );

//print_r($data);


$sl = new _rfqflag;


	
	

	if(!empty($_POST['spPosting_idspPosting'])){
		//echo "here";

		//print_r($_POST);
		$sl->create($flagdata);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$flagdata);
	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}	



echo json_encode($data);

?>