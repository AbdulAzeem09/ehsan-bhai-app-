<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
        
        $p = new _spprofiles;
       

if($_POST["spProfileType_idspProfileType"] == 6){
			

			$profiledata= array(
	                  "spUser_idspUser"=>$_POST["spUser_idspUser"],
	                  "spProfileType_idspProfileType"=>$_POST["spProfileType_idspProfileType"],
	                  "spProfileName"=>$_POST["spProfileName"],
	                  "spProfileEmail"=>$_POST["spProfileEmail"],
	                  "email_status"=>$_POST["email_status"],
	                  "address"=>$_POST["address"],
	                  "latitude"=>$_POST["latitude"],
	                  "longitude"=>$_POST["longitude"],
                      "spProfilePhone"=>$_POST["spProfilePhone"],
                      "phone_status"=>$_POST["phone_status"],

                      "spProfilePostalCode"=>$_POST["spProfilePostalCode"],
                      "relationship_status"=>$_POST["relationship_status"]
                  );
				// print_r($profiledata);
			//$pid = $p->create($profiledata);

				//echo $p->ta->sql;             
if($_POST["spProfileType_idspProfileType"] == 6){

			$pid = $p->create($profiledata);

				//echo $p->ta->sql;             
	if(isset($_FILES['spprofilePic']['name'])){
	
$file_tmp_name =$_FILES['spprofilePic']['tmp_name'];
    $str = file_get_contents($file_tmp_name);
    $b64img=($str);

		$ext = pathinfo($_FILES['spprofilePic']['name'], PATHINFO_EXTENSION);

		$img = str_replace("data:image/".$ext.";base64,", "", $b64img);
	    $img = str_replace(" ", "+", $img);
	    $profimgdata = base64_decode($img);


       $p->updateprofilepic($pid, $profimgdata);
		/*echo $p->ta->sql; */ 
		$profile_img = ($img);

}else{
	$profile_img = "";
}


    $rpvt = $p->read($pid);

if ($rpvt != false){

$row = mysqli_fetch_assoc($rpvt);

$profiletype = $row['spProfileTypeName'];

}
                   $data2= array( 
         	   "spprofiles_idspProfiles" =>$pid, 

	           "interested"=>$_POST["interested"],
	           "idealrelationship"=>$_POST["idealrelationship"],
	           "carrer"=>$_POST["carrer"],
	           "spProfileAbout"=>$_POST["spProfileAbout"]
	           );


       // print_r($data);

$fm = new _spfamily_profile; 
$pid2 = $fm->create($data2);





/*$pb = new _spbusiness_profile;
$pid = $pb->create($data2);*/

        $alldata = array(
	                  "spUser_idspUser"=>$_POST["spUser_idspUser"],
	                  "idspProfileTypes"=>$_POST["spProfileType_idspProfileType"],
	                  "spProfileName"=>$_POST["spProfileName"],
	                  "spProfileEmail"=>$_POST["spProfileEmail"],
	                  "email_status"=>$_POST["email_status"],
	                  "address"=>$_POST["address"],
	                  "latitude"=>$_POST["latitude"],
	                  "longitude"=>$_POST["longitude"],
                      "spProfilePhone"=>$_POST["spProfilePhone"],
                      "phone_status"=>$_POST["phone_status"],

                      "spProfilePostalCode"=>$_POST["spProfilePostalCode"],
                      "relationship_status"=>$_POST["relationship_status"],         	   
                      "idspProfiles" =>$pid, 
                      "spProfileTypeName"=>$profiletype,
	          
       					"interested"=>$_POST["interested"],
	           "idealrelationship"=>$_POST["idealrelationship"],
	           "carrer"=>$_POST["carrer"],
	           "spProfileAbout"=>$_POST["spProfileAbout"],
       					"spprofilePic"=>$profile_img
                  );

       $data = array("status" => 200, "message" => "success","data"=>$alldata);
}

	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}




echo json_encode($data);

?>