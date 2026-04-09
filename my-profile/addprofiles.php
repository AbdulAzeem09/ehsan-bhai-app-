<?php
 // print_r($_POST);die('==========');
session_start();
include('../univ/baseurl.php');
function sp_autoloader($class)
{
    include '../mlayer/' . $class . '.class.php';
}

require_once "../common.php";

spl_autoload_register("sp_autoloader");

sessionCheck();

$pb = new  _spbusiness_profile;
$media = new _postingalbum;
$p = new _spprofiles;
$pf = new  _spfreelancer_profile;
$ps = new  _spprofessional_profile;
$em = new _spemployment_profile;
$fm = new _spfamily_profile;

$u = new _spuser;

//print_r($_FILES);die('======');     

$spProfileTypeidspProfileType = isset($_POST["spProfileType_idspProfileType"]) ? (int) $_POST["spProfileType_idspProfileType"] : 0;
$spprofiles_idspProfiles = isset($_POST["spprofiles_idspProfiles"]) ? (int) $_POST["spprofiles_idspProfiles"] : 0;
// Get User DOB.
$getCurrentUser = $u->read($_SESSION['uid']);
if ($getCurrentUser != false && mysqli_num_rows($getCurrentUser) > 0) {
    $currentUserArray = mysqli_fetch_assoc($getCurrentUser);
    $currentUserDob = $currentUserArray["spUserDob"];
}



if($_SESSION['profile_pic']){
    $profiledata = array(
        "spUser_idspUser" => $_SESSION['uid'],
        "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
        "spProfileName" => htmlspecialchars($_POST["spProfileName"]),
        "spProfileEmail" => $_POST["spProfileEmail"],
        "email_status" => $_POST["email_status"],
        "profile_status" => $_POST["profile_status"],
        "address" => htmlspecialchars($_POST["address"]),
        "latitude" => $_POST["latitude"],
        "longitude" => $_POST["longitude"],
        "spProfilePhone" => $_POST["spProfilePhone"],
        "phone_status" => $_POST["phone_status"],
        "spProfilesDob" => $currentUserDob,
        "spProfilePostalCode" => htmlspecialchars($_POST["spProfilePostalCode"]),
        "relationship_status" => $_POST["relationship_status"],
        "spProfilesCountry" => $_POST["spUserCountry"],
        "spProfilesState" => $_POST["spUserState"],
        "spProfilesCity" => $_POST["spUserCity"],
        "spUserzipcode" => htmlspecialchars($_POST["spProfilePostalCode"]),
        "store_name" => $_POST["spDynamicWholesell"],
        "date_of_birth" => $_POST["dob_"],
        "spProfilePic" => $_SESSION['profile_pic'],
        "spProfilesDefault" => 1

    );
}else{

    $profiledata = array(
        "spUser_idspUser" => $_SESSION['uid'],
        "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
        "spProfileName" => htmlspecialchars($_POST["spProfileName"]),
        "spProfileEmail" => $_POST["spProfileEmail"],
        "email_status" => $_POST["email_status"],
        "profile_status" => $_POST["profile_status"],
        "address" => htmlspecialchars($_POST["address"]),
        "latitude" => $_POST["latitude"],
        "longitude" => $_POST["longitude"],
        "spProfilePhone" => $_POST["spProfilePhone"],
        "phone_status" => $_POST["phone_status"],
        "spProfilesDob" => $currentUserDob,
        "spProfilePostalCode" => htmlspecialchars($_POST["spProfilePostalCode"]),
        "relationship_status" => $_POST["relationship_status"],
        "spProfilesCountry" => $_POST["spUserCountry"],
        "spProfilesState" => $_POST["spUserState"],
        "spProfilesCity" => $_POST["spUserCity"],
        "spUserzipcode" => htmlspecialchars($_POST["spProfilePostalCode"]),
        "store_name" => $_POST["spDynamicWholesell"],
        "date_of_birth" => $_POST["dob_"],
        "spProfilesDefault" => 1
        
        
    );
}


unset($_SESSION['profile_pic']);

if ($_POST["spUser_idspUser"] != "") {
    if ($spProfileTypeidspProfileType == 4) {


        if(!empty($_POST["memberrelation"][0])){

            $personal_profiledata = array(
                "tag" => $_POST["tag"],
                "memberrelation" => $_POST["memberrelation"],
                "personal_PhoneNo" => $_POST["personal_PhoneNo"],
                "relationship_status" => $_POST["relationship_status"],
                "spDynamicWholesell" => $_POST["spDynamicWholesell"],
                "date_of_birth" => $_POST["dob_"],
                "category" => $_POST["category"],
                "highlights" => $_POST["highlights"],
                "languagefluency" => $_POST["languagefluency"],
                "sphobbies" => $_POST["sphobbies"],
                "Education" => $_POST["Education"],
                "spProfileAbout" => $_POST["spProfileAbout"]
            );
        }
        else {

            $personal_profiledata = array(
                "tag" => $_POST["tag"],
                "personal_PhoneNo" => $_POST["personal_PhoneNo"],
                "relationship_status" => $_POST["relationship_status"],
                "spDynamicWholesell" => $_POST["spDynamicWholesell"],
                "date_of_birth" => $_POST["dob_"],
                "category" => $_POST["category"],
                "highlights" => $_POST["highlights"],
                "languagefluency" => $_POST["languagefluency"],
                "sphobbies" => $_POST["sphobbies"],
                "Education" => $_POST["Education"],
                "spProfileAbout" => $_POST["spProfileAbout"]
            ); 
        }

        $id  = $u->updatepersonal($personal_profiledata, $_SESSION['uid']);
        echo trim($id);
//echo "2222";
    }
//header('location: $BaseUrl/my-profile/');
}


if ($_POST["idspProfiles"] != "") {
    
    $_POST["idspProfiles"] = (int)trim($_POST["idspProfiles"]);
    $p->updateProfiles($profiledata, "WHERE t.idspProfiles =" . $_POST["idspProfiles"]);
//echo $p->sql; 
//die("2324");

    if ($spProfileTypeidspProfileType == 1) {
      

       
    // echo $_POST["companyPhoneNo"];
    // echo $_POST["companyExtNo"];
       if(isset($_POST["companyExtNo"]) && isset($_POST["companyPhoneNo"])){
         $ar= explode($_POST["companyExtNo"],$_POST["companyPhoneNo"]);
         echo $co=count($ar);
         if($co==1){
           echo "Yes";
         }
         else{
           echo $_POST["companyPhoneNo"] =    str_replace($_POST["companyExtNo"],'',$_POST["companyPhoneNo"]);
         }
       }


//  die("======123=======");

//  if(strpos($_POST["companyPhoneNo"], $_POST["companyExtNo"]) !== false){
//  $_POST["companyPhoneNo"] =    str_replace($_POST["companyExtNo"], '',$_POST["companyPhoneNo"]);
// }

     $businessarray = $_POST["businesscategory"];
     $delimiter = ",";
     $businesscategory = implode($delimiter, $businessarray);


     $business_profiledata = array(
        "spprofiles_idspProfiles" => $_POST["idspProfiles"],
        "companyname" => $_POST["companyname"],
        "skill" => $_POST["skill"],
        "companyEmail" => $_POST["companyEmail"],
        "companyPhoneNo" =>$_POST["companyPhoneNo"],
        "companyExtNo" => $_POST["companyExtNo"],
        "businesscategory" => $businesscategory,
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
//"date_of_birth" => $_POST["dob_"],
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
//print_r($business_profiledata); die('-----------');
     $pb->update($business_profiledata, "WHERE spprofiles_idspProfiles =" . $_POST["idspProfiles"]);
     echo trim($_POST["idspProfiles"]);
//header('location: $BaseUrl/my-profile/');

 } else if(isset($spProfileTypeidspProfileType) && $spProfileTypeidspProfileType == 2) {
        // Check if all required fields are set
       $freelancer_profiledata = array(
                "spprofiles_idspProfiles" =>$spprofiles_idspProfiles,
                "profiletype" => isset($_POST["profiletype"]) ? $_POST["profiletype"] : "",
                "hourlyrate" => isset($_POST["hourlyrate"]) ? $_POST["hourlyrate"] : "",
                "skill" => isset($_POST["skill"]) ? $_POST["skill"] : "",
                "certification" => isset($_POST["certification"]) ? $_POST["certification"] : "",
                "projectworked" => isset($_POST["projectworked"]) ? $_POST["projectworked"] : "",
                "workinginterests" => isset($_POST["workinginterests"]) ? $_POST["workinginterests"] : "",
                "availablefrom" => isset($_POST["availablefrom"]) ? $_POST["availablefrom"] : "",
                "reference" => isset($_POST["reference"]) ? $_POST["reference"] : "",
                "personalwebsite" => isset($_POST["personalwebsite"]) ? $_POST["personalwebsite"] : "",
                "languagefluency" => isset($_POST["languagefluency"]) ? $_POST["languagefluency"] : "",
                "spProfileAbout" => isset($_POST["spProfileAbout"]) ? $_POST["spProfileAbout"] : "",
                "spProfileeducation" => isset($_POST["Education"]) ? $_POST["Education"] : "",
                "overview" => isset($_POST["Overview"]) ? $_POST["Overview"] : "",
                "experience" => isset($_POST["Experience"]) ? $_POST["Experience"] : "",
                "Experience_detail" => isset($_POST["content"]) ? $_POST["content"] : "",
            );
        
    $id  = $pf->update($freelancer_profiledata, "WHERE spprofiles_idspProfiles =" . $spprofiles_idspProfiles);
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
            "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
            "idspProfiles" => $_POST["idspProfiles"],
            "spUser_idspUser" => $_SESSION['uid']
        );

        $emp = new  _spemployment_profile;
        $emp->createEmpEdu($emp_tttprofiledata);
    }

//header('location:base_url()/my-profile');

} else if ($spProfileTypeidspProfileType == 3) {
 

    $professional_profiledata = array(
        "spprofiles_idspProfiles" => $spprofiles_idspProfiles,
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


    $id  = $ps->update($professional_profiledata, "WHERE spprofiles_idspProfiles =" . $spprofiles_idspProfiles);
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
    "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
    "idspProfiles" => $_POST["idspProfiles"],
    "spUser_idspUser" => $_SESSION['uid']
);

$emp = new  _spemployment_profile;
$emp->createEmpEdu($emp_tttprofiledata);
}
}

else if ($spProfileTypeidspProfileType == 5) {


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
        "spprofiles_idspProfiles" => $spprofiles_idspProfiles,
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

    
    $id  = $em->update($emp_profiledata, "WHERE spprofiles_idspProfiles =" . $spprofiles_idspProfiles);
//	echo trim($id);

    $pid = isset($_POST["idspProfiles"]) ? (int)$_POST["idspProfiles"] : 0;
    if($pid){
      $em->removeedu($pid);
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
        "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
        "idspProfiles" => $_POST["idspProfiles"],
        "spUser_idspUser" => $_SESSION['uid'],

    );



    $emp = new  _spemployment_profile;
    $emp->createEmpEdu($emp_tttprofiledata);
}




header('location:$BaseUrl/my-profile');
} 



else if ($spProfileTypeidspProfileType == 6) {
   // die("======44444444444444444444=======");

//die('++++11');
    $family_profiledata = array(
        "spprofiles_idspProfiles" => $spprofiles_idspProfiles,

        "interested" => $_POST["interested"],
        "idealrelationship" => $_POST["idealrelationship"],
        "carrer" => $_POST["carrer"],
        "spProfileAbout" => $_POST["spProfileAbout"],
        "age_group" => $_POST['agegroup_'],
        "choice" => $_POST['choice_'],
        "spProfileAbout" => $_POST["Myself"],
        "location" => $_POST['location_']
    );

    $id  = $fm->update($family_profiledata, "WHERE spprofiles_idspProfiles =" . $spprofiles_idspProfiles);
    echo trim($id);


    $fm = new _spfamily_profile;

    $aa = $fm->delete_family($spprofiles_idspProfiles);

    $count=count($_POST['Capacity_add']);
    for($i=0;$i<$count;$i++){

        $data_2 = array(

            "pid" => $_SESSION['pid'],
            "uid" => $_SESSION['uid'],
            "family_name" => $_POST['Ticket_Type_add'][$i],
            "family_relation" => $_POST['Capacity_add'][$i],
            "family_id" =>$spprofiles_idspProfiles,

        );


        $last_id = $fm->create_family($data_2);

    }


}
} else {

   // die("Truehhhhhhhhhhhhh");

    insertQ('UPDATE spprofiles  SET spProfilesDefault = ? WHERE spUser_idspUser = ?', 'ii', [0, $_SESSION['uid']]);

    if ($spProfileTypeidspProfileType == 1) {
//echo "111111111";
// print_r($profiledata);
        $userId = $p->create($profiledata);

//echo $p->ta->sql;             
        if ($spProfileTypeidspProfileType == 1) {
 // echo "222222222";

            $string_version = implode(',', $_POST["businesscategory"]);


            $data_business = [];
            $data_business[] = isset($userId) ? (int) trim($userId) : 0;
            $data_business[] = isset($_POST["companyname"]) ? htmlspecialchars(trim($_POST["companyname"])) : '';
            $data_business[] = isset($_POST["skill"]) ? htmlspecialchars(trim($_POST["skill"])) : '';
            $data_business[] = isset($_POST["companyEmail"]) ? htmlspecialchars(trim($_POST["companyEmail"])) : '';
            $data_business[] = isset($_POST["companyPhoneNo"]) ? htmlspecialchars(trim($_POST["companyPhoneNo"])) : '';
            $data_business[] = isset($_POST["companyExtNo"]) ? trim($_POST["companyExtNo"]) : '';
            $data_business[] = $string_version;
            $data_business[] = isset($_POST["companytagline"]) ? htmlspecialchars(trim($_POST["companytagline"])) : '';
            $data_business[] = isset($_POST["companyProductService"]) ? htmlspecialchars(trim($_POST["companyProductService"])) : '';
            $data_business[] = isset($_POST["BussinessOverview"]) ? htmlspecialchars(trim($_POST["BussinessOverview"])) : '';
            $data_business[] = isset($_POST["languageSpoken"]) ? trim($_POST["languageSpoken"]) : '';
            $data_business[] = isset($_POST["CompanySize"]) ? trim($_POST["CompanySize"]) : '';
            $data_business[] = isset($_POST["cmpyRevenue"]) ? htmlspecialchars(trim($_POST["cmpyRevenue"])) : '';
            $data_business[] = isset($_POST["yearFounded"]) ? trim($_POST["yearFounded"]) : '';
            $data_business[] = isset($_POST["CompanyOwnership"]) ? trim($_POST["CompanyOwnership"]) : '';
            $data_business[] = isset($_POST["CompanyWebsite"]) ? htmlspecialchars(trim($_POST["CompanyWebsite"])) : '';
            $data_business[] = isset($_POST["operatinghours"]) ? trim($_POST["operatinghours"]) : '';
            $data_business[] = isset($_POST["stockSymbol"]) ? htmlspecialchars(trim($_POST["stockSymbol"])) : '';
            $data_business[] = isset($_POST["cmpnyStockLink"]) ? htmlspecialchars(trim($_POST["cmpnyStockLink"])) : '';
            $data_business[] = isset($_POST["spDynamicWholesell"]) ? htmlspecialchars(trim($_POST["spDynamicWholesell"])) : '';
            $data_business[] = isset($_POST["companyaddress"]) ? htmlspecialchars(trim($_POST["companyaddress"])) : '';
            $data_business[] = isset($_POST["spProfilesAboutStore"]) ? htmlspecialchars(trim($_POST["spProfilesAboutStore"])) : '';
            $data_business[] = isset($_POST["spshippingtext"]) ? htmlspecialchars(trim($_POST["spshippingtext"])) : '';
            $data_business[] = isset($_POST["spProfilerefund"]) ? htmlspecialchars(trim($_POST["spProfilerefund"])) : '';
            $data_business[] = isset($_POST["spProfilepolicy"]) ? htmlspecialchars(trim($_POST["spProfilepolicy"])) : '';
            $data_business[] = isset($_POST["business_city"]) ? trim($_POST["business_city"]) : '';

  //$pb = new _spbusiness_profile;
  //$pid = $pb->create($data_business);
            insertQ('insert into spbusiness_profile (spprofiles_idspProfiles, companyname, skill, companyEmail, companyPhoneNo, companyExtNo, businesscategory, companytagline, companyProductService, BussinessOverview, languageSpoken, CompanySize, cmpyRevenue, yearFounded, CompanyOwnership, CompanyWebsite, operatinghours, stockSymbol, cmpnyStockLink, spDynamicWholesell, companyaddress, spProfilesAboutStore, spshippingtext, spProfilerefund, spProfilepolicy, business_city) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 'isssssssssssssssssssssssss', $data_business);

            echo trim($userId);
        }
    } else if ($spProfileTypeidspProfileType == 2) {
        $userId = $p->create($profiledata);
        $imploded_array = '';
        if(isset($spProfileTypeidspProfileType) && $spProfileTypeidspProfileType == 2) {
               $data = array(
                "spprofiles_idspProfiles" =>$spprofiles_idspProfiles,
                "profiletype" => isset($_POST["profiletype"]) ? $_POST["profiletype"] : "",
                "hourlyrate" => isset($_POST["hourlyrate"]) ? $_POST["hourlyrate"] : "",
                "skill" => isset($_POST["skill"]) ? $_POST["skill"] : "",
                "certification" => isset($_POST["certification"]) ? $_POST["certification"] : "",
                "projectworked" => isset($_POST["projectworked"]) ? $_POST["projectworked"] : "",
                "workinginterests" => isset($_POST["workinginterests"]) ? $_POST["workinginterests"] : "",
                "availablefrom" => isset($_POST["availablefrom"]) ? $_POST["availablefrom"] : "",
                "reference" => isset($_POST["reference"]) ? $_POST["reference"] : "",
                "personalwebsite" => isset($_POST["personalwebsite"]) ? $_POST["personalwebsite"] : "",
                "languagefluency" => isset($_POST["languagefluency"]) ? $_POST["languagefluency"] : "",
                "spProfileAbout" => isset($_POST["spProfileAbout"]) ? $_POST["spProfileAbout"] : "",
                "spProfileeducation" => isset($_POST["Education"]) ? $_POST["Education"] : "",
                "overview" => isset($_POST["Overview"]) ? $_POST["Overview"] : "",
                "experience" => isset($_POST["Experience"]) ? $_POST["Experience"] : "",
                "Experience_detail" => isset($_POST["content"]) ? $_POST["content"] : "",
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
                "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
                "idspProfiles" => $userId,
                "spUser_idspUser" => $_SESSION['uid']
            );

            $emp = new  _spemployment_profile;
            $emp->createEmpEdu($emp_tttprofiledata);
        }
    } else if ($spProfileTypeidspProfileType == 3) {
        $userId = $p->create($profiledata);
        if ($spProfileTypeidspProfileType == 3) {


         
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
    "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
    "idspProfiles" => $userId,
    "spUser_idspUser" => $_SESSION['uid']
);

$emp = new  _spemployment_profile;
$emp->createEmpEdu($emp_tttprofiledata);
}
}
} else if ($spProfileTypeidspProfileType == 5) {
    $userId = $p->create($profiledata);
    if ($_POST["spPostingEducationLevel"] == 'highschool') {
        $_POST["degree"] = "";
        $_POST["college"] = "";
        $_POST["university"] = "";
    }
    if ($spProfileTypeidspProfileType == 5) {

        

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
                "spProfileType_idspProfileType" => $spProfileTypeidspProfileType,
                "idspProfiles" => $_POST["idspProfiles"],
                "spUser_idspUser" => $_SESSION['uid'],
                "spProfilePic" => $_POST["spProfilePic"]
            );



            $emp = new  _spemployment_profile;
            $emp->createEmpEdu($emp_tttprofiledata);
        }
    }




} else if ($spProfileTypeidspProfileType == 6) {

    $userId = $p->create($profiledata);




    if ($spProfileTypeidspProfileType == 6) {

       
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


//print_r($data);die('+++1111');
        $fm = new _spfamily_profile;
        $last_in_id = $fm->create($data);
        echo trim($userId);

        $count=count($_POST['Capacity_add']);
        for($i=0;$i<$count;$i++){

            $data_2 = array(

                "pid" => $_SESSION['pid'],
                "uid" => $_SESSION['uid'],
                "family_name" => $_POST['Ticket_Type_add'][$i],
                "family_relation" => $_POST['Capacity_add'][$i],
                "family_id" =>$userId,

            );

            $fm = new _spfamily_profile;
            $last_id = $fm->create_family($data_2);

        }



    }
} 




else if($_POST["spProfileType"]==5){




    $emp = new  _spemployment_profile;
    $emp->removeexp($_POST["idspProfiles"]);




    $empexp= array( 
        "jobtitle" =>$_POST["jobtitle"],  
        "company"=>$_POST["company"],
        "city"=>$_POST["city"],
        "start_date"=>$_POST["fromyear"],
        "idspProfiles"=>$_POST["idspProfiles"],
        "description"=>$_POST["description"],
        "spProfileType_idspProfileType"=>$spProfileTypeidspProfileType
    );	



    $emp = new  _spemployment_profile;
    $emp->createEmpExp($empexp);
    header('location:$BaseUrl/my-profile');

}




else {



    $_POST['spProfilesDob'] = $currentUserDob;
    $pid = $p->create($_POST);
    echo trim($pid);
}
}

