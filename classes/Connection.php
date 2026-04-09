<?php
error_reporting(E_ALL);
//ini_set('display_errors', 'On');
class Connection extends Base{

  /**
   * To get the user having birthday today
   *
   * @return array An array
   */ 
   
   
   
  public function getBirthDay(){
    $sql = 'SELECT prof.*, t.*, d.*, su.*, prof.spProfileName as profile_name, prof.spProfilePic as profile_pic FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesender JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesreceiver = ? AND t.spprofiles_has_spprofileflag = ? AND DAY(prof.spprofilesdob) = DAY(CURRENT_DATE()) AND MONTH(prof.spprofilesdob) = MONTH(CURRENT_DATE()) ORDER BY prof.spprofilename ASC;';
    $params = [$_SESSION['pid'], 1];
    $out = selectQ($sql, "ii", $params);
    $sql2 = 'SELECT prof.*, t.*, d.*, su.*, prof.spProfileName as profile_name, prof.spProfilePic as profile_pic FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesreceiver JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesender = ? AND t.spprofiles_has_spprofileflag = ? AND DAY(prof.spprofilesdob) = DAY(CURRENT_DATE()) AND MONTH(prof.spprofilesdob) = MONTH(CURRENT_DATE()) ORDER BY prof.spprofilename ASC;';
    $out2 = selectQ($sql2, "ii", $params);
    $out = array_merge($out, $out2);
    if($out && count($out) > 0){
      foreach($out as $key => $bday){
        if(isset($bday['spProfilesDob'])) {
          $dob = new DateTime($bday['spProfilesDob']);
          $now = new DateTime();
          $out[$key]['age'] = $now->diff($dob)->y;
          $out[$key]['dob'] = $dob->format('d F Y');
        }
      }
    }
    $upcoming = $this->getUpcomingBirthDay();
    if($upcoming && count($upcoming) > 0){
      foreach($upcoming as $key1 => $up){
        if(isset($up['spProfilesDob'])) {
          $comingDob = new DateTime($up['spProfilesDob']);
          $now = new DateTime();
          $upcoming[$key1]['age'] = $now->diff($comingDob)->y;
          $upcoming[$key1]['dob'] = $comingDob->format('d F Y');
        }
      }
    }
    return ['format' => 'skipSuccess', 'data' => ['upcoming' => $upcoming, 'recent' => $out]];  
  }
  
  /**
   * To get the user friends
   *
   * @return array An array
   */ 
  public function getFriendsList($search_term=''){
    if($search_term!=''){
      $_POST['search_term'] = $search_term;
    }
    $search_term = isset($_POST['search_term']) ? trim($_POST['search_term']) : "";
    //echo $search_term;exit;
    $sql = 'SELECT * FROM spprofiles_has_spprofiles AS t JOIN spprofiles prof ON prof.idspprofiles = t.spprofiles_idspprofilesender JOIN spprofiletype AS type ON  prof.spProfileType_idspProfileType = type.idspProfileType WHERE t.spprofiles_idspprofilesreceiver= ? and t.spprofiles_has_spprofileflag = ? '.( isset($_POST['search_term']) ? ' and  prof.spProfileName like '."'%".$search_term."%'" : '' ).' order by prof.spprofilename asc';
    $params = [$_SESSION['pid'], 1];
    $out = selectQ($sql, "ii", $params);
    $sql2 = 'SELECT * FROM spprofiles_has_spprofiles AS t JOIN spprofiles prof ON prof.idspprofiles = t.spprofiles_idspprofilesreceiver JOIN spprofiletype AS type ON  prof.spProfileType_idspProfileType = type.idspProfileType WHERE t.spprofiles_idspprofilesender= ?  AND t.spprofiles_has_spprofileflag = ?'.( isset($_POST['search_term']) ? ' and  prof.spProfileName like '."'%".$search_term."%'" : '' ).' ORDER BY prof.spprofilename ASC';
    $params2 = [$_SESSION['pid'], 1];
    $out2 = selectQ($sql2, "ii", $params2);
    $out = array_merge($out, $out2);
    if($out && count($out) > 0){
      $userFriend = $this->getFriendsListArray($_SESSION['pid'],$search_term);
      foreach($out as $key => $friend){
        $friendList = $this->getFriendsListArray($friend['idspProfiles'],$search_term);
        $out[$key]['mutual'] = 0;
        if(count($friendList) > 0){
          $ids1 = array_column($userFriend, 'idspProfiles');
          $ids2 = array_column($friendList, 'idspProfiles');
          $commonElements = array_intersect($ids1, $ids2);
          $out[$key]['mutual'] =  count($commonElements);
        }
        $out[$key]['follow'] = 0;
        $checkFollow = $this->checkFollowing($_SESSION['pid'], $friend['idspProfiles']);
        if($checkFollow){
          $out[$key]['follow'] = 1;
        }
      }
    }
    return ['format' => 'skipSuccess', 'data' => $out];  
  }
  
  
  private function checkStoreHasProducts($profileId) {
    $sql = 'SELECT COUNT(*) FROM spproduct WHERE spuser_idspuser = ?';
    $params = [$profileId];
    $result = selectQ($sql, "i", $params);
    return $result[0] > 0; 
}
  /**
   * To follow a user
   *
  **/
  public function checkFollowing($pid, $followId){
    if(isset($pid) && isset($followId)){
      $arr = [];
      $arr[] = $pid;
      $arr[] = $followId;
      $arr[] = 1;
      $out = selectQ('SELECT * FROM spuser_follow WHERE follower = ? AND following = ? AND status = ?', 'iii', $arr);
      if(!empty($out)){
        return true;
      } else {
        return false;
      }
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * To get the user friends count
   *
   * @return array An array
   */ 
  public function getFriendsCount($search_term=''){
    $sql = 'SELECT COUNT(t.id) AS total_count FROM spprofiles_has_spprofiles AS t JOIN spprofiles prof ON prof.idspprofiles = t.spprofiles_idspprofilesender WHERE t.spprofiles_idspprofilesreceiver= ? and t.spprofiles_has_spprofileflag = ?'.( $search_term!='' ? ' and  prof.spProfileName like '."'%".$search_term."%'" : '' );
    $params = [$_SESSION['pid'], 1];
    $out = selectQ($sql, "ii", $params, 'one');
    $sql2 = 'SELECT COUNT(t.id) AS total_count FROM spprofiles_has_spprofiles AS t JOIN spprofiles prof ON prof.idspprofiles = t.spprofiles_idspprofilesender  WHERE t.spprofiles_idspprofilesender= ?  AND t.spprofiles_has_spprofileflag = ?'.( $search_term!='' ? ' and  prof.spProfileName like '."'%".$search_term."%'" : '' );
    $params2 = [$_SESSION['pid'], 1];
    $out2 = selectQ($sql2, "ii", $params2, 'one');
    $total = 0;
    if(isset($out['total_count'])){
      $total = $out['total_count'];
    }
    if(isset($out2['total_count'])){
      $total = $total+$out2['total_count'];
    }
    return ['data' => $total];  
  }
  
  /**
   * To get the recently added
   *
   * @return array An array
   */ 
  public function getRecentlyAdded(){
    $order = isset($_POST['order']) ? trim($_POST['order']) : "recentlyAdded";
    $search_term = isset($_POST['search_term']) ? trim($_POST['search_term']) : "";
    if($order == "recentlyAdded"){
      $orderby = "t.Profile_request_date DESC";
    }
    if($order == "oldestAdded"){
      $orderby = "t.Profile_request_date ASC";
    }
    if($order == "name"){
      $orderby = "prof.spProfileName ASC";
    }
    $sql = 'SELECT * FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesreceiver JOIN spprofiletype AS type ON  prof.spProfileType_idspProfileType = type.idspProfileType WHERE spprofiles_idspprofilesender = ? AND Profile_request_date BETWEEN ADDDATE(NOW(),?) AND NOW() AND spprofiles_has_spprofileflag = ?   
     '.( $search_term!='' ? ' and prof.spProfileName like '."'%".$search_term."%'" : '').'  ORDER BY '.$orderby;
    $params = [$_SESSION['pid'], -5, 1];
    $out = selectQ($sql, "iii", $params);
    if($out && count($out) > 0){
      $userFriend = $this->getFriendsListArray($_SESSION['pid']);
      foreach($out as $key => $friend){
        $friendList = $this->getFriendsListArray($friend['idspProfiles']);
        $out[$key]['mutual'] = 0;
        if(count($friendList) > 0){
          $ids1 = array_column($userFriend, 'idspProfiles');
          $ids2 = array_column($friendList, 'idspProfiles');
          $commonElements = array_intersect($ids1, $ids2);
          $out[$key]['mutual'] =  count($commonElements);
        }
        $out[$key]['follow'] = 0;
        $checkFollow = $this->checkFollowing($_SESSION['pid'], $friend['idspProfiles']);
        if($checkFollow){
          $out[$key]['follow'] = 1;
        }
      }
    }
    return ['format' => 'skipSuccess', 'data' => $out];  
  }



  public function publicProfile(){
    $_REQUEST['search_val'] = 'ashutosh roy';
    $sql = 'SELECT * FROM spprofiles WHERE spProfileName like ? ';
    $params = ["('%".$_REQUEST['search_val']."%')"];
    $out = selectQ($sql, "i", $params);var_dump($out);
    foreach($out as $row){

    }
    return ['format' => 'skipSuccess', 'data' => $out];  
  }
  
  /**
   * To message a user
   *
  **/
  public function sendMessage(){
    if(isset($_POST['sender']) && isset($_POST['receiver'])){
      if(isset($_POST['message'])){
        $arr = [];
        $arr[] = $_POST["sender"];
        $arr[] = $_POST['receiver'];
        $arr[] = $_POST['message'];
        $message = insertQ('insert into spfriendchatting (spprofiles_idspProfilesSender, spprofiles_idspProfilesReciver, spfriendChattingMessage) values (?, ?, ?)', 'iis', $arr);
        return ['format' => 'skipSuccess', 'data' => $message];
      } else {
        errorOut("Message cannot be empty.");
      }
    } else {
      errorOut("Invalid Users");
    }
  }
  
  /**
   * check if the user is in the group
   *
  **/
  public function checkGroupMember($pid, $gid){
    if(isset($pid) && isset($gid)){
      $arr = [];
      $arr[] = $pid;
      $arr[] = $gid;
      $arr[] = 1;
      $out = selectQ('SELECT * FROM spprofiles_has_spgroup WHERE spProfiles_idspProfiles = ? AND spGroup_idspGroup = ? AND spApproveRegect = ?', 'iii', $arr);
      if(!empty($out)){
        return true;
      } else {
        return false;
      }
    } else {
       errorOut("Invalid Users");
    }
  }
  
  /**
   * add a user to group
   *
  **/
  public function addToGroup(){
    if(isset($_POST['newMember'])){
      if(isset($_POST['groupid']) && $_POST['groupid'] != 0){
        $checkGroup = $this->checkGroupMember($_POST['newMember'], $_POST['groupid']);
        if($checkGroup){
          errorOut("Already a member.");
        }
        $arr = [];
        $arr[] = $_POST["newMember"];
        $arr[] = $_POST['groupid'];
        $arr[] = 0;
        $arr[] = 2;
        $arr[] = 0;
        $arr[] = date('Y-m-d');
        $arr[] = 1;
        $group = insertQ('insert into spprofiles_has_spgroup (spProfiles_idspProfiles, spGroup_idspGroup, spProfileIsAdmin, spApproveRegect, spAssistantAdmin, spGroup_newMember_Date, requestsend) values (?, ?, ?, ?, ?, ?, ?)', 'iiiiisi', $arr);
        return ['format' => 'skipSuccess', 'data' => $group];
      } else {
        errorOut("Select a group.");
      }
    } else {
      errorOut("Invalid Users");
    }
  }
  
  /**
   * To groups list of the user
   *
   * @return array An array
   */    
  public function getGroupsList(){
    $sql = "SELECT DISTINCT idspGroup, spGroupName FROM spgroup AS t INNER JOIN spprofiles_has_spgroup AS d ON t.idspgroup = d.spgroup_idspgroup INNER JOIN spprofiles AS p ON d.spprofiles_idspprofiles = p.idspprofiles WHERE idspgroup IN (SELECT spgroup_idspgroup FROM spprofiles_has_spgroup WHERE spprofiles_idspprofiles IN(SELECT idspprofiles FROM spprofiles WHERE spuser_idspuser =?))  AND d.spapproveregect=? AND d.spprofiles_idspprofiles =?";
    $params = [$_SESSION['uid'], 1, $_SESSION['pid']];
    $out = selectQ($sql, "iii", $params);
    return ['format' => 'skipSuccess', 'data' => $out];
  }
  
  /**
   * To get blocked users
   *
   * @return array An array
   */ 
  public function getBlockedUser(){
    $order = isset($_POST['order']) ? trim($_POST['order']) : "recentlyAdded";
    $search_term = isset($_POST['search_term']) ? trim($_POST['search_term']) : "";
    if($order == "recentlyAdded"){
      $orderby = "t.created_date DESC";
    }
    if($order == "oldestAdded"){
      $orderby = "t.created_date ASC";
    }
    if($order == "name"){
      $orderby = "prof.spProfileName ASC";
    }
    $orderby = "t.idspfeature DESC";
    $sql = "SELECT * FROM spprofile_feature AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.idspProfile_to JOIN spprofiletype AS type ON  prof.spProfileType_idspProfileType = type.idspProfileType WHERE t.idspprofile_by = ? and t.spfeature_block = ? ".($search_term!='' ? "and prof.spProfileName like '%".$search_term."%'" : '')." ORDER BY ".$orderby;
    $params = [$_SESSION['pid'], 1];
    $out = selectQ($sql, "ii", $params);
    if($out && count($out) > 0){
      $userFriend = $this->getFriendsListArray($_SESSION['pid']);
      foreach($out as $key => $friend){
        $friendList = $this->getFriendsListArray($friend['idspProfiles']);
        $out[$key]['mutual'] = 0;
        if(count($friendList) > 0){
          $ids1 = array_column($userFriend, 'idspProfiles');
          $ids2 = array_column($friendList, 'idspProfiles');
          $commonElements = array_intersect($ids1, $ids2);
          $out[$key]['mutual'] =  count($commonElements);
        }
      }
    }
    return ['format' => 'skipSuccess', 'data' => $out];  
  }
  
  /**
   * To get the following users
   *
   * @return array An array
   */ 
  public function getFollowing(){
    $order = isset($_POST['order']) ? trim($_POST['order']) : "recentlyAdded";
    $type = isset($_POST['following']) ? trim($_POST['following']) : "0";
    if($order == "recentlyAdded"){
      $orderby = "t.created_date DESC";
    }
    if($order == "oldestAdded"){
      $orderby = "t.created_date ASC";
    }
    if($order == "name"){
      $orderby = "prof.spProfileName ASC";
    }
    $sql = "SELECT * FROM spuser_follow AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.follower JOIN spprofiletype AS type ON  prof.spProfileType_idspProfileType = type.idspProfileType WHERE t.following = ? and t.status = ? ORDER BY ".$orderby;
    if($type == 1){
      $sql = "SELECT * FROM spuser_follow AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.following JOIN spprofiletype AS type ON  prof.spProfileType_idspProfileType = type.idspProfileType WHERE t.follower = ? and t.status = ? ORDER BY ".$orderby;
    }
    $params = [$_SESSION['pid'], 1];
    $out = selectQ($sql, "ii", $params);
    if($out && count($out) > 0){
      $userFriend = $this->getFriendsListArray($_SESSION['pid']);
      foreach($out as $key => $friend){
        $friendList = $this->getFriendsListArray($friend['idspProfiles']);
        $out[$key]['mutual'] = 0;
        if(count($friendList) > 0){
          $ids1 = array_column($userFriend, 'idspProfiles');
          $ids2 = array_column($friendList, 'idspProfiles');
          $commonElements = array_intersect($ids1, $ids2);
          $out[$key]['mutual'] =  count($commonElements);
        }
        $out[$key]['follow'] = 0;
        $checkFollow = $this->checkFollowing($_SESSION['pid'], $friend['idspProfiles']);
        if($checkFollow){
          $out[$key]['follow'] = 1;
        }
        $out[$key]['isFriend'] = 0;
        $isFriend = $this->checkFriend($_SESSION['pid'], $friend['idspProfiles']);
        if($isFriend){
          $out[$key]['isFriend'] = 1;
        }
      }
    }
    return ['format' => 'skipSuccess', 'data' => $out];  
  }
  
  public function checkFriend($sender, $receiver){
    $sql = "SELECT * FROM spprofiles_has_spprofiles WHERE (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?) OR (spprofiles_idspprofilesreceiver = ? AND spprofiles_idspprofilesender= ?)";
    $params = [$sender, $receiver, $receiver, $sender];
    $out = selectQ($sql, "iiii", $params);
    if(!empty($out)){
      return true;
    } else {
      return false;
    }
  }
  
  public function getLevelUsers($array){
    $count = count($array);
    $placeholders = implode(',', array_fill(0, $count, '?'));
    $type = str_repeat('i', $count);
    $sql = 'SELECT spprofiles_idspprofilesender as levelusers FROM spprofiles_has_spprofiles AS t 
    
     WHERE (spprofiles_idspprofilesreceiver IN ('.$placeholders.') ) AND (spprofiles_has_spprofileflag IS NOT NULL) AND (spprofiles_has_spprofileflag != ?) GROUP BY spprofiles_idspprofilesender';
    $array[] = 0;
    $type = $type."i";
    $out = selectQ($sql, $type, $array);
    $sql2 = 'SELECT spprofiles_idspprofilesreceiver as levelusers FROM spprofiles_has_spprofiles AS t WHERE (spprofiles_idspprofilesender IN ('.$placeholders.') ) AND (spprofiles_has_spprofileflag IS NOT NULL) AND (spprofiles_has_spprofileflag != ?) GROUP BY spprofiles_idspprofilesreceiver';
    $out2 = selectQ($sql2, $type, $array);
    $out = array_merge($out, $out2);
    return ['data' => $out];  
  }
  
  /**
   * To get the user friends in array
   *
   * @return array An array
   */
  public function getConnectionLevel(){
    $search_term = isset($_POST['search_term']) ? trim($_POST['search_term']) : "";
    $levels = [];
    $actuallevels = [];
    $sql = 'SELECT * FROM spprofiles_has_spprofiles AS t WHERE (spprofiles_idspprofilesreceiver = ?) AND (spprofiles_has_spprofileflag IS NOT NULL) AND (spprofiles_has_spprofileflag != ?) GROUP BY spprofiles_idspprofilesender';
    $params = [$_SESSION['pid'], 0];
    $out = selectQ($sql, "ii", $params);
    $userFriend = $this->getFriendsListArray($_SESSION['pid'],$search_term);
    $levels[0] = [];
    if($out){
      foreach($out as $row){
        $arr = [];
        $arr['pid'] = $row['spProfiles_idspProfileSender'];
        $friendArray = $this->getFriendsListArray($row['spProfiles_idspProfileSender'],$search_term);
        $arr['mutual'] = 0;
        $userData = $this->UserInfo($row['spProfiles_idspProfileSender'], $search_term);
        if(isset($userData['data'])){
          $arr['details'] = $userData['data'];
        }
        if(count($friendArray) > 0){
          $ids1 = array_column($userFriend, 'idspProfiles');
          $ids2 = array_column($friendArray, 'idspProfiles');
          $commonElements = array_intersect($ids1, $ids2);
          $arr['mutual'] =  count($commonElements);
        }
        $arr['follow'] = 0;
        $checkFollow = $this->checkFollowing($_SESSION['pid'], $row['spProfiles_idspProfileSender']);
        if($checkFollow){
          $arr['follow'] = 1;
        }
        $levels[0][] = $row['spProfiles_idspProfileSender'];
        $actuallevels[0][] = $arr;
      }
    }
    $sql1 = 'SELECT * FROM spprofiles_has_spprofiles AS t WHERE (spprofiles_idspprofilesender = ?) AND (spprofiles_has_spprofileflag IS NOT NULL) AND (spprofiles_has_spprofileflag != ?) GROUP BY spprofiles_idspprofilesreceiver';
    $out1 = selectQ($sql1, "ii", $params);
    if($out1){
      foreach($out1 as $row2){
        if (!in_array($row2['spProfiles_idspProfilesReceiver'], $levels[0])) {
          $arr = [];
          $arr['pid'] = $row2['spProfiles_idspProfilesReceiver'];
          $friendArray = $this->getFriendsListArray($row2['spProfiles_idspProfilesReceiver'],$search_term);
          $arr['mutual'] = 0;
          $userData = $this->UserInfo($row2['spProfiles_idspProfilesReceiver'], $search_term);
          if(isset($userData['data'])){
            $arr['details'] = $userData['data'];
          }
          if(count($friendArray) > 0){
            $ids1 = array_column($userFriend, 'idspProfiles');
            $ids2 = array_column($friendArray, 'idspProfiles');
            $commonElements = array_intersect($ids1, $ids2);
            $arr['mutual'] =  count($commonElements);
          }
          $arr['follow'] = 0;
          $checkFollow = $this->checkFollowing($_SESSION['pid'], $row2['spProfiles_idspProfilesReceiver']);
          if($checkFollow){
            $arr['follow'] = 1;
          }
          $actuallevels[0][] = $arr;
				  $levels[0][] = $row2['spProfiles_idspProfilesReceiver'];
				}
      }
    }
    $levels[1] = [];
    if(count($levels[0]) > 0){
      $out2 = $this->getLevelUsers($levels[0]);
      if(isset($out2['data'])){
        foreach($out2['data'] as $row3){
          if (!in_array($row3['levelusers'], $levels[0]) && !in_array($row3['levelusers'], $levels[1]) && $row3['levelusers'] != $_SESSION['pid']) {
            $arr = [];
            $arr['pid'] = $row3['levelusers'];
            $friendArray = $this->getFriendsListArray($row3['levelusers'],$search_term);
            $arr['mutual'] = 0;
            $userData = $this->UserInfo($row3['levelusers'], $search_term);
            if(isset($userData['data'])){
              $arr['details'] = $userData['data'];
            }
            if(count($friendArray) > 0){
              $ids1 = array_column($userFriend, 'idspProfiles');
              $ids2 = array_column($friendArray, 'idspProfiles');
              $commonElements = array_intersect($ids1, $ids2);
              $arr['mutual'] =  count($commonElements);
            }
            $arr['follow'] = 0;
            $checkFollow = $this->checkFollowing($_SESSION['pid'], $row3['levelusers']);
            if($checkFollow){
              $arr['follow'] = 1;
            }
            $arr['connect'] = 0;
            $checkConnect = $this->checkFriend($_SESSION['pid'], $row3['levelusers']);
            if($checkConnect){
              $arr['connect'] = 1;
            }
            $actuallevels[1][] = $arr;
		        $levels[1][] = $row3['levelusers'];
		      }
        }
      }
    }
    $levels[2] = [];
    if(count($levels[1]) > 0){
      $out3 = $this->getLevelUsers($levels[1]);
      if(isset($out3['data'])){
        foreach($out3['data'] as $row4){
          if (!in_array($row4['levelusers'], $levels[0]) && !in_array($row4['levelusers'], $levels[1]) && !in_array($row4['levelusers'], $levels[2]) && $row4['levelusers'] != $_SESSION['pid']) {
            $arr = [];
            $arr['pid'] = $row4['levelusers'];
            $friendArray = $this->getFriendsListArray($row4['levelusers'],$search_term);
            $arr['mutual'] = 0;
            $userData = $this->UserInfo($row4['levelusers'], $search_term);
            if(isset($userData['data'])){
              $arr['details'] = $userData['data'];
            }
            if(count($friendArray) > 0){
              $ids1 = array_column($userFriend, 'idspProfiles');
              $ids2 = array_column($friendArray, 'idspProfiles');
              $commonElements = array_intersect($ids1, $ids2);
              $arr['mutual'] =  count($commonElements);
            }
            $arr['follow'] = 0;
            $checkFollow = $this->checkFollowing($_SESSION['pid'], $row4['levelusers']);
            if($checkFollow){
              $arr['follow'] = 1;
            }
            $actuallevels[2][] = $arr;
		        $levels[2][] = $row4['levelusers'];
		      }
        }
      }
    }
    return ['format' => 'skipSuccess', 'data' => $actuallevels];
  }
   
  
  /**
   * To get the user friends in array
   *
   * @return array An array
   */ 
  public function getFriendsListArray($pid,$search_term=''){
    $sql = 'SELECT prof.idspProfiles FROM spprofiles_has_spprofiles AS t JOIN spprofiles prof ON prof.idspprofiles = t.spprofiles_idspprofilesender WHERE t.spprofiles_idspprofilesreceiver= ? AND t.spprofiles_has_spprofileflag = ? '.( $search_term!='' ? ' and prof.spProfileName like '."'%".$search_term."%'" : '').' ORDER BY prof.spprofilename ASC';
    $params = [$pid, 1];
    $out = selectQ($sql, "ii", $params);
    $sql2 = 'SELECT prof.idspProfiles FROM spprofiles_has_spprofiles AS t JOIN spprofiles prof ON prof.idspprofiles = t.spprofiles_idspprofilesreceiver WHERE t.spprofiles_idspprofilesender= ?  AND t.spprofiles_has_spprofileflag = ? '.( $search_term!='' ? ' and prof.spProfileName like '."'%".$search_term."%'" : '').' ORDER BY prof.spprofilename ASC';
    $params2 = [$pid, 1];
    $out2 = selectQ($sql2, "ii", $params2);
    $out = array_merge($out, $out2);
    return $out;  
  }
  
  /**
   * To get the user having upcoming birthday
   *
   * @return array An array
   */ 
  public function getUpcomingBirthDay(){
    $sql = 'SELECT prof.*, t.*, d.*, su.*, prof.spProfileName as profile_name, prof.spProfilePic as profile_pic FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesender JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesreceiver = ? AND t.spprofiles_has_spprofileflag = ? AND ( (MONTH(prof.spprofilesdob) > MONTH(CURDATE())) OR (MONTH(prof.spprofilesdob) = MONTH(CURDATE()) AND DAY(prof.spprofilesdob) > DAY(CURDATE()))) ORDER BY MONTH(prof.spprofilesdob), DAY(prof.spprofilesdob), prof.spprofilename ASC LIMIT 10';
    $params = [$_SESSION['pid'], 1];
    $out = selectQ($sql, "ii", $params);
    $sql2 = 'SELECT prof.*, t.*, d.*, su.*, prof.spProfileName as profile_name, prof.spProfilePic as profile_pic FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesreceiver JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesender = ? AND t.spprofiles_has_spprofileflag = ? AND ( (MONTH(prof.spprofilesdob) > MONTH(CURDATE())) OR (MONTH(prof.spprofilesdob) = MONTH(CURDATE()) AND DAY(prof.spprofilesdob) > DAY(CURDATE()))) ORDER BY MONTH(prof.spprofilesdob), DAY(prof.spprofilesdob), prof.spprofilename ASC LIMIT 10';
    $out2 = selectQ($sql2, "ii", $params);
    $out = array_merge($out, $out2);
    return $out;  
  }
  
   /**
   * To get the user having birthday in the given month
   *
   * @param Int - $month
   * @return array An array
   */ 
  public function getBirthDayByMonth(){
    $month = isset($_POST['month']) ? trim($_POST['month']) : "";
    if(!empty($month)){
      $sql = 'SELECT prof.*, t.*, d.*, su.*, prof.spProfileName as profile_name, prof.spProfilePic as profile_pic FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesender JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesreceiver = ? AND t.spprofiles_has_spprofileflag = ? AND MONTH(prof.spprofilesdob) = ? ORDER BY DAY(prof.spprofilesdob), prof.spprofilename ASC LIMIT 10';
      $params = [$_SESSION['pid'], 1, $month];
      $out = selectQ($sql, "iii", $params);
      $sql2 = 'SELECT prof.*, t.*, d.*, su.*, prof.spProfileName as profile_name, prof.spProfilePic as profile_pic FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesreceiver JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesender = ? AND t.spprofiles_has_spprofileflag = ? AND MONTH(prof.spprofilesdob) = ? ORDER BY DAY(prof.spprofilesdob), prof.spprofilename ASC LIMIT 10';
      $out = selectQ($sql2, "iii", $params);
      $count = 0;
      $countData = $this->getCountBirthDayByMonth($month);
      if(isset($countData['data'])){
        $count = $countData['data']['total_count'];
      }
      return ['format' => 'skipSuccess', 'data' => ['users' => $out, 'count' => $count]];
    } else {
      errorOut("Invalid Month");
    }
  }
  
  /**
   * To get the pending request of the users
   *
   * @return array An array
   */ 
  public function getPendingRequest(){
    $order = isset($_POST['order']) ? trim($_POST['order']) : "recentlyAdded";
    $search_term = isset($_POST['search_term']) ? trim($_POST['search_term']) : "";
    if($order == "recentlyAdded"){
      $orderby = "spprofiles_has_spprofiles.Profile_request_date DESC";
    }
    if($order == "oldestAdded"){
      $orderby = "spprofiles_has_spprofiles.Profile_request_date ASC";
    }
    if($order == "name"){
      $orderby = "spprofiles.spProfileName ASC";
    }
    $limit = isset($_POST['limit']) ? trim($_POST['limit']) : "10";
    $skip = isset($_POST['skip']) ? trim($_POST['skip']) : "0";
    $sql = 'SELECT * FROM spprofiles_has_spprofiles JOIN spprofiles ON spprofiles_has_spprofiles.spProfiles_idspProfileSender = spprofiles.idspprofiles  
    join spprofiletype on spprofiletype.idspProfileType = spprofiles.spProfileType_idspProfileType
    JOIN spprofiletype AS type ON  spprofiles.spProfileType_idspProfileType = type.idspProfileType WHERE spprofiles_idspprofilesreceiver = ? AND (spprofiles_has_spprofileflag = ? OR spprofiles_has_spprofileflag IS null) AND spprofiles_idspprofilesender != ? '.( $search_term!='' ? ' and spprofiles.spProfileName like '."'%".$search_term."%'" : '').' ORDER BY '.$orderby.' LIMIT ?, ?';
    $params = [$_SESSION['pid'], 0, $_SESSION['pid'], $skip, $limit];
    $out = selectQ($sql, "iiiii", $params);
    if($out && count($out) > 0){
      $userFriend = $this->getFriendsListArray($_SESSION['pid']);
      foreach($out as $key => $friend){
        $friendList = $this->getFriendsListArray($friend['idspProfiles']);
        $out[$key]['mutual'] = 0;
        if(count($friendList) > 0){
          $ids1 = array_column($userFriend, 'idspProfiles');
          $ids2 = array_column($friendList, 'idspProfiles');
          $commonElements = array_intersect($ids1, $ids2);
          $out[$key]['mutual'] =  count($commonElements);
        }
      }
    }
    $count = 0;
    $pendingCount = $this->getPendingRequestCount();
    if($pendingCount['data']){
      $count = $pendingCount['data'];
    }
    return ['format' => 'skipSuccess', 'data' => ['pending' => $out, 'count' => $count]];
  }
  
   /**
   * To get the pending request count of the users
   *
   * @return array An array
   */ 
  public function getPendingRequestCount($search_term=''){
    $count = 0;
    $sql = 'SELECT count(spprofiles_has_spprofiles.id) AS total_count FROM spprofiles_has_spprofiles JOIN spprofiles ON spprofiles_has_spprofiles.spProfiles_idspProfileSender = spprofiles.idspprofiles WHERE spprofiles_idspprofilesreceiver = ? AND (spprofiles_has_spprofileflag = ? OR spprofiles_has_spprofileflag IS null) AND spprofiles_idspprofilesender != ?'.( $search_term!='' ? ' and  spprofiles.spProfileName like '."'%".$search_term."%'" : '' );
    $params = [$_SESSION['pid'], 0, $_SESSION['pid']];
    $out = selectQ($sql, "iii", $params, 'one');
    if(isset($out['total_count'])){
      $count = $out['total_count'];
    }
    return ['data' => $count];
  }
  
  /**
   * To get the count of user having birthday in the given month
   *
   * @param Int - $month
   * @return array An array
   */ 
  public function getCountBirthDayByMonth($month){
    $sql = 'SELECT COUNT(prof.idspprofiles) as total_count FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesender JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesreceiver = ? AND t.spprofiles_has_spprofileflag = ? AND MONTH(prof.spprofilesdob) = ?';
    $params = [$_SESSION['pid'], 1, $month];
    $out = selectQ($sql, "iii", $params, 'one');
    $sql2 = 'SELECT COUNT(prof.idspprofiles) as total_count FROM spprofiles_has_spprofiles AS t JOIN spprofiles AS prof ON prof.idspprofiles = t.spprofiles_idspprofilesender JOIN spprofiletype AS d ON prof.spprofiletype_idspprofiletype = d.idspprofiletype JOIN spuser AS su ON su.idspuser = prof.spuser_idspuser WHERE t.spprofiles_idspprofilesreceiver = ? AND t.spprofiles_has_spprofileflag = ? AND MONTH(prof.spprofilesdob) = ?';
    $out2 = selectQ($sql2, "iii", $params, 'one');
    $out = array_merge($out, $out2);
    return ['data' => $out];
  }
  
  /**
   * To get profile details of user
   *
  **/
  public function UserInfo($pid,$search_term=''){
    $sql = 'SELECT * FROM spprofiles AS sp inner join spprofiletype as sppt on sp.spprofiletype_idspprofiletype = sppt.idspprofiletype where sp.idspProfiles = ?'.( $search_term!='' ? ' and  sp.spProfileName like '."'%".$search_term."%'" : '' );
    $params = [$pid];
    $out = selectQ($sql, "i", $params, 'one');
    return ['data' => $out];
  }
  
}
?>
