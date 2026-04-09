<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
class Header extends Base{
  
 
  /**
   * To get all the distinct profile types
   *
  **/
  public function readProfileTypes(){
    $sql = 'select distinct idspProfileType, spProfileTypeName from spprofiletype where idspprofiletype != ?';
    $params = [0];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }

  /**
   * To get all the distinct profile types
   *
  **/
  public function readCategories(){
    $sql = 'select * from spcategories where spcategorystatus = ? group by spcategoriessort';
    $params = [1];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }

  /**
   * To get all the profiles of the user
   *
  **/
  public function readProfiles($uid){
    $sql = 'select * from spprofiles as profile inner join spprofiletype as profiletype on profile.spprofiletype_idspprofiletype = profiletype.idspprofiletype where profile.spuser_idspuser = ? AND profile.spprofiletype_idspprofiletype > 0 order by profiletype.idspProfileType';
    $params = [$uid];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }

  function readProfileOnConsultation($uid)
  {
      $sql = 'select profile.idspProfiles, profile.spProfilesDefault, profile.spProfileName, profile.spProfileEmail, profile.spProfilePhone, profile.spProfilePic, profiletype.idspProfileType, profiletype.spProfileTypeName from spprofiles as profile inner join spprofiletype as profiletype on profile.spprofiletype_idspprofiletype = profiletype.idspprofiletype where profile.spuser_idspuser = ? order by profiletype.idspProfileType';
      $params = [$uid];
      $out = selectQ($sql, "i", $params);
      return ['data' => $out];
  }

  /**
   * To get all the friend request list
   *
  **/
  public function friendRequestList($pid){
    $sql = 'select * from spprofiles_has_spprofiles where spprofiles_idspprofilesreceiver in (select idspprofiles from spprofiles where idspprofiles=?) and (spprofiles_has_spprofileflag = ? or spprofiles_has_spprofileflag is null) and spprofiles_idspprofilesender != ? limit 3';
    $params = [$pid, 0, $pid];
    $out = selectQ($sql, "iii", $params);
    return ['data' => $out];
  }
  
  /**
   * To get all the profiles of the user
   *
  **/
  public function readProfileInfo($pid){
    $sql = 'SELECT * FROM spprofiles AS t inner join spprofiletype as d on t.spprofiletype_idspprofiletype = d.idspprofiletype where t.idspprofiles = ?';
    $params = [$pid];
    $out = selectQ($sql, "i", $params);
    return ['data' => $out];
  }
  
  /**
   * To get the count of the unread message
   *
  **/
  public function unreadMessage($pid){
    $sql = 'SELECT COUNT(*) AS unread_count FROM spfriendchatting WHERE spprofiles_idspprofilesreciver = ? AND spfriendchattingunread = ?';
    $params = [$pid, 0];
    $out = selectQ($sql, "ii", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To get the count of the unread notification
   *
  **/
  public function unreadNotification($uid){
    $sql = 'SELECT COUNT(*) AS unread_count FROM spmessaging AS t INNER JOIN spprofiles AS d ON t.buyerprofileid = d.idspprofiles WHERE spmessagingstatus = ? AND sellerprofileid IN (SELECT idspprofiles FROM spprofiles WHERE spuser_idspuser = ?)';
    $params = [1, $uid];
    $out = selectQ($sql, "ii", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To make the user logout
   *
  **/
  public function logout(){
    
		$sql= 'UPDATE spprofiles SET is_active = ? WHERE idspProfiles = ?';
		$params = [0, $_POST['pid']];
    $out = insertQ($sql, "ii", $params);
		$_SESSION['uid'] = 0;
		session_unset();
		session_destroy();
		session_write_close();
		echo "<html><head><meta http-equiv=refresh content=0;URL=" . $BaseUrl . "></head><body></body></html>";
		exit();
  }
  
  /**
   * To read the default profile data
   *
  **/
  public function readDefaultProfile($uid){
    $sql = 'SELECT * FROM spprofiles AS t inner join spprofiletype as d on t.spprofiletype_idspprofiletype = d.idspprofiletype where t.spuser_idspuser= ? and spprofilesdefault = ?';
    $params = [$uid, 1];
    $out = selectQ($sql, "ii", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To the number of items in cart
   *
  **/
  public function cartCount($pid){
    $sql = "SELECT COUNT(*) AS order_count FROM sporder WHERE spbyuerprofileid = ? AND sporderstatus = ?  AND txn_id != ?";
    $params = [$pid, 0, ''];
    $out = selectQ($sql, "iis", $params);
    if(!empty($out)){
      $out = $out[0];
    }
    return ['data' => $out];
  }
  
  /**
   * To make the selected profile default
   *
  **/
  public function makeprofiledefault(){
    $sql= "UPDATE spprofiles SET spProfilesDefault = ? WHERE spUser_idspUser = ?";
		$params = [0, $_SESSION['uid']];
    $out = insertQ($sql, "ii", $params);
    
    $sql= "UPDATE spprofiles SET spProfilesDefault = ? WHERE idspProfiles =?";
		$params = [1, $_POST['profileid']];
    $out = insertQ($sql, "ii", $params);
    
    $defaultUser = $this->readDefaultProfile($_SESSION['uid']);
    if(isset($defaultUser['data'])){
      //return ['format' => 'skipSuccess', 'data' => [ 0 => $defaultUser]];
      $sql= "UPDATE spprofiles SET is_active = ? WHERE idspProfiles = ?";
		  $params = [1, $defaultUser['data']['idspProfiles']];
      $out = insertQ($sql, "ii", $params);
      $_SESSION['pid'] = $defaultUser['data']['idspProfiles'];
		  $_SESSION['myprofile'] = $defaultUser['data']["spProfileName"];
		  $_SESSION['MyProfileName'] = $defaultUser['data']["spProfileName"];
		  $_SESSION['ptname'] = $defaultUser['data']["spProfileTypeName"];
		  $_SESSION['ptpeicon'] = $defaultUser['data']["spprofiletypeicon"];
		  $_SESSION['ptid'] = $defaultUser['data']["spProfileType_idspProfileType"];
		  $_SESSION['isActive'] = 1;
		  $cartCount = $this->cartCount($_SESSION['pid']);
		  $_SESSION['cartcount'] = 0;
		  if(isset($cartCount['data'])){
		    if(isset($cartCount['data']['order_count'])){
		      $_SESSION['cartcount'] = $cartCount['data']['order_count'];
		    }
		  }
    }
    return ['format' => 'skipSuccess', 'data' => []];
  }

  public function getProfileStatus($pid, $uid){
    $sql = "SELECT * FROM spbuiseness_files WHERE sp_pid = ? AND sp_uid = ? ORDER BY id DESC LIMIT 1";
    $params = [$pid, $uid];
    $out = selectQ($sql, "ii", $params);
    return $out;
  }
}
