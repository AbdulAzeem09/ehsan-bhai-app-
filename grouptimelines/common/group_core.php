<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'Off');

if(!defined(access_type) && access_type!=='via_grouptimeline')
	die('direct access denied');

function gid_pid(){
  echo "data-pid='".$_SESSION['pid']."' data-gid='".$GLOBALS['groupid']."'";
};

//load _spprofiles.class
$prf = new _spprofiles;
//member ownership check
$grp = new _spgroup;

//group_owner
$res = $grp->group_owner($groupid);
if ($res) {
  $row = mysqli_fetch_assoc($res);
}

$gowner = $g_personal_profile = null;
if(!empty($row['spProfiles_idspProfiles'])){
  $pres = $prf->read($row['spProfiles_idspProfiles']);
  $gowner = ($pres) ?  mysqli_fetch_assoc($pres) : null;
}

if($gowner){
  $gpres = $prf->getMasterProfileData($gowner['spUser_idspUser'], 4);
  $g_personal_profile = ($gpres) ?  mysqli_fetch_assoc($gpres) : null;
}

// 0 or empty  = no owner (which is wrong)
$group_owner = (!empty($row['spProfiles_idspProfiles']))  ? $row['spProfiles_idspProfiles'] : 0;

$role = check_membership($grp,$groupid,$group_owner,'nomember');
$_SESSION['member_type'] = $role; // required in Timeline.php

function check_membership($grp, $groupid, $group_owner, $member_type){
  if($_SESSION['pid'] == $group_owner){
    $member_type = 'owner';
    return $member_type;
  }
  
  $adm = $grp->isGroupAdmin($_SESSION['pid'],$groupid); 
  $ast_adm = $grp->checkSubadmin($groupid,$_SESSION['pid']);
  $membr = $grp->ismember($groupid,$_SESSION['pid']);
  $reqst_sts = $grp->checkRequestStatus($groupid,$_SESSION['pid']);  
  $is_blocked = $grp->is_blockedMember($groupid,$_SESSION['pid']);
  $is_rejected = $grp->is_rejectedMember($groupid,$_SESSION['pid']);

  if($adm != false)
  {   
    $member_type='admin';    
  }
  else if($ast_adm != false) {
    $member_type='asstadmin';  
  }
  else if($membr != false) {
    $member_type='member';  
  }
  else if($reqst_sts != false) {
    $member_type='pending';  
  }
  else if($is_blocked != false) {
      $member_type='blocked';  
  }
  else if($is_rejected != false) {
    $member_type='rejected';  
  }
  return $member_type;
}

//member ownership check end

//group_type
$res = $grp->get_spflage($groupid);
$group_banner_image = '';
$group_logo_image = '';
$group_row_data = null;
if ($res) {
  $group_row_data = $row = mysqli_fetch_assoc($res);
  if(!empty($row['spgroupimage'])){
    $group_banner_image = $BaseUrl.'/uploadimage/'.$row['spgroupimage'];
  }

  if(!empty($row['spgrouplogo'])){
    $group_logo_image = $BaseUrl.'/uploadimage/'.$row['spgrouplogo'];
  } 
}

if ($row['spgroupflag'] == 1) {
  $group_type =  '<img src="./images/lock.svg" alt=""> <span>Private Group</span>';
  $grouptype =  'Private';
} else {
  $group_type = '<img src="./images/global.svg" alt=""> <span>Public Group</span>';
  $grouptype = 'Public';
} 
  
//group_type end


// all member type
$activeCounter = '';
$total_member_count = '';
$getActiveMembers = $grp->joinedMembersOfGroup($groupid);
if ($getActiveMembers != false) {
  $activeCounter = $total_member_count = mysqli_num_rows($getActiveMembers);
  $activeCounter = ($activeCounter > 0) ? '('.$activeCounter.')':'(0)';
} 
// all member type end 

$announcementCount = '(0)';
$announcements = $grp->getGroupAnnouncements($groupid, $role);
if($announcements != false){
  $announcementCount = '('.mysqli_num_rows($announcements).')';
}

//pending members  [for both count and details]
$pending_MemberCount='';
$getPendingMembers = $grp->group_members_pending($groupid);
if ($getPendingMembers != false) {
  $pending_MemberCount = mysqli_num_rows($getPendingMembers);	  
  $pending_MemberCount = ($pending_MemberCount > 0) ? '('.$pending_MemberCount.')':'(0)';
}
//pending members end  


// all admin member type
$getAllAdminMembersCount='';
$getAllAdminMembers = $grp->readgroupAdmin($groupid);
if ($getAllAdminMembers != false) {
  $getAllAdminMembersCount = mysqli_num_rows($getAllAdminMembers);   
  $getAllAdminMembersCount = ($getAllAdminMembersCount > 0) ? '('.$getAllAdminMembersCount.')':'(0)';
}  
// all admin member type end

// all asst admin member type
$getAllAsstAdminMembersCount='';
$getAllAsstAdminMembers = $grp->readgroupAsstAdmin($groupid);  
if ($getAllAsstAdminMembers != false) {
  $getAllAsstAdminMembersCount = mysqli_num_rows($getAllAsstAdminMembers); 
  $getAllAsstAdminMembersCount = ($getAllAsstAdminMembersCount > 0) ? '('.$getAllAsstAdminMembersCount.')':'(0)';    
}  
// all asst admin member type end

// all rejected member type
$getRejectedMembersCount='';
$getRejectedMembers = $grp->rejectedMembersOfGroup($groupid);  
if ($getRejectedMembers != false) {
  $getRejectedMembersCount = mysqli_num_rows($getRejectedMembers); 
  $getRejectedMembersCount = ($getRejectedMembersCount > 0) ? '('.$getRejectedMembersCount.')':'(0)';   
}  
// all rejected member type end

  
// all blocked member type
$getBlockedMembersCount='';
$getBlockedMembers = $grp->blockedMembersOfGroup($groupid);  
if ($getBlockedMembers != false) {
  $getBlockedMembersCount = mysqli_num_rows($getBlockedMembers); 
  $getBlockedMembersCount = ($getBlockedMembersCount > 0) ? '('.$getBlockedMembersCount.')':'(0)';
  
}  
// all blocked member type end

// pending timeline count
$pending_Timeline_count = '';
$PTC = $grp->group_pending_timelines_count($groupid);

if ($PTC) {
  $pending_Timeline_count = mysqli_fetch_assoc($PTC)['total']; 
  $pending_Timeline_count = ($pending_Timeline_count > 0) ? '('.$pending_Timeline_count.')':'(0)';
  
}  
// pending timeline count end
  

// get group about

$res = $grp->get_group_about($groupid);
if ($res) {
  $abt = mysqli_fetch_assoc($res);
}

// get group about end


function checkMemberIsFriend($mpid){
  $p = new _spprofiles;
  $rpvt = $p->readProfiles($_SESSION["uid"]);
  $user_profiles_list = array();
  if ($rpvt != false) {
    while ($row = mysqli_fetch_assoc($rpvt)) {
      array_push($user_profiles_list, $mpid);
    }
  }

  $profileObject = new _spprofilehasprofile;
  $isAlreadyFriend = $profileObject->checkfriend($_SESSION["pid"], $mpid);
  if ($isAlreadyFriend != false) {
      $checkRow = mysqli_fetch_assoc($isAlreadyFriend);
      $requestFlag = $checkRow["spProfiles_has_spProfileFlag"];
  }else{
    $requestFlag = false;
  }

  if (($isAlreadyFriend == false && !in_array($mpid, $user_profiles_list, TRUE)) || ($isAlreadyFriend != false && $requestFlag == -1 && in_array($mpid, $user_profiles_list, TRUE))) {
    return 'connect';
  }elseif(!in_array($mpid, $user_profiles_list, TRUE) && ($requestFlag == 0 || $requestFlag == NULL)){
    return 'requested';
  }else{
    return 'friend';
  }
}
?>