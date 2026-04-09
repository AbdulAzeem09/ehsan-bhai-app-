<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/backofadmin/library/config.php";
    // Make include resilient across pages: only call helper if available, with safe fallbacks
    $sprecord = [];
    // Prefer an already-initialized helper if present
    if (isset($h) && is_object($h) && method_exists($h, 'getProfileStatus')) {
        $sprecord = $h->getProfileStatus($_SESSION["pid"], $_SESSION["uid"]);
    } else {
        // Fallback: include Base and Header classes relative to project root
        $appRoot = dirname(__DIR__); // .../SHAREPAGE_CODES
        $basePath = $appRoot . '/classes/Base.php';
        if (is_file($basePath) && !class_exists('Base')) {
            require_once $basePath;
        }
        $headerPath = $appRoot . '/classes/Header.php';
        if (is_file($headerPath)) {
            require_once $headerPath;
            if (class_exists('Header')) {
                $check_head = new Header();
                if (method_exists($check_head, 'getProfileStatus')) {
                    $sprecord_query = "select * from spbuiseness_files where sp_pid='$sp_pid' and sp_uid='$sp_uid' order by id desc limit 1 ";
                    $check_businessprofile = mysqli_query($dbConn, $sprecord_query);
                    $sprecord[0] = mysqli_fetch_array($check_businessprofile);
                }
            }
        }
    }

    // Default profile type if not provided by parent
    if (!isset($profile_type)) { $profile_type = 0; }
?>
<style>
    .leftDashboard {
        background-color: white;
    }

    .leftDashboard ul li a {
        background-color: white !important;
    }

    .treeview-menu li a:hover {
        background-color: red !important;
    }

    .userProfile p,.userProfile img {
        color: #444040 !important;
        margin-left : 14px;
    }
    

    .leftDashboard ul li a.active {
        background: #3e2048 !important;
    }

    .leftDashboard h2 {
        padding: 10px 10px !important;
    }

    .verify-now-btn {
        margin-top: 14px;
        display: inline-block;
        background: linear-gradient(100deg, #0d6efd, #4cc9f0); 
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 12px 13px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
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
        right: 43px;
        float: right;
        margin-top: 12px;
        position: absolute;
        display: inline-block;
        background: linear-gradient(135deg, #e63946, #c92a2a); /* red gradient */; /* warm orange gradient */
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        padding: 12px 14px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(255, 140, 0, 0.3);
        transition: all 0.3s ease;
        letter-spacing: 0.4px;
        position: relative;
        overflow: hidden;
        border-radius :27px;
        cursor: context-menu;
    }

</style>
<div class="leftDashboard sidebar">
    <div class="userProfile" style="cursor:pointer;" id="profileDropdownClick" >
        <?php
        $p = new _spprofiles;
        $result = $p->read($_SESSION['pid']);
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            if (isset($row["spProfilePic"]) && !empty($row["spProfilePic"])) {
                echo "<img alt='' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
            } else {
                echo "<img alt='' class='img-circle' src='" . $BaseUrl . "/assets/images/icon/blank-img.png' >";
            }
        ?>
        
            <p style="white-space: nowrap; width: 100px; overflow: hidden; text-overflow: ellipsis;margin-top:8px;"> <a  style="color:black;"><?php echo isset($row['spProfileName']) && !empty($row['spProfileName']) ? ucwords(strtolower($row['spProfileName'])) : ucwords(strtolower($_SESSION['username'])); ?></a></p>
            <p style="font-weight:bold;font-size:13px;margin-top:-10px;display:inline-block;margin-left : 0px;">
            <?php if (isset($_SESSION['guet_yes']) && $_SESSION['guet_yes'] == "yes") {
                        echo "Guest Profile";
                    } else {
                        echo $row['spProfileTypeName'] . " " . "Profile";
                    }
                     if($profile_type ==1) {
                        if (isset($sprecord) && isset($sprecord[0]) && $sprecord[0]['status'] == 2) {
                            echo '<img src="'.$BaseUrl.'/assets/images/icon/green-tick.png" alt="Verified" title ="Verified" style="width:20px; height:20px; margin-left:5px;margin-top:-2px;float:right;">';
                        }
                    }
              ?>
             </p>
               <p>
             <?php
                // echo "<pre>";
                $userstatus = isset($sprecord) && isset($sprecord[0]) ?  $sprecord[0]['status']  :0;
                // echo 4userstatus;
                if($profile_type ==1 && $userstatus !=2) {
                 if($userstatus == 1){?>
                   <span class="pending-badge">Verification Pending</span>
                <?php } else { ?>
                    <a data-bs-toggle="modal" 
                        id="show_business" 
                        data-bs-target="#business" 
                        class="verify-now-btn" 
                        style=" position: absolute; ">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M9 11l3 3L22 4l2 2-12 12-5-5z"/>
                            </svg>
                            <span>Verify Business</span>
                    </a>
                <?php } 
                }
            ?>
            </p>
        <?php

        }
        $ms = new _spmembership;
        $result = $ms->readpid($_SESSION['pid']);
        $subLink = '/membership/dash_index.php';
        /*if ($result != false) {
          $rows = mysqli_fetch_assoc($result);
          $payment_date = $rows["createdon"];
   				$duration = $rows['duration'];
   				$date7 =  date('Y-m-d H:i:s');
          $date8 = date('Y-m-d', strtotime($date7));
          $date5 = date('Y-m-d', strtotime($payment_date));
          $date6 = date('Y-m-d', strtotime($payment_date . ' +' . $duration . ' days'));
          //var_dump($row);die;
          if (($date5 <= $date8)  && ($date6 >=  $date8)) {
            $subLink = '/dashboard/membership_transaction?page=subscription';
          }
        }*/
        //echo $pageactive;
        ?>
        <!-- <img src="<?php echo $BaseUrl; ?>/img/noman.png" class="img-responsive"> -->
    </div>
    <h2 style="<?php  if($profile_type ==1 && $userstatus !=2) { echo "margin-top:54px" ; } ?>">MASTER DASHBOARD</h2>
    <ul class="sidebar-menu dashmenuside" >
        <li><a href="<?php echo $BaseUrl . '/timeline'; ?>">Timeline</a></li>
        <!--<li><a class="<?php echo ($pageactive == 2) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard'; ?>"   style="background-color:#97298a;">Dashboard</a></li>-->
        <li><a class="<?php echo ($pageactive == 116) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/vault/pin.php'; ?>">My Vault</a></li>
        <li><a class="<?php echo ($pageactive == 3) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/sticky'; ?>">Sticky Notes</a></li>
        <?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>
            <li class="treeview <?php echo ($pageactive >= 5 && $pageactive <= 20) ? 'active' : ''; ?>">
                <a href="#" class="nav-link default-open collapsed" data-toggle="collapse" data-target="#submenu-1">
                    <span>All Modules Charts</span> <i class="fa fa-angle-down pull-right"></i>
                </a>
                <ul class="collapse" id="submenu-1">
                    <li><a class="<?php echo ($pageactive == 5) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/index.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/stores.png' ?>" alt="store" class="img-responsive"> Stores</a></li>
                    <li>
                        <a class="<?php echo ($pageactive == 6) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/freelancer.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/freelancer.png' ?>" alt="store" class="img-responsive"> Freelancer</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 7) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/jobboard.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/noldjobboard.png' ?>" alt="store" class="img-responsive"> Job Board</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 8) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/realestate.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/real-estate.png' ?>" alt="store" class="img-responsive"> Real Estate</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 9) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/event.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/events_icon.png' ?>" alt="store" class="img-responsive"> Events</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 10) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/photos.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/art_gallery_icon.png' ?>" alt="store" class="img-responsive"> Art And Craft</a>

                    </li>
                    <li>
                        <!--   <a class="<?php echo ($pageactive == 11) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/module-chart/music.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/music.png' ?>" alt="store" class="img-responsive" > Music</a> -->
                        <!-- <a class="<?php echo ($pageactive == 11) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/music/coming_music.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/music.png' ?>" alt="store" class="img-responsive" > Music</a>-->
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 12) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/video.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/videos.png' ?>" alt="store" class="img-responsive"> Videos</a>
                        <!--<a class="<?php echo ($pageactive == 12) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/videos/coming_videos.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/videos.png' ?>" alt="store" class="img-responsive" > Video</a>-->
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 14) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/services.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/classified-ads.png' ?>" alt="store" class="img-responsive"> Classified Ads</a>
                        <!-- <a class="<?php echo ($pageactive == 14) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/services/coming_services.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/classified-ads.png' ?>" alt="store" class="img-responsive" > Classified Ads</a>-->
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 15) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/directory.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/services.png' ?>" alt="store" class="img-responsive">&nbsp;My Business Space</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 19) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/news.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/news.png' ?>" alt="store" class="img-responsive">&nbsp;News Views</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 20) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/business.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/for_sale_business.webp' ?>" alt="store" class="img-responsive">&nbsp;Business for Sale</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 18) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/rental.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/rental.png' ?>" alt="store" class="img-responsive">&nbsp;Rental</a>
                    </li>
                    <li>
                        <a class="<?php echo ($pageactive == 17) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/module-chart/nft.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/nft/nft.png' ?>" alt="store" class="img-responsive">&nbsp;NFT</a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <li class="treeview <?php echo ($pageactive == 50 || $pageactive == 51) ? 'active' : ''; ?>">
            <a href="#" style="background-color: #e7a0ff !important;" data-toggle="collapse" data-target="#submenu-2">
                <span>Business</span> <i class="fa fa-angle-down pull-right"></i>
            </a>
            <ul class="collapse" id="submenu-2">
                <?php if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != 'yes') { ?>
                    <li>
                        <!-- <a class="<?php //echo ($pageactive == 14)?'active':'';
                                        ?>" href="<?php echo $BaseUrl . '/dashboard/module-chart/services.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/classified-ads.png' ?>" alt="store" class="img-responsive" > Classified Ads</a> -->
                        <a href="<?php echo $BaseUrl . '/dashboard/finance/finance.php'; ?>" class="<?php echo ($pageactive == 50) ? 'active' : ''; ?>" style="background-color: #1f3060;">My Finance</a>
                    </li>
                <?php } ?>
                <!--<li>
                     <a class="<?php echo ($pageactive == 14) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/module-chart/services.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/classified-ads.png' ?>" alt="store" class="img-responsive" > Classified Ads</a> -->
                <!--  <a href="<?php echo $BaseUrl . '/dashboard/BankDetails'; ?>">My Bank Details</a>
                </li>-->
                <li>
                    <!-- <a class="<?php echo ($pageactive == 14) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/module-chart/services.php'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/home/classified-ads.png' ?>" alt="store" class="img-responsive" > Classified Ads</a> -->
                    <a href="<?php echo $BaseUrl . '/dashboard/currency'; ?>" class="<?php echo ($pageactive == 51) ? 'active' : ''; ?>" style="background-color: #1f3060;">Currency</a>
                </li>
            </ul>
        </li>
        <li class="treeview <?php echo (($pageactive == 52) || ($pageactive == 53) || ($pageactive == 54)) ? 'active' : ''; ?>">
            <a href="#" style="background-color: #e7a0ff !important;" data-toggle="collapse" data-target="#submenu-3">
                <span>Transaction</span> <i class="fa fa-angle-down pull-right"></i>
            </a>
            <ul class="collapse" id="submenu-3">
                <li><a class="<?php echo ($pageactive == 52) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/WithdrawRequest'; ?>">Withdraw Request</a></li>
                <li><a class="<?php echo ($pageactive == 53) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/membership_transaction'; ?>">Subscription Transaction</a></li>
                <?php
                if (!isset($_SESSION['guet_yes']) || $_SESSION['guet_yes'] != "yes") {
                ?>
                    <li><a class="<?php echo ($pageactive == 54) ? 'active' : ''; ?>" style="background-color: #1f3060;" href="<?php echo $BaseUrl . '/dashboard/enterotp'; ?>">My Bank Details / My Card Details</a></li>
                <?php
                }
                ?>
            </ul>
        </li>
    </ul>
    <!--<h2>Privacy</h2>-->
    <ul>
        <!--  <li>
            <a class="<?php echo ($pageactive == 18) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/general'; ?>">General</a>
        </li> -->
        <!-- <li><a class="<?php echo ($pageactive == 4) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/sticky-pin'; ?>">Sticky Notes PIN</a></li> -->
        <li><a class="<?php echo ($pageactive == 35) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/moduleshow'; ?>">Show/Hide Menu</a></li>
    </ul>
    <!--<h2>Orders</h2>-->
    <!--   <ul>
        <li><a class="/<?php echo ($pageactive == 19) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/buyorder'; ?>*/">My Buying Order</a></li>
        <li><a class="<?php echo ($pageactive == 20) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/selorder'; ?>">My Selling Order</a></li>
    </ul>
    <h2>Complaint</h2>-->
    <ul>
        <li><a class="<?php echo ($pageactive == 21) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/flagcomplain'; ?>">My Flagged Complaints</a></li>
    </ul>
    <!--<h2>Bank Details</h2>
    <ul>
        <li><a class="<?php //echo ($pageactive == 22)?'active':'';
                        ?>" href="<?php echo $BaseUrl . '/dashboard/BankDetails'; ?>">My Bank Details</a></li>
        
    </ul>-->
    <!--<h2>Currency</h2>
    <ul>
        <li><a class="<?php //echo ($pageactive == 23)?'active':'';
                        ?>" href="<?php echo $BaseUrl . '/dashboard/currency'; ?>">Currency</a></li>
        
    </ul>-->
    <ul>
        <li><a class="<?php echo ($pageactive == 30) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/portfolio'; ?>">Portfolio</a></li>
    </ul>
    <ul>
        <li><a class="<?php echo ($pageactive == 200) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . $subLink; ?>">Subscription</a></li>
    </ul>
    <ul>
        <li><a class="<?php echo ($pageactive == 70) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/sppoint'; ?>">SP Points</a></li>
    </ul>
    <ul>
        <li><a class="<?php echo ($pageactive == 71) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/referral'; ?>">My Referrals</a></li>
    </ul>
    <ul>
        <li><a class="<?php echo ($pageactive == 72) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/commission'; ?>">My Commission</a></li>
    </ul>
    <ul>
        <li><a class="<?php echo ($pageactive == 73) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/purchase'; ?>">Customer Support Plans</a></li>
    </ul>
    <ul>
        <li><a class="<?php echo ($pageactive == 74) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/add_media'; ?>">Media Files</a></li>
    </ul>
    <ul>
        <li><a class="<?php echo ($pageactive == 85) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/friend_switch.php'; ?>">Friend Switch</a></li>
    </ul>
    <?php //if ($_SESSION['ptid'] == 1) { 
    ?>
    <ul>
        <!---<li><a class="<?php echo ($pageactive == 86) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/pos_subscription.php'; ?>">POS Subscription</a></li>--->
    </ul>
    <?php //} 
    ?>
    <!-- <ul>
        <li><a class="<?php echo ($pageactive == 85) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/mukesh.php'; ?>">mukesh crud</a></li>        
    </ul> -->
    <ul>
        <li><a class="<?php echo ($pageactive == 26) ? 'active' : ''; ?>" href="<?php echo $BaseUrl . '/dashboard/settings'; ?>">Settings</a></li>
    </ul>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    //  Parent click -> redirect
    const profileDropdown = document.getElementById('profileDropdownClick');
    if (profileDropdown) {
        profileDropdown.addEventListener('click', function() {
            location.href = '<?php echo $BaseUrl . '/my-profile'; ?>';
        });
    }

    // Child click -> open modal and prevent redirect
    const showBusiness = document.getElementById('show_business');
    if (showBusiness) {
        showBusiness.addEventListener('click', function(event) {
            event.stopPropagation(); // 👈 prevents the redirect
        });
    }

});
</script>