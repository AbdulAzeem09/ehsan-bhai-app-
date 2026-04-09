<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

class CreateProfile extends Base{
  /**
  * To get the business category list
  *
  **/
  public function businessCategoryList($id){
    $sql =  "SELECT * FROM masterdetails WHERE master_idmaster= ? ORDER BY masterDetails ASC";
    $params = [$id];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }
  
  public function readCountry(){
    $sql =  "SELECT * FROM tbl_country order by country_title asc";
    $out = selectQ($sql, "", []);
    return ['data' => $out];
  }
   public function carrerSector($id){
    $sql =  "SELECT * FROM subcategory  where subcategorystatus != '-7' and spcategories_idspcategory=? ORDER BY subCategoryTitle ASC";
    $params = [$id];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }

  

  public function getProfileResumes($pid){
    $sql = 'SELECT * FROM spboard_resumes AS t where pid = ? and resume_deleted = 0';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    if(!empty($out)){
      $out = $out;
    }
    return $out;
  }
  
  function getMonthNumber($monthName) {
    $months = ['Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05', 'Jun' => '06', 'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12'];
    return isset($months[$monthName]) ? $months[$monthName] : '';
  }

  public function postCreateprofiles(){
    $spProfileTypeidspProfileType = isset($_POST["spProfileType_idspProfileType"]) ? (int)$_POST["spProfileType_idspProfileType"] : 0;
    $maxCount = 0;
    if($spProfileTypeidspProfileType == 1){
      $maxCount = 5;
    }
    if($spProfileTypeidspProfileType == 2 || $spProfileTypeidspProfileType == 3){
      $maxCount = 2;
    }
    if($spProfileTypeidspProfileType == 4 || $spProfileTypeidspProfileType == 5 || $spProfileTypeidspProfileType == 6){
      $maxCount = 1;
    }
    $profileCount = $this->getUserProfileCount($_SESSION['uid'], $spProfileTypeidspProfileType);
    $userProfileCount = 0;
    if(isset($profileCount['data']) && isset($profileCount['data']['total_count'])){
      $userProfileCount = $profileCount['data']['total_count'];
    }
    if($userProfileCount >= $maxCount){
      errorOut("profile count reached maximum");
    }
    $arr = [
      $_SESSION['uid'],
      $spProfileTypeidspProfileType,
      isset($_POST["spProfileName"]) ? $_POST["spProfileName"] : '',
      isset($_POST["email_status"]) ? $_POST["email_status"] : '',
      isset($_POST["profile_status"]) ? "public" : "public",
      isset($_POST["address"]) ? $_POST["address"] : '',
      isset($_POST["phone_status"]) ? $_POST["phone_status"] : '',
      isset($_POST["spProfilePostalCode"]) ? $_POST["spProfilePostalCode"] : '',
      isset($_POST["spProfilesCountry"]) ? $_POST["spProfilesCountry"] : '',
      isset($_POST["spUserState"]) ? $_POST["spUserState"] : '',
      isset($_POST["spUserCity"]) ? $_POST["spUserCity"] : '',
      isset($_POST["spProfilePostalCode"]) ? $_POST["spProfilePostalCode"] : '', // spUserzipcode
      isset($_POST["spDynamicWholesell"]) ? $_POST["spDynamicWholesell"] : '',
      1, // spProfilesDefault
      $_SESSION['profile_pic'] ?? "", // Check if profile pic is set in session
    ];

    $postid = insertQ("INSERT INTO spprofiles (spUser_idspUser, spProfileType_idspProfileType, spProfileName, email_status, profile_status, address, phone_status, spProfilePostalCode, spProfilesCountry, spProfilesState, spProfilesCity, spUserzipcode, store_name, spProfilesDefault, spProfilePic) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",'iisssssssssssis', $arr);

    unset($_SESSION['profile_pic']);
    $albumb = [];
    $albumb[] = "Profine Image";
    $albumb[] = "Only for Profile Images";
    $albumb[] = $postid;
    $albumbid = insertQ("INSERT INTO sppostingalbum (spPostingAlbumName, spPostingAlbumDescription, spProfiles_idspProfiles) VALUES (?,?,?)", 'ssi', $albumb);

    if ($spProfileTypeidspProfileType == 2 || $spProfileTypeidspProfileType == 3 || $spProfileTypeidspProfileType == 5 ) {
      $educationData = [];
      for ($i = 0; isset($_POST["school_$i"]) && isset($_POST["empdegree_$i"]) && isset($_POST["study_$i"]) && isset($_POST["year_$i"]); $i++) {
        $educationData[] = [
          isset($_POST["school_$i"]) ? $_POST["school_$i"] : '',
          isset($_POST["empdegree_$i"]) ? $_POST["empdegree_$i"] : '',
          isset($_POST["study_$i"]) ? $_POST["study_$i"] : '',
          isset($_POST["year_$i"]) ? $_POST["year_$i"] : '',
          $spProfileTypeidspProfileType,
          isset($postid) ? (int)(trim($postid)) : '',
          $_SESSION['uid']
        ];
      }

      foreach ($educationData as $emp_edudata) {
        $fid = insertQ("INSERT INTO employment_education (school, empdegree, study, year, spProfileType_idspProfileType, idspProfiles, spUser_idspUser) VALUES (?, ?, ?, ?, ?, ?, ?)",'ssssiii',$emp_edudata);
      }

      $expData = [];

      for ($i = 0; isset($_POST["jobTitle_$i"]) && isset($_POST["companyName_$i"]); $i++) {
        $from_date = isset($_POST["startYear_$i"]) && isset($_POST["startMonth_$i"]) ? (int)$_POST["startYear_$i"] . '-' . $this->getMonthNumber(trim($_POST["startMonth_$i"])) . '-01' : null;
        $to_date = isset($_POST["endYear_$i"]) && isset($_POST["endMonth_$i"]) ? (int)$_POST["endYear_$i"] . '-' . $this->getMonthNumber(trim($_POST["endMonth_$i"])) . '-01' : null;
        $expData[] = [
          isset($_POST["jobTitle_$i"]) ? $_POST["jobTitle_$i"] : '',
          isset($_POST["companyName_$i"]) ? $_POST["companyName_$i"] : '',
          isset($_POST["country_$i"]) ? $_POST["country_$i"] : '',
          isset($_POST["state_$i"]) ? $_POST["state_$i"] : '',
          isset($_POST["city_$i"]) ? $_POST["city_$i"] : '',
          $from_date,
          $to_date,
          isset($_POST["startMonth_$i"]) ? $_POST["startMonth_$i"] : '',
          isset($_POST["startYear_$i"]) ? $_POST["startYear_$i"] : '',
          isset($_POST["endMonth_$i"]) ? $_POST["endMonth_$i"] : '',
          isset($_POST["endYear_$i"]) ? $_POST["endYear_$i"] : '',
          isset($_SESSION['uid']) ? $_SESSION['uid'] : null,
          isset($postid) ? (int) $postid : 0,
          isset($_POST["jobDescription_$i"]) ? htmlspecialchars(trim($_POST["jobDescription_$i"])) : '',
          $spProfileTypeidspProfileType,
          isset($_POST["employmentType_$i"]) ? $_POST["employmentType_$i"] : '',
          isset($_POST["isCurrentJob_$i"]) ? (int) $_POST["isCurrentJob_$i"] : 0,
        ];
      }

      foreach ($expData as $exp_data) {
        $expid = insertQ("INSERT INTO employment_experience (jobtitle, company, country, state, city, start_date, end_date, frommonth, fromyear, tomonth, toyear, idspProfiles, idsp_pid, description, spProfileType_idspProfileType, emptype, current_work) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 'ssssssssssssisssi', $exp_data);
      }

    }
    if ($spProfileTypeidspProfileType == 1) {
      $data_business = [];
      $categories = isset($_POST['businesscategory']) ? $_POST['businesscategory'] : [];
      $categories_string = implode(',', $categories);

      $data_business[] = isset($postid) ? (int) trim($postid) : 0;
      $data_business[] = isset($_POST["companyname"]) ? $_POST["companyname"] : '';
      $data_business[] = isset($_POST["skill"]) ? $_POST["skill"] : '';
      $data_business[] = isset($_POST["companyEmail"]) ? $_POST["companyEmail"] : '';
      $data_business[] = isset($_POST["companyPhoneNo"]) ? (int)trim($_POST["companyPhoneNo"]) : 0;
      $data_business[] = isset($_POST["companyExtNo"]) ? trim($_POST["companyExtNo"]) : '';
      $data_business[] = isset($_POST["companytagline"]) ? $_POST["companytagline"] : '';
      $data_business[] = isset($_POST["companyProductService"]) ? $_POST["companyProductService"] : '';
      $data_business[] = isset($_POST["BussinessOverview"]) ? $_POST["BussinessOverview"] : '';
      $data_business[] = isset($_POST["languageSpoken"]) ? trim($_POST["languageSpoken"]) : '';
      $data_business[] = isset($_POST["CompanySize"]) ? trim($_POST["CompanySize"]) : '';
      $data_business[] = isset($_POST["cmpyRevenue"]) ? $_POST["cmpyRevenue"] : '';
      $data_business[] = isset($_POST["yearFounded"]) ? (int)trim($_POST["yearFounded"]) : '';
      $data_business[] = isset($_POST["CompanyOwnership"]) ? trim($_POST["CompanyOwnership"]) : '';
      $data_business[] = isset($_POST["CompanyWebsite"]) ? $_POST["CompanyWebsite"] : '';
      $data_business[] = isset($_POST["operatinghours"]) ? trim($_POST["operatinghours"]) : '';
      $data_business[] = isset($_POST["stockSymbol"]) ? $_POST["stockSymbol"] : '';
      $data_business[] = isset($_POST["cmpnyStockLink"]) ? $_POST["cmpnyStockLink"] : '';
      $data_business[] = isset($_POST["spDynamicWholesell"]) ? $_POST["spDynamicWholesell"] : '';
      $data_business[] = isset($_POST["companyaddress"]) ? $_POST["companyaddress"] : '';
      $data_business[] = isset($_POST["spProfilesAboutStore"]) ? $_POST["spProfilesAboutStore"] : '';
      $data_business[] = isset($_POST["spshippingtext"]) ? $_POST["spshippingtext"] : '';
      $data_business[] = isset($_POST["spProfilerefund"]) ? $_POST["spProfilerefund"] : '';
      $data_business[] = isset($_POST["spProfilepolicy"]) ? $_POST["spProfilepolicy"] : '';
      $data_business[] = isset($_POST["business_city"]) ? trim($_POST["business_city"]) : '';
      $data_business[] = $categories_string;
      $data_business[] = isset($_POST["defaultbusiness"]) ? $_POST["defaultbusiness"] : 0;
      $data_business[] = isset($_POST["showEmailProfile"]) ? $_POST["showEmailProfile"] : 0;

      $businessid=insertQ('insert into spbusiness_profile (spprofiles_idspProfiles,companyname, skill, companyEmail, companyPhoneNo, companyExtNo, companytagline, companyProductService, BussinessOverview, languageSpoken, CompanySize, cmpyRevenue, yearFounded, CompanyOwnership, CompanyWebsite, operatinghours, stockSymbol, cmpnyStockLink, spDynamicWholesell, companyaddress, spProfilesAboutStore, spshippingtext, spProfilerefund, spProfilepolicy, business_city,businesscategory, defaultbusiness, showEmailProfile) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?)', 'isssssssssssssssssssssssssii', $data_business);

    
      return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $businessid]];
    }
    elseif ($spProfileTypeidspProfileType == 6) {
      // Extract family member data from $_POST
      $i = 0;
      $familyMembers = [];
      while (isset($_POST["memberName_$i"])) {
        $familyMembers[] = [
          "memberName" => $_POST["memberName_$i"],
          "relationType" => $_POST["relationType_$i"]
        ];
        $i++;
      }
      // Insert data into spfamily_profile table
      $spfamily_data = [
        $postid,
        isset($_POST["carrer"]) ? $_POST["carrer"] : '',
        isset($_POST["choice_"]) ? $_POST["choice_"] : ''
      ];
      $spfamily_id = insertQ("INSERT INTO spfamily_profile (spprofiles_idspProfiles, carrer, choice) VALUES (?, ?, ?)", 'iss', $spfamily_data);
      
      $sql = "SELECT spprofiles_idspProfiles FROM spfamily_profile WHERE id = ?";
      $params = [$spfamily_id];
      $result = selectQ($sql, "i", $params);

      if (!$result) {
        // Handle the error, e.g., return an error response or log it
        return ['format' => 'skipSuccess', 'data' => ['success' => 0, 'error' => 'Profile not found']];
      }
      $spprofiles_idspProfiles = $result[0]['spprofiles_idspProfiles'];
      if (!empty($familyMembers)) {
        foreach ($familyMembers as $member) {
          $family_data = [
            $postid,
            $_SESSION['uid'],
            $member['memberName'] ?? '',
            $member['relationType'] ?? '',
            $spprofiles_idspProfiles
          ];
        
          $family_id = insertQ("INSERT INTO add_family_relation (pid, uid, family_name, family_relation, family_id) VALUES (?, ?, ?, ?, ?)", 'iissi', $family_data);
        }
        return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $family_id]];
      } else {
        return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $spfamily_id]];
      }
    }
    else if ($spProfileTypeidspProfileType == 5) {
      $data_employee=[];
      $data_employee[] = isset($postid) ? (int) trim($postid) : 0;
      $data_employee[] = isset($_POST["spPostingJobType"]) ? $_POST["spPostingJobType"] : '';
      //$data_employee[] = isset($_POST["graduate"]) ? $_POST["graduate"] : '';
      //$data_employee[] = isset($_POST["profilePublicaly"]) ? $_POST["profilePublicaly"] : '';             
      $data_employee[] = isset($_POST["skill"]) ? $_POST["skill"] : '';
      $data_employee[] = isset($_POST["reference"]) ? $_POST["reference"] : '';
      $data_employee[] = isset($_POST["achievements"]) ? $_POST["achievements"] : '';
      $data_employee[] = isset($_POST["hobbies"]) ? $_POST["hobbies"] : '';
      $data_employee[] = isset($_POST["certification"]) ? $_POST["certification"] : '';
      $data_employee[] = isset($_POST["profile_status"]) ? $_POST["profile_status"] : '';
      //$data_employee[] = isset($_POST["spProfileAbout"]) ? $_POST["spProfileAbout"] : '';
      $data_employee[] = isset($_POST["jobSeekProfileTagline"]) ? $_POST["jobSeekProfileTagline"] : '';
      $data_employee[] = isset($_POST["spPostingEducationLevel"]) ? $_POST["spPostingEducationLevel"] : '';
      $data_employee[] = isset($_POST["language_fluency"]) ? $_POST["language_fluency"] : '';      

      $emp_id = insertQ("INSERT INTO spemployment_profile (spprofiles_idspProfiles, spPostingJobType, skill, reference, achievements, hobbies, certification, profile_status, profile_tagline, education_level,language_fluency) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)", 'issssssssss', $data_employee);
      
      return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $emp_id]];
     
    }
    elseif($spProfileTypeidspProfileType == 3) {

      $data_profession = [];
      $data_profession[] = isset($postid) ? (int) trim($postid) : 0;
      $data_profession[] = isset($_POST["careerCategory"]) ? $_POST["careerCategory"] : '';
      $data_profession[] = isset($_POST["careerHighlights"]) ? $_POST["careerHighlights"] : ''; 
      $data_profession[] = isset($_POST["accomplishments"]) ? $_POST["accomplishments"] : '';
      $data_profession[] = isset($_POST["myWebsite"]) ? $_POST["myWebsite"] : '';
      $data_profession[] = isset($_POST["aboutMyself"]) ? $_POST["aboutMyself"] : '';
      $data_profession[] = isset($_POST["hobbies"]) ? $_POST["hobbies"] : '';
      $data_profession[] = isset($_POST["certifications"]) ? $_POST["certifications"] : '';
      $data_profession[] = isset($_POST["languageFluency"]) ? $_POST["languageFluency"] : '';
      $data_profession[] = isset($_POST["hourlyRate"]) ? $_POST["hourlyRate"] : '';

      $professionid = insertQ("INSERT INTO spprofessional_profile (spprofiles_idspProfiles, category, highlights, details, spProfileWebsite, spProfileAbout, sphobbies, spCertification, splanguagefluency, spHourlyrate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 'isssssssss', $data_profession);

      return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $professionid]];
    }
    elseif ($spProfileTypeidspProfileType == 2) {
      $profileData = [];
      $profileData[] = isset($postid) ? (int) trim($postid) : 0;
      $profileData[] = isset($_POST['profiletype']) ? $_POST['profiletype'] : "";
      $profileData[] = isset($_POST['hourlyrate']) ? $_POST['hourlyrate'] : "";
      $profileData[] = isset($_POST['skill']) ? $_POST['skill'] : "";
      $profileData[] = isset($_POST['certification']) ? $_POST['certification'] : "";
      $profileData[] = isset($_POST['projectworked']) ? $_POST['projectworked'] : "";
      $profileData[] = isset($_POST['workinginterests']) ? $_POST['workinginterests'] : "";
      $profileData[] = isset($_POST['availablefrom']) ? $_POST['availablefrom'] : "";
      $profileData[] = isset($_POST['personalwebsite']) ? $_POST['personalwebsite'] : "";
      $profileData[] = isset($_POST['languagefluency']) ? $_POST['languagefluency'] : "";
      $profileData[] = isset($_POST['Overview']) ? $_POST['Overview'] : "";
            
      $freelancer = insertQ("INSERT INTO spfreelancer_profile (spprofiles_idspProfiles, profiletype, hourlyrate, skill, certification, projectworked, workinginterests, availablefrom,personalwebsite, languagefluency, overview) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 'issssssssss', $profileData); 


      return ['format' => 'skipSuccess', 'data' => ['success' => 1, 'data' => $freelancer]];
    }

  }
      
  /**
    * To get the category details
    *
   **/  
  public function readcategory($id){
    $coupon = selectQ('SELECT idsubCategory, subCategoryTitle FROM subcategory WHERE spCategories_idspCategory = ? ORDER BY subCategoryTitle ASC', 'i', array($id), 'all');
    return ['data' => $coupon];
  }
  
  /**
    * To get the count of the users different profile types
    *
   **/  
  public function getUserProfileCount($uid, $profiletype){
    $sql =  "SELECT COUNT(idspProfiles) as total_count FROM spprofiles WHERE spUser_idspUser = ? AND spProfileType_idspProfileType = ?";
    $params = [$uid, $profiletype];
    $out = selectQ($sql, "ii", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }


  public function createJobAlert($userId, $profileId, $email) {
    // Sanitize inputs
    $userId = intval($userId);
    $profileId = intval($profileId);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  
    // Insert job alert into database
    $stmt = $db->prepare("INSERT INTO job_alerts (spuserId, postId, email) VALUES (?, ?, ?)");
    return $stmt->execute([$userId, $profileId, $email]);
}
 
}




  


 ?>
