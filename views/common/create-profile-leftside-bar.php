<?php
require_once "../classes/Timeline.php";
$t = new Timeline;
?>
<style>
    .profile.selected {
        background-color: rgba(253, 139, 21, 0.78) !important; /* Light Orange */
        border-radius: 8px !important;
        padding: 8px !important;
        transition: background-color 0.3s !important; /* smooth animation */
    }
    .profile:hover {
        background-color: #fff3e0 !important;
        border-radius: 8px !important;
    }

</style>

<div class="left-bar">
    <div class="heading">
        My Profiles
    </div>
    <div class="left-bar-wrapper">
        <div class="profiles">
            <?php
            $profiles = $pt->readProfiles($_SESSION["uid"]);
            if (isset($profiles['data']) && count($profiles['data']) > 0) {
                foreach ($profiles['data'] as $pro) {
                    $sprecord =  $pt->getProfileStatus($pro['idspProfiles'] , $_SESSION["uid"]);
                    //   $sprecord = "select * from spbuiseness_files where sp_pid='".$pro['idspProfiles']."' and sp_uid='".$_SESSION["uid"]."' order by id desc limit 1 ";
                        // $allrecord = mysqli_query($dbConn, $sprecord);
                        // $spresult = mysqli_fetch_array($allrecord);
                    //    echo "<pre>"; print_r($sprecord[0]['status']); echo "</pre>";
                    ?>
                    <div class="profile <?php if ($_SESSION['pid'] == $pro['idspProfiles']) echo 'selected'; ?>"
                         style="cursor:pointer; display: flex; align-items: center; margin-bottom: 10px;"
                         onclick="profilechange(<?php echo $pro['idspProfiles']; ?>, 1)">
                        <div class="img-wrapper" style="margin-right: 15px;">
                            <?php if ($pro["spProfilePic"] == '') { ?>
                                <img src="<?php echo $BaseUrl . '/assets/images/icon/blank-img.png' ?>" alt="" style="height:40px; width: 40px !important;
        /*height: 40px !important;*/
        object-fit: cover !important;
        border-radius: 50% !important;">
                            <?php } else { ?>
                                <img src="<?php echo $pro["spProfilePic"]; ?>" class="img-fluid" alt="" style=" width: 40px !important;
        /*height: 40px !important;*/
        object-fit: cover !important;
        border-radius: 50% !important;">
                            <?php } ?>
                        </div>
                        <div class="detail">
                            <div class="name"><?php echo ucwords(substr($pro['spProfileName'], 0, 15)); ?></div>
                            <div class="title"><?php 
                            echo $pro['spProfileTypeName'] . " Profile"; 
                            // Condition for tick or "Verify Now"
                            if ($pro['spProfileType_idspProfileType'] == 1 && isset($sprecord[0]) && $sprecord[0]['status'] == 2) {
                                echo '<img src="'.$BaseUrl.'/assets/images/icon/green-tick.png" alt="Verified" style="width:20px; height:20px; margin-left:5px;">';
                            }
                            ?></div>
                        </div>
                    </div>
                    <?php
                } // <-- this closes foreach properly
            }
            ?>
        </div> <!-- closing profiles -->

        <a href="<?php echo $BaseUrl.'/my-profile/newprofile.php' ?>">
            <div class="create-btn">
                <img src="../assets/images/add.svg" alt="">
                ADD NEW PROFILE
            </div>
        </a>

        <div class="referal-code">
            <div class="referal">
                <?php
                $userInfo = $t->UserInfo($_SESSION['pid']);
                ?>
                <div class="title">Referral Code:</div>
                <div class="code"><?php if($userInfo['data']['userrefferalcode']) { echo $userInfo['data']['userrefferalcode']; } ?></div>
                <div id="refferalcodeurl" style="display:none"><?php if($userInfo['data']['userrefferalcode']) { echo $BaseUrl."/sign-up.php?rfrcode=".$userInfo['data']['userrefferalcode']; } ?></div>
            </div>
            <img id="copyButton" style="cursor: pointer;" src="../assets/images/copy-icon.svg" alt="">
        </div>

    </div> <!-- closing left-bar-wrapper -->
</div> <!-- closing left-bar -->
