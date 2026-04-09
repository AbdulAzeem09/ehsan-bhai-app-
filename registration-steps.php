<?php
session_start();
// error_reporting(0);
// error_reporting(1);

include("univ/baseurl.php" );

function sp_autoloader($class){
    // echo $class; die;
    include ('mlayer/' . $class . '.class.php');
}
$usr_id= $_SESSION['useridd'];
spl_autoload_register("sp_autoloader");
include("common.php" );
include("helpers/common.php" );
include("helpers/image.php");
$BaseUrl1=$BaseUrl;
$first_name ='';
$last_name = '';
$usercountry ='';
$userstate = '';
$usercity = '';
$state = '';
$city = '';
$currency = '';
$spUserEmail ='';
$otperror = '';
$spUserGender='';

if($usr_id)  {
    //$id = (int)$_GET['id'];
    $userrdata= new _spuser;
    $userdata= $userrdata->read_name($usr_id);
    $row = mysqli_fetch_assoc($userdata);
    $first_name =$row['spUserFirstName'];
    $last_name = $row['spUserLastName'];
    $usercountry = $row['spUserCountry'];
    $userstate = $row['spUserState'];
    $usercity = $row['spUserCity'];
    $profilecountry = $row['spUserCountry'];
    $profilestate = $row['spUserState'];
    $profilecity = $row['spUserCity'];
    $state = $row['spUserState'];
    $city = $row['spUserCity'];
    $currency = $row['currency'];
    $spUserEmail = $row['spUserEmail'];
    $profileEmail = $row['spUserEmail'];
    $spUserGender = $row['spUserGender'];
    $_SESSION["email"] = $row['spUserEmail'];
    $username = $row["spUserName"];
}

if(isset($_POST['save'])){

    $id =  isset($_POST["user_id"]) ? $_POST["user_id"] : "";
    $spUserFirstName = isset($_POST["spUserFirstName"]) ? $_POST["spUserFirstName"] : "";
    $spUserLastName = isset($_POST["spUserLastName"]) ? $_POST["spUserLastName"] : "";
    // Password logic
    $userrdata= new _spuser;
    $userdata= $userrdata->read_name($id);
    $row = mysqli_fetch_assoc($userdata);
    $registration_source = isset($row['registration_source']) ? $row['registration_source'] : null;
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    $lettersOnlyRegex = "/^[A-Za-z\s]+$/";

    if (empty($spUserFirstName) || empty($spUserLastName)) {
        echo "First name and last name are required.";
        exit;
    }
    elseif (!preg_match($lettersOnlyRegex, $spUserFirstName)) {
        echo "First name must contain only letters.";
        exit;
    }
    elseif (strlen($spUserFirstName) < 2 || strlen($spUserFirstName) > 16) {
        echo "First name must be between 2 and 16 characters.";
        exit;
    }
    elseif (!preg_match($lettersOnlyRegex, $spUserLastName)) {
        echo "Last name must contain only letters.";
        exit;
    }
    elseif (strlen($spUserLastName) < 2 || strlen($spUserLastName) > 16) {
        echo "Last name must be between 2 and 16 characters.";
        exit;
    }
    // Password validation if registration_source is not null
    if (!empty($registration_source)) {
        if (empty($password) || empty($confirm_password)) {
            echo "Password and Confirm Password are required.";
            exit;
        }
        if ($password !== $confirm_password) {
            echo "Passwords do not match.";
            exit;
        }
        if (strlen($password) < 6 || strlen($password) > 32) {
            echo "Password must be between 6 and 32 characters.";
            exit;
        }
    }

    $spUserName = $spUserFirstName." ".$spUserLastName;
    $spUserGender = isset($_POST["spUserGender"]) ? $_POST["spUserGender"] : "";
    if (empty($spUserGender) || !in_array($spUserGender, ['male', 'female','other'])) {
        echo "Gender is required and must be either 'male' or 'female'or 'other'";
        exit;
    }
    $_SESSION["username"] = $spUserName;
    $data = array("spUserFirstName" => $spUserFirstName, 'spUserLastName' => $spUserLastName ,'spUserName' => $spUserName,'spUserGender' => $spUserGender);
    if (!empty($registration_source)) {
        $data['spUserPassword'] = hash('sha256', $password);
    }
    $spdata = array("spUserFirstName" => $spUserFirstName, 'spUserLastName' => $spUserLastName ,'spUserName' => $spUserName);
    $profile_data = array("spProfileName" => $spUserFirstName . " ".$spUserLastName);
    $st = new _spuser;
    $sta = $st->updatepersonal($data , $id);
    $pro_obj = new _spprofiles;
    $pro_obj->updateMasterProfile($profile_data , $id);

    if($_SESSION['event_user'] == 1){
        $_SESSION['pageid'] = '3';
        header("Location: $BaseUrl1/registration-steps.php?pageid=3");
    }else{
        $_SESSION['pageid'] = '2';
        header("Location: $BaseUrl1/registration-steps.php?pageid=2");
    }
}

function isValidDate($date, $month, $year) {
    $dateString = sprintf("%04d-%02d-%02d", $year, $month, $date);
    $dateTime = DateTime::createFromFormat('Y-m-d', $dateString);
    return $dateTime && $dateTime->format('Y-m-d') === $dateString;
}

if(isset($_POST['addaddress'])){
    $id = $_SESSION["useridd"];
    $spUserCountry = isset($_POST["spUserCountry"]) ? $_POST["spUserCountry"] : "";
    $spUserState =  isset($_POST["spUserState"]) ? $_POST["spUserState"] : "";
    $spUserCity =  isset($_POST["spUserCity"]) ? $_POST["spUserCity"] : "";
    $currency = isset($_POST["currency"]) ? $_POST["currency"] : "";
    $locationService = (isset($_POST['locationService']) && $_POST['locationService'] == 'on') ? 1 : 0;
    $date =  isset($_POST["day"]) ? intval($_POST["day"]) : "";
    $month =  isset($_POST["month"]) ? intval($_POST["month"]) : "";
    $year = isset($_POST["year"]) ? intval($_POST["year"]) : "";
    $dob = isValidDate($date, $month, $year);
    $loc_data = selectQ("SELECT * FROM tbl_city WHERE country_id = ? AND state_id = ? AND city_id = ?", "iii", array($spUserCountry, $spUserState, $spUserCity));

    if (empty($spUserCountry) || empty($spUserState) || empty($spUserCity)) {
        echo 'Country, state, and city are required.';
        exit;
    }
    elseif(!$loc_data){
        echo "Error: No data found for the specified location.";
        exit;
    }

    if(empty($date) || empty($month) || empty($year)){
        echo 'Date of Birth required.';
        exit;
    }

    if (!$dob) {
        echo "Invalid date of birth.";
        exit;
    } else {
        $currentYear = date("Y");
        $age = $currentYear - $year;
        if ($age < 10 || $age > 90) {
            echo "Age must be between 10 and 90.";
            exit;
        }
    }
    $dob = date("Y-m-d", mktime(0, 0, 0, $month, $date, $year));
    $data = array("spUserCountry"=>$spUserCountry ,'spUserState'=>$spUserState,'spUserCity' => $spUserCity, 'currency'=>$currency, 'spLocationService'=>$locationService, 'spUserDob' => $dob);
    $st= new _spuser;
    $sta = $st->updatepersonal($data , $id);
    $_SESSION['reg_country'] = $spUserCountry ;
    $_SESSION['reg_state'] = $spUserState;
    $_SESSION['reg_city'] = $spUserCity;
    $_SESSION['pageid'] = 3;
    header("Location: $BaseUrl1/registration-steps.php?pageid=3");
}

if(isset($_POST["vcode"]) && $_POST["vcode"] != "" && isset($_POST["uid"]) && $_POST["uid"] != "")
{
    $u = new _spuser;
    $uid = isset($_POST["uid"]) ? (int) $_POST["uid"] : 0;
    $res = $u->loginverifycode($uid);
    if($res){
        $row = mysqli_fetch_assoc($res);

        $code = $_POST["vcode"];
        $datacode = $row["phone_verify_code"];

        if($code == $datacode)
        {
            $e = new _email;
            $au_email = $row["spUserEmail"];
            $_SESSION["email"] =  $row["spUserEmail"];
            $au_userfirstname =$row["spUserFirstName"];
            $au_me =$row["idspUser"];
            $ew = new _spprofiles;
            $result = $ew->read_description(6);
            if($result != false){
                $rows = mysqli_fetch_assoc($result);
                $message = $rows['notification_description'];
                $subject = $rows['subject'];
                $e->send_welcome_email($message,$subject,$au_email,$au_userfirstname,$au_me,'');
            }
            $u->activePhone($row["idspUser"]);
            $_SESSION['pageid'] = 5;
            if($_SESSION['event_user'] == 1){
                $_SESSION['pid'] = $uid;
                $url = $BaseUrl1 . '/' . $_SESSION['afterlogin'];
                header("Location: $url");
            }else{
                header("Location: $BaseUrl1/registration-steps.php?pageid=5");
            }
        }
        else
        {
            $otperror= "Invalid OTP";

        }
    }
}


if(isset($_POST['phonevalue'])){
    $id = isset($_POST["uid"]) ? $_POST["uid"] : "";
    $spUserPhone = isset($_POST["spUserPhone"]) ? $_POST["spUserPhone"] : "";
    $countrycode = isset($_POST["countrycode"]) ? $_POST["countrycode"] : "";

    if(empty($countrycode)) {
        echo "Country code is required";
        exit;
    }

    // Validate mobile number
    if(empty($spUserPhone)) {
        echo "Mobile number is required";
        exit;
    }
    // elseif(!is_numeric($spUserPhone)) {
    //     echo "Mobile number must be a numeric value";
    //     exit;
    // }
    elseif(strlen($spUserPhone) < 6 || strlen($spUserPhone) > 16) {
        echo "Mobile number must be between 6 and 16 characters long";
        exit;
    }

    $st = new _spuser;
    $existingPhone = $st->checkPhoneInDatabase($spUserPhone );
    if($existingPhone) {

        $_SESSION["Error"]="This phone number already exists";

        if(isset($_SESSION["Error"])){
            header("Location: $BaseUrl1/registration-steps.php?pageid=3");
            exit;
        }
    }
    // Generate OTP
    $otp = sprintf('%04d', mt_rand(0, 9999));

    $_SESSION['phone_otp'] = $otp;

    // Update database with user information
    $data=array("spUserCountryCode" => $countrycode, "spUserPhone"=>$spUserPhone, "phone_verify_code" => $otp);

    $cmpletenumber = $countrycode.$spUserPhone;
    $sta = $st->updatepersonal($data , $id);

    // Optionally, you can send the OTP via SMS here
    // callSmsApi($cmpletenumber, 'Your SharePage Registration OTP is: '.$otp);

    // Redirect user after form submission
    $_SESSION['pageid'] = 4;
    header("Location: $BaseUrl1/registration-steps.php?pageid=5");
    exit;
}

if (isset($_POST['profile_save'])) {
    $id = $_SESSION["useridd"];
    $filename='';
    $upload_location = $_SERVER['DOCUMENT_ROOT'].'/uploadimage/';
    $filename = $_FILES["profile_photo"]["name"];
    $tempname = $_FILES["profile_photo"]["tmp_name"];

    $image = new Image;
    $extensionError = $image->validateFileImageExtensions($_FILES["profile_photo"]);
    if($extensionError !== null) {

        $_SESSION["Error"]=$extensionError;
        if(isset($_SESSION["Error"])){
            header("Location: $BaseUrl1/registration-steps.php?pageid=6");
        }
        echo $extensionError;
        exit;
    }
    $fileSize = $_FILES["profile_photo"]["size"];
    $maxFileSize = 5 * 1024 * 1024;
    if ($fileSize > $maxFileSize) {

        $Error="File size exceeds the maximum allowed size of 5MB.";
        $_SESSION["Error"]= $Error;
        if(isset($_SESSION["Error"])){
            header("Location: $BaseUrl1/registration-steps.php?pageid=6");
        }
        echo $Error;
        exit;
    }

    $s3Class = new s3Class(3);
    $pathInfo = pathinfo($filename);
    $extension = $pathInfo['extension'];
    $bucket = $s3Class->addS3Image($tempname, $extension);
    $urll = $bucket['url'];
    $data=array("spProfilePic"=>$urll);
    $st= new _spuser;
    $p = new _spprofiles;
    $sps_id = $_SESSION['pid'];
    $usrname = $_SESSION["username"];
    $sta= $st->updatepersonal($data , $id);
    $stas= $p->updateprofilesp($usrname, $urll, $sps_id);

    if(isset($_SESSION["Error"])){
        header("Location: $BaseUrl1/registration-steps.php?pageid=6");
    }
    else{
        header("Location: $BaseUrl1/registration-steps.php?pageid=7");
    }

}

if (isset($_POST['publish'])) {
    $wanttodonow = $_POST['wanttodonow'];
    if($wanttodonow == 'job'){
        $_SESSION['ptid'] = 1;
        $_SESSION['sign-up'] = 1;
        header("Location: $BaseUrl1/post-ad/job-board/postJob.php");
    }else if($wanttodonow == 'Store'){
        $_SESSION['sign-up'] = 1;
        //$_SESSION['afterMembership']="/store/storeindex.php";
        header("Location: $BaseUrl1/registration-steps.php?pageid=10");
    }else if($wanttodonow == 'real_state'){
        $_SESSION['sign-up'] = 1;
        header("Location: $BaseUrl1/post-ad/real-estate/");
    }else if($wanttodonow == 'project'){
        $_SESSION['ptid'] = 1;
        $_SESSION['sign-up'] = 1;
        header("Location: $BaseUrl1/post-ad/freelancer/indexpostproject.php");
    }else if($wanttodonow == 'personal'){
        $_SESSION['ptid'] = 1;
        $_SESSION['sign-up'] = 1;
        header("Location: $BaseUrl1/store/personal.php?page=1");
    }
    else{
        header("Location: $BaseUrl1/registration-steps.php?pageid=8");
    }

}

if (isset($_POST['publish8'])) {
    $postupdate = $_POST['postupdate'];
    if($postupdate == 'rental'){
        $_SESSION['pro-ac'] = 1;
        $_SESSION['sign-up'] = 1;
        header("Location: $BaseUrl1/post-ad/real-estate/?type=1");
    }else if($postupdate == 'event'){
        $_SESSION['sign-up'] = 1;
        $_SESSION['pro-ac'] = 1;
        header("Location: $BaseUrl1/post-ad/events/?post");
    }else if($postupdate == 'art_craft'){
        $_SESSION['sign-up'] = 1;
        $_SESSION['pro-ac'] = 1;
        header("Location: $BaseUrl1/post-ad/photos/?post");
    }else if($postupdate == 'advertise'){
        $_SESSION['sign-up'] = 1;
        $_SESSION['pro-ac'] = 1;
        header("Location: $BaseUrl1/post-ad/services/?post");
    }
    else{
        header("Location: $BaseUrl1/registration-steps.php?pageid=9");
    }
}

if (isset($_POST['publish9'])) {
    $postupdate9 = $_POST['postupdate9'];
    if($postupdate9 == 'post_video'){
        header("Location: $BaseUrl1/videos/uploadform.php");
    }else if($postupdate9 == 'look_job'){
        header("Location: $BaseUrl1/job-board/all-jobs.php");
    }else if($postupdate9 == 'freelance'){
        $_SESSION['sign-up'] = 1;
        header("Location: $BaseUrl1/freelancer/");
    }
    else{
        $_SESSION['uid'] = $_SESSION['chkuid'];
        $st= new _spuser;
        $dt = $st->activate($_SESSION['uid']);
        $user_query = $st->read_name($_SESSION['uid']);
        if($user_query){
            $row_user = mysqli_fetch_assoc($user_query);
            if(!$row_user['default_profile_id']){
                $p = new _spprofiles;
                $result_profile = $p->readDefaultProfile($_SESSION['uid']);
                
                if ($result_profile != false) {
                    $row_profile = mysqli_fetch_assoc($result_profile);
                    $_SESSION["pid"] = $row_profile['idspProfiles'];
                    if($row_profile['spProfileType_idspProfileType'] == 4){
                     $_SESSION["ptname"] = 'Personal';
                }
            }
          }
        }
        
        header("Location: $BaseUrl1/timeline/");
    }

}

if(isset($_POST['congrats'])){
    $i = 0;
    $u = new _spuser;
    $uc = new _city;
    $re = new _redirect;

    $spUserEmail = $_SESSION["email"];
    $r = $u->checkemail($spUserEmail);
    if ($r != false) {
        $result2 = $u->chekLock($spUserEmail);
        if ($result2) {
            if ($r->num_rows == 1) {
                if ($rows = mysqli_fetch_array($r)) {
                    $spUserEmail = $rows['spUserEmail'];
                    $spUserPassword = $rows['spUserPassword'];
                    $userid=$rows['idspUser'];
                    $fname=$rows['spUserFirstName'];
                    $userId = $rows['idspUser'];
                    $u->update_login_status($userId);
                    $result = $u->read($userId);
                    $ip = $_SERVER['REMOTE_ADDR'];
                    function ip_details($ip)
                    {
                        $json       = file_get_contents("http://ipinfo.io/{$ip}");

                        $details    = json_decode($json);
                        return $details;
                    }
                    $details    =   ip_details("$ip");
                    $country= $details->country;

                    $check_country=$uc->readCityName_country($country);
                    if ($check_country) {
                        $row_c = mysqli_fetch_assoc($check_country);

                        $row_country = $row_c['countryname'];

                    }
                    $country=$row_country;
                    $date_time = date("Y-m-d H:i:s") ;
                    $check=$u->read_ip($userId,$ip);
                    //var_dump($check);die;
                    if($check==false){
                        $uemail = new _email;
                        $uemail->send_all_email($spUserEmail , "The SharePage", $msg);
                        //mail($spUserEmail , "New - The SharePage", $msg, $headers);
                        // $re = new _redirect;
                        $create_ip = array("users_ip"=>$ip,"spuser_idspuser"=>$userid,"country"=>$country,"date"=>date('Y-m-d H:i:s'));
                        $ipp = $u->create_ip($create_ip);
                    }
                    // echo "<pre>";print_r($rows);die();
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        $genratecode = $row['phone_verify_code'];

                        $mobile = $row["spUserCountryCode"].$row['spUserPhone'];
                        if ($row["twostep"]  == 0) {

                            if ($rows['is_email_verify'] == 1) {

                                /*session_start();*/
                                // UPDATE USER IP IN DATABASE
                                $ip = $_SERVER['REMOTE_ADDR'];

                                if ($ip != '') {
                                    $result11 = $u->updateIp($ip, $rows['idspUser']);
                                }

                                $_SESSION['login_user'] = $rows['spUserName'];
                                $_SESSION['uid'] = $rows['idspUser'];
                                $_SESSION['spUserEmail'] = $rows['spUserEmail'];
                                $p = new _spprofiles;
                                //$rp = $p->readProfiles($_SESSION['uid']);
                                //login with default profile
                                $rp = $p->readDefaultProfile($_SESSION['uid']);

                                if ($rp != false) {
                                    $row = mysqli_fetch_array($rp);
                                    $profileData = array(
                                        'is_active' => 1,
                                        'spProfileName' => $_SESSION['username'],
                                        'spProfilesCountry' => $_SESSION['reg_country'],
                                        'spProfilesState' => $_SESSION['reg_state'],
                                        'spProfilesCity' => $_SESSION['reg_city'],
                                    );

                                    $updateid = $p->update($profileData, "WHERE t.idspProfiles =" . $row['idspProfiles']);

                                    $_SESSION['pid']            = $row['idspProfiles'];
                                    $_SESSION['myprofile']      = $row["spProfileName"];
                                    $_SESSION['MyProfileName']  = $row["spProfileName"];
                                    $_SESSION['ptname']         = $row["spProfileTypeName"];
                                    $_SESSION['ptpeicon']       = $row["spprofiletypeicon"];
                                    $_SESSION['ptid']           = $row["spProfileType_idspProfileType"];
                                    $_SESSION['spProfilesCountry'] = $_SESSION['reg_country'];
                                    $_SESSION['spProfilesState'] = $_SESSION['reg_state'];
                                    $_SESSION['spProfilesCity'] = $_SESSION['reg_city'];
                                    $_SESSION['isActive']       = 1;
                                    $c = new _order;
                                    $res = $c->read($_SESSION['pid']);

                                    if ($res != false) {
                                        $_SESSION['cartcount'] = $res->num_rows;
                                    } else {
                                        $_SESSION['cartcount'] = 0;
                                    }
                                }

                                if (isset($_SESSION['login_user'])) {
                                    if (isset($_SESSION['afterlogin'])) {
                                        $redirctUrl = $BaseUrl . "/" . $_SESSION['afterlogin'];
                                    } else {
                                        $redirctUrl = $BaseUrl . "/timeline/";
                                    }
                                    echo $redirctUrl;
                                }
                            }
                        }
                    }

                }
            }
        }
    }

    unset($_SESSION['pageid']);
    unset($_SESSION['reg_country']);
    unset($_SESSION['reg_state']);
    unset($_SESSION['reg_city']);
    header("Location: $BaseUrl1/registration-steps.php?pageid=6");
}
// echo $_SESSION['phone_otp'];
// echo "<pre>"; print_r($_SESSION);die();

?>
<link rel="stylesheet" href="assets/css/signupcss/all.css">
<link rel="stylesheet" href="assets/css/signupcss/all.min.css">


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
    <link rel="stylesheet" href="image/bootstartp-5/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/signupcss/style.css">
    <title>Congratulations</title>
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/country/css/intlTelInput.css">
    <script type="text/javascript">
        /*$(function() {
        $('#respUserEphone').keypress(function(event) {
        if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
        event.preventDefault(); //stop character from entering input
        }
        });
        });*/
    </script>
    <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/country/css/intlTelInput.css">
    <style>
        .intl-tel-input.separate-dial-code .selected-dial-code {
            padding-left: 10px !important;
        }
        span.otperror {
            color: red;
            margin-left: 8px;
        }
        .loct_thr {
            display: grid;
            column-gap: 17px;
            row-gap: 10px;
            grid-template-columns: repeat(3, 1fr);
        }
        .buss_pro hr {
            width: 12%;
            height: 5px;
            background: var(--text-orngclr);
            opacity: 1;
        }
        .loct_thr select.form-select,
        .createbusiness select.form-select,
        .bus_nme>input {
            font-size: 14px;
            background-color: #F9FAFB;
            border: none !important;
        }
        .crt_buss_pro {
            max-width: 610px !important;
        }
        .crt_buss_pro .tell-us_sec {
            padding: 13px 25px !important;
        }
        .crt_buss_pro .tell-us_sec .head_title {
            font-size: 26px;
            font-weight: 500;
            line-height: 36px;
        }
        .bus_nme label {
            font-size: 18px;
            font-weight: 500;
            line-height: 20px;
        }
        .bus_loct_head>h3 {
            font-size: 22px;
            font-weight: 500;
            line-height: 20px;
            color: #FB8308;
        }
        .buss_btn a{
            color: #7649B3;
            font-weight: 600;
        }
        .buss_btn a i{
            background-color: #7649B3;
            padding: 5px;
            color: #fff;
            border-radius: 5px;
        }
        .buss_btn input{
            padding: 3px 30px;
            border-radius: 30px;
            background-color: #7649B3;
            border: none;
            color: #fff;
        }

        @media screen and (max-width: 480px) {
            .loct_thr{
                grid-template-columns: repeat(1, 1fr);
            }
        }
    </style>
</head>
<body>
<?php if($usr_id && !isset($_GET['pageid'])) {
    if(!isset($_SESSION['pageid']) || $_SESSION['pageid'] == 'verifyemail'){
        $_SESSION['pageid'] = 1;
    }
    ?>
    <section class="container log_in cong_mail">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center"><img src="image/logosharepage 1.png" class="img-fluid" alt=""></div>
            <h2 class="mb-3">The SharePage</h2>
        </div>
        <div class="col-12 cong_mail_sec cog_mail">
            <div class="text-center">
                <div class="innr_img_cong d-flex justify-content-center">
                    <div><img src="image/congratulation.png" alt=""></div>
                </div>
                <h2 class="mt-2 mb-1">Congratulations!</h2>
                <h3 class="my-lg-2 my-1">Your Email is Successfully<br>
                    Verified! </h3>
            </div>
            <form id="sendOtpForm" class="col-12 cont form" method="post" action="registration-steps.php" autocomplete="chrome-off">
                <h4 class="text-center my-3">Let Us Know A Little More About You</h4>
                <?php if($usr_id)  {
                    $id = $usr_id;
                     // Check registration_source
                    $showPasswordFields = false;
                    $userrdata= new _spuser;
                    $userdata= $userrdata->read_name($usr_id);
                    $row = mysqli_fetch_assoc($userdata);
                    if (!empty($row['registration_source'])) {
                        $showPasswordFields = true;
                    }
                } else{ 
                    $id ='';
                    $showPasswordFields = false;
                } ?>
                <div class="form_field my-lg-2 my-1 d-grid">
                  <input type="hidden" name="user_id" value="<?php echo $id ?>">
                    <label for="" class=" my-2 text-capitalize">first name<span class="req_star">*</span></label>
                    <input type="text" id="spUserFirstName" data-lo="0" name="spUserFirstName" minlength="2" maxlength="16" placeholder="Enter First Name" value="<?php if($first_name !=''){ echo $first_name;} ?>" class="form-control" required>
                    <span class="error_message" id="first_name_error"style="color: red;"></span>

                </div>
                <span class="spUserEmail erormsg" id="email2"></span>
                <div class="form_field my-lg-2 my-1 d-grid">
                    <label for="" class="my-2 text-capitalize">last name<span class="req_star">*</span></label>
                    <input type="text" id="spUserLastName" data-lo="0" name="spUserLastName" minlength="2" maxlength="16" value="<?php if($last_name !=''){ echo $last_name;} ?>" placeholder="Enter Last Name" class="form-control" required>
                    <span class="error_message" id="last_name_error"style="color: red;"></span>
                </div>
                <span class="spUserEmail erormsg" id="lst_name"></span>
                <div class="form_field my-lg-2 my-1 d-grid">
                    <label for="" class=" my-2 text-capitalize">Gender<span class="req_star">*</span></label>
                    <select class="form-select" name="spUserGender" aria-label="Default select example" required>
                        <option value="" <?php if(empty($spUserGender)) { echo 'selected'; } ?>>Select Gender</option>
                        <option value="male" <?php if($spUserGender == 'male' ){ echo 'selected';} ?>>Male</option>
                        <option value="female" <?php if($spUserGender == 'female' ){ echo 'selected';} ?>>Female</option>
                        <option value="other" <?php if($spUserGender == 'other' ){ echo 'selected';} ?>>Other</option>
                    </select>
                </div>

               <?php if($showPasswordFields) { ?>
               <div class="form_field my-lg-2 my-1 d-grid">
                   <label for="password" class="my-2 text-capitalize">Password<span class="req_star">*</span></label>
                   <input type="password" id="password" name="password" minlength="6" maxlength="32" placeholder="Enter Password" class="form-control" required>
               </div>
               <div class="form_field my-lg-2 my-1 d-grid">
                   <label for="confirm_password" class="my-2 text-capitalize">Confirm Password<span class="req_star">*</span></label>
                   <input type="password" id="confirm_password" name="confirm_password" minlength="6" maxlength="32" placeholder="Confirm Password" class="form-control" required>
               </div>
               <?php } ?>
                <div class="cong_btn my-3 d-flex justify-content-center">
                    <input type="submit" value="CONTINUE" onclick="myFunction()" name="save" class="text-uppercase" value="Continue">
                </div>
            </form>
        </div>
    </section>
<?php }else if($_GET['pageid'] == '2'){  ?>
    <section class="container tell-us">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The SharePage</h2>
        </div>

        <form class="col-12 tell-us_sec form" onsubmit="return locationValidForm()" method="post" action="registration-steps.php" autocomplete="chrome-off">
            <div class="text-center">
                <h3 class="mt-2 mb-1 head_title">Tell Us Where You Live & Your <br>
                    Preferred Currency</h3>
                <hr>
            </div>
            <?php
            if($usr_id)  {
                $id = $usr_id;
            }else{
                $id ='';
            }
            $userrdata= new _spuser;
            $userdata= [];
            if(isset($_SESSION["useridd"])){
                $userrdata->read_name($_SESSION["useridd"]);
                if($userdata != false){
                    $row = mysqli_fetch_assoc($userdata);
                    $usercountry = $row['spUserCountry'];
                    $userstate = $row['spUserState'];
                    $usercity = $row['spUserCity'];
                    $usercurrency = $row['currency'];
                    $userLocationService = $row['spLocationService'];
                    $spUserDob = $row['spUserDob'];
                    if(isset($row['spUserDob'])){
                        list($Dobyear, $Dobmonth, $Dobday) = explode("-", $row['spUserDob']);
                    }
                }
            }
            ?>
            <input type="hidden" name="user_id" value="<?php echo $id ?>">
            <div class="form-group text-start py-lg-1 py-0 cntry_clm_2">
                <div class="">
                    <label for="" class=" my-2 text-capitalize">Country<span class="req_star">*</span></label>
                    <select class="form-select" id="spUserCountry11" name="spUserCountry" aria-label="Default select example">
                        <option value="">Select Country</option>
                        <?php
                        $co = new _country;
                        $result3 = $co->readCountry();
                        if ($result3) {
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                ?>
                                <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id']) ? 'selected' : ''; ?> ><?php echo $row3['country_title']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <label class="spUserCountry erormsg "  id="countryerror" style="color:red;"></label>
                </div>
                <div class="form-group">
                    <div class="loadUserState">
                        <label for="" class="my-2 text-capitalize">State<span class="req_star">*</span></label>
                        <select class="form-select"  name="spUserState" id="spUserState22" aria-label="Default select example">
                            <option value="">Select State</option>
                            <?php
                            if(isset($usercountry) && trim($usercountry) != '') {
                                $state = new _state;
                                $result4 = $state->readState($usercountry);
                                if ($result4) {
                                    while ($row4 = mysqli_fetch_assoc($result4)) {
                                        ?>
                                        <option value='<?php echo $row4['state_id']; ?>' <?php echo (isset($userstate) && $userstate == $row4['state_id']) ? 'selected' : ''; ?> ><?php echo $row4['state_title']; ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                        <span class="spUserState erormsg" id="state" style="color:red;"></span>

                    </div>
                </div>
            </div>
            <div class="form-group text-start py-lg-2 py-0 cntry_clm_2">
                <div class=" form-group">
                    <div class="loadCity">
                        <label for="" class=" my-2 text-capitalize">City</label>
                        <select class="form-select" name="spUserCity" id="spUserCity" onchange="f12()" aria-label="Default select example">
                            <option value="">Select City</option>
                            <?php
                             if(isset($userstate) && trim($userstate)!= '') {
                                $city = new _city;
                                $result5 = $city->readCity($userstate);
                                if ($result5) {
                                    while ($row5 = mysqli_fetch_assoc($result5)) {
                                        ?>
                                        <option value='<?php echo $row5['city_id']; ?>' <?php echo (isset($usercity) && $usercity == $row5['city_id']) ? 'selected' : ''; ?> ><?php echo $row5['city_title']; ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>
                        <span class="spUserCity erormsg" id="cityerr" style="color: red;"></span>
                    </div>
                </div>

                <div class=" form-group">
                    <label for="" class="my-2 text-capitalize">Preferred Currency</label>
                    <select class="form-select" name="currency" aria-label="Default select example" required>
                        <option value="USD" <?php if( empty($usercurrency) || $usercurrency == 'USD' ){ echo 'selected';} ?>>United States Dollars</option>
                        <option value="EUR" <?php if($usercurrency == 'EUR' ){ echo 'selected';} ?>>Euro</option>
                        <option value="GBP" <?php if($usercurrency == 'GBP' ){ echo 'selected';} ?>>United Kingdom Pounds</option>
                        <option value="DZD" <?php if($usercurrency == 'DZD' ){ echo 'selected';} ?>>Algeria Dinars</option>
                        <option value="ARP" <?php if($usercurrency == 'ARP' ){ echo 'selected';} ?>>Argentina Pesos</option>
                        <option value="AUD" <?php if($usercurrency == 'AUD' ){ echo 'selected';} ?>>Australia Dollars</option>
                        <option value="ATS" <?php if($usercurrency == 'ATS' ){ echo 'selected';} ?>>Austria Schillings</option>
                        <option value="BSD" <?php if($usercurrency == 'BSD' ){ echo 'selected';} ?>>Bahamas Dollars</option>
                        <option value="BBD" <?php if($usercurrency == 'BBD' ){ echo 'selected';} ?>>Barbados Dollars</option>
                        <option value="BEF" <?php if($usercurrency == 'BEF' ){ echo 'selected';} ?>>Belgium Francs</option>
                        <option value="BMD" <?php if($usercurrency == 'BMD' ){ echo 'selected';} ?>>Bermuda Dollars</option>
                        <option value="BRR" <?php if($usercurrency == 'BRR' ){ echo 'selected';} ?>>Brazil Real</option>
                        <option value="BGL" <?php if($usercurrency == 'BGL' ){ echo 'selected';} ?>>Bulgaria Lev</option>
                        <option value="CAD" <?php if($usercurrency == 'CAD' ){ echo 'selected';} ?>>Canada Dollars</option>
                        <option value="CLP" <?php if($usercurrency == 'CLP' ){ echo 'selected';} ?>>Chile Pesos</option>
                        <option value="CNY" <?php if($usercurrency == 'CNY' ){ echo 'selected';} ?>>China Yuan Renmimbi</option>
                        <option value="CYP" <?php if($usercurrency == 'CYP' ){ echo 'selected';} ?>>Cyprus Pounds</option>
                        <option value="CSK" <?php if($usercurrency == 'CSK' ){ echo 'selected';} ?>>Czech Republic Koruna</option>
                        <option value="DKK" <?php if($usercurrency == 'DKK' ){ echo 'selected';} ?>>Denmark Kroner</option>
                        <option value="NLG" <?php if($usercurrency == 'NLG' ){ echo 'selected';} ?>>Dutch Guilders</option>
                        <option value="XCD" <?php if($usercurrency == 'XCD' ){ echo 'selected';} ?>>Eastern Caribbean Dollars</option>
                        <option value="EGP" <?php if($usercurrency == 'EGP' ){ echo 'selected';} ?>>Egypt Pounds</option>
                        <option value="FJD" <?php if($usercurrency == 'FJD' ){ echo 'selected';} ?>>Fiji Dollars</option>
                        <option value="FIM" <?php if($usercurrency == 'FIM' ){ echo 'selected';} ?>>Finland Markka</option>
                        <option value="FRF" <?php if($usercurrency == 'FRF' ){ echo 'selected';} ?>>France Francs</option>
                        <option value="DEM" <?php if($usercurrency == 'DEM' ){ echo 'selected';} ?>>Germany Deutsche Marks</option>
                        <option value="XAU" <?php if($usercurrency == 'XAU' ){ echo 'selected';} ?>>Gold Ounces</option>
                        <option value="GRD" <?php if($usercurrency == 'GRD' ){ echo 'selected';} ?>>Greece Drachmas</option>
                        <option value="HKD" <?php if($usercurrency == 'HKD' ){ echo 'selected';} ?>>Hong Kong Dollars</option>
                        <option value="HUF" <?php if($usercurrency == 'HUF' ){ echo 'selected';} ?>>Hungary Forint</option>
                        <option value="ISK" <?php if($usercurrency == 'ISK' ){ echo 'selected';} ?>>Iceland Krona</option>
                        <option value="INR" <?php if($usercurrency == 'INR' ){ echo 'selected';} ?>>India Rupees</option>
                        <option value="IDR" <?php if($usercurrency == 'IDR' ){ echo 'selected';} ?>>Indonesia Rupiah</option>
                        <option value="IEP" <?php if($usercurrency == 'IEP' ){ echo 'selected';} ?>>Ireland Punt</option>
                        <option value="ILS" <?php if($usercurrency == 'ILS' ){ echo 'selected';} ?>>Israel New Shekels</option>
                        <option value="ITL" <?php if($usercurrency == 'ITL' ){ echo 'selected';} ?>>Italy Lira</option>
                        <option value="JMD" <?php if($usercurrency == 'JMD' ){ echo 'selected';} ?>>Jamaica Dollars</option>
                        <option value="JPY" <?php if($usercurrency == 'JPY' ){ echo 'selected';} ?>>Japan Yen</option>
                        <option value="JOD" <?php if($usercurrency == 'JOD' ){ echo 'selected';} ?>>Jordan Dinar</option>
                        <option value="KRW" <?php if($usercurrency == 'KRW' ){ echo 'selected';} ?>>Korea (South) Won</option>
                        <option value="LBP" <?php if($usercurrency == 'LBP' ){ echo 'selected';} ?>>Lebanon Pounds</option>
                        <option value="LUF" <?php if($usercurrency == 'LUF' ){ echo 'selected';} ?>>Luxembourg Francs</option>
                        <option value="MYR" <?php if($usercurrency == 'MYR' ){ echo 'selected';} ?>>Malaysia Ringgit</option>
                        <option value="MXP" <?php if($usercurrency == 'MXP' ){ echo 'selected';} ?>>Mexico Pesos</option>
                        <option value="NLG" <?php if($usercurrency == 'NLG' ){ echo 'selected';} ?>>Netherlands Guilders</option>
                        <option value="NZD" <?php if($usercurrency == 'NZD' ){ echo 'selected';} ?>>New Zealand Dollars</option>
                        <option value="NOK" <?php if($usercurrency == 'NOK' ){ echo 'selected';} ?>>Norway Kroner</option>
                        <option value="PKR" <?php if($usercurrency == 'PKR' ){ echo 'selected';} ?>>Pakistan Rupees</option>
                        <option value="XPD" <?php if($usercurrency == 'XPD' ){ echo 'selected';} ?>>Palladium Ounces</option>
                        <option value="PHP" <?php if($usercurrency == 'PHP' ){ echo 'selected';} ?>>Philippines Pesos</option>
                        <option value="XPT" <?php if($usercurrency == 'XPT' ){ echo 'selected';} ?>>Platinum Ounces</option>
                        <option value="PLZ" <?php if($usercurrency == 'PLZ' ){ echo 'selected';} ?>>Poland Zloty</option>
                        <option value="PTE" <?php if($usercurrency == 'PTE' ){ echo 'selected';} ?>>Portugal Escudo</option>
                        <option value="ROL" <?php if($usercurrency == 'ROL' ){ echo 'selected';} ?>>Romania Leu</option>
                        <option value="RUR" <?php if($usercurrency == 'RUR' ){ echo 'selected';} ?>>Russia Rubles</option>
                        <option value="SAR" <?php if($usercurrency == 'SAR' ){ echo 'selected';} ?>>Saudi Arabia Riyal</option>
                        <option value="XAG" <?php if($usercurrency == 'XAG' ){ echo 'selected';} ?>>Silver Ounces</option>
                        <option value="SGD" <?php if($usercurrency == 'SGD' ){ echo 'selected';} ?>>Singapore Dollars</option>
                        <option value="SKK" <?php if($usercurrency == 'SKK' ){ echo 'selected';} ?>>Slovakia Koruna</option>
                        <option value="ZAR" <?php if($usercurrency == 'ZAR' ){ echo 'selected';} ?>>South Africa Rand</option>
                        <option value="KRW" <?php if($usercurrency == 'KRW' ){ echo 'selected';} ?>>South Korea Won</option>
                        <option value="ESP" <?php if($usercurrency == 'ESP' ){ echo 'selected';} ?>>Spain Pesetas</option>
                        <option value="XDR" <?php if($usercurrency == 'XDR' ){ echo 'selected';} ?>>Special Drawing Right (IMF)</option>
                        <option value="SDD" <?php if($usercurrency == 'SDD' ){ echo 'selected';} ?>>Sudan Dinar</option>
                        <option value="SEK" <?php if($usercurrency == 'SEK' ){ echo 'selected';} ?>>Sweden Krona</option>
                        <option value="CHF" <?php if($usercurrency == 'CHF' ){ echo 'selected';} ?>>Switzerland Francs</option>
                        <option value="TWD" <?php if($usercurrency == 'TWD' ){ echo 'selected';} ?>>Taiwan Dollars</option>
                        <option value="THB" <?php if($usercurrency == 'THB' ){ echo 'selected';} ?>>Thailand Baht</option>
                        <option value="TTD" <?php if($usercurrency == 'TTD' ){ echo 'selected';} ?>>Trinidad and Tobago Dollars</option>
                        <option value="TRL" <?php if($usercurrency == 'TRL' ){ echo 'selected';} ?>>Turkey Lira</option>
                        <option value="VEB" <?php if($usercurrency == 'VEB' ){ echo 'selected';} ?>>Venezuela Bolivar</option>
                        <option value="ZMK" <?php if($usercurrency == 'ZMK' ){ echo 'selected';} ?>>Zambia Kwacha</option>
                        <option value="EUR" <?php if($usercurrency == 'EUR' ){ echo 'selected';} ?>>Euro</option>
                        <option value="XCD" <?php if($usercurrency == 'XCD' ){ echo 'selected';} ?>>Eastern Caribbean Dollars</option>
                        <option value="XDR" <?php if($usercurrency == 'XDR' ){ echo 'selected';} ?>>Special Drawing Right (IMF)</option>
                        <option value="XAG" <?php if($usercurrency == 'XAG' ){ echo 'selected';} ?>>Silver Ounces</option>
                        <option value="XAU" <?php if($usercurrency == 'XAU' ){ echo 'selected';} ?>>Gold Ounces</option>
                        <option value="XPD" <?php if($usercurrency == 'XPD' ){ echo 'selected';} ?>>Palladium Ounces</option>
                        <option value="XPT" <?php if($usercurrency == 'XPT' ){ echo 'selected';} ?>>Platinum Ounces</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="dateOfBirth" class="form-label my-2"style="margin-bottom: 0.1rem !important" >Date of Birth<span class="req_star">*</span></label>
                <span class="year erormsg" id="doberror" style="color: red;"></span>
            </div>
            <div class="form-group text-start py-lg-2 py-0 cntry_clm_2">
                <input type="hidden" name="day" id="day" >
                <input type="hidden" name="month" id="month">
                <input type="hidden" name="year" id="year">
                <input type="date" class="form-select" style="background-image:none;padding: 0.25rem 0.25rem 0.375rem 0.75rem; background-color: #fafafa;font-size: 15px;"id="dateOfBirth" onchange="splitDate()" value="<?php if($spUserDob !=''){ echo $spUserDob;} ?>"max="<?php echo date('Y-m-d'); ?>">
            </div>

            <p class="text-start pt-3 pb-2 m-0 tell-cnt">If you enable your current location, we can accurately show you postings/services near you</p>
            <div class="d-flex chk_btn">
                <input type="checkbox" name="locationService" id="locationService" <?php if(isset($userLocationService) && $userLocationService == 1){ echo "checked"; } ?>>
                <p class="m-0 ps-2 chk_cnt">Enable Location Services</p>
            </div>
            <div class="nxt_btn p-0 my-3">
                <a href="<?php echo $BaseUrl?>/registration-steps.php" class="bck_btns tell_btns d-flex align-items-center " style="color:#4A0080; font-weight:600;"><i class="fa fa-angle-left les_btn" aria-hidden="true"></i> BACK</a>

                <input type="submit" value="NEXT" name="addaddress" class="nxt_btn tell_btn">
            </div>
        </form>
    </section>
<?php }else if($_GET['pageid'] == '3'){
    $id =  $_SESSION["useridd"];

    $userMobile = "";
    $userrdata= new _spuser;
    $userdata= $userrdata->read_name($id);
    if ($userdata != false) {
        $row = mysqli_fetch_assoc($userdata);
        if (isset($row['spUserCountry'])) {
            $countrydata = new _country;
            $countryInfo = $countrydata->readCountryName($row['spUserCountry']);
            if ($countryInfo != false) {
                $row1 = mysqli_fetch_assoc($countryInfo);
                $country_code = $row1['country_code'];
                if (isset($row['spUserCountryCode'])) {
                    $userMobile = "+" . $row['spUserCountryCode'] . $row['spUserPhone'];
                } else {
                    if ($country_code != "") {
                        $userMobile = "+" . $country_code;
                    }
                }
            }
        }
    }

    ?>
    <section class="container tell-us">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The SharePage</h2>
        </div>
        <form class="col-12 tell-us_sec cong_mob" method="post" action="" autocomplete="chrome-off">
            <div class="text-center">
                <h3 class="mt-2 mb-1 head_title">What's your phone number</h3>
                <hr>
            </div>
            <p class="text-center pt-3 pb-2 m-0 tell-cnt">Please enter your phone number.</p>
            <div class="d-flex my-2 nmber_sec ">
                <div class="respUserEphoneDiv vrify_mo d-flex">
                    <?php $otp = sprintf('%04d', mt_rand(0, 9999));  ?>
                    <input type="hidden" name="uid" value="<?php echo $id; ?>">


                    <input type="hidden" name="countrycode" id="countrycode" value="">
                    <input type="text" class=" px-2 py-1 vfy_no inpt Checkphone col-12" onkeyup="Checkphone(this.value)" id="respUserEphone" name="spUserPhone"  value="<?php if(isset($userMobile)) { echo $userMobile; } ?>" placeholder="" minlength="6" maxlength="16" required>
                    <input type="submit" value="SUBMIT" id="phonevalue" name="phonevalue" class="nxt_btn tell_btn col-3">
                </div>
            </div>
            <span class="Error erormsg" id="error" style="color: red;"> <?php if (isset($_SESSION["Error"])) { echo $_SESSION["Error"];
                    unset($_SESSION["Error"]); } ?></span>
            <div class="vrify_mobssd d-flex justify-content-center my-4">
                <?php if($_SESSION['event_user'] == 1){ ?>
                    <a href="<?php echo $BaseUrl?>/registration-steps.php" class="bck_btns tell_btns d-flex align-items-center " style="color:#4A0080; font-weight:600;"><i class="fa fa-angle-left les_btn" aria-hidden="true"></i> BACK</a>

                <?php }else{ ?>
                    <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=2" class="bck_btns tell_btns d-flex align-items-center " style="color:#4A0080; font-weight:600;"><i class="fa fa-angle-left les_btn" aria-hidden="true"></i> BACK</a>
                <?php } ?>
                <!-- <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=5" class="bck_btn tell_btn pro_skp " >SKIP </a>
                <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=2" class="bck_btn tell_btn pro_skp " >BACK </a>-->
            </div>
        </form>
    </section>

<?php }else if($_GET['pageid'] == '4'){
    $id =  $_SESSION["useridd"];
    if(isset($_GET['resend']) && $_GET['resend'] = 1){
        $otp = mt_rand(0, 9999);
        $data=array("phone_verify_code" => $otp);
        $st= new _spuser;
        $userdata= $st->read_name($id);
        $row = mysqli_fetch_assoc($userdata);
        $spUserPhone = $row['spUserCountryCode'].$row['spUserPhone'];
        $sta= $st->updatepersonal($data , $id);
        callSmsApi($spUserPhone,'Your SharePage Registration OTP is: '.$otp);
    }
    $userrdata= new _spuser;
    $userdata= $userrdata->read_name($id);
    $row = mysqli_fetch_assoc($userdata);
    $phone =$row['spUserPhone'];
    ?>
    <section class="container tell-us">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The Sharepage</h2>
        </div>
        <form class="col-12 tell-us_sec cong_mob" method="post" action="" autocomplete="chrome-off">
            <div class="text-center">
                <h3 class="mt-2 mb-1 head_title">Enter Code</h3>
                <hr>
            </div>
            <p class="text-center pt-3 pb-2 m-0 tell-cnt">Enter the code we sent to <br>your phone <?php echo $row['spUserCountryCode'].' '.$phone; ?></p>
            <div class="d-grid my-2 nmber_sec ">
                <input type="hidden" name="uid" value="<?php echo $id; ?>">
                <input type="text" name="vcode" class="px-3 py-2 vfy_no inpt form-control rounded" required  placeholder="Enter Code">
            </div>
            <span class="otperror"><?php echo $otperror; ?></span>
            <div class="d-flex justify-content-center rsend_time">
                <?php $otp = sprintf('%04d', mt_rand(0, 9999));  ?>
                <p class="pe-2 m-0 resend_cnt rsnd_t"><a id="resendbutton" data-id="<?php echo $BaseUrl1; ?>/registration-steps.php?pageid=4&resend=1">Resend It</a></p>
                <p id="timmer" class="m-0 snd_time rsnd_t"></p>
            </div>
            <div class="nxt_btn my-4">
                <input type="button" value="BACK" class="bck_btn tell_btn">
                <input type="submit" value="VERIFY" class="nxt_btn tell_btn">
            </div>
        </form>
    </section>

<?php }else if($_GET['pageid'] == '5'){ ?>

    <section class="container tell-us ">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The SharePage</h2>
        </div>
        <form class="col-12 tell-us_sec cong_mob" method="post" action="registration-steps.php" autocomplete="chrome-off">
            <div class="innr_img_cong d-flex justify-content-center">
                <div><img src="image/cong_mob.png " class="img-fluid" alt=""></div>
            </div>
            <div class="text-center">
                <h2 class="mt-2 mb-1 cong_cnt">Congratulations!</h2>
                <h3>Your Personal Profile is Created <br> Successfully! </h3>
            </div>
            <div class="d-flex justify-content-center my-4">
                <input type="submit" value="CONTINUE" name="congrats" class="cong_nxt_btn">
            </div>
        </form>
    </section>
<?php }else if($_GET['pageid'] == '6'){
    $profileData = selectQ("select spProfilePic from spuser where idspUser = ?", "i", [$_SESSION["useridd"]], "one");
    ?>

    <section class="container tell-us cong_pics">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The SharePage</h2>
        </div>
        <form class="col-12 tell-us_sec" method="post" action="registration-steps.php" enctype="multipart/form-data" autocomplete="chrome-off">
            <div class="text-center">
                <h3 class="mt-2 mb-1 pro_head_title">Do You Want To Add Your Profile Photo?</h3>
                <hr>
            </div>
            <div class="my-3 rsend_time">
                <a href="#" id="uploadImageLink"><p class="m-0 snd_time rsnd_t">Upload Image</p></a>
                <p class="text-center m-0 pic_cnt">or</p>
                <a href="#"><p class="m-0 snd_time rsnd_t">Capture Photo from Camera</p></a>
            </div>

            <div class="d-flex justify-content-center pro_pic">
                <div class="pro_pic_img">
                    <!-- Make sure the imagePreview element has the id attribute set -->
                    <img src="<?php if(isset($profileData['spProfilePic'])) { echo $profileData['spProfilePic']; } else { echo 'image/profile.png'; }?>" id="imagePreview" class="pro_pic_cnt img-fluid" alt="">
                    <input type="file" id="fileInput" class="fileInput ps-5 choose_img " name="profile_photo" required/>
                </div>
            </div>
            <span id="file_upload_error" style="color:red;"><?php if (isset($_SESSION["Error"])) { echo $_SESSION["Error"]; unset($_SESSION["Error"]);}
                ?> </span>


            <div class="nxt_btn my-4">
                <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=7" class="bck_btn tell_btn pro_skp" style="">SKIP </a>
                <input type="submit" value="SAVE" name="profile_save" class="nxt_btn tell_btn" id="prof_savebtn">
            </div>
        </form>
    </section>
<?php } else if($_GET['pageid'] == '7'){ ?>

    <section class="container what_do">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The SharePage</h2>
        </div>

        <form class="col-12 what_do_sec cong_mob" method="post" action="registration-steps.php" autocomplete="chrome-off">
            <div class="text-center">
                <h3 class="mt-2 mb-1 head_title">What do you want to do now? </h3>
                <hr>
            </div>
            <div class="pt-3 pb-2">
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="wanttodonow" value="job" id="flexRadioDefault1">
                    <label class="form-check-label ps-1" for="flexRadioDefault1"> Post a job</label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="wanttodonow" value="project" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Post a Project
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="wanttodonow" value="real_state" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Post a Real Estate AD
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="wanttodonow" value="Store" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Setup Retail or Wholesale Store
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="wanttodonow" value="personal" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        personal Product Sell
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="wanttodonow" value="none_of_above" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        None of the above
                    </label>
                    <div class="chk_temp"></div>
                </div>

            </div>
            <div class="nxt_btn my-4">
                <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=6"   class="bck_btn tell_btn Wht_back">BACK</a>
                <input type="submit" value="NEXT"  name="publish" class="nxt_btn tell_btn">
            </div>
        </form>
    </section>
<?php } else if($_GET['pageid'] == '8'){ ?>
    <section class="container what_do">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The SharePage</h2>
        </div>
        <form class="col-12 what_do_sec cong_mob" method="post" action="registration-steps.php" autocomplete="chrome-off">
            <div class="text-center">
                <h3 class="mt-2 mb-1 head_title">Do you want to do any of the following? </h3>
                <hr>
            </div>
            <div class="pt-3 pb-2">
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate" value="rental" id="flexRadioDefault1">
                    <label class="form-check-label ps-1" for="flexRadioDefault1">Post a Rental Ad</label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate" value="event" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Create an Event
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate" value="art_craft" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Sell your Art & Craft Work
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate" value="advertise" id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Advertise your services in Classifieds
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate" value="none_of_above"  id="flexRadioDefault2" checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        None of the above
                    </label>
                    <div class="chk_temp"></div>
                </div>
            </div>
            <div class="nxt_btn my-4">
                <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=7"  class="bck_btn tell_btn Wht_back">BACK</a>
                <input type="submit" value="NEXT"  name="publish8" class="nxt_btn tell_btn">
            </div>
        </form>
    </section>
<?php } else if($_GET['pageid'] == '9'){ ?>
    <section class="container what_do">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The SharePage</h2>
        </div>
        <form class="col-12 what_do_sec cong_mob" method="post" action="registration-steps.php" autocomplete="chrome-off">
            <div class="text-center">
                <h3 class="mt-2 mb-1 head_title">Do you want to do any of the following?</h3>
                <hr>
            </div>
            <div class="pt-3 pb-2">
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate9" value="post_video" id="flexRadioDefault1">
                    <label class="form-check-label ps-1" for="flexRadioDefault1">Post Video</label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate9" value="look_job" id="flexRadioDefault2"
                           checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Look for a Job
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate9" value="freelance" id="flexRadioDefault2"
                           checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Look for freelancing work
                    </label>
                    <div class="chk_temp"></div>
                </div>
                <div class="form-check what_do_btn py-2">
                    <input class="form-check-input chk_btn" type="radio" name="postupdate9" value="browse" id="flexRadioDefault2"
                           checked>
                    <label class="form-check-label ps-1" for="flexRadioDefault2">
                        Just Browse
                    </label>
                    <div class="chk_temp"></div>
                </div>
            </div>
            <div class="nxt_btn my-4">
                <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=8"   class="bck_btn tell_btn Wht_back">BACK</a>
                <input type="submit" value="NEXT"  name="publish9" class="nxt_btn tell_btn">
            </div>
        </form>
    </section>

<?php } else if($_GET['pageid'] == '10') {
    $bprofile = selectQ("select * from spbusiness_profile where spprofiles_idspProfiles = ?", "i", [$_SESSION['pid']], "one");
    if(isset($bprofile) && !empty($bprofile)) {
        $bprofileId = $_SESSION['pid'];
        $username = $bprofile['companyname'];
        $companytagline = $bprofile['companytagline'];
        $businessCategory = $bprofile['businesscategory'];
        $productservice = $bprofile['companyProductService'];
        $profileEmail = $bprofile['spProfileEmail'];
        $bprofileData = selectQ("select * from spprofiles where idspProfiles = ?", "i", [$_SESSION['pid']], "one");
        if(isset($bprofileData) && !empty($bprofileData)){
            $profilecountry = $bprofileData['spProfilesCountry'];
            $profilestate = $bprofileData['spProfilesState'];
            $profilecity = $bprofileData['spProfilesCity'];
        }
    }
    ?>
    <section class="container log_in tell-us crt_buss_pro">
        <div class="col-12 img_head text-center">
            <div class="d-flex justify-content-center">
                <a href=""><img src="image/logosharepage 1.png" class="img-fluid logo_share" alt=""></a>
            </div>
            <h2 class="mb-3">The Sharepage</h2>
        </div>
        <form class="col-12 tell-us_sec buss_pro crt_buss_pro_frm form" id="businessProfileForm">
            <div class="text-center">
                <h3 class="mt-2 mb-1 head_title">Create Business Profile<span class="req_star">*</span></h3>
                <hr>
            </div>
            <div class="form-group pt-xxl-3 pb-xxl-2 pt-xl-2 pb-xl-1 pt-md-1 pb-md-1 pt-1 pb-1 text-start bus_nme">
                <label for="companyname" class="my-2 bpname">Business Profile Name<span class="req_star">*</span></label>
                <span class="error_message" id="bpname_error"style="color: red;"></span>
                <input type="text" class="form-control" id="companyname" aria-describedby="emailHelp" name="companyname"
                       placeholder="Enter Name" value="<?php if(isset($username)){ echo $username; }?>">
            </div>
            <input name="spProfileEmail" type="hidden" id="spProfileEmail" value="<?php if(isset($spUserEmail)) { echo $spUserEmail; } ?>">
            <input name="idspProfiles" type="hidden" id="idspProfiles" value="<?php if(isset($bprofileId)) { echo $bprofileId; } ?>">
            <div class="form-group text-start pt-xxl-1 pb-xxl-2  pt-1 pb-1 cntry_clm_2 createbusiness">
                <div class="bus_nme">
                    <label for="companytagline" class=" my-2 text-capitalize bname">Business Name<span class="req_star">*</span></label>
                    <span class="error_message" id="bname_error"style="color: red;"></span>
                    <input type="text" class="form-control" id="companytagline" name="companytagline" placeholder="Enter Business Name" value="<?php if(isset($companytagline)){ echo $companytagline; }?>">
                </div>
                <div class=" form-group bus_nme">
                    <label for="businesscategory" class="my-2 text-capitalize catname">Category<span class="req_star">*</span></label>
                    <span class="error_message" id="catname_error"style="color: red;"></span>
                    <select class="form-select" name="businesscategory[]" id="businesscategory" aria-label="Default select example">
                        <option value="0" selected>select category</option>
                        <?php
                        $m = new _masterdetails;
                        $masterid = 8;
                        $result = $m->read($masterid);
                        if($result != false){
                            while($rows = mysqli_fetch_assoc($result)){ ?>
                            <option value='<?php echo $rows["idmasterDetails"]; ?>'
                                <?php
                                if(isset($businessCategory) && ($rows["idmasterDetails"] == $businessCategory)) {echo "selected";}
                                ?> >
                                <?php echo ucfirst(strtolower($rows["masterDetails"]));?>
                                </option><?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group text-start pt-xxl-1 pb-xxl-2  pt-1 pb-1">
                <div class=" form-group bus_nme">
                    <label for="" class=" my-2 text-capitalize">Products/Services</label>
                    <input type="email" class="form-control" id="companyProductService" name="companyProductService" placeholder="Enter Products/Services" value="<?php if(isset($productservice)){ echo $productservice; }?>">
                </div>
            </div>
            <div class="text-start pt-1 pb-2 bus_loct_head">
                <h3 class="py-2">Location</h3>
                <div class="form-group loct_thr">
                    <div class="form-group bus_nme">
                        <label for="" class="my-2 text-capitalize bcountry">Country<span class="req_star">*</span></label>
                        <select class="form-select" id="spProfilesCountry" name="spUserCountry" aria-label="Default select example">
                            <option value="0" selected>Select Country</option>
                            <?php
                            $co = new _country;
                            $result3 = $co->readCountry();
                            if ($result3) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    ?>
                                    <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($profilecountry) && $profilecountry == $row3['country_id']) ? 'selected' : ''; ?> ><?php echo $row3['country_title']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="error_message" id="countryerror" style="color: red;"></span>
                    </div>
                    <div class=" form-group bus_nme">
                        <div class="loadUserState">
                            <label for="" class="my-2 text-capitalize bstate">State<span class="req_star">*</span></label>
                            <select class="form-select" name="spUserState" id="spProfilesState" aria-label="Default select example">
                                <option value="0" selected>Select State</option>
                                <?php
                                if(isset($profilecountry)) {
                                    $state = new _state;
                                    $result4 = $state->readState($profilecountry);
                                    if ($result4) {
                                        while ($row4 = mysqli_fetch_assoc($result4)) {
                                            ?>
                                            <option value='<?php echo $row4['state_id']; ?>' <?php echo (isset($profilestate) && $profilestate == $row4['state_id']) ? 'selected' : ''; ?> ><?php echo $row4['state_title']; ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <span class="error_message" id="state" style="color: red;"></span>
                        </div>
                    </div>
                    <div class=" form-group bus_nme">
                        <div class="loadCity">
                            <label for="" class="my-2 text-capitalize bcity">City</label>
                            <select class="form-select" name="spUserCity" id="spProfilesCity" aria-label="Default select example">
                                <option value="0" selected>Select City</option>
                                <?php
                                if(isset($profilestate)) {
                                    $city = new _city;
                                    $result5 = $city->readCity($profilestate);
                                    if ($result5) {
                                        while ($row5 = mysqli_fetch_assoc($result5)) {
                                            ?>
                                            <option value='<?php echo $row5['city_id']; ?>' <?php echo (isset($profilecity) && $profilecity == $row5['city_id']) ? 'selected' : ''; ?> ><?php echo $row5['city_title']; ?></option>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </select>
                            <span class="error_message" id="cityerr" style="color: red;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" buss_btn my-3">
                <a href="<?php echo $BaseUrl?>/registration-steps.php?pageid=7" class="text-uppercase pe-3"><i class="fa-solid fa-less-than"></i> <span>Back</span></a>
                <input type="button" class="text-uppercase" id="bussproBtn" value="next">
            </div>
        </form>
    </section>
<?php }?>
</body>

</html>
<script>

    <?php include('component/f_btm_script.php'); ?>
    <script src="<?php echo $BaseUrl; ?>/assets/css/country/js/intlTelInput.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>

<script>
    window.onload = startTimer;
    var countdown;
    var seconds = 30;
    function startTimer() {
        countdown = setInterval(function() {
            seconds--;
            document.getElementById('timmer').innerHTML = seconds + 's';
            if (seconds <= 0) {
                clearInterval(countdown);
                var link = $('#resendbutton').data("id")
                document.getElementById('resendbutton').href = link;
            }else if(seconds > 0){
                document.getElementById('resendbutton').href="javascript:void(0)";
            }
        }, 1000);
    }

    document.getElementById('phonevalue').addEventListener('click', function() {
        const div = document.querySelector('.selected-dial-code');

        // Get the content of the div and convert it to a number
        let value = parseInt(div.textContent);
        const inputField = document.getElementById('countrycode');
        inputField.value = value;
    });


    var input = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);

    function onlyNumberKey(evt) {

        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
    $("#spUserPhone").on("input", function() {
        if (/^0/.test(this.value)) {
            this.value = this.value.replace(/^0/, "")
        }
    })
</script>
<script>
    function validateForm() {
        // Get input field values
        var firstName = document.getElementById("spUserFirstName").value.trim();
        var lastName = document.getElementById("spUserLastName").value.trim();

        var lettersOnly = /^[A-Za-z\s]+$/;

        // Check if either first name or last name is empty
        if (firstName === "" && lastName === "") {
            document.getElementById("first_name_error").innerHTML = "<b>Please enter your first name</b>";
            document.getElementById("last_name_error").innerHTML = "<b>Please enter your last name.</b>";
            return false; // Prevent form submission
        } else {
            // Validate first name
            if (firstName === "") {
                document.getElementById("first_name_error").textContent = "Please enter your first name.";
                return false;
            } else if (!firstName.match(lettersOnly)) {
                document.getElementById("first_name_error").textContent = "Please enter valid first name.";
                return false;
            }
            else {
                document.getElementById("first_name_error").textContent = "";
            }

            // Validate last name
            if (lastName === "") {
                document.getElementById("last_name_error").textContent = "Please enter your last name.";
                return false;
            } else if (!lastName.match(lettersOnly)) {
                document.getElementById("last_name_error").textContent = "Please enter valid last name.";
                return false;
            }else {
                document.getElementById("last_name_error").textContent = "";
            }
        }

        return true;
    }

    document.querySelector("#sendOtpForm").addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
</script>
<script>
    document.getElementById('bussproBtn').addEventListener('click', function() {
        var businessProfileName = document.getElementById("companyname").value.trim();
        var businessName = document.getElementById("companytagline").value.trim();
        var businessCategory = document.getElementById("businesscategory").value.trim();
        var businessCountry = document.getElementById("spProfilesCountry").value.trim();
        var businessState = document.getElementById("spProfilesState").value.trim();
        var businessCity = document.getElementById("spProfilesCity").value.trim();
        var error = 0;
        if(businessProfileName == ""){
            error = 1;
            document.getElementById("bpname_error").textContent = "Please enter your business profile name.";
        }else{
            document.getElementById("bpname_error").textContent = "";
        }
        if(businessName == ""){
            error = 1;
            document.getElementById("bname_error").textContent = "Please enter your business name.";
        }else{
            document.getElementById("bname_error").textContent = "";
        }
        if( businessCategory == "0"){
            error = 1;
            document.getElementById("catname_error").textContent = "Please select a category.";
        }else{
            document.getElementById("catname_error").textContent = "";
        }
        if(businessCountry == 0){
            error = 1;
            document.getElementById("countryerror").textContent = "Please select a country.";
        }else{
            document.getElementById("countryerror").textContent = "";
        }
        if(businessState == 0){
            error = 1;
            document.getElementById("state").textContent = "Please select a state.";
        }else{
            document.getElementById("state").textContent = "";
        }
        if(businessCity == 0){
            error = 1;
            document.getElementById("cityerr").textContent = "Please select a state.";
        }else{
            document.getElementById("cityerr").textContent = "";
        }
        if(error == 0){
            var formData = new FormData($('#businessProfileForm')[0]);
            formData.append('spProfileType_idspProfileType', 1);
            $.ajax({
                url: 'my-profile/addprofiles.php',
                type: 'POST',
                dataType: 'json',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    window.location.href = '/store/storeindex.php';
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        }
    });
</script>
<script>
    function isValidDate(date, month, year) {
        var d = new Date(year, month - 1, date);
        return d && (d.getMonth() + 1) === parseInt(month) && d.getDate() === parseInt(date) && d.getFullYear() === parseInt(year);
    }

    function locationValidForm() {
        // Extracting pageid from the URL
        var pageId = "<?php echo isset($_GET['pageid']) ? htmlspecialchars($_GET['pageid']) : '1'; ?>";

        var isValid = true;
        if (pageId === '2') {
            var country = document.getElementById("spUserCountry11").value.trim();
            var state = document.getElementById("spUserState22").value.trim();
            var city = document.getElementById("spUserCity").value.trim();
            var date = parseInt($("#day").val());
            var month = parseInt($("#month").val());
            var year = parseInt($("#year").val());

            var dateOfBirth = document.getElementById("dateOfBirth").value;

            if (country === "") {
                document.getElementById("countryerror").innerHTML = "Please select a country";
                isValid = false;
            } else {
                document.getElementById("countryerror").innerHTML = "";
            }

            if (state === "") {
                document.getElementById("state").innerHTML = "Please select a state";
                isValid = false;
            } else {
                document.getElementById("state").innerHTML = "";
            }

            if (city === "") {
                document.getElementById("cityerr").innerHTML = "Please select a city";
                isValid = false;
            } else {
                document.getElementById("cityerr").innerHTML = "";
            }
            if (dateOfBirth === undefined || dateOfBirth === '') {
                document.getElementById("doberror").innerHTML = "Please enter date of birth";
                return false;
            }

            var dobValid = isValidDate(date, month, year);
            var dobYear = parseInt(year);
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var age = currentYear - dobYear;
            if(!dobValid){
                document.getElementById("doberror").innerHTML = "Please enter a valid date of birth";
                isValid = false;
            } else if (age < 10 || age > 90) {
                document.getElementById("doberror").innerHTML = "Please enter a valid date of birth (age must be between 10 and 90)";
                isValid = false;
            } else {
                document.getElementById("doberror").innerHTML = "";
            }

        } else if (pageId === '3') {
            // Validation logic for pageId 3 if needed
        }

        if (!isValid) {
            event.preventDefault();
        }

        // Return overall validity
        return isValid;
    }
    document.getElementById("year").addEventListener("input", function() {
        var currentYear = new Date().getFullYear();
        var enteredYear = parseInt(this.value);

        if (enteredYear > currentYear) {
            this.value = currentYear;
        }
    });

</script>

<script>
    document.getElementById("uploadImageLink").addEventListener("click", function(event) {
        event.preventDefault();
        document.getElementById("fileInput").click();
    });

    document.getElementById("fileInput").addEventListener("change", function() {
        var file = this.files[0];
        // Check if file is selected
        if (file) {
            var fileName = file.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif'];
            if (!allowedExtensions.includes(fileExtension)) {
                document.getElementById("file_upload_error").innerHTML = "Please select a valid image file.";
                this.value = ''; // Clear the file input field
                return;
            }

            var fileSize = file.size;
            var maxSize = 5 * 1024 * 1024;
            if (fileSize > maxSize) {
                document.getElementById("file_upload_error").innerHTML = "File size exceeds the maximum allowed size of 5MB.";
                this.value = '';
                return;
            }

            // Display selected image
            var reader = new FileReader();
            reader.onload = function(e) {
                var imagePreview = document.getElementById("imagePreview");
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<script>
    function Checkphone(phone) {
        if (phone.length() < 6) {
            return false;
        }

        //alert(phone);
        $.ajax({ //Process the form using $.ajax()
            url       : 'check_phone.php', //Your form processing file URL
            type      : 'POST', //Method type
            data      : {postphone:phone}, //Forms name
            dataType  : '',
            success   : function(data) {
                //alert(data);
                if(data!=1){
                    $(".respUserEphone").html(data);
                    $("#respUserEphone").val("");
                }else{
                    $(".respUserEphone").html("");
                }

            }
        });
    }
</script>

<script>
    $(document).ready(function() {

        $('#respUserEphone').keypress(function(event) {
            if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                // event.preventDefault(); //stop character from entering input
            }
        });

        $("#spUserEmail").autocomplete({
            disabled: true
        });
        $('#auto-generate').click(function(){
            $('#refferalcodeused').val('LC6C2QUC');
        });
        setTimeout(function() {
            $('#clikk').click();
        }, 2000);
    });

    $('.datepicker').datetimepicker({
        endDate: '-1d',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        minView: 2,
    });


    var input = document.querySelector("#respUserEphone");
    window.intlTelInput(input, {
        preferredCountries: ['us', 'ca'],
        separateDialCode: true,
        //utilsScript: "<?php echo $BaseUrl; ?>/assets/css/country/js/utils.js",
    });
</script>

<script>
    function getaddress() {
        var address = $("#address").val();
        $.ajax({
            type: "POST",
            url: "address.php",
            cache: false,
            data: {
                'address': address
            },
            success: function(data) {

                var obj = JSON.parse(data);

                $("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');


                $("#latitude").val(obj.latitude);
                $("#longitude").val(obj.longitude);

            }
        });
    }

    $(".op_address").on("click", function() {
        var addre = $(this).val();
        //alert();
        $("#address").val(addre);

    });



    $("body").on('click', '.reveal', function() {
        var input = $("#bpass");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
            $(this).find('i').removeClass('fa-eye');
            $(this).find('i').addClass('fa-eye-slash');
        } else {
            input.attr("type", "password");
            $(this).find('i').removeClass('fa-eye-slash');
            $(this).find('i').addClass('fa-eye');
        }
    });

    $("body").on('click', '.reveal1', function() {

        var input = $("#respUserEnpass");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
            $(this).find('i').removeClass('fa-eye');
            $(this).find('i').addClass('fa-eye-slash');
        } else {
            input.attr("type", "password");
            $(this).find('i').removeClass('fa-eye-slash');
            $(this).find('i').addClass('fa-eye');
        }
    });


    function populateForm() {
        if (localStorage.key(formIdentifier)) {
            const savedData = JSON.parse(localStorage.getItem(formIdentifier));
            if (savedData != null) {
                for (const element of formElements) {
                    if (element.name in savedData) {
                        element.value = savedData[element.name];
                    }
                }
            }
        }
    }
</script>

<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"7038010c7e5e85bf","version":"2021.12.0","r":1,"token":"c014da5d01104438bf32930d27548771","si":100}' crossorigin="anonymous"></script>

<script>

    $("#spUserCountry11").on("change", function () {
        document.getElementById("countryerror").innerHTML = "";
        //alert('===1');

        var countryId = this.value;
        $.post("lodeUserState_signup.php", {
            countryId: countryId
        }, function (r) {

            $(".loadUserState").html(r);
        });

        $.post("loadUserCity.php", {state: 0}, function (r) {
            //alert(r);
            $(".loadCity").html(r);
        });

    });

    $("#spProfilesCountry").on("change", function () {
        document.getElementById("countryerror").innerHTML = "";
        var countryId = this.value;
        $.post("loadnewstate.php", {
            countryId: countryId
        }, function (r) {
            $("#spProfilesState").html(r);
        });
        $.post("loadnewcity.php", {state: 0}, function (r) {
            $("#spProfilesCity").html(r);
        });

    });

    $("#spProfilesState").on("change", function () {
        document.getElementById("state").innerHTML = "";
        var state = this.value;
        $.post("loadnewcity.php", {state: state}, function (r) {
            $("#spProfilesCity").html(r);
        });
    });

    $("#spUserState22").on("change", function () {
        document.getElementById("state").innerHTML = "";
        var state = this.value;
        $.post("loadUserCity.php", {state: state}, function (r) {
            //alert(r);
            $(".loadCity").html(r);
        });
    });

    window.onload = function() {
        splitDate();
    };

    function splitDate() {
        var dateOfBirth = document.getElementById("dateOfBirth").value;
        var dateParts = dateOfBirth.split("-");
        document.getElementById("day").value = dateParts[2];
        document.getElementById("month").value = dateParts[1];
        document.getElementById("year").value = dateParts[0];
    }

    prof_savebtn.addEventListener("click", function() {
        if (fileInput.files.length === 0) {
            if (<?php echo !isset($profileData['spProfilePic']) ? 'true' : 'false'; ?>) {
                return;
            }
            window.location.href = "<?php echo $BaseUrl; ?>/registration-steps.php?pageid=7";
        }
    });
</script>

</body>
</html>
