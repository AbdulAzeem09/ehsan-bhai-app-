<?php

function generate_blocked_member_div($row){
    $BaseUrl = $GLOBALS['BaseUrl'];
    $profilename = $row['spProfileName'];
    $profileid = $row['idspProfiles'];
    $profile_type = $row['profile_type'];
    $profile_pic = isset($row['spProfilePic']) ? $row['spProfilePic'] :  $BaseUrl."/assets/images/icon/blank-img.png";
    $fstatus = checkMemberIsFriend($profileid);
    $connect = ($fstatus == "connect") ? '<div id="conct_'.$profileid.'" class="link add_conct" data-prof="'.$profileid.'">
                        <span class="img">
                            <img src="./images/add-friend.svg" alt="">
                        </span>
                        <span>Connect</span>
                    </div>' : '';

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
                <div class="more-links" id="three-dot" style="display: none;">
                    '.$connect.'
                    <div id="astadm_'.$profileid.'" class="link add_asstadm" data-prof="'.$profileid.'">
                        <span class="img">
                            <img src="./images/diamonds.svg" alt="">
                        </span>
                        <span>Assign as Asst Admin</span>
                    </div>
                    <div id="blk_'.$profileid.'" class="link unblk_prof" data-prof="'.$profileid.'">
                        <span class="img">
                            <img src="./images/block.svg" alt="">
                        </span>
                        <span>Remove Block</span>
                    </div>
                    <div id="rmv_'.$profileid.'" class="link rmv_prof" data-prof="'.$profileid.'">
                        <span class="img">
                            <img src="./images/remove.svg" alt="">
                        </span>
                        <span>Remove</span>
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


 <div class="friend-list-wrapper">
        <?php                
          
            if ( $getBlockedMembersCount !='')  {                   
                while ($row = mysqli_fetch_assoc($getBlockedMembers)) {
                    echo generate_blocked_member_div($row);
                    
                }
             }
             else { echo "No Blocked Members."; }

        ?>                        
                    </div>