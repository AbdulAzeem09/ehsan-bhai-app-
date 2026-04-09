<?php
error_reporting(0);
$page = 'neweditprofile';
include_once("../views/common/header.php");

require_once('../helpers/image.php');
require_once "../classes/CreateProfile.php";
require_once "../classes/EditProfile.php";
require_once "../classes/Timeline.php";
require_once "../mlayer/_country.class.php";
require_once "../mlayer/_state.class.php";
require_once "../mlayer/_city.class.php";

$success_message= "";
$errors_message= "";
$time = new Timeline();
$edit = new EditProfile();
$t = new CreateProfile();
$sp_pid = $_SESSION['pid'];
$sp_uid = $_SESSION['uid'];
$row  = $edit->fetchUserData($_SESSION["pid"]);
//  var_dump($row);
//  die();
require_once("../backofadmin/library/config.php");

if(isset($row['data'])){
    $name = isset($row['data']["spProfileName"]) ? $row['data']["spProfileName"] : "";
    $email = isset($row['data']["spProfileEmail"]) ? $row['data']["spProfileEmail"] : "";
    $primaryEmail = isset($row['data']["spUserEmail"]) ? $row['data']["spUserEmail"] : "";
    $phone = isset($row['data']["spUserPhone"]) ? $row['data']["spUserPhone"] : "";
    $phone_cod = isset($row['data']["phone_code"]) ? $row['data']["phone_code"] : "";
    $country = isset($row['data']["spProfilesCountry"]) ? $row['data']["spProfilesCountry"] : 0;
    $state = isset($row['data']["spProfilesState"]) ? $row['data']["spProfilesState"] : 0;
    $city = isset($row['data']["spProfilesCity"]) ? $row['data']["spProfilesCity"] : 0;
    $fname = isset($row['data']["spUserFirstName"]) ? $row['data']["spUserFirstName"] : "";
    $lname = isset($row['data']["spUserLastName"]) ? $row['data']["spUserLastName"] : "";
    $dob = isset($row['data']["spUserDob"]) ? $row['data']["spUserDob"] : "";

    $about = isset($row['data']["spProfileAbout"]) ? $row['data']["spProfileAbout"] : "";
    $picture = (isset($row['data']["spProfilePic"]) && !empty($row['data']["spProfilePic"])) ? $row['data']["spProfilePic"] : $BaseUrl."/assets/images/icon/blank-img.png";
    $postalCode = isset($row['data']["spProfilePostalCode"]) ? $row['data']["spProfilePostalCode"] : "";
    $phone_status = isset($row['data']["phone_status"]) ? $row['data']["phone_status"] : "private";
    $profile_status = isset($row['data']["profile_status"]) ? $row['data']["profile_status"] : "public";
    $email_status = isset($row['data']["email_status"]) ? $row['data']["email_status"] : "private";
    $address = isset($row['data']["address"]) ? $row['data']["address"] : "";
    $spProfile_storename = isset($row['data']["store_name"]) ? $row['data']["store_name"] : "";
    $store_tag = isset($row['data']["spProfilesAboutStore"]) ? $row['data']["spProfilesAboutStore"] : "";
    $LanguageFluency = isset($row['data']["languagefluency"]) ? $row['data']["languagefluency"] : "";
    $sphobbies = isset($row['data']["sphobbies"]) ? $row['data']["sphobbies"] : "";
    $profile_type = isset($row['data']["spProfileType_idspProfileType"]) ? $row['data']["spProfileType_idspProfileType"] : 0;
    if($profile_type == 4){
    }
    if($profile_type == 1){
        $bus_data = $edit->getBusinessData($_SESSION["pid"]);
        if(isset($bus_data['data'])){
            $buss_name = isset($bus_data['data']['companyname']) ? $bus_data['data']['companyname'] : "";
            $buss_cat = isset($bus_data['data']['businesscategory']) ? $bus_data['data']['businesscategory'] : "";
            $buss_cat_array = explode(',', $buss_cat);
            $buss_tag = isset($bus_data['data']['companytagline']) ? $bus_data['data']['companytagline'] : "";
            $buss_phone = isset($bus_data['data']['companyPhoneNo']) ? $bus_data['data']['companyPhoneNo'] : "";
            $buss_phone = isset($bus_data['data']['companyPhoneNo']) ? $bus_data['data']['companyPhoneNo'] : "";
            $buss_email = isset($bus_data['data']['companyEmail']) ? $bus_data['data']['companyEmail'] : "";
            $buss_website = isset($bus_data['data']['CompanyWebsite']) ? $bus_data['data']['CompanyWebsite'] : "";
            $buss_skill = isset($bus_data['data']['skill']) ? $bus_data['data']['skill'] : "";
            $buss_productservice = isset($bus_data['data']['companyProductService']) ? $bus_data['data']['companyProductService'] : "";
            $buss_overview = isset($bus_data['data']['BussinessOverview']) ? $bus_data['data']['BussinessOverview'] : "";
            $buss_store = isset($bus_data['data']['spDynamicWholesell']) ? $bus_data['data']['spDynamicWholesell'] : "";
            $buss_company_size = isset($bus_data['data']['CompanySize']) ? $bus_data['data']['CompanySize'] : "";
            $buss_cmpyRevenue = isset($bus_data['data']['cmpyRevenue']) ? $bus_data['data']['cmpyRevenue'] : "";
            $buss_year = isset($bus_data['data']['yearFounded']) ? $bus_data['data']['yearFounded'] : "";
            $buss_stock_symbol = isset($bus_data['data']['stockSymbol']) ? $bus_data['data']['stockSymbol'] : "";
            $buss_stock_link = isset($bus_data['data']['cmpnyStockLink']) ? $bus_data['data']['cmpnyStockLink'] : "";
            $buss_about = isset($bus_data['data']['spProfilesAboutStore']) ? $bus_data['data']['spProfilesAboutStore'] : "";
            $buss_shipping = isset($bus_data['data']['spshippingtext']) ? $bus_data['data']['spshippingtext'] : "";
            $buss_return = isset($bus_data['data']['spProfilerefund']) ? $bus_data['data']['spProfilerefund'] : "";
            $buss_policy = isset($bus_data['data']['spProfilepolicy']) ? $bus_data['data']['spProfilepolicy'] : "";
            $buss_default = isset($bus_data['data']['defaultbusiness']) ? $bus_data['data']['defaultbusiness'] : 0;
            $buss_showemail = isset($bus_data['data']['showEmailProfile']) ? $bus_data['data']['showEmailProfile'] : 0;
        }
    }
    if($profile_type == 2){
        $free_data = $edit->fetchFreelancerData($_SESSION["pid"]);
        if(isset($free_data['data'])){
            $free_category = isset($free_data['data']['profiletype']) ? $free_data['data']['profiletype'] : 0;
            $free_hourly_rate = isset($free_data['data']['hourlyrate']) ? $free_data['data']['hourlyrate'] : 0;
            $free_language_fluency = isset($free_data['data']['languagefluency']) ? $free_data['data']['languagefluency'] : "";
            $free_available_from = isset($free_data['data']['availablefrom']) ? $free_data['data']['availablefrom'] : "";
            $free_personal_website = isset($free_data['data']['personalwebsite']) ? $free_data['data']['personalwebsite'] : "";
            $free_skill = isset($free_data['data']['skill']) ? $free_data['data']['skill'] : "";
            $free_certification = isset($free_data['data']['certification']) ? $free_data['data']['certification'] : "";
            $free_project_worked = isset($free_data['data']['projectworked']) ? $free_data['data']['projectworked'] : "";
            $free_working_interests = isset($free_data['data']['workinginterests']) ? $free_data['data']['workinginterests'] : "";
            $free_overview = isset($free_data['data']['overview']) ? $free_data['data']['overview'] : "";
        }
    }
    if($profile_type == 3){
        $pro_data = $edit->fetchProfessionalData($_SESSION["pid"]);
        if(isset($pro_data['data'])){
            $pro_category = isset($pro_data['data']['category']) ? $pro_data['data']['category'] : '';
            $pro_hourly_rate = isset($pro_data['data']['spHourlyrate']) ? $pro_data['data']['spHourlyrate'] : 0;
            $pro_language_fluency = isset($pro_data['data']['splanguagefluency']) ? $pro_data['data']['splanguagefluency'] : "";
            $pro_available_from = isset($pro_data['data']['spAvailablefrom']) ? $pro_data['data']['spAvailablefrom'] : "";
            $pro_website = isset($pro_data['data']['spProfileWebsite']) ? $pro_data['data']['spProfileWebsite'] : "";
            $pro_highlights = isset($pro_data['data']['highlights']) ? $pro_data['data']['highlights'] : "";
            $pro_certification = isset($pro_data['data']['spCertification']) ? $pro_data['data']['spCertification'] : "";
            $pro_accomplishments = isset($pro_data['data']['details']) ? $pro_data['data']['details'] : "";
            $pro_hobbies = isset($pro_data['data']['sphobbies']) ? $pro_data['data']['sphobbies'] : "";
            $pro_about = isset($pro_data['data']['spProfileAbout']) ? $pro_data['data']['spProfileAbout'] : "";
        }
    }
    if($profile_type == 5){
        $emp_data = $edit->fetchEmploymentData($_SESSION["pid"]);
        if(isset($emp_data['data'])){
            $emp_tagline = isset($emp_data['data']['profile_tagline']) ? $emp_data['data']['profile_tagline'] : '';
            $emp_edulevel = isset($emp_data['data']['education_level']) ? $emp_data['data']['education_level'] : '';
            $emp_graduated = isset($emp_data['data']['graduate']) ? $emp_data['data']['graduate'] : "";
            $emp_sector = isset($emp_data['data']['spPostingJobType']) ? $emp_data['data']['spPostingJobType'] : "";
            $emp_language = isset($emp_data['data']['language_fluency']) ? $emp_data['data']['language_fluency'] : "";
            $emp_highlights = isset($emp_data['data']['skill']) ? $emp_data['data']['skill'] : "";
            $emp_certification = isset($emp_data['data']['certification']) ? $emp_data['data']['certification'] : "";
            $emp_achievements = isset($emp_data['data']['achievements']) ? $emp_data['data']['achievements'] : "";
            $emp_hobbies = isset($emp_data['data']['hobbies']) ? $emp_data['data']['hobbies'] : "";
            $emp_reference = isset($emp_data['data']['reference']) ? $emp_data['data']['reference'] : "";
        }
    }
    if($profile_type == 6){
        $fam_data = $edit->fetchFamilyData($_SESSION["pid"]);
        if(isset($fam_data['data'])){
            $fam_interest = isset($fam_data['data']['choice']) ? $fam_data['data']['choice'] : '';
            $fam_career = isset($fam_data['data']['carrer']) ? $fam_data['data']['carrer'] : '';
            $fam_memberData = $edit->fetchFamilyMembers($_SESSION["pid"]);
            $fam_members = isset($fam_memberData['data']) ? $fam_memberData['data'] : [];
        }
    }
}

$row2 = $edit->featchEducationData($_SESSION["pid"],$_SESSION["ptid"]);
$educationData = isset($row2['data']) ? $row2['data'] : [];

if (isset($_FILES['upload_bills'])) {

    // if (extract($_POST)) {
    //     print_r($_FILES);
    //     exit;
    // }
    //$spdelete="delete from spbuiseness_files where sp_pid=$sp_pid  and sp_uid=$sp_uid";
    // $deletes=mysqli_query($dbConn,$spdelete);
    // $businame_name = $_POST['Business_Name'];
    // $address = $_POST['spaddress'];
    // $country = $_POST['Country'];
    // $state = $_POST['spUserState'];
    // $city = $_POST['spUserCity'];
    $image = new Image;
    $file_error = $image->validateFileImageExtensionsWithPDF($_FILES['Profiles']);
    if(!$file_error){
        $errors_message ="Please upload only image files or PDF for Profiles.";
    }
    $image->validateFileImageExtensionsWithPDF($_FILES['upload_bills']);
    if(!$file_error){
        $errors_message ="Please upload only image files or PDF for Profiles.";
    }
    if(empty($errors_message)){
         $profiles = $_FILES['Profiles']['name'];
        if ($profiles == "") {
            $profiles = $licenspic;
        }
        $profiles2 = $_FILES['Profiles']['tmp_name'];
        $spdir = "profile_pic/" . $profiles;
        move_uploaded_file($profiles2, $spdir);

        $upload_bills = $_FILES['upload_bills']['name'];
        if ($upload_bills == "") {
            $upload_bills = $billpic;
        }
        $upload_bills2 = $_FILES['upload_bills']['tmp_name'];
        $billdr = "profile_pic/" . $upload_bills;
        move_uploaded_file($upload_bills2, $billdr);
        $bswebsite = $_POST['bswebsite'];
        $spcmd = "insert into spbuiseness_files(sp_pid,sp_uid,Profiles,upload_bills,counts) values('$sp_pid','$sp_uid','$profiles','$upload_bills','$numcounts')";

        $inserts = mysqli_query($dbConn, $spcmd); 
        $success_message = "Business verification documents successfully submitted!";
      }
    }
    ?>
<style>

    .verify-now-btn {
        margin-top: 14px;
        display: inline-block;
        background: linear-gradient(100deg, #0d6efd, #4cc9f0); 
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 11px 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        /* box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3); */
        transition: all 0.3s ease;
        letter-spacing: 0.4px;
        position: relative;
        overflow: hidden;
        border-radius :27px;
    }

    .verify-now-btn:active {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(13, 110, 253, 0.35);
    }


    .verify-now-btn svg {
        vertical-align: middle;
        margin-right: 8px;
        width: 18px;
        height: 18px;
        fill: white;
    }

    .verify-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #fff;
        padding: 10px 20px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 3px 8px rgba(0, 176, 155, 0.4);
        cursor: pointer;
        margin-top: 30px;
        display: inline-block;
    /* background: linear-gradient(135deg, #0d6efd, #4cc9f0); */
        background: linear-gradient(135deg, #FB8308, #FFB13D);
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 12px 28px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        /* box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3); */
        transition: all 0.3s ease;
        letter-spacing: 0.4px;
        position: relative;
        overflow: hidden;
    }

    .verify-btn svg {
        transition: transform 0.3s ease;
    }

    .verify-btn:hover {
        background: linear-gradient(90deg, #00c6ff, #0072ff);
        box-shadow: 0 5px 15px rgba(0, 114, 255, 0.3);
        transform: translateY(-2px);
    }

    .verify-btn:hover svg {
        transform: scale(1.1);
    }

    .editpage {
        position: relative;       /* ensures children can be positioned within */
        padding-bottom: 60px;     /* optional: spacing for the badge */
    }

    .verified-wrapper {
        position: absolute;       /* positions it within .editpage */
        right: 0;                 /* aligns to the right edge of .editpage */
        bottom: 0;                /* positions it at the bottom */
        text-align: right;
    }

    .verified-badge {
        float : right;
        margin-top : 69px;
        position: absolute;
        top: 71px;
        right: 30px;
        margin-top: 14px;
        display: inline-block; 
        background: linear-gradient(135deg, #28a745, #28a745);
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 10px 23px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        /* box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3); */
        transition: all 0.3s ease;
        letter-spacing: 0.4px;
        position: relative;
        overflow: hidden;
        border-radius :27px;
    }

    .pending-badge {
        float: right;
        margin-top: 12px;
        position: absolute;
        top: 71px;
        right: -25px;
        display: inline-block;
        background: linear-gradient(135deg, #e63946, #c92a2a); /* red gradient */; /* warm orange gradient */
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 12px 28px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        /* box-shadow: 0 4px 10px rgba(255, 140, 0, 0.3); */
        transition: all 0.3s ease;
        letter-spacing: 0.4px;
        position: relative;
        overflow: hidden;
        border-radius :27px;
        cursor: context-menu;
    }
    
   .verified-tick {
        width: 20px;
        height: 20px;
        margin-left: 8px;
        vertical-align: middle;
    }


    #business .modal-dialog,
    #business .modal-content {
        max-width: 700px !important;
        width: 100% !important;
    }

    .red {
        color: red;
    }
    .custom-file-label::after {
        content: "Browse";
    }
    .preview-img {
        max-width: 200px;
        max-height: 200px;
        border: 1px solid #ddd;
        padding: 5px;
        margin-top: 10px;
    }
    .status-label {
        font-weight: bold;
    }
    .status-pending {
        color: orange;
    }
    .status-accepted {
        color: green;
    }
    .status-rejected {
        color: red;
    }
    .form-group {
        margin-bottom: 1.5rem; /* Increases space between form groups/fields */
    }
    .editpage .headings {
       margin-left: 12px !important;
    }
   .custom-close {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 22px;
        cursor: pointer;
    }
    .modal-2 .modal-dialog .modal-body {
        padding : 0px !important;
        margin-top: 0px !important;
    }
    .retry {
      display : none !important;
    }
    .retry-show {
       display : block !important;
    }
    .modal-2 .modal-dialog .modal-body form .verify-wrapper {
       margin-top : 0px !important;
    }
    .emailForm {
       padding-bottom: 32px !important;
    }
    .primary-email.default {
        cursor: default !important;
    }
</style>

<form class="profile" method="POST" id="editform">
    <div class="profile-detail">
        <div class="editpage">
            <a href="<?php echo $BaseUrl."/friends/?profileid=".$_SESSION['pid']; ?>" class="check-view-btn" target="_blank">
                <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5697 6.37498C5.5697 4.41177 7.16693 2.81451 9.13019 2.81451C11.0934 2.81451 12.6906 4.41177 12.6906 6.37498C12.6906 8.33817 11.0934 9.93542 9.13019 9.93542C7.16693 9.93542 5.5697 8.33817 5.5697 6.37498ZM6.7565 6.37498C6.7565 7.68382 7.82126 8.7486 9.13019 8.7486C10.439 8.7486 11.5038 7.68382 11.5038 6.37498C11.5038 5.06614 10.439 4.00136 9.13019 4.00136C7.82135 4.00136 6.7565 5.06614 6.7565 6.37498Z" fill="white"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13028 0.638672C14.0237 0.638672 17.8552 5.80486 18.0159 6.02483C18.1685 6.2333 18.1685 6.51656 18.0159 6.72521C17.8552 6.94498 14.0237 12.1112 9.13028 12.1112C4.23688 12.1112 0.405212 6.94501 0.244629 6.72505C0.0922852 6.51636 0.0922852 6.23332 0.244629 6.02463C0.405212 5.80486 4.23688 0.638672 9.13028 0.638672ZM1.47968 6.37454C2.40381 7.49549 5.52576 10.9244 9.13028 10.9244C12.7426 10.9244 15.8579 7.49725 16.7809 6.37534C15.8564 5.25378 12.7346 1.82547 9.13028 1.82547C5.51797 1.82547 2.40262 5.25259 1.47968 6.37454Z" fill="white"/>
                </svg>
                PUBLIC VIEW
            </a>
            <?php 
            $sprecord = "select * from spbuiseness_files where sp_pid='$sp_pid' and sp_uid='$sp_uid' order by id desc limit 1 ";
            $allrecord = mysqli_query($dbConn, $sprecord);
            $spresult = mysqli_fetch_array($allrecord);
            $userstatus = $spresult['status'];
            if ($profile_type == 1) { 
                if ($userstatus == 2) {?>
                    <span class="verified-badge">Verified</span>
                <?php
                } else if($userstatus == 1){?>
                    <div class="verified-wrapper2">
                        <span class="pending-badge">Verification Pending</span>
                    </div>
                <?php } else { ?>
                    <a data-bs-toggle="modal" 
                        id="show_business" 
                        data-bs-target="#business" 
                        class="verify-now-btn" 
                        style=" position: absolute; right: 0;bottom: 219px;text-align: right;">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M9 11l3 3L22 4l2 2-12 12-5-5z"/>
                            </svg>
                            <span>Verify Business</span>
                    </a>
                <?php } 
            }
            if ($success_message != "") {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="top:-60px">
                <strong>Success!</strong> <?php echo $success_message?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php } 
                if ($errors_message != "") { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="top:-60px">
                        <strong>Error!</strong> <?php echo $errors_message?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
            <?php    }
            ?>
            <div class="heading">
                <?php echo $_SESSION["ptname"]?> Profile
            </div>
            <div id="profileid" class="hidden"><?php echo $_SESSION['pid']; ?></div>
            <div id="pro-type" class="hidden"><?php echo $_SESSION['ptid']; ?></div>
            <div class="profile-info">
                <div class="profile-img-wrapper">
                    <img id="profilepic" src="<?php echo $picture; ?>" alt="">
                    <div class="edit-icon" id="edit-icon">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                            <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                        </svg>
                    </div>
                </div>
                <input type="file" id="file-input" style="display: none;" accept="image/*">
                <input type="hidden" id="name" value="<?php echo $name; ?>">
                 <div class="sub-heading">
                        Profile Name
                </div>
                <div class="name" id="name">
                    <?php echo $name;?>
                    <span id="openModal">
                      <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                        <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                      </svg> 
                      </span>
                </div>
            </div>
        </div>
        <?php
        if($_SESSION["ptname"] == 'Personal'){
        ?>
        <div class="personal-info">
            <div class="sub-heading">
                Personal Information
            </div>
            <div class="input-wrapper align-items-start">
                <div class="input-group in-2-col d-flex align-items-start" style="gap:10px;">
                    <div class="input-group in-2-col">
                        <label>First Name<span style="color: #EF1D26;"></span></label>
                        <input type="text" placeholder="Enter First Name"  value="<?php echo $fname; ?>" name="fname" id="firstname">
                        <!-- <span class="error-message" id="error-firstname" style="color: red;"></span> -->
                    </div>
                    <div class="input-group in-2-col">
                        <label>Last Name<span style="color: #EF1D26;"></span></label>
                        <input type="text" placeholder="Enter Last Name" name="lname" id="lname" value="<?php echo $lname ?>" >
                        <span class="error-message" id="error-lname" style="color: red;"></span>
                    </div>
                </div>
                <div class="input-group in-2-col d-flex align-items-start" style = "display:block;">

                    <label>Date Of Birth<span style="color: #EF1D26;"></span></label>
                    <div class="w-100 d-flex" style="position: relative;">

                        <input type="date" placeholder="Enter Date Of Birth"  value="<?php echo $dob ?>" name="dob" >


                        <!-- <span style="margin-top: 5px;">
                            <svg id="datepicker-icon"  width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.949219 0.599609H30.3577C32.7837 0.599609 33.9968 0.599609 34.9063 1.10897C35.5491 1.46896 36.0799 1.9997 36.4399 2.64251C36.9492 3.55204 36.9492 4.76509 36.9492 7.19117V30.008C36.9492 32.4341 36.9492 33.6472 36.4399 34.5567C36.0799 35.1995 35.5491 35.7303 34.9063 36.0902C33.9968 36.5996 32.7837 36.5996 30.3577 36.5996H0.949219V0.599609Z" fill="#1F1216"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.6594 10.9199H24.5451V9.10303H23.0916V10.9199H14.8068V9.10303H13.3533V10.9199H12.2389C11.5322 10.9199 10.8544 11.2006 10.3547 11.7004C9.85496 12.2001 9.57422 12.8779 9.57422 13.5846V25.4305C9.57422 26.1372 9.85496 26.815 10.3547 27.3147C10.8544 27.8144 11.5322 28.0952 12.2389 28.0952H25.6594C26.3661 28.0952 27.0439 27.8144 27.5436 27.3147C28.0434 26.815 28.3241 26.1372 28.3241 25.4305V13.5846C28.3241 12.8779 28.0434 12.2001 27.5436 11.7004C27.0439 11.2006 26.3661 10.9199 25.6594 10.9199ZM12.2632 12.3734H13.3775V13.948H14.831V12.3734H23.0916V13.948H24.5451V12.3734H25.6594C25.9806 12.3734 26.2887 12.501 26.5159 12.7281C26.743 12.9553 26.8706 13.2634 26.8706 13.5846V15.0623H11.0277V13.5846C11.0277 13.2634 11.1553 12.9553 11.3825 12.7281C11.6096 12.501 11.9177 12.3734 12.2389 12.3734H12.2632ZM25.6594 26.6417H12.2389C11.9177 26.6417 11.6096 26.5141 11.3825 26.2869C11.1553 26.0598 11.0277 25.7517 11.0277 25.4305V16.5158H26.8706V25.4305C26.8706 25.5895 26.8393 25.747 26.7784 25.894C26.7176 26.0409 26.6284 26.1745 26.5159 26.2869C26.4034 26.3994 26.2699 26.4886 26.1229 26.5495C25.976 26.6104 25.8185 26.6417 25.6594 26.6417ZM20.5479 17.9199H17.3745V21.0909H20.5479V17.9199ZM12.8687 17.9214H16.0421V21.0924H12.8687V17.9214ZM25.0538 17.9199H21.8804V21.0909H25.0538V17.9199ZM17.3745 22.0391H20.5479V25.2101H17.3745V22.0391ZM16.0421 22.039H12.8686V25.21H16.0421V22.039ZM21.8804 22.0391H25.0538V25.2101H21.8804V22.0391Z" fill="white"/>
                            </svg>
                        </span> -->
                    </div>
                    <span id="error-datepicker-input" style="color: red;"></span>
                </div>

                <div class="in-2-col" >
                    <div class="input-group in-1-col">
                        <label>Phone<span style="color: #EF1D26;"></span></label>
                        <input type="text" placeholder="Enter phone" value="<?php echo $phone_cod . str_replace($phone_cod, "", htmlspecialchars($phone)); ?>" name="phones" id="phone" >
                        <span class="error-message" id="error-phone" style="color: red;"></span>
                    </div>
                    <span class="error-message" id="phstatusError" style="color: red;"></span>
                </div>
                <div class="in-2-col" sty>
                    <div class="input-group in-1-col">
                        <label>Email<span style="color: #EF1D26;"></span></label>
                        <input type="text" placeholder="Enter email" value="<?php echo $email ?>" name="emails" id="email" readonly >
                        <span class="error-message" id="error-email" style="color: red;"></span>
                    </div>

                    <span class="error-message" id="emailstatusError" style="color: red;"></span>
                </div>
                <div id="more-email">
                </div>
                <!-- <div class="table-wrapper in-1-col">
                    <table>
                        <thead>
                        <tr>
                            <th style="width: 60%">Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="email-table">
                        </tbody>
                    </table>
                </div> -->
                <div class="input-group in-1-col">
                    <label>Language Fluency<span style="color: #EF1D26;"></span></label>
                    <input type="text" placeholder="Enter Language Fluency" value="<?php echo (isset($LanguageFluency)) ? $LanguageFluency : ''; ?>" name="language" id="language">
                    <span class="error-message" id="error-language" style="color: red;"></span>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
     <?php
        if($_SESSION["ptname"] == 'Personal'){
        ?>
    <div class="business-overview">
        <div class="sub-heading">
            Location Information
        </div>
        <div class="input-wrapper">

            <div class="input-group in-1-col">
                <label>Street Address<span style="color: #EF1D26;"></span></label>

                <input type="text" placeholder="Enter Street Address" value="<?php echo $address; ?>" name="address" id="address">

                <span class="error-message" id="error-address" style="color: red;"></span>
            </div>
            <div class="input-group in-4-col" >
                <label>Country<span style="color: #EF1D26;"></span></label>
                <select class="form-select" id="personalCountry"aria-label="Default select example" name="country" >
                    <option selected>Select Country</option>
                    <?php
                    $Country = $t->readCountry();
                    foreach ($Country['data'] as $rows): ?>
                        <option value="<?= htmlspecialchars($rows['country_id']) ?>" <?php echo ($rows['country_id'] == $country) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($rows['country_title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <span class="error-message" id="error-personalCountry" style="color: red;"></span>
            </div>
            <div class="input-group in-4-col" >
                <label>State<span style="color: #EF1D26;"></span></label>
                <select class="form-select" aria-label="Default select example" id="personalState" name="spUserState" >
                    <option value="<?php echo $state; ?>">Select State</option>

                </select>
                <span class="error-message" id="error-personalState" style="color: red;"></span>
            </div>
            <div class="input-group in-4-col" >
                <label>City<span style="color: #EF1D26;"></span></label>
                <select class="form-select" aria-label="Default select example" id="personalCity" name="spUserCity">
                    <option value="<?php echo $city; ?>" >Select City</option>
                </select>
                <span class="error-message" id="error-personalCity" style="color: red;"></span>
            </div>
            <div class="input-group in-4-col">
                <label>Postal Code</label>
                <input type="text" placeholder="Enter Postal Code" name="postalcode" value="<?php echo $postalCode ?>" id="postalcode">
                <span class="error-message" id="error-postalcode" style="color: red;"></span>
            </div>

        </div>
    </div>
    <div class="business-overview">
        <div class="sub-heading">
            Marketplace Information
        </div>
        <div class="input-wrapper">

            <!-- <div class="input-group in-1-col">
                                <label>Store Name<span style="color: #EF1D26;">*</span></label>
                                <input type="text" placeholder="Enter Store Name" value="<?php echo $spProfile_storename ?>"name="store" id="store">
                                <span class="error-message" id="error-store" style="color: red;"></span>
                            </div> -->
            <div class="input-group in-1-col">
                <label>Store Name<span style="color: #EF1D26;"></span></label>
                <input type="text" placeholder="Enter Store Name" value="<?php echo isset($spProfile_storename) && !empty($spProfile_storename) ? htmlspecialchars($spProfile_storename) : htmlspecialchars($name)."' Store"; ?>" name="store" id="store">
                <span class="error-message" id="error-store" style="color: red;"></span>
            </div>

            <div class="input-group in-1-col">
                <label>Tag Line For Your Store<span style="color: #EF1D26;"></span></label>
                <input type="text" placeholder="Enter tag line" value="<?php echo $store_tag ?>" name="tagline" id="tagline">
                <span class="error-message" id="error-tagline" style="color: red;"></span>
            </div>
        </div>
    </div>
    <div class="business-overview">
        <div class="sub-heading">
            About Myself
        </div>
        <div class="input-wrapper">

            <div class="input-group in-1-col">
                <label>About Me<span style="color: #EF1D26;"></span></label>
                <textarea  id="about" placeholder="Type About Me" name="about" rows="4" cols="50"><?php echo $about; ?></textarea>
                <span class="error-message" id="error-about" style="color: red;"></span>
            </div>
            <div class="input-group in-1-col">
                <label>Hobbies<span style="color: #EF1D26;"></span></label>
                <textarea id="hobby" placeholder="Type Hobbies" rows="4" cols="50" name="hobbies" value="<?php echo (isset($sphobbies)) ? $sphobbies : ''; ?>"><?php echo (isset($sphobbies)) ? $sphobbies : ''; ?></textarea>
                <span class="error-message" id="error-hobby" style="color: red;"></span>
            </div>
        </div>
    </div>
    <div class="business-overview">
        <div class="sub-heading">
            Education
        </div>
        <div class="input-wrapper">

            <div class="input-group in-4-col">
                <label>School/College<span style="color: #EF1D26;"></span></label>
                <input type="text" id="schoolCollege" placeholder="Enter School/College" name="school">
                <span class="error-message" id="error-schoolCollege" style="color: red;"></span>
            </div>
            <div class="input-group in-4-col">
                <label>Degree<span style="color: #EF1D26;"></span></label>
                <input type="text" id="degree" placeholder="Enter degree" name="degree">
                <span class="error-message" id="error-degree" style="color: red;"></span>
            </div>
            <div class="input-group in-4-col">
                <label>Field of Study<span style="color: #EF1D26;"></span></label>
                <input type="text" id="fieldOfStudy" placeholder="Enter field" name="fieldofstudy">
                <span class="error-message" id="error-fieldOfStudy" style="color: red;"></span>
            </div>
            <div class="input-group in-4-col" >
                <label>Year</label>
                <select class="form-select" id="yearSelect"  onfocus="populateYears('yearSelect', '')" aria-label="Default select example"name="year" >
                    <option selected>Select Year</option>
                </select>
                <span class="error-message" id="error-yearSelect" style="color: red;"></span>
            </div>
            <div class="input-group in-1-col d-flex addbtn" onclick="addEducation()">
                <img src="../assets/images/add-3.svg" alt="">
                <span style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;">
                                    Add
                                </span>

            </div>
            <div id="eduTable" class="table-wrapper in-1-col">
                <table>
                    <thead>
                    <tr>
                        <th>School/College</th>
                        <th>Degree</th>
                        <th>Field of Study</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="educationTableBody">
                    <?php
                    if(isset($educationData) && count($educationData) > 0){
                        foreach ($educationData as $row){
                            ?>
                            <tr>
                                <td><?php echo $row['school']; ?></td>
                                <td><?php echo $row['empdegree']; ?></td>
                                <td><?php echo $row['study']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td>
                                    <span style="cursor: pointer;">
                                      <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="<?php echo $row['id']; ?>" onclick="editRow(this, 'education')">
                                        <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                        <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                                      </svg>
                                    </span>
                                    <span style="cursor: pointer;">
                                      <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="delete-button" onclick="deleteElement(this, 'education')" data-id="<?php echo $row['id']; ?>">
                                        <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                                      </svg>
                                    </span>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if($_SESSION["ptname"] != 'Personal'){ ?>
    <div class="experience">
        <div class="sub-heading">
            Experience
        </div>
        <div class="w-100 d-flex add-exp" style="align-items: center; margin-bottom: 20px; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#add-experience">
            <img src="../assets/images/add-3.svg" alt="">
            <span id="addExperienceBtn" style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px; cursor: pointer;">
                                Add
                            </span>
        </div>
        <span id="experience_error" style="display:none;"></span>
        <div id="experience-entries"></div>
    </div>
    <?php } ?>
    <div class="status">
        <div class="sub-heading">
            Status
        </div>
        <div class="list-wrapper">
            <div class="phone-status-wrapper radio-box">
                <label for="" class="label" style="margin-top: 5px;">
                    Phone Status<span id="phstatus"style="color: #EF1D26;">*</span>
                </label>
                <div class="phone-status">
                    <input type="radio" <?php if(!isset($phone_status)){ echo "checked";} ?> id="phone-status-private" name="phone_status" value="private" <?php echo ($phone_status == "private") ? 'checked' : ''; ?>>
                    <label for="phone-status-private" class="radio-label">Private</label>
                    <input type="radio" id="phone-status-public" name="phone_status" value="public" <?php echo ($phone_status == "public") ? 'checked' : ''; ?>>
                    <label for="phone-status-public" class="radio-label">Public</label>
                </div>

                <span class="error-message" id="error-phone-status"></span>
            </div>
            <div class="phone-status-wrapper radio-box">
                <label for="" class="label">
                    Profile Status<span style="color: #EF1D26;">*</span>
                </label>
                <div class="phone-status">
                    <input type="radio" <?php if(!isset($profile_status)){ echo "checked";} ?> id="profile-status-private" name="profile_status" value="private" <?php if(isset($profile_status) && ($profile_status == 'private')) { echo "checked"; } ?> required>
                    <label for="profile-status-private" class="radio-label">Private</label>
                    <input type="radio" id="profile-status-public" name="profile_status" value="public" <?php if(isset($profile_status) && ($profile_status == 'public')) { echo "checked"; } ?> required>
                    <label for="profile-status-public" class="radio-label">Public</label>
                </div>
                <span class="error-message" id="error-profile-status"></span>
            </div>
            <div class="phone-status-wrapper radio-box">

                <label for="" class="label" style="margin-top: 5px;">
                    Email Status<span id="emailstatus"style="color: #EF1D26;">*</span>
                </label>
                <div class="phone-status">
                    <input <?php if(!isset($email_status)){ echo "checked";} ?> type="radio" id="email-status-private" name="email_status" value="private" <?php echo ($email_status == "private") ? 'checked' : ''; ?>>
                    <label for="email-status-private" class="radio-label">Private</label>
                    <input type="radio" id="email-status-public" name="email_status" value="public" <?php echo ($email_status == "public") ? 'checked' : ''; ?>>
                    <label for="email-status-public" class="radio-label">Public</label>
                </div>

                <span class="error-message" id="error-email-status"></span>
            </div>
        </div>
    </div>
    <div class="main-btns">
        <button id="cancel">CANCEL</button>
        <button type="button" class="active" id="updateprofile" onclick="validateForm(event,'personal', 'update')"  disabled>UPDATE PROFILE </button>
    </div>
    <?php
        }
    if($_SESSION["ptname"] == 'Business'){
        ?>
        </div>
        <?php
        include('createBusinessProfile.php');
    }
    if($_SESSION["ptname"] == 'Freelancer'){
        ?>
        </div>
        <?php
        include('createFreelancerProfile.php');
    }
    if($_SESSION["ptname"] == 'Professional'){
        ?>
        </div>
        <?php
        include('createProfessionalProfile.php');
    }
    if($_SESSION["ptname"] == 'Employment '){
        ?>
        </div>
        <?php
        include('createEmploymentProfile.php');
    }
    if($_SESSION["ptname"] == 'Family'){
        ?>
        </div>
        <?php
        include('createFamilyProfile.php');
    }
    ?>
</form>
</div>
</div>

<?php if ( $profile_type == 1) { ?>
    <?php if ( $userstatus !=2 ) { ?>
        <!---------------->
        <div id="verify_business_option_modal" style="z-index:9999;position:fixed;" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content p-0">
                    <div class="modal-header br_radius_top bg-white">
                        <h4 class="modal-title">Verify Your Business</h4>
                    </div>
                    <div class="modal-body" >
                        <p>To continue, please complete one of the following steps to verify your business:</p>
                        <h3>1. Enter Verification Code</h3>
                        <p>If you have received a verification code, enter it below to confirm your business status.</p>
                        <div class="row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="verification_code" placeholder="Enter Verification Code here" name="verification_code">
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn input-group-text" style='padding: 5px 20px;border-radius: 5px;background-color: #FB8308;color: #fff;' onclick="verifyUserProfile()">Verify Now</button>
                            </div>

                        </div>

                        <div id='verification_response'></div>
                        <br>
                        <h3>2. Submit Required Documents</h3>
                        <p>If you haven't received a code, please click below to submit the necessary documents for verification.</p>
                        <a href='<?php echo $BaseUrl . '/dashboard/settings/'; ?>'>Click Here to Upload Documents</a>
                    </div>
                </div>
                <div class="modal-footer br_radius_bottom bg-white">
                    <!--<button type="button" style="background: #31abe3!important;" class="btn btn-primary db_btn db_primarybtn" data-dismiss="modal">Close</button>-->
                </div>
            </div>

        </div>
        <!---------------->
    <?php } } ?>


<div class="modal modal-2" id="email-add-sucess" data-bs-backdrop="static"
 tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add & Confirm Your Email</h1>
                <button type="button" 
                class="custom-close" 
                data-bs-dismiss="modal" 
                aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form action="emailForm" style="padding-bottom: 32px !important;">
                    <div class="first">
                        <div class="input-group verify-wrapper">
                            <label>Enter New Email </label>
                            <div class="verify">
                                <input type="text" id="personalEmail" name="email" placeholder="Enter New Email">
                                <div class="verify-btn" id="first_verify">
                                    Add 
                                </div>
                           </div>
                           <span class="error-message" id="error-personalEmail" style="color: red;"></span>
                        </div>
                        <div class="input-group verify-wrapper hidden show" >
                            <label>Enter the code we sent to your primary email address</label>
                            <div class="verify">
                                <input type="text" id="register_otp" placeholder="Enter Code">
                                <div class="verify-btn" id="first_otp_verify">
                                    VERIFY
                                </div>
                            </div>
                            <span class="error-message" id="error-first_verify" style="color: red;"></span>
                        </div>
                        <div class="label w-100 hidden show" style="text-align: center; font-weight: 600; font-size: 14px;margin-top: 25px;">
                            Didn't receive the code? <span id="send-again1" style="cursor: pointer;color: #4A0080;">Send Again</span>
                        </div>
                        <div class="line show" style=" margin-left: 10px; height: 0.68px; background:  #E0E0E0; width: calc(100% - 10px);">
                        </div>
                    </div>
                    <div class="second hidden">
                        <div class="input-group verify-wrapper">
                            <label>Enter the code we sent to your new email address</label>
                            <div class="verify">
                                <input type="text" id="new_otp" placeholder="Enter Code">
                                <div class="verify-btn" id="second_verify">
                                    VERIFY
                                </div>
                            </div>
                            <span class="error-message" style="color: red;"></span>
                        </div>
                        <div class="label w-100" style="text-align: center; font-weight: 600; font-size: 14px;;margin-top: 25px;">
                            Didn't receive the code? <span id="send-again2" style="cursor: pointer;color: #4A0080;">Send Again</span>
                        </div>
                    </div>
                    <div class="success hidden">
                        <div class="cong w-100">
                            <div class="d-flex w-100"  style="justify-content: center;">
                                <img src="./images/sucess.svg" alt="">
                            </div>
                            <div class="d-flex w-100"  style="justify-content: center; margin-top: 20px;">
                                <img src="./images/Congratulations!.svg" alt="">
                            </div>
                        </div>
                        <div class="w-100 succ-messg">
                            Your Email is Successfully Verified!
                        </div>
                    </div>
                    <div class="fail hidden">
                        <div class="cong w-100">
                            <div class="d-flex w-100"  style="justify-content: center;">
                                <img src="./images/failed.svg" alt="">
                            </div>

                        </div>
                        <div class="w-100 succ-messg">
                            Your Email Is Not Verified Yet!
                        </div>
                        <div id="verifyEmailError" class="text" style="font-size: 12px; color: #595959; padding: 0px 40px ; text-align: center;">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer hidden">
                <button id="continue-button" type="button" class="btn btn-primary" data-bs-dismiss="modal">CONTINUE</button>
            </div>
        </div>
    </div>
</div>
<?php
include('../views/common/experienceModal.php');
include_once("../views/common/footer.php");
?>


<div class="modal fade" id="business" tabindex="-1" role="dialog" aria-labelledby="businessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" id="businessPr" enctype="multipart/form-data">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h4 class="modal-title" id="businessModalLabel">Business Profile Verification</h4>
                        <h5 class="modal-title" style="margin-top: 8px;">Submit the documents requested to verify your business</h5>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 32px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                     <!-- Business License -->
                    <div class="form-group" >
                        <label for="Profiles">Business License <span class="red" id="err_businessL">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="Profiles" name="Profiles" accept="image/*" required>
                        </div>
                        <img src="<?php echo $licenspic ? 'profile_pic/' . htmlspecialchars($licenspic) : 'profile_pic/no_image.jpg'; ?>" class="preview-img" id="license" alt="License Preview" style="display: none">
                    </div>
                    <!-- Upload Bills -->
                    <div class="form-group">
                        <label for="upload_bills">Upload any bills addressed to the business Location 
                        <br />    
                        <span class="red" id="err_bills">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="upload_bills" name="upload_bills" accept="image/*" required>
                        </div>
                        <img src="<?php echo $billpic ? 'profile_pic/' . htmlspecialchars($billpic) : 'profile_pic/no_image.jpg'; ?>" class="preview-img" id="img_bills" alt="Bills Preview" style="display: none">
                    </div>

                    <!-- Business Website -->
                    <!-- <div class="form-group">
                        <label for="bswebsite">Business Website <span class="red" id="err_website">*</span></label>
                        <input type="url" class="form-control" name="bswebsite" id="bswebsite" value="<?php echo htmlspecialchars($spwebname ?? ''); ?>" placeholder="https://example.com" required>
                    </div> -->

                    <!-- Status -->
                    <?php if (isset($userstatus)): ?>
                        <div class="form-group">
                            <?php if ($userstatus == 1): ?>
                                <label class="status-label">Status: <span class="status-pending">Pending</span></label>
                            <?php elseif ($userstatus == 2): ?>
                                <label class="status-label">Status: <span class="status-accepted">Accepted</span></label>
                            <?php elseif ($userstatus == 3): ?>
                                <label class="status-label">Comments: <?php echo htmlspecialchars($reject_reason ?? ''); ?></label><br>
                                <label class="status-label">Status: <span class="status-rejected">Rejected</span></label>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnsubmit_b" name="btns" style="background: linear-gradient(135deg, #FB8308, #f1a500);" <?php if (isset($userstatus) && ($userstatus == 1 || $userstatus == 2)) echo 'disabled'; ?>>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="../assets/js/posting/timeline.js"></script>
<script src="../assets/js/editprofile.js"></script>
<script src="../assets/js/create-profile.js"></script>
<script>
    function verifyUserProfile(){
        var verification_code = $('input[name=verification_code]').val();
        var myKeyVals = { verification_code : verification_code }
        var saveData = $.ajax({
            type: 'POST',
            url: "verify_business.php",
            data: myKeyVals,
            dataType: "text",
            success: function(resultData) {
                resultData = JSON.parse(resultData);
                if(resultData.error==false){
                    $('#verification_response').html("<span style='color:green'>"+resultData.message+"</span>");
                    setTimeout(function(){
                        window.location.reload(1);
                    }, 2000);
                }else{
                    $('#verification_response').html("<span style='color:red'>"+resultData.message+"</span>");
                }
                console.log(resultData);
            }
        });

    }

    $("#show_verify_business_option_modal").click(function() {
        $("#verify_business_option_modal").addClass('change-location-modal');
    });

    $("#resumeSelectDefault").change(function(){
        var  id = $(this).val();
        $.ajax({
            type: 'POST',
            url: "make_resume_default.php",
            data: {
                'id' : id
            },
            dataType: "json",
            success: function(response) {
                location.reload();
            }
        })
    });

    $('#Profiles').on('change', function() {
      var file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#license').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            // If no file or not an image, hide the preview
            $('#license').hide();
        }
    });

    $('#upload_bills').on('change', function() {
      var file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#img_bills').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            // If no file or not an image, hide the preview
            $('#img_bills').hide();
        }
    });

   

    $("#btnsubmit_b").click(function() {
    /* var Business_Name = $("#business").find("#Business_Name").val();
    var spaddress = $("#business").find("#spaddress").val();
    var spUser_Country = $("#business").find("#spUser_Country").val();
    var spUserState = $("#business").find("#spUserState").val();
    var spUserCity = $("#business").find("#spUserCity").val();
    var bswebsite = $("#business").find("#bswebsite").val(); */
    var Profiles = $("#business").find("#Profiles")[0].files[0];
    var upload_bills = $("#business").find("#upload_bills")[0].files[0];
    // Reset error messages
    $(".error").text("");
    // Check for empty fields
    if (
        // Business_Name == "" ||
        // spaddress == "" ||
        // spUser_Country == "" ||
        // spUserState == "" ||
        // spUserCity == "" ||
        Profiles == undefined ||
        upload_bills == undefined
        // bswebsite == ""
    ) {
           // Display error messages for empty fields
            // if (Business_Name == "") {
            //     $("#err_businessN").text("This is a required field.");
            // }
            // if (spaddress == "") {
            //     $("#err_address").text("This is a required field.");
            // }
            // if (spUser_Country == "") {
            //     $("#err_country").text("This is a required field.");
            // }
            // if (spUserState == "") {
            //     $("#err_state").text("This is a required field.");
            // }
            // if (spUserCity == "") {
            //     $("#err_city").text("This is a required field.");
            // }
            if (Profiles == undefined) {
                $("#err_businessL").text("Accpetable format - PDF, JPG, PNG.");
            }
            if (upload_bills == undefined) {
                $("#err_bills").text("Accpetable format - PDF, JPG, PNG.");
            }
            // if (bswebsite == "") {
            //     $("#err_website").text("This is a required field.");
            // }
            return false;
        } else {
          // Check if the selected files are images
          var validImageOrPdfTypes = [
            "image/jpeg", "image/png", "image/gif", "image/jpg",
            "image/tif", "image/tiff", "image/bmp", "image/svg+xml",
            "image/webp", "image/heic", "image/heif",
            "application/pdf"           // added PDF
            ];

            if ($.inArray(Profiles.type, validImageOrPdfTypes) === -1) {
                $("#business").find("#err_businessL")
                    .text("Please select a valid image **or PDF** file for Profiles.");
                return false;
            }
            if ($.inArray(upload_bills.type, validImageOrPdfTypes) === -1) {
                $("#business").find("#err_bills")
                    .text("Please select a valid image **or PDF** file for upload bills.");
                return false;
            }
            // If all checks pass, submit the form
             $("#business").find("#businessPr").submit();
            
            // Additional check after submission for non-image files
             $("#business").find("#businessPr").on('submit', function(e) {
                if ($.inArray(Profiles.type, validImageOrPdfTypes) === -1 || $.inArray(upload_bills.type, validImageOrPdfTypes) === -1) {
                    e.preventDefault(); // Prevent form submission
                    alert("Please select valid image files.");
                    return false;
                }
            });
        }
    });
    $(document).ready(function() {
        $(document).on('keyup', 'input', function(e) {
            const element = $(this);
            const value   = element.val();
            const hasLeadingSpace = value.length > 0 && value[0] === ' ';
            const isEmptyOrSpaces = value.trim() === '';

            // Regex (or URL constructor) for validating website URLs
            const urlPattern = /^(https?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w-]*)*$/i;  // see: example regex :contentReference[oaicite:0]{index=0}

            if ((e.which === 32 && this.selectionStart === 0) || hasLeadingSpace || isEmptyOrSpaces) {
                element.prev().find('.red').text("This is a required field.");
                element.val('');
                e.preventDefault();
            } else {
                // Additional check if this is the "bswebsite" field
                if (element.attr('id') === "bswebsite") {
                    if (!urlPattern.test(value)) {
                        element.prev().find('.red').text("Please enter a valid website URL.").show();
                        // maybe keep value or clear it depending on your UX
                        return;
                    } else {
                        element.prev().find('.red').text("*").show();
                        return;
                    }
                }

                element.prev().find('.red').text("*").show();
            }
        });

        $(document).on('change', 'select', function(e) {
            const element = $(this);
            const value   = element.find('option:selected').val();

            // Example check: if value is empty or default
            if (!value || value.trim() === '') {
                element.next().text("This is a required field.").show();
            } else {
                element.next().text("*").hide();
            }
        });

        $(document).on('change', 'input[type="file"]', function(e) {
            const element = $(this);
            const files   = this.files;  // FileList
            const errorMessage =  "Accpetable format - PDF, JPG, PNG.";
            
            // If no file selected
            if (!files || files.length === 0) {
                element.parent().prev().find('.red').text(errorMessage).show();
                return;
            }
            
            const file = files[0];
            const fileName = file.name;
            const mimeType = file.type;
            const allowedExtensions = /(\.pdf|\.jpg|\.jpeg|\.png|\.gif)$/i;
            const allowedMimeTypes    = ["application/pdf", "image/jpeg", "image/png", "image/gif"];
            
            // Check extension
            if (!allowedExtensions.test(fileName)) {
                element.val('');  // clear the file input
                element.parent().prev().find('.red')
                    .text("Invalid file type. Only PDF or image allowed.")
                    .show();
                return;
            }
            
            // Check MIME type
            if (allowedMimeTypes.indexOf(mimeType) < 0) {
                element.val('');
                element.parent().prev().find('.red')
                    .text("Invalid file type. File appears not to be a PDF or allowed image.")
                    .show();
                return;
            }
            
            // If passed all checks
            element.parent().prev().find('.red').text("*").hide();
        });


        $('#spUser_Country').on('change', function() {
        var countryId = $(this).val();
        if (countryId) {
            $.ajax({
                url: '../dashboard/settings/loadPlainUserState.php',
                method: 'POST',
                data: { countryId: countryId },
                success: function(response) {
                    // Assuming response is HTML options or JSON array of states
                    // If JSON, parse and build options; if HTML, directly insert
                    $(".states").find("#spUserState").html(response);
                    console.log($('#spUserState').html());
                    // Reset city select
                    $(".cities").find("#spUserCity").html('<option value="">Select City</option>')
                },
                error: function() {
                    alert('Error loading states. Please try again.');
                }
            });
        } else { // Reset state and city if no country selected
                $('#spUserState').html('<option value="">Select State</option>');
                $('#spUserCity').html('<option value="">Select City</option>');
            }
        });

        // Similarly, handle state change to load cities (assuming a similar endpoint exists)
        $('.spPostingsState').on('change', function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '../dashboard/settings/loadPlainUserCity.php', // Adjust endpoint if different
                    method: 'POST',
                    data: { state: stateId },
                    success: function(response) {
                        $(".cities").find("#spUserCity").html(response);
                    },
                    error: function() {
                        alert('Error loading cities. Please try again.');
                    }
                });
            } else {
                $(".cities").find("#spUserCity").html('<option value="">Select City</option>');
            }
        });
    })
   
</script>
</body>
</html>
