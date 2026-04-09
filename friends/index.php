<?php
session_start();
$page="publicview";
require_once $_SERVER['DOCUMENT_ROOT'] . "/backofadmin/library/config.php";
$profileid = isset($_GET['profileid']) ? (int) $_GET['profileid'] : 0;
require_once('../helpers/image.php');
$image = new Image;

$success_message = "";
$errors_message = "";

if (isset($_FILES['upload_bills'])) {
    $sp_pid = $_SESSION['pid'];
   
    $file_error = $image->validateFileImageExtensionsWithPDF($_FILES['Profiles']);
    if(!$file_error){
        $errors_message ="Please upload only image files or PDF for Profiles.";
    }

    $image->validateFileImageExtensionsWithPDF($_FILES['upload_bills']);
    if(!$file_error){
        $errors_message ="Please upload only image files or PDF for Profiles.";
    }
    $sp_pid = $_SESSION['pid'];
    $sp_uid = $_SESSION['uid'];
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
        $spcmd = "insert into spbuiseness_files(sp_pid,sp_uid,Profiles,upload_bills,counts) values('$sp_pid','$sp_uid','$profiles','$upload_bills','$numcounts')";

        $inserts = mysqli_query($dbConn, $spcmd); 
        $success_message = "Business verification documents successfully submitted!";
      }
    }
include_once("../views/common/header.php");
require_once "../classes/PublicView.php";
require_once "../classes/Connection.php";
$data_public_profile = [];
if($profileid >0 ){
  $check_public_profile_query = "select status from spbuiseness_files where sp_pid='".$profileid."'";
  $public_profile = mysqli_query($dbConn, $check_public_profile_query);
  $data_public_profile = mysqli_fetch_assoc($public_profile);
}


$pview = new PublicView;
$conn = new Connection;



// Display alerts at the very top before any other content
if ($success_message != "" || $errors_message != "") {
    echo '<div class="container-fluid p-0 m-0" style="position: fixed; top: 0; left: 0; right: 0; z-index: 9999; width: 100vw;">';
    if ($success_message != "") {
        echo '<div class="alert alert-success alert-dismissible fade show m-0" role="alert" style="border-radius: 0;">
                <div class="container">
                    <strong>Success!</strong> ' . htmlspecialchars($success_message) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
    }
    if ($errors_message != "") {
        echo '<div class="alert alert-danger alert-dismissible fade show m-0" role="alert" style="border-radius: 0;">
                <div class="container">
                    <strong>Error!</strong> ' . htmlspecialchars($errors_message) . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              </div>';
    }
    echo '</div>';
    echo '<div style="margin-top: ' . (($success_message != "" ? 60 : 0) + ($errors_message != "" ? 60 : 0)) . 'px;"></div>';
}


?>
<style>
  .red {
      color: red;
  }
  .profile_timeline {
      font-size: 14px;
      color: #666;
      font-weight: normal;
  }
</style>
        <div class="profile">
          <?php
            $profileData = $pview->readProfileInfo($profileid);
            // var_dump($bus_data);
            // die();
            $block = 0;
            $blockData = $pview->checkBlock($_SESSION['pid'], $profileid);
            if($blockData){
              $block = 1;
            }
            $isUserblocked = 0;
            $userBlocked = $pview->checkBlock($profileid, $_SESSION['pid']);
            if($userBlocked){
              $isUserblocked = 1;
            }
            $isFollow = 0;
            $userFollow = $conn->checkFollowing($_SESSION['pid'], $profileid);
            if($userFollow){
              $isFollow = 1;
            }

            if((isset($profileData['data']['idspUser']) && $_SESSION['uid'] != $profileData['data']['idspUser']) && $isUserblocked == 0){
              $isfriend = 0;
              $status = "Connect";
              $friendData = $pview->checkFriend($_SESSION['pid'], $profileid);
              if($friendData){
                $isfriend = 1;
                $sql = "SELECT * FROM spprofiles_has_spprofiles WHERE (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?) OR (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?)";
                $params = [$_SESSION['pid'], $profileid, $profileid, $_SESSION['pid']];
                $out = selectQ($sql, "iiii", $params);
                if(!is_null($out[0]['spProfiles_has_spProfileFlag'])){
                  $status = "Disconnect";
                }else{
                  $status = "Pending";
                }
              }


            ?>
            <div class="icons">
                <div class="icon">
                    <div class="img-wrapper" style="background-color: #EF1D26;">
                        <img src="<?php echo $BaseUrl?>/assets/images/favorite-2.svg" alt="">
                    </div>
                    Favorite
                </div>
                <div class="icon">
                    <div class="img-wrapper" style="background-color: #FB8308;" <?php if($isFollow == 1) { echo "onclick='unfollow(".$_SESSION['pid'].", ".$profileid.")'"; } else { echo "onclick='follow(".$_SESSION['pid'].", ".$profileid.")'"; } ?> >
                        <img src="<?php echo $BaseUrl?>/assets/images/follow-2.svg" alt="">
                    </div>
                    <?php if($isFollow == 1) { echo "Following"; } else { echo "Follow"; } ?>
                </div>
                <span id="follow_error" style="display:none;"></span>
                <div class="icon">
                    <div class="img-wrapper" style="background-color: #08B564;" onclick="request(<?php echo $isfriend.', '.$_SESSION['pid'].', '.$profileid; ?>)">
                        <img src="<?php echo $BaseUrl?>/assets/images/connected-2.svg" alt="">
                    </div>
                    <?php echo $status; ?>
                </div>
                <div class="icon chat-wrapper">
                    <div class="img-wrapper chat">
                        <img src="<?php echo $BaseUrl?>/assets/images/chat.svg" alt="">
                    </div>
                    Chat
                </div>
                <span id="block_error" style="display:none;"></span>
                <div class="icon">
                    <div class="img-wrapper more" onclick="clickThreeDot()">
                        <img src="<?php echo $BaseUrl?>/assets/images/more.svg" alt="">
                        <div class="three-dot-wrapper" id="three-dot-wrapper">
                            <div class="option">
                                <img src="<?php echo $BaseUrl?>/assets/images/add-big.svg" alt="">
                                <span>Add to Group</span>
                            </div>
                            <div class="option" onclick="block(<?php echo $block.', '.$_SESSION['pid'].', '.$profileid; ?>)">
                                <img src="<?php echo $BaseUrl?>/assets/images/block.svg" alt="" >
                                <span><?php if($block == 0) { echo "Block"; } else { echo "Unblock"; } ?></span>
                            </div>
                            <div class="option request" onclick="request(<?php echo $isfriend.', '.$_SESSION['pid'].', '.$profileid; ?>)">
                                <img src="<?php echo $BaseUrl?>/assets/images/unfriend.svg" alt="">
                                <span>
                                <?php
                                  if($isfriend == 0) {
                                    echo "Add friend";
                                  } else {
                                    if($status == "Disconnect"){
                                      echo $status;
                                    }else{
                                      echo "Cancel Request";
                                    }
                                  }
                                ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    More

                </div>
            </div>
            <?php
            }
            $profile_data = [];
            $userProfileType = 0;
            if(isset($profileData['data']['idspProfileType'])){
              $userProfileType = $profileData['data']['idspProfileType'];
            }
            if($userProfileType == 1){
               $profiletype = "portBussiness";
               $profileTypeData = $pview->readBusinessInfo($profileid);
               $profile_query = "select  *, companyProductService as details , companytagline  as tagline from spbusiness_profile where spprofiles_idspProfiles='".$profileid."'";
               $public_profile = mysqli_query($dbConn, $profile_query);
               $profile_data = mysqli_fetch_assoc($public_profile);
            }
            if($userProfileType == 2){
              $profiletype = "portFreelancer";
              $profileTypeData = $pview->readFreelancerInfo($profileid);
            }
            if($userProfileType == 3){
              $profiletype = "portProfessional";
              $profile_query = "select *, spProfileAbout as details from spprofessional_profile where spprofiles_idspProfiles='".$profileid."'";
              $public_profile = mysqli_query($dbConn, $profile_query);
              $profile_data = mysqli_fetch_assoc($public_profile);
            }
            if($userProfileType == 4){
              $profiletype = "portPersonal";
            }
            if($userProfileType == 5){
              $profiletype = "portEmployment";
              $profileTypeData = $pview->readEmployeeInfo($profileid);
              $resume = $pview->getDefaultResume($profileid);
            }
            if($userProfileType == 6){
              $profiletype = "portFamily";
              $profileTypeData = $pview->readFamilyInfo($profileid);
            }
          ?>
          <?php if($userProfileType != 0) { ?>
          <div class="profile-img-name">
              <div class="profile-detail">
                <div id="user-profileid" class="hidden"><?php echo $profileid; ?></div>
                <div id="user-userid" class="hidden"><?php echo $profileData['data']['spUser_idspUser']; ?></div>
                <div id="user-profiletype" class="hidden"><?php echo $profiletype; ?></div>
                <div id="user-ptid" class="hidden"><?php echo $_SESSION['ptid']; ?></div>
                  <div class="profile-img-wrapper">
                      <img src="<?php if(isset($profileData['data']['profile_pic'])) { echo $profileData['data']['profile_pic'];} else { echo $BaseUrl."/assets/images/icon/blank-img.png"; } ?>" style="height:100%;" alt="">
                  </div>
                  <div class="name"><?php if(!empty($profileData['data']['profile_name'])) {
                          echo $profileData['data']['profile_name'] ?? ""; 
                      }
                      echo '<span class="profile_timeline"> ('.str_replace('port', '', $profiletype).' Profile)</span>';
                      if($data_public_profile && $data_public_profile['status'] == 2 && $userProfileType == 1) {
                          echo '<img src="'.$BaseUrl.'/assets/images/icon/green-tick.png" alt="Verified" title ="Verified" style="height:40px; margin-left:6px;margin-top:-4px;">';
                      }
                  ?></div>
                  <?php
                    if(isset($profile_data['tagline'])){
                  ?>
                  <div class="title"><?php echo $profile_data['tagline']; ?></div>
                  <?php
                    }
                    // if($userProfileType == 5 && isset($profileTypeData['data']['profile_tagline'])){
                  ?>
                  <?php
                    //}
                    if($userProfileType == 2 && isset($profileTypeData['data']['profiletype'])){
                      $category = $pview->readCategoryById($profileTypeData['data']['profiletype']);
                  ?>
                  <div class="title"><?php if($category['data']['subCategoryTitle']) { echo $category['data']['subCategoryTitle']; }?></div>
                  <?php
                    }
                    if($userProfileType == 6 && isset($profileTypeData['data']['carrer'])){
                  ?>
                  <div class="title"><?php echo $profileTypeData['data']['carrer'];   ?></div>
                  <?php
                    }
                    if($userProfileType == 4){
                  ?>
                  <div class="title">Personal Profile</div>
                  <?php
                    }
                  ?>
              </div>
          </div>
          <?php if($isUserblocked == 0){ ?>
            <div class="personal-detail">
                <div class="detail">
                    <!-- <img src="<?php echo $BaseUrl?>/assets/images/call.svg" alt=""> -->
                    <div class="more-detail">
                        <!-- <div class="title">Phone</div> -->
                        <?php
                        // $phone_no = "";
                        // if(isset($profileData['data']['spUserPhone'])){
                        //   $phone_no = $profileData['data']['spUserPhone'];
                        //   if(isset($profileData['data']['phone_status']) && $profileData['data']['phone_status'] == "private"){
                        //     $phone_no = str_repeat('*', strlen($phone_no));
                        //   }
                        // }
                        // $email = "";
                        // if(isset($profileData['data']['spProfileEmail'])){
                        //   $email = $profileData['data']['spProfileEmail'];
                        //   if(isset($profileData['data']['email_status']) && $profileData['data']['email_status'] == "private"){
                        //     $email = str_repeat('*', strlen($email));
                        //   }
                        // }
                        ?>
                        <!-- <div class="value"><?php
                             if(isset($profileData['data']['phone_code'])) {
                                // echo $profileData['data']['phone_code'];
                                // echo $phone_no; 
                              }
                         ?>
                        </div> -->
                    </div>
                </div>
                <!-- <div class="detail email" style="display:none;">
                    <img src="<?php echo $BaseUrl?>/assets/images/email.svg" alt="">
                    <div class="more-detail">
                        <div class="title">Email</div>
                        <div class="value"><?php // echo $email; ?></div>
                    </div>
                </div>  -->
                <div class="detail" style="border: none;display:none;">
                    <img src="<?php echo $BaseUrl?>/assets/images/personal.svg" alt="">
                    <div class="more-detail">
                        <div id="pro-type" class="title"><?php if(!empty($profileData['data']['spProfileTypeName'])) { echo trim($profileData['data']['spProfileTypeName'] ?? ""); }?></div>
                        <div class="value">Profile</div>
                    </div>
                </div>
            </div>
            <?php  if($userProfileType == 1 || $userProfileType == 3) {?>
            <div style="background-color: #FFEBDD;padding: 12px;">
                <div class="store">
                    <!-- <img src="<?php echo $BaseUrl?>/assets/images/store.svg" alt=""> -->
                    <div class="detail" >
                        <div class="title" style="font-weight: 600;margin-left: 10px;">
                            <?php 
                              if($userProfileType == 1){
                                echo "Business Overview :";
                              } else if($userProfileType == 3){
                                  echo "About :";
                              }
                            ?>
                        </div>
                        <div class="text" style="margin-top: 10px; padding: 10px; height: auto; max-height: 360px; display: block; overflow-y: auto; overflow-x: hidden; box-sizing: border-box; word-wrap: break-word; word-break: break-word; white-space: normal; line-height: 1.5; border: 1px solid #FFEBDD; border-radius: 5px; background-color: #FFEBDD;">
                        <?php if($profile_data['details']) { echo nl2br(htmlspecialchars($profile_data['details'])); } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
              if($userProfileType == 1){
            ?>
            <!-- <div class="store-wrapper">
                <div class="store">
                    <img src="<?php echo $BaseUrl?>/assets/images/store.svg" alt="">
                    <div class="detail">
                        <div class="title">
                            Business Name
                        </div>
                        <div class="text">
                            <?php if($profileTypeData['data']['companytagline']) { echo $profileTypeData['data']['companytagline']; }?>
                        </div>
                        <div class="text"><span class="title">Address:</span><?php if($profileData['data']['address']) { echo $profileData['data']['address']; }?></div>
                    </div>
                </div>
            </div> -->
            <?php
              }
              if($userProfileType == 5 || $userProfileType == 2){
            ?>
            <div class="store-wrapper-2">
              <div class="store">
                <div class="img-wrapper">
                  <img src="<?php echo $BaseUrl?>/assets/images/career.svg" alt="">
                </div>
                <div class="title">
                  <?php
                  if($userProfileType == 2){
                  ?>
                  Career Category: <span class="text"><?php if($category['data']['subCategoryTitle']) { echo $category['data']['subCategoryTitle']; }?></span>
                  <?php
                  }
                  ?>
                  <?php
                  if($userProfileType == 5){
                  ?>
                  Career Category: <span class="text"><?php if($profileTypeData['data']['subCategoryTitle']) { echo $profileTypeData['data']['subCategoryTitle']; }?></span>
                  <?php
                  }
                  ?>
                </div>
              </div>
              <div class="store">
                <div class="img-wrapper">
                  <img src="<?php echo $BaseUrl?>/assets/images/language.svg" alt="">
                </div>
                <div class="title">
                  Language Fluency:  <span class="text"><?php if(!empty($profileTypeData['data']['language_fluency'])) { echo $profileTypeData['data']['language_fluency']; }?></span>
                </div>
              </div>
              <div class="store">
                <div class="img-wrapper">
                  <img src="<?php echo $BaseUrl?>/assets/images/hourly-rate.svg" alt="">
                </div>
                <div class="title">
                  Hourly Rate (USD):  <span class="text"><?php if(!empty($profileTypeData['data']['hourlyrate'])) { echo $profileTypeData['data']['hourlyrate']; }?></span>
                </div>
              </div>
              <div class="store">
                <div class="img-wrapper">
                  <img src="<?php echo $BaseUrl?>/assets/images/available.svg" alt="">
                </div>
                <div class="title">
                  Available From: <span class="text"><?php if(!empty($profileTypeData['data']['availablefrom'])) { echo $profileTypeData['data']['availablefrom']; }?></span>
                </div>
              </div>
            </div>
            <?php
              }
              if($userProfileType != 6 ){
            ?>
            <div class="activities">
              <!-- <div class="heading">
                Activity
              </div> -->
              <div class="actiivities-wrapper" style="flex-wrap: wrap;">
                <?php
                if($userProfileType != 3){   
                ?>
                <div class="act active" onclick="showContent(event, 'about', '.main-content-section')">
                About
                </div>
                <?php
                }
                if($userProfileType == 1 || $userProfileType == 2 || $userProfileType == 4){
                ?>
                <div class="act" onclick="showContent(event, 'post-list', '.main-content-section')">
                Posts
                </div>
                <?php
                }
                if($userProfileType == 1 || $userProfileType == 2 || $userProfileType == 4){
                ?>
                <div class="act" onclick="showContent(event, 'media-list', '.main-content-section')">
                Media
                </div>
                <?php
                }
                if($userProfileType == 1 || $userProfileType == 2 || $userProfileType == 4){
                ?>
                <div class="act" onclick="showContent(event, 'doc-list', '.main-content-section')">
                Documents
                </div>
                <?php
                }
                if($userProfileType == 1 || $userProfileType == 2 || $userProfileType == 4){
                ?>
                <div class="act" onclick="showContent(event,'store-list', '.main-content-section')">
                Store
                </div>
                <?php
                }
                if($userProfileType == 1 || $userProfileType == 2 || $userProfileType == 5 || $userProfileType == 4){
                ?>
                <div class="act" onclick="showContent(event, 'portfolio-list', '.main-content-section')">
                Portfolio
                </div>
                <?php
                }
                if($userProfileType == 1){
                ?>
                <div class="act" onclick="showContent(event, 'job-list', '.main-content-section')">
                Jobs
                </div>
                <?php
                }
                if($userProfileType == 1){
                ?>
                <div class="act" onclick="showContent(event, 'project-list', '.main-content-section')">
                Projects
                </div>
                <?php
                }
                if($userProfileType == 1){
                ?>
                <div class="act" onclick="showContent(event, 'properties-list', '.main-content-section')">
                Real Estate
                </div>
                <?php
                }
                ?>
                </div>
              </div>
              <?php
              }
              ?>
              <div class="main-content-section" id="about">
                <div class="text-wrapper">
                <?php
                if($userProfileType == 1){
                ?>
                  <div class="heading">
                  Business Name
                  </div>
                  <div class="text" style="margin-top: 5px;">
                    <?php if($profileTypeData['data']['companyname']) { echo $profileTypeData['data']['companyname']; }?>
                  </div>
                  <div class="heading" style="margin-top: 22px;">
                  Business Overview
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileTypeData['data']['BussinessOverview']) { echo $profileTypeData['data']['BussinessOverview']; }?>
                  </div>
                  <?php
                  }
                  if($userProfileType == 2){
                  ?>
                  <div class="heading">
                    Overview
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileTypeData['data']['overview']) { echo $profileTypeData['data']['overview']; }?>
                  </div>
                  <?php
                  }
                  if(($userProfileType == 1 || $userProfileType == 2) && $profileTypeData['data']['personalwebsite']){
                  ?>
                  <div class="globe" style="margin-top: 20px;">
                    <img src="<?php echo $BaseUrl?>/assets/images/website.svg" alt="">
                    <span style="padding-left: 5px; color: #7649B3; font-size: 14px;">
                    <?php if(!empty($profileTypeData['data']['CompanyWebsite'])) { echo $profileTypeData['data']['CompanyWebsite']; }?>
                    <?php if(!empty($profileTypeData['data']['personalwebsite'])) { echo $profileTypeData['data']['personalwebsite']; }?>
                    </span>
                  </div>
                  <?php
                  }
                  ?>
                </div>
                <?php
                if((isset($profileTypeData['data']['spProfileAbout']) || isset($profile_data['spProfileAbout'])) && $userProfileType != 3){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                  About Myself
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                  <?php  echo isset($profileTypeData['data']['spProfileAbout']) ?  $profileTypeData['data']['spProfileAbout'] : $profile_data['spProfileAbout'] ;?>
                  </div>
                </div>
                <?php
                } 
                if(isset($resume['fileName']) || isset($profile_data['fileName'])){
                ?>

                <div class="text-wrapper">
                  <div class="heading">
                    Default Resume
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <p><?php echo strtoupper(isset($resume['fileName']) ?  $resume['fileName'] : $profile_data['fileName']) ; ?></p>
                    <a download href="<?= $resume['resume_url']?>" target="_blank">Download Resume</a>
                  </div>
                </div>
                 <?php
                } 
                if(isset($profileTypeData['data']['skill']) || isset($profile_data['skill'])){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                  Specialities
                  </div>
                  <?php
                  if($profileTypeData['data']['skill']){
                    $skills = array_map('trim', explode(',', $profileTypeData['data']['skill']));
                    foreach($skills as $skill){
                  ?>
                  <div style="margin: 10px 0px;">
                    <img src="<?php echo $BaseUrl?>/assets/images/black-check.svg" alt="">
                    <span style="font-weight: 400; padding-left: 5px;">
                    <?php echo $skill; ?>
                    </span>
                  </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                 <?php
                  } 
                  if(isset($profileTypeData['data']['certification']) || isset($profile_data['spCertification'])){
                  ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Certifications
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php echo isset($profileTypeData['data']['certification']) ?  $profileTypeData['data']['certification'] : $profile_data['spCertification'] ; ?>
                  </div>
                </div>
                <?php } 
                  if(isset($profileTypeData['data']['achievements']) || isset($profile_data['spAchievements'])){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Achievements
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                  <?php echo isset($profileTypeData['data']['achievements']) ?  $profileTypeData['data']['achievements'] : $profile_data['spAchievements'] ;  ?>
                  </div>
                </div>
                <?php }
                if(isset($profileTypeData['data']['highlights']) || isset($profile_data['highlights'])){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Highlights
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                  <?php echo isset($profileTypeData['data']['highlights']) ?  $profileTypeData['data']['highlights'] : $profile_data['highlights'] ;  ?>
                  </div>
                </div>
                <?php }
                if(isset($profileTypeData['data']['spProfileWebsite']) || isset($profile_data['spProfileWebsite'])){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Website
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                  <?php echo isset($profileTypeData['data']['spProfileWebsite']) ?  $profileTypeData['data']['spProfileWebsite'] : $profile_data['spProfileWebsite'] ;  ?>
                  </div>
                </div>
                <?php }
                if(isset($profileTypeData['data']['splanguagefluency']) || isset($profile_data['splanguagefluency'])){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Language Fluency
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                  <?php echo isset($profileTypeData['data']['splanguagefluency']) ?  $profileTypeData['data']['splanguagefluency'] : $profile_data['splanguagefluency'] ;  ?>
                  </div>
                </div>
                <?php }
                if((isset($profileTypeData['data']['spHourlyrate']) && $profileTypeData['data']['spHourlyrate'] >0 ) || (isset($profile_data['spHourlyrate']) && $profile_data['spHourlyrate'] >0 )){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Hourly Rate
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                  <?php echo isset($profileTypeData['data']['spHourlyrate']) ?  $profileTypeData['data']['spHourlyrate'] : $profile_data['spHourlyrate'] ;  ?>
                  </div>
                </div>
                <?php }
                 if(isset($profileTypeData['data']['references']) || isset($profile_data['spReferences'])){
                 ?>
                <div class="text-wrapper">
                  <div class="heading">
                    References
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                   <?php echo isset($profileTypeData['data']['references']) ?  $profileTypeData['data']['references'] : $profile_data['spReferences'] ; ?>
                  </div>
                </div>
                <?php
                } ?>

                

                <span id="education_error" style="display:none;"></span>
                <div id="education_table" class="education">
                </div>
              <span id="experience_error" style="display:none;"></span>
              <div id="experience"></div>
              <?php
                if(isset($profileTypeData['data']['hobbies']) || isset($profile_data['sphobbies'])){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Hobbies
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                  <?php echo isset($profileTypeData['data']['hobbies']) ?  $profileTypeData['data']['hobbies'] : $profile_data['sphobbies'] ; ?>
                  </div>
                </div>
                 <?php }
                // }
                if($userProfileType == 2){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                  Skills
                  </div>
                  <?php
                  if($profileTypeData['data']['skill']){
                    $skills = array_map('trim', explode(',', $profileTypeData['data']['skill']));
                    foreach($skills as $skill){
                  ?>
                  <div style="margin: 10px 0px;">
                    <img src="<?php echo $BaseUrl?>/assets/images/black-check.svg" alt="">
                    <span style="font-weight: 600; padding-left: 5px;">
                    <?php echo $skill; ?>
                    </span>
                  </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                <div class="text-wrapper">
                  <div class="heading">
                    Certifications
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileTypeData['data']['certification']) { echo $profileTypeData['data']['certification']; }?>
                  </div>
                </div>
                <div class="text-wrapper">
                  <div class="heading">
                    Project Worked
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileTypeData['data']['projectworked']) { echo $profileTypeData['data']['projectworked']; }?>
                  </div>
                </div>
                <div class="text-wrapper">
                  <div class="heading">
                    Working Interests
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileTypeData['data']['workinginterests']) { echo $profileTypeData['data']['workinginterests']; }?>
                  </div>
                </div>
                <span id="education_error" style="display:none;"></span>
                <div id="education_table" class="education">
                </div>
              <span id="experience_error" style="display:none;"></span>
              <div id="experience"></div>
                <?php
                }
                if($userProfileType == 1){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    Services
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileTypeData['data']['companyProductService']) { echo $profileTypeData['data']['companyProductService']; }?>
                  </div>
                </div>
                <!-- <div class="text-wrapper">
                  <div class="heading">
                    Company Specialties
                  </div>
                  <?php
                  // if($profileTypeData['data']['skill']){
                  //   $skills = array_map('trim', explode(',', $profileTypeData['data']['skill']));
                  //   foreach($skills as $skill){
                  ?>
                  <div style="margin: 10px 0px;">
                    <img src="<?php echo $BaseUrl?>/assets/images/black-check.svg" alt="">
                    <span style="font-weight: 600; padding-left: 5px;">
                    <?php //echo $skill; ?>
                    </span>
                  </div>
                  <?php
                  //   }
                  // }
                  ?>
                </div> -->
                <div class="text-wrapper">
                  <div class="heading">
                  Additional Information
                  </div>
                  <!-- <div class="bold-title"> -->
                    <!-- <?php //if($profileTypeData['data']['companyname']) { echo $profileTypeData['data']['companyname']; }?> -->
                  <!-- </div> -->
                  <div class="title" style="margin-top: 5px;font-weight: 500;">
                    <?php if(isset($profileTypeData['data']['companyExtNo']) && isset($profileTypeData['data']['companyPhoneNo'])) { echo "Phone: ".$profileTypeData['data']['companyExtNo']." ".$profileTypeData['data']['companyPhoneNo']; }?>
                    <?php if($profileTypeData['data']['CompanySize']) { echo "</br> Company Size : ".$profileTypeData['data']['CompanySize'] ; }?> 
                    <?php if($profileTypeData['data']['cmpyRevenue']) { echo "</br> Company Revenue : ".$profileTypeData['data']['cmpyRevenue']; }?> 
                    <?php if($profileTypeData['data']['yearFounded']) { echo "</br> Year Founded : ".$profileTypeData['data']['yearFounded']; }?>
                    <?php if($profileTypeData['data']['CompanyWebsite']) { echo '<span style="color: #7649B3;">'."</br>Stock Weblink: ".$profileTypeData['data']['CompanyWebsite'].'</span>'; }?>
                  </div>
                  <div class="group-navigation">
                    <div class="link active-link" onclick="showContent(event, 'about-business', '.content-section')">About Business</div>
                    <div class="link" onclick="showContent(event, 'shipping-destination', '.content-section')">Shipping Destination</div>
                    <div class="link" onclick="showContent(event, 'returns-refund', '.content-section')">Returns and Refunds</div>
                    <div class="link" onclick="showContent(event, 'policy', '.content-section')">Policy</div>
                  </div>
                  <div class="content-section" id="about-business">
                    <div class="bold-title" style="margin-top: 20px;">
                      About Business
                    </div>
                    <div class="text" style="margin-top: 10px;">
                      <?php if($profileTypeData['data']['spProfilesAboutStore']) { echo $profileTypeData['data']['spProfilesAboutStore']; }?>
                    </div>
                  </div>
                  <div class="content-section hidden" id="shipping-destination">
                    <div class="bold-title" style="margin-top: 20px;">
                      Shipping Destination
                    </div>
                    <div class="text" style="margin-top: 10px;">
                      <?php if($profileTypeData['data']['spshippingtext']) { echo $profileTypeData['data']['spshippingtext']; }?>
                    </div>
                  </div>
                  <div class="content-section hidden" id="returns-refund">
                    <div class="bold-title" style="margin-top: 20px;">
                      Returns and Refunds
                    </div>
                    <div class="text" style="margin-top: 10px;">
                      <?php if($profileTypeData['data']['spProfilerefund']) { echo $profileTypeData['data']['spProfilerefund']; }?>
                    </div>
                  </div>
                  <div class="content-section hidden" id="policy">
                    <div class="bold-title" style="margin-top: 20px;">
                    Policy
                    </div>
                    <div class="text" style="margin-top: 10px;">
                    <?php if($profileTypeData['data']['spProfilepolicy']) { echo $profileTypeData['data']['spProfilepolicy']; }?>
                    </div>
                  </div>
                </div>
                <?php
                }
                if($userProfileType == 6){
                ?>
                <span id="family_error" style="display:none;"></span>
                <div id="family-about" class="education-2">
                </div>
                <?php
                }
                if($userProfileType == 4){
                ?>
                <div class="text-wrapper">
                  <div class="heading">
                    About Me
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileData['data']['spProfileAbout']) { echo $profileData['data']['spProfileAbout']; }?>
                  </div>
                  <div class="text"><span class="title">Language Fluency:</span><?php if($profileData['data']['languagefluency']) { echo $profileData['data']['languagefluency']; }?></div>
                </div>
                <div class="text-wrapper">
                  <div class="heading">
                    Hobbies
                  </div>
                  <div class="text" style="margin-bottom: 5px;">
                    <?php if($profileData['data']['sphobbies']) { echo $profileData['data']['sphobbies']; }?>
                  </div>
                </div>
                <span id="education_error" style="display:none;"></span>
                <div id="education_table" class="education"></div>
                <span id="experience_error" style="display:none;"></span>
                <div id="experience"></div>
                <?php
                }
                ?>
              </div>
              <div class="main-content-section hidden"  id="post-list">
                <div id="postlist" style="margin-top:30px;"></div>
                <span id="profile_error" style="display:none;"></span>
                <div class="text-wrapper show-all post">
                Show All Posts
                <span style="padding-left: 5px;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.2031" cy="10.2559" r="9.75" fill="#7649B3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9164 5.26249L15.4102 9.75635C15.686 10.0321 15.686 10.4792 15.4102 10.755L10.9164 15.2488C10.6406 15.5246 10.1935 15.5246 9.91774 15.2488C9.64197 14.9731 9.64197 14.526 9.91774 14.2502L13.2061 10.9618H5.49569C5.1057 10.9618 4.78955 10.6457 4.78955 10.2557C4.78955 9.86567 5.1057 9.54952 5.49569 9.54952H13.2061L9.91774 6.26112C9.64197 5.98536 9.64197 5.53825 9.91774 5.26249C10.1935 4.98672 10.6406 4.98672 10.9164 5.26249Z" fill="white"/>
                </svg>
                </span>
                <input type="hidden" class="section-link" value="post">
                <input type="hidden" id="post_row" value="0">
                <input type="hidden" id="post_all" value="0">
              </div>
            </div>
            <div class="main-content-section hidden"  id="media-list">
              <div class="video-wrapper" id="medialist" style="margin-top:30px;">
              <span id="media_error" style="display:none;"></span>
              </div>
              <div class="text-wrapper show-all media">
              Show All Posts
              <span style="padding-left: 5px;">
              <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="10.2031" cy="10.2559" r="9.75" fill="#7649B3"/>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9164 5.26249L15.4102 9.75635C15.686 10.0321 15.686 10.4792 15.4102 10.755L10.9164 15.2488C10.6406 15.5246 10.1935 15.5246 9.91774 15.2488C9.64197 14.9731 9.64197 14.526 9.91774 14.2502L13.2061 10.9618H5.49569C5.1057 10.9618 4.78955 10.6457 4.78955 10.2557C4.78955 9.86567 5.1057 9.54952 5.49569 9.54952H13.2061L9.91774 6.26112C9.64197 5.98536 9.64197 5.53825 9.91774 5.26249C10.1935 4.98672 10.6406 4.98672 10.9164 5.26249Z" fill="white"/>
              </svg>
              </span>
              <input type="hidden" class="section-link" value="media">
              <input type="hidden" id="media_row" value="0">
              <input type="hidden" id="media_all" value="0">
              </div>
            </div>
            <div class="main-content-section hidden"  id="doc-list">
              <div class="video-wrapper" id="doclist" style="margin-top:30px;">
              <span id="doc_error" style="display:none;"></span>
              </div>
              <div class="text-wrapper show-all doc">
                Show All Posts
                <span style="padding-left: 5px;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.2031" cy="10.2559" r="9.75" fill="#7649B3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9164 5.26249L15.4102 9.75635C15.686 10.0321 15.686 10.4792 15.4102 10.755L10.9164 15.2488C10.6406 15.5246 10.1935 15.5246 9.91774 15.2488C9.64197 14.9731 9.64197 14.526 9.91774 14.2502L13.2061 10.9618H5.49569C5.1057 10.9618 4.78955 10.6457 4.78955 10.2557C4.78955 9.86567 5.1057 9.54952 5.49569 9.54952H13.2061L9.91774 6.26112C9.64197 5.98536 9.64197 5.53825 9.91774 5.26249C10.1935 4.98672 10.6406 4.98672 10.9164 5.26249Z" fill="white"/>
                </svg>
                </span>
                <input type="hidden" class="section-link" value="doc">
                <input type="hidden" id="doc_row" value="0">
                <input type="hidden" id="doc_all" value="0">
              </div>
            </div>
            <div class="main-content-section hidden"  id="portfolio-list">
              <div class="portfolio-wrapper" id="portfoliolist">
              </div>
            </div>
            <div class="main-content-section hidden" id="store-list">
              <div class="jobs-wrapper">
                <div class="heading">
                    Recently Posted Products
                </div>
                <div id="storelist"></div>
                <span id="store_error" style="display:none;"></span>
              </div>
              <div class="text-wrapper show-all store">
                <span class="view-all">
                Show All Posts
                <span style="padding-left: 5px;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.2031" cy="10.2559" r="9.75" fill="#7649B3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9164 5.26249L15.4102 9.75635C15.686 10.0321 15.686 10.4792 15.4102 10.755L10.9164 15.2488C10.6406 15.5246 10.1935 15.5246 9.91774 15.2488C9.64197 14.9731 9.64197 14.526 9.91774 14.2502L13.2061 10.9618H5.49569C5.1057 10.9618 4.78955 10.6457 4.78955 10.2557C4.78955 9.86567 5.1057 9.54952 5.49569 9.54952H13.2061L9.91774 6.26112C9.64197 5.98536 9.64197 5.53825 9.91774 5.26249C10.1935 4.98672 10.6406 4.98672 10.9164 5.26249Z" fill="white"/>.25rem !important
                </svg>
                </span>
                <input type="hidden" class="section-link" value="store">
                <input type="hidden" id="store_row" value="0">
                <input type="hidden" id="store_all" value="0">
                </span>
              </div>
            </div>
            <div class="main-content-section hidden" id="job-list">
              <div class="jobs-wrapper">
                <div class="heading">
                    Recently Posted Jobs
                </div>
                <div id="joblist"></div>
                <span id="job_error" style="display:none;"></span>
              </div>
              <div class="text-wrapper show-all jobs">
                <span class="view-all">
                  Show All Posts
                  <span style="padding-left: 5px;">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="10.2031" cy="10.2559" r="9.75" fill="#7649B3"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9164 5.26249L15.4102 9.75635C15.686 10.0321 15.686 10.4792 15.4102 10.755L10.9164 15.2488C10.6406 15.5246 10.1935 15.5246 9.91774 15.2488C9.64197 14.9731 9.64197 14.526 9.91774 14.2502L13.2061 10.9618H5.49569C5.1057 10.9618 4.78955 10.6457 4.78955 10.2557C4.78955 9.86567 5.1057 9.54952 5.49569 9.54952H13.2061L9.91774 6.26112C9.64197 5.98536 9.64197 5.53825 9.91774 5.26249C10.1935 4.98672 10.6406 4.98672 10.9164 5.26249Z" fill="white"/>.25rem !important
                  </svg>
                  </span>
                  <input type="hidden" class="section-link" value="jobs">
                  <input type="hidden" id="jobs_row" value="0">
                  <input type="hidden" id="jobs_all" value="0">
                </span>
              </div>
            </div>
            <div class="main-content-section hidden" id="project-list">
              <div class="jobs-wrapper">
                <div class="heading">
                    Recently Posted Projects
                </div>
                <div id="projectlist"></div>
                <span id="project_error" style="display:none;"></span>
              </div>
              <div class="text-wrapper show-all project">
                <span class="view-all">
                Show All Posts
                <span style="padding-left: 5px;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.2031" cy="10.2559" r="9.75" fill="#7649B3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9164 5.26249L15.4102 9.75635C15.686 10.0321 15.686 10.4792 15.4102 10.755L10.9164 15.2488C10.6406 15.5246 10.1935 15.5246 9.91774 15.2488C9.64197 14.9731 9.64197 14.526 9.91774 14.2502L13.2061 10.9618H5.49569C5.1057 10.9618 4.78955 10.6457 4.78955 10.2557C4.78955 9.86567 5.1057 9.54952 5.49569 9.54952H13.2061L9.91774 6.26112C9.64197 5.98536 9.64197 5.53825 9.91774 5.26249C10.1935 4.98672 10.6406 4.98672 10.9164 5.26249Z" fill="white"/>.25rem !important
                </svg>
                </span>
                <input type="hidden" class="section-link" value="project">
                <input type="hidden" id="project_row" value="0">
                <input type="hidden" id="project_all" value="0">
                </span>
              </div>
            </div>
            <div class="main-content-section hidden" id="properties-list">
              <div class="jobs-wrapper">
                <div class="heading">
                    Recently Posted Properties
                </div>
                <div id="propertieslist"></div>
                <span id="properties_error" style="display:none;"></span>
              </div>
              <div class="text-wrapper show-all property">
                <span class="view-all">
                Show All Posts
                <span style="padding-left: 5px;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="10.2031" cy="10.2559" r="9.75" fill="#7649B3"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.9164 5.26249L15.4102 9.75635C15.686 10.0321 15.686 10.4792 15.4102 10.755L10.9164 15.2488C10.6406 15.5246 10.1935 15.5246 9.91774 15.2488C9.64197 14.9731 9.64197 14.526 9.91774 14.2502L13.2061 10.9618H5.49569C5.1057 10.9618 4.78955 10.6457 4.78955 10.2557C4.78955 9.86567 5.1057 9.54952 5.49569 9.54952H13.2061L9.91774 6.26112C9.64197 5.98536 9.64197 5.53825 9.91774 5.26249C10.1935 4.98672 10.6406 4.98672 10.9164 5.26249Z" fill="white"/>.25rem !important
                </svg>
                </span>
                <input type="hidden" class="section-link" value="properties">
                <input type="hidden" id="properties_row" value="0">
                <input type="hidden" id="properties_all" value="0">
                </span>
              </div>
            </div>
          <?php
          } else {
          ?>
            <div class="text-wrapper block">
            Access rights are restricted to view profile.
            </div>
          <?php
          }
          ?>

          <?php }else{ ?>
            <div class="text-wrapper block">
              Profile user does not exists.
            </div>
          <?php } ?>
        </div>
        <div class="right-bar">
            <div class="group-followed">
                <div class="main-heading">
                    <div class="heading">
                        Groups Followed
                    </div>
                    <img src="<?php echo $BaseUrl?>/assets/images/down-arrow-2-2.svg" alt="">
                </div>
                <div class="group">
                    <img src="<?php echo $BaseUrl?>/assets/images/group-img.svg" alt="">
                    <div class="detail">
                        <div class="name">Health & Wellness</div>
                        <div class="title">450 Members</div>
                        <a href="#" class="join">Join</a>
                    </div>
                </div>
                <div class="group">
                    <img src="<?php echo $BaseUrl?>/assets/images/group-img.svg" alt="">
                    <div class="detail">
                        <div class="name">Health & Wellness</div>
                        <div class="title">450 Members</div>
                        <a href="#" class="join">Join</a>
                    </div>
                </div>
                <div class="group">
                    <img src="<?php echo $BaseUrl?>/assets/images/group-img.svg" alt="">
                    <div class="detail">
                        <div class="name">Health & Wellness</div>
                        <div class="title">450 Members</div>
                        <a href="#" class="join">Join</a>
                    </div>
                </div>
                <a href="#" class="view-all">View All</a>
            </div>
            <div class="similar-profile">
                <div class="main-heading">
                    <div class="heading">
                        Similar Profiles
                    </div>
                    <img src="<?php echo $BaseUrl?>/assets/images/down-arrow-2-2.svg" alt="">
                </div>
                <div class="similiar-profile-list">
                    <img src="<?php echo $BaseUrl?>/assets/images/profile-img-1.svg" alt="">
                    <div class="detail">
                        <div class="name">Gloria</div>
                        <div class="title">Product Manager</div>
                        <a href="#" class="join">View Profile</a>
                    </div>
                </div>
                <div class="similiar-profile-list">
                    <img src="<?php echo $BaseUrl?>/assets/images/profile-img-1.svg" alt="">
                    <div class="detail">
                        <div class="name">Gloria</div>
                        <div class="title">Product Manager</div>
                        <a href="#" class="join">View Profile</a>
                    </div>
                </div>
                <div class="similiar-profile-list">
                    <img src="<?php echo $BaseUrl?>/assets/images/profile-img-1.svg" alt="">
                    <div class="detail">
                        <div class="name">Gloria</div>
                        <div class="title">Product Manager</div>
                        <a href="#" class="join">View Profile</a>
                    </div>
                </div>
                <a href="#" class="view-all">View All</a>
            </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="business" tabindex="-1" role="dialog" aria-labelledby="businessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="" method="post" id="businessPr" enctype="multipart/form-data">
                <div class="modal-header">
                    <div class="text-center w-100">
                        <h4 class="modal-title" id="businessModalLabel">Business Profile Verification</h4>
                        <h5 class="modal-title" style="margin-top: 8px;">Submit the documents requested to verify your business</h5>
                    </div>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close" style="font-size: 32px;border: none;background: none;">
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
    <?php
      include_once("../views/common/footer.php");
      include_once("../views/common/share-modal.php");
    ?>
    <script type="text/javascript">
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
      // var Business_Name = $("#business").find("#Business_Name").val();
      // var spaddress = $("#business").find("#spaddress").val();
      // var spUser_Country = $("#business").find("#spUser_Country").val();
      // var spUserState = $("#business").find("#spUserState").val();
      // var spUserCity = $("#business").find("#spUserCity").val();
      var Profiles = $("#business").find("#Profiles")[0].files[0];
      var upload_bills = $("#business").find("#upload_bills")[0].files[0];
      // var bswebsite = $("#business").find("#bswebsite").val();
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
                  $("#err_businessL").text("Acceptable format - PDF, JPG, PNG.");
              }
              if (upload_bills == undefined) {
                  $("#err_bills").text("Acceptable format - PDF, JPG, PNG.");
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
            const errorMessage = "Accpetable format - PDF, JPG,PNG.";
            
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
    <script src="../assets/js/posting/timeline.js"></script>
    <script src="../assets/js/posting/publicview.js"></script>
</body>
</html>
