<?php

$common_url = "/grouptimelines/?groupid=$groupid&groupname=$groupname&timeline";

$left_menus = [
    [
        'name' => 'Timeline',
        'icon' => './images/timeline.svg',
        'link' => "$common_url&page=1",
        'role' => 'member',
        'count' => '', 
        'disable' => false 
    ],
    [
        'name' => 'Pending Timeline',
        'icon' => './images/pending-time-line.svg',
        'link' => "$common_url&page=pending-timeline",
        'role' => 'admin',
        'count' => "$pending_Timeline_count", 
        'disable' => false
    ],
    [
        'name' => 'Members',
        'icon' => './images/members.svg',
        'link' => "$common_url&page=members",
        'role' => 'admin',
        'count' => $activeCounter, 
        'disable' => false
    ], 
    [
        'name' => 'Pending Members',
        'icon' => './images/pending-members.svg',
        'link' => "$common_url&page=pending-members",
        'role' => 'admin',
        'count' => $pending_MemberCount, 
        'disable' => false 
    ],
    [
        'name' => 'Email campaign',
        'icon' => './images/email-compaign.svg',
        'link' => "$common_url&page=email-campaign",
        'role' => 'admin',
        'count' => '',
        'disable' => true 
    ],
    [
        'name' => 'Announcement',
        'icon' => './images/anocement.svg',
        'link' => "$common_url&page=announcement",
        'role' => 'member',
        'count' => $announcementCount, 
        'disable' => false
    ],
    [
        'name' => 'About',
        'icon' => './images/about.svg',
        'link' => "$common_url&page=about",
        'role' => 'member',
        'count' => '', 
        'disable' => false
    ],
    [
        'name' => 'Group Rules',
        'icon' => './images/group-rules.svg',
        'link' => "$common_url&page=group-rules",
        'role' => 'member',
        'count' => '', 
        'disable' => false
    ],
    [
        'name' => 'Setting',
        'icon' => './images/setting-2.svg',
        'link' => "$common_url&page=settings",
        'role' => 'admin',
        'count' => '', 
        'disable' => false
    ]
];

$inv = new _tableadapter("group_invitation");
$g = new _spgroup;
$gppid = $_SESSION['pid'];
$invitation =  $inv->read("WHERE receiver = $gppid and group_id= $group_id");
$invitationData = ($invitation) ? mysqli_fetch_assoc($invitation) : null;
$adminData = mysqli_fetch_assoc($g->readgroupAdmin($group_id));
?>

<?php 
if( in_array($role, ['owner','admin','asstadmin','member'])){ ?>
    <div class="explore-bar">
        <ul class="navigation">
            <?php                            
                foreach ($left_menus as $key) {
                    $link = (isset($key['disable']) && $key['disable']) ? "javascript:;void(0)" : $key['link'];
                    $style = (isset($key['disable']) && $key['disable']) ? "style='cursor: not-allowed;color: gray;'" : "";

                    if( $role == 'owner' || $role == 'admin' || $role == 'asstadmin'){
                        if( $key['role'] == 'member' || $key['role'] == 'admin'){
                        echo '
                            <li><a href="'. $link .'" '.$style.'>
                            <div class="link">
                                <div class="icon">
                                    <img src="'.$key['icon'].'" alt="">
                                </div>
                                <span>'.$key['name'].' '.$key['count'] .'</span>
                            </div>
                        </a></li>
                        ' ;
                        } else {
                        echo '';
                        }
                    }
                    else if ($role == 'member') {
                        if( $key['role'] == 'member'){
                            echo '
                                <li><a href="'. $link .'" '.$style.'>
                                <div class="link">
                                    <div class="icon">
                                        <img src="'.$key['icon'].'" alt="">
                                    </div>
                                    <span>'.$key['name'].' '.$key['count'] .'</span>
                                </div>
                            </a></li>
                            ' ;
                        }

                    } 
                }
            ?>                    
        </ul>
    </div>
<?php } ?>

<?php
if(is_null($invitationData)) { ?>
    <div class="explore-bar explore-bar-access">
        <!-- new member join request / cancel request / leave group -->
        <div class="join-btn" style="display:none;" data-bs-toggle="modal" data-bs-target="#join-group">
            <img src="./images/add-4.svg" alt=""> 
            <span> Join Group </span>
        </div>

        <div class="cancel-btn" style="display:none;" data-bs-toggle="modal" data-bs-target="#cancel-group">
            <img src="./images/disabled.svg" alt="">  
            <span> Cancel Request</span>
        </div>

        <!-- <div class="exit-btn" style="display:none;" data-bs-toggle="modal" data-bs-target="#exit-group">
            <img src="./images/door-exit.svg" alt="">
            <span>Leave Group</span>
        </div> -->
    </div>
<?php } ?>

<?php
if($invitationData && $invitationData['invitation_status'] == 0) { ?> 
    <div class="explore-bar">
        <h6 class="text-center">Invited By <a href="/friends/?profileid=<?= $adminData['idspProfiles'] ?>"><?= $adminData['spProfileName'] ?> (Admin)</a></h6>
        <style>
            .invite-btn {
                width: calc(100% - 30px);
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 10px;
                margin: 10px 0px;
                margin-left: 15px;
                height: 32px;
                color: white;
                border-radius: 75px;
                background-color: #7649b3;
                font-size: 14px;
                cursor: pointer;
            }
        </style>
        <div class="accept-invitation-btn invite-btn" style="background-color:#fb8308;" data-id="<?= $invitationData['id']; ?>">
            <img src="./images/add-4.svg" alt=""> 
            <span> Accept Invitation </span>
        </div>

        <div class="reject-invitation-btn invite-btn" style="background-color:#fb8308;" data-id="<?= $invitationData['id']; ?>">
            <img src="./images/disabled.svg" alt="">  
            <span> Reject Invitation</span>
        </div>
    </div>
<?php } ?>
    
<!-- new member join request / cancel request / leave group end -->