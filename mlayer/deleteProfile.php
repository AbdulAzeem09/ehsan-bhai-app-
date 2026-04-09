<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$p = new _spprofiles;


$p1 = $p->readprofileid2($_GET['profileid']);
if ($p1 != false) {
	$row = mysqli_fetch_assoc($p1);
	$data = array(
		"deleted_profileid" => $_GET['profileid'],
		"spProfileName" => $row['spProfileName'],
		"spProfileEmail " => $row['spProfileEmail'],
		"spProfilePhone" => $row['spProfilePhone'],
		"spProfilePic" => $row['spProfilePic'],
		"banner_image" => $row['banner_image'],
		"alias_name" => $row['spProfileName'],
		"spUser_idspUser" => $row['spUser_idspUser'],
		"spProfileType_idspProfileType" => $row['spProfileType_idspProfileType'],
		"spProfileAbout" => $row['spProfileAbout'],
		"spProfilesDefault" => $row['spProfilesDefault'],
		"spMembership_idspMembership" => $row['spMembership_idspMembership'],
		"spProfileSubscriptionDate" => $row['spProfileSubscriptionDate'],
		"spProfilesRenewalDate" => $row['spProfilesRenewalDate'],
		"spDynamicWholesell" => $row['spDynamicWholesell'],
		"spProfilesCity" => $row['spProfilesCity'],
		"spProfilesState" => $row['spProfilesState'],
		"spProfilesCountry" => $row['spProfilesCountry'],
		"spProfilesDob" => $row['spProfilesDob'],
		"spProfilesAboutStore" => $row['spProfilesAboutStore'],
		"spAccountStatus" => $row['spAccountStatus'],
		"spprofilesLanguage" => $row['spprofilesLanguage'],
		"spprofilesLocation" => $row['spprofilesLocation'],
		"spprofilesAddress" => $row['spprofilesAddress'],
		"spprofilesPublished" => $row['spprofilesPublished'],
		"spProfileVerification" => $row['spProfileVerification'],
		"is_active" => $row['is_active'],
		"spProfilePostalCode" => $row['spProfilePostalCode'],
		"spProfileCntryCode" => $row['spProfileCntryCode'],
		"relationship_status" => $row['relationship_status'],
		"phone_status" => $row['phone_status'],
		"profile_status" => $row['profile_status'],
		"phone_status" => $row['phone_status'],
		"email_status" => $row['email_status'],
		"address" => $row['address'],
		"chat_status" => $row['chat_status'],
		"spUserzipcode" => $row['spUserzipcode'],
		"latitude" => $row['latitude'],
		"longitude" => $row['longitude'],
		"store_name" => $row['store_name'],
		"default_country" => $row['default_country'],
		"default_state" => $row['default_state'],
		"default_city" => $row['default_city'],
		"spdate_created" => $row['spdate_created'],
		"deleted_date" => date('Y-m-d H:i:s')
	);
}
print_r($data);
die('==');
$p->create_deleted_profile($data);


die('========');
$p->removeProfiles($_GET["profileid"]);
$p->removeProduct($_GET["profileid"]);

$pf = new _spfreelancer_profile;
$pf->removeProfiles($_GET["profileid"]);

$jb = new _spjobseeker;
$jb->removeProfiles($_GET["profileid"]);

$rs = new _realstateposting;
$rs->removeProfiles($_GET["profileid"]);

$ac = new _artCategory;
$ac->removeProfiles($_GET["profileid"]);

$v = new _video;
$v->removeProfiles($_GET["profileid"]);


$ad = new _classified;
$ad->removeProfiles($_GET["profileid"]);

$ev = new _spevent;
$ev->removeProfiles($_GET["profileid"]);

$nc = new _news;
$nc->removeProfiles($_GET["profileid"]);
