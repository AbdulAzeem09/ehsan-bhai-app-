<?php
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
	include '../mlayer/' . $class . '.class.php';
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

//print_r($_FILES);die('======');


// Get User DOB.
$getCurrentUser = $u->read($_POST["spUser_idspUser"]);
if ($getCurrentUser != false && mysqli_num_rows($getCurrentUser) > 0) {
	$currentUserArray = mysqli_fetch_assoc($getCurrentUser);
	$currentUserDob = $currentUserArray["spUserDob"];
}
echo $_POST["spProfilePhone"];
die('=======');
$profiledata = array(
	"spUser_idspUser" => $_POST["spUser_idspUser"],
	"spProfileType_idspProfileType" => $_POST["spProfileType_idspProfileType"],
	"spProfileName" => $_POST["spProfileName"],
	"spProfileEmail" => $_POST["spProfileEmail"],
	"email_status" => $_POST["email_status"],
	"profile_status" => $_POST["profile_status"],
	"address" => $_POST["address"],
	"latitude" => $_POST["latitude"],
	"longitude" => $_POST["longitude"],
	"spProfilePhone" => $_POST["spProfilePhone"],
	"phone_status" => $_POST["phone_status"],
	"spProfilesDob" => $currentUserDob,
	"spProfilePostalCode" => $_POST["spProfilePostalCode"],
	"relationship_status" => $_POST["relationship_status"],
	"spProfilesCountry" => $_POST["spUserCountry"],
	"spProfilesState" => $_POST["spUserState"],
	"spProfilesCity" => $_POST["spUserCity"],
	"spUserzipcode" => $_POST["spProfilePostalCode"],
	"store_name" => $_POST["spDynamicWholesell"]
);

if ($_POST["spUser_idspUser"] != "") {
	if ($_POST["spProfileType_idspProfileType"] == 4) {

		$personal_profiledata = array(
			"tag" => $_POST["tag"],
			"memberrelation" => $_POST["memberrelation"],
			"personal_PhoneNo" => $_POST["personal_PhoneNo"],
			"relationship_status" => $_POST["relationship_status"],
			"spDynamicWholesell" => $_POST["spDynamicWholesell"],
			"category" => $_POST["category"],
			"highlights" => $_POST["highlights"],
			"languagefluency" => $_POST["languagefluency"],
			"sphobbies" => $_POST["sphobbies"],
			"Education" => $_POST["Education"],
			"spProfileAbout" => $_POST["spProfileAbout"]
		);
		$id  = $u->updatepersonal($personal_profiledata, $_POST["spUser_idspUser"]);
		echo trim($id);
		//echo "2222";
	}
	//header('location: $BaseUrl/my-profile/');
}


if ($_POST["idspProfiles"] != "") {
	//die('=======22');
	$p->updateProfiles($profiledata, "WHERE t.idspProfiles =" . $_POST["idspProfiles"]);
	//echo $p->sql; 
	//die("2324");
	echo trim($_POST["idspProfiles"]);

	if ($_POST["spProfileType_idspProfileType"] == 1) {


		$business_profiledata = array(
			"spprofiles_idspProfiles" => $_POST["spprofiles_idspProfiles"],
			"companyname" => $_POST["companyname"],
			"skill" => $_POST["skill"],
			"companyEmail" => $_POST["companyEmail"],
			"companyPhoneNo" => $_POST["companyPhoneNo"],
			"companyExtNo" => $_POST["companyExtNo"],
			"businesscategory" => $_POST["businesscategory"],
			"companytagline" => $_POST["companytagline"],
			"companyProductService" => $_POST["companyProductService"],
			"BussinessOverview" => $_POST["BussinessOverview"],
			"languageSpoken" => $_POST["languageSpoken"],
			"CompanySize" => $_POST["CompanySize"],
			"cmpyRevenue" => $_POST["cmpyRevenue"],
			"yearFounded" => $_POST["yearFounded"],
			"CompanyOwnership" => $_POST["CompanyOwnership"],
			"CompanyWebsite" => $_POST["CompanyWebsite"],
			"operatinghours" => $_POST["operatinghours"],
			"stockSymbol" => $_POST["stockSymbol"],
			"cmpnyStockLink" => $_POST["cmpnyStockLink"],
			"spDynamicWholesell" => $_POST["spDynamicWholesell"],
			"companyaddress" => $_POST["companyaddress"],
			"spProfilesAboutStore" => $_POST["spProfilesAboutStore"],
			"spshippingtext" => $_POST["spshippingtext"],
			"spProfilerefund" => $_POST["spProfilerefund"],
			"spProfilepolicy" => $_POST["spProfilepolicy"],
			"defaultbusiness" => $_POST['defaultbusiness'],
			"showEmailProfile" => $_POST['showEmailProfile'],
			"showAddNews" => $_POST['showAddNews'],
			"showPhoneProfile" => $_POST['showPhoneProfile'],
			"showLinkStore" => $_POST['showLinkStore'],
			"showLinkVideo" => $_POST['showLinkVideo'],
			"business_city" => $_POST['business_city']
		);

		$upid  = $pb->update($business_profiledata, "WHERE spprofiles_idspProfiles =" . $_POST["spprofiles_idspProfiles"]);

		echo trim($upid);
		//header('location: $BaseUrl/my-profile/');
?>

<?php
	} else if ($_POST["spProfileType_idspProfileType"] == 2) {

		//echo "<pre>";
		//print_r($_POST);die('==========');

		$freelancer_profiledata = array(
			"spprofiles_idspProfiles" => $_POST["spprofiles_idspProfiles"],
			"profiletype" => $_POST["profiletype"],
			"hourlyrate" => $_POST["hourlyrate"],
			"skill" => $_POST["skill"],
			"certification" => $_POST["certification"],
			"projectworked" => $_POST["projectworked"],
			"workinginterests" => $_POST["workinginterests"],
			"availablefrom" => $_POST["availablefrom"],
			"reference" => $_POST["reference"],
			"personalwebsite" => $_POST["personalwebsite"],
			"languagefluency" => $_POST["languagefluency"],
			"spProfileAbout" => $_POST["spProfileAbout"],
			"spProfileeducation" => $_POST["Education"],
			"overview" => $_POST["Overview"],
			"experience" => $_POST["Experience"]
		);

		$id  = $pf->update($freelancer_profiledata, "WHERE spprofiles_idspProfiles =" . $_POST["spprofiles_idspProfiles"]);
		echo trim($id);
		$em->removeedu($_POST["idspProfiles"]);



		$count = count($_POST['school']);

		for ($i = 0; $i < $count; $i++) {

			if ($_POST["school"][$i] == "" || $_POST["empdegree"][$i] == "" || $_POST["study"][$i] == "" || $_POST["year"][$i] == "") {
				continue;
			}

			$emp_tttprofiledata = array(
				"school" => $_POST["school"][$i],
				"empdegree" => $_POST["empdegree"][$i],
				"study" => $_POST["study"][$i],
				"year" => $_POST["year"][$i],
				"spProfileType_idspProfileType" => $_POST["spProfileType_idspProfileType"],
				"idspProfiles" => $_POST["idspProfiles"],
				"spUser_idspUser" => $_POST["spUser_idspUser"]
			);

			$emp = new  _spemployment_profile;
			$emp->createEmpEdu($emp_tttprofiledata);
		}

		//header('location:base_url()/my-profile');

	} else if ($_POST["spProfileType_idspProfileType"] == 3) {

		$professional_profiledata = array(
			"spprofiles_idspProfiles" => $_POST["spprofiles_idspProfiles"],
			"category" => $_POST["category"],
			"highlights" => $_POST["highlights"],
			"details" => $_POST["details"],
			"spProfileWebsite" => $_POST["spProfileWebsite"],

			"spProfileAbout" => $_POST["spProfileAbout"],
			"spProfileeducation" => $_POST["Education"],
			"sphobbies" => $_POST["sphobbies"],
			"sptags" => $_POST["tag"],
			"spCertification" => $_POST["certification"],
			"splanguagefluency" => $_POST["languagefluency"],
			"spExperience" => $_POST["Experience"]
		);


		//print_r($professional_profiledata);

		$id  = $ps->update($professional_profiledata, "WHERE spprofiles_idspProfiles =" . $_POST["spprofiles_idspProfiles"]);
		echo trim($id);

		$em->removeedu($_POST["idspProfiles"]);



		$count = count($_POST['school']);

		for ($i = 0; $i < $count; $i++) { //die("--------------------");

			if ($_POST["school"][$i] == "" || $_POST["empdegree"][$i] == "" || $_POST["study"][$i] == "" || $_POST["year"][$i] == "") {
				continue;
			}

			$emp_tttprofiledata = array(
				"school" => $_POST["school"][$i],
				"empdegree" => $_POST["empdegree"][$i],
				"study" => $_POST["study"][$i],
				"year" => $_POST["year"][$i],
				"spProfileType_idspProfileType" => $_POST["spProfileType_idspProfileType"],
				"idspProfiles" => $_POST["idspProfiles"],
				"spUser_idspUser" => $_POST["spUser_idspUser"]
			);

			$emp = new  _spemployment_profile;
			$emp->createEmpEdu($emp_tttprofiledata);
		}
	} else if ($_POST["spProfileType_idspProfileType"] == 5) {


		//idspProfiles: 1613
		//spUser_idspUser: 1336
		//spProfileType_idspProfileType: 5

		//print_r($_POST["profile_status"]);
		if ($_POST["spPostingEducationLevel"] == 'highschool') {
			$_POST["degree"] = "";
			$_POST["college"] = "";
			$_POST["university"] = "";
		}
		$emp_profiledata = array(
			"spprofiles_idspProfiles" => $_POST["spprofiles_idspProfiles"],

			"college" => $_POST["college"],
			"university" => $_POST["university"],
			"experience" => $_POST["experience"],
			"degree" => $_POST["degree"],
			"percentage" => $_POST["percentage"],
			"spPostingJobType" => $_POST["spPostingJobType"],
			"graduate" => $_POST["graduate"],
			"profilePublicaly" => $_POST["profilePublicaly"],
			"skill" => $_POST["skill"],
			"reference" => $_POST["reference"],
			"achievements" => $_POST["achievements"],
			"hobbies" => $_POST["hobbies"],
			"certification" => $_POST["certification"],
			"profile_status" => $_POST["profile_status"],
			"spProfileAbout" => $_POST["spProfileAbout"],
			"profile_tagline" => $_POST["jobSeekProfileTagline"],
			"education_level" => $_POST["spPostingEducationLevel"]
		);
		//print_r($emp_profiledata);

		$id  = $em->update($emp_profiledata, "WHERE spprofiles_idspProfiles =" . $_POST["spprofiles_idspProfiles"]);
		//	echo trim($id);

		$em->removeedu($_POST["idspProfiles"]);



		$count = count($_POST['school']);

		for ($i = 0; $i < $count; $i++) {

			if ($_POST["school"][$i] == "" || $_POST["empdegree"][$i] == "" || $_POST["study"][$i] == "" || $_POST["year"][$i] == "") {
				continue;
			}

			$emp_tttprofiledata = array(
				"school" => $_POST["school"][$i],
				"empdegree" => $_POST["empdegree"][$i],
				"study" => $_POST["study"][$i],
				"year" => $_POST["year"][$i],
				"spProfileType_idspProfileType" => $_POST["spProfileType_idspProfileType"],
				"idspProfiles" => $_POST["idspProfiles"],
				"spUser_idspUser" => $_POST["spUser_idspUser"]
			);



			$emp = new  _spemployment_profile;
			$emp->createEmpEdu($emp_tttprofiledata);
		}

		//$emp = new  _spemployment_profile;
		//$emp->removeexp($_POST["idspProfiles"]);
		//$count2 = count($_POST['company']);

		/*	for($i=0; $i<$count2; $i++){
if($_POST["jobtitle"][$i]=="" || $_POST["company"][$i]=="" || $_POST["city"][$i]=="" || $_POST["description"][$i]==""){
	continue;
}

$empexp= array( 
"jobtitle" =>$_POST["jobtitle"][$i],  
"company"=>$_POST["company"][$i],
"city"=>$_POST["city"][$i],
"fromdate"=>$_POST["fromdate"][$i],
"todate"=>$_POST["todate"][$i],
"idspProfiles"=>$_POST["idspProfiles"],
"description"=>$_POST["description"][$i],
"spProfileType_idspProfileType"=>$_POST["spProfileType_idspProfileType"]
);	



$emp = new  _spemployment_profile;
$emp->createEmpExp($empexp);

} */

		header('location:$BaseUrl/my-profile');
	} else if ($_POST["spProfileType_idspProfileType"] == 6) {
		$family_profiledata = array(
			"spprofiles_idspProfiles" => $_POST["spprofiles_idspProfiles"],

			"interested" => $_POST["interested"],
			"idealrelationship" => $_POST["idealrelationship"],
			"carrer" => $_POST["carrer"],
			"spProfileAbout" => $_POST["spProfileAbout"],
			"age_group" => $_POST['agegroup_'],
			"choice" => $_POST['choice_'],
			"spProfileAbout" => $_POST["Myself"],
			"location" => $_POST['location_']
		);

		$id  = $fm->update($family_profiledata, "WHERE spprofiles_idspProfiles =" . $_POST["spprofiles_idspProfiles"]);
		echo trim($id);
	}
} else {

	if ($_POST["spProfileType_idspProfileType"] == 1) {

		// print_r($profiledata);
		$userId = $p->create($profiledata);

		//echo $p->ta->sql;             
		if ($_POST["spProfileType_idspProfileType"] == 1) {
			$data = array(
				"spprofiles_idspProfiles" => $userId,
				"companyname" => $_POST["companyname"],
				"skill" => $_POST["skill"],
				"companyEmail" => $_POST["companyEmail"],
				"companyPhoneNo" => $_POST["companyPhoneNo"],
				"companyExtNo" => $_POST["companyExtNo"],
				"businesscategory" => $_POST["businesscategory"],
				"companytagline" => $_POST["companytagline"],
				"companyProductService" => $_POST["companyProductService"],
				"BussinessOverview" => $_POST["BussinessOverview"],
				"languageSpoken" => $_POST["languageSpoken"],
				"CompanySize" => $_POST["CompanySize"],
				"cmpyRevenue" => $_POST["cmpyRevenue"],
				"yearFounded" => $_POST["yearFounded"],
				"CompanyOwnership" => $_POST["CompanyOwnership"],
				"CompanyWebsite" => $_POST["CompanyWebsite"],
				"operatinghours" => $_POST["operatinghours"],
				"stockSymbol" => $_POST["stockSymbol"],
				"cmpnyStockLink" => $_POST["cmpnyStockLink"],
				"spDynamicWholesell" => $_POST["spDynamicWholesell"],
				"companyaddress" => $_POST["companyaddress"],
				"spProfilesAboutStore" => $_POST["spProfilesAboutStore"],
				"spshippingtext" => $_POST["spshippingtext"],
				"spProfilerefund" => $_POST["spProfilerefund"],
				"spProfilepolicy" => $_POST["spProfilepolicy"],


				"business_city" => $_POST['business_city']
			);

			$pb = new _spbusiness_profile;
			$pid = $pb->create($data);

			echo trim($userId);
		}
	} else if ($_POST["spProfileType_idspProfileType"] == 2) {
		$userId = $p->create($profiledata);

		if ($_POST["spProfileType_idspProfileType"] == 2) {

			$data = array(
				"spprofiles_idspProfiles" => $userId,

				"profiletype" => $_POST["profiletype"],
				"hourlyrate" => $_POST["hourlyrate"],
				"skill" => $_POST["skill"],
				"certification" => $_POST["certification"],
				"projectworked" => $_POST["projectworked"],
				"workinginterests" => $_POST["workinginterests"],
				"availablefrom" => $_POST["availablefrom"],
				"reference" => $_POST["reference"],
				"personalwebsite" => $_POST["personalwebsite"],
				"languagefluency" => $_POST["languagefluency"],
				"spProfileAbout" => $_POST["spProfileAbout"],
				"spProfileeducation" => $_POST["Education"],
				"overview" => $_POST["Overview"],
				"experience" => $_POST["Experience"]
			);

			$pf = new _spfreelancer_profile;
			$pid = $pf->create($data);
			echo trim($userId);
		}

		$count = count($_POST['school']);

		for ($i = 0; $i < $count; $i++) {

			if ($_POST["school"][$i] == "" || $_POST["empdegree"][$i] == "" || $_POST["study"][$i] == "" || $_POST["year"][$i] == "") {
				continue;
			}

			$emp_tttprofiledata = array(
				"school" => $_POST["school"][$i],
				"empdegree" => $_POST["empdegree"][$i],
				"study" => $_POST["study"][$i],
				"year" => $_POST["year"][$i],
				"spProfileType_idspProfileType" => $_POST["spProfileType_idspProfileType"],
				"idspProfiles" => $userId,
				"spUser_idspUser" => $_POST["spUser_idspUser"]
			);

			$emp = new  _spemployment_profile;
			$emp->createEmpEdu($emp_tttprofiledata);
		}
	} else if ($_POST["spProfileType_idspProfileType"] == 3) {
		$userId = $p->create($profiledata);
		if ($_POST["spProfileType_idspProfileType"] == 3) {

			$data = array(
				"spprofiles_idspProfiles" => $userId,

				"category" => $_POST["category"],
				"highlights" => $_POST["highlights"],
				"details" => $_POST["details"],
				"spProfileWebsite" => $_POST["spProfileWebsite"],
				"spProfileAbout" => $_POST["spProfileAbout"],
				"sphobbies" => $_POST["sphobbies"],
				"sptags" => $_POST["tag"],
				"spCertification" => $_POST["certification"],
				"splanguagefluency" => $_POST["languagefluency"],
				"spExperience" => $_POST["Experience"]


			);

			$ps = new _spprofessional_profile;
			$pid = $ps->create($data);
			echo trim($userId);

			$count = count($_POST['school']);

			for ($i = 0; $i < $count; $i++) { //die("--------------------");

				if ($_POST["school"][$i] == "" || $_POST["empdegree"][$i] == "" || $_POST["study"][$i] == "" || $_POST["year"][$i] == "") {
					continue;
				}

				$emp_tttprofiledata = array(
					"school" => $_POST["school"][$i],
					"empdegree" => $_POST["empdegree"][$i],
					"study" => $_POST["study"][$i],
					"year" => $_POST["year"][$i],
					"spProfileType_idspProfileType" => $_POST["spProfileType_idspProfileType"],
					"idspProfiles" => $userId,
					"spUser_idspUser" => $_POST["spUser_idspUser"]
				);

				$emp = new  _spemployment_profile;
				$emp->createEmpEdu($emp_tttprofiledata);
			}
		}
	} else if ($_POST["spProfileType_idspProfileType"] == 5) {
		$userId = $p->create($profiledata);
		if ($_POST["spPostingEducationLevel"] == 'highschool') {
			$_POST["degree"] = "";
			$_POST["college"] = "";
			$_POST["university"] = "";
		}
		if ($_POST["spProfileType_idspProfileType"] == 5) {
			$data = array(
				"spprofiles_idspProfiles" => $userId,
				"college" => $_POST["college"],
				"university" => $_POST["university"],
				"experience" => $_POST["experience"],
				"degree" => $_POST["degree"],
				"percentage" => $_POST["percentage"],
				"spPostingJobType" => $_POST["spPostingJobType"],
				"graduate" => $_POST["graduate"],
				"profilePublicaly" => $_POST["profilePublicaly"],
				"skill" => $_POST["skill"],
				"reference" => $_POST["reference"],
				"achievements" => $_POST["achievements"],
				"hobbies" => $_POST["hobbies"],
				"certification" => $_POST["certification"],
				"profile_status" => $_POST["profile_status"],
				"spProfileAbout" => $_POST["spProfileAbout"],
				"profile_tagline" => $_POST["jobSeekProfileTagline"],
				"education_level" => $_POST["spPostingEducationLevel"]
			);
			$em = new _spemployment_profile;
			$pid = $em->create($data);
			echo trim($userId);
		}
	} else if ($_POST["spProfileType_idspProfileType"] == 6) {

		$userId = $p->create($profiledata);




		if ($_POST["spProfileType_idspProfileType"] == 6) {

			$data = array(
				"spprofiles_idspProfiles" => $userId,

				"interested" => $_POST["interested"],
				"idealrelationship" => $_POST["idealrelationship"],
				"carrer" => $_POST["carrer"],
				"spProfileAbout" => $_POST["Myself"],
				"age_group" => $_POST['agegroup_'],
				"choice" => $_POST['choice_'],
				"location" => $_POST['location_']
			);
			$fm = new _spfamily_profile;
			$pid = $fm->create($data);
			echo trim($userId);
		}
	} else {
		$_POST['spProfilesDob'] = $currentUserDob;
		$pid = $p->create($_POST);
		echo trim($pid);
	}
}
