<?php

function generate_allmember_div($row){
    $BaseUrl = $GLOBALS['BaseUrl'];
    $profilename = $row['spProfileName'];
    $profileid = $row['idspProfiles'];
    $profile_type = $row['profile_type'];
    $profile_pic = isset($row['spProfilePic']) ? $row['spProfilePic'] :  $BaseUrl."/assets/images/icon/blank-img.png";
    $groupOwnerId = $row['groupOwnerId'];
    $fstatus = checkMemberIsFriend($profileid);
    $actions = '';
    if($fstatus == "connect"){
        $actions = '<div id="conct_'.$profileid.'" class="link add_conct" data-prof="'.$profileid.'">
                <span class="img">
                    <img src="./images/add-friend.svg" alt="">
                </span>
                <span>Connect</span>
            </div>';
    }
    
    $moreactions = '';
    
    if($row['isAsstAdmin'] == 0 || ($groupOwnerId != $profileid && $row['isAsstAdmin'] == 0)){
        $moreactions .= '<div id="astadm_'.$profileid.'" class="link add_asstadm" data-prof="'.$profileid.'">
                    <span class="img">
                        <img src="./images/diamonds.svg" alt="">
                    </span>
                    <span>Assign as Asst Admin</span>
                </div>
                ';
    }

    if($groupOwnerId != $profileid && $row['isAsstAdmin'] == 1){
        $moreactions .= '<div id="astadm_'.$profileid.'" class="link rmv_asstadm" data-prof="'.$profileid.'">
                    <span class="img">
                        <img src="./images/diamonds.svg" alt="">
                    </span>
                    <span>Remove from Asst Admin</span>
                </div>
                ';
    }

    if($groupOwnerId != $profileid){
        $moreactions .='<div id="blk_'.$profileid.'" class="link blk_prof" data-prof="'.$profileid.'">
                    <span class="img">
                        <img src="./images/block.svg" alt="">
                    </span>
                    <span>Block</span>
                </div>
                <div id="rmv_'.$profileid.'" class="link rmv_prof" data-prof="'.$profileid.'">
                    <span class="img">
                        <img src="./images/remove.svg" alt="">
                    </span>
                    <span>Remove</span>
                </div>';
    }


    if($groupOwnerId != $profileid && $groupOwnerId == $_SESSION['pid']){
        $actions .= $moreactions;
    }elseif($row['isAsstAdmin'] == 1 || ($row['isAsstAdmin'] == 0 && $groupOwnerId != $profileid)){
        $actions .= $moreactions;
    }

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
                            '.$actions.'
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
        if ($activeCounter !='') {
            foreach($getActiveMembers as $key => $row)
            {
                // echo "<pre>"; print_r($row);
                echo generate_allmember_div($row);                         
            }
        } else {
            echo "No Members.";
        }
    ?>                        
</div>

