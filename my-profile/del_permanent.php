<?php
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

	function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");

$p = new _spprofiles;
//if($_GET['msg']=='delete'){
	
	$p1=$p->read_deleted_profile_1111($_GET['id']);
	if($p1!=false){
	$row=mysqli_fetch_assoc($p1);
	$data=array(
	"idspProfiles"=>$row['deleted_profileid'],
	"spProfileName"=>$row['spProfileName'],
	"spProfileEmail "=>$row['spProfileEmail'],
	"spProfilePhone"=>$row['spProfilePhone'],
	"spProfilePic"=>$row['spProfilePic'],
	"banner_image"=>$row['banner_image'],
	"alias_name"=>$row['spProfileName'],
	"spUser_idspUser"=>$row['spUser_idspUser'],
	"spProfileType_idspProfileType"=>$row['spProfileType_idspProfileType'],
	"spProfileAbout"=>$row['spProfileAbout'],
	"spProfilesDefault"=>$row['spProfilesDefault'],
	"spMembership_idspMembership"=>$row['spMembership_idspMembership'],
	"spProfileSubscriptionDate"=>$row['spProfileSubscriptionDate'],
	"spProfilesRenewalDate"=>$row['spProfilesRenewalDate'],
	"spDynamicWholesell"=>$row['spDynamicWholesell'],
	"spProfilesCity"=>$row['spProfilesCity'],
	"spProfilesState"=>$row['spProfilesState'],
	"spProfilesCountry"=>$row['spProfilesCountry'],
	"spProfilesDob"=>$row['spProfilesDob'],
	"spProfilesAboutStore"=>$row['spProfilesAboutStore'],
	"spAccountStatus"=>$row['spAccountStatus'],
	"spprofilesLanguage"=>$row['spprofilesLanguage'],
	"spprofilesLocation"=>$row['spprofilesLocation'],
	"spprofilesAddress"=>$row['spprofilesAddress'],
	"spprofilesPublished"=>$row['spprofilesPublished'],
	"spProfileVerification"=>$row['spProfileVerification'],
	"is_active"=>$row['is_active'],
	"spProfilePostalCode"=>$row['spProfilePostalCode'],
	"spProfileCntryCode"=>$row['spProfileCntryCode'],
	"relationship_status"=>$row['relationship_status'],
	"phone_status"=>$row['phone_status'],
	"profile_status"=>$row['profile_status'],
	"phone_status"=>$row['phone_status'],
	"email_status"=>$row['email_status'],
	"address"=>$row['address'],
	"chat_status"=>$row['chat_status'],
	"spUserzipcode"=>$row['spUserzipcode'],
	"latitude"=>$row['latitude'],
	"longitude"=>$row['longitude'],
	"store_name"=>$row['store_name'],
	"default_country"=>$row['default_country'],
	"default_state"=>$row['default_state'],
	"default_city"=>$row['default_city'],
	"spdate_created"=>$row['spdate_created'],
	
	);
	}
	$p->create_reactive_profile($data);
	
	
	$p->delete_permanent($_GET['id']);
//}

header("Location: $BaseUrl/my-profile/deleted_profile.php");
	
	//if($_GET['msg']=='reactive'){
	
	
	
		
	//}
?>