<?php


	include '../../univ/baseurl.php';


    	function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}

		
		spl_autoload_register("sp_autoloader");
        
        $p = new _spprofiles;
        $pb = new  _spbusiness_profile;

if( $_POST["spProfileType_idspProfileType"] == 1){
			

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
			$pid = $p->create($profiledata);

				//echo $p->ta->sql;             
if($_POST["spProfileType_idspProfileType"] == 1){



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
	           "companyname"=>$_POST["companyname"],
	           "skill"=>$_POST["skill"],
	           "companyEmail"=>$_POST["companyEmail"],
	           "companyPhoneNo"=>$_POST["companyPhoneNo"],
	           "companyExtNo"=>$_POST["companyExtNo"],
	           "businesscategory"=>$_POST["businesscategory"],
	           "companytagline"=>$_POST["companytagline"],
	           "companyProductService"=>$_POST["companyProductService"],
	           "BussinessOverview"=>$_POST["BussinessOverview"],
	           "languageSpoken"=>$_POST["languageSpoken"],
	           "CompanySize"=>$_POST["CompanySize"],
	           "cmpyRevenue"=>$_POST["cmpyRevenue"],
	           "yearFounded"=>$_POST["yearFounded"],
	           "CompanyOwnership"=>$_POST["CompanyOwnership"],
	           "CompanyWebsite"=>$_POST["CompanyWebsite"],
	           "operatinghours"=>$_POST["operatinghours"],
	           "stockSymbol"=>$_POST["stockSymbol"],
	           "cmpnyStockLink"=>$_POST["cmpnyStockLink"],
	           "spDynamicWholesell"=>$_POST["spDynamicWholesell"],
	           "companyaddress"=>$_POST["spDynamicWholesell"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spshippingtext"=>$_POST["spshippingtext"],
	           "spProfilerefund"=>$_POST["spProfilerefund"],
	           "spProfilepolicy"=>$_POST["spProfilepolicy"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"]
	           );

$pb = new _spbusiness_profile;
$pid2 = $pb->create($data2);

        $alldata = array(
	                  "spUser_idspUser"=>$_POST["spUser_idspUser"],
	                  "idspProfileType"=>$_POST["spProfileType_idspProfileType"],
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
	           "companyname"=>$_POST["companyname"],
	           "skill"=>$_POST["skill"],
	           "companyEmail"=>$_POST["companyEmail"],
	           "companyPhoneNo"=>$_POST["companyPhoneNo"],
	           "companyExtNo"=>$_POST["companyExtNo"],
	           "businesscategory"=>$_POST["businesscategory"],
	           "companytagline"=>$_POST["companytagline"],
	           "companyProductService"=>$_POST["companyProductService"],
	           "BussinessOverview"=>$_POST["BussinessOverview"],
	           "languageSpoken"=>$_POST["languageSpoken"],
	           "CompanySize"=>$_POST["CompanySize"],
	           "cmpyRevenue"=>$_POST["cmpyRevenue"],
	           "yearFounded"=>$_POST["yearFounded"],
	           "CompanyOwnership"=>$_POST["CompanyOwnership"],
	           "CompanyWebsite"=>$_POST["CompanyWebsite"],
	           "operatinghours"=>$_POST["operatinghours"],
	           "stockSymbol"=>$_POST["stockSymbol"],
	           "cmpnyStockLink"=>$_POST["cmpnyStockLink"],
	           "spDynamicWholesell"=>$_POST["spDynamicWholesell"],
	           "companyaddress"=>$_POST["spDynamicWholesell"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spshippingtext"=>$_POST["spshippingtext"],
	           "spProfilerefund"=>$_POST["spProfilerefund"],
	           "spProfilepolicy"=>$_POST["spProfilepolicy"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spProfilesAboutStore"=>$_POST["spProfilesAboutStore"],
	           "spprofilePic"=>$profile_img
                  );

       $data = array("status" => 200, "message" => "success","data"=>$alldata);
}

	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}








/*$c = new _spauctionbid;

$biddata= array( 
	          "spPostings_idspPostings" => $_POST['spPostings_idspPostings'],
	          "spProfiles_idspProfiles" => $_POST['spProfiles_idspProfiles'],
	          "auctionPrice" => $_POST['auctionPrice'],
	          "lastBid" => $_POST['lastBid']
              );


	
	

	if(!empty($_POST['spPostings_idspPostings'])){
		//echo "here";

		//print_r($_POST);
		$id = $c->create($biddata);
	     // echo $p->tad->sql;

		 $data = array("status" => 200, "message" => "success","data"=>$biddata);
	}else{

		$data = array("status" => 1, "message" => "Enter post id");
	}	*/



echo json_encode($data);

?>