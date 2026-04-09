<?php
class EditProfile extends Base{
    /**
     * To get the all profile data
     *
     **/
    public function featchProfilesData($id){
        $coupon = selectQ('SELECT * FROM spprofiles WHERE idspProfiles = ? ', 'i', array($id), 'one');
        return ['data' => $coupon];
    }

    /*
     * To get the user data
     *
     **/
    public function fetchUserData($id){
        $out = selectQ('SELECT *, user.spProfileName as username, profiles.spProfileName as spProfileName, user.spProfilePic as userPic, profiles.spProfilePic as spProfilePic, user.address as userAddress, profiles.address as address, user.spProfileAbout as spProfileAbout, profiles.spProfileAbout as profileabout  FROM spprofiles AS profiles INNER JOIN spuser AS user ON profiles.spUser_idspUser = user.idspUser WHERE idspProfiles = ? ', 'i', array($id), 'one');

        return ['data' => $out];
    }

    /**
     * To get the all users data
     *
     **/
    public function featchUsersData2($id){
        $coupon = selectQ('SELECT * FROM spuser WHERE idspUser = ? ', 'i', array($id), 'one');
        return ['data' => $coupon];
    }

    /**
     * To get the all employement data
     *
     **/
    public function featchEducationData($id,$pid){
        $coupon = selectQ('SELECT * FROM employment_education WHERE idspProfiles = ? AND spProfileType_idspProfileType=?', 'ii', array($id,$pid), 'all');
        return ['data' => $coupon];
    }

    /**
     * To get the user's bussiness data
     *
     **/
    public function getBusinessData($id){
        $coupon = selectQ('SELECT * FROM spbusiness_profile WHERE spprofiles_idspProfiles = ? ', 'i', array($id), 'one');
        return ['data' => $coupon];
    }
    /**
     * To get the user name data
     *
     **/
    public function updateUser(){
        $pid = $_SESSION["pid"];
        $text = isset($_POST['text']) ? $_POST['text'] :"" ;
        if(!empty($pid) && !empty($text)){
            $coupon = insertQ('UPDATE spprofiles SET spProfileName = ? WHERE idspProfiles = ?', 'si', array($text, $pid), 'one');
            return ['data' => 'success'];
        }
    }


    /**
     * To insert the education details
     *
     **/
    public function education(){
        $schoolCollege = isset($_POST['schoolCollege']) ? $_POST['schoolCollege'] : "";
        $degree = isset($_POST['degree']) ? $_POST['degree'] : "";
        $fieldOfStudy = isset($_POST['fieldOfStudy']) ? $_POST['fieldOfStudy'] : "";
        $year = isset($_POST['yearSelect']) ? $_POST['yearSelect'] : 0;
        $ptid = $_SESSION["ptid"];
        $pid = $_SESSION["pid"];
        $uid = $_SESSION["uid"];
        $arr = array($schoolCollege, $degree, $fieldOfStudy, $year, $ptid, $pid, $uid);
        $postid = insertQ("INSERT INTO employment_education (school, empdegree, study, year, spProfileType_idspProfileType, idspProfiles, spUser_idspUser) VALUES (?, ?, ?, ?, ?, ?, ?)",'ssssiii',$arr);
        return ['format' => 'skipSuccess', 'data' => 1];
    }

    /**
     * To insert the Experience details
     *
     **/
    public function experience(){
        $ptid = $_SESSION["ptid"];
        $pid = $_SESSION["pid"];
        $uid = $_SESSION["uid"];
        $jobtitle = isset($_POST['jobtitle']) ? $_POST['jobtitle'] : "";
        $emptype = isset($_POST['emptype']) ? $_POST['emptype'] : "";
        $compnyname = isset($_POST['compnyname']) ? $_POST['compnyname'] : "";
        $country = isset($_POST['country']) ? (int)$_POST['country'] : 0;
        $state = isset($_POST['state']) ? (int)$_POST['state'] : 0;
        $city = isset($_POST['city']) ? (int)$_POST['city'] : 0;
        $checked = isset($_POST['checked']) ? $_POST['checked'] : "";
        $emonth = isset($_POST['emonth']) ? (int)$_POST['emonth'] : 0;
        $eyear = isset($_POST['eyear']) ? (int)$_POST['eyear'] : 0;
        $description = isset($_POST['description']) ? $_POST['description'] : "";
        $from_date = $eyear . '-' . $emonth . '-01';
        $to_date = $eyear . '-' . $emonth . '-01';
        $frommonth = '';
        $fromyear = '';
        $current_work='';

        $arr = array($jobtitle, $compnyname, $country, $state, $city, $from_date, $to_date,$frommonth,$fromyear, $emonth, $eyear, $uid, $pid, $description, $ptid, $emptype,$current_work);

        $postid = insertQ("INSERT INTO employment_experience (jobtitle, company, country, state, city, start_date, end_date, frommonth, fromyear, tomonth, toyear, idspProfiles, idsp_pid, description, spProfileType_idspProfileType, emptype, current_work) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 'ssssiiiiiiiisssss', $arr);
        return ['format' => 'skipSuccess', 'data' => 1];
    }


    /**
     * To get the Experience details
     *
     **/
    public function experienceDetails($id){
        $coupon = selectQ('SELECT * FROM employment_experience WHERE idsp_pid = ? ', 'i', array($id), 'all');
        return ['data' => $coupon];
    }


    /**
     * To edit the profiles details
     *
     **/
    public function editProfile(){
        $ptid = $_SESSION["ptid"];
        $pid = $_SESSION["pid"];
        $uid = $_SESSION["uid"];
        $fname = isset($_POST['fname']) ? $_POST['fname'] : "";
        $lname = isset($_POST['lname']) ? $_POST['lname'] : "";
        $dob = isset($_POST['dob']) ? $_POST['dob'] : 0;
        $phones = isset($_POST['phones']) ? (int)$_POST['phones'] : 0;
        $phone = isset($_POST['phone']) ? $_POST['phone'] : "";
        $emails = isset($_POST['emails']) ? $_POST['emails'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $address = isset($_POST['address']) ? $_POST['address'] : "";
        $country = isset($_POST['country']) ? (int)$_POST['country'] : 0;
        $spUserState = isset($_POST['spUserState']) ? (int)$_POST['spUserState'] : 0;
        $spUserCity = isset($_POST['spUserCity']) ? (int)$_POST['spUserCity'] : 0;
        $postalcode = isset($_POST['postalcode']) ? (int)$_POST['postalcode'] : 0;
        $store = isset($_POST['store']) ? $_POST['store'] : "";
        $tagline = isset($_POST['tagline']) ? $_POST['tagline'] : "";
        $about = isset($_POST['about']) ? $_POST['about'] : "";
        $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : "";
        $language = isset($_POST['language']) ? $_POST['language'] : "";
        $arr = array($fname,$emails,$phones,$fname,$fname);
        $educationTableData = isset($_POST['educationTableData']) ? json_decode($_POST['educationTableData'], true) : [];
        foreach ($educationTableData as $education) {
            $id = isset($education['id']) ? $education['id'] : null;
            $school = isset($education['school']) ? $education['school'] : "";
            $degree = isset($education['degree']) ? $education['degree'] : "";
            $fieldOfStudy = isset($education['fieldOfStudy']) ? $education['fieldOfStudy'] : "";
            $year = isset($education['year']) ? $education['year'] : "";
            if ($id) {
                $update = insertQ('UPDATE employment_education SET school = ?, empdegree = ?, study = ?, year = ? WHERE id = ?','ssssi',array($school, $degree, $fieldOfStudy, $year, $id));
            } else {
                $arr = array($school, $degree, $fieldOfStudy, $year, $ptid, $pid, $uid);
                $postid = insertQ("INSERT INTO employment_education (school, empdegree, study, year, spProfileType_idspProfileType, idspProfiles, spUser_idspUser) VALUES (?, ?, ?, ?, ?, ?, ?)",'ssssiii',$arr);
            }
        }
        if($pid){
            $coupon = insertQ('UPDATE spprofiles SET spProfileName = ?, spProfileEmail = ?, spProfilePhone = ?, phone_status = ?, email_status = ?, spProfilesDob = ?,address=? ,spProfilesCountry =?,spProfilesState=?,spProfilesCity=?,spProfilePostalCode=?,spProfileAbout=?,spProfileLastName = ? WHERE idspProfiles = ?', 'ssissssiiiissi', array($fname, $emails, $phones, $phone, $email, $dob, $address,$country,$spUserState,$spUserCity,$postalcode,$about,$lname,$pid), 'update');
        }
        if($ptid == 1){
            $data = insertQ('UPDATE spbusiness_profile SET languageSpoken = ?, companyname = ?, companytagline = ? WHERE spprofiles_idspProfiles = ?', 'sssi', array($language, $store, $tagline, $pid),     'update');
        }
        if($ptid == 3){
            $data = insertQ('UPDATE spprofessional_profile SET splanguagefluency = ? ,sphobbies = ? WHERE spprofiles_idspProfiles = ?', 'ssi', array($language,$hobbies,$pid),'update');
        }
        return ['format' => 'skipSuccess', 'data' => 1];
    }

    /**
     * To edit the profiles details
     *
     **/
    function updateUserProfile(){
     //   die('here');
        $ptid = $_SESSION["ptid"];
        $pid = $_SESSION["pid"];
        $uid = $_SESSION["uid"];

        if(!empty($pid) && !empty($uid)){
            $profile_data = [];
            $profile_types = '';
            $profile_sql = '';

            if($ptid == 1 || $ptid == 2 || $ptid == 3 || $ptid == 5){
                if(isset($_POST['phone_status'])){
                    $profile_data[] = trim($_POST['phone_status']);
                }
                if(isset($_POST['profile_status']) &&  trim($_POST['profile_status']) != ""){
                    $profile_data[] = trim($_POST['profile_status']);
                } else {
                    errorOut("Profile Status cannot be empty.");
                }
                if(isset($_POST['email_status']) &&  trim($_POST['email_status']) != ""){
                    $profile_data[] = trim($_POST['email_status']);
                } else {
                    errorOut("Email Status cannot be empty.");
                }
            }
            if($ptid == 1){

                $profile_data[] = isset($_POST['spProfilePhone']) ? trim($_POST['spProfilePhone']) : "";
                if(isset($_POST['address'])){
                    $profile_data[] = trim($_POST['address']);
                }
                if(isset($_POST['spProfilesCountry']) &&  $_POST['spProfilesCountry'] != 0){
                    $profile_data[] = $_POST['spProfilesCountry'];
                    $_SESSION['Countryfilter'] = $_POST["spProfilesCountry"];
                } else {
                    errorOut("Select a Country.");
                }

                if(isset($_POST['spUserState']) &&  $_POST['spUserState'] != 0){
                    $profile_data[] = $_POST['spUserState'];
                    $_SESSION['Statefilter'] = $_POST["spUserState"];
                } else {
                    errorOut("Select a State.");
                }
                if(isset($_POST['spUserCity']) &&  $_POST['spUserCity'] != 0){
                    $profile_data[] = $_POST['spUserCity'];
                    $_SESSION['Cityfilter'] = $_POST["spUserCity"];
                } else {
                    errorOut("Select a City.");
                }

                $profile_data[] = isset($_POST['spProfilePostalCode']) ? trim($_POST['spProfilePostalCode']) : "";

                $profile_data[] = $pid;

                $profile_sql = 'UPDATE spprofiles SET phone_status = ?, profile_status = ?, email_status = ?, spProfilePhone = ?, address = ?, spProfilesCountry = ?, spProfilesState = ?, spProfilesCity = ?, spProfilePostalCode = ? WHERE idspProfiles = ?';
                $profile_types = 'sssssiiisi';
                $buss_data = [];

                if(isset($_POST['companyname']) && trim($_POST['companyname']) != ""){
                    $buss_data[] = trim($_POST['companyname']);
                } else {
                    errorOut("Business Name cannot be empty.");
                }
                if(isset($_POST['businesscategory']) ){
                    $buss_data[] = implode(',', $_POST['businesscategory']);
                }
                if(isset($_POST['companytagline'])){
                    $buss_data[] = trim($_POST['companytagline']);
                }
                if(isset($_POST['companyPhoneNo']) ){
                    $buss_data[] = trim($_POST['companyPhoneNo']);
                }

                if(isset($_POST['companyEmail'])){
                    $buss_data[] = trim($_POST['companyEmail']);
                }
                if(isset($_POST['CompanyWebsite']) ){
                    $buss_data[] = trim($_POST['CompanyWebsite']);
                }
                if(isset($_POST['skill']) ){
                    $buss_data[] = trim($_POST['skill']);
                }
                if(isset($_POST['companyProductService']) &&  trim($_POST['companyProductService']) != ""){
                    $buss_data[] = trim($_POST['companyProductService']);
                } else {
                    errorOut("Product and Services cannot be empty.");
                }
                if(isset($_POST['BussinessOverview']) &&  trim($_POST['BussinessOverview']) != ""){
                    $buss_data[] = trim($_POST['BussinessOverview']);
                } else {
                    errorOut("Business Overview cannot be empty.");
                }
                $buss_data[] = isset($_POST['spDynamicWholesell']) ? trim($_POST['spDynamicWholesell']) : "";
                $buss_data[] = isset($_POST['CompanySize']) ? trim($_POST['CompanySize']) : "";
                $buss_data[] = isset($_POST['cmpyRevenue']) ? trim($_POST['cmpyRevenue']) : "";
                $buss_data[] = isset($_POST['yearFounded']) ? trim($_POST['yearFounded']) : "";
                $buss_data[] = isset($_POST['cmpnyStockLink']) ? trim($_POST['cmpnyStockLink']) : "";
                $buss_data[] = isset($_POST['spProfilesAboutStore']) ? trim($_POST['spProfilesAboutStore']) : "";
                $buss_data[] = isset($_POST['spshippingtext']) ? trim($_POST['spshippingtext']) : "";
                $buss_data[] = isset($_POST['spProfilerefund']) ? trim($_POST['spProfilerefund']) : "";
                $buss_data[] = isset($_POST['spProfilepolicy']) ? trim($_POST['spProfilepolicy']) : "";
                $buss_data[] = isset($_POST['stockSymbol']) ? trim($_POST['stockSymbol']) : "";
                $buss_data[] = isset($_POST['defaultbusiness']) ? $_POST['defaultbusiness'] : 0;
                $buss_data[] = isset($_POST['showEmailProfile']) ? $_POST['showEmailProfile'] : 0;
                $buss_data[] = $pid;

                $sql = "UPDATE spbusiness_profile SET companyname = ?, businesscategory = ?, companytagline = ?, companyPhoneNo = ?, companyEmail = ?, CompanyWebsite = ?, skill = ?, companyProductService = ?, BussinessOverview = ?, spDynamicWholesell = ?, CompanySize = ?, cmpyRevenue = ?, yearFounded = ?, cmpnyStockLink = ?, spProfilesAboutStore = ?, spshippingtext = ?, spProfilerefund = ?, spProfilepolicy = ?, stockSymbol = ?, defaultbusiness = ?, showEmailProfile = ? WHERE spprofiles_idspProfiles = ?";
                $out = insertQ($sql, 'sssssssssssssssssssiii', $buss_data);
                $out2 = insertQ($profile_sql, $profile_types, $profile_data);

            }
            if($ptid == 2){
                $free_data = [];
                if(isset($_POST['profiletype']) && trim($_POST['profiletype']) != 0){
                    $free_data[] = $_POST['profiletype'];
                } else {
                    errorOut("Select a Career Category.");
                }
                if(isset($_POST['hourlyrate']) && trim($_POST['hourlyrate']) != ""){
                    $free_data[] = trim($_POST['hourlyrate']);
                } else {
                    errorOut("Hourly Rate cannot be empty.");
                }
                if(isset($_POST['languagefluency']) ){
                    $free_data[] = trim($_POST['languagefluency']);
                }
                if (isset($_POST['availablefrom'])) {
                    $free_data[] = trim($_POST['availablefrom']);
                }
                if(isset($_POST['skill']) &&  trim($_POST['skill']) != ""){
                    $free_data[] = trim($_POST['skill']);
                } else {
                    errorOut("Skills cannot be empty.");
                }
                if(isset($_POST['personalwebsite']) ){
                    $free_data[] = trim($_POST['personalwebsite']);
                }
                if(isset($_POST['certification'])){
                    $free_data[] = trim($_POST['certification']);
                }
                if(isset($_POST['projectworked']) ){
                    $free_data[] = trim($_POST['projectworked']);
                }
                if(isset($_POST['workinginterests']) &&  trim($_POST['workinginterests']) != ""){
                    $free_data[] = trim($_POST['workinginterests']);
                } else {
                    errorOut("Working Interests cannot be empty.");
                }
                if(isset($_POST['Overview']) &&  trim($_POST['Overview']) != ""){
                    $free_data[] = trim($_POST['Overview']);
                } else {
                    errorOut("Overview cannot be empty.");
                }
                $free_data[] = $pid;
                $sql = "UPDATE spfreelancer_profile SET profiletype = ?, hourlyrate = ?, languagefluency = ?, availablefrom = ?, skill = ?, personalwebsite = ?, certification = ?, projectworked = ?, workinginterests = ?, overview = ? WHERE spprofiles_idspProfiles = ?";
                $out = insertQ($sql, 'ssssssssssi', $free_data);
                $profile_data[] = $pid;
                $profile_sql = 'UPDATE spprofiles SET phone_status = ?, profile_status = ?, email_status = ? WHERE idspProfiles = ?';
                $profile_types = 'sssi';
                $out2 = insertQ($profile_sql, $profile_types, $profile_data);
            }
            if($ptid == 4){
                $personal_data = [];
                if (isset($_POST['fname'])) {
                    $personal_data[] = $_POST['fname'];
                }
                if (isset($_POST['lname'])) {
                    $personal_data[] = trim($_POST['lname']);
                }
                if (isset($_POST['dob'])) {
                    $personal_data[] = trim($_POST['dob']);
                }
                if (isset($_POST['phones'])) {
                    $personal_data[] = trim($_POST['phones']);
                }
                if (isset($_POST['emails']) && trim($_POST['emails']) != "") {
                    $personal_data[] = trim($_POST['emails']);
                } else {
                    errorOut("Email cannot be empty.");
                }
//        if (isset($_POST['phone_status']) && trim($_POST['phone_status']) != "") {
//          $personal_data[] = trim($_POST['phone_status']);
//        } else {
//          errorOut("Phone Status cannot be empty.");
//        }
//        if (isset($_POST['profile_status']) && trim($_POST['profile_status']) != "") {
//          $personal_data[] = trim($_POST['profile_status']);
//        } else {
//          errorOut("Profile Status cannot be empty.");
//        }
//        if (isset($_POST['email_status']) && trim($_POST['email_status']) != "") {
//          $personal_data[] = trim($_POST['email_status']);
//        } else {
//          errorOut("Email Status cannot be empty.");
//        }
                if (isset($_POST['address'])) {
                    $personal_data[] = trim($_POST['address']);
                }
                if (isset($_POST['country']) && trim($_POST['country']) != "") {
                    $personal_data[] = trim($_POST['country']);
                    $_SESSION['Countryfilter'] = $_POST["country"];
                } else {
                    errorOut("Country cannot be empty.");
                }
                if (isset($_POST['spUserState']) && trim($_POST['spUserState']) != "") {
                    $personal_data[] = trim($_POST['spUserState']);
                    $_SESSION['Statefilter'] = $_POST["spUserState"];
                } else {
                    errorOut("State cannot be empty.");
                }
                if (isset($_POST['spUserCity']) && trim($_POST['spUserCity']) != "") {
                    $personal_data[] = trim($_POST['spUserCity']);
                    $_SESSION['Cityfilter'] = $_POST["spUserCity"];
                } else {
                    errorOut("City cannot be empty.");
                }

                $personal_data[] = isset($_POST['postalcode']) ? $_POST['postalcode'] : "";
//        if (isset($_POST['store'])) {
//          $personal_data[] = trim($_POST['store']);
//        }
                if (isset($_POST['tagline'])) {
                    $personal_data[] = trim($_POST['tagline']);
                }

// Replace $pid with $uid
                // Assuming 'uid' is being sent in the POST data
                $personal_data[] = $uid;

                try {
                    // Updated SQL query with correct column names
                    $sql = "UPDATE spuser 
            SET spUserFirstName = ?, 
                spUserLastName = ?, 
                spUserDob = ?, 
                spUserPhone = ?, 
                spUserEmail = ?, 
                spUserAddress = ?, 
                spUserCountry = ?, 
                spUserState = ?, 
                spUserCity = ?, 
                spUserPostalCode = ?, 
                spProfileAbout = ? 
            WHERE idspUser = ?";
                    // Using the updated column names and uid
//          print_r($personal_data);
//          die();
                    $out = insertQ($sql, 'ssssssssssss', $personal_data);
                } catch (\Exception $e) {
                    print_r($e);
                }
                try {
                    // ====== Update spuser (already in place, assumed to be working) ======

                    // ====== Update spProfiles ======

                    $profile_data = [];
//          $profile_data[] = isset($_POST['tagline']) ? trim($_POST['tagline']) : null;          // spProfileTagline
                    $profile_data[] = isset($_POST['store']) ? trim($_POST['store']) : null;              // store_name

                    if (isset($_POST['phone_status']) && trim($_POST['phone_status']) != "") {
                        $profile_data[] = trim($_POST['phone_status']);                                   // phone_status
                    } else {
                        errorOut("Phone Status cannot be empty.");
                    }

                    if (isset($_POST['profile_status']) && trim($_POST['profile_status']) != "") {
                        $profile_data[] = trim($_POST['profile_status']);                                 // profile_status
                    } else {
                        errorOut("Profile Status cannot be empty.");
                    }

                    if (isset($_POST['email_status']) && trim($_POST['email_status']) != "") {
                        $profile_data[] = trim($_POST['email_status']);                                   // email_status
                    } else {
                        errorOut("Email Status cannot be empty.");
                    }

                    $profile_data[] = $pid;                                                               // WHERE idspProfiles = ?

                    $profile_sql = "UPDATE spprofiles 
                    SET store_name = ?, 
                        phone_status = ?, 
                        profile_status = ?, 
                        email_status = ? 
                    WHERE idspProfiles = ?";

                    $out2 = insertQ($profile_sql, 'sssss', $profile_data); // Types: 5 strings, 1 int

                } catch (\Exception $e) {
                    print_r($e);
                }




                $user_data = [];
                if(isset($_POST['about'])){
                    $user_data[] = trim($_POST['about']);
                }
                if(isset($_POST['language']) ){
                    $user_data[] = trim($_POST['language']);
                }
                if(isset($_POST['hobbies']) ){
                    $user_data[] = trim($_POST['hobbies']);
                }
                $user_data[] = $uid;
                $sql = "UPDATE spuser SET spProfileAbout = ?, languagefluency = ?, sphobbies = ? WHERE idspUser = ?";
                $out = insertQ($sql, 'sssi', $user_data);
            }
            if($ptid == 3){
                $pro_data = [];
                if(isset($_POST['careerCategory']) && trim($_POST['careerCategory']) != ""){
                    $pro_data[] = trim($_POST['careerCategory']);
                } else {
                    errorOut("Career Category cannot be empty.");
                }
                if(isset($_POST['hourlyRate']) && trim($_POST['hourlyRate']) != ""){
                    $pro_data[] = $_POST['hourlyRate'];
                } else {
                    errorOut("Hourly Rate cannot be empty.");
                }

                if(isset($_POST['languageFluency']) ){
                    $pro_data[] = trim($_POST['languageFluency']);
                }
                if(isset($_POST['availableForm']) ){
                    $pro_data[] = trim($_POST['availableForm']);
                }
                if(isset($_POST['myWebsite'])){
                    $pro_data[] = trim($_POST['myWebsite']);
                }
                if(isset($_POST['careerHighlights']) &&  trim($_POST['careerHighlights']) != ""){
                    $pro_data[] = trim($_POST['careerHighlights']);
                } else {
                    errorOut("Career Highlights cannot be empty.");
                }
                if(isset($_POST['accomplishments'])){
                    $pro_data[] = trim($_POST['accomplishments']);
                }
                if(isset($_POST['certifications'])){
                    $pro_data[] = trim($_POST['certifications']);
                }
                if(isset($_POST['hobbies'])){
                    $pro_data[] = trim($_POST['hobbies']);
                }
                if(isset($_POST['aboutMyself'])){
                    $pro_data[] = trim($_POST['aboutMyself']);
                }

                $pro_data[] = $pid;
                $sql = "UPDATE spprofessional_profile SET category = ?, spHourlyrate = ?, splanguagefluency = ?, spAvailablefrom = ?, spProfileWebsite = ?, highlights = ?, details = ?, spCertification = ?, sphobbies = ?, spProfileAbout = ? WHERE spprofiles_idspProfiles = ?";
                $out = insertQ($sql, 'sissssssssi', $pro_data);
                $profile_data[] = $pid;
                $profile_sql = 'UPDATE spprofiles SET phone_status = ?, profile_status = ?, email_status = ? WHERE idspProfiles = ?';
                $profile_types = 'sssi';
                $out2 = insertQ($profile_sql, $profile_types, $profile_data);
            }
            if($ptid == 5){
                $emp_data = [];
                if(isset($_POST['jobSeekProfileTagline']) && trim($_POST['jobSeekProfileTagline']) != ""){
                    $emp_data[] = trim($_POST['jobSeekProfileTagline']);
                } else {
                    errorOut("Tag Line cannot be empty.");
                }
                if(isset($_POST['spPostingEducationLevel']) && trim($_POST['spPostingEducationLevel']) != ""){
                    $emp_data[] = $_POST['spPostingEducationLevel'];
                } else {
                    errorOut("Education Level cannot be empty.");
                }
                if(isset($_POST['graduate']) &&  trim($_POST['graduate']) != ""){
                    $emp_data[] = trim($_POST['graduate']);
                } else {
                    errorOut("Completed On cannot be empty.");
                }
                if(isset($_POST['spPostingJobType']) &&  trim($_POST['spPostingJobType']) != ""){
                    $emp_data[] = trim($_POST['spPostingJobType']);
                } else {
                    errorOut("Career Sector cannot be empty.");
                }
                if(isset($_POST['language_fluency']) &&  trim($_POST['language_fluency']) != ""){
                    $emp_data[] = trim($_POST['language_fluency']);
                } else {
                    errorOut("Language Fluency cannot be empty.");
                }
                if(isset($_POST['skill']) &&  trim($_POST['skill']) != ""){
                    $emp_data[] = str_replace(["\r\n", "\r", "\n"], ",", trim($_POST['skill']));
                } else {
                    errorOut("Highlights cannot be empty.");
                }
                if(isset($_POST['certification']) ){
                    $emp_data[] = trim($_POST['certification']);
                }
                if(isset($_POST['achievements']) &&  trim($_POST['achievements']) != ""){
                    $emp_data[] = trim($_POST['achievements']);
                } else {
                    errorOut("Achievements cannot be empty.");
                }
                if(isset($_POST['hobbies']) &&  trim($_POST['hobbies']) != ""){
                    $emp_data[] = trim($_POST['hobbies']);
                } else {
                    errorOut("Hobbies cannot be empty.");
                }
                if(isset($_POST['reference']) &&  trim($_POST['reference']) != ""){
                    $emp_data[] = trim($_POST['reference']);
                } else {
                    errorOut("References cannot be empty.");
                }
                $emp_data[] = $pid;
                $sql = "UPDATE spemployment_profile SET profile_tagline = ?, education_level = ?, graduate = ?, spPostingJobType = ?, language_fluency = ?, skill = ?, certification = ?, achievements = ?, hobbies = ?, reference = ? WHERE spprofiles_idspProfiles = ?";
                $out = insertQ($sql, 'sssissssssi', $emp_data);
                $profile_data[] = $pid;
                $profile_sql = 'UPDATE spprofiles SET phone_status = ?, profile_status = ?, email_status = ? WHERE idspProfiles = ?';
                $profile_types = 'sssi';
                $out2 = insertQ($profile_sql, $profile_types, $profile_data);
            }
            if($ptid == 6){
                if(isset($_POST['famTableData'])){
                    $famArray = json_decode($_POST['famTableData']);
                    if(count($famArray) > 0){
                        foreach($famArray as $fam){
                            $member_data = [];
                            if(isset($fam->memberName) &&  trim($fam->memberName) != ""){
                                $member_data[] = trim($fam->memberName);
                            } else {
                                errorOut("Member Name cannot be empty.");
                            }
                            if(isset($fam->relationType) &&  trim($fam->relationType) != ""){
                                $member_data[] = trim($fam->relationType);
                            } else {
                                errorOut("Relation Type cannot be empty.");
                            }
                            $mem_sql = "";
                            $mem_type = "";
                            if(isset($fam->id) && $fam->id == 'new'){
                                $member_data[] = $pid;
                                $member_data[] = $uid;
                                $member_data[] = $pid;
                                $mem_sql = "INSERT INTO add_family_relation (family_name, family_relation, pid, uid, family_id) VALUES (?, ?, ?, ?, ?)";
                                $mem_type = "ssiii";
                            } else if(isset($fam->id) && $fam->id != 0) {
                                $member_data[] = $fam->id;
                                $mem_sql = "UPDATE add_family_relation SET family_name = ?, family_relation = ? WHERE id = ?";
                                $mem_type = "ssi";
                            }
                            $fammember = insertQ($mem_sql, $mem_type, $member_data);
                        }
                    }
                }
                $fam_data = [];
                if(isset($_POST['spDynamicWholesell']) && trim($_POST['spDynamicWholesell']) != ""){
                    $out2 = insertQ("UPDATE spprofiles SET store_name = ? WHERE idspProfiles = ?", 'si', [trim($_POST['spDynamicWholesell']), $pid]);
                } else {
                    errorOut("Store Name cannot be empty.");
                }
                if(isset($_POST['choice_']) && trim($_POST['choice_']) != ""){
                    $fam_data[] = $_POST['choice_'];
                } else {
                    errorOut("My Interest cannot be empty.");
                }
                if(isset($_POST['carrer']) && trim($_POST['carrer']) != ""){
                    $fam_data[] = $_POST['carrer'];
                } else {
                    errorOut("Career In cannot be empty.");
                }
                $fam_data[] = $pid;
                $sql = "UPDATE spfamily_profile SET choice = ?, carrer = ? WHERE spprofiles_idspProfiles = ?";
                $out = insertQ($sql, 'ssi', $fam_data);
            }
            if(isset($_POST['educationTableData'])){
                $educationArray = json_decode($_POST['educationTableData']);
                if(count($educationArray) > 0){
                    foreach($educationArray as $edu){
                        $edu_data = [];
                        if(isset($edu->school) &&  trim($edu->school) != ""){
                            $edu_data[] = trim($edu->school);
                        } else {
                            errorOut("School cannot be empty.");
                        }
                        if(isset($edu->degree) &&  trim($edu->degree) != ""){
                            $edu_data[] = trim($edu->degree);
                        } else {
                            errorOut("Degree cannot be empty.");
                        }
                        if(isset($edu->fieldOfStudy) &&  trim($edu->fieldOfStudy) != ""){
                            $edu_data[] = trim($edu->fieldOfStudy);
                        } else {
                            errorOut("Field of Study cannot be empty.");
                        }
                        if(isset($edu->year) &&  trim($edu->year) != ""){
                            $edu_data[] = trim($edu->year);
                        } else {
                            errorOut("Year cannot be empty.");
                        }
                        $edu_sql = "";
                        $edu_type = "";
                        if(isset($edu->id) && $edu->id == 'new'){
                            $edu_data[] = $ptid;
                            $edu_data[] = $pid;
                            $edu_data[] = $uid;
                            $edu_sql = "INSERT INTO employment_education (school, empdegree, study, year, spProfileType_idspProfileType, idspProfiles, spUser_idspUser) VALUES (?, ?, ?, ?, ?, ?, ?)";
                            $edu_type = "sssssss";
                        } else if(isset($edu->id) && $edu->id != 0) {
                            $edu_data[] = $edu->id;
                            $edu_sql = "UPDATE employment_education SET school = ?, empdegree = ?, study = ?, year = ? WHERE id = ?";
                            $edu_type = "ssssi";
                        }
                        $education = insertQ($edu_sql, $edu_type, $edu_data);
                    }
                }
            }
            if(isset($_POST['experienceData'])){
                $experienceArray = json_decode($_POST['experienceData']);
                if(count($experienceArray) > 0){
                    foreach($experienceArray as $exp){
                        $exp_data = [];
                        if(isset($exp->job) &&  trim($exp->job) != ""){
                            $exp_data[] = trim($exp->job);
                        } else {
                            errorOut("Job Title cannot be empty.");
                        }
                        if(isset($exp->companyName) &&  trim($exp->companyName) != ""){
                            $exp_data[] = trim($exp->companyName);
                        } else {
                            errorOut("Company Name cannot be empty.");
                        }
                        if(isset($exp->empType) &&  trim($exp->empType) != ""){
                            $exp_data[] = trim($exp->empType);
                        } else {
                            errorOut("Employment Type cannot be empty.");
                        }
                        if(isset($exp->startMonth) &&  trim($exp->startMonth) != ""){
                            $exp_data[] = trim($exp->startMonth);
                        } else {
                            errorOut("Start Month cannot be empty.");
                        }
                        if(isset($exp->startYear) &&  trim($exp->startYear) != ""){
                            $exp_data[] = trim($exp->startYear);
                        } else {
                            errorOut("Start Year cannot be empty.");
                        }
                        if(isset($exp->isCurrentJob) &&  $exp->isCurrentJob == false && isset($exp->endMonth) && trim($exp->endMonth) != ""){
                            $exp_data[] = 0;
                            $exp_data[] = trim($exp->endMonth);
                        } else if(isset($exp->isCurrentJob) &&  $exp->isCurrentJob == true) {
                            $exp_data[] = 1;
                            $exp_data[] = "";
                        } else {
                            errorOut("End Month cannot be empty.");
                        }
                        if(isset($exp->isCurrentJob) &&  $exp->isCurrentJob == false && isset($exp->endYear) && trim($exp->endYear) != ""){
                            $exp_data[] = trim($exp->endYear);
                        } else if(isset($exp->isCurrentJob) &&  $exp->isCurrentJob == true) {
                            $exp_data[] = "";
                        } else {
                            errorOut("End Year cannot be empty.");
                        }
                        if(isset($exp->country) &&  trim($exp->country) != ""){
                            $exp_data[] = trim($exp->country);
                        } else {
                            errorOut("Country cannot be empty.");
                        }
                        if(isset($exp->state) &&  trim($exp->state) != ""){
                            $exp_data[] = trim($exp->state);
                        } else {
                            errorOut("State cannot be empty.");
                        }
                        if(isset($exp->city) &&  trim($exp->city) != ""){
                            $exp_data[] = trim($exp->city);
                        } else {
                            errorOut("City cannot be empty.");
                        }
                        if(isset($exp->description) &&  trim($exp->description) != ""){
                            $exp_data[] = trim($exp->description);
                        } else {
                            errorOut("Job Description cannot be empty.");
                        }
                        if(isset($exp->id) && trim($exp->id) != ""){
                            $id = $exp->id;
                        } else {
                            errorOut("Invalid Job.");
                        }
                        $exp_sql = "";
                        $exp_type = "";
                        if($id == "new"){
                            $exp_data[] = $pid;
                            $exp_data[] = $uid;
                            $exp_data[] = $ptid;
                            $exp_sql = "INSERT INTO employment_experience (jobtitle, company, emptype, frommonth, fromyear, current_work, tomonth, toyear, country, state, city, description, idsp_pid, idspProfiles, spProfileType_idspProfileType) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                            $exp_type = "sssssissiiisiii";
                        } else {
                            $exp_data[] = $exp->id;
                            $exp_sql = "UPDATE employment_experience SET jobtitle = ?, company = ?, emptype = ?, frommonth = ?, fromyear = ?, current_work = ?, tomonth = ?, toyear = ?, country = ?, state = ?, city = ?, description = ? WHERE id = ?";
                            $exp_type = "sssssissiiisi";
                        }
                        $experience = insertQ($exp_sql, $exp_type, $exp_data);
                    }
                }
            }

            return ['format' => 'skipSuccess', 'data' => 1];
        } else {
            errorOut("Invalid User.");
        }
    }

    /**
     * To get the freelancer data of the user
     *
     **/
    public function fetchProfessionalData($pid){
        $out = selectQ('SELECT * FROM spprofessional_profile WHERE spprofiles_idspProfiles = ?', 'i', array($pid), 'one');
        return ['data' => $out];
    }

    /**
     * To get the all professional data
     *
     **/
    public function fetchFreelancerData($pid){
        $out = selectQ('SELECT * FROM spfreelancer_profile WHERE spprofiles_idspProfiles = ?', 'i', array($pid), 'one');
        return ['data' => $out];
    }

    /**
     * To get the employment data of the user
     *
     **/
    public function fetchEmploymentData($pid){
        $out = selectQ('SELECT * FROM spemployment_profile WHERE spprofiles_idspProfiles = ?', 'i', array($pid), 'one');
        return ['data' => $out];
    }

    /**
     * To get the family data of the user
     *
     **/
    public function fetchFamilyData($pid){
        $out = selectQ('SELECT * FROM spfamily_profile WHERE spprofiles_idspProfiles = ?', 'i', array($pid), 'one');
        return ['data' => $out];
    }

    /**
     * To get the family members data of the user
     *
     **/
    public function fetchFamilyMembers($pid){
        $out = selectQ('SELECT * FROM add_family_relation WHERE pid = ?', 'i', array($pid));
        return ['data' => $out];
    }

    /**
     * To get primary mail of the user
     *
     **/
    public function fetchPrimaryMail(){
        $out = selectQ('SELECT spUserEmail FROM spuser WHERE idspUser = ?', 'i', array($_SESSION['uid']), 'one');
        return ['data' => $out];
    }

    /**
     * get the emails of the user
     *
     **/
    public function fetchPersonalMails(){
        if(isset($_SESSION['pid']) && isset($_SESSION['ptid'])){
            $mainMail = $this->fetchPrimaryMail();
            $primaryEmail = '';
            if(isset($mainMail['data']) && isset($mainMail['data']['spUserEmail'])){
                $primaryEmail = $mainMail['data']['spUserEmail'];
            }
            $out = selectQ('SELECT * FROM spuser_email WHERE pid = ? AND profile_type = ? AND status = ?', 'iii', array($_SESSION['pid'], $_SESSION['ptid'], 1));
            $primaryCheck = 0;
            if(count($out) > 0){
                foreach($out as $mail){
                    if($mail['primary_mail'] == 1){
                        $primaryCheck = 1;
                    }
                }
            }
            if($primaryCheck == 0){
                $newId = $this->insertPrimaryEmail($primaryEmail, 1);
                $out[] = [ 'id' => $newId, 'email' => $primaryEmail, 'primary_mail' => 1];
            }
            return ['format' => 'skipSuccess', 'data' => $out];
        } else {
            errorOut("Invalid Inputs.");
        }
    }

    /**
     * To add the existing primary mail to new table
     *
     **/
    public function insertPrimaryEmail($email, $primary){
        $primary = isset($primary) ? $primary : 0;
        if(isset($email)){
            $insertId = insertQ('INSERT INTO spuser_email (email, uid, pid, profile_type, primary_mail, status) VALUES (?, ?, ?, ?, ?, ?)', 'siiiii', array($email, $_SESSION['uid'], $_SESSION['pid'], $_SESSION['ptid'], $primary, $primary));
            return $insertId;
        }
    }

    /**
     * To get delete the education
     *
     **/
    public function deleteEducation(){
        $pid = isset($_POST['rowId']) ? (int)$_POST['rowId'] : 0;
        $deleted = insertQ('DELETE FROM employment_education WHERE id = ?', 'i', array($pid));
        return ['format' => 'skipSuccess', 'data' => "Success"];
    }

    /**
     * To get delete the family member
     *
     **/
    public function deleteFamilyMember(){
        $pid = isset($_POST['rowId']) ? (int)$_POST['rowId'] : 0;
        $deleted = insertQ('DELETE FROM add_family_relation WHERE id = ?', 'i', array($pid));
        return ['format' => 'skipSuccess', 'data' => "Success"];
    }

    /**
     * To get delete the education
     *
     **/
    public function deleteExperince(){
        $pid = isset($_POST['rowId']) ? (int)$_POST['rowId'] : 0;
        $deleted = insertQ('DELETE FROM employment_experience WHERE id = ?', 'i', array($pid));
        return ['format' => 'skipSuccess', 'data' => "Success"];
    }

    /**
     * To get delete the Email
     *
     **/
    public function deleteEmail(){
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if(!empty($id)){
            $deleted = insertQ('DELETE FROM spuser_email WHERE id = ? AND pid = ?', 'ii', array($id, $_SESSION['pid']));
            return ['format' => 'skipSuccess', 'data' => "Success"];
        } else {
            errorOut("Invalid Id.");
        }
    }

    /**
     * To make the given email primary
     *
     **/
    public function makePrimary(){
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if(!empty($id)){
            $out = selectQ('SELECT * FROM spuser_email WHERE id = ? AND pid = ? AND status = ?', 'iii', array($id, $_SESSION['pid'], 1), 'one');
            if($out && isset($out['email'])){
                $update = insertQ("UPDATE spuser SET spUserEmail = ? WHERE idspUser = ?", "si", array($out['email'], $_SESSION['uid']));
                $update = insertQ("UPDATE spuser_email SET primary_mail = ? WHERE pid = ?", "ii", array(0, $_SESSION['pid']));
                $update = insertQ("UPDATE spuser_email SET primary_mail = ? WHERE id = ?", "ii", array(1, $id));
                return ['format' => 'skipSuccess', 'data' => 1];
            } else {
                errorOut("Invalid Id.");
            }
        } else {
            errorOut("Invalid Id.");
        }
    }

    /**
     * To send OTP
     *
     **/
    public function sendOtp(){
        $type = isset($_POST['type']) ? $_POST['type'] : "";
        $mail = isset($_POST['mail']) ? $_POST['mail'] : "";
        $emailcode = isset($_POST['code']) ? trim($_POST['code']) : "";
        if(!empty($mail)){
            $size_email      = 8;
            $alpha_key_email = '';
            $keys_email      = range('A', 'Z');
            for ($j = 0; $j < 2; $j++) {
                $alpha_key_email .= $keys_email[array_rand($keys_email)];
            }
            $length_email = $size_email - 2;
            $key_email    = '';
            $keys_email   = range(0, 9);
            for ($j = 0; $j < $length_email; $j++) {
                $key_email .= $keys_email[array_rand($keys_email)];
            }
            $emailRandCode = "ESP" . $alpha_key_email . $key_email;
            if($type == 'first'){
                $out = insertQ('UPDATE spuser SET email_verify_code = ? WHERE idspUser = ?', 'si', array($emailRandCode, $_SESSION['uid']));
                $_SESSION['email_otp'] = trim($emailRandCode);
                $msg = '
        <!DOCTYPE html>
        <html>
          <head>
            <title>The SharePage</title>
            <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <style type="text/css">
              .mmaintab{
                background: #FFF;
                margin: 0 auto;
                padding: 15px;
                width: 640px;
              }
              .logo h1{
                color: #000;
                margin: 20px 0px 25px;;
              }
              .letstart{
                background: #032350;
                padding: 15px;
                font-size: 20px;
                color: #FFF;
                margin: 15px 0px;
                text-align: center;
              }
              .letstart h1{
                font-size: 20px;
                margin: 0px;
              }
              .btn{
                background: #032350;
                color: #FFF;
                padding: 8px 15px;
                display: inline-block;
                margin-bottom: 15px;
                text-decoration: none;
                margin-top: 15px;
              }
              .foot{
                border-top: 1px solid;
                text-align: center;
              }
              .foot p{
                margin: 0px;
                color: #808080;
                padding: 10px
              }
              table {
                border-collapse: collapse;
                border: 2px solid black;
                margin-left:10px;
                margin-right:10px;
              }
              table td {
                border: 2px solid black;
              }
              .row > div {
                margin-top:10px;
                margin-left:10px;
                margin-right:10px;
                flex: 1;
                border: 1px solid grey;
              }
              .left-margin{
                margin-left:10px;
              }
              .btnhover:hover{
                color:white!important;
              }
              .btnhover{
                color:#fff!important;
              }
              .tablecontent{
                padding-left: 10px;
                padding-right: 10px;
                text-align: justify;
              }
              .paracontent{
                padding-left: 10px;
                padding-right: 10px;
                padding-bottom: 10px;
                padding-top: 10px;
                text-align: justify;
              }
            </style>
          </head>
          <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
            <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
              <tbody>
                <tr>
                  <td align="center" class="logo" >
                    <a href="javascript:void(0)">
                      <img src="' . $BaseUrl . '/assets/images/logo/tsplogo.PNG" alt="logo" style="height: 100px;width: 100px;" class="img-responsive" >
                    </a>
                    <h1>The SharePage</h1>
                  </td>
                </tr>
                <tr style="background:#3e2048">
                  <td class="letstart" style="background:#3e2048">
                    <h1>VERIFY YOUR EMAIL ADDRESS</h1>
                  </td>
                </tr>
                <tr>
                  <td>
                    <p class="left-margin" style=" text-transform: capitalize;">Hey there ' . ucfirst(strtolower($_SESSION['MyProfileName'])) . ',</p>
                    <p class="left-margin">You have added a new email at The SharePage!</p>
                    <p class="left-margin">
                      Your email verification code is:<span style="color:#6c085b">"' . $emailRandCode . '"</span>
                    </p>
                    <p class="left-margin" >Please copy and paste the verification code to move on to the next step of the adding new email. The verification code will expire in 15 minutes. </p>
                    <p class="left-margin" >
                      The request for this access originated from:<br>
                      IP address:  70.70.249.15..<br>
                      Location: Canada, BC, Surrey<br>
                      Thanks for registering with us!<br>
                      The SharePage Team
                    </p>
                    <p></p>
                  </td>
                </tr>
                <tr>
                  <td  align="center" class="foot">
                    <p style="margin-bottom: 0px;">This email was sent from a notification-only address. Please do not reply.</p>
                  </td>
                </tr>
              </tbody>
            </table>
            <div style="width: 640px;text-align: center;margin: 0 auto">
              <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>
              <div>
                <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
              </div>
            </div>
          </body>
        </html>
        ';
                $subject = "The SharePage [New Email Verification]";
                sendMail($mail, $subject, $msg, "registration@thesharepage.com");
                return ['format' => 'skipSuccess', 'data' => "Success"];
            }
            if($type == 'second'){
                $resend = isset($_POST['resend']) ? $_POST['resend'] : "0";
                if(($emailcode == $_SESSION['email_otp']) || $resend == 1){
                    $_SESSION['email_otp'] = $emailRandCode;
                    $mailCheck = selectQ('SELECT * FROM spuser_email WHERE email = ?', 's', array($mail), 'one');
                    if(isset($mailCheck['status']) && $mailCheck['status'] == 1){
                        errorOut("Email already exists.");
                    }
                    $mainmailCheck = selectQ('SELECT * FROM spuser WHERE spUserEmail = ?', 's', array($mail));
                    if($mainmailCheck && count($mainmailCheck) > 0){
                        errorOut("Email already exists.");
                    }
                    if($resend == 0 && !isset($mailCheck['id'])){
                        $out = insertQ('INSERT INTO spuser_email (email, uid, pid, profile_type, email_verify_code) VALUES (?, ?, ?, ?, ?)', 'siiis', array($mail, $_SESSION['uid'], $_SESSION['pid'], $_SESSION['ptid'], $emailRandCode));
                    } else {
                        $out = insertQ('UPDATE spuser_email SET email_verify_code = ? WHERE email = ?', 'ss', array($emailRandCode, $mail));
                    }
                    $msg = '
          <!DOCTYPE html>
          <html>
            <head>
              <title>The SharePage</title>
              <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
              <style type="text/css">
                .mmaintab{
                  background: #FFF;
                  margin: 0 auto;
                  padding: 15px;
                  width: 640px;
                }
                .logo h1{
                  color: #000;
                  margin: 20px 0px 25px;;
                }
                .letstart{
                  background: #032350;
                  padding: 15px;
                  font-size: 20px;
                  color: #FFF;
                  margin: 15px 0px;
                  text-align: center;
                }
                .letstart h1{
                  font-size: 20px;
                  margin: 0px;
                }
                .btn{
                  background: #032350;
                  color: #FFF;
                  padding: 8px 15px;
                  display: inline-block;
                  margin-bottom: 15px;
                  text-decoration: none;
                  margin-top: 15px;
                }
                .foot{
                  border-top: 1px solid;
                  text-align: center;
                }
                .foot p{
                  margin: 0px;
                  color: #808080;
                  padding: 10px
                }
                table {
                  border-collapse: collapse;
                  border: 2px solid black;
                  margin-left:10px;
                  margin-right:10px;
                }
                table td {
                  border: 2px solid black;
                }
                .row > div {
                  margin-top:10px;
                  margin-left:10px;
                  margin-right:10px;
                  flex: 1;
                  border: 1px solid grey;
                }
                .left-margin{
                  margin-left:10px;
                }
                .btnhover:hover{
                  color:white!important;
                }
                .btnhover{
                  color:#fff!important;
                }
                .tablecontent{
                  padding-left: 10px;
                  padding-right: 10px;
                  text-align: justify;
                }
                .paracontent{
                  padding-left: 10px;
                  padding-right: 10px;
                  padding-bottom: 10px;
                  padding-top: 10px;
                  text-align: justify;
                }
              </style>
            </head>
            <body bgcolor="#efefef" text="#808080" style="background-color: #efefef; color: #808080; margin: 0px; padding: 20px; -webkit-text-size-adjust:none; line-height: normal; font-size: 16px; font-family:arial,helvetica,sans-serif;">
              <table class="mmaintab" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                  <tr>
                    <td align="center" class="logo" >
                      <a href="javascript:void(0)">
                        <img src="' . $BaseUrl . '/assets/images/logo/tsplogo.PNG" alt="logo" style="height: 100px;width: 100px;" class="img-responsive" >
                      </a>
                      <h1>The SharePage</h1>
                    </td>
                  </tr>
                  <tr style="background:#3e2048">
                    <td class="letstart" style="background:#3e2048">
                      <h1>VERIFY YOUR EMAIL ADDRESS</h1>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p class="left-margin" style=" text-transform: capitalize;">Hey there ' . ucfirst(strtolower($_SESSION['MyProfileName'])) . ',</p>
                      <p class="left-margin">You have added a new email at The SharePage!</p>
                      <p class="left-margin">
                        Your email verification code is:<span style="color:#6c085b">"' . $emailRandCode . '"</span>
                      </p>
                      <p class="left-margin" >Please copy and paste the verification code to move on to the next step of the adding new email. The verification code will expire in 15 minutes. </p>
                      <p class="left-margin" >
                        The request for this access originated from:<br>
                        IP address:  70.70.249.15..<br>
                        Location: Canada, BC, Surrey<br>
                        Thanks for registering with us!<br>
                        The SharePage Team
                      </p>
                      <p></p>
                    </td>
                  </tr>
                  <tr>
                    <td  align="center" class="foot">
                      <p style="margin-bottom: 0px;">This email was sent from a notification-only address. Please do not reply.</p>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div style="width: 640px;text-align: center;margin: 0 auto">
                <p style="margin-bottom: 10px;">© Copyright ' . date('Y') . ' The SharePage. All rights reserved.</p>
                <div>
                  <a href="' . $BaseUrl . '/page/?page=privacy_policy" style="color: #808080;"">Privacy Policy</a> | <a href="' . $BaseUrl . '/page/?page=copyrights" style="color: #808080;"">Terms & Conditions</a>
                </div>
              </div>
            </body>
          </html>
          ';
                    $subject = "The SharePage [New Email Verification]";
                    sendMail($mail, $subject, $msg, "registration@thesharepage.com");
                    return ['format' => 'skipSuccess', 'data' => 1];
                } else {
                    errorOut("Code is incorrect.");
                }
            }
            if($type == 'third'){
                if($emailcode == $_SESSION['email_otp']){
                    $out = insertQ('UPDATE spuser_email SET status = ? WHERE email = ? AND pid = ?', 'isi', array(1, $mail, $_SESSION['pid']), 'one');
                    return ['format' => 'skipSuccess', 'data' => 1];
                } else {
                    return ['format' => 'skipSuccess', 'data' => 0];
                }
            }
        } else {
            errorOut("Invalid Email.");
        }
    }

}
?>
