<?php 
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');
*/
session_start();
include('../../univ/baseurl.php');
include('../../common.php');
include('../../classes/Base.php');
include('../../classes/PublicView.php');
function sp_autoloader($class)
{
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$grp = new _spgroup;
$pvw = new PublicView;

function checkIsAllowed($gid){
  $g = new _spgroup;
  $lpid = $_SESSION['pid'] ?? null;
  if(is_null($lpid)){
    return false;
  }

  if($lpid){
    $checkaccess = $g->get_group_details($lpid, $gid);
    if($checkaccess != false){
      $checkdata = mysqli_fetch_assoc($checkaccess);
      if($checkdata['spApproveRegect'] == 1 && ($checkdata['spProfileIsAdmin'] == 1)){
        //access allowed        
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }
}

//accept request
if (isset($_POST["accpt_rqst"]) && $_POST["accpt_rqst"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    $res = $grp->acceptrequest($gid, $pid);
    if($res > 0){
      $personal_profile = $grp->getGroupPersonalProfileWithGroup($gid, $pid);
      if($personal_profile && !empty($personal_profile['spProfileEmail'])){
        $email = new _email;
        $message = "<p>We have accepted your Group Join Reqeust for group ".$personal_profile['group_name'].".</p>";
        $email->sendCommonMail($personal_profile['spProfileName'], $personal_profile['spProfileEmail'], 'Group Join Request Accepted',$message);
      }
      echo json_encode(array('status'=>'accpet_request', 'message'=>"Members request accepted"));
    }
    else{
      echo json_encode(array('status'=>'member_exist', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
     echo json_encode(array('status'=>'accpet_failed', 'message'=>'error'));
  }
}
//accept request end

//reject request
if (isset($_POST["rjct_rqst"]) && $_POST["rjct_rqst"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    $res = $grp->rejectrequest($gid, $pid);
    if($res > 0){
      $personal_profile = $grp->getGroupPersonalProfileWithGroup($gid, $pid);
      if($personal_profile && !empty($personal_profile['spProfileEmail'])){
        $email = new _email;
        $message = "<p>We have rejected your Group Join Reqeust for group ".$personal_profile['group_name'].".</p>";
        $email->sendCommonMail($personal_profile['spProfileName'], $personal_profile['spProfileEmail'], 'Group Join Request Rejected',$message);
      }
      echo json_encode(array('status'=>'reject_request', 'message'=>"Members request rejected"));
    }
    else{
      echo json_encode(array('status'=>'member_issue', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
     echo json_encode(array('status'=>'reject_failed', 'message'=>'error'));
  }
}
//reject request end

//add user to connect
if (isset($_POST["add_conct"]) && $_POST["add_conct"]== true ) {
  try {
  $gid = $_POST["grpid"];
  $pid = $_POST["profid"];
  $res = $grp->rejectrequest($gid, $pid);   
    if($res > 0){
      echo json_encode(array('status'=>'add_connect', 'message'=>"Request send to connect"));
    }
    else{
      echo json_encode(array('status'=>'member_issue', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'connect_failed', 'message'=>'error'));
  }
}
//add user to connect end

//add user as asst admin
if (isset($_POST["add_asstadm"]) && $_POST["add_asstadm"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    $res = $grp->makeAssistant($pid, $gid);
    if($res > 0){
      echo json_encode(array('status'=>'add_asstadm', 'message'=>"Member added to Asst. Admin"));
    }
    else{
      echo json_encode(array('status'=>'member_issue', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'asstadm_failed', 'message'=>'error'));
  }
}
//add user as asst admin end

//remove user as asst admin
if (isset($_POST["rmv_asstadm"]) && $_POST["rmv_asstadm"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    if(checkIsAllowed($gid) == false){
      echo json_encode(array('status'=>'asstadm_failed', 'message'=>"You are not allowed to remove Asst. admin"));
      die();
    }
    $res = $grp->removeAssistant($pid, $gid);
    if($res > 0){
      echo json_encode(array('status'=>'rmv_asstadm', 'message'=>"Member removed from Asst. Admin"));
    }
    else{
      echo json_encode(array('status'=>'member_issue', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'asstadm_failed', 'message'=>'error'));
  }
}
//remove user as asst admin end

//add user as admin
if (isset($_POST["add_adm"]) && $_POST["add_adm"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    $res = $grp->setGroupAdmin($pid, $gid);
    if($res > 0){
      echo json_encode(array('status'=>'add_adm', 'message'=>"Member added to Admin"));
    }
    else{
      echo json_encode(array('status'=>'member_issue', 'message'=>"Data Mismatch"));
    }

  } catch (Exception $e) {
     echo json_encode(array('status'=>'adm_failed', 'message'=>'error'));
  }
}
//add user as admin end

//remove user as admin
if (isset($_POST["rmv_adm"]) && $_POST["rmv_adm"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    $res = $grp->removeGroupAdmin($pid, $gid);
    if($res > 0){
      echo json_encode(array('status'=>'rmv_adm', 'message'=>"Member removed from Admin"));
    }
    else{
      echo json_encode(array('status'=>'member_issue', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'adm_failed', 'message'=>'error'));
  }
}
//remove user as admin end


//block user 
if (isset($_POST["blk_prof"]) && $_POST["blk_prof"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    if(checkIsAllowed($gid) == false){
      echo json_encode(array('status'=>'block_failed', 'message'=>"You are not allowed to block member."));
      die();
    }

    $res = $grp->blockMember($gid, $pid);
    if($res > 0){
      echo json_encode(array('status'=>'blk_prof', 'message'=>"Member is blocked"));
    }
    else{
      echo json_encode(array('status'=>'member_block', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
     echo json_encode(array('status'=>'block_failed', 'message'=>'error'));
  }
}
//block user end

// unblock user 
if (isset($_POST["unblk_prof"]) && $_POST["unblk_prof"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    $res = $grp->unblockMember($gid, $pid);
    if($res > 0){
      echo json_encode(array('status'=>'unblk_prof', 'message'=>"Member is unblocked"));
    }
    else{
      echo json_encode(array('status'=>'member_block', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'block_failed', 'message'=>'error'));
  }
}
// unblock user end

// approve user 
if (isset($_POST["apv_prof"]) && $_POST["apv_prof"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];
    $res = $grp->unblockMember($gid, $pid);
    if($res > 0){
      echo json_encode(array('status'=>'apv_prof', 'message'=>"Member is approved"));
    }
    else{
      echo json_encode(array('status'=>'member_block', 'message'=>"Data Mismatch"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'block_failed', 'message'=>'error'));
  }
}
// approve user end

//remove user 
if (isset($_POST["rmv_prof"]) && $_POST["rmv_prof"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["profid"];    
    $type = $_POST["type"] ?? "owner";

    if($type == "owner" && checkIsAllowed($gid) == false){
      echo json_encode(array('status'=>'remove_failed', 'message'=>"You are not allowed to remove member."));
      die();
    }

    $res = $grp->removeMember($pid, $gid);  
    if($res){
      $personal_profile = $grp->getGroupPersonalProfileWithGroup($gid);
      if($personal_profile && !empty($personal_profile['spProfileEmail'])){
        $email = new _email;
        $pprofile = $grp->getGroupPersonalProfileWithGroup($gid, $pid);
        $message = "<p>Member ".$pprofile['spProfileName']." has been cancelled/exit Group Join Reqeust for ".$personal_profile['group_name']."</p> 
        <a href='".$BaseUrl."/grouptimelines/?groupid=".$gid."&groupname=".$personal_profile['group_name']."&timeline&page=1'>View Group</a>
        ";
        $email->sendCommonMail($personal_profile['spProfileName'], $personal_profile['spProfileEmail'], 'Group Cancellation Request',$message);
      } 
      echo json_encode(array('status'=>'rmv_prof', 'message'=>"Removed from group successfully."));
    }
    else{
      echo json_encode(array('status'=>'remove_failed', 'message'=>"Member not found."));
    }
  } catch (Exception $e) {
     echo json_encode(array('status'=>'remove_failed', 'message'=>'Something went wrong.'));
  }
}
//remove user end

//accept pending post
if (isset($_POST["accpt_post"]) && $_POST["accpt_post"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["postid"];
    $res = $grp->acceptPost($pid, $gid);      
    if( $res > 0){
      echo json_encode(array('status'=>'accpt_post', 'message'=>"Post is accepted"));
    }
    else{
      echo json_encode(array('status'=>'accpt_error', 'message'=>"Action has error"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'error'));
  }
}
//accept pending post end

//reject pending post
if (isset($_POST["reject_post"]) && $_POST["reject_post"]== true ) {
  try {
    $gid = $_POST["grpid"];
    $pid = $_POST["postid"];
    $res = $grp->rejectPost($pid, $gid); 
    if( $res > 0){
      echo json_encode(array('status'=>'reject_post', 'message'=>"Post is rejected"));
    }
    else{
      echo json_encode(array('status'=>'reject_error', 'message'=>"Action has error"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'error'));
  }
}
//reject pending post end

//check connection
if (isset($_POST["check_connect"]) && $_POST["check_connect"]== true ) {
  try {
    $sender = $_POST["sender"];
    $receiver = $_POST["receiver"];
    $res = $pvw->checkFriendGroup($sender, $receiver);      
    if( $res == 1 ){
      echo json_encode(array('status'=>'connected', 'message'=>"Connected"));
    }
    else{
      echo json_encode(array('status'=>'connect_error', 'message'=>"Connect error"));
    }
  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'error'));
  }
}
//check connection end

//invite search
if (isset($_POST["invite_srch"]) && $_POST["invite_srch"]== true ) {
  try {
    $txt = $_POST["srch"];
    $gid = $_POST["group"];    
    $res = $grp->srchProfile($txt, $gid);
    if($res && mysqli_num_rows($res) > 0 ){
      $data = mysqli_fetch_all($res,MYSQLI_ASSOC);
      foreach($data as $key => $item){
        $inv = new _tableadapter("group_invitation");
        $pid = $item['pid'];
        $data[$key]['invitation_status'] = $data[$key]['group_id'] = null;
        $res2 =  $inv->read("WHERE receiver = $pid and group_id= $gid");
        if($res2 != false){
          $inv_data = mysqli_fetch_assoc($res2);
          $data[$key]['invitation_status'] = $inv_data['invitation_status'];
          $data[$key]['group_id'] = $inv_data['group_id'];
        }
        $data[$key]['ptype'] = $data[$key]['ptype'] ?? "NA";
      }
      echo json_encode( array('status'=>'invite_srch', 'data'=> $data) );
    }
    else{
      echo json_encode(array('status'=>'search_error', 'message'=>"No member found."));
    }
  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'Something went wrong. Please try again.'));
  }
}

//invite search end

//invite user
if (isset($_POST["invite_user"]) && $_POST["invite_user"] == true ) {
  try {
    $sender = $_POST["sender"];
    $groupid = $_POST["groupid"];
    if(checkIsAllowed($groupid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to invite member."));
      die();
    }

    $invite_user = $_POST["invite_user"]; 
    $invitees = (!empty($_POST["invitees"])) ? explode(',', $_POST["invitees"]) : []; 
    $res = $grp->invite_toGroup($invitees, $sender, $groupid); 
    if( $res != ''){
      echo json_encode( array('status'=>'invite_user', 'data'=>$res));
    }
    else{
      echo json_encode(array('status'=>'invite_error', 'message'=>"Could not invite"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status' => 'error', 'message' => 'Something went wrong. Please try again.'. $invitees));
  }
}
//invite user end


//accept grp invitation
if (isset($_POST["action_grp_invitation"]) && $_POST["action_grp_invitation"]== true ) {
  try {
    $inv_id = $_POST["id"];
    $action = strtolower(trim($_POST["action"]));
    $res = $grp->action_grp_invitation($inv_id, $action); 
    if( $res > 0  ){       
      echo json_encode( array('status'=>'action_grp_invitation', 'data' => $action, 'message' => 'Thank for accept the invitation.'));
    }
    else{
      echo json_encode(array('status'=>'action_error', 'message'=>"Action failed"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'catch error'));
  }
}

//accept grp invitation end


//grp name about update
if (isset($_POST["abt_upd"]) && $_POST["abt_upd"]== true ) {
  try {
    $grpid = $_POST["grpid"];
    if(checkIsAllowed($grpid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to update group settings."));
      die();
    }

    $grpabt = $_POST["grpabt"];
    $data['spGroupAbout'] = $grpabt;
    $res = $grp->updategroupUG($data, $grpid);
    if( $res  ){       
      echo json_encode( array('status'=>'abt_upd', 'data'=>'Group data updated'));
    }
    else{
      echo json_encode(array('status'=>'update_error', 'message'=>"About update failed"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'catch error'));
  }
}

if (isset($_POST["publish_group"]) && $_POST["publish_group"]== true ) {
  try {
    $gid = $_POST["id"];
    $type = $_POST["type"];
    if($type == "active"){
      $active_groups_count = $grp->getMemberLiveGroups($_SESSION['pid']);
      if($active_groups_count > 20){
          echo json_encode(array('status'=>'update_error', 'message' => "You can not publish more then 20 groups."));die();
      }
    }

    if(checkIsAllowed($gid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to update group settings."));
      die();
    }

    $data['status'] = $type;
    $message = ($type == "active") ? "Group has been successfully published" : "Group has been successfully drafted";
    $res = $grp->updategroupUG($data, $gid);
    if( $res  ){       
      echo json_encode( array('status'=>'publish_group', 'message'=> $message));
    }
    else{
      echo json_encode(array('status'=>'update_error', 'message'=>"Group published failed"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'catch error'));
  }
}

//grp name about update end

//grp rule update
if (isset($_POST["rule_upd"]) && $_POST["rule_upd"]== true ) {
  try {
    $grpid = $_POST["grpid"];
    if(checkIsAllowed($grpid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to update group rules."));
      die();
    }
    $grprule = $_POST["grprule"];
    $grpruletitle = $_POST["grpruletitle"];
    $res = $grp->rule_upd($grpid, $grprule, $grpruletitle); 
    if( $res  ){       
      echo json_encode( array('status'=>'rule_upd', 'data'=>'Group rule updated'));
    }
    else{
      echo json_encode(array('status'=>'update_error', 'message'=>"About update failed"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'catch error'));
  }
}
//grp rule update end

//grp privacy update
if (isset($_POST["grp_privacy"]) && $_POST["grp_privacy"]== true ) {
  try {
    $grpid = $_POST["grpid"];
    $grp_type = $_POST["grp_type"]; 
    $res = $grp->grp_privacy_upd($grpid, $grp_type); 
    if( $res  ){       
      echo json_encode( array('status'=>'grp_privacy', 'data'=>'Group privacy updated'));
    }
    else{
      echo json_encode(array('status'=>'update_error', 'message'=>"Privacy update failed"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'catch error'));
  }
}
//grp privacy update end

//grp location update
if (isset($_POST["grp_location_upd"]) && $_POST["grp_location_upd"]== true ) {
  try {
    $gid = $_POST["grpid"];
    if(checkIsAllowed($gid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to update group location."));
      die();
    }
    $data['spUserCountry'] = $_POST['grcountry'];
    $data['spUserState'] = $_POST['grstate'];
    $data['spUserCity'] = $_POST['grcity'];
    $data['spgroupLocation'] = getLocation($data['spUserCountry'], $data['spUserState'], $data['spUserCity']);
    $res = $grp->updategroupUG($data, $gid);    
    if( $res  ){       
      echo json_encode( array('status'=>'grp_location_upd', 'message'=>'Group location has been successfully updated'));
    }
    else{
      echo json_encode(array('status'=>'error', 'message'=>"Group location update failed"));
    }
  } catch (Exception $e) {
    echo json_encode(array('status'=>'error', 'message'=>'Someting went wrong. Please try again.'));
  }
}
//grp location update end


// Function to handle image upload
//update group image
if(isset($_POST["editGrouopImage"]) && $_POST["editGrouopImage"] == 'yes' ){
  $gid = $_POST['groupid'];
  if(checkIsAllowed($gid) == false){
    echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to update group image."));
    die();
  }

  if(isset($_FILES['spgroupimage'])) {
    // Continue with image upload process
    $file = $_FILES['spgroupimage'];
    // Specify the directory to move the uploaded file
    $uploadDirectory = '../../uploadimage/';
    // Get file extension
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    // Define allowed file extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    // Check if file extension is valid
    if(in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique file name to avoid overwriting
        $newFileName = uniqid('image_', true) . '.' . $fileExtension;
        // Set the target path for the uploaded file
        $targetPath = $uploadDirectory . $newFileName;
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
          $res = $grp->get_spflage($_POST['groupid']);
          if ($res) {
            $row = mysqli_fetch_assoc($res);
            if(!empty($row['spgroupimage'])){
              $oldFile = '../../uploadimage/'.$row['spgroupimage'];
              if(file_exists($oldFile)){
                @unlink($oldFile);
              }
            }
          }

          $imagePath = $BaseUrl.'/uploadimage/'.$newFileName;
          $g = new _spgroup; 
          $g->updategrouppic($_POST['groupid'] , $newFileName);
          echo json_encode(['status' => "success", 'message' => 'Group image updated successfullt.', 'path' => $imagePath]);
        } else {
          echo json_encode(['status' => "fail", 'message' =>'Failed to upload the file. Please try again.']); // Error message if upload fails
        }
    } else {
      echo json_encode(['status' => "fail", 'message' =>'Only JPG and PNG files are allowed.']);
    }
  }else {
    echo json_encode(['status' => "success", 'message' => 'Group image not found. Please try again.']);
  }  
  die();
}

//update group image
if(isset($_POST["editGrouopLogo"]) && $_POST["editGrouopLogo"] == 'yes' ){
  $gid = $_POST['groupid'];
  if(checkIsAllowed($gid) == false){
    echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to update group logo."));
    die();
  }

  if(isset($_FILES['spgrouplogo'])) {
    // Continue with image upload process
    $file = $_FILES['spgrouplogo'];
    // Specify the directory to move the uploaded file
    $uploadDirectory = '../../uploadimage/';
    // Get file extension
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    // Define allowed file extensions
    $allowedExtensions = ['jpg', 'jpeg', 'png'];
    // Check if file extension is valid
    if(in_array($fileExtension, $allowedExtensions)) {
        // Generate a unique file name to avoid overwriting
        $newFileName = uniqid('image_', true) . '.' . $fileExtension;
        // Set the target path for the uploaded file
        $targetPath = $uploadDirectory . $newFileName;
        // Attempt to move the uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
          $res = $grp->get_spflage($_POST['groupid']);
          if ($res) {
            $row = mysqli_fetch_assoc($res);
            if(!empty($row['spgrouplogo'])){
              $oldFile = '../../uploadimage/'.$row['spgrouplogo'];
              if(file_exists($oldFile)){
                @unlink($oldFile);
              }
            }
          }

          $imagePath = $BaseUrl.'/uploadimage/'.$newFileName;
          $g = new _spgroup; 
          $g->updategrouplogo($_POST['groupid'] , $newFileName);
          echo json_encode(['status' => "success", 'message' => 'Group logo updated successfullt.', 'path' => $imagePath]);
        } else {
          echo json_encode(['status' => "fail", 'message' =>'Failed to upload the file. Please try again.']); // Error message if upload fails
        }
    } else {
      echo json_encode(['status' => "fail", 'message' =>'Only JPG and PNG files are allowed.']);
    }
  }else {
    echo json_encode(['status' => "success", 'message' => 'Group logo not found. Please try again.']);
  }  
  die();
}

//grp album create
if (isset($_POST["create_group_album"]) && $_POST["create_group_album"]== true ) {
  try {
    $grpid = $_POST["grpid"];
    if(checkIsAllowed($grpid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to create group campaign."));
      die();
    }

    $type = $_POST["type"];
    $folder_id = $_POST['folder_id'] ?? 0; 
    $data = [
      'groupId' => $grpid,
      'spPostingAlbumName' => $_POST['album_title'],
      'spPostingAlbumDescription' => $_POST['album_description'],
      'spProfiles_idspProfiles' => $_SESSION['pid'],
      'sppostingalbumFlag' => 0,
      'spPostingPublic' => 1,
      'type' => $type,
    ];

    $actiontype = ($type == "file") ? "Folder" : 'Album';

    if($folder_id > 0 && !empty($folder_id)){
      $data = [
        'spPostingAlbumName' => $_POST['album_title'],
        'spPostingAlbumDescription' => $_POST['album_description'],
      ];
      $res = $grp->updateGroupAlbum($data, $folder_id);
      $message = 'Group Folder updated Successfully';
      $title = "Folder Updated";
    }else{
      $res = $grp->createGroupAlbum($data);
      $message = "Group $actiontype Created Successfully";
      $title = $actiontype ." Created";
    }
    
    if( $res  ){       
      echo json_encode( array('status'=>'create_group_album', 'message' => $message, 'title' => $title));
    }
    else{
      echo json_encode(array('status'=>'error', 'message' => "Something went wrong. Please try again."));
    }

  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'Something went wrong. Please try again.'));
  }
}
//grp album create end


//grp album delete
if (isset($_POST["delete_album_item"]) && $_POST["delete_album_item"]== true ) {
  try {
    $aid = $_POST["aid"];
    $type = $_POST["type"];
    if($type == "item"){
      $res = $grp->getAlbumItem($aid);
    }else{
      $res = $grp->getAlbum($aid);
    }

    if($res){
      $item = mysqli_fetch_assoc($res);
      if(($type == "item" && isset($item['pid']) && $item['pid'] != $_SESSION['pid']) || ($type == "album" && isset($item['spProfiles_idspProfiles']) && $item['spProfiles_idspProfiles'] != $_SESSION['pid'])){
        echo json_encode(array('status'=>'error', 'message'=>"Access not allowed to perform delete action"));die();
      }
    }

    if( $res  ){ 
      if($type == "item"){
        $path = '../'.$item['file_path'];
        if($grp->removeAlbumItem($aid)){
          if(file_exists($path)) { @unlink($path); };
          echo json_encode( array('status'=>'delete_album_item', 'message'=>'Item deleted Successfully'));die();
        }
      }elseif($type = "album"){
        if($grp->removeAlbum($aid)){
          $resAlbumId = $grp->getAlbumItemByAlbumId($aid);
          if($resAlbumId && $resAlbumId->num_rows > 0){
            while($albumItem = mysqli_fetch_assoc($resAlbumId)){
              $path = '../'.$albumItem['file_path'];
              if($grp->removeAlbumItem($albumItem['id'])){
                if(file_exists($path)) { @unlink($path); };
              }
            }
          }
          echo json_encode( array('status'=>'delete_album_item', 'message'=>'Item deleted Successfully'));die();
        }
      }
      echo json_encode( array('status'=>'create_group_album', 'message'=>'Item deleted failed'));die();
    }
    else{
      echo json_encode(array('status'=>'error', 'message'=>"Item not found"));die();
    }

  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'Something went wrong. Please try again.'));die();
  }
}
//grp album delete end


//grp announcement create
if (isset($_POST["create_announcement"]) && $_POST["create_announcement"]== true ) {
  try {
    $grpid = $_POST["grpid"];
    $announcement_id = $_POST['announcement_id'] ?? 0; 
    if(checkIsAllowed($grpid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to create announcement."));
      die();
    }

    $data = [
      'announcemt_date' => $_POST['announcement_date'],
      'title' => $_POST['announcement_title'],
      'message' => $_POST['announcement_message'],
      'group_id' => $grpid,
      'user_id' => $_SESSION['uid'],
      'profile_id' => $_SESSION['pid'],
      'date' => date('y-m-d H:i:s')
    ];

    if($announcement_id > 0 && !empty($announcement_id)){
      $data = [
        'announcemt_date' => $_POST['announcement_date'],
        'title' => $_POST['announcement_title'],
        'message' => $_POST['announcement_message'],
      ];
      $res = $grp->updateAnnouncement($data, $announcement_id);
      $message = 'Announcement updated Successfully';
      $title = "Announcement Updated";
    }else{
      $res = $grp->createAnnouncement($data);
      $message = "Announcement Created Successfully";
      $title = "Announcement Created";
    }
    
    if( $res  ){       
      echo json_encode( array('status'=>'create_announcement', 'message' => $message, 'title' => $title));
    }
    else{
      echo json_encode(array('status'=>'error', 'message' => "Something went wrong. Please try again."));
    }

  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'Something went wrong. Please try again.'));
  }
}
//grp announcement create end

//grp announcement delete
if (isset($_POST["delete_announcement"]) && $_POST["delete_announcement"]== true ) {
  try {
    $aid = $_POST["aid"];
    $res = $grp->readAnnouncement($aid);

    if($res){
      $item = mysqli_fetch_assoc($res);
      if(isset($item['profile_id']) && $item['profile_id'] != $_SESSION['pid']){
        echo json_encode(array('status'=>'error', 'message'=>"Access not allowed to perform delete action"));die();
      }
    }

    if( $res  ){ 
      if($grp->removeAnnouncement($aid)){
        echo json_encode( array('status'=>'delete_announcement', 'message'=>'Item deleted Successfully'));die();
      }
      echo json_encode( array('status'=>'error', 'message'=>'Item deleted failed'));die();
    }
    else{
      echo json_encode(array('status'=>'error', 'message'=>"Item not found"));die();
    }

  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'Something went wrong. Please try again.'));die();
  }
}
//grp announcement delete end

//grp announcement create
if (isset($_POST["create_group_campaign"]) && $_POST["create_group_campaign"]== true ) {
  try {
    $grpid = $_POST['grpid'];
    if(checkIsAllowed($grpid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to create group campaign."));
      die();
    }

    $res = $grp->createCampaign($_POST);
    $message = "Campaign Created Successfully";
    $title = "Campaign Created";
    
    if( $res  ){       
      echo json_encode( array('status'=>'create_group_campaign', 'message' => $message, 'title' => $title));
    }
    else{
      echo json_encode(array('status'=>'error', 'message' => "Something went wrong. Please try again."));
    }

  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'Something went wrong. Please try again.'));
  }
}
//grp announcement create end

//grp event create
if (isset($_POST["create_event"]) && $_POST["create_event"]== true ) {
  try {
    $grpid = $_POST["groupid"];
    if(checkIsAllowed($grpid) == false){
      echo json_encode(array('status'=>'error', 'message'=>"You are not allowed to create event."));
      die();
    }

    $data = $_POST;
    unset($data['groupid']);
    unset($data['create_event']);
    $category = explode("|", $data['spCategories_idspCategory_categoryname']);
    $data['spCategories_idspCategory'] = $category[0];
    $data['categoryname'] = $category[1];
    $data['eventcategory'] = $category[1];
    $data['spPostingPrice'] = null;
    $data['spPostingEventOrgId'] = null;
    $data['hallcapacity'] = 0;
    $data['ticketcapacity'] = 0;
    $data['addfeaturning'] = '';
    $data['sponsorId'] = null;    
    unset($data['spCategories_idspCategory_categoryname']);

    $grpe = new _spgroup_event;
    $res = $grpe->create($data);

    if($res){
      if(isset($_FILES['spPostingPic'])) {
        $file = $_FILES['spPostingPic'];
        $uploadDirectory = '../../uploadimage/';
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if(in_array($fileExtension, $allowedExtensions)) {
            $newFileName = uniqid('image_', true) . '.' . $fileExtension;
            $targetPath = $uploadDirectory . $newFileName;
            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
              $imagePath = $BaseUrl.'/uploadimage/'.$newFileName;
              $bannerData = [
                'spPostingPic' => $imagePath,
                'spPostings_idspPostings' => $res,
                'spFeatureimg' => 0
              ];
              $grpe->createEvnetBanner($bannerData);
            }
        }
      }
    }

    $message = "Event Created Successfully";
    $title = "Event Created";
    
    if( $res  ){       
      echo json_encode( array('status'=>'create_event', 'message' => $message, 'title' => $title));
    }
    else{
      echo json_encode(array('status'=>'error', 'message' => "Something went wrong. Please try again."));
    }

  } catch (Exception $e) {
     echo json_encode(array('status'=>'error', 'message'=>'Something went wrong. Please try again.'));
  }
}
//grp event create end
?>