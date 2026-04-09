<?php
	
    function sp_autoloader($class){
        include '.../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    
    $pb = new  _spbusiness_profile;
    $media = new _postingalbum;
    $p = new _spprofiles;
    $pf = new  _spfreelancer_profile;
    $ps = new  _spprofessional_profile;
    $em = new _spemployment_profile;
    $fm = new _spfamily_profile;

    $u = new _spuser;

	$defaultnewadd = $_POST["address"];
$List = explode(',', $defaultnewadd);


$count =  count($List);
$country= $List[$count-1];
$state= $List[$count-2];
$city= $List[$count-3];





    // Update the user in master table of spuser.
    $updateData = array(
        "spUserCountry" => $_POST["spUserCountry"],
        "spUserState" => $_POST["spUserState"],
        "spUserCity" => $_POST["spUserCity"],
        "address" => $_POST["address"],
        "spUserzipcode" => $_POST["zipcode"],
		        "default_country" => $country,
        "default_state" => $state,
        "default_city" => $city
    );
    $updateResponse = $u->update($updateData, $_POST["user_Id"]);

    // Update master user in spprofiles table.
	

//$numbers = $data ;
//$numbers = explode(',', $numbers);
//echo $lastNumber = end($numbers);
	
    $updateData2 = array(
        "spProfilesCountry" => $_POST["spUserCountry"],
        "spProfilesState" => $_POST["spUserState"],
        "spProfilesCity" => $_POST["spUserCity"],
        "address" => $_POST["address"],
        "spUserzipcode" => $_POST["zipcode"]
    );
    $updateResponse2 = $p->updateMasterProfile($updateData2, $_POST["user_Id"], 4);








    // Get the other profiles of master user and check for addresses of them.
    $getAllOtherProfilesByUID = $p->getAllOtherProfilesByUID($_POST["user_Id"]);
    if ($getAllOtherProfilesByUID != false && mysqli_num_rows($getAllOtherProfilesByUID) > 0) {
        while ($profInfo = mysqli_fetch_assoc($getAllOtherProfilesByUID)) {
            if ((is_null($profInfo["spProfilesCountry"]) || empty($profInfo["spProfilesCountry"]))
                && (is_null($profInfo["spProfilesState"]) || empty($profInfo["spProfilesState"]))
                && (is_null($profInfo["spProfilesCity"]) || empty($profInfo["spProfilesCity"]))
                && (is_null($profInfo["address"]) || empty($profInfo["address"]))
                && (is_null($profInfo["spUserzipcode"]) || $profInfo["spUserzipcode"] == 0)) {
                
                // Update the other profiles here.
                $updateData3 = array(
                    "spProfilesCountry" => $_POST["spUserCountry"],
                    "spProfilesState" => $_POST["spUserState"],
                    "spProfilesCity" => $_POST["spUserCity"],
                    "address" => $_POST["address"],
                    "spUserzipcode" => $_POST["zipcode"]
                );
                $updateResponse3 = $p->updateAllOtherProfiles($updateData3, $profInfo["idspProfiles"]);
            }
        }
    }
    echo 1;