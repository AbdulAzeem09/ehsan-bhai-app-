<?php

function generate_user_div($row){
    $BaseUrl = $GLOBALS['BaseUrl'];
    $profilename = $row['spProfileName'];
    $profileid = $row['idspProfiles'];
    $profile_type = $row['profile_type'];
    $profile_pic = isset($row['spProfilePic']) ? $row['spProfilePic'] :  $BaseUrl."/assets/images/icon/blank-img.png";
    
    $div = '<div class="friend">
            <div class="img-wrapper">
                <a href="#" class="view_prof" data-prof="'.$profileid.'"><img src="'.$profile_pic.'" alt=""></a>
            </div>
            <div class="detail">
                <div class="name view_prof" data-prof="'.$profileid.'">'.$profilename.'
                <span class="mutual">('.$profile_type.')</span>
                </div>
                <div class="mutual">Connects (0)</div>
            </div>
            <div class="icons">
                <div class="three-dot">
                    <img src="./images/three-dot-3.svg" alt="" class="option-icon" onclick="threeDot(this)">
                    <div class="more-links" style="display: none; width: 160px;">
                        <div id="acp_'.$profileid.'" class="link acpt_rqst" data-prof="'.$profileid.'">
                            <span class="img">
                                <img src="./images/add-friend.svg" alt="">
                            </span>
                            <span>Accept</span>
                        </div>
                        <div id="rjt_'.$profileid.'" class="link rejct_rqst" data-prof="'.$profileid.'" >
                            <span class="img">
                                <img src="./images/block.svg" alt="">
                            </span>
                            <span>Reject</span>
                        </div>
                        <div id="vwp_'.$profileid.'" class="link view_prof" data-prof="'.$profileid.'">
                            <span class="img">
                                <img src="./images/view.svg" alt="">
                            </span>
                            <span>Profile</span>
                        </div>
                    </div>
                </div>
                <div class="message">
                    <img src="./images/message-2.svg" alt="" class="option-icon">
                </div>

            </div>
        </div>';
    return $div;
}
?>

<div class="members">
    <div class="main-heading">
        <div class="top-heading">
            Pending Members
        </div>
    </div>

    <div class="friend-list-wrapper">
        <?php
            if ($pending_MemberCount != '') {
                $i = 0;
                while ($row = mysqli_fetch_assoc($getPendingMembers)) {
                    echo generate_user_div($row);
                }
            }else{
                echo "No member found!";
            }
        ?>
                                        
    </div>
</div>

