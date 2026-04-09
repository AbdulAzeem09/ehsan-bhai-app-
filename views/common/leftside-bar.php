<?php
require_once "../classes/Timeline.php";
//this one
    $t = new Timeline;
    $h = new Header;

    $profiles = $h->readProfileOnConsultation($_SESSION["uid"]);

    $env = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");
    $secretKey = $env["CONSULT_SECRET_KEY"] ?? "THESHAREWATERBROOK860";

    $payload = [
        'user_id'           => $_SESSION['uid'],
        'email'             => $_SESSION['spUserEmail'],
        'user_name'         => $_SESSION['login_user'],
        'country'           => $_SESSION['spPostCountry'],
        'state'             => $_SESSION['spPostState'],
        'profile_id'        => $_SESSION['pid'],
        'profile_pic'        => $_SESSION['spProfilePic'],
        'profile_name'      => $_SESSION['myprofile'],
        'profile_data'	    => $profiles['data'],
        'profile_type_name' => $_SESSION['ptname'],
        'status'            => $_SESSION['isActive'],
        'iat'               => time(),                       // Issued at time
        'exp'               => time() + 3600                 // Token expiry (1 hour)
    ];

    // Convert to JSON
    $jsonData = json_encode($payload);

    // Encrypt data
    // $iv = random_bytes(16);
    $iv = $env["IV_KEY"];
    $encryptedData = openssl_encrypt($jsonData, 'AES-256-CBC', $secretKey, 0, $iv);

    // Base64 encode to make it URL-safe
    $combinedData = $iv . $encryptedData;
    $token      = urlencode(base64_encode($combinedData));
    // $env        = parse_ini_file($_SERVER["DOCUMENT_ROOT"]."/.env");
    $redirectUrl = $env["CONSULTATION_FRONTEND_URL"].'/callback?app=consultation&token=' . $token;

    $eventRedirectUrl = $env["EVENT_FRONTEND_URL"].'/authenticate?app=event&page=event&token=' . $token;
    
    $fundRedirectUrl = $env["EVENT_FRONTEND_URL"].'/authenticate?app=event&page=fund&token=' . $token;
    $datingRedirectUrl = $env["DATING_FRONT_URL"].'/?token=' . $token; 
    $sprecord =  $pt->getProfileStatus($_SESSION["pid"] , $_SESSION["uid"]);
    if (!isset($profile_type)) { 
        require_once "../classes/EditProfile.php";
        $edi_pt = new EditProfile();
        $row_profile  = $edi_pt->fetchUserData($_SESSION["pid"]);
        $profile_type = isset($row_profile['data']["spProfileType_idspProfileType"]) ? $row_profile['data']["spProfileType_idspProfileType"] : 0;
    }
    //  $num_rows= 0;
    //  $show_verify_link = true;
    //  if(isset($_GET['profileid'])){
        // require_once $_SERVER['DOCUMENT_ROOT'] . "/backofadmin/library/config.php";
        // $sprecord_query = "select * from spprofiles where idspProfiles='".$_SESSION["pid"]."' and spUser_idspUser='".$_SESSION['uid']."'";
        // $check_businessprofile = mysqli_query($dbConn, $sprecord_query);
        // $num_rows = mysqli_num_rows($check_businessprofile);
        // if($num_rows > 0){
        //     // $show_verify_link = true;
        // }
    //  }
?>
<style>

 .verify-now-btn {
  margin-top: 14px;
  display: inline-block;
  background: linear-gradient(100deg, #0d6efd, #4cc9f0); 
  color: #fff;
  font-weight: 600;
  font-size: 15px;
  padding: 12px 14px;
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

.pending-badge {
   float: right;
    margin-top: -58px;
    position: absolute;
    top: 71px;
    right: 12px;
    display: inline-block;
    background: linear-gradient(135deg, #e63946, #c92a2a);
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    padding: 11px 11px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    text-decoration: none;
    box-shadow: 0 4px 10px rgba(255, 140, 0, 0.3);
    transition: all 0.3s ease;
    letter-spacing: 0.4px;
    position: relative;
    overflow: hidden;
    border-radius: 27px;
    cursor: context-menu;
}

</style>
<div class="side-bar" id="side-bar">
    <div class="cross-icon" onclick="leftsideBarClose()">
        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M12.9998 0.999818C12.8123 0.812347 12.558 0.707031 12.2928 0.707031C12.0277 0.707031 11.7733 0.812347 11.5858 0.999818L6.99982 5.58582L2.41382 0.999818C2.22629 0.812347 1.97198 0.707031 1.70682 0.707031C1.44165 0.707031 1.18735 0.812347 0.999818 0.999818C0.812347 1.18735 0.707031 1.44165 0.707031 1.70682C0.707031 1.97198 0.812347 2.22629 0.999818 2.41382L5.58582 6.99982L0.999818 11.5858C0.812347 11.7733 0.707031 12.0277 0.707031 12.2928C0.707031 12.558 0.812347 12.8123 0.999818 12.9998C1.18735 13.1873 1.44165 13.2926 1.70682 13.2926C1.97198 13.2926 2.22629 13.1873 2.41382 12.9998L6.99982 8.41382L11.5858 12.9998C11.7733 13.1873 12.0277 13.2926 12.2928 13.2926C12.558 13.2926 12.8123 13.1873 12.9998 12.9998C13.1873 12.8123 13.2926 12.558 13.2926 12.2928C13.2926 12.0277 13.1873 11.7733 12.9998 11.5858L8.41382 6.99982L12.9998 2.41382C13.1873 2.22629 13.2926 1.97198 13.2926 1.70682C13.2926 1.44165 13.1873 1.18735 12.9998 0.999818Z"
                fill="#374957" />
        </svg>
    </div>
    <div class="profile-info">
        <div class="profile-detail" style="cursor: pointer;" id="profileDetail">
            <?php
               $userInfo = $t->UserInfo($_SESSION['pid']);
            ?>
            <img src="<?php if(isset($userInfo['data']['spProfilePic']) && ($userInfo['data']['spProfilePic'])!=null) { echo $userInfo['data']['spProfilePic'];} else { echo $BaseUrl."/assets/images/icon/blank-img.png"; } ?>"
                alt="">
            <div class="name">
                <?php if($userInfo['data']['spProfileName']) { echo $userInfo['data']['spProfileName']; }?></div>
            <div class="title" style=" margin-top: 8px;">
                <?php if($userInfo['data']['spProfileTypeName']) { echo $userInfo['data']['spProfileTypeName']." Profile"; 
                    if($profile_type ==1) {
                        if (isset($sprecord) && isset($sprecord[0]) && $sprecord[0]['status'] == 2) {
                            echo '<img src="'.$BaseUrl.'/assets/images/icon/green-tick.png" alt="Verified"  title ="Verified" title ="Verified" style="width:20px; height:20px; margin-left:5px;margin-top:-4px">';
                        }
                    }
            }
            ?>
            </div>
            <div>
             <?php
                $userstatus = isset($sprecord) && isset($sprecord[0]) ?  $sprecord[0]['status']  : 0;
                // echo $profile_type;
                // echo "<br>";
                // echo $userstatus;
                // echo "<br>";
                // var_dump($show_verify_link);
                // echo "<br>";

                if($profile_type == 1 && $userstatus!=2) {
                    if($userstatus == 0){?>
                        <a data-bs-toggle="modal" 
                            id="show_business" 
                            data-bs-target="#business" 
                            class="verify-now-btn" 
                            style=" position: absolute; right: 21px;text-align: right;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M9 11l3 3L22 4l2 2-12 12-5-5z"/>
                                </svg>
                                <span>Verify Business</span>
                        </a>
                    <?php } else {  ?>
                        <div class="verified-wrapper2">
                            <span class="pending-badge"><?php echo "Verification Pending";?></span>
                        </div>
                    <?php 
                        }
                    }
            ?>
            </div>
        
        </div>
        <div class="referal-code-wrapper" <?php if($profile_type == 1 && $userstatus!=2) {?> style="margin-top:73px;"<?php } ?>>
            <div class="referal-code">
                <div class="heading" style="font-size: 16px; font-weight: 600;">
                    Referral Code:
                </div>
                <div class="ref">
                    <?php if($userInfo['data']['userrefferalcode']) { echo $userInfo['data']['userrefferalcode']; }?>
                </div>
                <div id="refferalcodeurl" style="display:none">
                    <?php if($userInfo['data']['userrefferalcode']) { echo $BaseUrl."/sign-up.php?rfrcode=".$userInfo['data']['userrefferalcode']; }?>
                </div>
            </div>
            <img src="<?php echo $BaseUrl?>/assets/images/copy-icon.svg" alt="" id="copyButton"
                style="cursor: pointer;">
        </div>
        <?php
                      $profiles = $h->readProfiles($_SESSION['uid']);
                    ?>
        <div class="drop-down-add">
            <div>
                <select id="profileTypeDropdown" class="drop-down-wrapper" onchange="profilechange(this.value, 0)">
                    <?php foreach ($profiles['data'] as $type): ?>
                    <option value="<?php echo $type['idspProfiles']; ?>"
                        <?php if ($type['spProfilesDefault'] == 1) echo 'selected'; ?> class="drop-down-wrapper">
                        <?php echo ucfirst($type['spProfileName']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <ul class="my-profile-icon">
                <li> <a href="<?php echo $BaseUrl?>/my-profile/">
                        <img src="<?php echo $BaseUrl?>/assets/images/add-icon.svg" alt="">
                    </a></li>
            </ul>
        </div>
        <ul class="navigation">
            <li class="link">
                <a href="<?php echo $BaseUrl?>/dashboard/">
                    <div class="icon">
                        <img src="<?php echo $BaseUrl?>/assets/images/dashboard-icon.svg" alt="">
                    </div>
                    <span>Master Dashboard</span>
                </a>
            </li>
            <li class="link">
                <a href="<?php echo $BaseUrl?>/membership/dash_index.php">
                    <div class="icon">
                        <img src="<?php echo $BaseUrl?>/assets/images/subscription-icon.svg" alt="">
                    </div>
                    <span>My Subscription</span>
                </a>
            </li>
            <li class="link">
                <a href="#" data-bs-toggle="modal" data-bs-target="#invite">
            <li class="link">
                <div class="icon">
                    <img src="<?php echo $BaseUrl?>/assets/images/invite-icon.svg" alt="">
                </div>
                <span>Invite and Earn</span>
                </a>
            </li>
<!--            <li class="link">-->
<!--                <a href="--><?php //echo $BaseUrl?><!--/profile/index.php?favourite">-->
<!--                    <div class="icon">-->
<!--                        <img src="--><?php //echo $BaseUrl?><!--/assets/images/favourite-icon.svg" alt="">-->
<!--                    </div>-->
<!--                    <span>Favourite</span>-->
<!--                </a>-->
<!--            </li>-->
            <li class="link">
                <a href="<?php echo $BaseUrl?>/inbox.php?msg=inbox_msg">
                    <div class="icon">
                        <img src="<?php echo $BaseUrl?>/assets/images/inbox-ixon.svg" alt="">
                    </div>
                    <span>Inbox</span>
                </a>
            </li>
            <li class="link">
                <a href="<?php echo $BaseUrl?>/my-groups/">
                    <div class="icon">
                        <img src="<?php echo $BaseUrl?>/assets/images/groups-icn.svg" alt="">
                    </div>
                    <span>Groups</span>
                </a>
            </li>
            <li class="link"> <a href="<?php echo $BaseUrl?>/dashboard/sticky/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/sticky.svg" alt="">
                        </div>
                        <span>Sticky Notes</span>
                    </div>
                </a></li>
        </ul>
    </div>
    <?php
                if(isset($page) && $page == 'profilehomepage') {
                ?>
    <div class="profiles">
        <div class="heading">
            Profiles Created
        </div>
        <?php
                    if(isset($profiles['data']) && count($profiles['data']) > 0){
                      foreach($profiles['data'] as $row) {
                    ?>
        <a href="#">
            <div class="profile">
                <div class="img-wrapper">
                    <img src="<?php if(isset($row['spProfilePic'])) { echo $row['spProfilePic'];} else { echo $BaseUrl."/assets/images/icon/blank-img.png"; } ?>"
                        alt="">
                </div>
                <div class="detail">
                    <div class="name"><?php echo ucwords(substr($row['spProfileName'], 0, 15)); ?></div>
                    <div class="profile-name"><?php echo $row['spProfileTypeName'] . " Profile"; ?></div>
                </div>
            </div>
        </a>
        <?php
                      }
                    }
                    ?>
    </div>
    <?php
                } else {
                ?>
    <div class="explore-bar">
        <div class="main-heading" style="font-size: 15px; font-weight: 600;">
            Explore The SharePage
        </div>

      <?php
      try {
//          include_once "../../mlayer/_spAllStoreForm.class.php";

          if (!class_exists('_spAllStoreForm')) {
              throw new Exception('Class _spAllStoreForm not found.');
          }
          $as = new _spAllStoreForm;

          $result_as = $as->readAllModuleShow($_SESSION['pid'], $_SESSION['uid']);

          if ($result_as) {
              $row = mysqli_fetch_assoc($result_as);
                $timeline = $row['timeline'];
                $jobboard = $row['jobboard'];
                $freelance = $row['freelance'];
                $event = $row['event'];
                $fund_raising = $row['fund_raising'];
                $classified_ads = $row['classified_ads'];
                $consultation = $row['consultation'];
                $invoicing = $row['invoicing'];
                $business = $row['business'];

            //   $freelance = $row['freelance'];
            //   $jobboard = $row['jobboard'];
            //   $realestate = $row['realestate'];
            //   $event = $row['event'];
            //   $art = $row['art'];
            //   $music = $row['music'];
            //   $videos = $row['videos'];
            //   $trainings = $row['trainings'];
            //   $directory = $row['directory'];
            //   $groups_new = $row['groups'];
            //   $news = $row['news'];
            //   $nft = $row['nft'];
            //   $dating = $row['date'];
            //   $buisness = $row['business'];
            //   $classified_ads = $row['classified_ads'];
            //   $stores = $row['stores'];
            //   $rental = $row['rental'];
          } else {
                $timeline = "";
                $jobboard = "";
                $freelance = "";
                $event = "";
                $fund_raising = "";
                $classified_ads = "";
                $consultation = "";
                $invoicing = "";
                $business = "";

            //   $nft = 0;
            //   $buisness = 0;
            //   $news = 0;
            //   $freelance = 0;
            //   $jobboard = 0;
            //   $realestate = 0;
            //   $event = 0;
            //   $art = 0;
            //   $music = 0;
            //   $videos = 0;
            //   $trainings = 0;
            //   $directory = 0;
            //   $classified_ads = 0;
            //   $stores = 0;
            //   $rental = 0;
            //   $ating = 0;
            //   $groups_new = 0;
          }


          $result_as1 = $as->readAllModuleShow($_SESSION['pid'], $_SESSION['uid']);
          if ($result_as1) {
              $row1 = mysqli_fetch_assoc($result_as1);
              $buisness = $row1['business'];
          }


      } catch (Exception $e) {
          echo 'Error: ' . $e->getMessage();
      }
      ?>



        <ul class="navigation">
            <!-- <li > <a href="#">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/network.svg" alt="">
                        </div>
                        <span>NETWORKING</span>
                    </div>
                </a></li>
            <li class="<?php echo ($stores == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $BaseUrl?>/store/personal.php?page=1">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/person.svg" alt="">
                        </div>
                        <span>PERSONAL STORE</span>
                    </div>
                </a></li>
            <li> <a href="<?php echo $BaseUrl?>/retail/view-all.php?condition=All&folder=retail&page=1">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/retail.svg" alt="">
                        </div>
                        <span>RETAIL STORE</span>
                    </div>
                </a></li>
                <li> <a href="<?php echo $BaseUrl?>/wholesale/?condition=All&folder=wholesale&page=1">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/wholesale.svg" alt="">
                        </div>
                        <span>WHOLESALE</span>
                    </div>
                </a></li> -->
                <li class="<?php echo ($timeline == 1) ? 'hidden' : ''; ?>"> <a href="<?php echo $BaseUrl?>/timeline/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/timeline.svg" alt="">
                        </div>
                        <span>TIME LINE</span>
                    </div>
                </a></li>
                <li class="<?php echo ($jobboard == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $BaseUrl?>/job-board/">
                        <div class="link">
                            <div class="icon">
                                <img src="<?php echo $BaseUrl?>/assets/images/job.svg" alt="">
                            </div>
                            <span>JOBS</span>
                        </div>
                    </a></li>
                <li class="<?php echo ($freelance == 1) ? 'hidden' : ''; ?>"> <a href="<?php echo $BaseUrl?>/freelancer/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/freelancer.svg" alt="">
                        </div>
                        <span>FREELANCER</span>
                    </div>
                </a></li>
            <!-- <li  class="<?php echo ($realestate == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $BaseUrl?>/real-estate/index.php">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/estate.svg" alt="">
                        </div>
                        <span>REAL ESTATE</span>
                    </div>
                </a></li> -->
            <!-- <li class="<?php echo ($rental == 1) ? 'hidden' : ''; ?>"> <a href="<?php echo $BaseUrl?>/real-estate/all-room.php">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/rental.svg" alt="">
                        </div>
                        <span>RENTAL</span>
                    </div>
                </a></li> -->
            <li class="<?php echo ($event == 1) ? 'hidden' : ''; ?> ">
                <a href="<?php echo $eventRedirectUrl?>" target="_blank">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/events.svg" alt="EVENTS">
                        </div>
                        <span>EVENTS</span>
                    </div>
                </a>
            </li>
            <li>
                <a href="<?php echo $fundRedirectUrl?>" target="_blank">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/fund.svg" alt="FUND RAISING" width="25"
                                height="25">
                        </div>
                        <span>FUND RAISING</span>
                    </div>
                </a>
            </li>
            <!-- <li class="<?php echo ($art == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $BaseUrl?>/artandcraft/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/art.svg" alt="">
                        </div>
                        <span>ART & CRAFT</span>
                    </div>
                </a></li> -->
            <li class="<?php echo ($classified_ads == 1) ? 'hidden' : ''; ?>"> <a href="<?php echo $BaseUrl?>/services/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/classified.svg" alt="">
                        </div>
                        <span>CLASSIFIED</span>
                    </div>
                </a></li>
            <!-- <li class="<?php echo ($videos == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $BaseUrl?>/videos/index.php?page=1">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/videos.svg" alt="">
                        </div>
                        <span>VIDEOS</span>
                    </div>
                </a></li>
            <li class="<?php echo ($news == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $BaseUrl?>/news/index.php?page=1">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/news.svg" alt="">
                        </div>
                        <span>NEWSVIEWS</span>
                    </div>
                </a></li>
 -->
<!--            <li> <a href="--><?php //echo $BaseUrl?><!--/my-groups/">-->
<!--                    <div class="link">-->
<!--                        <div class="icon">-->
<!--                            <img src="--><?php //echo $BaseUrl?><!--/assets/images/groups.svg" alt="">-->
<!--                        </div>-->
<!--                        <span>GROUPS</span>-->
<!--                    </div>-->
<!--                </a></li>-->
            <!-- <li class="<?php echo ($nft == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $BaseUrl?>/nft/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/nft.svg" alt="">
                        </div>
                        <span>NFT MARKET PLACE</span>
                    </div>
                </a></li> -->
            <!-- <li class="<?php echo ($trainings == 1) ? 'hidden' : ''; ?>"> <a href="<?php echo $BaseUrl?>/trainings/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/training.svg" alt="">
                        </div>
                        <span>TRAINING</span>
                    </div>
                </a></li> -->
<!--            <li> <a href="--><?php //echo $BaseUrl?><!--/store/pos-dashboard/index.php">-->
<!--                    <div class="link">-->
<!--                        <div class="icon">-->
<!--                            <img src="--><?php //echo $BaseUrl?><!--/assets/images/point-of-sell.svg" alt="">-->
<!--                        </div>-->
<!--                        <span>POINT OF SELL</span>-->
<!--                    </div>-->
<!--                </a></li>-->
            <!-- <li> <a href="<?php echo $BaseUrl?>/dashboard/portfolio/">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/portfolio.svg" alt="">
                        </div>
                        <span>PORTFOLIO</span>
                    </div>
                </a></li> -->
<!--            <li> <a href="--><?php //echo $BaseUrl?><!--/business_for_sale/index.php?page=1">-->
<!--                    <div class="link">-->
<!--                        <div class="icon">-->
<!--                            <img src="--><?php //echo $BaseUrl?><!--/assets/images/business-for-sale.svg" alt="">-->
<!--                        </div>-->
<!--                        <span>BUSINESS FOR SALE</span>-->
<!--                    </div>-->
<!--                </a></li>-->
            <li class="<?php echo (isset($dating) && $dating == 1) ? 'hidden' : ''; ?> "> <a href="<?php echo $datingRedirectUrl?>">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/dating.svg" alt="">
                        </div>
                        <span>DATING</span>
                    </div>
                </a></li> 
<!--      <!-- <li> <a href="#">
<!--                    <div class="link"
<!--                        <div class="icon">
<!--                            <img src="<?php //echo $BaseUrl?>/assets/images/passive.svg" alt="">
<!--                        </div>-->
<!--                        <span>PASSIVE INCOME</span>-->
<!--                    </div>
<!--                </a>
<!--            </li> -->
<!--            <li> <a href="--><?php //echo $BaseUrl?><!--/inbox.php?msg=inbox_msg">-->
<!--                    <div class="link">-->
<!--                        <div class="icon">-->
<!--                            <img src="--><?php //echo $BaseUrl?><!--/assets/images/messenger.svg" alt="">-->
<!--                        </div>-->
<!--                        <span>MESSENGER</span>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </li>-->

<!--            <li> <a href="#">-->
<!--                    <div class="link">-->
<!--                        <div class="icon">-->
<!--                            <img src="--><?php //echo $BaseUrl?><!--/assets/images/car.svg" alt="">-->
<!--                        </div>-->
<!--                        <span>CAR Sales</span>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </li>-->
                
            <li><a href="<?php echo $redirectUrl?>" target="_blank">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/consultation.svg" alt="">
                        </div>
                        <span>CONSULTATION</span>
                    </div>
                </a>
            </li>
            <li class="<?php echo ($invoicing == 1) ? 'hidden' : ''; ?>"> <a href="<?php echo $env["CONSULTATION_FRONTEND_URL"]?>/callback?page=add-invoice<?php echo '&app=consultation&token='.$token?>">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/invoice.svg" alt="">
                        </div>
                        <span>INVOICING</span>
                    </div>
                </a></li>
            <li><a href="<?php echo $redirectUrl?>" target="_blank">
                    <div class="link">
                        <div class="icon">
                            <img src="<?php echo $BaseUrl?>/assets/images/business.svg" alt="">
                        </div>
                        <span>GLOBAL BUSINESS DIRECTORY</span>
                    </div>
                </a>
            </li>

<!--            <li><a href="--><?php //echo $BaseUrl?><!--/inbox.php?msg=inbox_msg">-->
<!--                    <div class="link">-->
<!--                        <div class="icon">-->
<!--                            <img src="--><?php //echo $BaseUrl?><!--/assets/images/hot-deals.svg" alt="">-->
<!--                        </div>-->
<!--                        <span>HOT DEALS</span>-->
<!--                    </div>-->
<!--                </a></li>-->
        </ul>
    </div>
    <?php
              }
            ?>
</div>


<?php $editor_invite = true; ?>
<div class="modal invite-modal" id="invite" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Invite</h1>
            </div>

            <div class="modal-body">
                <div class="input-group in-1-col">
                    <label>Email<span style="color: #ef1d26">*</span></label>
                    <input type="text" id='invite_email'
                        placeholder="Enter Email ( add multiple email separated by comma )" />
                    <p id='invite_email_error' style='color:red'></p>
                </div>
                <div class="input-group in-1-col">
                    <label>Subject<span style="color: #ef1d26">*</span></label>
                    <input type="text" readonly id='invite_subject' placeholder="Enter Subject"
                        value='<?= $_SESSION['login_user'] ?> is Inviting you to The SharePage platform. ( Use referral code -  <?php if($userInfo['data']['userrefferalcode']) { echo $userInfo['data']['userrefferalcode']; }?> )' />
                </div>

                <div class="email-data" id='editor-invite'>
                    <div class="tile">Hi!</div>
                    <div class="text ">
                        <div>
                            <p>I hope you're doing well! I wanted to share something exciting
                                with you – I've recently joined The SharePage
                                (<a href='https://www.thesharepage.com/'>www.TheSharePage.com</a>), and I think you’d
                                love it too!</p>
                            <br>
                            <p>
                                The SharePage is a social and business networking platform
                                with a twist. It’s not just about connecting with people –
                                it’s a space where you can grow your network, showcase your
                                talents, and even earn passive income through friends
                                referrals as well as subscription referrals.
                                The SharePage has something for everyone.</p>
                        </div>
                        <div>
                            <br>
                            Here’s why you should join:
                            <ul>
                                <li>
                                    Connect with professionals and businesses across various
                                    industries.
                                </li>
                                <li>
                                    Showcase your skills and talents to a broader audience.
                                </li>
                                <li>
                                    Explore opportunities for collaboration, jobs, and
                                    projects.
                                </li>
                                <li>
                                    Monetize your network with referral bonuses and more!
                                </li>

                            </ul>
                        </div>
                        <div>
                            It’s free to join. You can sign up and start exploring right away at
                            <a href='https://www.thesharepage.com/'>www.TheSharePage.com</a>. Use my referral code
                            <b><?php if($userInfo['data']['userrefferalcode']) { echo $userInfo['data']['userrefferalcode']; }?></b>
                            .
                        </div>
                        <div>
                            <br>
                            Looking forward to seeing you here on The SharePage!
                            <br>
                        </div>
                        <div>
                            Best,
                            <br>
                            <br /><?= $_SESSION['login_user'] ?><br />
                            <a href='https://www.thesharepage.com/'>www.TheSharePage.com</a>
                        </div>
                    </div>
                </div>
                <div id='result'></div>
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" id='sendInviteButton' class="btn btn-primary"
                    style="background-color: #7649b3; color: white">
                    Invite
                </button>
            </div>
        </div>
    </div>
</div>
<script>

    const profileDropdown = document.getElementById('profileDetail');
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function() {
            location.href = '<?php echo $BaseUrl . '/my-profile'; ?>';
        });
    }

    // Child click -> open modal and prevent redirect
    const showBusiness = document.getElementById('show_business');
    if (showBusiness) {
        showBusiness.addEventListener('click', function(event) {
            event.stopPropagation(); // prevents the redirect
        });
    }
  
</script>